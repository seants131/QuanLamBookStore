<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonHang;
use App\Models\KhachHang;
use App\Models\KhuyenMai;
use App\Models\ChiTietHoaDon;
use App\Models\Sach;
use App\Models\DanhMuc;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = DonHang::with('khachHang')->where('trang_thai', '!=', 'huy');

        if ($request->filled('ma_don')) {
            $query->where('id', 'like', '%' . $request->ma_don . '%');
        }

        if ($request->filled('khach_hang')) {
            $query->whereHas('khachHang', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->khach_hang . '%');
            });
        }

        // 👉 Sắp xếp hóa đơn mới nhất lên đầu
        $orders = $query->orderBy('created_at', 'desc')->paginate(5);
        
        $customers = KhachHang::all();

        return view('admin.orders.index', compact('orders', 'customers'));
    }


    public function show($id)
    {
        $order = DonHang::with(['khachHang', 'chiTietDonHang.sach', 'khuyenMai'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function create()
    {
        $customers = KhachHang::all();
        $sachs = Sach::all();
        $khuyenMaiList = KhuyenMai::all();
        $danhMucs = DanhMuc::all();

       return view('admin.orders.create', compact('customers', 'sachs', 'khuyenMaiList', 'danhMucs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:nguoi_dung,id',
            'ngay_mua' => 'required|date',
            'trang_thai' => ['required', Rule::in(['cho_xu_ly', 'dang_giao', 'hoan_thanh', 'huy'])],
            'hinh_thuc_thanh_toan' => ['required', Rule::in(['tien_mat', 'chuyen_khoan'])],
            'tong_so_luong' => 'required|integer|min:1',
            'khuyen_mai_id' => 'nullable|exists:khuyen_mai,id',
            'sach_id' => 'required|array|min:1',
            'so_luong' => 'required|array|min:1',
            'dia_chi_giao_hang' => 'required|string|max:500',
            'sdt' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        DB::beginTransaction();

        try {
            $phanTramGiam = 0;
            if (!empty($validated['khuyen_mai_id'])) {
                $km = KhuyenMai::find($validated['khuyen_mai_id']);
                $phanTramGiam = $km ? $km->phan_tram_giam : 0;
            }

            $tongTien = 0;
            $tongSoLuong = 0;

            $donHang = DonHang::create([
                'user_id' => $validated['user_id'],
                'ngay_mua' => $validated['ngay_mua'],
                'trang_thai' => $validated['trang_thai'],
                'hinh_thuc_thanh_toan' => $validated['hinh_thuc_thanh_toan'],
                'giam_gia' => $phanTramGiam,
                'tong_tien' => 0, // cập nhật sau
                'tong_so_luong' => 0,
                'khuyen_mai_id' => $validated['khuyen_mai_id'] ?? null,
                'dia_chi_giao_hang' => $validated['dia_chi_giao_hang'], // thêm dòng này
                'sdt' => $validated['sdt'] ?? null,
                'email' => $validated['email'] ?? null,
            ]);

            foreach ($validated['sach_id'] as $index => $sachId) {
                $soLuong = $validated['so_luong'][$index];
                $sach = Sach::find($sachId);

                if (!$sach) {
                    DB::rollBack();
                    return back()->withInput()->with('error', "Không tìm thấy sách có mã {$sachId}.");
                }

                if ($sach->SoLuong < $soLuong) {
                    DB::rollBack();
                    return back()->withInput()->with('error', "Sách '{$sach->TenSach}' không đủ số lượng tồn kho.");
                }

                $donGia = $sach->GiaBia;
                $thanhTien = $soLuong * $donGia;

                $tongTien += $thanhTien;
                $tongSoLuong += $soLuong;

                $sach->SoLuong -= $soLuong;
                $sach->save();

                ChiTietHoaDon::create([
                    'hoa_don_id' => $donHang->id,
                    'sach_id' => $sach->MaSach,
                    'so_luong' => $soLuong,
                    'don_gia' => $donGia,
                    'thanh_tien' => $thanhTien,
                ]);
            }

            $tongTienSauGiam = $tongTien * (1 - ($phanTramGiam / 100));

            $donHang->update([
                'tong_tien' => $tongTienSauGiam,
                'tong_so_luong' => $tongSoLuong
            ]);

            DB::commit();
            return redirect()->route('admin.orders.index')->with('success', 'Hóa đơn đã được tạo thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Lỗi khi tạo hóa đơn: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $order = DonHang::with('chiTietDonHang')->findOrFail($id);
        $customers = KhachHang::all();
        $sachs = Sach::all();
        $khuyenMaiList = KhuyenMai::all();
        return view('admin.orders.edit', compact('order', 'customers', 'sachs', 'khuyenMaiList'));
    }

  public function update(Request $request, $id)
    {
        $request->validate([
            'so_luong' => 'required|array',
            'so_luong.*' => 'required|integer|min:1',
            'dia_chi_giao_hang' => 'required|string|max:500',
        ]);

        DB::beginTransaction();
        try {
            $order = DonHang::with('chiTietDonHang', 'khuyenMai')->findOrFail($id);

            $phanTramGiam = $order->khuyenMai->phan_tram_giam ?? 0;
            $tongSoLuong = 0;
            $tongTienTruocGiam = 0;

            foreach ($request->so_luong as $chiTietId => $soLuongMoi){
                $chiTiet = ChiTietHoaDon::with('sach')->where('id', $chiTietId)
                    ->where('hoa_don_id', $order->id)->first();

                if ($chiTiet) {
                   $soLuongCu = $chiTiet->so_luong;
                    $sach = $chiTiet->sach;

                    if (!$sach) {
                        throw new \Exception("Không tìm thấy sách cho chi tiết ID $chiTietId");
                    }

                    $chenhLech = $soLuongMoi - $soLuongCu;

                    // Nếu tăng số lượng → trừ kho
                    if ($chenhLech > 0) {
                        if ($sach->SoLuong < $chenhLech) {
                            throw new \Exception("Không đủ sách [{$sach->TenSach}] trong kho.");
                        }
                        $sach->SoLuong -= $chenhLech;
                    }
                    // Nếu giảm số lượng → cộng lại vào kho
                    elseif ($chenhLech < 0) {
                        $sach->SoLuong += abs($chenhLech);
                    }

                    $sach->save();

                    // Cập nhật số lượng mới vào chi tiết
                    $chiTiet->so_luong = $soLuongMoi;
                    $chiTiet->save();

                    $thanhTien = $soLuongMoi * $chiTiet->don_gia;
                    $tongSoLuong += $soLuongMoi;
                    $tongTienTruocGiam += $thanhTien;
                }
            }

            $tongTienSauGiam = $tongTienTruocGiam - ($tongTienTruocGiam * $phanTramGiam / 100);

            $order->update([
                'tong_so_luong' => $tongSoLuong,
                'tong_tien' => round($tongTienSauGiam),
                'dia_chi_giao_hang' => $request->dia_chi_giao_hang,
            ]);

            DB::commit();
            return redirect()->route('admin.orders.index')->with('success', 'Cập nhật hóa đơn và kho sách thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    public function approve(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:hoa_don,id',
            'new_status' => ['required', Rule::in(['dang_giao', 'hoan_thanh'])],
        ]);

        $order = DonHang::findOrFail($request->order_id);

        // Đảm bảo không được duyệt lùi trạng thái
        $allowedTransitions = [
            'cho_xu_ly' => 'dang_giao',
            'dang_giao' => 'hoan_thanh',
        ];

        if (!isset($allowedTransitions[$order->trang_thai]) ||
            $allowedTransitions[$order->trang_thai] !== $request->new_status) {
            return back()->with('error', 'Không thể cập nhật trạng thái theo thứ tự ngược hoặc không hợp lệ.');
        }

        $order->update([
            'trang_thai' => $request->new_status,
        ]);

        return redirect()->route('admin.orders.index')->with('success', 'Đã cập nhật trạng thái đơn hàng.');
    }

    public function cancel($id)
    {
        DB::beginTransaction();

        try {
            $order = DonHang::with('chiTietDonHang.sach')->findOrFail($id);

            // Chỉ cho hủy nếu chưa hoàn thành
            if (in_array($order->trang_thai, ['hoan_thanh', 'huy'])) {
                return redirect()->back()->with('error', 'Không thể hủy đơn hàng đã hoàn thành hoặc đã bị hủy.');
            }

            // Hoàn trả sách về kho
            foreach ($order->chiTietDonHang as $chiTiet) {
                $sach = $chiTiet->sach;
                if ($sach) {
                    $sach->SoLuong += $chiTiet->so_luong;
                    $sach->save();
                }
            }

            // Cập nhật trạng thái đơn hàng
            $order->update(['trang_thai' => 'huy']);

            DB::commit();
            return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã được hủy và hoàn sách về kho.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Lỗi khi hủy đơn hàng: ' . $e->getMessage());
        }
    }
    public function print($id)
{
    $order = DonHang::with(['khachHang', 'chiTietDonHang.sach', 'khuyenMai'])->findOrFail($id);

    return view('admin.orders.print', compact('order'));
}
}

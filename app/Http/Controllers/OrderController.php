<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonHang;
use App\Models\KhachHang;
use App\Models\KhuyenMai;
use App\Models\ChiTietHoaDon;
use App\Models\Sach;
use App\Models\NhaXuatBan;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = DonHang::with('khachHang');

        if ($request->filled('ma_don')) {
            $query->where('id', 'like', '%' . $request->ma_don . '%');
        }

        if ($request->filled('khach_hang')) {
            $query->whereHas('khachHang', function ($q) use ($request) {
                $q->where('ho_ten', 'like', '%' . $request->khach_hang . '%');
            });
        }

        $orders = $query->paginate(5);
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
        $nhaXuatBans = NhaXuatBan::all(); // thêm dòng này

        return view('admin.orders.create', compact('customers', 'sachs', 'khuyenMaiList', 'nhaXuatBans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:nguoi_dung,id',
            'ngay_mua' => 'required|date',
            'trang_thai' => ['required', Rule::in(['cho_xu_ly', 'dang_giao', 'hoan_thanh', 'huy'])],
            'hinh_thuc_thanh_toan' => ['required', Rule::in(['tien_mat', 'chuyen_khoan'])],
            'giam_gia' => 'nullable|integer|min:0|max:100',
            'tong_tien' => 'required|numeric|min:0',
            'tong_so_luong' => 'required|integer|min:1',
            'khuyen_mai_id' => 'nullable|exists:khuyen_mai,id',
            'sach_id' => 'required|array|min:1',
            'so_luong' => 'required|array|min:1',
        ]);

        DB::beginTransaction();

        try {
            $donHang = DonHang::create([
                'user_id' => $validated['user_id'],
                'ngay_mua' => $validated['ngay_mua'],
                'trang_thai' => $validated['trang_thai'],
                'hinh_thuc_thanh_toan' => $validated['hinh_thuc_thanh_toan'],
                'giam_gia' => $validated['giam_gia'] ?? 0,
                'tong_tien' => $validated['tong_tien'],
                'tong_so_luong' => $validated['tong_so_luong'],
                'khuyen_mai_id' => $validated['khuyen_mai_id'] ?? null,
            ]);

            foreach ($validated['sach_id'] as $index => $sachId) {
                $soLuong = $validated['so_luong'][$index];
                $sach = Sach::find($sachId);

                if (!$sach) {
                    DB::rollBack();
                    return back()->withInput()->with('error', "Không tìm thấy sách có mã {$sachId}.");
                }

                // Kiểm tra tồn kho
                if ($sach->SoLuong < $soLuong) {
                    DB::rollBack();
                    return back()->withInput()->with('error', "Sách '{$sach->TenSach}' không đủ số lượng tồn kho.");
                }

                $donGia = $sach->GiaBia;
                $thanhTien = $soLuong * $donGia;

                // Trừ kho
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
        $validated = $request->validate([
            'user_id' => 'required|exists:nguoi_dung,id',
            'ngay_mua' => 'required|date',
            'trang_thai' => ['required', Rule::in(['cho_xu_ly', 'dang_giao', 'hoan_thanh', 'huy'])],
            'hinh_thuc_thanh_toan' => ['required', Rule::in(['tien_mat', 'chuyen_khoan'])],
            'giam_gia' => 'nullable|integer|min:0|max:100',
            'tong_tien' => 'required|numeric|min:0',
            'tong_so_luong' => 'required|integer|min:0',
            'khuyen_mai_id' => 'nullable|exists:khuyen_mai,id',
        ]);

        $order = DonHang::findOrFail($id);
        $order->update($validated);

        return redirect()->route('admin.orders.index')->with('success', 'Hóa đơn đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        $order = DonHang::findOrFail($id);

        try {
            $order->delete();
            return redirect()->route('admin.orders.index')->with('success', 'Hóa đơn đã được xóa thành công.');
        } catch (\Exception $e) {
            return redirect()->route('admin.orders.index')->with('error', 'Lỗi khi xóa hóa đơn.');
        }
    }
}

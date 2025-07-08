<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DonHang;
use App\Models\ChiTietHoaDon;
use App\Models\KhachHang;
use App\Models\Sach;
use App\Models\DanhMuc;
use Illuminate\Support\Facades\DB;

class ThongKeController extends Controller
{
    public function thongKeHoaDon(Request $request)
    {
        $tuNgay = $request->tu_ngay;
        $denNgay = $request->den_ngay;

        $data = DB::table('hoa_don')
            ->select(
                DB::raw("DATE(ngay_mua) as ngay"),
                DB::raw("SUM(tong_tien) as tong_tien"),
                DB::raw("GROUP_CONCAT(DISTINCT hoa_don.id) as danh_sach_id")
            )
            ->whereBetween('ngay_mua', [$tuNgay . ' 00:00:00', $denNgay . ' 23:59:59'])
            ->groupBy(DB::raw("DATE(ngay_mua)"))
            ->orderBy('ngay')
            ->get();

        // Gộp sách bán ra theo ngày
        foreach ($data as $item) {
            $ids = explode(',', $item->danh_sach_id);

            $sachList = DB::table('chi_tiet_hoa_don')
                ->join('sach', 'chi_tiet_hoa_don.sach_id', '=', 'sach.MaSach')
                ->whereIn('hoa_don_id', $ids)
                ->select('sach.TenSach', DB::raw('SUM(so_luong) as tong_so_luong'))
                ->groupBy('sach.TenSach')
                ->get();

            $item->sach_ban = $sachList->map(fn($s) => "{$s->TenSach} ({$s->tong_so_luong})")->implode(', ');
        }

        return response()->json($data);
    }

    public function xuatDuLieuHoaDon(Request $request)
    {
        $tuNgay = $request->input('tu_ngay');
        $denNgay = $request->input('den_ngay');

        $hoaDons = DonHang::with(['chiTietDonHang.sach.danhMuc', 'khachHang'])
            ->when($tuNgay && $denNgay, function ($q) use ($tuNgay, $denNgay) {
                $q->whereBetween('ngay_mua', [$tuNgay . ' 00:00:00', $denNgay . ' 23:59:59']);
            })
            ->get();

        $rows = [];

        foreach ($hoaDons as $hd) {
            $khachHang = optional($hd->khachHang)->name ?? 'N/A';
            $sdt = $hd->sdt ?? optional($hd->khachHang)->sdt ?? 'N/A';
            $email = $hd->email ?? optional($hd->khachHang)->email ?? 'N/A';
            $ngayMua = \Carbon\Carbon::parse($hd->ngay_mua)->format('d/m/Y H:i');

            foreach ($hd->chiTietDonHang as $ct) {
                $sach = $ct->sach;
                $rows[] = [
                    'Mã hóa đơn' => $hd->id,
                    'Khách hàng' => $khachHang,
                    'Số điện thoại' => $sdt,
                    'Email' => $email,
                    'Ngày mua' => $ngayMua,
                    'Danh mục' => $sach->danhMuc->ten ?? 'Không rõ',
                    'Tên sách' => $sach->TenSach ?? 'Không rõ',
                    'Giá bìa' => $ct->don_gia,
                    'Số lượng' => $ct->so_luong,
                    'Thành tiền' => $ct->thanh_tien,
                ];
            }
        }

        return response()->json($rows);
    }

    public function doanhSoTheoNgay(Request $request)
    {
        $tuNgay = $request->input('tu_ngay');
        $denNgay = $request->input('den_ngay');

        $data = DB::table('hoa_don')
            ->whereBetween('ngay_mua', [$tuNgay, $denNgay])
            ->select(DB::raw('DATE(ngay_mua) as ngay'), DB::raw('SUM(tong_tien) as doanh_so'))
            ->groupBy('ngay')
            ->orderBy('ngay')
            ->get();

        return response()->json($data);
    }

    public function thongKeTrangThaiDon()
    {
        $data = DB::table('hoa_don')
            ->select('trang_thai', DB::raw('COUNT(*) as so_luong'))
            ->groupBy('trang_thai')
            ->get();

        return response()->json($data);
    }

    public function tonKhoVaBan()
    {
        $data = DB::table('sach')
            ->leftJoin('chi_tiet_hoa_don', 'sach.MaSach', '=', 'chi_tiet_hoa_don.sach_id')
            ->select('sach.TenSach as ten_sach', 'sach.SoLuong as ton_kho', DB::raw('SUM(chi_tiet_hoa_don.so_luong) as da_ban'))
            ->groupBy('sach.TenSach', 'sach.SoLuong')
            ->orderByDesc(DB::raw('SUM(chi_tiet_hoa_don.so_luong)'))
            ->limit(10)
            ->get();

        return response()->json($data);
    }

    public function taiChinhTongQuat(Request $request)
{
    $tuNgay = $request->input('tu_ngay');
    $denNgay = $request->input('den_ngay');

    $doanhThu = DB::table('hoa_don')
        ->whereBetween('ngay_mua', [$tuNgay, $denNgay])
        ->sum('tong_tien');

    // Tính chi phí thực dựa trên chiết khấu
    $chiPhi = DB::table('chi_tiet_hoa_don')
        ->join('sach', 'chi_tiet_hoa_don.sach_id', '=', 'sach.MaSach')
        ->join('hoa_don', 'hoa_don.id', '=', 'chi_tiet_hoa_don.hoa_don_id')
        ->whereBetween('hoa_don.ngay_mua', [$tuNgay, $denNgay])
        ->select(DB::raw('SUM(sach.GiaBia * (sach.chiet_khau / 100) * chi_tiet_hoa_don.so_luong) as loi_nhuan_thuan'))
        ->value('loi_nhuan_thuan');

    // Lợi nhuận thật = tổng chiết khấu thu được
    $loiNhuan = $chiPhi;

    return response()->json([
        'doanh_thu' => $doanhThu,
        'chi_phi' => $doanhThu - $loiNhuan, // phần còn lại là "chi phí"
        'loi_nhuan' => $loiNhuan
    ]);
}
}


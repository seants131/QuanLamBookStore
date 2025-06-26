<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ThongKeController extends Controller
{
    public function thongKeSach(Request $request)
    {
        $tuNgay = $request->input('tu_ngay');
        $denNgay = $request->input('den_ngay');

        $data = DB::table('hoa_don')
            ->join('chi_tiet_hoa_don', 'hoa_don.id', '=', 'chi_tiet_hoa_don.hoa_don_id')
            ->join('sach', 'chi_tiet_hoa_don.sach_id', '=', 'sach.MaSach')
            ->select('sach.TenSach as ten_sach', DB::raw('SUM(chi_tiet_hoa_don.so_luong) as tong_so_luong'))
            ->whereBetween('hoa_don.ngay_mua', [$tuNgay, $denNgay])
            ->groupBy('sach.TenSach')
            ->orderByDesc('tong_so_luong')
            ->limit(10)
            ->get();

        return response()->json($data);
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


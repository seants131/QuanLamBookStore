<?php

namespace App\Http\Controllers;

use App\Models\KhuyenMai;
use Illuminate\Http\Request;

class KhuyenMaiController extends Controller
{
    public function index(Request $request)
    {
        $query = KhuyenMai::query();

        if ($request->filled('ten')) {
            $query->where('ten', 'like', '%' . $request->ten . '%');
        }

        if ($request->has('trang_thai') && $request->trang_thai !== '') {
            if ($request->trang_thai === 'tat') {
                // Lọc những cái trạng thái là kich_hoat nhưng đã hết hạn
                $query->where(function ($q) {
                    $q->where('trang_thai', 'kich_hoat')
                    ->whereDate('ngay_ket_thuc', '<', \Carbon\Carbon::today());
                })->orWhere('trang_thai', 'tat');
            } else {
                // Trạng thái đang còn hiệu lực
                $query->where('trang_thai', $request->trang_thai)
                    ->whereDate('ngay_ket_thuc', '>=', \Carbon\Carbon::today());
            }
        }

        $khuyenmai = $query->orderByDesc('created_at')->paginate(10);

        return view('admin.khuyenmai.index', compact('khuyenmai'));
    }

    public function create()
    {
        return view('admin.khuyenmai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten'             => 'required|string|max:255',
            'phan_tram_giam'  => 'required|numeric|min:0|max:100',
            'ngay_bat_dau'    => 'required|date',
            'ngay_ket_thuc'   => 'required|date|after_or_equal:ngay_bat_dau',
            'trang_thai'      => 'required|in:0,1',
        ]);

        $data = $request->all();
        $data['trang_thai'] = $data['trang_thai'] == '1' ? 'kich_hoat' : 'tat';
        KhuyenMai::create($data);
        return redirect()->route('admin.khuyenmai.index')->with('success', 'Khuyến mãi đã được thêm.');
    }

    public function edit($id)
    {
        $item = KhuyenMai::findOrFail($id);
        return view('admin.khuyenmai.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ten'             => 'required|string|max:255',
            'phan_tram_giam'  => 'required|numeric|min:0|max:100',
            'ngay_bat_dau'    => 'required|date',
            'ngay_ket_thuc'   => 'required|date|after_or_equal:ngay_bat_dau',
            'trang_thai'      => 'required|in:0,1', // Vì form gửi 1 hoặc 0
        ]);

        $data = $request->all();
        $data['trang_thai'] = $data['trang_thai'] == '1' ? 'kich_hoat' : 'tat';

        $item = KhuyenMai::findOrFail($id);
        $item->update($data);

        return redirect()->route('admin.khuyenmai.index')->with('success', 'Khuyến mãi đã được cập nhật.');
    }


    public function destroy($id)
    {
        KhuyenMai::findOrFail($id)->delete();
        return redirect()->route('admin.khuyenmai.index')->with('success', 'Khuyến mãi đã được xóa.');
    }
}

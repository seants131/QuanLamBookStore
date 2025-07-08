<?php

namespace App\Http\Controllers;

use App\Models\KhuyenMai;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KhuyenMaiController extends Controller
{
    public function index(Request $request)
    {
        $query = KhuyenMai::query();
        $today = \Carbon\Carbon::today();

        if ($request->filled('ten')) {
            $query->where('ten', 'like', '%' . $request->ten . '%');
        }

        if ($request->filled('trang_thai')) {
            switch ($request->trang_thai) {
                case 'kich_hoat':
                    $query->where('trang_thai', 'kich_hoat')
                        ->whereDate('ngay_bat_dau', '<=', $today)
                        ->whereDate('ngay_ket_thuc', '>=', $today);
                    break;
                case 'chua_bat_dau':
                    $query->where('trang_thai', 'kich_hoat')
                        ->whereDate('ngay_bat_dau', '>', $today);
                    break;
                case 'het_han':
                    $query->where('trang_thai', 'kich_hoat')
                        ->whereDate('ngay_ket_thuc', '<', $today);
                    break;
                case 'tat':
                    $query->where('trang_thai', 'tat');
                    break;
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
            'trang_thai'      => 'required|in:kich_hoat,tat',
        ]);

        KhuyenMai::create($request->all());

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
            'trang_thai'      => 'required|in:kich_hoat,tat',
        ]);

        $item = KhuyenMai::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('admin.khuyenmai.index')->with('success', 'Khuyến mãi đã được cập nhật.');
    }

    public function destroy($id)
    {
        KhuyenMai::findOrFail($id)->delete();
        return redirect()->route('admin.khuyenmai.index')->with('success', 'Khuyến mãi đã được xóa.');
    }
}

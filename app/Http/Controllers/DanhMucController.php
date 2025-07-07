<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DanhMucController extends Controller
{
    /** Danh sách + tìm kiếm */
    public function index(Request $request)
    {
        $query = DanhMuc::query();

        // Tìm theo tên
        if ($request->filled('ten')) {
            $query->where('ten', 'LIKE', '%' . $request->ten . '%');
        }

        $danhmucs = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.danhmuc.index', compact('danhmucs'));
    }

    /** Hiển thị form tạo */
    public function create()
    {
        return view('admin.danhmuc.create');
    }

    /** Lưu danh mục mới */
    public function store(Request $request)
    {
        $request->validate([
            'ten'     => 'required|string|max:255|unique:danh_muc,ten',
            'mo_ta'   => 'nullable|string',
        ]);

        DanhMuc::create([
            'ten'   => $request->ten,
            'slug'  => Str::slug($request->ten),
            'mo_ta' => $request->mo_ta
        ]);

        return redirect()->route('admin.danhmuc.index')
                         ->with('success', 'Danh mục đã được thêm thành công.');
    }

    /** Form chỉnh sửa */
    public function edit($id)
    {
        $category = DanhMuc::findOrFail($id);
        return view('admin.danhmuc.edit', compact('category'));
    }

    /** Cập nhật danh mục */
    public function update(Request $request, $id)
    {
        $danhmuc = DanhMuc::findOrFail($id);

        $request->validate([
            'ten'   => 'required|string|max:255|unique:danh_muc,ten,' . $danhmuc->id,
            'mo_ta' => 'nullable|string',
        ]);

        $danhmuc->update([
            'ten'   => $request->ten,
            'slug'  => Str::slug($request->ten),
            'mo_ta' => $request->mo_ta
        ]);

        return redirect()->route('admin.danhmuc.index')
                         ->with('success', 'Danh mục đã được cập nhật thành công.');
    }

    /** Xóa danh mục */
    public function destroy($id)
    {
        DanhMuc::findOrFail($id)->delete();
        return redirect()->route('admin.danhmuc.index')
                         ->with('success', 'Danh mục đã được xóa thành công.');
    }
}

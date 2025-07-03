<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sach;
use App\Models\DanhMuc;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Sach::with('danhMuc');

        if ($request->filled('ten_sach')) {
            $query->where('TenSach', 'LIKE', '%' . $request->ten_sach . '%');
        }

        if ($request->filled('tac_gia')) {
            $query->whereRaw("LOWER(TacGia) LIKE ?", ['%' . strtolower(trim($request->tac_gia)) . '%']);
        }

        if ($request->filled('ngay_tao')) {
            $query->whereDate('created_at', $request->ngay_tao);
        }

        if ($request->filled('danh_muc_id')) {
            $query->where('danh_muc_id', $request->danh_muc_id);
        }

        $books = $query->orderByDesc('created_at')
                    ->paginate(10)
                    ->appends($request->query()); // GIỮ THAM SỐ TRÊN LINK PHÂN TRANG

        $lopOptions = range(1, 12);
        $danhMucs = DanhMuc::all();

        return view('admin.books.index', compact('books', 'lopOptions', 'danhMucs'));
    }

    public function show($id)
    {
        $book = Sach::with('danhmuc')->findOrFail($id);
        return view('admin.books.show', compact('book'));
    }

    public function create()
    {
        $lopOptions = range(1, 12);
        $danhMucs = DanhMuc::all();
        return view('admin.books.create', compact('lopOptions', 'danhMucs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'TenSach' => 'required|string|max:255|unique:sach,TenSach',
            'LoaiSanPham' => 'required|in:sach_giao_khoa,sach_tham_khao',
            'Lop' => 'required|in:' . implode(',', range(1, 12)),
            'TacGia' => 'nullable|string|max:255',
            'GiaBia' => 'required|numeric',
            'ChietKhau' => 'nullable|numeric|min:0|max:100',
            'LuotMua' => 'nullable|integer|min:0',
            'NamXuatBan' => 'required|integer',
            'MoTa' => 'nullable|string',
            'TrangThai' => 'required|boolean',
            'danh_muc_id' => 'required|exists:danh_muc,id',
            'HinhAnh' => 'nullable|image|max:2048',
        ], [
            'TenSach.unique' => 'Tên sách đã tồn tại.',
            'danh_muc_id.required' => 'Vui lòng chọn danh mục.',
            'danh_muc_id.exists' => 'Danh mục không hợp lệ.',
        ]);

        $data = $request->except('SoLuong');
        $data['SoLuong'] = 0;

        if ($request->hasFile('HinhAnh')) {
            $file = $request->file('HinhAnh');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/books'), $fileName);
            $data['HinhAnh'] = $fileName;
        }

        Sach::create($data);

        return redirect()->route('admin.books.index')->with('success', 'Sách đã được thêm thành công.');
    }

    public function edit($id)
    {
        $book = Sach::findOrFail($id);
        $lopOptions = range(1, 12);
        $danhMucs = DanhMuc::all();

        return view('admin.books.edit', compact('book', 'lopOptions', 'danhMucs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'TenSach' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sach', 'TenSach')->ignore($id, 'MaSach'),
            ],
            'LoaiSanPham' => 'required|in:sach_giao_khoa,sach_tham_khao',
            'Lop' => 'required|in:' . implode(',', range(1, 12)),
            'TacGia' => 'nullable|string|max:255',
            'GiaBia' => 'required|numeric',
            'ChietKhau' => 'nullable|numeric|min:0|max:100',
            'LuotMua' => 'nullable|integer|min:0',
            'NamXuatBan' => 'required|integer',
            'MoTa' => 'nullable|string',
            'TrangThai' => 'required|boolean',
            'danh_muc_id' => 'required|exists:danh_muc,id',
            'HinhAnh' => 'nullable|image|max:2048',
        ], [
            'TenSach.unique' => 'Tên sách đã tồn tại.',
            'danh_muc_id.required' => 'Vui lòng chọn danh mục.',
            'danh_muc_id.exists' => 'Danh mục không hợp lệ.',
        ]);

        $book = Sach::findOrFail($id);
        $data = $request->except('SoLuong');

        if ($request->hasFile('HinhAnh')) {
            if ($book->HinhAnh && file_exists(public_path('uploads/books/' . $book->HinhAnh))) {
                unlink(public_path('uploads/books/' . $book->HinhAnh));
            }

            $file = $request->file('HinhAnh');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/books'), $fileName);
            $data['HinhAnh'] = $fileName;
        }

        $book->update($data);

        return redirect()->route('admin.books.index')->with('success', 'Sách đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        $book = Sach::findOrFail($id);

        try {
            if ($book->HinhAnh && file_exists(public_path('uploads/books/' . $book->HinhAnh))) {
                unlink(public_path('uploads/books/' . $book->HinhAnh));
            }

            $book->delete();
            return redirect()->route('admin.books.index')->with('success', 'Sách đã được xóa thành công.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === "23000") {
                return redirect()->route('admin.books.index')->with(
                    'error',
                    "Không thể xóa sách này vì đang được sử dụng trong hóa đơn hoặc phiếu nhập."
                );
            }

            return redirect()->route('admin.books.index')->with(
                'error',
                'Đã xảy ra lỗi khi xóa sách. Vui lòng thử lại.'
            );
        }
    }
}

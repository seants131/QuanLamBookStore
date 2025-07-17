<?php

namespace App\Http\Controllers;

use App\Models\LienHe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TraLoiLienHeMail;

class LienHeController extends Controller
{
    /** Danh sách + tìm kiếm */
    public function index(Request $request)
    {
        $query = LienHe::query();

        // Tìm theo họ tên
        if ($request->filled('ho_ten')) {
            $query->where('ho_ten', 'LIKE', '%' . $request->ho_ten . '%');
        }

        // Tìm theo email
        if ($request->filled('email')) {
            $query->where('email', 'LIKE', '%' . $request->email . '%');
        }

        // Tìm theo số điện thoại
        if ($request->filled('so_dien_thoai')) {
            $query->where('so_dien_thoai', 'LIKE', '%' . $request->so_dien_thoai . '%');
        }

        // Tìm theo ngày tạo
        if ($request->filled('ngay_tao')) {
            $query->whereDate('created_at', $request->ngay_tao);
        }
        
        // Tìm theo trạng thái
        if ($request->filled('trang_thai')) {
            $query->where('trang_thai', $request->trang_thai);
        }

        $lienhe = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.lienhe.index', compact('lienhe'));
    }

    /** Form tạo */
    public function create()
    {
        return view('admin.lienhe.create');
    }

    /** Lưu liên hệ mới */
    public function store(Request $request)
    {
        $request->validate([
            'ho_ten'         => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'so_dien_thoai'  => 'nullable|string|max:20',
            'noi_dung'       => 'required|string',
        ]);

        LienHe::create($request->only([
            'ho_ten', 'email', 'so_dien_thoai', 'noi_dung'
        ]));

        return redirect()->route('admin.lienhe.index')
                         ->with('success', 'Liên hệ đã được thêm thành công.');
    }

    /** Form chỉnh sửa */
    public function edit($id)
    {
        $contact = LienHe::findOrFail($id);
        return view('admin.lienhe.edit', compact('contact'));
    }

    /** Cập nhật */
    public function update(Request $request, $id)
    {
        $request->validate([
            'ho_ten'         => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'so_dien_thoai'  => 'nullable|string|max:20',
            'noi_dung'       => 'required|string',
        ]);

        $contact = LienHe::findOrFail($id);
        $contact->update($request->only([
            'ho_ten', 'email', 'so_dien_thoai', 'noi_dung'
        ]));

        return redirect()->route('admin.lienhe.index')
                         ->with('success', 'Liên hệ đã được cập nhật thành công.');
    }

    /** Xóa */
    public function destroy($id)
    {
        LienHe::findOrFail($id)->delete();
        return redirect()->route('admin.lienhe.index')
                         ->with('success', 'Liên hệ đã được xóa thành công.');
    }
    // trạng thái
    public function toggleTrangThai($id)
    {
        $contact = LienHe::findOrFail($id);
        $contact->trang_thai = !$contact->trang_thai;
        $contact->save();

        return redirect()->route('admin.lienhe.index')->with('success', 'Cập nhật trạng thái thành công.');
    }
    // trả lời liên hê
   public function reply(Request $request, $id)
    {
        $request->validate([
            'phan_hoi' => 'required|string',
        ]);

        $contact = LienHe::findOrFail($id);

        try {
            // Truyền thêm $contact
            \Mail::to($contact->email)->send(new \App\Mail\TraLoiLienHeMail($request->phan_hoi, $contact));
            return redirect()->back()->with('success', 'Phản hồi đã được gửi thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gửi email thất bại: ' . $e->getMessage());
        }
    }
}

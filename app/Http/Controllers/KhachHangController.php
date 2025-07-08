<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use Illuminate\Http\Request;

class KhachHangController extends Controller
{
    public function index(Request $request)
    {
        $query = KhachHang::query();

        // Tìm theo tên, username hoặc email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('username', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // Sắp xếp mới nhất lên đầu
        $khachhangs = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.khachhang.index', compact('khachhangs'));
    }

    public function create()
    {
        return view('admin.khachhang.create');
    }

   public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:nguoi_dung,username',
            'email' => 'required|email|unique:nguoi_dung,email',
            'password' => 'required|string|min:6|confirmed',
            'so_dien_thoai' => ['required', 'regex:/^0[0-9]{9}$/', 'unique:nguoi_dung,so_dien_thoai'],
        ], [
            'so_dien_thoai.required' => 'Vui lòng nhập số điện thoại.',
            'so_dien_thoai.regex' => 'Số điện thoại phải gồm 10 chữ số và bắt đầu bằng số 0.',
            'so_dien_thoai.unique' => 'Số điện thoại đã tồn tại.',
        ]);

        KhachHang::create($request->all());

        return redirect()->route('admin.khachhang.index')->with('success', 'Thêm khách hàng thành công!');
    }

    public function edit(KhachHang $khachhang)
    {
        return view('admin.khachhang.edit', compact('khachhang'));
    }

    public function update(Request $request, KhachHang $khachhang)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:nguoi_dung,username,' . $khachhang->id,
            'email' => 'required|email|unique:nguoi_dung,email,' . $khachhang->id,
             'so_dien_thoai' => ['required', 'regex:/^0[0-9]{9}$/', 'unique:nguoi_dung,so_dien_thoai'],
        ], [
            'so_dien_thoai.required' => 'Vui lòng nhập số điện thoại.',
            'so_dien_thoai.regex' => 'Số điện thoại phải gồm 10 chữ số và bắt đầu bằng số 0.',
            'so_dien_thoai.unique' => 'Số điện thoại đã tồn tại.',
        ]);

        $data = $request->only(['name', 'username', 'email', 'so_dien_thoai']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $khachhang->update($data);

        return redirect()->route('admin.khachhang.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(KhachHang $khachhang)
    {
        $khachhang->delete();
        return redirect()->route('admin.khachhang.index')->with('success', 'Xóa thành công!');
    }
}



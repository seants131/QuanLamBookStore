<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('admin.profile.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'dia_chi' => 'nullable|string|max:255',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->dia_chi = $request->dia_chi;

        if ($request->hasFile('avatar')) {
        // Xóa avatar cũ nếu có
            if ($user->avatar && file_exists(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->move(public_path('images/user'), $filename);

            $user->avatar = 'images/user/' . $filename;
            }
            $user->save();
        return redirect()->route('admin.profile.show')->with('success', 'Cập nhật thành công!');
    }

    public function changePasswordForm()
    {
        return view('admin.profile.change_password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.profile.show')->with('success', 'Đổi mật khẩu thành công!');
    }

    public function updateContact(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
                return redirect()->back()->with('error', 'Không tìm thấy người dùng đang đăng nhập.');
            }

        $request->validate([
            'so_dien_thoai' => 'nullable|string|max:20',
            'dia_chi' => 'nullable|string|max:255',
        ]);

        $user->so_dien_thoai = $request->so_dien_thoai;
        $user->dia_chi = $request->dia_chi;
        $user->save();

        return redirect()->route('admin.profile.show')->with('success', 'Cập nhật liên hệ thành công!');
    }
}

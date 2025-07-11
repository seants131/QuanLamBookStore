<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Models\KhachHang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlacedMail;
use App\Models\DonHang;
use App\Models\ChiTietHoaDon;
use Illuminate\Support\Str;

class UserAuthController extends Controller
{
    // Hiển thị form đăng ký
    public function showSignupForm()
    {
        return view('user.auth.dang_ky');
    }

    // Xử lý đăng ký
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = KhachHang::where('email', $request->email)->first();

        if ($user) {
            if (!empty($user->username)) {
                return back()->withErrors(['username' => 'Tài khoản đã được tạo.'])->withInput();
            }
            $user->update([
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);
            Auth::guard('khach')->login($user);
            return redirect()->route('user.home.index');
        } else {
            $userByUsername = KhachHang::where('username', $request->username)->first();
            if ($userByUsername) {
                return back()->withErrors(['username' => 'Tên đăng nhập đã tồn tại.'])->withInput();
            }
            $user = KhachHang::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'khach',
            ]);
            Auth::guard('khach')->login($user);
            return redirect()->route('user.home.index');
        }
    }

    // Hiển thị form đăng nhập
    public function showSigninForm()
    {
        return view('user.auth.dang_nhap');
    }

    // Xử lý đăng nhập
    public function signin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::guard('khach')->attempt($credentials)) {
            return redirect()->route('user.home.index');
        }

        return back()->withErrors([
            'username' => 'Tài khoản hoặc mật khẩu không đúng.',
        ])->withInput();
    }

    // Đăng xuất
    public function logout()
    {
        Auth::guard('khach')->logout();
        return redirect()->route('user.home.index');
    }
    // Hiển thị form quên mật khẩu
    public function showForgotForm()
    {
        return view('user.auth.forgot_password');
    }

    // Gửi link đặt lại mật khẩu
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:nguoi_dung,email']);

        $status = Password::broker('khachhangs')->sendResetLink(
            $request->only('email')
        );

        return back()->with('status', __($status));
    }

    // Hiển thị form đặt lại mật khẩu
    public function showResetForm(Request $request, $token)
    {
        $email = $request->query('email');
        return view('user.auth.reset_password', ['token' => $token, 'email' => $email]);
    }

    // Xử lý đặt lại mật khẩu
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:nguoi_dung,email',
            'password' => 'required|confirmed|min:6',
            'token' => 'required'
        ]);

        $status = Password::broker('khachhangs')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->setRememberToken(Str::random(60));
                $user->save();
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('user.sign-in')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}

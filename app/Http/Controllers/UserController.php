<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\DonHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\model\KhachHang;
class UserController extends Controller

{
    // Trang thông tin cá nhân
    public function index()
    {
        $user = Auth::guard('khach')->user();
        return view('user.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::guard('khach')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'dia_chi' => 'nullable|string|max:255',
        ]);

        $user->name = $request->name;
        $user->dia_chi = $request->dia_chi;
        $user->save();

        return back()->with('success', 'Cập nhật thông tin thành công!');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::guard('khach')->user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if (!\Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng!']);
        }

        $user->password = \Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Đổi mật khẩu thành công!');
    }

    // Danh sách đơn hàng
    public function orders()
    {
        $orders = DonHang::where('user_id', Auth::id())
            ->orderByDesc('ngay_mua')
            ->paginate(10); // Sử dụng paginate thay cho get()
        return view('user.orders.index', compact('orders'));
    }

    // Chi tiết đơn hàng
    public function orderDetail($id)
    {
        $order = DonHang::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
        return view('user.orders.detail', compact('order'));
    }
}

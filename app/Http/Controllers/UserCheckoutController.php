<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\ChiTietHoaDon;
use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlacedMail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UserCheckoutController extends Controller
{
    public function showAddressForm()
    {
        $user = Auth::guard('khach')->user();
        $address = null;
        $dia_chi = null;

        if ($user) {
            $address = [
                'fname' => $user->name,
                'email' => $user->email,
                'mno' => $user->so_dien_thoai,
            ];
            $dia_chi = $user->dia_chi; // Lấy địa chỉ đầy đủ từ DB
        }

        return view('user.checkout.address', compact('address', 'dia_chi'));
    }

    public function submitAddress(Request $request)
    {
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'email' => 'required|email',
            'mno' => 'required|string|max:20',
            'houseno' => 'required|string',
            'city' => 'required|string',
            'district' => 'required|string',
            'state' => 'required|string',
        ]);

        // Nối địa chỉ thành 1 chuỗi
        $fullAddress = $validated['houseno'] . ', ' . $validated['state'] . ', ' . $validated['district'] . ', ' . $validated['city'];

        // Kiểm tra email đã tồn tại chưa
        $user = KhachHang::where('email', $validated['email'])->first();
        if ($user) {
            // Update thông tin
            $user->update([
                'name' => $validated['fname'],
                'so_dien_thoai' => $validated['mno'],
                'dia_chi' => $fullAddress,
            ]);
        } else {
            // Tạo mới
            $user = KhachHang::create([
                'name' => $validated['fname'],
                'email' => $validated['email'],
                'so_dien_thoai' => $validated['mno'],
                'role' => 'khach',
                'dia_chi' => $fullAddress,
            ]);
        }

        // Lưu vào session cho các bước sau
        session(['shipping_address' => $validated]);
        session(['user_id_checkout' => $user->id]);

        return redirect()->route('checkout.payment')->with('success', 'Đã lưu địa chỉ thành công.');
    }

    public function goToPayment()
    {
        $cart = session('cart', []);
        $cart_total = 0;
        foreach ($cart as $item) {
            $cart_total += $item['price'] * $item['quantity'];
        }
        return view('user.checkout.payment', compact('cart_total'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'hinh_thuc_thanh_toan' => 'required',
        ]);

        DB::beginTransaction();

        try {
            // Lấy thông tin địa chỉ và user từ session
            $address = session('shipping_address');
            $userId = session('user_id_checkout');
            if (!$address || !$userId) {
                return redirect()->route('checkout.address')->with('error', 'Vui lòng nhập địa chỉ giao hàng.');
            }

            $user = KhachHang::find($userId);
            if (!$user) {
                return redirect()->route('checkout.address')->with('error', 'Không tìm thấy thông tin khách hàng.');
            }

            // Nối chuỗi địa chỉ
            $fullAddress = $user->dia_chi;

            // Lấy giỏ hàng
            $cart = session('cart', []);
            if (empty($cart)) {
                return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
            }

            $tong_tien = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
            $tong_so_luong = collect($cart)->sum('quantity');

            // Tạo đơn hàng (hoa_don)
            $donHang = DonHang::create([
                'user_id' => $user->id,
                'ngay_mua' => now(),
                'trang_thai' => 'cho_xu_ly',
                'hinh_thuc_thanh_toan' => $request->hinh_thuc_thanh_toan,
                'giam_gia' => 0,
                'tong_tien' => $tong_tien,
                'tong_so_luong' => $tong_so_luong,
                'khuyen_mai_id' => null,
                'dia_chi_giao_hang' => $fullAddress,
            ]);

            // Thêm chi tiết hóa đơn
            foreach ($cart as $item) {
                ChiTietHoaDon::create([
                    'hoa_don_id' => $donHang->id,
                    'sach_id' => $item['id'],
                    'so_luong' => $item['quantity'],
                    'don_gia' => $item['price'],
                    'thanh_tien' => $item['price'] * $item['quantity'],
                ]);
            }

            // Gửi email xác nhận đơn hàng
            Mail::to($user->email)->send(new OrderPlacedMail($donHang, $cart));

            // Xóa giỏ hàng
            session()->forget('cart');
            DB::commit();

            return redirect()->route('cart.index')->with('success', 'Đặt hàng thành công! Vui lòng kiểm tra email.');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}

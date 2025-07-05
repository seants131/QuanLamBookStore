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
    protected function createOrder($hinh_thuc_thanh_toan, $transactionNo = null)
    {
        $address = session('shipping_address');
        $userId = session('user_id_checkout');
        if (!$address || !$userId) {
            return redirect()->route('checkout.address')->with('error', 'Vui lòng nhập địa chỉ giao hàng.');
        }

        $user = KhachHang::find($userId);
        if (!$user) {
            return redirect()->route('checkout.address')->with('error', 'Không tìm thấy thông tin khách hàng.');
        }

        $fullAddress = $user->dia_chi;

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        $tong_tien = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $tong_so_luong = collect($cart)->sum('quantity');

        DB::beginTransaction();

        try {
            $donHang = DonHang::create([
                'user_id' => $user->id,
                'ngay_mua' => now(),
                'trang_thai' => 'cho_xu_ly',
                'hinh_thuc_thanh_toan' => $hinh_thuc_thanh_toan,
                'giam_gia' => 0,
                'tong_tien' => $tong_tien,
                'tong_so_luong' => $tong_so_luong,
                'khuyen_mai_id' => null,
                'dia_chi_giao_hang' => $fullAddress,
                'transaction_no' => $transactionNo,
            ]);

            foreach ($cart as $item) {
                ChiTietHoaDon::create([
                    'hoa_don_id' => $donHang->id,
                    'sach_id' => $item['id'],
                    'so_luong' => $item['quantity'],
                    'don_gia' => $item['price'],
                    'thanh_tien' => $item['price'] * $item['quantity'],
                ]);
            }

            Mail::to($user->email)->send(new OrderPlacedMail($donHang, $cart));

            session()->forget('cart');
            DB::commit();

            return redirect()->route('cart.index')->with('success', 'Đặt hàng thành công! Vui lòng kiểm tra email.');
        } catch (\Exception $e) {
            // DB::rollBack();
            throw $e;
        }
    }
    public function placeOrder(Request $request)
    {
        $request->validate([
            'hinh_thuc_thanh_toan' => 'required',
        ]);

        if ($request->hinh_thuc_thanh_toan == 'vnpay') {
            // Redirect sang route tạo link thanh toán VNPAY
            return redirect()->route('vnpay.payment');
        }

        // COD
        return $this->createOrder('cod');
    }   
    public function createVnpayPayment(Request $request)
    {
        $vnp_TmnCode = "2U7M2JOT";
        $vnp_HashSecret = "A1XPG2WWOA0S6NUQL94H0LKPYSGDRJ6P";
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return');

        $cart = session('cart', []);
        $cart_total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $amount = $cart_total * 100;

        $vnp_TxnRef = uniqid();
        $vnp_OrderInfo = "Thanh toan don hang #" . $vnp_TxnRef;
        $vnp_OrderType = 'billpayment';
        $vnp_Locale = 'vn';
        $vnp_BankCode = '';

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $request->ip(),
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url .= "?" . $query . 'vnp_SecureHash=' . $vnpSecureHash;

        return redirect($vnp_Url);
    }
    public function vnpayReturn(Request $request)
    {
        $vnp_HashSecret = "A1XPG2WWOA0S6NUQL94H0LKPYSGDRJ6P";

        $inputData = $request->all();
        $vnp_SecureHash = $inputData['vnp_SecureHash'] ?? '';

        unset($inputData['vnp_SecureHash']);
        unset($inputData['vnp_SecureHashType']);

        ksort($inputData);
        $hashData = "";
        $i = 0;
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash == $vnp_SecureHash) {
            if ($request->vnp_ResponseCode == '00') {
                // Thành công → gọi tạo đơn hàng
                return $this->createOrder('vnpay', $request->vnp_TransactionNo);
            } else {
                return redirect()->route('cart.index')->with('error', 'Thanh toán thất bại! Mã lỗi: ' . $request->vnp_ResponseCode);
            }
        } else {
            return redirect()->route('cart.index')->with('error', 'Chữ ký không hợp lệ!');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhuyenMai;

class UserCartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['quantity'] * $item['price']);

        // Lấy danh sách khuyến mãi đang hoạt động
        $khuyenMais = KhuyenMai::where('trang_thai', 'kich_hoat')
            ->whereDate('ngay_bat_dau', '<=', now())
            ->whereDate('ngay_ket_thuc', '>=', now())
            ->get();

        return view('user.cart.index', compact('cart', 'total', 'khuyenMais'));
    }

    public function add(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $price = $request->input('price');
        $quantity = $request->input('quantity', 1);
        $image = $request->input('image'); // ảnh sản phẩm

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity,
                'image' => $image,
            ];
        }

        session()->put('cart', $cart);

        // Đếm tổng số lượng sản phẩm trong giỏ hàng
        $cartCount = collect($cart)->sum('quantity');

        // Trả về JSON cho AJAX
        return response()->json([
            'success' => true,
            'message' => 'Đã thêm vào giỏ hàng!',
            'cart_count' => $cartCount
        ]);
    }


    public function remove(Request $request)
    {
        $id = $request->input('id');
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }

    public function applyDiscount(Request $request)
    {
        $km = KhuyenMai::where('id', $request->khuyen_mai_id)
            ->where('trang_thai', 'kich_hoat')
            ->whereDate('ngay_bat_dau', '<=', now())
            ->whereDate('ngay_ket_thuc', '>=', now())
            ->first();

        if (!$km) {
            return response()->json(['success' => false, 'message' => 'Phiếu giảm giá không hợp lệ hoặc đã hết hạn.']);
        }

        session([
            'khuyen_mai_id' => $km->id,
            'khuyen_mai' => [
                'ten' => $km->ten,
                'phan_tram_giam' => $km->phan_tram_giam,
            ]
        ]);

        return response()->json(['success' => true]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sach;
use App\Models\KhuyenMai;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $dsKhuyenMai = KhuyenMai::where('trang_thai', 'kich_hoat')
            ->where('ngay_bat_dau', '<=', now())
            ->where('ngay_ket_thuc', '>=', now())
            ->get();
        return view('user.cart.index', compact('cart', 'dsKhuyenMai'));
    }

    public function addFast(Request $request)
    {
        $book = Sach::findOrFail($request->id);

        if ($book->SoLuong <= 0) {
            return redirect()->back()->with('error', 'Sản phẩm đã hết hàng!');
        }

        $cart = session('cart', []);
        $id = $book->MaSach;
        $qty = $request->input('quantity', 1);

        // Tổng số lượng trong giỏ sau khi thêm
        $currentQty = isset($cart[$id]) ? $cart[$id]['quantity'] : 0;
        if ($qty + $currentQty > $book->SoLuong) {
            return redirect()->back()->with('error', 'Số lượng vượt quá tồn kho!');
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $qty;
        } else {
            $cart[$id] = [
                'id' => $book->MaSach,
                'name' => $book->TenSach,
                'price' => $book->GiaBia,
                'image' => $book->HinhAnh,
                'quantity' => $qty,
            ];
        }

        session(['cart' => $cart]);
        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng!');
    }

    public function remove(Request $request)
    {
        $cart = session('cart', []);
        $id = $request->input('id');
        unset($cart[$id]);
        session(['cart' => $cart]);
        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }

    public function updateAjax(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->input('id');
        $action = $request->input('action');

        if (isset($cart[$id])) {
            $book = Sach::find($id);
            if (!$book || $book->SoLuong <= 0) {
                return response()->json(['success' => false, 'message' => 'Sản phẩm đã hết hàng!']);
            }

            $newQty = $cart[$id]['quantity'];
            if ($action === 'increase') {
                $newQty++;
            } elseif ($action === 'decrease' && $cart[$id]['quantity'] > 1) {
                $newQty--;
            }

            if ($newQty > $book->SoLuong) {
                return response()->json(['success' => false, 'message' => 'Số lượng vượt quá tồn kho!']);
            }

            $cart[$id]['quantity'] = $newQty;
            session()->put('cart', $cart);
            $item = $cart[$id];
            $total = collect($cart)->sum(function ($i) {
                return $i['price'] * $i['quantity'];
            });
            $cartCount = collect($cart)->sum('quantity'); // Thêm dòng này
            return response()->json([
                'success' => true,
                'quantity' => $item['quantity'],
                'item_total' => number_format($item['price'] * $item['quantity'], 0, ',', '.'),
                'cart_total' => number_format($total, 0, ',', '.'),

                'cart_count' => $cartCount, // Trả về số lượng mới
            ]);
        }
        return response()->json(['success' => false]);
    }

    public function removeAjax(Request $request)
    {
        $cart = session('cart', []);
        $id = $request->input('id');
        unset($cart[$id]);
        session(['cart' => $cart]);
        $total = collect($cart)->sum(function ($i) {
            return $i['price'] * $i['quantity'];
        });
        $cartCount = collect($cart)->sum('quantity'); // Thêm dòng này
        return response()->json([
            'success' => true,
            'cart_total' => number_format($total, 0, ',', '.'),

            'cart_count' => $cartCount, // Trả về số lượng mới
        ]);
    }
    public function addAjax(Request $request)
    {
        $book = Sach::find($request->id);
        if (!$book) {
            return response()->json(['success' => false, 'message' => 'Sách không tồn tại!']);
        }
        if ($book->SoLuong <= 0) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm đã hết hàng!']);
        }

        $cart = session('cart', []);
        $id = $book->MaSach;
        $qty = $request->input('quantity', 1);

        $currentQty = isset($cart[$id]) ? $cart[$id]['quantity'] : 0;
        if ($qty + $currentQty > $book->SoLuong) {
            return response()->json(['success' => false, 'message' => 'Số lượng vượt quá tồn kho!']);
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $qty;
        } else {
            $cart[$id] = [
                'id' => $book->MaSach,
                'name' => $book->TenSach,
                'price' => $book->GiaBia,
                'quantity' => $qty,
                'image' => $book->HinhAnh,
            ];
        }

        session(['cart' => $cart]);
        $cartCount = collect($cart)->sum('quantity');
        return response()->json([
            'success' => true,
            'cart_count' => $cartCount,
            'message' => 'Đã thêm vào giỏ hàng!'
        ]);
    }

    public function applyCoupon(Request $request)
    {
        $km = KhuyenMai::find($request->id);
        if(!$km) return response()->json(['success'=>false, 'message'=>'Không tìm thấy khuyến mãi']);
        session(['applied_coupon' => [
            'id' => $km->id,
            'ten' => $km->ten,
            'phan_tram_giam' => $km->phan_tram_giam
        ]]);
        $cart = session('cart', []);
        $total = collect($cart)->sum(function($i){ return $i['price'] * $i['quantity']; });
        $discount = $total * $km->phan_tram_giam / 100;
        return response()->json([
            'success'=>true,
            'cart_total' => number_format($total, 0, ',', '.'),

            'cart_total_final' => number_format($total - $discount, 0, ',', '.')
        ]);
    }

    public function removeCoupon()
    {
        session()->forget('applied_coupon');
        return response()->json(['success'=>true]);
    }
}

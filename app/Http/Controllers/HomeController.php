<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sach;
use App\Models\DanhMuc;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy 9 sách mới nhất có hình ảnh
        $newReleaseSlides = Sach::whereNotNull('HinhAnh')
                                ->where('SoLuong', '>', 0)
                                ->orderBy('created_at', 'desc')
                                ->take(9)
                                ->get();

        $suggestedBooks = Sach::where('SoLuong', '>', 0)
                                ->orderBy('created_at', 'desc')
                                ->take(12)
                                ->get();

        $bestSellerBook = Sach::where('SoLuong', '>', 0)
                                ->orderBy('LuotMua', 'desc')
                                ->first();
        // $categoriesWithBookCounts = DanhMuc::withCount('books')->whereNull('parent_id')->take(6)->get();
        $favoriteBooks = Sach::where('SoLuong', '>', 0)
                                ->orderBy('LuotMua', 'desc')
                                ->take(4)
                                ->get();

        // XÓA 'categoriesWithBookCounts' khỏi compact nếu chưa dùng
        return view('user.home.index', compact(
            'newReleaseSlides',
            'suggestedBooks',
            'bestSellerBook',
            'favoriteBooks'
        ));
    }

    public function dangNhap()
    {
        return view('user.auth.dang_nhap');
    }

    public function postDangNhap()
    {
        return view('user.auth.dang_nhap');
    }

    public function dangXuat()
    {
        return view('user.home.dang_nhap');
    }

    public function dangKy()
    {
        return view('user.auth.dang_ky');
    }

    public function postDangKy()
    {
        return view('user.home.dang_ky');
    }

    public function contact()
    {
        return view('user.home.contact');
    }

    public function bookDetail($slug)
    {
        $book = Sach::where('slug', $slug)->firstOrFail();

        // Sách tương tự: cùng loại, khác mã sách
        $similarBooks = Sach::where('LoaiSanPham', $book->LoaiSanPham)
            ->where('MaSach', '!=', $book->MaSach)
            ->where('SoLuong', '>', 0)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        // Sách yêu thích: nhiều lượt mua nhất
        $favoriteBooks = Sach::where('SoLuong', '>', 0)
            ->orderBy('LuotMua', 'desc')
            ->take(4)
            ->get();

        return view('user.product.chi_tiet_sach', compact('book', 'similarBooks', 'favoriteBooks'));
    }

    public function cart()
    {
        return view('user.cart.thanh_toan');
    }

    public function bookPDF()
    {
        return view('user.home.book-pdf');
    }

    public function searchSachAjax(Request $request)
    {
        $q = $request->input('q');
        $books = Sach::where('TenSach', 'like', '%' . $q . '%')
            ->orWhere('TacGia', 'like', '%' . $q . '%')
            ->where('SoLuong', '>', 0)
            ->limit(10)
            ->get(['MaSach', 'TenSach', 'TacGia', 'HinhAnh', 'slug', 'GiaBia']);

        return response()->json($books);
    }

    public function searchPage(Request $request)
    {
        $q = $request->input('q');
        $books = Sach::where('TenSach', 'like', '%' . $q . '%')
            ->orWhere('TacGia', 'like', '%' . $q . '%')
            ->where('SoLuong', '>', 0)
            ->paginate(16);

        return view('user.home.search', compact('books', 'q'));
    }

    public function booksByCategory($slug)
    {
        // Lấy danh mục theo slug (hoặc bạn có thể dùng id tuỳ ý)
        $danhMuc = DanhMuc::where('slug', $slug)->firstOrFail();

        // Lấy các sách thuộc danh mục này
        $books = Sach::where('danh_muc_id', $danhMuc->id)
            ->where('SoLuong', '>', 0)
            ->paginate(16);

        return view('user.home.category_books', [
            'danhMuc' => $danhMuc,
            'books' => $books,
        ]);
    }
    public function bestseller()
{
    $books = Sach::where('SoLuong', '>', 0)
    ->orderByDesc('LuotMua')
    ->paginate(16);
    return view('user.home.bestseller', compact('books'));
}
}

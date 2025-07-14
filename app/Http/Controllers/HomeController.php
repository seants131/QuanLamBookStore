<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sach;
use App\Models\DanhMuc;
use App\Models\YeuThichSach;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
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

        // Bestseller chung
        $bestSellerBook = Sach::where('SoLuong', '>', 0)
                                ->orderBy('LuotMua', 'desc')
                                ->first();

        // Bestseller theo ngày
        $bestSellerBookDay = Sach::where('SoLuong', '>', 0)
            ->whereDate('updated_at', now()->toDateString())
            ->orderByDesc('LuotMua')
            ->first();

        // Bestseller theo tuần, loại trừ sách đã lấy ở ngày
        $bestSellerBookWeek = Sach::where('SoLuong', '>', 0)
            ->whereBetween('updated_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->when($bestSellerBookDay, function($q) use ($bestSellerBookDay) {
                return $q->where('MaSach', '!=', $bestSellerBookDay->MaSach);
            })
            ->orderByDesc('LuotMua')
            ->first();

        // Bestseller theo tháng, loại trừ sách đã lấy ở ngày và tuần
        $excludeIds = [];
        if ($bestSellerBookDay) $excludeIds[] = $bestSellerBookDay->MaSach;
        if ($bestSellerBookWeek) $excludeIds[] = $bestSellerBookWeek->MaSach;

        $bestSellerBookMonth = Sach::where('SoLuong', '>', 0)
            ->whereMonth('updated_at', now()->month)
            ->whereYear('updated_at', now()->year)
            ->whereNotIn('MaSach', $excludeIds)
            ->orderByDesc('LuotMua')
            ->first();

        // Chỉ lấy 3 danh mục đặc biệt
        $categorySlugs = ['canh-dieu', 'chan-troi-sang-tao', 'ket-noi-tri-thuc-voi-cuoc-song'];
        $categoriesWithBookCounts = DanhMuc::whereIn('slug', $categorySlugs)
            ->get()
            ->map(function($category) {
                $count = Sach::where('danh_muc_id', $category->id)
                    ->where('SoLuong', '>', 0)
                    ->count();
                $category->book_count = $count;
                return $category;
            });

        $favoriteBooks = Sach::where('SoLuong', '>', 0)
                                ->orderBy('LuotMua', 'desc')
                                ->take(4)
                                ->get();

        $favoriteBookIds = [];
        if (Auth::guard('khach')->check()) {
            $favoriteBookIds = YeuThichSach::where('khach_hang_id', Auth::guard('khach')->id())
                ->pluck('sach_id')
                ->toArray();
        }

        // Lấy tất cả sách thuộc danh mục "Cánh Diều"
        $danhMuc = DanhMuc::where('ten', 'Cánh Diều')->first();
        $sachCanhDieu = $danhMuc ? $danhMuc->books : collect();

        // XÓA 'categoriesWithBookCounts' khỏi compact nếu chưa dùng
        return view('user.home.index', compact(
            'newReleaseSlides',
            'suggestedBooks',
            'bestSellerBook',
            'bestSellerBookDay',
            'bestSellerBookWeek',
            'bestSellerBookMonth',
            'favoriteBooks',
            'favoriteBookIds',
            'sachCanhDieu' // Thêm biến sách Cánh Diều vào view
        ));
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
            ->take(5)
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

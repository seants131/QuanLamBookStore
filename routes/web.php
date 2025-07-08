<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\LienHeController;
use App\Http\Controllers\PhieuNhapController;
use App\Http\Controllers\KhuyenMaiController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\ThongKeController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminProfileController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserCheckoutController;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\CartController;
//user
// Route::get('/', [HomeController::class, 'index'])->name('user.welcome');
// sign_in_up
Route::get('/login', function () {
    return redirect()->route('admin.sign-in'); // hoặc đổi sang user login nếu cần
})->name('login');

// Đăng ký
Route::get('/sign-up', [UserAuthController::class, 'showSignupForm'])->name('user.sign-up');
Route::post('/sign-up', [UserAuthController::class, 'signup'])->name('user.sign-up');

// Đăng nhập
Route::get('/sign-in', [UserAuthController::class, 'showSigninForm'])->name('user.sign-in');
Route::post('/sign-in', [UserAuthController::class, 'signin'])->name('user.sign-in');

// Trang đăng ký của admin. Test chức năng đăng ký
Route::get('/admin/register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/admin/register', [AdminAuthController::class, 'register'])->name('admin.register.post');
// Trang đăng nhập của admin. Test chức năng đăng nhập
// Định nghĩa route gốc
Route::get('/admin/sign-in', [AdminAuthController::class, 'showSigninForm'])->name('admin.sign-in');

// Gán alias "login" để Laravel auth middleware có thể redirect về đúng route
Route::get('/admin/login', [AdminAuthController::class, 'showSigninForm'])->name('admin.sign-in');


// Xử lý đăng nhập của admin
Route::post('/admin/sign-in', [AdminAuthController::class, 'signin'])->name('admin.signin');
// Trang đăng xuất của admin
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});
// Auth::routes(); cái này của người dùng mà chưa bt làm.
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('admin.sign-in')->with('success', 'Đăng xuất thành công');
})->name('logout');

//admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

Route::get('/admin/books', [BookController::class, 'index'])->name('admin.books');
Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('books', BookController::class);
    Route::resource('orders', OrderController::class);
    Route::post('/orders/approve', [OrderController::class, 'approve'])->name('orders.approve');
    Route::post('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::get('/orders/{id}/print', [OrderController::class, 'print'])->name('orders.print');
    Route::resource('khachhang', KhachHangController::class);
    Route::resource('lienhe', LienHeController::class);
    Route::resource('phieunhap',PhieuNhapController::class);
    Route::resource('khuyenmai', KhuyenMaiController::class);
    Route::resource('danhmuc', DanhMucController::class);
    Route::get('/profile', [AdminProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/change-password', [AdminProfileController::class, 'changePasswordForm'])->name('profile.password.form');
    Route::post('/profile/change-password', [AdminProfileController::class, 'changePassword'])->name('profile.password');
});

Route::get('/admin/ajax-thong-ke-hoa-don', [ThongKeController::class, 'thongKeHoaDon']);
Route::get('admin/xuat-du-lieu-hoa-don', [ThongKeController::class, 'xuatDuLieuHoaDon']);
Route::get('/ajax-thong-ke-sach', [ThongKeController::class, 'thongKeSach']);
Route::get('/ajax-doanh-so-ngay', [ThongKeController::class, 'doanhSoTheoNgay']);
Route::get('/ajax-thong-ke-trang-thai-don', [ThongKeController::class, 'thongKeTrangThaiDon']);
Route::get('/ajax-ton-kho-va-ban', [ThongKeController::class, 'tonKhoVaBan']);
Route::get('/ajax-tai-chinh', [ThongKeController::class, 'taiChinhTongQuat']);

Route::get('/chinh-sach', function () {
    return view('admin.pages.chinh-sach');
})->name('chinh-sach');

Route::get('/dieu-khoan', function () {
    return view('admin.pages.dieu-khoan');
})->name('dieu-khoan');


Route::get('/signup', [HomeController::class, 'dangKy'])->name('user.auth.dang_ky');
// tạm thời ghi chú lại
// Route::get('/login', [HomeController::class, 'dangNhap'])->name('user.auth.dang_nhap');

Route::get('/', [HomeController::class, 'index'])->name('user.home.index');
Route::get('/categories', [HomeController::class, 'categories'])->name('user.categories.index');
Route::get('/categories/{id}', [HomeController::class, 'categoryDetail'])->name('user.categories.detail');
Route::get('/authors', [HomeController::class, 'authors'])->name('user.authors.index');
Route::get('/authors/{id}', [HomeController::class, 'authorDetail'])->name('user.authors.detail');
Route::get('/contact', [HomeController::class, 'contact'])->name('user.contact.index');
Route::post('/contact', [HomeController::class, 'sendContact'])->name('user.contact.send');
Route::get('/about', [HomeController::class, 'about'])->name('user.about.index');
Route::get('/cart', [HomeController::class, 'cart'])->name('user.cart.index');
Route::post('/cart/add', [HomeController::class, 'addToCart'])->name('user.cart.add');
Route::get('/profile', [UserController::class, 'index'])->name('user.profile.index');
Route::get('/books/pdf', [HomeController::class, 'bookPDF'])->name('user.book.pdf');

Route::prefix('thanh-toan')->name('thanh_toan.')->group(function () {
    Route::get('/test', [UserCheckoutController::class, 'test'])->name('test');
    Route::get('/gio-hang', [UserCheckoutController::class, 'gioHang'])->name('gio_hang');
    Route::get('/dia-chi', [UserCheckoutController::class, 'diaChi'])->name('dia_chi');
    Route::get('/phuong-thuc-thanh-toan', [UserCheckoutController::class, 'phuongThucThanhToan'])->name('pt_thanh_toan');
});


Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update-ajax', [CartController::class, 'updateAjax'])->name('cart.update.ajax');
Route::post('/cart/remove-ajax', [CartController::class, 'removeAjax'])->name('cart.remove.ajax');

Route::get('/sach/{slug}', [HomeController::class, 'bookDetail'])->name('user.books.detail');

Route::middleware(['auth:khach'])->group(function () {
    Route::get('/profile', [UserController::class, 'index'])->name('user.profile.index');
    Route::get('/orders', [UserController::class, 'orders'])->name('user.orders.index');
    Route::get('/orders/{id}', [UserController::class, 'orderDetail'])->name('user.orders.detail');
});
Route::middleware(['web'])->group(function () {
    Route::get('/checkout/address', [UserCheckoutController::class, 'showAddressForm'])->name('checkout.address');
    Route::post('/checkout/submit', [UserCheckoutController::class, 'submitAddress'])->name('checkout.submit');
    Route::get('/checkout/payment', [UserCheckoutController::class, 'goToPayment'])->name('checkout.payment'); // Tùy vào flow bạn
    Route::post('/checkout/place-order', [UserCheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
});
Route::get('/vnpay-payment', [UserCheckoutController::class, 'createVnpayPayment'])->name('vnpay.payment');
Route::get('/vnpay-return', [UserCheckoutController::class, 'vnpayReturn'])->name('vnpay.return');

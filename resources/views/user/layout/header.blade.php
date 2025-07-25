<!-- Sidebar  -->
<div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between">
        <a href="/" class="header-logo">
            <div class="logo-title">
                <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
                <img src="{{ asset('images/logo.ico') }}" class="img-fluid rounded-normal" alt="">
                <span class="text-primary text-uppercase">NHASACH</span>
            </div>
        </a>
    </div>
    <div id="sidebar-scrollbar">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <li class="active active-menu">
                    <a href="/" class="iq-waves-effect"><span class="ripple rippleEffect"></span><i
                            class="las la-home iq-arrow-left"></i><span>Trang Chủ</span><i
                            class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                    <ul id="dashboard" class="iq-submenu collapse show" data-parent="#iq-sidebar-toggle">
                    </ul>
                </li>
                <li>
                    <a href="#ui-elements" class="iq-waves-effect collapsed" data-toggle="collapse"
                        aria-expanded="false"><i class="lab la-elementor iq-arrow-left"></i>
                        <span>Danh mục sản phẩm</span>
                        <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                    </a>
                    <ul id="ui-elements" class="iq-submenu show" data-parent="#iq-sidebar-toggle">
                        @foreach ($danhMucs as $danhMuc)
                            <li class="elements">
                                <a href="{{ route('books.by.category', $danhMuc->slug) }}" class="iq-waves-effect">
                                    <i class="ri-book-line"></i>
                                    <span>{{ $danhMuc->ten }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                {{-- <li>
                <a href="#pages" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="las la-file-alt iq-arrow-left"></i><span>Admin Dashboard</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                <ul id="pages" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                   <li><a href="admin-dashboard.html"><i class="ri-question-answer-line"></i>Dashboard</a></li>

                   <li>
                      <a href="#extra-pages" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="ri-pantone-line"></i><span>Extra Pages</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                      <ul id="extra-pages" class="iq-submenu collapse" data-parent="#pages">
                         <li><a href="pages-invoice.html"><i class="ri-question-answer-line"></i>Invoice</a></li>
                        <li><a href="{{ route('admin.sign-in') }}"><i class="ri-mastercard-line"></i>Login</a></li>
                        <li><a href="{{ route('admin.register') }}"><i class="ri-compasses-line"></i>Register</a></li>
                      </ul>
                   </li>
                </ul>
             </li> --}}
                <li><a href="{{ route('user.bestseller') }}"><i class="ri-book-line"></i>Thịnh hành</a></li>
                <!-- <li><a href="book-pdf.html"><i class="ri-book-line"></i>Sách PDF</a></li> -->
                 <li><a href="{{route('user.lienhe.create')}}"><i class="ri-book-line"></i>Liên hệ</a></li>
            </ul>
        </nav>
    </div>
</div>
<!-- TOP Nav Bar -->
<div class="iq-top-navbar">
    <div class="iq-navbar-custom">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
            <div class="iq-menu-bt d-flex align-items-center">
                <div class="wrapper-menu">
                    <div class="main-circle"><i class="las la-bars"></i></div>
                </div>
                <div class="iq-navbar-logo d-flex justify-content-between">
                    <a href="index.html" class="header-logo">
                        <img src="images/logo.png" class="img-fluid rounded-normal" alt="">
                        <div class="logo-title">
                            <span class="text-primary text-uppercase">img01</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="navbar-breadcrumb">
                {{-- <h5 class="mb-0">{{ $trang ?? 'Web bán sách' }}</h5> --}}
            </div>
            <div class="iq-search-bar position-relative" style="z-index:1000;">
                <form action="{{ route('search.page') }}" class="searchbox" autocomplete="off" method="get"
                    id="main-search-form">
                    <input type="text" class="text search-input" id="search-sach-input" name="q"
                        placeholder="Tìm kiếm sách theo tên..." value="{{ request('q') }}">
                    <a class="search-link" href="#" onclick="$('#main-search-form').submit();return false;"><i
                            class="ri-search-line"></i></a>
                    <div id="search-sach-result" class="bg-white border rounded shadow-sm position-absolute w-100"
                        style="display:none;max-height:350px;overflow-y:auto;top:100%;left:0;z-index:9999;"></div>
                </form>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
                <i class="ri-menu-3-line"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-list">
                    <li class="nav-item nav-icon search-content">
                        <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                            <i class="ri-search-line"></i>
                        </a>
                        <form action="#" class="search-box p-0">
                            <input type="text" class="text search-input" placeholder="Type here to search...">
                            <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                        </form>
                    </li>
                    <li class="nav-item nav-icon">
                        <!-- <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                            <i class="ri-notification-2-line"></i>
                            <span class="bg-primary dots"></span>
                        </a> -->
                        <div class="iq-sub-dropdown">
                            <div class="iq-card shadow-none m-0">
                                <div class="iq-card-body p-0">
                                    <div class="bg-primary p-3">
                                        <h5 class="mb-0 text-white">Thông Báo<small
                                                class="badge  badge-light float-right pt-1">4</small></h5>
                                    </div>
                                    <a href="#" class="iq-sub-card">
                                        <div class="media align-items-center">
                                            <div class="">
                                                <img class="avatar-40 rounded" src="images/user/1.jpg"
                                                    alt="">
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0 ">Đơn hàng giao thành công</h6>
                                                <small class="float-right font-size-12">Just Now</small>
                                                <p class="mb-0">95.000đ</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="iq-sub-card">
                                        <div class="media align-items-center">
                                            <div class="">
                                                <img class="avatar-40 rounded" src="images/user/02.jpg"
                                                    alt="">
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0 ">Đơn hàng giao thành công</h6>
                                                <small class="float-right font-size-12">5 days ago</small>
                                                <p class="mb-0">255.000đ</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="iq-sub-card">
                                        <div class="media align-items-center">
                                            <div class="">
                                                <img class="avatar-40 rounded" src="images/user/03.jpg"
                                                    alt="">
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0 ">Đơn hàng giao thành công</h6>
                                                <small class="float-right font-size-12">2 days ago</small>
                                                <p class="mb-0">79.000đ</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="iq-sub-card">
                                        <div class="media align-items-center">
                                            <div class="">
                                                <img class="avatar-40 rounded" src="images/user/04.jpg"
                                                    alt="">
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0 ">Đơn hàng #7979 giao không thành công</h6>
                                                <small class="float-right font-size-12">3 days ago</small>
                                                <p class="mb-0">100.000đ</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item nav-icon dropdown">
                        <!-- <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                            <i class="ri-mail-line"></i>
                            <span class="bg-primary dots"></span>
                        </a> -->
                        <div class="iq-sub-dropdown">
                            <div class="iq-card shadow-none m-0">
                                {{-- cái này vốn là hộp thư, tin nhăn --}}
                                <div class="iq-card-body p-0 ">
                                    <div class="bg-primary p-3">
                                        <h5 class="mb-0 text-white">Tin Nhắn<small
                                                class="badge  badge-light float-right pt-1">5</small></h5>
                                    </div>
                                    <a href="#" class="iq-sub-card">
                                        <div class="media align-items-center">
                                            <div class="">
                                                <img class="avatar-40 rounded" src="images/user/01.jpg"
                                                    alt="">
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0 ">QT Shop</h6>
                                                <small class="float-left font-size-12">13 Jun</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="iq-sub-card">
                                        <div class="media align-items-center">
                                            <div class="">
                                                <img class="avatar-40 rounded" src="images/user/02.jpg"
                                                    alt="">
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0 ">Tran Thuan Store</h6>
                                                <small class="float-left font-size-12">20 Apr</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="iq-sub-card">
                                        <div class="media align-items-center">
                                            <div class="">
                                                <img class="avatar-40 rounded" src="images/user/03.jpg"
                                                    alt="">
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0 ">Hoang Vu Book</h6>
                                                <small class="float-left font-size-12">30 Jun</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="iq-sub-card">
                                        <div class="media align-items-center">
                                            <div class="">
                                                <img class="avatar-40 rounded" src="images/user/04.jpg"
                                                    alt="">
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0 ">Quang Minh Book</h6>
                                                <small class="float-left font-size-12">12 Sep</small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="iq-sub-card">
                                        <div class="media align-items-center">
                                            <div class="">
                                                <img class="avatar-40 rounded" src="images/user/05.jpg"
                                                    alt="">
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0 ">TV Team</h6>
                                                <small class="float-left font-size-12">5 Dec</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    {{-- <li class="nav-item nav-icon dropdown"> --}}
                    <li class="nav-item nav-icon">
                        <a href="{{ route('cart.index') }}" class="iq-waves-effect text-gray rounded">
                            {{-- <a href="{{ route('cart.index') }}" class="search-toggle iq-waves-effect text-gray rounded"> --}}
                            <i class="ri-shopping-cart-2-line"></i>
                            {{-- dòng dưới giúp hiện thị số lượng sản phẩm trong giỏ hàng --}}
                            <span class="badge badge-danger count-cart rounded-circle">
                                {{ collect(session('cart', []))->sum('quantity') ?: '' }}
                            </span>
                        </a>
                        {{-- dòng dưới giúp hiển thị một vài sách trong giỏ hàng --}}
                        {{-- <div class="iq-sub-dropdown">
                      <div class="iq-card shadow-none m-0">
                         <div class="iq-card-body p-0 toggle-cart-info">
                            <div class="bg-primary p-3">
                               <h5 class="mb-0 text-white">Giỏ Hàng<small class="badge  badge-light float-right pt-1">2</small></h5>
                            </div>
                            <a href="#" class="iq-sub-card">
                               <div class="media align-items-center">
                                  <div class="">
                                     <img class="rounded" src="images/cart/01.jpg" alt="">
                                  </div>
                                  <div class="media-body ml-3">
                                     <h6 class="mb-0 ">Night People book</h6>
                                     <p class="mb-0">$32</p>
                                  </div>
                                  <div class="float-right font-size-24 text-danger"><i class="ri-close-fill"></i></div>
                               </div>
                            </a>
                            <a href="#" class="iq-sub-card">
                               <div class="media align-items-center">
                                  <div class="">
                                     <img class="rounded" src="images/cart/02.jpg" alt="">
                                  </div>
                                  <div class="media-body ml-3">
                                     <h6 class="mb-0 ">The Sin Eater Book</h6>
                                     <p class="mb-0">$40</p>
                                  </div>
                                  <div class="float-right font-size-24 text-danger"><i class="ri-close-fill"></i></div>
                               </div>
                            </a>
                            <div class="d-flex align-items-center text-center p-3">
                               <a class="btn btn-primary mr-2 iq-sign-btn" href="checkout.html" role="button">Giỏ Hàng</a>
                               <a class="btn btn-primary iq-sign-btn" href="checkout.html" role="button">Thanh Toán</a>
                            </div>
                         </div>
                      </div>
                   </div> --}}
                    </li>
                    <li class="line-height pt-3">
                        @php
                            $khach = Auth::guard('khach')->user();
                        @endphp

                        @if ($khach)
                            <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                                <img src="{{ asset('images/user/1.jpg') }}" class="img-fluid rounded-circle mr-3"
                                    alt="user">
                                <div class="caption">
                                    <h6 class="mb-1 line-height">{{ $khach->name }}</h6>
                                    <p class="mb-0 text-primary">
                                        {{ $khach->role === 'admin' ? 'Quản trị viên' : 'Tài Khoản' }}
                                    </p>
                                </div>
                            </a>
                            <div class="iq-sub-dropdown iq-user-dropdown">
                                <div class="iq-card shadow-none m-0">
                                    <div class="iq-card-body p-0 ">
                                        <div class="bg-primary p-3">
                                            <h5 class="mb-0 text-white line-height">Xin Chào {{ $khach->name }}
                                            </h5>
                                        </div>
                                        <a href="{{ route('user.profile.index') }}"
                                            class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-file-user-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0 ">Tài khoản của tôi</h6>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="{{ route('user.orders.index') }}"
                                            class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-account-box-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0 ">Đơn hàng của tôi</h6>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="{{ route('user.favorite.index') }}"
                                            class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-account-box-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0 ">Sách yêu thích</h6>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="d-inline-block w-100 text-center p-3">
                                            <form action="{{ route('user.logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="bg-primary iq-sign-btn"
                                                    style="border:none;">
                                                    Đăng xuất <i class="ri-login-box-line ml-2"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('user.sign-in') }}" class="iq-waves-effect d-flex align-items-center">
                                <img src="{{ asset('images/user/1.jpg') }}" class="img-fluid rounded-circle mr-3"
                                    alt="user">
                                <div class="caption">
                                    <h6 class="mb-1 line-height">Khách</h6>
                                    <p class="mb-0 text-primary">Đăng nhập/Đăng ký</p>
                                </div>
                            </a>
                        @endif
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- TOP Nav Bar END -->
<script>
    // Hiển thị số lượng sản phẩm trong giỏ hàng
    document.addEventListener('DOMContentLoaded', function() {
        const countCart = document.querySelector('.count-cart');
        if (countCart) {
            const cartCount = {{ collect(session('cart', []))->sum('quantity') }};
            countCart.textContent = cartCount > 0 ? cartCount : '';
        }
    });

    $(document).ready(function() {
        let timer = null;
        $('#search-sach-input').on('input', function() {
            clearTimeout(timer);
            let q = $(this).val().trim();
            if (q.length < 2) {
                $('#search-sach-result').hide().empty();
                return;
            }
            timer = setTimeout(function() {
                $.get('{{ route('search.sach.ajax') }}', {
                    q: q
                }, function(data) {
                    let html = '';
                    if (data.length) {
                        html = '<ul class="list-group">';
                        data.forEach(function(book) {
                            html += `<li class="list-group-item d-flex align-items-center">
                            <img src="${book.HinhAnh ? book.HinhAnh : '/images/no-image.png'}" width="40" class="mr-2 rounded" alt="">
                            <div>
                                <a href="/sach/${book.slug}" class="font-weight-bold text-dark">${book.TenSach}</a>
                                <div class="small text-muted">${book.TacGia ? book.TacGia : ''}</div>
                                <div class="small text-danger">${book.GiaBia ? book.GiaBia.toLocaleString() + ' đ' : ''}</div>
                            </div>
                        </li>`;
                        });
                        html +=
                            `<li class="list-group-item text-center"><a href="#" id="see-all-search">Xem tất cả kết quả</a></li>`;
                        $('#search-sach-result').html(html).show();
                    } else {
                        html =
                            '<div class="p-2 text-muted">Không tìm thấy sách phù hợp.</div>';
                        $('#search-sach-result').html(html).show();
                    }
                });
            }, 250);
        });

        // Ẩn gợi ý khi click ngoài
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#search-sach-input, #search-sach-result').length) {
                $('#search-sach-result').hide();
            }
        });

        // Xem tất cả kết quả
        $(document).on('click', '#see-all-search', function(e) {
            e.preventDefault();
            $('#main-search-form').submit();
        });
    });
</script>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sản phẩm - {{ $book->TenSach }} </title>
    @include('user.layout.link_chung')

<body>

    <!-- Wrapper Start -->
    <div class="wrapper">
        {{-- header của trang --}}
        @include('user.layout.header', ['trang' => 'Trang chủ'])
        <!-- Page Content  -->
        <div id="content-page" class="content-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                            <div class="iq-card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0">Thông tin</h4>
                            </div>
                            <div class="iq-card-body pb-0">
                                <div class="description-contens align-items-top row">
                                    <div class="col-md-6">
                                        <div class="iq-card-transparent iq-card-block iq-card-stretch iq-card-height">
                                            <div class="iq-card-body p-0">
                                                <div class="row align-items-center">
                                                    <div class="col-3">
                                                        <ul id="description-slider-nav"
                                                            class="list-inline p-0 m-0  d-flex align-items-center">
                                                            <li>
                                                                <a href="javascript:void(0);">
                                                                    <img src="images/book-dec/01.jpg"
                                                                        class="img-fluid rounded w-100" alt="">
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);">
                                                                    <img src="images/book-dec/02.jpg"
                                                                        class="img-fluid rounded w-100" alt="">
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);">
                                                                    <img src="images/book-dec/03.jpg"
                                                                        class="img-fluid rounded w-100" alt="">
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);">
                                                                    <img src="images/book-dec/04.jpg"
                                                                        class="img-fluid rounded w-100" alt="">
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);">
                                                                    <img src="images/book-dec/05.jpg"
                                                                        class="img-fluid rounded w-100" alt="">
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);">
                                                                    <img src="images/book-dec/06.jpg"
                                                                        class="img-fluid rounded w-100" alt="">
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-9">
                                                        <ul id="description-slider"
                                                            class="list-inline p-0 m-0  d-flex align-items-center">
                                                            <li>
                                                                <a href="javascript:void(0);">
                                                                    <img src="{{ $book->HinhAnh ? asset('uploads/books/' . $book->HinhAnh) : asset('images/default-book-placeholder.jpg') }}"
                                                                        class="img-fluid w-100 rounded"
                                                                        alt="{{ $book->TenSach }}">
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="iq-card-transparent iq-card-block iq-card-stretch iq-card-height">
                                            <div class="iq-card-body p-0">
                                                <h3 class="mb-3">{{ $book->TenSach }}</h3>
                                                <div class="price d-flex align-items-center font-weight-500 mb-2">
                                                    {{-- <span class="font-size-20 pr-2 old-price">{{ number_format($book->GiaBia, 0, ',', '.') }} ₫</span> --}}
                                                    <span
                                                        class="font-size-20 pr-2 newnew-price">{{ number_format($book->GiaBia, 0, ',', '.') }}
                                                        ₫</span>
                                                </div>
                                                <span
                                                    class="text-dark mb-4 pb-4 iq-border-bottom d-block">{{ $book->MoTa }}</span>
                                                <div class="text-primary mb-4">Tác giả: <span
                                                        class="text-body">{{ $book->TacGia }}</span></div>
                                                <div class="mb-4 d-flex align-items-center">
                                                    <a href="javascript:void(0);"
                                                       class="btn btn-primary view-more btn-add-to-cart mr-2"
                                                       data-id="{{ $book->MaSach }}"
                                                       data-quantity="1">
                                                        Thêm vào giỏ hàng
                                                    </a>
                                                    <a href="#" class="btn btn-primary view-more mr-2 btn-buy-now"
                                                       data-id="{{ $book->MaSach }}"
                                                       data-quantity="1">Mua ngay</a>
                                                </div>
                                                <div class="mb-3">
                                                    <a href="javascript:void(0);" 
                                                       class="btn-favorite text-body text-center" 
                                                       data-id="{{ $book->MaSach }}">
                                                        <span class="avatar-30 rounded-circle bg-primary d-inline-block mr-2">
                                                            <i class="ri-heart-fill {{ in_array($book->MaSach, $favoriteBookIds ?? []) ? 'text-danger' : 'text-secondary' }}"></i>
                                                        </span>
                                                        <span class="favorite-text">
                                                            {{ in_array($book->MaSach, $favoriteBookIds ?? []) ? 'Đã yêu thích' : 'Thêm vào danh sách yêu thích' }}
                                                        </span>
                                                    </a>
                                                </div>
                                                {{-- <div class="iq-social d-flex align-items-center">
                                                    <h5 class="mr-2">Chia sẻ:</h5>
                                                    <ul class="list-inline d-flex p-0 mb-0 align-items-center">
                                                        <li>
                                                            <a href="#"
                                                                class="avatar-40 rounded-circle bg-primary mr-2 facebook"><i
                                                                    class="fa fa-facebook" aria-hidden="true"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="avatar-40 rounded-circle bg-primary mr-2 twitter"><i
                                                                    class="fa fa-twitter" aria-hidden="true"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="avatar-40 rounded-circle bg-primary mr-2 youtube"><i
                                                                    class="fa fa-youtube-play"
                                                                    aria-hidden="true"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="avatar-40 rounded-circle bg-primary pinterest"><i
                                                                    class="fa fa-pinterest-p"
                                                                    aria-hidden="true"></i></a>
                                                        </li>
                                                    </ul>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                            <div
                                class="iq-card-header d-flex justify-content-between align-items-center position-relative">
                                <div class="iq-header-title">
                                    <h4 class="card-title mb-0">Sản phẩm tương tự</h4>
                                </div>
                                <div class="iq-card-header-toolbar d-flex align-items-center">
                                    {{-- <a href="category.html" class="btn btn-sm btn-primary view-more">Xem thêm</a> --}}
                                </div>
                            </div>
                            <div class="iq-card-body single-similar-contens">
                                <ul id="single-similar-slider" class="list-inline p-0 mb-0 row">
                                    @foreach ($similarBooks as $similar)
                                        <li class="col-md-3">
                                            <div class="row align-items-center">
                                                <div class="col-5">
                                                    <div class="position-relative image-overlap-shadow">
                                                        <a href="{{ route('user.books.detail', $similar->slug) }}">
                                                            <img class="img-fluid rounded w-100"
                                                                src="{{ $similar->HinhAnh ? asset('uploads/books/' . $similar->HinhAnh) : asset('images/default-book-placeholder.jpg') }}"
                                                                alt="{{ $similar->TenSach }}">
                                                        </a>
                                                        <div class="view-book">
                                                            <a href="{{ route('user.books.detail', $similar->slug) }}"
                                                                class="btn btn-sm btn-white">Xem thêm</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-7 pl-0">
                                                    <h6 class="mb-2">{{ Str::limit($similar->TenSach, 25) }}</h6>
                                                    <p class="text-body">Tác giả : {{ $similar->TacGia }}</p>
                                                    <a href="{{ route('user.books.detail', $similar->slug) }}"
                                                        class="text-dark" tabindex="-1">Đọc ngay<i
                                                            class="ri-arrow-right-s-line"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                            <div
                                class="iq-card-header d-flex justify-content-between align-items-center position-relative">
                                <div class="iq-header-title">
                                    <h4 class="card-title mb-0">Sách Thịnh hành</h4>
                                </div>
                                <div class="iq-card-header-toolbar d-flex align-items-center">
                                    {{-- <a href="category.html" class="btn btn-sm btn-primary view-more">Xem thêm</a> --}}
                                </div>
                            </div>
                            {{-- <div class="iq-card-body favorites-contens">
                                <ul id="favorites-slider" class="list-inline p-0 mb-0 row">
                                    @foreach ($favoriteBooks as $favBook)
                                        <li class="col-md-4">
                                            <div class="d-flex align-items-center">
                                                <div class="col-5 p-0 position-relative">
                                                    <a href="{{ route('user.books.detail', $favBook->slug) }}">
                                                        <img src="{{ $favBook->HinhAnh ? asset('uploads/books/' . $favBook->HinhAnh) : asset('images/default-book-placeholder.jpg') }}"
                                                            class="img-fluid rounded w-100"
                                                            alt="{{ $favBook->TenSach }}">
                                                    </a>
                                                </div>
                                                <div class="col-7">
                                                    <h5 class="mb-2">{{ $favBook->TenSach }}</h5>
                                                    <p class="mb-2">Tác giả : {{ $favBook->TacGia }}</p>
                                                    <div
                                                        class="d-flex justify-content-between align-items-center text-dark font-size-13">
                                                        <span>Đã bán</span>
                                                        <span class="mr-4">{{ $favBook->LuotMua }}</span>
                                                    </div>
                                                    <a href="{{ route('user.books.detail', $favBook->slug) }}"
                                                        class="text-dark">Đọc ngay<i
                                                            class="ri-arrow-right-s-line"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                            <div class="iq-card-header d-flex justify-content-between align-items-center position-relative mb-0">
                                <div class="iq-header-title">
                                    <h4 class="card-title mb-0">Sách mới nhất</h4>
                                </div>
                                {{-- <div class="iq-card-header-toolbar d-flex align-items-center">
                                    <a href="{{ route('user.home') }}" class="btn btn-sm btn-primary view-more">Xem thêm</a>
                                </div> --}}
                            </div>
                            <div class="iq-card-body trendy-contens">
                                <ul id="latest-slider" class="list-inline p-0 mb-0 row">
                                    @foreach ($latestBooks as $latest)
                                        <li class="col-md-3">
                                            <div class="d-flex align-items-center">
                                                <div class="col-5 p-0 position-relative image-overlap-shadow">
                                                    <a href="{{ route('user.books.detail', $latest->slug) }}">
                                                        <img class="img-fluid rounded w-100"
                                                             src="{{ $latest->HinhAnh ? asset('uploads/books/' . $latest->HinhAnh) : asset('images/default-book-placeholder.jpg') }}"
                                                             alt="{{ $latest->TenSach }}">
                                                    </a>
                                                    <div class="view-book">
                                                        <a href="{{ route('user.books.detail', $latest->slug) }}" class="btn btn-sm btn-white">Xem sách</a>
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <div class="mb-2">
                                                        <h6 class="mb-1">{{ Str::limit($latest->TenSach, 25) }}</h6>
                                                        <p class="font-size-13 line-height mb-1">{{ $latest->TacGia }}</p>
                                                    </div>
                                                    <div class="price d-flex align-items-center">
                                                        <h6><b>{{ number_format($latest->GiaBia, 0, ',', '.') }} ₫</b></h6>
                                                    </div>
                                                    <div class="iq-product-action">
                                                        <a href="javascript:void();"><i class="ri-shopping-cart-2-fill text-primary"></i></a>
                                                        <a href="javascript:void();" class="ml-2"><i class="ri-heart-fill text-danger"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Wrapper END -->
    <!-- Footer -->
    @include('user.layout.footer')
    <!-- Footer END -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Appear JavaScript -->
    <script src="{{ asset('js/jquery.appear.js') }}"></script>
    <!-- Countdown JavaScript -->
    <script src="{{ asset('js/countdown.min.js') }}"></script>
    <!-- Counterup JavaScript -->
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <!-- Wow JavaScript -->
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <!-- Apexcharts JavaScript -->
    <script src="{{ asset('js/apexcharts.js') }}"></script>
    <!-- Slick JavaScript -->
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <!-- Select2 JavaScript -->
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <!-- Owl Carousel JavaScript -->
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <!-- Magnific Popup JavaScript -->
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Smooth Scrollbar JavaScript -->
    <script src="{{ asset('js/smooth-scrollbar.js') }}"></script>
    <!-- lottie JavaScript -->
    <script src="{{ asset('js/lottie.js') }}"></script>
    <!-- am core JavaScript -->
    <script src="{{ asset('js/core.js') }}"></script>
    <!-- am charts JavaScript -->
    <script src="{{ asset('js/charts.js') }}"></script>
    <!-- am animated JavaScript -->
    <script src="{{ asset('js/animated.js') }}"></script>
    <!-- am kelly JavaScript -->
    <script src="{{ asset('js/kelly.js') }}"></script>
    <!-- am maps JavaScript -->
    <script src="{{ asset('js/maps.js') }}"></script>
    <!-- am worldLow JavaScript -->
    <script src="{{ asset('js/worldLow.js') }}"></script>
    <!-- Raphael-min JavaScript -->
    <script src="{{ asset('js/raphael-min.js') }}"></script>
    <!-- Morris JavaScript -->
    <script src="{{ asset('js/morris.js') }}"></script>
    <!-- Morris min JavaScript -->
    <script src="{{ asset('js/morris.min.js') }}"></script>
    <!-- Flatpicker Js -->
    <script src="{{ asset('js/flatpickr.js') }}"></script>
    <!-- Style Customizer -->
    <script src="{{ asset('js/style-customizer.js') }}"></script>
    <!-- Chart Custom JavaScript -->
    <script src="{{ asset('js/chart-custom.js') }}"></script>
    <!-- Custom JavaScript -->
    <script src="{{ asset('js/custom.js') }}"></script>
    @include('user.layout.script_chung')
    <script>
        $(document).on('click', '.btn-add-to-cart', function(e) {
            e.preventDefault();
            var bookId = $(this).data('id');
            var quantity = $(this).data('quantity') || 1;
            $.ajax({
                url: "{{ route('cart.add.ajax') }}",
                method: "POST",
                data: {
                    id: bookId,
                    quantity: quantity,
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    if (res.success) {
                        $('.count-cart').text(res.cart_count > 0 ? res.cart_count : '');
                    } else {
                        alert(res.message || 'Có lỗi xảy ra!');
                    }
                },
                error: function() {
                    alert('Có lỗi xảy ra!');
                }
            });
        });
    </script>
    <script>
        $(document).on('click', '.btn-buy-now', function(e) {
            e.preventDefault();
            var bookId = $(this).data('id');
            var quantity = $(this).data('quantity') || 1;
            $.ajax({
                url: "{{ route('cart.add.ajax') }}",
                method: "POST",
                data: {
                    id: bookId,
                    quantity: quantity,
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    if (res.success) {
                        window.location.href = "{{ route('cart.index') }}";
                    } else {
                        alert(res.message || 'Có lỗi xảy ra!');
                    }
                },
                error: function() {
                    alert('Có lỗi xảy ra!');
                }
            });
        });
    </script>
</body>

</html>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Kết quả tìm kiếm</title>
    @include('user.layout.link_chung')
</head>

<body>
    <div class="wrapper">
        @include('user.layout.header', ['trang' => 'Tìm kiếm'])
        <div id="content-page" class="content-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 mb-3">
                        <h4 class="card-title mb-0">Kết quả tìm kiếm cho: <span
                                class="text-primary">{{ $q }}</span></h4>
                    </div>
                </div>
                <div class="row">
                    @forelse($books as $book)
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                            <div class="iq-card iq-card-block iq-card-stretch iq-card-height browse-bookcontent">
                                <div class="iq-card-body p-0">
                                    <div class="d-flex align-items-center">
                                        <div class="col-6 p-0 position-relative image-overlap-shadow">
                                            <a href="{{ route('user.books.detail', $book->slug) }}">
                                                <img class="img-fluid rounded w-100"
                                                    src="{{ $book->HinhAnh ? asset('uploads/books/' . $book->HinhAnh) : asset('images/default-book-placeholder.jpg') }}"
                                                    alt="{{ $book->TenSach }}">
                                            </a>
                                            <div class="view-book">
                                                <a href="{{ route('user.books.detail', $book->slug) }}"
                                                    class="btn btn-sm btn-white">Xem</a>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-2">
                                                <h6 class="mb-1" title="{{ $book->TenSach }}">
                                                    {{ Str::limit($book->TenSach, 30) }}</h6>
                                                <p class="font-size-13 line-height mb-1">{{ $book->TacGia ?: 'N/A' }}
                                                </p>
                                            </div>
                                            <div class="price d-flex align-items-center">
                                                <h6><b>{{ number_format($book->GiaBia, 0, ',', '.') }} đ</b></h6>
                                            </div>
                                            <div class="iq-product-action">
                                                <a href="javascript:void(0);" 
                                                   class="btn-add-to-cart" 
                                                   data-id="{{ $book->MaSach }}" 
                                                   title="Thêm vào giỏ hàng">
                                                    <i class="ri-shopping-cart-2-fill text-primary"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center text-muted py-5">Không tìm thấy sách phù hợp.</div>
                    @endforelse
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {{ $books->appends(['q' => $q])->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    @include('user.layout.footer')
    <!-- JS -->

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.appear.js') }}"></script>
    <script src="{{ asset('js/countdown.min.js') }}"></script>
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/apexcharts.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/smooth-scrollbar.js') }}"></script>
    <script src="{{ asset('js/lottie.js') }}"></script>
    <script src="{{ asset('js/core.js') }}"></script>
    <script src="{{ asset('js/charts.js') }}"></script>
    <script src="{{ asset('js/animated.js') }}"></script>
    <script src="{{ asset('js/kelly.js') }}"></script>
    <script src="{{ asset('js/maps.js') }}"></script>
    <script src="{{ asset('js/worldLow.js') }}"></script>
    <script src="{{ asset('js/raphael-min.js') }}"></script>
    <script src="{{ asset('js/morris.js') }}"></script>
    <script src="{{ asset('js/morris.min.js') }}"></script>
    <script src="{{ asset('js/flatpickr.js') }}"></script>
    <script src="{{ asset('js/style-customizer.js') }}"></script>
    <script src="{{ asset('js/chart-custom.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    @include('user.layout.script_chung')
</body>

</html>

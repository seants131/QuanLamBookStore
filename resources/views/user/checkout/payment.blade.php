{{-- filepath: resources/views/user/checkout/payment.blade.php --}}
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chọn phương thức thanh toán</title>
    @include('user.layout.link_chung')
    <style>
        body,
        label,
        .card-title,
        .iq-header-title,
        .shipping-address p,
        .mb-2,
        .btn,
        .form-control,
        .alert,
        .text-dark,
        .form-group label {
            color: #222 !important;
        }

        .form-control {
            color: #222 !important;
        }
    </style>
</head>

<body>
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center"></div>
    </div>
    <!-- loader END -->
    <div class="wrapper">
        @include('user.layout.header', ['trang' => 'Thanh toán'])
        <div id="content-page" class="content-page">
            <div class="container-fluid checkout-content">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Chọn phương thức thanh toán</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">

                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('checkout.placeOrder') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="vnpay"
                                                name="hinh_thuc_thanh_toan" value="vnpay" required>
                                            <label class="form-check-label" for="vnpay">
                                                Thanh toán VNPay
                                            </label>
                                        </div>
                                        {{-- <div class="form-check">
                                            <input class="form-check-input" type="radio" id="momo"
                                                name="hinh_thuc_thanh_toan" value="momo_zalopay">
                                            <label class="form-check-label" for="momo">
                                                Momo/ZaloPay
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="installment"
                                                name="hinh_thuc_thanh_toan" value="installment">
                                            <label class="form-check-label" for="installment">
                                                Trả góp
                                            </label>
                                        </div> --}}
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="cod"
                                                name="hinh_thuc_thanh_toan" value="tien_mat">
                                            <label class="form-check-label" for="cod">
                                                Thanh toán khi giao hàng (COD)
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3">Tiếp tục</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="iq-card">
                            <div class="iq-card-body">
                                <h4 class="mb-2">Chi tiết đơn hàng</h4>

                                @php
                                    $address = session('shipping_address');
                                @endphp

                                @if ($address)
                                    <div class="mb-2" style="background: #f8f9fa; border-radius: 6px; padding: 12px;">
                                        <strong>Địa chỉ giao hàng:</strong><br>
                                        {{ $address['fname'] ?? '' }}<br>
                                        {{ $address['houseno'] ?? '' }},
                                        {{ $address['phuong'] ?? ($address['state'] ?? '') }},
                                        {{ $address['quan'] ?? ($address['district'] ?? '') }},
                                        {{ $address['city'] ?? '' }}<br>
                                        SĐT: {{ $address['mno'] ?? '' }}<br>
                                        Email: {{ $address['email'] ?? '' }}
                                    </div>
                                @endif

                                <div class="d-flex justify-content-between">
                                    <span>Giá sản phẩm</span>
                                    <span><strong>{{ number_format($cart_total, 0, ',', '.') }}đ</strong></span>
                                </div>
                                @if (session('applied_coupon'))
                                    @php
                                        $coupon = session('applied_coupon');
                                        $giam_gia = $cart_total * $coupon['phan_tram_giam'] / 100;
                                    @endphp
                                    <div class="d-flex justify-content-between">
                                        <span>Giảm giá ({{ $coupon['ten'] ?? '' }})</span>
                                        <span class="text-danger">-{{ number_format($giam_gia, 0, ',', '.') }}đ</span>
                                    </div>
                                @else
                                    @php $giam_gia = 0; @endphp
                                @endif
                                <div class="d-flex justify-content-between">
                                    <span>Phí vận chuyển</span>
                                    <span class="text-success">Miễn phí</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span>Số tiền phải trả</span>
                                    <span>
                                        <strong>{{ number_format($cart_total - $giam_gia, 0, ',', '.') }}đ</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="iq-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="#">Chính sách bảo mật</a></li>
                        <li class="list-inline-item"><a href="#">Điều khoản sử dụng</a></li>
                    </ul>
                </div>
                <div class="col-lg-6 text-right">
                    Copyright 2020 <a href="#">TVteam</a> Đã đăng kí
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer END -->

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
</body>

</html>

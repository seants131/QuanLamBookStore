<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Profile</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="css/typography.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    @include('user.layout.link_chung')
</head>

<body class="sidebar-main-active right-column-fixed">
    <!-- loader Start -->
    @include('user.layout.header')
    <!-- TOP Nav Bar -->
    <!-- TOP Nav Bar END -->
    <!-- Page Content  -->
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <!-- Tabs -->
                <div class="col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-body p-0">
                            <div class="iq-edit-list">
                                <ul class="iq-edit-profile d-flex nav nav-pills">
                                    <li class="col-md-4 p-0">
                                        <a class="nav-link active" data-toggle="pill" href="#personal-information">
                                            Thông tin cá nhân
                                        </a>
                                    </li>
                                    <li class="col-md-4 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#chang-pwd">
                                            Đổi mật khẩu
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab Content -->
                <div class="col-lg-12">
                    <div class="iq-edit-list-data">
                        <div class="tab-content">

                            <!-- Thông tin cá nhân -->
                            <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                                <div class="iq-card">
                                    <div class="iq-card-header d-flex justify-content-between">
                                        <h4 class="card-title">Thông tin cá nhân</h4>
                                    </div>
                                    <div class="iq-card-body">
                                        <form action="{{ route('user.profile.update') }}" method="POST">
                                            @csrf
                                            <div class="row align-items-center">
                                                <div class="form-group col-sm-6">
                                                    <label>Tên hiển thị:</label>
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ $user->name }}" required>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label>Email:</label>
                                                    <input type="email" class="form-control"
                                                        value="{{ $user->email }}" disabled>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label>Địa chỉ:</label>
                                                    <textarea name="dia_chi" class="form-control" rows="4">{{ $user->dia_chi ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Đổi mật khẩu -->
                            <div class="tab-pane fade" id="chang-pwd" role="tabpanel">
                                <div class="iq-card">
                                    <div class="iq-card-header d-flex justify-content-between">
                                        <h4 class="card-title">Đổi mật khẩu</h4>
                                    </div>
                                    <div class="iq-card-body">
                                        <form action="{{ route('user.profile.password') }}" method="POST">
                                            @csrf
                                            <div class="form-group position-relative">
                                                <label>Mật khẩu hiện tại:</label>
                                                <input type="password" name="current_password"
                                                    class="form-control password-field" required>
                                                <i class="toggle-password ri-eye-line"></i>
                                            </div>
                                            <div class="form-group position-relative">
                                                <label>Mật khẩu mới:</label>
                                                <input type="password" name="password"
                                                    class="form-control password-field" required>
                                                <i class="toggle-password ri-eye-line"></i>
                                            </div>
                                            <div class="form-group position-relative">
                                                <label>Xác nhận mật khẩu:</label>
                                                <input type="password" name="password_confirmation"
                                                    class="form-control password-field" required>
                                                <i class="toggle-password ri-eye-line"></i>
                                            </div>
                                            <button type="submit" class="btn btn-warning">Đổi mật khẩu</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- tab-content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* Định dạng cho các tab */
        .iq-edit-profile .nav-link {
            border: 1px solid transparent;
            border-radius: 4px;
            padding: 10px 15px;
            transition: background-color 0.3s, color 0.3s;
        }

        .iq-edit-profile .nav-link.active {
            background-color: #007bff;
            color: #fff;
        }

        .iq-edit-profile .nav-link:hover {
            background-color: #e7f1ff;
        }

        /* Định dạng cho các card */
        .iq-card {
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        /* Định dạng cho các nút */
        .btn-primary,
        .btn-warning {
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-primary:hover,
        .btn-warning:hover {
            transform: scale(1.05);
        }

        /* Định dạng cho form */
        .form-control {
            border-radius: 4px;
            border: 1px solid #ced4da;
        }

        .profile-img-edit {
            position: relative;
            display: inline-block;
        }

        .upload-button {
            position: absolute;
            bottom: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 20px;
            color: #fff;
            background-color: #007bff;
            border-radius: 50%;
            padding: 5px;
        }

        .toggle-password {
            position: absolute;
            top: 38px;
            right: 15px;
            cursor: pointer;
            font-size: 20px;
            color: #999;
        }


        /* Responsive */
        @media (max-width: 768px) {
            .iq-edit-profile .nav-link {
                font-size: 14px;
            }

            .btn-primary,
            .btn-warning {
                width: 100%;
                margin-top: 10px;
            }
        }
    </style>

    <script>
        document.querySelectorAll('.toggle-password').forEach(function(icon) {
            icon.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                this.classList.toggle('ri-eye-line');
                this.classList.toggle('ri-eye-off-line');
            });
        });
    </script>
    </div>
    <!-- Wrapper END -->
    <!-- Footer -->
    @include('user.layout.footer')
    <!-- Footer END -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Appear JavaScript -->
    <script src="js/jquery.appear.js"></script>
    <!-- Countdown JavaScript -->
    <script src="js/countdown.min.js"></script>
    <!-- Counterup JavaScript -->
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <!-- Wow JavaScript -->
    <script src="js/wow.min.js"></script>
    <!-- Apexcharts JavaScript -->
    <script src="js/apexcharts.js"></script>
    <!-- Slick JavaScript -->
    <script src="js/slick.min.js"></script>
    <!-- Select2 JavaScript -->
    <script src="js/select2.min.js"></script>
    <!-- Owl Carousel JavaScript -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- Magnific Popup JavaScript -->
    <script src="js/jquery.magnific-popup.min.js"></script>
    <!-- Smooth Scrollbar JavaScript -->
    <script src="js/smooth-scrollbar.js"></script>
    <!-- lottie JavaScript -->
    <script src="js/lottie.js"></script>
    <!-- am core JavaScript -->
    <script src="js/core.js"></script>
    <!-- am charts JavaScript -->
    <script src="js/charts.js"></script>
    <!-- am animated JavaScript -->
    <script src="js/animated.js"></script>
    <!-- am kelly JavaScript -->
    <script src="js/kelly.js"></script>
    <!-- am maps JavaScript -->
    <script src="js/maps.js"></script>
    <!-- am worldLow JavaScript -->
    <script src="js/worldLow.js"></script>
    <!-- Style Customizer -->
    <script src="js/style-customizer.js"></script>
    <!-- Chart Custom JavaScript -->
    <script src="js/chart-custom.js"></script>
    <!-- Custom JavaScript -->
    <script src="js/custom.js"></script>
</body>

</html>

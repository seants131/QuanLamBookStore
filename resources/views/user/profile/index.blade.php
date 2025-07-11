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
</head>

<body class="sidebar-main-active right-column-fixed">
    <!-- loader Start -->
    @include('user.layout.header')
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
                                <span class="text-primary text-uppercase">Booksto</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="navbar-breadcrumb">
                    <h5 class="mb-0">User Profile</h5>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                        </ul>
                    </nav>
                </div>
                <div class="iq-search-bar">
                    <form action="#" class="searchbox">
                        <input type="text" class="text search-input" placeholder="Search Here...">
                        <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                    </form>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-label="Toggle navigation">
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
                            <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                                <i class="ri-notification-2-fill"></i>
                                <span class="bg-primary dots"></span>
                            </a>
                            <div class="iq-sub-dropdown">
                                <div class="iq-card shadow-none m-0">
                                    <div class="iq-card-body p-0">
                                        <div class="bg-primary p-3">
                                            <h5 class="mb-0 text-white">All Notifications<small
                                                    class="badge  badge-light float-right pt-1">4</small></h5>
                                        </div>
                                        <a href="#" class="iq-sub-card">
                                            <div class="media align-items-center">
                                                {{-- <div class="">
                                                    <img class="avatar-40 rounded" src="images/user/01.jpg"
                                                        alt="">
                                                </div> --}}
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0 ">Emma Watson Barry</h6>
                                                    <small class="float-right font-size-12">Just Now</small>
                                                    <p class="mb-0">95 MB</p>
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
                                                    <h6 class="mb-0 ">New customer is join</h6>
                                                    <small class="float-right font-size-12">5 days ago</small>
                                                    <p class="mb-0">Cyst Barry</p>
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
                                                    <h6 class="mb-0 ">Two customer is left</h6>
                                                    <small class="float-right font-size-12">2 days ago</small>
                                                    <p class="mb-0">Cyst Barry</p>
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
                                                    <h6 class="mb-0 ">New Mail from Fenny</h6>
                                                    <small class="float-right font-size-12">3 days ago</small>
                                                    <p class="mb-0">Cyst Barry</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item nav-icon dropdown">
                            <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <span class="bg-primary count-mail"></span>
                            </a>
                            <div class="iq-sub-dropdown">
                                <div class="iq-card shadow-none m-0">
                                    <div class="iq-card-body p-0 ">
                                        <div class="bg-primary p-3">
                                            <h5 class="mb-0 text-white">All Messages<small
                                                    class="badge  badge-light float-right pt-1">5</small></h5>
                                        </div>
                                        <a href="#" class="iq-sub-card">
                                            <div class="media align-items-center">
                                                <div class="">
                                                    <img class="avatar-40 rounded" src="images/user/01.jpg"
                                                        alt="">
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0 ">Barry Emma Watson</h6>
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
                                                    <h6 class="mb-0 ">Lorem Ipsum Watson</h6>
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
                                                    <h6 class="mb-0 ">Why do we use it?</h6>
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
                                                    <h6 class="mb-0 ">Variations Passages</h6>
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
                                                    <h6 class="mb-0 ">Lorem Ipsum generators</h6>
                                                    <small class="float-left font-size-12">5 Dec</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item nav-icon dropdown">
                            <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                                <i class="ri-shopping-cart-2-line"></i>
                                <span class="badge badge-danger count-cart rounded-circle">4</span>
                            </a>
                            <div class="iq-sub-dropdown">
                                <div class="iq-card shadow-none m-0">
                                    <div class="iq-card-body p-0 toggle-cart-info">
                                        <div class="bg-primary p-3">
                                            <h5 class="mb-0 text-white">All Carts<small
                                                    class="badge  badge-light float-right pt-1">4</small></h5>
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
                                                <div class="float-right font-size-24 text-danger"><i
                                                        class="ri-close-fill"></i></div>
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
                                                <div class="float-right font-size-24 text-danger"><i
                                                        class="ri-close-fill"></i></div>
                                            </div>
                                        </a>
                                        <a href="#" class="iq-sub-card">
                                            <div class="media align-items-center">
                                                <div class="">
                                                    <img class="rounded" src="images/cart/03.jpg" alt="">
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0 ">the Orange Tree</h6>
                                                    <p class="mb-0">$30</p>
                                                </div>
                                                <div class="float-right font-size-24 text-danger"><i
                                                        class="ri-close-fill"></i></div>
                                            </div>
                                        </a>
                                        <a href="#" class="iq-sub-card">
                                            <div class="media align-items-center">
                                                <div class="">
                                                    <img class="rounded" src="images/cart/04.jpg" alt="">
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0 ">Harsh Reality book</h6>
                                                    <p class="mb-0">$25</p>
                                                </div>
                                                <div class="float-right font-size-24 text-danger"><i
                                                        class="ri-close-fill"></i></div>
                                            </div>
                                        </a>
                                        <div class="d-flex align-items-center text-center p-3">
                                            <a class="btn btn-primary mr-2 iq-sign-btn" href="#"
                                                role="button">View Cart</a>
                                            <a class="btn btn-primary iq-sign-btn" href="#" role="button">Shop
                                                now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="line-height pt-3">
                            <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                                <img src="images/user/1.jpg" class="img-fluid rounded-circle mr-3" alt="user">
                                <div class="caption">
                                    <h6 class="mb-1 line-height">Barry Tech</h6>
                                    <p class="mb-0 text-primary">$20.32</p>
                                </div>
                            </a>
                            <div class="iq-sub-dropdown iq-user-dropdown">
                                <div class="iq-card shadow-none m-0">
                                    <div class="iq-card-body p-0 ">
                                        <div class="bg-primary p-3">
                                            <h5 class="mb-0 text-white line-height">Hello Barry Tech</h5>
                                            <span class="text-white font-size-12">Available</span>
                                        </div>
                                        <a href="profile.html" class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-file-user-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0 ">My Profile</h6>
                                                    <p class="mb-0 font-size-12">View personal profile details.</p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="profile-edit.html" class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-profile-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0 ">Edit Profile</h6>
                                                    <p class="mb-0 font-size-12">Modify your personal details.</p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="account-setting.html" class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-account-box-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0 ">Account settings</h6>
                                                    <p class="mb-0 font-size-12">Manage your account parameters.
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="privacy-setting.html" class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="ri-lock-line"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0 ">Privacy Settings</h6>
                                                    <p class="mb-0 font-size-12">Control your privacy parameters.
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="d-inline-block w-100 text-center p-3">
                                            <a class="bg-primary iq-sign-btn" href="sign-in.html" role="button">Sign
                                                out<i class="ri-login-box-line ml-2"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
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
                                    <li class="col-md-4 p-0">
                                        <a class="nav-link" data-toggle="pill" href="#manage-contact">
                                            Quản lý liên hệ
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
                                        <form action="{{ route('admin.profile.update') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row align-items-center">
                                                {{-- <div class="col-md-12">
                                                    <div class="profile-img-edit">
                                                        <img class="profile-pic"
                                                            src="{{ asset($user->avatar ?? 'images/user/default.jpg') }}"
                                                            alt="avatar">

                                                        <i class="ri-pencil-line upload-button"></i>
                                                        <input class="file-upload" type="file" name="avatar"
                                                            accept="image/*" />

                                                    </div>
                                                </div> --}}
                                            </div>
                                            <div class="row align-items-center">
                                                <div class="form-group col-sm-6">
                                                    <label>Tên:</label>
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ $user->name }}">
                                                </div>
                                                {{-- <div class="form-group col-sm-6">
                                                    <label>Email:</label>
                                                    <input type="email" name="email" class="form-control"
                                                        value="{{ $user->email }}">
                                                </div> --}}
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
                                        <form action="{{ route('admin.profile.password') }}" method="POST">
                                            @csrf
                                            <div class="form-group position-relative">
                                                <label>Mật khẩu hiện tại:</label>
                                                <input type="password" name="current_password"
                                                    class="form-control password-field">
                                                <i class="toggle-password ri-eye-line"></i>
                                            </div>

                                            <div class="form-group position-relative">
                                                <label>Mật khẩu mới:</label>
                                                <input type="password" name="password"
                                                    class="form-control password-field">
                                                <i class="toggle-password ri-eye-line"></i>
                                            </div>

                                            <div class="form-group position-relative">
                                                <label>Xác nhận mật khẩu:</label>
                                                <input type="password" name="password_confirmation"
                                                    class="form-control password-field">
                                                <i class="toggle-password ri-eye-line"></i>
                                            </div>

                                            <button type="submit" class="btn btn-warning">Đổi mật khẩu</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Quản lý liên hệ -->
                            <div class="tab-pane fade" id="manage-contact" role="tabpanel">
                                <div class="iq-card">
                                    <div class="iq-card-header d-flex justify-content-between">
                                        <h4 class="card-title">Quản lý liên hệ</h4>
                                    </div>
                                    <div class="iq-card-body">
                                        <form action="{{ route('admin.profile.contact.update') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label>Số điện thoại:</label>
                                                <input type="text" name="so_dien_thoai" class="form-control"
                                                    value="{{ $user->so_dien_thoai ?? '' }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Địa chỉ:</label>
                                                <textarea name="dia_chi" class="form-control">{{ $user->dia_chi ?? '' }}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Lưu liên hệ</button>
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

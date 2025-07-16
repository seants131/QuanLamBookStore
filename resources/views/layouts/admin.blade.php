<!DOCTYPE html>
<html lang="vi">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Admin Dashboard - NHASACHTV</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
      <!-- admin CSS -->
      <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="{{ asset('css/typography.css') }}">
      <!-- Style CSS -->
      <link rel="stylesheet" href="{{ asset('css/style.css') }}">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
      <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
      <link rel="stylesheet" href="{{ asset('css/Chart.min.css') }}">
      <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
      <link rel="stylesheet" href="{{ asset('css/developer.css') }}">
      <link rel="stylesheet" href="{{ asset('css/dripicons.css') }}">
      <link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}">
      <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
      <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">
      <link rel="stylesheet" href="{{ asset('css/line-awesome.min.css') }}">
      <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
      <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
      <link rel="stylesheet" href="{{ asset('css/remixicon.css') }}">
      <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
      <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
      <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
      <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
      <link rel="stylesheet" href="{{ asset('css/style-customizer.css') }}">
      <link rel="stylesheet" href="{{ asset('css/variable.css') }}">
      @yield('styles')
</head>

<body>
     <!-- loader Start -->
     <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
       <!-- Wrapper Start -->
       <div class="wrapper">
         <!-- Sidebar  -->
         <div class="iq-sidebar">
            <div class="iq-sidebar-logo d-flex justify-content-between">
               <a href="admin-dashboard.html" class="header-logo">
                  <img src="" class="img-fluid rounded-normal" alt="">
                  <a href="{{ route('admin.index') }}">
                     <div class="logo-title">
                        <span class="text-primary text-uppercase">NhasachTV</span>
                     </div>
                  </a>
               </a>
               <div class="iq-menu-bt-sidebar">
                  <div class="iq-menu-bt align-self-center">
                     <div class="wrapper-menu">
                        <div class="main-circle"><i class="las la-bars"></i></div>
                     </div>
                  </div>
               </div>
            </div>
            <div id="sidebar-scrollbar">
               <nav class="iq-sidebar-menu">
               <ul id="iq-sidebar-toggle" class="iq-menu">
                  <li><a href="{{ route('admin.index') }}"><i class="las la-home iq-arrow-left"></i>Bảng Điều Khiển</a></li>
                  
                  <li><a href="{{ route('admin.orders.index') }}"><i class="ri-record-circle-line"></i>Hóa Đơn</a></li>
                  <li><a href="{{ route('admin.books.index') }}"><i class="ri-record-circle-line"></i>Sách</a></li>
                  <li><a href="{{ route('admin.khachhang.index') }}"><i class="ri-record-circle-line"></i>Người Dùng</a></li>
                  <li><a href="{{ route('admin.lienhe.index') }}"><i class="ri-record-circle-line"></i>Liên Hệ</a></li>
                  <li><a href="{{ route('admin.phieunhap.index') }}"><i class="ri-record-circle-line"></i>Phiếu Nhập</a></li>
                  <li><a href="{{ route('admin.khuyenmai.index') }}"><i class="ri-record-circle-line"></i>Khuyến Mãi</a></li>
                  <li><a href="{{ route('admin.danhmuc.index') }}"><i class="ri-record-circle-line"></i>Danh Mục</a></li>
                  <form action="{{ route('logout') }}" method="POST" class="d-inline-block w-100 text-center p-3">
                     @csrf
                     <button type="submit" class="bg-primary iq-sign-btn" style="border: none;">
                        Đăng xuất <i class="ri-login-box-line ml-2"></i>
                     </button>
                  </form>
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
                           <img src="#" class="img-fluid rounded-normal" alt="">
                           <div class="logo-title">
                              <span class="text-primary text-uppercase">NhasachTV</span>
                           </div>
                        </a>
                     </div>
                  </div>
                  <div class="navbar-breadcrumb">
                     <h5 class="mb-0">Trang Chủ</h5>
                  </div>
                  <!-- <div class="iq-search-bar">
                     <form action="#" class="searchbox">
                        <input type="text" class="text search-input" placeholder="Tìm kiếm sản phẩm...">
                        <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                     </form>
                  </div> -->
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-label="Toggle navigation">
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
                           @php
                           use App\Models\DonHang;

                           $donHangChoXuLy = DonHang::where('trang_thai', 'cho_xu_ly')
                                                      ->orderByDesc('created_at')
                                                      ->take(5)
                                                      ->get();

                           $soLuongThongBao = $donHangChoXuLy->count();
                           @endphp
                           <a href="#" class="search-toggle iq-waves-effect text-gray rounded">
                              <i class="ri-notification-2-line"></i>
                              @if($soLuongThongBao > 0)
                                 <span class="bg-primary dots"></span>
                              @endif
                           </a>
                           <div class="iq-sub-dropdown">
                              <div class="iq-card shadow-none m-0">
                                 <div class="iq-card-body p-0">
                                 <div class="bg-primary p-3">
                                    <h5 class="mb-0 text-white">
                                       Thông Báo
                                       <small class="badge badge-light float-right pt-1">{{ $soLuongThongBao }}</small>
                                    </h5>
                                 </div>

                                 @forelse($donHangChoXuLy as $donhang)
                                 <a href="{{ route('admin.orders.show', $donhang->id) }}" class="iq-sub-card">
                                    <div class="media align-items-center">
                                       <i class="ri-file-list-3-line" style="font-size:24px;"></i>
                                       <div class="media-body ml-3">
                                       <h6 class="mb-0">Đơn hàng {{ $donhang->ma_donhang }} đang chờ xử lý</h6>
                                       <small class="float-right font-size-12">{{ $donhang->created_at->diffForHumans() }}</small>
                                       <p class="mb-0">{{ number_format($donhang->tong_tien, 0, ',', '.') }}đ</p>
                                       </div>
                                    </div>
                                 </a>
                                 @empty
                                 <div class="p-3 text-center">Không có đơn hàng nào chờ xử lý</div>
                                 @endforelse
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
                                 <div class="iq-card-body p-0 ">
                                    <div class="bg-primary p-3">
                                       <h5 class="mb-0 text-white">Tin Nhắn<small class="badge  badge-light float-right pt-1">5</small></h5>
                                    </div>
                                    <a href="#" class="iq-sub-card">
                                       <div class="media align-items-center">
                                          <div class="">
                                             <img class="avatar-40 rounded" src="#" alt="">
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
                                             <img class="avatar-40 rounded" src="#" alt="">
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
                                             <img class="avatar-40 rounded" src="#" alt="">
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
                                             <img class="avatar-40 rounded" src="#" alt="">
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
                                             <img class="avatar-40 rounded" src="#" alt="">
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
                        <li class="line-height pt-3">
                        @if (Auth::check())
                           <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                              <img src="{{ asset(Auth::user()->avatar ?? 'images/user/default.png') }}" class="img-fluid rounded-circle mr-3" alt="user">
                              <div class="caption">
                              <h6 class="mb-1 line-height">{{ Auth::user()->name }}</h6> <!-- Hiển thị tên người dùng -->
                              <p class="mb-0 text-primary">Tài Khoản</p>
                              </div>
                           </a>
                           <div class="iq-sub-dropdown iq-user-dropdown">
                              <div class="iq-card shadow-none m-0">
                                 <div class="iq-card-body p-0 ">
                                    <div class="bg-primary p-3">
                                       <h5 class="mb-0 text-white line-height">Xin Chào {{ Auth::user()->name }}</h5> <!-- Hiển thị lời chào với tên người dùng -->
                                    </div>
                                    <a href="profile.html" class="iq-sub-card iq-bg-primary-hover">
                                       <div class="media align-items-center">
                                          <div class="rounded iq-card-icon iq-bg-primary">
                                             <i class="ri-file-user-line"></i>
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">Tài khoản của tôi</h6>
                                          </div>
                                       </div>
                                    </a>
                                    <div class="d-inline-block w-100 text-center p-3">
                                       <form action="{{ route('logout') }}" method="POST">
                                          @csrf
                                          <button type="submit" class="bg-primary iq-sign-btn mx-auto d-block" style="border: none;">
                                             Đăng xuất <i class="ri-login-box-line ml-2"></i>
                                          </button>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           @else
                              <p>Chưa đăng nhập</p> <!-- Hiển thị nếu người dùng chưa đăng nhập -->
                           @endif
                        </li>
                     </ul>
                  </div>
               </nav>
            </div>
         </div>
         <!-- TOP Nav Bar END -->
        <!-- Main Content -->
        <div class="main-content">
                @yield('content')
        </div>
        <!-- End Main Content -->
    <!-- Wrapper END -->
    <!-- Footer -->
    <footer class="iq-footer">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-6">
                  <ul class="list-inline mb-0">
                     <li class="list-inline-item"><a href="{{ route('chinh-sach') }}">Chính sách</a></li>
                     <li class="list-inline-item"><a href="{{ route('dieu-khoan') }}">Điều khoản</a></li>
                  </ul>
               </div>
            </div>
         </div>
      </footer>
      <!-- Footer END -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="{{ asset('js/jquery.min.js') }}"></script>
      <!-- Slick JavaScript -->
      <script src="{{ asset('js/slick.min.js') }}"></script>
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
      <script src="{{ asset('js/algoliasearchLite.min.js') }}"></script>
      <script src="{{ asset('js/bodymovin.js') }}"></script>
      
      <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
      <script src="{{ asset('js/highcharts.js') }}"></script>
      <script src="{{ asset('js/highcharts-3d.js') }}"></script>
      <script src="{{ asset('js/highcharts-more.js') }}"></script>
      <script src="{{ asset('js/instantsearch.js') }}"></script>
      
      <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('js/worldHigh.js') }}"></script>
      <!-- đoạn script này dùng để gán link vào h6 của tài khoản của tôi -->
      <script>
         document.addEventListener("DOMContentLoaded", function () {
            const profileLink = document.querySelector('a[href="profile.html"]');
            if (profileLink) {
                  profileLink.href = "{{ route('admin.profile.show') }}";
            }
         });
      </script>
      @yield('scripts')
</body>

</html>

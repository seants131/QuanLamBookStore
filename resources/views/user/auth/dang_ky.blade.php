<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>WebBanSach - Đăng ký</title>
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
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
        <!-- Sign in Start -->
        <section class="sign-in-page">
            <div class="container p-0">
                <div class="row no-gutters height-self-center">
                  <div class="col-sm-12 align-self-center page-content rounded">
                    <div class="row m-0">
                      <div class="col-sm-12 sign-in-page-data">
                          <div class="sign-in-from bg-primary rounded">
                              <h3 class="mb-0 text-center text-black">Đăng ký</h3>
                              <p class="text-center text-white">Hãy nhập email và mật khẩu</p>
                              <form class="mt-4 form-text" method="POST" action="{{ route('user.sign-up') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Họ và tên</label>
                                    <input type="text" class="form-control mb-0" id="name" name="name" placeholder="Họ và tên" value="{{ old('name') }}">
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="username">Tên đăng nhập</label>
                                    <input type="text" class="form-control mb-0" id="username" name="username" placeholder="Tên đăng nhập" value="{{ old('username') }}">
                                    @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control mb-0" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Mật khẩu</label>
                                    <input type="password" class="form-control mb-0" id="password" name="password" placeholder="Password">
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Nhập lại mật khẩu</label>
                                    <input type="password" class="form-control mb-0" id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu">
                                </div>
                                <div class="sign-info text-center">
                                    <button type="submit" class="btn btn-white d-block w-100 mb-2">Đăng ký</button>
                                    <span class="text-dark d-inline-block line-height-2">Đã có tài khoản? <a href="{{ route('user.sign-in') }}" class="text-white">Đăng nhập</a></span>
                                </div>
                            </form>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </section>
        <!-- Sign in END -->
         <!-- color-customizer -->
       {{-- <div class="iq-colorbox color-fix">
           <div class="buy-button"> <a class="color-full" href="#"><i class="fa fa-spinner fa-spin"></i></a> </div>
           <div class="clearfix color-picker">
               <h3 class="iq-font-black">Booksto Awesome Color</h3>
               <p>This color combo available inside whole template. You can change on your wish, Even you can create your own with limitless possibilities! </p>
               <ul class="iq-colorselect clearfix">
                   <li class="color-1 iq-colormark" data-style="color-1"></li>
                   <li class="color-2" data-style="iq-color-2"></li>
                   <li class="color-3" data-style="iq-color-3"></li>
                   <li class="color-4" data-style="iq-color-4"></li>
                   <li class="color-5" data-style="iq-color-5"></li>
                   <li class="color-6" data-style="iq-color-6"></li>
                   <li class="color-7" data-style="iq-color-7"></li>
                   <li class="color-8" data-style="iq-color-8"></li>
                   <li class="color-9" data-style="iq-color-9"></li>
                   <li class="color-10" data-style="iq-color-10"></li>
                   <li class="color-11" data-style="iq-color-11"></li>
                   <li class="color-12" data-style="iq-color-12"></li>
                   <li class="color-13" data-style="iq-color-13"></li>
                   <li class="color-14" data-style="iq-color-14"></li>
                   <li class="color-15" data-style="iq-color-15"></li>
                   <li class="color-16" data-style="iq-color-16"></li>
                   <li class="color-17" data-style="iq-color-17"></li>
                   <li class="color-18" data-style="iq-color-18"></li>
                   <li class="color-19" data-style="iq-color-19"></li>
                   <li class="color-20" data-style="iq-color-20"></li>
               </ul>
               <a target="_blank" class="btn btn-primary d-block mt-3" href="">Purchase Now</a>
           </div>
       </div> --}}
       <!-- color-customizer END -->
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
      <!-- lottie JavaScript -->
      <script src="js/lottie.js"></script>
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
      <!-- Style Customizer -->
      <script src="js/style-customizer.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="js/custom.js"></script>
   </body>
</html>
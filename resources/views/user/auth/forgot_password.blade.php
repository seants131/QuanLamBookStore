<!doctype html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>WebBanSach - Quên mật khẩu</title>
   <link rel="shortcut icon" href="images/favicon.ico" />
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <link rel="stylesheet" href="css/typography.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/responsive.css">
   <style>
      .sign-in-from {
         color: rgb(58, 57, 57) !important;
      }
      .sign-in-from label,
      .sign-in-from p,
      .sign-in-from h3,
      .sign-in-from span,
      .sign-in-from a {
         color: rgb(90, 88, 88) !important;
      }
      .sign-in-from input,
      .sign-in-from input::placeholder,
      .sign-in-from button {
         color: rgb(73, 73, 73) !important;
      }
      .sign-in-from input {
         background-color: white !important;
         border: 1px solid #ced4da;
      }
      .sign-in-from button {
         background-color: #f8f9fa;
         border: 1px solid #ced4da;
      }
      .sign-in-from button:hover {
         background-color: #e2e6ea;
      }
   </style>
</head>
<body>
   <section class="sign-in-page">
      <div class="container p-0">
         <div class="row no-gutters height-self-center">
            <div class="col-sm-12 align-self-center page-content rounded">
               <div class="row m-0">
                  <div class="col-sm-12 sign-in-page-data">
                     <div class="sign-in-from bg-primary rounded">
                        <h3 class="mb-0 text-center">Quên mật khẩu</h3>
                        <p class="text-center">Nhập email để nhận liên kết đặt lại mật khẩu</p>
                        @if (session('status'))
                           <div class="alert alert-success">{{ session('status') }}</div>
                        @endif
                        <form class="mt-4 form-text" method="POST" action="{{ route('user.forgot-password.send') }}">
                           @csrf
                           <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" class="form-control mb-0" id="email" name="email" placeholder="Nhập email" value="{{ old('email') }}">
                              @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                           </div>
                           <div class="sign-info text-center">
                              <button type="submit" class="btn d-block w-100 mb-2">Gửi liên kết đặt lại mật khẩu</button>
                              <a href="{{ route('user.sign-in') }}" class="btn btn-link mb-2" style="color:#007bff;font-weight:500;text-decoration:underline;">Quay lại đăng nhập</a>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/custom.js"></script>
</body>
</html>

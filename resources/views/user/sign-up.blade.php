@extends('layouts.sign_in_up.sign')

@section('content')
<!-- Sign in Start -->
<section class="sign-in-page">
            <div class="container p-0">
                <div class="row no-gutters height-self-center">
                  <div class="col-sm-12 align-self-center page-content rounded">
                    <div class="row m-0">
                      <div class="col-sm-12 sign-in-page-data">
                          <div class="sign-in-from bg-primary rounded">
                              <h3 class="mb-0 text-center text-white">Sign Up</h3>
                              <p class="text-center text-white">Enter your email address and password to access admin panel.</p>
                              <form class="mt-4 form-text">
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Your Full Name</label>
                                      <input type="email" class="form-control mb-0" id="exampleInputEmail1" placeholder="Your Full Name">
                                  </div>
                                  <div class="form-group">
                                      <label for="exampleInputEmail2">Email address</label>
                                      <input type="email" class="form-control mb-0" id="exampleInputEmail2" placeholder="Enter email">
                                  </div>
                                  <div class="form-group">
                                      <label for="exampleInputPassword1">Password</label>
                                      <input type="password" class="form-control mb-0" id="exampleInputPassword1" placeholder="Password">
                                  </div>
                                  <div class="d-inline-block w-100">
                                      <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                                          <input type="checkbox" class="custom-control-input" id="customCheck1">
                                          <label class="custom-control-label" for="customCheck1">I accept <a href="#" class="text-light">Terms and Conditions</a></label>
                                      </div>
                                  </div>
                                  <div class="sign-info text-center">
                                      <button type="submit" class="btn btn-white d-block w-100 mb-2">Sign Up</button>
                                      <span class="text-dark d-inline-block line-height-2">Already Have Account ? <a href="sign-in.html" class="text-white">Log In</a></span>
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
       <div class="iq-colorbox color-fix">
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
       </div>
       <!-- color-customizer END -->
@endsection

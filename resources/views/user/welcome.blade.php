@extends('layouts.user.HomePage')

@section('title', 'Trang chủ người dùng')

@section('content')
    <!-- Page Content  -->
    <div id="content-page" class="content-page">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="iq-card-transparent iq-card-block iq-card-stretch iq-card-height rounded">
                        <div class="newrealease-contens">
                           <ul id="newrealease-slider" class="list-inline p-0 m-0 d-flex align-items-center">
                              <li class="item">
                                 <a href="javascript:void(0);">
                                    <img src="images/new_realeases/img01.jpg" class="img-fluid w-100 rounded" alt="">
                                 </a>
                              </li>
                              <li class="item">
                                 <a href="javascript:void(0);">
                                    <img src="images/new_realeases/07.jpg" class="img-fluid w-100 rounded" alt="">
                                 </a>
                              </li>
                              <li class="item">
                                 <a href="javascript:void(0);">
                                    <img src="images/new_realeases/img05.jpg" class="img-fluid w-100 rounded" alt="">
                                 </a>
                              </li>
                              <li class="item">
                                 <a href="javascript:void(0);">
                                    <img src="images/new_realeases/img04.jpg" class="img-fluid w-100 rounded" alt="">
                                 </a>
                              </li>
                              <li class="item">
                                 <a href="javascript:void(0);">
                                    <img src="images/new_realeases/img05.jpg" class="img-fluid w-100 rounded" alt="">
                                 </a>
                              </li>
                              <li class="item">
                                 <a href="javascript:void(0);">
                                    <img src="#" class="img-fluid w-100 rounded" alt="">
                                 </a>
                              </li>
                              <li class="item">
                                 <a href="javascript:void(0);">
                                    <img src="images/new_realeases/07.jpg" class="img-fluid w-100 rounded" alt="">
                                 </a>
                              </li>
                              <li class="item">
                                 <a href="javascript:void(0);">
                                    <img src="images/new_realeases/08.jpg" class="img-fluid w-100 rounded" alt="">
                                 </a>
                              </li>
                              <li class="item">
                                 <a href="javascript:void(0);">
                                    <img src="images/new_realeases/09.jpg" class="img-fluid w-100 rounded" alt="">
                                 </a>                              
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between align-items-center position-relative">
                           <div class="iq-header-title">
                              <h4 class="card-title mb-0">Gợi ý cho bạn</h4>
                           </div>
                           <div class="iq-card-header-toolbar d-flex align-items-center">                              
                              <a href="category.html" class="btn btn-sm btn-primary view-more">Xem Thêm</a>
                           </div>
                        </div> 
                        <div class="iq-card-body">  
                           <div class="row">
                              <div class="col-sm-6 col-md-4 col-lg-3">
                                 <div class="iq-card iq-card-block iq-card-stretch iq-card-height browse-bookcontent">
                                    <div class="iq-card-body p-0">
                                       <div class="d-flex align-items-center">
                                          <div class="col-6 p-0 position-relative image-overlap-shadow">
                                             <a href="javascript:void();"><img class="img-fluid rounded w-100" src="images/browse-books/img01.jpg" alt=""></a>
                                             <div class="view-book">
                                                <a href="book-page.html" class="btn btn-sm btn-white">Mua Ngay</a>
                                             </div>
                                          </div>
                                          <div class="col-6">
                                             <div class="mb-2">
                                                <h6 class="mb-1">Bí Quyết Làm Giàu Của Napoleon Hill (Tái Bản 2019)</h6>
                                                <p class="font-size-13 line-height mb-1">Napoleon Hill</p>
                                                <div class="d-block line-height">
                                                   <span class="font-size-11 text-warning">
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                   </span>                                             
                                                </div>
                                             </div>
                                             <div class="price d-flex align-items-center">
                                                <h6><b>79.000 đ</b></h6>
                                             </div>
                                             <div class="iq-product-action">
                                                <a href="javascript:void();"><i class="ri-shopping-cart-2-fill text-primary"></i></a>
                                                <a href="javascript:void();" class="ml-2"><i class="ri-heart-fill text-danger"></i></a>
                                             </div>                                      
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-6 col-md-4 col-lg-3">
                                 <div class="iq-card iq-card-block iq-card-stretch iq-card-height browse-bookcontent">
                                    <div class="iq-card-body p-0">
                                       <div class="d-flex align-items-center">
                                          <div class="col-6 p-0 position-relative image-overlap-shadow">
                                             <a href="javascript:void();"><img class="img-fluid rounded w-100" src="images/browse-books/02.jpg" alt=""></a>
                                             <div class="view-book">
                                                <a href="book-page.html" class="btn btn-sm btn-white">Mua Ngay</a>
                                             </div>
                                          </div>
                                          <div class="col-6">
                                             <div class="mb-2">
                                                <h6 class="mb-1">Trên Đỉnh Phố Wall(Tái bản 2019)</h6>
                                                <p class="font-size-13 line-height mb-1">Fritz Wold</p>
                                                <div class="d-block line-height">
                                                   <span class="font-size-11 text-warning">
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                   </span>                                             
                                                </div>
                                             </div>
                                             <div class="price d-flex align-items-center">
                                                <h6><b>79.000 đ</b></h6>
                                             </div>
                                             <div class="iq-product-action">
                                                <a href="javascript:void();"><i class="ri-shopping-cart-2-fill text-primary"></i></a>
                                                <a href="javascript:void();" class="ml-2"><i class="ri-heart-fill text-danger"></i></a>
                                             </div>                                      
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-6 col-md-4 col-lg-3">
                                 <div class="iq-card iq-card-block iq-card-stretch iq-card-height browse-bookcontent">
                                    <div class="iq-card-body p-0">
                                       <div class="d-flex align-items-center">
                                          <div class="col-6 p-0 position-relative image-overlap-shadow">
                                             <a href="javascript:void();"><img class="img-fluid rounded w-100" src="images/browse-books/03.jpg" alt=""></a>
                                             <div class="view-book">
                                                <a href="book-page.html" class="btn btn-sm btn-white">Mua Ngay</a>
                                             </div>
                                          </div>
                                          <div class="col-6">
                                             <div class="mb-2">
                                                <h6 class="mb-1">Đến Starbucks Mua Cà Phê Cốc Lớn</h6>
                                                <p class="font-size-13 line-height mb-1">John Klok</p>
                                                <div class="d-block line-height">
                                                   <span class="font-size-11 text-warning">
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                   </span>                                             
                                                </div>
                                             </div>
                                             <div class="price d-flex align-items-center">
                                                <h6><b>79.000 đ</b></h6>
                                             </div>
                                             <div class="iq-product-action">
                                                <a href="javascript:void();"><i class="ri-shopping-cart-2-fill text-primary"></i></a>
                                                <a href="javascript:void();" class="ml-2"><i class="ri-heart-fill text-danger"></i></a>
                                             </div>                                      
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-6 col-md-4 col-lg-3">
                                 <div class="iq-card iq-card-block iq-card-stretch iq-card-height browse-bookcontent">
                                    <div class="iq-card-body p-0">
                                       <div class="d-flex align-items-center">
                                          <div class="col-6 p-0 position-relative image-overlap-shadow">
                                             <a href="javascript:void();"><img class="img-fluid rounded w-100" src="images/browse-books/04.jpg" alt=""></a>
                                             <div class="view-book">
                                                <a href="book-page.html" class="btn btn-sm btn-white">Mua Ngay</a>
                                             </div>
                                          </div>
                                          <div class="col-6">
                                             <div class="mb-2">
                                                <h6 class="mb-1">Kinh Tế Học Viking</h6>
                                                <p class="font-size-13 line-height mb-1">George Strong</p>
                                                <div class="d-block line-height">
                                                   <span class="font-size-11 text-warning">
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                   </span>                                             
                                                </div>
                                             </div>
                                             <div class="price d-flex align-items-center">
                                                <h6><b>68.000 đ</b></h6>
                                             </div>
                                             <div class="iq-product-action">
                                                <a href="javascript:void();"><i class="ri-shopping-cart-2-fill text-primary"></i></a>
                                                <a href="javascript:void();" class="ml-2"><i class="ri-heart-fill text-danger"></i></a>
                                             </div>                                      
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-6 col-md-4 col-lg-3">
                                 <div class="iq-card iq-card-block iq-card-stretch iq-card-height browse-bookcontent">
                                    <div class="iq-card-body p-0">
                                       <div class="d-flex align-items-center">
                                          <div class="col-6 p-0 position-relative image-overlap-shadow">
                                             <a href="javascript:void();"><img class="img-fluid rounded w-100" src="images/browse-books/05.jpg" alt=""></a>
                                             <div class="view-book">
                                                <a href="book-page.html" class="btn btn-sm btn-white">Mua Ngay</a>
                                             </div>
                                          </div>
                                          <div class="col-6">
                                             <div class="mb-2">
                                                <h6 class="mb-1">Cha Giàu Cha Nghèo</h6>
                                                <p class="font-size-13 line-height mb-1">Ichae Semos</p>
                                                <div class="d-block line-height">
                                                   <span class="font-size-11 text-warning">
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                   </span>                                             
                                                </div>
                                             </div>
                                             <div class="price d-flex align-items-center">
                                                <h6><b>39.000đ</b></h6>
                                             </div>
                                             <div class="iq-product-action">
                                                <a href="javascript:void();"><i class="ri-shopping-cart-2-fill text-primary"></i></a>
                                                <a href="javascript:void();" class="ml-2"><i class="ri-heart-fill text-danger"></i></a>
                                             </div>                                      
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-6 col-md-4 col-lg-3">
                                 <div class="iq-card iq-card-block iq-card-stretch iq-card-height browse-bookcontent">
                                    <div class="iq-card-body p-0">
                                       <div class="d-flex align-items-center">
                                          <div class="col-6 p-0 position-relative image-overlap-shadow">
                                             <a href="javascript:void();"><img class="img-fluid rounded w-100" src="images/browse-books/06.jpg" alt=""></a>
                                             <div class="view-book">
                                                <a href="book-page.html" class="btn btn-sm btn-white">Mua Ngay</a>
                                             </div>
                                          </div>
                                          <div class="col-6">
                                             <div class="mb-2">
                                                <h6 class="mb-1">Find The Wave Book</h6>
                                                <p class="font-size-13 line-height mb-1">Fidel Martin</p>
                                                <div class="d-block line-height">
                                                   <span class="font-size-11 text-warning">
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                   </span>                                             
                                                </div>
                                             </div>
                                             <div class="price d-flex align-items-center">
                                                <h6><b>79.000đ</b></h6>
                                             </div>
                                             <div class="iq-product-action">
                                                <a href="javascript:void();"><i class="ri-shopping-cart-2-fill text-primary"></i></a>
                                                <a href="javascript:void();" class="ml-2"><i class="ri-heart-fill text-danger"></i></a>
                                             </div>                                      
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-6 col-md-4 col-lg-3">
                                 <div class="iq-card iq-card-block iq-card-stretch iq-card-height browse-bookcontent">
                                    <div class="iq-card-body p-0">
                                       <div class="d-flex align-items-center">
                                          <div class="col-6 p-0 position-relative image-overlap-shadow">
                                             <a href="javascript:void();"><img class="img-fluid rounded w-100" src="images/browse-books/07.jpg" alt=""></a>
                                             <div class="view-book">
                                                <a href="book-page.html" class="btn btn-sm btn-white">Mua Ngay</a>
                                             </div>
                                          </div>
                                          <div class="col-6">
                                             <div class="mb-2">
                                                <h6 class="mb-1">See the More Story</h6>
                                                <p class="font-size-13 line-height mb-1">Jules Boutin</p>
                                                <div class="d-block line-height">
                                                   <span class="font-size-11 text-warning">
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                   </span>                                             
                                                </div>
                                             </div>
                                             <div class="price d-flex align-items-center">
                                                <h6><b>79.000đ</b></h6>
                                             </div>
                                             <div class="iq-product-action">
                                                <a href="javascript:void();"><i class="ri-shopping-cart-2-fill text-primary"></i></a>
                                                <a href="javascript:void();" class="ml-2"><i class="ri-heart-fill text-danger"></i></a>
                                             </div>                                      
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-6 col-md-4 col-lg-3">
                                 <div class="iq-card iq-card-block iq-card-stretch iq-card-height browse-bookcontent">
                                    <div class="iq-card-body p-0">
                                       <div class="d-flex align-items-center">
                                          <div class="col-6 p-0 position-relative image-overlap-shadow">
                                             <a href="javascript:void();"><img class="img-fluid rounded w-100" src="images/browse-books/08.jpg" alt=""></a>
                                             <div class="view-book">
                                                <a href="book-page.html" class="btn btn-sm btn-white">Mua Ngay</a>
                                             </div>
                                          </div>
                                          <div class="col-6">
                                             <div class="mb-2">
                                                <h6 class="mb-1">The Wikde Book</h6>
                                                <p class="font-size-13 line-height mb-1">Kusti Franti</p>
                                                <div class="d-block line-height">
                                                   <span class="font-size-11 text-warning">
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                   </span>                                             
                                                </div>
                                             </div>
                                             <div class="price d-flex align-items-center">
                                                <h6><b>79.390đ</b></h6>
                                             </div>
                                             <div class="iq-product-action">
                                                <a href="javascript:void();"><i class="ri-shopping-cart-2-fill text-primary"></i></a>
                                                <a href="javascript:void();" class="ml-2"><i class="ri-heart-fill text-danger"></i></a>
                                             </div>                                      
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-6 col-md-4 col-lg-3">
                                 <div class="iq-card iq-card-block iq-card-stretch iq-card-height browse-bookcontent mb-lg-0">
                                    <div class="iq-card-body p-0">
                                       <div class="d-flex align-items-center">
                                          <div class="col-6 p-0 position-relative image-overlap-shadow">
                                             <a href="javascript:void();"><img class="img-fluid rounded w-100" src="images/browse-books/09.jpg" alt=""></a>
                                             <div class="view-book">
                                                <a href="book-page.html" class="btn btn-sm btn-white">Mua Ngay</a>
                                             </div>
                                          </div>
                                          <div class="col-6">
                                             <div class="mb-2">
                                                <h6 class="mb-1">Conversion Erik Routley</h6>
                                                <p class="font-size-13 line-height mb-1">Argele Intili</p>
                                                <div class="d-block line-height">
                                                   <span class="font-size-11 text-warning">
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                   </span>                                             
                                                </div>
                                             </div>
                                             <div class="price d-flex align-items-center">
                                                <h6><b>79.000đ</b></h6>
                                             </div>
                                             <div class="iq-product-action">
                                                <a href="javascript:void();"><i class="ri-shopping-cart-2-fill text-primary"></i></a>
                                                <a href="javascript:void();" class="ml-2"><i class="ri-heart-fill text-danger"></i></a>
                                             </div>                                      
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-6 col-md-4 col-lg-3">
                                 <div class="iq-card iq-card-block iq-card-stretch iq-card-height browse-bookcontent mb-md-0 mb-lg-0">
                                    <div class="iq-card-body p-0">
                                       <div class="d-flex align-items-center">
                                          <div class="col-6 p-0 position-relative image-overlap-shadow">
                                             <a href="javascript:void();"><img class="img-fluid rounded w-100" src="images/browse-books/10.jpg" alt=""></a>
                                             <div class="view-book">
                                                <a href="book-page.html" class="btn btn-sm btn-white">Mua Ngay</a>
                                             </div>
                                          </div>
                                          <div class="col-6">
                                             <div class="mb-2">
                                                <h6 class="mb-1">The Leo Dominica</h6>
                                                <p class="font-size-13 line-height mb-1">Henry Jurk</p>
                                                <div class="d-block line-height">
                                                   <span class="font-size-11 text-warning">
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                   </span>                                             
                                                </div>
                                             </div>
                                             <div class="price d-flex align-items-center">
                                                <h6><b>79.000đ</b></h6>
                                             </div>
                                             <div class="iq-product-action">
                                                <a href="javascript:void();"><i class="ri-shopping-cart-2-fill text-primary"></i></a>
                                                <a href="javascript:void();" class="ml-2"><i class="ri-heart-fill text-danger"></i></a>
                                             </div>                                      
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-6 col-md-4 col-lg-3">
                                 <div class="iq-card iq-card-block iq-card-stretch iq-card-height browse-bookcontent mb-sm-0 mb-md-0 mb-lg-0">
                                    <div class="iq-card-body p-0">
                                       <div class="d-flex align-items-center">
                                          <div class="col-6 p-0 position-relative image-overlap-shadow">
                                             <a href="javascript:void();"><img class="img-fluid rounded w-100" src="images/browse-books/11.jpg" alt=""></a>
                                             <div class="view-book">
                                                <a href="book-page.html" class="btn btn-sm btn-white">Mua Ngay</a>
                                             </div>
                                          </div>
                                          <div class="col-6">
                                             <div class="mb-2">
                                                <h6 class="mb-1">By The Editbeth Jat</h6>
                                                <p class="font-size-13 line-height mb-1">David King</p>
                                                <div class="d-block line-height">
                                                   <span class="font-size-11 text-warning">
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                   </span>                                             
                                                </div>
                                             </div>
                                             <div class="price d-flex align-items-center">
                                                <h6><b>68.6080đ</b></h6>
                                             </div>
                                             <div class="iq-product-action">
                                                <a href="javascript:void();"><i class="ri-shopping-cart-2-fill text-primary"></i></a>
                                                <a href="javascript:void();" class="ml-2"><i class="ri-heart-fill text-danger"></i></a>
                                             </div>                                      
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-sm-6 col-md-4 col-lg-3">
                                 <div class="iq-card iq-card-block iq-card-stretch iq-card-height browse-bookcontent mb-0 mb-sm-0 mb-md-0 mb-lg-0">
                                    <div class="iq-card-body p-0">
                                       <div class="d-flex align-items-center">
                                          <div class="col-6 p-0 position-relative image-overlap-shadow">
                                             <a href="javascript:void();"><img class="img-fluid rounded w-100" src="images/browse-books/12.jpg" alt=""></a>
                                             <div class="view-book">
                                                <a href="book-page.html" class="btn btn-sm btn-white">Mua Ngay</a>
                                             </div>
                                          </div>
                                          <div class="col-6">
                                             <div class="mb-2">
                                                <h6 class="mb-1">The Crucial Decade</h6>
                                                <p class="font-size-13 line-height mb-1">Attilio Marzi</p>
                                                <div class="d-block line-height">
                                                   <span class="font-size-11 text-warning">
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                      <i class="fa fa-star"></i>
                                                   </span>                                             
                                                </div>
                                             </div>
                                             <div class="price d-flex align-items-center">
                                                <h6><b>179.000đ</b></h6>
                                             </div>
                                             <div class="iq-product-action">
                                                <a href="javascript:void();"><i class="ri-shopping-cart-2-fill text-primary"></i></a>
                                                <a href="javascript:void();" class="ml-2"><i class="ri-heart-fill text-danger"></i></a>
                                             </div>                                      
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between mb-0">
                           <div class="iq-header-title">
                              <h4 class="card-title">Best Seller</h4>
                           </div>
                           <div class="iq-card-header-toolbar d-flex align-items-center">
                              <div class="dropdown">
                                 <span class="dropdown-toggle p-0 text-body" id="dropdownMenuButton2" data-toggle="dropdown">
                                 Trong ngày<i class="ri-arrow-down-s-fill"></i>
                                 </span>
                                 <div class="dropdown-menu dropdown-menu-right shadow-none" aria-labelledby="dropdownMenuButton2">
                                    <a class="dropdown-item" href="#">Ngày</a>
                                    <a class="dropdown-item" href="#">Tuần</a>
                                    <a class="dropdown-item" href="#">Tháng</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <div class="row align-items-center">
                              <div class="col-sm-5 pr-0">
                                 <a href="javascript:void();"><img class="img-fluid rounded w-100" src="images/new_realeases/img01.jpg" alt=""></a>
                              </div>
                              <div class="col-sm-7 mt-3 mt-sm-0">
                                 <h4 class="mb-2">Payback Time </br> Ngày Đòi Nợ</h4>
                                 <p class="mb-2">Tác Giả : Phill Town</p>
                                 <div class="mb-2 d-block">
                                    <span class="font-size-12 text-warning">
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                       <i class="fa fa-star"></i>
                                    </span>
                                 </div>
                                 <span class="text-dark mb-3 d-block">NGÀY ĐÒI NỢ – Payback Time 
                                 “Một cuộc sống hạnh phúc được bắt đầu từ những quyết định đầu tư khôn ngoan”</span>
                                 <button type="submit" class="btn btn-primary learn-more">Xem thêm</button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between mb-0">
                           <div class="iq-header-title">
                              <h4 class="card-title">Nhà Sách TV</h4>
                           </div>
                           <div class="iq-card-header-toolbar d-flex align-items-center">
                              <div class="dropdown">
                                 <span class="dropdown-toggle p-0 text-body" id="dropdownMenuButton3" data-toggle="dropdown">
                                 Ngày<i class="ri-arrow-down-s-fill"></i>
                                 </span>
                                 <div class="dropdown-menu dropdown-menu-right shadow-none" aria-labelledby="dropdownMenuButton3">
                                    <a class="dropdown-item" href="#">Tuần</a>
                                    <a class="dropdown-item" href="#">Theo Tháng</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <ul class="list-inline row mb-0 align-items-center iq-scrollable-block">
                              <li class="col-sm-6 d-flex mb-3 align-items-center">
                                 <div class="icon iq-icon-box mr-3">
                                    <a href="javascript:void();"><img class="img-fluid avatar-60 rounded-circle" src="images/user/1.jpg" alt=""></a>
                                 </div>
                                 <div class="mt-1">
                                    <h6>Kinh Tế</h6>
                                    <p class="mb-0 text-primary">Publish Books: <span class="text-body">2831</span></p>
                                 </div>
                              </li>
                              <li class="col-sm-6 d-flex mb-3 align-items-center">
                                 <div class="icon iq-icon-box mr-3">
                                    <a href="javascript:void();"><img class="img-fluid avatar-60 rounded-circle" src="images/user/1.jpg" alt=""></a>
                                 </div>
                                 <div class="mt-1">
                                    <h6>Văn Học</h6>
                                    <p class="mb-0 text-primary">Publish Books: <span class="text-body">432</span></p>
                                 </div>
                              </li>
                              <li class="col-sm-6 d-flex mb-3 align-items-center">
                                 <div class="icon iq-icon-box mr-3">
                                    <a href="javascript:void();"><img class="img-fluid avatar-60 rounded-circle" src="images/user/1.jpg" alt=""></a>
                                 </div>
                                 <div class="mt-1">
                                    <h6>Tâm Lý - Kĩ Năng Sống</h6>
                                    <p class="mb-0 text-primary">Publish Books: <span class="text-body">5471</span></p>
                                 </div>
                              </li>
                              <li class="col-sm-6 d-flex mb-3 align-items-center">
                                 <div class="icon iq-icon-box mr-3">
                                    <a href="javascript:void();"><img class="img-fluid avatar-60 rounded-circle" src="images/user/1.jpg" alt=""></a>
                                 </div>
                                 <div class="mt-1">
                                    <h6>Sách Giáo Khoa</h6>
                                    <p class="mb-0 text-primary">Publish Books: <span class="text-body">8764</span></p>
                                 </div>
                              </li>
                              <li class="col-sm-6 d-flex mb-3 align-items-center">
                                 <div class="icon iq-icon-box mr-3">
                                    <a href="javascript:void();"><img class="img-fluid avatar-60 rounded-circle" src="images/user/1.jpg" alt=""></a>
                                 </div>
                                 <div class="mt-1">
                                    <h6>Chính trị – pháp luật</h6>
                                    <p class="mb-0 text-primary">Publish Books: <span class="text-body">8987</span></p>
                                 </div>
                              </li>
                              <li class="col-sm-6 d-flex mb-3 align-items-center">
                                 <div class="icon iq-icon-box mr-3">
                                    <a href="javascript:void();"><img class="img-fluid avatar-60 rounded-circle" src="images/user/1.jpg" alt=""></a>
                                 </div>
                                 <div class="mt-1">
                                    <h6>Khoa Học - Công Nghệ </h6>
                                    <p class="mb-0 text-primary">Publish Books: <span class="text-body">2831</span></p>
                                 </div>
                              </li>


                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between align-items-center position-relative">
                           <div class="iq-header-title">
                              <h4 class="card-title mb-0">Sách yêu thích</h4>
                           </div>
                           <div class="iq-card-header-toolbar d-flex align-items-center">
                              <a href="category.html" class="btn btn-sm btn-primary view-more">Xem thêm</a>
                           </div>
                        </div>                         
                        <div class="iq-card-body favorites-contens">
                           <ul id="favorites-slider" class="list-inline p-0 mb-0 row">
                              <li class="col-md-4">
                                 <div class="d-flex align-items-center">
                                    <div class="col-5 p-0 position-relative">
                                       <a href="javascript:void();">
                                          <img src="images/favorite/01.jpg" class="img-fluid rounded w-100" alt="">
                                       </a>                                
                                    </div>
                                    <div class="col-7">
                                       <h5 class="mb-2">D. Trump - Nghệ Thuật Đàm Phán</h5>
                                       <p class="mb-2">Tác giả : Pedro Araez</p>                                          
                                       <div class="d-flex justify-content-between align-items-center text-dark font-size-13">
                                          <span>Đã bán</span>
                                          <span class="mr-4">69</span>
                                       </div>
                                       <div class="iq-progress-bar-linear d-inline-block w-100">
                                          <div class="iq-progress-bar iq-bg-primary">
                                             <span class="bg-primary" data-percent="65"></span>
                                          </div>
                                       </div>
                                       <a href="#" class="text-dark">Đọc ngay<i class="ri-arrow-right-s-line"></i></a>
                                    </div>
                                 </div>
                              </li>
                              <li class="col-md-4">
                                 <div class="d-flex align-items-center">
                                    <div class="col-5 p-0 position-relative">
                                       <a href="javascript:void();">
                                          <img src="images/favorite/02.jpg" class="img-fluid rounded w-100" alt="">
                                       </a>                                
                                    </div>
                                    <div class="col-7">
                                       <h5 class="mb-2">Một Đời Quản Trị</h5>
                                       <p class="mb-2">Tác giả : Michael klock</p>                                          
                                       <div class="d-flex justify-content-between align-items-center text-dark font-size-13">
                                          <span>Đã bán</span>
                                          <span class="mr-4">450</span>
                                       </div>
                                       <div class="iq-progress-bar-linear d-inline-block w-100">
                                          <div class="iq-progress-bar iq-bg-danger">
                                             <span class="bg-danger" data-percent="45"></span>
                                          </div>
                                       </div>
                                       <a href="#" class="text-dark">Đọc ngay<i class="ri-arrow-right-s-line"></i></a>
                                    </div>
                                 </div>
                              </li>
                              <li class="col-md-4">
                                 <div class="d-flex align-items-center">
                                    <div class="col-5 p-0 position-relative">
                                       <a href="javascript:void();">
                                          <img src="images/favorite/03.jpg" class="img-fluid rounded w-100" alt="">
                                       </a>                                
                                    </div>
                                    <div class="col-7">
                                       <h5 class="mb-2">Người Bán Hàng Vĩ Đại Nhất Thế Giới</h5>
                                       <p class="mb-2">Tác giả : Daniel Ace</p>                                          
                                       <div class="d-flex justify-content-between align-items-center text-dark font-size-13">
                                          <span>Đã bán</span>
                                          <span class="mr-4">79</span>
                                       </div>
                                       <div class="iq-progress-bar-linear d-inline-block w-100">
                                          <div class="iq-progress-bar iq-bg-info">
                                             <span class="bg-info" data-percent="78"></span>
                                          </div>
                                       </div>
                                       <a href="#" class="text-dark">Đọc ngay<i class="ri-arrow-right-s-line"></i></a>
                                    </div>
                                 </div>
                              </li>
                              <li class="col-md-4">
                                 <div class="d-flex align-items-center">
                                    <div class="col-5 p-0 position-relative">
                                       <a href="javascript:void();">
                                          <img src="images/favorite/04.jpg" class="img-fluid rounded w-100" alt="">
                                       </a>                                
                                    </div>
                                    <div class="col-7">
                                       <h5 class="mb-2">Economix- Các Nền Kinh Tế Vận Hành</h5>
                                       <p class="mb-2">Tác giả : Luka Afton</p>                                          
                                       <div class="d-flex justify-content-between align-items-center text-dark font-size-13">
                                          <span>Đã bán</span>
                                          <span class="mr-4">900</span>
                                       </div>
                                       <div class="iq-progress-bar-linear d-inline-block w-100">
                                          <div class="iq-progress-bar iq-bg-success">
                                             <span class="bg-success" data-percent="90"></span>
                                          </div>
                                       </div>
                                       <a href="#" class="text-dark">Đọc ngay<i class="ri-arrow-right-s-line"></i></a>
                                    </div>
                                 </div>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
@endsection
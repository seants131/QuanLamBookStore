@extends('layouts.admin')

@section('content')
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header d-flex justify-content-between align-items-center">
                  <h4 class="card-title mb-0">Cập nhật khách hàng</h4>
               </div>

               @if($errors->any())
               <div class="alert alert-danger mt-3">
                  <ul class="mb-0">
                     @foreach($errors->all() as $error)
                     <li>{{ $error }}</li>
                     @endforeach
                  </ul>
               </div>
               @endif

               <div class="iq-card-body">
                  <form method="POST" action="{{ route('admin.khachhang.update', $khachhang->id) }}">
                     @csrf
                     @method('PUT')
                     <a href="{{ route('admin.khachhang.index') }}" class="close-form-button" title="Đóng">&times;</a>

                     <div class="form-group">
                        <label for="name">Họ tên</label>
                        <input type="text" name="name" id="name" class="form-control" 
                               value="{{ old('name', $khachhang->name) }}" required>
                     </div>

                     <div class="form-group">
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" id="username" class="form-control" 
                               value="{{ old('username', $khachhang->username) }}" required>
                     </div>

                     <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" 
                               value="{{ old('email', $khachhang->email) }}" required>
                     </div>

                     <div class="form-group">
                        <label for="so_dien_thoai">Số điện thoại</label>
                        <input type="text" name="so_dien_thoai" id="so_dien_thoai" class="form-control" 
                               value="{{ old('so_dien_thoai', $khachhang->so_dien_thoai) }}">
                     </div>

                     <div class="form-group d-flex justify-content-between mt-3">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="{{ route('admin.khachhang.index') }}" class="btn btn-secondary">← Trở về</a>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('styles')
<style>
   .close-form-button {
      position: absolute;
      top: 15px;
      right: 20px;
      z-index: 10;
      background-color: #dc3545;
      color: white;
      font-size: 22px;
      font-weight: bold;
      line-height: 1;
      border: none;
      border-radius: 50%;
      width: 36px;
      height: 36px;
      display: flex;
      justify-content: center;
      align-items: center;
      text-decoration: none;
      transition: background-color 0.3s ease;
   }

   .close-form-button:hover {
      background-color: #bd2130;
      text-decoration: none;
   }
</style>
@endsection

@extends('layouts.admin')

@section('content')
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
                                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row align-items-center">
                                            <div class="col-md-12">
                                                <div class="profile-img-edit">
                                                    <img class="profile-pic" src="{{ asset($user->avatar ?? 'images/user/default.jpg') }}" alt="avatar">
                                                    
                                                        <i class="ri-pencil-line upload-button"></i>
                                                        <input class="file-upload" type="file" name="avatar" accept="image/*"/>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="form-group col-sm-6">
                                                <label>Tên:</label>
                                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>Email:</label>
                                                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
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
                                    <form action="{{ route('admin.profile.password') }}" method="POST">
                                        @csrf
                                        <div class="form-group position-relative">
    <label>Mật khẩu hiện tại:</label>
    <input type="password" name="current_password" class="form-control password-field">
    <i class="toggle-password ri-eye-line"></i>
</div>

<div class="form-group position-relative">
    <label>Mật khẩu mới:</label>
    <input type="password" name="password" class="form-control password-field">
    <i class="toggle-password ri-eye-line"></i>
</div>

<div class="form-group position-relative">
    <label>Xác nhận mật khẩu:</label>
    <input type="password" name="password_confirmation" class="form-control password-field">
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
                                            <input type="text" name="so_dien_thoai" class="form-control" value="{{ $user->so_dien_thoai ?? '' }}">
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
@endsection
@section('styles')
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
.btn-primary, .btn-warning {
    border-radius: 4px;
    padding: 10px 20px;
    font-size: 16px;
    transition: background-color 0.3s, transform 0.2s;
}

.btn-primary:hover, .btn-warning:hover {
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
    .btn-primary, .btn-warning {
        width: 100%;
        margin-top: 10px;
    }
}
</style>
@endsection
@section('scripts')
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
@endsection

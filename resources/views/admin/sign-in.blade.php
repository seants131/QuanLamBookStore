<!-- resources/views/admin/sign-in.blade.php -->

@extends('layouts.sign_in_up.sign')<!-- Layout của bạn, thay đổi nếu cần -->

@section('content')
<div class="container">
    <h2>Đăng nhập Admin</h2>
    <form action="{{ route('admin.signin') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

       <div class="form-group mt-2 position-relative">
            <label for="password">Mật khẩu</label>
            <input type="password" name="password" id="password" class="form-control" required>
            <i class="toggle-password ri-eye-line"></i>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Đăng nhập</button>
    </form>

    <!-- Hiển thị thông báo lỗi nếu có -->
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection
@section('styles')
<style>
.toggle-password {
    position: absolute;
    top: 45px;
    right: 15px;
    cursor: pointer;
    font-size: 20px;
    color: #999;
}
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.toggle-password').forEach(function (icon) {
            icon.addEventListener('click', function () {
                // Tìm input trong cùng thẻ cha
                const input = this.closest('.form-group').querySelector('input');
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);

                // Đổi icon
                this.classList.toggle('ri-eye-line');
                this.classList.toggle('ri-eye-off-line');
            });
        });
    });
</script>
@endsection



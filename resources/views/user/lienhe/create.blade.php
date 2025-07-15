{{-- filepath: resources/views/user/lienhe/create.blade.php --}}
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Liên hệ</title>
    @include('user.layout.link_chung')
</head>
<body>
    <div class="wrapper">
        @include('user.layout.header', ['trang' => 'Liên hệ'])
        <div id="content-page" class="content-page">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                            <div class="iq-card-header d-flex justify-content-between align-items-center position-relative">
                                <div class="iq-header-title">
                                    <h4 class="card-title mb-0">Gửi liên hệ</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                @if(session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                <form action="{{ route('user.lienhe.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="ho_ten">Họ tên</label>
                                        <input type="text" name="ho_ten" id="ho_ten" class="form-control" required value="{{ old('ho_ten') }}">
                                        @error('ho_ten') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email liên hệ</label>
                                        <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}">
                                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="noi_dung">Nội dung liên hệ</label>
                                        <textarea name="noi_dung" id="noi_dung" rows="5" class="form-control" required>{{ old('noi_dung') }}</textarea>
                                        @error('noi_dung') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Gửi liên hệ</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('user.layout.footer')
    </div>
    <!-- Optional JavaScript -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>

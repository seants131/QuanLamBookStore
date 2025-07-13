<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Sách yêu thích</title>
    @include('user.layout.link_chung')
</head>
<body>
<div class="wrapper">
    @include('user.layout.header', ['trang' => 'Sách yêu thích'])
    <div id="content-page" class="content-page">
        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-12 mb-3">
                    <h4 class="card-title mb-0">Sách yêu thích của bạn</h4>
                </div>
            </div>
            <div class="row">
                @forelse($favorites as $fav)
                    @if($fav->sach)
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height browse-bookcontent">
                            <div class="iq-card-body p-0">
                                <div class="d-flex align-items-center">
                                    <div class="col-6 p-0 position-relative image-overlap-shadow">
                                        <a href="{{ route('user.books.detail', $fav->sach->slug) }}">
                                            <img class="img-fluid rounded w-100"
                                                 src="{{ $fav->sach->HinhAnh ? asset('uploads/books/' . $fav->sach->HinhAnh) : asset('images/default-book-placeholder.jpg') }}"
                                                 alt="{{ $fav->sach->TenSach }}">
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="mb-1">{{ $fav->sach->TenSach }}</h6>
                                        <p class="font-size-13 line-height mb-1">{{ $fav->sach->TacGia }}</p>
                                        <div class="price d-flex align-items-center">
                                            <h6><b>{{ number_format($fav->sach->GiaBia, 0, ',', '.') }} đ</b></h6>
                                        </div>
                                        <a href="{{ route('user.books.detail', $fav->sach->slug) }}" class="btn btn-sm btn-outline-primary mt-2">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @empty
                    <div class="col-12 text-center text-muted py-5">Bạn chưa có sách yêu thích nào.</div>
                @endforelse
            </div>
        </div>
    </div>
    @include('user.layout.footer')
</div>
</body>
</html>

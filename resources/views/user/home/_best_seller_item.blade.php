<div class="row align-items-center">
    <div class="col-sm-5 pr-0">
        <a href="{{ route('user.books.detail', $book->slug) }}">
            <img class="img-fluid rounded w-100"
                src="{{ $book->HinhAnh ? asset('uploads/books/' . $book->HinhAnh) : asset('images/default-book-placeholder.jpg') }}"
                alt="{{ $book->TenSach }}">
        </a>
    </div>
    <div class="col-sm-7 mt-3 mt-sm-0">
        <h4 class="mb-2">{{ $book->TenSach }}</h4>
        <p class="mb-2">Tác Giả : {{ $book->TacGia ?: 'N/A' }}</p>
        <span class="text-dark mb-3 d-block">{{ Str::limit($book->MoTa, 100) ?: 'Không có mô tả.' }}</span>
        <a href="{{ route('user.books.detail', $book->slug) }}" class="btn btn-primary learn-more">Xem thêm</a>
    </div>
</div>

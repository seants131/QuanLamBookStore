<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" />
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<!-- Typography CSS -->
<link rel="stylesheet" href="{{ asset('css/typography.css') }}">
<!-- Style CSS -->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<!-- Responsive CSS -->
<link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

<style>
    .iq-sidebar .iq-menu .iq-submenu .elements a span {
        display: inline-block;
        max-width: 140px;
        /* hoặc giá trị phù hợp với sidebar của bạn */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        vertical-align: middle;
    }

    .iq-sidebar .iq-menu .iq-submenu .elements a span {
        display: inline-block;
        max-width: 140px;
        white-space: normal;
        word-break: break-word;
    }
</style>

{{-- <script>
    $(document).ready(function() {
        // Xử lý thêm vào giỏ hàng bằng AJAX
        $(document).on('click', '.btn-add-to-cart', function(e) {
            e.preventDefault();
            var bookId = $(this).data('id');
            $.ajax({
                url: "{{ route('cart.add.ajax') }}",
                method: "POST",
                data: {
                    id: bookId,
                    quantity: 1,
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    if (res.success) {
                        $row.remove();
                        $('#cart-total').html(res.cart_total + ' đ');
                        $('#cart-total-final').html(res.cart_total + ' đ');
                        // Cập nhật số lượng trên icon giỏ hàng
                        $('.count-cart').text(res.cart_count > 0 ? res.cart_count : '');
                    }
                },
                error: function() {
                    alert('Có lỗi xảy ra!');
                }
            });
        });
    });

    $(document).on('click', '.btn-favorite', function() {
        var $icon = $(this).find('i');
        var sachId = $(this).data('id');
        $.post("{{ route('user.favorite.toggle') }}", {
            sach_id: sachId,
            _token: "{{ csrf_token() }}"
        }, function(res) {
            if(res.status === 'added') {
                $icon.removeClass('text-secondary').addClass('text-danger');
                alert('Đã thêm vào danh sách yêu thích!');
            } else if(res.status === 'removed') {
                $icon.removeClass('text-danger').addClass('text-secondary');
                alert('Đã xóa khỏi danh sách yêu thích!');
            } else {
                alert('Có lỗi xảy ra!');
            }
        }).fail(function(xhr){
            alert('Bạn cần đăng nhập để sử dụng chức năng này!');
        });
    });
</script> --}}

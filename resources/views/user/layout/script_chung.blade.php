<script>
    
// Xử lý sự kiện click cho nút yêu thích
     $(document).on('click', '.btn-favorite', function() {
         var $btn = $(this);
         var $icon = $btn.find('i');
         var $text = $btn.find('.favorite-text');
         var sachId = $btn.data('id');
         $.post("{{ route('user.favorite.toggle') }}", {
             sach_id: sachId,
             _token: "{{ csrf_token() }}"
         }, function(res) {
             if (res.status === 'added') {
                 $icon.removeClass('text-secondary').addClass('text-danger');
                 $text.text('Đã yêu thích');
             } else if (res.status === 'removed') {
                 $icon.removeClass('text-danger').addClass('text-secondary');
                 $text.text('Thêm vào danh sách yêu thích');
             }
         }).fail(function(xhr) {
             alert('Bạn cần đăng nhập để sử dụng chức năng này!');
         });
     });
 </script>


{{-- add gio hàng ajax --}}
<script>
$(document).on('click', '.btn-add-to-cart', function(e) {
    e.preventDefault();
    var bookId = $(this).data('id');
    var quantity = $(this).data('quantity') || 1;
    $.ajax({
        url: "{{ route('cart.add.ajax') }}",
        method: "POST",
        data: {
            id: bookId,
            quantity: quantity,
            _token: "{{ csrf_token() }}"
        },
        success: function(res) {
            if (res.success) {
                $('.count-cart').text(res.cart_count > 0 ? res.cart_count : '');
            } else {
                alert(res.message || 'Có lỗi xảy ra!');
            }
        },
        error: function() {
            alert('Có lỗi xảy ra!');
        }
    });
});
</script>
<script>
$(document).on('click', '.btn-apply-coupon', function() {
    var id = $(this).data('id');
    var ten = $(this).data('ten');
    var phantram = $(this).data('phantram');
    $.ajax({
        url: '{{ route('cart.apply_coupon') }}',
        method: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            id: id
        },
        success: function(res) {
            if(res.success) {
                $('#modal-khuyenmai').modal('hide');
                // Cập nhật lại tổng giá và hiển thị tên khuyến mãi
                $('#cart-total').text(res.cart_total + ' đ');
                $('#cart-total-final').text(res.cart_total_final + ' đ');
                location.reload(); // reload để cập nhật session và hiển thị tên KM (hoặc cập nhật DOM nếu muốn mượt hơn)
            } else {
                alert(res.message || 'Có lỗi xảy ra!');
            }
        }
    });
});

// Bỏ chọn khuyến mãi
$(document).on('click', '#remove-coupon', function() {
    $.ajax({
        url: '{{ route('cart.remove_coupon') }}',
        method: "POST",
        data: {
            _token: "{{ csrf_token() }}"
        },
        success: function(res) {
            if(res.success) {
                location.reload();
            }
        }
    });
});
</script>
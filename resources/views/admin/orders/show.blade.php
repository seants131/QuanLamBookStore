@extends('layouts.admin')

@section('content')
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between align-items-center">
                        <div class="iq-header-title">
                            <h4 class="card-title mb-0">Chi tiết đơn hàng #{{ $order->id }}</h4>
                        </div>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-secondary">← Quay lại danh sách</a>
                    </div>

                    <div class="iq-card-body">

                        {{-- Thông tin đơn hàng --}}
                        <div class="card-header font-weight-bold text-center h5 mb-3">Thông tin chung</div>
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width: 200px;">Khách hàng</th>
                                        <td>{{ $order->khachHang->name ?? 'Không xác định' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Số điện thoại</th>
                                        <td>{{ $order->sdt ?? 'Không có' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $order->email ?? 'Không có' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày mua</th>
                                        <td>{{ \Carbon\Carbon::parse($order->ngay_mua)->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Hình thức thanh toán</th>
                                        <td>
                                            @php
                                                $mapPayment = [
                                                    'tien_mat' => 'Tiền mặt',
                                                    'chuyen_khoan' => 'Chuyển khoản',
                                                ];
                                            @endphp
                                            {{ $mapPayment[$order->hinh_thuc_thanh_toan] ?? $order->hinh_thuc_thanh_toan }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Giảm giá</th>
                                        <td>{{ $order->giam_gia }}%</td>
                                    </tr>
                                    <tr>
                                        <th>Tổng số lượng</th>
                                        <td>{{ $order->tong_so_luong }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tổng tiền</th>
                                        <td>{{ number_format($order->tong_tien, 0, ',', '.') }} đ</td>
                                    </tr>
                                    <tr>
                                        <th>Khuyến mãi</th>
                                        <td>{{ optional($order->khuyenMai)->ten ?? 'Không áp dụng' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Địa chỉ giao hàng</th>
                                        <td>{{ $order->dia_chi_giao_hang ?? 'Không có' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Trạng thái</th>
                                        <td>
                                            @php
                                                $badge = match($order->trang_thai) {
                                                    'cho_xu_ly' => 'warning',
                                                    'dang_giao' => 'info',
                                                    'hoan_thanh' => 'primary',
                                                    'huy' => 'danger',
                                                    default => 'secondary',
                                                };

                                                $statusText = [
                                                    'cho_xu_ly' => 'Chờ xử lý',
                                                    'dang_giao' => 'Đang giao',
                                                    'hoan_thanh' => 'Hoàn thành',
                                                    'huy' => 'Hủy',
                                                ];
                                            @endphp
                                            <span class="badge badge-{{ $badge }}">
                                                {{ $statusText[$order->trang_thai] ?? $order->trang_thai }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Cập nhật lần cuối</th>
                                        <td>{{ $order->updated_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- Chi tiết sách --}}
                        <div class="card-header font-weight-bold text-center h5 mb-3">Chi tiết sách trong đơn hàng</div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Danh mục</th>
                                        <th>Tên sách</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th>Thành tiền sau giảm</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $giam = $order->khuyenMai->phan_tram_giam ?? 0; @endphp
                                    @forelse ($order->chiTietDonHang as $index => $ct)
                                        @php
                                            $goc = $ct->so_luong * $ct->don_gia;
                                            $sauGiam = $goc - ($goc * $giam / 100);
                                        @endphp
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $ct->sach->danhMuc->ten ?? 'Không rõ' }}</td> {{-- ✅ Thêm dòng này --}}
                                            <td>{{ $ct->sach->TenSach ?? 'Đã xóa' }}</td>
                                            <td>{{ $ct->so_luong }}</td>
                                            <td>{{ number_format($ct->don_gia, 0, ',', '.') }} đ</td>
                                            <td>{{ number_format($sauGiam, 0, ',', '.') }} đ</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Không có sách nào trong đơn hàng.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Nút chỉnh sửa --}}
                        <div class="text-right mt-4">
                            <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-warning">
                                ✏️ Sửa đơn hàng
                            </a>
                            @if ($order->trang_thai == 'cho_xu_ly' || $order->trang_thai == 'dang_giao')
                                                        <button type="button"
                                                                class="action-btn btn-duyet"
                                                                data-id="{{ $order->id }}"
                                                                data-trangthai="{{ $order->trang_thai }}"
                                                                data-toggle="tooltip" title="Duyệt đơn hàng">
                                                            <i class="ri-check-double-line text-success"></i>
                                                        </button>
                             @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal duyệt đơn -->
<div class="modal fade" id="duyetDonModal" tabindex="-1" role="dialog" aria-labelledby="duyetDonLabel" aria-hidden="true">
  <div class="modal-dialog custom-right-modal" role="document">

    <form method="POST" action="{{ route('admin.orders.approve') }}">
        @csrf
        <input type="hidden" name="order_id" id="modal_order_id">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Duyệt đơn hàng</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p>Chọn trạng thái mới cho đơn hàng:</p>
                <div class="form-group">
                    <select name="new_status" id="modal_new_status" class="form-control" required>
                        <!-- Options sẽ được JS xử lý tùy theo trạng thái hiện tại -->
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </form>
  </div>
</div>
@endsection

@section('styles')
<style>
    .btn-duyet {
        background-color: #2EE59D; /* xanh lá đẹp */
        width: 45px;
        height: 45px;
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease-in-out;
    }

    .btn-duyet:hover {
        background-color: #22cc88;
        transform: translateY(-2px);
    }

    .btn-warning {
        padding: 10px 16px;
        font-size: 16px;
        border-radius: 12px !important;
    }
    /* Modal nằm bên phải */
    #duyetDonModal .modal-dialog {
        margin-left: auto;
        margin-right: 500px; /* cách lề phải một chút */
        width: auto;
        max-width: 450px; /* độ rộng mong muốn */
    }

    /* Nội dung modal */
    #duyetDonModal .modal-content {
        padding: 20px;
        border-radius: 10px;
        width: 100%;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }

    #duyetDonModal .modal-header h5 {
        font-size: 20px;
        font-weight: bold;
    }

    #duyetDonModal .form-group select {
        font-size: 16px;
        padding: 10px;
    }

    #duyetDonModal .modal-footer {
        justify-content: flex-end;
    }
</style>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('.btn-duyet').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const currentStatus = this.dataset.trangthai;

            const statusSelect = document.getElementById('modal_new_status');
            statusSelect.innerHTML = ''; // Clear cũ

            // Thêm trạng thái tiếp theo dựa theo trạng thái hiện tại
            if (currentStatus === 'cho_xu_ly') {
                statusSelect.innerHTML += `<option value="dang_giao">Đang giao</option>`;
            } else if (currentStatus === 'dang_giao') {
                statusSelect.innerHTML += `<option value="hoan_thanh">Hoàn thành</option>`;
            }

            document.getElementById('modal_order_id').value = id;
            $('#duyetDonModal').modal('show');
        });
    });
</script>
@endsection

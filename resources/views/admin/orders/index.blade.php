@extends('layouts.admin')

@section('content')
<!-- Page Content  -->
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Danh sách hóa đơn</h4>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @elseif(session('error'))
                            <div class="alert alert-danger mt-3">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- <div class="iq-card-header-toolbar d-flex align-items-center">
                            <a href="{{ route('admin.orders.create') }}" class="btn btn-primary">Thêm Hóa Đơn</a>
                        </div> -->
                    </div>
                    <div class="iq-card-body">
                        <div class="order-info">
                            <form action="{{ route('admin.orders.index') }}" method="GET" class="mb-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" name="ma_don" class="form-control"
                                               placeholder="Nhập mã hóa đơn (ID)"
                                               value="{{ request('ma_don') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="khach_hang" class="form-control"
                                               placeholder="Nhập tên khách hàng"
                                               value="{{ request('khach_hang') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-success">Tìm kiếm</button>
                                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary ml-2">Reset</a>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                 @php
                                    $hinhThucThanhToanMap = [
                                        'tien_mat' => 'Tiền mặt',
                                        'chuyen_khoan' => 'Chuyển khoản',
                                    ];
                                @endphp
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã hóa đơn</th>
                                            <th>Khách hàng</th>
                                            <th>Ngày mua</th>
                                            <th>Hình thức thanh toán</th>
                                            <th>Giảm giá</th>
                                            <th>Tổng tiền</th>
                                            <th>Tổng số lượng</th>
                                            <th>Khuyến mãi</th>
                                            <th>Trạng thái</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $index => $order)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ optional($order->khachHang)->name ?? 'Không có' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($order->ngay_mua)->format('d/m/Y') }}</td>
                                            <td>{{ $hinhThucThanhToanMap[$order->hinh_thuc_thanh_toan] ?? $order->hinh_thuc_thanh_toan }}</td>
                                            <td>{{ $order->giam_gia }}%</td>
                                            <td>{{ number_format($order->tong_tien, 0, ',', '.') }} đ</td>
                                            <td>{{ $order->tong_so_luong }}</td>
                                            <td>{{ optional($order->khuyenMai)->ten ?? 'Không có' }}</td>
                                            <td>
                                                @if ($order->trang_thai == 'cho_xu_ly')
                                                    <span class="badge badge-warning">Chờ xử lý</span>
                                                @elseif ($order->trang_thai == 'dang_giao')
                                                    <span class="badge badge-info">Đang giao</span>
                                                @elseif ($order->trang_thai == 'hoan_thanh')
                                                    <span class="badge badge-success">Hoàn thành</span>
                                                @elseif ($order->trang_thai == 'huy')
                                                    <span class="badge badge-danger">Hủy</span>
                                                @else
                                                    <span class="badge badge-secondary">{{ $order->trang_thai }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center" style="gap: 6px;">
                                                    @if ($order->trang_thai == 'cho_xu_ly' || $order->trang_thai == 'dang_giao')
                                                        <button type="button"
                                                                class="action-btn btn-duyet"
                                                                data-id="{{ $order->id }}"
                                                                data-trangthai="{{ $order->trang_thai }}"
                                                                data-toggle="tooltip" title="Duyệt đơn hàng">
                                                            <i class="ri-check-double-line text-success"></i>
                                                        </button>
                                                    @else
                                                        <span class="text-muted">--</span>
                                                    @endif
                                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                                       class="action-btn" data-toggle="tooltip" title="Xem chi tiết">
                                                        <i class="ri-eye-line"></i>
                                                    </a>
                                                    <form action="{{ route('admin.orders.cancel', ['id' => $order->id]) }}"
                                                        method="POST" onsubmit="return confirm('Bạn có chắc muốn HỦY đơn hàng này?');">
                                                        @csrf
                                                        <button type="submit" class="action-btn" data-toggle="tooltip" title="Hủy đơn hàng">
                                                            <i class="ri-close-circle-line text-danger"></i>
                                                        </button>
                                                    </form>
                                                    <a href="{{ route('admin.orders.print', $order->id) }}"
                                                    target="_blank"
                                                    class="action-btn"
                                                    data-toggle="tooltip"
                                                    title="In hóa đơn">
                                                        <i class="ri-printer-line text-primary"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Phân trang -->
                                <div class="d-flex justify-content-center">
                                    {{ $orders->appends(request()->query())->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
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


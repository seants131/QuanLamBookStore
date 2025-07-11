<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đơn hàng của tôi</title>
    @include('user.layout.link_chung')
    <style>
        .iq-card {
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            margin-bottom: 20px;
            background: #fff;
        }
        .iq-card-header {
            background: #f7f7f7;
            border-bottom: 1px solid #eee;
            border-radius: 8px 8px 0 0;
            padding: 18px 24px;
        }
        .iq-card-body {
            padding: 24px;
        }
        .badge {
            font-size: 95%;
            padding: 6px 14px;
            border-radius: 12px;
        }
        .btn-outline-primary {
            border-radius: 4px;
            padding: 4px 14px;
            font-size: 15px;
            transition: background 0.2s;
        }
        .btn-outline-primary:hover {
            background: #e7f1ff;
        }
        @media (max-width: 768px) {
            .iq-card-body, .iq-card-header { padding: 12px; }
            .table th, .table td { font-size: 14px; }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        @include('user.layout.header', ['trang' => 'Đơn hàng của tôi'])
        <div id="content-page" class="content-page">
            <div class="container-fluid mt-4">
                <div class="row">
                    <div class="col-lg-10 mx-auto">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0">Đơn hàng của tôi</h4>
                            </div>
                            <div class="iq-card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Mã đơn</th>
                                                <th>Ngày mua</th>
                                                <th>Trạng thái</th>
                                                <th>Tổng tiền</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($orders as $index => $order)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>#{{ $order->id }}</td>
                                                <td>{{ \Carbon\Carbon::parse($order->ngay_mua)->format('d/m/Y') }}</td>
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
                                                <td>{{ number_format($order->tong_tien, 0, ',', '.') }} đ</td>
                                                <td>
                                                    <a href="{{ route('user.orders.detail', $order->id) }}" class="btn btn-sm btn-outline-primary" data-toggle="tooltip" title="Xem chi tiết">
                                                        <i class="ri-eye-line"></i> Xem
                                                    </a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">Bạn chưa có đơn hàng nào.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        {{ $orders->links('pagination::bootstrap-4') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('user.layout.footer')
    </div>
    <!-- JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
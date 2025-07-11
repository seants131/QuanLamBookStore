<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi tiết đơn hàng #{{ $order->id }}</title>
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
        .table th, .table td {
            vertical-align: middle !important;
        }
        @media (max-width: 768px) {
            .iq-card-body, .iq-card-header { padding: 12px; }
            .table th, .table td { font-size: 14px; }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        @include('user.layout.header', ['trang' => 'Chi tiết đơn hàng'])
        <div id="content-page" class="content-page">
            <div class="container-fluid mt-4">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0">Chi tiết đơn hàng #{{ $order->id }}</h4>
                                <a href="{{ route('user.orders.index') }}" class="btn btn-sm btn-secondary">← Quay lại</a>
                            </div>
                            <div class="iq-card-body">
                                <div class="mb-3">
                                    <strong>Ngày mua:</strong> {{ \Carbon\Carbon::parse($order->ngay_mua)->format('d/m/Y H:i') }}<br>
                                    <strong>Trạng thái:</strong>
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
                                    <br>
                                    <strong>Tổng tiền:</strong> {{ number_format($order->tong_tien, 0, ',', '.') }} đ
                                </div>
                                @if(isset($order->chiTiet) && count($order->chiTiet))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Sách</th>
                                                <th>Số lượng</th>
                                                <th>Đơn giá</th>
                                                <th>Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order->chiTiet as $i => $ct)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ $ct->sach->ten_sach ?? 'N/A' }}</td>
                                                <td>{{ $ct->so_luong }}</td>
                                                <td>{{ number_format($ct->don_gia, 0, ',', '.') }} đ</td>
                                                <td>{{ number_format($ct->so_luong * $ct->don_gia, 0, ',', '.') }} đ</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('user.layout.footer')
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hóa đơn #{{ $order->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 40px;
            color: #000;
            background: #fff;
        }

        .invoice-box {
            position: relative;
            width: 100%;
            border: 1px solid #eee;
            padding: 30px;
            border-radius: 10px;
        }

        .invoice-box::after {
            content: '';
            background-image: url('/path/to/logo.png'); /* thay bằng logo nền nếu có */
            background-size: 300px;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.05;
            position: absolute;
            top: 0; left: 0;
            bottom: 0; right: 0;
            z-index: 0;
        }

        .header, .footer, .content {
            position: relative;
            z-index: 1;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        .meta-info {
            margin-top: 5px;
            margin-bottom: 15px;
        }

        .meta-info p {
            margin: 3px 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            font-size: 14px;
        }

        th {
            background-color: #f2f2f2;
        }

        .totals td {
            border: none;
            text-align: right;
            font-weight: bold;
        }

        .totals td:last-child {
            font-weight: normal;
        }

        .section-title {
            font-weight: bold;
            margin-top: 20px;
        }

        ul {
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <h2>HÓA ĐƠN MUA SÁCH</h2>
            <p class="meta-info">
                Mã hóa đơn: <strong>HD{{ $order->id }}</strong><br>
                Ngày tạo: {{ \Carbon\Carbon::parse($order->ngay_mua)->format('d/m/Y') }}
            </p>
        </div>

        <div class="content">
            <p class="section-title">Tên sản phẩm / Số lượng / Giá:</p>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên sách</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->chiTietDonHang as $index => $ct)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $ct->sach->TenSach ?? 'Không rõ' }}</td>
                            <td>{{ number_format($ct->don_gia, 0, ',', '.') }} đ</td>
                            <td>{{ $ct->so_luong }}</td>
                            <td>{{ number_format($ct->thanh_tien, 0, ',', '.') }} đ</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <table class="totals">
                <tr>
                    <td>Giảm giá:</td>
                    <td>{{ $order->giam_gia }}%</td>
                </tr>
                <tr>
                    <td>Tổng tiền:</td>
                    <td>{{ number_format($order->tong_tien, 0, ',', '.') }} đ</td>
                </tr>
                <tr>
                    <td><strong>Cần thu:</strong></td>
                    <td><strong>{{ number_format($order->tong_tien, 0, ',', '.') }} đ</strong></td>
                </tr>
            </table>

            <p class="section-title">Địa chỉ và thông tin người nhận hàng:</p>
            <ul>
                <li><strong>{{ $order->khachHang->name ?? '---' }}</strong> - {{ $order->sdt ?? '---' }}</li>
                <li>Địa chỉ nhận hàng: {{ $order->dia_chi_giao_hang ?? '---' }}</li>
                <li>Email: {{ $order->email ?? '---' }}</li>
                <li>Hình thức thanh toán: {{ $order->hinh_thuc_thanh_toan == 'tien_mat' ? 'Tiền mặt' : 'Chuyển khoản' }}</li>
                <li>Trạng thái:
                    @switch($order->trang_thai)
                        @case('cho_xu_ly') Chờ xử lý @break
                        @case('dang_giao') Đang giao @break
                        @case('hoan_thanh') Hoàn thành @break
                        @case('huy') Đã hủy @break
                        @default {{ $order->trang_thai }}
                    @endswitch
                </li>
            </ul>

            <p class="section-title">Phiếu bảo hành sản phẩm:</p>
            <p>Sản phẩm được bảo hành theo chính sách tại tất cả các trung tâm bảo hành của nhà cung cấp hoặc tại cửa hàng.</p>
        </div>

        <div class="footer" style="text-align: center; margin-top: 30px;">
            <p>Xin cảm ơn quý khách đã tin tưởng và mua hàng tại hệ thống của chúng tôi!</p>
        </div>
    </div>

    <script>
        window.onload = function () {
            window.print();
        };
    </script>
</body>
</html>

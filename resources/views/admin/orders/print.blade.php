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
            background-image: url('/path/to/logo.png'); 
            background-size: 300px;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.05;
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            z-index: 0;
        }

        .header, .footer, .content {
            position: relative;
            z-index: 1;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .header h2 {
            margin: 0;
            font-size: 22px;
        }

        .header img {
            height: 50px;
            margin-right: 10px;
        }

        .brand {
            display: flex;
            align-items: center;
        }

        .meta-info {
            text-align: right;
            font-size: 14px;
        }

        .section-title {
            font-weight: bold;
            margin-top: 25px;
            font-size: 16px;
        }

        ul {
            padding-left: 20px;
            font-size: 14px;
        }

        ul li {
            margin-bottom: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            font-size: 14px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .totals td {
            border: none;
            text-align: right;
            font-size: 15px;
            padding: 6px;
        }

        .totals tr td:first-child {
            font-weight: bold;
            text-align: left;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
        }

        .footer strong {
            display: block;
            margin-top: 10px;
            font-size: 15px;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <!-- Logo + Tiêu đề + Mã đơn -->
         <!-- Tiêu đề trung tâm -->
    <h2 style="text-align: center; font-size: 24px; margin-bottom: 10px;">HÓA ĐƠN MUA SÁCH</h2>
        <div class="header">
            <div class="brand">
                <img src="{{ asset('uploads/books/logo.png') }}" alt="Logo Nhà Sách TV">
                <h2>NHASACHTV</h2>
            </div>
            <div class="meta-info">
                <p><strong>Mã hóa đơn:</strong> HD{{ $order->id }}</p>
                <p><strong>Ngày tạo:</strong> {{ \Carbon\Carbon::parse($order->ngay_mua)->format('d/m/Y') }}</p>
            </div>
        </div>

        <!-- Thông tin người nhận -->
        <p class="section-title">Thông tin người nhận:</p>
        <ul>
            <li>👤 Tên khách hàng: <strong>{{ $order->khachHang->name ?? '---' }}</strong></li>
            <li>📞 Số điện thoại: {{ $order->sdt ?? '---' }}</li>
            <li>🏠 Địa chỉ nhận hàng: {{ $order->dia_chi_giao_hang ?? '---' }}</li>
            <li>✉️ Email: {{ $order->email ?? '---' }}</li>
            <li>💳 Thanh toán: {{ $order->hinh_thuc_thanh_toan == 'tien_mat' ? 'Tiền mặt' : 'Chuyển khoản' }}</li>
            <li>📦 Trạng thái:
                @switch($order->trang_thai)
                    @case('cho_xu_ly') Chờ xử lý @break
                    @case('dang_giao') Đang giao @break
                    @case('hoan_thanh') Hoàn thành @break
                    @case('huy') Đã hủy @break
                    @default {{ $order->trang_thai }}
                @endswitch
            </li>
        </ul>

        <!-- Danh sách sản phẩm -->
        <p class="section-title">Danh sách sản phẩm mua:</p>
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Danh mục (Bộ sách)</th>
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
                        <td>{{ $ct->sach->danhMuc->ten ?? 'Không rõ' }}</td>
                        <td>{{ $ct->sach->TenSach ?? 'Không rõ' }}</td>
                        <td>{{ number_format($ct->don_gia, 0, ',', '.') }} đ</td>
                        <td>{{ $ct->so_luong }}</td>
                        <td>{{ number_format($ct->thanh_tien, 0, ',', '.') }} đ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Tổng tiền -->
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
                <td><strong>{{ number_format($order->tong_tien * (1 - $order->giam_gia / 100), 0, ',', '.') }} đ</strong></td>
            </tr>
        </table>

        <!-- Footer -->
        <div class="footer">
            <p>Xin cảm ơn quý khách đã tin tưởng và mua hàng tại hệ thống của chúng tôi!</p>
            <strong>THÔNG TIN LIÊN HỆ CỬA HÀNG:</strong>
            <p>
                📍 123 Đường Sách, Phường Học Tập, Quận Tri Thức, TP. Giáo Dục<br>
                ☎️ 0909 123 456 – ✉️ lienhe@quanglambookstore.vn<br>
                🌐 www.quanglambookstore.vn
            </p>
        </div>
    </div>

    <script>
        window.onload = function () {
            window.print();
        };
    </script>
</body>
</html>

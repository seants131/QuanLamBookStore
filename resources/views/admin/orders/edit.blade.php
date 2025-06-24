@extends('layouts.admin')

@section('content')
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Chỉnh sửa đơn hàng</h4>
                        </div>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('admin.orders.update', $order->id) }}">
                        @csrf
                        @method('PUT')
                        <a href="{{ route('admin.orders.index') }}" class="close-form-button" title="Đóng">&times;</a>

                        <div class="form-group">
                            <label for="user_id">Khách hàng:</label>
                            <select name="user_id" id="user_id" required class="form-control">
                                <option value="">-- Chọn khách hàng --</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ $order->user_id == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="ngay_mua">Ngày mua:</label>
                            <input type="datetime-local" name="ngay_mua" id="ngay_mua" class="form-control" required
                                value="{{ old('ngay_mua', \Carbon\Carbon::parse($order->ngay_mua)->format('Y-m-d\\TH:i')) }}">
                        </div>

                        <div class="form-group">
                            <label for="trang_thai">Trạng thái:</label>
                            <select name="trang_thai" id="trang_thai" required class="form-control">
                                <option value="cho_xu_ly" {{ $order->trang_thai == 'cho_xu_ly' ? 'selected' : '' }}>Chờ xử lý</option>
                                <option value="dang_giao" {{ $order->trang_thai == 'dang_giao' ? 'selected' : '' }}>Đang giao</option>
                                <option value="hoan_thanh" {{ $order->trang_thai == 'hoan_thanh' ? 'selected' : '' }}>Hoàn thành</option>
                                <option value="huy" {{ $order->trang_thai == 'huy' ? 'selected' : '' }}>Hủy</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="hinh_thuc_thanh_toan">Hình thức thanh toán:</label>
                            <select name="hinh_thuc_thanh_toan" id="hinh_thuc_thanh_toan" required class="form-control">
                                <option value="tien_mat" {{ $order->hinh_thuc_thanh_toan == 'tien_mat' ? 'selected' : '' }}>Tiền mặt</option>
                                <option value="chuyen_khoan" {{ $order->hinh_thuc_thanh_toan == 'chuyen_khoan' ? 'selected' : '' }}>Chuyển khoản</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="giam_gia">Giảm giá (%):</label>
                            <input type="number" name="giam_gia" id="giam_gia" class="form-control" min="0" max="100"
                                value="{{ old('giam_gia', $order->giam_gia) }}">
                        </div>

                        <div class="form-group">
                            <label for="tong_so_luong">Tổng số lượng:</label>
                            <input type="number" name="tong_so_luong" id="tong_so_luong" class="form-control" required min="0"
                                value="{{ old('tong_so_luong', $order->tong_so_luong) }}">
                        </div>

                        <div class="form-group">
                            <label for="tong_tien">Tổng tiền (VND):</label>
                            <input type="number" name="tong_tien" id="tong_tien" class="form-control" required min="0"
                                value="{{ old('tong_tien', $order->tong_tien) }}">
                        </div>

                        <div class="form-group">
                            <label for="khuyen_mai_id">Khuyến mãi (nếu có):</label>
                            <select name="khuyen_mai_id" id="khuyen_mai_id" class="form-control">
                                <option value="">-- Không áp dụng --</option>
                                @foreach ($khuyenMaiList as $km)
                                    <option value="{{ $km->id }}" {{ $order->khuyen_mai_id == $km->id ? 'selected' : '' }}>
                                        {{ $km->ten }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <hr>
                        <h5>Chi tiết sách đã mua</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên sách</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá (Giá bìa)</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->chiTietDonHang as $item)
                                    <tr>
                                        <td>{{ $item->sach->TenSach ?? 'Không tìm thấy sách' }}</td>
                                        <td>{{ $item->so_luong }}</td>
                                        <td>{{ number_format($item->don_gia, 0, ',', '.') }} VND</td>
                                        <td>{{ number_format($item->thanh_tien, 0, ',', '.') }} VND</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="form-group d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">Cập nhật Đơn Hàng</button>
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">← Trở về</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .close-form-button {
        position: absolute;
        top: 15px;
        right: 20px;
        z-index: 10;
        background-color: #dc3545;
        color: white;
        font-size: 22px;
        font-weight: bold;
        border: none;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .close-form-button:hover {
        background-color: #bd2130;
    }

    form {
        background-color: #ffffff;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 1250px;
        margin: auto;
    }

    input,
    select {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    th,
    td {
        vertical-align: middle;
    }

    .btn-sm {
        font-size: 14px;
        padding: 4px 8px;
    }
</style>
@endsection

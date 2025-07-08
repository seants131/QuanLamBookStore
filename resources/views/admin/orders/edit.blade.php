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
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.orders.update', $order->id) }}">
                        @csrf
                        @method('PUT')
                        <a href="{{ route('admin.orders.index') }}" class="close-form-button" title="Đóng">&times;</a>

                        <div class="form-group">
                            <label for="user_id">Khách hàng:</label>
                            <select name="user_id" id="user_id" required class="form-control" disabled>
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
                            <input type="datetime-local" name="ngay_mua" id="ngay_mua" class="form-control" required disabled
                                value="{{ old('ngay_mua', \Carbon\Carbon::parse($order->ngay_mua)->format('Y-m-d\TH:i')) }}">
                        </div>

                        <div class="form-group">
                            <label for="trang_thai">Trạng thái:</label>
                            <select name="trang_thai" id="trang_thai" required class="form-control" disabled>
                                <option value="cho_xu_ly" {{ $order->trang_thai == 'cho_xu_ly' ? 'selected' : '' }}>Chờ xử lý</option>
                                <option value="dang_giao" {{ $order->trang_thai == 'dang_giao' ? 'selected' : '' }}>Đang giao</option>
                                <option value="hoan_thanh" {{ $order->trang_thai == 'hoan_thanh' ? 'selected' : '' }}>Hoàn thành</option>
                                <option value="huy" {{ $order->trang_thai == 'huy' ? 'selected' : '' }}>Hủy</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="hinh_thuc_thanh_toan">Hình thức thanh toán:</label>
                            <select name="hinh_thuc_thanh_toan" id="hinh_thuc_thanh_toan" required class="form-control" disabled>
                                <option value="tien_mat" {{ $order->hinh_thuc_thanh_toan == 'tien_mat' ? 'selected' : '' }}>Tiền mặt</option>
                                <option value="chuyen_khoan" {{ $order->hinh_thuc_thanh_toan == 'chuyen_khoan' ? 'selected' : '' }}>Chuyển khoản</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="khuyen_mai_id">Khuyến mãi (nếu có):</label>
                            <select name="khuyen_mai_id" id="khuyen_mai_id" class="form-control" disabled>
                                <option value="">-- Không áp dụng --</option>
                                @foreach ($khuyenMaiList as $km)
                                    <option value="{{ $km->id }}" data-phantram="{{ $km->phan_tram_giam }}"
                                        {{ $order->khuyen_mai_id == $km->id ? 'selected' : '' }}>
                                        {{ $km->ten }} ({{ $km->phan_tram_giam }}%)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="sdt">Số điện thoại</label>
                            <input type="text" name="sdt" class="form-control" value="{{ old('sdt', $order->khachHang->so_dien_thoai ?? '') }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $order->khachHang->email ?? '') }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="dia_chi_giao_hang">Địa chỉ giao hàng</label>
                            <textarea name="dia_chi_giao_hang" class="form-control" rows="2" required>{{ old('dia_chi_giao_hang', $order->dia_chi_giao_hang ?? '') }}</textarea>
                        </div>

                        <hr>
                        <h5>Chi tiết sách đã mua</h5>
                        <table class="table table-bordered" id="bang-chitiet">
                            <thead>
                                <tr>
                                    <th>Danh mục</th>
                                    <th>Tên sách</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá (Giá bìa)</th>
                                    <th>Thành tiền (đã giảm)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $tongSoLuong = 0;
                                    $tongTien = 0;
                                @endphp
                                @foreach ($order->chiTietDonHang as $item)
                                    @php
                                        $giam = $order->khuyenMai->phan_tram_giam ?? 0;
                                        $goc = $item->don_gia * $item->so_luong;
                                        $daGiam = $goc - ($goc * $giam / 100);
                                        $tongSoLuong += $item->so_luong;
                                        $tongTien += $daGiam;
                                    @endphp
                                    <tr>
                                        <td>{{ $item->sach->danhMuc->ten ?? 'Không rõ' }}</td> {{-- ✅ Thêm dòng này --}}
                                        <td>{{ $item->sach->TenSach ?? 'Không tìm thấy sách' }}</td>
                                        <td><input type="number" name="so_luong[{{ $item->id }}]" class="form-control so_luong" value="{{ $item->so_luong }}" min="1" required></td>
                                        <td>{{ number_format($item->don_gia, 0, ',', '.') }} VND</td>
                                        <td>{{ number_format($daGiam, 0, ',', '.') }} VND</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="form-group">
                            <label for="tong_so_luong">Tổng số lượng:</label>
                            <input type="number" name="tong_so_luong" id="tong_so_luong" class="form-control" required readonly value="{{ $tongSoLuong }}">
                        </div>

                        <div class="form-group">
                            <label for="tong_tien">Tổng tiền sau giảm:</label>
                            <input type="number" name="tong_tien" id="tong_tien" class="form-control" required readonly value="{{ round($tongTien) }}">
                        </div>

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
</style>
@endsection

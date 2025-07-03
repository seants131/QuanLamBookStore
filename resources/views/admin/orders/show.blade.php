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
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

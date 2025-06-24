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

                        {{-- Thông tin chung --}}
                        <div class="card-header font-weight-bold text-center h5">Thông tin chung</div>
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width: 200px;">Khách hàng</th>
                                        <td>{{ $order->khachHang->name ?? 'Không xác định' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày mua</th>
                                        <td>{{ \Carbon\Carbon::parse($order->ngay_mua)->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Hình thức thanh toán</th>
                                        <td>{{ ucfirst(str_replace('_', ' ', $order->hinh_thuc_thanh_toan)) }}</td>
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
                                        <td>{{ $order->khuyenMai->ten ?? 'Không áp dụng' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Trạng thái</th>
                                        <td>
                                            @switch($order->trang_thai)
                                                @case('cho_xu_ly')
                                                    <span class="badge badge-warning">Chờ xử lý</span>
                                                    @break
                                                @case('dang_giao')
                                                    <span class="badge badge-info">Đang giao</span>
                                                    @break
                                                @case('hoan_thanh')
                                                    <span class="badge badge-primary">Hoàn thành</span>
                                                    @break
                                                @case('huy')
                                                    <span class="badge badge-danger">Đã hủy</span>
                                                    @break
                                                @default
                                                    <span class="badge badge-secondary">{{ ucfirst(str_replace('_', ' ', $order->trang_thai)) }}</span>
                                            @endswitch
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
                        <div class="card-header font-weight-bold text-center h5">Chi tiết sách trong đơn hàng</div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Tên sách</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá (Giá bìa)</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($order->chiTietDonHang as $index => $ct)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $ct->sach->TenSach ?? 'Đã xóa' }}</td>
                                            <td>{{ $ct->so_luong }}</td>
                                            <td>{{ number_format($ct->don_gia, 0, ',', '.') }} đ</td>
                                            <td>{{ number_format($ct->thanh_tien, 0, ',', '.') }} đ</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Không có sách nào trong hóa đơn.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="text-right mt-4">
                            <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-warning">✏️ Sửa đơn hàng</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

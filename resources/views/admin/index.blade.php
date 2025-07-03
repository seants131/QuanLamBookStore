@extends('layouts.admin')

@section('content')
    <!-- Page Content  -->
    <div id="content-page" class="content-page">
            <div class="container-fluid">
               <div class="row">
                  <!-- Tổng Người Dùng -->
                  <div class="col-md-6 col-lg-3">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body">
                           <div class="d-flex align-items-center">
                              <div class="rounded-circle iq-card-icon bg-primary"><i class="ri-user-line"></i></div>
                              <div class="text-left ml-3">                                 
                                 <h2 class="mb-0"><span class="counter">{{ number_format($totalUsers) }}</span></h2>
                                 <h5 class="">Người Dùng</h5>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Tổng Sách -->
                  <div class="col-md-6 col-lg-3">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body">
                           <div class="d-flex align-items-center">
                              <div class="rounded-circle iq-card-icon bg-danger"><i class="ri-book-line"></i></div>
                              <div class="text-left ml-3">                                 
                              <h2 class="mb-0"><span class="counter">{{ number_format($totalBooks) }}</span></h2>
                              <h5 class="">Sách</h5>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Tổng Đơn Hàng -->
                  <div class="col-md-6 col-lg-3">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body">
                           <div class="d-flex align-items-center">
                              <div class="rounded-circle iq-card-icon bg-warning"><i class="ri-shopping-cart-2-line"></i></div>
                              <div class="text-left ml-3">                                 
                              <h2 class="mb-0"><span class="counter">{{ number_format($totalOrders) }}</span></h2>
                              <h5 class="">Đơn Hàng</h5>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Đơn Chờ -->
                  <div class="col-md-6 col-lg-3">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-body">
                           <div class="d-flex align-items-center">
                              <div class="rounded-circle iq-card-icon bg-info"><i class="ri-radar-line"></i></div>
                              <div class="text-left ml-3">                                 
                                 <h2 class="mb-0"><span class="counter">{{ number_format($pendingOrders) }}</span></h2>
                                 <h5 class="">Chờ xử lý</h5>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- <div class="col-md-4">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between align-items-center">
                           <div class="iq-header-title">
                              <h4 class="card-title mb-0">Doanh số hàng ngày</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <div id="iq-sale-chart"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between align-items-center">
                           <div class="iq-header-title">
                              <h4 class="card-title mb-0">Tóm lược</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <ul class="list-inline p-0 mb-0">
                              <li>
                                 <div class="iq-details mb-2">
                                    <span class="title">Thu nhập</span>
                                    <div class="percentage float-right text-primary">95 <span>%</span></div>
                                    <div class="iq-progress-bar-linear d-inline-block w-100">
                                       <div class="iq-progress-bar iq-bg-primary">
                                          <span class="bg-primary" data-percent="90"></span>
                                       </div>
                                    </div>
                                 </div>                                       
                              </li>
                              <li>
                                 <div class="iq-details mb-2">
                                    <span class="title">Lợi nhuận</span>
                                    <div class="percentage float-right text-warning">72 <span>%</span></div>
                                    <div class="iq-progress-bar-linear d-inline-block w-100">
                                       <div class="iq-progress-bar iq-bg-warning">
                                          <span class="bg-warning" data-percent="75"></span>
                                       </div>
                                    </div>
                                 </div>
                              </li>
                              <li>
                                <div class="iq-details mb-2">
                                    <span class="title">Chi phí</span>
                                    <div class="percentage float-right text-info">75 <span>%</span></div>
                                    <div class="iq-progress-bar-linear d-inline-block w-100">
                                       <div class="iq-progress-bar iq-bg-info">
                                          <span class="bg-info" data-percent="65"></span>
                                       </div>
                                    </div>
                                 </div> 
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                           <div class="iq-card-body">
                              <h4 class="text-uppercase text-black mb-0">Phiên (Bây giờ)</h4>
                              <div class="d-flex justify-content-between align-items-center">
                                 <div class="font-size-80 text-black">12</div>
                                 <div class="text-left">
                                    <p class="m-0 text-uppercase font-size-12">1 giờ</p>
                                    <div class="mb-1 text-black">1500<span class="text-danger"><i class="ri-arrow-down-s-fill"></i>3.25%</span></div>
                                    <p class="m-0 text-uppercase font-size-12">1 ngày</p>
                                    <div class="mb-1 text-black">1890<span class="text-success"><i class="ri-arrow-down-s-fill"></i>1.00%</span></div>
                                    <p class="m-0 text-uppercase font-size-12">1 tuần</p>
                                    <div class="text-black">1260<span class="text-danger"><i class="ri-arrow-down-s-fill"></i>9.87%</span></div>
                                 </div>
                              </div>
                              <div id="wave-chart-7"></div>
                           </div>
                        </div>
                  </div> -->
                  <!-- Thống kê sách bán ra -->
                  <div class="col-md-12">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between align-items-center">
                              <div class="iq-header-title">
                                 <h4 class="card-title mb-0">Thống kê sách bán ra</h4>
                              </div>
                              <form id="form-thong-ke-sach" class="form-inline">
                                 <label class="mr-2">Từ ngày:</label>
                                 <input type="date" id="sach_tu_ngay" class="form-control mr-2">
                                 <label class="mr-2">Đến ngày:</label>
                                 <input type="date" id="sach_den_ngay" class="form-control mr-2">
                                 <button type="submit" class="btn btn-sm btn-primary">Thống kê</button>
                              </form>
                        </div>
                        <div class="iq-card-body">
                              <div id="chart-sach-ban" style="height: 400px;"></div>
                        </div>
                     </div>
                  </div>
                  <!-- Doanh số theo ngày -->
                  <div class="col-md-12">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between align-items-center">
                           <div class="iq-header-title">
                              <h4 class="card-title mb-0">Doanh số theo ngày</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <div id="chart-doanh-so-ngay" style="height: 400px;"></div>
                        </div>
                     </div>
                  </div>

                  <!-- Thống kê trạng thái đơn hàng -->
                  <div class="col-md-12">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between align-items-center">
                           <div class="iq-header-title">
                              <h4 class="card-title mb-0">Thống kê trạng thái đơn hàng</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <div id="chart-trang-thai" style="height: 400px;"></div>
                        </div>
                     </div>
                  </div>

                  <!-- Tồn kho và đã bán -->
                  <div class="col-md-12">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between align-items-center">
                           <div class="iq-header-title">
                              <h4 class="card-title mb-0">Tồn kho và sách đã bán</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <div id="chart-ton-kho" style="height: 400px;"></div>
                        </div>
                     </div>
                  </div>

                  <!-- Tài chính tổng quát -->
                  <div class="col-md-12">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between align-items-center">
                           <div class="iq-header-title">
                              <h4 class="card-title mb-0">Tài chính tổng quát</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <ul>
                              <li><strong>Doanh thu:</strong> <span id="doanh-thu">...</span> đ</li>
                              <li><strong>Chi phí:</strong> <span id="chi-phi">...</span> đ</li>
                              <li><strong>Lợi nhuận:</strong> <span id="loi-nhuan">...</span> đ</li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <!-- Bảng hóa đơn -->
                  <div class="col-sm-12">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Mở hóa đơn</h4>
                           </div>
                           <!-- <div class="iq-card-header-toolbar d-flex align-items-center">
                              <div class="dropdown">
                                 <span class="dropdown-toggle text-primary" id="dropdownMenuButton5" data-toggle="dropdown">
                                 <i class="ri-more-fill"></i>
                                 </span>
                                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton5">
                                    <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>Xem</a>
                                    <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Xoá</a>
                                    <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Sửa</a>
                                    <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>In</a>
                                    <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Tải xuống</a>
                                 </div>
                              </div>
                           </div> -->
                        </div>
                        <div class="iq-card-body">
                           <div class="order-info">
                           <div class="table-responsive">
                               <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã đơn</th>
                                            <th>Khách hàng</th>
                                            <th>Ngày mua</th>
                                            <th>Hình thức thanh toán</th>
                                            <th>Giảm giá</th>
                                            <th>Tổng tiền</th>
                                            <th>Số lượng</th>
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
                                            <td>{{ $order->khachHang->name ?? 'N/A' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($order->ngay_mua)->format('d/m/Y') }}</td>
                                            <td>{{ ucfirst(str_replace('_', ' ', $order->hinh_thuc_thanh_toan)) }}</td>
                                            <td>{{ $order->giam_gia }}%</td>
                                            <td>{{ number_format($order->tong_tien, 0, ',', '.') }} đ</td>
                                            <td>{{ $order->tong_so_luong }}</td>
                                            <td>{{ $order->khuyenMai->ten_khuyen_mai ?? 'Không có' }}</td>
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
                                                    <a href="{{ route('admin.orders.edit', $order->id) }}"
                                                       class="action-btn" data-toggle="tooltip" title="Sửa">
                                                        <i class="ri-pencil-line"></i>
                                                    </a>

                                                    <form action="{{ route('admin.orders.destroy', $order->id) }}"
                                                          method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="action-btn" data-toggle="tooltip" title="Xóa">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                           </div>
                        </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Wrapper END -->
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.35.3/dist/apexcharts.min.js"></script>
<script>
    let chartSachBan = null;
    let chartDoanhSo = null;
    let chartTrangThai = null;
    let chartTonKho = null;

    async function loadChart() {
        const tuNgay = document.getElementById('sach_tu_ngay').value;
        const denNgay = document.getElementById('sach_den_ngay').value;

        document.querySelector("#chart-sach-ban").innerHTML = "Đang tải dữ liệu...";
        const response = await fetch(`/admin/ajax-thong-ke-sach?tu_ngay=${tuNgay}&den_ngay=${denNgay}`);
        const data = await response.json();

        const tenSach = data.map(item => item.ten_sach || 'Không rõ');
        const soLuong = data.map(item => Number(item.tong_so_luong || 0));

        if (chartSachBan) chartSachBan.destroy();

        chartSachBan = new ApexCharts(document.querySelector("#chart-sach-ban"), {
            chart: { type: 'bar', height: 400 },
            series: [{ name: "Số lượng bán", data: soLuong }],
            title: { text: 'Thống kê sách bán ra', align: 'center' },
            subtitle: { text: `Từ ${tuNgay} đến ${denNgay}`, align: 'center' },
            xaxis: {
                categories: tenSach,
                labels: { rotate: -45, style: { fontSize: '13px' } }
            },
            plotOptions: { bar: { dataLabels: { position: 'top' } } },
            dataLabels: {
                enabled: true, offsetY: -20,
                style: { fontSize: '13px', colors: ['#2d3436'] }
            },
            tooltip: {
                y: { formatter: val => `${val} quyển` }
            },
            colors: ['#00b894', '#0984e3', '#fd79a8', '#6c5ce7', '#e17055'],
            noData: { text: 'Không có dữ liệu' }
        });
        chartSachBan.render();
    }

    async function loadChartDoanhSoNgay() {
        const tuNgay = document.getElementById('sach_tu_ngay').value;
        const denNgay = document.getElementById('sach_den_ngay').value;

        document.querySelector("#chart-doanh-so-ngay").innerHTML = "Đang tải dữ liệu...";
        const res = await fetch(`/ajax-doanh-so-ngay?tu_ngay=${tuNgay}&den_ngay=${denNgay}`);
        const data = await res.json();

        const labels = data.map(d => d.ngay);
        const values = data.map(d => d.doanh_so);

        if (chartDoanhSo) chartDoanhSo.destroy();

        chartDoanhSo = new ApexCharts(document.querySelector("#chart-doanh-so-ngay"), {
            chart: { type: 'line', height: 400 },
            series: [{ name: 'Doanh số', data: values }],
            xaxis: { categories: labels },
            title: { text: 'Doanh số theo ngày', align: 'center' }
        });
        chartDoanhSo.render();
    }

    async function loadChartTrangThai() {
        document.querySelector("#chart-trang-thai").innerHTML = "Đang tải dữ liệu...";
        const res = await fetch('/ajax-thong-ke-trang-thai-don');
        const data = await res.json();

        const labels = data.map(d => d.trang_thai);
        const values = data.map(d => d.so_luong);

        if (chartTrangThai) chartTrangThai.destroy();

        chartTrangThai = new ApexCharts(document.querySelector("#chart-trang-thai"), {
            chart: { type: 'donut', height: 400 },
            series: values,
            labels: labels,
            title: { text: 'Trạng thái đơn hàng', align: 'center' }
        });
        chartTrangThai.render();
    }

    async function loadChartTonKho() {
        document.querySelector("#chart-ton-kho").innerHTML = "Đang tải dữ liệu...";
        const res = await fetch('/ajax-ton-kho-va-ban');
        const data = await res.json();

        const labels = data.map(d => d.ten_sach);
        const tonKho = data.map(d => d.ton_kho);
        const daBan = data.map(d => d.da_ban);

        if (chartTonKho) chartTonKho.destroy();

        chartTonKho = new ApexCharts(document.querySelector("#chart-ton-kho"), {
            chart: { type: 'bar', height: 400 },
            series: [
                { name: 'Tồn kho', data: tonKho },
                { name: 'Đã bán', data: daBan }
            ],
            xaxis: { categories: labels },
            title: { text: 'Tồn kho và đã bán', align: 'center' },
            colors: ['#00cec9', '#fdcb6e']
        });
        chartTonKho.render();
    }

    async function loadTaiChinhTongQuat() {
    const tuNgay = document.getElementById('sach_tu_ngay').value;
    const denNgay = document.getElementById('sach_den_ngay').value;

    try {
        const res = await fetch(`/ajax-tai-chinh?tu_ngay=${tuNgay}&den_ngay=${denNgay}`);
        const data = await res.json();

        if (data.error) {
            console.error("Lỗi từ API:", data.message);
            return;
        }

        document.getElementById('doanh-thu').textContent = number_format(data.doanh_thu);
        document.getElementById('chi-phi').textContent = number_format(data.chi_phi);
        document.getElementById('loi-nhuan').textContent = number_format(data.loi_nhuan);
    } catch (err) {
        console.error("Lỗi khi gọi API tài chính:", err);
    }
}


    function number_format(x) {
        return Number(x).toLocaleString('vi-VN');
    }

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('form-thong-ke-sach');
        const tuNgayInput = document.getElementById('sach_tu_ngay');
        const denNgayInput = document.getElementById('sach_den_ngay');

        const today = new Date().toISOString().slice(0, 10);
        const firstDay = new Date(); firstDay.setDate(1);
        tuNgayInput.value = firstDay.toISOString().slice(0, 10);
        denNgayInput.value = today;

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            loadAllCharts();
        });

        loadAllCharts();
    });

    function loadAllCharts() {
        loadChart();
        loadChartDoanhSoNgay();
        loadChartTrangThai();
        loadChartTonKho();
        loadTaiChinhTongQuat();
    }
</script>
@endsection

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
                  <!-- Thống kê sách bán ra -->
                  <div class="col-md-12">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between align-items-center">
                           <div class="iq-header-title">
                              <h4 class="card-title mb-0">Thống kê hóa đơn theo thời gian</h4>
                           </div>
                           <form id="form-thong-ke-sach" class="form-inline">
                              <label class="mr-2">Từ ngày:</label>
                              <input type="date" id="sach_tu_ngay" class="form-control mr-2">
                              <label class="mr-2">Đến ngày:</label>
                              <input type="date" id="sach_den_ngay" class="form-control mr-2">
                              <button type="button" id="btn-export-hoa-don" class="btn btn-sm btn-success ml-2">Xuất Excel</button>
                           </form>
                        </div>
                        <div class="iq-card-body">
                           <div id="chart-hoa-don" style="height: 400px;"></div>
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
                              <h4 class="card-title mb-0">Thống kê đơn hàng theo trạng thái</h4>
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
                              <h4 class="card-title mb-0">Thống kê tồn kho và đã bán - 10 sách nổi bật</h4>
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
               </div>
            </div>
         </div>
      </div>
      <!-- Wrapper END -->
       <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.35.3/dist/apexcharts.min.js"></script>
<script>
   function formatNgayDMY(dateStr) {
    const [y, m, d] = dateStr.split("-");
    return `${parseInt(d)}/${parseInt(m)}/${y}`; // Không có số 0 đầu
   }


    let chartSachBan = null;
    let chartDoanhSo = null;
    let chartTrangThai = null;
    let chartTonKho = null;

    async function loadChartHoaDon() {
      const tuNgay = document.getElementById('sach_tu_ngay').value;
      const denNgay = document.getElementById('sach_den_ngay').value;

      document.querySelector("#chart-hoa-don").innerHTML = "Đang tải dữ liệu...";

      const response = await fetch(`/admin/ajax-thong-ke-hoa-don?tu_ngay=${tuNgay}&den_ngay=${denNgay}`);
      const data = await response.json();

      const ngay = data.map(item => item.ngay || '');
      const tongTien = data.map(item => Number(item.tong_tien) || 0);
      const sachBan = data.map(item => item.sach_ban || '');

      if (chartSachBan) chartSachBan.destroy();

      chartSachBan = new ApexCharts(document.querySelector("#chart-hoa-don"), {
         chart: { type: 'bar', height: 400 },
         series: [{ name: "Tổng tiền", data: tongTien }],
         title: { text: 'Thống kê hóa đơn theo ngày', align: 'center' },
         subtitle: {
            text: `Từ ${formatNgayDMY(tuNgay)} đến ${formatNgayDMY(denNgay)}`,
            align: 'center'
         },
         xaxis: {
            categories: ngay,
            labels: { rotate: -45, style: { fontSize: '13px' } }
         },
         plotOptions: { bar: { dataLabels: { position: 'top' } } },
         dataLabels: {
            enabled: true, offsetY: -20,
            style: { fontSize: '13px', colors: ['#2d3436'] }
         },
         tooltip: {
            custom: function({ series, seriesIndex, dataPointIndex }) {
               const tong = series[seriesIndex][dataPointIndex];
               const sach = sachBan[dataPointIndex];
               return `<div class="px-2 py-1 text-left">
                        <strong>Tổng tiền:</strong> ${number_format(tong)} đ<br>
                        <strong>Sách bán:</strong><br> ${sach.replace(/, /g, '<br>')}
                        </div>`;
            }
         },
         colors: ['#00b894'],
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

        const labels = data.map(d => {
            const [year, month, day] = d.ngay.split('-');
            return `${day}/${month}/${year}`;
        });

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

        const statusMap = {
            'cho_xu_ly': 'Chờ xử lý',
            'dang_giao': 'Đang giao',
            'hoan_thanh': 'Hoàn thành',
            'huy': 'Hủy'
         };

        const labels = data.map(d => statusMap[d.trang_thai] || d.trang_thai);

        const values = data.map(d => d.so_luong);

        if (chartTrangThai) chartTrangThai.destroy();

        chartTrangThai = new ApexCharts(document.querySelector("#chart-trang-thai"), {
            chart: { type: 'donut', height: 400 },
            series: values,
            labels: labels,
            title: { text: 'Đơn hàng theo trạng thái', align: 'center' }
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
            title: { text: 'Top 10 sách có số lượng bán ra cao nhất', align: 'center' },
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
        loadChartHoaDon();
        loadChartDoanhSoNgay();
        loadChartTrangThai();
        loadChartTonKho();
        loadTaiChinhTongQuat();
    }
    document.getElementById('btn-export-hoa-don').addEventListener('click', async function () {
    const tuNgay = document.getElementById('sach_tu_ngay').value;
    const denNgay = document.getElementById('sach_den_ngay').value;

    const res = await fetch(`/admin/xuat-du-lieu-hoa-don?tu_ngay=${tuNgay}&den_ngay=${denNgay}`);
    const data = await res.json();

    if (!data || data.length === 0) {
        alert("Không có dữ liệu để xuất.");
        return;
    }

    const header = [
        "Mã hóa đơn",
        "Khách hàng",
        "Số điện thoại",
        "Email",
        "Ngày mua",
        "Danh mục",
        "Tên sách",
        "Giá bìa",
        "Số lượng",
        "Thành tiền"
    ];

    const bodyData = data.map(row => [
        row["Mã hóa đơn"],
        row["Khách hàng"],
        row["Số điện thoại"],
        row["Email"],
        row["Ngày mua"],
        row["Danh mục"],
        row["Tên sách"],
        row["Giá bìa"],
        row["Số lượng"],
        row["Thành tiền"]
    ]);

    const tongTien = data.reduce((sum, r) => sum + (parseFloat(r["Thành tiền"]) || 0), 0);

    const sheetData = [
        ["DANH SÁCH CHI TIẾT HÓA ĐƠN"],
        [`Từ ngày: ${formatNgayDMY(tuNgay)} đến ${formatNgayDMY(denNgay)}`],
        [`Xuất lúc: ${new Date().toLocaleString('vi-VN')}`],
        [],
        header,
        ...bodyData,
        [],
        ["", "", "", "", "", "", "", "", "Tổng tiền hóa đơn:", tongTien]
    ];

    const ws = XLSX.utils.aoa_to_sheet(sheetData);
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "ChiTietHoaDon");

    const fileName = `ChiTietHoaDon_${tuNgay}_den_${denNgay}.xlsx`;
    XLSX.writeFile(wb, fileName);
});

// Hàm format ngày từ yyyy-mm-dd sang dd/mm/yyyy
function formatNgayDMY(dateStr) {
    if (!dateStr) return '';
    const [y, m, d] = dateStr.split('-');
    return `${d}/${m}/${y}`;
}
</script>
@endsection

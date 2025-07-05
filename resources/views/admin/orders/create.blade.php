@extends('layouts.admin')

@section('content')
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Tạo đơn hàng mới</h4>
                        </div>
                    </div>

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.orders.store') }}" method="POST">
                        @csrf
                        <a href="{{ route('admin.orders.index') }}" class="close-form-button" title="Đóng">&times;</a>

                        <div class="form-group">
                            <label for="user_id">Khách hàng</label>
                            <select name="user_id" class="form-control" required>
                                <option value="">-- Chọn khách hàng --</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="ngay_mua">Ngày mua</label>
                            <input type="date" name="ngay_mua" class="form-control" value="{{ old('ngay_mua', date('Y-m-d')) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="trang_thai">Trạng thái</label>
                            <select name="trang_thai" class="form-control" required>
                                <option value="cho_xu_ly">Chờ xử lý</option>
                                <option value="dang_giao">Đang giao</option>
                                <option value="hoan_thanh">Hoàn thành</option>
                                <option value="huy">Hủy</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="hinh_thuc_thanh_toan">Hình thức thanh toán</label>
                            <select name="hinh_thuc_thanh_toan" class="form-control" required>
                                <option value="tien_mat">Tiền mặt</option>
                                <option value="chuyen_khoan">Chuyển khoản</option>
                            </select>
                        </div>

                        <hr>
                        <h5>Danh sách sách mua</h5>
                        <table class="table table-bordered" id="table-sach">
                            <thead>
                                <tr>
                                    <th>Danh mục</th>
                                    <th>Sách</th>
                                    <th>Số lượng</th>
                                    <th>Đơn Giá</th>
                                    <th>Thành tiền</th>
                                    <th><button type="button" class="btn btn-success btn-sm" onclick="addRow()">+</button></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="form-control danh-muc-select" required>
                                            <option value="">-- Chọn danh mục --</option>
                                            @foreach ($danhMucs as $dm)
                                                <option value="{{ $dm->id }}">{{ $dm->ten }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="sach_id[]" class="form-control sach-select" required disabled>
                                            <option value="">-- Chọn sách --</option>
                                        </select>
                                    </td>
                                    <td><input type="number" name="so_luong[]" class="form-control so_luong" min="0" value="0" required></td>
                                    <td><input type="number" name="don_gia[]" class="form-control don_gia" readonly></td>
                                    <td><input type="number" name="thanh_tien[]" class="form-control thanh_tien" readonly></td>
                                    <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">-</button></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="form-group">
                            <label for="khuyen_mai_id">Khuyến mãi (nếu có)</label>
                            <select name="khuyen_mai_id" class="form-control">
                                <option value="">-- Không áp dụng --</option>
                                @foreach ($khuyenMaiList as $km)
                                    <option value="{{ $km->id }}">{{ $km->ten }} ({{ $km->phan_tram_giam }}%)</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="sdt">Số điện thoại</label>
                            <input type="text" name="sdt" class="form-control" value="{{ old('sdt') }}" placeholder="Nhập số điện thoại">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Nhập email">
                        </div>

                        <div class="form-group">
                            <label for="dia_chi_giao_hang">Địa chỉ giao hàng</label>
                            <textarea name="dia_chi_giao_hang" class="form-control" rows="3" required>{{ old('dia_chi_giao_hang', $order->dia_chi_giao_hang ?? '') }}</textarea>
                        </div>

                        <input type="hidden" name="tong_tien" id="tong_tien_input">
                        <input type="hidden" name="tong_so_luong" id="tong_so_luong_input">

                        <div class="form-group d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">Lưu đơn hàng</button>
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">← Trở về</a>
                        </div>
                    </form>

                    @section('scripts')
                    <script>
                        const allBooks = @json($sachs);

                        function calculateRow(row) {
                            const soLuong = parseInt(row.querySelector('.so_luong').value) || 0;
                            const donGia = parseFloat(row.querySelector('.don_gia').value) || 0;

                            // Lấy % khuyến mãi đang chọn
                            const selectKM = document.querySelector('select[name="khuyen_mai_id"]');
                            const selectedOption = selectKM.options[selectKM.selectedIndex];
                            const giamGia = parseInt(selectedOption?.textContent?.match(/\d+/)?.[0]) || 0;

                            // Tính tiền sau giảm
                            const thanhTienGoc = soLuong * donGia;
                            const thanhTienGiam = thanhTienGoc - (thanhTienGoc * giamGia / 100);

                            // Gán vào ô Thành tiền (hiển thị số sau giảm)
                            row.querySelector('.thanh_tien').value = thanhTienGiam.toFixed(0);

                            updateTotals();
                        }

                        function updateTotals() {
                            let total = 0, totalQty = 0;
                            document.querySelectorAll('#table-sach tbody tr').forEach(row => {
                                const qty = parseInt(row.querySelector('.so_luong').value) || 0;
                                const price = parseFloat(row.querySelector('.don_gia').value) || 0;
                                total += qty * price;
                                totalQty += qty;
                            });

                            const selectKM = document.querySelector('select[name="khuyen_mai_id"]');
                            const selectedOption = selectKM.options[selectKM.selectedIndex];
                            const giamGia = parseInt(selectedOption?.textContent?.match(/\d+/)?.[0]) || 0;
                            const tongTienGiam = total - (total * giamGia / 100);

                            document.getElementById('tong_tien_input').value = Math.round(tongTienGiam);
                            document.getElementById('tong_so_luong_input').value = totalQty;

                            document.getElementById('tong_tien_display').innerText = total.toLocaleString();
                            document.getElementById('giam_gia_display').innerText = giamGia;
                            document.getElementById('tong_tien_giam_display').innerText = tongTienGiam.toLocaleString();
                        }

                        function attachRowEvents(row) {
                            const danhMucSelect = row.querySelector('.danh-muc-select');
                            const sachSelect = row.querySelector('.sach-select');
                            const donGiaInput = row.querySelector('.don_gia');

                            danhMucSelect.addEventListener('change', function () {
                                const dmId = this.value;
                                const filteredBooks = allBooks.filter(book => book.danh_muc_id == dmId);
                                const options = filteredBooks.map(book =>
                                    `<option value="${book.MaSach}" data-dongia="${book.GiaBia}">${book.TenSach}</option>`
                                );
                                sachSelect.innerHTML = '<option value="">-- Chọn sách --</option>' + options.join('');
                                sachSelect.disabled = false;
                            });

                            sachSelect.addEventListener('change', function () {
                                const selected = this.options[this.selectedIndex];
                                donGiaInput.value = selected.getAttribute('data-dongia') || 0;
                                calculateRow(row);
                            });

                            row.querySelector('.so_luong').addEventListener('input', () => {
                                calculateRow(row);
                            });
                        }

                        function addRow() {
                            const table = document.querySelector('#table-sach tbody');
                            const row = table.rows[0].cloneNode(true);

                            row.querySelectorAll('input').forEach(input => input.value = input.classList.contains('so_luong') ? 0 : '');
                            row.querySelector('.don_gia').value = '';
                            row.querySelector('.thanh_tien').value = '';
                            row.querySelector('.danh-muc-select').selectedIndex = 0;
                            const sachSelect = row.querySelector('.sach-select');
                            sachSelect.innerHTML = '<option value="">-- Chọn sách --</option>';
                            sachSelect.disabled = true;

                            table.appendChild(row);
                            attachRowEvents(row);
                        }

                        function removeRow(button) {
                            const row = button.closest('tr');
                            const table = document.querySelector('#table-sach tbody');
                            if (table.rows.length > 1) row.remove();
                            else alert('Phải có ít nhất một sách.');
                            updateTotals();
                        }

                        document.querySelectorAll('#table-sach tbody tr').forEach(row => attachRowEvents(row));
                        document.querySelector('form').addEventListener('submit', updateTotals);
                        document.querySelector('select[name="khuyen_mai_id"]').addEventListener('change', function () {
                            document.querySelectorAll('#table-sach tbody tr').forEach(row => calculateRow(row));
                        });

                    </script>
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

                        input, select {
                            width: 100%;
                            padding: 10px;
                            font-size: 16px;
                            border: 1px solid #ddd;
                            border-radius: 4px;
                        }

                        th, td {
                            vertical-align: middle;
                        }

                        .btn-sm {
                            font-size: 14px;
                            padding: 4px 8px;
                        }
                    </style>
                    @endsection

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

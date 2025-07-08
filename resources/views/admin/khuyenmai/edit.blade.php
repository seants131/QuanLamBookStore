@extends('layouts.admin')

@section('content')
<div id="content-page" class="content-page">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="iq-card">
          <div class="iq-card-header d-flex justify-content-between">
            <h4 class="card-title">Chỉnh sửa khuyến mãi</h4>
          </div>

          @if ($errors->any())
            <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
          @endif

          <form method="POST" action="{{ route('admin.khuyenmai.update', $item->id) }}">
            @csrf @method('PUT')
            <a href="{{ route('admin.khuyenmai.index') }}" class="close-form-button" title="Đóng">&times;</a>

            <div class="form-group">
              <label for="ten">Tên khuyến mãi:</label>
              <input type="text" name="ten" class="form-control" value="{{ old('ten', $item->ten) }}" required>
            </div>

            <div class="form-group">
              <label for="phan_tram_giam">Phần trăm giảm:</label>
              <input type="number" name="phan_tram_giam" class="form-control" value="{{ old('phan_tram_giam', $item->phan_tram_giam) }}" required>
            </div>

            <div class="form-group">
              <label for="ngay_bat_dau">Ngày bắt đầu:</label>
              <input type="date" name="ngay_bat_dau" class="form-control" value="{{ old('ngay_bat_dau', \Carbon\Carbon::parse($item->ngay_bat_dau)->format('Y-m-d')) }}" required>
            </div>

            <div class="form-group">
              <label for="ngay_ket_thuc">Ngày kết thúc:</label>
              <input type="date" name="ngay_ket_thuc" class="form-control" value="{{ old('ngay_ket_thuc', \Carbon\Carbon::parse($item->ngay_ket_thuc)->format('Y-m-d')) }}" required>
            </div>

            <div class="form-group">
              <label for="trang_thai">Trạng thái:</label>
              <select name="trang_thai" class="form-control" required>
                <option value="kich_hoat" {{ old('trang_thai') == 'kich_hoat' ? 'selected' : '' }}>Cho phép tự động theo lịch</option>
                <option value="tat" {{ old('trang_thai') == 'tat' ? 'selected' : '' }}>Tạm dừng thủ công</option>
              </select>
            </div>

            <div class="form-group d-flex justify-content-between">
              <button type="submit" class="btn btn-warning">Cập nhật</button>
              <a href="{{ route('admin.khuyenmai.index') }}" class="btn btn-secondary">← Trở về</a>
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

   .form-group {
      margin-bottom: 15px;
   }

   label {
      font-weight: bold;
      margin-bottom: 5px;
   }

   input, select, textarea {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ddd;
      border-radius: 4px;
      box-sizing: border-box;
   }

   textarea {
      height: 120px;
      resize: vertical;
   }
</style>
@endsection
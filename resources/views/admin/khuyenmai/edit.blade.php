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
              <input type="date" name="ngay_bat_dau" class="form-control" value="{{ old('ngay_bat_dau', $item->ngay_bat_dau) }}" required>
            </div>

            <div class="form-group">
              <label for="ngay_ket_thuc">Ngày kết thúc:</label>
              <input type="date" name="ngay_ket_thuc" class="form-control" value="{{ old('ngay_ket_thuc', $item->ngay_ket_thuc) }}" required>
            </div>

            <div class="form-group">
              <label for="trang_thai">Trạng thái:</label>
              <select name="trang_thai" class="form-control" required>
                <option value="1" {{ old('trang_thai', $item->trang_thai) == '1' ? 'selected' : '' }}>Kích hoạt</option>
                <option value="0" {{ old('trang_thai', $item->trang_thai) == '0' ? 'selected' : '' }}>Tạm dừng</option>
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

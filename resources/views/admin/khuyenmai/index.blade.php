@extends('layouts.admin')

@section('content')
<div id="content-page" class="content-page">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="iq-card">
          <div class="iq-card-header d-flex justify-content-between">
            <h4 class="card-title">Danh sách khuyến mãi</h4>
            <a href="{{ route('admin.khuyenmai.create') }}" class="btn btn-primary">Thêm khuyến mãi</a>
          </div>

          @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          <div class="iq-card-body">
            <form method="GET" action="{{ route('admin.khuyenmai.index') }}" class="form-inline mb-3">
              <input type="text" name="ten" class="form-control mr-2" placeholder="Tên" value="{{ request('ten') }}">
              <select name="trang_thai" class="form-control mr-2">
                  <option value="">-- Trạng thái --</option>
                  <option value="kich_hoat" {{ request('trang_thai') === 'kich_hoat' ? 'selected' : '' }}>Đang kích hoạt</option>
                  <option value="chua_bat_dau" {{ request('trang_thai') === 'chua_bat_dau' ? 'selected' : '' }}>Chưa bắt đầu</option>
                  <option value="het_han" {{ request('trang_thai') === 'het_han' ? 'selected' : '' }}>Hết hạn</option>
                  <option value="tat" {{ request('trang_thai') === 'tat' ? 'selected' : '' }}>Tạm dừng</option>
              </select>
              <button type="submit" class="btn btn-success">Tìm</button>
              <a href="{{ route('admin.khuyenmai.index') }}" class="btn btn-secondary ml-2">Reset</a>
            </form>

            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Tên</th>
                  <th>Giảm (%)</th>
                  <th>Ngày bắt đầu</th>
                  <th>Ngày kết thúc</th>
                  <th>Trạng thái</th>
                  <th>Hành động</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($khuyenmai as $item)
                  <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->ten }}</td>
                    <td>{{ $item->phan_tram_giam }}%</td>
                    <td>{{ \Carbon\Carbon::parse($item->ngay_bat_dau)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->ngay_ket_thuc)->format('d/m/Y') }}</td>
                    <td>
  <span class="badge 
    {{ $item->trang_thai_hien_thi === 'Kích hoạt' ? 'badge-success' : 'badge-secondary' }}">
    {{ $item->trang_thai_hien_thi }}
  </span>
</td>

                    <td>
                      <a href="{{ route('admin.khuyenmai.edit', $item->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                      <form action="{{ route('admin.khuyenmai.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Xóa khuyến mãi này?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Xóa</button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="6">Không có khuyến mãi nào.</td></tr>
                @endforelse
              </tbody>
            </table>

            <div class="d-flex justify-content-center">
              {{ $khuyenmai->links('pagination::bootstrap-4') }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

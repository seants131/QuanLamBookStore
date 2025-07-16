@extends('layouts.admin')

@section('content')
<div id="content-page" class="content-page">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="iq-card">
          <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
              <h4 class="card-title">Danh sách liên hệ</h4>
            </div>

            @if(session('success'))
              <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @elseif(session('error'))
              <div class="alert alert-danger mt-3">{{ session('error') }}</div>
            @endif

            <div class="iq-card-header-toolbar d-flex align-items-center">
              <a href="{{ route('admin.lienhe.create') }}" class="btn btn-primary">Thêm liên hệ</a>
            </div>
          </div>

          <div class="iq-card-body">
            <div class="order-info">
              {{-- FORM TÌM KIẾM --}}
              <div class="w-100 p-3 bg-light rounded mb-3 border">
                <form action="{{ route('admin.lienhe.index') }}" method="GET" class="d-flex flex-wrap">
                  <input type="text" name="ho_ten" class="form-control mb-2 mr-2" style="max-width:200px"
                         placeholder="Họ tên" value="{{ request('ho_ten') }}">
                  <input type="text" name="email" class="form-control mb-2 mr-2" style="max-width:220px"
                         placeholder="Email" value="{{ request('email') }}">
                  <input type="date" name="ngay_tao" class="form-control mb-2 mr-2"
                         value="{{ request('ngay_tao') }}">
                  <button class="btn btn-success mb-2 mr-2">Tìm</button>
                  <a href="{{ route('admin.lienhe.index') }}" class="btn btn-secondary mb-2">Reset</a>
                </form>
              </div>

              @if ($lienhe->isEmpty())
                <p>Không có liên hệ nào.</p>
              @else
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Họ tên</th>
                      <th>Email</th>
                      <th>Nội dung</th>
                      <th>Ngày tạo</th>
                      <th>Trạng Thái</th>
                      <th>Hành động</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($lienhe as $item)
                      <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->ho_ten }}</td>
                        <td>{{ $item->email }}</td>
                        <td style="max-width:220px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                          {{ $item->noi_dung }}
                        </td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td>
                          @if ($item->trang_thai)
                            <span class="badge badge-success">✅ Đã xử lý</span>
                          @else
                            <span class="badge badge-warning">⏳ Chưa xử lý</span>
                          @endif
                        </td>
                        <td>
                          <div class="d-flex" style="gap:6px;">
                            <a href="{{ route('admin.lienhe.edit', $item->id) }}" class="action-btn" data-toggle="tooltip" title="Sửa">
                              <i class="ri-pencil-line"></i>
                            </a>
                            <!-- Nút xóa  -->
                            <form action="{{ route('admin.lienhe.destroy', $item->id) }}"
                                  method="POST" onsubmit="return confirm('Xóa liên hệ này?');">
                              @csrf @method('DELETE')
                              <button class="action-btn" data-toggle="tooltip" title="Xóa">
                                <i class="ri-delete-bin-line"></i>
                              </button>
                            </form>
                             <!-- Nút chuyển trạng thái  -->
                            <form action="{{ route('admin.lienhe.toggle', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="action-btn" data-toggle="tooltip"
                                    title="{{ $item->trang_thai ? 'Đánh dấu đã xử lý' : 'Đánh dấu chưa xử lý' }}">
                              @if ($item->trang_thai)
                                
                                <i class="ri-check-line text-success"></i>  {{-- ❌ trạng thái đã xử lý → muốn đánh dấu lại chưa --}}
                              @else
                                
                                <i class="ri-close-circle-line text-warning"></i> {{-- ✅ trạng thái chưa xử lý → muốn đánh dấu đã xử lý --}}
                              @endif
                            </button>
                          </form>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>

                <div class="d-flex justify-content-center">
                  {{ $lienhe->links('pagination::bootstrap-4') }}
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

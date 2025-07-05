@extends('layouts.admin')

@section('content')
<div id="content-page" class="content-page">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="iq-card">
          <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
              <h4 class="card-title">Danh sách danh mục</h4>
            </div>

            @if(session('success'))
              <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @elseif(session('error'))
              <div class="alert alert-danger mt-3">{{ session('error') }}</div>
            @endif

            <div class="iq-card-header-toolbar d-flex align-items-center">
              <a href="{{ route('admin.danhmuc.create') }}" class="btn btn-primary">Thêm danh mục</a>
            </div>
          </div>

          <div class="iq-card-body">
            <div class="order-info">
              {{-- FORM TÌM KIẾM --}}
              <div class="w-100 p-3 bg-light rounded mb-3 border">
                <form action="{{ route('admin.danhmuc.index') }}" method="GET" class="d-flex flex-wrap">
                  <input type="text" name="ten" class="form-control mb-2 mr-2" style="max-width:250px"
                         placeholder="Tên danh mục" value="{{ request('ten') }}">
                  <button class="btn btn-success mb-2 mr-2">Tìm</button>
                  <a href="{{ route('admin.danhmuc.index') }}" class="btn btn-secondary mb-2">Reset</a>
                </form>
              </div>

              @if ($danhmucs->isEmpty())
                <p>Không có danh mục nào.</p>
              @else
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Tên danh mục</th>
                      <th>Slug</th>
                      <th>Mô tả</th>
                      <th>Ngày tạo</th>
                      <th>Hành động</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($danhmucs as $item)
                      <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->ten }}</td>
                        <td>{{ $item->slug }}</td>
                        <td style="max-width:220px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                          {{ $item->mo_ta }}
                        </td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td>
                          <div class="d-flex" style="gap:6px;">
                            <a href="{{ route('admin.danhmuc.edit', $item->id) }}" class="action-btn" data-toggle="tooltip" title="Sửa">
                              <i class="ri-pencil-line"></i>
                            </a>

                            <form action="{{ route('admin.danhmuc.destroy', $item->id) }}"
                                  method="POST" onsubmit="return confirm('Xóa danh mục này?');">
                              @csrf @method('DELETE')
                              <button class="action-btn" data-toggle="tooltip" title="Xóa">
                                <i class="ri-delete-bin-line"></i>
                              </button>
                            </form>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>

                <div class="d-flex justify-content-center">
                  {{ $danhmucs->links('pagination::bootstrap-4') }}
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

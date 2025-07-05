@extends('layouts.admin')

@section('content')
<div id="content-page" class="content-page">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="iq-card">
          <div class="iq-card-header d-flex justify-content-between">
            <h4 class="card-title">Chỉnh sửa danh mục</h4>
          </div>

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
          @endif

          <form method="POST" action="{{ route('admin.danhmuc.update', $category->id) }}">
            @csrf 
            @method('PUT')

            <a href="{{ route('admin.danhmuc.index') }}" class="close-form-button" title="Đóng">&times;</a>

            <div class="form-group">
              <label for="ten">Tên danh mục:</label>
              <input type="text" name="ten" id="ten"
                     class="form-control" value="{{ old('ten', $category->ten) }}" required>
            </div>

            <div class="form-group">
              <label for="mo_ta">Mô tả:</label>
              <textarea name="mo_ta" id="mo_ta"
                        class="form-control">{{ old('mo_ta', $category->mo_ta) }}</textarea>
            </div>

            <div class="form-group d-flex justify-content-between mt-3">
              <div>
                <button type="submit" class="btn btn-warning">Cập nhật danh mục</button>
              </div>
              <a href="{{ route('admin.danhmuc.index') }}" class="btn btn-secondary">← Trở về</a>
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
        line-height: 1;
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
        text-decoration: none;
    }

    .form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        padding: 10px;
        background-color: #f8f9fa;
    }

    form {
        background-color: #ffffff;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 1250px;
        box-sizing: border-box;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
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

    button {
        background-color: #007bff;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
        font-size: 16px;
    }

    button:hover {
        background-color: #0056b3;
    }

    h1.text-center {
        text-align: center;
        margin-bottom: 20px;
        font-size: 24px;
    }
</style>
@endsection

@extends('admin.layouts.admin')
@section('title','THÊM THƯƠNG HIỆU')
@section('content')
<h2 class="mb-3">THÊM THƯƠNG HIỆU</h2>

<form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Tên thương hiệu</label>
        <input type="text" name="brandname" class="form-control">
    </div>
    <div class="mb-3">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control">
    </div>
    <div class="mb-3">
        <label>Hình ảnh</label>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="mb-3">
        <label>Trạng thái</label>
        <select name="status" class="form-control">
            <option value="1">Hiển thị</option>
            <option value="0">Ẩn</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Lưu</button>
    <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Quay lại</a>
</form>

@endsection
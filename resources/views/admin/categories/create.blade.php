@extends('admin.layouts.admin')
@section('title','Thêm loại sản phẩm')
@section('content')
<h2 class="mb-3">THÊM DANH MỤC</h2>

<form action="{{ route('admin.categories.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Tên danh mục</label>
        <input type="text" name="catename" class="form-control">
    </div>
    <div class="mb-3">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Lưu</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
</form>

@endsection
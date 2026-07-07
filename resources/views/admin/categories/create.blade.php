@extends('admin.layouts.admin')
@section('title','Thêm loại sản phẩm')
@section('content')
<h2 class="mb-3">THÊM DANH MỤC</h2>

<x-admin.alert />

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Tên danh mục</label>
        <input type="text" name="catename" class="form-control"
            value="{{ old('catename') }}">
        @error('catename')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control"
            value="{{ old('slug') }}">
        @error('slug')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label>Thứ tự sắp xếp</label>
        <input type="number" name="sort_order" class="form-control"
            value="{{ old('sort_order', 0) }}">
        @error('sort_order')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label>Mô tả</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        @error('description')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3 img-group">
        <label>Hình ảnh</label>
        <input type="file" name="img" class="form-control img-input" accept="image/*">
        <div class="img-preview mt-2"></div>
        @error('img')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label>Trạng thái</label>
        <select name="status" class="form-control">
            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Hiển thị</option>
            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Ẩn</option>
        </select>
        @error('status')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Lưu</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
</form>

@endsection
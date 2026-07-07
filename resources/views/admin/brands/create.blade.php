@extends('admin.layouts.admin')
@section('title','THÊM THƯƠNG HIỆU')
@section('content')
<h2 class="mb-3">THÊM THƯƠNG HIỆU</h2>

<x-admin.alert />

<form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Tên thương hiệu</label>
        <input type="text" name="brandname" class="form-control" value="{{ old('brandname') }}">
        @error('brandname')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
        @error('slug')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3 img-group">
        <label>Hình ảnh</label>
        <input type="file" name="img" class="form-control img-input">
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
    <div class="mb-3">
        <label>Mô tả</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        @error('description')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Lưu</button>
    <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection
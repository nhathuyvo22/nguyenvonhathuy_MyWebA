@extends('admin.layouts.admin')
@section('title','Sửa loại sản phẩm')
@section('content')
<h2 class="mb-3">SỬA DANH MỤC</h2>

{{-- Hiển thị tất cả lỗi Validation --}}
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form action="{{ route('admin.categories.update', $item->cateid) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Tên danh mục</label>
        <input type="text" name="catename" class="form-control"
            value="{{ old('catename', $item->catename) }}">
        @error('catename')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control"
            value="{{ old('slug', $item->slug) }}">
        @error('slug')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3 img-group">
        <label>Hình ảnh</label>
        <input type="file" name="img" class="form-control img-input" accept="image/*">
        <div class="img-preview mt-2">
            @if($item->image)
            <img src="{{ asset('storage/categories/' . $item->image) }}"
                alt="{{ $item->catename }}"
                width="120" class="img-thumbnail">
            @endif
        </div>
        @error('img')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label>Trạng thái</label>
        <select name="status" class="form-control">
            <option value="1" {{ old('status', $item->status) == 1 ? 'selected' : '' }}>Hiển thị</option>
            <option value="0" {{ old('status', $item->status) == 0 ? 'selected' : '' }}>Ẩn</option>
        </select>
        @error('status')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
</form>

@endsection
@extends('admin.layouts.admin')
@section('title','SỬA THƯƠNG HIỆU')
@section('content')
<h2 class="mb-3">SỬA THƯƠNG HIỆU</h2>

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form action="{{ route('admin.brands.update', $item->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Tên thương hiệu</label>
        <input type="text" name="brandname" class="form-control"
            value="{{ old('brandname', $item->brandname) }}">
    </div>
    <div class="mb-3">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control"
            value="{{ old('slug', $item->slug) }}">
    </div>
    <div class="mb-3 img-group">
        <label>Hình ảnh</label>
        <input type="file" name="img" class="form-control img-input">
        <div class="img-preview mt-2">
            @if($item->image)
            <img src="{{ asset('storage/brands/' . $item->image) }}"
                alt="{{ $item->brandname }}"
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
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@endsection
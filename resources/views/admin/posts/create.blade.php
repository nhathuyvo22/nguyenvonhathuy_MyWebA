@extends('admin.layouts.admin')
@section('title','THÊM BÀI VIẾT')
@section('content')
<h2 class="mb-3">THÊM BÀI VIẾT</h2>

<x-admin.alert />

<form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Tiêu đề</label>
        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        @error('title')<span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="mb-3">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
        @error('slug')<span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="mb-3">
        <label>Nội dung</label>
        <textarea name="content" class="form-control" rows="6">{{ old('content') }}</textarea>
        @error('content')<span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="mb-3 img-group">
        <label>Hình ảnh</label>
        <input type="file" name="image" class="form-control img-input">
        <div class="img-preview mt-2"></div>
    </div>
    <div class="mb-3">
        <label>Người đăng</label>
        <select name="user_id" class="form-control">
            @foreach($users as $user)
            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                {{ $user->fullname }}
            </option>
            @endforeach
        </select>
        @error('user_id')<span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="mb-3">
        <label>Trạng thái</label>
        <select name="status" class="form-control">
            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Hiển thị</option>
            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Ẩn</option>
        </select>
        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <button type="submit" class="btn btn-primary">Lưu</button>
    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection
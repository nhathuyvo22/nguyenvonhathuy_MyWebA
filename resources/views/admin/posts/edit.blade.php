@extends('admin.layouts.admin')
@section('title','SỬA BÀI VIẾT')
@section('content')
<h2 class="mb-3">SỬA BÀI VIẾT</h2>

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Tiêu đề</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}">
        @error('title')<span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="mb-3">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control" value="{{ old('slug', $post->slug) }}">
        @error('slug')<span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="mb-3">
        <label>Nội dung</label>
        <textarea name="content" class="form-control" rows="6">{{ old('content', $post->content) }}</textarea>
        @error('content')<span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="mb-3 img-group">
        <label>Hình ảnh</label>
        <div class="img-preview mt-2">
            @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" width="120" class="img-thumbnail">
            @endif
        </div>
        <input type="file" name="image" class="form-control img-input">
    </div>
    <div class="mb-3">
        <label>Người đăng</label>
        <select name="user_id" class="form-control">
            @foreach($users as $user)
            <option value="{{ $user->id }}" {{ old('user_id', $post->user_id) == $user->id ? 'selected' : '' }}>
                {{ $user->fullname }}
            </option>
            @endforeach
        </select>
        @error('user_id')<span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="mb-3">
        <label>Trạng thái</label>
        <select name="status" class="form-control">
            <option value="1" {{ old('status', $post->status) == 1 ? 'selected' : '' }}>Hiển thị</option>
            <option value="0" {{ old('status', $post->status) == 0 ? 'selected' : '' }}>Ẩn</option>
        </select>
        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection
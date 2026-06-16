@extends('admin.layouts.admin')
@section('title', 'THÊM BÀI VIẾT')
@section('content')
<h2 class="mb-3">THÊM BÀI VIẾT</h2>

<form action="{{ route('admin.post.create') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Tiêu đề</label>
        <input type="text" name="title" class="form-control">
    </div>
    <div class="mb-3">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control">
    </div>
    <div class="mb-3">
        <label>Nội dung</label>
        <textarea name="content" class="form-control" rows="5"></textarea>
    </div>
    <div class="mb-3">
        <label>Hình ảnh</label>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="mb-3">
        <label>Tác giả</label>
        <select name="user_id" class="form-control">
            @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->fullname }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Trạng thái</label>
        <select name="status" class="form-control">
            <option value="1">Hiển thị</option>
            <option value="0">Ẩn</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Lưu</button>
    <a href="{{ route('admin.post.index') }}" class="btn btn-secondary">Quay lại</a>
</form>

@endsection
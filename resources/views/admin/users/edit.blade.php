@extends('admin.layouts.admin')
@section('title', 'Sửa người dùng')
@section('content')
<h2 class="mb-3">SỬA NGƯỜI DÙNG</h2>

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form action="{{ route('admin.users.update', $item->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Họ tên</label>
        <input type="text" name="fullname" class="form-control"
            value="{{ old('fullname', $item->fullname) }}">
    </div>
    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control"
            value="{{ old('username', $item->username) }}">
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control"
            value="{{ old('email', $item->email) }}">
    </div>
    <div class="mb-3">
        <label>Trạng thái</label>
        <select name="status" class="form-control">
            <option value="1" {{ old('status', $item->status) == 1 ? 'selected' : '' }}>Hoạt động</option>
            <option value="0" {{ old('status', $item->status) == 0 ? 'selected' : '' }}>Khóa</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection
@extends('admin.layouts.admin')
@section('title', 'Thêm người dùng')
@section('content')
<h2 class="mb-3">THÊM NGƯỜI DÙNG</h2>

<x-admin.alert />

<form action="{{ route('admin.users.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Họ tên</label>
        <input type="text" name="fullname" class="form-control" value="{{ old('fullname') }}">
    </div>
    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="{{ old('username') }}">
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
    </div>
    <div class="mb-3">
        <label>Mật khẩu</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="mb-3">
        <label>Trạng thái</label>
        <select name="status" class="form-control">
            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Hoạt động</option>
            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Khóa</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Lưu</button>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection
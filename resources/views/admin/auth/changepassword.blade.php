@extends('admin.layouts.admin')
@section('title', 'Đổi mật khẩu')
@section('content')
<div class="border rounded bg-white p-4 shadow-sm" style="max-width: 500px;">
    <h3 class="mb-4">Đổi mật khẩu</h3>

    <x-admin.alert />

    <div class="mb-3">
        <strong>Người dùng:</strong> {{ Auth::user()->fullname }}
    </div>

    <form action="{{ route('admin.changepass.post') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Mật khẩu cũ</label>
            <input type="password" name="old_password" class="form-control">
            @error('old_password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Mật khẩu mới</label>
            <input type="password" name="new_password" class="form-control">
            @error('new_password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Xác nhận mật khẩu mới</label>
            <input type="password" name="new_password_confirmation" class="form-control">
            @error('new_password_confirmation')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
    </form>
</div>
@endsection
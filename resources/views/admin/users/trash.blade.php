@extends('admin.layouts.admin')
@section('title','Thùng rác - Người dùng')
@section('content')
<h2 class="mb-3">DANH SÁCH NGƯỜI DÙNG - ĐANG CHỜ XÓA</h2>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif
<div class="d-flex gap-2 mb-3">
    <a href="{{ route('admin.users.index') }}" class="btn btn-primary">
        Quay lại danh sách
    </a>

    <form action="{{ route('admin.users.restoreAll') }}" method="POST" class="d-inline">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-success"
            onclick="return confirm('Khôi phục tất cả bản ghi trong Thùng rác?')">
            Khôi phục tất cả
        </button>
    </form>

    <form action="{{ route('admin.users.forceDeleteAll') }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger"
            onclick="return confirm('Xóa vĩnh viễn TẤT CẢ? Không thể hoàn tác!')">
            Xóa vĩnh viễn tất cả
        </button>
    </form>
</div>
<table class="table table-bordered table-hover table-striped">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Họ tên</th>
            <th>Username</th>
            <th>Email</th>
            <th>Trạng thái</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @forelse($list as $item)
        <tr>
            <td>{{ $list->firstItem() + $loop->index }}</td>
            <td>{{ $item->fullname }}</td>
            <td>{{ $item->username }}</td>
            <td>{{ $item->email }}</td>
            <td>
                @if($item->status == 1)
                <span class="badge bg-success">Hoạt động</span>
                @else
                <span class="badge bg-danger">Khóa</span>
                @endif
            </td>
            <td class="d-flex gap-1">
                <form action="{{ route('admin.users.restore', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success btn-sm">Khôi phục</button>
                </form>
                <form action="{{ route('admin.users.forceDelete', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Xóa vĩnh viễn? Hành động này không thể hoàn tác!')">Xóa</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Thùng rác trống</td>
        </tr>
        @endforelse
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $list->links() }}
</div>
@endsection
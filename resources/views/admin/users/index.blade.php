@extends('admin.layouts.admin')
@section('title', 'Người Dùng')
@section('content')
<h2 class="mb-3">DANH SÁCH NGƯỜI DÙNG</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('admin.users.create') }}" class="btn btn-success mb-3">+ Thêm mới</a>

<table class="table table-bordered table-hover table-striped">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Họ tên</th>
            <th>Username</th>
            <th>Email</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
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
                <a href="{{ route('admin.users.edit', $item->id) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil-square"></i>
                </a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Không có dữ liệu</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $list->links() }}
</div>
@endsection
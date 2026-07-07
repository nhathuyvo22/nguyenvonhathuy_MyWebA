@extends('admin.layouts.admin')
@section('title', 'Bài viết')
@section('content')
<h2 class="mb-3">DANH SÁCH BÀI VIẾT</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('admin.posts.create') }}" class="btn btn-success mb-3">
    + Thêm mới
</a>

<table class="table table-bordered table-hover table-striped">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Ảnh</th>
            <th>Tiêu đề</th>
            <th>Tác giả</th>
            <th>Trạng thái</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @forelse($list as $item)
        <tr>
            <td>{{ $list->firstItem() + $loop->index }}</td>
            <td>
                @if($item->image)
                <img src="{{ asset('storage/posts/' . $item->image) }}" width="50" class="img-thumbnail">
                @else
                <img src="{{ asset('images/default.png') }}" width="50">
                @endif
            </td>
            <td>{{ $item->title }}</td>
            <td>{{ $item->user?->fullname }}</td>
            <td>
                @if($item->status == 1)
                <span class="badge bg-success">Hiển thị</span>
                @else
                <span class="badge bg-danger">Ẩn</span>
                @endif
            </td>
            <td class="d-flex gap-1">
                <a href="{{ route('admin.posts.edit', $item->id) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil-square"></i>
                </a>
                <form action="{{ route('admin.posts.destroy', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Bạn có chắc muốn xóa?')">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
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
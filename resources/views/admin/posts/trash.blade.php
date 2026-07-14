@extends('admin.layouts.admin')
@section('title','Thùng rác - Bài viết')
@section('content')
<h2 class="mb-3">DANH SÁCH BÀI VIẾT - ĐANG CHỜ XÓA</h2>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif
<div class="d-flex gap-2 mb-3">
    <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">
        Quay lại danh sách
    </a>

    <form action="{{ route('admin.posts.restoreAll') }}" method="POST" class="d-inline">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-success"
            onclick="return confirm('Khôi phục tất cả bản ghi trong Thùng rác?')">
            Khôi phục tất cả
        </button>
    </form>

    <form action="{{ route('admin.posts.forceDeleteAll') }}" method="POST" class="d-inline">
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
                <form action="{{ route('admin.posts.restore', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success btn-sm">Khôi phục</button>
                </form>
                <form action="{{ route('admin.posts.forceDelete', $item->id) }}" method="POST" class="d-inline">
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
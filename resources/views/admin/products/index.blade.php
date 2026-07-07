@extends('admin.layouts.admin')
@section('title', 'Sản phẩm')
@section('content')
<h2 class="mb-3">DANH SÁCH SẢN PHẨM</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('admin.products.create') }}" class="btn btn-success mb-3">+ Thêm mới</a>

<table class="table table-bordered table-hover table-striped">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Loại</th>
            <th>Thương hiệu</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @forelse($list as $item)
        <tr>
            <td>{{ $list->firstItem() + $loop->index }}</td>
            <td>
                @if($item->image)
                <img src="{{ asset('storage/products/' . $item->image) }}" width="50" class="img-thumbnail">
                @else
                <img src="{{ asset('images/default.png') }}" width="50">
                @endif
            </td>
            <td>{{ $item->productname }}</td>
            <td>{{ number_format($item->price) }} đ</td>
            <td>{{ $item->category?->catename }}</td>
            <td>{{ $item->brand?->brandname }}</td>
            <td>
                @if($item->status == 1)
                <span class="badge bg-success">Hiển thị</span>
                @else
                <span class="badge bg-danger">Ẩn</span>
                @endif
            </td>
            <td class="d-flex gap-1">
                <a href="{{ route('admin.products.edit', $item->id) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil-square"></i>
                </a>
                <form action="{{ route('admin.products.destroy', $item->id) }}" method="POST" class="d-inline">
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
            <td colspan="8" class="text-center">Không có dữ liệu</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $list->links() }}
</div>
@endsection
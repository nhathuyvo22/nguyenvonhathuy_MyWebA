@extends('admin.layouts.admin')
@section('title','Thương hiệu')
@section('content')
<h2 class="mb-3">DANH SÁCH THƯƠNG HIỆU</h2>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<a href="{{ route('admin.brands.create') }}" class="btn btn-success mb-3">
    + Thêm mới
</a>
<table class="table table-bordered table-hover table-striped">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Ảnh</th>
            <th>Tên thương hiệu</th>
            <th>Slug</th>
            <th>Trạng thái</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach($list as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>
                @if($item->image)
                <img src="{{ asset('storage/brands/'. $item->image) }}" width="80" class="img-thumbnail">
                @else
                <img src="{{ asset('images/default.png') }}" width="80" class="img-thumbnail">
                @endif
            </td>
            <td>{{ $item->brandname }}</td>
            <td>{{ $item->slug }}</td>
            <td>
                @if($item->status == 1)
                <span class="badge bg-success">Hiển thị</span>
                @else
                <span class="badge bg-danger">Ẩn</span>
                @endif
            </td>
            <td class="d-flex gap-1">
                <a href="{{ route('admin.brands.edit', $item->id) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil-square"></i>
                </a>
                <form action="{{ route('admin.brands.destroy', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Bạn có chắc muốn xóa?')">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $list->links() }}
</div>
@endsection
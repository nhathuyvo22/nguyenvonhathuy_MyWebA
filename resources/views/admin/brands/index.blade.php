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
        </tr>
    </thead>
    <tbody>
        @foreach($list as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>
                @if($item->image)
                <img src="{{ asset('images/' . $item->image) }}" width="50">
                @else
                <img src="{{ asset('images/default.png') }}" width="50">
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
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $list->links() }}
</div>
@endsection
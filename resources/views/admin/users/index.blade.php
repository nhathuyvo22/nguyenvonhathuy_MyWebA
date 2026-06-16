@extends('admin.layouts.admin')
@section('title', 'Người Dùng')
@section('content')
<h2 class="mb-3">DANH SÁCH NGƯỜI DÙNG</h2>

<table class="table table-bordered table-hover table-striped">
    <thead class="table-dark">
        <tr>
            <th>STT</th>
            <th>Họ tên</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($list as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->fullname }}</td>
            <td>{{ $item->email }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
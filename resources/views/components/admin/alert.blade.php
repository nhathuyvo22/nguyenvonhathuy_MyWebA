{{-- Hiển thị tất cả lỗi Validation --}}
@if ($errors->any())
<div class="alert alert-danger auto-dismiss-alert" role="alert">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- Hiển thị lỗi từ session flash --}}
@if (session('error'))
<div class="alert alert-danger auto-dismiss-alert" role="alert">
    {{ session('error') }}
</div>
@endif

{{-- Hiển thị thông báo thành công --}}
@if (session('success'))
<div class="alert alert-success auto-dismiss-alert" role="alert">
    {{ session('success') }}
</div>
@endif
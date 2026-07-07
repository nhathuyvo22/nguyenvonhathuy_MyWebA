@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')
<style>
    .dashboard-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.12) !important;
    }
</style>

<div class="container-fluid p-0">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm text-white" style="background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <h3 class="mb-2">Chào mừng trở lại, Admin!</h3>
                            <p class="mb-0 opacity-75">Hãy theo dõi và cập nhật nội dung cửa hàng một cách nhanh chóng và hiệu quả.</p>
                        </div>
                        <div class="fs-1">
                            <i class="bi bi-speedometer2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        @foreach($stats as $stat)
        <div class="col-12 col-sm-6 col-xl-2-4">
            <a href="{{ $stat['route'] }}" class="text-decoration-none text-dark">
                <div class="card border-0 shadow-sm h-100 dashboard-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1">{{ $stat['label'] }}</p>
                                <h3 class="mb-0">{{ $stat['count'] }}</h3>
                            </div>
                            <div class="p-3 rounded-circle bg-{{ $stat['color'] }} bg-opacity-10 text-{{ $stat['color'] }}">
                                <i class="bi {{ $stat['icon'] }} fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-lightning-charge text-warning"></i>
                        Hành động nhanh
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-primary w-100 py-3">
                                <i class="bi bi-plus-circle"></i> Thêm danh mục
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('admin.products.create') }}" class="btn btn-outline-success w-100 py-3">
                                <i class="bi bi-plus-circle"></i> Thêm sản phẩm
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('admin.posts.create') }}" class="btn btn-outline-info w-100 py-3">
                                <i class="bi bi-plus-circle"></i> Viết bài mới
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('admin.users.create') }}" class="btn btn-outline-danger w-100 py-3">
                                <i class="bi bi-plus-circle"></i> Thêm người dùng
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-info-circle text-primary"></i>
                        Thông tin hệ thống
                    </h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0">Quản lý danh mục sản phẩm một cách rõ ràng.</li>
                        <li class="list-group-item px-0">Theo dõi thương hiệu và sản phẩm đang hiển thị.</li>
                        <li class="list-group-item px-0">Đăng bài viết mới để tăng trải nghiệm khách hàng.</li>
                        <li class="list-group-item px-0">Kiểm soát người dùng và quyền truy cập.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
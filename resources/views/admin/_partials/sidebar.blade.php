<style>
    .admin-sidebar .collapse:not(.show) {
        display: none;
    }

    .admin-sidebar .collapsing {
        height: 0;
        overflow: hidden;
        transition: height 0.35s ease;
    }
</style>

<div class="admin-sidebar bg-dark text-white p-3 vh-100">
    <h4 class="mb-4">
        <i class="bi bi-speedometer2"></i>
        Admin
    </h4>

    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-house-door"></i>
                Dashboard
            </a>
        </li>

        <li class="nav-item has-submenu">
            <a class="nav-link text-white d-flex justify-content-between align-items-center"
                href="#categoryMenu"
                data-bs-toggle="collapse"
                role="button"
                aria-expanded="false"
                aria-controls="categoryMenu">
                <span><i class="bi bi-tags"></i> Quản lý danh mục</span>
                <i class="bi bi-chevron-down"></i>
            </a>
            <div class="collapse" id="categoryMenu">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.categories.index') }}">
                            Danh sách danh mục
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.categories.create') }}">
                            Thêm danh mục
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item has-submenu">
            <a class="nav-link text-white d-flex justify-content-between align-items-center"
                href="#brandMenu"
                data-bs-toggle="collapse"
                role="button"
                aria-expanded="false"
                aria-controls="brandMenu">
                <span><i class="bi bi-award"></i> Quản lý thương hiệu</span>
                <i class="bi bi-chevron-down"></i>
            </a>
            <div class="collapse" id="brandMenu">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.brands.index') }}">
                            Danh sách thương hiệu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.brands.create') }}">
                            Thêm thương hiệu
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item has-submenu">
            <a class="nav-link text-white d-flex justify-content-between align-items-center"
                href="#productMenu"
                data-bs-toggle="collapse"
                role="button"
                aria-expanded="false"
                aria-controls="productMenu">
                <span><i class="bi bi-box-seam"></i> Quản lý sản phẩm</span>
                <i class="bi bi-chevron-down"></i>
            </a>
            <div class="collapse" id="productMenu">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.products.index') }}">
                            Danh sách sản phẩm
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.products.create') }}">
                            Thêm sản phẩm
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item has-submenu">
            <a class="nav-link text-white d-flex justify-content-between align-items-center"
                href="#postMenu"
                data-bs-toggle="collapse"
                role="button"
                aria-expanded="false"
                aria-controls="postMenu">
                <span><i class="bi bi-file-earmark-text"></i> Quản lý bài viết</span>
                <i class="bi bi-chevron-down"></i>
            </a>
            <div class="collapse" id="postMenu">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.posts.index') }}">
                            Danh sách bài viết
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.posts.create') }}">
                            Thêm bài viết
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item has-submenu">
            <a class="nav-link text-white d-flex justify-content-between align-items-center"
                href="#userMenu"
                data-bs-toggle="collapse"
                role="button"
                aria-expanded="false"
                aria-controls="userMenu">
                <span><i class="bi bi-people"></i> Quản lý người dùng</span>
                <i class="bi bi-chevron-down"></i>
            </a>
            <div class="collapse" id="userMenu">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.users.index') }}">
                            Danh sách người dùng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.users.create') }}">
                            Thêm người dùng
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.admin-sidebar .has-submenu').forEach(function(item) {
            const toggle = item.querySelector('[data-bs-toggle="collapse"]');
            const collapse = item.querySelector('.collapse');

            if (!toggle || !collapse) {
                return;
            }

            const bsCollapse = bootstrap.Collapse.getOrCreateInstance(collapse, {
                toggle: false
            });

            item.addEventListener('mouseenter', function() {
                bsCollapse.show();
            });

            item.addEventListener('mouseleave', function() {
                bsCollapse.hide();
            });
        });
    });
</script>
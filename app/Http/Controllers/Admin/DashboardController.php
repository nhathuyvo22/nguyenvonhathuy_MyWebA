<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            [
                'label' => 'Danh mục',
                'count' => Category::count(),
                'icon' => 'bi-tags',
                'route' => route('admin.categories.index'),
                'color' => 'primary',
            ],
            [
                'label' => 'Thương hiệu',
                'count' => Brands::count(),
                'icon' => 'bi-award',
                'route' => route('admin.brands.index'),
                'color' => 'success',
            ],
            [
                'label' => 'Sản phẩm',
                'count' => Product::count(),
                'icon' => 'bi-box-seam',
                'route' => route('admin.products.index'),
                'color' => 'warning',
            ],
            [
                'label' => 'Bài viết',
                'count' => Post::count(),
                'icon' => 'bi-file-earmark-text',
                'route' => route('admin.posts.index'),
                'color' => 'info',
            ],
            [
                'label' => 'Người dùng',
                'count' => User::count(),
                'icon' => 'bi-people',
                'route' => route('admin.users.index'),
                'color' => 'danger',
            ],
        ];

        return view('admin.dashboard', compact('stats'));
    }
}

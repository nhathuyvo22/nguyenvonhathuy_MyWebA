<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {

    // Authentication (không cần đăng nhập)
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');
    Route::get('/forgotpass', [AuthController::class, 'forgotPassword'])->name('forgotpass');
    Route::post('/forgotpass', [AuthController::class, 'postForgotPassword'])->name('forgotpass.post');

    // Các route yêu cầu đăng nhập
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/change-password', [AuthController::class, 'changePassword'])
            ->name('changepass');
        Route::post('/change-password', [AuthController::class, 'postChangePassword'])
            ->name('changepass.post');

        // User role=2 chỉ được xem danh sách sản phẩm
        Route::resource('products', ProductController::class)
            ->only(['index'])
            ->middleware('roles:1,2');

        // CRUD - chỉ Admin (role=1) được truy cập
        Route::middleware('roles:1')->group(function () {

            // ===== CATEGORY =====
            Route::get('trash/categories', [CategoryController::class, 'trash'])
                ->name('categories.trash');
            Route::patch('categories/restore-all', [CategoryController::class, 'restoreAll'])
                ->name('categories.restoreAll');
            Route::delete('categories/force-delete-all', [CategoryController::class, 'forceDeleteAll'])
                ->name('categories.forceDeleteAll');
            Route::patch('categories/{id}/restore', [CategoryController::class, 'restore'])
                ->name('categories.restore');
            Route::delete('categories/{id}/forcedelete', [CategoryController::class, 'forceDelete'])
                ->name('categories.forceDelete');
            Route::resource('categories', CategoryController::class);

            // ===== BRAND =====
            Route::get('trash/brands', [BrandController::class, 'trash'])
                ->name('brands.trash');
            Route::patch('brands/restore-all', [BrandController::class, 'restoreAll'])
                ->name('brands.restoreAll');
            Route::delete('brands/force-delete-all', [BrandController::class, 'forceDeleteAll'])
                ->name('brands.forceDeleteAll');
            Route::patch('brands/{id}/restore', [BrandController::class, 'restore'])
                ->name('brands.restore');
            Route::delete('brands/{id}/forcedelete', [BrandController::class, 'forceDelete'])
                ->name('brands.forceDelete');
            Route::resource('brands', BrandController::class);

            // ===== USER =====
            Route::get('trash/users', [UserController::class, 'trash'])
                ->name('users.trash');
            Route::patch('users/restore-all', [UserController::class, 'restoreAll'])
                ->name('users.restoreAll');
            Route::delete('users/force-delete-all', [UserController::class, 'forceDeleteAll'])
                ->name('users.forceDeleteAll');
            Route::patch('users/{id}/restore', [UserController::class, 'restore'])
                ->name('users.restore');
            Route::delete('users/{id}/forcedelete', [UserController::class, 'forceDelete'])
                ->name('users.forceDelete');
            Route::resource('users', UserController::class);

            // ===== POST =====
            Route::get('trash/posts', [PostController::class, 'trash'])
                ->name('posts.trash');
            Route::patch('posts/restore-all', [PostController::class, 'restoreAll'])
                ->name('posts.restoreAll');
            Route::delete('posts/force-delete-all', [PostController::class, 'forceDeleteAll'])
                ->name('posts.forceDeleteAll');
            Route::patch('posts/{id}/restore', [PostController::class, 'restore'])
                ->name('posts.restore');
            Route::delete('posts/{id}/forcedelete', [PostController::class, 'forceDelete'])
                ->name('posts.forceDelete');
            Route::resource('posts', PostController::class);

            // ===== PRODUCT =====
            Route::get('trash/products', [ProductController::class, 'trash'])
                ->name('products.trash');
            Route::patch('products/restore-all', [ProductController::class, 'restoreAll'])
                ->name('products.restoreAll');
            Route::delete('products/force-delete-all', [ProductController::class, 'forceDeleteAll'])
                ->name('products.forceDeleteAll');
            Route::patch('products/{id}/restore', [ProductController::class, 'restore'])
                ->name('products.restore');
            Route::delete('products/{id}/forcedelete', [ProductController::class, 'forceDelete'])
                ->name('products.forceDelete');
            Route::resource('products', ProductController::class)->except(['index']);

            Route::delete('products/images/{id}', [ProductController::class, 'destroyImage'])
                ->name('products.images.destroy');
        });
    });
});

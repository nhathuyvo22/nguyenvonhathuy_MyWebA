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

        // CRUD
        Route::resource('categories', CategoryController::class);
        Route::resource('brands', BrandController::class);
        Route::resource('users', UserController::class);
        Route::resource('posts', PostController::class);

        // Products + xóa ảnh phụ
        Route::delete('products/images/{id}', [ProductController::class, 'destroyImage'])
            ->name('products.images.destroy');
        Route::resource('products', ProductController::class);
    });
});

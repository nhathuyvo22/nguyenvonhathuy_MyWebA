<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\BrandController;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DemoController;

Route::get('/demo1', [DemoController::class, 'index']);
Route::get('/demo2', [DemoController::class, 'index2']);
Route::get('/demo3', [DemoController::class, 'index3']);
Route::get('/demo4/{id}', [DemoController::class, 'index4']);
Route::get('/demo5/{id?}', [DemoController::class, 'index5']);
Route::get('/demo6/{param1}/{param2}', [DemoController::class, 'index6']);
// Category
Route::get('admin/category', [CategoryController::class, 'index']);
Route::get('admin/category/create', [CategoryController::class, 'create']);
Route::post('admin/category', [CategoryController::class, 'store']);
Route::get('admin/category/{id}', [CategoryController::class, 'show']);
Route::get('admin/category/{id}/edit', [CategoryController::class, 'edit']);
Route::put('admin/category/{id}', [CategoryController::class, 'update']);
Route::delete('admin/category/{id}', [CategoryController::class, 'destroy']);

// Product
Route::get('admin/product', [ProductController::class, 'index']);
Route::get('admin/product/create', [ProductController::class, 'create']);
Route::post('admin/product', [ProductController::class, 'store']);
Route::get('admin/product/{id}', [ProductController::class, 'show']);
Route::get('admin/product/{id}/edit', [ProductController::class, 'edit']);
Route::put('admin/product/{id}', [ProductController::class, 'update']);
Route::delete('admin/product/{id}', [ProductController::class, 'destroy']);

// Brand
Route::get('admin/brand', [BrandController::class, 'index']);
Route::get('admin/brand/create', [BrandController::class, 'create']);
Route::post('admin/brand', [BrandController::class, 'store']);
Route::get('admin/brand/{id}', [BrandController::class, 'show']);
Route::get('admin/brand/{id}/edit', [BrandController::class, 'edit']);
Route::put('admin/brand/{id}', [BrandController::class, 'update']);
Route::delete('admin/brand/{id}', [BrandController::class, 'destroy']);

// User
Route::get('admin/user', [UserController::class, 'index']);
Route::get('admin/user/create', [UserController::class, 'create']);
Route::post('admin/user', [UserController::class, 'store']);
Route::get('admin/user/{id}', [UserController::class, 'show']);
Route::get('admin/user/{id}/edit', [UserController::class, 'edit']);
Route::put('admin/user/{id}', [UserController::class, 'update']);
Route::delete('admin/user/{id}', [UserController::class, 'destroy']);

// Post
Route::get('admin/post', [PostController::class, 'index']);
Route::get('admin/post/create', [PostController::class, 'create']);
Route::post('admin/post', [PostController::class, 'store']);
Route::get('admin/post/{id}', [PostController::class, 'show']);
Route::get('admin/post/{id}/edit', [PostController::class, 'edit']);
Route::put('admin/post/{id}', [PostController::class, 'update']);
Route::delete('admin/post/{id}', [PostController::class, 'destroy']);

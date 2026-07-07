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
    Route::get('admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('admin/category/create', [CategoryController::class, 'create']);
    Route::post('admin/category', [CategoryController::class, 'store']);
    Route::get('admin/category/{id}', [CategoryController::class, 'show']);
    Route::get('admin/category/{id}/edit', [CategoryController::class, 'edit']);
    Route::put('admin/category/{id}', [CategoryController::class, 'update']);
    Route::delete('admin/category/{id}', [CategoryController::class, 'destroy']);

    // Product
    Route::get('admin/products', [ProductController::class, 'index']);
    Route::get('admin/products/create', [ProductController::class, 'create']);
    Route::post('admin/products', [ProductController::class, 'store']);
    Route::get('admin/products/{id}', [ProductController::class, 'show']);
    Route::get('admin/products/{id}/edit', [ProductController::class, 'edit']);
    Route::put('admin/products/{id}', [ProductController::class, 'update']);
    Route::delete('admin/products/{id}', [ProductController::class, 'destroy']);

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

    //Admin Dashboard
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('home');

        Route::resource('categories', CategoryController::class);
        Route::resource('brands', BrandController::class);
        Route::resource('users', UserController::class);
        Route::resource('posts', PostController::class);
        Route::resource('products', ProductController::class);
        Route::delete('products/images/{id}', [ProductController::class, 'destroyImage'])
            ->name('products.images.destroy');
    });

    Route::get('/test1', [ProductController::class, 'test1']);
    Route::get('/test2', [ProductController::class, 'test2']);

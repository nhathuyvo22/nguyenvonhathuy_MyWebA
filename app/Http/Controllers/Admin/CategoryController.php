<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $list = DB::table('categories')
            ->select('cateid', 'catename', 'slug', 'status', 'image')
            ->where('status', 1)
            ->orderBy('catename')
            ->paginate();

        return view('admin.categories.index', compact('list'));
    }


    public function create()
    {
        return view('admin.categories.create');
    }


    public function store(Request $request)
    {
        Category::create([
            'catename' => $request->catename,
            'slug' => $request->slug,
            'status' => $request->status
        ]);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "Chi tiết danh mục có id = $id";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return "Form sửa danh mục có id = $id";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return "Xử lý cập nhật danh mục có id = $id";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return "Xử lý xóa danh mục có id = $id";
    }
}

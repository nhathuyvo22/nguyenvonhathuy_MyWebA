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
        $list = Category::select('cateid', 'catename', 'slug', 'status', 'image')
            ->orderBy('catename')
            ->paginate(10);

        return view('admin.categories.index', compact('list'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        try {
            Category::create([
                'catename' => $request->catename,
                'slug'     => $request->slug,
                'status'   => $request->status
            ]);

            return redirect()->route('admin.categories.index')
                ->with('success', 'Thêm danh mục thành công');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        $item = Category::where('cateid', $id)->first();
        return view('admin.categories.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        try {
            $category = Category::where('cateid', $id)->first();
            $category->update([
                'catename' => $request->catename,
                'slug'     => $request->slug,
                'status'   => $request->status
            ]);

            return redirect()->route('admin.categories.index')
                ->with('success', 'Cập nhật danh mục thành công');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        DB::table('categories')->where('cateid', $id)->delete();
        return redirect()->route('admin.categories.index')
            ->with('success', 'Xóa danh mục thành công');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brands;

class BrandController extends Controller
{
    public function index($limit = 10)
    {
        $list = Brands::select('id', 'brandname', 'slug', 'image', 'status')
            ->orderBy('brandname')
            ->paginate($limit);

        return view('admin.brands.index', compact('list'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        try {
            Brands::create([
                'brandname' => $request->brandname,
                'slug'      => $request->slug,
                'status'    => $request->status
            ]);

            return redirect()->route('admin.brands.index')
                ->with('success', 'Thêm thương hiệu thành công');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        $item = Brands::find($id);
        return view('admin.brands.edit', compact('item'));
    }

    public function update(Request $request, string $id)
    {
        try {
            $brand = Brands::find($id);
            $brand->update([
                'brandname' => $request->brandname,
                'slug'      => $request->slug,
                'status'    => $request->status
            ]);

            return redirect()->route('admin.brands.index')
                ->with('success', 'Cập nhật thương hiệu thành công');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        Brands::find($id)->delete();
        return redirect()->route('admin.brands.index')
            ->with('success', 'Xóa thương hiệu thành công');
    }
}

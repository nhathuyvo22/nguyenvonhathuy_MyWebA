<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brands;
use App\Http\Requests\Admin\BrandRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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





    public function store(BrandRequest $request)
    {
        try {

            $fileName = null;
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $fileName = Str::slug($request->brandname)
                    . '-' . time()
                    . '.' . $file->extension();

                $file->storeAs('brands', $fileName, 'public');
            }

            Brands::create([
                'brandname'   => $request->brandname,
                'slug'        => $request->slug,
                'status'      => $request->status,
                'description' => $request->description,
                'image'       => $fileName,
            ]);

            return redirect()
                ->route('admin.brands.index')
                ->with('success', 'Thêm thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Thêm thất bại.');
        }
    }

    public function edit(string $id)
    {
        $item = Brands::find($id);
        return view('admin.brands.edit', compact('item'));
    }


    public function update(BrandRequest $request, string $id)
    {
        try {
            $brand = Brands::findOrFail($id);

            // Giữ ảnh cũ
            $fileName = $brand->image;

            // Nếu có chọn ảnh mới
            if ($request->hasFile('img')) {
                // Xóa ảnh cũ (nếu có)
                if ($fileName) {
                    Storage::disk('public')->delete('brands/' . $brand->image);
                }
                // Upload ảnh mới
                $file = $request->file('img');
                $fileName = Str::slug($request->brandname)
                    . '-' . time()
                    . '.' . $file->extension();
                $file->storeAs('brands', $fileName, 'public');
            }

            $brand->update([
                'brandname'   => $request->brandname,
                'slug'        => $request->slug,
                'status'      => $request->status,
                'description' => $request->description,
                'image'       => $fileName,
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

    // Hiển thị danh sách đã xóa mềm (Thùng rác)
    public function trash()
    {
        $list = Brands::onlyTrashed()
            ->select('id', 'brandname', 'slug', 'image', 'status')
            ->orderBy('brandname')
            ->paginate(10);

        return view('admin.brands.trash', compact('list'));
    }

    // Khôi phục dữ liệu đã xóa
    public function restore($id)
    {
        try {
            Brands::onlyTrashed()->findOrFail($id)->restore();

            return redirect()
                ->route('admin.brands.trash')
                ->with('success', 'Khôi phục thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Khôi phục thất bại.');
        }
    }

    // Xóa vĩnh viễn
    public function forceDelete($id)
    {
        try {
            Brands::onlyTrashed()->findOrFail($id)->forceDelete();

            return redirect()
                ->route('admin.brands.trash')
                ->with('success', 'Xóa vĩnh viễn thành công.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Xóa thất bại.');
        }
    }
}

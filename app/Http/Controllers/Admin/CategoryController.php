<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Http\Requests\Admin\CategoryRequest;


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



    public function store(CategoryRequest $request)
    {
        try {
            // Upload ảnh (nếu có)
            $fileName = null;
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $fileName = Str::slug($request->catename)
                    . '-' . time()
                    . '.' . $file->extension();
                $file->storeAs('categories', $fileName, 'public');
            }

            Category::create([
                'catename'    => $request->catename,
                'slug'        => $request->slug,
                'status'      => $request->status,
                'description' => $request->description,
                'sort_order'  => $request->sort_order ?? 0,
                'image'       => $fileName,
            ]);

            return redirect()
                ->route('admin.categories.index')
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
        $item = Category::where('cateid', $id)->first();
        return view('admin.categories.edit', compact('item'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $request->validate(
            [
                'catename' => 'required|min:3|max:100|unique:categories,catename,' . $id . ',cateid',
                'slug'     => [
                    'required',
                    'min:5',
                    'max:150',
                    'unique:categories,slug,' . $id . ',cateid',
                    'regex:/^[a-z0-9-]+$/'
                ],
                'status' => 'required|in:0,1',
                'img'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
            ],
            [
                'required'   => ':attribute không được để trống.',
                'min'        => ':attribute phải từ :min ký tự trở lên.',
                'max'        => ':attribute không vượt quá :max ký tự.',
                'unique'     => ':attribute đã tồn tại.',
                'slug.regex' => ':attribute chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
                'status.in'  => ':attribute không hợp lệ.',
                'img.image'  => 'Tệp tải lên phải là hình ảnh.',
                'img.mimes'  => 'Chỉ chấp nhận ảnh jpg, jpeg, png, webp.',
                'img.max'    => 'Kích thước ảnh tối đa là 2MB.'
            ],
            [
                'catename' => 'Tên loại',
                'slug'     => 'Đường dẫn (Slug)',
                'status'   => 'Trạng thái',
                'img'      => 'Hình ảnh'
            ]
        );

        try {
            $category = Category::where('cateid', $id)->first();
            $imageName = $category->image;

            if ($request->hasFile('img')) {
                if ($imageName) {
                    Storage::disk('public')->delete('categories/' . $imageName);
                }

                $file = $request->file('img');
                $imageName = Str::slug($request->catename) . '-' . time() . '.' . $file->extension();
                $file->storeAs('categories', $imageName, 'public');
            }

            $category->update([
                'catename' => $request->catename,
                'slug'     => $request->slug,
                'status'   => $request->status,
                'image'    => $imageName
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

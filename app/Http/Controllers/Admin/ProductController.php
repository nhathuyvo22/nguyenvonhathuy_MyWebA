<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brands;
use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\ProductImage;

class ProductController extends Controller
{

    public function index($limit = 10)
    {
        $list = Product::with([
            'category:cateid,catename',
            'brand:id,brandname'
        ])
            ->select('id', 'productname', 'price', 'image', 'status', 'cateid', 'brandid')
            ->orderBy('productname')
            ->paginate($limit);

        return view('admin.products.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('cateid', 'catename')->orderBy('catename')->get();
        $brands = Brands::select('id', 'brandname')->orderBy('brandname')->get();

        return view('admin.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        try {
            if (empty($request->cateid)) {
                return back()->withInput()->with('error', 'Vui lòng chọn loại sản phẩm');
            }

            $imageName = null;

            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $imageName = Str::slug($request->productname) . '-' . time() . '.' . $file->extension();
                $file->storeAs('products', $imageName, 'public');
            }

            $product = Product::create([
                'productname'   => $request->productname,
                'slug'          => $request->slug,
                'cateid'        => $request->cateid,
                'brandid'       => $request->brandid,
                'price'         => $request->price,
                'pricediscount' => $request->pricediscount ?? 0,
                'description'   => $request->description,
                'status'        => $request->status,
                'image'         => $imageName,
            ]);
            //
            if ($request->hasFile('imgs')) {
                $i = 1;
                $time = time();
                foreach ($request->file('imgs') as $file) {
                    $imgFileName = $product->id . '_' . $time . '_' . $i . '.' . $file->extension();
                    $file->storeAs('products', $imgFileName, 'public');

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image'      => $imgFileName,
                    ]);
                    $i++;
                }
            }

            return redirect()->route('admin.products.index')
                ->with('success', 'Thêm sản phẩm thành công');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with('images')->findOrFail($id);
        $categories = Category::select('cateid', 'catename')->get();
        $brands = Brands::select('id', 'brandname')->get();

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        try {
            if (empty($request->cateid)) {
                return back()->withInput()->with('error', 'Vui lòng chọn loại sản phẩm');
            }

            $product = Product::find($id);

            if (!$product) {
                return redirect()->route('admin.products.index')
                    ->with('error', 'Sản phẩm không tồn tại');
            }

            // Giữ ảnh đại diện cũ
            $fileName = $product->image;

            // Nếu người dùng chọn ảnh đại diện mới
            if ($request->hasFile('img')) {
                // Xóa ảnh cũ
                if ($fileName) {
                    Storage::disk('public')->delete('products/' . $fileName);
                }

                $file = $request->file('img');
                $fileName = Str::slug($request->productname)
                    . '-' . time()
                    . '.' . $file->extension();
                $file->storeAs('products', $fileName, 'public');
            }

            $product->update([
                'productname'   => $request->productname,
                'slug'          => $request->slug,
                'cateid'        => $request->cateid,
                'brandid'       => $request->brandid,
                'price'         => $request->price,
                'pricediscount' => $request->pricediscount,
                'status'        => $request->status,
                'description'   => $request->description,
                'image'         => $fileName,
            ]);

            // Thêm ảnh phụ mới (không xóa ảnh phụ cũ)
            if ($request->hasFile('imgs')) {
                $i = 1;
                $time = time();
                foreach ($request->file('imgs') as $file) {
                    $imgFileName = $product->id . '_' . $time . '_' . $i . '.' . $file->extension();
                    $file->storeAs('products', $imgFileName, 'public');

                    ProductImage::create([
                        'product_id' => $product->id,
                        'image'      => $imgFileName,
                    ]);
                    $i++;
                }
            }

            return redirect()->route('admin.products.index')
                ->with('success', 'Cập nhật sản phẩm thành công');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);

            // Xóa ảnh chính
            if ($product->image) {
                Storage::disk('public')->delete('products/' . $product->image);
            }

            // Xóa ảnh phụ
            foreach ($product->images as $image) {
                Storage::disk('public')->delete('products/' . $image->image);
            }

            // Xóa sản phẩm (ảnh phụ trong DB tự xóa do cascadeOnDelete)
            $product->delete();

            return redirect()->route('admin.products.index')
                ->with('success', 'Xóa sản phẩm thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.products.index')
                ->with('error', 'Xóa sản phẩm thất bại');
        }
    }

    /**
     * Remove a product secondary image (AJAX or normal request).
     */
    public function destroyImage(Request $request, $id)
    {
        try {
            $img = ProductImage::findOrFail($id);

            // delete file from storage
            if ($img->image) {
                Storage::disk('public')->delete('products/' . $img->image);
            }

            $img->delete();

            if ($request->ajax()) {
                return response()->json(['success' => true]);
            }

            return redirect()->back()->with('success', 'Xóa ảnh thành công');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}

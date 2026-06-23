<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brands;

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
    public function store(Request $request)
    {
        try {
            if (empty($request->cateid)) {
                return back()->withInput()->with('error', 'Vui lòng chọn loại sản phẩm');
            }

            Product::create([
                'productname'   => $request->productname,
                'slug'          => $request->slug,
                'cateid'        => $request->cateid,
                'brandid'       => $request->brandid,
                'price'         => $request->price,
                'pricediscount' => $request->pricediscount ?? 0,
                'description'   => $request->description,
                'status'        => $request->status,
            ]);

            return redirect()->route('admin.products.index')
                ->with('success', 'Thêm sản phẩm thành công');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $categories = Category::select('cateid', 'catename')->orderBy('catename')->get();
        $brands = Brands::select('id', 'brandname')->orderBy('brandname')->get();

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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

            $product->update([
                'productname'   => $request->productname,
                'slug'          => $request->slug,
                'cateid'        => $request->cateid,
                'brandid'       => $request->brandid,
                'price'         => $request->price,
                'pricediscount' => $request->pricediscount,
                'status'        => $request->status,
                'description'   => $request->description,
            ]);

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
        //
    }

    public function test1()
    {
        return redirect()->route('admin.home');
    }

    public function test2()
    {
        return redirect('/admin/dashboard');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "Danh sách danh mục";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "Form thêm mới danh mục";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return "Xử lý thêm mới danh mục";
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

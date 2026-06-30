<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Http\Requests\Admin\PostRequest;
use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index($limit = 10)
    {
        $list = Post::with(['user:id,fullname'])
            ->select('id', 'title', 'image', 'status', 'user_id')
            ->orderBy('title')
            ->paginate($limit);

        return view('admin.posts.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.posts.create', compact('users'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        try {
            Post::create([
                'title'   => $request->title,
                'slug'    => $request->slug,
                'content' => $request->content,
                'status'  => $request->status,
                'user_id' => $request->user_id,
                // image xử lý riêng nếu có upload file
            ]);
            return redirect()->route('admin.posts.index')
                ->with('success', 'Thêm thành công.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Thêm thất bại.');
        }
    }
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $users = User::all();
        return view('admin.posts.edit', compact('post', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->update([
                'title'   => $request->title,
                'slug'    => $request->slug,
                'content' => $request->content,
                'status'  => $request->status,
                'user_id' => $request->user_id,
            ]);
            return redirect()->route('admin.posts.index')
                ->with('success', 'Cập nhật thành công.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Cập nhật thất bại.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

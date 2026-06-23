<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index($limit = 10)
    {
        $list = User::select('id', 'fullname', 'username', 'email', 'status')
            ->orderBy('fullname')
            ->paginate($limit);

        return view('admin.users.index', compact('list'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        try {
            User::create([
                'fullname' => $request->fullname,
                'username' => $request->username,
                'email'    => $request->email,
                'password' => bcrypt($request->password),
                'status'   => $request->status
            ]);

            return redirect()->route('admin.users.index')
                ->with('success', 'Thêm người dùng thành công');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        $item = User::find($id);
        return view('admin.users.edit', compact('item'));
    }

    public function update(Request $request, string $id)
    {
        try {
            $user = User::find($id);
            $user->update([
                'fullname' => $request->fullname,
                'username' => $request->username,
                'email'    => $request->email,
                'status'   => $request->status
            ]);

            return redirect()->route('admin.users.index')
                ->with('success', 'Cập nhật người dùng thành công');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        User::find($id)->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'Xóa người dùng thành công');
    }
}

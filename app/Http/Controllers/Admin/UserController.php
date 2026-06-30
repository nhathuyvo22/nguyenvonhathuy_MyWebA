<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Support\Facades\Hash;

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

    public function store(UserRequest $request)
    {
        try {
            User::create([
                'fullname' => $request->fullname,
                'username' => $request->username,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'phone'    => $request->phone,
                'address'  => $request->address,
                'status'   => $request->status,
                'gender'   => $request->gender,
                'birthday' => $request->birthday,
                'role'     => $request->role,
            ]);
            return redirect()->route('admin.users.index')
                ->with('success', 'Thêm thành công.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Thêm thất bại.');
        }
    }

    public function edit(string $id)
    {
        $item = User::find($id);
        return view('admin.users.edit', compact('item'));
    }


   

    public function update(UserRequest $request, string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update([
                'fullname' => $request->fullname,
                'username' => $request->username,
                'email'    => $request->email,
                'status'   => $request->status,
            ]);
            return redirect()->route('admin.users.index')
                ->with('success', 'Cập nhật thành công.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Cập nhật thất bại.');
        }
    }

    public function destroy(string $id)
    {
        User::find($id)->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'Xóa người dùng thành công');
    }
}

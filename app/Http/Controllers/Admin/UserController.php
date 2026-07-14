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

    public function show(string $id)
    {
        //
    }
    public function destroy(string $id)
    {
        try {
            $product = User::findOrFail($id);
            $product->delete();

            return redirect()->route('admin.users.index')
                ->with('success', 'Xóa nhân viên thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Xóa nhân viên thất bại');
        }
    }

    public function trash()
    {
        $list = User::onlyTrashed()
            ->select('id', 'fullname', 'username', 'email', 'status')
            ->orderBy('fullname')
            ->paginate(10);

        return view('admin.users.trash', compact('list'));
    }

    public function restore($id)
    {
        try {
            User::onlyTrashed()->findOrFail($id)->restore();
            return redirect()->route('admin.users.trash')
                ->with('success', 'Khôi phục thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Khôi phục thất bại.');
        }
    }

    public function forceDelete($id)
    {
        try {
            User::onlyTrashed()->findOrFail($id)->forceDelete();
            return redirect()->route('admin.users.trash')
                ->with('success', 'Xóa vĩnh viễn thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Xóa thất bại.');
        }
    }
}

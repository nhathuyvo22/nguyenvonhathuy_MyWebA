<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Hiển thị trang đăng nhập
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    // Xử lý đăng nhập
    public function postLogin(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'username' => 'Tên đăng nhập',
                'password' => 'Mật khẩu',
            ]
        );

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return back()
                ->with('message', 'Username không tồn tại')
                ->withInput();
        }

        $check = Hash::check($request->password, $user->password);

        if (!$check) {
            return back()
                ->with('message', 'Mật khẩu không đúng')
                ->withInput();
        }

        $remember = $request->has('remember') ? true : false;
        Auth::login($user, $remember);

        return redirect()->intended(route('admin.dashboard'));
    }

    // Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    // Hiển thị trang quên mật khẩu
    public function forgotPassword()
    {
        return view('admin.auth.forgotpassword');
    }

    // Xử lý quên mật khẩu
    // Xử lý quên mật khẩu
    public function postForgotPassword(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users,email',
            ],
            [
                'required' => ':attribute không được để trống.',
                'email'    => ':attribute không đúng định dạng.',
                'exists'   => ':attribute không tồn tại trong hệ thống.',
            ],
            [
                'email' => 'Email',
            ]
        );

        $user = User::where('email', $request->email)->first();

        // Tạo mật khẩu mới ngẫu nhiên
        $passRandom = Str::random(10);

        // Mã hóa và lưu vào DB
        $user->update([
            'password' => Hash::make($passRandom),
        ]);

        // Gửi email
        Mail::to($user->email)->send(new ForgotPasswordMail($passRandom));

        return back()->with('success', 'Đã gửi mật khẩu mới. Bạn vui lòng kiểm tra email của bạn.');
    }
    // Hiển thị trang đổi mật khẩu
    public function changePassword()
    {
        return view('admin.auth.changepassword');
    }

    // Xử lý đổi mật khẩu
    public function postChangePassword(Request $request)
    {
        $request->validate(
            [
                'old_password'              => 'required',
                'new_password'              => 'required|min:6|different:old_password',
                'new_password_confirmation' => 'required|same:new_password',
            ],
            [
                'required'  => ':attribute không được để trống.',
                'min'       => ':attribute phải từ :min ký tự trở lên.',
                'different' => ':attribute phải khác mật khẩu cũ.',
                'same'      => ':attribute không khớp.',
            ],
            [
                'old_password'              => 'Mật khẩu cũ',
                'new_password'              => 'Mật khẩu mới',
                'new_password_confirmation' => 'Xác nhận mật khẩu mới',
            ]
        );

        $user = Auth::user();

        // Kiểm tra mật khẩu cũ có đúng không
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'Mật khẩu cũ không đúng')->withInput();
        }

        // Cập nhật mật khẩu mới
        User::where('id', $user->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Đổi mật khẩu thành công.');
    }
}

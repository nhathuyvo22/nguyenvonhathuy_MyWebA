<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập hệ thống</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <form action="{{ route('admin.login.post') }}" method="POST"
            class="mx-auto shadow-lg p-4 bg-light" style="max-width: 450px">
            @csrf
            <h2 class="mb-3">Đăng nhập hệ thống</h2>

            <x-admin.alert />

            @if(session('message'))
            <div class="alert alert-danger">{{ session('message') }}</div>
            @endif

            <div class="mb-3">
                <label>Username</label>
                <input type="text" class="form-control" name="username"
                    placeholder="Nhập username" value="{{ old('username') }}">
                @error('username')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label>Mật khẩu</label>
                <input type="password" class="form-control" name="password"
                    placeholder="Nhập mật khẩu">
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember">
                <label class="form-check-label">Ghi nhớ đăng nhập</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
            <div class="mt-2">
                <a href="{{ route('admin.forgotpass') }}">Quên mật khẩu</a>
            </div>
        </form>
    </div>
</body>

</html>
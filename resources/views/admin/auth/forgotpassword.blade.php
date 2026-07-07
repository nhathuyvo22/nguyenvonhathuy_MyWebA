<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-header text-center bg-primary text-white">
                        <h4 class="mb-0">Quên mật khẩu</h4>
                    </div>
                    <div class="card-body p-4">

                        <x-admin.alert />

                        <p class="text-muted text-center mb-4">
                            Nhập tên đăng nhập để reset mật khẩu về mặc định.
                        </p>

                        <form action="{{ route('admin.forgotpass.post') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Tên đăng nhập</label>
                                <input type="text" name="username" class="form-control"
                                    placeholder="Nhập username" value="{{ old('username') }}">
                                @error('username')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Reset mật khẩu</button>
                        </form>

                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('admin.login') }}" class="text-decoration-none">
                            Quay lại đăng nhập
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
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
                            Nhập email để nhận mật khẩu mới.
                        </p>

                        <form action="{{ route('admin.forgotpass.post') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" name="email" class="form-control"
                                    placeholder="Nhập email" value="{{ old('email') }}">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Gửi mật khẩu mới</button>
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
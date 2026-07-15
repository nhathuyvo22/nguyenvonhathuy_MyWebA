<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'My Web')</title>

    <!-- {{-- CDN Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- CDN Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"> -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- CDN Bootstrap JavaScript - ĐÃ CHUYỂN QUA VITE, KHÔNG DÙNG NỮA --}}
    <!-- {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script> --}} -->

    <style>
        .auto-dismiss-alert {
            transition: opacity 0.35s ease, transform 0.35s ease;
        }

        .auto-dismiss-alert.is-hiding {
            opacity: 0;
            transform: translateY(-8px);
        }

        /* Cho phép sidebar tự cuộn khi submenu mở ra dài hơn màn hình */
        .admin-sidebar-col {
            overflow-y: auto;
            max-height: 100vh;
        }
    </style>

</head>

<body>
    <div class="container-fluid">
        <div class="row min-vh-100">
            {{-- SIDEBAR --}}
            <div class="col-md-2 bg-dark text-white p-0 admin-sidebar-col">
                @include('admin._partials.sidebar')
            </div>

            {{-- RIGHT CONTENT --}}
            <div class="col-md-10 d-flex flex-column p-0">
                {{-- HEADER --}}
                <div class="border-bottom bg-white">
                    @include('admin._partials.header')
                </div>

                {{-- MAIN CONTENT --}}
                <main class="flex-grow-1 bg-light p-3">
                    @yield('content')
                </main>

                {{-- FOOTER --}}
                <footer class="bg-dark text-white text-center py-2">
                    @include('admin._partials.footer')
                </footer>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.alert').forEach(function(alertEl) {
                if (alertEl.dataset.autoDismiss === 'false') {
                    return;
                }

                setTimeout(function() {
                    alertEl.classList.add('is-hiding');
                    setTimeout(function() {
                        alertEl.style.display = 'none';
                    }, 300);
                }, 3000);
            });
        });
    </script>
</body>

</html>
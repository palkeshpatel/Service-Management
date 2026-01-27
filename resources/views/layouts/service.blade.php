<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Yuvaan Energy - Service Management')</title>
    <link rel="icon" type="image/png" href="{{ asset('image/fav-log.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('image/fav-log.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/fav-log.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --primary-color: #601d57;
            --primary-dark: #282560;
            --bg-color: #f8f9fa;
            --text-color: #333333;
            --card-bg: #ffffff;
            --border-color: #dee2e6;
        }
        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .btn-primary {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
        }
        .btn-primary:hover {
            background-color: var(--primary-dark) !important;
            border-color: var(--primary-dark) !important;
        }
        .text-primary {
            color: var(--primary-color) !important;
        }
        .bg-primary {
            background-color: var(--primary-color) !important;
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Simple Header with Login Link -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('service.index') }}">
                <img src="{{ asset('image/logo.png') }}" alt="Yuvaan Energy" style="max-height: 50px;">
            </a>
            <div class="ms-auto">
                @auth
                    <a href="{{ route('admin.requests.index') }}" class="btn btn-outline-primary me-2">
                        <i class="bi bi-inbox me-1"></i>Admin Panel
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary">
                            <i class="bi bi-box-arrow-right me-1"></i>Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Admin Login
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 9999; max-width: 500px;" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 9999; max-width: 500px;" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>

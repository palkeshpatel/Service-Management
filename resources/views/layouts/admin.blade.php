<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin - Service Management')</title>
    <link rel="icon" type="image/png" href="{{ asset('image/fav-log.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('image/fav-log.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .admin-sidebar {
            width: 250px;
            background-color: var(--primary-color);
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            color: white;
            padding: 20px 0;
        }
        .admin-main {
            margin-left: 250px;
            padding: 20px;
        }
        .admin-nav-item {
            padding: 12px 20px;
            color: white;
            text-decoration: none;
            display: block;
            transition: all 0.3s;
        }
        .admin-nav-item:hover, .admin-nav-item.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }
        .inbox-item {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .inbox-item:hover {
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-color: var(--primary-color);
        }
        .inbox-item.unread {
            background: rgba(96, 29, 87, 0.05);
            font-weight: 600;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="admin-sidebar">
        <div class="text-center mb-4">
            <img src="{{ asset('image/logo.png') }}" alt="Yuvaan Energy" style="max-height: 60px; background: white; padding: 5px; border-radius: 5px;">
            <h5 class="mt-2">Service Management</h5>
        </div>
        <nav>
            <a href="{{ route('admin.requests.index') }}" class="admin-nav-item {{ request()->routeIs('admin.requests.*') ? 'active' : '' }}">
                <i class="bi bi-inbox me-2"></i>Service Requests
            </a>
            <a href="{{ route('service.index') }}" class="admin-nav-item" target="_blank">
                <i class="bi bi-globe me-2"></i>View Service Page
            </a>
            @auth
                <form action="{{ route('logout') }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit" class="admin-nav-item w-100 text-start border-0 bg-transparent text-white">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </button>
                </form>
            @endauth
        </nav>
    </div>

    <div class="admin-main">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>

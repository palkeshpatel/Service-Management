<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Service Management</title>
    <link rel="icon" type="image/png" href="{{ asset('image/fav-log.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>

@section('title', 'Login - Service Management')

@section('content')
<style>
    .login-container {
        min-height: 100vh;
        background: linear-gradient(135deg, rgba(96, 29, 87, 0.9), rgba(40, 37, 96, 0.9)), url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=1600') center/cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    
    .login-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        max-width: 450px;
        width: 100%;
    }
    
    .login-card-header {
        background: linear-gradient(135deg, #601d57, #282560);
        color: white;
        padding: 30px;
        text-align: center;
    }
    
    .login-logo-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
    }
    
    .login-logo {
        width: 80px;
        height: 80px;
        object-fit: contain;
        background: white;
        border-radius: 12px;
        padding: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    
    .login-card-header h3 {
        margin: 0;
        font-weight: 600;
        font-size: 1.25rem;
    }
    
    .login-card-body {
        padding: 40px;
    }
    
    .input-group-text {
        background-color: #f8f9fa;
        border-right: none;
        color: #6c757d;
    }
    
    .form-control {
        border-left: none;
        padding-left: 0;
    }
    
    .form-control:focus {
        border-left: none;
        box-shadow: 0 0 0 0.2rem rgba(96, 29, 87, 0.25);
    }
    
    .input-group:focus-within .input-group-text {
        border-color: #601d57;
        background-color: #fff;
    }
    
    .input-group:focus-within .form-control {
        border-color: #601d57;
    }
    
    .password-toggle {
        cursor: pointer;
        background-color: #f8f9fa;
        border-left: none;
        color: #6c757d;
    }
    
    .password-toggle:hover {
        background-color: #e9ecef;
        color: #601d57;
    }
    
    .btn-login {
        background: linear-gradient(135deg, #601d57, #282560);
        border: none;
        padding: 12px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(96, 29, 87, 0.4);
        background: linear-gradient(135deg, #282560, #601d57);
    }
</style>

<div class="login-container">
    <div class="login-card">
        <div class="login-card-header">
            <div class="login-logo-container">
                <img src="{{ asset('image/logo.png') }}" alt="Yuvaan Energy Limited" class="login-logo">
                <h3>Service Management System</h3>
            </div>
        </div>
        <div class="login-card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label class="form-label fw-semibold">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input type="password" name="password" id="passwordInput" class="form-control" placeholder="Enter your password" required>
                        <span class="input-group-text password-toggle" id="togglePassword">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </span>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-login text-white w-100">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                </button>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    // Password Toggle
    $('#togglePassword').on('click', function() {
        const passwordInput = $('#passwordInput');
        const eyeIcon = $('#eyeIcon');
        
        if (passwordInput.attr('type') === 'password') {
            passwordInput.attr('type', 'text');
            eyeIcon.removeClass('bi-eye').addClass('bi-eye-slash');
        } else {
            passwordInput.attr('type', 'password');
            eyeIcon.removeClass('bi-eye-slash').addClass('bi-eye');
        }
    });
});
</script>
@endpush
</body>
</html>

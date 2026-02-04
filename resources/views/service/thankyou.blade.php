@extends('layouts.service')

@section('title', 'Thank You - Yuvaan Energy')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<style>
    .thank-you-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        padding: 60px 20px;
        text-align: center;
    }
    .thank-you-header h1 {
        color: white;
        font-weight: 600;
    }
    .thank-you-header a {
        color: white !important;
        text-decoration: none;
        transition: opacity 0.3s;
    }
    .thank-you-header a:hover {
        opacity: 0.9;
        text-decoration: underline;
    }
    .thank-you-content {
        background: white;
        padding: 60px 40px;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        margin: 30px auto;
        max-width: 700px;
        text-align: center;
    }
    .success-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        color: white;
        font-size: 3rem;
    }
    .contact-info-box {
        background: rgba(96, 29, 87, 0.05);
        border: 2px solid var(--primary-color);
        border-radius: 10px;
        padding: 30px;
        margin-top: 30px;
    }
    .contact-info-box h5 {
        color: var(--primary-color);
        margin-bottom: 20px;
        font-weight: 600;
    }
    .contact-info-box p {
        margin-bottom: 10px;
        font-size: 1.1rem;
    }
    .contact-info-box a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
    }
    .contact-info-box a:hover {
        text-decoration: underline;
    }
    .btn-back {
        margin-top: 30px;
        padding: 12px 30px;
        font-size: 1.1rem;
    }
</style>
@endpush

@section('content')
<div class="thank-you-header">
    <div class="container">
        <h1 class="mb-3">Service Request Submitted</h1>
        <a href="{{ route('service.index') }}" class="text-white text-decoration-none">
            <i class="bi bi-arrow-left me-2"></i>Back to Service Page
        </a>
    </div>
</div>

<div class="container">
    <div class="thank-you-content">
        <div class="success-icon">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        
        <h2 class="mb-4" style="color: var(--primary-color);">Thank You!</h2>

        @if(isset($requestId))
        <div class="alert alert-success d-inline-block px-4 py-2 mb-4">
            <h5 class="m-0">Your Request ID: <strong>{{ $requestId }}</strong></h5>
            <small>Please keep this ID for future reference</small>
        </div>
        @endif
        
        <p class="lead mb-4">Our Team will Connect Soon</p>
        
        <div class="contact-info-box">
            <h5><i class="bi bi-info-circle me-2"></i>For More Details Contact On:</h5>
            <p class="mb-2">
                <strong>Mail ID –</strong> 
                <a href="mailto:service@yuvaanenergy.com">service@yuvaanenergy.com</a>
            </p>
            <p class="mb-0">
                <strong>Contact No. –</strong> 
                <a href="tel:9274100819">9274100819</a>
            </p>
        </div>
        
        <a href="{{ route('service.index') }}" class="btn btn-primary btn-back">
            <i class="bi bi-house me-2"></i>Back to Home
        </a>
    </div>
</div>
@endsection

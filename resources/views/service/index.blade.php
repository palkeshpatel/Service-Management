@extends('layouts.service')

@section('title', 'Service Request - Yuvaan Energy')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .service-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 80px 20px;
            text-align: center;
        }

        .service-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 2px solid var(--border-color);
            height: 100%;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(96, 29, 87, 0.2);
            border-color: var(--primary-color);
        }

        .service-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 2rem;
        }

        .intro-section {
            background: white;
            padding: 60px 20px;
            text-align: center;
        }

        .services-section {
            background: var(--bg-color);
            padding: 60px 20px;
        }

        .contact-info {
            background: white;
            padding: 40px 20px;
            text-align: center;
        }
    </style>
@endpush

@section('content')
    <!-- Header Section -->
    <div class="service-header">
        <div class="container">

            <h1 class="display-4 fw-bold mb-3">How can we help you?</h1>
            <p class="lead">In order to understand the issue properly please provide below details.</p>
        </div>
    </div>

    <!-- Intro Section -->
    <div class="intro-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <p class="fs-5 text-muted">
                        Yuvaan Energy Limited provides comprehensive solar panel service and support throughout India.
                        Our experienced team is dedicated to ensuring your solar installation operates at peak efficiency.
                        Whether you're experiencing panel damage, junction box issues, or hotspot problems, we're here to
                        help.
                        Submit your service request with detailed information and our technical experts will review and
                        respond promptly.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div class="services-section">
        <div class="container">
            <div class="row g-4">
                <!-- Panel Damage Card -->
                <div class="col-md-4">
                    <div class="card service-card h-100">
                        <div class="card-body text-center p-4">
                            <div class="service-icon">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>
                            <h3 class="card-title mb-3">Panel Damage (CRACK)</h3>
                            <p class="card-text text-muted mb-4">
                                Report cracked or damaged solar panels with detailed documentation including loading
                                procedures,
                                pallet images, and damage photographs for comprehensive assessment and warranty processing.
                            </p>
                            <a href="{{ route('service.form', 'panel_damage') }}" class="btn btn-primary btn-lg w-100">
                                Submit Request <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Junction Box Card -->
                <div class="col-md-4">
                    <div class="card service-card h-100">
                        <div class="card-body text-center p-4">
                            <div class="service-icon">
                                <i class="bi bi-lightning-charge"></i>
                            </div>
                            <h3 class="card-title mb-3">Junction Box Burnt/Voltage Issue</h3>
                            <p class="card-text text-muted mb-4">
                                Document electrical issues including burnt junction boxes and voltage irregularities with
                                multimeter readings, photographs, and site documentation for technical evaluation.
                            </p>
                            <a href="{{ route('service.form', 'junction_box') }}" class="btn btn-primary btn-lg w-100">
                                Submit Request <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Hotspot Card -->
                <div class="col-md-4">
                    <div class="card service-card h-100">
                        <div class="card-body text-center p-4">
                            <div class="service-icon">
                                <i class="bi bi-fire"></i>
                            </div>
                            <h3 class="card-title mb-3">Hot-spot/Panel Burnt</h3>
                            <p class="card-text text-muted mb-4">
                                Report hotspot issues and panel burn damage with comprehensive documentation including
                                loading videos, damage photos, installation site images, and detailed issue photographs.
                            </p>
                            <a href="{{ route('service.form', 'hotspot') }}" class="btn btn-primary btn-lg w-100">
                                Submit Request <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Info Section -->
    <div class="contact-info">
        <div class="container">
            <h4 class="mb-3">Need Assistance?</h4>
            <p class="mb-2">
                <i class="bi bi-envelope me-2"></i>
                <a href="mailto:service@yuvaanenergy.com" class="text-decoration-none">service@yuvaanenergy.com</a>
            </p>
            <p class="mb-0">
                <i class="bi bi-telephone me-2"></i>
                <a href="tel:9274100819" class="text-decoration-none">9274100819</a>
            </p>
        </div>
    </div>
@endsection

@extends('layouts.service')

@section('title', 'Service Request Form - Yuvaan Energy')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<style>
    .form-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        padding: 40px 20px;
        text-align: center;
    }
    .form-section {
        background: white;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin: 30px auto;
        max-width: 900px;
    }
    .required-field::after {
        content: " *";
        color: red;
    }
    .file-upload-area {
        border: 2px dashed var(--border-color);
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s;
        cursor: pointer;
    }
    .file-upload-area:hover {
        border-color: var(--primary-color);
        background: rgba(96, 29, 87, 0.05);
    }
    .file-preview {
        margin-top: 10px;
    }
    .file-preview-item {
        display: inline-block;
        margin: 5px;
        padding: 5px 10px;
        background: var(--bg-color);
        border-radius: 5px;
        font-size: 0.9rem;
    }
</style>
@endpush

@section('content')
<div class="form-header">
    <div class="container">
        <h2 class="mb-3">
            @if($type === 'panel_damage')
                Panel Damage (CRACK) - Service Request
            @elseif($type === 'junction_box')
                Junction Box Burnt/Voltage Issue - Service Request
            @else
                Hot-spot/Panel Burnt - Service Request
            @endif
        </h2>
        <a href="{{ route('service.index') }}" class="text-white text-decoration-none">
            <i class="bi bi-arrow-left me-2"></i>Back to Service Page
        </a>
    </div>
</div>

<div class="container">
    <div class="form-section">
        <form action="{{ route('service.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="service_type" value="{{ $type }}">

            <!-- Basic Information -->
            <h4 class="mb-4 text-primary"><i class="bi bi-person me-2"></i>Basic Information</h4>
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <label class="form-label required-field">Name/Company Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label required-field">Phone Number</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label required-field">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label required-field">City</label>
                    <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required>
                    @error('city')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label required-field">Delivery Date</label>
                    <input type="date" class="form-control @error('delivery_date') is-invalid @enderror" name="delivery_date" value="{{ old('delivery_date') }}" required>
                    @error('delivery_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label required-field">Invoice No</label>
                    <input type="text" class="form-control @error('invoice_no') is-invalid @enderror" name="invoice_no" value="{{ old('invoice_no') }}" required>
                    @error('invoice_no')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label required-field">
                        @if($type === 'panel_damage' || $type === 'hotspot')
                            Serial number of Module / which Number of panel
                        @else
                            Serial number & WP
                        @endif
                    </label>
                    <input type="text" class="form-control @error('serial_number') is-invalid @enderror" name="serial_number" value="{{ old('serial_number') }}" required>
                    @error('serial_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Attachments Section -->
            <h4 class="mb-4 text-primary"><i class="bi bi-paperclip me-2"></i>Required Attachments</h4>

            @if($type === 'panel_damage')
                <!-- Panel Damage Attachments -->
                <div class="mb-4">
                    <label class="form-label required-field">Method of Loading & Unloading from vehicle (Video)</label>
                    <input type="file" class="form-control @error('loading_video') is-invalid @enderror" name="loading_video" accept="video/*" required>
                    <small class="text-muted">Max 10MB, Video format (MP4, AVI, MOV, WMV)</small>
                    @error('loading_video')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label required-field">Pallet Box 4 sides images</label>
                    <input type="file" class="form-control @error('pallet_images') is-invalid @enderror" name="pallet_images[]" accept="image/*" multiple required>
                    <small class="text-muted">Upload exactly 4 images (JPG, PNG, Max 5MB each)</small>
                    @error('pallet_images')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label required-field">Full photo of Damage panels from front side & back side</label>
                    <input type="file" class="form-control @error('damage_photos') is-invalid @enderror" name="damage_photos[]" accept="image/*" multiple required>
                    <small class="text-muted">Upload 2-10 images (JPG, PNG, Max 5MB each)</small>
                    @error('damage_photos')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label required-field">Pallet ID slip</label>
                    <input type="file" class="form-control @error('pallet_id_slip') is-invalid @enderror" name="pallet_id_slip" accept="image/*" required>
                    <small class="text-muted">Image format (JPG, PNG, Max 5MB)</small>
                    @error('pallet_id_slip')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label required-field">LR Copy</label>
                    <input type="file" class="form-control @error('lr_copy') is-invalid @enderror" name="lr_copy" accept="image/*" required>
                    <small class="text-muted">Image format (JPG, PNG, Max 5MB)</small>
                    @error('lr_copy')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Photo of Position of Pallet in vehicle</label>
                    <input type="file" class="form-control @error('pallet_position') is-invalid @enderror" name="pallet_position" accept="image/*">
                    <small class="text-muted">Image format (JPG, PNG, Max 5MB) - Optional</small>
                    @error('pallet_position')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

            @elseif($type === 'junction_box')
                <!-- Junction Box Attachments -->
                <div class="mb-4">
                    <label class="form-label required-field">Voltage with Multimeter (Video)</label>
                    <input type="file" class="form-control @error('voltage_video') is-invalid @enderror" name="voltage_video" accept="video/*" required>
                    <small class="text-muted">Max 10MB, Video format (MP4, AVI, MOV, WMV)</small>
                    @error('voltage_video')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label required-field">Panel Junction box burnt</label>
                    <input type="file" class="form-control @error('junction_box_photo') is-invalid @enderror" name="junction_box_photo" accept="image/*" required>
                    <small class="text-muted">Image format (JPG, PNG, Max 5MB)</small>
                    @error('junction_box_photo')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label required-field">Voltage power</label>
                    <input type="file" class="form-control @error('voltage_power') is-invalid @enderror" name="voltage_power" accept="image/*" required>
                    <small class="text-muted">Image format (JPG, PNG, Max 5MB)</small>
                    @error('voltage_power')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label required-field">Site Photograph</label>
                    <input type="file" class="form-control @error('site_photograph') is-invalid @enderror" name="site_photograph" accept="image/*" required>
                    <small class="text-muted">Image format (JPG, PNG, Max 5MB)</small>
                    @error('site_photograph')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

            @elseif($type === 'hotspot')
                <!-- Hotspot Attachments -->
                <div class="mb-4">
                    <label class="form-label required-field">Method of Loading & Unloading from vehicle (Video)</label>
                    <input type="file" class="form-control @error('loading_video') is-invalid @enderror" name="loading_video" accept="video/*" required>
                    <small class="text-muted">Max 10MB, Video format (MP4, AVI, MOV, WMV)</small>
                    @error('loading_video')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label required-field">Full photo of Damage panels from front side & back side</label>
                    <input type="file" class="form-control @error('damage_photos') is-invalid @enderror" name="damage_photos[]" accept="image/*" multiple required>
                    <small class="text-muted">Upload 2-10 images (JPG, PNG, Max 5MB each)</small>
                    @error('damage_photos')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label required-field">Pallet ID slip</label>
                    <input type="file" class="form-control @error('pallet_id_slip') is-invalid @enderror" name="pallet_id_slip" accept="image/*" required>
                    <small class="text-muted">Image format (JPG, PNG, Max 5MB)</small>
                    @error('pallet_id_slip')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label required-field">Installation Site Photograph</label>
                    <input type="file" class="form-control @error('installation_site') is-invalid @enderror" name="installation_site" accept="image/*" required>
                    <small class="text-muted">Image format (JPG, PNG, Max 5MB)</small>
                    @error('installation_site')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label required-field">Photos of issue</label>
                    <input type="file" class="form-control @error('issue_photos') is-invalid @enderror" name="issue_photos[]" accept="image/*" multiple required>
                    <small class="text-muted">Upload 1-10 images (JPG, PNG, Max 5MB each)</small>
                    @error('issue_photos')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            @endif

            <!-- Contact Information -->
            <div class="alert alert-info mt-4">
                <h6><i class="bi bi-info-circle me-2"></i>Contact Information</h6>
                <p class="mb-1"><strong>Email:</strong> <a href="mailto:service@yuvaanenergy.com">service@yuvaanenergy.com</a></p>
                <p class="mb-0"><strong>Phone:</strong> <a href="tel:9274100819">9274100819</a></p>
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg px-5">
                    <i class="bi bi-send me-2"></i>Submit Request
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

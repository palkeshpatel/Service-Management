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
    .form-header h2 {
        color: white;
        font-weight: 600;
    }
    .form-header a {
        color: white !important;
        text-decoration: none;
        transition: opacity 0.3s;
    }
    .form-header a:hover {
        opacity: 0.9;
        text-decoration: underline;
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
    .upload-button-group {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-top: 10px;
    }
    .upload-btn-custom {
        border: 2px dashed var(--border-color);
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        background: var(--bg-color);
        position: relative;
        min-height: 150px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .upload-btn-custom:hover {
        border-color: var(--primary-color);
        background: rgba(96, 29, 87, 0.05);
    }
    .upload-btn-custom input[type="file"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        z-index: 2;
    }
    .upload-btn-custom.has-file {
        border-color: var(--primary-color);
        background: rgba(96, 29, 87, 0.1);
        padding: 5px;
    }
    .upload-btn-custom .preview-image {
        width: 100%;
        height: 120px;
        object-fit: cover;
        border-radius: 6px;
        margin-bottom: 5px;
        display: none;
    }
    .upload-btn-custom.has-file .preview-image {
        display: block;
    }
    .upload-btn-custom.has-file .upload-icon {
        display: none;
    }
    .upload-btn-custom .upload-icon {
        font-size: 2rem;
        color: var(--primary-color);
        margin-bottom: 8px;
    }
    .upload-btn-custom .file-name {
        font-size: 0.75rem;
        word-break: break-word;
        max-width: 100%;
    }
    .image-preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 15px;
    }
    .image-preview-item {
        position: relative;
        width: 120px;
        height: 120px;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        overflow: hidden;
        background: var(--bg-color);
    }
    .image-preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .image-preview-item .remove-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 14px;
    }
    .add-image-btn {
        width: 120px;
        height: 120px;
        border: 2px dashed var(--primary-color);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        background: rgba(96, 29, 87, 0.05);
        transition: all 0.3s;
        color: var(--primary-color);
        font-size: 2rem;
    }
    .add-image-btn:hover {
        background: rgba(96, 29, 87, 0.1);
        transform: scale(1.05);
    }
    .form-control.is-invalid, .form-control.is-invalid:focus {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
    }
    .error-message, .invalid-feedback, .error {
        color: #dc3545 !important;
        font-size: 0.875rem;
        font-weight: 500;
    }
    .upload-btn-custom.is-invalid {
        border-color: #dc3545 !important;
        background: rgba(220, 53, 69, 0.1) !important;
    }
    .form-section {
        background: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        margin: 30px auto;
        max-width: 900px;
    }
    .form-label {
        font-weight: 600;
        color: var(--text-color);
        margin-bottom: 8px;
    }
    .form-control {
        border-radius: 8px;
        padding: 10px 15px;
        border: 1px solid var(--border-color);
        transition: all 0.3s;
    }
    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(96, 29, 87, 0.15);
    }
    .text-primary {
        color: var(--primary-color) !important;
    }
    h4.text-primary {
        color: var(--primary-color) !important;
    }
    .loader-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        backdrop-filter: blur(2px);
    }
    .loader-spinner {
        border: 4px solid #f3f3f3;
        border-top: 4px solid var(--primary-color);
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
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
        <form id="serviceForm" action="{{ $type === 'panel_damage' ? route('service.panel_damage.store') : ($type === 'junction_box' ? route('service.junction_box.store') : route('service.hotspot.store')) }}" method="POST" enctype="multipart/form-data">
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
                    <input type="file" class="form-control @error('loading_video') is-invalid @enderror" name="loading_video" accept="video/*" id="loading_video" required>
                    <input type="hidden" name="loading_video_path" id="loading_video_path">
                    <div id="loading_video_progress" class="progress mt-2" style="display:none; height: 20px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                    <small class="text-muted">Max 10MB, Video format (MP4, AVI, MOV, WMV)</small>
                    @error('loading_video')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label required-field">Pallet Box 4 sides images</label>
                    <small class="text-muted d-block mb-2">Upload exactly 4 images (JPG, PNG, Max 5MB each)</small>
                    <div class="upload-button-group">
                        <div class="upload-btn-custom" data-side="side1">
                            <input type="file" name="pallet_images[]" accept="image/*" data-side="side1" class="pallet-image-input">
                            <img src="" alt="Preview" class="preview-image">
                            <i class="bi bi-image upload-icon"></i>
                            <div class="mt-2 small">Side 1</div>
                            <div class="file-name mt-1 small text-muted"></div>
                        </div>
                        <div class="upload-btn-custom" data-side="side2">
                            <input type="file" name="pallet_images[]" accept="image/*" data-side="side2" class="pallet-image-input">
                            <img src="" alt="Preview" class="preview-image">
                            <i class="bi bi-image upload-icon"></i>
                            <div class="mt-2 small">Side 2</div>
                            <div class="file-name mt-1 small text-muted"></div>
                        </div>
                        <div class="upload-btn-custom" data-side="side3">
                            <input type="file" name="pallet_images[]" accept="image/*" data-side="side3" class="pallet-image-input">
                            <img src="" alt="Preview" class="preview-image">
                            <i class="bi bi-image upload-icon"></i>
                            <div class="mt-2 small">Side 3</div>
                            <div class="file-name mt-1 small text-muted"></div>
                        </div>
                        <div class="upload-btn-custom" data-side="side4">
                            <input type="file" name="pallet_images[]" accept="image/*" data-side="side4" class="pallet-image-input">
                            <img src="" alt="Preview" class="preview-image">
                            <i class="bi bi-image upload-icon"></i>
                            <div class="mt-2 small">Side 4</div>
                            <div class="file-name mt-1 small text-muted"></div>
                        </div>
                    </div>
                    <div class="error-message text-danger small mt-1" id="pallet_images_error"></div>
                    @error('pallet_images')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label required-field">Full photo of Damage panels from front side & back side</label>
                    <small class="text-muted d-block mb-2">Upload at least 2 images, maximum 10 images (JPG, PNG, Max 5MB each)</small>
                    <div class="image-preview-container" id="damagePhotosContainer">
                        <!-- Images will be added here dynamically -->
                    </div>
                    <input type="file" id="damagePhotoInput" accept="image/*" style="display: none;" multiple>
                    <div class="add-image-btn mt-2" id="addDamagePhotoBtn">
                        <i class="bi bi-plus-lg"></i>
                    </div>
                    <div class="error-message text-danger small mt-2" id="damage_photos_error"></div>
                    @error('damage_photos')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label required-field">Pallet ID slip</label>
                    <input type="file" class="form-control @error('pallet_id_slip') is-invalid @enderror" name="pallet_id_slip" accept="image/*" id="pallet_id_slip" required>
                    <input type="hidden" name="pallet_id_slip_path" id="pallet_id_slip_path">
                    <div id="pallet_id_slip_progress" class="progress mt-2" style="display:none; height: 20px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                    <small class="text-muted">Image format (JPG, PNG, Max 5MB)</small>
                    @error('pallet_id_slip')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label required-field">LR Copy</label>
                    <input type="file" class="form-control @error('lr_copy') is-invalid @enderror" name="lr_copy" accept="image/*" id="lr_copy" required>
                    <input type="hidden" name="lr_copy_path" id="lr_copy_path">
                    <div id="lr_copy_progress" class="progress mt-2" style="display:none; height: 20px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                    <small class="text-muted">Image format (JPG, PNG, Max 5MB)</small>
                    @error('lr_copy')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Photo of Position of Pallet in vehicle</label>
                    <input type="file" class="form-control @error('pallet_position') is-invalid @enderror" name="pallet_position" accept="image/*" id="pallet_position">
                    <input type="hidden" name="pallet_position_path" id="pallet_position_path">
                    <div id="pallet_position_progress" class="progress mt-2" style="display:none; height: 20px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                    <small class="text-muted">Image format (JPG, PNG, Max 5MB) - Optional</small>
                    @error('pallet_position')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

            @elseif($type === 'junction_box')
                <!-- Junction Box Attachments -->
                <div class="mb-4">
                    <label class="form-label required-field">Video of voltage measuring</label>
                    <input type="file" class="form-control @error('voltage_video') is-invalid @enderror" name="voltage_video" accept="video/*" id="voltage_video" required>
                    <input type="hidden" name="voltage_video_path" id="voltage_video_path">
                    <div id="voltage_video_progress" class="progress mt-2" style="display:none; height: 20px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                    <small class="text-muted">Max 10MB, Video format (MP4, AVI, MOV, WMV)</small>
                    <div class="error-message text-danger small mt-1" id="voltage_video_error"></div>
                    @error('voltage_video')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label required-field">Panel Junction box burnt</label>
                    <input type="file" class="form-control @error('junction_box_photo') is-invalid @enderror" name="junction_box_photo" accept="image/*" id="junction_box_photo" required>
                    <input type="hidden" name="junction_box_photo_path" id="junction_box_photo_path">
                    <div id="junction_box_photo_progress" class="progress mt-2" style="display:none; height: 20px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                    <small class="text-muted">Image format (JPG, PNG, Max 5MB)</small>
                    <div class="error-message text-danger small mt-1" id="junction_box_photo_error"></div>
                    @error('junction_box_photo')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label required-field">Voltage power</label>
                    <input type="file" class="form-control @error('voltage_power') is-invalid @enderror" name="voltage_power" accept="image/*" id="voltage_power" required>
                    <input type="hidden" name="voltage_power_path" id="voltage_power_path">
                    <div id="voltage_power_progress" class="progress mt-2" style="display:none; height: 20px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                    <small class="text-muted">Image format (JPG, PNG, Max 5MB)</small>
                    <div class="error-message text-danger small mt-1" id="voltage_power_error"></div>
                    @error('voltage_power')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label required-field">Site Photograph</label>
                    <input type="file" class="form-control @error('site_photograph') is-invalid @enderror" name="site_photograph" accept="image/*" id="site_photograph" required>
                    <input type="hidden" name="site_photograph_path" id="site_photograph_path">
                    <div id="site_photograph_progress" class="progress mt-2" style="display:none; height: 20px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                    <small class="text-muted">Image format (JPG, PNG, Max 5MB)</small>
                    <div class="error-message text-danger small mt-1" id="site_photograph_error"></div>
                    @error('site_photograph')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

            @elseif($type === 'hotspot')
                <!-- Hotspot Attachments -->
                <div class="mb-4">
                    <label class="form-label required-field">Method of Loading & Unloading from vehicle (Video)</label>
                    <input type="file" class="form-control @error('loading_video') is-invalid @enderror" name="loading_video" accept="video/*" id="loading_video_hotspot" required>
                    <input type="hidden" name="loading_video_path" id="loading_video_hotspot_path">
                    <div id="loading_video_hotspot_progress" class="progress mt-2" style="display:none; height: 20px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                    <small class="text-muted">Max 10MB, Video format (MP4, AVI, MOV, WMV)</small>
                    <div class="error-message text-danger small mt-1" id="loading_video_hotspot_error"></div>
                    @error('loading_video')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label required-field">Full photo of Damage panels from front side & back side</label>
                    <small class="text-muted d-block mb-2">Upload at least 2 images, maximum 10 images (JPG, PNG, Max 5MB each)</small>
                    <div class="image-preview-container" id="damagePhotosHotspotContainer">
                        <!-- Images will be added here dynamically -->
                    </div>
                    <input type="file" id="damagePhotoHotspotInput" accept="image/*" style="display: none;" multiple>
                    <div class="add-image-btn mt-2" id="addDamagePhotoHotspotBtn">
                        <i class="bi bi-plus-lg"></i>
                    </div>
                    <div class="error-message text-danger small mt-2" id="damage_photos_hotspot_error"></div>
                    @error('damage_photos')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label required-field">Pallet ID slip</label>
                    <input type="file" class="form-control @error('pallet_id_slip') is-invalid @enderror" name="pallet_id_slip" accept="image/*" id="pallet_id_slip_hotspot" required>
                    <input type="hidden" name="pallet_id_slip_path" id="pallet_id_slip_hotspot_path">
                    <div id="pallet_id_slip_hotspot_progress" class="progress mt-2" style="display:none; height: 20px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                    <small class="text-muted">Image format (JPG, PNG, Max 5MB)</small>
                    <div class="error-message text-danger small mt-1" id="pallet_id_slip_hotspot_error"></div>
                    @error('pallet_id_slip')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label required-field">Installation Site Photograph</label>
                    <input type="file" class="form-control @error('installation_site') is-invalid @enderror" name="installation_site" accept="image/*" id="installation_site" required>
                    <input type="hidden" name="installation_site_path" id="installation_site_path">
                    <div id="installation_site_progress" class="progress mt-2" style="display:none; height: 20px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                    <small class="text-muted">Image format (JPG, PNG, Max 5MB)</small>
                    <div class="error-message text-danger small mt-1" id="installation_site_error"></div>
                    @error('installation_site')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label required-field">Photos of issue</label>
                    <small class="text-muted d-block mb-2">Upload at least 2 images, maximum 10 images (JPG, PNG, Max 5MB each)</small>
                    <div class="image-preview-container" id="issuePhotosContainer">
                        <!-- Images will be added here dynamically -->
                    </div>
                    <input type="file" id="issuePhotoInput" accept="image/*" style="display: none;" multiple>
                    <div class="add-image-btn mt-2" id="addIssuePhotoBtn">
                        <i class="bi bi-plus-lg"></i>
                    </div>
                    <div class="error-message text-danger small mt-2" id="issue_photos_error"></div>
                    @error('issue_photos')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            @endif

            <!-- Submit Button -->
            <div class="text-center mt-4">
                <button type="submit" id="submitBtn" class="btn btn-primary btn-lg px-5">
                    <i class="bi bi-send me-2"></i>Submit Request
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Alert Container for Messages -->
<div id="alertContainer" class="position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 9999; max-width: 500px; display: none;"></div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Global Photo Arrays (must be defined before submitFormAjax)
    var damagePhotos = [];
    var damagePhotosHotspot = [];
    var issuePhotos = [];

    // Global Helper Functions - Consolidated for all form types
    function showLoader() {
        if ($('.loader-overlay').length === 0) {
            $('body').append(`
                <div class="loader-overlay">
                    <div class="loader-spinner"></div>
                </div>
            `);
        }
    }

    function hideLoader() {
        $('.loader-overlay').remove();
    }

    // Global AJAX Form Submission
    function submitFormAjax(form) {
        var formData = new FormData(form);
        var submitBtn = $('#submitBtn');
        var originalHtml = submitBtn.html();
        
        // Add damage photos if they exist (Panel Damage)
        if (typeof damagePhotos !== 'undefined' && Array.isArray(damagePhotos)) {
            damagePhotos.forEach(function(photo, index) {
                formData.append('damage_photos[]', photo.file);
            });
        }

        // Add damage photos if they exist (Hotspot)
        if (typeof damagePhotosHotspot !== 'undefined' && Array.isArray(damagePhotosHotspot)) {
            damagePhotosHotspot.forEach(function(photo, index) {
                formData.append('damage_photos[]', photo.file);
            });
        }

        // Add issue photos if they exist (Hotspot)
        if (typeof issuePhotos !== 'undefined' && Array.isArray(issuePhotos)) {
            issuePhotos.forEach(function(photo, index) {
                formData.append('issue_photos[]', photo.file);
            });
        }
        
        // Disable submit button
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Submitting...');
        showLoader();

        $.ajax({
            url: $(form).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                hideLoader();
                console.log('Full Server Response:', response);

                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                        confirmButtonColor: '#601d57',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var redirectUrl = response.data && response.data.redirect ? response.data.redirect : response.redirect;
                            console.log('Detected Redirect URL:', redirectUrl);
                            
                            if (redirectUrl && redirectUrl !== 'undefined') {
                                console.log('Redirecting to:', redirectUrl);
                                window.location.href = redirectUrl;
                            } else {
                                console.error('Redirect URL is missing or invalid:', redirectUrl);
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Redirect Error',
                                    text: 'Form submitted but redirect URL is missing.',
                                    confirmButtonColor: '#601d57'
                                });
                            }
                        }
                    });
                }
            },
            error: function(xhr) {
                hideLoader();
                submitBtn.prop('disabled', false).html(originalHtml);
                
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $('.is-invalid').removeClass('is-invalid');
                    $('.error-message').text(''); 
                    $('.invalid-feedback').remove(); 
                    
                    $.each(errors, function(field, messages) {
                        var fieldName = field.replace(/\./g, '_');
                        var $field = $('[name="' + field + '"], [name="' + fieldName + '"], #' + field);
                        
                        if ($field.length) {
                            $field.addClass('is-invalid');
                            $field.css('border-color', '#dc3545');
                            var errorMsg = Array.isArray(messages) ? messages[0] : messages;
                            
                            if ($field.attr('type') === 'file') {
                                var $errorContainer = $field.closest('.mb-4').find('.error-message');
                                if ($errorContainer.length) {
                                    $errorContainer.text(errorMsg).css('color', '#dc3545');
                                } else {
                                    $field.after('<div class="error-message text-danger small mt-1">' + errorMsg + '</div>');
                                }
                            } else {
                                $field.after('<div class="invalid-feedback d-block" style="color: #dc3545 !important;">' + errorMsg + '</div>');
                            }
                        }
                    });
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: 'Please correct the errors in the form',
                        confirmButtonColor: '#601d57'
                    });
                    
                    setTimeout(function() {
                        var firstError = $('.is-invalid').first();
                        if (firstError.length) {
                            $('html, body').animate({
                                scrollTop: firstError.offset().top - 100
                            }, 500);
                        }
                    }, 300);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'An error occurred. Please try again.',
                        confirmButtonColor: '#601d57'
                    });
                }
            }
        });
    }

$(document).ready(function() {
    @if($type === 'panel_damage')
    // Custom validation methods
    $.validator.addMethod("phoneFormat", function(value, element) {
        return this.optional(element) || /^[0-9]{10,15}$/.test(value.replace(/[\s\-\(\)]/g, ''));
    }, "Please enter a valid phone number (10-15 digits)");

    $.validator.addMethod("fileSize", function(value, element, param) {
        if (this.optional(element)) {
            return true;
        }
        var maxSize = param * 1024 * 1024; // Convert MB to bytes
        if (element.files && element.files[0]) {
            return element.files[0].size <= maxSize;
        }
        return true;
    }, "File size must be less than {0}MB");

    $.validator.addMethod("fileCount", function(value, element, param) {
        if (this.optional(element)) {
            return true;
        }
        if (element.files) {
            var min = param.min || 0;
            var max = param.max || 999;
            var count = element.files.length;
            return count >= min && count <= max;
        }
        return true;
    }, function(param, element) {
        var min = param.min || 0;
        var max = param.max || 999;
        if (min === max) {
            return "Please select exactly " + min + " files";
        }
        return "Please select between " + min + " and " + max + " files";
    });

    $.validator.addMethod("videoFormat", function(value, element) {
        if (this.optional(element)) {
            return true;
        }
        if (element.files && element.files[0]) {
            var ext = element.files[0].name.split('.').pop().toLowerCase();
            return ['mp4', 'avi', 'mov', 'wmv'].includes(ext);
        }
        return true;
    }, "Please select a valid video file (MP4, AVI, MOV, WMV)");

    $.validator.addMethod("imageFormat", function(value, element) {
        if (this.optional(element)) {
            return true;
        }
        if (element.files && element.files[0]) {
            var ext = element.files[0].name.split('.').pop().toLowerCase();
            return ['jpg', 'jpeg', 'png'].includes(ext);
        }
        return true;
    }, "Please select a valid image file (JPG, PNG)");

    // Validation rules for Panel Damage
    var validationRules = {
        name: {
            required: true,
            minlength: 2,
            maxlength: 255
        },
        phone: {
            required: true,
            phoneFormat: true
        },
        email: {
            required: true,
            email: true
        },
        city: {
            required: true,
            minlength: 2
        },
        delivery_date: {
            required: true,
            date: true
        },
        invoice_no: {
            required: true,
            minlength: 3
        },
        serial_number: {
            required: true,
            minlength: 3
        },
        loading_video: {
            required: true,
            videoFormat: true,
            fileSize: 10
        },
        'pallet_images[]': {
            required: function() {
                return palletImageCount < 4;
            },
            imageFormat: true,
            fileSize: 5
        },
        pallet_id_slip: {
            required: true,
            imageFormat: true,
            fileSize: 5
        },
        lr_copy: {
            required: true,
            imageFormat: true,
            fileSize: 5
        },
        pallet_position: {
            imageFormat: true,
            fileSize: 5
        }
    };

    // Initialize validation
    var validator = $('#serviceForm').validate({
        rules: validationRules,
        messages: {
            name: {
                required: "Please enter your name or company name",
                minlength: "Name must be at least 2 characters"
            },
            phone: {
                required: "Please enter your phone number",
                phoneFormat: "Please enter a valid phone number"
            },
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address"
            },
            city: {
                required: "Please enter your city",
                minlength: "City name must be at least 2 characters"
            },
            delivery_date: {
                required: "Please select delivery date",
                date: "Please enter a valid date"
            },
            invoice_no: {
                required: "Please enter invoice number",
                minlength: "Invoice number must be at least 3 characters"
            },
            serial_number: {
                required: "Please enter serial number",
                minlength: "Serial number must be at least 3 characters"
            },
            loading_video: {
                required: "Please upload loading video",
                fileSize: "Video size must be less than 10MB"
            },
            'pallet_images[]': {
                required: "Please upload exactly 4 pallet images"
            },
            pallet_id_slip: {
                required: "Please upload pallet ID slip",
                fileSize: "Image size must be less than 5MB"
            },
            lr_copy: {
                required: "Please upload LR copy",
                fileSize: "Image size must be less than 5MB"
            }
        },
        errorClass: 'is-invalid',
        validClass: 'is-valid',
        errorElement: 'div',
        errorPlacement: function(error, element) {
            error.addClass('text-danger').css('color', '#dc3545');
            if (element.attr('type') === 'file') {
                var errorContainer = element.closest('.mb-4').find('.error-message');
                if (errorContainer.length) {
                    errorContainer.html(error.text()).css('color', '#dc3545');
                } else {
                    error.insertAfter(element.next('small'));
                }
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function(element) {
            $(element).addClass('is-invalid').removeClass('is-valid');
            $(element).css('border-color', '#dc3545');
            if ($(element).closest('.upload-btn-custom').length) {
                $(element).closest('.upload-btn-custom').addClass('is-invalid');
            }
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid').addClass('is-valid');
            $(element).css('border-color', '');
            if ($(element).closest('.upload-btn-custom').length) {
                $(element).closest('.upload-btn-custom').removeClass('is-invalid');
            }
        },
        submitHandler: function(form) {
            // Validate pallet images count
            if (palletImageCount !== 4) {
                $('#pallet_images_error').text('Please upload exactly 4 images (' + palletImageCount + '/4 uploaded)').css('color', '#dc3545');
                $('.pallet-image-input').addClass('is-invalid').css('border-color', '#dc3545');
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Please upload exactly 4 pallet images',
                    confirmButtonColor: '#601d57'
                });
                return false;
            }
            
            // Validate damage photos count
            if (damagePhotos.length < minDamagePhotos || damagePhotos.length > maxDamagePhotos) {
                $('#damage_photos_error').text('Please upload between ' + minDamagePhotos + ' and ' + maxDamagePhotos + ' images (' + damagePhotos.length + ' uploaded)').css('color', '#dc3545');
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Please upload between ' + minDamagePhotos + ' and ' + maxDamagePhotos + ' damage photos',
                    confirmButtonColor: '#601d57'
                });
                return false;
            }
            
            submitFormAjax(form);
            return false;
        }
    });

    // Loader Functions (from Warehouse Management System)
    function showLoader() {
        if ($('.loader-overlay').length === 0) {
            $('body').append(`
                <div class="loader-overlay">
                    <div class="loader-spinner"></div>
                </div>
            `);
        }
    }

    function hideLoader() {
        $('.loader-overlay').remove();
    }

    // Pallet Images - 4 separate uploads
    var palletImageCount = 0;
    $('.pallet-image-input').on('change', function() {
        var $input = $(this);
        var $btn = $input.closest('.upload-btn-custom');
        var $preview = $btn.find('.preview-image');
        var file = this.files[0];
        
        if (file) {
            // Validate file
            var maxSize = 5 * 1024 * 1024; // 5MB
            var ext = file.name.split('.').pop().toLowerCase();
            
            if (!['jpg', 'jpeg', 'png'].includes(ext)) {
                $btn.removeClass('has-file');
                $preview.attr('src', '').hide();
                $btn.find('.file-name').text('Invalid format').addClass('text-danger');
                $input.val('');
                return;
            }
            
            if (file.size > maxSize) {
                $btn.removeClass('has-file');
                $preview.attr('src', '').hide();
                $btn.find('.file-name').text('File too large').addClass('text-danger');
                $input.val('');
                return;
            }
            
            // Show image preview
            var reader = new FileReader();
            reader.onload = function(e) {
                $preview.attr('src', e.target.result).show();
                $btn.addClass('has-file');
                $btn.find('.file-name').text(file.name).removeClass('text-danger');
                palletImageCount++;
                validatePalletImages();
            };
            reader.readAsDataURL(file);
        } else {
            $btn.removeClass('has-file');
            $preview.attr('src', '').hide();
            $btn.find('.file-name').text('');
            if (palletImageCount > 0) {
                palletImageCount--;
            }
            validatePalletImages();
        }
    });

    function validatePalletImages() {
        var $error = $('#pallet_images_error');
        if (palletImageCount < 4) {
            $error.text('Please upload exactly 4 images (' + palletImageCount + '/4 uploaded)');
            $('.pallet-image-input').addClass('is-invalid');
        } else {
            $error.text('');
            $('.pallet-image-input').removeClass('is-invalid').addClass('is-valid');
        }
    }

    // Damage Photos - Dynamic add/remove
    damagePhotos = [];
    var maxDamagePhotos = 10;
    var minDamagePhotos = 2;

    $('#addDamagePhotoBtn').on('click', function() {
        if (damagePhotos.length >= maxDamagePhotos) {
            Swal.fire({
                icon: 'warning',
                title: 'Limit Reached',
                text: 'Maximum ' + maxDamagePhotos + ' images allowed',
                confirmButtonColor: '#601d57'
            });
            return;
        }
        $('#damagePhotoInput').click();
    });

    $('#damagePhotoInput').on('change', function() {
        var files = Array.from(this.files);
        files.forEach(function(file) {
            if (damagePhotos.length >= maxDamagePhotos) return;
            
            var maxSize = 5 * 1024 * 1024; // 5MB
            var ext = file.name.split('.').pop().toLowerCase();
            
            if (!['jpg', 'jpeg', 'png'].includes(ext)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Format',
                    text: file.name + ' is not a valid image file',
                    confirmButtonColor: '#601d57'
                });
                return;
            }
            
            if (file.size > maxSize) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Too Large',
                    text: file.name + ' exceeds 5MB limit',
                    confirmButtonColor: '#601d57'
                });
                return;
            }
            
            var reader = new FileReader();
            reader.onload = function(e) {
                var photoId = 'damage_photo_' + Date.now() + '_' + Math.random();
                damagePhotos.push({
                    id: photoId,
                    file: file,
                    dataUrl: e.target.result
                });
                
                var $preview = $('<div class="image-preview-item">' +
                    '<img src="' + e.target.result + '" alt="Damage Photo">' +
                    '<button type="button" class="remove-btn" data-id="' + photoId + '">' +
                    '<i class="bi bi-x"></i>' +
                    '</button>' +
                    '</div>');
                
                $('#damagePhotosContainer').append($preview);
                updateDamagePhotosInput();
                validateDamagePhotos();
            };
            reader.readAsDataURL(file);
        });
        
        $(this).val('');
    });

    $(document).on('click', '.remove-btn', function() {
        var photoId = $(this).data('id');
        damagePhotos = damagePhotos.filter(function(photo) {
            return photo.id !== photoId;
        });
        $(this).closest('.image-preview-item').remove();
        updateDamagePhotosInput();
        validateDamagePhotos();
    });

    function updateDamagePhotosInput() {
        // Create a data transfer object to hold files
        var dt = new DataTransfer();
        damagePhotos.forEach(function(photo) {
            dt.items.add(photo.file);
        });
        
        // We'll handle this in form submission
    }

    function validateDamagePhotos() {
        var $error = $('#damage_photos_error');
        if (damagePhotos.length < minDamagePhotos) {
            $error.text('Please upload at least ' + minDamagePhotos + ' image(s) (' + damagePhotos.length + ' uploaded)');
            $('#damagePhotosContainer').addClass('border-danger');
        } else {
            $error.text('');
            $('#damagePhotosContainer').removeClass('border-danger');
        }
    }

    // AJAX Form Submission handled by global function
    @elseif($type === 'junction_box')
    // Custom validation methods
    $.validator.addMethod("phoneFormat", function(value, element) {
        return this.optional(element) || /^[0-9]{10,15}$/.test(value.replace(/[\s\-\(\)]/g, ''));
    }, "Please enter a valid phone number (10-15 digits)");

    $.validator.addMethod("fileSize", function(value, element, param) {
        if (this.optional(element)) {
            return true;
        }
        var maxSize = param * 1024 * 1024;
        if (element.files && element.files[0]) {
            return element.files[0].size <= maxSize;
        }
        return true;
    }, "File size must be less than {0}MB");

    $.validator.addMethod("videoFormat", function(value, element) {
        if (this.optional(element)) {
            return true;
        }
        if (element.files && element.files[0]) {
            var ext = element.files[0].name.split('.').pop().toLowerCase();
            return ['mp4', 'avi', 'mov', 'wmv'].includes(ext);
        }
        return true;
    }, "Please select a valid video file (MP4, AVI, MOV, WMV)");

    $.validator.addMethod("imageFormat", function(value, element) {
        if (this.optional(element)) {
            return true;
        }
        if (element.files && element.files[0]) {
            var ext = element.files[0].name.split('.').pop().toLowerCase();
            return ['jpg', 'jpeg', 'png'].includes(ext);
        }
        return true;
    }, "Please select a valid image file (JPG, PNG)");

    // Validation rules for Junction Box
    var validationRules = {
        name: {
            required: true,
            minlength: 2,
            maxlength: 255
        },
        phone: {
            required: true,
            phoneFormat: true
        },
        email: {
            required: true,
            email: true
        },
        city: {
            required: true,
            minlength: 2
        },
        delivery_date: {
            required: true,
            date: true
        },
        invoice_no: {
            required: true,
            minlength: 3
        },
        serial_number: {
            required: true,
            minlength: 3
        },
        voltage_video: {
            required: true,
            videoFormat: true,
            fileSize: 10
        },
        junction_box_photo: {
            required: true,
            imageFormat: true,
            fileSize: 5
        },
        voltage_power: {
            required: true,
            imageFormat: true,
            fileSize: 5
        },
        site_photograph: {
            required: true,
            imageFormat: true,
            fileSize: 5
        }
    };

    // Initialize validation
    var validator = $('#serviceForm').validate({
        rules: validationRules,
        messages: {
            name: {
                required: "Please enter your name or company name",
                minlength: "Name must be at least 2 characters"
            },
            phone: {
                required: "Please enter your phone number",
                phoneFormat: "Please enter a valid phone number"
            },
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address"
            },
            city: {
                required: "Please enter your city",
                minlength: "City name must be at least 2 characters"
            },
            delivery_date: {
                required: "Please select delivery date",
                date: "Please enter a valid date"
            },
            invoice_no: {
                required: "Please enter invoice number",
                minlength: "Invoice number must be at least 3 characters"
            },
            serial_number: {
                required: "Please enter serial number",
                minlength: "Serial number must be at least 3 characters"
            },
            voltage_video: {
                required: "Please upload voltage video",
                fileSize: "Video size must be less than 10MB"
            },
            junction_box_photo: {
                required: "Please upload junction box photo",
                fileSize: "Image size must be less than 5MB"
            },
            voltage_power: {
                required: "Please upload voltage power image",
                fileSize: "Image size must be less than 5MB"
            },
            site_photograph: {
                required: "Please upload site photograph",
                fileSize: "Image size must be less than 5MB"
            }
        },
        errorClass: 'is-invalid',
        validClass: 'is-valid',
        errorElement: 'div',
        errorPlacement: function(error, element) {
            error.addClass('text-danger').css('color', '#dc3545');
            if (element.attr('type') === 'file') {
                var errorContainer = element.closest('.mb-4').find('.error-message');
                if (errorContainer.length) {
                    errorContainer.html(error.text()).css('color', '#dc3545');
                } else {
                    error.insertAfter(element.next('small'));
                }
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function(element) {
            $(element).addClass('is-invalid').removeClass('is-valid');
            $(element).css('border-color', '#dc3545');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid').addClass('is-valid');
            $(element).css('border-color', '');
        },
        submitHandler: function(form) {
            submitFormAjax(form);
            return false;
        }
    });

    // AJAX Form Submission handled by global function

    // Loader Functions
    function showLoader() {
        if ($('.loader-overlay').length === 0) {
            $('body').append(`
                <div class="loader-overlay">
                    <div class="loader-spinner"></div>
                </div>
            `);
        }
    }

    function hideLoader() {
        $('.loader-overlay').remove();
    }

    @elseif($type === 'hotspot')
    // Custom validation methods
    $.validator.addMethod("phoneFormat", function(value, element) {
        return this.optional(element) || /^[0-9]{10,15}$/.test(value.replace(/[\s\-\(\)]/g, ''));
    }, "Please enter a valid phone number (10-15 digits)");

    $.validator.addMethod("fileSize", function(value, element, param) {
        if (this.optional(element)) {
            return true;
        }
        var maxSize = param * 1024 * 1024;
        if (element.files && element.files[0]) {
            return element.files[0].size <= maxSize;
        }
        return true;
    }, "File size must be less than {0}MB");

    $.validator.addMethod("videoFormat", function(value, element) {
        if (this.optional(element)) {
            return true;
        }
        if (element.files && element.files[0]) {
            var ext = element.files[0].name.split('.').pop().toLowerCase();
            return ['mp4', 'avi', 'mov', 'wmv'].includes(ext);
        }
        return true;
    }, "Please select a valid video file (MP4, AVI, MOV, WMV)");

    $.validator.addMethod("imageFormat", function(value, element) {
        if (this.optional(element)) {
            return true;
        }
        if (element.files && element.files[0]) {
            var ext = element.files[0].name.split('.').pop().toLowerCase();
            return ['jpg', 'jpeg', 'png'].includes(ext);
        }
        return true;
    }, "Please select a valid image file (JPG, PNG)");

    // Validation rules for Hotspot
    var validationRules = {
        name: {
            required: true,
            minlength: 2,
            maxlength: 255
        },
        phone: {
            required: true,
            phoneFormat: true
        },
        email: {
            required: true,
            email: true
        },
        city: {
            required: true,
            minlength: 2
        },
        delivery_date: {
            required: true,
            date: true
        },
        invoice_no: {
            required: true,
            minlength: 3
        },
        serial_number: {
            required: true,
            minlength: 3
        },
        loading_video: {
            required: true,
            videoFormat: true,
            fileSize: 10
        },
        pallet_id_slip: {
            required: true,
            imageFormat: true,
            fileSize: 5
        },
        installation_site: {
            required: true,
            imageFormat: true,
            fileSize: 5
        }
    };

    // Initialize validation
    var validator = $('#serviceForm').validate({
        rules: validationRules,
        messages: {
            name: {
                required: "Please enter your name or company name",
                minlength: "Name must be at least 2 characters"
            },
            phone: {
                required: "Please enter your phone number",
                phoneFormat: "Please enter a valid phone number"
            },
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address"
            },
            city: {
                required: "Please enter your city",
                minlength: "City name must be at least 2 characters"
            },
            delivery_date: {
                required: "Please select delivery date",
                date: "Please enter a valid date"
            },
            invoice_no: {
                required: "Please enter invoice number",
                minlength: "Invoice number must be at least 3 characters"
            },
            serial_number: {
                required: "Please enter serial number",
                minlength: "Serial number must be at least 3 characters"
            },
            loading_video: {
                required: "Please upload loading video",
                fileSize: "Video size must be less than 10MB"
            },
            pallet_id_slip: {
                required: "Please upload pallet ID slip",
                fileSize: "Image size must be less than 5MB"
            },
            installation_site: {
                required: "Please upload installation site photograph",
                fileSize: "Image size must be less than 5MB"
            }
        },
        errorClass: 'is-invalid',
        validClass: 'is-valid',
        errorElement: 'div',
        errorPlacement: function(error, element) {
            error.addClass('text-danger').css('color', '#dc3545');
            if (element.attr('type') === 'file') {
                var errorContainer = element.closest('.mb-4').find('.error-message');
                if (errorContainer.length) {
                    errorContainer.html(error.text()).css('color', '#dc3545');
                } else {
                    error.insertAfter(element.next('small'));
                }
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function(element) {
            $(element).addClass('is-invalid').removeClass('is-valid');
            $(element).css('border-color', '#dc3545');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid').addClass('is-valid');
            $(element).css('border-color', '');
        },
        submitHandler: function(form) {
            // Validate damage photos count
            if (damagePhotosHotspot.length < minDamagePhotosHotspot || damagePhotosHotspot.length > maxDamagePhotosHotspot) {
                $('#damage_photos_hotspot_error').text('Please upload between ' + minDamagePhotosHotspot + ' and ' + maxDamagePhotosHotspot + ' images (' + damagePhotosHotspot.length + ' uploaded)').css('color', '#dc3545');
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Please upload between ' + minDamagePhotosHotspot + ' and ' + maxDamagePhotosHotspot + ' damage photos',
                    confirmButtonColor: '#601d57'
                });
                return false;
            }
            
            // Validate issue photos count
            if (issuePhotos.length < minIssuePhotos || issuePhotos.length > maxIssuePhotos) {
                $('#issue_photos_error').text('Please upload between ' + minIssuePhotos + ' and ' + maxIssuePhotos + ' images (' + issuePhotos.length + ' uploaded)').css('color', '#dc3545');
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Please upload between ' + minIssuePhotos + ' and ' + maxIssuePhotos + ' issue photos',
                    confirmButtonColor: '#601d57'
                });
                return false;
            }
            
            submitFormAjax(form);
            return false;
        }
    });

    // AJAX Form Submission handled by global function

    // Loader Functions
    function showLoader() {
        if ($('.loader-overlay').length === 0) {
            $('body').append(`
                <div class="loader-overlay">
                    <div class="loader-spinner"></div>
                </div>
            `);
        }
    }

    function hideLoader() {
        $('.loader-overlay').remove();
    }

    // Damage Photos Hotspot - Dynamic add/remove
    damagePhotosHotspot = [];
    var maxDamagePhotosHotspot = 10;
    var minDamagePhotosHotspot = 2;

    $('#addDamagePhotoHotspotBtn').on('click', function() {
        if (damagePhotosHotspot.length >= maxDamagePhotosHotspot) {
            Swal.fire({
                icon: 'warning',
                title: 'Limit Reached',
                text: 'Maximum ' + maxDamagePhotosHotspot + ' images allowed',
                confirmButtonColor: '#601d57'
            });
            return;
        }
        $('#damagePhotoHotspotInput').click();
    });

    $('#damagePhotoHotspotInput').on('change', function() {
        var files = Array.from(this.files);
        files.forEach(function(file) {
            if (damagePhotosHotspot.length >= maxDamagePhotosHotspot) return;
            
            var maxSize = 5 * 1024 * 1024;
            var ext = file.name.split('.').pop().toLowerCase();
            
            if (!['jpg', 'jpeg', 'png'].includes(ext)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Format',
                    text: file.name + ' is not a valid image file',
                    confirmButtonColor: '#601d57'
                });
                return;
            }
            
            if (file.size > maxSize) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Too Large',
                    text: file.name + ' exceeds 5MB limit',
                    confirmButtonColor: '#601d57'
                });
                return;
            }
            
            var reader = new FileReader();
            reader.onload = function(e) {
                var photoId = 'damage_photo_hotspot_' + Date.now() + '_' + Math.random();
                damagePhotosHotspot.push({
                    id: photoId,
                    file: file,
                    dataUrl: e.target.result
                });
                
                var $preview = $('<div class="image-preview-item">' +
                    '<img src="' + e.target.result + '" alt="Damage Photo">' +
                    '<button type="button" class="remove-btn" data-id="' + photoId + '">' +
                    '<i class="bi bi-x"></i>' +
                    '</button>' +
                    '</div>');
                
                $('#damagePhotosHotspotContainer').append($preview);
                validateDamagePhotosHotspot();
            };
            reader.readAsDataURL(file);
        });
        
        $(this).val('');
    });

    $(document).on('click', '.remove-btn', function() {
        var photoId = $(this).data('id');
        if (photoId && photoId.startsWith('damage_photo_hotspot_')) {
            damagePhotosHotspot = damagePhotosHotspot.filter(function(photo) {
                return photo.id !== photoId;
            });
            $(this).closest('.image-preview-item').remove();
            validateDamagePhotosHotspot();
        } else if (photoId && photoId.startsWith('issue_photo_')) {
            issuePhotos = issuePhotos.filter(function(photo) {
                return photo.id !== photoId;
            });
            $(this).closest('.image-preview-item').remove();
            validateIssuePhotos();
        }
    });

    function validateDamagePhotosHotspot() {
        var $error = $('#damage_photos_hotspot_error');
        if (damagePhotosHotspot.length < minDamagePhotosHotspot) {
            $error.text('Please upload at least ' + minDamagePhotosHotspot + ' image(s) (' + damagePhotosHotspot.length + ' uploaded)').css('color', '#dc3545');
            $('#damagePhotosHotspotContainer').addClass('border-danger');
        } else {
            $error.text('');
            $('#damagePhotosHotspotContainer').removeClass('border-danger');
        }
    }

    // Issue Photos - Dynamic add/remove
    issuePhotos = [];
    var maxIssuePhotos = 10;
    var minIssuePhotos = 2;

    $('#addIssuePhotoBtn').on('click', function() {
        if (issuePhotos.length >= maxIssuePhotos) {
            Swal.fire({
                icon: 'warning',
                title: 'Limit Reached',
                text: 'Maximum ' + maxIssuePhotos + ' images allowed',
                confirmButtonColor: '#601d57'
            });
            return;
        }
        $('#issuePhotoInput').click();
    });

    $('#issuePhotoInput').on('change', function() {
        var files = Array.from(this.files);
        files.forEach(function(file) {
            if (issuePhotos.length >= maxIssuePhotos) return;
            
            var maxSize = 5 * 1024 * 1024;
            var ext = file.name.split('.').pop().toLowerCase();
            
            if (!['jpg', 'jpeg', 'png'].includes(ext)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Format',
                    text: file.name + ' is not a valid image file',
                    confirmButtonColor: '#601d57'
                });
                return;
            }
            
            if (file.size > maxSize) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Too Large',
                    text: file.name + ' exceeds 5MB limit',
                    confirmButtonColor: '#601d57'
                });
                return;
            }
            
            var reader = new FileReader();
            reader.onload = function(e) {
                var photoId = 'issue_photo_' + Date.now() + '_' + Math.random();
                issuePhotos.push({
                    id: photoId,
                    file: file,
                    dataUrl: e.target.result
                });
                
                var $preview = $('<div class="image-preview-item">' +
                    '<img src="' + e.target.result + '" alt="Issue Photo">' +
                    '<button type="button" class="remove-btn" data-id="' + photoId + '">' +
                    '<i class="bi bi-x"></i>' +
                    '</button>' +
                    '</div>');
                
                $('#issuePhotosContainer').append($preview);
                validateIssuePhotos();
            };
            reader.readAsDataURL(file);
        });
        
        $(this).val('');
    });

    function validateIssuePhotos() {
        var $error = $('#issue_photos_error');
        if (issuePhotos.length < minIssuePhotos) {
            $error.text('Please upload at least ' + minIssuePhotos + ' image(s) (' + issuePhotos.length + ' uploaded)').css('color', '#dc3545');
            $('#issuePhotosContainer').addClass('border-danger');
        } else {
            $error.text('');
            $('#issuePhotosContainer').removeClass('border-danger');
        }
    }
    @endif

    // Chunk Upload Implementation
    const CHUNK_SIZE = 1024 * 1024; // 1MB

    function uuidv4() {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    }

    function uploadFileInChunks(file, progressCallback, successCallback, errorCallback) {
        const totalChunks = Math.ceil(file.size / CHUNK_SIZE);
        const fileUuid = uuidv4();
        let chunkIndex = 0;

        function uploadNextChunk() {
            const start = chunkIndex * CHUNK_SIZE;
            const end = Math.min(start + CHUNK_SIZE, file.size);
            const chunk = file.slice(start, end);

            const formData = new FormData();
            formData.append('file', chunk);
            formData.append('chunk_index', chunkIndex);
            formData.append('total_chunks', totalChunks);
            formData.append('file_uuid', fileUuid);
            formData.append('file_name', file.name);
            
            $.ajax({
                url: "{{ route('upload.chunk') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        chunkIndex++;
                        const progress = Math.round((chunkIndex / totalChunks) * 100);
                        progressCallback(progress);

                        if (chunkIndex < totalChunks) {
                            uploadNextChunk();
                        } else {
                            successCallback(response.data);
                        }
                    } else {
                        errorCallback(response.message);
                    }
                },
                error: function(xhr) {
                    errorCallback(xhr.responseJSON?.message || 'Upload failed');
                }
            });
        }

        uploadNextChunk();
    }

    function handleChunkUpload(inputId, hiddenInputId, progressId, type = 'video') {
        if ($(inputId).length === 0) return; // Skip if input doesn't exist

        $(inputId).on('change', function() {
            const file = this.files[0];
            if (!file) return;

            // File size validation
            const maxSize = (type === 'video' ? 10 : 10) * 1024 * 1024; // 10MB for both (can be adjusted)
            if (file.size > maxSize) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Too Large',
                    text: (type === 'video' ? 'Video' : 'Image') + ' file size must be less than 10MB',
                    confirmButtonColor: '#601d57'
                });
                $(this).val(''); // Clear the input
                $(hiddenInputId).val(''); // Clear hidden path
                $(progressId).hide(); // Hide progress bar
                return;
            }

            const $progressBar = $(progressId).find('.progress-bar');
            $(progressId).show();
            $('#submitBtn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Uploading ' + (type === 'video' ? 'Video' : 'Image') + '...');
            
            // Clear previous hidden input
            $(hiddenInputId).val('');
            $progressBar.removeClass('bg-success bg-danger').addClass('bg-info').css('width', '0%').text('0%');

            uploadFileInChunks(
                file,
                function(progress) {
                    $progressBar.css('width', progress + '%').text(progress + '%');
                },
                function(data) {
                    $(hiddenInputId).val(data.path);
                    $progressBar.removeClass('bg-info').addClass('bg-success').text('Upload Complete');
                    $('#submitBtn').prop('disabled', false).html('<i class="bi bi-send me-2"></i>Submit Request');
                    
                    console.log((type === 'video' ? 'Video' : 'Image') + ' uploaded successfully:', data.path);
                },
                function(error) {
                    $progressBar.removeClass('bg-info').addClass('bg-danger').text('Error: ' + error);
                    $('#submitBtn').prop('disabled', false).html('<i class="bi bi-send me-2"></i>Submit Request');
                    Swal.fire({
                        icon: 'error',
                        title: 'Upload Failed',
                        text: error
                    });
                }
            );
        });
    }

    // Initialize listeners
    // Videos
    handleChunkUpload('#loading_video', '#loading_video_path', '#loading_video_progress', 'video');
    handleChunkUpload('#voltage_video', '#voltage_video_path', '#voltage_video_progress', 'video');
    handleChunkUpload('#loading_video_hotspot', '#loading_video_hotspot_path', '#loading_video_hotspot_progress', 'video');

    // Images (Panel Damage)
    handleChunkUpload('#pallet_id_slip', '#pallet_id_slip_path', '#pallet_id_slip_progress', 'image');
    handleChunkUpload('#lr_copy', '#lr_copy_path', '#lr_copy_progress', 'image');
    handleChunkUpload('#pallet_position', '#pallet_position_path', '#pallet_position_progress', 'image');

    // Images (Junction Box)
    handleChunkUpload('#junction_box_photo', '#junction_box_photo_path', '#junction_box_photo_progress', 'image');
    handleChunkUpload('#voltage_power', '#voltage_power_path', '#voltage_power_progress', 'image');
    handleChunkUpload('#site_photograph', '#site_photograph_path', '#site_photograph_progress', 'image');

    // Images (Hotspot)
    handleChunkUpload('#pallet_id_slip_hotspot', '#pallet_id_slip_hotspot_path', '#pallet_id_slip_hotspot_progress', 'image');
    handleChunkUpload('#installation_site', '#installation_site_path', '#installation_site_progress', 'image');

});
</script>
@endpush

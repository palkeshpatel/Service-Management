@extends('layouts.admin')

@section('title', 'Service Request Details - Admin')

@push('styles')
<style>
    .detail-card {
        background: white;
        border-radius: 8px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .attachment-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 15px;
        margin-top: 15px;
    }
    .attachment-item {
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 10px;
        text-align: center;
        transition: all 0.3s;
    }
    .attachment-item:hover {
        border-color: var(--primary-color);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .attachment-preview {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 5px;
        margin-bottom: 10px;
    }
    .video-preview {
        width: 100%;
        height: 150px;
        background: #f0f0f0;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
    }
    .info-label {
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 5px;
    }
    .info-value {
        margin-bottom: 15px;
    }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <a href="{{ route('admin.requests.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Inbox
        </a>
    </div>
    <div>
        <span class="status-badge status-{{ $request->status }} me-2">{{ ucfirst(str_replace('_', ' ', $request->status)) }}</span>
    </div>
</div>

<!-- Basic Information -->
<div class="detail-card">
    <h4 class="mb-4 text-primary"><i class="bi bi-person me-2"></i>Basic Information</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="info-label">Name/Company Name</div>
            <div class="info-value">{{ $request->name }}</div>
        </div>
        <div class="col-md-6">
            <div class="info-label">Phone Number</div>
            <div class="info-value">
                <a href="tel:{{ $request->phone }}">{{ $request->phone }}</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="info-label">Email</div>
            <div class="info-value">
                <a href="mailto:{{ $request->email }}">{{ $request->email }}</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="info-label">City</div>
            <div class="info-value">{{ $request->city }}</div>
        </div>
        <div class="col-md-6">
            <div class="info-label">Delivery Date</div>
            <div class="info-value">{{ $request->delivery_date->format('d/m/Y') }}</div>
        </div>
        <div class="col-md-6">
            <div class="info-label">Invoice No</div>
            <div class="info-value">{{ $request->invoice_no }}</div>
        </div>
        <div class="col-md-12">
            <div class="info-label">Serial Number</div>
            <div class="info-value">{{ $request->serial_number }}</div>
        </div>
        <div class="col-md-6">
            <div class="info-label">Service Type</div>
            <div class="info-value">{{ $request->service_type_label }}</div>
        </div>
        <div class="col-md-6">
            <div class="info-label">Submitted On</div>
            <div class="info-value">{{ $request->created_at->format('d/m/Y h:i A') }}</div>
        </div>
    </div>
</div>

<!-- Attachments -->
@if($request->attachments && count($request->attachments) > 0)
<div class="detail-card">
    <h4 class="mb-4 text-primary"><i class="bi bi-paperclip me-2"></i>Attachments</h4>
    <div class="attachment-grid">
        @foreach($request->attachments as $field => $attachment)
            @php
                $isArray = isset($attachment[0]) && is_array($attachment[0]);
                $items = $isArray ? $attachment : [$attachment];
            @endphp
            
            @foreach($items as $item)
                @if(isset($item['type']) && $item['type'] === 'video')
                    <div class="attachment-item">
                        <div class="video-preview">
                            <i class="bi bi-play-circle" style="font-size: 3rem; color: var(--primary-color);"></i>
                        </div>
                        <div class="small fw-bold mb-1">{{ ucfirst(str_replace('_', ' ', $field)) }}</div>
                        <div class="small text-muted mb-2">{{ $item['original_name'] ?? 'Video' }}</div>
                        <a href="{{ asset('storage/' . $item['path']) }}" target="_blank" class="btn btn-sm btn-primary">
                            <i class="bi bi-download me-1"></i>Download
                        </a>
                    </div>
                @else
                    <div class="attachment-item">
                        <img src="{{ asset('storage/' . $item['path']) }}" alt="{{ $field }}" class="attachment-preview" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'200\' height=\'150\'%3E%3Crect fill=\'%23ddd\' width=\'200\' height=\'150\'/%3E%3Ctext fill=\'%23999\' font-family=\'sans-serif\' font-size=\'14\' dy=\'10.5\' font-weight=\'bold\' x=\'50%25\' y=\'50%25\' text-anchor=\'middle\'%3EImage%3C/text%3E%3C/svg%3E'">
                        <div class="small fw-bold mb-1">{{ ucfirst(str_replace('_', ' ', $field)) }}</div>
                        <div class="small text-muted mb-2">{{ $item['original_name'] ?? 'Image' }}</div>
                        <a href="{{ asset('storage/' . $item['path']) }}" target="_blank" class="btn btn-sm btn-primary">
                            <i class="bi bi-download me-1"></i>Download
                        </a>
                    </div>
                @endif
            @endforeach
        @endforeach
    </div>
</div>
@endif

<!-- Admin Actions -->
<div class="detail-card">
    <h4 class="mb-4 text-primary"><i class="bi bi-gear me-2"></i>Update Status</h4>
    <form action="{{ route('admin.requests.update', $request->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="pending" {{ $request->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ $request->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="resolved" {{ $request->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                    <option value="closed" {{ $request->status === 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Admin Notes</label>
            <textarea name="admin_notes" class="form-control" rows="4" placeholder="Add notes about this request...">{{ $request->admin_notes }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-2"></i>Update Request
        </button>
    </form>
</div>
@endsection

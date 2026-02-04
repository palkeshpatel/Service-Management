@extends('layouts.admin')

@section('title', 'Service Requests - Admin')

@push('styles')
<style>
    .inbox-header {
        background: white;
        padding: 25px;
        border-radius: 10px;
        margin-bottom: 25px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        border-left: 4px solid var(--primary-color);
    }
    .inbox-header h2 {
        color: var(--text-color);
        font-weight: 600;
        margin-bottom: 5px;
    }
    .request-card {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        cursor: pointer;
    }
    .request-card:hover {
        box-shadow: 0 4px 12px rgba(96, 29, 87, 0.15);
        transform: translateY(-2px);
        border-color: var(--primary-color);
    }
    .request-card.unread {
        border-left: 4px solid var(--primary-color);
        background: rgba(96, 29, 87, 0.02);
    }
    .status-badge {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
    }
    .status-pending { background: #ffc107; color: #000; }
    .status-in_progress { background: #0dcaf0; color: #000; }
    .status-resolved { background: #198754; color: #fff; }
    .status-closed { background: #6c757d; color: #fff; }
    .request-name {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-color);
        margin-bottom: 8px;
    }
    .request-info {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 5px;
    }
    .request-info i {
        color: var(--primary-color);
        width: 18px;
    }
    .request-details {
        background: var(--bg-color);
        padding: 12px;
        border-radius: 6px;
        margin-top: 12px;
        font-size: 0.85rem;
    }
    .request-id {
        font-size: 0.8rem;
        color: var(--primary-color);
        font-weight: 600;
        margin-bottom: 4px;
    }
    .request-details strong {
        color: var(--primary-color);
    }
    .chevron-icon {
        color: var(--primary-color);
        font-size: 1.2rem;
    }
</style>
@endpush

@section('content')
<div class="inbox-header">
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <h2><i class="bi bi-inbox me-2"></i>Service Requests Inbox</h2>
            <p class="text-muted mb-0">Total: {{ $requests->total() }} requests
                @if(request()->has('service_type'))
                    <span class="badge bg-primary ms-2">{{ ucfirst(str_replace('_', ' ', request()->service_type)) }}</span>
                @endif
            </p>
        </div>
        <div>
            <form method="GET" action="{{ route('admin.requests.index') }}" class="d-inline">
                @if(request()->has('service_type'))
                    <input type="hidden" name="service_type" value="{{ request()->service_type }}">
                @endif
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()" style="min-width: 150px;">
                    <option value="">All Status</option>
                    <option value="pending" {{ request()->get('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ request()->get('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="resolved" {{ request()->get('status') === 'resolved' ? 'selected' : '' }}>Resolved</option>
                    <option value="closed" {{ request()->get('status') === 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        @forelse($requests as $request)
            <a href="{{ route('admin.requests.show', $request->id) }}" class="text-decoration-none">
                <div class="request-card {{ $request->status === 'pending' ? 'unread' : '' }}">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div>
                                    <div class="request-id">{{ $request->request_id }}</div>
                                    <div class="request-name">{{ $request->name }}</div>
                                </div>
                                <span class="status-badge status-{{ $request->status }}">
                                    {{ ucfirst(str_replace('_', ' ', $request->status)) }}
                                </span>
                            </div>
                            
                            <div class="request-info">
                                <i class="bi bi-envelope me-2"></i>{{ $request->email }}
                            </div>
                            <div class="request-info">
                                <i class="bi bi-telephone me-2"></i>{{ $request->phone }}
                            </div>
                            
                            <div class="request-details">
                                <div class="mb-2">
                                    <strong>Service Type:</strong> {{ $request->service_type_label }}
                                </div>
                                <div class="mb-2">
                                    <strong>City:</strong> {{ $request->city }} | 
                                    <strong>Invoice No:</strong> {{ $request->invoice_no }} | 
                                    <strong>Serial:</strong> {{ $request->serial_number }}
                                </div>
                                <div>
                                    <i class="bi bi-calendar me-1"></i>{{ $request->created_at->format('M d, Y h:i A') }}
                                </div>
                            </div>
                        </div>
                        <div class="ms-3 d-flex align-items-center">
                            <i class="bi bi-chevron-right chevron-icon"></i>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="card text-center py-5">
                <div class="card-body">
                    <i class="bi bi-inbox" style="font-size: 4rem; color: #ccc;"></i>
                    <p class="text-muted mt-3 mb-0">No service requests found</p>
                </div>
            </div>
        @endforelse

        @if($requests->hasPages())
            <div class="mt-4">
                {{ $requests->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

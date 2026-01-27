@extends('layouts.admin')

@section('title', 'Service Requests - Admin')

@push('styles')
<style>
    .inbox-header {
        background: white;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }
    .status-pending { background: #ffc107; color: #000; }
    .status-in_progress { background: #0dcaf0; color: #000; }
    .status-resolved { background: #198754; color: #fff; }
    .status-closed { background: #6c757d; color: #fff; }
</style>
@endpush

@section('content')
<div class="inbox-header">
    <h2 class="mb-0"><i class="bi bi-inbox me-2"></i>Service Requests Inbox</h2>
    <p class="text-muted mb-0">Total: {{ $requests->total() }} requests</p>
</div>

<div class="row">
    <div class="col-12">
        @forelse($requests as $request)
            <a href="{{ route('admin.requests.show', $request->id) }}" class="text-decoration-none text-dark">
                <div class="inbox-item {{ $request->status === 'pending' ? 'unread' : '' }}">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center mb-2">
                                <h5 class="mb-0 me-3">{{ $request->name }}</h5>
                                <span class="status-badge status-{{ $request->status }}">{{ ucfirst(str_replace('_', ' ', $request->status)) }}</span>
                            </div>
                            <p class="mb-1 text-muted">
                                <i class="bi bi-envelope me-2"></i>{{ $request->email }}
                                <span class="ms-3"><i class="bi bi-telephone me-2"></i>{{ $request->phone }}</span>
                            </p>
                            <p class="mb-1">
                                <strong>Service Type:</strong> {{ $request->service_type_label }}
                            </p>
                            <p class="mb-1">
                                <strong>City:</strong> {{ $request->city }} | 
                                <strong>Invoice No:</strong> {{ $request->invoice_no }} |
                                <strong>Serial:</strong> {{ $request->serial_number }}
                            </p>
                            <small class="text-muted">
                                <i class="bi bi-calendar me-1"></i>{{ $request->created_at->format('M d, Y h:i A') }}
                            </small>
                        </div>
                        <div>
                            <i class="bi bi-chevron-right text-primary"></i>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size: 4rem; color: #ccc;"></i>
                <p class="text-muted mt-3">No service requests found</p>
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

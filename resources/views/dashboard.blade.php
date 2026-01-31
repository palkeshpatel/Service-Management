@extends('layouts.admin')

@section('title', 'Dashboard - Service Management')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-speedometer2 me-2"></i>Dashboard</h5>
                </div>
                <div class="card-body">
                    <h3 class="mb-4">Welcome to Service Management System</h3>
                    <p class="mb-4">You're logged in! Access the admin panel to view service requests.</p>
                    <a href="{{ route('admin.requests.index') }}" class="btn btn-primary">
                        <i class="bi bi-inbox me-2"></i>Go to Service Requests
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

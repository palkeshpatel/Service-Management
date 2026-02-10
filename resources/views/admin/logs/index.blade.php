@extends('layouts.admin')

@section('title', 'Error Logs - Service Management')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Error Logs</h2>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Action</th>
                            <th>Message</th>
                            <th>Time</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                            <tr>
                                <td>{{ $log->id }}</td>
                                <td>{{ $log->action }}</td>
                                <td>{{ Str::limit($log->message, 50) }}</td>
                                <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#logModal{{ $log->id }}">
                                        View
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="logModal{{ $log->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Log Details #{{ $log->id }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Action:</strong> {{ $log->action }}</p>
                                                    <p><strong>Message:</strong> {{ $log->message }}</p>
                                                    <p><strong>Time:</strong> {{ $log->created_at }}</p>
                                                    <p><strong>IP:</strong> {{ $log->ip_address }}</p>
                                                    <p><strong>User Agent:</strong> {{ $log->user_agent }}</p>
                                                    <hr>
                                                    <h6>Stack Trace:</h6>
                                                    <pre style="background: #f8f9fa; padding: 10px; max-height: 300px; overflow: auto;">{{ $log->stack_trace }}</pre>
                                                    @if($log->payload)
                                                        <hr>
                                                        <h6>Payload:</h6>
                                                        <pre style="background: #f8f9fa; padding: 10px; max-height: 200px; overflow: auto;">{{ $log->payload }}</pre>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No error logs found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

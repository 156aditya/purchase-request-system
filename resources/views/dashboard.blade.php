@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h4 class="mb-1 fw-bold">
            <i class="bi bi-speedometer2 me-2 text-primary"></i>Dashboard
        </h4>
        <small class="text-muted">Welcome back, {{ Auth::user()->name }}</small>
    </div>
    <a href="{{ route('purchase-requests.create') }}" class="btn btn-primary px-4">
        <i class="bi bi-plus-lg me-1"></i>New Request
    </a>
</div>

<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card">
            <div class="card-body text-center p-4">
                <div class="display-5 fw-bold text-primary mb-1">{{ $stats['total'] }}</div>
                <div class="text-muted"><i class="bi bi-collection me-1"></i>Total Requests</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card">
            <div class="card-body text-center p-4">
                <div class="display-5 fw-bold text-warning mb-1">{{ $stats['pending'] }}</div>
                <div class="text-muted"><i class="bi bi-clock me-1"></i>Pending</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card">
            <div class="card-body text-center p-4">
                <div class="display-5 fw-bold text-success mb-1">{{ $stats['approved'] }}</div>
                <div class="text-muted"><i class="bi bi-check-circle me-1"></i>Approved</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card">
            <div class="card-body text-center p-4">
                <div class="display-5 fw-bold text-danger mb-1">{{ $stats['rejected'] }}</div>
                <div class="text-muted"><i class="bi bi-x-circle me-1"></i>Rejected</div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 fw-bold"><i class="bi bi-clock-history me-2"></i>Recent Requests</h6>
        <a href="{{ route('purchase-requests.index') }}"
           class="btn btn-sm btn-outline-primary">View All</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>PR Number</th>
                        <th>Title</th>
                        <th>Requested By</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recent as $pr)
                    <tr>
                        <td><strong>{{ $pr->pr_no }}</strong></td>
                        <td>{{ Str::limit($pr->title, 45) }}</td>
                        <td>{{ $pr->user->name ?? 'N/A' }}</td>
                        <td>
                            <span class="badge badge-{{ strtolower($pr->status) }}">
                                {{ $pr->status }}
                            </span>
                        </td>
                        <td>{{ $pr->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('purchase-requests.show', $pr->id) }}"
                               class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            No requests yet.
                            <a href="{{ route('purchase-requests.create') }}">Create one now</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@extends('layouts.app')
@section('title', 'View Purchase Request')
@section('content')

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h4 class="mb-1 fw-bold">
            <i class="bi bi-eye me-2 text-info"></i>Purchase Request Details
        </h4>
        <small class="text-muted">{{ $purchaseRequest->pr_no }}</small>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('purchase-requests.edit', $purchaseRequest->id) }}"
           class="btn btn-warning">
            <i class="bi bi-pencil me-1"></i>Edit
        </a>
        <form action="{{ route('purchase-requests.destroy', $purchaseRequest->id) }}"
              method="POST"
              onsubmit="return confirm('Are you sure you want to delete this request?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="bi bi-trash me-1"></i>Delete
            </button>
        </form>
        <a href="{{ route('purchase-requests.index') }}"
           class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Back
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold">
                    <i class="bi bi-info-circle me-2"></i>Request Information
                </h6>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-semibold">PR Number</label>
                        <div class="fw-bold fs-5 mt-1">{{ $purchaseRequest->pr_no }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-semibold">Status</label>
                        <div class="mt-1">
                            <span class="badge badge-{{ strtolower($purchaseRequest->status) }}
                                         px-3 py-2 fs-6">
                                {{ $purchaseRequest->status }}
                            </span>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="text-muted small text-uppercase fw-semibold">Title</label>
                        <div class="fw-semibold mt-1 fs-5">{{ $purchaseRequest->title }}</div>
                    </div>
                    <div class="col-12">
                        <label class="text-muted small text-uppercase fw-semibold">Description</label>
                        <div class="mt-1 p-3 bg-light rounded"
                             style="white-space: pre-wrap;">{{ $purchaseRequest->description }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="bi bi-person me-2"></i>Request Details</h6>
            </div>
            <div class="card-body p-4">
                <div class="mb-4">
                    <label class="text-muted small text-uppercase fw-semibold">Requested By</label>
                    <div class="fw-semibold mt-1">{{ $purchaseRequest->user->name ?? 'N/A' }}</div>
                    <div class="text-muted small">{{ $purchaseRequest->user->email ?? '' }}</div>
                </div>
                <div class="mb-4">
                    <label class="text-muted small text-uppercase fw-semibold">Created</label>
                    <div class="mt-1">{{ $purchaseRequest->created_at->format('d M Y') }}</div>
                    <div class="text-muted small">{{ $purchaseRequest->created_at->format('h:i A') }}</div>
                </div>
                <div>
                    <label class="text-muted small text-uppercase fw-semibold">Last Updated</label>
                    <div class="mt-1">{{ $purchaseRequest->updated_at->format('d M Y') }}</div>
                    <div class="text-muted small">{{ $purchaseRequest->updated_at->format('h:i A') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
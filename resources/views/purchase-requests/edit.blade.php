@extends('layouts.app')
@section('title', 'Edit Purchase Request')
@section('content')

<div class="page-header">
    <h4 class="mb-1 fw-bold">
        <i class="bi bi-pencil me-2 text-warning"></i>Edit Purchase Request
    </h4>
    <small class="text-muted">Editing: <strong>{{ $purchaseRequest->pr_no }}</strong></small>
</div>

<div class="card shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('purchase-requests.update', $purchaseRequest->id) }}"
              method="POST">
            @csrf
            @method('PUT')
            <div class="row g-4">
                <div class="col-md-6">
                    <label for="pr_no" class="form-label fw-semibold">
                        PR Number <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           class="form-control @error('pr_no') is-invalid @enderror"
                           id="pr_no"
                           name="pr_no"
                           value="{{ old('pr_no', $purchaseRequest->pr_no) }}">
                    @error('pr_no')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="status" class="form-label fw-semibold">
                        Status <span class="text-danger">*</span>
                    </label>
                    <select class="form-select @error('status') is-invalid @enderror"
                            id="status" name="status">
                        <option value="Pending"
                            {{ old('status',$purchaseRequest->status)=='Pending'
                               ? 'selected':'' }}>Pending</option>
                        <option value="Approved"
                            {{ old('status',$purchaseRequest->status)=='Approved'
                               ? 'selected':'' }}>Approved</option>
                        <option value="Rejected"
                            {{ old('status',$purchaseRequest->status)=='Rejected'
                               ? 'selected':'' }}>Rejected</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="title" class="form-label fw-semibold">
                        Title <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           class="form-control @error('title') is-invalid @enderror"
                           id="title"
                           name="title"
                           value="{{ old('title', $purchaseRequest->title) }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="description" class="form-label fw-semibold">
                        Description <span class="text-danger">*</span>
                    </label>
                    <textarea
                        class="form-control @error('description') is-invalid @enderror"
                        id="description"
                        name="description"
                        rows="6"
                        >{{ old('description', $purchaseRequest->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning px-5">
                    <i class="bi bi-check-lg me-1"></i>Update Request
                </button>
                <a href="{{ route('purchase-requests.show', $purchaseRequest->id) }}"
                   class="btn btn-outline-secondary px-4">
                    <i class="bi bi-arrow-left me-1"></i>Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
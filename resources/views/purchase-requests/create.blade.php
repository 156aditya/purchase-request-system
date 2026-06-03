@extends('layouts.app')
@section('title', 'Create Purchase Request')
@section('content')

<div class="page-header">
    <h4 class="mb-1 fw-bold">
        <i class="bi bi-plus-circle me-2 text-primary"></i>Create Purchase Request
    </h4>
    <small class="text-muted">Fill in all required fields marked with *</small>
</div>

<div class="card shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('purchase-requests.store') }}" method="POST">
            @csrf
            <div class="row g-4">
                <div class="col-md-6">
                    <label for="pr_no" class="form-label fw-semibold">
                        PR Number <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           class="form-control @error('pr_no') is-invalid @enderror"
                           id="pr_no"
                           name="pr_no"
                           value="{{ old('pr_no') }}"
                           placeholder="e.g. PR-2024-001"
                           autofocus>
                    @error('pr_no')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Must be unique. Max 50 characters.</div>
                </div>

                <div class="col-md-6">
                    <label for="status" class="form-label fw-semibold">
                        Status <span class="text-danger">*</span>
                    </label>
                    <select class="form-select @error('status') is-invalid @enderror"
                            id="status" name="status">
                        <option value="">-- Select Status --</option>
                        <option value="Pending"
                            {{ old('status')=='Pending' ? 'selected':'' }}>Pending</option>
                        <option value="Approved"
                            {{ old('status')=='Approved' ? 'selected':'' }}>Approved</option>
                        <option value="Rejected"
                            {{ old('status')=='Rejected' ? 'selected':'' }}>Rejected</option>
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
                           value="{{ old('title') }}"
                           placeholder="Enter a clear descriptive title">
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
                        placeholder="Provide detailed description of what is needed and why"
                        >{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary px-5">
                    <i class="bi bi-check-lg me-1"></i>Create Request
                </button>
                <a href="{{ route('purchase-requests.index') }}"
                   class="btn btn-outline-secondary px-4">
                    <i class="bi bi-arrow-left me-1"></i>Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
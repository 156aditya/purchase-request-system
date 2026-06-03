@extends('layouts.app')
@section('title', 'All Purchase Requests')
@section('content')

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h4 class="mb-1 fw-bold">
            <i class="bi bi-list-ul me-2 text-primary"></i>Purchase Requests
        </h4>
        <small class="text-muted">Manage all purchase requests</small>
    </div>
    <a href="{{ route('purchase-requests.create') }}" class="btn btn-primary px-4">
        <i class="bi bi-plus-lg me-1"></i>New Request
    </a>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('purchase-requests.index') }}"
              class="row g-3 align-items-end">
            <div class="col-md-5">
                <label class="form-label fw-semibold small">Search by PR Number</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="e.g. PR-2024-001"
                           value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold small">Filter by Status</label>
                <select name="status" class="form-select">
                    <option value="all"
                        {{ request('status','all') == 'all' ? 'selected':'' }}>
                        All Statuses
                    </option>
                    <option value="Pending"
                        {{ request('status') == 'Pending' ? 'selected':'' }}>
                        Pending
                    </option>
                    <option value="Approved"
                        {{ request('status') == 'Approved' ? 'selected':'' }}>
                        Approved
                    </option>
                    <option value="Rejected"
                        {{ request('status') == 'Rejected' ? 'selected':'' }}>
                        Rejected
                    </option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-funnel me-1"></i>Filter
                </button>
            </div>
            <div class="col-md-1">
                <a href="{{ route('purchase-requests.index') }}"
                   class="btn btn-outline-secondary w-100" title="Clear">
                    <i class="bi bi-x-lg"></i>
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="prTable">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>PR Number</th>
                        <th>Title</th>
                        <th>Requested By</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($purchaseRequests as $index => $pr)
                    <tr>
                        <td class="text-muted">{{ $purchaseRequests->firstItem() + $index }}</td>
                        <td><strong>{{ $pr->pr_no }}</strong></td>
                        <td>{{ Str::limit($pr->title, 45) }}</td>
                        <td>{{ $pr->user->name ?? 'N/A' }}</td>
                        <td>
                            <select class="form-select form-select-sm status-select"
                                    style="width:130px;"
                                    data-id="{{ $pr->id }}"
                                    data-current="{{ $pr->status }}">
                                <option value="Pending"
                                    {{ $pr->status=='Pending' ? 'selected':'' }}>Pending</option>
                                <option value="Approved"
                                    {{ $pr->status=='Approved' ? 'selected':'' }}>Approved</option>
                                <option value="Rejected"
                                    {{ $pr->status=='Rejected' ? 'selected':'' }}>Rejected</option>
                            </select>
                        </td>
                        <td>{{ $pr->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('purchase-requests.show', $pr->id) }}"
                                   class="btn btn-sm btn-outline-info" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('purchase-requests.edit', $pr->id) }}"
                                   class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('purchase-requests.destroy', $pr->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this request? This cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="bi bi-inbox display-6 d-block mb-2"></i>
                            No purchase requests found.
                            <a href="{{ route('purchase-requests.create') }}">Create the first one</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($purchaseRequests->hasPages())
    <div class="card-footer bg-white d-flex justify-content-between align-items-center py-3">
        <small class="text-muted">
            Showing {{ $purchaseRequests->firstItem() }}
            to {{ $purchaseRequests->lastItem() }}
            of {{ $purchaseRequests->total() }} results
        </small>
        {{ $purchaseRequests->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    if ($('#prTable tbody tr').length > 0 &&
        !$('#prTable tbody tr td[colspan]').length) {
        $('#prTable').DataTable({
            paging:    false,
            searching: false,
            info:      false,
            order:     []
        });
    }
});

document.querySelectorAll('.status-select').forEach(function(select) {
    select.addEventListener('change', function() {
        var id     = this.dataset.id;
        var status = this.value;
        var prev   = this.dataset.current;
        var el     = this;

        fetch('/purchase-requests/' + id + '/status', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector(
                    'meta[name="csrf-token"]'
                ).getAttribute('content')
            },
            body: JSON.stringify({ status: status })
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
            if (data.success) {
                el.dataset.current = status;
                showToast('Status updated to ' + status, 'success');
            } else {
                el.value = prev;
                showToast('Update failed. Please try again.', 'danger');
            }
        })
        .catch(function() {
            el.value = prev;
            showToast('Network error. Please try again.', 'danger');
        });
    });
});

function showToast(message, type) {
    var existing = document.getElementById('ajax-toast');
    if (existing) existing.remove();
    var toast = document.createElement('div');
    toast.id = 'ajax-toast';
    toast.className = 'alert alert-' + type + ' position-fixed shadow';
    toast.style.cssText = 'top:20px;right:20px;z-index:9999;min-width:260px;border-radius:10px;';
    toast.innerHTML = '<i class="bi bi-' +
        (type === 'success' ? 'check-circle' : 'exclamation-circle') +
        ' me-2"></i>' + message;
    document.body.appendChild(toast);
    setTimeout(function() { toast.remove(); }, 3000);
}
</script>
@endsection
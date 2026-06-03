<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Purchase Request System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
            position: fixed;
            width: 220px;
            top: 0;
            left: 0;
            z-index: 100;
        }
        .sidebar .nav-link {
            color: #a8b2d8;
            padding: 12px 20px;
            border-radius: 8px;
            margin: 2px 10px;
            transition: all 0.3s;
            font-size: 0.9rem;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #0f3460;
            color: #ffffff;
        }
        .sidebar .brand {
            color: #ffffff;
            font-size: 1.1rem;
            font-weight: 700;
            padding: 20px;
            border-bottom: 1px solid #0f3460;
            display: block;
        }
        .sidebar-user {
            position: absolute;
            bottom: 15px;
            left: 0;
            right: 0;
            padding: 0 20px;
        }
        .main-content {
            margin-left: 220px;
            padding: 30px;
            min-height: 100vh;
        }
        .stat-card {
            border: none;
            border-radius: 12px;
            transition: transform 0.2s;
            box-shadow: 0 2px 10px rgba(0,0,0,0.07);
        }
        .stat-card:hover { transform: translateY(-4px); }
        .badge-pending  { background-color: #ffc107 !important; color: #000 !important; }
        .badge-approved { background-color: #198754 !important; color: #fff !important; }
        .badge-rejected { background-color: #dc3545 !important; color: #fff !important; }
        .page-header {
            background: #ffffff;
            border-radius: 12px;
            padding: 20px 25px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .card { border: none; border-radius: 12px; }
        .table thead th {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
    </style>
    @yield('styles')
</head>
<body>

@auth
<div class="sidebar">
    <span class="brand">
        <i class="bi bi-box-seam me-2"></i>PRS System
    </span>
    <nav class="nav flex-column mt-3">
        <a href="{{ route('dashboard') }}"
           class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i>Dashboard
        </a>
        <a href="{{ route('purchase-requests.index') }}"
           class="nav-link {{ request()->routeIs('purchase-requests.index') ? 'active' : '' }}">
            <i class="bi bi-list-ul me-2"></i>All Requests
        </a>
        <a href="{{ route('purchase-requests.create') }}"
           class="nav-link {{ request()->routeIs('purchase-requests.create') ? 'active' : '' }}">
            <i class="bi bi-plus-circle me-2"></i>New Request
        </a>
        <hr style="border-color: #0f3460; margin: 10px 20px;">
        <a href="{{ route('logout') }}"
           class="nav-link text-danger"
           onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-left me-2"></i>Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </nav>
    <div class="sidebar-user">
        <small class="text-muted">
            <i class="bi bi-person-circle me-1"></i>
            {{ Auth::user()->name }}
        </small>
    </div>
</div>

<div class="main-content">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @yield('content')
</div>

@else
    @yield('content')
@endauth

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
@yield('scripts')
</body>
</html>
@extends('layouts.app')
@section('title', 'Login')
@section('content')

<div class="min-vh-100 d-flex align-items-center justify-content-center"
     style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);">
    <div class="card shadow-lg" style="width:420px; border-radius:16px;">
        <div class="card-body p-5">
            <div class="text-center mb-4">
                <div class="display-4 text-primary mb-2"><i class="bi bi-box-seam"></i></div>
                <h4 class="fw-bold">Purchase Request System</h4>
                <p class="text-muted">Sign in to your account</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email Address</label>
                    <input type="email"
                           class="form-control form-control-lg @error('email') is-invalid @enderror"
                           id="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="you@example.com" autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input type="password"
                           class="form-control form-control-lg @error('password') is-invalid @enderror"
                           id="password" name="password" placeholder="••••••••">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label text-muted" for="remember">Remember me</label>
                </div>

                <button type="submit" class="btn btn-primary btn-lg w-100 fw-semibold">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                </button>

                <div class="text-center mt-3">
                    <small class="text-muted">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="fw-semibold">Register here</a>
                    </small>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
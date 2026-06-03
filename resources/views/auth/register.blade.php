@extends('layouts.app')
@section('title', 'Register')
@section('content')

<div class="min-vh-100 d-flex align-items-center justify-content-center"
     style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);">
    <div class="card shadow-lg" style="width:460px; border-radius:16px;">
        <div class="card-body p-5">
            <div class="text-center mb-4">
                <div class="display-4 text-primary mb-2"><i class="bi bi-person-plus"></i></div>
                <h4 class="fw-bold">Create Account</h4>
                <p class="text-muted">Purchase Request System</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Full Name</label>
                    <input type="text"
                           class="form-control form-control-lg @error('name') is-invalid @enderror"
                           id="name" name="name"
                           value="{{ old('name') }}"
                           placeholder="Your full name" autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email Address</label>
                    <input type="email"
                           class="form-control form-control-lg @error('email') is-invalid @enderror"
                           id="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="you@example.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input type="password"
                           class="form-control form-control-lg @error('password') is-invalid @enderror"
                           id="password" name="password"
                           placeholder="Minimum 8 characters">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-semibold">
                        Confirm Password
                    </label>
                    <input type="password"
                           class="form-control form-control-lg"
                           id="password_confirmation" name="password_confirmation"
                           placeholder="Repeat your password">
                </div>

                <button type="submit" class="btn btn-primary btn-lg w-100 fw-semibold">
                    <i class="bi bi-person-check me-2"></i>Create Account
                </button>

                <div class="text-center mt-3">
                    <small class="text-muted">
                        Already have an account?
                        <a href="{{ route('login') }}" class="fw-semibold">Login here</a>
                    </small>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
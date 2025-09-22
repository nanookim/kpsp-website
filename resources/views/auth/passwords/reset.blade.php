@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')
    <div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
        <div class="card shadow-lg border-0 w-100" style="max-width: 600px;">
            <div class="card-body p-5">
                {{-- Header --}}
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle mb-3"
                         style="width: 80px; height: 80px;">
                        <span style="font-size: 36px;">🔒</span>
                    </div>

                    <h3 class="fw-bold text-primary">Reset Password</h3>
                    <p class="text-muted mb-0">
                        Masukkan email dan kata sandi baru Anda untuk melanjutkan.
                    </p>
                </div>

                {{-- Form --}}
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    {{-- Email --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email', $email ?? '') }}"
                               class="form-control form-control-lg @error('email') is-invalid @enderror"
                               placeholder="nama@email.com"
                               required autofocus>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password Baru --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password Baru</label>
                        <input type="password"
                               name="password"
                               class="form-control form-control-lg @error('password') is-invalid @enderror"
                               placeholder="Minimal 8 karakter"
                               required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Konfirmasi Password</label>
                        <input type="password"
                               name="password_confirmation"
                               class="form-control form-control-lg"
                               placeholder="Ulangi password baru"
                               required>
                    </div>

                    {{-- Tombol --}}
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                        Simpan Password
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

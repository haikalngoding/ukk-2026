@extends('layouts.app')

@section('title', config('app.name') . ' -- Login')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center mt-3">
        <div class="col-lg-5 col-md-7">
            
            <!-- Area Header Login -->
            <div class="text-center mb-4">
                <div class="d-inline-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded-circle mb-3 shadow-sm" style="width: 70px; height: 70px;">
                    <i class="bi bi-box-arrow-in-right fs-1"></i>
                </div>
                <h3 class="fw-bold mb-1">Selamat Datang!</h3>
                <p class="text-body-secondary fs-7">Silakan masuk untuk mengelola inventaris alat.</p>
            </div>

            <!-- Card Form Login -->
            <div class="card border-0 shadow-sm rounded-4 position-relative overflow-hidden">
                <!-- Aksen Garis Atas Biru -->
                <div class="position-absolute top-0 start-0 w-100 bg-primary" style="height: 4px;"></div>
                
                <div class="card-body p-4 p-lg-5">
                    
                    <!-- Info Akun Demo -->
                    <div class="alert bg-info-subtle border-0 text-info-emphasis rounded-3 d-flex align-items-center gap-3 p-3 mb-4 fs-7 shadow-2xs">
                        <i class="bi bi-info-circle-fill fs-5 text-info"></i>
                        <div>
                            <strong>Akun Demo:</strong> <br>
                            Username: <code>admin</code> &mdash; Password: <code>rahasia123</code>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('login.attempt') }}">
                        @csrf

                        <!-- Username -->
                        <div class="mb-4">
                            <label class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider" for="username">
                                Username
                            </label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                    <i class="bi bi-person-fill"></i>
                                </span>
                                <input type="text" id="username" name="username" value="{{ old('username') }}" class="form-control form-control-lg border-0 bg-body-tertiary fs-6 {{ errors()->has('username') ? 'is-invalid' : '' }}" placeholder="Masukkan username..." autofocus required>
                            </div>
                            @if(errors()->has('username'))
                                <div class="text-danger small mt-1 px-1">{{ errors()->first('username') }}</div>
                            @endif
                        </div>

                        <!-- Password -->
                        <div class="mb-5">
                            <label class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider" for="password">
                                Password
                            </label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                    <i class="bi bi-lock-fill"></i>
                                </span>
                                <input type="password" id="password" name="password" class="form-control form-control-lg border-0 bg-body-tertiary fs-6 {{ errors()->has('password') ? 'is-invalid' : '' }}" placeholder="Masukkan password..." required>
                            </div>
                            @if(errors()->has('password'))
                                <div class="text-danger small mt-1 px-1">{{ errors()->first('password') }}</div>
                            @endif
                        </div>

                        <!-- Tombol Login -->
                        <button class="btn btn-primary w-100 rounded-pill py-2.5 fw-bold shadow-sm hover-lift d-flex justify-content-center align-items-center gap-2" type="submit">
                            <span>Masuk ke Aplikasi</span> <i class="bi bi-box-arrow-in-right"></i>
                        </button>
                    </form>

                    <!-- Logika Pendaftaran (Registrasi) -->
                    @php
                        $canRegister = false;
                        try {
                            $canRegister = \App\Models\Role::where('can_register', 1)->exists();
                        } catch (\Throwable $e) {
                            $canRegister = false;
                        }
                    @endphp
                    
                    @if ($canRegister)
                        <div class="text-center mt-4 pt-3 border-top">
                            <p class="text-body-secondary small mb-0">
                                Belum punya akun? <a href="{{ route('register') }}" class="fw-semibold text-primary text-decoration-none">Daftar di sini</a>
                            </p>
                        </div>
                    @endif

                </div>
            </div>
            
            <!-- Footer Bawah Form -->
            <div class="text-center mt-4">
                <small class="text-muted">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</small>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<style>
    .tracking-wider {
        letter-spacing: 0.05em;
    }

    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }

    .input-group:focus-within {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25) !important;
    }
    .input-group:focus-within .input-group-text,
    .input-group:focus-within .form-control {
        background-color: var(--bs-body-bg) !important;
    }
    .form-control:focus {
        box-shadow: none !important;
    }
</style>
@endsection
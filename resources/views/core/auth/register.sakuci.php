@extends('layouts.app')

@section('title', config('app.name') . ' -- Daftar Akun')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center mt-3">
        <div class="col-lg-5 col-md-7">
            
            <!-- Area Header Register -->
            <div class="text-center mb-4">
                <div class="d-inline-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded-circle mb-3 shadow-sm" style="width: 70px; height: 70px;">
                    <i class="bi bi-person-plus-fill fs-1"></i>
                </div>
                <h3 class="fw-bold mb-1">Daftar Akun Baru</h3>
                <p class="text-body-secondary fs-7">Lengkapi formulir di bawah untuk bergabung dengan GoPENA.</p>
            </div>

            <!-- Card Form Register -->
            <div class="card border-0 shadow-sm rounded-4 position-relative overflow-hidden">
                <!-- Aksen Garis Atas Biru -->
                <div class="position-absolute top-0 start-0 w-100 bg-primary" style="height: 4px;"></div>
                
                <div class="card-body p-4 p-lg-5">

                    <form method="POST" action="{{ route('register.attempt') }}">
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
                                <input type="text" id="username" name="username" value="{{ old('username') }}" class="form-control form-control-lg border-0 bg-body-tertiary fs-6 {{ errors()->has('username') ? 'is-invalid' : '' }}" placeholder="Buat username baru..." autofocus required>
                            </div>
                            @if(errors()->has('username'))
                                <div class="text-danger small mt-1 px-1">{{ errors()->first('username') }}</div>
                            @endif
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider" for="password">
                                Password
                            </label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                    <i class="bi bi-lock-fill"></i>
                                </span>
                                <input type="password" id="password" name="password" class="form-control form-control-lg border-0 bg-body-tertiary fs-6 {{ errors()->has('password') ? 'is-invalid' : '' }}" placeholder="Buat password..." required>
                            </div>
                            @if(errors()->has('password'))
                                <div class="text-danger small mt-1 px-1">{{ errors()->first('password') }}</div>
                            @endif
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="mb-4">
                            <label class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider" for="password_confirmation">
                                Konfirmasi Password
                            </label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                    <i class="bi bi-shield-lock-fill"></i>
                                </span>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-lg border-0 bg-body-tertiary fs-6" placeholder="Ketik ulang password..." required>
                            </div>
                        </div>

                        <!-- Pilihan Role (Jika ada lebih dari 1 role) -->
                        @if (count($roles) > 1)
                            <div class="mb-5">
                                <label class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider" for="role">
                                    Daftar sebagai
                                </label>
                                <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                    <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                        <i class="bi bi-person-badge-fill"></i>
                                    </span>
                                    <select id="role" name="role" class="form-select form-select-lg border-0 bg-body-tertiary fs-6 {{ errors()->has('role') ? 'is-invalid' : '' }}">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}" {{ old('role') === $role->name ? 'selected' : '' }}>
                                                {{ ucfirst($role->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @if(errors()->has('role'))
                                    <div class="text-danger small mt-1 px-1">{{ errors()->first('role') }}</div>
                                @endif
                            </div>
                        @else
                            <input type="hidden" name="role" value="{{ $roles[0]->name }}">
                            <!-- Beri jarak ekstra jika dropdown tidak muncul -->
                            <div class="mb-5"></div>
                        @endif

                        <!-- Tombol Daftar -->
                        <button class="btn btn-primary w-100 rounded-pill py-2.5 fw-bold shadow-sm hover-lift d-flex justify-content-center align-items-center gap-2" type="submit">
                            <span>Daftar Sekarang</span> <i class="bi bi-arrow-right-circle"></i>
                        </button>
                    </form>

                    <!-- Link ke Login -->
                    <div class="text-center mt-4 pt-3 border-top">
                        <p class="text-body-secondary small mb-0">
                            Sudah punya akun? <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-none">Masuk di sini</a>
                        </p>
                    </div>

                </div>
            </div>
            
            <!-- Footer -->
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
    .input-group:focus-within .form-control,
    .input-group:focus-within .form-select {
        background-color: var(--bs-body-bg) !important;
    }
    .form-control:focus, .form-select:focus {
        box-shadow: none !important;
    }
</style>
@endsection
@extends('layouts.app')

@section('title', config('app.name') . ' -- Manage User')

@section('content')
<div class="container-fluid p-0">

    <!-- HEADER HALAMAN -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-primary-subtle text-primary rounded-circle p-2 d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 55px; height: 55px;">
                <i class="bi bi-people-fill fs-3"></i>
            </div>
            <div>
                <span class="badge bg-body-secondary text-body-secondary rounded-pill px-3 py-1 mb-1 fw-semibold border">Area Admin</span>
                <h3 class="fw-bold mb-0 text-body">Manage User</h3>
                <p class="text-body-secondary mb-0 fs-7">Atur akun pengguna dan hak akses aplikasi GoPENA.</p>
            </div>
        </div>
        
        <a href="{{ route('admin.dashboard') }}" class="btn btn-light border shadow-sm rounded-pill px-4 py-2 fw-medium hover-lift d-flex align-items-center gap-2">
            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <div class="row g-4">
        
        <!-- KOLOM KIRI: FORM TAMBAH USER -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden">
                <!-- Aksen garis atas -->
                <div class="position-absolute top-0 start-0 w-100 bg-primary" style="height: 4px;"></div>
                
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="bg-primary-subtle text-primary rounded-circle p-2 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 45px; height: 45px;">
                            <i class="bi bi-person-plus-fill fs-5"></i>
                        </div>
                        <h5 class="fw-bold text-body mb-0">Tambah User Baru</h5>
                    </div>

                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf

                        <!-- Input Username -->
                        <div class="mb-4">
                            <label class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider" for="username">Username <span class="text-danger">*</span></label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input type="text" id="username" name="username" value="{{ old('username') }}" class="form-control form-control-lg border-0 bg-body-tertiary fs-6 {{ errors()->has('username') ? 'is-invalid' : '' }}" placeholder="Masukkan username unik..." autofocus required>
                            </div>
                            @error('username') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <!-- Input Password -->
                        <div class="mb-4">
                            <label class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider" for="password">Password <span class="text-danger">*</span></label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                    <i class="bi bi-key"></i>
                                </span>
                                <input type="password" id="password" name="password" class="form-control form-control-lg border-0 bg-body-tertiary fs-6 {{ errors()->has('password') ? 'is-invalid' : '' }}" placeholder="Masukkan password kuat..." required>
                            </div>
                            @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <!-- Select Role -->
                        <div class="mb-4">
                            <label class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider" for="role">Pilih Role Akses <span class="text-danger">*</span></label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden mb-2">
                                <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                    <i class="bi bi-shield-lock"></i>
                                </span>
                                <select id="role" name="role" class="form-select form-select-lg border-0 bg-body-tertiary fs-6 {{ errors()->has('role') ? 'is-invalid' : '' }}" required>
                                    <option value="">-- Pilih Role --</option>
                                    @foreach ($roles as $roleOption)
                                        <option value="{{ $roleOption->name }}" @if (old('role') === $roleOption->name) selected @endif>
                                            {{ ucfirst($roleOption->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('role') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            
                            <!-- Bantuan Info Tambahan -->
                            <div class="d-flex align-items-center gap-2 mt-2 px-1">
                                <i class="bi bi-info-circle text-info"></i>
                                <span class="text-body-secondary" style="font-size: 0.8rem;">
                                    Butuh role lain? Buat di <a href="{{ route('admin.roles.index') }}" class="text-primary fw-medium text-decoration-none">Manage Role</a>.
                                </span>
                            </div>
                        </div>

                        <button class="btn btn-primary w-100 rounded-pill py-2.5 fw-semibold shadow-sm hover-lift d-flex justify-content-center align-items-center gap-2" type="submit">
                            <i class="bi bi-person-check-fill"></i> Tambah User Baru
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: TABEL DAFTAR USER -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white border-bottom p-4 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-info-subtle text-info rounded-circle p-2 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 45px; height: 45px;">
                            <i class="bi bi-card-list fs-5"></i>
                        </div>
                        <h5 class="fw-bold text-body mb-0">Daftar Pengguna</h5>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-secondary">
                                <tr>
                                    <th class="ps-4 border-0 text-center" style="width: 10%;">ID</th>
                                    <th class="border-0">Informasi Akun</th>
                                    <th class="border-0 text-center">Role Akses</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $item)
                                    <tr>
                                        <td class="ps-4 text-center fw-medium text-body-secondary">{{ $item->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3 py-2">
                                                <!-- Avatar Bulat Otomatis -->
                                                <div class="bg-primary-subtle text-primary rounded-circle d-flex justify-content-center align-items-center flex-shrink-0 fw-bold" style="width: 40px; height: 40px; font-size: 1.1rem;">
                                                    {{ strtoupper(substr($item->username, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-body fs-6">{{ $item->username }}</div>
                                                    <div class="text-body-secondary" style="font-size: 0.75rem;">Status Aktif</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if($item->role === 'admin')
                                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill fs-8 d-inline-flex align-items-center gap-1">
                                                    <i class="bi bi-shield-lock-fill"></i> Admin
                                                </span>
                                            @else
                                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill fs-8 text-capitalize d-inline-flex align-items-center gap-1">
                                                    <i class="bi bi-person-badge"></i> {{ $item->role }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-secondary py-5">
                                            <div class="d-flex flex-column align-items-center justify-content-center gap-3">
                                                <div class="bg-body-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                                                    <i class="bi bi-person-dash fs-1 text-secondary opacity-50"></i>
                                                </div>
                                                <div>
                                                    <h6 class="fw-bold text-body-secondary mb-0">Belum Ada Pengguna</h6>
                                                    <p class="text-secondary fs-7 mb-0">Silakan tambahkan user baru melalui form di samping.</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<style>
    /* Spasi huruf untuk label form */
    .tracking-wider {
        letter-spacing: 0.05em;
    }

    /* Efek hover untuk tombol dan card */
    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }

    /* Fokus state untuk input group (Glow Biru) */
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
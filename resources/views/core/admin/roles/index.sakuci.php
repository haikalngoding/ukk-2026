@extends('layouts.app')

@section('title', 'Manage Role')

@section('content')
<div class="container-fluid p-0">

    <!-- HEADER HALAMAN -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-success-subtle text-success rounded-circle p-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 65px; height: 65px;">
                <i class="bi bi-shield-lock-fill fs-3"></i>
            </div>
            <div>
                <span class="badge bg-body-secondary text-body-secondary rounded-pill px-3 py-1 mb-1 fw-semibold border">Area Admin</span>
                <h3 class="fw-bold mb-0 text-body">Manage Role</h3>
                <p class="text-body-secondary mb-0 fs-7">Atur hak akses untuk masing-masing user.</p>
            </div>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-light border shadow-sm rounded-pill px-4 py-2 fw-medium hover-lift">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke Dashboard
        </a>
    </div>

    <div class="row g-4">
        
        <!-- KOLOM KIRI: FORM TAMBAH ROLE -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden">
                <!-- Aksen garis atas -->
                <div class="position-absolute top-0 start-0 w-100 bg-primary" style="height: 4px;"></div>
                
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="bg-primary-subtle text-primary rounded-circle p-2 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 45px; height: 45px;">
                            <i class="bi bi-plus-lg fs-5"></i>
                        </div>
                        <h5 class="fw-bold text-body mb-0">Tambah Role</h5>
                    </div>

                    <form method="POST" action="{{ route('admin.roles.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-medium text-body-secondary small" for="name">Nama Role</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control form-control-lg rounded-3 fs-6 {{ errors()->has('name') ? 'is-invalid' : '' }}" placeholder="Mis: editor, guru..." autofocus>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Toggle Switch Modern -->
                        <div class="form-check form-switch mb-4 bg-body-tertiary p-3 rounded-3 border">
                            <input class="form-check-input ms-0 me-3" type="checkbox" role="switch" id="can_register" name="can_register" value="1" style="width: 2.5em; height: 1.25em;" {{ old('can_register') ? 'checked' : '' }}>
                            <label class="form-check-label fw-medium text-body" for="can_register">Izinkan Registrasi Publik</label>
                            <small class="d-block text-body-secondary mt-1">Jika aktif, role ini bisa dipilih pengunjung saat mendaftar akun baru.</small>
                        </div>

                        <div class="alert alert-info border-0 bg-info-subtle text-info-emphasis rounded-3 p-3 mb-4 d-flex gap-2">
                            <i class="bi bi-info-circle-fill mt-1"></i>
                            <span style="font-size: 0.8rem;">Middleware untuk role ini dibuat otomatis dan dapat digunakan lewat <code>->middleware('nama-role')</code>.</span>
                        </div>

                        <button class="btn btn-primary w-100 rounded-pill py-2 fw-semibold shadow-sm hover-lift" type="submit">
                            <i class="bi bi-save me-2"></i> Tambah Role Baru
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: TABEL DAFTAR ROLE -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="bg-success-subtle text-success rounded-circle p-2 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 45px; height: 45px;">
                            <i class="bi bi-shield-lock-fill fs-5"></i>
                        </div>
                        <h5 class="fw-bold text-body mb-0">Daftar Role Tersedia</h5>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 border-top">
                            <thead class="table-light text-secondary">
                                <tr>
                                    <th class="ps-3 border-0 rounded-start">#</th>
                                    <th class="border-0">Nama Role</th>
                                    <th class="border-0">Status Registrasi</th>
                                    <th class="border-0 rounded-end text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($roles as $role)
                                    <tr>
                                        <td class="ps-3 fw-medium text-body-secondary">{{ $role->id }}</td>
                                        <td>
                                            <span class="badge bg-secondary-subtle text-secondary border fw-medium px-3 py-2 fs-7 text-lowercase">
                                                {{ $role->name }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($role->can_register)
                                                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 border border-success-subtle d-inline-flex align-items-center gap-1">
                                                    <i class="bi bi-check-circle-fill"></i> Terbuka
                                                </span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2 border border-danger-subtle d-inline-flex align-items-center gap-1">
                                                    <i class="bi bi-x-circle-fill"></i> Tertutup
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($role->name === 'admin')
                                                <div class="text-center">
                                                    <span class="badge bg-dark-subtle text-dark border px-3 py-2 rounded-pill"><i class="bi bi-lock-fill me-1"></i> Bawaan Sistem</span>
                                                </div>
                                            @else
                                                <div class="d-flex flex-nowrap align-items-center justify-content-center gap-2">
                                                    <!-- Form Edit Cepat -->
                                                    <form method="POST" action="{{ route('admin.roles.update', ['role' => $role->id]) }}" class="d-flex align-items-center gap-2">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="text" name="name" value="{{ $role->name }}" class="form-control form-control-sm rounded-3" style="width: 100px;" required>
                                                        
                                                        <div class="form-check m-0" title="Bisa registrasi sendiri">
                                                            <input type="checkbox" name="can_register" value="1" class="form-check-input" id="reg{{ $role->id }}" {{ $role->can_register ? 'checked' : '' }}>
                                                        </div>
                                                        
                                                        <button type="submit" class="btn btn-sm btn-primary rounded-3" title="Simpan Perubahan">
                                                            <i class="bi bi-check2"></i>
                                                        </button>
                                                    </form>
                                                    
                                                    <!-- Form Hapus -->
                                                    <form method="POST" action="{{ route('admin.roles.destroy', ['role' => $role->id]) }}" onsubmit="return confirm('Hapus role &quot;{{ $role->name }}&quot;?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-3" title="Hapus Role">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-secondary py-5">
                                            <i class="bi bi-folder-x fs-1 text-secondary opacity-50 mb-2 d-block"></i>
                                            Belum ada role tambahan yang dibuat.
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
    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
</style>
@endsection
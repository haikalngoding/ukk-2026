@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    
    <!-- 1. WELCOME BANNER UTAMA -->
    <div class="card border-0 shadow-sm rounded-4 mb-4 bg-primary text-white overflow-hidden position-relative">
        <!-- Dekorasi Latar Belakang (Ikon transparan) -->
        <div class="position-absolute top-0 end-0 opacity-25" style="transform: scale(2) translate(10%, -10%); pointer-events: none;">
            <i class="bi bi-shield-check" style="font-size: 15rem;"></i>
        </div>
        
        <div class="card-body p-4 p-lg-5 position-relative z-1">
            <span class="badge bg-white text-primary rounded-pill mb-3 px-3 py-2 fw-semibold shadow-sm">Area Admin</span>
            <!-- Gunakan variabel nama user jika ada, atau default ke 'Admin' -->
            <h2 class="fw-bold mb-2">Halo, {{ $currentUser->username ?? 'Admin' }}! 👋</h2>
            <p class="mb-0 opacity-75 fs-6">Selamat datang di Workspace GoPENA. Pantau ringkasan dan kelola sistem dari halaman ini.</p>
        </div>
    </div>

    <!-- 2. GRID MENU AKSES CEPAT (QUICK ACCESS) -->
    <h5 class="fw-bold text-body mb-3 px-1">Menu Akses Cepat</h5>
    <div class="row g-4">
        
        <!-- Kartu 1: Manage User -->
        <div class="col-md-6 col-lg-4">
            <!-- Ubah href sesuai dengan route aslimu -->
            <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift">
                    <div class="card-body p-4 d-flex align-items-center gap-3">
                        <div class="bg-primary-subtle text-primary rounded-circle p-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 65px; height: 65px;">
                            <i class="bi bi-people-fill fs-3"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-body mb-1">Manage User</h6>
                            <p class="text-body-secondary mb-0" style="font-size: 0.85rem;">Tambah & atur akun pengguna baru.</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Kartu 2: Manage Role -->
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('admin.roles.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift">
                    <div class="card-body p-4 d-flex align-items-center gap-3">
                        <div class="bg-success-subtle text-success rounded-circle p-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 65px; height: 65px;">
                            <i class="bi bi-shield-lock-fill fs-3"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-body mb-1">Manage Role</h6>
                            <p class="text-body-secondary mb-0" style="font-size: 0.85rem;">Atur hak akses untuk masing-masing user.</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Kartu 3: Download Database -->
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('admin.database.export') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift">
                    <div class="card-body p-4 d-flex align-items-center gap-3">
                        <div class="bg-warning-subtle text-warning rounded-circle p-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 65px; height: 65px;">
                            <i class="bi bi-database-fill-down fs-3"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-body mb-1">Backup Database</h6>
                            <p class="text-body-secondary mb-0" style="font-size: 0.85rem;">Unduh data file .sql untuk dicadangkan.</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-4">
            <a href="{{ route('kategori.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift">
                    <div class="card-body p-4 d-flex align-items-center gap-3">
                        <div class="bg-primary-subtle text-primary rounded-circle p-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 65px; height: 65px;">
                            <i class="bi bi-tags-fill fs-3"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-body mb-1">Daftar Kategori</h6>
                            <p class="text-body-secondary mb-0" style="font-size: 0.85rem;">Kelola pengelompokan data alat untuk memudahkan manajemen inventaris.</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-4">
            <a href="{{ route('alat.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift">
                    <div class="card-body p-4 d-flex align-items-center gap-3">
                        <div class="bg-primary-subtle text-primary rounded-circle p-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 65px; height: 65px;">
                            <i class="bi bi-tools fs-3"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-body mb-1">Daftar Alat</h6>
                            <p class="text-body-secondary mb-0" style="font-size: 0.85rem;">Kelola data seluruh alat inventaris yang tersedia untuk dipinjam.</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-4">
            <a href="{{ route('peminjaman.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift">
                    <div class="card-body p-4 d-flex align-items-center gap-3">
                        <div class="bg-primary-subtle text-primary rounded-circle p-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 65px; height: 65px;">
                            <i class="bi bi-arrow-left-right fs-3"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-body mb-1">Daftar Peminjaman</h6>
                            <p class="text-body-secondary mb-0" style="font-size: 0.85rem;">Kelola data peminjaman, pengembalian, dan denda inventaris.</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-4">
            <a href="{{ route('pengembalian.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift">
                    <div class="card-body p-4 d-flex align-items-center gap-3">
                        <div class="bg-primary-subtle text-primary rounded-circle p-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 65px; height: 65px;">
                            <i class="bi bi-box-arrow-in-down fs-3"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-body mb-1">Daftar Pengembalian</h6>
                            <p class="text-body-secondary mb-0" style="font-size: 0.85rem;">Kelola riwayat pengembalian barang, kondisi, dan denda keterlambatan.</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-4">
            <a href="{{ route('admin.log.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift">
                    <div class="card-body p-4 d-flex align-items-center gap-3">
                        <div class="bg-info-subtle text-info rounded-circle p-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 65px; height: 65px;">
                            <i class="bi bi-journal-text fs-3"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-body mb-1">Log Aktifitas</h6>
                            <p class="text-body-secondary mb-0" style="font-size: 0.85rem;">Pantau seluruh riwayat tindakan pengguna di dalam sistem GoPENA.</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<style>
    /* Animasi saat kartu disorot kursor (Hover Lift Effect) */
    .hover-lift {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        border: 1px solid var(--bs-primary-border-subtle) !important;
    }
</style>
@endsection
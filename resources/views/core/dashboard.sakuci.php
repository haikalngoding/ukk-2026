@extends('layouts.app')

@section('title', config('app.name') . ' -- Dashboard')

@section('content')
<div class="container-fluid p-0">

    <!-- 1. WELCOME BANNER UTAMA -->
    <div class="card border-0 shadow-sm rounded-4 mb-4 bg-primary text-white overflow-hidden position-relative">
        <!-- Dekorasi Latar Belakang (Ikon transparan) -->
        <div class="position-absolute top-0 end-0 opacity-25" style="transform: scale(2) translate(10%, -10%); pointer-events: none;">
            <i class="bi bi-box-seam" style="font-size: 15rem;"></i>
        </div>
        
        <div class="card-body p-4 p-lg-5 position-relative z-1">
            <span class="badge bg-white text-primary rounded-pill mb-3 px-3 py-2 fw-semibold shadow-sm">
                <i class="bi bi-person-badge me-1"></i> Role: {{ ucfirst($user->role ?? 'Peminjam') }}
            </span>
            
            <h2 class="fw-bold mb-2">Halo, {{ $user->username ?? 'Siswa' }}! 👋</h2>
            <p class="mb-4 opacity-75 fs-6" style="max-width: 600px;">
                Selamat datang di Workspace GoPENA. Silakan pantau status persetujuan, barang yang sedang dipinjam, hingga tagihan denda Anda dari halaman ini.
            </p>

            <a href="{{ route('peminjam.createPeminjam') }}" class="btn btn-light text-primary fw-bold px-4 py-2.5 rounded-pill shadow-sm hover-lift d-inline-flex align-items-center gap-2">
                <i class="bi bi-plus-circle-fill fs-6"></i>
                <span>Ajukan Peminjaman Baru</span>
            </a>
        </div>
    </div>

    <!-- 2. KARTU STATISTIK & DENDA -->
    <h5 class="fw-bold text-body mb-3 px-1">Ringkasan Aktivitasmu</h5>
    <div class="row g-4 mb-4">
        
        <!-- Kartu Menunggu -->
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 hover-lift">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <small class="text-uppercase fw-bold text-secondary tracking-wider" style="font-size: 0.75rem;">Menunggu</small>
                        <h2 class="fw-bold text-warning mb-0 mt-1">{{ $pendingCount ?? 0 }}</h2>
                    </div>
                    <div class="bg-warning-subtle text-warning rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="bi bi-hourglass-split fs-4"></i>
                    </div>
                </div>
                <small class="text-body-secondary d-block mt-auto">Menunggu persetujuan admin</small>
            </div>
        </div>

        <!-- Kartu Dipinjam -->
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 hover-lift">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <small class="text-uppercase fw-bold text-secondary tracking-wider" style="font-size: 0.75rem;">Dipinjam</small>
                        <h2 class="fw-bold text-primary mb-0 mt-1">{{ $activeCount ?? 0 }}</h2>
                    </div>
                    <div class="bg-primary-subtle text-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="bi bi-arrow-up-right-circle fs-4"></i>
                    </div>
                </div>
                <small class="text-body-secondary d-block mt-auto">Alat yang sedang dibawa</small>
            </div>
        </div>

        <!-- Kartu Selesai -->
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 hover-lift">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <small class="text-uppercase fw-bold text-secondary tracking-wider" style="font-size: 0.75rem;">Selesai</small>
                        <h2 class="fw-bold text-success mb-0 mt-1">{{ $completedCount ?? 0 }}</h2>
                    </div>
                    <div class="bg-success-subtle text-success rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="bi bi-check2-all fs-4"></i>
                    </div>
                </div>
                <small class="text-body-secondary d-block mt-auto">Total peminjaman selesai</small>
            </div>
        </div>

        <!-- Kartu Total Denda -->
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 hover-lift position-relative overflow-hidden">
                <!-- Aksen Garis Merah jika ada denda -->
                @if(($totalDenda ?? 0) > 0)
                    <div class="position-absolute top-0 start-0 w-100 bg-danger" style="height: 4px;"></div>
                @endif
                <div class="d-flex justify-content-between align-items-start mb-3 mt-1">
                    <div>
                        <small class="text-uppercase fw-bold text-secondary tracking-wider" style="font-size: 0.75rem;">Tagihan Denda</small>
                        <h3 class="fw-bold text-danger mb-0 mt-1 tracking-tight">Rp {{ number_format($totalDenda ?? 0, 0, ',', '.') }}</h3>
                    </div>
                    <div class="bg-danger-subtle text-danger rounded-circle p-2 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 45px; height: 45px;">
                        <i class="bi bi-cash-coin fs-4"></i>
                    </div>
                </div>
                <small class="text-body-secondary d-block mt-auto">Denda keterlambatan/kerusakan</small>
            </div>
        </div>
    </div>

    <!-- 3. PETUNJUK PENGGUNAAN SINGKAT -->
    <h5 class="fw-bold text-body mb-3 px-1 mt-2">Bantuan Cepat</h5>
    <div class="row g-4">
        
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift">
                <div class="card-body p-4 d-flex align-items-center gap-3">
                    <div class="bg-info-subtle text-info-emphasis p-3 rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 60px; height: 60px;">
                        <i class="bi bi-box-seam fs-3"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Pengajuan Peminjaman</h6>
                        <p class="text-body-secondary small mb-0">Klik tombol "Ajukan Peminjaman Baru" pada banner biru di atas untuk mulai meminjam alat.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 hover-lift">
                <div class="card-body p-4 d-flex align-items-center gap-3">
                    <div class="bg-success-subtle text-success-emphasis p-3 rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 60px; height: 60px;">
                        <i class="bi bi-clock-history fs-3"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Pantau Status & Riwayat</h6>
                        <p class="text-body-secondary small mb-0">Cek persetujuan alat di kartu "Menunggu" atau buka menu navigasi untuk detail lengkap.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

@section('scripts')
<style>
    /* Spasi huruf untuk judul kecil agar elegan */
    .tracking-wider {
        letter-spacing: 0.05em;
    }
    .tracking-tight {
        letter-spacing: -0.02em;
    }

    /* Efek hover untuk kartu agar interaktif */
    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-lift:hover {
        transform: translateY(-4px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
</style>
@endsection
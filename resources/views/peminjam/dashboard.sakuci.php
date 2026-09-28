@extends('layouts.app')

@section('title', config('app.name') . ' -- Dashboard')

@section('content')
<div class="container-fluid py-4 px-4">

    <!-- Card Banner Utama -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
        <div class="card-body p-4 p-md-5 bg-primary text-white position-relative">
            
            <!-- Badge Role -->
            <span class="badge bg-white text-primary rounded-pill px-3 py-2 mb-3 fw-bold">
                Role: {{ $user->role ?? 'Siswa' }}
            </span>

            <!-- Ucapan Selamat Datang -->
            <h2 class="fw-bold mb-2">Halo, {{ $user->username ?? 'User' }}! 👋</h2>
            <p class="mb-4 opacity-75 fs-6" style="max-width: 600px;">
                Selamat datang di Sistem Inventaris Alat. Silakan pantau status peminjaman dan tagihan denda Anda di bawah ini.
            </p>

            <!-- Tombol Utama -->
            <a href="{{ route('peminjam.createPeminjam') }}" class="btn btn-light text-primary fw-semibold px-4 py-2.5 rounded-3 shadow-sm d-inline-flex align-items-center gap-2">
                <i class="bi bi-plus-lg fs-5"></i>
                <span>Ajukan Peminjaman Baru</span>
            </a>

        </div>
    </div>

    <!-- 4 KARTU STATISTIK & DENDA -->
    <div class="row g-3 mb-4">
        <!-- Kartu Menunggu -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
                <small class="text-uppercase fw-bold text-muted">MENUNGGU</small>
                <h3 class="fw-bold my-2 text-warning">{{ $pendingCount ?? 0 }}</h3>
                <small class="text-muted">Menunggu persetujuan admin</small>
            </div>
        </div>

        <!-- Kartu Dipinjam -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
                <small class="text-uppercase fw-bold text-muted">DIPINJAM</small>
                <h3 class="fw-bold my-2 text-primary">{{ $activeCount ?? 0 }}</h3>
                <small class="text-muted">Alat yang sedang Anda bawa</small>
            </div>
        </div>

        <!-- Kartu Selesai -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
                <small class="text-uppercase fw-bold text-muted">SELESAI</small>
                <h3 class="fw-bold my-2 text-success">{{ $completedCount ?? 0 }}</h3>
                <small class="text-muted">Total peminjaman selesai</small>
            </div>
        </div>

        <!-- Kartu Total Denda -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
                <small class="text-uppercase fw-bold text-muted">TOTAL DENDA</small>
                <h3 class="fw-bold my-2 text-danger">Rp {{ number_format($totalDenda ?? 0, 0, ',', '.') }}</h3>
                <small class="text-muted">Tagihan denda keterlambatan</small>
            </div>
        </div>
    </div>

    <!-- Petunjuk Singkat Penggunaan -->
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4 d-flex align-items-center gap-3">
                    <div class="bg-primary-subtle text-primary-emphasis p-3 rounded-3 fs-3">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Pengajuan Peminjaman</h6>
                        <p class="text-body-secondary small mb-0">Klik tombol di atas untuk mengisi formulir alat yang ingin kamu pinjam.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4 d-flex align-items-center gap-3">
                    <div class="bg-success-subtle text-success-emphasis p-3 rounded-3 fs-3">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Pantau Status & Riwayat</h6>
                        <p class="text-body-secondary small mb-0">Buka menu Riwayat di navigasi untuk melihat status persetujuan alatmu.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
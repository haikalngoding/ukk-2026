@extends('layouts.app')

@section('title', config('app.name', 'PINVERA') . ' -- Peminjaman Alat Olahraga')

@section('content')
<style>
    .welcome-fullscreen-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100vw;
        min-height: 100vh;
        background-color: var(--bs-body-bg);
        z-index: 9999;
        overflow-x: hidden;
    }

  
    .ambient-sports-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none; 
        z-index: 0;
        overflow: hidden;
        opacity: 0.12; 
    }

    @keyframes slowBatSwing {
        0% { transform: rotate(0deg); }
        30% { transform: rotate(-25deg); }
        45% { transform: rotate(15deg); }
        65% { transform: rotate(0deg); }
        100% { transform: rotate(0deg); }
    }

   
    @keyframes slowBallShoot {
        0% { transform: translateX(0) translateY(0) scale(1); opacity: 1; }
        30% { transform: translateX(-15px) translateY(10px) scale(0.9); opacity: 1; }
        45% { transform: translateX(180px) translateY(-60px) scale(1.5); opacity: 0; }
        46% { opacity: 0; }
        100% { transform: translateX(0) translateY(0) scale(1); opacity: 1; }
    }

    .anim-bat-bg {
        font-size: 10rem;
        position: absolute;
        right: -10%;
        bottom: -20%;
        transform-origin: bottom right;
        animation: slowBatSwing 8s cubic-bezier(0.4, 0, 0.2, 1) infinite;
    }

    .anim-ball-bg {
        font-size: 3rem;
        position: absolute;
        right: 40%;
        bottom: 20%;
        animation: slowBallShoot 8s cubic-bezier(0.4, 0, 0.2, 1) infinite;
    }

   
    .card-content-front {
        position: relative;
        z-index: 1;
    }
</style>

<div class="welcome-fullscreen-overlay">
    
   
    <nav class="navbar navbar-expand-lg bg-body border-bottom sticky-top py-3 px-4 px-lg-5">
        <div class="container-fluid px-0">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2 text-body text-decoration-none" href="#">
                <i class="bi bi-trophy-fill text-primary fs-4"></i>
                <span>{{ config('app.name', 'PINVERA') }}</span>
            </a>
            
            <div class="d-flex align-items-center gap-2">
                @php 
                    $currentUser = \App\Models\User::current(); 
                @endphp
                
                @if($currentUser)
                    <a href="{{ route('dashboard') }}" class="btn btn-primary px-4 fw-semibold rounded-pill">
                        <i class="bi bi-speedometer2 me-1"></i> Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary px-3 fw-semibold rounded-pill">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-primary px-3 fw-semibold rounded-pill">Daftar</a>
                @endif
            </div>
        </div>
    </nav>

   
    <section class="pt-4 pb-5 px-4 px-lg-5">
        <div class="container-fluid px-0">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 text-start">
                    <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-medium mb-3 border border-primary-subtle">
                        <i class="bi bi-award me-1"></i> Sistem Peminjaman Alat Olahraga
                    </span>
                    
                    <h1 class="display-10 fw-bold text-body mb-4 lh-sm">
                        Selamat Datang Di Peminjaman Alat Olahraga Lebih <span class="text-primary">Sportif & Terstruktur</span>.
                    </h1>
                    
                    <p class="text-body-secondary fs-6 mb-4 lh-base">
                        Platform digital resmi untuk memantau inventaris fasilitas olahraga, dan perlengkapan secara mandiri, serta melacak pengembalian secara <em>real-time</em>.
                    </p>

                   
                    <div class="d-flex align-items-center gap-3 mb-4 p-3 rounded-3 bg-body-tertiary border border-opacity-10" style="max-width: 440px;">
                        <i class="bi bi-check2-circle text-primary fs-2"></i>
                        <div class="small text-body-secondary">
                            <span class="fw-semibold text-body d-block">Perlengkapan Olahraga Siap Pakai</span>
                            <span>Aksi peminjaman alat olahraga terpantau akurat.</span>
                        </div>
                    </div>
                    
                    <div class="d-flex flex-wrap gap-3">
                        @if($currentUser)
                            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-5 fw-semibold rounded-pill shadow-sm">
                                Buka Dashboard <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 fw-semibold rounded-pill shadow-sm">
                                Mulai Sekarang <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                            <a href="#panduan" class="btn btn-outline-secondary btn-lg px-4 fw-semibold rounded-pill">
                                Cara Penggunaan
                            </a>
                        @endif
                    </div>
                </div>
                
                <div class="col-lg-6">
                    
                    <div class="card border-0 shadow-sm rounded-4 bg-body-tertiary p-4 border border-opacity-10 w-100 position-relative overflow-hidden">
                        
                       
                        <div class="ambient-sports-bg">
                            <div class="anim-ball-bg">⚾</div>
                            <div class="anim-bat-bg">🏏</div>
                        </div>

                       
                        <div class="card-content-front">
                            <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom border-opacity-10">
                                <h5 class="fw-bold mb-0 text-body fs-6">Status Inventaris Olahraga</h5>
                                <span class="badge bg-success-subtle text-success px-2.5 py-1 rounded-pill small">
                                    <i class="bi bi-circle-fill me-1" style="font-size: 6px;"></i> Ready to Play
                                </span>
                            </div>
                            
                            <div class="d-flex flex-column gap-3">
                                <div class="p-3 rounded-3 bg-body border border-opacity-10 d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-primary-subtle text-primary rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="bi bi-people-fill fs-5"></i>
                                        </div>
                                        <div>
                                            <span class="text-body-secondary d-block small">Hak Akses</span>
                                            <span class="fw-semibold text-body fs-7">Admin, Petugas, & Siswa/Peminjam</span>
                                        </div>
                                    </div>
                                    <span class="badge bg-primary text-white">3 Role</span>
                                </div>

                                <div class="p-3 rounded-3 bg-body border border-opacity-10 d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-success-subtle text-success rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="bi bi-shield-check fs-5"></i>
                                        </div>
                                        <div>
                                            <span class="text-body-secondary d-block small">Keamanan Sistem</span>
                                            <span class="fw-semibold text-body fs-7">Log Aktifitas & Riwayat Transaksi</span>
                                        </div>
                                    </div>
                                    <span class="badge bg-success text-white">Aktif</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   
    <section id="panduan" class="py-5 bg-body-tertiary border-top border-opacity-10 px-4 px-lg-5">
        <div class="container-fluid px-0 py-4">
            <div class="text-center mb-5">
                <span class="text-primary fw-semibold small text-uppercase tracking-wider">Panduan Sistem</span>
                <h2 class="fw-bold text-body mt-1">Cara Penggunaan Aplikasi</h2>
                <p class="text-body-secondary" style="max-width: 600px; margin: 0 auto;">
                    Ikuti langkah mudah di bawah ini untuk mulai meminjam perlengkapan olahraga.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 bg-body p-4 h-100 border border-opacity-10">
                        <div class="bg-primary text-white rounded-3 p-3 d-inline-flex align-items-center justify-content-center mb-3 shadow-xs" style="width: 44px; height: 44px;">
                            <span class="fw-bold fs-5">1</span>
                        </div>
                        <h4 class="fw-bold fs-5 text-body mb-2">Login / Registrasi Akun</h4>
                        <p class="text-body-secondary small mb-0 lh-base">
                            Masuk ke aplikasi atau daftar akun baru sebagai siswa/peminjam. Admin dan petugas juga dapat login melalui akun khusus mereka.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 bg-body p-4 h-100 border border-opacity-10">
                        <div class="bg-primary text-white rounded-3 p-3 d-inline-flex align-items-center justify-content-center mb-3 shadow-xs" style="width: 44px; height: 44px;">
                            <span class="fw-bold fs-5">2</span>
                        </div>
                        <h4 class="fw-bold fs-5 text-body mb-2">Ajukan Pinjam Alat</h4>
                        <p class="text-body-secondary small mb-0 lh-base">
                            Pilih perlengkapan olahraga yang ingin dipinjam (seperti bola kasti atau tongkat) dan ajukan permohonan untuk diverifikasi petugas.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 bg-body p-4 h-100 border border-opacity-10">
                        <div class="bg-primary text-white rounded-3 p-3 d-inline-flex align-items-center justify-content-center mb-3 shadow-xs" style="width: 44px; height: 44px;">
                            <span class="fw-bold fs-5">3</span>
                        </div>
                        <h4 class="fw-bold fs-5 text-body mb-2">Pengembalian & Log</h4>
                        <p class="text-body-secondary small mb-0 lh-base">
                            Setelah selesai berolahraga, kembalikan alat tepat waktu. Semua aktivitas peminjaman dan pengembalian akan otomatis tercatat di Log Aktifitas.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4 bg-body border-top border-opacity-10 text-center px-4 px-lg-5">
        <div class="container-fluid px-0">
            <p class="text-body-secondary small mb-0">
                &copy; {{ date('Y') }} <strong>PINVERA</strong>. Sistem Peminjaman Alat Olahraga Berbasis Sakuci Framework.
            </p>
        </div>
    </footer>

</div>
@endsection
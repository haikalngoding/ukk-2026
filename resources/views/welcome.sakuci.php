@extends('layouts.app')

@section('title', config('app.name', 'PINVERA') . ' — Peminjaman Alat Olahraga Modern')

@section('content')
<style>
    /* Dynamic Theme Styles */
    .welcome-fullscreen-overlay {
        position: relative;
        min-height: 100vh;
        background: var(--bs-body-bg);
        color: var(--bs-body-color);
        transition: background-color 0.3s ease, color 0.3s ease;
        overflow-x: hidden;
    }

    .hero-bg-gradient {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 10% 20%, rgba(13, 110, 253, 0.08) 0%, transparent 50%);
        pointer-events: none;
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
        opacity: 0.1;
    }

    @keyframes floatSlow {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(10deg); }
    }

    .anim-float-1 {
        font-size: 8rem;
        position: absolute;
        right: 5%;
        top: 10%;
        animation: floatSlow 7s ease-in-out infinite;
    }

    .anim-float-2 {
        font-size: 6rem;
        position: absolute;
        left: 2%;
        bottom: 15%;
        animation: floatSlow 9s ease-in-out infinite 1s;
    }

    /* Glassmorphism Responsive to Themes */
    .glass-card {
        background: rgba(var(--bs-body-bg-rgb), 0.75);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border: 1px solid var(--bs-border-color-translucent);
    }

    .hover-lift {
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-6px);
        box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.15) !important;
    }

    .step-number {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.2rem;
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="welcome-fullscreen-overlay">
    <div class="hero-bg-gradient"></div>

    {{-- Navigation Bar --}}
    <nav class="navbar navbar-expand-lg glass-card sticky-top py-3 px-4 px-lg-5 shadow-sm">
        <div class="container-fluid px-0">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2 text-body text-decoration-none" href="#">
                <div class="bg-primary text-white rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                    <i class="bi bi-trophy-fill fs-5"></i>
                </div>
                <span class="fs-4">{{ config('app.name', 'PINVERA') }}</span>
            </a>
            
            <div class="d-flex align-items-center gap-3">
                {{-- Theme Switcher Button --}}
                <button class="btn btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center p-2" id="btnThemeToggle" type="button" style="width: 38px; height: 38px;" title="Ganti Mode Tema">
                    <i class="bi bi-sun-fill" id="themeIcon"></i>
                </button>

                @php 
                    $currentUser = class_exists('\App\Models\User') && method_exists('\App\Models\User', 'current') 
                        ? \App\Models\User::current() 
                        : auth()->user(); 
                @endphp
                
                @if($currentUser)
                    <a href="{{ route('dashboard') }}" class="btn btn-primary px-4 py-2 fw-semibold rounded-pill shadow-sm">
                        <i class="bi bi-speedometer2 me-1"></i> Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-link text-decoration-none text-body fw-semibold px-3">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-primary px-4 py-2 fw-semibold rounded-pill shadow-sm">Daftar Akun</a>
                @endif
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="pt-5 pb-5 px-4 px-lg-5 position-relative">
        <div class="ambient-sports-bg">
            <div class="anim-float-1">🏀</div>
            <div class="anim-float-2">⚽</div>
        </div>

        <div class="container-fluid px-0">
            <div class="row align-items-center g-5 py-lg-4">
                <div class="col-lg-6 text-start position-relative z-1">
                    <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold mb-3 border border-primary-subtle d-inline-flex align-items-center gap-2">
                        <i class="bi bi-lightning-charge-fill"></i> Sistem Olahraga Mandiri & Terintegrasi
                    </span>
                    
                    <h1 class="display-4 fw-bold text-body mb-4 lh-sm">
                        Pinjam Peralatan Olahraga Jadi <span class="text-primary">Cepat, Praktis & Transparan</span>.
                    </h1>
                    
                    <p class="text-body-secondary fs-5 mb-4 lh-base" style="max-width: 540px;">
                        Pantau ketersediaan inventaris raket, bola, hingga perlengkapan lapangan secara <em>real-time</em>.
                    </p>

                    <div class="d-flex flex-wrap gap-3 mb-5">
                        @if($currentUser)
                            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-4 py-3 fw-semibold rounded-pill shadow">
                                Buka Dashboard <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 py-3 fw-semibold rounded-pill shadow">
                                Mulai Pinjam Sekarang <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                            <a href="#panduan" class="btn btn-outline-secondary btn-lg px-4 py-3 fw-semibold rounded-pill">
                                Lihat Panduan
                            </a>
                        @endif
                    </div>

                    <div class="row g-3 pt-3 border-top border-translucent">
                        <div class="col-4">
                            <h3 class="fw-bold mb-0 text-body">100%</h3>
                            <small class="text-body-secondary">Terorganisir</small>
                        </div>
                        <div class="col-4">
                            <h3 class="fw-bold mb-0 text-body">Real-Time</h3>
                            <small class="text-body-secondary">Lacak Status</small>
                        </div>
                        <div class="col-4">
                            <h3 class="fw-bold mb-0 text-body">3 Role</h3>
                            <small class="text-body-secondary">Akses Terkontrol</small>
                        </div>
                    </div>
                </div>
                
                {{-- Hero Visual Card --}}
                <div class="col-lg-6 position-relative z-1">
                    <div class="card border-0 shadow-lg rounded-5 glass-card p-4 p-md-5 position-relative overflow-hidden">
                        <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom border-translucent">
                            <div>
                                <h5 class="fw-bold mb-1 text-body">Katalog Peralatan Favorit</h5>
                                <p class="text-body-secondary small mb-0">Status ketersediaan inventaris terkini</p>
                            </div>
                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill small fw-semibold">
                                Update Otomatis
                            </span>
                        </div>
                        
                        <div class="d-flex flex-column gap-3" id="katalog-list">
                            <div class="p-3 rounded-4 bg-body-tertiary hover-lift border border-translucent d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-warning-subtle rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; font-size: 1.4rem;">
                                        🏸
                                    </div>
                                    <div>
                                        <h6 class="fw-semibold text-body mb-0">Set Raket Badminton</h6>
                                        <small class="text-body-secondary">Yonex Carbonex • 12 Set Tersedia</small>
                                    </div>
                                </div>
                                <span class="badge bg-success text-white px-3 py-2 rounded-pill">Ready</span>
                            </div>

                            <div class="p-3 rounded-4 bg-body-tertiary hover-lift border border-translucent d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-danger-subtle rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; font-size: 1.4rem;">
                                        ⚽
                                    </div>
                                    <div>
                                        <h6 class="fw-semibold text-body mb-0">Bola Futsal Specs</h6>
                                        <small class="text-body-secondary">Size 4 • 5 Bola Tersedia</small>
                                    </div>
                                </div>
                                <span class="badge bg-success text-white px-3 py-2 rounded-pill">Ready</span>
                            </div>

                            <div class="p-3 rounded-4 bg-body-tertiary hover-lift border border-translucent d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-primary-subtle rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; font-size: 1.4rem;">
                                        ⚾
                                    </div>
                                    <div>
                                        <h6 class="fw-semibold text-body mb-0">Perlengkapan Kasti</h6>
                                        <small class="text-body-secondary">Kayu Pemukul & Bola • 3 Set</small>
                                    </div>
                                </div>
                                <span class="badge bg-success text-white px-3 py-2 rounded-pill">Ready</span>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 text-center border-top border-translucent">
                            <small class="text-body-secondary d-flex align-items-center justify-content-center gap-1">
                                <i class="bi bi-shield-check text-primary"></i> Seluruh peminjaman dicatat resmi pada Log Aktivitas Sistem
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- How It Works Section --}}
    <section id="panduan" class="py-5 bg-body-tertiary border-top border-translucent px-4 px-lg-5">
        <div class="container-fluid px-0 py-4">
            <div class="text-center mb-5">
                <span class="text-primary fw-bold text-uppercase tracking-wider small">Alur Peminjaman</span>
                <h2 class="fw-bold text-body mt-1">3 Langkah Mudah Berolahraga</h2>
                <p class="text-body-secondary" style="max-width: 580px; margin: 0 auto;">
                    Sistem dirancang intuitif agar siswa, petugas, dan admin dapat mengelola transaksi barang tanpa hambatan.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 bg-body p-4 h-100 hover-lift border border-translucent">
                        <div class="step-number bg-primary-subtle text-primary mb-4">
                            01
                        </div>
                        <h4 class="fw-bold fs-5 text-body mb-2">Masuk ke Akun</h4>
                        <p class="text-body-secondary small mb-0 lh-base">
                            Lakukan login sebagai siswa/peminjam. Petugas dan Admin dapat menggunakan hak akses khusus untuk verifikasi inventaris.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 bg-body p-4 h-100 hover-lift border border-translucent">
                        <div class="step-number bg-primary text-white mb-4 shadow-sm">
                            02
                        </div>
                        <h4 class="fw-bold fs-5 text-body mb-2">Pilih & Ajukan Alat</h4>
                        <p class="text-body-secondary small mb-0 lh-base">
                            Cari alat olahraga yang ingin kamu gunakan, tentukan durasi peminjaman, dan kirimkan pengajuan langsung lewat sistem.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 bg-body p-4 h-100 hover-lift border border-translucent">
                        <div class="step-number bg-primary-subtle text-primary mb-4">
                            03
                        </div>
                        <h4 class="fw-bold fs-5 text-body mb-2">Gunakan & Kembalikan</h4>
                        <p class="text-body-secondary small mb-0 lh-base">
                            Ambil alat di ruang inventaris. Setelah selesai, kembalikan tepat waktu untuk memperbarui Log Riwayat secara otomatis.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="py-4 bg-body border-top border-translucent text-center px-4 px-lg-5">
        <div class="container-fluid px-0 d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
            <p class="text-body-secondary small mb-0">
                &copy; {{ date('Y') }} <strong>{{ config('app.name', 'PINVERA') }}</strong>. Developed with Sakuci Framework.
            </p>
        </div>
    </footer>

</div>

{{-- Script Toggle Theme --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const themeToggleBtn = document.getElementById('btnThemeToggle');
        const themeIcon = document.getElementById('themeIcon');
        
        // Ambil preferensi dari localStorage atau preferensi OS
        const getPreferredTheme = () => {
            const storedTheme = localStorage.getItem('theme');
            if (storedTheme) {
                return storedTheme;
            }
            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        };

        const setTheme = (theme) => {
            document.documentElement.setAttribute('data-bs-theme', theme);
            localStorage.setItem('theme', theme);
            
            if (theme === 'dark') {
                themeIcon.classList.remove('bi-sun-fill');
                themeIcon.classList.add('bi-moon-stars-fill');
            } else {
                themeIcon.classList.remove('bi-moon-stars-fill');
                themeIcon.classList.add('bi-sun-fill');
            }
        };

        // Inisialisasi tema saat pertama kali muat
        setTheme(getPreferredTheme());

        // Event listener saat tombol diklik
        themeToggleBtn.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            setTheme(newTheme);
        });
    });
</script>
@endsection
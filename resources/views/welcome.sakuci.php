@extends('layouts.app')

@section('title', config('app.name', 'GoPENA') . ' — Peminjaman Alat Olahraga Modern')

@section('content')
<style>
    .welcome-fullscreen-overlay {
        position: relative;
        min-height: 100vh;
        background-color: var(--bs-body-bg);
        color: var(--bs-body-color);
        transition: background-color 0.3s ease, color 0.3s ease;
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

    .glass-card {
        background: rgba(var(--bs-body-bg-rgb), 0.85);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid var(--bs-border-color);
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

    .nav-pills .nav-link {
        color: var(--bs-body-color);
        border-radius: 50rem;
        font-weight: 600;
    }
    .nav-pills .nav-link.active {
        background-color: var(--bs-primary);
        color: #fff;
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="welcome-fullscreen-overlay">

    {{-- Hero Section --}}
    <section class="pt-5 pb-5 px-4 px-lg-5 position-relative">
        <div class="ambient-sports-bg">
            <div class="anim-float-1">🏀</div>
            <div class="anim-float-2">⚽</div>
        </div>

        <div class="container-fluid px-0">
            <div class="row align-items-center g-5 py-lg-3">
                
                {{-- Kiri: Brand & Deskripsi --}}
                <div class="col-lg-6 text-start position-relative z-1">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="bg-primary text-white rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <i class="bi bi-trophy-fill fs-4"></i>
                        </div>
                        <span class="fs-3 fw-bold text-body">{{ config('app.name', 'PINVERA') }}</span>
                    </div>

                    <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold mb-3 border border-primary-subtle d-inline-flex align-items-center gap-2">
                        <i class="bi bi-lightning-charge-fill"></i> Sistem Olahraga Mandiri & Terintegrasi
                    </span>
                    
                    <h1 class="display-4 fw-bold text-body mb-4 lh-sm">
                        Pinjam Peralatan Olahraga Jadi <span class="text-primary">Cepat, Praktis & Transparan</span>.
                    </h1>
                    
                    <p class="text-body-secondary fs-5 mb-4 lh-base" style="max-width: 540px;">
                        Pantau ketersediaan inventaris raket, bola, hingga perlengkapan lapangan secara <em>real-time</em>.
                    </p>

                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <a href="#katalog-section" class="btn btn-outline-primary btn-lg px-4 py-2.5 fw-semibold rounded-pill">
                            Lihat Katalog Real-Time <i class="bi bi-arrow-down ms-1"></i>
                        </a>
                        <a href="#panduan" class="btn btn-link text-decoration-none text-body-secondary btn-lg px-3 py-2.5">
                            Panduan Peminjaman
                        </a>
                    </div>

                    <div class="row g-3 pt-3 border-top border-secondary-subtle">
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
                
                {{-- Kanan: Form Auth / Dashboard Status Sidebar --}}
                <div class="col-lg-6 position-relative z-1">
                    <div class="card border border-secondary-subtle shadow-lg rounded-5 glass-card p-4 p-md-4 position-relative overflow-hidden">
                        
                        @php 
                            $currentUser = class_exists('\App\Models\User') && method_exists('\App\Models\User', 'current') 
                                ? \App\Models\User::current() 
                                : auth()->user(); 
                        @endphp

                        @if($currentUser)
                            <div class="text-center py-4">
                                <div class="bg-primary-subtle text-primary rounded-circle p-3 d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                                    <i class="bi bi-person-check-fill fs-1"></i>
                                </div>
                                <h4 class="fw-bold text-body mb-1">Selamat Datang Kembali!</h4>
                                <p class="text-body-secondary mb-4">{{ $currentUser->name ?? $currentUser->username ?? 'Pengguna' }}</p>
                                
                                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-5 py-3 fw-semibold rounded-pill shadow w-100 mb-2">
                                    <i class="bi bi-speedometer2 me-2"></i> Buka Dashboard
                                </a>
                            </div>
                        @else
                            <ul class="nav nav-pills nav-justified mb-4 p-1 bg-body-tertiary rounded-pill border border-secondary-subtle" id="authTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active py-2" id="login-tab" data-bs-toggle="pill" data-bs-target="#login-pane" type="button" role="tab">
                                        <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link py-2" id="register-tab" data-bs-toggle="pill" data-bs-target="#register-pane" type="button" role="tab">
                                        <i class="bi bi-person-plus me-1"></i> Daftar
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content" id="authTabContent">
                                <div class="tab-pane fade show active" id="login-pane" role="tabpanel">
                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label small fw-semibold text-body">Username / Email</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-body-tertiary border-secondary-subtle"><i class="bi bi-person"></i></span>
                                                <input type="text" name="username" class="form-control border-secondary-subtle" placeholder="Masukkan username" required>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label small fw-semibold text-body">Kata Sandi</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-body-tertiary border-secondary-subtle"><i class="bi bi-lock"></i></span>
                                                <input type="password" name="password" class="form-control border-secondary-subtle" placeholder="••••••••" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-lg w-100 fw-semibold rounded-pill shadow-sm">
                                            Masuk ke Akun <i class="bi bi-arrow-right ms-1"></i>
                                        </button>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="register-pane" role="tabpanel">
                                    <form action="{{ route('register') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label small fw-semibold text-body">Nama Lengkap</label>
                                            <input type="text" name="name" class="form-control border-secondary-subtle" placeholder="Nama Anda" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-semibold text-body">Username</label>
                                            <input type="text" name="username" class="form-control border-secondary-subtle" placeholder="Username unik" required>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label small fw-semibold text-body">Kata Sandi</label>
                                            <input type="password" name="password" class="form-control border-secondary-subtle" placeholder="••••••••" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-lg w-100 fw-semibold rounded-pill shadow-sm">
                                            Buat Akun Baru <i class="bi bi-check-circle ms-1"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Real-Time Catalog Section --}}
    <section id="katalog-section" class="py-5 bg-body-tertiary border-top border-secondary-subtle px-4 px-lg-5">
        <div class="container-fluid px-0">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <span class="text-primary fw-bold text-uppercase tracking-wider small">Inventaris Terkini</span>
                    <h3 class="fw-bold text-body mb-0">Status Peralatan Olahraga</h3>
                </div>
                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill small fw-semibold">
                    <i class="bi bi-record-fill me-1"></i> Live Updates
                </span>
            </div>

            {{-- Container Katalog Real-Time --}}
            <div id="katalog-realtime" class="row g-3">
                <div class="col-12 text-center py-4 text-body-secondary">
                    <div class="spinner-border spinner-border-sm text-primary me-2" role="status"></div>
                    Memuat data inventaris...
                </div>
            </div>
        </div>
    </section>

    {{-- How It Works Section --}}
    <section id="panduan" class="py-5 px-4 px-lg-5">
        <div class="container-fluid px-0 py-2">
            <div class="text-center mb-5">
                <span class="text-primary fw-bold text-uppercase tracking-wider small">Alur Peminjaman</span>
                <h2 class="fw-bold text-body mt-1">3 Langkah Mudah Berolahraga</h2>
                <p class="text-body-secondary" style="max-width: 580px; margin: 0 auto;">
                    Sistem dirancang intuitif agar siswa, petugas, dan admin dapat mengelola transaksi barang tanpa hambatan.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-secondary-subtle shadow-sm rounded-4 bg-body p-4 h-100 hover-lift">
                        <div class="step-number bg-primary-subtle text-primary mb-4 border border-primary-subtle">01</div>
                        <h4 class="fw-bold fs-5 text-body mb-2">Masuk ke Akun</h4>
                        <p class="text-body-secondary small mb-0 lh-base">
                            Lakukan login sebagai siswa/peminjam melalui form di atas. Petugas dan Admin juga login lewat form tersebut.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-secondary-subtle shadow-sm rounded-4 bg-body p-4 h-100 hover-lift">
                        <div class="step-number bg-primary text-white mb-4 shadow-sm">02</div>
                        <h4 class="fw-bold fs-5 text-body mb-2">Pilih & Ajukan Alat</h4>
                        <p class="text-body-secondary small mb-0 lh-base">
                            Cari alat olahraga yang ingin kamu gunakan, tentukan durasi peminjaman, dan kirimkan pengajuan langsung lewat sistem.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-secondary-subtle shadow-sm rounded-4 bg-body p-4 h-100 hover-lift">
                        <div class="step-number bg-primary-subtle text-primary mb-4 border border-primary-subtle">03</div>
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
    <footer class="py-4 bg-body border-top border-secondary-subtle text-center px-4 px-lg-5">
        <div class="container-fluid px-0 d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
            <p class="text-body-secondary small mb-0">
                &copy; {{ date('Y') }} <strong>{{ config('app.name', 'PINVERA') }}</strong>. Developed with Sakuci Framework.
            </p>
        </div>
    </footer>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // 1. Deteksi & Set Mode Gelap/Terang
    (function () {
        const storedTheme = localStorage.getItem('theme');
        if (storedTheme) {
            document.documentElement.setAttribute('data-bs-theme', storedTheme);
        } else {
            const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            document.documentElement.setAttribute('data-bs-theme', systemPrefersDark ? 'dark' : 'light');
        }
    })();

    // 2. Fetch Data Real-Time (Perbaikan Penanganan Response)
    function loadKatalogRealtime() {
        const container = document.getElementById('katalog-realtime');
        if (!container) return;

        fetch("{{ route('api.katalog.alat') }}")
            .then(response => {
                if (!response.ok) {
                    throw new Error("HTTP error " + response.status);
                }
                return response.json();
            })
            .then(resData => {
                // Ekstrak data jika dikembalikan dalam bentuk objek wrapper { data: [...] } atau array langsung
                let items = [];
                if (Array.isArray(resData)) {
                    items = resData;
                } else if (resData && Array.isArray(resData.data)) {
                    items = resData.data;
                }

                if (items.length === 0) {
                    container.innerHTML = `<div class="col-12 text-center py-4 text-body-secondary"><i class="bi bi-inbox fs-3 d-block mb-1"></i>Belum ada data peralatan olahraga.</div>`;
                    return;
                }

                let html = '';
                items.forEach(item => {
                    const nama = item.nama_alat || item.nama || item.name || 'Alat Olahraga';
                    const stok = item.stok !== undefined ? item.stok : (item.stok_alat !== undefined ? item.stok_alat : (item.stock || 0));
                    const deskripsi = item.kategori || item.deskripsi || item.description || 'Peralatan Siap Pakai';

                    const isReady = Number(stok) > 0;
                    const badgeClass = isReady ? 'bg-success text-white' : 'bg-danger text-white';
                    const statusText = isReady ? `Ready (${stok})` : 'Habis';

                    html += `
                        <div class="col-md-6 col-lg-4">
                            <div class="p-3 rounded-4 bg-body hover-lift border border-secondary-subtle d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-primary-subtle text-primary rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; font-size: 1.3rem;">
                                        ⚽
                                    </div>
                                    <div>
                                        <h6 class="fw-semibold text-body mb-0">${nama}</h6>
                                        <small class="text-body-secondary">${deskripsi}</small>
                                    </div>
                                </div>
                                <span class="badge ${badgeClass} px-3 py-2 rounded-pill">${statusText}</span>
                            </div>
                        </div>
                    `;
                });

                container.innerHTML = html;
            })
            .catch(error => {
                console.error("Gagal memuat katalog:", error);
                container.innerHTML = `<div class="col-12 text-center py-4 text-danger"><i class="bi bi-exclamation-circle me-1"></i>Gagal memuat data inventaris. Pastikan route API terdaftar.</div>`;
            });
    }

    document.addEventListener('DOMContentLoaded', () => {
        loadKatalogRealtime();
        setInterval(loadKatalogRealtime, 4000);
    });
</script>
@endsection
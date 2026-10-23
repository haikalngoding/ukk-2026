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
                        <span class="fs-3 fw-bold text-body">{{ config('app.name', 'GoPENA') }}</span>
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
    @php 
        $currentUser = class_exists('\App\Models\User') && method_exists('\App\Models\User', 'current') 
            ? \App\Models\User::current() 
            : auth()->user(); 
    @endphp

    <!-- Pengecekan dipindah ke sini, agar Card tidak digambar jika belum login -->
    @if($currentUser)
        <div class="card border border-secondary-subtle shadow-lg rounded-5 glass-card p-4 p-md-4 position-relative overflow-hidden">
            <div class="text-center py-4">
                <div class="bg-primary-subtle text-primary rounded-circle p-3 d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                    <i class="bi bi-person-check-fill fs-1"></i>
                </div>
                <h4 class="fw-bold text-body mb-1">Selamat Datang Kembali!</h4>
                <p class="text-body-secondary mb-4">{{ $currentUser->name ?? $currentUser->username ?? 'Pengguna' }}</p>
                
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-lg px-5 py-3 fw-semibold rounded-pill shadow w-100 mb-2">
                    <i class="bi bi-speedometer2 me-2"></i> Buka Dashboard
                </a>
            </div>
        </div>
    @endif
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
                        <div class="step-number bg-primary-subtle text-primary mb-4 border border-primary-subtle">02</div>
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

    // 2. Fetch Data (Versi Debugging Paksa)
    function loadKatalogRealtime() {
        const container = document.getElementById('katalog-realtime');
        if (!container) return;

        container.innerHTML = `<div class="col-12 text-center py-4 text-warning">Sedang mencoba menarik data API...</div>`;

        // Gunakan relative path agar kebal terhadap bentrok HTTP / HTTPS
        fetch("/api/katalog-alat")
            .then(response => {
                if (!response.ok) throw new Error("HTTP Status: " + response.status);
                return response.text(); // Tarik sebagai teks mentah dulu
            })
            .then(textData => {
                let data;
                try {
                    data = JSON.parse(textData); // Coba jadikan JSON
                } catch (e) {
                    // Jika gagal jadi JSON, tampilkan teks aslinya di layar
                    container.innerHTML = `<div class="col-12 alert alert-danger"><b>Error Parsing JSON:</b><br>${textData.substring(0, 150)}...</div>`;
                    return;
                }

                // Normalisasi Data
                let items = [];
                if (Array.isArray(data)) {
                    items = data;
                } else if (data && typeof data === 'object') {
                    // Jika dibungkus objek
                    items = data.data || data.alat || Object.values(data);
                }

                if (!Array.isArray(items) || items.length === 0) {
                    container.innerHTML = `<div class="col-12 alert alert-warning">Data kosong atau format tidak sesuai. Isi raw data: ${JSON.stringify(data).substring(0, 100)}</div>`;
                    return;
                }

                // Jika berhasil, render HTML
                let html = '';
                // Fungsi untuk menentukan ikon berdasarkan nama alat
function tentukanIkon(namaAlat) {
    const nama = namaAlat.toLowerCase();
    
    if (nama.includes('basket')) return '🏀';
    if (nama.includes('voli') || nama.includes('volley')) return '🏐';
    if (nama.includes('raket') || nama.includes('badminton') || nama.includes('shuttlecock')) return '🏸';
    if (nama.includes('tenis') || nama.includes('tennis')) return '🎾';
    if (nama.includes('pingpong') || nama.includes('meja')) return '🏓';
    if (nama.includes('sepak') || nama.includes('futsal')) return '⚽';
    if (nama.includes('sapu')) return '🧹';
    if (nama.includes('gawang') || nama.includes('jaring')) return '🥅';
    
    // Ikon default jika nama alat tidak dikenali
    return '📦'; 
}
items.forEach(item => { 
    
    const nama = item.nama_alat || item.nama || item.name || 'Alat Olahraga';
    
    // Baris ini sudah disederhanakan dan langsung membaca kolom 'stok' dari database
    const stok = item.stok !== undefined ? item.stok : 0;
    
    const isReady = Number(stok) > 0;
    const badgeClass = isReady ? 'bg-success text-white' : 'bg-danger text-white';
    const statusText = isReady ? `Ready (${stok})` : 'Habis';

                    html += `
                        <div class="col-md-6 col-lg-4">
                            <div class="p-3 rounded-4 bg-body hover-lift border border-secondary-subtle d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-primary-subtle text-primary rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; font-size: 1.3rem;">⚽</div>
                                    <div>
                                        <h6 class="fw-semibold text-body mb-0">${nama}</h6>
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
                container.innerHTML = `<div class="col-12 alert alert-danger"><b>Gagal Fetch:</b> ${error.message}</div>`;
            });
    }

    document.addEventListener('DOMContentLoaded', () => {
        loadKatalogRealtime();
        // Set interval dimatikan sementara agar pesan error tidak kedap-kedip
    });
</script>
@endsection
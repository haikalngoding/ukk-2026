@extends('layouts.app')

@section('title', 'GoPENA - Sistem Peminjaman Inventaris Alat Sekolah')

@section('content')
<style>
    /* Styling Khusus untuk Mempercantik Tampilan GoPENA */
    .hero-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 24px;
        background: linear-gradient(135deg, rgba(13, 110, 253, 0.05) 0%, rgba(13, 110, 253, 0.01) 100%);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .badge-glow {
        box-shadow: 0 0 15px rgba(13, 110, 253, 0.2);
        letter-spacing: 0.5px;
    }

    .text-gradient {
        background: linear-gradient(45deg, #0d6efd, #0dcaf0);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .feature-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.06);
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08) !important;
    }

    .icon-box {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
    }
</style>

<div class="container py-4 py-lg-5">
    {{-- Hero Section --}}
    <section class="hero-wrapper p-4 p-md-5 mb-5">
        <div class="row align-items-center gy-4">
            <div class="col-lg-7 text-start">
                <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2 mb-3 badge-glow">
                    🚀 Powered by Sakuci v1.0.0
                </span>

                <h1 class="display-4 fw-extrabold mb-3 lh-sm">
                    Pinjam Alat Sekolah <br class="d-none d-md-inline">
                    Jadi Lebih <span class="text-gradient">Cepat & Cerdas</span>
                </h1>

                <p class="lead text-secondary mb-4" style="max-width: 600px;">
                    <strong>GoPENA</strong> (Garda Peminjaman Inventaris Alat) mempermudah siswa dan guru dalam memantau, meminjam, dan mengembalikan peralatan sekolah secara *real-time*.
                </p>

                <div class="d-flex flex-wrap gap-3 align-items-center">
                    <a class="btn btn-primary btn-lg px-4 py-2-5 shadow-sm fw-semibold" href="{{ route('login') }}">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Masuk / Login
                    </a>
                    <a class="btn btn-outline-secondary btn-lg px-4 py-2-5 fw-semibold" href="https://github.com/indrabsus/sakuci-framework" target="_blank">
                        <i class="bi bi-github me-1"></i> Repositori GitHub
                    </a>
                </div>

                <div class="mt-4 pt-2 text-muted small border-top border-light d-flex align-items-center gap-2">
                    <i class="bi bi-file-code text-primary"></i>
                    <span>Panduan penggunaan lengkap tersedia di file <code class="bg-light px-2 py-1 rounded text-dark">TUTORIAL.md</code></span>
                </div>
            </div>

            {{-- Visual / Preview Card Ilustrasi --}}
            <div class="col-lg-5 d-none d-lg-block">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden bg-white">
                    <div class="card-header bg-dark text-white p-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex gap-1">
                            <span class="rounded-circle bg-danger d-inline-block" style="width: 10px; height: 10px;"></span>
                            <span class="rounded-circle bg-warning d-inline-block" style="width: 10px; height: 10px;"></span>
                            <span class="rounded-circle bg-success d-inline-block" style="width: 10px; height: 10px;"></span>
                        </div>
                        <small class="text-muted font-monospace">gopena-system.local</small>
                    </div>
                    <div class="card-body p-4 text-center">
                        <div class="my-3">
                            <div class="display-1 text-primary"><i class="bi bi-tools"></i></div>
                            <h5 class="fw-bold mt-2">Status Inventaris Realtime</h5>
                            <p class="text-muted small">Cek ketersediaan proyektor, kabel, alat lab, dan barang praktikum dalam satu klik.</p>
                        </div>
                        <div class="p-3 bg-light rounded-3 text-start d-flex justify-content-between align-items-center">
                            <div>
                                <small class="d-block text-muted">Barang Terpinjam Hari Ini</small>
                                <span class="fw-bold text-dark">24 Unit Alat Praktikum</span>
                            </div>
                            <span class="badge bg-success">Aktif</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Highlight Fitur Unggulan --}}
    <section class="py-3">
        <div class="text-center mb-4">
            <h3 class="fw-bold">Mengapa Menggunakan GoPENA?</h3>
            <p class="text-secondary">Kemudahan pengelolaan sarana dan prasarana dalam satu tempat.</p>
        </div>

        <style>
    /* Menghilangkan underline bawaan link dan memastikan cursor menjadi pointer */
    .feature-card-link {
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .feature-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.06);
    }

    /* Efek hover saat card disentuh/diklik */
    .feature-card-link:hover .feature-card {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08) !important;
        border-color: rgba(13, 110, 253, 0.2);
    }

    .icon-box {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
    }
</style>

<div class="row g-4">
    {{-- Card 1: Kelola Kategori --}}
    <div class="col-md-4">
        <a href="{{ route('kategori.index') }}" class="feature-card-link">
            <div class="card h-100 p-3 feature-card rounded-4 bg-white">
                <div class="card-body">
                    <div class="icon-box bg-primary bg-opacity-10 text-primary mb-3">
                        <i class="bi bi-tags-fill fs-4"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Manajemen Kategori</h5>
                    <p class="text-secondary small mb-0">Kelola kelompok dan klasifikasi jenis alat praktikum atau fasilitas sekolah secara terstruktur.</p>
                </div>
            </div>
        </a>
    </div>

    {{-- Card 2: Kelola Alat --}}
    <div class="col-md-4">
        <a href="{{ route('alat.index') }}" class="feature-card-link">
            <div class="card h-100 p-3 feature-card rounded-4 bg-white">
                <div class="card-body">
                    <div class="icon-box bg-success bg-opacity-10 text-success mb-3">
                        <i class="bi bi-tools fs-4"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Manajemen Alat</h5>
                    <p class="text-secondary small mb-0">Pendataan inventaris barang, stok alat yang tersedia, serta pemantauan kondisi alat (baik/rusak).</p>
                </div>
            </div>
        </a>
    </div>

    {{-- Card 3: Kelola Peminjaman --}}
    <div class="col-md-4">
        <a href="{{ route('peminjaman.index') }}" class="feature-card-link">
            <div class="card h-100 p-3 feature-card rounded-4 bg-white">
                <div class="card-body">
                    <div class="icon-box bg-warning bg-opacity-10 text-warning mb-3">
                        <i class="bi bi-arrow-left-right fs-4"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Manajemen Peminjaman</h5>
                    <p class="text-secondary small mb-0">Pencatatan pengajuan pinjam, status persetujuan, jadwal pengembalian, dan riwayat peminjaman.</p>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('title', config('app.name') . ' -- Edit Kategori')

@section('content')
<div class="container-fluid py-4">
    
    <!-- Header Halaman -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-primary-subtle text-primary-emphasis rounded-circle p-2 d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 55px; height: 55px;">
                <i class="bi bi-pencil-square fs-3"></i>
            </div>
            <div>
                <span class="badge bg-body-secondary text-body-secondary rounded-pill px-3 py-1 mb-1 fw-semibold border">Form Edit</span>
                <h3 class="fw-bold mb-0 text-body">Edit Kategori</h3>
                <p class="text-body-secondary mb-0 fs-7">Perbarui informasi data kategori inventaris dengan benar.</p>
            </div>
        </div>
        
        <a href="{{ route('alat.index') }}" class="btn btn-light border shadow-sm rounded-pill px-4 py-2 fw-medium hover-lift d-flex align-items-center gap-2">
            <i class="bi bi-arrow-left"></i> Batal & Kembali
        </a>
    </div>

            <!-- Card Pembungkus Form -->
            <div class="card border-0 shadow-sm rounded-4 position-relative overflow-hidden">
                <!-- Aksen Garis Atas Biru -->
                <div class="position-absolute top-0 start-0 w-100 bg-primary" style="height: 4px;"></div>

                <div class="card-body p-4 p-lg-5">
                    <form action="{{ route('kategori.update', ['id_kategori' => $data->id_kategori]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nama Kategori -->
                        <div class="mb-4">
                            <label for="nama_kategori" class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider">Nama Kategori</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                    <i class="bi bi-tag-fill"></i>
                                </span>
                                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control form-control-lg border-0 bg-body-tertiary fs-6" value="{{ $data->nama_kategori }}" placeholder="Contoh: Alat Olahraga" required>
                            </div>
                        </div>
                        
                        <!-- Kode Kategori -->
                        <div class="mb-4">
                            <label for="kode_kategori" class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider">Kode Kategori</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                    <i class="bi bi-code-square"></i>
                                </span>
                                <input type="text" name="kode_kategori" id="kode_kategori" class="form-control form-control-lg border-0 bg-body-tertiary fs-6" value="{{ $data->kode_kategori }}" placeholder="Contoh: OLG" required>
                            </div>
                        </div>

                        <!-- Keterangan -->
                        <div class="mb-4">
                            <label for="keterangan" class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider">Keterangan</label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                    <i class="bi bi-card-text"></i>
                                </span>
                                <input type="text" name="keterangan" id="keterangan" class="form-control form-control-lg border-0 bg-body-tertiary fs-6" value="{{ $data->keterangan }}" placeholder="Keterangan singkat kategori..." required>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2.5 fw-medium">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 py-2.5 fw-bold shadow-sm hover-lift">
                                <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection

@section('scripts')
<style>
    .tracking-wider {
        letter-spacing: 0.05em;
    }

    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }

    /* Efek Glow Biru saat Input diklik/fokus */
    .input-group:focus-within {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25) !important;
    }
    .input-group:focus-within .input-group-text,
    .input-group:focus-within .form-control {
        background-color: var(--bs-body-bg) !important;
    }
    .form-control:focus {
        box-shadow: none !important;
    }
</style>
@endsection
@extends('layouts.app')

@section('title', config('app.name') . ' -- Tambah Kategori')

@section('content')
<div class="container-fluid p-0">
    
    <!-- HEADER HALAMAN -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-primary-subtle text-primary rounded-circle p-2 d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 55px; height: 55px;">
                <i class="bi bi-plus-circle-fill fs-3"></i>
            </div>
            <div>
                <span class="badge bg-body-secondary text-body-secondary rounded-pill px-3 py-1 mb-1 fw-semibold border">Form Tambah</span>
                <h3 class="fw-bold mb-0 text-body">Tambah Kategori</h3>
                <p class="text-body-secondary mb-0 fs-7">Tambahkan kategori inventaris baru ke dalam sistem.</p>
            </div>
        </div>
        
        <a href="{{ route('kategori.index') }}" class="btn btn-light border shadow-sm rounded-pill px-4 py-2 fw-medium hover-lift d-flex align-items-center gap-2">
            <i class="bi bi-arrow-left"></i> Batal & Kembali
        </a>
    </div>

    <!-- AREA FORM -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 position-relative overflow-hidden">
                <!-- Aksen Garis Atas (Warna Biru / Primary) -->
                <div class="position-absolute top-0 start-0 w-100 bg-primary" style="height: 4px;"></div>
                
                <div class="card-body p-4 p-lg-5">
                    <form action="{{ route('kategori.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="nama_kategori" class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider">
                                Nama Kategori <span class="text-danger">*</span>
                            </label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                    <i class="bi bi-tag-fill"></i>
                                </span>
                                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control form-control-lg border-0 bg-body-tertiary fs-6" value="{{ old('nama_kategori') }}" placeholder="Masukkan nama kategori..." required autofocus>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="kode_kategori" class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider">
                                Kode Kategori <span class="text-danger">*</span>
                            </label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                    <i class="bi bi-upc-scan"></i>
                                </span>
                                <input type="text" name="kode_kategori" id="kode_kategori" class="form-control form-control-lg border-0 bg-body-tertiary fs-6 font-monospace" value="{{ old('kode_kategori') }}" placeholder="Contoh: kategori ngoding..." required>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label for="keterangan" class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider">
                                Keterangan <span class="text-danger">*</span>
                            </label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3 align-items-start pt-3">
                                    <i class="bi bi-card-text"></i>
                                </span>
                                <textarea name="keterangan" id="keterangan" class="form-control border-0 bg-body-tertiary fs-6" rows="3" placeholder="Masukkan keterangan kategori..." required>{{ old('keterangan') }}</textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary text-white px-5 py-2.5 rounded-pill fw-bold shadow-sm hover-lift d-inline-flex align-items-center gap-2">
                                <i class="bi bi-cloud-arrow-up-fill"></i> Simpan Kategori
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
    /* Spasi huruf untuk label agar terlihat elegan */
    .tracking-wider {
        letter-spacing: 0.05em;
    }

    /* Efek hover untuk tombol */
    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }

    /* Fokus state untuk input group dengan warna glow biru Bootstrap */
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
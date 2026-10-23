@extends('layouts.app')

@section('title', config('app.name') . ' -- Edit Alat')

@section('content')
<div class="container-fluid p-0">
    
    <!-- HEADER HALAMAN -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-primary-subtle text-primary-emphasis rounded-circle p-2 d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 55px; height: 55px;">
                <i class="bi bi-pencil-square fs-3"></i>
            </div>
            <div>
                <span class="badge bg-body-secondary text-body-secondary rounded-pill px-3 py-1 mb-1 fw-semibold border">Form Edit</span>
                <h3 class="fw-bold mb-0 text-body">Edit Alat</h3>
                <p class="text-body-secondary mb-0 fs-7">Perbarui informasi data alat inventaris dengan benar.</p>
            </div>
        </div>
        
        <a href="{{ route('alat.index') }}" class="btn btn-light border shadow-sm rounded-pill px-4 py-2 fw-medium hover-lift d-flex align-items-center gap-2">
            <i class="bi bi-arrow-left"></i> Batal & Kembali
        </a>
    </div>

    <!-- AREA FORM -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 position-relative overflow-hidden">
                <!-- Aksen Garis Atas (Warna Kuning/Warning untuk Edit) -->
                <div class="position-absolute top-0 start-0 w-100 bg-primary" style="height: 4px;"></div>
                
                <div class="card-body p-4 p-lg-5">
                    <form action="{{ route('alat.update', ['id_alat' => $datal->id_alat]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nama_alat" class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider">
                                Nama Alat <span class="text-danger">*</span>
                            </label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                    <i class="bi bi-tools"></i>
                                </span>
                                <input type="text" name="nama_alat" id="nama_alat" class="form-control form-control-lg border-0 bg-body-tertiary fs-6" value="{{ $datal->nama_alat }}" placeholder="Masukkan nama alat..." required autofocus>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="kode_alat" class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider">
                                Kode Alat <span class="text-danger">*</span>
                            </label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                    <i class="bi bi-upc-scan"></i>
                                </span>
                                <input type="text" name="kode_alat" id="kode_alat" class="form-control form-control-lg border-0 bg-body-tertiary fs-6 font-monospace" value="{{ $datal->kode_alat }}" placeholder="Contoh: ALT-001..." required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="id_kategori" class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider">
                                Kategori Alat <span class="text-danger">*</span>
                            </label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                    <i class="bi bi-tags-fill"></i>
                                </span>
                                <select name="id_kategori" id="id_kategori" class="form-select form-select-lg border-0 bg-body-tertiary fs-6" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->id_kategori }}" {{ $datal->id_kategori == $k->id_kategori ? 'selected' : '' }}>
                                            {{ $k->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label for="stok" class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider">
                                Jumlah Stok <span class="text-danger">*</span>
                            </label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                    <i class="bi bi-box-seam"></i>
                                </span>
                                <!-- value="$datal->stok" sudah ditambahkan agar stok lamanya muncul -->
                                <input type="number" class="form-control form-control-lg border-0 bg-body-tertiary fs-6" id="stok" name="stok" required min="0" value="{{ $datal->stok ?? '' }}" placeholder="Masukkan angka stok...">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary text-white px-5 py-2.5 rounded-pill fw-bold shadow-sm hover-lift d-inline-flex align-items-center gap-2">
                                <i class="bi bi-save-fill"></i> Simpan Perubahan
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

    /* Fokus state untuk input group (Glow Kuning) */
    .input-group:focus-within {
        box-shadow: 0 0 0 0.25rem rgba(28, 31, 219, 0.25) !important;
    }
    .input-group:focus-within .input-group-text,
    .input-group:focus-within .form-control,
    .input-group:focus-within .form-select {
        background-color: var(--bs-body-bg) !important;
    }
    .form-control:focus, .form-select:focus {
        box-shadow: none !important;
    }
</style>
@endsection
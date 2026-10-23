@extends('layouts.app')

@section('title', config('app.name') . ' -- Edit Pengembalian')

@section('content')
<div class="container-fluid p-0">
    
    <!-- HEADER HALAMAN -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-primary-subtle text-primary rounded-circle p-2 d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 55px; height: 55px;">
                <i class="bi bi-pencil-square fs-3"></i>
            </div>
            <div>
                <span class="badge bg-body-secondary text-body-secondary rounded-pill px-3 py-1 mb-1 fw-semibold border">Form Edit</span>
                <h3 class="fw-bold mb-0 text-body">Edit Data Pengembalian</h3>
                <p class="text-body-secondary mb-0 fs-7">Perbarui informasi pengembalian alat, kondisi, dan denda.</p>
            </div>
        </div>
        
        <a href="{{ route('pengembalian.index') }}" class="btn btn-light border shadow-sm rounded-pill px-4 py-2 fw-medium hover-lift d-flex align-items-center gap-2">
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
                    <form action="{{ route('pengembalian.update', [$datap->id_pengembalian]) }}" method="POST">
                        @csrf
                        @method('POST') <!-- Pastikan ini sesuai dengan route Laravel-mu (bisa POST atau PUT) -->

                        <div class="row g-4">
                            <!-- Data Peminjaman Locked / Readonly -->
                            <div class="col-md-6">
                                <label class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider">Data Peminjaman</label>
                                <!-- Hidden input agar id_peminjaman tetap terkirim saat form disimpan -->
                                <input type="hidden" name="id_peminjaman" value="{{ $datap->id_peminjaman }}">
                                
                                <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                    <span class="input-group-text bg-dark-subtle border-0 text-body opacity-75 px-3">
                                        <i class="bi bi-lock-fill"></i>
                                    </span>
                                    <input type="text" class="form-control form-control-lg bg-dark-subtle text-body border-0 opacity-75 fs-6" value="ID #{{ $datap->id_peminjaman }} - {{ $peminjamName }} ({{ $alatName }})" readonly disabled>
                                </div>
                            </div>

                            <!-- Tanggal Pengembalian -->
                            <div class="col-md-6">
                                <label for="tanggal_pengembalian" class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider">
                                    Tanggal Kembali <span class="text-danger">*</span>
                                </label>
                                <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                    <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                        <i class="bi bi-calendar-event"></i>
                                    </span>
                                    <input type="datetime-local" name="tanggal_pengembalian" id="tanggal_pengembalian" class="form-control form-control-lg border-0 bg-body-tertiary fs-6" value="{{ old('tanggal_pengembalian', date('Y-m-d\TH:i', strtotime($datap->tanggal_pengembalian))) }}" required>
                                </div>
                            </div>

                            <!-- Terlambat (Hari) -->
                            <div class="col-md-4">
                                <label for="terlambat_hari" class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider">Terlambat (Hari)</label>
                                <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                    <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                        <i class="bi bi-clock-history"></i>
                                    </span>
                                    <input type="number" min="0" name="terlambat_hari" id="terlambat_hari" class="form-control form-control-lg border-0 bg-body-tertiary fs-6" value="{{ old('terlambat_hari', $datap->terlambat_hari ?? 0) }}">
                                </div>
                            </div>

                            <!-- Denda -->
                            <div class="col-md-4">
                                <label for="denda" class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider">Denda (Rp)</label>
                                <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                    <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                        <i class="bi bi-cash-coin"></i>
                                    </span>
                                    <input type="number" min="0" name="denda" id="denda" class="form-control form-control-lg border-0 bg-body-tertiary fs-6" value="{{ old('denda', $datap->denda ?? 0) }}">
                                </div>
                            </div>

                            <!-- Kondisi Barang -->
                            <div class="col-md-4">
                                <label for="kondisi_barang" class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider">Kondisi Barang</label>
                                <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                    <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                        <i class="bi bi-clipboard-check"></i>
                                    </span>
                                    <select name="kondisi_barang" id="kondisi_barang" class="form-select form-select-lg border-0 bg-body-tertiary fs-6">
                                        <option value="Baik" {{ old('kondisi_barang', $datap->kondisi_barang) == 'Baik' ? 'selected' : '' }}>Baik</option>
                                        <option value="Rusak Ringan" {{ old('kondisi_barang', $datap->kondisi_barang) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                        <option value="Rusak Berat" {{ old('kondisi_barang', $datap->kondisi_barang) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                                        <option value="Hilang" {{ old('kondisi_barang', $datap->kondisi_barang) == 'Hilang' ? 'selected' : '' }}>Hilang</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Catatan -->
                            <div class="col-12 mb-2">
                                <label for="catatan" class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider">Catatan</label>
                                <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                    <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3 align-items-start pt-3">
                                        <i class="bi bi-card-text"></i>
                                    </span>
                                    <textarea name="catatan" id="catatan" rows="3" class="form-control border-0 bg-body-tertiary fs-6" placeholder="Tambahkan catatan jika ada...">{{ old('catatan', $datap->catatan) }}</textarea>
                                </div>
                            </div>

                            <!-- Tombol Simpan -->
                            <div class="col-12 d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary text-white px-5 py-2.5 rounded-pill fw-bold shadow-sm hover-lift d-inline-flex align-items-center gap-2">
                                    <i class="bi bi-save-fill"></i> Simpan Perubahan
                                </button>
                            </div>
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

    /* Fokus state untuk input group dengan warna glow biru */
    .input-group:focus-within {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25) !important;
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
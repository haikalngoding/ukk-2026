@extends('layouts.app')

@section('title', config('app.name') . ' -- Edit Peminjaman')

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
                <h3 class="fw-bold mb-0 text-body">Edit Data Peminjaman</h3>
                <p class="text-body-secondary mb-0 fs-7">Perbarui informasi transaksi peminjaman alat dengan benar.</p>
            </div>
        </div>
        
        <a href="{{ route('peminjaman.index') }}" class="btn btn-light border shadow-sm rounded-pill px-4 py-2 fw-medium hover-lift d-flex align-items-center gap-2">
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
                    <form action="{{ route('peminjaman.update', ['id_peminjaman' => $data->id_peminjaman]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Pilih User / Peminjam -->
                        <div class="mb-4">
                            <label for="id_user" class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider">
                                Pilih User / Peminjam <span class="text-danger">*</span>
                            </label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                    <i class="bi bi-person-fill"></i>
                                </span>
                                <select name="id_user" id="id_user" class="form-select form-select-lg border-0 bg-body-tertiary fs-6" required>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $data->id_user == $user->id ? 'selected' : '' }}>
                                            {{ $user->nama ?? $user->name ?? $user->username ?? 'User ID: ' . $user->id }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Pilih Alat -->
                        <div class="mb-4">
                            <label for="id_alat" class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider">
                                Pilih Alat <span class="text-danger">*</span>
                            </label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                    <i class="bi bi-tools"></i>
                                </span>
                                <select name="id_alat" id="id_alat" class="form-select form-select-lg border-0 bg-body-tertiary fs-6" required>
                                    @foreach($alat as $item)
                                        <option value="{{ $item->id }}" {{ $data->id_alat == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_alat ?? $item->nama ?? 'Alat ID: ' . $item->id }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Jumlah -->
                        <div class="mb-4">
                            <label for="jumlah" class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider">
                                Jumlah Unit <span class="text-danger">*</span>
                            </label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                    <i class="bi bi-stack"></i>
                                </span>
                                <input type="number" name="jumlah" id="jumlah" class="form-control form-control-lg border-0 bg-body-tertiary fs-6" value="{{ $data->jumlah }}" min="1" required placeholder="Masukkan jumlah unit...">
                            </div>
                        </div>

                        <!-- Tanggal Pinjam -->
                        <div class="mb-4">
                            <label for="tanggal_pinjam" class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider">
                                Tanggal Pinjam <span class="text-danger">*</span>
                            </label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                    <i class="bi bi-calendar-check"></i>
                                </span>
                                <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control form-control-lg border-0 bg-body-tertiary fs-6" value="{{ $data->tanggal_pinjam }}" required>
                            </div>
                        </div>

                        <!-- Tanggal Kembali -->
                        <div class="mb-4">
                            <label for="tanggal_kembali" class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider">
                                Tanggal Kembali (Aktual)
                            </label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                    <i class="bi bi-calendar-x"></i>
                                </span>
                                <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control form-control-lg border-0 bg-body-tertiary fs-6" value="{{ $data->tanggal_kembali }}">
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="status" class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider">
                                Status Peminjaman <span class="text-danger">*</span>
                            </label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                    <i class="bi bi-info-circle"></i>
                                </span>
                                <select name="status" id="status" class="form-select form-select-lg border-0 bg-body-tertiary fs-6" required>
                                    <option value="Pending" {{ $data->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Disetujui" {{ $data->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="Ditolak" {{ $data->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    <option value="Dipinjam" {{ $data->status == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                    <option value="Dikembalikan" {{ $data->status == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                                </select>
                            </div>
                        </div>

                        <!-- Denda -->
                        <div class="mb-5">
                            <label for="denda" class="form-label fw-medium text-body-secondary small text-uppercase tracking-wider">
                                Denda (Rp)
                            </label>
                            <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                <span class="input-group-text bg-body-tertiary border-0 text-secondary px-3">
                                    <i class="bi bi-cash-coin"></i>
                                </span>
                                <input type="number" name="denda" id="denda" class="form-control form-control-lg border-0 bg-body-tertiary fs-6" value="{{ $data->denda }}" min="0" placeholder="0">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary
                             text-white px-5 py-2.5 rounded-pill fw-bold shadow-sm hover-lift d-inline-flex align-items-center gap-2">
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

    /* Fokus state untuk input group dengan warna glow kuning */
    .input-group:focus-within {
        box-shadow: 0 0 0 0.25rem rgba(31, 46, 185, 0.25) !important;
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
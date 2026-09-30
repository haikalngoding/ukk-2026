@extends('layouts.app')

@section('title', config('app.name') . ' -- Kerangka PHP Ringan')

@section('content')

{{-- CSS Kustom Desain Minimalis & Elegan --}}
<style>
    .edit-card {
        background-color: var(--bs-body-bg);
        border: 1px solid var(--bs-border-color-translucent);
        border-radius: 1.25rem;
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.05);
    }
    .form-floating > .form-control, 
    .form-floating > .form-select {
        border-radius: 0.75rem;
        border-color: var(--bs-border-color-translucent);
        background-color: transparent;
        color: var(--bs-body-color);
        padding-left: 1.25rem;
        padding-right: 1.25rem;
    }
    .form-floating > .form-control:focus, 
    .form-floating > .form-select:focus {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.12);
        background-color: transparent;
    }
    .form-floating > label {
        padding-left: 1.25rem;
        color: var(--bs-secondary-color);
        font-weight: 500;
    }
    .btn-action-pill {
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        border-radius: 0.75rem;
        transition: all 0.2s ease-in-out;
    }
</style>

<div class="container-fluid px-0 py-4" style="max-width: 600px;">
    
    {{-- Header Judul Minimalis --}}
    <div class="text-center mb-4">
        <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-15 text-primary rounded-circle mb-3 shadow-2xs" style="width: 60px; height: 60px;">
            <i class="bi bi-tools fs-4"></i>
        </div>
        <h2 class="fw-bold text-body">Edit Alat</h2>
        <p class="text-secondary small mb-0">Perbarui informasi data alat di bawah ini dengan benar.</p>
    </div>

    {{-- Kartu Utama Form --}}
    <div class="card edit-card border-0 p-4 p-md-5">
        <form action="{{ route('alat.update', ['id_alat' => $datal->id_alat]) }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('PUT')

            <div class="form-floating mb-3">
                <input type="text" name="nama_alat" id="nama_alat" class="form-control" value="{{ $datal->nama_alat }}" placeholder="Nama alat" required>
                <label for="nama_alat">Nama alat</label>
            </div>
            
            <div class="form-floating mb-3">
                <input type="text" name="kode_alat" id="kode_alat" class="form-control" value="{{ $datal->kode_alat }}" placeholder="Kode alat" required>
                <label for="kode_alat">Kode alat</label>
            </div>

            <div class="form-floating mb-4">
                <select name="id_kategori" id="id_kategori" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategori as $k)
                        <option value="{{ $k->id_kategori }}" {{ $datal->id_kategori == $k->id_kategori ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                <label for="id_kategori">Kategori</label>
            </div>

            <div class="d-flex align-items-center justify-content-end gap-3 pt-3 border-top border-secondary-subtle">
                <button type="button" class="btn btn-light border btn-action-pill text-secondary px-4" onclick="window.history.back();">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary btn-action-pill px-4 shadow-sm">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

</div>

@endsection
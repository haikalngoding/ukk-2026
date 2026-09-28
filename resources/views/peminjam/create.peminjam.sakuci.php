@extends('layouts.app')

@section('title', config('app.name') . ' -- Ajukan Peminjaman Alat')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border shadow-sm rounded-4">
                <div class="card-header bg-white py-3 border-bottom">
                    <h4 class="fw-bold mb-0">Form Pengajuan Peminjaman Alat</h4>
                    <p class="text-muted small mb-0">Silakan isi formulir di bawah ini untuk mengajukan peminjaman alat inventaris.</p>
                </div>
                <div class="card-body p-4">
                    
                    {{-- Tentukan rute action berdasarkan role yang sedang login --}}
                    @php
                        $currentUser = \App\Models\User::current();
                        $isPengguna = $currentUser && ($currentUser->role == 'pengguna');
                        $storeRoute = $isPengguna ? route('peminjam.storePeminjam.pengguna') : route('peminjam.storePeminjam');
                        $indexRoute = $isPengguna ? route('peminjam.indexPeminjam.pengguna') : route('peminjam.indexPeminjam');
                    @endphp

                    <form action="{{ $storeRoute }}" method="POST">
                        @csrf
                        
                        <!-- Pilihan Alat -->
                        <div class="mb-3">
                            <label for="id_alat" class="form-label fw-semibold">Pilih Alat</label>
                            <select name="id_alat" id="id_alat" class="form-select" required>
                                <option value="">-- Pilih Alat Inventaris --</option>
                                @foreach($alat as $item)
                                    <option value="{{ $item->id_alat }}">
                                        {{ $item->nama_alat ?? $item->nama }} 
                                        @if(isset($item->stok)) (Stok: {{ $item->stok }}) @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Jumlah -->
                        <div class="mb-3">
                            <label for="jumlah" class="form-label fw-semibold">Jumlah Unit</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required placeholder="Masukkan jumlah unit yang dipinjam">
                        </div>

                        <!-- Tanggal Pinjam -->
                        <div class="mb-3">
                            <label for="tanggal_pinjam" class="form-label fw-semibold">Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" required>
                        </div>

                        <!-- Tanggal Kembali -->
                        <div class="mb-4">
                            <label for="tanggal_kembali" class="form-label fw-semibold">Rencana Tanggal Kembali <span class="text-muted fw-normal">(Opsional)</span></label>
                            <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control">
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ $indexRoute }}" class="btn btn-outline-secondary px-3">
                                <i class="bi bi-arrow-left me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                <i class="bi bi-send me-1"></i> Kirim Pengajuan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
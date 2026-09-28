@extends('layouts.app')

@section('title', 'Daftar Alat Tersedia')

@section('content')
<div class="container-fluid py-4 px-4">

    <!-- Header & Fitur Pencarian -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1">Daftar Alat Tersedia</h3>
            <p class="text-muted mb-0">Pilih alat yang ingin Anda ajukan untuk dipinjam.</p>
        </div>

        <!-- Form Pencarian -->
        <form action="{{ route('peminjam.alat') }}" method="GET" class="d-flex gap-2" style="max-width: 320px;">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Cari nama / kode alat..." value="{{ request('q') }}">
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>
        </form>
    </div>

    <!-- Grid Card Daftar Alat -->
    <div class="row g-4">
        @forelse($alats as $item)
            @php
                $namaKategori = $kategoriMap[$item->id_kategori] ?? 'Umum';
            @endphp
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card h-100 border-0 shadow-sm rounded-3">
                    <div class="card-body d-flex flex-column justify-content-between p-4">
                        <div>
                            <!-- Badge Kode Alat & Kategori -->
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-secondary-subtle text-secondary border px-2 py-1">
                                    {{ $item->kode_alat }}
                                </span>
                                <span class="badge bg-info-subtle text-info border px-2 py-1">
                                    {{ $namaKategori }}
                                </span>
                            </div>

                            <!-- Nama Alat -->
                            <h5 class="fw-bold fs-5 my-2 text-dark">
                                {{ $item->nama_alat }}
                            </h5>
                        </div>

                        <!-- Tombol Pinjam -->
                        <div class="mt-4 pt-2 border-top">
                            <a href="{{ route('peminjam.createPeminjam', ['id_alat' => $item->id_alat]) }}" 
                               class="btn btn-primary w-100 rounded-2 py-2 fw-medium d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-handbag-fill"></i>
                                Ajukan Pinjam
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm p-5 text-center">
                    <h5 class="fw-bold text-muted mb-0">Belum ada alat yang tersedia.</h5>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination (Sudah Diperbaiki) -->
    @if(method_exists($alats, 'links'))
        <div class="d-flex justify-content-center mt-4">
            {!! $alats->links() !!}
        </div>
    @endif

</div>
@endsection
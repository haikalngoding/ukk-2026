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

    @php
        // Ambil data alat mentah
        $rawAlats = $alats ?? $alat ?? [];
        // Ditambah '?? '' agar tidak error saat nilai request('q') bernilai null
        $searchQuery = trim(request('q') ?? '');

        // Filter data menggunakan PHP murni
        $filteredAlats = [];
        foreach ($rawAlats as $item) {
            $namaAlat = $item->nama_alat ?? $item->nama ?? $item->name ?? '';
            $kodeAlat = $item->kode_alat ?? $item->kode ?? '';

            // Jika ada kata pencarian, cocokkan nama atau kode alat
            if (!empty($searchQuery)) {
                if (stripos($namaAlat, $searchQuery) !== false || stripos($kodeAlat, $searchQuery) !== false) {
                    $filteredAlats[] = $item;
                }
            } else {
                // Jika tidak mencari apa-apa, tampilkan semua
                $filteredAlats[] = $item;
            }
        }
    @endphp

    <!-- Grid Card Daftar Alat -->
    <div class="row g-4">
        @forelse($filteredAlats as $item)
            @php
                $namaKategori = $kategoriMap[$item->id_kategori] ?? 'Umum';
                $alatId = $item->id_alat ?? $item->id;
                $namaAlat = $item->nama_alat ?? $item->nama ?? $item->name ?? 'Alat #' . $alatId;
                $kodeAlat = $item->kode_alat ?? $item->kode ?? 'ALT';
            @endphp
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card h-100 border-0 shadow-sm rounded-3">
                    <div class="card-body d-flex flex-column justify-content-between p-4">
                        <div>
                            <!-- Badge Kode Alat & Kategori -->
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-secondary-subtle text-secondary border px-2 py-1">
                                    {{ $kodeAlat }}
                                </span>
                                <span class="badge bg-info-subtle text-info border px-2 py-1">
                                    {{ $namaKategori }}
                                </span>
                            </div>

                            <!-- Nama Alat -->
                            <h5 class="fw-bold fs-5 my-2">
                                {{ $namaAlat }}
                            </h5>
                        </div>

                        <!-- Tombol Pinjam -->
                        <div class="mt-4 pt-2 border-top">
                            <a href="{{ route('peminjam.createPeminjam') . '?id_alat=' . $alatId }}" 
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
                    <h5 class="fw-bold text-muted mb-0">Alat yang kamu cari tidak ditemukan.</h5>
                </div>
            </div>
        @endforelse
    </div>

</div>
@endsection
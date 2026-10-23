@extends('layouts.app')

@section('title', config('app.name') . ' -- Daftar Alat')

@section('content')
<div class="container-fluid p-0">
    
    <!-- HEADER HALAMAN -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-primary-subtle text-primary rounded-circle p-2 d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 55px; height: 55px;">
                <i class="bi bi-tools fs-3"></i>
            </div>
            <div>
                <span class="badge bg-body-secondary text-body-secondary rounded-pill px-3 py-1 mb-1 fw-semibold border">Inventaris</span>
                <h3 class="fw-bold mb-0 text-body">Daftar Alat</h3>
                <p class="text-body-secondary mb-0 fs-7">Kelola data seluruh alat inventaris yang tersedia untuk dipinjam.</p>
            </div>
        </div>
        
        <a href="{{ route('alat.create') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm hover-lift d-flex align-items-center gap-2">
            <i class="bi bi-plus-circle-fill"></i> Tambah Alat Baru
        </a>
    </div>

    <!-- CARD PEMBUNGKUS TABEL -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        
        <!-- Toolbar Atas Tabel -->
        <div class="card-header bg-white border-bottom p-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <h6 class="fw-bold mb-0 text-body-secondary"><i class="bi bi-box-seam me-2"></i>Data Alat Tersedia</h6>
            
            <div class="input-group" style="max-width: 300px;">
                <span class="input-group-text bg-body-tertiary border-end-0 rounded-start-pill ps-3">
                    <i class="bi bi-search text-secondary"></i>
                </span>
                <input type="text" class="form-control border-start-0 bg-body-tertiary rounded-end-pill fs-7" placeholder="Cari nama atau kode alat...">
            </div>
        </div>

        <!-- Tabel Konten -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-secondary text-uppercase fs-8 tracking-wider">
                        <tr>
                            <th class="py-3 px-4 text-center border-0" style="width: 5%;">No</th>
                            <th class="py-3 px-3 border-0">Nama Alat</th>
                            <th class="py-3 px-3 border-0">Kode Alat</th>
                            <th class="py-3 px-3 border-0">Kategori</th>
                            <th class="py-3 px-4 text-center border-0" style="width: 200px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse ($datal as $alats)
                        <tr>
                            <td class="px-4 text-center text-body-secondary fw-medium fs-7">{{ $no++ }}</td>
                            
                            <td class="px-3">
                                <div class="fw-bold text-body fs-7">{{ $alats->nama_alat }}</div>
                            </td>

                            <td class="px-3">
                                <!-- Desain Kode Alat yang menonjol -->
                                <span class="badge bg-indigo-subtle text-indigo border border-indigo-subtle font-monospace fw-semibold px-3 py-2 rounded-3 shadow-sm fs-8 d-inline-flex align-items-center gap-1">
                                    <i class="bi bi-upc-scan"></i> {{ $alats->kode_alat }}
                                </span>
                            </td>

                            <td class="px-3">
                                <!-- Logika pencarian nama kategori aslimu tetap dipertahankan -->
                                @php
                                    $namaKategori = '-';
                                    foreach ($kategori as $k) {
                                        if ($k->id_kategori == $alats->id_kategori) {
                                            $namaKategori = $k->nama_kategori;
                                            break;
                                        }
                                    }
                                @endphp
                                <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle fw-semibold px-3 py-2 rounded-pill fs-8 d-inline-flex align-items-center gap-1">
                                    <i class="bi bi-tag-fill text-info"></i> {{ $namaKategori }}
                                </span>
                            </td>

                            <td class="px-4 text-center">
                                <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                    <!-- Tombol Edit (Warna Solid Biru) -->
                                    <a href="{{ route('alat.edit', ['alat' => $alats->id_alat]) }}" class="btn btn-sm btn-primary text-white rounded-3 px-3 py-2 fw-bold shadow-sm hover-lift d-inline-flex align-items-center gap-2" title="Edit Alat">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    <!-- Tombol Hapus (Warna Solid Merah) -->
                                    <form action="{{ route('alat.delete', ['id' => $alats->id_alat]) }}" method="POST" class="d-inline m-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus alat &quot;{{ $alats->nama_alat }}&quot;?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger text-white rounded-3 px-3 py-2 fw-bold shadow-sm hover-lift d-inline-flex align-items-center gap-2" title="Hapus Alat">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-body-secondary">
                                <div class="d-flex flex-column align-items-center gap-3">
                                    <div class="bg-body-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                                        <i class="bi bi-tools text-secondary fs-1 opacity-50"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-body-secondary mb-0">Belum Ada Data Alat</h6>
                                        <p class="text-secondary fs-7 mb-0">Silakan klik tombol "Tambah Alat Baru" untuk mulai mendata.</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Bagian Pagination -->
        @if(method_exists($datal, 'hasPages') && $datal->hasPages())
        <div class="card-footer bg-white py-3 border-top d-flex justify-content-end">
            {!! $datal->links() !!}
        </div>
        @endif
    </div>

</div>
@endsection

@section('scripts')
<style>
    /* Custom color untuk badge kode alat (warna Indigo / Ungu Pastel) */
    .bg-indigo-subtle { background-color: #e0cffc !important; }
    .text-indigo { color: #520dc2 !important; }
    .border-indigo-subtle { border-color: #cbb2f9 !important; }

    /* Spasi huruf untuk header tabel */
    .tracking-wider {
        letter-spacing: 0.05em;
    }

    /* Efek hover untuk tombol dan card */
    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
</style>
@endsection
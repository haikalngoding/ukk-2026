@extends('layouts.app')

@section('title', config('app.name') . ' -- Daftar Kategori')

@section('content')
<div class="container-fluid p-0">
    
    <!-- HEADER HALAMAN -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-primary-subtle text-primary rounded-circle p-2 d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 55px; height: 55px;">
                <i class="bi bi-tags-fill fs-3"></i>
            </div>
            <div>
                <span class="badge bg-body-secondary text-body-secondary rounded-pill px-3 py-1 mb-1 fw-semibold border">Inventaris</span>
                <h3 class="fw-bold mb-0 text-body">Daftar Kategori</h3>
                <p class="text-body-secondary mb-0 fs-7">Kelola pengelompokan data alat untuk memudahkan manajemen inventaris.</p>
            </div>
        </div>
        
        <a href="{{ route('kategori.create') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm hover-lift d-flex align-items-center gap-2">
            <i class="bi bi-plus-circle-fill"></i> Tambah Kategori Baru
        </a>
    </div>

    <!-- CARD PEMBUNGKUS TABEL -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        
        <!-- Toolbar Atas Tabel -->
        <div class="card-header bg-white border-bottom p-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <h6 class="fw-bold mb-0 text-body-secondary"><i class="bi bi-list-ul me-2"></i>Data Kategori Tersedia</h6>
            
            <div class="input-group" style="max-width: 300px;">
                <span class="input-group-text bg-body-tertiary border-end-0 rounded-start-pill ps-3">
                    <i class="bi bi-search text-secondary"></i>
                </span>
                <input type="text" class="form-control border-start-0 bg-body-tertiary rounded-end-pill fs-7" placeholder="Cari nama kategori...">
            </div>
        </div>

        <!-- Tabel Konten -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-secondary text-uppercase fs-8 tracking-wider">
                        <tr>
                            <th class="py-3 px-4 text-center border-0" style="width: 5%;">No</th>
                            <th class="py-3 px-3 border-0">Nama Kategori</th>
                            <th class="py-3 px-3 border-0">Kode</th>
                            <th class="py-3 px-3 border-0">Keterangan</th>
                            <th class="py-3 px-4 text-center border-0" style="width: 200px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse ($data as $kategoris)
                        <tr>
                            <td class="px-4 text-center text-body-secondary fw-medium fs-7">{{ $no++ }}</td>
                            
                            <td class="px-3">
                                <div class="fw-bold text-body fs-7">{{ $kategoris->nama_kategori }}</div>
                            </td>

                            <td class="px-3">
                                <span class="badge bg-indigo-subtle text-indigo border border-indigo-subtle font-monospace fw-semibold px-3 py-2 rounded-3 shadow-sm fs-8 d-inline-flex align-items-center gap-1">
                                    <i class="bi bi-upc-scan"></i> {{ $kategoris->kode_kategori }}
                                </span>
                            </td>

                            <td class="px-3">
                                <span class="text-body-secondary fs-7">{{ $kategoris->keterangan ?? '-' }}</span>
                            </td>
                            <td class="px-4 text-center">
                                <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                    <a href="{{ route('kategori.edit', ['kategori' => $kategoris->id_kategori]) }}" class="btn btn-sm btn-primary text-white rounded-3 px-3 py-2 fw-bold shadow-sm hover-lift d-inline-flex align-items-center gap-2" title="Edit Kategori">
                                         <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    <form action="{{ route('kategori.delete', ['id' => $kategoris->id_kategori]) }}" method="POST" class="d-inline m-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori &quot;{{ $kategoris->nama_kategori }}&quot;?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger text-white rounded-3 px-3 py-2 fw-bold shadow-sm hover-lift d-inline-flex align-items-center gap-2" title="Hapus Kategori">
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
                                        <i class="bi bi-tags text-secondary fs-1 opacity-50"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-body-secondary mb-0">Belum Ada Kategori</h6>
                                        <p class="text-secondary fs-7 mb-0">Silakan klik tombol "Tambah Kategori Baru" untuk memulai.</p>
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
        @if(method_exists($data, 'hasPages') && $data->hasPages())
        <div class="card-footer bg-white py-3 border-top d-flex justify-content-end">
            {!! $data->links() !!}
        </div>
        @endif
    </div>

</div>
@endsection

@section('scripts')
<style>
    /* Custom color untuk badge kode kategori */
    .bg-indigo-subtle { background-color: #e0cffc !important; }
    .text-indigo { color: #520dc2 !important; }
    .border-indigo-subtle { border-color: #cbb2f9 !important; }

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
@extends('layouts.app')

@section('title', config('app.name') . ' -- Data Pengembalian')

@section('content')
<div class="container-fluid p-0">

    <!-- Flash Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center" role="alert">
            <i class="bi bi-check-circle-fill me-3 fs-4 text-success"></i>
            <div class="fw-medium text-success-emphasis">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- HEADER HALAMAN -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-primary-subtle text-primary rounded-circle p-2 d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 55px; height: 55px;">
                <i class="bi bi-box-arrow-in-down fs-3"></i>
            </div>
            <div>
                <span class="badge bg-body-secondary text-body-secondary rounded-pill px-3 py-1 mb-1 fw-semibold border">Transaksi</span>
                <h3 class="fw-bold mb-0 text-body">Data Pengembalian</h3>
                <p class="text-body-secondary mb-0 fs-7">Kelola riwayat pengembalian barang, kondisi, dan denda keterlambatan.</p>
            </div>
        </div>
        
        <a href="{{ route('pengembalian.create') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm hover-lift d-flex align-items-center gap-2">
            <i class="bi bi-plus-circle-fill"></i> Tambah Pengembalian
        </a>
    </div>

    <!-- CARD PEMBUNGKUS TABEL -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        
        <!-- Toolbar Atas Tabel -->
        <div class="card-header bg-white border-bottom p-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <h6 class="fw-bold mb-0 text-body-secondary"><i class="bi bi-journal-check me-2"></i>Riwayat Pengembalian</h6>
            
            <div class="input-group" style="max-width: 300px;">
                <span class="input-group-text bg-body-tertiary border-end-0 rounded-start-pill ps-3">
                    <i class="bi bi-search text-secondary"></i>
                </span>
                <input type="text" class="form-control border-start-0 bg-body-tertiary rounded-end-pill fs-7" placeholder="Cari data pengembalian...">
            </div>
        </div>

        <!-- Tabel Konten -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-secondary text-uppercase fs-8 tracking-wider">
                        <tr>
                            <th class="py-3 px-4 text-center border-0" style="width: 5%;">No</th>
                            <th class="py-3 px-3 border-0">Peminjam & Alat</th>
                            <th class="py-3 px-3 border-0 text-center">Tgl Kembali</th>
                            <th class="py-3 px-3 border-0 text-center">Status Waktu</th>
                            <th class="py-3 px-3 border-0">Denda</th>
                            <th class="py-3 px-3 border-0 text-center">Kondisi</th>
                            <th class="py-3 px-3 border-0">Catatan</th>
                            <th class="py-3 px-4 text-center border-0" style="width: 200px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($datap as $index => $d)
                            @php
                                // Logika pencarian data bawaanmu (TIDAK DIUBAH)
                                $p = $peminjamanList[$d->id_peminjaman] ?? null;
                                $uname = $p ? ($userList[$p->id_user] ?? '-') : '-';
                                $alatName = $p ? ($alatList[$p->id_alat] ?? '-') : '-';

                                $kondisi = $d->kondisi_barang ?? 'Baik';
                                $badgeKondisi = match($kondisi) {
                                    'Baik' => 'bg-success-subtle text-success-emphasis border-success-subtle',
                                    'Rusak Ringan' => 'bg-warning-subtle text-warning-emphasis border-warning-subtle',
                                    'Rusak Berat', 'Hilang' => 'bg-danger-subtle text-danger-emphasis border-danger-subtle',
                                    default => 'bg-secondary-subtle text-secondary-emphasis border-secondary-subtle'
                                };
                            @endphp
                            <tr>
                                <td class="px-4 text-center text-body-secondary fw-medium fs-7">{{ $index + 1 }}</td>
                                
                                <td class="px-3">
                                    <div class="fw-bold text-body fs-7 mb-1">
                                        <i class="bi bi-person-fill text-primary me-1"></i> {{ $uname }}
                                    </div>
                                    <div class="text-body-secondary fs-8">
                                        <i class="bi bi-tools me-1"></i> {{ $alatName }} 
                                        <span class="badge bg-secondary-subtle text-secondary rounded-pill ms-1" title="ID Peminjaman">#{{ $d->id_peminjaman }}</span>
                                    </div>
                                </td>

                                <td class="px-3 text-center">
                                    <span class="text-body-secondary fs-7 fw-medium"><i class="bi bi-calendar2-check text-success me-1"></i> {{ $d->tanggal_pengembalian }}</span>
                                </td>

                                <td class="px-3 text-center">
                                    @if($d->terlambat_hari > 0)
                                        <span class="badge bg-danger-subtle text-danger-emphasis border border-danger-subtle rounded-pill px-3 py-2 fs-8 fw-semibold d-inline-flex align-items-center gap-1">
                                            <i class="bi bi-clock-history"></i> Telat {{ $d->terlambat_hari }} Hari
                                        </span>
                                    @else
                                        <span class="badge bg-success-subtle text-success-emphasis border border-success-subtle rounded-pill px-3 py-2 fs-8 fw-semibold d-inline-flex align-items-center gap-1">
                                            <i class="bi bi-check2-circle"></i> Tepat Waktu
                                        </span>
                                    @endif
                                </td>

                                <td class="px-3">
                                    @if(isset($d->denda) && $d->denda > 0)
                                        <span class="badge bg-danger text-white px-2 py-1 rounded-2 fs-8 fw-bold">
                                            Rp {{ number_format($d->denda, 0, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="text-body-secondary fs-7">-</span>
                                    @endif
                                </td>

                                <td class="px-3 text-center">
                                    <span class="badge {{ $badgeKondisi }} border px-3 py-2 rounded-pill fs-8 fw-semibold">
                                        {{ $kondisi }}
                                    </span>
                                </td>

                                <td class="px-3">
                                    <span class="text-body-secondary fs-8">{{ $d->catatan ?? '-' }}</span>
                                </td>

                                <td class="px-4 text-center">
                                    <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('pengembalian.edit', [$d->id_pengembalian]) }}" class="btn btn-sm btn-primary text-white rounded-3 px-3 py-2 fw-bold shadow-sm hover-lift d-inline-flex align-items-center gap-2" title="Edit Data">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>

                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('pengembalian.delete', [$d->id_pengembalian]) }}" method="POST" class="d-inline m-0" onsubmit="return confirm('Yakin ingin menghapus data pengembalian ini?')">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger text-white rounded-3 px-3 py-2 fw-bold shadow-sm hover-lift d-inline-flex align-items-center gap-2" title="Hapus Data">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-body-secondary">
                                    <div class="d-flex flex-column align-items-center gap-3">
                                        <div class="bg-body-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                                            <i class="bi bi-box-arrow-in-down text-secondary fs-1 opacity-50"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold text-body-secondary mb-0">Belum Ada Data Pengembalian</h6>
                                            <p class="text-secondary fs-7 mb-0">Semua riwayat alat yang dikembalikan akan muncul di sini.</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<style>
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
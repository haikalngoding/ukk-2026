@extends('layouts.app')

@section('title', config('app.name') . ' -- Daftar Peminjaman')

@section('content')
<div class="container-fluid p-0">
    
    <!-- HEADER HALAMAN -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-primary-subtle text-primary rounded-circle p-2 d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 55px; height: 55px;">
                <i class="bi bi-arrow-left-right fs-3"></i>
            </div>
            <div>
                <span class="badge bg-body-secondary text-body-secondary rounded-pill px-3 py-1 mb-1 fw-semibold border">Transaksi</span>
                <h3 class="fw-bold mb-0 text-body">Daftar Peminjaman</h3>
                <p class="text-body-secondary mb-0 fs-7">Kelola data peminjaman, pengembalian, dan denda inventaris.</p>
            </div>
        </div>
        
        <a href="{{ route('peminjaman.create') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm hover-lift d-flex align-items-center gap-2">
            <i class="bi bi-plus-circle-fill"></i> Tambah Peminjaman
        </a>
    </div>

    <!-- CARD PEMBUNGKUS TABEL -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        
        <!-- Toolbar Atas Tabel -->
        <div class="card-header bg-white border-bottom p-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <h6 class="fw-bold mb-0 text-body-secondary"><i class="bi bi-clipboard-data me-2"></i>Data Transaksi Terbaru</h6>
            
            <div class="input-group" style="max-width: 300px;">
                <span class="input-group-text bg-body-tertiary border-end-0 rounded-start-pill ps-3">
                    <i class="bi bi-search text-secondary"></i>
                </span>
                <input type="text" class="form-control border-start-0 bg-body-tertiary rounded-end-pill fs-7" placeholder="Cari nama peminjam atau alat...">
            </div>
        </div>

        <!-- Tabel Konten -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-secondary text-uppercase fs-8 tracking-wider">
                        <tr>
                            <th class="py-3 px-4 text-center border-0" style="width: 5%;">No</th>
                            <th class="py-3 px-3 border-0">Peminjam</th>
                            <th class="py-3 px-3 border-0">Alat</th>
                            <th class="py-3 px-3 border-0 text-center">Jumlah</th>
                            <th class="py-3 px-3 border-0">Tgl Pinjam / Kembali</th>
                            <th class="py-3 px-3 border-0 text-center">Status</th>
                            <th class="py-3 px-3 border-0">Denda</th>
                            <th class="py-3 px-4 text-center border-0" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse ($datap as $peminjaman)
                        @php
                            // Logika pencarian data User aslimu (Tidak diubah)
                            $userIdVal = $peminjaman->id_user ?? $peminjaman->user_id ?? null;
                            $userObj = $peminjaman->user ?? ($userIdVal ? \App\Models\User::find($userIdVal) : null);
                            $namaUserFinal = $userObj->name ?? $userObj->nama ?? $userObj->username ?? $userObj->email ?? ($userIdVal ? 'User #' . $userIdVal : 'Tanpa Nama');

                            // Logika pencarian data Alat aslimu (Tidak diubah)
                            $alatIdVal = $peminjaman->id_alat ?? $peminjaman->alat_id ?? null;
                            $alatObj = $peminjaman->alat ?? ($alatIdVal ? \App\Models\Alat::find($alatIdVal) : null);
                            $namaAlatFinal = $alatObj->nama_alat ?? $alatObj->nama ?? $alatObj->name ?? ($alatIdVal ? 'Alat #' . $alatIdVal : 'Alat Tidak Diketahui');
                        @endphp
                        <tr>
                            <td class="px-4 text-center text-body-secondary fw-medium fs-7">{{ $no++ }}</td>
                            
                            <td class="px-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px;">
                                        <i class="bi bi-person-fill fs-6"></i>
                                    </div>
                                    <div class="fw-bold text-body fs-7">{{ $namaUserFinal }}</div>
                                </div>
                            </td>

                            <td class="px-3">
                                <div class="fw-semibold text-body fs-7"><i class="bi bi-tools text-secondary me-1"></i> {{ $namaAlatFinal }}</div>
                            </td>

                            <td class="px-3 text-center">
                                <span class="badge bg-indigo-subtle text-indigo border border-indigo-subtle font-monospace fw-semibold px-2.5 py-1.5 rounded-3 fs-8">
                                    {{ $peminjaman->jumlah }} Unit
                                </span>
                            </td>

                            <td class="px-3">
                                <div class="text-body-secondary fs-8 mb-1" title="Tanggal Pinjam">
                                    <i class="bi bi-calendar-check text-success me-1"></i> {{ $peminjaman->tanggal_pinjam }}
                                </div>
                                <div class="text-body-secondary fs-8" title="Tanggal Kembali">
                                    <i class="bi bi-calendar-x text-danger me-1"></i> {{ $peminjaman->tanggal_kembali ?? 'Belum Kembali' }}
                                </div>
                            </td>

                            <td class="px-3 text-center">
                                @if($peminjaman->status == 'Pending')
                                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle fw-semibold px-3 py-2 rounded-pill fs-8"><i class="bi bi-hourglass-split me-1"></i> Pending</span>
                                @elseif($peminjaman->status == 'Disetujui')
                                    <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle fw-semibold px-3 py-2 rounded-pill fs-8"><i class="bi bi-check2-all me-1"></i> Disetujui</span>
                                @elseif($peminjaman->status == 'Ditolak')
                                    <span class="badge bg-danger-subtle text-danger-emphasis border border-danger-subtle fw-semibold px-3 py-2 rounded-pill fs-8"><i class="bi bi-x-circle me-1"></i> Ditolak</span>
                                @elseif($peminjaman->status == 'Dipinjam')
                                    <span class="badge bg-primary-subtle text-primary-emphasis border border-primary-subtle fw-semibold px-3 py-2 rounded-pill fs-8"><i class="bi bi-arrow-up-right-circle me-1"></i> Dipinjam</span>
                                @else
                                    <span class="badge bg-success-subtle text-success-emphasis border border-success-subtle fw-semibold px-3 py-2 rounded-pill fs-8"><i class="bi bi-check-circle-fill me-1"></i> Dikembalikan</span>
                                @endif
                            </td>

                            <td class="px-3">
                                @if(isset($peminjaman->denda) && $peminjaman->denda > 0)
                                    <span class="badge bg-danger text-white px-2 py-1 rounded-2 fs-8 fw-bold">
                                        Rp {{ number_format($peminjaman->denda, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="text-body-secondary fs-7">-</span>
                                @endif
                            </td>

                            <td class="px-4 text-center">
                                <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                    <!-- Tombol Edit Warna Solid -->
                                    <a href="{{ route('peminjaman.edit', ['id_peminjaman' => $peminjaman->id_peminjaman]) }}" class="btn btn-sm btn-primary text-white rounded-3 px-3 py-2 fw-bold shadow-sm hover-lift d-inline-flex align-items-center gap-2" title="Edit Data">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    <!-- Tombol Hapus Warna Solid -->
                                    <form action="{{ route('peminjaman.delete', ['id_peminjaman' => $peminjaman->id_peminjaman]) }}" method="POST" class="d-inline m-0">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-sm btn-danger text-white rounded-3 px-3 py-2 fw-bold shadow-sm hover-lift d-inline-flex align-items-center gap-2" onclick="return confirm('Apakah Anda yakin ingin menghapus data peminjaman ini?')" title="Hapus Data">
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
                                        <i class="bi bi-arrow-left-right text-secondary fs-1 opacity-50"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-body-secondary mb-0">Belum Ada Transaksi</h6>
                                        <p class="text-secondary fs-7 mb-0">Semua data peminjaman alat akan muncul di sini.</p>
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
        @if(method_exists($datap, 'hasPages') && $datap->hasPages())
        <div class="card-footer bg-white py-3 border-top d-flex justify-content-end">
            {!! $datap->links() !!}
        </div>
        @endif
    </div>

</div>
@endsection

@section('scripts')
<style>
    /* Custom color untuk badge jumlah (warna Indigo) */
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
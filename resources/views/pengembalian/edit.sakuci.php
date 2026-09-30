@extends('layouts.app')

@section('title', config('app.name') . ' -- Edit Pengembalian')

@section('content')
<div class="container-fluid py-4 px-4">
    
    <!-- Header Halaman & Tombol Kembali -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold mb-1 tracking-tight">Edit Data Pengembalian</h3>
            <p class="text-body-secondary small mb-0">Perbarui informasi pengembalian alat dan denda.</p>
        </div>
        <a href="{{ route('pengembalian.index') }}" class="btn btn-outline-secondary btn-sm px-3 py-2 rounded-3 d-inline-flex align-items-center gap-2">
            <i class="bi bi-arrow-left"></i>
            <span class="fw-medium">Kembali</span>
        </a>
    </div>

    <!-- Card Form Edit -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('pengembalian.update', [$datap->id_pengembalian]) }}" method="POST">
                @csrf

                <div class="row g-3">
                    <!-- Peminjaman Locked / Readonly -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold fs-7 text-body-secondary">Data Peminjaman</label>
                        <!-- Hidden input agar id_peminjaman tetap terkirim saat form disimpan -->
                        <input type="hidden" name="id_peminjaman" value="{{ $datap->id_peminjaman }}">
                        <!-- Display Input Readonly -->
                        <input type="text" class="form-control rounded-3 bg-dark-subtle text-body border-secondary-subtle opacity-75" value="ID #{{ $datap->id_peminjaman }} - {{ $peminjamName }} ({{ $alatName }})" readonly disabled>
                    </div>

                    <!-- Tanggal Pengembalian -->
                    <div class="col-md-6">
                        <label for="tanggal_pengembalian" class="form-label fw-semibold fs-7">Tanggal Pengembalian</label>
                        <input type="datetime-local" name="tanggal_pengembalian" id="tanggal_pengembalian" class="form-control rounded-3" value="{{ old('tanggal_pengembalian', date('Y-m-d\TH:i', strtotime($datap->tanggal_pengembalian))) }}" required>
                    </div>

                    <!-- Terlambat (Hari) -->
                    <div class="col-md-4">
                        <label for="terlambat_hari" class="form-label fw-semibold fs-7">Terlambat (Hari)</label>
                        <input type="number" min="0" name="terlambat_hari" id="terlambat_hari" class="form-control rounded-3" value="{{ old('terlambat_hari', $datap->terlambat_hari ?? 0) }}">
                    </div>

                    <!-- Denda -->
                    <div class="col-md-4">
                        <label for="denda" class="form-label fw-semibold fs-7">Denda (Rp)</label>
                        <input type="number" min="0" name="denda" id="denda" class="form-control rounded-3" value="{{ old('denda', $datap->denda ?? 0) }}">
                    </div>

                    <!-- Kondisi Barang -->
                    <div class="col-md-4">
                        <label for="kondisi_barang" class="form-label fw-semibold fs-7">Kondisi Barang</label>
                        <select name="kondisi_barang" id="kondisi_barang" class="form-select rounded-3">
                            <option value="Baik" {{ old('kondisi_barang', $datap->kondisi_barang) == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Rusak Ringan" {{ old('kondisi_barang', $datap->kondisi_barang) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                            <option value="Rusak Berat" {{ old('kondisi_barang', $datap->kondisi_barang) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                            <option value="Hilang" {{ old('kondisi_barang', $datap->kondisi_barang) == 'Hilang' ? 'selected' : '' }}>Hilang</option>
                        </select>
                    </div>

                    <!-- Catatan -->
                    <div class="col-12">
                        <label for="catatan" class="form-label fw-semibold fs-7">Catatan</label>
                        <textarea name="catatan" id="catatan" rows="3" class="form-control rounded-3" placeholder="Tambahkan catatan jika ada...">{{ old('catatan', $datap->catatan) }}</textarea>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="col-12 d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('pengembalian.index') }}" class="btn btn-light px-4 py-2 rounded-3 fw-medium">Batal</a>
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm fw-medium">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection@extends('layouts.app')

@section('title', config('app.name') . ' -- Daftar Pengembalian')

@section('content')
<div class="container-fluid py-4 px-4">
    
    <!-- Header Halaman & Tombol Tambah -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold mb-1 tracking-tight">Daftar Pengembalian Alat</h3>
            <p class="text-body-secondary small mb-0">Kelola data pengembalian inventaris alat dan denda keterlambatan.</p>
        </div>
        <a href="{{ route('pengembalian.create') }}" class="btn btn-primary btn-sm px-3 py-2 rounded-3 shadow-sm d-inline-flex align-items-center gap-2">
            <i class="bi bi-plus-lg"></i>
            <span class="fw-medium">Tambah Pengembalian Baru</span>
        </a>
    </div>

    <!-- Alert Notifikasi Sukses -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill text-success fs-5"></i>
                <div class="small fw-medium">{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Pembungkus Tabel -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary border-bottom text-body-secondary text-uppercase fs-8 tracking-wider">
                        <tr>
                            <th class="py-3 px-4 text-center" style="width: 5%;">No</th>
                            <th class="py-3 px-3">ID Pinjam</th>
                            <th class="py-3 px-3">Tgl Pengembalian</th>
                            <th class="py-3 px-3">Terlambat</th>
                            <th class="py-3 px-3">Denda</th>
                            <th class="py-3 px-3">Kondisi Barang</th>
                            <th class="py-3 px-3">Catatan</th>
                            <th class="py-3 px-4 text-center" style="width: 200px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse ($datap as $pengembalian)
                        <tr>
                            <td class="px-4 text-center text-body-secondary fw-medium fs-7">{{ $no++ }}</td>
                            <td class="px-3">
                                <span class="badge bg-secondary-subtle text-secondary-emphasis fw-semibold px-2.5 py-1.5 rounded-2 fs-8">#{{ $pengembalian->id_peminjaman }}</span>
                            </td>
                            <td class="px-3">
                                <span class="text-body-secondary fs-7">{{ $pengembalian->tanggal_pengembalian }}</span>
                            </td>
                            <td class="px-3">
                                @if($pengembalian->terlambat_hari > 0)
                                    <span class="badge bg-danger-subtle text-danger-emphasis fw-semibold px-2.5 py-1.5 rounded-pill fs-8">{{ $pengembalian->terlambat_hari }} Hari</span>
                                @else
                                    <span class="badge bg-success-subtle text-success-emphasis fw-semibold px-2.5 py-1.5 rounded-pill fs-8">Tepat Waktu</span>
                                @endif
                            </td>
                            <td class="px-3">
                                <span class="text-danger fw-semibold fs-7">Rp {{ number_format($pengembalian->denda ?? 0, 0, ',', '.') }}</span>
                            </td>
                            <td class="px-3">
                                <span class="badge bg-body-tertiary text-body border fw-semibold px-2.5 py-1.5 rounded-2 fs-8">{{ $pengembalian->kondisi_barang ?? 'Baik' }}</span>
                            </td>
                            <td class="px-3">
                                <span class="text-body-secondary fs-7">{{ $pengembalian->catatan ?? '-' }}</span>
                            </td>
                            <td class="px-4 text-center">
                                <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                    <a href="{{ route('pengembalian.edit', ['id_pengembalian' => $pengembalian->id_pengembalian]) }}" class="btn btn-sm btn-outline-warning fw-semibold px-3 py-1.5 rounded-3 d-inline-flex align-items-center gap-1.5 fs-7 shadow-2xs">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('pengembalian.delete', ['id_pengembalian' => $pengembalian->id_pengembalian]) }}" method="POST" class="d-inline m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger fw-semibold px-3 py-1.5 rounded-3 d-inline-flex align-items-center gap-1.5 fs-7 shadow-2xs" onclick="return confirm('Apakah Anda yakin ingin menghapus data pengembalian ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-body-secondary">
                                <div class="d-flex flex-column align-items-center gap-2">
                                    <i class="bi bi-inbox fs-2 opacity-50"></i>
                                    <span class="fs-7">Belum ada data pengembalian alat yang ditambahkan.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Bagian Pagination di Bawah Card -->
        @if(method_exists($datap, 'hasPages') && $datap->hasPages())
        <div class="card-footer bg-transparent py-3 border-top-0 d-flex justify-content-end">
            {!! $datap->links() !!}
        </div>
        @endif
    </div>

</div>
@endsection
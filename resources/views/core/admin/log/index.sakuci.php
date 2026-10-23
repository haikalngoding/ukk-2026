@extends('layouts.app')

@section('title', config('app.name') . ' -- Log Aktifitas Admin')

@section('content')
<div class="container-fluid p-0">
    
    <!-- HEADER HALAMAN -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-info-subtle text-info rounded-circle p-2 d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 55px; height: 55px;">
                <i class="bi bi-journal-text fs-3"></i>
            </div>
            <div>
                <span class="badge bg-body-secondary text-body-secondary rounded-pill px-3 py-1 mb-1 fw-semibold border">System Log</span>
                <h3 class="fw-bold mb-0 text-body">Log Aktivitas</h3>
                <p class="text-body-secondary mb-0 fs-7">Pantau seluruh riwayat tindakan pengguna di dalam sistem GoPENA.</p>
            </div>
        </div>
        
        <!-- Tombol Aksi Tambahan (Opsional) -->
        <button class="btn btn-white border shadow-sm rounded-pill px-4 py-2 fw-medium hover-lift d-flex align-items-center gap-2">
            <i class="bi bi-printer text-secondary"></i> Cetak Log
        </button>
    </div>

    <!-- CARD PEMBUNGKUS TABEL -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        
        <!-- Toolbar Atas Tabel -->
        <div class="card-header bg-white border-bottom p-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <h6 class="fw-bold mb-0 text-body-secondary"><i class="bi bi-clock-history me-2"></i>Riwayat Terbaru</h6>
            
            <div class="input-group" style="max-width: 300px;">
                <span class="input-group-text bg-body-tertiary border-end-0 rounded-start-pill ps-3">
                    <i class="bi bi-search text-secondary"></i>
                </span>
                <input type="text" class="form-control border-start-0 bg-body-tertiary rounded-end-pill fs-7" placeholder="Cari aktivitas...">
            </div>
        </div>

        <!-- Tabel Konten -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-secondary fs-8 text-uppercase tracking-wider">
                        <tr>
                            <th class="py-3 px-4 text-center border-0" style="width: 5%;">No</th>
                            <th class="py-3 px-3 border-0">Pengguna</th>
                            <th class="py-3 px-3 border-0">Keterangan Aktivitas</th>
                            <th class="py-3 px-4 border-0 text-end" style="width: 25%;">Waktu Kejadian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse ($datap as $log)
                            @php
                                // Logika bawaanmu untuk mencari nama user (Tidak diubah)
                                $userIdVal = $log->id_user ?? null;
                                $userObj = $userIdVal ? \App\Models\User::find($userIdVal) : null;
                                $namaUser = $userObj->name ?? $userObj->nama ?? $userObj->username ?? ('Sistem');
                            @endphp
                            
                            <tr>
                                <td class="px-4 text-center text-secondary fw-medium fs-7">{{ $no++ }}</td>
                                
                                <td class="px-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <!-- Avatar Bundar -->
                                        <div class="bg-primary-subtle text-primary rounded-circle d-flex justify-content-center align-items-center flex-shrink-0" style="width: 38px; height: 38px;">
                                            <i class="bi bi-person-fill fs-5"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold text-body fs-7">{{ $namaUser }}</div>
                                            <div class="text-body-secondary" style="font-size: 0.75rem;">ID: {{ $userIdVal ?? 'Auto' }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-3">
                                    <span class="text-body-secondary fs-7">{{ $log->aktifitas ?? '-' }}</span>
                                </td>

                                <td class="px-4 text-end">
                                    <!-- Label Waktu Modern -->
                                    <span class="badge bg-body-tertiary text-body border px-3 py-2 rounded-pill shadow-sm fw-medium d-inline-flex align-items-center gap-2">
                                        <span class="bg-info rounded-circle indicator-pulse" style="width: 8px; height: 8px;"></span>
                                        {{ $log->created_at ?? '-' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center justify-content-center gap-3">
                                        <div class="bg-body-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                                            <i class="bi bi-journal-x fs-1 text-secondary opacity-50"></i>
                                        </div>
                                        <h6 class="fw-bold text-body-secondary mb-0">Belum ada catatan log</h6>
                                        <p class="text-secondary fs-7 mb-0">Semua aktivitas sistem akan terekam dan muncul di sini.</p>
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
    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
    
    /* Efek kedip (pulse) pada titik indikator waktu */
    .indicator-pulse {
        animation: pulse-animation 2s infinite;
    }
    @keyframes pulse-animation {
        0% { box-shadow: 0 0 0 0 rgba(13, 202, 240, 0.7); }
        70% { box-shadow: 0 0 0 6px rgba(13, 202, 240, 0); }
        100% { box-shadow: 0 0 0 0 rgba(13, 202, 240, 0); }
    }
</style>
@endsection
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman Alat - Panel Petugas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: #fff;
            color: #000;
        }
        .header-laporan {
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        table {
            font-size: 14px;
        }
        .ttd-section {
            margin-top: 40px;
            float: right;
            text-align: center;
            width: 250px;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            @page {
                size: A4;
                margin: 20mm;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <!-- Tombol Aksi (Hanya muncul di layar, hilang saat dicetak) -->
    <div class="container my-3 no-print">
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('petugas.peminjaman.index') }}" class="btn btn-secondary btn-sm">
                &larr; Kembali ke Panel Petugas
            </a>
            <button onclick="window.print()" class="btn btn-primary btn-sm">
                Cetak Laporan
            </button>
        </div>
        <hr>
    </div>

    <div class="container">
        <!-- Kop Laporan -->
        <div class="text-center header-laporan">
            <h3 class="fw-bold text-uppercase mb-1">Laporan Rekapitulasi Peminjaman Alat</h3>
            <p class="mb-0">Sistem Informasi Inventaris dan Peminjaman Alat Lab</p>
            <small class="text-muted">Tanggal Cetak: {{ date('d F Y H:i') }}</small>
        </div>

        <!-- Tabel Data Peminjaman -->
        <table class="table table-bordered align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>ID Pinjam</th>
                    <th>Nama Peminjam</th>
                    <th>Nama Alat</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($datap as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">#{{ $item->id_peminjaman }}</td>
                        <td>{{ $item->data_user->name ?? $item->data_user->username ?? $item->id_user ?? '-' }}</td>
                        <td>{{ $item->data_alat->nama_alat ?? $item->id_alat ?? '-' }}</td>
                        
                        {{-- Otomatis cek berbagai nama kolom tanggal pinjam --}}
                        <td class="text-center">
                            {{ $item->tgl_pinjam ?? $item->tanggal_pinjam ?? $item->tgl_peminjaman ?? $item->tanggal_peminjaman ?? $item->created_at ?? '-' }}
                        </td>

                        {{-- Otomatis cek berbagai nama kolom tanggal kembali --}}
                        <td class="text-center">
                            {{ $item->tgl_kembali ?? $item->tanggal_kembali ?? $item->tgl_pengembalian ?? $item->tanggal_pengembalian ?? $item->tgl_rencana_kembali ?? '-' }}
                        </td>

                        <td class="text-center fw-bold">
                            {{ $item->status ?? 'Pending' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-3 text-muted">Belum ada data peminjaman.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Area Tanda Tangan -->
        <div class="ttd-section">
            <p class="mb-1">Petugas Pengelola,</p>
            <br><br><br>
            <p class="fw-bold text-decoration-underline mb-0">
                {{ $currentUser->name ?? $currentUser->username ?? 'Petugas' }}
            </p>
            <small>NIP / ID: {{ $currentUser->id ?? '-' }}</small>
        </div>
    </div>

</body>
</html>
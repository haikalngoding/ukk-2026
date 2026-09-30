<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Alat;
use App\Models\LogAktifitas;

class PengembalianController extends Controller
{
    // 1. Tampil Halaman Index (Daftar Pengembalian)
    public function index(Request $request)
    {
        $datap = Pengembalian::orderBy('id_pengembalian', 'desc')->paginate(10);

        $peminjaman = Peminjaman::all();
        $users = User::all();
        $alats = Alat::all();

        $peminjamanList = [];
        foreach ($peminjaman as $p) {
            $pid = $p->id_peminjaman ?? $p->id;
            $peminjamanList[$pid] = $p;
        }

        $userList = [];
        foreach ($users as $u) {
            $id = $u->id ?? $u->id_user;
            $userList[$id] = $u->username ?? $u->nama ?? "User #{$id}";
        }

        $alatList = [];
        foreach ($alats as $a) {
            $id = $a->id_alat ?? $a->id;
            $alatList[$id] = $a->nama_alat ?? "Alat #{$id}";
        }

        return view('pengembalian.index', compact('datap', 'peminjamanList', 'userList', 'alatList'));
    }

    // 2. Tampil Form Tambah Pengembalian
    public function create(Request $request)
    {
        $peminjaman = Peminjaman::where('status', '!=', 'Dikembalikan')->get();
        $users = User::all();
        $alats = Alat::all();

        $userList = [];
        foreach ($users as $u) {
            $id = $u->id ?? $u->id_user;
            $userList[$id] = $u->username ?? $u->nama ?? "User #{$id}";
        }

        $alatList = [];
        foreach ($alats as $a) {
            $id = $a->id_alat ?? $a->id;
            $alatList[$id] = $a->nama_alat ?? "Alat #{$id}";
        }

        return view('pengembalian.create', compact('peminjaman', 'userList', 'alatList'));
    }

    // 3. Simpan Data Pengembalian Baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_peminjaman'        => 'required|integer',
            'tanggal_pengembalian' => 'required|date',
            'terlambat_hari'       => 'nullable|integer|min:0',
            'denda'                => 'nullable|integer|min:0',
            'kondisi_barang'       => 'nullable|string|max:100',
            'catatan'              => 'nullable|string',
        ]);

        $validatedData['terlambat_hari'] = $validatedData['terlambat_hari'] ?? 0;
        $validatedData['denda']          = $validatedData['denda'] ?? 0;
        $validatedData['kondisi_barang'] = $validatedData['kondisi_barang'] ?? 'Baik';

        Pengembalian::create($validatedData);

        // Update status di tabel peminjaman menjadi 'Dikembalikan'
        $peminjaman = Peminjaman::findOrFail($validatedData['id_peminjaman']);
        $peminjaman->update(['status' => 'Dikembalikan']);

        // MENCATAT LOG: Admin/Petugas mencatat pengembalian
        $currentUser = User::current();
        LogAktifitas::create([
            'id_user'   => $currentUser->id ?? null,
            'aktifitas' => 'Petugas/Admin mencatat pengembalian alat (Peminjaman ID: ' . $validatedData['id_peminjaman'] . ').'
        ]);

        return redirect(route('pengembalian.index'))->with('success', 'Data pengembalian berhasil ditambahkan.');
    }

    // 4. Tampil Form Edit Pengembalian (Perbaikan Query User & Alat)
    public function edit(Request $request, $id_pengembalian)
    {
        $datap = Pengembalian::findOrFail($id_pengembalian);
        $peminjaman = Peminjaman::find($datap->id_peminjaman);

        $peminjamName = '-';
        $alatName = '-';

        if ($peminjaman) {
            // Ambil User berdasarkan Primary Key
            $user = User::find($peminjaman->id_user);

            // Ambil Alat berdasarkan Primary Key atau id_alat
            $alat = Alat::find($peminjaman->id_alat);
            if (!$alat) {
                $alat = Alat::where('id_alat', $peminjaman->id_alat)->first();
            }

            $peminjamName = $user->username ?? $user->nama ?? ("User #" . $peminjaman->id_user);
            $alatName = $alat->nama_alat ?? ("Alat #" . $peminjaman->id_alat);
        }

        return view('pengembalian.edit', compact('datap', 'peminjaman', 'peminjamName', 'alatName'));
    }

    // 5. Update Data Pengembalian
    public function update(Request $request, $id_pengembalian)
    {
        $validatedData = $request->validate([
            'id_peminjaman'        => 'required|integer',
            'tanggal_pengembalian' => 'required|date',
            'terlambat_hari'       => 'nullable|integer|min:0',
            'denda'                => 'nullable|integer|min:0',
            'kondisi_barang'       => 'nullable|string|max:100',
            'catatan'              => 'nullable|string',
        ]);

        $pengembalian = Pengembalian::findOrFail($id_pengembalian);
        $pengembalian->update($validatedData);

        // MENCATAT LOG: Admin/Petugas memperbarui data pengembalian
        $currentUser = User::current();
        LogAktifitas::create([
            'id_user'   => $currentUser->id ?? null,
            'aktifitas' => 'Petugas/Admin memperbarui data pengembalian (ID: ' . $id_pengembalian . ').'
        ]);

        return redirect(route('pengembalian.index'))->with('success', 'Data pengembalian berhasil diubah.');
    }

    // 6. Hapus Data Pengembalian
    public function delete(Request $request, $id_pengembalian)
    {
        $pengembalian = Pengembalian::findOrFail($id_pengembalian);
        $pengembalian->delete();

        // MENCATAT LOG: Admin/Petugas menghapus data pengembalian
        $currentUser = User::current();
        LogAktifitas::create([
            'id_user'   => $currentUser->id ?? null,
            'aktifitas' => 'Petugas/Admin menghapus data pengembalian (ID: ' . $id_pengembalian . ').'
        ]);

        return redirect(route('pengembalian.index'))->with('success', 'Data pengembalian berhasil dihapus.');
    }

    // =========================================================================
    // TAMBAHAN KHUSUS UNTUK ROLE PEMINJAM
    // =========================================================================

    // 7. Tampil Form Pengembalian (Khusus Peminjam)
    public function createPeminjam(Request $request)
    {
        $user = User::current();
        if (!$user) {
            return redirect(route('login'))->with('error', 'Silakan login terlebih dahulu.');
        }

        $id_user = $user->id ?? $user->id_user;

        // Ambil data alat yang sedang dipinjam oleh user ini
        $peminjamanAktif = Peminjaman::where('id_user', $id_user)
                                     ->whereIn('status', ['Dipinjam', 'Disetujui', 'dipinjam', 'disetujui'])
                                     ->get();

        // Menyisipkan relasi alat secara manual agar nama alatnya muncul di dropdown
        foreach ($peminjamanAktif as $p) {
            $p->alat = Alat::where('id_alat', $p->id_alat)->first();
        }

        return view('peminjam.pengembalian', compact('user', 'peminjamanAktif'));
    }

    // 8. Simpan Pengajuan Pengembalian (Khusus Peminjam)
    public function storePeminjam(Request $request)
    {
        $currentUser = User::current();
        if (!$currentUser) {
            return redirect(route('login'))->with('error', 'Silakan login terlebih dahulu.');
        }

        $validatedData = $request->validate([
            'id_peminjaman'        => 'required|integer',
            'tanggal_pengembalian' => 'required|date',
            'kondisi_barang'       => 'nullable|string|max:100',
            'catatan'              => 'nullable|string',
        ]);

        // Set nilai default
        $validatedData['terlambat_hari'] = 0;
        $validatedData['denda']          = 0;
        $validatedData['kondisi_barang'] = $validatedData['kondisi_barang'] ?? 'Baik';

        Pengembalian::create($validatedData);

        // Update status peminjaman menjadi 'Dikembalikan'
        $peminjaman = Peminjaman::findOrFail($validatedData['id_peminjaman']);
        $peminjaman->update(['status' => 'Dikembalikan']);

        // MENCATAT LOG: Peminjam mengajukan pengembalian
        LogAktifitas::create([
            'id_user'   => $currentUser->id,
            'aktifitas' => 'Peminjam ' . ($currentUser->username ?? 'Siswa') . ' mengajukan pengembalian alat.'
        ]);

        return redirect(route('peminjam.riwayat'))->with('success', 'Pengajuan pengembalian berhasil dikirim.');
    }
}
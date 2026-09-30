<?php

namespace App\Controllers;

use App\Models\Peminjaman;
use App\Models\Alat;
use App\Models\User;
use App\Models\LogAktifitas;
use Sakuci\Http\Request;

class PeminjamanController
{
    // ==========================================
    // BAGIAN ADMIN: Kelola Semua Peminjaman
    // ==========================================

    // Menampilkan semua daftar peminjaman untuk admin
    public function index(Request $request)
    {
        $datap = Peminjaman::orderBy('id_peminjaman', 'desc')->paginate(4);
        return view('peminjaman.index', compact('datap'));
    }

    // Form tambah peminjaman oleh admin
    public function create(Request $request)
    {
        $alat = Alat::all();
        $users = User::all();
        return view('peminjaman.create', compact('alat', 'users'));
    }

    // Simpan data peminjaman dari admin
    public function store(Request $request)
    {
        $data = $request->all();
        
        // Validasi atau set status default jika belum ada
        if (!isset($data['status'])) {
            $data['status'] = 'Pending';
        }

        Peminjaman::create($data);

        // MENCATAT LOG: Admin Menambah Peminjaman
        $currentUser = User::current();
        LogAktifitas::create([
            'id_user'   => $currentUser->id ?? null,
            'aktifitas' => 'Admin menambahkan data peminjaman baru.'
        ]);

        return redirect(route('peminjaman.index'))->with('success', 'Data peminjaman berhasil ditambahkan!');
    }

    // Form edit peminjaman oleh admin
    public function edit(Request $request, $id)
    {
        $data = Peminjaman::where('id_peminjaman', $id)->first();
        if (!$data) {
            return redirect(route('peminjaman.index'))->with('error', 'Data peminjaman tidak ditemukan.');
        }

        $alat = Alat::all();
        $users = User::all();
        return view('peminjaman.edit', compact('data', 'alat', 'users'));
    }

    // Update data peminjaman oleh admin
    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::where('id_peminjaman', $id)->first();
        if (!$peminjaman) {
            return redirect(route('peminjaman.index'))->with('error', 'Data peminjaman tidak ditemukan.');
        }

        // Ambil semua request
        $input = $request->all();

        // Mencegah error SQL Incorrect integer value jika input kosong
        if (empty($input['id_alat'])) {
            $input['id_alat'] = $peminjaman->id_alat;
        }
        if (empty($input['id_user'])) {
            $input['id_user'] = $peminjaman->id_user;
        }

        $peminjaman->update($input);

        // MENCATAT LOG: Admin Memperbarui Peminjaman
        $currentUser = User::current();
        LogAktifitas::create([
            'id_user'   => $currentUser->id ?? null,
            'aktifitas' => 'Admin memperbarui data transaksi peminjaman (ID: ' . $id . ').'
        ]);

        return redirect(route('peminjaman.index'))->with('success', 'Data peminjaman berhasil diperbarui!');
    }

    // Hapus data peminjaman oleh admin
    public function delete(Request $request, $id)
    {
        $peminjaman = Peminjaman::where('id_peminjaman', $id)->first();
        if ($peminjaman) {
            $peminjaman->delete();

            // MENCATAT LOG: Admin Menghapus Peminjaman
            $currentUser = User::current();
            LogAktifitas::create([
                'id_user'   => $currentUser->id ?? null,
                'aktifitas' => 'Admin menghapus data peminjaman (ID: ' . $id . ').'
            ]);
        }

        return redirect(route('peminjaman.index'))->with('success', 'Data peminjaman berhasil dihapus!');
    }


    // ==========================================
    // BAGIAN PEMINJAM / SISWA: Pengajuan Mandiri
    // ==========================================

    // Menampilkan riwayat peminjaman milik user yang sedang login
    public function indexPeminjam(Request $request)
    {
        $currentUser = User::current();
        
        if (!$currentUser) {
            return redirect(route('login'))->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data peminjaman HANYA milik user yang sedang login
        $datap = Peminjaman::where('id_user', $currentUser->id)
                           ->orderBy('id_peminjaman', 'desc')
                           ->paginate(10);

        return view('peminjam.index_peminjam', compact('datap'));
    }

    // Form bagi siswa/peminjam untuk mengajukan peminjaman alat
    public function createPeminjam(Request $request)
    {
        $alat = Alat::all();
        return view('peminjam.create_peminjam', compact('alat'));
    }

    // Proses simpan pengajuan peminjaman oleh siswa/peminjam
    public function storePeminjam(Request $request)
    {
        $currentUser = User::current();
        
        if (!$currentUser) {
            return redirect(route('login'))->with('error', 'Silakan login terlebih dahulu.');
        }

        $data = $request->all();
        
        // Otomatis set id_user ke user yang sedang login dan status jadi 'Pending'
        $data['id_user'] = $currentUser->id;
        $data['status'] = 'Pending';

        Peminjaman::create($data);

        // MENCATAT LOG: Peminjam Mengajukan Peminjaman
        LogAktifitas::create([
            'id_user'   => $currentUser->id,
            'aktifitas' => 'Peminjam ' . ($currentUser->username ?? 'Siswa') . ' mengajukan permohonan peminjaman alat baru.'
        ]);

        return redirect(route('peminjam.indexPeminjam'))->with('success', 'Pengajuan peminjaman berhasil dikirim dan masuk ke daftar riwayat!');
    }


    // ==========================================
    // BAGIAN PETUGAS: Verifikasi & Persetujuan
    // ==========================================

    // Menampilkan daftar peminjaman di panel petugas
    public function indexPetugas(Request $request)
    {
        $datap = Peminjaman::orderBy('id_peminjaman', 'desc')->paginate(10);
        
        // Menyisipkan data alat dan user ke setiap baris data
        foreach ($datap as $item) {
            $item->data_alat = Alat::where('id_alat', $item->id_alat)->first();
            $item->data_user = User::where('id', $item->id_user)->first();
        }

        return view('petugas.peminjaman', compact('datap'));
    }

    // Proses petugas menyetujui peminjaman alat
    public function setujuiPetugas(Request $request, $id)
    {
        $peminjaman = Peminjaman::where('id_peminjaman', $id)->first();

        if (!$peminjaman) {
            return redirect(route('petugas.peminjaman.index'))->with('error', 'Data peminjaman tidak ditemukan.');
        }

        // Ubah status menjadi 'Disetujui'
        $peminjaman->update([
            'status' => 'Disetujui'
        ]);

        // MENCATAT LOG: Petugas Menyetujui Peminjaman
        $currentUser = User::current();
        LogAktifitas::create([
            'id_user'   => $currentUser->id ?? null,
            'aktifitas' => 'Petugas menyetujui transaksi peminjaman (ID: ' . $id . ').'
        ]);

        return redirect(route('petugas.peminjaman.index'))->with('success', 'Peminjaman alat berhasil disetujui!');
    }
}
<?php

namespace App\Controllers;

use App\Models\Peminjaman;
use App\Models\Alat;
use App\Models\User;
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

        return redirect(route('peminjaman.index'))->with('success', 'Data peminjaman berhasil diperbarui!');
    }

    // Hapus data peminjaman oleh admin
    public function delete(Request $request, $id)
    {
        $peminjaman = Peminjaman::where('id_peminjaman', $id)->first();
        if ($peminjaman) {
            $peminjaman->delete();
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
                         ->paginate(5);

        return view('peminjam.index_peminjam', compact('datap'));
    }

    // Form bagi siswa/peminjam untuk mengajukan peminjaman alat
    public function createPeminjam(Request $request, $id_alat = null)
    {
        $alat = Alat::all();
        
        // Menangkap id_alat dari query string (?id_alat=...) atau dari parameter rute
        $selectedAlatId = $id_alat ?? ($_GET['id_alat'] ?? null);

        // Kirim menggunakan array asosiatif agar 100% terbaca di view
        return view('peminjam.create_peminjam', [
            'alat' => $alat,
            'selectedAlatId' => $selectedAlatId
        ]);
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

        return redirect(route('peminjam.indexPeminjam'))->with('success', 'Pengajuan peminjaman berhasil dikirim dan masuk ke daftar riwayat!');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\KoleksiPribadi;
use App\Models\UlasanBuku;

class AdminPeminjamanController extends Controller
{
    public function createPeminjamanForm()
    {
        $users = User::all();
        $buku = Buku::all();

        return view('admin.peminjaman.create', compact('users', 'buku'));
    }

    public function createPeminjaman(Request $request)
    {
        // Validasi form
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:buku,id',
        ]);

        // Lakukan proses peminjaman di sini
        $user = User::findOrFail($request->input('user_id'));
        $buku = Buku::findOrFail($request->input('buku_id'));

        // Lakukan proses peminjaman di sini, misalnya menambahkan record ke tabel peminjaman
        $peminjaman = Peminjaman::create([
            'user_id' => $user->id,
            'buku_id' => $buku->id,
            'TanggalPeminjaman' => now(),
            'TanggalPengembalian' => now()->addDays(14), // Contoh: 14 hari batas peminjaman
            'StatusPeminjaman' => 'Dipinjam',
        ]);

        KoleksiPribadi::create([
            'user_id' => $user->id,
            'buku_id' => $buku->id,
            'peminjaman_id' => $peminjaman->id,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.peminjaman.index')->with('success', 'Peminjaman berhasil.');
    }

    public function index()
    {
        // Ambil data peminjaman untuk ditampilkan di halaman index
        $peminjamans = Peminjaman::all();

        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    // Tambahkan fungsi-fungsi CRUD lainnya seperti edit, update, dan delete jika diperlukan
}

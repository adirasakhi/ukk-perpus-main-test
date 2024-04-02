<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\KoleksiPribadi;
use App\Models\UlasanBuku;
use RealRashid\SweetAlert\Facades\Alert;

class PeminjamanController extends Controller
{
    public function pinjamBuku($id)
    {
    // Periksa apakah pengguna sudah login
    if (Auth::check()) {
        // Ambil informasi buku yang akan dipinjam
        $buku = Buku::findOrFail($id);
        $user = auth()->user();


        // Lakukan proses peminjaman di sini, misalnya menambahkan record ke tabel peminjaman
        $peminjaman = Peminjaman::create([
            'user_id' => $user->id,
            'buku_id' => $buku->id,
            'TanggalPeminjaman' => now(),
            'TanggalPengembalian' => now()->addDays(14), // Contoh: 14 hari batas peminjaman
            'StatusPeminjaman' => 'Dipinjam',
        ]);
        $user = auth()->user();
        KoleksiPribadi::create([
            'user_id' => $user->id,
            'buku_id' => $buku->id,
            'peminjaman_id' => $peminjaman->id,
        ]);
        // Setelah peminjaman berhasil, mungkin Anda ingin menampilkan pesan sukses
        Alert::success('Peminjaman Berhasil', 'Buku berhasil dipinjam.');
        return redirect('/')->with('success', 'Peminjaman berhasil.');
        } else {
        // Jika pengguna belum login, redirect ke halaman login dengan pesan
        Alert::error('Gagal', 'Silakan login terlebih dahulu.');
        return redirect()->route('login')->with('error', 'Sebelum pinjam, login dulu.');
        }
    }
    public function kembalikanBuku($id, Request $request)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Perbarui TanggalPengembalian dan StatusPeminjaman
        $peminjaman->update([
            'TanggalPengembalian' => now(),
            'StatusPeminjaman' => 'Dikembalikan',
        ]);

        // Tambahkan ulasan dan rating
        $ulasanBukuData = [
            'user_id' => auth()->user()->id,
            'buku_id' => $peminjaman->buku_id,
            'Ulasan' => $request->input('comment'),
            'Rating' => $request->input('rating'),
        ];



        UlasanBuku::create($ulasanBukuData);

        // Redirect kembali dengan pesan sukses
        Alert::success('Pengembalian Berhasil', 'Buku telah dikembalikan.');
        return redirect()->back()->with('success', 'Buku telah dikembalikan.');
    }
}

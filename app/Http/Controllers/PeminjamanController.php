<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\KoleksiPribadi;
use App\Models\UlasanBuku;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function pinjamBuku($id)
    {
        // Periksa apakah pengguna sudah login
        if (Auth::check()) {
            // Ambil informasi buku yang akan dipinjam
            $buku = Buku::findOrFail($id);
            $user = auth()->user();

            // Cari data peminjaman terbaru untuk buku ini oleh pengguna yang saat ini login
            $latestPeminjaman = Peminjaman::where('buku_id', $buku->id)
                ->where('user_id', $user->id)
                ->latest()
                ->first();

            // Hitung tanggal pengembalian (tanggal sekarang + 14 hari)
            $tanggalPengembalian = Carbon::now()->addDays(14);

            // Jika sudah dipinjam dan statusnya "Dikembalikan", ubah status menjadi "Dipinjam" kembali
            if ($latestPeminjaman && $latestPeminjaman->StatusPeminjaman === 'Dikembalikan') {
                $latestPeminjaman->update([
                    'StatusPeminjaman' => 'Dipinjam',
                    'TanggalPengembalian' => $tanggalPengembalian // Perbarui tanggal pengembalian
                ]);
                Alert::success('Peminjaman Berhasil', 'Buku berhasil dipinjam kembali.');
                return redirect('/')->with('success', 'Peminjaman berhasil.');
            } else {
                // Buat data peminjaman baru
                $peminjaman = Peminjaman::create([
                    'user_id' => $user->id,
                    'buku_id' => $buku->id,
                    'TanggalPeminjaman' => now(),
                    'TanggalPengembalian' => $tanggalPengembalian, // Gunakan tanggal pengembalian yang telah dihitung
                    'StatusPeminjaman' => 'Dipinjam',
                ]);
                KoleksiPribadi::create([
                    'user_id' => $user->id,
                    'buku_id' => $buku->id,
                    'peminjaman_id' => $peminjaman->id,
                ]);
                Alert::success('Peminjaman Berhasil', 'Buku berhasil dipinjam.');
                return redirect('/')->with('success', 'Peminjaman berhasil.');
            }
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

        // Cari apakah ada ulasan sebelumnya untuk buku ini oleh pengguna yang sedang login
        $ulasanBuku = UlasanBuku::where('user_id', auth()->user()->id)
                                ->where('buku_id', $peminjaman->buku_id)
                                ->first();

        // Jika ada ulasan sebelumnya, perbarui rating
        if ($ulasanBuku) {
            $ulasanBuku->update([
                'Rating' => $request->input('rating'),
            ]);
        } else {
            // Jika tidak ada ulasan sebelumnya, buat ulasan baru
            $ulasanBukuData = [
                'user_id' => auth()->user()->id,
                'buku_id' => $peminjaman->buku_id,
                'Rating' => $request->input('rating'),
            ];
            UlasanBuku::create($ulasanBukuData);
        }

        // Redirect kembali dengan pesan sukses
        Alert::success('Pengembalian Berhasil', 'Buku telah dikembalikan.');
        return redirect()->back()->with('success', 'Buku telah dikembalikan.');
    }

}

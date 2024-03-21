<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\User;
use App\Models\KategoriBuku;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data buku dengan relasi kategori
        $query = Buku::with('kategori');

        // Filter berdasarkan kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->whereHas('kategori', function ($query) use ($request) {
                $query->where('nama_kategori', $request->kategori);
            });
        }

        // Pencarian
        if ($request->has('search')) {
            $query->where(function ($query) use ($request) {
                $query->where('judul', 'like', '%' . $request->search . '%')
                    ->orWhere('penulis', 'like', '%' . $request->search . '%');
            });
        }

        // Filter buku yang tidak sedang dipinjam oleh lebih dari 5 pengguna dan bukan oleh pengguna saat ini
        $query->whereDoesntHave('peminjaman', function ($query) {
            $query->where('StatusPeminjaman', 'Dipinjam')
                ->groupBy(['buku_id', 'peminjaman.id']) // Include additional columns in the GROUP BY clause
                ->havingRaw('COUNT(*) >= 5');
        });

        if (Auth::check()) {
            $query->whereDoesntHave('peminjaman', function ($query) {
                $query->where('user_id', Auth::id())
                    ->where('StatusPeminjaman', 'Dipinjam');
            });
        }

        // Ambil data buku setelah dilakukan filter
        $books = $query->get();
        $categories = KategoriBuku::all();

        // Tampilkan view home dengan data buku dan kategori
        return view('home', compact('books', 'categories'));
    }
    public function show($id)
    {
        // Cari buku berdasarkan ID
        $buku = Buku::findOrFail($id);

        $kategori = KategoriBuku::all();

        // Ambil ulasan buku untuk buku ini
        $ulasan = $buku->ulasan_buku;
        // Tampilkan view detail buku dengan data buku yang telah ditemukan
        return view('showbuku', compact('buku', 'kategori', 'ulasan'));
    }
}

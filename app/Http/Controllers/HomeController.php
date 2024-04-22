<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\UlasanBuku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use App\Models\KoleksiPribadi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
    public function show($slug)
{
    // Cari buku berdasarkan slug
    $buku = Buku::where('slug', $slug)->firstOrFail();

    $kategori = KategoriBuku::all();

    // Ambil ulasan buku untuk buku ini
    $ulasan = $buku->ulasan_buku;
    $collection = KoleksiPribadi::where('user_id', auth()->id())->get();

    // Cek apakah user telah login
    $isLoggedIn = Auth::check();

    // Tampilkan view detail buku dengan data buku yang telah ditemukan
    return view('showbuku', compact('buku', 'kategori', 'ulasan', 'isLoggedIn','collection'));
}

public function postReview(Request $request, $id)
{
    // Cek apakah pengguna sudah memberikan ulasan untuk buku ini
    $existingReview = UlasanBuku::where('user_id', Auth::id())
                                  ->where('buku_id', $id)
                                  ->first();

    // Jika ulasan sudah ada, tampilkan pesan kesalahan
    if ($existingReview) {
        // Jika ulasan sebelumnya adalah null, perbarui ulasan
        if ($existingReview->Ulasan == null) {
            // Validasi data input
            $request->validate([
                'Ulasan' => 'required|string',
            ]);

            // Perbarui ulasan buku yang sudah ada di basis data
            $existingReview->update([
                'Ulasan' => $request->Ulasan,
            ]);

            // Redirect kembali ke halaman detail buku setelah ulasan berhasil diperbarui
            return redirect()->back()->with('success', 'Ulasan berhasil diperbarui.');
        } else {
            // Jika ulasan sudah ada dan bukan null, tampilkan pesan kesalahan
            return redirect()->back()->with('error', 'Anda sudah memberikan ulasan untuk buku ini.');
        }
    }

    // Validasi data input
    $request->validate([
        'Ulasan' => 'required|string',
    ]);

    // Simpan ulasan buku baru ke dalam basis data
    UlasanBuku::create([
        'user_id' => Auth::id(),
        'buku_id' => $id,
        'Ulasan' => $request->Ulasan,
    ]);

    // Redirect kembali ke halaman detail buku setelah ulasan berhasil diposting
    return redirect()->back()->with('success', 'Ulasan berhasil diposting.');
}

    public function updateReview(Request $request, $user_id, $peminjaman_id)
    {
        // Validasi data input
        $request->validate([
            'Ulasan' => 'required|string',
        ]);

        // Cari ulasan berdasarkan user_id dan peminjaman_id
        $ulasan = UlasanBuku::where('user_id', $user_id)
                            ->where('id', $peminjaman_id)
                            ->firstOrFail();

        // Pastikan hanya pemilik ulasan yang dapat memperbarui ulasannya
        if ($ulasan->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk memperbarui ulasan ini.');
        }

        // Update ulasan buku
        $ulasan->Ulasan = $request->Ulasan;
        $ulasan->save();

        // Redirect kembali ke halaman detail buku setelah ulasan berhasil diperbarui
        return redirect()->route('buku.detail', ['id' => $ulasan->buku_id])->with('success', 'Ulasan berhasil diperbarui.');
    }

    public function deleteReview(Request $request, $id)
    {
        // Validasi request
        $request->validate([
            // Jika ada validasi yang diperlukan di sini
        ]);

        // Cari ulasan berdasarkan ID
        $ulasan = UlasanBuku::findOrFail($id);

        // Pastikan hanya pemilik ulasan atau admin yang dapat menghapus ulasan
        if ($ulasan->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus ulasan ini.');
        }

        // Hapus ulasan dari basis data
        $buku_id = $ulasan->buku_id;
        $ulasan->delete();

        return redirect()->back()->with('success', 'Ulasan berhasil dihapus.');
    }


}

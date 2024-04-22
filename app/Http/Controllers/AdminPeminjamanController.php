<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\KoleksiPribadi;
use App\Models\UlasanBuku;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Exports\PeminjamanExport;


class AdminPeminjamanController extends Controller
{
    public function createPeminjamanForm()
    {
        $users = User::all();
        $buku = Buku::all();

        return view('adminPage.Peminjaman.create', compact('users', 'buku'));
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
        $ulasan = UlasanBuku::all();

        return view('adminPage.Peminjaman.index', compact('peminjamans', 'ulasan'));
    }
    public function destroy($id)
    {
        $kategoriBuku = Peminjaman::findOrFail($id);
        $kategoriBuku->delete();

        return redirect()->back()->with('success', 'Kategori buku berhasil dihapus.');
    }
    // Tambahkan fungsi-fungsi CRUD lainnya seperti edit, update, dan delete jika diperlukan
    public function exportExcel()
    {
        return Excel::download(new PeminjamanExport, 'Peminjaman.xlsx');
    }
    public function exportCsv()
{
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="books.csv"',
    ];

    $callback = function () {
        $handle = fopen('php://output', 'w');
        // Tulis header CSV
        fputcsv($handle, ['ID', 'nama_lengkap', 'TanggalPeminjaman', 'TanggalPengembalian', 'StatusPeminjaman']);

        // Tulis baris CSV
        $peminjamans = Peminjaman::all();
        foreach ($peminjamans as $peminjaman) {
            fputcsv($handle, [$peminjaman->id, $peminjaman->user->nama_lengkap, $peminjaman->TanggalPeminjaman, $peminjaman->TanggalPengembalian, $peminjaman->StatusPeminjaman]);
        }

        fclose($handle);
    };

    return response()->stream($callback, 200, $headers);
}
public function exportPdf()
{
    $peminjamans = Peminjaman::all();
    $pdf = PDF::loadView('adminPage.Peminjaman.pdf', compact('peminjamans'));
    return $pdf->download('peminjamans.pdf');
}
}

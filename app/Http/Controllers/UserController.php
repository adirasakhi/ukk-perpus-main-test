<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('adminPage.User.index', compact('users'));
    }

    public function create()
    {
        return view('adminPage.User.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'role' => 'required|in:admin,petugas,peminjam',
        ]);

        // Menggunakan Hash::make untuk mengamankan password
        $hashedPassword = Hash::make($request->input('password'));

        // Menyimpan data pengguna dengan password yang di-hash
        User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => $hashedPassword,
            'nama_lengkap' => $request->input('nama_lengkap'),
            'alamat' => $request->input('alamat'),
            'role' => $request->input('role'),
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function show(User $user)
    {
        return view('adminPage.User.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('adminPage.User.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'role' => 'required|in:admin,petugas,peminjam',
        ]);

        // Menggunakan Hash::make untuk mengamankan password jika ada perubahan password
        $hashedPassword = $request->filled('password') ? Hash::make($request->input('password')) : $user->password;

        $user->update([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => $hashedPassword,
            'nama_lengkap' => $request->input('nama_lengkap'),
            'alamat' => $request->input('alamat'),
            'role' => $request->input('role'),
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
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
            fputcsv($handle, ['ID', 'nama_lengkap', 'Email', 'Alamat', 'role']);
    
            // Tulis baris CSV
            $Users = User::all();
            foreach ($Users as $user) {
                fputcsv($handle, [$user->id, $user->nama_lengkap, $user->email, $user->alamat, $user->role]);
            }
    
            fclose($handle);
        };
    
        return response()->stream($callback, 200, $headers);
    }
    public function exportPdf()
    {
        $users = User::all();
        $pdf = PDF::loadView('adminPage.User.pdf', compact('users'));
        return $pdf->download('users.pdf');
    }
}

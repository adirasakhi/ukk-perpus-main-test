<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Buku;
use App\Models\Peminjaman;


class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalBooks = Buku::count();
        $totalPeminjaman = Peminjaman::count();

        return view('adminPage.dashboard', compact('totalUsers', 'totalBooks', 'totalPeminjaman'));
    }
    public function logout(){
        Auth::logout();

        return redirect()->route('login')->with('success', 'Logout berhasil.');
    }
}

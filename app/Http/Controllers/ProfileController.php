<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Peminjaman;

class ProfileController extends Controller
{
    public function index()
{
    $user = auth()->user();
    $borrowings = Peminjaman::where('user_id', $user->id)->get();
    $notReturnedCount = $borrowings->where('StatusPeminjaman', 'Dipinjam')->count() +
    $borrowings->where('StatusPeminjaman', 'DipinjamApprove')->count();

return view('profile.index', compact('user', 'borrowings', 'notReturnedCount'));
}
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use RealRashid\SweetAlert\Facades\Alert;

class CheckRolePeminjam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna memiliki peran 'peminjam'
        if ($request->user() && $request->user()->role !== 'peminjam') {
            // Jika tidak, redirect pengguna ke halaman lain dan tampilkan pesan error
            Alert::error('error', 'Anda tidak memiliki izin untuk meminjam buku.');
            return redirect()->back();
        }

        return $next($request);
}
}

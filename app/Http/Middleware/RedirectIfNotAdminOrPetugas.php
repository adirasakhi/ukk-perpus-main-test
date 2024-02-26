<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotAdminOrPetugas
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'petugas')) {
            return $next($request);
        }

        return redirect('/home');
    }
}

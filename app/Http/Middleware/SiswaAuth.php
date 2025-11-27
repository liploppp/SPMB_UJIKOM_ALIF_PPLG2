<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SiswaAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('siswa_id')) {
            return redirect()->route('home')->with('error', 'Silakan login terlebih dahulu untuk mengisi formulir pendaftaran.');
        }

        return $next($request);
    }
}
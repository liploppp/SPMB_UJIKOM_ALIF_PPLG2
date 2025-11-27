<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminAuth
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('auth.login')->with('error', 'Silakan login terlebih dahulu');
        }

        $userRole = Session::get('admin_role');
        
        // Jika ada role yang ditentukan, cek akses
        if (!empty($roles)) {
            // Admin memiliki akses ke semua
            if ($userRole !== 'admin' && !in_array($userRole, $roles)) {
                return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini');
            }
        }

        return $next($request);
    }
}
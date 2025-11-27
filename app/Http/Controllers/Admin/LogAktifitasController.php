<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogAktifitas;
use Illuminate\Http\Request;

class LogAktifitasController extends Controller
{
    public function index(Request $request)
    {
        // Pastikan hanya super admin yang bisa akses
        if (session('admin_role') !== 'admin') {
            abort(403, 'Akses ditolak. Hanya Super Admin yang dapat melihat log aktivitas.');
        }
        
        $query = LogAktifitas::with('user')->orderBy('waktu', 'desc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('aksi', 'like', "%{$search}%")
                  ->orWhere('objek', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('nama', 'like', "%{$search}%");
                  });
            });
        }

        $logs = $query->paginate(20);

        return view('admin.log-aktifitas.index', compact('logs'));
    }
}
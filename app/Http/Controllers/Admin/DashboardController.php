<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\Gelombang;
use App\Models\Jurusan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPendaftar = Pendaftar::count();
        $pendaftarBaru = Pendaftar::whereDate('created_at', today())->count();
        $totalGelombang = Gelombang::count();
        $totalJurusan = Jurusan::count();

        // Data untuk chart jurusan
        $jurusanData = Pendaftar::join('jurusans', 'pendaftars.jurusan_id', '=', 'jurusans.id')
            ->selectRaw('jurusans.kode, jurusans.nama, COUNT(*) as count')
            ->groupBy('jurusans.id', 'jurusans.kode', 'jurusans.nama')
            ->get()
            ->pluck('count', 'kode')
            ->toArray();

        // Jika tidak ada data pendaftar, ambil semua jurusan dengan count 0
        if (empty($jurusanData)) {
            $jurusanData = Jurusan::pluck('kode')->mapWithKeys(function ($kode) {
                return [$kode => 0];
            })->toArray();
        }

        // Data untuk chart status
        $statusData = Pendaftar::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Jika tidak ada data status, buat array kosong
        if (empty($statusData)) {
            $statusData = ['Pending' => 0, 'Diterima' => 0, 'Ditolak' => 0];
        }

        return view('admin.dashboard', compact(
            'totalPendaftar', 
            'pendaftarBaru', 
            'totalGelombang', 
            'totalJurusan',
            'jurusanData',
            'statusData'
        ));
    }
}
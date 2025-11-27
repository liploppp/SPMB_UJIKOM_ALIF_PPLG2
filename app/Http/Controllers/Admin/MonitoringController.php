<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendaftarDataSiswa;
use App\Models\Wilayah;

class MonitoringController extends Controller
{
    public function asalWilayah()
    {
        $data = PendaftarDataSiswa::selectRaw('alamat, COUNT(*) as total')
            ->whereNotNull('alamat')
            ->where('alamat', '!=', '')
            ->groupBy('alamat')
            ->orderBy('total', 'desc')
            ->get();

        return view('admin.monitoring.asal-wilayah', compact('data'));
    }

    public function asalSekolah()
    {
        $data = \App\Models\PendaftarAsalSekolah::selectRaw('nama_sekolah, COUNT(*) as total')
            ->groupBy('nama_sekolah')
            ->orderBy('total', 'desc')
            ->get();

        return view('admin.monitoring.asal-sekolah', compact('data'));
    }

    public function siswaDiterima()
    {
        $data = \App\Models\Pendaftar::with(['dataSiswa', 'jurusan'])
            ->where('status_berkas', 'DITERIMA')
            ->whereHas('pembayaran', function($q) {
                $q->where('status', 'verified');
            })
            ->get();

        return view('admin.monitoring.siswa-diterima', compact('data'));
    }
}
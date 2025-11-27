<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Pendaftar;
use App\Models\Pembayaran;

class SiswaDashboardController extends Controller
{
    public function index()
    {
        $userId = Session::get('siswa_id');
        if (!$userId) {
            return redirect()->route('home')->with('error', 'Silakan login terlebih dahulu');
        }

        $pendaftar = Pendaftar::where('user_id', $userId)
                             ->with(['dataSiswa', 'jurusan', 'gelombang', 'berkas'])
                             ->first();

        $pembayaran = null;
        if ($pendaftar) {
            $pembayaran = Pembayaran::where('pendaftar_id', $pendaftar->id)->first();
        }

        return view('siswa.dashboard', compact('pendaftar', 'pembayaran'));
    }

    public function cetakBukti()
    {
        $userId = Session::get('siswa_id');
        $pendaftar = Pendaftar::where('user_id', $userId)
                             ->with(['dataSiswa', 'jurusan', 'gelombang', 'dataOrtu', 'asalSekolah'])
                             ->first();

        if (!$pendaftar) {
            return redirect()->route('siswa.dashboard')->with('error', 'Data pendaftar tidak ditemukan');
        }

        $pembayaran = Pembayaran::where('pendaftar_id', $pendaftar->id)->first();

        return view('pdf.bukti-pendaftaran', compact('pendaftar', 'pembayaran'));
    }
}
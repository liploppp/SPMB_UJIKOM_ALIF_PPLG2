<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftar;

class PerbaikanController extends Controller
{
    public function index()
    {
        $siswaId = session('siswa_id');
        if (!$siswaId) {
            return redirect()->route('auth.login')->with('error', 'Silakan login terlebih dahulu');
        }

        $pendaftar = Pendaftar::with(['dataSiswa', 'jurusan', 'gelombang'])
                             ->where('user_id', $siswaId)
                             ->where('status', 'DITOLAK')
                             ->first();

        if (!$pendaftar) {
            return redirect()->route('siswa.dashboard')->with('error', 'Tidak ada pendaftaran yang perlu diperbaiki');
        }

        return view('perbaikan.index', compact('pendaftar'));
    }

    public function update(Request $request)
    {
        $siswaId = session('siswa_id');
        $pendaftar = Pendaftar::where('user_id', $siswaId)->where('status', 'DITOLAK')->first();

        if (!$pendaftar) {
            return redirect()->back()->with('error', 'Data pendaftaran tidak ditemukan');
        }

        // Update status to SUBMIT for re-review
        $pendaftar->update([
            'status' => 'SUBMIT',
            'alasan_penolakan' => null
        ]);

        return redirect()->route('siswa.dashboard')->with('success', 'Pendaftaran berhasil diperbaiki dan dikirim ulang untuk ditinjau');
    }
}
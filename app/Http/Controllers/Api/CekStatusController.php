<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftar;

class CekStatusController extends Controller
{
    public function cekStatus(Request $request)
    {
        $nisn = $request->nisn;
        $nama = $request->nama;
        
        $pendaftar = Pendaftar::where('nisn', $nisn)
                             ->where('nama_lengkap', 'LIKE', '%' . $nama . '%')
                             ->first();
        
        if ($pendaftar) {
            return response()->json([
                'found' => true,
                'id' => $pendaftar->id,
                'nama' => $pendaftar->nama_lengkap,
                'nisn' => $pendaftar->nisn,
                'jurusan' => $pendaftar->jurusan->nama_jurusan ?? '-',
                'status' => $pendaftar->status,
                'tanggal_daftar' => $pendaftar->created_at->format('d/m/Y H:i')
            ]);
        }
        
        return response()->json(['found' => false]);
    }
    
    public function cetakBukti($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        return view('siswa.bukti-pendaftaran', compact('pendaftar'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Pendaftar;
use App\Models\PendaftarBerkas;

class UploadBerkasController extends Controller
{
    public function index()
    {
        $userId = Session::get('siswa_id');
        if (!$userId) {
            return redirect()->route('home')->with('error', 'Silakan login terlebih dahulu');
        }

        $pendaftar = Pendaftar::where('user_id', $userId)
                             ->with(['dataSiswa', 'jurusan', 'berkas'])
                             ->first();

        if (!$pendaftar) {
            return redirect()->route('pendaftaran')->with('error', 'Silakan lengkapi pendaftaran terlebih dahulu');
        }

        return view('siswa.upload-berkas', compact('pendaftar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:FOTO,IJAZAH,RAPOR,KK,AKTA,KIP',
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $userId = Session::get('siswa_id');
        $pendaftar = Pendaftar::where('user_id', $userId)->first();

        if (!$pendaftar) {
            return back()->with('error', 'Data pendaftar tidak ditemukan');
        }

        // Cek apakah jenis berkas sudah ada
        $existingBerkas = PendaftarBerkas::where('pendaftar_id', $pendaftar->id)
                                        ->where('jenis', $request->jenis)
                                        ->first();

        if ($existingBerkas) {
            return back()->with('error', 'Berkas ' . $request->jenis . ' sudah pernah diupload');
        }

        // Upload file
        $file = $request->file('file');
        $fileName = time() . '_' . $request->jenis . '.' . $file->getClientOriginalExtension();
        $fileSize = $file->getSize();
        
        $file->move(public_path('storage/berkas'), $fileName);

        // Simpan data berkas
        PendaftarBerkas::create([
            'pendaftar_id' => $pendaftar->id,
            'jenis' => $request->jenis,
            'nama_file' => $fileName,
            'url' => 'berkas/' . $fileName,
            'ukuran_kb' => round($fileSize / 1024),
            'valid' => 0
        ]);

        return redirect()->route('siswa.upload-berkas')->with('success', 'Berkas ' . $request->jenis . ' berhasil diupload!');
    }
}

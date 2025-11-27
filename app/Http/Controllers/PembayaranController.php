<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Pendaftar;
use App\Models\Pembayaran;
use App\Models\Gelombang;

class PembayaranController extends Controller
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

        if (!$pendaftar) {
            return redirect()->route('pendaftaran')->with('error', 'Silakan lengkapi pendaftaran terlebih dahulu');
        }

        $pembayaran = Pembayaran::where('pendaftar_id', $pendaftar->id)->first();

        return view('pembayaran', compact('pendaftar', 'pembayaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pendaftar_id' => 'required|exists:pendaftars,id',
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'nominal' => 'required|numeric|min:1',
            'tanggal_transfer' => 'required|date',
            'catatan' => 'nullable|string|max:500'
        ]);

        $userId = Session::get('siswa_id');
        $pendaftar = Pendaftar::where('id', $request->pendaftar_id)
                             ->where('user_id', $userId)
                             ->first();

        if (!$pendaftar) {
            return back()->with('error', 'Data pendaftar tidak ditemukan');
        }

        // Cek apakah sudah ada pembayaran
        $existingPembayaran = Pembayaran::where('pendaftar_id', $pendaftar->id)->first();
        if ($existingPembayaran && strtolower($existingPembayaran->status) != 'rejected') {
            return back()->with('error', 'Bukti pembayaran sudah pernah diupload');
        }

        // Upload bukti pembayaran
        $file = $request->file('bukti_pembayaran');
        $fileName = time() . '_BUKTI_BAYAR_' . $pendaftar->no_pendaftaran . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('storage/pembayaran'), $fileName);

        // Simpan atau update data pembayaran
        if ($existingPembayaran) {
            // Hapus file lama
            $oldFile = public_path('storage/' . $existingPembayaran->bukti_pembayaran);
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
            
            $existingPembayaran->update([
                'nominal' => $request->nominal,
                'tanggal_transfer' => $request->tanggal_transfer,
                'bukti_pembayaran' => 'pembayaran/' . $fileName,
                'catatan' => $request->catatan,
                'status' => 'pending',
                'tanggal_upload' => now(),
                'alasan_tolak_pembayaran' => null,
                'verified_at' => null,
                'verified_by' => null
            ]);
        } else {
            Pembayaran::create([
                'pendaftar_id' => $pendaftar->id,
                'nominal' => $request->nominal,
                'tanggal_transfer' => $request->tanggal_transfer,
                'bukti_pembayaran' => 'pembayaran/' . $fileName,
                'catatan' => $request->catatan,
                'status' => 'pending',
                'tanggal_upload' => now()
            ]);
        }

        // Update status pendaftar
        $pendaftar->update(['status' => 'BAYAR']);

        return redirect()->route('siswa.dashboard')->with('success', 'Bukti pembayaran berhasil diupload! Menunggu verifikasi admin.');
    }
}
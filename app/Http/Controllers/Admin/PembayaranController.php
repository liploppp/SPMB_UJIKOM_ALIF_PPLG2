<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        // Pastikan hanya keuangan dan admin yang bisa akses
        if (!in_array(session('admin_role'), ['keuangan', 'admin'])) {
            abort(403, 'Akses ditolak. Hanya Staff Keuangan dan Admin yang dapat mengakses halaman ini.');
        }
        
        $query = Pembayaran::query()
            ->with([
                'pendaftar' => function($q) {
                    $q->with(['dataSiswa', 'jurusan']);
                }
            ]);
        
        if ($request->status) {
            $query->whereRaw('LOWER(status) = ?', [strtolower($request->status)]);
        }
        
        $pembayaran = $query->orderBy('created_at', 'desc')->paginate(20);
        
        return view('admin.pembayaran.index', compact('pembayaran'));
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::with(['pendaftar.dataSiswa', 'verifiedBy'])->findOrFail($id);
        return view('admin.pembayaran.show', compact('pembayaran'));
    }

    public function verifikasi(Request $request, $id)
    {
        if (!in_array(session('admin_role'), ['keuangan', 'admin'])) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk verifikasi pembayaran.');
        }

        $request->validate([
            'status' => 'required|in:verified,rejected',
            'alasan_tolak_pembayaran' => 'required_if:status,rejected|nullable|string|min:10|max:500'
        ], [
            'alasan_tolak_pembayaran.required_if' => 'Alasan penolakan pembayaran wajib diisi ketika menolak pembayaran',
            'alasan_tolak_pembayaran.min' => 'Alasan penolakan minimal 10 karakter',
            'alasan_tolak_pembayaran.max' => 'Alasan penolakan maksimal 500 karakter'
        ]);
        
        \DB::beginTransaction();
        
        try {
            $pembayaran = Pembayaran::with('pendaftar')->findOrFail($id);
            
            $updateData = [
                'status' => strtolower($request->status),
                'verified_at' => now(),
                'verified_by' => session('admin_id')
            ];
            
            if ($request->status === 'rejected') {
                $updateData['alasan_tolak_pembayaran'] = $request->alasan_tolak_pembayaran;
            } else {
                $updateData['alasan_tolak_pembayaran'] = null;
            }
            
            $pembayaran->update($updateData);

            \DB::commit();
            
            $message = $request->status === 'verified' ? 'Pembayaran berhasil diterima' : 'Pembayaran berhasil ditolak';
            return redirect()->back()->with('success', $message);
            
        } catch (\Exception $e) {
            \DB::rollback();
            return redirect()->back()->with('error', 'Gagal memperbarui status: ' . $e->getMessage());
        }
    }

    public function buktiDigital($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        
        if (!$pembayaran->bukti_pembayaran) {
            abort(404, 'Bukti pembayaran tidak ditemukan');
        }

        // Try different possible file paths
        $possiblePaths = [
            $pembayaran->bukti_pembayaran,
            'public/' . $pembayaran->bukti_pembayaran,
            'pembayaran/' . basename($pembayaran->bukti_pembayaran)
        ];
        
        foreach ($possiblePaths as $path) {
            if (Storage::exists($path)) {
                return Storage::response($path);
            }
        }
        
        // Try public path
        $publicPath = public_path('storage/' . $pembayaran->bukti_pembayaran);
        if (file_exists($publicPath)) {
            return response()->file($publicPath);
        }
        
        abort(404, 'File bukti pembayaran tidak ditemukan');
    }

    public function cetakBukti($id)
    {
        $pembayaran = Pembayaran::with(['pendaftar.dataSiswa', 'pendaftar.jurusan'])->findOrFail($id);
        
        if (strtolower($pembayaran->status) !== 'verified') {
            return redirect()->back()->with('error', 'Hanya pembayaran yang sudah terverifikasi yang dapat dicetak.');
        }

        $pdf = Pdf::loadView('admin.pembayaran.bukti-pdf', compact('pembayaran'))
                  ->setPaper('a4', 'portrait')
                  ->setOptions(['defaultFont' => 'sans-serif']);
                  
        return $pdf->download('bukti-pembayaran-' . $pembayaran->pendaftar->no_pendaftaran . '.pdf');
    }

    public function destroy($id)
    {
        \DB::beginTransaction();
        
        try {
            $pembayaran = Pembayaran::with('pendaftar')->findOrFail($id);
            $noPendaftaran = $pembayaran->pendaftar->no_pendaftaran ?? 'Unknown';
            
            // Hapus file bukti pembayaran jika ada
            if ($pembayaran->bukti_pembayaran) {
                $filePaths = [
                    public_path('storage/pembayaran/' . basename($pembayaran->bukti_pembayaran)),
                    storage_path('app/public/pembayaran/' . basename($pembayaran->bukti_pembayaran))
                ];
                
                foreach ($filePaths as $filePath) {
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }
            
            // Hapus data pembayaran
            $pembayaran->delete();
            
            \DB::commit();
            
            return redirect()->route('admin.pembayaran.index')
                           ->with('success', "Data pembayaran untuk pendaftar {$noPendaftaran} berhasil dihapus.");
            
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error('Error deleting pembayaran: ' . $e->getMessage());
            
            return redirect()->back()->with('error', 'Gagal menghapus data pembayaran.');
        }
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Pendaftar;
use App\Models\PendaftarDataSiswa;
use App\Models\PendaftarDataOrtu;
use App\Models\PendaftarBerkas;
use App\Models\LogAktifitas;

class PendaftarController extends Controller
{
    public function index(Request $request)
    {
        $query = Pendaftar::with(['pengguna', 'gelombang', 'jurusan', 'dataSiswa.wilayah', 'dataOrtu']);
        
        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('no_pendaftaran', 'like', "%{$search}%")
                  ->orWhereHas('dataSiswa', function($q) use ($search) {
                      $q->where('nama', 'like', "%{$search}%");
                  });
            });
        }
        
        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $pendaftars = $query->orderBy('created_at', 'desc')->paginate(10);
        
        // Preserve query parameters in pagination
        $pendaftars->appends($request->query());
        
        return view('admin.pendaftar.index', compact('pendaftars'));
    }

    public function show($id)
    {
        $pendaftar = Pendaftar::with(['pengguna', 'gelombang', 'jurusan', 'dataSiswa.wilayah', 'dataOrtu', 'berkas'])
                              ->findOrFail($id);
        
        // Debug: cek apakah berkas ada
        if (request()->has('debug')) {
            dd([
                'pendaftar_id' => $pendaftar->id,
                'berkas_count' => $pendaftar->berkas->count(),
                'berkas_data' => $pendaftar->berkas->toArray()
            ]);
        }
        
        return view('admin.pendaftar.show', compact('pendaftar'));
    }

    public function updateStatus(Request $request, $id)
    {
        if (in_array(Session::get('admin_role'), ['admin', 'kepsek'])) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengubah status pendaftar.');
        }

        $request->validate([
            'status_berkas' => 'required|in:DITERIMA,DITOLAK',
            'alasan_tolak_berkas' => 'required_if:status_berkas,DITOLAK|nullable|string|min:10|max:500'
        ], [
            'alasan_tolak_berkas.required_if' => 'Alasan penolakan berkas wajib diisi ketika menolak berkas',
            'alasan_tolak_berkas.min' => 'Alasan penolakan minimal 10 karakter',
            'alasan_tolak_berkas.max' => 'Alasan penolakan maksimal 500 karakter'
        ]);

        $pendaftar = Pendaftar::findOrFail($id);
        $oldStatus = $pendaftar->status_berkas;
        
        $updateData = ['status_berkas' => $request->status_berkas];
        if ($request->status_berkas === 'DITOLAK') {
            $updateData['alasan_tolak_berkas'] = $request->alasan_tolak_berkas;
        } else {
            $updateData['alasan_tolak_berkas'] = null;
        }
        
        $pendaftar->update($updateData);

        if (Session::get('admin_id')) {
            LogAktifitas::create([
                'user_id' => Session::get('admin_id'),
                'aksi' => 'Update Status Berkas',
                'objek' => 'Pendaftar',
                'objek_data' => [
                    'no_pendaftaran' => $pendaftar->no_pendaftaran,
                    'status_lama' => $oldStatus,
                    'status_baru' => $request->status_berkas,
                    'alasan_tolak_berkas' => $request->alasan_tolak_berkas ?? null
                ],
                'waktu' => now(),
                'ip' => $request->ip()
            ]);
        }

        $message = $request->status_berkas === 'DITERIMA' ? 'Berkas berhasil diterima' : 'Berkas berhasil ditolak';
        return redirect()->back()->with('success', $message);
    }

    public function destroy($id)
    {
        \DB::beginTransaction();
        
        try {
            $pendaftar = Pendaftar::with(['dataSiswa', 'dataOrtu', 'berkas', 'asalSekolah'])->findOrFail($id);
            $noPendaftaran = $pendaftar->no_pendaftaran;
            $namaSiswa = $pendaftar->dataSiswa->nama ?? 'Unknown';
            
            \Log::info("Starting deletion process for pendaftar: {$noPendaftaran}");
            
            // Hapus file berkas dari storage
            $deletedFiles = [];
            $failedFiles = [];
            
            foreach ($pendaftar->berkas as $berkas) {
                $filePaths = [
                    public_path('storage/berkas/' . $berkas->nama_file),
                    storage_path('app/public/berkas/' . $berkas->nama_file)
                ];
                
                foreach ($filePaths as $filePath) {
                    if (file_exists($filePath)) {
                        if (unlink($filePath)) {
                            $deletedFiles[] = $filePath;
                        } else {
                            $failedFiles[] = $filePath;
                        }
                    }
                }
            }
            
            // Log file deletion results
            if (!empty($deletedFiles)) {
                \Log::info('Deleted files: ' . implode(', ', $deletedFiles));
            }
            if (!empty($failedFiles)) {
                \Log::warning('Failed to delete files: ' . implode(', ', $failedFiles));
            }
            
            // Hapus data terkait dalam urutan yang benar
            $pendaftar->berkas()->delete();
            
            if ($pendaftar->dataSiswa) {
                $pendaftar->dataSiswa->delete();
            }
            
            if ($pendaftar->dataOrtu) {
                $pendaftar->dataOrtu->delete();
            }
            
            if ($pendaftar->asalSekolah) {
                $pendaftar->asalSekolah->delete();
            }
            
            // Hapus data pendaftar utama
            $pendaftar->delete();
            
            \DB::commit();
            
            // Log aktivitas setelah commit berhasil
            if (Session::get('admin_id')) {
                try {
                    LogAktifitas::create([
                        'user_id' => Session::get('admin_id'),
                        'aksi' => 'Hapus Pendaftar',
                        'objek' => 'Pendaftar',
                        'objek_data' => [
                            'no_pendaftaran' => $noPendaftaran,
                            'nama_siswa' => $namaSiswa,
                            'deleted_files_count' => count($deletedFiles),
                            'failed_files_count' => count($failedFiles)
                        ],
                        'waktu' => now(),
                        'ip' => request()->ip()
                    ]);
                } catch (\Exception $logError) {
                    \Log::error('Failed to log delete activity: ' . $logError->getMessage());
                }
            }
            
            \Log::info("Successfully deleted pendaftar: {$noPendaftaran}");
            
            return redirect()->route('admin.pendaftar.index')
                           ->with('success', "Data pendaftar {$namaSiswa} ({$noPendaftaran}) berhasil dihapus beserta semua file terkait.");
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            \DB::rollback();
            \Log::error('Pendaftar not found: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Data pendaftar tidak ditemukan.');
            
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error('Error deleting pendaftar: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return redirect()->back()->with('error', 'Gagal menghapus data pendaftar. Silakan coba lagi atau hubungi administrator.');
        }
    }
}
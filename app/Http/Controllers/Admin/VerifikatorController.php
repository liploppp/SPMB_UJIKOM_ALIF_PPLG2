<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use Illuminate\Http\Request;

class VerifikatorController extends Controller
{
    public function index(Request $request)
    {
        $query = Pendaftar::with(['jurusan', 'gelombang', 'dataSiswa', 'asalSekolah']);
        
        if ($request->status) {
            $query->where('status', $request->status);
        }
        
        if ($request->jurusan) {
            $query->where('jurusan_id', $request->jurusan);
        }
        
        $pendaftar = $query->orderBy('created_at', 'desc')->paginate(20);
        $jurusans = \App\Models\Jurusan::all();
        
        return view('admin.verifikator.index', compact('pendaftar', 'jurusans'));
    }

    public function show($id)
    {
        $pendaftaran = Pendaftar::with(['jurusan', 'gelombang', 'dataSiswa', 'dataOrtu', 'berkas', 'asalSekolah', 'pengguna'])->findOrFail($id);
        return view('admin.verifikator.show', compact('pendaftaran'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Only verifikator can verify registrants
        if (session('admin_role') !== 'verifikator_adm') {
            abort(403, 'Akses ditolak. Hanya Verifikator yang dapat memverifikasi pendaftar.');
        }
        
        $pendaftaran = Pendaftar::findOrFail($id);
        
        $pendaftaran->update([
            'status' => $request->status,
            'catatan_verifikasi' => $request->catatan
        ]);

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }

    public function bulkAction(Request $request)
    {
        // Only verifikator can verify registrants
        if (session('admin_role') !== 'verifikator_adm') {
            abort(403, 'Akses ditolak. Hanya Verifikator yang dapat memverifikasi pendaftar.');
        }
        
        $ids = $request->selected_ids;
        $action = $request->bulk_action;
        
        if ($action && $ids) {
            Pendaftar::whereIn('id', $ids)->update(['status' => $action]);
            return redirect()->back()->with('success', 'Bulk action berhasil dijalankan');
        }
        
        return redirect()->back()->with('error', 'Pilih data dan aksi terlebih dahulu');
    }
}
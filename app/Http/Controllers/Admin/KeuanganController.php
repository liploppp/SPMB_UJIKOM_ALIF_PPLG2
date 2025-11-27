<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function rekap()
    {
        $pembayaran = Pembayaran::with(['pendaftar.dataSiswa'])
            ->where('status', 'verified')
            ->orderBy('verified_at', 'desc')
            ->paginate(20);
            
        $totalPembayaran = Pembayaran::where('status', 'verified')->sum('nominal');
        $totalPending = Pembayaran::where('status', 'pending')->count();
        $totalVerified = Pembayaran::where('status', 'verified')->count();
        
        return view('admin.keuangan.rekap', compact('pembayaran', 'totalPembayaran', 'totalPending', 'totalVerified'));
    }
    
    public function daftar(Request $request)
    {
        $query = Pembayaran::with(['pendaftar.dataSiswa']);
        
        if ($request->status) {
            $query->where('status', $request->status);
        }
        
        $pembayaran = $query->orderBy('created_at', 'desc')->paginate(20);
            
        return view('admin.keuangan.daftar', compact('pembayaran'));
    }
    
    public function bulkVerifikasi(Request $request)
    {
        if (!in_array(session('admin_role'), ['keuangan', 'admin'])) {
            abort(403, 'Akses ditolak. Hanya Staff Keuangan dan Admin yang dapat melakukan verifikasi.');
        }
        
        $ids = $request->selected_ids;
        $action = $request->bulk_action;
        
        if (!$ids || !$action) {
            return redirect()->back()->with('error', 'Pilih pembayaran dan aksi terlebih dahulu');
        }
        
        \DB::beginTransaction();
        
        try {
            // Update payment status
            \DB::table('pembayarans')
                ->whereIn('id', $ids)
                ->update([
                    'status' => $action,
                    'verified_at' => now(),
                    'verified_by' => session('admin_id'),
                    'updated_at' => now()
                ]);

            // Update applicant status if payment is verified
            if ($action === 'verified') {
                $pendaftarIds = \DB::table('pembayarans')
                    ->whereIn('id', $ids)
                    ->pluck('pendaftar_id');
                    
                \DB::table('pendaftars')
                    ->whereIn('id', $pendaftarIds)
                    ->update([
                        'status' => 'DITERIMA',
                        'updated_at' => now()
                    ]);
            }

            \DB::commit();
            
            $actionText = $action === 'verified' ? 'diverifikasi' : 'ditolak';
            return redirect()->back()->with('success', count($ids) . " pembayaran berhasil {$actionText}");
            
        } catch (\Exception $e) {
            \DB::rollback();
            return redirect()->back()->with('error', 'Gagal memproses bulk action: ' . $e->getMessage());
        }
    }
}
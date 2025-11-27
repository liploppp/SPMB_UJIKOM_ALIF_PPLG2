<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function dashboard()
    {
        $totalPendaftar = Pendaftar::count();
        $pendaftarPerJurusan = Pendaftar::select('jurusan_id', DB::raw('count(*) as total'))
            ->with('jurusan')
            ->groupBy('jurusan_id')
            ->get();
        
        $rekapHarian = Pendaftar::select(DB::raw('DATE(created_at) as tanggal'), DB::raw('count(*) as total'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('tanggal', 'desc')
            ->limit(7)
            ->get();

        return view('admin.reports.dashboard', compact('totalPendaftar', 'pendaftarPerJurusan', 'rekapHarian'));
    }

    public function exportExcel()
    {
        $pendaftaran = Pendaftar::with(['jurusan', 'gelombang'])->get();
        
        $filename = 'laporan_pendaftaran_' . date('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($pendaftaran) {
            $file = fopen('php://output', 'w');
            
            fputcsv($file, [
                'No Pendaftaran', 'Nama Lengkap', 'NISN', 'Jurusan', 
                'No HP', 'Asal Sekolah', 'Tanggal Daftar'
            ]);

            foreach ($pendaftaran as $item) {
                fputcsv($file, [
                    $item->no_pendaftaran,
                    $item->nama_lengkap,
                    $item->nisn,
                    $item->jurusan->nama,
                    $item->no_hp_siswa,
                    $item->asal_sekolah,
                    $item->created_at->format('d/m/Y H:i')
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
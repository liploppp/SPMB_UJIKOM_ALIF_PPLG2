<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\PendaftarDataSiswa;
use Illuminate\Support\Facades\DB;
// 

class CekStatusController extends Controller
{
    public function index(Request $request)
    {
        $nisn = $request->get('nisn');
        $nama = $request->get('nama');
        $pendaftar = null;
        $pembayaran = null;
        
        if ($nisn && $nama) {
            $result = DB::table('pendaftars')
                ->join('pendaftar_data_siswas', 'pendaftars.id', '=', 'pendaftar_data_siswas.pendaftar_id')
                ->leftJoin('jurusans', 'pendaftars.jurusan_id', '=', 'jurusans.id')
                ->leftJoin('gelombangs', 'pendaftars.gelombang_id', '=', 'gelombangs.id')
                ->leftJoin('pendaftar_asal_sekolah', 'pendaftars.id', '=', 'pendaftar_asal_sekolah.pendaftar_id')
                ->where('pendaftar_data_siswas.nisn', $nisn)
                ->where('pendaftar_data_siswas.nama', 'LIKE', '%' . $nama . '%')
                ->select(
                    'pendaftars.*',
                    'pendaftars.status_berkas',
                    'pendaftars.alasan_tolak_berkas',
                    'pendaftar_data_siswas.nama as siswa_nama',
                    'pendaftar_data_siswas.nisn as siswa_nisn',
                    'jurusans.nama as jurusan_nama',
                    'gelombangs.nama as gelombang_nama',
                    'pendaftar_asal_sekolah.nama_sekolah as asal_sekolah'
                )
                ->first();
            
            if ($result) {
                $pendaftar = (object) $result;
                
                // Get pembayaran data
                $pembayaran = DB::table('pembayarans')
                    ->where('pendaftar_id', $pendaftar->id)
                    ->first();
            }
        }
        
        return view('cek-status', compact('pendaftar', 'pembayaran', 'nisn', 'nama'));
    }
    
    public function cetakBukti($id)
    {
        $result = DB::table('pendaftars')
            ->join('pendaftar_data_siswas', 'pendaftars.id', '=', 'pendaftar_data_siswas.pendaftar_id')
            ->leftJoin('jurusans', 'pendaftars.jurusan_id', '=', 'jurusans.id')
            ->leftJoin('gelombangs', 'pendaftars.gelombang_id', '=', 'gelombangs.id')
            ->leftJoin('pendaftar_asal_sekolah', 'pendaftars.id', '=', 'pendaftar_asal_sekolah.pendaftar_id')
            ->leftJoin('pendaftar_data_ortus', 'pendaftars.id', '=', 'pendaftar_data_ortus.pendaftar_id')
            ->where('pendaftars.id', $id)
            ->select(
                'pendaftars.*',
                'pendaftar_data_siswas.nama as siswa_nama',
                'pendaftar_data_siswas.nisn as siswa_nisn',
                'pendaftar_data_siswas.nik as siswa_nik',
                'pendaftar_data_siswas.tmp_lahir as tempat_lahir',
                'pendaftar_data_siswas.tgl_lahir as tanggal_lahir',
                'pendaftar_data_siswas.jk as jenis_kelamin',
                'pendaftar_data_siswas.alamat as alamat',
                'jurusans.nama as jurusan_nama',
                'gelombangs.nama as gelombang_nama',
                'pendaftar_asal_sekolah.nama_sekolah as asal_sekolah',
                'pendaftar_data_ortus.nama_ayah',
                'pendaftar_data_ortus.pekerjaan_ayah',
                'pendaftar_data_ortus.nama_ibu',
                'pendaftar_data_ortus.pekerjaan_ibu'
            )
            ->first();
            
        if (!$result) {
            abort(404, 'Data pendaftar tidak ditemukan');
        }
        
        $pendaftar = (object) $result;
        
        // Get pembayaran data
        $pembayaran = DB::table('pembayarans')
            ->where('pendaftar_id', $id)
            ->first();
        
        return view('bukti-pendaftaran-pdf', compact('pendaftar', 'pembayaran'));
    }
}
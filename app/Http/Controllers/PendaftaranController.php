<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Pendaftar;
use App\Models\PendaftarDataOrtu;
use App\Models\PendaftarDataSiswa;
use App\Models\PendaftarBerkas;

use App\Models\Gelombang;
use App\Models\Jurusan;

class PendaftaranController extends Controller
{
    public function index()
    {
        // Redirect admin users to admin dashboard
        if (Session::has('admin_id')) {
            $adminRole = Session::get('admin_role');
            if (in_array($adminRole, ['admin', 'kepsek', 'verifikator_adm', 'keuangan'])) {
                return redirect()->route('admin.dashboard');
            }
        }
        
        // Check if logged in student already registered
        if (Session::has('siswa_id')) {
            $userId = Session::get('siswa_id');
            $pendaftar = Pendaftar::where('user_id', $userId)->first();
            
            if ($pendaftar) {
                // Get data siswa for cek status
                $dataSiswa = PendaftarDataSiswa::where('pendaftar_id', $pendaftar->id)->first();
                if ($dataSiswa) {
                    return redirect('/cek-status?nisn=' . $dataSiswa->nisn . '&nama=' . urlencode($dataSiswa->nama));
                }
            }
        }
        
        $gelombangAktif = Gelombang::getGelombangAktif();
        $jurusans = Jurusan::all();
        return view('pendaftaran', compact('gelombangAktif', 'jurusans'));
    }

    public function store(Request $request)
    {
        if (!Session::has('siswa_id')) {
            return redirect()->route('auth.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string',
            'no_hp_siswa' => 'required|string|max:20',
            'alamat_rumah' => 'required|string',
            'asal_sekolah' => 'required|string|max:255',
            'alamat_sekolah' => 'required|string',
            'nama_ayah' => 'required|string|max:120',
            'pekerjaan_ayah' => 'required|string|max:100',
            'no_hp_ayah' => 'required|string|max:20',
            'nama_ibu' => 'required|string|max:120',
            'pekerjaan_ibu' => 'required|string|max:100',
            'no_hp_ibu' => 'required|string|max:20',
            'pilihan_jurusan' => 'required|exists:jurusans,id',
            'nik' => 'required|string|max:20',
            'nisn' => 'required|string|max:20',
            'berkas_foto' => 'required|image|mimes:jpg,jpeg|max:2048'
        ]);

        DB::beginTransaction();
        try {
            $userId = Session::get('siswa_id');
            
            // Cek apakah user sudah pernah mendaftar
            $existingPendaftar = Pendaftar::where('user_id', $userId)->first();
            if ($existingPendaftar) {
                return redirect()->route('siswa.dashboard')->with('info', 'Anda sudah terdaftar dengan nomor: ' . $existingPendaftar->no_pendaftaran);
            }
            
            // Generate nomor pendaftaran yang unik
            $lastNumber = Pendaftar::where('no_pendaftaran', 'LIKE', 'PPDB' . date('Y') . '%')
                ->orderBy('no_pendaftaran', 'desc')
                ->first();
            
            if ($lastNumber) {
                $lastNum = (int) substr($lastNumber->no_pendaftaran, -4);
                $nextNum = $lastNum + 1;
            } else {
                $nextNum = 1;
            }
            
            $noPendaftaran = 'PPDB' . date('Y') . str_pad($nextNum, 4, '0', STR_PAD_LEFT);
            
            // Get jurusan info
            $jurusan = Jurusan::find($request->pilihan_jurusan);
            
            // Get gelombang aktif
            $gelombangAktif = Gelombang::getGelombangAktif();
            
            // Create pendaftar record
            $pendaftar = Pendaftar::create([
                'user_id' => $userId,
                'tanggal_daftar' => now(),
                'no_pendaftaran' => $noPendaftaran,
                'gelombang_id' => $gelombangAktif->id,
                'jurusan_id' => $request->pilihan_jurusan,
                'status' => 'SUBMIT'
            ]);

            // Create data siswa record
            PendaftarDataSiswa::create([
                'pendaftar_id' => $pendaftar->id,
                'nik' => $request->nik,
                'nisn' => $request->nisn,
                'nama' => $request->nama_lengkap,
                'jk' => $request->jenis_kelamin == 'Laki-laki' ? 'L' : 'P',
                'tmp_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat_rumah,
                'lat' => $request->latitude,
                'lng' => $request->longitude,
                'wilayah_id' => 1
            ]);

            // Create data ortu record
            PendaftarDataOrtu::create([
                'pendaftar_id' => $pendaftar->id,
                'nama_ayah' => $request->nama_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'hp_ayah' => $request->no_hp_ayah,
                'nama_ibu' => $request->nama_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'hp_ibu' => $request->no_hp_ibu
            ]);

            // Create asal sekolah record
            \App\Models\PendaftarAsalSekolah::create([
                'pendaftar_id' => $pendaftar->id,
                'npsn' => $request->npsn ?? '-',
                'nama_sekolah' => $request->asal_sekolah,
                'kabupaten' => $request->kabupaten ?? '-',
                'nilai_rata' => $request->nilai_rata ?? 0
            ]);

            // Handle file uploads
            $fileFields = ['berkas_ijazah', 'berkas_rapor', 'berkas_akta', 'berkas_kk', 'berkas_foto', 'berkas_kip', 'berkas_kks'];
            $fileTypes = ['IJAZAH', 'RAPOR', 'AKTA', 'KK', 'FOTO', 'KIP', 'KKS'];
            
            foreach ($fileFields as $index => $field) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $fileName = time() . '_' . $fileTypes[$index] . '.' . $file->getClientOriginalExtension();
                    
                    // Dapatkan ukuran file sebelum dipindah
                    $fileSize = $file->getSize();
                    
                    // Simpan ke public/storage/berkas
                    $file->move(public_path('storage/berkas'), $fileName);
                    
                    PendaftarBerkas::create([
                        'pendaftar_id' => $pendaftar->id,
                        'jenis' => $fileTypes[$index],
                        'nama_file' => $fileName,
                        'url' => 'berkas/' . $fileName,
                        'ukuran_kb' => round($fileSize / 1024),
                        'valid' => 0
                    ]);
                }
            }

            DB::commit();
            
            return redirect()->route('siswa.dashboard')->with('success', 'Pendaftaran berhasil! Nomor pendaftaran Anda: ' . $noPendaftaran);
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Error pendaftaran: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function uploadBerkasForm()
    {
        if (!Session::has('siswa_id')) {
            return redirect()->route('auth.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userId = Session::get('siswa_id');
        $pendaftar = Pendaftar::where('user_id', $userId)->first();

        if (!$pendaftar) {
            return redirect()->route('pendaftaran')->with('error', 'Anda belum melakukan pendaftaran.');
        }

        if ($pendaftar->status_berkas != 'DITOLAK') {
            return redirect()->route('siswa.dashboard')->with('info', 'Berkas Anda tidak memerlukan upload ulang.');
        }

        return view('upload-berkas', compact('pendaftar'));
    }

    public function uploadBerkas(Request $request)
    {
        if (!Session::has('siswa_id')) {
            return redirect()->route('auth.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userId = Session::get('siswa_id');
        $pendaftar = Pendaftar::where('user_id', $userId)->first();

        if (!$pendaftar || $pendaftar->status_berkas != 'DITOLAK') {
            return redirect()->route('siswa.dashboard')->with('error', 'Tidak dapat upload berkas.');
        }

        DB::beginTransaction();
        try {
            // Hapus berkas lama
            $oldBerkas = PendaftarBerkas::where('pendaftar_id', $pendaftar->id)->get();
            foreach ($oldBerkas as $berkas) {
                $filePath = public_path('storage/berkas/' . $berkas->nama_file);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $berkas->delete();
            }

            // Upload berkas baru
            $fileFields = ['berkas_ijazah', 'berkas_rapor', 'berkas_akta', 'berkas_kk', 'berkas_foto', 'berkas_kip'];
            $fileTypes = ['IJAZAH', 'RAPOR', 'AKTA', 'KK', 'FOTO', 'KIP'];
            
            foreach ($fileFields as $index => $field) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $fileName = time() . '_' . $fileTypes[$index] . '.' . $file->getClientOriginalExtension();
                    $fileSize = $file->getSize();
                    $file->move(public_path('storage/berkas'), $fileName);
                    
                    PendaftarBerkas::create([
                        'pendaftar_id' => $pendaftar->id,
                        'jenis' => $fileTypes[$index],
                        'nama_file' => $fileName,
                        'url' => 'berkas/' . $fileName,
                        'ukuran_kb' => round($fileSize / 1024),
                        'valid' => 0
                    ]);
                }
            }

            // Update status berkas ke SUBMIT
            $pendaftar->update([
                'status_berkas' => 'SUBMIT',
                'alasan_tolak_berkas' => null
            ]);

            DB::commit();
            return redirect()->route('siswa.dashboard')->with('success', 'Berkas berhasil diupload ulang. Menunggu verifikasi.');
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Error upload berkas: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
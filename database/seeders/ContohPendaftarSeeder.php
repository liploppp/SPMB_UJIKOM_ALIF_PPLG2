<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pendaftar;
use App\Models\PendaftarDataSiswa;
use App\Models\PendaftarAsalSekolah;
use App\Models\PendaftarBerkas;
use App\Models\Jurusan;
use App\Models\Gelombang;

class ContohPendaftarSeeder extends Seeder
{
    public function run()
    {
        // Ambil jurusan dan gelombang yang ada
        $jurusan1 = Jurusan::first();
        $gelombang1 = Gelombang::first();

        // Buat data pendaftar contoh 1
        $pendaftar1 = Pendaftar::create([
            'user_id' => 1,
            'tanggal_daftar' => now(),
            'no_pendaftaran' => 'PPDB2024001',
            'gelombang_id' => $gelombang1->id ?? 1,
            'jurusan_id' => $jurusan1->id ?? 1,
            'status' => 'SUBMIT'
        ]);

        PendaftarDataSiswa::create([
            'pendaftar_id' => $pendaftar1->id,
            'nik' => '3273010101990001',
            'nisn' => '1234567890',
            'nama' => 'Ahmad Rizki Pratama',
            'jk' => 'L',
            'tmp_lahir' => 'Bandung',
            'tgl_lahir' => '1999-01-01',
            'alamat' => 'Jl. Merdeka No. 123, Bandung',
            'wilayah_id' => 1
        ]);

        PendaftarAsalSekolah::create([
            'pendaftar_id' => $pendaftar1->id,
            'npsn' => '20219024',
            'nama_sekolah' => 'SMP Negeri 1 Bandung',
            'kabupaten' => 'Bandung',
            'nilai_rata' => 85.50
        ]);

        // Berkas untuk pendaftar 1
        PendaftarBerkas::create([
            'pendaftar_id' => $pendaftar1->id,
            'jenis' => 'IJAZAH',
            'nama_file' => '1763133204_IJAZAH.jpg',
            'url' => 'berkas/1763133204_IJAZAH.jpg',
            'ukuran_kb' => 250,
            'valid' => 1
        ]);

        PendaftarBerkas::create([
            'pendaftar_id' => $pendaftar1->id,
            'jenis' => 'FOTO',
            'nama_file' => 'foto_contoh_1.jpg',
            'url' => 'berkas/foto_contoh_1.jpg',
            'ukuran_kb' => 180,
            'valid' => 1
        ]);

        // Buat data pendaftar contoh 2
        $pendaftar2 = Pendaftar::create([
            'user_id' => 2,
            'tanggal_daftar' => now(),
            'no_pendaftaran' => 'PPDB2024002',
            'gelombang_id' => $gelombang1->id ?? 1,
            'jurusan_id' => $jurusan1->id ?? 1,
            'status' => 'DITERIMA'
        ]);

        PendaftarDataSiswa::create([
            'pendaftar_id' => $pendaftar2->id,
            'nik' => '3273010202990002',
            'nisn' => '0987654321',
            'nama' => 'Siti Nurhaliza Putri',
            'jk' => 'P',
            'tmp_lahir' => 'Jakarta',
            'tgl_lahir' => '1999-02-02',
            'alamat' => 'Jl. Sudirman No. 456, Jakarta',
            'wilayah_id' => 1
        ]);

        PendaftarAsalSekolah::create([
            'pendaftar_id' => $pendaftar2->id,
            'npsn' => '20219025',
            'nama_sekolah' => 'SMP Negeri 5 Jakarta',
            'kabupaten' => 'Jakarta Selatan',
            'nilai_rata' => 88.75
        ]);

        // Berkas untuk pendaftar 2
        PendaftarBerkas::create([
            'pendaftar_id' => $pendaftar2->id,
            'jenis' => 'RAPOR',
            'nama_file' => '1763133205_RAPOR.pdf',
            'url' => 'berkas/1763133205_RAPOR.pdf',
            'ukuran_kb' => 450,
            'valid' => 1
        ]);

        PendaftarBerkas::create([
            'pendaftar_id' => $pendaftar2->id,
            'jenis' => 'FOTO',
            'nama_file' => 'foto_contoh_2.jpg',
            'url' => 'berkas/foto_contoh_2.jpg',
            'ukuran_kb' => 220,
            'valid' => 1
        ]);

        // Buat data pendaftar contoh 3
        $pendaftar3 = Pendaftar::create([
            'user_id' => 3,
            'tanggal_daftar' => now(),
            'no_pendaftaran' => 'PPDB2024003',
            'gelombang_id' => $gelombang1->id ?? 1,
            'jurusan_id' => $jurusan1->id ?? 1,
            'status' => 'DITOLAK'
        ]);

        PendaftarDataSiswa::create([
            'pendaftar_id' => $pendaftar3->id,
            'nik' => '3273010303990003',
            'nisn' => '1122334455',
            'nama' => 'Budi Santoso Wijaya',
            'jk' => 'L',
            'tmp_lahir' => 'Surabaya',
            'tgl_lahir' => '1999-03-03',
            'alamat' => 'Jl. Diponegoro No. 789, Surabaya',
            'wilayah_id' => 1
        ]);

        PendaftarAsalSekolah::create([
            'pendaftar_id' => $pendaftar3->id,
            'npsn' => '20219026',
            'nama_sekolah' => 'SMP Kristen Petra Surabaya',
            'kabupaten' => 'Surabaya',
            'nilai_rata' => 82.25
        ]);

        // Berkas untuk pendaftar 3
        PendaftarBerkas::create([
            'pendaftar_id' => $pendaftar3->id,
            'jenis' => 'KK',
            'nama_file' => '1763133206_KK.jpg',
            'url' => 'berkas/1763133206_KK.jpg',
            'ukuran_kb' => 320,
            'valid' => 0
        ]);
    }
}
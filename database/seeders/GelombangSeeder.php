<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gelombang;
use Carbon\Carbon;

class GelombangSeeder extends Seeder
{
    public function run()
    {
        // Hapus data gelombang lama
        Gelombang::truncate();
        
        $gelombangs = [
            [
                'nama' => 'Gelombang 1',
                'tahun' => '2025-2026',
                'tgl_mulai' => Carbon::now()->startOfDay(),
                'tgl_selesai' => Carbon::now()->addDays(30)->endOfDay(),
                'biaya_daftar' => 150000
            ],
            [
                'nama' => 'Gelombang 2', 
                'tahun' => '2025-2026',
                'tgl_mulai' => Carbon::now()->addDays(31)->startOfDay(),
                'tgl_selesai' => Carbon::now()->addDays(60)->endOfDay(),
                'biaya_daftar' => 200000
            ]
        ];

        foreach ($gelombangs as $gelombang) {
            Gelombang::create($gelombang);
        }
    }
}
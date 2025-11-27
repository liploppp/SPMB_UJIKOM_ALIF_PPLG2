<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $jurusans = [
            [
                'kode' => 'PPLG',
                'nama' => 'Pengembangan Perangkat Lunak dan Gim',
                'kuota' => 36
            ],
            [
                'kode' => 'AKT',
                'nama' => 'Akuntansi dan Keuangan Lembaga',
                'kuota' => 36
            ],
            [
                'kode' => 'ANM',
                'nama' => 'Animasi',
                'kuota' => 36
            ],
            [
                'kode' => 'DKV',
                'nama' => 'Desain Komunikasi Visual',
                'kuota' => 36
            ],
            [
                'kode' => 'BDP',
                'nama' => 'Bisnis Digital Pemasaran',
                'kuota' => 36
            ]
        ];

        foreach ($jurusans as $jurusan) {
            Jurusan::create($jurusan);
        }
    }
}
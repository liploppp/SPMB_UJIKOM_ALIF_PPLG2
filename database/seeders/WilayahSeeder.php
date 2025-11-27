<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WilayahSeeder extends Seeder
{
    public function run(): void
    {
        $wilayahs = [
            ['provinsi' => 'Jawa Barat', 'kabupaten' => 'Kota Bandung', 'kecamatan' => 'Bandung Wetan', 'kelurahan' => 'Citarum', 'kodepos' => '40115'],
            ['provinsi' => 'Jawa Barat', 'kabupaten' => 'Kota Bandung', 'kecamatan' => 'Bandung Wetan', 'kelurahan' => 'Tamansari', 'kodepos' => '40116'],
            ['provinsi' => 'Jawa Barat', 'kabupaten' => 'Kota Bandung', 'kecamatan' => 'Sumur Bandung', 'kelurahan' => 'Braga', 'kodepos' => '40111'],
            ['provinsi' => 'Jawa Barat', 'kabupaten' => 'Kota Bandung', 'kecamatan' => 'Cicendo', 'kelurahan' => 'Pasirkaliki', 'kodepos' => '40171'],
            ['provinsi' => 'Jawa Barat', 'kabupaten' => 'Kota Bandung', 'kecamatan' => 'Coblong', 'kelurahan' => 'Dago', 'kodepos' => '40135'],
            ['provinsi' => 'Jawa Barat', 'kabupaten' => 'Kabupaten Bandung', 'kecamatan' => 'Cileunyi', 'kelurahan' => 'Cileunyi Wetan', 'kodepos' => '40622'],
            ['provinsi' => 'Jawa Barat', 'kabupaten' => 'Kabupaten Bandung', 'kecamatan' => 'Baleendah', 'kelurahan' => 'Andir', 'kodepos' => '40375'],
            ['provinsi' => 'Jawa Barat', 'kabupaten' => 'Kabupaten Bandung', 'kecamatan' => 'Soreang', 'kelurahan' => 'Soreang', 'kodepos' => '40911'],
            ['provinsi' => 'Jawa Barat', 'kabupaten' => 'Kota Cimahi', 'kecamatan' => 'Cimahi Selatan', 'kelurahan' => 'Cibeureum', 'kodepos' => '40531'],
            ['provinsi' => 'Jawa Barat', 'kabupaten' => 'Kota Cimahi', 'kecamatan' => 'Cimahi Tengah', 'kelurahan' => 'Baros', 'kodepos' => '40521'],
        ];

        foreach ($wilayahs as $wilayah) {
            DB::table('wilayahs')->insert(array_merge($wilayah, [
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }
    }
}

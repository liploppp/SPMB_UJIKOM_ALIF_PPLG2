<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Super Admin
        Pengguna::create([
            'nama' => 'Super Administrator',
            'email' => 'admin@smkbaktinusantara.sch.id',
            'hp' => '081234567890',
            'password_hash' => Hash::make('admin123'),
            'role' => 'admin',
            'aktif' => 1
        ]);

        // Kepala Sekolah
        Pengguna::create([
            'nama' => 'Kepala Sekolah',
            'email' => 'kepsek@smkbaktinusantara.sch.id',
            'hp' => '081234567891',
            'password_hash' => Hash::make('kepsek123'),
            'role' => 'kepsek',
            'aktif' => 1
        ]);

        // Verifikator Administrasi
        Pengguna::create([
            'nama' => 'Verifikator Administrasi',
            'email' => 'verifikator@smkbaktinusantara.sch.id',
            'hp' => '081234567892',
            'password_hash' => Hash::make('verifikator123'),
            'role' => 'verifikator_adm',
            'aktif' => 1
        ]);

        // Staff Keuangan
        Pengguna::create([
            'nama' => 'Staff Keuangan',
            'email' => 'keuangan@smkbaktinusantara.sch.id',
            'hp' => '081234567893',
            'password_hash' => Hash::make('keuangan123'),
            'role' => 'keuangan',
            'aktif' => 1
        ]);
    }
}
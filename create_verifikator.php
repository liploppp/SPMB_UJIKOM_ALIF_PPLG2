<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

// Hapus verifikator lama jika ada
Pengguna::where('email', 'verifikator@smkbaktinusantara.sch.id')->delete();

// Buat verifikator baru
$verifikator = Pengguna::create([
    'nama' => 'Verifikator Administrasi',
    'email' => 'verifikator@smkbaktinusantara.sch.id',
    'hp' => '081234567892',
    'password_hash' => Hash::make('verifikator123'),
    'role' => 'verifikator',
    'aktif' => 1
]);

echo "Verifikator berhasil dibuat:\n";
echo "Email: " . $verifikator->email . "\n";
echo "Password: verifikator123\n";
echo "Role: " . $verifikator->role . "\n";
echo "Aktif: " . $verifikator->aktif . "\n";
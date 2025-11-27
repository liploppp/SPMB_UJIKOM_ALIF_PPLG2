<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Pengguna;

// Update role kepsek menjadi kepala_sekolah
$updated = Pengguna::where('role', 'kepsek')->update(['role' => 'kepala_sekolah']);

echo "Updated {$updated} kepsek records to kepala_sekolah\n";

// Tampilkan semua user admin
$users = Pengguna::whereIn('role', ['admin', 'kepala_sekolah', 'verifikator', 'keuangan'])->get();

echo "\nAdmin users:\n";
foreach ($users as $user) {
    echo "- {$user->nama} ({$user->email}) - Role: {$user->role}\n";
}
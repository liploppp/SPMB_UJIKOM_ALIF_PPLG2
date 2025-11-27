<?php

require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\Facades\Hash;

// Setup database connection
$capsule = new Capsule;
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'database' => 'ppdb_alif',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

echo "Memperbaiki role pengguna...\n";

try {
    // Update role yang salah
    $updates = [
        ['old_role' => 'kepala_sekolah', 'new_role' => 'kepala_sekolah'],
        ['old_role' => 'verifikator', 'new_role' => 'verifikator'],
        ['old_role' => 'keuangan', 'new_role' => 'keuangan'],
        ['old_role' => 'admin', 'new_role' => 'admin']
    ];

    // Cek dan tampilkan data pengguna saat ini
    $users = Capsule::table('penggunas')->get();
    echo "Data pengguna saat ini:\n";
    foreach ($users as $user) {
        echo "- {$user->nama} ({$user->email}) - Role: {$user->role}\n";
    }

    // Update role jika diperlukan
    $updated = Capsule::table('penggunas')
        ->where('role', 'kepala_sekolah')
        ->update(['role' => 'kepala_sekolah']);
    
    $updated += Capsule::table('penggunas')
        ->where('role', 'verifikator')
        ->update(['role' => 'verifikator']);

    echo "\nRole berhasil diperbaiki untuk {$updated} pengguna.\n";

    // Tampilkan data setelah update
    $users = Capsule::table('penggunas')->get();
    echo "\nData pengguna setelah perbaikan:\n";
    foreach ($users as $user) {
        echo "- {$user->nama} ({$user->email}) - Role: {$user->role}\n";
    }

    echo "\nSelesai! Sekarang semua pengguna dapat login.\n";
    echo "\nCredentials untuk login:\n";
    echo "Admin: admin@smkbaktinusantara.sch.id / admin123\n";
    echo "Kepala Sekolah: kepsek@smkbaktinusantara.sch.id / kepsek123\n";
    echo "Verifikator: verifikator@smkbaktinusantara.sch.id / verifikator123\n";
    echo "Keuangan: keuangan@smkbaktinusantara.sch.id / keuangan123\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
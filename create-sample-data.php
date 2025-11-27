<?php
// Script untuk membuat data contoh langsung

require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

// Setup database connection
$capsule = new Capsule;
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'ujikom_alif',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

try {
    // Insert pendaftar
    $pendaftarId = Capsule::table('pendaftars')->insertGetId([
        'user_id' => 1,
        'tanggal_daftar' => date('Y-m-d H:i:s'),
        'no_pendaftaran' => 'PPDB2024001',
        'gelombang_id' => 1,
        'jurusan_id' => 1,
        'status' => 'pending',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ]);

    // Insert data siswa
    Capsule::table('pendaftar_data_siswas')->insert([
        'pendaftar_id' => $pendaftarId,
        'nik' => '3273010101990001',
        'nisn' => '1234567890',
        'nama' => 'Ahmad Rizki Pratama',
        'jk' => 'L',
        'tmp_lahir' => 'Bandung',
        'tgl_lahir' => '1999-01-01',
        'alamat' => 'Jl. Merdeka No. 123, Bandung',
        'wilayah_id' => 1,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ]);

    echo "Data sample berhasil dibuat!\n";
    echo "NISN: 1234567890\n";
    echo "Nama: Ahmad Rizki Pratama\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
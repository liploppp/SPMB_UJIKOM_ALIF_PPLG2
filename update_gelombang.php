<?php
require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Carbon\Carbon;

// Setup database connection
$capsule = new Capsule;
$capsule->addConnection([
    'driver' => 'sqlite',
    'database' => __DIR__ . '/database/database.sqlite',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

// Update gelombang data
try {
    // Hapus data lama
    Capsule::table('gelombangs')->truncate();
    
    // Insert data baru
    $gelombangs = [
        [
            'nama' => 'Gelombang 1',
            'tahun' => '2026',
            'tgl_mulai' => Carbon::now()->startOfDay()->format('Y-m-d'),
            'tgl_selesai' => Carbon::now()->addDays(30)->endOfDay()->format('Y-m-d'),
            'biaya_daftar' => 150000,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'nama' => 'Gelombang 2',
            'tahun' => '2026',
            'tgl_mulai' => Carbon::now()->addDays(31)->startOfDay()->format('Y-m-d'),
            'tgl_selesai' => Carbon::now()->addDays(60)->endOfDay()->format('Y-m-d'),
            'biaya_daftar' => 200000,
            'created_at' => now(),
            'updated_at' => now()
        ]
    ];
    
    foreach ($gelombangs as $gelombang) {
        Capsule::table('gelombangs')->insert($gelombang);
    }
    
    echo "Gelombang berhasil diperbarui ke tahun 2026!\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
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

try {
    // Hapus data gelombang lama
    Capsule::table('gelombangs')->truncate();
    
    // Data dari seeder
    $gelombangs = [
        [
            'nama' => 'Gelombang 1',
            'tahun' => '2025-2026',
            'tgl_mulai' => Carbon::now()->startOfDay()->format('Y-m-d'),
            'tgl_selesai' => Carbon::now()->addDays(30)->endOfDay()->format('Y-m-d'),
            'biaya_daftar' => 150000,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],
        [
            'nama' => 'Gelombang 2',
            'tahun' => '2025-2026',
            'tgl_mulai' => Carbon::now()->addDays(31)->startOfDay()->format('Y-m-d'),
            'tgl_selesai' => Carbon::now()->addDays(60)->endOfDay()->format('Y-m-d'),
            'biaya_daftar' => 200000,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]
    ];
    
    foreach ($gelombangs as $gelombang) {
        Capsule::table('gelombangs')->insert($gelombang);
    }
    
    echo "Seeder gelombang berhasil dijalankan! Data gelombang 2025-2026 telah diperbarui.";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
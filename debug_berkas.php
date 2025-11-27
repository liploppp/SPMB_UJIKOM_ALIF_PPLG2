<?php
// Debug berkas
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\PendaftarBerkas;

$berkas = PendaftarBerkas::all();
echo "Total berkas: " . $berkas->count() . "\n\n";

foreach($berkas as $b) {
    echo "ID: " . $b->id . "\n";
    echo "Jenis: " . $b->jenis . "\n";
    echo "Nama File: " . $b->nama_file . "\n";
    echo "URL: " . $b->url . "\n";
    echo "Path lengkap: " . storage_path('app/public/berkas/' . $b->nama_file) . "\n";
    echo "File exists: " . (file_exists(storage_path('app/public/berkas/' . $b->nama_file)) ? 'YES' : 'NO') . "\n";
    echo "---\n";
}
?>
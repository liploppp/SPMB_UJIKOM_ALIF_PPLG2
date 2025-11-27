<?php
// Script untuk membuat file berkas sample

$berkasPath = 'storage/app/public/berkas/';

// Buat folder jika belum ada
if (!is_dir($berkasPath)) {
    mkdir($berkasPath, 0755, true);
}

// File berkas sample
$berkasFiles = [
    '1763133204_IJAZAH.jpg' => 'Sample IJAZAH content for Ahmad Rizki',
    '1763133205_RAPOR.pdf' => 'Sample RAPOR PDF content for Siti Nurhaliza', 
    '1763133206_KK.jpg' => 'Sample KK content for Budi Santoso',
    '1763133208_FOTO.jpg' => 'Sample FOTO content for Ahmad Rizki'
];

// Buat file berkas
foreach ($berkasFiles as $filename => $content) {
    $filePath = $berkasPath . $filename;
    if (!file_exists($filePath)) {
        file_put_contents($filePath, $content);
        echo "Created berkas: " . $filename . "\n";
    } else {
        echo "Exists berkas: " . $filename . "\n";
    }
}

echo "\nBerkas files ready!\n";
echo "Run seeder: php artisan db:seed --class=ContohPendaftarSeeder\n";
?>
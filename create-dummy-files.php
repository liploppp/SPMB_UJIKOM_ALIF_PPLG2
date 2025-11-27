<?php
// Script untuk membuat file dummy berkas

$berkasPath = 'storage/app/public/berkas/';

// Buat folder jika belum ada
if (!is_dir($berkasPath)) {
    mkdir($berkasPath, 0755, true);
}

// File dummy untuk testing
$dummyFiles = [
    '1763133204_IJAZAH.jpg',
    '1763133205_RAPOR.pdf', 
    '1763133206_KK.jpg',
    '1763133207_AKTA.jpg',
    '1763133208_FOTO.jpg'
];

// Buat file dummy
foreach ($dummyFiles as $filename) {
    $filePath = $berkasPath . $filename;
    if (!file_exists($filePath)) {
        file_put_contents($filePath, 'Dummy file content for ' . $filename);
        echo "Created: " . $filename . "\n";
    }
}

echo "Dummy files created successfully!\n";
?>
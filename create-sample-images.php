<?php
// Script untuk membuat file gambar sample

$berkasPath = 'storage/app/public/berkas/';

// Buat folder jika belum ada
if (!is_dir($berkasPath)) {
    mkdir($berkasPath, 0755, true);
}

// File sample untuk testing
$sampleFiles = [
    '1763133204_IJAZAH.jpg' => 'Sample IJAZAH image content',
    '1763133205_RAPOR.pdf' => 'Sample RAPOR PDF content', 
    '1763133206_KK.jpg' => 'Sample KK image content',
    '1763133207_AKTA.jpg' => 'Sample AKTA image content',
    '1763133208_FOTO.jpg' => 'Sample FOTO image content'
];

// Buat file sample
foreach ($sampleFiles as $filename => $content) {
    $filePath = $berkasPath . $filename;
    if (!file_exists($filePath)) {
        file_put_contents($filePath, $content);
        echo "Created: " . $filename . "\n";
    } else {
        echo "Exists: " . $filename . "\n";
    }
}

echo "\nSample files ready!\n";
echo "Test URLs:\n";
echo "- http://127.0.0.1:8000/storage/berkas/1763133204_IJAZAH.jpg\n";
echo "- http://127.0.0.1:8000/file/1763133204_IJAZAH.jpg\n";
?>
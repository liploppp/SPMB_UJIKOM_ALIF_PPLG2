<?php
echo "<h2>Test Berkas Simple</h2>";

// Test file yang ada
$testFiles = [
    '1762920188_IJAZAH.jpg',
    '1763092445_IJAZAH.jpg',
    '1763103405_IJAZAH.jpg'
];

foreach ($testFiles as $file) {
    echo "<h3>Test: $file</h3>";
    
    // Cek di public/storage
    $publicPath = __DIR__ . '/storage/berkas/' . $file;
    echo "Public path: $publicPath<br>";
    echo "Exists: " . (file_exists($publicPath) ? 'YES' : 'NO') . "<br>";
    
    if (file_exists($publicPath)) {
        echo "<img src='berkas.php?file=$file' style='max-width: 200px; border: 1px solid #ccc;'><br>";
        echo "<a href='berkas.php?file=$file' target='_blank'>Open in new tab</a><br>";
    }
    
    echo "<a href='berkas.php?file=$file&debug=1' target='_blank'>Debug info</a><br><br>";
}
?>
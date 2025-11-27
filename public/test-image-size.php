<?php
// Test ukuran gambar
$filename = $_GET['file'] ?? '1762920188_IJAZAH.jpg';
$filePath = __DIR__ . '/storage/berkas/' . $filename;

if (file_exists($filePath)) {
    list($width, $height) = getimagesize($filePath);
    $fileSize = filesize($filePath);
    
    echo "<h2>Test Gambar: $filename</h2>";
    echo "<p>Ukuran: {$width}x{$height} pixels</p>";
    echo "<p>File size: " . round($fileSize/1024, 2) . " KB</p>";
    
    echo "<h3>Gambar Normal:</h3>";
    echo "<img src='berkas.php?file=$filename' style='max-width: 400px; border: 1px solid #ccc;'><br>";
    
    echo "<h3>Gambar Thumbnail:</h3>";
    echo "<img src='berkas.php?file=$filename&thumb=1' style='max-width: 400px; border: 1px solid #ccc;'><br>";
    
    echo "<h3>Test Links:</h3>";
    echo "<a href='berkas.php?file=$filename' target='_blank'>View Normal</a> | ";
    echo "<a href='berkas.php?file=$filename&thumb=1' target='_blank'>View Thumbnail</a>";
} else {
    echo "File tidak ditemukan: $filePath";
}
?>
<?php
// Test file untuk mengecek akses berkas

echo "<h2>Test Akses Berkas</h2>";

// Cek folder berkas
$berkasDir = __DIR__ . '/../storage/app/public/berkas/';
$publicBerkasDir = __DIR__ . '/storage/berkas/';

echo "<h3>Informasi Folder:</h3>";
echo "Storage berkas dir: " . $berkasDir . "<br>";
echo "Storage berkas exists: " . (is_dir($berkasDir) ? 'YES' : 'NO') . "<br>";
echo "Public berkas dir: " . $publicBerkasDir . "<br>";
echo "Public berkas exists: " . (is_dir($publicBerkasDir) ? 'YES' : 'NO') . "<br>";

echo "<h3>File di Storage:</h3>";
if (is_dir($berkasDir)) {
    $files = scandir($berkasDir);
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            echo "- " . $file . "<br>";
        }
    }
}

echo "<h3>File di Public:</h3>";
if (is_dir($publicBerkasDir)) {
    $files = scandir($publicBerkasDir);
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            echo "- " . $file . " <a href='berkas.php?file=" . $file . "' target='_blank'>[Test]</a><br>";
        }
    }
}

echo "<h3>Test Sample Image:</h3>";
$sampleFile = '1762920188_IJAZAH.jpg';
if (file_exists($publicBerkasDir . $sampleFile)) {
    echo "<img src='berkas.php?file=" . $sampleFile . "' style='max-width: 200px; border: 1px solid #ccc;'><br>";
    echo "URL: <a href='berkas.php?file=" . $sampleFile . "' target='_blank'>berkas.php?file=" . $sampleFile . "</a>";
}
?>
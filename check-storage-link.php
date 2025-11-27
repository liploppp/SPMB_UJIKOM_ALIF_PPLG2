<?php
echo "<h2>Storage Link Check</h2>";

$publicStorage = __DIR__ . '/public/storage';
$storagePublic = __DIR__ . '/storage/app/public';

echo "<p><strong>Public Storage Path:</strong> $publicStorage</p>";
echo "<p><strong>Storage Public Path:</strong> $storagePublic</p>";

echo "<p><strong>Public Storage Exists:</strong> " . (file_exists($publicStorage) ? 'YES' : 'NO') . "</p>";
echo "<p><strong>Storage Public Exists:</strong> " . (file_exists($storagePublic) ? 'YES' : 'NO') . "</p>";

echo "<p><strong>Public Storage is Link:</strong> " . (is_link($publicStorage) ? 'YES' : 'NO') . "</p>";

if (is_link($publicStorage)) {
    echo "<p><strong>Link Target:</strong> " . readlink($publicStorage) . "</p>";
}

// Check berkas directories
$publicBerkas = __DIR__ . '/public/storage/berkas';
$storageBerkas = __DIR__ . '/storage/app/public/berkas';

echo "<hr>";
echo "<h3>Berkas Directories</h3>";
echo "<p><strong>Public Berkas:</strong> $publicBerkas</p>";
echo "<p><strong>Storage Berkas:</strong> $storageBerkas</p>";

echo "<p><strong>Public Berkas Exists:</strong> " . (file_exists($publicBerkas) ? 'YES' : 'NO') . "</p>";
echo "<p><strong>Storage Berkas Exists:</strong> " . (file_exists($storageBerkas) ? 'YES' : 'NO') . "</p>";

if (file_exists($publicBerkas)) {
    $files = scandir($publicBerkas);
    echo "<p><strong>Files in Public Berkas:</strong> " . (count($files) - 2) . "</p>";
}

if (file_exists($storageBerkas)) {
    $files = scandir($storageBerkas);
    echo "<p><strong>Files in Storage Berkas:</strong> " . (count($files) - 2) . "</p>";
}

// Create storage link if not exists
if (!file_exists($publicStorage)) {
    echo "<hr>";
    echo "<h3>Creating Storage Link</h3>";
    
    if (is_dir($storagePublic)) {
        if (symlink($storagePublic, $publicStorage)) {
            echo "<p style='color: green;'>Storage link created successfully!</p>";
        } else {
            echo "<p style='color: red;'>Failed to create storage link</p>";
        }
    } else {
        echo "<p style='color: red;'>Storage/app/public directory does not exist</p>";
    }
}
?>
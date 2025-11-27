<?php
echo "<h2>Fix Berkas Location</h2>";

$publicBerkas = __DIR__ . '/public/storage/berkas';
$storageBerkas = __DIR__ . '/storage/app/public/berkas';

// Create directories if they don't exist
if (!is_dir($storageBerkas)) {
    mkdir($storageBerkas, 0755, true);
    echo "<p>Created directory: $storageBerkas</p>";
}

if (!is_dir(dirname($publicBerkas))) {
    mkdir(dirname($publicBerkas), 0755, true);
    echo "<p>Created directory: " . dirname($publicBerkas) . "</p>";
}

// Check if files exist in public/storage/berkas
if (is_dir($publicBerkas)) {
    $files = array_diff(scandir($publicBerkas), ['.', '..']);
    
    if (!empty($files)) {
        echo "<h3>Files found in public/storage/berkas:</h3>";
        echo "<ul>";
        
        foreach ($files as $file) {
            $sourcePath = $publicBerkas . '/' . $file;
            $destPath = $storageBerkas . '/' . $file;
            
            echo "<li>$file";
            
            if (is_file($sourcePath)) {
                if (!file_exists($destPath)) {
                    if (copy($sourcePath, $destPath)) {
                        echo " - <span style='color: green;'>Copied to storage</span>";
                    } else {
                        echo " - <span style='color: red;'>Failed to copy</span>";
                    }
                } else {
                    echo " - <span style='color: blue;'>Already exists in storage</span>";
                }
            }
            
            echo "</li>";
        }
        
        echo "</ul>";
    } else {
        echo "<p>No files found in public/storage/berkas</p>";
    }
} else {
    echo "<p>public/storage/berkas directory does not exist</p>";
}

// Create storage link
$publicStorage = __DIR__ . '/public/storage';
$storagePublic = __DIR__ . '/storage/app/public';

if (!file_exists($publicStorage) && is_dir($storagePublic)) {
    if (symlink($storagePublic, $publicStorage)) {
        echo "<p style='color: green;'>Storage link created successfully!</p>";
    } else {
        echo "<p style='color: red;'>Failed to create storage link</p>";
    }
}

echo "<hr>";
echo "<h3>Final Status:</h3>";
echo "<p><strong>Storage Public Directory:</strong> " . (is_dir($storagePublic) ? 'EXISTS' : 'NOT EXISTS') . "</p>";
echo "<p><strong>Storage Berkas Directory:</strong> " . (is_dir($storageBerkas) ? 'EXISTS' : 'NOT EXISTS') . "</p>";
echo "<p><strong>Public Storage Link:</strong> " . (file_exists($publicStorage) ? 'EXISTS' : 'NOT EXISTS') . "</p>";

if (is_dir($storageBerkas)) {
    $berkasFiles = array_diff(scandir($storageBerkas), ['.', '..']);
    echo "<p><strong>Files in Storage Berkas:</strong> " . count($berkasFiles) . "</p>";
}
?>
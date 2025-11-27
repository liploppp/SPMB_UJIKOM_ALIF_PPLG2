<?php
// Test file untuk memastikan berkas.php berfungsi dengan baik
?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Berkas Display</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .test-section { margin: 20px 0; padding: 15px; border: 1px solid #ddd; border-radius: 5px; }
        .image-test { max-width: 300px; border: 1px solid #ccc; margin: 10px 0; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <h1>Test Berkas Display</h1>
    
    <div class="test-section">
        <h2>1. Debug Info</h2>
        <p><a href="berkas.php?debug=1&file=test.jpg" target="_blank">Lihat Debug Info</a></p>
    </div>
    
    <div class="test-section">
        <h2>2. Test File yang Ada</h2>
        <?php
        $berkasDir = __DIR__ . '/storage/berkas/';
        if (is_dir($berkasDir)) {
            $files = array_slice(scandir($berkasDir), 2, 5); // Ambil 5 file pertama
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    echo "<div style='margin: 10px 0; padding: 10px; background: #f9f9f9;'>";
                    echo "<strong>File:</strong> " . htmlspecialchars($file) . "<br>";
                    echo "<strong>Extension:</strong> " . $extension . "<br>";
                    
                    if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                        echo "<strong>Preview:</strong><br>";
                        echo "<img src='berkas.php?file=" . urlencode($file) . "' class='image-test' onerror=\"this.style.display='none'; this.nextSibling.style.display='block';\">";
                        echo "<div style='display:none; color:red;'>Gagal memuat gambar</div>";
                    }
                    
                    echo "<br><a href='berkas.php?file=" . urlencode($file) . "' target='_blank'>Buka File</a>";
                    echo "</div>";
                }
            }
        } else {
            echo "<p class='error'>Direktori berkas tidak ditemukan: $berkasDir</p>";
        }
        ?>
    </div>
    
    <div class="test-section">
        <h2>3. Test File yang Tidak Ada</h2>
        <p><a href="berkas.php?file=file_tidak_ada.jpg" target="_blank">Test File Tidak Ada</a></p>
    </div>
    
    <div class="test-section">
        <h2>4. Informasi Server</h2>
        <p><strong>Document Root:</strong> <?php echo $_SERVER['DOCUMENT_ROOT']; ?></p>
        <p><strong>Current Directory:</strong> <?php echo __DIR__; ?></p>
        <p><strong>Berkas Directory:</strong> <?php echo __DIR__ . '/storage/berkas/'; ?></p>
        <p><strong>Directory Exists:</strong> <?php echo is_dir(__DIR__ . '/storage/berkas/') ? 'YES' : 'NO'; ?></p>
        <p><strong>Directory Readable:</strong> <?php echo is_readable(__DIR__ . '/storage/berkas/') ? 'YES' : 'NO'; ?></p>
    </div>
</body>
</html>
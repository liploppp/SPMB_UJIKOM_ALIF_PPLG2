<?php
// Test script untuk memverifikasi perbaikan berkas

echo "<h2>Test Perbaikan Berkas Admin</h2>";

// Test 1: Cek file berkas.php
echo "<h3>1. Testing berkas.php</h3>";
$berkasFile = __DIR__ . '/public/berkas.php';
if (file_exists($berkasFile)) {
    echo "✅ File berkas.php exists<br>";
    
    // Test dengan file yang ada
    $testFiles = [
        'confusion_.jpeg',
        'foto_contoh_1.jpg',
        'nonexistent.jpg'
    ];
    
    foreach ($testFiles as $file) {
        $url = "http://localhost/ujikom_alif/berkas.php?file=" . urlencode($file);
        echo "Testing: <a href='$url' target='_blank'>$file</a><br>";
    }
} else {
    echo "❌ File berkas.php not found<br>";
}

// Test 2: Cek direktori berkas
echo "<h3>2. Testing Berkas Directory</h3>";
$berkasDir = __DIR__ . '/public/storage/berkas/';
if (is_dir($berkasDir)) {
    echo "✅ Berkas directory exists<br>";
    $files = scandir($berkasDir);
    $imageFiles = array_filter($files, function($file) {
        return in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif']);
    });
    echo "Found " . count($imageFiles) . " image files<br>";
    
    // Show first 5 files
    $count = 0;
    foreach ($imageFiles as $file) {
        if ($count >= 5) break;
        echo "- $file<br>";
        $count++;
    }
} else {
    echo "❌ Berkas directory not found<br>";
}

// Test 3: Cek FileController
echo "<h3>3. Testing FileController</h3>";
$controllerFile = __DIR__ . '/app/Http/Controllers/FileController.php';
if (file_exists($controllerFile)) {
    echo "✅ FileController exists<br>";
    $content = file_get_contents($controllerFile);
    if (strpos($content, 'validateBerkas') !== false) {
        echo "✅ validateBerkas method found<br>";
    } else {
        echo "❌ validateBerkas method not found<br>";
    }
} else {
    echo "❌ FileController not found<br>";
}

// Test 4: Cek JavaScript file
echo "<h3>4. Testing JavaScript File</h3>";
$jsFile = __DIR__ . '/public/js/admin-berkas.js';
if (file_exists($jsFile)) {
    echo "✅ admin-berkas.js exists<br>";
} else {
    echo "❌ admin-berkas.js not found<br>";
}

// Test 5: Cek routes
echo "<h3>5. Testing Routes</h3>";
$routeFile = __DIR__ . '/routes/web.php';
if (file_exists($routeFile)) {
    $content = file_get_contents($routeFile);
    if (strpos($content, 'berkas/{id}/validate') !== false) {
        echo "✅ Berkas validation route found<br>";
    } else {
        echo "❌ Berkas validation route not found<br>";
    }
} else {
    echo "❌ Routes file not found<br>";
}

echo "<h3>Summary</h3>";
echo "Perbaikan yang telah dilakukan:<br>";
echo "1. ✅ Perbaikan berkas.php dengan validasi keamanan<br>";
echo "2. ✅ Peningkatan tampilan berkas di admin panel<br>";
echo "3. ✅ Penambahan FileController dengan validasi<br>";
echo "4. ✅ JavaScript untuk validasi berkas dengan AJAX<br>";
echo "5. ✅ Error handling yang lebih baik<br>";
echo "6. ✅ Loading states dan feedback visual<br>";

echo "<br><strong>Untuk menguji:</strong><br>";
echo "1. Buka halaman admin pendaftar<br>";
echo "2. Klik detail pendaftar yang memiliki berkas<br>";
echo "3. Coba klik tombol 'Lihat File' dan 'Download'<br>";
echo "4. Coba validasi berkas jika ada tombol 'Validasi'<br>";
?>
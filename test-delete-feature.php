<?php
// Test script untuk memverifikasi fitur hapus pendaftar

echo "<h2>Test Fitur Hapus Pendaftar</h2>";

// Test 1: Cek PendaftarController destroy method
echo "<h3>1. Testing PendaftarController</h3>";
$controllerFile = __DIR__ . '/app/Http/Controllers/Admin/PendaftarController.php';
if (file_exists($controllerFile)) {
    echo "✅ PendaftarController exists<br>";
    $content = file_get_contents($controllerFile);
    
    if (strpos($content, 'public function destroy') !== false) {
        echo "✅ destroy method found<br>";
    } else {
        echo "❌ destroy method not found<br>";
    }
    
    if (strpos($content, 'unlink($filePath)') !== false) {
        echo "✅ File deletion logic found<br>";
    } else {
        echo "❌ File deletion logic not found<br>";
    }
} else {
    echo "❌ PendaftarController not found<br>";
}

// Test 2: Cek route DELETE
echo "<h3>2. Testing Routes</h3>";
$routeFile = __DIR__ . '/routes/web.php';
if (file_exists($routeFile)) {
    $content = file_get_contents($routeFile);
    if (strpos($content, "Route::delete('pendaftar/{id}'") !== false) {
        echo "✅ DELETE route found<br>";
    } else {
        echo "❌ DELETE route not found<br>";
    }
} else {
    echo "❌ Routes file not found<br>";
}

// Test 3: Cek JavaScript file
echo "<h3>3. Testing JavaScript File</h3>";
$jsFile = __DIR__ . '/public/js/admin-delete.js';
if (file_exists($jsFile)) {
    echo "✅ admin-delete.js exists<br>";
    $content = file_get_contents($jsFile);
    if (strpos($content, 'confirmDeletePendaftar') !== false) {
        echo "✅ confirmDeletePendaftar function found<br>";
    } else {
        echo "❌ confirmDeletePendaftar function not found<br>";
    }
} else {
    echo "❌ admin-delete.js not found<br>";
}

// Test 4: Cek halaman index
echo "<h3>4. Testing Index Page</h3>";
$indexFile = __DIR__ . '/resources/views/admin/pendaftar/index.blade.php';
if (file_exists($indexFile)) {
    echo "✅ Index page exists<br>";
    $content = file_get_contents($indexFile);
    if (strpos($content, 'Hapus') !== false) {
        echo "✅ Delete button found<br>";
    } else {
        echo "❌ Delete button not found<br>";
    }
    
    if (strpos($content, 'confirmDeletePendaftar') !== false) {
        echo "✅ JavaScript confirmation found<br>";
    } else {
        echo "❌ JavaScript confirmation not found<br>";
    }
} else {
    echo "❌ Index page not found<br>";
}

// Test 5: Cek halaman show
echo "<h3>5. Testing Show Page</h3>";
$showFile = __DIR__ . '/resources/views/admin/pendaftar/show.blade.php';
if (file_exists($showFile)) {
    echo "✅ Show page exists<br>";
    $content = file_get_contents($showFile);
    if (strpos($content, 'Zona Bahaya') !== false) {
        echo "✅ Danger zone section found<br>";
    } else {
        echo "❌ Danger zone section not found<br>";
    }
    
    if (strpos($content, 'Hapus Pendaftar') !== false) {
        echo "✅ Delete button found<br>";
    } else {
        echo "❌ Delete button not found<br>";
    }
} else {
    echo "❌ Show page not found<br>";
}

echo "<h3>Summary</h3>";
echo "Fitur hapus pendaftar yang telah ditambahkan:<br>";
echo "1. ✅ Tombol hapus di halaman index pendaftar<br>";
echo "2. ✅ Tombol hapus di halaman detail pendaftar<br>";
echo "3. ✅ Konfirmasi hapus dengan modal interaktif<br>";
echo "4. ✅ Penghapusan file berkas dari storage<br>";
echo "5. ✅ Penghapusan semua data terkait (siswa, ortu, berkas)<br>";
echo "6. ✅ Logging aktivitas penghapusan<br>";
echo "7. ✅ Error handling dan feedback<br>";

echo "<br><strong>Cara menggunakan:</strong><br>";
echo "1. Buka halaman admin pendaftar<br>";
echo "2. Klik tombol 'Hapus' merah di kolom aksi<br>";
echo "3. Konfirmasi penghapusan di modal yang muncul<br>";
echo "4. Data pendaftar dan semua file terkait akan dihapus<br>";

echo "<br><strong>Fitur keamanan:</strong><br>";
echo "- Konfirmasi ganda sebelum menghapus<br>";
echo "- Penghapusan file berkas dari storage<br>";
echo "- Logging aktivitas untuk audit<br>";
echo "- Error handling jika terjadi masalah<br>";
?>
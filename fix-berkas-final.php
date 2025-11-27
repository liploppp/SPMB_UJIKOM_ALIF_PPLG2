<?php
// Script final untuk memperbaiki semua masalah berkas

echo "=== PERBAIKAN BERKAS FOTO ===\n\n";

// 1. Perbaiki database
echo "1. Memperbaiki struktur database...\n";
try {
    $pdo = new PDO("mysql:host=localhost;dbname=ujikom_alif", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Ubah kolom jenis
    $pdo->exec("ALTER TABLE pendaftar_berkas MODIFY jenis VARCHAR(50) NOT NULL");
    echo "✅ Kolom jenis berhasil diubah\n";
    
    // Cek hasil
    $stmt = $pdo->query("SHOW COLUMNS FROM pendaftar_berkas LIKE 'jenis'");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "   Tipe kolom: " . $result['Type'] . "\n\n";
    
} catch(Exception $e) {
    echo "❌ Error database: " . $e->getMessage() . "\n\n";
}

// 2. Pastikan direktori berkas ada
echo "2. Memeriksa direktori berkas...\n";
$berkasDir = __DIR__ . '/public/storage/berkas';
if (!is_dir($berkasDir)) {
    mkdir($berkasDir, 0755, true);
    echo "✅ Direktori berkas dibuat\n";
} else {
    echo "✅ Direktori berkas sudah ada\n";
}

// Set permission
chmod($berkasDir, 0755);
echo "✅ Permission direktori diatur\n\n";

// 3. Test upload
echo "3. Testing upload berkas...\n";
if (is_writable($berkasDir)) {
    echo "✅ Direktori berkas dapat ditulis\n";
} else {
    echo "❌ Direktori berkas tidak dapat ditulis\n";
}

echo "\n=== PERBAIKAN SELESAI ===\n";
echo "Sekarang coba upload berkas FOTO lagi.\n";
?>
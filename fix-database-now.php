<?php
// Perbaikan database langsung

try {
    $pdo = new PDO("mysql:host=localhost;dbname=ujikom_alif", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "=== PERBAIKAN DATABASE ===\n\n";
    
    // Cek struktur saat ini
    echo "1. Struktur kolom jenis saat ini:\n";
    $stmt = $pdo->query("SHOW COLUMNS FROM pendaftar_berkas LIKE 'jenis'");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "   Tipe: " . $result['Type'] . "\n\n";
    
    // Perbaiki kolom jenis
    echo "2. Memperbaiki kolom jenis...\n";
    $pdo->exec("ALTER TABLE pendaftar_berkas MODIFY COLUMN jenis VARCHAR(50) NOT NULL");
    echo "   ✅ Berhasil diubah ke VARCHAR(50)\n\n";
    
    // Verifikasi perubahan
    echo "3. Verifikasi perubahan:\n";
    $stmt = $pdo->query("SHOW COLUMNS FROM pendaftar_berkas LIKE 'jenis'");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "   Tipe baru: " . $result['Type'] . "\n\n";
    
    // Test insert FOTO
    echo "4. Test insert FOTO:\n";
    try {
        $pdo->exec("INSERT INTO pendaftar_berkas (pendaftar_id, jenis, nama_file, url, ukuran_kb, valid, created_at, updated_at) VALUES (999, 'FOTO', 'test.jpg', 'test/test.jpg', 100, 0, NOW(), NOW())");
        echo "   ✅ Insert FOTO berhasil\n";
        
        // Hapus test data
        $pdo->exec("DELETE FROM pendaftar_berkas WHERE pendaftar_id = 999");
        echo "   ✅ Test data dihapus\n";
    } catch(Exception $e) {
        echo "   ❌ Insert FOTO gagal: " . $e->getMessage() . "\n";
    }
    
    echo "\n=== PERBAIKAN SELESAI ===\n";
    
} catch(Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
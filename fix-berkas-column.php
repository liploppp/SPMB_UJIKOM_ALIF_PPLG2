<?php
// Script untuk memperbaiki kolom jenis di tabel pendaftar_berkas

require_once __DIR__ . '/vendor/autoload.php';

// Load environment
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    // Koneksi database
    $pdo = new PDO(
        "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_DATABASE'],
        $_ENV['DB_USERNAME'],
        $_ENV['DB_PASSWORD']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Koneksi database berhasil\n";
    
    // Cek struktur tabel saat ini
    echo "\nStruktur tabel saat ini:\n";
    $stmt = $pdo->query("DESCRIBE pendaftar_berkas");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($row['Field'] == 'jenis') {
            echo "Kolom jenis: " . $row['Type'] . "\n";
        }
    }
    
    // Ubah kolom jenis
    echo "\nMengubah kolom jenis...\n";
    $pdo->exec("ALTER TABLE pendaftar_berkas MODIFY COLUMN jenis VARCHAR(20) NOT NULL");
    echo "✅ Kolom jenis berhasil diubah\n";
    
    // Verifikasi perubahan
    echo "\nStruktur tabel setelah perubahan:\n";
    $stmt = $pdo->query("DESCRIBE pendaftar_berkas");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($row['Field'] == 'jenis') {
            echo "Kolom jenis: " . $row['Type'] . "\n";
        }
    }
    
    echo "\n✅ Perbaikan berhasil! Sekarang kolom jenis dapat menampung 'FOTO' dan jenis berkas lainnya.\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>
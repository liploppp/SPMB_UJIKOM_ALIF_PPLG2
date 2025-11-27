<?php
// Perbaikan langsung database tanpa Laravel

$host = 'localhost';
$dbname = 'ujikom_alif';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Koneksi berhasil\n";
    
    // Ubah kolom jenis
    $sql = "ALTER TABLE pendaftar_berkas MODIFY jenis VARCHAR(50) NOT NULL";
    $pdo->exec($sql);
    
    echo "✅ Kolom jenis berhasil diubah ke VARCHAR(50)\n";
    
    // Cek hasil
    $stmt = $pdo->query("SHOW COLUMNS FROM pendaftar_berkas LIKE 'jenis'");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Tipe kolom jenis sekarang: " . $result['Type'] . "\n";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
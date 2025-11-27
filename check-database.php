<?php
// Cek struktur database pendaftar_berkas

try {
    $pdo = new PDO("mysql:host=localhost;dbname=ujikom_alif", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "=== ANALISIS DATABASE PENDAFTAR_BERKAS ===\n\n";
    
    // Cek struktur tabel
    echo "1. Struktur tabel pendaftar_berkas:\n";
    $stmt = $pdo->query("DESCRIBE pendaftar_berkas");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "   {$row['Field']}: {$row['Type']} {$row['Null']} {$row['Key']} {$row['Default']}\n";
    }
    
    echo "\n2. Khusus kolom jenis:\n";
    $stmt = $pdo->query("SHOW COLUMNS FROM pendaftar_berkas LIKE 'jenis'");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "   Tipe: " . $result['Type'] . "\n";
    echo "   Null: " . $result['Null'] . "\n";
    echo "   Default: " . $result['Default'] . "\n";
    
    echo "\n3. Data yang ada:\n";
    $stmt = $pdo->query("SELECT jenis, COUNT(*) as jumlah FROM pendaftar_berkas GROUP BY jenis");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "   {$row['jenis']}: {$row['jumlah']} records\n";
    }
    
} catch(Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
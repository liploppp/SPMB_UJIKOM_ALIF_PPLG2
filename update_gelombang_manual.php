<?php
// Manual database update using PDO
try {
    $pdo = new PDO('sqlite:database/database.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Delete existing data
    $pdo->exec("DELETE FROM gelombangs");
    
    // Insert new data
    $stmt = $pdo->prepare("INSERT INTO gelombangs (nama, tahun, tgl_mulai, tgl_selesai, biaya_daftar, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    $now = date('Y-m-d H:i:s');
    $today = date('Y-m-d');
    $plus30 = date('Y-m-d', strtotime('+30 days'));
    $plus31 = date('Y-m-d', strtotime('+31 days'));
    $plus60 = date('Y-m-d', strtotime('+60 days'));
    
    // Gelombang 1
    $stmt->execute(['Gelombang 1', '2025-2026', $today, $plus30, 150000, $now, $now]);
    
    // Gelombang 2
    $stmt->execute(['Gelombang 2', '2025-2026', $plus31, $plus60, 200000, $now, $now]);
    
    echo "Data gelombang berhasil diperbarui ke tahun 2026!";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
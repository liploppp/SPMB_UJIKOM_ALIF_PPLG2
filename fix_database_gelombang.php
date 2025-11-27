<?php
try {
    $pdo = new PDO('sqlite:database/database.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Update semua data gelombang yang masih 2024 menjadi 2025-2026
    $stmt = $pdo->prepare("UPDATE gelombangs SET tahun = '2025-2026' WHERE tahun LIKE '%2024%'");
    $stmt->execute();
    
    echo "Database gelombang berhasil diperbarui dari 2024 menjadi 2025-2026!";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
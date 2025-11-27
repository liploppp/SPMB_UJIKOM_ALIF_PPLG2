<?php
// Direct database update using PDO
try {
    $pdo = new PDO('sqlite:database/database.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Update existing data to 2025-2026
    $stmt = $pdo->prepare("UPDATE gelombangs SET tahun = '2025-2026' WHERE tahun != '2025-2026'");
    $stmt->execute();
    
    echo "Data gelombang berhasil diperbarui ke tahun 2025-2026!";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
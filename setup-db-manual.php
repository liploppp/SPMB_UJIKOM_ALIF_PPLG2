<?php
// Manual database setup
echo "<h2>Setting up database...</h2>";

try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '');
    
    // Create database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS ppdb_alif CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "✅ Database created<br>";
    
    // Use database
    $pdo->exec("USE ppdb_alif");
    
    // Create penggunas table
    $pdo->exec("CREATE TABLE IF NOT EXISTS penggunas (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nama VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        no_hp VARCHAR(20),
        password_hash VARCHAR(255) NOT NULL,
        role ENUM('admin', 'verifikator_adm', 'keuangan', 'kepsek', 'pendaftar') DEFAULT 'pendaftar',
        aktif BOOLEAN DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");
    echo "✅ Table penggunas created<br>";
    
    // Create otp_verifications table
    $pdo->exec("CREATE TABLE IF NOT EXISTS otp_verifications (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) NOT NULL,
        otp VARCHAR(6) NOT NULL,
        expires_at TIMESTAMP NOT NULL,
        is_verified BOOLEAN DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");
    echo "✅ Table otp_verifications created<br>";
    
    // Insert admin user
    $stmt = $pdo->prepare("INSERT IGNORE INTO penggunas (nama, email, no_hp, password_hash, role, aktif) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute(['Administrator', 'admin@smkbaktinusantara.sch.id', '081234567890', password_hash('password', PASSWORD_DEFAULT), 'admin', 1]);
    echo "✅ Admin user created<br>";
    
    echo "<br><strong>Setup completed successfully!</strong><br>";
    echo "Admin login:<br>";
    echo "Email: admin@smkbaktinusantara.sch.id<br>";
    echo "Password: password<br><br>";
    echo "<a href='/login'>Test Login</a> | <a href='/register'>Test Register</a>";
    
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>
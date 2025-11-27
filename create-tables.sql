-- Create database if not exists
CREATE DATABASE IF NOT EXISTS ppdb_alif CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ppdb_alif;

-- Create penggunas table
CREATE TABLE IF NOT EXISTS penggunas (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    no_hp VARCHAR(20),
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin', 'verifikator_adm', 'keuangan', 'kepsek', 'pendaftar') DEFAULT 'pendaftar',
    aktif BOOLEAN DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create otp_verifications table
CREATE TABLE IF NOT EXISTS otp_verifications (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    otp VARCHAR(6) NOT NULL,
    expires_at TIMESTAMP NOT NULL,
    is_verified BOOLEAN DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert admin user
INSERT IGNORE INTO penggunas (nama, email, no_hp, password_hash, role, aktif) 
VALUES ('Administrator', 'admin@smkbaktinusantara.sch.id', '081234567890', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 1);

SELECT 'Tables created successfully!' as message;
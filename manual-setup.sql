-- Manual Database Setup for PPDB System
-- Run this in phpMyAdmin or MySQL command line

-- Create database
CREATE DATABASE IF NOT EXISTS ppdb_alif;
USE ppdb_alif;

-- Show current database
SELECT DATABASE() as current_database;

-- Create basic tables if migration fails
CREATE TABLE IF NOT EXISTS sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload LONGTEXT NOT NULL,
    last_activity INT NOT NULL,
    INDEX sessions_user_id_index (user_id),
    INDEX sessions_last_activity_index (last_activity)
);

CREATE TABLE IF NOT EXISTS penggunas (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(120) UNIQUE NOT NULL,
    hp VARCHAR(20) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('pendaftar', 'admin', 'verifikator_adm', 'keuangan', 'kepsek') NOT NULL,
    aktif TINYINT DEFAULT 1,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

CREATE TABLE IF NOT EXISTS otp_verifications (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    otp VARCHAR(6) NOT NULL,
    expires_at TIMESTAMP NOT NULL,
    is_verified BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Insert sample admin user
INSERT IGNORE INTO penggunas (nama, email, hp, password_hash, role, aktif, created_at, updated_at) VALUES
('Administrator', 'admin@smk.com', '081234567890', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 1, NOW(), NOW());

-- Show tables
SHOW TABLES;
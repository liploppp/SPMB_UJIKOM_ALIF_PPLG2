-- PPDB SMK BAKTINUSANTARA 666 Database Creation Script
-- Run this in phpMyAdmin if the automated setup doesn't work

-- Create database
CREATE DATABASE IF NOT EXISTS ppdb_alif CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Use the database
USE ppdb_alif;

-- Show success message
SELECT 'Database ppdb_alif created successfully!' as message;
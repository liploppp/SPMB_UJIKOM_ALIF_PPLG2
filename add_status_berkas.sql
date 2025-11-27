-- Add status_berkas and alasan_tolak_berkas columns to pendaftar table
ALTER TABLE `pendaftar` 
ADD COLUMN `status_berkas` ENUM('SUBMIT', 'VERIFIKASI', 'DITERIMA', 'DITOLAK') DEFAULT 'SUBMIT' AFTER `status`,
ADD COLUMN `alasan_tolak_berkas` TEXT NULL AFTER `status_berkas`;

-- Rename existing alasan_penolakan to alasan_tolak_pembayaran in pembayaran table
ALTER TABLE `pembayaran` 
CHANGE COLUMN `alasan_penolakan` `alasan_tolak_pembayaran` TEXT NULL;

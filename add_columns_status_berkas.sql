-- Add status_berkas and alasan_tolak_berkas columns to pendaftars table
ALTER TABLE `pendaftars` 
ADD COLUMN `status_berkas` ENUM('SUBMIT', 'VERIFIKASI', 'DITERIMA', 'DITOLAK') DEFAULT 'SUBMIT' AFTER `status`,
ADD COLUMN `alasan_tolak_berkas` TEXT NULL AFTER `status_berkas`;

-- Add alasan_tolak_pembayaran column to pembayarans table if not exists
ALTER TABLE `pembayarans` 
ADD COLUMN `alasan_tolak_pembayaran` TEXT NULL AFTER `verified_by`;

-- Add alasan_penolakan column to pendaftar table
ALTER TABLE `pendaftar` ADD COLUMN `alasan_penolakan` TEXT NULL AFTER `status`;

-- Add alasan_penolakan column to pembayaran table
ALTER TABLE `pembayaran` ADD COLUMN `alasan_penolakan` TEXT NULL AFTER `status`;

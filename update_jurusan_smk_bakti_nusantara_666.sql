-- Update Jurusan untuk SMK BAKTI NUSANTARA 666
-- Hapus data jurusan lama
DELETE FROM jurusans;

-- Reset auto increment
ALTER TABLE jurusans AUTO_INCREMENT = 1;

-- Insert jurusan baru sesuai SMK BAKTI NUSANTARA 666
INSERT INTO jurusans (kode, nama, kuota, created_at, updated_at) VALUES
('PPLG', 'Pengembangan Perangkat Lunak dan Gim', 36, NOW(), NOW()),
('AKT', 'Akuntansi dan Keuangan Lembaga', 36, NOW(), NOW()),
('ANM', 'Animasi', 36, NOW(), NOW()),
('DKV', 'Desain Komunikasi Visual', 36, NOW(), NOW()),
('BDP', 'Bisnis Digital Pemasaran', 36, NOW(), NOW());

-- Verifikasi data
SELECT * FROM jurusans;
-- Script untuk mengisi data wilayah
-- Jalankan di phpMyAdmin atau MySQL client

USE ppdb_alif;

-- Hapus data lama jika ada
TRUNCATE TABLE wilayahs;

-- Insert data wilayah Jawa Barat
INSERT INTO wilayahs (provinsi, kabupaten, kecamatan, kelurahan, kodepos, created_at, updated_at) VALUES
('Jawa Barat', 'Kota Bandung', 'Bandung Wetan', 'Citarum', '40115', NOW(), NOW()),
('Jawa Barat', 'Kota Bandung', 'Bandung Wetan', 'Tamansari', '40116', NOW(), NOW()),
('Jawa Barat', 'Kota Bandung', 'Sumur Bandung', 'Braga', '40111', NOW(), NOW()),
('Jawa Barat', 'Kota Bandung', 'Cicendo', 'Pasirkaliki', '40171', NOW(), NOW()),
('Jawa Barat', 'Kota Bandung', 'Coblong', 'Dago', '40135', NOW(), NOW()),
('Jawa Barat', 'Kabupaten Bandung', 'Cileunyi', 'Cileunyi Wetan', '40622', NOW(), NOW()),
('Jawa Barat', 'Kabupaten Bandung', 'Baleendah', 'Andir', '40375', NOW(), NOW()),
('Jawa Barat', 'Kabupaten Bandung', 'Soreang', 'Soreang', '40911', NOW(), NOW()),
('Jawa Barat', 'Kota Cimahi', 'Cimahi Selatan', 'Cibeureum', '40531', NOW(), NOW()),
('Jawa Barat', 'Kota Cimahi', 'Cimahi Tengah', 'Baros', '40521', NOW(), NOW());

-- Verifikasi data
SELECT * FROM wilayahs ORDER BY id;

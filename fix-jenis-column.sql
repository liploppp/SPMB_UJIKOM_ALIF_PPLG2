-- Perbaikan kolom jenis di tabel pendaftar_berkas
-- Jalankan di phpMyAdmin atau MySQL Workbench

USE ujikom_alif;

-- Cek struktur saat ini
DESCRIBE pendaftar_berkas;

-- Ubah kolom jenis dari enum ke varchar
ALTER TABLE pendaftar_berkas MODIFY COLUMN jenis VARCHAR(50) NOT NULL;

-- Verifikasi perubahan
SHOW COLUMNS FROM pendaftar_berkas LIKE 'jenis';

-- Test insert FOTO
INSERT INTO pendaftar_berkas (pendaftar_id, jenis, nama_file, url, ukuran_kb, valid, created_at, updated_at) 
VALUES (999, 'FOTO', 'test.jpg', 'test/test.jpg', 100, 0, NOW(), NOW());

-- Hapus test data
DELETE FROM pendaftar_berkas WHERE pendaftar_id = 999;
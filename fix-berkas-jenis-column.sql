-- Fix untuk kolom jenis di tabel pendaftar_berkas
-- Ubah dari enum ke varchar untuk mendukung FOTO dan jenis berkas lainnya

USE ujikom_alif;

-- Ubah kolom jenis dari enum ke varchar
ALTER TABLE pendaftar_berkas MODIFY COLUMN jenis VARCHAR(20) NOT NULL;

-- Verifikasi perubahan
DESCRIBE pendaftar_berkas;
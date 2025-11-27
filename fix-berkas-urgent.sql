-- Perbaikan urgent untuk kolom jenis di tabel pendaftar_berkas
-- Jalankan di phpMyAdmin atau MySQL client

USE ujikom_alif;

-- Hapus constraint enum dan ubah ke varchar
ALTER TABLE pendaftar_berkas MODIFY jenis VARCHAR(50) NOT NULL;

-- Verifikasi perubahan
SHOW COLUMNS FROM pendaftar_berkas LIKE 'jenis';
USE ppdb_alif;

-- Cek struktur tabel pendaftars
DESCRIBE pendaftars;

-- Update kolom status untuk menambahkan BAYAR
ALTER TABLE pendaftars MODIFY COLUMN status ENUM('SUBMIT', 'BAYAR', 'VERIFIKASI', 'DITERIMA', 'DITOLAK') DEFAULT 'SUBMIT';
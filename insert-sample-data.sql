-- Insert sample data untuk testing cek status pendaftaran

-- Insert ke tabel pendaftars
INSERT INTO pendaftars (id, user_id, tanggal_daftar, no_pendaftaran, gelombang_id, jurusan_id, status, created_at, updated_at) VALUES
(1, 1, '2024-01-15 10:00:00', 'PPDB2024001', 1, 1, 'pending', NOW(), NOW()),
(2, 2, '2024-01-16 11:00:00', 'PPDB2024002', 1, 1, 'diterima', NOW(), NOW()),
(3, 3, '2024-01-17 12:00:00', 'PPDB2024003', 1, 1, 'ditolak', NOW(), NOW());

-- Insert ke tabel pendaftar_data_siswas
INSERT INTO pendaftar_data_siswas (pendaftar_id, nik, nisn, nama, jk, tmp_lahir, tgl_lahir, alamat, wilayah_id, created_at, updated_at) VALUES
(1, '3273010101990001', '1234567890', 'Ahmad Rizki Pratama', 'L', 'Bandung', '1999-01-01', 'Jl. Merdeka No. 123, Bandung', 1, NOW(), NOW()),
(2, '3273010202990002', '0987654321', 'Siti Nurhaliza Putri', 'P', 'Jakarta', '1999-02-02', 'Jl. Sudirman No. 456, Jakarta', 1, NOW(), NOW()),
(3, '3273010303990003', '1122334455', 'Budi Santoso Wijaya', 'L', 'Surabaya', '1999-03-03', 'Jl. Diponegoro No. 789, Surabaya', 1, NOW(), NOW());
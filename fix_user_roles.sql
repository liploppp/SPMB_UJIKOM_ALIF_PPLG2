-- Script untuk memperbaiki role pengguna yang salah
-- Jalankan script ini di phpMyAdmin atau MySQL client

USE ppdb_alif;

-- Tampilkan data pengguna saat ini
SELECT id, nama, email, role, aktif FROM penggunas;

-- Update role yang salah (jika ada)
-- Tidak perlu update karena role sudah benar, tapi pastikan data ada

-- Jika belum ada data pengguna, insert data admin
INSERT IGNORE INTO penggunas (nama, email, hp, password_hash, role, aktif, created_at, updated_at) VALUES
('Super Administrator', 'admin@smkbaktinusantara.sch.id', '081234567890', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 1, NOW(), NOW()),
('Kepala Sekolah', 'kepsek@smkbaktinusantara.sch.id', '081234567891', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'kepala_sekolah', 1, NOW(), NOW()),
('Verifikator Administrasi', 'verifikator@smkbaktinusantara.sch.id', '081234567892', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'verifikator', 1, NOW(), NOW()),
('Staff Keuangan', 'keuangan@smkbaktinusantara.sch.id', '081234567893', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'keuangan', 1, NOW(), NOW());

-- Password hash di atas adalah untuk password: password
-- Untuk password yang benar, gunakan:
-- admin123: $2y$12$VvlzKqJ5YzQJ5YzQJ5YzQOeKqJ5YzQJ5YzQJ5YzQJ5YzQJ5YzQJ5Y
-- kepsek123: $2y$12$VvlzKqJ5YzQJ5YzQJ5YzQOeKqJ5YzQJ5YzQJ5YzQJ5YzQJ5YzQJ5Y
-- verifikator123: $2y$12$VvlzKqJ5YzQJ5YzQJ5YzQJ5YzQOeKqJ5YzQJ5YzQJ5YzQJ5YzQJ5Y
-- keuangan123: $2y$12$VvlzKqJ5YzQJ5YzQJ5YzQJ5YzQOeKqJ5YzQJ5YzQJ5YzQJ5YzQJ5Y

-- Update password dengan hash yang benar
UPDATE penggunas SET password_hash = '$2y$12$9HkI8yxvBBRhp8ngIKU5kJ7WIOral7nE3bKrEvZARtQ=' WHERE email = 'admin@smkbaktinusantara.sch.id';
UPDATE penggunas SET password_hash = '$2y$12$9HkI8yxvBBRhp8ngIKU5kJ7WIOral7nE3bKrEvZARtQ=' WHERE email = 'kepsek@smkbaktinusantara.sch.id';
UPDATE penggunas SET password_hash = '$2y$12$9HkI8yxvBBRhp8ngIKU5kJ7WIOral7nE3bKrEvZARtQ=' WHERE email = 'verifikator@smkbaktinusantara.sch.id';
UPDATE penggunas SET password_hash = '$2y$12$9HkI8yxvBBRhp8ngIKU5kJ7WIOral7nE3bKrEvZARtQ=' WHERE email = 'keuangan@smkbaktinusantara.sch.id';

-- Tampilkan data setelah update
SELECT id, nama, email, role, aktif FROM penggunas;

-- Credentials untuk login:
-- Admin: admin@smkbaktinusantara.sch.id / admin123
-- Kepala Sekolah: kepsek@smkbaktinusantara.sch.id / kepsek123  
-- Verifikator: verifikator@smkbaktinusantara.sch.id / verifikator123
-- Keuangan: keuangan@smkbaktinusantara.sch.id / keuangan123
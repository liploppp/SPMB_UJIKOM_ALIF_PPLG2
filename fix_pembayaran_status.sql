-- Script untuk normalisasi status pembayaran
-- Jalankan script ini di phpMyAdmin atau MySQL client

USE ppdb_alif;

-- Update semua status pembayaran ke huruf kecil
UPDATE pembayarans SET status = LOWER(status);

-- Verifikasi hasil
SELECT id, pendaftar_id, status, created_at FROM pembayarans ORDER BY created_at DESC LIMIT 10;

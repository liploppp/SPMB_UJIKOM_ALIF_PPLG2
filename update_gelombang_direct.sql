DELETE FROM gelombangs;

INSERT INTO gelombangs (nama, tahun, tgl_mulai, tgl_selesai, biaya_daftar, created_at, updated_at) VALUES 
('Gelombang 1', '2026', date('now'), date('now', '+30 days'), 150000, datetime('now'), datetime('now')),
('Gelombang 2', '2026', date('now', '+31 days'), date('now', '+60 days'), 200000, datetime('now'), datetime('now'));
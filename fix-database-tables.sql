-- Fix database tables for PPDB system
USE ppdb_alif;

-- Create gelombangs table if not exists
CREATE TABLE IF NOT EXISTS `gelombangs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `tahun` year(4) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `biaya_daftar` decimal(10,2) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create jurusans table if not exists
CREATE TABLE IF NOT EXISTS `jurusans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kuota` int(11) NOT NULL DEFAULT 36,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jurusans_kode_unique` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create penggunas table if not exists
CREATE TABLE IF NOT EXISTS `penggunas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','verifikator_adm','keuangan','kepsek','pendaftar') NOT NULL DEFAULT 'pendaftar',
  `aktif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `penggunas_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create wilayahs table if not exists
CREATE TABLE IF NOT EXISTS `wilayahs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create pendaftars table if not exists
CREATE TABLE IF NOT EXISTS `pendaftars` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `tanggal_daftar` datetime NOT NULL,
  `no_pendaftaran` varchar(20) NOT NULL,
  `gelombang_id` bigint(20) unsigned NOT NULL,
  `jurusan_id` bigint(20) unsigned NOT NULL,
  `status` enum('SUBMIT','VERIFIKASI','DITERIMA','DITOLAK') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pendaftars_no_pendaftaran_unique` (`no_pendaftaran`),
  KEY `pendaftars_user_id_foreign` (`user_id`),
  KEY `pendaftars_gelombang_id_foreign` (`gelombang_id`),
  KEY `pendaftars_jurusan_id_foreign` (`jurusan_id`),
  CONSTRAINT `pendaftars_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `penggunas` (`id`),
  CONSTRAINT `pendaftars_gelombang_id_foreign` FOREIGN KEY (`gelombang_id`) REFERENCES `gelombangs` (`id`),
  CONSTRAINT `pendaftars_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusans` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create pendaftar_data_siswa table if not exists
CREATE TABLE IF NOT EXISTS `pendaftar_data_siswa` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pendaftar_id` bigint(20) unsigned NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `tmp_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `wilayah_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pendaftar_data_siswa_pendaftar_id_foreign` (`pendaftar_id`),
  KEY `pendaftar_data_siswa_wilayah_id_foreign` (`wilayah_id`),
  CONSTRAINT `pendaftar_data_siswa_pendaftar_id_foreign` FOREIGN KEY (`pendaftar_id`) REFERENCES `pendaftars` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pendaftar_data_siswa_wilayah_id_foreign` FOREIGN KEY (`wilayah_id`) REFERENCES `wilayahs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create pendaftar_data_ortu table if not exists
CREATE TABLE IF NOT EXISTS `pendaftar_data_ortu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pendaftar_id` bigint(20) unsigned NOT NULL,
  `nama_ayah` varchar(120) NOT NULL,
  `pekerjaan_ayah` varchar(100) NOT NULL,
  `hp_ayah` varchar(20) NOT NULL,
  `nama_ibu` varchar(120) NOT NULL,
  `pekerjaan_ibu` varchar(100) NOT NULL,
  `hp_ibu` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pendaftar_data_ortu_pendaftar_id_foreign` (`pendaftar_id`),
  CONSTRAINT `pendaftar_data_ortu_pendaftar_id_foreign` FOREIGN KEY (`pendaftar_id`) REFERENCES `pendaftars` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create pendaftar_berkas table if not exists
CREATE TABLE IF NOT EXISTS `pendaftar_berkas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pendaftar_id` bigint(20) unsigned NOT NULL,
  `jenis` enum('IJAZAH','RAPOR','AKTA','KK','FOTO','KIP','KKS') NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `url` varchar(500) NOT NULL,
  `ukuran_kb` int(11) NOT NULL,
  `valid` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pendaftar_berkas_pendaftar_id_foreign` (`pendaftar_id`),
  CONSTRAINT `pendaftar_berkas_pendaftar_id_foreign` FOREIGN KEY (`pendaftar_id`) REFERENCES `pendaftars` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create pendaftar_asal_sekolah table if not exists
CREATE TABLE IF NOT EXISTS `pendaftar_asal_sekolah` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pendaftar_id` bigint(20) unsigned NOT NULL,
  `npsn` varchar(20) DEFAULT NULL,
  `nama_sekolah` varchar(255) NOT NULL,
  `kabupaten` varchar(100) DEFAULT NULL,
  `nilai_rata` decimal(4,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pendaftar_asal_sekolah_pendaftar_id_foreign` (`pendaftar_id`),
  CONSTRAINT `pendaftar_asal_sekolah_pendaftar_id_foreign` FOREIGN KEY (`pendaftar_id`) REFERENCES `pendaftars` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create otp_verifications table if not exists
CREATE TABLE IF NOT EXISTS `otp_verifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `otp` varchar(6) NOT NULL,
  `expires_at` timestamp NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `otp_verifications_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create pembayarans table if not exists
CREATE TABLE IF NOT EXISTS `pembayarans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pendaftar_id` bigint(20) unsigned NOT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `status` enum('PENDING','VERIFIED','REJECTED') NOT NULL DEFAULT 'PENDING',
  `tanggal_bayar` datetime DEFAULT NULL,
  `tanggal_verifikasi` datetime DEFAULT NULL,
  `verifikator_id` bigint(20) unsigned DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pembayarans_pendaftar_id_foreign` (`pendaftar_id`),
  KEY `pembayarans_verifikator_id_foreign` (`verifikator_id`),
  CONSTRAINT `pembayarans_pendaftar_id_foreign` FOREIGN KEY (`pendaftar_id`) REFERENCES `pendaftars` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pembayarans_verifikator_id_foreign` FOREIGN KEY (`verifikator_id`) REFERENCES `penggunas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample data
INSERT IGNORE INTO `wilayahs` (`id`, `kode`, `nama`) VALUES (1, 'BDG', 'Bandung');

INSERT IGNORE INTO `gelombangs` (`id`, `nama`, `tahun`, `tgl_mulai`, `tgl_selesai`, `biaya_daftar`, `aktif`) VALUES 
(1, 'Gelombang 1', 2025, '2025-01-01', '2025-03-31', 150000.00, 1);

INSERT IGNORE INTO `jurusans` (`id`, `kode`, `nama`, `kuota`) VALUES 
(1, 'PPLG', 'Pengembangan Perangkat Lunak dan Gim', 36),
(2, 'AKT', 'Akuntansi dan Keuangan Lembaga', 36),
(3, 'ANM', 'Animasi', 36),
(4, 'DKV', 'Desain Komunikasi Visual', 36),
(5, 'PM', 'Pemasaran', 36);

-- Insert admin user
INSERT IGNORE INTO `penggunas` (`id`, `nama`, `email`, `password_hash`, `role`, `aktif`) VALUES 
(1, 'Administrator', 'admin@smkbaktinusantara666.sch.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 1);
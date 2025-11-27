CREATE TABLE IF NOT EXISTS `pembayarans` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pendaftar_id` bigint(20) UNSIGNED NOT NULL,
  `nominal` decimal(10,0) NOT NULL,
  `tanggal_transfer` date NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `catatan` text DEFAULT NULL,
  `status` enum('PENDING','VERIFIED','REJECTED') NOT NULL DEFAULT 'PENDING',
  `tanggal_upload` datetime NOT NULL,
  `verified_at` datetime DEFAULT NULL,
  `verified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pembayarans_pendaftar_id_foreign` (`pendaftar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
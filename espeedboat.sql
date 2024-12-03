-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.0.30 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- membuang struktur untuk table e-speedboat.bookings
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `jadwal_id` bigint NOT NULL,
  `status` enum('terima','tolak','butuh konfirmasi') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_keberangkatan` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel e-speedboat.bookings: ~4 rows (lebih kurang)
REPLACE INTO `bookings` (`id`, `user_id`, `jadwal_id`, `status`, `tgl_keberangkatan`, `created_at`, `updated_at`) VALUES
	(2, 8, 3, 'terima', '2024-12-02', '2024-12-01 14:28:47', '2024-12-02 10:10:52'),
	(3, 9, 3, 'terima', '2024-12-02', '2024-12-01 14:30:00', '2024-12-01 15:31:49'),
	(4, 10, 3, 'terima', '2024-12-02', '2024-12-01 14:31:42', '2024-12-02 10:18:02'),
	(5, 11, 2, 'tolak', '2024-12-02', '2024-12-01 14:52:47', '2024-12-01 15:32:40'),
	(18, 16, 2, 'terima', '2024-12-03', '2024-12-02 18:12:06', '2024-12-02 18:17:41');

-- membuang struktur untuk table e-speedboat.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel e-speedboat.failed_jobs: ~0 rows (lebih kurang)

-- membuang struktur untuk table e-speedboat.jadwals
CREATE TABLE IF NOT EXISTS `jadwals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `berangkat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_berangkat` time NOT NULL,
  `tiba` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_tiba` time NOT NULL,
  `speedboats_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel e-speedboat.jadwals: ~2 rows (lebih kurang)
REPLACE INTO `jadwals` (`id`, `berangkat`, `jam_berangkat`, `tiba`, `jam_tiba`, `speedboats_id`, `created_at`, `updated_at`) VALUES
	(2, 'Baubau', '12:00:00', 'Wamengkoli', '13:00:00', 17, '2024-12-01 12:12:00', '2024-12-01 12:12:00'),
	(3, 'Baubau', '13:00:00', 'Wamengkoli', '13:30:00', 19, '2024-12-01 12:28:06', '2024-12-01 12:28:06');

-- membuang struktur untuk table e-speedboat.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel e-speedboat.migrations: ~0 rows (lebih kurang)
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2024_11_02_060458_create_speedboats_table', 1),
	(6, '2024_11_02_061343_create_jadwals_table', 1),
	(7, '2024_11_02_062538_create_bookings_table', 1);

-- membuang struktur untuk table e-speedboat.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel e-speedboat.password_reset_tokens: ~0 rows (lebih kurang)

-- membuang struktur untuk table e-speedboat.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel e-speedboat.personal_access_tokens: ~0 rows (lebih kurang)

-- membuang struktur untuk table e-speedboat.speedboats
CREATE TABLE IF NOT EXISTS `speedboats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kapasitas_muatan` int NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel e-speedboat.speedboats: ~2 rows (lebih kurang)
REPLACE INTO `speedboats` (`id`, `nama`, `kapasitas_muatan`, `user_id`, `created_at`, `updated_at`) VALUES
	(17, 'Motor Boat', 3, 3, '2024-12-01 12:05:36', '2024-12-02 10:10:27'),
	(19, 'Motor Cepat', 3, 3, '2024-12-01 12:11:28', '2024-12-02 10:10:42');

-- membuang struktur untuk table e-speedboat.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `umur` bigint NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('admin','pemilik','penumpang') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel e-speedboat.users: ~8 rows (lebih kurang)
REPLACE INTO `users` (`id`, `nama`, `umur`, `alamat`, `email`, `email_verified_at`, `password`, `level`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin User', 30, 'Jl. Admin Raya No.1', 'admin@egmail.com', '2024-11-05 21:55:57', '$2y$12$HpvxhJOKxmZuCtcuto18uum6UFRb0VssGkGDnS1abCf/5ESSIq1ui', 'admin', 'Aktif', 'bCOKM4JSvvGZVZwDZo0f8NzZHDWFYv6b4rCWj9id855uRx5Jcj8UoI1oKW7m', '2024-11-05 21:55:58', '2024-11-05 21:55:58'),
	(3, 'Hayatul Habirun', 36, 'baubau', 'hayatulhabirun@gmail.com', NULL, '$2y$12$kaSTs9j.n0TEBBLdMgOgcOzC04MxvzpgfaKS1Hq0ZQRuDlotVsjFC', 'pemilik', 'Aktif', NULL, '2024-12-01 11:59:37', '2024-12-01 12:16:54'),
	(8, 'test', 21, 'almaat', 'test@gmail.com', NULL, '$2y$12$Oli1tr/KhHg8rgiCULAqVuwFy1hjfhA4pzPyZ9PitGrUofobh/.Pe', 'penumpang', 'Aktif', NULL, '2024-12-01 14:28:47', '2024-12-01 14:28:47'),
	(9, 'asdkfj', 31, 'baubau', 'skdfjk@gmail.com', NULL, '$2y$12$SbTNb6gjLMnOZv25nWQSV.bwTERUFoE1QRVhoouVEwMO8i63MEx3m', 'penumpang', 'Aktif', NULL, '2024-12-01 14:30:00', '2024-12-01 14:30:00'),
	(10, 'asdf', 31, 'baubau', 'asdfsdfsdf@gmail.com', NULL, '$2y$12$b5vaBX5GgxrbLA7XDL6nh.ZbxexM2wPgZg8SxQQ1gN8bj7ZM6d.Ga', 'penumpang', 'Aktif', NULL, '2024-12-01 14:31:42', '2024-12-01 14:31:42'),
	(11, 'sintia', 31, 'baubau', 'sintia@gmail.com', NULL, '$2y$12$JouyI9ZbpE9SQ50xvxSrxufZ9RFhGWp178gy0Tn/Qw2ffuS./0D0G', 'penumpang', 'Aktif', NULL, '2024-12-01 14:52:47', '2024-12-01 14:52:47'),
	(16, 'hayun', 21, 'baubau', 'hayun@gmail.com', NULL, '$2y$12$tcd8ApDdRc/X0zoBjcFxRewtzlFpSgVtUIwsLQyOqaDh7edKVIyS.', 'penumpang', 'Aktif', NULL, '2024-12-01 20:04:57', '2024-12-01 20:04:57'),
	(17, 'hayun', 21, 'baubau', 'hayun21@gmail.com', NULL, '$2y$12$isJnNltTLsDUzy.b6UNX.OfVH5Da8SIgL7CBOehmJ4.KEugenXiiK', 'pemilik', 'Aktif', NULL, '2024-12-02 10:19:25', '2024-12-02 10:19:25');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

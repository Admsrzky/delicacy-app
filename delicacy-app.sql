-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for delicacy_app
CREATE DATABASE IF NOT EXISTS `delicacy_app` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `delicacy_app`;

-- Dumping structure for table delicacy_app.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table delicacy_app.cache: ~4 rows (approximately)
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('delicacy-app-cache-356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1768222145),
	('delicacy-app-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1768222145;', 1768222145),
	('delicacy-app-cache-livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3', 'i:1;', 1768215983),
	('delicacy-app-cache-livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3:timer', 'i:1768215983;', 1768215983);

-- Dumping structure for table delicacy_app.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table delicacy_app.cache_locks: ~0 rows (approximately)

-- Dumping structure for table delicacy_app.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table delicacy_app.categories: ~3 rows (approximately)
INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'Menu Sehat', 'menu-sehat', '2026-01-06 20:42:15', '2026-01-12 05:14:18'),
	(2, 'Menu Berat', 'menu-berat', '2026-01-06 20:42:22', '2026-01-12 05:14:54'),
	(3, 'Menu Diet', 'menu-diet', '2026-01-06 20:42:29', '2026-01-12 05:13:43');

-- Dumping structure for table delicacy_app.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `recipe_id` bigint unsigned NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int NOT NULL DEFAULT '5',
  `is_visible` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_recipe_id_foreign` (`recipe_id`),
  CONSTRAINT `comments_recipe_id_foreign` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table delicacy_app.comments: ~0 rows (approximately)
INSERT INTO `comments` (`id`, `user_id`, `recipe_id`, `comment`, `rating`, `is_visible`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, 'Website yang bergunaa, penjelasan lengkap detail juga', 4, 1, '2026-01-06 20:53:20', '2026-01-07 00:02:01');

-- Dumping structure for table delicacy_app.failed_jobs
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

-- Dumping data for table delicacy_app.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table delicacy_app.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table delicacy_app.jobs: ~0 rows (approximately)

-- Dumping structure for table delicacy_app.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table delicacy_app.job_batches: ~0 rows (approximately)

-- Dumping structure for table delicacy_app.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table delicacy_app.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_01_01_080507_create_categories_table', 1),
	(5, '2026_01_01_081137_create_tips_table', 1),
	(6, '2026_01_01_082002_create_recipes_table', 1),
	(7, '2026_01_01_145327_create_comments_table', 1),
	(8, '2026_01_01_153647_create_personal_access_tokens_table', 1),
	(9, '2026_01_01_154236_add_two_factor_columns_to_users_table', 1);

-- Dumping structure for table delicacy_app.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table delicacy_app.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table delicacy_app.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table delicacy_app.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table delicacy_app.recipes
CREATE TABLE IF NOT EXISTS `recipes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `difficulty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cooking_time` int NOT NULL DEFAULT '30',
  `ingredients` json NOT NULL,
  `steps` json NOT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `category_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recipes_category_id_foreign` (`category_id`),
  CONSTRAINT `recipes_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table delicacy_app.recipes: ~4 rows (approximately)
INSERT INTO `recipes` (`id`, `title`, `difficulty`, `image`, `cooking_time`, `ingredients`, `steps`, `is_featured`, `category_id`, `created_at`, `updated_at`) VALUES
	(1, 'Ikan Nila', 'Menengah', 'recipes/01KEB90DB0K1DTECMB4BBT1H70.jpg', 1, '[{"item": "2 Potong Ikan Nila"}, {"item": "10 Cabai"}, {"item": "1/2 Garam"}, {"item": "1 sendok makan Gula"}]', '[{"desc": "test1", "title": "Persiapan Rebus Ikan"}, {"desc": "test2", "title": "Persiapan Marinasi"}]', 1, 2, '2026-01-06 20:43:59', '2026-01-12 05:49:25'),
	(2, 'Tumis Kangkung Rendah Kalori', 'Mudah', 'recipes/01KES1N2NVGPPHBKWG09SDN45B.jpg', 10, '[{"item": "1 ikat kangkung"}, {"item": "1 siung bawang putih"}, {"item": "1 siung bawang merah"}, {"item": "2 buah cabe rawit"}, {"item": " 1 buah cabe keriting "}, {"item": " 1 sendok minyak goreng "}, {"item": "1 sendok saos tiram"}, {"item": "Air, Garam dan Micin"}]', '[{"desc": "1. Potong dan cuci bersihkan kangkung\\n2. Iris tipis bawang merah, bawang putih, cabe rawit dan cabe keriting\\n3 Panaskan wajan dan beri 1 sendok minyak, lalu tumis bawang merah putih dan cabe sampai harum (jangan sampai gosong)\\n4 Beri sedikit air, saos tiram, sedikit garam dan micin\\n5  Masukkan kangkung (gunakan api besar sebentar agar kangkung tidak hitam setelah matang), setelah kangkung dimasukkan tumis hingga sedikit layu dan siap dihidangkan", "title": "persiapkan bumbu"}]', 1, 3, '2026-01-12 05:07:22', '2026-01-12 05:16:06'),
	(3, 'Anabolic Tuna Mayo Sandwich|High Protein, Low Calorie, Sugar Free', 'Mudah', 'recipes/01KES2HA3D21B242VYASN7BMJP.webp', 5, '[{"item": "2 lembar roti protein sandwich bread"}, {"item": "1 kaleng tuna Carvinna"}, {"item": " 2 lembar ham atau smoked beef "}, {"item": "3 lembar lettuce"}]', '[{"desc": "1. Pertama saring tuna kaleng dan masak sebentar di teflon sampai kering. Lalu setelah dingin, campur dengan mayones.\\n2. Oleskan di atas roti dan tambahkan ham serta lettuce.\\n3. Tutup dan panaskan di microwave atau teflon. Bisa juga untuk meal prep bekal pergi, tinggal cling wrap dan masukkan kulkas.\\n4. Setelah mau dimakan tinggal di microwave saja.", "title": "siapkan bahan"}]', 1, 3, '2026-01-12 05:22:47', '2026-01-12 05:22:47'),
	(4, 'Dada Ayam Panggang + Salad Segar', 'Menengah', 'recipes/01KES4032CYFDRYDZEF6NX2G1K.webp', 25, '[{"item": "1 potong dada ayam tanpa kulit (150–200 g)"}, {"item": "1 sdt minyak zaitun"}, {"item": "½ sdt lada hitam"}, {"item": " ½ sdt bawang putih bubuk"}, {"item": "  ¼ sdt garam (opsional, bisa diganti himalaya)"}, {"item": "Selada secukupnya   "}, {"item": "5 buah tomat ceri (belah dua)"}, {"item": "  ½ buah mentimun (iris tipis)  "}, {"item": "½ buah wortel (serut)"}]', '[{"desc": "1. Marinasi ayam\\nLumuri dada ayam dengan minyak zaitun, lada, bawang putih bubuk, dan garam. Diamkan 10 menit.\\n\\n2. Panggang ayam\\nPanggang di teflon anti lengket atau oven hingga ayam matang dan bagian luar kecokelatan (± 5–7 menit per sisi).\\n\\n3. Siapkan salad\\nCampurkan selada, tomat, mentimun, dan wortel dalam mangkuk.\\n\\n4. Buat dressing\\nCampur minyak zaitun, air lemon, dan lada. Siram ke salad.\\n\\n5. Sajikan\\nIris ayam panggang, sajikan bersama salad segar. Bisa ditambah nasi merah 3–4 sdm bila perlu.", "title": "persiapkan bahan"}]', 1, 3, '2026-01-12 05:48:20', '2026-01-12 05:49:02');

-- Dumping structure for table delicacy_app.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table delicacy_app.sessions: ~2 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('hCGsKAobmiywKYzupmFlxnFKWhFTtbBSVfUoHpIF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicVJ0WVZpZmM5V3JtVnB6OWN3ODVBT0F1MUsxbHpoYjFoRGNscThNeiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo5OiJkYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1768220742),
	('WnXekiX5WpxeqwzTdOMNiqEMPtiAkt4J5CqoLNSs', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiRzFQVW5sNlVkclZ4eW1JSndTVlJGcUpEYXBzWGxLZ2E3T2JJaEhJbCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vcmVjaXBlcyI7czo1OiJyb3V0ZSI7czozODoiZmlsYW1lbnQuYWRtaW4ucmVzb3VyY2VzLnJlY2lwZXMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkaXAwTmphVHU1TmdCbU9scS9zWkNudTN2cktBRVYxcjV2WlF4Z1c4bGFsYzF0R3RlbHBhTWEiO3M6ODoiZmlsYW1lbnQiO2E6MDp7fX0=', 1768222168);

-- Dumping structure for table delicacy_app.tips
CREATE TABLE IF NOT EXISTS `tips` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tips_category_id_foreign` (`category_id`),
  CONSTRAINT `tips_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table delicacy_app.tips: ~0 rows (approximately)
INSERT INTO `tips` (`id`, `title`, `image`, `content`, `category_id`, `created_at`, `updated_at`) VALUES
	(1, 'Tips Agar Enak Memasak Ikan Nila', 'tips/01KEB9P8MDBSZT8ND4611HW70S.jpg', '<p>tezt1</p><p>tes2</p>', 1, '2026-01-06 20:58:27', '2026-01-06 20:58:27');

-- Dumping structure for table delicacy_app.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table delicacy_app.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
	(1, 'Sarah Amelia', 'sarahamelia04@gmail.com', NULL, '$2y$12$ip0NjaTu5NgBmOlq/sZCnu3vrKAEV1r5vZQxgW8lalc1tGtelpaMa', NULL, NULL, NULL, 'T3v7e2zQFgNmILoln0oApZnmmt2Sr2dX5K9G5D5AbUawc0MdlvzzFCe1aJqx', NULL, NULL, '2026-01-06 20:41:35', '2026-01-06 20:41:35'),
	(2, 'Adimas Rizki Purwanto', 'adimasrizki926@gmail.com', NULL, '$2y$12$qtds9kGDcgD2RMuAqtODK.Cf0RHWWgtHSycP/00PMMqMQkLNk.SQy', NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-06 20:50:30', '2026-01-06 20:50:30');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

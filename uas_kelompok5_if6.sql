/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recipient_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `addresses_user_id_foreign` (`user_id`),
  CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `selected` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`),
  KEY `carts_product_id_foreign` (`product_id`),
  CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `order_product`;
CREATE TABLE `order_product` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_product_order_id_foreign` (`order_id`),
  KEY `order_product_product_id_foreign` (`product_id`),
  CONSTRAINT `order_product_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `address_id` bigint unsigned NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','completed','cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `snap_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `stock` int NOT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `material` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `wishlists`;
CREATE TABLE `wishlists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wishlists_user_id_product_id_unique` (`user_id`,`product_id`),
  KEY `wishlists_product_id_foreign` (`product_id`),
  CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `addresses` (`id`, `user_id`, `label`, `recipient_name`, `phone_number`, `address`, `city`, `postal_code`, `latitude`, `longitude`, `is_primary`, `created_at`, `updated_at`) VALUES
(1, 2, 'sekeloa', 'kota bandung', '082120702240', 'Jl Sekeloa Gang Loa 1\r\nKota Bandung, Coblong', 'Kota Bandung', '40132', NULL, NULL, 1, '2025-02-09 06:27:44', '2025-02-09 06:54:02');
INSERT INTO `addresses` (`id`, `user_id`, `label`, `recipient_name`, `phone_number`, `address`, `city`, `postal_code`, `latitude`, `longitude`, `is_primary`, `created_at`, `updated_at`) VALUES
(3, 8, 'terte', 'greg', '0853150560540', 'jatim', 'efrefgr', '24312', NULL, NULL, 1, '2025-02-09 09:41:29', '2025-02-09 10:11:16');
INSERT INTO `addresses` (`id`, `user_id`, `label`, `recipient_name`, `phone_number`, `address`, `city`, `postal_code`, `latitude`, `longitude`, `is_primary`, `created_at`, `updated_at`) VALUES
(4, 9, 'dejan', 'sdfsd', '123123', 'Karawang, West Java, Java, Indonesia', 'Karawang', '3122', '-6.30219060', '107.30461160', 0, '2025-02-09 15:05:33', '2025-02-09 15:19:43');
INSERT INTO `addresses` (`id`, `user_id`, `label`, `recipient_name`, `phone_number`, `address`, `city`, `postal_code`, `latitude`, `longitude`, `is_primary`, `created_at`, `updated_at`) VALUES
(5, 11, 'fvfd', 'sdfsd', '082120702240', 'Jl Sekeloa Gang Loa 1\r\nKota Bandung, Coblong', 'snakjf', '56534', '-2.30812445', '106.02815210', 1, '2025-02-09 22:43:30', '2025-02-09 22:48:39'),
(6, 12, 'menfkwl', 'nlkergklrkntlnjwebf', '23432432', 'Tahúr sume dang renyah, Jalan Lintas Bangkinang - Pekanbaru, Balam Jaya, Kampar Regency, Riau, Sumatra, Indonesia', 'sumedang', '43543', '0.40314070', '101.25915600', 1, '2025-02-09 23:04:40', '2025-02-09 23:04:40'),
(7, 12, 'kp durian runtuh', 'runtuh', '09084521221', 'Wamena, Jayawijaya, Highland Papua, Western New Guinea, 99511, Indonesia', 'Wamena', '99511', '-4.09437050', '138.94665740', 0, '2025-02-10 00:06:43', '2025-02-10 00:06:43');

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('mrakaf4@gmail.com|100.64.0.4', 'i:1;', 1739142242);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('mrakaf4@gmail.com|100.64.0.4:timer', 'i:1739142242;', 1739142242);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('robbstrk45@gmail.com|100.64.0.4', 'i:2;', 1739142086);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('robbstrk45@gmail.com|100.64.0.4:timer', 'i:1739142086;', 1739142086);



INSERT INTO `carts` (`id`, `created_at`, `updated_at`, `user_id`, `product_id`, `quantity`, `selected`) VALUES
(8, '2025-02-08 10:05:47', '2025-02-08 10:05:47', 2, 26, 1, 0);
INSERT INTO `carts` (`id`, `created_at`, `updated_at`, `user_id`, `product_id`, `quantity`, `selected`) VALUES
(10, '2025-02-08 10:11:15', '2025-02-08 10:38:52', 2, 22, 1, 0);
INSERT INTO `carts` (`id`, `created_at`, `updated_at`, `user_id`, `product_id`, `quantity`, `selected`) VALUES
(11, '2025-02-08 10:12:18', '2025-02-08 10:12:18', 2, 28, 1, 0);
INSERT INTO `carts` (`id`, `created_at`, `updated_at`, `user_id`, `product_id`, `quantity`, `selected`) VALUES
(12, '2025-02-08 10:38:42', '2025-02-08 10:38:42', 2, 19, 1, 0),
(13, '2025-02-08 11:43:48', '2025-02-08 11:43:48', 2, 17, 1, 0),
(14, '2025-02-08 12:24:58', '2025-02-08 12:24:58', 2, 24, 1, 0),
(15, '2025-02-08 14:01:02', '2025-02-08 14:01:02', 2, 20, 1, 0),
(16, '2025-02-09 06:50:28', '2025-02-09 06:50:28', 2, 16, 1, 0),
(18, '2025-02-09 10:57:02', '2025-02-09 14:33:16', 8, 22, 1, 1),
(19, '2025-02-09 11:41:32', '2025-02-09 14:33:15', 8, 19, 1, 0),
(20, '2025-02-09 12:00:37', '2025-02-09 12:15:30', 8, 23, 1, 0),
(22, '2025-02-09 13:41:32', '2025-02-09 13:41:32', 5, 18, 1, 0),
(23, '2025-02-09 13:41:35', '2025-02-09 13:41:35', 5, 15, 1, 0),
(24, '2025-02-09 13:41:40', '2025-02-09 13:41:52', 5, 21, 1, 1),
(25, '2025-02-09 13:41:44', '2025-02-09 13:41:44', 5, 23, 1, 0),
(30, '2025-02-09 20:27:31', '2025-02-09 20:31:01', 9, 16, 2, 0),
(31, '2025-02-09 20:31:22', '2025-02-09 20:31:22', 9, 18, 1, 0),
(32, '2025-02-09 20:34:32', '2025-02-09 20:34:32', 9, 28, 1, 0),
(33, '2025-02-09 20:34:57', '2025-02-09 20:34:57', 9, 22, 1, 0),
(35, '2025-02-09 22:43:51', '2025-02-09 22:43:51', 11, 22, 1, 0),
(36, '2025-02-09 22:49:35', '2025-02-09 22:49:35', 11, 23, 1, 0),
(38, '2025-02-09 22:49:49', '2025-02-09 22:49:49', 11, 20, 1, 0),
(40, '2025-02-09 23:03:26', '2025-02-10 00:36:15', 12, 19, 2, 0),
(44, '2025-02-09 23:49:26', '2025-02-10 00:06:58', 12, 18, 1, 0),
(45, '2025-02-09 23:54:30', '2025-02-09 23:55:31', 12, 16, 1, 0),
(46, '2025-02-09 23:55:13', '2025-02-09 23:55:13', 12, 33, 1, 0),
(49, '2025-02-10 00:00:11', '2025-02-10 00:00:11', 12, 35, 1, 0),
(50, '2025-02-10 00:04:05', '2025-02-10 00:04:05', 12, 20, 1, 0);









INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2024_01_19_create_products_table', 1),
(5, '2024_01_20_create_orders_table', 1),
(6, '2024_01_28_add_clothing_details_to_products', 2),
(7, '2024_01_20_create_wishlists_table', 3),
(8, '2024_01_01_000001_create_categories_table', 4),
(9, '2024_02_06_create_products_table', 1),
(10, '2024_02_06_create_products_table', 1),
(11, '2025_01_15_153127_create_personal_access_tokens_table', 5),
(13, '2025_02_01_123534_add_is_admin_to_users_table', 5),
(14, '2025_02_02_064826_add_role_to_users_table', 5),
(15, '2025_02_06_052350_add_slug_to_products_table', 5),
(16, '2025_02_07_135226_add_category_to_products_table', 5),
(17, '2025_02_08_070133_create_carts_table', 5),
(18, '2025_02_08_073030_add_user_id_to_carts_table', 6),
(19, '[timestamp]_add_user_id_to_carts_table', 6),
(22, '[timestamp]_add_phone_to_users_table', 8),
(24, '2025_02_08_115534_add_phone_to_users_table', 9),
(27, '2025_02_09_055401_create_addresses_table', 10),
(30, '2025_02_01_094856_add_is_featured_to_products_table', 11),
(31, '2025_02_09_112944_add_selected_column_to_carts_table', 11),
(32, '2025_02_09_114711_add_is_featured_to_products_table', 12),
(33, '2025_02_09_114736_add_selected_to_carts_table', 12),
(34, '2025_02_09_115905_add_selected_to_carts_table', 13),
(35, '[timestamp]_add_selected_to_carts_table', 13),
(36, '2025_02_09_130628_add_coordinates_to_addresses_table', 14),
(37, '2025_02_09_135352_add_address_details_to_addresses_table', 14),
(38, '2025_02_09_140931_add_snap_token_to_orders_table', 14),
(39, '2025_02_09_141309_create_order_items_table', 14),
(40, '2025_02_09_141731_fix_orders_table_structure', 15),
(41, '2025_02_09_143058_add_payment_details_to_orders_table', 16),
(42, '2024_02_09_150600_add_coordinates_to_addresses_table', 17),
(43, '2025_02_10_000000_drop_order_items_table', 18),
(44, '2025_02_11_000000_create_order_items_table', 19);

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(2, 4, 15, 1, '299000.00', '2025-02-09 16:40:19', '2025-02-09 16:40:19');
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(3, 5, 16, 1, '49000.00', '2025-02-09 16:47:31', '2025-02-09 16:47:31');
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(4, 6, 16, 1, '49000.00', '2025-02-09 16:56:15', '2025-02-09 16:56:15');
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(5, 7, 15, 1, '299000.00', '2025-02-09 22:46:20', '2025-02-09 22:46:20'),
(6, 8, 26, 1, '279000.00', '2025-02-09 22:53:08', '2025-02-09 22:53:08'),
(7, 9, 20, 1, '359000.00', '2025-02-09 23:05:36', '2025-02-09 23:05:36'),
(8, 10, 15, 1, '299000.00', '2025-02-09 23:50:17', '2025-02-09 23:50:17'),
(9, 11, 34, 1, '80000.00', '2025-02-09 23:56:09', '2025-02-09 23:56:09'),
(10, 12, 34, 1, '80000.00', '2025-02-10 00:00:53', '2025-02-10 00:00:53');



INSERT INTO `orders` (`id`, `order_number`, `user_id`, `address_id`, `total_amount`, `status`, `payment_status`, `payment_method`, `snap_token`, `created_at`, `updated_at`) VALUES
(1, '', 8, 0, '329000.00', 'completed', 'pending', NULL, NULL, '2025-02-09 14:07:04', '2025-02-09 23:40:03');
INSERT INTO `orders` (`id`, `order_number`, `user_id`, `address_id`, `total_amount`, `status`, `payment_status`, `payment_method`, `snap_token`, `created_at`, `updated_at`) VALUES
(2, '', 8, 0, '329000.00', 'completed', 'pending', NULL, NULL, '2025-02-09 14:12:18', '2025-02-09 23:39:27');
INSERT INTO `orders` (`id`, `order_number`, `user_id`, `address_id`, `total_amount`, `status`, `payment_status`, `payment_method`, `snap_token`, `created_at`, `updated_at`) VALUES
(4, 'ORD-1739119219-9', 9, 4, '299000.00', 'completed', 'pending', NULL, 'b30c6deb-c464-4dd8-937f-8e8b5c7e151b', '2025-02-09 16:40:19', '2025-02-09 23:40:07');
INSERT INTO `orders` (`id`, `order_number`, `user_id`, `address_id`, `total_amount`, `status`, `payment_status`, `payment_method`, `snap_token`, `created_at`, `updated_at`) VALUES
(5, 'ORD-1739119651-9', 9, 4, '49000.00', 'cancelled', 'pending', NULL, 'd3ba19ad-4c6d-42f7-b1e0-752bbf7a3304', '2025-02-09 16:47:31', '2025-02-09 17:40:03'),
(6, 'ORD-1739120175-9', 9, 4, '49000.00', 'completed', 'pending', NULL, 'b129f2d6-fde7-40f0-bd7c-479a58d305d7', '2025-02-09 16:56:15', '2025-02-09 17:34:33'),
(7, 'ORD-1739141180-11', 11, 5, '299000.00', 'pending', 'pending', NULL, 'e3c5560d-0136-464d-a702-4163f98c84e7', '2025-02-09 22:46:20', '2025-02-09 22:46:21'),
(8, 'ORD-1739141588-11', 11, 5, '279000.00', 'pending', 'pending', NULL, 'c240daa9-bb4d-42e0-a873-e21a999006cc', '2025-02-09 22:53:08', '2025-02-09 22:53:09'),
(9, 'ORD-1739142336-12', 12, 6, '359000.00', 'completed', 'pending', NULL, 'e7232b7c-8ed6-45a9-a4c6-9cf2537f420b', '2025-02-09 23:05:36', '2025-02-09 23:39:57'),
(10, 'ORD-1739145017-12', 12, 6, '299000.00', 'cancelled', 'pending', NULL, '49586979-c59c-4d2d-8421-b198651e6c3c', '2025-02-09 23:50:17', '2025-02-10 00:01:52'),
(11, 'ORD-1739145369-12', 12, 6, '80000.00', 'completed', 'pending', NULL, '7f2086ad-f4cc-4040-ac1f-1ce64a83aba9', '2025-02-09 23:56:09', '2025-02-10 00:01:47'),
(12, 'ORD-1739145653-12', 12, 6, '80000.00', 'completed', 'pending', NULL, '7bedf7d7-ded7-4914-87ab-91f56aedc15f', '2025-02-10 00:00:53', '2025-02-10 00:01:44');





INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `category`, `size`, `color`, `material`, `brand`, `image`, `is_active`, `is_featured`, `created_at`, `updated_at`) VALUES
(15, 'Code Jacket', 'Stylish code pattern jacket perfect for developers', '299000.00', 50, 'Activewear', NULL, NULL, NULL, NULL, 'products/PiH8SF0mkF4R7qWyV6d1t3EG8kvCnmWiCOp0Oe4a.jpg', 1, 0, '2025-02-07 13:51:12', '2025-02-09 22:36:17');
INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `category`, `size`, `color`, `material`, `brand`, `image`, `is_active`, `is_featured`, `created_at`, `updated_at`) VALUES
(16, 'Fashion Bracelet', 'Elegant bracelet to complement your style', '49000.00', 100, 'Accessories', NULL, NULL, NULL, NULL, 'products/kjYHFxw22zybuOZjSJ59vrqdyFuJootP42qCPbMn.jpg', 1, 0, '2025-02-07 13:51:12', '2025-02-09 22:36:40');
INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `category`, `size`, `color`, `material`, `brand`, `image`, `is_active`, `is_featured`, `created_at`, `updated_at`) VALUES
(17, 'Graphic T-Shirt', 'Cool graphic design t-shirt', '149000.00', 75, 'T-Shirts', NULL, NULL, NULL, NULL, 'products/8Q0po2K4s7xzmhasKTR2IxEJC6iK9VfO2ZpR0zq5.jpg', 1, 0, '2025-02-07 13:51:12', '2025-02-09 22:37:09');
INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `category`, `size`, `color`, `material`, `brand`, `image`, `is_active`, `is_featured`, `created_at`, `updated_at`) VALUES
(18, 'Boxy Hoodie', 'Comfortable oversized boxy hoodie', '279000.00', 60, 'Hoodies', NULL, NULL, NULL, NULL, 'products/qW1bUmLfAmEE18EVnzqUrtiFc2dNsF9OtXMmkqfF.jpg', 1, 0, '2025-02-07 13:51:12', '2025-02-09 22:37:26'),
(19, 'Classic Jacket', 'Classic style everyday jacket', '329000.00', 40, 'Jackets & Coats', NULL, NULL, NULL, NULL, 'products/KlnQ9J4gr8wbOGWgM7lYItlz4YlNT8KTMnqhhIz3.jpg', 1, 0, '2025-02-07 13:51:12', '2025-02-09 22:37:43'),
(20, 'Modern Jacket', 'Modern cut stylish jacket', '359000.00', 35, 'Activewear', NULL, NULL, NULL, NULL, 'products/1msu62BMNy0HF0PrfNExjHFQiGyyFUTBr7KyKy5E.jpg', 1, 0, '2025-02-07 13:51:12', '2025-02-09 22:37:58'),
(21, 'Black Jeans', 'Classic black jeans for any occasion', '259000.00', 80, 'Jeans', NULL, NULL, NULL, NULL, 'products/8KRx84Wsjnr4NojNCKRZ2c3O6OzrPKsklwNUCvVK.jpg', 1, 0, '2025-02-07 13:51:13', '2025-02-09 22:38:13'),
(22, 'Boxy Shirt', 'Trendy boxy fit shirt', '189000.00', 65, 'T-Shirts', NULL, NULL, NULL, NULL, 'products/jjoJH5tTVKjnTGcWareColApk4B3JUY2ESP1MIZs.jpg', 1, 0, '2025-02-07 13:51:13', '2025-02-09 22:38:27'),
(23, 'Linen Shirt', 'Comfortable linen material shirt', '219000.00', 55, 'Dresses', NULL, NULL, NULL, NULL, 'products/FfbG23kCEuQbDaTVFv1YZgdbBz10nb8QuL9BpfuY.jpg', 1, 0, '2025-02-07 13:51:13', '2025-02-09 22:38:43'),
(24, 'Leather Jacket', 'Premium leather jacket', '599000.00', 25, 'Formal Wear', NULL, NULL, NULL, NULL, 'products/4mK0wEId08JZ7I03psr3D7SmOhbBSYQQXNajgjHN.jpg', 1, 0, '2025-02-07 13:51:13', '2025-02-09 22:38:58'),
(26, 'Loose Fit Jeans', 'Comfortable loose fit jeans', '279000.00', 70, 'Jeans', NULL, NULL, NULL, NULL, 'products/SXsPnEpCJNG45CY8VyKhuidCcoH4T4IAcis0ehIx.jpg', 1, 0, '2025-02-07 13:51:13', '2025-02-09 22:39:16'),
(28, 'New Balance Shoes', 'Comfortable New Balance sneakers', '899000.00', 30, 'Formal Wear', NULL, NULL, NULL, NULL, 'products/7zrNilX13uvLbvisNjUIxOVDJQ9nTrlNDV3TJD0Q.jpg', 1, 0, '2025-02-07 13:51:13', '2025-02-09 22:39:34'),
(33, 'Baju SD Tempur', 'Memberikan Aura Kepala Sekolah', '10000000.00', 3, 'Activewear', NULL, NULL, NULL, NULL, 'products/MbIlgeUYT2PHcC4c6VJD1fkWWYPk1WLvForRVBox.jpg', 1, 0, '2025-02-09 23:25:16', '2025-02-10 00:16:31'),
(34, 'Crop Top Wanita', 'memberi aura bapak bapak garpit', '80000.00', 40, 'T-Shirts', NULL, NULL, NULL, NULL, 'products/aAJcu8caT6MIIqx55QIzOwnlEURsyfV3FBbrVhJu.jpg', 1, 0, '2025-02-09 23:34:20', '2025-02-09 23:38:09'),
(35, 'Crop Top Wanita Hitam', 'memberikan AURA dan menarik para pria yang sedang jajan torpedo', '100000.00', 5, 'Shorts', NULL, NULL, NULL, NULL, 'products/W6ZWBZylLxQoKn4KJlLOIrvEXbDeJTUAHcMgkGUP.jpg', 1, 0, '2025-02-09 23:35:21', '2025-02-10 00:16:00');

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8Vg0k4x1NE41EqN4F9IiF0rzbjDKTSZECzoXn3xX', NULL, '100.64.0.4', 'WhatsApp/2.23.20.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSmFuM3FIdEZKNkc2RXdWNGU0MVYxWkJBTUxNUVY1M2xob0Z0OUVQbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9yb2Jic3RhcmtzLnVwLnJhaWx3YXkuYXBwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1739145882);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Cl2rQyrojHc0VwQ7IPR2C9Iw2j1O1lFNwglFXeDk', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 Edg/132.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS3h6b291c3VuTlNCRkNNcVF6cjlKRmtjUUlMQ3Q4QjZTTW84cmZYeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1739141801);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('o7n09BxPMad2NZHwRgZZ4QEIQjxs09IedSIz1WnK', NULL, '100.64.0.3', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiblVVTGFmeWw4QlIzMmJXUFZYNm85ZmM4cDJnVkJYd0gyRHhuM0tRRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9yb2Jic3RhcmtzLnVwLnJhaWx3YXkuYXBwL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1739143078);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('R1rIzpTPjXR190SFWCvh1tZm4fqjI0t0BRgSg1R6', NULL, '100.64.0.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWVptSVg1M2VWNXdCZDNNZjh0UDE4dWZlMUFobktlaXg2Qlo4V05MWSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9yb2Jic3RhcmtzLnVwLnJhaWx3YXkuYXBwIjt9fQ==', 1739147782),
('z5rgCX0ED7dmnnbvKXWf6HrttcfiwAPi5BUut9ja', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia0tRVzk1R1VUc3VKend4ZnJwUnJuUnlVNzVQVTdFcHVkQWtYWjRleCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1739142087);

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', NULL, NULL, '$2y$12$XnyaMJsMa8w21hiMZKtDzuMKWaVow7wi2qpO.c/XOV88fXy9p7o/6', 'admin', NULL, '2025-01-28 06:00:38', '2025-01-28 06:00:38');
INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'mrakaf', 'mrakaf4@gmail.com', '082120702240', NULL, '$2y$12$z6tC5KdaJH8HHkRKpq.WYOjTV7mnmITV/LyVyxZCas6CN.6QEHnni', 'customer', NULL, '2025-01-28 07:21:15', '2025-02-09 07:12:50');
INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'raffi', 'raffiva@gmail.com', NULL, NULL, '$2y$12$YTCuCpbRirJ2KEtFkKN9Vex3lLVh028O.hf/DhEp0Rlk2ixvGQVNS', 'customer', NULL, '2025-01-31 08:23:34', '2025-01-31 08:23:34');
INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'albert', 'albert@gmail.com', NULL, NULL, '$2y$12$kVekMh0sB3fcniB9tZAb.OJABtz0lqg.yUxlOX7wtGtqqPxfY51M2', 'customer', NULL, '2025-02-01 04:38:23', '2025-02-01 04:38:23'),
(6, 'wanda', 'wanda@gmail.com', NULL, NULL, '$2y$12$Z45wib60HX8E7Ob2LujbQexEbrg93mRH3lpsAx7lnrxaERHZe8D5e', 'customer', NULL, '2025-02-07 06:05:53', '2025-02-07 06:05:53'),
(8, 'Raka Dua', 'raka0728@gmail.com', NULL, NULL, '$2y$12$kM8Ylumq.aw9gsHmypF03eRcBdHW72b6qasodSfS.XNnO74UqAuVy', 'customer', NULL, '2025-02-09 09:09:50', '2025-02-09 09:09:50'),
(9, 'dejan', 'dejanmna@gmail.com', NULL, NULL, '$2y$12$rFNtFm8hp.qORR1NhvhjYeGzK/slcwfX8pV/.pQ5ezlyQMvkE/eZK', 'customer', NULL, '2025-02-09 14:57:10', '2025-02-09 14:57:10'),
(11, 'Robb', 'robbstrk45@gmail.com', '082120702240', NULL, '$2y$12$hWCbDdilxpw7m466xWTbz.3zOnipRUntgTzApZ5jjQrCUaqQOHnoy', 'customer', NULL, '2025-02-09 22:42:19', '2025-02-09 22:42:49'),
(12, 'thekrnjt', 'theknjt@gmail.com', '081224484664', NULL, '$2y$12$WWiCp9HZyu0.vceFUJ1WBeVCBA68IbkdFvhu5Usl3ZJlgBzRhTgz.', 'customer', NULL, '2025-02-09 23:01:42', '2025-02-10 00:05:51');




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
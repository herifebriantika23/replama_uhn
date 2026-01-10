-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2026 at 01:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_repository`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Fakultas Dharma Acarya', '2026-01-07 16:31:18', '2026-01-07 16:31:18'),
(2, 'Fakultas Dharma Duta', '2026-01-07 16:31:50', '2026-01-07 16:31:50'),
(3, 'Fakultas Brahma Widya', '2026-01-07 16:32:09', '2026-01-07 16:32:09');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporans`
--

CREATE TABLE `laporans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `prodi_id` bigint(20) UNSIGNED NOT NULL,
  `periode_magang_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `file_pdf` varchar(255) NOT NULL,
  `dosen_pembimbing` varchar(255) NOT NULL,
  `status` enum('menunggu','disetujui','revisi') NOT NULL DEFAULT 'menunggu',
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporans`
--

INSERT INTO `laporans` (`id`, `user_id`, `prodi_id`, `periode_magang_id`, `judul`, `file_pdf`, `dosen_pembimbing`, `status`, `catatan`, `created_at`, `updated_at`) VALUES
(5, 2, 11, 1, 'Artikel SNA', 'laporan/inmAEhcvmd8ceMJRJsRF4PSrD70pPsSwSTbQr9xh.pdf', 'Jason', 'menunggu', NULL, '2026-01-08 22:38:34', '2026-01-08 22:38:34');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_20_235926_create_fakultas_table', 1),
(5, '2025_12_21_000112_create_prodis_table', 1),
(6, '2025_12_21_000200_create_periode_magangs_table', 1),
(7, '2025_12_21_000234_create_laporans_table', 1),
(8, '2026_01_02_054700_add_photo_to_users_table', 1),
(9, '2026_01_03_121455_create_notifications_table', 1),
(10, '2026_01_06_100053_add_nim_to_users_table', 1),
(11, '2026_01_07_015208_add_prodi_id_to_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('013945dc-ca27-4145-8df4-2d39e93e4074', 'App\\Notifications\\LaporanNotification', 'App\\Models\\User', 1, '{\"type\":\"laporan\",\"laporan_id\":5,\"judul\":\"Laporan Baru Masuk\",\"status\":\"menunggu\",\"message\":\"Mahasiswa mengunggah laporan magang baru\"}', NULL, '2026-01-08 22:38:34', '2026-01-08 22:38:34'),
('142cc007-4dad-48a3-bf39-15a5968ac0a3', 'App\\Notifications\\LaporanNotification', 'App\\Models\\User', 1, '{\"type\":\"laporan\",\"laporan_id\":3,\"judul\":\"Laporan Baru Masuk\",\"status\":\"menunggu\",\"message\":\"Mahasiswa mengunggah laporan magang baru\"}', NULL, '2026-01-08 22:32:52', '2026-01-08 22:32:52'),
('4e0506fb-c852-4514-a8a7-45ecdeb5d056', 'App\\Notifications\\LaporanNotification', 'App\\Models\\User', 2, '{\"type\":\"laporan\",\"laporan_id\":2,\"judul\":\"Artikel SNA\",\"status\":\"revisi\",\"message\":\"Laporan Anda perlu direvisi\"}', '2026-01-08 06:25:28', '2026-01-08 06:23:43', '2026-01-08 06:25:28'),
('53a562c8-a0e7-49a8-8a79-d7d5caa5c6d0', 'App\\Notifications\\LaporanNotification', 'App\\Models\\User', 2, '{\"type\":\"laporan\",\"laporan_id\":2,\"judul\":\"Artikel SNA\",\"status\":\"revisi\",\"message\":\"Laporan Anda perlu direvisi\"}', '2026-01-08 07:14:25', '2026-01-08 07:03:43', '2026-01-08 07:14:25'),
('6da9e137-8903-4cf9-aefa-a39aeffb98b1', 'App\\Notifications\\LaporanNotification', 'App\\Models\\User', 1, '{\"type\":\"laporan\",\"laporan_id\":4,\"judul\":\"Laporan Baru Masuk\",\"status\":\"menunggu\",\"message\":\"Mahasiswa mengunggah laporan magang baru\"}', NULL, '2026-01-08 22:37:33', '2026-01-08 22:37:33'),
('79e172a6-fa62-4678-b688-b4d25e3613ae', 'App\\Notifications\\LaporanNotification', 'App\\Models\\User', 2, '{\"type\":\"laporan\",\"laporan_id\":2,\"judul\":\"Artikel SNA\",\"status\":\"revisi\",\"message\":\"Laporan Anda perlu direvisi\"}', '2026-01-08 06:25:02', '2026-01-08 06:24:14', '2026-01-08 06:25:02'),
('acff4afd-378b-4f19-8fac-945d2d90df87', 'App\\Notifications\\LaporanNotification', 'App\\Models\\User', 2, '{\"type\":\"laporan\",\"laporan_id\":2,\"judul\":\"Artikel SNA\",\"status\":\"revisi\",\"message\":\"Laporan Anda perlu direvisi\"}', '2026-01-08 18:36:14', '2026-01-08 18:29:06', '2026-01-08 18:36:14'),
('b917a439-90c2-4f14-959f-97f481d67dff', 'App\\Notifications\\LaporanNotification', 'App\\Models\\User', 2, '{\"type\":\"laporan\",\"laporan_id\":2,\"judul\":\"Artikel SNA\",\"status\":\"revisi\",\"message\":\"Laporan Anda perlu direvisi\"}', '2026-01-08 06:48:46', '2026-01-08 06:47:43', '2026-01-08 06:48:46'),
('cc8dd1a0-7423-46db-9ff7-991d50b593d5', 'App\\Notifications\\LaporanNotification', 'App\\Models\\User', 2, '{\"type\":\"laporan\",\"laporan_id\":2,\"judul\":\"Artikel SNA\",\"status\":\"revisi\",\"message\":\"Laporan Anda perlu direvisi\"}', '2026-01-08 08:27:42', '2026-01-08 08:07:41', '2026-01-08 08:27:42'),
('db01a4ef-2f96-4d3f-955f-9817d7887440', 'App\\Notifications\\LaporanNotification', 'App\\Models\\User', 2, '{\"type\":\"laporan\",\"laporan_id\":2,\"judul\":\"Artikel SNA\",\"status\":\"revisi\",\"message\":\"Laporan Anda perlu direvisi\"}', '2026-01-08 05:54:25', '2026-01-08 05:53:44', '2026-01-08 05:54:25');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `periode_magangs`
--

CREATE TABLE `periode_magangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `mulai` date NOT NULL,
  `selesai` date NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `periode_magangs`
--

INSERT INTO `periode_magangs` (`id`, `nama`, `mulai`, `selesai`, `aktif`, `created_at`, `updated_at`) VALUES
(1, 'Magang Semester Ganjil 2026', '2026-01-05', '2026-03-27', 1, '2026-01-07 18:37:03', '2026-01-07 18:37:03');

-- --------------------------------------------------------

--
-- Table structure for table `prodis`
--

CREATE TABLE `prodis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fakultas_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prodis`
--

INSERT INTO `prodis` (`id`, `fakultas_id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pendidikan Agama Hindu', '2026-01-07 16:32:39', '2026-01-07 16:32:39'),
(2, 1, 'Sastra Agama dan Pendidikan Bahasa Bali', '2026-01-07 16:33:01', '2026-01-07 16:33:01'),
(3, 1, 'Pendidikan Guru Sekolah Dasar Hindu', '2026-01-07 16:33:16', '2026-01-07 16:33:16'),
(4, 1, 'Pendidikan Anak Usia Dini Hindu', '2026-01-07 16:33:34', '2026-01-07 16:33:34'),
(5, 1, 'Pendidikan Bahasa Inggris', '2026-01-07 16:33:51', '2026-01-07 16:33:51'),
(6, 2, 'Penerangan Hindu', '2026-01-07 16:34:05', '2026-01-07 16:34:05'),
(7, 2, 'Komunikasi Hindu', '2026-01-07 16:34:25', '2026-01-07 16:34:25'),
(8, 2, 'Industri Perjalanan', '2026-01-07 16:34:43', '2026-01-07 16:34:43'),
(9, 2, 'Hukum Hindu', '2026-01-07 16:35:10', '2026-01-07 16:35:10'),
(10, 2, 'Kewirausahaan', '2026-01-07 16:35:25', '2026-01-07 16:35:25'),
(11, 2, 'Informatika', '2026-01-07 16:35:45', '2026-01-07 16:35:45'),
(12, 2, 'Sains Informasi', '2026-01-07 16:36:34', '2026-01-07 16:36:34'),
(13, 3, 'Filsafat Hindu', '2026-01-07 16:36:49', '2026-01-07 16:36:49'),
(14, 3, 'Teologi Hindu', '2026-01-07 16:37:14', '2026-01-07 16:37:14'),
(15, 3, 'Yoga Kesehatan', '2026-01-07 16:38:17', '2026-01-07 16:38:17');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `nim` varchar(50) DEFAULT NULL,
  `prodi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `photo` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `nim`, `prodi_id`, `email`, `role`, `photo`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Sistem', NULL, NULL, 'admin@kampus.ac.id', 'admin', 'profile/7OoNnzirDW34y9thdN01z2d4AqtyZqJPOvD76xzs.jpg', NULL, '$2y$12$DWLTZfgomiJxQsihdljXy.SM6c4kIKARR9Mr4BBlTgGW3JRYWJIvO', 'GUR7b8Y3RzBqihvVdrAbbv85iUIHKEQAvTV5A24qCT5f1ykn85PEK65HLR3g', '2026-01-07 16:24:25', '2026-01-07 17:01:08'),
(2, 'I Kadek Heri Febriantika', '2313231038', 11, 'mahasiswa123@gmail.com', 'user', 'profile/NDVS976JVuXebBrOFgWkPtpED8YiDoGcziQH81M2.png', NULL, '$2y$12$iCGymv1dO05zTHpJBNPoT.bRZ/LFWGvnGKqn7NBVHJXPL8hqtNAkq', 'l7f5NpPsmprSAfhnsIVagri8NSH28l2Dt9MAe6IUA2k4lh1SbmwT90A5ctOI', '2026-01-07 17:11:37', '2026-01-07 21:57:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporans`
--
ALTER TABLE `laporans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporans_user_id_foreign` (`user_id`),
  ADD KEY `laporans_prodi_id_foreign` (`prodi_id`),
  ADD KEY `laporans_periode_magang_id_foreign` (`periode_magang_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `periode_magangs`
--
ALTER TABLE `periode_magangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prodis`
--
ALTER TABLE `prodis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodis_fakultas_id_foreign` (`fakultas_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_nim_unique` (`nim`),
  ADD KEY `users_prodi_id_foreign` (`prodi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporans`
--
ALTER TABLE `laporans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `periode_magangs`
--
ALTER TABLE `periode_magangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prodis`
--
ALTER TABLE `prodis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `laporans`
--
ALTER TABLE `laporans`
  ADD CONSTRAINT `laporans_periode_magang_id_foreign` FOREIGN KEY (`periode_magang_id`) REFERENCES `periode_magangs` (`id`),
  ADD CONSTRAINT `laporans_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`),
  ADD CONSTRAINT `laporans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prodis`
--
ALTER TABLE `prodis`
  ADD CONSTRAINT `prodis_fakultas_id_foreign` FOREIGN KEY (`fakultas_id`) REFERENCES `fakultas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

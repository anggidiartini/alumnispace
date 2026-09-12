-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 09, 2026 at 08:32 AM
-- Server version: 8.4.3
-- PHP Version: 8.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_alumni`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumnis`
--

CREATE TABLE `alumnis` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `angkatan_id` bigint UNSIGNED DEFAULT NULL,
  `kelas_id` bigint UNSIGNED DEFAULT NULL,
  `nisn` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_lengkap` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'L',
  `sosial_media` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan_saat_ini` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_profil` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'https://i.pravatar.cc/150',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alumnis`
--

INSERT INTO `alumnis` (`id`, `user_id`, `angkatan_id`, `kelas_id`, `nisn`, `nama_lengkap`, `jenis_kelamin`, `sosial_media`, `pekerjaan_saat_ini`, `foto_profil`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 1, '1234567890', 'Budi Santoso', 'L', '', 'Software Engineer di Gojek', 'https://i.pravatar.cc/150?img=1', '2026-08-26 00:05:29', '2026-08-26 00:05:29'),
(2, NULL, 1, 2, '1234567891', 'Siti Rahayu', 'P', '', 'UI/UX Designer di Tokopedia', 'https://i.pravatar.cc/150?img=5', '2026-08-26 00:05:29', '2026-08-26 00:05:29'),
(3, NULL, 2, 4, '1234567892', 'Ahmad Fajar', 'L', '', 'Data Analyst di Shopee', 'https://i.pravatar.cc/150?img=12', '2026-08-26 00:05:29', '2026-08-26 00:05:29'),
(4, NULL, 2, 5, '1234567893', 'Dewi Lestari', 'P', '', 'Backend Developer di Bukalapak', 'https://i.pravatar.cc/150?img=9', '2026-08-26 00:05:29', '2026-08-26 00:05:29'),
(5, NULL, 3, 7, '1234567894', 'Rizky Pratama', 'L', '', 'Network Engineer di Telkom', 'https://i.pravatar.cc/150?img=15', '2026-08-26 00:05:29', '2026-08-26 00:05:29'),
(6, NULL, 3, 8, '1234567895', 'Putri Handayani', 'P', '', 'Full Stack Developer Freelance', 'https://i.pravatar.cc/150?img=20', '2026-08-26 00:05:29', '2026-08-26 00:05:29'),
(7, NULL, 4, 10, '1234567896', 'Hendra Wijaya', 'L', '', 'Game Developer Indie', 'https://i.pravatar.cc/150?img=3', '2026-08-26 00:05:29', '2026-08-26 00:05:29'),
(8, NULL, 4, 11, '1234567897', 'Maya Kusuma', 'P', '', 'Product Manager di startup', 'https://i.pravatar.cc/150?img=25', '2026-08-26 00:05:29', '2026-08-26 00:05:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumnis`
--
ALTER TABLE `alumnis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumni_user_id_foreign` (`user_id`),
  ADD KEY `alumni_angkatan_id_foreign` (`angkatan_id`),
  ADD KEY `alumni_kelas_id_foreign` (`kelas_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumnis`
--
ALTER TABLE `alumnis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumnis`
--
ALTER TABLE `alumnis`
  ADD CONSTRAINT `alumni_angkatan_id_foreign` FOREIGN KEY (`angkatan_id`) REFERENCES `graduations` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `alumni_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `schoolclasses` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `alumni_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 09, 2026 at 08:35 AM
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
-- Database: `alumnispace`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumni_profiles`
--

CREATE TABLE `alumni_profiles` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `graduation_year` smallint UNSIGNED NOT NULL,
  `major` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `linkedin_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `github_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `portfolio_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_online` tinyint(1) NOT NULL DEFAULT '0',
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tiktok_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `achievements` text COLLATE utf8mb4_unicode_ci,
  `organization_role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_university` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `study_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alumni_profiles`
--

INSERT INTO `alumni_profiles` (`id`, `user_id`, `slug`, `student_number`, `graduation_year`, `major`, `profession`, `company`, `city`, `phone_number`, `avatar`, `bio`, `linkedin_url`, `instagram_url`, `github_url`, `twitter_url`, `youtube_url`, `portfolio_url`, `is_online`, `is_verified`, `created_at`, `updated_at`, `tiktok_url`, `achievements`, `organization_role`, `current_university`, `study_status`) VALUES
(1, 1, 'administrator-alumni-1', 'ADM-001', 2010, 'Rekayasa Perangkat Lunak', 'Admin & IT Support', 'Sekolah Ceria', 'Jakarta Selatan', '081234567890', 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=300', 'Pengurus pusat data dan komunitas alumni.', NULL, 'https://instagram.com/administratoralumni', NULL, NULL, NULL, NULL, 1, 1, '2026-09-01 19:06:38', '2026-09-08 03:12:48', 'https://tiktok.com/@administratoralumni', 'Juara 1 Lomba Web Design Nasional 2023\nFinalis Hackathon tingkat Provinsi', 'Ketua Divisi IT KSHDI 2022-2023\nAnggota BEM Fakultas', 'Universitas Indonesia', 'Belum Lulus (Semester 6)'),
(2, 2, 'kanya-salsabila-2', 'ALM-2019-002', 2019, 'Multimedia', 'UI/UX Lead Designer', 'Kreasi Digital Nusantara', 'Jakarta Selatan', '081404366266', 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=300', 'Passionate in creating lovable digital products.', 'https://linkedin.com', 'https://instagram.com', NULL, NULL, NULL, NULL, 1, 1, '2026-09-01 19:06:39', '2026-09-07 23:21:55', 'https://tiktok.com/@kanyasalsabila', 'Juara 1 Lomba Web Design Nasional 2023\nFinalis Hackathon tingkat Provinsi', 'Ketua Divisi IT KSHDI 2022-2023\nAnggota BEM Fakultas', 'Universitas Indonesia', 'Belum Lulus (Semester 6)'),
(3, 3, 'rangga-pratama-3', 'ALM-2015-003', 2015, 'Rekayasa Perangkat Lunak', 'Software Engineer', 'Sinergi Teknologi', 'Bandung', '085212161266', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300', 'Fullstack web developer and startup enthusiast.', 'https://linkedin.com', 'https://instagram.com/ranggapratama', 'https://github.com', NULL, NULL, NULL, 1, 1, '2026-09-01 19:06:39', '2026-09-08 03:12:48', 'https://tiktok.com/@ranggapratama', 'Juara 1 Lomba Web Design Nasional 2023\nFinalis Hackathon tingkat Provinsi', 'Ketua Divisi IT KSHDI 2022-2023\nAnggota BEM Fakultas', 'Universitas Indonesia', 'Belum Lulus (Semester 6)'),
(4, 4, 'nabila-zahra-4', 'ALM-2018-004', 2018, 'Teknik Komputer & Jaringan', 'Product Manager', 'Unicorn Edukasi', 'Jakarta Barat', '082911858874', 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=300', 'Building impactful edtech platforms.', 'https://linkedin.com', 'https://instagram.com/nabilazahra', NULL, 'https://twitter.com', NULL, NULL, 0, 1, '2026-09-01 19:06:39', '2026-09-08 03:12:48', 'https://tiktok.com/@nabilazahra', 'Juara 1 Lomba Web Design Nasional 2023\nFinalis Hackathon tingkat Provinsi', 'Ketua Divisi IT KSHDI 2022-2023\nAnggota BEM Fakultas', 'Universitas Indonesia', 'Belum Lulus (Semester 6)'),
(5, 5, 'dimas-anggara-5', 'ALM-2020-005', 2020, 'Desain Komunikasi Visual', 'Content Creator & Founder', 'Matchora Media', 'Surabaya', '086477137753', 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=300', 'Visual storyteller and creative strategist.', NULL, 'https://instagram.com', NULL, NULL, 'https://youtube.com', NULL, 1, 1, '2026-09-01 19:06:40', '2026-09-07 23:21:55', 'https://tiktok.com/@dimasanggara', 'Juara 1 Lomba Web Design Nasional 2023\nFinalis Hackathon tingkat Provinsi', 'Ketua Divisi IT KSHDI 2022-2023\nAnggota BEM Fakultas', 'Universitas Indonesia', 'Belum Lulus (Semester 6)'),
(6, 6, 'kak-bayu-6', 'ALM-2016-006', 2016, 'Pemasaran', 'Growth Lead', 'Nusantara Media', 'Jakarta', '082485962605', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300', 'Alumni berdedikasi dan siap saling mendukung.', NULL, 'https://instagram.com/kakbayu', NULL, NULL, NULL, NULL, 1, 1, '2026-09-01 19:06:40', '2026-09-08 03:12:48', 'https://tiktok.com/@kakbayu', 'Juara 1 Lomba Web Design Nasional 2023\nFinalis Hackathon tingkat Provinsi', 'Ketua Divisi IT KSHDI 2022-2023\nAnggota BEM Fakultas', 'Universitas Indonesia', 'Belum Lulus (Semester 6)'),
(7, 7, 'kak-dewi-7', 'ALM-2020-007', 2020, 'Desain Komunikasi Visual', 'Art Director', 'Matchora Studio', 'Bandung', '086607853013', 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=300', 'Alumni berdedikasi dan siap saling mendukung.', NULL, 'https://instagram.com/kakdewi', NULL, NULL, NULL, NULL, 0, 1, '2026-09-01 19:06:40', '2026-09-08 03:12:48', 'https://tiktok.com/@kakdewi', 'Juara 1 Lomba Web Design Nasional 2023\nFinalis Hackathon tingkat Provinsi', 'Ketua Divisi IT KSHDI 2022-2023\nAnggota BEM Fakultas', 'Universitas Indonesia', 'Belum Lulus (Semester 6)'),
(8, 8, 'kak-fajar-8', 'ALM-2015-008', 2015, 'Rekayasa Perangkat Lunak', 'Principal Engineer', 'Sinergi Teknologi', 'Yogyakarta', '089549872736', 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=300', 'Alumni berdedikasi dan siap saling mendukung.', NULL, 'https://instagram.com/kakfajar', NULL, NULL, NULL, NULL, 1, 1, '2026-09-01 19:06:41', '2026-09-08 03:12:48', 'https://tiktok.com/@kakfajar', 'Juara 1 Lomba Web Design Nasional 2023\nFinalis Hackathon tingkat Provinsi', 'Ketua Divisi IT KSHDI 2022-2023\nAnggota BEM Fakultas', 'Universitas Indonesia', 'Belum Lulus (Semester 6)'),
(9, 9, 'kak-reza-9', 'ALM-2017-009', 2017, 'Logistik', 'Supply Chain Manager', 'Logistik Kawan', 'Surabaya', '083842102477', 'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?w=300', 'Alumni berdedikasi dan siap saling mendukung.', NULL, 'https://instagram.com/kakreza', NULL, NULL, NULL, NULL, 1, 1, '2026-09-01 19:06:41', '2026-09-08 03:12:48', 'https://tiktok.com/@kakreza', 'Juara 1 Lomba Web Design Nasional 2023\nFinalis Hackathon tingkat Provinsi', 'Ketua Divisi IT KSHDI 2022-2023\nAnggota BEM Fakultas', 'Universitas Indonesia', 'Belum Lulus (Semester 6)');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumni_profiles`
--
ALTER TABLE `alumni_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alumni_profiles_slug_unique` (`slug`),
  ADD KEY `alumni_profiles_user_id_foreign` (`user_id`),
  ADD KEY `alumni_profiles_graduation_year_index` (`graduation_year`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumni_profiles`
--
ALTER TABLE `alumni_profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumni_profiles`
--
ALTER TABLE `alumni_profiles`
  ADD CONSTRAINT `alumni_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

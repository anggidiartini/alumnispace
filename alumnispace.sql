-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for alumnispace
CREATE DATABASE IF NOT EXISTS `alumnispace` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `alumnispace`;

-- Dumping structure for table alumnispace.albums
CREATE TABLE IF NOT EXISTS `albums` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'outdoor',
  `subtitle_label` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sticker_tag` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `date_display` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target_generation` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_featured` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `albums_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alumnispace.albums: ~4 rows (approximately)
DELETE FROM `albums`;
INSERT INTO `albums` (`id`, `title`, `slug`, `category`, `subtitle_label`, `sticker_tag`, `cover_photo`, `event_date`, `date_display`, `location`, `target_generation`, `description`, `is_featured`, `created_at`, `updated_at`) VALUES
	(1, 'Class Trip', 'class-trip-bandung', 'outdoor', 'liburan sekelas', 'seru banget!', 'assets/images/foto-4OUTDOOR.jpg', '2026-03-14', '14 Maret 2026 · Bandung', 'Bandung', 'Angkatan 2018', 'Keseruan liburan bersama teman sekelas menjelajahi udara sejuk dan pemandangan asri Bandung.', 1, '2026-09-01 19:06:41', '2026-09-01 19:06:41'),
	(2, 'School Event', 'school-event-aula', 'indoor', 'panggung & sorak-sorai', 'asik banget', 'assets/images/foto-6INDOOR.jpg', '2026-05-02', '2 Mei 2026 · Aula Sekolah', 'Aula Sekolah', 'Semua Angkatan', 'Pentas seni, penampilan band, dan unjuk bakat kreatif seluruh siswa dan alumni.', 1, '2026-09-01 19:06:41', '2026-09-01 19:06:41'),
	(3, 'Class Gathering', 'class-gathering-rumah-kayu', 'outdoor', 'kumpul santai', 'seru bareng', 'assets/images/foto-5OUTDOOR.jpg', '2026-06-19', '19 Juni 2026 · Cafe Rumah Kayu', 'Cafe Rumah Kayu', 'Angkatan 2019', 'Temu kangen santai sambil ngopi dan bercerita tentang petualangan baru masing-masing.', 1, '2026-09-01 19:06:41', '2026-09-01 19:06:41'),
	(4, 'Graduation', 'graduation-ceremony', 'indoor', 'akhir dari sebuah babak', 'so proud', 'assets/images/foto-7INDOOR.jpg', '2026-07-28', '28 Juli 2026 · Gedung Serbaguna', 'Gedung Serbaguna', 'Angkatan 2017', 'Momen sakral pelepasan toga dan awal perjalanan baru menuju dunia profesional.', 1, '2026-09-01 19:06:42', '2026-09-01 19:06:42');

-- Dumping structure for table alumnispace.album_photos
CREATE TABLE IF NOT EXISTS `album_photos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `album_id` bigint unsigned NOT NULL,
  `uploaded_by` bigint unsigned DEFAULT NULL,
  `photo_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `album_photos_album_id_foreign` (`album_id`),
  KEY `album_photos_uploaded_by_foreign` (`uploaded_by`),
  CONSTRAINT `album_photos_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE CASCADE,
  CONSTRAINT `album_photos_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alumnispace.album_photos: ~9 rows (approximately)
DELETE FROM `album_photos`;
INSERT INTO `album_photos` (`id`, `album_id`, `uploaded_by`, `photo_path`, `caption`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, 'assets/images/foto-1.png', 'Momen kebersamaan di villa', '2026-09-01 19:06:41', '2026-09-01 19:06:41'),
	(2, 1, NULL, 'assets/images/foto-2.png', 'Jalan-jalan santai sore', '2026-09-01 19:06:41', '2026-09-01 19:06:41'),
	(3, 1, NULL, 'assets/images/foto-3.png', 'Foto rame-rame sebelum pulang', '2026-09-01 19:06:41', '2026-09-01 19:06:41'),
	(4, 2, NULL, 'assets/images/foto-1.png', 'Penampilan band utama', '2026-09-01 19:06:41', '2026-09-01 19:06:41'),
	(5, 2, NULL, 'assets/images/foto-2.png', 'Sorak gembira penonton', '2026-09-01 19:06:41', '2026-09-01 19:06:41'),
	(6, 3, NULL, 'assets/images/foto-2.png', 'Ngobrol santai sore', '2026-09-01 19:06:41', '2026-09-01 19:06:41'),
	(7, 3, NULL, 'assets/images/foto-3.png', 'Sesi foto polaroid', '2026-09-01 19:06:41', '2026-09-01 19:06:41'),
	(8, 4, NULL, 'assets/images/foto-1.png', 'Lempar toga bersama', '2026-09-01 19:06:42', '2026-09-01 19:06:42'),
	(9, 4, NULL, 'assets/images/foto-3.png', 'Foto keluarga dan sahabat', '2026-09-01 19:06:42', '2026-09-01 19:06:42');

-- Dumping structure for table alumnispace.alumni_profiles
CREATE TABLE IF NOT EXISTS `alumni_profiles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `student_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `graduation_year` smallint unsigned NOT NULL,
  `major` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `linkedin_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `github_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `portfolio_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_online` tinyint(1) NOT NULL DEFAULT '0',
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `alumni_profiles_user_id_foreign` (`user_id`),
  KEY `alumni_profiles_graduation_year_index` (`graduation_year`),
  CONSTRAINT `alumni_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alumnispace.alumni_profiles: ~9 rows (approximately)
DELETE FROM `alumni_profiles`;
INSERT INTO `alumni_profiles` (`id`, `user_id`, `student_number`, `graduation_year`, `major`, `profession`, `company`, `city`, `phone_number`, `avatar`, `bio`, `linkedin_url`, `instagram_url`, `github_url`, `twitter_url`, `youtube_url`, `portfolio_url`, `is_online`, `is_verified`, `created_at`, `updated_at`) VALUES
	(1, 1, 'ADM-001', 2010, 'Rekayasa Perangkat Lunak', 'Admin & IT Support', 'Sekolah Ceria', 'Jakarta Selatan', '081234567890', 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=300', 'Pengurus pusat data dan komunitas alumni.', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-09-01 19:06:38', '2026-09-01 19:06:38'),
	(2, 2, 'ALM-2019-002', 2019, 'Multimedia', 'UI/UX Lead Designer', 'Kreasi Digital Nusantara', 'Jakarta Selatan', '081404366266', 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=300', 'Passionate in creating lovable digital products.', 'https://linkedin.com', 'https://instagram.com', NULL, NULL, NULL, NULL, 1, 1, '2026-09-01 19:06:39', '2026-09-01 19:06:39'),
	(3, 3, 'ALM-2015-003', 2015, 'Rekayasa Perangkat Lunak', 'Software Engineer', 'Sinergi Teknologi', 'Bandung', '085212161266', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300', 'Fullstack web developer and startup enthusiast.', 'https://linkedin.com', NULL, 'https://github.com', NULL, NULL, NULL, 1, 1, '2026-09-01 19:06:39', '2026-09-01 19:06:39'),
	(4, 4, 'ALM-2018-004', 2018, 'Teknik Komputer & Jaringan', 'Product Manager', 'Unicorn Edukasi', 'Jakarta Barat', '082911858874', 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=300', 'Building impactful edtech platforms.', 'https://linkedin.com', NULL, NULL, 'https://twitter.com', NULL, NULL, 0, 1, '2026-09-01 19:06:39', '2026-09-01 19:06:39'),
	(5, 5, 'ALM-2020-005', 2020, 'Desain Komunikasi Visual', 'Content Creator & Founder', 'Matchora Media', 'Surabaya', '086477137753', 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=300', 'Visual storyteller and creative strategist.', NULL, 'https://instagram.com', NULL, NULL, 'https://youtube.com', NULL, 1, 1, '2026-09-01 19:06:40', '2026-09-01 19:06:40'),
	(6, 6, 'ALM-2016-006', 2016, 'Pemasaran', 'Growth Lead', 'Nusantara Media', 'Jakarta', '082485962605', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300', 'Alumni berdedikasi dan siap saling mendukung.', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-09-01 19:06:40', '2026-09-01 19:06:40'),
	(7, 7, 'ALM-2020-007', 2020, 'Desain Komunikasi Visual', 'Art Director', 'Matchora Studio', 'Bandung', '086607853013', 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=300', 'Alumni berdedikasi dan siap saling mendukung.', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, '2026-09-01 19:06:40', '2026-09-01 19:06:40'),
	(8, 8, 'ALM-2015-008', 2015, 'Rekayasa Perangkat Lunak', 'Principal Engineer', 'Sinergi Teknologi', 'Yogyakarta', '089549872736', 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=300', 'Alumni berdedikasi dan siap saling mendukung.', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-09-01 19:06:41', '2026-09-01 19:06:41'),
	(9, 9, 'ALM-2017-009', 2017, 'Logistik', 'Supply Chain Manager', 'Logistik Kawan', 'Surabaya', '083842102477', 'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?w=300', 'Alumni berdedikasi dan siap saling mendukung.', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2026-09-01 19:06:41', '2026-09-01 19:06:41');

-- Dumping structure for table alumnispace.articles
CREATE TABLE IF NOT EXISTS `articles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `author_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Sekolah',
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `articles_slug_unique` (`slug`),
  KEY `articles_author_id_foreign` (`author_id`),
  CONSTRAINT `articles_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alumnispace.articles: ~3 rows (approximately)
DELETE FROM `articles`;
INSERT INTO `articles` (`id`, `author_id`, `title`, `slug`, `category`, `thumbnail`, `excerpt`, `content`, `published_at`, `is_published`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Peresmian Gedung Baru Lab Komputer Hasil Donasi Alumni', 'peresmian-gedung-baru-lab-komputer', 'Sekolah', 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=500', 'Fasilitas makin canggih buat adik-adik kelas belajar coding dan AI di sekolah.', 'Pembangunan laboratorium komputer baru di sekolah telah resmi selesai dan diresmikan berkat donasi dan kontribusi nyata dari berbagai angkatan alumni.', '2026-08-28 02:00:00', 1, '2026-09-01 19:06:42', '2026-09-01 19:06:42'),
	(2, 1, 'Tips Lolos Interview Kerja di Perusahaan Unicorn ala Kakak Alumni', 'tips-lolos-interview-kerja-unicorn', 'Karier', 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=500', 'Bongkar rahasia HRD saat menyaring CV fresh graduate berpengalaman organisasi.', 'Simak kiat praktis dan strategi menghadapi interview user maupun HR di perusahaan teknologi terkemuka langsung dari pengalaman alumni senior kita.', '2026-08-25 06:00:00', 1, '2026-09-01 19:06:42', '2026-09-01 19:06:42'),
	(3, 1, 'Persiapan Grand Reunion 2027: Bakal Ada Artis Tamu Spesial!', 'persiapan-grand-reunion-2027', 'Reuni', 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=500', 'Panitia angkatan 2010 siap mengguncang stadion utama dengan konsep festival musik.', 'Panitia gabungan lintas angkatan mulai mematangkan rencana reuni akbar terbesar dengan berbagai penampilan panggung, bazar kuliner, dan donor darah.', '2026-08-20 01:30:00', 1, '2026-09-01 19:06:42', '2026-09-01 19:06:42');

-- Dumping structure for table alumnispace.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alumnispace.cache: ~0 rows (approximately)
DELETE FROM `cache`;

-- Dumping structure for table alumnispace.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alumnispace.cache_locks: ~0 rows (approximately)
DELETE FROM `cache_locks`;

-- Dumping structure for table alumnispace.events
CREATE TABLE IF NOT EXISTS `events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_by` bigint unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Meetup',
  `badge_tag` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_date` date NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `time_display` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'offline',
  `venue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quota` int unsigned DEFAULT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'upcoming',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `events_slug_unique` (`slug`),
  KEY `events_created_by_foreign` (`created_by`),
  CONSTRAINT `events_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alumnispace.events: ~6 rows (approximately)
DELETE FROM `events`;
INSERT INTO `events` (`id`, `created_by`, `title`, `slug`, `category`, `badge_tag`, `banner_image`, `event_date`, `start_time`, `end_time`, `time_display`, `location_type`, `venue`, `description`, `registration_link`, `quota`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Ngobrol Santai: Menembus Karir Tech Global Tanpa Harus Kuliah IT', 'ngobrol-santai-karir-tech-global', 'Webinar', 'Webinar Karir', 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=500', '2026-09-15', NULL, NULL, '19:30 - 21:00 WIB via Zoom', 'online', 'Online via Zoom', 'Sesi sharing eksklusif bersama alumni senior yang sukses berkarier di tech unicorn global tanpa background formal IT.', NULL, 200, 'upcoming', '2026-09-01 19:06:41', '2026-09-01 19:06:41'),
	(2, 1, 'Mini Reunion & Futsal Cup Antar Angkatan 2015-2020', 'mini-reunion-futsal-cup', 'Meetup', 'Gathering Offline', 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=500', '2026-09-28', NULL, NULL, '08:00 - 13:00 WIB', 'offline', 'Lapangan Pancoran Soccer Field', 'Ajang silaturahmi sehat dan temu kangen sambil bertanding futsal santai antar angkatan.', NULL, 80, 'upcoming', '2026-09-01 19:06:41', '2026-09-01 19:06:41'),
	(3, 1, 'Mastering Personal Branding di LinkedIn & IG untuk Profesional', 'mastering-personal-branding', 'Workshop', 'Workshop', 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=500', '2026-10-10', NULL, NULL, '13:00 - 16:00 WIB', 'offline', 'Co-working Space Jaksel', 'Bedah strategi membangun reputasi profesional yang memikat recruiter dan calon klien di ranah digital.', NULL, 45, 'upcoming', '2026-09-01 19:06:41', '2026-09-01 19:06:41'),
	(4, 1, 'Gathering Santai Edisi Kemerdekaan', 'gathering-santai-edisi-kemerdekaan', 'Meetup', 'Meetup', 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=500', '2026-08-15', NULL, NULL, '16:00 - 20:00 WITA', 'offline', 'Denpasar, Bali', 'Keseruan kumpul-kumpul sambil ngobrolin seputar perkembangan dunia kerja kreatif lintas angkatan di salah satu cafe hits Bali.', NULL, 50, 'completed', '2026-09-01 19:06:41', '2026-09-01 19:06:41'),
	(5, 1, 'Webinar UI/UX & AI Integration', 'webinar-ui-ux-ai-integration', 'Webinar', 'Webinar', 'https://images.unsplash.com/photo-1531545514256-b1400bc00f31?w=500', '2026-07-28', NULL, NULL, '19:00 - 21:00 WIB', 'online', 'Online via Zoom', 'Sesi sharing intensif bersama para alumni senior yang membedah bagaimana memanfaatkan AI untuk efisiensi desain produk.', NULL, 300, 'completed', '2026-09-01 19:06:41', '2026-09-01 19:06:41'),
	(6, 1, 'Workshop Kilat: Ngoding Bareng PHP & XAMPP', 'workshop-kilat-ngoding-php-xampp', 'Workshop', 'Workshop', 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?w=500', '2026-06-10', NULL, NULL, '09:00 - 15:00 WIB', 'offline', 'Lab Komputer Utama', 'Peserta antusias serius ngulik database dan debugging kode bersama mentor alumni di lab kampus.', NULL, 30, 'completed', '2026-09-01 19:06:41', '2026-09-01 19:06:41');

-- Dumping structure for table alumnispace.event_registrations
CREATE TABLE IF NOT EXISTS `event_registrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `ticket_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'registered',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `event_registrations_ticket_code_unique` (`ticket_code`),
  KEY `event_registrations_event_id_foreign` (`event_id`),
  KEY `event_registrations_user_id_foreign` (`user_id`),
  CONSTRAINT `event_registrations_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `event_registrations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alumnispace.event_registrations: ~0 rows (approximately)
DELETE FROM `event_registrations`;

-- Dumping structure for table alumnispace.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alumnispace.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table alumnispace.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alumnispace.jobs: ~0 rows (approximately)
DELETE FROM `jobs`;

-- Dumping structure for table alumnispace.job_applications
CREATE TABLE IF NOT EXISTS `job_applications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `job_vacancy_id` bigint unsigned NOT NULL,
  `applicant_id` bigint unsigned NOT NULL,
  `resume_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `portfolio_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_letter` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_applications_job_vacancy_id_foreign` (`job_vacancy_id`),
  KEY `job_applications_applicant_id_foreign` (`applicant_id`),
  CONSTRAINT `job_applications_applicant_id_foreign` FOREIGN KEY (`applicant_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `job_applications_job_vacancy_id_foreign` FOREIGN KEY (`job_vacancy_id`) REFERENCES `job_vacancies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alumnispace.job_applications: ~0 rows (approximately)
DELETE FROM `job_applications`;

-- Dumping structure for table alumnispace.job_batches
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

-- Dumping data for table alumnispace.job_batches: ~0 rows (approximately)
DELETE FROM `job_batches`;

-- Dumping structure for table alumnispace.job_vacancies
CREATE TABLE IF NOT EXISTS `job_vacancies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `posted_by` bigint unsigned DEFAULT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alumni_contact` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Full-Time',
  `workplace_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'On-Site',
  `category` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `highlight_badge` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary_display` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'per_month',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `requirements` text COLLATE utf8mb4_unicode_ci,
  `skills_tags` json DEFAULT NULL,
  `application_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `application_email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `job_vacancies_slug_unique` (`slug`),
  KEY `job_vacancies_posted_by_foreign` (`posted_by`),
  CONSTRAINT `job_vacancies_posted_by_foreign` FOREIGN KEY (`posted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alumnispace.job_vacancies: ~10 rows (approximately)
DELETE FROM `job_vacancies`;
INSERT INTO `job_vacancies` (`id`, `posted_by`, `title`, `slug`, `company_name`, `company_logo`, `alumni_contact`, `job_type`, `workplace_type`, `category`, `highlight_badge`, `location`, `salary_display`, `salary_type`, `description`, `requirements`, `skills_tags`, `application_link`, `application_email`, `deadline`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 6, 'Junior UI/UX Designer', 'junior-ui-ux-designer', 'Kreasi Digital Nusantara', 'DS', 'Kak Rian (2018)', 'Full-Time', 'Remote', 'Design', 'Rekomendasi Alumni', 'Remote / WFH', 'Rp 4.5M - 6.5M / bln', 'per_month', 'Lagi cari pelabuhan karier baru atau mau naik tingkat di dunia desain? Perusahaan yang dibangun sama alumni senior kita lagi buka pintu lebar-lebar buat kamu yang jago bikin tampilan aplikasi jadi ciamik! Yuk, berkarya bareng keluarga sendiri.', 'Penguasaan Figma, Design System, Wireframing, dan User Research dasar.', '["Full-Time", "Remote", "Figma"]', NULL, NULL, NULL, 1, '2026-09-01 19:06:41', '2026-09-01 19:06:41'),
	(2, 1, 'Junior Web Developer', 'junior-web-developer', 'Solusi Pintar Edukasi', 'WD', 'Tim Alumni', 'Freelance', 'Hybrid', 'Technology', 'Hot Project', 'Jakarta / Hybrid', 'Berdasarkan Project', 'per_project', 'Panggilan buat para pencinta kode dan tukang ngulik database! Perusahaan partner alumni kita lagi butuh bala bantuan nih buat ngembangin sistem informasi sekolah dan manajemen data berbasis web. Anti ribet, asik buat nambah portofolio!', 'Memahami dasar PHP, MySQL/XAMPP, JavaScript, dan framework MVC.', '["Freelance", "Hybrid", "PHP & XAMPP"]', NULL, NULL, NULL, 1, '2026-09-01 19:06:41', '2026-09-01 19:06:41'),
	(3, 7, 'Content & Social Media Specialist', 'content-social-media-specialist', 'Matchora Brand', 'CM', 'Kak Dewi (2020)', 'Full-Time', 'WFO Jakarta', 'Creative & Marketing', 'Fresh Grad', 'Jakarta Selatan', 'Rp 4.0M - 5.5M / bln', 'per_month', 'Suka bikin konten seru, ngerti tren TikTok/Reels, dan hobi nulis caption yang jenaka? Jenama kuliner milik alumni kita lagi berkembang pesat dan butuh talenta kreatif yang asyik diajak kerja bareng. Segera daftarkan dirimu!', 'Kreatif, memahami algoritma media sosial, dan memiliki kemampuan copywriting yang menarik.', '["Full-Time", "WFO Jakarta", "Copywriting"]', NULL, NULL, NULL, 1, '2026-09-01 19:06:41', '2026-09-01 19:06:41'),
	(4, 1, 'Community & Event Manager', 'community-event-manager', 'Antares Organizer', 'AO', 'Pengurus Pusat', 'Full-Time', 'Bandung / Remote', 'Management', 'Special Opening', 'Bandung / Remote', 'Rp 5.0M - 7.0M / bln', 'per_month', 'Punya bakat ngumpulin orang, seru, dan hobi bikin acara kumpul-kumpul yang pecah? Yuk, gabung jadi penggerak utama di balik layar berbagai event seru dan temu kangen alumni kita selanjutnya! Suasana kerja dijamin seru ala keluarga sendiri.', 'Pengalaman mengelola event offline/online dan kemampuan komunikasi persuasif.', '["Full-Time", "Bandung / Remote", "Event"]', NULL, NULL, NULL, 1, '2026-09-01 19:06:41', '2026-09-01 19:06:41'),
	(5, 6, 'Digital Marketing Growth Specialist', 'digital-marketing-growth-specialist', 'Nusantara Media', 'DM', 'Kak Bayu (2016)', 'Remote', 'Remote', 'Marketing', 'Fast Growth', 'Remote / WFH', 'Rp 6.0M - 8.5M / bln', 'per_month', 'Mau ngebantu brand lokal milik alumni melesat tinggi lewat strategi iklan digital dan analisis data yang ciamik? Posisi ini pas banget buat kamu yang hobi eksperimen campaign dan baca tren market terkini!', 'Pengalaman menjalankan Meta Ads, Google Ads, TikTok Ads, dan Google Analytics.', '["Full-Time", "Remote", "Ads & Analytics"]', NULL, NULL, NULL, 1, '2026-09-01 19:06:41', '2026-09-01 19:06:41'),
	(6, 7, 'Graphic Design Intern', 'graphic-design-intern', 'Matchora Studio', 'GI', 'Kak Dewi (2020)', 'Magang', 'Hybrid', 'Design', 'Intern Program', 'Bandung', 'Rp 2.0M - 3.0M / bln', 'incentive', 'Buat adik-adik tingkat atau fresh graduate yang mau nyari pengalaman nyata di industri kreatif, yuk magang bareng kita! Bakalan dibimbing langsung cara bikin visual brand produk makanan dan minuman yang gemesin.', 'Mahir Adobe Illustrator / Photoshop, memiliki portofolio desain visual.', '["Magang", "Hybrid", "Illustrator"]', NULL, NULL, NULL, 1, '2026-09-01 19:06:41', '2026-09-01 19:06:41'),
	(7, 8, 'Senior Fullstack Engineer', 'senior-fullstack-engineer', 'Sinergi Teknologi', 'SF', 'Kak Fajar (2015)', 'Full-Time', 'Remote', 'Technology', 'Tech Lead', 'Remote / WFH', 'Rp 10M - 14M / bln', 'per_month', 'Punya pengalaman matang di framework Laravel dan terbiasa merancang arsitektur sistem skala besar? Senior kita lagi bangun tim impian dan butuh tangan kanan handal buat nakhodain project-project skala nasional!', 'Minimal 3 tahun pengalaman Laravel, Vue.js/React, REST API, Database Optimization.', '["Full-Time", "Remote", "Laravel & Vue"]', NULL, NULL, NULL, 1, '2026-09-01 19:06:41', '2026-09-01 19:06:41'),
	(8, 1, 'Podcast Host & Copywriter', 'podcast-host-copywriter', 'Ngobrol Bareng Alumni', 'PH', 'Tim Media', 'Freelance', 'Studio Jakarta', 'Media & Broadcasting', 'Kreatif & Seru', 'Jakarta Selatan', 'Per Episode', 'per_episode', 'Pede ngomong di depan kamera/mikrofon, punya suara renyah, dan hobi ngulik cerita unik dari para alumni sukses? Gabung jadi host program bincang-bincang santai kita yuk! Pastinya seru dan nambah relasi luas.', 'Public speaking yang luwes, percaya diri, dan kemampuan improvisasi wawancara.', '["Freelance", "Studio Jakarta", "Public Speaking"]', NULL, NULL, NULL, 1, '2026-09-01 19:06:41', '2026-09-01 19:06:41'),
	(9, 9, 'Operations & Supply Chain Lead', 'operations-supply-chain-lead', 'Logistik Kawan', 'LK', 'Kak Reza (2017)', 'Full-Time', 'On-Site Surabaya', 'Operations', 'Hot Demand', 'Surabaya', 'Rp 7.5M - 10M / bln', 'per_month', 'Jago ngatur logistik, manajemen gudang, dan koordinasi mitra bisnis dengan efisien? Perusahaan ekspedisi milik alumni kita lagi butuh sosok pemimpin operasional yang cekatan dan solutif.', 'Pengalaman operasional warehouse, fleet management, dan vendor negotiation.', '["Full-Time", "On-Site Surabaya", "Supply Chain"]', NULL, NULL, NULL, 1, '2026-09-01 19:06:41', '2026-09-01 19:06:41'),
	(10, 1, 'Customer Happiness Officer', 'customer-happiness-officer', 'Edukasi Digital', 'CH', 'Tim Alumni', 'Remote', 'Remote', 'Customer Support', 'Junior Friendly', 'Remote / WFH', 'Rp 4.0M - 5.5M / bln', 'per_month', 'Punya empati tinggi, sabar, ramah, dan suka bantu orang lain mecahin masalah seputar aplikasi belajar online? Posisi ini sangat ramah buat fresh graduate yang mau merintis karier di dunia startup edukasi.', 'Kemampuan komunikasi tulisan & lisan yang baik, ramah, dan solutif.', '["Full-Time", "Remote", "Communication"]', NULL, NULL, NULL, 1, '2026-09-01 19:06:41', '2026-09-01 19:06:41');

-- Dumping structure for table alumnispace.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alumnispace.migrations: ~13 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_09_02_000001_add_role_and_status_to_users_table', 1),
	(5, '2026_09_02_000002_create_alumni_profiles_table', 1),
	(6, '2026_09_02_000003_create_job_vacancies_table', 1),
	(7, '2026_09_02_000004_create_job_applications_table', 1),
	(8, '2026_09_02_000005_create_events_table', 1),
	(9, '2026_09_02_000006_create_event_registrations_table', 1),
	(10, '2026_09_02_000007_create_albums_table', 1),
	(11, '2026_09_02_000008_create_album_photos_table', 1),
	(12, '2026_09_02_000009_create_testimonials_table', 1),
	(13, '2026_09_02_000010_create_articles_table', 1);

-- Dumping structure for table alumnispace.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alumnispace.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;

-- Dumping structure for table alumnispace.sessions
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

-- Dumping data for table alumnispace.sessions: ~0 rows (approximately)
DELETE FROM `sessions`;

-- Dumping structure for table alumnispace.testimonials
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `graduation_year` smallint unsigned DEFAULT NULL,
  `profession` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quote` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` tinyint unsigned NOT NULL DEFAULT '5',
  `is_featured` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `testimonials_user_id_foreign` (`user_id`),
  CONSTRAINT `testimonials_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alumnispace.testimonials: ~5 rows (approximately)
DELETE FROM `testimonials`;
INSERT INTO `testimonials` (`id`, `user_id`, `name`, `graduation_year`, `profession`, `avatar`, `quote`, `rating`, `is_featured`, `created_at`, `updated_at`) VALUES
	(1, 3, 'Rangga Pratama', 2015, 'Software Engineer', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100', 'Berkat AlumniSpace, aku bisa nyambung lagi sama ketua geng kelasku dulu dan sekarang malah jadi partner bisnis startup!', 5, 1, '2026-09-01 19:06:42', '2026-09-01 19:06:42'),
	(2, 4, 'Nabila Zahra', 2018, 'Product Manager', 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100', 'Informasi lowongan kerja di sini valid banget karena langsung direkomendasikan sama kakak tingkat yang udah senior di korporat.', 5, 1, '2026-09-01 19:06:42', '2026-09-01 19:06:42'),
	(3, 5, 'Dimas Anggara', 2020, 'Content Creator', 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100', 'Tampilan web-nya gemesin banget, pas banget sama selera anak muda dan gak ngebosenin pas dibuka di HP.', 5, 1, '2026-09-01 19:06:42', '2026-09-01 19:06:42'),
	(4, NULL, 'Rian', 2018, 'Angkatan 2018', NULL, 'Sumpah ngebantu banget! Lewat web ini akhirnya bisa kontakan lagi sama geng sekelas dulu. Malah kemarin sempat nongkrong bareng lagi. Asyik banget!', 5, 1, '2026-09-01 19:06:42', '2026-09-01 19:06:42'),
	(5, NULL, 'Dewi', 2020, 'Angkatan 2020', NULL, 'Fitur lokernya juara! Kemarin dapet info lowongan dari senior sendiri, alhamdulillah langsung diterima. Makasih banyak wadahnya!', 5, 1, '2026-09-01 19:06:42', '2026-09-01 19:06:42');

-- Dumping structure for table alumnispace.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'alumni',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alumnispace.users: ~9 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Administrator Alumni', 'admin@alumnispace.id', NULL, '$2y$12$fgEQcgeGOunU/S6WLboU0e/ifIVi0s/s8RQNBJyZAe89BeQCG5ewO', 'admin', 1, NULL, '2026-09-01 19:06:38', '2026-09-01 19:06:38'),
	(2, 'Kanya Salsabila', 'kanya.salsabila@alumni.id', NULL, '$2y$12$YX6kmhIyg1sgOtc1wSb.yODYXZqxy6gPU4vjv.dCdFPEMefpVYD9C', 'alumni', 1, NULL, '2026-09-01 19:06:39', '2026-09-01 19:06:39'),
	(3, 'Rangga Pratama', 'rangga.pratama@alumni.id', NULL, '$2y$12$FFrdeSXUpkaNjwXH1CVMQeaihkQhozfDOSNf4u2o25NV.rThcYogS', 'alumni', 1, NULL, '2026-09-01 19:06:39', '2026-09-01 19:06:39'),
	(4, 'Nabila Zahra', 'nabila.zahra@alumni.id', NULL, '$2y$12$0pIqhP8ILP7Amx0v2ysYb.UeSjwarwNEPSZdq3DioZL3JVavAvIba', 'alumni', 1, NULL, '2026-09-01 19:06:39', '2026-09-01 19:06:39'),
	(5, 'Dimas Anggara', 'dimas.anggara@alumni.id', NULL, '$2y$12$OzoD3eg3X99/EpCmy8f0QOstdBQzpHf5j8macZnJDtO/PMrzs3tPq', 'alumni', 1, NULL, '2026-09-01 19:06:40', '2026-09-01 19:06:40'),
	(6, 'Kak Bayu', 'bayu.2016@alumni.id', NULL, '$2y$12$gc0gBdlfMja00C2wv/dL4OWlIzkaqW62tVoZgDQlXiRcRHTjozV/e', 'alumni', 1, NULL, '2026-09-01 19:06:40', '2026-09-01 19:06:40'),
	(7, 'Kak Dewi', 'dewi.2020@alumni.id', NULL, '$2y$12$Is/C6mbMy5T2z1drgPMIC.wcPwmE9YuyLVEvDAhfmn23lHBK5G8p2', 'alumni', 1, NULL, '2026-09-01 19:06:40', '2026-09-01 19:06:40'),
	(8, 'Kak Fajar', 'fajar.2015@alumni.id', NULL, '$2y$12$CRf8U6pL.JboH.yuKrzjYOZ9hDskI7W2GnDdlxEuBEtcXzXXpfuJa', 'alumni', 1, NULL, '2026-09-01 19:06:41', '2026-09-01 19:06:41'),
	(9, 'Kak Reza', 'reza.2017@alumni.id', NULL, '$2y$12$tKMpJmPzgnDSS8Kc/A0BZ.2DusmbIi344rrjKspvlHQNGyHMvF1W6', 'alumni', 1, NULL, '2026-09-01 19:06:41', '2026-09-01 19:06:41');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

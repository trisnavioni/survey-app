-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 26, 2025 at 10:31 AM
-- Server version: 10.6.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `programt_survei`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `name`, `aktif`, `created_at`, `updated_at`) VALUES
(1, NULL, 'elektronik', 1, '2025-10-05 07:08:31', '2025-10-05 07:11:20'),
(2, 2, 'wibu', 1, '2025-10-12 05:11:18', '2025-10-12 07:45:07'),
(3, 5, 'minuman', 1, '2025-10-12 05:26:14', '2025-10-12 06:51:49'),
(4, 5, 'makanan', 0, '2025-10-12 05:26:59', '2025-10-12 06:51:49'),
(5, 5, 'seblak', 0, '2025-10-12 06:00:43', '2025-10-12 06:51:49'),
(6, 7, 'susu', 1, '2025-10-12 17:57:15', '2025-10-12 17:57:30'),
(7, 8, 'kepuasan pelanggan', 1, '2025-10-12 22:09:53', '2025-11-14 00:49:38'),
(9, 9, 'SMKN1DPS', 1, '2025-10-14 18:03:20', '2025-10-14 18:03:24'),
(10, 11, 'jaitan', 1, '2025-10-19 05:05:35', '2025-10-19 05:08:05'),
(21, 20, 'pppp', 1, '2025-11-12 19:48:59', '2025-11-12 20:05:39'),
(42, 22, 'marsya', 1, '2025-11-13 20:28:47', '2025-11-13 20:29:16'),
(47, 24, 'anjay', 1, '2025-11-14 09:06:58', '2025-11-14 09:07:12'),
(48, 8, 'pp', 0, '2025-11-23 20:22:48', '2025-11-23 20:22:48');

-- --------------------------------------------------------

--
-- Table structure for table `data_diris`
--

CREATE TABLE `data_diris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `umur` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_diris`
--

INSERT INTO `data_diris` (`id`, `user_id`, `nama_lengkap`, `jenis_kelamin`, `umur`, `created_at`, `updated_at`) VALUES
(1, NULL, 'trisna vioni', 'P', 17, '2025-10-05 07:09:06', '2025-10-05 07:09:06'),
(2, NULL, 'kevin', 'L', 10, '2025-10-05 07:11:58', '2025-10-05 07:11:58'),
(3, NULL, 'kinara', 'P', 15, '2025-10-11 18:46:15', '2025-10-11 18:46:15'),
(4, NULL, 'anita', 'P', 18, '2025-10-11 19:14:30', '2025-10-11 19:14:30'),
(5, NULL, 'wibu', 'P', 90, '2025-10-12 06:47:33', '2025-10-12 06:47:33'),
(6, NULL, 'anjay', 'P', 10, '2025-10-12 06:57:34', '2025-10-12 06:57:34'),
(7, NULL, 'ppppp', 'L', 11, '2025-10-12 07:01:56', '2025-10-12 07:01:56'),
(8, NULL, 'cuaks', 'L', 16, '2025-10-12 07:15:06', '2025-10-12 07:15:06'),
(9, 5, 'vio', 'P', 15, '2025-10-12 07:29:58', '2025-10-12 07:29:58'),
(10, 7, 'marsya', 'P', 11, '2025-10-12 17:59:28', '2025-10-12 17:59:28'),
(11, 7, 'marsya', 'P', 11, '2025-10-12 18:08:17', '2025-10-12 18:08:17'),
(12, 7, 'dayu', 'P', 12, '2025-10-12 18:08:59', '2025-10-12 18:08:59'),
(13, 7, 'lin', 'L', 11, '2025-10-12 18:11:11', '2025-10-12 18:11:11'),
(14, 7, 'lin', 'L', 11, '2025-10-12 18:23:37', '2025-10-12 18:23:37'),
(15, 7, 'botol', 'L', 11, '2025-10-12 18:26:59', '2025-10-12 18:26:59'),
(16, 7, 'giri', 'P', 11, '2025-10-12 18:27:20', '2025-10-12 18:27:20'),
(17, 7, 'giri', 'P', 11, '2025-10-12 18:29:38', '2025-10-12 18:29:38'),
(18, 5, 'marsya', 'P', 15, '2025-10-12 22:01:04', '2025-10-12 22:01:04'),
(19, 8, 'vioni', 'P', 11, '2025-10-12 22:12:05', '2025-10-12 22:12:05'),
(20, 8, 'ana', 'P', 11, '2025-10-12 22:33:52', '2025-10-12 22:33:52'),
(21, 8, 'delin', 'P', 12, '2025-10-13 23:41:45', '2025-10-13 23:41:45'),
(22, 8, 'p', 'L', 11, '2025-10-13 23:43:35', '2025-10-13 23:43:35'),
(23, 8, 'marsya', 'P', 11, '2025-10-13 23:45:04', '2025-10-13 23:45:04'),
(24, 8, 'hey', 'P', 16, '2025-10-14 04:22:37', '2025-10-14 04:22:37'),
(25, 8, 'halo', 'P', 11, '2025-10-14 04:38:12', '2025-10-14 04:38:12'),
(26, 8, 'p', 'P', 99, '2025-10-14 04:38:32', '2025-10-14 04:38:32'),
(27, 8, 'tumbler', 'P', 11, '2025-10-14 04:39:38', '2025-10-14 04:39:38'),
(28, 8, 'test', 'P', 11, '2025-10-14 04:40:25', '2025-10-14 04:40:25'),
(29, 8, 'p', 'L', 11, '2025-10-14 04:50:10', '2025-10-14 04:50:10'),
(30, 8, 'ppp', 'L', 34, '2025-10-14 05:04:33', '2025-10-14 05:04:33'),
(31, 8, 'ppp', 'L', 34, '2025-10-14 05:04:43', '2025-10-14 05:04:43'),
(32, 4, 'anjay', 'L', 11, '2025-10-14 06:12:54', '2025-10-14 06:12:54'),
(33, 5, 'vioni', 'L', 11, '2025-10-14 06:15:08', '2025-10-14 06:15:08'),
(34, 9, 'trisna', 'P', 11, '2025-10-14 18:33:31', '2025-10-14 18:33:31'),
(35, 8, 'ana pertiwi', 'P', 11, '2025-10-14 19:10:04', '2025-10-14 19:10:04'),
(36, 8, 'vio', 'P', 12, '2025-10-15 00:37:29', '2025-10-15 00:37:29'),
(37, 8, 'Dewa ajus', 'L', 22, '2025-10-15 00:50:49', '2025-10-15 00:50:49'),
(38, 8, 'vio', 'P', 14, '2025-10-15 00:51:24', '2025-10-15 00:51:24'),
(39, 8, 'Dewi', 'P', 20, '2025-10-15 00:51:29', '2025-10-15 00:51:29'),
(40, 8, 'anjay', 'P', 12, '2025-10-15 06:21:04', '2025-10-15 06:21:04'),
(41, 8, 'p', 'P', 11, '2025-10-19 05:00:01', '2025-10-19 05:00:01'),
(42, 8, 'vio', 'P', 12, '2025-10-19 05:00:39', '2025-10-19 05:00:39'),
(43, 8, 'anita', 'P', 11, '2025-10-19 05:01:43', '2025-10-19 05:01:43'),
(44, 12, 'sayang', 'P', 11, '2025-10-25 21:21:29', '2025-10-25 21:21:29'),
(45, 12, 'ana pertiwi', 'P', 11, '2025-10-26 02:27:33', '2025-10-26 02:27:33'),
(46, 12, 'test', 'P', 11, '2025-10-26 06:14:41', '2025-10-26 06:14:41'),
(47, 12, 'p', 'P', 77, '2025-10-26 06:18:36', '2025-10-26 06:18:36'),
(48, 8, 'p', 'P', 11, '2025-10-27 06:48:00', '2025-10-27 06:48:00'),
(49, 8, 'saya', 'P', 11, '2025-10-27 06:55:56', '2025-10-27 06:55:56'),
(50, 8, 'p', 'P', 66, '2025-10-27 18:28:02', '2025-10-27 18:28:02'),
(51, 8, 'vio', 'P', 12, '2025-10-27 18:41:10', '2025-10-27 18:41:10'),
(52, 8, 'anjay', 'P', 14, '2025-10-27 18:59:48', '2025-10-27 18:59:48'),
(53, 8, 'viona', 'P', 16, '2025-10-27 19:19:54', '2025-10-27 19:19:54'),
(54, 8, 'anjay', 'P', 16, '2025-10-27 19:21:07', '2025-10-27 19:21:07'),
(55, 8, 'ana pertiwi', 'P', 16, '2025-10-28 00:07:09', '2025-10-28 00:07:09'),
(56, 8, 'p', 'P', 13, '2025-10-28 07:26:02', '2025-10-28 07:26:02'),
(57, 8, 'vio', 'P', 11, '2025-11-09 18:18:34', '2025-11-09 18:18:34'),
(58, 8, 'vio', 'P', 11, '2025-11-09 21:52:57', '2025-11-09 21:52:57'),
(59, 8, 'p', 'P', 45, '2025-11-09 21:59:57', '2025-11-09 21:59:57'),
(60, 8, 'pppp', 'P', 15, '2025-11-10 05:03:42', '2025-11-10 05:03:42'),
(61, 8, 'sayang', 'P', 16, '2025-11-10 05:10:14', '2025-11-10 05:10:14'),
(62, 8, 'anjay', 'P', 16, '2025-11-10 06:58:46', '2025-11-10 06:58:46'),
(63, 8, 'vio', 'P', 15, '2025-11-11 05:07:19', '2025-11-11 05:07:19'),
(64, 8, 'vio', 'P', 15, '2025-11-11 05:28:06', '2025-11-11 05:28:06'),
(65, 8, 'pp', 'P', 15, '2025-11-11 05:34:08', '2025-11-11 05:34:08'),
(66, 8, 'dwik', 'P', 16, '2025-11-11 19:05:24', '2025-11-11 19:05:24'),
(67, 8, 'ana pertiwi', 'P', 15, '2025-11-11 19:07:54', '2025-11-11 19:07:54'),
(68, 20, 'anjay', 'P', 16, '2025-11-12 18:07:10', '2025-11-12 18:07:10'),
(69, 20, 'trisna', 'P', 12, '2025-11-12 19:49:40', '2025-11-12 19:49:40'),
(70, 20, 'wibu', 'P', 12, '2025-11-12 19:52:49', '2025-11-12 19:52:49'),
(71, 20, 'vio', 'P', 16, '2025-11-12 19:54:11', '2025-11-12 19:54:11'),
(72, 21, 'dfvdfvd', 'P', 15, '2025-11-12 23:57:01', '2025-11-12 23:57:01'),
(73, 8, 'vio', 'P', 12, '2025-11-13 17:57:16', '2025-11-13 17:57:16'),
(74, 8, 'marsya putri', 'P', 15, '2025-11-13 20:25:32', '2025-11-13 20:25:32'),
(75, 22, 'vio', 'P', 19, '2025-11-13 20:30:26', '2025-11-13 20:30:26'),
(76, 8, 'adxasd', 'P', 16, '2025-11-14 06:32:44', '2025-11-14 06:32:44'),
(77, 8, 'anjay', 'P', 17, '2025-11-14 09:32:03', '2025-11-14 09:32:03'),
(78, 8, 'anjay', 'P', 17, '2025-11-14 09:32:06', '2025-11-14 09:32:06'),
(79, 8, 'bulan', 'P', 26, '2025-11-14 09:32:06', '2025-11-14 09:32:06');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_08_25_060157_create_data_diris_table', 1),
(6, '2025_08_25_060210_create_questions_table', 1),
(7, '2025_08_25_060224_create_responses_table', 1),
(8, '2025_08_28_020811_update_data_diris_table_nullable_user_id', 1),
(9, '2025_09_02_025936_create_categories_table', 2),
(10, '2025_09_02_030043_add_category_id_to_questions_table', 3),
(11, '2025_09_02_034739_add_category_id_to_responses_table', 4),
(12, '2025_09_04_155203_add_aktif_to_categories_table', 5),
(13, '2025_09_11_145644_create_surveys_table', 6),
(14, '2025_09_11_153741_add_active_to_surveys_table', 7),
(15, '2025_10_12_032423_add_slug_to_users_table', 8),
(16, '2025_10_12_044215_add_user_id_to_categories_table', 9),
(17, '2025_10_12_051722_add_user_id_to_admin_tables', 10),
(18, '2025_10_12_155302_add_survey_link_to_users_table', 11),
(19, '2025_10_13_141202_add_logo_to_surveys_table', 12),
(20, '2025_10_14_045815_add_colors_to_surveys_table', 13),
(21, '2025_10_14_122522_add_colors_to_surveys_table', 14),
(22, '2025_11_13_073420_update_unique_index_on_categories_table', 15);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pertanyaan` varchar(255) NOT NULL,
  `tipe_jawaban` enum('emoji4','skala4') NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `user_id`, `pertanyaan`, `tipe_jawaban`, `aktif`, `created_at`, `updated_at`, `category_id`) VALUES
(1, NULL, 'apakah barang ini bagus', 'emoji4', 1, '2025-10-05 07:10:36', '2025-10-05 07:10:36', 1),
(2, NULL, 'apakah barang ini berkualitas', 'emoji4', 1, '2025-10-05 07:10:47', '2025-10-05 07:10:47', 1),
(3, 5, 'apakah minuman ini menyegarkan', 'emoji4', 1, '2025-10-12 05:26:27', '2025-10-12 05:26:27', 3),
(4, 5, 'apakah minuman ini enak', 'emoji4', 1, '2025-10-12 05:26:40', '2025-10-12 05:26:40', 3),
(5, 5, 'apakah minuman ini enak', 'emoji4', 1, '2025-10-12 05:28:33', '2025-10-12 05:28:33', 3),
(6, 5, 'enak gak', 'emoji4', 1, '2025-10-12 05:28:47', '2025-10-12 05:28:47', 4),
(7, 5, 'p', 'emoji4', 1, '2025-10-12 06:03:13', '2025-10-12 06:03:13', 5),
(8, 2, 'apa kamu wibu', 'emoji4', 1, '2025-10-12 07:44:55', '2025-10-12 07:44:55', 2),
(9, 7, 'p', 'emoji4', 1, '2025-10-12 17:57:21', '2025-10-12 17:57:21', 6),
(10, 8, 'bagaimana pelayanan after sale dari kami?', 'skala4', 1, '2025-10-12 22:10:12', '2025-11-14 05:28:48', 7),
(11, 8, 'bagaimana kesan anda dengan operator kami?', 'emoji4', 1, '2025-10-12 22:10:35', '2025-10-12 22:10:35', 7),
(12, 9, 'seberapa tertarik untuk bersekolah di SMKN1DPS', 'emoji4', 1, '2025-10-14 18:03:58', '2025-10-14 18:03:58', 9),
(15, 11, 'bagaimana pelayanan buk ita?', 'emoji4', 1, '2025-10-19 05:07:32', '2025-10-19 05:07:32', 10),
(16, 11, 'bagaimana bentuk jaitan kami?', 'emoji4', 1, '2025-10-19 05:07:50', '2025-10-19 05:07:50', 10),
(19, 8, 'apa yang kamu ketahui mengenai anjay anjay anjay anjay anjay anjay anjay vanjay anjay anjay anjay anjay anjay anjay anjay anjay anjayh anjay anjay anjay anjay anjay', 'emoji4', 1, '2025-10-28 00:19:06', '2025-11-14 05:29:09', NULL),
(29, 21, 'saxac', 'emoji4', 1, '2025-11-13 20:17:46', '2025-11-13 20:17:46', NULL),
(30, 22, 'anjay', 'emoji4', 1, '2025-11-13 20:28:57', '2025-11-13 20:28:57', 42),
(33, 8, 'sdvdv', 'emoji4', 1, '2025-11-14 00:45:20', '2025-11-14 00:45:20', NULL),
(34, 8, 'efer', 'emoji4', 1, '2025-11-14 05:20:09', '2025-11-14 05:20:09', NULL),
(35, 8, 'jfvbdvfbdv', 'emoji4', 1, '2025-11-14 05:26:25', '2025-11-14 05:26:25', NULL),
(36, 8, 'dbcjbcdbc', 'emoji4', 1, '2025-11-14 05:28:11', '2025-11-14 05:28:11', NULL),
(37, 24, 'pppp', 'emoji4', 1, '2025-11-14 09:07:05', '2025-11-14 09:07:05', 47);

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `data_diri_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `jawaban` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `responses`
--

INSERT INTO `responses` (`id`, `user_id`, `data_diri_id`, `question_id`, `jawaban`, `created_at`, `updated_at`, `category_id`) VALUES
(1, NULL, 2, 1, 2, '2025-10-05 07:12:05', '2025-10-05 07:12:05', 1),
(2, NULL, 2, 2, 3, '2025-10-05 07:12:05', '2025-10-05 07:12:05', 1),
(3, NULL, 3, 1, 4, '2025-10-11 18:46:24', '2025-10-11 18:46:24', 1),
(4, NULL, 3, 2, 4, '2025-10-11 18:46:24', '2025-10-11 18:46:24', 1),
(5, NULL, 4, 1, 3, '2025-10-11 19:14:45', '2025-10-11 19:14:45', 1),
(6, NULL, 4, 2, 3, '2025-10-11 19:14:45', '2025-10-11 19:14:45', 1),
(7, 5, 9, 3, 1, '2025-10-12 07:36:09', '2025-10-12 07:36:09', 3),
(8, 5, 9, 4, 1, '2025-10-12 07:36:09', '2025-10-12 07:36:09', 3),
(9, 5, 9, 5, 1, '2025-10-12 07:36:09', '2025-10-12 07:36:09', 3),
(10, 7, 17, 9, 4, '2025-10-12 18:29:50', '2025-10-12 18:29:50', 6),
(11, 5, 18, 3, 4, '2025-10-12 22:01:11', '2025-10-12 22:01:11', 3),
(12, 5, 18, 4, 4, '2025-10-12 22:01:11', '2025-10-12 22:01:11', 3),
(13, 5, 18, 5, 4, '2025-10-12 22:01:11', '2025-10-12 22:01:11', 3),
(14, 8, 19, 10, 1, '2025-10-12 22:12:14', '2025-10-12 22:12:14', 7),
(15, 8, 19, 11, 1, '2025-10-12 22:12:14', '2025-10-12 22:12:14', 7),
(16, 8, 20, 10, 2, '2025-10-12 22:34:18', '2025-10-12 22:34:18', 7),
(17, 8, 20, 11, 2, '2025-10-12 22:34:18', '2025-10-12 22:34:18', 7),
(18, 8, 21, 10, 1, '2025-10-13 23:41:49', '2025-10-13 23:41:49', 7),
(19, 8, 21, 11, 2, '2025-10-13 23:41:49', '2025-10-13 23:41:49', 7),
(20, 8, 22, 10, 3, '2025-10-13 23:43:39', '2025-10-13 23:43:39', 7),
(21, 8, 22, 11, 2, '2025-10-13 23:43:39', '2025-10-13 23:43:39', 7),
(22, 8, 23, 10, 3, '2025-10-13 23:45:21', '2025-10-13 23:45:21', 7),
(23, 8, 23, 11, 3, '2025-10-13 23:45:21', '2025-10-13 23:45:21', 7),
(24, 5, 33, 3, 2, '2025-10-14 06:16:46', '2025-10-14 06:16:46', 3),
(25, 5, 33, 4, 2, '2025-10-14 06:16:46', '2025-10-14 06:16:46', 3),
(26, 5, 33, 5, 2, '2025-10-14 06:16:46', '2025-10-14 06:16:46', 3),
(27, 9, 34, 12, 2, '2025-10-14 18:33:39', '2025-10-14 18:33:39', 9),
(28, 8, 35, 10, 3, '2025-10-14 19:10:13', '2025-10-14 19:10:13', 7),
(29, 8, 35, 11, 3, '2025-10-14 19:10:14', '2025-10-14 19:10:14', 7),
(30, 8, 36, 10, 1, '2025-10-15 00:40:46', '2025-10-15 00:40:46', 7),
(31, 8, 36, 11, 1, '2025-10-15 00:40:46', '2025-10-15 00:40:46', 7),
(32, 8, 37, 10, 3, '2025-10-15 00:51:14', '2025-10-15 00:51:14', 7),
(33, 8, 37, 11, 2, '2025-10-15 00:51:14', '2025-10-15 00:51:14', 7),
(34, 8, 38, 10, 4, '2025-10-15 00:51:33', '2025-10-15 00:51:33', 7),
(35, 8, 38, 11, 2, '2025-10-15 00:51:33', '2025-10-15 00:51:33', 7),
(36, 8, 39, 10, 1, '2025-10-15 00:51:33', '2025-10-15 00:51:33', 7),
(37, 8, 39, 11, 1, '2025-10-15 00:51:33', '2025-10-15 00:51:33', 7),
(38, 8, 40, 10, 4, '2025-10-15 06:21:14', '2025-10-15 06:21:14', 7),
(39, 8, 40, 11, 2, '2025-10-15 06:21:14', '2025-10-15 06:21:14', 7),
(40, 8, 42, 10, 2, '2025-10-19 05:01:02', '2025-10-19 05:01:02', 7),
(41, 8, 42, 11, 2, '2025-10-19 05:01:02', '2025-10-19 05:01:02', 7),
(43, 8, 43, 10, 1, '2025-10-19 05:02:06', '2025-10-19 05:02:06', 7),
(44, 8, 43, 11, 1, '2025-10-19 05:02:06', '2025-10-19 05:02:06', 7),
(46, 8, 48, 10, 4, '2025-10-27 06:48:07', '2025-10-27 06:48:07', 7),
(47, 8, 48, 11, 4, '2025-10-27 06:48:07', '2025-10-27 06:48:07', 7),
(49, 8, 53, 10, 3, '2025-10-27 19:20:03', '2025-10-27 19:20:03', 7),
(50, 8, 53, 11, 3, '2025-10-27 19:20:03', '2025-10-27 19:20:03', 7),
(53, 8, 54, 10, 2, '2025-10-27 19:21:16', '2025-10-27 19:21:16', 7),
(54, 8, 54, 11, 2, '2025-10-27 19:21:16', '2025-10-27 19:21:16', 7),
(65, 8, 74, 10, 4, '2025-11-13 20:25:43', '2025-11-13 20:25:43', 7),
(66, 8, 74, 11, 4, '2025-11-13 20:25:43', '2025-11-13 20:25:43', 7),
(67, 8, 74, 19, 4, '2025-11-13 20:25:43', '2025-11-13 20:25:43', 7),
(69, 22, 75, 30, 1, '2025-11-13 20:30:29', '2025-11-13 20:30:29', 42),
(70, 8, 76, 10, 2, '2025-11-14 06:32:54', '2025-11-14 06:32:54', 7),
(71, 8, 76, 11, 2, '2025-11-14 06:32:54', '2025-11-14 06:32:54', 7),
(73, 8, 78, 10, 1, '2025-11-14 09:32:15', '2025-11-14 09:32:15', 7),
(74, 8, 78, 11, 1, '2025-11-14 09:32:16', '2025-11-14 09:32:16', 7),
(75, 8, 79, 10, 3, '2025-11-14 09:32:36', '2025-11-14 09:32:36', 7),
(76, 8, 79, 11, 3, '2025-11-14 09:32:36', '2025-11-14 09:32:36', 7);

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `navbar_color` varchar(255) DEFAULT NULL,
  `background_color` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `wave_color` varchar(255) DEFAULT '#1E90FF',
  `button_color` varchar(255) DEFAULT '#007BFF'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`id`, `user_id`, `title`, `description`, `logo`, `navbar_color`, `background_color`, `active`, `created_at`, `updated_at`, `wave_color`, `button_color`) VALUES
(3, NULL, 'halo', 'p', NULL, NULL, NULL, 0, '2025-10-12 07:37:46', '2025-11-13 19:31:03', '#1E90FF', '#007BFF'),
(4, 5, 'haloooo', 'ppp', NULL, NULL, NULL, 0, '2025-10-12 07:42:06', '2025-11-13 19:31:03', '#1E90FF', '#007BFF'),
(5, 5, 'survey layanan rent car', 'survey anda membantu kami\r\ndengan\r\nbanyak\r\nhal', NULL, NULL, NULL, 0, '2025-10-12 07:43:42', '2025-11-13 19:31:03', '#1E90FF', '#007BFF'),
(6, 7, 'susu', 'ultra', NULL, NULL, NULL, 0, '2025-10-12 18:30:34', '2025-11-13 19:31:03', '#1E90FF', '#007BFF'),
(7, 7, 'survey layanan rental car', 'Ikuti survey kepuasan masyarakat dan bantu kami menciptakan pelayanan yang lebih baik.\r\nPendapat Anda adalah dorongan terbesar kami untuk terus berbenah!', 'logos/eU3dImJa7sMolJg8qHjXC8uxonBtgPmQcmWpu1Yv.png', NULL, NULL, 0, '2025-10-12 21:52:27', '2025-11-13 19:31:03', '#1e90ff', '#007bff'),
(8, 8, 'Survey Layanan Kepuasan Pelanggan', 'Setiap penilaian Anda membantu kami memberikan layanan yang lebih baik. Luangkan waktu sebentar untuk mengisi survei ini — suara Anda sangat berarti!', '6913f4b5c8b94.png', '#ffffff', '#eeee68', 0, '2025-10-12 22:11:47', '2025-11-25 20:01:19', '#1a8453', '#00bfff'),
(11, 9, 'SMKN1DPS', 'sekolah', 'logos/Y6ZDfct8HWsDANkRBu0QPfRHwgOdXZYg8VbC8lO6.png', '#ffff00', '#732121', 0, '2025-10-14 18:05:42', '2025-11-13 19:31:03', '#695316', '#ffffff'),
(12, 9, 'BALI SOLUTIONS BIZ', 'Web', 'logos/Cp2hTmHnnrYIwD284KiuSQTyQUH5Pna12ZAzG39J.jpg', '#ffffff', '#ffffff', 0, '2025-10-14 20:07:56', '2025-11-13 19:31:03', '#ff00ff', '#0000ff'),
(16, 8, 'SMKN 1 DENPASAR', 'p', '691754768f3a5.jpg', '#fecb3e', '#f1d6ff', 0, '2025-10-15 19:48:20', '2025-11-25 20:01:19', '#b92d5d', '#8d8602'),
(18, 12, 'vio', 'ni wqayan trisna vioni', 'logos/yYb4jCF1Oh9hCUaYCUVh6uQ7bFwTODmaqOP3NUbe.png', '#c43636', '#ffffff', 0, '2025-10-25 21:19:19', '2025-11-13 19:31:03', '#165798', '#6c8bac'),
(29, 20, 'sayang', 'everrrrrrrrrrrrrrrrrrrr', '69155479801b7.jpg', '#ffffff', '#ffffff', 0, '2025-11-12 19:46:01', '2025-11-13 19:31:03', '#0099ff', '#0099ff'),
(40, 8, 'htrhht', 'grrgtg', '691576cfe52b3.png', '#ffffff', '#ffffff', 0, '2025-11-12 22:12:31', '2025-11-25 20:01:19', '#0099ff', '#0099ff'),
(41, 8, 'dfbfbfb', 'trgbtrhtrhr', '6917553c4e611.png', '#ffffff', '#ffffff', 0, '2025-11-12 22:14:24', '2025-11-25 20:01:19', '#0099ff', '#0099ff'),
(48, 22, 'survey kepuasan wibu', 'wibu anjay', '6916afe164568.jpg', '#ffffff', '#ffffff', 1, '2025-11-13 20:28:17', '2025-11-13 20:29:23', '#0099ff', '#0099ff'),
(49, 24, 'dfvdfvd', 'fvdfvdv', '691753d13f36d.jpg', '#ffffff', '#ffffff', 1, '2025-11-14 09:06:41', '2025-11-14 09:07:45', '#0099ff', '#0099ff'),
(50, 8, 'fvdvdf', 'fvdf', '692523b78e5e9.png', '#ffffff', '#ffffff', 0, '2025-11-14 09:16:09', '2025-11-25 20:01:19', '#0099ff', '#0099ff'),
(51, 8, 'trtrg', 'anjay anajay ankagusiucs dshcbdsbcds saxbsacbsa hxbxjshbx hsxbshxvbs svxusdvcsd  dschsbas jbcdjhcbf hjfbvuhdfbvfdu dbdfhvbdufvh dhbfviudbx klznsdoicdnsvd  dsjcbdkjvbdkjxv dggbfgbtf fdgbgbdgd sdeefvsdegbtfh  dsxgvsdxrgrd', '692523e68902e.jpeg', '#ffffff', '#ffffff', 0, '2025-11-24 20:35:03', '2025-11-25 20:01:19', '#0099ff', '#0099ff'),
(52, 8, 'cuaks', 'dscsdfrs', '69266d79845b8.jpeg', '#ffffff', '#ffffff', 1, '2025-11-25 20:01:13', '2025-11-25 20:01:19', '#0099ff', '#0099ff');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'admin',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `survey_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `slug`, `survey_link`) VALUES
(1, 'trisnavio', 'vionitrisna05@gmail.com', NULL, '$2y$12$ta8ICdwLHY1/nhNSQX.ksuXH.Ci587CPt3q2XBHerWJhxg9wYOzpu', 'admin', NULL, '2025-10-05 07:08:03', '2025-10-05 07:08:03', NULL, NULL),
(2, 'anitapratiwi', 'anitapratiwi13@gmail.com', NULL, '$2y$12$aiaCmP6ssrzYeM57Ko73MOs92X1Hm/vyLfKTytK72VAMQOvUzbSke', 'admin', NULL, '2025-10-11 19:30:13', '2025-10-11 19:30:13', 'anitapratiwi-sqnpw', NULL),
(3, 'nopiani', 'nopianiwayan09@gmail.com', NULL, '$2y$12$Gi/xGAUUVutgedgLF2mgMuWL0xon78NiW02n1zObDmH/QvCRbhZF.', 'admin', NULL, '2025-10-11 20:24:21', '2025-10-11 20:24:21', 'nopiani-clx0x', NULL),
(4, 'kinara', 'kinaramaharani11@gmail.com', NULL, '$2y$12$PJQOqmp9SixIlw04PD2MtOWOJiEz.DFvqbeBh73gEjMTg9tZqboSG', 'admin', NULL, '2025-10-11 21:00:52', '2025-10-11 21:00:52', 'kinara-asl7x', NULL),
(5, 'jawir', 'jawirvio90@gmail.com', NULL, '$2y$12$Gy/v6eatEbv/BCBzhkCYguWtwf7G4haBnAmFAUyjqY/O75eOBtN0O', 'admin', NULL, '2025-10-12 05:21:53', '2025-10-12 05:21:53', 'jawir-m2fd7', NULL),
(6, 'tayo', 'heytayoo200@gmail.com', NULL, '$2y$12$Mf4tj7kY9uXK9ONqGBQAeu1qIWh.PcWov4k3TqNdxyb4QV5gU72TC', 'admin', NULL, '2025-10-12 07:58:19', '2025-10-12 07:58:19', 'tayo-w1cwk', NULL),
(7, 'pakdewa', 'pakdewa08@gmail.com', NULL, '$2y$12$oFKqe.ZeFW5HRsmRiccn7OO45WG6pTgjhj4im4IBcTAnHdKehyWQ.', 'admin', NULL, '2025-10-12 17:56:42', '2025-10-12 17:56:42', 'pakdewa-sxxyd', NULL),
(8, 'Bali Solution Biz', 'dayugita10@gmail.com', NULL, '$2y$12$1a2T8Uoavj3D9401600a4eOKD0b.zMhq8.vmkVQ6xZwfnbnAVhceq', 'admin', NULL, '2025-10-12 22:08:50', '2025-10-12 22:08:50', 'dayugita-9ky5b', NULL),
(9, 'Dayu Githa', 'githa@gmail.com', NULL, '$2y$12$rM6hBujCHJdjTvKvEzX4du8L44l5FVr8m548oO4aGiAOwFzTIX2.2', 'admin', NULL, '2025-10-14 18:02:29', '2025-10-14 18:02:29', 'dayu-githa-eakts', NULL),
(10, 'vio', 'vio08@gmail.com', NULL, 'vioni2008', 'admin', NULL, '2025-10-15 04:03:22', '2025-10-15 04:03:22', 'vio-8vfsm', NULL),
(11, 'anita', 'ppppp@gmail.com', NULL, '$2y$12$uKGWyD3hiWF8ucbOdW9o0uYqok/nSHLa8Qz62357zZoHSYbg9fCza', 'admin', NULL, '2025-10-19 05:03:12', '2025-10-19 05:03:12', 'anita-xy3cb', NULL),
(12, 'kevin guna', 'kevinguna17@gmail.com', NULL, '$2y$12$mMkfLZ7qhXiYgNXyOGQyvuGCXe/j1cep0IyAp8Qj0rOt9CoZNx6U.', 'admin', NULL, '2025-10-25 21:05:49', '2025-10-25 21:05:49', 'kevin-guna-moxtg', NULL),
(14, 'anjay', 'vionitrisna15@gmail.com', NULL, '$2y$12$YrYLQu.FgNHgXiYgGb29MusqNmbfd7Rtj9z7OLt8LxZh.RwR2YvKa', 'user', NULL, '2025-11-10 06:30:36', '2025-11-10 06:30:36', 'anjay-kqffv', NULL),
(15, 'viori', 'vioricantik12@gmail.com', NULL, '$2y$12$2frcA0OaOrWpSjMKfi8mOOvkvgMPGmab0uFl95o1ZKmGcT9AHFmBu', 'user', NULL, '2025-11-11 20:21:52', '2025-11-11 20:21:52', 'viori-e3p6y', NULL),
(16, 'viori', 'vioricantik13@gmail.com', NULL, '$2y$12$Pbg9sKNMVeZbGo4HMwnob.er0j6uuRfE/FhRMhHJwGbieEgolOVmO', 'user', NULL, '2025-11-11 20:33:27', '2025-11-11 20:33:27', 'viori-mubno', NULL),
(17, 'viori', 'vioricantik15@gmail.com', NULL, '$2y$12$/nj4Z2X4387/ssk.YgcuheZqp4EJTvaBfwBwV912KnWytNTB4WEjK', 'user', NULL, '2025-11-11 21:43:35', '2025-11-11 21:43:35', 'viori-ulqff', NULL),
(18, 'vioni trisna', 'trisnavio08@gmail.com', NULL, '$2y$12$hNkNWIkDd5qkKuExxMu99.8AbF8rLcL2657P2o9pNW/R4ZIGpP4N2', 'user', NULL, '2025-11-11 21:45:09', '2025-11-11 21:45:09', 'vioni-trisna-to7db', NULL),
(19, 'smkn 1 denpasar', 'vionicantik123@gmail.com', NULL, '$2y$12$lYMIcqSsRRo80ps/nD8tU.dackfM6lW0HSUiYwebO/7B9VEbZBZiy', 'admin\r\n', NULL, '2025-11-11 21:50:33', '2025-11-11 21:50:33', 'smkn-1-denpasar-gygik', NULL),
(20, 'vioni trisna', 'cantikvio09@gmail.com', NULL, '$2y$12$yubBhw0KfGN4tsGIJhMgFeeoFaQuR/N9Qqnb5goRb0l6QxySRcsZK', 'admin', NULL, '2025-11-11 22:25:20', '2025-11-11 22:25:20', 'vioni-trisna-rlhps', NULL),
(21, 'mantako', 'mantako123@gmail.com', NULL, '$2y$12$7nEdfZ2CuEfl/VZ6bMnKUeLOYapTlo.67/lbgUr3Ay1G6UVfjfK5q', 'admin', NULL, '2025-11-12 23:28:07', '2025-11-12 23:28:07', 'mantako-5p8ry', NULL),
(22, 'marsya putri', 'marsyaputri11@gmail.com', NULL, '$2y$12$9AbcKezw.ZPgPVskWG4hwuS3GOPnTXJHIiVYkD.poMAyX2IqHlYVK', 'admin', NULL, '2025-11-13 20:27:05', '2025-11-13 20:27:05', 'marsya-putri-st9xs', NULL),
(23, 's', 'sayang123@gmail.com', NULL, '$2y$12$WjF0C88tBX73Cr.jdqxy/.wunGry/H3UUUsFUK7K5yatShHib2lEe', 'admin', NULL, '2025-11-14 00:12:43', '2025-11-14 00:12:43', 's-t0jzj', NULL),
(24, 'munica', 'munica123@gmail.com', NULL, '$2y$12$WLw7yEtPWSQER09Q5mtL5.SZ9s5K46miH3oqNL.K8kwd3SGIk4r4C', 'admin', NULL, '2025-11-14 09:06:08', '2025-11-14 09:06:08', 'munica-yblgk', NULL),
(25, 'bulan', 'denpasarbali@gmail.com', NULL, '$2y$12$cP6vPBnBnpNjZYDNCRoFHe.fcombDcUiNHBIH5TpULcyqxOs0bp12', 'admin', NULL, '2025-11-14 09:34:51', '2025-11-14 09:34:51', 'bulan-lo2jp', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_user_id_name_unique` (`user_id`,`name`);

--
-- Indexes for table `data_diris`
--
ALTER TABLE `data_diris`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_diris_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_category_id_foreign` (`category_id`),
  ADD KEY `questions_user_id_foreign` (`user_id`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `responses_data_diri_id_question_id_unique` (`data_diri_id`,`question_id`),
  ADD KEY `responses_question_id_foreign` (`question_id`),
  ADD KEY `responses_category_id_foreign` (`category_id`),
  ADD KEY `responses_user_id_foreign` (`user_id`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surveys_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_slug_unique` (`slug`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `data_diris`
--
ALTER TABLE `data_diris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `data_diris`
--
ALTER TABLE `data_diris`
  ADD CONSTRAINT `data_diris_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `questions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `responses`
--
ALTER TABLE `responses`
  ADD CONSTRAINT `responses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `responses_data_diri_id_foreign` FOREIGN KEY (`data_diri_id`) REFERENCES `data_diris` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `responses_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `responses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `surveys`
--
ALTER TABLE `surveys`
  ADD CONSTRAINT `surveys_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

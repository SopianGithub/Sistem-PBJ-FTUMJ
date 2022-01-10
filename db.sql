-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 10, 2022 at 01:52 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `lelang_umj`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar_barangs`
--

CREATE TABLE `daftar_barangs` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daftar_barangs`
--

INSERT INTO `daftar_barangs` (`id`, `nama_barang`, `jumlah`, `unit`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Lincoln Lind MD', 9, 'Mr. Jermey Kris PhD', '1', '2022-01-02 19:41:35', '2022-01-02 19:41:35'),
(2, 'Murray Volkman', 4, 'Ramona Flatley', '1', '2022-01-02 19:41:35', '2022-01-02 19:41:35'),
(3, 'Ms. Arianna Murazik', 0, 'Jack Bogan II', '1', '2022-01-02 19:41:35', '2022-01-02 19:41:35'),
(4, 'Ethyl Runolfsson PhD', 6, 'Prof. Marlee Kerluke', '1', '2022-01-02 19:41:35', '2022-01-02 19:41:35'),
(5, 'Alice McCullough DVM', 4, 'Jude Brekke', '1', '2022-01-02 19:41:35', '2022-01-02 19:41:35'),
(6, 'Adrianna Simonis II', 1, 'Shannon Nikolaus DVM', '1', '2022-01-02 19:41:35', '2022-01-02 19:41:35'),
(7, 'Mr. Diamond McClure I', 1, 'Prof. Allen Fisher PhD', '1', '2022-01-02 19:41:35', '2022-01-02 19:41:35'),
(8, 'Mr. Alexys Heller', 5, 'Destany Kris', '1', '2022-01-02 19:41:35', '2022-01-02 19:41:35'),
(9, 'Miss Kenyatta Ledner', 1, 'Kiara Sporer', '1', '2022-01-02 19:41:35', '2022-01-02 19:41:35'),
(10, 'Deshaun Barton', 9, 'Dr. Chauncey Tromp', '1', '2022-01-02 19:41:35', '2022-01-02 19:41:35'),
(11, 'Prof. Kellen Stanton', 7, 'Hailey Beier', '1', '2022-01-02 19:41:35', '2022-01-02 19:41:35'),
(12, 'Macey Hermiston', 8, 'Vida Denesik', '1', '2022-01-02 19:41:35', '2022-01-02 19:41:35'),
(13, 'Prof. Janice Stark MD', 7, 'Dr. Reese Marks Jr.', '1', '2022-01-02 19:41:35', '2022-01-02 19:41:35'),
(14, 'Kay Hill DVM', 4, 'Darron Nienow', '1', '2022-01-02 19:41:35', '2022-01-02 19:41:35'),
(15, 'Carson Daugherty', 8, 'Vincent Kling', '1', '2022-01-02 19:41:35', '2022-01-02 19:41:35'),
(16, 'Concepcion Bergnaum', 9, 'Winston Lind', '1', '2022-01-02 19:41:35', '2022-01-02 19:41:35'),
(17, 'Andre McClure', 9, 'Ellsworth Sauer', '1', '2022-01-02 19:41:35', '2022-01-02 19:41:35'),
(18, 'Mrs. Bridgette Dibbert', 0, 'Jadon Mayer', '1', '2022-01-02 19:41:35', '2022-01-02 19:41:35'),
(19, 'Vivianne Heathcote', 3, 'Keagan Abernathy', '1', '2022-01-02 19:41:35', '2022-01-02 19:41:35'),
(20, 'Augusta Bahringer', 0, 'Gladyce Erdman', '1', '2022-01-02 19:41:35', '2022-01-02 19:41:35');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `histories`
--

CREATE TABLE `histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` tinyint(4) NOT NULL,
  `id_pengajuan` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `histories`
--

INSERT INTO `histories` (`id`, `jenis_action`, `status`, `id_user`, `id_pengajuan`, `created_at`, `updated_at`) VALUES
(1, 'Approval Permohonan', 'Diproses', 5, 2, '2022-01-05 20:32:59', '2022-01-05 20:32:59'),
(2, 'Approval Permohonan', 'Diproses', 5, 2, '2022-01-05 20:56:47', '2022-01-05 20:56:47'),
(3, 'Approval Permohonan', 'Diproses', 5, 2, '2022-01-05 20:57:11', '2022-01-05 20:57:11'),
(4, 'Approval Permohonan', 'Diproses', 5, 2, '2022-01-05 20:57:50', '2022-01-05 20:57:50'),
(5, 'Approval Permohonan', 'Diproses', 5, 2, '2022-01-05 20:58:41', '2022-01-05 20:58:41'),
(6, 'Approval Permohonan', 'Diproses', 5, 2, '2022-01-07 08:00:58', '2022-01-07 08:00:58'),
(7, 'Approval Persetujuan', 'Diproses', 5, 1, '2022-01-07 08:49:47', '2022-01-07 08:49:47'),
(8, 'Approval Persetujuan', 'Ditolak', 5, 1, '2022-01-07 08:51:17', '2022-01-07 08:51:17'),
(9, 'Approval Persetujuan', 'Diproses', 5, 1, '2022-01-07 08:51:41', '2022-01-07 08:51:41'),
(10, 'Approval Penawaran', 'Sesuai', 3, 1, '2022-01-07 19:48:52', '2022-01-07 19:48:52'),
(11, 'Approval Permohonan', 'Diproses', 3, 2, '2022-01-07 20:01:17', '2022-01-07 20:01:17'),
(12, 'Approval Permohonan', 'Diproses', 3, 2, '2022-01-07 20:01:58', '2022-01-07 20:01:58'),
(13, 'Approval Permohonan', 'Sesuai', 3, 2, '2022-01-07 20:02:19', '2022-01-07 20:02:19'),
(14, 'Approval Permohonan', 'Sesuai', 3, 2, '2022-01-07 20:03:07', '2022-01-07 20:03:07');

-- --------------------------------------------------------

--
-- Table structure for table `MIGRATIONS`
--

CREATE TABLE `MIGRATIONS` (
  `id` int(10) UNSIGNED DEFAULT NULL,
  `migration` varchar(255) DEFAULT NULL,
  `batch` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `MIGRATIONS`
--

INSERT INTO `MIGRATIONS` (`id`, `migration`, `batch`) VALUES
(NULL, '2014_10_12_000000_create_users_table', 1),
(NULL, '2014_10_12_100000_create_password_resets_table', 1),
(NULL, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(NULL, '2019_08_19_000000_create_failed_jobs_table', 1),
(NULL, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(NULL, '2021_12_25_030129_create_sessions_table', 1),
(NULL, '2021_12_31_015058_create_daftar_barangs_table', 2),
(NULL, '2021_12_31_094401_create_suppliers_table', 3),
(NULL, '2022_01_04_031242_create_pengusuls_table', 4),
(NULL, '2022_01_06_030323_create_histories_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengusuls`
--

CREATE TABLE `pengusuls` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` tinyint(4) NOT NULL,
  `nama_pengusul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_identitas` bigint(20) NOT NULL,
  `status_pengusul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surat_penawaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_validator` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'Diproses',
  `status_pbj` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'Diproses',
  `jenis_usulan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'LELANG',
  `status_app_validator` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'Diproses'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengusuls`
--

INSERT INTO `pengusuls` (`id`, `id_user`, `nama_pengusul`, `no_identitas`, `status_pengusul`, `no_hp`, `email`, `keterangan`, `surat_penawaran`, `created_at`, `updated_at`, `status_validator`, `status_pbj`, `jenis_usulan`, `status_app_validator`) VALUES
(1, 2, 'Pengusul User', 123445, 'Laboran', '0912312141', 'test@gmail.com', 'test lelang', '', '2022-01-04 06:03:57', '2022-01-04 06:03:57', 'Diproses', 'Diproses', 'LELANG', 'Diproses'),
(2, 4, 'Pengusul User', 1234455, 'Kaprodi', '3123123131', 'test@gmail.com', 'test langsung', 'dokumen_pegusul/langsung//HbAXPk04T3OlR6KMt3FseWqvioJOiZSLhsW1dkHQ.pdf', '2022-01-04 06:18:50', '2022-01-04 06:18:50', 'Diproses', 'Sesuai', 'LANGSUNG', 'Diproses'),
(4, 4, 'Pengusul User', 1234567111, 'Kaprodi', '2424234', 'test@gmail.com', 'test Langsung', 'dokumen_pegusul/langsung//jRteFqJzmH7BaHkpyw1lri62j57msj1RXH9RNjMi.pdf', '2022-01-04 23:42:18', '2022-01-04 23:42:18', 'Diproses', 'Diproses', 'LANGSUNG', 'Diproses');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ilWvU6DPuphU4Dkv7BQFgOYku9OvLr893KoWOMYa', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiMkVtMVZtU0IxS1RrZjRUY1E0eGhQcjRqcUQwYWZwUFVnbjhpNks1diI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1641734743),
('LTjxxR7F2toYi0GO154waif3wZb4POeMILiuCNbn', 2, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibm1BcE5LdzdLbm9hRmtFejBCa2VHZ0Zrazg5Nm5zVGhDUjg1dnUyeCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9BZG1pbi9wZW5hd2FyYW4iO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkMnp6WFEuSUtjRGk0cnUuSDVuOEpnZVdDaVFteG1pS3pxMUxaajdKLjVTNGJwQkJLS1lVMmEiO30=', 1641711481),
('zMQvCMjebprRQckuahMs4s1xfhuqdSeyoDf95mrP', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZkZRR0FIRXd2QXh4ZG9BM1FZTzM2UExyOU1iVUM5TmwyZm8weTBkcSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL0FkbWluL3BlbmF3YXJhbiI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvc3VwcGxpZXIiO319', 1641725270);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `nama_badan_usaha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_badan_usaha` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_web` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surat_penawaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT '0',
  `status_pbj` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'Diproses'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `nama_badan_usaha`, `alamat_badan_usaha`, `nomor_hp`, `email`, `alamat_web`, `surat_penawaran`, `created_at`, `updated_at`, `is_verified`, `status_pbj`) VALUES
(1, 'Antonina Crookss', '5692 Maggio Forest Apt. 227\r\nZiemeside, HI 58983', '2010-03-16', 'Mr. Benedict Buckridge', '9570 Malachi Ramp Suite 121\r\nMetzshire, UT 46903-2360', '1-520-240-4847', 'xdurgan@yahoo.com', 'http://hills.net', 'dokumen_suppliers/avoJQIdnwdbMgnXN1F97q443k5SNUE3Vk8WvuiLf.pdf', '2021-12-31 18:59:46', '2021-12-31 18:59:46', 0, 'Sesuai'),
(2, 'Prof. Roscoe Trantow III', '5060 Grant Club\nKihnport, GA 61358-7699', '1986-11-19', 'Tod Leffler I', '722 Frami Isle\nHegmannside, OK 85432-7587', '704.999.0780', 'deja.reinger@smith.info', 'hoeger.com', 'test.pdf', '2021-12-31 18:59:46', '2021-12-31 18:59:46', 0, 'Diproses'),
(3, 'Javonte Bernhard', '40562 Ismael Course Apt. 764\nDelmerchester, SC 73853-8319', '2020-05-23', 'Jarred Armstrong', '909 Krajcik Courts Suite 931\nPort Muhammad, DC 65907-0567', '662-586-6606', 'mackenzie14@mayer.net', 'kub.com', 'test.pdf', '2021-12-31 18:59:46', '2021-12-31 18:59:46', 0, 'Diproses'),
(4, 'Jermain Kris', '84742 Emard Ramp Apt. 652\nEast Telly, NH 28373-9271', '2002-01-09', 'Kadin Kihn', '21893 Feeney Forge\nEast Margot, WV 92225-0695', '+1-463-833-6295', 'wrath@yahoo.com', 'cummerata.net', 'test.pdf', '2021-12-31 18:59:46', '2021-12-31 18:59:46', 0, 'Diproses'),
(5, 'Juvenal Gutkowski', '861 Robel Hollow\nVonRuedenburgh, CT 90449', '1996-06-30', 'Roslyn Grady', '359 Zulauf Wall Apt. 237\nNicolasview, IN 91682-3102', '+1-302-662-4900', 'hhettinger@altenwerth.com', 'armstrong.org', 'test.pdf', '2021-12-31 18:59:46', '2021-12-31 18:59:46', 0, 'Diproses'),
(6, 'Ms. Gabrielle McClure', '14439 Johnpaul Ford Apt. 759\nPort Wellingtonburgh, WV 21381', '1977-01-22', 'Dolores Mohr', '83312 Xander Glen Suite 499\nAufderharhaven, SD 30996', '657.944.6757', 'bessie49@gmail.com', 'pouros.com', 'test.pdf', '2021-12-31 18:59:46', '2021-12-31 18:59:46', 0, 'Diproses'),
(7, 'Dejon McClure', '309 Batz Land Suite 037\nWest Evalynton, OR 60384-0569', '1974-11-13', 'Elmo Leannon', '22558 Collin Light\nRobelville, ND 21455', '+1-682-587-2869', 'jamel.stamm@waelchi.com', 'sauer.net', 'test.pdf', '2021-12-31 18:59:46', '2021-12-31 18:59:46', 0, 'Diproses'),
(8, 'Mercedes Casper', '2532 Queen Trafficway\nFraneckimouth, KS 95828-7563', '1977-01-06', 'Norma Parisian Sr.', '37627 Erick Court Suite 994\nWest Rodmouth, NJ 27915', '415-629-5327', 'qbayer@cruickshank.info', 'kling.biz', 'test.pdf', '2021-12-31 18:59:46', '2021-12-31 18:59:46', 0, 'Diproses'),
(9, 'Sterling Rempel', '25544 Orlo Shoals Suite 665\nWest Mohammad, AR 58799', '2007-05-15', 'Miguel Quigley', '3639 Buford Street\nMooreburgh, UT 14032', '+13042565389', 'kacey22@gmail.com', 'watsica.net', 'test.pdf', '2021-12-31 18:59:46', '2021-12-31 18:59:46', 0, 'Diproses'),
(10, 'Jonathan Kerluke', '45006 Rippin Springs\nAbernathyborough, MN 05261-5518', '1970-08-31', 'Melyssa Kub', '7712 Ernest Vista\nPort Lacey, AL 47385', '+1 (725) 413-7021', 'kelsie38@gmail.com', 'considine.net', 'test.pdf', '2021-12-31 18:59:46', '2021-12-31 18:59:46', 0, 'Diproses'),
(11, 'Guido Pfeffer', '629 Larkin Orchard\nDelphiabury, AK 76089-1298', '2001-09-24', 'Dameon McClure IV', '22313 Bobby Turnpike\nNew Freda, OR 99312-5943', '(339) 544-7820', 'adelle19@yahoo.com', 'dubuque.com', 'test.pdf', '2021-12-31 18:59:46', '2021-12-31 18:59:46', 0, 'Diproses'),
(12, 'Rico Kub III', '725 Andreane Track\nSkileschester, NH 07873-3559', '1976-11-20', 'Myah Beatty', '338 Hermann Summit Suite 011\nAlvinachester, LA 53770', '(480) 261-5741', 'anjali75@kovacek.com', 'rice.com', 'test.pdf', '2021-12-31 18:59:46', '2021-12-31 18:59:46', 0, 'Diproses'),
(13, 'Brendan Corwin', '35180 Francisca Vista Suite 078\nCarterton, WA 78465-1299', '2011-09-07', 'Miss Dawn Bernhard', '92866 Clare Crossing Apt. 382\nLake Reyes, DC 36251', '+1-347-229-5213', 'carlie45@gerhold.net', 'wiegand.info', 'test.pdf', '2021-12-31 18:59:46', '2021-12-31 18:59:46', 0, 'Diproses'),
(14, 'Domingo Padberg', '5716 Rau Neck Suite 219\nSouth Sandrabury, RI 06511', '2017-03-21', 'Tyrell Harvey', '137 Davis Spurs Suite 951\nSouth Morgan, WV 91127', '+14794434873', 'hklocko@zulauf.com', 'waelchi.biz', 'test.pdf', '2021-12-31 18:59:46', '2021-12-31 18:59:46', 0, 'Diproses'),
(15, 'Halle Wilderman', '9746 Langosh Estates Apt. 244\nAniyahville, NE 69200-8362', '2015-02-11', 'Liam Nienow MD', '83722 Littel Falls\nLake Daphneyhaven, VA 98547', '(912) 882-0686', 'lessie42@yahoo.com', 'hahn.net', 'test.pdf', '2021-12-31 18:59:46', '2021-12-31 18:59:46', 0, 'Diproses'),
(16, 'Kamren Brekke III', '86979 Antonetta Keys Apt. 458\nLake Chaim, IA 23387-6973', '1987-02-10', 'Mrs. Bulah Carroll DDS', '432 Moriah Road\nEast Adonisfurt, MI 99169', '+1-857-655-5187', 'mcglynn.jarrod@gmail.com', 'barrows.com', 'test.pdf', '2021-12-31 18:59:46', '2021-12-31 18:59:46', 0, 'Diproses'),
(17, 'Ariane Bernhard', '56434 Hugh Street\nEast Maciville, MO 57793', '1989-12-15', 'Elyse Herman', '4083 Aryanna Points\nWuckertbury, VT 79088-0680', '(534) 816-3903', 'hermann.padberg@hotmail.com', 'christiansen.com', 'test.pdf', '2021-12-31 18:59:46', '2021-12-31 18:59:46', 0, 'Diproses'),
(18, 'Nola Kreiger', '762 Lueilwitz Center\nWest Garth, PA 74196', '1981-06-06', 'Dr. Lorenz Fadel PhD', '140 Jeremy Lodge\nEmilyview, OR 53369', '781.648.7604', 'lulu27@yahoo.com', 'kuhlman.biz', 'test.pdf', '2021-12-31 18:59:46', '2021-12-31 18:59:46', 0, 'Diproses'),
(19, 'Alaina Abbott', '7048 Rodriguez Court\nNew Mafaldaville, TN 70827', '1988-03-02', 'Elza Stoltenberg', '9588 Bode Falls Suite 295\nHowelltown, CT 16546', '+1-510-376-0836', 'constance.beier@turcotte.info', 'armstrong.info', 'test.pdf', '2021-12-31 18:59:46', '2021-12-31 18:59:46', 0, 'Diproses'),
(20, 'Morgan Greenholt', '549 Altenwerth Radial\nWest Rosaliaberg, NJ 08161-4080', '2005-05-13', 'Cristobal Ferry', '304 Rosenbaum Route Apt. 494\nLake Winifred, IA 26801-2166', '+1-743-623-1524', 'stefanie.davis@goldner.com', 'rice.com', 'test.pdf', '2021-12-31 18:59:46', '2021-12-31 18:59:46', 0, 'Diproses');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipe_user` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `tipe_user`) VALUES
(2, 'Yayan Sopian', 'ramzyraseha@gmail.com', NULL, '$2y$10$2zzXQ.IKcDi4ru.H5n8JgeWCiQmxmiKzq1LZj7J.5S4bpBBKKYU2a', NULL, NULL, NULL, NULL, NULL, '2022-01-02 21:27:33', '2022-01-02 21:27:33', 'Admin'),
(3, 'PBJ User', 'pbjusers@user.com', NULL, '$2y$10$lqMBoDzIrkwDIq2xRkpmnuOAiFgqBZAfHhZosE0ZdDC..4RHhYyG2', NULL, NULL, NULL, NULL, NULL, '2022-01-02 21:29:28', '2022-01-02 21:29:28', 'PBJ'),
(4, 'Pengusul User', 'pengusul@user.com', NULL, '$2y$10$pjzxMBSjjVbUl245t032oeplZIxoMD5xV0Yk1EoIgTN.GYXjmVqlG', NULL, NULL, NULL, NULL, NULL, '2022-01-02 21:30:07', '2022-01-05 00:27:45', 'Pengusul'),
(5, 'Validator User', 'validator@user.com', NULL, '$2y$10$nS0.XR2ZzglgticUi.8c9O1RUKOlvahBe/CIth0LTIwp0Io.w4kpy', NULL, NULL, NULL, NULL, NULL, '2022-01-02 21:30:42', '2022-01-02 21:30:42', 'Validator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_barangs`
--
ALTER TABLE `daftar_barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pengusuls`
--
ALTER TABLE `pengusuls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_barangs`
--
ALTER TABLE `daftar_barangs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `histories`
--
ALTER TABLE `histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pengusuls`
--
ALTER TABLE `pengusuls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

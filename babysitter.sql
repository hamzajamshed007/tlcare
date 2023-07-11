-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 11, 2023 at 04:04 PM
-- Server version: 10.5.21-MariaDB
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `babysitter`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `baby_sitter_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `assign` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `baby_sitter_id`, `user_id`, `service_id`, `message`, `status`, `assign`, `created_at`, `updated_at`) VALUES
(35, 100, 99, 41, 'hjcghcvghj', 'is_assigned', 'is_assigned', '2023-06-21 01:01:51', '2023-06-21 01:35:07'),
(38, 100, 101, 44, 'fun ghj', 'not_assigned', 'not_assigned', '2023-06-21 03:25:43', '2023-06-21 05:24:25'),
(39, 106, 103, 45, 'submitted', 'is_assigned', 'is_assigned', '2023-06-21 04:13:44', '2023-06-21 04:14:04'),
(40, 105, 101, 46, 'hijyh', 'is_assigned', 'is_assigned', '2023-06-21 05:24:01', '2023-06-21 05:24:17'),
(41, 105, 101, 47, 'vsbs', 'is_assigned', 'is_assigned', '2023-07-11 21:35:54', '2023-07-11 21:41:14');

-- --------------------------------------------------------

--
-- Table structure for table `baby_sitter_certificate`
--

CREATE TABLE `baby_sitter_certificate` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `baby_sitter_id` varchar(255) NOT NULL,
  `certificates` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `baby_sitter_certificate`
--

INSERT INTO `baby_sitter_certificate` (`id`, `baby_sitter_id`, `certificates`, `created_at`, `updated_at`) VALUES
(221, '100', 'certification/402868.jpg', '2023-06-21 00:59:13', '2023-06-21 00:59:13'),
(223, '106', 'certification/356571.jpg', '2023-06-21 04:04:43', '2023-06-21 04:04:43'),
(224, '105', 'certification/659040.jpg', '2023-06-21 05:23:33', '2023-06-21 05:23:33');

-- --------------------------------------------------------

--
-- Table structure for table `baby_sitter_detail`
--

CREATE TABLE `baby_sitter_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `baby_sitter_id` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  `hourly_rate` varchar(255) DEFAULT NULL,
  `experience` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `baby_sitter_detail`
--

INSERT INTO `baby_sitter_detail` (`id`, `baby_sitter_id`, `first_name`, `last_name`, `age`, `lat`, `long`, `hourly_rate`, `experience`, `description`, `created_at`, `updated_at`) VALUES
(40, '100', 'baby', 'sit', '22', '37.785834', '-122.406417', '12', '05', 'ssssss', '2023-06-21 00:59:14', '2023-06-21 00:59:14'),
(42, '106', 'Testing', 'User', '30', '24.862368201244184', '67.07143986411727', '20', '4 years', 'Testing Description', '2023-06-21 04:04:44', '2023-06-21 04:04:44'),
(43, '105', 'Brandon', 'Taylor', '45', '24.862368201244184', '67.07143986411727', '16', '5 years', 'next', '2023-06-21 05:23:34', '2023-06-21 05:23:34');

-- --------------------------------------------------------

--
-- Table structure for table `childrens`
--

CREATE TABLE `childrens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `child_name` varchar(255) NOT NULL,
  `child_age` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `childrens`
--

INSERT INTO `childrens` (`id`, `service_id`, `user_id`, `child_name`, `child_age`, `created_at`, `updated_at`) VALUES
(76, 41, 99, 'c1', '5', '2023-06-21 00:57:59', '2023-06-21 00:57:59'),
(77, 41, 99, 'c2', '8', '2023-06-21 00:57:59', '2023-06-21 00:57:59'),
(78, 42, 101, 'John', '2', '2023-06-21 02:43:49', '2023-06-21 02:43:49'),
(79, 42, 101, 'Alex', '3', '2023-06-21 02:43:49', '2023-06-21 02:43:49'),
(80, 43, 101, 'john Cena', '1', '2023-06-21 02:54:23', '2023-06-21 02:54:23'),
(81, 44, 101, 'Joe', '4', '2023-06-21 03:13:58', '2023-06-21 03:13:58'),
(82, 44, 101, 'Root', '2', '2023-06-21 03:13:58', '2023-06-21 03:13:58'),
(83, 45, 103, 'Childs', '2', '2023-06-21 04:07:07', '2023-06-21 04:07:07'),
(84, 46, 101, 'Taylor', '5', '2023-06-21 05:21:04', '2023-06-21 05:21:04'),
(85, 47, 101, 'jfhc', '4', '2023-06-21 05:26:15', '2023-06-21 05:26:15'),
(86, 48, 107, 'test', '1', '2023-07-11 21:46:43', '2023-07-11 21:46:43');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_26_203734_create_user_detail_table', 1),
(6, '2023_05_26_203749_create_baby_sitter_detail_table', 1),
(7, '2023_05_26_204609_create_baby_sitter_certificate_table', 1),
(8, '2023_05_26_205534_edit_user_table', 2),
(9, '2023_05_27_003455_edit_user_second_time_table', 3),
(10, '2023_05_30_212731_create_services_table', 4),
(11, '2023_05_30_212758_create_time_schedule_table', 4),
(12, '2023_05_30_213835_create_childrens_table', 4),
(13, '2023_05_30_232135_add_column_in_service_table', 5),
(14, '2023_05_30_232346_add_column_in_children_table', 5),
(15, '2023_05_31_015138_create_applicants_table', 6),
(16, '2023_05_31_020757_add_column_in_services_second_time_table', 7),
(17, '2023_05_31_063157_add_column_in_applicants', 8),
(19, '2023_05_31_090939_add_column_in_applicants_second', 9),
(20, '2023_06_07_113528_update_user_detail_or_baby_sitter_detail_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `user_id`, `service_name`, `description`, `created_at`, `updated_at`, `status`) VALUES
(41, 99, 'service 1', '123 desc', '2023-06-21 00:57:59', '2023-06-21 01:35:07', 'assigned'),
(42, 101, 'Need a Babysitter', 'Dummy Description', '2023-06-21 02:43:49', '2023-06-21 02:50:59', 'assigned'),
(43, 101, 'Demo Service', 'Test', '2023-06-21 02:54:23', '2023-06-21 02:55:57', 'assigned'),
(44, 101, 'Test Service', 'Test Description', '2023-06-21 03:13:58', '2023-06-21 05:24:25', 'not_assigned'),
(45, 103, 'Dummy Service', 'test', '2023-06-21 04:07:07', '2023-06-21 04:14:04', 'assigned'),
(46, 101, 'Dummy Services', 'bnhgg', '2023-06-21 05:21:04', '2023-06-21 05:24:17', 'assigned'),
(47, 101, 'hch', 'jgig', '2023-06-21 05:26:15', '2023-07-11 21:41:14', 'assigned'),
(48, 107, 'Test', 'test', '2023-07-11 21:46:43', '2023-07-11 21:46:43', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `time_schedule`
--

CREATE TABLE `time_schedule` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `schedule` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `time_schedule`
--

INSERT INTO `time_schedule` (`id`, `service_id`, `user_id`, `date`, `start_time`, `end_time`, `schedule`, `created_at`, `updated_at`) VALUES
(168, 41, 99, '6/20/2023', '9 : 30 am', '18 : 30 pm', 'day', '2023-06-21 00:57:59', '2023-06-21 00:57:59'),
(169, 41, 99, '6/20/2023', '7 : 30 am', '15 : 30 pm', 'day', '2023-06-21 00:57:59', '2023-06-21 00:57:59'),
(170, 41, 99, '6/20/2023', '7 : 30 am', '3 : 30 am', 'day', '2023-06-21 00:57:59', '2023-06-21 00:57:59'),
(171, 41, 99, '6/20/2023', '6 : 30 am', '14 : 30 pm', 'day', '2023-06-21 00:57:59', '2023-06-21 00:57:59'),
(172, 41, 99, '6/26/2023', '6 : 30 am', '6 : 25 am', 'day', '2023-06-21 00:57:59', '2023-06-21 00:57:59'),
(173, 41, 99, '6/20/2023', '6 : 20 am', '16 : 15 pm', 'day', '2023-06-21 00:57:59', '2023-06-21 00:57:59'),
(174, 42, 101, '6/21/2023', '3 : 50 am', '4 : 50 am', 'weekly', '2023-06-21 02:43:49', '2023-06-21 02:43:49'),
(175, 42, 101, '6/22/2023', '3 : 41 am', '4 : 41 am', 'weekly', '2023-06-21 02:43:49', '2023-06-21 02:43:49'),
(176, 42, 101, '6/23/2023', '3 : 42 am', '4 : 42 am', 'weekly', '2023-06-21 02:43:49', '2023-06-21 02:43:49'),
(177, 42, 101, '6/24/2023', '3 : 42 am', '4 : 42 am', 'weekly', '2023-06-21 02:43:49', '2023-06-21 02:43:49'),
(178, 42, 101, '6/25/2023', '3 : 43 am', '4 : 43 am', 'weekly', '2023-06-21 02:43:49', '2023-06-21 02:43:49'),
(179, 42, 101, '6/26/2023', '3 : 43 am', '4 : 43 am', 'weekly', '2023-06-21 02:43:49', '2023-06-21 02:43:49'),
(180, 42, 101, '6/27/2023', '3 : 43 am', '4 : 43 am', 'weekly', '2023-06-21 02:43:49', '2023-06-21 02:43:49'),
(181, 43, 101, '6/21/2023', '3 : 50 am', '4 : 50 am', 'day', '2023-06-21 02:54:23', '2023-06-21 02:54:23'),
(182, 43, 101, '6/22/2023', '3 : 41 am', '4 : 41 am', 'day', '2023-06-21 02:54:23', '2023-06-21 02:54:23'),
(183, 43, 101, '6/23/2023', '3 : 42 am', '4 : 42 am', 'day', '2023-06-21 02:54:23', '2023-06-21 02:54:23'),
(184, 43, 101, '6/24/2023', '3 : 42 am', '4 : 42 am', 'day', '2023-06-21 02:54:23', '2023-06-21 02:54:23'),
(185, 43, 101, '6/25/2023', '3 : 43 am', '4 : 43 am', 'day', '2023-06-21 02:54:23', '2023-06-21 02:54:23'),
(186, 43, 101, '6/26/2023', '3 : 43 am', '4 : 43 am', 'day', '2023-06-21 02:54:23', '2023-06-21 02:54:23'),
(187, 43, 101, '6/27/2023', '3 : 43 am', '4 : 43 am', 'day', '2023-06-21 02:54:23', '2023-06-21 02:54:23'),
(188, 43, 101, '6/23/2023', '4 : 54 am', '5 : 54 am', 'day', '2023-06-21 02:54:23', '2023-06-21 02:54:23'),
(189, 44, 101, '6/21/2023', '3 : 50 am', '4 : 50 am', 'day', '2023-06-21 03:13:58', '2023-06-21 03:13:58'),
(190, 44, 101, '6/22/2023', '3 : 41 am', '4 : 41 am', 'day', '2023-06-21 03:13:58', '2023-06-21 03:13:58'),
(191, 44, 101, '6/23/2023', '3 : 42 am', '4 : 42 am', 'day', '2023-06-21 03:13:58', '2023-06-21 03:13:58'),
(192, 44, 101, '6/24/2023', '3 : 42 am', '4 : 42 am', 'day', '2023-06-21 03:13:58', '2023-06-21 03:13:58'),
(193, 44, 101, '6/25/2023', '3 : 43 am', '4 : 43 am', 'day', '2023-06-21 03:13:58', '2023-06-21 03:13:58'),
(194, 44, 101, '6/26/2023', '3 : 43 am', '4 : 43 am', 'day', '2023-06-21 03:13:58', '2023-06-21 03:13:58'),
(195, 44, 101, '6/27/2023', '3 : 43 am', '4 : 43 am', 'day', '2023-06-21 03:13:58', '2023-06-21 03:13:58'),
(196, 44, 101, '6/23/2023', '4 : 54 am', '5 : 54 am', 'day', '2023-06-21 03:13:58', '2023-06-21 03:13:58'),
(197, 44, 101, '6/21/2023', '5 : 13 am', '6 : 13 am', 'day', '2023-06-21 03:13:58', '2023-06-21 03:13:58'),
(198, 45, 103, '6/21/2023', '5 : 5 am', '6 : 5 am', 'weekly', '2023-06-21 04:07:07', '2023-06-21 04:07:07'),
(199, 45, 103, '6/22/2023', '5 : 5 am', '6 : 6 am', 'weekly', '2023-06-21 04:07:07', '2023-06-21 04:07:07'),
(200, 45, 103, '6/23/2023', '5 : 6 am', '7 : 6 am', 'weekly', '2023-06-21 04:07:07', '2023-06-21 04:07:07'),
(201, 45, 103, '6/24/2023', '6 : 6 am', '6 : 6 am', 'weekly', '2023-06-21 04:07:07', '2023-06-21 04:07:07'),
(202, 45, 103, '6/25/2023', '5 : 6 am', '7 : 6 am', 'weekly', '2023-06-21 04:07:07', '2023-06-21 04:07:07'),
(203, 45, 103, '6/26/2023', '6 : 6 am', '6 : 6 am', 'weekly', '2023-06-21 04:07:07', '2023-06-21 04:07:07'),
(204, 45, 103, '6/27/2023', '5 : 6 am', '6 : 6 am', 'weekly', '2023-06-21 04:07:07', '2023-06-21 04:07:07'),
(205, 46, 101, '6/21/2023', '6:20 AM', '7:20 AM', 'day', '2023-06-21 05:21:04', '2023-06-21 05:21:04'),
(206, 47, 101, '6/21/2023', '6:20 AM', '7:20 AM', 'day', '2023-06-21 05:26:15', '2023-06-21 05:26:15'),
(207, 47, 101, '6/21/2023', '6:26 AM', '7:26 AM', 'day', '2023-06-21 05:26:15', '2023-06-21 05:26:15'),
(208, 48, 107, '7/11/2023', '10:46 PM', '10:46 PM', 'day', '2023-07-11 21:46:43', '2023-07-11 21:46:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `social_login` int(11) NOT NULL,
  `access_token` varchar(255) NOT NULL,
  `otp` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `social_login`, `access_token`, `otp`, `user_type`, `images`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(33, 'lia Pars', 'user@gmail.com', NULL, 0, '2CsGl1ReNG4yhbtKnsKBMBL9CLYNYfGXvzKTRB9OCoo9ZoSGVG', '123456', 'user', 'images/202306170648.jpg', NULL, NULL, '2023-06-10 00:45:12', '2023-06-20 06:42:26'),
(34, 'Muhammad Minam', 'babysitter@gmail.com', NULL, 0, 'QlxDXfRX1gvZPNwFblm5bm7jzvtNHvPx5ezl6U9cPO17rYYp8D', '123456', 'babysitter', 'images/202306092048.png', NULL, NULL, '2023-06-10 00:45:32', '2023-06-20 01:36:36'),
(60, 'babySitter 2', 'babysitter2@gmail.com', NULL, 0, 'econrhAMOLvV64rKiO0ktml0zKTWETJEMH0ju7430sEB9nXcFa', '123456', 'babysitter2', 'images/202306130158.jpg', NULL, NULL, '2023-06-13 05:57:13', '2023-06-13 05:58:19'),
(99, 'u u', 'u@gmail.com', NULL, 0, 'S4YgyhBVZut9nWuXZzXDczRrqe9kbZNa8AF9W4b2Tq97bU93v2', '123456', 'user', 'images/202306202055.jpg', NULL, NULL, '2023-06-21 00:55:02', '2023-06-21 04:17:38'),
(100, 'baby sit', 'bs@gmail.com', NULL, 0, '1zZcJVSkii7KFkca3M6JSuUCTunmwEov860T9A5B67qotvlwQP', '123456', 'babysitter', 'images/202306202059.jpg', NULL, NULL, '2023-06-21 00:58:35', '2023-06-21 03:25:22'),
(101, 'Haris Ghaznavi', 'harisghaznavi98@gmail.com', NULL, 1, 'z6rA4sjIwgtoowjSoUXAMsBSaplDbnWJug2dzxJyFZZGMrPxbU', '123456', 'user', 'images/202306202238.jpg', NULL, NULL, '2023-06-21 02:28:38', '2023-06-21 02:38:56'),
(103, 'Testing Account', 'a@getnada.com', NULL, 0, 't8RD3yvYJhi4lHMev7y2Uo3GFboEwZq3bgGxDqrcDUMXT2jide', '123456', 'user', 'images/202306202355.jpg', NULL, NULL, '2023-06-21 03:53:56', '2023-06-21 03:55:15'),
(105, 'Brandon Taylor', 'generictestingdevice@gmail.com', NULL, 1, 'H0j8MG34tlcHlgfvzMeYqRCueltQ7ui2nmuJX7thQpD1DVmk5X', '123456', 'babysitter', 'images/202306210123.jpg', NULL, NULL, '2023-06-21 03:58:47', '2023-06-21 05:23:34'),
(106, 'Testing User', 'user@getnada.com', NULL, 0, '80mutoWIr5FFsLsIJlCioUkRedcF41yn6E7bly02wGCnbxiajJ', '123456', 'babysitter', 'images/202306210004.jpg', NULL, NULL, '2023-06-21 04:03:00', '2023-06-21 04:04:44'),
(107, 'test test', 'cba@getnada.com', NULL, 0, 'ZN0cKYN0gPeRtVvI6ONG2RlKwzH5rngTavx4RbQGtMzxsk6gpK', '123456', 'user', 'images/202307111746.jpg', NULL, NULL, '2023-07-11 21:45:21', '2023-07-11 21:46:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_detail`
--

CREATE TABLE `user_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_detail`
--

INSERT INTO `user_detail` (`id`, `user_id`, `first_name`, `last_name`, `phone_number`, `address`, `lat`, `long`, `created_at`, `updated_at`) VALUES
(36, '99', 'u', 'u', '3534543', '123 adrs', '37.785834', '-122.406417', '2023-06-21 00:55:26', '2023-06-21 00:55:26'),
(37, '101', 'Haris', 'Ghaznavi', '1234567890', 'ghhhygg', '24.8620458', '67.0708685', '2023-06-21 02:38:56', '2023-06-21 02:38:56'),
(38, '103', 'Testing', 'Account', '1234567890', 'Texas', '24.8620101', '67.0708671', '2023-06-21 03:55:15', '2023-06-21 03:55:15'),
(39, '107', 'test', 'test', '1234567890', 'Texas', '24.8620204', '67.0708769', '2023-07-11 21:46:00', '2023-07-11 21:46:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `baby_sitter_certificate`
--
ALTER TABLE `baby_sitter_certificate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `baby_sitter_detail`
--
ALTER TABLE `baby_sitter_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `childrens`
--
ALTER TABLE `childrens`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_schedule`
--
ALTER TABLE `time_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_detail`
--
ALTER TABLE `user_detail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `baby_sitter_certificate`
--
ALTER TABLE `baby_sitter_certificate`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `baby_sitter_detail`
--
ALTER TABLE `baby_sitter_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `childrens`
--
ALTER TABLE `childrens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `time_schedule`
--
ALTER TABLE `time_schedule`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `user_detail`
--
ALTER TABLE `user_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

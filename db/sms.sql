-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2018 at 06:23 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_details`
--

CREATE TABLE `about_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `about_menu_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_details`
--

INSERT INTO `about_details` (`id`, `about_menu_id`, `title`, `details`, `file`, `created_at`, `updated_at`) VALUES
(1, 1, 'This is Title', '<p>helow world</p>\r\n<p><img src="/sms/source/1503988712mission.jpg?1512893337959" alt="1503988712mission" width="296" height="336" /></p>', NULL, '2017-12-10 02:11:25', '2017-12-10 02:11:25');

-- --------------------------------------------------------

--
-- Table structure for table `about_menus`
--

CREATE TABLE `about_menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_menus`
--

INSERT INTO `about_menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Introduction', '2017-12-10 00:47:39', '2017-12-10 00:47:39'),
(2, 'History', '2017-12-10 00:47:46', '2017-12-10 00:47:46'),
(3, 'Mission', '2017-12-10 00:47:51', '2017-12-10 00:47:51'),
(4, 'Vission', '2017-12-10 00:47:56', '2017-12-10 00:47:56');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `union_id` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpassword` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `union_id`, `school_id`, `name`, `email`, `password`, `cpassword`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 'oni', 'aueodol@gmail.com', '$2y$10$jLVY0U8g/aflnzCX8LpoxeK7Sxj3Op4.AgLnjYHW8DJZfayLNQMBS', '123456', 'YEFcByYpNAfuDjmxgLD0oBBItSMMEY2p8woOykQF19lEcfhhVc8gHHriXJGH', NULL, '2017-09-02 08:12:21'),
(5, 3, 1, 'Khalid Saifulla', 'khalid@gmail.com', '$2y$10$at9AeId/7OIfsEGag2CUleZgnoo3Pgqer.rjuQNwF3DnEv4FE7j1C', 'khalid12345', 'o4vodhAoWRKXAQQjHNDxf5bazD2udaPSn1UrgbqnBgj0ydyfA3hd2vZQeGaa', '2017-08-31 18:24:21', '2017-08-31 18:24:21'),
(6, 3, 3, 'Jaman', 'jaman@gmail.com', '$2y$10$jLVY0U8g/aflnzCX8LpoxeK7Sxj3Op4.AgLnjYHW8DJZfayLNQMBS', '123456', 'g32AG6MorVaidJvpy3D6vsOEdekrwOCt3ETOG8zWVQxrbqGb9N2yOVYJ27aW', '2017-09-01 06:12:52', '2017-09-01 06:12:52'),
(7, 3, 2, 'bijoy', 'bijoy@gmail.com', '$2y$10$hGXO4sQkwls9sxnb3Fnv8.RX/f7EWwk/Xj3EKKNAGmnzRu273Tmaq', '123456', NULL, '2017-09-03 05:51:40', '2017-09-03 05:51:40'),
(8, 3, 4, 'sagor', 'dental@gmail.com', '$2y$10$mLHXQYrPRP2JyvfkjqWkG.vqAaoMVbdx8I8pjwZwIiRnBTNYbYutq', '123456', 'QsmcF62ggt2RP9CQ9AxNS1WM7tsomkezmTPRuhUmzvZK0NsWg33PXxUzCN2X', '2017-09-10 08:50:41', '2017-09-10 08:50:41');

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `role_id`, `admin_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(5, 2, 5, '2017-08-31 18:24:21', '2017-08-31 18:24:21'),
(6, 2, 6, '2017-09-01 06:12:52', '2017-09-01 06:12:52'),
(7, 2, 7, '2017-09-03 05:51:40', '2017-09-03 05:51:40'),
(8, 2, 8, '2017-09-10 08:50:41', '2017-09-10 08:50:41');

-- --------------------------------------------------------

--
-- Table structure for table `class_exams`
--

CREATE TABLE `class_exams` (
  `id` int(10) UNSIGNED NOT NULL,
  `sclass_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_exams`
--

INSERT INTO `class_exams` (`id`, `sclass_id`, `exam_id`, `type`, `created_at`, `updated_at`) VALUES
(2, 5, 3, 'normal', NULL, '2017-10-21 09:45:59'),
(4, 5, 1, 'monthly', NULL, '2017-10-21 09:45:59');

-- --------------------------------------------------------

--
-- Table structure for table `class_groups`
--

CREATE TABLE `class_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `sclass_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_groups`
--

INSERT INTO `class_groups` (`id`, `sclass_id`, `group_id`, `created_at`, `updated_at`) VALUES
(4, 5, 1, '2017-11-21 20:27:42', '2017-11-21 20:27:42'),
(5, 5, 2, '2017-11-21 20:27:42', '2017-11-21 20:27:42'),
(6, 5, 3, '2017-11-21 20:27:42', '2017-11-21 20:27:42');

-- --------------------------------------------------------

--
-- Table structure for table `class_monthlies`
--

CREATE TABLE `class_monthlies` (
  `id` int(10) UNSIGNED NOT NULL,
  `sclass_id` int(11) NOT NULL,
  `monthly_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_monthlies`
--

INSERT INTO `class_monthlies` (`id`, `sclass_id`, `monthly_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2017-10-20 02:18:07', '2017-10-20 02:18:22');

-- --------------------------------------------------------

--
-- Table structure for table `class_sections`
--

CREATE TABLE `class_sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `sclass_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_sections`
--

INSERT INTO `class_sections` (`id`, `sclass_id`, `section_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2017-10-10 08:48:36', '2017-10-10 08:48:36'),
(2, 1, 2, '2017-10-10 08:48:36', '2017-10-10 08:48:36'),
(3, 5, 1, '2017-12-07 22:32:51', '2017-12-07 22:32:51');

-- --------------------------------------------------------

--
-- Table structure for table `class_subjects`
--

CREATE TABLE `class_subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `sclass_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `subject_id` int(11) NOT NULL,
  `subjective` int(11) DEFAULT NULL,
  `sub_pass` int(11) DEFAULT NULL,
  `objective` int(11) DEFAULT NULL,
  `obj_pass` int(11) DEFAULT NULL,
  `practical` int(11) DEFAULT NULL,
  `prac_pass` int(11) DEFAULT NULL,
  `percent` int(11) DEFAULT NULL,
  `part` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_pass` int(11) DEFAULT NULL,
  `inactive` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_subjects`
--

INSERT INTO `class_subjects` (`id`, `sclass_id`, `exam_id`, `group_id`, `subject_id`, `subjective`, `sub_pass`, `objective`, `obj_pass`, `practical`, `prac_pass`, `percent`, `part`, `total_pass`, `inactive`, `created_at`, `updated_at`) VALUES
(1, 3, 3, NULL, 1, 70, 23, 30, 10, NULL, NULL, 100, 'b1', 1, 0, '2017-11-26 20:22:02', '2017-11-26 20:22:02'),
(2, 3, 3, NULL, 2, 30, 10, 20, 7, NULL, NULL, 50, 'b1', 1, 0, '2017-11-26 20:22:02', '2017-11-26 20:22:02'),
(3, 3, 3, NULL, 3, 100, 33, NULL, NULL, NULL, NULL, 100, 'e1', 1, 0, '2017-11-26 20:22:02', '2017-11-26 20:22:02'),
(4, 3, 3, NULL, 4, 50, 17, NULL, NULL, NULL, NULL, 50, 'e1', 1, 0, '2017-11-26 20:22:02', '2017-11-26 20:22:02'),
(5, 3, 3, NULL, 5, NULL, NULL, 25, NULL, 25, NULL, 50, NULL, 0, 0, '2017-11-26 20:22:02', '2017-11-26 20:22:02'),
(6, 3, 3, NULL, 6, 70, 0, 30, 0, NULL, NULL, 100, NULL, 0, 0, '2017-11-26 20:22:02', '2017-11-26 20:22:02'),
(7, 3, 3, NULL, 10, 70, NULL, 30, NULL, NULL, NULL, 100, NULL, 0, 1, '2017-11-26 20:22:02', '2017-11-26 20:22:02'),
(8, 3, 3, NULL, 11, 70, NULL, 30, NULL, NULL, NULL, 100, NULL, 0, 0, '2017-11-26 20:22:02', '2017-11-26 20:22:02'),
(9, 3, 3, NULL, 7, 70, NULL, 30, NULL, NULL, NULL, 100, NULL, 0, 0, '2017-11-27 05:47:13', '2017-11-27 05:47:13'),
(10, 3, 3, NULL, 8, 70, NULL, 30, NULL, NULL, NULL, 100, NULL, 0, 0, '2017-11-27 05:47:13', '2017-11-27 05:47:13'),
(11, 5, 3, 1, 1, 70, 23, 30, 10, NULL, NULL, 75, 'b1', 0, 0, '2017-11-27 10:49:45', '2017-11-30 21:18:26'),
(12, 5, 3, 1, 2, 70, 23, 30, 10, NULL, NULL, 75, 'b1', 0, 0, '2017-11-27 10:49:45', '2017-11-30 21:18:41'),
(13, 5, 3, 1, 3, 100, 33, NULL, NULL, NULL, NULL, 75, 'e1', 0, 0, '2017-11-27 10:49:45', '2017-11-30 21:18:55'),
(14, 5, 3, 1, 4, 100, 33, NULL, NULL, NULL, NULL, 75, 'e1', 0, 0, '2017-11-27 10:49:45', '2017-11-30 21:19:05'),
(15, 5, 3, 1, 5, NULL, NULL, 25, 8, 25, 8, 40, NULL, 0, 0, '2017-11-27 10:49:45', '2017-11-30 21:19:22'),
(16, 5, 3, 1, 6, 70, 23, 30, 10, NULL, NULL, 75, NULL, 0, 0, '2017-11-27 10:49:45', '2017-11-30 21:19:31'),
(17, 5, 3, 1, 8, 70, 23, 30, 10, NULL, NULL, 75, NULL, 0, 0, '2017-11-27 10:49:45', '2017-11-30 21:19:39'),
(18, 5, 3, 1, 9, 70, 23, 30, 10, NULL, NULL, 75, NULL, 0, 0, '2017-11-27 10:49:45', '2017-11-30 21:20:04'),
(19, 5, 3, 1, 10, 50, 17, 25, 8, 25, 8, 75, NULL, 0, 1, '2017-11-27 10:49:46', '2017-11-30 21:20:11'),
(20, 5, 3, 1, 11, 50, 17, 25, 8, 25, 8, 75, NULL, 0, 0, '2017-11-27 10:49:46', '2017-11-30 21:20:18'),
(21, 5, 3, 1, 12, 50, 17, 25, 8, 25, 8, 75, NULL, 0, 0, '2017-11-27 10:49:46', '2017-11-30 21:20:27'),
(22, 5, 3, 1, 13, 50, 17, 25, 8, 25, 8, 75, NULL, 0, 0, '2017-11-27 10:49:46', '2017-11-30 21:20:34'),
(23, 5, 3, 1, 14, 50, 17, 25, 8, 25, 8, 75, NULL, 0, 0, '2017-11-27 10:49:46', '2017-11-30 21:20:41'),
(24, 5, 3, 1, 15, 50, 17, 25, 8, 25, 8, 75, NULL, 0, 0, '2017-11-27 10:49:46', '2017-11-30 21:20:48'),
(25, 5, 1, 1, 1, 25, NULL, NULL, NULL, NULL, NULL, 25, NULL, 0, 0, '2017-11-30 21:23:24', '2017-11-30 21:23:24'),
(26, 5, 1, 1, 2, 25, NULL, NULL, NULL, NULL, NULL, 25, NULL, 0, 0, '2017-11-30 21:23:24', '2017-11-30 21:23:24'),
(27, 5, 1, 1, 3, 25, NULL, NULL, NULL, NULL, NULL, 25, NULL, 0, 0, '2017-11-30 21:23:24', '2017-11-30 21:23:24'),
(28, 5, 1, 1, 4, 25, NULL, NULL, NULL, NULL, NULL, 25, NULL, 0, 0, '2017-11-30 21:23:24', '2017-11-30 21:23:24'),
(29, 5, 1, 1, 5, 10, NULL, NULL, NULL, NULL, NULL, 10, NULL, 0, 0, '2017-11-30 21:23:24', '2017-11-30 21:23:24'),
(30, 5, 1, 1, 6, 25, NULL, NULL, NULL, NULL, NULL, 25, NULL, 0, 0, '2017-11-30 21:23:25', '2017-11-30 21:23:25'),
(31, 5, 1, 1, 7, 25, NULL, NULL, NULL, NULL, NULL, 25, NULL, 0, 0, '2017-11-30 21:23:25', '2017-11-30 21:23:25'),
(32, 5, 1, 1, 8, 25, NULL, NULL, NULL, NULL, NULL, 25, NULL, 0, 0, '2017-11-30 21:23:25', '2017-11-30 21:23:25'),
(33, 5, 1, 1, 9, 25, NULL, NULL, NULL, NULL, NULL, 25, NULL, 0, 0, '2017-11-30 21:23:25', '2017-11-30 21:23:25'),
(34, 5, 1, 1, 10, 25, NULL, NULL, NULL, NULL, NULL, 25, NULL, 0, 0, '2017-11-30 21:23:25', '2017-11-30 21:23:25'),
(35, 5, 1, 1, 11, 25, NULL, NULL, NULL, NULL, NULL, 25, NULL, 0, 0, '2017-11-30 21:23:25', '2017-11-30 21:23:25'),
(36, 5, 1, 1, 12, 25, NULL, NULL, NULL, NULL, NULL, 25, NULL, 0, 0, '2017-11-30 21:23:25', '2017-11-30 21:23:25'),
(37, 5, 1, 1, 13, 25, NULL, NULL, NULL, NULL, NULL, 25, NULL, 0, 0, '2017-11-30 21:23:25', '2017-11-30 21:23:25'),
(38, 5, 1, 1, 14, 25, NULL, NULL, NULL, NULL, NULL, 25, NULL, 0, 0, '2017-11-30 21:23:25', '2017-11-30 21:23:25'),
(39, 5, 1, 1, 15, 25, NULL, NULL, NULL, NULL, NULL, 25, NULL, 0, 0, '2017-11-30 21:23:25', '2017-11-30 21:23:25');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(1, 'First Monthly', 'monthly', '2017-10-20 02:47:35', '2017-10-20 02:47:35'),
(2, 'Second Monthly', 'monthly', '2017-10-20 02:47:48', '2017-10-20 02:47:48'),
(3, 'Halfyearly', 'normal', '2017-10-20 02:47:59', '2017-10-20 02:47:59'),
(4, 'Final', 'normal', '2017-10-20 02:48:07', '2017-10-20 02:48:07');

-- --------------------------------------------------------

--
-- Table structure for table `fail_subjects`
--

CREATE TABLE `fail_subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_roll` int(11) NOT NULL,
  `sclass_id` int(11) NOT NULL,
  `session` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `subject_id` int(11) NOT NULL,
  `part` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `name`, `file`, `created_at`, `updated_at`) VALUES
(1, 'Nice Littler Couple', '1513011827sch.jpg', '2017-12-11 11:03:47', '2017-12-11 11:03:47'),
(2, 'This is cscr', '15130119721508926686col.PNG', '2017-12-11 11:06:12', '2017-12-11 11:06:12');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Science', '2017-09-26 21:07:06', '2017-09-26 21:07:06'),
(2, 'Commerce', '2017-09-26 21:07:16', '2017-09-26 21:07:16'),
(3, 'Humanities', '2017-09-26 21:07:27', '2017-09-26 21:07:27');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `merits`
--

CREATE TABLE `merits` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_roll` int(11) NOT NULL,
  `sclass_id` int(11) NOT NULL,
  `session` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `total_mark` int(11) NOT NULL,
  `gpa` double(8,2) NOT NULL,
  `grade` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` int(11) DEFAULT NULL,
  `fail` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(87, '2014_10_12_000000_create_users_table', 39),
(88, '2014_10_12_100000_create_password_resets_table', 39),
(89, '2017_08_26_152853_create_admins_table', 39),
(90, '2017_08_27_023425_create_roles_table', 39),
(91, '2017_08_27_023456_create_admin_roles_table', 39),
(119, '2017_09_23_031422_create_subjects_table', 40),
(120, '2017_09_23_031455_create_groups_table', 40),
(123, '2017_09_23_031538_create_sections_table', 40),
(124, '2017_09_18_105912_create_sclasses_table', 41),
(125, '2017_09_23_031538_create_class_sections_table', 42),
(128, '2017_09_27_025118_create_class_groups_table', 44),
(129, '2017_09_28_151832_create_teacher_subjects_table', 45),
(132, '2017_10_10_164225_create_teacher_classes_table', 46),
(147, '2017_10_18_085426_create_subject_numbers_table', 56),
(151, '2017_10_20_075918_create_monthlies_table', 58),
(152, '2017_10_20_080135_create_class_monthlies_table', 58),
(153, '2017_09_23_031522_create_exams_table', 59),
(154, '2017_09_27_025048_create_class_exams_table', 60),
(163, '2017_11_21_032427_create_about_menus_table', 62),
(170, '2017_11_23_063610_create_fail_subjects_table', 65),
(171, '2017_10_19_170008_create_merits_table', 66),
(172, '2017_09_28_152217_create_class_subjects_table', 68),
(173, '2017_10_13_035725_create_results_table', 68),
(174, '2017_10_13_081816_create_optional_subjects_table', 69),
(175, '2017_11_28_005859_create_non_subjects_table', 70),
(176, '2017_11_21_032614_create_about_details_table', 71),
(177, '2017_12_10_120102_create_sliders_table', 72),
(178, '2017_12_10_120139_create_galleries_table', 72),
(179, '2017_12_11_170925_create_jobs_table', 73);

-- --------------------------------------------------------

--
-- Table structure for table `monthlies`
--

CREATE TABLE `monthlies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `monthlies`
--

INSERT INTO `monthlies` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'First Monthly', '2017-10-20 02:14:52', '2017-10-20 02:14:52');

-- --------------------------------------------------------

--
-- Table structure for table `non_subjects`
--

CREATE TABLE `non_subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_roll` int(11) NOT NULL,
  `sclass_id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `session` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `non_subjects`
--

INSERT INTO `non_subjects` (`id`, `student_id`, `student_roll`, `sclass_id`, `section_id`, `group_id`, `session`, `subject_id`, `created_at`, `updated_at`) VALUES
(1, 33, 13, 5, 1, 1, 2017, 14, '2017-11-27 19:04:46', '2017-11-27 19:04:46'),
(2, 34, 14, 5, 1, 1, 2017, 14, '2017-11-27 19:04:47', '2017-11-27 19:04:47'),
(3, 35, 15, 5, 1, 1, 2017, 14, '2017-11-27 19:04:47', '2017-11-27 19:04:47'),
(4, 36, 16, 5, 1, 1, 2017, 14, '2017-11-27 19:04:47', '2017-11-27 19:04:47'),
(5, 37, 17, 5, 1, 1, 2017, 14, '2017-11-27 19:04:47', '2017-11-27 19:04:47'),
(6, 38, 18, 5, 1, 1, 2017, 14, '2017-11-27 19:04:47', '2017-11-27 19:04:47'),
(7, 39, 19, 5, 1, 1, 2017, 14, '2017-11-27 19:04:47', '2017-11-27 19:04:47'),
(8, 40, 20, 5, 1, 1, 2017, 14, '2017-11-27 19:04:47', '2017-11-27 19:04:47'),
(9, 21, 1, 5, 1, 1, 2017, 15, '2017-11-27 19:05:04', '2017-11-27 19:05:04'),
(10, 22, 2, 5, 1, 1, 2017, 15, '2017-11-27 19:05:04', '2017-11-27 19:05:04'),
(11, 23, 3, 5, 1, 1, 2017, 15, '2017-11-27 19:05:04', '2017-11-27 19:05:04'),
(12, 24, 4, 5, 1, 1, 2017, 15, '2017-11-27 19:05:04', '2017-11-27 19:05:04'),
(13, 25, 5, 5, 1, 1, 2017, 15, '2017-11-27 19:05:41', '2017-11-27 19:05:41'),
(14, 26, 6, 5, 1, 1, 2017, 15, '2017-11-27 19:05:41', '2017-11-27 19:05:41'),
(15, 27, 7, 5, 1, 1, 2017, 15, '2017-11-27 19:05:41', '2017-11-27 19:05:41'),
(16, 28, 8, 5, 1, 1, 2017, 15, '2017-11-27 19:05:41', '2017-11-27 19:05:41'),
(17, 29, 9, 5, 1, 1, 2017, 15, '2017-11-27 19:05:41', '2017-11-27 19:05:41'),
(18, 30, 10, 5, 1, 1, 2017, 15, '2017-11-27 19:05:42', '2017-11-27 19:05:42'),
(19, 31, 11, 5, 1, 1, 2017, 15, '2017-11-27 19:05:42', '2017-11-27 19:05:42'),
(20, 32, 12, 5, 1, 1, 2017, 15, '2017-11-27 19:05:42', '2017-11-27 19:05:42');

-- --------------------------------------------------------

--
-- Table structure for table `optional_subjects`
--

CREATE TABLE `optional_subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_roll` int(11) NOT NULL,
  `sclass_id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `session` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `optional_subjects`
--

INSERT INTO `optional_subjects` (`id`, `student_id`, `student_roll`, `sclass_id`, `section_id`, `group_id`, `session`, `subject_id`, `created_at`, `updated_at`) VALUES
(1, 21, 1, 5, 1, 1, 2017, 14, '2017-11-27 18:55:00', '2017-11-27 18:55:00'),
(2, 22, 2, 5, 1, 1, 2017, 14, '2017-11-27 18:55:00', '2017-11-27 18:55:00'),
(3, 23, 3, 5, 1, 1, 2017, 14, '2017-11-27 18:55:00', '2017-11-27 18:55:00'),
(4, 24, 4, 5, 1, 1, 2017, 14, '2017-11-27 18:55:00', '2017-11-27 18:55:00'),
(5, 33, 13, 5, 1, 1, 2017, 15, '2017-11-27 18:55:29', '2017-11-27 18:55:29'),
(6, 34, 14, 5, 1, 1, 2017, 15, '2017-11-27 18:55:29', '2017-11-27 18:55:29'),
(7, 35, 15, 5, 1, 1, 2017, 15, '2017-11-27 18:55:29', '2017-11-27 18:55:29'),
(8, 36, 16, 5, 1, 1, 2017, 15, '2017-11-27 18:55:29', '2017-11-27 18:55:29'),
(9, 37, 17, 5, 1, 1, 2017, 15, '2017-11-27 18:55:29', '2017-11-27 18:55:29'),
(10, 38, 18, 5, 1, 1, 2017, 15, '2017-11-27 18:55:29', '2017-11-27 18:55:29'),
(11, 39, 19, 5, 1, 1, 2017, 15, '2017-11-27 18:55:29', '2017-11-27 18:55:29'),
(12, 40, 20, 5, 1, 1, 2017, 15, '2017-11-27 18:55:30', '2017-11-27 18:55:30'),
(13, 25, 5, 5, 1, 1, 2017, 11, '2017-11-27 18:56:45', '2017-11-27 18:56:45'),
(14, 26, 6, 5, 1, 1, 2017, 11, '2017-11-27 18:56:45', '2017-11-27 18:56:45'),
(15, 27, 7, 5, 1, 1, 2017, 11, '2017-11-27 18:56:45', '2017-11-27 18:56:45'),
(16, 28, 8, 5, 1, 1, 2017, 11, '2017-11-27 18:56:45', '2017-11-27 18:56:45'),
(17, 29, 9, 5, 1, 1, 2017, 11, '2017-11-27 18:56:45', '2017-11-27 18:56:45'),
(18, 30, 10, 5, 1, 1, 2017, 11, '2017-11-27 18:56:45', '2017-11-27 18:56:45'),
(19, 31, 11, 5, 1, 1, 2017, 11, '2017-11-27 18:56:45', '2017-11-27 18:56:45'),
(20, 32, 12, 5, 1, 1, 2017, 11, '2017-11-27 18:56:45', '2017-11-27 18:56:45');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_roll` int(11) NOT NULL,
  `sclass_id` int(11) NOT NULL,
  `session` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `subject_id` int(11) NOT NULL,
  `subjective` int(11) DEFAULT NULL,
  `is_sub_pass` int(11) DEFAULT NULL,
  `objective` int(11) DEFAULT NULL,
  `is_obj_pass` int(11) DEFAULT NULL,
  `practical` int(11) DEFAULT NULL,
  `is_prac_pass` int(11) DEFAULT NULL,
  `monthly` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `percent` int(11) DEFAULT NULL,
  `part_monthly` int(11) DEFAULT NULL,
  `part_sub` int(11) DEFAULT NULL,
  `part_obj` int(11) DEFAULT NULL,
  `part_prac` int(11) DEFAULT NULL,
  `part_mark` int(11) DEFAULT NULL,
  `part` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_mark` int(11) DEFAULT NULL,
  `gpa` double(8,2) DEFAULT NULL,
  `grade` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_opt` int(11) DEFAULT NULL,
  `opt_point` double(8,2) DEFAULT NULL,
  `inactive` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL),
(2, 'School Authority', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sclasses`
--

CREATE TABLE `sclasses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sclasses`
--

INSERT INTO `sclasses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Class One', '2017-09-24 20:28:45', '2017-09-24 20:28:45'),
(3, 'Class Six', '2017-10-11 11:21:33', '2017-11-21 20:27:03'),
(4, 'Class Eight', '2017-11-21 20:27:12', '2017-11-21 20:27:12'),
(5, 'Class Ten', '2017-11-21 20:27:24', '2017-11-21 20:27:24');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Section A', '2017-09-24 20:21:42', '2017-09-24 20:21:42'),
(2, 'Section B', '2017-09-24 20:21:47', '2017-09-24 20:21:47');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `name`, `file`, `created_at`, `updated_at`) VALUES
(1, 'No Title', '15130107621508926686col.PNG', '2017-12-10 06:07:47', '2017-12-11 10:46:02'),
(2, 'admin', '1513010800sch.jpg', '2017-12-11 10:46:40', '2017-12-11 10:46:40');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `roll` int(11) DEFAULT NULL,
  `father` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `mother` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `sclass_id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `session` int(11) NOT NULL,
  `mobile` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  `gender` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `address` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `image` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `religion` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `birth_date` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `nationality` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `cpassword` varchar(60) CHARACTER SET latin1 DEFAULT NULL,
  `remember_token` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `roll`, `father`, `mother`, `sclass_id`, `section_id`, `group_id`, `session`, `mobile`, `gender`, `address`, `image`, `email`, `religion`, `birth_date`, `nationality`, `password`, `cpassword`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'MD. NASIR UDDIN', 1, ' MD. RAFIKUL ISLAM', ' MOST. NAJMA BEGUM', 3, 1, NULL, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-26 21:41:51', '2017-11-26 21:41:51'),
(2, ' MAHFUZAR RAHMANN', 2, ' NAZRUL ISLAM', ' MASUDA BEGUM', 3, 1, NULL, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-26 21:41:51', '2017-11-26 21:41:51'),
(3, 'MD. HUMAUN KABIR HEMAL', 3, ' MD. ABUL KALAM AZAD', ' MST. HOSNA ARA', 3, 1, NULL, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-26 21:41:51', '2017-11-26 21:41:51'),
(4, 'MD. AHSAN HABIB', 4, ' MD. MAZIDUL ISLAM', ' HAZERA', 3, 1, NULL, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-26 21:41:52', '2017-11-26 21:41:52'),
(5, 'MD. SIFAT MIA', 5, 'MD. MASHIAR RAHMAN', 'MOST. HASINA BEGUM', 3, 1, NULL, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-26 21:41:52', '2017-11-26 21:41:52'),
(6, 'MD. BIPUL-MIA', 6, 'MD. MANIRUJJAMAN-MIA.', ' MOST. BILKIS -BEGUM.', 3, 1, NULL, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-26 21:41:52', '2017-11-26 21:41:52'),
(7, ' POLASH. CHANDRA-PAL.', 7, 'SONTOSH. CHANDRA-PAL', ' ALEKA-RANI', 3, 1, NULL, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-26 21:41:52', '2017-11-26 21:41:52'),
(8, 'RABBI ISLAM', 8, ' MATIUR RAHMAN', ' LOVELY BEGUM', 3, 1, NULL, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-26 21:41:52', '2017-11-26 21:41:52'),
(9, 'SHOHIDUL ISLAM SOUROV', 9, 'ABDUL BATEN', ' AYSHA KHATUN', 3, 1, NULL, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-26 21:41:52', '2017-11-26 21:41:52'),
(10, ' MD. SAKHAWAT HOSSAIN', 10, ' MD. HAMIDUL ISLAM', ' MST. NAJMA BEGUM', 3, 1, NULL, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-26 21:41:52', '2017-11-26 21:41:52'),
(11, ' SANJOY KUMAR ROY', 11, ' RAJKUMAR BORMON', ' BRAJABALA RANI', 3, 1, NULL, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-26 21:41:52', '2017-11-26 21:41:52'),
(12, ' MD. MOMINUL ISLAM', 12, 'MD. NUR MOHAMMAD', ' NILUFA BEGUM', 3, 1, NULL, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-26 21:41:52', '2017-11-26 21:41:52'),
(13, ' MD. MEHEDI HASAN', 13, ' MD. SHAHALAM', 'MST. MAMATA BEGUM', 3, 1, NULL, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-26 21:41:52', '2017-11-26 21:41:52'),
(14, ' MD. MASUD RANA', 14, ' MD. SARIFUDDIN', ' MINA BEGUM', 3, 1, NULL, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-26 21:41:52', '2017-11-26 21:41:52'),
(15, 'RONI SARKER', 15, ' BIRENDRO NATH SARKER', ' RATNA RANI SARKER', 3, 1, NULL, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-26 21:41:52', '2017-11-26 21:41:52'),
(16, ' MD. SOBUJ ALAM', 16, 'MD. FOIM UDDIN', ' PARUL BEGUM', 3, 1, NULL, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-26 21:41:52', '2017-11-26 21:41:52'),
(17, ' MD. SHAMIM REZA', 17, ' MD. FAZLUL HAQUE', ' MST. AKLIMA BEGUM', 3, 1, NULL, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-26 21:41:52', '2017-11-26 21:41:52'),
(18, ' MD. OYAZKURANI', 18, ' MD.OYAZUL HAQUE', 'MST. MOKREMA KHATUN', 3, 1, NULL, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-26 21:41:52', '2017-11-26 21:41:52'),
(19, ' MD. RAKIB HASAN', 19, ' MD. ABUL KALAM AZAD', ' UMME KULSUM', 3, 1, NULL, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-26 21:41:52', '2017-11-26 21:41:52'),
(20, ' MD. JEWEL RANA', 20, ' MD. MOSFEQUR RAHMAN', ' MOST. JOSNA BEGUM', 3, 1, NULL, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-26 21:41:52', '2017-11-26 21:41:52'),
(21, ' SHAHARIAR MASUD', 1, ' MOMINUL ISLAM', ' SHAR BANU PARVIN', 5, 1, 1, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-27 16:43:40', '2017-11-27 10:39:38'),
(22, 'LIAKAT ALI', 2, ' SAYDUR RAHMAN', ' HAZERA KHATUN', 5, 1, 1, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-27 16:43:40', '2017-11-27 10:39:38'),
(23, ' MD. MONIRUJJAMAN', 3, ' MD. NASIR UDDIN', ' MOST. MORZINA BEGUM', 5, 1, 1, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-27 16:43:40', '2017-11-27 10:39:38'),
(24, 'MD. HARISUR RAHMAN', 4, 'MD. MANIRUL ISLAM', 'MST. REHENA BEGUM', 5, 1, 1, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-27 16:43:40', '2017-11-27 10:39:38'),
(25, 'MD. ABDUL GAFFAR', 5, ' MD. RUHUL AMIN', 'MST.NAZMA BIBI', 5, 1, 1, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-27 16:43:40', '2017-11-27 10:39:38'),
(26, ' Md. Manirul Islam', 6, ' Md. najrul Islam', 'Mst. Moriam Begum', 5, 1, 1, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-27 16:43:40', '2017-11-27 10:39:38'),
(27, 'MD. SULTAN MAHMUD', 7, ' MD. SHAHJAHAN SAJU', 'MOST.ROULTON ARA BEGUM', 5, 1, 1, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-27 16:43:40', '2017-11-27 10:39:38'),
(28, ' MD.SHAMIM MIA', 8, ' MD.BOSHIR UDDIN', 'MRS. SOKINA GEGUM', 5, 1, 1, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-27 16:43:40', '2017-11-27 10:39:38'),
(29, ' RAJU KUMER ROY', 9, ' HARI DAS ROY', ' JANOKI RANI', 5, 1, 1, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-27 16:43:40', '2017-11-27 10:39:38'),
(30, 'MD. SHEKH FORID', 10, ' MD. SHOBHAN FAKIR', ' MOST. FUL BEGUM', 5, 1, 1, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-27 16:43:40', '2017-11-27 10:39:38'),
(31, ' HUMAUN KABIR', 11, ' RUSTAM ALI', 'KAMOLA BANU', 5, 1, 1, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-27 16:43:40', '2017-11-27 10:39:38'),
(32, ' MD. SOHIDULLAH', 12, ' MD. EDRIS ALI', ' SOFURA', 5, 1, 1, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-27 16:43:40', '2017-11-27 10:39:38'),
(33, ' MD MRIDUL ISLA M', 13, ' MD TARA MIA', ' MOST NAHAR BEGUM', 5, 1, 1, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-27 16:43:40', '2017-11-27 10:39:38'),
(34, ' OMOR FARUKH', 14, ' SHERAZUL ISLAM', ' FORIDA BEGUM', 5, 1, 1, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-27 16:43:40', '2017-11-27 10:39:38'),
(35, ' MD. MOSTAFIZUR RAHMAN', 15, 'MD. NAZRUL ISLAM', ' GOLENUR BEGUM', 5, 1, 1, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-27 16:43:40', '2017-11-27 10:39:38'),
(36, ' MD. SHAQUL JAMAL', 16, ' MD. ABDUL LATIF', ' MOST. MORIUM', 5, 1, 1, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-27 16:43:40', '2017-11-27 10:39:38'),
(37, 'MD. MONIRUZZAMAN', 17, ' MD. AMINUL ISLAM', ' MOST. MABIA KHATUN', 5, 1, 1, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-27 16:43:40', '2017-11-27 10:39:38'),
(38, ' RUSTAM ALI', 18, ' MD. SHAH ALAM', 'MOST. ZOSNA BEGUM', 5, 1, 1, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-27 16:43:40', '2017-11-27 10:39:39'),
(39, 'MD. SHURUJ MIA', 19, ' MD. FAZLUL HOQUE', ' MOST. BEGUM', 5, 1, 1, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-27 16:43:40', '2017-11-27 10:39:39'),
(40, ' MD. AZAHARUL ISLAM.', 20, ' MD. AMZAD HOSSAIN.', ' MST. AYSHA BEGUM.', 5, 1, 1, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'Bangladeshi', NULL, NULL, NULL, '2017-11-27 16:43:40', '2017-11-27 10:39:39');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'বাংলা ১ম পত্র', '2017-10-13 02:28:36', '2017-10-13 02:28:36'),
(2, 'বাংলা ২য় পত্র', '2017-10-13 02:28:46', '2017-10-13 02:28:46'),
(3, 'ইংরেজি ১ম পত্র', '2017-10-13 02:29:12', '2017-10-13 02:29:12'),
(4, 'ইংরেজি ২য় পত্র', '2017-10-13 02:29:21', '2017-10-13 02:29:21'),
(5, 'তথ্য ও যোগাযোগ প্রযুক্তি', '2017-10-13 02:29:30', '2017-10-13 02:29:30'),
(6, 'গণিত', '2017-10-13 02:29:54', '2017-10-13 02:29:54'),
(7, 'সাধারন বিজ্ঞান', '2017-10-13 02:30:03', '2017-10-13 02:30:03'),
(8, 'বাংলাদেশ ত্ত বিশ্ব পরিচয়', '2017-10-13 02:30:12', '2017-10-13 02:30:12'),
(9, 'ধর্ম ত্ত নৈতিক শিক্ষা', '2017-10-13 02:30:20', '2017-10-13 02:30:20'),
(10, 'শারীরিক শিক্ষা স্বাস্থ বিঞ্জান ত্ত খেলাধুলা', '2017-10-13 02:30:29', '2017-10-13 02:30:29'),
(11, 'কৃষি শিক্ষা', '2017-10-13 02:37:29', '2017-10-13 02:37:29'),
(12, 'পদার্থ', '2017-11-21 20:29:51', '2017-11-21 20:29:51'),
(13, 'রসায়ন', '2017-11-21 20:29:57', '2017-11-21 20:29:57'),
(14, 'জীব বিঞ্জান', '2017-11-21 20:30:06', '2017-11-21 20:30:06'),
(15, 'উচ্চতর গণিত', '2017-11-21 20:30:13', '2017-11-21 20:30:13'),
(16, 'বাংলাদেশ ইতিহাস ত্ত বিশ্ব সভ্যতা', '2017-11-21 20:30:20', '2017-11-21 20:30:20');

-- --------------------------------------------------------

--
-- Table structure for table `subject_numbers`
--

CREATE TABLE `subject_numbers` (
  `id` int(10) UNSIGNED NOT NULL,
  `sclass_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subject_numbers`
--

INSERT INTO `subject_numbers` (`id`, `sclass_id`, `number`, `created_at`, `updated_at`) VALUES
(1, 1, 6, '2017-10-18 03:08:46', '2017-10-18 03:08:46');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `mobile` varchar(11) CHARACTER SET latin1 NOT NULL,
  `address` varchar(255) CHARACTER SET latin1 NOT NULL,
  `image` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `religion` varchar(20) CHARACTER SET latin1 NOT NULL,
  `joining_date` varchar(30) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `cpassword` varchar(60) CHARACTER SET latin1 NOT NULL,
  `remember_token` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `teacher_id`, `name`, `mobile`, `address`, `image`, `email`, `religion`, `joining_date`, `password`, `cpassword`, `remember_token`, `created_at`, `updated_at`) VALUES
(25, NULL, 'oli', '01751330409', 'rangpur', '15048420992002.jpg', 'oli@gmail.com', 'muslim', NULL, '$2y$10$HaUpYS2c5k.q9EQKHzgaBun.pmaBWgSIa.TYhk/TSHaQMhogUic4y', '123456', 'l5gMKxpJ4OHMwvukGCB1iLiUotmKQXvIdeTpeJJHKq9iiAJiWWosaCnaLKWO', '2017-11-23 11:06:35', '2017-09-07 21:41:39');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_classes`
--

CREATE TABLE `teacher_classes` (
  `id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `sclass_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_classes`
--

INSERT INTO `teacher_classes` (`id`, `teacher_id`, `sclass_id`, `created_at`, `updated_at`) VALUES
(2, 25, 3, '2017-11-21 20:48:15', '2017-11-21 20:48:15'),
(3, 25, 4, '2017-11-21 20:48:15', '2017-11-21 20:48:15'),
(4, 25, 5, '2017-11-21 20:48:15', '2017-11-21 20:48:15');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subjects`
--

CREATE TABLE `teacher_subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_subjects`
--

INSERT INTO `teacher_subjects` (`id`, `teacher_id`, `subject_id`, `created_at`, `updated_at`) VALUES
(1, 25, 1, '2017-10-13 02:36:00', '2017-10-13 02:36:00'),
(2, 25, 2, '2017-10-13 02:36:00', '2017-10-13 02:36:00'),
(3, 25, 3, '2017-10-13 02:36:00', '2017-10-13 02:36:00'),
(4, 25, 4, '2017-10-13 02:36:00', '2017-10-13 02:36:00'),
(5, 25, 5, '2017-10-13 02:36:00', '2017-10-13 02:36:00'),
(6, 25, 6, '2017-10-13 02:36:00', '2017-10-13 02:36:00'),
(7, 25, 7, '2017-10-13 02:36:00', '2017-10-13 02:36:00'),
(13, 25, 11, '2017-11-22 00:01:35', '2017-11-22 00:01:35'),
(14, 25, 8, '2017-11-24 09:32:39', '2017-11-24 09:32:39'),
(15, 25, 9, '2017-11-24 09:32:39', '2017-11-24 09:32:39'),
(16, 25, 10, '2017-11-24 09:32:39', '2017-11-24 09:32:39'),
(17, 25, 12, '2017-11-27 10:50:14', '2017-11-27 10:50:14'),
(18, 25, 13, '2017-11-27 10:50:14', '2017-11-27 10:50:14'),
(19, 25, 14, '2017-11-27 10:50:14', '2017-11-27 10:50:14'),
(20, 25, 15, '2017-11-27 10:50:14', '2017-11-27 10:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'oli', 'admin@gmail.com', '$2y$10$v7o9pc6pcLQ5n0e0KkjUbOWDsLXo2B8fJFEupzQe01xYpyRiFIZ/a', 'i89FHyhTEe9P7WHFxujU7OLF6KbfsT90QBT8kXyH24TEq6pfsZ22bISDdwst', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_details`
--
ALTER TABLE `about_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `about_menus`
--
ALTER TABLE `about_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_exams`
--
ALTER TABLE `class_exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_groups`
--
ALTER TABLE `class_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_monthlies`
--
ALTER TABLE `class_monthlies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_sections`
--
ALTER TABLE `class_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_subjects`
--
ALTER TABLE `class_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fail_subjects`
--
ALTER TABLE `fail_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merits`
--
ALTER TABLE `merits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthlies`
--
ALTER TABLE `monthlies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `non_subjects`
--
ALTER TABLE `non_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `optional_subjects`
--
ALTER TABLE `optional_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sclasses`
--
ALTER TABLE `sclasses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_numbers`
--
ALTER TABLE `subject_numbers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_classes`
--
ALTER TABLE `teacher_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
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
-- AUTO_INCREMENT for table `about_details`
--
ALTER TABLE `about_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `about_menus`
--
ALTER TABLE `about_menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `class_exams`
--
ALTER TABLE `class_exams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `class_groups`
--
ALTER TABLE `class_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `class_monthlies`
--
ALTER TABLE `class_monthlies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `class_sections`
--
ALTER TABLE `class_sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `class_subjects`
--
ALTER TABLE `class_subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `fail_subjects`
--
ALTER TABLE `fail_subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `merits`
--
ALTER TABLE `merits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;
--
-- AUTO_INCREMENT for table `monthlies`
--
ALTER TABLE `monthlies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `non_subjects`
--
ALTER TABLE `non_subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `optional_subjects`
--
ALTER TABLE `optional_subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sclasses`
--
ALTER TABLE `sclasses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `subject_numbers`
--
ALTER TABLE `subject_numbers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `teacher_classes`
--
ALTER TABLE `teacher_classes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `teacher_subjects`
--
ALTER TABLE `teacher_subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2024 at 07:32 AM
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
-- Database: `dairy`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `buy_id` int(11) NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `expense_type` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `flag` varchar(10) DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `buy_id`, `branch_id`, `expense_type`, `amount`, `flag`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 52000.00, '0', NULL, '2024-02-11 12:07:52', '2024-02-11 12:07:52'),
(2, 2, 1, 2, 100599.00, '0', NULL, '2024-02-14 18:06:24', '2024-02-14 18:06:24'),
(3, 3, 1, 2, 100000.00, '0', NULL, '2024-02-14 18:16:07', '2024-02-14 18:16:07'),
(4, 4, 1, 2, 50000.00, '0', NULL, '2024-02-14 18:16:52', '2024-02-14 18:16:52'),
(5, 5, 1, 1, 47000.00, '0', NULL, '2024-02-14 18:51:03', '2024-02-14 18:51:03'),
(6, 6, 1, 1, 12554930.00, '0', NULL, '2024-02-25 22:57:44', '2024-02-25 22:57:44'),
(7, 7, 1, 1, 710.00, '0', NULL, '2024-03-02 12:07:15', '2024-03-02 12:07:15'),
(8, 8, 1, 1, 1665.00, '0', NULL, '2024-03-02 12:34:35', '2024-03-02 14:37:25');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_name` varchar(250) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `branch_email` varchar(250) DEFAULT NULL,
  `branch_address` varchar(250) DEFAULT NULL,
  `branch_image` varchar(250) DEFAULT NULL,
  `status` varchar(10) DEFAULT '1',
  `flag` varchar(10) DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_name`, `slug`, `branch_email`, `branch_address`, `branch_image`, `status`, `flag`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'হালুয়াঘাট, ময়মনসিংহ', 'haluyaghat-mymnsingh', 'uttara@gmail.com', 'Uttara,Dhaka,Bangladesh', '1703407639.jpg', '1', '0', NULL, '2023-12-23 02:47:20', '2024-02-14 17:58:57'),
(2, 'Gazipur', 'gazipur', 'gazipur@gmail.com', 'Gazipur,Dhaka,Bangladesh', '1703407731.webp', '1', '0', '2024-02-14 17:58:44', '2023-12-23 02:48:51', '2024-02-14 17:58:44'),
(3, 'Malibagh', 'malibagh', 'malibagh@gmail.com', 'Malibagh,Dhaka,Bangladesh', '1703407822.jpg', '1', '0', '2024-02-14 17:58:47', '2023-12-23 02:50:22', '2024-02-14 17:58:47');

-- --------------------------------------------------------

--
-- Table structure for table `buyers`
--

CREATE TABLE `buyers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `phone_number` varchar(25) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `balance` varchar(250) DEFAULT NULL,
  `status` varchar(10) DEFAULT '1',
  `flag` varchar(10) DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buyers`
--

INSERT INTO `buyers` (`id`, `branch_id`, `name`, `phone_number`, `address`, `balance`, `status`, `flag`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Jahid Islam', '01513657914', 'Netrakona Boro Bazar', '0', '1', '0', NULL, '2023-12-28 15:36:35', '2023-12-28 15:36:35'),
(2, 1, 'Mosabbir Rahman', '01913617913', 'Segun Bagicha', '10000', '1', '0', NULL, '2023-12-28 15:37:06', '2023-12-28 15:37:06'),
(3, 1, 'Masum Billah', '01523617914', 'Nakalpara,Dhaka', '35001', '1', '0', NULL, '2023-12-28 15:37:30', '2023-12-28 15:37:30'),
(4, 1, 'ABC', '01221455', 'Dhaka', '25480', '1', '0', NULL, '2024-02-18 21:04:31', '2024-02-18 21:04:31'),
(5, 1, 'Sohan Hasan', '+8801949549496', 'Sirajganj, Banlgadesh', '10000', '1', '0', NULL, '2024-03-03 03:25:22', '2024-03-03 03:25:22');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `status` varchar(255) DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(11, 'আসিল মুরগি', '1', NULL, '2024-03-02 09:18:38', '2024-03-02 09:18:38'),
(12, 'চাটগাঁয়ে', '1', NULL, '2024-03-02 09:18:53', '2024-03-02 09:18:53'),
(13, 'গলাছিলা', '1', NULL, '2024-03-02 09:19:00', '2024-03-02 09:19:00'),
(14, 'হিলি', '1', NULL, '2024-03-02 09:19:11', '2024-03-02 09:19:11'),
(15, 'ইয়াছিন', '1', NULL, '2024-03-02 09:19:17', '2024-03-02 09:19:17'),
(16, 'দেশী', '1', NULL, '2024-03-02 09:19:27', '2024-03-02 09:19:27'),
(17, 'বিদেশী', '1', NULL, '2024-03-02 09:19:37', '2024-03-02 09:21:02'),
(18, 'সোনালি', '1', NULL, '2024-03-02 09:19:42', '2024-03-02 09:19:42');

-- --------------------------------------------------------

--
-- Table structure for table `costs`
--

CREATE TABLE `costs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `expense_type` bigint(20) UNSIGNED NOT NULL,
  `cost_amount` decimal(10,2) DEFAULT NULL,
  `cost_date` timestamp NULL DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `status` varchar(10) DEFAULT '1',
  `flag` varchar(10) DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `costs`
--

INSERT INTO `costs` (`id`, `branch_id`, `name`, `expense_type`, `cost_amount`, `cost_date`, `description`, `status`, `flag`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ashik Iqbal', 1, 1000.00, '2024-02-14 00:00:00', 'gdge', '1', '0', NULL, '2024-02-14 20:01:46', '2024-02-14 20:01:46'),
(2, 1, 'রবিবার ৫ জনের নাস্তা', 4, 250.00, '2024-03-19 18:00:00', 'রবিবার ৫ জনের নাস্তা খচর', '1', '0', NULL, '2024-03-03 03:29:21', '2024-03-03 03:29:21');

-- --------------------------------------------------------

--
-- Table structure for table `cow_vaccines`
--

CREATE TABLE `cow_vaccines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `cow_tag` bigint(20) UNSIGNED NOT NULL,
  `shed_id` bigint(20) UNSIGNED NOT NULL,
  `push_date` timestamp NULL DEFAULT NULL,
  `note` varchar(250) DEFAULT NULL,
  `vaccine_id` bigint(20) UNSIGNED NOT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `given_time` varchar(250) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `name`, `slug`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(6, 'Designation 1', 'designation-1', 'Designation 1 description.', 1, NULL, '2024-03-03 03:52:37', '2024-03-03 03:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `status` varchar(10) DEFAULT '1',
  `flag` varchar(10) DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `name`, `status`, `flag`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'ফার্ম খরচ', '1', '0', NULL, '2023-12-27 23:50:31', '2023-12-27 23:50:31'),
(2, 'স্থায়ী খরচ', '1', '0', NULL, '2023-12-27 23:50:49', '2023-12-27 23:50:49'),
(3, 'dghfhfg', '1', '0', NULL, '2024-02-25 22:55:31', '2024-02-25 22:55:31'),
(4, 'নাস্তা খরচ', '1', '0', NULL, '2024-03-03 03:28:14', '2024-03-03 03:28:14');

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
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `status` varchar(10) DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `name`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Grass', '1', NULL, '2024-02-11 12:20:46', '2024-02-11 12:20:46'),
(2, 'Salt', '1', NULL, '2024-02-11 12:20:55', '2024-02-11 12:20:55'),
(3, 'Water', '1', NULL, '2024-02-11 12:21:02', '2024-02-11 12:21:02'),
(4, 'Khor', '1', NULL, '2024-03-03 03:50:06', '2024-03-03 03:50:06');

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `sell_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `due` decimal(10,2) DEFAULT NULL,
  `flag` varchar(10) DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incomes`
--

INSERT INTO `incomes` (`id`, `branch_id`, `sell_id`, `amount`, `due`, `flag`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 40000.00, 25000.00, '0', NULL, '2024-02-14 18:52:25', '2024-02-14 18:52:25'),
(2, 1, 3, 55.00, 480.00, '0', NULL, '2024-03-02 12:48:17', '2024-03-02 12:48:17'),
(3, 1, 4, 3434.00, 1.00, '0', NULL, '2024-03-02 12:51:36', '2024-03-02 12:51:36');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(2, '2014_10_12_000001_create_categories_table', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_12_23_105155_create_branches_table', 1),
(7, '2023_12_23_105156_create_staff_table', 1),
(8, '2023_12_24_123144_create_sessions_table', 1),
(9, '2023_12_24_180030_create_permission_tables', 1),
(10, '2023_12_25_061316_create_sheds_table', 1),
(11, '2023_12_25_061318_create_cows_table', 1),
(12, '2023_12_25_160821_create_buyers_table', 1),
(13, '2023_12_25_160822_create_cow_sells_table', 1),
(14, '2023_12_25_200246_create_milks_table', 1),
(15, '2023_12_26_134638_create_beefs_table', 1),
(16, '2023_12_26_181230_create_beef_sells_table', 1),
(17, '2023_12_27_180413_create_expenses_table', 1),
(18, '2023_12_27_184808_create_costs_table', 1),
(19, '2023_12_28_180128_create_invoices_table', 1),
(20, '2023_12_29_005652_create_accounts_table', 1),
(21, '2023_12_29_035602_create_incomes_table', 1),
(22, '2023_12_31_030601_create_staff_salaries_table', 1),
(23, '2024_01_01_003925_create_milk_sells_table', 1),
(24, '2024_01_01_131610_create_semens_table', 1),
(25, '2024_01_01_131613_create_pregnancies_table', 1),
(26, '2024_01_02_151217_create_food_table', 1),
(27, '2024_01_02_171847_create_units_table', 1),
(28, '2024_02_04_162900_create_settings_table', 1),
(29, '2024_02_13_014546_create_cow_feeds_table', 2),
(30, '2024_02_13_050321_create_designations_table', 3),
(31, '2024_02_14_124630_create_vaccines_table', 4),
(32, '2024_02_14_144515_create_cow_vaccines_table', 5),
(33, '2024_02_14_165333_create_suppliers_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 4);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'user list', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(2, 'create user', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(3, 'edit user', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(4, 'delete user', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(5, 'role list', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(6, 'create role', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(7, 'edit role', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(8, 'delete role', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(9, 'account list', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(10, 'create account', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(11, 'edit account', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(12, 'delete account', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(13, 'beef list', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(14, 'create beef', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(15, 'edit beef', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(16, 'delete beef', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(17, 'beefsell list', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(18, 'create beefsell', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(19, 'edit beefsell', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(20, 'delete beefsell', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(21, 'branch list', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(22, 'create branch', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(23, 'edit branch', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(24, 'delete branch', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(25, 'buyer list', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(26, 'create buyer', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(27, 'edit buyer', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(28, 'delete buyer', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(29, 'category list', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(30, 'create category', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(31, 'edit category', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(32, 'delete category', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(33, 'cost list', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(34, 'create cost', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(35, 'edit cost', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(36, 'delete cost', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(37, 'cow list', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(38, 'create cow', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(39, 'edit cow', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(40, 'delete cow', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(41, 'cowsell list', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(42, 'create cowsell', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(43, 'edit cowsell', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(44, 'delete cowsell', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(45, 'expense list', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(46, 'create expense', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(47, 'edit expense', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(48, 'delete expense', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(49, 'food list', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(50, 'create food', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(51, 'edit food', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(52, 'delete food', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(53, 'income list', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(54, 'create income', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(55, 'edit income', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(56, 'delete income', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(57, 'invoice list', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(58, 'create invoice', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(59, 'edit invoice', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(60, 'delete invoice', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(61, 'milk list', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(62, 'create milk', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(63, 'edit milk', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(64, 'delete milk', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(65, 'milksell list', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(66, 'create milksell', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(67, 'edit milksell', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(68, 'delete milksell', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(69, 'pregnancy list', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(70, 'create pregnancy', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(71, 'edit pregnancy', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(72, 'delete pregnancy', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(73, 'semen list', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(74, 'create semen', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(75, 'edit semen', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(76, 'delete semen', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(77, 'staff list', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(78, 'create staff', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(79, 'edit staff', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(80, 'delete staff', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(81, 'staffsalary list', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(82, 'create staffsalary', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(83, 'edit staffsalary', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(84, 'delete staffsalary', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(85, 'unit list', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(86, 'create unit', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(87, 'edit unit', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17'),
(88, 'delete unit', 'web', '2024-02-11 12:03:17', '2024-02-11 12:03:17');

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
-- Table structure for table `poltis`
--

CREATE TABLE `poltis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `price` int(11) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `expense_type` int(11) DEFAULT NULL,
  `shed_id` bigint(20) UNSIGNED NOT NULL,
  `tag` varchar(200) DEFAULT NULL,
  `caste` varchar(200) DEFAULT NULL,
  `weight` varchar(200) DEFAULT NULL,
  `transport` int(11) DEFAULT NULL,
  `hasil` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `color` varchar(200) DEFAULT NULL,
  `buy_date` timestamp NULL DEFAULT NULL,
  `age` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT '1',
  `flag` varchar(10) DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `poltis`
--

INSERT INTO `poltis` (`id`, `branch_id`, `price`, `category_id`, `expense_type`, `shed_id`, `tag`, `caste`, `weight`, `transport`, `hasil`, `total`, `color`, `buy_date`, `age`, `description`, `status`, `flag`, `deleted_at`, `created_at`, `updated_at`) VALUES
(7, 1, 333, 11, 1, 5, '343', 'sfdsd', '334', 343, 34, 710, '343', '2024-03-27 18:00:00', '343', '34343', '1', '1', NULL, '2024-03-02 12:07:15', '2024-03-02 12:51:36'),
(8, 1, 555, 12, 1, 5, '555', '55', '555', 555, 555, 1665, '555', '2024-03-11 18:00:00', '555', '55', '1', '1', NULL, '2024-03-02 12:34:35', '2024-03-02 14:37:49');

-- --------------------------------------------------------

--
-- Table structure for table `polti_feeds`
--

CREATE TABLE `polti_feeds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `polti_tag` bigint(20) UNSIGNED NOT NULL,
  `shed_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `food_id` bigint(20) UNSIGNED NOT NULL,
  `food_quantity` varchar(250) DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `polti_sells`
--

CREATE TABLE `polti_sells` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `polti_id` bigint(20) UNSIGNED NOT NULL,
  `buyer_id` bigint(20) UNSIGNED NOT NULL,
  `price` int(11) DEFAULT NULL,
  `payment` int(11) DEFAULT NULL,
  `due` int(11) DEFAULT NULL,
  `sell_date` timestamp NULL DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `flag` varchar(10) DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `polti_sells`
--

INSERT INTO `polti_sells` (`id`, `branch_id`, `polti_id`, `buyer_id`, `price`, `payment`, `due`, `sell_date`, `description`, `status`, `flag`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, 1, 8, 4, 535, 55, 480, '2024-03-20 18:00:00', '555', '0', '0', NULL, '2024-03-02 12:48:17', '2024-03-02 12:48:17'),
(4, 1, 7, 3, 3435, 3434, 1, '2024-03-13 18:00:00', '343', NULL, '0', NULL, '2024-03-02 12:51:36', '2024-03-02 12:51:36');

-- --------------------------------------------------------

--
-- Table structure for table `pregnancies`
--

CREATE TABLE `pregnancies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `cow_id` bigint(20) UNSIGNED NOT NULL,
  `pregnancy_type` varchar(20) DEFAULT NULL,
  `semen_id` bigint(20) UNSIGNED NOT NULL,
  `push_date` timestamp NULL DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `semen_cost` int(11) DEFAULT NULL,
  `other_cost` int(11) DEFAULT NULL,
  `due` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT '1',
  `flag` int(11) DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2024-02-11 12:03:16', '2024-02-11 12:03:16'),
(4, 'create-buyer', 'web', '2024-02-25 22:21:13', '2024-02-25 22:21:13');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(25, 4),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1);

-- --------------------------------------------------------

--
-- Table structure for table `semens`
--

CREATE TABLE `semens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `status` varchar(10) DEFAULT '1',
  `flag` int(11) DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `semens`
--

INSERT INTO `semens` (`id`, `branch_id`, `name`, `status`, `flag`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'dsf', '1', 0, NULL, '2024-02-28 13:27:25', '2024-02-28 13:27:25');

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
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_name` varchar(250) DEFAULT NULL,
  `project_title` varchar(250) DEFAULT NULL,
  `project_logo` varchar(250) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sheds`
--

CREATE TABLE `sheds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `status` varchar(255) DEFAULT '1',
  `flag` int(11) DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sheds`
--

INSERT INTO `sheds` (`id`, `branch_id`, `name`, `description`, `status`, `flag`, `deleted_at`, `created_at`, `updated_at`) VALUES
(5, 1, 'Redss', 'nice', '1', 0, NULL, '2024-02-25 22:54:10', '2024-03-03 05:57:46'),
(6, 1, 'বাচ্চা', 'বাচ্চা বাচ্চা বাচ্চা বাচ্চা', '1', 0, NULL, '2024-03-02 14:38:38', '2024-03-02 14:38:38'),
(7, 1, 'লাল শেড', 'লাল শেড', '1', 0, NULL, '2024-03-03 05:56:08', '2024-03-03 05:56:08'),
(8, 1, 'কালো শেড', 'কালো শেড', '1', 0, NULL, '2024-03-03 05:56:20', '2024-03-03 05:56:20'),
(9, 1, 'বেগুনি শেড', 'বেগুনি শেড', '1', 0, NULL, '2024-03-03 05:56:48', '2024-03-03 05:56:48');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  `father_name` varchar(250) DEFAULT NULL,
  `mother_name` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `nid_no` varchar(250) DEFAULT NULL,
  `birth_certificate` varchar(250) DEFAULT NULL,
  `present_address` varchar(250) DEFAULT NULL,
  `permanent_address` varchar(250) DEFAULT NULL,
  `blood_group` varchar(25) DEFAULT NULL,
  `gender` varchar(25) DEFAULT NULL,
  `birth_date` timestamp NULL DEFAULT NULL,
  `staff_image` varchar(250) DEFAULT NULL,
  `status` varchar(10) DEFAULT '1',
  `flag` varchar(10) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_salaries`
--

CREATE TABLE `staff_salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `staff_id` bigint(20) UNSIGNED NOT NULL,
  `salary_date` timestamp NULL DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `paid_on` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_name` varchar(250) DEFAULT NULL,
  `company_name` varchar(250) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `adress` varchar(250) DEFAULT NULL,
  `supplier_image` varchar(250) DEFAULT NULL,
  `status` varchar(10) DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `branch_id`, `supplier_name`, `company_name`, `phone_number`, `email`, `adress`, `supplier_image`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 1, NULL, 'Bauer and Simpson Trading', '+1 (602) 7', 'jyjykuvyx@mailinator.com', NULL, 'supplierImage/5gNLEocECxyyyWbKCkuaBv5Ec8czqi26fMsD2ZWf.jpg', '1', NULL, '2024-02-14 11:10:35', '2024-02-14 11:10:35'),
(3, 1, NULL, 'Peters and Shepard Trading', '+1 (162) 337', 'cixugyluz@mailinator.com', NULL, 'supplierImage/lhwTmqdb017dtQtCdRidA2L4CphjY0EuRRhpBGsH.png', '1', NULL, '2024-02-14 11:11:59', '2024-02-14 11:11:59'),
(4, 1, 'Nyssa Wilkins', 'Price Austin Traders', '+1 (8', 'wami@mailinator.com', NULL, 'supplierImage/KmEAfZ4ckKRWeiMg1XeCdQKbUowvZqwgYcxb2wcx.jpg', '1', NULL, '2024-02-14 11:12:25', '2024-02-14 11:12:25'),
(5, 1, 'Ashik Iqbal', 'Isbah It', '01811496472', 'demo@gmail.com', NULL, NULL, '1', NULL, '2024-02-14 18:47:25', '2024-02-14 18:47:25'),
(6, 1, 'pothik', 'bd', '01911228752', 'demo@gmail.com', NULL, NULL, '1', NULL, '2024-02-14 18:48:16', '2024-02-14 18:48:16');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `status` varchar(10) DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'kg', '1', NULL, '2024-02-11 12:21:13', '2024-02-11 12:21:13'),
(2, 'gram', '1', NULL, '2024-02-11 12:21:24', '2024-02-11 12:21:24'),
(3, 'Liter', '1', NULL, '2024-03-03 03:50:26', '2024-03-03 03:50:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT '1',
  `role` varchar(50) DEFAULT NULL,
  `flag` varchar(10) DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `email_verified_at`, `password`, `status`, `role`, `flag`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '01713617913', NULL, '$2y$12$BWb9qD6gD4wJv9jbCFsUFOYkTbYO83x5z8APvqppDLyoaWx8STt9W', '1', 'admin', '0', NULL, '2024-02-11 12:03:16', NULL),
(2, 'Super Admin', 'superadmin@gmail.com', '01613617913', NULL, '$2y$12$BWb9qD6gD4wJv9jbCFsUFOYkTbYO83x5z8APvqppDLyoaWx8STt9W', '1', 'super-admin', '0', NULL, '2024-02-11 12:03:16', NULL),
(4, 'Munna', 'programmermunna@gmail.com', '+8801938031025', NULL, '$2y$12$AYQFO0SHre0qWY9.h0iWRuHTSpfx9uWhR0XqbQvjbjW.ZrmTZ/aFC', '1', 'admin', '0', NULL, '2024-03-03 03:24:20', '2024-03-03 03:24:20');

-- --------------------------------------------------------

--
-- Table structure for table `vaccines`
--

CREATE TABLE `vaccines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `period_days` varchar(250) DEFAULT NULL,
  `repeat_vaccine` varchar(50) DEFAULT NULL,
  `dose_qty` varchar(150) DEFAULT NULL,
  `note` varchar(150) DEFAULT NULL,
  `status` varchar(1) DEFAULT '1',
  `flag` int(11) DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vaccines`
--

INSERT INTO `vaccines` (`id`, `name`, `slug`, `period_days`, `repeat_vaccine`, `dose_qty`, `note`, `status`, `flag`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 'BDX', 'bdx', '90', 'yes', 'i hour', 'push in morning', '1', 0, NULL, NULL, '2024-02-14 07:28:22', '2024-02-14 07:28:22'),
(3, 'BJD', 'bjd', '65', 'yes', '1 table', 'good', '1', 0, 1, NULL, '2024-02-14 08:17:55', '2024-02-14 08:17:55'),
(4, 'XXX', 'xxx', '365', 'yes', '1', 'ঘাড়ের উপর ইঞ্জেক্ট করতে হবে ।', '1', 0, 1, NULL, '2024-03-03 03:51:49', '2024-03-03 03:52:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accounts_branch_id_foreign` (`branch_id`),
  ADD KEY `accounts_expense_type_foreign` (`expense_type`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buyers`
--
ALTER TABLE `buyers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buyers_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `costs`
--
ALTER TABLE `costs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `costs_branch_id_foreign` (`branch_id`),
  ADD KEY `costs_expense_type_foreign` (`expense_type`);

--
-- Indexes for table `cow_vaccines`
--
ALTER TABLE `cow_vaccines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cow_vaccines_branch_id_foreign` (`branch_id`),
  ADD KEY `cow_vaccines_cow_tag_foreign` (`cow_tag`),
  ADD KEY `cow_vaccines_shed_id_foreign` (`shed_id`),
  ADD KEY `cow_vaccines_vaccine_id_foreign` (`vaccine_id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incomes_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `poltis`
--
ALTER TABLE `poltis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cows_branch_id_foreign` (`branch_id`),
  ADD KEY `cows_category_id_foreign` (`category_id`),
  ADD KEY `cows_shed_id_foreign` (`shed_id`);

--
-- Indexes for table `polti_feeds`
--
ALTER TABLE `polti_feeds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cow_feeds_branch_id_foreign` (`branch_id`),
  ADD KEY `cow_feeds_cow_tag_foreign` (`polti_tag`),
  ADD KEY `cow_feeds_shed_id_foreign` (`shed_id`),
  ADD KEY `cow_feeds_food_id_foreign` (`food_id`),
  ADD KEY `cow_feeds_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `polti_sells`
--
ALTER TABLE `polti_sells`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cow_sells_branch_id_foreign` (`branch_id`),
  ADD KEY `cow_sells_cow_id_foreign` (`polti_id`),
  ADD KEY `cow_sells_buyer_id_foreign` (`buyer_id`);

--
-- Indexes for table `pregnancies`
--
ALTER TABLE `pregnancies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pregnancies_branch_id_foreign` (`branch_id`),
  ADD KEY `pregnancies_cow_id_foreign` (`cow_id`),
  ADD KEY `pregnancies_semen_id_foreign` (`semen_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `semens`
--
ALTER TABLE `semens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `semens_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sheds`
--
ALTER TABLE `sheds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sheds_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `staff_salaries`
--
ALTER TABLE `staff_salaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_salaries_branch_id_foreign` (`branch_id`),
  ADD KEY `staff_salaries_staff_id_foreign` (`staff_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suppliers_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_number_unique` (`phone_number`);

--
-- Indexes for table `vaccines`
--
ALTER TABLE `vaccines`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `buyers`
--
ALTER TABLE `buyers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `costs`
--
ALTER TABLE `costs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cow_vaccines`
--
ALTER TABLE `cow_vaccines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poltis`
--
ALTER TABLE `poltis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `polti_feeds`
--
ALTER TABLE `polti_feeds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `polti_sells`
--
ALTER TABLE `polti_sells`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pregnancies`
--
ALTER TABLE `pregnancies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `semens`
--
ALTER TABLE `semens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sheds`
--
ALTER TABLE `sheds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_salaries`
--
ALTER TABLE `staff_salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vaccines`
--
ALTER TABLE `vaccines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accounts_expense_type_foreign` FOREIGN KEY (`expense_type`) REFERENCES `expenses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `buyers`
--
ALTER TABLE `buyers`
  ADD CONSTRAINT `buyers_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `costs`
--
ALTER TABLE `costs`
  ADD CONSTRAINT `costs_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `costs_expense_type_foreign` FOREIGN KEY (`expense_type`) REFERENCES `expenses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cow_vaccines`
--
ALTER TABLE `cow_vaccines`
  ADD CONSTRAINT `cow_vaccines_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cow_vaccines_cow_tag_foreign` FOREIGN KEY (`cow_tag`) REFERENCES `poltis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cow_vaccines_shed_id_foreign` FOREIGN KEY (`shed_id`) REFERENCES `sheds` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cow_vaccines_vaccine_id_foreign` FOREIGN KEY (`vaccine_id`) REFERENCES `vaccines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `incomes`
--
ALTER TABLE `incomes`
  ADD CONSTRAINT `incomes_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `poltis`
--
ALTER TABLE `poltis`
  ADD CONSTRAINT `cows_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cows_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cows_shed_id_foreign` FOREIGN KEY (`shed_id`) REFERENCES `sheds` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `polti_feeds`
--
ALTER TABLE `polti_feeds`
  ADD CONSTRAINT `cow_feeds_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cow_feeds_cow_tag_foreign` FOREIGN KEY (`polti_tag`) REFERENCES `poltis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cow_feeds_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cow_feeds_shed_id_foreign` FOREIGN KEY (`shed_id`) REFERENCES `sheds` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cow_feeds_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `polti_sells`
--
ALTER TABLE `polti_sells`
  ADD CONSTRAINT `cow_sells_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cow_sells_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `buyers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cow_sells_cow_id_foreign` FOREIGN KEY (`polti_id`) REFERENCES `poltis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pregnancies`
--
ALTER TABLE `pregnancies`
  ADD CONSTRAINT `pregnancies_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pregnancies_cow_id_foreign` FOREIGN KEY (`cow_id`) REFERENCES `poltis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pregnancies_semen_id_foreign` FOREIGN KEY (`semen_id`) REFERENCES `semens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `semens`
--
ALTER TABLE `semens`
  ADD CONSTRAINT `semens_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sheds`
--
ALTER TABLE `sheds`
  ADD CONSTRAINT `sheds_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff_salaries`
--
ALTER TABLE `staff_salaries`
  ADD CONSTRAINT `staff_salaries_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `staff_salaries_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

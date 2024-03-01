-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 29, 2023 at 09:59 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `impex-agro-farm`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint UNSIGNED NOT NULL,
  `buy_id` int NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `expense_type` bigint UNSIGNED NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `flag` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `buy_id`, `branch_id`, `expense_type`, `amount`, `flag`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 22000.00, '0', NULL, '2023-12-28 20:52:00', '2023-12-28 21:34:31'),
(2, 2, 1, 1, 31000.00, '0', NULL, '2023-12-28 20:53:02', '2023-12-28 21:35:36'),
(3, 3, 1, 1, 31500.00, '0', NULL, '2023-12-28 20:53:55', '2023-12-28 21:33:41'),
(4, 4, 1, 1, 44000.00, '0', NULL, '2023-12-28 21:38:42', '2023-12-28 21:38:42'),
(5, 5, 1, 1, 44760.00, '0', NULL, '2023-12-29 16:03:11', '2023-12-29 16:03:11'),
(6, 6, 1, 1, 24000.00, '0', NULL, '2023-12-29 16:04:18', '2023-12-29 16:04:18'),
(7, 7, 1, 1, 31100.00, '0', NULL, '2023-12-29 16:05:01', '2023-12-29 16:05:01'),
(8, 8, 1, 1, 34500.00, '0', NULL, '2023-12-29 16:15:34', '2023-12-29 16:15:34'),
(9, 9, 1, 1, 21800.00, '0', NULL, '2023-12-29 16:16:42', '2023-12-29 16:16:42'),
(10, 10, 1, 1, 30800.00, '0', NULL, '2023-12-29 16:17:23', '2023-12-29 16:17:23'),
(11, 11, 1, 1, 41000.00, '0', NULL, '2023-12-29 16:18:07', '2023-12-29 16:18:07'),
(12, 12, 1, 1, 23600.00, '0', NULL, '2023-12-29 16:18:42', '2023-12-29 16:18:42');

-- --------------------------------------------------------

--
-- Table structure for table `beefs`
--

CREATE TABLE `beefs` (
  `id` bigint UNSIGNED NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `cow_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_beef` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `beefs`
--

INSERT INTO `beefs` (`id`, `branch_id`, `date`, `cow_id`, `total_beef`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-12-29 18:00:00', '5', '165', NULL, '2023-12-29 20:55:24', '2023-12-29 21:44:23');

-- --------------------------------------------------------

--
-- Table structure for table `beef_sells`
--

CREATE TABLE `beef_sells` (
  `id` bigint UNSIGNED NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int DEFAULT NULL,
  `payment` int DEFAULT NULL,
  `due` int DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `beef_sells`
--

INSERT INTO `beef_sells` (`id`, `branch_id`, `name`, `quantity`, `price`, `payment`, `due`, `phone_number`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Md. Nazmul Islam', '5', 650, 3000, 250, '01523617914', NULL, '2023-12-29 20:57:20', '2023-12-29 20:57:20'),
(2, 1, 'Jahid Islam', '11', 650, 7150, 0, '01523617914', NULL, '2023-12-29 21:05:45', '2023-12-29 21:59:12'),
(3, 1, 'Rahim Khan', '20', 650, 11000, 2000, '01523617914', NULL, '2023-12-29 21:44:23', '2023-12-29 21:48:28');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint UNSIGNED NOT NULL,
  `branch_name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_email` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_image` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `flag` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_name`, `slug`, `branch_email`, `branch_address`, `branch_image`, `status`, `flag`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Uttara', 'uttara', 'uttara@gmail.com', 'Uttara,Dhaka,Bangladesh', '1703407639.jpg', '1', '0', NULL, '2023-12-23 08:47:20', '2023-12-23 08:47:20'),
(2, 'Gazipur', 'gazipur', 'gazipur@gmail.com', 'Gazipur,Dhaka,Bangladesh', '1703407731.webp', '1', '0', NULL, '2023-12-23 08:48:51', '2023-12-23 08:48:51'),
(3, 'Malibagh', 'malibagh', 'malibagh@gmail.com', 'Malibagh,Dhaka,Bangladesh', '1703407822.jpg', '1', '0', NULL, '2023-12-23 08:50:22', '2023-12-23 08:50:22');

-- --------------------------------------------------------

--
-- Table structure for table `buyers`
--

CREATE TABLE `buyers` (
  `id` bigint UNSIGNED NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `flag` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buyers`
--

INSERT INTO `buyers` (`id`, `branch_id`, `name`, `phone_number`, `address`, `balance`, `status`, `flag`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Jahid Islam', '01513657914', 'Netrakona Boro Bazar', '0', '1', '0', NULL, '2023-12-28 21:36:35', '2023-12-28 21:36:35'),
(2, 1, 'Mosabbir Rahman', '01913617913', 'Segun Bagicha', '10000', '1', '0', NULL, '2023-12-28 21:37:06', '2023-12-28 21:37:06'),
(3, 1, 'Masum Billah', '01523617914', 'Nakalpara,Dhaka', '10000', '1', '0', NULL, '2023-12-28 21:37:30', '2023-12-28 21:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'গাভী', '1', NULL, '2023-12-25 12:49:58', '2023-12-28 05:54:12'),
(2, 'মহিষ', '1', NULL, '2023-12-25 12:50:23', '2023-12-28 05:53:28'),
(3, 'ষাড়', '1', NULL, '2023-12-25 12:50:42', '2023-12-28 05:53:52'),
(4, 'ভেড়া', '1', NULL, '2023-12-25 12:50:59', '2023-12-28 05:54:20'),
(5, 'ছাগল', '1', NULL, '2023-12-25 12:51:06', '2023-12-28 05:54:02'),
(6, 'বাছুর', '1', NULL, '2023-12-28 13:20:29', '2023-12-28 13:20:29');

-- --------------------------------------------------------

--
-- Table structure for table `costs`
--

CREATE TABLE `costs` (
  `id` bigint UNSIGNED NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expense_type` bigint UNSIGNED NOT NULL,
  `cost_amount` decimal(10,2) DEFAULT NULL,
  `cost_date` timestamp NULL DEFAULT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `flag` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `costs`
--

INSERT INTO `costs` (`id`, `branch_id`, `name`, `expense_type`, `cost_amount`, `cost_date`, `description`, `status`, `flag`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'গরুর খাবার', 1, 2000.00, '2023-12-25 18:00:00', 'গরুর ভুষি ১৫ কেজি (সর্দার ম্যানসন)', '1', '0', NULL, '2023-12-28 20:56:15', '2023-12-28 20:57:13'),
(2, 1, 'শেডের টিন', 2, 5000.00, '2023-12-17 18:00:00', 'গরুর শেডের ৫ বান টিন (মোরগ মার্কা)', '1', '0', NULL, '2023-12-28 20:58:19', '2023-12-28 21:01:01'),
(3, 1, 'শেডের লোহা,রড', 2, 5000.00, '2023-12-27 18:00:00', 'লোহা ১৫ কেজি,রড ৫ মণ (মেসার্স রহমান ট্রেডার্স)', '1', '0', NULL, '2023-12-28 20:59:58', '2023-12-28 21:50:49');

-- --------------------------------------------------------

--
-- Table structure for table `cows`
--

CREATE TABLE `cows` (
  `id` bigint UNSIGNED NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `price` int DEFAULT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `tag` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caste` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transport` int DEFAULT NULL,
  `hasil` int DEFAULT NULL,
  `total` int DEFAULT NULL,
  `color` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buy_date` timestamp NULL DEFAULT NULL,
  `age` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `flag` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cows`
--

INSERT INTO `cows` (`id`, `branch_id`, `price`, `category_id`, `tag`, `caste`, `weight`, `transport`, `hasil`, `total`, `color`, `buy_date`, `age`, `description`, `status`, `flag`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 21000, 1, 'GF45BMN', 'Physian', '76', 500, 500, 22000, 'Red Yellow', '2023-12-25 18:00:00', '1', 'This is red cow', '1', '1', NULL, '2023-12-28 20:52:00', '2023-12-28 22:09:56'),
(2, 1, 30000, 3, 'Y7654UY', 'Australian', '120', 500, 500, 31000, 'Black', '2023-12-26 18:00:00', '1', 'This Black Bull', '1', '1', NULL, '2023-12-28 20:53:01', '2023-12-28 22:17:23'),
(3, 1, 30500, 1, 'GF65UY', 'Physian', '98', 500, 500, 31500, 'Red', '2023-12-28 18:00:00', '2', 'This red bull', '1', '0', NULL, '2023-12-28 20:53:55', '2023-12-28 21:33:41'),
(4, 1, 43000, 3, '45GF23', 'Physian', '76', 400, 600, 44000, 'Red', '2023-12-24 18:00:00', '1', 'This is physian cow', '1', '0', NULL, '2023-12-28 21:38:42', '2023-12-28 21:38:42'),
(5, 1, 43760, 1, 'HJ654N', 'Physian', '12', 500, 500, 44760, 'Red', '2023-12-26 18:00:00', '1', 'This is Calf', '1', '1', NULL, '2023-12-29 16:03:10', '2023-12-29 16:03:10'),
(6, 1, 23000, 2, 'GF%6445', 'Physian', '70', 500, 500, 24000, 'Maroon', '2023-12-03 18:00:00', '1', 'This is buffalo', '1', '0', NULL, '2023-12-29 16:04:18', '2023-12-29 16:04:18'),
(7, 1, 30000, 3, 'GH67JG', 'Australian', '65', 600, 500, 31100, 'Black', '2023-12-07 18:00:00', '1', 'sddfssgfsdf', '1', '1', NULL, '2023-12-29 16:05:01', '2023-12-29 20:11:48'),
(8, 1, 33500, 1, 'KDY6549VD', 'Physian', '75', 500, 500, 34500, 'Red Yellow', '2023-12-25 18:00:00', '1', 'DFDSFGDGFDGHFDH', '1', '0', NULL, '2023-12-29 16:15:34', '2023-12-29 16:15:34'),
(9, 1, 21000, 6, 'LK987GF', 'Physian', '45', 500, 300, 21800, 'Red', '2023-12-17 18:00:00', '1', 'DFDSDSGFGGF', '1', '0', NULL, '2023-12-29 16:16:42', '2023-12-29 16:16:42'),
(10, 1, 30000, 2, 'HG36DS', 'Physian', '56', 400, 400, 30800, 'Black', '2023-12-20 18:00:00', '1', 'FDSDSFTGDFFGFDG', '1', '0', NULL, '2023-12-29 16:17:23', '2023-12-29 16:17:23'),
(11, 1, 40000, 3, 'H78DF3G', 'Australian', '59', 500, 500, 41000, 'Red Yellow', '2023-12-25 18:00:00', '1', 'FDGDFDGFG', '1', '0', NULL, '2023-12-29 16:18:07', '2023-12-29 16:18:07'),
(12, 1, 23000, 6, 'GF%6445', 'Physian', '45', 300, 300, 23600, 'Maroon', '2023-12-06 18:00:00', '1', 'GFDGHRTTYUTU', '1', '0', NULL, '2023-12-29 16:18:42', '2023-12-29 16:18:42');

-- --------------------------------------------------------

--
-- Table structure for table `cow_sells`
--

CREATE TABLE `cow_sells` (
  `id` bigint UNSIGNED NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `cow_id` bigint UNSIGNED NOT NULL,
  `buyer_id` bigint UNSIGNED NOT NULL,
  `price` int DEFAULT NULL,
  `payment` int DEFAULT NULL,
  `due` int DEFAULT NULL,
  `sell_date` timestamp NULL DEFAULT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cow_sells`
--

INSERT INTO `cow_sells` (`id`, `branch_id`, `cow_id`, `buyer_id`, `price`, `payment`, `due`, `sell_date`, `description`, `status`, `flag`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, 50000, 50000, 0, '2023-12-17 18:00:00', 'This is red cow', '1', '0', NULL, '2023-12-28 22:09:56', '2023-12-29 20:48:38'),
(2, 1, 2, 1, 70000, 70000, 0, '2023-12-24 18:00:00', 'This Black Bull', '0', '0', NULL, '2023-12-28 22:17:23', '2023-12-28 22:17:23'),
(3, 1, 7, 2, 80000, 70000, 10000, '2023-12-24 18:00:00', 'This is Red Cow', '1', '0', NULL, '2023-12-29 20:11:48', '2023-12-29 20:11:48');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `flag` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `name`, `status`, `flag`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'ফার্ম খরচ', '1', '0', NULL, '2023-12-28 05:50:31', '2023-12-28 05:50:31'),
(2, 'স্থায়ী খরচ', '1', '0', NULL, '2023-12-28 05:50:49', '2023-12-28 05:50:49');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` bigint UNSIGNED NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `sell_id` int DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `due` decimal(10,2) DEFAULT NULL,
  `flag` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incomes`
--

INSERT INTO `incomes` (`id`, `branch_id`, `sell_id`, `amount`, `due`, `flag`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 50000.00, 0.00, '0', NULL, '2023-12-28 22:09:56', '2023-12-29 20:48:38'),
(2, 1, 2, 70000.00, 0.00, '0', NULL, '2023-12-28 22:17:23', '2023-12-28 22:17:23'),
(3, 1, 3, 70000.00, 10000.00, '0', NULL, '2023-12-29 20:11:48', '2023-12-29 20:11:48');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint UNSIGNED NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `invoice_id` int DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
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
(10, '2023_12_25_061318_create_cows_table', 1),
(11, '2023_12_25_160821_create_buyers_table', 1),
(12, '2023_12_25_160822_create_cow_sells_table', 1),
(13, '2023_12_25_200246_create_milks_table', 1),
(14, '2023_12_26_134638_create_beefs_table', 1),
(15, '2023_12_26_181230_create_beef_sells_table', 1),
(16, '2023_12_27_180413_create_expenses_table', 1),
(17, '2023_12_27_184808_create_costs_table', 1),
(18, '2023_12_28_180128_create_invoices_table', 1),
(19, '2023_12_29_005652_create_accounts_table', 1),
(20, '2023_12_29_035602_create_incomes_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `milks`
--

CREATE TABLE `milks` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'user list', 'web', '2023-12-28 20:48:52', '2023-12-28 20:48:52'),
(2, 'create user', 'web', '2023-12-28 20:48:53', '2023-12-28 20:48:53'),
(3, 'edit user', 'web', '2023-12-28 20:48:53', '2023-12-28 20:48:53'),
(4, 'delete user', 'web', '2023-12-28 20:48:53', '2023-12-28 20:48:53'),
(5, 'role list', 'web', '2023-12-28 20:48:53', '2023-12-28 20:48:53'),
(6, 'create role', 'web', '2023-12-28 20:48:53', '2023-12-28 20:48:53'),
(7, 'edit role', 'web', '2023-12-28 20:48:53', '2023-12-28 20:48:53'),
(8, 'delete role', 'web', '2023-12-28 20:48:53', '2023-12-28 20:48:53');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2023-12-28 20:48:52', '2023-12-28 20:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
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
(8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint UNSIGNED NOT NULL,
  `branch_id` bigint UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_no` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_certificate` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_group` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` timestamp NULL DEFAULT NULL,
  `staff_image` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `flag` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `role` int DEFAULT NULL,
  `flag` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_number`, `email_verified_at`, `password`, `status`, `role`, `flag`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '01713617913', NULL, '$2y$12$V.1B606g7WBT0P0/T74JsuXp1IZ/mXdtHgh/6jqCAidJZq/aA0Nma', '1', NULL, '0', NULL, '2023-12-28 20:48:52', NULL),
(2, 'Super Admin', 'superadmin@gmail.com', '01613617913', NULL, '$2y$12$V.1B606g7WBT0P0/T74JsuXp1IZ/mXdtHgh/6jqCAidJZq/aA0Nma', '1', NULL, '0', NULL, '2023-12-28 20:48:52', NULL);

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
-- Indexes for table `beefs`
--
ALTER TABLE `beefs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beefs_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `beef_sells`
--
ALTER TABLE `beef_sells`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beef_sells_branch_id_foreign` (`branch_id`);

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
-- Indexes for table `cows`
--
ALTER TABLE `cows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cows_branch_id_foreign` (`branch_id`),
  ADD KEY `cows_category_id_foreign` (`category_id`);

--
-- Indexes for table `cow_sells`
--
ALTER TABLE `cow_sells`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cow_sells_branch_id_foreign` (`branch_id`),
  ADD KEY `cow_sells_cow_id_foreign` (`cow_id`),
  ADD KEY `cow_sells_buyer_id_foreign` (`buyer_id`);

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
-- Indexes for table `milks`
--
ALTER TABLE `milks`
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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_branch_id_foreign` (`branch_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_number_unique` (`phone_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `beefs`
--
ALTER TABLE `beefs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `beef_sells`
--
ALTER TABLE `beef_sells`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `buyers`
--
ALTER TABLE `buyers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `costs`
--
ALTER TABLE `costs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cows`
--
ALTER TABLE `cows`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cow_sells`
--
ALTER TABLE `cow_sells`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `milks`
--
ALTER TABLE `milks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Constraints for table `beefs`
--
ALTER TABLE `beefs`
  ADD CONSTRAINT `beefs_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `beef_sells`
--
ALTER TABLE `beef_sells`
  ADD CONSTRAINT `beef_sells_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `cows`
--
ALTER TABLE `cows`
  ADD CONSTRAINT `cows_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cows_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cow_sells`
--
ALTER TABLE `cow_sells`
  ADD CONSTRAINT `cow_sells_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cow_sells_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `buyers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cow_sells_cow_id_foreign` FOREIGN KEY (`cow_id`) REFERENCES `cows` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

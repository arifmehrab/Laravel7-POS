-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2020 at 07:44 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Walton Laptop', 1, 1, NULL, '2020-04-25 11:29:47', '2020-04-25 11:29:47'),
(2, 'Walton Mobile', 1, 1, NULL, '2020-04-25 11:29:58', '2020-04-25 11:29:58'),
(3, 'Walton LED TV', 1, 1, NULL, '2020-04-25 11:30:47', '2020-04-25 11:30:47'),
(4, 'Loper', 1, 1, NULL, '2020-04-25 11:31:32', '2020-04-25 11:31:32'),
(5, 'Shous', 1, 1, NULL, '2020-04-25 11:31:58', '2020-04-25 11:31:58'),
(9, 'Man\'s Collection', 1, 1, 1, '2020-04-25 11:34:33', '2020-04-25 11:47:55'),
(12, 'Chair', 1, 1, 1, '2020-04-25 11:36:36', '2020-04-25 11:48:43'),
(13, 'Baick', 1, 1, NULL, '2020-04-25 11:39:13', '2020-04-25 11:39:13'),
(14, 'Electronic', 1, 1, NULL, '2020-04-25 11:39:36', '2020-04-25 11:39:36'),
(15, 'Lav Michine', 1, 1, NULL, '2020-04-25 11:39:58', '2020-04-25 11:39:58'),
(16, 'Car', 1, 1, NULL, '2020-04-25 11:40:09', '2020-04-25 11:40:09');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `mobile`, `email`, `address`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'arifmehrab', '01871848137', 'arifmehrab11@gmail.com', 'Comilla', 1, 1, NULL, '2020-04-25 11:26:16', '2020-04-25 11:26:16'),
(2, 'SanaUllah', '01827924326', 'sanaUllah@gmail.com', 'Ctg', 1, 1, NULL, '2020-04-25 11:26:49', '2020-04-25 11:26:49'),
(3, 'muslim', '019742205563', 'muslim@gmail.com', 'Dhaka', 1, 1, NULL, '2020-04-25 11:27:19', '2020-04-25 11:27:19'),
(4, 'kabirSing', '97512126514', 'kabir@gmaill.com', 'india', 1, 1, NULL, '2020-04-25 11:27:54', '2020-04-25 11:27:54'),
(5, 'Kamal', '01795123042', 'kamal@gmail.com', 'Feni', 1, NULL, NULL, '2020-04-25 12:28:44', '2020-04-25 12:28:44');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0==pending, 1==approved',
  `created_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_no`, `date`, `description`, `status`, `created_by`, `approved_by`, `created_at`, `updated_at`) VALUES
(1, '1', '2020-04-24', 'Test Purpose', 1, 1, 1, '2020-04-25 12:24:40', '2020-04-25 12:26:21'),
(2, '2', '2020-04-25', 'Test Purpose', 1, 1, 1, '2020-04-25 12:28:44', '2020-04-25 12:29:22'),
(3, '3', '2020-04-24', 'Test Purpose', 1, 1, 1, '2020-04-25 12:31:07', '2020-04-25 12:31:28'),
(4, '4', '2020-04-24', 'Test Purpose', 1, 1, 1, '2020-04-25 12:34:42', '2020-04-25 12:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `invoice_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `selling_qty` double NOT NULL,
  `unit_price` double NOT NULL,
  `selling_price` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `date`, `invoice_id`, `category_id`, `product_id`, `selling_qty`, `unit_price`, `selling_price`, `status`, `created_at`, `updated_at`) VALUES
(1, '2020-04-24', 1, 1, 1, 20, 60000, 1200000, 1, '2020-04-25 12:24:40', '2020-04-25 12:26:21'),
(2, '2020-04-24', 1, 1, 2, 10, 100000, 1000000, 1, '2020-04-25 12:24:40', '2020-04-25 12:26:21'),
(3, '2020-04-25', 2, 9, 8, 100, 250, 25000, 1, '2020-04-25 12:28:44', '2020-04-25 12:29:22'),
(4, '2020-04-24', 3, 9, 10, 20, 2000, 40000, 1, '2020-04-25 12:31:07', '2020-04-25 12:31:28'),
(5, '2020-04-24', 3, 9, 9, 50, 1500, 75000, 1, '2020-04-25 12:31:07', '2020-04-25 12:31:28'),
(6, '2020-04-24', 4, 12, 12, 10, 10000, 100000, 1, '2020-04-25 12:34:42', '2020-04-25 12:35:02'),
(7, '2020-04-24', 4, 12, 11, 10, 5000, 50000, 1, '2020-04-25 12:34:42', '2020-04-25 12:35:02');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2020_04_03_225457_users', 1),
(6, '2020_04_05_085411_create_units_table', 4),
(8, '2020_04_05_234006_create_categories_table', 5),
(9, '2020_04_05_054029_create_suppliers_table', 6),
(10, '2020_04_05_075216_create_customers_table', 7),
(11, '2020_04_06_055936_create_products_table', 8),
(14, '2020_04_08_072202_create_purchases_table', 9),
(15, '2020_04_12_225204_create_invoices_table', 10),
(16, '2020_04_12_225326_create_invoice_details_table', 10),
(17, '2020_04_12_225401_create_payments_table', 10),
(18, '2020_04_12_225444_create_payment_details_table', 10);

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `paid_status` varchar(51) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_amount` double DEFAULT NULL,
  `due_amount` double DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `discount_amount` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `invoice_id`, `customer_id`, `paid_status`, `paid_amount`, `due_amount`, `total_amount`, `discount_amount`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Partical_paid', 200000, 1999000, 2199000, 1000, '2020-04-25 12:24:40', '2020-04-25 12:24:40'),
(2, 2, 5, 'full_paid', 24000, 0, 24000, 1000, '2020-04-25 12:28:44', '2020-04-25 12:28:44'),
(3, 3, 2, 'Partical_paid', 112000, 2000, 114000, 1000, '2020-04-25 12:31:07', '2020-04-25 12:39:49'),
(4, 4, 3, 'full_due', 0, 145000, 145000, 5000, '2020-04-25 12:34:42', '2020-04-25 12:34:42');

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `current_paid_amount` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`id`, `invoice_id`, `current_paid_amount`, `date`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 200000, '2020-04-24', NULL, '2020-04-25 12:24:40', '2020-04-25 12:24:40'),
(2, 2, 24000, '2020-04-25', NULL, '2020-04-25 12:28:44', '2020-04-25 12:28:44'),
(3, 3, 100000, '2020-04-24', NULL, '2020-04-25 12:31:07', '2020-04-25 12:31:07'),
(4, 4, 0, '2020-04-24', NULL, '2020-04-25 12:34:42', '2020-04-25 12:34:42'),
(5, 3, 10000, '2020-04-24', 1, '2020-04-25 12:38:53', '2020-04-25 12:38:53'),
(6, 3, 2000, '2020-04-25', 1, '2020-04-25 12:39:49', '2020-04-25 12:39:49');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `supplier_id`, `unit_id`, `category_id`, `name`, `quantity`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Core i5 7th Generation', '80', 1, 1, NULL, '2020-04-25 11:40:46', '2020-04-25 12:26:21'),
(2, 1, 1, 1, 'Core i7 8th Generation', '70', 1, 1, NULL, '2020-04-25 11:41:16', '2020-04-25 12:26:21'),
(3, 1, 1, 2, 'Walton Mobile 1042', '50', 1, 1, NULL, '2020-04-25 11:41:53', '2020-04-25 11:58:49'),
(4, 1, 1, 3, 'Walton LED TV', '300', 1, 1, NULL, '2020-04-25 11:42:38', '2020-04-25 12:00:32'),
(5, 2, 1, 4, 'Smart Loper in 2020', '120', 1, 1, NULL, '2020-04-25 11:43:46', '2020-04-25 12:13:25'),
(6, 2, 1, 5, 'All Type Shous', '100', 1, 1, NULL, '2020-04-25 11:44:36', '2020-04-25 12:13:36'),
(8, 3, 1, 9, 'T-shart', '400', 1, 1, NULL, '2020-04-25 11:49:08', '2020-04-25 12:29:22'),
(9, 3, 1, 9, 'Pants', '100', 1, 1, NULL, '2020-04-25 11:49:37', '2020-04-25 12:31:28'),
(10, 3, 1, 9, 'LADER JAKET', '500', 1, 1, NULL, '2020-04-25 11:49:58', '2020-04-25 12:31:28'),
(11, 5, 1, 12, 'Office Chair', '40', 1, 1, NULL, '2020-04-25 11:50:57', '2020-04-25 12:35:02'),
(12, 5, 1, 12, 'Gamming Chari', '70', 1, 1, NULL, '2020-04-25 11:51:21', '2020-04-25 12:35:02'),
(13, 4, 1, 13, 'R15', '0', 1, 1, NULL, '2020-04-25 11:52:12', '2020-04-25 11:52:12'),
(14, 4, 1, 13, 'FZ', '40', 1, 1, NULL, '2020-04-25 11:52:42', '2020-04-25 12:21:24'),
(15, 4, 1, 13, 'Discover', '30', 1, 1, NULL, '2020-04-25 11:53:08', '2020-04-25 12:21:16'),
(16, 4, 1, 16, 'BMW', '0', 1, 1, NULL, '2020-04-25 11:53:54', '2020-04-25 11:53:54'),
(17, 5, 1, 14, 'Desktop', '40', 1, 1, NULL, '2020-04-25 11:54:39', '2020-04-25 12:21:44');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `purchase_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  `buying_qty` double NOT NULL,
  `unit_price` double NOT NULL,
  `buying_price` double NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0==pending, 1==approved',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `supplier_id`, `category_id`, `product_id`, `purchase_no`, `date`, `buying_qty`, `unit_price`, `buying_price`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '#01A', '2020-04-24', 100, 45000, 4500000, 'Test Purpose', 1, 1, NULL, '2020-04-25 11:56:38', '2020-04-25 11:56:38'),
(2, 1, 1, 2, '#01A', '2020-04-24', 80, 80000, 6400000, 'Test Purpose', 1, 1, NULL, '2020-04-25 11:56:38', '2020-04-25 11:56:38'),
(3, 1, 2, 3, '#02B', '2020-04-23', 50, 2000, 100000, 'Test Purpose', 1, 1, NULL, '2020-04-25 11:57:20', '2020-04-25 11:57:20'),
(4, 1, 3, 4, '#03C', '2020-04-22', 200, 10000, 2000000, 'Test Purpose', 1, 1, NULL, '2020-04-25 11:57:53', '2020-04-25 11:57:53'),
(5, 1, 3, 4, '#012E', '2020-04-25', 100, 5000, 500000, 'Test Purpose', 1, 1, NULL, '2020-04-25 11:59:48', '2020-04-25 11:59:48'),
(6, 2, 5, 6, '#123D', '2020-04-26', 100, 1200, 120000, 'Test Purpose', 1, 1, NULL, '2020-04-25 12:12:54', '2020-04-25 12:12:54'),
(7, 2, 4, 5, '#123D', '2020-04-26', 120, 800, 96000, 'Test Purpose', 1, 1, NULL, '2020-04-25 12:12:54', '2020-04-25 12:12:54'),
(8, 3, 9, 8, '#@12E', '2020-04-24', 500, 80, 40000, 'Test Purpose', 1, 1, NULL, '2020-04-25 12:15:23', '2020-04-25 12:15:23'),
(9, 3, 9, 9, '#@12E', '2020-04-24', 150, 1500, 225000, 'Test Purpose', 1, 1, NULL, '2020-04-25 12:15:23', '2020-04-25 12:15:23'),
(10, 3, 9, 10, '#@12E', '2020-04-24', 520, 1200, 624000, 'Test Purpose', 1, 1, NULL, '2020-04-25 12:15:23', '2020-04-25 12:15:23'),
(11, 4, 13, 13, '@#895MN', '2020-04-29', 50, 150000, 7500000, 'Test Purpose', 0, 1, NULL, '2020-04-25 12:17:21', '2020-04-25 12:17:21'),
(12, 4, 13, 14, '@#895MN', '2020-04-29', 40, 170000, 6800000, 'Test Purpose', 1, 1, NULL, '2020-04-25 12:17:21', '2020-04-25 12:17:21'),
(13, 4, 13, 15, '@#895MN', '2020-04-29', 30, 50000, 1500000, 'Test Purpose', 1, 1, NULL, '2020-04-25 12:17:21', '2020-04-25 12:17:21'),
(14, 4, 16, 16, '#L54', '2020-04-25', 5, 50000000, 250000000, 'Test Purpose', 0, 1, NULL, '2020-04-25 12:19:01', '2020-04-25 12:19:01'),
(15, 5, 12, 11, '#RT3', '2020-04-30', 50, 5000, 250000, 'Test Purpose', 1, 1, NULL, '2020-04-25 12:19:59', '2020-04-25 12:19:59'),
(16, 5, 12, 12, '#RT3', '2020-04-30', 80, 10000, 800000, 'Test Purpose', 1, 1, NULL, '2020-04-25 12:19:59', '2020-04-25 12:19:59'),
(17, 5, 14, 17, '#FF45', '2020-04-25', 40, 15000, 600000, 'Test Purpose', 1, 1, NULL, '2020-04-25 12:20:46', '2020-04-25 12:20:46');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `mobile`, `email`, `address`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'walton Company In BD', '01871848137', 'walton@gmail.com', 'Dhaka, Danmonddi', 1, 1, NULL, '2020-04-25 11:20:57', '2020-04-25 11:20:57'),
(2, 'Apex', '0187569852', 'apex@gmail.com', 'Feni Branch', 1, 1, NULL, '2020-04-25 11:22:04', '2020-04-25 11:22:04'),
(3, 'Easy Brand', '01874962412', 'easy@gmail.com', 'Dhaka , Mohammadfur', 1, 1, NULL, '2020-04-25 11:23:06', '2020-04-25 11:23:06'),
(4, 'Amazon', '01879451571', 'amazon@gmail.com', 'All over the word', 1, 1, NULL, '2020-04-25 11:24:58', '2020-04-25 11:24:58'),
(5, 'Daraz', '0187946213', 'daraz@gmail.com', 'Daraz In BD', 1, 1, NULL, '2020-04-25 11:25:44', '2020-04-25 11:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `status`, `created_by`, `update_by`, `created_at`, `updated_at`) VALUES
(1, 'PICE', 1, 1, 1, '2020-04-25 11:28:22', '2020-04-25 11:28:22'),
(2, 'KG', 1, 1, 1, '2020-04-25 11:28:29', '2020-04-25 11:28:29'),
(3, 'GRAM', 1, 1, 1, '2020-04-25 11:28:42', '2020-04-25 11:28:42'),
(4, 'LITTER', 1, 1, 1, '2020-04-25 11:28:51', '2020-04-25 11:28:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userRole` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shopName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userRole`, `name`, `email`, `password`, `number`, `shopName`, `address`, `profile`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'arifmehrab', 'arifmehrab11@gmail.com', '$2y$10$dPhAtVK6m3OR.zxcszpouemm5lYMcV4K9r11t8T.ycdfKiM6SozkO', '5454584874874', 'CodingSolve', 'Dhaka Mohammadfur', '1586042177IMG_20190614_163903.jpg', '2020-04-04 06:03:13', '2020-04-05 14:09:01'),
(7, 'user', 'php', 'phpjava@gmail.com', '$2y$10$OIcwJAO2NDJ9byejKniJsuyJ.TI8AamTyBQXkg1kzZGlzf6uWmeiq', '0174852', 'Bd Shop', 'Dhaka Mohammadfur', '1585981247defoult.jpg', '2020-04-04 13:20:47', '2020-04-05 05:45:48'),
(9, 'user', 'user', 'user@gmail.com', '$2y$10$DQMMgqSiJAQc9JYAL2RqJ.Rjbg0TllfaUYGtqq4hRTECxlz0J08I2', '01827924326', 'Daraz', 'Dhaka', '1586036975defoult.jpg', '2020-04-05 04:49:35', '2020-04-05 04:49:35'),
(10, 'admin', 'arifmehrab khan', 'arifkhan@gmail.com', '$2y$10$kc68TAvJyO7Q7JeduXdG1OxH8cMPvzwWuBO1EVp8vAK51wtt0DweS', '2151478545145', 'CodingSolve', 'feni trtrt', '1586041794defoult.jpg', '2020-04-05 04:50:37', '2020-04-05 06:15:52'),
(11, 'admin', 'admin', 'admin@gmail.com', '$2y$10$wKksPCE/tBUuX0eYc5N4Zu0iU41ciFdfgnolRJE2HwmEbESDkjlYy', '01487521', 'Coding owne', 'Feni', '1586043620IMG_20190726_210319.jpg', '2020-04-05 06:40:21', '2020-04-05 06:40:21'),
(12, 'user', 'mamager', 'manager@gmail.com', '$2y$10$PC8.TeNCa0ORJ03N1gh2Rup9ewysdggBhNw.e76jZc6oo4SzhgaNi', '0147852', 'Coding owne', 'Feni', '1586074036IMG_20190726_210319.jpg', '2020-04-05 15:07:16', '2020-04-05 15:07:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

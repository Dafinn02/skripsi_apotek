-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 26, 2024 at 05:05 AM
-- Server version: 10.6.16-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sumekar`
--

-- --------------------------------------------------------

--
-- Table structure for table `cashiers`
--

CREATE TABLE `cashiers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `number` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cashiers`
--

INSERT INTO `cashiers` (`id`, `user_id`, `number`, `name`, `address`, `phone`, `created_at`, `updated_at`) VALUES
(1, 2, '0012305567', 'Alfian Muhammad', ' Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141', '085608014234', NULL, NULL),
(2, 3, '0012305569', 'Deny Sumargo', ' Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141', '085608014239', NULL, NULL),
(3, 4, '0012305569', 'Billie Elish', ' Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141', '085608014238', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Obat Bebas', NULL, NULL),
(2, 'Obat Bebas Terbatas', NULL, NULL),
(3, 'Obat Keras', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'Andy Malarangin', '089786441234', NULL, NULL),
(2, 'Setias Mahatir', '089786441235', NULL, NULL),
(3, 'Hotman Paris', '089786441236', NULL, NULL);

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2024_03_06_070954_create_users_table', 1),
(3, '2024_03_06_070955_create_shifts_table', 1),
(4, '2024_03_06_070956_create_user_shift_sessions_table', 1),
(5, '2024_03_06_070957_create_cashiers_table', 1),
(6, '2024_03_06_071743_create_suppliers_table', 1),
(7, '2024_03_06_121914_create_categories_table', 1),
(8, '2024_03_11_153041_create_units_table', 1),
(9, '2024_03_11_153543_create_raks_table', 1),
(10, '2024_03_11_153615_create_warehouses_table', 1),
(11, '2024_03_12_071636_create_products_table', 1),
(12, '2024_03_16_163148_create_purchase_orders_table', 1),
(13, '2024_03_16_163149_create_purchase_order_items_table', 1),
(14, '2024_03_16_163159_create_warehouse_racks_table', 1),
(15, '2024_03_16_163160_create_customers_table', 1),
(16, '2024_03_16_163169_create_transactions_table', 1),
(17, '2024_03_16_163179_create_transaction_items_table', 1),
(18, '2024_03_16_163189_create_warehouse_rack_products_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `opname`
--

CREATE TABLE `opname` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `rack_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `type` enum('addition','subtraction') NOT NULL,
  `date` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `price` bigint(20) UNSIGNED NOT NULL,
  `active_zat` varchar(255) DEFAULT NULL,
  `power_shape` varchar(255) DEFAULT NULL,
  `min_stock` bigint(20) UNSIGNED DEFAULT NULL,
  `max_stock` bigint(20) UNSIGNED DEFAULT NULL,
  `stock` bigint(20) UNSIGNED DEFAULT NULL,
  `recipe` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `supplier_id`, `unit_id`, `category_id`, `price`, `active_zat`, `power_shape`, `min_stock`, `max_stock`, `stock`, `recipe`, `created_at`, `updated_at`) VALUES
(1, 'Paracetamol', 'PRC', 1, 1, 1, 15000, 'active zat 1', 'berat', 10, 100, 0, 'yes', NULL, NULL),
(2, 'Amoksilin', 'AMK', 2, 2, 2, 16000, 'active zat 1', 'berat', 10, 50, 0, 'no', NULL, NULL),
(3, 'Diapet', 'DPT', 3, 3, 3, 10000, 'active zat 1', 'ringan', 10, 50, 0, 'no', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `number_letter` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `payment_method` enum('cash','transfer') NOT NULL,
  `proof` varchar(255) DEFAULT NULL,
  `payment_due_date` date DEFAULT NULL,
  `grandtotal` bigint(20) UNSIGNED NOT NULL,
  `information` varchar(255) DEFAULT NULL,
  `status` enum('plan','order') NOT NULL DEFAULT 'plan',
  `distribution` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `user_id`, `number_letter`, `date`, `payment_method`, `proof`, `payment_due_date`, `grandtotal`, `information`, `status`, `distribution`, `created_at`, `updated_at`) VALUES
(3, 1, 'PO-1205932449', '2024-04-25', 'transfer', '664839046_proof_table.png', '2024-05-01', 3450000, 'testing', 'order', 1, '2024-04-24 20:02:25', '2024-04-24 21:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_items`
--

CREATE TABLE `purchase_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_order_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `qty` bigint(20) UNSIGNED NOT NULL,
  `price` varchar(255) NOT NULL,
  `subtotal` varchar(255) NOT NULL,
  `supplier_pic` varchar(255) DEFAULT NULL,
  `distribution` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_order_items`
--

INSERT INTO `purchase_order_items` (`id`, `purchase_order_id`, `supplier_id`, `product_id`, `unit_id`, `qty`, `price`, `subtotal`, `supplier_pic`, `distribution`, `created_at`, `updated_at`) VALUES
(12, 3, 1, 1, 5, 100, '15000', '1500000', 'Pak Hari', 1, '2024-04-24 20:03:45', '2024-04-24 20:03:45'),
(13, 3, 1, 2, 7, 100, '10000', '1000000', 'Pak Hari', 0, '2024-04-24 20:03:45', '2024-04-24 20:03:45'),
(14, 3, 2, 3, 11, 100, '5000', '500000', 'Bu Marni', 0, '2024-04-24 20:03:45', '2024-04-24 20:03:45'),
(15, 3, 3, 2, 4, 50, '9000', '450000', 'Pak Gilang', 0, '2024-04-24 20:03:45', '2024-04-24 20:03:45');

-- --------------------------------------------------------

--
-- Table structure for table `racks`
--

CREATE TABLE `racks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `racks`
--

INSERT INTO `racks` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Obat Botol', NULL, NULL),
(2, 'Obat Kaplet', NULL, NULL),
(3, 'Rak Box', '2024-04-24 22:05:47', NULL),
(4, 'Rak Dos', '2024-04-24 22:05:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `name`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(0, 'Admin Activity', NULL, NULL, NULL, NULL),
(1, 'Pagi', '07:30:00', '12:30:00', NULL, NULL),
(2, 'Siang', '12:40:00', '18:30:00', NULL, NULL),
(3, 'Malam', '18:40:00', '12:30:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `email`, `phone`, `pic`, `address`, `created_at`, `updated_at`) VALUES
(1, 'PT. ABC', 'abc@gmail.com', '08129956789', 'Bapak Alfian', 'Jl. ABC No. 1', NULL, NULL),
(2, 'PT. DEF', 'defpt@gmail.com', '08123454289', 'Bapak Budi', 'Jl. DEF No. 2', NULL, NULL),
(3, 'PT. GHI', 'ghipt@gmail.com', '08123456789', 'Bapak Candra', 'Jl. GHI No. 3', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shift_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(255) DEFAULT NULL,
  `service_cost` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `emblase_cost` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `shipping_cost` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `lainnya` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `discount_type` enum('fix_price','percentage') DEFAULT NULL,
  `discount` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `grandtotal` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `shift_id`, `date`, `customer_name`, `customer_phone`, `service_cost`, `emblase_cost`, `shipping_cost`, `lainnya`, `discount_type`, `discount`, `grandtotal`, `created_at`, `updated_at`) VALUES
(2, 1, 0, '2024-04-26', 'Ananda Pratama', '345345', 1000, 0, 0, 0, NULL, 0, 130000, '2024-04-25 19:04:52', NULL),
(3, 3, 1, '2024-04-26', 'Awang Syukri', '1235678854', 1000, 9000, 0, 0, NULL, 0, 85000, '2024-04-25 22:54:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_items`
--

CREATE TABLE `transaction_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_price` bigint(20) UNSIGNED NOT NULL,
  `qty` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_items`
--

INSERT INTO `transaction_items` (`id`, `transaction_id`, `product_name`, `product_code`, `product_price`, `qty`, `created_at`, `updated_at`) VALUES
(4, 2, 'Paracetamol', 'PRC', 15000, 1, '2024-04-25 19:04:52', '2024-04-25 19:04:52'),
(5, 2, 'Amoksilin', 'AMK', 16000, 4, '2024-04-25 19:04:52', '2024-04-25 19:04:52'),
(6, 2, 'Diapet', 'DPT', 10000, 5, '2024-04-25 19:04:52', '2024-04-25 19:04:52'),
(7, 3, 'Paracetamol', 'PRC', 15000, 5, '2024-04-25 22:54:49', '2024-04-25 22:54:49');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Ampul', NULL, NULL),
(2, 'Batang', NULL, NULL),
(3, 'Biji', NULL, NULL),
(4, 'Botol', NULL, NULL),
(5, 'Box', NULL, NULL),
(6, 'Buah', NULL, NULL),
(7, 'Bungkus', NULL, NULL),
(8, 'Butir', NULL, NULL),
(9, 'cc', NULL, NULL),
(10, 'cm', NULL, NULL),
(11, 'Dosin', NULL, NULL),
(12, 'DUS', NULL, NULL),
(13, 'Flakon', NULL, NULL),
(14, 'Fls', NULL, NULL),
(15, 'Galon', NULL, NULL),
(16, 'gram', NULL, NULL),
(17, 'Ikat', NULL, NULL),
(18, 'Iris', NULL, NULL),
(19, 'Kaleng', NULL, NULL),
(20, 'Kapsul', NULL, NULL),
(21, 'Karton', NULL, NULL),
(22, 'Karung', NULL, NULL),
(23, 'kg', NULL, NULL),
(24, 'Kotak', NULL, NULL),
(25, 'L', NULL, NULL),
(26, 'Lembar', NULL, NULL),
(27, 'm', NULL, NULL),
(28, 'mg', NULL, NULL),
(29, 'mL', NULL, NULL),
(30, 'mm', NULL, NULL),
(31, 'Pcs', NULL, NULL),
(32, 'Plabot', NULL, NULL),
(33, 'Pot', NULL, NULL),
(34, 'Pound', NULL, NULL),
(35, 'Sachet', NULL, NULL),
(36, 'Satuan', NULL, NULL),
(37, 'Sloki', NULL, NULL),
(38, 'Strip', NULL, NULL),
(39, 'Supp', NULL, NULL),
(40, 'Tablet', NULL, NULL),
(41, 'Tube', NULL, NULL),
(42, 'Unit', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Hasnawi Mohas', 'hasnawi_mohas', '$2y$12$e6gagEZOguWCXJw76MqQ8Our2uTXYJGkHq6RVeS0wBcJUSKubQWM.', NULL, NULL),
(2, 'cashier', 'Alfian Muhammad', '0012305567', '$2y$12$sUAsm7Uvcruz8nqW/GGnEuIvVsOd.0.qn6HC148qxgzgMl0LZ8EzG', NULL, NULL),
(3, 'cashier', 'Deny Sumargo', '0012305569', '$2y$12$uGAeIvHl2VNr.PpnL5y4j.1B6yWhR/TFylJY9nKST4H7pA6jp.ww.', NULL, NULL),
(4, 'cashier', 'Billie Elish', '0012305568', '$2y$12$KQjULuEO3Asi4nxmmFw.VeDw5U58gh3EGvaGeC7azXS2zAn49Z/g6', NULL, NULL),
(5, 'head_office', 'Abraham Samad', 'abraham_samad', '$2y$12$e6gagEZOguWCXJw76MqQ8Our2uTXYJGkHq6RVeS0wBcJUSKubQWM.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_shift_sessions`
--

CREATE TABLE `user_shift_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shift_id` bigint(20) UNSIGNED NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date DEFAULT NULL,
  `start` time NOT NULL,
  `end` time DEFAULT NULL,
  `cash_in_hand` bigint(20) UNSIGNED NOT NULL,
  `end_cash` bigint(20) UNSIGNED NOT NULL,
  `status` enum('active','deactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_shift_sessions`
--

INSERT INTO `user_shift_sessions` (`id`, `user_id`, `shift_id`, `date_start`, `date_end`, `start`, `end`, `cash_in_hand`, `end_cash`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2024-04-26', '2024-04-26', '04:52:59', '05:59:14', 50000, 85000, 'deactive', '2024-04-25 21:52:59', '2024-04-25 22:59:14');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Utama', NULL, NULL),
(2, 'Cadangan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_racks`
--

CREATE TABLE `warehouse_racks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `rack_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouse_racks`
--

INSERT INTO `warehouse_racks` (`id`, `warehouse_id`, `rack_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 2, 1, NULL, NULL),
(4, 1, 3, '2024-04-24 22:06:10', NULL),
(5, 1, 4, '2024-04-24 22:06:16', NULL),
(6, 2, 2, '2024-04-24 22:06:27', NULL),
(7, 2, 3, '2024-04-24 22:06:32', NULL),
(8, 2, 4, '2024-04-24 22:06:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_rack_products`
--

CREATE TABLE `warehouse_rack_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_order_item_id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `rack_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouse_rack_products`
--

INSERT INTO `warehouse_rack_products` (`id`, `purchase_order_item_id`, `warehouse_id`, `rack_id`, `product_id`, `qty`, `created_at`, `updated_at`) VALUES
(1, 12, 1, 3, 1, 100, '2024-04-24 22:23:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cashiers`
--
ALTER TABLE `cashiers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cashiers_user_id_foreign` (`user_id`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opname`
--
ALTER TABLE `opname`
  ADD PRIMARY KEY (`id`),
  ADD KEY `opname_product` (`product_id`),
  ADD KEY `opname_warehouse` (`warehouse_id`),
  ADD KEY `opname_rack` (`rack_id`),
  ADD KEY `opname_user` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_code_unique` (`code`),
  ADD KEY `products_supplier_id_foreign` (`supplier_id`),
  ADD KEY `products_unit_id_foreign` (`unit_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_orders_items_purchase_order_id_foreign` (`purchase_order_id`),
  ADD KEY `purchase_orders_items_supplier_id_foreign` (`supplier_id`),
  ADD KEY `purchase_orders_items_product_id_foreign` (`product_id`),
  ADD KEY `purchase_orders_items_unit_id_foreign` (`unit_id`);

--
-- Indexes for table `racks`
--
ALTER TABLE `racks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_shift_id_foreign` (`shift_id`);

--
-- Indexes for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_items_transaction_id_foreign` (`transaction_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_shift_sessions`
--
ALTER TABLE `user_shift_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_shift_sessions_user_id_foreign` (`user_id`),
  ADD KEY `user_shift_sessions_shift_id_foreign` (`shift_id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_racks`
--
ALTER TABLE `warehouse_racks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `warehouse_racks_warehouse_id_foreign` (`warehouse_id`),
  ADD KEY `warehouse_racks_rack_id_foreign` (`rack_id`);

--
-- Indexes for table `warehouse_rack_products`
--
ALTER TABLE `warehouse_rack_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `warehouse_rack_products_purchase_order_id_foreign` (`purchase_order_item_id`),
  ADD KEY `warehouse_rack_products_warehouse_id_foreign` (`warehouse_id`),
  ADD KEY `warehouse_rack_products_rack_id_foreign` (`rack_id`),
  ADD KEY `warehouse_rack_products_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cashiers`
--
ALTER TABLE `cashiers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `opname`
--
ALTER TABLE `opname`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `racks`
--
ALTER TABLE `racks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_shift_sessions`
--
ALTER TABLE `user_shift_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `warehouse_racks`
--
ALTER TABLE `warehouse_racks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `warehouse_rack_products`
--
ALTER TABLE `warehouse_rack_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cashiers`
--
ALTER TABLE `cashiers`
  ADD CONSTRAINT `cashiers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `opname`
--
ALTER TABLE `opname`
  ADD CONSTRAINT `opname_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `opname_rack` FOREIGN KEY (`rack_id`) REFERENCES `racks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `opname_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `opname_warehouse` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD CONSTRAINT `purchase_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  ADD CONSTRAINT `purchase_orders_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_orders_items_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_orders_items_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_orders_items_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_shift_id_foreign` FOREIGN KEY (`shift_id`) REFERENCES `shifts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD CONSTRAINT `transaction_items_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_shift_sessions`
--
ALTER TABLE `user_shift_sessions`
  ADD CONSTRAINT `user_shift_sessions_shift_id_foreign` FOREIGN KEY (`shift_id`) REFERENCES `shifts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_shift_sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `warehouse_racks`
--
ALTER TABLE `warehouse_racks`
  ADD CONSTRAINT `warehouse_racks_rack_id_foreign` FOREIGN KEY (`rack_id`) REFERENCES `racks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `warehouse_racks_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `warehouse_rack_products`
--
ALTER TABLE `warehouse_rack_products`
  ADD CONSTRAINT `warehouse_rack_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `warehouse_rack_products_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_item_id`) REFERENCES `purchase_order_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `warehouse_rack_products_rack_id_foreign` FOREIGN KEY (`rack_id`) REFERENCES `racks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `warehouse_rack_products_warehouse_id_foreign` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

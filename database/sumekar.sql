-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3309
-- Generation Time: Feb 11, 2024 at 05:55 AM
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
-- Database: `sumekar`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Obat Keras A2', '2024-02-10 16:04:17', '2024-02-10 16:04:46');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `route` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `route`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'dashboard', 'fas fa-home', '2022-03-02 22:21:33', '2022-09-12 08:19:37'),
(2, 'Profile', 'profile', 'fas fa-user', '2022-01-14 04:22:30', '2022-09-12 08:19:37'),
(3, 'Penjualan', NULL, 'fas fa-exchange-alt', '2022-03-02 22:21:33', '2022-09-12 08:19:37'),
(4, 'Persediaan', NULL, 'fas fa-database', '2022-01-14 04:22:30', '2022-09-12 08:19:37'),
(5, 'Pembelian', NULL, 'fas fa-shopping-cart', '2022-03-02 22:21:33', '2022-09-12 08:19:37'),
(6, 'Laporan', NULL, 'fas fa-file-medical-alt', '2022-01-14 04:22:30', '2022-09-12 08:19:37'),
(7, 'Pengguna Sistem', NULL, 'fas fa-users', '2022-03-02 22:21:33', '2022-09-12 08:19:37'),
(8, 'Sistem', NULL, 'fas fa-cog', '2022-01-14 04:22:30', '2022-09-12 08:19:37');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `route` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `parent_id`, `name`, `route`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, 'Transaksi Baru', 'transaction/new', '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(2, 3, NULL, 'Daftar Transaksi', 'transaction', '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(3, 4, NULL, 'Gudang', 'warehouse', '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(4, 4, NULL, 'Supplier', 'supplier', '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(5, 4, NULL, 'Produk', NULL, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(6, 4, 5, 'Daftar Kategori', 'product/category', '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(7, 4, 5, 'Daftar Produk', 'product', '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(8, 4, NULL, 'Stok', NULL, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(9, 4, 8, 'Stok Kadaluarsa', 'stock/expired', '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(10, 4, 8, 'Stok Opname', 'stock/opname', '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(11, 4, 8, 'Riwayat Stok Opname', 'stock/opname/history', '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(12, 5, NULL, 'Rencana Pembelian', 'purchase_plan', '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(13, 5, NULL, 'Pesanan Pembelian', 'purchase_order', '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(14, 6, NULL, 'Pembelian', 'report/purchase', '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(15, 6, NULL, 'Penjualan', 'report/sales', '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(16, 6, NULL, 'Persediaan', 'report/supply', '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(17, 7, NULL, 'Apoteker', 'users?role=1', '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(18, 7, NULL, 'Kepala Apotek', 'users?role=3', '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(19, 7, NULL, 'Kasir', 'users?role=2', '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(20, 8, NULL, 'Role', 'users/role', '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(21, 8, NULL, 'Permission', 'users/permission', '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(22, 8, NULL, 'Log Aktivitas', 'users/log', '2022-02-06 19:54:27', '2022-09-12 08:19:37');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `basic_price` varchar(30) NOT NULL,
  `sales_price` varchar(30) NOT NULL COMMENT 'basic_price + markup',
  `markup` varchar(30) NOT NULL COMMENT 'basic_price x markup_percentage',
  `markup_percentage` int(3) NOT NULL,
  `unit` varchar(30) NOT NULL,
  `status` enum('for_sale','not_for_sale') NOT NULL,
  `stock_ready_to_sale` int(10) NOT NULL DEFAULT 0,
  `stock_warehouse` int(10) NOT NULL DEFAULT 0,
  `stock_total` int(10) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `code`, `name`, `basic_price`, `sales_price`, `markup`, `markup_percentage`, `unit`, `status`, `stock_ready_to_sale`, `stock_warehouse`, `stock_total`, `created_at`, `updated_at`) VALUES
(1, 1, 'DSFSD12', 'test', '500000', '600000', '100000', 20, 'strip', 'for_sale', 0, 0, 0, '2024-02-10 19:02:47', '2024-02-10 19:10:27');

-- --------------------------------------------------------

--
-- Table structure for table `product_stock_opnames`
--

CREATE TABLE `product_stock_opnames` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `status` enum('open','progress','closed') NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_stock_opname_rts_items`
--

CREATE TABLE `product_stock_opname_rts_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_stock_opname_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `unit` varchar(30) NOT NULL,
  `qty_real` int(10) NOT NULL,
  `qty_system` int(10) NOT NULL,
  `difference` int(10) NOT NULL DEFAULT 0,
  `status` enum('valid','invalid') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='product stock opname ready to sales item';

-- --------------------------------------------------------

--
-- Table structure for table `product_stock_opname_warehouse_items`
--

CREATE TABLE `product_stock_opname_warehouse_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_stock_opname_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `unit` varchar(30) NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `rack_id` bigint(20) UNSIGNED NOT NULL,
  `qty_system` int(10) NOT NULL,
  `qty_real` int(10) NOT NULL,
  `difference` int(10) NOT NULL DEFAULT 0,
  `status` enum('valid','invalid') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_stock_pos`
--

CREATE TABLE `product_stock_pos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `puchase_order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `rack_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(10) NOT NULL,
  `unit` varchar(30) NOT NULL,
  `qty_per_unit` int(10) NOT NULL,
  `date` date NOT NULL,
  `expired_date` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='product stock purchase orders';

-- --------------------------------------------------------

--
-- Table structure for table `product_stock_ready_to_sales`
--

CREATE TABLE `product_stock_ready_to_sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `rack_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(10) NOT NULL,
  `unit` varchar(30) NOT NULL,
  `expired_date` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_stock_transaction`
--

CREATE TABLE `product_stock_transaction` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(10) NOT NULL,
  `unit` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `status` enum('sale','return') NOT NULL COMMENT 'jika sale berkurang, jika return bertambah',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `puchase_orders`
--

CREATE TABLE `puchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date_submission` date NOT NULL,
  `date_approved` date DEFAULT NULL,
  `sp_number` varchar(255) NOT NULL,
  `status` enum('open','revision','accept','declined','closed') NOT NULL DEFAULT 'open',
  `assign_warehouse` enum('not','waiting','done') NOT NULL DEFAULT 'not',
  `subtotal` varchar(30) NOT NULL DEFAULT '0',
  `grandtotal` varchar(30) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `puchase_order_histories`
--

CREATE TABLE `puchase_order_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `puchase_order_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `puchase_order_items`
--

CREATE TABLE `puchase_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `puchase_order_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(10) NOT NULL,
  `unit` varchar(30) NOT NULL,
  `discount` varchar(30) NOT NULL DEFAULT '0',
  `discount_type` enum('fix','percentage') DEFAULT NULL,
  `subtotal` varchar(30) NOT NULL DEFAULT '0',
  `total` varchar(30) NOT NULL DEFAULT '0',
  `plain_date` date DEFAULT NULL,
  `nota` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `racks`
--

CREATE TABLE `racks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `capacity` int(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `racks`
--

INSERT INTO `racks` (`id`, `warehouse_id`, `name`, `capacity`, `created_at`, `updated_at`) VALUES
(1, 3, 'Rack A1', 80, '2024-02-10 15:24:38', '2024-02-10 15:43:05'),
(2, 3, 'RACK A2', 100, '2024-02-10 16:21:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `route` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `route`, `created_at`, `updated_at`) VALUES
(0, 'Super Admin', 'dashboard', '2022-02-06 19:54:27', '2024-02-08 03:43:41'),
(1, 'Apoteker', 'dashboard', '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(2, 'Kasir', 'users/permission', '2022-01-14 04:22:30', '2024-02-08 05:10:01'),
(3, 'Kepala Apotek', 'dashboard', '2022-01-14 04:22:30', '2022-09-12 08:19:37');

-- --------------------------------------------------------

--
-- Table structure for table `role_menus`
--

CREATE TABLE `role_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `allowed` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_menus`
--

INSERT INTO `role_menus` (`id`, `role_id`, `menu_id`, `parent_id`, `item_id`, `allowed`, `created_at`, `updated_at`) VALUES
(1, 1, 3, NULL, 1, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(2, 1, 3, NULL, 2, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(3, 1, 4, NULL, 3, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(4, 1, 4, NULL, 4, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(5, 1, 4, NULL, 5, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(6, 1, 4, 5, 6, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(7, 1, 4, 5, 7, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(8, 1, 4, NULL, 8, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(9, 1, 4, 8, 9, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(10, 1, 4, 8, 10, 0, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(11, 1, 4, 8, 11, 0, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(12, 1, 5, NULL, 12, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(13, 1, 5, NULL, 13, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(14, 1, 6, NULL, 14, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(15, 1, 6, NULL, 15, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(16, 1, 6, NULL, 16, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(17, 1, 7, NULL, 17, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(18, 1, 7, NULL, 18, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(19, 1, 7, NULL, 19, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(20, 1, 8, NULL, 20, 0, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(21, 1, 8, NULL, 21, 0, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(22, 1, 8, NULL, 22, 0, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(23, 0, 3, NULL, 1, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(24, 0, 3, NULL, 2, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(25, 0, 4, NULL, 3, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(26, 0, 4, NULL, 4, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(27, 0, 4, NULL, 5, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(28, 0, 4, 5, 6, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(29, 0, 4, 5, 7, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(30, 0, 4, NULL, 8, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(31, 0, 4, 8, 9, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(32, 0, 4, 8, 10, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(33, 0, 4, 8, 11, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(34, 0, 5, NULL, 12, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(35, 0, 5, NULL, 13, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(36, 0, 6, NULL, 14, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(37, 0, 6, NULL, 15, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(38, 0, 6, NULL, 16, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(39, 0, 7, NULL, 17, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(40, 0, 7, NULL, 18, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(41, 0, 7, NULL, 19, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(42, 0, 8, NULL, 20, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(43, 0, 8, NULL, 21, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(44, 0, 8, NULL, 22, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(89, 2, 3, NULL, 1, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(90, 2, 3, NULL, 2, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(91, 2, 4, NULL, 3, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(92, 2, 4, NULL, 4, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(93, 2, 4, NULL, 5, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(94, 2, 4, 5, 6, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(95, 2, 4, 5, 7, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(96, 2, 4, NULL, 8, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(97, 2, 4, 8, 9, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(98, 2, 4, 8, 10, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(99, 2, 4, 8, 11, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(100, 2, 5, NULL, 12, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(101, 2, 5, NULL, 13, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(102, 2, 6, NULL, 14, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(103, 2, 6, NULL, 15, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(104, 2, 6, NULL, 16, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(105, 2, 7, NULL, 17, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(106, 2, 7, NULL, 18, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(107, 2, 7, NULL, 19, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(108, 2, 8, NULL, 20, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(109, 2, 8, NULL, 21, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(110, 2, 8, NULL, 22, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(111, 3, 3, NULL, 1, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(112, 3, 3, NULL, 2, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(113, 3, 4, NULL, 3, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(114, 3, 4, NULL, 4, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(115, 3, 4, NULL, 5, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(116, 3, 4, 5, 6, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(117, 3, 4, 5, 7, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(118, 3, 4, NULL, 8, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(119, 3, 4, 8, 9, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(120, 3, 4, 8, 10, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(121, 3, 4, 8, 11, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(122, 3, 5, NULL, 12, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(123, 3, 5, NULL, 13, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(124, 3, 6, NULL, 14, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(125, 3, 6, NULL, 15, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(126, 3, 6, NULL, 16, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(127, 3, 7, NULL, 17, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(128, 3, 7, NULL, 18, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(129, 3, 7, NULL, 19, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(130, 3, 8, NULL, 20, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(131, 3, 8, NULL, 21, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(132, 3, 8, NULL, 22, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(133, 0, 1, NULL, NULL, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(134, 0, 2, NULL, NULL, 1, '2022-01-14 04:22:30', '2022-09-12 08:19:37'),
(135, 1, 1, NULL, NULL, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(136, 1, 2, NULL, NULL, 1, '2022-01-14 04:22:30', '2022-09-12 08:19:37'),
(137, 2, 1, NULL, NULL, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(138, 2, 2, NULL, NULL, 1, '2022-01-14 04:22:30', '2022-09-12 08:19:37'),
(139, 3, 1, NULL, NULL, 1, '2022-02-06 19:54:27', '2022-09-12 08:19:37'),
(140, 3, 2, NULL, NULL, 1, '2022-01-14 04:22:30', '2022-09-12 08:19:37');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `address`, `phone`, `pic`, `email`, `created_at`, `updated_at`) VALUES
(2, 'POLITEKNIK KESEHATAN MALANG', 'Ijen St No.77C, Oro-oro Dowo, Klojen,', '0341551893', 'pak yuri', 'direktorat@poltekkes-malang.ac.id', '2024-02-10 14:40:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `total_qty` int(10) NOT NULL,
  `service_fee` varchar(30) NOT NULL DEFAULT '0',
  `embalase_fee` varchar(30) NOT NULL DEFAULT '0',
  `shipping_fee` varchar(30) NOT NULL DEFAULT '0',
  `discount_type` enum('fix','percentage') NOT NULL,
  `discount` varchar(30) NOT NULL DEFAULT '0',
  `subtotal` varchar(30) NOT NULL DEFAULT '0',
  `grandtotal` varchar(30) NOT NULL DEFAULT '0',
  `status` enum('paid','unpaid') NOT NULL DEFAULT 'unpaid',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_items`
--

CREATE TABLE `transaction_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(10) NOT NULL,
  `price` varchar(30) NOT NULL,
  `total` varchar(30) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 0, 'Super Admin', 'superadmin', '$2y$12$pt0ZmX743ZUOT3Uh59mh3ORHPulD./4VDn0.QkIl/UvoiR4yAcJEq', '2022-01-08 05:40:28', '2021-06-02 13:45:57'),
(2, 1, 'Alfian Muhammad', 'alfian_muhammad', '$2y$12$pt0ZmX743ZUOT3Uh59mh3ORHPulD./4VDn0.QkIl/UvoiR4yAcJEq', '2022-01-08 05:40:28', '2021-06-02 13:45:57'),
(3, 2, 'Muhammad Alfian ', 'muhammad_alfian', '$2y$12$pt0ZmX743ZUOT3Uh59mh3ORHPulD./4VDn0.QkIl/UvoiR4yAcJEq', '2022-01-08 05:40:28', '2021-06-02 13:45:57'),
(4, 3, 'Alfian Saja', 'alfian', '$2y$12$pt0ZmX743ZUOT3Uh59mh3ORHPulD./4VDn0.QkIl/UvoiR4yAcJEq', '2022-01-08 05:40:28', '2021-06-02 13:45:57');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Gudang Selatan BC', '2024-02-10 15:14:04', '2024-02-10 15:14:16'),
(3, 'Gudang Selatan BD', '2024-02-10 15:42:16', NULL),
(4, 'Gudang Selatan BF', '2024-02-10 16:21:39', NULL);

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
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items` (`menu_id`),
  ADD KEY `item_parent` (`parent_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_categories` (`category_id`);

--
-- Indexes for table `product_stock_opnames`
--
ALTER TABLE `product_stock_opnames`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pso_users` (`user_id`);

--
-- Indexes for table `product_stock_opname_rts_items`
--
ALTER TABLE `product_stock_opname_rts_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pso_rts_id` (`product_stock_opname_id`),
  ADD KEY `pso_rts_product_id` (`product_id`);

--
-- Indexes for table `product_stock_opname_warehouse_items`
--
ALTER TABLE `product_stock_opname_warehouse_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pso_whs_id` (`product_stock_opname_id`),
  ADD KEY `pso_whs_product_id` (`product_id`),
  ADD KEY `pso_whs_whs_id` (`warehouse_id`),
  ADD KEY `pso_whs_rack_id` (`rack_id`);

--
-- Indexes for table `product_stock_pos`
--
ALTER TABLE `product_stock_pos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pspo_id` (`puchase_order_id`),
  ADD KEY `pspo_product_id` (`product_id`),
  ADD KEY `pspo_rack_id` (`rack_id`),
  ADD KEY `pspo_whs_id` (`warehouse_id`);

--
-- Indexes for table `product_stock_ready_to_sales`
--
ALTER TABLE `product_stock_ready_to_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rts_product_id` (`product_id`),
  ADD KEY `rts_rack_id` (`rack_id`),
  ADD KEY `rts_whs_id` (`warehouse_id`);

--
-- Indexes for table `product_stock_transaction`
--
ALTER TABLE `product_stock_transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pst_product_id` (`product_id`),
  ADD KEY `pst_trs_id` (`transaction_id`);

--
-- Indexes for table `puchase_orders`
--
ALTER TABLE `puchase_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `po_user_id` (`user_id`);

--
-- Indexes for table `puchase_order_histories`
--
ALTER TABLE `puchase_order_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `po_historis_po_id` (`puchase_order_id`);

--
-- Indexes for table `puchase_order_items`
--
ALTER TABLE `puchase_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pos_item_id` (`puchase_order_id`),
  ADD KEY `pos_supplier_id` (`supplier_id`),
  ADD KEY `pos_product_id` (`product_id`);

--
-- Indexes for table `racks`
--
ALTER TABLE `racks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rack_whs_id` (`warehouse_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_menus`
--
ALTER TABLE `role_menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_menu_role` (`role_id`),
  ADD KEY `role_menu_id` (`menu_id`),
  ADD KEY `role_menu_menu_item` (`item_id`);

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
  ADD KEY `trs_user_id` (`user_id`),
  ADD KEY `trs_crm_id` (`customer_id`);

--
-- Indexes for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trs_item_id` (`transaction_id`),
  ADD KEY `trs_product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`username`),
  ADD KEY `role_users` (`role_id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_stock_opnames`
--
ALTER TABLE `product_stock_opnames`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_stock_opname_rts_items`
--
ALTER TABLE `product_stock_opname_rts_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_stock_opname_warehouse_items`
--
ALTER TABLE `product_stock_opname_warehouse_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_stock_pos`
--
ALTER TABLE `product_stock_pos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_stock_ready_to_sales`
--
ALTER TABLE `product_stock_ready_to_sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_stock_transaction`
--
ALTER TABLE `product_stock_transaction`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `puchase_orders`
--
ALTER TABLE `puchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `puchase_order_histories`
--
ALTER TABLE `puchase_order_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `puchase_order_items`
--
ALTER TABLE `puchase_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `racks`
--
ALTER TABLE `racks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_menus`
--
ALTER TABLE `role_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `item_parent` FOREIGN KEY (`parent_id`) REFERENCES `menu_items` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `menu_items` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `product_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_stock_opnames`
--
ALTER TABLE `product_stock_opnames`
  ADD CONSTRAINT `pso_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_stock_opname_rts_items`
--
ALTER TABLE `product_stock_opname_rts_items`
  ADD CONSTRAINT `pso_rts_id` FOREIGN KEY (`product_stock_opname_id`) REFERENCES `product_stock_opnames` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pso_rts_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_stock_opname_warehouse_items`
--
ALTER TABLE `product_stock_opname_warehouse_items`
  ADD CONSTRAINT `pso_whs_id` FOREIGN KEY (`product_stock_opname_id`) REFERENCES `product_stock_opnames` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pso_whs_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pso_whs_rack_id` FOREIGN KEY (`rack_id`) REFERENCES `racks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pso_whs_whs_id` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_stock_pos`
--
ALTER TABLE `product_stock_pos`
  ADD CONSTRAINT `pspo_id` FOREIGN KEY (`puchase_order_id`) REFERENCES `puchase_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pspo_product_id` FOREIGN KEY (`product_id`) REFERENCES `puchase_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pspo_rack_id` FOREIGN KEY (`rack_id`) REFERENCES `racks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pspo_whs_id` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_stock_ready_to_sales`
--
ALTER TABLE `product_stock_ready_to_sales`
  ADD CONSTRAINT `rts_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rts_rack_id` FOREIGN KEY (`rack_id`) REFERENCES `racks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rts_whs_id` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_stock_transaction`
--
ALTER TABLE `product_stock_transaction`
  ADD CONSTRAINT `pst_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pst_trs_id` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `puchase_orders`
--
ALTER TABLE `puchase_orders`
  ADD CONSTRAINT `po_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `puchase_order_histories`
--
ALTER TABLE `puchase_order_histories`
  ADD CONSTRAINT `po_historis_po_id` FOREIGN KEY (`puchase_order_id`) REFERENCES `puchase_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `puchase_order_items`
--
ALTER TABLE `puchase_order_items`
  ADD CONSTRAINT `pos_item_id` FOREIGN KEY (`puchase_order_id`) REFERENCES `puchase_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pos_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pos_supplier_id` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `racks`
--
ALTER TABLE `racks`
  ADD CONSTRAINT `rack_whs_id` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_menus`
--
ALTER TABLE `role_menus`
  ADD CONSTRAINT `role_menu_id` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_menu_menu_item` FOREIGN KEY (`item_id`) REFERENCES `menu_items` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `role_menu_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `trs_crm_id` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trs_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD CONSTRAINT `trs_item_id` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trs_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `role_users` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

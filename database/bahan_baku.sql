-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Agu 2024 pada 19.22
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bahan_baku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `department`
--

CREATE TABLE `department` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `department`
--

INSERT INTO `department` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Manager', 'Department responsible for overall management and strategic planning.', '2024-08-03 20:12:30', '2024-08-03 20:12:30'),
(2, 'Human Resources', 'Handles recruitment, employee relations, and other HR functions.', '2024-08-03 20:12:30', '2024-08-03 20:12:30'),
(3, 'Finance', 'Manages financial activities including accounting, budgeting, and investment.', '2024-08-03 20:12:30', '2024-08-03 20:12:30'),
(4, 'IT', 'Responsible for managing and supporting IT infrastructure and services.', '2024-08-03 20:12:30', '2024-08-03 20:12:30'),
(5, 'Admin Inventory', 'Manages administrative tasks related to inventory management.', '2024-08-03 20:12:30', '2024-08-03 20:12:30'),
(6, 'Staff Inventory', 'Handles inventory management and stock control.', '2024-08-03 20:12:30', '2024-08-03 20:12:30'),
(7, 'Production', 'Oversees manufacturing and production processes.', '2024-08-03 20:12:30', '2024-08-03 20:12:30'),
(8, 'Quality Control', 'Ensures products meet quality standards and specifications.', '2024-08-03 20:12:30', '2024-08-03 20:12:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `division`
--

CREATE TABLE `division` (
  `id` int(11) UNSIGNED NOT NULL,
  `department_id` int(11) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `division`
--

INSERT INTO `division` (`id`, `department_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Executive Management', 'Oversees all company operations and strategy.', '2024-08-03 20:12:38', '2024-08-05 17:20:48'),
(2, 1, 'Strategic Planning', 'Focuses on long-term planning and company goals.', '2024-08-03 20:12:38', '2024-08-03 20:12:38'),
(3, 2, 'Recruitment', 'Handles hiring and job postings.', '2024-08-03 20:12:38', '2024-08-03 20:12:38'),
(4, 2, 'Employee Relations', 'Manages employee grievances and workplace issues.', '2024-08-03 20:12:38', '2024-08-03 20:12:38'),
(5, 3, 'Accounting', 'Handles financial transactions and reporting.', '2024-08-03 20:12:38', '2024-08-03 20:12:38'),
(6, 3, 'Financial Planning', 'Responsible for budgeting and financial forecasts.', '2024-08-03 20:12:38', '2024-08-03 20:12:38'),
(7, 4, 'Technical Support', 'Provides IT support and troubleshooting.', '2024-08-03 20:12:38', '2024-08-03 20:12:38'),
(8, 4, 'Network Administration', 'Maintains network infrastructure and security.', '2024-08-03 20:12:38', '2024-08-03 20:12:38'),
(9, 5, 'Inventory Control', 'Oversees inventory levels and stock management.', '2024-08-03 20:12:38', '2024-08-03 20:12:38'),
(10, 5, 'Supplier Relations', 'Manages relationships with suppliers and procurement.', '2024-08-03 20:12:38', '2024-08-03 20:12:38'),
(11, 6, 'Stock Management', 'Manages stock levels and inventory accuracy.', '2024-08-03 20:12:38', '2024-08-03 20:12:38'),
(12, 6, 'Logistics', 'Handles the logistics and distribution of inventory.', '2024-08-03 20:12:38', '2024-08-03 20:12:38'),
(13, 7, 'Manufacturing', 'Manages production processes and assembly.', '2024-08-03 20:12:38', '2024-08-03 20:12:38'),
(14, 7, 'Product Development', 'Focuses on the development and enhancement of products.', '2024-08-03 20:12:38', '2024-08-03 20:12:38'),
(15, 8, 'Quality Assurance', 'Ensures that products meet quality standards before release.', '2024-08-03 20:12:38', '2024-08-03 20:12:38'),
(16, 8, 'Inspection', 'Conducts inspections and tests to ensure product quality.', '2024-08-03 20:12:38', '2024-08-03 20:12:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory`
--

CREATE TABLE `inventory` (
  `id_inventory` int(11) NOT NULL,
  `id_items` int(11) NOT NULL,
  `name_items` varchar(255) NOT NULL,
  `id_suppliers` int(11) NOT NULL,
  `stock_items` int(11) NOT NULL,
  `taken_by` varchar(255) NOT NULL,
  `noted_by` varchar(255) DEFAULT NULL,
  `date_update` datetime NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `inventory`
--

INSERT INTO `inventory` (`id_inventory`, `id_items`, `name_items`, `id_suppliers`, `stock_items`, `taken_by`, `noted_by`, `date_update`, `description`) VALUES
(6, 1, 'ajiplus', 3, 1, '4', 'admin', '2024-07-16 13:36:42', ''),
(7, 33, 'lada hitam', 3, 111, 'QC', 'admin', '2024-07-16 13:43:38', ''),
(8, 68, 'trehalose', 3, 313, 'admin', 'admin', '2024-07-16 13:48:18', ''),
(9, 1, 'ajiplus', 1, -111, '3', 'admin', '2024-07-16 13:48:59', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `items`
--

CREATE TABLE `items` (
  `id_items` int(11) NOT NULL,
  `name_items` varchar(255) NOT NULL,
  `previous_stock` int(11) NOT NULL,
  `stock_items` int(11) NOT NULL DEFAULT 0,
  `description` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `items`
--

INSERT INTO `items` (`id_items`, `name_items`, `previous_stock`, `stock_items`, `description`, `updated_at`, `image`) VALUES
(1, 'ajiplus', 0, 3000, 'ddd', '2024-08-08 16:29:26', 'NoImageAvailable.jpg'),
(2, 'baking powder', 0, 3001, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(3, 'bawang goreng', 0, 1, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(4, 'biji wijen putih', 0, 90, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(5, 'bumbu cabe ichimi', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(6, 'bumbu lumur sasa', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(7, 'bunga lawang ', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(8, 'cengkeh ', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(9, 'cream cheese', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(10, 'cuka', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(11, 'ebi ', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(12, 'fish saush', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(13, 'garam ', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(14, 'garlic powder', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(15, 'gula aren', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(16, 'gula merah', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(17, 'gula pasir gulaku', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(18, 'jintan bubuk', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(19, 'kapulaga', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(20, 'katsuo dashi', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(21, 'kayu manis batang', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(22, 'kayu manis bubuk', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(23, 'kecap asin abc', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(24, 'kecap asin kikoman', 0, 7, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(25, 'kecap inggris', 0, 9, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(26, 'kecap manis bango', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(27, 'kecap manis jepang', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(28, 'keju permesan', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(29, 'ketumba bubuk', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(30, 'ketumbar bubuk', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(31, 'kluwek', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(32, 'knor chicken', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(33, 'lada hitam', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(34, 'lada putih', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(35, 'madu tj ', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(36, 'marinasi', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(37, 'mayo chef style', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(38, 'mayo kewpie', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(39, 'mayo maestro', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(40, 'minyak canola', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(41, 'minyak wijen', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(42, 'monalisa', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(43, 'mozarella', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(44, 'mustard', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(45, 'natrium benzoat', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(46, 'onion powder ', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(47, 'oregano', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(48, 'pala bubuk', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(49, 'parsley kering', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(50, 'pewarna merah cabe', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(51, 'rice improver', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(52, 'saus bbq leekumke', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(53, 'saus gochujang', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(54, 'saus katsu', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(55, 'saus nanban ', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(56, 'saus sambal mclewis', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(57, 'saus teriyaki', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(58, 'saus tiram', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(59, 'saus tomat mclewis', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(60, 'sttp', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(61, 'tepung beras', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(62, 'tepung maizena', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(63, 'tepung pak tani', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(64, 'tepung segitiga biru', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(65, 'tepung tapioka gunung agung', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(66, 'terasi ', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(67, 'totole', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(68, 'trehalose', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(69, 'truffle', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(70, 'unsalted butter', 0, 100, '', '2024-08-03 20:51:46', 'NoImageAvailable.jpg'),
(73, 'Anika Trevino', 41, 11, 'Labore sit cupiditat', '2024-08-08 13:42:12', 'NoImageAvailable.jpg'),
(74, 'Thane David', 85, 85, 'Beatae debitis adipi', '2024-08-08 13:41:23', 'NoImageAvailable.jpg'),
(75, 'Emi Farley', 77, 16, 'Deserunt consectetur', '2024-08-08 15:34:09', '1723131249_61a61880081895e5ae3b.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `items_bundles`
--

CREATE TABLE `items_bundles` (
  `id` int(11) NOT NULL,
  `bundle_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('rejected','approve','pending','') DEFAULT 'pending',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `items_bundles`
--

INSERT INTO `items_bundles` (`id`, `bundle_name`, `created_at`, `status`, `updated_at`) VALUES
(1, 'Week 1 Requirements Bundle Items', '2024-07-23 14:45:04', 'approve', '2024-07-27 20:39:04'),
(2, 'Week 3 Requirements Bundle Items', '2024-07-23 14:45:04', 'approve', '2024-07-29 05:43:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `items_need`
--

CREATE TABLE `items_need` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `bundle_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` enum('stock_needed','stock_available','stock_not_available') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `items_need`
--

INSERT INTO `items_need` (`id`, `item_id`, `bundle_id`, `item_name`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'ajiplus', 1000, 'stock_not_available', '2024-07-23 14:58:18', '2024-07-27 20:39:31'),
(2, 2, 1, 'baking powder', 1000, 'stock_not_available', '2024-07-23 14:58:18', '2024-07-25 09:34:23'),
(3, 1, 2, 'ajiplus', 1000, 'stock_not_available', '2024-07-23 14:58:18', '2024-07-29 05:42:33'),
(4, 2, 2, 'baking powder', 1000, 'stock_not_available', '2024-07-23 14:58:18', '2024-07-29 05:43:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-07-19-100000', 'App\\Database\\Migrations\\CreateStockOutTable', 'default', 'App', 1721390522, 1),
(2, '2024-07-23-002722', 'App\\Database\\Migrations\\CreatePreOrderCartTable', 'default', 'App', 1721694517, 2),
(3, '2024-07-23-010151', 'App\\Database\\Migrations\\CreatePreOrderCartTable', 'default', 'App', 1721696537, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `outbounds`
--

CREATE TABLE `outbounds` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'completed',
  `outbound_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `outbounds`
--

INSERT INTO `outbounds` (`id`, `user_id`, `recipient_id`, `status`, `outbound_date`) VALUES
(32, 1, 3, 'completed', '2024-07-27 08:33:34'),
(33, 1, 3, 'completed', '2024-07-29 13:18:28'),
(34, 1, 1, 'completed', '2024-07-29 13:20:03'),
(35, 1, 4, 'completed', '2024-07-29 13:21:56'),
(36, 1, 5, 'completed', '2024-08-08 17:03:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `outbounds_items`
--

CREATE TABLE `outbounds_items` (
  `id` int(11) NOT NULL,
  `outbound_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `outbounds_items`
--

INSERT INTO `outbounds_items` (`id`, `outbound_id`, `item_id`, `quantity`) VALUES
(36, 32, 3, 1),
(37, 33, 4, 10),
(38, 33, 3, 2),
(39, 34, 1, 99),
(40, 35, 2, 100),
(41, 35, 3, 97),
(42, 36, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pre_order`
--

CREATE TABLE `pre_order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `delivery_note` varchar(255) NOT NULL,
  `status` enum('pending','process','checked','completed') NOT NULL,
  `noted_by` int(11) NOT NULL,
  `checked_by` int(11) NOT NULL,
  `pre_order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `check_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pre_order`
--

INSERT INTO `pre_order` (`id`, `user_id`, `supplier_id`, `delivery_note`, `status`, `noted_by`, `checked_by`, `pre_order_date`, `check_date`) VALUES
(58, 1, 1, 'aaaaa', 'completed', 1, 4, '2024-07-28 17:09:23', '2024-07-31 04:14:10'),
(59, 1, 1, 'belum', 'completed', 1, 4, '2024-07-29 12:45:23', '2024-07-30 23:26:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pre_order_cart`
--

CREATE TABLE `pre_order_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pre_order_items`
--

CREATE TABLE `pre_order_items` (
  `id` int(11) NOT NULL,
  `preorder_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `actual` int(11) DEFAULT NULL,
  `status` enum('suitable','not_suitable','unknown','') NOT NULL DEFAULT 'unknown'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pre_order_items`
--

INSERT INTO `pre_order_items` (`id`, `preorder_id`, `item_id`, `quantity`, `actual`, `status`) VALUES
(74, 58, 1, 1, 1, 'suitable'),
(75, 58, 2, 1, 1, 'suitable'),
(76, 58, 3, 1, 1, 'suitable'),
(77, 59, 1, 1000, 1000, 'suitable'),
(78, 59, 2, 1000, 1000, 'suitable');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'manager'),
(4, 'member'),
(3, 'staff');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suppliers`
--

CREATE TABLE `suppliers` (
  `id_suppliers` int(11) NOT NULL,
  `name_suppliers` varchar(255) NOT NULL,
  `production_suppliers` varchar(255) NOT NULL,
  `contact_suppliers` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `address` text NOT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `suppliers`
--

INSERT INTO `suppliers` (`id_suppliers`, `name_suppliers`, `production_suppliers`, `contact_suppliers`, `created_at`, `address`, `email`) VALUES
(1, 'Supplier A', 'Produksi A', '6283815404175', '2024-07-11 06:23:00', '', NULL),
(2, 'Supplier B', 'Produksi B', '6281317134626', '2024-07-11 06:23:00', '', NULL),
(3, 'Supplier C', 'Produksi C', '083456789012', '2024-07-11 06:23:00', '', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_created_at` datetime DEFAULT current_timestamp(),
  `role_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_created_at`, `role_id`, `department_id`, `division_id`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$Q4NLzvmUAgSdIuh2GM63gOyoObrLO1q001lS208gNSjHYkjwmcF.W', '2024-07-16 18:50:09', 1, 5, 9),
(2, 'manager', 'manager@gmail.com', '$2y$10$Q4NLzvmUAgSdIuh2GM63gOyoObrLO1q001lS208gNSjHYkjwmcF.W', '2024-07-16 18:57:18', 2, 1, 2),
(3, 'staff', 'staff@gmail.com', '$2y$10$Q4NLzvmUAgSdIuh2GM63gOyoObrLO1q001lS208gNSjHYkjwmcF.W', '2024-07-16 18:57:18', 3, 6, 12),
(4, 'QC', 'QCstaff@gmail.com', '$2y$10$Q4NLzvmUAgSdIuh2GM63gOyoObrLO1q001lS208gNSjHYkjwmcF.W', '2024-07-16 18:57:18', 4, 8, 15),
(5, 'Eka Pratama', 'eka.pratama@example.com', '$2y$10$k7kZg9AWlkNpBlb5Ac3pJujt7N4uPQLV8P8n/J6W7xuKbO/ADkBqC', '2024-08-08 23:22:53', 5, 5, 5),
(6, 'Fina Handayani', 'fina.handayani@example.com', '$2y$10$YoFJ9tj9ZL4o1enAOnKoEu8LkKAjH1hHvc6EpKO64sH3j5ddnVweW', '2024-08-08 23:22:53', 5, 6, 6),
(7, 'Guntur Bayu', 'guntur.bayu@example.com', '$2y$10$7.WCJxyGF9phK4RvVFRXxebnS56nP.jSKL8tMGRQmFbKh1PRjIkF2', '2024-08-08 23:22:53', 5, 7, 7),
(8, 'Hani Kusuma', 'hani.kusuma@example.com', '$2y$10$Xq2xD8.LJ56ZT.aT2hbPpOHV1UOrFGiJ0WXMy1kLhO.JkLVh.CZb6', '2024-08-08 23:22:53', 5, 8, 8),
(9, 'Irwan Rahman', 'irwan.rahman@example.com', '$2y$10$Q7G9lzDQwTTmjz.HbGp5XOjfx7qukCA.iAowmjUbqI88MI/tqQOkC', '2024-08-08 23:22:53', 5, 9, 9),
(10, 'Joko Lestari', 'joko.lestari@example.com', '$2y$10$NcDdtG07o8GOMoTV/j8rTeIUX/F1a6VgwqWxuOXJlg7kSt.0j3UFS', '2024-08-08 23:22:53', 5, 10, 10),
(11, 'Kiki_Rahayu', 'kiki.rahayu@example.com', '$2y$10$Q4NLzvmUAgSdIuh2GM63gOyoObrLO1q001lS208gNSjHYkjwmcF.W', '2024-08-08 23:22:53', 1, 1, 1),
(12, 'Lukman Hakim', 'lukman.hakim@example.com', '$2y$10$P97V4TZa7ik.cTT.2X7KrOceK/WzF7mc66izKN2Jm63TAsO/7pxCO', '2024-08-08 23:22:53', 5, 2, 2),
(13, 'Maya Wulandari', 'maya.wulandari@example.com', '$2y$10$Q7v8eFOzKXijjfuEcn6Ko.H1Exi5McCtsGgFI7Mx5oV5tiTKGV4qG', '2024-08-08 23:22:53', 5, 3, 3),
(14, 'Nina Amelia', 'nina.amelia@example.com', '$2y$10$q8gIxrG9.U7dgoay2MfQLOIxu1Y7xfYB4wEAdY8RWz7EdAwAEBt4y', '2024-08-08 23:22:53', 5, 4, 4),
(15, 'Oka Pramudita', 'oka.pramudita@example.com', '$2y$10$XyHVi4EVEf4k67e0Q6z1vuWog9fR4N5/RWmHQx6NtiyVoGHN1yFaK', '2024-08-08 23:22:53', 5, 5, 5),
(16, 'Putu Suryani', 'putu.suryani@example.com', '$2y$10$SJq7eX5b7M0Z1B5C3A1CQa4J9S2mGC5Jzp9SFiRFNi3JdHg.zNT9W', '2024-08-08 23:22:53', 5, 6, 6),
(17, 'Qamarul Azzam', 'qamarul.azzam@example.com', '$2y$10$BDqZ4zE6X5KOnG1RgRV/y.Vz8l4U0WPAicwP1C60af8VhXMtA3jQy', '2024-08-08 23:22:53', 5, 7, 7),
(18, 'Rina Anggraini', 'rina.anggraini@example.com', '$2y$10$1R6uJ7tAaCGYz7myTHZoK.L1EkRe0uZ7HXL02eJOUdYObPpWz05Am', '2024-08-08 23:22:53', 5, 8, 8),
(19, 'Sari Widiastuti', 'sari.widiastuti@example.com', '$2y$10$ErNmzCiv72UsLs4rYZtt8u/6BWpSC9Gx5bEUrS41fd0xULK1.j5My', '2024-08-08 23:22:53', 5, 9, 9),
(20, 'Tomi Nugroho', 'tomi.nugroho@example.com', '$2y$10$LgIcK1OafpzoHoTWlsPtMOnywA0AneL7eb3XYyfK2uwZp/VR1wX5G', '2024-08-08 23:22:53', 5, 10, 10),
(21, 'Uliya Rahmani', 'uliya.rahmani@example.com', '$2y$10$MJ/Mn9sXyx0mhJgjP/jQbJHbN3.z67/UJK6gjVqtfmMI9h1F.BhUu', '2024-08-08 23:22:53', 5, 1, 1),
(22, 'Vera Suprapto', 'vera.suprapto@example.com', '$2y$10$RZgbW/6i0pQgQ9U8LP3D2.BGfDq5QcGo0Z66Gm2IVzYyPq6BX1P2S', '2024-08-08 23:22:53', 5, 2, 2),
(23, 'Wahyu Utami', 'wahyu.utami@example.com', '$2y$10$ST2XIAT6FqckOd1Awt.GOOSu/T.5CvYEq0d5JY6ErN6wn7fA9XyUK', '2024-08-08 23:22:53', 5, 3, 3),
(24, 'Xander Fikri', 'xander.fikri@example.com', '$2y$10$QzoaAOqXOf2BZ3Sg/JQpF.E7hv1t.WvH2h4yzYxKY.tZB.tUl7AlW', '2024-08-08 23:22:53', 5, 4, 4);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indeks untuk tabel `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id_inventory`),
  ADD KEY `id_items` (`id_items`),
  ADD KEY `id_suppliers` (`id_suppliers`);

--
-- Indeks untuk tabel `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id_items`);

--
-- Indeks untuk tabel `items_bundles`
--
ALTER TABLE `items_bundles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `items_need`
--
ALTER TABLE `items_need`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bundle_id` (`bundle_id`),
  ADD KEY `fk_items_need_item_id` (`item_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `outbounds`
--
ALTER TABLE `outbounds`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `outbounds_items`
--
ALTER TABLE `outbounds_items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pre_order`
--
ALTER TABLE `pre_order`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pre_order_cart`
--
ALTER TABLE `pre_order_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pre_order_items`
--
ALTER TABLE `pre_order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indeks untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id_suppliers`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `fk_users_department` (`department_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT untuk tabel `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `division`
--
ALTER TABLE `division`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id_inventory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `items`
--
ALTER TABLE `items`
  MODIFY `id_items` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT untuk tabel `items_bundles`
--
ALTER TABLE `items_bundles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `items_need`
--
ALTER TABLE `items_need`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `outbounds`
--
ALTER TABLE `outbounds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `outbounds_items`
--
ALTER TABLE `outbounds_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `pre_order`
--
ALTER TABLE `pre_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `pre_order_cart`
--
ALTER TABLE `pre_order_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT untuk tabel `pre_order_items`
--
ALTER TABLE `pre_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id_suppliers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `division`
--
ALTER TABLE `division`
  ADD CONSTRAINT `division_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`id_items`) REFERENCES `items` (`id_items`),
  ADD CONSTRAINT `inventory_ibfk_2` FOREIGN KEY (`id_suppliers`) REFERENCES `suppliers` (`id_suppliers`);

--
-- Ketidakleluasaan untuk tabel `items_need`
--
ALTER TABLE `items_need`
  ADD CONSTRAINT `fk_items_need_item_id` FOREIGN KEY (`item_id`) REFERENCES `items` (`id_items`) ON DELETE CASCADE,
  ADD CONSTRAINT `items_need_ibfk_1` FOREIGN KEY (`bundle_id`) REFERENCES `items_bundles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

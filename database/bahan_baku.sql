-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jul 2024 pada 17.58
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
  `stock_items` int(11) NOT NULL DEFAULT 0,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `items`
--

INSERT INTO `items` (`id_items`, `name_items`, `stock_items`, `description`, `image`) VALUES
(1, 'ajiplus', 81, '', 'ajiplus.jpeg'),
(2, 'baking powder', 90, '', 'bakingpowder.jpg'),
(3, 'bawang goreng', 99, '', 'bawanggoreng.jpg'),
(4, 'biji wijen putih', 100, '', 'wijenputih.jpg'),
(5, 'bumbu cabe ichimi', 100, '', NULL),
(6, 'bumbu lumur sasa', 100, '', NULL),
(7, 'bunga lawang ', 100, '', NULL),
(8, 'cengkeh ', 100, '', NULL),
(9, 'cream cheese', 100, '', NULL),
(10, 'cuka', 100, '', NULL),
(11, 'ebi ', 100, '', NULL),
(12, 'fish saush', 100, '', NULL),
(13, 'garam ', 100, '', NULL),
(14, 'garlic powder', 100, '', NULL),
(15, 'gula aren', 100, '', NULL),
(16, 'gula merah', 100, '', NULL),
(17, 'gula pasir gulaku', 100, '', NULL),
(18, 'jintan bubuk', 100, '', NULL),
(19, 'kapulaga', 100, '', NULL),
(20, 'katsuo dashi', 100, '', NULL),
(21, 'kayu manis batang', 100, '', NULL),
(22, 'kayu manis bubuk', 100, '', NULL),
(23, 'kecap asin abc', 100, '', NULL),
(24, 'kecap asin kikoman', 100, '', NULL),
(25, 'kecap inggris', 100, '', NULL),
(26, 'kecap manis bango', 100, '', NULL),
(27, 'kecap manis jepang', 100, '', NULL),
(28, 'keju permesan', 100, '', NULL),
(29, 'ketumba bubuk', 100, '', NULL),
(30, 'ketumbar bubuk', 100, '', NULL),
(31, 'kluwek', 100, '', NULL),
(32, 'knor chicken', 100, '', NULL),
(33, 'lada hitam', 100, '', NULL),
(34, 'lada putih', 100, '', NULL),
(35, 'madu tj ', 100, '', NULL),
(36, 'marinasi', 100, '', NULL),
(37, 'mayo chef style', 100, '', NULL),
(38, 'mayo kewpie', 100, '', NULL),
(39, 'mayo maestro', 100, '', NULL),
(40, 'minyak canola', 100, '', NULL),
(41, 'minyak wijen', 100, '', NULL),
(42, 'monalisa', 100, '', NULL),
(43, 'mozarella', 100, '', NULL),
(44, 'mustard', 100, '', NULL),
(45, 'natrium benzoat', 100, '', NULL),
(46, 'onion powder ', 100, '', NULL),
(47, 'oregano', 100, '', NULL),
(48, 'pala bubuk', 100, '', NULL),
(49, 'parsley kering', 100, '', NULL),
(50, 'pewarna merah cabe', 100, '', NULL),
(51, 'rice improver', 100, '', NULL),
(52, 'saus bbq leekumke', 100, '', NULL),
(53, 'saus gochujang', 100, '', NULL),
(54, 'saus katsu', 100, '', NULL),
(55, 'saus nanban ', 100, '', NULL),
(56, 'saus sambal mclewis', 100, '', NULL),
(57, 'saus teriyaki', 100, '', NULL),
(58, 'saus tiram', 100, '', NULL),
(59, 'saus tomat mclewis', 100, '', NULL),
(60, 'sttp', 100, '', NULL),
(61, 'tepung beras', 100, '', NULL),
(62, 'tepung maizena', 100, '', NULL),
(63, 'tepung pak tani', 100, '', NULL),
(64, 'tepung segitiga biru', 100, '', NULL),
(65, 'tepung tapioka gunung agung', 100, '', NULL),
(66, 'terasi ', 100, '', NULL),
(67, 'totole', 100, '', NULL),
(68, 'trehalose', 100, '', NULL),
(69, 'truffle', 100, '', NULL),
(70, 'unsalted butter', 10, '', 'ajiplus.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_stok_barang`
--

CREATE TABLE `laporan_stok_barang` (
  `id_laporanStok` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah_stokbarang` int(11) NOT NULL,
  `tanggal_laporan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Trigger `laporan_stok_barang`
--
DELIMITER $$
CREATE TRIGGER `after_delete_laporan_stok` AFTER DELETE ON `laporan_stok_barang` FOR EACH ROW BEGIN
    UPDATE stok_persediaan_barang
    SET jumlah_stokbarang = jumlah_stokbarang - OLD.jumlah_stokbarang,
        tanggal_update = OLD.tanggal_laporan
    WHERE id_barang = OLD.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_laporan_stok` AFTER INSERT ON `laporan_stok_barang` FOR EACH ROW BEGIN
    UPDATE stok_persediaan_barang
    SET jumlah_stokbarang = jumlah_stokbarang + NEW.jumlah_stokbarang,
        tanggal_update = NEW.tanggal_laporan
    WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_laporan_stok` AFTER UPDATE ON `laporan_stok_barang` FOR EACH ROW BEGIN
    UPDATE stok_persediaan_barang
    SET jumlah_stokbarang = jumlah_stokbarang - OLD.jumlah_stokbarang + NEW.jumlah_stokbarang,
        tanggal_update = NEW.tanggal_laporan
    WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;

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
(1, '2024-07-19-100000', 'App\\Database\\Migrations\\CreateStockOutTable', 'default', 'App', 1721390522, 1);

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
(1, 1, 0, 'completed', '2024-07-19 13:04:59'),
(2, 1, 0, 'completed', '2024-07-19 13:05:20'),
(3, 1, 0, 'completed', '2024-07-19 14:17:29'),
(4, 1, 0, 'completed', '2024-07-19 14:23:02'),
(5, 1, 0, 'completed', '2024-07-19 16:29:37'),
(6, 1, 0, 'completed', '2024-07-19 17:16:17'),
(7, 1, 0, 'Success', '2024-07-21 02:16:21'),
(8, 1, 0, 'Success', '2024-07-21 02:20:56'),
(9, 1, 0, 'completed', '2024-07-21 02:38:57'),
(10, 1, 0, 'completed', '2024-07-21 02:41:49'),
(11, 1, 0, 'completed', '2024-07-21 02:43:24'),
(12, 1, 0, 'completed', '2024-07-21 02:44:23'),
(13, 1, 0, 'completed', '2024-07-21 02:54:01'),
(14, 1, 0, 'completed', '2024-07-21 02:54:54'),
(15, 2, 0, 'completed', '2024-07-21 02:55:43'),
(16, 2, 0, 'completed', '2024-07-21 02:56:08'),
(17, 2, 0, 'completed', '2024-07-21 02:57:04'),
(18, 2, 3, 'completed', '2024-07-21 02:57:55'),
(19, 1, 0, 'completed', '2024-07-21 02:58:36'),
(20, 1, 3, 'completed', '2024-07-21 03:00:11'),
(21, 1, 0, 'completed', '2024-07-21 03:01:14'),
(22, 0, 0, 'completed', '2024-07-21 03:04:27'),
(23, 0, 0, 'completed', '2024-07-21 03:09:58'),
(24, 1, 0, 'completed', '2024-07-21 03:12:41'),
(25, 1, 3, 'completed', '2024-07-21 03:13:56'),
(26, 1, 3, 'completed', '2024-07-21 04:14:57');

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
(1, 1, 2, 1),
(2, 2, 2, 1),
(3, 3, 1, 7),
(4, 3, 2, 4),
(5, 4, 1, 4),
(6, 5, 4, 4),
(7, 5, 1, 3),
(8, 6, 3, 1),
(9, 7, 2, 2),
(10, 8, 1, 1),
(11, 9, 1, 1),
(12, 10, 1, 1),
(13, 11, 1, 1),
(14, 12, 1, 1),
(15, 13, 1, 1),
(16, 14, 1, 1),
(17, 15, 2, 1),
(18, 16, 1, 1),
(19, 17, 1, 1),
(20, 18, 1, 1),
(21, 19, 3, 1),
(22, 20, 2, 1),
(23, 21, 1, 1),
(24, 22, 1, 1),
(25, 23, 2, 1),
(26, 24, 1, 1),
(27, 25, 1, 1),
(28, 26, 1, 5),
(29, 26, 2, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pre_orders`
--

CREATE TABLE `pre_orders` (
  `id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `status` enum('pending','completed','canceled') DEFAULT 'pending',
  `noted_by` varchar(255) DEFAULT NULL,
  `received_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pre_order_items`
--

CREATE TABLE `pre_order_items` (
  `id` int(11) NOT NULL,
  `pre_order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(4, 'QC'),
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
(1, 'Supplier A', 'Produksi A', '081234567890', '2024-07-11 06:23:00', '', NULL),
(2, 'Supplier B', 'Produksi B', '082345678901', '2024-07-11 06:23:00', '', NULL),
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
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_created_at`, `role_id`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$Q4NLzvmUAgSdIuh2GM63gOyoObrLO1q001lS208gNSjHYkjwmcF.W', '2024-07-16 18:50:09', 1),
(2, 'manager', 'manager@gmail.com', '$2y$10$Q4NLzvmUAgSdIuh2GM63gOyoObrLO1q001lS208gNSjHYkjwmcF.W', '2024-07-16 18:57:18', 2),
(3, 'staff', 'staff@gmail.com', '$2y$10$Q4NLzvmUAgSdIuh2GM63gOyoObrLO1q001lS208gNSjHYkjwmcF.W', '2024-07-16 18:57:18', 3),
(4, 'QC', 'qc@gmail.com', '$2y$10$Q4NLzvmUAgSdIuh2GM63gOyoObrLO1q001lS208gNSjHYkjwmcF.W', '2024-07-16 18:57:18', 4);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

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
-- Indeks untuk tabel `laporan_stok_barang`
--
ALTER TABLE `laporan_stok_barang`
  ADD PRIMARY KEY (`id_laporanStok`),
  ADD KEY `id_barang` (`id_barang`);

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
-- Indeks untuk tabel `pre_orders`
--
ALTER TABLE `pre_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indeks untuk tabel `pre_order_items`
--
ALTER TABLE `pre_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pre_order_id` (`pre_order_id`),
  ADD KEY `item_id` (`item_id`);

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
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id_inventory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `items`
--
ALTER TABLE `items`
  MODIFY `id_items` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT untuk tabel `laporan_stok_barang`
--
ALTER TABLE `laporan_stok_barang`
  MODIFY `id_laporanStok` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `outbounds`
--
ALTER TABLE `outbounds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `outbounds_items`
--
ALTER TABLE `outbounds_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `pre_orders`
--
ALTER TABLE `pre_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pre_order_items`
--
ALTER TABLE `pre_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id_suppliers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`id_items`) REFERENCES `items` (`id_items`),
  ADD CONSTRAINT `inventory_ibfk_2` FOREIGN KEY (`id_suppliers`) REFERENCES `suppliers` (`id_suppliers`);

--
-- Ketidakleluasaan untuk tabel `laporan_stok_barang`
--
ALTER TABLE `laporan_stok_barang`
  ADD CONSTRAINT `laporan_stok_barang_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `items` (`id_items`);

--
-- Ketidakleluasaan untuk tabel `pre_orders`
--
ALTER TABLE `pre_orders`
  ADD CONSTRAINT `pre_orders_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id_suppliers`);

--
-- Ketidakleluasaan untuk tabel `pre_order_items`
--
ALTER TABLE `pre_order_items`
  ADD CONSTRAINT `pre_order_items_ibfk_1` FOREIGN KEY (`pre_order_id`) REFERENCES `pre_orders` (`id`),
  ADD CONSTRAINT `pre_order_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id_items`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

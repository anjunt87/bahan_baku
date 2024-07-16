-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jul 2024 pada 15.50
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
  `date_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `inventory`
--

INSERT INTO `inventory` (`id_inventory`, `id_items`, `name_items`, `id_suppliers`, `stock_items`, `taken_by`, `noted_by`, `date_update`) VALUES
(6, 1, 'ajiplus', 3, 1, '4', 'admin', '2024-07-16 13:36:42'),
(7, 33, 'lada hitam', 3, 111, 'QC', 'admin', '2024-07-16 13:43:38'),
(8, 68, 'trehalose', 3, 313, 'admin', 'admin', '2024-07-16 13:48:18'),
(9, 1, 'ajiplus', 1, -111, '3', 'admin', '2024-07-16 13:48:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `items`
--

CREATE TABLE `items` (
  `id_items` int(11) NOT NULL,
  `name_items` varchar(255) NOT NULL,
  `stock_items` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `items`
--

INSERT INTO `items` (`id_items`, `name_items`, `stock_items`) VALUES
(1, 'ajiplus', 76),
(2, 'baking powder', 11),
(3, 'bawang goreng', 0),
(4, 'biji wijen putih', 0),
(5, 'bumbu cabe ichimi', 0),
(6, 'bumbu lumur sasa', 0),
(7, 'bunga lawang ', 0),
(8, 'cengkeh ', 0),
(9, 'cream cheese', 0),
(10, 'cuka', 0),
(11, 'ebi ', 0),
(12, 'fish saush', 0),
(13, 'garam ', 0),
(14, 'garlic powder', 0),
(15, 'gula aren', 0),
(16, 'gula merah', 0),
(17, 'gula pasir gulaku', 0),
(18, 'jintan bubuk', 0),
(19, 'kapulaga', 0),
(20, 'katsuo dashi', 0),
(21, 'kayu manis batang', 0),
(22, 'kayu manis bubuk', 0),
(23, 'kecap asin abc', 0),
(24, 'kecap asin kikoman', 0),
(25, 'kecap inggris', 0),
(26, 'kecap manis bango', 0),
(27, 'kecap manis jepang', 0),
(28, 'keju permesan', 0),
(29, 'ketumba bubuk', 0),
(30, 'ketumbar bubuk', 0),
(31, 'kluwek', 0),
(32, 'knor chicken', 0),
(33, 'lada hitam', 0),
(34, 'lada putih', 0),
(35, 'madu tj ', 0),
(36, 'marinasi', 0),
(37, 'mayo chef style', 0),
(38, 'mayo kewpie', 0),
(39, 'mayo maestro', 0),
(40, 'minyak canola', 0),
(41, 'minyak wijen', 0),
(42, 'monalisa', 0),
(43, 'mozarella', 0),
(44, 'mustard', 0),
(45, 'natrium benzoat', 0),
(46, 'onion powder ', 0),
(47, 'oregano', 0),
(48, 'pala bubuk', 0),
(49, 'parsley kering', 0),
(50, 'pewarna merah cabe', 0),
(51, 'rice improver', 0),
(52, 'saus bbq leekumke', 0),
(53, 'saus gochujang', 0),
(54, 'saus katsu', 0),
(55, 'saus nanban ', 0),
(56, 'saus sambal mclewis', 0),
(57, 'saus teriyaki', 0),
(58, 'saus tiram', 0),
(59, 'saus tomat mclewis', 0),
(60, 'sttp', 0),
(61, 'tepung beras', 0),
(62, 'tepung maizena', 0),
(63, 'tepung pak tani', 0),
(64, 'tepung segitiga biru', 0),
(65, 'tepung tapioka gunung agung', 0),
(66, 'terasi ', 0),
(67, 'totole', 0),
(68, 'trehalose', 0),
(69, 'truffle', 0),
(70, 'unsalted butter', 0);

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `suppliers`
--

INSERT INTO `suppliers` (`id_suppliers`, `name_suppliers`, `production_suppliers`, `contact_suppliers`, `created_at`) VALUES
(1, 'Supplier A', 'Produksi A', '081234567890', '2024-07-11 06:23:00'),
(2, 'Supplier B', 'Produksi B', '082345678901', '2024-07-11 06:23:00'),
(3, 'Supplier C', 'Produksi C', '083456789012', '2024-07-11 06:23:00');

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
-- AUTO_INCREMENT untuk tabel `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id_inventory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `items`
--
ALTER TABLE `items`
  MODIFY `id_items` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT untuk tabel `laporan_stok_barang`
--
ALTER TABLE `laporan_stok_barang`
  MODIFY `id_laporanStok` int(11) NOT NULL AUTO_INCREMENT;

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
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

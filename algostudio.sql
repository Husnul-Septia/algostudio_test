-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2021 at 09:05 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `algostudio`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktivitas_stok`
--

CREATE TABLE `aktivitas_stok` (
  `kode_aktivitas` int(11) NOT NULL,
  `kode_user` int(11) NOT NULL,
  `type_user` varchar(15) NOT NULL,
  `kode_produk` int(11) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `status` int(2) NOT NULL,
  `tanggal_aktivitas` datetime NOT NULL,
  `qty_stok` double NOT NULL,
  `sisa_stok` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aktivitas_stok`
--

INSERT INTO `aktivitas_stok` (`kode_aktivitas`, `kode_user`, `type_user`, `kode_produk`, `deskripsi`, `status`, `tanggal_aktivitas`, `qty_stok`, `sisa_stok`) VALUES
(1, 2, 'supplier', 2, 'Penambahan Stok', 1, '2021-02-16 05:24:12', 40, 0),
(2, 2, 'supplier', 2, 'Penambahan Stok', 1, '2021-02-16 05:31:24', 45, 0),
(3, 3, 'supplier', 1, 'Penambahan Stok', 1, '2021-02-16 05:32:42', 45, 0),
(4, 2, 'distibutor', 2, 'Pengurangan Stok', 2, '2021-02-16 05:45:00', 12, 0),
(5, 1, 'supplier', 2, 'Penambahan Stok', 1, '2021-02-16 05:45:33', 10, 0),
(6, 2, 'supplier', 2, 'Penambahan Stok', 1, '2021-02-16 05:46:11', 10, 0),
(7, 1, 'distibutor', 2, 'Pengurangan Stok', 2, '2021-02-16 05:46:40', 17, 0),
(8, 3, 'supplier', 3, 'Penambahan Stok', 1, '2021-02-16 06:23:49', 15, 50),
(9, 2, 'distibutor', 3, 'Pengurangan Stok', 2, '2021-02-16 06:24:25', 35, 15);

-- --------------------------------------------------------

--
-- Stand-in structure for view `average_produk`
-- (See below for the actual view)
--
CREATE TABLE `average_produk` (
`kode_produk` int(11)
,`nama_produk` varchar(50)
,`nama_supplier` varchar(50)
,`ave_produk` double
);

-- --------------------------------------------------------

--
-- Table structure for table `distributor`
--

CREATE TABLE `distributor` (
  `kode_distributor` int(11) NOT NULL,
  `nama_distributor` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kontak` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `distributor`
--

INSERT INTO `distributor` (`kode_distributor`, `nama_distributor`, `alamat`, `kontak`) VALUES
(1, 'Akim Glass', 'Yogyakarta', '08374327774'),
(2, 'Syil_cat', 'Bogor', '8377743434');

-- --------------------------------------------------------

--
-- Stand-in structure for view `laporan_produk_a`
-- (See below for the actual view)
--
CREATE TABLE `laporan_produk_a` (
`kode_produk` int(11)
,`nama_produk` varchar(50)
,`masuk` double
,`stokkeluar` double
,`sisa_stok` double
);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(50) DEFAULT NULL,
  `harga_jual` double NOT NULL,
  `harga_beli` double NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `harga_jual`, `harga_beli`, `stok`) VALUES
(1, 'Gelas Kaca', 10000, 13000, 157),
(2, 'Gelas Plastik', 15000, 12500, 100),
(3, 'Piring aluminium', 35000, 32000, 15);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `kode_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kontak` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`kode_supplier`, `nama_supplier`, `alamat`, `kontak`) VALUES
(1, 'Tya_Shop', 'Yogyakarta', '0'),
(2, 'Husnul_Shop', 'Bandung', '0'),
(3, 'EM_Tect', 'Yogyakarta Sleman', '084848577552'),
(4, 'Ran_informa', 'Bandung', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `phone_verified_at` datetime DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `remember_token` varchar(500) DEFAULT NULL,
  `password_reset_code` varchar(255) DEFAULT NULL,
  `device_token` varchar(255) DEFAULT NULL,
  `account_status` varchar(30) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `phone`, `phone_verified_at`, `photo`, `last_login`, `created_at`, `updated_at`, `remember_token`, `password_reset_code`, `device_token`, `account_status`) VALUES
(1, NULL, NULL, 'admin@test.com', NULL, '$2y$10$0QtHFdNEQulI1QyL84yBqeaqrH751kGhPpK4AMMn3GnUeFoqCj/yy', NULL, NULL, NULL, NULL, '2020-10-19 08:51:37', '2020-10-19 08:51:37', NULL, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Structure for view `average_produk`
--
DROP TABLE IF EXISTS `average_produk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `average_produk`  AS  (select `tab`.`kode_produk` AS `kode_produk`,`tab`.`nama_produk` AS `nama_produk`,`tab`.`nama_supplier` AS `nama_supplier`,`tab`.`qtymasuk` / `tab`.`jumlah_produk` AS `ave_produk` from (select `s`.`kode_produk` AS `kode_produk`,`p`.`nama_produk` AS `nama_produk`,`sup`.`nama_supplier` AS `nama_supplier`,sum(`s`.`qty_stok`) AS `qtymasuk`,count(`p`.`id`) AS `jumlah_produk` from ((`aktivitas_stok` `s` left join `produk` `p` on(`p`.`id` = `s`.`kode_produk`)) left join `supplier` `sup` on(`sup`.`kode_supplier` = `s`.`kode_user`)) where `s`.`status` = 1 group by `p`.`id`) `tab`) ;

-- --------------------------------------------------------

--
-- Structure for view `laporan_produk_a`
--
DROP TABLE IF EXISTS `laporan_produk_a`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_produk_a`  AS  (select `tea`.`kode_produk` AS `kode_produk`,`tea`.`nama_produk` AS `nama_produk`,sum(`tea`.`masuk`) AS `masuk`,sum(`tea`.`keluar`) AS `stokkeluar`,`tea`.`sisa_stok` AS `sisa_stok` from (select `s`.`kode_produk` AS `kode_produk`,`p`.`nama_produk` AS `nama_produk`,sum(`s`.`qty_stok`) AS `masuk`,'0' AS `keluar`,`s`.`sisa_stok` AS `sisa_stok` from (`aktivitas_stok` `s` left join `produk` `p` on(`p`.`id` = `s`.`kode_produk`)) where `s`.`status` = 1 and `s`.`tanggal_aktivitas` between '2021-02-01 00:00:00' and '2021-02-30 00:00:00' group by `s`.`kode_produk` union select `s`.`kode_produk` AS `kode_produk`,`p`.`nama_produk` AS `nama_produk`,'0' AS `masuk`,sum(`s`.`qty_stok`) AS `keluar`,`s`.`sisa_stok` AS `sisa_stok` from (`aktivitas_stok` `s` left join `produk` `p` on(`p`.`id` = `s`.`kode_produk`)) where `s`.`status` = 2 and `s`.`tanggal_aktivitas` between '2021-02-01 00:00:00' and '2021-02-30 00:00:00' group by `s`.`kode_produk`) `tea` group by `tea`.`kode_produk`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktivitas_stok`
--
ALTER TABLE `aktivitas_stok`
  ADD PRIMARY KEY (`kode_aktivitas`);

--
-- Indexes for table `distributor`
--
ALTER TABLE `distributor`
  ADD PRIMARY KEY (`kode_distributor`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`kode_supplier`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktivitas_stok`
--
ALTER TABLE `aktivitas_stok`
  MODIFY `kode_aktivitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `distributor`
--
ALTER TABLE `distributor`
  MODIFY `kode_distributor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `kode_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15334;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

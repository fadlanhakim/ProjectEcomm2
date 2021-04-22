-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2021 at 06:39 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_brg` int(11) NOT NULL,
  `nama_brg` varchar(120) NOT NULL,
  `keterangan` varchar(225) NOT NULL,
  `kategori` varchar(60) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(4) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_brg`, `nama_brg`, `keterangan`, `kategori`, `harga`, `stok`, `gambar`) VALUES
(1, 'Mouse Legion M300', 'Mouse Gaming Merk Lenovo', 'Mouse Gaming', 195000, 26, 'mouselenovo.jpg'),
(2, 'Keyboard Mecha Shield Full Keys', 'Keyboard Gaming Merk Digital Alliance', 'Keyboard Gaming', 499000, 47, 'dagkeyboard.jpg'),
(3, 'Headset Valor MH86', 'Headset Gaming Merk Fantech', 'Headset Gaming', 219000, 37, 'valormh86.jpg'),
(11, 'Monitor Oddysey G7', 'Monitor Gaming Merk Samsung', 'Monitor Gaming', 11999000, 37, 'monitorsamsung1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_invoice`
--

CREATE TABLE `tb_invoice` (
  `id` int(11) NOT NULL,
  `nama` varchar(56) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `batas_bayar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_invoice`
--

INSERT INTO `tb_invoice` (`id`, `nama`, `alamat`, `tgl_pesan`, `batas_bayar`) VALUES
(10, 'Michele Jordan', 'Kudus, Jawa Tengah', '2021-04-22 22:19:39', '2021-04-23 22:19:39');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pesanan`
--

CREATE TABLE `tb_pesanan` (
  `id` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `id_brg` int(11) NOT NULL,
  `nama_brg` varchar(50) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `harga` int(10) NOT NULL,
  `pilihan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pesanan`
--

INSERT INTO `tb_pesanan` (`id`, `id_invoice`, `id_brg`, `nama_brg`, `jumlah`, `harga`, `pilihan`) VALUES
(1, 3, 1, 'Mouse Legion M300', 1, 195000, ''),
(2, 3, 2, 'Keyboard Mecha Shield Full Keys', 1, 499000, ''),
(3, 3, 3, 'Headset Valor MH86', 1, 219000, ''),
(4, 3, 11, 'Monitor Oddysey G7', 1, 11999000, ''),
(5, 5, 2, 'Keyboard Mecha Shield Full Keys', 2, 499000, ''),
(6, 6, 1, 'Mouse Legion M300', 2, 195000, ''),
(7, 6, 2, 'Keyboard Mecha Shield Full Keys', 2, 499000, ''),
(8, 6, 3, 'Headset Valor MH86', 2, 219000, ''),
(9, 6, 11, 'Monitor Oddysey G7', 2, 11999000, ''),
(10, 7, 1, 'Mouse Legion M300', 1, 195000, ''),
(11, 8, 1, 'Mouse Legion M300', 1, 195000, ''),
(12, 8, 2, 'Keyboard Mecha Shield Full Keys', 1, 499000, ''),
(13, 8, 3, 'Headset Valor MH86', 1, 219000, ''),
(14, 8, 11, 'Monitor Oddysey G7', 1, 11999000, ''),
(15, 9, 1, 'Mouse Legion M300', 1, 195000, ''),
(16, 9, 2, 'Keyboard Mecha Shield Full Keys', 1, 499000, ''),
(17, 9, 3, 'Headset Valor MH86', 1, 219000, ''),
(18, 9, 11, 'Monitor Oddysey G7', 1, 11999000, ''),
(19, 10, 1, 'Mouse Legion M300', 1, 195000, ''),
(20, 10, 2, 'Keyboard Mecha Shield Full Keys', 1, 499000, ''),
(21, 10, 3, 'Headset Valor MH86', 1, 219000, ''),
(22, 10, 11, 'Monitor Oddysey G7', 1, 11999000, '');

--
-- Triggers `tb_pesanan`
--
DELIMITER $$
CREATE TRIGGER `pesanan_penjualan` AFTER INSERT ON `tb_pesanan` FOR EACH ROW BEGIN
	UPDATE tb_barang SET stok = stok-NEW.jumlah
    WHERE id_brg = NEW.id_brg;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role_id` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `username`, `password`, `role_id`) VALUES
(1, 'admin', 'admin', '123', 1),
(2, 'user', 'user', '123', 2),
(3, 'Valen', 'Valentino', '123', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_brg`);

--
-- Indexes for table `tb_invoice`
--
ALTER TABLE `tb_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_brg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_invoice`
--
ALTER TABLE `tb_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

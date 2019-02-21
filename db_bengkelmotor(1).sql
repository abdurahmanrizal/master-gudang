-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 23, 2019 at 08:52 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bengkelmotor`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(10) DEFAULT NULL,
  `nama_barang` varchar(50) DEFAULT NULL,
  `stok` int(5) DEFAULT NULL,
  `id_jenis` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `kode_barang`, `nama_barang`, `stok`, `id_jenis`) VALUES
(2, 'BRG0002', 'Mesin', 6, 2),
(3, 'BRG0003', 'Knalpot', 3, 1),
(4, 'BRG0004', 'Lampu Sen', 3, 1),
(5, 'BRG0005', 'Oli Mesin', 20, 1),
(6, 'BRG0006', 'pistol', 5, 2),
(20, 'BRG001', 'test', 1, 1),
(21, 'BRG002', 'test2', 12, 1),
(22, 'BRG003', 'test3', 1, 2),
(23, 'BRG004', 'test3', 1, 1),
(24, 'BRG005', 'test2', 10, 1),
(25, 'BRG006', 'test2', 1, 2),
(41, 'BRG007', 'test', 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id_history` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL DEFAULT '0',
  `kode_barang` varchar(10) DEFAULT NULL,
  `nama_barang` varchar(50) DEFAULT NULL,
  `stok` int(5) DEFAULT NULL,
  `id_jenis` int(11) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `jenis_update` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id_history`, `id_barang`, `kode_barang`, `nama_barang`, `stok`, `id_jenis`, `create_at`, `jenis_update`) VALUES
(18, 0, NULL, NULL, 0, NULL, '2019-01-22 16:35:48', 0),
(19, 0, NULL, NULL, 6, NULL, '2019-01-22 17:07:46', 0),
(20, 4, 'BRG0004', 'Lampu Sen', 5, 1, '2019-01-22 17:13:34', 0),
(21, 5, 'BRG0005', 'Oli Mesin', 0, 1, '2019-01-22 17:18:33', 0),
(22, 5, 'BRG0005', 'Oli Mesin', 0, 1, '2019-01-22 17:19:50', 0),
(23, 5, 'BRG0005', 'Oli Mesin', 20, 1, '2019-01-22 17:22:15', 0),
(24, 6, 'BRG0006', 'pistol', 0, 2, '2019-01-22 17:35:18', 3),
(25, 6, 'BRG0006', 'pistol', 3, 2, '2019-01-22 17:41:24', 1),
(26, 5, 'BRG0005', 'Oli Mesin', 5, 1, '2019-01-22 17:41:57', 2),
(27, 2, 'BRG0002', 'Mesin', 2, 1, '2019-01-22 17:46:56', 1),
(28, 2, 'BRG0002', 'Mesin', 3, 1, '2019-01-22 17:47:48', 1),
(29, 2, 'BRG0002', 'Mesin', 3, 2, '2019-01-22 17:51:41', 2),
(30, 2, 'BRG0002', 'Mesin', 3, 2, '2019-01-22 17:52:24', 1),
(31, 2, 'BRG0002', 'Mesin', 1, 2, '2019-01-22 17:53:09', 1),
(32, 2, 'BRG0002', 'Mesin', 1, 2, '2019-01-22 17:53:48', 1),
(33, 3, 'BRG0003', 'Knalpot', 1, 1, '2019-01-22 17:56:41', 2),
(34, 2, 'BRG0002', 'Mesin', 1, 2, '2019-01-22 18:02:15', 1),
(35, 2, 'BRG0002', 'Mesin', 1, 1, '2019-01-22 18:05:52', 2),
(41, 36, 'BRG010', 'rrr', 1, 1, '2019-01-23 00:24:58', 2),
(42, 36, 'BRG010', 'rrr', 2, 1, '2019-01-23 00:25:35', 1),
(43, 36, 'BRG010', 'rrr', 6, 1, '2019-01-23 01:04:52', 2),
(44, 0, 'BRG011', 'test11', 0, 3, '2019-01-23 01:06:48', 2),
(45, 0, 'BRG011', 'test20', 13, 2, '2019-01-23 01:07:57', 2),
(46, 2, 'BRG0002', 'Mesin', 1, 2, '2019-01-23 02:50:20', 1),
(47, 0, 'BRG009', 'aqua', 13, 3, '2019-01-23 04:02:29', 2),
(48, 0, 'BRG007', 'mmmm', 10, 3, '2019-01-23 04:06:55', 2),
(49, 40, 'BRG007', 'mmmm', 5, 3, '2019-01-23 04:07:22', 1),
(50, 0, 'BRG007', 'test', 12, 1, '2019-01-23 04:13:51', 2),
(51, 41, 'BRG007', 'test', 5, 1, '2019-01-23 04:14:08', 2);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id_jenis` int(11) NOT NULL,
  `jenis_barang` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`id_jenis`, `jenis_barang`) VALUES
(1, 'Jenis A'),
(2, 'senjata'),
(3, 'botol'),
(5, 'coba'),
(6, 'b');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_user`, `username`, `password`, `level`) VALUES
(1, 'iniadmin', 'admin', 'admin', 'admin'),
(6, 'user', 'user', 'user', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id_history`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

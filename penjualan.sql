-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2017 at 10:32 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_terjual`
--

CREATE TABLE `barang_terjual` (
  `id_terjual` int(5) NOT NULL,
  `id_barang` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `harga` int(50) NOT NULL,
  `total_harga` int(50) NOT NULL,
  `laba` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_terjual`
--

INSERT INTO `barang_terjual` (`id_terjual`, `id_barang`, `tanggal`, `nama`, `jumlah`, `harga`, `total_harga`, `laba`) VALUES
(3, 4, '2017-12-10', 'Biskuat', 5, 600, 3000, 1000),
(4, 6, '2017-12-10', 'Radio', 7, 500000, 3500000, 1750000),
(5, 2, '2017-12-09', 'Keyboard', 4, 200000, 800000, 200000),
(6, 8, '2017-12-08', 'HP', 2, 150000, 300000, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `barang_terjual1`
--

CREATE TABLE `barang_terjual1` (
  `id_barang` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `harga` int(50) NOT NULL,
  `total_harga` int(50) NOT NULL,
  `laba` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_terjual1`
--

INSERT INTO `barang_terjual1` (`id_barang`, `tanggal`, `nama`, `jumlah`, `harga`, `total_harga`, `laba`) VALUES
(1, '2017-12-19', 'roti', 3, 5000, 15000, 120312),
(2, '2016-07-30', 'roti isi daging', 1, 5000, 5000, 2000),
(3, '2016-07-29', 'Keyboard', 20, 200000, 4000000, 50000),
(4, '2016-07-30', 'Keyboard', 2, 190000, 380000, 80000),
(5, '2016-07-30', 'Biskuat', 10, 1000, 10000, 6000),
(6, '2016-07-30', 'Biskuat', 15, 1000, 15000, 9000),
(7, '2016-07-30', 'Biskuat', 5, 1000, 5000, 3000),
(8, '2016-07-30', 'roti isi daging', 4, 5000, 20000, 8000),
(9, '2016-07-30', 'Radio', 1, 500000, 500000, 250000),
(10, '2016-07-31', 'roti bakar', 3, 10000, 30000, 3000),
(11, '2016-08-03', 'Biskuat', 5, 600, 3000, 1000),
(12, '2016-08-03', 'meja', 5, 100000, 500000, 250000),
(13, '2016-08-04', 'Mos', 2, 50000, 100000, 40000),
(16, '2016-08-05', 'Biskuat', 10, 600, 6000, 2000),
(17, '2016-08-05', 'Biskuat', 5, 600, 3000, 1000),
(18, '2016-08-05', 'Radio', 2, 500000, 1000000, 500000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(5) NOT NULL,
  `nama_brg` varchar(30) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `suplier` varchar(50) NOT NULL,
  `harga_modal` int(50) NOT NULL,
  `harga_jual` int(50) NOT NULL,
  `jumlah` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `nama_brg`, `jenis`, `suplier`, `harga_modal`, `harga_jual`, `jumlah`) VALUES
(1, 'roti isi daging', 'Makanan', 'Pt Tataboga lestari', 3000, 5000, 100),
(2, 'Keyboard', 'Komputer', 'pt. key indo', 150000, 200000, 96),
(3, 'roti bakar', 'makanan', 'pt boga tata', 9000, 10000, 100),
(4, 'Biskuat', 'Makanan', 'PT biskuat', 400, 600, 95),
(5, 'Mos', 'Elektronik', 'PT pingwin raksasa', 30000, 50000, 100),
(6, 'Radio', 'Elektronik', 'PT radio FM', 250000, 500000, 92),
(7, 'meja', 'Papan', 'PT meja', 50000, 100000, 100),
(8, 'HP', 'Elektronik', 'Nokia', 100000, 150000, 98),
(9, 'Sabun R', 'Deterjen', 'Rinso', 800, 1000, 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_terjual`
--
ALTER TABLE `barang_terjual`
  ADD PRIMARY KEY (`id_terjual`);

--
-- Indexes for table `barang_terjual1`
--
ALTER TABLE `barang_terjual1`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_terjual`
--
ALTER TABLE `barang_terjual`
  MODIFY `id_terjual` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `barang_terjual1`
--
ALTER TABLE `barang_terjual1`
  MODIFY `id_barang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

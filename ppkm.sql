-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2021 at 04:10 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppkm`
--

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten_kota`
--

CREATE TABLE `kabupaten_kota` (
  `id_kab_kota` int(10) UNSIGNED NOT NULL,
  `id_provinsi` int(10) UNSIGNED NOT NULL,
  `nama_kab_kota` varchar(200) DEFAULT NULL,
  `jml_total_penduduk` double DEFAULT NULL,
  `jml_lansia` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kabupaten_kota`
--

INSERT INTO `kabupaten_kota` (`id_kab_kota`, `id_provinsi`, `nama_kab_kota`, `jml_total_penduduk`, `jml_lansia`) VALUES
(5, 14, 'Semarang', 1000000, 20000),
(6, 16, 'Tulungagung', 1000000, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `id_provinsi` int(10) UNSIGNED NOT NULL,
  `nama_provinsi` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id_provinsi`, `nama_provinsi`) VALUES
(1, 'Nanggroe Aceh Darussalam'),
(2, 'Sumatera Utara'),
(3, 'Sumatera Barat'),
(4, 'Riau'),
(5, 'Jambi'),
(6, 'Sumatera Selatan'),
(7, 'Bengkulu'),
(8, 'Lampung'),
(9, 'Kep. Bangka Belitung'),
(10, 'Kepulauan Riau'),
(11, 'Banten'),
(12, 'Dki Jakarta'),
(13, 'Jawa Barat'),
(14, 'Jawa Tengah'),
(15, 'D.I. Yogyakarta'),
(16, 'Jawa Timur'),
(17, 'Banten'),
(18, 'Bali'),
(19, 'Nusa Tenggara Barat'),
(20, 'Nusa Tenggara Timur'),
(21, 'Kalimantan Barat'),
(22, 'Kalimantan Tengah'),
(23, 'Kalimantan Selatan'),
(24, 'Kalimantan Timur'),
(25, 'Gorontalo'),
(26, 'Sulawesi Utara'),
(27, 'Sulawesi Tengah'),
(28, 'Sulawesi Selatan'),
(29, 'Sulawesi Tenggara'),
(30, 'Gorontalo'),
(31, 'Sulawesi Barat'),
(32, 'Maluku'),
(33, 'Maluku Utara'),
(34, 'Maluku Utara'),
(35, 'Papua Barat'),
(36, 'Irian Jaya'),
(37, 'Papua'),
(38, 'Papua Barat'),
(39, 'Papua'),
(40, 'Luar Negeri'),
(41, 'Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `vaksinasi`
--

CREATE TABLE `vaksinasi` (
  `id_vaksinasi` int(10) UNSIGNED NOT NULL,
  `id_kab_kota` int(10) UNSIGNED NOT NULL,
  `jml_total_vaksinasi` double DEFAULT NULL,
  `jml_lansia_vaksinasi` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vaksinasi`
--

INSERT INTO `vaksinasi` (`id_vaksinasi`, `id_kab_kota`, `jml_total_vaksinasi`, `jml_lansia_vaksinasi`) VALUES
(5, 5, 500000, 10000),
(6, 6, 900000, 15000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kabupaten_kota`
--
ALTER TABLE `kabupaten_kota`
  ADD PRIMARY KEY (`id_kab_kota`),
  ADD KEY `id_provinsi` (`id_provinsi`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id_provinsi`);

--
-- Indexes for table `vaksinasi`
--
ALTER TABLE `vaksinasi`
  ADD PRIMARY KEY (`id_vaksinasi`),
  ADD KEY `id_kab_kota` (`id_kab_kota`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kabupaten_kota`
--
ALTER TABLE `kabupaten_kota`
  MODIFY `id_kab_kota` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id_provinsi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `vaksinasi`
--
ALTER TABLE `vaksinasi`
  MODIFY `id_vaksinasi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kabupaten_kota`
--
ALTER TABLE `kabupaten_kota`
  ADD CONSTRAINT `kabupaten_kota_ibfk_1` FOREIGN KEY (`id_provinsi`) REFERENCES `provinsi` (`id_provinsi`);

--
-- Constraints for table `vaksinasi`
--
ALTER TABLE `vaksinasi`
  ADD CONSTRAINT `vaksinasi_ibfk_1` FOREIGN KEY (`id_kab_kota`) REFERENCES `kabupaten_kota` (`id_kab_kota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

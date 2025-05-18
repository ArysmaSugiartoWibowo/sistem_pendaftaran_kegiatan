-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2025 at 02:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `syifa`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_fakultas`
--

CREATE TABLE `tb_fakultas` (
  `id_fakultas` int(11) NOT NULL,
  `nama_fakultas` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_fakultas`
--

INSERT INTO `tb_fakultas` (`id_fakultas`, `nama_fakultas`, `status`) VALUES
(1, 'Fakultas Ekonomi dan Bisnis Islam ', 'Aktif'),
(2, 'Fakultas Syariah', 'Aktif'),
(3, 'Fakultas FUAD', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jurusan`
--

CREATE TABLE `tb_jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `id_fakultas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_jurusan`
--

INSERT INTO `tb_jurusan` (`id_jurusan`, `nama_jurusan`, `status`, `id_fakultas`) VALUES
(1, 'Manajemen Informatika', 'Aktif', 0),
(2, 'Sistem Informasi', 'Aktif', 1),
(3, 'Manajemen Bisnis Syariah ', 'Aktif', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_lpj`
--

CREATE TABLE `tb_lpj` (
  `id_lpj` int(11) DEFAULT NULL,
  `id_pendaftaran` int(11) NOT NULL,
  `dokumen_lpj` varchar(255) NOT NULL,
  `lpj_pembina` varchar(255) NOT NULL,
  `lpj_ppkn` varchar(255) NOT NULL,
  `kwitansi_bendahara` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembina`
--

CREATE TABLE `tb_pembina` (
  `id_pembina` int(11) NOT NULL,
  `id_pendaftaran` int(11) NOT NULL,
  `dokumen_proposal_ttd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pendaftaran`
--

CREATE TABLE `tb_pendaftaran` (
  `id_pendaftaran` int(11) NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `dokumen` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `id_user` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pendaftaran`
--

INSERT INTO `tb_pendaftaran` (`id_pendaftaran`, `nama_kegiatan`, `tanggal_mulai`, `tanggal_berakhir`, `dokumen`, `status`, `id_user`, `keterangan`) VALUES
(1, 'workshop IT', '2025-01-01', '2025-01-01', '1736183143.pdf', 1, 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ppkn`
--

CREATE TABLE `tb_ppkn` (
  `id_ppkn` int(11) NOT NULL,
  `id_pendaftaran` int(11) NOT NULL,
  `desposisi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL,
  `created_date` text NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `fakultas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level`, `created_date`, `jurusan`, `fakultas`) VALUES
(1, 'bendahara', '$2y$10$XFtVAjObKRNurftVkLCK/ebDsxd8NoZc.rP8vWmQZmXqEWwQbVP4W', 'bp', '', '', ''),
(2, 'PKA FEBI', '$2y$10$amGwlgCNkK/usQ7u6Zw0n.MGW/IIHQzR9ahcPjQNvCpKBYDJaa6D.', 'ppkn', '', '', '1'),
(3, 'Prodi Informatika', '$2y$10$0gG0nPYjGMQibn61rGpTEuOI.hYxSm4ZWfpDzhsxm4qnA8j9AdXSu', 'pembina', '', '1', '1'),
(4, 'HMPS Manajemen Informatika ', '$2y$10$l9XQcpiWP4adS8TjBAmPJ.fggI8rRMUHB3v4JW1R9wTESvuI8h7SS', 'hmps', '', '1', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_fakultas`
--
ALTER TABLE `tb_fakultas`
  ADD PRIMARY KEY (`id_fakultas`);

--
-- Indexes for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `tb_pembina`
--
ALTER TABLE `tb_pembina`
  ADD PRIMARY KEY (`id_pembina`);

--
-- Indexes for table `tb_pendaftaran`
--
ALTER TABLE `tb_pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`);

--
-- Indexes for table `tb_ppkn`
--
ALTER TABLE `tb_ppkn`
  ADD PRIMARY KEY (`id_ppkn`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_fakultas`
--
ALTER TABLE `tb_fakultas`
  MODIFY `id_fakultas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_pembina`
--
ALTER TABLE `tb_pembina`
  MODIFY `id_pembina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pendaftaran`
--
ALTER TABLE `tb_pendaftaran`
  MODIFY `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_ppkn`
--
ALTER TABLE `tb_ppkn`
  MODIFY `id_ppkn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

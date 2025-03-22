-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 27, 2024 at 11:19 AM
-- Server version: 5.7.24
-- PHP Version: 8.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rm`
--

-- --------------------------------------------------------

--
-- Table structure for table `terapi`
--

CREATE TABLE `terapi` (
  `id` int(11) NOT NULL,
  `no_pendaftaran` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_fisioterapis` int(11) UNSIGNED NOT NULL,
  `tanggal` datetime NOT NULL,
  `keluhan_utama` varchar(255) NOT NULL,
  `riwayat_keluhan` varchar(255) NOT NULL,
  `pemeriksaan` varchar(255) NOT NULL,
  `treatment` varchar(255) NOT NULL,
  `kesimpulan` varchar(255) NOT NULL,
  `latihan_rumah` varchar(255) NOT NULL,
  `evaluasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `terapi`
--
ALTER TABLE `terapi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_fisioterapis` (`id_fisioterapis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `terapi`
--
ALTER TABLE `terapi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `terapi`
--
ALTER TABLE `terapi`
  ADD CONSTRAINT `terapi_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `terapi_ibfk_2` FOREIGN KEY (`id_fisioterapis`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

ALTER TABLE terapi ADD COLUMN verifi BOOLEAN NULL DEFAULT FALSE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

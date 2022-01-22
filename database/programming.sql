-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2022 at 09:49 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `programming`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `foto`) VALUES
(1, 'admin', '$2y$10$WypJ0poNXFRnVlvMfCDWDeYZ4wmcvGYT0Co12jYCBJysnoaqjhZs6', 'admin.png'),
(2, 'user', '$2y$10$LIyLogIb2yNqdVBWnFi2Zu8CrHEmiLvy8/NEoejGSCRGXPA7anFZe', 'user.png');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nim` varchar(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `program_studi` varchar(50) NOT NULL,
  `no_hp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `nama`, `program_studi`, `no_hp`) VALUES
(1, '18630188', 'Nur Hasan Hendra', 'Teknik Informatika', '081352914454'),
(2, '18603275', 'Siti Khadijah', 'Sastra Inggris', '081355612903'),
(4, '18630345', 'Andy Mays', 'Pendidikan Matematika', '081356891245'),
(6, '18013321', 'Rimanna Samada', 'Akuntansi', '084455663211');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `nim` varchar(8) NOT NULL,
  `mata_kuliah` varchar(50) NOT NULL,
  `nilai` int(3) NOT NULL,
  `grade` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `nim`, `mata_kuliah`, `nilai`, `grade`) VALUES
(1, '18630188', 'Pemrograman Web', 90, 'A'),
(2, '18630188', 'Algoritma', 85, 'A'),
(3, '18630188', 'Pemrograman Berbasis Objek', 87, 'A'),
(4, '18630188', 'Sistem Basis Data', 80, 'B'),
(5, '18630188', 'Manajaemen Perangkat Lunak', 89, 'A'),
(8, '18603275', 'Kalkulus', 75, 'B'),
(9, '18603275', 'Kimia Dasar', 80, 'B'),
(11, '18630345', 'Aljabar Linier', 60, 'D'),
(12, '18630345', 'Statistika', 65, 'C'),
(13, '18630345', 'Kalkulus', 49, 'E'),
(15, '18013321', 'Ekonomi', 75, 'B'),
(16, '18013321', 'Akuntansi Dasar', 85, 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

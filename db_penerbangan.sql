-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2024 at 03:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_penerbangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `crew`
--

CREATE TABLE `crew` (
  `crew_id` int(11) NOT NULL,
  `crew_foto` varchar(255) NOT NULL,
  `crew_nama` varchar(100) NOT NULL,
  `maskapai_id` int(11) NOT NULL,
  `roles_id` int(11) NOT NULL,
  `lisensi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crew`
--

INSERT INTO `crew` (`crew_id`, `crew_foto`, `crew_nama`, `maskapai_id`, `roles_id`, `lisensi_id`) VALUES
(1, 'seungcheol.jpg', 'Choi Seungcheol', 1, 2, 3),
(2, 'jeonghan.jpg', 'Yoon Jeonghan', 5, 2, 2),
(6, 'joshua.jpg', 'Hong Jisoo', 2, 2, 3),
(7, 'jun.jpg', 'Moon Junhui', 3, 2, 1),
(10, 'hoshi.jpg', 'Kwon Soonyoung', 6, 1, 1),
(13, 'wonwoo.jpg', 'Jeon Wonwoo', 3, 2, 1),
(14, 'woozi.jpg', 'Lee Jihoon', 2, 2, 3),
(16, 'dokyeom.jpg', 'Lee Seokmin', 3, 1, 1),
(17, 'mingyu.jpg', 'Kim Mingyu', 2, 1, 3),
(18, 'minghao.jpg', 'Xu Minghao', 2, 1, 3),
(19, 'seungkwan.jpg', 'Boo Seungkwan', 5, 2, 1),
(21, 'vernon.jpg', 'Choi Hansol', 3, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `lisensi`
--

CREATE TABLE `lisensi` (
  `lisensi_id` int(11) NOT NULL,
  `lisensi_nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lisensi`
--

INSERT INTO `lisensi` (`lisensi_id`, `lisensi_nama`) VALUES
(1, 'Private Pilot License (PPL)'),
(2, 'Commercial Pilot License (CPL)'),
(3, 'Airline Transport Pilot License (ATPL)');

-- --------------------------------------------------------

--
-- Table structure for table `maskapai`
--

CREATE TABLE `maskapai` (
  `maskapai_id` int(11) NOT NULL,
  `maskapai_nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maskapai`
--

INSERT INTO `maskapai` (`maskapai_id`, `maskapai_nama`) VALUES
(1, 'Air Busan'),
(2, 'Asiana Airlines'),
(3, 'Eastar Jet'),
(4, 'Jeju Air'),
(5, 'Jin Air'),
(6, 'Korean Air'),
(7, 'T\'way Airlines');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roles_id` int(11) NOT NULL,
  `roles_nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roles_id`, `roles_nama`) VALUES
(1, 'Pilot'),
(2, 'Co-Pilot');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crew`
--
ALTER TABLE `crew`
  ADD PRIMARY KEY (`crew_id`),
  ADD KEY `roles_id` (`roles_id`,`lisensi_id`) USING BTREE,
  ADD KEY `maskapai_id` (`maskapai_id`) USING BTREE;

--
-- Indexes for table `lisensi`
--
ALTER TABLE `lisensi`
  ADD PRIMARY KEY (`lisensi_id`);

--
-- Indexes for table `maskapai`
--
ALTER TABLE `maskapai`
  ADD PRIMARY KEY (`maskapai_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roles_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crew`
--
ALTER TABLE `crew`
  MODIFY `crew_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `lisensi`
--
ALTER TABLE `lisensi`
  MODIFY `lisensi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `maskapai`
--
ALTER TABLE `maskapai`
  MODIFY `maskapai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

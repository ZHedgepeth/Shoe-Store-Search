-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 02, 2017 at 05:37 AM
-- Server version: 5.6.33
-- PHP Version: 7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoes_test`
--
CREATE DATABASE IF NOT EXISTS `shoes_test` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `shoes_test`;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE `brands` (
  `name` varchar(255) DEFAULT NULL,
  `B_Id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `brands_stores`
--

DROP TABLE IF EXISTS `brands_stores`;
CREATE TABLE `brands_stores` (
  `J_Id` bigint(20) UNSIGNED NOT NULL,
  `B_Id` int(11) DEFAULT NULL,
  `S_Id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brands_stores`
--

INSERT INTO `brands_stores` (`J_Id`, `B_Id`, `S_Id`) VALUES
(1, 1, 19),
(2, 2, 19),
(3, 3, 23),
(4, 4, 23),
(5, 8, 27),
(6, 9, 27),
(7, 13, 31),
(8, 14, 31),
(9, 18, 35),
(10, 19, 35),
(11, 20, 36),
(12, 24, 40),
(13, 25, 40),
(14, 26, 41),
(15, 30, 46),
(16, 31, 46),
(17, 32, 47),
(18, 36, 54),
(19, 37, 54),
(20, 38, 55),
(21, 44, 61),
(22, 45, 61),
(23, 46, 62),
(24, 47, 69),
(25, 48, 69),
(26, 49, 70),
(27, 56, 56),
(28, 62, 76),
(29, 62, 77),
(30, 63, 78),
(31, 69, 79),
(32, 69, 80),
(33, 70, 81),
(34, 77, 82),
(35, 77, 83),
(36, 78, 84),
(37, 81, 88),
(38, 82, 88),
(39, 83, 89),
(40, 89, 95),
(41, 89, 96),
(42, 90, 97),
(43, 93, 101),
(44, 94, 101),
(45, 95, 102);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
CREATE TABLE `stores` (
  `name` varchar(255) DEFAULT NULL,
  `S_Id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`B_Id`),
  ADD UNIQUE KEY `B_Id` (`B_Id`);

--
-- Indexes for table `brands_stores`
--
ALTER TABLE `brands_stores`
  ADD PRIMARY KEY (`J_Id`),
  ADD UNIQUE KEY `J_Id` (`J_Id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`S_Id`),
  ADD UNIQUE KEY `S_Id` (`S_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `B_Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT for table `brands_stores`
--
ALTER TABLE `brands_stores`
  MODIFY `J_Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `S_Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

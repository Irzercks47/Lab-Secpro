-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2021 at 09:28 AM
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
-- Database: `literalgaragesale_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblgarages`
--

CREATE TABLE `tblgarages` (
  `id` int(11) NOT NULL,
  `garage_name` varchar(255) NOT NULL,
  `garage_price` int(11) NOT NULL,
  `garage_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblgarages`
--

INSERT INTO `tblgarages` (`id`, `garage_name`, `garage_price`, `garage_image`) VALUES
(1, 'Garaga Moderne Fancy Garage', 2300, 'garagamoderne.jpg'),
(2, 'Gold Coast Simplistic Garage', 2000, 'goldcoast.jpg'),
(3, 'Remote Controlled Garage', 2500, 'rcgarage.jpeg'),
(4, 'Classic Spruce Color Garage', 1300, 'spruce.jpg'),
(5, 'Texas-Style Steel Garage', 1500, 'texas.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `user_fullname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `user_fullname`, `user_email`, `user_password`) VALUES
(1, 'Brandon', 'coolbrandon89@gmail.com', '$2y$10$kYk448p6I5i8YhUQPXvp0u6RQQe.4Fookuv3GrdGHPQiAM8UNJ436'),
(2, 'Jenny', 'jennywashere@gmail.com', '$2y$10$pLKRF.xAKKoSGM.RjJwSSeLHT7sXrcSrasuaxsVm.9cV1.gBNBM76');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblgarages`
--
ALTER TABLE `tblgarages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblgarages`
--
ALTER TABLE `tblgarages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

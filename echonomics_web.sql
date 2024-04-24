-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2024 at 09:47 AM
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
-- Database: `echonomics_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `website_economics`
--

CREATE TABLE `website_economics` (
  `id` int(30) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user',
  `service` enum('consultation','repair') DEFAULT NULL,
  `status` enum('done','completed','pairing') DEFAULT 'pairing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `website_economics`
--

INSERT INTO `website_economics` (`id`, `title`, `description`, `start_datetime`, `end_datetime`, `name`, `email`, `password`, `user_type`, `service`, `status`) VALUES
(24, '', '', '0000-00-00 00:00:00', '2024-03-26 15:46:01', 'test', 'test@gmail.com', '098f6bcd4621d373cade4e832627b4f6', 'user', NULL, 'completed'),
(40, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'admin', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 'admin', NULL, 'pairing'),
(57, '', '', '0000-00-00 00:00:00', '2024-03-26 15:46:01', 'test', '', '', '', 'repair', 'completed'),
(58, 'test', 'test', '2024-03-25 15:45:00', '2024-03-26 15:46:01', 'test', '', '', '', 'repair', 'done');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `website_economics`
--
ALTER TABLE `website_economics`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `website_economics`
--
ALTER TABLE `website_economics`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

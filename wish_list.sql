-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2024 at 07:39 PM
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
-- Database: `wish_list`
--

-- --------------------------------------------------------

--
-- Table structure for table `wisher`
--

CREATE TABLE `wisher` (
  `Name` varchar(15) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wisher`
--

INSERT INTO `wisher` (`Name`, `Email`, `Password`) VALUES
('sujan', 'sujanthapamagar960@gmail.com', '$2y$10$ECF');

-- --------------------------------------------------------

--
-- Table structure for table `wishers`
--

CREATE TABLE `wishers` (
  `ID` int(15) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishers`
--

INSERT INTO `wishers` (`ID`, `Name`, `Email`, `Password`) VALUES
(2, 'vg', 'sujan.thapa@loyalist.com', '$2y$10$Nnz'),
(3, 'vg', 'vg@loyalist.com', '$2y$10$9A6'),
(4, 'wish', 'wish@loya.com', '$2y$10$DlU'),
(5, 'swastika', 'swastika@swastika.com', '$2y$10$f/C'),
(6, 'swostika', 'swostika@swostika.com', 'swostika'),
(7, 'a', 'a@a.com', 'a'),
(8, 'sujan', 'ss@ss.com', '$2y$10$3Bj'),
(9, 'php', 'php@php.com', '$2y$10$LpK'),
(10, 'login', 'login@login.com', '$2y$10$Nfx'),
(11, 'welcome', 'welcome@welcome.com', 'welcome'),
(12, 'to', 'to@to.com', '$2y$10$cwy');

-- --------------------------------------------------------

--
-- Table structure for table `wish_list`
--

CREATE TABLE `wish_list` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wish_list`
--

INSERT INTO `wish_list` (`id`, `user_id`, `item`, `created_at`) VALUES
(1, 7, 'ss', '2024-07-28 17:34:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wishers`
--
ALTER TABLE `wishers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `wish_list`
--
ALTER TABLE `wish_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wishers`
--
ALTER TABLE `wishers`
  MODIFY `ID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `wish_list`
--
ALTER TABLE `wish_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wish_list`
--
ALTER TABLE `wish_list`
  ADD CONSTRAINT `wish_list_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `wishers` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

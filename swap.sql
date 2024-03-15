-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2024 at 06:00 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swap`
--

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `idFrom` int(11) NOT NULL,
  `idTo` int(11) NOT NULL,
  `date_accepted` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`idFrom`, `idTo`, `date_accepted`) VALUES
(4, 1, '2024-01-30'),
(4, 6, '2024-01-30'),
(4, 7, '2024-01-30'),
(5, 3, '2024-01-30'),
(5, 7, '2024-01-30');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `idFrom` int(11) NOT NULL,
  `idTo` int(11) NOT NULL,
  `friend_status` tinyint(1) DEFAULT 0,
  `date_request_sent` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`idFrom`, `idTo`, `friend_status`, `date_request_sent`) VALUES
(1, 7, 0, '2024-01-30'),
(2, 7, 0, '2024-01-30'),
(4, 1, 0, '2024-01-30'),
(4, 3, 0, '2024-01-30'),
(5, 1, 0, '2024-01-21'),
(5, 4, 0, '2024-01-21'),
(5, 6, 0, '2024-01-21'),
(7, 2, 0, '2024-01-30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `main_subject` varchar(100) DEFAULT NULL,
  `second_subject` varchar(100) DEFAULT NULL,
  `tsc` int(11) NOT NULL,
  `work_place` varchar(100) DEFAULT NULL,
  `dod` date DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `create_at` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `phone`, `image`, `main_subject`, `second_subject`, `tsc`, `work_place`, `dod`, `bio`, `pwd`, `status`, `create_at`) VALUES
(1, 'John', 'John maina', 'j@gmail.com', '0711676434', '1705846208.1696675122.jpeg', 'Science', '', 123, 'M', NULL, 'I\'m', '$2y$10$dnUOvGaJI0tIToQcczl04ud2ECCBCu7DtA2PVHPT1ovWOe3ONwiFq', 0, '2024-01-21'),
(2, 'm', 'm', 'mk@gmail.com', '0711676434', '1705846396.1844515939.jpeg', 'Math', '', 123, 'M', NULL, 'im', '$2y$10$X3I49YvmP2qxD9KRIc342OM6.Yow4AUfGqedR.vBFucbonMvf8c9u', 0, '2024-01-21'),
(3, 'd', 'd', 'd@gmail.com', '0711676434', '1705846477.423394318.jpeg', 'Math', '', 123, 'Nairobi', NULL, '34', '$2y$10$1yx4PvxFVffZpzBGnL1AoecT8HTKzToCwCRLi7oxjtXX1po2990l.', 0, '2024-01-21'),
(4, 'Car', 'm', 'hh@gmail.com', '0711676434', '1705846817.840486535.jpeg', 'Science', 'History', 123, 'Nairobi', NULL, 'Im', '$2y$10$R1p8kE.sdemWeAVJmn7HiuVOn9dou4slo5/LCgqMsZzIR4docXOkW', 0, '2024-01-21'),
(5, 'm', 'm', 'mose@gmail.com', '0711676434', '1705846966.1045872398.jpeg', 'Math', 'Math', 12, 'Nairobi', NULL, 'im', '$2y$10$qGarAdzGy92asjiTCnQtjewb0z3GC8Ngu0603.iKI7rg2hFtOctc2', 0, '2024-01-21'),
(6, 'Toyota Update', 'm', 'mmk@gmail.com', '0711676434', '1705847358.1002150500.jpeg', 'Science', 'Math', 1, 'Nairobi', '2024-01-22', 'im', '$2y$10$FsJQdQcEQSWIe2zY92cC6.R5IDlmw164Q0PJyageP1D7KAziGA4FC', 0, '2024-01-21'),
(7, 'Boy Juma Boy', 'boy juma boy', 'boyjumaboy@gmail.com', '0110722126', '1705857488.1471780020.jpeg', 'History', 'CRE', 567, 'Makueni', '2021-05-21', 'I\'m', '$2y$10$wct1v7Qo.V0qNnEEaV0SXesJ2x3M895fs4CiSfaW5AR7M/KYY8MYC', 0, '2024-01-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`idFrom`,`idTo`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`idFrom`,`idTo`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

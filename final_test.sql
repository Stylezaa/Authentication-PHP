-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2022 at 06:06 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_date` datetime DEFAULT current_timestamp(),
  `role` varchar(255) DEFAULT 'member',
  `photo` varchar(255) DEFAULT 'profile_default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `create_date`, `role`, `photo`) VALUES
(10, 'Admin', '$2y$10$ZVNfX4YN7v0on/dgLLPDyuRRqPUSIcO5y0FYNw9Be4ZZiiJ3CQQTu', '2022-02-17 21:09:16', 'admin', 'uploads/profile_default.png'),
(11, 'Sin', '$2y$10$VlbUEelp5vJXbokBOCrkGuRdxmr.5I/MpiVgYYG38/kzhrW0juAg6', '2022-02-17 21:18:11', 'member', 'uploads/profile_default.png'),
(12, 'Ton', '$2y$10$Dh29UeA0kjSk1Mrv20kub.9irxSTduliUuVWkvfDXQUvXEqW3ug5i', '2022-02-17 21:18:26', 'member', 'uploads/profile.jpg'),
(14, 'DevS', '$2y$10$x/zvez9Cbrc/ziI2GtPVXuZWSjEH/NQgsN9EzV32of0BiAbuZKLCC', '2022-02-17 21:59:11', 'admin', 'profile_default.png');

--
-- Indexes for dumped tables
--

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
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

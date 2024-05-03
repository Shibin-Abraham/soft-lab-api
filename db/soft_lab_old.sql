-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2024 at 09:37 AM
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
-- Database: `soft_lab`
--

-- --------------------------------------------------------

--
-- Table structure for table `archive`
--

CREATE TABLE `archive` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `join_date` date NOT NULL,
  `r_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archive`
--

INSERT INTO `archive` (`id`, `name`, `email`, `phone`, `join_date`, `r_name`) VALUES
(1, 'test', 'test@gmail.com', '9700220022', '2022-04-01', 'HOD'),
(2, 'arjun', 'shibin.k10@gmail.com', '6235287817', '2024-03-23', 'Manager'),
(3, 'suraj', 'surajvs331@gmail.com', '6176213322', '2024-04-03', 'Assistant');

-- --------------------------------------------------------

--
-- Table structure for table `borrowers`
--

CREATE TABLE `borrowers` (
  `id` int(11) NOT NULL,
  `b_name` varchar(200) NOT NULL,
  `adm_no` int(11) NOT NULL,
  `branch` varchar(200) NOT NULL,
  `sem` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `phone` varchar(13) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowers`
--

INSERT INTO `borrowers` (`id`, `b_name`, `adm_no`, `branch`, `sem`, `date`, `phone`, `item_id`) VALUES
(4, 'arjun', 789, 'cse', 's1', '2024-04-01', '9700220022', 9);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(3, 'dell');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `model` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `warranty` date NOT NULL,
  `type` varchar(200) NOT NULL,
  `lab_location` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `prize` double NOT NULL,
  `dump` tinyint(1) NOT NULL,
  `s_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `name`, `model`, `description`, `warranty`, `type`, `lab_location`, `status`, `prize`, `dump`, `s_id`, `brand_id`) VALUES
(7, 'lap-03', '2022', 'laptop black', '2026-04-01', 'lap', 'sw-lab02', 'old', 43000, 1, 2, 3),
(8, 'lap-04', '2024', 'laptop black', '2025-04-01', 'lap', 'sw-lab02', 'old', 55000, 0, 2, 3),
(9, 'lap-05', '2021', 'new', '2026-04-01', 'lap', 'sw-lab02', 'old', 43000, 0, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `recent_activities`
--

CREATE TABLE `recent_activities` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(50) NOT NULL,
  `details` varchar(500) NOT NULL,
  `operation` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recent_activities`
--

INSERT INTO `recent_activities` (`id`, `name`, `email`, `date`, `time`, `details`, `operation`) VALUES
(1, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-01', '09:30', 'stock-BAT01', 'added'),
(2, 'shibin', 'shibin.k190@gmail.com', '2024-04-01', '09:30', 'laptop-01', 'updated'),
(3, 'arjun', 'shibin.k10@gmail.com', '2024-04-01', '11:00', 'Laptop-21', 'deleted'),
(4, 'arjun', 'shibin.k12@gmail.com', '2024-04-01', '11:00', 'Stock-01', 'deleted'),
(5, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-11', '13:36', 'stock-4', 'added'),
(6, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-11', '13:40', 'stock-5', 'added'),
(7, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-11', '13:42', 'stock-6', 'added'),
(8, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-11', '13:45', 'stock-7', 'added'),
(9, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-12', '14:59', 'stock-8', 'updated');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'HOD'),
(2, 'Manager'),
(3, 'Assistent');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `invoice_id` varchar(200) NOT NULL,
  `invoice_date` date NOT NULL,
  `supplier_name` varchar(200) NOT NULL,
  `dump` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `name`, `type`, `category`, `invoice_id`, `invoice_date`, `supplier_name`, `dump`) VALUES
(1, 'STOCK-1', 'Electronics', 'TEQIP', 'INV-12CHO', '2024-04-01', 'John', 0),
(2, 'STOCK-2', 'Battery', 'TEQIP', 'INV-91ORT', '2024-04-01', 'Thomas', 0),
(4, 'stock-3', '', '', '', '0000-00-00', '', 1),
(5, 'stock-4', '', '', '', '0000-00-00', '', 1),
(6, 'stock-5', '', '', '', '0000-00-00', '', 1),
(7, 'stock-6', '', '', '', '0000-00-00', '', 1),
(8, 'stock-7', '', '', '', '0000-00-00', '', 0),
(9, 'stock-8', '', '', '', '0000-00-00', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock_handling_users`
--

CREATE TABLE `stock_handling_users` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `role_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_handling_users`
--

INSERT INTO `stock_handling_users` (`id`, `u_id`, `s_id`, `role_name`) VALUES
(6, 7, 1, 'manager'),
(7, 9, 8, 'assistant'),
(8, 7, 2, 'assistant'),
(9, 9, 2, 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(10000) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `join_date` date NOT NULL,
  `status` varchar(5) NOT NULL,
  `r_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `phone`, `join_date`, `status`, `r_id`) VALUES
(5, 'shuhaib', 'shibin.k19@gmail.com', '$2y$10$dONk/iax85UWtjomifuDwOJJ/Y6TrcPn2WMjDS725m4hBEWlrRvua', '9747970988', '2024-03-22', '1', 1),
(7, 'shibin', 'shibin.k190@gmail.com', '$2y$10$uNLN36M4B0ISLcdwkz/xKusD83GpbUtD3kkuCfqThg9FgqBm1./QK', '9747970921', '2024-03-29', '1', 2),
(9, 'suraj', 'surajvs331@gmail.com', '$2y$10$YERTxqUWcUziY2Tb4l2DIubyCHT7E89cQpMhbh3Do7I8jGFD3cOcq', '6176213322', '2024-04-10', '1', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archive`
--
ALTER TABLE `archive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrowers`
--
ALTER TABLE `borrowers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrowers_ibfk_1` (`item_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `s_id` (`s_id`),
  ADD KEY `item_ibfk_2` (`brand_id`);

--
-- Indexes for table `recent_activities`
--
ALTER TABLE `recent_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_handling_users`
--
ALTER TABLE `stock_handling_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `s_id` (`s_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `r_id` (`r_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archive`
--
ALTER TABLE `archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `borrowers`
--
ALTER TABLE `borrowers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `recent_activities`
--
ALTER TABLE `recent_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `stock_handling_users`
--
ALTER TABLE `stock_handling_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowers`
--
ALTER TABLE `borrowers`
  ADD CONSTRAINT `borrowers_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `stock` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock_handling_users`
--
ALTER TABLE `stock_handling_users`
  ADD CONSTRAINT `stock_handling_users_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `stock` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_handling_users_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`r_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

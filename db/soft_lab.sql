-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2024 at 10:25 AM
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
(3, 'suraj', 'surajvs331@gmail.com', '6176213322', '2024-04-03', 'Assistant'),
(4, 'suraj', 'surajvs331@gmail.com', '6176213322', '2024-04-10', 'Assistant'),
(5, 'suraj', 'surajvs331@gmail.com', '6176213322', '2024-04-10', 'Assistant'),
(6, 'suraj', 'surajvs331@gmail.com', '6176213322', '2024-04-10', 'Assistant'),
(7, 'suraj', 'surajvs331@gmail.com', '6176213322', '2024-04-10', 'Assistant'),
(8, 'Amalhanna', 'amalhanna2715@gmail.com', '7025136387', '2024-04-15', 'Assistant'),
(9, 'Amalhanna', 'amalhanna2715@gmail.com', '7025136387', '2024-04-15', 'Assistant'),
(10, 'Amalhanna', 'amalhanna2715@gmail.com', '7025136387', '2024-04-15', 'Assistant'),
(11, 'Amalhanna', 'amalhanna2715@gmail.com', '7025136387', '2024-04-15', 'Assistant'),
(12, 'Amalhanna', 'amalhanna2715@gmail.com', '7025136387', '2024-04-15', 'Assistant'),
(13, 'Amalhanna', 'amalhanna2715@gmail.com', '7025136387', '2024-04-15', 'Assistant'),
(14, 'Amalhanna', 'amalhanna2715@gmail.com', '7025136387', '2024-04-15', 'Assistant'),
(15, 'shibin', 'shibin.k190@gmail.com', '9747970921', '2024-03-29', 'Manager'),
(16, 'Amalhanna', 'amalhanna2715@gmail.com', '7025136387', '2024-04-15', 'Assistant'),
(17, 'sooraj', 'surajvs331@gmail.com', '9012909090', '2024-04-15', 'Manager'),
(18, 'suraj', 'surajvs@gmail.com', '6176213322', '2024-04-10', 'Assistant');

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
  `item_id` int(11) NOT NULL,
  `return_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowers`
--

INSERT INTO `borrowers` (`id`, `b_name`, `adm_no`, `branch`, `sem`, `date`, `phone`, `item_id`, `return_status`) VALUES
(7, 'shuhaib', 1234, 'CSE', '6', '2024-04-02', '1234567890', 29, 1),
(8, 'test', 1234, 'CSE', '2', '2024-04-01', '1234567890', 25, 0),
(13, 'test', 9835, 'CSE', '1', '2022-01-02', '9747970988', 30, 1);

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
(18, 'acer'),
(19, 'dell');

-- --------------------------------------------------------

--
-- Table structure for table `indent`
--

CREATE TABLE `indent` (
  `id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `img_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `indent`
--

INSERT INTO `indent` (`id`, `s_id`, `img_name`) VALUES
(4, 18, 'soft-lab-indent-18.png'),
(5, 15, 'soft-lab-indent-15.png'),
(6, 14, 'soft-lab-indent-14.png');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `model` varchar(200) NOT NULL,
  `description` varchar(800) NOT NULL,
  `warranty` date NOT NULL,
  `type` varchar(200) NOT NULL,
  `lab_location` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `amount` double NOT NULL,
  `dump` tinyint(1) NOT NULL,
  `s_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `name`, `model`, `description`, `warranty`, `type`, `lab_location`, `status`, `amount`, `dump`, `s_id`, `brand_id`) VALUES
(22, 'lap-01', '2020', 'black laptop', '2024-04-01', 'laptop', 'sw-lab01', 'old', 45555, 1, 14, 19),
(23, 'lap-02', '2024', 'black laptop', '2025-04-22', 'laptop', 'sw-lab02', 'old', 42000, 1, 14, 18),
(24, 'lap-03', '2024', 'black laptop', '2026-04-02', 'laptop', 'sw-lab01', 'new', 55000, 1, 15, 19),
(25, 'lap-04', '2024', 'balck laptop', '2026-04-02', 'laptop', 'sw-lab01', 'new', 55000, 0, 14, 18),
(26, 'lap', '2202', 'sh', '2024-04-01', 'ss', 'sw-lab03', 'old', 22000, 1, 16, 18),
(27, 'lap-05', 'aspire 7', 'black', '2025-01-01', 'laptop', 'sw-lab02', 'new', 22000, 1, 15, 18),
(28, 'lap-06', 'aspire 7', 'black', '2024-01-01', 'laptop', 'sw-lab02', 'old', 30000, 1, 18, 19),
(29, 'lap-07', 'aspire 7', 'black laptop', '2022-01-02', 'laptop', 'sw-lab01', 'old', 20200, 0, 18, 19),
(30, 'lap-08', '2022', 'aspire 7, black', '2027-02-02', 'laptop', 'sw-lab01', 'new', 65000, 0, 17, 18),
(35, 'lap-09', 'aspire 7', 'black', '2024-01-01', 'laptop', 'sw-lab03', 'old', 22000, 1, 16, 19),
(36, 'lap-10', 'aspire 7', 'black', '2024-01-01', 'laptop', 'sw-lab03', 'old', 30000, 1, 18, 18),
(51, 'lap-12', 'aspire 7', 'black ', '2024-01-01', 'laptop ', 'sw-lab03', 'old', 4500, 0, 17, 18),
(57, 'lap-13', 'aspire 5', 'back', '2024-02-01', 'laptop', 'sw-lab02', 'old', 25000, 0, 17, 19),
(58, 'lap-14', 'aspire 5', 'black', '2024-03-04', 'laptop', 'sw-lab03', 'old', 35000, 0, 17, 18);

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
(4, 'arjun', 'shibin.k12@gmail.com', '2024-04-01', '11:00', 'Stock-01', 'dumped'),
(5, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-11', '13:36', 'stock-4', 'added'),
(6, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-11', '13:40', 'stock-5', 'added'),
(7, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-11', '13:42', 'stock-6', 'added'),
(8, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-11', '13:45', 'stock-7', 'added'),
(9, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-12', '14:59', 'stock-8', 'updated'),
(10, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-13', '14:42', 'stock-9', 'added'),
(11, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-13', '19:11', 'stock-9', 'updated'),
(12, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-13', '19:15', 'stock-7', 'updated'),
(13, 'suraj', 'surajvs331@gmail.com', '2024-04-14', '17:53', 'STOCK-2', 'updated'),
(14, 'suraj', 'surajvs331@gmail.com', '2024-04-14', '17:55', 'STOCK-2', 'updated'),
(15, 'suraj', 'surajvs331@gmail.com', '2024-04-14', '17:56', 'stock-7', 'updated'),
(16, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-14', '18:44', 'stock-3', 'dumped'),
(17, 'shibin', 'shibin.k190@gmail.com', '2024-04-14', '18:51', 'STOCK-2', 'dumped'),
(18, 'shibin', 'shibin.k190@gmail.com', '2024-04-14', '19:10', 'stock-8', 'updated'),
(19, 'shibin', 'shibin.k190@gmail.com', '2024-04-14', '19:10', 'stock-8', 'dumped'),
(20, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-14', '19:34', 'stock-10', 'added'),
(21, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-15', '17:6', 'stock-11', 'added'),
(22, 'Amalhanna', 'amalhanna2715@gmail.com', '2024-04-15', '17:10', 'stock-11', 'updated'),
(23, 'Amalhanna', 'amalhanna2715@gmail.com', '2024-04-15', '17:11', 'stock-11', 'updated'),
(24, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-15', '17:13', 'stock-11', 'dumped'),
(25, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-15', '23:21', 'stock-11', 'added'),
(26, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-16', '17:1', 'stock-9', 'updated'),
(27, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-16', '17:1', 'stock-7', 'updated'),
(28, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-16', '17:2', 'STOCK-1', 'updated'),
(29, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-16', '17:39', 'stock-9', 'updated'),
(30, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-16', '17:55', 'stock-9', 'updated'),
(31, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-16', '19:59', 'STOCK-1', 'updated'),
(32, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-16', '19:59', 'STOCK-1', 'updated'),
(33, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-16', '20:0', 'STOCK-1', 'updated'),
(34, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-16', '20:0', 'STOCK-1', 'updated'),
(35, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-16', '20:4', 'stock-7', 'updated'),
(36, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-16', '20:5', 'stock-7', 'updated'),
(37, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-17', '0:15', 'lenovo', 'added'),
(38, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-17', '0:19', 'acer', 'added'),
(39, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-17', '0:21', 'hp', 'added'),
(40, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-17', '0:24', 'hp', 'added'),
(41, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-17', '0:31', 'lenovo', 'added'),
(42, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-17', '0:32', 'hp', 'added'),
(43, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-17', '0:35', 'hp', 'added'),
(44, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-17', '0:43', 'acer', 'added'),
(45, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-17', '0:44', 'acer-1', 'added'),
(46, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-17', '0:46', 'acer-2', 'added'),
(47, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-17', '0:48', 'asus', 'added'),
(48, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-19', '20:25', 'dell', 'added'),
(49, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-20', '13:19', 'stock-01', 'added'),
(50, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-20', '13:19', 'stock-02', 'added'),
(51, 'shibin', 'shibin.k190@gmail.com', '2024-04-20', '13:26', 'stock-01', 'updated'),
(52, 'shibin', 'shibin.k190@gmail.com', '2024-04-20', '13:56', 'stock-02', 'updated'),
(53, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-22', '12:52', 'stock-03', 'added'),
(54, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-22', '12:52', 'stock-04', 'added'),
(55, 'shibin', 'shibin.k190@gmail.com', '2024-04-22', '12:54', 'stock-04', 'updated'),
(56, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-22', '23:10', 'stock-01', 'updated'),
(57, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-22', '23:10', 'stock-02', 'updated'),
(58, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-22', '23:10', 'stock-01', 'updated'),
(59, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-22', '23:10', 'stock-02', 'updated'),
(60, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-22', '23:11', 'stock-05', 'updated'),
(61, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-22', '23:11', 'stock-02', 'updated'),
(62, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-22', '23:17', 'stock-05', 'added'),
(63, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-22', '23:32', 'stock-04', 'updated'),
(64, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-23', '0:35', 'lap-05', 'added'),
(65, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-23', '0:41', 'lap-06', 'added'),
(66, 'shibin', 'shibin.k190@gmail.com', '2024-04-23', '0:46', 'lap-07', 'added'),
(67, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-23', '17:55', 'stock-05', 'updated'),
(68, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-23', '18:35', 'stock-03', 'updated'),
(69, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-23', '18:36', 'stock-06', 'added'),
(70, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-23', '18:36', 'stock-06', 'updated'),
(71, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-24', '0:33', 'stock-07', 'added'),
(72, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-24', '1:10', 'lap', 'updated'),
(73, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-24', '1:13', 'lap-07', 'updated'),
(74, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-24', '1:13', 'lap-07', 'updated'),
(75, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-24', '1:13', 'lap-03', 'updated'),
(76, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-24', '1:14', 'lap-07', 'updated'),
(77, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-24', '1:15', 'lap-04', 'updated'),
(78, 'shibin', 'shibin.k190@gmail.com', '2024-04-24', '1:22', 'lap-08', 'added'),
(79, 'shibin', 'shibin.k190@gmail.com', '2024-04-24', '1:24', 'lap-02', 'updated'),
(80, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-24', '1:47', 'lap', 'dumped'),
(81, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-24', '1:52', 'lap-09', 'added'),
(82, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-24', '1:53', 'lap-09', 'dumped'),
(83, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-24', '14:45', 'lap-04', 'dumped'),
(84, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-24', '15:9', 'lap-02', 'dumped'),
(85, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-24', '15:13', 'lap-03', 'dumped'),
(86, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-24', '15:14', 'lap-10', 'added'),
(87, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-24', '15:14', 'lap-10', 'dumped'),
(88, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-24', '21:23', 'lap-01', 'updated'),
(89, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-24', '21:23', 'lap-01', 'dumped'),
(93, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-26', '23:56', 'item', 'borrowed'),
(98, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-27', '11:53', 'lap-07', 'returned'),
(99, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-30', '12:22', 'lap-12', 'added'),
(100, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-30', '12:24', 'lap-13', 'added'),
(101, 'shuhaib', 'shibin.k19@gmail.com', '2024-04-30', '12:25', 'lap-14', 'added');

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
(3, 'Assistant');

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
  `invoice_date` varchar(20) NOT NULL,
  `supplier_name` varchar(200) NOT NULL,
  `dump` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `name`, `type`, `category`, `invoice_id`, `invoice_date`, `supplier_name`, `dump`) VALUES
(14, 'stock-01', 'Consumables', 'teqip', 'inv-01', '12-03-2002', 'shibin', 0),
(15, 'stock-02', 'Consumables', 'teqip', 'inv-034', '12-03-2002', 'shibin', 0),
(16, 'stock-03', 'Consumables', 'teqip', 'inv-01', '11-20-2002', 'test', 0),
(17, 'stock-04', 'Consumables', 'teqip', 'inv-034', '12-03-2002', 'shibin', 0),
(18, 'stock-05', 'Consumables', 'teqip', 'inv-034', '04-02-2023', 'test', 0),
(19, 'stock-06', 'Consumables', 'teqip', 'mx-22', '04-02-2023', 'shibin', 0),
(20, 'stock-07', '', '', '', '', '', 0);

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
(17, 7, 14, 'manager'),
(18, 12, 14, 'assistant'),
(19, 7, 15, 'manager'),
(20, 7, 17, 'manager');

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
(12, 'suraj', 'surajvs331@gmail.com', '$2y$10$cuzRBuGeNVqtPL9GqUi1f.yK/AX5yy4fUSg55CjZv74cs1r3V/aWq', '6176213300', '2024-04-19', '1', 3),
(13, 'Geethu', 'geethugopi134@gmail.com', '$2y$10$gpXlPqMpd64Lw3hhIf0QoO7DZvf5io3JW7bCm.52U.xs8OsAUFkb.', '7736541819', '2024-04-24', '1', 2);

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
-- Indexes for table `indent`
--
ALTER TABLE `indent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `s_id` (`s_id`);

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
  ADD KEY `stock_handling_users_ibfk_2` (`u_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `borrowers`
--
ALTER TABLE `borrowers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `indent`
--
ALTER TABLE `indent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `recent_activities`
--
ALTER TABLE `recent_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `stock_handling_users`
--
ALTER TABLE `stock_handling_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowers`
--
ALTER TABLE `borrowers`
  ADD CONSTRAINT `borrowers_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `indent`
--
ALTER TABLE `indent`
  ADD CONSTRAINT `indent_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `stock` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `stock_handling_users_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`r_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

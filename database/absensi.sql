-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2024 at 09:07 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_absen`
--

CREATE TABLE `data_absen` (
  `id` int(100) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `waktu` time NOT NULL DEFAULT current_timestamp(),
  `uid` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_absen`
--

INSERT INTO `data_absen` (`id`, `tanggal`, `waktu`, `uid`, `status`) VALUES
(1, '2023-03-10', '09:46:38', 'EABF484', 'IN'),
(2, '2023-03-10', '09:47:10', 'EABF484', 'OUT'),
(3, '2023-03-10', '09:47:32', 'EABF484', 'IN'),
(4, '2023-03-10', '09:47:50', 'EABF484', 'OUT'),
(5, '2023-03-10', '09:47:59', 'EABF484', 'IN'),
(6, '2023-03-10', '11:12:02', 'EABF484', 'OUT'),
(7, '2023-03-10', '11:12:13', '792B27E5', 'IN'),
(8, '2023-03-10', '11:12:23', '792B27E5', 'OUT'),
(9, '2023-03-10', '13:12:27', '792B27E5', 'IN'),
(10, '2023-03-10', '13:14:20', '792B27E5', 'OUT'),
(11, '2024-05-16', '15:21:10', '33B3D30', 'IN'),
(12, '2024-05-16', '15:21:17', '33B3D30', 'OUT'),
(13, '2024-05-16', '15:21:24', '33B3D30', 'IN'),
(14, '2024-05-16', '15:21:31', '33B3D30', 'OUT'),
(15, '2024-05-16', '15:22:22', '33B3D30', 'IN'),
(16, '2024-05-16', '17:07:28', '33B3D30', 'OUT'),
(17, '2024-05-16', '17:07:41', '33B3D30', 'IN'),
(18, '2024-05-16', '17:07:51', '33B3D30', 'OUT'),
(19, '2024-05-16', '17:07:57', '33B3D30', 'IN'),
(20, '2024-05-16', '17:09:05', '33B3D30', 'OUT'),
(21, '2024-05-16', '17:09:11', '33B3D30', 'IN'),
(22, '2024-05-16', '17:10:07', '33B3D30', 'OUT'),
(23, '2024-05-16', '17:11:19', '33B3D30', 'IN'),
(24, '2024-05-16', '17:11:25', '33B3D30', 'OUT'),
(25, '2024-05-16', '17:13:18', '33B3D30', 'IN'),
(26, '2024-05-16', '17:13:25', '33B3D30', 'OUT'),
(27, '2024-05-16', '17:14:26', '33B3D30', 'IN'),
(28, '2024-05-16', '17:15:12', '33B3D30', 'OUT'),
(29, '2024-05-17', '14:40:30', '33B3D30', 'IN'),
(30, '2024-05-17', '14:40:36', '33B3D30', 'OUT'),
(31, '2024-05-17', '14:40:59', '33B3D30', 'IN'),
(32, '2024-05-17', '14:41:44', '33B3D30', 'OUT'),
(33, '2024-05-17', '14:41:53', '33B3D30', 'IN'),
(34, '2024-05-17', '15:46:05', '33B3D30', 'OUT'),
(35, '2024-05-17', '15:55:44', '535380F6', 'IN'),
(36, '2024-05-17', '15:56:08', '33B3D30', 'IN'),
(37, '2024-05-17', '15:56:18', '33B3D30', 'OUT'),
(38, '2024-05-17', '15:56:25', '33B3D30', 'IN'),
(39, '2024-05-17', '15:57:44', '535380F6', 'OUT'),
(40, '2024-05-17', '15:57:51', '535380F6', 'IN'),
(41, '2024-05-17', '15:58:02', '535380F6', 'OUT'),
(42, '2024-05-20', '13:28:01', 'C3579FE', 'IN'),
(43, '2024-05-20', '13:29:23', 'C3579FE', 'OUT'),
(44, '2024-05-20', '13:29:42', 'C3579FE', 'IN'),
(45, '2024-05-20', '13:33:03', 'C3579FE', 'OUT'),
(46, '2024-05-20', '13:34:10', 'C3579FE', 'IN'),
(47, '2024-05-20', '13:34:39', 'C3579FE', 'OUT'),
(48, '2024-05-20', '13:34:45', 'C3579FE', 'IN'),
(49, '2024-05-20', '13:50:34', 'C3579FE', 'OUT'),
(50, '2024-05-20', '13:50:39', 'C3579FE', 'IN'),
(51, '2024-05-20', '13:50:45', 'C3579FE', 'OUT'),
(52, '2024-05-20', '13:51:07', 'C3579FE', 'IN'),
(53, '2024-05-21', '13:08:19', 'C3579FE', 'OUT'),
(54, '2024-05-21', '13:41:59', '535380F6', 'IN'),
(55, '2024-05-21', '13:53:43', '535380F6', 'OUT'),
(56, '2024-05-21', '14:08:45', '535380F6', 'IN'),
(57, '2024-05-21', '14:15:23', '535380F6', 'OUT'),
(58, '2024-05-21', '14:35:56', '535380F6', 'IN'),
(59, '2024-05-21', '14:36:07', '535380F6', 'OUT'),
(60, '2024-05-21', '14:42:51', '535380F6', 'IN'),
(61, '2024-05-21', '14:43:02', '535380F6', 'OUT'),
(62, '2024-05-21', '14:44:50', '535380F6', 'IN'),
(63, '2024-05-21', '14:45:02', '535380F6', 'OUT'),
(64, '2024-05-21', '15:18:08', '535380F6', 'IN'),
(65, '2024-05-21', '15:18:20', '535380F6', 'OUT'),
(66, '2024-05-21', '15:31:00', '535380F6', 'IN'),
(67, '2024-05-21', '15:31:12', '535380F6', 'OUT'),
(68, '2024-05-21', '15:36:39', '33B3D30', 'OUT'),
(69, '2024-05-21', '15:36:54', '33B3D30', 'IN'),
(70, '2024-05-21', '15:37:05', '33B3D30', 'OUT'),
(71, '2024-05-21', '15:54:13', '535380F6', 'IN'),
(72, '2024-05-21', '15:54:20', '535380F6', 'OUT'),
(73, '2024-05-22', '14:19:35', '535380F6', 'IN'),
(74, '2024-05-22', '15:23:55', '535380F6', 'OUT'),
(75, '2024-05-22', '15:39:44', '535380F6', 'IN'),
(76, '2024-05-22', '16:03:43', '535380F6', 'OUT'),
(77, '2024-05-27', '13:06:57', 'C3579FE', 'IN'),
(78, '2024-05-27', '13:08:33', '535380F6', 'IN'),
(79, '2024-05-27', '13:18:06', 'C3579FE', 'OUT'),
(80, '2024-05-27', '13:28:46', '535380F6', 'OUT'),
(81, '2024-05-27', '13:32:27', 'C3579FE', 'IN'),
(82, '2024-05-27', '13:32:52', '33B3D30', 'IN'),
(83, '2024-05-27', '13:42:33', '33B3D30', 'OUT'),
(84, '2024-05-28', '12:47:10', 'C3579FE', 'OUT'),
(85, '2024-05-28', '12:49:57', 'C3579FE', 'IN'),
(86, '2024-05-28', '13:12:57', '535380F6', 'IN'),
(87, '2024-05-28', '13:17:05', 'C3579FE', 'OUT'),
(88, '2024-05-28', '13:17:32', 'C3579FE', 'IN'),
(89, '2024-05-28', '13:17:43', 'C3579FE', 'OUT'),
(90, '2024-05-28', '13:17:55', 'C3579FE', 'IN'),
(91, '2024-05-28', '13:18:08', 'C3579FE', 'OUT'),
(92, '2024-05-28', '13:18:19', 'C3579FE', 'IN'),
(93, '2024-05-28', '13:20:40', 'C3579FE', 'OUT'),
(94, '2024-05-28', '13:20:51', '535380F6', 'OUT'),
(95, '2024-05-28', '13:21:07', '33B3D30', 'IN'),
(96, '2024-05-28', '13:32:37', '535380F6', 'IN'),
(97, '2024-05-28', '13:35:08', 'C3579FE', 'IN'),
(98, '2024-05-28', '14:00:41', 'C3579FE', 'OUT'),
(99, '2024-05-28', '14:01:19', 'C3579FE', 'IN'),
(100, '2024-05-28', '14:01:58', 'C3579FE', 'OUT'),
(101, '2024-05-28', '14:03:15', '535380F6', 'OUT'),
(102, '2024-05-28', '14:07:27', 'C3579FE', 'IN'),
(103, '2024-05-28', '14:13:47', 'C3579FE', 'OUT'),
(104, '2024-05-28', '14:23:14', 'C3579FE', 'IN'),
(105, '2024-05-28', '14:26:09', 'C3579FE', 'OUT'),
(106, '2024-05-28', '14:30:42', '535380F6', 'IN'),
(107, '2024-05-28', '14:37:06', '535380F6', 'OUT'),
(108, '2024-05-28', '14:38:01', 'C3579FE', 'IN'),
(109, '2024-05-28', '15:01:41', '535380F6', 'IN'),
(110, '2024-05-28', '15:08:30', '535380F6', 'OUT'),
(111, '2024-05-28', '15:12:49', 'C3579FE', 'OUT'),
(112, '2024-05-31', '15:14:24', 'C3579FE', 'IN'),
(113, '2024-05-31', '15:14:49', '535380F6', 'IN'),
(114, '2024-05-31', '15:14:53', '33B3D30', 'OUT'),
(115, '2024-05-31', '15:17:10', '33B3D30', 'IN'),
(116, '2024-05-31', '15:17:14', 'C3579FE', 'OUT'),
(117, '2024-05-31', '15:17:18', '535380F6', 'OUT'),
(118, '2024-05-31', '15:29:08', '33B3D30', 'OUT'),
(119, '2024-05-31', '15:31:30', 'C3579FE', 'IN'),
(120, '2024-05-31', '15:31:38', 'C3579FE', 'OUT'),
(121, '2024-05-31', '15:37:25', 'C3579FE', 'IN'),
(122, '2024-05-31', '15:44:03', '535380F6', 'IN'),
(123, '2024-05-31', '15:44:22', 'C3579FE', 'OUT'),
(124, '2024-05-31', '15:44:42', '33B3D30', 'IN'),
(125, '2024-05-31', '15:45:18', '33B3D30', 'OUT'),
(126, '2024-05-31', '15:46:00', '33B3D30', 'IN'),
(127, '2024-05-31', '15:49:15', 'C3579FE', 'IN'),
(128, '2024-06-03', '11:53:51', 'C3579FE', 'OUT'),
(129, '2024-06-03', '11:59:46', 'C3579FE', 'IN'),
(130, '2024-06-03', '12:03:12', 'C3579FE', 'OUT'),
(131, '2024-06-03', '12:06:22', 'C3579FE', 'IN'),
(132, '2024-06-03', '12:12:14', 'C3579FE', 'OUT'),
(133, '2024-06-03', '12:25:54', 'C3579FE', 'IN'),
(134, '2024-06-03', '12:50:40', 'C3579FE', 'OUT'),
(135, '2024-06-03', '13:13:07', 'C3579FE', 'IN'),
(136, '2024-06-03', '13:19:40', 'C3579FE', 'OUT'),
(137, '2024-06-03', '13:23:43', 'C3579FE', 'IN'),
(138, '2024-06-03', '13:31:17', 'C3579FE', 'OUT'),
(139, '2024-06-03', '13:35:25', 'C3579FE', 'IN'),
(140, '2024-06-03', '13:35:55', 'C3579FE', 'OUT'),
(141, '2024-06-03', '13:36:04', 'C3579FE', 'IN'),
(142, '2024-06-03', '13:36:18', 'C3579FE', 'OUT'),
(143, '2024-06-03', '13:37:15', 'C3579FE', 'IN'),
(144, '2024-06-03', '14:24:51', 'C3579FE', 'OUT'),
(145, '2024-06-03', '14:25:02', 'C3579FE', 'IN'),
(146, '2024-06-03', '14:27:53', 'C3579FE', 'OUT'),
(147, '2024-06-03', '14:32:18', 'C3579FE', 'IN'),
(148, '2024-06-03', '14:32:26', 'C3579FE', 'OUT'),
(149, '2024-06-03', '15:14:22', 'C3579FE', 'IN'),
(150, '2024-06-03', '15:15:10', 'C3579FE', 'OUT'),
(151, '2024-06-03', '15:16:53', 'C3579FE', 'IN'),
(152, '2024-06-03', '15:17:09', 'C3579FE', 'OUT'),
(153, '2024-06-04', '12:44:28', 'C3579FE', 'IN'),
(154, '2024-06-04', '12:48:36', '535380F6', 'OUT'),
(155, '2024-06-04', '12:51:04', '535380F6', 'IN'),
(156, '2024-06-04', '12:56:44', '535380F6', 'OUT'),
(157, '2024-06-04', '12:56:51', '535380F6', 'IN'),
(158, '2024-06-04', '12:57:01', '535380F6', 'OUT'),
(159, '2024-06-04', '14:07:39', '535380F6', 'IN'),
(160, '2024-06-10', '14:59:52', '70772113', 'IN');

-- --------------------------------------------------------

--
-- Table structure for table `data_invalid`
--

CREATE TABLE `data_invalid` (
  `id` int(100) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `waktu` time NOT NULL DEFAULT current_timestamp(),
  `uid` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_invalid`
--

INSERT INTO `data_invalid` (`id`, `tanggal`, `waktu`, `uid`, `status`) VALUES
(14, '2024-05-21', '13:08:13', '831DEA11', 'INVALID'),
(15, '2024-05-21', '13:53:36', '831DEA11', 'INVALID'),
(16, '2024-05-21', '15:53:55', '831DEA11', 'INVALID'),
(17, '2024-05-22', '13:56:01', '831DEA11', 'INVALID'),
(18, '2024-05-22', '15:23:45', '831DEA11', 'INVALID'),
(19, '2024-05-22', '15:24:36', '831DEA11', 'INVALID'),
(20, '2024-05-22', '15:59:31', '831DEA11', 'INVALID'),
(21, '2024-05-27', '13:15:02', '831DEA11', 'INVALID'),
(22, '2024-05-27', '13:21:39', '831DEA11', 'INVALID'),
(23, '2024-05-28', '13:08:16', '831DEA11', 'INVALID'),
(24, '2024-05-28', '13:21:18', '831DEA11', 'INVALID'),
(25, '2024-05-28', '13:21:30', '831DEA11', 'INVALID'),
(26, '2024-05-28', '13:21:38', '831DEA11', 'INVALID'),
(27, '2024-05-28', '13:30:47', '831DEA11', 'INVALID'),
(28, '2024-05-28', '14:32:42', '831DEA11', 'INVALID'),
(29, '2024-05-28', '14:35:57', '831DEA11', 'INVALID'),
(30, '2024-05-28', '15:06:00', '831DEA11', 'INVALID'),
(31, '2024-05-31', '15:10:13', '831DEA11', 'INVALID'),
(32, '2024-05-31', '15:10:17', '831DEA11', 'INVALID'),
(33, '2024-05-31', '15:10:20', '831DEA11', 'INVALID'),
(38, '2024-05-31', '15:14:58', '831DEA11', 'INVALID'),
(39, '2024-05-31', '15:15:20', '831DEA11', 'INVALID'),
(40, '2024-05-31', '15:17:08', '831DEA11', 'INVALID'),
(41, '2024-05-31', '15:44:33', '831DEA11', 'INVALID'),
(42, '2024-05-31', '15:45:12', '831DEA11', 'INVALID'),
(43, '2024-05-31', '15:45:49', '831DEA11', 'INVALID'),
(44, '2024-05-31', '15:49:04', '831DEA11', 'INVALID'),
(45, '2024-06-03', '11:59:42', '831DEA11', 'INVALID'),
(46, '2024-06-03', '12:03:09', '831DEA11', 'INVALID'),
(47, '2024-06-03', '12:06:09', '831DEA11', 'INVALID'),
(48, '2024-06-03', '12:06:16', '831DEA11', 'INVALID'),
(49, '2024-06-03', '12:25:47', '831DEA11', 'INVALID'),
(50, '2024-06-03', '13:19:27', '831DEA11', 'INVALID'),
(51, '2024-06-03', '13:23:40', '831DEA11', 'INVALID'),
(52, '2024-06-03', '13:31:06', '831DEA11', 'INVALID'),
(53, '2024-06-03', '13:35:44', '831DEA11', 'INVALID'),
(54, '2024-06-03', '14:27:45', '831DEA11', 'INVALID'),
(55, '2024-06-03', '14:28:02', '831DEA11', 'INVALID'),
(56, '2024-06-03', '14:28:56', '831DEA11', 'INVALID'),
(57, '2024-06-03', '14:32:09', '831DEA11', 'INVALID'),
(58, '2024-06-03', '14:32:35', '831DEA11', 'INVALID'),
(59, '2024-06-04', '12:48:52', '831DEA11', 'INVALID'),
(60, '2024-06-04', '12:50:57', '831DEA11', 'INVALID'),
(61, '2024-06-04', '12:56:23', '831DEA11', 'INVALID'),
(63, '2024-06-10', '14:59:40', 'B3B0E5C', 'INVALID'),
(64, '2024-06-10', '15:02:43', 'B3B0E5C', 'INVALID');

-- --------------------------------------------------------

--
-- Table structure for table `data_karyawan`
--

CREATE TABLE `data_karyawan` (
  `id` int(50) NOT NULL,
  `created` date NOT NULL DEFAULT current_timestamp(),
  `uid` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `division` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `picture` varchar(100) NOT NULL,
  `saldo` int(11) NOT NULL DEFAULT 0,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_karyawan`
--

INSERT INTO `data_karyawan` (`id`, `created`, `uid`, `nama`, `division`, `mail`, `alamat`, `picture`, `saldo`, `password`) VALUES
(6, '2023-03-10', 'EABF484', 'Muhamad Pandu Arya Putra', 'Laki-Laki', '0882006672260', 'Ngramut', '', 0, ''),
(8, '2023-03-10', '12', 'hiw', 'Perempuan', '0882006672260', 'a', '', 0, ''),
(10, '2024-05-17', '535380F6', 'Aldi', 'Laki-Laki', '08123456789', 'Batam', '', 0, ''),
(11, '2024-05-17', '33B3D30', 'Aldi', 'Laki-Laki', '08123456789', 'Batam', '', 0, ''),
(12, '2024-05-20', 'C3579FE', 'Aldi', 'Laki-Laki', '08123456789', 'Batam', '', 0, ''),
(17, '2024-06-10', 'B3B0E50C', 'Galih', 'Laki-Laki', 'galihtririskyandiko@gmail.com', 'Batu Ampar', '', 40000, '$2y$10$6PoYk6G24xlFz'),
(18, '2024-06-11', '70772113', 'Fauzan', 'Laki-Laki', 'fauzan@gmail.com', 'Batam Centre', '', 5000, '$2y$10$C9dngofY4Ulu4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_absen`
--
ALTER TABLE `data_absen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_invalid`
--
ALTER TABLE `data_invalid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_karyawan`
--
ALTER TABLE `data_karyawan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_absen`
--
ALTER TABLE `data_absen`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `data_invalid`
--
ALTER TABLE `data_invalid`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `data_karyawan`
--
ALTER TABLE `data_karyawan`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

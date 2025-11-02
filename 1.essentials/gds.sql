-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2025 at 12:51 PM
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
-- Database: `gds`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblaircraft`
--

CREATE TABLE `tblaircraft` (
  `id` int(11) NOT NULL,
  `iata` varchar(10) DEFAULT NULL,
  `icao` varchar(10) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `first_class` smallint(5) UNSIGNED NOT NULL,
  `business_class` smallint(5) UNSIGNED NOT NULL,
  `economy_class` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblaircraft`
--

INSERT INTO `tblaircraft` (`id`, `iata`, `icao`, `model`, `first_class`, `business_class`, `economy_class`) VALUES
(1, 'DH8D', 'DH8D', 'De Havilland Dash 8-Q400', 10, 20, 80),
(2, 'AT76', 'AT76', 'ATR 72-600', 10, 20, 80),
(3, 'AT42', 'AT42', 'ATR 42-600', 10, 20, 80),
(4, '320', 'A320', 'Airbus A320-200', 10, 20, 80),
(5, '32N', 'A20N', 'Airbus A320neo', 10, 20, 80),
(6, '321', 'A321', 'Airbus A321-200', 10, 20, 80),
(7, '32Q', 'A21N', 'Airbus A321neo', 10, 20, 80),
(8, '333', 'A333', 'Airbus A330-300', 10, 20, 80),
(9, '339', 'A339', 'Airbus A330-900neo', 10, 20, 80),
(10, '359', 'A359', 'Airbus A350-900', 10, 20, 80),
(11, '35K', 'A35K', 'Airbus A350-1000', 10, 20, 80),
(12, '77W', 'B77W', 'Boeing 777-300ER', 10, 20, 80),
(13, '738', 'B738', 'Boeing 737-800', 10, 20, 80),
(14, '7M8', 'B38M', 'Boeing 737 MAX 8', 10, 20, 80),
(15, '788', 'B788', 'Boeing 787-8', 10, 20, 80),
(16, '789', 'B789', 'Boeing 787-9', 10, 20, 80),
(17, '78X', 'B78X', 'Boeing 787-10', 10, 20, 80),
(18, '388', 'A388', 'Airbus A380-800', 10, 20, 80);

-- --------------------------------------------------------

--
-- Table structure for table `tblairline`
--

CREATE TABLE `tblairline` (
  `id` int(11) NOT NULL,
  `iata` varchar(10) DEFAULT NULL,
  `icao` varchar(10) DEFAULT NULL,
  `airline_name` varchar(100) DEFAULT NULL,
  `callsign` varchar(50) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `comments` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblairline`
--

INSERT INTO `tblairline` (`id`, `iata`, `icao`, `airline_name`, `callsign`, `region`, `comments`) VALUES
(1, '5J', 'CEB', 'Cebu Pacific', 'CEBU', 'Philippines', 'Founded 1988'),
(2, 'PR', 'PAL', 'Philippine Airlines', 'PHILIPPINE', 'Philippines', 'Flag carrier'),
(3, 'Z2', 'APG', 'Philippines AirAsia', 'ASIAN SPIRIT', 'Philippines', 'Subsidiary of AirAsia'),
(4, 'RW', 'RPA', 'Royal Air Philippines', 'ROYAL BLUE', 'Philippines', 'Charter & scheduled ops'),
(5, 'T6', 'ATX', 'AirSWIFT', 'AIRSWIFT', 'Philippines', 'Boutique island carrier');

-- --------------------------------------------------------

--
-- Table structure for table `tblairlineuser`
--

CREATE TABLE `tblairlineuser` (
  `id` int(11) NOT NULL,
  `user` varchar(50) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `aid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblairlineuser`
--

INSERT INTO `tblairlineuser` (`id`, `user`, `pass`, `type`, `aid`) VALUES
(1, 'ceb_admin', 'ceb12345', 'admin', 1),
(2, 'ceb_ops1', 'opsceb01', 'staff', 1),
(3, 'pal_admin', 'paladmin22', 'admin', 2),
(4, 'pal_agent1', 'palagent88', 'agent', 2),
(5, 'pal_pilot1', 'flypal330', 'pilot', 2),
(6, 'airasia_admin', 'aa2025', 'admin', 3),
(7, 'airasia_ops', 'ops888', 'staff', 3),
(8, 'royair_admin', 'roy123', 'admin', 4),
(9, 'royair_agent1', 'royagent55', 'agent', 4),
(10, 'airswift_admin', 'swiftHR22', 'admin', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tblairport`
--

CREATE TABLE `tblairport` (
  `id` int(11) NOT NULL,
  `iata` varchar(10) DEFAULT NULL,
  `icao` varchar(10) DEFAULT NULL,
  `airport_name` varchar(100) DEFAULT NULL,
  `location_serve` varchar(50) DEFAULT NULL,
  `time` varchar(20) DEFAULT NULL,
  `dst` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblairport`
--

INSERT INTO `tblairport` (`id`, `iata`, `icao`, `airport_name`, `location_serve`, `time`, `dst`) VALUES
(1, 'MNL', 'RPLL', 'Ninoy Aquino International', 'Manila, Philippines', 'UTC+8', 'N'),
(2, 'CEB', 'RPVM', 'Mactan-Cebu International', 'Cebu, Philippines', 'UTC+8', 'N'),
(3, 'DVO', 'RPMD', 'Francisco Bangoy International', 'Davao, Philippines', 'UTC+8', 'N'),
(4, 'CRK', 'RPLC', 'Clark International', 'Angeles, Philippines', 'UTC+8', 'N'),
(5, 'ILO', 'RPVI', 'Iloilo International', 'Iloilo, Philippines', 'UTC+8', 'N'),
(6, 'PPS', 'RPVP', 'Puerto Princesa International', 'Palawan, Philippines', 'UTC+8', 'N'),
(7, 'TAG', 'RPVT', 'Bohol-Panglao International', 'Bohol, Philippines', 'UTC+8', 'N'),
(8, 'ZAM', 'RPMZ', 'Zamboanga International', 'Zamboanga, Philippines', 'UTC+8', 'N'),
(9, 'KLO', 'RPVK', 'Kalibo International', 'Kalibo, Philippines', 'UTC+8', 'N'),
(10, 'LGP', 'RPVP', 'Legazpi (Bicol) International', 'Albay, Philippines', 'UTC+8', 'N'),
(11, 'CGY', 'RPMY', 'Laguindingan Airport', 'Cagayan de Oro, PH', 'UTC+8', 'N'),
(12, 'NRT', 'RJAA', 'Narita International', 'Tokyo, Japan', 'UTC+9', 'N'),
(13, 'HND', 'RJTT', 'Haneda International', 'Tokyo, Japan', 'UTC+9', 'N'),
(14, 'HKG', 'VHHH', 'Hong Kong International', 'Hong Kong', 'UTC+8', 'N'),
(15, 'SIN', 'WSSS', 'Singapore Changi', 'Singapore', 'UTC+8', 'N'),
(16, 'KUL', 'WMKK', 'Kuala Lumpur International', 'Kuala Lumpur, Malaysia', 'UTC+8', 'N'),
(17, 'BKK', 'VTBS', 'Suvarnabhumi Airport', 'Bangkok, Thailand', 'UTC+7', 'N'),
(18, 'DXB', 'OMDB', 'Dubai International', 'Dubai, UAE', 'UTC+4', 'N'),
(19, 'DOH', 'OTHH', 'Hamad International', 'Doha, Qatar', 'UTC+3', 'N'),
(20, 'LAX', 'KLAX', 'Los Angeles International', 'Los Angeles, USA', 'UTC-8', 'Y'),
(21, 'SFO', 'KSFO', 'San Francisco International', 'San Francisco, USA', 'UTC-8', 'Y'),
(22, 'JFK', 'KJFK', 'John F. Kennedy International', 'New York, USA', 'UTC-5', 'Y'),
(23, 'LHR', 'EGLL', 'London Heathrow', 'London, UK', 'UTC+0', 'Y'),
(24, 'LGW', 'EGKK', 'London Gatwick', 'London, UK', 'UTC+0', 'Y'),
(25, 'CDG', 'LFPG', 'Paris Charles de Gaulle', 'Paris, France', 'UTC+1', 'Y'),
(26, 'FRA', 'EDDF', 'Frankfurt International', 'Frankfurt, Germany', 'UTC+1', 'Y'),
(27, 'AMS', 'EHAM', 'Amsterdam Schiphol', 'Amsterdam, Netherlands', 'UTC+1', 'Y'),
(28, 'SYD', 'YSSY', 'Sydney Kingsford Smith', 'Sydney, Australia', 'UTC+10', 'Y'),
(29, 'MEL', 'YMML', 'Melbourne Tullamarine', 'Melbourne, Australia', 'UTC+10', 'Y'),
(30, 'ICN', 'RKSI', 'Incheon International', 'Seoul, South Korea', 'UTC+9', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `tblflightroute`
--

CREATE TABLE `tblflightroute` (
  `id` int(11) NOT NULL,
  `aid` int(11) DEFAULT NULL,
  `oapid` int(11) DEFAULT NULL,
  `dapid` int(11) DEFAULT NULL,
  `round_trip` tinyint(1) DEFAULT NULL,
  `acid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblflightroute`
--

INSERT INTO `tblflightroute` (`id`, `aid`, `oapid`, `dapid`, `round_trip`, `acid`) VALUES
(1, 1, 1, 2, 1, 4),
(2, 1, 2, 3, 1, 4),
(3, 2, 1, 5, 1, 8),
(4, 2, 1, 6, 1, 10),
(5, 2, 1, 8, 1, 12),
(6, 2, 1, 9, 1, 10),
(7, 2, 1, 10, 1, 12),
(8, 3, 1, 6, 1, 4),
(9, 3, 1, 7, 1, 5),
(10, 4, 2, 14, 1, 2),
(11, 5, 1, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblflightschedule`
--

CREATE TABLE `tblflightschedule` (
  `id` int(11) NOT NULL,
  `auid` int(11) DEFAULT NULL,
  `frid` int(11) DEFAULT NULL,
  `date_departure` date DEFAULT NULL,
  `time_departure` time DEFAULT NULL,
  `date_arrival` date DEFAULT NULL,
  `time_arrival` time DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `fclass_price` int(11) NOT NULL,
  `cclass_price` int(11) NOT NULL,
  `yclass_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblflightschedule`
--

INSERT INTO `tblflightschedule` (`id`, `auid`, `frid`, `date_departure`, `time_departure`, `date_arrival`, `time_arrival`, `status`, `fclass_price`, `cclass_price`, `yclass_price`) VALUES
(16, 1, 1, '2025-09-09', '21:28:00', '2025-09-10', '09:28:00', 'Scheduled', 0, 0, 0),
(17, 1, 1, '2025-09-16', '21:32:00', '2025-09-17', '09:32:00', 'Scheduled', 0, 0, 0),
(18, 1, 2, '2025-09-16', '00:30:00', '2025-09-17', '12:30:00', 'Scheduled', 2300, 211, 100);

-- --------------------------------------------------------

--
-- Table structure for table `tblseats`
--

CREATE TABLE `tblseats` (
  `id` int(11) NOT NULL,
  `fid` int(11) DEFAULT NULL,
  `ticket_no` varchar(20) DEFAULT NULL,
  `seat_name` varchar(20) DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblseats`
--

INSERT INTO `tblseats` (`id`, `fid`, `ticket_no`, `seat_name`, `class`, `status`) VALUES
(111, 16, '000001', 'A1', 'First', 'available'),
(112, 16, '000002', 'B1', 'First', 'available'),
(113, 16, '000003', 'C1', 'First', 'available'),
(114, 16, '000004', 'A2', 'First', 'available'),
(115, 16, '000005', 'B2', 'First', 'available'),
(116, 16, '000006', 'C2', 'First', 'available'),
(117, 16, '000007', 'A3', 'First', 'available'),
(118, 16, '000008', 'B3', 'First', 'available'),
(119, 16, '000009', 'C3', 'First', 'available'),
(120, 16, '000010', 'A4', 'First', 'available'),
(121, 16, '000011', 'A1', 'Business', 'available'),
(122, 16, '000012', 'B1', 'Business', 'available'),
(123, 16, '000013', 'C1', 'Business', 'available'),
(124, 16, '000014', 'D1', 'Business', 'available'),
(125, 16, '000015', 'A2', 'Business', 'available'),
(126, 16, '000016', 'B2', 'Business', 'available'),
(127, 16, '000017', 'C2', 'Business', 'available'),
(128, 16, '000018', 'D2', 'Business', 'available'),
(129, 16, '000019', 'A3', 'Business', 'available'),
(130, 16, '000020', 'B3', 'Business', 'available'),
(131, 16, '000021', 'C3', 'Business', 'available'),
(132, 16, '000022', 'D3', 'Business', 'available'),
(133, 16, '000023', 'A4', 'Business', 'available'),
(134, 16, '000024', 'B4', 'Business', 'available'),
(135, 16, '000025', 'C4', 'Business', 'available'),
(136, 16, '000026', 'D4', 'Business', 'available'),
(137, 16, '000027', 'A5', 'Business', 'available'),
(138, 16, '000028', 'B5', 'Business', 'available'),
(139, 16, '000029', 'C5', 'Business', 'available'),
(140, 16, '000030', 'D5', 'Business', 'available'),
(141, 16, '000031', 'A1', 'Economy', 'available'),
(142, 16, '000032', 'B1', 'Economy', 'available'),
(143, 16, '000033', 'C1', 'Economy', 'available'),
(144, 16, '000034', 'D1', 'Economy', 'available'),
(145, 16, '000035', 'E1', 'Economy', 'available'),
(146, 16, '000036', 'F1', 'Economy', 'available'),
(147, 16, '000037', 'A2', 'Economy', 'available'),
(148, 16, '000038', 'B2', 'Economy', 'available'),
(149, 16, '000039', 'C2', 'Economy', 'available'),
(150, 16, '000040', 'D2', 'Economy', 'available'),
(151, 16, '000041', 'E2', 'Economy', 'available'),
(152, 16, '000042', 'F2', 'Economy', 'available'),
(153, 16, '000043', 'A3', 'Economy', 'available'),
(154, 16, '000044', 'B3', 'Economy', 'available'),
(155, 16, '000045', 'C3', 'Economy', 'available'),
(156, 16, '000046', 'D3', 'Economy', 'available'),
(157, 16, '000047', 'E3', 'Economy', 'available'),
(158, 16, '000048', 'F3', 'Economy', 'available'),
(159, 16, '000049', 'A4', 'Economy', 'available'),
(160, 16, '000050', 'B4', 'Economy', 'available'),
(161, 16, '000051', 'C4', 'Economy', 'available'),
(162, 16, '000052', 'D4', 'Economy', 'available'),
(163, 16, '000053', 'E4', 'Economy', 'available'),
(164, 16, '000054', 'F4', 'Economy', 'available'),
(165, 16, '000055', 'A5', 'Economy', 'available'),
(166, 16, '000056', 'B5', 'Economy', 'available'),
(167, 16, '000057', 'C5', 'Economy', 'available'),
(168, 16, '000058', 'D5', 'Economy', 'available'),
(169, 16, '000059', 'E5', 'Economy', 'available'),
(170, 16, '000060', 'F5', 'Economy', 'available'),
(171, 16, '000061', 'A6', 'Economy', 'available'),
(172, 16, '000062', 'B6', 'Economy', 'available'),
(173, 16, '000063', 'C6', 'Economy', 'available'),
(174, 16, '000064', 'D6', 'Economy', 'available'),
(175, 16, '000065', 'E6', 'Economy', 'available'),
(176, 16, '000066', 'F6', 'Economy', 'available'),
(177, 16, '000067', 'A7', 'Economy', 'available'),
(178, 16, '000068', 'B7', 'Economy', 'available'),
(179, 16, '000069', 'C7', 'Economy', 'available'),
(180, 16, '000070', 'D7', 'Economy', 'available'),
(181, 16, '000071', 'E7', 'Economy', 'available'),
(182, 16, '000072', 'F7', 'Economy', 'available'),
(183, 16, '000073', 'A8', 'Economy', 'available'),
(184, 16, '000074', 'B8', 'Economy', 'available'),
(185, 16, '000075', 'C8', 'Economy', 'available'),
(186, 16, '000076', 'D8', 'Economy', 'available'),
(187, 16, '000077', 'E8', 'Economy', 'available'),
(188, 16, '000078', 'F8', 'Economy', 'available'),
(189, 16, '000079', 'A9', 'Economy', 'available'),
(190, 16, '000080', 'B9', 'Economy', 'available'),
(191, 16, '000081', 'C9', 'Economy', 'available'),
(192, 16, '000082', 'D9', 'Economy', 'available'),
(193, 16, '000083', 'E9', 'Economy', 'available'),
(194, 16, '000084', 'F9', 'Economy', 'available'),
(195, 16, '000085', 'A10', 'Economy', 'available'),
(196, 16, '000086', 'B10', 'Economy', 'available'),
(197, 16, '000087', 'C10', 'Economy', 'available'),
(198, 16, '000088', 'D10', 'Economy', 'available'),
(199, 16, '000089', 'E10', 'Economy', 'available'),
(200, 16, '000090', 'F10', 'Economy', 'available'),
(201, 16, '000091', 'A11', 'Economy', 'available'),
(202, 16, '000092', 'B11', 'Economy', 'available'),
(203, 16, '000093', 'C11', 'Economy', 'available'),
(204, 16, '000094', 'D11', 'Economy', 'available'),
(205, 16, '000095', 'E11', 'Economy', 'available'),
(206, 16, '000096', 'F11', 'Economy', 'available'),
(207, 16, '000097', 'A12', 'Economy', 'available'),
(208, 16, '000098', 'B12', 'Economy', 'available'),
(209, 16, '000099', 'C12', 'Economy', 'available'),
(210, 16, '000100', 'D12', 'Economy', 'available'),
(211, 16, '000101', 'E12', 'Economy', 'available'),
(212, 16, '000102', 'F12', 'Economy', 'available'),
(213, 16, '000103', 'A13', 'Economy', 'available'),
(214, 16, '000104', 'B13', 'Economy', 'available'),
(215, 16, '000105', 'C13', 'Economy', 'available'),
(216, 16, '000106', 'D13', 'Economy', 'available'),
(217, 16, '000107', 'E13', 'Economy', 'available'),
(218, 16, '000108', 'F13', 'Economy', 'available'),
(219, 16, '000109', 'A14', 'Economy', 'available'),
(220, 16, '000110', 'B14', 'Economy', 'available'),
(221, 17, '000001', 'A1', 'First', 'available'),
(222, 17, '000002', 'B1', 'First', 'available'),
(223, 17, '000003', 'C1', 'First', 'available'),
(224, 17, '000004', 'A2', 'First', 'available'),
(225, 17, '000005', 'B2', 'First', 'available'),
(226, 17, '000006', 'C2', 'First', 'available'),
(227, 17, '000007', 'A3', 'First', 'available'),
(228, 17, '000008', 'B3', 'First', 'available'),
(229, 17, '000009', 'C3', 'First', 'available'),
(230, 17, '000010', 'A4', 'First', 'available'),
(231, 17, '000011', 'A1', 'Business', 'available'),
(232, 17, '000012', 'B1', 'Business', 'available'),
(233, 17, '000013', 'C1', 'Business', 'available'),
(234, 17, '000014', 'D1', 'Business', 'available'),
(235, 17, '000015', 'A2', 'Business', 'available'),
(236, 17, '000016', 'B2', 'Business', 'available'),
(237, 17, '000017', 'C2', 'Business', 'available'),
(238, 17, '000018', 'D2', 'Business', 'available'),
(239, 17, '000019', 'A3', 'Business', 'available'),
(240, 17, '000020', 'B3', 'Business', 'available'),
(241, 17, '000021', 'C3', 'Business', 'available'),
(242, 17, '000022', 'D3', 'Business', 'available'),
(243, 17, '000023', 'A4', 'Business', 'available'),
(244, 17, '000024', 'B4', 'Business', 'available'),
(245, 17, '000025', 'C4', 'Business', 'available'),
(246, 17, '000026', 'D4', 'Business', 'available'),
(247, 17, '000027', 'A5', 'Business', 'available'),
(248, 17, '000028', 'B5', 'Business', 'available'),
(249, 17, '000029', 'C5', 'Business', 'available'),
(250, 17, '000030', 'D5', 'Business', 'available'),
(251, 17, '000031', 'A1', 'Economy', 'available'),
(252, 17, '000032', 'B1', 'Economy', 'available'),
(253, 17, '000033', 'C1', 'Economy', 'available'),
(254, 17, '000034', 'D1', 'Economy', 'available'),
(255, 17, '000035', 'E1', 'Economy', 'available'),
(256, 17, '000036', 'F1', 'Economy', 'available'),
(257, 17, '000037', 'A2', 'Economy', 'available'),
(258, 17, '000038', 'B2', 'Economy', 'available'),
(259, 17, '000039', 'C2', 'Economy', 'available'),
(260, 17, '000040', 'D2', 'Economy', 'available'),
(261, 17, '000041', 'E2', 'Economy', 'available'),
(262, 17, '000042', 'F2', 'Economy', 'available'),
(263, 17, '000043', 'A3', 'Economy', 'available'),
(264, 17, '000044', 'B3', 'Economy', 'available'),
(265, 17, '000045', 'C3', 'Economy', 'available'),
(266, 17, '000046', 'D3', 'Economy', 'available'),
(267, 17, '000047', 'E3', 'Economy', 'available'),
(268, 17, '000048', 'F3', 'Economy', 'available'),
(269, 17, '000049', 'A4', 'Economy', 'available'),
(270, 17, '000050', 'B4', 'Economy', 'available'),
(271, 17, '000051', 'C4', 'Economy', 'available'),
(272, 17, '000052', 'D4', 'Economy', 'available'),
(273, 17, '000053', 'E4', 'Economy', 'available'),
(274, 17, '000054', 'F4', 'Economy', 'available'),
(275, 17, '000055', 'A5', 'Economy', 'available'),
(276, 17, '000056', 'B5', 'Economy', 'available'),
(277, 17, '000057', 'C5', 'Economy', 'available'),
(278, 17, '000058', 'D5', 'Economy', 'available'),
(279, 17, '000059', 'E5', 'Economy', 'available'),
(280, 17, '000060', 'F5', 'Economy', 'available'),
(281, 17, '000061', 'A6', 'Economy', 'available'),
(282, 17, '000062', 'B6', 'Economy', 'available'),
(283, 17, '000063', 'C6', 'Economy', 'available'),
(284, 17, '000064', 'D6', 'Economy', 'available'),
(285, 17, '000065', 'E6', 'Economy', 'available'),
(286, 17, '000066', 'F6', 'Economy', 'available'),
(287, 17, '000067', 'A7', 'Economy', 'available'),
(288, 17, '000068', 'B7', 'Economy', 'available'),
(289, 17, '000069', 'C7', 'Economy', 'available'),
(290, 17, '000070', 'D7', 'Economy', 'available'),
(291, 17, '000071', 'E7', 'Economy', 'available'),
(292, 17, '000072', 'F7', 'Economy', 'available'),
(293, 17, '000073', 'A8', 'Economy', 'available'),
(294, 17, '000074', 'B8', 'Economy', 'available'),
(295, 17, '000075', 'C8', 'Economy', 'available'),
(296, 17, '000076', 'D8', 'Economy', 'available'),
(297, 17, '000077', 'E8', 'Economy', 'available'),
(298, 17, '000078', 'F8', 'Economy', 'available'),
(299, 17, '000079', 'A9', 'Economy', 'available'),
(300, 17, '000080', 'B9', 'Economy', 'available'),
(301, 17, '000081', 'C9', 'Economy', 'available'),
(302, 17, '000082', 'D9', 'Economy', 'available'),
(303, 17, '000083', 'E9', 'Economy', 'available'),
(304, 17, '000084', 'F9', 'Economy', 'available'),
(305, 17, '000085', 'A10', 'Economy', 'available'),
(306, 17, '000086', 'B10', 'Economy', 'available'),
(307, 17, '000087', 'C10', 'Economy', 'available'),
(308, 17, '000088', 'D10', 'Economy', 'available'),
(309, 17, '000089', 'E10', 'Economy', 'available'),
(310, 17, '000090', 'F10', 'Economy', 'available'),
(311, 17, '000091', 'A11', 'Economy', 'available'),
(312, 17, '000092', 'B11', 'Economy', 'available'),
(313, 17, '000093', 'C11', 'Economy', 'available'),
(314, 17, '000094', 'D11', 'Economy', 'available'),
(315, 17, '000095', 'E11', 'Economy', 'available'),
(316, 17, '000096', 'F11', 'Economy', 'available'),
(317, 17, '000097', 'A12', 'Economy', 'available'),
(318, 17, '000098', 'B12', 'Economy', 'available'),
(319, 17, '000099', 'C12', 'Economy', 'available'),
(320, 17, '000100', 'D12', 'Economy', 'available'),
(321, 17, '000101', 'E12', 'Economy', 'available'),
(322, 17, '000102', 'F12', 'Economy', 'available'),
(323, 17, '000103', 'A13', 'Economy', 'available'),
(324, 17, '000104', 'B13', 'Economy', 'available'),
(325, 17, '000105', 'C13', 'Economy', 'available'),
(326, 17, '000106', 'D13', 'Economy', 'available'),
(327, 17, '000107', 'E13', 'Economy', 'available'),
(328, 17, '000108', 'F13', 'Economy', 'available'),
(329, 17, '000109', 'A14', 'Economy', 'available'),
(330, 17, '000110', 'B14', 'Economy', 'available'),
(331, 18, '000001', 'A1', 'First', 'available'),
(332, 18, '000002', 'B1', 'First', 'available'),
(333, 18, '000003', 'C1', 'First', 'available'),
(334, 18, '000004', 'A2', 'First', 'available'),
(335, 18, '000005', 'B2', 'First', 'available'),
(336, 18, '000006', 'C2', 'First', 'available'),
(337, 18, '000007', 'A3', 'First', 'available'),
(338, 18, '000008', 'B3', 'First', 'available'),
(339, 18, '000009', 'C3', 'First', 'available'),
(340, 18, '000010', 'A4', 'First', 'available'),
(341, 18, '000011', 'A1', 'Business', 'available'),
(342, 18, '000012', 'B1', 'Business', 'available'),
(343, 18, '000013', 'C1', 'Business', 'available'),
(344, 18, '000014', 'D1', 'Business', 'available'),
(345, 18, '000015', 'A2', 'Business', 'available'),
(346, 18, '000016', 'B2', 'Business', 'available'),
(347, 18, '000017', 'C2', 'Business', 'available'),
(348, 18, '000018', 'D2', 'Business', 'available'),
(349, 18, '000019', 'A3', 'Business', 'available'),
(350, 18, '000020', 'B3', 'Business', 'available'),
(351, 18, '000021', 'C3', 'Business', 'available'),
(352, 18, '000022', 'D3', 'Business', 'available'),
(353, 18, '000023', 'A4', 'Business', 'available'),
(354, 18, '000024', 'B4', 'Business', 'available'),
(355, 18, '000025', 'C4', 'Business', 'available'),
(356, 18, '000026', 'D4', 'Business', 'available'),
(357, 18, '000027', 'A5', 'Business', 'available'),
(358, 18, '000028', 'B5', 'Business', 'available'),
(359, 18, '000029', 'C5', 'Business', 'available'),
(360, 18, '000030', 'D5', 'Business', 'available'),
(361, 18, '000031', 'A1', 'Economy', 'available'),
(362, 18, '000032', 'B1', 'Economy', 'available'),
(363, 18, '000033', 'C1', 'Economy', 'available'),
(364, 18, '000034', 'D1', 'Economy', 'available'),
(365, 18, '000035', 'E1', 'Economy', 'available'),
(366, 18, '000036', 'F1', 'Economy', 'available'),
(367, 18, '000037', 'A2', 'Economy', 'available'),
(368, 18, '000038', 'B2', 'Economy', 'available'),
(369, 18, '000039', 'C2', 'Economy', 'available'),
(370, 18, '000040', 'D2', 'Economy', 'available'),
(371, 18, '000041', 'E2', 'Economy', 'available'),
(372, 18, '000042', 'F2', 'Economy', 'available'),
(373, 18, '000043', 'A3', 'Economy', 'available'),
(374, 18, '000044', 'B3', 'Economy', 'available'),
(375, 18, '000045', 'C3', 'Economy', 'available'),
(376, 18, '000046', 'D3', 'Economy', 'available'),
(377, 18, '000047', 'E3', 'Economy', 'available'),
(378, 18, '000048', 'F3', 'Economy', 'available'),
(379, 18, '000049', 'A4', 'Economy', 'available'),
(380, 18, '000050', 'B4', 'Economy', 'available'),
(381, 18, '000051', 'C4', 'Economy', 'available'),
(382, 18, '000052', 'D4', 'Economy', 'available'),
(383, 18, '000053', 'E4', 'Economy', 'available'),
(384, 18, '000054', 'F4', 'Economy', 'available'),
(385, 18, '000055', 'A5', 'Economy', 'available'),
(386, 18, '000056', 'B5', 'Economy', 'available'),
(387, 18, '000057', 'C5', 'Economy', 'available'),
(388, 18, '000058', 'D5', 'Economy', 'available'),
(389, 18, '000059', 'E5', 'Economy', 'available'),
(390, 18, '000060', 'F5', 'Economy', 'available'),
(391, 18, '000061', 'A6', 'Economy', 'available'),
(392, 18, '000062', 'B6', 'Economy', 'available'),
(393, 18, '000063', 'C6', 'Economy', 'available'),
(394, 18, '000064', 'D6', 'Economy', 'available'),
(395, 18, '000065', 'E6', 'Economy', 'available'),
(396, 18, '000066', 'F6', 'Economy', 'available'),
(397, 18, '000067', 'A7', 'Economy', 'available'),
(398, 18, '000068', 'B7', 'Economy', 'available'),
(399, 18, '000069', 'C7', 'Economy', 'available'),
(400, 18, '000070', 'D7', 'Economy', 'available'),
(401, 18, '000071', 'E7', 'Economy', 'available'),
(402, 18, '000072', 'F7', 'Economy', 'available'),
(403, 18, '000073', 'A8', 'Economy', 'available'),
(404, 18, '000074', 'B8', 'Economy', 'available'),
(405, 18, '000075', 'C8', 'Economy', 'available'),
(406, 18, '000076', 'D8', 'Economy', 'available'),
(407, 18, '000077', 'E8', 'Economy', 'available'),
(408, 18, '000078', 'F8', 'Economy', 'available'),
(409, 18, '000079', 'A9', 'Economy', 'available'),
(410, 18, '000080', 'B9', 'Economy', 'available'),
(411, 18, '000081', 'C9', 'Economy', 'available'),
(412, 18, '000082', 'D9', 'Economy', 'available'),
(413, 18, '000083', 'E9', 'Economy', 'available'),
(414, 18, '000084', 'F9', 'Economy', 'available'),
(415, 18, '000085', 'A10', 'Economy', 'available'),
(416, 18, '000086', 'B10', 'Economy', 'available'),
(417, 18, '000087', 'C10', 'Economy', 'available'),
(418, 18, '000088', 'D10', 'Economy', 'available'),
(419, 18, '000089', 'E10', 'Economy', 'available'),
(420, 18, '000090', 'F10', 'Economy', 'available'),
(421, 18, '000091', 'A11', 'Economy', 'available'),
(422, 18, '000092', 'B11', 'Economy', 'available'),
(423, 18, '000093', 'C11', 'Economy', 'available'),
(424, 18, '000094', 'D11', 'Economy', 'available'),
(425, 18, '000095', 'E11', 'Economy', 'available'),
(426, 18, '000096', 'F11', 'Economy', 'available'),
(427, 18, '000097', 'A12', 'Economy', 'available'),
(428, 18, '000098', 'B12', 'Economy', 'available'),
(429, 18, '000099', 'C12', 'Economy', 'available'),
(430, 18, '000100', 'D12', 'Economy', 'available'),
(431, 18, '000101', 'E12', 'Economy', 'available'),
(432, 18, '000102', 'F12', 'Economy', 'available'),
(433, 18, '000103', 'A13', 'Economy', 'available'),
(434, 18, '000104', 'B13', 'Economy', 'available'),
(435, 18, '000105', 'C13', 'Economy', 'available'),
(436, 18, '000106', 'D13', 'Economy', 'available'),
(437, 18, '000107', 'E13', 'Economy', 'available'),
(438, 18, '000108', 'F13', 'Economy', 'available'),
(439, 18, '000109', 'A14', 'Economy', 'available'),
(440, 18, '000110', 'B14', 'Economy', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL,
  `user` varchar(20) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `user`, `pass`, `role`) VALUES
(1, 'admin', 'admin123', 'admin'),
(2, 'user1', 'password1', 'user'),
(3, 'user2', 'password2', 'user'),
(4, 'user3', 'password3', 'user'),
(5, 'user4', 'password4', 'user'),
(6, 'user5', 'password5', 'user'),
(7, 'user6', 'password6', 'user'),
(8, 'user7', 'password7', 'user'),
(9, 'user8', 'password8', 'user'),
(10, 'user9', 'password9', 'user'),
(11, 'user10', 'password10', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblaircraft`
--
ALTER TABLE `tblaircraft`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblairline`
--
ALTER TABLE `tblairline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblairlineuser`
--
ALTER TABLE `tblairlineuser`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aid` (`aid`);

--
-- Indexes for table `tblairport`
--
ALTER TABLE `tblairport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblflightroute`
--
ALTER TABLE `tblflightroute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aid` (`aid`),
  ADD KEY `oapid` (`oapid`),
  ADD KEY `dapid` (`dapid`),
  ADD KEY `acid` (`acid`);

--
-- Indexes for table `tblflightschedule`
--
ALTER TABLE `tblflightschedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auid` (`auid`),
  ADD KEY `frid` (`frid`);

--
-- Indexes for table `tblseats`
--
ALTER TABLE `tblseats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fid` (`fid`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblaircraft`
--
ALTER TABLE `tblaircraft`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tblairline`
--
ALTER TABLE `tblairline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblairlineuser`
--
ALTER TABLE `tblairlineuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tblairport`
--
ALTER TABLE `tblairport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tblflightroute`
--
ALTER TABLE `tblflightroute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblflightschedule`
--
ALTER TABLE `tblflightschedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tblseats`
--
ALTER TABLE `tblseats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=441;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblairlineuser`
--
ALTER TABLE `tblairlineuser`
  ADD CONSTRAINT `tblairlineuser_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `tblairline` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `tblflightroute`
--
ALTER TABLE `tblflightroute`
  ADD CONSTRAINT `tblflightroute_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `tblairline` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tblflightroute_ibfk_2` FOREIGN KEY (`oapid`) REFERENCES `tblairport` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tblflightroute_ibfk_3` FOREIGN KEY (`dapid`) REFERENCES `tblairport` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tblflightroute_ibfk_4` FOREIGN KEY (`acid`) REFERENCES `tblaircraft` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `tblflightschedule`
--
ALTER TABLE `tblflightschedule`
  ADD CONSTRAINT `tblflightschedule_ibfk_1` FOREIGN KEY (`auid`) REFERENCES `tblairlineuser` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tblflightschedule_ibfk_2` FOREIGN KEY (`frid`) REFERENCES `tblflightroute` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `tblseats`
--
ALTER TABLE `tblseats`
  ADD CONSTRAINT `tblseats_ibfk_1` FOREIGN KEY (`fid`) REFERENCES `tblflightschedule` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

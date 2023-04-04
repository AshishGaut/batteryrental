-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2023 at 10:11 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ev`
--

-- --------------------------------------------------------

--
-- Table structure for table `battery`
--

CREATE TABLE `battery` (
  `name` varchar(255) DEFAULT NULL,
  `capacity` float DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `battery_health` float DEFAULT NULL,
  `charge_cycle` int(11) DEFAULT NULL,
  `vehicle_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `battery`
--

INSERT INTO `battery` (`name`, `capacity`, `purchase_date`, `battery_health`, `charge_cycle`, `vehicle_number`) VALUES
('Jameson Duke', 2, '1996-06-17', 100, 100, NULL),
('Quincy Hampton', 65, '1977-05-02', 56, 50, NULL),
('Charity Franks', 35, '1988-04-11', 100, 76, NULL),
('Micah Burks', 42, '2010-08-19', 100, 53, NULL),
('Rooney Baldwin', 67, '2020-07-25', 100, 66, NULL),
('Oliver Alvarez', 1, '1983-08-19', 100, 67, NULL),
('Paloma Rivers', 84, '1988-08-25', 88, 93, NULL),
('Murphy Byers', 57, '2018-09-01', 23, 99, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `battery_history`
--

CREATE TABLE `battery_history` (
  `id` int(11) NOT NULL,
  `battery_name` varchar(255) DEFAULT NULL,
  `vehicle_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `battery_history`
--

INSERT INTO `battery_history` (`id`, `battery_name`, `vehicle_number`) VALUES
(25, 'Rooney Baldwin', '844');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `battery_capacity` float DEFAULT NULL,
  `vehicle_number` varchar(255) DEFAULT NULL,
  `owner` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `driver_license_number` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`id`, `name`, `battery_capacity`, `vehicle_number`, `owner`, `contact_number`, `driver_license_number`) VALUES
(29, 'Kennan David', NULL, '254', 'Veniam necessitatib', '+1 (889) 458-1865', '557'),
(30, 'Ryder Miranda', 84, '538', 'Anim cupidatat sint ', '+1 (441) 273-9553', '539'),
(31, 'Noelani Lee', 67, '844', 'Qui veniam Nam moll', '+1 (249) 534-2917', '976'),
(32, 'Ocean Sanchez', NULL, '185', 'Id laboriosam quas ', '+1 (506) 585-3007', '656'),
(33, 'Florence Tate', 14, '850', 'Expedita pariatur D', '+1 (676) 815-8162', '671'),
(34, 'Mara Schmidt', 61, '749', 'Quos qui sit anim c', '+1 (407) 439-9697', '676'),
(35, 'Clinton Johnston', NULL, '203', 'Occaecat aut exercit', '+1 (582) 885-2676', '81');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `battery`
--
ALTER TABLE `battery`
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `vehicle_number` (`vehicle_number`);

--
-- Indexes for table `battery_history`
--
ALTER TABLE `battery_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `battery_name` (`battery_name`),
  ADD KEY `vehicle_number` (`vehicle_number`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehicle_number` (`vehicle_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `battery_history`
--
ALTER TABLE `battery_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `battery`
--
ALTER TABLE `battery`
  ADD CONSTRAINT `battery_ibfk_1` FOREIGN KEY (`vehicle_number`) REFERENCES `vehicle` (`vehicle_number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `battery_history`
--
ALTER TABLE `battery_history`
  ADD CONSTRAINT `battery_history_ibfk_1` FOREIGN KEY (`battery_name`) REFERENCES `battery` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `battery_history_ibfk_2` FOREIGN KEY (`vehicle_number`) REFERENCES `vehicle` (`vehicle_number`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

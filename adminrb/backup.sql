-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2024 at 03:04 PM
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
-- Database: `goklassifieds_wpoets`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `adminUsername` varchar(100) NOT NULL,
  `adminPassword` varchar(50) NOT NULL,
  `adminName` varchar(150) NOT NULL,
  `isBlocked` bit(1) NOT NULL DEFAULT b'0',
  `isSuperAdmin` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminUsername`, `adminPassword`, `adminName`, `isBlocked`, `isSuperAdmin`) VALUES
(1, 'raj358822@gmail.com', '928d2da3b15c879922543af336f67ae5', 'Rajeshkumar Basani', b'0', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `tabs`
--

CREATE TABLE `tabs` (
  `tabID` int(11) NOT NULL,
  `tabName` varchar(150) NOT NULL,
  `tabOrder` int(11) NOT NULL DEFAULT 1,
  `tabEnable` tinyint(1) NOT NULL DEFAULT 1,
  `tabData` text NOT NULL,
  `tabAdded` int(11) NOT NULL,
  `tagAddedDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `tabUpdated` int(11) NOT NULL DEFAULT 0,
  `tabUpdatedDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabs`
--

INSERT INTO `tabs` (`tabID`, `tabName`, `tabOrder`, `tabEnable`, `tabData`, `tabAdded`, `tagAddedDate`, `tabUpdated`, `tabUpdatedDate`) VALUES
(20, 'Learning', 3, 1, '', 1, '2024-08-16 11:30:52', 1, '2024-08-16 11:30:52'),
(21, 'Technology', 2, 1, '', 1, '2024-08-16 11:40:43', 1, '2024-08-16 11:40:43'),
(22, 'Communication', 1, 1, '', 1, '2024-08-16 11:42:10', 1, '2024-08-16 11:42:10');

-- --------------------------------------------------------

--
-- Table structure for table `tabs_slider`
--

CREATE TABLE `tabs_slider` (
  `sliderID` int(11) NOT NULL,
  `sliderSubHead` varchar(250) NOT NULL,
  `sliderHead` varchar(250) NOT NULL,
  `sliderLinkText` varchar(150) NOT NULL,
  `sliderLink` varchar(500) NOT NULL,
  `sliderEnable` int(1) NOT NULL DEFAULT 1,
  `sliderOrder` int(11) NOT NULL DEFAULT 1,
  `ref_tabID` int(11) NOT NULL,
  `sliderAdded` int(11) NOT NULL,
  `sliderAddedDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `sliderUpdated` int(11) NOT NULL,
  `sliderUpdatedDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabs_slider`
--

INSERT INTO `tabs_slider` (`sliderID`, `sliderSubHead`, `sliderHead`, `sliderLinkText`, `sliderLink`, `sliderEnable`, `sliderOrder`, `ref_tabID`, `sliderAdded`, `sliderAddedDate`, `sliderUpdated`, `sliderUpdatedDate`) VALUES
(6, 'Digital Learning Infrastructure', 'Usability enhancement and Training for Transaction Portal for Customers', 'Learn More', 'https://www.wpoets.com/', 1, 1, 22, 1, '2024-08-16 14:14:07', 1, '2024-08-16 14:14:07'),
(7, 'Digital Learning Infrastructure', 'Usability enhancement and Training for Transaction Portal for Customers 2', 'Learn More', 'https://www.wpoets.com/', 1, 2, 22, 1, '2024-08-17 06:08:21', 1, '2024-08-17 06:08:21'),
(8, 'Digital Learning Infrastructure', 'Usability enhancement and Training for Transaction Portal for Customers 3', 'Learn More', 'https://www.wpoets.com/', 1, 3, 22, 1, '2024-08-17 06:09:05', 1, '2024-08-17 06:09:05'),
(9, 'Digital Learning Infrastructure', 'Usability enhancement and Training for Transaction Portal for Customers', 'Learn More', 'https://www.wpoets.com/', 1, 1, 20, 1, '2024-08-17 06:09:26', 0, '2024-08-17 06:09:26'),
(10, 'Digital Learning Infrastructure', 'Usability enhancement and Training for Transaction Portal for Customers', 'Learn More', 'https://www.wpoets.com/', 1, 2, 20, 1, '2024-08-17 06:09:38', 0, '2024-08-17 06:09:38'),
(11, 'Digital Learning Infrastructure', 'Usability enhancement and Training for Transaction Portal for Customers', 'Learn More', 'https://www.wpoets.com/', 1, 3, 20, 1, '2024-08-17 06:09:50', 0, '2024-08-17 06:09:50'),
(12, 'Digital Learning Infrastructure', 'Usability enhancement and Training for Transaction Portal for Customers', 'Learn More', 'https://www.wpoets.com/', 1, 1, 21, 1, '2024-08-17 06:10:10', 0, '2024-08-17 06:10:10'),
(13, 'Digital Learning Infrastructure', 'Usability enhancement and Training for Transaction Portal for Customers', 'Learn More', 'https://www.wpoets.com/', 1, 2, 21, 1, '2024-08-17 06:10:22', 0, '2024-08-17 06:10:22'),
(14, 'Digital Learning Infrastructure', 'Usability enhancement and Training for Transaction Portal for Customers', 'Learn More', 'https://www.wpoets.com/', 1, 3, 21, 1, '2024-08-17 06:10:32', 0, '2024-08-17 06:10:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `tabs`
--
ALTER TABLE `tabs`
  ADD PRIMARY KEY (`tabID`);

--
-- Indexes for table `tabs_slider`
--
ALTER TABLE `tabs_slider`
  ADD PRIMARY KEY (`sliderID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tabs`
--
ALTER TABLE `tabs`
  MODIFY `tabID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tabs_slider`
--
ALTER TABLE `tabs_slider`
  MODIFY `sliderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

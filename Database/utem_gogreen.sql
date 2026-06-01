-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2026 at 04:19 AM
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
-- Database: `utem_gogreen`
--

-- --------------------------------------------------------

--
-- Table structure for table `point_history`
--

CREATE TABLE `point_history` (
  `PointID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `TotalPoint` int(11) DEFAULT 0,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recycleactivity`
--

CREATE TABLE `recycleactivity` (
  `ActivityID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `BinID` int(11) NOT NULL,
  `MaterialType` varchar(100) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `ImagePath` varchar(255) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recyclingbin`
--

CREATE TABLE `recyclingbin` (
  `BinID` int(11) NOT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `BinType` varchar(100) DEFAULT NULL,
  `Latitude` decimal(10,8) DEFAULT NULL,
  `Longitude` decimal(11,8) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `redeem`
--

CREATE TABLE `redeem` (
  `RedeemID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `RewardID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `ReportID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Description` text DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `BinID` int(11) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reward`
--

CREATE TABLE `reward` (
  `RewardID` int(11) NOT NULL,
  `RewardName` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL,
  `PointsRequired` int(11) NOT NULL,
  `Stock` int(11) DEFAULT 0,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` varchar(50) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `point_history`
--
ALTER TABLE `point_history`
  ADD PRIMARY KEY (`PointID`),
  ADD KEY `fk_point_user` (`UserID`);

--
-- Indexes for table `recycleactivity`
--
ALTER TABLE `recycleactivity`
  ADD PRIMARY KEY (`ActivityID`),
  ADD KEY `fk_activity_user` (`UserID`),
  ADD KEY `fk_activity_bin` (`BinID`);

--
-- Indexes for table `recyclingbin`
--
ALTER TABLE `recyclingbin`
  ADD PRIMARY KEY (`BinID`);

--
-- Indexes for table `redeem`
--
ALTER TABLE `redeem`
  ADD PRIMARY KEY (`RedeemID`),
  ADD KEY `fk_redeem_user` (`UserID`),
  ADD KEY `fk_redeem_reward` (`RewardID`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`ReportID`),
  ADD KEY `fk_report_user` (`UserID`),
  ADD KEY `fk_report_bin` (`BinID`);

--
-- Indexes for table `reward`
--
ALTER TABLE `reward`
  ADD PRIMARY KEY (`RewardID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `point_history`
--
ALTER TABLE `point_history`
  MODIFY `PointID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recycleactivity`
--
ALTER TABLE `recycleactivity`
  MODIFY `ActivityID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recyclingbin`
--
ALTER TABLE `recyclingbin`
  MODIFY `BinID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `redeem`
--
ALTER TABLE `redeem`
  MODIFY `RedeemID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `ReportID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reward`
--
ALTER TABLE `reward`
  MODIFY `RewardID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `point_history`
--
ALTER TABLE `point_history`
  ADD CONSTRAINT `fk_point_user` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recycleactivity`
--
ALTER TABLE `recycleactivity`
  ADD CONSTRAINT `fk_activity_bin` FOREIGN KEY (`BinID`) REFERENCES `recyclingbin` (`BinID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_activity_user` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `redeem`
--
ALTER TABLE `redeem`
  ADD CONSTRAINT `fk_redeem_reward` FOREIGN KEY (`RewardID`) REFERENCES `reward` (`RewardID`),
  ADD CONSTRAINT `fk_redeem_user` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `fk_report_bin` FOREIGN KEY (`BinID`) REFERENCES `recyclingbin` (`BinID`),
  ADD CONSTRAINT `fk_report_user` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

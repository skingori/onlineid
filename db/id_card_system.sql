-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 23, 2017 at 12:20 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id_card_system`
--
CREATE DATABASE IF NOT EXISTS `id_card_system` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `id_card_system`;

-- --------------------------------------------------------

--
-- Table structure for table `Application_Payment_Table`
--
-- Creation: Nov 12, 2017 at 06:47 PM
--

DROP TABLE IF EXISTS `Application_Payment_Table`;
CREATE TABLE `Application_Payment_Table` (
  `Application_Payment_Id` int(11) NOT NULL,
  `Application_Payment_Application_Id` int(20) DEFAULT NULL,
  `Application_Payment_Payment_Id` varchar(20) DEFAULT NULL,
  `Application_Payment_Payment_Code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Application_Payment_Table`
--

INSERT INTO `Application_Payment_Table` (`Application_Payment_Id`, `Application_Payment_Application_Id`, `Application_Payment_Payment_Id`, `Application_Payment_Payment_Code`) VALUES
(6, 0, 'dshdrtyt566v', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `Application_Table`
--
-- Creation: Nov 12, 2017 at 06:42 PM
--

DROP TABLE IF EXISTS `Application_Table`;
CREATE TABLE `Application_Table` (
  `Application_Id` int(20) NOT NULL,
  `Application_DateTime` varchar(255) DEFAULT NULL,
  `Application_Type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Application_Table`
--

INSERT INTO `Application_Table` (`Application_Id`, `Application_DateTime`, `Application_Type`) VALUES
(0, '2017-11-12 22:00:17', 'NORMAL'),
(21212, '2017-11-17 22:17:28', 'NORMAL'),
(345734657, '2017-11-17 22:23:48', 'NORMAL');

-- --------------------------------------------------------

--
-- Table structure for table `Login_Table`
--
-- Creation: Nov 19, 2017 at 10:26 PM
--

DROP TABLE IF EXISTS `Login_Table`;
CREATE TABLE `Login_Table` (
  `Login_Id` int(20) NOT NULL DEFAULT '0',
  `Login_Username` varchar(255) DEFAULT NULL,
  `Login_Password` varchar(255) DEFAULT NULL,
  `Login_Rank` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Login_Table`
--

INSERT INTO `Login_Table` (`Login_Id`, `Login_Username`, `Login_Password`, `Login_Rank`) VALUES
(0, 'Shaddy', '76420f8e8b7c27d02ebda959a9e6058e', 2),
(12345, 'kennedy', 'c0d033d6e54fa56c368c80edb1850334', 2),
(21212, 'user', '21232f297a57a5a743894a0e4a801fc3', 2),
(123456, 'Kilonzo', '9a771241eedcdd397641fd27f9f14e4b', 2),
(777777, 'Lilian', '4f5347204a6727bbc6fb3f26edb79bce', 2),
(12345678, 'MusavI', '0dc67af68f792035c4b5f7ec47bc7965', 2),
(23232323, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(34343434, 'samsy', '7be790e8f2934273c118ef565475c216', 2),
(345734657, 'kenwam', '7be790e8f2934273c118ef565475c216', 2),
(2147483647, 'user1', '7be790e8f2934273c118ef565475c216', 2);

-- --------------------------------------------------------

--
-- Table structure for table `Notification_Table`
--
-- Creation: Nov 12, 2017 at 02:10 PM
--

DROP TABLE IF EXISTS `Notification_Table`;
CREATE TABLE `Notification_Table` (
  `Notification_Id` bigint(20) NOT NULL,
  `Notification_DateTime` varchar(255) DEFAULT NULL,
  `Notification_Message` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Notification_Table`
--

INSERT INTO `Notification_Table` (`Notification_Id`, `Notification_DateTime`, `Notification_Message`) VALUES
(1766200949, '2017-11-12 21:23:11', 'ughjghgjhgucryet\r\na'),
(2175501140, '2017-11-17 22:19:10', 'Your application has been approved'),
(7208149999, '2017-11-17 22:24:38', 'Ken wamatu,your Id is ready');

-- --------------------------------------------------------

--
-- Table structure for table `Payment_Table`
--
-- Creation: Nov 12, 2017 at 06:46 PM
--

DROP TABLE IF EXISTS `Payment_Table`;
CREATE TABLE `Payment_Table` (
  `Payment_code` int(11) NOT NULL,
  `Payment_Id` varchar(20) NOT NULL,
  `Payment_Amount` int(20) DEFAULT NULL,
  `Payment_DateTime` varchar(255) NOT NULL DEFAULT '',
  `Payment_Mode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Payment_Table`
--

INSERT INTO `Payment_Table` (`Payment_code`, `Payment_Id`, `Payment_Amount`, `Payment_DateTime`, `Payment_Mode`) VALUES
(2147483647, 'dshdrtyt566v', 50, '2017-11-12 22:00:17', 'AIRTEL-MONEY');

-- --------------------------------------------------------

--
-- Table structure for table `User_Notification_Table`
--
-- Creation: Nov 12, 2017 at 02:14 PM
--

DROP TABLE IF EXISTS `User_Notification_Table`;
CREATE TABLE `User_Notification_Table` (
  `User_Notification_Id` int(20) NOT NULL,
  `User_Notification_User_Id` int(20) DEFAULT NULL,
  `User_Notification_Notification_Id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `User_Notification_Table`
--

INSERT INTO `User_Notification_Table` (`User_Notification_Id`, `User_Notification_User_Id`, `User_Notification_Notification_Id`) VALUES
(1, 21212, 2175501140),
(2, 345734657, 7208149999);

-- --------------------------------------------------------

--
-- Table structure for table `User_Table`
--
-- Creation: Nov 12, 2017 at 01:52 PM
--

DROP TABLE IF EXISTS `User_Table`;
CREATE TABLE `User_Table` (
  `User_Id` int(20) NOT NULL DEFAULT '0',
  `User_Name` varchar(255) DEFAULT NULL,
  `User_Contact` varchar(255) DEFAULT NULL,
  `User_Gender` varchar(255) DEFAULT NULL,
  `User_DOB` varchar(255) DEFAULT NULL,
  `User_Photo` longtext NOT NULL,
  `User_Document_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `User_Table`
--

INSERT INTO `User_Table` (`User_Id`, `User_Name`, `User_Contact`, `User_Gender`, `User_DOB`, `User_Photo`, `User_Document_type`) VALUES
(0, 'Shaddy', '07004678873', 'male', '09/05/2017', '../upload/male.jpg', '../upload/Logbook - KCC 954 B..jpg'),
(21212, 'wewe wewewe', '+2547862232', 'male', '2017-10-16', '../upload/avatar04.png', '../upload/JAMES.SQL'),
(123456, 'Kilonzo muasa', '0728915898', 'male', '11/05/2017', '../upload/m.jpg', '../upload/LB.jpg'),
(777777, 'Lilian Bahati', '0712808709', 'female', '11/02/2017', '../upload/f.jpg', '../upload/LC..jpg'),
(12345678, 'Musavi kamau', '0716741941', 'male', '11/01/2017', '../upload/me.jpg', '../upload/LY).jpg'),
(34343434, 'Samsy', '8963164723647', 'male', '4343-03-03', '../upload/photo1.png', '../upload/user1-128x128.jpg'),
(345734657, 'Ken Wamatu', '57684768476984', 'male', '11/17/2017', '../upload/index.jpg', '../upload/b.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Application_Payment_Table`
--
ALTER TABLE `Application_Payment_Table`
  ADD PRIMARY KEY (`Application_Payment_Id`),
  ADD UNIQUE KEY `Application_payment_Payment_Code` (`Application_Payment_Payment_Code`),
  ADD KEY `Application_Payment_Application_Id` (`Application_Payment_Application_Id`);

--
-- Indexes for table `Application_Table`
--
ALTER TABLE `Application_Table`
  ADD PRIMARY KEY (`Application_Id`);

--
-- Indexes for table `Login_Table`
--
ALTER TABLE `Login_Table`
  ADD PRIMARY KEY (`Login_Id`);

--
-- Indexes for table `Notification_Table`
--
ALTER TABLE `Notification_Table`
  ADD PRIMARY KEY (`Notification_Id`);

--
-- Indexes for table `Payment_Table`
--
ALTER TABLE `Payment_Table`
  ADD PRIMARY KEY (`Payment_code`);

--
-- Indexes for table `User_Notification_Table`
--
ALTER TABLE `User_Notification_Table`
  ADD PRIMARY KEY (`User_Notification_Id`),
  ADD KEY `User_Notification_Notification_Id` (`User_Notification_Notification_Id`);

--
-- Indexes for table `User_Table`
--
ALTER TABLE `User_Table`
  ADD PRIMARY KEY (`User_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Application_Payment_Table`
--
ALTER TABLE `Application_Payment_Table`
  MODIFY `Application_Payment_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `User_Notification_Table`
--
ALTER TABLE `User_Notification_Table`
  MODIFY `User_Notification_Id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Application_Payment_Table`
--
ALTER TABLE `Application_Payment_Table`
  ADD CONSTRAINT `application_payment_table_ibfk_2` FOREIGN KEY (`Application_Payment_Application_Id`) REFERENCES `Application_Table` (`Application_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `application_payment_table_ibfk_3` FOREIGN KEY (`Application_Payment_Payment_Code`) REFERENCES `Payment_Table` (`Payment_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `User_Notification_Table`
--
ALTER TABLE `User_Notification_Table`
  ADD CONSTRAINT `user_notification_table_ibfk_1` FOREIGN KEY (`User_Notification_Notification_Id`) REFERENCES `Notification_Table` (`Notification_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `User_Table`
--
ALTER TABLE `User_Table`
  ADD CONSTRAINT `user_table_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `Login_Table` (`Login_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

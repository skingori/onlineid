-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 22, 2017 at 05:24 PM
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

DROP TABLE IF EXISTS `Application_Payment_Table`;
CREATE TABLE `Application_Payment_Table` (
  `Application_Payment_Id` int(11) NOT NULL,
  `Application_Payment_Application_Id` int(20) DEFAULT NULL,
  `Application_Payment_Payment_Id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Application_Payment_Table`
--

INSERT INTO `Application_Payment_Table` (`Application_Payment_Id`, `Application_Payment_Application_Id`, `Application_Payment_Payment_Id`) VALUES
(3, 21212, 'VFIPLLLHG6667HGGG'),
(4, 12345, 'NHSGSFTJ55');

-- --------------------------------------------------------

--
-- Table structure for table `Application_Table`
--

DROP TABLE IF EXISTS `Application_Table`;
CREATE TABLE `Application_Table` (
  `Application_Id` int(20) NOT NULL DEFAULT '0',
  `Application_DateTime` varchar(255) DEFAULT NULL,
  `Application_Type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Application_Table`
--

INSERT INTO `Application_Table` (`Application_Id`, `Application_DateTime`, `Application_Type`) VALUES
(12345, '2017-10-22 16:07:39', 'NORMAL'),
(21212, '2017-10-22 14:44:39', 'NORMAL');

-- --------------------------------------------------------

--
-- Table structure for table `Login_Table`
--

DROP TABLE IF EXISTS `Login_Table`;
CREATE TABLE `Login_Table` (
  `Login_Id` int(20) NOT NULL DEFAULT '0',
  `Login_Username` varchar(255) DEFAULT NULL,
  `Login_Password` varchar(255) DEFAULT NULL,
  `Login_Rank` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Login_Table`
--

INSERT INTO `Login_Table` (`Login_Id`, `Login_Username`, `Login_Password`, `Login_Rank`) VALUES
(0, 'ewewe', '7be790e8f2934273c118ef565475c216', '2'),
(1214, 'ssdsde', '7be790e8f2934273c118ef565475c216', '2'),
(12345, 'kennedy', 'c0d033d6e54fa56c368c80edb1850334', '2'),
(21212, 'user', '21232f297a57a5a743894a0e4a801fc3', '2'),
(4543434, 'dfdfdfd', '7be790e8f2934273c118ef565475c216', '2'),
(12345678, 'admin1', '7be790e8f2934273c118ef565475c216', '2'),
(23232323, 'admin', '21232f297a57a5a743894a0e4a801fc3', '1'),
(34343434, 'samsy', '7be790e8f2934273c118ef565475c216', '2'),
(43434343, 'ereree', '7be790e8f2934273c118ef565475c216', '2');

-- --------------------------------------------------------

--
-- Table structure for table `Notification_Table`
--

DROP TABLE IF EXISTS `Notification_Table`;
CREATE TABLE `Notification_Table` (
  `Notification_Id` int(20) NOT NULL DEFAULT '0',
  `Notification_DateTime` varchar(255) DEFAULT NULL,
  `Notification_Message` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Payment_Table`
--

DROP TABLE IF EXISTS `Payment_Table`;
CREATE TABLE `Payment_Table` (
  `Payment_Id` varchar(20) NOT NULL DEFAULT '0',
  `Payment_Amount` int(20) DEFAULT NULL,
  `Payment_DateTime` varchar(255) DEFAULT NULL,
  `Payment_Mode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Payment_Table`
--

INSERT INTO `Payment_Table` (`Payment_Id`, `Payment_Amount`, `Payment_DateTime`, `Payment_Mode`) VALUES
('NHSGSFTJ55', 250, '2017-10-22 16:07:39', 'MPESA'),
('VFIPLLLHG6667HGGG', 80000, '2017-10-22 14:44:39', 'MPESA');

-- --------------------------------------------------------

--
-- Table structure for table `User_Notification_Table`
--

DROP TABLE IF EXISTS `User_Notification_Table`;
CREATE TABLE `User_Notification_Table` (
  `User_Notification_Id` int(20) NOT NULL DEFAULT '0',
  `User_Notification_User_Id` int(20) DEFAULT NULL,
  `User_Notification_Notification_Id` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `User_Table`
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
(12345, 'samuel', '+254716741941', 'male', '2017-10-10', '../upload/cirrus.png', '../upload/cirrus.png'),
(21212, 'wewe wewewe', '0', 'male', '2017-10-16', '../upload/user6-128x128.jpg', '../upload/visa.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Application_Payment_Table`
--
ALTER TABLE `Application_Payment_Table`
  ADD PRIMARY KEY (`Application_Payment_Id`);

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
  ADD PRIMARY KEY (`Payment_Id`);

--
-- Indexes for table `User_Notification_Table`
--
ALTER TABLE `User_Notification_Table`
  ADD PRIMARY KEY (`User_Notification_Id`);

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
  MODIFY `Application_Payment_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

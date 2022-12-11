-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 21, 2022 at 08:16 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `Ad_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Ad_Name` varchar(50) NOT NULL,
  `Ad_Email` varchar(50) NOT NULL,
  `Ad_Pass` varchar(50) NOT NULL,
  PRIMARY KEY (`Ad_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Ad_ID`, `Ad_Name`, `Ad_Email`, `Ad_Pass`) VALUES
(1, 'sam', 'samalkahli@gmail.com', 'Sam.1212');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `D_ID` int(11) NOT NULL AUTO_INCREMENT,
  `D_Name` varchar(50) NOT NULL,
  `F_ID` int(11) NOT NULL,
  PRIMARY KEY (`D_ID`),
  UNIQUE KEY `F_ID` (`F_ID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

DROP TABLE IF EXISTS `exam`;
CREATE TABLE IF NOT EXISTS `exam` (
  `Ex_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Ex_Type` varchar(50) NOT NULL,
  `Ex_Duration` varchar(50) NOT NULL,
  `Ex_Qnumber` varchar(50) NOT NULL,
  `Ex_Date` varchar(50) NOT NULL,
  `Su_ID` int(11) NOT NULL,
  PRIMARY KEY (`Ex_ID`),
  KEY `Su_ID` (`Su_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
CREATE TABLE IF NOT EXISTS `faculty` (
  `F_ID` int(11) NOT NULL AUTO_INCREMENT,
  `F_Name` varchar(50) NOT NULL,
  PRIMARY KEY (`F_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`F_ID`, `F_Name`) VALUES
(1, 'Computer saince'),
(2, 'Computer saince'),
(3, 'Computer saince'),
(4, 'Computer saince'),
(5, 'Computer saince'),
(6, 'Computer saince'),
(7, 'Computer saince'),
(8, 'Computer saince'),
(9, 'Computer saince'),
(10, 'sam');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

DROP TABLE IF EXISTS `lecturer`;
CREATE TABLE IF NOT EXISTS `lecturer` (
  `Le_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Le_Name` varchar(50) NOT NULL,
  `Le_Birthday` varchar(50) NOT NULL,
  `Le_Email` varchar(50) NOT NULL,
  `Le_Pass` varchar(50) NOT NULL,
  `Le_Gender` varchar(50) NOT NULL,
  `Le_Degree` varchar(50) NOT NULL,
  PRIMARY KEY (`Le_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`Le_ID`, `Le_Name`, `Le_Birthday`, `Le_Email`, `Le_Pass`, `Le_Gender`, `Le_Degree`) VALUES
(1, 'hani', '2021-10-20', 'samalkahli@gmail.comm', 'Sam.121212', 'male', 'Prof.'),
(2, 's', '2020-08-20', 'Admin@com', 'Sam.121212', 'male', 'Prof.'),
(3, 's', '2020-08-20', 'Admin@com', 'Sam.121212', 'male', 'Prof.'),
(4, 's', '2020-08-20', 'Admin@com', 'Sam.121212', 'male', 'Prof.'),
(5, 's', '2020-08-20', 'Admin@com', 'Sam.121212', 'male', 'Prof.'),
(6, 'hani', '2021-10-20', 'Admin@com', 'Sam.121212', 'male', 'Prof.'),
(7, 'hani', '2021-10-20', 'Admin@com', 'Sam.121212', 'male', 'Prof.'),
(8, 'sam', '2021-10-20', 'Admin@com', 'Sam.121212', 'male', 'Doctor'),
(9, 'hani', '2021-10-20', 'Admin@com', 'Sam.121212', 'male', 'Prof.'),
(10, 'hani', '2021-10-20', 'admin@username', 'admin@password', 'male', 'Prof.');

-- --------------------------------------------------------

--
-- Table structure for table `option`
--

DROP TABLE IF EXISTS `option`;
CREATE TABLE IF NOT EXISTS `option` (
  `Op_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Op_Text` varchar(50) NOT NULL,
  `Op_Status` varchar(50) NOT NULL,
  `Qu_ID` int(11) NOT NULL,
  PRIMARY KEY (`Op_ID`),
  KEY `Qu_ID` (`Qu_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

DROP TABLE IF EXISTS `program`;
CREATE TABLE IF NOT EXISTS `program` (
  `P_ID` int(11) NOT NULL AUTO_INCREMENT,
  `P_Name` varchar(50) NOT NULL,
  `D_ID` int(11) NOT NULL,
  PRIMARY KEY (`P_ID`),
  KEY `D_ID` (`D_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `Qu_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Qu_Chapter` varchar(50) NOT NULL,
  `Qu_CILOs` varchar(50) NOT NULL,
  `Qu_Text` varchar(50) NOT NULL,
  `Qu_Mark` varchar(50) NOT NULL,
  `Qu_Type` varchar(50) NOT NULL,
  `Ex_ID` int(11) NOT NULL,
  PRIMARY KEY (`Qu_ID`),
  KEY `Ex_ID` (`Ex_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

DROP TABLE IF EXISTS `semester`;
CREATE TABLE IF NOT EXISTS `semester` (
  `Se_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Se_Name` varchar(50) NOT NULL,
  `P_ID` int(11) NOT NULL,
  PRIMARY KEY (`Se_ID`),
  KEY `P_ID` (`P_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `Su_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Su_Name` varchar(50) NOT NULL,
  `Le_ID` int(11) NOT NULL,
  `Se_ID` int(11) NOT NULL,
  PRIMARY KEY (`Su_ID`),
  KEY `Le_ID` (`Le_ID`),
  KEY `Se_ID` (`Se_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `F_ID` FOREIGN KEY (`F_ID`) REFERENCES `faculty` (`F_ID`);

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `Su_ID` FOREIGN KEY (`Su_ID`) REFERENCES `subject` (`Su_ID`);

--
-- Constraints for table `option`
--
ALTER TABLE `option`
  ADD CONSTRAINT `Qu_ID` FOREIGN KEY (`Qu_ID`) REFERENCES `question` (`Qu_ID`);

--
-- Constraints for table `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `D_ID` FOREIGN KEY (`D_ID`) REFERENCES `department` (`D_ID`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `Ex_ID` FOREIGN KEY (`Ex_ID`) REFERENCES `exam` (`Ex_ID`);

--
-- Constraints for table `semester`
--
ALTER TABLE `semester`
  ADD CONSTRAINT `P_ID` FOREIGN KEY (`P_ID`) REFERENCES `program` (`P_ID`);

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `Le_ID` FOREIGN KEY (`Le_ID`) REFERENCES `lecturer` (`Le_ID`),
  ADD CONSTRAINT `Se_ID` FOREIGN KEY (`Se_ID`) REFERENCES `semester` (`Se_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

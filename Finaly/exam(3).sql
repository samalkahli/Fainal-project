-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 05, 2023 at 02:08 PM
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
(1, 'admin', 'samalkahli@gmail.com', 'Sam.1212');

-- --------------------------------------------------------

--
-- Table structure for table `chapter`
--

DROP TABLE IF EXISTS `chapter`;
CREATE TABLE IF NOT EXISTS `chapter` (
  `Ch_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Ch_Number` int(11) NOT NULL,
  `Ch_SupTopic` varchar(500) NOT NULL,
  `Ch_Topic` varchar(500) NOT NULL,
  `Su_ID` int(11) NOT NULL,
  PRIMARY KEY (`Ch_ID`),
  KEY `Su_ID` (`Su_ID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chapter`
--

INSERT INTO `chapter` (`Ch_ID`, `Ch_Number`, `Ch_SupTopic`, `Ch_Topic`, `Su_ID`) VALUES
(1, 1, 'doief', 'ronaq', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cilo`
--

DROP TABLE IF EXISTS `cilo`;
CREATE TABLE IF NOT EXISTS `cilo` (
  `C_ID` int(11) NOT NULL AUTO_INCREMENT,
  `C_Title` varchar(50) NOT NULL,
  `C_Alias` varchar(500) NOT NULL,
  `C_Text` varchar(500) NOT NULL,
  `C_Chapter` int(11) NOT NULL,
  `Ch_ID` int(11) NOT NULL,
  `Su_ID` int(11) NOT NULL,
  PRIMARY KEY (`C_ID`),
  KEY `Ch_ID` (`Ch_ID`) USING BTREE,
  KEY `Su_ID` (`Su_ID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cilo`
--

INSERT INTO `cilo` (`C_ID`, `C_Title`, `C_Alias`, `C_Text`, `C_Chapter`, `Ch_ID`, `Su_ID`) VALUES
(1, 'Knowledge and Understanding', 'a', 'x', 1, 1, 1),
(2, 'Knowledge and Understanding', 'a', 'sdfghjkl', 1, 1, 1);

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
  KEY `F_ID` (`F_ID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`D_ID`, `D_Name`, `F_ID`) VALUES
(1, 'Information Technology', 1);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

DROP TABLE IF EXISTS `exam`;
CREATE TABLE IF NOT EXISTS `exam` (
  `Ex_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Ex_Type` varchar(50) NOT NULL,
  `Ex_Mark` int(11) NOT NULL,
  `Ex_Duration` varchar(50) NOT NULL,
  `Ex_Date` varchar(50) NOT NULL,
  `Su_ID` int(11) NOT NULL,
  PRIMARY KEY (`Ex_ID`),
  KEY `Su_ID` (`Su_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`Ex_ID`, `Ex_Type`, `Ex_Mark`, `Ex_Duration`, `Ex_Date`, `Su_ID`) VALUES
(1, 'Midterm', 30, '60', '2023-01-03 23:50:44', 1),
(2, 'Test', 30, '30', '2023-01-04 20:23:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
CREATE TABLE IF NOT EXISTS `faculty` (
  `F_ID` int(11) NOT NULL AUTO_INCREMENT,
  `F_Name` varchar(50) NOT NULL,
  PRIMARY KEY (`F_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`F_ID`, `F_Name`) VALUES
(1, 'Computer Science And Information Technology');

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
  `Le_Pass` varchar(100) NOT NULL,
  `Le_Gender` varchar(50) NOT NULL,
  `Le_Degree` varchar(50) NOT NULL,
  PRIMARY KEY (`Le_ID`),
  UNIQUE KEY `Le_Email` (`Le_Email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`Le_ID`, `Le_Name`, `Le_Birthday`, `Le_Email`, `Le_Pass`, `Le_Gender`, `Le_Degree`) VALUES
(1, 'safwan', '2024-03-04', 'admin@username', 'b613649f3e5afa085af436cdaa402a2da35b8967', 'Male', 'Prof.');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`P_ID`, `P_Name`, `D_ID`) VALUES
(1, 'BIT', 1),
(5, 'IT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `Qu_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Qu_Text` varchar(50) NOT NULL,
  `Qu_Mark` varchar(50) NOT NULL,
  `Qu_Type` varchar(50) NOT NULL,
  `Qu_A` varchar(50) DEFAULT NULL,
  `Qu_B` varchar(50) DEFAULT NULL,
  `Qu_C` varchar(50) DEFAULT NULL,
  `Qu_D` varchar(50) DEFAULT NULL,
  `Qu_Answer` varchar(50) NOT NULL,
  `Ex_ID` int(11) NOT NULL,
  `C_ID` int(11) NOT NULL,
  PRIMARY KEY (`Qu_ID`),
  KEY `Ex_ID` (`Ex_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`Qu_ID`, `Qu_Text`, `Qu_Mark`, `Qu_Type`, `Qu_A`, `Qu_B`, `Qu_C`, `Qu_D`, `Qu_Answer`, `Ex_ID`, `C_ID`) VALUES
(1, 'sa', '5', 'True Or False', '', '', '', '', 'True', 2, 1),
(2, 'xxx', '5', 'Choices', 'r', 'q', 'w', 's', 'ds', 2, 1),
(3, 'mm', '5', 'Direct', '', '', '', '', 'zz', 2, 1),
(4, 'sami', '20', 'Direct', '', '', '', '', '123', 1, 1),
(5, 'safwan', '5', 'Choices', '1', '2', '3', '4', '4', 1, 1),
(6, 'sam', '20', 'True Or False', '', '', '', '', 'False', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `Su_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Su_Name` varchar(50) NOT NULL,
  `semster` int(11) NOT NULL,
  `Su_Chapter` int(11) NOT NULL,
  `Le_ID` int(11) NOT NULL,
  `P_ID` int(11) NOT NULL,
  PRIMARY KEY (`Su_ID`),
  KEY `P_ID` (`P_ID`),
  KEY `Le_IDf` (`Le_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`Su_ID`, `Su_Name`, `semster`, `Su_Chapter`, `Le_ID`, `P_ID`) VALUES
(1, 'php', 3, 6, 1, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chapter`
--
ALTER TABLE `chapter`
  ADD CONSTRAINT `Su_IDD` FOREIGN KEY (`Su_ID`) REFERENCES `subject` (`Su_ID`);

--
-- Constraints for table `cilo`
--
ALTER TABLE `cilo`
  ADD CONSTRAINT `Ch_ID_Fkey` FOREIGN KEY (`Ch_ID`) REFERENCES `chapter` (`Ch_ID`),
  ADD CONSTRAINT `Su_ID_fff` FOREIGN KEY (`Su_ID`) REFERENCES `subject` (`Su_ID`);

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
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `Le_IDf` FOREIGN KEY (`Le_ID`) REFERENCES `lecturer` (`Le_ID`),
  ADD CONSTRAINT `P_ID` FOREIGN KEY (`P_ID`) REFERENCES `program` (`P_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

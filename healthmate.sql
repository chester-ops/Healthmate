-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 08, 2024 at 09:10 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthmate`
--

-- --------------------------------------------------------

--
-- Table structure for table `labresults`
--

DROP TABLE IF EXISTS `labresults`;
CREATE TABLE IF NOT EXISTS `labresults` (
  `labID` varchar(30) NOT NULL,
  `userID` varchar(30) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `testDate` varchar(11) NOT NULL,
  `testID` int(11) NOT NULL,
  PRIMARY KEY (`labID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `labresults`
--

INSERT INTO `labresults` (`labID`, `userID`, `value`, `testDate`, `testID`) VALUES
('t662e9e190f50a6.10085580', 'u662e88c3a6adc3.89541738', '3.90', '2024-04-03', 4),
('t662e9f8e0cf363.06138457', 'u662e88c3a6adc3.89541738', '30.00', '2024-04-03', 1),
('t662e9fc8527b09.61136202', 'u662e88c3a6adc3.89541738', '13.50', '2024-04-05', 5),
('t662e9feb61d7b9.07774801', 'u662e88c3a6adc3.89541738', '140.00', '2024-04-06', 2),
('t662ea0140e7297.53421666', 'u662e88c3a6adc3.89541738', '106.00', '2024-04-07', 3),
('t662ea023d03733.26494601', 'u662e88c3a6adc3.89541738', '4.10', '2024-04-08', 1),
('t662ea031da4b11.19513205', 'u662e88c3a6adc3.89541738', '31.00', '2024-04-09', 4),
('t662ea0452ab8c7.93617235', 'u662e88c3a6adc3.89541738', '14.00', '2024-04-10', 5),
('t663062024e4a84.90110193', 'u662e88c3a6adc3.89541738', '50.00', '2024-04-10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `medications`
--

DROP TABLE IF EXISTS `medications`;
CREATE TABLE IF NOT EXISTS `medications` (
  `medID` varchar(30) NOT NULL,
  `userID` varchar(30) NOT NULL,
  `medName` varchar(30) NOT NULL,
  `prescDate` varchar(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `details` varchar(50) NOT NULL,
  PRIMARY KEY (`medID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medications`
--

INSERT INTO `medications` (`medID`, `userID`, `medName`, `prescDate`, `quantity`, `details`) VALUES
('m662ea28136d060.02531514', 'u662e88c3a6adc3.89541738', 'ibuprofen', '2024-04-02', 30, 'Take two tablets every 8 hours for inflammation.'),
('m662ea2aa3230f4.13281464', 'u662e88c3a6adc3.89541738', 'amoxicillin', '2024-04-03', 14, 'Take one capsule three times a day for 7 days.'),
('m662ea2d6caac74.56762394', 'u662e88c3a6adc3.89541738', 'cetirizine', '2024-04-04', 10, 'Take one tablet daily at bedtime for allergies.'),
('m662ea38b20c946.06171494', 'u662e88c3a6adc3.89541738', 'metformin', '2024-04-05', 60, 'Take one tablet twice daily for diabetes.'),
('m662ea3e9cc37a3.56601675', 'u662e88c3a6adc3.89541738', 'atorvastatin', '2024-04-06', 30, 'Take one tablet daily in the evening.'),
('m662ea449a6b6c7.54653061', 'u662e88c3a6adc3.89541738', 'albuterol inhaler ', '2024-04-08', 1, 'Take two puffs every 4-6 hours for asthma.'),
('m662ea4af83a0f3.68973039', 'u662e88c3a6adc3.89541738', 'warfarin', '2024-04-09', 28, 'Take one tablet daily at the same time.'),
('m662ea4d6aa6362.62143341', 'u662e88c3a6adc3.89541738', 'vitamin d3', '2024-04-10', 60, 'Take one tablet  for vitamin D deficiency.');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

DROP TABLE IF EXISTS `tests`;
CREATE TABLE IF NOT EXISTS `tests` (
  `testID` int(11) NOT NULL,
  `refMin` decimal(10,2) NOT NULL,
  `refMax` decimal(10,2) NOT NULL,
  `unit` varchar(8) NOT NULL,
  `testName` varchar(30) NOT NULL,
  PRIMARY KEY (`testID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`testID`, `refMin`, `refMax`, `unit`, `testName`) VALUES
(1, '3.50', '5.30', 'meql', 'potassium (K)'),
(2, '135.00', '147.00', 'meql', 'sodium (Na)'),
(3, '99.00', '111.00', 'meql', 'chloride (Cl)'),
(4, '22.00', '32.00', 'meql', 'carbon dioxide (CO2)'),
(5, '10.30', '12.50', 'sec', 'prothrombin time (PT)');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` varchar(30) NOT NULL,
  `userPassword` varchar(60) NOT NULL,
  `userEmail` varchar(30) NOT NULL,
  `userRole` varchar(11) NOT NULL,
  `fullName` varchar(25) NOT NULL,
  `dateOfBirth` varchar(11) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `houseAddress` varchar(50) NOT NULL,
  `phoneNumber` varchar(13) NOT NULL,
  `profilePicture` varchar(50) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userPassword`, `userEmail`, `userRole`, `fullName`, `dateOfBirth`, `gender`, `houseAddress`, `phoneNumber`, `profilePicture`) VALUES
('u661b8058725744.71189429', '$2y$11$bNVHez936oZRIzvFwPq5SOKwXQ5pvOyf0HEbT52TQo.MG8dQX7B9q', 'okwulehie@gmail.com', 'admin', 'okwulehie tochukwu', '1993-03-10', 'male', ' 7C Nneoma Close, Enugu, Enugu State', '08098765432', 'u661b8058725744.71189429.jpg'),
('u662e88c3a6adc3.89541738', '$2y$11$rW22Qb/GvzJ9zqE9zmngJu3vRE0ytPEJsaPKIMKUhNeC53ZvWex0i', 'chiomaadekunle@gmail.com', 'patient', 'chioma adekunle', '1990-05-15', 'female', '23A Adeola Odeku Street, Victoria Island, Lagos', '08123456789', 'u662e88c3a6adc3.89541738.jpg'),
('u6631c3e37baed1.97494921', '$2y$11$fdqw2xWRBQHwfjI55nQDMucLjO8wlzPdD6uRC3CG2mbNwdXuT.wzO', 'nnamdiokonkwo@gmail.com', 'healthstaff', 'nnamdi okonkwo', '1990-11-20', 'male', '7 Nkemjika Crescent, Enugu, Enugu State', '08061234567', 'u6631c3e37baed1.97494921.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `vitalchecks`
--

DROP TABLE IF EXISTS `vitalchecks`;
CREATE TABLE IF NOT EXISTS `vitalchecks` (
  `checkID` varchar(30) NOT NULL,
  `userID` varchar(30) NOT NULL,
  `measureDate` varchar(11) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `vitalID` int(11) NOT NULL,
  PRIMARY KEY (`checkID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vitalchecks`
--

INSERT INTO `vitalchecks` (`checkID`, `userID`, `measureDate`, `value`, `vitalID`) VALUES
('v662eac39a983e2.19659016', 'u662e88c3a6adc3.89541738', '2024-04-01', '120.00', 2),
('v662eac4269ffe2.50830883', 'u662e88c3a6adc3.89541738', '2024-04-01', '80.00', 3),
('v662eac512444d2.46887463', 'u662e88c3a6adc3.89541738', '2024-04-02', '72.00', 7),
('v662eac963563d9.10381809', 'u662e88c3a6adc3.89541738', '2024-04-03', '37.00', 1),
('v662eaca5e33531.23911242', 'u662e88c3a6adc3.89541738', '2024-04-04', '16.00', 5),
('v662eacb57275c4.04675090', 'u662e88c3a6adc3.89541738', '2024-04-05', '98.00', 8),
('v662eb004e59d12.60997575', 'u662e88c3a6adc3.89541738', '2024-04-06', '110.00', 11),
('v662eb013d75391.47393761', 'u662e88c3a6adc3.89541738', '2024-04-07', '65.50', 6),
('v662eb055cd3e54.90602488', 'u662e88c3a6adc3.89541738', '2024-04-09', '24.00', 10);

-- --------------------------------------------------------

--
-- Table structure for table `vitals`
--

DROP TABLE IF EXISTS `vitals`;
CREATE TABLE IF NOT EXISTS `vitals` (
  `vitalID` int(11) NOT NULL AUTO_INCREMENT,
  `vitalName` varchar(30) NOT NULL,
  `unit` varchar(8) NOT NULL,
  PRIMARY KEY (`vitalID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vitals`
--

INSERT INTO `vitals` (`vitalID`, `vitalName`, `unit`) VALUES
(1, 'body temperature', '°C'),
(2, 'systolic blood pressure', 'mmHg'),
(3, 'diastolic blood pressure', 'mmHg'),
(4, 'pulse rate', 'bpm'),
(5, 'respiratory rate', 'br/min'),
(6, 'weight', 'lb'),
(7, 'heart rate', 'bpm'),
(8, 'oxygen saturation', '%'),
(9, 'height', 'cm'),
(10, 'body mass index', 'kg/m²'),
(11, 'blood glucose', 'mg/dl');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

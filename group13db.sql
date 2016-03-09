-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2016 at 10:39 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `group13db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_details`
--

DROP TABLE IF EXISTS `account_details`;
CREATE TABLE IF NOT EXISTS `account_details` (
  `User_id` int(11) NOT NULL,
  `Premium` varchar(64) DEFAULT NULL,
  `Free_Trail_Used` tinyint(1) DEFAULT NULL,
  `Account_Expiry` tinyint(1) DEFAULT NULL,
  `P_Code` varchar(64) DEFAULT NULL,
  KEY `User_id` (`User_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admiin`
--

DROP TABLE IF EXISTS `admiin`;
CREATE TABLE IF NOT EXISTS `admiin` (
  `Admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `First_Name` varchar(32) NOT NULL,
  `Last_Name` varchar(32) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `Email` varchar(128) NOT NULL,
  PRIMARY KEY (`Admin_id`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `banned_reports`
--

DROP TABLE IF EXISTS `banned_reports`;
CREATE TABLE IF NOT EXISTS `banned_reports` (
  `Report_id` int(11) NOT NULL AUTO_INCREMENT,
  `Reporter_id` int(11) NOT NULL,
  `Reportee_id` int(11) NOT NULL,
  `Content` text NOT NULL,
  `Resolved` tinyint(1) NOT NULL,
  PRIMARY KEY (`Report_id`),
  KEY `Reporter_id` (`Reporter_id`),
  KEY `Reportee_id` (`Reportee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hobbies`
--

DROP TABLE IF EXISTS `hobbies`;
CREATE TABLE IF NOT EXISTS `hobbies` (
  `User_id` int(11) NOT NULL,
  `Reading` tinyint(1) NOT NULL DEFAULT '0',
  `Cinema` tinyint(1) NOT NULL DEFAULT '0',
  `Shopping` tinyint(1) NOT NULL DEFAULT '0',
  `Socializing` tinyint(1) NOT NULL DEFAULT '0',
  `Travelling` tinyint(1) NOT NULL DEFAULT '0',
  `Walking` tinyint(1) NOT NULL DEFAULT '0',
  `Exercise` tinyint(1) NOT NULL DEFAULT '0',
  `Soccer` tinyint(1) NOT NULL DEFAULT '0',
  `Dancing` tinyint(1) NOT NULL DEFAULT '0',
  `Horses` tinyint(1) NOT NULL DEFAULT '0',
  `Running` tinyint(1) NOT NULL DEFAULT '0',
  `Eating_Out` tinyint(1) NOT NULL DEFAULT '0',
  `Painting` tinyint(1) NOT NULL DEFAULT '0',
  `Cooking` tinyint(1) NOT NULL DEFAULT '0',
  `Computers` tinyint(1) NOT NULL DEFAULT '0',
  `Bowling` tinyint(1) NOT NULL DEFAULT '0',
  `Writing` tinyint(1) NOT NULL DEFAULT '0',
  `Skiing` tinyint(1) NOT NULL DEFAULT '0',
  `Crafts` tinyint(1) NOT NULL DEFAULT '0',
  `Golf` tinyint(1) NOT NULL DEFAULT '0',
  `Chess` tinyint(1) NOT NULL DEFAULT '0',
  `Gymnastics` tinyint(1) NOT NULL DEFAULT '0',
  `Cycling` tinyint(1) NOT NULL DEFAULT '0',
  `Swimming` tinyint(1) NOT NULL DEFAULT '0',
  `Surfing` tinyint(1) NOT NULL DEFAULT '0',
  `Hiking` tinyint(1) NOT NULL DEFAULT '0',
  `Video_Games` tinyint(1) NOT NULL DEFAULT '0',
  `Volleyball` tinyint(1) NOT NULL DEFAULT '0',
  `Badminton` tinyint(1) NOT NULL DEFAULT '0',
  `Gym` tinyint(1) NOT NULL DEFAULT '0',
  `Parkour` tinyint(1) NOT NULL DEFAULT '0',
  `Fashion` tinyint(1) NOT NULL DEFAULT '0',
  `Yoga` tinyint(1) NOT NULL DEFAULT '0',
  `Basketball` tinyint(1) NOT NULL DEFAULT '0',
  `Boxing` tinyint(1) DEFAULT '0',
  `Unique_Hobbie` varchar(256) DEFAULT NULL,
  KEY `User_id` (`User_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `Image_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `URL` varchar(256) NOT NULL,
  PRIMARY KEY (`Image_id`),
  KEY `User_id` (`User_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `Message_id` int(11) NOT NULL AUTO_INCREMENT,
  `Sender_id` int(11) NOT NULL,
  `Recipient_id` int(11) NOT NULL,
  `Date_Received` datetime NOT NULL,
  `Message_Text` text NOT NULL,
  `Profile_Visable` tinyint(1) NOT NULL,
  PRIMARY KEY (`Message_id`),
  KEY `Sender_id` (`Sender_id`),
  KEY `Recipient_id` (`Recipient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `preference_details`
--

DROP TABLE IF EXISTS `preference_details`;
CREATE TABLE IF NOT EXISTS `preference_details` (
  `User_id` int(11) NOT NULL,
  `Tag_Line` varchar(256) DEFAULT NULL,
  `City` varchar(64) DEFAULT NULL,
  `Gender` varchar(16) DEFAULT NULL,
  `Seeking` varchar(16) DEFAULT NULL,
  `Intent` varchar(32) DEFAULT NULL,
  `Date_Of_Birth` date DEFAULT NULL,
  `Height` varchar(16) DEFAULT NULL,
  `Ethnicity` varchar(64) DEFAULT NULL,
  `Body_Type` varchar(64) DEFAULT NULL,
  `Religion` varchar(64) DEFAULT NULL,
  `Marital_Status` varchar(32) DEFAULT NULL,
  `Income` varchar(32) DEFAULT NULL,
  `Has_Children` tinyint(1) DEFAULT NULL,
  `Wants_Children` varchar(16) DEFAULT NULL,
  `Smoker` tinyint(1) DEFAULT NULL,
  `Drinker` varchar(32) DEFAULT NULL,
  `About_Me` text,
  KEY `User_id` (`User_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registration_details`
--

DROP TABLE IF EXISTS `registration_details`;
CREATE TABLE IF NOT EXISTS `registration_details` (
  `User_id` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(32) NOT NULL,
  `First_Name` varchar(32) NOT NULL,
  `Last_Name` varchar(32) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `Email` varchar(128) NOT NULL,
  PRIMARY KEY (`User_id`),
  UNIQUE KEY `Username` (`Username`,`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_details`
--
ALTER TABLE `account_details`
  ADD CONSTRAINT `account_details_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `registration_details` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `banned_reports`
--
ALTER TABLE `banned_reports`
  ADD CONSTRAINT `banned_reports_ibfk_1` FOREIGN KEY (`Reporter_id`) REFERENCES `registration_details` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `banned_reports_ibfk_2` FOREIGN KEY (`Reportee_id`) REFERENCES `registration_details` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hobbies`
--
ALTER TABLE `hobbies`
  ADD CONSTRAINT `hobbies_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `registration_details` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `registration_details` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`Sender_id`) REFERENCES `registration_details` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`Recipient_id`) REFERENCES `registration_details` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `preference_details`
--
ALTER TABLE `preference_details`
  ADD CONSTRAINT `preference_details_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `registration_details` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

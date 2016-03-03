-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2016 at 08:41 PM
-- Server version: 5.7.9
-- PHP Version: 7.0.0

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
  `Premium` tinyint(1) NOT NULL,
  `Free_Trail_Used` tinyint(1) NOT NULL,
  `Account_Expiry` date NOT NULL,
  `P_Code` varchar(64) NOT NULL,
  PRIMARY KEY (`User_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`Admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`Report_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `banned_users`
--

DROP TABLE IF EXISTS `banned_users`;
CREATE TABLE IF NOT EXISTS `banned_users` (
  `User_id` int(11) NOT NULL,
  `Report_id` int(11) NOT NULL,
  `Start_Date` date NOT NULL,
  `End_Date` date NOT NULL,
  PRIMARY KEY (`User_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hobbies`
--

DROP TABLE IF EXISTS `hobbies`;
CREATE TABLE IF NOT EXISTS `hobbies` (
  `User_id` int(11) NOT NULL,
  `Reading` tinyint(1) NOT NULL,
  `Cinema` tinyint(1) NOT NULL,
  `Shopping` tinyint(1) NOT NULL,
  `Socializing` tinyint(1) NOT NULL,
  `Travelling` tinyint(1) NOT NULL,
  `Walking` tinyint(1) NOT NULL,
  `Exercise` tinyint(1) NOT NULL,
  `Soccer` tinyint(1) NOT NULL,
  `Dancing` tinyint(1) NOT NULL,
  `Horses` tinyint(1) NOT NULL,
  `Running` tinyint(1) NOT NULL,
  `Eating_Out` tinyint(1) NOT NULL,
  `Painting` tinyint(1) NOT NULL,
  `Cooking` tinyint(1) NOT NULL,
  `Computers` tinyint(1) NOT NULL,
  `Bowling` tinyint(1) NOT NULL,
  `Writing` tinyint(1) NOT NULL,
  `Skiing` tinyint(1) NOT NULL,
  `Crafts` tinyint(1) NOT NULL,
  `Golf` tinyint(1) NOT NULL,
  `Chess` tinyint(1) NOT NULL,
  `Gymnastics` tinyint(1) NOT NULL,
  `Cycling` tinyint(1) NOT NULL,
  `Swimming` tinyint(1) NOT NULL,
  `Surfing` tinyint(1) NOT NULL,
  `Hiking` tinyint(1) NOT NULL,
  `Video_Games` tinyint(1) NOT NULL,
  `Volleyball` tinyint(1) NOT NULL,
  `Badminton` tinyint(1) NOT NULL,
  `Gym` tinyint(1) NOT NULL,
  `Parkour` tinyint(1) NOT NULL,
  `Fashion` tinyint(1) NOT NULL,
  `Yoga` tinyint(1) NOT NULL,
  `Basketball` tinyint(1) NOT NULL,
  `Boxing` tinyint(1) NOT NULL,
  `Unique_Hobbie` varchar(256) NOT NULL,
  PRIMARY KEY (`User_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `User_id` int(11) NOT NULL,
  `Image_id` int(11) NOT NULL,
  `URL` varchar(256) NOT NULL,
  PRIMARY KEY (`User_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`Message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `preference_details`
--

DROP TABLE IF EXISTS `preference_details`;
CREATE TABLE IF NOT EXISTS `preference_details` (
  `User_id` int(11) NOT NULL,
  `Tag_Line` varchar(256) NOT NULL,
  `City` varchar(64) NOT NULL,
  `Gender` varchar(16) NOT NULL,
  `Seeking` varchar(16) NOT NULL,
  `Intent` varchar(32) NOT NULL,
  `Date_Of_Birth` date NOT NULL,
  `Height` int(11) NOT NULL,
  `Ethnicity` varchar(64) NOT NULL,
  `Body_Type` varchar(64) NOT NULL,
  `Religion` varchar(64) NOT NULL,
  `Marital_Status` varchar(32) NOT NULL,
  `Income` int(11) NOT NULL,
  `Has_Children` tinyint(1) NOT NULL,
  `Wants_Children` tinyint(1) NOT NULL,
  `Smoker` tinyint(1) NOT NULL,
  `Drinker` tinyint(1) NOT NULL,
  `About_Me` text NOT NULL,
  PRIMARY KEY (`User_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`User_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

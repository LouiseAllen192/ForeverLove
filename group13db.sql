-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2016 at 01:09 PM
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
  `user_id` int(11) NOT NULL,
  `account_type` varchar(64) DEFAULT NULL,
  `account_expired` date DEFAULT NULL,
  KEY `User_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_details`
--

INSERT INTO `account_details` (`user_id`, `account_type`, `account_expired`) VALUES
(1, 'Premium', '2016-09-26'),
(2, 'Premium', '2017-03-04'),
(3, 'Premium', '2016-10-02'),
(4, 'Premium', '2016-06-26'),
(5, 'Premium', '2016-06-26'),
(6, 'Free', '2016-05-02'),
(7, 'Free', '2016-05-02'),
(8, 'Premium', '2016-07-02'),
(9, 'Premium', '2016-10-02'),
(10, 'Free', '2016-05-02'),
(11, 'Premium', '2016-10-03'),
(12, 'Premium', '2016-10-03'),
(13, 'Free', '2016-05-04'),
(14, 'Premium', '2016-07-11'),
(15, 'Free', '2016-05-11'),
(16, 'Free', '2016-05-11'),
(17, 'Free', '2016-05-11'),
(18, 'Free', '2016-05-11'),
(19, 'Free', '2016-05-11'),
(20, 'Free', '2016-05-11'),
(21, 'Free', '2016-05-11'),
(22, 'Free', '2016-05-11'),
(23, 'Free', '2016-05-11'),
(24, 'Free', '2016-05-11'),
(25, 'Premium', '2016-07-11');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `password` char(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `Email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `first_name`, `last_name`, `password`, `email`) VALUES
(1, 'Kevin', 'O''Brien', '$2y$10$s5c2pSVqAxZirU8m3OWJneRJ2Qep3w6GSx4oOoHxEoAi2IVzxFdQW', 'kfcobrien@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `banned_reports`
--

DROP TABLE IF EXISTS `banned_reports`;
CREATE TABLE IF NOT EXISTS `banned_reports` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `reporter_id` int(11) NOT NULL,
  `reportee_id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL DEFAULT '0',
  `priority` int(11) NOT NULL DEFAULT '1',
  `content` text NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `view_conversation` tinyint(1) NOT NULL DEFAULT '0',
  `resolved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`report_id`),
  KEY `Reporter_id` (`reporter_id`),
  KEY `Reportee_id` (`reportee_id`),
  KEY `priority` (`priority`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banned_reports`
--

INSERT INTO `banned_reports` (`report_id`, `reporter_id`, `reportee_id`, `conversation_id`, `priority`, `content`, `date_time`, `view_conversation`, `resolved`) VALUES
(1, 9, 5, 0, 4, 'Nude material', '2016-04-04 14:37:46', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `banned_users`
--

DROP TABLE IF EXISTS `banned_users`;
CREATE TABLE IF NOT EXISTS `banned_users` (
  `user_id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL DEFAULT '0',
  `start_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` datetime NOT NULL,
  `permanent` tinyint(1) NOT NULL DEFAULT '0',
  KEY `User_id` (`user_id`),
  KEY `Report_id` (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banned_users`
--

INSERT INTO `banned_users` (`user_id`, `report_id`, `start_date`, `end_date`, `permanent`) VALUES
(2, 0, '2016-04-02 17:35:01', '2016-04-09 16:35:01', 0),
(1, 0, '2016-04-02 17:35:45', '2016-04-02 16:35:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ban_length`
--

DROP TABLE IF EXISTS `ban_length`;
CREATE TABLE IF NOT EXISTS `ban_length` (
  `id` int(11) NOT NULL,
  `choice` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ban_length`
--

INSERT INTO `ban_length` (`id`, `choice`) VALUES
(1, '7 Days'),
(2, '14 Days'),
(3, '30 Days'),
(4, '60 Days'),
(5, '120 Days'),
(6, 'Permanent');

-- --------------------------------------------------------

--
-- Table structure for table `blind_date`
--

DROP TABLE IF EXISTS `blind_date`;
CREATE TABLE IF NOT EXISTS `blind_date` (
  `user_id` int(11) DEFAULT NULL,
  `seeking` int(11) DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blind_date`
--

INSERT INTO `blind_date` (`user_id`, `seeking`, `gender`) VALUES
(6, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `body_type`
--

DROP TABLE IF EXISTS `body_type`;
CREATE TABLE IF NOT EXISTS `body_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `choice` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `body_type`
--

INSERT INTO `body_type` (`id`, `choice`) VALUES
(1, 'Unselected'),
(2, 'I''d rather not say'),
(3, 'Thin'),
(4, 'Overweight'),
(5, 'Skinny'),
(6, 'Average'),
(7, 'Fit'),
(8, 'Athletic'),
(9, 'Jacked'),
(10, 'A little extra'),
(11, 'Curvy'),
(12, 'Full figured'),
(13, 'Slim');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
CREATE TABLE IF NOT EXISTS `conversations` (
  `conversation_id` int(11) NOT NULL AUTO_INCREMENT,
  `user1_id` int(11) NOT NULL,
  `user2_id` int(11) NOT NULL,
  `profile_visible` tinyint(4) DEFAULT NULL,
  `reveal` int(11) DEFAULT NULL,
  PRIMARY KEY (`conversation_id`),
  KEY `User1_id` (`user1_id`),
  KEY `User2_id` (`user2_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`conversation_id`, `user1_id`, `user2_id`, `profile_visible`, `reveal`) VALUES
(11, 1, 3, 1, NULL),
(12, 3, 3, 1, NULL),
(16, 1, 1, 1, NULL),
(17, 1, 4, 1, NULL),
(18, 11, 12, 1, NULL),
(19, 6, 3, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `drinker`
--

DROP TABLE IF EXISTS `drinker`;
CREATE TABLE IF NOT EXISTS `drinker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `choice` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drinker`
--

INSERT INTO `drinker` (`id`, `choice`) VALUES
(1, 'Unselected'),
(2, 'Social Drinker'),
(3, 'Occasional Drinker'),
(4, 'Regular Drinker'),
(5, 'Doesn''t drink');

-- --------------------------------------------------------

--
-- Table structure for table `ethnicity`
--

DROP TABLE IF EXISTS `ethnicity`;
CREATE TABLE IF NOT EXISTS `ethnicity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `choice` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ethnicity`
--

INSERT INTO `ethnicity` (`id`, `choice`) VALUES
(1, 'Unselected'),
(2, 'White Irish'),
(3, 'White Traveller Irish'),
(4, 'Other White'),
(5, 'Asian'),
(6, 'Black'),
(7, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

DROP TABLE IF EXISTS `gender`;
CREATE TABLE IF NOT EXISTS `gender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `choice` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `choice`) VALUES
(1, 'Unselected'),
(2, 'Male'),
(3, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `has_children`
--

DROP TABLE IF EXISTS `has_children`;
CREATE TABLE IF NOT EXISTS `has_children` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `choice` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `has_children`
--

INSERT INTO `has_children` (`id`, `choice`) VALUES
(1, 'Unselected'),
(2, 'Yes'),
(3, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `height`
--

DROP TABLE IF EXISTS `height`;
CREATE TABLE IF NOT EXISTS `height` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `choice` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `height`
--

INSERT INTO `height` (`id`, `choice`) VALUES
(1, 'Unselected'),
(2, 'Less than 130cm'),
(3, '130-140cm'),
(4, '140-150cm'),
(5, '150-160cm'),
(6, '160-170cm'),
(7, 'More than 170cm');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `user_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `image_path` varchar(256) DEFAULT NULL,
  `image_name` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`image_id`),
  KEY `User_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`user_id`, `image_id`, `image_path`, `image_name`) VALUES
(1, 1, 'userImageUploads/user1/lily1.jpg', 'lily1.jpg'),
(1, 2, 'userImageUploads/user1/lily2.jpg', 'lily2.jpg'),
(1, 3, '', ''),
(1, 4, 'userImageUploads/user1/lily3.jpg', 'lily3.jpg'),
(1, 5, 'userImageUploads/user1/lily4.jpg', 'lily4.jpg'),
(1, 6, '', ''),
(1, 7, '', ''),
(1, 8, '', ''),
(1, 9, 'userImageUploads/user1/lily5.jpg', 'lily5.jpg'),
(1, 10, 'userImageUploads/user1/lily6.jpg', 'lily6.jpg'),
(1, 11, 'userImageUploads/user1/lily7.jpg', 'lily7.jpg'),
(1, 12, 'userImageUploads/user1/lily8.jpg', 'lily8.jpg'),
(1, 13, '', ''),
(1, 14, 'userImageUploads/user1/lily9.jpg', 'lily9.jpg'),
(1, 15, '', ''),
(1, 16, '', ''),
(2, 1, 'userImageUploads/user2/fred1.jpg', 'fred1.jpg'),
(2, 2, '', ''),
(2, 3, '', ''),
(2, 4, 'userImageUploads/user2/fred2.jpg', 'fred2.jpg'),
(2, 5, 'userImageUploads/user2/fred3.jpg', 'fred3.jpg'),
(2, 6, 'userImageUploads/user2/fred4.jpg', 'fred4.jpg'),
(2, 7, 'userImageUploads/user2/fred5.jpg', 'fred5.jpg'),
(2, 8, '', ''),
(2, 9, '', ''),
(2, 10, '', ''),
(2, 11, '', ''),
(2, 12, '', ''),
(2, 13, '', ''),
(2, 14, '', ''),
(2, 15, '', ''),
(2, 16, '', ''),
(3, 1, 'userImageUploads/user3/jar1.jpg', 'jar1.jpg'),
(3, 2, 'userImageUploads/user3/jar2.jpg', 'jar2.jpg'),
(3, 3, 'userImageUploads/user3/jar3.jpg', 'jar3.jpg'),
(3, 4, 'userImageUploads/user3/jar4.jpg', 'jar4.jpg'),
(3, 5, 'userImageUploads/user3/jar5.jpg', 'jar5.jpg'),
(3, 6, '', ''),
(3, 7, '', ''),
(3, 8, '', ''),
(3, 9, '', ''),
(3, 10, '', ''),
(3, 11, '', ''),
(3, 12, '', ''),
(3, 13, '', ''),
(3, 14, '', ''),
(3, 15, '', ''),
(3, 16, '', ''),
(4, 1, 'userImageUploads/user4/rob1.jpg', 'rob1.jpg'),
(4, 2, 'userImageUploads/user4/rob2.jpg', 'rob2.jpg'),
(4, 3, 'userImageUploads/user4/rob3.jpg', 'rob3.jpg'),
(4, 4, 'userImageUploads/user4/rob4.jpg', 'rob4.jpg'),
(4, 5, '', ''),
(4, 6, '', ''),
(4, 7, '', ''),
(4, 8, '', ''),
(4, 9, '', ''),
(4, 10, '', ''),
(4, 11, '', ''),
(4, 12, '', ''),
(4, 13, '', ''),
(4, 14, '', ''),
(4, 15, '', ''),
(4, 16, '', ''),
(5, 1, 'userImageUploads/user5/lou1.jpg', 'lou1.jpg'),
(5, 2, '', ''),
(5, 3, 'userImageUploads/user5/lou2.jpg', 'lou2.jpg'),
(5, 4, '', ''),
(5, 5, '', ''),
(5, 6, 'userImageUploads/user5/lou3.jpg', 'lou3.jpg'),
(5, 7, 'userImageUploads/user5/lou4.jpg', 'lou4.jpg'),
(5, 8, '', ''),
(5, 9, '', ''),
(5, 10, '', ''),
(5, 11, '', ''),
(5, 12, '', ''),
(5, 13, '', ''),
(5, 14, '', ''),
(5, 15, '', ''),
(5, 16, '', ''),
(6, 1, 'userImageUploads/user6/bey1.jpg', 'bey1.jpg'),
(6, 2, 'userImageUploads/user6/bey2.jpg', 'bey2.jpg'),
(6, 3, 'userImageUploads/user6/bey3.jpg', 'bey3.jpg'),
(6, 4, 'userImageUploads/user6/bey4.jpg', 'bey4.jpg'),
(6, 5, 'userImageUploads/user6/bey5.jpg', 'bey5.jpg'),
(6, 6, 'userImageUploads/user6/bey6.jpg', 'bey6.jpg'),
(6, 7, '', ''),
(6, 8, '', ''),
(6, 9, '', ''),
(6, 10, '', ''),
(6, 11, '', ''),
(6, 12, '', ''),
(6, 13, '', ''),
(6, 14, '', ''),
(6, 15, '', ''),
(6, 16, '', ''),
(7, 1, 'userImageUploads/user7/john1.jpg', 'john1.jpg'),
(7, 2, 'userImageUploads/user7/john2.jpg', 'john2.jpg'),
(7, 3, 'userImageUploads/user7/john3.jpg', 'john3.jpg'),
(7, 4, '', ''),
(7, 5, '', ''),
(7, 6, '', ''),
(7, 7, '', ''),
(7, 8, '', ''),
(7, 9, '', ''),
(7, 10, '', ''),
(7, 11, '', ''),
(7, 12, '', ''),
(7, 13, '', ''),
(7, 14, '', ''),
(7, 15, '', ''),
(7, 16, '', ''),
(8, 1, 'userImageUploads/user8/min1.png', 'min1.png'),
(8, 2, 'userImageUploads/user8/min2.jpg', 'min2.jpg'),
(8, 3, 'userImageUploads/user8/min3.gif', 'min3.gif'),
(8, 4, '', ''),
(8, 5, '', ''),
(8, 6, '', ''),
(8, 7, '', ''),
(8, 8, '', ''),
(8, 9, '', ''),
(8, 10, '', ''),
(8, 11, '', ''),
(8, 12, '', ''),
(8, 13, '', ''),
(8, 14, '', ''),
(8, 15, '', ''),
(8, 16, '', ''),
(9, 1, 'userImageUploads/user9/jz1.jpg', 'jz1.jpg'),
(9, 2, 'userImageUploads/user9/jz2.jpg', 'jz2.jpg'),
(9, 3, 'userImageUploads/user9/jz3.jpg', 'jz3.jpg'),
(9, 4, 'userImageUploads/user9/jz4.jpg', 'jz4.jpg'),
(9, 5, 'userImageUploads/user9/jz5.jpg', 'jz5.jpg'),
(9, 6, '', ''),
(9, 7, '', ''),
(9, 8, '', ''),
(9, 9, '', ''),
(9, 10, '', ''),
(9, 11, '', ''),
(9, 12, '', ''),
(9, 13, '', ''),
(9, 14, '', ''),
(9, 15, '', ''),
(9, 16, '', ''),
(10, 1, 'userImageUploads/user10/har1.jpg', 'har1.jpg'),
(10, 2, 'userImageUploads/user10/har2.jpg', 'har2.jpg'),
(10, 3, 'userImageUploads/user10/har3.jpg', 'har3.jpg'),
(10, 4, '', ''),
(10, 5, 'userImageUploads/user10/har4.jpg', 'har4.jpg'),
(10, 6, '', ''),
(10, 7, 'userImageUploads/user10/har5.jpg', 'har5.jpg'),
(10, 8, '', ''),
(10, 9, '', ''),
(10, 10, '', ''),
(10, 11, '', ''),
(10, 12, '', ''),
(10, 13, '', ''),
(10, 14, '', ''),
(10, 15, '', ''),
(10, 16, '', ''),
(11, 1, 'userImageUploads/user11/sar1.jpg', 'sar1.jpg'),
(11, 2, 'userImageUploads/user11/sar2.jpg', 'sar2.jpg'),
(11, 3, 'userImageUploads/user11/sar3.jpg', 'sar3.jpg'),
(11, 4, '', ''),
(11, 5, '', ''),
(11, 6, '', ''),
(11, 7, '', ''),
(11, 8, '', ''),
(11, 9, '', ''),
(11, 10, '', ''),
(11, 11, '', ''),
(11, 12, '', ''),
(11, 13, '', ''),
(11, 14, '', ''),
(11, 15, '', ''),
(11, 16, '', ''),
(12, 1, 'userImageUploads/user12/pat1.jpg', 'pat1.jpg'),
(12, 2, 'userImageUploads/user12/pat2.png', 'pat2.png'),
(12, 3, 'userImageUploads/user12/pat3.jpg', 'pat3.jpg'),
(12, 4, '', ''),
(12, 5, '', ''),
(12, 6, '', ''),
(12, 7, '', ''),
(12, 8, '', ''),
(12, 9, '', ''),
(12, 10, '', ''),
(12, 11, '', ''),
(12, 12, '', ''),
(12, 13, '', ''),
(12, 14, '', ''),
(12, 15, '', ''),
(12, 16, '', ''),
(13, 1, 'userImageUploads/user13/rus1.jpg', 'rus1.jpg'),
(13, 2, 'userImageUploads/user13/rus2.jpg', 'rus2.jpg'),
(13, 3, 'userImageUploads/user13/rus3.jpeg', 'rus3.jpeg'),
(13, 4, '', ''),
(13, 5, '', ''),
(13, 6, '', ''),
(13, 7, '', ''),
(13, 8, '', ''),
(13, 9, '', ''),
(13, 10, '', ''),
(13, 11, '', ''),
(13, 12, '', ''),
(13, 13, '', ''),
(13, 14, '', ''),
(13, 15, '', ''),
(13, 16, '', ''),
(14, 1, 'userImageUploads/user14/win1.jpg', 'win1.jpg'),
(14, 2, 'userImageUploads/user14/win2.jpg', 'win2.jpg'),
(14, 3, '', ''),
(14, 4, '', ''),
(14, 5, '', ''),
(14, 6, '', ''),
(14, 7, '', ''),
(14, 8, '', ''),
(14, 9, '', ''),
(14, 10, '', ''),
(14, 11, '', ''),
(14, 12, '', ''),
(14, 13, '', ''),
(14, 14, '', ''),
(14, 15, '', ''),
(14, 16, '', ''),
(15, 1, 'userImageUploads/user15/rac1.png', 'rac1.png'),
(15, 2, 'userImageUploads/user15/rac2.jpg', 'rac2.jpg'),
(15, 3, 'userImageUploads/user15/rac3.jpeg', 'rac3.jpeg'),
(15, 4, 'userImageUploads/user15/rac4.jpg', 'rac4.jpg'),
(15, 5, '', ''),
(15, 6, '', ''),
(15, 7, '', ''),
(15, 8, '', ''),
(15, 9, '', ''),
(15, 10, '', ''),
(15, 11, '', ''),
(15, 12, '', ''),
(15, 13, '', ''),
(15, 14, '', ''),
(15, 15, '', ''),
(15, 16, '', ''),
(16, 1, 'userImageUploads/user16/ross1.jpg', 'ross1.jpg'),
(16, 2, 'userImageUploads/user16/ross2.jpg', 'ross2.jpg'),
(16, 3, 'userImageUploads/user16/ross4.jpg', 'ross3.jpg'),
(16, 4, '', ''),
(16, 5, '', ''),
(16, 6, '', ''),
(16, 7, '', ''),
(16, 8, '', ''),
(16, 9, '', ''),
(16, 10, '', ''),
(16, 11, '', ''),
(16, 12, '', ''),
(16, 13, '', ''),
(16, 14, '', ''),
(16, 15, '', ''),
(16, 16, '', ''),
(17, 1, 'userImageUploads/user17/em1.jpg', 'em1.jpg'),
(17, 2, 'userImageUploads/user17/em2.jpg', 'em2.jpg'),
(17, 3, 'userImageUploads/user17/em3.jpg', 'em3.jpg'),
(17, 4, 'userImageUploads/user17/em4.jpg', 'em4.jpg'),
(17, 5, 'userImageUploads/user17/em5.jpg', 'em5.jpg'),
(17, 6, '', ''),
(17, 7, '', ''),
(17, 8, '', ''),
(17, 9, '', ''),
(17, 10, '', ''),
(17, 11, '', ''),
(17, 12, '', ''),
(17, 13, '', ''),
(17, 14, '', ''),
(17, 15, '', ''),
(17, 16, '', ''),
(18, 1, 'userImageUploads/user18/mar1.jpg', 'mar1.jpg'),
(18, 2, 'userImageUploads/user18/mar2.jpg', 'mar2.jpg'),
(18, 3, '', ''),
(18, 4, '', ''),
(18, 5, '', ''),
(18, 6, '', ''),
(18, 7, '', ''),
(18, 8, '', ''),
(18, 9, '', ''),
(18, 10, '', ''),
(18, 11, '', ''),
(18, 12, '', ''),
(18, 13, '', ''),
(18, 14, '', ''),
(18, 15, '', ''),
(18, 16, '', ''),
(19, 1, 'userImageUploads/user19/miley1.jpg', 'miley1.jpg'),
(19, 2, 'userImageUploads/user19/miley2.jpg', 'miley2.jpg'),
(19, 3, 'userImageUploads/user19/miley3.jpg', 'miley3.jpg'),
(19, 4, 'userImageUploads/user19/miley4.jpg', 'miley4.jpg'),
(19, 5, 'userImageUploads/user19/miley5.jpg', 'miley5.jpg'),
(19, 6, '', ''),
(19, 7, '', ''),
(19, 8, '', ''),
(19, 9, '', ''),
(19, 10, '', ''),
(19, 11, '', ''),
(19, 12, '', ''),
(19, 13, '', ''),
(19, 14, '', ''),
(19, 15, '', ''),
(19, 16, '', ''),
(20, 1, 'userImageUploads/user20/jlo1.jpg', 'jlo1.jpg'),
(20, 2, 'userImageUploads/user20/jlo2.jpg', 'jlo2.jpg'),
(20, 3, 'userImageUploads/user20/jlo3.jpg', 'jlo3.jpg'),
(20, 4, 'userImageUploads/user20/jlo4.jpg', 'jlo4.jpg'),
(20, 5, 'userImageUploads/user20/jlo5.jpg', 'jlo5.jpg'),
(20, 6, 'userImageUploads/user20/jlo6.jpg', 'jlo6.jpg'),
(20, 7, '', ''),
(20, 8, '', ''),
(20, 9, '', ''),
(20, 10, '', ''),
(20, 11, '', ''),
(20, 12, '', ''),
(20, 13, '', ''),
(20, 14, '', ''),
(20, 15, '', ''),
(20, 16, '', ''),
(21, 1, 'userImageUploads/user21/elton1.jpg', 'elton1.jpg'),
(21, 2, 'userImageUploads/user21/elton2.jpg', 'elton2.jpg'),
(21, 3, 'userImageUploads/user21/elton3.jpg', 'elton3.jpg'),
(21, 4, 'userImageUploads/user21/elton4.jpg', 'elton4.jpg'),
(21, 5, '', ''),
(21, 6, '', ''),
(21, 7, '', ''),
(21, 8, '', ''),
(21, 9, '', ''),
(21, 10, '', ''),
(21, 11, '', ''),
(21, 12, '', ''),
(21, 13, '', ''),
(21, 14, '', ''),
(21, 15, '', ''),
(21, 16, '', ''),
(22, 1, 'userImageUploads/user22/linda1.jpg', 'linda1.jpg'),
(22, 2, 'userImageUploads/user22/linda2.jpg', 'linda2.jpg'),
(22, 3, '', ''),
(22, 4, '', ''),
(22, 5, '', ''),
(22, 6, '', ''),
(22, 7, '', ''),
(22, 8, '', ''),
(22, 9, '', ''),
(22, 10, '', ''),
(22, 11, '', ''),
(22, 12, '', ''),
(22, 13, '', ''),
(22, 14, '', ''),
(22, 15, '', ''),
(22, 16, '', ''),
(23, 1, 'userImageUploads/user23/rita1.jpg', 'rita1.jpg'),
(23, 2, 'userImageUploads/user23/rita2.jpg', 'rita2.jpg'),
(23, 3, 'userImageUploads/user23/rita3.jpg', 'rita3.jpg'),
(23, 4, 'userImageUploads/user23/rita4.jpg', 'rita4.jpg'),
(23, 5, 'userImageUploads/user23/rita5.jpg', 'rita5.jpg'),
(23, 6, '', ''),
(23, 7, '', ''),
(23, 8, '', ''),
(23, 9, '', ''),
(23, 10, '', ''),
(23, 11, '', ''),
(23, 12, '', ''),
(23, 13, '', ''),
(23, 14, '', ''),
(23, 15, '', ''),
(23, 16, '', ''),
(24, 1, 'userImageUploads/user24/phoebe1.jpg', 'phoebe1.jpg'),
(24, 2, 'userImageUploads/user24/phoebe2.jpg', 'phoebe2.jpg'),
(24, 3, 'userImageUploads/user24/phoebe3.jpg', 'phoebe3.jpg'),
(24, 4, 'userImageUploads/user24/phoebe4.jpg', 'phoebe4.jpg'),
(24, 5, 'userImageUploads/user24/phoebe5.jpg', 'phoebe5.jpg'),
(24, 6, '', ''),
(24, 7, '', ''),
(24, 8, '', ''),
(24, 9, '', ''),
(24, 10, '', ''),
(24, 11, '', ''),
(24, 12, '', ''),
(24, 13, '', ''),
(24, 14, '', ''),
(24, 15, '', ''),
(24, 16, '', ''),
(25, 1, 'userImageUploads/user25/french-man.jpg', 'french-man.jpg'),
(25, 2, 'userImageUploads/user25/frenchy1.jpg', 'frenchy1.jpg'),
(25, 3, 'userImageUploads/user25/frenchy2.jpg', 'frenchy2.jpg'),
(25, 4, 'userImageUploads/user25/frenchy3.jpg', 'frenchy3.jpg'),
(25, 5, '', ''),
(25, 6, '', ''),
(25, 7, '', ''),
(25, 8, '', ''),
(25, 9, '', ''),
(25, 10, '', ''),
(25, 11, '', ''),
(25, 12, '', ''),
(25, 13, '', ''),
(25, 14, '', ''),
(25, 15, '', ''),
(25, 16, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

DROP TABLE IF EXISTS `income`;
CREATE TABLE IF NOT EXISTS `income` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `choice` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `choice`) VALUES
(1, 'Unselected'),
(2, 'I''d rather not say'),
(3, 'Unemployed'),
(4, 'Less then 10k per year'),
(5, '10k to 20k per year'),
(6, '20k to 40k per year'),
(7, '40k to 60k per year'),
(8, '60k to 80k per year'),
(9, '80k to 100k per year'),
(10, '100k to 120k per year'),
(11, 'More than 120k per year');

-- --------------------------------------------------------

--
-- Table structure for table `intent`
--

DROP TABLE IF EXISTS `intent`;
CREATE TABLE IF NOT EXISTS `intent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `choice` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `intent`
--

INSERT INTO `intent` (`id`, `choice`) VALUES
(1, 'Unselected'),
(2, 'Friendship'),
(3, 'Hook Up'),
(4, 'Casual Relationship'),
(5, 'Relationship'),
(6, 'Forever Love');

-- --------------------------------------------------------

--
-- Table structure for table `marital_status`
--

DROP TABLE IF EXISTS `marital_status`;
CREATE TABLE IF NOT EXISTS `marital_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `choice` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marital_status`
--

INSERT INTO `marital_status` (`id`, `choice`) VALUES
(1, 'Unselected'),
(2, 'Single'),
(3, 'Married'),
(4, 'Seperated'),
(5, 'Divorced'),
(6, 'Widdowed'),
(7, 'It''s Complicated'),
(8, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `conversation_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `date_received` datetime NOT NULL,
  `message_text` text NOT NULL,
  `seen` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`message_id`),
  KEY `Sender_id` (`sender_id`),
  KEY `Recipient_id` (`recipient_id`),
  KEY `Conversation_id` (`conversation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `conversation_id`, `sender_id`, `recipient_id`, `date_received`, `message_text`, `seen`) VALUES
(4, 11, 1, 3, '2016-03-22 19:28:48', 'ha', 1),
(5, 11, 1, 3, '2016-03-22 19:32:05', 'Hey x', 1),
(6, 11, 3, 1, '2016-03-22 19:37:16', 'pop', 1),
(7, 11, 1, 3, '2016-03-23 21:30:18', 'Well Lad', 1),
(8, 11, 1, 3, '2016-03-23 21:33:05', 'Why do they call you party boy?', 1),
(9, 11, 1, 3, '2016-03-23 21:33:59', 'Once upon a time not so long ago\n\nTommy used to work on the docks\nUnion''s been on strike\nHe''s down on his luck...\nIt''s tough, so tough\n\nGina works the diner all day\nWorking for her man,\nShe brings home her pay\nFor love, for love\n\nShe says, "We''ve gotta hold on to what we''ve got.\nIt doesn''t make a difference if we make it or not.\nWe''ve got each other and that''s a lot.\nFor love we''ll give it a shot."\n\n[Chorus:]\nWhoa, we''re half way there\nWhoa, livin'' on a prayer\nTake my hand and we''ll make it - I swear\nWhoa, livin'' on a prayer\n\nTommy''s got his six string in hock\nNow he''s holding in\nWhat he used to make it talk\nSo tough, it''s tough\n\nGina dreams of running away\nWhen she cries in the night\nTommy whispers,\n"Baby, it''s okay, someday...\n\n...We''ve gotta hold on to what we''ve got.\nIt doesn''t make a difference if we make it or not.\nWe''ve got each other and that''s a lot.\nFor love we''ll give it a shot."\n\n[Chorus]\n\nLivin'' on a prayer\n\nWe''ve gotta hold on ready or not\nYou live for the fight when it''s all that you''ve got\n', 1),
(10, 11, 1, 3, '2016-03-23 21:37:47', 'Once upon a time not so long ago\r\n\r\nTommy used to work on the docks\r\nUnion''s been on strike\r\nHe''s down on his luck...\r\nIt''s tough, so tough\r\n\r\nGina works the diner all day\r\nWorking for her man,\r\nShe brings home her pay\r\nFor love, for love\r\n\r\nShe says, "We''ve gotta hold on to what we''ve got.\r\nIt doesn''t make a difference if we make it or not.\r\nWe''ve got each other and that''s a lot.\r\nFor love we''ll give it a shot."\r\n\r\n[Chorus:]\r\nWhoa, we''re half way there\r\nWhoa, livin'' on a prayer\r\nTake my hand and we''ll make it - I swear\r\nWhoa, livin'' on a prayer\r\n\r\nTommy''s got his six string in hock\r\nNow he''s holding in\r\nWhat he used to make it talk\r\nSo tough, it''s tough\r\n\r\nGina dreams of running away\r\nWhen she cries in the night\r\nTommy whispers,\r\n"Baby, it''s okay, someday...\r\n\r\n...We''ve gotta hold on to what we''ve got.\r\nIt doesn''t make a difference if we make it or not.\r\nWe''ve got each other and that''s a lot.\r\nFor love we''ll give it a shot."\r\n\r\n[Chorus]\r\n\r\nLivin'' on a prayer\r\n\r\nWe''ve gotta hold on ready or not\r\nYou live for the fight when it''s all that you''ve got\r\n', 1),
(11, 11, 1, 3, '2016-03-23 21:37:52', 'Once upon a time not so long ago\r\n\r\nTommy used to work on the docks\r\nUnion''s been on strike\r\nHe''s down on his luck...\r\nIt''s tough, so tough\r\n\r\nGina works the diner all day\r\nWorking for her man,\r\nShe brings home her pay\r\nFor love, for love\r\n\r\nShe says, "We''ve gotta hold on to what we''ve got.\r\nIt doesn''t make a difference if we make it or not.\r\nWe''ve got each other and that''s a lot.\r\nFor love we''ll give it a shot."\r\n\r\n[Chorus:]\r\nWhoa, we''re half way there\r\nWhoa, livin'' on a prayer\r\nTake my hand and we''ll make it - I swear\r\nWhoa, livin'' on a prayer\r\n\r\nTommy''s got his six string in hock\r\nNow he''s holding in\r\nWhat he used to make it talk\r\nSo tough, it''s tough\r\n\r\nGina dreams of running away\r\nWhen she cries in the night\r\nTommy whispers,\r\n"Baby, it''s okay, someday...\r\n\r\n...We''ve gotta hold on to what we''ve got.\r\nIt doesn''t make a difference if we make it or not.\r\nWe''ve got each other and that''s a lot.\r\nFor love we''ll give it a shot."\r\n\r\n[Chorus]\r\n\r\nLivin'' on a prayer\r\n\r\nWe''ve gotta hold on ready or not\r\nYou live for the fight when it''s all that you''ve got\r\n', 1),
(13, 11, 1, 3, '2016-03-23 21:38:20', 'hwy', 1),
(15, 11, 1, 3, '2016-03-23 21:40:39', 'hwy', 1),
(16, 11, 1, 3, '2016-03-23 21:57:05', '', 1),
(17, 11, 1, 3, '2016-03-24 13:38:22', 'This is cool', 1),
(18, 11, 1, 3, '2016-03-24 13:38:34', 'hEY BBY', 1),
(19, 11, 1, 3, '2016-03-24 13:46:09', 'hEY BBY', 1),
(20, 11, 1, 3, '2016-03-24 13:55:22', '', 1),
(21, 12, 3, 3, '2016-03-24 14:13:44', 'This is a party test', 1),
(22, 11, 1, 3, '2016-03-24 14:14:12', 'lol', 1),
(23, 12, 3, 3, '2016-03-24 14:21:27', 'This is not a drill.', 1),
(24, 12, 3, 3, '2016-03-24 14:21:38', 'Halo', 1),
(25, 12, 3, 3, '2016-03-24 14:31:41', 'Hey now', 1),
(26, 11, 1, 3, '2016-03-24 14:32:10', 'Hey now', 1),
(27, 11, 1, 3, '2016-03-24 15:50:20', 'Test test another test', 1),
(28, 11, 1, 3, '2016-03-24 15:52:09', 'Test test another test', 1),
(29, 11, 1, 3, '2016-03-24 16:07:47', 'Test test another test', 1),
(30, 11, 1, 3, '2016-03-24 16:08:12', 'Test test another test', 1),
(31, 11, 1, 3, '2016-03-24 19:04:20', 'Test test another test', 1),
(32, 11, 1, 3, '2016-03-24 19:04:45', 'Test test another test', 1),
(33, 11, 1, 3, '2016-03-24 19:26:11', 'hello partyhead', 1),
(34, 11, 1, 3, '2016-03-24 19:26:53', 'party', 1),
(35, 11, 1, 3, '2016-03-24 19:28:08', 'I like party boys', 1),
(36, 11, 1, 3, '2016-03-24 19:43:46', 'well', 1),
(37, 11, 1, 3, '2016-03-24 19:52:39', 'a', 1),
(38, 11, 1, 3, '2016-03-24 19:58:50', 'a', 1),
(39, 16, 1, 1, '2016-03-25 11:01:38', 'Well Girlo ;)', 1),
(40, 17, 1, 4, '2016-03-25 12:30:00', 'Well Rob', 1),
(41, 11, 1, 3, '2016-03-25 12:30:14', 'wuu2?', 1),
(42, 16, 1, 1, '2016-03-25 17:19:36', 'Send msgs yo', 1),
(43, 17, 1, 4, '2016-03-25 18:34:06', 'This conversation already exists.', 1),
(44, 16, 1, 1, '2016-03-25 18:40:04', 'This convo exists', 1),
(45, 17, 1, 4, '2016-03-25 18:40:15', 'This exists too', 1),
(46, 17, 1, 4, '2016-03-25 18:40:30', 'Get this', 1),
(47, 18, 11, 12, '2016-04-03 18:28:55', 'hey there', 1),
(48, 18, 12, 11, '2016-04-03 18:30:17', 'hey how are you', 0),
(49, 19, 6, 3, '2016-04-04 15:15:20', 'Aaa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `preference_details`
--

DROP TABLE IF EXISTS `preference_details`;
CREATE TABLE IF NOT EXISTS `preference_details` (
  `user_id` int(11) NOT NULL,
  `tag_line` varchar(256) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `seeking` int(11) DEFAULT NULL,
  `intent` int(11) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `ethnicity` int(11) DEFAULT NULL,
  `body_type` int(11) DEFAULT NULL,
  `religion` int(11) DEFAULT NULL,
  `marital_status` int(11) DEFAULT NULL,
  `income` int(11) DEFAULT NULL,
  `has_children` int(11) DEFAULT NULL,
  `wants_children` int(11) DEFAULT NULL,
  `smoker` int(11) DEFAULT NULL,
  `drinker` int(11) DEFAULT NULL,
  `about_me` text,
  KEY `User_id` (`user_id`),
  KEY `gender` (`gender`),
  KEY `seeking` (`seeking`),
  KEY `intent` (`intent`),
  KEY `height` (`height`),
  KEY `ethnicity` (`ethnicity`),
  KEY `body_type` (`body_type`),
  KEY `religion` (`religion`),
  KEY `marital_status` (`marital_status`),
  KEY `income` (`income`),
  KEY `has_children` (`has_children`),
  KEY `wants_children` (`wants_children`),
  KEY `smoker` (`smoker`),
  KEY `drinker` (`drinker`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `preference_details`
--

INSERT INTO `preference_details` (`user_id`, `tag_line`, `city`, `gender`, `seeking`, `intent`, `date_of_birth`, `height`, `ethnicity`, `body_type`, `religion`, `marital_status`, `income`, `has_children`, `wants_children`, `smoker`, `drinker`, `about_me`) VALUES
(1, 'Hup Kerry', 'Tipp', 2, 3, 3, '1991-03-03', 2, 6, 9, 6, 6, 11, 2, 2, 2, 4, 'OFFENSIVE CONTENT REMOVED BY ADMIN'),
(2, 'Hashtag farmer life', 'Sligo', 2, 3, 3, '1980-12-22', 7, 2, 11, 5, 6, 7, 2, 4, 2, 4, 'I''m really only interested in the farming life. Anything to do with farming gets my blood flowing. I love the smell of silage in the morning and grass all day.'),
(3, 'See you in Ibiza', 'Dublin', 2, 3, 3, '1996-05-19', 4, 2, 9, 2, 2, 3, 3, 3, 2, 4, 'Living for the weekend. Into fast cars and fast women. Hit me up if you like boy race cars, repetitive music and mind numbingly boring conversations'),
(4, 'I''m Rob, i''m cool', 'Limerick', 2, 2, 3, '1996-10-21', 2, 6, 6, 5, 3, 10, 2, 2, 3, 4, 'Rob Rob ... Robbedy Rob'),
(5, 'Living that life', 'Kerry', 3, 2, 2, '1991-02-19', 4, 4, 6, 3, 2, 2, 3, 2, 3, 2, 'MAking my way down town, walking fast, faces past and i''m homebound.... du du du du du du dun'),
(6, 'Who run the world', 'Texas', 3, 3, 3, '1980-04-04', 5, 4, 6, 8, 7, 9, 2, 3, 3, 5, 'I''m beyonce. You know about me'),
(7, 'John loves fun', 'Limerick', 2, 2, 2, '1980-02-02', 4, 2, 12, 5, 3, 9, 2, 3, 2, 3, 'I''m John, I''m a big fan of the craic'),
(8, 'Disneyland rules', 'Disneyworld', 3, 2, 5, '1991-03-02', 2, 7, 11, 2, 7, 5, 2, 3, 2, 4, 'I love hanging out with Daffy and Mickey and Goofy'),
(9, 'Hov in the house', 'Brooklyn', 2, 3, 2, '1970-05-04', 7, 6, 6, 4, 3, 11, 2, 2, 2, 2, 'I got 99 problems but a b***h aint one'),
(10, 'I''m a wizard', 'Diagon Alley', 2, 3, 2, '1990-04-04', 3, 4, 3, 3, 7, 2, 3, 3, 3, 3, 'My best friends are Hermoine and Ron. No muggles please. Only interested in pure bread wizards like myself'),
(11, 'boom boom shake shake the room ', 'Limerick', 3, 4, 4, '1982-01-12', 4, 4, 3, 2, 2, 2, 2, 2, 2, 2, 'im just a chilled out girl in a crazy world '),
(12, 'The milkman kid', 'craggy island', 2, 3, 3, '1942-02-27', 5, 5, 4, 7, 2, 5, 2, 3, 2, 4, 'im the best milkman on craggy island '),
(13, 'Dobflem is cool', 'Limerick', 2, 3, 3, '1996-04-07', 4, 2, 9, 3, 2, 2, 3, 2, 3, 4, 'I am dobflem'),
(14, 'Wanda in the house', 'Limerick', 3, 2, 2, '1990-01-01', 2, 6, 2, 4, 4, 9, 2, 3, 3, 3, 'Wanda is a fabulous lady'),
(15, 'Coffee and a magazine', 'New York', 3, 2, 3, '1980-01-01', 6, 4, 8, 2, 2, 5, 2, 2, 3, 2, 'Love hanging out in central perk with my friends ross, chandler, phoebe, monika and joey. We have such a fun time'),
(16, 'WE WERE ON A BREAK', 'New York', 2, 3, 3, '1980-12-12', 6, 7, 8, 2, 2, 7, 2, 3, 2, 2, 'Ross enjoys playing the bagpipes and all things dino. I am an avid reader and love long walks on the beach. Hit me up for some killer jokes and a good time'),
(17, 'Will the real slim shady please stand up', 'Detroit', 2, 3, 5, '1991-01-01', 5, 4, 7, 3, 5, 11, 2, 3, 3, 5, 'Eminem ... lyrical genius. Vomit on his sweater already, moms spagetti'),
(18, 'Diamonds are a girls best friend', 'Washington', 3, 2, 3, '1970-01-01', 2, 7, 11, 4, 2, 11, 3, 2, 2, 4, 'Miss Monroe is a star and an entertainer. I carry major star power. Message me if you can handle it'),
(19, 'Just have fun', 'Texas', 3, 2, 3, '1996-04-01', 6, 7, 5, 4, 7, 11, 3, 4, 3, 3, 'I came in like a wreeeeeeckingball. I never fell so hard before. All I wanted was to break your heart. All you ever did was, wreeeeeeck me'),
(20, 'Jenny from the block', 'New York', 3, 2, 3, '1998-02-01', 3, 7, 6, 4, 2, 2, 2, 3, 3, 2, 'Dont be fooled by the rocks that I got, im still im still Jenny from the block'),
(21, 'Like a Candle in the wind', 'Limerick', 2, 2, 6, '1970-02-01', 4, 4, 12, 2, 3, 9, 2, 2, 2, 3, 'Mega Famous, Mega Fabulous. Im an icon'),
(22, 'Lady in red', 'Tipperary', 3, 4, 2, '1990-01-01', 2, 4, 8, 4, 3, 5, 3, 3, 3, 2, 'Live for the weekend. Write me a message if you like a fun fun fun girl'),
(23, 'RIP to the girl i used to be', 'New York', 3, 2, 6, '1996-11-11', 6, 6, 11, 7, 3, 9, 2, 2, 2, 3, 'I love singing, dancing and generally being dramatic and hillarious.'),
(24, 'smelly cat', 'Dublin', 3, 4, 4, '1990-12-15', 4, 3, 4, 3, 5, 4, 2, 2, 2, 2, 'Singer songwriter with a regular gig in a local cafe. Smelly cat is my jam'),
(25, 'Cest la vie', 'Paris', 2, 2, 3, '1995-01-01', 5, 4, 3, 9, 2, 9, 2, 3, 2, 2, 'I live in the city of love but have not yet found the one. Hit me up if you think thats you and you like what you see');

-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

DROP TABLE IF EXISTS `priority`;
CREATE TABLE IF NOT EXISTS `priority` (
  `id` int(11) NOT NULL,
  `choice` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `priority`
--

INSERT INTO `priority` (`id`, `choice`) VALUES
(1, 'Unselected'),
(2, 'Minor'),
(3, 'Normal'),
(4, 'High'),
(5, 'Highest');

-- --------------------------------------------------------

--
-- Table structure for table `registration_details`
--

DROP TABLE IF EXISTS `registration_details`;
CREATE TABLE IF NOT EXISTS `registration_details` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(128) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `Username` (`username`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration_details`
--

INSERT INTO `registration_details` (`user_id`, `username`, `first_name`, `last_name`, `password`, `email`) VALUES
(1, 'lollypop23', 'Lily', 'Lovejoy', '$2y$10$rb88M78xMwqFqAdu14Ty6eDin1njl8AYJ5bcVxLmYepueofMe8h3.', 'lily@gmail.com'),
(2, 'FarmerFred', 'Fred', 'Connors', '$2y$10$RFPGADW3eJZ7Hyidy/WDVuB5GcQ0jHzEK19GFjETlkGPAmbh9WnYS', 'Freddy@yahoo.ie'),
(3, 'PartyBoy56', 'Jared', 'Armstein', '$2y$10$ZFucF0QaVJlHD2A0UJvGmeupiocW2yF7suD9GkOKvQat8TllO1i0a', 'Jarjar@gmail.com'),
(4, 'Rob', 'Rob', 'King', '$2y$10$jB8QeMTgCo.ZHotyBWpfeeSdCp6MTYI3E6hAlaW3P.3c9OVNiLbDK', 'robert.king.1996@gmail.com'),
(5, 'LouiseA192', 'Louise', 'Allen', '$2y$10$AukYF8FpjxFZ6qK.lu0U4ugCODka5x2/rxM/Qe5qKnoNlPe0X5JXO', 'louise.allen192@gmail.com'),
(6, 'beyonce4', 'Beyonce', 'Knowles', '$2y$10$pSA6VLxRakzadG9x/tHPEezNxVkULJdNPgtlcyLL8AUJv8A.CIaS6', 'beyonce@gmail.com'),
(7, 'John1', 'John', 'Doe', '$2y$10$/pNqE3mtP80vi5A0FrY57uWKMvvJ7Rlvo9/HuBePESxBDc4.ltsz6', 'bla@bla.com'),
(8, 'minnieM', 'Minnie', 'Mousekateer', '$2y$10$BRGZrNsnDwC6YD6Y4KAzMewqQu.9HzSXrjIObybt2RFZD5ghDO1be', 'minnie@disney.com'),
(9, 'JayZ12', 'Jay', 'Zee', '$2y$10$dwOyJwYz0rRpGRx3GIs0leyFDw9MsJlNI4ycuhwlDuIohWfM8SeS6', 'fun@gmail.com'),
(10, 'HarryP', 'Harry', 'Potter', '$2y$10$QRLMBlB0z/hQxAOCCqyBZO7iBwq4iFh2R4BkZV99nuV29K.4ih1qK', 'harry@hogwarts.com'),
(11, 'sarahj', 'Sarah', 'Jane', '$2y$10$BLZIYeSWRKKn/xTvwVsGauTrPDt2YELhLNuEbzEg5S0S7ZxEwYPzS', 'sarahjane@example.com'),
(12, 'patmustard', 'pat', 'mustard', '$2y$10$ksSGzExR0jF5ll68jkxnZOU59sUuLVa2o1OVzOAeqEq.577VmVd1.', 'patmustard@example.com'),
(13, 'Dobflem', 'Russell', 'Hickey', '$2y$10$R/WxFJjmsqxleTDJLOJCoOFSPBNdfjlTTXAE4E4uCIKUm9uIUd6s6', 'rhickeyjnr@gmail.com'),
(14, 'WondaW', 'Wonda', 'Wonky', '$2y$10$irY3vBDLHFOGJ4JR.AEgyuwstEJVydLaik7YNJry3coDk44v/i4W6', '14175819@studentmail.ul.ie'),
(15, 'Rachel1', 'Rachel', 'Green', '$2y$10$Nb.Yry6fbsvd8DVuq5tqfO9UmMu84dEY3QEP/t10X4tCehE.t/686', 'someone@example.ie'),
(16, 'DinoLover', 'Ross', 'Gellar', '$2y$10$Lf7JoYTNE76ZcIfp4276L.dwEUmM002qqq2s4rp7MgHsJ89tNyiCC', 'Ross@example.com'),
(17, 'slimshady', 'Marshall', 'Mathers', '$2y$10$366EWnrf.bCL70vc86Uus.sl5rzUGseU6TTFozkfdg3NAtAlt9Dv6', 'eminem@gmail.com'),
(18, 'MissMonroe', 'Marlon', 'Monroe', '$2y$10$mBWa8lo0KWPRb2.b68YtVe0waIkWe.1N0PhXST5wXhhotdv95BQrK', 'monroe@outlook.com'),
(19, 'SmileyMiley', 'Miley', 'Cyrus', '$2y$10$nPVgjNOBgrBZzZvRH02xNeNb6B7lzoYZixjhL5uDq3GVZrsv4PIf.', 'miley@gmail.com'),
(20, 'JLo', 'Jennifer', 'Lopez', '$2y$10$A.1mHxv2csfN5Z5k4O94fOBFAWLgp8jvLjLwD9K2JtoOeFRnHlEt.', 'jlo@theblock.com'),
(21, 'EltonJohn', 'Elton', 'John', '$2y$10$LDd48nQtqCYkixx2us3IjOGZkf3Mys/w/.ev1TMjxvLYTuVWtrNFa', 'elton@gmail.com'),
(22, 'LindaL', 'Linda', 'Lovely', '$2y$10$ignni8XjvAOMgJB83gH4Xu2Gjzr4iS7swxclz0nGoHj3GFtU050wm', 'Linda@yahoo.ie'),
(23, 'RitaOra', 'Rita', 'Ora', '$2y$10$Rh6ZZo/4OUVVUc8LAN8ecO2Lqo4izRvsjhPmEuViOGBYyhs93remq', 'rita@yahoo.com'),
(24, 'Phoebe12', 'Phoebe', 'Buffay', '$2y$10$kdoAt1sMT9YqctCkBcVUHuZ5IuUJroRsMKi5FRNU4ylA3fDXYZQ4G', 'phoebe@gmail.com'),
(25, 'Frency', 'Francis', 'LaFouf', '$2y$10$G8Avykp4NXvqya1u7oz7uO4df/6rY.fnS/6MzBxEVAzMxoqPCoSO2', 'Francis@france.com');

-- --------------------------------------------------------

--
-- Table structure for table `religion`
--

DROP TABLE IF EXISTS `religion`;
CREATE TABLE IF NOT EXISTS `religion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `choice` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `religion`
--

INSERT INTO `religion` (`id`, `choice`) VALUES
(1, 'Unselected'),
(2, 'I''d rather not say'),
(3, 'Athiest'),
(4, 'Christianity'),
(5, 'Islam'),
(6, 'Hinduism'),
(7, 'Buddhism'),
(8, 'Judaism'),
(9, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `seeking`
--

DROP TABLE IF EXISTS `seeking`;
CREATE TABLE IF NOT EXISTS `seeking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `choice` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seeking`
--

INSERT INTO `seeking` (`id`, `choice`) VALUES
(1, 'Unselected'),
(2, 'Male'),
(3, 'Female'),
(4, 'Both');

-- --------------------------------------------------------

--
-- Table structure for table `smoker`
--

DROP TABLE IF EXISTS `smoker`;
CREATE TABLE IF NOT EXISTS `smoker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `choice` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smoker`
--

INSERT INTO `smoker` (`id`, `choice`) VALUES
(1, 'Unselected'),
(2, 'Yes'),
(3, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `unique_hobby`
--

DROP TABLE IF EXISTS `unique_hobby`;
CREATE TABLE IF NOT EXISTS `unique_hobby` (
  `user_id` int(11) NOT NULL,
  `unique_hobby` varchar(256) DEFAULT NULL,
  KEY `unique_hobby_ibfk_1` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unique_hobby`
--

INSERT INTO `unique_hobby` (`user_id`, `unique_hobby`) VALUES
(1, 'Sewing'),
(2, 'Sheering sheep'),
(3, 'Sunbathing'),
(4, 'CSS'),
(5, 'Jumping'),
(6, 'Running the world'),
(7, 'MMA'),
(8, 'Playing'),
(9, 'Rapping'),
(10, 'Magic'),
(11, NULL),
(12, NULL),
(13, 'Drinking'),
(14, 'Rap'),
(15, 'sailing'),
(16, 'Bag Pipes'),
(17, 'BeatBoxing'),
(18, 'Singing'),
(19, 'Twerking'),
(20, 'Belly Dancing'),
(21, 'Singing'),
(22, 'Racing'),
(23, 'Twirling'),
(24, 'Song writing'),
(25, 'Eating Garlic Bread');

-- --------------------------------------------------------

--
-- Table structure for table `user_hobbies`
--

DROP TABLE IF EXISTS `user_hobbies`;
CREATE TABLE IF NOT EXISTS `user_hobbies` (
  `hobby_id` int(11) NOT NULL AUTO_INCREMENT,
  `hobby_name` varchar(64) NOT NULL,
  PRIMARY KEY (`hobby_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_hobbies`
--

INSERT INTO `user_hobbies` (`hobby_id`, `hobby_name`) VALUES
(1, 'Reading'),
(2, 'Cinema'),
(3, 'Shopping'),
(4, 'Socializing'),
(5, 'Travelling'),
(6, 'Walking'),
(7, 'Exercise'),
(8, 'Soccer'),
(9, 'Dancing'),
(10, 'Horses'),
(11, 'Painting'),
(12, 'Running'),
(13, 'Eating Out'),
(14, 'Cooking'),
(15, 'Computers'),
(16, 'Bowling'),
(17, 'Writing'),
(18, 'Skiing'),
(19, 'Crafts'),
(20, 'Golf'),
(21, 'Chess'),
(22, 'Gymnastics'),
(23, 'Cycling'),
(24, 'Swimming'),
(25, 'Surfing'),
(26, 'Hiking'),
(27, 'Video Games'),
(28, 'Volleyball'),
(29, 'Badminton'),
(30, 'Gym'),
(31, 'Parkour'),
(32, 'Fashion'),
(33, 'Yoga'),
(34, 'Basketball'),
(35, 'Boxing');

-- --------------------------------------------------------

--
-- Table structure for table `user_hobby_preferences`
--

DROP TABLE IF EXISTS `user_hobby_preferences`;
CREATE TABLE IF NOT EXISTS `user_hobby_preferences` (
  `user_id` int(11) NOT NULL,
  `hobby_id` int(11) NOT NULL,
  `hobby_preference` tinyint(1) DEFAULT NULL,
  KEY `user_hobby_preferences_ibfk_1` (`user_id`),
  KEY `hobby_id` (`hobby_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_hobby_preferences`
--

INSERT INTO `user_hobby_preferences` (`user_id`, `hobby_id`, `hobby_preference`) VALUES
(1, 1, 1),
(1, 2, 0),
(1, 3, 1),
(1, 4, 1),
(1, 5, 0),
(1, 6, 1),
(1, 7, 0),
(1, 8, 0),
(1, 9, 1),
(1, 10, 0),
(1, 11, 1),
(1, 12, 1),
(1, 13, 0),
(1, 14, 0),
(1, 15, 1),
(1, 16, 1),
(1, 17, 1),
(1, 18, 0),
(1, 19, 1),
(1, 20, 1),
(1, 21, 0),
(1, 22, 1),
(1, 23, 1),
(1, 24, 1),
(1, 25, 1),
(1, 26, 0),
(1, 27, 0),
(1, 28, 1),
(1, 29, 0),
(1, 30, 1),
(1, 31, 1),
(1, 32, 0),
(1, 33, 0),
(1, 34, 0),
(1, 35, 0),
(2, 1, 1),
(2, 2, 0),
(2, 3, 0),
(2, 4, 1),
(2, 5, 0),
(2, 6, 0),
(2, 7, 0),
(2, 8, 0),
(2, 9, 0),
(2, 10, 0),
(2, 11, 0),
(2, 12, 1),
(2, 13, 0),
(2, 14, 0),
(2, 15, 1),
(2, 16, 0),
(2, 17, 1),
(2, 18, 0),
(2, 19, 1),
(2, 20, 1),
(2, 21, 0),
(2, 22, 0),
(2, 23, 1),
(2, 24, 0),
(2, 25, 0),
(2, 26, 0),
(2, 27, 0),
(2, 28, 0),
(2, 29, 0),
(2, 30, 0),
(2, 31, 0),
(2, 32, 0),
(2, 33, 0),
(2, 34, 0),
(2, 35, 0),
(3, 1, 1),
(3, 2, 1),
(3, 3, 1),
(3, 4, 0),
(3, 5, 0),
(3, 6, 0),
(3, 7, 1),
(3, 8, 1),
(3, 9, 1),
(3, 10, 0),
(3, 11, 0),
(3, 12, 0),
(3, 13, 1),
(3, 14, 1),
(3, 15, 1),
(3, 16, 0),
(3, 17, 0),
(3, 18, 0),
(3, 19, 1),
(3, 20, 1),
(3, 21, 1),
(3, 22, 0),
(3, 23, 0),
(3, 24, 0),
(3, 25, 1),
(3, 26, 1),
(3, 27, 1),
(3, 28, 0),
(3, 29, 0),
(3, 30, 0),
(3, 31, 1),
(3, 32, 1),
(3, 33, 1),
(3, 34, 0),
(3, 35, 0),
(4, 1, 0),
(4, 2, 0),
(4, 3, 0),
(4, 4, 1),
(4, 5, 0),
(4, 6, 1),
(4, 7, 1),
(4, 8, 0),
(4, 9, 0),
(4, 10, 0),
(4, 11, 1),
(4, 12, 0),
(4, 13, 0),
(4, 14, 0),
(4, 15, 1),
(4, 16, 0),
(4, 17, 0),
(4, 18, 1),
(4, 19, 0),
(4, 20, 0),
(4, 21, 0),
(4, 22, 0),
(4, 23, 1),
(4, 24, 0),
(4, 25, 0),
(4, 26, 0),
(4, 27, 0),
(4, 28, 0),
(4, 29, 0),
(4, 30, 1),
(4, 31, 0),
(4, 32, 0),
(4, 33, 0),
(4, 34, 0),
(4, 35, 0),
(5, 1, 0),
(5, 2, 0),
(5, 3, 0),
(5, 4, 0),
(5, 5, 1),
(5, 6, 1),
(5, 7, 0),
(5, 8, 1),
(5, 9, 0),
(5, 10, 0),
(5, 11, 0),
(5, 12, 0),
(5, 13, 0),
(5, 14, 1),
(5, 15, 1),
(5, 16, 0),
(5, 17, 1),
(5, 18, 0),
(5, 19, 1),
(5, 20, 0),
(5, 21, 1),
(5, 22, 0),
(5, 23, 0),
(5, 24, 0),
(5, 25, 1),
(5, 26, 0),
(5, 27, 0),
(5, 28, 0),
(5, 29, 0),
(5, 30, 0),
(5, 31, 1),
(5, 32, 0),
(5, 33, 0),
(5, 34, 0),
(5, 35, 0),
(6, 1, 0),
(6, 2, 0),
(6, 3, 0),
(6, 4, 1),
(6, 5, 0),
(6, 6, 0),
(6, 7, 0),
(6, 8, 0),
(6, 9, 0),
(6, 10, 1),
(6, 11, 0),
(6, 12, 0),
(6, 13, 0),
(6, 14, 1),
(6, 15, 0),
(6, 16, 1),
(6, 17, 1),
(6, 18, 0),
(6, 19, 0),
(6, 20, 0),
(6, 21, 0),
(6, 22, 0),
(6, 23, 0),
(6, 24, 0),
(6, 25, 0),
(6, 26, 0),
(6, 27, 0),
(6, 28, 0),
(6, 29, 0),
(6, 30, 0),
(6, 31, 0),
(6, 32, 0),
(6, 33, 0),
(6, 34, 0),
(6, 35, 0),
(7, 1, 0),
(7, 2, 0),
(7, 3, 0),
(7, 4, 0),
(7, 5, 0),
(7, 6, 1),
(7, 7, 0),
(7, 8, 0),
(7, 9, 1),
(7, 10, 0),
(7, 11, 0),
(7, 12, 0),
(7, 13, 0),
(7, 14, 0),
(7, 15, 0),
(7, 16, 0),
(7, 17, 1),
(7, 18, 0),
(7, 19, 0),
(7, 20, 1),
(7, 21, 0),
(7, 22, 0),
(7, 23, 0),
(7, 24, 0),
(7, 25, 0),
(7, 26, 0),
(7, 27, 0),
(7, 28, 0),
(7, 29, 0),
(7, 30, 0),
(7, 31, 0),
(7, 32, 0),
(7, 33, 0),
(7, 34, 0),
(7, 35, 0),
(8, 1, 0),
(8, 2, 0),
(8, 3, 1),
(8, 4, 1),
(8, 5, 0),
(8, 6, 1),
(8, 7, 0),
(8, 8, 0),
(8, 9, 1),
(8, 10, 1),
(8, 11, 1),
(8, 12, 0),
(8, 13, 0),
(8, 14, 1),
(8, 15, 0),
(8, 16, 1),
(8, 17, 1),
(8, 18, 0),
(8, 19, 0),
(8, 20, 1),
(8, 21, 1),
(8, 22, 0),
(8, 23, 1),
(8, 24, 1),
(8, 25, 0),
(8, 26, 0),
(8, 27, 0),
(8, 28, 0),
(8, 29, 0),
(8, 30, 0),
(8, 31, 0),
(8, 32, 0),
(8, 33, 0),
(8, 34, 0),
(8, 35, 0),
(9, 1, 0),
(9, 2, 0),
(9, 3, 0),
(9, 4, 0),
(9, 5, 0),
(9, 6, 0),
(9, 7, 0),
(9, 8, 0),
(9, 9, 1),
(9, 10, 0),
(9, 11, 0),
(9, 12, 0),
(9, 13, 0),
(9, 14, 0),
(9, 15, 0),
(9, 16, 0),
(9, 17, 0),
(9, 18, 0),
(9, 19, 0),
(9, 20, 0),
(9, 21, 0),
(9, 22, 0),
(9, 23, 0),
(9, 24, 0),
(9, 25, 0),
(9, 26, 0),
(9, 27, 0),
(9, 28, 0),
(9, 29, 0),
(9, 30, 0),
(9, 31, 0),
(9, 32, 0),
(9, 33, 0),
(9, 34, 0),
(9, 35, 0),
(10, 1, 0),
(10, 2, 0),
(10, 3, 0),
(10, 4, 0),
(10, 5, 0),
(10, 6, 1),
(10, 7, 0),
(10, 8, 0),
(10, 9, 0),
(10, 10, 0),
(10, 11, 1),
(10, 12, 0),
(10, 13, 0),
(10, 14, 0),
(10, 15, 0),
(10, 16, 0),
(10, 17, 0),
(10, 18, 0),
(10, 19, 0),
(10, 20, 0),
(10, 21, 0),
(10, 22, 0),
(10, 23, 0),
(10, 24, 0),
(10, 25, 0),
(10, 26, 0),
(10, 27, 0),
(10, 28, 0),
(10, 29, 0),
(10, 30, 0),
(10, 31, 0),
(10, 32, 0),
(10, 33, 0),
(10, 34, 0),
(10, 35, 0),
(11, 1, 1),
(11, 2, 0),
(11, 3, 0),
(11, 4, 0),
(11, 5, 0),
(11, 6, 0),
(11, 7, 0),
(11, 8, 0),
(11, 9, 0),
(11, 10, 0),
(11, 11, 0),
(11, 12, 0),
(11, 13, 0),
(11, 14, 1),
(11, 15, 0),
(11, 16, 0),
(11, 17, 1),
(11, 18, 0),
(11, 19, 0),
(11, 20, 1),
(11, 21, 0),
(11, 22, 0),
(11, 23, 1),
(11, 24, 0),
(11, 25, 0),
(11, 26, 1),
(11, 27, 0),
(11, 28, 0),
(11, 29, 1),
(11, 30, 0),
(11, 31, 0),
(11, 32, 1),
(11, 33, 0),
(11, 34, 0),
(11, 35, 0),
(12, 1, 0),
(12, 2, 0),
(12, 3, 0),
(12, 4, 1),
(12, 5, 0),
(12, 6, 0),
(12, 7, 0),
(12, 8, 0),
(12, 9, 0),
(12, 10, 1),
(12, 11, 0),
(12, 12, 0),
(12, 13, 0),
(12, 14, 0),
(12, 15, 1),
(12, 16, 0),
(12, 17, 0),
(12, 18, 0),
(12, 19, 0),
(12, 20, 0),
(12, 21, 0),
(12, 22, 0),
(12, 23, 0),
(12, 24, 0),
(12, 25, 0),
(12, 26, 0),
(12, 27, 0),
(12, 28, 0),
(12, 29, 0),
(12, 30, 0),
(12, 31, 0),
(12, 32, 0),
(12, 33, 0),
(12, 34, 0),
(12, 35, 0),
(13, 1, 0),
(13, 2, 0),
(13, 3, 0),
(13, 4, 1),
(13, 5, 0),
(13, 6, 0),
(13, 7, 1),
(13, 8, 0),
(13, 9, 0),
(13, 10, 0),
(13, 11, 1),
(13, 12, 0),
(13, 13, 0),
(13, 14, 0),
(13, 15, 0),
(13, 16, 0),
(13, 17, 0),
(13, 18, 0),
(13, 19, 0),
(13, 20, 1),
(13, 21, 0),
(13, 22, 0),
(13, 23, 0),
(13, 24, 0),
(13, 25, 0),
(13, 26, 0),
(13, 27, 0),
(13, 28, 0),
(13, 29, 0),
(13, 30, 0),
(13, 31, 0),
(13, 32, 0),
(13, 33, 0),
(13, 34, 0),
(13, 35, 0),
(14, 1, 0),
(14, 2, 1),
(14, 3, 0),
(14, 4, 0),
(14, 5, 1),
(14, 6, 0),
(14, 7, 0),
(14, 8, 0),
(14, 9, 0),
(14, 10, 0),
(14, 11, 0),
(14, 12, 0),
(14, 13, 0),
(14, 14, 0),
(14, 15, 0),
(14, 16, 0),
(14, 17, 0),
(14, 18, 0),
(14, 19, 0),
(14, 20, 0),
(14, 21, 0),
(14, 22, 1),
(14, 23, 1),
(14, 24, 0),
(14, 25, 1),
(14, 26, 1),
(14, 27, 0),
(14, 28, 0),
(14, 29, 0),
(14, 30, 0),
(14, 31, 0),
(14, 32, 0),
(14, 33, 0),
(14, 34, 0),
(14, 35, 0),
(15, 1, 0),
(15, 2, 0),
(15, 3, 0),
(15, 4, 1),
(15, 5, 0),
(15, 6, 0),
(15, 7, 0),
(15, 8, 0),
(15, 9, 0),
(15, 10, 0),
(15, 11, 0),
(15, 12, 0),
(15, 13, 0),
(15, 14, 0),
(15, 15, 0),
(15, 16, 0),
(15, 17, 1),
(15, 18, 0),
(15, 19, 0),
(15, 20, 0),
(15, 21, 0),
(15, 22, 0),
(15, 23, 0),
(15, 24, 0),
(15, 25, 0),
(15, 26, 1),
(15, 27, 0),
(15, 28, 0),
(15, 29, 0),
(15, 30, 0),
(15, 31, 0),
(15, 32, 1),
(15, 33, 0),
(15, 34, 0),
(15, 35, 0),
(16, 1, 0),
(16, 2, 0),
(16, 3, 0),
(16, 4, 0),
(16, 5, 0),
(16, 6, 0),
(16, 7, 0),
(16, 8, 1),
(16, 9, 0),
(16, 10, 0),
(16, 11, 0),
(16, 12, 1),
(16, 13, 0),
(16, 14, 0),
(16, 15, 0),
(16, 16, 0),
(16, 17, 0),
(16, 18, 0),
(16, 19, 1),
(16, 20, 0),
(16, 21, 0),
(16, 22, 0),
(16, 23, 0),
(16, 24, 0),
(16, 25, 0),
(16, 26, 1),
(16, 27, 0),
(16, 28, 0),
(16, 29, 0),
(16, 30, 0),
(16, 31, 0),
(16, 32, 0),
(16, 33, 0),
(16, 34, 0),
(16, 35, 0),
(17, 1, 1),
(17, 2, 1),
(17, 3, 0),
(17, 4, 0),
(17, 5, 1),
(17, 6, 0),
(17, 7, 0),
(17, 8, 1),
(17, 9, 1),
(17, 10, 0),
(17, 11, 0),
(17, 12, 1),
(17, 13, 0),
(17, 14, 0),
(17, 15, 1),
(17, 16, 0),
(17, 17, 1),
(17, 18, 0),
(17, 19, 1),
(17, 20, 1),
(17, 21, 0),
(17, 22, 1),
(17, 23, 1),
(17, 24, 0),
(17, 25, 0),
(17, 26, 0),
(17, 27, 0),
(17, 28, 0),
(17, 29, 0),
(17, 30, 1),
(17, 31, 1),
(17, 32, 1),
(17, 33, 0),
(17, 34, 0),
(17, 35, 0),
(18, 1, 1),
(18, 2, 0),
(18, 3, 1),
(18, 4, 1),
(18, 5, 0),
(18, 6, 1),
(18, 7, 1),
(18, 8, 1),
(18, 9, 0),
(18, 10, 1),
(18, 11, 1),
(18, 12, 0),
(18, 13, 0),
(18, 14, 0),
(18, 15, 0),
(18, 16, 0),
(18, 17, 0),
(18, 18, 0),
(18, 19, 0),
(18, 20, 1),
(18, 21, 0),
(18, 22, 1),
(18, 23, 1),
(18, 24, 1),
(18, 25, 1),
(18, 26, 1),
(18, 27, 0),
(18, 28, 1),
(18, 29, 1),
(18, 30, 0),
(18, 31, 0),
(18, 32, 1),
(18, 33, 0),
(18, 34, 0),
(18, 35, 0),
(19, 1, 0),
(19, 2, 0),
(19, 3, 0),
(19, 4, 1),
(19, 5, 0),
(19, 6, 0),
(19, 7, 1),
(19, 8, 0),
(19, 9, 1),
(19, 10, 0),
(19, 11, 1),
(19, 12, 1),
(19, 13, 0),
(19, 14, 1),
(19, 15, 0),
(19, 16, 1),
(19, 17, 1),
(19, 18, 0),
(19, 19, 1),
(19, 20, 1),
(19, 21, 1),
(19, 22, 0),
(19, 23, 1),
(19, 24, 1),
(19, 25, 1),
(19, 26, 1),
(19, 27, 0),
(19, 28, 1),
(19, 29, 1),
(19, 30, 0),
(19, 31, 0),
(19, 32, 0),
(19, 33, 0),
(19, 34, 0),
(19, 35, 0),
(20, 1, 0),
(20, 2, 0),
(20, 3, 1),
(20, 4, 0),
(20, 5, 1),
(20, 6, 1),
(20, 7, 0),
(20, 8, 1),
(20, 9, 1),
(20, 10, 1),
(20, 11, 0),
(20, 12, 0),
(20, 13, 0),
(20, 14, 0),
(20, 15, 0),
(20, 16, 0),
(20, 17, 0),
(20, 18, 1),
(20, 19, 0),
(20, 20, 0),
(20, 21, 1),
(20, 22, 1),
(20, 23, 1),
(20, 24, 0),
(20, 25, 1),
(20, 26, 1),
(20, 27, 0),
(20, 28, 0),
(20, 29, 0),
(20, 30, 0),
(20, 31, 0),
(20, 32, 0),
(20, 33, 0),
(20, 34, 0),
(20, 35, 0),
(21, 1, 0),
(21, 2, 0),
(21, 3, 1),
(21, 4, 1),
(21, 5, 0),
(21, 6, 0),
(21, 7, 0),
(21, 8, 0),
(21, 9, 1),
(21, 10, 0),
(21, 11, 1),
(21, 12, 0),
(21, 13, 0),
(21, 14, 1),
(21, 15, 0),
(21, 16, 0),
(21, 17, 0),
(21, 18, 1),
(21, 19, 1),
(21, 20, 0),
(21, 21, 0),
(21, 22, 0),
(21, 23, 1),
(21, 24, 1),
(21, 25, 0),
(21, 26, 0),
(21, 27, 0),
(21, 28, 1),
(21, 29, 0),
(21, 30, 0),
(21, 31, 0),
(21, 32, 1),
(21, 33, 0),
(21, 34, 0),
(21, 35, 0),
(22, 1, 0),
(22, 2, 0),
(22, 3, 0),
(22, 4, 1),
(22, 5, 0),
(22, 6, 0),
(22, 7, 0),
(22, 8, 1),
(22, 9, 0),
(22, 10, 1),
(22, 11, 1),
(22, 12, 0),
(22, 13, 0),
(22, 14, 0),
(22, 15, 0),
(22, 16, 1),
(22, 17, 1),
(22, 18, 0),
(22, 19, 0),
(22, 20, 1),
(22, 21, 0),
(22, 22, 0),
(22, 23, 0),
(22, 24, 0),
(22, 25, 1),
(22, 26, 0),
(22, 27, 0),
(22, 28, 0),
(22, 29, 1),
(22, 30, 0),
(22, 31, 0),
(22, 32, 0),
(22, 33, 0),
(22, 34, 0),
(22, 35, 0),
(23, 1, 0),
(23, 2, 0),
(23, 3, 0),
(23, 4, 0),
(23, 5, 0),
(23, 6, 0),
(23, 7, 0),
(23, 8, 1),
(23, 9, 0),
(23, 10, 0),
(23, 11, 1),
(23, 12, 1),
(23, 13, 0),
(23, 14, 0),
(23, 15, 1),
(23, 16, 0),
(23, 17, 0),
(23, 18, 1),
(23, 19, 0),
(23, 20, 0),
(23, 21, 0),
(23, 22, 0),
(23, 23, 0),
(23, 24, 0),
(23, 25, 0),
(23, 26, 0),
(23, 27, 0),
(23, 28, 0),
(23, 29, 0),
(23, 30, 1),
(23, 31, 0),
(23, 32, 1),
(23, 33, 1),
(23, 34, 0),
(23, 35, 0),
(24, 1, 0),
(24, 2, 0),
(24, 3, 0),
(24, 4, 1),
(24, 5, 1),
(24, 6, 0),
(24, 7, 1),
(24, 8, 1),
(24, 9, 0),
(24, 10, 1),
(24, 11, 1),
(24, 12, 0),
(24, 13, 0),
(24, 14, 0),
(24, 15, 0),
(24, 16, 1),
(24, 17, 0),
(24, 18, 0),
(24, 19, 1),
(24, 20, 1),
(24, 21, 1),
(24, 22, 1),
(24, 23, 1),
(24, 24, 0),
(24, 25, 1),
(24, 26, 0),
(24, 27, 0),
(24, 28, 0),
(24, 29, 0),
(24, 30, 0),
(24, 31, 0),
(24, 32, 0),
(24, 33, 0),
(24, 34, 0),
(24, 35, 0),
(25, 1, 0),
(25, 2, 0),
(25, 3, 0),
(25, 4, 0),
(25, 5, 0),
(25, 6, 0),
(25, 7, 0),
(25, 8, 1),
(25, 9, 0),
(25, 10, 0),
(25, 11, 1),
(25, 12, 0),
(25, 13, 0),
(25, 14, 1),
(25, 15, 0),
(25, 16, 0),
(25, 17, 0),
(25, 18, 0),
(25, 19, 0),
(25, 20, 0),
(25, 21, 0),
(25, 22, 0),
(25, 23, 0),
(25, 24, 0),
(25, 25, 0),
(25, 26, 0),
(25, 27, 0),
(25, 28, 0),
(25, 29, 0),
(25, 30, 0),
(25, 31, 0),
(25, 32, 0),
(25, 33, 0),
(25, 34, 0),
(25, 35, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wants_children`
--

DROP TABLE IF EXISTS `wants_children`;
CREATE TABLE IF NOT EXISTS `wants_children` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `choice` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wants_children`
--

INSERT INTO `wants_children` (`id`, `choice`) VALUES
(1, 'Unselected'),
(2, 'Yes'),
(3, 'No'),
(4, 'Maybe');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_details`
--
ALTER TABLE `account_details`
  ADD CONSTRAINT `account_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registration_details` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `banned_reports`
--
ALTER TABLE `banned_reports`
  ADD CONSTRAINT `banned_reports_ibfk_1` FOREIGN KEY (`reporter_id`) REFERENCES `registration_details` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `banned_reports_ibfk_2` FOREIGN KEY (`reportee_id`) REFERENCES `registration_details` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `banned_reports_ibfk_3` FOREIGN KEY (`priority`) REFERENCES `priority` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `banned_users`
--
ALTER TABLE `banned_users`
  ADD CONSTRAINT `banned_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registration_details` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_ibfk_1` FOREIGN KEY (`user1_id`) REFERENCES `registration_details` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conversations_ibfk_2` FOREIGN KEY (`user2_id`) REFERENCES `registration_details` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registration_details` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `registration_details` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`recipient_id`) REFERENCES `registration_details` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`conversation_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `preference_details`
--
ALTER TABLE `preference_details`
  ADD CONSTRAINT `preference_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registration_details` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `preference_details_ibfk_10` FOREIGN KEY (`income`) REFERENCES `income` (`id`),
  ADD CONSTRAINT `preference_details_ibfk_11` FOREIGN KEY (`has_children`) REFERENCES `has_children` (`id`),
  ADD CONSTRAINT `preference_details_ibfk_12` FOREIGN KEY (`wants_children`) REFERENCES `wants_children` (`id`),
  ADD CONSTRAINT `preference_details_ibfk_13` FOREIGN KEY (`smoker`) REFERENCES `smoker` (`id`),
  ADD CONSTRAINT `preference_details_ibfk_14` FOREIGN KEY (`drinker`) REFERENCES `drinker` (`id`),
  ADD CONSTRAINT `preference_details_ibfk_2` FOREIGN KEY (`gender`) REFERENCES `gender` (`id`),
  ADD CONSTRAINT `preference_details_ibfk_3` FOREIGN KEY (`seeking`) REFERENCES `seeking` (`id`),
  ADD CONSTRAINT `preference_details_ibfk_4` FOREIGN KEY (`intent`) REFERENCES `intent` (`id`),
  ADD CONSTRAINT `preference_details_ibfk_5` FOREIGN KEY (`height`) REFERENCES `height` (`id`),
  ADD CONSTRAINT `preference_details_ibfk_6` FOREIGN KEY (`ethnicity`) REFERENCES `ethnicity` (`id`),
  ADD CONSTRAINT `preference_details_ibfk_7` FOREIGN KEY (`body_type`) REFERENCES `body_type` (`id`),
  ADD CONSTRAINT `preference_details_ibfk_8` FOREIGN KEY (`religion`) REFERENCES `religion` (`id`),
  ADD CONSTRAINT `preference_details_ibfk_9` FOREIGN KEY (`marital_status`) REFERENCES `marital_status` (`id`);

--
-- Constraints for table `unique_hobby`
--
ALTER TABLE `unique_hobby`
  ADD CONSTRAINT `unique_hobby_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registration_details` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_hobby_preferences`
--
ALTER TABLE `user_hobby_preferences`
  ADD CONSTRAINT `user_hobby_preferences_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registration_details` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_hobby_preferences_ibfk_2` FOREIGN KEY (`hobby_id`) REFERENCES `user_hobbies` (`hobby_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

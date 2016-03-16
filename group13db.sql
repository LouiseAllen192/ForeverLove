-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2016 at 10:53 AM
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
  `free_trail_used` tinyint(1) DEFAULT NULL,
  `account_expired` tinyint(1) DEFAULT NULL,
  KEY `User_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `banned_reports`
--

DROP TABLE IF EXISTS `banned_reports`;
CREATE TABLE IF NOT EXISTS `banned_reports` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `reporter_id` int(11) NOT NULL,
  `reportee_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `resolved` tinyint(1) NOT NULL,
  PRIMARY KEY (`report_id`),
  KEY `Reporter_id` (`reporter_id`),
  KEY `Reportee_id` (`reportee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `banned_users`
--

DROP TABLE IF EXISTS `banned_users`;
CREATE TABLE IF NOT EXISTS `banned_users` (
  `user_id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  KEY `User_id` (`user_id`),
  KEY `Report_id` (`report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `body_type`
--

DROP TABLE IF EXISTS `body_type`;
CREATE TABLE IF NOT EXISTS `body_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
CREATE TABLE IF NOT EXISTS `conversations` (
  `conversation_id` int(11) NOT NULL AUTO_INCREMENT,
  `user1_id` int(11) NOT NULL,
  `user2_id` int(11) NOT NULL,
  PRIMARY KEY (`conversation_id`),
  KEY `User1_id` (`user1_id`),
  KEY `User2_id` (`user2_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `drinker`
--

DROP TABLE IF EXISTS `drinker`;
CREATE TABLE IF NOT EXISTS `drinker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ethnicity`
--

DROP TABLE IF EXISTS `ethnicity`;
CREATE TABLE IF NOT EXISTS `ethnicity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

DROP TABLE IF EXISTS `gender`;
CREATE TABLE IF NOT EXISTS `gender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `has_children`
--

DROP TABLE IF EXISTS `has_children`;
CREATE TABLE IF NOT EXISTS `has_children` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `height`
--

DROP TABLE IF EXISTS `height`;
CREATE TABLE IF NOT EXISTS `height` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `image_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `url` varchar(256) NOT NULL,
  PRIMARY KEY (`image_id`),
  KEY `User_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

DROP TABLE IF EXISTS `income`;
CREATE TABLE IF NOT EXISTS `income` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `intent`
--

DROP TABLE IF EXISTS `intent`;
CREATE TABLE IF NOT EXISTS `intent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `marital_status`
--

DROP TABLE IF EXISTS `marital_status`;
CREATE TABLE IF NOT EXISTS `marital_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `profile_visable` tinyint(1) NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `Sender_id` (`sender_id`),
  KEY `Recipient_id` (`recipient_id`),
  KEY `Conversation_id` (`conversation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `religion`
--

DROP TABLE IF EXISTS `religion`;
CREATE TABLE IF NOT EXISTS `religion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seeking`
--

DROP TABLE IF EXISTS `seeking`;
CREATE TABLE IF NOT EXISTS `seeking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `smoker`
--

DROP TABLE IF EXISTS `smoker`;
CREATE TABLE IF NOT EXISTS `smoker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `unique_hobby`
--

DROP TABLE IF EXISTS `unique_hobby`;
CREATE TABLE IF NOT EXISTS `unique_hobby` (
  `user_id` int(11) NOT NULL,
  `unique` varchar(256) NOT NULL,
  KEY `unique_hobby_ibfk_1` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `user_hobby_preferences`
--

DROP TABLE IF EXISTS `user_hobby_preferences`;
CREATE TABLE IF NOT EXISTS `user_hobby_preferences` (
  `user_id` int(11) NOT NULL,
  `hobby_id` int(11) NOT NULL,
  `hobby_preference` tinyint(1) NOT NULL,
  KEY `user_hobby_preferences_ibfk_1` (`user_id`),
  KEY `hobby_id` (`hobby_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wants_children`
--

DROP TABLE IF EXISTS `wants_children`;
CREATE TABLE IF NOT EXISTS `wants_children` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  ADD CONSTRAINT `banned_reports_ibfk_2` FOREIGN KEY (`reportee_id`) REFERENCES `registration_details` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `banned_users`
--
ALTER TABLE `banned_users`
  ADD CONSTRAINT `banned_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registration_details` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `banned_users_ibfk_2` FOREIGN KEY (`report_id`) REFERENCES `banned_reports` (`report_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

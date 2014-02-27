-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jan 21, 2014 at 05:29 PM
-- Server version: 5.5.35-0ubuntu0.13.10.1-log
-- PHP Version: 5.5.7-1+sury.org~saucy+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pp_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `account_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Account ID (Primary Key)',
  `subdomain` text NOT NULL COMMENT 'Subdomain Name',
  `domain` text COMMENT 'Domain Name',
  `database_connection_id` int(10) unsigned DEFAULT NULL COMMENT 'Database Connection ID (Foreign Key)',
  `tier_level_id` int(10) unsigned DEFAULT NULL COMMENT 'Tier Level ID (Foreign Key)',
  `date_created` datetime DEFAULT NULL COMMENT 'Date Account Created',
  PRIMARY KEY (`account_id`),
  KEY `database_connection_id` (`database_connection_id`),
  KEY `tier_level_id` (`tier_level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Domain Table' AUTO_INCREMENT=30 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `subdomain`, `domain`, `database_connection_id`, `tier_level_id`, `date_created`) VALUES
(29, 'alpha', 'alpha.localhost', 1, 10, '2013-11-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `database_connections`
--

CREATE TABLE IF NOT EXISTS `database_connections` (
  `database_connection_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adapter` varchar(64) NOT NULL DEFAULT 'mysql',
  `dbname` varchar(24) NOT NULL,
  `host` varchar(255) NOT NULL DEFAULT 'localhost',
  `port` smallint(5) unsigned NOT NULL DEFAULT '3306',
  `username` varchar(16) NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`database_connection_id`),
  UNIQUE KEY `database_name` (`dbname`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Database Connection Information' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `database_connections`
--

INSERT INTO `database_connections` (`database_connection_id`, `adapter`, `dbname`, `host`, `port`, `username`, `password`) VALUES
(1, 'mysql', 'pp_0001', 'localhost', 3306, 'pp_0001', 'xtwDaJLvuKRfYN3F');

-- --------------------------------------------------------

--
-- Table structure for table `master_settings`
--

CREATE TABLE IF NOT EXISTS `master_settings` (
  `setting_name` varchar(64) NOT NULL,
  `setting_options` text NOT NULL,
  `setting_type` text NOT NULL,
  `minimum_tier_level` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`setting_name`),
  KEY `minimum_tier_level` (`minimum_tier_level`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tier_levels`
--

CREATE TABLE IF NOT EXISTS `tier_levels` (
  `tier_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Tier Control_id (Primary Key)',
  `tier_name` varchar(16) NOT NULL COMMENT 'Tier Control Name',
  PRIMARY KEY (`tier_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tier Access Control' AUTO_INCREMENT=31 ;

--
-- Dumping data for table `tier_levels`
--

INSERT INTO `tier_levels` (`tier_id`, `tier_name`) VALUES
(10, 'Tier 1'),
(11, 'Tier 1+'),
(20, 'Tier 2'),
(30, 'Tier 3');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_4` FOREIGN KEY (`database_connection_id`) REFERENCES `database_connections` (`database_connection_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `accounts_ibfk_5` FOREIGN KEY (`tier_level_id`) REFERENCES `tier_levels` (`tier_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `master_settings`
--
ALTER TABLE `master_settings`
  ADD CONSTRAINT `master_settings_ibfk_1` FOREIGN KEY (`minimum_tier_level`) REFERENCES `tier_levels` (`tier_id`) ON DELETE SET NULL ON UPDATE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

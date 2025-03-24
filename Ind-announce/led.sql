-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 19, 2019 at 07:53 AM
-- Server version: 5.7.26
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `led`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional_params`
--

DROP TABLE IF EXISTS `additional_params`;
CREATE TABLE IF NOT EXISTS `additional_params` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blink` tinyint(1) NOT NULL,
  `blink_speed` int(2) NOT NULL,
  `scroll` tinyint(1) NOT NULL,
  `scroll_speed` int(2) NOT NULL,
  `brightness` int(11) NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `additional_params`
--

INSERT INTO `additional_params` (`id`, `blink`, `blink_speed`, `scroll`, `scroll_speed`, `brightness`) VALUES
(1, 0, 10, 0, 10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `setting_table`
--

DROP TABLE IF EXISTS `setting_table`;
CREATE TABLE IF NOT EXISTS `setting_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(30) DEFAULT NULL,
  `device_name` varchar(60) NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_table`
--

INSERT INTO `setting_table` (`id`, `ip`, `device_name`) VALUES
(2, '10.0.0.2412', 'RGB-P67-96HV48-0');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

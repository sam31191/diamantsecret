-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2016 at 03:16 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `website`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '0:Standard User, 1:Admin',
  `mobileno` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Email` (`email`,`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `username`, `password`, `type`, `mobileno`) VALUES
(1, 'test@test', 'Test', 'test', 0, 0),
(15, 'admin@admin', 'Admin', 'admin', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(128) NOT NULL,
  `item_value` varchar(11) NOT NULL,
  `discount` varchar(11) DEFAULT '0',
  `image` varchar(256) NOT NULL,
  `category` varchar(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Item Name` (`item_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_name`, `item_value`, `discount`, `image`, `category`) VALUES
(1, 'Dizzy Heart Pendant', '99.99', '20', 'https://cdn1.caratlane.com/media/catalog/product/J/P/JP00452-YGP900_1_lar.jpg', 'Featured'),
(3, 'Dizzy Heart Pendant 2', '99.99', '0', 'https://cdn1.caratlane.com/media/catalog/product/J/P/JP00452-YGP900_1_lar.jpg', 'Featured'),
(6, 'Test', '9.99', '10', 'https://i.ytimg.com/vi/Yt41V1Lt1IU/maxresdefault.jpg', 'Featured');

-- --------------------------------------------------------

--
-- Table structure for table `moderator_login`
--

CREATE TABLE IF NOT EXISTS `moderator_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `last_login` varchar(128) NOT NULL,
  `login_ip` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `moderator_login`
--

INSERT INTO `moderator_login` (`id`, `username`, `last_login`, `login_ip`) VALUES
(1, 'Admin', '2016-08-21 12:38:42', '::1'),
(2, 'Admin', '2016-08-21 14:22:29', '::1'),
(3, 'Admin', '2016-08-21 19:53:38', '::1'),
(4, 'Admin', '2016-08-21 21:21:09', '::1'),
(5, 'Admin', '2016-08-21 22:38:52', '::1'),
(6, 'Admin', '2016-08-22 16:52:30', '::1'),
(7, 'Admin', '2016-08-22 17:03:13', '::1'),
(8, 'Admin', '2016-08-22 17:13:59', '::1'),
(9, 'Admin', '2016-08-24 23:43:15', '::1'),
(10, 'Admin', '2016-08-25 14:49:42', '::1'),
(11, 'Admin', '2016-08-25 14:50:12', '::1'),
(12, 'Admin', '2016-08-25 18:45:02', '::1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

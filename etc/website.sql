-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2016 at 08:59 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `username`, `password`, `type`, `mobileno`) VALUES
(1, 'test@test', 'Test', 'test', 0, 0),
(15, 'admin@admin', 'Admin', 'admin', 1, 0),
(16, 'acc@acc', 'Acc', 'acc', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `diamonds`
--

CREATE TABLE IF NOT EXISTS `diamonds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(11) NOT NULL,
  `price` varchar(128) NOT NULL,
  `shape` varchar(128) NOT NULL,
  `carat` varchar(128) NOT NULL,
  `color` varchar(128) NOT NULL,
  `clarity` varchar(128) NOT NULL,
  `cut` varchar(128) NOT NULL,
  `polish` varchar(128) NOT NULL,
  `lab` varchar(128) NOT NULL,
  `fluorescence` varchar(128) NOT NULL,
  `details` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `diamonds`
--

INSERT INTO `diamonds` (`id`, `key`, `price`, `shape`, `carat`, `color`, `clarity`, `cut`, `polish`, `lab`, `fluorescence`, `details`) VALUES
(1, '', '99.99', 'Princess', '1.5', 'D', 'FL', 'EX', 'EX', 'GIA', 'FNT', '');

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
  `category` int(11) NOT NULL COMMENT 'Diamond = 1; Pendant = 2; Bracelet = 3; Ring = 4;',
  `featured` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Item Name` (`item_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_name`, `item_value`, `discount`, `image`, `category`, `featured`) VALUES
(1, 'Ring', '999.99', '10', 'Ring.jpg|', 4, 0),
(2, 'Lamia Diamond Band', '799.99', '5', 'Lamia_Diamond_Band.jpg|', 4, 1),
(3, 'Nine Diamond Band', '699.99', '0', 'Nine_Diamond_Band.jpg|', 4, 1),
(4, 'Sabira Ring', '949.99', '10', 'Sabira_Ring.jpg|', 4, 1),
(5, 'Forever Heart Solitaire', '1099.99', '0', 'Forever_Heart_Solitaire.jpg|', 2, 1),
(6, 'Mona Twiddle Solitaire', '749.99', '15', 'Mona_Twiddle_Solitaire.jpg|', 2, 1),
(7, 'Simple Solitaire', '499.99', '10', 'Simple_Solitaire.jpg|', 2, 1),
(8, 'Victory Solitaire', '899.99', '0', 'Victory_Solitaire.jpg|', 2, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

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
(12, 'Admin', '2016-08-25 18:45:02', '::1'),
(13, 'Admin', '2016-08-26 00:27:56', '::1'),
(14, 'Admin', '2016-08-26 02:32:46', '::1'),
(15, 'Admin', '2016-08-26 15:18:52', '::1'),
(16, 'Admin', '2016-08-26 15:36:12', '::1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

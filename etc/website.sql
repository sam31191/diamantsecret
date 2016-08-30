-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2016 at 07:16 PM
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
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128) NOT NULL,
  `mobileno` int(11) NOT NULL,
  `address` varchar(128) NOT NULL,
  `favorites` varchar(128) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '0:Standard User, 1:Admin',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Email` (`email`,`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `username`, `password`, `first_name`, `last_name`, `mobileno`, `address`, `favorites`, `type`) VALUES
(1, 'test@test', 'Test', 'test', '', '', 0, '', '', 0),
(15, 'admin@admin', 'Admin', 'admin', '', '', 0, '', ',yAuOfJYmYV,24TGoOjMXC,cwpk9rAtH0,5ki61kD4MP', 1),
(19, 'user@user', 'User', 'user', 'John', 'Doe', 911, '404 Not Found', ',24TGoOjMXC,Vgg21LyVRF', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bracelets`
--

CREATE TABLE IF NOT EXISTS `bracelets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_key` varchar(11) NOT NULL,
  `stone` varchar(128) NOT NULL,
  `stone_carat` varchar(11) NOT NULL,
  `num_of_stones` varchar(11) NOT NULL,
  `material` varchar(128) NOT NULL,
  `material_carat` varchar(11) NOT NULL,
  `height` varchar(11) NOT NULL,
  `length` varchar(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`unique_key`),
  KEY `carat` (`stone_carat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `bracelets`
--

INSERT INTO `bracelets` (`id`, `unique_key`, `stone`, `stone_carat`, `num_of_stones`, `material`, `material_carat`, `height`, `length`) VALUES
(2, '24TGoOjMXC', 'Diamond', '0.07', '12', 'White Gold', '10', '0.95', '0.65'),
(4, 'zhIsBF6REH', '', '', '', 'Gold', '', '', '');

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
  `unique_key` varchar(11) NOT NULL,
  `item_name` varchar(128) NOT NULL,
  `item_value` varchar(11) NOT NULL,
  `discount` varchar(11) DEFAULT '0',
  `image` varchar(256) NOT NULL,
  `category` int(11) NOT NULL COMMENT 'Diamond = 1; Pendant = 2; Bracelet = 3; Ring = 4;',
  `featured` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Item Name` (`item_name`),
  UNIQUE KEY `key` (`unique_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `unique_key`, `item_name`, `item_value`, `discount`, `image`, `category`, `featured`) VALUES
(5, 'cwpk9rAtH0', 'Turia Ring', '499.99', '10', 'cwpk9rAtH0.jpg,cwpk9rAtH0_1.jpg,cwpk9rAtH0_2.jpg,', 4, 1),
(6, 'yAuOfJYmYV', 'Luxe Ring', '599.99', '0', 'yAuOfJYmYV.jpg,yAuOfJYmYV_1.jpg,yAuOfJYmYV_2.jpg,yAuOfJYmYV_3.jpg,', 4, 1),
(7, 'mpD1Wrri78', 'Neely Inter-Twisted', '749.99', '5', 'mpD1Wrri78.jpg,mpD1Wrri78_1.jpg,mpD1Wrri78_2.jpg,', 2, 1),
(8, 'Vgg21LyVRF', 'Querida Duo', '999.99', '25', 'Vgg21LyVRF.jpg,Vgg21LyVRF_1.jpg,Vgg21LyVRF_2.jpg,Vgg21LyVRF_3.jpg,', 2, 1),
(10, 'zhIsBF6REH', 'Mansi Twist', '699.99', '10', 'zhIsBF6REH.jpg,zhIsBF6REH_1.jpg,zhIsBF6REH_2.jpg,zhIsBF6REH_3.jpg,', 3, 1),
(12, '24TGoOjMXC', 'Round Bracelet', '349.99', '20', '24TGoOjMXC.jpg,', 3, 1),
(13, '5ki61kD4MP', 'Rhombus Pendant', '199.99', '15', '5ki61kD4MP.jpg,', 2, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `moderator_login`
--

INSERT INTO `moderator_login` (`id`, `username`, `last_login`, `login_ip`) VALUES
(1, 'Admin', '2016-08-29 22:51:04', '::1'),
(2, 'Admin', '2016-08-29 22:51:32', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `pendants`
--

CREATE TABLE IF NOT EXISTS `pendants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_key` varchar(11) NOT NULL,
  `stone` varchar(128) NOT NULL,
  `stone_carat` varchar(11) NOT NULL,
  `num_of_stones` varchar(11) NOT NULL,
  `material` varchar(128) NOT NULL,
  `material_carat` varchar(11) NOT NULL,
  `height` varchar(11) NOT NULL,
  `length` varchar(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`unique_key`),
  KEY `carat` (`stone_carat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `pendants`
--

INSERT INTO `pendants` (`id`, `unique_key`, `stone`, `stone_carat`, `num_of_stones`, `material`, `material_carat`, `height`, `length`) VALUES
(2, '5ki61kD4MP', 'Amethyst & Diamond ', '0.9', '4', 'White Gold', '9', '', ''),
(15, 'Vgg21LyVRF', '', '', '', 'White Gold', '', '', ''),
(16, 'mpD1Wrri78', 'Diamonds', '', '10', 'Gold', '12', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `rings`
--

CREATE TABLE IF NOT EXISTS `rings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_key` varchar(11) NOT NULL,
  `stone` varchar(128) NOT NULL,
  `stone_carat` varchar(11) NOT NULL,
  `num_of_stones` varchar(11) NOT NULL,
  `material` varchar(128) NOT NULL,
  `material_carat` varchar(11) NOT NULL,
  `height` varchar(11) NOT NULL,
  `length` varchar(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`unique_key`),
  KEY `carat` (`stone_carat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `rings`
--

INSERT INTO `rings` (`id`, `unique_key`, `stone`, `stone_carat`, `num_of_stones`, `material`, `material_carat`, `height`, `length`) VALUES
(2, 'yAuOfJYmYV', '', '', '', 'White Gold', '', '', ''),
(3, 'cwpk9rAtH0', '', '', '', 'Gold', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2017 at 05:50 AM
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
  `mobileno` varchar(20) NOT NULL,
  `address` varchar(128) NOT NULL,
  `favorites` varchar(128) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '0:Standard User, 1:Admin',
  `cart` varchar(128) NOT NULL,
  `activated` int(11) NOT NULL,
  `verification_hash` varchar(128) NOT NULL,
  `recover_hash` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Email` (`email`,`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `username`, `password`, `first_name`, `last_name`, `mobileno`, `address`, `favorites`, `type`, `cart`, `activated`, `verification_hash`, `recover_hash`) VALUES
(15, 'admin@admin', 'Admin', 'admin', 'John', 'Doe', '9815408469', 'Flat No, Street, Town, State, 121001', ',PImzpiKfGs,WLjphkF5FE,nTnQEqWXBv,VlIASCLKpF', 1, 'RMFtsAgvgR|0|1,', 1, '', ''),
(19, 'user@user', 'User', 'newpasstest', 'John', 'Doe', '12312911', '404 Not Found', ',Vgg21LyVRF', 0, '', 1, '', ''),
(39, 'princebhanwra@gmail.com', 'Prince', 'test123', '', '', '', '', '', 1, '', 1, '', ''),
(66, 'ryan.bhanwra@gmail.com', 'Ryan', 'admin123', 'Ryan', 'Bhanwra', '+91 98154 08469', '404 Not Found', ',UgbSNRRj8D,w1xeJnF3Ea', 1, '', 1, '', ''),
(69, 'ryan.bhanwra@yahoo.com', 'RyanMailTest', 'test123', '', '', '', '', '', 0, '', 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `bracelets`
--

CREATE TABLE IF NOT EXISTS `bracelets` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11',
  `unique_key` varchar(11) NOT NULL,
  `company_id` int(11) NOT NULL COMMENT 'int 11',
  `internal_id` varchar(11) NOT NULL COMMENT 'varchar 11',
  `product_name` varchar(50) NOT NULL COMMENT 'varchat 50',
  `pieces_in_stock` int(11) NOT NULL COMMENT 'int 11',
  `days_for_shipment` int(11) NOT NULL COMMENT 'int 11',
  `total_gold_weight` float NOT NULL,
  `total_carat_weight` float NOT NULL COMMENT 'varchar 11',
  `color_stone_carat` float NOT NULL,
  `no_of_stones` int(11) NOT NULL COMMENT 'int 11',
  `no_of_color_stones` int(11) NOT NULL,
  `diamond_shape` int(11) NOT NULL COMMENT 'int 11',
  `color_stone_shape` int(11) NOT NULL,
  `clarity` varchar(11) NOT NULL COMMENT 'varchar 11',
  `color` int(11) NOT NULL COMMENT 'int 11',
  `material` int(11) NOT NULL COMMENT 'int 11',
  `height` float NOT NULL COMMENT 'varchar 11',
  `width` float NOT NULL COMMENT 'varchat 11',
  `length` float NOT NULL COMMENT 'varchar 11',
  `country_id` int(11) NOT NULL COMMENT 'int 11',
  `subcategory` int(11) NOT NULL,
  `lab_grown` int(11) NOT NULL COMMENT '1 = true; 0 = false',
  `images` varchar(1024) NOT NULL COMMENT 'varchar 1024',
  `description` varchar(250) NOT NULL COMMENT 'varchar 250',
  `ring_subcategory` int(11) NOT NULL COMMENT 'int 11',
  `ring_size` varchar(128) NOT NULL COMMENT 'varchar 128',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_key` (`unique_key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'rings'),
(2, 'earrings'),
(3, 'pendants'),
(4, 'necklaces'),
(5, 'bracelets');

-- --------------------------------------------------------

--
-- Table structure for table `company_id`
--

CREATE TABLE IF NOT EXISTS `company_id` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_code` varchar(32) NOT NULL,
  `company_name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `mobileno` varchar(128) NOT NULL,
  `address` varchar(512) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `company_code` (`company_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `company_id`
--

INSERT INTO `company_id` (`id`, `company_code`, `company_name`, `email`, `mobileno`, `address`) VALUES
(3, 'DIAMSEC', 'Diamant Secret Edit', 'contact@diamantsecret.com', '1234567890', ''),
(4, 'RYAN', 'Ryan', 'ryan.bhanwra@yahoo.com', '123', 'ASD'),
(5, 'TEST', 'Test Supplier', 'test@test.com', '123123', '');

-- --------------------------------------------------------

--
-- Table structure for table `country_vat`
--

CREATE TABLE IF NOT EXISTS `country_vat` (
  `tm` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `country_name` varchar(128) NOT NULL,
  `vat` int(11) NOT NULL,
  PRIMARY KEY (`tm`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `country_vat`
--

INSERT INTO `country_vat` (`tm`, `id`, `country_name`, `vat`) VALUES
(1, 1, 'Austria', 20),
(2, 2, 'Belgium', 21),
(3, 3, 'Bulgaria', 20),
(4, 4, 'Croatia', 25),
(5, 5, 'Cyprus', 19),
(6, 6, 'Czech Republic', 21),
(7, 7, 'Denmark', 25),
(8, 8, 'Estonia', 20),
(9, 9, 'Finland', 24),
(10, 10, 'France', 20),
(11, 11, 'Germany', 19),
(12, 12, 'Greece', 23),
(13, 13, 'Hungary', 27),
(14, 14, 'Ireland', 23),
(15, 15, 'Italy', 22),
(16, 16, 'Latvia', 21),
(17, 17, 'Lithuania', 21),
(18, 18, 'Luxembourg', 17),
(19, 19, 'Malta', 18),
(20, 20, 'Netherlands', 21),
(21, 21, 'Poland', 23),
(22, 22, 'Portugal', 23),
(23, 23, 'Romania', 20),
(24, 24, 'Slovakia', 20),
(25, 25, 'Slovenia', 22),
(26, 26, 'Spain', 21),
(27, 27, 'Sweden', 25),
(28, 28, 'UK', 20);

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
-- Table structure for table `diamond_shape`
--

CREATE TABLE IF NOT EXISTS `diamond_shape` (
  `id` int(11) NOT NULL,
  `category` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diamond_shape`
--

INSERT INTO `diamond_shape` (`id`, `category`) VALUES
(1, 'Round'),
(2, 'Marquise'),
(3, 'Princess'),
(4, 'Emerald'),
(5, 'Heart'),
(6, 'Oval'),
(7, 'Cushion'),
(8, 'Radiant'),
(9, 'Baguette'),
(10, 'Tappers'),
(11, 'Pear'),
(12, 'Asscher'),
(13, 'Square'),
(14, 'Trillion'),
(15, 'Culf'),
(16, 'Pearl'),
(17, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `earrings`
--

CREATE TABLE IF NOT EXISTS `earrings` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11',
  `unique_key` varchar(11) NOT NULL,
  `company_id` int(11) NOT NULL COMMENT 'int 11',
  `internal_id` varchar(11) NOT NULL COMMENT 'varchar 11',
  `product_name` varchar(50) NOT NULL COMMENT 'varchat 50',
  `pieces_in_stock` int(11) NOT NULL COMMENT 'int 11',
  `days_for_shipment` int(11) NOT NULL COMMENT 'int 11',
  `total_gold_weight` float NOT NULL,
  `total_carat_weight` float NOT NULL COMMENT 'varchar 11',
  `color_stone_carat` float NOT NULL,
  `no_of_stones` int(11) NOT NULL COMMENT 'int 11',
  `no_of_color_stones` int(11) NOT NULL,
  `diamond_shape` int(11) NOT NULL COMMENT 'int 11',
  `color_stone_shape` int(11) NOT NULL,
  `clarity` varchar(11) NOT NULL COMMENT 'varchar 11',
  `color` int(11) NOT NULL COMMENT 'int 11',
  `material` int(11) NOT NULL COMMENT 'int 11',
  `height` float NOT NULL COMMENT 'varchar 11',
  `width` float NOT NULL COMMENT 'varchat 11',
  `length` float NOT NULL COMMENT 'varchar 11',
  `country_id` int(11) NOT NULL COMMENT 'int 11',
  `subcategory` int(11) NOT NULL,
  `lab_grown` int(11) NOT NULL COMMENT '1 = true; 0 = false',
  `images` varchar(1024) NOT NULL COMMENT 'varchar 1024',
  `description` varchar(250) NOT NULL COMMENT 'varchar 250',
  `ring_subcategory` int(11) NOT NULL COMMENT 'int 11',
  `ring_size` varchar(128) NOT NULL COMMENT 'varchar 128',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_key` (`unique_key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_key` varchar(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_value` float NOT NULL,
  `discount` float DEFAULT '0',
  `category` int(11) NOT NULL COMMENT '1 = Rings; 2 = Earrings; 3 = Pendants; 4 = Necklaces; 5 = Bracelets;',
  `featured` int(11) NOT NULL,
  `images_delta` varchar(256) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`unique_key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE IF NOT EXISTS `materials` (
  `id` int(11) NOT NULL,
  `category` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `category`) VALUES
(1, 'Yellow Gold'),
(2, 'White Gold'),
(3, 'Pink Gold'),
(4, 'Silver'),
(5, 'Platinum'),
(6, 'Bi Colour with Gold'),
(7, 'Three Colour with Gold');

-- --------------------------------------------------------

--
-- Table structure for table `moderator_login`
--

CREATE TABLE IF NOT EXISTS `moderator_login` (
  `username` varchar(128) NOT NULL,
  `last_login` varchar(128) NOT NULL,
  `login_ip` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `moderator_login`
--

INSERT INTO `moderator_login` (`username`, `last_login`, `login_ip`) VALUES
('Admin', '2016-09-07 13:50:36', '::1'),
('Admin', '2016-09-07 13:55:54', '::1'),
('Admin', '2016-09-07 23:33:06', '::1'),
('Admin', '2016-09-08 00:17:36', '::1'),
('Admin', '2016-09-08 00:40:40', '::1'),
('Admin', '2016-09-08 06:05:53', '::1'),
('Admin', '2016-09-08 06:53:18', '::1'),
('Admin', '2016-09-08 11:10:52', '::1'),
('Ryan', '2016-09-08 12:17:11', '::1'),
('Admin', '2016-09-08 12:50:46', '::1'),
('Admin', '2016-09-08 13:13:13', '::1'),
('Admin', '2016-09-08 18:21:07', '::1'),
('Admin', '2016-09-08 18:21:44', '::1'),
('Ryan', '2016-09-09 00:11:38', '::1'),
('Ryan', '2016-09-09 17:26:14', '::1'),
('Ryan', '2016-09-09 18:18:30', '::1'),
('Ryan', '2016-09-09 23:45:00', '::1'),
('Ryan', '2016-09-09 23:47:20', '::1'),
('Admin', '2016-09-09 23:47:36', '::1'),
('Ryan', '2016-09-10 00:29:41', '::1'),
('Ryan', '2016-09-10 00:37:44', '::1'),
('Ryan', '2016-09-10 00:39:35', '::1'),
('Ryan', '2016-09-10 01:26:12', '::1'),
('Ryan', '2016-09-10 02:11:46', '::1'),
('Admin', '2016-09-10 08:36:19', '192.168.1.100'),
('Admin', '2016-09-10 22:54:56', '::1'),
('Admin', '2016-09-10 23:19:34', '::1'),
('Admin', '2016-09-11 01:03:36', '::1'),
('Admin', '2016-09-11 01:04:37', '::1'),
('Admin', '2016-09-11 18:21:12', '::1'),
('Admin', '2016-09-12 02:26:22', '::1'),
('Ryan', '2016-09-13 19:12:20', '::1'),
('Ryan', '2016-09-13 19:57:10', '::1'),
('Ryan', '2016-09-14 01:08:26', '::1'),
('Ryan', '2016-09-14 03:54:36', '::1'),
('Ryan', '2016-09-14 17:26:03', '::1'),
('Admin', '2016-09-15 01:20:28', '::1'),
('Admin', '2016-09-15 03:27:51', '::1'),
('Admin', '2016-09-15 03:31:39', '::1'),
('Admin', '2016-09-15 05:02:56', '::1'),
('Admin', '2016-09-15 17:41:26', '::1'),
('Admin', '2016-09-15 18:13:30', '::1'),
('Admin', '2016-09-15 18:14:11', '::1'),
('Ryan', '2016-09-15 18:14:33', '::1'),
('Admin', '2016-09-15 19:13:45', '::1'),
('Ryan', '2016-09-15 19:25:08', '::1'),
('Admin', '2016-09-15 22:15:35', '::1'),
('Admin', '2016-09-15 22:40:39', '::1'),
('Ryan', '2016-09-16 00:00:40', '::1'),
('Ryan', '2016-09-16 00:15:11', '::1'),
('Ryan', '2016-09-16 01:44:54', '::1'),
('Ryan', '2016-09-16 04:20:10', '::1'),
('Ryan', '2016-09-16 04:40:06', '::1'),
('Ryan', '2016-09-16 13:50:04', '::1'),
('Ryan', '2016-09-17 19:37:32', '::1'),
('Ryan', '2016-09-17 19:51:16', '::1'),
('Ryan', '2016-09-18 02:55:43', '::1'),
('Admin', '2016-09-18 22:09:22', '::1'),
('Admin', '2016-09-18 22:44:58', '::1'),
('Admin', '2016-09-18 23:20:48', '::1'),
('Admin', '2016-09-19 06:55:52', '::1'),
('Admin', '2016-09-19 16:11:42', '::1'),
('Admin', '2016-09-19 16:27:33', '::1'),
('Admin', '2016-09-20 02:22:24', '::1'),
('Admin', '2016-09-20 02:52:21', '::1'),
('Admin', '2016-09-20 05:00:09', '::1'),
('Ryan', '2016-09-20 06:03:05', '::1'),
('Ryan', '2016-09-20 07:10:53', '::1'),
('Ryan', '2016-09-20 07:22:14', '::1'),
('Ryan', '2016-09-20 19:26:57', '::1'),
('Ryan', '2016-09-21 20:23:26', '::1'),
('Ryan', '2016-09-22 00:30:11', '::1'),
('Ryan', '2016-09-23 04:22:09', '::1'),
('Ryan', '2016-09-24 00:03:03', '::1'),
('Ryan', '2016-09-24 01:25:43', '::1'),
('Ryan', '2016-09-24 15:13:38', '::1'),
('Ryan', '2016-09-26 06:23:50', '::1'),
('Ryan', '2016-09-26 06:47:07', '::1'),
('Ryan', '2016-09-26 07:36:14', '::1'),
('Ryan', '2016-09-27 11:56:27', '::1'),
('Ryan', '2016-09-30 09:57:33', '::1'),
('Ryan', '2016-10-01 14:34:07', '::1'),
('Ryan', '2016-10-02 00:26:31', '::1'),
('Ryan', '2016-10-02 16:13:01', '::1'),
('Ryan', '2016-10-05 16:47:52', '::1'),
('Ryan', '2016-10-06 23:26:23', '::1'),
('Ryan', '2016-10-07 20:54:19', '::1'),
('Ryan', '2016-10-08 18:10:10', '::1'),
('Ryan', '2016-10-11 22:11:49', '::1'),
('Ryan', '2016-10-11 22:23:48', '::1'),
('Ryan', '2016-10-12 17:15:43', '::1'),
('Ryan', '2016-10-19 16:20:20', '::1'),
('Ryan', '2016-11-08 14:41:55', '::1'),
('Ryan', '2016-11-08 22:16:57', '::1'),
('Ryan', '2016-11-12 01:20:36', '::1'),
('Ryan', '2016-11-13 23:06:52', '::1'),
('Ryan', '2016-11-15 01:27:47', '::1'),
('Ryan', '2016-11-23 05:33:31', '::1'),
('Ryan', '2016-11-23 05:50:49', '::1'),
('Ryan', '2016-11-28 15:17:02', '::1'),
('Ryan', '2016-11-29 23:17:48', '::1'),
('Ryan', '2017-01-01 10:02:19', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `necklaces`
--

CREATE TABLE IF NOT EXISTS `necklaces` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11',
  `unique_key` varchar(11) NOT NULL,
  `company_id` int(11) NOT NULL COMMENT 'int 11',
  `internal_id` varchar(11) NOT NULL COMMENT 'varchar 11',
  `product_name` varchar(50) NOT NULL COMMENT 'varchat 50',
  `pieces_in_stock` int(11) NOT NULL COMMENT 'int 11',
  `days_for_shipment` int(11) NOT NULL COMMENT 'int 11',
  `total_gold_weight` float NOT NULL,
  `total_carat_weight` float NOT NULL COMMENT 'varchar 11',
  `color_stone_carat` float NOT NULL,
  `no_of_stones` int(11) NOT NULL COMMENT 'int 11',
  `no_of_color_stones` int(11) NOT NULL,
  `diamond_shape` int(11) NOT NULL COMMENT 'int 11',
  `color_stone_shape` int(11) NOT NULL,
  `clarity` varchar(11) NOT NULL COMMENT 'varchar 11',
  `color` int(11) NOT NULL COMMENT 'int 11',
  `material` int(11) NOT NULL COMMENT 'int 11',
  `height` float NOT NULL COMMENT 'varchar 11',
  `width` float NOT NULL COMMENT 'varchat 11',
  `length` float NOT NULL COMMENT 'varchar 11',
  `country_id` int(11) NOT NULL COMMENT 'int 11',
  `subcategory` int(11) NOT NULL,
  `lab_grown` int(11) NOT NULL COMMENT '1 = true; 0 = false',
  `images` varchar(1024) NOT NULL COMMENT 'varchar 1024',
  `description` varchar(250) NOT NULL COMMENT 'varchar 250',
  `ring_subcategory` int(11) NOT NULL COMMENT 'int 11',
  `ring_size` varchar(128) NOT NULL COMMENT 'varchar 128',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_key` (`unique_key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pendants`
--

CREATE TABLE IF NOT EXISTS `pendants` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11',
  `unique_key` varchar(11) NOT NULL,
  `company_id` int(11) NOT NULL COMMENT 'int 11',
  `internal_id` varchar(11) NOT NULL COMMENT 'varchar 11',
  `product_name` varchar(50) NOT NULL COMMENT 'varchat 50',
  `pieces_in_stock` int(11) NOT NULL COMMENT 'int 11',
  `days_for_shipment` int(11) NOT NULL COMMENT 'int 11',
  `total_gold_weight` float NOT NULL,
  `total_carat_weight` float NOT NULL COMMENT 'varchar 11',
  `color_stone_carat` float NOT NULL,
  `no_of_stones` int(11) NOT NULL COMMENT 'int 11',
  `no_of_color_stones` int(11) NOT NULL,
  `diamond_shape` int(11) NOT NULL COMMENT 'int 11',
  `color_stone_shape` int(11) NOT NULL,
  `clarity` varchar(11) NOT NULL COMMENT 'varchar 11',
  `color` int(11) NOT NULL COMMENT 'int 11',
  `material` int(11) NOT NULL COMMENT 'int 11',
  `height` float NOT NULL COMMENT 'varchar 11',
  `width` float NOT NULL COMMENT 'varchat 11',
  `length` float NOT NULL COMMENT 'varchar 11',
  `country_id` int(11) NOT NULL COMMENT 'int 11',
  `subcategory` int(11) NOT NULL,
  `lab_grown` int(11) NOT NULL COMMENT '1 = true; 0 = false',
  `images` varchar(1024) NOT NULL COMMENT 'varchar 1024',
  `description` varchar(250) NOT NULL COMMENT 'varchar 250',
  `ring_subcategory` int(11) NOT NULL COMMENT 'int 11',
  `ring_size` varchar(128) NOT NULL COMMENT 'varchar 128',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_key` (`unique_key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rings`
--

CREATE TABLE IF NOT EXISTS `rings` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11',
  `unique_key` varchar(11) NOT NULL,
  `company_id` int(11) NOT NULL COMMENT 'int 11',
  `internal_id` varchar(11) NOT NULL COMMENT 'varchar 11',
  `product_name` varchar(50) NOT NULL COMMENT 'varchat 50',
  `pieces_in_stock` int(11) NOT NULL COMMENT 'int 11',
  `days_for_shipment` int(11) NOT NULL COMMENT 'int 11',
  `total_gold_weight` float NOT NULL,
  `total_carat_weight` float NOT NULL COMMENT 'varchar 11',
  `color_stone_carat` float NOT NULL,
  `no_of_stones` int(11) NOT NULL COMMENT 'int 11',
  `no_of_color_stones` int(11) NOT NULL,
  `diamond_shape` int(11) NOT NULL COMMENT 'int 11',
  `color_stone_shape` int(11) NOT NULL,
  `clarity` varchar(11) NOT NULL COMMENT 'varchar 11',
  `color` int(11) NOT NULL COMMENT 'int 11',
  `material` int(11) NOT NULL COMMENT 'int 11',
  `height` float NOT NULL COMMENT 'varchar 11',
  `width` float NOT NULL COMMENT 'varchat 11',
  `length` float NOT NULL COMMENT 'varchar 11',
  `country_id` int(11) NOT NULL COMMENT 'int 11',
  `subcategory` int(11) NOT NULL,
  `lab_grown` int(11) NOT NULL COMMENT '1 = true; 0 = false',
  `images` varchar(1024) NOT NULL COMMENT 'varchar 1024',
  `description` varchar(250) NOT NULL COMMENT 'varchar 250',
  `ring_subcategory` int(11) NOT NULL COMMENT 'int 11',
  `ring_size` varchar(128) NOT NULL COMMENT 'varchar 128',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_key` (`unique_key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ring_subcategory`
--

CREATE TABLE IF NOT EXISTS `ring_subcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `category` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `ring_subcategory`
--

INSERT INTO `ring_subcategory` (`id`, `category_id`, `category`) VALUES
(1, 1, 'Diamond Ring'),
(2, 1, 'Half Eternity Diamond Ring'),
(3, 1, 'Full Eternity Diamond Ring'),
(4, 1, 'Solitaire Diamond Ring'),
(5, 1, 'Gems Ring'),
(6, 1, 'Pearls Ring'),
(7, 1, 'Gems and Diamond Ring'),
(8, 1, 'Pearls and Diamond Ring'),
(9, 2, 'Diamond Earrings'),
(10, 2, 'Gems Earrings'),
(11, 2, 'Pearls Earrings'),
(12, 2, 'Gems and Diamond Earrings'),
(13, 2, 'Pearls and Diamond Earrings'),
(14, 3, 'Diamond Pendant'),
(15, 3, 'Gems Pendant'),
(16, 3, 'Pearls Pendant'),
(17, 3, 'Gems and Diamond Pendant'),
(18, 3, 'Pearls and Diamond Pendant'),
(19, 4, 'Diamond Necklace'),
(20, 4, 'Gems Necklace'),
(21, 4, 'Pearls Necklace'),
(22, 4, 'Gems and Diamond Necklace'),
(23, 4, 'Pearls and Diamond Necklace'),
(24, 5, 'Diamond Bracelet'),
(25, 5, 'Gems Bracelet'),
(26, 5, 'Pearls Bracelet'),
(27, 5, 'Gems and Diamond Bracelet'),
(28, 5, 'Pearls and Diamond Bracelet'),
(29, 1, 'Pearls and Colored Stone Ring'),
(30, 2, 'Pearl and Colored Stone Earring'),
(31, 3, 'Pearl and Colored Stone Pendant'),
(32, 4, 'Pearl and Colored Stone Necklace'),
(33, 5, 'Pearl and Colored Stone Bracelet');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `hash` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `hash`) VALUES
(31, 'ryan.bhanwra@yahoo.com', 'A0443D5C0912BA03F7CE806D41536678'),
(33, 'ryan.bhanwra@gmail.com', '86F808E24C6ECF95169AE6A8D67D6B5C');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_table`
--

CREATE TABLE IF NOT EXISTS `tmp_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11',
  `unique_key` varchar(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_value` float NOT NULL,
  `discount` float NOT NULL,
  `category` int(11) NOT NULL,
  `featured` int(11) NOT NULL,
  `company_id` int(11) NOT NULL COMMENT 'int 11',
  `internal_id` varchar(11) NOT NULL COMMENT 'varchar 11',
  `product_name` varchar(50) NOT NULL COMMENT 'varchat 50',
  `pieces_in_stock` int(11) NOT NULL COMMENT 'int 11',
  `days_for_shipment` int(11) NOT NULL COMMENT 'int 11',
  `total_carat_weight` varchar(11) NOT NULL COMMENT 'varchar 11',
  `no_of_stones` int(11) NOT NULL COMMENT 'int 11',
  `diamond_shape` int(11) NOT NULL COMMENT 'int 11',
  `clarity` varchar(11) NOT NULL COMMENT 'varchar 11',
  `color` int(11) NOT NULL COMMENT 'int 11',
  `material` int(11) NOT NULL COMMENT 'int 11',
  `height` varchar(11) NOT NULL COMMENT 'varchar 11',
  `width` varchar(11) NOT NULL COMMENT 'varchat 11',
  `length` varchar(11) NOT NULL COMMENT 'varchar 11',
  `country_id` int(11) NOT NULL COMMENT 'int 11',
  `images` varchar(1024) NOT NULL COMMENT 'varchar 1024',
  `description` varchar(250) DEFAULT NULL COMMENT 'varchar 250',
  `ring_subcategory` int(11) NOT NULL COMMENT 'int 11',
  `ring_size` varchar(128) NOT NULL COMMENT 'varchar 128',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `version`
--

CREATE TABLE IF NOT EXISTS `version` (
  `id` int(11) NOT NULL,
  `sql_version` varchar(128) NOT NULL,
  `build_version` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `version`
--

INSERT INTO `version` (`id`, `sql_version`, `build_version`) VALUES
(1, 'diamantsecretdb_1_2_0', '1.0.0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

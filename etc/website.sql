-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2016 at 03:33 PM
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `Email` (`email`,`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `username`, `password`, `first_name`, `last_name`, `mobileno`, `address`, `favorites`, `type`, `cart`, `activated`, `verification_hash`) VALUES
(15, 'admin@admin', 'Admin', 'admin', 'John', 'Doe', '9815408469', 'Flat No, Street, Town, State, 121001', ',PImzpiKfGs,WLjphkF5FE,nTnQEqWXBv,VlIASCLKpF', 1, 'VlIASCLKpF|0|1,KaQbi6JZFV|0|4,', 1, ''),
(19, 'user@user', 'User', 'newpasstest', 'John', 'Doe', '12312911', '404 Not Found', ',Vgg21LyVRF', 0, '', 1, ''),
(39, 'princebhanwra@gmail.com', 'Prince', 'test123', '', '', '', '', '', 1, 'HXh9tCXQxz|0|1,NuY1C4oJM4|0|1,bEaI7WSRBu|0|1,HXh9tCXQxz|50|3,', 1, ''),
(45, 'ryan.bhanwra@gmail.com', 'Ryan', 'test123', '', '', '', '', '', 1, 'GmNqWEEfXu|59|1,GmNqWEEfXu|61|3,', 1, ''),
(46, 'ryan.bhanwra@gmail.com1', 'Tet2', 'test123', '', '', '', '', '', 0, '', 1, ''),
(54, 'ryan.bhanwra@yahoo.com', 'Testmail', 'M6TLWJ', '', '', '', '', '', 0, '', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `bracelets`
--

CREATE TABLE IF NOT EXISTS `bracelets` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11',
  `unique_key` varchar(11) NOT NULL,
  `company_id` int(11) NOT NULL COMMENT 'int 11',
  `internal_id` varchar(11) NOT NULL,
  `product_name` varchar(50) NOT NULL COMMENT 'varchat 50',
  `pieces_in_stock` int(11) NOT NULL COMMENT 'int 11',
  `days_for_shipment` int(11) NOT NULL COMMENT 'int 11',
  `total_carat_weight` float(11,0) NOT NULL COMMENT 'varchar 11',
  `no_of_stones` int(11) NOT NULL COMMENT 'int 11',
  `diamond_shape` int(11) NOT NULL COMMENT 'int 11',
  `clarity` varchar(11) NOT NULL COMMENT 'varchar 11',
  `color` int(11) NOT NULL COMMENT 'int 11',
  `material` int(11) NOT NULL COMMENT 'int 11',
  `height` float NOT NULL COMMENT 'varchar 11',
  `width` float NOT NULL COMMENT 'varchat 11',
  `length` float NOT NULL COMMENT 'varchar 11',
  `country_id` int(11) NOT NULL COMMENT 'int 11',
  `images` varchar(1024) NOT NULL COMMENT 'varchar 1024',
  `description` varchar(300) NOT NULL COMMENT 'varchar 300',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_key` (`unique_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bracelets`
--

INSERT INTO `bracelets` (`id`, `unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`) VALUES
(1, 'bEaI7WSRBu', 3, 'RFE-XX1E', 'White Gold Bracelet', 4, 15, 1, 5, 1, 'VVS1', 1, 1, 10, 20, 10, 4, 'bracelet_1_0.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.');

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
  `company_name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `mobileno` varchar(128) NOT NULL,
  `address` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `company_id`
--

INSERT INTO `company_id` (`id`, `company_name`, `email`, `mobileno`, `address`) VALUES
(1, 'Diamant Secret123', '123contact@diamantsecret.com', '+32 3 298 58 66 91', 'Hoveniersstraat 30 Suite: 924\r\n2018 Antwerpen = Belgium123'),
(2, 'Company Two', '', '', ''),
(3, 'Diamant Secret', 'contact@diamantsecret.com', '+32 3 298 58 66', 'Hoveniersstraat 30 Suite: 924\n2018 Antwerpen - Belgium '),
(4, 'Company Four', '', '', ''),
(15, 'New Company', '', '', ''),
(17, 'Test Supplier', 'test@test', '123', '12asdsad');

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
(4, 'Pearl'),
(5, 'Emerald'),
(6, 'Heart'),
(7, 'Oval'),
(8, 'Cushion'),
(9, 'Radiant'),
(10, 'Cus. Brilliant'),
(11, 'LRadiant'),
(12, 'SQEmerald');

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
  `total_carat_weight` float NOT NULL COMMENT 'varchar 11',
  `no_of_stones` int(11) NOT NULL COMMENT 'int 11',
  `diamond_shape` int(11) NOT NULL COMMENT 'int 11',
  `clarity` varchar(11) NOT NULL COMMENT 'varchar 11',
  `color` int(11) NOT NULL COMMENT 'int 11',
  `material` int(11) NOT NULL COMMENT 'int 11',
  `height` float NOT NULL COMMENT 'varchar 11',
  `width` float NOT NULL COMMENT 'varchat 11',
  `length` float NOT NULL COMMENT 'varchar 11',
  `country_id` int(11) NOT NULL COMMENT 'int 11',
  `images` varchar(1024) NOT NULL COMMENT 'varchar 1024',
  `description` varchar(300) NOT NULL COMMENT 'varchar 300',
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
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`unique_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `unique_key`, `item_name`, `item_value`, `discount`, `category`, `featured`, `date_added`) VALUES
(1, 'HXh9tCXQxz', 'White Gold Ring', 100, 20, 1, 0, '2016-09-15 05:03:44'),
(2, 'NuY1C4oJM4', 'White Gold Pendant', 100, 20, 3, 0, '2016-09-15 05:03:47'),
(3, 'SS7q1cYDVU', 'White Gold Necklace', 100, 20, 4, 0, '2016-09-15 05:03:49'),
(4, 'bEaI7WSRBu', 'White Gold Bracelet', 150, 15, 5, 0, '2016-09-15 05:03:51'),
(5, 'hNn1wk5c1L', 'White Gold Ring', 100, 20, 1, 0, '2016-09-16 17:56:02'),
(6, 'GmNqWEEfXu', 'White Gold Ring', 100, 20, 1, 0, '2016-09-16 17:57:50');

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
(5, 'Platinum');

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
('Ryan', '2016-09-16 13:50:04', '::1');

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
  `total_carat_weight` float NOT NULL COMMENT 'varchar 11',
  `no_of_stones` int(11) NOT NULL COMMENT 'int 11',
  `diamond_shape` int(11) NOT NULL COMMENT 'int 11',
  `clarity` varchar(11) NOT NULL COMMENT 'varchar 11',
  `color` int(11) NOT NULL COMMENT 'int 11',
  `material` int(11) NOT NULL COMMENT 'int 11',
  `height` float NOT NULL COMMENT 'varchar 11',
  `width` float NOT NULL COMMENT 'varchat 11',
  `length` float NOT NULL COMMENT 'varchar 11',
  `country_id` int(11) NOT NULL COMMENT 'int 11',
  `images` varchar(1024) NOT NULL COMMENT 'varchar 1024',
  `description` varchar(300) NOT NULL COMMENT 'varchar 300',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_key` (`unique_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `necklaces`
--

INSERT INTO `necklaces` (`id`, `unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`) VALUES
(1, 'SS7q1cYDVU', 3, 'RFE-XX1E', 'White Gold Necklace', 10, 15, 1.2, 5, 1, 'VVS1', 1, 1, 10, 20, 10, 4, 'necklace_1_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.');

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
  `total_carat_weight` float NOT NULL COMMENT 'varchar 11',
  `no_of_stones` int(11) NOT NULL COMMENT 'int 11',
  `diamond_shape` int(11) NOT NULL COMMENT 'int 11',
  `clarity` varchar(11) NOT NULL COMMENT 'varchar 11',
  `color` int(11) NOT NULL COMMENT 'int 11',
  `material` int(11) NOT NULL COMMENT 'int 11',
  `height` float NOT NULL COMMENT 'varchar 11',
  `width` float NOT NULL COMMENT 'varchat 11',
  `length` float NOT NULL COMMENT 'varchar 11',
  `country_id` int(11) NOT NULL COMMENT 'int 11',
  `images` varchar(1024) NOT NULL COMMENT 'varchar 1024',
  `description` varchar(300) NOT NULL COMMENT 'varchar 300',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_key` (`unique_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pendants`
--

INSERT INTO `pendants` (`id`, `unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`) VALUES
(1, 'NuY1C4oJM4', 3, 'RFE-XX1E', 'White Gold Pendant', 10, 15, 1.2, 5, 1, 'VVS1', 1, 1, 10, 20, 10, 4, 'pendant_1_0.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.');

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
  `total_carat_weight` float NOT NULL COMMENT 'varchar 11',
  `no_of_stones` int(11) NOT NULL COMMENT 'int 11',
  `diamond_shape` int(11) NOT NULL COMMENT 'int 11',
  `clarity` varchar(11) NOT NULL COMMENT 'varchar 11',
  `color` int(11) NOT NULL COMMENT 'int 11',
  `material` int(11) NOT NULL COMMENT 'int 11',
  `height` float NOT NULL COMMENT 'varchar 11',
  `width` float NOT NULL COMMENT 'varchat 11',
  `length` float NOT NULL COMMENT 'varchar 11',
  `country_id` int(11) NOT NULL COMMENT 'int 11',
  `images` varchar(1024) NOT NULL COMMENT 'varchar 1024',
  `description` varchar(250) NOT NULL COMMENT 'varchar 250',
  `ring_subcategory` int(11) NOT NULL COMMENT 'int 11',
  `ring_size` varchar(128) NOT NULL COMMENT 'varchar 128',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_key` (`unique_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `rings`
--

INSERT INTO `rings` (`id`, `unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`, `ring_subcategory`, `ring_size`) VALUES
(1, 'HXh9tCXQxz', 3, 'RFE-XX1E', 'White Gold Ring', 10, 15, 1.2, 5, 1, 'VVS1', 1, 1, 10, 20, 10, 4, 'ring_1_0.jpg,ring_1_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50'),
(2, 'hNn1wk5c1L', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, 1.2, 5, 1, 'VVS1', 1, 1, 10, 20, 10, 4, 'ring_2_0.jpg,ring_2_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50-70'),
(3, 'GmNqWEEfXu', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, 1.2, 5, 1, 'VVS1', 1, 1, 10, 20, 10, 4, 'ring_3_0.jpg,ring_3_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50,52-54, 58 - 62');

-- --------------------------------------------------------

--
-- Table structure for table `ring_subcategory`
--

CREATE TABLE IF NOT EXISTS `ring_subcategory` (
  `id` int(11) NOT NULL,
  `category` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ring_subcategory`
--

INSERT INTO `ring_subcategory` (`id`, `category`) VALUES
(1, 'Diamond Ring'),
(2, 'Half Eternity Diamond Ring'),
(3, 'Full Eternity Diamond Ring'),
(4, 'Solitaire Diamond Ring'),
(5, 'Gems Ring'),
(6, 'Pearls Ring');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `hash` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `hash`) VALUES
(4, 'princebhanwra@gmail.com', '359CDC10CE64DDADDE8507E79CF32CB4');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_table`
--

CREATE TABLE IF NOT EXISTS `tmp_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11',
  `unique_key` varchar(11) NOT NULL,
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
  `description` varchar(250) NOT NULL COMMENT 'varchar 250',
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
(1, '1.0.0', '1.0.0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

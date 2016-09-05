-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2016 at 02:14 AM
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
  `cart` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Email` (`email`,`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `username`, `password`, `first_name`, `last_name`, `mobileno`, `address`, `favorites`, `type`, `cart`) VALUES
(1, 'test@test', 'Test', 'test', '', '', 0, '', '', 0, ''),
(15, 'admin@admin', 'Admin', 'admin', '', '', 0, '', ',v0JWl654E4,t9D08940x9', 1, 'ZKtu6G3VjN|0|4,'),
(19, 'user@user', 'User', 'user', 'John', 'Doe', 911, '404 Not Found', ',24TGoOjMXC,Vgg21LyVRF', 0, '');

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
  `description` varchar(300) NOT NULL COMMENT 'varchar 300',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_key` (`unique_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bracelets`
--

INSERT INTO `bracelets` (`id`, `unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`, `date_added`) VALUES
(1, 't9D08940x9', 3, '', 'Gold Twist', 10, 10, '1', 0, 1, 'FL', 1, 1, '', '', '', 15, 'bracelet_1.jpg,bracelet_1_1.jpg,bracelet_1_2.jpg,bracelet_1_3.jpg,', '', '0000-00-00 00:00:00');

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
(1, 'Yellow Gold'),
(2, 'White Gold'),
(3, 'Pink Gold');

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
  `description` varchar(300) NOT NULL COMMENT 'varchar 300',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_key` (`unique_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `earrings`
--

INSERT INTO `earrings` (`id`, `unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`, `date_added`) VALUES
(1, 'hWXjamrgNj', 3, 'INT-ID-RSE', 'Rose Earrings', 5, 10, '', 0, 1, 'FL', 1, 2, '', '', '', 12, 'earring_1.jpg,', 'Earrings Shaped like a flower to comment the beauty of the wearer in an elegant fashion.', '0000-00-00 00:00:00');

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
  `category` int(11) NOT NULL COMMENT '1 = Rings; 2 = Earrings; 3 = Pendants; 4 = Necklaces; 5 = Bracelets;',
  `featured` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Item Name` (`item_name`),
  UNIQUE KEY `key` (`unique_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `unique_key`, `item_name`, `item_value`, `discount`, `category`, `featured`, `date_added`) VALUES
(4, 'v0JWl654E4', 'Yellow Gold Band', '250.00', '15', 1, 1, '2016-09-03 03:16:14'),
(6, 'rqNM1ENwTa', 'Trinity Ring', '290.00', '10', 1, 1, '2016-09-03 04:00:35'),
(7, '5TnQfIatip', 'White Gold Band', '200.00', '0', 1, 0, '2016-09-03 17:26:45'),
(8, 't9D08940x9', 'Gold Twist', '100.00', '0', 5, 1, '2016-09-03 17:32:26'),
(9, 'ZKtu6G3VjN', 'Mixed Duo', '150.00', '10', 3, 1, '2016-09-03 17:37:20'),
(10, 'hWXjamrgNj', 'Rose Earrings', '140.00', '0', 2, 0, '2016-09-03 17:42:24'),
(11, 'xIzLLPRec1', 'Elegant Round', '200.00', '0', 4, 0, '2016-09-03 17:45:18');

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `last_login` varchar(128) NOT NULL,
  `login_ip` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `moderator_login`
--

INSERT INTO `moderator_login` (`id`, `username`, `last_login`, `login_ip`) VALUES
(1, 'Admin', '2016-09-01 23:42:44', '::1'),
(2, 'Admin', '2016-09-01 23:44:23', '::1'),
(3, 'Admin', '2016-09-02 03:34:31', '::1'),
(4, 'Admin', '2016-09-02 22:34:32', '::1');

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
  `description` varchar(300) NOT NULL COMMENT 'varchar 300',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_key` (`unique_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `necklaces`
--

INSERT INTO `necklaces` (`id`, `unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`, `date_added`) VALUES
(1, 'xIzLLPRec1', 5, 'INT-ID-ERN', 'Elegant Round', 10, 10, '', 0, 1, 'FL', 1, 2, '', '', '', 7, 'necklace_1.jpg,', 'A round necklace to embrace yourself with the beauty of natural white gold.', '0000-00-00 00:00:00');

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
  `description` varchar(300) NOT NULL COMMENT 'varchar 300',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_key` (`unique_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pendants`
--

INSERT INTO `pendants` (`id`, `unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`, `date_added`) VALUES
(1, 'ZKtu6G3VjN', 1, 'INT-ID-MXP', 'Mixed Duo', 10, 10, '', 0, 1, 'FL', 1, 2, '', '', '', 5, 'pendant_1.jpg,pendant_1_1.jpg,pendant_1_2.jpg,pendant_1_3.jpg,', 'A combination of two twin pendants, made from different materials contrasting each other in a perfect fashion.', '0000-00-00 00:00:00');

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_key` (`unique_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `rings`
--

INSERT INTO `rings` (`id`, `unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`, `ring_subcategory`, `ring_size`, `date_added`) VALUES
(4, 'v0JWl654E4', 2, '', 'Yellow Gold Band', 10, 12, '', 0, 1, 'VVS1', 1, 1, '', '', '', 4, 'ring_4.jpg,ring_4_1.jpg,ring_4_2.jpg,', 'Test test test test test test test test test etst est est est est e Test test test test test test test test test etst est est est est eTest test test test test test test test test etst est est est est e Test test test test test test test test test te', 1, '56,57,58,59,60', '0000-00-00 00:00:00'),
(6, 'rqNM1ENwTa', 3, '', 'Trinity Ring', 3, 10, '', 0, 1, 'FL', 1, 3, '', '', '', 10, 'ring_6.jpg,', '', 4, '50,59,60', '0000-00-00 00:00:00'),
(7, '5TnQfIatip', 1, '', 'White Gold Band', 10, 10, '', 0, 1, 'IF', 1, 5, '', '', '', 4, 'ring_7.jpg,ring_7_1.jpg,ring_7_2.jpg,ring_7_3.jpg,', '', 3, '50,60,62', '0000-00-00 00:00:00');

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
(1, 'Yellow Gold'),
(2, 'White Gold'),
(3, 'Pink Gold');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

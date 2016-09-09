-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2016 at 11:59 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `username`, `password`, `first_name`, `last_name`, `mobileno`, `address`, `favorites`, `type`, `cart`, `activated`, `verification_hash`) VALUES
(1, 'test@test', 'Test', 'test', '', '', '0', '', '', 0, '', 0, ''),
(15, 'admin@admin', 'Admin', 'admin', 'John', 'Doe', '9815408469', 'Flat No, Street, Town, State, 121001', '', 2, 'SIkxVadMdE|53|5,SIkxVadMdE|50|2,', 1, ''),
(19, 'user@user', 'User', 'user', 'John', 'Doe', '911', '404 Not Found', ',24TGoOjMXC,Vgg21LyVRF', 0, '', 0, ''),
(28, 'ryan.bhanwra@yahoo.com', 'Ryan', 'test123', 'Ryan', 'Bhanwra123', '98745641235', 'Flat 123, Town 987, City kek', ',5jSU7jRuWp,yirc4htVOK', 1, 'PImzpiKfGs|0|3,5jSU7jRuWp|0|1,', 1, ''),
(29, 'ryan.bhanwra@gmail.com', 'MailTest', 'testPass', '', '', '', '', '', 0, '', 1, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `bracelets`
--

INSERT INTO `bracelets` (`id`, `unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`, `date_added`) VALUES
(1, 'L4bqF1CGif', 5, 'RFE-XX1E', 'White Gold Bracelet', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'bracelet_1_0.jpg,bracelet_1_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', '0000-00-00 00:00:00'),
(2, 'PImzpiKfGs', 5, 'RFE-XX1E', 'White Gold Bracelet', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'bracelet_2_0.jpg,bracelet_2_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', '0000-00-00 00:00:00'),
(3, 'vfgKh6EPs1', 5, 'RFE-XX1E', 'White Gold Bracelet', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'bracelet_3_0.jpg,bracelet_3_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', '0000-00-00 00:00:00'),
(4, 'GOCICGT92Z', 5, 'RFE-XX1E', 'White Gold Bracelet', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'bracelet_4_0.jpg,bracelet_4_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', '0000-00-00 00:00:00');

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
-- Table structure for table `country_vat`
--

CREATE TABLE IF NOT EXISTS `country_vat` (
  `id` int(11) NOT NULL,
  `country_name` varchar(128) NOT NULL,
  `vat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country_vat`
--

INSERT INTO `country_vat` (`id`, `country_name`, `vat`) VALUES
(1, 'Austria', 20),
(2, 'Belgium', 21),
(3, 'Bulgaria', 20),
(4, 'Croatia', 25),
(5, 'Cyprus', 19),
(6, 'Czech Republic', 21),
(7, 'Denmark', 25),
(8, 'Estonia', 20),
(9, 'Finland', 24),
(10, 'France', 20),
(11, 'Germany', 19),
(12, 'Greece', 23),
(13, 'Hungary', 27),
(14, 'Ireland', 23),
(15, 'Italy', 22),
(16, 'Latvia', 21),
(17, 'Lithuania', 21),
(18, 'Luxembourg', 17),
(19, 'Malta', 18),
(20, 'Netherlands', 21),
(21, 'Poland', 23),
(22, 'Portugal', 23),
(23, 'Romania', 20),
(24, 'Slovakia', 20),
(25, 'Slovenia', 22),
(26, 'Spain', 21),
(27, 'Sweden', 25),
(28, 'UK', 20),
(1, 'Austria', 20),
(2, 'Belgium', 21),
(3, 'Bulgaria', 20),
(4, 'Croatia', 25),
(5, 'Cyprus', 19),
(6, 'Czech Republic', 21),
(7, 'Denmark', 25),
(8, 'Estonia', 20),
(9, 'Finland', 24),
(10, 'France', 20),
(11, 'Germany', 19),
(12, 'Greece', 23),
(13, 'Hungary', 27),
(14, 'Ireland', 23),
(15, 'Italy', 22),
(16, 'Latvia', 21),
(17, 'Lithuania', 21),
(18, 'Luxembourg', 17),
(19, 'Malta', 18),
(20, 'Netherlands', 21),
(21, 'Poland', 23),
(22, 'Portugal', 23),
(23, 'Romania', 20),
(24, 'Slovakia', 20),
(25, 'Slovenia', 22),
(26, 'Spain', 21),
(27, 'Sweden', 25),
(28, 'UK', 20);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `earrings`
--

INSERT INTO `earrings` (`id`, `unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`, `date_added`) VALUES
(1, 'nTnQEqWXBv', 2, 'RFE-XX1E', 'White Gold Earring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'earring_1_0.jpg,earring_1_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', '0000-00-00 00:00:00'),
(2, 'WLjphkF5FE', 2, 'RFE-XX1E', 'White Gold Earring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 2, '10', '20', '10', 4, 'earring_2_0.jpg,earring_2_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', '0000-00-00 00:00:00'),
(3, 'a82jOb6jaE', 2, 'RFE-XX1E', 'White Gold Earring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'earring_3_0.jpg,earring_3_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', '0000-00-00 00:00:00'),
(4, 'am3y1OavCf', 2, 'RFE-XX1E', 'White Gold Earring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'earring_4_0.jpg,earring_4_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_key` varchar(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_value` varchar(11) NOT NULL,
  `discount` varchar(11) DEFAULT '0',
  `category` int(11) NOT NULL COMMENT '1 = Rings; 2 = Earrings; 3 = Pendants; 4 = Necklaces; 5 = Bracelets;',
  `featured` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`unique_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `unique_key`, `item_name`, `item_value`, `discount`, `category`, `featured`, `date_added`) VALUES
(1, 'xg2dLIIJLf', 'White Gold Ring', '100', '20', 1, 1, '2016-09-09 01:15:43'),
(2, 'nTnQEqWXBv', 'White Gold Earring', '100', '20', 2, 1, '2016-09-09 01:15:46'),
(3, 'jARUQauOlH', 'White Gold Pendant', '100', '20', 3, 1, '2016-09-09 01:15:48'),
(4, '5WcCLwdV5h', 'White Gold Necklace', '100', '20', 4, 1, '2016-09-09 01:15:50'),
(5, 'L4bqF1CGif', 'White Gold Bracelet', '200.00', '20', 5, 1, '2016-09-09 01:15:52'),
(6, '2YxtlkOXUy', 'White Gold Ring', '2000.00', '20', 1, 1, '2016-09-09 01:17:43'),
(7, 'WLjphkF5FE', 'White Gold Earring', '200.00', '20', 2, 1, '2016-09-09 01:17:46'),
(8, 'yirc4htVOK', 'White Gold Pendant', '100', '20', 3, 1, '2016-09-09 01:17:50'),
(9, '5jSU7jRuWp', 'White Gold Necklace', '100', '20', 4, 1, '2016-09-09 01:17:52'),
(10, 'PImzpiKfGs', 'White Gold Bracelet', '100', '20', 5, 1, '2016-09-09 01:17:55'),
(11, 'nlAroa0FCD', 'White Gold Ring', '100', '20', 1, 0, '2016-09-10 02:26:29'),
(12, 'a82jOb6jaE', 'White Gold Earring', '100', '20', 2, 0, '2016-09-10 02:26:37'),
(13, 'NeWTz8mLqF', 'White Gold Pendant', '100', '20', 3, 0, '2016-09-10 02:26:42'),
(14, '7ANStdFn6Y', 'White Gold Necklace', '100', '20', 4, 0, '2016-09-10 02:26:47'),
(15, 'vfgKh6EPs1', 'White Gold Bracelet', '100', '20', 5, 0, '2016-09-10 02:26:52'),
(16, 'fsJ2bKqaFi', 'White Gold Ring', '100', '20', 1, 0, '2016-09-10 02:28:29'),
(17, 'am3y1OavCf', 'White Gold Earring', '100', '20', 2, 0, '2016-09-10 02:28:34'),
(18, 'nB1SvPQqUD', 'White Gold Pendant', '100', '20', 3, 0, '2016-09-10 02:28:38'),
(19, 'a7q0AFpqdi', 'White Gold Necklace', '100', '20', 4, 0, '2016-09-10 02:28:42'),
(20, 'GOCICGT92Z', 'White Gold Bracelet', '100', '20', 5, 0, '2016-09-10 02:28:47');

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
('Ryan', '2016-09-10 02:11:46', '::1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `necklaces`
--

INSERT INTO `necklaces` (`id`, `unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`, `date_added`) VALUES
(1, '5WcCLwdV5h', 4, 'RFE-XX1E', 'White Gold Necklace', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'necklace_1_0.jpg,necklace_1_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', '0000-00-00 00:00:00'),
(2, '5jSU7jRuWp', 4, 'RFE-XX1E', 'White Gold Necklace', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'necklace_2_0.jpg,necklace_2_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', '0000-00-00 00:00:00'),
(3, '7ANStdFn6Y', 4, 'RFE-XX1E', 'White Gold Necklace', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'necklace_3_0.jpg,necklace_3_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', '0000-00-00 00:00:00'),
(4, 'a7q0AFpqdi', 4, 'RFE-XX1E', 'White Gold Necklace', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'necklace_4_0.jpg,necklace_4_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `pendants`
--

INSERT INTO `pendants` (`id`, `unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`, `date_added`) VALUES
(1, 'jARUQauOlH', 3, 'RFE-XX1E', 'White Gold Pendant', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'pendant_1_0.jpg,pendant_1_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', '0000-00-00 00:00:00'),
(2, 'yirc4htVOK', 3, 'RFE-XX1E', 'White Gold Pendant', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'pendant_2_0.jpg,pendant_2_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', '0000-00-00 00:00:00'),
(3, 'NeWTz8mLqF', 3, 'RFE-XX1E', 'White Gold Pendant', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'pendant_3_0.jpg,pendant_3_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', '0000-00-00 00:00:00'),
(4, 'nB1SvPQqUD', 3, 'RFE-XX1E', 'White Gold Pendant', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'pendant_4_0.jpg,pendant_4_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `rings`
--

INSERT INTO `rings` (`id`, `unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`, `ring_subcategory`, `ring_size`, `date_added`) VALUES
(1, 'xg2dLIIJLf', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_1_0.jpg,ring_1_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(2, '2YxtlkOXUy', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'SI1', 2, 2, '10', '20', '10', 4, 'ring_2_0.jpg,ring_2_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 1, '50', '0000-00-00 00:00:00'),
(3, 'nlAroa0FCD', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_3_0.jpg,ring_3_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(4, 'fsJ2bKqaFi', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_4_0.jpg,ring_4_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00');

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

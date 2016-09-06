-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2016 at 07:54 PM
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
(15, 'admin@admin', 'Admin', 'admin', '', '', 0, '', ',v0JWl654E4,t9D08940x9', 1, ''),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `earrings`
--

INSERT INTO `earrings` (`id`, `unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`, `date_added`) VALUES
(14, 'NCWpJmycHi', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'earring_14_0.jpg,earring_14_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=385 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `unique_key`, `item_name`, `item_value`, `discount`, `category`, `featured`, `date_added`) VALUES
(352, 'SVDRzRqZb5', 'White Gold Ring', '100.00', '0', 1, 1, '2016-09-06 20:16:04'),
(353, 'NCWpJmycHi', 'White Gold Ring', '100.00', '0', 2, 1, '2016-09-06 20:16:21'),
(354, 'eiF0I26Bdg', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 21:30:55'),
(355, 'zrpZTl8IQ0', 'White Gold Ring', '100', '20', 1, 1, '2016-09-06 22:13:04'),
(356, '6C1aEcx1Co', 'White Gold Ring', '100', '20', 1, 1, '2016-09-06 22:13:51'),
(357, 'WhmFmcJ0nt', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:14:33'),
(358, '3S5jbf5srA', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:15:37'),
(359, 't6IRPZixfk', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:16:04'),
(360, '4BkPnuaJ2b', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:16:22'),
(361, 'mJoaZ3jpFr', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:17:37'),
(362, '8ls4HZZGlL', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:17:54'),
(363, 'kvUG5fKbl8', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:37:23'),
(364, 'HfIS7kgGQq', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:39:48'),
(365, 'BicZPU3Yxg', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:39:59'),
(366, 'KSNz7DeyvK', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:40:09'),
(367, 'UpKarTdnVb', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:40:20'),
(368, 'JkW1EuzDNQ', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:40:31'),
(369, 'rIxQDvHtJI', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:40:41'),
(370, 'DcQzbYyMGh', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:40:52'),
(371, 'Wy06DDsSHe', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:41:02'),
(372, 'UAK3GHQkEb', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:41:12'),
(373, 'CL8w9BYE1x', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:41:22'),
(374, 'x4lOEKH7E8', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:41:32'),
(375, 'cHocpfeqr0', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:41:42'),
(376, 'YGrkJjD4n7', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:53:04'),
(377, 'tQmbdtF5zi', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:53:06'),
(378, 'KWJczkstBl', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:53:08'),
(379, 'W0PBT7IazE', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:53:09'),
(380, 'dDEYO7nTtc', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:53:11'),
(381, 'sMEY7sl24i', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:53:12'),
(382, 'Ztw7zTehzn', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:53:14'),
(383, 'nCVwHt8qpG', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:53:15'),
(384, '9FdCrnm6Z6', 'White Gold Ring', '100', '20', 1, 0, '2016-09-06 22:53:17');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=339 ;

--
-- Dumping data for table `rings`
--

INSERT INTO `rings` (`id`, `unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_carat_weight`, `no_of_stones`, `diamond_shape`, `clarity`, `color`, `material`, `height`, `width`, `length`, `country_id`, `images`, `description`, `ring_subcategory`, `ring_size`, `date_added`) VALUES
(307, 'SVDRzRqZb5', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_307_0.jpg,ring_307_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(308, 'eiF0I26Bdg', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_308_0.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(309, 'zrpZTl8IQ0', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_309_0.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(310, '6C1aEcx1Co', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_310_0.jpg,ring_310_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(311, 'WhmFmcJ0nt', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_311_0.jpg,ring_311_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(312, '3S5jbf5srA', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_312_0.jpg,ring_312_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(313, 't6IRPZixfk', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_313_0.jpg,ring_313_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(314, '4BkPnuaJ2b', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_314_0.jpg,ring_314_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(315, 'mJoaZ3jpFr', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_315_0.jpg,ring_315_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(316, '8ls4HZZGlL', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_316_0.jpg,ring_316_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(317, 'kvUG5fKbl8', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_317_0.jpg,ring_317_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(318, 'HfIS7kgGQq', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_318_0.jpg,ring_318_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(319, 'BicZPU3Yxg', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_319_0.jpg,ring_319_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(320, 'KSNz7DeyvK', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_320_0.jpg,ring_320_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(321, 'UpKarTdnVb', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_321_0.jpg,ring_321_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(322, 'JkW1EuzDNQ', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_322_0.jpg,ring_322_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(323, 'rIxQDvHtJI', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_323_0.jpg,ring_323_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(324, 'DcQzbYyMGh', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_324_0.jpg,ring_324_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(325, 'Wy06DDsSHe', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_325_0.jpg,ring_325_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(326, 'UAK3GHQkEb', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_326_0.jpg,ring_326_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(327, 'CL8w9BYE1x', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_327_0.jpg,ring_327_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(328, 'x4lOEKH7E8', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_328_0.jpg,ring_328_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(329, 'cHocpfeqr0', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, '', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(330, 'YGrkJjD4n7', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_330_0.jpg,ring_330_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(331, 'tQmbdtF5zi', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_331_0.jpg,ring_331_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(332, 'KWJczkstBl', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_332_0.jpg,ring_332_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(333, 'W0PBT7IazE', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_333_0.jpg,ring_333_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(334, 'dDEYO7nTtc', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_334_0.jpg,ring_334_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(335, 'sMEY7sl24i', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_335_0.jpg,ring_335_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(336, 'Ztw7zTehzn', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_336_0.jpg,ring_336_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(337, 'nCVwHt8qpG', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_337_0.jpg,ring_337_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00'),
(338, '9FdCrnm6Z6', 1, 'RFE-XX1E', 'White Gold Ring', 10, 15, '1.2', 5, 1, 'VVS1', 1, 1, '10', '20', '10', 4, 'ring_338_0.jpg,ring_338_1.jpg,', 'Precious white gold ring for with 1 main stone + 4 side stones. Suitable for anniversary, birthday or any other occasion.', 4, '50', '0000-00-00 00:00:00');

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

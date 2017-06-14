-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 14, 2017 at 08:38 AM
-- Server version: 10.2.5-MariaDB-log
-- PHP Version: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diam_prince`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `site_id` int(11) DEFAULT NULL COMMENT 'ID value from tb_websites, use for appropriate website whilst registering',
  `email` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128) NOT NULL,
  `mobileno` varchar(20) NOT NULL,
  `address` varchar(128) NOT NULL,
  `favorites` varchar(128) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT 0 COMMENT '0:Standard User, 1:Admin',
  `cart` varchar(128) DEFAULT NULL,
  `activated` int(11) NOT NULL DEFAULT 0,
  `verification_hash` varchar(128) DEFAULT NULL,
  `recover_hash` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `site_id`, `email`, `username`, `password`, `first_name`, `last_name`, `mobileno`, `address`, `favorites`, `type`, `cart`, `activated`, `verification_hash`, `recover_hash`) VALUES
(1, 1, 'contact@diamantsecret.com', 'Admin', 'admin123', 'Admin', '', '032985866', 'Hoveniersstraat 30 Suite: 924, 2018 Antwerpen - Belgium', ',GtrYXhKaxf', 1, 'E07lak14Th|0|1,wssTdLCXeD|0|2,', 1, '', ''),
(2, 2, 'contact@operabijoux.com', 'Admin', 'admin123', 'Admin', '', '032985866', 'Hoveniersstraat 30 Suite: 924, 2018 Antwerpen - Belgium', '', 1, 'E07lak14Th|0|1,wssTdLCXeD|0|2,', 1, '', ''),
(3, 1, 'ryan.bhanwra@yahoo.com', 'karan', '123456', 'Karan', 'Bhanwra', '98756', '123123 test', ',hoMBQnGaSO,6CPzcb8eHG', 0, '', 1, '', ''),
(7, 2, 'ryan.bhanwra@gmail.com', 'RBhan', '123123', 'Karan', 'Bh', '123123', '123123', NULL, 0, NULL, 1, '', '4FD9D8F51E1DCD5450C916B3A87184C5');

-- --------------------------------------------------------

--
-- Table structure for table `bracelets`
--

CREATE TABLE `bracelets` (
  `id` int(11) NOT NULL COMMENT 'int 11',
  `unique_key` varchar(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL COMMENT 'int 11',
  `internal_id` varchar(11) DEFAULT NULL COMMENT 'varchar 11',
  `product_name` varchar(50) DEFAULT NULL COMMENT 'varchat 50',
  `pieces_in_stock` int(11) DEFAULT NULL COMMENT 'int 11',
  `days_for_shipment` int(11) DEFAULT NULL COMMENT 'int 11',
  `total_gold_weight` varchar(32) DEFAULT NULL,
  `total_carat_weight` float DEFAULT NULL COMMENT 'varchar 11',
  `color_stone_carat` float DEFAULT NULL,
  `no_of_stones` int(11) DEFAULT NULL COMMENT 'int 11',
  `no_of_color_stones` int(11) DEFAULT NULL,
  `diamond_shape` int(11) DEFAULT NULL COMMENT 'int 11',
  `color_stone_shape` int(11) DEFAULT NULL,
  `clarity` varchar(11) DEFAULT NULL COMMENT 'varchar 11',
  `color` int(11) DEFAULT NULL COMMENT 'int 11',
  `material` int(11) DEFAULT NULL COMMENT 'int 11',
  `gold_quality` varchar(32) DEFAULT NULL,
  `color_stone_type` varchar(32) DEFAULT NULL,
  `height` varchar(30) DEFAULT NULL COMMENT 'varchar 30',
  `width` varchar(30) DEFAULT NULL COMMENT 'varchat 30',
  `length` varchar(30) DEFAULT NULL COMMENT 'varchar 30',
  `country_id` int(11) DEFAULT NULL COMMENT 'int 11',
  `subcategory` int(11) DEFAULT NULL,
  `lab_grown` int(11) DEFAULT NULL COMMENT '1 = true; 0 = false',
  `images` varchar(1024) DEFAULT NULL COMMENT 'varchar 1024',
  `description` varchar(300) DEFAULT NULL COMMENT 'varchar 300',
  `ring_subcategory` int(11) DEFAULT NULL COMMENT 'int 11',
  `ring_size` varchar(128) DEFAULT NULL COMMENT 'varchar 128',
  `description_french` varchar(250) DEFAULT NULL,
  `diamond_color` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(64) NOT NULL
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
-- Table structure for table `clarity`
--

CREATE TABLE `clarity` (
  `id` int(11) NOT NULL,
  `clarity` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clarity`
--

INSERT INTO `clarity` (`id`, `clarity`) VALUES
(1, 'FL'),
(2, 'IF'),
(3, 'VVS1'),
(4, 'VVS2'),
(5, 'VS1'),
(6, 'VS2'),
(7, 'SI1'),
(8, 'SI2'),
(9, 'SI3'),
(10, 'I1');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `color` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`id`, `color`) VALUES
(1, 'Diamond'),
(2, 'Color Stone'),
(3, 'Diamond & Color Stone'),
(4, 'Gold');

-- --------------------------------------------------------

--
-- Table structure for table `company_id`
--

CREATE TABLE `company_id` (
  `id` int(11) NOT NULL,
  `company_code` varchar(32) NOT NULL,
  `company_name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `mobileno` varchar(128) NOT NULL,
  `address` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_id`
--

INSERT INTO `company_id` (`id`, `company_code`, `company_name`, `email`, `mobileno`, `address`) VALUES
(2, 'EA STARTS', 'EA STARTS', 'EA STARTS', 'EA STARTS', 'EA STARTS');

-- --------------------------------------------------------

--
-- Table structure for table `country_vat`
--

CREATE TABLE `country_vat` (
  `tm` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `country_name` varchar(128) NOT NULL,
  `vat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `diamonds` (
  `id` int(11) NOT NULL,
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
  `details` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `diamond_color`
--

CREATE TABLE `diamond_color` (
  `id` int(11) NOT NULL,
  `diamond_color` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diamond_color`
--

INSERT INTO `diamond_color` (`id`, `diamond_color`) VALUES
(1, 'D'),
(2, 'E'),
(3, 'F'),
(4, 'G'),
(5, 'H'),
(6, 'I'),
(7, 'J'),
(8, 'K');

-- --------------------------------------------------------

--
-- Table structure for table `diamond_shape`
--

CREATE TABLE `diamond_shape` (
  `id` int(11) NOT NULL,
  `category` varchar(64) NOT NULL
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

CREATE TABLE `earrings` (
  `id` int(11) NOT NULL COMMENT 'int 11',
  `unique_key` varchar(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL COMMENT 'int 11',
  `internal_id` varchar(11) DEFAULT NULL COMMENT 'varchar 11',
  `product_name` varchar(50) DEFAULT NULL COMMENT 'varchat 50',
  `pieces_in_stock` int(11) DEFAULT NULL COMMENT 'int 11',
  `days_for_shipment` int(11) DEFAULT NULL COMMENT 'int 11',
  `total_gold_weight` varchar(32) DEFAULT NULL,
  `total_carat_weight` float DEFAULT NULL COMMENT 'varchar 11',
  `color_stone_carat` float DEFAULT NULL,
  `no_of_stones` int(11) DEFAULT NULL COMMENT 'int 11',
  `no_of_color_stones` int(11) DEFAULT NULL,
  `diamond_shape` int(11) DEFAULT NULL COMMENT 'int 11',
  `color_stone_shape` int(11) DEFAULT NULL,
  `clarity` varchar(11) DEFAULT NULL COMMENT 'varchar 11',
  `color` int(11) DEFAULT NULL COMMENT 'int 11',
  `material` int(11) DEFAULT NULL COMMENT 'int 11',
  `gold_quality` varchar(32) DEFAULT NULL,
  `color_stone_type` varchar(255) DEFAULT NULL,
  `height` varchar(30) DEFAULT NULL COMMENT 'varchar 30',
  `width` varchar(30) DEFAULT NULL COMMENT 'varchat 30',
  `length` varchar(30) DEFAULT NULL COMMENT 'varchar 30',
  `country_id` int(11) DEFAULT NULL COMMENT 'int 11',
  `subcategory` int(11) DEFAULT NULL,
  `lab_grown` int(11) DEFAULT NULL COMMENT '1 = true; 0 = false',
  `images` varchar(1024) DEFAULT NULL COMMENT 'varchar 1024',
  `description` varchar(300) DEFAULT NULL COMMENT 'varchar 300',
  `ring_subcategory` int(11) DEFAULT NULL COMMENT 'int 11',
  `ring_size` varchar(128) DEFAULT NULL COMMENT 'varchar 128',
  `description_french` varchar(250) DEFAULT NULL,
  `diamond_color` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gold_quality`
--

CREATE TABLE `gold_quality` (
  `id` int(11) NOT NULL,
  `gold_quality` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gold_quality`
--

INSERT INTO `gold_quality` (`id`, `gold_quality`) VALUES
(1, '22k'),
(2, '18k'),
(3, '14k'),
(4, '9k');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `unique_key` varchar(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_value` float NOT NULL,
  `discount` float DEFAULT 0,
  `category` int(11) NOT NULL COMMENT '1 = Rings; 2 = Earrings; 3 = Pendants; 4 = Necklaces; 5 = Bracelets;',
  `featured` int(11) NOT NULL,
  `images_delta` text DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `disabled` int(11) NOT NULL DEFAULT 0 COMMENT 'A disabled item is not visible in any front end, but is visible on the backend.',
  `site_0` int(11) NOT NULL DEFAULT 0,
  `site_1` int(11) NOT NULL DEFAULT 0,
  `site_2` int(11) NOT NULL DEFAULT 0,
  `site_3` int(11) NOT NULL DEFAULT 0,
  `site_4` int(11) NOT NULL DEFAULT 0,
  `site_5` int(11) NOT NULL DEFAULT 0,
  `site_6` int(11) NOT NULL DEFAULT 0,
  `site_7` int(11) NOT NULL DEFAULT 0,
  `family` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `unique_key`, `item_name`, `item_value`, `discount`, `category`, `featured`, `images_delta`, `date_added`, `disabled`, `site_0`, `site_1`, `site_2`, `site_3`, `site_4`, `site_5`, `site_6`, `site_7`, `family`) VALUES
(77, '8VPffS6MG3', 'Ganiela', 871000, NULL, 1, 0, '1.jpg', '2017-06-14 12:39:21', 0, 1, 1, 1, 1, 0, 0, 1, 1, 'one'),
(78, 'bNQZjKcXcM', 'Gilea', 851, NULL, 1, 0, '1.jpg', '2017-06-14 12:39:22', 0, 0, 0, 0, 1, 0, 1, 0, 0, 'two'),
(79, 'nuAJeyfiHY', 'Pleka', 420, NULL, 1, 0, '1.jpg', '2017-06-14 12:39:23', 0, 0, 0, 1, 0, 0, 0, 0, 0, 'three'),
(80, '8qBQkksCkM', 'Ganiela', 871000, NULL, 1, 0, '1.jpg', '2017-06-14 13:09:17', 0, 1, 1, 1, 1, 0, 0, 1, 1, 'one'),
(81, 'RxOKMijCDW', 'Gilea', 851, NULL, 1, 0, '1.jpg', '2017-06-14 13:09:17', 0, 0, 0, 0, 1, 0, 1, 0, 0, 'two'),
(82, '8XimZfdQQZ', 'Pleka', 420, NULL, 1, 0, '1.jpg', '2017-06-14 13:09:18', 0, 0, 0, 1, 0, 0, 0, 0, 0, 'three');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(11) NOT NULL,
  `category` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `category`) VALUES
(1, 'Yellow Gold'),
(2, 'White Gold'),
(3, 'Rose Gold'),
(4, 'Silver'),
(5, 'Platinum'),
(6, 'Bi Colour with Gold'),
(7, 'Three Colour with Gold'),
(8, 'Black Metal');

-- --------------------------------------------------------

--
-- Table structure for table `min_max_values`
--

CREATE TABLE `min_max_values` (
  `id` int(11) NOT NULL,
  `keys_name` varchar(255) NOT NULL,
  `keys_values` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `min_max_values`
--

INSERT INTO `min_max_values` (`id`, `keys_name`, `keys_values`, `created_at`) VALUES
(10, 'family', '[\"one\",\"two\",\"three\"]', '2017-06-14 05:02:47');

-- --------------------------------------------------------

--
-- Table structure for table `moderator_login`
--

CREATE TABLE `moderator_login` (
  `username` varchar(128) NOT NULL,
  `last_login` varchar(128) NOT NULL,
  `login_ip` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `moderator_login`
--

INSERT INTO `moderator_login` (`username`, `last_login`, `login_ip`) VALUES
('Admin', '2017-03-05 16:11:35', '::1'),
('Admin', '2017-03-15 22:18:36', '::1'),
('Admin', '2017-03-18 15:22:51', '::1'),
('Admin', '2017-03-22 21:40:12', '::1'),
('Admin', '2017-03-23 22:09:02', '::1'),
('Admin', '2017-03-31 09:02:39', '::1'),
('Admin', '2017-04-01 13:58:14', '::1'),
('Admin', '2017-04-01 15:43:20', '::1'),
('Admin', '2017-04-02 18:03:58', '::1'),
('Admin', '2017-04-03 18:31:33', '::1'),
('Admin', '2017-04-05 23:18:10', '::1'),
('Admin', '2017-04-07 18:13:02', '::1'),
('Admin', '2017-04-09 14:46:30', '::1'),
('Admin', '2017-04-09 15:04:43', '::1'),
('Admin', '2017-04-12 12:26:25', '::1'),
('Admin', '2017-04-16 01:43:03', '::1'),
('Admin', '2017-04-23 19:20:58', '::1'),
('Admin', '2017-04-23 19:23:17', '::1'),
('Admin', '2017-04-23 19:25:38', '::1'),
('Admin', '2017-04-23 21:38:27', '::1'),
('Admin', '2017-04-24 00:32:20', '::1'),
('Admin', '2017-05-05 23:48:36', '::1'),
('Admin', '2017-05-06 01:30:08', '::1'),
('Admin', '2017-05-17 05:56:14', '::1'),
('Admin', '2017-05-23 03:41:20', '::1'),
('Admin', '2017-06-13 17:14:45', '::1'),
('Admin', '2017-06-14 12:58:19', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `necklaces`
--

CREATE TABLE `necklaces` (
  `id` int(11) NOT NULL COMMENT 'int 11',
  `unique_key` varchar(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL COMMENT 'int 11',
  `internal_id` varchar(11) DEFAULT NULL COMMENT 'varchar 11',
  `product_name` varchar(50) DEFAULT NULL COMMENT 'varchat 50',
  `pieces_in_stock` int(11) DEFAULT NULL COMMENT 'int 11',
  `days_for_shipment` int(11) DEFAULT NULL COMMENT 'int 11',
  `total_gold_weight` varchar(32) DEFAULT NULL,
  `total_carat_weight` float DEFAULT NULL COMMENT 'varchar 11',
  `color_stone_carat` float DEFAULT NULL,
  `no_of_stones` int(11) DEFAULT NULL COMMENT 'int 11',
  `no_of_color_stones` int(11) DEFAULT NULL,
  `diamond_shape` int(11) DEFAULT NULL COMMENT 'int 11',
  `color_stone_shape` int(11) DEFAULT NULL,
  `clarity` varchar(11) DEFAULT NULL COMMENT 'varchar 11',
  `color` int(11) DEFAULT NULL COMMENT 'int 11',
  `material` int(11) DEFAULT NULL COMMENT 'int 11',
  `gold_quality` varchar(32) DEFAULT NULL,
  `color_stone_type` varchar(255) DEFAULT NULL,
  `height` varchar(30) DEFAULT NULL COMMENT 'varchar 30',
  `width` varchar(30) DEFAULT NULL COMMENT 'varchat 30',
  `length` varchar(30) DEFAULT NULL COMMENT 'varchar 30',
  `country_id` int(11) DEFAULT NULL COMMENT 'int 11',
  `subcategory` int(11) DEFAULT NULL,
  `lab_grown` int(11) DEFAULT NULL COMMENT '1 = true; 0 = false',
  `images` varchar(1024) DEFAULT NULL COMMENT 'varchar 1024',
  `description` varchar(300) DEFAULT NULL COMMENT 'varchar 300',
  `ring_subcategory` int(11) DEFAULT NULL COMMENT 'int 11',
  `ring_size` varchar(128) DEFAULT NULL COMMENT 'varchar 128',
  `description_french` varchar(250) DEFAULT NULL,
  `diamond_color` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pendants`
--

CREATE TABLE `pendants` (
  `id` int(11) NOT NULL COMMENT 'int 11',
  `unique_key` varchar(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL COMMENT 'int 11',
  `internal_id` varchar(11) DEFAULT NULL COMMENT 'varchar 11',
  `product_name` varchar(50) DEFAULT NULL COMMENT 'varchat 50',
  `pieces_in_stock` int(11) DEFAULT NULL COMMENT 'int 11',
  `days_for_shipment` int(11) DEFAULT NULL COMMENT 'int 11',
  `total_gold_weight` varchar(32) DEFAULT NULL,
  `total_carat_weight` float DEFAULT NULL COMMENT 'varchar 11',
  `color_stone_carat` float DEFAULT NULL,
  `no_of_stones` int(11) DEFAULT NULL COMMENT 'int 11',
  `no_of_color_stones` int(11) DEFAULT NULL,
  `diamond_shape` int(11) DEFAULT NULL COMMENT 'int 11',
  `color_stone_shape` int(11) DEFAULT NULL,
  `clarity` varchar(11) DEFAULT NULL COMMENT 'varchar 11',
  `color` int(11) DEFAULT NULL COMMENT 'int 11',
  `material` int(11) DEFAULT NULL COMMENT 'int 11',
  `gold_quality` varchar(32) DEFAULT NULL,
  `color_stone_type` varchar(255) DEFAULT NULL,
  `height` varchar(30) DEFAULT NULL COMMENT 'varchar 30',
  `width` varchar(30) DEFAULT NULL COMMENT 'varchat 30',
  `length` varchar(30) DEFAULT NULL COMMENT 'varchar 30',
  `country_id` int(11) DEFAULT NULL COMMENT 'int 11',
  `subcategory` int(11) DEFAULT NULL,
  `lab_grown` int(11) DEFAULT NULL COMMENT '1 = true; 0 = false',
  `images` varchar(1024) DEFAULT NULL COMMENT 'varchar 1024',
  `description` varchar(300) DEFAULT NULL COMMENT 'varchar 300',
  `ring_subcategory` int(11) DEFAULT NULL COMMENT 'int 11',
  `ring_size` varchar(128) DEFAULT NULL COMMENT 'varchar 128',
  `description_french` varchar(250) DEFAULT NULL,
  `diamond_color` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rings`
--

CREATE TABLE `rings` (
  `id` int(11) NOT NULL COMMENT 'int 11',
  `unique_key` varchar(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL COMMENT 'int 11',
  `internal_id` varchar(11) DEFAULT NULL COMMENT 'varchar 11',
  `product_name` varchar(50) DEFAULT NULL COMMENT 'varchat 50',
  `pieces_in_stock` int(11) DEFAULT NULL COMMENT 'int 11',
  `days_for_shipment` int(11) DEFAULT NULL COMMENT 'int 11',
  `total_gold_weight` varchar(32) DEFAULT NULL,
  `total_carat_weight` float DEFAULT NULL COMMENT 'varchar 11',
  `color_stone_carat` float DEFAULT NULL,
  `no_of_stones` int(11) DEFAULT NULL COMMENT 'int 11',
  `no_of_color_stones` int(11) DEFAULT NULL,
  `diamond_shape` int(11) DEFAULT NULL COMMENT 'int 11',
  `color_stone_shape` int(11) DEFAULT NULL,
  `clarity` varchar(11) DEFAULT NULL COMMENT 'varchar 11',
  `color` int(11) DEFAULT NULL COMMENT 'int 11',
  `material` int(11) DEFAULT NULL COMMENT 'int 11',
  `gold_quality` varchar(32) DEFAULT NULL,
  `color_stone_type` varchar(255) DEFAULT NULL,
  `height` varchar(30) DEFAULT NULL COMMENT 'varchar 30',
  `width` varchar(30) DEFAULT NULL COMMENT 'varchat 30',
  `length` varchar(30) DEFAULT NULL COMMENT 'varchar 30',
  `country_id` int(11) DEFAULT NULL COMMENT 'int 11',
  `subcategory` int(11) DEFAULT NULL,
  `lab_grown` int(11) DEFAULT NULL COMMENT '1 = true; 0 = false',
  `images` varchar(1024) DEFAULT NULL COMMENT 'varchar 1024',
  `description` varchar(250) DEFAULT NULL COMMENT 'varchar 250',
  `ring_subcategory` int(11) DEFAULT NULL COMMENT 'int 11',
  `ring_size` varchar(128) DEFAULT NULL COMMENT 'varchar 128',
  `description_french` varchar(300) DEFAULT NULL,
  `diamond_color` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rings`
--

INSERT INTO `rings` (`id`, `unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_gold_weight`, `total_carat_weight`, `color_stone_carat`, `no_of_stones`, `no_of_color_stones`, `diamond_shape`, `color_stone_shape`, `clarity`, `color`, `material`, `gold_quality`, `color_stone_type`, `height`, `width`, `length`, `country_id`, `subcategory`, `lab_grown`, `images`, `description`, `ring_subcategory`, `ring_size`, `description_french`, `diamond_color`) VALUES
(78, '8qBQkksCkM', 2, '65081R001A', 'Ganiela', 10000, 15, '0.9', 0.15, NULL, 34, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_78_0.jpg,', 'Tear Solitaire Ring in White gold set by 0,15ct diamonds. Testingsssssssssssssssss', 4, '48-65', 'Bague Solitaire Goutte en Or blanc sertie de 0,15ct de diamants.', 5),
(79, 'RxOKMijCDW', 2, '65081R002A', 'Gilea', 10000, 15, '0.8', 0.15, NULL, 34, 0, 1, 0, 'SI1', 1, 6, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_79_0.jpg,', 'Tear Solitaire Ring in Yellow gold set by 0,15ct diamonds.', 4, '48', 'Bague Solitaire Goutte en Or jaune sertie de 0,15ct de diamants.', 5),
(80, '8XimZfdQQZ', 2, '58607R007A', 'Pleka', 10000, 15, '1', 0.04, NULL, 14, 0, 1, 0, 'SI1', 1, 6, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_80_0.jpg,', 'Round Solitaire Ring in Yellow gold set by 0,04ct diamonds.', 4, '48', 'Bague Solitaire Rond Illusion en Or jaune sertie de 0,04ct de diamants.', 5);

-- --------------------------------------------------------

--
-- Table structure for table `ring_subcategory`
--

CREATE TABLE `ring_subcategory` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(33, 5, 'Pearl and Colored Stone Bracelet'),
(34, 1, 'Pieces in gold without any stone'),
(35, 2, 'Pieces in gold without any stone'),
(36, 3, 'Pieces in gold without any stone'),
(37, 4, 'Pieces in gold without any stone'),
(38, 5, 'Pieces in gold without any stone');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `site_id` varchar(128) NOT NULL COMMENT 'ID value from tb_websites, use for appropriate website whilst registering',
  `email` varchar(128) NOT NULL,
  `hash` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cart`
--

CREATE TABLE `tb_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` varchar(23) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` int(11) NOT NULL COMMENT 'If Applicable'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_cart`
--

INSERT INTO `tb_cart` (`id`, `user_id`, `product_id`, `quantity`, `size`) VALUES
(14, 3, '8VPffS6MG3', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_paypal_payments`
--

CREATE TABLE `tb_paypal_payments` (
  `#` int(11) NOT NULL,
  `id` varchar(64) NOT NULL,
  `token` varchar(32) NOT NULL,
  `state` varchar(32) NOT NULL,
  `cart` varchar(32) NOT NULL,
  `user` int(11) NOT NULL,
  `billing_address` varchar(512) NOT NULL,
  `shipping_address` varchar(512) NOT NULL,
  `payer_id` varchar(32) NOT NULL,
  `amount` float NOT NULL,
  `invoice_number` varchar(32) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_websites`
--

CREATE TABLE `tb_websites` (
  `id` int(11) NOT NULL,
  `token` varchar(32) NOT NULL,
  `name` varchar(64) NOT NULL,
  `label` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_websites`
--

INSERT INTO `tb_websites` (`id`, `token`, `name`, `label`) VALUES
(1, 'site_0', 'diamant_secret', 'Diamant Secret'),
(2, 'site_1', 'opera_bijoux', 'Opera Bijoux'),
(3, 'site_2', 'lana_stones', 'Lana Stones'),
(4, 'site_3', 'la_joaillerie_moderne', 'La Joaillerie Moderne'),
(5, 'site_4', 'eclatde_de_diamant', 'Eclatde De Diamant'),
(6, 'site_5', 'compagnie_deiamant', 'Compagnie De Diamant'),
(7, 'site_6', 'atelier_diamant', 'Atelier Diamant'),
(8, 'site_7', 'reserved', 'reserved');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_table`
--

CREATE TABLE `tmp_table` (
  `id` int(11) NOT NULL COMMENT 'int 11',
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
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `version`
--

CREATE TABLE `version` (
  `id` int(11) NOT NULL,
  `sql_version` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `version`
--

INSERT INTO `version` (`id`, `sql_version`) VALUES
(1, 'diamantsecretdb_1_5_5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`email`,`username`);

--
-- Indexes for table `bracelets`
--
ALTER TABLE `bracelets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_key` (`unique_key`),
  ADD UNIQUE KEY `internal_id` (`internal_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clarity`
--
ALTER TABLE `clarity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_id`
--
ALTER TABLE `company_id`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_code` (`company_code`);

--
-- Indexes for table `country_vat`
--
ALTER TABLE `country_vat`
  ADD PRIMARY KEY (`tm`);

--
-- Indexes for table `diamonds`
--
ALTER TABLE `diamonds`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`key`);

--
-- Indexes for table `diamond_color`
--
ALTER TABLE `diamond_color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diamond_shape`
--
ALTER TABLE `diamond_shape`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `earrings`
--
ALTER TABLE `earrings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_key` (`unique_key`),
  ADD UNIQUE KEY `internal_id` (`internal_id`);

--
-- Indexes for table `gold_quality`
--
ALTER TABLE `gold_quality`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`unique_key`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `min_max_values`
--
ALTER TABLE `min_max_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `necklaces`
--
ALTER TABLE `necklaces`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_key` (`unique_key`),
  ADD UNIQUE KEY `internal_id` (`internal_id`);

--
-- Indexes for table `pendants`
--
ALTER TABLE `pendants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_key` (`unique_key`),
  ADD UNIQUE KEY `internal_id` (`internal_id`);

--
-- Indexes for table `rings`
--
ALTER TABLE `rings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_key` (`unique_key`),
  ADD UNIQUE KEY `internal_id` (`internal_id`);

--
-- Indexes for table `ring_subcategory`
--
ALTER TABLE `ring_subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_cart`
--
ALTER TABLE `tb_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_paypal_payments`
--
ALTER TABLE `tb_paypal_payments`
  ADD PRIMARY KEY (`#`);

--
-- Indexes for table `tb_websites`
--
ALTER TABLE `tb_websites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmp_table`
--
ALTER TABLE `tmp_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `version`
--
ALTER TABLE `version`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `bracelets`
--
ALTER TABLE `bracelets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `clarity`
--
ALTER TABLE `clarity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `company_id`
--
ALTER TABLE `company_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `country_vat`
--
ALTER TABLE `country_vat`
  MODIFY `tm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `diamonds`
--
ALTER TABLE `diamonds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `diamond_color`
--
ALTER TABLE `diamond_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `earrings`
--
ALTER TABLE `earrings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11';
--
-- AUTO_INCREMENT for table `gold_quality`
--
ALTER TABLE `gold_quality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `min_max_values`
--
ALTER TABLE `min_max_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `necklaces`
--
ALTER TABLE `necklaces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11';
--
-- AUTO_INCREMENT for table `pendants`
--
ALTER TABLE `pendants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11';
--
-- AUTO_INCREMENT for table `rings`
--
ALTER TABLE `rings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11', AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_cart`
--
ALTER TABLE `tb_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tb_paypal_payments`
--
ALTER TABLE `tb_paypal_payments`
  MODIFY `#` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_websites`
--
ALTER TABLE `tb_websites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tmp_table`
--
ALTER TABLE `tmp_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11';COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2017 at 12:26 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_diamantsecret`
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
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '0:Standard User, 1:Admin',
  `cart` varchar(128) DEFAULT NULL,
  `activated` int(11) NOT NULL DEFAULT '0',
  `verification_hash` varchar(128) DEFAULT NULL,
  `recover_hash` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `site_id`, `email`, `username`, `password`, `first_name`, `last_name`, `mobileno`, `address`, `favorites`, `type`, `cart`, `activated`, `verification_hash`, `recover_hash`) VALUES
(1, 1, 'contact@diamantsecret.com', 'Admin', 'admin123', 'Admin', '', '032985866', 'Hoveniersstraat 30 Suite: 924, 2018 Antwerpen - Belgium', ',eXHRwDlpEe,IrpGW5LC3A,dnPPVYd18x', 1, 'E07lak14Th|0|1,', 1, '', ''),
(2, 2, 'contact@operabijoux.com', 'Admin', 'admin123', 'Admin', '', '032985866', 'Hoveniersstraat 30 Suite: 924, 2018 Antwerpen - Belgium', '', 1, 'E07lak14Th|0|1,', 1, '', ''),
(3, 2, 'ryan.bhanwra@yahoo.com', 'KBhan', 'NNCW12', 'Karan', 'Bhanwra', '98756', '123123 test', ',hoMBQnGaSO,6CPzcb8eHG', 0, '', 1, '', ''),
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

--
-- Dumping data for table `bracelets`
--

INSERT INTO `bracelets` (`id`, `unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_gold_weight`, `total_carat_weight`, `color_stone_carat`, `no_of_stones`, `no_of_color_stones`, `diamond_shape`, `color_stone_shape`, `clarity`, `color`, `material`, `gold_quality`, `color_stone_type`, `height`, `width`, `length`, `country_id`, `subcategory`, `lab_grown`, `images`, `description`, `ring_subcategory`, `ring_size`, `description_french`, `diamond_color`) VALUES
(1, 'mcq376X5FE', 2, 'TEST_572', 'Natalya Alexa', 92, 77, '6', 6, 7, 18, 15, 2, 9, 'VVS2', 2, 8, 'Great', 'Great', '10', '2', '8', 1, NULL, 0, 'bracelet_1_0.jpg,bracelet_1_1.jpg,bracelet_1_2.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 5, '87', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 4),
(2, 'dnPPVYd18x', 2, 'TEST_698', 'Tamina Becky', 32, 58, '7', 3, 4, 8, 7, 9, 16, 'VS2', 3, 6, 'Great', 'Great', '2', '9', '9', 13, NULL, 1, 'bracelet_2_0.jpg,bracelet_2_1.jpg,bracelet_2_2.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 5, '45', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 1),
(3, 'IrpGW5LC3A', 2, 'TEST_456', 'Tamina Clara', 77, 88, '5', 3, 7, 14, 1, 12, 7, 'SI1', 2, 4, 'Great', 'Great', '1', '6', '3', 11, NULL, 0, 'bracelet_3_0.jpg,bracelet_3_1.jpg,bracelet_3_2.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 2, '48', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 5),
(4, 'BRbYxao3rR', 2, 'TEST_728', 'Becky Mona', 73, 78, '4', 3, 1, 14, 16, 12, 15, 'SI3', 3, 6, 'Great', 'Great', '6', '10', '6', 2, NULL, 0, 'bracelet_4_0.jpg,bracelet_4_1.jpg,bracelet_4_2.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 5, '55', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 1),
(5, 'sL91Hjm9BT', 2, 'TEST_295', 'Clara Sylvie', 49, 60, '5', 7, 3, 19, 7, 1, 8, 'SI2', 2, 2, 'Great', 'Great', '3', '1', '8', 23, NULL, 1, 'bracelet_5_0.jpg,bracelet_5_1.jpg,bracelet_5_2.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 3, '51', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 8),
(6, 'pL454RFUGM', 2, 'TEST_461', 'Frost Clara', 86, 83, '2', 1, 5, 19, 6, 4, 13, 'SI1', 2, 3, 'Great', 'Great', '9', '6', '6', 23, NULL, 0, 'bracelet_6_0.jpg,bracelet_6_1.jpg,bracelet_6_2.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 4, '82', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 8);

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

--
-- Dumping data for table `earrings`
--

INSERT INTO `earrings` (`id`, `unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_gold_weight`, `total_carat_weight`, `color_stone_carat`, `no_of_stones`, `no_of_color_stones`, `diamond_shape`, `color_stone_shape`, `clarity`, `color`, `material`, `gold_quality`, `color_stone_type`, `height`, `width`, `length`, `country_id`, `subcategory`, `lab_grown`, `images`, `description`, `ring_subcategory`, `ring_size`, `description_french`, `diamond_color`) VALUES
(1, 'UPRxxZBiwx', 2, 'TEST_914', 'Brie Frost', 41, 68, '5', 7, 8, 3, 1, 14, 11, 'SI2', 3, 1, 'Great', 'Great', '6', '8', '4', 16, NULL, 1, 'earring_1_0.jpg,earring_1_1.jpg,earring_1_2.jpg,earring_1_3.jpg,earring_1_4.jpg,earring_1_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 4, '45', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 7),
(2, 'aVJBtHpN6b', 2, 'TEST_656', 'Clara Bayley', 41, 37, '5', 6, 4, 11, 4, 7, 17, 'SI2', 3, 5, 'Great', 'Great', '7', '5', '6', 2, NULL, 1, 'earring_2_0.jpg,earring_2_1.jpg,earring_2_2.jpg,earring_2_3.jpg,earring_2_4.jpg,earring_2_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 3, '73', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 2),
(3, '0aRZzt1yEV', 2, 'TEST_145', 'Charlotte Dana', 55, 92, '5', 3, 2, 9, 14, 12, 13, 'SI2', 1, 3, 'Great', 'Great', '3', '10', '9', 13, NULL, 0, 'earring_3_0.jpg,earring_3_1.jpg,earring_3_2.jpg,earring_3_3.jpg,earring_3_4.jpg,earring_3_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 2, '61', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 6),
(4, 'MdlOW5Fgfe', 2, 'TEST_380', 'Mira Danielle', 20, 69, '2', 8, 6, 19, 11, 16, 2, 'SI1', 1, 8, 'Great', 'Great', '1', '2', '3', 25, NULL, 1, 'earring_4_0.jpg,earring_4_1.jpg,earring_4_2.jpg,earring_4_3.jpg,earring_4_4.jpg,earring_4_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 1, '58', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 4),
(5, '9gIyzMG5l6', 2, 'TEST_488', 'Danielle Charlotte', 96, 40, '6', 1, 2, 16, 2, 15, 1, 'VS2', 1, 5, 'Great', 'Great', '2', '6', '10', 13, NULL, 0, 'earring_5_0.jpg,earring_5_1.jpg,earring_5_2.jpg,earring_5_3.jpg,earring_5_4.jpg,earring_5_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 2, '81', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 4),
(6, 'kk7ws9xfD1', 2, 'TEST_886', 'Sasha Alexa', 58, 95, '1', 8, 3, 13, 16, 1, 1, 'VVS2', 1, 1, 'Great', 'Great', '8', '1', '7', 19, NULL, 1, 'earring_6_0.jpg,earring_6_1.jpg,earring_6_2.jpg,earring_6_3.jpg,earring_6_4.jpg,earring_6_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 1, '77', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 3);

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
  `discount` float DEFAULT '0',
  `category` int(11) NOT NULL COMMENT '1 = Rings; 2 = Earrings; 3 = Pendants; 4 = Necklaces; 5 = Bracelets;',
  `featured` int(11) NOT NULL,
  `images_delta` text,
  `date_added` datetime NOT NULL,
  `disabled` int(11) NOT NULL DEFAULT '0' COMMENT 'A disabled item is not visible in any front end, but is visible on the backend.',
  `site_0` int(11) NOT NULL DEFAULT '1',
  `site_1` int(11) NOT NULL DEFAULT '1',
  `site_2` int(11) NOT NULL DEFAULT '1',
  `site_3` int(11) NOT NULL DEFAULT '1',
  `site_4` int(11) NOT NULL DEFAULT '1',
  `site_5` int(11) NOT NULL DEFAULT '1',
  `site_6` int(11) NOT NULL DEFAULT '1',
  `site_7` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
('Admin', '2017-05-17 05:56:14', '::1');

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

--
-- Dumping data for table `necklaces`
--

INSERT INTO `necklaces` (`id`, `unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_gold_weight`, `total_carat_weight`, `color_stone_carat`, `no_of_stones`, `no_of_color_stones`, `diamond_shape`, `color_stone_shape`, `clarity`, `color`, `material`, `gold_quality`, `color_stone_type`, `height`, `width`, `length`, `country_id`, `subcategory`, `lab_grown`, `images`, `description`, `ring_subcategory`, `ring_size`, `description_french`, `diamond_color`) VALUES
(1, 'xjYl5Stc34', 2, 'TEST_239', 'Ash Ash', 11, 81, '1', 5, 3, 18, 10, 6, 14, 'SI3', 3, 3, 'Great', 'Great', '1', '9', '3', 23, NULL, 0, 'necklace_1_0.jpg,necklace_1_1.jpg,necklace_1_2.jpg,necklace_1_3.jpg,necklace_1_4.jpg,necklace_1_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 4, '50', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 7),
(2, 'og8FVSMsgH', 2, 'TEST_434', 'Danielle Hibana', 58, 16, '8', 6, 7, 2, 7, 10, 12, 'SI3', 3, 7, 'Great', 'Great', '5', '10', '2', 8, NULL, 0, 'necklace_2_0.jpg,necklace_2_1.jpg,necklace_2_2.jpg,necklace_2_3.jpg,necklace_2_4.jpg,necklace_2_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 5, '50', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 4),
(3, 'jzXRWKHvKB', 2, 'TEST_353', 'Frost Twitch', 76, 38, '4', 5, 1, 2, 13, 16, 1, 'VS1', 2, 3, 'Great', 'Great', '9', '4', '4', 21, NULL, 1, 'necklace_3_0.jpg,necklace_3_1.jpg,necklace_3_2.jpg,necklace_3_3.jpg,necklace_3_4.jpg,necklace_3_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 3, '47', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 6),
(4, 've39P5g3wj', 2, 'TEST_991', 'Ash Danielle', 45, 26, '7', 1, 1, 1, 17, 17, 3, 'FL', 1, 8, 'Great', 'Great', '7', '6', '7', 13, NULL, 0, 'necklace_4_0.jpg,necklace_4_1.jpg,necklace_4_2.jpg,necklace_4_3.jpg,necklace_4_4.jpg,necklace_4_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 1, '63', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 6),
(5, 'xewMd2fnv4', 2, 'TEST_981', 'Tamina Brie', 82, 96, '4', 6, 7, 7, 5, 17, 9, 'VS1', 1, 7, 'Great', 'Great', '10', '3', '2', 16, NULL, 0, 'necklace_5_0.jpg,necklace_5_1.jpg,necklace_5_2.jpg,necklace_5_3.jpg,necklace_5_4.jpg,necklace_5_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 1, '90', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 5),
(6, 'KRh1ogJY9n', 2, 'TEST_969', 'Corine IQ', 70, 91, '2', 7, 5, 3, 11, 4, 6, 'FL', 3, 4, 'Great', 'Great', '1', '2', '9', 11, NULL, 1, 'necklace_6_0.jpg,necklace_6_1.jpg,necklace_6_2.jpg,necklace_6_3.jpg,necklace_6_4.jpg,necklace_6_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 1, '72', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 1),
(7, 'nUGNUM2L2a', 2, 'TEST_185', 'Alexa Nikki', 95, 99, '3', 5, 3, 11, 12, 10, 15, 'SI1', 2, 5, 'Great', 'Great', '10', '10', '9', 6, NULL, 0, 'necklace_7_0.jpg,necklace_7_1.jpg,necklace_7_2.jpg,necklace_7_3.jpg,necklace_7_4.jpg,necklace_7_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 2, '49', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 8),
(8, 'FCDa82jOb6', 2, 'TEST_941', 'Danielle Mira', 18, 63, '6', 6, 2, 2, 20, 12, 8, 'FL', 2, 4, 'Great', 'Great', '8', '1', '3', 24, NULL, 1, 'necklace_8_0.jpg,necklace_8_1.jpg,necklace_8_2.jpg,necklace_8_3.jpg,necklace_8_4.jpg,necklace_8_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 3, '93', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 4),
(9, 'gXMN852DAk', 2, 'TEST_599', 'Tamina Charlotte', 25, 94, '8', 6, 6, 4, 16, 10, 9, 'FL', 2, 5, 'Great', 'Great', '3', '6', '8', 5, NULL, 0, 'necklace_9_0.jpg,necklace_9_1.jpg,necklace_9_2.jpg,necklace_9_3.jpg,necklace_9_4.jpg,necklace_9_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 4, '70', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 6),
(10, 'kWClqRPZUQ', 2, 'TEST_864', 'Clara Sylvie', 91, 81, '8', 2, 8, 8, 20, 2, 12, 'VVS2', 1, 3, 'Great', 'Great', '7', '9', '9', 23, NULL, 1, 'necklace_10_0.jpg,necklace_10_1.jpg,necklace_10_2.jpg,necklace_10_3.jpg,necklace_10_4.jpg,necklace_10_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 2, '84', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 1),
(11, '6reoIROo0j', 2, 'TEST_138', 'Twitch Sylvie', 97, 69, '3', 5, 5, 5, 3, 15, 12, 'SI3', 3, 6, 'Great', 'Great', '7', '9', '3', 12, NULL, 0, 'necklace_11_0.jpg,necklace_11_1.jpg,necklace_11_2.jpg,necklace_11_3.jpg,necklace_11_4.jpg,necklace_11_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 2, '63', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 8),
(12, 'TpRJQHWLd3', 2, 'TEST_544', 'Valkyrie Bayley', 16, 33, '6', 6, 5, 3, 6, 9, 17, 'IF', 1, 6, 'Great', 'Great', '6', '5', '7', 12, NULL, 1, 'necklace_12_0.jpg,necklace_12_1.jpg,necklace_12_2.jpg,necklace_12_3.jpg,necklace_12_4.jpg,necklace_12_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 3, '100', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 1),
(13, 'ZYSQNAVxU4', 2, 'TEST_131', 'IQ IQ', 52, 76, '4', 4, 7, 18, 3, 1, 2, 'SI3', 2, 4, 'Great', 'Great', '1', '9', '4', 15, NULL, 1, 'necklace_13_0.jpg,necklace_13_1.jpg,necklace_13_2.jpg,necklace_13_3.jpg,necklace_13_4.jpg,necklace_13_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 3, '68', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 8),
(14, 'W9HDd3aDZW', 2, 'TEST_424', 'Sasha Sasha', 12, 79, '4', 1, 2, 11, 12, 7, 5, 'FL', 1, 5, 'Great', 'Great', '8', '3', '10', 18, NULL, 1, 'necklace_14_0.jpg,necklace_14_1.jpg,necklace_14_2.jpg,necklace_14_3.jpg,necklace_14_4.jpg,necklace_14_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 4, '44', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 5),
(15, 'OyZNhFjhBG', 2, 'TEST_646', 'Tamina Alexa', 16, 14, '4', 4, 5, 10, 13, 15, 16, 'SI1', 1, 3, 'Great', 'Great', '4', '5', '2', 1, NULL, 0, 'necklace_15_0.jpg,necklace_15_1.jpg,necklace_15_2.jpg,necklace_15_3.jpg,necklace_15_4.jpg,necklace_15_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 1, '97', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 4),
(16, 'IrNnIz4I5e', 2, 'TEST_447', 'IQ Tamina', 66, 98, '2', 1, 6, 13, 4, 2, 12, 'VS2', 1, 7, 'Great', 'Great', '9', '10', '6', 1, NULL, 0, 'necklace_16_0.jpg,necklace_16_1.jpg,necklace_16_2.jpg,necklace_16_3.jpg,necklace_16_4.jpg,necklace_16_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 4, '91', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 5),
(17, 'G69onZqHJL', 2, 'TEST_627', 'Bayley Tamina', 16, 91, '6', 8, 4, 7, 17, 11, 5, 'SI3', 1, 3, 'Great', 'Great', '5', '1', '9', 13, NULL, 1, 'necklace_17_0.jpg,necklace_17_1.jpg,necklace_17_2.jpg,necklace_17_3.jpg,necklace_17_4.jpg,necklace_17_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 3, '81', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 4),
(18, 'rQTxPwFKBy', 2, 'TEST_433', 'Alexa Nikki', 50, 56, '2', 5, 5, 6, 20, 9, 5, 'SI1', 1, 6, 'Great', 'Great', '4', '5', '7', 2, NULL, 1, 'necklace_18_0.jpg,necklace_18_1.jpg,necklace_18_2.jpg,necklace_18_3.jpg,necklace_18_4.jpg,necklace_18_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 4, '47', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 7),
(19, 'ci57GrquPL', 2, 'TEST_789', 'Danielle Sasha', 85, 40, '8', 1, 7, 5, 8, 16, 15, 'VS2', 3, 5, 'Great', 'Great', '3', '8', '3', 6, NULL, 0, 'necklace_19_0.jpg,necklace_19_1.jpg,necklace_19_2.jpg,necklace_19_3.jpg,necklace_19_4.jpg,necklace_19_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 3, '52', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 4),
(20, '9eH4rfcCxk', 2, 'TEST_532', 'Becky Becky', 18, 67, '7', 7, 2, 12, 3, 17, 9, 'VS2', 2, 8, 'Great', 'Great', '2', '3', '3', 21, NULL, 0, 'necklace_20_0.jpg,necklace_20_1.jpg,necklace_20_2.jpg,necklace_20_3.jpg,necklace_20_4.jpg,necklace_20_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 1, '61', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 8),
(21, 'xDPRWQ3j6j', 2, 'TEST_713', 'Alexa Nikki', 46, 82, '8', 5, 1, 11, 9, 4, 7, 'FL', 3, 3, 'Great', 'Great', '5', '7', '8', 10, NULL, 0, 'necklace_21_0.jpg,necklace_21_1.jpg,necklace_21_2.jpg,necklace_21_3.jpg,necklace_21_4.jpg,necklace_21_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 4, '85', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 3),
(22, 'nvY1ptWIoh', 2, 'TEST_938', 'Alexa Sasha', 75, 91, '7', 7, 5, 1, 17, 8, 5, 'VS1', 1, 2, 'Great', 'Great', '4', '2', '10', 25, NULL, 0, 'necklace_22_0.jpg,necklace_22_1.jpg,necklace_22_2.jpg,necklace_22_3.jpg,necklace_22_4.jpg,necklace_22_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 2, '95', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 1);

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

--
-- Dumping data for table `pendants`
--

INSERT INTO `pendants` (`id`, `unique_key`, `company_id`, `internal_id`, `product_name`, `pieces_in_stock`, `days_for_shipment`, `total_gold_weight`, `total_carat_weight`, `color_stone_carat`, `no_of_stones`, `no_of_color_stones`, `diamond_shape`, `color_stone_shape`, `clarity`, `color`, `material`, `gold_quality`, `color_stone_type`, `height`, `width`, `length`, `country_id`, `subcategory`, `lab_grown`, `images`, `description`, `ring_subcategory`, `ring_size`, `description_french`, `diamond_color`) VALUES
(1, 'Sd5bwOewoU', 2, 'TEST_715', 'Charlotte Mira', 64, 64, '1', 3, 4, 15, 16, 4, 14, 'VS2', 3, 5, 'Great', 'Great', '8', '1', '7', 15, NULL, 1, 'pendant_1_0.jpg,pendant_1_1.jpg,pendant_1_2.jpg,pendant_1_3.jpg,pendant_1_4.jpg,pendant_1_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 1, '54', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 1),
(2, 'jcFhmtn2W8', 2, 'TEST_325', 'Alexa Ash', 80, 43, '2', 5, 8, 8, 1, 6, 10, 'FL', 3, 8, 'Great', 'Great', '5', '1', '7', 6, NULL, 1, 'pendant_2_0.jpg,pendant_2_1.jpg,pendant_2_2.jpg,pendant_2_3.jpg,pendant_2_4.jpg,pendant_2_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 2, '55', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 7),
(3, '8V3mDK1FdI', 2, 'TEST_993', 'Valkyrie Mira', 92, 74, '4', 8, 6, 14, 15, 15, 15, 'FL', 1, 8, 'Great', 'Great', '6', '10', '1', 4, NULL, 1, 'pendant_3_0.jpg,pendant_3_1.jpg,pendant_3_2.jpg,pendant_3_3.jpg,pendant_3_4.jpg,pendant_3_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 5, '63', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 5),
(4, 'Jn4KpFJS1n', 2, 'TEST_465', 'IQ Valkyrie', 85, 93, '3', 2, 4, 18, 15, 10, 2, 'VVS2', 2, 3, 'Great', 'Great', '10', '2', '5', 19, NULL, 0, 'pendant_4_0.jpg,pendant_4_1.jpg,pendant_4_2.jpg,pendant_4_3.jpg,pendant_4_4.jpg,pendant_4_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 1, '69', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 3),
(5, 'BaKx8MSn3r', 2, 'TEST_908', 'Ash Nikki', 85, 11, '1', 2, 5, 16, 14, 3, 10, 'VS1', 1, 6, 'Great', 'Great', '7', '9', '7', 4, NULL, 0, 'pendant_5_6.jpg,pendant_5_7.jpg,pendant_5_8.jpg,pendant_5_9.jpg,pendant_5_10.jpg,pendant_5_11.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 4, '47', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 8),
(6, 'jPtrhjfTLD', 2, 'TEST_134', 'Corine Ash', 68, 70, '8', 5, 4, 9, 19, 12, 2, 'VS2', 3, 7, 'Great', 'Great', '4', '7', '10', 15, NULL, 1, 'pendant_6_0.jpg,pendant_6_1.jpg,pendant_6_2.jpg,pendant_6_3.jpg,pendant_6_4.jpg,pendant_6_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 3, '80', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 2),
(7, '57H2IIlsaE', 2, 'TEST_939', 'Becky IQ', 56, 95, '8', 6, 2, 7, 13, 6, 7, 'SI1', 2, 5, 'Great', 'Great', '5', '3', '6', 2, NULL, 0, 'pendant_7_0.jpg,pendant_7_1.jpg,pendant_7_2.jpg,pendant_7_3.jpg,pendant_7_4.jpg,pendant_7_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 4, '68', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 4),
(8, 'evYkmKiObH', 2, 'TEST_304', 'Frost Clara', 84, 10, '6', 2, 3, 4, 4, 15, 3, 'SI1', 3, 1, 'Great', 'Great', '1', '10', '5', 7, NULL, 1, 'pendant_8_0.jpg,pendant_8_1.jpg,pendant_8_2.jpg,pendant_8_3.jpg,pendant_8_4.jpg,pendant_8_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 2, '84', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 1),
(9, 'k2Y9MzPvRR', 2, 'TEST_745', 'IQ Tamina', 88, 44, '3', 2, 1, 9, 5, 8, 9, 'IF', 1, 5, 'Great', 'Great', '9', '2', '9', 14, NULL, 1, 'pendant_9_0.jpg,pendant_9_1.jpg,pendant_9_2.jpg,pendant_9_3.jpg,pendant_9_4.jpg,pendant_9_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 3, '43', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 1);

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
(1, 'YQqBGULkda', 2, 'TEST_545', 'Nikki Becky', 91, 62, '5', 1, 2, 3, 20, 17, 16, 'FL', 1, 6, 'Great', 'Great', '6', '6', '4', 10, NULL, 0, 'ring_1_0.jpg,ring_1_1.jpg,ring_1_2.jpg,ring_1_3.jpg,ring_1_4.jpg,ring_1_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 2, '82', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 6),
(2, '6FlZJRBAXR', 2, 'TEST_839', 'Hibana IQ', 100, 92, '2', 4, 7, 2, 7, 7, 14, 'SI2', 3, 6, 'Great', 'Great', '1', '1', '2', 14, NULL, 1, 'ring_2_0.jpg,ring_2_1.jpg,ring_2_2.jpg,ring_2_3.jpg,ring_2_4.jpg,ring_2_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 5, '47', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 1),
(3, 'cXP2eGzuP3', 2, 'TEST_245', 'Twitch Ash', 72, 74, '3', 2, 4, 17, 12, 11, 7, 'IF', 3, 7, 'Great', 'Great', '4', '5', '1', 2, NULL, 1, 'ring_3_0.jpg,ring_3_1.jpg,ring_3_2.jpg,ring_3_3.jpg,ring_3_4.jpg,ring_3_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 5, '60', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 1),
(4, '32zDIHeOPe', 2, 'TEST_279', 'Bayley Bayley', 67, 69, '5', 5, 3, 1, 13, 8, 7, 'VVS2', 3, 4, 'Great', 'Great', '6', '8', '3', 17, NULL, 0, 'ring_4_0.jpg,ring_4_1.jpg,ring_4_2.jpg,ring_4_3.jpg,ring_4_4.jpg,ring_4_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 4, '77', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 5),
(5, '71paZs1b9J', 2, 'TEST_443', 'Bayley Charlotte', 35, 79, '5', 3, 2, 16, 8, 16, 6, 'VVS1', 3, 5, 'Great', 'Great', '6', '3', '9', 11, NULL, 0, 'ring_5_0.jpg,ring_5_1.jpg,ring_5_2.jpg,ring_5_3.jpg,ring_5_4.jpg,ring_5_5.jpg,', 'Boucles d\'oreilles forme Goutte en or blanc, serties de 0,17ct de diamant.', 2, '74', 'Boucles d\'oreilles Pendantes Goutte en 2Ors, avec Solitaire pendant serti de 0,38ct de diamant.', 1),
(6, 'nmN2Qbosxl', 2, '63386R004A', 'Elisa', 10000, 15, '1.1', 0.14, NULL, 50, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, '', 'White Gold Rhinestone Ring set by 0,14ct diamonds.', 1, '48', 'Bague Rythme en Or blanc sertie de 0,14ct de diamants.', 5),
(7, 'nWGFJ50xWZ', 2, '57070R003A', 'ElisÃ©a', 10000, 15, '1.8', 0.2, NULL, 54, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, '', 'White Gold Circle Ring set by 0.20ct diamonds.', 1, '48', 'Bague Cercle pavÃ© en Or blanc sertie de 0,20ct de diamants.', 5),
(8, 'IKXexGfVFa', 2, '57070R004A', 'France', 10000, 15, '1.7', 0.2, NULL, 54, 0, 1, 0, 'SI1', 1, 1, '4', NULL, NULL, NULL, '0', 2, NULL, 2, '', 'Yellow Gold Circle Ring set by 0.20ct diamonds.', 1, '48', 'Bague Cercle pavÃ© en Or jaune sertie de 0,20ct de diamants.', 5),
(9, 'NFRy3wjF07', 2, '59576R006A', 'Francine', 10000, 15, '1.2', 0.05, NULL, 11, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, '', 'Solitaire ring in White Gold set by 0.05ct diamonds.', 4, '48', 'Bague Solitaire Illusion Or blanc sertie de 0,05ct de diamants.', 5),
(10, 'KS6wn0klVp', 2, '59576R002A', 'Francoise', 10000, 15, '1', 0.05, NULL, 11, 0, 1, 0, 'SI1', 1, 6, '4', NULL, NULL, NULL, '0', 2, NULL, 2, '', 'Solitaire ring in Yellow Gold set by 0.05ct diamonds.', 4, '48-65', 'Bague Solitaire Illusion Or jaune sertie de 0,05ct de diamants.', 5),
(11, '8FCVv5aUVI', 2, '58989R009A', 'Capucine', 10000, 15, '1.4', 0.07, NULL, 13, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, '', 'White Gold Drop Ring set by 0.07ct diamonds.', 4, '48-65', 'Bague Goutte pavÃ©e en Or blanc sertie de 0,07ct de diamants.', 5),
(12, 'Nbj7d7boEx', 2, '58697R007A', 'Camille', 10000, 15, '1.1', 0.26, NULL, 28, 0, 9, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, '', 'Solitaire Ring Baguet in White Gold set by 0.26ct diamonds.', 4, '48-65', 'Bague Solitaire Baguette en Or blanc sertie de 0,26ct de diamants.', 5),
(13, 'uaOMHuWIMY', 2, '41740R014A', 'Fabienne', 10000, 15, '2.4', 0.2, 0.66, 62, 3, 1, 6, 'SI1', 3, 2, '4', 'Pierre de couleur naturelle/ Natural Color Stone  -  3.0x4.0MM', NULL, NULL, '0', 2, NULL, 2, '', 'White Gold Trilogy Ring set by Three Blue Topaz and 0.20ct diamonds.', 7, '48-65', 'Bague Trilogie en Or blanc sertie de Trois Topazes Bleues et de 0,20ct de diamants. ', 5),
(14, 'JFdJptWkGv', 2, '56930R002A', 'Coraline', 10000, 15, '1.8', 0.15, 1.6, 42, 1, 1, 6, 'SI1', 3, 2, '4', 'Pierre de couleur naturelle/ Natural Color Stone  -  6.0x8.0MM', NULL, NULL, '0', 2, NULL, 2, '', 'Solitaire Ring Lace in White Gold set by a Blue Topaz and 0,15ct diamonds.', 7, '48-65', 'Bague Solitaire Dentelle en Or blanc sertie d\' une Topaze Bleue et de 0,15ct de diamants. ', 5),
(15, 'sRNAIWs3cE', 2, '58469R002A', 'Chistina', 10000, 15, '1.4', 0.15, NULL, 26, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, '', 'White Gold Trilogy Ring set by 0,15ct diamonds.', 1, '48-65', 'Bague Trilogie en Or blanc sertie de 0,15ct de diamants.', 5),
(16, 'SLRzL4bPnN', 2, '54716R001A', 'Doty', 10000, 15, '2', 0.49, NULL, 182, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, '', 'White Gold Paved Ring set by 0.49ct diamonds.', 1, '48-65', 'Bague PavÃ©e en Or blanc sertie de 0,49ct de diamants.', 5),
(17, '7Zoi993pfV', 2, '54104R006A', 'Morgane Edit', 10000, 15, '3', 0.16, 0.41, 34, 5, 1, 3, 'SI1', 3, 2, '4', 'Pierre de couleur naturelle/ Natural Color Stone  -  2.5MM', '', '', '0', 2, NULL, 0, '', 'Half Eternity in White Gold set by Blue Sapphires and 0.16ct diamonds.', 7, '48-65', 'Bague Alliance 1/2 Tour en Or blanc sertie de Saphirs bleus et de 0,16ct de diamants.', 5);

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
(1, 'diamantsecretdb_1_4_5');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11', AUTO_INCREMENT=7;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `gold_quality`
--
ALTER TABLE `gold_quality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `necklaces`
--
ALTER TABLE `necklaces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11', AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `pendants`
--
ALTER TABLE `pendants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11', AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `rings`
--
ALTER TABLE `rings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11', AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_cart`
--
ALTER TABLE `tb_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_websites`
--
ALTER TABLE `tb_websites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tmp_table`
--
ALTER TABLE `tmp_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

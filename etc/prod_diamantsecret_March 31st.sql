-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2017 at 05:45 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prod_diamantsecret`
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
(1, 1, 'contact@diamantsecret.com', 'Admin', 'admin123', 'Admin', '', '032985866', 'Hoveniersstraat 30 Suite: 924, 2018 Antwerpen - Belgium', '', 1, '', 1, '', ''),
(2, 1, 'ryan.bhanwra@yahoo.com', 'ryan', '123123', 'Karan', 'Bhanwra', '123123', '123123', NULL, 0, NULL, 1, '51c6c8906e93ec9280633e4e96e9977b', NULL),
(3, 2, 'ryan.bhanwra@yahoo.com', 'Rya', '123123', 'Ryasd', 'asdasd', '123123', '123', ',JkQh8mnjbR,dxjm3RnMj6', 0, 'vfy5effWZI|0|2,', 1, '51c6c8906e93ec9280633e4e96e9977b', NULL);

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
  `total_carat_weight` float(11,0) DEFAULT NULL COMMENT 'varchar 11',
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
(3, 'Diamond & Color Stone');

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
  `images_delta` varchar(256) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `disabled` int(11) NOT NULL DEFAULT '0' COMMENT 'A disabled item is not visible in any front end, but is visible on the backend.',
  `site_0` int(11) NOT NULL DEFAULT '0',
  `site_1` int(11) NOT NULL DEFAULT '0',
  `site_2` int(11) NOT NULL DEFAULT '0',
  `site_3` int(11) NOT NULL DEFAULT '0',
  `site_4` int(11) NOT NULL DEFAULT '0',
  `site_5` int(11) NOT NULL DEFAULT '0',
  `site_6` int(11) NOT NULL DEFAULT '0',
  `site_7` int(11) NOT NULL DEFAULT '0'
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
(1, '18k'),
(2, '14k'),
(3, '9k'),
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
('Admin', '2017-03-31 09:02:39', '::1');

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
  `color_stone_type` varchar(32) DEFAULT NULL,
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

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `site_id`, `email`, `hash`) VALUES
(1, '1', 'ryan.bhanwra@yahoo.com', ''),
(2, '', 'ryan.bhanwra@gmail.com', ''),
(3, '', 'princebhanwra@gmail.com', ''),
(5, '2', 'ryan.bhanwra@yahoo.com', 'A0443D5C0912BA03F7CE806D41536678');

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
(1, 'diamantsecretdb_1_3_4');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `bracelets`
--
ALTER TABLE `bracelets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11';
--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11';
--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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

-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.14 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table prod_diamantsecret.accounts
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) DEFAULT NULL COMMENT 'ID value from tb_websites, use for appropriate website whilst registering',
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table prod_diamantsecret.accounts: ~1 rows (approximately)
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` (`id`, `site_id`, `email`, `username`, `password`, `first_name`, `last_name`, `mobileno`, `address`, `favorites`, `type`, `cart`, `activated`, `verification_hash`, `recover_hash`) VALUES
	(1, 1, 'contact@diamantsecret.com', 'Admin', 'admin123', 'Admin', '', '032985866', 'Hoveniersstraat 30 Suite: 924, 2018 Antwerpen - Belgium', ',ohWzBoR89L', 1, '', 1, '', '');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;

-- Dumping structure for table prod_diamantsecret.bracelets
CREATE TABLE IF NOT EXISTS `bracelets` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11',
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
  `diamond_color` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_key` (`unique_key`),
  UNIQUE KEY `internal_id` (`internal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prod_diamantsecret.bracelets: ~0 rows (approximately)
/*!40000 ALTER TABLE `bracelets` DISABLE KEYS */;
/*!40000 ALTER TABLE `bracelets` ENABLE KEYS */;

-- Dumping structure for table prod_diamantsecret.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prod_diamantsecret.categories: ~5 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `category`) VALUES
	(1, 'rings'),
	(2, 'earrings'),
	(3, 'pendants'),
	(4, 'necklaces'),
	(5, 'bracelets');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table prod_diamantsecret.color
CREATE TABLE IF NOT EXISTS `color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table prod_diamantsecret.color: 3 rows
/*!40000 ALTER TABLE `color` DISABLE KEYS */;
INSERT INTO `color` (`id`, `color`) VALUES
	(1, 'Diamond'),
	(2, 'Color Stone'),
	(3, 'Diamond & Color Stone');
/*!40000 ALTER TABLE `color` ENABLE KEYS */;

-- Dumping structure for table prod_diamantsecret.company_id
CREATE TABLE IF NOT EXISTS `company_id` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_code` varchar(32) NOT NULL,
  `company_name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `mobileno` varchar(128) NOT NULL,
  `address` varchar(512) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `company_code` (`company_code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table prod_diamantsecret.company_id: ~1 rows (approximately)
/*!40000 ALTER TABLE `company_id` DISABLE KEYS */;
INSERT INTO `company_id` (`id`, `company_code`, `company_name`, `email`, `mobileno`, `address`) VALUES
	(2, 'EA STARTS', 'EA STARTS', 'EA STARTS', 'EA STARTS', 'EA STARTS');
/*!40000 ALTER TABLE `company_id` ENABLE KEYS */;

-- Dumping structure for table prod_diamantsecret.country_vat
CREATE TABLE IF NOT EXISTS `country_vat` (
  `tm` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `country_name` varchar(128) NOT NULL,
  `vat` int(11) NOT NULL,
  PRIMARY KEY (`tm`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Dumping data for table prod_diamantsecret.country_vat: ~28 rows (approximately)
/*!40000 ALTER TABLE `country_vat` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `country_vat` ENABLE KEYS */;

-- Dumping structure for table prod_diamantsecret.diamonds
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prod_diamantsecret.diamonds: ~0 rows (approximately)
/*!40000 ALTER TABLE `diamonds` DISABLE KEYS */;
/*!40000 ALTER TABLE `diamonds` ENABLE KEYS */;

-- Dumping structure for table prod_diamantsecret.diamond_color
CREATE TABLE IF NOT EXISTS `diamond_color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `diamond_color` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table prod_diamantsecret.diamond_color: 8 rows
/*!40000 ALTER TABLE `diamond_color` DISABLE KEYS */;
INSERT INTO `diamond_color` (`id`, `diamond_color`) VALUES
	(1, 'D'),
	(2, 'E'),
	(3, 'F'),
	(4, 'G'),
	(5, 'H'),
	(6, 'I'),
	(7, 'J'),
	(8, 'K');
/*!40000 ALTER TABLE `diamond_color` ENABLE KEYS */;

-- Dumping structure for table prod_diamantsecret.diamond_shape
CREATE TABLE IF NOT EXISTS `diamond_shape` (
  `id` int(11) NOT NULL,
  `category` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prod_diamantsecret.diamond_shape: ~17 rows (approximately)
/*!40000 ALTER TABLE `diamond_shape` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `diamond_shape` ENABLE KEYS */;

-- Dumping structure for table prod_diamantsecret.earrings
CREATE TABLE IF NOT EXISTS `earrings` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11',
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
  `diamond_color` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_key` (`unique_key`),
  UNIQUE KEY `internal_id` (`internal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prod_diamantsecret.earrings: ~0 rows (approximately)
/*!40000 ALTER TABLE `earrings` DISABLE KEYS */;
/*!40000 ALTER TABLE `earrings` ENABLE KEYS */;

-- Dumping structure for table prod_diamantsecret.items
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
  `disabled` int(11) NOT NULL DEFAULT '0' COMMENT 'A disabled item is not visible in any front end, but is visible on the backend.',
  `site_0` int(11) NOT NULL DEFAULT '0',
  `site_1` int(11) NOT NULL DEFAULT '0',
  `site_2` int(11) NOT NULL DEFAULT '0',
  `site_3` int(11) NOT NULL DEFAULT '0',
  `site_4` int(11) NOT NULL DEFAULT '0',
  `site_5` int(11) NOT NULL DEFAULT '0',
  `site_6` int(11) NOT NULL DEFAULT '0',
  `site_7` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`unique_key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prod_diamantsecret.items: ~0 rows (approximately)
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
/*!40000 ALTER TABLE `items` ENABLE KEYS */;

-- Dumping structure for table prod_diamantsecret.materials
CREATE TABLE IF NOT EXISTS `materials` (
  `id` int(11) NOT NULL,
  `category` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prod_diamantsecret.materials: ~7 rows (approximately)
/*!40000 ALTER TABLE `materials` DISABLE KEYS */;
INSERT INTO `materials` (`id`, `category`) VALUES
	(1, '18k'),
	(2, '14k'),
	(3, '9k'),
	(4, 'Silver'),
	(5, 'Platinum'),
	(6, 'Bi Colour with Gold'),
	(7, 'Three Colour with Gold'),
	(8, 'Black Metal');
/*!40000 ALTER TABLE `materials` ENABLE KEYS */;

-- Dumping structure for table prod_diamantsecret.moderator_login
CREATE TABLE IF NOT EXISTS `moderator_login` (
  `username` varchar(128) NOT NULL,
  `last_login` varchar(128) NOT NULL,
  `login_ip` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prod_diamantsecret.moderator_login: ~5 rows (approximately)
/*!40000 ALTER TABLE `moderator_login` DISABLE KEYS */;
INSERT INTO `moderator_login` (`username`, `last_login`, `login_ip`) VALUES
	('Admin', '2017-03-05 16:11:35', '::1'),
	('Admin', '2017-03-15 22:18:36', '::1'),
	('Admin', '2017-03-18 15:22:51', '::1'),
	('Admin', '2017-03-22 21:40:12', '::1'),
	('Admin', '2017-03-23 22:09:02', '::1');
/*!40000 ALTER TABLE `moderator_login` ENABLE KEYS */;

-- Dumping structure for table prod_diamantsecret.necklaces
CREATE TABLE IF NOT EXISTS `necklaces` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11',
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
  `diamond_color` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_key` (`unique_key`),
  UNIQUE KEY `internal_id` (`internal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prod_diamantsecret.necklaces: ~0 rows (approximately)
/*!40000 ALTER TABLE `necklaces` DISABLE KEYS */;
/*!40000 ALTER TABLE `necklaces` ENABLE KEYS */;

-- Dumping structure for table prod_diamantsecret.pendants
CREATE TABLE IF NOT EXISTS `pendants` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11',
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
  `diamond_color` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_key` (`unique_key`),
  UNIQUE KEY `internal_id` (`internal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prod_diamantsecret.pendants: ~0 rows (approximately)
/*!40000 ALTER TABLE `pendants` DISABLE KEYS */;
/*!40000 ALTER TABLE `pendants` ENABLE KEYS */;

-- Dumping structure for table prod_diamantsecret.rings
CREATE TABLE IF NOT EXISTS `rings` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11',
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
  `diamond_color` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_key` (`unique_key`),
  UNIQUE KEY `internal_id` (`internal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prod_diamantsecret.rings: ~0 rows (approximately)
/*!40000 ALTER TABLE `rings` DISABLE KEYS */;
/*!40000 ALTER TABLE `rings` ENABLE KEYS */;

-- Dumping structure for table prod_diamantsecret.ring_subcategory
CREATE TABLE IF NOT EXISTS `ring_subcategory` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prod_diamantsecret.ring_subcategory: ~38 rows (approximately)
/*!40000 ALTER TABLE `ring_subcategory` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `ring_subcategory` ENABLE KEYS */;

-- Dumping structure for table prod_diamantsecret.subscribers
CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` varchar(128) NOT NULL COMMENT 'ID value from tb_websites, use for appropriate website whilst registering',
  `email` varchar(128) NOT NULL,
  `hash` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table prod_diamantsecret.subscribers: ~3 rows (approximately)
/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;
INSERT INTO `subscribers` (`id`, `site_id`, `email`, `hash`) VALUES
	(1, '1', 'ryan.bhanwra@yahoo.com', ''),
	(2, '', 'ryan.bhanwra@gmail.com', ''),
	(3, '', 'princebhanwra@gmail.com', '');
/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;

-- Dumping structure for table prod_diamantsecret.tb_websites
CREATE TABLE IF NOT EXISTS `tb_websites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(32) NOT NULL,
  `name` varchar(64) NOT NULL,
  `label` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table prod_diamantsecret.tb_websites: 8 rows
/*!40000 ALTER TABLE `tb_websites` DISABLE KEYS */;
INSERT INTO `tb_websites` (`id`, `token`, `name`, `label`) VALUES
	(1, 'site_0', 'diamant_secret', 'Diamant Secret'),
	(2, 'site_1', 'opera_bijoux', 'Opera Bijoux'),
	(3, 'site_2', 'lana_stones', 'Lana Stones'),
	(4, 'site_3', 'la_joaillerie_moderne', 'La Joaillerie Moderne'),
	(5, 'site_4', 'eclatde_de_diamant', 'Eclatde De Diamant'),
	(6, 'site_5', 'compagnie_deiamant', 'Compagnie De Diamant'),
	(7, 'site_6', 'atelier_diamant', 'Atelier Diamant'),
	(8, 'site_7', 'reserved', 'reserved');
/*!40000 ALTER TABLE `tb_websites` ENABLE KEYS */;

-- Dumping structure for table prod_diamantsecret.tmp_table
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prod_diamantsecret.tmp_table: ~0 rows (approximately)
/*!40000 ALTER TABLE `tmp_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `tmp_table` ENABLE KEYS */;

-- Dumping structure for table prod_diamantsecret.version
CREATE TABLE IF NOT EXISTS `version` (
  `id` int(11) NOT NULL,
  `sql_version` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table prod_diamantsecret.version: ~0 rows (approximately)
/*!40000 ALTER TABLE `version` DISABLE KEYS */;
INSERT INTO `version` (`id`, `sql_version`) VALUES
	(1, 'diamantsecretdb_1_3_4');
/*!40000 ALTER TABLE `version` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

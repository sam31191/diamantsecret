-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.14 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for diamantsecret_variations_prince
CREATE DATABASE IF NOT EXISTS `diamantsecret_variations_prince` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `diamantsecret_variations_prince`;


-- Dumping structure for table diamantsecret_variations_prince.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `internal_id` varchar(100) DEFAULT NULL,
  `ean_code` varchar(50) DEFAULT '',
  `category_id` tinyint(4) NOT NULL,
  `subcategory_id` tinyint(4) NOT NULL,
  `family` varchar(50) DEFAULT '',
  `parent_internal_id` varchar(50) DEFAULT '',
  `relationship_type` enum('Parent','Child','Accessory') NOT NULL,
  `variation_theme` enum('material','size','material-size') NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `clarity` varchar(50) NOT NULL,
  `material` varchar(50) NOT NULL,
  `gold_quality` varchar(50) NOT NULL,
  `size` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table diamantsecret_variations_prince.products: 5 rows
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `internal_id`, `ean_code`, `category_id`, `subcategory_id`, `family`, `parent_internal_id`, `relationship_type`, `variation_theme`, `product_name`, `clarity`, `material`, `gold_quality`, `size`) VALUES
	(1, '63386R004A-P', '', 1, 1, '', '', 'Parent', 'material-size', 'Elisa-Parent', '', '', '', NULL),
	(2, '63386R004A-1', '', 1, 1, '', '63386R004A-P', 'Child', 'material-size', 'Elisa-Child1', '', 'white', '9K', 48),
	(3, '63386R004A-2', '', 1, 1, '', '63386R004A-P', 'Child', 'material-size', 'Elisa-Child2', '', 'white', '9K', 50),
	(4, '63386R004A-11', '', 1, 1, '', '63386R004A-P', 'Child', 'material-size', 'Elisa-Child11', '', 'rose', '9K', 48),
	(5, '63386R004A-21', '', 1, 1, '', '63386R004A-P', 'Child', 'material-size', 'Elisa-Child21', '', 'rose', '9K', 50),
	(6, '63386R004B-P', '', 1, 1, '', '', 'Parent', 'material-size', 'Elisa-B-Parent', '', '', '', NULL),
	(7, '63386R004B-1', '', 1, 1, '', '63386R004B-P', 'Child', 'material-size', 'Elisa-B-Child-1', '', 'white', '9K', 48),
	(8, '63386R004B-2', '', 1, 1, '', '63386R004B-P', 'Child', 'material-size', 'Elisa-B-Child-2', '', 'white', '9K', 50),
	(9, '63386R004B-11', '', 1, 1, '', '63386R004B-P', 'Child', 'material-size', 'Elisa-B-Child-11', '', 'rose', '9K', 48),
	(10, '63386R004B-21', '', 1, 1, '', '63386R004B-P', 'Child', 'material-size', 'Elisa-B-Child-21', '', 'rose', '9K', 50),
	(11, '63386R004A-3', '', 1, 1, '', '63386R004A-3', 'Accessory', 'material-size', 'Elisa-Accessory', '', 'white', '9K', 48),
	(12, '63386R004A-4', '', 1, 1, '', '63386R004A-4', 'Accessory', 'material-size', 'Elisa-Accessory-4', '', 'white', '9K', 48);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

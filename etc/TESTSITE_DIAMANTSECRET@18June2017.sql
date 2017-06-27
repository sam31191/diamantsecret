-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 18, 2017 at 06:54 AM
-- Server version: 5.6.35
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `TESTSITE_DIAMANTSECRET`
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
(2, 2, 'contact@operabijoux.com', 'Admin', 'admin123', 'Admin', '', '032985866', 'Hoveniersstraat 30 Suite: 924, 2018 Antwerpen - Belgium', '', 1, 'E07lak14Th|0|1,', 1, '', ''),
(3, 2, 'ryan.bhanwra@yahoo.com', 'KBhan', 'NNCW12', 'Karan', 'Bhanwra', '98756', '123123 test', ',hoMBQnGaSO,6CPzcb8eHG', 0, '', 1, '', ''),
(7, 2, 'ryan.bhanwra@gmail.com', 'RBhan', '123123', 'Karan', 'Bh', '123123', '123123', NULL, 0, NULL, 1, '', '4FD9D8F51E1DCD5450C916B3A87184C5'),
(8, 1, 'princebhanwra@gmail.com', 'prince', 'testing', 'Prince', 'test', '123456', 'Tst', NULL, 0, NULL, 1, '', '359CDC10CE64DDADDE8507E79CF32CB4'),
(16, 3, 'friends.prince@gmail.com', 'friends.prince', 'testing', 'Prince', 'Bhanwra', '466255839', 'test', ',QSFZJqMd0f,wjgIYeYp67', 0, ',AP863Bc9jT|1,QSFZJqMd0f|4', 1, '', NULL),
(22, 4, 'aman@alwaysinfote1ch.com', 'tst12', '12345678', 'test1', 'test', '9111111', 'sedf', NULL, 0, NULL, 0, '3692b78087854a9b32cf0b21313b8268', NULL),
(26, 4, 'alwaysinfotech2@gmail.com', 'test', '12345678', 'developer', 'singh', '9111111', 'ldh', ',LENE4M5mBB', 0, '', 1, '', NULL),
(27, 3, 'developer1@alwaysinfotech.com', 'gurpreet', '1234', 'gurpreet', 'kaur', '123', '32131', NULL, 0, ',YBoTALvt7I|1', 1, '', '96AA93D6458E2EBB950F2C8D38D1F0AB'),
(30, 4, 'abc@gmail.com', 'a', '1234', 'a', 'b', '12121', 'as', NULL, 0, NULL, 0, 'c3eccefba4d913ab8450b0d1e81ed4f5', '973511FE768B92F17F460D7010E209C8'),
(31, 4, 'preetkaurpaik@gmail.com', 'gurpreet', '1234', 'gurpreet', 'kaur', '1223', '1212121', NULL, 0, '|5', 1, '', ''),
(32, 4, 'aman@alwaysinfotech.com', 'test2', '12345678', 'developer', 'test', '9111111', 'ldh', NULL, 0, NULL, 0, '4b35fa5809ef11caaf19ffea3a2c0f86', NULL),
(33, 4, 'aman1@alwaysinfotech.com', 'tst111', '12345678', 'developer', 'test2', '9111111', 'ldh', NULL, 0, NULL, 0, '6fcd3f1e33f3608b50ad38161c2dcdd3', NULL),
(34, 4, 'aman11@alwaysinfotech.com', 'test22', '12345678', 'test', 'test', 'dgfgf', 'ldh', NULL, 0, NULL, 0, '977549492c31cf4dd1e13f766aeed52e', NULL),
(35, 4, 'aman3@alwaysinfotech.com', 'test12', '12345678', 'developer', 'test', '9111111', 'ldh', NULL, 0, NULL, 0, '71703b8c0be4a58c425abb71803160f2', NULL),
(36, 4, 'aman34@alwaysinfotech.com', 'test124', '12345678', 'developer', 'test', '9111111', 'ldh', NULL, 0, NULL, 0, 'f0763c2f1c133cd799fd4807e349f406', NULL),
(37, 4, 'aman22@alwaysinfotech.com', 'test1222', '12345678', 'developer', 'test', '9111111', 'ldh', NULL, 0, NULL, 0, '7e8e70426621af5f350d67b5070b9640', NULL),
(38, 4, 'alwaysinfotech.developer@gmail.com', 'testgmail', '12341234', 'developer', 'test', '9111111', 'ldh', NULL, 0, NULL, 0, '8f135df318f1cdfadd2e25fd0ea0025f', NULL),
(39, 4, 'alwaysinfotech1@gmail.com', 'testgm', '12345678', 'developer1', 'test', '9111111111', 'ldh', ',0w3s8PaRQl', 0, '', 1, '', NULL),
(40, 4, 'kk978398@gmail.com', 'Komal', '123123', 'Komal', 'kaur', '5623444141424', 'gggjgjh3223', ',myfNGtiHYw,5J5eMKUHTk', 0, '', 1, '', ''),
(44, 3, 'gkpaik97@gmail.com', 'Preeti', '1234', 'Preet', 'Kaur', '12345698720', 'e21dd3e2', ',Q7LHVugUmg', 0, ',FAgUcsqCDY|3,vpiY7DZu3s|2', 1, '', ''),
(45, 3, 'princebhanwra@gmail.com', 'prince', 'testing', 'Prince', 'Bhanwra', '4662558393456', 'test address1', ',vpiY7DZu3s', 0, ',M9RZY95LDc|1', 1, '', ''),
(48, 8, 'alwaysinfotech1@gmail.com', 'abcd', '12345678', 'test11', 'test21', '911111111131', 'SWinnocentstone4', ',zNl6Gbmd6X', 0, ',UBVbyDkmTW|1,p49ctdH6Ka|1,Oqjf17QW0y|1,iD2Nnhu5Ke|2,M9RZY95LDc|2,ldmQ4XL4Ol|1', 1, '', NULL),
(49, 8, 'kk@gmail.com', 'klklk', '2312', 'komal', 'kaur', '1234567892', 'sssss', ',fCx6myuEaS', 0, ',evvw1FWN57|1|1|5|1,iD2Nnhu5Ke|1', 1, 'e5742e7fb52668524f7b7cae9a98e895', NULL),
(50, 8, 'kkh@gmail.com', 'admin', '123456', 'komal', 'kaur', '1234567895', '#kamal', NULL, 0, NULL, 0, 'd194fa2c484aee59ae2b377a7f83892e', NULL),
(51, 8, 'kr@gmail.com', 'jai', '5656', 'karan', 'kaur', '1234567892', 'hjj#jil', NULL, 0, NULL, 0, '4cb5f8d1cee918d1ed74a7955913299b', NULL),
(52, 8, 'ram@gmail.com', 'karan', '4561', 'raman', 'kaur', '4512369812', 'gfagf#jmk', NULL, 0, NULL, 0, '49c36bde161ce589cae03e3c9fa2ee22', NULL),
(53, 8, 'kk978398@gmail.com', 'alwaysinfotech@gmail.com', '1234', 'reema', 'kaur', '1234567891', 'sjfksjkf', NULL, 0, NULL, 1, '', ''),
(54, 8, 'ja@gmail.com', 'admin1', '4321', 'gita', 'kaur', '4561237891', 'jhdjhsjdsh', NULL, 0, NULL, 0, 'd5379e914f7582e340452f0312e40052', NULL),
(55, 8, 'ha@gmail.com', 'admin2', '7894', 'har', 'kaur', '7894561231', 'jshdjshjah', NULL, 0, NULL, 0, '2e76f0734f68a4a1e949dd693fde6837', NULL),
(56, 4, 'ha@gmail.com', 'admin', '1234', 'komal', 'kaur', '4561237891', 'ghgjgjh', NULL, 0, NULL, 0, '2e76f0734f68a4a1e949dd693fde6837', NULL),
(57, 4, 'rk@gmail.com', 'admin3', '4321', 'kara', 'ka', '4561237895', 'jhskkljljjjj', NULL, 0, NULL, 0, '02c6d717dab1109912fedc8aa77a7b83', NULL),
(59, 8, 'abc@gmail.com', 'admin4', '1234', 'simran', 'kaur', '7894561234', '#at mangat ram', ',p49ctdH6Ka,9GUBREftKh', 0, '|1,uNh48bP91K|1|1|1', 1, '', ''),
(60, 4, 'll@gmail.com', 'admin5', '1234', 'kamal', 'kaur', '1234567899', '# mangal singh', ',F54FdA8azK', 0, ',|2|2|1|1|1|1,mDPSYFKbHo|1,myi8hynNE8|1,xNJcxRS8CO|1|1', 1, '', ''),
(62, 8, 'alwaysinfotech@gmail.com', 'jass', '123456', 'Jaspreet1', 'Singh1', '10234567891', 'santa clara', NULL, 0, '', 1, '', ''),
(63, 3, 'alwaysinfotech@gmail.com', '977979749285', '123456', 'Jaspreet', 'Singh', '977979749285', 'santa clara', NULL, 0, '', 1, '', NULL);

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
(1, 'HSeLfrXBtN', 2, '06326B001A', 'Enna', 10000, 15, '1.5', 0.33, NULL, 61, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_1_0.jpg,bracelet_1_1.jpg,bracelet_1_2.jpg,', 'Bracelet Solitaire Flower in White gold set by 0,33ct diamonds.', 24, NULL, 'Bracelet Fleur Solitaire en Or blanc serti de 0,33ct de diamants.', 5),
(2, 'uABectOyEm', 2, '06326B002A', 'Grigoa', 10000, 15, '1.5', 0.33, NULL, 61, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_2_0.jpg,bracelet_2_1.jpg,bracelet_2_2.jpg,', 'Bracelet Solitaire Flower in Pink gold set by 0,33ct diamonds.', 24, NULL, 'Bracelet Fleur Solitaire en Or rose serti de 0,33ct de diamants.', 5),
(3, 'YUGOqIClvF', 2, '06329B001A', 'blanche', 10000, 15, '0.9', 0.2, NULL, 26, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_3_0.jpg,bracelet_3_1.jpg,bracelet_3_2.jpg,', 'Bracelet Heart in White gold set by 0,20ct diamonds.', 24, NULL, 'Bracelet Coeur en Or blanc serti de 0,20ct de diamants.', 5),
(4, 'IkMS83Vq1D', 2, '06329B002A', 'Blanche', 10000, 15, '0.9', 0.2, NULL, 26, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_4_0.jpg,bracelet_4_1.jpg,bracelet_4_2.jpg,', 'Bracelet Heart in Pink gold set by 0,20ct diamonds.', 24, NULL, 'Bracelet Coeur en Or rose serti de 0,20ct de diamants.', 5),
(5, 'EsKbMxf1U2', 2, '06330B001A', 'Dulcina', 10000, 15, '1.5', 0.36, NULL, 53, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_5_0.jpg,bracelet_5_1.jpg,bracelet_5_2.jpg,', 'Bracelet Flower in White gold set by 0,36ct diamonds.', 24, NULL, 'Bracelet Fleur en Or blanc serti de 0,36ct de diamants.', 5),
(6, 'i8C28d2mrT', 2, '06330B002A', 'Paola', 10000, 15, '1.5', 0.36, NULL, 53, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_6_0.jpg,bracelet_6_1.jpg,bracelet_6_2.jpg,', 'Bracelet Flower in Pink gold set by 0,36ct diamonds.', 24, NULL, 'Bracelet Fleur en Or rose serti de 0,36ct de diamants.', 5),
(7, '7CFsUgzgiH', 2, '06331B001A', 'Paola', 10000, 15, '1.5', 0.26, NULL, 38, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_7_0.jpg,bracelet_7_1.jpg,bracelet_7_2.jpg,', 'Bracelet Cloud in White gold set by 0,26ct diamonds.', 24, NULL, 'Bracelet Nuage en Or blanc serti de 0,26ct de diamants.', 5),
(8, 's3fUuMN5g3', 2, '06331B002A', 'Gara', 10000, 15, '1.4', 0.26, NULL, 38, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_8_0.jpg,bracelet_8_1.jpg,bracelet_8_2.jpg,', 'Bracelet Cloud in Pink gold set by 0,26ct diamonds.', 24, NULL, 'Bracelet Nuage en Or rose serti de 0,26ct de diamants.', 5),
(9, '2XkE2hDL1G', 2, '06332B001A', 'julie', 10000, 15, '1.6', 0.45, NULL, 65, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_9_0.jpg,bracelet_9_1.jpg,bracelet_9_2.jpg,', 'Bracelet Talisman in White gold set by 0,45ct diamonds.', 24, NULL, 'Bracelet Talisman en Or blanc serti de 0,45ct de diamants.', 5),
(10, 'i8QWv2b68t', 2, '06332B002A', 'July', 10000, 15, '1.5', 0.45, NULL, 65, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_10_0.jpg,bracelet_10_1.jpg,bracelet_10_2.jpg,', 'Bracelet Talisman in Pink gold set by 0,45ct diamonds.', 24, NULL, 'Bracelet Talisman en Or rose serti de 0,45ct de diamants.', 5),
(11, 'G8MrsZowzQ', 2, '06333B001A', 'Galit', 10000, 15, '1.4', 0.25, NULL, 79, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_11_0.jpg,bracelet_11_1.jpg,bracelet_11_2.jpg,', 'Bracelet Little Butterfly in White gold set by 0,25ct diamonds.', 24, NULL, 'Bracelet Papillon en Or blanc serti de 0,25ct de diamants.', 5),
(12, 'w6TKWTxSuS', 2, '06333B002A', 'Erica', 10000, 15, '1.3', 0.25, NULL, 79, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_12_0.jpg,bracelet_12_1.jpg,bracelet_12_2.jpg,', 'Bracelet Little Butterfly in Pink gold set by 0,25ct diamonds.', 24, NULL, 'Bracelet Papillon en Or rose serti de 0,25ct de diamants.', 5),
(13, 'mYGtsYHfQA', 2, '06334B001A', 'petunia', 10000, 15, '1', 0.2, NULL, 26, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_13_0.jpg,bracelet_13_1.jpg,bracelet_13_2.jpg,', 'Bracelet Circle in White gold set by 0,20ct diamonds.', 24, NULL, 'Bracelet Cercle en Or blanc serti de 0,20ct de diamants.', 5),
(14, 'LcsDTRSKvt', 2, '06334B002A', 'Petunia', 10000, 15, '0.9', 0.2, NULL, 26, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_14_0.jpg,bracelet_14_1.jpg,bracelet_14_2.jpg,', 'Bracelet Circle in Pink gold set by 0,20ct diamonds.', 24, NULL, 'Bracelet Cercle en Or rose serti de 0,20ct de diamants.', 5),
(15, 'L2m1d5VCqD', 2, '06335B001A', 'Gulsa', 10000, 15, '1.2', 0.2, NULL, 71, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_15_0.jpg,bracelet_15_1.jpg,bracelet_15_2.jpg,', 'Bracelet Clover in White gold set by 0,20ct diamonds.', 24, NULL, 'Bracelet Trèfle en Or blanc serti de 0,20ct de diamants.', 5),
(16, 'TmonDMwghl', 2, '06335B002A', 'Carrine', 10000, 15, '1.2', 0.2, NULL, 71, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_16_0.jpg,bracelet_16_1.jpg,bracelet_16_2.jpg,', 'Bracelet Clover in Pink gold set by 0,20ct diamonds.', 24, NULL, 'Bracelet Trèfle en Or rose serti de 0,20ct de diamants.', 5),
(17, '6vkiN323RU', 2, '06336B001A', 'Chrystelle', 10000, 15, '1.2', 0.23, NULL, 51, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_17_0.jpg,bracelet_17_1.jpg,bracelet_17_2.jpg,', 'Bracelet Rose in White gold set by 0,23ct diamonds.', 24, NULL, 'Bracelet Rose en Or blanc serti de 0,23ct de diamants.', 5),
(18, 'ZbarPH9IYO', 2, '06336B002A', 'carolina', 10000, 15, '1.2', 0.23, NULL, 51, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_18_0.jpg,bracelet_18_1.jpg,bracelet_18_2.jpg,', 'Bracelet Rose in Pink gold set by 0,23ct diamonds.', 24, NULL, 'Bracelet Rose en Or rose serti de 0,23ct de diamants.', 5),
(19, 'TknIiYo5Dl', 2, '06337B001A', 'Carolina', 10000, 15, '1.4', 0.34, NULL, 45, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_19_0.jpg,bracelet_19_1.jpg,bracelet_19_2.jpg,', 'Bracelet Node in White gold set by 0,34ct diamonds.', 24, NULL, 'Bracelet Noeud en Or blanc serti de 0,34ct de diamants.', 5),
(20, 'avXNq4BFgu', 2, '06337B002A', 'Laura', 10000, 15, '1.5', 0.34, NULL, 45, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_20_0.jpg,bracelet_20_1.jpg,bracelet_20_2.jpg,', 'Bracelet Node in Pink gold set by 0,34ct diamonds.', 24, NULL, 'Bracelet Noeud en Or rose serti de 0,34ct de diamants.', 5),
(21, 'ZJfrafIubt', 2, '06338B001A', 'Laura', 10000, 15, '0.6', 0.15, NULL, 38, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_21_0.jpg,bracelet_21_1.jpg,bracelet_21_2.jpg,', 'Bracelet Heart with Wings in White gold set by 0,15ct diamonds on cord with sliding clasp.', 24, NULL, 'Bracelet sur cordon Cœur avec Ailes en Or blanc serti de 0,15ct de diamants.', 5),
(22, 'IBYjaIz1rg', 2, '06338B002A', 'Guvia', 10000, 15, '1.1', 0.15, NULL, 38, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_22_0.jpg,bracelet_22_1.jpg,bracelet_22_2.jpg,', 'Bracelet Heart with Wings in Pink gold set by 0,15ct diamonds.', 24, NULL, 'Bracelet Cœur avec Ailes en Or rose serti de 0,15ct de diamants.', 5),
(23, '9oDVtVz4Li', 2, '06339B002A', 'florenca', 10000, 15, '0.9', 0.09, NULL, 21, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_23_0.jpg,bracelet_23_1.jpg,bracelet_23_2.jpg,', 'Bracelet Mouth in Pink gold set by 0,09ct diamonds.', 24, NULL, 'Bracelet Bouche en Or rose serti de 0,09ct de diamants.', 5),
(24, '25Yuv75rM9', 2, '06339B001A', 'Florenca', 10000, 15, '0.8', 0.09, NULL, 21, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_24_0.jpg,bracelet_24_1.jpg,bracelet_24_2.jpg,', 'Bracelet Mouth in White gold set by 0,09ct diamonds.', 24, NULL, 'Bracelet Bouche en Or blanc serti de 0,09ct de diamants.', 5),
(25, 'o2WVVBHkKJ', 2, '06340B002A', 'Roby', 10000, 15, '0.9', 0.16, NULL, 25, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_25_0.jpg,bracelet_25_1.jpg,bracelet_25_2.jpg,', 'Bracelet Clover in White gold set by 0,16ct diamonds.', 24, NULL, 'Bracelet Trèfle en Or blanc serti de 0,16ct de diamants.', 5),
(26, 'CDsM8w7Hy0', 2, '06340B003A', 'Audrey', 10000, 15, '1', 0.16, NULL, 25, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_26_0.jpg,bracelet_26_1.jpg,bracelet_26_2.jpg,', 'Bracelet Clover in Pink gold set by 0,16ct diamonds.', 24, NULL, 'Bracelet Trèfle en Or rose serti de 0,16ct de diamants.', 5),
(27, 'Nh7HDHLnPl', 2, '06340B001A', 'Audrey', 10000, 15, '0.4', 0.16, NULL, 25, 0, 1, 0, 'SI1', 1, 8, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_27_0.jpg,bracelet_27_1.jpg,bracelet_27_2.jpg,', 'Bracelet Clover in Black gold set by 0,16ct Black diamonds on cord with sliding clasp.', 24, NULL, 'Bracelet sur cordon Trèfle en Or noir serti de 0,16ct de diamants noirs.', 5),
(28, 'bsfXoYpYkw', 2, '06341B001A', 'Gemilna', 10000, 15, '0.8', 0.12, NULL, 19, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_28_0.jpg,bracelet_28_1.jpg,bracelet_28_2.jpg,', 'Bracelet One Wing in White gold set by 0,21ct diamonds.', 24, NULL, 'Bracelet Une Aile en Or blanc serti de 0,12ct de diamants.', 5),
(29, 'Ea5lJT6mLu', 2, '06341B002A', 'Jennyfer', 10000, 15, '0.9', 0.12, NULL, 19, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_29_0.jpg,bracelet_29_1.jpg,bracelet_29_2.jpg,', 'Bracelet One Wing in Pink gold set by 0,21ct diamonds.', 24, NULL, 'Bracelet Une Aile en Or rose serti de 0,12ct de diamants.', 5),
(30, 'yBBVl4uJS1', 2, '06342B002A', 'Agnes', 10000, 15, '1', 0.18, NULL, 46, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_30_0.jpg,bracelet_30_1.jpg,bracelet_30_2.jpg,', 'Bracelet Flower in Pink gold set by 0,18ct diamonds.', 24, NULL, 'Bracelet Fleur en Or rose serti de 0,18ct de diamants.', 5),
(31, 'RPYbUOv3WB', 2, '06342B001A', 'kenza', 10000, 15, '0.9', 0.18, NULL, 46, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_31_0.jpg,bracelet_31_1.jpg,bracelet_31_2.jpg,', 'Bracelet Flower in White gold set by 0,18ct diamonds.', 24, NULL, 'Bracelet Fleur en Or blanc serti de 0,18ct de diamants.', 5),
(32, 'xqkYCcz2KK', 2, '06343B002A', 'Kenza', 10000, 15, '1', 0.12, NULL, 20, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_32_0.jpg,bracelet_32_1.jpg,bracelet_32_2.jpg,', 'Bracelet Circle surrounded in Pink gold set by 0,12ct diamonds.', 24, NULL, 'Bracelet Cercle entouré en Or rose serti de 0,12ct de diamants.', 5),
(33, 'TU7fO2J8CA', 2, '06343B001A', 'Gulcina', 10000, 15, '0.5', 0.12, NULL, 20, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_33_0.jpg,bracelet_33_1.jpg,', 'Bracelet Circle surrounded in White gold set by 0,12ct diamonds on cord with sliding clasp.', 24, NULL, 'Bracelet sur cordon Cercle entouré en Or blanc serti de 0,12ct de diamants.', 5),
(34, 'KeMRjddnrP', 2, '06344B001A', 'Ghismonde', 10000, 15, '0.9', 0.12, NULL, 16, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_34_0.jpg,bracelet_34_1.jpg,bracelet_34_2.jpg,', 'Bracelet Heart surrounded in White gold set by 0,12ct diamonds.', 24, NULL, 'Bracelet Coeur entouré en Or blanc serti de 0,12ct de diamants.', 5),
(35, '3vWtJm5JYI', 2, '06344B002A', 'Ghita', 10000, 15, '1', 0.12, NULL, 16, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_35_0.jpg,bracelet_35_1.jpg,bracelet_35_2.jpg,', 'Bracelet Heart surrounded in Pink gold set by 0,12ct diamonds.', 24, NULL, 'Bracelet Coeur entouré en Or rose serti de 0,12ct de diamants.', 5),
(36, 'NGST2Wqsig', 2, '06345B001A', 'Josefa', 10000, 15, '0.8', 0.13, NULL, 64, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_36_0.jpg,bracelet_36_1.jpg,', 'Bracelet Clover in White gold paved by 0,13ct diamonds.', 24, NULL, 'Bracelet Trèfle pavé en Or blanc serti de 0,13ct de diamants.', 5),
(37, 'ZcPgNd9E38', 2, '06345B002A', 'Josefa', 10000, 15, '0.8', 0.13, NULL, 64, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_37_0.jpg,bracelet_37_1.jpg,bracelet_37_2.jpg,', 'Bracelet Clover in Pink gold paved by 0,13ct diamonds.', 24, NULL, 'Bracelet Trèfle pavé en Or rose serti de 0,13ct de diamants.', 5),
(38, 'RyVA0ClksO', 2, '06346B002A', 'Fila', 10000, 15, '1', 0.21, NULL, 28, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_38_0.jpg,bracelet_38_1.jpg,bracelet_38_2.jpg,', 'Bracelet Peace & Love in White gold set by 0,21ct diamonds.', 24, NULL, 'Bracelet Symbole Peace & Love en Or blanc serti de 0,21ct de diamants.', 5),
(39, 'CoacsI4tcC', 2, '06346B001A', 'Fila', 10000, 15, '0.5', 0.21, NULL, 28, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_39_0.jpg,bracelet_39_1.jpg,bracelet_39_2.jpg,', 'Bracelet Peace & Love in Pink gold set by 0,21ct diamonds on cord with sliding clasp.', 24, NULL, 'Bracelet sur cordon Symbole Peace & Love en Or rose serti de 0,21ct de diamants.', 5),
(40, 'Wd34vyWvxH', 2, '06347B002A', 'Violetta', 10000, 15, '0.8', 0.1, NULL, 43, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_40_0.jpg,bracelet_40_1.jpg,bracelet_40_2.jpg,', 'Bracelet Heart in Pink gold paved by 0,10ct diamonds.', 24, NULL, 'Bracelet Cœur Pavé en Or rose serti de 0,10ct de diamants.', 5),
(41, 'mPsmT464wb', 2, '06347B001A', 'Mana', 10000, 15, '0.8', 0.1, NULL, 43, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_41_0.jpg,bracelet_41_1.jpg,bracelet_41_2.jpg,', 'Bracelet Heart in White gold paved by 0,10ct diamonds.', 24, NULL, 'Bracelet Cœur Pavé en Or blanc serti de 0,10ct de diamants.', 5),
(42, 'E4uuuTGItJ', 2, '06348B001A', 'Philippine', 10000, 15, '0.2', 0.04, NULL, 16, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_42_0.jpg,bracelet_42_1.jpg,bracelet_42_2.jpg,', 'Bracelet Node in Pink gold set by 0,04ct diamonds on cord with sliding clasp.', 24, NULL, 'Bracelet sur cordon Noeud en Or rose serti de 0,04ct de diamants.', 5),
(43, 'AXRE2Iff7c', 2, '06348B002A', 'Tessa', 10000, 15, '0.7', 0.04, NULL, 16, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_43_0.jpg,bracelet_43_1.jpg,bracelet_43_2.jpg,', 'Bracelet Node in White gold set by 0,04ct diamonds.', 24, NULL, 'Bracelet Noeud en Or blanc serti de 0,04ct de diamants.', 5),
(44, 'GXVBXeiz4G', 2, '06349B002A', 'Melissa', 10000, 15, '0.4', 0.08, NULL, 29, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_44_0.jpg,bracelet_44_1.jpg,bracelet_44_2.jpg,', 'Bracelet Node in White gold set by 0,04ct diamonds on cord with sliding clasp.', 24, NULL, 'Bracelet sur cordon Noeud en Or blanc serti de 0,04ct de diamants.', 5),
(45, 'gPUCFPbnNy', 2, '06349B001A', 'Melissa', 10000, 15, '0.4', 0.08, NULL, 29, 0, 1, 0, 'SI1', 1, 8, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_45_0.jpg,bracelet_45_1.jpg,bracelet_45_2.jpg,', 'Bracelet Node in Black gold set by 0,04ct black diamonds on cord with sliding clasp.', 24, NULL, 'Bracelet sur cordon Noeud en Or noir serti de 0,04ct de diamants noirs.', 5),
(46, 'QhGMuoAmDo', 2, '06349B003A', 'Gianla', 10000, 15, '0.8', 0.08, NULL, 29, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_46_0.jpg,bracelet_46_1.jpg,bracelet_46_2.jpg,', 'Bracelet Node in Pink gold set by 0,04ct diamonds.', 24, NULL, 'Bracelet Noeud en Or rose serti de 0,04ct de diamants.', 5),
(47, 'TfRwyxzy9X', 2, '06350B001A', 'monica', 9998, 15, '0.2', 0.08, NULL, 31, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_47_0.jpg,bracelet_47_1.jpg,bracelet_47_2.jpg,', 'Bracelet Star in White gold Paved by 0,08ct diamonds on cord with sliding clasp.', 24, NULL, 'Bracelet sur cordon Etoile Pavée en Or blanc serti de 0,08ct de diamants.', 5),
(48, 'FNN2Vwh4JO', 2, '06350B002A', 'Monica', 10000, 15, '0.4', 0.08, NULL, 31, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_48_0.jpg,bracelet_48_1.jpg,bracelet_48_2.jpg,', 'Bracelet Star in Pink gold Paved by 0,08ct diamonds.', 24, NULL, 'Bracelet Etoile Pavée en Or rose serti de 0,08ct de diamants.', 5),
(49, 'b7SiCDY0pV', 2, '06351B001A', 'Gypsi', 10000, 15, '0.4', 0.08, NULL, 27, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_49_0.jpg,bracelet_49_1.jpg,bracelet_49_2.jpg,', 'Bracelet Butterfly in White gold set by 0,08ct diamonds on cord with sliding clasp.', 24, NULL, 'Bracelet sur cordon Papillon en Or blanc serti de 0,08ct de diamants.', 5),
(50, 'i8ZOpBV8DK', 2, '06351B002A', 'anouk', 10000, 15, '1', 0.08, NULL, 27, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_50_0.jpg,bracelet_50_1.jpg,bracelet_50_2.jpg,', 'Bracelet Butterfly in Pink gold set by 0,08ct diamonds.', 24, NULL, 'Bracelet Papillon en Or rose serti de 0,08ct de diamants.', 5),
(51, 'Nh3IiYq7O0', 2, '06352B002A', 'Annouk', 10000, 15, '1.2', 0.28, NULL, 37, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_51_0.jpg,bracelet_51_1.jpg,bracelet_51_2.jpg,', 'Bracelet Circle in Pink gold Paved by 0,28ct diamonds.', 24, NULL, 'Bracelet Cercle pavé en Or rose serti de 0,28ct de diamants.', 5),
(52, 'D9RAOoqj8i', 2, '06352B001A', 'Gueda', 10000, 15, '1.1', 0.28, NULL, 37, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_52_0.jpg,bracelet_52_1.jpg,bracelet_52_2.jpg,', 'Bracelet Circle in White gold Paved by 0,28ct diamonds.', 24, NULL, 'Bracelet Cercle pavé en Or blanc serti de 0,28ct de diamants.', 5),
(53, 'Z3UPW59j1K', 2, '06353B002A', 'Jade', 10000, 15, '1', 0.13, NULL, 21, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_53_0.jpg,bracelet_53_1.jpg,bracelet_53_2.jpg,', 'Bracelet Bear Cub in White gold Paved by 0,13ct diamonds.', 24, NULL, 'Bracelet Ourson Pavée en Or blanc serti de 0,13ct de diamants.', 5),
(54, 'L4eQgAAkoR', 2, '06353B001A', 'Saphir', 10000, 15, '0.5', 0.13, NULL, 21, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_54_0.jpg,bracelet_54_1.jpg,bracelet_54_2.jpg,', 'Bracelet Bear Cub in Pink gold Paved by 0,13ct diamonds.', 24, NULL, 'Bracelet sur cordon Ourson Pavée en Or rose serti de 0,13ct de diamants.', 5),
(55, 'bSmZPIn5zU', 2, '06354B001A', 'maya', 9999, 15, '1.3', 0.02, NULL, 2, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_55_0.jpg,bracelet_55_1.jpg,', 'Bracelet Skull in White gold set by 0,02ct diamonds.', 24, NULL, 'Bracelet Tête de Mort en Or blanc serti de 0,02ct de diamants.', 5),
(56, '8KBnvtbUtJ', 2, '06354B002A', 'Maya', 9999, 15, '1.2', 0.02, NULL, 2, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_56_0.jpg,bracelet_56_1.jpg,bracelet_56_2.jpg,', 'Bracelet Skull in Pink gold set by 0,02ct diamonds.', 24, NULL, 'Bracelet Tête de Mort en Or rose serti de 0,02ct de diamants.', 5),
(57, 'br1aA7wnuI', 2, '06355B002A', 'salomé', 10000, 15, '0.9', 0.1, NULL, 32, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_57_0.jpg,bracelet_57_1.jpg,', 'Bracelet Rabbit in Pink gold set by 0,10ct diamonds.', 24, NULL, 'Bracelet Lapin en Or rose serti de 0,10ct de diamants.', 5),
(58, 'X04mUjXDXg', 2, '06355B001A', 'Salomé', 10000, 15, '0.9', 0.1, NULL, 32, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_58_0.jpg,bracelet_58_1.jpg,bracelet_58_2.jpg,', 'Bracelet Rabbit in White gold set by 0,10ct diamonds.', 24, NULL, 'Bracelet Lapin en Or blanc serti de 0,10ct de diamants.', 5),
(59, 'QRX7hqHwLL', 2, '06356B001A', 'elena', 10000, 15, '1.1', 0.18, NULL, 34, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_59_0.jpg,bracelet_59_1.jpg,bracelet_59_2.jpg,', 'Bracelet Heart pierced in White gold set by 0,18ct diamonds.', 24, NULL, 'Bracelet Cœur percé en Or blanc serti de 0,18ct de diamants.', 5),
(60, 'tOuCAAcJcw', 2, '06356B002A', 'Elena', 10000, 15, '1', 0.18, NULL, 34, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_60_0.jpg,bracelet_60_1.jpg,bracelet_60_2.jpg,', 'Bracelet Heart pierced in Pink gold set by 0,18ct diamonds.', 24, NULL, 'Bracelet Cœur percé en Or rose serti de 0,18ct de diamants.', 5),
(61, 'XLpQ5NI1Gm', 2, '06357B002A', 'Paza', 9997, 15, '1', 0.12, NULL, 43, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_61_0.jpg,bracelet_61_1.jpg,bracelet_61_2.jpg,', 'Bracelet Candy in Pink gold set by 0,12ct diamonds.', 24, NULL, 'Bracelet Bonbon en Or rose serti de 0,12ct de diamants.', 5),
(62, 'RS06ZUMkU6', 2, '06357B001A', 'capu', 10000, 15, '0.9', 0.12, NULL, 43, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_62_0.jpg,bracelet_62_1.jpg,bracelet_62_2.jpg,', 'Bracelet Candy in White gold set by 0,12ct diamonds.', 24, NULL, 'Bracelet Bonbon en Or blanc serti de 0,12ct de diamants.', 5),
(63, 'Qq13I395Bk', 2, '06358B001A', 'Capu', 10000, 15, '0.9', 0.19, NULL, 33, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_63_0.jpg,bracelet_63_1.jpg,bracelet_63_2.jpg,', 'Bracelet Guitar in White gold set by 0,19ct diamonds.', 24, NULL, 'Bracelet Guitare en Or blanc serti de 0,19ct de diamants.', 5),
(64, 'GvGRGA0VPo', 2, '06358B002A', 'Roussa', 10000, 15, '0.9', 0.19, NULL, 33, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_64_0.jpg,bracelet_64_1.jpg,bracelet_64_2.jpg,', 'Bracelet Guitar in Pink gold set by 0,19ct diamonds.', 24, NULL, 'Bracelet Guitare en Or rose serti de 0,19ct de diamants.', 5),
(65, 'WZlh9k6pFc', 2, '06359B002A', 'eleonore', 10000, 15, '1.1', 0.19, NULL, 40, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_65_0.jpg,bracelet_65_1.jpg,bracelet_65_2.jpg,', 'Bracelet Gun in Pink gold set by 0,19ct diamonds.', 24, NULL, 'Bracelet Revolver en Or rose serti de 0,19ct de diamants.', 5),
(66, 'Rb4mOSREdH', 2, '06359B001A', 'Elene', 10000, 15, '1', 0.19, NULL, 40, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_66_0.jpg,bracelet_66_1.jpg,bracelet_66_2.jpg,', 'Bracelet Gun in White gold set by 0,19ct diamonds.', 24, NULL, 'Bracelet Revolver en Or blanc serti de 0,19ct de diamants.', 5),
(67, 'xcdIUkn5EU', 2, '06360B001A', 'Fleur', 10000, 15, '0.9', 0.17, NULL, 27, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_67_0.jpg,bracelet_67_1.jpg,bracelet_67_2.jpg,', 'Bracelet Infinity in White gold set by 0,17ct diamonds.', 24, NULL, 'Bracelet Infini en Or blanc serti de 0,17ct de diamants.', 5),
(68, 'yOn6XfvN7U', 2, '06360B002A', 'Fleur', 10000, 15, '0.9', 0.17, NULL, 27, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_68_0.jpg,bracelet_68_1.jpg,bracelet_68_2.jpg,', 'Bracelet Infinity in Pink gold set by 0,17ct diamonds.', 24, NULL, 'Bracelet Infini en Or rose serti de 0,17ct de diamants.', 5),
(69, 'cxXkY2rswY', 2, '06361B001A', 'Chloe', 10000, 15, '1.2', 0.21, NULL, 28, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_69_0.jpg,bracelet_69_1.jpg,bracelet_69_2.jpg,', 'Bracelet David Star in White gold set by 0,21ct diamonds.', 24, NULL, 'Bracelet Etoile de David entouré en Or blanc serti de 0,21ct de diamants.', 5),
(70, 'kBPYwjcw1M', 2, '06361B002A', 'Chloe', 10000, 15, '1.1', 0.21, NULL, 28, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_70_0.jpg,bracelet_70_1.jpg,bracelet_70_2.jpg,', 'Bracelet David Star in Pink gold set by 0,21ct diamonds.', 24, NULL, 'Bracelet Etoile de David entouré en Or rose serti de 0,21ct de diamants.', 5),
(71, 'qgi9NY3uBX', 2, '06362B002A', 'Iris', 10000, 15, '0.8', 0.09, NULL, 36, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_71_0.jpg,bracelet_71_1.jpg,bracelet_71_2.jpg,', 'Bracelet Little Flower in Pink gold set by 0,09ct diamonds.', 24, NULL, 'Bracelet Petite Fleur en Or rose serti de 0,09ct de diamants.', 5),
(72, 'iFK86QdEX3', 2, '06362B001A', 'Iris', 10000, 15, '0.9', 0.09, NULL, 36, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_72_0.jpg,bracelet_72_1.jpg,bracelet_72_2.jpg,', 'Bracelet Little Flower in White gold set by 0,09ct diamonds.', 24, NULL, 'Bracelet Petite Fleur en Or blanc serti de 0,09ct de diamants.', 5),
(73, 'Xb873Gq9tJ', 2, '05458B006A', 'pamela', 10000, 15, '1.2', 0.18, NULL, 32, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_73_0.jpg,bracelet_73_1.jpg,bracelet_73_2.jpg,', 'Bracelet Oval in White gold set by 0,18ct diamonds.', 24, '0', 'Bracelet Ovale en Or blanc serti de 0,18ct de diamants.', 5),
(74, 'oPVJp7mpoR', 2, '01538B188A', 'rachel', 10000, 15, '7.6', 1, NULL, 123, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_74_0.jpg,bracelet_74_1.jpg,bracelet_74_2.jpg,', 'River Bracelet in White gold set by 1 ct diamonds.', 24, '0', 'Bracelet Rivière en Or blanc serti d\' 1 ct de diamants.', 5),
(75, 'iHsSQgswTD', 2, '04923B019A', 'lilia', 10000, 15, '1.3', 0.16, NULL, 34, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '18', 2, NULL, 2, 'bracelet_75_0.jpg,bracelet_75_1.jpg,bracelet_75_2.jpg,', 'Bracelet Butterfly in White gold set by 0,16ct diamonds', 24, '0', 'Bracelet Papillon en Or blanc serti de 0,16ct de diamants.', 5);

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
(1, 'GUEXazpvD3', 2, '65550E001A', 'Ghizlan', 10000, 15, '3.6', 0.6, NULL, 204, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_1_0.jpg,earring_1_1.jpg,earring_1_2.jpg,', 'Wings Earrings in White gold set by 0,60ct diamonds.', 9, NULL, 'Boucles d\'oreilles Aile Pavée en Or blanc serties de 0,60ct de diamants.', 5),
(2, '6mya90nv0c', 2, '65550E002A', 'Gia', 10000, 15, '3.6', 0.6, NULL, 204, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_2_0.jpg,earring_2_1.jpg,earring_2_2.jpg,', 'Wings Black & White Earrings in White gold set by 0,60ct diamonds.', 9, NULL, 'Boucles d\'oreilles Aile Pavée Black & White en Or blanc serties de 0,60ct de diamants blancs et noirs.', 5),
(3, 'YaKDN4zQEK', 2, '65551E001A', 'Nicoline', 10000, 15, '1.4', 0.21, NULL, 86, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_3_0.jpg,earring_3_1.jpg,earring_3_2.jpg,', 'Cannabis Flower Earrings in White gold set by 0,21ct diamonds.', 9, NULL, 'Boucles d\'oreilles Fleur de Cannabis en Or blanc serties de 0,21ct de diamants.', 5),
(4, 'xZC4AJ9CAC', 2, '65551E002A', 'Meli', 10000, 15, '1.4', 0.21, NULL, 86, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_4_0.jpg,earring_4_1.jpg,earring_4_2.jpg,', 'Cannabis Flower Black & White Earrings in White gold set by 0,21ct diamonds.', 9, NULL, 'Boucles d\'oreilles Cannabis Black & White en Or blanc serties de 0,21ct de diamants blancs et noirs.', 5),
(5, 'fByj4KcmSK', 2, '65552E001A', 'Mely', 10000, 15, '1.5', 0.26, NULL, 96, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_5_0.jpg,earring_5_1.jpg,earring_5_2.jpg,', 'Tulip Flower Earrings in White gold set by 0,26ct diamonds.', 9, NULL, 'Boucles d\'oreilles Tulipe en Or blanc serties de 0,26ct de diamants.', 5),
(6, 'pxOspT8hsR', 2, '65552E002A', 'Valoche', 10000, 15, '1.5', 0.26, NULL, 96, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_6_0.jpg,earring_6_1.jpg,earring_6_2.jpg,', 'Tulip Flower Black & White Earrings in White gold set by 0,26ct diamonds.', 9, NULL, 'Boucles d\'oreilles Tulipe Black & White en Or blanc serties de 0,26ct de diamants blancs et noirs.', 5),
(7, 'cFkCbeJJm9', 2, '65561E001A', 'Fabienne', 10000, 15, '1.8', 0.42, NULL, 56, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_7_0.jpg,earring_7_1.jpg,earring_7_2.jpg,', 'Hoop Earrings in White gold set by 0,42ct diamonds.', 9, NULL, 'Boucles d\'oreilles Créoles en Or blanc serties griffes de 0,42ct de diamants.', 5),
(8, '7zix42hsNe', 2, '65561E002A', 'manon', 10000, 15, '1.8', 0.42, NULL, 56, 0, 1, 0, 'SI1', 1, 8, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_8_0.jpg,earring_8_1.jpg,earring_8_2.jpg,', 'Hoop Earrings in Black gold set by 0,42ct diamonds.', 9, NULL, 'Boucles d\'oreilles Créoles en Or noir serties griffes de 0,42ct de diamants.', 5),
(9, 'WTBg2yGmaX', 2, '65562E002A', 'Manon', 9999, 15, '2.6', 0.6, NULL, 122, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_9_0.jpg,earring_9_1.jpg,earring_9_2.jpg,', 'Pendants Flowers Solitaire Earrings in Pink gold set by 0,60ct diamonds.', 9, NULL, 'Boucles d\'oreilles Fleurs Solitaires Pendantes en Or rose serties de 0,60ct de diamants.', 5),
(10, 'Wlcz0Jp01n', 2, '65562E001A', 'Bogy', 10000, 15, '4.5', 0.6, NULL, 122, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_10_0.jpg,earring_10_1.jpg,earring_10_2.jpg,', 'Pendants Flowers Solitaire Earrings in White gold set by 0,60ct diamonds.', 9, NULL, 'Boucles d\'oreilles Fleurs Solitaires Pendantes en Or blanc serties de 0,60ct de diamants.', 5),
(11, 'PJY0vOmhgt', 2, '65562E003A', 'Bogy', 10000, 15, '4.5', 0.6, NULL, 122, 0, 1, 0, 'SI1', 1, 8, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_11_0.jpg,earring_11_1.jpg,earring_11_2.jpg,', 'Pendants Flowers Solitaire Earrings in Black gold set by 0,60ct diamonds.', 9, NULL, 'Boucles d\'oreilles Fleurs Solitaires Pendantes en Or noir serties de 0,60ct de diamants.', 5),
(12, '61yWUc8jzw', 2, '65564E002A', 'Geralde', 10000, 15, '1.4', 0.33, NULL, 122, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_12_0.jpg,earring_12_1.jpg,earring_12_2.jpg,', ' Flowers Solitaire Earrings in Pink gold set by 0,33ct diamonds.', 9, NULL, 'Boucles d\'oreilles Fleurs Solitaires en Or rose serties de 0,33ct de diamants.', 5),
(13, 'vYAfMIdWRU', 2, '65564E001A', 'Giliana', 10000, 15, '1.5', 0.33, NULL, 122, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_13_0.jpg,earring_13_1.jpg,earring_13_2.jpg,', ' Flowers Solitaire Earrings in White gold set by 0,33ct diamonds.', 9, NULL, 'Boucles d\'oreilles Fleurs Solitaires en Or blanc serties de 0,33ct de diamants.', 5),
(14, 'ogEL8jrSYO', 2, '65567E001A', 'eden', 10000, 15, '2.7', 0.66, NULL, 254, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_14_0.jpg,earring_14_1.jpg,earring_14_2.jpg,', 'Double Tear Earrings in White gold Paved by 0,66ct diamonds.', 9, NULL, 'Boucles d\'oreilles Double Goutte Pavée en Or blanc serties de 0,66ct de Diamants.', 5),
(15, '7egnOeNpUz', 2, '65567E002A', 'Eden', 10000, 15, '2.7', 0.66, NULL, 254, 0, 1, 0, 'SI1', 1, 8, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_15_0.jpg,earring_15_1.jpg,earring_15_2.jpg,', 'Double Tear Earrings in Black gold Paved by 0,66ct diamonds.', 9, NULL, 'Boucles d\'oreilles Double Goutte Pavée en Or noir serties de 0,66ct de Diamants.', 5),
(16, 'WFkJBYiFAq', 2, '65585E002A', 'Gerlinde', 10000, 15, '1.1', 0.17, NULL, 42, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_16_0.jpg,earring_16_1.jpg,earring_16_2.jpg,', 'Mouth Earrings in Pink gold set by 0,17ct diamonds.', 9, NULL, 'Boucles d\'oreilles Bouche en Or rose serties de 0,17ct de Diamants.', 5),
(17, 'kN3tm2aqeU', 2, '65585E001A', 'Geza', 10000, 15, '1.1', 0.17, NULL, 42, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_17_0.jpg,earring_17_1.jpg,earring_17_2.jpg,', 'Mouth Earrings in White gold set by 0,17ct diamonds.', 9, NULL, 'Boucles d\'oreilles Bouche en Or blanc serties de 0,17ct de Diamants.', 5),
(18, '62gVbDmKaX', 2, '65587E001A', 'Gauderika', 10000, 15, '1.2', 0.24, NULL, 38, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_18_0.jpg,earring_18_1.jpg,earring_18_2.jpg,', 'Wings Earrings in White gold set by 0,24ct diamonds.', 9, NULL, 'Boucles d\'oreilles Ailes en Or blanc serties de 0,24ct de Diamants.', 5),
(19, 'anxsEUmq7o', 2, '65587E002A', 'Gaya', 10000, 15, '1.2', 0.24, NULL, 38, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_19_0.jpg,earring_19_1.jpg,earring_19_2.jpg,', 'Wings Earrings in Pink gold set by 0,24ct diamonds.', 9, NULL, 'Boucles d\'oreilles Ailes en Or rose serties de 0,24ct de Diamants.', 5),
(20, 'i32o9LU9bW', 2, '65588E001A', 'valentina', 10000, 15, '1.5', 0.25, NULL, 40, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_20_0.jpg,earring_20_1.jpg,earring_20_2.jpg,', 'Circle surrounded Earrings in White gold set by 0,25ct diamonds.', 9, NULL, 'Boucles d\'oreilles Cercle entouré en Or blanc serties de 0,25ct de Diamants.', 5),
(21, 'YszP0Je48u', 2, '65588E002A', 'Valentina', 10000, 15, '1.4', 0.25, NULL, 40, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_21_0.jpg,earring_21_1.jpg,earring_21_2.jpg,', 'Circle surrounded Earrings in Pink gold set by 0,25ct diamonds.', 9, NULL, 'Boucles d\'oreilles Cercle entouré en Or rose serties de 0,25ct de Diamants.', 5),
(22, 'ki7xgshGGK', 2, '65589E001A', 'Brigitte', 10000, 15, '1.3', 0.24, NULL, 32, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_22_0.jpg,earring_22_1.jpg,earring_22_2.jpg,', 'Heart surrounded Earrings in White gold set by 0,24ct diamonds.', 9, NULL, 'Boucles d\'oreilles Coeur entouré en Or blanc serties de 0,24ct de Diamants.', 5),
(23, 'P1IoIr7mFC', 2, '65589E002A', 'Cindy', 10000, 15, '1.3', 0.24, NULL, 32, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_23_0.jpg,earring_23_1.jpg,earring_23_2.jpg,', 'Heart surrounded Earrings in Pink gold set by 0,24ct diamonds.', 9, NULL, 'Boucles d\'oreilles Coeur entouré en Or rose serties de 0,24ct de Diamants.', 5),
(24, 'xABrWSu0qA', 2, '65590E002A', 'Gulbara', 10000, 15, '1.2', 0.26, NULL, 128, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_24_0.jpg,earring_24_1.jpg,earring_24_2.jpg,', 'Clover Earrings in Pink gold Paved by 0,26ct diamonds.', 9, NULL, 'Boucles d\'oreilles Trèfle Pavé en Or rose serties de 0,26ct de Diamants.', 5),
(25, 'f6xJL3PIFi', 2, '65590E001A', 'Guiseppa', 10000, 15, '1.3', 0.26, NULL, 128, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_25_0.jpg,earring_25_1.jpg,earring_25_2.jpg,', 'Clover Earrings in White gold Paved by 0,26ct diamonds.', 9, NULL, 'Boucles d\'oreilles Trèfle Pavé en Or blanc serties de 0,26ct de Diamants.', 5),
(26, 'XAQvkEV8bU', 2, '65591E002A', ' DIAMOND PENDANT', 10000, 15, '1.5', 0.42, NULL, 56, 0, 1, 0, 'SI1', 1, 8, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_26_0.jpg,earring_26_1.jpg,earring_26_2.jpg,', 'Peace & Love Earrings in Black gold set by 0,42ct Black diamonds.', 9, NULL, 'Boucles d\'oreilles Symbole Peace & Love en Or noir serties de 0,42ct de Diamants noirs.', 5),
(27, 'VZ9RYyPMrS', 2, '65591E001A', 'Alexandra', 10000, 15, '1.4', 0.42, NULL, 56, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_27_0.jpg,earring_27_1.jpg,earring_27_2.jpg,', 'Peace & Love Earrings in Pink gold set by 0,42ct diamonds.', 9, NULL, 'Boucles d\'oreilles Symbole Peace & Love en Or rose serties de 0,42ct de Diamants.', 5),
(28, 'XW3lmc5DYz', 2, '65592E002A', 'Beatrice', 10000, 15, '1', 0.21, NULL, 86, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_28_0.jpg,earring_28_1.jpg,earring_28_2.jpg,', 'Heart Earrings in Pink gold Paved by 0,21ct diamonds.', 9, NULL, 'Boucles d\'oreilles Coeur Pavé en Or rose serties de 0,21ct de Diamants.', 5),
(29, 'm252zWuEWZ', 2, '65592E001A', 'Gelinda', 10000, 15, '1', 0.21, NULL, 86, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_29_0.jpg,earring_29_1.jpg,earring_29_2.jpg,', 'Heart Earrings in White gold Paved by 0,21ct diamonds.', 9, NULL, 'Boucles d\'oreilles Coeur Pavé en Or blanc serties de 0,21ct de Diamants.', 5),
(30, '3Pb0DjFmLS', 2, '65593E002A', 'Gema', 10000, 15, '0.9', 0.09, NULL, 32, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_30_0.jpg,earring_30_1.jpg,earring_30_2.jpg,', 'Node Earrings in Pink gold set by 0,09ct diamonds.', 9, NULL, 'Boucles d\'oreilles Noeud en Or rose serties de 0,09ct de Diamants.', 5),
(31, 'Z0z11IbWdh', 2, '65593E001A', 'lison', 10000, 15, '1', 0.09, NULL, 32, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_31_0.jpg,earring_31_1.jpg,', 'Node Earrings in White gold set by 0,09ct diamonds.', 9, NULL, 'Boucles d\'oreilles Noeud en Or blanc serties de 0,09ct de Diamants.', 5),
(32, 'LhtQ4KMkb1', 2, '65594E002A', 'Gaspara', 10000, 15, '1.2', 0.17, NULL, 58, 0, 1, 0, 'SI1', 1, 8, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_32_0.jpg,earring_32_1.jpg,earring_32_2.jpg,', 'Butterfly Earrings in Black gold Paved by 0,17ct Black diamonds.', 9, NULL, 'Boucles d\'oreilles Papillon Pavé en Or noir serties de 0,17ct de Diamants noirs.', 5),
(33, 'p5eI2su4tU', 2, '65594E001A', 'Garlonna', 10000, 15, '1.2', 0.17, NULL, 58, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_33_0.jpg,earring_33_1.jpg,earring_33_2.jpg,', 'Butterfly Earrings in White gold Paved by 0,17ct diamonds.', 9, NULL, 'Boucles d\'oreilles Papillon Pavé en Or blanc serties de 0,17ct de Diamants.', 5),
(34, 'zKYOFGPMIJ', 2, '65595E001A', 'Alexia', 10000, 15, '1', 0.16, NULL, 62, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_34_0.jpg,earring_34_1.jpg,earring_34_2.jpg,', 'Star Earrings in White gold Paved by 0,16ct diamonds.', 9, NULL, 'Boucles d\'oreilles Etoile Pavée en Or blanc serties de 0,16ct de Diamants.', 5),
(35, 'pr8ulNWjje', 2, '65595E002A', 'Caroline', 10000, 15, '1', 0.16, NULL, 62, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_35_0.jpg,earring_35_1.jpg,earring_35_2.jpg,', 'Star Earrings in Pink gold Paved by 0,16ct diamonds.', 9, NULL, 'Boucles d\'oreilles Etoile Pavée en Or rose serties de 0,16ct de Diamants.', 5),
(36, 'VaV7X3FaUr', 2, '65597E001A', 'Violaine', 10000, 15, '1.7', 0.3, NULL, 76, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_36_0.jpg,earring_36_1.jpg,earring_36_2.jpg,', 'Heart with Wings Earrings in White gold set by 0,30ct diamonds.', 9, NULL, 'Boucles d\'oreilles Cœur Ailé en Or blanc serties de 0,30ct de Diamants.', 5),
(37, 'BhABjZn5zZ', 2, '65597E002A', 'Genaelle', 10000, 15, '1.7', 0.3, NULL, 76, 0, 1, 0, 'SI1', 1, 8, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_37_0.jpg,earring_37_1.jpg,earring_37_2.jpg,', 'Heart with Wings Earrings in Black gold set by 0,30ct diamonds.', 9, NULL, 'Boucles d\'oreilles Cœur Ailé en Or noir serties de 0,30ct de Diamants.', 5),
(38, 'YOwgrHWxfR', 2, '40400E038A', 'Ira', 10000, 15, '2.1', 0.2, NULL, 80, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_38_0.jpg,earring_38_1.jpg,earring_38_2.jpg,', 'Hoop Line Earrings in White gold set by 0,20ct diamonds', 9, '0', 'Boucles d\'oreilles Créoles Ligne en Or blanc serties de 0,20ct de diamants.', 5),
(39, 'QtGFwXsdQ9', 2, '43400E013A', 'Ghada', 10000, 15, '2.2', 0.63, NULL, 86, 0, 1, 0, 'SI1', 1, 1, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_39_0.jpg,earring_39_1.jpg,earring_39_2.jpg,', 'Hoop Earrings in Yellow gold set by 0,63ct diamonds.', 9, '0', 'Boucles d\'oreilles Créoles en Or jaune, sertie de 0,63ct de diamants.', 5),
(40, 'Ssd2bfc6Ab', 2, '43355E016A', 'Zana', 10000, 15, '3.3', 0.45, NULL, 184, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_40_0.jpg,earring_40_1.jpg,earring_40_2.jpg,', 'Multi Circles Earrings in White gold set by 0,45ct diamonds.', 9, '0', 'Boucles d\'oreilles Multi Cercles en Or blanc, serties de 0,45ct de diamants.', 5),
(41, 'IeC2SQ9pqP', 2, '57334E003A', 'Jenne', 10000, 15, '1.1', 0.15, NULL, 38, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_41_0.jpg,earring_41_1.jpg,earring_41_2.jpg,', 'Chips Earrings Round in White gold set by 0,15ct diamonds.', 9, '0', 'Boucles d\'oreilles Puces Rondes Illusion en Or blanc, serties de 0,15ct de diamants.', 5),
(42, 'OaXEjwbCPQ', 2, '45332E005A', 'Lison', 9999, 15, '1', 0.09, NULL, 22, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_42_0.jpg,earring_42_1.jpg,earring_42_2.jpg,', 'Chips Earrings Round in White gold set by 0,09ct diamonds.', 9, '0', 'Boucles d\'oreilles Puces Rondes Illusion  4 Griffes en Or blanc, serties de 0,09ct de diamants.', 5),
(43, 'uh9QC7XYqg', 2, '57350E002A', 'Oceane', 10000, 15, '1.7', 0.38, NULL, 188, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_43_0.jpg,earring_43_1.jpg,earring_43_2.jpg,', 'Paved Earrings in White gold set by 0,38ct diamonds.', 9, '0', 'Boucles d\'oreilles Pavées en Or blanc, serties de 0,38ct de diamants.', 5),
(44, 'gKy03WABOh', 2, '56482E004A', 'Louna', 10000, 15, '0.8', 0.09, NULL, 46, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_44_0.jpg,earring_44_1.jpg,earring_44_2.jpg,', 'Circle Earrings in White gold set by 0,09ct diamonds.', 9, '0', 'Boucles d\'oreilles Cercle en Or blanc, serties de 0,09ct de diamants.', 5),
(45, 'pJxWTwTrZQ', 2, '36735E037A', 'Paza', 10000, 15, '0.7', 0.3, NULL, 2, 0, 1, 0, 'SI1', 1, 1, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'earring_45_0.jpg,earring_45_1.jpg,earring_45_2.jpg,', 'Chips rounds Earrings in Yellow gold set claw by 2 diamonds of 0,30ct diamonds.', 9, '0', 'Boucles d\'oreilles Puces Rondes 4 Griffes en Or jaune, serties de 2 diamants de 0,30ct.', 5);

-- --------------------------------------------------------

--
-- Table structure for table `excel_importer`
--

CREATE TABLE `excel_importer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `records_updated` int(10) DEFAULT '0',
  `total_records` int(11) DEFAULT NULL,
  `records_deleted` int(11) DEFAULT NULL,
  `newly_inserted_records` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
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
  `site_7` int(11) NOT NULL DEFAULT '1',
  `family` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `unique_key`, `item_name`, `item_value`, `discount`, `category`, `featured`, `images_delta`, `date_added`, `disabled`, `site_0`, `site_1`, `site_2`, `site_3`, `site_4`, `site_5`, `site_6`, `site_7`, `family`) VALUES
(1, 'qEe1ZsMoZ3', 'rachel', 3516, NULL, 4, 0, '05471N001A.jpg,05471N001A-1.jpg,05471N001A-2.jpg', '2017-06-15 09:56:29', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Tina & Rock'),
(2, 'UQ73mT3Fes', 'sixtine', 3516, NULL, 4, 0, '05471N002A.jpg,05471N002A-1.jpg,05471N002A-2.jpg', '2017-06-15 09:56:33', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Tina & Rock'),
(3, 'W9FvkgSlxP', 'lou', 1968, NULL, 4, 0, '05472N001A.jpg,05472N001A-1.jpg,05472N001A-2.jpg', '2017-06-15 09:56:35', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Shapes'),
(4, '2gNKIo3bOs', 'Lou', 1968, NULL, 4, 0, '05472N002A.jpg,05472N002A-1.jpg,05472N002A-2.jpg', '2017-06-15 09:56:38', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Shapes'),
(5, 'lCP8SchNnd', 'diana', 1784, NULL, 4, 0, '05473N001A.jpg,05473N001A-1.jpg,05473N001A-2.jpg', '2017-06-15 09:56:40', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Pave Flower'),
(6, 'Q4w5aypkck', 'Dianna', 2512, NULL, 4, 0, '05476N002A.jpg,05476N002A-1.jpg,05476N002A-2.jpg', '2017-06-15 09:56:42', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(7, 'iGvUo6yUZg', 'andrea', 2512, NULL, 4, 0, '05476N001A.jpg,05476N001A-1.jpg,05476N001A-2.jpg', '2017-06-15 09:56:45', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(8, 'eg0gaeK4et', 'Andrea', 1815, NULL, 4, 0, '05477N001A.jpg,05477N001A-1.jpg,05477N001A-2.jpg', '2017-06-15 09:56:47', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(9, 'UFIsLNCGRH', 'lyna', 1815, NULL, 4, 0, '05477N002A.jpg,05477N002A-1.jpg,05477N002A-2.jpg', '2017-06-15 09:56:50', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(10, 'HggZnx1y7u', 'Lyna', 1430, NULL, 4, 0, '05478N001A.jpg,05478N001A-1.jpg,05478N001A-2.jpg', '2017-06-15 09:56:52', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(11, 'L39UmEuTVe', 'elea', 1430, NULL, 4, 0, '05478N002A.jpg,05478N002A-1.jpg,05478N002A-2.jpg', '2017-06-15 09:56:54', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(12, '6RJ7kgLxQM', 'Elea', 1088, NULL, 4, 0, '05479N001A.jpg,05479N001A-1.jpg,05479N001A-2.jpg', '2017-06-15 09:56:57', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(13, 'WlZFUletdM', 'fanny', 820, NULL, 4, 0, '05479N002A.jpg,05479N002A-1.jpg,05479N002A-2.jpg', '2017-06-15 09:57:00', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(14, 'UkQ13FXNl8', 'Fanny', 852, NULL, 4, 0, '05480N001A.jpg,05480N001A-1.jpg,05480N001A-2.jpg', '2017-06-15 09:57:02', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(15, 'xNJcxRS8CO', 'angelina', 700, NULL, 4, 0, '05480N002A.jpg,05480N002A-1.jpg,05480N002A-2.jpg', '2017-06-15 09:57:04', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(16, 'AaNuM90QQo', 'Angelina', 3680, NULL, 4, 0, '05481N001A.jpg,05481N001A-1.jpg,05481N001A-2.jpg', '2017-06-15 09:57:07', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(17, 'xTYPFqDTDb', 'maissa', 3680, NULL, 4, 0, '05481N002A.jpg,05481N002A-1.jpg,05481N002A-2.jpg', '2017-06-15 09:57:10', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(18, 'Fb9XD7d6NH', 'Maissa', 3568, NULL, 4, 0, '05482N001A.jpg,05482N001A-1.jpg,05482N001A-2.jpg', '2017-06-15 09:57:12', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(19, 'MH40vgTvVj', 'emi', 3568, NULL, 4, 0, '05482N002A.jpg,05482N002A-1.jpg,05482N002A-2.jpg', '2017-06-15 09:57:15', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(20, '2vMQB3NK5w', 'Emmy', 1825, NULL, 4, 0, '05483N001A.jpg,05483N001A-1.jpg,05483N001A-2.jpg', '2017-06-15 09:57:17', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Cloud & Star'),
(21, '2YIy7YoYZ6', 'angelica', 1825, NULL, 4, 0, '05483N002A.jpg,05483N002A-1.jpg,05483N002A-2.jpg', '2017-06-15 09:57:20', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Cloud & Star'),
(22, 'iE5yA3yGgI', 'Angelika', 3590, NULL, 4, 0, '05484N001A.jpg,05484N001A-1.jpg,05484N001A-2.jpg', '2017-06-15 09:57:22', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Symbol'),
(23, 'XOJeARgRel', 'amina', 3590, NULL, 4, 0, '05484N002A.jpg,05484N002A-1.jpg,05484N002A-2.jpg', '2017-06-15 09:57:24', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Symbol'),
(24, 'fDQb2N48z6', 'imane', 4469, NULL, 4, 0, '05485N001A.jpg,05485N001A-1.jpg,05485N001A-2.jpg', '2017-06-15 09:57:27', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(25, 'KFgq3hWN18', 'clementine', 4469, NULL, 4, 0, '05485N002A.jpg,05485N002A-1.jpg,05485N002A-2.jpg', '2017-06-15 09:57:29', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(26, 'qDyPipuQFm', 'Clementine', 1560, NULL, 4, 0, '05485N003A.jpg,05485N003A-1.jpg,05485N003A-2.jpg', '2017-06-15 09:57:32', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(27, 'lRY1jAG6i6', 'mathilde', 1560, NULL, 4, 0, '05485N004A.jpg,05485N004A-1.jpg,05485N004A-2.jpg', '2017-06-15 09:57:34', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(28, '3oeG7M7czS', 'Mathilde', 1170, NULL, 4, 0, '05486N001A.jpg,05486N001A-1.jpg,05486N001A-2.jpg', '2017-06-15 09:57:36', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(29, 'ANfuLojVBR', 'selma', 1170, NULL, 4, 0, '05486N002A.jpg,05486N002A-1.jpg,05486N002A-2.jpg', '2017-06-15 09:57:39', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(30, 'PUlmoyJbCT', 'lilia', 820, NULL, 4, 0, '05487N001A.jpg,05487N001A-1.jpg,05487N001A-2.jpg', '2017-06-15 09:57:41', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(31, 'agyg74dFwV', 'paloma', 820, NULL, 4, 0, '05487N002A.jpg,05487N002A-1.jpg,05487N002A-2.jpg', '2017-06-15 09:57:44', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(32, 'NQ88UDYEOC', 'elodie', 1210, NULL, 4, 0, '05488N001A.jpg,05488N001A-1.jpg,05488N001A-2.jpg', '2017-06-15 09:57:46', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(33, 'Ys78OeePIp', 'manel', 1210, NULL, 4, 0, '05488N002A.jpg,05488N002A-1.jpg,05488N002A-2.jpg', '2017-06-15 09:57:49', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(34, 'if2iY17OmJ', 'pamela', 1015, NULL, 4, 0, '05489N001A.jpg,05489N001A-1.jpg,05489N001A-2.jpg', '2017-06-15 09:57:51', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(35, 'pS7HfKlJTU', 'celine', 1015, NULL, 4, 0, '05489N002A.jpg,05489N002A-1.jpg,05489N002A-2.jpg', '2017-06-15 09:57:53', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(36, 'Zjkw5tI7qE', 'eugenie', 1140, NULL, 4, 0, '05490N001A.jpg,05490N001A-1.jpg,05490N001A-2.jpg', '2017-06-15 09:57:56', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(37, 'Ktyjqt8lmp', 'jasmine', 1140, NULL, 4, 0, '05490N002A.jpg,05490N002A-1.jpg,05490N002A-2.jpg', '2017-06-15 09:57:58', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(38, 'oczilJOwOg', 'Gurba', 1090, NULL, 4, 0, '05491N001A.jpg,05491N001A-1.jpg,05491N001A-2.jpg', '2017-06-15 09:58:00', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Shapes'),
(39, 'GOg9eIaz1U', 'Gurvala', 1090, NULL, 4, 0, '05491N002A.jpg,05491N002A-1.jpg,05491N002A-2.jpg', '2017-06-15 09:58:03', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Shapes'),
(40, 'UC9EalV5Lu', 'Pauline', 1005, NULL, 4, 0, '05492N001A.jpg,05492N001A-1.jpg,05492N001A-2.jpg', '2017-06-15 09:58:04', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(41, 'fNzZcmrTyR', 'Pauline', 1005, NULL, 4, 0, '05492N002A.jpg,05492N002A-1.jpg,05492N002A-2.jpg', '2017-06-15 09:58:07', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(42, 'nxIWV2pCMT', 'Prescillia', 1530, NULL, 4, 0, '05493N001A.jpg,05493N001A-1.jpg,05493N001A-2.jpg', '2017-06-15 09:58:09', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Symbol'),
(43, 'NvOxBFLwUc', 'Gaell', 1530, NULL, 4, 0, '05493N002A.jpg,05493N002A-1.jpg,05493N002A-2.jpg', '2017-06-15 09:58:11', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Symbol'),
(44, 'Ix2YfyRdFd', 'Prescillia', 842, NULL, 4, 0, '05494N001A.jpg,05494N001A-1.jpg,05494N001A-2.jpg', '2017-06-15 09:58:14', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(45, 'L1PaB1bYNJ', 'Gagny', 842, NULL, 4, 0, '05494N002A.jpg,05494N002A-1.jpg,05494N002A-2.jpg', '2017-06-15 09:58:16', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(46, 'ZKdPw6cjIY', 'Carole', 580, NULL, 4, 0, '05495N001A.jpg,05495N001A-1.jpg,05495N001A-2.jpg', '2017-06-15 09:58:19', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Node'),
(47, 'y7wkhpIjHs', 'esther', 580, NULL, 4, 0, '05495N002A.jpg,05495N002A-1.jpg,05495N002A-2.jpg', '2017-06-15 09:58:21', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Node'),
(48, 'HSeLfrXBtN', 'Enna', 1940, NULL, 5, 0, '06326B001A.jpg,06326B001A-1.jpg,06326B001A-2.jpg', '2017-06-15 09:58:24', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Pave Flower'),
(49, 'uABectOyEm', 'Grigoa', 1940, NULL, 5, 0, '06326B002A.jpg,06326B002A-1.jpg,06326B002A-2.jpg', '2017-06-15 09:58:26', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Pave Flower'),
(50, 'YUGOqIClvF', 'blanche', 1302, NULL, 5, 0, '06329B001A.jpg,06329B001A-1.jpg,06329B001A-2.jpg', '2017-06-15 09:58:29', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(51, 'IkMS83Vq1D', 'Blanche', 1302, NULL, 5, 0, '06329B002A.jpg,06329B002A-1.jpg,06329B002A-2.jpg', '2017-06-15 09:58:32', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(52, 'EsKbMxf1U2', 'Dulcina', 2266, NULL, 5, 0, '06330B001A.jpg,06330B001A-1.jpg,06330B001A-2.jpg', '2017-06-15 09:58:34', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(53, 'i8C28d2mrT', 'Paola', 2266, NULL, 5, 0, '06330B002A.jpg,06330B002A-1.jpg,06330B002A-2.jpg', '2017-06-15 09:58:37', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(54, '7CFsUgzgiH', 'Paola', 1715, NULL, 5, 0, '06331B001A.jpg,06331B001A-1.jpg,06331B001A-2.jpg', '2017-06-15 09:58:40', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Cloud & Star'),
(55, 's3fUuMN5g3', 'Gara', 1715, NULL, 5, 0, '06331B002A.jpg,06331B002A-1.jpg,06331B002A-2.jpg', '2017-06-15 09:58:42', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Cloud & Star'),
(56, '2XkE2hDL1G', 'julie', 2770, NULL, 5, 0, '06332B001A.jpg,06332B001A-1.jpg,06332B001A-2.jpg', '2017-06-15 09:58:45', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Symbol'),
(57, 'i8QWv2b68t', 'July', 2770, NULL, 5, 0, '06332B002A.jpg,06332B002A-1.jpg,06332B002A-2.jpg', '2017-06-15 09:58:48', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Symbol'),
(58, 'G8MrsZowzQ', 'Galit', 1415, NULL, 5, 0, '06333B001A.jpg,06333B001A-1.jpg,06333B001A-2.jpg', '2017-06-15 09:58:50', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(59, 'w6TKWTxSuS', 'Erica', 1415, NULL, 5, 0, '06333B002A.jpg,06333B002A-1.jpg,06333B002A-2.jpg', '2017-06-15 09:58:53', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(60, 'mYGtsYHfQA', 'petunia', 1302, NULL, 5, 0, '06334B001A.jpg,06334B001A-1.jpg,06334B001A-2.jpg', '2017-06-15 09:58:56', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Shapes'),
(61, 'LcsDTRSKvt', 'Petunia', 1302, NULL, 5, 0, '06334B002A.jpg,06334B002A-1.jpg,06334B002A-2.jpg', '2017-06-15 09:58:59', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Shapes'),
(62, 'L2m1d5VCqD', 'Gulsa', 1189, NULL, 5, 0, '06335B001A.jpg,06335B001A-1.jpg,06335B001A-2.jpg', '2017-06-15 09:59:02', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(63, 'TmonDMwghl', 'Carrine', 1189, NULL, 5, 0, '06335B002A.jpg,06335B002A-1.jpg,06335B002A-2.jpg', '2017-06-15 09:59:05', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(64, '6vkiN323RU', 'Chrystelle', 1450, NULL, 5, 0, '06336B001A.jpg,06336B001A-1.jpg,06336B001A-2.jpg', '2017-06-15 09:59:08', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(65, 'ZbarPH9IYO', 'carolina', 1450, NULL, 5, 0, '06336B002A.jpg,06336B002A-1.jpg,06336B002A-2.jpg', '2017-06-15 09:59:10', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(66, 'TknIiYo5Dl', 'Carolina', 2145, NULL, 5, 0, '06337B001A.jpg,06337B001A-1.jpg,06337B001A-2.jpg', '2017-06-15 09:59:13', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Node'),
(67, 'avXNq4BFgu', 'Laura', 2145, NULL, 5, 0, '06337B002A.jpg,06337B002A-1.jpg,06337B002A-2.jpg', '2017-06-15 09:59:16', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Node'),
(68, 'ZJfrafIubt', 'Laura', 875, NULL, 5, 0, '06338B001A.jpg,06338B001A-1.jpg,06338B001A-2.jpg', '2017-06-15 09:59:19', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(69, 'IBYjaIz1rg', 'Guvia', 1050, NULL, 5, 0, '06338B002A.jpg,06338B002A-1.jpg,06338B002A-2.jpg', '2017-06-15 09:59:22', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(70, '9oDVtVz4Li', 'florenca', 690, NULL, 5, 0, '06339B002A.jpg,06339B002A-1.jpg,06339B002A-2.jpg', '2017-06-15 09:59:25', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(71, '25Yuv75rM9', 'Florenca', 690, NULL, 5, 0, '06339B001A.jpg,06339B001A-1.jpg,06339B001A-2.jpg', '2017-06-15 09:59:28', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(72, 'o2WVVBHkKJ', 'Roby', 1100, NULL, 5, 0, '06340B002A.jpg,06340B002A-1.jpg,06340B002A-2.jpg', '2017-06-15 09:59:31', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(73, 'CDsM8w7Hy0', 'Audrey', 1100, NULL, 5, 0, '06340B003A.jpg,06340B003A-1.jpg,06340B003A-2.jpg', '2017-06-15 09:59:34', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(74, 'Nh7HDHLnPl', 'Audrey', 485, NULL, 5, 0, '06340B001A.jpg,06340B001A-1.jpg,06340B001A-2.jpg', '2017-06-15 09:59:36', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(75, 'bsfXoYpYkw', 'Gemilna', 885, NULL, 5, 0, '06341B001A.jpg,06341B001A-1.jpg,06341B001A-2.jpg', '2017-06-15 09:59:40', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(76, 'Ea5lJT6mLu', 'Jennyfer', 885, NULL, 5, 0, '06341B002A.jpg,06341B002A-1.jpg,06341B002A-2.jpg', '2017-06-15 09:59:43', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(77, 'yBBVl4uJS1', 'Agnes', 1015, NULL, 5, 0, '06342B002A.jpg,06342B002A-1.jpg,06342B002A-2.jpg', '2017-06-15 09:59:45', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(78, 'RPYbUOv3WB', 'kenza', 1015, NULL, 5, 0, '06342B001A.jpg,06342B001A-1.jpg,06342B001A-2.jpg', '2017-06-15 09:59:48', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(79, 'xqkYCcz2KK', 'Kenza', 1000, NULL, 5, 0, '06343B002A.jpg,06343B002A-1.jpg,06343B002A-2.jpg', '2017-06-15 09:59:51', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Shapes'),
(80, 'TU7fO2J8CA', 'Gulcina', 820, NULL, 5, 0, '06343B001A.jpg,06343B001A-1.jpg,06343B001A-2.jpg', '2017-06-15 09:59:54', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Shapes'),
(81, 'KeMRjddnrP', 'Ghismonde', 925, NULL, 5, 0, '06344B001A.jpg,06344B001A-1.jpg,06344B001A-2.jpg', '2017-06-15 09:59:56', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(82, '3vWtJm5JYI', 'Ghita', 925, NULL, 5, 0, '06344B002A.jpg,06344B002A-1.jpg,06344B002A-2.jpg', '2017-06-15 09:59:59', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(83, 'NGST2Wqsig', 'Josefa', 845, NULL, 5, 0, '06345B001A.jpg,06345B001A-1.jpg,06345B001A-2.jpg', '2017-06-15 10:00:02', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(84, 'ZcPgNd9E38', 'Josefa', 845, NULL, 5, 0, '06345B002A.jpg,06345B002A-1.jpg,06345B002A-2.jpg', '2017-06-15 10:00:04', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(85, 'RyVA0ClksO', 'Fila', 1400, NULL, 5, 0, '06346B002A.jpg,06346B002A-1.jpg,06346B002A-2.jpg', '2017-06-15 10:00:07', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Symbol'),
(86, 'CoacsI4tcC', 'Fila', 1252, NULL, 5, 0, '06346B001A.jpg,06346B001A-1.jpg,06346B001A-2.jpg', '2017-06-15 10:00:10', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Symbol'),
(87, 'Wd34vyWvxH', 'Violetta', 690, NULL, 5, 0, '06347B002A.jpg,06347B002A-1.jpg,06347B002A-2.jpg', '2017-06-15 10:00:13', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(88, 'mPsmT464wb', 'Mana', 690, NULL, 5, 0, '06347B001A.jpg,06347B001A-1.jpg,06347B001A-2.jpg', '2017-06-15 10:00:16', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(89, 'E4uuuTGItJ', 'Philippine', 280, NULL, 5, 0, '06348B001A.jpg,06348B001A-1.jpg,06348B001A-2.jpg', '2017-06-15 10:00:20', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Node'),
(90, 'AXRE2Iff7c', 'Tessa', 500, NULL, 5, 0, '06348B002A.jpg,06348B002A-1.jpg,06348B002A-2.jpg', '2017-06-15 10:00:24', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Node'),
(91, 'GXVBXeiz4G', 'Melissa', 482, NULL, 5, 0, '06349B002A.jpg,06349B002A-1.jpg,06349B002A-2.jpg', '2017-06-15 10:00:26', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(92, 'gPUCFPbnNy', 'Melissa', 370, NULL, 5, 0, '06349B001A.jpg,06349B001A-1.jpg,06349B001A-2.jpg', '2017-06-15 10:00:30', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(93, 'QhGMuoAmDo', 'Gianla', 650, NULL, 5, 0, '06349B003A.jpg,06349B003A-1.jpg,06349B003A-2.jpg', '2017-06-15 10:00:33', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(94, 'TfRwyxzy9X', 'monica', 410, NULL, 5, 0, '06350B001A.jpg,06350B001A-1.jpg,06350B001A-2.jpg', '2017-06-15 10:00:36', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Cloud & Star'),
(95, 'FNN2Vwh4JO', 'Monica', 560, NULL, 5, 0, '06350B002A.jpg,06350B002A-1.jpg,06350B002A-2.jpg', '2017-06-15 10:00:40', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Cloud & Star'),
(96, 'b7SiCDY0pV', 'Gypsi', 505, NULL, 5, 0, '06351B001A.jpg,06351B001A-1.jpg,06351B001A-2.jpg', '2017-06-15 10:00:42', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(97, 'i8ZOpBV8DK', 'anouk', 670, NULL, 5, 0, '06351B002A.jpg,06351B002A-1.jpg,06351B002A-2.jpg', '2017-06-15 10:00:46', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(98, 'Nh3IiYq7O0', 'Annouk', 1780, NULL, 5, 0, '06352B002A.jpg,06352B002A-1.jpg,06352B002A-2.jpg', '2017-06-15 10:00:48', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Shapes'),
(99, 'D9RAOoqj8i', 'Gueda', 1780, NULL, 5, 0, '06352B001A.jpg,06352B001A-1.jpg,06352B001A-2.jpg', '2017-06-15 10:00:51', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Shapes'),
(100, 'Z3UPW59j1K', 'Jade', 955, NULL, 5, 0, '06353B002A.jpg,06353B002A-1.jpg,06353B002A-2.jpg', '2017-06-15 10:00:54', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(101, 'L4eQgAAkoR', 'Saphir', 820, NULL, 5, 0, '06353B001A.jpg,06353B001A-1.jpg,06353B001A-2.jpg', '2017-06-15 10:00:56', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(102, 'bSmZPIn5zU', 'maya', 452, NULL, 5, 0, '06354B001A.jpg,06354B001A-1.jpg,06354B001A-2.jpg', '2017-06-15 10:01:00', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Tina & Rock'),
(103, '8KBnvtbUtJ', 'Maya', 452, NULL, 5, 0, '06354B002A.jpg,06354B002A-1.jpg,06354B002A-2.jpg', '2017-06-15 10:01:03', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Tina & Rock'),
(104, 'br1aA7wnuI', 'salomé', 699, NULL, 5, 0, '06355B002A.jpg,06355B002A-1.jpg,06355B002A-2.jpg', '2017-06-15 10:01:05', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(105, 'X04mUjXDXg', 'Salomé', 699, NULL, 5, 0, '06355B001A.jpg,06355B001A-1.jpg,06355B001A-2.jpg', '2017-06-15 10:01:08', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(106, 'QRX7hqHwLL', 'elena', 1200, NULL, 5, 0, '06356B001A.jpg,06356B001A-1.jpg,06356B001A-2.jpg', '2017-06-15 10:01:11', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(107, 'tOuCAAcJcw', 'Elena', 1200, NULL, 5, 0, '06356B002A.jpg,06356B002A-1.jpg,06356B002A-2.jpg', '2017-06-15 10:01:14', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(108, 'XLpQ5NI1Gm', 'Paza', 790, NULL, 5, 0, '06357B002A.jpg,06357B002A-1.jpg,06357B002A-2.jpg', '2017-06-15 10:01:16', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Symbol'),
(109, 'RS06ZUMkU6', 'capu', 790, NULL, 5, 0, '06357B001A.jpg,06357B001A-1.jpg,06357B001A-2.jpg', '2017-06-15 10:01:19', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Symbol'),
(110, 'Qq13I395Bk', 'Capu', 1230, NULL, 5, 0, '06358B001A.jpg,06358B001A-1.jpg,06358B001A-2.jpg', '2017-06-15 10:01:22', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Symbol'),
(111, 'GvGRGA0VPo', 'Roussa', 1230, NULL, 5, 0, '06358B002A.jpg,06358B002A-1.jpg,06358B002A-2.jpg', '2017-06-15 10:01:25', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Symbol'),
(112, 'WZlh9k6pFc', 'eleonore', 1200, NULL, 5, 0, '06359B002A.jpg,06359B002A-1.jpg,06359B002A-2.jpg', '2017-06-15 10:01:28', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Symbol'),
(113, 'Rb4mOSREdH', 'Elene', 1200, NULL, 5, 0, '06359B001A.jpg,06359B001A-1.jpg,06359B001A-2.jpg', '2017-06-15 10:01:31', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Symbol'),
(114, 'xcdIUkn5EU', 'Fleur', 1170, NULL, 5, 0, '06360B001A.jpg,06360B001A-1.jpg,06360B001A-2.jpg', '2017-06-15 10:01:34', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Symbol'),
(115, 'yOn6XfvN7U', 'Fleur', 1170, NULL, 5, 0, '06360B002A.jpg,06360B002A-1.jpg,06360B002A-2.jpg', '2017-06-15 10:01:37', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Symbol'),
(116, 'cxXkY2rswY', 'Chloe', 1435, NULL, 5, 0, '06361B001A.jpg,06361B001A-1.jpg,06361B001A-2.jpg', '2017-06-15 10:01:39', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Symbol'),
(117, 'kBPYwjcw1M', 'Chloe', 1435, NULL, 5, 0, '06361B002A.jpg,06361B002A-1.jpg,06361B002A-2.jpg', '2017-06-15 10:01:42', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Symbol'),
(118, 'qgi9NY3uBX', 'Iris', 640, NULL, 5, 0, '06362B002A.jpg,06362B002A-1.jpg,06362B002A-2.jpg', '2017-06-15 10:01:45', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(119, 'iFK86QdEX3', 'Iris', 640, NULL, 5, 0, '06362B001A.jpg,06362B001A-1.jpg,06362B001A-2.jpg', '2017-06-15 10:01:48', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(120, 'szq1EXc5kb', 'Heloise', 905, NULL, 1, 0, '65546R001A.jpg,65546R001A-1.jpg,65546R001A-2.jpg', '2017-06-15 10:01:51', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Tina & Rock'),
(121, 'C3JGHPRIiE', 'Heloise', 905, NULL, 1, 0, '65546R002A.jpg,65546R002A-1.jpg,65546R002A-2.jpg', '2017-06-15 10:01:53', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Tina & Rock'),
(122, 'sIWEnZwJfD', 'Galina', 570, NULL, 1, 0, '65547R002A.jpg,65547R002A-1.jpg,65547R002A-2.jpg', '2017-06-15 10:01:56', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Tina & Rock'),
(123, 'DmJISr7lP7', 'Galadriel', 2600, NULL, 1, 0, '65548R001A.jpg,65548R001A-1.jpg,65548R001A-2.jpg', '2017-06-15 10:01:59', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Tina & Rock'),
(124, 'hrR7OzUHFY', 'Gaedig', 2600, NULL, 1, 0, '65548R002A.jpg,65548R002A-1.jpg,65548R002A-2.jpg', '2017-06-15 10:02:01', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Tina & Rock'),
(125, '002PozqdhB', 'Sarah', 2600, NULL, 1, 0, '65549R001A.jpg,65549R001A-1.jpg,65549R001A-2.jpg', '2017-06-15 10:02:04', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Crystal'),
(126, 'D12W0poTmv', 'Sarou', 2830, NULL, 1, 0, '65549R002A.jpg,65549R002A-1.jpg,65549R002A-2.jpg', '2017-06-15 10:02:06', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Crystal'),
(127, 'GUEXazpvD3', 'Ghizlan', 3315, NULL, 2, 0, '65550E001A.jpg,65550E001A-1.jpg,65550E001A-2.jpg', '2017-06-15 10:02:09', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Crystal'),
(128, '6mya90nv0c', 'Gia', 3055, NULL, 2, 0, '65550E002A.jpg,65550E002A-1.jpg,65550E002A-2.jpg', '2017-06-15 10:02:11', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Crystal'),
(129, 'YaKDN4zQEK', 'Nicoline', 1275, NULL, 2, 0, '65551E001A.jpg,65551E001A-1.jpg,65551E001A-2.jpg', '2017-06-15 10:02:13', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Crystal'),
(130, 'xZC4AJ9CAC', 'Meli', 1180, NULL, 2, 0, '65551E002A.jpg,65551E002A-1.jpg,65551E002A-2.jpg', '2017-06-15 10:02:16', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Crystal'),
(131, 'fByj4KcmSK', 'Mely', 1490, NULL, 2, 0, '65552E001A.jpg,65552E001A-1.jpg,65552E001A-2.jpg', '2017-06-15 10:02:18', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Crystal'),
(132, 'pxOspT8hsR', 'Valoche', 1395, NULL, 2, 0, '65552E002A.jpg,65552E002A-1.jpg,65552E002A-2.jpg', '2017-06-15 10:02:21', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Crystal'),
(133, 'LjrkrjfYu3', 'mariam', 2850, NULL, 1, 0, '65553R002A.jpg,65553R002A-1.jpg,65553R002A-2.jpg', '2017-06-15 10:02:23', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Crystal'),
(134, '5PQq6VICXf', 'Maryam', 3280, NULL, 1, 0, '65553R001A.jpg,65553R001A-1.jpg,65553R001A-2.jpg', '2017-06-15 10:02:26', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Crystal'),
(135, 'oK45jiTM2t', 'Carollia', 2195, NULL, 1, 0, '65554R001A.jpg,65554R001A-1.jpg,65554R001A-2.jpg', '2017-06-15 10:02:28', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Crystal'),
(136, '1LTD20W3Ax', 'Elisa', 5580, NULL, 1, 0, '65555R002A.jpg,65555R002A-1.jpg,65555R002A-2.jpg', '2017-06-15 10:02:30', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Arrow'),
(137, '5INoANbtL9', 'Juls', 6400, NULL, 1, 0, '65555R001A.jpg,65555R001A-1.jpg,65555R001A-2.jpg', '2017-06-15 10:02:33', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Arrow'),
(138, 'FyvPHe6H40', 'Germaine', 2150, NULL, 1, 0, '65557R002A.jpg,65557R002A-1.jpg,65557R002A-2.jpg', '2017-06-15 10:02:35', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Spine'),
(139, 'O4mx7xxRZ3', 'Gula', 1880, NULL, 1, 0, '65557R003A.jpg,65557R003A-1.jpg,65557R003A-2.jpg', '2017-06-15 10:02:37', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Spine'),
(140, 'eq6ZmclV98', 'Vola', 4260, NULL, 1, 0, '65557R001A.jpg,65557R001A-1.jpg,65557R001A-2.jpg', '2017-06-15 10:02:40', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Spine'),
(141, '9x8NMVUvbR', 'Nouna', 3500, NULL, 1, 0, '65558R002A.jpg,65558R002A-1.jpg,65558R002A-2.jpg', '2017-06-15 10:02:42', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Lana'),
(142, 'AZJMz6Qdag', 'Chistine', 3500, NULL, 1, 0, '65558R003A.jpg,65558R003A-1.jpg,65558R003A-2.jpg', '2017-06-15 10:02:45', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Lana'),
(143, 'KoPC3PUDkP', 'appoline', 3500, NULL, 1, 0, '65558R001A.jpg,65558R001A-1.jpg,65558R001A-2.jpg', '2017-06-15 10:02:47', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Lana'),
(144, 'bGitNEjbLw', 'Appoline', 1860, NULL, 1, 0, '65559R002A.jpg,65559R002A-1.jpg,65559R002A-2.jpg', '2017-06-15 10:02:49', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Lana'),
(145, 'dDt0kp5ZQi', 'sasha', 1860, NULL, 1, 0, '65559R003A.jpg,65559R003A-1.jpg,65559R003A-2.jpg', '2017-06-15 10:02:52', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Lana'),
(146, 'IiKann6qTv', 'Sasha', 1860, NULL, 1, 0, '65559R001A.jpg,65559R001A-1.jpg,65559R001A-2.jpg', '2017-06-15 10:02:54', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Lana'),
(147, 'glIaJaKuG4', 'Lucienne', 2205, NULL, 1, 0, '65560R001A.jpg,65560R001A-1.jpg,65560R001A-2.jpg', '2017-06-15 10:02:57', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Pave Flower'),
(148, 'cFkCbeJJm9', 'Fabienne', 2635, NULL, 2, 0, '65561E001A.jpg,65561E001A-1.jpg,65561E001A-2.jpg', '2017-06-15 10:03:00', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Lana'),
(149, '7zix42hsNe', 'manon', 2635, NULL, 2, 0, '65561E002A.jpg,65561E002A-1.jpg,65561E002A-2.jpg', '2017-06-15 10:03:03', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Lana'),
(150, 'WTBg2yGmaX', 'Manon', 3640, NULL, 2, 0, '65562E002A.jpg,65562E002A-1.jpg,65562E002A-2.jpg', '2017-06-15 10:03:05', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Pave Flower'),
(151, 'Wlcz0Jp01n', 'Bogy', 3640, NULL, 2, 0, '65562E001A.jpg,65562E001A-1.jpg,65562E001A-2.jpg', '2017-06-15 10:03:08', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Pave Flower'),
(152, 'PJY0vOmhgt', 'Bogy', 3640, NULL, 2, 0, '65562E003A.jpg,65562E003A-1.jpg,65562E003A-2.jpg', '2017-06-15 10:03:10', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Pave Flower'),
(153, 'hBrl1EP7qo', 'Guliza', 5905, NULL, 1, 0, '65563R001A.jpg,65563R001A-1.jpg,65563R001A-2.jpg', '2017-06-15 10:03:13', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Pave Flower'),
(154, '61yWUc8jzw', 'Geralde', 1850, NULL, 2, 0, '65564E002A.jpg,65564E002A-1.jpg,65564E002A-2.jpg', '2017-06-15 10:03:15', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Pave Flower'),
(155, 'vYAfMIdWRU', 'Giliana', 1850, NULL, 2, 0, '65564E001A.jpg,65564E001A-1.jpg,65564E001A-2.jpg', '2017-06-15 10:03:17', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Pave Flower'),
(156, '9sUtvVmZcV', 'Gulpa', 1890, NULL, 1, 0, '65565R002A.jpg,65565R002A-1.jpg,65565R002A-2.jpg', '2017-06-15 10:03:20', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Pave Flower'),
(157, '0vAtclPCWm', 'lana', 1890, NULL, 1, 0, '65565R001A.jpg,65565R001A-1.jpg,65565R001A-2.jpg', '2017-06-15 10:03:22', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Pave Flower'),
(158, 'QM2Fb4JklP', 'Zana', 1280, NULL, 1, 0, '65566R001A.jpg,65566R001A-1.jpg,65566R001A-2.jpg', '2017-06-15 10:03:25', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Pave Flower'),
(159, 'kDQ1y8yG7j', 'Ruth', 1280, NULL, 1, 0, '65566R002A.jpg,65566R002A-1.jpg,65566R002A-2.jpg', '2017-06-15 10:03:27', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Pave Flower'),
(160, 'ogEL8jrSYO', 'eden', 3315, NULL, 2, 0, '65567E001A.jpg,65567E001A-1.jpg,65567E001A-2.jpg', '2017-06-15 10:03:30', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Spine'),
(161, '7egnOeNpUz', 'Eden', 3315, NULL, 2, 0, '65567E002A.jpg,65567E002A-1.jpg,65567E002A-2.jpg', '2017-06-15 10:03:32', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Spine'),
(162, 'WFkJBYiFAq', 'Gerlinde', 1140, NULL, 2, 0, '65585E002A.jpg,65585E002A-1.jpg,65585E002A-2.jpg', '2017-06-15 10:03:35', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(163, 'kN3tm2aqeU', 'Geza', 1140, NULL, 2, 0, '65585E001A.jpg,65585E001A-1.jpg,65585E001A-2.jpg', '2017-06-15 10:03:37', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(164, 'uNd2EhuIsu', 'Rafaella', 670, NULL, 1, 0, '65585R002A.jpg,65585R002A-1.jpg,65585R002A-2.jpg', '2017-06-15 10:03:39', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(165, 'o7dp5O0y1g', 'Ghada', 670, NULL, 1, 0, '65585R001A.jpg,65585R001A-1.jpg,65585R001A-2.jpg', '2017-06-15 10:03:42', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(166, 'kG3dyjKAN3', 'nour', 1100, NULL, 1, 0, '65586R002A.jpg,65586R002A-1.jpg,65586R002A-2.jpg', '2017-06-15 10:03:44', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(167, 'GiHzj2LAqF', 'Ghassana', 1100, NULL, 1, 0, '65586R001A.jpg,65586R001A-1.jpg,65586R001A-2.jpg', '2017-06-15 10:03:47', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(168, '62gVbDmKaX', 'Gauderika', 1550, NULL, 2, 0, '65587E001A.jpg,65587E001A-1.jpg,65587E001A-2.jpg', '2017-06-15 10:03:49', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(169, 'anxsEUmq7o', 'Gaya', 1550, NULL, 2, 0, '65587E002A.jpg,65587E002A-1.jpg,65587E002A-2.jpg', '2017-06-15 10:03:51', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(170, 'i32o9LU9bW', 'valentina', 1715, NULL, 2, 0, '65588E001A.jpg,65588E001A-1.jpg,65588E001A-2.jpg', '2017-06-15 10:03:54', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Shapes'),
(171, 'YszP0Je48u', 'Valentina', 1715, NULL, 2, 0, '65588E002A.jpg,65588E002A-1.jpg,65588E002A-2.jpg', '2017-06-15 10:03:56', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Shapes'),
(172, 'ki7xgshGGK', 'Brigitte', 1620, NULL, 2, 0, '65589E001A.jpg,65589E001A-1.jpg,65589E001A-2.jpg', '2017-06-15 10:03:59', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(173, 'P1IoIr7mFC', 'Cindy', 1620, NULL, 2, 0, '65589E002A.jpg,65589E002A-1.jpg,65589E002A-2.jpg', '2017-06-15 10:04:01', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(174, 'pRggodC8Cg', 'Laetitia', 915, NULL, 1, 0, '65589R002A.jpg,65589R002A-1.jpg,65589R002A-2.jpg', '2017-06-15 10:04:03', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(175, 'Z3pJwIxQsx', 'Laetizia', 915, NULL, 1, 0, '65589R001A.jpg,65589R001A-1.jpg,65589R001A-2.jpg', '2017-06-15 10:04:06', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(176, 'xABrWSu0qA', 'Gulbara', 1510, NULL, 2, 0, '65590E002A.jpg,65590E002A-1.jpg,65590E002A-2.jpg', '2017-06-15 10:04:08', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(177, 'f6xJL3PIFi', 'Guiseppa', 1510, NULL, 2, 0, '65590E001A.jpg,65590E001A-1.jpg,65590E001A-2.jpg', '2017-06-15 10:04:11', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(178, 'XAQvkEV8bU', ' DIAMOND PENDANT', 1260, NULL, 2, 0, '65591E002A.jpg,65591E002A-1.jpg,65591E002A-2.jpg', '2017-06-15 10:04:13', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Symbol'),
(179, 'VZ9RYyPMrS', 'Alexandra', 2600, NULL, 2, 0, '65591E001A.jpg,65591E001A-1.jpg,65591E001A-2.jpg', '2017-06-15 10:04:15', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Symbol'),
(180, 'XW3lmc5DYz', 'Beatrice', 1160, NULL, 2, 0, '65592E002A.jpg,65592E002A-1.jpg,65592E002A-2.jpg', '2017-06-15 10:04:18', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(181, 'm252zWuEWZ', 'Gelinda', 1160, NULL, 2, 0, '65592E001A.jpg,65592E001A-1.jpg,65592E001A-2.jpg', '2017-06-15 10:04:20', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(182, '3Pb0DjFmLS', 'Gema', 660, NULL, 2, 0, '65593E002A.jpg,65593E002A-1.jpg,65593E002A-2.jpg', '2017-06-15 10:04:22', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Node'),
(183, 'Z0z11IbWdh', 'lison', 660, NULL, 2, 0, '65593E001A.jpg,65593E001A-1.jpg,65593E001A-2.jpg', '2017-06-15 10:04:25', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Node'),
(184, 'R2el2TKBzp', 'Lison', 460, NULL, 1, 0, '65593R002A.jpg,65593R002A-1.jpg,65593R002A-2.jpg', '2017-06-15 10:04:27', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Node'),
(185, 'hI4R8jWBpA', 'Ghala', 460, NULL, 1, 0, '65593R001A.jpg,65593R001A-1.jpg,65593R001A-2.jpg', '2017-06-15 10:04:29', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Node'),
(186, 'LhtQ4KMkb1', 'Gaspara', 855, NULL, 2, 0, '65594E002A.jpg,65594E002A-1.jpg,65594E002A-2.jpg', '2017-06-15 10:04:31', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(187, 'p5eI2su4tU', 'Garlonna', 1100, NULL, 2, 0, '65594E001A.jpg,65594E001A-1.jpg,65594E001A-2.jpg', '2017-06-15 10:04:33', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(188, 'vXoIYt6HCb', 'Louise', 555, NULL, 1, 0, '65594R003A.jpg,65594R003A-1.jpg,65594R003A-2.jpg', '2017-06-15 10:04:36', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(189, 'nev99oBws8', 'Gastonia', 650, NULL, 1, 0, '65594R002A.jpg,65594R002A-1.jpg,65594R002A-2.jpg', '2017-06-15 10:04:38', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(190, 'my0CVHlHoY', 'Mireille', 650, NULL, 1, 0, '65594R001A.jpg,65594R001A-1.jpg,65594R001A-2.jpg', '2017-06-15 10:04:41', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(191, 'zKYOFGPMIJ', 'Alexia', 950, NULL, 2, 0, '65595E001A.jpg,65595E001A-1.jpg,65595E001A-2.jpg', '2017-06-15 10:04:43', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Cloud & Star'),
(192, 'pr8ulNWjje', 'Caroline', 950, NULL, 2, 0, '65595E002A.jpg,65595E002A-1.jpg,65595E002A-2.jpg', '2017-06-15 10:04:45', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Cloud & Star'),
(193, 'ffWBJBfuCu', 'violette', 650, NULL, 1, 0, '65596R002A.jpg,65596R002A-1.jpg,65596R002A-2.jpg', '2017-06-15 10:04:48', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(194, 'QA5OVGBEMT', 'Violette', 650, NULL, 1, 0, '65596R001A.jpg,65596R001A-1.jpg,65596R001A-2.jpg', '2017-06-15 10:04:51', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Nature'),
(195, 'VaV7X3FaUr', 'Violaine', 1860, NULL, 2, 0, '65597E001A.jpg,65597E001A-1.jpg,65597E001A-2.jpg', '2017-06-15 10:04:53', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(196, 'BhABjZn5zZ', 'Genaelle', 1860, NULL, 2, 0, '65597E002A.jpg,65597E002A-1.jpg,65597E002A-2.jpg', '2017-06-15 10:04:56', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Love & Mouth'),
(197, '1bQrOOI2ZN', 'Claire', 700, NULL, 1, 0, '65604R001A.jpg,65604R001A-1.jpg,65604R001A-2.jpg', '2017-06-15 10:04:58', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Lana'),
(198, 'bDFNbtSyT0', 'Clairie', 835, NULL, 1, 0, '65604R002A.jpg,65604R002A-1.jpg,65604R002A-2.jpg', '2017-06-15 10:05:01', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Lana'),
(199, 'xCZxLoWFBE', 'morgana', 1530, NULL, 1, 0, '65605R003A.jpg,65605R003A-1.jpg,65605R003A-2.jpg', '2017-06-15 10:05:03', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Chain Me'),
(200, 'Oqjf17QW0y', 'Morgana', 2400, NULL, 1, 0, '65605R001A.jpg,65605R001A-1.jpg,65605R001A-2.jpg', '2017-06-15 10:05:05', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Chain Me'),
(201, '5QXH531Lyu', 'Vitaly', 1680, NULL, 1, 0, '65605R002A.jpg,65605R002A-1.jpg,65605R002A-2.jpg', '2017-06-15 10:05:08', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Chain Me'),
(202, '7mNZeq1pbK', 'Elise', 2400, NULL, 1, 0, '65605R004A.jpg,65605R004A-1.jpg,65605R004A-2.jpg', '2017-06-15 10:05:10', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Chain Me'),
(203, 'VP9ffUUqL9', 'Madelaine', 451, NULL, 1, 0, '59576R002A.jpg,59576R002A-1.jpg,59576R002A-2.jpg', '2017-06-15 10:05:13', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(204, 'oAikd5Hosi', 'Florence', 1589, NULL, 1, 0, '58697R007A.jpg,58697R007A-1.jpg,58697R007A-2.jpg', '2017-06-15 10:05:14', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(205, '54EyV1D8PO', 'Charlize', 676, NULL, 1, 0, '58723R005A.jpg,58723R005A-1.jpg,58723R005A-2.jpg', '2017-06-15 10:05:15', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(206, 'zRIksgcZnq', 'Jenny', 656, NULL, 1, 0, '58723R006A.jpg,58723R006A-1.jpg,58723R006A-2.jpg', '2017-06-15 10:05:16', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(207, 'Ocq2sWUqJT', 'Candice', 482, NULL, 1, 0, '57401R004A.jpg,57401R004A-1.jpg,57401R004A-2.jpg', '2017-06-15 10:05:17', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(208, 'DIPE86ZgbF', 'Marine', 472, NULL, 1, 0, '57401R005A.jpg,57401R005A-1.jpg,57401R005A-2.jpg', '2017-06-15 10:05:18', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(209, 'qwNoN2gGtj', 'Rivka', 2163, NULL, 1, 0, '54716R001A.jpg,54716R001A-1.jpg,54716R001A-2.jpg', '2017-06-15 10:05:19', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(210, 'bQfbxJ73wg', 'Melissa', 1660, NULL, 1, 0, '36082R048A.jpg,36082R048A-1.jpg,36082R048A-2.jpg', '2017-06-15 10:05:20', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(211, 'IFowYjeEMz', 'Caterina', 512, NULL, 1, 0, '53618R005A.jpg,53618R005A-1.jpg,53618R005A-2.jpg', '2017-06-15 10:05:21', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(212, 'iYIDziy4kG', 'Arzella', 297, NULL, 1, 0, '60362R002A.jpg,60362R002A-1.jpg,60362R002A-2.jpg', '2017-06-15 10:05:22', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(213, 'G6v93Hd9lF', 'Riena', 1302, NULL, 1, 0, '59547R004A.jpg,59547R004A-1.jpg,59547R004A-2.jpg', '2017-06-15 10:05:23', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(214, '6cMWJ1J2JT', 'Iris', 574, NULL, 1, 0, '38535R034A.jpg,38535R034A-1.jpg,38535R034A-2.jpg', '2017-06-15 10:05:24', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(215, 'zJJtEgJBNZ', 'Heloise', 564, NULL, 1, 0, '38535R035A.jpg,38535R035A-1.jpg,38535R035A-2.jpg', '2017-06-15 10:05:25', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(216, 'YOwgrHWxfR', 'Ira', 1199, NULL, 2, 0, '40400E038A.jpg,40400E038A-1.jpg,40400E038A-2.jpg', '2017-06-15 10:05:25', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(217, 'QtGFwXsdQ9', 'Ghada', 3495, NULL, 2, 0, '43400E013A.jpg,43400E013A-1.jpg,43400E013A-2.jpg', '2017-06-15 10:05:26', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(218, 'Ssd2bfc6Ab', 'Zana', 2276, NULL, 2, 0, '43355E016A.jpg,43355E016A-1.jpg,43355E016A-2.jpg', '2017-06-15 10:05:27', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(219, 'IeC2SQ9pqP', 'Jenne', 922, NULL, 2, 0, '57334E003A.jpg,57334E003A-1.jpg,57334E003A-2.jpg', '2017-06-15 10:05:29', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(220, 'OaXEjwbCPQ', 'Lison', 656, NULL, 2, 0, '45332E005A.jpg,45332E005A-1.jpg,45332E005A-2.jpg', '2017-06-15 10:05:30', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(221, 'uh9QC7XYqg', 'Oceane', 1824, NULL, 2, 0, '57350E002A.jpg,57350E002A-1.jpg,57350E002A-2.jpg', '2017-06-15 10:05:31', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(222, 'gKy03WABOh', 'Louna', 584, NULL, 2, 0, '56482E004A.jpg,56482E004A-1.jpg,56482E004A-2.jpg', '2017-06-15 10:05:31', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(223, 'pJxWTwTrZQ', 'Paza', 2040, NULL, 2, 0, '36735E037A.jpg,36735E037A-1.jpg,36735E037A-2.jpg', '2017-06-15 10:05:32', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(224, 'Xb873Gq9tJ', 'pamela', 1208, NULL, 5, 0, '05458B006A.jpg,05458B006A-1.jpg,05458B006A-2.jpg', '2017-06-15 10:05:33', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(225, 'oPVJp7mpoR', 'rachel', 7977, NULL, 5, 0, '01538B188A.jpg,01538B188A-1.jpg,01538B188A-2.jpg', '2017-06-15 10:05:34', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(226, 'iHsSQgswTD', 'lilia', 1055, NULL, 5, 0, '04923B019A.jpg,04923B019A-1.jpg,04923B019A-2.jpg', '2017-06-15 10:05:35', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(227, 'IFT8DGn39N', 'Garance', 390, NULL, 3, 0, '47635P023A.jpg,47635P023A-1.jpg,47635P023A-2.jpg', '2017-06-15 10:05:37', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(228, 'ioMVwtMP9w', 'Violette', 912, NULL, 3, 0, '45684P011A.jpg,45684P011A-1.jpg,45684P011A-2.jpg', '2017-06-15 10:05:38', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(229, 'uNh48bP91K', 'Enna', 1179, NULL, 3, 0, '23199P004A.jpg,23199P004A-1.jpg,23199P004A-2.jpg', '2017-06-15 10:05:39', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(230, 'ntejYTbfXJ', 'Marnika', 718, NULL, 3, 0, '31543P057A.jpg,31543P057A-1.jpg,31543P057A-2.jpg', '2017-06-15 10:05:40', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(231, '7BF1l15mxt', 'Appoline', 461, NULL, 3, 0, '41451P052A.jpg,41451P052A-1.jpg,41451P052A-2.jpg', '2017-06-15 10:05:41', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(232, 'M9RZY95LDc', 'Sasha', 451, NULL, 3, 0, '41451P053A.jpg,41451P053A-1.jpg,41451P053A-2.jpg', '2017-06-15 10:05:41', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(233, 'iD2Nnhu5Ke', 'Alixa', 779, NULL, 3, 0, '64855P001A.jpg,64855P001A-1.jpg,64855P001A-2.jpg', '2017-06-15 10:05:42', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic'),
(234, 'ldmQ4XL4Ol', 'Elene', 1937, NULL, 3, 0, '38180P014A.jpg,38180P014A-1.jpg,38180P014A-2.jpg', '2017-06-15 10:05:43', 0, 1, 1, 1, 1, 0, 0, 0, 1, 'Classic');

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `min_max_values`
--

INSERT INTO `min_max_values` (`id`, `keys_name`, `keys_values`, `created_at`) VALUES
(4, 'family', '[\"Tina & Rock\",\"Shapes\",\"Pave Flower\",\"Love & Mouth\",\"Nature\",\"Cloud & Star\",\"Symbol\",\"Node\",\"Crystal\",\"Arrow\",\"Spine\",\"Lana\",\"Chain Me\",\"Classic\"]', '2017-06-14 13:24:00');

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
('Admin', '2017-04-24 02:00:46', '87.67.100.96'),
('Admin', '2017-04-25 23:57:56', '87.67.100.96'),
('Admin', '2017-04-26 01:07:37', '87.67.100.96'),
('Admin', '2017-04-26 09:19:17', '87.67.100.96'),
('Admin', '2017-04-26 09:50:56', '103.41.36.124'),
('Admin', '2017-04-26 12:19:41', '87.67.100.96'),
('Admin', '2017-04-26 13:29:38', '87.67.100.96'),
('Admin', '2017-04-27 00:54:39', '87.67.100.96'),
('Admin', '2017-05-01 18:02:19', '84.198.106.83'),
('Admin', '2017-05-01 19:22:31', '84.198.106.83'),
('Admin', '2017-05-05 01:32:16', '87.67.100.96'),
('Admin', '2017-05-05 01:44:04', '87.67.100.96'),
('Admin', '2017-05-05 14:20:33', '87.67.100.96'),
('Admin', '2017-05-07 22:17:55', '87.67.100.96'),
('Admin', '2017-05-08 00:29:20', '87.67.100.96'),
('Admin', '2017-05-08 01:30:05', '87.67.100.96'),
('Admin', '2017-05-24 16:28:05', '139.167.5.25'),
('Admin', '2017-05-30 07:44:38', '45.119.237.90'),
('Admin', '2017-05-30 07:50:16', '139.167.12.204'),
('Admin', '2017-05-30 07:57:09', '115.112.34.84'),
('Admin', '2017-05-30 12:51:37', '87.67.100.96'),
('Admin', '2017-06-02 23:27:39', '87.67.100.96'),
('Admin', '2017-06-03 01:05:02', '87.67.100.96'),
('Admin', '2017-06-03 11:49:14', '87.67.100.96'),
('Admin', '2017-06-10 10:34:25', '87.67.100.96'),
('Admin', '2017-06-10 11:48:45', '87.67.100.96'),
('Admin', '2017-06-10 13:50:32', '87.67.100.96'),
('Admin', '2017-06-10 15:52:47', '84.198.106.83'),
('Admin', '2017-06-14 12:42:09', '103.41.39.146'),
('Admin', '2017-06-14 14:51:59', '103.41.39.146'),
('Admin', '2017-06-14 15:40:34', '103.41.39.146'),
('Admin', '2017-06-14 23:06:43', '87.67.100.96'),
('Admin', '2017-06-15 08:28:39', '103.41.39.146'),
('Admin', '2017-06-15 08:52:25', '87.67.100.96'),
('Admin', '2017-06-15 08:54:04', '87.67.100.96'),
('Admin', '2017-06-15 09:56:11', '87.67.100.96'),
('Admin', '2017-06-15 11:30:48', '87.67.100.96'),
('Admin', '2017-06-16 10:34:10', '87.67.100.96'),
('Admin', '2017-06-16 11:53:57', '103.41.39.146'),
('Admin', '2017-06-16 11:59:44', '87.67.100.96'),
('Admin', '2017-06-16 12:53:36', '103.41.39.146'),
('Admin', '2017-06-17 10:42:30', '87.67.100.96');

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
(1, 'qEe1ZsMoZ3', 2, '05471N001A', 'rachel', 9999, 15, '3.1', 0.56, NULL, 97, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_1_0.jpg,necklace_1_1.jpg,necklace_1_2.jpg,', 'Necklace Horn in White gold Paved by 0,56ct diamonds.', 19, NULL, 'Collier Corne Pavée en Or blanc serti de 0,56ct de diamants.', 5),
(2, 'UQ73mT3Fes', 2, '05471N002A', 'sixtine', 10000, 15, '3.1', 0.56, NULL, 97, 0, 1, 0, 'SI1', 1, 8, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_2_0.jpg,necklace_2_1.jpg,necklace_2_2.jpg,', 'Necklace Horn in Black gold Paved by 0,56ct diamonds.', 19, NULL, 'Collier Corne Pavée en Or noir serti de 0,56ct de diamants.', 5),
(3, 'W9FvkgSlxP', 2, '05472N001A', 'lou', 10000, 15, '1.7', 0.3, NULL, 55, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_3_0.jpg,necklace_3_1.jpg,necklace_3_2.jpg,', 'Necklace Tear in White gold Paved by 0,30ct diamonds.', 19, NULL, 'Collier Goutte Pavée en Or blanc serti de 0,30ct de diamants.', 5),
(4, '2gNKIo3bOs', 2, '05472N002A', 'Lou', 10000, 15, '1.7', 0.3, NULL, 55, 0, 1, 0, 'SI1', 1, 8, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_4_0.jpg,necklace_4_1.jpg,necklace_4_2.jpg,', 'Necklace Tear in Black gold Paved by 0,30ct diamonds.', 19, NULL, 'Collier Goutte Pavée en Or noir serti de 0,30ct de diamants.', 5),
(5, 'lCP8SchNnd', 2, '05473N001A', 'diana', 10000, 15, '2', 0.37, NULL, 68, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_5_0.jpg,necklace_5_1.jpg,necklace_5_2.jpg,', 'Necklace Flower Black& White in White gold Paved by 0,37ct diamonds.', 19, NULL, 'Collier Fleur Black & White Pavée en Or blanc serti de 0,37ct de diamants blancs et noirs.', 5),
(6, 'Q4w5aypkck', 2, '05476N002A', 'Dianna', 10000, 15, '1.9', 0.41, NULL, 72, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_6_0.jpg,necklace_6_1.jpg,necklace_6_2.jpg,', 'Necklace Wings in Pink gold Paved by 0,41ct diamonds.', 19, NULL, 'Collier Ailes d\'Amour Pavées en Or rose serti de 0,41ct de diamants.', 5),
(7, 'iGvUo6yUZg', 2, '05476N001A', 'andrea', 10000, 15, '2', 0.41, NULL, 72, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_7_0.jpg,necklace_7_1.jpg,necklace_7_2.jpg,', 'Necklace Wings in White gold Paved by 0,41ct diamonds.', 19, NULL, 'Collier Ailes d\'Amour Pavées en Or blanc serti de 0,41ct de diamants.', 5),
(8, 'eg0gaeK4et', 2, '05477N001A', 'Andrea', 10000, 15, '1.7', 0.26, NULL, 38, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_8_0.jpg,necklace_8_1.jpg,necklace_8_2.jpg,', 'Necklace Heart with wings in White gold set by 0,26ct diamonds.', 19, NULL, 'Collier Cœur Ailé en Or blanc serti de 0,26ct de diamants.', 5),
(9, 'UFIsLNCGRH', 2, '05477N002A', 'lyna', 10000, 15, '1', 0.26, NULL, 38, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_9_0.jpg,necklace_9_1.jpg,necklace_9_2.jpg,', 'Necklace Heart with wings in Pink gold set by 0,26ct diamonds.', 19, NULL, 'Collier Cœur Ailé en Or rose serti de 0,26ct de diamants.', 5),
(10, 'HggZnx1y7u', 2, '05478N001A', 'Lyna', 10000, 15, '1.4', 0.2, NULL, 26, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_10_0.jpg,necklace_10_1.jpg,necklace_10_2.jpg,', 'Necklace Heart in White gold set by 0,20ct diamonds.', 19, NULL, 'Collier Cœur en Or blanc serti de 0,20ct de diamants.', 5),
(11, 'L39UmEuTVe', 2, '05478N002A', 'elea', 10000, 15, '1.6', 0.2, NULL, 26, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_11_0.jpg,necklace_11_1.jpg,necklace_11_2.jpg,', 'Necklace Heart in Pink gold set by 0,20ct diamonds.', 19, NULL, 'Collier Cœur en Or rose serti de 0,20ct de diamants.', 5),
(12, '6RJ7kgLxQM', 2, '05479N001A', 'Elea', 9998, 15, '1.8', 0.14, NULL, 38, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_12_0.jpg,necklace_12_1.jpg,necklace_12_2.jpg,', 'Necklace Key with Clover in White gold set by 0,14ct diamonds.', 19, NULL, 'Collier Clé à Trèfle en Or blanc serti de 0,14ct de diamants.', 5),
(13, 'WlZFUletdM', 2, '05479N002A', 'fanny', 10000, 15, '1.7', 0.14, NULL, 38, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_13_0.jpg,necklace_13_1.jpg,necklace_13_2.jpg,', 'Necklace Key with Clover in Black gold set by 0,14ct Black diamonds.', 19, NULL, 'Collier Clé à Trèfle en Or noir serti de 0,14ct de diamants noirs.', 5),
(14, 'UkQ13FXNl8', 2, '05480N001A', 'Fanny', 10000, 15, '1.6', 0.1, NULL, 29, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_14_0.jpg,necklace_14_1.jpg,necklace_14_2.jpg,', 'Necklace Key with Heart in Pink gold set by 0,10ct diamonds.', 19, NULL, 'Collier Clé à Coeur en Or rose serti de 0,10ct de diamants.', 5),
(15, 'xNJcxRS8CO', 2, '05480N002A', 'angelina', 10000, 15, '1.7', 0.1, NULL, 29, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_15_0.jpg,necklace_15_1.jpg,necklace_15_2.jpg,', 'Necklace Key with Heart in Pink gold set by 0,10ct Black diamonds.', 19, NULL, 'Collier Clé à Coeur en Or rose serti de 0,10ct de diamants noirs.', 5),
(16, 'AaNuM90QQo', 2, '05481N001A', 'Angelina', 10000, 15, '2.4', 0.6, NULL, 91, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_16_0.jpg,necklace_16_1.jpg,necklace_16_2.jpg,', 'Necklace Rose in White gold set by 0,60ct diamonds.', 19, NULL, 'Collier Rose en Or blanc serti de 0,60ct de diamants.', 5),
(17, 'xTYPFqDTDb', 2, '05481N002A', 'maissa', 10000, 15, '2.3', 0.6, NULL, 91, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_17_0.jpg,necklace_17_1.jpg,necklace_17_2.jpg,', 'Necklace Rose in Pink gold set by 0,60ct diamonds.', 19, NULL, 'Collier Rose en Or rose serti de 0,60ct de diamants.', 5),
(18, 'Fb9XD7d6NH', 2, '05482N001A', 'Maissa', 10000, 15, '2.5', 0.58, NULL, 85, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_18_0.jpg,necklace_18_1.jpg,necklace_18_2.jpg,', 'Necklace Flower in White gold set by 0,58ct diamonds.', 19, NULL, 'Collier Fleur en Or blanc serti de 0,58ct de diamants.', 5),
(19, 'MH40vgTvVj', 2, '05482N002A', 'emi', 10000, 15, '2.4', 0.58, NULL, 85, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_19_0.jpg,necklace_19_1.jpg,necklace_19_2.jpg,', 'Necklace Flower in Pink gold set by 0,58ct diamonds.', 19, NULL, 'Collier Fleur en Or rose serti de 0,58ct de diamants.', 5),
(20, '2vMQB3NK5w', 2, '05483N001A', 'Emmy', 10000, 15, '2.1', 0.26, NULL, 38, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_20_0.jpg,necklace_20_1.jpg,necklace_20_2.jpg,', 'Necklace Cloud in White gold set by 0,26ct diamonds.', 19, NULL, 'Collier Nuage en Or blanc serti de 0,26ct de diamants.', 5),
(21, '2YIy7YoYZ6', 2, '05483N002A', 'angelica', 10000, 15, '2', 0.26, NULL, 38, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_21_0.jpg,necklace_21_1.jpg,necklace_21_2.jpg,', 'Necklace Cloud in Pink gold set by 0,26ct diamonds.', 19, NULL, 'Collier Nuage en Or rose serti de 0,26ct de diamants.', 5),
(22, 'iE5yA3yGgI', 2, '05484N001A', 'Angelika', 10000, 15, '1.5', 0.62, NULL, 86, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_22_0.jpg,necklace_22_1.jpg,necklace_22_2.jpg,', 'Necklace Talisman in White gold set by 0,62ct diamonds.', 19, NULL, 'Collier Talisman en Or blanc serti de 0,62ct de diamants.', 5),
(23, 'XOJeARgRel', 2, '05484N002A', 'amina', 10000, 15, '1.5', 0.62, NULL, 86, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_23_0.jpg,necklace_23_1.jpg,necklace_23_2.jpg,', 'Necklace Talisman in Pink gold set by 0,62ct diamonds.', 19, NULL, 'Collier Talisman en Or rose serti de 0,62ct de diamants.', 5),
(24, 'fDQb2N48z6', 2, '05485N001A', 'imane', 10000, 15, '3.2', 0.73, NULL, 102, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_24_0.jpg,necklace_24_1.jpg,necklace_24_2.jpg,', 'Necklace Big Butterfly in White gold set by 0,73ct diamonds.', 19, NULL, 'Collier Papillon GM en Or blanc serti de 0,73ct de diamants.', 5),
(25, 'KFgq3hWN18', 2, '05485N002A', 'clementine', 10000, 15, '3', 0.73, NULL, 102, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_25_0.jpg,necklace_25_1.jpg,necklace_25_2.jpg,', 'Necklace Big Butterfly in Pink gold set by 0,73ct diamonds.', 19, NULL, 'Collier Papillon GM en Or rose serti de 0,73ct de diamants.', 5),
(26, 'qDyPipuQFm', 2, '05485N003A', 'Clementine', 10000, 15, '2.1', 0.25, NULL, 79, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_26_0.jpg,necklace_26_1.jpg,necklace_26_2.jpg,', 'Necklace Little Butterfly in White gold set by 0,25ct diamonds.', 19, NULL, 'Collier Papillon PM en Or blanc serti de 0,25ct de diamants.', 5),
(27, 'lRY1jAG6i6', 2, '05485N004A', 'mathilde', 10000, 15, '2.1', 0.25, NULL, 79, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_27_0.jpg,necklace_27_1.jpg,necklace_27_2.jpg,', 'Necklace Little Butterfly in Pink gold set by 0,25ct diamonds.', 19, NULL, 'Collier Papillon PM en Or rose serti de 0,25ct de diamants.', 5),
(28, '3oeG7M7czS', 2, '05486N001A', 'Mathilde', 9999, 15, '1.8', 0.15, NULL, 38, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_28_0.jpg,necklace_28_1.jpg,necklace_28_2.jpg,', 'Necklace Heart with Wings in White gold set by 0,15ct diamonds.', 19, NULL, 'Collier Cœur avec Ailes en Or blanc serti de 0,15ct de diamants.', 5),
(29, 'ANfuLojVBR', 2, '05486N002A', 'selma', 10000, 15, '1.7', 0.15, NULL, 38, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_29_0.jpg,necklace_29_1.jpg,necklace_29_2.jpg,', 'Necklace Heart with Wings in Pink gold set by 0,15ct diamonds.', 19, NULL, 'Collier Cœur avec Ailes en Or rose serti de 0,15ct de diamants.', 5),
(30, 'PUlmoyJbCT', 2, '05487N001A', 'lilia', 10000, 15, '1.5', 0.09, NULL, 21, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_30_0.jpg,necklace_30_1.jpg,necklace_30_2.jpg,', 'Necklace Mouth in White gold set by 0,09ct diamonds.', 19, NULL, 'Collier Bouche en Or blanc serti de 0,09ct de diamants.', 5),
(31, 'agyg74dFwV', 2, '05487N002A', 'paloma', 10000, 15, '1.5', 0.09, NULL, 21, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_31_0.jpg,necklace_31_1.jpg,necklace_31_2.jpg,', 'Necklace Mouth in Pink gold set by 0,09ct diamonds.', 19, NULL, 'Collier Bouche en Or rose serti de 0,09ct de diamants.', 5),
(32, 'NQ88UDYEOC', 2, '05488N001A', 'elodie', 10000, 15, '1.6', 0.16, NULL, 25, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_32_0.jpg,necklace_32_1.jpg,necklace_32_2.jpg,', 'Necklace Clover in White gold set by 0,16ct diamonds.', 19, NULL, 'Collier Trèfle en Or blanc serti de 0,16ct de diamants.', 5),
(33, 'Ys78OeePIp', 2, '05488N002A', 'manel', 10000, 15, '1.6', 0.16, NULL, 25, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_33_0.jpg,necklace_33_1.jpg,necklace_33_2.jpg,', 'Necklace Clover in Pink gold set by 0,16ct diamonds.', 19, NULL, 'Collier Trèfle en Or rose serti de 0,16ct de diamants.', 5),
(34, 'if2iY17OmJ', 2, '05489N001A', 'pamela', 10000, 15, '1.5', 0.12, NULL, 19, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_34_0.jpg,necklace_34_1.jpg,necklace_34_2.jpg,', 'Necklace One Wing in White gold set by 0,12ct diamonds.', 19, NULL, 'Collier Une Aile en Or blanc serti de 0,12ct de diamants.', 5),
(35, 'pS7HfKlJTU', 2, '05489N002A', 'celine', 10000, 15, '1.5', 0.12, NULL, 19, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_35_0.jpg,necklace_35_1.jpg,necklace_35_2.jpg,', 'Necklace One Wing in Pink gold set by 0,12ct diamonds.', 19, NULL, 'Collier Une Aile en Or rose serti de 0,12ct de diamants.', 5),
(36, 'Zjkw5tI7qE', 2, '05490N001A', 'eugenie', 10000, 15, '1.5', 0.18, NULL, 46, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_36_0.jpg,necklace_36_1.jpg,necklace_36_2.jpg,', 'Necklace Star in White gold set by 0,18ct diamonds.', 19, NULL, 'Collier Etoile en Or blanc serti de 0,18ct de diamants.', 5),
(37, 'Ktyjqt8lmp', 2, '05490N002A', 'jasmine', 10000, 15, '1.5', 0.18, NULL, 46, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_37_0.jpg,necklace_37_1.jpg,necklace_37_2.jpg,', 'Necklace Star in Pink gold set by 0,18ct diamonds.', 19, NULL, 'Collier Etoile en Or rose serti de 0,18ct de diamants.', 5),
(38, 'oczilJOwOg', 2, '05491N001A', 'Gurba', 10000, 15, '1.6', 0.12, NULL, 20, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_38_0.jpg,necklace_38_1.jpg,necklace_38_2.jpg,', 'Necklace Circle surrounded in White gold set by 0,12ct diamonds.', 19, NULL, 'Collier Cercle entouré en Or blanc serti de 0,12ct de diamants.', 5),
(39, 'GOg9eIaz1U', 2, '05491N002A', 'Gurvala', 10000, 15, '1.6', 0.12, NULL, 20, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_39_0.jpg,', 'Necklace Circle surrounded in Pink gold set by 0,12ct diamonds.', 19, NULL, 'Collier Cercle entouré en Or rose serti de 0,12ct de diamants.', 5),
(40, 'UC9EalV5Lu', 2, '05492N001A', 'Pauline', 10000, 15, '1.5', 0.13, NULL, 64, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_40_0.jpg,necklace_40_1.jpg,necklace_40_2.jpg,', 'Necklace Clover in White gold paved by 0,13ct diamonds.', 19, NULL, 'Collier Trèfle Pavé en Or blanc serti de 0,13ct de diamants.', 5),
(41, 'fNzZcmrTyR', 2, '05492N002A', 'Pauline', 10000, 15, '1.7', 0.13, NULL, 64, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_41_0.jpg,necklace_41_1.jpg,necklace_41_2.jpg,', 'Necklace Clover in Pink gold paved by 0,13ct diamonds.', 19, NULL, 'Collier Trèfle Pavé en Or rose serti de 0,13ct de diamants.', 5),
(42, 'nxIWV2pCMT', 2, '05493N001A', 'Prescillia', 10000, 15, '1.7', 0.21, NULL, 28, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_42_0.jpg,necklace_42_1.jpg,necklace_42_2.jpg,', 'Necklace Peace & Love in White gold set by 0,21ct diamonds.', 19, NULL, 'Collier Symbole Peace & Love en Or blanc serti de 0,21ct de diamants.', 5),
(43, 'NvOxBFLwUc', 2, '05493N002A', 'Gaell', 10000, 15, '1.6', 0.21, NULL, 28, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_43_0.jpg,necklace_43_1.jpg,necklace_43_2.jpg,', 'Necklace Peace & Love in Pink gold set by 0,21ct diamonds.', 19, NULL, 'Collier Symbole Peace & Love en Or rose serti de 0,21ct de diamants.', 5),
(44, 'Ix2YfyRdFd', 2, '05494N001A', 'Prescillia', 10000, 15, '1.5', 0.1, NULL, 43, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_44_0.jpg,necklace_44_1.jpg,necklace_44_2.jpg,', 'Necklace Heart in White gold paved by 0,10ct diamonds.', 19, NULL, 'Collier Coeur Pavé en Or blanc serti de 0,10ct de diamants.', 5),
(45, 'L1PaB1bYNJ', 2, '05494N002A', 'Gagny', 10000, 15, '1.5', 0.1, NULL, 43, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_45_0.jpg,necklace_45_1.jpg,necklace_45_2.jpg,', 'Necklace Heart in Pink gold paved by 0,10ct diamonds.', 19, NULL, 'Collier Coeur Pavé en Or rose serti de 0,10ct de diamants.', 5),
(46, 'ZKdPw6cjIY', 2, '05495N001A', 'Carole', 10000, 15, '1.4', 0.04, NULL, 16, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_46_0.jpg,necklace_46_1.jpg,necklace_46_2.jpg,', 'Necklace Node in White gold set by 0,04ct diamonds.', 19, NULL, 'Collier Noeud en Or blanc serti de 0,04ct de diamants.', 5),
(47, 'y7wkhpIjHs', 2, '05495N002A', 'esther', 10000, 15, '1.4', 0.04, NULL, 16, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'necklace_47_0.jpg,necklace_47_1.jpg,necklace_47_2.jpg,', 'Necklace Node in Pink gold set by 0,04ct diamonds.', 19, NULL, 'Collier Noeud en Or rose serti de 0,04ct de diamants.', 5);

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

CREATE TABLE `order_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `mc_gross` varchar(10) NOT NULL DEFAULT '0',
  `protection_eligibility` varchar(50) DEFAULT NULL,
  `payment_status` varchar(50) DEFAULT NULL,
  `mc_fee` varchar(10) NOT NULL DEFAULT '0',
  `notify_version` varchar(10) DEFAULT NULL,
  `payer_email` varchar(50) DEFAULT NULL,
  `txn_id` varchar(50) DEFAULT NULL,
  `payment_type` varchar(50) DEFAULT NULL,
  `payment_date` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_history`
--

INSERT INTO `order_history` (`id`, `user_id`, `mc_gross`, `protection_eligibility`, `payment_status`, `mc_fee`, `notify_version`, `payer_email`, `txn_id`, `payment_type`, `payment_date`, `created_at`) VALUES
(1, 48, '1201.53', 'Eligible', 'Pending', '0', '3.8', 'buyer@alwaysinfotech.com', '6PN02555J13698941', 'instant', '21:06:03 Jun 09, 2017 PDT', '2017-06-10 06:06:08'),
(2, 48, '512.92', 'Eligible', 'Pending', '0', '3.8', 'buyer@alwaysinfotech.com', '2A7418220B362462H', 'instant', '04:57:13 Jun 10, 2017 PDT', '2017-06-10 13:57:19'),
(3, 59, '512.92', 'Eligible', 'Pending', '0', '3.8', 'buyer@alwaysinfotech.com', '31P317319P196724E', 'instant', '22:20:19 Jun 11, 2017 PDT', '2017-06-12 07:25:26'),
(4, 59, '3047.99', 'Eligible', 'Pending', '0', '3.8', 'buyer@alwaysinfotech.com', '0YS061960B076324U', 'instant', '23:56:43 Jun 11, 2017 PDT', '2017-06-12 08:56:46'),
(5, 59, '959.41', 'Eligible', 'Pending', '0', '3.8', 'buyer@alwaysinfotech.com', '8RW65859C4631593T', 'instant', '02:49:19 Jun 12, 2017 PDT', '2017-06-12 11:49:24'),
(6, 59, '512.92', 'Eligible', 'Pending', '0', '3.8', 'buyer@alwaysinfotech.com', '21V30378YW642513B', 'instant', '04:24:06 Jun 12, 2017 PDT', '2017-06-12 13:24:10'),
(7, 62, '1363.67', 'Eligible', 'Pending', '0', '3.8', 'buyer@alwaysinfotech.com', '5L939187X2967162W', 'instant', '06:31:40 Jun 14, 2017 PDT', '2017-06-14 15:31:47'),
(9, 61, '4254.36', 'Eligible', 'Pending', '0', '3.8', 'buyer@alwaysinfotech.com', '68U298612M763951T', 'instant', '04:35:28 Jun 15, 2017 PDT', '2017-06-15 13:35:30'),
(10, 59, '1539.12', 'Eligible', 'Pending', '0', '3.8', 'buyer@alwaysinfotech.com', '1T2132242R0259144', 'instant', '22:53:55 Jun 15, 2017 PDT', '2017-06-16 07:53:58'),
(11, 59, '546.92', 'Eligible', 'Pending', '0', '3.8', 'buyer@alwaysinfotech.com', '3FD41390B0800705S', 'instant', '23:10:02 Jun 15, 2017 PDT', '2017-06-16 08:10:05'),
(12, 59, '1426.59', 'Eligible', 'Pending', '0', '3.8', 'buyer@alwaysinfotech.com', '8Y570618CE5958416', 'instant', '05:20:25 Jun 16, 2017 PDT', '2017-06-16 14:20:30'),
(13, 48, '7281.78', 'Eligible', 'Pending', '0', '3.8', 'buyer@alwaysinfotech.com', '4J3033041P9896924', 'instant', '04:41:51 Jun 17, 2017 PDT', '2017-06-17 13:41:54'),
(14, 48, '8224.37', 'Ineligible', 'Pending', '0', '3.8', 'buyer@alwaysinfotech.com', '43799133GT663214A', 'instant', '07:01:39 Jun 17, 2017 PDT', '2017-06-17 16:02:07'),
(15, 63, '1316.48', 'Eligible', 'Pending', '0', '3.8', 'buyer@alwaysinfotech.com', '7CF94095Y8449011H', 'instant', '07:11:36 Jun 17, 2017 PDT', '2017-06-17 16:11:44'),
(16, 62, '4513.30', 'Ineligible', 'Pending', '0', '3.8', 'buyer@alwaysinfotech.com', '28P89379YN026083J', 'instant', '07:13:05 Jun 17, 2017 PDT', '2017-06-17 16:13:26'),
(17, 62, '955.90', 'Ineligible', 'Pending', '0', '3.8', 'buyer@alwaysinfotech.com', '2447015483834391V', 'instant', '07:18:25 Jun 17, 2017 PDT', '2017-06-17 16:18:34'),
(18, 63, '1316.48', 'Ineligible', 'Pending', '0', '3.8', 'buyer@alwaysinfotech.com', '2E394068NV489152F', 'instant', '07:57:34 Jun 17, 2017 PDT', '2017-06-17 16:57:46'),
(19, 39, '6376.70', 'Ineligible', 'Pending', '0', '3.8', 'buyer@alwaysinfotech.com', '3SD17022229596617', 'instant', '08:00:20 Jun 17, 2017 PDT', '2017-06-17 17:00:49'),
(20, 39, '1736.35', 'Ineligible', 'Pending', '0', '3.8', 'buyer@alwaysinfotech.com', '1BH29325AA1682701', 'instant', '19:58:50 Jun 17, 2017 PDT', '2017-06-18 04:59:10');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `unique_key` varchar(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_value` float NOT NULL,
  `discount` float DEFAULT NULL,
  `category` int(11) NOT NULL,
  `qty` int(5) NOT NULL,
  `vat` float NOT NULL DEFAULT '0',
  `unit_price` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `unique_key`, `item_name`, `item_value`, `discount`, `category`, `qty`, `vat`, `unit_price`) VALUES
(1, 1, 'YBoTALvt7I', 'Brigitte', 1201.53, NULL, 1, 1, 208.53, 993),
(2, 2, 'UBVbyDkmTW', 'blanche', 512.919, 10, 3, 1, 89.019, 423.9),
(3, 3, 'UBVbyDkmTW', 'blanche', 512.919, 10, 3, 1, 89.019, 423.9),
(4, 4, 'kpjube1WI2', 'Paula', 2081.2, NULL, 2, 2, 361.2, 1720),
(5, 4, 'UkdwveG6iG', 'Deborah', 966.79, NULL, 1, 1, 167.79, 799),
(6, 5, 'EurzVltYrB', 'kenza', 959.409, 0, 3, 1, 166.509, 792.9),
(7, 6, 'UBVbyDkmTW', 'blanche', 512.919, 10, 3, 1, 89.019, 423.9),
(8, 7, 'fCx6myuEaS', 'Francoise', 545.71, 0, 1, 1, 94.71, 451),
(9, 7, 'KBbyvGX4aX', 'Caroline', 817.96, 0, 1, 1, 141.96, 676),
(10, 9, 'qEe1ZsMoZ3', 'rachel', 4254.36, NULL, 4, 1, 738.36, 3516),
(11, 10, '8KBnvtbUtJ', 'Maya', 546.92, NULL, 5, 1, 94.92, 452),
(12, 10, 'TfRwyxzy9X', 'monica', 992.2, NULL, 5, 2, 172.2, 820),
(13, 11, 'bSmZPIn5zU', 'maya', 546.92, NULL, 5, 1, 94.92, 452),
(14, 12, 'uNh48bP91K', 'Enna', 1426.59, NULL, 3, 1, 247.59, 1179),
(15, 15, '6RJ7kgLxQM', 'Elea', 1316.48, NULL, 4, 1, 228.48, 1088),
(16, 16, 'XLpQ5NI1Gm', 'Paza', 1911.8, NULL, 5, 2, 331.8, 1580),
(17, 16, 'FyvPHe6H40', 'Germaine', 2601.5, NULL, 1, 1, 451.5, 2150),
(18, 17, 'XLpQ5NI1Gm', 'Paza', 955.9, NULL, 5, 1, 165.9, 790),
(19, 18, '6RJ7kgLxQM', 'Elea', 1316.48, NULL, 4, 1, 228.48, 1088),
(20, 19, '3oeG7M7czS', 'Mathilde', 1415.7, NULL, 4, 1, 245.7, 1170),
(21, 19, 'WTBg2yGmaX', 'Manon', 4404.4, NULL, 2, 1, 764.4, 3640),
(22, 19, 'hI4R8jWBpA', 'Ghala', 556.6, NULL, 1, 1, 96.6, 460),
(23, 20, 'OaXEjwbCPQ', 'Lison', 793.76, NULL, 2, 1, 137.76, 656),
(24, 20, 'iD2Nnhu5Ke', 'Alixa', 942.59, NULL, 3, 1, 163.59, 779);

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
(1, 'IFT8DGn39N', 2, '47635P023A', 'Garance', 10000, 15, '0.8', 0.05, NULL, 21, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'pendant_1_0.jpg,pendant_1_1.jpg,pendant_1_2.jpg,', 'Multi circles Pendant in White gold set by 0,05ct diamonds.', 14, '0', 'Pendentif Multi Cercles en Or blanc, serti de 0,05ct de diamants.', 5),
(2, 'ioMVwtMP9w', 2, '45684P011A', 'Violette', 10000, 15, '0.8', 0.21, NULL, 82, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'pendant_2_0.jpg,pendant_2_1.jpg,pendant_2_2.jpg,', 'Circle paved pendant in White gold set by 0,21ct diamonds.', 14, '0', 'Pendentif Cercle Pavé en Or blanc, serti de 0,21ct de diamants.', 5),
(3, 'uNh48bP91K', 2, '23199P004A', 'Enna', 9999, 15, '0.7', 0.029, NULL, 97, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'pendant_3_0.jpg,pendant_3_1.jpg,pendant_3_2.jpg,', 'Oval paved pendant in White gold set by 0,29ct diamonds.', 14, '0', 'Pendentif Oval pavée en Or blanc, serti de 0,29ct de diamants.', 5),
(4, 'ntejYTbfXJ', 2, '31543P057A', 'Marnika', 10000, 15, '0.6', 0.16, NULL, 63, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'pendant_4_0.jpg,pendant_4_1.jpg,pendant_4_2.jpg,', 'Heart Pendant in White gold set by 0,16ct diamonds.', 14, '0', 'Pendentif Cœur pavé en Or blanc serti de 0,16ct de diamants.', 5),
(5, '7BF1l15mxt', 2, '41451P052A', 'Appoline', 10000, 15, '0.5', 0.07, NULL, 8, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'pendant_5_0.jpg,pendant_5_1.jpg,pendant_5_2.jpg,', 'Illusion Pendant in White gold set by 0,07ct diamonds.', 14, '0', 'Pendentif Illusion en Or blanc, sertie de 0,07ct de diamants.', 5),
(6, 'M9RZY95LDc', 2, '41451P053A', 'Sasha', 10000, 15, '0.5', 0.07, NULL, 8, 0, 1, 0, 'SI1', 1, 1, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'pendant_6_0.jpg,pendant_6_1.jpg,pendant_6_2.jpg,', 'Illusion Pendant in Yellow gold set by 0,07ct diamonds.', 14, '0', 'Pendentif Illusion en Or jaune, sertie de 0,07ct de diamants.', 5),
(7, 'iD2Nnhu5Ke', 2, '64855P001A', 'Alixa', 9999, 15, '0.7', 0.14, NULL, 51, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'pendant_7_0.jpg,pendant_7_1.jpg,pendant_7_2.jpg,', 'Illusion Circle Pendant in White gold set by 0,14ct diamonds.', 14, '0', 'Pendentif Cercle Rond Illusion en Or blanc, sertie de 0,14ct de diamants.', 5),
(8, 'ldmQ4XL4Ol', 2, '38180P014A', 'Elene', 10000, 15, '1.4', 0.46, NULL, 169, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '45', 2, NULL, 2, 'pendant_8_0.jpg,pendant_8_1.jpg,pendant_8_2.jpg,', 'Multi Circles Pendant in Yellow gold set by 0,46ct diamonds.', 14, '0', 'Pendentif Multi Cercle en Or blanc, serti de 0,46ct de diamants.', 5);

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
(1, 'szq1EXc5kb', 2, '65546R001A', 'Heloise', 10000, 15, '1.6', 0.12, NULL, 40, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_1_0.jpg,ring_1_1.jpg,ring_1_2.jpg,', 'Bracelet Point in White gold set by 0,12ct diamonds.', 1, '48-65', 'Bague Virgule en Or blanc sertie de 0,12ct de diamants.', 5),
(2, 'C3JGHPRIiE', 2, '65546R002A', 'Heloise', 10000, 15, '1.6', 0.12, NULL, 40, 0, 1, 0, 'SI1', 1, 8, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_2_0.jpg,ring_2_1.jpg,ring_2_2.jpg,', 'Bracelet Point in Black gold set by 0,12ct diamonds.', 1, '48-65', 'Bague Virgule en Or noir sertie de 0,12ct de diamants.', 5),
(3, 'sIWEnZwJfD', 2, '65547R002A', 'Galina', 10000, 15, '1.1', 0.07, NULL, 28, 0, 1, 0, 'SI1', 1, 8, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_3_0.jpg,ring_3_1.jpg,ring_3_2.jpg,', 'Open Ring Spade in Black gold set by 0,07ct diamonds.', 1, '48-65', 'Bague Ouvert Pique en Or noir sertie de 0,07ct de diamants.', 5),
(4, 'DmJISr7lP7', 2, '65548R001A', 'Galadriel', 10000, 15, '3.8', 0.41, NULL, 180, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_4_0.jpg,ring_4_1.jpg,ring_4_2.jpg,', 'Open Ring Six Spades in White gold set by 0,41ct diamonds.', 1, '48-65', 'Bague Ouvert Six Piques en Or blanc sertie de 0,41ct de diamants.', 5),
(5, 'hrR7OzUHFY', 2, '65548R002A', 'Gaedig', 10000, 15, '3.8', 0.41, NULL, 180, 0, 1, 0, 'SI1', 1, 8, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_5_0.jpg,ring_5_1.jpg,ring_5_2.jpg,', 'Open Ring Six Spades in Black gold set by 0,41ct diamonds.', 1, '48-65', 'Bague Ouvert Six Piques en Or noir sertie de 0,41ct de diamants.', 5),
(6, '002PozqdhB', 2, '65549R001A', 'Sarah', 10000, 15, '3.5', 0.49, NULL, 175, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_6_0.jpg,ring_6_1.jpg,ring_6_2.jpg,', 'Multi- Form Black & White Ring in White gold set by 0,49ct diamonds.', 1, '48-65', 'Bague Multi Formes Pavées Black & White en Or blanc sertie de 0,49ct de diamants blancs et noirs.', 5),
(7, 'D12W0poTmv', 2, '65549R002A', 'Sarou', 10000, 15, '3.5', 0.49, NULL, 175, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_7_0.jpg,ring_7_1.jpg,ring_7_2.jpg,', 'Multi- Form Ring in White gold set by 0,49ct diamonds.', 1, '48-65', 'Bague Multi Formes Pavées en Or blanc sertie de 0,49ct de diamants blancs.', 5),
(8, 'LjrkrjfYu3', 2, '65553R002A', 'mariam', 10000, 15, '3.1', 0.54, NULL, 102, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_8_0.jpg,ring_8_1.jpg,ring_8_2.jpg,', 'Oval and Round Forms Black & White Ring in White gold set by 0,54ct diamonds.', 1, '48-65', 'Bague Formes Ovales et Rondes Black & White en Or blanc sertie de 0,54ct de diamants blancs et noirs.', 5),
(9, '5PQq6VICXf', 2, '65553R001A', 'Maryam', 10000, 15, '3.1', 0.54, NULL, 102, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_9_0.jpg,ring_9_1.jpg,ring_9_2.jpg,', 'Oval and Round Forms Ring in White gold set by 0,54ct diamonds.', 1, '48-65', 'Bague Formes Ovales et Rondes en Or blanc sertie de 0,54ct de diamants blancs.', 5),
(10, 'oK45jiTM2t', 2, '65554R001A', 'Carollia', 10000, 15, '2.3', 0.36, NULL, 86, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_10_0.jpg,ring_10_1.jpg,ring_10_2.jpg,', 'Oval and Round Forms Ring in White gold set by 0,36ct diamonds.', 1, '48-65', 'Bague Formes Ovales et Rondes en Or blanc sertie de 0,36ct de diamants blancs.', 5),
(11, '1LTD20W3Ax', 2, '65555R002A', 'Elisa', 10000, 15, '4.6', 1.3, NULL, 508, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_11_0.jpg,ring_11_1.jpg,ring_11_2.jpg,', 'Multi- Band Black & White Ring in White gold set by 1,30ct diamonds.', 1, '48-65', 'Bague Multi Bandes Pavées Black & White en Or blanc sertie d\' 1,30ct de diamants blancset noirs.', 5),
(12, '5INoANbtL9', 2, '65555R001A', 'Juls', 10000, 15, '4.6', 1.29, NULL, 508, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_12_0.jpg,ring_12_1.jpg,ring_12_2.jpg,', 'Multi- Band Ring in White gold set by 1,30ct diamonds.', 1, '48-65', 'Bague Multi Bandes Pavées en Or blanc sertie d\' 1,30ct de diamants blancs.', 5),
(13, 'FyvPHe6H40', 2, '65557R002A', 'Germaine', 9999, 15, '2.2', 0.75, NULL, 134, 0, 1, 0, 'SI1', 1, 8, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_13_0.jpg,ring_13_1.jpg,', 'Double Tear Ring in Black gold set by 0,75ct Black diamonds.', 1, '48-65', 'Bague Double Goutte Pavée en Or noir sertie de 0,75ct de diamants noirs.', 5),
(14, 'O4mx7xxRZ3', 2, '65557R003A', 'Gula', 10000, 15, '2.2', NULL, 0.93, 0, 134, 0, 1, 'SI1', 2, 8, '4', 'Pierre de couleur naturelle/ Natural Color Stone  -  0.9MM- 1.0MM- 1.1MM- 1.2MM', NULL, NULL, '0', 2, NULL, 2, 'ring_14_0.jpg,ring_14_1.jpg,ring_14_2.jpg,', 'Double Tear Ring in Black gold set by 0,75ct Blue Sapphirs.', 5, '48-65', 'Bague Double Goutte Pavée en Or noir sertie de 0,75ct de Saphirs Bleus.', 5),
(15, 'eq6ZmclV98', 2, '65557R001A', 'Vola', 10000, 15, '2.2', 0.75, NULL, 134, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_15_0.jpg,ring_15_1.jpg,ring_15_2.jpg,', 'Double Tear Ring in White gold set by 0,75ct diamonds.', 1, '48-65', 'Bague Double Goutte Pavée en Or blanc sertie de 0,75ct de diamants.', 5),
(16, '9x8NMVUvbR', 2, '65558R002A', 'Nouna', 10000, 15, '2.3', 0.56, NULL, 90, 0, 1, 0, 'SI1', 1, 1, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_16_0.jpg,ring_16_1.jpg,ring_16_2.jpg,', 'Square Shape Ring in Yellow gold set Four Lines by 0,56ct diamonds.', 1, '48-65', 'Bague Forme Carré Pavée de 4 Lignes en Or jaune sertie de 0,56ct de diamants.', 5),
(17, 'AZJMz6Qdag', 2, '65558R003A', 'Chistine', 10000, 15, '2.2', 0.56, NULL, 90, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_17_0.jpg,ring_17_1.jpg,ring_17_2.jpg,', 'Square Shape Ring in Pink gold set Four Lines by 0,56ct diamonds.', 1, '48-65', 'Bague Forme Carré Pavée de 4 Lignes en Or rose sertie de 0,56ct de diamants.', 5),
(18, 'KoPC3PUDkP', 2, '65558R001A', 'appoline', 10000, 15, '2.4', 0.56, NULL, 90, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_18_0.jpg,ring_18_1.jpg,ring_18_2.jpg,', 'Square Shape Ring in White gold set Four Lines by 0,56ct diamonds.', 1, '48-65', 'Bague Forme Carré Pavée de 4 Lignes en Or blanc sertie de 0,56ct de diamants.', 5),
(19, 'bGitNEjbLw', 2, '65559R002A', 'Appoline', 10000, 15, '1.5', 0.28, NULL, 45, 0, 1, 0, 'SI1', 1, 1, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_19_0.jpg,ring_19_1.jpg,ring_19_2.jpg,', 'Square Shape Ring in Yellow gold set Two Lines by 0,28ct diamonds.', 1, '48-65', 'Bague Forme Carré Pavée de 2 Lignes en Or jaune sertie de 0,28ct de diamants.', 5),
(20, 'dDt0kp5ZQi', 2, '65559R003A', 'sasha', 10000, 15, '1.4', 0.28, NULL, 45, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_20_0.jpg,ring_20_1.jpg,ring_20_2.jpg,', 'Square Shape Ring in Pink gold set Two Lines by 0,28ct diamonds.', 1, '48-65', 'Bague Forme Carré Pavée de 2 Lignes en Or rose sertie de 0,28ct de diamants.', 5),
(21, 'IiKann6qTv', 2, '65559R001A', 'Sasha', 10000, 15, '1.6', 0.28, NULL, 45, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_21_0.jpg,ring_21_1.jpg,ring_21_2.jpg,', 'Square Shape Ring in White gold set Two Lines by 0,28ct diamonds.', 1, '48-65', 'Bague Forme Carré Pavée de 2 Lignes en Or blanc sertie de 0,28ct de diamants.', 5),
(22, 'glIaJaKuG4', 2, '65560R001A', 'Lucienne', 10000, 15, '1.9', 0.38, NULL, 67, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_22_0.jpg,ring_22_1.jpg,ring_22_2.jpg,', 'Flower Solitaire Ring in White gold set by 0,38ct diamonds.', 1, '48-65', 'Bague Fleur Solitaire en Or blanc sertie de 0,38ct de diamants.', 5),
(23, 'hBrl1EP7qo', 2, '65563R001A', 'Guliza', 10000, 15, '3.6', 1.03, NULL, 192, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_23_0.jpg,ring_23_1.jpg,ring_23_2.jpg,', ' Flower Solitaire Ring in White gold paved by 1,03ct diamonds.', 1, '48-65', 'Bague Fleur Pavée Solitaire en Or blanc serties d\' 1,03ct de diamants.', 5),
(24, '9sUtvVmZcV', 2, '65565R002A', 'Gulpa', 10000, 15, '1.7', 0.32, NULL, 86, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_24_0.jpg,ring_24_1.jpg,ring_24_2.jpg,', ' Flower Solitaire Ring surrounded in Pink gold set by 0,32ct diamonds.', 1, '48-65', 'Bague Fleur Solitaire entourée en Or rose serties de 0,32ct de diamants.', 5),
(25, '0vAtclPCWm', 2, '65565R001A', 'lana', 10000, 15, '1.9', 0.32, NULL, 86, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_25_0.jpg,ring_25_1.jpg,ring_25_2.jpg,', ' Flower Solitaire Ring surrounded in White gold set by 0,32ct diamonds.', 1, '48-65', 'Bague Fleur Solitaire entourée en Or blanc serties de 0,32ct de diamants.', 5),
(26, 'QM2Fb4JklP', 2, '65566R001A', 'Zana', 10000, 15, '1.4', 0.21, NULL, 56, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_26_0.jpg,ring_26_1.jpg,ring_26_2.jpg,', ' Flower Solitaire Ring in White gold paved by 0,21ct diamonds.', 1, '48-65', 'Bague Fleur Pavée Solitaire entouré en Or blanc serties de 0,21ct de diamants.', 5),
(27, 'kDQ1y8yG7j', 2, '65566R002A', 'Ruth', 10000, 15, '1.3', 0.21, NULL, 56, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_27_0.jpg,ring_27_1.jpg,ring_27_2.jpg,', ' Flower Solitaire Ring in Pink gold paved by 0,21ct diamonds.', 1, '48-65', 'Bague Fleur Pavée Solitaire entouré en Or rose serties de 0,21ct de diamants.', 5),
(28, 'uNd2EhuIsu', 2, '65585R002A', 'Rafaella', 10000, 15, '0.9', 0.09, NULL, 21, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_28_0.jpg,ring_28_1.jpg,ring_28_2.jpg,', 'Mouth Twisted Ring in Pink gold set by 0,09ct diamonds.', 1, '48-65', 'Bague Torsadé Bouche en Or rose sertie de 0,09ct de Diamants.', 5),
(29, 'o7dp5O0y1g', 2, '65585R001A', 'Ghada', 10000, 15, '1', 0.09, NULL, 21, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_29_0.jpg,ring_29_1.jpg,ring_29_2.jpg,', 'Mouth Twisted Ring in White gold set by 0,09ct diamonds.', 1, '48-65', 'Bague Torsadé Bouche en Or blanc sertie de 0,09ct de Diamants.', 5),
(30, 'kG3dyjKAN3', 2, '65586R002A', 'nour', 10000, 15, '1', 0.16, NULL, 25, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_30_0.jpg,ring_30_1.jpg,ring_30_2.jpg,', 'Clover Twisted Ring in Pink gold set by 0,16ct diamonds.', 1, '48-65', 'Bague Torsadé Trèfle en Or rose sertie de 0,16ct de Diamants.', 5),
(31, 'GiHzj2LAqF', 2, '65586R001A', 'Ghassana', 10000, 15, '1.1', 0.16, NULL, 25, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_31_0.jpg,ring_31_1.jpg,ring_31_2.jpg,', 'Clover Twisted Ring in White gold set by 0,16ct diamonds.', 1, '48-65', 'Bague Torsadé Trèfle en Or blanc sertie de 0,16ct de Diamants.', 5),
(32, 'pRggodC8Cg', 2, '65589R002A', 'Laetitia', 10000, 15, '1.1', 0.12, NULL, 16, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_32_0.jpg,ring_32_1.jpg,ring_32_2.jpg,', 'Heart Twisted Ring in Pink gold set by 0,12ct diamonds.', 1, '48-65', 'Bague Torsadé Cœur entouré en Or rose sertie de 0,12ct de Diamants.', 5),
(33, 'Z3pJwIxQsx', 2, '65589R001A', 'Laetizia', 10000, 15, '1.1', 0.12, NULL, 16, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_33_0.jpg,ring_33_1.jpg,ring_33_2.jpg,', 'Heart Twisted Ring in White gold set by 0,12ct diamonds.', 1, '48-65', 'Bague Torsadé Cœur entouré en Or blanc sertie de 0,12ct de Diamants.', 5),
(34, 'R2el2TKBzp', 2, '65593R002A', 'Lison', 10000, 15, '1', 0.04, NULL, 1, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_34_0.jpg,ring_34_1.jpg,ring_34_2.jpg,', 'Node Twisted Ring in Pink gold set by 0,04ct diamonds.', 1, '48-65', 'Bague Torsadé Noeud en Or rose sertie de 0,04ct de Diamants.', 5),
(35, 'hI4R8jWBpA', 2, '65593R001A', 'Ghala', 9999, 15, '1', 0.04, NULL, 16, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_35_0.jpg,ring_35_1.jpg,', 'Node Twisted Ring in White gold set by 0,04ct diamonds.', 1, '48-65', 'Bague Torsadé Noeud en Or blanc sertie de 0,04ct de Diamants.', 5),
(36, 'vXoIYt6HCb', 2, '65594R003A', 'Louise', 10000, 15, '1.1', 0.08, NULL, 29, 0, 1, 0, 'SI1', 1, 8, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_36_0.jpg,ring_36_1.jpg,ring_36_2.jpg,', 'Butterfly Twisted Ring in Black gold set by 0,08ct Black diamonds.', 1, '48-65', 'Bague Torsadé Papillon Pavé en Or noir sertie de 0,08ct de Diamants noirs.', 5),
(37, 'nev99oBws8', 2, '65594R002A', 'Gastonia', 10000, 15, '1', 0.08, NULL, 29, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_37_0.jpg,ring_37_1.jpg,ring_37_2.jpg,', 'Butterfly Twisted Ring in Pink gold set by 0,08ct diamonds.', 1, '48-65', 'Bague Torsadé Papillon Pavé en Or rose sertie de 0,08ct de Diamants.', 5),
(38, 'my0CVHlHoY', 2, '65594R001A', 'Mireille', 10000, 15, '1.1', 0.08, NULL, 29, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_38_0.jpg,ring_38_1.jpg,ring_38_2.jpg,', 'Butterfly Twisted Ring in White gold set by 0,08ct diamonds.', 1, '48-65', 'Bague Torsadé Papillon Pavé en Or blanc sertie de 0,08ct de Diamants.', 5),
(39, 'ffWBJBfuCu', 2, '65596R002A', 'violette', 10000, 15, '1', 0.08, NULL, 27, 0, 1, 0, 'SI1', 1, 3, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_39_0.jpg,ring_39_1.jpg,ring_39_2.jpg,', 'Butterfly Twisted Ring in Pink gold set by 0,08ct diamonds.', 1, '48-65', 'Bague Torsadé Papillon en Or rose sertie de 0,08ct de Diamants.', 5),
(40, 'QA5OVGBEMT', 2, '65596R001A', 'Violette', 10000, 15, '1.1', 0.08, NULL, 27, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_40_0.jpg,ring_40_1.jpg,ring_40_2.jpg,', 'Butterfly Twisted Ring in White gold set by 0,08ct diamonds.', 1, '48-65', 'Bague Torsadé Papillon en Or blanc sertie de 0,08ct de Diamants.', 5),
(41, '1bQrOOI2ZN', 2, '65604R001A', 'Claire', 10000, 15, '1.1', 0.13, NULL, 48, 0, 1, 0, 'SI1', 1, 8, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_41_0.jpg,ring_41_1.jpg,ring_41_2.jpg,', 'Half Eternity Ring Two Lines in Black gold set by 0,13ct Black diamonds.', 2, '48-65', 'Alliance 1/2 Tour 2 Lignes en Or noir sertie de 0,13ct de Diamants noirs.', 5),
(42, 'bDFNbtSyT0', 2, '65604R002A', 'Clairie', 10000, 15, '1.1', 0.13, NULL, 48, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_42_0.jpg,ring_42_1.jpg,ring_42_2.jpg,', 'Half Eternity Ring Two Lines in White gold set by 0,13ct diamonds.', 2, '48-65', 'Alliance 1/2 Tour 2 Lignes en Or blanc sertie de 0,13ct de Diamants.', 5),
(43, 'xCZxLoWFBE', 2, '65605R003A', 'morgana', 10000, 15, '2.3', 0.16, 0.25, 44, 36, 1, 1, 'SI1', 3, 2, '4', 'Pierre de couleur naturelle/ Natural Color Stone  - 1.1MM', NULL, NULL, '0', 2, NULL, 2, 'ring_43_0.jpg,ring_43_1.jpg,ring_43_2.jpg,', 'Half Eternity Ring Four Lines in White gold set by 0,25ct Blue Sapphire and by 0,16ct diamonds.', 2, '48-65', 'Alliance 1/2 Tour 4 Lignes Saphirs en Or blanc sertie de 0,25ct de Saphirs bleus et de 0,16ct de Diamants.', 5),
(44, 'Oqjf17QW0y', 2, '65605R001A', 'Morgana', 10000, 15, '2.3', 0.3, NULL, 80, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_44_0.jpg,ring_44_1.jpg,ring_44_2.jpg,', 'Half Eternity Ring Four Lines in White gold set by 0,30ct diamonds.', 2, '48-65', 'Alliance 1/2 Tour 4 Lignes en Or blanc sertie de 0,30ct de Diamants.', 5),
(45, '5QXH531Lyu', 2, '65605R002A', 'Vitaly', 10000, 15, '2.3', 0.39, NULL, 80, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_45_0.jpg,ring_45_1.jpg,ring_45_2.jpg,', 'Half Eternity Ring Four Lines Black & White in White gold set by 0,39ct diamonds.', 2, '48-65', 'Alliance 1/2 Tour 4 Lignes Black & White en Or blanc sertie de 0,39ct de Diamants blancs et noirs.', 5),
(46, '7mNZeq1pbK', 2, '65605R004A', 'Elise', 10000, 15, '2.3', 0.39, NULL, 80, 0, 1, 0, 'SI1', 1, 8, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_46_0.jpg,ring_46_1.jpg,ring_46_2.jpg,', 'Half Eternity Ring Four Lines in Black gold set by 0,39ct diamonds.', 2, '48-65', 'Alliance 1/2 Tour 4 Lignes en Or noir sertie de 0,39ct de Diamants.', 5),
(47, 'VP9ffUUqL9', 2, '59576R002A', 'Madelaine', 10000, 15, '1', 0.05, NULL, 11, 0, 1, 0, 'SI1', 1, 6, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_47_0.jpg,ring_47_1.jpg,ring_47_2.jpg,', 'Illusion Solitaire Ring in Yellow gold set by 0,05ct diamonds.', 4, '48', 'Bague Solitaire Illusion Or jaune sertie de 0,05ct de diamants.', 5),
(48, 'oAikd5Hosi', 2, '58697R007A', 'Florence', 10000, 15, '1.1', 0.26, NULL, 28, 0, 10, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_48_0.jpg,ring_48_1.jpg,ring_48_2.jpg,', 'Baguet Solitaire in White gold set by 0,26ct diamonds.', 4, '48', 'Bague Solitaire Baguette en Or blanc sertie de 0,26ct de diamants.', 5),
(49, '54EyV1D8PO', 2, '58723R005A', 'Charlize', 10000, 15, '1.9', 0.07, NULL, 25, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_49_0.jpg,ring_49_1.jpg,ring_49_2.jpg,', 'Line Ring in White gold set by 0,07ct diamonds.', 1, '48', 'Bague Ligne en Or blanc, sertie de 0,07ct de diamants.', 5),
(50, 'zRIksgcZnq', 2, '58723R006A', 'Jenny', 10000, 15, '1.8', 0.07, NULL, 25, 0, 1, 0, 'SI1', 1, 1, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_50_0.jpg,ring_50_1.jpg,ring_50_2.jpg,', 'Line Ring in Yellow gold set by 0,07ct diamonds.', 1, '48', 'Bague Ligne en Or jaune, sertie de 0,07ct de diamants.', 5),
(51, 'Ocq2sWUqJT', 2, '57401R004A', 'Candice', 10000, 15, '1.1', 0.06, NULL, 22, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_51_0.jpg,ring_51_1.jpg,ring_51_2.jpg,', 'Circle Ring in White gold set by 0,06ct diamonds.', 1, '48', 'Bague Cercle en Or blanc, sertie de 0,06ct de diamants.', 5),
(52, 'DIPE86ZgbF', 2, '57401R005A', 'Marine', 10000, 15, '1', 0.06, NULL, 22, 0, 1, 0, 'SI1', 1, 1, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_52_0.jpg,ring_52_1.jpg,ring_52_2.jpg,', 'Circle Ring in Yellow gold set by 0,06ct diamonds.', 1, '48', 'Bague Cercle en Or jaune, sertie de 0,06ct de diamants.', 5),
(53, 'qwNoN2gGtj', 2, '54716R001A', 'Rivka', 10000, 15, '2', 0.49, NULL, 182, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_53_0.jpg,ring_53_1.jpg,ring_53_2.jpg,', 'Ring in White gold paved by 0,49ct diamonds.', 1, '48', 'Bague Pavée en Or blanc sertie de 0,49ct de diamants.', 5),
(54, 'bQfbxJ73wg', 2, '36082R048A', 'Melissa', 10000, 15, '1.8', 0.36, NULL, 147, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_54_0.jpg,ring_54_1.jpg,ring_54_2.jpg,', 'Half Eternity Ring paved in White gold set by 0,36ct diamonds.', 2, '48', 'Alliance 1/2 Tour pavée en Or blanc, sertie de 0,36ct de diamants.', 5),
(55, 'IFowYjeEMz', 2, '53618R005A', 'Caterina', 10000, 15, '0.9', 0.06, NULL, 14, 0, 1, 0, 'SI1', 1, 1, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_55_0.jpg,ring_55_1.jpg,ring_55_2.jpg,', 'Half Eternity Ring paved in Yellow gold set by 0,06ct diamonds.', 2, '48', 'Alliance 1/2 Tour Pavée en Or jaune, sertie de 0,06ct de diamants.', 5),
(56, 'iYIDziy4kG', 2, '60362R002A', 'Arzella', 10000, 15, '0.9', 0.02, NULL, 7, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_56_0.jpg,ring_56_1.jpg,ring_56_2.jpg,', 'Line Ring in White gold set by 0,02ct diamonds.', 1, '48', 'Bague Ligne en Or blanc sertie de 0,02ct de diamants.', 5),
(57, 'G6v93Hd9lF', 2, '59547R004A', 'Riena', 10000, 15, '3.1', 0.33, NULL, 112, 0, 1, 0, 'SI1', 2, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_57_0.jpg,ring_57_1.jpg,ring_57_2.jpg,', 'Ring Black & White Three Circles in White gold set by 0,33ct diamonds.', 1, '48', 'Bague Trois Anneaux Black & White pavés en Or blanc sertie de 0,33ct de diamants.', 5),
(58, '6cMWJ1J2JT', 2, '38535R034A', 'Iris', 10000, 15, '1.1', 0.09, NULL, 27, 0, 1, 0, 'SI1', 1, 2, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_58_0.jpg,ring_58_1.jpg,ring_58_2.jpg,', 'White gold V Ring set by 0,09ct diamonds.', 1, '48', 'Bague V en Or blanc, sertie de 0,09ct de diamants.', 5),
(59, 'zJJtEgJBNZ', 2, '38535R035A', 'Heloise', 10000, 15, '1.1', 0.09, NULL, 27, 0, 1, 0, 'SI1', 1, 1, '4', NULL, NULL, NULL, '0', 2, NULL, 2, 'ring_59_0.jpg,ring_59_1.jpg,ring_59_2.jpg,', 'Yellow Gold V Ring set by 0.09ct diamonds.', 1, '48', 'Bague V en Or jaune, sertie de 0,09ct de diamants.', 5);

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
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) NOT NULL,
  `setting_key` varchar(30) NOT NULL,
  `setting_value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_key`, `setting_value`) VALUES
(1, 'conversion_rate', '1.10');

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
(2, '3', 'princebhanwra@gmail.com', '359CDC10CE64DDADDE8507E79CF32CB4'),
(7, '4', 'princebhanwra@gmail.com', '359CDC10CE64DDADDE8507E79CF32CB4'),
(15, '4', 'kk978398@gmail.com', '9A6848C614ECA519CF879F4A1227C814'),
(16, '4', 'mjmjbagga@gmail.com', 'E6EAD413A0AFFB1F08092A5805FB944F'),
(17, '4', 'developer2@alwaysinfotech.com', '926C82A49F4503624CE95199472C395E'),
(20, '4', 'alwaysinfotech@gmail.com', '7F918D5E6FA3FDFDA2B7E5BA1DEFDB21'),
(21, '3', 'preetkaurpaik@gmail.com', '3C98FB2F616893A68B4EDCE25E21D91D'),
(22, '3', 'kk@gmail.comlkk', 'D6B5FBFA859E693347A4E30CBC74DEAD'),
(23, '3', 'kk@gmial.cpmk', 'D5235A19B7AFAEE606BE9A3C9F4B7E88'),
(24, '3', 'kk@gmail.cojk', '5EA29742A30BA7A282DF61412B14636B'),
(25, '4', 'kk@gmail.copk', 'E1EDDBD66827E3FD058D163A71E6703B'),
(26, '4', 'kk@gmail.cop', 'BF01F1E1D99F49E381B1D1F43CD45F7B'),
(27, '4', 'kk@gmail.in', '3767C5F7788C4DD6C60EB429F1490246'),
(28, '4', 'pp@gamil.in', '2A34C70C23891CB6ED565063DF066EA3'),
(29, '4', 'ii@gamil.kkkkk', 'E63BB9BF2F1A86EFC10A71F870048339'),
(30, '4', 'jj@gmail.com', 'EB3F5749C95D13A0960542B68B4A2B05'),
(31, '4', 'kjhk@gmail.com', 'DD08AA453614712382C40EA954C7AD21'),
(32, '4', 'lklkkjk@gmail.com', 'F0DD864054921D8870A83C6EA4303459'),
(33, '4', 'kk22@gmail.cpom', 'A9B8A014796E35F903E657797019420A'),
(34, '3', 'kk@gmail.com', 'F537E3ED5251863861F6411F4D9AF518'),
(35, '4', 'qa@alwaysinfotech.com', '58375B04B0A60F9EA98F2313BD685B4A'),
(36, '8', 'kk978398@gmail.com', '9A6848C614ECA519CF879F4A1227C814'),
(37, '3', 'kjhk@gmail.com', 'DD08AA453614712382C40EA954C7AD21');

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
(14, 3, '8VPffS6MG3', 2, 0),
(15, 1, 'iD2Nnhu5Ke', 2, 0),
(16, 1, 'IFT8DGn39N', 1, 0);

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
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `mobileno` varchar(20) NOT NULL,
  `address` varchar(128) NOT NULL,
  `city` varchar(128) NOT NULL,
  `state` varchar(128) NOT NULL,
  `zip` varchar(128) NOT NULL,
  `country` varchar(128) NOT NULL,
  `address_type` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`id`, `user_id`, `first_name`, `last_name`, `email`, `mobileno`, `address`, `city`, `state`, `zip`, `country`, `address_type`) VALUES
(1, 48, 'test11', 'test21', 'alwaysinfotech1@gmail.com', '911111111131', 'SWinnocentstone4', '', '', '', '', 'b'),
(2, 48, 'test11', 'test21', 'alwaysinfotech1@gmail.com', '911111111131', 'SWinnocentstone4', '', '', '', '', 's'),
(3, 61, 'test', 'test', 'alwaysinfotech1@gmail.com', '9111111111', 'alwaysinfotech1@gmail.com', '', '', '', '', 'b'),
(4, 61, 'test', 'test', 'alwaysinfotech1@gmail.com', '9111111111', 'alwaysinfotech1@gmail.com', '', '', '', '', 's'),
(5, 62, 'Jaspreet1', 'Singh1', 'alwaysinfotech@gmail.com', '10234567891', 'santa clara', '', '', '', '', 'b'),
(6, 62, 'Jaspreet1', 'Singh1', 'alwaysinfotech@gmail.com', '10234567891', 'santa clara', '', '', '', '', 's'),
(7, 59, 'simran', 'kaur', 'abc@gmail.com', '7894561234', '#at mangat ram', '', '', '', '', 'b'),
(8, 59, 'simran', 'kaur', 'abc@gmail.com', '7894561234', '#at mangat ram', '', '', '', '', 's'),
(9, 49, 'komal', 'kaur', 'kk@gmail.com', '1234567892', 'sssss', '', '', '', '', 'b'),
(10, 49, 'komal', 'kaur', 'kk@gmail.com', '1234567892', 'sssss', '', '', '', '', 's'),
(11, 45, 'Prince', 'Bhanwra', 'princebhanwra@gmail.com', '4662558393456', 'test address1', '', '', '', '', 'b'),
(12, 45, 'Prince', 'Bhanwra', 'princebhanwra@gmail.com', '4662558393456', 'test address1', '', '', '', '', 's'),
(13, 63, 'Jaspreet', 'Singh', 'alwaysinfotech@gmail.com', '977979749285', 'santa clara', '', '', '', '', 'b'),
(14, 63, 'Jaspreet', 'Singh', 'alwaysinfotech@gmail.com', '977979749285', 'santa clara', '', '', '', '', 's'),
(15, 39, 'developer1', 'test', 'alwaysinfotech1@gmail.com', '9111111111', 'ldh', '', '', '', '', 'b'),
(16, 39, 'developer1', 'test', 'alwaysinfotech1@gmail.com', '9111111111', 'ldh', '', '', '', '', 's');

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
(1, 'diamantsecretdb_1_5_6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `excel_importer`
--
ALTER TABLE `excel_importer`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `order_history`
--
ALTER TABLE `order_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
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
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `bracelets`
--
ALTER TABLE `bracelets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11', AUTO_INCREMENT=76;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11', AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `excel_importer`
--
ALTER TABLE `excel_importer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gold_quality`
--
ALTER TABLE `gold_quality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;
--
-- AUTO_INCREMENT for table `min_max_values`
--
ALTER TABLE `min_max_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `necklaces`
--
ALTER TABLE `necklaces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11', AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `order_history`
--
ALTER TABLE `order_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `pendants`
--
ALTER TABLE `pendants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `rings`
--
ALTER TABLE `rings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11', AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `tb_cart`
--
ALTER TABLE `tb_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
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
--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

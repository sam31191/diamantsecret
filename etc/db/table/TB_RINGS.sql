CREATE TABLE IF NOT EXISTS `rings` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'int 11',
  `unique_key` varchar(11) NOT NULL,
  `company_id` int(11) NULL COMMENT 'int 11',
  `internal_id` varchar(11) NULL COMMENT 'varchar 11',
  `product_name` varchar(50) NULL COMMENT 'varchat 50',
  `pieces_in_stock` int(11) NULL COMMENT 'int 11',
  `days_for_shipment` int(11) NULL COMMENT 'int 11',
  `total_gold_weight` float NULL,
  `total_carat_weight` float NULL DEFAULT NULL COMMENT 'varchar 11',
  `color_stone_carat` float NULL DEFAULT NULL,
  `no_of_stones` int(11) NULL DEFAULT NULL COMMENT 'int 11',
  `no_of_color_stones` int(11) NULL DEFAULT NULL,
  `diamond_shape` int(11) NULL COMMENT 'int 11',
  `color_stone_shape` int(11) NULL DEFAULT NULL,
  `clarity` varchar(11) NULL COMMENT 'varchar 11',
  `color` int(11) NULL COMMENT 'int 11',
  `material` int(11) NULL COMMENT 'int 11',
  `gold_quality` varchar(32) NULL,
  `color_stone_type` varchar(32) NULL,
  `height` varchar(30) NULL COMMENT 'varchar 30',
  `width` varchar(30) NULL COMMENT 'varchat 30',
  `length` varchar(30) NULL COMMENT 'varchar 30',
  `country_id` int(11) NULL COMMENT 'int 11',
  `subcategory` int(11) NULL DEFAULT NULL,
  `lab_grown` int(11) NULL COMMENT '1 = true; 0 = false',
  `images` varchar(1024) NULL COMMENT 'varchar 1024',
  `description` varchar(250) NULL COMMENT 'varchar 250',
  `ring_subcategory` int(11) NULL COMMENT 'int 11',
  `ring_size` varchar(128) NULL COMMENT 'varchar 128',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_key` (`unique_key`),
  UNIQUE KEY `internal_id` (`internal_id`)
) ENGINE=InnoDB;
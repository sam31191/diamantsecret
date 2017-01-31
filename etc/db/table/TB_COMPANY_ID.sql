CREATE TABLE IF NOT EXISTS `company_id` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_code` varchar(32) NOT NULL UNIQUE,
  `company_name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `mobileno` varchar(128) NOT NULL,
  `address` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
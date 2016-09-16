CREATE TABLE IF NOT EXISTS `version` (
  `id` int(11) NOT NULL,
  `sql_version` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
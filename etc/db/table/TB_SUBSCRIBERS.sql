CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `hash` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `Email` (`email`,`username`)
) ENGINE=InnoDB;
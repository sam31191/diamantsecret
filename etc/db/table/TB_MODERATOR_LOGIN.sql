CREATE TABLE IF NOT EXISTS `moderator_login` (
  `username` varchar(128) NOT NULL,
  `last_login` varchar(128) NOT NULL,
  `login_ip` varchar(128) NOT NULL
) ENGINE=InnoDB;
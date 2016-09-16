CREATE TABLE IF NOT EXISTS `country_vat` (
  `tm` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `country_name` varchar(128) NOT NULL,
  `vat` int(11) NOT NULL,
  PRIMARY KEY (`tm`)
) ENGINE=InnoDB;
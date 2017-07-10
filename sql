CREATE TABLE `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `surname` varchar(40) NOT NULL,
  `name` varchar(40) NOT NULL,
  `lastname` varchar(40) DEFAULT NULL,
  `bithday` date NOT NULL,
  `sex_id` int(11) NOT NULL,
  `image` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `sexes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
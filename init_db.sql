CREATE DATABASE IF NOT EXISTS `ih_admin`;
USE ih_admin;
CREATE TABLE IF NOT EXISTS `accounts` (
	`username` varchar(32) NOT NULL,
	`password` varchar(32) NOT NULL,
	PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
INSERT INTO `accounts` (`username`, `password`) VALUES ("moyu", "moyu@123");

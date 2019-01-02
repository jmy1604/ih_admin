CREATE DATABASE IF NOT EXISTS `ih_admin`;

CREATE TABLE IF NOT EXISTS `account` (
	`username` varchar(32) NOT NULL,
	`password` varchar(32) NOT NULL,
	PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- Adminer 4.8.1 MySQL 5.5.5-10.4.27-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `companys`;
CREATE TABLE `companys` (
  `companyid` int(11) NOT NULL AUTO_INCREMENT,
  `companyname` varchar(50) NOT NULL,
  `companyemail` varchar(50) NOT NULL,
  `companynumber` varchar(11) NOT NULL,
  `companyiban` varchar(50) NOT NULL,
  `companyaddress` text NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`companyid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

INSERT INTO `companys` (`companyid`, `companyname`, `companyemail`, `companynumber`, `companyiban`, `companyaddress`, `userid`) VALUES
(1,	'Veli Company',	'velicompany@gmail.com',	'05078403484',	'848948794498448484984',	'İzmir',	2),
(2,	'Ayşe Company',	'aysecompany@gmail.com',	'05056418249',	'4645465545454654654654654554546',	'Ankara',	3);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `useremail` varchar(50) NOT NULL,
  `userpassword` varchar(255) NOT NULL,
  `usergender` varchar(10) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `userdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `userdebt` decimal(15,2) NOT NULL DEFAULT 0.00,
  `debtime` datetime NOT NULL,
  `selectcompany` varchar(50) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

INSERT INTO `users` (`userid`, `username`, `useremail`, `userpassword`, `usergender`, `role`, `userdate`, `userdebt`, `debtime`, `selectcompany`) VALUES
(1,	'Admin',	'admin@gmail.com',	'$2y$10$fgZZNceAng2nJr6kKvAfduJ7l2hfRxGHkAqiYFaIADp51ShunB3mC',	'Male',	1,	'2023-12-04 14:32:57',	0.00,	'0000-00-00 00:00:00',	''),
(2,	'Veli Baba',	'veli@gmail.com',	'$2y$10$cXKlgkyGhxclgwjcLPBPKO6/QUuvbizvvQIJkkkuPK2.6tZJxBVCi',	'Male',	1,	'2023-12-04 14:33:04',	0.00,	'0000-00-00 00:00:00',	''),
(3,	'Ayşe Yılmaz',	'ayse@gmail.com',	'$2y$10$cNh63IQv.hKM4NCRBg5ECuJQzYTpALCtob4JquULaCAWeFV6Ioa/W',	'Female',	1,	'2023-12-04 14:33:14',	0.00,	'0000-00-00 00:00:00',	'');

-- 2023-12-04 14:34:04

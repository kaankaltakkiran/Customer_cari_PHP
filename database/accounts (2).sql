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
  `companydebt` decimal(15,2) NOT NULL,
  `debtime` datetime NOT NULL,
  `requserid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`companyid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

INSERT INTO `companys` (`companyid`, `companyname`, `companyemail`, `companynumber`, `companyiban`, `companyaddress`, `companydebt`, `debtime`, `requserid`, `userid`) VALUES
(1,	'Ayşe Company',	'aysecompany@gmail.com',	'05076600884',	'848948794498448484984',	'CUMHURİYET MAH. NECİP FAZIL KISAKÜREK SK. BAHAR APT NO: 18  İÇ KAPI NO: 25',	500.00,	'2023-12-04 22:03:29',	1,	2),
(2,	'Veli Company',	'velicompany@gmail.com',	'05078403484',	'4645465545454654654654654554546',	'ankara',	0.00,	'0000-00-00 00:00:00',	0,	1);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `useremail` varchar(50) NOT NULL,
  `userpassword` varchar(255) NOT NULL,
  `usergender` varchar(10) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `userdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `userdebt` decimal(15,2) NOT NULL,
  `selectcompany` varchar(50) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

INSERT INTO `users` (`userid`, `username`, `useremail`, `userpassword`, `usergender`, `role`, `userdate`, `userdebt`, `selectcompany`) VALUES
(1,	'Veli Baba',	'veli@gmail.com',	'$2y$10$8EQr2J2xhlF5JIr0n3CqiewSYHSxtq2gOnoMzEyj2gl.ctPcPJxA.',	'Male',	1,	'2023-12-04 21:03:29',	-500.00,	'1'),
(2,	'Ayşe Yılmaz',	'ayse@gmail.com',	'$2y$10$1sFHIH9wpWN59Y5PQJ8qDeSUv2iO99rya.B6rwgNkwvFmC7jaTQma',	'Female',	1,	'2023-12-04 21:02:02',	0.00,	'');

-- 2023-12-05 08:08:54

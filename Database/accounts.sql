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
  `companybalance` decimal(15,2) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`companyid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

INSERT INTO `companys` (`companyid`, `companyname`, `companyemail`, `companynumber`, `companyiban`, `companyaddress`, `companybalance`, `userid`) VALUES
(1,	'Veli Company',	'velicompany@gmail.com',	'05078403484',	'848948794498448484984',	'İstanbul',	-500.00,	3),
(2,	'Selin Company',	'selincompany@gmail.com',	'05056418249',	'4645465545454654654654654554546',	'Ankara',	300.00,	4),
(3,	'Ahmet Company',	'ahmetcompany@gmail.com',	'05078403489',	'465465465465465465465465465',	'Bursa',	200.00,	5);

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(50) NOT NULL,
  `senderid` int(11) NOT NULL,
  `reciver` varchar(50) NOT NULL,
  `reciverid` int(11) NOT NULL,
  `companybalance` decimal(15,2) NOT NULL,
  `processtime` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `transactions` (`id`, `sender`, `senderid`, `reciver`, `reciverid`, `companybalance`, `processtime`) VALUES
(1,	'Veli Company',	3,	'Selin Company',	4,	500.00,	'2023-12-13 18:39:39'),
(2,	'Selin Company',	4,	'Ahmet Company',	5,	200.00,	'2023-12-13 18:48:48');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `useremail` varchar(50) NOT NULL,
  `userpassword` varchar(255) NOT NULL,
  `usergender` varchar(10) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `userdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

INSERT INTO `users` (`userid`, `username`, `useremail`, `userpassword`, `usergender`, `role`, `userdate`) VALUES
(1,	'Admin',	'admin@gmail.com',	'$2y$10$mx84uG7bp96m6szXk3FzP.Poo2GCpH.Zc31ZKbGdGM8POe0SkHXwu',	'Male',	2,	'2023-12-13 12:42:54'),
(2,	'Kaan Kaltakkıran',	'kaan_fb_aslan@hotmail.com',	'$2y$10$gEwP3gKRhyl8/b0k.0TDgOUdLqN/MGGLHd3a3cFbmRHxKk9EX8DDG',	'Male',	1,	'2023-12-13 12:43:14'),
(3,	'Veli Türksoyu',	'veli@gmail.com',	'$2y$10$Li3uTYBH8A9M.8f.IhNuAuTvCgc3qNhZO7pAOxfttTdlaXccFCj9m',	'Male',	1,	'2023-12-13 12:43:48'),
(4,	'Selin Genç',	'selin@gmail.com',	'$2y$10$dCoLVvgYe6tN.pMYMauncuA50HJXBqRXovyzkZtxNIo1XtQByUrHu',	'Female',	1,	'2023-12-13 12:44:02'),
(5,	'Ahmet Yılmaz',	'ahmet@gmail.com',	'$2y$10$d9HlFR.rD9cr/ITR7BgT1urdp0midaNGp1QRMDp/73y00LjuqaLwS',	'Male',	1,	'2023-12-13 15:25:55');

-- 2023-12-14 08:14:07

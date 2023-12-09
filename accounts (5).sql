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
(1,	'Kaan Company',	'kaancompany@hotmail.com',	'05076600884',	'848948794498448484984',	'İzmir',	150.00,	2),
(2,	'Ayşe Company',	'aysecompany@gmail.com',	'05078403484',	'4645465545454654654654654554546',	'İstanbul',	-100.00,	3),
(3,	'Veli Company',	'velicompany@gmail.com',	'05056418249',	'4645465545454654654654654554549',	'Bursa',	-200.00,	4),
(4,	'Selin Company',	'selincompany@gmail.com',	'05078403489',	'465465465465465465465465465',	'Ankara',	150.00,	5);

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
(1,	'Veli Company',	4,	'Kaan Company',	2,	100.00,	'2023-12-09 16:21:48'),
(2,	'Kaan Company',	2,	'Veli Company',	4,	100.00,	'2023-12-09 16:22:31'),
(3,	'Selin Company',	5,	'Kaan Company',	2,	150.00,	'2023-12-09 16:24:18'),
(4,	'Veli Company',	4,	'Ayşe Company',	3,	200.00,	'2023-12-09 16:24:33'),
(5,	'Ayşe Company',	3,	'Selin Company',	5,	300.00,	'2023-12-09 16:24:48');

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
(1,	'Admin',	'admin@gmail.com',	'$2y$10$OpBpHyid7IpSxQJEqLGQMux0dBMGkuLDaYtq594TUfkTYnQki3Ivu',	'Male',	2,	'2023-12-09 13:04:07'),
(2,	'Kaan Kaltakkıran',	'kaan_fb_aslan@hotmail.com',	'$2y$10$7EF9sjV8zuZStEMTvyeEEO2vIsLCP3TZwLvWrdTKvvSc68thDaRcy',	'Male',	1,	'2023-12-09 13:03:31'),
(3,	'Ayşe Yılmaz',	'ayse@gmail.com',	'$2y$10$QuJcKggYp7C.AZ7B9pZW3udkFlHZUOrpFVcJLD4QGepmWmk95oHli',	'Female',	1,	'2023-12-09 13:03:39'),
(4,	'Veli Yıldız',	'veli@gmail.com',	'$2y$10$WXXtoXWbiItsVx8XnfECmOZoeNQTVG0WnFOJDVOEKQ3cJCXP.RZoO',	'Male',	1,	'2023-12-09 13:04:25'),
(5,	'Selin Genç',	'selin@gmail.com',	'$2y$10$VLshyCeRafOcHm2EDoV/hOTkp/EgagTL7THFQKA4YpYBOZbQxHgma',	'Female',	1,	'2023-12-09 13:04:48');

-- 2023-12-09 13:25:44

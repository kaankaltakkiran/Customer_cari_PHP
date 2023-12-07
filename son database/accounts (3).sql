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
(1,	'Veli Company',	'velicompany@gmail.com',	'05078403484',	'848948794498448484984',	'ankara',	0.00,	'0000-00-00 00:00:00',	0,	1),
(2,	'Ayşe Company',	'aysecompany@gmail.com',	'05056418249',	'4645465545454654654654654554549',	'CUMHURİYET MAH. NECİP FAZIL KISAKÜREK SK. BAHAR APT NO: 18  İÇ KAPI NO: 25',	0.00,	'0000-00-00 00:00:00',	0,	2),
(3,	'kaan company',	'kaan_Fb_Aslan@hotmail.com',	'05076600884',	'798',	'ankara',	0.00,	'0000-00-00 00:00:00',	0,	3),
(4,	'Denek 1 Company',	'denek1company@gmail.com',	'05078403489',	'848948794498448484989',	'bursa',	0.00,	'0000-00-00 00:00:00',	0,	4),
(5,	'Denek 2 Company',	'denek2company@gmail.com',	'05078403489',	'4645465545454654654654654554549',	'izmir\r\n',	0.00,	'0000-00-00 00:00:00',	0,	5);

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(50) NOT NULL,
  `senderid` int(11) NOT NULL,
  `reciver` varchar(50) NOT NULL,
  `reciverid` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `processtime` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `transaction` (`id`, `sender`, `senderid`, `reciver`, `reciverid`, `balance`, `processtime`) VALUES
(1,	'Ayşe Yılmaz',	0,	'Veli Baba',	0,	20,	'2023-12-05 17:27:55'),
(2,	'Veli Baba',	0,	'Ayşe Yılmaz',	0,	200,	'2023-12-05 17:32:13'),
(3,	'Ayşe Yılmaz',	0,	'Veli Baba',	0,	200,	'2023-12-05 17:34:39'),
(4,	'Ayşe Yılmaz',	0,	'Veli Baba',	0,	20,	'2023-12-06 09:37:54'),
(5,	'Veli Baba',	0,	'Ayşe Yılmaz',	0,	300,	'2023-12-06 09:41:24'),
(6,	'Ayşe Yılmaz',	0,	'Veli Baba',	0,	200,	'2023-12-06 09:44:15'),
(7,	'Ayşe Yılmaz',	0,	'Veli Baba',	0,	100,	'2023-12-06 09:45:01'),
(8,	'Veli Baba',	0,	'Ayşe Yılmaz',	0,	400,	'2023-12-06 09:48:16'),
(9,	'Veli Baba',	0,	'Ayşe Yılmaz',	0,	100,	'2023-12-06 09:48:47'),
(10,	'Veli Baba',	0,	'Ayşe Yılmaz',	0,	100,	'2023-12-06 09:49:34'),
(11,	'Veli Baba',	0,	'Ayşe Yılmaz',	0,	100,	'2023-12-06 09:50:58'),
(12,	'Veli Baba',	0,	'Ayşe Yılmaz',	0,	100,	'2023-12-06 09:51:04'),
(13,	'Veli Baba',	0,	'Ayşe Yılmaz',	0,	100,	'2023-12-06 09:53:11'),
(14,	'Veli Baba',	1,	'Ayşe Yılmaz',	2,	200,	'2023-12-06 10:55:17'),
(15,	'denek1',	4,	'Kaan Kaltakkıran',	3,	200,	'2023-12-06 17:51:59');

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
  `balance` int(11) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

INSERT INTO `users` (`userid`, `username`, `useremail`, `userpassword`, `usergender`, `role`, `userdate`, `userdebt`, `selectcompany`, `balance`) VALUES
(1,	'Veli Baba',	'veli@gmail.com',	'$2y$10$LfTxWUa8qwoSA.2n8Lb9NeLd8DhCc1xhC60JGis4k5COhXCq0YW5e',	'Male',	1,	'2023-12-06 07:55:17',	0.00,	'',	300),
(2,	'Ayşe Yılmaz',	'ayse@gmail.com',	'$2y$10$7hjJiXbT3MCLQ7CGwe2WUeIavkGgzhPh4argRn7oyPgN.Mp7h5BqK',	'Female',	1,	'2023-12-06 07:55:17',	0.00,	'',	500),
(3,	'Kaan Kaltakkıran',	'kaan_fb_aslan@hotmail.com',	'$2y$10$vic.OUeN3kWQA5bxZMfL2OXl.yrmlsIiTwtgmp5wJ0hDh5gYqOYke',	'Male',	1,	'2023-12-06 14:51:59',	0.00,	'',	200),
(4,	'denek1',	'denek1@gmail.com',	'$2y$10$MqpDlM6O08HOCguTvSo6HOjOT8rbguR0i4VROB4tW3LykbUAjJy0q',	'Male',	1,	'2023-12-06 14:51:59',	0.00,	'',	500),
(5,	'denek2',	'denek2@gmail.com',	'$2y$10$CcoLqZ.JeNtOlwAxU7GBAOnu6x9lMXhYAh8AdXm7DYtXndARKJ7Re',	'Female',	1,	'2023-12-06 14:41:19',	0.00,	'',	0);

-- 2023-12-06 16:48:27

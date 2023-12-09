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
  `debtime` datetime NOT NULL,
  `requserid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`companyid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

INSERT INTO `companys` (`companyid`, `companyname`, `companyemail`, `companynumber`, `companyiban`, `companyaddress`, `companybalance`, `debtime`, `requserid`, `userid`) VALUES
(1,	'Veli Company',	'velicompany@gmail.com',	'05078403484',	'848948794498448484984',	'ankara',	300.00,	'0000-00-00 00:00:00',	0,	1),
(2,	'Ayşe Company',	'aysecompany@gmail.com',	'05056418249',	'4645465545454654654654654554549',	'Çankırı',	200.00,	'0000-00-00 00:00:00',	0,	2),
(6,	'Denek 4 Company',	'denek4company@gmail.com',	'05078403489',	'848948794498448484989',	'kocaeli',	350.00,	'0000-00-00 00:00:00',	0,	7),
(3,	'kaan company',	'kaan_Fb_Aslan@hotmail.com',	'05076600884',	'798',	'ankara',	200.00,	'0000-00-00 00:00:00',	0,	3),
(4,	'Denek 1 Company',	'denek1company@gmail.com',	'05078403489',	'848948794498448484989',	'bursa',	300.00,	'0000-00-00 00:00:00',	0,	4),
(5,	'Denek 2 Company',	'denek2company@gmail.com',	'05078403489',	'4645465545454654654654654554549',	'izmir\r\n',	200.00,	'0000-00-00 00:00:00',	0,	5),
(7,	'Denek 3 Company',	'denek3company@gmail.com',	'05078403489',	'4645465545454654654654654554546',	'izmit',	500.00,	'0000-00-00 00:00:00',	0,	6),
(8,	'Murat Company',	'muratcompany@gmail.com',	'13464645654',	'56564456456465465456645',	'Afyon\r\n',	100.00,	'0000-00-00 00:00:00',	0,	8),
(9,	'Selin Company',	'selincompany@gmail.com',	'44859849849',	'4484894189489448',	'Uşak',	-100.00,	'0000-00-00 00:00:00',	0,	9);

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(50) NOT NULL,
  `senderid` int(11) NOT NULL,
  `reciver` varchar(50) NOT NULL,
  `reciverid` int(11) NOT NULL,
  `companybalance` decimal(15,2) NOT NULL,
  `processtime` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `transaction` (`id`, `sender`, `senderid`, `reciver`, `reciverid`, `companybalance`, `processtime`) VALUES
(1,	'Veli Company',	1,	'Ayşe Company',	2,	200.00,	'2023-12-08 14:58:27'),
(2,	'Ayşe Company',	2,	'kaan company',	3,	100.00,	'2023-12-08 14:58:48'),
(3,	'Veli Company',	1,	'Ayşe Company',	2,	1.00,	'2023-12-08 20:25:08'),
(4,	'Veli Company',	1,	'Ayşe Company',	2,	1.00,	'2023-12-08 20:25:11'),
(5,	'Veli Company',	1,	'Ayşe Company',	2,	1.00,	'2023-12-08 20:25:14'),
(6,	'Veli Company',	1,	'Ayşe Company',	2,	1.00,	'2023-12-08 20:25:18'),
(7,	'Veli Company',	1,	'Ayşe Company',	2,	1.00,	'2023-12-08 20:25:22'),
(8,	'Veli Company',	1,	'Ayşe Company',	2,	1.00,	'2023-12-08 20:25:25'),
(9,	'Veli Company',	1,	'Ayşe Company',	2,	1.00,	'2023-12-08 20:25:29'),
(10,	'Veli Company',	1,	'Ayşe Company',	2,	1.00,	'2023-12-08 20:25:32'),
(11,	'Veli Company',	1,	'Ayşe Company',	2,	1.00,	'2023-12-08 20:25:36'),
(12,	'Veli Company',	1,	'Ayşe Company',	2,	1.00,	'2023-12-08 20:25:39'),
(13,	'Veli Company',	1,	'Ayşe Company',	2,	20.00,	'2023-12-08 20:25:42'),
(14,	'Denek 1 Company',	4,	'Denek 2 Company',	5,	190.00,	'2023-12-09 10:28:43'),
(15,	'Denek 4 Company',	6,	'Denek 4 Company',	6,	250.00,	'2023-12-09 15:05:35'),
(16,	'Denek 4 Company',	6,	'Denek 4 Company',	6,	100.00,	'2023-12-09 15:06:27'),
(17,	'Veli Company',	1,	'kaan company',	3,	70.00,	'2023-12-09 15:07:39'),
(18,	'Veli Company',	1,	'Ayşe Company',	2,	70.00,	'2023-12-09 15:08:52'),
(19,	'Veli Company',	1,	'kaan company',	3,	30.00,	'2023-12-09 15:09:12'),
(20,	'Veli Company',	1,	'Denek 1 Company',	4,	90.00,	'2023-12-09 15:09:23'),
(21,	'Veli Company',	1,	'Denek 2 Company',	5,	10.00,	'2023-12-09 15:09:41'),
(22,	'Murat Company',	8,	'Selin Company',	9,	100.00,	'2023-12-09 15:13:23'),
(23,	'Selin Company',	9,	'Murat Company',	8,	200.00,	'2023-12-09 15:13:59');

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
(1,	'Veli Baba',	'veli@gmail.com',	'$2y$10$LfTxWUa8qwoSA.2n8Lb9NeLd8DhCc1xhC60JGis4k5COhXCq0YW5e',	'Male',	1,	'2023-12-08 11:00:09',	0.00,	'',	480),
(2,	'Ayşe Yılmaz',	'ayse@gmail.com',	'$2y$10$7hjJiXbT3MCLQ7CGwe2WUeIavkGgzhPh4argRn7oyPgN.Mp7h5BqK',	'Female',	1,	'2023-12-06 07:55:17',	0.00,	'',	500),
(3,	'Kaan Kaltakkıran',	'kaan_fb_aslan@hotmail.com',	'$2y$10$vic.OUeN3kWQA5bxZMfL2OXl.yrmlsIiTwtgmp5wJ0hDh5gYqOYke',	'Male',	1,	'2023-12-06 14:51:59',	0.00,	'',	200),
(4,	'denek1',	'denek1@gmail.com',	'$2y$10$MqpDlM6O08HOCguTvSo6HOjOT8rbguR0i4VROB4tW3LykbUAjJy0q',	'Male',	1,	'2023-12-06 14:51:59',	0.00,	'',	500),
(5,	'denek2',	'denek2@gmail.com',	'$2y$10$CcoLqZ.JeNtOlwAxU7GBAOnu6x9lMXhYAh8AdXm7DYtXndARKJ7Re',	'Female',	1,	'2023-12-06 14:41:19',	0.00,	'',	0),
(6,	'denek 3',	'denek3@gmail.com',	'$2y$10$vlx6UrzH8Ha1bEVXt/2QUOjOHZQb9yVpsh5OhYflL1vIvYhkPzDq6',	'Male',	1,	'2023-12-08 10:01:59',	0.00,	'',	0),
(7,	'denek 4',	'denek4@gmail.com',	'$2y$10$gSoQBEqPeAaMxa4At3woNeykUmg.kAmH9DhD/F4f5RkA6xIE/at4K',	'Female',	1,	'2023-12-08 10:02:15',	0.00,	'',	0),
(8,	'Murat',	'murat@gmail.com',	'$2y$10$wdzPYat/PPYUyEjZKVEQgeK16zTfuKqH1qTqSzE4fvR27bD.fhHHy',	'Male',	1,	'2023-12-09 12:11:10',	0.00,	'',	0),
(9,	'Selin',	'selin@gmail.com',	'$2y$10$RjYkeKHlpYS7ZqOUhyLf9ucPn1KYxjKCJgtmh6hn3eLIn76EEWhQq',	'Female',	1,	'2023-12-09 12:11:47',	0.00,	'',	0);

-- 2023-12-09 12:14:42

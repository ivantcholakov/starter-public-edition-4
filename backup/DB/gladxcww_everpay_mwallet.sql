-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 19, 2018 at 06:55 AM
-- Server version: 5.6.37-82.2-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gladxcww_everpay_mwallet`
--

-- --------------------------------------------------------

--
-- Table structure for table `btc_order`
--

CREATE TABLE `btc_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `adress` varchar(500) CHARACTER SET utf8 NOT NULL,
  `payeer` varchar(300) CHARACTER SET utf8 NOT NULL,
  `merchant` varchar(100) CHARACTER SET utf8 NOT NULL,
  `date` datetime NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE `captcha` (
  `captcha_id` bigint(13) UNSIGNED NOT NULL,
  `captcha_time` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(30, 1509912142, '109.106.140.102', '7FVXp'),
(34, 1509913315, '109.106.140.102', '0VKSi'),
(41, 1509914132, '109.106.140.102', 'GQY0K'),
(43, 1517208600, '177.237.151.234', 'WimHc'),
(44, 1522942563, '220.181.108.163', 'ON2Ht'),
(45, 1523283732, '66.249.65.120', 'Qqawk'),
(46, 1523489244, '77.88.47.9', 'm277g'),
(47, 1523668379, '77.88.47.9', 'es3wA'),
(48, 1523764146, '77.88.47.9', 'bXqSt'),
(49, 1523849066, '77.88.47.9', 'aMkH1'),
(50, 1523885040, '220.181.108.113', 'B5dDP'),
(51, 1524055750, '77.88.47.9', 'scild'),
(52, 1524132010, '220.181.108.94', 'OrAca'),
(53, 1528433629, '::1', '4rZb1'),
(54, 1528434159, '::1', 'tNVMP'),
(55, 1528434162, '::1', '6UhgA'),
(56, 1528434387, '::1', 'd1u0p'),
(57, 1528519244, '192.168.0.116', 'q7LiH'),
(58, 1528530971, '43.241.146.168', 'GDiSq'),
(59, 1528530974, '43.241.146.168', 'hLzw6');

-- --------------------------------------------------------

--
-- Table structure for table `currencys`
--

CREATE TABLE `currencys` (
  `id` int(11) NOT NULL,
  `base_name` varchar(256) NOT NULL,
  `base_code` varchar(128) NOT NULL,
  `extra1_check` int(11) NOT NULL,
  `extra1_name` varchar(256) NOT NULL,
  `extra1_code` varchar(128) NOT NULL,
  `extra1_rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `extra2_check` int(11) NOT NULL,
  `extra2_name` varchar(256) NOT NULL,
  `extra2_code` varchar(256) NOT NULL,
  `extra2_rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `extra3_check` int(11) NOT NULL,
  `extra3_name` varchar(256) NOT NULL,
  `extra3_code` varchar(128) NOT NULL,
  `extra3_rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `extra4_check` int(11) NOT NULL,
  `extra4_name` varchar(256) NOT NULL,
  `extra4_code` varchar(128) NOT NULL,
  `extra4_rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `extra5_check` int(11) NOT NULL,
  `extra5_name` varchar(256) NOT NULL,
  `extra5_code` varchar(128) NOT NULL,
  `extra5_rate` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `currencys`
--

INSERT INTO `currencys` (`id`, `base_name`, `base_code`, `extra1_check`, `extra1_name`, `extra1_code`, `extra1_rate`, `extra2_check`, `extra2_name`, `extra2_code`, `extra2_rate`, `extra3_check`, `extra3_name`, `extra3_code`, `extra3_rate`, `extra4_check`, `extra4_name`, `extra4_code`, `extra4_rate`, `extra5_check`, `extra5_name`, `extra5_code`, `extra5_rate`) VALUES
(1, 'Base Wallet', 'USD', 1, 'Russian Ruble', 'RUB', '51.99', 1, 'Euro', 'EUR', '0.65', 0, 'Grivna Ukraine', 'UAH', '1.50', 1, 'Chine Wallet', 'CNY', '18.00', 1, 'Gold 958', 'GLD', '980.00');

-- --------------------------------------------------------

--
-- Table structure for table `disputes`
--

CREATE TABLE `disputes` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction` int(10) NOT NULL,
  `time_transaction` datetime NOT NULL,
  `time_dispute` datetime NOT NULL,
  `claimant` varchar(128) NOT NULL,
  `defendant` varchar(128) NOT NULL,
  `status` enum('1','2','3','4') NOT NULL,
  `comments` int(11) NOT NULL,
  `sum` decimal(10,2) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(128) NOT NULL,
  `title` text NOT NULL,
  `message` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `disputes_comment`
--

CREATE TABLE `disputes_comment` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_dispute` int(10) NOT NULL,
  `time` datetime NOT NULL,
  `user` varchar(128) NOT NULL,
  `role` enum('1','2','3','4','5') NOT NULL,
  `comment` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(256) NOT NULL,
  `title` varchar(128) NOT NULL,
  `message` text NOT NULL,
  `created` datetime NOT NULL,
  `read` datetime DEFAULT NULL,
  `read_by` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text CHARACTER SET ucs2 NOT NULL,
  `message` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `title`, `message`) VALUES
(2, 'Notice to receive', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">The transaction status is changed!</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Notice to receive! </strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						The funds amount equal to [SUM] [CYR] were received on your account. You can see details of the transaction after sign in your account.</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[URL_HISTORY]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">Operations history</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]<br />\r\n						&nbsp;</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(3, 'Withdrawal pending!', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">The transaction status is changed!</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Withdrawal pending! </strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						The withdrawal, amount equal to [SUM] [CYR], were deducted from your account. Time of execution depends on the type of withdrawal you chosen.</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[URL_HISTORY]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">Operations history</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(4, 'Completed currency exchange!', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">The transaction status is changed!</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Completed currency exchange! </strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						You successfully exchanged [SUM_1] [CYR_1] on&nbsp;[SUM_2] [CYR_2]. You can checked the current balance and transaction history after log in your account.</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[URL_HISTORY]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">Operations history</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(5, 'Open dispute!', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">The status of dispute is changed!</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #F44336;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #F44336;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Open dispute!</strong></p>\r\n						</td>\r\n						<td style=\"background: #F44336;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						User [CLAIMANT] opened&nbsp;a dispute about the&nbsp;transaction ID [ID_TRANSACTION]. Check out the subject of the dispute and give your answer.</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[URL_SITE]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">Go to account</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(6, 'New comment for dispute', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">The status of dispute is changed!</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>New comment for dispute </strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						A new comment was added for the dispute ID [ID_DISPUTE]. You can read it after log in the account.</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[URL_DISPUTE][ID_DISPUTE]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">Details</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(7, 'Claim opened!', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">The status of dispute is changed!</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #F44336;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#F44336\" height=\"50\" style=\"background: #F44336;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Claim opened </strong></p>\r\n						</td>\r\n						<td style=\"background: #F44336;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						Your dispute ID [ID_DISPUTE] was transferred to the claim. We will study all the correspondence and will can demand additional information. Expect solutions of the dispute.</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[URL_DISPUTE][ID_DISPUTE]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">Details</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(8, 'Claim rejected', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">The status of dispute is changed!</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Claim rejected </strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						After a thorough analysis of the evidence provided by ID [ID_DISPUTE], we have completed the investigation and decided in favor of the seller.</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[URL_DISPUTE][ID_DISPUTE]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">Details</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(10, 'New message in ticket', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">The ticket status is changed!</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>New message </strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						Ticket ID [ID_TICKET] has been added a new message. To answer, you need to log in to your account.</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[URL_TICKET][ID_TICKET]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">Go to message</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(11, 'Ticket closed', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">The ticket status is changed!</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Ticket closed!</strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						Ticket ID [ID_TICKET] was closed. We are glad that this issue has been resolved for you.</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[URL_TICKET][ID_TICKET]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">View ticket</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(12, 'Documents received for review', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">The verification status is changed</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Documents received for review!</strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						We received your documents. We need 2-3 business days to verify.&nbsp;We will notify you of the result.</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[URL_CHECK]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">Check status</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(13, 'Document verified', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">The verification status is changed</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Uploaded document verified!</strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						One of yours documents was successfully checked. To change the status of verification, we need to check the remaining documents.</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[URL_VERIFI]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">Check status</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(14, 'Your account is verified', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">The verification status is changed</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Status of your account - Verified!</strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						Documents are successfully verified. Your account were assigned the Verified status. You can now withdraw funds from the account.</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[URL_VERIFI]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">Check status</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]<br />\r\n						&nbsp;</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(15, 'Business status', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">The verification status is changed</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Status of your account - Business!</strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						Documents are successfully verified. Your account &nbsp;were assigned the Business status. Now you can accept external payments.</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[URL_VERIFI]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">Check status</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]<br />\r\n						&nbsp;</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->');
INSERT INTO `email_templates` (`id`, `title`, `message`) VALUES
(16, 'Documents rejected', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">The verification status is changed</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #F44336;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #F44336;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Document failed verification</strong></p>\r\n						</td>\r\n						<td style=\"background: #F44336;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						We are sorry, the document that were uploaded is rejected. Read carefully the verification rules and try again. If you have any questions write to customer support.</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[URL_VERIFI]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">Check status</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]<br />\r\n						&nbsp;</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(18, 'Request payment', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<!-- 100% body table -->\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td><!-- header -->\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">Request payment</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			<!--// header --><!-- main wrapper -->\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\"><!-- logo -->\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<!--// logo --><!-- Красный блок -->\r\n					<tr>\r\n						<td style=\"background: #7867a7;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #7867a7;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Create invoice [INV]</strong></p>\r\n						</td>\r\n						<td style=\"background: #7867a7;\">&nbsp;</td>\r\n					</tr>\r\n					<!--// Красный блок --><!-- welcome message -->\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						You have a new invoice for payment. Carefully read the details and make payment.</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<!--// welcome message --><!-- таблица с договором и суммой -->\r\n					<tr>\r\n						<td height=\"10\" style=\"border-top: 1px solid #e7e1bd; background: #fff9d4;\">&nbsp;</td>\r\n						<td height=\"10\" style=\"border-top: 1px solid #e7e1bd; background: #fff9d4;\">&nbsp;</td>\r\n						<td height=\"10\" style=\"border-top: 1px solid #e7e1bd; background: #fff9d4;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td bgcolor=\"#fff9d4\">&nbsp;</td>\r\n						<td bgcolor=\"#fff9d4\">\r\n						<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n							<tbody>\r\n								<tr>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd;\" width=\"200\">\r\n									<p style=\"font: 15px/20px Helvetica, Arial, sans-serif; color: #888a84; margin: 1em 0;\">Date created</p>\r\n									</td>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd; content: \'\';\" width=\"20\">&nbsp;</td>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd;\" width=\"200\">\r\n									<p style=\"font: 15px/20px Helvetica, Arial, sans-serif; color: #303030; margin: 1em 0;\">[DATE]</p>\r\n									</td>\r\n								</tr>\r\n								<tr>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd;\" width=\"200\">\r\n									<p style=\"font: 15px/20px Helvetica, Arial, sans-serif; color: #888a84; margin: 1em 0;\">Username sender</p>\r\n									</td>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd; content: \'\';\" width=\"20\">&nbsp;</td>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd;\" width=\"200\">\r\n									<p style=\"font: 15px/20px Helvetica, Arial, sans-serif; color: #303030; margin: 1em 0;\">[SENDER]</p>\r\n									</td>\r\n								</tr>\r\n								<tr>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd;\" width=\"200\">\r\n									<p style=\"font: 15px/20px Helvetica, Arial, sans-serif; color: #888a84; margin: 1em 0;\">Purpose of payment</p>\r\n									</td>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd; content: \'\';\" width=\"20\">&nbsp;</td>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd;\" width=\"200\">\r\n									<p style=\"font: 15px/20px Helvetica, Arial, sans-serif; color: #303030; margin: 1em 0;\">[PURPOSE]</p>\r\n									</td>\r\n								</tr>\r\n								<tr>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd;\" width=\"200\">\r\n									<p style=\"font: 15px/20px Helvetica, Arial, sans-serif; color: #888a84; margin: 1em 0;\">Amount</p>\r\n									</td>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd; content: \'\';\" width=\"20\">&nbsp;</td>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd;\" width=\"200\">\r\n									<p style=\"font: 15px/20px Helvetica, Arial, sans-serif; color: #303030; margin: 1em 0;\"><strong>[AMOUNT]</strong></p>\r\n									</td>\r\n								</tr>\r\n								<tr>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd;\" width=\"200\">\r\n									<p style=\"font: 15px/20px Helvetica, Arial, sans-serif; color: #888a84; margin: 1em 0;\">Currency</p>\r\n									</td>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd; content: \'\';\" width=\"20\">&nbsp;</td>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd;\" width=\"200\">\r\n									<p style=\"font: 15px/20px Helvetica, Arial, sans-serif; color: #303030; margin: 1em 0;\">[CYR]</p>\r\n									</td>\r\n								</tr>\r\n								<tr>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd;\" width=\"200\">\r\n									<p style=\"font: 15px/20px Helvetica, Arial, sans-serif; color: #888a84; margin: 1em 0;\">Note for recipient</p>\r\n									</td>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd; content: \'\';\" width=\"20\">&nbsp;</td>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd;\" width=\"200\">\r\n									<p style=\"font: 15px/20px Helvetica, Arial, sans-serif; color: #303030; margin: 1em 0;\">[NOTE]</p>\r\n									</td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n						<td bgcolor=\"#fff9d4\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td height=\"10\" style=\"border-top: 1px solid #e7e1bd;\">&nbsp;</td>\r\n						<td height=\"10\" style=\"border-top: 1px solid #e7e1bd;\">&nbsp;</td>\r\n						<td height=\"10\" style=\"border-top: 1px solid #e7e1bd;\">&nbsp;</td>\r\n					</tr>\r\n					<!--// таблица с договором и суммой --><!-- блок страшилка -->\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #wwwwww; border-bottom: 1px solid #wwwwww;\">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #wwwwww; border-bottom: 1px solid #wwwwww;\">\r\n						<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n							<tbody>\r\n								<tr>\r\n									<td align=\"left\" valign=\"top\" width=\"95\">\r\n									<p style=\"margin: 25px 0;\"><a href=\"#\" style=\"text-decoration: none;\" target=\"_blank\"><img alt=\"\" height=\"40\" src=\"http://static.tcsbank.ru/email/2014small/warning_11_11.png\" style=\"display: block; margin: 20px 0 20px 0;\" /> </a></p>\r\n									</td>\r\n									<td width=\"500\">\r\n									<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 10px 0;\">Do not transfer money to strangers - they can be scammers! Notify in support if you think it is spam.</p>\r\n									</td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #wwwwww; border-bottom: 1px solid #wwwwww;\">&nbsp;</td>\r\n					</tr>\r\n					<!--// блок страшилка --><!-- button промо с2с -->\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[LINK]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7ab55c; border-radius: 4px;\" target=\"_blank\">Go to account</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n					<!--// button промо с2с -->\r\n				</tbody>\r\n			</table>\r\n			<!--// main wrapper --><!-- footer -->\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]<br />\r\n						&nbsp;</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			<!--// footer --></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table -->\r\n\r\n<div style=\"display:none; white-space:nowrap; font:14px courier; line-height:0;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>\r\n'),
(17, 'Claim satisfied', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">The dispute status is changed!</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Claim satisfied! </strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hellow!<br />\r\n						<br />\r\n						After a thorough analysis of the evidence provided in the dispute [ID_DISPUTE], we completed the investigation and decided in favor of the sender of payment. Money was returned by transaction ID [ID_TRANSACTION].</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[URL_DISPUTE][ID_DISPUTE]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">Go to the site</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]<br />\r\n						&nbsp;</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(22, 'Success money transfer', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">The transaction status is changed!</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Success money transfer! </strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						You have successfully transferred [SUM] [CYR]&nbsp;to the user [RECEIVER].&nbsp;You can see the details in your account.</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[URL_HISTORY]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">Operations history</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(19, 'Merchant activated!', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">The merchant&nbsp;status is changed!</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Merchant activated! </strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						Your application for creating merchant ID [ID_MERCHANT] is satisfied!&nbsp;Now you can accept payments via SCI.</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[URL_MERCHANT]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">All merchants</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]<br />\r\n						&nbsp;</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(20, 'Merchant rejected', '&lt;meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"&gt;\r\n&lt;title&gt;&lt;/title&gt;\r\n&lt;style type=\"text/css\"&gt;a:hover { text-decoration: underline !important; }\r\n\r\n  @media only screen and (min-width: 640px) {\r\n     *[class].wrapper { width: 480px !important; }\r\n     *[class].wrapper__indent { width: 60px !important; }\r\n  }\r\n&lt;/style&gt;\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" xss=removed width=\"100%\">\r\n <tbody>\r\n  <tr>\r\n   <td>\r\n   <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" xss=removed width=\"100%\">\r\n    <tbody>\r\n     <tr>\r\n      <td align=\"center\" height=\"45\" valign=\"middle\">\r\n      <p xss=removed>The status of merchant has changed!</p>\r\n      </td>\r\n     </tr>\r\n    </tbody>\r\n   </table>\r\n\r\n   <table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" xss=removed width=\"480\">\r\n    <tbody>\r\n     <tr>\r\n      <td class=\"wrapper__indent\" xss=removed width=\"30\"> </td>\r\n      <td align=\"center\" height=\"70\" xss=removed valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" xss=removed width=\"58\"> </a></td>\r\n      <td class=\"wrapper__indent\" xss=removed width=\"30\"> </td>\r\n     </tr>\r\n     <tr>\r\n      <td xss=removed> </td>\r\n      <td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" xss=removed>\r\n      <p xss=removed><strong>Account Declined!</strong></p>\r\n      </td>\r\n      <td xss=removed> </td>\r\n     </tr>\r\n     <tr>\r\n      <td> </td>\r\n      <td>\r\n      <p xss=removed>Hello!<br>\r\n      <br>\r\n      Your application for creating merchant ID  [ID_MERCHANT] has been declined. Please contact our underwriting department for further details.</p>\r\n      </td>\r\n      <td> </td>\r\n     </tr>\r\n     <tr>\r\n      <td xss=removed> </td>\r\n      <td xss=removed>\r\n      <p align=\"center\" xss=removed><a alias=\"button\" href=\"[URL_MERCHANT]\" xss=removed target=\"_blank\">All merchants</a></p>\r\n      </td>\r\n      <td xss=removed> </td>\r\n     </tr>\r\n    </tbody>\r\n   </table>\r\n\r\n   <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" xss=removed width=\"100%\">\r\n    <tbody>\r\n     <tr>\r\n      <td align=\"center\" height=\"45\" valign=\"middle\">\r\n      <p xss=removed>Have a questions? Contact our <a href=\"https://support.everpayinc.com\">Support</a>.<br>\r\n      [SITE_NAME]</p>\r\n      </td>\r\n     </tr>\r\n    </tbody>\r\n   </table>\r\n   </td>\r\n  </tr>\r\n </tbody>\r\n</table>\r\n&lt;!--// 100% body table --&gt;&lt;!--suc_mail6 --&gt;'),
(21, 'New ticket!', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">The ticket status is changed!</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>New ticket! </strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						You have received a new request from the support team.&nbsp;We await your response!</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[URL_TICKET]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">All tickets</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]<br />\r\n						&nbsp;</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(23, 'Confirm account', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">Account registration</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Confirm account!</strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						Thank you for creating an account at [SITE_NAME]. Click the link below to validate your email address and activate your account.</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[CHECK_LINK]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">Confirm email</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(24, 'Reset password', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">Account registration</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Reset password!</strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						Your password at [SITE_NAME] has been reset. Click the link below to log in with your new password.</p>\r\n\r\n						<p style=\"color: #303030; font: 18px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\"><strong>[PASSWORD]</strong></p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[LOGIN_LINK]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">My account</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(25, 'Withdrawal is confirmed', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">The transaction status is changed!</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Withdrawal is confirmed! </strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						The withdrawal of funds in the amount of [SUM] [CYR] was confirmed by the administrator.</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[URL_HISTORY]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">Operations history</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(26, 'Withdrawal of funds denied', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">The transaction status is changed!</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #F44336;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #F44336;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Withdrawal of funds denied! </strong></p>\r\n						</td>\r\n						<td style=\"background: #F44336;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						The withdrawal of funds in the amount of [SUM] [CYR] was rejected by the administrator. Funds refund to your account.</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[URL_HISTORY]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">Operations history</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(27, 'Make payment', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">New invoice</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Make payment</strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 0 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						Created an invoice for [SUM_USD] [CYR]. To pay the bill transfer [SUM_BTC] BTC to the purse:<br />\r\n						<br />\r\n						<strong>[ADRESS]</strong>.</p>\r\n\r\n						<center><img src=\"https://chart.googleapis.com/chart?chs=300x300&amp;cht=qr&amp;chl=bitcoin:[ADRESS]\" /></center>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->');

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int(11) UNSIGNED NOT NULL,
  `card_check` int(11) NOT NULL,
  `card_fee` varchar(128) NOT NULL,
  `pp_check` int(11) NOT NULL,
  `pp_fee` varchar(128) NOT NULL,
  `btc_check` int(11) NOT NULL,
  `btc_fee` varchar(128) NOT NULL,
  `adv_check` int(11) NOT NULL,
  `adv_fee` varchar(128) NOT NULL,
  `wm_check` int(11) NOT NULL,
  `wm_fee` varchar(128) NOT NULL,
  `payeer_check` int(11) NOT NULL,
  `payeer_fee` varchar(128) NOT NULL,
  `qiwi_check` int(11) NOT NULL,
  `qiwi_fee` varchar(128) NOT NULL,
  `perfect_check` int(11) NOT NULL,
  `perfect_fee` varchar(128) NOT NULL,
  `swift_fee` varchar(128) NOT NULL,
  `swift_check` int(11) NOT NULL,
  `check_pp_dep` int(11) NOT NULL,
  `fee_pp_dep` varchar(128) NOT NULL,
  `account_pp` varchar(256) NOT NULL,
  `check_payeer_dep` int(11) NOT NULL,
  `fee_payeer_dep` varchar(128) NOT NULL,
  `merch_payeer` varchar(128) NOT NULL,
  `key_payeer` varchar(128) NOT NULL,
  `crypt_payeer` varchar(128) NOT NULL,
  `check_adv_dep` int(11) NOT NULL,
  `fee_adv_dep` varchar(128) NOT NULL,
  `account_adv` varchar(128) NOT NULL,
  `name_adv` varchar(128) NOT NULL,
  `secret_adv` varchar(128) NOT NULL,
  `check_perfect` int(11) NOT NULL,
  `fee_perfect` varchar(128) NOT NULL,
  `account_perfect` varchar(128) NOT NULL,
  `check_btc_dep` int(11) NOT NULL,
  `shop_btc` varchar(128) NOT NULL,
  `pass_btc` varchar(128) NOT NULL,
  `fee_btc_dep` varchar(128) NOT NULL,
  `key_perfect` varchar(128) NOT NULL,
  `swift_dep_check` int(11) NOT NULL,
  `fee_swift_dep` varchar(128) NOT NULL,
  `swift_desc` text NOT NULL,
  `check_pp_sci` int(11) NOT NULL,
  `fee_pp_sci` varchar(128) NOT NULL,
  `account_pp_sci` varchar(128) NOT NULL,
  `check_payeer_sci` int(11) NOT NULL,
  `fee_payeer_sci` varchar(128) NOT NULL,
  `merch_payeer_sci` varchar(128) NOT NULL,
  `key_payeer_sci` varchar(128) NOT NULL,
  `crypt_payeer_sci` varchar(128) NOT NULL,
  `check_adv_sci` int(11) NOT NULL,
  `fee_adv_sci` varchar(128) NOT NULL,
  `account_adv_sci` varchar(128) NOT NULL,
  `name_adv_sci` varchar(128) NOT NULL,
  `secret_adv_sci` varchar(128) NOT NULL,
  `check_perfect_sci` int(11) NOT NULL,
  `fee_perfect_sci` varchar(128) NOT NULL,
  `account_perfect_sci` varchar(128) NOT NULL,
  `key_perfect_sci` varchar(128) NOT NULL,
  `check_btc_sci` int(11) NOT NULL,
  `fee_btc_sci` varchar(128) NOT NULL,
  `shop_btc_sci` varchar(128) NOT NULL,
  `pass_btc_sci` varchar(128) NOT NULL,
  `swift_sci_check` int(11) NOT NULL,
  `fee_swift_sci` varchar(128) NOT NULL,
  `swift_desc_sci` text NOT NULL,
  `ux_check` int(11) NOT NULL,
  `fee_ux` varchar(128) NOT NULL,
  `xpub` varchar(250) NOT NULL,
  `sci_xpub` varchar(500) NOT NULL,
  `fee_pay_fix` decimal(10,2) NOT NULL,
  `fee_adv_fix` decimal(10,2) NOT NULL,
  `fee_perf_fix` decimal(10,2) NOT NULL,
  `fee_btc_fix` decimal(10,2) NOT NULL,
  `fee_swift_fix` decimal(10,2) NOT NULL,
  `sci_pp_fee_fix` decimal(10,2) NOT NULL,
  `sci_pay_fee_fix` decimal(10,2) NOT NULL,
  `sci_adv_fix` decimal(10,2) NOT NULL,
  `sci_per_fee_fix` decimal(10,2) NOT NULL,
  `sci_btc_fee_fix` decimal(10,2) NOT NULL,
  `sci_swift_fee_fix` decimal(10,2) NOT NULL,
  `ux_fee_fix` decimal(10,2) NOT NULL,
  `fee_pp_fix_dep` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `card_check`, `card_fee`, `pp_check`, `pp_fee`, `btc_check`, `btc_fee`, `adv_check`, `adv_fee`, `wm_check`, `wm_fee`, `payeer_check`, `payeer_fee`, `qiwi_check`, `qiwi_fee`, `perfect_check`, `perfect_fee`, `swift_fee`, `swift_check`, `check_pp_dep`, `fee_pp_dep`, `account_pp`, `check_payeer_dep`, `fee_payeer_dep`, `merch_payeer`, `key_payeer`, `crypt_payeer`, `check_adv_dep`, `fee_adv_dep`, `account_adv`, `name_adv`, `secret_adv`, `check_perfect`, `fee_perfect`, `account_perfect`, `check_btc_dep`, `shop_btc`, `pass_btc`, `fee_btc_dep`, `key_perfect`, `swift_dep_check`, `fee_swift_dep`, `swift_desc`, `check_pp_sci`, `fee_pp_sci`, `account_pp_sci`, `check_payeer_sci`, `fee_payeer_sci`, `merch_payeer_sci`, `key_payeer_sci`, `crypt_payeer_sci`, `check_adv_sci`, `fee_adv_sci`, `account_adv_sci`, `name_adv_sci`, `secret_adv_sci`, `check_perfect_sci`, `fee_perfect_sci`, `account_perfect_sci`, `key_perfect_sci`, `check_btc_sci`, `fee_btc_sci`, `shop_btc_sci`, `pass_btc_sci`, `swift_sci_check`, `fee_swift_sci`, `swift_desc_sci`, `ux_check`, `fee_ux`, `xpub`, `sci_xpub`, `fee_pay_fix`, `fee_adv_fix`, `fee_perf_fix`, `fee_btc_fix`, `fee_swift_fix`, `sci_pp_fee_fix`, `sci_pay_fee_fix`, `sci_adv_fix`, `sci_per_fee_fix`, `sci_btc_fee_fix`, `sci_swift_fee_fix`, `ux_fee_fix`, `fee_pp_fix_dep`) VALUES
(1, 1, '5', 1, '50', 1, '3', 1, '3', 1, '3', 1, '3', 1, '3', 1, '3', '8', 1, 1, '1', 'justwalletpw@yandex.ru', 1, '1', '364478513', '123', '123', 1, '1', '', '', '', 1, '1', '', 1, '', '', '10', '', 1, '1', '<p><strong>Bank Name:</strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; First Century Bank<br />\r\n<strong>Routing (ABA):</strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;061120084<br />\r\n<strong>Account Number:&nbsp;</strong>&nbsp; &nbsp; 4012556950739<br />\r\n<strong>Account Type:</strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;CHECKING<br />\r\n<strong>Beneficiary Name:</strong>&nbsp;&nbsp; &nbsp;Just Wallet LLC</p>\r\n', 1, '10', 'justwalletpw@yandex.u', 1, '1', '', '', '', 1, '0', '', '', '', 1, '1', '', '', 1, '0', '', '', 1, '1', '', 1, '1', '', '', '12.00', '8.00', '0.00', '0.50', '500.00', '1.00', '2.00', '0.00', '4.00', '0.00', '6.00', '7.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `ip` varchar(20) NOT NULL,
  `attempt` datetime NOT NULL,
  `user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`ip`, `attempt`, `user`) VALUES
('177.237.147.107', '2018-06-14 12:33:10', '');

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip` varchar(100) NOT NULL,
  `date` varchar(300) NOT NULL,
  `event` text NOT NULL,
  `user` varchar(258) NOT NULL,
  `device` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`id`, `ip`, `date`, `event`, `user`, `device`) VALUES
(6, '177.237.151.234', '2018-01-29 06:52:49', '1', 'admin', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(7, '177.237.151.234', '2018-01-29 08:57:48', '1', 'admin', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(8, '177.237.151.234', '2018-01-29 10:41:26', '1', 'admin', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(9, '177.237.151.234', '2018-01-29 19:10:42', '1', 'admin', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(10, '177.237.151.234', '2018-01-29 21:17:09', '1', 'elektropay.commerce@gmail.com', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(11, '177.237.183.84', '2018-01-30 02:10:56', '1', 'elektropay.commerce@gmail.com', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(12, '177.237.151.234', '2018-01-31 22:06:49', '1', 'elektropay.commerce@gmail.com', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(13, '177.237.151.234', '2018-02-01 18:57:47', '1', 'elektropay.commerce@gmail.com', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(14, '177.237.152.170', '2018-03-01 15:14:18', '1', 'admin', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/604.5.6 (KHTML, like Gecko) Version/11.0.3 Safari/604.5.6'),
(15, '179.42.232.51', '2018-03-17 03:56:31', '1', 'elektropay.commerce@gmail.com', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.162 Safari/537.36'),
(16, '177.237.128.106', '2018-03-29 16:58:51', '1', 'elektropay.commerce@gmail.com', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(17, '177.237.128.106', '2018-03-29 17:01:59', '1', 'elektropay.commerce@gmail.com', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(18, '177.237.128.106', '2018-03-29 18:47:43', '1', 'admin', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(19, '177.237.128.106', '2018-03-30 15:24:12', '1', 'elektropay.commerce@gmail.com', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(20, '177.237.128.106', '2018-03-30 22:37:33', '1', 'everpay@gmail.com', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(21, '177.237.128.106', '2018-03-31 18:55:33', '1', 'elektropay.commerce@gmail.com', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(22, '177.237.128.106', '2018-04-02 06:09:31', '1', 'elektropay.commerce@gmail.com', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(23, '177.237.128.106', '2018-04-02 07:23:21', '1', 'elektropay.commerce@gmail.com', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(24, '177.237.128.106', '2018-04-03 04:51:49', '1', 'elektropay.commerce@gmail.com', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(25, '177.237.128.106', '2018-04-03 04:53:03', '1', 'elektropay.commerce@gmail.com', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(26, '177.237.128.106', '2018-04-03 05:30:54', '1', 'admin', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(27, '177.237.128.106', '2018-04-04 20:12:52', '1', 'elektropay.commerce@gmail.com', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(28, '177.237.133.106', '2018-04-18 16:06:58', '1', 'admin', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(29, '177.237.133.106', '2018-04-19 19:51:15', '1', 'admin', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_3) AppleWebKit/604.5.6 (KHTML, like Gecko) Version/11.0.3 Safari/604.5.6'),
(30, '177.237.133.106', '2018-04-19 20:03:15', '1', 'admin', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_3) AppleWebKit/604.5.6 (KHTML, like Gecko) Version/11.0.3 Safari/604.5.6'),
(31, '177.237.133.106', '2018-04-19 20:05:07', '1', 'admin', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_3) AppleWebKit/604.5.6 (KHTML, like Gecko) Version/11.0.3 Safari/604.5.6'),
(32, '177.237.133.106', '2018-04-19 20:38:19', '1', 'everpay', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_3) AppleWebKit/604.5.6 (KHTML, like Gecko) Version/11.0.3 Safari/604.5.6'),
(33, '103.78.239.71', '2018-04-20 00:08:19', '1', 'admin', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(34, '::1', '2018-06-08 01:58:06', '1', 'bhutvishal8@gmail.com', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.79 Safari/537.36'),
(35, '::1', '2018-06-08 01:59:42', '1', 'bhutvishal8@gmail.com', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.79 Safari/537.36'),
(36, '192.168.0.116', '2018-06-08 02:09:40', '1', 'test123@gmail.com', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36'),
(37, '::1', '2018-06-08 02:11:19', '1', 'bhutvishal8@gmail.com', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.79 Safari/537.36'),
(38, '::1', '2018-06-08 02:18:13', '1', 'bhutvishal8@gmail.com', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.79 Safari/537.36'),
(39, '::1', '2018-06-08 02:19:57', '1', 'bhutvishal8@gmail.com', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.79 Safari/537.36'),
(40, '::1', '2018-06-08 02:20:15', '1', 'bhutvishal8@gmail.com', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.79 Safari/537.36'),
(41, '::1', '2018-06-08 02:54:13', '1', 'bhutvishal8@gmail.com', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.79 Safari/537.36'),
(42, '::1', '2018-06-08 03:07:04', '1', 'bhutvishal8@gmail.com', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.79 Safari/537.36'),
(43, '::1', '2018-06-08 03:41:37', '1', 'bhutvishal8@gmail.com', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.79 Safari/537.36'),
(44, '::1', '2018-06-08 03:53:35', '1', 'bhutvishal8@gmail.com', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.79 Safari/537.36'),
(45, '::1', '2018-06-08 03:57:38', '1', 'bhutvishal8@gmail.com', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.79 Safari/537.36'),
(46, '::1', '2018-06-08 04:03:04', '1', 'bhutvishal8@gmail.com', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.79 Safari/537.36'),
(47, '::1', '2018-06-08 04:04:48', '1', 'bhutvishal8@gmail.com', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.79 Safari/537.36'),
(48, '::1', '2018-06-08 04:07:25', '1', 'bhutvishal8@gmail.com', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.79 Safari/537.36'),
(49, '::1', '2018-06-08 04:30:54', '1', 'bhutvishal8@gmail.com', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.79 Safari/537.36'),
(50, '::1', '2018-06-08 04:31:09', '1', 'bhutvishal8@gmail.com', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.79 Safari/537.36'),
(51, '::1', '2018-06-08 04:32:42', '1', 'bhutvishal8@gmail.com', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.79 Safari/537.36'),
(52, '43.241.146.168', '2018-06-09 03:27:49', '1', 'bhutvishal8@gmail.com', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.79 Safari/537.36'),
(53, '43.241.146.85', '2018-06-13 10:11:18', '1', 'qwe', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36'),
(54, '43.241.146.85', '2018-06-13 10:14:00', '1', 'Chirag', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36');

-- --------------------------------------------------------

--
-- Table structure for table `merchants`
--

CREATE TABLE `merchants` (
  `id` int(10) UNSIGNED NOT NULL,
  `link` varchar(258) NOT NULL,
  `password` varchar(258) NOT NULL,
  `status` enum('1','2','3') NOT NULL,
  `name` text NOT NULL,
  `user` varchar(256) NOT NULL,
  `comment` text NOT NULL,
  `status_link` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(128) NOT NULL,
  `input_type` enum('input','textarea','radio','dropdown','timezones','file') CHARACTER SET latin1 NOT NULL,
  `options` text COMMENT 'Use for radio and dropdown: key|value on each line',
  `is_numeric` enum('0','1') NOT NULL DEFAULT '0' COMMENT 'forces numeric keypad on mobile devices',
  `show_editor` enum('0','1') NOT NULL DEFAULT '0',
  `input_size` enum('large','medium','small') DEFAULT NULL,
  `translate` enum('0','1') NOT NULL DEFAULT '0',
  `help_text` varchar(256) DEFAULT NULL,
  `validation` varchar(128) NOT NULL,
  `sort_order` tinyint(3) UNSIGNED NOT NULL,
  `label` varchar(128) NOT NULL,
  `value` text COMMENT 'If translate is 1, just start with your default language',
  `last_update` datetime DEFAULT NULL,
  `updated_by` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `input_type`, `options`, `is_numeric`, `show_editor`, `input_size`, `translate`, `help_text`, `validation`, `sort_order`, `label`, `value`, `last_update`, `updated_by`) VALUES
(1, 'site_name', 'input', NULL, '0', '0', 'large', '0', NULL, 'required|trim|min_length[3]|max_length[128]', 10, 'Site Name', 'Everpay', '2018-03-29 18:50:00', 1),
(2, 'per_page_limit', 'dropdown', '10|10\r\n25|25\r\n50|50\r\n75|75\r\n100|100', '1', '0', 'medium', '0', NULL, 'required|trim|numeric', 50, 'Items Per Page', '10', '2018-03-29 18:50:00', 1),
(3, 'meta_keywords', 'input', NULL, '0', '0', 'large', '0', 'Comma-seperated list of site keywords', 'trim', 20, 'Meta Keywords', 'Borderless Payments', '2018-03-29 18:50:00', 1),
(4, 'meta_description', 'textarea', NULL, '0', '0', 'large', '0', 'Short description describing your site.', 'trim', 30, 'Meta Description', '', '2018-03-29 18:50:00', 1),
(5, 'site_email', 'input', NULL, '0', '0', 'medium', '0', 'Email address all emails will be sent from.', 'required|trim|valid_email', 40, 'Site Email', 'no-reply@everpayinc.com', '2018-03-29 18:50:00', 1),
(6, 'timezones', 'timezones', NULL, '0', '0', 'medium', '0', NULL, 'required|trim', 60, 'Timezone', 'UM4', '2018-03-29 18:50:00', 1),
(8, 'copyright', 'input', NULL, '0', '0', 'medium', '0', '', 'trim', 80, 'Copyright', '2018 Everpay', '2018-03-29 18:50:00', 1),
(10, 'full_upload', 'input', NULL, '0', '0', 'medium', '0', NULL, '', 100, 'Upload full', 'public_html/entity/consumer', '2018-03-29 18:50:00', 1),
(11, 'upload_path', 'input', NULL, '0', '0', 'medium', '0', NULL, '', 110, 'Upload path', 'docbank', '2018-03-29 18:50:00', 1),
(12, 'twilio_sid', 'input', NULL, '0', '0', 'medium', '0', NULL, '', 120, 'Twilio SID', 'AC847296b2397241fa83893435f764d3d1', '2018-03-29 18:50:00', 1),
(13, 'twilio_token', 'input', NULL, '0', '0', 'medium', '0', NULL, '', 130, 'Twilio token', '26fd7222c5ee092fa88137e5f167daf3', '2018-03-29 18:50:00', 1),
(14, 'twilio_number', 'input', NULL, '0', '0', 'medium', '0', NULL, '', 140, 'Twilio number', '438-795-0379', '2018-03-29 18:50:00', 1),
(15, 'com_transfer', 'input', NULL, '0', '0', 'medium', '0', NULL, 'required', 150, 'Fee money transfer, %', '3', '2018-03-29 18:50:00', 1),
(16, 'site_phone', 'input', NULL, '0', '0', 'medium', '0', NULL, 'numeric', 160, 'Site phone', '18005666003', '2018-03-29 18:50:00', 1),
(18, 'site_skype', 'input', NULL, '0', '0', 'medium', '0', NULL, '', 170, 'Site Skype', 'everpay', '2018-03-29 18:50:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sms_template`
--

CREATE TABLE `sms_template` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `message` text NOT NULL,
  `enable` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms_template`
--

INSERT INTO `sms_template` (`id`, `title`, `message`, `enable`) VALUES
(1, 'Documents and account been verified', 'Documents was checked and your account is verified', 0),
(2, 'Documents rejected', 'Documents was rejected! ', 0),
(3, 'Documents confirmed', 'Documents was confirmed', 0),
(4, 'The business status assigned', 'The documents have been verified. Your account has been assigned a business status', 0),
(5, 'Tickets closed', 'One of the tickets was closed!', 0),
(6, 'New comment for the ticket', 'A new comment has been added to one of the tickets', 0),
(7, 'Claim be rejected!', 'The decision on the dispute was made. Claim be rejected!', 0),
(8, 'Claim is satisfied!', 'The decision on the dispute was made. Claim is satisfied!', 0),
(9, 'Claim is opened!', 'Attention! The dispute was transferred to the claim. The possibility of withdrawal is blocked', 0),
(11, 'New comment was add to dispute', 'A new comment has been added to the dispute', 0),
(12, 'Funds is received', 'The funds was received on your account  in the amount of [SUM] [CYR]', 0),
(13, 'Withdrawal is pending', 'The withdrawal, amount equal to [SUM] [CYR], were deducted from your account', 0),
(14, 'Currency exchange successfully completed', 'You successfully exchanged [SUM_1] [CYR_1] on [SUM_2] [CYR_2].', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `user` varchar(128) NOT NULL,
  `title` text CHARACTER SET ucs2 NOT NULL,
  `status` enum('1','2','3') NOT NULL,
  `comment` int(11) NOT NULL,
  `message` text NOT NULL,
  `comments` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tickets_comment`
--

CREATE TABLE `tickets_comment` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `id_ticket` int(10) NOT NULL,
  `user` varchar(128) NOT NULL,
  `role` enum('1','2') NOT NULL,
  `comment` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` enum('1','2','3','4','5') NOT NULL,
  `sum` decimal(10,2) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('1','2','3','4','5') NOT NULL,
  `sender` varchar(128) NOT NULL,
  `receiver` varchar(128) NOT NULL,
  `time` datetime NOT NULL,
  `user_comment` text NOT NULL,
  `admin_comment` text NOT NULL,
  `currency` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `type`, `sum`, `fee`, `amount`, `status`, `sender`, `receiver`, `time`, `user_comment`, `admin_comment`, `currency`) VALUES
(808, '1', '100.00', '0.00', '100.00', '2', 'system', 'elektropay', '2018-04-03 05:32:16', ' ', ' ', 'debit_base'),
(809, '1', '650.00', '0.00', '650.00', '2', 'system', 'everpay', '2018-04-19 20:13:44', ' test deposit', ' hi i funded your account', 'debit_base');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `email` varchar(256) NOT NULL,
  `language` varchar(64) DEFAULT NULL,
  `is_admin` int(11) NOT NULL DEFAULT '0',
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `deleted` enum('0','1') NOT NULL DEFAULT '0',
  `validation_code` varchar(50) DEFAULT NULL COMMENT 'Temporary code for opt-in registration',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `verifi_status` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `fraud_status` enum('0','1','2') NOT NULL DEFAULT '0',
  `debit_base` decimal(10,2) NOT NULL DEFAULT '0.00',
  `debit_extra1` decimal(10,2) NOT NULL DEFAULT '0.00',
  `debit_extra2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `debit_extra3` decimal(10,2) NOT NULL DEFAULT '0.00',
  `debit_extra4` decimal(10,2) NOT NULL DEFAULT '0.00',
  `debit_extra5` decimal(10,2) NOT NULL DEFAULT '0.00',
  `phone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `first_name`, `last_name`, `email`, `language`, `is_admin`, `status`, `deleted`, `validation_code`, `created`, `updated`, `verifi_status`, `fraud_status`, `debit_base`, `debit_extra1`, `debit_extra2`, `debit_extra3`, `debit_extra4`, `debit_extra5`, `phone`) VALUES
(1, 'admin', '216ff6d2712355a5120b166f08a95c1e34269ac510731cd81a5221ec3312735b661da4975480591e30aef37d98a4394d52ffb77d9a4ab0983de0f8bdb35ee114', '497374abaa718e67ed8dda5b92c8c22894f7752ce111236e612a6a42b5e78c4a5fa42226ca67ca9e31bd732ae92084670b4a4bda18f19795c7779412585a8cf3', 'Richard', 'Rowe', 'everpay@gmail.com', 'english', 1, '1', '0', NULL, '2013-01-01 00:00:00', '2018-01-29 06:56:35', '2', '0', '96.67', '5672.65', '4737.50', '4990.00', '4160.00', '5000.00', '18005666003'),
(30, 'elektropay', 'b7c567574b254b97378e67e96ea4a67cd42530499dbbf55d8a49f6eeccd946d6d160f9c16c59c73ba1b9a846ffd7346c6ce32ba328e1228e2efebf35527b8f39', '488a3da0e9456ddd3bba2320050a62b3bffd8fd5f24427e23eb142219f8f880467335e9ace3fd8e3310582cfc1551264e29423f16ba5034e810fc4bdf9bd513f', 'Ricardo', 'Rodriguezze', 'elektropay.commerce@gmail.com', 'english', 0, '1', '0', NULL, '2018-01-29 05:34:21', '2018-04-03 05:31:36', '1', '0', '100.00', '0.00', '0.00', '0.00', '0.00', '0.00', '19994703727'),
(31, 'everpay', '0e71f156aa62bc931cfc0cdb28700d3458af8b035d9f8e8bd2961725b1245c72d2545515ef313fc52ee87341b8726e65f2f334e72f519248a724bb7eabad0f52', '52e00d85277b3947325ebf9bda5850747d1690782291a631edd0ee2a3266a1920db87450e6eeb56c61e790e2cd9459156d3303821c14ef9ee185498ab7ffe37b', 'Richie', 'St Joseph', 'richard.r@everpayinc.com', 'english', 0, '1', '0', NULL, '2018-04-19 20:08:18', '2018-04-19 20:08:18', '2', '0', '650.00', '0.00', '0.00', '0.00', '0.00', '0.00', ''),
(34, 'sal', 'c48a45f40d26d181d80a1019efb7e86fd64c45797ab7239c4294d2acef6e0ef2cd16ca357df7e5d59dde2b5c218f747eec1c04a076d65e247f1743afaa47df20', '9897a42fcc554c6a6f1781765242f6235ec3b200bf5de83cd982cd85f54b430fd889e27f6fd8e1ee0394e39252750ca9f1f954db6ff6ab70beeed4d684559073', 'Sal', 'Hernandez', 'sal@everpayinc.com', 'english', 0, '1', '0', NULL, '2018-06-12 13:13:34', '0000-00-00 00:00:00', '1', '0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '529994703727'),
(71, '123456', '444c4c844ae055b4f1b61f589ad9851d069440794f5654a6dca3ada1745ab3cffd0d5718e97049ecd7a43f8f2acb459ccf413494d06c9d4552cc09f974c314a0', 'd653d1229380f549b5f78a5afdb069291ca2fa6367c859fab5ebe6bde0dcb2cce6b2f31b291172ae77d3beeec6026d109f2f05a84dc336ce6da0239a62678890', 'Vishal', 'Bhut', 'bhutvishal8@gmail.com', 'english', 0, '1', '0', NULL, '2018-06-16 01:34:44', '0000-00-00 00:00:00', '1', '0', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '69859658967');

-- --------------------------------------------------------

--
-- Table structure for table `users_business`
--

CREATE TABLE `users_business` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `business_name` varchar(255) NOT NULL,
  `business_type` varchar(255) NOT NULL,
  `business_phone` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `business_address` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `sdate` datetime NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_business`
--

INSERT INTO `users_business` (`id`, `users_id`, `business_name`, `business_type`, `business_phone`, `website`, `business_address`, `postal_code`, `country`, `city`, `state`, `sdate`, `created`, `updated`) VALUES
(13, 71, 'V', 'private_corporation', '1236547890', 'v', 'v', 'v', 'v', 'v', 'v', '2018-06-16 20:18:00', '2018-06-16 01:34:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users_processing`
--

CREATE TABLE `users_processing` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `industry` varchar(255) NOT NULL,
  `subscriptions` varchar(255) NOT NULL,
  `refund_policy` varchar(255) NOT NULL,
  `braintree` varchar(255) NOT NULL,
  `annual` varchar(255) NOT NULL,
  `average` varchar(255) NOT NULL,
  `largest` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_processing`
--

INSERT INTO `users_processing` (`id`, `users_id`, `industry`, `subscriptions`, `refund_policy`, `braintree`, `annual`, `average`, `largest`, `created`, `updated`) VALUES
(13, 71, 'generic_retail', 'yes', 'refund_cardholder', 'on', 'v', 'v', 'v', '2018-06-16 01:34:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `verification`
--

CREATE TABLE `verification` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` varchar(128) NOT NULL,
  `type` enum('1','2','3') NOT NULL,
  `img` varchar(1000) NOT NULL,
  `status` enum('1','2','3') NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(500) CHARACTER SET utf8 NOT NULL,
  `date_creature` datetime NOT NULL,
  `creator` text CHARACTER SET utf8 NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(128) CHARACTER SET utf8 NOT NULL,
  `date_activation` datetime NOT NULL,
  `activator` varchar(128) CHARACTER SET utf8 NOT NULL,
  `status` enum('1','2') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `btc_order`
--
ALTER TABLE `btc_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `captcha`
--
ALTER TABLE `captcha`
  ADD PRIMARY KEY (`captcha_id`),
  ADD KEY `word` (`word`);

--
-- Indexes for table `currencys`
--
ALTER TABLE `currencys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disputes`
--
ALTER TABLE `disputes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disputes_comment`
--
ALTER TABLE `disputes_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `title` (`title`),
  ADD KEY `created` (`created`),
  ADD KEY `read` (`read`),
  ADD KEY `read_by` (`read_by`),
  ADD KEY `email` (`email`(78));

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD KEY `ip` (`ip`);

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchants`
--
ALTER TABLE `merchants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `sms_template`
--
ALTER TABLE `sms_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets_comment`
--
ALTER TABLE `tickets_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users_business`
--
ALTER TABLE `users_business`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_processing`
--
ALTER TABLE `users_processing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verification`
--
ALTER TABLE `verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `btc_order`
--
ALTER TABLE `btc_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `captcha`
--
ALTER TABLE `captcha`
  MODIFY `captcha_id` bigint(13) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `currencys`
--
ALTER TABLE `currencys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `disputes`
--
ALTER TABLE `disputes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `disputes_comment`
--
ALTER TABLE `disputes_comment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `merchants`
--
ALTER TABLE `merchants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `sms_template`
--
ALTER TABLE `sms_template`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `tickets_comment`
--
ALTER TABLE `tickets_comment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=810;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `users_business`
--
ALTER TABLE `users_business`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users_processing`
--
ALTER TABLE `users_processing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `verification`
--
ALTER TABLE `verification`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

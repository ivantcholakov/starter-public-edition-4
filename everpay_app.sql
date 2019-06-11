-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 14, 2018 at 12:44 AM
-- Server version: 5.6.39-83.1
-- PHP Version: 5.6.30

SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `everpay_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_pages`
--

CREATE TABLE `active_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `enabled` tinyint(1) NOT NULL
) ;

--
-- Dumping data for table `active_pages`
--

INSERT INTO `active_pages` (`id`, `name`, `enabled`) VALUES
(1, 'blog', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `iban` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `bic` varchar(255) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `time` int(10) UNSIGNED NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `blog_translations`
--

CREATE TABLE `blog_translations` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(10) UNSIGNED NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `browsers`
--

CREATE TABLE `browsers` (
  `domain_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `browser` varchar(6) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '1'
) ;

--
-- Dumping data for table `browsers`
--

INSERT INTO `browsers` (`domain_id`, `date`, `browser`, `count`) VALUES
(1, '2014-05-01', 'o', 1),
(1, '2014-05-01', 'chrome', 3),
(1, '2014-05-01', 'ff', 3),
(1, '2014-05-02', 'ff', 2),
(1, '2014-05-02', 'chrome', 1),
(1, '2014-05-02', 'o', 1),
(1, '2014-05-04', 'chrome', 1),
(1, '2014-05-04', 'safari', 2),
(1, '2014-05-04', 'ff', 3),
(1, '2014-05-05', 'chrome', 4),
(1, '2014-05-05', 'safari', 1),
(1, '2014-05-05', 'ff', 1),
(1, '2014-05-05', 'ie10', 1),
(1, '2014-05-06', 'chrome', 1),
(1, '2014-05-06', 'safari', 1),
(1, '2014-05-06', 'ff', 2),
(1, '2014-05-07', 'o', 1),
(1, '2014-05-07', 'safari', 1),
(1, '2014-05-07', 'chrome', 2),
(1, '2014-05-07', 'ff', 3),
(1, '2014-05-08', 'chrome', 2),
(1, '2014-05-08', 'ff', 1),
(1, '2014-05-09', 'ff', 2),
(1, '2014-05-09', 'chrome', 1),
(1, '2014-05-10', 'chrome', 1),
(1, '2014-05-10', 'ff', 1),
(1, '2014-05-11', 'chrome', 1),
(1, '2014-05-12', 'chrome', 4),
(1, '2014-05-12', 'ff', 1),
(1, '2014-05-13', 'chrome', 3),
(1, '2014-05-13', 'ff', 2),
(1, '2014-05-13', 'safari', 1),
(1, '2014-05-14', 'ff', 2),
(1, '2014-05-14', 'chrome', 1),
(1, '2014-05-15', 'chrome', 2),
(1, '2014-05-16', 'chrome', 2),
(1, '2014-05-16', 'ff', 1),
(1, '2014-05-16', 'x', 1),
(1, '2014-05-16', 'o', 1),
(1, '2014-05-17', 'safari', 1),
(1, '2014-05-17', 'ff', 2),
(1, '2014-05-17', 'chrome', 1),
(1, '2014-05-18', 'chrome', 2),
(1, '2014-05-18', 'ff', 2),
(1, '2014-05-18', 'safari', 1),
(1, '2014-05-19', 'ff', 3),
(1, '2014-05-19', 'chrome', 5),
(1, '2014-05-19', 'x', 4),
(1, '2014-05-19', 'safari', 1),
(1, '2014-05-20', 'chrome', 6),
(1, '2014-05-20', 'ff', 1),
(1, '2014-05-20', 'x', 1),
(1, '2014-05-21', 'chrome', 6),
(1, '2014-05-21', 'ff', 2),
(1, '2014-05-22', 'chrome', 6),
(1, '2014-05-22', 'ff', 3),
(1, '2014-05-22', 'safari', 2),
(1, '2014-05-22', 'x', 1),
(1, '2014-05-23', 'ff', 4),
(1, '2014-05-23', 'chrome', 4),
(1, '2014-05-23', 'safari', 1),
(1, '2014-05-24', 'safari', 1),
(1, '2014-05-25', 'safari', 1),
(1, '2014-05-26', 'ie10', 1),
(1, '2014-05-26', 'chrome', 1),
(1, '2014-05-27', 'chrome', 2),
(1, '2014-05-27', 'ff', 1),
(1, '2014-05-27', 'safari', 1),
(1, '2014-05-28', 'chrome', 1),
(1, '2014-05-29', 'chrome', 2),
(1, '2014-05-30', 'ie9', 1),
(1, '2014-06-01', 'ff', 1),
(1, '2014-06-02', 'chrome', 2),
(1, '2014-06-03', 'x', 1),
(1, '2014-06-03', 'chrome', 1),
(1, '2014-06-04', 'chrome', 2),
(1, '2014-06-04', 'ff', 2),
(1, '2014-06-05', 'chrome', 2),
(1, '2014-06-05', 'ff', 1),
(1, '2014-06-06', 'chrome', 2),
(1, '2014-06-06', 'ff', 1),
(1, '2014-06-07', 'ff', 1),
(1, '2014-06-08', 'chrome', 2),
(1, '2014-06-09', 'ff', 1),
(1, '2014-06-09', 'chrome', 1),
(1, '2014-06-11', 'chrome', 1),
(1, '2014-06-12', 'ff', 2),
(1, '2014-06-12', 'chrome', 1),
(1, '2014-06-13', 'chrome', 1),
(1, '2014-06-15', 'ff', 1),
(1, '2014-06-16', 'ff', 3),
(1, '2014-06-16', 'chrome', 2),
(1, '2014-06-17', 'chrome', 3),
(1, '2014-06-17', 'ie10', 1),
(1, '2014-06-17', 'ff', 1),
(1, '2014-06-18', 'ff', 2),
(1, '2014-06-18', 'chrome', 1),
(1, '2014-06-19', 'ff', 2),
(1, '2014-06-19', 'chrome', 1),
(1, '2014-06-19', 'safari', 1),
(1, '2014-06-20', 'ff', 2),
(1, '2014-06-20', 'chrome', 2),
(1, '2014-06-21', 'chrome', 1),
(1, '2014-06-21', 'ff', 1),
(1, '2014-06-22', 'ff', 1),
(1, '2014-06-22', 'chrome', 1),
(1, '2014-06-23', 'ff', 2),
(1, '2014-06-24', 'ff', 2),
(1, '2014-06-24', 'chrome', 3),
(1, '2014-06-25', 'ff', 4),
(1, '2014-06-25', 'chrome', 2),
(1, '2014-06-26', 'chrome', 3),
(1, '2014-06-26', 'ff', 3),
(1, '2014-06-26', 'ie10', 1),
(1, '2014-06-27', 'ff', 2),
(1, '2014-06-27', 'chrome', 3),
(1, '2014-06-28', 'chrome', 2),
(1, '2014-06-28', 'ff', 2),
(1, '2014-06-29', 'chrome', 2),
(1, '2014-06-29', 'ff', 1),
(1, '2014-06-30', 'ff', 4),
(1, '2014-06-30', 'chrome', 5),
(1, '2014-07-01', 'ff', 4),
(1, '2014-07-01', 'chrome', 3),
(1, '2014-07-02', 'ff', 1),
(1, '2014-07-02', 'chrome', 5),
(1, '2014-07-03', 'ff', 3),
(1, '2014-07-03', 'chrome', 5),
(1, '2014-07-04', 'x', 1),
(1, '2014-07-04', 'ff', 4),
(1, '2014-07-04', 'chrome', 3),
(1, '2014-07-05', 'chrome', 3),
(1, '2014-07-05', 'ff', 1),
(1, '2014-07-06', 'chrome', 5),
(1, '2014-07-06', 'ff', 2),
(1, '2014-07-07', 'chrome', 4),
(1, '2014-07-07', 'ff', 1),
(1, '2014-07-08', 'ff', 2),
(1, '2014-07-08', 'chrome', 2),
(1, '2014-07-08', 'safari', 1),
(1, '2014-07-09', 'ff', 2),
(1, '2014-07-09', 'chrome', 4),
(1, '2014-07-10', 'ff', 1),
(1, '2014-07-10', 'chrome', 4),
(1, '2014-07-10', 'safari', 1),
(1, '2014-07-11', 'ff', 1),
(1, '2014-07-11', 'chrome', 2),
(1, '2014-07-12', 'ff', 1),
(1, '2014-07-12', 'chrome', 1),
(1, '2014-07-13', 'chrome', 2),
(1, '2014-07-14', 'chrome', 1),
(1, '2014-07-15', 'chrome', 4),
(1, '2014-07-15', 'ff', 3),
(1, '2014-07-16', 'chrome', 2),
(1, '2014-07-17', 'chrome', 3),
(1, '2014-07-17', 'ff', 1),
(1, '2014-07-18', 'chrome', 3),
(1, '2014-07-19', 'chrome', 1),
(1, '2014-07-21', 'chrome', 6),
(1, '2014-07-22', 'chrome', 6),
(1, '2014-07-22', 'ff', 3),
(1, '2014-07-23', 'ff', 2),
(1, '2014-07-23', 'chrome', 5),
(1, '2014-07-24', 'ff', 1),
(1, '2014-07-24', 'safari', 1),
(1, '2014-07-24', 'chrome', 2),
(1, '2014-07-25', 'chrome', 4),
(1, '2014-07-26', 'ff', 1),
(1, '2014-07-26', 'chrome', 3),
(1, '2014-07-27', 'chrome', 2),
(1, '2014-07-27', 'ff', 1),
(1, '2014-07-28', 'chrome', 2),
(1, '2014-07-28', 'ff', 1),
(1, '2014-07-29', 'x', 2),
(1, '2014-07-29', 'chrome', 4),
(1, '2014-07-29', 'ff', 1),
(1, '2014-07-30', 'chrome', 2),
(1, '2014-07-31', 'chrome', 6),
(1, '2014-07-31', 'ff', 2),
(1, '2014-08-01', 'chrome', 2),
(1, '2014-08-01', 'ff', 1),
(1, '2014-08-02', 'chrome', 2),
(1, '2014-08-04', 'ff', 1),
(1, '2014-08-04', 'chrome', 2),
(1, '2014-08-05', 'chrome', 2);

-- --------------------------------------------------------

--
-- Table structure for table `btc_order`
--

CREATE TABLE `btc_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `adress` varchar(500) NOT NULL,
  `payeer` varchar(300) NOT NULL,
  `merchant` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `business_categories`
--

CREATE TABLE `business_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ;

--
-- Dumping data for table `business_categories`
--

INSERT INTO `business_categories` (`id`, `name`) VALUES
(1, 'Accountant'),
(2, 'CPA'),
(3, 'Bookkeepers'),
(4, 'Car Dealers'),
(5, 'Beauty Professionals'),
(6, 'Builders & Contractors'),
(7, 'Christian Church & Ministry'),
(8, 'Computer & Software Professionals'),
(9, 'Cruise, Travel & Vacation'),
(10, 'Dentist'),
(11, 'Engineer'),
(12, 'Retail store'),
(13, 'Whole sale industries'),
(14, 'Petshop'),
(15, 'Executives'),
(16, 'Food & Restaurant'),
(17, 'Finance & Money Professionals'),
(18, 'Hauling'),
(19, 'Fitness Centers & Gym'),
(20, 'Moving'),
(21, 'Trucking'),
(22, 'Health & Wellness Professionals'),
(23, 'Hotel & Motel'),
(24, 'HR Professionals'),
(25, 'Insurance Agents & Brokers'),
(26, 'Interior Decorator & Designer'),
(27, 'IT Computer Professionals'),
(28, 'Jewelers'),
(29, 'k-12 Teachers'),
(30, 'Marketing Executives'),
(31, 'Mortgage Brokers'),
(32, 'Bankers'),
(33, 'Pharmacy'),
(34, 'Physician'),
(35, 'Real Estate Agents'),
(36, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `date` date NOT NULL,
  `data` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE `captcha` (
  `captcha_id` bigint(13) UNSIGNED NOT NULL,
  `captcha_time` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL
) ;

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
(59, 1528530974, '43.241.146.168', 'hLzw6'),
(60, 1530659517, '66.249.65.145', '0gBZ4'),
(61, 1530721695, '35.233.76.144', 'qSC1n'),
(62, 1531017943, '23.237.4.26', 'Ds88M'),
(63, 1531710443, '23.237.4.26', 'KOIT8'),
(64, 1531762618, '41.59.81.116', 'FG2ex'),
(65, 1532128900, '123.125.71.50', 'Lx0JP'),
(66, 1532233802, '123.125.71.109', '6KQCy'),
(67, 1532357146, '77.88.47.9', 'JTQEQ'),
(68, 1532699678, '23.237.4.26', 'HNQ77'),
(69, 1532966734, '71.127.222.133', '5bXOz'),
(70, 1533318681, '35.240.82.22', 'zMPRh'),
(71, 1533465780, '52.10.182.183', '4G3zm'),
(72, 1533507303, '66.249.65.149', 'Vm0oS'),
(73, 1533681090, '40.77.167.69', 'cZyFR'),
(74, 1533692927, '66.249.65.109', 'BJyLj'),
(75, 1533807300, '54.67.72.204', 'N1nbn'),
(76, 1533807312, '54.67.72.204', 'SijHy');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `code` varchar(55) NOT NULL,
  `name` varchar(55) NOT NULL
) ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `code`, `name`) VALUES
(1, 'C1', 'Category 1');

-- --------------------------------------------------------

--
-- Table structure for table `ci_cookies`
--

CREATE TABLE `ci_cookies` (
  `id` int(11) NOT NULL,
  `cookie_id` varchar(255) DEFAULT NULL,
  `netid` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `orig_page_requested` varchar(120) DEFAULT NULL,
  `php_session_id` varchar(40) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('1afa9c3aae6942f9294b4493e928c3b9', '66.249.65.84', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 1523113655, ''),
('0561a4769d3c989c3509e95659bf234a', '157.55.39.136', 'Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)', 1523676199, ''),
('187d681be28c16c056a28a0c30035908', '40.77.167.20', 'Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)', 1523632382, ''),
('cdc36ec98040054037cd3ff4beccddbb', '207.46.13.26', 'Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)', 1523579060, ''),
('7cc9a5fa3a4a6ac8ca6aec01880cff98', '207.46.13.108', 'Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)', 1523535610, ''),
('d83787f44739e7edb69286c2b99beea4', '207.46.13.108', 'Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)', 1523484153, ''),
('8df4cc52bad2f16de4ab0e3c0656c751', '207.46.13.95', 'Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)', 1523383994, ''),
('427c61229f81303b3424a6ca0ae29e95', '207.46.13.95', 'Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)', 1523439432, ''),
('c3743375a966bcc3bb98147b77603545', '157.55.39.147', 'Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)', 1523287798, ''),
('11f4b5d3183b86cfce7aefc5628bc3b8', '66.249.65.86', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.96 Mob', 1523269667, ''),
('82c95d1d47221e9efb0899108d357ac2', '40.77.167.207', 'Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)', 1523236738, ''),
('74c5f0e0bd2294a2802caf251b6f5ebf', '157.55.39.139', 'Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)', 1523145675, '');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `merchant_id` varchar(100) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `bank_acc_name` varchar(100) NOT NULL,
  `bank_address` text NOT NULL,
  `bank_acc_number` varchar(100) NOT NULL,
  `bank_routing_number` varchar(100) NOT NULL,
  `bank_swift_number` varchar(100) NOT NULL,
  `bank_acc_type` varchar(100) NOT NULL,
  `bitcoin_address_name` varchar(250) NOT NULL,
  `bitcoin_address` varchar(250) NOT NULL,
  `bitcoin_settlement_percentage` int(11) NOT NULL,
  `is_non_us` tinyint(1) NOT NULL DEFAULT '0',
  `client_type_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL DEFAULT '1',
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `passport_number` varchar(50) DEFAULT NULL,
  `company` varchar(255) NOT NULL,
  `company_logo` varchar(120) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `address_2` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `country` int(3) NOT NULL,
  `gmt_offset` varchar(7) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `email_verified` int(11) NOT NULL DEFAULT '0',
  `email_code` varchar(255) NOT NULL,
  `email_code_expire` datetime NOT NULL,
  `parent_client_id` int(11) NOT NULL DEFAULT '0',
  `api_id` varchar(100) NOT NULL,
  `secret_key` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `default_gateway_id` int(11) NOT NULL,
  `suspended` int(11) NOT NULL DEFAULT '0',
  `deleted` int(11) NOT NULL DEFAULT '0',
  `two_step_verification` int(11) NOT NULL DEFAULT '0',
  `backup_codes` varchar(255) NOT NULL,
  `tax_id` varchar(100) NOT NULL,
  `business_start` varchar(100) NOT NULL,
  `business_type` int(11) NOT NULL,
  `business_number` varchar(50) NOT NULL,
  `business_category` int(11) NOT NULL,
  `business_address` text NOT NULL,
  `business_address2` varchar(250) NOT NULL,
  `business_city` varchar(100) NOT NULL,
  `business_zip` varchar(100) NOT NULL,
  `business_state` varchar(100) NOT NULL,
  `business_country` varchar(100) NOT NULL,
  `business_industry` varchar(250) NOT NULL,
  `business_phone` varchar(100) NOT NULL,
  `business_fax` varchar(100) NOT NULL,
  `business_url` varchar(255) NOT NULL,
  `business_monthly_vol` varchar(100) NOT NULL,
  `payment_types` varchar(255) NOT NULL,
  `credit_card` varchar(255) NOT NULL,
  `echeck` varchar(255) NOT NULL,
  `merchant_number` varchar(255) NOT NULL,
  `terminal_number` varchar(255) NOT NULL,
  `store_number` varchar(255) NOT NULL,
  `activation_code` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL,
  `created_date` datetime NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `unique_id`, `merchant_id`, `bank_name`, `bank_acc_name`, `bank_address`, `bank_acc_number`, `bank_routing_number`, `bank_swift_number`, `bank_acc_type`, `bitcoin_address_name`, `bitcoin_address`, `bitcoin_settlement_percentage`, `is_non_us`, `client_type_id`, `plan_id`, `first_name`, `last_name`, `passport_number`, `company`, `company_logo`, `address_1`, `address_2`, `city`, `state`, `postal_code`, `country`, `gmt_offset`, `phone`, `email`, `email_verified`, `email_code`, `email_code_expire`, `parent_client_id`, `api_id`, `secret_key`, `username`, `password`, `default_gateway_id`, `suspended`, `deleted`, `two_step_verification`, `backup_codes`, `tax_id`, `business_start`, `business_type`, `business_number`, `business_category`, `business_address`, `business_address2`, `business_city`, `business_zip`, `business_state`, `business_country`, `business_industry`, `business_phone`, `business_fax`, `business_url`, `business_monthly_vol`, `payment_types`, `credit_card`, `echeck`, `merchant_number`, `terminal_number`, `store_number`, `activation_code`, `is_active`, `created_date`, `user_id`, `status`) VALUES
(1000, '', '', 'Bank Of Montreal', 'Everpay Corporation', '179 D\'Anjou Blvd.', 'xO4LrkWNbozFbHx7QLCAxe4zqfJY6KOKC9uE4UlYRXsQ4WuU+kIKg59jFGz9DgRhP/LmKLIqGTKPB5DhcQOZbQ==', '1ohyIfZmPLQuZfoKw9xUXeEhs/sRWzkp98HI1bApZxhlqyNHmLrlDb3hAByPa1QZNfR2TOUEkWOWYOpe1E2MpQ==', 'BOMCATT', 'TRANSACTION', 'everpay@gmail.com', '16FoxFrJxB1bRrHiAXqVHnzxMEvYJu5WFK', 10, 1, 3, 5, 'Richard', 'Rowe', 'ROWR745522003', 'Everpay Corporation', 'a9b7ba70783b617e9998dc4dd82eb3c5.jpg', '150 GENDRON', '', 'chateauguay', 'QC', 'J6J 3G5', 124, 'UM5', '5146275240', 'everpay@gmail.com', 1, '', '0000-00-00 00:00:00', 1000, 'F1V0HIPPBZB94J4ZL89S', 'CRNJ2TKHSR0A18QHJYGEUPOCHXFSEHD3OIRMC37A', 'admin', 'db552ef031fcc6561939d9ff43b5ea30', 41, 0, 0, 0, '2272092,9312656,5335085,1777250,4655585,8933811', '0', '0', 0, '125689000A', 17, '150 Gendron', '#2', 'Chateauguay', 'J6J3G6', 'Quebec', 'CA', '', '800-566-6003', '866-357-6616', 'https://everpayinc.com', '0', '', '', '', '', '', '', '', '1', '2015-05-21 01:32:57', '', 1),
(1034, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 1, 1, 'Hemal', 'Sharma', NULL, 'Massive', '', '', '', '', '', '', 4, 'UM12', '', 'sharmahemal1@yahoo.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'hemal', 'd822f7d8e9077b261488348eac37606c', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '4c1b0094ba36307c850ab4eba94ebd05be90070e', '0', '2015-04-14 23:06:38', '', 0),
(1040, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 1, 1, 'Markus', 'Rolands', NULL, 'Advanced Marketing Media', '', '3690', '0', 'Laval', '', '', 124, 'UM12', '5857306239', 'invoices@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'mark.rolands', 'dd17b95d58ece092da1839360d7416b1', 0, 1, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '9f7cc1d990caf7130876e488c307dfadf13a7851', '0', '2015-04-18 19:04:34', '', 0),
(1036, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 2, 1, 'DJ', 'Philmar', NULL, 'Zoanga Commerce', '', '', '0', '', '', '', 4, 'UM12', '', 'zoanga.payments@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'zoanga', '1eda0bf65d82d3e0b0c4df5be8e17573', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'c29d4fc234b7df2b54ed2992a15fbbb9654ca9e6', '1', '2015-04-17 06:19:10', '', 0),
(1044, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 2, 1, 'Robert', 'Davies', NULL, 'softie toys', '', '', '0', '', '', '', 4, 'UM12', '', 'robbie.d@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'robbie.d', 'a2890baa40cb8ad6cb7a353eef808e22', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'b112cbff9c6e894093f97571295912612588d2fa', '0', '2015-04-20 19:22:43', '', 0),
(1046, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 1, 1, 'Joe', 'Freeman', NULL, 'Freeman Enterprises', '', '', '0', '', '', '', 4, 'UM12', '', 'joe.freeman@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'joefree', 'df0c337c136fe2f245ac5b927f272548', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '830515a82bbe9ce5a221dce960aeb9f770d28b55', '0', '2015-04-21 10:45:43', '', 0),
(1047, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 1, 1, 'Joe', 'Testes', NULL, 'DreamWaves, Technology Inc.', '', '', '0', '', '', '', 4, 'UM12', '', 'joe.test@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'joetest', '77053f9bf6990a690c2078cb1bf7683e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0f30b59cdbe3483b4d8f27bbb9c5da35d3579e0c', '0', '2015-04-21 10:57:26', '', 0),
(1054, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 1, 1, 'Shaun', 'LeClerc', NULL, 'Michele Marie and Companys LLC', '', '', '0', '', '', '', 4, 'UM12', '', 'info@michelemarieandcompanys.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'mmcony', 'b9d9ca1afa49d46b632d745ff1fe6bbe', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '8b98941d3ea44c762a0f4293d95a7329dc796092', '0', '2015-05-01 17:26:27', '', 0),
(1053, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Robert', 'Mooore', NULL, 'startup.com Inc.', '', '', NULL, '', '', '', 0, '', '', 'robert.moore@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'startup2015', '77053f9bf6990a690c2078cb1bf7683e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'c5a3a11a3147591e1439a2179bda9cd98051bd26', '0', '2015-04-27 13:43:40', '', 0),
(1055, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Ron', 'Ryder', NULL, 'Ron Ryder Movers', '', '', NULL, '', '', '', 0, '', '', 'ronnie@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'ronnie2015', 'df0c337c136fe2f245ac5b927f272548', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0bd4882dfb40d77746e42f131f0bddd88e5dd9c4', '0', '2015-05-07 16:51:38', '', 0),
(1056, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'ripa', 'khan', NULL, 'selft', '', '', NULL, '', '', '', 0, '', '', 'fakeid022@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'ripa_khan', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '86abd5ed00eb55bc1773239e577ed30e5c9cc576', '0', '2015-05-08 01:01:21', '', 0),
(1057, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 2, 1, 'Vishal', 'Patel', NULL, 'TheITWebCare', '', '', '0', '', '', '', 356, 'UM12', '', 'kathrotiya.vishal@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'vishalpatel', '6c3857d61d9332b40c75acfeecbc4eeb', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '5fbee6caa99b0ce132c0610168129c9a3414a46c', '0', '2015-05-09 07:05:26', '', 0),
(1058, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'testing', 'testing', NULL, 'Testing & Co.', '', '', NULL, '', '', '', 0, '', '', 'testing@test.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'testing', 'ac1c8d64fd23ae5a7eac5b7f7ffee1fa', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1053354bc94881fbe8d8df5d4f5f26050795649f', '0', '2015-05-10 08:52:19', '', 0),
(1059, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'enimia', 'valdivia', NULL, 'Los Angeles construction inc', '', '', NULL, '', '', '', 0, '', '', 'oren.r@doctor.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'losangeles177', '441037c2f4fabd3f5eb87bfebdfc6e85', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '9443c970c08691eec655babf3002c105f42f938a', '0', '2015-05-17 01:36:54', '', 0),
(1060, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Ted', 'Smith', NULL, 'Bala Yoga Studio', '', '', NULL, '', '', '', 0, '', '', 'tedwsmith@yahoo.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'tedwsmith', 'ac9888386a50d113bfd9a1c4b9870234', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0e0233bd0c7cacc8195f560a0c0984819ec3f8ed', '0', '2015-05-28 10:07:34', '', 0),
(1118, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Joe', 'Wayne', NULL, 'StreamMovies.com LLC.', '', '', NULL, '', '', '', 0, '', '', 'streaming@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'streammovies', '77053f9bf6990a690c2078cb1bf7683e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'aa37214a9e9cbb41ad837a4563afe4738e8fa114', '0', '2015-08-05 06:57:41', '', 0),
(1119, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Joe', 'Wayne', NULL, 'StreamMovies.com LLC.', '', '', NULL, '', '', '', 0, '', '', 'streaming@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'streammovies', '77053f9bf6990a690c2078cb1bf7683e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'f7d2d38898bbd3e8bca37461b1e1c8a385c18817', '0', '2015-08-05 06:59:29', '', 0),
(1062, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Kate', 'Winslow', NULL, 'Katecosmestics', '', '', NULL, '', '', '', 0, '', '', 'k.winslow@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '3QQ6RC9KTKEVJW5LN0K6', 'A5UYLM7H5TQX5LUOXYPE9TQ9JKIBLLLFOTYBRVPI', 'kcos', 'df0c337c136fe2f245ac5b927f272548', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'ada1e3269370a7167a857d8d1a39103a43c88324', '1', '2015-06-08 20:35:15', '', 0),
(1063, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'holly', 'rieger', NULL, 'hollys', '', '', NULL, '', '', '', 0, '', '', 'hollyivereiger4@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'heyllo55', '9c792b5c23c42ba440ad0f757570598f', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'cfb464d2f78d32459f857776913acf75a239b2a0', '1', '2015-06-09 20:27:18', '', 0),
(1064, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'angel', 'aguilar', NULL, 'japan auto parts', '', '', NULL, '', '', '', 0, '', '', 'japanautopartpr@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'japanautoparts', '162e3e33422bcf203d6b56ad9fd56ee8', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '11d3c9e598eba965bac7b41a3cf7c927a0a435ce', '1', '2015-06-15 20:34:38', '', 0),
(1065, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Gerald', 'Washington', NULL, 'Excel International', '', '', NULL, '', '', '', 0, '', '', 'washingtongerald83@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Gwashington12', '29527d95fc59689e4ff253fe07140b76', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '7e8bdaefb01e79e0ed75acec691c16fad00bae72', '1', '2015-06-20 01:04:54', '', 0),
(1066, '', '', 'Bank Of Montreal', 'JW Industries Inc.', '56 Anjou Bvld, chateaugauy, QC, J6J3G9, Canada', '66655444333', '010129892', 'BOMCATT', 'CHECKING', '', '', 0, 1, 0, 1, 'Johnne', 'Wayne', NULL, 'JW Industries Inc.', '43dd49b4fdb9bede653e94468ff8df1e.png', '186 MAIN STREEET', 'PO BOX NO 453', 'GIBRALTAR', 'QC', '00000', 124, 'UM12', '+639193398277', 'j.wayne@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'johnny64', '77053f9bf6990a690c2078cb1bf7683e', 0, 0, 0, 0, '', '0', '0', 0, '', 8, '121 2 westweeod rd.', '', 'montreal', 'H3W2J8', 'Quebec', '124', '', '877-555-6627', '866-444-2867', '0', '0', '', '', '', '', '', '', '165843430df31e4a68e45b64e0942ec0928a6d0c', '1', '2015-06-20 11:04:20', '', 0),
(1067, '', '', '', '', '', '', '', '', '', '', '', 0, 1, 0, 1, 'WB', 'Wall', NULL, 'FMCSA COMPLIANCE', '', '', NULL, '', '', '', 0, '', '', 'wallbwall@live.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'awallwilson', '17885c19fbcd624b409e9d4cdf202c54', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'b9384f74d9e069aefbbd669fb3640300db7294ca', '1', '2015-06-23 13:39:29', '', 0),
(1068, '', '', 'The Federal Bank ltd', 'JAZ INFOTECH', 'Kolkata, India', '16230200009129', '000000', 'FDRLINBBIBD', 'CHECKING', '', '', 0, 1, 2, 1, 'Danish', 'Aijaz', NULL, 'JAZ INFOTECH PVT LTD', '53adaf494dc89ef7196d73636eb2451b.', '17/2H/12 SMITH LANE', '0', 'Kolkata', 'WB', '700013', 356, 'UP55', '91-9748013323', 'danish@etechpro.net', 0, '', '0000-00-00 00:00:00', 1000, 'D9UNR9PN1IYCA8ZUYJ6Y', 'QDBK560C3I43ZELHRVJTUZRTYEV9OW49AGG5MKUQ', 'etechpro', '8948bad8f7de38b1cf51a4620b9379d5', 40, 0, 0, 0, '', '0', '0', 0, '', 8, '35 A BLACK BURN LANE', '', 'Kolkata', '700012', 'WB', '356', '', '91-9748013323', '91-9748013323', '0', '0', '', '', '', '', '', '', '', '0', '0000-00-00 00:00:00', '', 0),
(1069, '', '', '', '', '', '', '', '', 'CHECKING', '', '', 0, 0, 2, 1, 'Osman', 'Ali', NULL, 'Lashoz Ltd.', 'fc2c7c47b918d0c2d792a719dfb602ef.', '44 Emmock Woods Cresent', '0', 'Dundee', 'UK', 'DD4 9GA', 826, 'UTC', '0770211947', 'support@uskin-care.com', 0, '', '0000-00-00 00:00:00', 1000, 'VJJARFATRF15ESCB2M62', 'XB1DFDHKJU631P2SJ1I84U20ZY42O2YY2VTMJWSG', 'us-skincare', '23eed7669e7ebbc90a21abb609e40ef3', 0, 0, 0, 0, '', '0', '0', 0, '', 22, '44 Emmock Woods Crescent Dundee', '', 'UK', 'DD4 9GA', 'UK ', '826', '', '', '', '0', '0', '', '', '', '', '', '', '', '0', '0000-00-00 00:00:00', '', 0),
(1070, '', '', 'ICICI BANK UK PLC', 'BIZZBUSTER LTD', 'India', '76206767', 'ICICGB2L', 'GB14ICIC30012876206767', 'CHECKING', '', '', 0, 1, 2, 1, 'Anurag', 'Pratap', NULL, 'Bizzbusters Ltd.', 'dc58e3a306451c9d670adcd37004f48f.', 'A1/304, Purvanchal Heights', '0', 'Greater Noida', 'Greater Noida', '01306', 356, 'UP55', '919560965571', 'sales@bizzbusters.com', 0, '', '0000-00-00 00:00:00', 1000, 'XTPP393CHJY70M53DEZA', 'D1ELRODRGY7UQB8OK2316EXO5VGQ8TDV371POCWV', 'bizzbusters', '033dba85daec03951db589fee2699e08', 31, 0, 0, 0, '', '0', '0', 0, '', 8, '483 ', 'Green Lanes', 'LONDON', 'N134BS', 'LONDON', 'GB', '', '+919560695571', '+919560695571', 'www.complaintshandle.com', '0', '', '', '', '', '', '', '', '0', '0000-00-00 00:00:00', '', 0),
(1071, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 2, 1, 'Cheyenne', 'Payton', NULL, 'XjanksX', '', '', '0', '', '', '', 4, 'UM12', '', 'Payton1188@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Payton1188', '2c6d98b4bfd3f6fb1c1e67a38458f71b', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'dc5cd82a5a00ddb719cd20d802425eb553c5153a', '1', '2015-06-28 22:07:24', '', 0),
(1072, '', '', 'Bank Of Montreal', 'Everpay Corporation', '125 d\'anjou, Chateauguay', '000122', '22201718', 'BOFMCAT2', 'Everpay Corporation', '', '', 0, 0, 0, 1, '', '', NULL, '', '', '', NULL, '', '', '', 0, '', '', '', 0, '601a0a5a8f47603d14acc9f674c97b18207fbb0c', '2017-05-25 06:22:30', 0, '', '', '', 'bea2f9222a6d79fadd7f2a0bf6c24f64', 0, 0, 0, 0, '', '', '', 0, '', 0, '110 E Center St', '2053', 'Madison', 'SD', '57042', 'US', '', '+15146275240', '', 'http://www.memphora.com', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', 0),
(1073, '', '', 'Bank ABC', 'JITESH TUKADIYA', '123, abc street, xyz, India', '987456321012345', '12345678954', '123456', 'PERSONAL', 'jiteshtukadiya@gmail.com', 'thisisarandomnumberHIASDGASLDJKHASD', 10, 1, 1, 1, 'Jitesh', 'Tukadiya', NULL, 'Tukadiya', '', '', '0', '', '', '', 4, 'UM12', '', 'jiteshtukadiya@gmail.com', 1, '', '2015-10-18 03:05:34', 0, 'CNKDFIVOU35HMOM0PMM2', 'WMKPRDUE21LJMN1L4308YNWZEV86B6B813JO8WW5', 'jitesh', 'f64af1ce49d23607fe44bd987f6a7550', 30, 0, 0, 0, '', '', 'asdas', 0, '', 0, 'HARSHA KRUPA', 'PANCHAVATI SOC NR POPAT NIVAS', 'PORBANDAR', '360575', 'GUJARAT', 'IN', 'asdasd', '09876543210', '', 'http://jitesh.tukadiya.com', '', '', '', '', '', '', '', '3f105c12de6680ad7cbd68edda770ec64e726d35', '0', '2015-07-01 06:01:34', '', 0),
(1079, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Joh Dee', 'Riley', NULL, 'JohDee Dubs Inc', '', '', NULL, '', '', '', 0, '', '', 'joh.riley@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, 'EFKJ3CH8F5HGGQ1EN0T6', 'D9ZZ5K7790EUHEWMD36UUL52MPGJ0M1G4KM2LE35', 'johdee74', '77053f9bf6990a690c2078cb1bf7683e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '34da1c604bfc3944018d9a67e15c20011689de8b', '1', '2015-07-02 03:25:21', '', 0),
(1080, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'VIJAYSINH', 'Rathod', NULL, 'Hyvikk', '', '', NULL, '', '', '', 0, '', '', 'r.vijay@hyvikk.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'vijay99rathod', '1048a5d40968bdf9c05193f13309197d', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '585704e8bc185a952057f7f5b837fb6cd22fbd30', '1', '2015-07-02 08:20:11', '', 0),
(1081, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'VIJAYSINH', 'RATHOD', NULL, 'Hyvikk', '', '', NULL, '', '', '', 0, '', '', 'rajan@hyvikk.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'vijay123445', '7876058a19539963bdf9adab97dc8ab5', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '5a60f8aaeaeae96f1f2a745cbaff4d38b2bb108f', '0', '2015-07-02 08:34:52', '', 0),
(1082, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Tester', 'two', NULL, 'Everpay Test Org', '', '', NULL, '', '', '', 0, '', '', 'tester2@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Tester2', '77053f9bf6990a690c2078cb1bf7683e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'a5ac03d444f9114f36a3a1fc8e0c262c15aea469', '1', '2015-07-03 01:10:59', '', 0),
(1083, '', '', 'Royal Bank Of Canada', 'Justice 4 All LLC', '150 Gendron, Chateaugauy, QC, Canada', '5349990000126262', '000000', 'RBC1CAM2', 'CHECKING', 'everpay@gmail.com', '16FoxFrJxB1bRrHiAXqVHnzxMEvYJu5WFK', 100, 0, 2, 1, 'Justice', 'Mcfly', NULL, 'Justice For All LLC', '', '', '0', '', '', '', 4, 'UM12', '', 'justice@everpayinc.com', 1, '', '2015-07-11 07:35:51', 0, '', '', 'justice2015', '77053f9bf6990a690c2078cb1bf7683e', 0, 0, 0, 0, '', '', '', 0, '', 0, 'GENDRON', '150', 'Chateaugauy', 'J6J3G6', 'QC', 'CA', '', '855-777-2222', '', 'The Elektropay Corporation', '', '', '', '', '', '', '', 'fd8405c3a8a66b2ec711da3a6f08e941b23afd52', '1', '2015-07-05 08:58:12', '', 1),
(1101, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 2, 1, 'Demo', 'Last', NULL, 'Demo Widgets Limited', '', '', '', 'Demo City', 'AL', '01020', 840, 'UM5', '5142226666', 'demo.account@everpayinc.com', 0, '', '0000-00-00 00:00:00', 1000, 'QCF1Q3JMB4FK9C3CK7GV', 'YG6UKTDVTVPLOEEPFI6XZQJMQ99ZIQWL9AUZV0EJ', 'demo', 'e763ed5bf39faabfb3e8fd7ea1d83262', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0000-00-00 00:00:00', '', 0),
(1085, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 2, 1, 'Satish', 'Pillai', NULL, 'Benefits Club LLC', '', '3422 SW 15th St Ste 7040', '0', 'Deerfield Beach', 'FL', '33442', 840, 'UM5', '954-246-0147', 'satish.pillai@marketential.com', 0, '', '0000-00-00 00:00:00', 1000, '53R9JTW5YFUG23MY7KWF', 'M1L2K848LF6Y4BO9AIRPXHE77OOH47ZMG0JULVP6', 'marketential', '80a5b98c1048c12bcfd3bfcde383413e', 33, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0000-00-00 00:00:00', '', 0),
(1112, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Ron', 'Smiley', NULL, 'Smiley For Smiles Ltd', '', '', NULL, '', '', '', 0, '', '', 'ron.smiley@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'rsmiley@everpayinc.com', '77053f9bf6990a690c2078cb1bf7683e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1aeda7da9b064f069ee8af6f3ad371680a257311', '0', '2015-08-05 06:41:44', '', 0),
(1111, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Joe', 'Washington', NULL, 'P3 Technologies', '', '', NULL, '', '', '', 0, '', '', 'joe.w@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'p3tech', '77053f9bf6990a690c2078cb1bf7683e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '73550869c22f1664d4dc8f4ad160b3fa287dadab', '0', '2015-08-05 05:34:34', '', 0),
(1115, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Joe', 'Wayne', NULL, 'StreamMovies.com LLC.', '', '', NULL, '', '', '', 0, '', '', 'streaming@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'streammovies', '77053f9bf6990a690c2078cb1bf7683e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '4fc4c921496416c3d2a2f306c942a8c9c8ab8fb5', '0', '2015-08-05 06:49:45', '', 0),
(1114, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 1, 1, 'Joe', 'Wayne', NULL, 'StreamMovies.com LLC.', '', '', '', '', '', '', 4, 'UM12', '', 'streaming@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'streammovies', 'c6f56a26062633a9d6a010561ab70e46', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '6b367366d4bdd163a67325d01066887f40bd37ca', '0', '2015-08-05 06:47:22', '', 0),
(1108, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Tung', 'Chow', NULL, 'Tungsten Systems Inc.', '', '', NULL, '', '', '', 0, '', '', 'tungsten@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'tungsten', 'cf78c6be401896ea12e4dff3da91bdf9', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1e3b214721288a5bceaad8f6384a6c47abe4f7fa', '0', '2015-07-29 21:24:13', '', 0),
(1107, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Tung', 'Chow', NULL, 'Tungsten Systems Inc.', '', '', NULL, '', '', '', 0, '', '', 'tungsten@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'tungsten', 'cf78c6be401896ea12e4dff3da91bdf9', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'b9abc74dabaa377fc46a1b4587ebf59c9ea95c9a', '0', '2015-07-29 21:20:59', '', 0),
(1117, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Joe', 'Wayne', NULL, 'StreamMovies.com LLC.', '', '', NULL, '', '', '', 0, '', '', 'streaming@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'streammovies', '77053f9bf6990a690c2078cb1bf7683e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '6e853dccaa8d97a5798f1c4a84a173e897cafc45', '0', '2015-08-05 06:56:15', '', 0),
(1116, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Joe', 'Wayne', NULL, 'StreamMovies.com LLC.', '', '', NULL, '', '', '', 0, '', '', 'streaming@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'streammovies', '77053f9bf6990a690c2078cb1bf7683e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '07e5e55e3e5b7f50dea61aec7c2d54deff542d07', '0', '2015-08-05 06:52:04', '', 0),
(1104, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Ren Ren Shaw', '', NULL, '', '', '', NULL, '', '', '', 0, '', '', 'ren.ren@elektropay.io', 0, '', '0000-00-00 00:00:00', 0, '', '', '', '77053f9bf6990a690c2078cb1bf7683e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'd2b5886a0015ade27e7836b4274212b714b4fadf', '0', '2015-07-29 01:13:13', '', 0),
(1098, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 1, 1, 'Greg ', 'McNeil', NULL, 'CanPayments Inc.', '', '', '', '', 'QC', '', 124, 'UM5', '5142981168', 'admin@canpayments.ca', 0, '', '0000-00-00 00:00:00', 1000, '86ZR4OGAE5XSN9WX5M5E', '3X9WK8JLMORS3L2N6Q0HFL1UBQA6B9FRT67G17BE', 'canpayments', '20e4bb11440e938601c245b67bcbd28f', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0000-00-00 00:00:00', '', 0),
(1099, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 2, 1, 'Randall', 'Tyson', NULL, '3780 KILROY AIRPORT WAY SUITE 200 LONG BEACH, CA 90806', '', '3780 KILROY AIRPORT WAY', 'SUITE 200', 'LONG BEACH', 'AL', '90806', 840, 'UM5', '(949) 229-1651', 'sureinvestments@cox.net', 0, '', '0000-00-00 00:00:00', 1098, 'QVC4THFW1BLIUZAJM707', 'CTICO32L7KEQMXHV3JI6IZ628YS32TPFSLAH6IBY', 'eztvplan', 'f5776522b79688722ad4f2d2776aa671', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0000-00-00 00:00:00', '', 0),
(1113, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Joe', 'Wayne', NULL, 'StreamMovies.com LLC.', '', '', NULL, '', '', '', 0, '', '', 'streaming@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'streammovies', '77053f9bf6990a690c2078cb1bf7683e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'aecc0a2feda1ac5a5d02129e3051ffbf216e978e', '0', '2015-08-05 06:44:29', '', 0),
(1120, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Joe', 'Wayne', NULL, 'StreamMovies.com LLC.', '', '', NULL, '', '', '', 0, '', '', 'streaming@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'streammovies', '77053f9bf6990a690c2078cb1bf7683e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'c46a25fbbf1585c8f8fdbc932dcb9c936e2de2fd', '0', '2015-08-05 07:00:05', '', 0),
(1121, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Joe', 'Wayne', NULL, 'StreamMovies.com LLC.', '', '', NULL, '', '', '', 0, '', '', 'streaming@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'streammovies', '77053f9bf6990a690c2078cb1bf7683e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '635a9659f89db6c8ee636b17e598412ebdc0976f', '0', '2015-08-05 07:00:54', '', 0),
(1122, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Joe', 'Wayne', NULL, 'StreamMovies.com LLC.', '', '', NULL, '', '', '', 0, '', '', 'streaming@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'streammovies', '77053f9bf6990a690c2078cb1bf7683e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '9e9983a6c750b1c0c833c32f00dab933d01c9f40', '0', '2015-08-05 07:02:46', '', 0),
(1123, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Joe', 'Wayne', NULL, 'StreamMovies.com LLC.', '', '', NULL, '', '', '', 0, '', '', 'streaming@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'streammovies', '77053f9bf6990a690c2078cb1bf7683e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'cb8dbc79f04210702012e07a7ea256c38f031178', '0', '2015-08-05 07:03:44', '', 0),
(1124, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Joe', 'Wayne', NULL, 'StreamMovies.com LLC.', '', '', NULL, '', '', '', 0, '', '', 'streaming@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'streammovies', '77053f9bf6990a690c2078cb1bf7683e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'e9fd0e6a7818231dd6c1c40f018592f129bdc2d0', '0', '2015-08-05 07:04:37', '', 0),
(1125, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Joe', 'Wayne', NULL, 'StreamMovies.com LLC.', '', '', NULL, '', '', '', 0, '', '', 'streaming@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'streammovies', '77053f9bf6990a690c2078cb1bf7683e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'aca27acf55c61b30447e23686d28edddcca76368', '0', '2015-08-05 07:05:07', '', 0),
(1126, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Joe', 'Wayne', NULL, 'StreamMovies.com LLC.', '', '', NULL, '', '', '', 0, '', '', 'streaming@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'streammovies', '77053f9bf6990a690c2078cb1bf7683e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '8e37e52ea5ca911498dd5c3a9e5d5f68fb7ba49c', '0', '2015-08-05 07:34:17', '', 0),
(1127, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 2, 1, 'Alex', 'Fleyshmakher', NULL, 'FMG Capital LLC', '', '1733 Sheepshead Bay Road', 'Suite 25', 'Brooklyn', 'NY', '11235', 840, 'UM5', '917-520-7070', 'alex@fmgcap.com', 0, '', '0000-00-00 00:00:00', 1000, '5PAEIJQLNZ6JUWR0ZRGV', '7N2FB5NQSTPRQPY7J4F2DOD3AVYXR5FZNJ6FSX18', 'fmgcapital', '8f9835ca4338670e4da1fcdeed39acd3', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0000-00-00 00:00:00', '', 0),
(1129, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Marc', 'Owens', NULL, 'Edna Ellis Inc.', '', '', NULL, '', '', '', 0, '', '', 'erjajvupip@fake.bugbuster.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'kinef', '77053f9bf6990a690c2078cb1bf7683e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '07cee693fe7ac41e6cc54f08c33237dd4e8addc9', '0', '2015-08-06 07:56:10', '', 0),
(1130, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Hemal', 'Sharma', NULL, 'Hemal', '', '', NULL, '', '', '', 0, '', '', 'sharmahemal8111@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'sharmahemal', '20fc79943d7d524c27acbdf46b6e505f', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '677f614f87009ded9a506dab2ccefa3a9b482e60', '1', '2015-08-06 11:30:40', '', 0),
(1131, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, '', '', NULL, '', '', '', NULL, '', '', '', 0, '', '', '', 0, '', '0000-00-00 00:00:00', 0, '', '', '', 'bea2f9222a6d79fadd7f2a0bf6c24f64', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '174f4e5f4ef5d2b4f247f72d3714fab2a553945a', '0', '2015-08-13 14:44:22', '', 0),
(1132, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, '', '', NULL, '', '', '', NULL, '', '', '', 0, '', '', '', 0, '', '0000-00-00 00:00:00', 0, '', '', '', 'bea2f9222a6d79fadd7f2a0bf6c24f64', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '44fa156744180f9e6486c6a654177eaeeacd408a', '0', '2015-08-13 14:46:39', '', 0),
(1133, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'holly', 'rieger', NULL, 'hollys', '', '', NULL, '', '', '', 0, '', '', 'hollyivereiger14@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'heyllo50', '9c792b5c23c42ba440ad0f757570598f', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '64338599947a79c1c7a9df9c6ec76fb64d6e94cc', '0', '2015-08-23 21:10:20', '', 0),
(1134, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 1, 1, 'Rohan raj', 'Singh', NULL, 'Instant-US-Travel', '', '', '', '', '', '', 4, 'UM12', '', 'rohanraj_singh@yahoo.in', 0, '', '0000-00-00 00:00:00', 0, '', '', 'iamrohan', 'a62dc24bac50511f95d55cadd1968437', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '13f720a59a4eb92bf81ddf0c5e7768a8ae4f2764', '1', '2015-08-25 01:49:32', '', 0),
(1135, '', '', '', '', '', '/t88L6xf6bUrrE/19gVllsSJCUUsWtVUI1hGwXXnmTSYODUitoTi+ZRXnLvob+3YQBeYRdjS6IQNw4C2FXUUVA==', 'X+h5YGGhk6C44pDvRG3E4GIQ1AZsD0FiSfNVSLYcGGOYODUitoTi+ZRXnLvob+3YQBeYRdjS6IQNw4C2FXUUVA==', '', '', '', '', 0, 0, 0, 1, 'jose', 'de jesus', NULL, 'jc transportation', 'fd2c5e4680d9a01dba3aada5ece22270.', '', '', '', '', '', 4, 'UM12', '', 'juand@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'imercruz', '7fb980b72e47f8adc4db2e011c86fe26', 0, 0, 0, 0, '', '0', '0', 0, '', 0, '', '', '', '', '', '', '', '', '', '0', '0', '', '', '', '', '', '', '6849e28e4a5efac95d483c7a1ff703e56ee7b9d3', '1', '2015-08-31 16:33:36', '', 0),
(1136, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'JANEEN', 'MUHAMMAD', NULL, 'SQUARE CIRCLE MARKETING INC', '', '', NULL, '', '', '', 0, '', '', 'squarecircle19@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'MACKinfo12', '258189c2a12e3452f371fd50330b5c6b', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '7dee8a9620b008592b110e70e0761c8c782d7d2b', '1', '2015-09-02 10:24:28', '', 0),
(1137, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Sandeep kumar', 'mahato', NULL, 'SKI MANAGEMENT PVT LTD', '', '', NULL, '', '', '', 0, '', '', 'skimanagementpvtltd@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'skimanagement', 'bd6c4b8112f4d0d2e71db49e88a1d537', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'f9fd3b67273aa57bd59900e1082985c23c164a89', '1', '2015-09-02 11:10:37', '', 0),
(1138, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'NED', 'STEIN', NULL, 'SBM OFFSHORE USA', '', '', NULL, '', '', '', 0, '', '', 'n.stein@sbmimodoco.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'nedstein', '0552ed03d43062c60c16dde8239d3639', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'b700977700f384722be110ad0d2e9de97bdc3457', '1', '2015-09-02 12:32:08', '', 0),
(1139, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'devjyoti', 'mishra', NULL, 'sk seed', '', '', NULL, '', '', '', 0, '', '', 'dev_jyotimishra@yahoo.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'devjyoti', '139480cba0ef11c530119bb780798a5e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'afdb204443687c13c85366b0c0e9259fd8c1c134', '1', '2015-09-02 13:17:11', '', 0),
(1140, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'kevin', 'parker', NULL, 'snm manegement private limited', '', '', NULL, '', '', '', 0, '', '', 'kevinparker90@hotmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'kevin_99', '2a1f9f115ebc752000752b2d5fec7d21', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'cec1dcb34a8db603e493ad643e5cadcbac9dbc84', '1', '2015-09-02 13:41:36', '', 0),
(1141, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Richard', 'Schoeder', NULL, 'Richard Studios', '', '', NULL, '', '', '', 0, '', '', 'renrick46@ymail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'renrick46@ymail.com', 'c3a89942da68192eb9640b519841a412', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '04594ec8b6020d83fa46350f095b77d3097296a8', '1', '2015-09-03 18:03:04', '', 0),
(1142, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Mahaveer', 'Prasad', NULL, 'ACME Technologies', '', '', NULL, '', '', '', 0, '', '', 'global.solution1980@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'global.solution1980', '49f9ff3a98826af6cb10082688c8fba1', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '3bf33a8252aa96548139dc4a9f10aaa8e236a23d', '1', '2015-09-08 12:55:52', '', 0),
(1143, '', '', 'BANK OF INDIA', 'GEEK TWEAKS SOLUTION OPC PVT. LTD.', 'CLASSIC ENTERPRISES KHUNTI Road Ranchi 834003', '588220110000218', '834013031', 'BKIDINBBRMB', 'Current', '', '', 0, 0, 0, 1, 'Yaduvansh', 'Bhagat', NULL, 'Geek Tweaks Solutions Pvt. Ltd.', '', '', NULL, '', '', '', 0, '', '', 'geektweaks786@gmail.com', 1, '', '2015-12-01 06:05:10', 0, 'BON3YKQOAVC81GTLBK5N', 'FLU2IDT08VZZRFQDGEB56RPC15ZTL26B5APOOPDE', 'Geeks786', '3d5a2ff6fe1c06e5195f5e8a6bd06525', 42, 0, 0, 0, '', '', '', 0, '', 0, '2nd Floor ', 'Rana Kunj Gandhi Nagar Hinoo', 'Ranchi', 'JHARKHANDq', '834002', 'IN', '', '9523425728', '', 'www.ustechgeeks.net', '', '', '', '', '', '', '', '2dd1ab2768ba831c704c2bf452155d43c9df5d43', '1', '2015-09-12 10:14:43', '', 0),
(1144, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'shelby', 'Medley', NULL, 'Medley cleaning', '', '', NULL, '', '', '', 0, '', '', 'shelbymedley95@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'shelbymedley', 'c9b6b8ce64caa37610e01072e06fc1b0', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'fa1ac2794becf73c44361dea08bc4a8b3274334b', '0', '2015-09-21 15:15:20', '', 0),
(1145, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Raphael', 'Carrier', NULL, 'Raphael Carrier', '', '', NULL, '', '', '', 0, '', '', 'raphael.carrier@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'raph', '64ac1a0b4ce286246b9a9f109e3e4bf8', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '8c8840d02e7f1b86fefafd3e2538291a94d99761', '1', '2015-09-23 08:59:49', '', 0),
(1146, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Luis', 'Mejias', NULL, 'Dees Salon', '', '', NULL, '', '', '', 0, '', '', 'deessalon@hotmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'nunny', '37967bf425e6fa6ab4a99181ffc080a7', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '20b33d48c989ace202966357ef16e4594c2b05f9', '1', '2015-09-24 09:28:57', '', 0),
(1147, '', '', 'ICICI BANK LTD', 'AMIT MONDAL', '56 R.B.C ROAD NAIHATI', 'hfThbBeA1jI10Bfk0LKfemvHVz9OVMfdVg8bOwMRz34wcL31AZNGCBhOMHHG7FVs68Uwba6eMUBtbVg6z0f2NA==', 'CWvITXlqSLoB/kXmSWlajoBl250yS/MbcqCXjDbQFB+YODUitoTi+ZRXnLvob+3YQBeYRdjS6IQNw4C2FXUUVA==', 'ICICINBBXXX', 'PERSONAL', '', '', 0, 1, 0, 1, 'AMIT', 'MONDAL', NULL, 'TINGE LEVY', 'a1d50185e7426cbb0acad1e6ca74b9aa.', '61/B NABANAGAR HALISAHAR', 'BALIAGHATA BIJPUR', 'NORTH 24 PARGANAS', '', '743136', 356, 'UM12', '9674889736', 'tingelevy@icloud.com', 1, '', '2015-10-16 12:53:01', 0, 'C1VIRVU1YNIVMSOI41Z9', '8X0EXWK5IYSRLMOCS7U1FN1YHESQB0SX33OBB207', 'tingelevy', '9180b37b9cc61d0cd59b7a3e519ca3fc', 0, 0, 0, 0, '', '0', '0', 0, '', 12, '58/7 ', 'WEST RABINDRA NAGAR', 'KOLKATA', '700065', 'WEST BENGAL', 'IN', '', '8885022882', '', 'https://www.tingelevy.com', '0', '', '', '', '', '', '', '1021a1e78fa02f8bae75584b424960864948f087', '1', '2015-09-29 15:03:58', '', 0),
(1148, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Shekhar', 'Chhabra', NULL, 'TAS', '', '', NULL, '', '', '', 0, '', '', 'wises81@yahoo.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'wises81', '0e5ad130fe9f71c54578123226fc2be8', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'c30e8d9dad6c69e5fb658f189a60692ab5f4b858', '0', '2015-10-01 10:57:56', '', 0),
(1149, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Anup', 'Verma', NULL, 'D-Mantra Infosul Pvt. Ltd.', '', '', NULL, '', '', '', 0, '', '', 'vanup@ymail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'vanup2410', '466e542c3868d2ed998d8d51cbe5dc6e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'c2ae7f4c13bdab164623d2d19f634dcc268fe738', '1', '2015-10-07 15:07:34', '', 0),
(1150, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'JOSE', 'RODRIGUEZ', NULL, 'MedDrug OHS', '', '', NULL, '', '', '', 0, '', '', 'jrrodriguez0792@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'meddrug', '165961b93d4752f1477de0b6d28da937', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1d6dfb33ef9384507b1dae4ba36efeced7bdda7e', '1', '2015-10-09 16:16:28', '', 0),
(1151, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Phil', 'Cowboy', NULL, 'Cowboy Organization', '', '', NULL, '', '', '', 0, '', '', 'philcowboy_00@yahoo.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'philcowboy_00', '62197f7a6b29e65ee93a9ade65fa42cb', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'f6c7b7521fe1d1a76453137a5c195111486ea83e', '1', '2015-10-10 21:50:29', '', 0),
(1152, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Testes', 'Hermes', NULL, 'Hermes Tees Corporation', '', '', NULL, '', '', '', 0, '', '', 'ht@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'hermes', '77053f9bf6990a690c2078cb1bf7683e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'a82ed6b20eb6efaad2ed1111beface6aee43bd1e', '1', '2015-10-11 13:16:17', '', 0),
(1153, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Prerna', 'Tueriyar', NULL, 'Inspiration Infotech', '', '', NULL, '', '', '', 0, '', '', 'kundan.kumar1@hotmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'kkumar77', '3e407faa419c7c63ebaf0d022d835095', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '831b25ea4c64ef97a16d680647a7ded6d0de5a15', '1', '2015-10-13 09:03:28', '', 0),
(1154, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Lalit', 'Shinde', NULL, 'Infycom', '', '', NULL, '', '', '', 0, '', '', 'lalit.shinde007@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Lshind', '5cd1a6d44488c4039c3ecba512c66f71', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0f84e7ff8def5e887955601abc19659b1d7781a8', '1', '2015-10-13 14:24:23', '', 0),
(1155, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'KUNDAN', 'KUMAR', NULL, 'INFYCOM', '', '', NULL, '', '', '', 0, '', '', 'infycom@outlook.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'infycom', 'ad2526e3c88992e0099ac3af1cafb553', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '04b9763e576f1ff7f6d3608c0547e3487c9df52c', '1', '2015-10-15 14:43:14', '', 0),
(1156, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'KUNDAN', 'KUMAR', NULL, 'INFYCOM', '', '', NULL, '', '', '', 0, '', '', 'infycom@yahoo.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'infycom@yahoo.com', 'ad2526e3c88992e0099ac3af1cafb553', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2015-10-15 15:05:44', '', 0),
(1157, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Shivesh', 'Jha', NULL, 'Everpay Inc', '', '', NULL, '', '', '', 0, '', '', 'savysmokes@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'savysmokes', '98342e571007a433cc8eeab81e6524b4', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2015-10-19 01:12:32', '', 0),
(1158, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Rakesh', 'Bose', NULL, 'Bigecart Enterprises', '', '', NULL, '', '', '', 0, '', '', 'bigecart@gmail.com', 1, '', '2015-10-23 11:40:20', 0, '', '', 'bigecart', '3955f72a2bc14a93633ffa947278ddb7', 0, 0, 0, 0, '', '', '', 0, '', 0, '322, gayathri aparments', 'somajiguda', 'hyderabad', 'Andhra Pradesh', '500082', 'IN', '', '+918125194563', '', 'www.bigecart.com', '', '', '', '', '', '', '', '', '1', '2015-10-22 11:38:36', '', 0),
(1159, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Tyreese', 'Sneed', NULL, 'Spokezmanndeals', '', '', NULL, '', '', '', 0, '', '', 'Spokezmann22@yahoo.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Tyreese', '29a7bba834b0e4769881bdc206b67f12', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2015-10-25 04:11:24', '', 0),
(1160, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Wender', 'Teixeira', NULL, 'bugchecker', '', '', NULL, '', '', '', 0, '', '', '00xwen@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'r00tbr', '3c2424d7a5dfb565a61fe9885c5f2394', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2015-10-27 01:39:56', '', 0),
(1161, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Rahul', 'Nagaich', NULL, 'ITSQUADS SERVICES LLP', '', '', NULL, '', '', '', 0, '', '', 'admin@itsquads247.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'itsquads247', '7b7f71bff78951c020e9c647a32bb839', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2015-10-27 20:47:48', '', 0),
(1162, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Mukesh', 'Singh', NULL, 'SSRP IT SOLUTIONS PVT LTD', '', '', NULL, '', '', '', 0, '', '', 'ceo@ssrpitsolutions.com', 1, '', '2015-11-13 11:53:00', 0, '', '', 'webearth247', '87503831df8caf92a41d5e5ddda6015f', 0, 0, 0, 0, '', '', '', 0, '', 0, 'DN-24, MATRIX TOWER', 'SALT LAKE', 'KOLKATA', 'West Bengal', '700091', 'IN', '', '1-800-532-4594', '', 'www.webearth247.co', '', '', '', '', '', '', '', '', '1', '2015-11-12 11:40:03', '', 0),
(1163, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'brian', 'brown', NULL, 'Digital Media Kings', '', '', NULL, '', '', '', 0, '', '', 'digitalmediakingz@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'DGK', '6133735df7c74d7bf3895bcaf09aff83', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2015-11-15 14:13:46', '', 0),
(1164, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'JASMINE E', 'BATES', NULL, 'JAE FOODA', '', '', NULL, '', '', '', 0, '', '', 'Copeland.citadeldk610502@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'JAE', '8c145f1ada6498c66b124969c8d0b343', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2015-11-17 09:20:59', '', 0),
(1165, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'JASMINE E', 'BATES', NULL, 'JAE FOODA', '', '', NULL, '', '', '', 0, '', '', 'qhmainstay13538@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'BATES', '8c145f1ada6498c66b124969c8d0b343', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2015-11-17 09:24:27', '', 0),
(1166, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'CHRISTOPHER', 'KLODT', NULL, 'QIANG TU', '', '', NULL, '', '', '', 0, '', '', 'Wils.484190@gmail.com', 1, '', '2015-11-19 08:09:10', 0, '', '', 'QIANGTU KLODT', '8c145f1ada6498c66b124969c8d0b343', 0, 0, 0, 0, '', '', '', 0, '', 0, '1317 N BRONSON AVE APT 203', 'APT 203', 'LOS ANGELES CA', '1317 N BRONSON AVE APT 203 LOS ANGELES CA', '90028', 'US', '', '3234688825', '', 'www,koldttu.cn.com', '', '', '', '', '', '', '', '', '1', '2015-11-18 07:56:05', '', 0),
(1167, '', '', 'Wells Fargo', 'Checking', '10500 Ulmerton Rd STE 480 Largo, FL 33771', '3282510084', '101000248', 'WFBIUS6S', 'Business', '', '', 0, 0, 2, 1, 'Craig', 'Gurney', NULL, 'Ultimate Management LLC', '', '', '0', '', '', '', 4, 'UM12', '', 'craig@memphora.com', 1, '', '2015-11-21 05:30:30', 0, 'W9YMKJ3BD5MUM9LUP4EN', 'VI2MJXUANQ7VEQSPL23BIJUYF078FBHKYREZCICV', 'cjgurney', '83d80f829eae99ef0e34d11f7eef351b', 0, 0, 0, 0, '', '', '', 0, '', 0, '110 E Center St', 'Suite 2053', 'Madison', 'SD', '57042', 'US', '', '605-496-9528', '', 'www.memphora.com', '', '', '', '', '', '', '', '', '1', '2015-11-19 20:19:02', '', 0),
(1168, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Hector', 'Garcia', NULL, 'Excelente Hair Supplies', '', '', NULL, '', '', '', 0, '', '', 'Excelentehair@gmail.com', 1, '', '2015-11-22 11:06:31', 0, '', '', 'HectorLuis', '620ed324166425e7d6e78141a1783f5f', 0, 0, 0, 0, '', '', '', 0, '', 0, '622 Monaco', 'Extension el comandante', 'Carolina', 'PR', '00982', 'PR', '', '787 9554862', '', 'Excelentehairsupply.com', '', '', '', '', '', '', '', '', '1', '2015-11-21 10:47:30', '', 0),
(1169, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'brian', 'brown', NULL, 'Dope Sox', '', '', NULL, '', '', '', 0, '', '', 'dopesox@yahoo.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'dopesox', 'ac375959f1fbdc70208f0555631037e0', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2015-11-21 12:21:35', '', 0),
(1170, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 2, 1, 'Sunny', 'Prakash', NULL, 'Prudent Mind Info Solutions Pvt. Ltd.', '', '', '0', '', '', '', 4, 'UM12', '', 'info@pmissupport.com', 1, '', '2015-11-24 12:17:22', 0, '', '', 'pmis', 'c61a77d2c75067ce135dae106dde16ff', 0, 1, 0, 0, '', '', '', 0, '', 0, 'Q.no-DT-1485,Dhurwa', 'Dhurwa', 'Ranchi', 'Jharkhand', '834004', 'IN', '', '9470987148', '', 'www.pmis.co.in', '', '', '', '', '', '', '', '', '1', '2015-11-23 12:13:49', '', 0),
(1171, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Jose', 'Santiago Maldonado', NULL, 'Lcdo. Jose E. Santiago Maldonado', '', '', NULL, '', '', '', 0, '', '', 'lcdojosesantiago@yahoo.com', 0, 'cc714bc18d9368c33099ab8ff936ed81318439f4', '2015-11-28 09:54:59', 0, '', '', 'Josecaiman', '79ef5e264fb8c055fbe854e587d24cc5', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2015-11-26 15:59:35', '', 0),
(1172, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'SANDEEP KUMAR', 'MAHATO', NULL, 'SKI MANAGEMENT PVT LTD', '', '', NULL, '', '', '', 0, '', '', 'merajkhan2007@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'skikolkata', 'e9a2e36d0eb25c71aca5a5273d83a00b', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2015-11-28 15:19:07', '', 0),
(1173, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'AMIT', 'MONDAL', NULL, 'TINGE LEVY', '', '', NULL, '', '', '', 0, '', '', 'kolkata033@live.in', 1, '', '2015-12-01 11:46:14', 0, '', '', 'kolkata033', '2f607bfc779092ba8bbc72f26f13445d', 0, 0, 0, 0, '', '', '', 0, '', 0, 'WEST RABINDRA NAGAR', '58/7 ', 'KOLKATA', 'WEST BENGAL', '700065', 'IN', '', '9002999919', '', 'http://www.tingelevy.com', '', '', '', '', '', '', '', '', '1', '2015-11-30 06:07:01', '', 0);
INSERT INTO `clients` (`client_id`, `unique_id`, `merchant_id`, `bank_name`, `bank_acc_name`, `bank_address`, `bank_acc_number`, `bank_routing_number`, `bank_swift_number`, `bank_acc_type`, `bitcoin_address_name`, `bitcoin_address`, `bitcoin_settlement_percentage`, `is_non_us`, `client_type_id`, `plan_id`, `first_name`, `last_name`, `passport_number`, `company`, `company_logo`, `address_1`, `address_2`, `city`, `state`, `postal_code`, `country`, `gmt_offset`, `phone`, `email`, `email_verified`, `email_code`, `email_code_expire`, `parent_client_id`, `api_id`, `secret_key`, `username`, `password`, `default_gateway_id`, `suspended`, `deleted`, `two_step_verification`, `backup_codes`, `tax_id`, `business_start`, `business_type`, `business_number`, `business_category`, `business_address`, `business_address2`, `business_city`, `business_zip`, `business_state`, `business_country`, `business_industry`, `business_phone`, `business_fax`, `business_url`, `business_monthly_vol`, `payment_types`, `credit_card`, `echeck`, `merchant_number`, `terminal_number`, `store_number`, `activation_code`, `is_active`, `created_date`, `user_id`, `status`) VALUES
(1174, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'senell', 'cunningham', NULL, 'iconnect soft solutions llc', '', '', NULL, '', '', '', 0, '', '', 'prince.baba005@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'prince00707', 'b2ec0cdf2a0aae7e479343e334135984', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2015-12-01 08:26:33', '', 0),
(1175, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Lionel', 'Escajeda', NULL, 'Bidding Unlimited', '', '', NULL, '', '', '', 0, '', '', 'lescajeda@bidz.com', 0, '1c68ca5144e0b02150744d3a8f52f65dfa63b367', '2015-12-09 12:15:24', 0, '', '', 'lescajeda', '1ae4c7c5f851314692230065f8265f89', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2015-12-04 15:35:25', '', 0),
(1176, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Robert', 'Ramos', NULL, 'The Print & Vinyl Masters', '', '', NULL, '', '', '', 0, '', '', 'theprintmasterspr@hotmail.com', 0, '2a267c8a3836034c4cff9a4684b498e3dda3fd56', '2015-12-20 09:05:45', 0, '', '', 'Theprintmasterspr', 'ac87e61303a78c3320a754d9f7cd02f4', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2015-12-10 05:30:47', '', 0),
(1177, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Vivek', 'Singhal', NULL, 'abc', '', '', NULL, '', '', '', 0, '', '', 'vivek@cybertrontechnologies.com', 0, '5a8457e02591413757dd19124572fb7c8ae439a7', '2015-12-11 08:03:55', 0, '', '', 'vivek', '7d077f716c9a40f5660456534922464f', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2015-12-10 08:01:18', '', 0),
(1178, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Sanju', 'Dey', NULL, 'Dey consultancy', '', '', NULL, '', '', '', 0, '', '', 'sanju.iori@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'wcsonline', 'c5c3672ebfe9fe085ba7035beb9e178f', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2015-12-11 01:43:45', '', 0),
(1179, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'clement', 'hua', NULL, 'Mafys US Inc.', '', '', NULL, '', '', '', 0, '', '', 'clement@mafys.us', 0, '', '0000-00-00 00:00:00', 0, '', '', 'clementmafys', '5c458bf0d396a8cb7cd01b68ecf16cbe', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2015-12-13 23:52:39', '', 0),
(1180, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 2, 1, 'Richard', 'Ishberg', NULL, 'Ultimate Management , LLC.', '', 'Calle 69, Centro, Merida, Mexico', '0', 'Merida', 'Merida', '0', 484, 'UM5', '(514) 627-5240', 'sales@pacificgiftcards.com', 0, '', '0000-00-00 00:00:00', 1000, 'QW4NLAGGQSWYUH5TOLH1', 'VCRJAK29M7CYYK6YZWIKY7DYHRN4HL8S1K23HHJA', 'sales@pacificgiftcards.com', '1b756fcb173602c50a1897ee7820b991', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0000-00-00 00:00:00', '', 0),
(1181, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Roberto', 'Ramos', NULL, 'The Print & Vinyl Masters', '', '', NULL, '', '', '', 0, '', '', 'theprintmasterspr@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'theprintmasterspr@gmail.com', '2b855bedfcf444e1c342495f27f4315a', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2015-12-19 09:03:55', '', 0),
(1182, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'joan', 'chappellet', NULL, 'j colleen chappellet consulting', '', '', NULL, '', '', '', 0, '', '', 'j_chappellet@outlook.com', 0, 'cd01d19dfd2171a644567a8b6de3a0a4ac963402', '2015-12-20 06:04:04', 0, '', '', 'j_chappellet', '8343262e9ac0dc9a689caf70ebe3c120', 0, 0, 0, 0, '', '', '', 0, '', 0, '3663 solano ave', '192', 'napa', 'ca', '94558', 'US', '', '7076901763', '', 'https://www.linkedin.com/in/colleen-chappellet-phd-9271533', '', '', '', '', '', '', '', '', '1', '2015-12-19 18:02:25', '', 0),
(1183, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Sherwin', 'Ocubillo', NULL, 'Unknown', '', '', NULL, '', '', '', 0, '', '', 'sher.ocs@everpayinc.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'sher.ocs@everpayinc.com', '62197f7a6b29e65ee93a9ade65fa42cb', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2015-12-19 23:29:20', '', 0),
(1184, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Keith', 'Sconiers', NULL, 'Nwag', '', '', NULL, '', '', '', 0, '', '', 'keith@keithsconiers.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'keithsconiers', 'f970ee777e53f4d8fa30a325c412b524', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2015-12-25 00:58:30', '', 0),
(1185, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'NILDA', 'IRIZARRY', NULL, 'stainless steel Jewelers PR', '', '', NULL, '', '', '', 0, '', '', 'thimiealejandro@yahoo.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Joseanibal1', '5fb5f05410581f7874671aa7ec41a7a0', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2015-12-29 11:32:55', '', 0),
(1186, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Sergey', 'Kutniak', NULL, 'Softtrast LP', '', '', NULL, '', '', '', 0, '', '', 'soft.trast@gmail.com', 0, '29378a4166299b6ab80eab9f8f12aa257670bb96', '2016-01-04 08:41:57', 0, '', '', 'soft.trast@gmail.com', 'e7da6dd1275df3c5cd5369cb3cab4dce', 0, 0, 0, 0, '', '', '', 0, '', 0, 'West Pilton Rise', '16/5 ', 'Edinburgh', 'Edinburgh', 'EH4 4UQ', 'GB', '', '380938834234', '', 'Softtrast LP', '', '', '', '', '', '', '', '', '1', '2016-01-03 20:29:06', '', 0),
(1187, '', '', 'ICICI Bank', 'Tech Clinik Technical Services Private Limited', ' A-233, Okhla Phase-1, New Delhi. 110020', '071605500612', 'N/A', 'ICICINBBCTS', 'Corporate', '', '', 0, 0, 0, 1, 'Akanksha', 'Shukla', NULL, 'Tech Clinik Technical Services Pvt. Ltd.', '', '', NULL, '', '', '', 0, '', '', 'akanksha.shukla@techclinik.com', 0, 'dc3598d249c1df4573bbccd1093d7ecd8bf02270', '2016-01-15 03:29:03', 0, '', '', 'akanksha.shukla@techclinik.com', '9b27e44b98eb266474ec36d011aecccd', 0, 0, 0, 0, '', '', '', 0, '', 0, '165- A  Fourth Floor Ganpati House, ', 'Gautam Nagar,', 'New Delhi', 'New Delhi', '110049', 'IN', '', '9958941060', '', 'www.techclinik.com', '', '', '', '', '', '', '', '', '1', '2016-01-14 11:25:12', '', 0),
(1188, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Shahid', 'Nawab', NULL, 'Istrom Technology Pvt Ltd.', '', '', NULL, '', '', '', 0, '', '', 'istrom.inc@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'istrom', 'e8fa2852a5b8d0e63631ac67523aa4a5', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-01-20 03:25:32', '', 0),
(1189, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Jeremy', 'McDowell', NULL, 'Orange and Apple', '', '', NULL, '', '', '', 0, '', '', 'jmcdowell@applause.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'jeremyapples', '6548859e76d1158e4a3b0bd046f1a14d', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-01-22 15:07:52', '', 0),
(1190, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Vikash', 'Khattry', NULL, 'Vish Technologies', '', '', NULL, '', '', '', 0, '', '', 'v.khattry@vishtechnologies.net', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Vishtech0528', '93431627bd82d0333d3f37958228754a', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-01-27 09:21:13', '', 0),
(1191, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Sunny', 'Prakash', NULL, 'Prudent Mind Info Solutions Pvt. Ltd.', '', '', NULL, '', '', '', 0, '', '', 'pmis.ranchi@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'sanusonu', 'c61a77d2c75067ce135dae106dde16ff', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-01-29 10:20:21', '', 0),
(1192, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Sunny', 'Prakash', NULL, 'Prudent Mind Info Solutions Pvt. Ltd.', '', '', NULL, '', '', '', 0, '', '', 'sunnyprakashverma@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'pmis0202', 'e4115faa14625c2223350d22ccdb7e9c', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-02-02 10:40:20', '', 0),
(1193, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Murali', 'r', NULL, 'srit', '', '', NULL, '', '', '', 0, '', '', 'rayasam99@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'rayasam99@gmail.com', 'e50352f030c9515405c76965fec6ec15', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-02-11 09:41:44', '', 0),
(1194, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'jerry', 'cates', NULL, 'cates', '', '', NULL, '', '', '', 0, '', '', 'catesjerry84@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'catesjerry84@gmail.com', 'e7144b415ed51f644ee5c8f888dc71b5', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-02-16 16:54:50', '', 0),
(1195, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Ravinder', 'Kaur', NULL, 'Tech4Global Inc.', '', '', NULL, '', '', '', 0, '', '', '4578jsw@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'tech4global', '6250b556e690c5608389fe664797e0eb', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-02-24 11:34:09', '', 0),
(1196, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Gabriela', 'Maraver', NULL, 'Grrful', '', '', NULL, '', '', '', 0, '', '', 'grrful@gmail.com', 1, '', '2016-02-25 05:47:25', 0, '', '', 'grrful@gmail.com', '6f0408cdf59626fd8626bcbad7b861d2', 0, 0, 0, 0, '', '', '', 0, '', 0, 'Urb. Alturas del Rio Calle 6', 'K-15', 'Bayamón', '00959', 'Area Metro', 'PR', '', '7873962748', '', 'grrful.tumblr.com', '', '', '', '', '', '', '', '', '1', '2016-02-24 17:43:50', '', 0),
(1197, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Avinash', 'Singh', NULL, 'Prudent Mind Info Solutions Pvt. Ltd.', '', '', NULL, '', '', '', 0, '', '', 'info@prudentmind.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'prudent', 'e6913a2f83f16f9d825c5dcfee96442c', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-02-25 14:08:24', '', 0),
(1198, '', '', 'KOTAK MAHINDRA BANK', 'AMIT MONDAL', 'KAKURGACHI, KOLKATA 700 054', '5011412538', 'KKBK0000324', 'KKBKINBBXXX', 'SAVING', '', '', 0, 0, 0, 1, 'AMIT', 'MONDAL', NULL, 'WEBZEET', '', '', NULL, '', '', '', 0, '', '', 'support@webzeet.com', 1, '', '2016-02-27 10:52:18', 0, '16ZZ6QE64SSW0U4TOEQJ', 'X7W7NN4ZGLOEPNCO9MW0PTV2WVEQCXMEVT1KOTDX', 'webzeet', '121c1e9c854c687f7e8c51ef487a1e84', 0, 0, 0, 0, '', '', '', 0, '', 0, '61/B NABANAGAR HALISAHAR', 'BIJPUR', 'NORTH 24 PARGANAS', '743136', 'West Bengal', 'IN', '', '9062967086', '', 'http://www.webzeet.com', '', '', '', '', '', '', '', '', '1', '2016-02-26 06:00:56', '', 0),
(1199, '', '', 'santander bank', 'xavier taylor', 'P.O. Box 961245, Fort Worth, TX 76161-1245', '9995423103', '231372691', '9995423103', 'checking', '', '', 0, 0, 0, 1, 'xavier', 'taylor', NULL, 'taylormade xclusive apparel', '', '', NULL, '', '', '', 0, '', '', 'taylorxtsf@gmail.com', 0, '06531dd9637b8f04b86e2056ad05eab6fd68db96', '2016-03-01 07:15:03', 0, '', '', 'taylorxtsf@gmail.com', '9a8b1141465beb214608f21cf97b5c32', 0, 0, 0, 0, '', '', '', 0, '', 0, '1810 sw 100th ave', 'h', 'miramar', '33025', 'Florida', 'US', '', '7865089111', '', 'www.madetees.net', '', '', '', '', '', '', '', '', '1', '2016-02-29 19:11:48', '', 0),
(1200, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Webster', 'Griebel', NULL, 'Heartland', '', '', NULL, '', '', '', 0, '', '', 'webster.griebel@e-hps.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'webster.griebel@e-hps.com', 'c6ee2c49a3e8f64e4c4c5b47e14f3e8b', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-03-04 12:23:30', '', 0),
(1201, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Igor', 'Tomic', NULL, 'AB3.Inc', '', '', NULL, '', '', '', 0, '', '', 'igor.tomic.x@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'igor.tomic.x@gmail.com', 'c8e48afa2b6ec2e7f2b27a5b17880425', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-03-15 21:08:50', '', 0),
(1202, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Karan', 'Saleem', NULL, 'Get Back to Earth', '', '', NULL, '', '', '', 0, '', '', 'getbacktoearth@hotmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Karan', '3b4c24b19a249be4787a8a92cc349568', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-03-17 00:42:55', '', 0),
(1203, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Suman', 'Das', NULL, '7sidenetwork', '', '', NULL, '', '', '', 0, '', '', 'info@7side.co.in', 0, '', '0000-00-00 00:00:00', 0, '', '', 'info@7side.co.in', '1ba535e48c5cbe38c2390fa3d9edb807', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-03-25 18:55:48', '', 0),
(1204, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Rebecca', 'Karpaty', NULL, 'Cyber Compatibles INC.', '', '', NULL, '', '', '', 0, '', '', 'info@cybercompatible.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'info@cybercompatible.com', '1ba535e48c5cbe38c2390fa3d9edb807', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-03-25 18:58:47', '', 0),
(1205, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Faiz', 'Ahmad', NULL, 'Digiweb Solution', '', '', NULL, '', '', '', 0, '', '', 'ntsolution@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'ntsolution@gmail.com', '62110c1328f5e9951134920b0b4e03b9', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-03-31 13:14:34', '', 0),
(1206, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Samuel', 'Burnette', NULL, 'Draven Enterprise', '', '', NULL, '', '', '', 0, '', '', 'officialconsultant023@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'dravengroup', '20514edd67dcbdef0559e8b6b2678153', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-04-03 11:15:19', '', 0),
(1207, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'HIMAL', 'MAHAT', NULL, 'A-1 IT SUPPORT LLC', '', '', NULL, '', '', '', 0, '', '', 'info@a1itsupport.com', 1, '0b751d85acbc2cc1fb073f2ab47f9afb19835354', '2016-04-07 10:34:55', 0, '', '', 'HIMALIT143', '0847edfcba57dd558042d5cf3e2d9cb7', 0, 0, 0, 0, '', '', '', 0, '', 0, 'GILLAND CT', '16', 'NOTTINGHAM', '21236', 'MD', 'US', '', '8558317534', '', 'www.a1itsupport.com', '', '', '', '', '', '', '', '', '1', '2016-04-06 09:52:55', '', 0),
(1208, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'David', 'Maxwell', NULL, 'MONSTA TECH LLC', '', '', NULL, '', '', '', 0, '', '', 'itmonsta365@gmail.com', 1, '', '2016-04-15 01:58:15', 0, '', '', 'itmonsta365', '95dfa1cdf2a412c293072ff1dd07cf2e', 0, 0, 0, 0, '', '', '', 0, '', 0, '716 Hedderly St', 'Hedderly St', 'Halifax', 'VA', '24558', 'US', '', '18004741375', '', 'www.itmonsta.com', '', '', '', '', '', '', '', '', '1', '2016-04-14 13:39:24', '', 0),
(1209, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'SUNIL', 'SAWANT', NULL, 'SNO INVESTMENT INC', '', '', NULL, '', '', '', 0, '', '', 'snoinvest0@gmail.com', 0, 'c5a6ced6d8aa419df3f2584f0bc8e83109ec5b6d', '2016-04-20 10:26:57', 0, '', '', 'SNOinvest0', 'bc3e5d5a62cb2fced73ad1026309013c', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-04-19 22:23:20', '', 0),
(1210, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'SUNIL', 'SAWANT', NULL, 'SNO INVESTMENT INC', '', '', NULL, '', '', '', 0, '', '', 'sawantsunil539@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'SNOINVESTMENTinc123', 'bc3e5d5a62cb2fced73ad1026309013c', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-04-20 01:49:11', '', 0),
(1211, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Sumit', 'Makan', NULL, 'Honey Cloud Technologies', '', '', NULL, '', '', '', 0, '', '', 'support@honeycloudtechnologies.net', 0, '', '0000-00-00 00:00:00', 0, '', '', 'honeycloud', '1e2abd9fdb5f7ac4963d6000c991e00f', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-04-27 15:55:12', '', 0),
(1212, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Prasenjit', 'Bar', NULL, 'ACL:', '', '', NULL, '', '', '', 0, '', '', 'Prasenjit@aclservice.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Prasenjit@aclservice.com', 'cbd4a55ce943dc417bf70fa92732784a', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-05-03 11:01:01', '', 0),
(1213, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Shoha', 'Komolov', NULL, 'Itcenter', '', '', NULL, '', '', '', 0, '', '', 'KShoha94@gmail.com', 0, '2e07178fb2c71eb0f2f64f32710b39aae9ff26b3', '2016-05-09 11:33:59', 0, '', '', 'Shoha', 'b7d67dd3e6dfdc9bb78ed05d2abc6d3c', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-05-08 11:30:18', '', 0),
(1214, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'MUTHURAMAN', 'NALLASAMY', NULL, 'PELER TECH LLC', '', '', NULL, '', '', '', 0, '', '', 'contact@pelertech.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'pelertech', 'e9f108787b63f81b1686310525d0604d', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-05-12 16:23:46', '', 0),
(1215, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Wesley', 'Tomczak', NULL, 'wesleytomczak6', '', '', NULL, '', '', '', 0, '', '', 'wesleytomczak22@array.goverloe.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'wesleytomczak6', '5da71f6eb56e178bd72aefb09695403d', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-05-15 09:25:59', '', 0),
(1216, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Kirk', 'Steadman', NULL, 'kirk9331211', '', '', NULL, '', '', '', 0, '', '', 'lovehemmingsennqo@yahoo.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'kirk9331211', 'de40e2b950610d366e188fabf5fed0d7', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-05-15 10:38:31', '', 0),
(1217, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Amrit B', 'Damai', NULL, 'Cloud Papers Limited', '', '', NULL, '', '', '', 0, '', '', 'lichtpayments@gmail.com', 0, '410c3bddf9eccfabc9fe844acf7c9956bf291659', '2016-05-18 10:54:19', 0, '', '', 'lichtworld', 'a5db1f5c759a9188005b01a4c8410f3f', 0, 0, 0, 0, '', '', '', 0, '', 0, 'Ramsons Way', '2', 'Abingdon', 'Oxfordshire', 'OX143TH', 'GB', '', '18884090659', '', 'www.lichtworld.com', '', '', '', '', '', '', '', '', '1', '2016-05-17 12:21:53', '', 0),
(1218, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'GLENDA', 'ORTIZ', NULL, 'Soporte Educativo En Accion', '', '', NULL, '', '', '', 0, '', '', 'gortiz604@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'gortiz604@gmail.com', 'a1912a2f42f97a151d01985cdb7101a3', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-05-20 16:30:33', '', 0),
(1219, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'jose luis', 'rosario bon', NULL, 'jose luis rosario bon', '', '', NULL, '', '', '', 0, '', '', 'joseluis2762@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'joseluis2762@gmail.com', '6808a974286e6ced758b8e09ec9cec4b', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-05-21 05:35:46', '', 0),
(1220, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Anabel', 'Ortiz', NULL, 'Caribbean Snaps', '', '', NULL, '', '', '', 0, '', '', 'caribbeansnaps@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Kiarelys20', 'b6492849d81f3b81ca39212e47fa224a', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-05-22 13:18:23', '', 0),
(1221, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'JORGE Luis', 'GONZALEZ', NULL, 'Personal', '', '', NULL, '', '', '', 0, '', '', 'maurico77.jlg@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'maurico77.jlg@gmail.com', '8289903516fece2b3e5d9d1f89c58c81', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-05-24 22:31:02', '', 0),
(1222, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'JAMES', 'GATEWOOD', NULL, 'LOGICAL COMPOSITIONS ENTERTAINMENT LLC', '', '', NULL, '', '', '', 0, '', '', 'logical.compositions@musician.org', 1, '', '2016-05-27 06:13:28', 0, '', '', 'logicompent', '38c56f3756533947d103e3a7c8b36077', 0, 0, 0, 0, '', '', '', 0, '', 0, '24291 BERRY AVE', ' ', 'WARREN', 'MI', '48089', 'US', '', '3135226035', '', 'LOGICALCOMPENT.WIX.COM/LOGICALCOMPENT', '', '', '', '', '', '', '', '', '1', '2016-05-26 05:47:48', '', 0),
(1223, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Candice', 'Carman', NULL, 'candicecarman28', '', '', NULL, '', '', '', 0, '', '', 'boyanceterina@etmail.top', 0, '', '0000-00-00 00:00:00', 0, '', '', 'candicecarman28', 'b4427012f35224d261cb649a2ba5fc59', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-05-26 10:23:12', '', 0),
(1224, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 2, 1, 'Pablo', 'Digiani', NULL, 'Axlot IT Services', '', '12 779', '', 'La Plata', 'Buenos Aires', '1900', 32, 'UM5', '221 69908765', 'digi@axlot.com', 0, 'feb41b51b8cf87c8e475d4b337cc431a6cedd77a', '2016-06-04 11:01:16', 1000, '00A17GQ5S6WZ9ACORML5', 'LKTW253BZXX4WEW6C4YHTHKINC5XG7ZX89MPDBH3', 'digiclient', 'c13644256999c64e2bfbe9b208efd42d', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0000-00-00 00:00:00', '', 0),
(1225, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 1, 1, 'Pablo', 'Digiani', NULL, 'Axlot IT Services', '', '12 779', '', 'La Plata', 'Buenos Aires', '1900', 32, 'UM5', '221 69908765', 'digi+service@axlot.com', 0, '', '0000-00-00 00:00:00', 1000, 'NLCT922Z4MWAG8BPP76N', '13PUKCK7ZAQ2DTSFQT8UWM5H1X70BRHVB3X77VFB', 'digiservice', 'e64c0663d7e33fc32c9884fc658a3b09', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0000-00-00 00:00:00', '', 0),
(1226, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Donald', 'Svedberg', NULL, 'Drugz4u', '', '', NULL, '', '', '', 0, '', '', 'donsvedberg@yahoo.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'donsvedberg', '0ab94a111b6252af2b5a606c7dbfba32', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-06-09 23:32:04', '', 0),
(1239, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Hemal', 'Sharma', NULL, 'masssive', '', '', NULL, '', '', '', 0, '', '', 'sharmahemal@yahoo.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'sharmahemal999', '7d5ec120cc10fe88f29cf60338a16edb', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-06-12 09:11:12', '', 0),
(1240, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Kris', 'Albers', NULL, 'All natural energy', '', '', NULL, '', '', '', 0, '', '', 'alberskris678@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'alberskris678@gmail.com', 'f37e33bdea094a0277684b1a8d90abc5', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-06-26 22:53:04', '', 0),
(1241, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Krystle', 'Wilson', NULL, 'Krys Kleaning Kuties', '', '', NULL, '', '', '', 0, '', '', 'kryskleaningkuties@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Kryskuties', '6d98bb211a93e81297744fb38872a04d', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-07-04 23:24:18', '', 0),
(1242, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Akeem', 'Blackman', NULL, 'Custom Tees 4 U', '', '', NULL, '', '', '', 0, '', '', 'bestorderanu@gmail.com', 1, '', '2016-07-08 07:15:07', 0, '', '', 'CustomTees4U', '33935b31deb8fbd4c5b9d3c8606bb20f', 0, 0, 0, 0, '', '', '', 0, '', 0, 'Hope Housing Scheme, Block 5, ', 'Lot 69', 'Georgetown', 'East Coast Demerara', '011592', 'GY', '', '592 625-4936', '', 'https://custom-tees-4-u.ecwid.com/#', '', '', '', '', '', '', '', '', '1', '2016-07-07 07:05:26', '', 0),
(1243, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Robert', 'Jeremic', NULL, 'RB Jeremic Painting Service', '', '', NULL, '', '', '', 0, '', '', 'Robertjeremic@mail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Robertjer22', '8baf258a0bab997eb5ecc4585b4d9641', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-07-11 16:03:41', '', 0),
(1244, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'iverson', 'Smith', NULL, 'General Motors', '', '', NULL, '', '', '', 0, '', '', 'iversonsmith328@gmail.com', 1, '', '2017-05-21 09:41:57', 0, '', '', 'iversonsmith', '8875cf5a792ee708c1beb7c9a7e771df', 0, 0, 0, 0, '', '', '', 0, '', 0, '313 East Keith St', '313', 'Roswell', '88201', 'New Mexico', 'US', '', '5753174897', '', 'devinsonline.com', '', '', '', '', '', '', '', '', '1', '2016-07-19 07:36:59', '', 0),
(1245, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'James', 'Michaels', NULL, 'Stower Ltd', '', '', NULL, '', '', '', 0, '', '', 'info.nmcltd@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Mezza9', '8eb1e7f6164eda97278df2c7edcecc00', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-07-31 17:43:57', '', 0),
(1246, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Arthur', 'Sanmiguel', NULL, '10 to 2 boofin', '', '', NULL, '', '', '', 0, '', '', 'euclid00101@icloud.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'euclid01', '3a63311a20657e78f12023b3880a07af', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-08-07 16:50:39', '', 0),
(1247, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'ARTHUR', 'SAN MIGUEL', NULL, '10 to 2 boofin', '', '', NULL, '', '', '', 0, '', '', 'asanmiguel1985@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'MrMigz07', '3a63311a20657e78f12023b3880a07af', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-08-07 20:03:45', '', 0),
(1248, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Patty', 'Fludd', NULL, 'Fludd enterprise', '', '', NULL, '', '', '', 0, '', '', 'pattyfludd88@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Pattyfludd88', '2d546b52628a8e81a3e0e93b7a3bd595', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-08-11 15:18:45', '', 0),
(1249, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Hector', 'Lopez', NULL, 'X', '', '', NULL, '', '', '', 0, '', '', 'poronsititito@gmail.com', 0, 'eecc085a9d72b895f124ba3f96cbd45e39f0c31c', '2016-08-22 06:14:13', 0, '', '', 'Poronsititito', 'c5c5e96c64f4fe88a5fccf19e01112c6', 0, 0, 0, 0, '', '', '', 0, '', 0, 'Enrique quijada', '128', 'Hermosillo', '83180', 'Sonora', 'MX', '', '+526624254092', '', 'Www.Facebook.com/hectoramirez', '', '', '', '', '', '', '', '', '1', '2016-08-21 09:51:23', '', 0),
(1250, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Diana', 'Johnson', NULL, 'Harlow Salon', '', '', NULL, '', '', '', 0, '', '', 'dianajohnson18@excite.com', 0, '5409f39a65115d1aef883b8e5c600857d621ee0c', '2016-08-28 03:04:11', 0, '', '', 'dianajohnson18', '5af44a1459a5517b1224fbf11bdebc32', 0, 0, 0, 0, '', '', '', 0, '', 0, '771 Gorgas St', 'Suite 771', 'Mobile', 'AL', '36603', 'US', '', '205-335-9723', '', 'http://www.harlowsalon.net/', '', '', '', '', '', '', '', '', '1', '2016-08-26 20:57:08', '', 0),
(1251, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Gustavo', 'Lujan', NULL, 'Chamo\'si Café', '', '', NULL, '', '', '', 0, '', '', 'lujan769@hotmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Lujan', 'e2c7920cac5681bafcdcb932da66278b', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-09-02 22:19:23', '', 0),
(1252, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Jay', 'Brahmbhatt', NULL, 'PcGeekPro Inc.', '', '', NULL, '', '', '', 0, '', '', 'jay@pcgeekpro.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'pcgeekpro', '79c31483b7c20ffeb4d28eae1c46348f', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-09-09 14:20:51', '', 0),
(1253, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Bryan', 'Tucker', NULL, 'TechStudios', '', '', NULL, '', '', '', 0, '', '', 'techmandesign@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'TechStudios', '221e1137e7e96081563d55872dca1418', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-09-13 02:01:57', '', 0),
(1254, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Francisco', 'Calderon', NULL, 'it esencial cyc s.a.', '', '', NULL, '', '', '', 0, '', '', 'fcalderon@itservices.co.cr', 1, '', '2016-09-14 11:17:35', 0, '', '', 'fcalderon.506', '971bde7848cadd7735cde96ecf352539', 0, 0, 0, 0, '', '', '', 0, '', 0, 'Tierra Blanca', 'Sanabria', 'Oreamuno', 'Cartago', '0000', 'CR', '', '22015943', '', 'www.itservices.co.cr', '', '', '', '', '', '', '', '', '1', '2016-09-13 11:14:29', '', 0),
(1255, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Z', 'Shan', NULL, 'Zee', '', '', NULL, '', '', '', 0, '', '', 'shah.zeshan@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Z', '4e075844d2e00e4c800c8c62716bed8c', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-09-16 16:45:06', '', 0),
(1256, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'douglas', 'medlar', NULL, 'Bevs House of Treasures', '', '', NULL, '', '', '', 0, '', '', 'douglasmedlar@yahoo.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'douglasmedlar@bevshouse', 'e612ed961f30b9d698354150040c5a01', 0, 0, 0, 0, '', '', '', 0, '', 0, '3660 boulder highway ', 'trlr148', 'las vegas', 'nevada', '89121', 'US', '', '7022055474', '', 'bevshouseoftreasures@gmail.com', '', '', '', '', '', '', '', '', '1', '2016-09-22 03:49:37', '', 0),
(1257, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Sergio', 'Quiroz', NULL, 'PRACSAC', '', '', NULL, '', '', '', 0, '', '', 'SERGIO@ALIDOBPO.COM', 0, '', '0000-00-00 00:00:00', 0, '', '', 'aliadobpo', 'bedf07f0ea81fabbc12825a7229f3297', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-09-22 09:42:00', '', 0),
(1258, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'vesta', 'goodarz', NULL, 'vesrta store', '', '', NULL, '', '', '', 0, '', '', 'bagbrosxgold@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'bagbrosxgold', '23f1b3a6c58fe469d9a63a7cf4a4b59f', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-09-22 13:45:23', '', 0),
(1259, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Jose', 'Quintero', NULL, 'Quintero Betancourt LLC', '', '', NULL, '', '', '', 0, '', '', 'jose.quintero@qbllc.net', 0, '449a11870386a6bde5e878db013a02397d946a8a', '2016-10-18 11:37:59', 0, '', '', 'jose.quintero@qbllc.net', '87159cd0d2c25762b6e87b721232d8ae', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-10-02 12:05:02', '', 0),
(1260, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Regina', 'Pugh', NULL, 'Fluffy puppy express', '', '', NULL, '', '', '', 0, '', '', 'reginapugh15@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Reginapugh15', '6b23485bb74b09b7b786a2743b341705', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-10-07 00:59:54', '', 0),
(1261, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Joann', 'Maya', NULL, '1976', '', '', NULL, '', '', '', 0, '', '', 'mayita0776@gmail.com', 0, 'bb704d0a4951817ec8c9a7a57021c22ea89ea9df', '2016-10-19 03:47:22', 0, '', '', 'mayita0776@gmail.com', '9132db58a2d99dc2b0badc6284834291', 0, 0, 0, 0, '', '', '', 0, '', 0, ' Riviera Cir.', '161', 'Weston', '33326', 'Florida', 'US', '', '7862783189', '', 'mayita0776@gmail.com', '', '', '', '', '', '', '', '', '1', '2016-10-18 15:39:43', '', 0),
(1262, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'WEI', 'DING', NULL, 'Express off courier company', '', '', NULL, '', '', '', 0, '', '', 'dingwei0105@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'dingwei0105', 'c35bb3d6aa3e8ad223cbc20b8a691bff', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-11-16 05:41:45', '', 0),
(1263, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Derek', 'Egle', NULL, '88 industrial', '', '', NULL, '', '', '', 0, '', '', 'swaxii.18@gmail.com', 0, '49c69c9523be1f9970fcba9164619f42c095fc4a', '2016-11-19 07:02:20', 0, '', '', 'swazi88', '3d165ebbaa53becf6df33dbc162e3ca4', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-11-18 18:52:49', '', 0),
(1264, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Tabitha', 'Lamb', NULL, 'Get paid', '', '', NULL, '', '', '', 0, '', '', 'tabithalamb00@live.com', 1, '', '2016-11-20 09:23:54', 0, '', '', 'Tlamb88', '3d165ebbaa53becf6df33dbc162e3ca4', 0, 0, 0, 0, '', '', '', 0, '', 0, '1917 merkley ave', '2', 'West Sacramento', '95691', 'California', 'US', '', '9162897533', '', 'Https://Paypal.com/getpaid', '', '', '', '', '', '', '', '', '1', '2016-11-19 21:14:48', '', 0),
(1265, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Jerry', 'Quillen', NULL, 'J\'s construction and more', '', '', NULL, '', '', '', 0, '', '', 'Jqulln1984@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Jqulln1984', '1025c1d932c3db937cc2b120c3c1c5d8', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-11-26 21:52:26', '', 0),
(1266, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Nicholas', 'Douglas', NULL, 'Metro North Public Safety inc', '', '', NULL, '', '', '', 0, '', '', 'christopherdouglas720@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Christopher Douglas', '69decc9c93301b59c0a03b2411f2ed3d', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-11-27 16:23:58', '', 0),
(1267, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Karthik', 'Anantharaman', NULL, 'Clockwork marketing', '', '', NULL, '', '', '', 0, '', '', 'am408@mail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'am408@mail.com', '8ae8b71903e687351b9601feb304bd10', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-11-29 13:27:06', '', 0),
(1268, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Robin', 'Crumpler', NULL, 'Eas professionals llc', '', '', NULL, '', '', '', 0, '', '', 'crumpler5152@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'robinc', '64c20965816f066d6c51953ab8f9ba84', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-11-30 15:49:55', '', 0),
(1269, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Sandeep Kumar', 'Mahato', NULL, 'SKI MANAGEMENT PVT LTD', '', '', NULL, '', '', '', 0, '', '', '786shahfaiz@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'skiwestbengal', 'eb6a4fb053d5f787c75e4c8b44596cfc', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-12-12 08:40:30', '', 0),
(1270, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'John', 'Symington', NULL, 'United supply', '', '', NULL, '', '', '', 0, '', '', 'Symic2016@saintly.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Symic16', '22e094bd878e45aa21522dff6d3e4619', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2016-12-17 05:03:14', '', 0),
(1271, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'earl', 'brockett', NULL, 'roadside service  and towing', '', '', NULL, '', '', '', 0, '', '', 'roadside_serv@post.com', 0, 'f29cb0e578178a547a66493d1ac2cb080101b8a5', '2017-01-03 07:33:08', 0, '', '', 'earlbrock', 'b943d88a2bc1682f79368c40692d2895', 0, 0, 0, 0, '', '', '', 0, '', 0, '821 Tulare', '2', 'Maricopa', '93252', 'California', 'US', '', '6616232572', '', 'Https://aaa.norcal.com', '', '', '', '', '', '', '', '', '1', '2016-12-28 04:59:00', '', 0),
(1272, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Gene', 'Scott', NULL, '1939', '', '', NULL, '', '', '', 0, '', '', 'xxjambajxx@gmail.com', 0, '2e1c2c32c57df93aab37744e227fa47a7c966f45', '2017-01-02 05:26:14', 0, '', '', 'Gscott2016', '4b2bcc3afc0cbdc107ccf47ea0717fa8', 0, 0, 0, 0, '', '', '', 0, '', 0, '8735 birch', 'Ste b', 'Newport Beach', '92660', 'CA - California', 'US', '', '4166304126', '', 'Www.worldwidecaregivers.ca', '', '', '', '', '', '', '', '', '1', '2016-12-30 13:16:30', '', 0),
(1273, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'James', 'Luxama', NULL, 'International Security Guard Services', '', '', NULL, '', '', '', 0, '', '', 'securityofficers@isgs-guard.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Securityofficers18', '59ace1525ea918b7e029117d901c4000', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-01-01 02:44:47', '', 0),
(1274, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'James', 'Luxama', NULL, 'International Security Guard Services', '', '', NULL, '', '', '', 0, '', '', 'Luxamajames@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Securityofficers17', '59ace1525ea918b7e029117d901c4000', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-01-01 03:38:23', '', 0),
(1275, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Valerie', 'Green', NULL, 'Canyon Crest Lodge', '', '', NULL, '', '', '', 0, '', '', 'attheoldballgame@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'VGreen2017', 'c739a4fe6fb6573bfe54db663fc76d9b', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-01-05 05:24:21', '', 0),
(1276, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Billydiern', 'Billydiern', NULL, 'Billydiern', '', '', NULL, '', '', '', 0, '', '', 'wyporum@adam.pro.lolekemail.net', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Billydiern', 'bb76833d0770443d6c3dc09414f4ef25', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-01-12 19:26:31', '', 0),
(1277, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'weylin', 'mcclodden', NULL, 'Wayne world', '', '', NULL, '', '', '', 0, '', '', 'illuminatikingiiii@gmail.com', 1, '', '2017-02-09 08:02:09', 0, '', '', 'Wayneworld', '7a569237f48eeb1b040157acbd090ba3', 0, 0, 0, 0, '', '', '', 0, '', 0, '4000 e. Charleston Blvd. ', '4000', 'las vegas', '89104', 'NV', 'US', '', '7027123729', '', 'ebay. com/wayneworld24', '', '', '', '', '', '', '', '', '1', '2017-02-08 19:45:37', '', 0),
(1278, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'zvusaymefmgrdht', 'zvusaymefmgrdht', NULL, 'zvusaymefmgrdht', '', '', NULL, '', '', '', 0, '', '', '2343nj161@yahoo.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'zvusaymefmgrdht', '25f9e794323b453885f5181f1b624d0b', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-02-12 16:42:22', '', 0),
(1279, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'diegolase', 'diegolase', NULL, 'diegolase', '', '', NULL, '', '', '', 0, '', '', 'diegogarsia2018@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'diegolase', 'fc89b6335b936eff12b402c4ba23908a', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-02-14 16:03:05', '', 0),
(1280, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Roxovgf', 'Roxovgf', NULL, 'Roxovgf', '', '', NULL, '', '', '', 0, '', '', 'wertasumbinokatormasyt@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Roxovgf', '914c5dafe5316acb463679831555f6ea', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-02-16 11:58:53', '', 0),
(1281, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'DonaldToops', 'DonaldToops', NULL, 'DonaldToops', '', '', NULL, '', '', '', 0, '', '', 'vorishheva-nastenka@mail.ru', 0, '', '0000-00-00 00:00:00', 0, '', '', 'DonaldToops', '9e4bb1ad44525fa2b7d67f13de0b3926', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-02-23 08:20:31', '', 0),
(1282, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Delia', 'Engstrom', NULL, 'Only D Photography', '', '', NULL, '', '', '', 0, '', '', 'deliaengstrom@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Veg4me', '27a260a1f790ed7c1e8a336abba46cfb', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-02-27 14:41:24', '', 0),
(1283, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Esther', 'Anosike', NULL, 'Estilo0705', '', '', NULL, '', '', '', 0, '', '', 'odianosi22@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Estilo0705', 'b82f9abf4ee182258ee3554db3696010', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-03-04 11:08:45', '', 0),
(1284, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Oscar', 'Orozco', NULL, '4thWall', '', '', NULL, '', '', '', 0, '', '', 'oscarorozco1995@gmail.com', 1, '', '2017-03-15 12:38:53', 0, '', '', '4thWall', 'dea72489d7b404867a9bd867d10c319e', 0, 0, 0, 0, '', '', '', 0, '', 0, 'CALZADA TECNOLOGICO SN, TOMAS AQUINO', '#123456', 'Tijuana', 'Baja California', '22414 ', 'MX', '', '6643021831', '', 'Dispositivos de Audio e Ilumnicacion', '', '', '', '', '', '', '', '', '1', '2017-03-14 12:05:11', '', 0),
(1285, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Tanya', 'Lacroix', NULL, '1983', '', '', NULL, '', '', '', 0, '', '', 'Tanyal200305@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Tanyal0305', '06077b59f6ee9089fb033c23209145ed', 0, 0, 0, 0, '', '', '', 0, '', 0, '5420 houston rd', 'Lot 6', 'MACON', '31216', 'GA', 'US', '', '4784448825', '', 'Tanya Jewely', '', '', '', '', '', '', '', '', '1', '2017-04-11 00:39:56', '', 0),
(1286, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Kenneth', 'Vanalstine', NULL, 'Alstine imports', '', '', NULL, '', '', '', 0, '', '', 'skillfullczar@protonmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Skillfullczar', '1c37f43479715dac51158b0ddfd38c48', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-04-20 21:18:05', '', 0),
(1287, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'james', 'leimas', NULL, '1973', '', '', NULL, '', '', '', 0, '', '', 'huskyboyj@aol.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'huskyboyj@aol.com', 'f0469d142f842544514b95ae912b6e78', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-04-27 02:59:18', '', 0),
(1288, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'saplyJaptops', 'saplyJaptops', NULL, 'saplyJaptops', '', '', NULL, '', '', '', 0, '', '', 'Heifedem@yourmail.work', 0, '', '0000-00-00 00:00:00', 0, '', '', 'saplyJaptops', 'c338a5011f24164ccc970239b23adc16', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-05-04 06:55:18', '', 0),
(1289, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'kechi', 'Elliott', NULL, 'myFlowers', '', '', NULL, '', '', '', 0, '', '', 'vera.kep@gmail.com', 0, 'd38454350e6c9820978409fd93032d040a4efdcd', '2017-05-06 08:04:46', 0, '', '', 'Domo2008@', '5fb5191048fb5bc2e8e86e3af082b284', 0, 0, 0, 0, '', '', '', 0, '', 0, '13947 paramount blvd', '307', 'Paramount', 'California', '90723', 'US', '', '5623832977', '', 'myFlowers1.com', '', '', '', '', '', '', '', '', '1', '2017-05-05 19:44:21', '', 0),
(1290, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Ronnie', 'Waller', NULL, 'RonZ Customs', '', '', NULL, '', '', '', 0, '', '', 'ronnierwaller@gmail.com', 0, '431079f80d46d717921a53100f10cc1c6af12e30', '2017-05-19 02:50:31', 0, '', '', 'RonZcustoms', '39392360b57c92dc74917e8fab6c8d45', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-05-18 02:49:16', '', 0),
(1291, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Bao Keopaseuth', 'lam', NULL, 'BAOLAM INC', '', '', NULL, '', '', '', 0, '', '', 'mrforexeco@gmail.com', 0, '3dce00671edbdc599550472bd8dc866f214e2986', '2017-05-22 08:14:25', 0, '', '', 'mrforexeco@gmail.com', '617a9a4668aa3036f141d049288cd3f1', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-05-21 07:57:24', '', 0),
(1292, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Alberto', 'Camberos', NULL, 'Uber everywhere', '', '', NULL, '', '', '', 0, '', '', 'nmai18901@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Uber1122', '937d807d2726c1702a8e6a4c95e159ac', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-05-23 04:20:47', '', 0),
(1293, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Subash', 'George Manuel', NULL, 'Bee-one UK LTD', '', '', NULL, '', '', '', 0, '', '', 's.manuel@beeone.co.uk', 1, '', '2017-05-24 12:58:53', 0, '', '', 'beeone', 'e3ecb38f0c1e24d32f3da2cce71c8d8d', 0, 0, 0, 0, '', '', '', 0, '', 0, 'Canada Square', '25, Level 33, Citi Bank Tower', 'Canary Wharf', 'London', 'E14 5LB', 'GB', '', '07515731008', '', 'https://www.beeone.co.uk', '', '', '', '', '', '', '', '', '1', '2017-05-23 12:47:50', '', 0),
(1294, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Ashley', 'Bolen', NULL, 'Ash styles', '', '', NULL, '', '', '', 0, '', '', 'bolen36@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Abolen', 'ab1d6ee5c284127de6e80abb78bfc59e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-05-27 17:32:33', '', 0),
(1295, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Bobbieboack', 'Bobbieboack', NULL, 'Bobbieboack', '', '', NULL, '', '', '', 0, '', '', 'alexandrogustavus@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Bobbieboack', '5eaba96ab75d0e55243afdbf7afd1e45', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-05-28 19:56:31', '', 0);
INSERT INTO `clients` (`client_id`, `unique_id`, `merchant_id`, `bank_name`, `bank_acc_name`, `bank_address`, `bank_acc_number`, `bank_routing_number`, `bank_swift_number`, `bank_acc_type`, `bitcoin_address_name`, `bitcoin_address`, `bitcoin_settlement_percentage`, `is_non_us`, `client_type_id`, `plan_id`, `first_name`, `last_name`, `passport_number`, `company`, `company_logo`, `address_1`, `address_2`, `city`, `state`, `postal_code`, `country`, `gmt_offset`, `phone`, `email`, `email_verified`, `email_code`, `email_code_expire`, `parent_client_id`, `api_id`, `secret_key`, `username`, `password`, `default_gateway_id`, `suspended`, `deleted`, `two_step_verification`, `backup_codes`, `tax_id`, `business_start`, `business_type`, `business_number`, `business_category`, `business_address`, `business_address2`, `business_city`, `business_zip`, `business_state`, `business_country`, `business_industry`, `business_phone`, `business_fax`, `business_url`, `business_monthly_vol`, `payment_types`, `credit_card`, `echeck`, `merchant_number`, `terminal_number`, `store_number`, `activation_code`, `is_active`, `created_date`, `user_id`, `status`) VALUES
(1296, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Agustin', 'Dominguez', NULL, 'RVAG UNITED LLC', '', '', NULL, '', '', '', 0, '', '', 'Agustindominguez3@aol.com', 1, '', '2017-05-29 08:10:42', 0, '', '', 'Agust.dom3', 'efc879c46c6a4a2e18e9281e9c6ddfa3', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-05-28 20:07:03', '', 0),
(1297, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Verlin', 'Maney', NULL, 'Randys Appliance Repairs', '', '', NULL, '', '', '', 0, '', '', 'randysappliancerepairs@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'randysappliancerepairs@gmail.com', '882cd4e282c3b7075b081f39e894e3af', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-05-30 00:31:31', '', 0),
(1298, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Lorrenda', 'Fritz', NULL, 'Custom Candles', '', '', NULL, '', '', '', 0, '', '', 'lorrendafr@gmail.com', 0, '38b7f82aa2b803b06dbb7fc14077f97f2bc2a294', '2017-06-10 08:46:04', 0, '', '', 'Lorrenda', 'fd84f701621cd36604c9a59e0b665e23', 0, 0, 0, 0, '', '', '', 0, '', 0, 'E234 cobbtown rd', '234', 'Waupaca', 'Wisconsin', '54981', 'US', '', '7154121518', '', 'www.customcandles.com', '', '', '', '', '', '', '', '', '1', '2017-06-03 20:42:01', '', 0),
(1299, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Chris', 'Perry', NULL, 'Pown services', '', '', NULL, '', '', '', 0, '', '', 'sopowv@dnsdeer.com', 0, '6b556b8a82d2698c7c63b82406858554c525fc4f', '2017-06-05 10:52:48', 0, '', '', 'Pown1970', '392e1e1701ee069ca00e7bc1a08f1c6a', 0, 0, 0, 0, '', '', '', 0, '', 0, '3835 Vernon street ', 'Unit 1 ', 'Ontario ', 'California ', '91761', 'US', '', '17603016927', '', 'Cash.me/ $cperry', '', '', '', '', '', '', '', '', '1', '2017-06-04 21:29:54', '', 0),
(1300, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Joseph', 'Richard', NULL, 'D B Dealer', '', '', NULL, '', '', '', 0, '', '', 'neurjorge@usa.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'neurjorge@usa.com', 'd8ec2370bfc1c6d102b5bbbf9c6476dc', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-06-05 10:23:18', '', 0),
(1301, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Bryan', 'Highfield', NULL, 'Reddnekk Productions', '', '', NULL, '', '', '', 0, '', '', 'reddnekk7384@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Reddnekk7384', '90864d7644b71bd4f449bc06ae721399', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-06-07 23:48:37', '', 0),
(1302, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Margarita', 'Reynaga', NULL, 'Maggys Closet', '', '', NULL, '', '', '', 0, '', '', 'maggy2596@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'maggy2596@gmail.com', '1e00bac7003089b4274b28f639880059', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-06-08 00:09:27', '', 0),
(1303, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Adam', 'Winnick', NULL, 'Faka & Shma', '', '', NULL, '', '', '', 0, '', '', 'adamwinnick@yahoo.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'awinnick75', 'df0c1273870b181e65437867d0aed6ff', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-06-08 11:50:47', '', 0),
(1304, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Scarlett', 'Diaz', NULL, 'ScarSolutions LLC', '', '', NULL, '', '', '', 0, '', '', 'dmucci0025@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Scar0025', '27a3a6d65ec447909767a6b617164534', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-06-09 07:37:17', '', 0),
(1305, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Mike', 'Manning', NULL, '1962', '', '', NULL, '', '', '', 0, '', '', 'maysa7444@gmail.com', 0, '3610e813e2ec17adb5a1fa046fedf027da2c88b8', '2017-06-11 12:29:29', 0, '', '', 'Maysa7444@gmail.com', '82fd9775f56b9369d820207c15936503', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-06-10 12:19:09', '', 0),
(1306, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Dean', 'Manning', NULL, 'Dean Manning', '', '', NULL, '', '', '', 0, '', '', 'deanmanning472@outlook.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'deanmanning472@outlook.com', '82fd9775f56b9369d820207c15936503', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-06-10 12:28:39', '', 0),
(1307, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Thomas', 'Gillespie', NULL, 'GILLESPIES GOODS', '', '', NULL, '', '', '', 0, '', '', 'Gillespiethomas1977@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Gillespiethomas1977@gmail.com', '7f8a6c7fff215f0e5401affd05516f3b', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-06-10 23:17:24', '', 0),
(1308, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Anthony', 'Maxwell', NULL, 'Tonya handyman service', '', '', NULL, '', '', '', 0, '', '', 'Tjmaxx62189@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Hogwash805', 'e545c5ce85f3262f52d7aacf3ad7efdd', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-06-12 20:22:00', '', 0),
(1309, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Dejawon', 'Joseph', NULL, 'Djci', '', '', NULL, '', '', '', 0, '', '', 'Dejawonjoseph@yahoo.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Djhb06', '9f9e9f849edcc8704b3598aa7bbf05e8', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-06-14 10:20:10', '', 0),
(1310, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Francene', 'Henderson', NULL, 'Blair', '', '', NULL, '', '', '', 0, '', '', 'flhenderson17@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'flhenderson', '11871d7ddd8a8d5e92f856a619dc8599', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-06-14 14:25:10', '', 0),
(1311, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Neil', 'Mccardle', NULL, 'Neils wheels', '', '', NULL, '', '', '', 0, '', '', 'neilmccardle22@gmail.com', 0, '8e81ca02756be2b0f6c4b9fb113607b92b9e2331', '2017-06-16 04:17:27', 0, '', '', 'Nmccardle22', 'a559a0f0f2440973c73ed5395f4d859e', 0, 0, 0, 0, '', '', '', 0, '', 0, '1950 Shadow Rock Drive', '100', 'Kingwood', '77339', 'Texas', 'US', '', '469-975-6454', '', 'http://www.PayPal.com/neilswheels', '', '', '', '', '', '', '', '', '1', '2017-06-15 00:39:19', '', 0),
(1312, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Austin', 'Mccardle', NULL, 'Wheels', '', '', NULL, '', '', '', 0, '', '', 'Jeffcarlson012@gmail.com', 0, 'a10feb0dcf8fe0d5ec8f71ecd70d408551fc1cb7', '2017-06-16 04:25:05', 0, '', '', 'Austinmcc1', 'a559a0f0f2440973c73ed5395f4d859e', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-06-15 04:22:08', '', 0),
(1313, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Cristina', 'Ernest', NULL, 'Mobile Bookkeeping', '', '', NULL, '', '', '', 0, '', '', 'Misscrissy23@sbcglobal.net', 0, '', '0000-00-00 00:00:00', 0, '', '', 'misscrissy23', '3b52f4f14a2d1833842cb9bb430ecaea', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-06-16 08:58:29', '', 0),
(1314, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'susanna', 'zerbo', NULL, 'Nacho Libre', '', '', NULL, '', '', '', 0, '', '', 'zerbo.sue@gmail.com', 0, '75ef483b6bbe48bfcd3ec9c85b3ba80d461f4b70', '2017-06-17 10:45:17', 0, '', '', 'szerbo', 'bbf1f12146d272796be98edff3263983', 0, 0, 0, 0, '', '', '', 0, '', 0, 'CARR 115  KM 11 H 6', 'H6', 'Rincon', 'Puerto Rico', '00677', 'PR', '', '9175434582', '', 'NachoLibre Rincon facebook', '', '', '', '', '', '', '', '', '1', '2017-06-16 10:26:53', '', 0),
(1315, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Cristina', 'Ernest', NULL, 'Mobile Bookkeeping', '', '', NULL, '', '', '', 0, '', '', 'c_ernest@outlook.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'c_ernest@outlook.com', '7531fd574eb1a8121e0d6abf6ff053b5', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-06-17 19:40:39', '', 0),
(1316, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Daniel', 'Smith', NULL, 'Computers By Dan', '', '', NULL, '', '', '', 0, '', '', 'computersfeedme@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Danontheranch', '94a23fa2258415e0be489af895a20264', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-06-18 06:47:15', '', 0),
(1317, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'charles', 'pipes', NULL, 'earthworks', '', '', NULL, '', '', '', 0, '', '', 'jjcrabshack77@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'crabman77', '0a0e4cd335304141c97b89d8fc97cfc4', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-06-19 09:46:32', '', 0),
(1318, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'jeffery', 'pipes', NULL, 'EARTH Works', '', '', NULL, '', '', '', 0, '', '', 'socailcrab@mail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'pipesjp', '0a0e4cd335304141c97b89d8fc97cfc4', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-06-19 09:57:57', '', 0),
(1319, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Areence', 'Areence', NULL, 'Areence', '', '', NULL, '', '', '', 0, '', '', 'n.al.a.boug.on@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Areence', 'c8140808dcd2d3bf287d2c1a7f344152', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-06-23 22:24:18', '', 0),
(1320, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Nikita', 'Unix', NULL, 'Sadsasd', '', '', NULL, '', '', '', 0, '', '', 'lumipay@mail.ru', 0, '', '0000-00-00 00:00:00', 0, '', '', 'unix86', '8ef0c9e169f4a4f3ca734555bf0c8a20', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-06-24 04:00:47', '', 0),
(1321, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Devin', 'Gaddis', NULL, '1991', '', '', NULL, '', '', '', 0, '', '', 'Devingaddis1279@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'DEVING', '5d7ec68255cea32e3ff6f88143bf8d60', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-06-25 19:44:23', '', 0),
(1322, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'OrlandoPug', 'OrlandoPug', NULL, 'OrlandoPug', '', '', NULL, '', '', '', 0, '', '', 'lasunabuy@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'OrlandoPug', 'd0e26622d1a3d5ead1d2dea96397b8d7', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-06-28 17:16:11', '', 0),
(1323, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Tommy', 'Tomlinson', NULL, 'Gutter cutter llc', '', '', NULL, '', '', '', 0, '', '', 'gutter.cutter.mi@Gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Guttercutter', '22b43c087d9d7149fe2302e768ef3347', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-06-29 02:06:47', '', 0),
(1324, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Jerry', 'Morris', NULL, 'Jjmorris', '', '', NULL, '', '', '', 0, '', '', 'jerryjmorris69@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Jjmorris', '90a93d0ad6888613ac0f8d8e40b8fef1', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-07-01 00:46:50', '', 0),
(1325, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'nadeem', 'jamal', NULL, 'Al RAHA FLOUR MILLS', '', '', NULL, '', '', '', 0, '', '', 'Nadeem_j@outlook.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'nadee123', 'ab100a52dc951abab0ca9235d7456705', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-07-02 17:28:27', '', 0),
(1326, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'nadeem', 'jamal', NULL, 'Al RAHA FLOUR MILLS', '', '', NULL, '', '', '', 0, '', '', 'nadeemjamal88@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'nadee234', 'ab100a52dc951abab0ca9235d7456705', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-07-02 17:30:26', '', 0),
(1327, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Johnnynealp', 'Johnnynealp', NULL, 'Johnnynealp', '', '', NULL, '', '', '', 0, '', '', 'dolly@italy-mail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Johnnynealp', '812bd912762c5792b14514171064c269', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-07-04 10:46:00', '', 0),
(1328, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Alfredo', 'Guerrero', NULL, 'Alfredos Goods', '', '', NULL, '', '', '', 0, '', '', 'tom94501@yahoo.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'tom94501', '5bb431ca202b39d517d55708f4f1c27c', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-07-07 03:07:52', '', 0),
(1329, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Krista', 'Repke', NULL, 'K\'s Cleaning services', '', '', NULL, '', '', '', 0, '', '', 'mr421702@gmail.com', 0, '0bac76fbecb78d17d1716c1a5380ee70a2a6be84', '2017-07-12 08:28:56', 0, '', '', 'Kmr85', '78de8eb2034bf6dbd02b089d7670e3a6', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-07-11 19:55:51', '', 0),
(1330, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Mark', 'Ramos', NULL, 'MRKLONG', '', '', NULL, '', '', '', 0, '', '', 'mkeinneth7392@gmail.com', 0, 'aa34db3e7f7aa8072d6af972238905857b728b3a', '2017-07-15 12:26:04', 0, '', '', 'Mrklong', 'b59ea82bc3a704ed36c61049bf630578', 0, 0, 0, 0, '', '', '', 0, '', 0, '2561 east 218th pl', '218th', 'Long Beach', '90810', 'CA', 'US', '', '3237720074', '', 'Www.Mrklong.com', '', '', '', '', '', '', '', '', '1', '2017-07-13 22:59:10', '', 0),
(1331, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'FRANCISCO', 'BARELA', NULL, 'JOEL CARS', '', '', NULL, '', '', '', 0, '', '', 'barela287@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'barela287@gmail.com', '3d435c253e1f906c55ff6c4e7bf2f48c', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-07-14 10:25:29', '', 0),
(1332, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Melvin', 'Duran', NULL, 'JUST FOR MEN FASHION STUDIO LLC', '', '', NULL, '', '', '', 0, '', '', 'melvin@just.com.do', 0, '', '0000-00-00 00:00:00', 0, '', '', 'melvind01', '440a744892ff7a646858ee5e05feb930', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-07-14 12:00:46', '', 0),
(1333, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Mary', 'Porter', NULL, 'Mary Porter', '', '', NULL, '', '', '', 0, '', '', 'dom1mary22016@gmail.com', 0, '8781e42180d84099cdaa94e67fd13e144a5abfd4', '2017-07-16 03:35:18', 0, '', '', 'Dom1mary2', '9344b224c83869647cc288a27d19242c', 0, 0, 0, 0, '', '', '', 0, '', 0, '7235 Dianne Dr ', '7235 Dianne Drive', 'New Port Richey ', 'Florida ', '34652', 'US', '', '7577380901', '', 'http://tampa.backpage.com/WomenSeekMen/independent-safe-new-port-richey-2-earth-social-upbeat-33-w-ddds/35925708', '', '', '', '', '', '', '', '', '1', '2017-07-15 02:58:01', '', 0),
(1334, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Ryan', 'Samples', NULL, 'Samples construction', '', '', NULL, '', '', '', 0, '', '', 'ryansamples50@yahoo.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'ryansamples50', '265d70f006d9ed0ecf1386e7791cc37c', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-07-16 06:34:01', '', 0),
(1335, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Carron', 'Henderson', NULL, 'BA Stores', '', '', NULL, '', '', '', 0, '', '', 'bosswealth@gmail.com', 1, '', '2017-07-17 03:11:53', 0, '', '', 'bosswealth', 'f898fbc7a3b3a1701e1a623f9eb75df9', 0, 0, 0, 0, '', '', '', 0, '', 0, '1755 E Ann Arbor', '1', 'Dallas', '75216', 'Texas', 'US', '', '4695206234', '', 'www.bastores.one', '', '', '', '', '', '', '', '', '1', '2017-07-16 15:07:16', '', 0),
(1336, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Carron', 'Henderson', NULL, 'BA Stores', '', '', NULL, '', '', '', 0, '', '', 'support@bastores.one', 0, '', '0000-00-00 00:00:00', 0, '', '', 'bastores', 'f898fbc7a3b3a1701e1a623f9eb75df9', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-07-16 15:15:50', '', 0),
(1337, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'HaroldThonO', 'HaroldThonO', NULL, 'HaroldThonO', '', '', NULL, '', '', '', 0, '', '', 'ivanikpetro4@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'HaroldThonO', '5f7fe63078a2264b0e683844a00f8d0c', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-07-17 01:31:15', '', 0),
(1338, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'John', 'Brown', NULL, 'Service Fit for A King', '', '', NULL, '', '', '', 0, '', '', 'jbrown2532@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Jbrown2532', '5d95d37cac289d21a4d564a128399fa9', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-07-18 13:46:46', '', 0),
(1339, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'MyfilmMut', 'MyfilmMut', NULL, 'MyfilmMut', '', '', NULL, '', '', '', 0, '', '', 'nosovvladimir234+Dab@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'MyfilmMut', '450014a204d6e00b3a3693c178ce82e5', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-07-20 01:24:26', '', 0),
(1340, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Angela', 'Patton', NULL, 'Angela Patton', '', '', NULL, '', '', '', 0, '', '', 'angelapatton@angela-patton.com', 1, '', '2017-07-23 12:16:11', 0, '', '', 'Angela3793', '3913fda5e82c9daf84c3b9317d85e0d9', 0, 0, 0, 0, '', '', '', 0, '', 0, '3793 ', 'W Suburban Court', 'Columbus', 'IN', '47201', 'US', '', '812-341-5808', '', 'www.Instagram.com/theangelapatton', '', '', '', '', '', '', '', '', '1', '2017-07-22 12:12:49', '', 0),
(1341, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'jason', 'judd', NULL, 'Discount Cabs', '', '', NULL, '', '', '', 0, '', '', 'yamasaamericasales@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'jcabs2017', '339fd1c7c1acc784f156918353b5222d', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-07-23 19:33:46', '', 0),
(1342, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Kerri', 'Burnam', NULL, '1976', '', '', NULL, '', '', '', 0, '', '', 'kerrib122@aol.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Kerri122', '67513a04327d42690fdea90f7c9e5559', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-07-24 04:29:08', '', 0),
(1343, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'cory', 'mason', NULL, 'Mason Holdings LLC', '', '', NULL, '', '', '', 0, '', '', 'ldrunner100@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'ldrunner100', 'b230ec8f36d578b3b6dfdb0a1bf6fadf', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-07-27 09:46:15', '', 0),
(1344, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Vincent', 'Crespi', NULL, 'VINCENT KEITH CRESPI I', '', '', NULL, '', '', '', 0, '', '', 'vincentcrespi@att.net', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Crespivin12', '02f83d8b3a46519b4bf5c8f52e828f4d', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-08-06 19:45:13', '', 0),
(1345, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Mohammad', 'Haroon', NULL, 'SMART TRADERS INC', '', '', NULL, '', '', '', 0, '', '', 'mharoon@netzero.net', 0, '', '0000-00-00 00:00:00', 0, '', '', 'mharoon', '428ea01aff7d33eca639f0c7da50ca8a', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-08-07 06:49:03', '', 0),
(1346, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'daryn', 'himes', NULL, 'fairie taylez', '', '', NULL, '', '', '', 0, '', '', 'dhimes716@gmail.com', 1, '', '2017-08-20 11:28:55', 0, '', '', 'dhimes716', '43c98114787fb2da7a9c6d308e6f12b5', 0, 0, 0, 0, '', '', '', 0, '', 0, '37 w 13th st ', 'Unit 2', 'Jamestown ', 'NY', '14701', 'US', '', '7169650205', '', 'https://smallshoplife.com/listing/jamestown-ny-united-states-fairie-taylez/', '', '', '', '', '', '', '', '', '1', '2017-08-14 04:27:34', '', 0),
(1347, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Kathryn', 'Findlay', NULL, 'hair and lash envy', '', '', NULL, '', '', '', 0, '', '', 'kathryn@lashenvy.com.au', 0, '', '0000-00-00 00:00:00', 0, '', '', 'klf131', '66052a31f0a6d8adc1637cb79f8037c9', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-08-17 02:34:31', '', 0),
(1348, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Maricarmen', 'Torres', NULL, 'Resale', '', '', NULL, '', '', '', 0, '', '', 'Mctorres56204@gmail.com', 0, '180220503a57efbaa1d8691fe7408698b82eab5f', '2017-08-22 03:56:27', 0, '', '', 'mctorres562', '56d334bd5c40097646420e71975ea961', 0, 0, 0, 0, '', '', '', 0, '', 0, '354 chestnut ave', '11', 'LONG BEACH', '90802', 'California', 'US', '', '5622437432', '', 'Resale association', '', '', '', '', '', '', '', '', '1', '2017-08-21 03:46:43', '', 0),
(1349, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'MichaelCreap', 'MichaelCreap', NULL, 'MichaelCreap', '', '', NULL, '', '', '', 0, '', '', 'leagh76@hotmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'MichaelCreap', '3ba53a6287ef04e9c6130d6d66844457', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-08-23 00:51:39', '', 0),
(1350, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'earl', 'bennett', NULL, 'TAZMANIAN', '', '', NULL, '', '', '', 0, '', '', 'ebinventor@hotmail.com', 1, '', '2017-08-27 09:10:33', 0, '', '', 'earlbennett33', '59661d30a1094f16d726f6551d422baf', 0, 0, 0, 0, '', '', '', 0, '', 0, '319 commonwealth ave', '319', 'Erlanger', 'ky', '41018', 'US', '', '859-743-3607', '', 'none', '', '', '', '', '', '', '', '', '1', '2017-08-26 08:37:04', '', 0),
(1351, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Oscar', 'Arellano', NULL, 'Cookie Palace', '', '', NULL, '', '', '', 0, '', '', 'Juniorsweatpants@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'XareCastlez', '3180e608bb733c7693d7cbec80a82e38', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-09-02 02:30:43', '', 0),
(1352, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'jeremy', 'cochran', NULL, 'crooks and lace ltd', '', '', NULL, '', '', '', 0, '', '', 'admin@fxnpstl.me', 0, '', '0000-00-00 00:00:00', 0, '', '', 'fxnpstl', 'a632e7646256eb32f2d4c47000dba597', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-09-03 00:34:23', '', 0),
(1353, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Joshua', 'Norton', NULL, 'Black Tiger Mixed Martial Arts', '', '', NULL, '', '', '', 0, '', '', 'Blktigermma@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Blktigermma', '3b63c3aaec7b0e36b5455b24f0f2861a', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-09-06 01:27:18', '', 0),
(1354, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Anthonyexole', 'Anthonyexole', NULL, 'Anthonyexole', '', '', NULL, '', '', '', 0, '', '', 'northview.61@ntlworld.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Anthonyexole', '57dc54a134b5a41ae3d99af99aa64520', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-09-07 17:47:20', '', 0),
(1355, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'KENDRA', 'CARTER', NULL, 'House party', '', '', NULL, '', '', '', 0, '', '', 'Mikeekion911@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'KENDRA', '409eb3386d64ffe74aa4f90ce136c5d6', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-09-17 05:55:32', '', 0),
(1356, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'AaronFloor', 'AaronFloor', NULL, 'AaronFloor', '', '', NULL, '', '', '', 0, '', '', 'alexsofteu@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'AaronFloor', 'd3322462dd06ccdcc6c3d2e1bc11d795', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-09-17 21:21:16', '', 0),
(1357, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Tasha', 'Batie', NULL, '1975', '', '', NULL, '', '', '', 0, '', '', 'aloneindisbytch17@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Tbatie17', '8a5d36a4d875ec2159a503fdeaa09848', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-09-25 23:06:45', '', 0),
(1358, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Ronald', 'Peak', NULL, 'Peak Global', '', '', NULL, '', '', '', 0, '', '', 'peakglobal2016@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Deano', 'f05c2cff807e5492e5758cc086ef1fb6', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-09-26 03:51:50', '', 0),
(1359, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Jamice', 'Piekarczuk', NULL, 'West coast rehsb llc', '', '', NULL, '', '', '', 0, '', '', 'janicepiekarczyk75@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'West coast', 'a92737031d962fb6af3f867bec15fec1', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-09-29 00:07:40', '', 0),
(1360, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Remy', 'Arthurs', NULL, 'EMC LLC', '', '', NULL, '', '', '', 0, '', '', 'remyarthurs@gmail.com', 1, '', '2017-10-06 12:16:52', 0, '', '', 'rkarthurs', 'e2d23e99f376cb5729506bb7982f5ba5', 0, 0, 0, 0, '', '', '', 0, '', 0, '1946 Ala Moana Blvd', 'Suite 120', 'Honolulu ', '96815', 'Hawaii', 'US', '', '8083759942', '', 'www.magicalpsychicreadings.com ', '', '', '', '', '', '', '', '', '1', '2017-10-05 00:07:58', '', 0),
(1361, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'qweqweqw', 'wqeqwe', NULL, 'qweqwewq', '', '', NULL, '', '', '', 0, '', '', 'rlolt3173@p33.org', 0, '', '0000-00-00 00:00:00', 0, '', '', 'qweqweqw', 'e396bbb053529d2ddb17b100aa04d7c5', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-10-07 19:43:54', '', 0),
(1362, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Juan carlos', 'Serrato molina', NULL, 'Jc tools', '', '', NULL, '', '', '', 0, '', '', 'Juanserrato013@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'Jserrato87', '09f499747ca0b1de0121a21196919c3c', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-11-04 02:49:00', '', 0),
(1363, '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 1, 'Nicolas', 'Jimenez', NULL, 'Judicial', '', '', NULL, '', '', '', 0, '', '', 'nicolasjimenezc@gmail.com', 0, '', '0000-00-00 00:00:00', 0, '', '', 'nicolaswzk', 'ae38d45a9636ae1cb72fd3d6d1dfd6e0', 0, 0, 0, 0, '', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '1', '2017-12-12 19:47:39', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `client_billing_info`
--

CREATE TABLE `client_billing_info` (
  `bank_account_name` varchar(200) NOT NULL,
  `bank_account_type` varchar(10) NOT NULL,
  `bank_owner_account_type` varchar(10) NOT NULL,
  `bank_account` varchar(25) NOT NULL,
  `bank_code` varchar(12) NOT NULL,
  `bank_swift` varchar(12) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `bank_address` varchar(200) NOT NULL,
  `bank_city` varchar(200) NOT NULL,
  `bank_region` varchar(200) NOT NULL,
  `bank_country` int(11) NOT NULL,
  `bank_phone` varchar(16) NOT NULL,
  `bank_contact` varchar(100) NOT NULL,
  `bank_id` int(11) NOT NULL DEFAULT '0',
  `client_id` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `client_emails`
--

CREATE TABLE `client_emails` (
  `client_email_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `trigger_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `to_address` varchar(255) NOT NULL,
  `bcc_address` varchar(255) DEFAULT NULL,
  `email_subject` varchar(255) NOT NULL,
  `email_body` text NOT NULL,
  `from_name` varchar(50) NOT NULL,
  `from_email` varchar(255) NOT NULL,
  `is_html` tinyint(1) NOT NULL,
  `bcc_client` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL
) ;

--
-- Dumping data for table `client_emails`
--

INSERT INTO `client_emails` (`client_email_id`, `client_id`, `trigger_id`, `plan_id`, `to_address`, `bcc_address`, `email_subject`, `email_body`, `from_name`, `from_email`, `is_html`, `bcc_client`, `active`) VALUES
(1, 1000, 1, 0, 'customer', 'transactions@everpayinc.com', 'Charge for [[AMOUNT]]', '   &lt;meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"&gt;\n    &lt;meta name=\"viewport\" content=\"width=device-width\"&gt;\n  \n  &lt;style type=\"text/css\"&gt;\na:hover {\ncolor: #2B7ECB !important;\n}\na:active {\ncolor: #2B7ECB !important;\n}\na:visited {\ncolor: #2B7ECB !important;\n}\nh1 a:active {\ncolor: #2B7ECB !important;\n}\nh2 a:active {\ncolor: #2B7ECB !important;\n}\nh3 a:active {\ncolor: #2B7ECB !important;\n}\nh4 a:active {\ncolor: #2B7ECB !important;\n}\nh5 a:active {\ncolor: #2B7ECB !important;\n}\nh6 a:active {\ncolor: #2B7ECB !important;\n}\nh1 a:visited {\ncolor: #2ba6cb !important;\n}\nh2 a:visited {\ncolor: #2ba6cb !important;\n}\nh3 a:visited {\ncolor: #2ba6cb !important;\n}\nh4 a:visited {\ncolor: #2ba6cb !important;\n}\nh5 a:visited {\ncolor: #2ba6cb !important;\n}\nh6 a:visited {\ncolor: #2ba6cb !important;\n}\ntable.button:hover td {\nbackground: #2795b6 !important;\n}\ntable.button:visited td {\nbackground: #2795b6 !important;\n}\ntable.button:active td {\nbackground: #2795b6 !important;\n}\ntable.button:hover td a {\ncolor: #fff !important;\n}\ntable.button:visited td a {\ncolor: #fff !important;\n}\ntable.button:active td a {\ncolor: #fff !important;\n}\ntable.button:hover td {\nbackground: #2795b6 !important;\n}\ntable.tiny-button:hover td {\nbackground: #2795b6 !important;\n}\ntable.small-button:hover td {\nbackground: #2795b6 !important;\n}\ntable.medium-button:hover td {\nbackground: #2795b6 !important;\n}\ntable.large-button:hover td {\nbackground: #2795b6 !important;\n}\ntable.button:hover td a {\ncolor: #ffffff !important;\n}\ntable.button:active td a {\ncolor: #ffffff !important;\n}\ntable.button td a:visited {\ncolor: #ffffff !important;\n}\ntable.tiny-button:hover td a {\ncolor: #ffffff !important;\n}\ntable.tiny-button:active td a {\ncolor: #ffffff !important;\n}\ntable.tiny-button td a:visited {\ncolor: #ffffff !important;\n}\ntable.small-button:hover td a {\ncolor: #ffffff !important;\n}\ntable.small-button:active td a {\ncolor: #ffffff !important;\n}\ntable.small-button td a:visited {\ncolor: #ffffff !important;\n}\ntable.medium-button:hover td a {\ncolor: #ffffff !important;\n}\ntable.medium-button:active td a {\ncolor: #ffffff !important;\n}\ntable.medium-button td a:visited {\ncolor: #ffffff !important;\n}\ntable.large-button:hover td a {\ncolor: #ffffff !important;\n}\ntable.large-button:active td a {\ncolor: #ffffff !important;\n}\ntable.large-button td a:visited {\ncolor: #ffffff !important;\n}\ntable.secondary:hover td {\nbackground: #d0d0d0 !important; color: #555;\n}\ntable.secondary:hover td a {\ncolor: #555 !important;\n}\ntable.secondary td a:visited {\ncolor: #555 !important;\n}\ntable.secondary:active td a {\ncolor: #555 !important;\n}\ntable.success:hover td {\nbackground: #457a1a !important;\n}\ntable.alert:hover td {\nbackground: #970b0e !important;\n}\n@media only screen and (max-width: 600px) {\n  table[class=\"body\"] img {\n    width: auto !important; height: auto !important;\n  }\n  table[class=\"body\"] center {\n    min-width: 0 !important;\n  }\n  table[class=\"body\"] .container {\n    width: 95% !important;\n  }\n  .main-container {\n    width: 95% !important;\n  }\n  table[class=\"body\"] .row {\n    width: 100% !important; display: block !important;\n  }\n  table[class=\"body\"] .wrapper {\n    display: block !important; padding-right: 0 !important;\n  }\n  table[class=\"body\"] .columns {\n    table-layout: fixed !important; float: none !important; width: 100% !important; padding-right: 0px !important; padding-left: 0px !important; display: block !important;\n  }\n  table[class=\"body\"] .column {\n    table-layout: fixed !important; float: none !important; width: 100% !important; padding-right: 0px !important; padding-left: 0px !important; display: block !important;\n  }\n  table[class=\"body\"] .wrapper.first .columns {\n    display: table !important;\n  }\n  table[class=\"body\"] .wrapper.first .column {\n    display: table !important;\n  }\n  table[class=\"body\"] table.columns td {\n    width: 100% !important;\n  }\n  table[class=\"body\"] table.column td {\n    width: 100% !important;\n  }\n  table[class=\"body\"] .columns td.one {\n    width: 8.333333% !important;\n  }\n  table[class=\"body\"] .column td.one {\n    width: 8.333333% !important;\n  }\n  table[class=\"body\"] .columns td.two {\n    width: 16.666666% !important;\n  }\n  table[class=\"body\"] .column td.two {\n    width: 16.666666% !important;\n  }\n  table[class=\"body\"] .columns td.three {\n    width: 25% !important;\n  }\n  table[class=\"body\"] .column td.three {\n    width: 25% !important;\n  }\n  table[class=\"body\"] .columns td.four {\n    width: 33.333333% !important;\n  }\n  table[class=\"body\"] .column td.four {\n    width: 33.333333% !important;\n  }\n  table[class=\"body\"] .columns td.five {\n    width: 41.666666% !important;\n  }\n  table[class=\"body\"] .column td.five {\n    width: 41.666666% !important;\n  }\n  table[class=\"body\"] .columns td.six {\n    width: 50% !important;\n  }\n  table[class=\"body\"] .column td.six {\n    width: 50% !important;\n  }\n  table[class=\"body\"] .columns td.seven {\n    width: 58.333333% !important;\n  }\n  table[class=\"body\"] .column td.seven {\n    width: 58.333333% !important;\n  }\n  table[class=\"body\"] .columns td.eight {\n    width: 66.666666% !important;\n  }\n  table[class=\"body\"] .column td.eight {\n    width: 66.666666% !important;\n  }\n  table[class=\"body\"] .columns td.nine {\n    width: 75% !important;\n  }\n  table[class=\"body\"] .column td.nine {\n    width: 75% !important;\n  }\n  table[class=\"body\"] .columns td.ten {\n    width: 83.333333% !important;\n  }\n  table[class=\"body\"] .column td.ten {\n    width: 83.333333% !important;\n  }\n  table[class=\"body\"] .columns td.eleven {\n    width: 91.666666% !important;\n  }\n  table[class=\"body\"] .column td.eleven {\n    width: 91.666666% !important;\n  }\n  table[class=\"body\"] .columns td.twelve {\n    width: 100% !important;\n  }\n  table[class=\"body\"] .column td.twelve {\n    width: 100% !important;\n  }\n  table[class=\"body\"] td.offset-by-one {\n    padding-left: 0 !important;\n  }\n  table[class=\"body\"] td.offset-by-two {\n    padding-left: 0 !important;\n  }\n  table[class=\"body\"] td.offset-by-three {\n    padding-left: 0 !important;\n  }\n  table[class=\"body\"] td.offset-by-four {\n    padding-left: 0 !important;\n  }\n  table[class=\"body\"] td.offset-by-five {\n    padding-left: 0 !important;\n  }\n  table[class=\"body\"] td.offset-by-six {\n    padding-left: 0 !important;\n  }\n  table[class=\"body\"] td.offset-by-seven {\n    padding-left: 0 !important;\n  }\n  table[class=\"body\"] td.offset-by-eight {\n    padding-left: 0 !important;\n  }\n  table[class=\"body\"] td.offset-by-nine {\n    padding-left: 0 !important;\n  }\n  table[class=\"body\"] td.offset-by-ten {\n    padding-left: 0 !important;\n  }\n  table[class=\"body\"] td.offset-by-eleven {\n    padding-left: 0 !important;\n  }\n  table[class=\"body\"] table.columns td.expander {\n    width: 1px !important;\n  }\n  table[class=\"body\"] .right-text-pad {\n    padding-left: 10px !important;\n  }\n  table[class=\"body\"] .text-pad-right {\n    padding-left: 10px !important;\n  }\n  table[class=\"body\"] .left-text-pad {\n    padding-right: 10px !important;\n  }\n  table[class=\"body\"] .text-pad-left {\n    padding-right: 10px !important;\n  }\n  table[class=\"body\"] .hide-for-small {\n    display: none !important;\n  }\n  table[class=\"body\"] .show-for-desktop {\n    display: none !important;\n  }\n  table[class=\"body\"] .show-for-small {\n    display: inherit !important;\n  }\n  table[class=\"body\"] .hide-for-desktop {\n    display: inherit !important;\n  }\n}\n&lt;/style&gt;\n  <table class=\"body\" style=\"border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; height: 100%; width: 100%; color: #222222; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; background: #EFF2F7; margin: 0; padding: 0;\" bgcolor=\"#EFF2F7\"><tbody><tr style=\"vertical-align: top; text-align: left; padding: 0;\" align=\"left\"><td class=\"center\" align=\"center\" valign=\"top\" style=\"word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: center; color: #222222; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0 0 70px;\">\n        <center style=\"width: 100%; min-width: 510px;\">\n\n          <table class=\"container\" style=\"border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: inherit; width: 510px; margin: 0 auto; padding: 0;\"><tbody><tr style=\"vertical-align: top; text-align: left; padding: 0;\" align=\"left\"><td style=\"word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 20px 0 30px;\" align=\"left\" valign=\"top\">\n\n                <table class=\"row\" style=\"border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;\"><tbody><tr style=\"vertical-align: top; text-align: left; padding: 0;\" align=\"left\"><td class=\"wrapper\" style=\"word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 20px 0px 0px;\" align=\"left\" valign=\"top\">\n\n                      <table class=\"six columns\" style=\"border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 280px; margin: 0 auto; padding: 0;\"><tbody><tr style=\"vertical-align: top; text-align: left; padding: 0;\" align=\"left\"><td style=\"word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 0px 10px;\" align=\"left\" valign=\"top\">\n                            <span class=\"logo\" style=\"font-weight: 500; color: #375474; text-align: center; font-size: 23px; display: inline-block; padding: 10px 0;\"><img src=\"https://everpayinc.com/assets/img/logo/logo.png\" alt=\"Everpay\" /></span>\n                          </td>\n                          <td class=\"expander\" style=\"word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; visibility: hidden; width: 0px; color: #222222; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;\" align=\"left\" valign=\"top\"></td>\n                        </tr></tbody></table></td>\n                    <td class=\"wrapper last\" style=\"word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 0px 0px;\" align=\"left\" valign=\"top\">\n\n                      <table class=\"six columns hide-for-small\" style=\"border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 280px; margin: 0 auto; padding: 0;\"><tbody><tr style=\"vertical-align: top; text-align: left; padding: 0;\" align=\"left\"><td style=\"word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 0px 10px;\" align=\"left\" valign=\"top\">\n                            <span class=\"logo\" style=\"color: #525252; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; font-weight: 500; float: right; display: inline-block; padding: 10px 0;\">Customer Care</span>\n                          </td>\n                          <td class=\"expander\" style=\"word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; visibility: hidden; width: 0px; color: #222222; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;\" align=\"left\" valign=\"top\"></td>\n                        </tr></tbody></table></td>\n                  </tr></tbody></table></td>\n            </tr></tbody></table><div class=\"main-container\" style=\"width: 580px; text-align: inherit; border-radius: 6px; padding-top: 10px; background: #fff; margin: 0 auto; border: 1px solid #cecece;\" align=\"inherit\">\n            <table class=\"container\" style=\"border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: inherit; width: 510px; margin: 0 auto; padding: 0;\"><tbody><tr style=\"vertical-align: top; text-align: left; padding: 0;\" align=\"left\"><td style=\"word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;\" align=\"left\" valign=\"top\">\n\n                  <table class=\"row\" style=\"border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;\"><tbody><tr style=\"vertical-align: top; text-align: left; padding: 0;\" align=\"left\"><td class=\"wrapper last\" style=\"word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 0px 0px;\" align=\"left\" valign=\"top\">\n\n                        <table class=\"twelve columns\" style=\"border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 510px; margin: 0 auto; padding: 0;\"><tbody><tr style=\"vertical-align: top; text-align: left; padding: 0;\" align=\"left\"><td class=\"text-pad\" style=\"word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 10px 10px;\" align=\"left\" valign=\"top\">\n                              <h5 style=\"font-weight: bold; color: #222222; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; text-align: left; line-height: 1.3; word-break: normal; font-size: 24px; margin: 0; padding: 15px 0;\" align=\"left\">Charge #[[CHARGE_ID]]</h5><div>Hi, [[CUSTOMER_FIRST_NAME]] [[CUSTOMER_LAST_NAME]]&nbsp;</div><div><br /><span style=\"font-family: arial, sans-serif; font-size: 12.8000001907349px; line-height: normal;\">Your credit card was successfully charged for [[AMOUNT]] on [[DATE]]</span></div><p style=\"color: #5C5C5C; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; font-weight: normal; text-align: left; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 0 25px;\" align=\"left\"><span style=\"color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8000001907349px; line-height: normal;\">You can find answers to most all support questions and also get in touch with us at&nbsp;</span><a href=\"https://support.stripe.com/\" rel=\"noreferrer\" target=\"_blank\" style=\"color: rgb(17, 85, 204); font-family: arial, sans-serif; font-size: 12.8000001907349px; line-height: normal;\">https://everpayinc.com/support/</a><span style=\"color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 12.8000001907349px; line-height: normal;\">.</span></p>\n                              <p style=\"color: #5C5C5C; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; font-weight: normal; text-align: left; line-height: 19px; font-size: 14px; margin: 0; padding: 0 0 35px;\" align=\"left\">And lastly, tell us your feedback - good and bad, we want to hear from you. You can \n                                reply to this email or write to <a href=\"#\" style=\"text-decoration: none;\">hello@everpayinc.com</a>.</p>\n                              <p style=\"font-weight: 500; color: #222222; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; text-align: left; line-height: 19px; font-size: 14px; margin: 0; padding: 40px 0;\" align=\"left\">\n                                The team at Everpay\n                              </p>\n                            </td>\n                            <td class=\"expander\" style=\"word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; visibility: hidden; width: 0px; color: #222222; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;\" align=\"left\" valign=\"top\"></td>\n                          </tr></tbody></table></td>\n                    </tr></tbody></table>&lt;!-- container end below --&gt;</td>\n              </tr></tbody></table></div>\n\n          <table class=\"container\" style=\"border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: inherit; width: 510px; margin: 0 auto; padding: 0;\"><tbody><tr style=\"vertical-align: top; text-align: left; padding: 0;\" align=\"left\"><td style=\"word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;\" align=\"left\" valign=\"top\">\n\n                <table class=\"row callout\" style=\"border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;\"><tbody><tr style=\"vertical-align: top; text-align: left; padding: 0;\" align=\"left\"><td class=\"wrapper last\" style=\"word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 40px 0px 0px;\" align=\"left\" valign=\"top\">\n\n                        <table class=\"twelve columns\" style=\"border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 510px; margin: 0 auto; padding: 0;\"><tbody><tr style=\"vertical-align: top; text-align: left; padding: 0;\" align=\"left\"><td style=\"word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 0px 10px;\" align=\"left\" valign=\"top\">\n                              <p style=\"text-align: center; font-size: 12px; color: #555; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; font-weight: normal; line-height: 19px; margin: 0; padding: 0 0 10px;\" align=\"center\">\n                                Everpay Corporation</p>\n                              <p style=\"text-align: center; font-size: 12px; color: #555; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; font-weight: normal; line-height: 19px; margin: 0; padding: 0 0 10px;\" align=\"center\"><span style=\"text-align: left; font-weight: bold; color: rgb(106, 106, 106); font-family: arial, sans-serif; font-size: small; line-height: 18.2000007629395px;\">151 Yonge Street</span><span style=\"text-align: left; color: rgb(84, 84, 84); font-family: arial, sans-serif; font-size: small; line-height: 18.2000007629395px;\">, &nbsp;</span><span style=\"text-align: left; font-weight: bold; color: rgb(106, 106, 106); font-family: arial, sans-serif; font-size: small; line-height: 18.2000007629395px;\">Toronto</span><span style=\"text-align: left; color: rgb(84, 84, 84); font-family: arial, sans-serif; font-size: small; line-height: 18.2000007629395px;\">, Ontario, M5C 2W7</span></p>\n                            </td>\n                            <td class=\"expander\" style=\"word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; visibility: hidden; width: 0px; color: #222222; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;\" align=\"left\" valign=\"top\"></td>\n                          </tr></tbody></table></td>\n                    </tr></tbody></table><table class=\"row\" style=\"border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;\"><tbody><tr style=\"vertical-align: top; text-align: left; padding: 0;\" align=\"left\"><td class=\"wrapper last\" style=\"word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #222222; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px;\" align=\"left\" valign=\"top\">\n\n                        <table class=\"twelve columns\" style=\"border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 510px; margin: 0 auto; padding: 0;\"><tbody><tr style=\"vertical-align: top; text-align: left; padding: 0;\" align=\"left\"><td align=\"center\" style=\"word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 0px 10px;\" valign=\"top\">\n                              <center style=\"width: 100%; min-width: 510px;\">\n                                <p style=\"text-align: center; font-size: 12px; color: #222222; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; font-weight: normal; line-height: 19px; margin: 0; padding: 0 0 10px;\" align=\"center\">\n                                  <a href=\"https://everpayinc.com/terms\" style=\"color: #2B7ECB; text-decoration: none;\">Terms</a> | <a href=\"https://everpayinc.com/privacy\" style=\"color: #2B7ECB; text-decoration: none;\">Privacy</a> | <a href=\"#\" style=\"color: #2B7ECB; text-decoration: none;\">Unsubscribe</a>\n                                </p>\n                              </center>\n                            </td>\n                            <td class=\"expander\" style=\"word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; visibility: hidden; width: 0px; color: #222222; font-family: \'Helvetica Neue\', \'Arial\', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;\" align=\"left\" valign=\"top\"></td>\n                          </tr></tbody></table></td>\n                    </tr></tbody></table></td>\n            </tr></tbody></table></center>\n      </td>\n    </tr>\n</tbody></table>\n\n\n', 'Everpay', 'no-reply@everpayinc.com', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `client_fee`
--

CREATE TABLE `client_fee` (
  `client_id` int(11) NOT NULL,
  `single_tiered` varchar(11) NOT NULL,
  `fee_Id` int(11) NOT NULL,
  `fees_Id` int(11) NOT NULL
) ;

--
-- Dumping data for table `client_fee`
--

INSERT INTO `client_fee` (`client_id`, `single_tiered`, `fee_Id`, `fees_Id`) VALUES
(11, 'true', 0, 0),
(11, 'true', 0, 0),
(19, 'true', 1, 0),
(21, 'true', 2, 0),
(24, 'true', 3, 0),
(25, 'true', 4, 0),
(3, 'true', 5, 1),
(8, 'true', 6, 1),
(7, 'true', 7, 1),
(9, 'true', 8, 1),
(6, 'true', 9, 1),
(5, 'false', 10, 1),
(4, 'false', 11, 1),
(3, 'true', 12, 2),
(8, 'true', 13, 2),
(7, 'true', 14, 2),
(9, 'true', 15, 2),
(6, 'true', 16, 2),
(5, 'true', 17, 2),
(4, 'true', 18, 2),
(42, 'true', 19, 3),
(40, 'true', 20, 4);

-- --------------------------------------------------------

--
-- Table structure for table `client_fees`
--

CREATE TABLE `client_fees` (
  `fees_Id` int(11) NOT NULL,
  `service_buyrate_program_id` int(11) NOT NULL
) ;

--
-- Dumping data for table `client_fees`
--

INSERT INTO `client_fees` (`fees_Id`, `service_buyrate_program_id`) VALUES
(0, 0),
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `client_gateways`
--

CREATE TABLE `client_gateways` (
  `client_gateway_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `external_api_id` int(11) NOT NULL,
  `alias` varchar(200) NOT NULL,
  `enabled` tinyint(4) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `create_date` date NOT NULL
) ;

--
-- Dumping data for table `client_gateways`
--

INSERT INTO `client_gateways` (`client_gateway_id`, `client_id`, `external_api_id`, `alias`, `enabled`, `deleted`, `create_date`) VALUES
(1, 1000, 3, 'Pro', 1, 0, '2014-11-13'),
(2, 1000, 20, 'Stripe', 0, 1, '2014-11-15'),
(4, 1000, 20, 'Stripe', 1, 0, '2014-11-25'),
(5, 1007, 3, 'Elektropay Pro', 1, 0, '2014-11-29'),
(6, 1000, 20, 'Stripe', 1, 1, '2014-12-26'),
(7, 1041, 21, 'gaming gateway', 1, 1, '2014-05-22'),
(8, 1026, 22, 'Crystal Payment', 1, 0, '2014-07-02'),
(9, 1000, 22, 'Test Gateway', 1, 0, '2014-12-29'),
(13, 1012, 3, 'PayPal Pro', 0, 0, '2015-01-06'),
(14, 1012, 20, 'Stripe', 1, 0, '2015-01-06'),
(15, 1000, 23, 'Bankea', 1, 1, '2015-01-06'),
(16, 1000, 23, 'Bankea', 1, 0, '2015-01-06'),
(17, 1013, 23, 'Bankea', 1, 0, '2015-01-07'),
(18, 1008, 23, 'Bankea', 1, 0, '2015-01-07'),
(19, 1016, 23, 'Bankea', 1, 0, '2015-01-21'),
(20, 1008, 24, 'Netbillings', 1, 0, '2015-02-07'),
(21, 1069, 22, 'Test', 1, 0, '2015-06-25'),
(22, 1000, 22, 'CP Live', 1, 0, '2015-07-01'),
(23, 1069, 22, 'Test', 1, 0, '2015-06-26'),
(24, 1069, 22, 'Test', 1, 0, '2015-06-26'),
(25, 1036, 22, 'Test', 1, 0, '2015-06-26'),
(26, 1036, 22, 'Test', 1, 0, '2015-06-26'),
(27, 1070, 22, 'Test Account', 0, 0, '2015-06-26'),
(28, 1073, 22, 'Crystal Payments', 1, 0, '2015-07-01'),
(30, 1073, 22, 'test crystal', 1, 0, '2015-07-01'),
(31, 1070, 22, 'Asia Minor-Live', 1, 0, '2015-07-06'),
(32, 1085, 22, 'Test Account', 1, 0, '2015-07-22'),
(33, 1085, 22, 'Live Account-1', 1, 0, '2015-07-22'),
(34, 1100, 22, 'Test Account', 1, 0, '2015-07-31'),
(35, 1100, 22, 'Asia Minor (live)', 0, 0, '2015-07-31');

-- --------------------------------------------------------

--
-- Table structure for table `client_gateway_params`
--

CREATE TABLE `client_gateway_params` (
  `client_gateway_params_id` int(11) NOT NULL,
  `client_gateway_id` int(11) NOT NULL,
  `field` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ;

--
-- Dumping data for table `client_gateway_params`
--

INSERT INTO `client_gateway_params` (`client_gateway_params_id`, `client_gateway_id`, `field`, `value`) VALUES
(1, 1, 'mode', 'RpAL7UEp9zuXN3B2q34prmBNhyCZ26LwrrpjDtTWM70R4k73XDjv1z+UMgVqSXQqUOXbx9EJYIx2w9CoQvlH+Q=='),
(2, 1, 'user', '+JiVfX4PpPr93i4sSpC8Y+bPcpl1hneCIS8RMOjs+t942eI8C4fDEVqJB1TltbwOYIg5SuBH6c2DVPlYAgrQOjPXJt9CUOdTGjtBv6QBeFond19tsBdp4C0gG/hO64X0'),
(3, 1, 'pwd', 'I/15VjLr8x2bSKYLTmDcsBndLBf8vwmQgBdM/FuyFzGeUSdo/SDl/koD+kBKjrSGEeUyypKTiCA3AhI/mxDTcA=='),
(4, 1, 'signature', 'iyvJvjXVd0fS8IAfWNB524WoNzaVu26r9EHTYyhRQzH6WveZXIQhkvKxo0MJXU9LrJXZRbzl3nOl2pa0Lp0Yiry1DAFPAKk0L2+6YprjoXrZVvD8SEOEm1/OYnFdsV72wUFxM+XLwbxmJ7lKxXv+BTJVfxWcknk25kRma/sP6qTlzhIzqEiUq2VBY0TrSlWXvFxKrWPZXkklE4NwkMS9ag=='),
(5, 1, 'currency', '/rm8tFqaHQWUrLq322I2Sw31CpR3xMFuY5kzuAuGEK6++sraqeVvQluKswTrld89t8ScLflu9Ug9Ws6zSDtEpg=='),
(6, 1, 'accept_visa', 'oNjflgYwC7sE1spqRLiuHN/cHvXUi09tSB7e2SDb02/Fa1YKChaQY/YZaUMmXV1N9QEMyrcZvoyyUK9QThIsVQ=='),
(7, 1, 'accept_mc', 'PXXETAH2oNUd1PXM0bkA9nfZgbsABgA4Zwkb+SeTR1SlJRMtWUSuIfEjNC1udOdRfiNUu2Z/cF10GxsqebV7ug=='),
(8, 1, 'accept_discover', 'lTY/SyXVukMBJ86XDJSgz8V4Bi8GjxN5xKGqi6A1nK1ivknoBF/XLJ/JL9XLB6g/4hjmxYeHTK+m4EcHHwYW3A=='),
(9, 1, 'accept_dc', '5d2EzHVYv5JgTQSIT3a4Rmy03v31yFzz9l8RfQIG/31zdmUQ1P80nhsc/1vWu2dLBaH22iBGWwGzCl4Xur9a+w=='),
(10, 1, 'accept_amex', 'QnMRgbk+Llb3O8PP3Q7J5cLkZdx+EWKuUSyFXZy6eCURgYweKQgD2xiqL7yc7wFKiozSMTmkitqeY2ND3rD+0g=='),
(32, 5, 'mode', 'nMxiCzOnY+u3FxuovgJ8mStkZzstB/iBPGJjKTh73sHlB2+1ZwV9BKSNVLda2BaZkVR6Oph+dujadxTuS6F3sw=='),
(31, 4, 'accept_amex', 'Z/DImqgw+Pn9RIlKOLMVBj4euWGZktjEkguo/2460THiqqwAwS+B+BPH+mEzJ4FOQIsbThfO/GyAktzA7ixX3Q=='),
(29, 4, 'accept_mc', 'a8WvrzeRFLn5RjnH/Y6L61ntF9GS3mnAdFOzPF9ibyAkooCxb/hkNuunli8Edy3AYvWeRHDW4IUIbQoVD/IBZQ=='),
(30, 4, 'accept_discover', 'dKHTGGIXnBwPbzXAd4eGPoyI7AE2YE+RAwNbQ/WcvL/m2wWycTlagwHTZrFwxSU+tKQTMeqN3iu4bRKxsp4zkg=='),
(28, 4, 'accept_visa', 'uyfM5sYyrZxLQzyiOC4L6GGazf+gqUA4WeX4Rda0sznFa1YKChaQY/YZaUMmXV1N9QEMyrcZvoyyUK9QThIsVQ=='),
(27, 4, 'live_api_key', 'kLYEy/SfM0eXtPL8TdjCASHF6YVzHMjsXPjAmV70qSl47ukx9uxAXymmMM8SvH1UjbL+hwucqIQIXu2OCJDHBuOaLQya0/gH+0xUk5ApzrLI8Y2a6ZJNXCs/fY2euq6I'),
(26, 4, 'test_api_key', '7nDJFjbjgQVptDnauY5R/VktILP1Y1/CAGEbOzSmvjxvQB+WiwC+ZTlehPwruuR3+nr0y3lz/1Qywo3IBsD3GluBCP+3gX+ImzDHrzo3Xf+c2kaJQJIedS2ANloVYSnh'),
(25, 4, 'mode', 'jaRskxXNjRIOp5XfzwFUwwCGJJWE7XIUdtm+o1R7K18eggnT0KMC2isFEBHrtHfjd+/HA2Wcuqm6crmHB0Qdrg=='),
(33, 5, 'user', 'DQcMZ9lsQCqhnF23d00t2us17I04jYIykd5vc6FtSdgwGls6PhnoEOQyFO7FF12bCnfYHWVCvVfHs8nx6mspPpFoQ2nDgWIBZmIDXcE1zrgN8yflOh8fqV4kll1doosC'),
(34, 5, 'pwd', 'BfCrR1DOdkddDZ42/gdpUu0ms01pgbwRfJPErABHeO4ZquGWDAY3vEFWd5ayQjb5ObCm6X7sjULT9P6iYT8rZA=='),
(35, 5, 'signature', 'Yhor2YNnaZl/nbo60bItphAwzPhxqaJZc4TRwwafObsVDBDJA4xAXBnw75hpm4y/Jzq9GBrgfW3tTh9no7985gP41dzMcbVHT8WxVk6sC4IWMnNRxn63qNMrfefwAqvOlRHiIidbI2rBrcfL0lQa7M2MTq8pigTPdLyaZw9yaFIXPYQifMoyINkr6iZB6FE/bHMrAjwTZzYJUK5Uypj37Q=='),
(36, 5, 'currency', 'kEaqxVC61NOgcQEJhGrgVfU6tolXiRmTS9MmU2ACvfzeRHE5IIuBnQFiqdksJ7JjcCzMmIpLWUlPpAQuWCOZFQ=='),
(37, 5, 'accept_visa', 'FTSeRxCE2KmcIGzLEgBaFNn8wr41jWXgaT78N/KJS/+6waVlctqdTNKQeizm+ahMQVdjbxDUL1DHZnjbYMWpyQ=='),
(38, 5, 'accept_mc', 'xs0LdiUDEzxak/q0iODZxyrj+lE4AuuuAMJ/glmhwIHAz5m2Fu1bW8B0rAxRWYtCpgMtxd2hH33ERekgPGB5QQ=='),
(39, 5, 'accept_discover', 'pfa/c54do4Vfowkm2X29MFHo5sTqBiXPAYYYtYW3cWN4Hj0C+nNFXf20bVhkHDna+7rPUJiOvrmXqe/RALX4ZQ=='),
(40, 5, 'accept_dc', '5rb4T38szGn3slx148D8x0OLmU1ntMLY/B/okBzDscduXchm4YfliYxULqsKYZn/Y1/tbZCOIIYnepCqLMDOow=='),
(41, 5, 'accept_amex', 'k12eg+MSxfD8nLyWNQ/KzIgUXfr+1r7noW1bKnCcfEE2yxU3+cxhg0jBbGIWCmoBABkOyDJR9BbjS/+og/Ae5A=='),
(51, 9, 'endpoint', 'g0NpiSs7T2K4wB16hZAaJfyVrF1HeJbN5HqebDdxoV8c/LMwUMqsK2Sp7VOje+IPiRlApfbp5Nlg6jEmSvD8ug=='),
(50, 9, 'control', 'QzltM7Dzcak9Jl7vlhWxAFWWKqbIsGJ3qML331vUUHN1RgnAQfWOiR37NZP2c4C97v51gpfMfUDoc1jmwGB208jj2fdFGq0hgx8jVIgDL94GBqhPAVrF71ERoZz1TT/44SkQZv4pBozBjqXNUjMdp2SXtGx/Gzb2XmdP4Ip++xo='),
(49, 9, 'mode', 'tYP1ceWud7eT4j0kwqwOENPbqH8+MrHHzLm870053Khukjg4XQblEUtT0FW970cnNLbmxdYSwqZP/fNwYo7EKQ=='),
(84, 13, 'accept_dc', 'OrVvDoMi3QfbEdDGIjNb1RntuJgtzXIus04dRMtraI8WJbHhD726o9Ws+Uoan5VB1s/9gzDb2jSVbo0jgJlKWg=='),
(82, 13, 'accept_mc', 'DT60X22SQX8bB4XJOZuQ+wI1TA0Bj5mndB7jYqC5iBGAVYIsi+GmN486GQeqwZiTgMabBoYGY4arF33FlKBklA=='),
(83, 13, 'accept_discover', 'X1Zj5XUvY3/xNWvcHP1W4sZLiytPtkRv6kcHQjl/it7amjQX1szwvom7NR1OokDS6jtGQV7w237oza1MZ1i+zQ=='),
(80, 13, 'currency', 'tL5kUPsGsW7r5uTTs1m2FNQr9W1eyj1ROtSh5kDNBMjvMQZXp3nvl83oBFzbR3Q1k91IK3G0lZrCVCaK7HFYyw=='),
(81, 13, 'accept_visa', '/CxRVqSdJbzQhDjMmuvnVjoe2IdRDfYQ5b8GlOrHHgkkooCxb/hkNuunli8Edy3AYvWeRHDW4IUIbQoVD/IBZQ=='),
(78, 13, 'pwd', 'S610Lij2k3Gdm9ZOSFxt+836vJ83DHd6wppYuO0TRoCi6mxcXPAVb/EzkU64cOszrR//1bw+Uz3jjFgO5DNm6g=='),
(77, 13, 'user', 'sIfNIYhdx7lVEuHckQJ3kMkRjOqAcVQIE9mfc5IqEPI9KQJUyFcsN4MugFtem/Q9r84xQ3FO2vO0Nqmg8QwiJItuLcCs4658/JGGWaCZGmUXSvvITSkBbHo1vP9eioHR'),
(79, 13, 'signature', '7mfS90kvtoM1IxsuiBpYyNSMlDvE++JT+WkOfw0JVFtPy3VT0/OGIJaNYXPOxDW3cF3JAW5oKYpncf0xP3lOjXfgFEKK3/OR8KhvqkXXNvDA2u8S9oIGjgx+Yb1K6+aml3jWZ+uqt68dMiHwUOadVTo4/nC8aVJKUfco8pt58tck/DKGtQgGCs6Pmn/BVzKyFmXtZOq2h5gjQcSvllMr8A=='),
(76, 13, 'mode', 'K3uNODYYA+OEeGSRPPY8P5h9+qSSDpyfrgmPpiwBw1gpQhTfeP32cfFD5a6fnnGn3ynWkMEL1NT0T2zEO0hviA=='),
(85, 13, 'accept_amex', 'mwBdh/OyS09ejZ3BsyXvfARMWZA6zT3P1QOQpbbWtHg64dhMdKqdU3MQW4MI31C1i/zE4CFwwNcPA7553whe+A=='),
(86, 14, 'mode', '6LUfyojduiELujEwKTNglyghJvFc/oyS6gf6dZ85D4K52n/QIm+YnDTwiVXtNUdAO5rmM469aS4oBt4smoVcNg=='),
(87, 14, 'test_api_key', 'cBmbA13wFfyXnW/fk06u8iYKy/HoCi4k48TKUT9YgtG3tCDEZb6OVKvdikOfTnc01N3v9ijAAdqbz6+rawfPGq7RhGp6AaHx1LTZSVZfv18+bOiPUGGfTYLEGNjK4i25'),
(88, 14, 'live_api_key', '0VGPdw2ADXNRgYq/7IdQnPWSJWVxfP2syYewpAmCBb8xaCOYRT6x/gXD9Toz3OwtEktfBq07XFuT4U3dgij23K+VeFbzdLeSjxtv1nCvVKhtNTZwThA7SBVuOGg8xsh2'),
(89, 14, 'accept_visa', '5IE/Etv4tc4Zmu0RSwaGGxuQA+Gh0x9qmDee6tStZjeAVYIsi+GmN486GQeqwZiTgMabBoYGY4arF33FlKBklA=='),
(90, 14, 'accept_mc', 'pSrQwnNatcmsIEFICD9ah/fkOD3OCZ0ZnlwsMiuLwUiAVYIsi+GmN486GQeqwZiTgMabBoYGY4arF33FlKBklA=='),
(91, 14, 'accept_discover', 'Z+6NmHVs+hsmBZPHWwyGogbWgeHl/Q3WZJdrSl+jSTIWJbHhD726o9Ws+Uoan5VB1s/9gzDb2jSVbo0jgJlKWg=='),
(92, 14, 'accept_amex', 'gn0Xb0MzFBPsDEU659mmr4ApYT8p7CJ1O7maZLuZJXiax+j9/F8kyMxEoqGsJbn2tA3y2bdgmlmvyPZLtzzOUw=='),
(108, 17, 'site_id', '4PmuTJZWsi2Alf7Zj8apGHNTw+U9vt598HmfqmRgpPeWazjdY9YiNYTKiNeSwttDT83LHXmnvBxERaT+p3HA4w=='),
(107, 17, 'site_name', 'j2PN0gSBWxAH0TAGVeWN7x1na+0C+A9FfNMzcv+uiSGGnpWaitAM0bdPDfYqXsU9K0izm52Xd3ZMFcnnr7pxWw=='),
(106, 17, 'mode', 'i1apXKftDWt/43n1yba8kmvTQeqy0EUIOhkV41Cf15J645l0rF3X2+D3uZhOaYLSJ9MtuWrh9lnUTG0mBfU1Ug=='),
(96, 16, 'mode', 'yOfvYECViih6KvgfH5DRRngKT7BnB8iHu++BRnNpasvugmGbWtzZBBfy1AJapwjPnEEYXJ0ZLis3Tryu5HopdA=='),
(97, 16, 'sitename', '/LDW4vMEj/FD4tGRaSBAUxTrn2iRAQO08YI+87YnA38TnHO8FmEU+57+sDKz9rvxsqMkWUC0LaXxp1IJTEa1BmsHP1lVqUftZsbHNqR9w7Kp+Ts3axNGZ8Rt2PxSLGZB'),
(98, 16, 'password', 'wXSYK9i7buCpPYLrxfHxNNPxm+6A8gP8wI9mOTkM4/rtKYJMkyubpHMae4M+l15xFEe7NKFCXQ9nDXEX1cQC7w=='),
(99, 16, 'siteid', '0zUzRqRRl2dkv5ArSsfq6aeDA+f52DGJjzVYS2n5BfAc9HrA2ovtbCjbuVpZYignWeCHV3EqWHmYJ3XKK/lEyA=='),
(100, 16, 'currency', '7rL0B4XqpU+b3kJIX/fN476Hk0B6zn1nqnqQEJR7dUzzXD1GtyDqsDKTnNlKHNtjtJVK7UFWR747aAOlkIe04A=='),
(101, 16, 'accept_visa', 'zL7bJfszZF3c3eT4RaC2i0RO9sGW0JOEi1c6IxRUwAra0MlBEMe7jPIyw0001k/G9MOcM802ntI8h8JGelAiBQ=='),
(102, 16, 'accept_mc', 'mZIRwPJeFzaQR/+dbbu3BHioh05qmrzVOIB1tFqypz064dhMdKqdU3MQW4MI31C1i/zE4CFwwNcPA7553whe+A=='),
(103, 16, 'accept_discover', 'Xm8QaAKIiKvEj8D3ABH386fNdANbLeA6+NqwIQfF2Fr+eyStSnYA7oyyBdXUstM1Qyb9Kzj7u5L1B52Ob3n8Bg=='),
(104, 16, 'accept_dc', 'KvJdA8H5JMMlAWjkQHIj13SiF+IArNIqhjh8TKc2yIsXXXcK2yvz8z87eRC0NdzskV30NAVk3rPx5zYqUvklqg=='),
(105, 16, 'accept_amex', 'zaUnaqZAPgysqBNShazqL28JRPibBEbmOC1HDQ2jvcgXXXcK2yvz8z87eRC0NdzskV30NAVk3rPx5zYqUvklqg=='),
(109, 17, 'password', 'DQkafVYqAHLDD+wAkvEBR2TL161e5E6m3SP5YJkW7fSXh4IZUOKogN293xIiq2LbVOtcIGuqcqHorvpCTpxMbA=='),
(110, 17, 'currency', 'q/R8ZhJ8fv5VtylM9bRfhSP+uz6hUcohKHoGgQJ5s6lO50hoT/mOC/N30EwQyr7Ulj7MQTA95d+uCRSUsRalkw=='),
(111, 17, 'accept_visa', 'CiXanqfwVKoLPFh46TpNLEcpBSMLacz7/A5j2kx/ANGAVYIsi+GmN486GQeqwZiTgMabBoYGY4arF33FlKBklA=='),
(112, 17, 'accept_mc', 'Xu9JRBAundy2ELR3BhEdHil0CV4yQb08a+eib1EoOH1zdmUQ1P80nhsc/1vWu2dLBaH22iBGWwGzCl4Xur9a+w=='),
(113, 17, 'accept_discover', 'kZsi0Wk9uo1a7xzoO6YyU6Gyb+SPXEBeXpHTIYyBrCNzdmUQ1P80nhsc/1vWu2dLBaH22iBGWwGzCl4Xur9a+w=='),
(114, 17, 'accept_dc', '4DRt1NDc42ihC9p+s4VhWUxKX1mvDk/4tYbqVo3vr3EXXXcK2yvz8z87eRC0NdzskV30NAVk3rPx5zYqUvklqg=='),
(115, 17, 'accept_amex', 'lsRXPA8sAaWLiu2N6nyx+8u909J46ddMb1sudg0+t73+eyStSnYA7oyyBdXUstM1Qyb9Kzj7u5L1B52Ob3n8Bg=='),
(116, 18, 'mode', 'vf+b3dXzfUo8dvam5sSpUTN99iNORzeHSkozvxCAE0S8dnXedpavveGQlcU2BJvimEpAgxhHG2bVtfeUmo+WUA=='),
(117, 18, 'site_name', '3WdB6RQOzjgv3lLEz+jNdPORtpDs5fvyRkUkAClvI1i8cGreSxc6N2tOh1hG7E910YXlDqPPEayn8SfjSQXdEg=='),
(118, 18, 'site_id', 'amkP9BvfAvdkOP6ZtAG0nKY9JMAgCk8a7yisle1TbdnYqYyXkSGa6xRpAnnw7M55PgsFFrphkd9IXxQarr8zEQ=='),
(119, 18, 'password', 'eTojjqkuJTSHluSnXQevRiJ81jNQuqFaou1VGgmfE1BRrov2O8jEKRj8hNB8JffFFcZvqPsGhupDAPsE5oUIFw=='),
(120, 18, 'currency', 'rplU9Fz1F9AInfp8O1p9MKkMtG9s167Y7Da70K0oUR3k/QyOBtZwf2FrkmZWvcHBMJD5NcIFlwVpOeLGUZzK5Q=='),
(121, 18, 'accept_visa', 'bi4XjKyJaiBb2Db10TL55fkvoCqM9dtLvpfP5BEtVUeAVYIsi+GmN486GQeqwZiTgMabBoYGY4arF33FlKBklA=='),
(122, 18, 'accept_mc', 'OBYejtT5qLJ8hHXFKjaPxWftA+P5Naf83kVTk+1Q8A4LnA9KbQznU5yrMzhFuZrjclDKU4amRdG1pGUphiWQUg=='),
(123, 18, 'accept_discover', 'RBlK+A0+C+iYd21P/IPZx1ozcPbS41ccH7WnIjz3+7AT4jSNmgMEZdVDWGMSh2lHUOEIKxOVXendpV3jvUeNBA=='),
(124, 18, 'accept_dc', 'GduAlsRxfTWSo1YTDXmlTH6zqxhg2Q2WO71yHgRRpOgVW+Bki/4kuVi4PAcxkD3n7YOxmIMAC7yOQVtuAgRxHw=='),
(125, 18, 'accept_amex', 'V6zI9r/2qJNgnEKVCzc+iCxUGkHdyPnxnrQWBt7vwcVzdmUQ1P80nhsc/1vWu2dLBaH22iBGWwGzCl4Xur9a+w=='),
(126, 19, 'mode', 'ruTiYuQejyRxHJjINtJpDggUXAkQ+oeK1BOmno67+q+mc9idE0kWB2Z2/qOwSWvB6mMcLz3bdtTqKkTjHePoQw=='),
(127, 19, 'site_name', 'IiblCaULWatVn0ibL8QB95HAx+O9FOvhOISMrhYONH4aZ93+7H8dAdilAaivCzjvqK2ro+U2Ifv5rNYWHQ0ddA=='),
(128, 19, 'site_id', 'yqZDc68nvw+xGOJxxd0nuq/08RhqkrazCjT6KGMLyLtgAqLvJU1w8055FMnPVv/EGzRZ3Ld8s0m3bH9JGe90qw=='),
(129, 19, 'password', 'LNWo4jgM0C2MDZrnXxsDflm3jv8N+3Mhx3SeEtD+Ra6hLZlvQXv+OlupYYsMz+xR/nvLOkqXfKzxdHBzRo69kg=='),
(130, 19, 'currency', 'IJnT9ZkHfyD913w6TQef9asTKo7B1WTu/Pyt2ZzOaI+jkCot0MwxQ27S6hyZJMV0BS3I7ONMLhNg937Sg/33HQ=='),
(131, 19, 'accept_visa', 'cz/R+kpCWr3WtmsguiykD+EsqU6I94cnbEX1fLCO+9xkR9DPRMANtd37agNHLNkho2STaEZw/pY5blyk8Do+zw=='),
(132, 19, 'accept_mc', 'yRyiv9VuIERSQxX+b/iT3UH2cZIapU36UemmKeT1YW6AVYIsi+GmN486GQeqwZiTgMabBoYGY4arF33FlKBklA=='),
(133, 19, 'accept_discover', 'a0ydKa+LulnksGULYLv08E6MldJSAMbtGrTSHsh/paUT4jSNmgMEZdVDWGMSh2lHUOEIKxOVXendpV3jvUeNBA=='),
(134, 19, 'accept_dc', 'Z97m56CkfN8iVFIzczrO9t2kOk5cDxy387AjBPwEX+RzdmUQ1P80nhsc/1vWu2dLBaH22iBGWwGzCl4Xur9a+w=='),
(135, 19, 'accept_amex', 'YZDq3lUVKtak64cvysvcJVoxkMRbTO47JXJQbuU1d+YWJbHhD726o9Ws+Uoan5VB1s/9gzDb2jSVbo0jgJlKWg=='),
(136, 20, 'mode', 'oMd4acAyXOlGR6uHSlToSpmA6/KVwRlcBQW+VUnCRptVse2QXDh7wpUtHyGi20J9g3uaY5DOLDu2BPtid9gxiw=='),
(137, 20, 'site_name', 'hIapiRHrRBFZdeLaMDQtOexqigLXa3sSC00qr667HV/4XBvOdEWAfcaBRyUqRGbDU6kLxI+RqbnKVdK+lwf/6A=='),
(138, 20, 'site_id', 'KyZOJ87Tsa7vKZdH0rxkh43AkrTaiY4F57a80xEE1Gj+REQ7pXuLxI1IGRBT/6rBI+wcsOYCL1Sz7VXsWu51GQ=='),
(139, 20, 'password', 'Ff5btf5AmUGgKrtbPivEhVuZWDUS+QeMVBIvT5IOvsRqmQ41Kkq06cjXpGO/FqC0IkYIGCanJbtmrZ3+7KmFdA=='),
(140, 20, 'currency', 'muEaQfcmF6tWPD+Anq3D0XEoRU7TDVnLMPL1owR5oLwFrXpjLik4FdjqZTGfpJ3okxHPjCLnVULuagssrhcZAA=='),
(141, 20, 'accept_visa', 'XAC9ZJPme7ocuc/bZSucdJB/6R8TIT7zhMTNt/pw7V00+oKOy+bJ80EHu3V28cQeoznAAFKQXyVco+mo6a6sHQ=='),
(142, 20, 'accept_mc', 'VT31bQ3+4RKaX8RJRqR6+kLeli5VeKpimhtWpf0nBE2ax+j9/F8kyMxEoqGsJbn2tA3y2bdgmlmvyPZLtzzOUw=='),
(143, 20, 'accept_discover', 'SQnyEeC/T93gtCc3HGFzYx1eIYUjpFMhhW6qIjok+Jujd36gdxfTRMIN1meVOIP0yhc8ssRVsBWk6AS7WWAodA=='),
(144, 20, 'accept_dc', 'UrLcKZXdau0qD8u3MLCOiZa9TZWmUNhOYcctQKhUwYwWJbHhD726o9Ws+Uoan5VB1s/9gzDb2jSVbo0jgJlKWg=='),
(145, 20, 'accept_amex', 'XQsXguVw1yQIXueGNnK6DkOauBsKWzGi63X8nHnLm0AT4jSNmgMEZdVDWGMSh2lHUOEIKxOVXendpV3jvUeNBA=='),
(146, 0, 'control', 'b/2DlY6Q+r9tZa1WiI3qi6mQAktlWc9f8pWPCTzv5j/P4IyG5fmvYD1evAqHCyy85Po5Fz6L9QmdW5tQg0G9IRqg5bsaiXdZZrdc33qiHfPOJ0s7pMUsNuts5Z5F4hKdz8Ng/m56oCshHGuS0jVq3t9beeuIbmTx9qhJbuBwNMw='),
(147, 0, 'endpoint', 'qLYtAnM7skjahnqFG67XUyjaof84c2EaQ5t94w5+gArerYmby28GV8UKKKPlmjQJ8yQiHHMpLepZc/nRUJk4mg=='),
(148, 0, 'mode', 'm/zMOFH6PoDeumuM5uvBwDIJ3zOdzQLovzRPA4NV0MaZvOc3vN5IQqut18p1riLBoxogUVHoUuMw/uOxAJOrLA=='),
(149, 0, 'endpoint', 'qLYtAnM7skjahnqFG67XUyjaof84c2EaQ5t94w5+gArerYmby28GV8UKKKPlmjQJ8yQiHHMpLepZc/nRUJk4mg=='),
(150, 0, 'control', 'b/2DlY6Q+r9tZa1WiI3qi6mQAktlWc9f8pWPCTzv5j/P4IyG5fmvYD1evAqHCyy85Po5Fz6L9QmdW5tQg0G9IRqg5bsaiXdZZrdc33qiHfPOJ0s7pMUsNuts5Z5F4hKdz8Ng/m56oCshHGuS0jVq3t9beeuIbmTx9qhJbuBwNMw='),
(151, 0, 'control', 'b/2DlY6Q+r9tZa1WiI3qi6mQAktlWc9f8pWPCTzv5j/P4IyG5fmvYD1evAqHCyy85Po5Fz6L9QmdW5tQg0G9IRqg5bsaiXdZZrdc33qiHfPOJ0s7pMUsNuts5Z5F4hKdz8Ng/m56oCshHGuS0jVq3t9beeuIbmTx9qhJbuBwNMw='),
(152, 0, 'mode', 'm/zMOFH6PoDeumuM5uvBwDIJ3zOdzQLovzRPA4NV0MaZvOc3vN5IQqut18p1riLBoxogUVHoUuMw/uOxAJOrLA=='),
(153, 0, 'endpoint', 'qLYtAnM7skjahnqFG67XUyjaof84c2EaQ5t94w5+gArerYmby28GV8UKKKPlmjQJ8yQiHHMpLepZc/nRUJk4mg=='),
(154, 0, 'mode', 'm/zMOFH6PoDeumuM5uvBwDIJ3zOdzQLovzRPA4NV0MaZvOc3vN5IQqut18p1riLBoxogUVHoUuMw/uOxAJOrLA=='),
(155, 0, 'mode', 'm/zMOFH6PoDeumuM5uvBwDIJ3zOdzQLovzRPA4NV0MaZvOc3vN5IQqut18p1riLBoxogUVHoUuMw/uOxAJOrLA=='),
(156, 0, 'control', 'b/2DlY6Q+r9tZa1WiI3qi6mQAktlWc9f8pWPCTzv5j/P4IyG5fmvYD1evAqHCyy85Po5Fz6L9QmdW5tQg0G9IRqg5bsaiXdZZrdc33qiHfPOJ0s7pMUsNuts5Z5F4hKdz8Ng/m56oCshHGuS0jVq3t9beeuIbmTx9qhJbuBwNMw='),
(157, 0, 'endpoint', 'qLYtAnM7skjahnqFG67XUyjaof84c2EaQ5t94w5+gArerYmby28GV8UKKKPlmjQJ8yQiHHMpLepZc/nRUJk4mg=='),
(158, 0, 'mode', 'm/zMOFH6PoDeumuM5uvBwDIJ3zOdzQLovzRPA4NV0MaZvOc3vN5IQqut18p1riLBoxogUVHoUuMw/uOxAJOrLA=='),
(159, 0, 'control', 'b/2DlY6Q+r9tZa1WiI3qi6mQAktlWc9f8pWPCTzv5j/P4IyG5fmvYD1evAqHCyy85Po5Fz6L9QmdW5tQg0G9IRqg5bsaiXdZZrdc33qiHfPOJ0s7pMUsNuts5Z5F4hKdz8Ng/m56oCshHGuS0jVq3t9beeuIbmTx9qhJbuBwNMw='),
(160, 0, 'endpoint', 'qLYtAnM7skjahnqFG67XUyjaof84c2EaQ5t94w5+gArerYmby28GV8UKKKPlmjQJ8yQiHHMpLepZc/nRUJk4mg=='),
(161, 0, 'mode', 'm/zMOFH6PoDeumuM5uvBwDIJ3zOdzQLovzRPA4NV0MaZvOc3vN5IQqut18p1riLBoxogUVHoUuMw/uOxAJOrLA=='),
(162, 0, 'control', 'b/2DlY6Q+r9tZa1WiI3qi6mQAktlWc9f8pWPCTzv5j/P4IyG5fmvYD1evAqHCyy85Po5Fz6L9QmdW5tQg0G9IRqg5bsaiXdZZrdc33qiHfPOJ0s7pMUsNuts5Z5F4hKdz8Ng/m56oCshHGuS0jVq3t9beeuIbmTx9qhJbuBwNMw='),
(163, 0, 'endpoint', 'qLYtAnM7skjahnqFG67XUyjaof84c2EaQ5t94w5+gArerYmby28GV8UKKKPlmjQJ8yQiHHMpLepZc/nRUJk4mg=='),
(164, 0, 'mode', '0Hd7+hsrT4TKIm4OFK9T9JPfN9PsEay+W/u8ljOWNTvK3lDSc/Jnnx8CAf7NYjrQhjICWDJSi6eNL1E9SyhYQw=='),
(165, 0, 'control', 'g67qlgp+TnqQhld3vc4IPrzpJChcplW279Y8MOHVoFFun9wHwu8LedJODZ0doPZdZtY4zVTQZT5VHGDuQqEv59GXLQ6dYqgaTw2Rx33Jlw01AFJUbvTUb2YVXQqMptlfOf7mDwlUpMHzijQ3zGBVAgNCkHac1XEFsTROz5hb0dA='),
(166, 0, 'endpoint', 'bt1xpofM7Vrv0zngRUyIXJFKjbOVBfOZ3uB2J1c1FywvbGp69BWQj9cIfx8QCYhjElNEhGdssMMIYm5S+YWCgg=='),
(167, 0, 'mode', '8yFPdl6q8cxFwBEHCDbFxj/0zNxXeYxIKT584hF1PeH7cPJFgxDSoaT2VYsan6gwPqyfTudZgJmMM0KnHOV5Kg=='),
(168, 0, 'control', '70cjJIALBnPbwK55fodnBYHAeRuI5bTYxM9/ewvWKi7LepdgI4RuqZf1e8jxOAyjaKrFq83TqgNdMKEvnYfcT939aGh4g4HUw2DbPBKxG9agdG9QSucMjD3cYP23+lYFAFmEz2rjUpsdLuc5Rf00hZz+7KsKOEquJudCj3AgNSo='),
(169, 0, 'endpoint', 'pMcuGQTxJ0mfgW+WqEfnvszxjyd2LxKH3cEFBGTMse9emSVfWhZ+jRfprKDFpoL/A6puR+RUS9dKv70S145Fgw=='),
(175, 30, 'endpoint', 'Oifk0mVsrGo3PCxzSlXFk4nvnWnml20TcE+U3FON9Mu7UHs8hHRvEnyi5FQFJDRfsqBLr8tWFgYhvG4+rYZYMg=='),
(174, 30, 'control', '74NYZGTTaS31cK1Gz2YtgQ9nYP9dsLKSYpwUjsze0e/L7n6U5c+snqMOQZds656J1G7PziUSNF/fXyzmqgItFXVAjRdp1Xi18sW7RQWHOMUtTDEJF+817Wufc/tnpxod8264QNMonohemP6i9Cx9THD5gFigJMDBwjsUXYyfLZU='),
(173, 30, 'mode', 'S48toAxdrBmj4BfdWVdZcQ8RsfeDqrDUNczo48GvIA8Phi4CeqndLjke3xjW3HCJXjvDFPwNVmToImVZ9JGWvw=='),
(176, 31, 'mode', 'gYeaau2y6Ee9DXrlCIcgjRXx382Q6doXH5xbpHDykXzfRTyULHK8nFq1DtvlnEsEu1+km9Dy+B8YdawztNkeRg=='),
(177, 31, 'control', 'WKyt71cwh1ZxOZqVfiYZJyAiP/QSr3pyVCTKPWvDDc36U0QKrBD63tCBmpRqnuwKiBUGi/1Ey7F1hJfv4uxLnNgmX8CDE6XqXOiCnfZb20/Xc2Q3trlXVc6Frgs13o1xLW7KXIOiGvSPbxdGpbmbfdsCZiqyLDvraIneMAf++B0='),
(178, 31, 'endpoint', 'SWo2Tz6U1LhsCF2AmrzklUBNs3kz8Z5sE4IkoJOVAl2tU2QmsDiDR71wKH0WDDPjWOYImpMCztyHev5W4wpF+Q=='),
(179, 32, 'mode', 'GygA0y5DkGUu9q6r8qlxXSJZycfgakLU8F3KKC5P1Kx2F7pYnWj3Uyvq4CG7J/wiiSk5y9z4ebosu66ELxO1vA=='),
(180, 32, 'control', 'YmeOT3dwggxvo6l0d0vFW1ysImCQKvr1fyPlqpkcC3b1KSz7FrFR+dFyRqmp+BUDasPdmBfcFOwJ7dmnyyd8F7z0vzeYqDA84toe6dInMDFYxuzKn0srOdvtyPE+WhJqIJMy9dnLy0hF46sVn3JCvFK+jknjI36SNxo0sn9qhdU='),
(181, 32, 'endpoint', 'iDZXsQH7VhuySsYQ3bxm+EeqbE1VII4ixvdb0N/MFjueDkP5WOlOp620jBd/4TE9HPta6oUYdgpOywT/RVN4UA=='),
(182, 33, 'mode', 'UFVqKRsu2tHOfNgH60RmJnwu4jRMAysWXkEcKBPM+IoVAOqzotUmW/oDFEMbZLtDcd9azHTgC+LlY2CUrKs6/w=='),
(183, 33, 'control', 'tC+DFAs53ExLEp3kR7sKztJWoQzg04/avB/gpSY0tQMviWlLD8PzdJ1Jk7I7xyamg1J8WwQENJUI0upx++d7Wh+DzsAoP6LlFF8KheTVviW5VH+A38UnmeOsl0tAg3fkkvCcujbNhLNR5qPyuxvKTdURSfF9aQZ0JNDa8rTe5VI='),
(184, 33, 'endpoint', 'NVrrv9LFbibnmncGUf1p+7k9KExyMw+SiM82rXqs+Nq3pztTtJoyTnlHfFLWfZ9oYlGtBnn8arVQlriwBCvqyA=='),
(185, 34, 'mode', 'DfInbpt5GWgCXEoOw5vEH0gyDNYqf9exdkq7Wbtp7QSsMIdSQ4BI5+gF2EB2PUomksf+RQ8u07eHSBizCIi0CQ=='),
(186, 34, 'control', 'XsGHC9+fFtsyAu40ASvqgmrf9queJAL0LxdQfgib7rah/wG0IaJPR9fXX6T1p+nOod/hiidF+m/OvHhlfLqufg=='),
(187, 34, 'endpoint', 'usTPBpMYsvBneAX2SJ0Hop1t73wIcuqLCFi6E4837xf8V1zu1t3Pgg6lpJRzTrqPPs6SYCuRibYPo3grh16S6ZL6li1ltCFf4dSJj+LAsHvd5AwkjxPEJrIwsbXb68LxOc2Vf/eSK6fylmxp1FtxA1VaMTTXiS6nfWwaD2uO6EU='),
(188, 35, 'mode', 'uitzZiuhl3iw4yoXNnXYwgbUj76bJt40HnF2jAejvrnXph9JXZc0lMcFE4XvxL0xieZR8c/+mInPL/LVcJU3Ew=='),
(189, 35, 'control', 'fKLqDRTIzBfKkK294WKRWS+tus+sRqUa4RFvrViUY9Nf5KppG7DIFWtC+SLZdGKDEJ49+CpS0gHThj1W+Imy6OYziTg4jMVc6A6bknnANk76PToZLA14K5pVE0B99eL3pM7TGIXxFm6SHuiWLgXUQY9nyz4am6WpLM28GrzLx5s='),
(190, 35, 'endpoint', '4HsNVip1noePOufhcvEzQxFh6hk3n8SVJxAiDJamye5Faa65n5UvZeghQUMXntJ9KebMqfa695NHN5ox4pMm9g==');

-- --------------------------------------------------------

--
-- Table structure for table `client_log`
--

CREATE TABLE `client_log` (
  `client_log_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `trigger_id` int(11) NOT NULL,
  `client_log_date` datetime NOT NULL,
  `variables` text NOT NULL
) ;

--
-- Dumping data for table `client_log`
--

INSERT INTO `client_log` (`client_log_id`, `client_id`, `trigger_id`, `client_log_date`, `variables`) VALUES
(1, 1000, 9, '2014-11-15 17:08:42', 'a:14:{s:11:\"customer_id\";s:4:\"1001\";s:19:\"customer_first_name\";s:7:\"RICHARD\";s:18:\"customer_last_name\";s:4:\"rowe\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:6:\"ME INC\";s:18:\"customer_address_1\";s:11:\"150 GENDRON\";s:18:\"customer_address_2\";s:0:\"\";s:13:\"customer_city\";s:11:\"Chateaugauy\";s:14:\"customer_state\";s:2:\"QC\";s:20:\"customer_postal_code\";s:6:\"J6J3G6\";s:16:\"customer_country\";s:2:\"CA\";s:14:\"customer_email\";s:17:\"everpay@gmail.com\";s:14:\"customer_phone\";s:0:\"\";s:6:\"amount\";s:4:\"0.00\";}'),
(2, 1000, 9, '2014-11-25 18:21:54', 'a:14:{s:11:\"customer_id\";s:4:\"1002\";s:19:\"customer_first_name\";s:7:\"Richard\";s:18:\"customer_last_name\";s:4:\"Rowe\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:14:\"Elektropay.com\";s:18:\"customer_address_1\";s:11:\"150 GENDRON\";s:18:\"customer_address_2\";s:0:\"\";s:13:\"customer_city\";s:11:\"Chateauguay\";s:14:\"customer_state\";s:2:\"QC\";s:20:\"customer_postal_code\";s:6:\"J6J3G5\";s:16:\"customer_country\";s:2:\"CA\";s:14:\"customer_email\";s:21:\"richie@elektropay.com\";s:14:\"customer_phone\";s:10:\"5146275240\";s:6:\"amount\";s:4:\"0.00\";}'),
(3, 1000, 9, '2014-11-28 22:54:27', 'a:14:{s:11:\"customer_id\";s:4:\"1003\";s:19:\"customer_first_name\";s:3:\"Rob\";s:18:\"customer_last_name\";s:6:\"Rhiner\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:14:\"Elektropay.com\";s:18:\"customer_address_1\";s:11:\"150 GENDRON\";s:18:\"customer_address_2\";s:0:\"\";s:13:\"customer_city\";s:11:\"chateauguay\";s:14:\"customer_state\";s:2:\"QC\";s:20:\"customer_postal_code\";s:6:\"J6J3G5\";s:16:\"customer_country\";s:2:\"CA\";s:14:\"customer_email\";s:19:\"tes1@elektropay.com\";s:14:\"customer_phone\";s:12:\"800-222-6666\";s:6:\"amount\";s:4:\"0.00\";}'),
(4, 1000, 9, '2014-11-28 23:02:48', 'a:14:{s:11:\"customer_id\";s:4:\"1004\";s:19:\"customer_first_name\";s:4:\"Eric\";s:18:\"customer_last_name\";s:6:\"Wilson\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:0:\"\";s:18:\"customer_address_1\";s:0:\"\";s:18:\"customer_address_2\";s:0:\"\";s:13:\"customer_city\";s:8:\"Montreal\";s:14:\"customer_state\";s:2:\"QC\";s:20:\"customer_postal_code\";s:6:\"J6J3G5\";s:16:\"customer_country\";s:2:\"CA\";s:14:\"customer_email\";s:17:\"ew@elektropay.com\";s:14:\"customer_phone\";s:12:\"888-222-6666\";s:6:\"amount\";s:4:\"0.00\";}'),
(5, 1000, 1, '2014-12-02 14:54:44', 'a:17:{s:6:\"amount\";s:6:\"160.00\";s:4:\"date\";s:16:\"2014-12-02 02:54\";s:9:\"charge_id\";s:4:\"1005\";s:14:\"card_last_four\";s:4:\"4242\";s:11:\"customer_id\";s:4:\"1001\";s:19:\"customer_first_name\";s:7:\"Richard\";s:18:\"customer_last_name\";s:4:\"Rowe\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:15:\"Elektropay Inc.\";s:18:\"customer_address_1\";s:11:\"150 GENDRON\";s:18:\"customer_address_2\";s:0:\"\";s:13:\"customer_city\";s:11:\"Chateaugauy\";s:14:\"customer_state\";s:2:\"QC\";s:20:\"customer_postal_code\";s:6:\"J6J3G6\";s:16:\"customer_country\";s:2:\"CA\";s:14:\"customer_email\";s:17:\"everpay@gmail.com\";s:14:\"customer_phone\";s:10:\"5146275240\";}'),
(6, 1000, 9, '2014-12-02 16:57:33', 'a:14:{s:11:\"customer_id\";s:4:\"1005\";s:19:\"customer_first_name\";s:6:\"Rashid\";s:18:\"customer_last_name\";s:3:\"Ali\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:0:\"\";s:18:\"customer_address_1\";s:19:\"125 DES HIRONDELLES\";s:18:\"customer_address_2\";s:0:\"\";s:13:\"customer_city\";s:21:\"SAINT-BASILE-LE-GRAND\";s:14:\"customer_state\";s:2:\"QC\";s:20:\"customer_postal_code\";s:6:\"H3X2G5\";s:16:\"customer_country\";s:2:\"CA\";s:14:\"customer_email\";s:24:\"rashidali@elektropay.com\";s:14:\"customer_phone\";s:0:\"\";s:6:\"amount\";s:4:\"0.00\";}'),
(7, 1000, 1, '2014-12-02 16:57:34', 'a:17:{s:6:\"amount\";s:6:\"222.00\";s:4:\"date\";s:16:\"2014-12-02 04:57\";s:9:\"charge_id\";s:4:\"1006\";s:14:\"card_last_four\";s:4:\"4444\";s:11:\"customer_id\";s:4:\"1005\";s:19:\"customer_first_name\";s:6:\"Rashid\";s:18:\"customer_last_name\";s:3:\"Ali\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:0:\"\";s:18:\"customer_address_1\";s:19:\"125 DES HIRONDELLES\";s:18:\"customer_address_2\";s:0:\"\";s:13:\"customer_city\";s:21:\"SAINT-BASILE-LE-GRAND\";s:14:\"customer_state\";s:2:\"QC\";s:20:\"customer_postal_code\";s:6:\"H3X2G5\";s:16:\"customer_country\";s:2:\"CA\";s:14:\"customer_email\";s:24:\"rashidali@elektropay.com\";s:14:\"customer_phone\";s:0:\"\";}'),
(8, 1000, 9, '2014-12-02 21:21:57', 'a:14:{s:11:\"customer_id\";s:4:\"1006\";s:19:\"customer_first_name\";s:4:\"Mark\";s:18:\"customer_last_name\";s:6:\"Emerys\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:0:\"\";s:18:\"customer_address_1\";s:13:\"120 Miner Dr.\";s:18:\"customer_address_2\";s:0:\"\";s:13:\"customer_city\";s:11:\"Mining Town\";s:14:\"customer_state\";s:2:\"WA\";s:20:\"customer_postal_code\";s:5:\"61666\";s:16:\"customer_country\";s:2:\"US\";s:14:\"customer_email\";s:20:\"amr.e@elektropay.com\";s:14:\"customer_phone\";s:0:\"\";s:6:\"amount\";s:4:\"0.00\";}'),
(9, 1000, 1, '2014-12-02 21:21:58', 'a:17:{s:6:\"amount\";s:6:\"125.00\";s:4:\"date\";s:16:\"2014-12-02 09:21\";s:9:\"charge_id\";s:4:\"1007\";s:14:\"card_last_four\";s:4:\"4444\";s:11:\"customer_id\";s:4:\"1006\";s:19:\"customer_first_name\";s:4:\"Mark\";s:18:\"customer_last_name\";s:6:\"Emerys\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:0:\"\";s:18:\"customer_address_1\";s:13:\"120 Miner Dr.\";s:18:\"customer_address_2\";s:0:\"\";s:13:\"customer_city\";s:11:\"Mining Town\";s:14:\"customer_state\";s:2:\"WA\";s:20:\"customer_postal_code\";s:5:\"61666\";s:16:\"customer_country\";s:2:\"US\";s:14:\"customer_email\";s:20:\"amr.e@elektropay.com\";s:14:\"customer_phone\";s:0:\"\";}'),
(10, 1000, 9, '2014-12-02 22:12:43', 'a:14:{s:11:\"customer_id\";s:4:\"1007\";s:19:\"customer_first_name\";s:7:\"Sedwick\";s:18:\"customer_last_name\";s:7:\"Connors\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:0:\"\";s:18:\"customer_address_1\";s:16:\"212 Railside Rd.\";s:18:\"customer_address_2\";s:0:\"\";s:13:\"customer_city\";s:10:\"montenegro\";s:14:\"customer_state\";s:2:\"AL\";s:20:\"customer_postal_code\";s:5:\"21202\";s:16:\"customer_country\";s:2:\"US\";s:14:\"customer_email\";s:22:\"sedwick@elektropay.com\";s:14:\"customer_phone\";s:0:\"\";s:6:\"amount\";s:4:\"0.00\";}'),
(11, 1000, 1, '2014-12-02 22:12:43', 'a:17:{s:6:\"amount\";s:5:\"23.00\";s:4:\"date\";s:16:\"2014-12-02 10:12\";s:9:\"charge_id\";s:4:\"1008\";s:14:\"card_last_four\";s:4:\"0005\";s:11:\"customer_id\";s:4:\"1007\";s:19:\"customer_first_name\";s:7:\"Sedwick\";s:18:\"customer_last_name\";s:7:\"Connors\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:0:\"\";s:18:\"customer_address_1\";s:16:\"212 Railside Rd.\";s:18:\"customer_address_2\";s:0:\"\";s:13:\"customer_city\";s:10:\"montenegro\";s:14:\"customer_state\";s:2:\"AL\";s:20:\"customer_postal_code\";s:5:\"21202\";s:16:\"customer_country\";s:2:\"US\";s:14:\"customer_email\";s:22:\"sedwick@elektropay.com\";s:14:\"customer_phone\";s:0:\"\";}'),
(12, 1000, 9, '2014-12-02 23:09:02', 'a:14:{s:11:\"customer_id\";s:4:\"1008\";s:19:\"customer_first_name\";s:8:\"Charles \";s:18:\"customer_last_name\";s:6:\"Shultz\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:0:\"\";s:18:\"customer_address_1\";s:15:\"66 Crossing Rd.\";s:18:\"customer_address_2\";s:0:\"\";s:13:\"customer_city\";s:4:\"Iraq\";s:14:\"customer_state\";s:2:\"NY\";s:20:\"customer_postal_code\";s:5:\"10666\";s:16:\"customer_country\";s:2:\"US\";s:14:\"customer_email\";s:24:\"charles.s@elektropay.com\";s:14:\"customer_phone\";s:0:\"\";s:6:\"amount\";s:4:\"0.00\";}'),
(13, 1000, 9, '2014-12-02 23:12:21', 'a:14:{s:11:\"customer_id\";s:4:\"1009\";s:19:\"customer_first_name\";s:5:\"Lance\";s:18:\"customer_last_name\";s:7:\"Rainmen\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:0:\"\";s:18:\"customer_address_1\";s:23:\"1212 Rainmen Family Rd.\";s:18:\"customer_address_2\";s:0:\"\";s:13:\"customer_city\";s:10:\"Long Beach\";s:14:\"customer_state\";s:2:\"CA\";s:20:\"customer_postal_code\";s:5:\"90101\";s:16:\"customer_country\";s:2:\"US\";s:14:\"customer_email\";s:25:\"lance.test@elektropay.com\";s:14:\"customer_phone\";s:0:\"\";s:6:\"amount\";s:4:\"0.00\";}'),
(14, 1000, 9, '2014-12-02 23:14:46', 'a:14:{s:11:\"customer_id\";s:4:\"1010\";s:19:\"customer_first_name\";s:5:\"Paris\";s:18:\"customer_last_name\";s:8:\"Starlett\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:0:\"\";s:18:\"customer_address_1\";s:11:\"55th SW Rd.\";s:18:\"customer_address_2\";s:8:\"Apt 1010\";s:13:\"customer_city\";s:10:\"Los Alamos\";s:14:\"customer_state\";s:2:\"TX\";s:20:\"customer_postal_code\";s:5:\"71054\";s:16:\"customer_country\";s:2:\"US\";s:14:\"customer_email\";s:22:\"paris.s@elektropay.com\";s:14:\"customer_phone\";s:0:\"\";s:6:\"amount\";s:4:\"0.00\";}'),
(15, 1000, 1, '2014-12-02 23:14:47', 'a:17:{s:6:\"amount\";s:5:\"22.00\";s:4:\"date\";s:16:\"2014-12-02 11:14\";s:9:\"charge_id\";s:4:\"1011\";s:14:\"card_last_four\";s:4:\"5100\";s:11:\"customer_id\";s:4:\"1010\";s:19:\"customer_first_name\";s:5:\"Paris\";s:18:\"customer_last_name\";s:8:\"Starlett\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:0:\"\";s:18:\"customer_address_1\";s:11:\"55th SW Rd.\";s:18:\"customer_address_2\";s:8:\"Apt 1010\";s:13:\"customer_city\";s:10:\"Los Alamos\";s:14:\"customer_state\";s:2:\"TX\";s:20:\"customer_postal_code\";s:5:\"71054\";s:16:\"customer_country\";s:2:\"US\";s:14:\"customer_email\";s:22:\"paris.s@elektropay.com\";s:14:\"customer_phone\";s:0:\"\";}'),
(16, 1000, 9, '2014-12-03 00:10:24', 'a:14:{s:11:\"customer_id\";s:4:\"1011\";s:19:\"customer_first_name\";s:4:\"Buck\";s:18:\"customer_last_name\";s:7:\"Rodgers\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:0:\"\";s:18:\"customer_address_1\";s:0:\"\";s:18:\"customer_address_2\";s:0:\"\";s:13:\"customer_city\";s:6:\"Austin\";s:14:\"customer_state\";s:2:\"TX\";s:20:\"customer_postal_code\";s:5:\"70199\";s:16:\"customer_country\";s:2:\"US\";s:14:\"customer_email\";s:23:\"buc.test@elektropay.com\";s:14:\"customer_phone\";s:0:\"\";s:6:\"amount\";s:4:\"0.00\";}'),
(17, 1000, 1, '2014-12-03 00:10:25', 'a:17:{s:6:\"amount\";s:5:\"74.95\";s:4:\"date\";s:16:\"2014-12-03 12:10\";s:9:\"charge_id\";s:4:\"1012\";s:14:\"card_last_four\";s:4:\"5556\";s:11:\"customer_id\";s:4:\"1011\";s:19:\"customer_first_name\";s:4:\"Buck\";s:18:\"customer_last_name\";s:7:\"Rodgers\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:0:\"\";s:18:\"customer_address_1\";s:0:\"\";s:18:\"customer_address_2\";s:0:\"\";s:13:\"customer_city\";s:6:\"Austin\";s:14:\"customer_state\";s:2:\"TX\";s:20:\"customer_postal_code\";s:5:\"70199\";s:16:\"customer_country\";s:2:\"US\";s:14:\"customer_email\";s:23:\"buc.test@elektropay.com\";s:14:\"customer_phone\";s:0:\"\";}'),
(18, 1000, 1, '2014-12-03 12:38:43', 'a:17:{s:6:\"amount\";s:6:\"111.00\";s:4:\"date\";s:16:\"2014-12-03 12:38\";s:9:\"charge_id\";s:4:\"1014\";s:14:\"card_last_four\";s:4:\"4242\";s:11:\"customer_id\";s:4:\"1001\";s:19:\"customer_first_name\";s:7:\"Richard\";s:18:\"customer_last_name\";s:4:\"Rowe\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:15:\"Elektropay Inc.\";s:18:\"customer_address_1\";s:11:\"150 GENDRON\";s:18:\"customer_address_2\";s:0:\"\";s:13:\"customer_city\";s:11:\"Chateaugauy\";s:14:\"customer_state\";s:2:\"QC\";s:20:\"customer_postal_code\";s:6:\"J6J3G6\";s:16:\"customer_country\";s:2:\"CA\";s:14:\"customer_email\";s:17:\"everpay@gmail.com\";s:14:\"customer_phone\";s:10:\"5146275240\";}'),
(19, 1000, 9, '2014-12-03 12:42:41', 'a:14:{s:11:\"customer_id\";s:4:\"1012\";s:19:\"customer_first_name\";s:6:\"Master\";s:18:\"customer_last_name\";s:4:\"Test\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:16:\"Master Card test\";s:18:\"customer_address_1\";s:6:\"master\";s:18:\"customer_address_2\";s:4:\"card\";s:13:\"customer_city\";s:10:\"mastercard\";s:14:\"customer_state\";s:0:\"\";s:20:\"customer_postal_code\";s:6:\"MASTER\";s:16:\"customer_country\";s:2:\"MO\";s:14:\"customer_email\";s:18:\"mastercard@tes.com\";s:14:\"customer_phone\";s:0:\"\";s:6:\"amount\";s:4:\"0.00\";}'),
(20, 1000, 1, '2014-12-03 12:42:42', 'a:17:{s:6:\"amount\";s:6:\"100.00\";s:4:\"date\";s:16:\"2014-12-03 12:42\";s:9:\"charge_id\";s:4:\"1015\";s:14:\"card_last_four\";s:4:\"4444\";s:11:\"customer_id\";s:4:\"1012\";s:19:\"customer_first_name\";s:6:\"Master\";s:18:\"customer_last_name\";s:4:\"Test\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:16:\"Master Card test\";s:18:\"customer_address_1\";s:6:\"master\";s:18:\"customer_address_2\";s:4:\"card\";s:13:\"customer_city\";s:10:\"mastercard\";s:14:\"customer_state\";s:0:\"\";s:20:\"customer_postal_code\";s:6:\"MASTER\";s:16:\"customer_country\";s:2:\"MO\";s:14:\"customer_email\";s:18:\"mastercard@tes.com\";s:14:\"customer_phone\";s:0:\"\";}'),
(21, 1000, 9, '2014-12-03 12:43:41', 'a:14:{s:11:\"customer_id\";s:4:\"1013\";s:19:\"customer_first_name\";s:4:\"AMEX\";s:18:\"customer_last_name\";s:4:\"Test\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:9:\"Amex test\";s:18:\"customer_address_1\";s:4:\"amex\";s:18:\"customer_address_2\";s:4:\"amex\";s:13:\"customer_city\";s:4:\"amex\";s:14:\"customer_state\";s:0:\"\";s:20:\"customer_postal_code\";s:4:\"AMEX\";s:16:\"customer_country\";s:2:\"AS\";s:14:\"customer_email\";s:13:\"amex@test.com\";s:14:\"customer_phone\";s:0:\"\";s:6:\"amount\";s:4:\"0.00\";}'),
(22, 1000, 1, '2014-12-03 12:43:42', 'a:17:{s:6:\"amount\";s:6:\"100.00\";s:4:\"date\";s:16:\"2014-12-03 12:43\";s:9:\"charge_id\";s:4:\"1016\";s:14:\"card_last_four\";s:4:\"0005\";s:11:\"customer_id\";s:4:\"1013\";s:19:\"customer_first_name\";s:4:\"AMEX\";s:18:\"customer_last_name\";s:4:\"Test\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:9:\"Amex test\";s:18:\"customer_address_1\";s:4:\"amex\";s:18:\"customer_address_2\";s:4:\"amex\";s:13:\"customer_city\";s:4:\"amex\";s:14:\"customer_state\";s:0:\"\";s:20:\"customer_postal_code\";s:4:\"AMEX\";s:16:\"customer_country\";s:2:\"AS\";s:14:\"customer_email\";s:13:\"amex@test.com\";s:14:\"customer_phone\";s:0:\"\";}'),
(23, 1000, 9, '2014-12-03 12:44:38', 'a:14:{s:11:\"customer_id\";s:4:\"1014\";s:19:\"customer_first_name\";s:8:\"discover\";s:18:\"customer_last_name\";s:4:\"Test\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:8:\"discover\";s:18:\"customer_address_1\";s:8:\"discover\";s:18:\"customer_address_2\";s:8:\"discover\";s:13:\"customer_city\";s:8:\"discover\";s:14:\"customer_state\";s:0:\"\";s:20:\"customer_postal_code\";s:8:\"DISCOVER\";s:16:\"customer_country\";s:2:\"DK\";s:14:\"customer_email\";s:17:\"discover@test.com\";s:14:\"customer_phone\";s:0:\"\";s:6:\"amount\";s:4:\"0.00\";}'),
(24, 1000, 9, '2014-12-03 12:45:08', 'a:14:{s:11:\"customer_id\";s:4:\"1015\";s:19:\"customer_first_name\";s:8:\"discover\";s:18:\"customer_last_name\";s:4:\"Test\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:8:\"discover\";s:18:\"customer_address_1\";s:8:\"discover\";s:18:\"customer_address_2\";s:8:\"discover\";s:13:\"customer_city\";s:8:\"discover\";s:14:\"customer_state\";s:0:\"\";s:20:\"customer_postal_code\";s:8:\"DISCOVER\";s:16:\"customer_country\";s:2:\"DK\";s:14:\"customer_email\";s:17:\"discover@test.com\";s:14:\"customer_phone\";s:0:\"\";s:6:\"amount\";s:4:\"0.00\";}'),
(25, 1000, 1, '2015-01-06 14:35:40', 'a:17:{s:6:\"amount\";s:6:\"135.00\";s:4:\"date\";s:16:\"2015-01-06 02:35\";s:9:\"charge_id\";s:4:\"1024\";s:14:\"card_last_four\";s:4:\"4242\";s:11:\"customer_id\";s:4:\"1010\";s:19:\"customer_first_name\";s:5:\"Paris\";s:18:\"customer_last_name\";s:8:\"Starlett\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:0:\"\";s:18:\"customer_address_1\";s:11:\"55th SW Rd.\";s:18:\"customer_address_2\";s:8:\"Apt 1010\";s:13:\"customer_city\";s:10:\"Los Alamos\";s:14:\"customer_state\";s:2:\"TX\";s:20:\"customer_postal_code\";s:5:\"71054\";s:16:\"customer_country\";s:2:\"US\";s:14:\"customer_email\";s:22:\"paris.s@elektropay.com\";s:14:\"customer_phone\";s:0:\"\";}'),
(26, 1000, 9, '2015-01-07 03:13:23', 'a:14:{s:11:\"customer_id\";s:4:\"1016\";s:19:\"customer_first_name\";s:4:\"Test\";s:18:\"customer_last_name\";s:4:\"User\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:0:\"\";s:18:\"customer_address_1\";s:11:\"123 Test St\";s:18:\"customer_address_2\";s:0:\"\";s:13:\"customer_city\";s:9:\"Testville\";s:14:\"customer_state\";s:2:\"TX\";s:20:\"customer_postal_code\";s:4:\"1234\";s:16:\"customer_country\";s:2:\"US\";s:14:\"customer_email\";s:13:\"test@test.com\";s:14:\"customer_phone\";s:10:\"1234567890\";s:6:\"amount\";s:4:\"0.00\";}'),
(27, 1000, 9, '2015-01-07 05:45:03', 'a:14:{s:11:\"customer_id\";s:4:\"1017\";s:19:\"customer_first_name\";s:4:\"Test\";s:18:\"customer_last_name\";s:5:\"Card2\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:0:\"\";s:18:\"customer_address_1\";s:11:\"123 Test Rd\";s:18:\"customer_address_2\";s:0:\"\";s:13:\"customer_city\";s:9:\"Testville\";s:14:\"customer_state\";s:2:\"TX\";s:20:\"customer_postal_code\";s:4:\"1234\";s:16:\"customer_country\";s:2:\"US\";s:14:\"customer_email\";s:14:\"test2@test.com\";s:14:\"customer_phone\";s:10:\"1234567890\";s:6:\"amount\";s:4:\"0.00\";}'),
(28, 1008, 9, '2015-01-07 19:28:41', 'a:14:{s:11:\"customer_id\";s:4:\"1018\";s:19:\"customer_first_name\";s:4:\"Test\";s:18:\"customer_last_name\";s:8:\"User2014\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:0:\"\";s:18:\"customer_address_1\";s:15:\"123 TestWood St\";s:18:\"customer_address_2\";s:0:\"\";s:13:\"customer_city\";s:15:\"Testing Springs\";s:14:\"customer_state\";s:2:\"TN\";s:20:\"customer_postal_code\";s:4:\"1234\";s:16:\"customer_country\";s:2:\"US\";s:14:\"customer_email\";s:17:\"test2014@test.com\";s:14:\"customer_phone\";s:10:\"1234567890\";s:6:\"amount\";s:4:\"0.00\";}'),
(29, 1008, 9, '2015-01-07 19:31:03', 'a:14:{s:11:\"customer_id\";s:4:\"1019\";s:19:\"customer_first_name\";s:7:\"Richard\";s:18:\"customer_last_name\";s:4:\"Rowe\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:0:\"\";s:18:\"customer_address_1\";s:11:\"150 GENDRON\";s:18:\"customer_address_2\";s:0:\"\";s:13:\"customer_city\";s:11:\"Chateaugauy\";s:14:\"customer_state\";s:2:\"QC\";s:20:\"customer_postal_code\";s:6:\"J6J3G5\";s:16:\"customer_country\";s:2:\"CA\";s:14:\"customer_email\";s:17:\"everpay@gmail.com\";s:14:\"customer_phone\";s:10:\"5146275240\";s:6:\"amount\";s:4:\"0.00\";}'),
(30, 1008, 9, '2015-01-07 19:36:24', 'a:14:{s:11:\"customer_id\";s:4:\"1020\";s:19:\"customer_first_name\";s:7:\"Richard\";s:18:\"customer_last_name\";s:4:\"ROWE\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:0:\"\";s:18:\"customer_address_1\";s:11:\"150 GENDRON\";s:18:\"customer_address_2\";s:0:\"\";s:13:\"customer_city\";s:11:\"Chateaugauy\";s:14:\"customer_state\";s:2:\"QC\";s:20:\"customer_postal_code\";s:6:\"J6J3G5\";s:16:\"customer_country\";s:2:\"CA\";s:14:\"customer_email\";s:17:\"everpay@gmail.com\";s:14:\"customer_phone\";s:10:\"5146275240\";s:6:\"amount\";s:4:\"0.00\";}'),
(31, 1000, 1, '2015-01-08 04:37:10', 'a:1:{s:6:\"amount\";s:4:\"0.00\";}'),
(32, 1012, 9, '2015-01-09 00:15:54', 'a:14:{s:11:\"customer_id\";s:4:\"1021\";s:19:\"customer_first_name\";s:8:\"customer\";s:18:\"customer_last_name\";s:6:\"test 1\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:2:\"aa\";s:18:\"customer_address_1\";s:4:\"1234\";s:18:\"customer_address_2\";s:3:\"234\";s:13:\"customer_city\";s:3:\"mtl\";s:14:\"customer_state\";s:2:\"QC\";s:20:\"customer_postal_code\";s:6:\"1j3j2k\";s:16:\"customer_country\";s:2:\"CA\";s:14:\"customer_email\";s:29:\"assignmentsdone2014@gmail.com\";s:14:\"customer_phone\";s:8:\"12343256\";s:6:\"amount\";s:4:\"0.00\";}'),
(33, 1012, 1, '2015-01-09 00:15:55', 'a:17:{s:6:\"amount\";s:5:\"45.00\";s:4:\"date\";s:16:\"2015-01-09 12:15\";s:9:\"charge_id\";s:4:\"1085\";s:14:\"card_last_four\";s:4:\"4242\";s:11:\"customer_id\";s:4:\"1021\";s:19:\"customer_first_name\";s:8:\"customer\";s:18:\"customer_last_name\";s:6:\"test 1\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:2:\"aa\";s:18:\"customer_address_1\";s:4:\"1234\";s:18:\"customer_address_2\";s:3:\"234\";s:13:\"customer_city\";s:3:\"mtl\";s:14:\"customer_state\";s:2:\"QC\";s:20:\"customer_postal_code\";s:6:\"1j3j2k\";s:16:\"customer_country\";s:2:\"CA\";s:14:\"customer_email\";s:29:\"assignmentsdone2014@gmail.com\";s:14:\"customer_phone\";s:8:\"12343256\";}'),
(34, 1008, 9, '2015-01-16 16:47:30', 'a:14:{s:11:\"customer_id\";s:4:\"1022\";s:19:\"customer_first_name\";s:4:\"Aziz\";s:18:\"customer_last_name\";s:3:\"Ali\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:11:\"EZRX Pharma\";s:18:\"customer_address_1\";s:16:\"Thorasvej 10,3,2\";s:18:\"customer_address_2\";s:0:\"\";s:13:\"customer_city\";s:9:\"kobenhavn\";s:14:\"customer_state\";s:2:\"NV\";s:20:\"customer_postal_code\";s:4:\"2400\";s:16:\"customer_country\";s:2:\"DK\";s:14:\"customer_email\";s:13:\"Test@test.com\";s:14:\"customer_phone\";s:10:\"4540526638\";s:6:\"amount\";s:4:\"0.00\";}'),
(35, 1008, 9, '2015-01-16 16:51:26', 'a:14:{s:11:\"customer_id\";s:4:\"1023\";s:19:\"customer_first_name\";s:4:\"John\";s:18:\"customer_last_name\";s:8:\"Mogensen\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:11:\"EZRX Pharma\";s:18:\"customer_address_1\";s:19:\"Christians torv 117\";s:18:\"customer_address_2\";s:0:\"\";s:13:\"customer_city\";s:12:\"solrod stand\";s:14:\"customer_state\";s:2:\"NV\";s:20:\"customer_postal_code\";s:4:\"2680\";s:16:\"customer_country\";s:2:\"DK\";s:14:\"customer_email\";s:13:\"Test@test.com\";s:14:\"customer_phone\";s:10:\"4258192790\";s:6:\"amount\";s:4:\"0.00\";}'),
(36, 1000, 9, '2015-01-21 11:50:05', 'a:14:{s:11:\"customer_id\";s:4:\"1024\";s:19:\"customer_first_name\";s:5:\"Buck \";s:18:\"customer_last_name\";s:7:\"Rodgers\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:9:\"Buck Inc.\";s:18:\"customer_address_1\";s:14:\"12345 Downy St\";s:18:\"customer_address_2\";s:8:\"apt: 666\";s:13:\"customer_city\";s:6:\"myowne\";s:14:\"customer_state\";s:2:\"CA\";s:20:\"customer_postal_code\";s:5:\"90120\";s:16:\"customer_country\";s:2:\"US\";s:14:\"customer_email\";s:21:\"buck.r@everpayinc.com\";s:14:\"customer_phone\";s:12:\"514-666-1234\";s:6:\"amount\";s:4:\"0.00\";}'),
(37, 1000, 1, '2015-01-21 11:50:06', 'a:17:{s:6:\"amount\";s:5:\"35.00\";s:4:\"date\";s:16:\"2015-01-21 11:50\";s:9:\"charge_id\";s:4:\"1089\";s:14:\"card_last_four\";s:4:\"4242\";s:11:\"customer_id\";s:4:\"1024\";s:19:\"customer_first_name\";s:5:\"Buck \";s:18:\"customer_last_name\";s:7:\"Rodgers\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:9:\"Buck Inc.\";s:18:\"customer_address_1\";s:14:\"12345 Downy St\";s:18:\"customer_address_2\";s:8:\"apt: 666\";s:13:\"customer_city\";s:6:\"myowne\";s:14:\"customer_state\";s:2:\"CA\";s:20:\"customer_postal_code\";s:5:\"90120\";s:16:\"customer_country\";s:2:\"US\";s:14:\"customer_email\";s:21:\"buck.r@everpayinc.com\";s:14:\"customer_phone\";s:12:\"514-666-1234\";}'),
(38, 1008, 9, '2015-01-21 18:17:51', 'a:14:{s:11:\"customer_id\";s:4:\"1025\";s:19:\"customer_first_name\";s:6:\"hussin\";s:18:\"customer_last_name\";s:9:\"alhashimi\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:10:\"ezrxpharma\";s:18:\"customer_address_1\";s:11:\"Lungbyej 87\";s:18:\"customer_address_2\";s:0:\"\";s:13:\"customer_city\";s:10:\"Copenhagen\";s:14:\"customer_state\";s:0:\"\";s:20:\"customer_postal_code\";s:4:\"2100\";s:16:\"customer_country\";s:2:\"DK\";s:14:\"customer_email\";s:23:\"pillsrxonline@gmail.com\";s:14:\"customer_phone\";s:10:\"4560813581\";s:6:\"amount\";s:4:\"0.00\";}'),
(39, 1016, 9, '2015-01-21 18:37:02', 'a:14:{s:11:\"customer_id\";s:4:\"1026\";s:19:\"customer_first_name\";s:6:\"Hussin\";s:18:\"customer_last_name\";s:9:\"Alhashimi\";s:20:\"customer_internal_id\";s:0:\"\";s:16:\"customer_company\";s:0:\"\";s:18:\"customer_address_1\";s:11:\"Lungbyej 87\";s:18:\"customer_address_2\";s:0:\"\";s:13:\"customer_city\";s:10:\"Copenhagen\";s:14:\"customer_state\";s:2:\"NV\";s:20:\"customer_postal_code\";s:4:\"2100\";s:16:\"customer_country\";s:2:\"DK\";s:14:\"customer_email\";s:24:\"hussain.a@everpayinc.com\";s:14:\"customer_phone\";s:10:\"4560813581\";s:6:\"amount\";s:4:\"0.00\";}'),
(0, 1034, 9, '2015-04-25 12:02:24', 'a:1:{s:6:\"amount\";s:4:\"0.00\";}'),
(0, 1034, 9, '2015-04-25 12:19:26', 'a:1:{s:6:\"amount\";s:4:\"0.00\";}'),
(0, 1000, 1, '2015-07-01 08:51:02', 'a:1:{s:6:\"amount\";s:4:\"0.00\";}'),
(0, 1000, 1, '2015-07-01 08:57:05', 'a:1:{s:6:\"amount\";s:4:\"0.00\";}'),
(0, 1073, 1, '2015-07-01 14:52:33', 'a:1:{s:6:\"amount\";s:4:\"0.00\";}'),
(0, 1073, 1, '2015-07-01 14:53:17', 'a:1:{s:6:\"amount\";s:4:\"0.00\";}'),
(0, 1000, 1, '2015-07-02 10:43:06', 'a:1:{s:6:\"amount\";s:4:\"0.00\";}'),
(0, 1000, 1, '2015-07-14 01:32:38', 'a:1:{s:6:\"amount\";s:4:\"0.00\";}'),
(0, 1000, 1, '2015-07-14 01:35:48', 'a:1:{s:6:\"amount\";s:4:\"0.00\";}'),
(0, 1000, 1, '2015-07-23 07:03:19', 'a:1:{s:6:\"amount\";s:4:\"0.00\";}'),
(0, 1000, 1, '2015-08-18 04:05:31', 'a:1:{s:6:\"amount\";s:4:\"0.00\";}'),
(0, 1085, 1, '2015-08-18 07:04:42', 'a:1:{s:6:\"amount\";s:4:\"0.00\";}'),
(0, 1085, 1, '2015-08-18 07:06:01', 'a:1:{s:6:\"amount\";s:4:\"0.00\";}'),
(0, 1000, 1, '2015-08-25 08:35:52', 'a:17:{s:6:\"amount\";s:5:\"50.00\";s:4:\"date\";s:16:\"2015-08-25 08:35\";s:9:\"charge_id\";s:4:\"1238\";s:14:\"card_last_four\";s:4:\"4242\";s:11:\"customer_id\";s:4:\"1073\";s:19:\"customer_first_name\";s:15:\"Jitesh Tukadiya\";s:18:\"customer_last_name\";s:0:\"\";s:20:\"customer_internal_id\";s:3:\"123\";s:16:\"customer_company\";s:0:\"\";s:18:\"customer_address_1\";s:3:\"123\";s:18:\"customer_address_2\";s:4:\"1231\";s:13:\"customer_city\";s:9:\"ahmedabad\";s:14:\"customer_state\";s:2:\"GJ\";s:20:\"customer_postal_code\";s:6:\"123456\";s:16:\"customer_country\";s:2:\"IN\";s:14:\"customer_email\";s:0:\"\";s:14:\"customer_phone\";s:0:\"\";}'),
(0, 1000, 1, '2015-08-25 09:05:02', 'a:1:{s:6:\"amount\";s:4:\"0.00\";}'),
(0, 1000, 1, '2015-08-25 09:07:10', 'a:1:{s:6:\"amount\";s:4:\"0.00\";}'),
(0, 1000, 1, '2015-08-26 11:38:39', 'a:1:{s:6:\"amount\";s:4:\"0.00\";}'),
(0, 1085, 1, '2015-08-26 15:30:09', 'a:1:{s:6:\"amount\";s:4:\"0.00\";}'),
(0, 1000, 1, '2015-08-26 19:56:21', 'a:1:{s:6:\"amount\";s:4:\"0.00\";}'),
(0, 1000, 1, '2015-08-28 04:26:10', 'a:1:{s:6:\"amount\";s:4:\"0.00\";}');

-- --------------------------------------------------------

--
-- Table structure for table `client_social`
--

CREATE TABLE `client_social` (
  `client_social_id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `client_id` int(11) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `client_types`
--

CREATE TABLE `client_types` (
  `client_type_id` int(11) NOT NULL,
  `description` varchar(20) NOT NULL
) ;

--
-- Dumping data for table `client_types`
--

INSERT INTO `client_types` (`client_type_id`, `description`) VALUES
(1, 'Service Provider'),
(2, 'End User'),
(3, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment` text
) ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment`) VALUES
('&lt;h4&gt;Thank you for Purchasing Stock Manager Advance 2.3 with POS Module &lt;/h4&gt;\r\n&lt;p&gt;\r\n              This is latest the latest release of Stock Manager Advance.\r\n&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `commerce_sessions`
--

CREATE TABLE `commerce_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ;

--
-- Dumping data for table `commerce_sessions`
--

INSERT INTO `commerce_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('b21d9466476beebd809107328cbfa30f', '108.167.191.197', 'Wget/1.12 (linux-gnu)', 1440882901, ''),
('be0e500e760cb64c8e9a04a59247c6a8', '52.3.70.57', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36', 1440882952, ''),
('8c8f35cd97e4b167d06773e18062d588', '52.4.250.6', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36', 1440882952, ''),
('62ab4c4d09d5c62cad201c7db6c5bd53', '66.249.65.178', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_3 like Mac OS', 1440883785, ''),
('a13330b5a00df97492ea6cec8273af74', '108.167.191.197', 'Wget/1.12 (linux-gnu)', 1440883801, ''),
('e37704e9c761888ab36d59d9a16ea35a', '66.249.65.178', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://ww', 1440884422, ''),
('45e25455705a146b155b042f790a8527', '108.167.191.197', 'Wget/1.12 (linux-gnu)', 1440884701, ''),
('69926fee15d59e1499f34fe6a4772427', '66.249.73.208', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://ww', 1440885172, ''),
('4343e79afd9ff195ca1bead7e728d3e1', '108.167.191.197', 'Wget/1.12 (linux-gnu)', 1440885602, ''),
('4b7de247c7dec10068fb715a4908078e', '108.167.191.197', 'Wget/1.12 (linux-gnu)', 1440886501, ''),
('a4ba312157fa03aed983906756f69585', '207.90.2.16', '=Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) A', 1440886911, ''),
('381991deed8803553e3572071ade28c6', '108.167.191.197', 'Wget/1.12 (linux-gnu)', 1440887401, ''),
('05bcbf0281bfc3e0203e2ea9a4c641e6', '182.50.130.79', '0', 1440888273, ''),
('7f46f9c8a0b23e718efbefe8dcbe1543', '108.167.191.197', 'Wget/1.12 (linux-gnu)', 1440888301, ''),
('b7e746fb9f280f917ee3bf3fa55bf226', '74.12.221.150', 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (K', 1440888529, 'a:3:{s:10:\"login_time\";s:10:\"1440888717\";s:7:\"notices\";s:0:\"\";s:9:\"client_id\";s:4:\"1068\";}'),
('4adada79de1ec72bf4927eea0af3a67f', '108.167.191.197', 'Wget/1.12 (linux-gnu)', 1440889202, ''),
('04563b29458f55a9bdd4ee36ba1575e8', '203.171.241.154', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1440891113, 'a:2:{s:10:\"login_time\";s:10:\"1440891113\";s:7:\"notices\";s:0:\"\";}'),
('578d5df51f12be5b64356c78cd7eacca', '108.167.191.197', 'Wget/1.12 (linux-gnu)', 1440891901, ''),
('0e99da3b06ef4d62c9029a3622e42105', '66.249.65.185', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://ww', 1440892382, ''),
('1c7f852159f1d22531190e6cb2541bac', '108.167.191.197', 'Wget/1.12 (linux-gnu)', 1440892802, ''),
('0d1eb65219e7565a289c0e1118195a5c', '108.167.191.197', 'Wget/1.12 (linux-gnu)', 1440893701, ''),
('b1e02c3a7fb82f3f98877cc9b63017a4', '180.76.15.31', 'Mozilla/5.0 (compatible; Baiduspider/2.0; +http://', 1440894176, ''),
('8ecc1f51a6131245e9f65a3da308739a', '108.167.191.197', 'Wget/1.12 (linux-gnu)', 1440894601, ''),
('0619a2e207a384086babb024dcc313b3', '23.31.168.25', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko', 1440894931, ''),
('85752bbf9827d3c8fe6771550de4ad73', '108.167.191.197', 'Wget/1.12 (linux-gnu)', 1440895501, ''),
('a21ec201ec1d755cfa2972120453070b', '108.167.191.197', 'Wget/1.12 (linux-gnu)', 1440896402, ''),
('f544833b82be9147a1e9dd21473fa52c', '54.93.69.53', 'Mozilla/5.0 (compatible; Cliqzbot/1.0 +http://cliq', 1440896414, ''),
('d166d10a7f0715705c5a3b64965dbc11', '108.167.191.197', 'Wget/1.12 (linux-gnu)', 1440897301, ''),
('9f4bc5783ce98b639d6ff85195683c79', '54.93.69.164', 'Mozilla/5.0 (compatible; Cliqzbot/1.0 +http://cliq', 1440897970, ''),
('822cc7cbb492812320ae393111a6a68e', '66.249.65.181', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://ww', 1440897982, ''),
('044a3a548fe8ae1964e3144f03169cca', '108.167.191.197', 'Wget/1.12 (linux-gnu)', 1440898201, ''),
('78053b62d115b81fe5c148f7937571cb', '108.167.191.197', 'Wget/1.12 (linux-gnu)', 1440899101, ''),
('38fb28ff54fb2669d860dc01d7b16f75', '180.76.15.150', 'Mozilla/5.0 (compatible; Baiduspider/2.0; +http://', 1440899439, ''),
('61787d50390aca05cb877dccf4126dd8', '180.76.15.33', 'Mozilla/5.0 (compatible; Baiduspider/2.0; +http://', 1440899487, ''),
('b47965779cd086f3ed1a7dc1d44366ab', '108.167.191.197', 'Wget/1.12 (linux-gnu)', 1440900002, ''),
('9ecbf2c69d1f8dc199cb8577317a40a9', '108.167.191.197', 'Wget/1.12 (linux-gnu)', 1440890102, ''),
('397297907dcaf91132ff091a99b24c4d', '108.167.191.197', 'Wget/1.12 (linux-gnu)', 1440891001, ''),
('17b3a7eb6eaf88379987383294200635', '66.249.65.185', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://ww', 1440890072, ''),
('4e80cd482026d52089d7fa44342eaae1', '66.249.73.208', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://ww', 1440890060, ''),
('06745d33e3f4c8db929a894854083f88', '66.249.65.185', 'Mozilla/5.0 (iPhone; CPU iPhone OS 8_3 like Mac OS', 1440890070, '');

-- --------------------------------------------------------

--
-- Table structure for table `confirm_links`
--

CREATE TABLE `confirm_links` (
  `id` int(11) NOT NULL,
  `link` char(32) NOT NULL,
  `for_order` int(10) UNSIGNED NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT '0'
) ;

-- --------------------------------------------------------

--
-- Table structure for table `cookie_law`
--

CREATE TABLE `cookie_law` (
  `id` int(10) UNSIGNED NOT NULL,
  `link` varchar(255) NOT NULL,
  `theme` varchar(20) NOT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT '0'
) ;

-- --------------------------------------------------------

--
-- Table structure for table `cookie_law_translations`
--

CREATE TABLE `cookie_law_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `message` varchar(255) NOT NULL,
  `button_text` varchar(50) NOT NULL,
  `learn_more` varchar(50) NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(11) UNSIGNED NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL,
  `iso2` varchar(2) NOT NULL,
  `iso3` varchar(3) NOT NULL,
  `name` varchar(255) NOT NULL
) ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `iso2`, `iso3`, `name`) VALUES
(4, 'AF', 'AFG', 'Afghanistan'),
(248, 'AX', 'ALA', 'Aland Islands'),
(8, 'AL', 'ALB', 'Albania'),
(12, 'DZ', 'DZA', 'Algeria'),
(16, 'AS', 'ASM', 'American Samoa'),
(20, 'AD', 'AND', 'Andorra'),
(24, 'AO', 'AGO', 'Angola'),
(660, 'AI', 'AIA', 'Anguilla'),
(10, 'AQ', 'ATA', 'Antarctica'),
(28, 'AG', 'ATG', 'Antigua and Barbuda'),
(32, 'AR', 'ARG', 'Argentina'),
(51, 'AM', 'ARM', 'Armenia'),
(533, 'AW', 'ABW', 'Aruba'),
(36, 'AU', 'AUS', 'Australia'),
(40, 'AT', 'AUT', 'Austria'),
(31, 'AZ', 'AZE', 'Azerbaijan'),
(44, 'BS', 'BHS', 'Bahamas'),
(48, 'BH', 'BHR', 'Bahrain'),
(50, 'BD', 'BGD', 'Bangladesh'),
(52, 'BB', 'BRB', 'Barbados'),
(112, 'BY', 'BLR', 'Belarus'),
(56, 'BE', 'BEL', 'Belgium'),
(84, 'BZ', 'BLZ', 'Belize'),
(204, 'BJ', 'BEN', 'Benin'),
(60, 'BM', 'BMU', 'Bermuda'),
(64, 'BT', 'BTN', 'Bhutan'),
(68, 'BO', 'BOL', 'Bolivia'),
(70, 'BA', 'BIH', 'Bosnia and Herzegovina'),
(72, 'BW', 'BWA', 'Botswana'),
(74, 'BV', 'BVT', 'Bouvet Island'),
(76, 'BR', 'BRA', 'Brazil'),
(86, 'IO', 'IOT', 'British Indian Ocean Territory'),
(96, 'BN', 'BRN', 'Brunei Darussalam'),
(100, 'BG', 'BGR', 'Bulgaria'),
(854, 'BF', 'BFA', 'Burkina Faso'),
(108, 'BI', 'BDI', 'Burundi'),
(116, 'KH', 'KHM', 'Cambodia'),
(120, 'CM', 'CMR', 'Cameroon'),
(124, 'CA', 'CAN', 'Canada'),
(132, 'CV', 'CPV', 'Cape Verde'),
(136, 'KY', 'CYM', 'Cayman Islands'),
(140, 'CF', 'CAF', 'Central African Republic'),
(148, 'TD', 'TCD', 'Chad'),
(152, 'CL', 'CHL', 'Chile'),
(156, 'CN', 'CHN', 'China'),
(162, 'CX', 'CXR', 'Christmas Island'),
(166, 'CC', 'CCK', 'Cocos (Keeling) Islands'),
(170, 'CO', 'COL', 'Colombia'),
(174, 'KM', 'COM', 'Comoros'),
(178, 'CG', 'COG', 'Congo'),
(180, 'CD', 'COD', 'Congo, Democratic Republic of the'),
(184, 'CK', 'COK', 'Cook Islands'),
(188, 'CR', 'CRI', 'Costa Rica'),
(384, 'CI', 'CIV', 'Cote d\'Ivoire'),
(191, 'HR', 'HRV', 'Croatia'),
(192, 'CU', 'CUB', 'Cuba'),
(196, 'CY', 'CYP', 'Cyprus'),
(203, 'CZ', 'CZE', 'Czech Republic'),
(208, 'DK', 'DNK', 'Denmark'),
(262, 'DJ', 'DJI', 'Djibouti'),
(212, 'DM', 'DMA', 'Dominica'),
(214, 'DO', 'DOM', 'Dominican Republic'),
(218, 'EC', 'ECU', 'Ecuador'),
(818, 'EG', 'EGY', 'Egypt'),
(222, 'SV', 'SLV', 'El Salvador'),
(226, 'GQ', 'GNQ', 'Equatorial Guinea'),
(232, 'ER', 'ERI', 'Eritrea'),
(233, 'EE', 'EST', 'Estonia'),
(231, 'ET', 'ETH', 'Ethiopia'),
(238, 'FK', 'FLK', 'Falkland Islands (Malvinas)'),
(234, 'FO', 'FRO', 'Faroe Islands'),
(242, 'FJ', 'FJI', 'Fiji'),
(246, 'FI', 'FIN', 'Finland'),
(250, 'FR', 'FRA', 'France'),
(254, 'GF', 'GUF', 'French Guiana'),
(258, 'PF', 'PYF', 'French Polynesia'),
(260, 'TF', 'ATF', 'French Southern Territories'),
(266, 'GA', 'GAB', 'Gabon'),
(270, 'GM', 'GMB', 'Gambia'),
(268, 'GE', 'GEO', 'Georgia'),
(276, 'DE', 'DEU', 'Germany'),
(288, 'GH', 'GHA', 'Ghana'),
(292, 'GI', 'GIB', 'Gibraltar'),
(300, 'GR', 'GRC', 'Greece'),
(304, 'GL', 'GRL', 'Greenland'),
(308, 'GD', 'GRD', 'Grenada'),
(312, 'GP', 'GLP', 'Guadeloupe'),
(316, 'GU', 'GUM', 'Guam'),
(320, 'GT', 'GTM', 'Guatemala'),
(831, 'GG', 'GGY', 'Guernsey'),
(324, 'GN', 'GIN', 'Guinea'),
(624, 'GW', 'GNB', 'Guinea-Bissau'),
(328, 'GY', 'GUY', 'Guyana'),
(332, 'HT', 'HTI', 'Haiti'),
(334, 'HM', 'HMD', 'Heard Island and McDonald Islands'),
(336, 'VA', 'VAT', 'Holy See (Vatican City State)'),
(340, 'HN', 'HND', 'Honduras'),
(344, 'HK', 'HKG', 'Hong Kong'),
(348, 'HU', 'HUN', 'Hungary'),
(352, 'IS', 'ISL', 'Iceland'),
(356, 'IN', 'IND', 'India'),
(360, 'ID', 'IDN', 'Indonesia'),
(364, 'IR', 'IRN', 'Iran, Islamic Republic of'),
(368, 'IQ', 'IRQ', 'Iraq'),
(372, 'IE', 'IRL', 'Ireland'),
(833, 'IM', 'IMN', 'Isle of Man'),
(376, 'IL', 'ISR', 'Israel'),
(380, 'IT', 'ITA', 'Italy'),
(388, 'JM', 'JAM', 'Jamaica'),
(392, 'JP', 'JPN', 'Japan'),
(832, 'JE', 'JEY', 'Jersey'),
(400, 'JO', 'JOR', 'Jordan'),
(398, 'KZ', 'KAZ', 'Kazakhstan'),
(404, 'KE', 'KEN', 'Kenya'),
(296, 'KI', 'KIR', 'Kiribati'),
(408, 'KP', 'PRK', 'Korea, Democratic People\'s Republic of'),
(410, 'KR', 'KOR', 'Korea, Republic of'),
(414, 'KW', 'KWT', 'Kuwait'),
(417, 'KG', 'KGZ', 'Kyrgyzstan'),
(418, 'LA', 'LAO', 'Lao People\'s Democratic Republic'),
(428, 'LV', 'LVA', 'Latvia'),
(422, 'LB', 'LBN', 'Lebanon'),
(426, 'LS', 'LSO', 'Lesotho'),
(430, 'LR', 'LBR', 'Liberia'),
(434, 'LY', 'LBY', 'Libyan Arab Jamahiriya'),
(438, 'LI', 'LIE', 'Liechtenstein'),
(440, 'LT', 'LTU', 'Lithuania'),
(442, 'LU', 'LUX', 'Luxembourg'),
(446, 'MO', 'MAC', 'Macao'),
(807, 'MK', 'MKD', 'Macedonia, the former Yugoslav Republic of'),
(450, 'MG', 'MDG', 'Madagascar'),
(454, 'MW', 'MWI', 'Malawi'),
(458, 'MY', 'MYS', 'Malaysia'),
(462, 'MV', 'MDV', 'Maldives'),
(466, 'ML', 'MLI', 'Mali'),
(470, 'MT', 'MLT', 'Malta'),
(584, 'MH', 'MHL', 'Marshall Islands'),
(474, 'MQ', 'MTQ', 'Martinique'),
(478, 'MR', 'MRT', 'Mauritania'),
(480, 'MU', 'MUS', 'Mauritius'),
(175, 'YT', 'MYT', 'Mayotte'),
(484, 'MX', 'MEX', 'Mexico'),
(583, 'FM', 'FSM', 'Micronesia, Federated States of'),
(498, 'MD', 'MDA', 'Moldova'),
(492, 'MC', 'MCO', 'Monaco'),
(496, 'MN', 'MNG', 'Mongolia'),
(499, 'ME', 'MNE', 'Montenegro'),
(500, 'MS', 'MSR', 'Montserrat'),
(504, 'MA', 'MAR', 'Morocco'),
(508, 'MZ', 'MOZ', 'Mozambique'),
(104, 'MM', 'MMR', 'Myanmar'),
(516, 'NA', 'NAM', 'Namibia'),
(520, 'NR', 'NRU', 'Nauru'),
(524, 'NP', 'NPL', 'Nepal'),
(528, 'NL', 'NLD', 'Netherlands'),
(530, 'AN', 'ANT', 'Netherlands Antilles'),
(540, 'NC', 'NCL', 'New Caledonia'),
(554, 'NZ', 'NZL', 'New Zealand'),
(558, 'NI', 'NIC', 'Nicaragua'),
(562, 'NE', 'NER', 'Niger'),
(566, 'NG', 'NGA', 'Nigeria'),
(570, 'NU', 'NIU', 'Niue'),
(574, 'NF', 'NFK', 'Norfolk Island'),
(580, 'MP', 'MNP', 'Northern Mariana Islands'),
(578, 'NO', 'NOR', 'Norway'),
(512, 'OM', 'OMN', 'Oman'),
(586, 'PK', 'PAK', 'Pakistan'),
(585, 'PW', 'PLW', 'Palau'),
(275, 'PS', 'PSE', 'Palestinian Territory, Occupied'),
(591, 'PA', 'PAN', 'Panama'),
(598, 'PG', 'PNG', 'Papua New Guinea'),
(600, 'PY', 'PRY', 'Paraguay'),
(604, 'PE', 'PER', 'Peru'),
(608, 'PH', 'PHL', 'Philippines'),
(612, 'PN', 'PCN', 'Pitcairn'),
(616, 'PL', 'POL', 'Poland'),
(620, 'PT', 'PRT', 'Portugal'),
(630, 'PR', 'PRI', 'Puerto Rico'),
(634, 'QA', 'QAT', 'Qatar'),
(638, 'RE', 'REU', 'RŽunion'),
(642, 'RO', 'ROU', 'Romania'),
(643, 'RU', 'RUS', 'Russian Federation'),
(646, 'RW', 'RWA', 'Rwanda'),
(652, 'BL', 'BLM', 'Saint BarthŽlemy'),
(654, 'SH', 'SHN', 'Saint Helena'),
(659, 'KN', 'KNA', 'Saint Kitts and Nevis'),
(662, 'LC', 'LCA', 'Saint Lucia'),
(663, 'MF', 'MAF', 'Saint Martin (French part)'),
(666, 'PM', 'SPM', 'Saint Pierre and Miquelon'),
(670, 'VC', 'VCT', 'Saint Vincent and the Grenadines'),
(882, 'WS', 'WSM', 'Samoa'),
(674, 'SM', 'SMR', 'San Marino'),
(678, 'ST', 'STP', 'Sao Tome and Principe'),
(682, 'SA', 'SAU', 'Saudi Arabia'),
(686, 'SN', 'SEN', 'Senegal'),
(688, 'RS', 'SRB', 'Serbia'),
(690, 'SC', 'SYC', 'Seychelles'),
(694, 'SL', 'SLE', 'Sierra Leone'),
(702, 'SG', 'SGP', 'Singapore'),
(703, 'SK', 'SVK', 'Slovakia'),
(705, 'SI', 'SVN', 'Slovenia'),
(90, 'SB', 'SLB', 'Solomon Islands'),
(706, 'SO', 'SOM', 'Somalia'),
(710, 'ZA', 'ZAF', 'South Africa'),
(239, 'GS', 'SGS', 'South Georgia and the South Sandwich Islands'),
(724, 'ES', 'ESP', 'Spain'),
(144, 'LK', 'LKA', 'Sri Lanka'),
(736, 'SD', 'SDN', 'Sudan'),
(740, 'SR', 'SUR', 'Suriname'),
(744, 'SJ', 'SJM', 'Svalbard and Jan Mayen'),
(748, 'SZ', 'SWZ', 'Swaziland'),
(752, 'SE', 'SWE', 'Sweden'),
(756, 'CH', 'CHE', 'Switzerland'),
(760, 'SY', 'SYR', 'Syrian Arab Republic'),
(158, 'TW', 'TWN', 'Taiwan, Province of China'),
(762, 'TJ', 'TJK', 'Tajikistan'),
(834, 'TZ', 'TZA', 'Tanzania, United Republic of'),
(764, 'TH', 'THA', 'Thailand'),
(626, 'TL', 'TLS', 'Timor-Leste'),
(768, 'TG', 'TGO', 'Togo'),
(772, 'TK', 'TKL', 'Tokelau'),
(776, 'TO', 'TON', 'Tonga'),
(780, 'TT', 'TTO', 'Trinidad and Tobago'),
(788, 'TN', 'TUN', 'Tunisia'),
(792, 'TR', 'TUR', 'Turkey'),
(795, 'TM', 'TKM', 'Turkmenistan'),
(796, 'TC', 'TCA', 'Turks and Caicos Islands'),
(798, 'TV', 'TUV', 'Tuvalu'),
(800, 'UG', 'UGA', 'Uganda'),
(804, 'UA', 'UKR', 'Ukraine'),
(784, 'AE', 'ARE', 'United Arab Emirates'),
(826, 'GB', 'GBR', 'United Kingdom'),
(840, 'US', 'USA', 'United States'),
(581, 'UM', 'UMI', 'United States Minor Outlying Islands'),
(858, 'UY', 'URY', 'Uruguay'),
(860, 'UZ', 'UZB', 'Uzbekistan'),
(548, 'VU', 'VUT', 'Vanuatu'),
(862, 'VE', 'VEN', 'Venezuela'),
(704, 'VN', 'VNM', 'Viet Nam'),
(92, 'VG', 'VGB', 'Virgin Islands, British'),
(850, 'VI', 'VIR', 'Virgin Islands, U.S.'),
(876, 'WF', 'WLF', 'Wallis and Futuna'),
(732, 'EH', 'ESH', 'Western Sahara'),
(887, 'YE', 'YEM', 'Yemen'),
(894, 'ZM', 'ZMB', 'Zambia'),
(716, 'ZW', 'ZWE', 'Zimbabwe'),
(895, 'CW', 'CW', 'Curaçao'),
(896, 'SX', 'SX', 'Sint Maarten');

-- --------------------------------------------------------

--
-- Table structure for table `countries_logs`
--

CREATE TABLE `countries_logs` (
  `domain_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `country` char(2) NOT NULL,
  `city` varchar(25) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '1'
) ;

--
-- Dumping data for table `countries_logs`
--

INSERT INTO `countries_logs` (`domain_id`, `date`, `country`, `city`, `count`) VALUES
(1, '2014-05-01', 'US', 'Dallas', 2),
(1, '2014-05-01', 'CA', 'Saint-hubert', 2),
(1, '2014-05-01', 'BD', 'Dhaka', 1),
(1, '2014-05-01', 'IN', 'Mumbai', 1),
(1, '2014-05-01', 'AR', 'Federal', 1),
(1, '2014-05-02', 'IN', 'Mumbai', 1),
(1, '2014-05-02', 'CA', 'Brossard', 1),
(1, '2014-05-02', 'EU', 'x', 1),
(1, '2014-05-02', 'US', 'Dallas', 1),
(1, '2014-05-04', 'CA', 'Brossard', 1),
(1, '2014-05-04', 'IL', 'x', 1),
(1, '2014-05-04', 'IN', 'x', 1),
(1, '2014-05-04', 'BD', 'Dhaka', 1),
(1, '2014-05-04', 'US', 'Dallas', 2),
(1, '2014-05-05', 'CA', 'Brossard', 1),
(1, '2014-05-05', 'IN', 'Mumbai', 1),
(1, '2014-05-05', 'US', 'Dallas', 1),
(1, '2014-05-05', 'IN', 'Hyderabad', 1),
(1, '2014-05-05', 'US', 'x', 1),
(1, '2014-05-05', 'US', 'Mountain Pine', 1),
(1, '2014-05-05', 'US', 'San Francisco', 1),
(1, '2014-05-06', 'CA', 'Brossard', 1),
(1, '2014-05-06', 'IL', 'x', 1),
(1, '2014-05-06', 'US', 'Dallas', 2),
(1, '2014-05-07', 'US', 'Dallas', 2),
(1, '2014-05-07', 'IL', 'x', 1),
(1, '2014-05-07', 'CA', 'Saint-hubert', 1),
(1, '2014-05-07', 'NL', 'x', 1),
(1, '2014-05-07', 'GB', 'x', 1),
(1, '2014-05-07', 'IN', 'x', 1),
(1, '2014-05-08', 'CA', 'Saint-hubert', 1),
(1, '2014-05-08', 'IR', 'Razavi', 1),
(1, '2014-05-08', 'MX', 'Tijuana', 1),
(1, '2014-05-09', 'US', 'Dallas', 1),
(1, '2014-05-09', 'MX', 'Tijuana', 1),
(1, '2014-05-09', 'IR', 'Razavi', 1),
(1, '2014-05-10', 'CA', 'Brossard', 1),
(1, '2014-05-10', 'MX', 'Tijuana', 1),
(1, '2014-05-11', 'CA', 'Brossard', 1),
(1, '2014-05-12', 'IR', 'Razavi', 1),
(1, '2014-05-12', 'IL', 'x', 2),
(1, '2014-05-12', 'CA', 'Saint-hubert', 1),
(1, '2014-05-12', 'MX', 'Tijuana', 1),
(1, '2014-05-13', 'CO', 'x', 1),
(1, '2014-05-13', 'CA', 'Saint-hubert', 1),
(1, '2014-05-13', 'US', 'Dallas', 1),
(1, '2014-05-13', 'PH', 'Sucat', 2),
(1, '2014-05-13', 'PH', 'x', 1),
(1, '2014-05-14', 'US', 'New York', 1),
(1, '2014-05-14', 'CA', 'Brossard', 1),
(1, '2014-05-14', 'IR', 'Khorasan', 1),
(1, '2014-05-15', 'IR', 'Khorasan', 1),
(1, '2014-05-15', 'CA', 'Saint-hubert', 1),
(1, '2014-05-16', 'PH', 'x', 2),
(1, '2014-05-16', 'IL', 'x', 1),
(1, '2014-05-16', 'US', 'Columbia', 1),
(1, '2014-05-16', 'CA', 'Saint-hubert', 1),
(1, '2014-05-17', 'CA', 'MontrÃ©al', 1),
(1, '2014-05-17', 'US', 'Columbia', 2),
(1, '2014-05-17', 'CA', 'Saint-hubert', 1),
(1, '2014-05-18', 'PH', 'x', 3),
(1, '2014-05-18', 'US', 'Columbia', 1),
(1, '2014-05-18', 'PH', 'Sucat', 1),
(1, '2014-05-19', 'PH', 'x', 3),
(1, '2014-05-19', 'AU', 'Burwood', 1),
(1, '2014-05-19', 'CA', 'Brossard', 1),
(1, '2014-05-19', 'US', 'Columbia', 1),
(1, '2014-05-19', 'CA', 'Salaberry-de-valleyfield', 1),
(1, '2014-05-19', 'PT', 'Oeiras', 1),
(1, '2014-05-19', 'US', 'x', 2),
(1, '2014-05-19', 'US', 'Atlanta', 1),
(1, '2014-05-19', 'GB', 'Llandudno Junction', 1),
(1, '2014-05-19', 'AR', 'Martinez', 1),
(1, '2014-05-20', 'CA', 'Brossard', 1),
(1, '2014-05-20', 'PT', 'Oeiras', 1),
(1, '2014-05-20', 'GB', 'Greenford', 1),
(1, '2014-05-20', 'PH', 'x', 2),
(1, '2014-05-20', 'PH', 'Manila', 3),
(1, '2014-05-21', 'CA', 'Brossard', 1),
(1, '2014-05-21', 'MY', 'Kuala Lumpur', 1),
(1, '2014-05-21', 'IE', 'x', 2),
(1, '2014-05-21', 'PT', 'Oeiras', 1),
(1, '2014-05-21', 'IN', 'Hyderabad', 1),
(1, '2014-05-21', 'IN', 'x', 1),
(1, '2014-05-21', 'CA', 'MontrÃ©al', 1),
(1, '2014-05-22', 'CA', 'Brossard', 4),
(1, '2014-05-22', 'CN', 'Guangzhou', 1),
(1, '2014-05-22', 'CY', 'Limassol', 1),
(1, '2014-05-22', 'FR', 'x', 1),
(1, '2014-05-22', 'US', 'Seattle', 1),
(1, '2014-05-22', 'CA', 'MontrÃ©al', 2),
(1, '2014-05-22', 'US', 'Middletown', 1),
(1, '2014-05-22', 'US', 'Pomona', 1),
(1, '2014-05-23', 'MY', 'Kuala Lumpur', 1),
(1, '2014-05-23', 'PT', 'x', 1),
(1, '2014-05-23', 'CA', 'x', 1),
(1, '2014-05-23', 'PH', 'Quezon City', 1),
(1, '2014-05-23', 'IR', 'Khorasan', 1),
(1, '2014-05-23', 'CA', 'Brossard', 1),
(1, '2014-05-23', 'CA', 'MontrÃ©al', 3),
(1, '2014-05-24', 'CA', 'MontrÃ©al', 1),
(1, '2014-05-25', 'CA', 'Mercier', 1),
(1, '2014-05-26', 'US', 'Hot Springs National Park', 1),
(1, '2014-05-26', 'CA', 'Brossard', 1),
(1, '2014-05-27', 'CA', 'Saint-hubert', 1),
(1, '2014-05-27', 'US', 'Albuquerque', 2),
(1, '2014-05-27', 'US', 'West Chester', 1),
(1, '2014-05-28', 'US', 'Fort Lauderdale', 1),
(1, '2014-05-29', 'IN', 'New Delhi', 1),
(1, '2014-05-29', 'CA', 'Saint-hubert', 1),
(1, '2014-05-30', 'PH', 'x', 1),
(1, '2014-06-01', 'CA', 'MontrÃ©al', 1),
(1, '2014-06-02', 'IN', 'x', 1),
(1, '2014-06-02', 'CA', 'Brossard', 1),
(1, '2014-06-03', 'IN', 'Hyderabad', 1),
(1, '2014-06-03', 'CA', 'Brossard', 1),
(1, '2014-06-04', 'IR', 'Khorasan', 2),
(1, '2014-06-04', 'CA', 'Saint-hubert', 1),
(1, '2014-06-04', 'NL', 'x', 1),
(1, '2014-06-05', 'CA', 'Saint-hubert', 1),
(1, '2014-06-05', 'IN', 'Bangalore', 1),
(1, '2014-06-05', 'IR', 'Razavi', 1),
(1, '2014-06-06', 'HK', 'x', 1),
(1, '2014-06-06', 'CN', 'Shenzhen', 1),
(1, '2014-06-06', 'IR', 'Khorasan', 1),
(1, '2014-06-07', 'IR', 'Khorasan', 1),
(1, '2014-06-08', 'CA', 'Saint-hubert', 1),
(1, '2014-06-08', 'IR', 'Khorasan', 1),
(1, '2014-06-09', 'CA', 'Saint-hubert', 2),
(1, '2014-06-11', 'CR', 'x', 1),
(1, '2014-06-12', 'CY', 'Limassol', 1),
(1, '2014-06-12', 'CA', 'Brossard', 2),
(1, '2014-06-13', 'x', 'x', 1),
(1, '2014-06-15', 'US', 'Brighton', 1),
(1, '2014-06-16', 'CA', 'Brossard', 3),
(1, '2014-06-16', 'PT', 'Cascais', 1),
(1, '2014-06-16', 'IR', 'Khorasan', 1),
(1, '2014-06-17', 'IN', 'Bangalore', 1),
(1, '2014-06-17', 'US', 'Hot Springs National Park', 1),
(1, '2014-06-17', 'CA', 'Saint-hubert', 2),
(1, '2014-06-17', 'NL', 'x', 1),
(1, '2014-06-18', 'IR', 'Khorasan', 2),
(1, '2014-06-18', 'CA', 'Saint-hubert', 1),
(1, '2014-06-19', 'IR', 'Khorasan', 1),
(1, '2014-06-19', 'CA', 'Brossard', 2),
(1, '2014-06-19', 'US', 'Bronx', 1),
(1, '2014-06-20', 'IR', 'Khorasan', 3),
(1, '2014-06-20', 'IE', 'x', 1),
(1, '2014-06-21', 'CA', 'Brossard', 2),
(1, '2014-06-22', 'CA', 'Brossard', 2),
(1, '2014-06-23', 'IR', 'Razavi', 1),
(1, '2014-06-23', 'CA', 'Brossard', 1),
(1, '2014-06-24', 'IR', 'Razavi', 1),
(1, '2014-06-24', 'IN', 'Indore', 1),
(1, '2014-06-24', 'CA', 'Brossard', 2),
(1, '2014-06-24', 'IN', 'Ghaziabad', 1),
(1, '2014-06-25', 'IR', 'Razavi', 2),
(1, '2014-06-25', 'BD', 'x', 1),
(1, '2014-06-25', 'CA', 'Brossard', 3),
(1, '2014-06-26', 'CA', 'Brossard', 2),
(1, '2014-06-26', 'IN', 'Indore', 3),
(1, '2014-06-26', 'IR', 'Khorasan', 1),
(1, '2014-06-26', 'US', 'Hot Springs National Park', 1),
(1, '2014-06-27', 'CA', 'Brossard', 2),
(1, '2014-06-27', 'IR', 'Khorasan', 2),
(1, '2014-06-27', 'IN', 'Indore', 1),
(1, '2014-06-28', 'IR', 'Razavi', 1),
(1, '2014-06-28', 'IR', 'Khorasan', 1),
(1, '2014-06-28', 'IN', 'Indore', 1),
(1, '2014-06-28', 'CA', 'Brossard', 1),
(1, '2014-06-29', 'IR', 'Khorasan', 1),
(1, '2014-06-29', 'CA', 'Brossard', 1),
(1, '2014-06-29', 'IN', 'Bhandup', 1),
(1, '2014-06-30', 'IR', 'Khorasan', 1),
(1, '2014-06-30', 'CA', 'Brossard', 4),
(1, '2014-06-30', 'IN', 'Bhandup', 1),
(1, '2014-06-30', 'US', 'Orlando', 2),
(1, '2014-06-30', 'BD', 'Dhaka', 1),
(1, '2014-07-01', 'CA', 'Brossard', 1),
(1, '2014-07-01', 'IR', 'Mashhad', 1),
(1, '2014-07-01', 'CA', 'Saint-hubert', 1),
(1, '2014-07-01', 'US', 'Orlando', 2),
(1, '2014-07-01', 'IR', 'Khorasan', 1),
(1, '2014-07-01', 'BR', 'x', 1),
(1, '2014-07-02', 'CA', 'Saint-hubert', 2),
(1, '2014-07-02', 'MK', 'Skopje', 1),
(1, '2014-07-02', 'BR', 'Fortaleza', 1),
(1, '2014-07-02', 'IN', 'Indore', 2),
(1, '2014-07-03', 'CA', 'Saint-hubert', 1),
(1, '2014-07-03', 'HK', 'x', 3),
(1, '2014-07-03', 'US', 'Orlando', 1),
(1, '2014-07-03', 'MX', 'CuauhtÃ©moc', 1),
(1, '2014-07-03', 'IN', 'Indore', 1),
(1, '2014-07-03', 'IR', 'Khorasan', 1),
(1, '2014-07-04', 'US', 'Dover', 1),
(1, '2014-07-04', 'CA', 'Saint-hubert', 1),
(1, '2014-07-04', 'BD', 'x', 1),
(1, '2014-07-04', 'IN', 'Indore', 1),
(1, '2014-07-04', 'US', 'Orlando', 1),
(1, '2014-07-04', 'CA', 'Brossard', 1),
(1, '2014-07-04', 'IR', 'Khorasan', 2),
(1, '2014-07-05', 'IN', 'Indore', 1),
(1, '2014-07-05', 'CA', 'Brossard', 3),
(1, '2014-07-06', 'CA', 'Brossard', 2),
(1, '2014-07-06', 'NL', 'Groningen', 1),
(1, '2014-07-06', 'IR', 'Khorasan', 2),
(1, '2014-07-06', 'IN', 'Indore', 1),
(1, '2014-07-06', 'MX', 'Cuajimalpa', 1),
(1, '2014-07-07', 'BR', 'PalhoÃ§a', 1),
(1, '2014-07-07', 'BR', 'Rio De Janeiro', 1),
(1, '2014-07-07', 'x', 'x', 3),
(1, '2014-07-08', 'CA', 'Brossard', 4),
(1, '2014-07-08', 'US', 'Seattle', 1),
(1, '2014-07-09', 'CA', 'Brossard', 4),
(1, '2014-07-09', 'IT', 'San Gavino Monreale', 1),
(1, '2014-07-09', 'IN', 'Bhandup', 1),
(1, '2014-07-10', 'CA', 'Brossard', 3),
(1, '2014-07-10', 'ES', 'x', 1),
(1, '2014-07-10', 'BR', 'x', 1),
(1, '2014-07-10', 'GB', 'Wellingborough', 1),
(1, '2014-07-11', 'IR', 'Khorasan', 1),
(1, '2014-07-11', 'CA', 'Brossard', 1),
(1, '2014-07-11', 'BR', 'Passo Fundo', 1),
(1, '2014-07-12', 'IR', 'Khorasan', 1),
(1, '2014-07-12', 'CA', 'Brossard', 1),
(1, '2014-07-13', 'CA', 'Brossard', 1),
(1, '2014-07-13', 'BR', 'Atibaia', 1),
(1, '2014-07-14', 'CO', 'MedellÃ­n', 1),
(1, '2014-07-15', 'HK', 'Central District', 1),
(1, '2014-07-15', 'AE', 'Dubai', 1),
(1, '2014-07-15', 'CA', 'Brossard', 2),
(1, '2014-07-15', 'IR', 'Khorasan', 2),
(1, '2014-07-15', 'CY', 'Limassol', 1),
(1, '2014-07-16', 'CA', 'Brossard', 1),
(1, '2014-07-16', 'UY', 'Montevideo', 1),
(1, '2014-07-17', 'CA', 'Brossard', 1),
(1, '2014-07-17', 'x', 'x', 1),
(1, '2014-07-17', 'BR', 'x', 1),
(1, '2014-07-17', 'IR', 'Khorasan', 1),
(1, '2014-07-18', 'BR', 'x', 1),
(1, '2014-07-18', 'CA', 'Brossard', 2),
(1, '2014-07-19', 'AE', 'Dubai', 1),
(1, '2014-07-21', 'BR', 'SÃ£o Paulo', 1),
(1, '2014-07-21', 'IR', 'Razavi', 1),
(1, '2014-07-21', 'CA', 'Brossard', 3),
(1, '2014-07-21', 'AU', 'x', 1),
(1, '2014-07-22', 'CA', 'Brossard', 2),
(1, '2014-07-22', 'IN', 'New Delhi', 1),
(1, '2014-07-22', 'IR', 'Khorasan', 3),
(1, '2014-07-22', 'BR', 'ItajaÃ­', 1),
(1, '2014-07-22', 'IN', 'Indore', 1),
(1, '2014-07-22', 'BR', 'x', 1),
(1, '2014-07-23', 'HK', 'x', 2),
(1, '2014-07-23', 'BR', 'Osasco', 1),
(1, '2014-07-23', 'IR', 'Khorasan', 1),
(1, '2014-07-23', 'US', 'Fremont', 1),
(1, '2014-07-23', 'CA', 'Brossard', 1),
(1, '2014-07-23', 'BR', 'Guarulhos', 1),
(1, '2014-07-24', 'BD', 'x', 1),
(1, '2014-07-24', 'US', 'Fremont', 2),
(1, '2014-07-24', 'RO', 'Cluj', 1),
(1, '2014-07-25', 'CA', 'Brossard', 2),
(1, '2014-07-25', 'BR', 'x', 1),
(1, '2014-07-25', 'CO', 'BogotÃ¡', 1),
(1, '2014-07-26', 'IR', 'Razavi', 1),
(1, '2014-07-26', 'PK', 'Islamabad', 1),
(1, '2014-07-26', 'BR', 'x', 1),
(1, '2014-07-26', 'IT', 'Villa Literno', 1),
(1, '2014-07-27', 'CO', 'MedellÃ­n', 1),
(1, '2014-07-27', 'US', 'Peoria', 1),
(1, '2014-07-27', 'CA', 'Brossard', 1),
(1, '2014-07-28', 'CA', 'Brossard', 1),
(1, '2014-07-28', 'IR', 'Khorasan', 2),
(1, '2014-07-29', 'US', 'Dover', 2),
(1, '2014-07-29', 'BR', 'FlorianÃ³polis', 1),
(1, '2014-07-29', 'CA', 'Brossard', 1),
(1, '2014-07-29', 'GB', 'x', 1),
(1, '2014-07-29', 'PT', 'x', 1),
(1, '2014-07-29', 'AU', 'Strathfield', 1),
(1, '2014-07-30', 'CA', 'Brossard', 1),
(1, '2014-07-30', 'BR', 'x', 1),
(1, '2014-07-31', 'AU', 'Strathfield', 3),
(1, '2014-07-31', 'CA', 'Brossard', 1),
(1, '2014-07-31', 'IN', 'Bhandup', 1),
(1, '2014-07-31', 'BR', 'Vila Velha', 1),
(1, '2014-07-31', 'ES', 'x', 1),
(1, '2014-07-31', 'AU', 'Sydney', 1),
(1, '2014-08-01', 'BA', 'Bihac', 1),
(1, '2014-08-01', 'GB', 'x', 1),
(1, '2014-08-01', 'AU', 'Strathfield', 1),
(1, '2014-08-02', 'BR', 'x', 1),
(1, '2014-08-02', 'CA', 'Brossard', 1),
(1, '2014-08-04', 'IR', 'Khorasan', 1),
(1, '2014-08-04', 'CA', 'Saint-hubert', 1),
(1, '2014-08-04', 'BR', 'Londrina', 1),
(1, '2014-08-05', 'CA', 'Saint-hubert', 1),
(1, '2014-08-05', 'BR', 'x', 1);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `iso_code_2` varchar(2) NOT NULL,
  `iso_code_3` varchar(3) NOT NULL,
  `address_format` text NOT NULL,
  `postcode_required` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `name`, `iso_code_2`, `iso_code_3`, `address_format`, `postcode_required`, `status`) VALUES
(1, 'Afghanistan', 'AF', 'AFG', '', 0, 1),
(2, 'Albania', 'AL', 'ALB', '', 0, 1),
(3, 'Algeria', 'DZ', 'DZA', '', 0, 1),
(4, 'American Samoa', 'AS', 'ASM', '', 0, 1),
(5, 'Andorra', 'AD', 'AND', '', 0, 1),
(6, 'Angola', 'AO', 'AGO', '', 0, 1),
(7, 'Anguilla', 'AI', 'AIA', '', 0, 1),
(8, 'Antarctica', 'AQ', 'ATA', '', 0, 1),
(9, 'Antigua and Barbuda', 'AG', 'ATG', '', 0, 1),
(10, 'Argentina', 'AR', 'ARG', '', 0, 1),
(11, 'Armenia', 'AM', 'ARM', '', 0, 1),
(12, 'Aruba', 'AW', 'ABW', '', 0, 1),
(13, 'Australia', 'AU', 'AUS', '', 0, 1),
(14, 'Austria', 'AT', 'AUT', '', 0, 1),
(15, 'Azerbaijan', 'AZ', 'AZE', '', 0, 1),
(16, 'Bahamas', 'BS', 'BHS', '', 0, 1),
(17, 'Bahrain', 'BH', 'BHR', '', 0, 1),
(18, 'Bangladesh', 'BD', 'BGD', '', 0, 1),
(19, 'Barbados', 'BB', 'BRB', '', 0, 1),
(20, 'Belarus', 'BY', 'BLR', '', 0, 1),
(21, 'Belgium', 'BE', 'BEL', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 0, 1),
(22, 'Belize', 'BZ', 'BLZ', '', 0, 1),
(23, 'Benin', 'BJ', 'BEN', '', 0, 1),
(24, 'Bermuda', 'BM', 'BMU', '', 0, 1),
(25, 'Bhutan', 'BT', 'BTN', '', 0, 1),
(26, 'Bolivia', 'BO', 'BOL', '', 0, 1),
(27, 'Bosnia and Herzegovina', 'BA', 'BIH', '', 0, 1),
(28, 'Botswana', 'BW', 'BWA', '', 0, 1),
(29, 'Bouvet Island', 'BV', 'BVT', '', 0, 1),
(30, 'Brazil', 'BR', 'BRA', '', 0, 1),
(31, 'British Indian Ocean Territory', 'IO', 'IOT', '', 0, 1),
(32, 'Brunei Darussalam', 'BN', 'BRN', '', 0, 1),
(33, 'Bulgaria', 'BG', 'BGR', '', 0, 1),
(34, 'Burkina Faso', 'BF', 'BFA', '', 0, 1),
(35, 'Burundi', 'BI', 'BDI', '', 0, 1),
(36, 'Cambodia', 'KH', 'KHM', '', 0, 1),
(37, 'Cameroon', 'CM', 'CMR', '', 0, 1),
(38, 'Canada', 'CA', 'CAN', '', 0, 1),
(39, 'Cape Verde', 'CV', 'CPV', '', 0, 1),
(40, 'Cayman Islands', 'KY', 'CYM', '', 0, 1),
(41, 'Central African Republic', 'CF', 'CAF', '', 0, 1),
(42, 'Chad', 'TD', 'TCD', '', 0, 1),
(43, 'Chile', 'CL', 'CHL', '', 0, 1),
(44, 'China', 'CN', 'CHN', '', 0, 1),
(45, 'Christmas Island', 'CX', 'CXR', '', 0, 1),
(46, 'Cocos (Keeling) Islands', 'CC', 'CCK', '', 0, 1),
(47, 'Colombia', 'CO', 'COL', '', 0, 1),
(48, 'Comoros', 'KM', 'COM', '', 0, 1),
(49, 'Congo', 'CG', 'COG', '', 0, 1),
(50, 'Cook Islands', 'CK', 'COK', '', 0, 1),
(51, 'Costa Rica', 'CR', 'CRI', '', 0, 1),
(52, 'Cote D\'Ivoire', 'CI', 'CIV', '', 0, 1),
(53, 'Croatia', 'HR', 'HRV', '', 0, 1),
(54, 'Cuba', 'CU', 'CUB', '', 0, 1),
(55, 'Cyprus', 'CY', 'CYP', '', 0, 1),
(56, 'Czech Republic', 'CZ', 'CZE', '', 0, 1),
(57, 'Denmark', 'DK', 'DNK', '', 0, 1),
(58, 'Djibouti', 'DJ', 'DJI', '', 0, 1),
(59, 'Dominica', 'DM', 'DMA', '', 0, 1),
(60, 'Dominican Republic', 'DO', 'DOM', '', 0, 1),
(61, 'East Timor', 'TL', 'TLS', '', 0, 1),
(62, 'Ecuador', 'EC', 'ECU', '', 0, 1),
(63, 'Egypt', 'EG', 'EGY', '', 0, 1),
(64, 'El Salvador', 'SV', 'SLV', '', 0, 1),
(65, 'Equatorial Guinea', 'GQ', 'GNQ', '', 0, 1),
(66, 'Eritrea', 'ER', 'ERI', '', 0, 1),
(67, 'Estonia', 'EE', 'EST', '', 0, 1),
(68, 'Ethiopia', 'ET', 'ETH', '', 0, 1),
(69, 'Falkland Islands (Malvinas)', 'FK', 'FLK', '', 0, 1),
(70, 'Faroe Islands', 'FO', 'FRO', '', 0, 1),
(71, 'Fiji', 'FJ', 'FJI', '', 0, 1),
(72, 'Finland', 'FI', 'FIN', '', 0, 1),
(74, 'France, Metropolitan', 'FR', 'FRA', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 1, 1),
(75, 'French Guiana', 'GF', 'GUF', '', 0, 1),
(76, 'French Polynesia', 'PF', 'PYF', '', 0, 1),
(77, 'French Southern Territories', 'TF', 'ATF', '', 0, 1),
(78, 'Gabon', 'GA', 'GAB', '', 0, 1),
(79, 'Gambia', 'GM', 'GMB', '', 0, 1),
(80, 'Georgia', 'GE', 'GEO', '', 0, 1),
(81, 'Germany', 'DE', 'DEU', '{company}\r\n{firstname} {lastname}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 1, 1),
(82, 'Ghana', 'GH', 'GHA', '', 0, 1),
(83, 'Gibraltar', 'GI', 'GIB', '', 0, 1),
(84, 'Greece', 'GR', 'GRC', '', 0, 1),
(85, 'Greenland', 'GL', 'GRL', '', 0, 1),
(86, 'Grenada', 'GD', 'GRD', '', 0, 1),
(87, 'Guadeloupe', 'GP', 'GLP', '', 0, 1),
(88, 'Guam', 'GU', 'GUM', '', 0, 1),
(89, 'Guatemala', 'GT', 'GTM', '', 0, 1),
(90, 'Guinea', 'GN', 'GIN', '', 0, 1),
(91, 'Guinea-Bissau', 'GW', 'GNB', '', 0, 1),
(92, 'Guyana', 'GY', 'GUY', '', 0, 1),
(93, 'Haiti', 'HT', 'HTI', '', 0, 1),
(94, 'Heard and Mc Donald Islands', 'HM', 'HMD', '', 0, 1),
(95, 'Honduras', 'HN', 'HND', '', 0, 1),
(96, 'Hong Kong', 'HK', 'HKG', '', 0, 1),
(97, 'Hungary', 'HU', 'HUN', '', 0, 1),
(98, 'Iceland', 'IS', 'ISL', '', 0, 1),
(99, 'India', 'IN', 'IND', '', 0, 1),
(100, 'Indonesia', 'ID', 'IDN', '', 0, 1),
(101, 'Iran (Islamic Republic of)', 'IR', 'IRN', '', 0, 1),
(102, 'Iraq', 'IQ', 'IRQ', '', 0, 1),
(103, 'Ireland', 'IE', 'IRL', '', 0, 1),
(104, 'Israel', 'IL', 'ISR', '', 0, 1),
(105, 'Italy', 'IT', 'ITA', '', 0, 1),
(106, 'Jamaica', 'JM', 'JAM', '', 0, 1),
(107, 'Japan', 'JP', 'JPN', '', 0, 1),
(108, 'Jordan', 'JO', 'JOR', '', 0, 1),
(109, 'Kazakhstan', 'KZ', 'KAZ', '', 0, 1),
(110, 'Kenya', 'KE', 'KEN', '', 0, 1),
(111, 'Kiribati', 'KI', 'KIR', '', 0, 1),
(112, 'North Korea', 'KP', 'PRK', '', 0, 1),
(113, 'Korea, Republic of', 'KR', 'KOR', '', 0, 1),
(114, 'Kuwait', 'KW', 'KWT', '', 0, 1),
(115, 'Kyrgyzstan', 'KG', 'KGZ', '', 0, 1),
(116, 'Lao People\'s Democratic Republic', 'LA', 'LAO', '', 0, 1),
(117, 'Latvia', 'LV', 'LVA', '', 0, 1),
(118, 'Lebanon', 'LB', 'LBN', '', 0, 1),
(119, 'Lesotho', 'LS', 'LSO', '', 0, 1),
(120, 'Liberia', 'LR', 'LBR', '', 0, 1),
(121, 'Libyan Arab Jamahiriya', 'LY', 'LBY', '', 0, 1),
(122, 'Liechtenstein', 'LI', 'LIE', '', 0, 1),
(123, 'Lithuania', 'LT', 'LTU', '', 0, 1),
(124, 'Luxembourg', 'LU', 'LUX', '', 0, 1),
(125, 'Macau', 'MO', 'MAC', '', 0, 1),
(126, 'FYROM', 'MK', 'MKD', '', 0, 1),
(127, 'Madagascar', 'MG', 'MDG', '', 0, 1),
(128, 'Malawi', 'MW', 'MWI', '', 0, 1),
(129, 'Malaysia', 'MY', 'MYS', '', 0, 1),
(130, 'Maldives', 'MV', 'MDV', '', 0, 1),
(131, 'Mali', 'ML', 'MLI', '', 0, 1),
(132, 'Malta', 'MT', 'MLT', '', 0, 1),
(133, 'Marshall Islands', 'MH', 'MHL', '', 0, 1),
(134, 'Martinique', 'MQ', 'MTQ', '', 0, 1),
(135, 'Mauritania', 'MR', 'MRT', '', 0, 1),
(136, 'Mauritius', 'MU', 'MUS', '', 0, 1),
(137, 'Mayotte', 'YT', 'MYT', '', 0, 1),
(138, 'Mexico', 'MX', 'MEX', '', 0, 1),
(139, 'Micronesia, Federated States of', 'FM', 'FSM', '', 0, 1),
(140, 'Moldova, Republic of', 'MD', 'MDA', '', 0, 1),
(141, 'Monaco', 'MC', 'MCO', '', 0, 1),
(142, 'Mongolia', 'MN', 'MNG', '', 0, 1),
(143, 'Montserrat', 'MS', 'MSR', '', 0, 1),
(144, 'Morocco', 'MA', 'MAR', '', 0, 1),
(145, 'Mozambique', 'MZ', 'MOZ', '', 0, 1),
(146, 'Myanmar', 'MM', 'MMR', '', 0, 1),
(147, 'Namibia', 'NA', 'NAM', '', 0, 1),
(148, 'Nauru', 'NR', 'NRU', '', 0, 1),
(149, 'Nepal', 'NP', 'NPL', '', 0, 1),
(150, 'Netherlands', 'NL', 'NLD', '', 0, 1),
(151, 'Netherlands Antilles', 'AN', 'ANT', '', 0, 1),
(152, 'New Caledonia', 'NC', 'NCL', '', 0, 1),
(153, 'New Zealand', 'NZ', 'NZL', '', 0, 1),
(154, 'Nicaragua', 'NI', 'NIC', '', 0, 1),
(155, 'Niger', 'NE', 'NER', '', 0, 1),
(156, 'Nigeria', 'NG', 'NGA', '', 0, 1),
(157, 'Niue', 'NU', 'NIU', '', 0, 1),
(158, 'Norfolk Island', 'NF', 'NFK', '', 0, 1),
(159, 'Northern Mariana Islands', 'MP', 'MNP', '', 0, 1),
(160, 'Norway', 'NO', 'NOR', '', 0, 1),
(161, 'Oman', 'OM', 'OMN', '', 0, 1),
(162, 'Pakistan', 'PK', 'PAK', '', 0, 1),
(163, 'Palau', 'PW', 'PLW', '', 0, 1),
(164, 'Panama', 'PA', 'PAN', '', 0, 1),
(165, 'Papua New Guinea', 'PG', 'PNG', '', 0, 1),
(166, 'Paraguay', 'PY', 'PRY', '', 0, 1),
(167, 'Peru', 'PE', 'PER', '', 0, 1),
(168, 'Philippines', 'PH', 'PHL', '', 0, 1),
(169, 'Pitcairn', 'PN', 'PCN', '', 0, 1),
(170, 'Poland', 'PL', 'POL', '', 0, 1),
(171, 'Portugal', 'PT', 'PRT', '', 0, 1),
(172, 'Puerto Rico', 'PR', 'PRI', '', 0, 1),
(173, 'Qatar', 'QA', 'QAT', '', 0, 1),
(174, 'Reunion', 'RE', 'REU', '', 0, 1),
(175, 'Romania', 'RO', 'ROM', '', 0, 1),
(176, 'Russian Federation', 'RU', 'RUS', '', 0, 1),
(177, 'Rwanda', 'RW', 'RWA', '', 0, 1),
(178, 'Saint Kitts and Nevis', 'KN', 'KNA', '', 0, 1),
(179, 'Saint Lucia', 'LC', 'LCA', '', 0, 1),
(180, 'Saint Vincent and the Grenadines', 'VC', 'VCT', '', 0, 1),
(181, 'Samoa', 'WS', 'WSM', '', 0, 1),
(182, 'San Marino', 'SM', 'SMR', '', 0, 1),
(183, 'Sao Tome and Principe', 'ST', 'STP', '', 0, 1),
(184, 'Saudi Arabia', 'SA', 'SAU', '', 0, 1),
(185, 'Senegal', 'SN', 'SEN', '', 0, 1),
(186, 'Seychelles', 'SC', 'SYC', '', 0, 1),
(187, 'Sierra Leone', 'SL', 'SLE', '', 0, 1),
(188, 'Singapore', 'SG', 'SGP', '', 0, 1),
(189, 'Slovak Republic', 'SK', 'SVK', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{city} {postcode}\r\n{zone}\r\n{country}', 0, 1),
(190, 'Slovenia', 'SI', 'SVN', '', 0, 1),
(191, 'Solomon Islands', 'SB', 'SLB', '', 0, 1),
(192, 'Somalia', 'SO', 'SOM', '', 0, 1),
(193, 'South Africa', 'ZA', 'ZAF', '', 0, 1),
(194, 'South Georgia &amp; South Sandwich Islands', 'GS', 'SGS', '', 0, 1),
(195, 'Spain', 'ES', 'ESP', '', 0, 1),
(196, 'Sri Lanka', 'LK', 'LKA', '', 0, 1),
(197, 'St. Helena', 'SH', 'SHN', '', 0, 1),
(198, 'St. Pierre and Miquelon', 'PM', 'SPM', '', 0, 1),
(199, 'Sudan', 'SD', 'SDN', '', 0, 1),
(200, 'Suriname', 'SR', 'SUR', '', 0, 1),
(201, 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM', '', 0, 1),
(202, 'Swaziland', 'SZ', 'SWZ', '', 0, 1),
(203, 'Sweden', 'SE', 'SWE', '{company}\r\n{firstname} {lastname}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 1, 1),
(204, 'Switzerland', 'CH', 'CHE', '', 0, 1),
(205, 'Syrian Arab Republic', 'SY', 'SYR', '', 0, 1),
(206, 'Taiwan', 'TW', 'TWN', '', 0, 1),
(207, 'Tajikistan', 'TJ', 'TJK', '', 0, 1),
(208, 'Tanzania, United Republic of', 'TZ', 'TZA', '', 0, 1),
(209, 'Thailand', 'TH', 'THA', '', 0, 1),
(210, 'Togo', 'TG', 'TGO', '', 0, 1),
(211, 'Tokelau', 'TK', 'TKL', '', 0, 1),
(212, 'Tonga', 'TO', 'TON', '', 0, 1),
(213, 'Trinidad and Tobago', 'TT', 'TTO', '', 0, 1),
(214, 'Tunisia', 'TN', 'TUN', '', 0, 1),
(215, 'Turkey', 'TR', 'TUR', '', 0, 1),
(216, 'Turkmenistan', 'TM', 'TKM', '', 0, 1),
(217, 'Turks and Caicos Islands', 'TC', 'TCA', '', 0, 1),
(218, 'Tuvalu', 'TV', 'TUV', '', 0, 1),
(219, 'Uganda', 'UG', 'UGA', '', 0, 1),
(220, 'Ukraine', 'UA', 'UKR', '', 0, 1),
(221, 'United Arab Emirates', 'AE', 'ARE', '', 0, 1),
(222, 'United Kingdom', 'GB', 'GBR', '', 1, 1),
(223, 'United States', 'US', 'USA', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{city}, {zone} {postcode}\r\n{country}', 0, 1),
(224, 'United States Minor Outlying Islands', 'UM', 'UMI', '', 0, 1),
(225, 'Uruguay', 'UY', 'URY', '', 0, 1),
(226, 'Uzbekistan', 'UZ', 'UZB', '', 0, 1),
(227, 'Vanuatu', 'VU', 'VUT', '', 0, 1),
(228, 'Vatican City State (Holy See)', 'VA', 'VAT', '', 0, 1),
(229, 'Venezuela', 'VE', 'VEN', '', 0, 1),
(230, 'Viet Nam', 'VN', 'VNM', '', 0, 1),
(231, 'Virgin Islands (British)', 'VG', 'VGB', '', 0, 1),
(232, 'Virgin Islands (U.S.)', 'VI', 'VIR', '', 0, 1),
(233, 'Wallis and Futuna Islands', 'WF', 'WLF', '', 0, 1),
(234, 'Western Sahara', 'EH', 'ESH', '', 0, 1),
(235, 'Yemen', 'YE', 'YEM', '', 0, 1),
(237, 'Democratic Republic of Congo', 'CD', 'COD', '', 0, 1),
(238, 'Zambia', 'ZM', 'ZMB', '', 0, 1),
(239, 'Zimbabwe', 'ZW', 'ZWE', '', 0, 1),
(242, 'Montenegro', 'ME', 'MNE', '', 0, 1),
(243, 'Serbia', 'RS', 'SRB', '', 0, 1),
(244, 'Aaland Islands', 'AX', 'ALA', '', 0, 1),
(245, 'Bonaire, Sint Eustatius and Saba', 'BQ', 'BES', '', 0, 1),
(246, 'Curacao', 'CW', 'CUW', '', 0, 1),
(247, 'Palestinian Territory, Occupied', 'PS', 'PSE', '', 0, 1),
(248, 'South Sudan', 'SS', 'SSD', '', 0, 1),
(249, 'St. Barthelemy', 'BL', 'BLM', '', 0, 1),
(250, 'St. Martin (French part)', 'MF', 'MAF', '', 0, 1),
(251, 'Canary Islands', 'IC', 'ICA', '', 0, 1),
(252, 'Ascension Island (British)', 'AC', 'ASC', '', 0, 1),
(253, 'Kosovo, Republic of', 'XK', 'UNK', '', 0, 1),
(254, 'Isle of Man', 'IM', 'IMN', '', 0, 1),
(255, 'Tristan da Cunha', 'TA', 'SHN', '', 0, 1),
(256, 'Guernsey', 'GG', 'GGY', '', 0, 1),
(257, 'Jersey', 'JE', 'JEY', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `coupon_id` int(11) UNSIGNED NOT NULL,
  `client_id` int(11) UNSIGNED NOT NULL,
  `coupon_type_id` int(11) UNSIGNED NOT NULL,
  `coupon_name` varchar(60) NOT NULL,
  `coupon_code` varchar(20) NOT NULL,
  `coupon_start_date` date NOT NULL,
  `coupon_end_date` date NOT NULL,
  `coupon_max_uses` int(11) UNSIGNED NOT NULL,
  `coupon_customer_limit` tinyint(1) NOT NULL,
  `coupon_reduction_type` tinyint(1) NOT NULL,
  `coupon_reduction_amt` float DEFAULT NULL,
  `coupon_trial_length` int(4) NOT NULL,
  `coupon_deleted` tinyint(1) UNSIGNED NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`coupon_id`, `client_id`, `coupon_type_id`, `coupon_name`, `coupon_code`, `coupon_start_date`, `coupon_end_date`, `coupon_max_uses`, `coupon_customer_limit`, `coupon_reduction_type`, `coupon_reduction_amt`, `coupon_trial_length`, `coupon_deleted`, `created_on`, `modified_on`) VALUES
(1, 1000, 1, 'one - off', '1212', '2015-05-07', '0000-00-00', 0, 1, 0, 20, 0, 0, '2015-05-07 06:18:39', NULL),
(2, 1000, 1, 'Canadian Tax Savings', '220374', '2015-07-21', '0000-00-00', 0, 1, 0, 15, 0, 0, '2015-07-21 04:57:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons_plans`
--

CREATE TABLE `coupons_plans` (
  `coupon_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_types`
--

CREATE TABLE `coupon_types` (
  `coupon_type_id` int(3) NOT NULL,
  `coupon_type_name` varchar(255) NOT NULL
) ;

--
-- Dumping data for table `coupon_types`
--

INSERT INTO `coupon_types` (`coupon_type_id`, `coupon_type_name`) VALUES
(1, 'Charge - Price Reduction'),
(2, 'Recur - Total Price Reduction'),
(3, 'Recur - Recurring Price Reduction'),
(4, 'Recur - Initial Charge Price Reduction'),
(5, 'Recur - Free Trial');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `code` varchar(5) NOT NULL,
  `name` varchar(55) NOT NULL,
  `rate` decimal(10,3) NOT NULL,
  `auto_update` tinyint(1) NOT NULL DEFAULT '0'
) ;

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
) ;

--
-- Dumping data for table `currencys`
--

INSERT INTO `currencys` (`id`, `base_name`, `base_code`, `extra1_check`, `extra1_name`, `extra1_code`, `extra1_rate`, `extra2_check`, `extra2_name`, `extra2_code`, `extra2_rate`, `extra3_check`, `extra3_name`, `extra3_code`, `extra3_rate`, `extra4_check`, `extra4_name`, `extra4_code`, `extra4_rate`, `extra5_check`, `extra5_name`, `extra5_code`, `extra5_rate`) VALUES
(1, 'Base Wallet', 'USD', 1, 'Russian Ruble', 'RUB', '51.99', 1, 'Euro', 'EUR', '0.65', 0, 'Grivna Ukraine', 'UAH', '1.50', 1, 'Chine Wallet', 'CNY', '18.00', 1, 'Gold 958', 'GLD', '980.00');

-- --------------------------------------------------------

--
-- Table structure for table `discount_codes`
--

CREATE TABLE `discount_codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(10) NOT NULL,
  `code` varchar(10) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `valid_from_date` int(10) UNSIGNED NOT NULL,
  `valid_to_date` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-enabled, 0-disabled'
) ;

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
) ;

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
) ;

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
) ;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `message` text NOT NULL
) ;

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
(17, 'Claim satisfied', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">The dispute status is changed!</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Claim satisfied! </strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hellow!<br />\r\n						<br />\r\n						After a thorough analysis of the evidence provided in the dispute [ID_DISPUTE], we completed the investigation and decided in favor of the sender of payment. Money was returned by transaction ID [ID_TRANSACTION].</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[URL_DISPUTE][ID_DISPUTE]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">Go to the site</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]<br />\r\n						&nbsp;</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(18, 'Request payment', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<!-- 100% body table -->\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td><!-- header -->\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">Request payment</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			<!--// header --><!-- main wrapper -->\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\"><!-- logo -->\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<!--// logo --><!-- Красный блок -->\r\n					<tr>\r\n						<td style=\"background: #7867a7;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #7867a7;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Create invoice [INV]</strong></p>\r\n						</td>\r\n						<td style=\"background: #7867a7;\">&nbsp;</td>\r\n					</tr>\r\n					<!--// Красный блок --><!-- welcome message -->\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						You have a new invoice for payment. Carefully read the details and make payment.</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<!--// welcome message --><!-- таблица с договором и суммой -->\r\n					<tr>\r\n						<td height=\"10\" style=\"border-top: 1px solid #e7e1bd; background: #fff9d4;\">&nbsp;</td>\r\n						<td height=\"10\" style=\"border-top: 1px solid #e7e1bd; background: #fff9d4;\">&nbsp;</td>\r\n						<td height=\"10\" style=\"border-top: 1px solid #e7e1bd; background: #fff9d4;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td bgcolor=\"#fff9d4\">&nbsp;</td>\r\n						<td bgcolor=\"#fff9d4\">\r\n						<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n							<tbody>\r\n								<tr>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd;\" width=\"200\">\r\n									<p style=\"font: 15px/20px Helvetica, Arial, sans-serif; color: #888a84; margin: 1em 0;\">Date created</p>\r\n									</td>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd; content: \'\';\" width=\"20\">&nbsp;</td>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd;\" width=\"200\">\r\n									<p style=\"font: 15px/20px Helvetica, Arial, sans-serif; color: #303030; margin: 1em 0;\">[DATE]</p>\r\n									</td>\r\n								</tr>\r\n								<tr>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd;\" width=\"200\">\r\n									<p style=\"font: 15px/20px Helvetica, Arial, sans-serif; color: #888a84; margin: 1em 0;\">Username sender</p>\r\n									</td>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd; content: \'\';\" width=\"20\">&nbsp;</td>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd;\" width=\"200\">\r\n									<p style=\"font: 15px/20px Helvetica, Arial, sans-serif; color: #303030; margin: 1em 0;\">[SENDER]</p>\r\n									</td>\r\n								</tr>\r\n								<tr>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd;\" width=\"200\">\r\n									<p style=\"font: 15px/20px Helvetica, Arial, sans-serif; color: #888a84; margin: 1em 0;\">Purpose of payment</p>\r\n									</td>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd; content: \'\';\" width=\"20\">&nbsp;</td>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd;\" width=\"200\">\r\n									<p style=\"font: 15px/20px Helvetica, Arial, sans-serif; color: #303030; margin: 1em 0;\">[PURPOSE]</p>\r\n									</td>\r\n								</tr>\r\n								<tr>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd;\" width=\"200\">\r\n									<p style=\"font: 15px/20px Helvetica, Arial, sans-serif; color: #888a84; margin: 1em 0;\">Amount</p>\r\n									</td>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd; content: \'\';\" width=\"20\">&nbsp;</td>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd;\" width=\"200\">\r\n									<p style=\"font: 15px/20px Helvetica, Arial, sans-serif; color: #303030; margin: 1em 0;\"><strong>[AMOUNT]</strong></p>\r\n									</td>\r\n								</tr>\r\n								<tr>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd;\" width=\"200\">\r\n									<p style=\"font: 15px/20px Helvetica, Arial, sans-serif; color: #888a84; margin: 1em 0;\">Currency</p>\r\n									</td>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd; content: \'\';\" width=\"20\">&nbsp;</td>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd;\" width=\"200\">\r\n									<p style=\"font: 15px/20px Helvetica, Arial, sans-serif; color: #303030; margin: 1em 0;\">[CYR]</p>\r\n									</td>\r\n								</tr>\r\n								<tr>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd;\" width=\"200\">\r\n									<p style=\"font: 15px/20px Helvetica, Arial, sans-serif; color: #888a84; margin: 1em 0;\">Note for recipient</p>\r\n									</td>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd; content: \'\';\" width=\"20\">&nbsp;</td>\r\n									<td style=\"border-bottom: 1px solid #e7e1bd;\" width=\"200\">\r\n									<p style=\"font: 15px/20px Helvetica, Arial, sans-serif; color: #303030; margin: 1em 0;\">[NOTE]</p>\r\n									</td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n						<td bgcolor=\"#fff9d4\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td height=\"10\" style=\"border-top: 1px solid #e7e1bd;\">&nbsp;</td>\r\n						<td height=\"10\" style=\"border-top: 1px solid #e7e1bd;\">&nbsp;</td>\r\n						<td height=\"10\" style=\"border-top: 1px solid #e7e1bd;\">&nbsp;</td>\r\n					</tr>\r\n					<!--// таблица с договором и суммой --><!-- блок страшилка -->\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #wwwwww; border-bottom: 1px solid #wwwwww;\">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #wwwwww; border-bottom: 1px solid #wwwwww;\">\r\n						<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n							<tbody>\r\n								<tr>\r\n									<td align=\"left\" valign=\"top\" width=\"95\">\r\n									<p style=\"margin: 25px 0;\"><a href=\"#\" style=\"text-decoration: none;\" target=\"_blank\"><img alt=\"\" height=\"40\" src=\"http://static.tcsbank.ru/email/2014small/warning_11_11.png\" style=\"display: block; margin: 20px 0 20px 0;\" /> </a></p>\r\n									</td>\r\n									<td width=\"500\">\r\n									<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 10px 0;\">Do not transfer money to strangers - they can be scammers! Notify in support if you think it is spam.</p>\r\n									</td>\r\n								</tr>\r\n							</tbody>\r\n						</table>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #wwwwww; border-bottom: 1px solid #wwwwww;\">&nbsp;</td>\r\n					</tr>\r\n					<!--// блок страшилка --><!-- button промо с2с -->\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[LINK]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7ab55c; border-radius: 4px;\" target=\"_blank\">Go to account</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n					<!--// button промо с2с -->\r\n				</tbody>\r\n			</table>\r\n			<!--// main wrapper --><!-- footer -->\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]<br />\r\n						&nbsp;</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			<!--// footer --></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table -->\r\n\r\n<div style=\"display:none; white-space:nowrap; font:14px courier; line-height:0;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>\r\n'),
(19, 'Merchant activated!', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">The merchant&nbsp;status is changed!</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Merchant activated! </strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						Your application for creating merchant ID [ID_MERCHANT] is satisfied!&nbsp;Now you can accept payments via SCI.</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[URL_MERCHANT]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">All merchants</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]<br />\r\n						&nbsp;</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(20, 'Merchant rejected', '&lt;meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"&gt;\r\n&lt;title&gt;&lt;/title&gt;\r\n&lt;style type=\"text/css\"&gt;a:hover { text-decoration: underline !important; }\r\n\r\n  @media only screen and (min-width: 640px) {\r\n     *[class].wrapper { width: 480px !important; }\r\n     *[class].wrapper__indent { width: 60px !important; }\r\n  }\r\n&lt;/style&gt;\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" xss=removed width=\"100%\">\r\n <tbody>\r\n  <tr>\r\n   <td>\r\n   <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" xss=removed width=\"100%\">\r\n    <tbody>\r\n     <tr>\r\n      <td align=\"center\" height=\"45\" valign=\"middle\">\r\n      <p xss=removed>The status of merchant has changed!</p>\r\n      </td>\r\n     </tr>\r\n    </tbody>\r\n   </table>\r\n\r\n   <table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" xss=removed width=\"480\">\r\n    <tbody>\r\n     <tr>\r\n      <td class=\"wrapper__indent\" xss=removed width=\"30\"> </td>\r\n      <td align=\"center\" height=\"70\" xss=removed valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" xss=removed width=\"58\"> </a></td>\r\n      <td class=\"wrapper__indent\" xss=removed width=\"30\"> </td>\r\n     </tr>\r\n     <tr>\r\n      <td xss=removed> </td>\r\n      <td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" xss=removed>\r\n      <p xss=removed><strong>Account Declined!</strong></p>\r\n      </td>\r\n      <td xss=removed> </td>\r\n     </tr>\r\n     <tr>\r\n      <td> </td>\r\n      <td>\r\n      <p xss=removed>Hello!<br>\r\n      <br>\r\n      Your application for creating merchant ID  [ID_MERCHANT] has been declined. Please contact our underwriting department for further details.</p>\r\n      </td>\r\n      <td> </td>\r\n     </tr>\r\n     <tr>\r\n      <td xss=removed> </td>\r\n      <td xss=removed>\r\n      <p align=\"center\" xss=removed><a alias=\"button\" href=\"[URL_MERCHANT]\" xss=removed target=\"_blank\">All merchants</a></p>\r\n      </td>\r\n      <td xss=removed> </td>\r\n     </tr>\r\n    </tbody>\r\n   </table>\r\n\r\n   <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" xss=removed width=\"100%\">\r\n    <tbody>\r\n     <tr>\r\n      <td align=\"center\" height=\"45\" valign=\"middle\">\r\n      <p xss=removed>Have a questions? Contact our <a href=\"https://support.everpayinc.com\">Support</a>.<br>\r\n      [SITE_NAME]</p>\r\n      </td>\r\n     </tr>\r\n    </tbody>\r\n   </table>\r\n   </td>\r\n  </tr>\r\n </tbody>\r\n</table>\r\n&lt;!--// 100% body table --&gt;&lt;!--suc_mail6 --&gt;'),
(21, 'New ticket!', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">The ticket status is changed!</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>New ticket! </strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						You have received a new request from the support team.&nbsp;We await your response!</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[URL_TICKET]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">All tickets</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]<br />\r\n						&nbsp;</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(22, 'Success money transfer', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">The transaction status is changed!</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Success money transfer! </strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						You have successfully transferred [SUM] [CYR]&nbsp;to the user [RECEIVER].&nbsp;You can see the details in your account.</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[URL_HISTORY]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">Operations history</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(23, 'Confirm account', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">Account registration</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Confirm account!</strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						Thank you for creating an account at [SITE_NAME]. Click the link below to validate your email address and activate your account.</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[CHECK_LINK]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">Confirm email</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(24, 'Reset password', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">Account registration</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Reset password!</strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						Your password at [SITE_NAME] has been reset. Click the link below to log in with your new password.</p>\r\n\r\n						<p style=\"color: #303030; font: 18px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\"><strong>[PASSWORD]</strong></p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[LOGIN_LINK]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">My account</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(25, 'Withdrawal is confirmed', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">The transaction status is changed!</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Withdrawal is confirmed! </strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						The withdrawal of funds in the amount of [SUM] [CYR] was confirmed by the administrator.</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[URL_HISTORY]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">Operations history</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(26, 'Withdrawal of funds denied', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">The transaction status is changed!</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #F44336;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #F44336;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Withdrawal of funds denied! </strong></p>\r\n						</td>\r\n						<td style=\"background: #F44336;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 25px 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						The withdrawal of funds in the amount of [SUM] [CYR] was rejected by the administrator. Funds refund to your account.</p>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">\r\n						<p align=\"center\" style=\"margin: 10px 0 25px;\"><a alias=\"button\" href=\"[URL_HISTORY]\" style=\"text-decoration: none; font: 17px/40px Helvetica, Arial, sans-serif; color: #ffffff; display: block; width: 225px; background: #7867a7; border-radius: 4px;\" target=\"_blank\">Operations history</a></p>\r\n						</td>\r\n						<td style=\"border-top: 0px solid #dee0e1; \">&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->'),
(27, 'Make payment', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n<title></title>\r\n<style type=\"text/css\">a:hover { text-decoration: underline !important; }\r\n\r\n		@media only screen and (min-width: 640px) {\r\n    	*[class].wrapper { width: 480px !important; }\r\n    	*[class].wrapper__indent { width: 60px !important; }\r\n		}\r\n</style>\r\n<table bgcolor=\"#ebedef\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/24px Arial, sans-serif, Helvetica; color: #939aa4; margin: 0px;\">New invoice</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table align=\"center\" bgcolor=\"#ffffff\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"wrapper\" style=\"background-color: #ffffff; border: 1px solid #c8cace; border-radius: 4px; margin: auto;\" width=\"480\">\r\n				<tbody>\r\n					<tr>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n						<td align=\"center\" height=\"70\" style=\"border-bottom: 1px solid #wwwwww;\" valign=\"middle\"><a alias=\"site_logo\" href=\"#\" target=\"_blank\"><img alt=\"\" height=\"58\" src=\"http://en.unipay.ideah.ru/themes/default/img/logo-mail.png\" style=\"display: block;\" width=\"58\" /> </a></td>\r\n						<td class=\"wrapper__indent\" style=\"border-bottom: 1px solid #wwwwww;\" width=\"30\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n						<td align=\"center\" bgcolor=\"#7ab55c\" height=\"50\" style=\"background: #4caf50;\">\r\n						<p style=\"font: 17px/20px Helvetica, Arial, sans-serif; color: #ffffff;\"><strong>Make payment</strong></p>\r\n						</td>\r\n						<td style=\"background: #4caf50;\">&nbsp;</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>\r\n						<p style=\"color: #303030; font: 15px/20px Helvetica, Arial, sans-serif; margin: 25px 0 0 0; text-align: center;\">Hello!<br />\r\n						<br />\r\n						Created an invoice for [SUM_USD] [CYR]. To pay the bill transfer [SUM_BTC] BTC to the purse:<br />\r\n						<br />\r\n						<strong>[ADRESS]</strong>.</p>\r\n\r\n						<center><img src=\"https://chart.googleapis.com/chart?chs=300x300&amp;cht=qr&amp;chl=bitcoin:[ADRESS]\" /></center>\r\n						</td>\r\n						<td>&nbsp;</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td align=\"center\" height=\"45\" valign=\"middle\">\r\n						<p style=\"font: 13px/20px Arial, sans-serif, Helvetica; color: #939aa4; margin: 20px 0 0;\">Have a questions? Write to the Support Service.<br />\r\n						[SITE_NAME]</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<!--// 100% body table --><!--suc_mail6 -->');

-- --------------------------------------------------------

--
-- Table structure for table `estados`
--

CREATE TABLE `estados` (
  `id_estado` tinyint(1) UNSIGNED NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ;

--
-- Dumping data for table `estados`
--

INSERT INTO `estados` (`id_estado`, `nombre`) VALUES
(1, 'Pendiente'),
(2, 'En proceso'),
(3, 'Finalizada'),
(4, 'Cancelada');

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
) ;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `card_check`, `card_fee`, `pp_check`, `pp_fee`, `btc_check`, `btc_fee`, `adv_check`, `adv_fee`, `wm_check`, `wm_fee`, `payeer_check`, `payeer_fee`, `qiwi_check`, `qiwi_fee`, `perfect_check`, `perfect_fee`, `swift_fee`, `swift_check`, `check_pp_dep`, `fee_pp_dep`, `account_pp`, `check_payeer_dep`, `fee_payeer_dep`, `merch_payeer`, `key_payeer`, `crypt_payeer`, `check_adv_dep`, `fee_adv_dep`, `account_adv`, `name_adv`, `secret_adv`, `check_perfect`, `fee_perfect`, `account_perfect`, `check_btc_dep`, `shop_btc`, `pass_btc`, `fee_btc_dep`, `key_perfect`, `swift_dep_check`, `fee_swift_dep`, `swift_desc`, `check_pp_sci`, `fee_pp_sci`, `account_pp_sci`, `check_payeer_sci`, `fee_payeer_sci`, `merch_payeer_sci`, `key_payeer_sci`, `crypt_payeer_sci`, `check_adv_sci`, `fee_adv_sci`, `account_adv_sci`, `name_adv_sci`, `secret_adv_sci`, `check_perfect_sci`, `fee_perfect_sci`, `account_perfect_sci`, `key_perfect_sci`, `check_btc_sci`, `fee_btc_sci`, `shop_btc_sci`, `pass_btc_sci`, `swift_sci_check`, `fee_swift_sci`, `swift_desc_sci`, `ux_check`, `fee_ux`, `xpub`, `sci_xpub`, `fee_pay_fix`, `fee_adv_fix`, `fee_perf_fix`, `fee_btc_fix`, `fee_swift_fix`, `sci_pp_fee_fix`, `sci_pay_fee_fix`, `sci_adv_fix`, `sci_per_fee_fix`, `sci_btc_fee_fix`, `sci_swift_fee_fix`, `ux_fee_fix`, `fee_pp_fix_dep`) VALUES
(1, 1, '5', 1, '50', 1, '3', 1, '3', 1, '3', 1, '3', 1, '3', 1, '3', '8', 1, 1, '1', 'justwalletpw@yandex.ru', 1, '1', '364478513', '123', '123', 1, '1', '', '', '', 1, '1', '', 1, '', '', '10', '', 1, '1', '<p><strong>Bank Name:</strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; First Century Bank<br />\r\n<strong>Routing (ABA):</strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;061120084<br />\r\n<strong>Account Number:&nbsp;</strong>&nbsp; &nbsp; 4012556950739<br />\r\n<strong>Account Type:</strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;CHECKING<br />\r\n<strong>Beneficiary Name:</strong>&nbsp;&nbsp; &nbsp;Just Wallet LLC</p>\r\n', 1, '10', 'justwalletpw@yandex.u', 1, '1', '', '', '', 1, '0', '', '', '', 1, '1', '', '', 1, '0', '', '', 1, '1', '', 1, '1', '', '', '12.00', '8.00', '0.00', '0.50', '500.00', '1.00', '2.00', '0.00', '4.00', '0.00', '6.00', '7.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `groups_permissions`
--

CREATE TABLE `groups_permissions` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `perm_id` int(11) NOT NULL,
  `value` tinyint(4) DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(10) UNSIGNED NOT NULL,
  `activity` varchar(255) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `time` int(10) UNSIGNED NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `hosted_pages_links`
--

CREATE TABLE `hosted_pages_links` (
  `hosted_pages_link_hash` varchar(32) NOT NULL,
  `hosted_pages_link_path` varchar(250) NOT NULL,
  `hosted_pages_link_payments` int(2) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `igo_login_attempts`
--

CREATE TABLE `igo_login_attempts` (
  `id` bigint(20) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(255) NOT NULL,
  `time` timestamp NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `igo_menu`
--

CREATE TABLE `igo_menu` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `menu_group` varchar(20) NOT NULL DEFAULT 'admin',
  `parent_id` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `menu_order` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `level` tinyint(1) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL
) ;

--
-- Dumping data for table `igo_menu`
--

INSERT INTO `igo_menu` (`id`, `menu_group`, `parent_id`, `title`, `url`, `menu_order`, `status`, `level`, `icon`, `description`) VALUES
(1, 'admin', 0, 'Admin Home', '/dashboard/index', 1, 1, 0, 'fa fa-dashboard', NULL),
(3, 'admin', 0, 'Manage', '#', 3, 1, 2, 'fa fa-sitemap', NULL),
(6, 'admin', 3, 'Users', '/admin/users', 1, 1, 1, 'fa fa-users', ''),
(7, 'admin', 3, 'Language Translations', '/admin/translations', 2, 1, 1, 'fa fa-globe', ''),
(8, 'admin', 3, 'Menu Editor', '/buildamenu', 4, 1, 1, 'fa fa-elementor', ''),
(33, 'admin', 0, 'Reports', '#', 5, 1, 0, 'fa fa-bar-chart-o', NULL),
(35, 'admin', 33, 'Sample Summary', '#', 1, 1, 2, '', NULL),
(36, 'admin', 33, 'Sample Detail Report', '#', 3, 1, 2, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `igo_schema_version`
--

CREATE TABLE `igo_schema_version` (
  `type` varchar(40) NOT NULL,
  `version` int(4) NOT NULL DEFAULT '0'
) ;

-- --------------------------------------------------------

--
-- Table structure for table `igo_sec_permissions`
--

CREATE TABLE `igo_sec_permissions` (
  `permission_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` enum('active','inactive','deleted') NOT NULL DEFAULT 'active'
) ;

--
-- Dumping data for table `igo_sec_permissions`
--

INSERT INTO `igo_sec_permissions` (`permission_id`, `name`, `description`, `status`) VALUES
(10, 'App.Settings.View', 'To view the app settings page.', 'active'),
(11, 'App.Settings.Manage', 'To manage the app settings.', 'active'),
(12, 'App.Logs.View', 'Allow users access to the Log details', 'active'),
(13, 'App.Logs.Manage', 'Allow users to manage the Log files', 'active'),
(14, 'App.Modules.Add', 'Allow creation of modules with the builder.', 'active'),
(15, 'App.Modules.Delete', 'Allow deletion of modules.', 'active'),
(16, 'App.Permissions.View', 'Allow access to view the Permissions menu unders Settings Context', 'active'),
(17, 'App.Permissions.Manage', 'Allow access to manage the Permissions in the system', 'active'),
(18, 'App.Signin.Offline', 'Allow users to login even when the site/app is offline', 'active'),
(19, 'App.Users.Manage', 'Allow users to manage the Users', 'active'),
(20, 'App.Users.View', 'Allow users access to view all Users', 'active'),
(21, 'App.Users.Add', 'Allow users to add new Users', 'active'),
(22, 'Permissions.Administrator.Manage', 'To manage the access control permissions for the Administrator role.', 'active'),
(23, 'Permissions.Staff.Manage', 'To manage the access control permissions for the Staff role.', 'active'),
(24, 'Permissions.User.Manage', 'To manage the access control permissions for the User role.', 'active'),
(25, 'Permissions.Support.Manage', 'To manage the access control permissions for the Support role.', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `igo_sec_roles`
--

CREATE TABLE `igo_sec_roles` (
  `role` enum('admin','staff','user','support') NOT NULL DEFAULT 'admin',
  `role_name` varchar(60) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `can_delete` tinyint(1) NOT NULL DEFAULT '1',
  `login_destination` varchar(255) NOT NULL DEFAULT '/',
  `deleted` int(1) NOT NULL DEFAULT '0'
) ;

--
-- Dumping data for table `igo_sec_roles`
--

INSERT INTO `igo_sec_roles` (`role`, `role_name`, `description`, `default`, `can_delete`, `login_destination`, `deleted`) VALUES
('admin', 'Administrator', 'Has full control over every aspect.', 0, 0, '', 0),
('staff', 'Manager', 'Can handle day-to-day management.', 0, 1, '', 0),
('user', 'User', 'This is the default user with access to login.', 1, 0, '', 0),
('support', 'Support', 'Has subset of Administrator power.', 0, 1, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `igo_sec_role_permissions`
--

CREATE TABLE `igo_sec_role_permissions` (
  `id` int(11) NOT NULL,
  `role` enum('admin','staff','user','support') NOT NULL,
  `permission_id` int(11) NOT NULL
) ;

--
-- Dumping data for table `igo_sec_role_permissions`
--

INSERT INTO `igo_sec_role_permissions` (`id`, `role`, `permission_id`) VALUES
(1, 'admin', 10),
(2, 'admin', 11),
(3, 'admin', 12),
(4, 'admin', 13),
(5, 'admin', 14),
(6, 'admin', 15),
(7, 'admin', 16),
(8, 'admin', 17),
(9, 'admin', 18),
(10, 'admin', 19),
(11, 'admin', 20),
(12, 'admin', 21),
(13, 'admin', 22),
(14, 'admin', 23),
(15, 'admin', 24),
(16, 'admin', 25);

-- --------------------------------------------------------

--
-- Table structure for table `igo_sessions`
--

CREATE TABLE `igo_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `igo_settings`
--

CREATE TABLE `igo_settings` (
  `name` varchar(30) NOT NULL,
  `category` varchar(255) NOT NULL,
  `scope` varchar(50) NOT NULL,
  `value` varchar(500) NOT NULL,
  `textvalue` text
) ;

--
-- Dumping data for table `igo_settings`
--

INSERT INTO `igo_settings` (`name`, `category`, `scope`, `value`, `textvalue`) VALUES
('app.list_limit', 'app', 'all', '25', NULL),
('app.show_front_profiler', 'app', 'all', '1', NULL),
('app.show_profiler', 'app', 'all', '1', NULL),
('app.status', 'app', 'all', '1', NULL),
('app.system_email', 'app', 'all', 'admin@ciblox.com', NULL),
('app.title', 'app', 'all', 'My Ignition Go App', NULL),
('auth.allow_name_change', 'auth', 'user', '1', NULL),
('auth.allow_register', 'auth', 'user', '1', NULL),
('auth.allow_remember', 'auth', 'user', '1', NULL),
('auth.do_login_redirect', 'auth', 'user', '1', NULL),
('auth.login_type', 'auth', 'user', 'email', NULL),
('auth.name_change_frequency', 'auth', 'user', '1', NULL),
('auth.name_change_limit', 'auth', 'user', '1', NULL),
('auth.password_force_mixed_case', 'auth', 'user', '0', NULL),
('auth.password_force_numbers', 'auth', 'user', '0', NULL),
('auth.password_force_symbols', 'auth', 'user', '0', NULL),
('auth.password_min_length', 'auth', 'user', '8', NULL),
('auth.password_show_labels', 'auth', 'user', '0', NULL),
('auth.remember_length', 'auth', 'user', '1209600', NULL),
('auth.user_activation_method', 'auth', 'user', '0', NULL),
('auth.use_extended_profile', 'auth', 'user', '0', NULL),
('auth.use_usernames', 'auth', 'user', '1', NULL),
('mailpath', 'email', 'all', '/usr/sbin/sendmail', NULL),
('mailtype', 'email', 'all', 'text', NULL),
('protocol', 'email', 'all', 'mail', NULL),
('sender_email', 'email', 'all', '', NULL),
('smtp_host', 'email', 'all', '', NULL),
('smtp_pass', 'email', 'all', '', NULL),
('smtp_port', 'email', 'all', '', NULL),
('smtp_timeout', 'email', 'all', '', NULL),
('smtp_user', 'common', 'all', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `igo_users`
--

CREATE TABLE `igo_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` enum('admin','staff','user','support') NOT NULL DEFAULT 'user',
  `email` varchar(254) NOT NULL,
  `username` varchar(30) NOT NULL DEFAULT '',
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `password_hash` char(255) DEFAULT NULL,
  `reset_hash` varchar(40) DEFAULT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_ip` varchar(45) NOT NULL DEFAULT '',
  `force_password_reset` tinyint(1) DEFAULT '0',
  `reset_by` int(10) DEFAULT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_message` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT '',
  `display_name_changed` date DEFAULT NULL,
  `timezone` varchar(40) NOT NULL DEFAULT 'UM6',
  `language` varchar(20) NOT NULL DEFAULT 'english',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `activate_hash` varchar(40) NOT NULL DEFAULT '',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ;

--
-- Dumping data for table `igo_users`
--

INSERT INTO `igo_users` (`id`, `role`, `email`, `username`, `first_name`, `last_name`, `password_hash`, `reset_hash`, `last_login`, `last_ip`, `force_password_reset`, `reset_by`, `banned`, `ban_message`, `display_name`, `display_name_changed`, `timezone`, `language`, `active`, `activate_hash`, `created_on`, `modified_on`, `deleted`) VALUES
(1, 'admin', 'admin@ciblox.com', 'admin', NULL, NULL, '$2a$08$T/79zwGVEtodc2Sop8XPReTrv0WviLcFt1Zp3d3ywlAuVCrmsTszi', NULL, '0000-00-00 00:00:00', '', 0, NULL, 0, NULL, 'admin', NULL, 'UM6', 'english', 1, '', '2018-08-09 10:22:03', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `igo_user_cookies`
--

CREATE TABLE `igo_user_cookies` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(128) NOT NULL,
  `created_on` datetime NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `igo_user_meta`
--

CREATE TABLE `igo_user_meta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) NOT NULL DEFAULT '',
  `meta_value` text
) ;

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` int(11) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `currencyKey` varchar(5) NOT NULL,
  `flag` varchar(255) NOT NULL
) ;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `abbr`, `name`, `currency`, `currencyKey`, `flag`) VALUES
(1, 'bg', 'bulgarian', 'лв', 'BGN', 'bg.jpg'),
(2, 'en', 'english', '$', 'USD', 'en.jpg'),
(3, 'gr', 'greece', 'EUR', 'EUR', 'gr.png');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ;

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
) ;

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
(54, '43.241.146.85', '2018-06-13 10:14:00', '1', 'Chirag', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36'),
(55, '43.243.37.170', '2018-07-09 05:27:10', '1', 'elektropay.commerce@gmail.com', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36'),
(56, '186.14.168.192', '2018-07-12 11:26:38', '1', 'Vicalvore', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36'),
(57, '73.124.165.233', '2018-07-28 16:11:38', '1', 'nixonacn@yahoo.com', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36'),
(58, '177.237.155.235', '2018-08-01 19:12:49', '1', 'elektropay.commerce@gmail.com', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36'),
(59, '177.237.155.235', '2018-08-03 21:17:42', '1', 'elektropay.commerce@gmail.com', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36'),
(60, '177.237.155.235', '2018-08-03 21:29:44', '1', 'elektropay.commerce@gmail.com', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36'),
(61, '177.237.155.235', '2018-08-03 22:42:19', '1', 'elektropay.commerce@gmail.com', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36'),
(62, '177.237.156.43', '2018-08-06 23:24:46', '1', 'richard.r@everpayinc.com', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36'),
(63, '177.237.156.43', '2018-08-07 00:05:47', '1', 'elektropay.commerce@gmail.com', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36'),
(64, '43.241.146.56', '2018-08-07 03:38:22', '1', 'bhutvishal8@gmail.com', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36');

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
) ;

--
-- Dumping data for table `merchants`
--

INSERT INTO `merchants` (`id`, `link`, `password`, `status`, `name`, `user`, `comment`, `status_link`, `date`) VALUES
(9, 'http://www.roweium.com', 'Parise03', '2', 'Ewallet-Old', 'everpay', 'lets try it', 'gdfghgh', '2018-08-03 14:37:58');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'point to public_users ID',
  `products` text NOT NULL,
  `date` int(10) UNSIGNED NOT NULL,
  `referrer` varchar(255) NOT NULL,
  `clean_referrer` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `paypal_status` varchar(10) DEFAULT NULL,
  `processed` tinyint(1) NOT NULL DEFAULT '0',
  `viewed` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'viewed status is change when change processed status',
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `discount_code` varchar(20) DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `orders_clients`
--

CREATE TABLE `orders_clients` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(20) NOT NULL,
  `post_code` varchar(10) NOT NULL,
  `notes` text NOT NULL,
  `for_id` int(11) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `perm_key` varchar(30) NOT NULL,
  `perm_name` varchar(100) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `folder` int(10) UNSIGNED DEFAULT NULL COMMENT 'folder with images',
  `image` varchar(255) NOT NULL,
  `time` int(10) UNSIGNED NOT NULL COMMENT 'time created',
  `time_update` int(10) UNSIGNED NOT NULL COMMENT 'time updated',
  `visibility` tinyint(1) NOT NULL DEFAULT '1',
  `shop_categorie` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `procurement` int(10) UNSIGNED NOT NULL,
  `in_slider` tinyint(1) NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL,
  `virtual_products` varchar(500) DEFAULT NULL,
  `brand_id` int(5) DEFAULT NULL,
  `position` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL DEFAULT '0'
) ;

-- --------------------------------------------------------

--
-- Table structure for table `products_translations`
--

CREATE TABLE `products_translations` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `basic_description` text NOT NULL,
  `price` varchar(20) NOT NULL,
  `old_price` varchar(20) NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(11) UNSIGNED NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `seo_pages`
--

CREATE TABLE `seo_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL
) ;

--
-- Dumping data for table `seo_pages`
--

INSERT INTO `seo_pages` (`id`, `name`) VALUES
(1, 'home'),
(2, 'checkout'),
(3, 'contacts'),
(4, 'blog');

-- --------------------------------------------------------

--
-- Table structure for table `seo_pages_translations`
--

CREATE TABLE `seo_pages_translations` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `page_type` varchar(20) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(128) NOT NULL,
  `input_type` enum('input','textarea','radio','dropdown','timezones','file') NOT NULL,
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
) ;

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
-- Table structure for table `shop_categories`
--

CREATE TABLE `shop_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `sub_for` int(11) NOT NULL,
  `position` int(10) UNSIGNED NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `shop_categories_translations`
--

CREATE TABLE `shop_categories_translations` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(11) UNSIGNED NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `sms_template`
--

CREATE TABLE `sms_template` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `message` text NOT NULL,
  `enable` int(11) NOT NULL
) ;

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
-- Table structure for table `subscribed`
--

CREATE TABLE `subscribed` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `tareas`
--

CREATE TABLE `tareas` (
  `id_tarea` tinyint(1) UNSIGNED NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `id_estado` tinyint(1) UNSIGNED NOT NULL,
  `fecha_alta` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL,
  `fecha_baja` datetime DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `textual_pages_tanslations`
--

CREATE TABLE `textual_pages_tanslations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(10) UNSIGNED NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `user` varchar(128) NOT NULL,
  `title` text NOT NULL,
  `status` enum('1','2','3') NOT NULL,
  `comment` int(11) NOT NULL,
  `message` text NOT NULL,
  `comments` int(11) NOT NULL
) ;

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
) ;

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
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
) ;

--
-- Dumping data for table `transfers`
--

INSERT INTO `transfers` (`id`, `type`, `sum`, `fee`, `amount`, `status`, `sender`, `receiver`, `time`, `user_comment`, `admin_comment`, `currency`) VALUES
(808, '1', '100.00', '0.00', '100.00', '2', 'system', 'elektropay', '2018-04-03 05:32:16', ' ', ' ', 'debit_base'),
(809, '1', '650.00', '0.00', '650.00', '2', 'system', 'everpay', '2018-04-19 20:13:44', ' test deposit', ' hi i funded your account', 'debit_base');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `uuid` varchar(100) DEFAULT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, 'ev666222333us', '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'everpay@gmail.com', '', NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Admin', 'istrator', 'ADMIN', '0');

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
) ;

--
-- Dumping data for table `users_business`
--

INSERT INTO `users_business` (`id`, `users_id`, `business_name`, `business_type`, `business_phone`, `website`, `business_address`, `postal_code`, `country`, `city`, `state`, `sdate`, `created`, `updated`) VALUES
(13, 71, 'V', 'private_corporation', '1236547890', 'v', 'v', 'v', 'v', 'v', 'v', '2018-06-16 20:18:00', '2018-06-16 01:34:44', '0000-00-00 00:00:00'),
(14, 72, 'c', 'limited_liability_corporation', '9998735489', 'qqwq', 'University Road', '360005', 'India', 'Rajkot', 'Gujarat', '2018-07-02 20:18:00', '2018-07-02 08:22:20', '0000-00-00 00:00:00'),
(15, 73, 'zzz', 'limited_liability_corporation', '9999999', 'xsa', 'sas', '360005', 'India', 'Rajkot', 'Gj', '2018-07-11 20:18:00', '2018-07-02 08:25:21', '0000-00-00 00:00:00'),
(16, 74, 'a', 'private_corporation', '1', '1', 'a', 'z', 'a', 'a', 'a', '2018-07-25 20:18:00', '2018-07-02 08:45:24', '0000-00-00 00:00:00'),
(17, 75, 'Vacations International LLC', 'limited_liability_corporation', '9543042123', 'www.vitravel.tours', '2700 west atlantic blvd, suite 206', '33069', 'United States', 'pompano beach', 'fl', '2018-03-09 20:18:00', '2018-07-11 20:38:57', '0000-00-00 00:00:00'),
(18, 76, 'Saime', 'public_corporation', '04167800255', 'no', 'Sector El Paraiso, calle Libertador, Nro 41', '6003', 'Venezuela', 'Anaco', 'Anzoategui', '2018-07-12 20:18:00', '2018-07-12 11:21:01', '0000-00-00 00:00:00'),
(19, 77, 'gmail.com', 'partnership_llp', '2566666666', 'gmail.com', 'gmail.com', '56332', 'gmail.com', 'gmail.com', 'gmail.com', '2018-07-16 20:18:00', '2018-07-16 14:40:54', '0000-00-00 00:00:00'),
(22, 80, 'A', 'private_corporation', '12121', 'ABC', 'University Road', '360005', 'India', 'Rajkot', 'Gj', '2018-07-24 20:18:00', '2018-07-24 02:40:15', '0000-00-00 00:00:00'),
(23, 81, 'Fundolero', 'limited_liability_corporation', '5146275240', 'https://www.fundolero.com', '8345 N.W. 66 St,, Suite: A53898', '33166', 'United States', 'Miami', 'Florida', '2018-04-04 20:12:00', '2018-07-26 16:02:27', '0000-00-00 00:00:00'),
(24, 82, 'abc', 'private_corporation', '12345678777', 'abc', 'University Road', '360005', 'India', 'Rajkot', 'Gj', '2018-07-27 20:18:00', '2018-07-27 01:41:38', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users_permissions`
--

CREATE TABLE `users_permissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `perm_id` int(11) NOT NULL,
  `value` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ;

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
) ;

--
-- Dumping data for table `users_processing`
--

INSERT INTO `users_processing` (`id`, `users_id`, `industry`, `subscriptions`, `refund_policy`, `braintree`, `annual`, `average`, `largest`, `created`, `updated`) VALUES
(13, 71, 'generic_retail', 'yes', 'refund_cardholder', 'on', 'v', 'v', 'v', '2018-06-16 01:34:44', '0000-00-00 00:00:00'),
(14, 72, 'generic_service', 'yes', 'refund_cardholder', 'on', '123', '12', 'qw', '2018-07-02 08:22:20', '0000-00-00 00:00:00'),
(15, 73, 'generic_service', 'yes', 'exchange_only', 'on', '11', '111', 'e11', '2018-07-02 08:25:21', '0000-00-00 00:00:00'),
(16, 74, 'generic_retail', 'yes', 'refund_cardholder', 'on', 'a', 'a', 'a', '2018-07-02 08:45:24', '0000-00-00 00:00:00'),
(17, 75, 'generic_service', 'no', 'refund_cardholder', 'on', '600000', '1099', '1500', '2018-07-11 20:38:57', '0000-00-00 00:00:00'),
(18, 76, 'generic_service', 'yes', 'no_refund_or_exchange', 'on', '100000', '70000', '100000', '2018-07-12 11:21:01', '0000-00-00 00:00:00'),
(19, 77, 'generic_software', 'yes', 'exchange_only', 'on', '50000', '50000', '4400', '2018-07-16 14:40:54', '0000-00-00 00:00:00'),
(22, 80, 'generic_software', 'yes', 'exchange_only', 'on', 'DASD', 'ADAS', 'DASDAS', '2018-07-24 02:40:15', '0000-00-00 00:00:00'),
(23, 81, 'generic_software', 'no', 'refund_cardholder', 'on', '10,000,000', '200', '500', '2018-07-26 16:02:27', '0000-00-00 00:00:00'),
(24, 82, 'generic_software', 'yes', 'exchange_only', 'on', '121231', 'aaa', 'aaaa', '2018-07-27 01:41:38', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users_public`
--

CREATE TABLE `users_public` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `created` timestamp NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `users_shop`
--

CREATE TABLE `users_shop` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(100) NOT NULL,
  `notify` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'notifications by email',
  `last_login` int(10) UNSIGNED DEFAULT NULL
) ;

--
-- Dumping data for table `users_shop`
--

INSERT INTO `users_shop` (`id`, `username`, `password`, `email`, `notify`, `last_login`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'your@email.com', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `value_store`
--

CREATE TABLE `value_store` (
  `id` int(10) UNSIGNED NOT NULL,
  `thekey` varchar(50) NOT NULL,
  `value` longtext NOT NULL
) ;

--
-- Dumping data for table `value_store`
--

INSERT INTO `value_store` (`id`, `thekey`, `value`) VALUES
(1, 'sitelogo', 'NewLogo.jpg'),
(2, 'navitext', ''),
(3, 'footercopyright', 'Powered by ECC FZE © All right reserved. '),
(4, 'contactspage', 'Hello dear client'),
(5, 'footerContactAddr', ''),
(6, 'footerContactEmail', 'support@shop.dev'),
(7, 'footerContactPhone', ''),
(8, 'googleMaps', '42.671840, 83.279163'),
(9, 'footerAboutUs', ''),
(10, 'footerSocialFacebook', ''),
(11, 'footerSocialTwitter', ''),
(12, 'footerSocialGooglePlus', ''),
(13, 'footerSocialPinterest', ''),
(14, 'footerSocialYoutube', ''),
(16, 'contactsEmailTo', 'contacts@shop.dev'),
(17, 'shippingOrder', '1'),
(18, 'addJs', ''),
(19, 'publicQuantity', '0'),
(20, 'paypal_email', ''),
(21, 'paypal_sandbox', '0'),
(22, 'publicDateAdded', '0'),
(23, 'googleApi', ''),
(24, 'template', 'redlabel'),
(25, 'cashondelivery_visibility', '1'),
(26, 'showBrands', '0'),
(27, 'showInSlider', '0'),
(28, 'codeDiscounts', '1'),
(29, 'virtualProducts', '0'),
(30, 'multiVendor', '0');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `url` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL,
  `created_at` timestamp NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `vendors_orders`
--

CREATE TABLE `vendors_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `products` text NOT NULL,
  `date` int(10) UNSIGNED NOT NULL,
  `referrer` varchar(255) NOT NULL,
  `clean_referrer` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `paypal_status` varchar(10) DEFAULT NULL,
  `processed` tinyint(1) NOT NULL DEFAULT '0',
  `viewed` tinyint(1) NOT NULL DEFAULT '0',
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `discount_code` varchar(20) NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `vendors_orders_clients`
--

CREATE TABLE `vendors_orders_clients` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(20) NOT NULL,
  `post_code` varchar(10) NOT NULL,
  `notes` text NOT NULL,
  `for_id` int(11) NOT NULL
) ;

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
) ;

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(500) NOT NULL,
  `date_creature` datetime NOT NULL,
  `creator` text NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(128) NOT NULL,
  `date_activation` datetime NOT NULL,
  `activator` varchar(128) NOT NULL,
  `status` enum('1','2') NOT NULL
) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_pages`
--
ALTER TABLE `active_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `blog_translations`
--
ALTER TABLE `blog_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `confirm_links`
--
ALTER TABLE `confirm_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cookie_law`
--
ALTER TABLE `cookie_law`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cookie_law_translations`
--
ALTER TABLE `cookie_law_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE` (`abbr`,`for_id`);

--
-- Indexes for table `currencys`
--
ALTER TABLE `currencys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount_codes`
--
ALTER TABLE `discount_codes`
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
-- Indexes for table `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups_permissions`
--
ALTER TABLE `groups_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roleID_2` (`group_id`,`perm_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `igo_login_attempts`
--
ALTER TABLE `igo_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `igo_menu`
--
ALTER TABLE `igo_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `igo_schema_version`
--
ALTER TABLE `igo_schema_version`
  ADD PRIMARY KEY (`type`);

--
-- Indexes for table `igo_sec_permissions`
--
ALTER TABLE `igo_sec_permissions`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `igo_sec_roles`
--
ALTER TABLE `igo_sec_roles`
  ADD PRIMARY KEY (`role`);

--
-- Indexes for table `igo_sec_role_permissions`
--
ALTER TABLE `igo_sec_role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_sec_role_permission_id` (`role`,`permission_id`);

--
-- Indexes for table `igo_sessions`
--
ALTER TABLE `igo_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `igo_settings`
--
ALTER TABLE `igo_settings`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `igo_users`
--
ALTER TABLE `igo_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `igo_user_cookies`
--
ALTER TABLE `igo_user_cookies`
  ADD KEY `token` (`token`);

--
-- Indexes for table `igo_user_meta`
--
ALTER TABLE `igo_user_meta`
  ADD PRIMARY KEY (`meta_id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_clients`
--
ALTER TABLE `orders_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permKey` (`perm_key`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_translations`
--
ALTER TABLE `products_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_pages`
--
ALTER TABLE `seo_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_pages_translations`
--
ALTER TABLE `seo_pages_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `shop_categories`
--
ALTER TABLE `shop_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_categories_translations`
--
ALTER TABLE `shop_categories_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_template`
--
ALTER TABLE `sms_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribed`
--
ALTER TABLE `subscribed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id_tarea`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indexes for table `textual_pages_tanslations`
--
ALTER TABLE `textual_pages_tanslations`
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
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_business`
--
ALTER TABLE `users_business`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `users_processing`
--
ALTER TABLE `users_processing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_public`
--
ALTER TABLE `users_public`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_shop`
--
ALTER TABLE `users_shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `value_store`
--
ALTER TABLE `value_store`
  ADD PRIMARY KEY (`id`),
  ADD KEY `key` (`thekey`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique` (`email`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `vendors_orders`
--
ALTER TABLE `vendors_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors_orders_clients`
--
ALTER TABLE `vendors_orders_clients`
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
-- AUTO_INCREMENT for table `active_pages`
--
ALTER TABLE `active_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_translations`
--
ALTER TABLE `blog_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `btc_order`
--
ALTER TABLE `btc_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `captcha`
--
ALTER TABLE `captcha`
  MODIFY `captcha_id` bigint(13) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `confirm_links`
--
ALTER TABLE `confirm_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cookie_law`
--
ALTER TABLE `cookie_law`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cookie_law_translations`
--
ALTER TABLE `cookie_law_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencys`
--
ALTER TABLE `currencys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discount_codes`
--
ALTER TABLE `discount_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disputes`
--
ALTER TABLE `disputes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disputes_comment`
--
ALTER TABLE `disputes_comment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups_permissions`
--
ALTER TABLE `groups_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `igo_login_attempts`
--
ALTER TABLE `igo_login_attempts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `igo_menu`
--
ALTER TABLE `igo_menu`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `igo_sec_permissions`
--
ALTER TABLE `igo_sec_permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `igo_sec_role_permissions`
--
ALTER TABLE `igo_sec_role_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `igo_users`
--
ALTER TABLE `igo_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `igo_user_meta`
--
ALTER TABLE `igo_user_meta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `merchants`
--
ALTER TABLE `merchants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders_clients`
--
ALTER TABLE `orders_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products_translations`
--
ALTER TABLE `products_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seo_pages`
--
ALTER TABLE `seo_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seo_pages_translations`
--
ALTER TABLE `seo_pages_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_categories`
--
ALTER TABLE `shop_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_categories_translations`
--
ALTER TABLE `shop_categories_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_template`
--
ALTER TABLE `sms_template`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribed`
--
ALTER TABLE `subscribed`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id_tarea` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `textual_pages_tanslations`
--
ALTER TABLE `textual_pages_tanslations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets_comment`
--
ALTER TABLE `tickets_comment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_business`
--
ALTER TABLE `users_business`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_processing`
--
ALTER TABLE `users_processing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_public`
--
ALTER TABLE `users_public`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_shop`
--
ALTER TABLE `users_shop`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `value_store`
--
ALTER TABLE `value_store`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors_orders`
--
ALTER TABLE `vendors_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors_orders_clients`
--
ALTER TABLE `vendors_orders_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verification`
--
ALTER TABLE `verification`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

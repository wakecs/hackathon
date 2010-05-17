-- phpMyAdmin SQL Dump
-- version 3.3.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 17, 2010 at 03:34 PM
-- Server version: 5.1.37
-- PHP Version: 5.2.10-2ubuntu6.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hackathon`
--
DROP DATABASE `hackathon`;
CREATE DATABASE `hackathon` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `hackathon`;

-- --------------------------------------------------------

--
-- Stand-in structure for view `HackCounts`
--
DROP VIEW IF EXISTS `HackCounts`;
CREATE TABLE IF NOT EXISTS `HackCounts` (
`id` int(11)
,`hacks` bigint(21)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `HackedCounts`
--
DROP VIEW IF EXISTS `HackedCounts`;
CREATE TABLE IF NOT EXISTS `HackedCounts` (
`id` int(11)
,`hacked` bigint(21)
);
-- --------------------------------------------------------

--
-- Table structure for table `Hacks`
--

DROP TABLE IF EXISTS `Hacks`;
CREATE TABLE IF NOT EXISTS `Hacks` (
  `id` int(11) NOT NULL,
  `hacked_id` int(11) NOT NULL,
  `hack` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Hacks`
--

INSERT INTO `Hacks` (`id`, `hacked_id`, `hack`, `description`, `time`) VALUES
(1, 2, 'test', 'test', '2010-05-11 00:47:45'),
(2, 1, 'test', 'test', '2010-05-11 00:47:37'),
(1, 6, 'test', 'test', '2010-05-11 00:47:27'),
(1, 6, 'test', 'test', '2010-05-11 00:46:24'),
(1, 2, 'python', 'python', '2010-05-16 00:41:46'),
(1, 2, 'python', 'python', '2010-05-16 00:41:41'),
(1, 2, 'python', 'python', '2010-05-16 00:41:34'),
(1, 2, 'python', 'python', '2010-05-16 00:41:28'),
(1, 2, 'python', 'python', '2010-05-12 03:31:20'),
(1, 2, 'python', 'python', '2010-05-12 03:31:15'),
(1, 2, 'python', 'python', '2010-05-12 03:30:55'),
(5, 2, 'python', 'hmmmm', '2010-05-12 03:18:26'),
(1, 2, 'python', 'python', '2010-05-16 00:41:08'),
(1, 2, 'python', 'python', '2010-05-16 00:41:14'),
(1, 2, 'python', 'p0wnage via python!, woot!', '2010-05-12 03:00:45'),
(1, 2, 'python', 'python', '2010-05-12 03:00:09'),
(1, 2, 'python', 'python', '2010-05-16 00:42:00'),
(1, 2, 'python', 'python', '2010-05-16 00:42:07'),
(1, 2, 'python', 'python', '2010-05-16 00:44:11'),
(2, 5, 'python', 'python', '2010-05-16 00:57:17'),
(6, 2, 'python', 'python', '2010-05-16 01:00:31'),
(6, 2, 'python', 'python', '2010-05-16 01:00:41'),
(6, 2, 'python', 'python', '2010-05-16 01:00:53'),
(1, 2, 'python', 'python', '2010-05-16 02:25:31'),
(1, 2, 'python', 'python', '2010-05-16 02:26:39'),
(5, 2, 'python', 'python', '2010-05-16 02:28:52'),
(5, 2, 'python', 'python', '2010-05-16 02:50:15'),
(2, 6, 'python', 'python', '2010-05-16 02:51:35'),
(2, 6, 'python', 'python', '2010-05-16 02:52:00'),
(1, 2, 'python', 'python', '2010-05-17 14:52:49'),
(6, 2, 'python', 'python', '2010-05-16 03:18:08');

-- --------------------------------------------------------

--
-- Stand-in structure for view `LastHack`
--
DROP VIEW IF EXISTS `LastHack`;
CREATE TABLE IF NOT EXISTS `LastHack` (
`id` int(11)
,`time` timestamp
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `LastHacked`
--
DROP VIEW IF EXISTS `LastHacked`;
CREATE TABLE IF NOT EXISTS `LastHacked` (
`id` int(11)
,`time` timestamp
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `UserScores`
--
DROP VIEW IF EXISTS `UserScores`;
CREATE TABLE IF NOT EXISTS `UserScores` (
`id` int(11)
,`name` varchar(255)
,`ipaddress` varchar(17)
,`hacks` bigint(21)
,`hacked` bigint(21)
,`score` bigint(21)
,`last_hack` timestamp
,`last_hacked` timestamp
);
-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ipaddress` varchar(17) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `passphrase` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `name`, `ipaddress`, `passphrase`) VALUES
(1, 'John Doe', '192.168.1.2', 'A dingo ate my baby.'),
(2, 'Jane Doe', '127.0.0.1', 'I ate the dingo''s baby.'),
(6, 'Nicolas Mertaugh', '192.168.1.4', '1 in 4 people have herpes.'),
(5, 'Steve Irwin', '192.168.1.3', 'Crikes!');

-- --------------------------------------------------------

--
-- Structure for view `HackCounts`
--
DROP TABLE IF EXISTS `HackCounts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `HackCounts` AS select `Users`.`id` AS `id`,count(`Hacks`.`id`) AS `hacks` from (`Users` left join `Hacks` on((`Users`.`id` = `Hacks`.`id`))) group by `Users`.`id`,`Hacks`.`id`;

-- --------------------------------------------------------

--
-- Structure for view `HackedCounts`
--
DROP TABLE IF EXISTS `HackedCounts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `HackedCounts` AS select `Users`.`id` AS `id`,count(`Hacks`.`hacked_id`) AS `hacked` from (`Users` left join `Hacks` on((`Users`.`id` = `Hacks`.`hacked_id`))) group by `Users`.`id`,`Hacks`.`hacked_id`;

-- --------------------------------------------------------

--
-- Structure for view `LastHack`
--
DROP TABLE IF EXISTS `LastHack`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `LastHack` AS select `Users`.`id` AS `id`,max(`Hacks`.`time`) AS `time` from (`Users` left join `Hacks` on((`Users`.`id` = `Hacks`.`id`))) group by `Users`.`id`,`Hacks`.`id`;

-- --------------------------------------------------------

--
-- Structure for view `LastHacked`
--
DROP TABLE IF EXISTS `LastHacked`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `LastHacked` AS select `Users`.`id` AS `id`,max(`Hacks`.`time`) AS `time` from (`Users` left join `Hacks` on((`Users`.`id` = `Hacks`.`hacked_id`))) group by `Users`.`id`,`Hacks`.`hacked_id`;

-- --------------------------------------------------------

--
-- Structure for view `UserScores`
--
DROP TABLE IF EXISTS `UserScores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `UserScores` AS select `Users`.`id` AS `id`,`Users`.`name` AS `name`,`Users`.`ipaddress` AS `ipaddress`,`HackCounts`.`hacks` AS `hacks`,`HackedCounts`.`hacked` AS `hacked`,(`HackCounts`.`hacks` - `HackedCounts`.`hacked`) AS `score`,`LastHack`.`time` AS `last_hack`,`LastHacked`.`time` AS `last_hacked` from ((((`Users` left join `HackCounts` on((`Users`.`id` = `HackCounts`.`id`))) left join `HackedCounts` on((`Users`.`id` = `HackedCounts`.`id`))) left join `LastHack` on((`Users`.`id` = `LastHack`.`id`))) left join `LastHacked` on((`Users`.`id` = `LastHacked`.`id`)));

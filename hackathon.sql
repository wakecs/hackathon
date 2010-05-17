-- phpMyAdmin SQL Dump
-- version 3.3.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 17, 2010 at 04:59 PM
-- Server version: 5.1.37
-- PHP Version: 5.2.10-2ubuntu6.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hackathon`
--

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
COMMIT;

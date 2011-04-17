-- MySQL dump 10.13  Distrib 5.5.10, for osx10.6 (i386)
--
-- Host: localhost    Database: hackathon
-- ------------------------------------------------------
-- Server version	5.5.10

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Hacks`
--

DROP TABLE IF EXISTS `Hacks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Hacks` (
  `id` int(11) NOT NULL,
  `hacked_id` int(11) NOT NULL,
  `hack` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ipaddress` varchar(17) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `passphrase` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `fakehack`
--

DROP TABLE IF EXISTS `fakehack`;
/*!50001 DROP VIEW IF EXISTS `fakehack`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `fakehack` (
  `id` int(11),
  `name` varchar(255),
  `ipaddress` varchar(17),
  `count` bigint(21)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `fakehackcounts`
--

DROP TABLE IF EXISTS `fakehackcounts`;
/*!50001 DROP VIEW IF EXISTS `fakehackcounts`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `fakehackcounts` (
  `id` int(11),
  `count` bigint(21)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `hackcounts`
--

DROP TABLE IF EXISTS `hackcounts`;
/*!50001 DROP VIEW IF EXISTS `hackcounts`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `hackcounts` (
  `id` int(11),
  `hacks` bigint(21)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `hackedcounts`
--

DROP TABLE IF EXISTS `hackedcounts`;
/*!50001 DROP VIEW IF EXISTS `hackedcounts`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `hackedcounts` (
  `id` int(11),
  `hacked` bigint(21)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `lasthack`
--

DROP TABLE IF EXISTS `lasthack`;
/*!50001 DROP VIEW IF EXISTS `lasthack`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `lasthack` (
  `id` int(11),
  `time` timestamp
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `lasthacked`
--

DROP TABLE IF EXISTS `lasthacked`;
/*!50001 DROP VIEW IF EXISTS `lasthacked`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `lasthacked` (
  `id` int(11),
  `time` timestamp
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `scorereport`
--

DROP TABLE IF EXISTS `scorereport`;
/*!50001 DROP VIEW IF EXISTS `scorereport`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `scorereport` (
  `hacker` varchar(255),
  `hacker_ip` varchar(17),
  `hacked` varchar(255),
  `hacked_ip` varchar(17),
  `hack` varchar(255),
  `description` text,
  `time` timestamp
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `userscores`
--

DROP TABLE IF EXISTS `userscores`;
/*!50001 DROP VIEW IF EXISTS `userscores`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `userscores` (
  `id` int(11),
  `name` varchar(255),
  `ipaddress` varchar(17),
  `hacks` bigint(21),
  `hacked` bigint(21),
  `score` bigint(22),
  `last_hack` timestamp,
  `last_hacked` timestamp
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `fakehack`
--

/*!50001 DROP TABLE IF EXISTS `fakehack`*/;
/*!50001 DROP VIEW IF EXISTS `fakehack`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `fakehack` AS select `users`.`id` AS `id`,`users`.`name` AS `name`,`users`.`ipaddress` AS `ipaddress`,ifnull(`fakehackcounts`.`count`,0) AS `count` from (`users` left join `fakehackcounts` on((`users`.`id` = `fakehackcounts`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `fakehackcounts`
--

/*!50001 DROP TABLE IF EXISTS `fakehackcounts`*/;
/*!50001 DROP VIEW IF EXISTS `fakehackcounts`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `fakehackcounts` AS select `users`.`id` AS `id`,count(`hacks`.`id`) AS `count` from (`users` left join `hacks` on((`users`.`id` = `hacks`.`hacked_id`))) where (`hacks`.`id` = -(1)) group by `users`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `hackcounts`
--

/*!50001 DROP TABLE IF EXISTS `hackcounts`*/;
/*!50001 DROP VIEW IF EXISTS `hackcounts`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `hackcounts` AS select `users`.`id` AS `id`,count(`hacks`.`id`) AS `hacks` from (`users` left join `hacks` on((`users`.`id` = `hacks`.`id`))) group by `users`.`id`,`hacks`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `hackedcounts`
--

/*!50001 DROP TABLE IF EXISTS `hackedcounts`*/;
/*!50001 DROP VIEW IF EXISTS `hackedcounts`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `hackedcounts` AS select `users`.`id` AS `id`,count(`hacks`.`hacked_id`) AS `hacked` from (`users` left join `hacks` on((`users`.`id` = `hacks`.`hacked_id`))) group by `users`.`id`,`hacks`.`hacked_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `lasthack`
--

/*!50001 DROP TABLE IF EXISTS `lasthack`*/;
/*!50001 DROP VIEW IF EXISTS `lasthack`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `lasthack` AS select `users`.`id` AS `id`,max(`hacks`.`time`) AS `time` from (`users` left join `hacks` on((`users`.`id` = `hacks`.`id`))) group by `users`.`id`,`hacks`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `lasthacked`
--

/*!50001 DROP TABLE IF EXISTS `lasthacked`*/;
/*!50001 DROP VIEW IF EXISTS `lasthacked`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `lasthacked` AS select `users`.`id` AS `id`,max(`hacks`.`time`) AS `time` from (`users` left join `hacks` on((`users`.`id` = `hacks`.`hacked_id`))) group by `users`.`id`,`hacks`.`hacked_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `scorereport`
--

/*!50001 DROP TABLE IF EXISTS `scorereport`*/;
/*!50001 DROP VIEW IF EXISTS `scorereport`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `scorereport` AS select `B`.`name` AS `hacker`,`B`.`ipaddress` AS `hacker_ip`,`C`.`name` AS `hacked`,`C`.`ipaddress` AS `hacked_ip`,`A`.`hack` AS `hack`,`A`.`description` AS `description`,`A`.`time` AS `time` from ((`hacks` `A` left join `users` `B` on((`B`.`id` = `A`.`id`))) left join `users` `C` on((`C`.`id` = `A`.`hacked_id`))) where (`A`.`id` in (select `users`.`id` AS `id` from `users`) and `A`.`hacked_id` in (select `users`.`id` AS `id` from `users`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `userscores`
--

/*!50001 DROP TABLE IF EXISTS `userscores`*/;
/*!50001 DROP VIEW IF EXISTS `userscores`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `userscores` AS select `users`.`id` AS `id`,`users`.`name` AS `name`,`users`.`ipaddress` AS `ipaddress`,`hackcounts`.`hacks` AS `hacks`,`hackedcounts`.`hacked` AS `hacked`,(`hackcounts`.`hacks` - `hackedcounts`.`hacked`) AS `score`,`lasthack`.`time` AS `last_hack`,`lasthacked`.`time` AS `last_hacked` from ((((`users` left join `hackcounts` on((`users`.`id` = `hackcounts`.`id`))) left join `hackedcounts` on((`users`.`id` = `hackedcounts`.`id`))) left join `lasthack` on((`users`.`id` = `lasthack`.`id`))) left join `lasthacked` on((`users`.`id` = `lasthacked`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-04-16 23:32:32

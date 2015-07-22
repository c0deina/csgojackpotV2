-- MySQL dump 10.13  Distrib 5.5.34, for Linux (x86_64)
--
-- Host: localhost    Database: vh81062_firecsgo
-- ------------------------------------------------------
-- Server version	5.5.34-32.0-log

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
-- Table structure for table `game1`
--

DROP TABLE IF EXISTS `game1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(70) NOT NULL,
  `username` varchar(70) NOT NULL,
  `item` text,
  `color` text,
  `value` text,
  `avatar` varchar(512) NOT NULL,
  `image` text NOT NULL,
  `from` text NOT NULL,
  `to` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game1`
--

LOCK TABLES `game1` WRITE;
/*!40000 ALTER TABLE `game1` DISABLE KEYS */;
/*!40000 ALTER TABLE `game1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games` (
  `id` int(11) NOT NULL DEFAULT '0',
  `starttime` int(11) NOT NULL,
  `cost` text,
  `winner` varchar(128) NOT NULL,
  `userid` varchar(70) NOT NULL,
  `percent` varchar(10) DEFAULT NULL,
  `itemsnum` int(11) NOT NULL,
  `module` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` VALUES (1,2147483647,'0','','',NULL,0,'');
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info`
--

DROP TABLE IF EXISTS `info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info` (
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info`
--

LOCK TABLES `info` WRITE;
/*!40000 ALTER TABLE `info` DISABLE KEYS */;
INSERT INTO `info` VALUES ('current_game','1'),('state','waiting'),('rake','10'),('minbet','0.3'),('maxitems','10');
/*!40000 ALTER TABLE `info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `cost` text NOT NULL,
  `lastupdate` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (13,'Five-SeveN%20|%20Orange%20Peel%20(Field-Tested)','0.06','1433104160'),(5,'P250%20|%20Steel%20Disruption%20(Factory%20New)','0.24','1431774638'),(4,'UMP-45%20|%20Urban%20DDPAT%20(Field-Tested)','0.04','1431774638'),(7,'Nova%20|%20Ghost%20Camo%20(Factory%20New)','0.28','1431781594'),(28,'Operation%20Vanguard%20Weapon%20Case','0.05','1433503277'),(9,'Nova%20|%20Polar%20Mesh%20(Field-Tested)','0.03','1431781595'),(10,'MP7%20|%20Forest%20DDPAT%20(Field-Tested)','0.04','1431781595'),(11,'SSG%2008%20|%20Blue%20Spruce%20(Field-Tested)','0.04','1433104159'),(12,'M4A1-S%20|%20Boreal%20Forest%20(Battle-Scarred)','0.18','1433104160'),(14,'UMP-45%20|%20Urban%20DDPAT%20(Well-Worn)','0.04','1433104968'),(15,'Chroma%20Case','0.05','1433105881'),(16,'Operation%20Breakout%20Weapon%20Case','0.04','1433105910'),(17,'Operation%20Phoenix%20Weapon%20Case','0.06','1433105910'),(18,'MP9%20|%20Deadly%20Poison%20(Field-Tested)','0.08','1433153102'),(19,'SCAR-20%20|%20Grotto%20(Field-Tested)','0.09','1433153264'),(20,'MAG-7%20|%20Heaven%20Guard%20(Factory%20New)','0.1','1433153265'),(21,'Galil%20AR%20|%20Sandstorm%20(Field-Tested)','0.12','1433153265'),(22,'Glock-18%20|%20Catacombs%20(Minimal%20Wear)','0.09','1433155232'),(23,'Dual%20Berettas%20|%20Contractor%20(Field-Tested)','0.04','1433453290'),(24,'M249%20|%20Contrast%20Spray%20(Field-Tested)','0.04','1433503274'),(25,'Dual%20Berettas%20|%20Contractor%20(Minimal%20Wear)','0.04','1433503275'),(26,'SG%20553%20|%20Waves%20Perforated%20(Well-Worn)','0.03','1433503276'),(27,'P250%20|%20Sand%20Dune%20(Minimal%20Wear)','0.04','1433503276'),(29,'FAMAS%20|%20Colony%20(Field-Tested)','0.03','1433503277'),(30,'Sawed-Off%20|%20Origami%20(Minimal%20Wear)','0.14','1433503278'),(31,'P90%20|%20Module%20(Minimal%20Wear)','0.13','1433503279'),(32,'AK-47%20|%20Elite%20Build%20(Battle-Scarred)','0.43','1433506775'),(33,'CZ75-Auto%20|%20Pole%20Position%20(Battle-Scarred)','0.38','1433506775'),(34,'P250%20|%20Valence%20(Minimal%20Wear)','0.29','1433506776'),(35,'SG%20553%20|%20Army%20Sheen%20(Factory%20New)','0.05','1433508379'),(36,'MP9%20|%20Storm%20(Battle-Scarred)','0.04','1433508379'),(37,'MP9%20|%20Storm%20(Field-Tested)','0.04','1433508380'),(38,'SG%20553%20|%20Waves%20Perforated%20(Battle-Scarred)','0.04','1433508380'),(39,'M4A4%20|%20龍王%20(Dragon%20King)%20(Field-Tested)','1.95','1433520065');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(70) NOT NULL,
  `msg` text NOT NULL,
  `from` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `queue`
--

DROP TABLE IF EXISTS `queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(70) NOT NULL,
  `token` varchar(128) NOT NULL,
  `items` text NOT NULL,
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `queue`
--

LOCK TABLES `queue` WRITE;
/*!40000 ALTER TABLE `queue` DISABLE KEYS */;
/*!40000 ALTER TABLE `queue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rakeitems`
--

DROP TABLE IF EXISTS `rakeitems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rakeitems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rakeitems`
--

LOCK TABLES `rakeitems` WRITE;
/*!40000 ALTER TABLE `rakeitems` DISABLE KEYS */;
/*!40000 ALTER TABLE `rakeitems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `steamid` varchar(70) NOT NULL,
  `tlink` varchar(255) DEFAULT NULL,
  `won` float DEFAULT '0',
  `admin` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `games` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'76561198159854902',NULL,0,0,'SENDER','https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/e4/e4108f615aef360b60c52b79e9aae106063c183f_full.jpg',0),(2,'76561198164439617','https://steamcommunity.com/tradeoffer/new/?partner=204173889&token=hUQ_7LNM',0,0,'chiken','https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/e0/e04b541a9dc052e2441ecd4d49e2be8fa9b3f85e_full.jpg',0),(3,'76561198124834167','https://steamcommunity.com/tradeoffer/new/?partner=164568439&token=Ul96ATab',0,0,'FresTO','https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/16/16ecc6292a0026b95c91524c6c1f16e39835987f_full.jpg',0),(4,'76561198093298452',NULL,0,0,'Twinky','https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/3b/3bedeaecdf0382eba591cced23aabfb9645f9907_full.jpg',0),(5,'76561198146178289',NULL,0,0,'ADMIN','https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/f3/f3f5eee4efe059d164cf0e631eb2ce1ff25edbbd_full.jpg',0),(6,'76561198127637451','https://steamcommunity.com/tradeoffer/new/?partner=167371723&token=Pmrfl2E7',0,0,'KiwiJamba','https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/29/29ecad1feb84ae20bc27495da712b4da50d8ca6b_full.jpg',0),(7,'76561198165276772',NULL,0,0,'HunTeR SKINS-CASINO.COM','https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/c6/c6741d7cf5a6a33ca2221ee933f33e665ffbbb9f_full.jpg',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-07-01 22:08:07

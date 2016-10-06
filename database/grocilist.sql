-- MySQL dump 10.13  Distrib 5.6.24, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: grocilist
-- ------------------------------------------------------
-- Server version	5.6.25

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
-- Table structure for table `trn_invitations`
--

DROP TABLE IF EXISTS `trn_invitations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_invitations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL COMMENT '1 New\n2 Send\n3 Active\n4 Expire',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_invitations`
--

LOCK TABLES `trn_invitations` WRITE;
/*!40000 ALTER TABLE `trn_invitations` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_invitations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_invite_friends`
--

DROP TABLE IF EXISTS `trn_invite_friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_invite_friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `invitation_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_invite_friends`
--

LOCK TABLES `trn_invite_friends` WRITE;
/*!40000 ALTER TABLE `trn_invite_friends` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_invite_friends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_items`
--

DROP TABLE IF EXISTS `trn_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `unit_value` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `quantity_in_hand` int(11) DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_items`
--

LOCK TABLES `trn_items` WRITE;
/*!40000 ALTER TABLE `trn_items` DISABLE KEYS */;
INSERT INTO `trn_items` VALUES (1,'Mango','Kartha kolomban',NULL,'10 items',350,NULL,1),(2,'Pineapple','Hoda eka rasa eka',NULL,'1 item',120,NULL,1),(3,'Coca cola','Original one',NULL,'400ml ',140,NULL,1);
/*!40000 ALTER TABLE `trn_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_order`
--

DROP TABLE IF EXISTS `trn_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `time_slot` varchar(255) DEFAULT NULL,
  `instructions` varchar(255) DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_order`
--

LOCK TABLES `trn_order` WRITE;
/*!40000 ALTER TABLE `trn_order` DISABLE KEYS */;
INSERT INTO `trn_order` VALUES (1,1,630,NULL,NULL,NULL,NULL,NULL,0);
/*!40000 ALTER TABLE `trn_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_order_details`
--

DROP TABLE IF EXISTS `trn_order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_price` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_order_details`
--

LOCK TABLES `trn_order_details` WRITE;
/*!40000 ALTER TABLE `trn_order_details` DISABLE KEYS */;
INSERT INTO `trn_order_details` VALUES (1,1,1,1,350),(2,1,3,2,140);
/*!40000 ALTER TABLE `trn_order_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_request_products`
--

DROP TABLE IF EXISTS `trn_request_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_request_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `contact_no` varchar(255) DEFAULT NULL,
  `details` varchar(1000) DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `invite_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_request_products`
--

LOCK TABLES `trn_request_products` WRITE;
/*!40000 ALTER TABLE `trn_request_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `trn_request_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_user`
--

DROP TABLE IF EXISTS `trn_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `invitation_id` int(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_user`
--

LOCK TABLES `trn_user` WRITE;
/*!40000 ALTER TABLE `trn_user` DISABLE KEYS */;
INSERT INTO `trn_user` VALUES (1,'Chathura','cccc@gmail.com','1234567890',1,'123456',1);
/*!40000 ALTER TABLE `trn_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-07  0:18:01

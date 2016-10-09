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
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_invitations`
--

LOCK TABLES `trn_invitations` WRITE;
/*!40000 ALTER TABLE `trn_invitations` DISABLE KEYS */;
INSERT INTO `trn_invitations` VALUES (1,'uKdm1xxGE29r',NULL,NULL,1),(2,'B40eB1z9RHPO',NULL,NULL,1),(3,'6tfhyaMaV8Uy',NULL,NULL,1),(4,'qdB2MKjIdB1b',NULL,NULL,1),(5,'s5dwH4PlGSlK',NULL,NULL,1),(6,'CnKidSt6HgwL',NULL,NULL,1),(7,'NQlmIuVvbwIh',NULL,NULL,1),(8,'qNHg8FkAyXzO',NULL,NULL,1),(9,'n0V2RGkRGkgo',NULL,NULL,1),(10,'6LHcNl6o0Uqy',NULL,NULL,1),(11,'sPaNmUhHqwfl',NULL,NULL,1),(12,'Tu0lsa3Nlplh',NULL,NULL,1),(13,'hxmTtp3eFmTn',NULL,NULL,1),(14,'3fSXlor1NFyc',NULL,NULL,1),(15,'5oIztqRID6uL',NULL,NULL,1),(16,'PgxgKgvlBWkA',NULL,NULL,1),(17,'9Ev5zdZqBZfI',NULL,NULL,1),(18,'tOgyS2u02vUG',NULL,NULL,1),(19,'HyYG21FBOhrw',NULL,NULL,1),(20,'e8i2ZXFflAxK',NULL,NULL,1),(21,'YmnC879twdko',NULL,NULL,1),(22,'muSZmhgkLrt1',NULL,NULL,1),(23,'gjX95JGjX28C',NULL,NULL,1),(24,'66gEdfyuxjXK',NULL,NULL,1),(25,'MEXva7wnp17q',NULL,NULL,1),(26,'IfHgP6LZWsfb',NULL,NULL,1),(27,'NEEXBwVS5px4',NULL,NULL,1),(28,'ras6p794d8BA',NULL,NULL,1),(29,'yygJFc76frDN',NULL,NULL,1),(30,'x6LofxY0BAgc',NULL,NULL,1),(31,'jB46ApnhamER',NULL,NULL,1),(32,'fjRoABt0m3th',NULL,NULL,1),(33,'i2ijDoWG4rRv',NULL,NULL,1),(34,'Q31mEyUlINt4',NULL,NULL,1),(35,'M8cB2o3xdUuZ',NULL,NULL,1),(36,'xyuxIFwhX4yO',NULL,NULL,1),(37,'072d4FY6R2Ny',NULL,NULL,1),(38,'B5va1ay2j6VL',NULL,NULL,1),(39,'eg3qXsWDf33s',NULL,NULL,1),(40,'hUkwOkhT2bQb',NULL,NULL,1),(41,'GNvtY2dnCetX',NULL,NULL,1),(42,'PedPlnV5nvzj',NULL,NULL,1),(43,'DZDClD3zeNkh',NULL,NULL,1),(44,'vkplSALRAnmp',NULL,NULL,1),(45,'k4G5lvHtl1RH',NULL,NULL,1),(46,'xs8kEb1tU0sH',NULL,NULL,1),(47,'1iV8cTolb8js',NULL,NULL,1),(48,'bRG1UqXaBF6t',NULL,NULL,1),(49,'WVA1b3nr2oXM',NULL,NULL,1),(50,'HMhGVzPcUByW',NULL,NULL,1),(51,'ndV0xfWY732X',NULL,NULL,1),(52,'lubxVSSO533n',NULL,NULL,1),(53,'xocjvIieHnMd',NULL,NULL,1),(54,'lcERazlgnhR1',NULL,NULL,1),(55,'GIFdkHHr1AsO',NULL,NULL,1),(56,'YcUTTUvO2xe7',NULL,NULL,1),(57,'5rxWhsqSkWkZ',NULL,NULL,1),(58,'sIeTn9BGj3oW',NULL,NULL,1),(59,'YO6LAfGLSHC0',NULL,NULL,1),(60,'30Q6QxR8s7CI',NULL,NULL,1),(61,'B5BVwiLmV6A6',NULL,NULL,1),(62,'1k1LykyrIW9H',NULL,NULL,1),(63,'evhFkSTUIouy',NULL,NULL,1),(64,'CU09KLWPlMe9',NULL,NULL,1),(65,'6knffekGuQzz',NULL,NULL,1),(66,'412uH5fxAT7j',NULL,NULL,1),(67,'sNaUwCkVwH4q',NULL,NULL,1),(68,'EUn2DzJQHx4r',NULL,NULL,1),(69,'y9SUqg7R2cgn',NULL,NULL,1),(70,'AOh3OsDZVXjL',NULL,NULL,1),(71,'EFLucrXLiBnE',NULL,NULL,1),(72,'90YMuZedwo7z',NULL,NULL,1),(73,'ZA5V5n7Sx8Gw',NULL,NULL,1),(74,'zHJsTpLMK7I4',NULL,NULL,1),(75,'O95qlmPs25pe',NULL,NULL,1),(76,'7bNmjZtVPlnx',NULL,NULL,1),(77,'nB1gdBlJ1GO1',NULL,NULL,1),(78,'1GpIXXBU1mld',NULL,NULL,1),(79,'Wd8HWmUYKa98',NULL,NULL,1),(80,'ysPM5ApYAoSl',NULL,NULL,1),(81,'KdFYNUMrsOFR',NULL,NULL,1),(82,'WLiOY69oLHcc',NULL,NULL,1),(83,'2STj1tcmqQCo',NULL,NULL,1),(84,'sP52QM5nOwz0',NULL,NULL,1),(85,'5q20RjrZSxe2',NULL,NULL,1),(86,'kVpKXQqdZ8g1',NULL,NULL,1),(87,'77mhzFIz47N0',NULL,NULL,1),(88,'Piy9zzs7wLvv',NULL,NULL,1),(89,'oe8ooOjnfQxy',NULL,NULL,1),(90,'cbKwVbqnFFxH',NULL,NULL,1),(91,'9YzAAXsDGYHW',NULL,NULL,1),(92,'FRf6gWzdG5EQ',NULL,NULL,1),(93,'ECW7oopCBLxq','chathura1@gmail.com','Chathura Fernando',3),(94,'wyi9R68SPh3d','chathura2@gmail.com','Chathura Sachithra',3),(95,'9pue4lpxgrje',NULL,NULL,1),(96,'Zv9UVUoDkv02',NULL,NULL,1),(97,'TBsbR5JGVggD',NULL,NULL,1),(98,'jZ4CKCzJsZLz',NULL,NULL,1),(99,'8s7e1PAiOuES',NULL,NULL,1),(100,'LghxyuWpr1A4',NULL,NULL,1);
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
  `user_id` int(11) DEFAULT NULL,
  `user_type` int(11) DEFAULT NULL,
  `type` tinyint(3) DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_invite_friends`
--

LOCK TABLES `trn_invite_friends` WRITE;
/*!40000 ALTER TABLE `trn_invite_friends` DISABLE KEYS */;
INSERT INTO `trn_invite_friends` VALUES (1,'11111@gmail.com','h ffhdd',93,1,NULL,1),(2,'11111@gmail.com','h ffhdd',93,1,1,1),(3,'11111@gmail.com','h ffhdd',93,1,1,1),(4,'11111@gmail.com','h ffhdd',93,1,2,1),(5,'11111@gmail.com','Test 01',93,1,2,1),(6,'22222@gmail.com','Test 02',93,1,2,1);
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
  `user_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_request_products`
--

LOCK TABLES `trn_request_products` WRITE;
/*!40000 ALTER TABLE `trn_request_products` DISABLE KEYS */;
INSERT INTO `trn_request_products` VALUES (1,'h ffhdd','256483588658','25364 464745',1,93,1),(2,'h ffhdd','256483588658','25364 464745',1,93,1),(3,'ryryyr','256483588658','25364 464745',1,93,1),(4,'h ffhdd','256483588658','25364 464745',1,93,1),(5,'h ffhdd','256483588658','25364 464745',1,93,1),(6,'h ffhdd','256483588658','25364 464745',1,93,1),(7,'h ffhdd','256483588658','25364 464745',1,93,1),(8,'h ffhdd','256483588658','25364 464745',1,93,1),(9,'h ffhdd','256483588658','25364 464745',1,93,1),(10,'h ffhdd','256483588658','25364 464745',1,93,1),(11,'h ffhdd','256483588658','25364 464745',1,93,1);
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
INSERT INTO `trn_user` VALUES (1,'Chathura','cccc@gmail.com','1234567890',1,'565b0f81b3e2dbbe675910920273f5607d50686b',1);
/*!40000 ALTER TABLE `trn_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trn_user_tokens`
--

DROP TABLE IF EXISTS `trn_user_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trn_user_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) DEFAULT NULL,
  `user_type` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_token_index` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trn_user_tokens`
--

LOCK TABLES `trn_user_tokens` WRITE;
/*!40000 ALTER TABLE `trn_user_tokens` DISABLE KEYS */;
INSERT INTO `trn_user_tokens` VALUES (1,'3041e441e3655c2720ba42bea2aac78600c9805e',1,93,NULL,'1'),(2,'ae88ad6839552ef33fac218cb79802b82bf0bbd8',1,93,NULL,'1'),(3,'6e94311ff88d75692c06df6561d87b6f55083b63',1,94,NULL,'1'),(4,'1b37a0e3c58092a46077d112fda02d8ae88b9f0b',1,93,1,'1'),(5,'2d344220bff0fd5225469bd3751be463f5c14803',3,0,NULL,'1'),(6,'03ce2457e6325e6a8edd4561e9fca1dfd5a11443',3,0,NULL,'1'),(7,'62ec210410fde674b2e285f6a4780202c95d7715',3,0,NULL,'1'),(8,'652dc6fde00114d1b7c09d939d03bac700544358',2,1,NULL,'1'),(9,'9b6ab081690cc7ac6d8db386aeefbbe4be34c4e5',2,1,NULL,'1'),(10,'c815ae61d7172e561a6736a999636552f9ed1a0c',2,1,NULL,'1'),(11,'c43c089a06c640349f77e98fc53a614b43e6f1bb',2,1,NULL,'1'),(12,'14fd171de4f77dc76f76b316b45e3c9da029342e',2,1,NULL,'1'),(13,'66f69ddb39b6bac55402fc914a61b606af7ff8b2',3,0,NULL,'1'),(14,'400801c5a393d917895c62772577bd164500bec4',2,1,NULL,'1'),(15,'090efb686a5911eefea72a1d2e32a3e02750d03f',3,0,NULL,'1'),(16,'35b60c9b78ce405b101c8fa364123a42d897274c',1,93,NULL,'1'),(17,'fb4421db7f7efc8a601a13fd8f6540a81b38acc6',3,0,NULL,'1'),(18,'8b53f1e3a7382a67c6372175bb988c18011278d1',1,93,NULL,'1');
/*!40000 ALTER TABLE `trn_user_tokens` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-09 14:13:11

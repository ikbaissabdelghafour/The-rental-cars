-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: location_des_voitures
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservations` (
  `Réservations_id` int NOT NULL AUTO_INCREMENT,
  `client_cin` varchar(55) NOT NULL,
  `voiture_vin` varchar(55) NOT NULL,
  `date_de_location` date DEFAULT NULL,
  `date_de_retour` date DEFAULT NULL,
  `montant_total` float NOT NULL,
  `nbr_joures` int DEFAULT NULL,
  `date_de_reservation` datetime DEFAULT NULL,
  `option1` varchar(55) DEFAULT NULL,
  `option2` varchar(55) DEFAULT NULL,
  `option3` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`client_cin`,`voiture_vin`,`Réservations_id`),
  UNIQUE KEY `Réservations_id` (`Réservations_id`),
  KEY `voiture_vin` (`voiture_vin`),
  CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`client_cin`) REFERENCES `clients` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`voiture_vin`) REFERENCES `voitures` (`matricule`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (73,'abdelghafour','M1004lll','2024-06-08','2024-06-15',1949.8,7,'2024-06-08 09:26:05','79.9','0','199.9'),(74,'abdelghafour','M1004lll','2024-06-08','2024-06-15',1929.8,7,'2024-06-08 09:39:52','79.9','99.9','0'),(65,'abdelghafour','M1006','2024-06-07','2024-06-14',1579.8,7,'2024-06-07 21:45:17','79.9','99.9','0'),(66,'abdelghafour','M1006','2024-06-07','2024-06-14',1579.8,7,'2024-06-07 21:46:12','79.9','99.9','0'),(67,'abdelghafour','m1255','2024-06-07','2024-06-19',3819.8,12,'2024-06-07 22:12:24','0','99.9','199.9'),(68,'abdelghafour','m1255','2024-06-07','2024-06-19',3819.8,12,'2024-06-07 22:13:13','0','99.9','199.9'),(69,'abdelghafour','m1255','2024-06-07','2024-06-19',3819.8,12,'2024-06-07 22:13:22','0','99.9','199.9'),(70,'hamza','M1006','2024-06-08','2024-06-19',2419.8,11,'2024-06-08 03:34:44','0','99.9','199.9'),(71,'hamza','m1263','2024-06-20','2024-06-28',2579.8,8,'2024-06-08 03:39:11','79.9','99.9','0'),(72,'ikbais','M1006','2024-06-08','2024-06-21',2779.8,13,'2024-06-08 08:16:11','79.9','99.9','0');
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-08 12:53:34

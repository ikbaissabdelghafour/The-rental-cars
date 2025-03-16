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
-- Table structure for table `payement`
--

DROP TABLE IF EXISTS `payement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payement` (
  `username` varchar(55) DEFAULT NULL,
  `nbcard` varchar(255) NOT NULL,
  `datecard` varchar(255) NOT NULL,
  `cvv` varchar(255) NOT NULL,
  KEY `username` (`username`),
  CONSTRAINT `payement_ibfk_1` FOREIGN KEY (`username`) REFERENCES `clients` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payement`
--

LOCK TABLES `payement` WRITE;
/*!40000 ALTER TABLE `payement` DISABLE KEYS */;
INSERT INTO `payement` VALUES ('abdelghafour','8c2e25f1baebd51757b5685f15af3be3e455a39b','5aec29b5581c014a95e12f19f980e8d8c2f52bb4','7fdec83a2662ffe53af456402cbaeafa380b15b4'),('abdelghafour','8c2e25f1baebd51757b5685f15af3be3e455a39b','5aec29b5581c014a95e12f19f980e8d8c2f52bb4','7fdec83a2662ffe53af456402cbaeafa380b15b4'),('hamza','a39b4e18d8c7b170af6cfa13eeb465682028fc89','4cf6a472bceb37418d6f4c24e9dfd31f9b6452db','43814346e21444aaf4f70841bf7ed5ae93f55a9d'),('hamza','3da5412b3b94fc3ed52ba326dfc76dba6f8578b0','b5da72794c83c59d00014c6a31e1daf680d72a7e','4dcee7f85df40fc71dcad450a6cbc55190e1253b'),('ikbais','8bd3da229cc1ca14b94e308f8440f2cbfdba7205','ba848b8800c2c4736d4c88bc989ba8ac02ea5e53','961cc96ada94bed0d2ff9d76556e8651995d940f'),('abdelghafour','9874669399ae523834cbaf677c84f25a4d783a7c','a4c707cba5fe0ddfbefbf34a5d7e8d6476c07aa0','828f720439cefaeb3acc7a7babce0a28abaa07a3'),('abdelghafour','a8e6dc0e0c7eb69fb2897d2065284f578bcdfd6e','8ffdacc8b6c899021f9a307125625fc1eb1beb95','1c6637a8f2e1f75e06ff9984894d6bd16a3a36a9');
/*!40000 ALTER TABLE `payement` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-08 12:53:33

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
-- Table structure for table `voitures`
--

DROP TABLE IF EXISTS `voitures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `voitures` (
  `matricule` varchar(17) NOT NULL,
  `marque` varchar(55) NOT NULL,
  `modele` varchar(55) NOT NULL,
  `carossseri_type` varchar(55) DEFAULT NULL,
  `type_de_carburant` varchar(55) NOT NULL,
  `vitesse` varchar(55) DEFAULT NULL,
  `color` varchar(55) NOT NULL,
  `prix_par_jour` double NOT NULL,
  `photo` text NOT NULL,
  `porte` int DEFAULT NULL,
  `quantite` int DEFAULT '0',
  PRIMARY KEY (`matricule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voitures`
--

LOCK TABLES `voitures` WRITE;
/*!40000 ALTER TABLE `voitures` DISABLE KEYS */;
INSERT INTO `voitures` VALUES ('M1004lll','Dacia','logain','berline','Desiel','automatique','rouge',250,'BMW.jpg',4,0),('M1006','ford','logain','berline','Desiel','Manuel','rouge',200,'ncm1.png',5,81),('m1253','ford','festa','berline','essence','manuel','red',300,'Audi.jpg',4,84),('m1255','ford','festa','berline','essence','manuel','red',300,'BMW.jpg',4,81),('m1256','ford','festa','berline','essence','manuel','red',300,'Chevrolet.jpg',4,87),('m1257','ford','festa','berline','essence','manuel','red',300,'Citroen.jpg',4,87),('m1259','ford','festa','berline','essence','manuel','red',300,'DaciaSandero_4.jpg',4,87),('m1260','ford','festa','berline','essence','manuel','red',300,'Ferrari.jpg',4,87),('m1261','ford','festa','berline','essence','manuel','red',300,'Fiat.jpg',4,87),('m1262','ford','festa','berline','essence','manuel','red',300,'ford_fiesta_st200_3.jpg',4,87),('m1263','ford','festa','berline','essence','manuel','red',300,'Ford.jpg',4,86),('m1264','ford','festa','berline','essence','manuel','red',300,'Honda.jpg',4,87),('m1265','ford','festa','berline','essence','manuel','red',300,'Hummer.jpg',4,87),('m1266','ford','festa','berline','essence','manuel','red',300,'Jaguar.jpg',4,87),('m1268','ford','festa','berline','essence','manuel','red',300,'LR.jpg',4,87),('m1269','ford','festa','berline','essence','manuel','red',300,'Mazda.jpg',4,87),('m1270','ford','festa','berline','essence','manuel','red',300,'Mercedes.jpg',4,87),('m1271','ford','festa','berline','essence','manuel','red',300,'ncm1.png',4,87),('m1272','ford','festa','berline','essence','manuel','red',300,'ncm2.png',4,87),('m1273','ford','festa','berline','essence','manuel','red',300,'Nissan.jpg',4,87),('m1274','ford','festa','berline','essence','manuel','red',300,'Nosferatu.jpg',4,87),('m1275','ford','festa','berline','essence','manuel','red',300,'Opel.jpg',4,87),('m1276','ford','festa','berline','essence','manuel','red',300,'Peugeot.jpg',4,87),('m12885','ford','festa','berline','essence','manuel','red',300,'Suzuki.jpg',4,87),('m1297','ford','festa','berline','essence','manuel','red',300,'Tesla.jpg',4,87),('m1645','ford','festa','berline','essence','manuel','red',300,'RR.jpg',4,87),('m178','ford','festa','berline','essence','manuel','red',300,'Renault.jpg',4,87);
/*!40000 ALTER TABLE `voitures` ENABLE KEYS */;
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

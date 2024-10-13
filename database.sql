-- MariaDB dump 10.19  Distrib 10.7.8-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: agence
-- ------------------------------------------------------
-- Server version	10.7.8-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chemin` varchar(250) NOT NULL,
  `publication_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_publication_id` (`publication_id`),
  CONSTRAINT `fk_publication_id` FOREIGN KEY (`publication_id`) REFERENCES `publications` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery`
--

LOCK TABLES `gallery` WRITE;
/*!40000 ALTER TABLE `gallery` DISABLE KEYS */;
INSERT INTO `gallery` VALUES
(70,'/images/gallery/image-66d65a3cab061{E97F9A29-1CF5-4093-9D05-E8B329647DB2}.png',39),
(71,'/images/gallery/image-66d65a3cabce2avatar-the-last-airbender-aang-beautiful-desktop-wallpaper-4k.jpg',39),
(72,'/images/gallery/image-66d65a3cacee0blue-night-mountains-desktop-wallpaper.jpg',39),
(73,'/images/gallery/image-66d65a8c79566enchanted-magical-forest-desktop-wallpaper.jpg',40),
(74,'/images/gallery/image-66d65a8c7a2c8girl-enjoying-mountain-landscape-desktop-wallpaper.jpg',40),
(75,'/images/gallery/image-66d65a8c7affagodzilla-fighting-in-city-desktop-wallpaper.jpg',40),
(76,'/images/gallery/image-66d65b55df880green-nature-landscape-desktop-wallpaper.jpg',41),
(77,'/images/gallery/image-66d65b55e0393king-kong-in-mountains-desktop-wallpaper.jpg',41),
(78,'/images/gallery/image-66d65b55e170elandscape-sunflower-field-clouds-desktop-wallpaper.jpg',41),
(79,'/images/gallery/image-66d65fbd01a50underwater-mermaid-coral-reef-desktop-wallpaper.jpg',41),
(80,'/images/gallery/image-66d65fbd0d8c6vibrant-forest-scenery-green-light-desktop-wallpaper.jpg',41),
(81,'/images/gallery/image-66d65fbd13b42village-by-lake-in-mountains-landscape-desktop-wallpaper.jpg',41),
(82,'/images/gallery/image-66d65fbd1db19wolf-beige-moon-dark-desktop-wallpaper.jpg',41),
(83,'/images/gallery/image-66d8f218eb27c1659376952612.jpg',41),
(84,'/images/gallery/image-66d8f21905880ALA&.jpg',41),
(86,'/images/gallery/image-66d8f21913f60baobab1.jpg',41),
(87,'/images/gallery/image-66d8f2191bd78baobab3.jpg',41),
(88,'/images/gallery/image-66d8f21921bafbaobab4.jpg',41),
(90,'/images/gallery/image-670a91a8b0703blossom-bloom-flower-white.jpg',40);
/*!40000 ALTER TABLE `gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publications`
--

DROP TABLE IF EXISTS `publications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `description` longtext NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publications`
--

LOCK TABLES `publications` WRITE;
/*!40000 ALTER TABLE `publications` DISABLE KEYS */;
INSERT INTO `publications` VALUES
(39,'Antananarivo','Tana-ville','Il se peut que la page Web à l&#039;adresse https://chatgpt.com/ soit temporairement inaccessible ou qu&#039;elle ait été déplacée de façon permanente à une autre adresse Web.','/images/publications/image-670a91581741cbaobab5.jpg'),
(40,'Toamasina','toama-sina','Il se peut que la page Web à l&#039;adresse https://vercel.com/ soit temporairement inaccessible ou qu&#039;elle ait été déplacée de façon permanente à une autre adresse Web.','/images/publications/image-66d65a8c78972enchanted-magical-forest-desktop-wallpaper.jpg'),
(41,'Andasibe','anda-sibe','Il se peut que la page Web à l&#039;adresse https://vercel.com/ soit temporairement inaccessible ou qu&#039;elle ait été déplacée de façon permanente à une autre adresse Web.','/images/publications/image-66d65b55dec3epeakpx (1).jpg');
/*!40000 ALTER TABLE `publications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `passwords` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(8,'admin','02','admin02@gmail.com','/images/users/image-66d398b0b8e84godzilla-fighting-in-city-desktop-wallpaper.jpg','$2y$10$Sx.TSE/ZR7JAmXw9HxYg/u.iJwbfliTkrNzG.yvCaIeliDomWKa1K');
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

-- Dump completed on 2024-10-13 14:10:06

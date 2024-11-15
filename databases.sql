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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valeur` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES
(1,'Balnéaire et plage','baln-eaire-et-plage','/images/categories/image-67303dd94d10fPLAGEé.jpg'),
(2,'Faune et flore','faune-et-flore','/images/categories/image-67303df4aca79FB_IMG_16593597951139554.jpg'),
(3,'Les incontournables','les-incontournables','/images/categories/image-67303e0a5e933ALA&.jpg'),
(7,'Randonnée','randonn-ee','/images/categories/image-67303e1e48d6bbaobab8.jpg'),
(8,'Désert','d-esert',NULL);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery`
--

LOCK TABLES `gallery` WRITE;
/*!40000 ALTER TABLE `gallery` DISABLE KEYS */;
INSERT INTO `gallery` VALUES
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
(90,'/images/gallery/image-670a91a8b0703blossom-bloom-flower-white.jpg',40),
(93,'/images/gallery/image-672e17b483656tropical-forest-with-flowers-desktop-wallpaper-cover.jpg',42),
(99,'/images/gallery/image-6731c0bed656denchanted-magical-forest-desktop-wallpaper.jpg',80),
(100,'/images/gallery/image-6731c0bee2ee7girl-enjoying-mountain-landscape-desktop-wallpaper.jpg',80),
(101,'/images/gallery/image-6731c0bee7aa2godzilla-fighting-in-city-desktop-wallpaper.jpg',80),
(102,'/images/gallery/image-6731c0beeff0agreen-nature-landscape-desktop-wallpaper.jpg',80),
(103,'/images/gallery/image-6731c0bf02e96king-kong-in-mountains-desktop-wallpaper.jpg',80),
(104,'/images/gallery/image-6731c0bf07c51landscape-sunflower-field-clouds-desktop-wallpaper.jpg',80),
(105,'/images/gallery/image-6731c0bf0d04fmountain-river-green-aesthetic-desktop-wallpaper.jpg',80),
(106,'/images/gallery/image-6731c0bf1ae91mountain-settlement-landscape-desktop-wallpaper.jpg',80),
(107,'/images/gallery/image-6731c0bf21281natural-waterfall-landscape-desktop-wallpaper.jpg',80),
(108,'/images/gallery/image-6731c0bf2d398saturated-color-landscape-desktop-wallpaper.jpg',80),
(109,'/images/gallery/image-6731c0bf3d5e6snow-landscape-winter-desktop-wallpaper.jpg',80),
(110,'/images/gallery/image-673386d3c2e4dstarry-night-sky-blue-desktop-wallpaper.jpg',74);
/*!40000 ALTER TABLE `gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publication_category`
--

DROP TABLE IF EXISTS `publication_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publication_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publication_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `publication_id` (`publication_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `publication_category_ibfk_1` FOREIGN KEY (`publication_id`) REFERENCES `publications` (`id`) ON DELETE CASCADE,
  CONSTRAINT `publication_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publication_category`
--

LOCK TABLES `publication_category` WRITE;
/*!40000 ALTER TABLE `publication_category` DISABLE KEYS */;
INSERT INTO `publication_category` VALUES
(39,39,7),
(45,75,2),
(48,41,2),
(49,41,3),
(61,40,2),
(65,74,1),
(66,74,2),
(67,74,3),
(68,42,1),
(69,42,8),
(71,80,1),
(72,80,2),
(73,80,3);
/*!40000 ALTER TABLE `publication_category` ENABLE KEYS */;
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
  `subtitle` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publications`
--

LOCK TABLES `publications` WRITE;
/*!40000 ALTER TABLE `publications` DISABLE KEYS */;
INSERT INTO `publications` VALUES
(39,'Antananarivo','Tana-ville',' Hum, nous ne parvenons pas à trouver ce site.  Impossible de se connecter au serveur à l’adresse www.voyagemadagascar.com.  Si l’adresse saisie était correcte, vous pouvez :      Réessayer plus tard     Veuillez vérifier votre connexion réseau     Vérifier que Firefox a l’autorisation d’accéder au Web (votre connexion pourrait être effective, mais protégée par un pare-feu)','/images/publications/image-670a91581741cbaobab5.jpg',NULL),
(40,'Toamasina','toamasina','Il se peut que la page Web à l&#039;adresse https://vercel.com/ soit temporairement inaccessible ou qu&#039;elle ait été déplacée de façon permanente à une autre adresse Web.','/images/publications/image-66d65a8c78972enchanted-magical-forest-desktop-wallpaper.jpg','Visit'),
(41,'Andasibe','andasibe','Il se peut que la page Web à l&#039;adresse https://vercel.com/ soit temporairement inaccessible ou qu&#039;elle ait été déplacée de façon permanente à une autre adresse Web.','/images/publications/image-66d65b55dec3epeakpx (1).jpg',NULL),
(42,'Masoala','masoala','La saison des pluies à Madagascar est une période où la végétation magnifique anime une vie resplendissante et pleine de force. La Nature, d&#039;une extrême beauté, est illuminée par les lumières franches, belles et douces. Cet itinéraire se déroule entre les Hautes Terres et le Canal du Mozambique. La diversité des paysages, la vie partout présente, en font des attraits incomparables pour qui veut vivre Madagascar pleinement et différemment....','/images/publications/image-672e17b47b508tropical-forest-with-flowers-desktop-wallpaper-cover.jpg','Voyagez dans les montagnes centrales'),
(74,'L&#039;Ouest malgache','l-ouest-malgache','L&#039;Ouest malgache ou la côte des Baobabs, ces arbres majestueux, racines dans les cieux, les arbres des rois, le roi des arbres… Tant de louanges données par des voyageurs, des scientifiques, des aventuriers tombés amoureux de la grandeur, d&#039;un peuple Sakalava, peuple de l&#039;Ouest, d&#039;un mode de vie mais surtout de paysages grandioses. Partons à la conquête du fabuleux et de l&#039;intemporel à travers ce voyage dans l&#039;Ouest malgache: de la navigation sur la Tsiribihina au Tsingy de Bemaraha et Morondava et une fin de séjour pieds dans l&#039;eau à Belo sur Mer.','/images/publications/image-672e34d39a906field-of-daisies-landscape-desktop-wallpaper.jpg','sdfsdfsd'),
(75,'Madagascar','dsfsdf','L&#039;Ouest malgache ou la côte des Baobabs, ces arbres majestueux, racines dans les cieux, les arbres des rois, le roi des arbres… Tant de louanges données par des voyageurs, des scientifiques, des aventuriers tombés amoureux de la grandeur, d&#039;un peuple Sakalava, peuple de l&#039;Ouest, d&#039;un mode de vie mais surtout de paysages grandioses. Partons à la conquête du fabuleux et de l&#039;intemporel à travers ce voyage dans l&#039;Ouest malgache: de la navigation sur la Tsiribihina au Tsingy de Bemaraha et Morondava et une fin de séjour pieds dans l&#039;eau à Belo sur Mer.','/images/publications/image-672e3505a0d8bbeautiful-fantasy-landscape-desktop-wallpaper.jpg',NULL),
(80,'Mahajanga','mahajanga','    .form-control : Cette classe stylise le textarea en lui ajoutant un padding, une bordure et un style responsive, conforme aux autres éléments de formulaire de Bootstrap.\r\n    rows=&quot;4&quot; : Définit la hauteur visible en lignes pour le textarea. Tu peux ajuster cette valeur selon tes besoins.\r\n\r\nOptions supplémentaires de style avec Bootstrap :\r\n\r\n    Largeur adaptative : En utilisant les classes de grille de Bootstrap, tu peux contrôler la largeur du textarea. Par exemple, col-md-6 limite sa largeur à 50% de l’écran sur des écrans moyens (md) ou plus grands.\r\n    Redimensionnement : Bootstrap permet par défaut de redimensionner le textarea en tirant le coin inférieur droit. Pour empêcher cela, tu peux ajouter du CSS.','/images/publications/image-6731bf5d2b1bdwitcher-3-pink-sunset-landscape-aesthetic-desktop-wallpaper-cover.jpg','Visitez les plages de sable');
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

-- Dump completed on 2024-11-15 16:26:00

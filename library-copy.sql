-- MySQL dump 10.13  Distrib 8.1.0, for macos13.3 (arm64)
--
-- Host: localhost    Database: library
-- ------------------------------------------------------
-- Server version	8.1.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `authors` (
  `id_authors` int NOT NULL AUTO_INCREMENT,
  `lastNameAuthor` varchar(80) NOT NULL,
  `firstNameAuthor` varchar(80) NOT NULL,
  `country_id` int NOT NULL,
  PRIMARY KEY (`id_authors`),
  KEY `country_id` (`country_id`),
  CONSTRAINT `authors_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id_country`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authors`
--

LOCK TABLES `authors` WRITE;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
INSERT INTO `authors` VALUES (1,'Austen','Jane',9),(2,'Tolkien','J.R.R.',2),(3,'Christie','Agatha',9),(4,'Asimov','Isaac',1),(5,'Mandela','Nelson',2),(6,'Orwell','Georges',3),(7,'Sagan','Carl',4),(8,'Larsson','Stieg',5),(9,'Murakami','Haruki',6),(10,'Stocker','Bram',7),(11,'Hugo','Victor',8),(12,'Salinger','J.D.',4);
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `books` (
  `id_book` int NOT NULL AUTO_INCREMENT,
  `bookTitle` varchar(255) NOT NULL,
  `summary` text,
  `price` float NOT NULL,
  `releaseDate` date DEFAULT NULL,
  `author_id` int NOT NULL,
  `copy_id` int NOT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id_book`),
  KEY `author_id` (`author_id`),
  KEY `copy_id` (`copy_id`),
  KEY `fk_books_categories` (`category_id`),
  CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id_authors`),
  CONSTRAINT `books_ibfk_2` FOREIGN KEY (`copy_id`) REFERENCES `copies` (`id_copy`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,'Le Seigneur des Anneaux','L\'Anneau de Pouvoir, forgé par Sauron au cœur de la Montagne du Feu, dépositaire de son sombre pouvoir, est perdu. Nul ne sait ce qu\'il est devenu depuis qu\'un homme l\'a arraché de la main du Seigneur Sombre et, ainsi, put chasser ce dernier hors du monde.',20.99,NULL,2,1,NULL),(2,'Dix Petits Nègres','Dix personnes apparemment sans point commun se retrouvent sur l’île du Nègre, invités par un mystérieux M. Owen, malheureusement absent. Un couple de domestiques, récemment engagé, veille au confort des invités. Sur une table du salon, dix statuettes de nègres. Dans les chambres, une comptine racontant l’élimination minutieuse de dix petits nègres. Après le premier repas, une voix mystérieuse s’élève dans la maison, reprochant à chacun un ou plusieurs crimes. Un des convives s’étrangle et meurt, comme la première victime de la comptine. Une statuette disparaît. Et les morts se succèdent, suivant le texte à la lettre. La psychose monte. Le coupable se cache-t-il dans l’île, parmi les convives ?',12.99,NULL,3,2,NULL),(3,'Fondation','Ce livre du Cycle de Fondation est composé de cinq nouvelles, chacune formant une histoire à part entière et couvrant à elles cinq les cent-cinquante-cinq premières années de l’interrègne.',26.99,NULL,4,3,NULL),(4,'Un long chemin vers la liberté','Un long chemin vers la liberté (Long Walk to Freedom) est le récit autobiographique de la vie de Nelson Mandela publié en 1994, depuis son enfance jusqu\'à son premier mandat de président. Le livre aborde les 27 ans de prison et son combat pour la reconnaissance des droits des Noirs en Afrique du Sud.',23.99,NULL,5,4,NULL),(6,'Cosmos','Le Cosmos est tout ce qui est, a toujours été ou sera jamais\". C\'est par ces mots que Carl Sagan nous invite à le suivre, dans un prodigieux voyage à travers l\'espace et le temps qui mènera le lecteur jusqu\'aux confins du connaissable.',12.99,NULL,7,6,NULL),(7,'Millénium, tome 1','L\'histoire est complexe : Mikael Blomkvist, journaliste et fondateur du journal Millenium, est inculpé pour diffamation. En parallèle, il reçoit une étrange demande provenant d\'Henrik Venger, vieillard à la tête d\'une entreprise gigantesque.',32.49,NULL,8,7,NULL),(8,'1Q84','L\'histoire est complexe : Mikael Blomkvist, journaliste et fondateur du journal Millenium, est inculpé pour diffamation. En parallèle, il reçoit une étrange demande provenant d\'Henrik Venger, vieillard à la tête d\'une entreprise gigantesque.\'), (\'Un pacte secret conclu entre deux enfants, le signe d\'un amour pur dont ils auront toujours la nostalgie. En 1984, chacun mène sa vie, ses amours, ses activités. Tueuse professionnelle, Aomamé se croit investie d\'une mission : exécuter les hommes qui ont fait violence aux femmes.',12.99,NULL,9,8,NULL),(9,'L Attrape-cœur','Il raconte trois jours d\'errements et de réflexions d\'un adolescent de 17 ans, ultrasensible et révolté. Holden Caufield, à New York, en a plus que marre. Encore renvoyé d\'un énième collège, à cause de son absentéisme et de mauvais résultats scolaires, il fugue de la pension du très côté établissement de Pencey.',10.49,NULL,12,9,NULL),(10,'Les Misérables','En 1815, Jean Valjean est libéré du bagne de Toulon après y avoir purgé une peine de dix-neuf ans : victime d\'un destin tragique, initialement condamné à cinq ans de bagne pour avoir volé un pain afin de nourrir sa famille, il voit sa peine prolongée à la suite de plusieurs tentatives d\'évasion.',29.49,NULL,11,10,NULL),(11,'Dracula','Jonathan Harker, jeune notaire, est envoyé en Transylvanie pour rencontrer un client, le Comte Dracula, nouveau propriétaire d\'un domaine à Londres. A son arrivée, il découvre un pays mystérieux et menaçant, dont les habitants se signent au nom de Dracula.',22.39,NULL,10,11,NULL);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books_categories`
--

DROP TABLE IF EXISTS `books_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `books_categories` (
  `book_id` int NOT NULL,
  `category_id` int NOT NULL,
  KEY `book_id` (`book_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `books_categories_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id_book`),
  CONSTRAINT `books_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id_category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books_categories`
--

LOCK TABLES `books_categories` WRITE;
/*!40000 ALTER TABLE `books_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `books_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `bookType` varchar(80) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Fantasy'),(2,'Mystère/Thriller'),(3,'Science-Fiction'),(4,'Autobiographie'),(5,'Dystopie'),(6,'Science populaire'),(7,'Polar nordique'),(8,'Poésie'),(9,'Roman contemporain'),(10,'Roman épistolaire'),(11,'Littérature classique française'),(12,'Roman de formation');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `copies`
--

DROP TABLE IF EXISTS `copies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `copies` (
  `id_copy` int NOT NULL AUTO_INCREMENT,
  `refBook` varchar(80) NOT NULL,
  `publisher_id` int DEFAULT NULL,
  PRIMARY KEY (`id_copy`),
  KEY `publisher_id` (`publisher_id`),
  CONSTRAINT `copies_ibfk_1` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`id_publisher`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `copies`
--

LOCK TABLES `copies` WRITE;
/*!40000 ALTER TABLE `copies` DISABLE KEYS */;
INSERT INTO `copies` VALUES (1,'7265938102',NULL),(2,'8492175063',NULL),(3,'3621589047',NULL),(4,'9357146820',NULL),(5,'1045296378',NULL),(6,'6708432195',NULL),(7,'2819467350',NULL),(8,'5397021864',NULL),(9,'4682017539',NULL),(10,'6528193407',NULL),(11,'5874321098',NULL),(12,'3147598206',NULL),(13,'9265104738',NULL);
/*!40000 ALTER TABLE `copies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `copies_subscribers`
--

DROP TABLE IF EXISTS `copies_subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `copies_subscribers` (
  `copy_id` int NOT NULL,
  `sub_id` int NOT NULL,
  `borrowDate` datetime NOT NULL,
  `dueDate` datetime NOT NULL,
  KEY `copy_id` (`copy_id`),
  KEY `sub_id` (`sub_id`),
  CONSTRAINT `copies_subscribers_ibfk_1` FOREIGN KEY (`copy_id`) REFERENCES `copies` (`id_copy`),
  CONSTRAINT `copies_subscribers_ibfk_2` FOREIGN KEY (`sub_id`) REFERENCES `subscribers` (`id_sub`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `copies_subscribers`
--

LOCK TABLES `copies_subscribers` WRITE;
/*!40000 ALTER TABLE `copies_subscribers` DISABLE KEYS */;
/*!40000 ALTER TABLE `copies_subscribers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
  `id_country` int NOT NULL AUTO_INCREMENT,
  `country` varchar(80) NOT NULL,
  PRIMARY KEY (`id_country`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Russie'),(2,'Afrique du Sud'),(3,'Inde'),(4,'Etats-Unis'),(5,'Suède'),(6,'Japon'),(7,'Irlande'),(8,'France'),(9,'Royaume-Unis');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publishers`
--

DROP TABLE IF EXISTS `publishers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `publishers` (
  `id_publisher` int NOT NULL AUTO_INCREMENT,
  `publisherName` varchar(80) NOT NULL,
  PRIMARY KEY (`id_publisher`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publishers`
--

LOCK TABLES `publishers` WRITE;
/*!40000 ALTER TABLE `publishers` DISABLE KEYS */;
/*!40000 ALTER TABLE `publishers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscribers` (
  `id_sub` int NOT NULL AUTO_INCREMENT,
  `lastNameSub` varchar(80) NOT NULL,
  `firstNameSub` varchar(80) NOT NULL,
  `birthDateSub` date NOT NULL,
  `emailSub` varchar(45) NOT NULL,
  `phoneNumberSub` varchar(45) NOT NULL,
  `adStreetSub` varchar(255) NOT NULL,
  `citySub` varchar(45) NOT NULL,
  `postalCodeSub` varchar(20) NOT NULL,
  `dateSub` date NOT NULL,
  PRIMARY KEY (`id_sub`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscribers`
--

LOCK TABLES `subscribers` WRITE;
/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;
INSERT INTO `subscribers` VALUES (1,'Raffalli','Emilia','1989-08-15','e.raffalli@hotmail.fr','0625778014','9 cours des Juilliottes','Maisons-Alfort','94700','2023-11-06'),(2,'Gastin','Hervé','1978-12-13','h.gastin@gmail.com','0722487622','12, rue Popimcourt','Paris','75020','2023-11-06'),(3,'Grimberg','Catherine','1957-06-21','cath.grim@gmail.com','0678909223','21, rue des Tournelles','Paris','75011','2023-11-06'),(4,'Lucet','Elise','1992-04-15','lucet@yahoo.fr','0612877645','194, rue des Pyrénées','Paris','75020','2023-11-06');
/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-08 12:07:21

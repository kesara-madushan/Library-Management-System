CREATE DATABASE  IF NOT EXISTS `onlinelibrarydb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `onlinelibrarydb`;
-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: localhost    Database: onlinelibrarydb
-- ------------------------------------------------------
-- Server version	8.0.26

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
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `books` (
  `book_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `isbn` varchar(45) NOT NULL,
  `author` varchar(45) NOT NULL,
  `copies` int NOT NULL DEFAULT '0',
  `category` varchar(20) DEFAULT NULL,
  `available` int NOT NULL,
  PRIMARY KEY (`book_id`,`isbn`),
  UNIQUE KEY `isbn_UNIQUE` (`isbn`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (2,'Poirot Investigates Stories','9780812504255','Agatha Christie',2,'Fictions',2),(3,'The Secret Seven 6','9780340893128','Enid Blyton',4,'Fictions',3),(4,'Homo Deus','9781784703936','Yuval Noah Harari',1,'History',1),(5,'Anthro Vision','9781847942883','Gillian Tett',5,'Economics',3),(6,'Post Corona -  From Crisis to Opportunity','9781787634817','Scott Galloway',2,'Economics',2),(7,'The Grand Design','9780553819229','Steven Hawking',3,'Science',3),(8,'The Adventures of Sherlock Holmes','9780192823786','Sir Arthur Conan Doyle',3,'Fictions',3),(9,'Greenlights','9780593139134','Matthew McConaughey',3,'Arts',3);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lending_records`
--

DROP TABLE IF EXISTS `lending_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lending_records` (
  `record_id` int NOT NULL AUTO_INCREMENT,
  `isbn` varchar(45) NOT NULL,
  `reg_no` varchar(10) NOT NULL,
  `date_issued` date NOT NULL,
  `due_date` date NOT NULL,
  `returned` varchar(5) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`record_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lending_records`
--

LOCK TABLES `lending_records` WRITE;
/*!40000 ALTER TABLE `lending_records` DISABLE KEYS */;
INSERT INTO `lending_records` VALUES (4,'9780553819229','EN94563','2021-10-30','2021-11-13','yes'),(5,'9781847942883','EN32632','2021-10-30','2021-11-13','no'),(6,'9780340893128','EN94563','2021-10-30','2021-11-13','yes'),(7,'9781847942883','EN94563','2021-10-30','2021-11-13','no'),(8,'9780340893128','EN94563','2021-10-30','2021-11-13','no');
/*!40000 ALTER TABLE `lending_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `librarians`
--

DROP TABLE IF EXISTS `librarians`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `librarians` (
  `librarian_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`librarian_id`,`username`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `librarians`
--

LOCK TABLES `librarians` WRITE;
/*!40000 ALTER TABLE `librarians` DISABLE KEYS */;
INSERT INTO `librarians` VALUES (1,'dhanush_lib','Dhanushka','Perera','dhanushka1@gmail.com','1234'),(3,'kesara96','Kesara','Madushan','kesara@gmail.com','4321');
/*!40000 ALTER TABLE `librarians` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `members` (
  `member_id` int NOT NULL AUTO_INCREMENT,
  `reg_no` varchar(10) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(45) NOT NULL,
  `role` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fines` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`member_id`,`reg_no`,`email`),
  UNIQUE KEY `member_id_UNIQUE` (`member_id`),
  UNIQUE KEY `reg_no_UNIQUE` (`reg_no`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'EN94563','Kusal','Perera','kusal99@gmail.com','Student','1234',0),(3,'EN31789','Bhanuka','Rajapaksha','bhanuka@gmail.com','Student','4321',0),(4,'EN32632','Charith','Asalanka','charith@gmail.com','Student','456321',0),(5,'AC45632','Chaminda','Vaas','chaminda@gmail.com','Professor','1234',0),(6,'AC45963','Rangana','Herath','rangana@gmail.com','Professor','123456',0),(7,'EN97456','Avishka','Fernando','avishka@gmail.com','Student','789456',0);
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-30 21:18:03

-- MySQL dump 10.13  Distrib 8.0.12, for linux-glibc2.12 (x86_64)
--
-- Host: localhost    Database: birdsoffeathers
-- ------------------------------------------------------
-- Server version	8.0.12
use birdsoffeathers;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Donation`
--

DROP TABLE IF EXISTS `Donation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `Donation` (
  `DonationID` int(11) NOT NULL AUTO_INCREMENT,
  `Amount` decimal(19,2) NOT NULL,
  `DonationStatus` enum('In-Progress','Completed') NOT NULL,
  `UserID` int(11) NOT NULL,
  `Currency` enum('USD','EUR','JPY') NOT NULL,
  PRIMARY KEY (`DonationID`),
  KEY `UserID` (`UserID`),
  CONSTRAINT `Donation_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `User` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Donation`
--

LOCK TABLES `Donation` WRITE;
/*!40000 ALTER TABLE `Donation` DISABLE KEYS */;
INSERT INTO `Donation` VALUES (1,10.00,'In-Progress',2,'USD'),(2,17.00,'In-Progress',2,'USD'),(3,17.00,'In-Progress',2,'USD'),(4,10.00,'In-Progress',2,'USD'),(5,10.00,'In-Progress',2,'USD'),(6,10.00,'In-Progress',2,'USD'),(7,10.00,'In-Progress',2,'USD'),(8,10.00,'In-Progress',2,'USD'),(9,10.00,'In-Progress',2,'USD'),(10,15.00,'In-Progress',2,'USD'),(11,16.00,'In-Progress',2,'EUR'),(12,120.00,'Completed',2,'JPY'),(13,20.00,'Completed',2,'EUR'),(14,100.00,'In-Progress',2,'JPY'),(15,100.00,'In-Progress',2,'JPY'),(16,100.00,'In-Progress',2,'JPY'),(17,100.00,'Completed',2,'JPY'),(18,14.00,'Completed',2,'USD'),(19,11.00,'Completed',2,'USD'),(20,15.00,'Completed',2,'EUR'),(21,10.00,'Completed',1,'USD'),(22,10.00,'Completed',1,'USD'),(23,10.00,'Completed',1,'USD'),(24,10.00,'Completed',1,'JPY'),(25,10.00,'In-Progress',2,'USD'),(26,10.00,'In-Progress',1,'USD'),(27,10.00,'In-Progress',1,'USD'),(28,10.00,'Completed',1,'USD'),(29,10.00,'Completed',1,'USD'),(30,50.00,'Completed',2,'EUR'),(31,25.00,'Completed',2,'EUR');
/*!40000 ALTER TABLE `Donation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EventRegistration`
--

DROP TABLE IF EXISTS `EventRegistration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `EventRegistration` (
  `Event_RegistrationID` int(11) NOT NULL AUTO_INCREMENT,
  `Event_RegistrationTime` datetime NOT NULL,
  `Event_RegistrationStatus` enum('Pending','Confirmed') NOT NULL,
  `RemindMeFlag` enum('No','Yes') NOT NULL,
  `UserID` int(11) NOT NULL,
  `EventID` int(11) NOT NULL,
  PRIMARY KEY (`Event_RegistrationID`),
  KEY `UserID` (`UserID`),
  KEY `EventID` (`EventID`),
  CONSTRAINT `EventRegistration_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `User` (`userid`),
  CONSTRAINT `EventRegistration_ibfk_2` FOREIGN KEY (`EventID`) REFERENCES `Events` (`eventid`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EventRegistration`
--

LOCK TABLES `EventRegistration` WRITE;
/*!40000 ALTER TABLE `EventRegistration` DISABLE KEYS */;
INSERT INTO `EventRegistration` VALUES (1,'2018-12-08 21:51:25','Confirmed','No',2,2),(3,'2018-12-08 22:08:34','Confirmed','No',2,1),(4,'2018-12-08 22:30:11','Confirmed','No',1,2),(5,'2018-12-08 22:30:30','Confirmed','No',1,1),(11,'2018-12-08 22:48:30','Confirmed','No',3,2),(13,'2018-12-08 23:05:35','Confirmed','No',3,1),(14,'2018-12-08 23:44:22','Confirmed','No',2,5),(15,'2018-12-08 23:44:39','Confirmed','No',3,5),(16,'2018-12-08 23:46:32','Confirmed','No',1,4);
/*!40000 ALTER TABLE `EventRegistration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Events`
--

DROP TABLE IF EXISTS `Events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `Events` (
  `EventID` int(11) NOT NULL AUTO_INCREMENT,
  `EventName` varchar(100) NOT NULL,
  `Location` varchar(100) NOT NULL,
  `StartDateTime` datetime NOT NULL,
  `EndDateTime` datetime NOT NULL,
  `Registration_EndDate` datetime NOT NULL,
  `EventFee` decimal(19,2) NOT NULL,
  `AvailableSeats` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`EventID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Events`
--

LOCK TABLES `Events` WRITE;
/*!40000 ALTER TABLE `Events` DISABLE KEYS */;
INSERT INTO `Events` VALUES (1,'christmas celebration','School Auditorium','2018-12-21 11:05:00','2018-12-21 18:30:00','2018-12-19 00:00:00',25.50,'35'),(2,'New Year ','Campus','2018-12-31 17:00:00','2019-01-01 03:00:00','2018-12-21 00:00:00',15.00,'45'),(4,'Reunion','Campus','2019-01-10 09:00:00','2019-01-15 18:00:00','2019-01-02 00:00:00',0.00,'200'),(5,'REunion Volunteering','Meeting Room','2018-12-17 13:40:00','2018-12-17 16:40:00','2018-12-12 00:00:00',0.00,'2');
/*!40000 ALTER TABLE `Events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `External_Transactions`
--

DROP TABLE IF EXISTS `External_Transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `External_Transactions` (
  `ExternalTranID` int(11) NOT NULL AUTO_INCREMENT,
  `TransactionType` enum('Income','Expense') NOT NULL,
  `Amount` decimal(19,2) NOT NULL,
  `ExternalParty` varchar(100) NOT NULL,
  PRIMARY KEY (`ExternalTranID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `External_Transactions`
--

LOCK TABLES `External_Transactions` WRITE;
/*!40000 ALTER TABLE `External_Transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `External_Transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `FAQContent`
--

DROP TABLE IF EXISTS `FAQContent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `FAQContent` (
  `FAQID` int(11) NOT NULL AUTO_INCREMENT,
  `FAQQuestion` varchar(200) NOT NULL,
  `FAQAnswer` varchar(4000) NOT NULL,
  `FAQStatus` enum('Inactive','Active') NOT NULL,
  PRIMARY KEY (`FAQID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FAQContent`
--

LOCK TABLES `FAQContent` WRITE;
/*!40000 ALTER TABLE `FAQContent` DISABLE KEYS */;
INSERT INTO `FAQContent` VALUES (2,'What is the meaning of FAQ ?','FAQ means Frequently Asked Questions','Active'),(3,'What is this website about?','This website is about a school','Active'),(4,'How do I enroll my child at Grant?','We are thrilled to welcome new members to our community! Please contact the district Registration office for more information about enrolling your child in our school. You may also download and print a copy of the registration forms and bring the completed forms, together with the required documentation, to the main office of the school your child will attend.','Active'),(5,'Do you provide transportation services?','We are pleased to provide our students with safe, reliable transportation to and from school each day. We consider bus riding a privilege and expect all students to adhere to the rules for their own safety as well as for the safety of others. For information on bus policies, schedules, and routes, please contact the district Transportation Office.','Active'),(6,'What are the school hours?','Arrival: 7:45 a.m. Dismissal: 2:48 p.m.','Active'),(7,'Does your school offer breakfast and lunch?','We operate an excellent nutrition program at each campus. Our cafeteria serves breakfast and lunch every school day for a reasonable price. We also participate in the federal free and reduced-price lunch program for those who qualify. For more information or to apply for free/reduced meals, please contact the district Food Services Office. ','Active');
/*!40000 ALTER TABLE `FAQContent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GalleryContent`
--

DROP TABLE IF EXISTS `GalleryContent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `GalleryContent` (
  `UserContentID` int(11) NOT NULL,
  `GalleryID` int(11) NOT NULL,
  PRIMARY KEY (`UserContentID`,`GalleryID`),
  KEY `GalleryID` (`GalleryID`),
  CONSTRAINT `GalleryContent_ibfk_1` FOREIGN KEY (`UserContentID`) REFERENCES `UserContent` (`UserContentID`),
  CONSTRAINT `GalleryContent_ibfk_2` FOREIGN KEY (`GalleryID`) REFERENCES `ImageGallery` (`galleryid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GalleryContent`
--

LOCK TABLES `GalleryContent` WRITE;
/*!40000 ALTER TABLE `GalleryContent` DISABLE KEYS */;
/*!40000 ALTER TABLE `GalleryContent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ImageGallery`
--

DROP TABLE IF EXISTS `ImageGallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ImageGallery` (
  `GalleryID` int(11) NOT NULL AUTO_INCREMENT,
  `GalleryName` varchar(100) NOT NULL,
  `ShareFlag` enum('Private','Public') NOT NULL,
  PRIMARY KEY (`GalleryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ImageGallery`
--

LOCK TABLES `ImageGallery` WRITE;
/*!40000 ALTER TABLE `ImageGallery` DISABLE KEYS */;
/*!40000 ALTER TABLE `ImageGallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `InstitutionRecords`
--

DROP TABLE IF EXISTS `InstitutionRecords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `InstitutionRecords` (
  `InstitutionMemberID` int(11) NOT NULL AUTO_INCREMENT,
  `MemberType` varchar(100) NOT NULL,
  `DateofBirth` date NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `EndYearMonth` int(11) DEFAULT NULL,
  `BranchName` char(100) NOT NULL,
  `JoiningYearMonth` int(11) NOT NULL,
  PRIMARY KEY (`InstitutionMemberID`)
) ENGINE=InnoDB AUTO_INCREMENT=1234124 DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `InstitutionRecords`
--

LOCK TABLES `InstitutionRecords` WRITE;
/*!40000 ALTER TABLE `InstitutionRecords` DISABLE KEYS */;
INSERT INTO `InstitutionRecords` VALUES (123104,'Student','2006-06-12','Tom','Paul',NULL,'Mathematics',201711),(123122,'Alumni','1988-10-21','Jerry','Jacob',200211,'History',199906),(123123,'Alumni','2002-11-03','Sam','John',201702,'Chemistry',201604),(123245,'Student','2007-08-16','Mary','Jose',NULL,'English',201701),(123345,'Staff','1999-09-23','Fidel','Cruz',NULL,'History',201607),(123405,'Student','2001-03-24','Laura','Smith',NULL,'Biology',201509),(123412,'Alumni','2002-11-01','Test','SuperUser2',201802,'Physics',201705),(123424,'Alumni','2001-11-25','Test','Member3',201811,'Mathematics',201810),(123444,'Student','2010-05-25','Jake','Van',NULL,'Chemistry',201811),(123456,'Staff','2001-01-01','Test','Member3',NULL,'Mathematics',201801),(123506,'Alumni','2001-02-25','Lisa','Golden',201711,'English',201410),(123567,'Student','2010-01-18','Kevin','Lewis',NULL,'Mathematics',201711),(123659,'Alumni','2010-10-11','Ava','Lewis',201711,'English',201611),(129123,'Staff','1984-10-12','Mariana','Perez',NULL,'Biology',201501),(200000,'Student','2001-02-16','Sita','Bandi',NULL,'ComputerScience',201808),(200001,'Student','2001-09-12','Christopher','Duran',NULL,'Computer Science',201709),(200002,'Student','2001-08-13','Daniel','Laratta',NULL,'Computer Science',201808),(200003,'Student','2002-10-22','Liuhua','Li',NULL,'Computer Science',201807),(200004,'Student','2001-09-28','Marcello','Maritato',NULL,'Computer Science',201608),(200005,'Student','1999-09-17','Benjamin','Michael',NULL,'Computer Science',201709),(200006,'Student','2003-12-12','Michael','Perez',NULL,'Computer Science',201708),(200007,'Student','2004-10-21','Manish','Puri',NULL,'Computer Science',201809),(200008,'Student','2005-12-27','Arshia','Sulthana',NULL,'Computer Science',201809),(200009,'Student','1999-02-23','Litha','Thampan',NULL,'Computer Science',201808),(200010,'Student','2001-03-25','Lydia','Thomas',NULL,'Computer Science',201808),(200011,'Student','2009-03-17','Brian','Gimenez',NULL,'Mathematics',201607),(200012,'Student','2009-05-19','Asafa','Powell',NULL,'English',201509),(222165,'Alumni','2001-03-17','Ryan','Thol',201610,'Mathematics',201410);
/*!40000 ALTER TABLE `InstitutionRecords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `NewsContent`
--

DROP TABLE IF EXISTS `NewsContent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `NewsContent` (
  `NewsID` int(11) NOT NULL AUTO_INCREMENT,
  `NewsTitle` varchar(100) NOT NULL,
  `NewsContent` varchar(4000) NOT NULL,
  `NewsContentStatus` enum('Inactive','Active') NOT NULL,
  `NewsTimestamp` timestamp NOT NULL,
  `NewsImage` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`NewsID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `NewsContent`
--

LOCK TABLES `NewsContent` WRITE;
/*!40000 ALTER TABLE `NewsContent` DISABLE KEYS */;
INSERT INTO `NewsContent` VALUES (1,'Interview with Leon Chislon','Leon Chisholm interviews the Dynamic Sean Graham, Principal of Maggotty High School a young with a passion and drive for excellence.','Active','2018-12-09 07:31:47','2.jpg'),(2,'Maggotty high school celebrates Jamaica Day','Maggotty High School celebrated \"Jamaica Day\" and many competitions were heald and the winners were given prizes','Active','2018-12-09 07:32:28','1.jpg'),(3,'5 schools book second-round berths','ANCHOVY, St James â€” Former champions Cornwall College and Garvey Maceo High were among five schools who booked second-round spots in the ISSA/Wata daCosta Cup football competition with wins in yesterday\'s first round return leg games played on a rain-affected day. In addition to advancing Cornwall College, Pt Antonio High and Garvey Maceo and St Elizabeth Technical High School (STETHS), who had advanced in the previous set of games, all won their respective zones, while Cedric Titus and Manchester High also booked spots in the next round. At least six games were not played due to heavy rains or waterlogged fields and are expected to be played next week.','Active','2018-12-09 07:34:36','5.jpg'),(4,'Mile Gully High, Maggotty clash in D\'Cup quarter-finals','Mile Gully High, Maggotty clash in D\'Cup quarter-finals MANDEVILLE, Manchester â€” Mile Gully High and Maggotty High will meet today in their second ISSA/Wata daCosta Cup quarter-final Group One game at Manchester High as they seek to revive their hopes of making a run at the semi-finals or a spot in the ISSA Champions Cup KO. Both teams lost their opening quarter-final games by similar 1-0 margins on Tuesday, Mile Gully going down to Port Antonio High and Maggotty High losing to Frome Technical. Seven more games will be played tomorrow when the second set of games continue with double headers at Juici Field, the St Elizabeth Technical Sports Complex and Manchester High. After trips to Lucea on Saturday and Port Antonio on Tuesday, Mile Gully will welcome the short trip to Manchester High for today\'s game. The Baron Watson-coached team will hope to recover some of the form that they used in their two games against dethroned champions Rusea\'s High, winning 2-1 at home then losing 2-3 in Lucea to advance on away goals rule in the 4-4 draw. Maggotty High also advanced to the quarter-finals on away goals after drawing 0-0 at home and 1-1 away to Cedric Titus High.','Active','2018-12-09 07:35:15','3.jpg'),(5,'A Students friend','A student\'s friend Letâ€™s believe in the children, says new principal of Maggotty High MAGGOTTY, St Elizabeth â€” New principal of Maggoty High School, Sean Graham, makes no secret of his own struggles as a student. He told his audience at last month\'s inauguration ceremony to mark his elevation as the fifth principal of Maggotty High that his five-year tenure as a student at prestigious Munro College ended in personal disappointment. Yet, that experience also taught him the importance of support from others as he sought to lift himself from mediocrity to excellence. Graham\'s experiences obviously taught him humility and the value of gratitude. He spent more than half of his acceptance speech at the inauguration ceremony thanking those who had helped him, not least his mother. \"I graduated from Munro College in 1995 with four subjects, Maths and English not included,\" the 36-year-old Graham told his audience.','Active','2018-12-09 07:35:55','4.jpg');
/*!40000 ALTER TABLE `NewsContent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Online_Transactions`
--

DROP TABLE IF EXISTS `Online_Transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `Online_Transactions` (
  `TransactionID` int(11) NOT NULL AUTO_INCREMENT,
  `PaymentType` varchar(100) NOT NULL,
  `TransactionDateTime` datetime NOT NULL,
  `TransactionStatus` enum('In-Progress','Failed','Completed') NOT NULL,
  `PaymentSystem_TransID` varchar(100) DEFAULT NULL,
  `Event_RegistrationID` int(11) DEFAULT NULL,
  `DonationID` int(11) DEFAULT NULL,
  `Currency` enum('USD','EUR','JPY') NOT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `Online_Transactions_ibfk_1` (`Event_RegistrationID`),
  KEY `Online_Transactions_ibfk_2` (`DonationID`),
  CONSTRAINT `Online_Transactions_ibfk_1` FOREIGN KEY (`Event_RegistrationID`) REFERENCES `EventRegistration` (`event_registrationid`),
  CONSTRAINT `Online_Transactions_ibfk_2` FOREIGN KEY (`DonationID`) REFERENCES `Donation` (`donationid`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Online_Transactions`
--

LOCK TABLES `Online_Transactions` WRITE;
/*!40000 ALTER TABLE `Online_Transactions` DISABLE KEYS */;
INSERT INTO `Online_Transactions` VALUES (1,'PayPal','2018-11-30 20:18:24','In-Progress',NULL,NULL,4,'USD'),(2,'PayPal','2018-11-30 20:18:55','In-Progress',NULL,NULL,5,'USD'),(3,'PayPal','2018-11-30 20:19:35','In-Progress',NULL,NULL,6,'USD'),(4,'PayPal','2018-11-30 20:25:31','In-Progress',NULL,NULL,7,'USD'),(5,'PayPal','2018-12-02 09:24:16','In-Progress',NULL,NULL,8,'USD'),(6,'PayPal','2018-12-02 09:32:51','In-Progress',NULL,NULL,8,'USD'),(7,'PayPal','2018-12-02 09:34:11','In-Progress',NULL,NULL,8,'USD'),(8,'PayPal','2018-12-02 09:38:14','In-Progress',NULL,NULL,8,'USD'),(9,'PayPal','2018-12-02 09:44:40','In-Progress',NULL,NULL,8,'USD'),(10,'PayPal','2018-12-02 09:45:27','In-Progress',NULL,NULL,8,'USD'),(11,'PayPal','2018-12-02 09:46:53','In-Progress',NULL,NULL,8,'USD'),(12,'PayPal','2018-12-02 09:48:05','In-Progress',NULL,NULL,8,'USD'),(13,'PayPal','2018-12-02 09:54:23','In-Progress',NULL,NULL,8,'USD'),(14,'PayPal','2018-12-02 09:56:24','In-Progress',NULL,NULL,8,'USD'),(15,'PayPal','2018-12-02 09:58:17','In-Progress',NULL,NULL,8,'USD'),(16,'PayPal','2018-12-02 09:58:50','In-Progress',NULL,NULL,8,'USD'),(17,'PayPal','2018-12-02 09:59:11','In-Progress',NULL,NULL,8,'USD'),(18,'PayPal','2018-12-02 10:00:18','In-Progress',NULL,NULL,8,'USD'),(19,'PayPal','2018-12-02 10:11:43','In-Progress',NULL,NULL,8,'USD'),(20,'PayPal','2018-12-02 10:13:40','In-Progress',NULL,NULL,8,'USD'),(21,'PayPal','2018-12-02 10:15:21','In-Progress',NULL,NULL,8,'USD'),(22,'PayPal','2018-12-02 10:20:39','In-Progress',NULL,NULL,8,'USD'),(23,'PayPal','2018-12-02 10:21:58','In-Progress',NULL,NULL,8,'USD'),(24,'PayPal','2018-12-02 10:24:09','In-Progress',NULL,NULL,8,'USD'),(25,'PayPal','2018-12-02 10:25:47','In-Progress',NULL,NULL,9,'USD'),(26,'PayPal','2018-12-02 12:21:43','Completed','3RL82519VT949984E',NULL,10,'USD'),(27,'PayPal','2018-12-02 12:46:13','Completed','6N998906XP4592128',NULL,11,'EUR'),(28,'PayPal','2018-12-02 12:48:50','In-Progress',NULL,NULL,12,'JPY'),(29,'PayPal','2018-12-02 12:51:56','Completed','8KD00995V40435515',NULL,12,'JPY'),(30,'PayPal','2018-12-02 12:53:42','Completed','21F384278K111140U',NULL,13,'EUR'),(31,'PayPal','2018-12-02 13:00:18','Completed','8EW280220P6081117',NULL,17,'JPY'),(32,'PayPal','2018-12-02 13:01:06','In-Progress',NULL,NULL,17,'JPY'),(33,'PayPal','2018-12-02 13:01:09','In-Progress',NULL,NULL,17,'JPY'),(34,'PayPal','2018-12-02 13:03:48','Completed','77X38473PV174071Y',NULL,18,'USD'),(35,'PayPal','2018-12-02 13:14:18','Completed','89F852852N633721V',NULL,19,'USD'),(36,'PayPal','2018-12-02 14:25:15','Completed','6ET732219N314690V',NULL,20,'EUR'),(37,'PayPal','2018-12-04 21:58:43','Completed','95B44463XE9485707',NULL,21,'USD'),(38,'PayPal','2018-12-04 22:19:36','Completed','0C819640DU677261D',NULL,22,'USD'),(39,'PayPal','2018-12-05 11:15:26','Completed','0WN153772W377064E',NULL,23,'USD'),(40,'PayPal','2018-12-07 21:46:19','Completed','0XR79185YK094571E',NULL,24,'JPY'),(41,'PayPal','2018-12-08 09:58:19','In-Progress',NULL,NULL,25,'USD'),(42,'PayPal','2018-12-08 09:58:25','In-Progress',NULL,NULL,25,'USD'),(44,'PayPal','2018-12-08 22:08:56','Completed','93J340668E117532G',3,NULL,'USD'),(45,'PayPal','2018-12-08 22:30:11','In-Progress',NULL,4,NULL,'USD'),(46,'PayPal','2018-12-08 22:30:58','Completed','2FM94685LP8445719',5,NULL,'USD'),(48,'PayPal','2018-12-08 22:58:11','In-Progress',NULL,NULL,26,'USD'),(50,'PayPal','2018-12-08 23:05:38','In-Progress',NULL,13,NULL,'USD'),(51,'PayPal','2018-12-08 23:06:50','In-Progress',NULL,13,NULL,'USD'),(52,'PayPal','2018-12-08 23:08:14','Completed','9A029099M44006431',13,NULL,'USD'),(53,'PayPal','2018-12-08 23:15:40','In-Progress',NULL,NULL,27,'USD'),(54,'PayPal','2018-12-08 23:39:50','Completed','25516308KG987160L',NULL,28,'USD'),(55,'PayPal','2018-12-08 23:47:35','Completed','5RE48501M6333123L',NULL,29,'USD'),(56,'PayPal','2018-12-09 19:32:30','Completed','7X3948871E922691Y',NULL,30,'EUR'),(57,'PayPal','2018-12-09 19:33:50','Completed','08U7362470207892Y',NULL,31,'EUR');
/*!40000 ALTER TABLE `Online_Transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PollChoice`
--

DROP TABLE IF EXISTS `PollChoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `PollChoice` (
  `PollChoiceID` int(11) NOT NULL AUTO_INCREMENT,
  `ChoiceDescription` varchar(100) NOT NULL,
  `ChoiceCount` int(11) NOT NULL,
  `PollID` int(11) NOT NULL,
  PRIMARY KEY (`PollChoiceID`),
  KEY `PollID` (`PollID`),
  CONSTRAINT `PollChoice_ibfk_1` FOREIGN KEY (`PollID`) REFERENCES `Polls` (`pollid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PollChoice`
--

LOCK TABLES `PollChoice` WRITE;
/*!40000 ALTER TABLE `PollChoice` DISABLE KEYS */;
INSERT INTO `PollChoice` VALUES (1,'cereal',3,1),(2,'noodles',2,1),(3,'sandwich',1,1),(4,'cristiano ronaldo',0,2),(5,'sachin tendulkar',0,2),(6,'micheal shumaker',2,2),(7,'mohammad ali',0,2),(8,'tiger woods',0,2);
/*!40000 ALTER TABLE `PollChoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Polls`
--

DROP TABLE IF EXISTS `Polls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `Polls` (
  `PollID` int(11) NOT NULL AUTO_INCREMENT,
  `PollQuestion` varchar(200) NOT NULL,
  `PollCreatedDate` date NOT NULL,
  `PollEndDate` date NOT NULL,
  `PollStatus` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`PollID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Polls`
--

LOCK TABLES `Polls` WRITE;
/*!40000 ALTER TABLE `Polls` DISABLE KEYS */;
INSERT INTO `Polls` VALUES (1,'favourite quick meal','2018-12-01','2018-11-30','Active'),(2,'best sportsperson ever','2018-12-01','2019-01-08','Active');
/*!40000 ALTER TABLE `Polls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Registration`
--

DROP TABLE IF EXISTS `Registration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `Registration` (
  `RegistrationID` int(11) NOT NULL AUTO_INCREMENT,
  `MemberType` enum('Alumni','Staff','Student') NOT NULL,
  `RegistrationStatus` enum('Pending','Approved','Rejected') NOT NULL,
  `RequestDate` datetime NOT NULL,
  `ApproveDenied_Date` datetime DEFAULT NULL,
  `FirstName` varchar(100) NOT NULL,
  `DateofBirth` date NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `JoiningYearMonth` int(11) DEFAULT NULL,
  `EndYearMonth` int(11) DEFAULT NULL,
  `BranchName` varchar(100) DEFAULT NULL,
  `InstitutionMemberID` int(11) DEFAULT NULL,
  `RequestedUserName` varchar(50) NOT NULL,
  `RequestedPassword` varchar(50) NOT NULL,
  `EmailAddress` varchar(100) NOT NULL,
  `RoleType` varchar(50) NOT NULL,
  `AllowNotifications` enum('No','Yes') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`RegistrationID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Registration`
--

LOCK TABLES `Registration` WRITE;
/*!40000 ALTER TABLE `Registration` DISABLE KEYS */;
INSERT INTO `Registration` VALUES (3,'Staff','Rejected','2018-11-25 01:27:41','2018-11-25 20:36:58','Test','2018-01-01','Member2',201801,201802,'Mathematics',123456,'testmember2','aa08769cdcb26674c6706093503ff0a3','testmember2@local.com','Member','No'),(4,'Alumni','Approved','2018-11-25 11:52:37','2018-11-25 20:32:58','Test','2018-11-25','Member3',201810,201811,'Mathematics',123424,'testmember3','ed2b1f468c5f915f3f1cf75d7068baae','testmember3@local.com','Member','No'),(5,'Alumni','Rejected','2018-11-25 12:47:03','2018-11-25 22:42:42','Test','2018-11-01','SuperUser2',201705,201807,'Science',12341234,'testsuperuser2','28a3ef7ab18f2104447cd406a2049270','testsuperuser2@local.com','SuperUser','No'),(6,'Alumni','Approved','2018-11-25 21:36:13','2018-11-25 22:46:24','Test','1990-01-30','SuperUser3',201811,201812,'Science',NULL,'testsuperuser3','ea6d333dc29195fa43c652c16a567922','testsuperuser3@local.com','SuperUser','No'),(7,'Alumni','Approved','2018-11-25 22:39:30','2018-11-25 22:40:13','Ava','2010-10-11','Lewis',201611,201711,'English',123659,'avalewis','d3694aadbe93408019eb07638a63f30d','avalewis@local.com','Member','No'),(8,'Alumni','Rejected','2018-11-25 22:48:52','2018-11-25 22:59:21','test1','2018-11-05','member1',201811,NULL,'History',NULL,'testq682','65ac0eb0b974fa9068f4a586c6b6f07e','testmember1@local.com','Member','No'),(9,'Student','Approved','2018-11-25 23:07:14','2018-11-26 13:38:24','Tom','2006-06-12','Paul',201711,NULL,'Mathematics',123104,'tompaul123','5c87e490c5125ba0ec8cca657f806e6d','tompaul@local.com','Member','No'),(10,'Staff','Pending','2018-11-25 23:09:23',NULL,'reeze','2014-06-07','joy',201808,NULL,'History',NULL,'reezejoy','b0203240cd391618f8cc3c78185e0cfe','reezejoy@local.com','Member','No'),(11,'Alumni','Approved','2018-11-25 23:12:49','2018-11-26 22:31:46','Jerry','1998-10-21','Jacob',NULL,NULL,'History',NULL,'jerryjacob','20d02fedb5a0cf60d2724583f91f033b','jerryjacob@local.com','Member','No'),(12,'Alumni','Rejected','2018-11-25 23:14:17','2018-11-28 22:03:11','qwrrrt','2017-09-19','sfsfd',NULL,NULL,'English',NULL,'qwrrrtsfsfd','265b83d17d8ba0a65ef91a1761026af4','qwrrrtsfsfd@local.com','Member','No'),(13,'Alumni','Approved','2018-11-25 23:16:35','2018-12-08 21:31:46','Sam','2002-11-03','John',NULL,NULL,'chemistry',123123,'samjohn123','cb6f3b8fa1aa7248aee240f594448a39','samjohn@local.com','Member','No'),(14,'Alumni','Rejected','2018-11-25 23:18:55','2018-11-26 14:14:42','ghfd','2018-11-20','hjgt',NULL,NULL,'',NULL,'ghfdhjgt123','14e9b04143e484adcadae2837dfa3822','ghfdhjgt@local.com','Member','No'),(15,'Alumni','Pending','2018-11-26 12:18:40',NULL,'Anju','2000-03-14','Jose',201208,201605,'History ',NULL,'anjujose','b6ae0021d23a113da04061b4caf8cc73','anjujose@local.com','Member','No'),(16,'Alumni','Rejected','2018-11-26 15:31:48','2018-11-28 22:09:26','Ghfj','2000-04-08','Dseg',NULL,NULL,'History ',NULL,'Hgfjkgfde','a21e1096826309658d7ac5ca83cb02a8','ghfh@local.com','Member','No'),(17,'Alumni','Pending','2018-11-28 18:20:21',NULL,'Sachin','1980-12-25','Tendulkar',201811,201812,'',NULL,'sachin200','f951bfabb80ab8336a6af88ef6542647','sachin@local.com','Member','No'),(18,'Alumni','Pending','2018-12-07 21:42:54',NULL,'Sachin','2009-01-01','Sam',201807,NULL,'ComputerScience',NULL,'sachinsam','6264a9a182e8042655308de0d37179ab','sachinsam@local.com','Member','No'),(19,'Alumni','Rejected','2018-12-07 23:32:59','2018-12-08 21:37:34','Arshaana','2000-11-15','Begum',201306,201712,'',NULL,'ArshanaBegum','0135a06202aff4316bf9c0b2ee29fb2b','ArshanaBegum@local.com','Member','No'),(20,'Alumni','Pending','2018-12-09 22:33:07',NULL,'Brian','2009-03-17','Gimenez',NULL,NULL,'Mathematics',200011,'briangimenez','b2957a2fc7ce3b73537f583b8e345f06','briangimenez@local.com','Member','No'),(21,'Alumni','Pending','2018-12-09 22:35:58',NULL,'Asafa','2009-05-19','Powell',201509,NULL,'English',NULL,'asafapowell','d64395a4c5535aa1e9ae248b4663ce1c','asafapowell@local.com','Member','No');
/*!40000 ALTER TABLE `Registration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ReportFilterValue`
--

DROP TABLE IF EXISTS `ReportFilterValue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ReportFilterValue` (
  `FilterID` int(11) NOT NULL,
  `PublishStatus` enum('Inactive','Acitve') NOT NULL,
  `FilterValue` varchar(100) NOT NULL,
  PRIMARY KEY (`FilterID`),
  CONSTRAINT `ReportFilterValue_ibfk_1` FOREIGN KEY (`FilterID`) REFERENCES `ReportFilters` (`filterid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ReportFilterValue`
--

LOCK TABLES `ReportFilterValue` WRITE;
/*!40000 ALTER TABLE `ReportFilterValue` DISABLE KEYS */;
/*!40000 ALTER TABLE `ReportFilterValue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ReportFilters`
--

DROP TABLE IF EXISTS `ReportFilters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ReportFilters` (
  `FilterID` int(11) NOT NULL AUTO_INCREMENT,
  `FilterName` varchar(100) NOT NULL,
  `ReportTypeID` int(11) NOT NULL,
  PRIMARY KEY (`FilterID`),
  KEY `ReportTypeID` (`ReportTypeID`),
  CONSTRAINT `ReportFilters_ibfk_1` FOREIGN KEY (`ReportTypeID`) REFERENCES `ReportTypes` (`reporttypeid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ReportFilters`
--

LOCK TABLES `ReportFilters` WRITE;
/*!40000 ALTER TABLE `ReportFilters` DISABLE KEYS */;
/*!40000 ALTER TABLE `ReportFilters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ReportTypes`
--

DROP TABLE IF EXISTS `ReportTypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ReportTypes` (
  `ReportTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `ReportName` varchar(50) NOT NULL,
  `ReportDescription` varchar(200) NOT NULL,
  `ReportStatus` enum('Inactive','Active') NOT NULL,
  PRIMARY KEY (`ReportTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ReportTypes`
--

LOCK TABLES `ReportTypes` WRITE;
/*!40000 ALTER TABLE `ReportTypes` DISABLE KEYS */;
/*!40000 ALTER TABLE `ReportTypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `User` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) NOT NULL,
  `UserPassword` varchar(32) NOT NULL,
  `LastLoginDate` datetime DEFAULT NULL,
  `UserStatus` enum('Active','In-Active') NOT NULL,
  `EmailAddress` varchar(100) NOT NULL,
  `AllowNotifications` enum('No','Yes') NOT NULL,
  `LastParticipatedPollID` int(11) DEFAULT NULL,
  `GroupID` int(11) NOT NULL,
  `RegistrationID` int(11) DEFAULT NULL,
  `ForgotPasswordCode` varchar(45) DEFAULT NULL,
  `ForgotPasswordLimitDate` datetime DEFAULT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `EmailAddress_UNIQUE` (`EmailAddress`),
  UNIQUE KEY `UserName_UNIQUE` (`UserName`),
  KEY `GroupID` (`GroupID`),
  KEY `LastParticipatedPollID` (`LastParticipatedPollID`),
  KEY `RegistrationID` (`RegistrationID`),
  CONSTRAINT `User_ibfk_1` FOREIGN KEY (`GroupID`) REFERENCES `UserGroup` (`groupid`),
  CONSTRAINT `User_ibfk_2` FOREIGN KEY (`LastParticipatedPollID`) REFERENCES `Polls` (`pollid`),
  CONSTRAINT `User_ibfk_3` FOREIGN KEY (`RegistrationID`) REFERENCES `Registration` (`registrationid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'testmember','a510166163833c79aa703646f59c04bb','2018-11-23 22:19:52','Active','testmember@local.com','Yes',2,1,NULL,'e93ac151c00d7c1bdfcf42c0a3c82541','2018-12-10 22:42:12'),(2,'testadmin','21232f297a57a5a743894a0e4a801fc3','2018-11-23 22:55:18','Active','testadmin@local.com','Yes',2,2,NULL,NULL,NULL),(3,'testsuperuser','0baea2f0ae20150db78f58cddac442a9','2018-11-23 23:01:19','Active','testsuperuser@local.com','Yes',NULL,3,NULL,NULL,NULL),(4,'testmember2','aa08769cdcb26674c6706093503ff0a3',NULL,'Active','testmember2@local.com','No',NULL,1,3,NULL,NULL),(7,'testmember3','ed2b1f468c5f915f3f1cf75d7068baae',NULL,'Active','testmember3@local.com','No',NULL,1,4,NULL,NULL),(8,'testsuperuser2','28a3ef7ab18f2104447cd406a2049270',NULL,'Active','testsuperuser2@local.com','No',NULL,3,5,NULL,NULL),(9,'avalewis','d3694aadbe93408019eb07638a63f30d',NULL,'Active','avalewis@local.com','No',NULL,1,7,NULL,NULL),(10,'testsuperuser3','ea6d333dc29195fa43c652c16a567922',NULL,'Active','testsuperuser3@local.com','No',NULL,3,6,NULL,NULL),(11,'tompaul123','5c87e490c5125ba0ec8cca657f806e6d',NULL,'Active','tompaul@local.com','No',NULL,1,9,NULL,NULL),(12,'jerryjacob','482c811da5d5b4bc6d497ffa98491e38',NULL,'Active','jerryjacob@local.com','No',NULL,1,11,NULL,NULL),(13,'samjohn123','cb6f3b8fa1aa7248aee240f594448a39',NULL,'Active','samjohn@local.com','No',NULL,1,13,NULL,NULL);
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UserContent`
--

DROP TABLE IF EXISTS `UserContent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `UserContent` (
  `UserContentID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `ContentType` varchar(100) NOT NULL,
  `ContentPath` varchar(100) NOT NULL,
  `UploadedDate` datetime NOT NULL,
  `ShareFlag` enum('Private','Public') NOT NULL,
  `ThumbNailPath` varchar(100) DEFAULT NULL,
  `ContentDescription` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`UserContentID`),
  KEY `UserID` (`UserID`),
  CONSTRAINT `UserContent_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `User` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UserContent`
--

LOCK TABLES `UserContent` WRITE;
/*!40000 ALTER TABLE `UserContent` DISABLE KEYS */;
INSERT INTO `UserContent` VALUES (2,2,'Image','usercontent/images/2/5c0da5233cf079.65299131.png','2018-12-09 18:28:35','Public','','FirstCar'),(4,2,'Image','usercontent/images/2/5c0da53bdd7033.40429571.jpg','2018-12-09 18:28:59','Private','','Third  Car'),(5,2,'Image','usercontent/images/2/5c0da59a31fc13.71382524.jpg','2018-12-09 18:30:34','Private','','2 Again'),(6,1,'Image','usercontent/images/1/5c0da98d9a4095.36672406.jpeg','2018-12-09 18:47:25','Public','','Chris Gayle'),(7,3,'Image','usercontent/images/3/5c0db07530f007.97220554.jpg','2018-12-09 19:16:53','Public','','Memories of Campus'),(8,3,'Image','usercontent/images/3/5c0db09a8a6098.62713620.jpg','2018-12-09 19:17:30','Private','','Koala');
/*!40000 ALTER TABLE `UserContent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UserGroup`
--

DROP TABLE IF EXISTS `UserGroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `UserGroup` (
  `GroupID` int(11) NOT NULL AUTO_INCREMENT,
  `GroupName` varchar(100) NOT NULL,
  PRIMARY KEY (`GroupID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UserGroup`
--

LOCK TABLES `UserGroup` WRITE;
/*!40000 ALTER TABLE `UserGroup` DISABLE KEYS */;
INSERT INTO `UserGroup` VALUES (1,'Member'),(2,'Admin'),(3,'SuperUser');
/*!40000 ALTER TABLE `UserGroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UserProfile`
--

DROP TABLE IF EXISTS `UserProfile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `UserProfile` (
  `UserID` int(11) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `InstitutionID` int(11) NOT NULL,
  `StreetName` varchar(100) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `State` varchar(100) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `ZipCode` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`UserID`),
  CONSTRAINT `UserProfile_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `User` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UserProfile`
--

LOCK TABLES `UserProfile` WRITE;
/*!40000 ALTER TABLE `UserProfile` DISABLE KEYS */;
INSERT INTO `UserProfile` VALUES (1,'Test','Member',-1,'Test','NYC','NY','USA','10000'),(2,'Test','Admin',999111,NULL,NULL,NULL,NULL,NULL),(3,'Test','SuperUser',999000,'',NULL,NULL,NULL,NULL),(7,'Test','Member3',123456,NULL,NULL,NULL,NULL,NULL),(8,'Test','SuperUser2',1234123,NULL,NULL,NULL,NULL,NULL),(9,'Ava','Lewis',123659,NULL,NULL,NULL,NULL,NULL),(10,'Test','SuperUser3',123424,NULL,NULL,NULL,NULL,NULL),(11,'Tom','Paul',123104,NULL,NULL,NULL,NULL,NULL),(12,'Jerry','Jacob',123122,NULL,NULL,NULL,NULL,NULL),(13,'Sam','John',123123,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `UserProfile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dbhitlog`
--

DROP TABLE IF EXISTS `dbhitlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `dbhitlog` (
  `hittime` datetime NOT NULL,
  PRIMARY KEY (`hittime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dbhitlog`
--

LOCK TABLES `dbhitlog` WRITE;
/*!40000 ALTER TABLE `dbhitlog` DISABLE KEYS */;
INSERT INTO `dbhitlog` VALUES ('2018-11-25 11:01:14'),('2018-11-25 11:02:45'),('2018-11-25 11:08:55'),('2018-11-25 11:14:47'),('2018-11-25 11:20:18'),('2018-11-25 11:21:53'),('2018-11-25 11:23:39'),('2018-11-25 11:25:59'),('2018-11-25 11:28:31'),('2018-11-25 11:51:50'),('2018-11-25 11:52:37');
/*!40000 ALTER TABLE `dbhitlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'birdsoffeathers'
--
/*!50003 DROP PROCEDURE IF EXISTS `sp_add_donation` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_add_donation`(
p_userid int,
p_amount int,
p_currency varchar(10)
)
BEGIN
		
        INSERT INTO `birdsoffeathers`.`Donation`(`Amount`,`DonationStatus`,`UserID`,`Currency`)
		SELECT p_amount,'In-Progress',p_userid,p_currency;
	
		SELECT LAST_INSERT_ID() as DonationID;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_add_online_transaction` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_add_online_transaction`(
p_userid int,
p_donationid int,
p_eventregistrationid int
)
BEGIN
		DECLARE SystemError CONDITION FOR SQLSTATE '45010';
        DECLARE v_amount decimal(19,2);
        DECLARE v_currency varchar(10);
        DECLARE v_onlinetransid int;
		if(p_donationid is not null)
        then
			select Amount,Currency
            into v_amount,v_currency
            from Donation
            where DonationID = p_donationid;
        elseif(p_eventregistrationid is not null)
        then
			select Events.EventFee,'USD'
            into v_amount,v_currency
            from EventRegistration 
            inner join Events on EventRegistration.EventID = Events.EventID
            where EventRegistration.Event_RegistrationID = p_eventregistrationid;
        else
		  SIGNAL SQLSTATE '45010'
		  SET MESSAGE_TEXT = 'Mandatory parameters missing';
        end if;
        
        INSERT INTO `birdsoffeathers`.`Online_Transactions`(`PaymentType`,`TransactionDateTime`,`TransactionStatus`,`PaymentSystem_TransID`,`Event_RegistrationID`,`DonationID`,`Currency`)
		SELECT 'PayPal',now(),'In-Progress',NULL,p_eventregistrationid,p_donationid,v_currency;
	
		SELECT LAST_INSERT_ID() into v_onlinetransid;
        
        SELECT  v_onlinetransid,v_amount,v_currency;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_add_poll` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_add_poll`(
p_pquestion varchar(100),
p_penddate datetime,
p_active varchar(20)
)
BEGIN

		INSERT INTO `birdsoffeathers`.`Polls`(`PollQuestion`,`PollCreatedDate`,`PollEndDate`,`PollStatus`)
		SELECT p_pquestion,now(),p_penddate,p_active;
        
		SELECT LAST_INSERT_ID() as pollid;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_add_pollchoice` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_add_pollchoice`(
p_pollid int,
p_choicedesc varchar(100)
)
BEGIN
	
    INSERT INTO `birdsoffeathers`.`PollChoice`(`ChoiceDescription`,`ChoiceCount`,`PollID`)
	SELECT p_choicedesc,0,p_pollid;
        
	SELECT LAST_INSERT_ID() as pollchoiceid;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_add_registrationrequest` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_add_registrationrequest`(
p_membertype varchar(50) , 
p_roletype varchar(50) ,
p_fname varchar(100) ,
p_lname varchar(100) ,
p_dateofbirth datetime ,
p_emailaddress varchar(100) ,
p_institution_id int ,
p_branchname varchar(100),
p_startmonth int ,
p_endmonth int ,
p_requsername varchar(50),
p_reqpassword varchar(50)
)
BEGIN
	
	DECLARE UserNameExists CONDITION FOR SQLSTATE '45000';
    DECLARE UserEmailID CONDITION FOR SQLSTATE '45002';    
    DECLARE RegisteredEmailID CONDITION FOR SQLSTATE '45003';
	if not exists(select 1 dummy from `birdsoffeathers`.`User`
	where UserName = p_requsername
    union all select 1 dummy from `birdsoffeathers`.`Registration`
    where RequestedUserName = p_requsername)
	then
    
		if not exists(select 1 dummy from `birdsoffeathers`.`User`
		where EmailAddress = p_emailaddress
		)
        then
			if not exists(select 1 dummy from `birdsoffeathers`.`Registration`
			where EmailAddress = p_emailaddress
			)
            then
            
				INSERT INTO `birdsoffeathers`.`Registration`
				(`MemberType`,`RegistrationStatus`,`RequestDate`,`ApproveDenied_Date`,`FirstName`,`DateofBirth`,`LastName`,`JoiningYearMonth`,
                `EndYearMonth`,`BranchName`,`InstitutionMemberID`,`RequestedUserName`,`RequestedPassword`,`EmailAddress`,`RoleType`)
				SELECT p_membertype,'Pending',now(),NULL,p_fname,p_dateofbirth,p_lname,p_startmonth,p_endmonth,p_branchname,p_institution_id,
                p_requsername,p_reqpassword,p_emailaddress,p_roletype;
                
                SELECT LAST_INSERT_ID();
			else
				SIGNAL SQLSTATE '45003'
				  SET MESSAGE_TEXT = 'This Email ID is pending registration.Please wait for the email.';
            end if;
        else
			SIGNAL SQLSTATE '45002'
			  SET MESSAGE_TEXT = 'This Email ID is already registered.Please proceed to login.';
        end if;
	else
		SIGNAL SQLSTATE '45000'
		  SET MESSAGE_TEXT = 'This username is already use. Please try another';
	end if; 

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_email_check` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_email_check`(p_emailaddress varchar(100))
BEGIN

DECLARE EmailNotFound CONDITION FOR SQLSTATE '45030';

if exists(select 1  from `birdsoffeathers`.`User`
where EmailAddress = p_emailaddress)
then
update `birdsoffeathers`.`User`
set ForgotPasswordCode = md5(rand()),
ForgotPasswordLimitDate = DATE_ADD(now(), INTERVAL 3 DAY)
where EmailAddress = p_emailaddress;

select User.UserID , User.ForgotPasswordCode,User.ForgotPasswordLimitDate,IFNULL(UserProfile.FirstName,'User') NameofUser
from `birdsoffeathers`.`User`
left join `birdsoffeathers`.`UserProfile` on User.UserID = UserProfile.UserID
where EmailAddress = p_emailaddress;

else
	SIGNAL SQLSTATE '45030'
		  SET MESSAGE_TEXT = 'Your Email is not Registered in the System';

end if; 

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_event_register` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_event_register`(
p_userid int,
p_eventid int,
p_remindmeflag varchar(3)
)
BEGIN
	DECLARE EventSlotFull CONDITION FOR SQLSTATE '45025';
    DECLARE EventAlreadyRegistered CONDITION FOR SQLSTATE '45026';
    DECLARE v_eventfee decimal(19,2);
    DECLARE v_eventregistrationstatus varchar(10);
    DECLARE v_available_seats int;
    DECLARE v_used_seats int;
    DECLARE v_eventregistrationid int;
    
    set v_eventregistrationid = -1;
    select EventFee,AvailableSeats into v_eventfee ,v_available_seats
    from Events where EventID = p_eventid;
    
    if( v_eventfee = 0)
    then
     set v_eventregistrationstatus = 'Confirmed';
     else
     set v_eventregistrationstatus = 'Pending';
     end if;
    
    select count(*) into v_used_seats
    from `birdsoffeathers`.`EventRegistration`
    where EventID  = p_eventid and Event_RegistrationStatus = 'Confirmed';
    
    if (v_used_seats < v_available_seats)
    then	
		if exists( select  1 from  `birdsoffeathers`.`EventRegistration` where  EventID = p_eventid and UserID = p_userid)
        then
			SIGNAL SQLSTATE '45026'
			  SET MESSAGE_TEXT = 'User has already registered for this event.';
        else
			INSERT INTO `birdsoffeathers`.`EventRegistration`(`Event_RegistrationTime`,`Event_RegistrationStatus`,`RemindMeFlag`,`UserID`,`EventID`)
			SELECT now(),v_eventregistrationstatus,p_remindmeflag, p_userid,p_eventid;
            SELECT LAST_INSERT_ID() into v_eventregistrationid;
		end if;
	else
    SIGNAL SQLSTATE '45025'
			  SET MESSAGE_TEXT = 'Event Slots are full';
    end if;

	select v_eventregistrationid,v_eventregistrationstatus;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_get_institutionrecords` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_institutionrecords`()
BEGIN

SELECT `InstitutionRecords`.`InstitutionMemberID`,
    `InstitutionRecords`.`MemberType`,
    `InstitutionRecords`.`DateofBirth`,
    `InstitutionRecords`.`FirstName`,
    `InstitutionRecords`.`LastName`,
    `InstitutionRecords`.`EndYearMonth`,
    `InstitutionRecords`.`BranchName`,
    `InstitutionRecords`.`JoiningYearMonth`
FROM `birdsoffeathers`.`InstitutionRecords`;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_get_latest_poll` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_latest_poll`(
p_userid int
)
BEGIN
	
		DECLARE v_pollid int;
		SELECT max(PollID) into v_pollid from `birdsoffeathers`.`Polls` where PollStatus ='Active';
        
		SELECT `Polls`.`PollID`,
		`Polls`.`PollQuestion`,
		`Polls`.`PollCreatedDate`,
		`Polls`.`PollEndDate`,
		`Polls`.`PollStatus`,
        PollChoice.PollChoiceID,
        PollChoice.ChoiceDescription,
        case when User.UserID is null then 'Open' else 'Closed' end as Participation
		FROM `birdsoffeathers`.`Polls`
		inner join `birdsoffeathers`.`PollChoice` on Polls.PollID = PollChoice.PollID
        left join birdsoffeathers.User on User.LastParticipatedPollID >= Polls.PollID and User.UserID = p_userid
		where Polls.PollID = v_pollid
        and Polls.PollEndDate > NOW() - INTERVAL 1 DAY;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_get_pendingregistrations` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_pendingregistrations`()
BEGIN

	SELECT `Registration`.`RegistrationID`,
    `Registration`.`MemberType`,
    `Registration`.`RequestDate`,
    `Registration`.`FirstName`,
    `Registration`.`LastName`,
    `Registration`.`DateofBirth`,
    `Registration`.`JoiningYearMonth`,
    `Registration`.`EndYearMonth`,
    `Registration`.`BranchName`,
    `Registration`.`InstitutionMemberID`,
    `Registration`.`RoleType`
FROM `birdsoffeathers`.`Registration`
where RegistrationStatus = 'Pending';

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_login_check` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_login_check`(p_username varchar(50),p_userpassword varchar(100))
BEGIN

SELECT U.UserID,U.GroupID,UG.GroupName from `birdsoffeathers`.`User` as U
inner join `birdsoffeathers`.`UserGroup` as UG on U.GroupID = UG.GroupID
where UserName = p_username 
and UserPassword =p_userpassword
and UserStatus = 'Active';

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_pollparticipation` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_pollparticipation`(
p_userid int,
p_pollid int,
p_pollchoiceid int
)
BEGIN

	DECLARE AlreadyParticipated CONDITION FOR SQLSTATE '45015';
    if exists(select * from birdsoffeathers.User where ifnull(LastParticipatedPollID,0) < p_pollid and  UserID = p_userid)
    then		
		update birdsoffeathers.User
		set LastParticipatedPollID = p_pollid
		where UserID = p_userid;
    
		update birdsoffeathers.PollChoice
        set ChoiceCount = ChoiceCount +1
        where PollChoiceID = p_pollchoiceid;
    else    
		SIGNAL SQLSTATE '45002'
			  SET MESSAGE_TEXT = 'This User has already participated in this Poll.';
	end if;
        
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_reset_password` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_reset_password`(p_fp_code varchar(50) , p_newpassword varchar(50))
BEGIN
	DECLARE v_userid int;

	DECLARE InvalidLink CONDITION FOR SQLSTATE '45000';
	if exists(select 1  from `birdsoffeathers`.`User`
	where ForgotPasswordCode = p_fp_code and ForgotPasswordLimitDate > now())
	then
		select UserID into v_userid
		from `birdsoffeathers`.`User`
		where ForgotPasswordCode = p_fp_code
		and ForgotPasswordLimitDate > now();
		
		update `birdsoffeathers`.`User`
		set ForgotPasswordCode = NULL,
		ForgotPasswordLimitDate = NULL,
		UserPassword = p_newpassword
		where UserID = v_userid;

		SELECT v_userid as UserID;
	else
		SIGNAL SQLSTATE '45000'
		  SET MESSAGE_TEXT = 'Reset link is not valid.';
	end if; 

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_update_online_transaction` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update_online_transaction`(
p_userid int,
p_onlinetransactionid int,
p_pstransactionid varchar(100)
)
BEGIN
	DECLARE TransactionReAttempt CONDITION FOR SQLSTATE '45020';
	DECLARE v_donationid int;
    DECLARE v_eventregistrationid int;
    DECLARE v_transactionstatus varchar(20);
    
    select DonationID,Event_RegistrationID,TransactionStatus into v_donationid,v_eventregistrationid ,v_transactionstatus
    from Online_Transactions where TransactionID = p_onlinetransactionid;
    
    if (v_transactionstatus = 'In-Progress')
    then
		update Online_Transactions
        set TransactionStatus = 'Completed',
        TransactionDateTime = now(),
        PaymentSystem_TransID  = p_pstransactionid
        where TransactionID = p_onlinetransactionid;
        
		if(v_donationid is not null)
		then 
			update Donation
            set DonationStatus = 'Completed'
            where DonationID = v_donationid;
		end if;
        
        if(v_eventregistrationid is not null)
        then
			update EventRegistration
            set Event_RegistrationStatus = 'Confirmed'
            where Event_RegistrationID = v_eventregistrationid;
        end if;
    else
		SIGNAL SQLSTATE '45020'
			  SET MESSAGE_TEXT = 'Transaction no longer valid for attempt. Please initiate a new transaction.';
	end if;
		
    

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_update_registrationrequest` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_update_registrationrequest`(p_decision varchar(50), p_registration_id int , p_institutionid int)
BEGIN
	DECLARE MissingInstitutionRecord CONDITION FOR SQLSTATE '45005';
    DECLARE UsedInstitutionID CONDITION FOR SQLSTATE '45006';  
    DECLARE InvalidDecision CONDITION FOR SQLSTATE '45007';
	DECLARE v_userid int;
    DECLARE v_fname varchar(50);
    DECLARE v_emailaddress varchar(50);
 
	SELECT FirstName,EmailAddress
			into v_fname,v_emailaddress
			FROM birdsoffeathers.Registration
				where RegistrationID = p_registration_id;
	if(p_decision = 'Approve')
    then
    
		if(select 1 from  birdsoffeathers.InstitutionRecords where InstitutionMemberID = p_institutionid)
        then
			
			if(select 1 from  birdsoffeathers.UserProfile where InstitutionID = p_institutionid )
			then
					SIGNAL SQLSTATE '45006'
				  SET MESSAGE_TEXT = 'InstitutionID is already in Use';
            else
                
				insert into `birdsoffeathers`.`User`
				(`UserName`,`UserPassword`,`LastLoginDate`,`UserStatus`,`EmailAddress`,`AllowNotifications`,`LastParticipatedPollID`,`GroupID`,`RegistrationID`,
				`ForgotPasswordCode`,`ForgotPasswordLimitDate`)
				select RequestedUserName,RequestedPassword,NULL,'Active',EmailAddress,AllowNotifications,NULL,UG.GroupID,RegistrationID,NULL,NULL  
				from birdsoffeathers.Registration R
				inner join UserGroup UG on GroupName = RoleType
				where RegistrationID = p_registration_id;
                
                set v_userid = LAST_INSERT_ID();
                
                INSERT INTO `birdsoffeathers`.`UserProfile`(`UserID`,`FirstName`,`LastName`,`InstitutionID`)
				select  v_userid,FirstName,LastName,p_institutionid
                from birdsoffeathers.Registration R
				inner join UserGroup UG on GroupName = RoleType
				where RegistrationID = p_registration_id;
                
				update birdsoffeathers.Registration
				set RegistrationStatus = 'Approved',
				ApproveDenied_Date  = now()
				where RegistrationID = p_registration_id;
                                               
                select v_fname ,v_emailaddress;
                
			end if;
		else
			SIGNAL SQLSTATE '45005'
			  SET MESSAGE_TEXT = 'InstitutionID is invalid';
        end if;
			
       
    elseif (p_decision ='Reject')
	then
		 update birdsoffeathers.Registration
			set RegistrationStatus = 'Rejected',
			ApproveDenied_Date  = now()
			where RegistrationID = p_registration_id;
            
            select v_fname ,v_emailaddress;
	else
		SIGNAL SQLSTATE '45007'
			  SET MESSAGE_TEXT = 'Invalid Decision';
			
	end if;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-10  8:15:34

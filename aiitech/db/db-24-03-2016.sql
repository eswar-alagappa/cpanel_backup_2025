-- MySQL dump 10.16  Distrib 10.1.10-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: aitech
-- ------------------------------------------------------
-- Server version	10.1.10-MariaDB

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
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` text,
  `fees` float(15,2) DEFAULT '0.00',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(15) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
INSERT INTO `course` VALUES (12,'BSC IT',0.00,'2016-03-24 09:21:45','2016-03-24 09:21:45','admin',1),(13,'BCA',0.00,'2016-03-24 09:21:58','2016-03-24 09:21:58','admin',1),(14,'MBA',0.00,'2016-03-24 12:10:03','2016-03-24 12:10:03','superadmin',1),(15,'MCA',0.00,'2016-03-24 12:10:12','2016-03-24 12:10:12','superadmin',1);
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fee_details`
--

DROP TABLE IF EXISTS `fee_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fee_details` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `course_id` bigint(20) DEFAULT '0',
  `semester_id` bigint(20) DEFAULT '0',
  `fee_type_id` bigint(20) DEFAULT '0',
  `fees` float(15,2) DEFAULT '0.00',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fee_details`
--

LOCK TABLES `fee_details` WRITE;
/*!40000 ALTER TABLE `fee_details` DISABLE KEYS */;
INSERT INTO `fee_details` VALUES (2,13,6,3,500.00,'2016-03-24 12:39:04','2016-03-24 12:39:04','superadmin'),(3,13,6,5,200.00,'2016-03-24 12:39:16','2016-03-24 12:39:16','superadmin'),(4,13,6,6,1500.00,'2016-03-24 12:40:29','2016-03-24 12:40:29','superadmin');
/*!40000 ALTER TABLE `fee_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fee_type`
--

DROP TABLE IF EXISTS `fee_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fee_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(15) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fee_type`
--

LOCK TABLES `fee_type` WRITE;
/*!40000 ALTER TABLE `fee_type` DISABLE KEYS */;
INSERT INTO `fee_type` VALUES (3,'Exam fee','2016-03-23 13:38:10','2016-03-23 13:38:10','superadmin',1),(4,'Semester fee','2016-03-23 13:38:23','2016-03-24 12:39:42','superadmin',1),(5,'late fee','2016-03-24 09:19:47','2016-03-24 09:19:47','admin',1),(6,'Books fee','2016-03-24 12:40:02','2016-03-24 12:40:02','superadmin',1);
/*!40000 ALTER TABLE `fee_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gallery` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` text,
  `image_url` varchar(15) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery`
--

LOCK TABLES `gallery` WRITE;
/*!40000 ALTER TABLE `gallery` DISABLE KEYS */;
INSERT INTO `gallery` VALUES (5,'wow great','gallery5.jpg','2016-03-24 08:42:40','2016-03-24 08:44:00','admin'),(6,'wonderfull','gallery6.jpg','2016-03-24 08:44:49','2016-03-24 08:45:06','admin');
/*!40000 ALTER TABLE `gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `latest_news`
--

DROP TABLE IF EXISTS `latest_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `latest_news` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `latest_news`
--

LOCK TABLES `latest_news` WRITE;
/*!40000 ALTER TABLE `latest_news` DISABLE KEYS */;
INSERT INTO `latest_news` VALUES (4,'yesmasterthankyoumaster','2016-03-24 08:01:16','2016-03-24 08:01:48','admin'),(5,'salutaiontothesupermebeing','2016-03-24 08:02:08','2016-03-24 08:02:08','admin');
/*!40000 ALTER TABLE `latest_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `student_id` bigint(20) DEFAULT NULL,
  `fee_type_id` bigint(20) DEFAULT '0',
  `course_id` bigint(20) DEFAULT '0',
  `semester_id` bigint(20) DEFAULT '0',
  `received_amount` float(15,2) DEFAULT '0.00',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (2,'2016-03-11 00:00:00',9,3,13,6,1000.00,'2016-03-24 11:17:55','2016-03-24 11:53:29','superadmin'),(3,'2016-03-24 00:00:00',8,3,12,7,2000.00,'2016-03-24 11:53:42','2016-03-24 11:53:53','superadmin');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `semester`
--

DROP TABLE IF EXISTS `semester`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `semester` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` text,
  `fees` float(15,2) DEFAULT '0.00',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(15) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `semester`
--

LOCK TABLES `semester` WRITE;
/*!40000 ALTER TABLE `semester` DISABLE KEYS */;
INSERT INTO `semester` VALUES (6,'SEMESTER 1',0.00,'2016-03-24 09:22:42','2016-03-24 09:22:42','admin',1),(7,'SEMESTER 2',0.00,'2016-03-24 09:22:49','2016-03-24 09:22:49','admin',1),(8,'SEMESTER 3',0.00,'2016-03-24 12:09:21','2016-03-24 12:09:21','superadmin',1),(9,'SEMESTER 4',0.00,'2016-03-24 12:09:27','2016-03-24 12:09:27','superadmin',1),(10,'SEMESTER 5',0.00,'2016-03-24 12:09:34','2016-03-24 12:09:34','superadmin',1),(11,'SEMESTER 6',0.00,'2016-03-24 12:09:42','2016-03-24 12:09:42','superadmin',1);
/*!40000 ALTER TABLE `semester` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `key_name` varchar(125) DEFAULT '',
  `key_value` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES ('PDF_COURSE_OFFERED','PDF_COURSE_OFFERED.pdf',NULL,NULL,'admin'),('PDF_REGULATION','PDF_REGULATION.pdf',NULL,NULL,'admin'),('PDF_SEMESTER_PROGRAMES','PDF_SEMESTER_PROGRAMES.pdf',NULL,NULL,'admin'),('PDF_NON_SEMESTER_PROGRAMES','PDF_NON_SEMESTER_PROGRAMES.pdf',NULL,NULL,'admin'),('PDF_ELIGIBLITY','PDF_ELIGIBLITY.pdf',NULL,NULL,'admin'),('PDF_APPLICATION','PDF_APPLICATION.pdf',NULL,NULL,'admin'),('PDF_DIRECTORATE_OF_DISTANCE_EDUCATION','PDF_DIRECTORATE_OF_DISTANCE_EDUCATION.pdf',NULL,NULL,'admin'),('PDF_MBA__NON_SEMESTER_APPLICATION','PDF_MBA__NON_SEMESTER_APPLICATION.pdf',NULL,NULL,'admin'),('PDF_ALAGAPPA_CLASS_SCHEDULE','PDF_ALAGAPPA_CLASS_SCHEDULE.pdf',NULL,NULL,'admin'),('PDF_PONDICHERRY_SCHEDULE','PDF_PONDICHERRY_SCHEDULE.pdf',NULL,NULL,'admin'),('PDF_SYLLABUS','PDF_SYLLABUS.pdf',NULL,NULL,'admin'),('PDF_ADD_ANOTHER_FOR_DUMMY_FOR_EXTRA_PURPOSE','PDF_ADD_ANOTHER_FOR_DUMMY_FOR_EXTRA_PURPOSE.pdf',NULL,NULL,'admin');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slider`
--

DROP TABLE IF EXISTS `slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slider` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` text,
  `description` text,
  `image_url` varchar(15) DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slider`
--

LOCK TABLES `slider` WRITE;
/*!40000 ALTER TABLE `slider` DISABLE KEYS */;
INSERT INTO `slider` VALUES (4,'slider a','description a','slider4.jpg','2016-03-24 10:02:10','2016-03-24 10:02:10','admin');
/*!40000 ALTER TABLE `slider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subject` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` text,
  `course_id` bigint(20) DEFAULT '0',
  `semester_id` bigint(20) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(15) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `code` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject`
--

LOCK TABLES `subject` WRITE;
/*!40000 ALTER TABLE `subject` DISABLE KEYS */;
INSERT INTO `subject` VALUES (3,'S',11,4,'2016-03-23 10:19:01','2016-03-23 10:19:01','superadmin',1,'SSSSSSSSSS');
/*!40000 ALTER TABLE `subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) DEFAULT '',
  `password` varchar(60) DEFAULT '',
  `role` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `updated_by` varchar(15) DEFAULT NULL,
  `first_name` varchar(60) DEFAULT '',
  `last_name` varchar(60) DEFAULT '',
  `date_of_birth` datetime DEFAULT NULL,
  `phone` varchar(15) DEFAULT '',
  `address` text,
  `email_id` varchar(125) DEFAULT '',
  `qualification` varchar(25) DEFAULT '',
  `designation` varchar(60) DEFAULT NULL,
  `date_of_joining` datetime DEFAULT NULL,
  `employeed_experience` float(5,2) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `martial_status` varchar(10) DEFAULT NULL,
  `roll_num` varchar(15) DEFAULT '',
  `course_id` bigint(20) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','0192023a7bbd73250516f069df18b500',1,NULL,NULL,1,NULL,'','',NULL,'',NULL,'','',NULL,NULL,NULL,NULL,NULL,'',0),(8,'','',3,'2016-03-23 13:06:59','2016-03-23 13:06:59',1,'superadmin','A','B',NULL,'',NULL,'','',NULL,NULL,NULL,NULL,NULL,'0001',10),(9,'','',3,'2016-03-23 13:07:12','2016-03-23 13:07:12',1,'superadmin','AAAAA','BBBBBB',NULL,'',NULL,'','',NULL,NULL,NULL,NULL,NULL,'0002',11),(10,'','',2,'2016-03-24 12:50:50','2016-03-24 12:50:50',1,'superadmin','saasd','dasd',NULL,'sasd',NULL,'sdds','',NULL,NULL,NULL,'single',NULL,'',0),(11,'','',2,'2016-03-24 12:51:20','2016-03-24 12:51:20',1,'superadmin','ddsa','dassd',NULL,'sadsad',NULL,'sadasds','',NULL,NULL,NULL,'single',NULL,'',0),(12,'','',2,'2016-03-24 13:16:47','2016-03-24 13:16:47',1,'admin','dsfdsfsd','sdfdfs',NULL,'32132132',NULL,'dsfsd@aassd.com','',NULL,NULL,NULL,'single',NULL,'',0);
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

-- Dump completed on 2016-03-24 18:02:39

-- MySQL dump 10.13  Distrib 8.0.33, for Linux (x86_64)
--
-- Host: localhost    Database: NEETASTUDIO
-- ------------------------------------------------------
-- Server version	8.0.33

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
-- Current Database: `NEETASTUDIO`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `NEETASTUDIO` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `NEETASTUDIO`;

--
-- Table structure for table `CUSTOMER_BOOKINGS`
--

DROP TABLE IF EXISTS `CUSTOMER_BOOKINGS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `CUSTOMER_BOOKINGS` (
  `ID` mediumint NOT NULL AUTO_INCREMENT,
  `NAME` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `EMAIL` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PHONE` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SESSION_TYPE` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PACKAGE_TYPE` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SESSION_DATE` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SESSION_TIME` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MESSAGE` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ADD_TS` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CUSTOMER_BOOKINGS`
--

LOCK TABLES `CUSTOMER_BOOKINGS` WRITE;
/*!40000 ALTER TABLE `CUSTOMER_BOOKINGS` DISABLE KEYS */;
INSERT INTO `CUSTOMER_BOOKINGS` VALUES (1,'Deepika D.','deepikadhaker@gmail.com','+91 9820937445','maternity','basic','2025-07-23','2:00 PM - 5:00 PM','I am looking for maternity photoshoot','2025-11-05 17:50:14');
/*!40000 ALTER TABLE `CUSTOMER_BOOKINGS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CUSTOMER_ENQUIRIES`
--

DROP TABLE IF EXISTS `CUSTOMER_ENQUIRIES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `CUSTOMER_ENQUIRIES` (
  `ID` mediumint NOT NULL AUTO_INCREMENT,
  `NAME` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `EMAIL` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PHONE` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ENQUIRY_FOR` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MESSAGE` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ADD_TS` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CUSTOMER_ENQUIRIES`
--

LOCK TABLES `CUSTOMER_ENQUIRIES` WRITE;
/*!40000 ALTER TABLE `CUSTOMER_ENQUIRIES` DISABLE KEYS */;
INSERT INTO `CUSTOMER_ENQUIRIES` VALUES (1,'Deepika D.','deepikadhaker@gmail.com','+91 9820937445','maternity','I am looking for maternity photoshoot','2025-11-05 17:48:56'),(2,'Swati R.','swatir@gmail.com','+91 9820937448','kids','I am looking for kid photography','2025-11-05 17:48:56');
/*!40000 ALTER TABLE `CUSTOMER_ENQUIRIES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CUSTOMER_SUBSCRIPTIONS`
--

DROP TABLE IF EXISTS `CUSTOMER_SUBSCRIPTIONS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `CUSTOMER_SUBSCRIPTIONS` (
  `ID` mediumint NOT NULL AUTO_INCREMENT,
  `NAME` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `EMAIL` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PHONE` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `INTERSET_TYPE` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MESSAGE` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ADD_TS` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CUSTOMER_SUBSCRIPTIONS`
--

LOCK TABLES `CUSTOMER_SUBSCRIPTIONS` WRITE;
/*!40000 ALTER TABLE `CUSTOMER_SUBSCRIPTIONS` DISABLE KEYS */;
INSERT INTO `CUSTOMER_SUBSCRIPTIONS` VALUES (1,'Deepika D.','deepikadhaker@gmail.com','+91 9820937445','maternity','I am looking for maternity photoshoot','2025-11-05 17:49:39'),(2,'Swati R.','swatir@gmail.com','+91 9820937448','kids','I am looking for kid photography','2025-11-05 17:49:39');
/*!40000 ALTER TABLE `CUSTOMER_SUBSCRIPTIONS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PARTNER_COLLABORATION`
--

DROP TABLE IF EXISTS `PARTNER_COLLABORATION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `PARTNER_COLLABORATION` (
  `ID` mediumint NOT NULL AUTO_INCREMENT,
  `NAME` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `EMAIL` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PHONE` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SERVICE` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MESSAGE` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ADD_TS` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PARTNER_COLLABORATION`
--

LOCK TABLES `PARTNER_COLLABORATION` WRITE;
/*!40000 ALTER TABLE `PARTNER_COLLABORATION` DISABLE KEYS */;
INSERT INTO `PARTNER_COLLABORATION` VALUES (1,'Brijesh D.','brijeshdhaker@gmail.com','+91 9820937445','photographer','I am looking for collaboration','2025-11-05 17:48:09'),(2,'Neeta D.','neetadhk@gmail.com','+91 9820937448','photographer','I am looking for collaboration','2025-11-05 17:48:09');
/*!40000 ALTER TABLE `PARTNER_COLLABORATION` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'NEETASTUDIO'
--
/*!50003 DROP PROCEDURE IF EXISTS `proc_add_customer_booking` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_add_customer_booking`(
    input_name VARCHAR(256), 
    input_email VARCHAR(64), 
    input_phone VARCHAR(16),
    input_stype VARCHAR(16),
    input_ptype VARCHAR(16),
    input_sdate VARCHAR(32),
    input_stime VARCHAR(32),
    input_message VARCHAR(512),   
    OUT out_code INT,
    OUT out_message VARCHAR(256)
)
BEGIN

    INSERT INTO `NEETASTUDIO`.`CUSTOMER_BOOKINGS` (
        `NAME`, 
        `EMAIL`, 
        `PHONE`, 
        `SESSION_TYPE`, 
        `PACKAGE_TYPE`,
        `SESSION_DATE`, 
        `SESSION_TIME`, 
        `MESSAGE`, 
        `ADD_TS`
    ) VALUES (
        input_name, 
        input_email, 
        input_phone, 
        input_stype, 
        input_ptype, 
        input_sdate, 
        input_stime, 
        input_message, 
        now()
    );


    SET @code = (SELECT last_insert_id());

    select * from `NEETASTUDIO`.`CUSTOMER_BOOKINGS` where `ID` = @code;

    SET out_code = 0;
    SET out_message= 'Your photo session successfully booking.';

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_add_customer_enquiry` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_add_customer_enquiry`(
    input_name VARCHAR(256), 
    input_email VARCHAR(64), 
    input_phone VARCHAR(16),
    input_enquiry VARCHAR(16),
    input_message VARCHAR(512),   
    OUT out_code INT,
    OUT out_message VARCHAR(256)
)
BEGIN
    
    INSERT INTO `NEETASTUDIO`.`CUSTOMER_ENQUIRIES` (`NAME`, `EMAIL`, `PHONE`, `ENQUIRY_FOR`, `MESSAGE`, `ADD_TS`) VALUES
    (input_name, input_email, input_phone, input_enquiry, input_message, now());

    SET @code = (SELECT last_insert_id());

    select * from `NEETASTUDIO`.`CUSTOMER_ENQUIRIES` where `ID` = @code;

    SET out_code = 0;
    SET out_message= 'Recodred successfully added.';

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_add_customer_subscription` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_add_customer_subscription`(
    input_name VARCHAR(256), 
    input_email VARCHAR(64), 
    input_phone VARCHAR(16),
    input_interest VARCHAR(16),
    input_message VARCHAR(512),   
    OUT out_code INT,
    OUT out_message VARCHAR(256)
)
BEGIN
    
    INSERT INTO `NEETASTUDIO`.`CUSTOMER_SUBSCRIPTIONS` (`NAME`, `EMAIL`, `PHONE`, `INTERSET_TYPE`, `MESSAGE`, `ADD_TS`) VALUES
    (input_name, input_email, input_phone, input_interest, input_message, now());

    SET @code = (SELECT last_insert_id());

    select * from `NEETASTUDIO`.`CUSTOMER_SUBSCRIPTIONS` where `ID` = @code;

    SET out_code = 0;
    SET out_message= 'Recodred successfully added.';

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `proc_add_partner_collaboration` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_add_partner_collaboration`(
    input_name VARCHAR(256), 
    input_email VARCHAR(64), 
    input_phone VARCHAR(16),
    input_stype VARCHAR(16),
    input_message VARCHAR(512),   
    OUT out_code INT,
    OUT out_message VARCHAR(256)
)
BEGIN
    
    INSERT INTO `NEETASTUDIO`.`PARTNER_COLLABORATION` (`NAME`, `EMAIL`, `PHONE`, `SERVICE`, `MESSAGE`, `ADD_TS`) VALUES
    (input_name, input_email, input_phone, input_stype, input_message, now());

    SET @code = (SELECT last_insert_id());

    select * from `NEETASTUDIO`.`PARTNER_COLLABORATION` where `ID` = @code;

    SET out_code = 0;
    SET out_message= 'Recodred successfully added.';

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

-- Dump completed on 2025-11-05 18:03:34

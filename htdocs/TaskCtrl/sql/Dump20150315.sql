CREATE DATABASE  IF NOT EXISTS `tsk_manager` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tsk_manager`;
-- MySQL dump 10.13  Distrib 5.6.23, for Win32 (x86)
--
-- Host: vsrv-1    Database: tsk_manager
-- ------------------------------------------------------
-- Server version	5.6.20-log

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
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `city` (
  `name` varchar(64) NOT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` VALUES ('Москва',1),('Санкт-петербург',2),('Ярославль',3),('Воронеж',4);
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `name` varchar(25) NOT NULL,
  `status_id` int(11) NOT NULL,
  `description` text,
  PRIMARY KEY (`name`,`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES ('В работе',1,'Задание принято в работу исполнителем'),('Возвращено',6,'Задание возвращено на выполненение исполнителю, не прошло проверку'),('Выполнено',10,'Задание полностью выполнено и принято заказчиком'),('На проверке',5,'Задание выполнено - отправлено на проверку исполнителю'),('Провалено',0,'Задание не было выполнено исполнителем, отказ, нарушение сроков');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task` (
  `subject` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `createdate` datetime NOT NULL,
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`task_id`),
  UNIQUE KEY `subject_UNIQUE` (`subject`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES ('размещение объявлений на Avito','размещение объявлений на Avito!','2015-03-08 00:00:00',1),('Отзывы','Разметить отзывы по магазинам 220v','2015-03-07 00:00:00',2),('Задача №4!','   Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи Описание задачи! Всё!','2015-03-15 00:00:00',3),('Задача 5','описание задачи 5','2015-03-15 00:00:00',4),('задача 6','задача 6 описание','2015-03-15 00:00:00',6),('Задача 7','описание','2015-03-15 00:00:00',7);
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `task_active`
--

DROP TABLE IF EXISTS `task_active`;
/*!50001 DROP VIEW IF EXISTS `task_active`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `task_active` AS SELECT 
 1 AS `task_id`,
 1 AS `startdate`,
 1 AS `finishdate`,
 1 AS `cost`,
 1 AS `status_id`,
 1 AS `user_id`,
 1 AS `description`,
 1 AS `statusdate`,
 1 AS `city_id`,
 1 AS `cityname`,
 1 AS `tasksubject`,
 1 AS `taskdescription`,
 1 AS `statusname`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `task_available`
--

DROP TABLE IF EXISTS `task_available`;
/*!50001 DROP VIEW IF EXISTS `task_available`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `task_available` AS SELECT 
 1 AS `task_id`,
 1 AS `subject`,
 1 AS `description`,
 1 AS `startdate`,
 1 AS `finishdate`,
 1 AS `cost`,
 1 AS `city_id`,
 1 AS `cityname`,
 1 AS `user_id`,
 1 AS `status_id`,
 1 AS `statusname`,
 1 AS `taskusers`,
 1 AS `taskmaxuser`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `task_schedule`
--

DROP TABLE IF EXISTS `task_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_schedule` (
  `task_id` int(11) NOT NULL,
  `startdate` datetime NOT NULL,
  `finishdate` datetime NOT NULL,
  `cost` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `maxuser` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`task_id`,`startdate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_schedule`
--

LOCK TABLES `task_schedule` WRITE;
/*!40000 ALTER TABLE `task_schedule` DISABLE KEYS */;
INSERT INTO `task_schedule` VALUES (1,'2015-03-08 00:00:00','2015-05-08 00:00:00',211,'тест',15),(2,'2015-03-07 00:00:00','2016-03-07 00:00:00',1000,'task2',2),(7,'2015-03-10 00:00:00','2015-05-08 00:00:00',1150,'test2',5);
/*!40000 ALTER TABLE `task_schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_schedule_city`
--

DROP TABLE IF EXISTS `task_schedule_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_schedule_city` (
  `task_id` int(11) NOT NULL,
  `startdate` datetime NOT NULL,
  `city_id` varchar(45) NOT NULL,
  PRIMARY KEY (`task_id`,`startdate`,`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_schedule_city`
--

LOCK TABLES `task_schedule_city` WRITE;
/*!40000 ALTER TABLE `task_schedule_city` DISABLE KEYS */;
INSERT INTO `task_schedule_city` VALUES (1,'2015-03-08 00:00:00','1'),(1,'2015-03-08 00:00:00','2');
/*!40000 ALTER TABLE `task_schedule_city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_status`
--

DROP TABLE IF EXISTS `task_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_status` (
  `task_id` int(11) NOT NULL,
  `startdate` datetime NOT NULL,
  `status_id` varchar(15) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` text,
  `statusdate` datetime NOT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`task_id`,`status_id`,`user_id`,`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_status`
--

LOCK TABLES `task_status` WRITE;
/*!40000 ALTER TABLE `task_status` DISABLE KEYS */;
INSERT INTO `task_status` VALUES (1,'2015-03-08 00:00:00','0',1,'не смогла','2015-03-14 14:31:36',2),(1,'2015-03-08 00:00:00','1',3,'start','2015-03-14 17:22:06',1),(1,'2015-03-08 00:00:00','1',10,'Начато выполнение','2015-03-15 10:48:24',1),(1,'2015-03-08 00:00:00','1',10,'Начато выполнение','2015-03-15 10:48:25',2),(1,'2015-03-08 00:00:00','5',1,'размещено 524 объявления в москве','2015-03-14 14:32:38',1),(2,'2015-03-07 00:00:00','1',1,'Начато выполнение','2015-03-15 11:51:48',0),(2,'2015-03-07 00:00:00','1',3,'Начато выполнение','2015-03-15 11:58:14',0);
/*!40000 ALTER TABLE `task_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `task_status_cnt`
--

DROP TABLE IF EXISTS `task_status_cnt`;
/*!50001 DROP VIEW IF EXISTS `task_status_cnt`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `task_status_cnt` AS SELECT 
 1 AS `user_id`,
 1 AS `TaskStart`,
 1 AS `TaskFinish`,
 1 AS `TaskSend`,
 1 AS `TaskReturn`,
 1 AS `TaskFail`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `task_status_log`
--

DROP TABLE IF EXISTS `task_status_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_status_log` (
  `task_id` int(11) NOT NULL,
  `startdate` datetime NOT NULL,
  `status_id` varchar(15) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` text,
  `statusdate` datetime NOT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`task_id`,`startdate`,`status_id`,`user_id`,`city_id`,`statusdate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_status_log`
--

LOCK TABLES `task_status_log` WRITE;
/*!40000 ALTER TABLE `task_status_log` DISABLE KEYS */;
INSERT INTO `task_status_log` VALUES (1,'2015-03-08 00:00:00','0',1,'не смогла','2015-03-14 14:31:36',2),(1,'2015-03-08 00:00:00','1',1,'start','2015-03-14 14:19:25',1),(1,'2015-03-08 00:00:00','1',1,'start','2015-03-14 14:31:57',1),(1,'2015-03-08 00:00:00','1',1,'start','2015-03-14 14:19:23',2),(1,'2015-03-08 00:00:00','1',1,'start','2015-03-14 14:30:06',2),(1,'2015-03-08 00:00:00','1',3,'start','2015-03-14 17:22:06',1),(1,'2015-03-08 00:00:00','1',10,'Начато выполнение','2015-03-15 10:48:24',1),(1,'2015-03-08 00:00:00','1',10,'Начато выполнение','2015-03-15 10:48:25',2),(1,'2015-03-08 00:00:00','5',1,'0','2015-03-14 14:23:17',1),(1,'2015-03-08 00:00:00','5',1,'размещено 524 объявления в москве','2015-03-14 14:32:38',1),(1,'2015-03-08 00:00:00','5',1,'4521','2015-03-14 14:27:17',2),(2,'2015-03-07 00:00:00','1',1,'Начато выполнение','2015-03-15 11:51:47',0),(2,'2015-03-07 00:00:00','1',3,'Начато выполнение','2015-03-15 11:58:14',0);
/*!40000 ALTER TABLE `task_status_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `task_usercnt`
--

DROP TABLE IF EXISTS `task_usercnt`;
/*!50001 DROP VIEW IF EXISTS `task_usercnt`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `task_usercnt` AS SELECT 
 1 AS `taskcnt`,
 1 AS `task_id`,
 1 AS `city_id`,
 1 AS `startdate`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction` (
  `account_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `operation` varchar(15) DEFAULT NULL,
  `description` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`account_id`,`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `date_born` datetime DEFAULT NULL,
  `city_id` int(11) NOT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(15) NOT NULL,
  `token` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `login_UNIQUE` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('Ivan1','Kuzmin',NULL,1,'454646','testmail',1,'ivan','2c42e5cf1cdbafea04ed267018ef1511',0),('Петр','Петров',NULL,1,'45458рен',NULL,2,'petr','2f0714f5365318775c8f50d720a307dc',0),('1','test1',NULL,1,'343-963-63','appkiv@gmail.com',3,'1','c4ca4238a0b923820dcc509a6f75849b',0),('Ольга','Марушина',NULL,2,'895246645','test@gmil.com',4,'olga','e44d46e0bb9691cf448a9bb19391e8ab',0),('test','tttt',NULL,4,'4545','appkiv@gmail1.com',6,'test','test',0),('4','4',NULL,2,'444','appkiv@gmail1.com',7,'4','a87ff679a2f3e71d9181a67b7542122c',0),('newuser','newuser',NULL,1,'753','appkiv@gmail.com',8,'newuser','0354d89c28ec399c00d3cb2d094cf093',0),('2','2',NULL,2,'2','appkiv@gmail.com',9,'2','c81e728d9d4c2f636f067f89cc14862c',0),('3','3',NULL,1,'3','appkiv@gmail.com',10,'3','eccbc87e4b5ce2fe28308fd9f2a7baf3',0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_accounts`
--

DROP TABLE IF EXISTS `user_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_accounts` (
  `account_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `currentball` decimal(8,2) NOT NULL,
  PRIMARY KEY (`account_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_accounts`
--

LOCK TABLES `user_accounts` WRITE;
/*!40000 ALTER TABLE `user_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_message`
--

DROP TABLE IF EXISTS `user_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_message` (
  `user_id` int(11) NOT NULL,
  `problem_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `msg` varchar(512) DEFAULT NULL,
  `msg_id` int(11) NOT NULL DEFAULT '0',
  `parentmsg_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`problem_id`,`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_message`
--

LOCK TABLES `user_message` WRITE;
/*!40000 ALTER TABLE `user_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'tsk_manager'
--

--
-- Dumping routines for database 'tsk_manager'
--
/*!50003 DROP PROCEDURE IF EXISTS `do_new_task` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ivan`@`%` PROCEDURE `do_new_task`(
	 in v_task_id int
	,in v_city_id int
	,in v_startdate datetime
	,in v_user_id int
	,in v_newstatus int
	,in v_description text
)
BEGIN
	/* всё в лог*/
	INSERT INTO task_status_log(task_id,startdate,status_id,user_id,statusdate,city_id,description)
	VALUES( v_task_id,v_startdate,v_newstatus,v_user_id,sysdate(),v_city_id,v_description);

	/* обновляем текущий статус */
	IF exists(SELECT 1 FROM task_status WHERE 
			task_id = v_task_id
		and user_id = v_user_id
		and city_id = v_city_id
		and startdate = v_startdate
	) 
	THEN
		UPDATE task_status SET 
			 statusdate = sysdate()
			,status_id = v_newstatus
			,description = v_description
		WHERE
			task_id = v_task_id and user_id = v_user_id and city_id = v_city_id and startdate = v_startdate;
	ELSE
		INSERT INTO task_status(task_id,startdate,status_id,user_id,statusdate,city_id,description)
		VALUES( v_task_id,v_startdate,v_newstatus,v_user_id,sysdate(),v_city_id,v_description);
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `task_addcity` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ivan`@`%` PROCEDURE `task_addcity`(
	 in v_task_id int
	,in v_startdate datetime
	,in v_city_id int
)
BEGIN

	/* обновляем текущий статус */
	IF not exists(SELECT 1 FROM task_schedule_city WHERE 
			task_id = v_task_id
		and startdate = v_startdate
		and city_id = v_city_id
	) 
	THEN
		INSERT INTO task_schedule_city(task_id,startdate,city_id)
		VALUES( v_task_id,v_startdate,v_city_id);
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `task_active`
--

/*!50001 DROP VIEW IF EXISTS `task_active`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`ivan`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `task_active` AS select `ta`.`task_id` AS `task_id`,`ta`.`startdate` AS `startdate`,`sh`.`finishdate` AS `finishdate`,`sh`.`cost` AS `cost`,`ta`.`status_id` AS `status_id`,`ta`.`user_id` AS `user_id`,`ta`.`description` AS `description`,`ta`.`statusdate` AS `statusdate`,`ta`.`city_id` AS `city_id`,`c`.`name` AS `cityname`,`t`.`subject` AS `tasksubject`,`t`.`description` AS `taskdescription`,`s`.`name` AS `statusname` from ((((`task_status` `ta` join `task` `t` on((`t`.`task_id` = `ta`.`task_id`))) join `task_schedule` `sh` on(((`ta`.`task_id` = `sh`.`task_id`) and (`sh`.`startdate` = `ta`.`startdate`)))) left join `city` `c` on((`c`.`city_id` = `ta`.`city_id`))) join `status` `s` on((`s`.`status_id` = `ta`.`status_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `task_available`
--

/*!50001 DROP VIEW IF EXISTS `task_available`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`ivan`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `task_available` AS select `t`.`task_id` AS `task_id`,`t`.`subject` AS `subject`,`t`.`description` AS `description`,`sh`.`startdate` AS `startdate`,`sh`.`finishdate` AS `finishdate`,`sh`.`cost` AS `cost`,`shc`.`city_id` AS `city_id`,`c`.`name` AS `cityname`,NULL AS `user_id`,NULL AS `status_id`,NULL AS `statusname`,coalesce(`stc`.`taskcnt`,0) AS `taskusers`,`sh`.`maxuser` AS `taskmaxuser` from ((((`task` `t` join `task_schedule` `sh` on((`t`.`task_id` = `sh`.`task_id`))) left join `task_schedule_city` `shc` on(((`shc`.`task_id` = `t`.`task_id`) and (`shc`.`startdate` = `sh`.`startdate`)))) left join `city` `c` on((`c`.`city_id` = `shc`.`city_id`))) left join `task_usercnt` `stc` on(((`stc`.`task_id` = `t`.`task_id`) and (`stc`.`city_id` = coalesce(`shc`.`city_id`,0)) and (`stc`.`startdate` = `sh`.`startdate`)))) where (sysdate() between `sh`.`startdate` and `sh`.`finishdate`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `task_status_cnt`
--

/*!50001 DROP VIEW IF EXISTS `task_status_cnt`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`ivan`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `task_status_cnt` AS select `task_status`.`user_id` AS `user_id`,sum((case when (`task_status`.`status_id` = 1) then 1 else 0 end)) AS `TaskStart`,sum((case when (`task_status`.`status_id` = 10) then 1 else 0 end)) AS `TaskFinish`,sum((case when (`task_status`.`status_id` = 5) then 1 else 0 end)) AS `TaskSend`,sum((case when (`task_status`.`status_id` = 6) then 1 else 0 end)) AS `TaskReturn`,sum((case when (`task_status`.`status_id` = 0) then 1 else 0 end)) AS `TaskFail` from `task_status` group by `task_status`.`user_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `task_usercnt`
--

/*!50001 DROP VIEW IF EXISTS `task_usercnt`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`ivan`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `task_usercnt` AS select count(`task_status`.`task_id`) AS `taskcnt`,`task_status`.`task_id` AS `task_id`,`task_status`.`city_id` AS `city_id`,`task_status`.`startdate` AS `startdate` from `task_status` where (`task_status`.`status_id` >= 1) group by `task_status`.`task_id`,`task_status`.`startdate`,`task_status`.`city_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-15 20:56:45

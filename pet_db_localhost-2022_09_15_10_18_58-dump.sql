-- MySQL dump 10.13  Distrib 8.0.24, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: pet_db
-- ------------------------------------------------------
-- Server version	8.0.24

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
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` VALUES ('accountant','14',1661928026),('admin','1',1661928026),('designer','17',NULL),('designer','19',NULL),('designer','6',1661928026),('designer','7',1661928026),('designer_admin','8',1661928026),('driver','15',1661928026),('laboratory','9',1661928026),('logistician','12',1661928026),('manager','20',NULL),('manager','4',1661928026),('manager','5',1661928026),('manager_admin','3',1661928026),('packer','11',1661928026),('packer','12',1661928026),('prepress','2',1661928026),('printer','10',1661928026),('rewinder','11',1661928026),('technolog','16',1661928026),('warehouse_manager','13',1661928026);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` VALUES ('accountant',1,'Бухгалтер',NULL,NULL,1661928026,1661928026),('admin',1,'Администратор',NULL,NULL,1661928026,1661928026),('designer',1,'Дизайнер',NULL,NULL,1661928026,1661928026),('designer_admin',1,'Начальник отдела дизайна',NULL,NULL,1661928026,1661928026),('designReadyLabel',2,'Отметка о дизайн готов',NULL,NULL,1661928026,1661928026),('designReadyOwnLabel',2,'Редактирование своего ресурса(дизайнер)','isDesigner',NULL,1661928026,1661928026),('driver',1,'Водитель',NULL,NULL,1661928026,1661928026),('laboratory',1,'Лаборант',NULL,NULL,1661928026,1661928026),('logistician',1,'Логист',NULL,NULL,1661928026,1661928026),('manager',1,'Менеджер',NULL,NULL,1661928026,1661928026),('manager_admin',1,'Начальник отдела продаж',NULL,NULL,1661928026,1661928026),('packer',1,'Упаковщик',NULL,NULL,1661928026,1661928026),('prepress',1,'Допечатник',NULL,NULL,1661928026,1661928026),('printer',1,'Печатник',NULL,NULL,1661928026,1661928026),('rewinder',1,'Перемотчик',NULL,NULL,1661928026,1661928026),('technolog',1,'Технолог',NULL,NULL,1661928026,1661928026),('updateByOwnerManager',2,'Редактирование своего ресурса(менеджер)','isManager',NULL,1661928026,1661928026),('updateCustomer',2,'Редактирование заказчика',NULL,NULL,1661928026,1661928026),('updateLabel',2,'Редактирование этикетки',NULL,NULL,1661928026,1661928026),('updateOrder',2,'Редактирование заказа',NULL,NULL,1661928026,1661928026),('updateShipment',2,'Редактирование отгрузки',NULL,NULL,1661928026,1661928026),('warehouse_manager',1,'Заведующий складом',NULL,NULL,1661928026,1661928026);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` VALUES ('admin','accountant'),('admin','designer'),('designer_admin','designer'),('admin','designer_admin'),('designer','designReadyLabel'),('designer_admin','designReadyLabel'),('designReadyOwnLabel','designReadyLabel'),('admin','driver'),('admin','laboratory'),('admin','logistician'),('admin','manager'),('manager_admin','manager'),('admin','manager_admin'),('admin','packer'),('designer_admin','prepress'),('admin','printer'),('admin','rewinder'),('admin','technolog'),('manager','updateByOwnerManager'),('manager_admin','updateCustomer'),('updateByOwnerManager','updateCustomer'),('manager_admin','updateLabel'),('updateByOwnerManager','updateLabel'),('manager_admin','updateOrder'),('updateByOwnerManager','updateOrder'),('manager_admin','updateShipment'),('updateByOwnerManager','updateShipment'),('admin','warehouse_manager');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_rule`
--

LOCK TABLES `auth_rule` WRITE;
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
INSERT INTO `auth_rule` VALUES ('isDesigner',_binary 'O:21:\"app\\rbac\\DesignerRule\":3:{s:4:\"name\";s:10:\"isDesigner\";s:9:\"createdAt\";i:1661928026;s:9:\"updatedAt\";i:1661928026;}',1661928026,1661928026),('isManager',_binary 'O:20:\"app\\rbac\\ManagerRule\":3:{s:4:\"name\";s:9:\"isManager\";s:9:\"createdAt\";i:1661928026;s:9:\"updatedAt\";i:1661928026;}',1661928026,1661928026);
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `background_label`
--

DROP TABLE IF EXISTS `background_label`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `background_label` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `background_label`
--

LOCK TABLES `background_label` WRITE;
/*!40000 ALTER TABLE `background_label` DISABLE KEYS */;
INSERT INTO `background_label` VALUES (1,'белый'),(2,'металлизированный серебро'),(3,'металлизированный золото'),(4,'прозрачный');
/*!40000 ALTER TABLE `background_label` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bank_transfer`
--

DROP TABLE IF EXISTS `bank_transfer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bank_transfer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_of_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `customer_id` int NOT NULL,
  `date` date NOT NULL,
  `sum` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_if_dk` (`customer_id`),
  CONSTRAINT `customer_if_dk` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank_transfer`
--

LOCK TABLES `bank_transfer` WRITE;
/*!40000 ALTER TABLE `bank_transfer` DISABLE KEYS */;
INSERT INTO `bank_transfer` VALUES (1,'2022-08-17 15:26:53',1,'2022-08-01',10000),(2,'2022-08-17 15:28:53',2,'2022-08-01',10000),(3,'2022-08-17 18:48:10',4,'2022-08-17',10000),(4,'2022-09-15 09:48:29',2,'2022-09-15',58800);
/*!40000 ALTER TABLE `bank_transfer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `business_trip_employee`
--

DROP TABLE IF EXISTS `business_trip_employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `business_trip_employee` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `date_of_begin` datetime NOT NULL COMMENT 'Дата начала',
  `date_of_end` datetime DEFAULT NULL COMMENT 'Дата окончания',
  `gasoline_cost` double DEFAULT NULL COMMENT 'ГСМ, руб',
  `cost` double DEFAULT NULL COMMENT 'Командировочные',
  `transport_id` int NOT NULL COMMENT 'Транспорт',
  `user_id` int NOT NULL,
  `customer_id` int DEFAULT NULL,
  `status_id` int NOT NULL DEFAULT '1' COMMENT 'Статус',
  `comment` text,
  PRIMARY KEY (`id`),
  KEY `transport_id_fk` (`transport_id`),
  KEY `user_id` (`user_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `transport_id_fk` FOREIGN KEY (`transport_id`) REFERENCES `transport` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `trip_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `business_trip_employee`
--

LOCK TABLES `business_trip_employee` WRITE;
/*!40000 ALTER TABLE `business_trip_employee` DISABLE KEYS */;
INSERT INTO `business_trip_employee` VALUES (1,'2022-08-01 00:00:00','2022-08-13 00:00:00',NULL,NULL,2,3,1,1,NULL),(2,'2022-08-19 09:23:19',NULL,NULL,NULL,1,3,3,1,NULL),(3,'2022-08-19 09:23:19',NULL,NULL,NULL,1,3,9,2,NULL),(4,'2022-08-04 00:00:00','2022-08-12 00:00:00',NULL,NULL,1,3,1,1,NULL),(5,'2022-08-04 00:00:00','2022-08-12 00:00:00',NULL,NULL,1,3,8,1,NULL),(6,'2022-09-01 00:00:00','2022-09-02 00:00:00',1000,500,1,1,4,1,NULL);
/*!40000 ALTER TABLE `business_trip_employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calc_common_param`
--

DROP TABLE IF EXISTS `calc_common_param`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `calc_common_param` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `subscribe` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `value` float NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calc_common_param`
--

LOCK TABLES `calc_common_param` WRITE;
/*!40000 ALTER TABLE `calc_common_param` DISABLE KEYS */;
INSERT INTO `calc_common_param` VALUES (8,'transport_cost','Затраты на транспорт',2,'2022-08-25 22:13:08'),(9,'layout_price','Стоимость вёрстки (руб)',500,'2022-08-25 22:13:34'),(11,'print_on_glue','Печать по клею (коэф.)',0.11,'2022-08-25 22:14:04'),(12,'print_label_book','Печать этикетки-книжки (коэф.)',2,'2022-08-25 22:14:32'),(13,'euro_exchange','курс евро в рублях (руб/евро)',66,'2022-08-25 22:14:53'),(16,'stamping_time','Время настройки конгрев секции (час)',0.1,'2022-08-25 22:16:00'),(17,'form_tolerance','Допуск формы (мм)',18,'2022-08-25 22:17:19'),(18,'tax','Процент НДС (%)',20,'2022-08-11 11:17:46'),(19,'form_change_time','Время на смену одной формы (мин)',30,'2022-08-11 14:17:21'),(21,'price_increase','Повышение цены (коэф)',1.04,'2022-08-15 10:22:49'),(22,'one_box_weight','Вес одной коробки, кг',0.1,'2022-08-23 16:35:28'),(23,'one_label_weight','Вес одной этикетки , кг',0.01,'2022-08-23 16:36:17');
/*!40000 ALTER TABLE `calc_common_param` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calc_common_param_archive`
--

DROP TABLE IF EXISTS `calc_common_param_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `calc_common_param_archive` (
  `id` int NOT NULL AUTO_INCREMENT,
  `calc_common_param_id` int NOT NULL,
  `value` float NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `delete_calc_common_param` (`calc_common_param_id`),
  CONSTRAINT `delete_calc_common_param` FOREIGN KEY (`calc_common_param_id`) REFERENCES `calc_common_param` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calc_common_param_archive`
--

LOCK TABLES `calc_common_param_archive` WRITE;
/*!40000 ALTER TABLE `calc_common_param_archive` DISABLE KEYS */;
INSERT INTO `calc_common_param_archive` VALUES (7,8,2,'2022-08-25 22:13:08'),(9,9,500,'2022-08-25 22:13:34'),(11,11,0.11,'2022-08-25 22:14:04'),(13,12,2,'2022-08-25 22:14:32'),(14,13,65,'2022-08-25 22:14:53'),(16,16,0.1,'2022-08-25 22:15:24'),(20,17,18,'2022-08-25 22:17:19'),(21,18,20,'2022-08-25 22:17:55'),(22,19,30,'2022-08-25 22:18:23'),(23,21,1.04,'2022-08-25 22:19:15'),(24,22,0.1,'2022-08-25 22:19:35'),(25,23,0.01,'2022-08-25 22:19:43');
/*!40000 ALTER TABLE `calc_common_param_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calc_mashine_param`
--

DROP TABLE IF EXISTS `calc_mashine_param`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `calc_mashine_param` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `subscribe` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calc_mashine_param`
--

LOCK TABLES `calc_mashine_param` WRITE;
/*!40000 ALTER TABLE `calc_mashine_param` DISABLE KEYS */;
INSERT INTO `calc_mashine_param` VALUES (1,'desired_profit','Желаемая прибыль (евро/час)'),(4,'design_layout_price','Стоимость дизайн макета (руб)'),(5,'form_price','Стоимость формы (евро/см2)'),(8,'scotch_price','Стоимость скотча (евро/см2)'),(9,'paper_cmyk_adjust','Бумага на настройку CMYK (м)'),(10,'paper_common_adjust','Бумага на настройку - общее (м)'),(11,'paper_varnish_adjust','Бумага на настройку ЛАК (м)'),(12,'paper_pantone_adjust','Бумага на настройку Pantone (м)'),(13,'roll_change_length','Длина смены ролика общее (м)'),(14,'lost_paint_compensation','Компенсация потери красок (кг)'),(15,'paper_roll_change','Бумага на смену ролика (м)'),(16,'varnish_usage','Кол-во лака на 1 кв.м (кг/м2)'),(17,'paint_usage','Кол-во краски на 1 кв.м (кг/м2)'),(18,'time_cmyk_adjust','Время CMYK настройка (ч)'),(19,'common_adjust','Общая настройка (ч)'),(20,'time_varnish_adjust','Время ЛАК настройка (ч)'),(21,'time_paint_selection','Время подбор краски (ч)'),(22,'time_pantone_adjust','Время Pantone настройка (ч)'),(23,'one_roll_change_time','Время на смену 1-го ролика (мин)'),(24,'print_speed','Скорость печати (м/мин)'),(25,'stencil_mesh_price','Стоимость трафаретной сетки 1 шт (руб)'),(26,'time_stencil_mesh_adjust','Время Трафарет настройка (ч)'),(27,'paper_paint_selection_adjust','Бумага на подбор краски под оригинал (м)'),(29,'stencil_paint_usage','Кол-во краски на трафарет (кг/м2)'),(31,'paint_selection_price','Стоимость подбора краски (руб)');
/*!40000 ALTER TABLE `calc_mashine_param` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calc_mashine_param_value`
--

DROP TABLE IF EXISTS `calc_mashine_param_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `calc_mashine_param_value` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mashine_id` int NOT NULL,
  `calc_mashine_param_id` int NOT NULL,
  `value` float NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `delete_calc_mashine_param` (`calc_mashine_param_id`),
  KEY `delete_mashine` (`mashine_id`),
  CONSTRAINT `delete_calc_mashine_param` FOREIGN KEY (`calc_mashine_param_id`) REFERENCES `calc_mashine_param` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `delete_mashine` FOREIGN KEY (`mashine_id`) REFERENCES `mashine` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calc_mashine_param_value`
--

LOCK TABLES `calc_mashine_param_value` WRITE;
/*!40000 ALTER TABLE `calc_mashine_param_value` DISABLE KEYS */;
INSERT INTO `calc_mashine_param_value` VALUES (1,1,1,40,'2022-08-11 15:16:56'),(4,1,4,2000,'2022-08-11 15:29:35'),(6,1,8,0.0053,'2022-08-11 15:30:35'),(7,1,9,35,'2022-08-11 15:30:55'),(8,1,10,50,'2022-08-11 15:31:11'),(10,1,12,50,'2022-08-15 08:47:43'),(11,1,13,40,'2022-08-15 12:31:46'),(12,1,5,0.015,'2022-08-15 12:50:24'),(14,1,11,10,'2022-08-15 13:22:20'),(15,1,14,0.05,'2022-08-15 13:23:10'),(16,1,16,0.003,'2022-08-15 13:23:32'),(17,1,17,0.0007,'2022-08-15 13:23:49'),(18,1,24,35,'2022-08-15 13:24:13'),(20,1,19,0.3,'2022-08-16 08:24:51'),(21,1,18,0.1,'2022-08-16 08:25:28'),(22,1,22,0.5,'2022-08-16 08:25:59'),(23,1,23,10,'2022-08-16 08:26:51'),(24,1,25,500,'2022-08-23 08:39:55'),(25,5,24,50,'2022-08-25 08:15:49'),(26,6,24,35,'2022-08-25 08:19:53'),(27,4,1,35,'2022-08-25 08:23:30'),(28,3,17,0.0007,'2022-08-25 20:53:03'),(29,2,17,0.0007,'2022-08-25 20:53:30'),(30,3,1,40,'2022-08-25 20:58:23'),(31,2,1,40,'2022-08-25 20:58:41');
/*!40000 ALTER TABLE `calc_mashine_param_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calc_mashine_param_value_archive`
--

DROP TABLE IF EXISTS `calc_mashine_param_value_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `calc_mashine_param_value_archive` (
  `id` int NOT NULL AUTO_INCREMENT,
  `calc_mashine_param_value_id` int NOT NULL,
  `value` float NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `delete_calc_mashine_param_value` (`calc_mashine_param_value_id`),
  CONSTRAINT `delete_calc_mashine_param_value` FOREIGN KEY (`calc_mashine_param_value_id`) REFERENCES `calc_mashine_param_value` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calc_mashine_param_value_archive`
--

LOCK TABLES `calc_mashine_param_value_archive` WRITE;
/*!40000 ALTER TABLE `calc_mashine_param_value_archive` DISABLE KEYS */;
INSERT INTO `calc_mashine_param_value_archive` VALUES (14,1,40,'2022-08-26 08:05:28'),(16,4,2000,'2022-08-26 08:36:34'),(17,6,0.0053,'2022-08-26 08:36:34'),(18,7,35,'2022-08-26 08:36:34'),(19,8,50,'2022-08-26 08:36:34'),(20,10,50,'2022-08-26 08:36:34'),(21,11,40,'2022-08-26 08:36:34'),(22,12,0.015,'2022-08-26 08:36:35'),(23,14,10,'2022-08-26 08:36:35'),(24,15,0.05,'2022-08-26 08:36:35'),(25,16,0.003,'2022-08-26 08:36:35'),(26,17,0.0007,'2022-08-26 08:36:35'),(27,18,35,'2022-08-26 08:36:35'),(28,20,0.3,'2022-08-26 08:36:35'),(29,21,0.1,'2022-08-26 08:36:35'),(30,22,0.5,'2022-08-26 08:36:35'),(31,23,10,'2022-08-26 08:36:35'),(32,24,500,'2022-08-26 08:36:35'),(33,25,50,'2022-08-26 08:36:35'),(34,26,35,'2022-08-26 08:36:35'),(35,27,35,'2022-08-26 08:36:35'),(36,28,0.0007,'2022-08-26 08:36:35'),(37,29,0.0007,'2022-08-26 08:36:35'),(38,30,40,'2022-08-26 08:36:35'),(39,31,40,'2022-08-26 08:36:35');
/*!40000 ALTER TABLE `calc_mashine_param_value_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `combination`
--

DROP TABLE IF EXISTS `combination`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `combination` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `combination`
--

LOCK TABLES `combination` WRITE;
/*!40000 ALTER TABLE `combination` DISABLE KEYS */;
INSERT INTO `combination` VALUES (1,NULL),(2,NULL),(3,NULL),(4,NULL),(5,NULL),(6,NULL),(7,NULL),(8,NULL);
/*!40000 ALTER TABLE `combination` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `combination_form`
--

DROP TABLE IF EXISTS `combination_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `combination_form` (
  `id` int NOT NULL AUTO_INCREMENT,
  `combination_id` int NOT NULL,
  `label_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `label_id` (`label_id`),
  KEY `combination_id` (`combination_id`),
  CONSTRAINT `combination_id` FOREIGN KEY (`combination_id`) REFERENCES `combination` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `label_id_fk` FOREIGN KEY (`label_id`) REFERENCES `label` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `combination_form`
--

LOCK TABLES `combination_form` WRITE;
/*!40000 ALTER TABLE `combination_form` DISABLE KEYS */;
INSERT INTO `combination_form` VALUES (6,4,7),(7,4,9),(14,7,11),(15,7,10),(17,8,6),(18,8,15);
/*!40000 ALTER TABLE `combination_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_of_create` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_of_agreement` datetime DEFAULT NULL,
  `status_id` int NOT NULL DEFAULT '1',
  `name` varchar(100) NOT NULL,
  `user_id` int NOT NULL,
  `subject_id` int DEFAULT NULL,
  `region_id` int DEFAULT NULL,
  `town_id` int DEFAULT NULL,
  `street_id` int DEFAULT NULL,
  `house` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `number` varchar(50) DEFAULT NULL,
  `comment` text,
  `time_to_delivery_from` time DEFAULT NULL,
  `time_to_delivery_to` time DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_user_id_fk` (`user_id`),
  KEY `customer_subject_id` (`subject_id`),
  KEY `customer_street_id` (`street_id`),
  KEY `customer_town_id` (`town_id`),
  KEY `customer_region_id` (`region_id`),
  CONSTRAINT `customer_region_id` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `customer_street_id` FOREIGN KEY (`street_id`) REFERENCES `street` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `customer_subject_id` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `customer_town_id` FOREIGN KEY (`town_id`) REFERENCES `town` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `customer_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'2022-06-01 08:30:34',NULL,1,'Изыск Изыск',3,1,1,1,1,'д. 1',NULL,NULL,NULL,NULL,NULL,NULL),(2,'2022-06-01 08:31:02','2022-06-01 00:00:00',1,'Изыскатель ТПФ',3,1,1,1,1,'д 101','cheese@mail.ru','89196948604','','08:30:00','08:30:00','Рамиль Мишарин'),(3,'2022-06-01 08:31:17',NULL,1,'Мясокомбинат',3,1,2,2,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'2022-06-01 08:31:25',NULL,1,'Пластмасскомбинат',4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'2022-06-01 08:31:31',NULL,1,'Азбука сыра',3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'2022-06-01 08:31:35',NULL,1,'Онест ООО',4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,'2022-06-01 08:31:38',NULL,1,'Мясокомбинат',3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,'2022-06-20 19:46:11','2022-06-29 00:00:00',1,'Сырокомбинат',3,1,1,1,1,'101','cheese@mail.ru','89196948604','teset','09:30:00','09:30:00',NULL),(9,'2022-08-09 19:07:07','2022-08-01 00:00:00',1,'ООО \"Технолайн\"',5,1,1,1,5,'д 139','cheese@mail.ru','89196948604','ноу коммент','16:00:00','19:00:00','Иванов Иван Иванович');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enterprise_cost`
--

DROP TABLE IF EXISTS `enterprise_cost`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enterprise_cost` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL,
  `service_id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `cost` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `enterprise_cost_order_id_fk` (`order_id`),
  KEY `enterprise_cost_user_id_fk` (`user_id`),
  KEY `enterprise_cost_service_id_fk` (`service_id`),
  CONSTRAINT `enterprise_cost_order_id_fk` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `enterprise_cost_service_id_fk` FOREIGN KEY (`service_id`) REFERENCES `enterprise_cost_service` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `enterprise_cost_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enterprise_cost`
--

LOCK TABLES `enterprise_cost` WRITE;
/*!40000 ALTER TABLE `enterprise_cost` DISABLE KEYS */;
/*!40000 ALTER TABLE `enterprise_cost` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enterprise_cost_service`
--

DROP TABLE IF EXISTS `enterprise_cost_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enterprise_cost_service` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enterprise_cost_service`
--

LOCK TABLES `enterprise_cost_service` WRITE;
/*!40000 ALTER TABLE `enterprise_cost_service` DISABLE KEYS */;
INSERT INTO `enterprise_cost_service` VALUES (1,'Новый штанец'),(2,'Перезаказ штанца'),(3,'Изготовление форм'),(4,'Дизайн этикетки'),(5,'Премия'),(6,'З/п'),(7,'Аренда'),(8,'Налог'),(9,'Командировка'),(10,'Прочее');
/*!40000 ALTER TABLE `enterprise_cost_service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `envelope`
--

DROP TABLE IF EXISTS `envelope`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `envelope` (
  `id` int NOT NULL AUTO_INCREMENT,
  `color1` int NOT NULL,
  `color2` int NOT NULL,
  `shelf_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `envelope_shelf_id_fk` (`shelf_id`),
  CONSTRAINT `envelope_shelf_id_fk` FOREIGN KEY (`shelf_id`) REFERENCES `shelf` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `envelope`
--

LOCK TABLES `envelope` WRITE;
/*!40000 ALTER TABLE `envelope` DISABLE KEYS */;
INSERT INTO `envelope` VALUES (3,1,1,4),(4,1,1,3),(5,1,2,4),(6,2,3,3),(7,4,5,4),(8,5,5,3),(9,5,5,3),(10,5,5,4),(11,5,5,3),(12,5,4,4);
/*!40000 ALTER TABLE `envelope` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `finished_products_warehouse`
--

DROP TABLE IF EXISTS `finished_products_warehouse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `finished_products_warehouse` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_of_create` datetime DEFAULT CURRENT_TIMESTAMP,
  `order_id` int DEFAULT NULL,
  `previous_order_id` int DEFAULT NULL,
  `label_id` int DEFAULT NULL,
  `label_in_roll` int NOT NULL,
  `roll_count` int NOT NULL,
  `packed_roll_count` int DEFAULT '0',
  `packed_box_count` int DEFAULT '0',
  `packed_bale_count` int DEFAULT '0',
  `sended_roll_count` int DEFAULT '0',
  `sended_box_count` int DEFAULT '0',
  `sended_bale_count` int DEFAULT '0',
  `defect_roll_count` int DEFAULT '0',
  `defect_note` text,
  PRIMARY KEY (`id`),
  KEY `fpw_order_id_fk` (`order_id`),
  KEY `fpw_pr_order_id_fk` (`previous_order_id`),
  KEY `fpw_label_id_fk` (`label_id`),
  CONSTRAINT `fpw_label_id_fk` FOREIGN KEY (`label_id`) REFERENCES `label` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fpw_order_id_fk` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fpw_pr_order_id_fk` FOREIGN KEY (`previous_order_id`) REFERENCES `order` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `finished_products_warehouse`
--

LOCK TABLES `finished_products_warehouse` WRITE;
/*!40000 ALTER TABLE `finished_products_warehouse` DISABLE KEYS */;
/*!40000 ALTER TABLE `finished_products_warehouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foil`
--

DROP TABLE IF EXISTS `foil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `foil` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foil`
--

LOCK TABLES `foil` WRITE;
/*!40000 ALTER TABLE `foil` DISABLE KEYS */;
INSERT INTO `foil` VALUES (1,'Без фольги'),(2,'Gold фольга'),(3,'Silver фольга'),(4,'Holographic фольга');
/*!40000 ALTER TABLE `foil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form`
--

DROP TABLE IF EXISTS `form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `form` (
  `id` int NOT NULL AUTO_INCREMENT,
  `label_id` int DEFAULT NULL,
  `width` int DEFAULT NULL,
  `height` int DEFAULT NULL,
  `lpi` int DEFAULT NULL,
  `dpi` int DEFAULT NULL,
  `pantone_id` int DEFAULT NULL,
  `photo_output_id` int DEFAULT NULL,
  `combination_id` int DEFAULT NULL,
  `envelope_id` int DEFAULT NULL,
  `polymer_id` int DEFAULT NULL,
  `ready` int DEFAULT NULL,
  `form_defect_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `label_id` (`label_id`),
  KEY `form_combination_id_fk` (`combination_id`),
  KEY `form_envelope_id_fk` (`envelope_id`),
  KEY `form_form_defect_id_fk` (`form_defect_id`),
  KEY `form_pantone_id_fk` (`pantone_id`),
  KEY `form_photo_output_id_fk` (`photo_output_id`),
  KEY `form_polymer_id_fk` (`polymer_id`),
  CONSTRAINT `form_combination_id_fk` FOREIGN KEY (`combination_id`) REFERENCES `combination` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `form_envelope_id_fk` FOREIGN KEY (`envelope_id`) REFERENCES `envelope` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `form_form_defect_id_fk` FOREIGN KEY (`form_defect_id`) REFERENCES `form_defect` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `form_label_id_fk` FOREIGN KEY (`label_id`) REFERENCES `label` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `form_pantone_id_fk` FOREIGN KEY (`pantone_id`) REFERENCES `pantone` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `form_photo_output_id_fk` FOREIGN KEY (`photo_output_id`) REFERENCES `photo_output` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `form_polymer_id_fk` FOREIGN KEY (`polymer_id`) REFERENCES `polymer` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form`
--

LOCK TABLES `form` WRITE;
/*!40000 ALTER TABLE `form` DISABLE KEYS */;
INSERT INTO `form` VALUES (53,NULL,150,150,154,5080,1,2,4,10,1,1,NULL),(54,NULL,150,150,154,5080,2,2,4,10,1,1,NULL),(55,NULL,150,150,154,5080,3,2,4,10,1,1,NULL),(56,NULL,150,150,154,5080,4,2,4,10,1,1,NULL),(57,NULL,150,150,154,5080,9,2,4,10,1,1,NULL),(58,NULL,150,150,154,5080,NULL,2,4,10,1,1,NULL),(59,NULL,150,150,154,5080,NULL,2,4,10,1,1,NULL),(60,1,150,150,154,2540,1,2,NULL,11,1,1,NULL),(61,1,150,150,154,2540,3,2,NULL,11,1,1,NULL),(62,1,150,150,154,2540,10,2,NULL,11,1,1,NULL),(71,NULL,143,145,154,5080,1,2,7,3,1,1,NULL),(72,NULL,143,145,154,5080,4,2,7,3,1,1,NULL),(73,NULL,143,145,154,5080,NULL,2,7,3,1,1,NULL),(74,NULL,143,145,154,5080,NULL,2,7,3,1,1,NULL),(75,NULL,143,145,154,5080,NULL,2,7,3,1,1,NULL),(78,5,150,150,154,2400,1,1,NULL,3,1,1,NULL),(79,5,150,150,154,2400,9,1,NULL,3,1,1,NULL),(86,15,150,150,154,2400,NULL,1,NULL,NULL,NULL,NULL,NULL),(99,15,150,150,154,2540,1,2,NULL,NULL,NULL,NULL,NULL),(100,6,300,300,154,2400,2,1,NULL,NULL,NULL,NULL,NULL),(101,6,300,300,154,2400,2,1,NULL,NULL,NULL,NULL,NULL),(102,6,300,300,154,2540,NULL,2,NULL,NULL,NULL,NULL,NULL),(103,39,300,250,154,2400,1,1,NULL,12,2,1,NULL),(104,39,150,300,154,2400,2,1,NULL,12,2,1,NULL),(105,39,150,250,154,2400,3,1,NULL,12,2,1,NULL),(106,39,300,300,154,2400,4,1,NULL,12,2,1,NULL),(108,42,150,150,154,2400,NULL,1,NULL,NULL,NULL,NULL,NULL),(109,42,150,150,154,2540,2,2,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_defect`
--

DROP TABLE IF EXISTS `form_defect`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `form_defect` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_defect`
--

LOCK TABLES `form_defect` WRITE;
/*!40000 ALTER TABLE `form_defect` DISABLE KEYS */;
INSERT INTO `form_defect` VALUES (1,'Износ формы'),(2,'Грамматическая ошибка'),(3,'Цвет'),(4,'Отсутсвует форма'),(5,'Не совмещение'),(6,'Не правильный выход'),(7,'Не попадает в штанец'),(8,'Нет части информации'),(9,'Дисторция'),(10,'Отсутствие или несоответствие элементов дизайна'),(11,'Сильный муар');
/*!40000 ALTER TABLE `form_defect` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_order_history`
--

DROP TABLE IF EXISTS `form_order_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `form_order_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `form_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `form_order_history_order_id_fk` (`order_id`),
  KEY `foho_form_id_fk` (`form_id`),
  CONSTRAINT `foho_form_id_fk` FOREIGN KEY (`form_id`) REFERENCES `form` (`id`),
  CONSTRAINT `form_order_history_order_id_fk` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_order_history`
--

LOCK TABLES `form_order_history` WRITE;
/*!40000 ALTER TABLE `form_order_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_order_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `knife_kind`
--

DROP TABLE IF EXISTS `knife_kind`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `knife_kind` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `knife_kind`
--

LOCK TABLES `knife_kind` WRITE;
/*!40000 ALTER TABLE `knife_kind` DISABLE KEYS */;
INSERT INTO `knife_kind` VALUES (1,'Universal'),(2,'3L (Laser Long Life)'),(3,'Black Top 3 in 1');
/*!40000 ALTER TABLE `knife_kind` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `label`
--

DROP TABLE IF EXISTS `label`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `label` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_label` int DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `designer_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `manager_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `prepress_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `date_of_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_of_design` datetime DEFAULT NULL,
  `date_of_prepress` datetime DEFAULT NULL,
  `customer_id` int DEFAULT NULL,
  `status_id` int NOT NULL DEFAULT '1',
  `pants_id` int DEFAULT NULL,
  `foil_id` int NOT NULL DEFAULT '1',
  `designer_id` int DEFAULT NULL,
  `prepress_id` int DEFAULT NULL,
  `varnish_id` int NOT NULL DEFAULT '0',
  `laminate` int NOT NULL DEFAULT '0',
  `print_on_glue` int NOT NULL DEFAULT '0',
  `variable` int NOT NULL DEFAULT '0',
  `variable_paint_count` float DEFAULT NULL,
  `stencil` int NOT NULL DEFAULT '0',
  `image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `image_crop` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `output_label_id` int NOT NULL DEFAULT '1',
  `background_id` int DEFAULT '1',
  `orientation` int NOT NULL DEFAULT '0',
  `image_extended` varchar(100) DEFAULT NULL,
  `design_file` varchar(100) DEFAULT NULL,
  `prepress_design_file` varchar(100) DEFAULT NULL,
  `color_count` int DEFAULT '0',
  `laboratory_id` int DEFAULT NULL,
  `date_of_flexformready` datetime DEFAULT NULL,
  `laboratory_note` text,
  `takeoff_flash` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `label_customer_id_fk` (`customer_id`),
  KEY `label_background_id_fk` (`background_id`),
  KEY `label_designer_id_fk` (`designer_id`),
  KEY `label_prepress_id_fk` (`prepress_id`),
  KEY `label_laboratory_id_fk` (`laboratory_id`),
  KEY `label_foil_id_fk` (`foil_id`),
  KEY `label_output_label_id_fk` (`output_label_id`),
  KEY `label_varnish_id_fk` (`varnish_id`),
  KEY `label_pants_id_fk` (`pants_id`),
  CONSTRAINT `label_background_id_fk` FOREIGN KEY (`background_id`) REFERENCES `background_label` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `label_customer_id_fk` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `label_designer_id_fk` FOREIGN KEY (`designer_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `label_foil_id_fk` FOREIGN KEY (`foil_id`) REFERENCES `foil` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `label_laboratory_id_fk` FOREIGN KEY (`laboratory_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `label_output_label_id_fk` FOREIGN KEY (`output_label_id`) REFERENCES `output_label` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `label_pants_id_fk` FOREIGN KEY (`pants_id`) REFERENCES `pants` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `label_prepress_id_fk` FOREIGN KEY (`prepress_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `label_varnish_id_fk` FOREIGN KEY (`varnish_id`) REFERENCES `varnish_status` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `label`
--

LOCK TABLES `label` WRITE;
/*!40000 ALTER TABLE `label` DISABLE KEYS */;
INSERT INTO `label` VALUES (1,NULL,'Этикетка заказа номер 1','примечание вот такое на','badge badge-successbadge badge-success','примечание вот такое напримечание вот такое напримечание вот такое напримечание вот такое на','2022-05-18 14:55:03','2022-06-06 16:12:15','2022-06-06 16:13:56',1,10,1,1,6,NULL,1,1,0,1,0.005,0,'label/1.jpg','label/1_crop.jpg',2,1,0,'label/1_extended.jpg','label/1_design.cdr','label/1.cdr',0,NULL,'2022-06-17 10:28:03','',0),(2,NULL,'Этикетка заказа','по ручьям','','text','2022-05-18 14:55:03',NULL,NULL,2,10,1,1,6,NULL,2,1,0,1,NULL,1,'label/2.jpg','label/2_crop.jpg',2,1,0,'label/2_extended.jpg','label/2_design.cdr','label/2.csv',0,NULL,NULL,NULL,0),(3,NULL,'Ведро 12л','примечание вот такое на','','','2022-05-18 14:55:03',NULL,NULL,3,1,3,1,6,NULL,0,1,0,0,NULL,0,'/web/label/3.jpg',NULL,1,1,0,NULL,NULL,NULL,0,NULL,NULL,NULL,0),(4,NULL,'Сосиски говяжие','примечание вот такое','','text','2022-05-18 14:55:03','2022-06-02 14:50:54','2022-06-06 11:43:36',4,7,NULL,1,NULL,NULL,0,1,0,0,NULL,0,'label/4.jpg','label/4_crop.jpg',3,1,0,NULL,'label/4_design.cdr','label/4.csv',0,NULL,NULL,NULL,0),(5,NULL,'Стикеры','намана делай намана будет','','','2022-05-23 14:42:01','2022-06-09 15:50:47','2022-06-10 09:46:47',1,10,2,2,NULL,NULL,2,1,0,1,0.0005,0,'label/5.jpg','label/5_crop.jpg',1,1,0,'label/5_extended.jpg','label/5_design.cdr','label/5_prepress.zip',0,NULL,'2022-06-10 10:14:55','перевывод сделан',0),(6,NULL,'Стикеры ДМ мин 1.5','намана','','','2022-05-23 14:42:32','2022-06-09 15:51:17',NULL,1,6,2,1,NULL,NULL,0,1,0,1,NULL,0,'label/6.jpg','label/6_crop.jpg',2,1,0,'label/6_extended.jpg','label/6_design.cdr',NULL,0,NULL,NULL,'',0),(7,NULL,'Стикеры Азбука Сыра мин 1.5','','','text','2022-05-23 14:42:32','2022-06-06 13:13:11','2022-06-06 15:21:12',1,10,2,2,NULL,NULL,1,1,0,1,NULL,1,NULL,NULL,1,1,0,NULL,NULL,'label/7.csv',0,NULL,'2022-06-17 10:25:48','новые формы',0),(9,NULL,'Казахстан Таз 15 л.  ПИЩЕВОЙ','text','Jura created fuck mate','','2022-05-26 14:28:11','2022-06-06 12:35:52',NULL,1,10,2,1,NULL,NULL,0,0,0,0,NULL,0,'label/9.jpg','label/9_crop.jpg',1,1,0,'label/9_extended.jpg','label/9_design.jpg',NULL,0,NULL,'2022-06-17 10:25:48','новые формы',0),(10,NULL,'Мясо пресованное','','Это я хеллоу','','2022-05-26 14:34:29','2022-06-07 08:47:53','2022-06-07 11:06:45',3,10,NULL,2,NULL,NULL,2,0,1,0,NULL,0,'label/10.jpg','label/10_crop.jpg',1,1,1,'label/10_extended.jpg','label/10_design.cdr','label/10_prepress.zip',0,NULL,'2022-06-09 09:09:51','переделаны формы',0),(11,NULL,'Мясо пресованное 0.1кг','','еуыуеыуеыуавыы','совмещение','2022-05-27 08:33:55','2022-06-07 08:48:29','2022-06-07 11:06:45',4,10,1,1,NULL,NULL,2,0,1,1,NULL,1,'label/11.jpg','label/11_crop.jpg',1,2,0,'label/11_extended.jpg','label/11_design.cdr','label/10_prepress.zip',0,NULL,'2022-06-09 09:09:51','переделаны формы',0),(12,NULL,'Мясо пресованное 0.1кг','','','','2022-05-27 08:35:51','2022-06-07 09:25:42','2022-06-07 11:00:29',2,6,2,1,NULL,NULL,1,0,1,0,NULL,0,'label/12.jpg','label/12_crop.jpg',2,4,1,'label/12_extended.jpg','label/12_design.jpg','label/11_prepress.csv',0,NULL,NULL,NULL,0),(13,NULL,'Казахстан Таз 15 л.  ПИЩЕВОЙ','','','','2022-05-27 11:07:34',NULL,NULL,4,2,2,1,NULL,NULL,1,0,0,0,NULL,0,NULL,NULL,2,1,1,NULL,NULL,NULL,0,NULL,NULL,NULL,0),(14,NULL,'Мясо пресованное 0.1кг','','','','2022-05-27 11:10:01',NULL,NULL,6,2,2,1,NULL,NULL,0,0,0,0,NULL,0,NULL,NULL,3,1,1,NULL,NULL,NULL,0,NULL,NULL,NULL,0),(15,NULL,'Пустышка 30*25','','','note','2022-05-27 15:53:07',NULL,'2022-06-19 22:25:41',4,6,2,1,NULL,NULL,0,0,0,0,NULL,0,NULL,NULL,1,1,1,NULL,NULL,'label/15_prepress.zip',0,NULL,NULL,'',0),(16,15,'Пустышка 30*50',NULL,'',NULL,'2022-05-27 15:55:00',NULL,NULL,2,11,3,1,NULL,NULL,0,0,0,0,NULL,0,NULL,NULL,1,1,0,NULL,NULL,NULL,0,NULL,NULL,NULL,0),(17,13,'Казахстан Таз 15 л.  ПИЩЕВОЙ',NULL,'',NULL,'2022-05-30 19:42:00',NULL,NULL,4,1,2,1,NULL,NULL,1,0,0,0,NULL,0,NULL,NULL,2,1,1,NULL,NULL,NULL,0,NULL,NULL,NULL,0),(18,NULL,'Мясо пресованное 0.1кг',NULL,'',NULL,'2022-05-30 19:45:27',NULL,NULL,2,1,2,1,NULL,NULL,1,0,1,0,NULL,0,NULL,NULL,2,4,1,NULL,NULL,NULL,0,NULL,NULL,NULL,0),(19,18,'Мясо пресованное 0.1кг',NULL,'',NULL,'2022-05-30 19:51:36',NULL,NULL,2,1,2,1,NULL,NULL,1,0,1,0,NULL,0,NULL,NULL,2,4,1,NULL,NULL,NULL,0,NULL,NULL,NULL,0),(20,NULL,'Казахстан Таз 15 л.  ПИЩЕВОЙ',NULL,'',NULL,'2022-05-30 20:48:16',NULL,NULL,2,1,2,1,NULL,NULL,1,1,0,0,NULL,0,NULL,NULL,1,2,1,NULL,NULL,NULL,0,NULL,NULL,NULL,0),(21,NULL,'Пустышка 30*25',NULL,'',NULL,'2022-05-30 20:49:31',NULL,NULL,2,11,NULL,1,NULL,NULL,0,0,0,0,NULL,0,NULL,NULL,1,1,1,NULL,NULL,NULL,0,NULL,NULL,NULL,0),(22,NULL,'Пустышка 30*25',NULL,'',NULL,'2022-05-31 10:11:30',NULL,NULL,6,11,2,1,NULL,NULL,0,0,0,0,NULL,0,NULL,NULL,1,1,0,NULL,NULL,NULL,0,NULL,NULL,NULL,0),(23,NULL,'Казахстан Таз 15 л.  ПИЩЕВОЙ','','gbhjghj','','2022-06-01 08:46:31',NULL,NULL,2,2,2,1,NULL,NULL,1,0,1,1,NULL,0,NULL,NULL,1,1,0,NULL,NULL,NULL,0,NULL,NULL,NULL,0),(24,NULL,'Мясо пресованное 0.1кг',NULL,'',NULL,'2022-06-01 08:49:25',NULL,NULL,4,1,1,1,NULL,NULL,0,0,0,0,NULL,0,NULL,NULL,4,3,1,NULL,NULL,NULL,0,NULL,NULL,NULL,0),(25,NULL,'Мясо пресованное 0.1кг',NULL,'',NULL,'2022-06-01 08:52:29',NULL,NULL,1,1,2,1,NULL,NULL,1,0,0,0,NULL,1,NULL,NULL,2,2,0,NULL,NULL,NULL,0,NULL,NULL,NULL,0),(26,NULL,'test',NULL,'testsetr',NULL,'2022-06-01 14:05:10',NULL,NULL,2,1,2,1,NULL,NULL,0,1,0,0,NULL,0,NULL,NULL,1,2,1,NULL,NULL,NULL,0,NULL,NULL,NULL,0),(27,NULL,'test','','',NULL,'2022-06-03 16:57:11',NULL,NULL,2,1,1,1,NULL,NULL,2,0,0,0,NULL,1,NULL,NULL,1,1,1,NULL,NULL,NULL,0,NULL,NULL,NULL,0),(28,NULL,'Колбаса','','Дизайн отправлен на почту',NULL,'2022-06-09 21:00:07',NULL,NULL,7,1,2,1,NULL,NULL,2,0,1,0,NULL,1,NULL,NULL,1,1,1,NULL,NULL,NULL,4,NULL,NULL,NULL,0),(29,NULL,'Колбаса примая','','',NULL,'2022-06-09 21:04:40',NULL,NULL,7,1,3,1,NULL,NULL,0,0,0,0,NULL,1,NULL,NULL,2,2,0,NULL,NULL,NULL,5,NULL,NULL,NULL,0),(30,NULL,'Водка Ханская','','',NULL,'2022-06-09 21:07:37',NULL,NULL,6,1,NULL,1,NULL,NULL,3,1,1,0,NULL,0,NULL,NULL,1,3,1,NULL,NULL,NULL,2,NULL,NULL,NULL,0),(31,NULL,'Мясо пресованное 0.1кг','','',NULL,'2022-06-10 08:05:03',NULL,NULL,7,1,2,1,NULL,NULL,1,0,0,0,NULL,0,NULL,NULL,1,1,1,NULL,NULL,NULL,5,NULL,NULL,NULL,0),(32,1,'Этикетка заказа номер 1 подобная','примечание вот такое на','badge badge-successbadge badge-success','примечание вот такое напримечание вот такое напримечание вот такое напримечание вот такое на','2022-05-18 14:55:03','2022-06-06 16:12:15','2022-06-06 16:13:56',1,1,1,1,NULL,NULL,1,1,0,1,NULL,1,'label/1.jpg','label/1_crop.jpg',1,1,1,'label/1_extended.jpg','label/1_design.cdr','label/1.cdr',5,NULL,NULL,NULL,0),(34,25,'Мясо пресованное 0.1кг','','',NULL,'2022-06-10 15:39:03',NULL,NULL,1,1,2,1,NULL,NULL,1,0,0,0,NULL,1,NULL,NULL,2,2,0,NULL,NULL,NULL,0,NULL,NULL,NULL,0),(35,9,'Казахстан Таз 15 л.  ПИЩЕВОЙ','text','Jura created fuck mate','','2022-06-14 21:23:36','2022-06-06 12:35:52',NULL,1,1,2,1,NULL,NULL,0,0,0,0,NULL,0,'label/9.jpg','label/9_crop.jpg',1,1,0,'label/9_extended.jpg','label/9_design.jpg',NULL,0,NULL,NULL,NULL,0),(36,35,'Казахстан Таз 15 л.  ПИЩЕВОЙ','text','Jura created fuck mate','','2022-06-17 09:01:38','2022-06-06 12:35:52',NULL,1,1,2,1,NULL,NULL,0,0,0,0,NULL,0,'label/9.jpg','label/9_crop.jpg',1,1,0,'label/9_extended.jpg','label/9_design.jpg',NULL,0,NULL,NULL,NULL,0),(37,NULL,'пустышка 80*120','','',NULL,'2022-06-17 09:03:44',NULL,NULL,1,11,1,1,NULL,NULL,0,0,0,0,NULL,0,NULL,NULL,1,1,0,NULL,NULL,NULL,0,NULL,NULL,NULL,0),(38,NULL,'Колбаса','','',NULL,'2022-06-17 09:09:00',NULL,NULL,1,1,2,1,NULL,NULL,1,0,0,1,NULL,0,NULL,NULL,1,2,1,NULL,NULL,NULL,4,NULL,NULL,NULL,0),(39,NULL,'Smart ENGINE 1800 Вт (ромбическая)','','Создать дизайн-макет на основе исходника в CMYK. Без тиснения. Имитация золота и серебра. Материал - белый полипропилен. Лак сплошной глянцевый.','','2022-08-09 19:11:10','2022-08-09 19:23:30','2022-08-09 19:58:16',9,10,3,1,NULL,NULL,2,0,0,0,NULL,0,'label/39.jpg','label/39_crop.jpg',4,1,2,NULL,'label/39_design.cdr','label/39_prepress.zip',4,NULL,'2022-08-09 20:00:08','',1),(40,39,'Smart ENGINE 1800 Вт (ромбическая)','','Создать дизайн-макет на основе исходника в CMYK. Без тиснения. Имитация золота и серебра. Материал - белый полипропилен. Лак сплошной глянцевый.','','2022-08-09 19:11:10','2022-08-09 19:23:30','2022-08-09 19:58:16',9,1,3,1,NULL,NULL,2,0,1,1,NULL,0,'label/39.jpg','label/39_crop.jpg',1,1,1,NULL,'label/39_design.cdr','label/39_prepress.zip',4,NULL,'2022-08-09 20:00:08','',1),(41,36,'Казахстан Таз 12 л.','text','','','2022-08-19 11:06:34',NULL,NULL,1,1,2,1,NULL,NULL,1,0,0,0,NULL,1,'label/9.jpg','label/9_crop.jpg',2,1,0,'label/9_extended.jpg','label/9_design.jpg',NULL,0,NULL,NULL,NULL,0),(42,37,'пустышка 80*120','bla bla bla bla','','bla bla bla','2022-08-19 13:07:16','2022-08-19 13:50:28','2022-08-19 15:07:09',1,9,1,1,NULL,NULL,0,0,0,0,NULL,0,'label/42.jpg','label/42_crop.jpg',1,1,0,'label/42_extended.jpg','label/42_design.cdr','label/42_prepress.zip',0,NULL,NULL,'',0),(43,NULL,'Пустышка','','','','2022-08-29 11:39:04',NULL,NULL,6,10,1,1,NULL,NULL,0,0,0,0,NULL,0,'','',1,1,0,'','','',0,NULL,NULL,'',0),(44,NULL,'Пустышка 20*25','','','','2022-08-29 21:31:44',NULL,NULL,9,10,NULL,1,NULL,NULL,0,0,0,0,NULL,0,'','',1,1,1,'','','',0,NULL,NULL,'',0);
/*!40000 ALTER TABLE `label` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `level` int DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `log_time` double DEFAULT NULL,
  `prefix` text COLLATE utf8_unicode_ci,
  `message` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `idx_log_level` (`level`),
  KEY `idx_log_category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES (1,4,'yii\\db\\Command::query',1662014259.0227,'[-][-][-]','SHOW FULL COLUMNS FROM `migration`'),(2,4,'yii\\db\\Connection::open',1662014259.0227,'[-][-][-]','Opening DB connection: mysql:host=localhost;dbname=pet_db'),(3,4,'yii\\db\\Command::query',1662014261.093,'[-][-][-]','SELECT\n    `kcu`.`CONSTRAINT_NAME` AS `constraint_name`,\n    `kcu`.`COLUMN_NAME` AS `column_name`,\n    `kcu`.`REFERENCED_TABLE_NAME` AS `referenced_table_name`,\n    `kcu`.`REFERENCED_COLUMN_NAME` AS `referenced_column_name`\nFROM `information_schema`.`REFERENTIAL_CONSTRAINTS` AS `rc`\nJOIN `information_schema`.`KEY_COLUMN_USAGE` AS `kcu` ON\n    (\n        `kcu`.`CONSTRAINT_CATALOG` = `rc`.`CONSTRAINT_CATALOG` OR\n        (`kcu`.`CONSTRAINT_CATALOG` IS NULL AND `rc`.`CONSTRAINT_CATALOG` IS NULL)\n    ) AND\n    `kcu`.`CONSTRAINT_SCHEMA` = `rc`.`CONSTRAINT_SCHEMA` AND\n    `kcu`.`CONSTRAINT_NAME` = `rc`.`CONSTRAINT_NAME`\nWHERE `rc`.`CONSTRAINT_SCHEMA` = database() AND `kcu`.`TABLE_SCHEMA` = database()\nAND `rc`.`TABLE_NAME` = \'migration\' AND `kcu`.`TABLE_NAME` = \'migration\''),(4,4,'yii\\db\\Command::query',1662014261.1023,'[-][-][-]','SELECT `version`, `apply_time` FROM `migration` ORDER BY `apply_time` DESC, `version` DESC'),(5,4,'yii\\db\\Command::query',1662014261.1065,'[-][-][-]','SHOW FULL COLUMNS FROM `migration`'),(6,4,'yii\\db\\Command::query',1662014261.1082,'[-][-][-]','SELECT\n    `kcu`.`CONSTRAINT_NAME` AS `constraint_name`,\n    `kcu`.`COLUMN_NAME` AS `column_name`,\n    `kcu`.`REFERENCED_TABLE_NAME` AS `referenced_table_name`,\n    `kcu`.`REFERENCED_COLUMN_NAME` AS `referenced_column_name`\nFROM `information_schema`.`REFERENTIAL_CONSTRAINTS` AS `rc`\nJOIN `information_schema`.`KEY_COLUMN_USAGE` AS `kcu` ON\n    (\n        `kcu`.`CONSTRAINT_CATALOG` = `rc`.`CONSTRAINT_CATALOG` OR\n        (`kcu`.`CONSTRAINT_CATALOG` IS NULL AND `rc`.`CONSTRAINT_CATALOG` IS NULL)\n    ) AND\n    `kcu`.`CONSTRAINT_SCHEMA` = `rc`.`CONSTRAINT_SCHEMA` AND\n    `kcu`.`CONSTRAINT_NAME` = `rc`.`CONSTRAINT_NAME`\nWHERE `rc`.`CONSTRAINT_SCHEMA` = database() AND `kcu`.`TABLE_SCHEMA` = database()\nAND `rc`.`TABLE_NAME` = \'migration\' AND `kcu`.`TABLE_NAME` = \'migration\''),(7,4,'yii\\db\\Command::execute',1662014262.1826,'[-][-][-]','CREATE TABLE `log` (\n	`id` bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,\n	`level` int(11),\n	`category` varchar(255),\n	`log_time` double,\n	`prefix` text,\n	`message` text\n) CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB'),(8,4,'yii\\db\\Command::execute',1662014262.2699,'[-][-][-]','ALTER TABLE `log` ADD INDEX `idx_log_level` (`level`)'),(9,4,'yii\\db\\Command::execute',1662014262.3133,'[-][-][-]','ALTER TABLE `log` ADD INDEX `idx_log_category` (`category`)'),(10,4,'yii\\db\\Command::query',1662014262.3286,'[-][-][-]','SHOW FULL COLUMNS FROM `migration`'),(11,4,'yii\\db\\Command::query',1662014262.3306,'[-][-][-]','SELECT\n    `kcu`.`CONSTRAINT_NAME` AS `constraint_name`,\n    `kcu`.`COLUMN_NAME` AS `column_name`,\n    `kcu`.`REFERENCED_TABLE_NAME` AS `referenced_table_name`,\n    `kcu`.`REFERENCED_COLUMN_NAME` AS `referenced_column_name`\nFROM `information_schema`.`REFERENTIAL_CONSTRAINTS` AS `rc`\nJOIN `information_schema`.`KEY_COLUMN_USAGE` AS `kcu` ON\n    (\n        `kcu`.`CONSTRAINT_CATALOG` = `rc`.`CONSTRAINT_CATALOG` OR\n        (`kcu`.`CONSTRAINT_CATALOG` IS NULL AND `rc`.`CONSTRAINT_CATALOG` IS NULL)\n    ) AND\n    `kcu`.`CONSTRAINT_SCHEMA` = `rc`.`CONSTRAINT_SCHEMA` AND\n    `kcu`.`CONSTRAINT_NAME` = `rc`.`CONSTRAINT_NAME`\nWHERE `rc`.`CONSTRAINT_SCHEMA` = database() AND `kcu`.`TABLE_SCHEMA` = database()\nAND `rc`.`TABLE_NAME` = \'migration\' AND `kcu`.`TABLE_NAME` = \'migration\''),(12,4,'yii\\db\\Command::execute',1662014262.3323,'[-][-][-]','INSERT INTO `migration` (`version`, `apply_time`) VALUES (\'m141106_185632_log_init\', 1662014262)'),(13,4,'application',1662014258.9694,'[-][-][-]','$_GET = []\n\n$_POST = []'),(14,4,'yii\\web\\Session::open',1662014309.2054,'[127.0.0.1][1][-]','Session started'),(15,4,'yii\\db\\Command::query',1662014309.2408,'[127.0.0.1][1][-]','SHOW FULL COLUMNS FROM `user`'),(16,4,'yii\\db\\Connection::open',1662014309.2408,'[127.0.0.1][1][-]','Opening DB connection: mysql:host=localhost;dbname=pet_db'),(17,4,'yii\\db\\Command::query',1662014311.2978,'[127.0.0.1][1][-]','SELECT\n    `kcu`.`CONSTRAINT_NAME` AS `constraint_name`,\n    `kcu`.`COLUMN_NAME` AS `column_name`,\n    `kcu`.`REFERENCED_TABLE_NAME` AS `referenced_table_name`,\n    `kcu`.`REFERENCED_COLUMN_NAME` AS `referenced_column_name`\nFROM `information_schema`.`REFERENTIAL_CONSTRAINTS` AS `rc`\nJOIN `information_schema`.`KEY_COLUMN_USAGE` AS `kcu` ON\n    (\n        `kcu`.`CONSTRAINT_CATALOG` = `rc`.`CONSTRAINT_CATALOG` OR\n        (`kcu`.`CONSTRAINT_CATALOG` IS NULL AND `rc`.`CONSTRAINT_CATALOG` IS NULL)\n    ) AND\n    `kcu`.`CONSTRAINT_SCHEMA` = `rc`.`CONSTRAINT_SCHEMA` AND\n    `kcu`.`CONSTRAINT_NAME` = `rc`.`CONSTRAINT_NAME`\nWHERE `rc`.`CONSTRAINT_SCHEMA` = database() AND `kcu`.`TABLE_SCHEMA` = database()\nAND `rc`.`TABLE_NAME` = \'user\' AND `kcu`.`TABLE_NAME` = \'user\''),(18,4,'yii\\db\\Command::query',1662014311.3085,'[127.0.0.1][1][-]','SELECT * FROM `user` WHERE `id`=1'),(19,4,'yii\\db\\Command::query',1662014311.3099,'[127.0.0.1][1][-]','SELECT * FROM `user` WHERE `id`=1'),(20,4,'yii\\web\\User::loginByCookie',1662014311.3241,'[127.0.0.1][1][-]','User \'1\' logged in from 127.0.0.1 via cookie.'),(21,4,'yii\\db\\Command::query',1662014311.3635,'[127.0.0.1][1][-]','SELECT `b`.* FROM `auth_assignment` `a`, `auth_item` `b` WHERE (`a`.`item_name`=`b`.`name`) AND (`a`.`user_id`=\'1\') AND (`b`.`type`=1)'),(22,4,'application',1662014309.1515,'[127.0.0.1][1][-]','$_GET = []\n\n$_POST = []');
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mashine`
--

DROP TABLE IF EXISTS `mashine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mashine` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `mashine_type` int NOT NULL DEFAULT '0' COMMENT '0-печатный станок\r\n1-перемоточная машина\r\n2-станок переменной печати',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mashine`
--

LOCK TABLES `mashine` WRITE;
/*!40000 ALTER TABLE `mashine` DISABLE KEYS */;
INSERT INTO `mashine` VALUES (1,'Arsoma',0),(2,'Gallus',0),(3,'Arsoma2',0),(4,'Arsoma3',0),(5,'Gallus_340',0),(6,'Jetsci',2),(7,'Rotoflex',1),(8,'Grafatronic',1);
/*!40000 ALTER TABLE `mashine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mashine_pantone`
--

DROP TABLE IF EXISTS `mashine_pantone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mashine_pantone` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pantone_id` int NOT NULL,
  `mashine_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mashine_pantone_mashine_id_fk` (`mashine_id`),
  KEY `mashine_pantone_pantone_id_fka` (`pantone_id`),
  CONSTRAINT `mashine_pantone_mashine_id_fk` FOREIGN KEY (`mashine_id`) REFERENCES `mashine` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mashine_pantone_pantone_id_fka` FOREIGN KEY (`pantone_id`) REFERENCES `pantone` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mashine_pantone`
--

LOCK TABLES `mashine_pantone` WRITE;
/*!40000 ALTER TABLE `mashine_pantone` DISABLE KEYS */;
INSERT INTO `mashine_pantone` VALUES (17,8,1),(18,8,2),(19,9,1),(20,11,6),(21,12,5),(22,15,3),(23,16,4),(24,16,5),(34,1,1),(35,1,3),(36,2,1),(37,2,2),(38,2,3),(39,2,4),(40,2,5);
/*!40000 ALTER TABLE `mashine_pantone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mashine_pants`
--

DROP TABLE IF EXISTS `mashine_pants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mashine_pants` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mashine_id` int NOT NULL,
  `pants_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mashine_pants_mashine_id_fka` (`mashine_id`),
  KEY `mashine_pants_pants_id_fka` (`pants_id`),
  CONSTRAINT `mashine_pants_mashine_id_fka` FOREIGN KEY (`mashine_id`) REFERENCES `mashine` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mashine_pants_pants_id_fka` FOREIGN KEY (`pants_id`) REFERENCES `pants` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mashine_pants`
--

LOCK TABLES `mashine_pants` WRITE;
/*!40000 ALTER TABLE `mashine_pants` DISABLE KEYS */;
INSERT INTO `mashine_pants` VALUES (1,1,1),(2,1,2),(3,1,3),(4,2,1),(5,5,1),(6,4,1),(7,1,2857);
/*!40000 ALTER TABLE `mashine_pants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `material`
--

DROP TABLE IF EXISTS `material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `material` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_of_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `material_group_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `material_provider_id` int DEFAULT NULL,
  `short_name` varchar(100) DEFAULT NULL,
  `status` int DEFAULT '1' COMMENT 'status 0 means not used, status 1 - active',
  `price_euro` float DEFAULT NULL COMMENT 'Цена евро/м2',
  `density` int DEFAULT NULL COMMENT 'Плотность г/м2',
  `prompt` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'Подсказка',
  `material_id_from_provider` int DEFAULT NULL COMMENT 'ID от поставщика бумаги',
  PRIMARY KEY (`id`),
  KEY `material_material_group_id_fk` (`material_group_id`),
  KEY `material_material_provider_id_fk` (`material_provider_id`),
  CONSTRAINT `material_material_group_id_fk` FOREIGN KEY (`material_group_id`) REFERENCES `material_group` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `material_material_provider_id_fk` FOREIGN KEY (`material_provider_id`) REFERENCES `material_provider` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material`
--

LOCK TABLES `material` WRITE;
/*!40000 ALTER TABLE `material` DISABLE KEYS */;
INSERT INTO `material` VALUES (1,'2022-07-06 06:34:39',1,'MC FSC S2045M-BG40BR (MC PRIMECOAT S2045N)',1,'полуглянец/акриловый клей',1,0.7,120,'',103),(2,'2022-07-06 06:34:39',1,'MC PRIMECOAT S2000N-BG40BR ',2,NULL,1,0.5,NULL,NULL,NULL),(3,'2022-06-01 06:34:39',6,'Фольга серебро',3,NULL,1,0.5,NULL,NULL,NULL),(4,'2022-07-06 06:34:39',2,'Термобумага',2,'',0,0.863,NULL,'',NULL),(5,'2022-07-08 05:36:31',1,'(1) MC PRIMECOAT S2045N-BG40BR',1,'пг 2045',1,0.38,141,'ПОЛУГЛЯНЕЦ , КАУЧУКОВЫЙ КЛЕЙ , 2045 .',584),(6,'2022-08-15 09:47:36',8,'Ламинация',2,'Ламинация',1,0.19,NULL,'',NULL),(7,'2022-06-01 06:34:39',6,'Фольга Gold',3,NULL,1,0.7,NULL,NULL,NULL);
/*!40000 ALTER TABLE `material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `material_group`
--

DROP TABLE IF EXISTS `material_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `material_group` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material_group`
--

LOCK TABLES `material_group` WRITE;
/*!40000 ALTER TABLE `material_group` DISABLE KEYS */;
INSERT INTO `material_group` VALUES (1,'Полуглянец'),(2,'Термобумага'),(3,'Метализированная'),(4,'Полипропилен белый'),(5,'Полиэтилен'),(6,'Фольга для тиснения'),(7,'Мономатериал'),(8,'Ламинат'),(9,'Полипропилен прозрачный');
/*!40000 ALTER TABLE `material_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `material_price_archive`
--

DROP TABLE IF EXISTS `material_price_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `material_price_archive` (
  `id` int NOT NULL AUTO_INCREMENT,
  `material_id` int NOT NULL,
  `date_of_change` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'дата смены цены',
  `old_value` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mpa_material_id_fk` (`material_id`),
  CONSTRAINT `mpa_material_id_fk` FOREIGN KEY (`material_id`) REFERENCES `material` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material_price_archive`
--

LOCK TABLES `material_price_archive` WRITE;
/*!40000 ALTER TABLE `material_price_archive` DISABLE KEYS */;
INSERT INTO `material_price_archive` VALUES (9,5,'2022-07-14 10:06:24',0.38),(11,1,'2022-08-15 13:47:05',0.7),(12,1,'2022-08-25 18:52:13',0.7),(13,6,'2022-08-25 19:22:08',0.19),(14,5,'2022-08-25 19:24:26',0.38),(15,4,'2022-08-25 19:25:26',0.863),(16,3,'2022-08-26 06:39:28',0.23);
/*!40000 ALTER TABLE `material_price_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `material_provider`
--

DROP TABLE IF EXISTS `material_provider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `material_provider` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material_provider`
--

LOCK TABLES `material_provider` WRITE;
/*!40000 ALTER TABLE `material_provider` DISABLE KEYS */;
INSERT INTO `material_provider` VALUES (1,'Fasson'),(2,'Frimpeks'),(3,'Raflatac');
/*!40000 ALTER TABLE `material_provider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1661694063),('m140506_102106_rbac_init',1661694065),('m141106_185632_log_init',1662014262),('m170907_052038_rbac_add_index_on_auth_assignment_user_id',1661694065),('m180523_151638_rbac_updates_indexes_without_prefix',1661694065),('m200409_110543_rbac_update_mssql_trigger',1661694065);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mixed_pantone`
--

DROP TABLE IF EXISTS `mixed_pantone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mixed_pantone` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pantone_id` int NOT NULL,
  `component_pantone_id` int DEFAULT NULL,
  `weight` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mixed_pantone_pantone_id_fk` (`pantone_id`),
  KEY `mixed_pantone_comp_pantone_id_fk` (`component_pantone_id`),
  CONSTRAINT `mixed_pantone_comp_pantone_id_fk` FOREIGN KEY (`component_pantone_id`) REFERENCES `pantone` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `mixed_pantone_pantone_id_fk` FOREIGN KEY (`pantone_id`) REFERENCES `pantone` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mixed_pantone`
--

LOCK TABLES `mixed_pantone` WRITE;
/*!40000 ALTER TABLE `mixed_pantone` DISABLE KEYS */;
INSERT INTO `mixed_pantone` VALUES (1,8,4,100),(2,8,1,25),(3,8,2,30),(4,8,5,225),(5,8,3,30),(6,8,NULL,NULL),(7,8,NULL,NULL),(8,8,NULL,NULL),(9,10,1,10),(10,10,NULL,NULL),(11,10,NULL,NULL),(12,10,NULL,NULL),(13,10,NULL,NULL),(14,10,NULL,NULL),(15,10,NULL,NULL),(16,10,NULL,NULL),(17,13,NULL,NULL),(18,13,NULL,NULL),(19,13,NULL,NULL),(20,13,NULL,NULL),(21,13,NULL,NULL),(22,13,NULL,NULL),(23,13,NULL,NULL),(24,13,NULL,NULL);
/*!40000 ALTER TABLE `mixed_pantone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_of_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_id` int DEFAULT '1',
  `label_id` int DEFAULT NULL,
  `date_of_sale` datetime DEFAULT NULL,
  `date_of_print_begin` datetime DEFAULT NULL,
  `date_of_print_end` datetime DEFAULT NULL,
  `date_of_variable_print_begin` datetime DEFAULT NULL,
  `date_of_variable_print_end` datetime DEFAULT NULL,
  `date_of_packing_begin` datetime DEFAULT NULL,
  `date_of_packing_end` datetime DEFAULT NULL,
  `date_of_rewind_begin` datetime DEFAULT NULL,
  `date_of_rewind_end` datetime DEFAULT NULL,
  `mashine_id` int DEFAULT NULL,
  `plan_circulation` int DEFAULT NULL,
  `printed_circulation` int DEFAULT NULL COMMENT 'Тираж после печати',
  `sending` int DEFAULT NULL,
  `material_id` int DEFAULT NULL,
  `printer_id` int DEFAULT NULL,
  `label_price` double DEFAULT NULL,
  `label_price_with_tax` double DEFAULT NULL,
  `rewinder_id` int DEFAULT NULL,
  `packer_id` int DEFAULT NULL,
  `rewinder_note` text,
  `printer_note` text,
  `manager_note` text,
  `tech_note` text,
  `sleeve_id` int DEFAULT NULL,
  `winding_id` int DEFAULT NULL,
  `label_on_roll` int DEFAULT NULL,
  `cut_edge` int NOT NULL DEFAULT '0',
  `stretch` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order_label_id_fk` (`label_id`),
  KEY `order_mashine_id_fk` (`mashine_id`),
  KEY `order_packer_id_fk` (`packer_id`),
  KEY `order_printer_id_fk` (`printer_id`),
  KEY `order_rewinder_id_fk` (`rewinder_id`),
  KEY `order_material_id_fk` (`material_id`),
  KEY `order_winding_id_fk` (`winding_id`),
  KEY `order_sleeve_id_fk` (`sleeve_id`),
  CONSTRAINT `order_label_id_fk` FOREIGN KEY (`label_id`) REFERENCES `label` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `order_mashine_id_fk` FOREIGN KEY (`mashine_id`) REFERENCES `mashine` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `order_material_id_fk` FOREIGN KEY (`material_id`) REFERENCES `material` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `order_packer_id_fk` FOREIGN KEY (`packer_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `order_printer_id_fk` FOREIGN KEY (`printer_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `order_rewinder_id_fk` FOREIGN KEY (`rewinder_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `order_sleeve_id_fk` FOREIGN KEY (`sleeve_id`) REFERENCES `sleeve` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `order_winding_id_fk` FOREIGN KEY (`winding_id`) REFERENCES `winding` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_material`
--

DROP TABLE IF EXISTS `order_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_material` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `paper_warehouse_id` int NOT NULL,
  `length` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_material_order_id_fk` (`order_id`),
  KEY `order_material_paper_warehouse_id_fk` (`paper_warehouse_id`),
  CONSTRAINT `order_material_order_id_fk` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `order_material_paper_warehouse_id_fk` FOREIGN KEY (`paper_warehouse_id`) REFERENCES `paper_warehouse` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_material`
--

LOCK TABLES `order_material` WRITE;
/*!40000 ALTER TABLE `order_material` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `output_label`
--

DROP TABLE IF EXISTS `output_label`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `output_label` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `output_label`
--

LOCK TABLES `output_label` WRITE;
/*!40000 ALTER TABLE `output_label` DISABLE KEYS */;
INSERT INTO `output_label` VALUES (1,'Выход1','/web/output_label/s1.jpg'),(2,'Выход2','/web/output_label/s2.jpg'),(3,'Выход3','/web/output_label/s3.jpg'),(4,'Выход4','/web/output_label/s4.jpg');
/*!40000 ALTER TABLE `output_label` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pantone`
--

DROP TABLE IF EXISTS `pantone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pantone` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `pantone_kind_id` int NOT NULL,
  `price_euro` double DEFAULT NULL,
  `subscribe` text,
  PRIMARY KEY (`id`),
  KEY `pantone_pantone_kind_id_fk` (`pantone_kind_id`),
  CONSTRAINT `pantone_pantone_kind_id_fk` FOREIGN KEY (`pantone_kind_id`) REFERENCES `pantone_kind` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pantone`
--

LOCK TABLES `pantone` WRITE;
/*!40000 ALTER TABLE `pantone` DISABLE KEYS */;
INSERT INTO `pantone` VALUES (1,'cyan',1,2.8,''),(2,'magenta',1,0.5,''),(3,'yellow',1,NULL,NULL),(4,'black',1,NULL,NULL),(5,'128 ARSOMA',2,NULL,NULL),(8,'116 Gallus',2,5,''),(9,'new ENERGY (5012) матовый лак 25кг',4,5,NULL),(10,'120 Gallus',2,0.5,''),(11,'Jetsci Black',1,165,'Краска для переменной печати'),(12,'Gallus 340 456',1,60,''),(13,'130 ARSOMA',2,0.6,''),(14,'118 Gallus',1,0.5,''),(15,'118 ARSOMA2',1,0.5,''),(16,'116 Gallus',1,0.5,'dsfhdfg');
/*!40000 ALTER TABLE `pantone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pantone_kind`
--

DROP TABLE IF EXISTS `pantone_kind`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pantone_kind` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pantone_kind`
--

LOCK TABLES `pantone_kind` WRITE;
/*!40000 ALTER TABLE `pantone_kind` DISABLE KEYS */;
INSERT INTO `pantone_kind` VALUES (1,'Чистый PANTONE'),(2,'Смешанный PANTONE'),(3,'Химия'),(4,'Матовый лак'),(5,'Глянцевый лак');
/*!40000 ALTER TABLE `pantone_kind` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pantone_label`
--

DROP TABLE IF EXISTS `pantone_label`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pantone_label` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pantone_id` int NOT NULL,
  `label_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pantone_label_label_id_fk` (`label_id`),
  KEY `pantone_label_pantone_id_fk` (`pantone_id`),
  CONSTRAINT `pantone_label_label_id_fk` FOREIGN KEY (`label_id`) REFERENCES `label` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `pantone_label_pantone_id_fk` FOREIGN KEY (`pantone_id`) REFERENCES `pantone` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pantone_label`
--

LOCK TABLES `pantone_label` WRITE;
/*!40000 ALTER TABLE `pantone_label` DISABLE KEYS */;
INSERT INTO `pantone_label` VALUES (1,1,1),(3,2,1);
/*!40000 ALTER TABLE `pantone_label` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pantone_price_archive`
--

DROP TABLE IF EXISTS `pantone_price_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pantone_price_archive` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pantone_id` int NOT NULL,
  `date_of_change` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `old_value` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ppa_pantone_id_fk` (`pantone_id`),
  CONSTRAINT `ppa_pantone_id_fk` FOREIGN KEY (`pantone_id`) REFERENCES `pantone` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pantone_price_archive`
--

LOCK TABLES `pantone_price_archive` WRITE;
/*!40000 ALTER TABLE `pantone_price_archive` DISABLE KEYS */;
INSERT INTO `pantone_price_archive` VALUES (1,1,'2022-08-16 12:42:14',50),(2,1,'2022-08-16 12:48:25',60),(3,10,'2022-08-16 12:58:15',60),(4,10,'2022-08-16 13:01:41',50),(5,1,'2022-08-25 21:53:03',2.5),(6,1,'2022-08-25 21:53:23',2),(7,1,'2022-08-25 21:54:58',2.7),(8,1,'2022-08-25 22:07:02',2.8),(9,11,'2022-08-26 10:06:08',165),(10,9,'2022-08-26 10:07:19',5),(11,2,'2022-08-26 16:55:54',0.5);
/*!40000 ALTER TABLE `pantone_price_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pantone_warehouse`
--

DROP TABLE IF EXISTS `pantone_warehouse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pantone_warehouse` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pantone_id` int NOT NULL,
  `weight` double NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `shelf_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pw_pantone_id_fk` (`pantone_id`),
  KEY `pw_shelf_id_fk` (`shelf_id`),
  CONSTRAINT `pw_pantone_id_fk` FOREIGN KEY (`pantone_id`) REFERENCES `pantone` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `pw_shelf_id_fk` FOREIGN KEY (`shelf_id`) REFERENCES `shelf` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pantone_warehouse`
--

LOCK TABLES `pantone_warehouse` WRITE;
/*!40000 ALTER TABLE `pantone_warehouse` DISABLE KEYS */;
INSERT INTO `pantone_warehouse` VALUES (1,1,10,'2022-08-16 15:37:32',6);
/*!40000 ALTER TABLE `pantone_warehouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pants`
--

DROP TABLE IF EXISTS `pants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pants` (
  `id` int NOT NULL AUTO_INCREMENT,
  `shaft_id` int DEFAULT NULL,
  `paper_width` int DEFAULT NULL COMMENT 'ширина бумаги',
  `pants_kind_id` int DEFAULT NULL COMMENT 'вид штанца',
  `cuts` int DEFAULT NULL COMMENT 'высечки',
  `width_label` float NOT NULL COMMENT 'ширина этикетки',
  `height_label` float NOT NULL COMMENT 'высота этикетки',
  `knife_kind_id` int DEFAULT NULL COMMENT 'тип ножа',
  `knife_width` int DEFAULT NULL COMMENT 'ширина ножа',
  `picture` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `radius` float DEFAULT NULL COMMENT 'радиус',
  `gap` float DEFAULT NULL COMMENT 'зазор',
  `material_group_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pants_material_group_id_fk` (`material_group_id`),
  KEY `pants_shaft_id_fk` (`shaft_id`),
  KEY `pants_pants_kind_id_fk` (`pants_kind_id`),
  KEY `pants_knife_kind_id_fk` (`knife_kind_id`),
  CONSTRAINT `pants_knife_kind_id_fk` FOREIGN KEY (`knife_kind_id`) REFERENCES `knife_kind` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `pants_material_group_id_fk` FOREIGN KEY (`material_group_id`) REFERENCES `material_group` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `pants_pants_kind_id_fk` FOREIGN KEY (`pants_kind_id`) REFERENCES `pants_kind` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `pants_shaft_id_fk` FOREIGN KEY (`shaft_id`) REFERENCES `shaft` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=2858 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pants`
--

LOCK TABLES `pants` WRITE;
/*!40000 ALTER TABLE `pants` DISABLE KEYS */;
INSERT INTO `pants` VALUES (1,1,80,1,8,20,35,1,170,'pants/1.jpg',0,0,1),(2,2,260,2,10,48,212.725,3,250,'pants/2.jpg',0,0,1),(3,3,245,3,2,85,250,3,95,'pants/3.jpg',0,0,3),(42,NULL,185,3,6,55,156,1,171,'pants/622.gif',NULL,3,NULL),(43,NULL,200,3,6,92,90,2,188,'pants/623.gif',NULL,3,NULL),(44,NULL,NULL,1,4,36,102,1,NULL,NULL,NULL,NULL,NULL),(45,NULL,NULL,2,1,130,130,1,NULL,NULL,NULL,NULL,NULL),(46,NULL,200,1,8,92,72,2,188,'pants/406.gif',4,4,NULL),(47,NULL,NULL,1,2,55,80,1,NULL,NULL,NULL,NULL,NULL),(48,NULL,NULL,1,1,90,110,1,NULL,NULL,NULL,NULL,NULL),(49,NULL,NULL,1,5,22,30,1,NULL,NULL,NULL,NULL,NULL),(50,NULL,NULL,1,16,17,17,1,NULL,NULL,NULL,NULL,NULL),(51,NULL,NULL,2,3,26,42,1,NULL,NULL,NULL,NULL,NULL),(52,NULL,185,3,4,173,83,2,173,'pants/412.gif',NULL,4,NULL),(53,NULL,NULL,1,6,17,29,1,NULL,NULL,NULL,NULL,NULL),(54,NULL,215,3,9,64,90,1,200,'pants/414.gif',NULL,3,NULL),(55,NULL,180,1,4,80,147,1,165,'pants/415.gif',4,5,NULL),(56,NULL,225,2,6,103,103,2,210,'pants/416.gif',NULL,3,NULL),(57,NULL,NULL,1,12,30,30,1,NULL,NULL,NULL,NULL,NULL),(58,NULL,165,3,6,149,46,2,149,'pants/418.gif',NULL,5,NULL),(59,NULL,255,1,20,58,60,2,241,'pants/419.gif',2,4,NULL),(60,NULL,145,2,36,30,30,2,129,'pants/420.gif',NULL,4,NULL),(61,NULL,215,1,9,65,98,1,203,'pants/421.gif',2,4,NULL),(62,NULL,230,3,4,105,147,1,214,'pants/422.gif',NULL,5,NULL),(63,NULL,250,1,6,75,197,1,235,'pants/423.gif',2,5,NULL),(64,NULL,260,3,14,120,40,2,244,'pants/424.gif',NULL,4,NULL),(65,NULL,185,3,4,83,135,1,170,'pants/425.jpg',NULL,5,NULL),(66,NULL,NULL,1,8,35,59,1,NULL,NULL,NULL,NULL,NULL),(67,NULL,245,3,4,230,73,1,230,'pants/427.gif',NULL,3,NULL),(68,NULL,180,1,3,164,123,1,164,'pants/428.gif',6,4,NULL),(69,NULL,240,3,2,110,300,1,224,'pants/429.gif',NULL,5,NULL),(70,NULL,205,3,9,62,103,2,192,'pants/430.gif',NULL,3,NULL),(71,NULL,200,1,18,90,38,2,184,'pants/431.gif',2,4,NULL),(72,NULL,120,3,6,51,122,1,106,'pants/432.gif',NULL,5,NULL),(73,NULL,NULL,1,9,50,50,1,NULL,NULL,NULL,NULL,NULL),(74,NULL,NULL,1,4,59,32,1,NULL,NULL,NULL,NULL,NULL),(75,NULL,166,3,6,51,156,2,161,'pants/435.gif',NULL,3,NULL),(76,NULL,NULL,1,4,36,120,1,NULL,NULL,NULL,NULL,NULL),(77,NULL,165,1,2,150,211,1,150,'pants/437.gif',3,3,NULL),(78,NULL,165,1,1,165,381,1,165,'pants/438.gif',NULL,NULL,NULL),(79,NULL,260,3,3,245,99,2,245,'pants/439.gif',NULL,3,NULL),(80,NULL,280,1,25,52,52,2,270,'pants/440.gif',NULL,4,NULL),(81,NULL,210,3,6,62,205,2,194,'pants/441.gif',NULL,9,NULL),(82,NULL,145,3,4,59,156,2,121,'pants/442.gif',NULL,3,NULL),(83,NULL,NULL,1,4,16,25,1,NULL,NULL,NULL,NULL,NULL),(84,NULL,NULL,1,2,15,35,1,NULL,NULL,NULL,NULL,NULL),(85,NULL,150,3,6,72,128,1,133,'pants/445.gif',NULL,6,NULL),(86,NULL,140,2,3,128,128,1,128,'pants/446.gif',NULL,6,NULL),(87,NULL,155,2,4,140,73,1,140,'pants/447.gif',NULL,3,NULL),(88,NULL,180,3,12,129,46,1,166,'pants/448.gif',NULL,5,NULL),(89,NULL,120,3,4,167,65,1,106,'pants/449.gif',NULL,8,NULL),(90,NULL,195,1,40,43,25,2,181,'pants/450.gif',2,3,NULL),(91,NULL,165,3,3,151,98,2,151,'pants/451.gif',NULL,4,NULL),(92,NULL,170,3,3,155,118,2,155,'pants/452.gif',NULL,9,NULL),(93,NULL,170,3,3,155,118,2,155,'pants/453.gif',NULL,9,NULL),(94,NULL,175,3,6,160,58,2,160,'pants/454.gif',NULL,6,NULL),(95,NULL,245,3,12,55,110,2,229,'pants/455.gif',NULL,6,NULL),(96,NULL,200,3,12,60,64,1,186,'pants/456.gif',NULL,6,NULL),(97,NULL,185,3,6,55,156,2,173,'pants/457.gif',NULL,3,NULL),(98,NULL,195,1,15,58,53,2,180,'pants/458.gif',2,3,NULL),(99,NULL,195,1,18,58,43,2,180,'pants/459.gif',2,4,NULL),(100,NULL,235,3,8,108,75,1,220,'pants/460.gif',NULL,4,NULL),(101,NULL,245,1,12,55,100,2,229,'pants/461.gif',2,2,NULL),(102,NULL,275,3,4,128,136,1,259,'pants/462.gif',NULL,4,NULL),(103,NULL,NULL,2,3,25,25,1,NULL,NULL,NULL,NULL,NULL),(104,NULL,280,3,13,133,45,1,270,'pants/464.gif',NULL,3,NULL),(105,NULL,240,3,20,110,38,1,224,'pants/465.gif',NULL,2,NULL),(106,NULL,NULL,3,3,42,95,1,NULL,NULL,NULL,NULL,NULL),(107,NULL,NULL,2,1,150,150,1,NULL,NULL,NULL,NULL,NULL),(108,NULL,200,3,4,88,170,1,180,'pants/468.gif',NULL,5,NULL),(109,NULL,195,3,16,42,97,1,180,'pants/469.gif',NULL,4,NULL),(110,NULL,235,1,3,222,110,1,222,'pants/470.gif',3,6,NULL),(111,NULL,NULL,1,4,58,68,1,NULL,NULL,NULL,NULL,NULL),(112,NULL,NULL,1,1,120,100,1,NULL,NULL,NULL,NULL,NULL),(113,NULL,200,3,8,95,66,2,188,'pants/473.gif',NULL,4,NULL),(114,NULL,NULL,1,6,34,50,1,NULL,NULL,NULL,NULL,NULL),(115,NULL,250,1,8,115,85,1,234,'pants/475.gif',2,2,NULL),(116,NULL,240,1,2,110,370,2,224,'pants/476.gif',NULL,NULL,NULL),(117,NULL,175,3,8,79,67,2,162,'pants/477.gif',NULL,3,NULL),(118,NULL,230,3,6,105,89,2,214,'pants/478.gif',NULL,4,NULL),(119,NULL,210,3,6,62,166,2,194,'pants/479.gif',NULL,9,NULL),(120,NULL,185,3,10,83,60,2,170,'pants/480.gif',NULL,4,NULL),(121,NULL,165,3,4,74,198,2,153,'pants/481.gif',NULL,4,NULL),(122,NULL,200,3,6,90,112,2,184,'pants/482.gif',NULL,4,NULL),(123,NULL,240,3,4,111,136,1,225,'pants/483.gif',NULL,3,NULL),(124,NULL,245,3,12,75,84,2,233,'pants/484.gif',NULL,3,NULL),(125,NULL,210,3,4,97,195,2,198,'pants/485.gif',NULL,7,NULL),(126,NULL,190,3,6,87,131,2,178,'pants/486.gif',NULL,3,NULL),(127,NULL,225,3,8,103,73,2,210,'pants/487.gif',NULL,4,NULL),(128,NULL,210,3,9,61,90,1,191,'pants/488.gif',NULL,3,NULL),(129,NULL,175,3,6,160,47,1,160,'pants/489.gif',NULL,4,NULL),(130,NULL,210,3,8,96,75,1,196,'pants/490.gif',NULL,4,NULL),(131,NULL,120,1,24,25,55,2,109,'pants/491.gif',2,3,NULL),(132,NULL,180,3,4,165,67,1,165,'pants/492.gif',NULL,3,NULL),(133,NULL,NULL,2,6,17,17,1,NULL,NULL,NULL,NULL,NULL),(134,NULL,225,3,3,212,112,1,212,'pants/494.gif',NULL,4,NULL),(135,NULL,120,1,12,15,200,1,105,'pants/495.gif',NULL,2,NULL),(136,NULL,225,3,12,68,75,2,212,'pants/496.gif',NULL,4,NULL),(137,NULL,NULL,1,1,90,90,1,NULL,NULL,NULL,NULL,NULL),(138,NULL,240,3,6,110,100,1,224,'pants/498.gif',NULL,2,NULL),(139,NULL,135,3,1,120,398,1,120,'pants/499.gif',NULL,5,NULL),(140,NULL,260,3,6,121,104,1,246,'pants/500.gif',NULL,2,NULL),(141,NULL,195,3,4,182,68,2,182,'pants/501.gif',NULL,2,NULL),(142,NULL,220,3,6,102,102,2,208,'pants/502.gif',NULL,4,NULL),(143,NULL,NULL,1,4,75,75,1,NULL,NULL,NULL,NULL,NULL),(144,NULL,NULL,1,4,35,100,1,NULL,NULL,NULL,NULL,NULL),(145,NULL,160,3,14,72,40,1,148,'pants/505.gif',NULL,4,NULL),(146,NULL,NULL,3,3,50,43,1,NULL,NULL,NULL,NULL,NULL),(147,NULL,NULL,1,4,70,70,1,143,NULL,NULL,NULL,NULL),(148,NULL,215,3,6,65,185,1,203,'pants/508.gif',NULL,6,NULL),(149,NULL,225,3,6,68,185,2,212,'pants/509.gif',NULL,6,NULL),(150,NULL,160,1,10,27,136,1,147,'pants/510.gif',2,4,NULL),(151,NULL,225,3,6,68,199,2,212,'pants/511.gif',NULL,3,NULL),(152,NULL,260,1,35,45,40,2,245,'pants/512.gif',2,4,NULL),(153,NULL,200,3,6,60,160,2,188,'pants/513.gif',NULL,15,NULL),(154,NULL,265,3,6,123,108,1,250,'pants/514.gif',NULL,8,NULL),(155,NULL,265,1,12,60,113,2,252,'pants/515.gif',2,3,NULL),(156,NULL,175,3,5,160,60,2,160,'pants/516.gif',NULL,4,NULL),(157,NULL,260,1,12,60,113,2,246,'pants/517.gif',NULL,3,NULL),(158,NULL,260,3,20,58,78,1,244,'pants/518.gif',NULL,3,NULL),(159,NULL,215,3,6,65,199,2,203,'pants/519.gif',NULL,3,NULL),(160,NULL,NULL,1,9,14,43,1,NULL,NULL,NULL,NULL,NULL),(161,NULL,240,3,18,73,65,1,228,'pants/524.gif',NULL,2,NULL),(162,NULL,230,3,15,69,73,1,215,'pants/525.gif',NULL,3,NULL),(163,NULL,195,3,6,90,99,2,183,'pants/526.gif',NULL,3,NULL),(164,NULL,240,3,6,72,155,2,224,'pants/527.gif',NULL,4,NULL),(165,NULL,280,1,1,270,300,1,270,'pants/528.gif',5,5,NULL),(166,NULL,130,3,5,120,80,1,120,'pants/529.gif',NULL,6,NULL),(167,NULL,240,3,10,112,72,1,228,'pants/530.gif',NULL,4,NULL),(168,NULL,NULL,1,10,30,78,1,NULL,NULL,NULL,NULL,NULL),(169,NULL,NULL,1,4,32,70,1,NULL,NULL,NULL,NULL,NULL),(170,NULL,NULL,1,8,31,79,1,NULL,NULL,NULL,NULL,NULL),(171,NULL,275,1,24,40,74,1,260,'pants/3.gif',0,2,NULL),(172,NULL,255,1,15,44,123,1,240,'pants/4.gif',2,4,NULL),(173,NULL,265,3,10,46,149,1,250,'pants/5.gif',2,3,NULL),(174,NULL,205,3,20,92,32,1,190,'pants/1.jpg',0,NULL,NULL),(175,NULL,255,1,36,58,40,2,241,'pants/2.gif',2,2,NULL),(176,NULL,220,1,8,47,177,1,203,'pants/6.gif',0,14,NULL),(177,NULL,245,3,12,55,97,2,229,'pants/11.gif',0,5,NULL),(178,NULL,250,1,20,57,57,2,237,'pants/12.gif',2,4,NULL),(179,NULL,250,1,16,57,73,1,237,'pants/13.gif',0,3,NULL),(180,NULL,280,1,12,130,61,1,263,'pants/14.gif',2,3,NULL),(181,NULL,165,3,5,151,62,1,151,'pants/15.gif',0,8,NULL),(182,NULL,240,1,8,110,70,1,225,'pants/16.gif',2,6,NULL),(183,NULL,280,3,8,130,70,1,264,'pants/17.gif',0,6,NULL),(184,NULL,235,3,9,70,95,2,220,'pants/18.gif',0,7,NULL),(185,NULL,230,2,9,70,99,1,216,'pants/19.gif',0,3,NULL),(186,NULL,240,3,8,110,73,1,225,'pants/20.gif',0,3,NULL),(187,NULL,255,3,8,116,73,1,239,'pants/21.gif',0,3,NULL),(188,NULL,260,1,9,80,99,1,246,'pants/22.gif',2,3,NULL),(189,NULL,240,3,10,110,55,1,225,'pants/9.gif',0,6,NULL),(190,NULL,280,1,15,50,98,1,262,'pants/7.gif',3,4,NULL),(191,NULL,235,1,4,53,352,1,221,'pants/8.gif',2,10,NULL),(192,NULL,250,3,12,55,110,1,235,'pants/10.gif',0,6,NULL),(193,NULL,150,1,12,20,187,1,135,'pants/116.gif',2,4,NULL),(194,NULL,115,1,5,100,50,1,100,'pants/117.gif',2,6,NULL),(195,NULL,235,1,48,25,55,1,221,'pants/118.gif',2,3,NULL),(196,NULL,220,1,12,65,90,2,203,'pants/119.gif',3,5,NULL),(197,NULL,225,2,28,50,50,1,212,'pants/120.gif',0,4,NULL),(198,NULL,270,1,60,60,20,2,255,'pants/121.gif',2,3,NULL),(199,NULL,280,3,6,85,145,2,265,'pants/122.gif',0,7,NULL),(200,NULL,230,1,6,68,195,1,213,'pants/123.gif',3,7,NULL),(201,NULL,250,3,12,76,74,2,236,'pants/124.gif',0,2,NULL),(202,NULL,210,3,6,94,112,1,193,'pants/125.gif',0,4,NULL),(203,NULL,195,3,10,88,55,1,181,'pants/126.gif',0,6,NULL),(204,NULL,140,3,6,60,123,1,126,'pants/127.gif',2,4,NULL),(205,NULL,265,3,8,122,82,1,250,'pants/128.gif',4,5,NULL),(206,NULL,200,3,4,89,172,1,183,'pants/129.gif',0,3,NULL),(207,NULL,235,1,21,70,50,1,220,'pants/130.gif',3,4,NULL),(208,NULL,265,3,8,122,82,1,250,'pants/131.gif',2,5,NULL),(209,NULL,245,1,18,34,115,2,229,'pants/132.gif',3,2,NULL),(210,NULL,200,1,4,90,180,1,185,'pants/133.gif',2,11,NULL),(211,NULL,200,3,8,90,70,1,186,'pants/134.gif',0,6,NULL),(212,NULL,160,1,4,70,148,1,145,'pants/135.gif',2,4,NULL),(213,NULL,210,3,8,100,73,1,205,'pants/136.gif',2,3,NULL),(214,NULL,200,3,8,73,90,2,183,'pants/137.gif',0,5,NULL),(215,NULL,220,1,15,65,58,2,203,'pants/138.gif',2,3,NULL),(216,NULL,210,3,6,94,97,1,193,'pants/139.gif',2,5,NULL),(217,NULL,240,1,32,52,42,1,223,'pants/140.gif',2,2,NULL),(218,NULL,230,3,28,50,50,1,215,'pants/141.gif',2,4,NULL),(219,NULL,235,3,15,70,59,2,219,'pants/142.gif',2,2,NULL),(220,NULL,170,3,30,23,59,1,153,'pants/143.gif',0,2,NULL),(221,NULL,175,3,4,161,83,1,161,'pants/144.gif',0,4,NULL),(222,NULL,175,3,4,161,83,1,161,'pants/145.gif',0,4,NULL),(223,NULL,210,3,6,95,112,2,195,'pants/146.gif',2,4,NULL),(224,NULL,210,3,6,95,97,1,195,'pants/147.gif',2,5,NULL),(225,NULL,170,3,2,153,169,1,153,'pants/148.gif',0,6,NULL),(226,NULL,275,3,6,86,164,1,265,'pants/149.gif',0,11,NULL),(227,NULL,200,1,16,90,45,2,183,'pants/150.gif',2,3,NULL),(228,NULL,110,2,50,17,28,1,97,'pants/151.gif',0,2,NULL),(229,NULL,175,3,28,37,50,2,160,'pants/152.gif',0,4,NULL),(230,NULL,275,3,2,259,155,1,259,'pants/153.gif',0,20,NULL),(231,NULL,200,3,4,89,180,1,183,'pants/154.gif',0,11,NULL),(232,NULL,185,3,21,55,50,1,171,'pants/155.gif',0,4,NULL),(233,NULL,165,3,1,148,282,1,148,'pants/156.gif',0,22,NULL),(234,NULL,190,3,4,84,181,1,173,'pants/157.gif',0,9,NULL),(235,NULL,240,3,2,222,135,1,222,'pants/158.gif',0,17,NULL),(236,NULL,175,1,3,160,110,2,160,'pants/159.gif',8,6,NULL),(237,NULL,260,3,6,75,148,1,245,'pants/160.gif',0,4,NULL),(238,NULL,265,2,12,80,80,1,250,'pants/161.gif',0,7,NULL),(239,NULL,220,1,10,49,135,1,206,'pants/162.gif',2,5,NULL),(240,NULL,155,3,3,140,125,1,140,'pants/163.gif',0,2,NULL),(241,NULL,280,3,8,129,85,2,263,'pants/164.gif',0,2,NULL),(242,NULL,225,1,17,210,15,1,210,'pants/165.gif',1,3,NULL),(243,NULL,225,3,12,67,93,1,211,'pants/166.gif',0,3,NULL),(244,NULL,240,2,63,23,47,1,227,'pants/167.gif',0,3,NULL),(245,NULL,220,1,12,100,61,2,204,'pants/168.gif',1,3,NULL),(246,NULL,230,3,9,68,113,2,212,'pants/169.gif',2,3,NULL),(247,NULL,180,3,10,81,65,1,166,'pants/170.gif',0,5,NULL),(248,NULL,260,2,18,80,47,1,246,'pants/171.gif',0,4,NULL),(249,NULL,105,1,30,60,20,2,92,'pants/172.gif',1,3,NULL),(250,NULL,200,3,4,90,170,1,186,'pants/173.gif',0,5,NULL),(251,NULL,250,3,24,75,40,1,233,'pants/174.gif',0,4,NULL),(252,NULL,235,1,24,25,98,1,221,'pants/175.gif',2,4,NULL),(253,NULL,275,3,24,30,98,1,261,'pants/176.gif',2,4,NULL),(254,NULL,220,1,4,100,197,2,203,'pants/177.gif',4,5,NULL),(255,NULL,235,3,4,107,148,1,218,'pants/178.gif',3,4,NULL),(256,NULL,245,3,5,43,345,2,231,'pants/179.gif',0,4,NULL),(257,NULL,270,3,12,60,110,1,255,'pants/180.gif',0,6,NULL),(258,NULL,245,3,6,230,60,2,230,'pants/181.gif',2,4,NULL),(259,NULL,130,1,18,17,112,1,117,'pants/182.gif',2,4,NULL),(260,NULL,250,3,10,45,170,2,237,'pants/183.gif',0,5,NULL),(261,NULL,235,3,6,70,187,1,218,'pants/184.gif',4,4,NULL),(262,NULL,220,3,8,48,147,1,204,'pants/185.gif',3,5,NULL),(263,NULL,235,1,8,50,199,2,212,'pants/186.gif',2,3,NULL),(264,NULL,205,3,12,93,60,1,191,'pants/187.gif',2,4,NULL),(265,NULL,195,1,8,42,171,1,180,'pants/188.gif',2,4,NULL),(266,NULL,265,2,12,60,130,1,249,'pants/189.gif',0,4,NULL),(267,NULL,230,3,5,215,74,2,215,'pants/190.gif',0,2,NULL),(268,NULL,230,3,12,106,60,2,216,'pants/191.gif',NULL,4,NULL),(269,NULL,210,1,12,95,60,1,194,'pants/192.gif',2,4,NULL),(270,NULL,230,1,12,50,124,2,212,'pants/193.gif',2,3,NULL),(271,NULL,255,3,6,77,134,1,239,'pants/194.gif',NULL,6,NULL),(272,NULL,270,3,6,84,147,1,256,'pants/195.gif',NULL,6,NULL),(273,NULL,245,3,9,74,111,2,230,'pants/196.gif',NULL,5,NULL),(274,NULL,195,3,6,120,128,1,180,'pants/198.gif',NULL,6,NULL),(275,NULL,NULL,1,4,76,46,1,154,NULL,NULL,NULL,NULL),(276,NULL,NULL,2,2,83,83,1,168,NULL,NULL,NULL,NULL),(277,NULL,NULL,2,6,43,43,1,133,NULL,NULL,NULL,NULL),(278,NULL,NULL,3,8,32,51,1,133,NULL,NULL,NULL,NULL),(279,NULL,NULL,3,2,95,70,1,70,NULL,NULL,NULL,NULL),(280,NULL,NULL,1,2,63,101,1,128,NULL,NULL,NULL,NULL),(281,NULL,115,1,6,100,50,1,100,'pants/25.gif',2,4,NULL),(282,NULL,275,1,9,85,123,1,261,'pants/26.gif',2,4,NULL),(283,NULL,275,3,9,86,97,1,262,'pants/27.gif',0,5,NULL),(284,NULL,195,2,8,90,90,1,184,'pants/28.gif',0,5,NULL),(285,NULL,155,3,4,140,90,1,140,'pants/29.gif',2,5,NULL),(286,NULL,165,1,4,150,90,1,150,'pants/30.gif',8,5,NULL),(287,NULL,240,3,4,230,90,1,230,'pants/31.gif',0,5,NULL),(288,NULL,220,3,4,100,150,1,204,'pants/32.gif',3,2,NULL),(289,NULL,195,3,3,180,94,1,180,'pants/33.gif',0,8,NULL),(290,NULL,235,1,3,222,94,1,222,'pants/34.gif',2,8,NULL),(291,NULL,225,3,6,103,98,1,210,'pants/35.gif',0,4,NULL),(292,NULL,280,1,6,130,99,1,264,'pants/36.png',2,3,NULL),(293,NULL,220,1,6,100,110,1,205,'pants/37.gif',2,6,NULL),(294,NULL,250,3,6,115,110,1,234,'pants/38.gif',0,6,NULL),(295,NULL,260,2,6,120,120,1,245,'pants/39.gif',0,7,NULL),(296,NULL,245,3,3,230,120,1,230,'pants/40.gif',0,7,NULL),(297,NULL,180,1,3,164,123,1,164,'pants/41.gif',3,4,NULL),(298,NULL,200,1,2,190,149,1,190,'pants/42.gif',2,3,NULL),(299,NULL,195,2,2,180,180,1,180,'pants/43.gif',0,11,NULL),(300,NULL,265,2,1,250,250,1,250,'pants/44.gif',0,55,NULL),(301,NULL,210,3,6,89,123,1,195,'pants/45.gif',0,4,NULL),(302,NULL,225,1,6,68,187,1,212,'pants/46.gif',0,4,NULL),(303,NULL,160,3,2,147,143,1,147,'pants/47.gif',0,9,NULL),(304,NULL,215,1,6,100,99,1,203,'pants/48.gif',2,3,NULL),(305,NULL,280,2,36,42,61,2,267,'pants/49.gif',0,3,NULL),(306,NULL,140,3,3,115,124,1,115,'pants/50.gif',0,3,NULL),(307,NULL,200,3,8,90,72,1,184,'pants/51.gif',0,4,NULL),(308,NULL,260,1,3,80,275,1,246,'pants/52.gif',2,30,NULL),(309,NULL,250,1,2,116,344,1,236,'pants/53.gif',6,5,NULL),(310,NULL,265,1,8,60,148,1,249,'pants/54.gif',3,4,NULL),(311,NULL,220,1,14,100,50,1,204,'pants/55.gif',3,4,NULL),(312,NULL,230,2,6,105,105,1,214,'pants/56.gif',0,11,NULL),(313,NULL,215,1,24,30,74,1,210,'pants/57.gif',2,3,NULL),(314,NULL,250,3,12,56,111,1,236,'pants/58.gif',0,5,NULL),(315,NULL,180,1,4,100,50,1,100,'pants/59.gif',2,14,NULL),(316,NULL,200,2,18,60,60,1,187,'pants/60.gif',0,4,NULL),(317,NULL,240,2,15,74,74,1,228,'pants/61.gif',0,3,NULL),(318,NULL,200,3,26,92,25,1,188,'pants/62.gif',0,3,NULL),(319,NULL,250,1,20,45,84,2,237,'pants/63.gif',2,3,NULL),(320,NULL,250,3,24,57,48,2,237,'pants/64.gif',0,3,NULL),(321,NULL,230,1,12,70,92,1,216,'pants/65.gif',7,3,NULL),(322,NULL,280,1,4,130,187,1,264,'pants/66.gif',2,4,NULL),(323,NULL,230,1,9,70,124,1,216,'pants/67.gif',7,3,NULL),(324,NULL,150,3,4,136,80,1,136,'pants/68.gif',0,7,NULL),(325,NULL,180,2,8,80,80,1,164,'pants/69.gif',0,7,NULL),(326,NULL,170,3,4,75,148,1,164,'pants/70.gif',0,4,NULL),(327,NULL,235,1,4,53,352,1,221,'pants/71.gif',2,29,NULL),(328,NULL,230,1,18,68,60,2,221,'pants/72.gif',3,4,NULL),(329,NULL,250,1,36,58,30,2,241,'pants/73.gif',1,4,NULL),(330,NULL,155,1,16,70,45,2,143,'pants/74.gif',2,3,NULL),(331,NULL,225,1,15,40,100,1,212,'pants/75.gif',3,2,NULL),(332,NULL,250,3,12,56,110,1,236,'pants/76.gif',0,6,NULL),(333,NULL,250,1,12,57,110,1,237,'pants/77.gif',2,6,NULL),(334,NULL,245,1,16,55,80,2,232,'pants/78.gif',2,7,NULL),(335,NULL,260,2,9,80,116,1,248,'pants/79.gif',0,11,NULL),(336,NULL,265,2,6,80,140,1,248,'pants/80.gif',0,12,NULL),(337,NULL,280,2,12,65,95,1,269,'pants/81.gif',0,7,NULL),(338,NULL,280,2,15,50,100,1,266,'pants/82.gif',0,2,NULL),(339,NULL,275,1,8,63,149,1,261,'pants/83.gif',6,3,NULL),(340,NULL,155,1,5,140,70,1,140,'pants/84.gif',2,6,NULL),(341,NULL,270,3,6,82,187,1,254,'pants/85.gif',0,4,NULL),(342,NULL,230,3,6,70,140,1,216,'pants/86.gif',0,12,NULL),(343,NULL,225,3,15,68,67,1,210,'pants/87.gif',0,3,NULL),(344,NULL,205,1,96,30,20,2,190,'pants/88.gif',2,2,NULL),(345,NULL,165,3,12,50,80,1,151,'pants/89.gif',0,4,NULL),(346,NULL,225,3,8,74,120,1,213,'pants/90.gif',0,4,NULL),(347,NULL,275,3,8,62,185,2,260,'pants/91.gif',0,6,NULL),(348,NULL,215,1,9,200,30,1,200,'pants/92.gif',4,4,NULL),(349,NULL,220,3,8,100,72,1,204,'pants/93.gif',0,4,NULL),(350,NULL,255,1,24,58,60,2,241,'pants/94.gif',2,4,NULL),(351,NULL,190,3,4,85,171,1,174,'pants/95.gif',0,4,NULL),(352,NULL,220,3,12,100,80,1,205,'pants/96.gif',0,5,NULL),(353,NULL,190,1,21,58,40,1,174,'pants/97.gif',0,0,NULL),(354,NULL,220,3,12,100,80,1,205,'pants/98.gif',0,5,NULL),(355,NULL,220,1,12,100,55,2,203,'pants/99.gif',2,3,NULL),(356,NULL,245,3,12,74,82,1,230,'pants/100.gif',0,5,NULL),(357,NULL,160,3,14,70,70,2,144,'pants/101.gif',0,3,NULL),(358,NULL,220,3,15,67,59,2,207,'pants/102.gif',0,2,NULL),(359,NULL,240,1,9,74,99,2,228,'pants/103.gif',2,3,NULL),(360,NULL,225,1,21,68,53,2,210,'pants/104.gif',2,2,NULL),(361,NULL,270,1,12,82,82,2,253,'pants/105.gif',2,5,NULL),(362,NULL,200,3,8,90,90,1,184,'pants/106.gif',0,5,NULL),(363,NULL,230,1,12,68,68,2,212,'pants/107.gif',2,8,NULL),(364,NULL,220,1,4,100,150,1,203,'pants/108.gif',4,3,NULL),(365,NULL,140,3,7,122,40,1,122,'pants/109.gif',3,4,NULL),(366,NULL,140,3,4,60,165,1,124,'pants/110.gif',0,10,NULL),(367,NULL,235,1,9,70,95,2,218,'pants/111.gif',2,7,NULL),(368,NULL,255,1,12,58,122,1,241,'pants/112.gif',4,5,NULL),(369,NULL,280,1,15,50,99,2,266,'pants/113.gif',2,3,NULL),(370,NULL,220,2,6,100,100,2,205,'pants/114.gif',0,16,NULL),(371,NULL,235,3,6,107,115,2,220,'pants/115.gif',0,12,NULL),(372,NULL,260,1,12,59,90,2,245,'pants/199.gif',2,3,NULL),(373,NULL,180,3,8,80,80,1,165,'pants/200.gif',3,5,NULL),(374,NULL,225,3,12,67,75,1,211,'pants/201.gif',NULL,1,NULL),(375,NULL,170,3,6,76,129,1,157,'pants/202.gif',NULL,5,NULL),(376,NULL,220,3,6,205,62,1,205,'pants/203.gif',NULL,5,NULL),(377,NULL,210,3,4,95,185,2,195,'pants/204.gif',NULL,6,NULL),(378,NULL,260,1,16,58,80,2,244,'pants/205.gif',2,7,NULL),(379,NULL,210,1,6,95,97,1,195,'pants/206.gif',2,5,NULL),(380,NULL,230,1,28,50,50,1,215,'pants/207.gif',2,4,NULL),(381,NULL,210,1,6,95,112,1,195,'pants/208.gif',2,4,NULL),(382,NULL,220,1,4,100,150,1,205,'pants/209.gif',3,2,NULL),(383,NULL,170,3,2,156,136,1,156,'pants/210.gif',NULL,4,NULL),(384,NULL,205,3,6,62,185,2,192,'pants/211.gif',NULL,6,NULL),(385,NULL,230,3,8,105,83,1,214,'pants/212.gif',NULL,4,NULL),(386,NULL,210,1,42,25,44,2,193,'pants/213.gif',1,3,NULL),(387,NULL,260,1,4,120,147,1,245,'pants/214.gif',2,5,NULL),(388,NULL,170,3,6,156,59,2,156,'pants/216.gif',NULL,5,NULL),(389,NULL,155,3,3,141,119,1,141,'pants/217.gif',NULL,8,NULL),(390,NULL,200,1,10,90,68,1,184,'pants/218.gif',7,2,NULL),(391,NULL,200,1,3,184,110,1,184,'pants/219.gif',12,6,NULL),(392,NULL,185,3,16,40,92,1,169,'pants/220.gif',NULL,3,NULL),(393,NULL,NULL,3,4,74,46,1,150,NULL,NULL,NULL,NULL),(394,NULL,NULL,1,4,78,45,1,139,NULL,NULL,NULL,NULL),(395,NULL,NULL,1,2,110,70,1,142,NULL,NULL,NULL,NULL),(396,NULL,NULL,1,10,60,30,1,158,NULL,NULL,NULL,NULL),(397,NULL,NULL,2,3,45,23,1,73,NULL,NULL,NULL,NULL),(398,NULL,NULL,2,2,67,67,1,136,NULL,NULL,NULL,NULL),(399,NULL,NULL,1,8,36,12,1,150,NULL,NULL,NULL,NULL),(400,NULL,NULL,1,2,85,60,1,122,NULL,NULL,NULL,NULL),(401,NULL,160,3,4,145,81,1,145,'pants/23.gif',0,6,NULL),(402,NULL,270,1,3,82,270,1,252,'pants/24.gif',2,6,NULL),(403,NULL,200,3,12,58,65,2,184,'pants/229.gif',NULL,5,NULL),(404,NULL,0,1,0,0,0,1,0,NULL,NULL,NULL,NULL),(405,NULL,NULL,3,1,91,125,1,125,NULL,NULL,NULL,NULL),(406,NULL,NULL,3,2,79,80,1,163,NULL,NULL,NULL,NULL),(407,NULL,NULL,1,16,20,30,1,126,NULL,NULL,NULL,NULL),(408,NULL,NULL,2,4,50,77,1,102,NULL,NULL,NULL,NULL),(409,NULL,NULL,1,9,43,51,1,157,NULL,NULL,NULL,NULL),(410,NULL,NULL,1,1,111,167,1,167,NULL,NULL,NULL,NULL),(411,NULL,NULL,1,8,25,32,1,134,NULL,NULL,NULL,NULL),(412,NULL,NULL,3,2,103,62,1,127,NULL,NULL,NULL,NULL),(413,NULL,NULL,1,6,118,19,1,124,NULL,NULL,NULL,NULL),(414,NULL,NULL,1,2,130,60,1,122,NULL,NULL,NULL,NULL),(415,NULL,NULL,1,9,40,50,1,154,NULL,NULL,NULL,NULL),(416,NULL,NULL,1,2,80,45,1,92,NULL,NULL,NULL,NULL),(417,NULL,NULL,1,12,32,48,1,148,NULL,NULL,NULL,NULL),(418,NULL,NULL,1,2,142,70,1,142,NULL,NULL,NULL,NULL),(419,NULL,NULL,1,3,38,126,1,126,NULL,NULL,NULL,NULL),(420,NULL,NULL,1,1,120,160,1,160,NULL,NULL,NULL,NULL),(421,NULL,NULL,1,6,19,49,1,100,NULL,NULL,NULL,NULL),(422,NULL,NULL,1,9,25,44,1,136,NULL,NULL,NULL,NULL),(423,NULL,NULL,1,2,90,65,1,132,NULL,NULL,NULL,NULL),(424,NULL,NULL,1,3,40,140,1,140,NULL,NULL,NULL,NULL),(425,NULL,NULL,2,1,77,77,1,77,NULL,NULL,NULL,NULL),(426,NULL,NULL,1,6,80,39,1,121,NULL,NULL,NULL,NULL),(427,NULL,NULL,1,2,95,60,1,122,NULL,NULL,NULL,NULL),(428,NULL,NULL,1,1,80,100,1,100,NULL,NULL,NULL,NULL),(429,NULL,NULL,2,2,63,63,1,130,NULL,NULL,NULL,NULL),(430,NULL,NULL,1,2,100,78,1,158,NULL,NULL,NULL,NULL),(431,NULL,NULL,1,4,45,68,1,138,NULL,NULL,NULL,NULL),(432,NULL,NULL,1,4,50,63,1,104,NULL,NULL,NULL,NULL),(433,NULL,NULL,1,1,110,130,1,130,NULL,NULL,NULL,NULL),(434,NULL,NULL,1,4,40,74,1,150,NULL,NULL,NULL,NULL),(435,NULL,NULL,1,6,24,40,1,124,NULL,NULL,NULL,NULL),(436,NULL,NULL,1,2,34,65,1,132,NULL,NULL,NULL,NULL),(437,NULL,NULL,1,2,70,100,1,144,NULL,NULL,NULL,NULL),(438,NULL,NULL,1,2,58,137,1,137,NULL,NULL,NULL,NULL),(439,NULL,NULL,1,2,89,60,1,122,NULL,NULL,NULL,NULL),(440,NULL,NULL,1,12,35,20,1,130,NULL,NULL,NULL,NULL),(441,NULL,NULL,3,2,98,56,1,114,NULL,NULL,NULL,NULL),(442,NULL,NULL,1,8,35,78,1,158,NULL,NULL,NULL,NULL),(443,NULL,NULL,1,6,61,48,1,148,NULL,NULL,NULL,NULL),(444,NULL,NULL,1,4,56,56,1,114,NULL,NULL,NULL,NULL),(445,NULL,NULL,1,4,40,56,1,116,NULL,NULL,NULL,NULL),(446,NULL,NULL,1,9,28,50,1,154,NULL,NULL,NULL,NULL),(447,NULL,NULL,1,6,90,22,1,142,NULL,NULL,NULL,NULL),(448,NULL,NULL,1,12,23,61,1,124,NULL,NULL,NULL,NULL),(449,NULL,NULL,1,5,25,70,1,132,NULL,NULL,NULL,NULL),(450,NULL,NULL,1,24,20,11,1,86,NULL,NULL,NULL,NULL),(451,NULL,NULL,1,4,39,59,1,120,NULL,NULL,NULL,NULL),(452,NULL,NULL,1,2,90,50,1,102,NULL,NULL,NULL,NULL),(453,NULL,NULL,1,2,68,98,1,140,NULL,NULL,NULL,NULL),(454,NULL,NULL,1,2,50,120,1,120,NULL,NULL,NULL,NULL),(455,NULL,NULL,1,2,59,43,1,120,NULL,NULL,NULL,NULL),(456,NULL,NULL,1,4,53,62,1,126,NULL,NULL,NULL,NULL),(457,NULL,NULL,1,3,96,50,1,154,NULL,NULL,NULL,NULL),(458,NULL,NULL,1,2,100,74,1,151,NULL,NULL,NULL,NULL),(459,NULL,NULL,1,2,85,80,1,162,NULL,NULL,NULL,NULL),(460,NULL,NULL,1,2,130,70,1,142,NULL,NULL,NULL,NULL),(461,NULL,NULL,1,2,90,74,1,150,NULL,NULL,NULL,NULL),(462,NULL,NULL,1,6,32,65,1,132,NULL,NULL,NULL,NULL),(463,NULL,NULL,1,1,149,103,1,149,NULL,NULL,NULL,NULL),(464,NULL,NULL,2,1,90,90,1,90,NULL,NULL,NULL,NULL),(465,NULL,NULL,1,6,70,55,1,169,NULL,NULL,NULL,NULL),(466,NULL,NULL,1,3,18,75,1,75,NULL,NULL,NULL,NULL),(467,NULL,NULL,1,2,57,75,1,152,NULL,NULL,NULL,NULL),(468,NULL,NULL,1,1,92,100,1,100,NULL,NULL,NULL,NULL),(469,NULL,NULL,1,4,40,170,1,170,NULL,NULL,NULL,NULL),(470,NULL,NULL,2,2,100,72,1,146,NULL,NULL,NULL,NULL),(471,NULL,NULL,1,2,60,111,1,111,NULL,NULL,NULL,NULL),(472,NULL,NULL,1,2,118,60,1,122,NULL,NULL,NULL,NULL),(473,NULL,NULL,1,6,70,12,1,142,NULL,NULL,NULL,NULL),(474,NULL,NULL,1,1,80,90,1,90,NULL,NULL,NULL,NULL),(475,NULL,NULL,1,3,90,25,1,79,NULL,NULL,NULL,NULL),(476,NULL,NULL,3,2,111,60,1,122,NULL,NULL,NULL,NULL),(477,NULL,NULL,3,2,77,100,1,157,NULL,NULL,NULL,NULL),(478,NULL,NULL,1,4,85,55,1,172,NULL,NULL,NULL,NULL),(479,NULL,NULL,1,8,60,35,1,146,NULL,NULL,NULL,NULL),(480,NULL,NULL,1,2,74,78,1,158,NULL,NULL,NULL,NULL),(481,NULL,NULL,1,6,42,42,1,130,NULL,NULL,NULL,NULL),(482,NULL,NULL,1,8,60,32,1,134,NULL,NULL,NULL,NULL),(483,NULL,NULL,1,2,41,69,1,140,NULL,NULL,NULL,NULL),(484,NULL,NULL,1,4,60,78,1,158,NULL,NULL,NULL,NULL),(485,NULL,NULL,2,2,95,63,1,128,NULL,NULL,NULL,NULL),(486,NULL,NULL,1,4,35,70,1,142,NULL,NULL,NULL,NULL),(487,NULL,NULL,1,6,50,76,1,154,NULL,NULL,NULL,NULL),(488,NULL,NULL,1,6,76,55,1,169,NULL,NULL,NULL,NULL),(489,NULL,NULL,1,2,140,82,1,166,NULL,NULL,NULL,NULL),(490,NULL,NULL,1,1,110,160,1,160,NULL,NULL,NULL,NULL),(491,NULL,NULL,3,8,59,41,1,170,NULL,NULL,NULL,NULL),(492,NULL,NULL,1,1,62,53,1,165,NULL,NULL,NULL,NULL),(493,NULL,NULL,1,3,100,55,1,169,NULL,NULL,NULL,NULL),(494,NULL,NULL,1,8,34,33,1,142,NULL,NULL,NULL,NULL),(495,NULL,NULL,1,2,114,86,1,174,NULL,NULL,NULL,NULL),(496,NULL,NULL,1,2,105,74,1,150,NULL,NULL,NULL,NULL),(497,NULL,NULL,1,10,42,17,1,93,NULL,NULL,NULL,NULL),(498,NULL,NULL,1,4,55,77,1,156,NULL,NULL,NULL,NULL),(499,NULL,NULL,1,8,59,35,1,146,NULL,NULL,NULL,NULL),(500,NULL,NULL,1,8,42,77,1,156,NULL,NULL,NULL,NULL),(501,NULL,NULL,1,2,84,74,1,150,NULL,NULL,NULL,NULL),(502,NULL,NULL,1,1,132,102,1,132,NULL,NULL,NULL,NULL),(503,NULL,NULL,1,6,30,50,1,154,NULL,NULL,NULL,NULL),(504,NULL,NULL,1,2,74,42,1,86,NULL,NULL,NULL,NULL),(505,NULL,NULL,1,2,74,74,1,150,NULL,NULL,NULL,NULL),(506,NULL,NULL,2,125,30,60,1,126,NULL,NULL,NULL,NULL),(507,NULL,NULL,1,2,90,70,1,142,NULL,NULL,NULL,NULL),(508,NULL,NULL,1,2,145,80,1,162,NULL,NULL,NULL,NULL),(509,NULL,NULL,3,6,75,46,1,142,NULL,NULL,NULL,NULL),(510,NULL,NULL,2,4,60,40,1,124,NULL,NULL,NULL,NULL),(511,NULL,NULL,1,2,44,36,1,74,NULL,NULL,NULL,NULL),(512,NULL,280,1,8,130,90,1,265,'pants/344.gif',8,5,NULL),(513,NULL,250,3,12,75,93,1,233,'pants/345.gif',NULL,3,NULL),(514,NULL,260,3,9,80,122,1,247,'pants/346.gif',NULL,5,NULL),(515,NULL,270,3,3,83,370,1,257,'pants/347.gif',NULL,11,NULL),(516,NULL,265,3,8,60,148,1,252,'pants/348.gif',NULL,4,NULL),(517,NULL,185,3,6,83,90,1,170,'pants/349.gif',NULL,3,NULL),(518,NULL,260,3,16,60,98,2,247,'pants/350.gif',NULL,3,NULL),(519,NULL,205,3,6,62,150,2,192,'pants/351.gif',NULL,2,NULL),(520,NULL,200,3,8,44,137,2,185,'pants/352.gif',NULL,3,NULL),(521,NULL,NULL,1,2,15,50,1,103,NULL,NULL,NULL,NULL),(522,NULL,NULL,3,6,36,36,1,115,NULL,NULL,NULL,NULL),(523,NULL,NULL,2,2,52,52,1,106,NULL,NULL,NULL,NULL),(524,NULL,NULL,1,1,95,95,1,95,NULL,NULL,NULL,NULL),(525,NULL,NULL,3,2,70,140,1,70,NULL,NULL,NULL,NULL),(526,NULL,NULL,1,8,30,20,1,88,NULL,NULL,NULL,NULL),(527,NULL,275,3,5,260,73,2,260,'pants/359.gif',NULL,3,NULL),(528,NULL,200,3,20,35,65,2,187,'pants/360.gif',NULL,5,NULL),(529,NULL,225,3,9,68,122,1,212,'pants/361.gif',NULL,5,NULL),(530,NULL,NULL,1,2,110,80,1,164,NULL,NULL,NULL,NULL),(531,NULL,NULL,1,2,30,75,1,NULL,NULL,NULL,NULL,NULL),(532,NULL,220,3,15,65,65,1,202,'pants/364.gif',NULL,5,NULL),(533,NULL,220,3,4,102,138,1,208,'pants/365.gif',NULL,2,NULL),(534,NULL,NULL,1,6,34,50,1,NULL,NULL,NULL,NULL,NULL),(535,NULL,NULL,1,12,17,23,1,NULL,NULL,NULL,NULL,NULL),(536,NULL,NULL,1,7,20,158,1,NULL,NULL,NULL,NULL,NULL),(537,NULL,NULL,1,1,95,110,1,NULL,NULL,NULL,NULL,NULL),(538,NULL,NULL,1,1,93,135,1,NULL,NULL,NULL,NULL,NULL),(539,NULL,200,3,20,45,51,1,188,'pants/371.gif',NULL,5,NULL),(540,NULL,220,1,2,100,276,2,204,'pants/372.gif',2,3,NULL),(541,NULL,240,3,10,111,74,2,225,'pants/373.gif',NULL,2,NULL),(542,NULL,166,3,9,52,99,2,162,'pants/374.gif',NULL,3,NULL),(543,NULL,240,3,3,73,300,2,227,'pants/375.gif',NULL,5,NULL),(544,NULL,NULL,1,9,30,40,1,NULL,NULL,NULL,NULL,NULL),(545,NULL,200,3,4,90,199,2,184,'pants/377.gif',NULL,3,NULL),(546,NULL,NULL,1,9,25,40,1,NULL,NULL,NULL,NULL,NULL),(547,NULL,220,1,9,65,96,1,203,'pants/379.gif',2,6,NULL),(548,NULL,NULL,2,12,30,30,1,NULL,NULL,NULL,NULL,NULL),(549,NULL,165,1,3,149,99,2,149,'pants/381.gif',2,3,NULL),(550,NULL,100,3,2,84,136,1,84,'pants/382.gif',NULL,4,NULL),(551,NULL,165,3,16,73,32,2,149,'pants/383.gif',NULL,3,NULL),(552,NULL,210,1,8,47,197,1,197,'pants/384.gif',2,5,NULL),(553,NULL,NULL,1,1,70,103,1,NULL,NULL,NULL,NULL,NULL),(554,NULL,NULL,1,16,35,35,1,NULL,NULL,NULL,NULL,NULL),(555,NULL,150,2,2,135,135,1,135,'pants/387.gif',NULL,5,NULL),(556,NULL,NULL,1,28,9,20,1,NULL,NULL,NULL,NULL,NULL),(557,NULL,NULL,1,2,77,80,1,NULL,NULL,NULL,NULL,NULL),(558,NULL,NULL,1,4,55,75,1,NULL,NULL,NULL,NULL,NULL),(559,NULL,NULL,1,8,25,80,1,NULL,NULL,NULL,NULL,NULL),(560,NULL,180,1,4,80,195,1,165,'pants/392.gif',2,7,NULL),(561,NULL,155,3,4,141,65,2,141,'pants/393.gif',NULL,5,NULL),(562,NULL,180,1,12,52,70,1,164,'pants/394.gif',2,6,NULL),(563,NULL,NULL,2,4,35,48,1,NULL,NULL,NULL,NULL,NULL),(564,NULL,150,3,1,125,302,1,125,'pants/396.gif',NULL,3,NULL),(565,NULL,195,3,10,89,76,1,183,'pants/397.gif',NULL,5,NULL),(566,NULL,210,3,6,64,137,2,197,'pants/398.gif',NULL,3,NULL),(567,NULL,NULL,1,1,82,130,1,NULL,NULL,NULL,NULL,NULL),(568,NULL,230,1,20,52,52,2,214,'pants/400.gif',NULL,4,NULL),(569,NULL,240,3,6,110,89,2,224,'pants/401.gif',NULL,4,NULL),(570,NULL,145,3,3,130,109,2,130,'pants/402.gif',NULL,7,NULL),(571,NULL,170,3,9,50,114,2,156,'pants/403.gif',NULL,2,NULL),(572,NULL,200,3,16,45,67,2,189,'pants/534.gif',NULL,3,NULL),(573,NULL,160,1,5,145,73,2,145,'pants/535.gif',2,3,NULL),(574,NULL,155,3,12,70,55,1,143,'pants/536.gif',NULL,3,NULL),(575,NULL,155,1,2,140,170,3,140,'pants/537.gif',3,5,NULL),(576,NULL,280,3,16,65,73,2,269,'pants/538.gif',NULL,3,NULL),(577,NULL,200,3,24,45,50,1,189,'pants/539.gif',NULL,3,NULL),(578,NULL,NULL,1,3,45,93,1,NULL,NULL,NULL,NULL,NULL),(579,NULL,280,1,24,20,187,1,271,'pants/541.gif',2,4,NULL),(580,NULL,NULL,1,1,105,148,1,NULL,NULL,NULL,NULL,NULL),(581,NULL,275,3,6,85,154,2,263,'pants/543.gif',NULL,5,NULL),(582,NULL,205,3,8,52,156,2,188,'pants/544.gif',NULL,3,NULL),(583,NULL,200,1,2,92,296,1,188,'pants/545.gif',3,9,NULL),(584,NULL,NULL,1,6,40,19,1,NULL,NULL,NULL,NULL,NULL),(585,NULL,NULL,1,12,50,19,1,NULL,NULL,NULL,NULL,NULL),(586,NULL,200,3,20,45,51,1,188,'pants/548.gif',NULL,5,NULL),(587,NULL,240,2,3,227,103,2,228,'pants/549.gif',NULL,3,NULL),(588,NULL,180,3,4,165,75,1,165,'pants/550.gif',NULL,4,NULL),(589,NULL,170,3,18,50,43,1,157,'pants/551.gif',NULL,4,NULL),(590,NULL,NULL,1,8,20,90,1,NULL,NULL,NULL,NULL,NULL),(591,NULL,NULL,1,8,13,34,1,NULL,NULL,NULL,NULL,NULL),(592,NULL,220,3,30,39,43,1,207,'pants/554.gif',NULL,4,NULL),(593,NULL,255,1,15,80,60,2,247,'pants/555.gif',2,4,NULL),(594,NULL,NULL,2,5,20,20,1,NULL,NULL,NULL,NULL,NULL),(595,NULL,150,3,4,67,146,1,137,'pants/557.gif',NULL,6,NULL),(596,NULL,180,3,6,80,140,1,164,'pants/558.gif',NULL,3,NULL),(597,NULL,NULL,1,3,40,85,1,NULL,NULL,NULL,NULL,NULL),(598,NULL,240,3,6,54,223,1,223,'pants/560.gif',NULL,3,NULL),(599,NULL,220,3,4,100,150,1,204,'pants/561.gif',NULL,2,NULL),(600,NULL,210,3,6,95,112,1,194,'pants/562.gif',NULL,4,NULL),(601,NULL,210,3,8,95,97,1,194,'pants/563.gif',NULL,4,NULL),(602,NULL,225,3,24,50,50,1,212,'pants/564.gif',NULL,3,NULL),(603,NULL,280,3,18,88,55,1,270,'pants/565.gif',NULL,3,NULL),(604,NULL,NULL,3,3,102,45,1,NULL,NULL,NULL,NULL,NULL),(605,NULL,160,3,6,146,67,1,146,'pants/567.gif',NULL,4,NULL),(606,NULL,160,3,6,146,67,1,146,'pants/568.gif',NULL,4,NULL),(607,NULL,265,3,10,123,71,1,252,'pants/569.gif',NULL,5,NULL),(608,NULL,245,1,6,75,136,2,233,'pants/570.gif',NULL,4,NULL),(609,NULL,245,3,8,110,75,1,224,'pants/571.gif',NULL,4,NULL),(610,NULL,205,1,2,190,210,1,190,'pants/572.gif',3,4,NULL),(611,NULL,230,1,27,70,30,2,216,'pants/573.gif',NULL,4,NULL),(612,NULL,185,1,76,40,12,2,169,'pants/574.gif',2,3,NULL),(613,NULL,190,1,68,42,15,2,180,'pants/575.gif',2,3,NULL),(614,NULL,195,1,40,43,25,2,181,'pants/576.gif',2,3,NULL),(615,NULL,220,1,40,50,25,2,209,'pants/577.gif',2,3,NULL),(616,NULL,280,1,32,65,45,1,269,'pants/578.gif',NULL,3,NULL),(617,NULL,275,3,6,85,148,1,263,'pants/579.gif',NULL,4,NULL),(618,NULL,NULL,1,2,77,70,1,NULL,NULL,NULL,NULL,NULL),(619,NULL,215,1,3,200,113,1,200,'pants/581.gif',3,3,NULL),(620,NULL,280,1,8,65,135,2,269,'pants/582.gif',2,5,NULL),(621,NULL,235,1,8,53,187,2,221,'pants/583.gif',2,4,NULL),(622,NULL,230,3,12,70,85,1,218,'pants/584.gif',NULL,2,NULL),(623,NULL,225,3,9,68,124,2,212,'pants/585.gif',NULL,3,NULL),(624,NULL,280,3,12,87,73,2,268,'pants/586.gif',NULL,3,NULL),(625,NULL,195,3,6,89,100,2,182,'pants/587.gif',NULL,2,NULL),(626,NULL,235,3,8,52,170,2,220,'pants/588.gif',NULL,5,NULL),(627,NULL,255,1,20,58,61,2,241,'pants/589.gif',2,3,NULL),(628,NULL,175,3,4,160,65,2,160,'pants/590.gif',NULL,5,NULL),(629,NULL,160,3,6,146,67,1,146,'pants/591.gif',NULL,4,NULL),(630,NULL,240,1,10,110,65,2,224,'pants/592.gif',3,5,NULL),(631,NULL,175,1,3,160,110,2,160,'pants/593.gif',8,6,NULL),(632,NULL,260,3,8,58,162,2,244,'pants/594.gif',NULL,13,NULL),(633,NULL,260,1,12,59,91,2,245,'pants/595.gif',2,3,NULL),(634,NULL,230,3,4,112,211,2,215,'pants/596.gif',NULL,3,NULL),(635,NULL,120,1,24,15,71,1,105,'pants/597.gif',2,5,NULL),(636,NULL,200,1,8,90,85,2,184,'pants/598.gif',1,2,NULL),(637,NULL,180,1,12,82,47,2,168,'pants/599.gif',1,4,NULL),(638,NULL,180,3,5,164,75,2,164,'pants/600.gif',NULL,NULL,NULL),(639,NULL,280,1,6,130,90,2,264,'pants/601.gif',2,3,NULL),(640,NULL,155,1,3,140,100,2,140,'pants/602.gif',2,6,NULL),(641,NULL,260,1,24,80,45,2,248,'pants/603.gif',2,3,NULL),(642,NULL,280,3,14,134,46,2,272,'pants/604.gif',NULL,4,NULL),(643,NULL,160,3,6,144,50,2,144,'pants/605.gif',NULL,3,NULL),(644,NULL,160,3,6,144,50,2,144,'pants/606.gif',NULL,3,NULL),(645,NULL,110,2,32,21,34,1,96,'pants/607.gif',NULL,4,NULL),(646,NULL,245,3,8,55,210,1,232,'pants/608.gif',NULL,4,NULL),(647,NULL,255,3,2,18,300,1,240,'pants/609.gif',NULL,5,NULL),(648,NULL,275,3,3,85,300,1,263,'pants/610.gif',NULL,5,NULL),(649,NULL,215,3,6,99,99,1,99,'pants/611.gif',NULL,3,NULL),(650,NULL,270,2,9,83,112,2,256,'pants/612.gif',NULL,4,NULL),(651,NULL,275,1,18,85,64,2,263,'pants/613.gif',2,3,NULL),(652,NULL,270,3,15,82,82,1,254,'pants/614.gif',NULL,4,NULL),(653,NULL,220,3,4,110,198,2,204,'pants/615.gif',NULL,4,NULL),(654,NULL,250,3,18,77,69,1,237,'pants/616.gif',NULL,2,NULL),(655,NULL,280,3,6,87,137,1,269,'pants/617.gif',NULL,3,NULL),(656,NULL,160,1,2,70,252,1,144,'pants/618.gif',NULL,4,NULL),(657,NULL,155,1,2,68,216,1,140,'pants/619.gif',4,25,NULL),(658,NULL,235,3,6,110,90,1,223,'pants/620.gif',NULL,3,NULL),(659,NULL,160,3,3,145,89,1,145,'pants/621.gif',NULL,4,NULL),(660,NULL,185,1,56,40,22,1,168,'pants/928.gif',NULL,3,NULL),(661,NULL,260,3,12,60,95,1,252,'pants/956.gif',NULL,4,NULL),(662,NULL,160,3,3,145,88,1,145,'pants/959.gif',NULL,4,NULL),(663,NULL,195,3,6,88,110,1,179,'pants/969.gif',NULL,6,NULL),(664,NULL,275,1,8,30,250,1,261,'pants/977.png',NULL,4,NULL),(665,NULL,250,1,20,58,80,1,241,'pants/978.png',NULL,4,NULL),(666,NULL,NULL,1,20,16,20,1,88,NULL,NULL,NULL,NULL),(667,NULL,265,1,1,250,250,1,250,'pants/994.gif',NULL,4,NULL),(668,NULL,195,3,10,72,90,1,183,'pants/995.png',NULL,4,NULL),(669,NULL,130,1,40,27,27,1,117,'pants/1013.png',NULL,3,NULL),(670,NULL,245,1,12,55,75,1,229,'pants/1022.gif',NULL,4,NULL),(671,NULL,175,1,12,37,112,1,157,'pants/1023.gif',NULL,5,NULL),(672,NULL,240,3,3,95,222,1,222,'pants/1024.png',NULL,7,NULL),(673,NULL,185,3,4,110,84,1,170,'pants/1025.gif',NULL,4,NULL),(674,NULL,100,3,14,42,41,1,87,'pants/1027.png',NULL,3,NULL),(675,NULL,270,3,20,61,81,1,256,'pants/1029.png',NULL,5,NULL),(676,NULL,265,1,2,124,245,1,251,'pants/1031.png',NULL,3,NULL),(677,NULL,200,3,6,60,180,1,186,'pants/1036.gif',NULL,11,NULL),(678,NULL,160,1,20,27,65,1,147,'pants/1037.gif',NULL,2,NULL),(679,NULL,175,1,20,30,84,1,162,'pants/1038.gif',NULL,3,NULL),(680,NULL,245,3,3,75,222,1,231,'pants/1039.gif',NULL,7,NULL),(681,NULL,170,1,14,75,30,1,153,'pants/1042.gif',NULL,3,NULL),(682,NULL,240,3,4,112,177,1,227,'pants/1043.gif',NULL,4,NULL),(683,NULL,260,3,6,80,120,1,246,'pants/1044.gif',NULL,4,NULL),(684,NULL,260,1,8,120,70,1,243,'pants/1045.gif',NULL,6,NULL),(685,NULL,175,3,16,38,83,1,161,'pants/1048.gif',NULL,4,NULL),(686,NULL,260,1,2,120,235,1,243,'pants/1055.png',NULL,3,NULL),(687,NULL,190,3,14,85,43,1,173,'pants/1064.gif',NULL,3,NULL),(688,NULL,265,3,10,124,58,1,251,'pants/1068.gif',NULL,3,NULL),(689,NULL,235,1,40,25,60,1,217,'pants/1069.gif',NULL,4,NULL),(690,NULL,270,1,2,127,240,1,257,'pants/1072.png',NULL,8,NULL),(691,NULL,150,1,1,135,270,1,135,'pants/1075.png',NULL,9,NULL),(692,NULL,275,1,6,84,177,1,258,'pants/1076.png',NULL,4,NULL),(693,NULL,200,1,27,60,30,1,186,'pants/1077.gif',NULL,4,NULL),(694,NULL,260,3,18,80,50,1,246,'pants/1078.gif',NULL,3,NULL),(695,NULL,125,1,24,25,38,1,109,'pants/1079.gif',NULL,3,NULL),(696,NULL,210,3,6,95,120,1,193,'pants/1080.png',NULL,7,NULL),(697,NULL,155,1,5,137,61,1,137,'pants/1083.png',NULL,3,NULL),(698,NULL,215,1,1,200,300,1,200,'pants/1092.gif',NULL,5,NULL),(699,NULL,165,1,2,74,257,1,151,'pants/1094.gif',NULL,13,NULL),(700,NULL,125,3,14,112,30,1,112,'pants/1095.gif',NULL,4,NULL),(701,NULL,170,3,4,77,210,1,157,'pants/1103.gif',NULL,4,NULL),(702,NULL,160,1,6,46,170,1,144,'pants/1110.gif',NULL,5,NULL),(703,NULL,160,3,15,47,63,1,147,'pants/1112.gif',NULL,3,NULL),(704,NULL,225,1,1,210,290,1,210,'pants/1113.gif',NULL,8,NULL),(705,NULL,235,3,9,73,120,1,223,'pants/1118.gif',NULL,7,NULL),(706,NULL,150,1,12,20,150,2,135,'pants/1119.gif',NULL,2,NULL),(707,NULL,210,1,12,30,150,2,195,'pants/1120.gif',NULL,2,NULL),(708,NULL,220,3,9,66,123,1,204,'pants/1122.gif',NULL,4,NULL),(709,NULL,160,1,6,70,130,2,143,'pants/1123.gif',NULL,4,NULL),(710,NULL,240,1,6,110,130,2,223,'pants/1124.gif',NULL,4,NULL),(711,NULL,280,1,6,130,140,2,263,'pants/1125.gif',NULL,3,NULL),(712,NULL,225,3,10,103,77,1,209,'pants/1126.png',NULL,4,NULL),(713,NULL,150,1,8,66,66,1,135,'pants/1128.gif',NULL,4,NULL),(714,NULL,275,1,12,85,97,2,261,'pants/1129.gif',NULL,4,NULL),(715,NULL,270,1,2,125,320,1,253,'pants/1130.gif',NULL,29,NULL),(716,NULL,215,3,2,98,240,1,199,'pants/1133.gif',NULL,8,NULL),(717,NULL,165,1,2,100,290,1,149,'pants/1134.gif',NULL,8,NULL),(718,NULL,175,3,5,160,67,2,160,'pants/1135.gif',NULL,3,NULL),(719,NULL,95,2,70,14,14,1,82,'pants/1140.gif',NULL,3,NULL),(720,NULL,200,3,6,90,81,1,183,'pants/1143.png',NULL,4,NULL),(721,NULL,175,3,6,160,50,1,160,'pants/1144.gif',NULL,3,NULL),(722,NULL,260,1,3,80,295,1,246,'pants/1145.gif',NULL,10,NULL),(723,NULL,195,3,6,58,156,1,180,'pants/1148.gif',NULL,3,NULL),(724,NULL,225,1,6,103,131,1,210,'pants/1150.gif',NULL,3,NULL),(725,NULL,150,1,2,136,153,1,136,'pants/1151.gif',NULL,6,NULL),(726,NULL,265,1,2,124,378,1,252,'pants/1155.gif',NULL,3,NULL),(727,NULL,215,3,15,65,65,1,201,'pants/1157.gif',NULL,5,NULL),(728,NULL,235,3,9,100,70,1,218,'pants/1159.gif',NULL,2,NULL),(729,NULL,220,1,8,100,80,1,203,'pants/1161.png',NULL,7,NULL),(730,NULL,280,1,24,20,164,1,268,'pants/1162.gif',NULL,11,NULL),(731,NULL,100,1,19,80,10,2,80,'pants/1164.gif',NULL,3,NULL),(732,NULL,200,3,4,90,175,1,183,'pants/1165.gif',NULL,6,NULL),(733,NULL,240,1,4,110,164,1,223,'pants/1166.gif',NULL,11,NULL),(734,NULL,235,3,9,72,130,1,222,'pants/1167.gif',NULL,4,NULL),(735,NULL,235,3,9,72,102,1,222,'pants/1168.jpg',NULL,4,NULL),(736,NULL,200,3,6,90,130,1,183,'pants/1169.jpg',NULL,4,NULL),(737,NULL,NULL,1,2,50,92,1,102,'pants/1170.gif',NULL,NULL,NULL),(738,NULL,140,1,27,39,23,1,123,'pants/1171.gif',NULL,3,NULL),(739,NULL,145,1,12,30,93,2,129,'pants/1172.gif',NULL,3,NULL),(740,NULL,210,3,8,97,72,1,197,'pants/1173.gif',NULL,4,NULL),(741,NULL,140,1,36,40,20,1,126,'pants/1174.png',NULL,3,NULL),(742,NULL,195,1,24,58,41,1,180,'pants/1175.png',NULL,3,NULL),(743,NULL,200,3,12,90,55,1,183,'pants/1176.png',NULL,3,NULL),(744,NULL,275,3,6,128,118,1,259,'pants/1177.png',NULL,9,NULL),(745,NULL,270,3,4,125,148,1,253,'pants/1182.png',NULL,4,NULL),(746,NULL,220,3,2,207,186,1,207,'pants/1183.png',NULL,5,NULL),(747,NULL,130,1,20,55,29,1,113,'pants/1186.gif',NULL,3,NULL),(748,NULL,180,3,3,80,165,1,165,'pants/1187.png',NULL,5,NULL),(749,NULL,280,3,6,132,132,1,268,'pants/1188.gif',NULL,2,NULL),(750,NULL,170,3,4,154,73,1,154,'pants/1193.gif',NULL,3,NULL),(751,NULL,210,1,20,47,58,2,197,'pants/1195.gif',NULL,3,NULL),(752,NULL,180,3,4,81,125,1,165,'pants/1196.gif',NULL,2,NULL),(753,NULL,165,2,32,35,35,1,149,'pants/1200.gif',NULL,3,NULL),(754,NULL,200,3,6,89,120,2,273,'pants/1201.gif',NULL,7,NULL),(755,NULL,215,3,6,100,120,2,203,'pants/1202.gif',NULL,7,NULL),(756,NULL,275,3,6,130,130,2,263,'pants/1203.gif',NULL,4,NULL),(757,NULL,185,3,3,172,105,1,172,'pants/1204.png',NULL,11,NULL),(758,NULL,200,1,48,45,20,2,189,'pants/1207.gif',NULL,3,NULL),(759,NULL,150,2,4,134,72,1,134,'pants/1208.png',NULL,4,NULL),(760,NULL,200,3,4,90,150,1,183,'pants/1215.gif',NULL,2,NULL),(761,NULL,110,3,12,46,40,1,95,'pants/1216.gif',NULL,2,NULL),(762,NULL,250,3,8,115,52,1,233,'pants/1217.gif',NULL,4,NULL),(763,NULL,100,1,28,38,13,1,79,'pants/1218.gif',NULL,3,NULL),(764,NULL,150,1,2,135,198,1,135,'pants/1220.gif',NULL,4,NULL),(765,NULL,220,1,20,100,25,1,203,'pants/1221.gif',NULL,3,NULL),(766,NULL,215,3,8,48,120,1,201,'pants/925.gif',NULL,4,NULL),(767,NULL,150,1,34,65,15,1,133,'pants/927.gif',NULL,3,NULL),(768,NULL,225,3,3,67,220,1,207,'pants/933.gif',NULL,2,NULL),(769,NULL,130,1,28,55,17,1,113,'pants/951.gif',NULL,3,NULL),(770,NULL,195,3,9,60,103,1,186,'pants/961.png',NULL,3,NULL),(771,NULL,215,3,6,102,80,1,207,'pants/962.png',NULL,3,NULL),(772,NULL,190,3,6,59,198,1,183,'pants/963.png',NULL,4,NULL),(773,NULL,NULL,1,2,10,27,1,58,NULL,NULL,NULL,NULL),(774,NULL,NULL,1,5,12,30,1,68,NULL,NULL,NULL,NULL),(775,NULL,NULL,1,8,12,36,1,150,NULL,NULL,NULL,NULL),(776,NULL,110,1,4,45,115,1,94,'pants/987.png',NULL,4,NULL),(777,NULL,110,1,6,45,115,1,94,'pants/988.png',NULL,16,NULL),(778,NULL,230,3,3,73,212,1,212,'pants/1006.png',NULL,4,NULL),(779,NULL,220,3,6,100,80,1,203,'pants/1014.gif',NULL,3,NULL),(780,NULL,240,3,4,145,110,1,223,'pants/1015.gif',NULL,4,NULL),(781,NULL,170,3,6,50,156,1,156,'pants/1016.gif',NULL,3,NULL),(782,NULL,260,1,6,120,90,1,244,'pants/1026.gif',NULL,3,NULL),(783,NULL,115,3,4,100,53,1,100,'pants/1032.png',NULL,3,NULL),(784,NULL,125,3,16,109,28,2,109,'pants/1041.gif',NULL,4,NULL),(785,NULL,190,3,2,172,152,1,172,'pants/1067.gif',NULL,7,NULL),(786,NULL,240,3,8,111,94,1,225,'pants/1070.gif',NULL,5,NULL),(787,NULL,200,1,4,90,190,2,183,'pants/1071.gif',NULL,12,NULL),(788,NULL,185,3,4,91,168,1,168,'pants/1089.gif',NULL,NULL,NULL),(789,NULL,215,1,18,64,49,2,198,'pants/1090.gif',NULL,4,NULL),(790,NULL,255,3,15,78,61,1,240,'pants/1091.gif',NULL,3,NULL),(791,NULL,255,1,40,58,30,1,241,'pants/1101.gif',NULL,2,NULL),(792,NULL,280,1,14,35,160,1,263,'pants/1102.gif',NULL,4,NULL),(793,NULL,120,1,8,24,142,1,105,'pants/1114.gif',NULL,3,NULL),(794,NULL,155,1,2,140,300,1,140,'pants/1117.gif',NULL,6,NULL),(795,NULL,275,3,6,128,123,1,259,'pants/1121.gif',NULL,4,NULL),(796,NULL,225,1,5,40,230,1,212,'pants/1131.gif',NULL,49,NULL),(797,NULL,215,3,2,98,240,1,199,'pants/1132.gif',NULL,8,NULL),(798,NULL,265,1,8,60,164,1,249,'pants/1136.gif',NULL,11,NULL),(799,NULL,140,1,1,125,420,1,125,'pants/1137.jpg',NULL,9,NULL),(800,NULL,280,3,10,267,29,1,267,'pants/1139.gif',NULL,3,NULL),(801,NULL,NULL,1,3,36,50,1,155,'pants/1141.gif',NULL,NULL,NULL),(802,NULL,230,3,3,80,213,1,213,'pants/1142.png',NULL,10,NULL),(803,NULL,180,3,2,80,230,1,163,'pants/1180.png',NULL,8,NULL),(804,NULL,180,3,4,80,185,1,163,'pants/1181.png',NULL,6,NULL),(805,NULL,245,3,4,230,70,1,230,'pants/1184.png',NULL,6,NULL),(806,NULL,225,3,12,68,85,1,210,'pants/1197.gif',NULL,2,NULL),(807,NULL,120,1,28,25,36,2,104,'pants/1198.gif',NULL,3,NULL),(808,NULL,270,1,6,40,300,2,255,'pants/1206.gif',NULL,5,NULL),(809,NULL,255,1,12,120,48,1,242,'pants/1209.png',NULL,3,NULL),(810,NULL,245,1,40,55,30,1,229,'pants/1210.gif',NULL,3,NULL),(811,NULL,215,3,4,203,80,1,203,'pants/1212.gif',NULL,7,NULL),(812,NULL,175,2,2,160,160,1,160,'pants/1213.gif',NULL,15,NULL),(813,NULL,220,1,4,100,125,1,203,'pants/1223.gif',NULL,2,NULL),(814,NULL,245,3,8,55,161,1,229,'pants/1224.gif',NULL,3,NULL),(815,NULL,225,3,6,70,104,2,211,'pants/1226.gif',NULL,6,NULL),(816,NULL,245,1,9,75,105,1,231,'pants/1228.gif',NULL,4,NULL),(817,NULL,170,3,3,90,155,1,155,'pants/1229.png',NULL,3,NULL),(818,NULL,200,3,4,92,140,1,187,'pants/1230.gif',NULL,3,NULL),(819,NULL,255,1,24,58,30,1,241,'pants/1231.png',NULL,4,NULL),(820,NULL,195,2,4,90,90,1,183,'pants/1232.png',NULL,12,NULL),(821,NULL,225,2,4,105,105,1,213,'pants/1233.png',NULL,9,NULL),(822,NULL,230,3,4,107,107,1,218,'pants/1237.gif',NULL,7,NULL),(823,NULL,255,3,6,118,131,1,239,'pants/1240.gif',NULL,3,NULL),(824,NULL,170,3,2,157,149,1,157,'pants/1241.gif',NULL,3,NULL),(825,NULL,210,3,2,194,176,1,194,'pants/1242.gif',NULL,15,NULL),(826,NULL,240,2,9,74,74,1,227,'pants/1243.gif',NULL,3,NULL),(827,NULL,245,1,15,75,42,1,231,'pants/1246.gif',NULL,4,NULL),(828,NULL,235,1,15,72,38,1,222,'pants/1247.gif',NULL,3,NULL),(829,NULL,215,1,14,98,30,1,199,'pants/1248.gif',NULL,3,NULL),(830,NULL,245,3,9,74,92,1,228,'pants/1249.gif',NULL,3,NULL),(831,NULL,250,3,6,117,120,2,237,'pants/1255.gif',NULL,7,NULL),(832,NULL,160,3,9,46,74,1,144,'pants/1257.gif',NULL,2,NULL),(833,NULL,130,3,7,27,115,1,115,'pants/1258.gif',NULL,2,NULL),(834,NULL,170,1,2,148,210,1,148,'pants/1259.gif',NULL,4,NULL),(835,NULL,220,3,2,190,100,1,203,'pants/1260.gif',NULL,13,NULL),(836,NULL,155,3,4,68,140,1,140,'pants/1261.gif',NULL,3,NULL),(837,NULL,170,3,6,72,75,1,153,'pants/1262.gif',NULL,4,NULL),(838,NULL,270,1,6,40,347,1,255,'pants/1264.gif',NULL,2,NULL),(839,NULL,165,3,2,148,121,1,148,'pants/1267.gif',NULL,3,NULL),(840,NULL,270,1,6,40,322,1,255,'pants/1269.gif',NULL,5,NULL),(841,NULL,155,1,2,140,135,1,140,'pants/1270.gif',2,3,NULL),(842,NULL,120,3,3,74,105,1,105,'pants/1271.gif',NULL,2,NULL),(843,NULL,115,3,2,98,136,1,98,'pants/1272.gif',NULL,2,NULL),(844,NULL,180,1,4,82,120,1,167,'pants/1275.gif',NULL,4,NULL),(845,NULL,255,1,4,119,120,1,241,'pants/1276.gif',NULL,4,NULL),(846,NULL,135,3,8,59,53,1,121,'pants/1277.gif',0,4,NULL),(847,NULL,165,3,6,75,64,1,153,'pants/1283.gif',0,4,NULL),(848,NULL,280,3,4,133,103,1,268,'pants/1291.gif',0,3,NULL),(849,NULL,225,3,2,211,149,1,211,'pants/1293.gif',0,3,NULL),(850,NULL,225,3,2,211,149,1,211,'pants/1294.gif',0,3,NULL),(851,NULL,175,1,4,80,170,1,163,'pants/1296.gif',2,5,NULL),(852,NULL,265,1,12,82,80,1,252,'pants/1298.gif',2,7,NULL),(853,NULL,205,1,96,30,20,1,190,'pants/1302.gif',2,2,NULL),(854,NULL,160,1,4,70,148,1,145,'pants/1303.gif',2,4,NULL),(855,NULL,200,1,10,90,68,2,184,'pants/1304.gif',7,2,NULL),(856,NULL,130,1,64,26,16,1,113,'pants/929.gif',NULL,3,NULL),(857,NULL,230,3,3,214,86,1,214,'pants/930.gif',NULL,7,NULL),(858,NULL,145,1,24,30,50,1,129,'pants/931.gif',NULL,3,NULL),(859,NULL,215,3,6,99,125,1,201,'pants/932.gif',NULL,2,NULL),(860,NULL,229,3,8,106,67,1,215,'pants/934.gif',NULL,3,NULL),(861,NULL,206,3,6,94,123,1,191,'pants/937.gif',NULL,4,NULL),(862,NULL,260,3,10,121,60,1,245,'pants/939.gif',NULL,4,NULL),(863,NULL,250,3,4,180,140,1,237,'pants/943.gif',NULL,NULL,NULL),(864,NULL,NULL,1,4,81,67,1,164,NULL,NULL,NULL,NULL),(865,NULL,100,1,3,85,127,1,85,'pants/952.gif',NULL,4,NULL),(866,NULL,200,1,4,185,75,1,185,'pants/964.gif',7,4,NULL),(867,NULL,265,3,4,60,230,1,249,'pants/971.gif',NULL,8,NULL),(868,NULL,215,3,10,102,58,1,207,'pants/979.png',NULL,3,NULL),(869,NULL,240,3,3,90,225,1,225,'pants/982.gif',NULL,3,NULL),(870,NULL,155,3,5,140,80,1,140,'pants/990.gif',NULL,6,NULL),(871,NULL,200,2,12,60,60,1,187,'pants/996.gif',NULL,4,NULL),(872,NULL,175,3,6,52,186,1,161,'pants/997.gif',NULL,5,NULL),(873,NULL,245,3,10,114,79,1,231,'pants/1000.gif',NULL,7,NULL),(874,NULL,160,3,2,143,199,1,143,'pants/1002.gif',NULL,3,NULL),(875,NULL,180,1,14,80,30,1,163,'pants/1008.gif',NULL,3,NULL),(876,NULL,115,3,4,101,105,1,101,'pants/1012.png',NULL,2,NULL),(877,NULL,160,1,4,35,266,1,150,'pants/1019.png',NULL,4,NULL),(878,NULL,275,3,6,128,125,1,259,'pants/1021.gif',NULL,2,NULL),(879,NULL,180,1,48,39,23,1,165,'pants/1030.png',NULL,2,NULL),(880,NULL,190,3,6,86,97,1,175,'pants/1033.gif',NULL,5,NULL),(881,NULL,215,3,6,98,97,1,199,'pants/1034.gif',NULL,5,NULL),(882,NULL,195,3,18,58,50,1,179,'pants/1046.gif',NULL,3,NULL),(883,NULL,225,3,3,210,89,1,210,'pants/1047.gif',NULL,4,NULL),(884,NULL,245,1,9,75,103,1,230,'pants/1049.png',NULL,3,NULL),(885,NULL,275,1,66,21,50,1,261,'pants/1052.png',NULL,3,NULL),(886,NULL,185,3,10,83,60,1,169,'pants/1054.png',NULL,4,NULL),(887,NULL,215,1,2,200,170,1,200,'pants/1058.png',NULL,5,NULL),(888,NULL,220,3,10,100,62,1,203,'pants/1060.png',NULL,3,NULL),(889,NULL,260,3,20,47,74,1,243,'pants/1061.png',NULL,5,NULL),(890,NULL,160,3,2,147,135,1,147,'pants/1062.png',NULL,3,NULL),(891,NULL,190,3,2,172,152,1,172,'pants/1066.gif',NULL,7,NULL),(892,NULL,205,1,12,94,49,1,191,'pants/1082.png',NULL,4,NULL),(893,NULL,120,1,30,50,12,1,103,'pants/1085.png',NULL,3,NULL),(894,NULL,275,1,4,260,85,1,260,'pants/1086.gif',NULL,2,NULL),(895,NULL,170,1,30,50,25,2,156,'pants/1087.gif',NULL,3,NULL),(896,NULL,115,1,4,47,210,1,97,'pants/1093.gif',NULL,4,NULL),(897,NULL,NULL,1,10,12,18,1,98,NULL,NULL,NULL,NULL),(898,NULL,NULL,2,4,12,12,1,54,NULL,NULL,NULL,NULL),(899,NULL,NULL,1,4,10,54,1,54,NULL,NULL,NULL,NULL),(900,NULL,NULL,1,2,72,120,1,147,NULL,NULL,NULL,NULL),(901,NULL,150,1,30,25,48,1,137,'pants/1111.gif',NULL,3,NULL),(902,NULL,170,3,6,76,103,1,155,'pants/1127.gif',NULL,3,NULL),(903,NULL,185,3,3,172,136,1,172,'pants/1178.png',NULL,7,NULL),(904,NULL,245,3,6,75,170,1,231,'pants/1185.png',NULL,5,NULL),(905,NULL,165,3,3,90,150,1,150,'pants/1219.png',NULL,3,NULL),(906,NULL,160,1,21,50,34,1,154,'pants/1308.gif',2,2,NULL),(907,NULL,250,3,8,115,84,1,233,'pants/1314.gif',0,3,NULL),(908,NULL,170,3,4,77,133,1,157,'pants/1315.gif',NULL,7,NULL),(909,NULL,140,3,8,60,66,1,123,'pants/1317.gif',NULL,4,NULL),(910,NULL,105,2,36,20,20,1,89,'pants/1320.png',0,3,NULL),(911,NULL,220,3,6,100,73,1,203,'pants/1324.gif',0,3,NULL),(912,NULL,230,3,6,70,111,1,216,'pants/1325.gif',0,3,NULL),(913,NULL,210,3,3,63,195,1,194,'pants/1326.gif',0,8,NULL),(914,NULL,250,3,6,115,90,2,233,'pants/1327.gif',0,3,NULL),(915,NULL,185,3,4,83,110,1,169,'pants/1328.gif',0,4,NULL),(916,NULL,255,3,4,240,85,1,240,'pants/957.gif',NULL,2,NULL),(917,NULL,230,2,15,70,59,1,217,'pants/993.gif',NULL,4,NULL),(918,NULL,220,3,6,67,200,1,207,'pants/1081.png',NULL,10,NULL),(919,NULL,180,1,5,166,80,1,166,'pants/1084.png',NULL,6,NULL),(920,NULL,200,1,4,90,200,1,183,'pants/1088.png',NULL,14,NULL),(921,NULL,220,3,2,208,156,1,208,'pants/1179.png',NULL,3,NULL),(922,NULL,235,3,12,72,72,1,222,'pants/1189.gif',NULL,4,NULL),(923,NULL,150,3,4,65,140,1,133,'pants/1190.gif',NULL,3,NULL),(924,NULL,160,3,21,47,38,1,147,'pants/1191.gif',NULL,3,NULL),(925,NULL,180,3,2,80,295,1,163,'pants/1192.gif',NULL,3,NULL),(926,NULL,130,1,4,57,150,1,117,'pants/1194.gif',NULL,2,NULL),(927,NULL,135,3,4,120,72,1,120,'pants/1199.gif',NULL,3,NULL),(928,NULL,205,3,6,93,105,1,189,'pants/1205.png',NULL,11,NULL),(929,NULL,260,3,8,59,145,1,245,'pants/1211.gif',NULL,7,NULL),(930,NULL,170,3,2,75,276,1,153,'pants/1214.png',NULL,3,NULL),(931,NULL,155,3,6,68,100,1,139,'pants/1225.gif',NULL,6,NULL),(932,NULL,230,3,6,70,156,2,216,'pants/1234.gif',NULL,3,NULL),(933,NULL,210,1,8,97,85,2,197,'pants/1235.gif',NULL,2,NULL),(934,NULL,145,1,40,30,20,1,129,'pants/1236.png',NULL,NULL,NULL),(935,NULL,255,3,8,118,52,1,239,'pants/1239.gif',NULL,4,NULL),(936,NULL,230,3,6,105,71,1,213,'pants/1245.gif',NULL,5,NULL),(937,NULL,225,1,1,210,265,1,210,'pants/1279.gif',2,0,NULL),(938,NULL,235,1,1,220,405,1,220,'pants/1256.gif',NULL,14,NULL),(939,NULL,220,3,6,102,62,1,208,'pants/1265.gif',NULL,6,NULL),(940,NULL,240,3,4,110,106,1,224,'pants/1266.gif',NULL,8,NULL),(941,NULL,210,3,2,197,155,1,197,'pants/1268.gif',NULL,4,NULL),(942,NULL,205,3,4,95,110,1,193,'pants/1278.gif',0,4,NULL),(943,NULL,270,1,16,62,53,1,256,'pants/1280.png',2,3,NULL),(944,NULL,130,1,33,37,16,1,117,'pants/1281.png',2,3,NULL),(945,NULL,165,3,6,49,150,1,153,'pants/1284.gif',0,2,NULL),(946,NULL,200,1,12,45,95,1,189,'pants/1286.gif',2,4,NULL),(947,NULL,145,3,3,133,70,1,133,'pants/1287.gif',0,6,NULL),(948,NULL,195,3,6,90,88,1,183,'pants/1288.gif',0,5,NULL),(949,NULL,155,1,12,70,40,1,143,'pants/1290.gif',0,2,NULL),(950,NULL,100,3,10,42,60,1,87,'pants/1299.gif',0,4,NULL),(951,NULL,240,1,8,110,70,1,225,'pants/1300.gif',2,6,NULL),(952,NULL,280,2,15,50,100,1,266,'pants/1301.gif',0,2,NULL),(953,NULL,130,1,4,55,149,1,113,'pants/1305.gif',2,3,NULL),(954,NULL,190,3,3,177,61,1,177,'pants/1306.gif',0,7,NULL),(955,NULL,135,1,18,60,30,1,123,'pants/1307.gif',2,4,NULL),(956,NULL,167,1,9,50,80,1,156,'pants/1310.gif',14,5,NULL),(957,NULL,190,3,2,174,134,1,174,'pants/1311.gif',0,6,NULL),(958,NULL,190,3,2,174,134,1,174,'pants/1312.gif',0,6,NULL),(959,NULL,195,3,2,90,300,1,183,'pants/1313.gif',0,5,NULL),(960,NULL,255,1,24,58,30,1,241,'pants/1318.png',1,4,NULL),(961,NULL,100,2,78,12,12,1,87,'pants/1319.png',0,4,NULL),(962,NULL,185,1,3,170,113,1,170,'pants/1322.png',NULL,3,NULL),(963,NULL,170,1,9,50,70,1,156,'pants/1331.gif',2,4,NULL),(964,NULL,140,3,4,60,124,1,123,'pants/940.gif',NULL,3,NULL),(965,NULL,230,3,12,69,55,1,213,'pants/941.gif',NULL,2,NULL),(966,NULL,160,3,2,126,70,1,126,'pants/942.gif',NULL,82,NULL),(967,NULL,240,1,3,225,99,1,225,'pants/960.gif',NULL,3,NULL),(968,NULL,170,3,6,50,150,1,156,'pants/965.gif',NULL,9,NULL),(969,NULL,170,3,6,50,150,1,156,'pants/966.gif',NULL,9,NULL),(970,NULL,240,3,6,110,88,1,223,'pants/968.gif',NULL,5,NULL),(971,NULL,155,3,5,140,59,1,140,'pants/972.gif',NULL,5,NULL),(972,NULL,165,3,4,150,65,1,150,'pants/973.gif',NULL,5,NULL),(973,NULL,235,3,4,84,220,1,220,'pants/975.gif',NULL,3,NULL),(974,NULL,220,1,12,100,34,1,203,'pants/998.gif',NULL,3,NULL),(975,NULL,245,3,6,74,140,1,228,'pants/1001.gif',NULL,3,NULL),(976,NULL,235,3,4,75,220,1,220,'pants/1028.gif',NULL,4,NULL),(977,NULL,200,3,2,90,276,1,183,'pants/1035.gif',NULL,3,NULL),(978,NULL,NULL,1,6,24,140,1,154,NULL,NULL,NULL,NULL),(979,NULL,215,3,6,65,160,1,201,'pants/1050.gif',NULL,4,NULL),(980,NULL,280,3,12,130,55,1,275,'pants/1051.gif',NULL,3,NULL),(981,NULL,200,1,21,60,42,1,186,'pants/1053.png',NULL,3,NULL),(982,NULL,235,3,8,107,75,1,219,'pants/1056.png',NULL,4,NULL),(983,NULL,245,3,9,75,100,1,231,'pants/1057.png',NULL,6,NULL),(984,NULL,200,1,24,60,35,1,186,'pants/1059.png',NULL,3,NULL),(985,NULL,210,3,6,95,95,1,193,'pants/1063.png',NULL,7,NULL),(986,NULL,190,1,12,85,64,1,174,'pants/1065.gif',NULL,3,NULL),(987,NULL,240,1,4,110,205,1,223,'pants/1073.png',NULL,5,NULL),(988,NULL,135,3,8,59,69,1,121,'pants/1074.gif',NULL,3,NULL),(989,NULL,275,3,10,128,63,1,259,'pants/1096.png',NULL,3,NULL),(990,NULL,205,1,3,190,110,1,190,'pants/1097.gif',NULL,6,NULL),(991,NULL,195,3,4,180,90,1,180,'pants/1098.png',NULL,5,NULL),(992,NULL,205,3,3,190,100,1,190,'pants/1099.png',NULL,6,NULL),(993,NULL,235,3,3,220,130,1,220,'pants/1100.png',NULL,6,NULL),(994,NULL,225,3,16,50,73,1,209,'pants/1104.png',NULL,3,NULL),(995,NULL,145,1,1,129,270,1,129,'pants/1105.gif',NULL,9,NULL),(996,NULL,235,3,4,108,110,1,220,'pants/1115.gif',NULL,4,NULL),(997,NULL,170,3,6,50,110,1,156,'pants/1116.gif',NULL,4,NULL),(998,NULL,180,3,5,160,78,1,160,'pants/1138.gif',NULL,3,NULL),(999,NULL,280,3,16,64,90,2,265,'pants/1146.gif',NULL,5,NULL),(1000,NULL,265,1,20,60,83,2,249,'pants/1147.gif',NULL,3,NULL),(1001,NULL,165,1,2,148,150,1,148,'pants/1149.gif',NULL,3,NULL),(1002,NULL,260,3,9,80,123,1,248,'pants/1152.gif',NULL,4,NULL),(1003,NULL,200,1,9,60,106,1,186,'pants/1153.gif',NULL,10,NULL),(1004,NULL,270,3,10,125,55,2,253,'pants/1154.gif',NULL,6,NULL),(1005,NULL,215,2,8,98,98,1,200,'pants/1156.gif',NULL,3,NULL),(1006,NULL,275,1,15,50,80,1,262,'pants/1158.gif',NULL,3,NULL),(1007,NULL,235,3,9,100,70,1,218,'pants/1160.gif',NULL,2,NULL),(1008,NULL,275,3,5,60,260,1,260,'pants/1222.gif',NULL,4,NULL),(1009,NULL,240,1,2,112,345,1,227,'pants/1227.png',NULL,4,NULL),(1010,NULL,260,2,12,80,47,1,246,'pants/1238.png',NULL,4,NULL),(1011,NULL,260,1,12,80,68,1,246,'pants/1244.gif',NULL,2,NULL),(1012,NULL,195,3,6,88,90,1,179,'pants/1250.gif',NULL,3,NULL),(1013,NULL,260,3,16,120,25,1,245,'pants/1251.gif',NULL,4,NULL),(1014,NULL,225,1,8,50,95,1,209,'pants/1316.gif',2,7,NULL),(1015,NULL,240,2,4,111,111,1,225,'pants/1253.gif',NULL,3,NULL),(1016,NULL,230,3,8,52,186,1,215,'pants/1263.gif',NULL,5,NULL),(1017,NULL,235,3,6,72,110,1,223,'pants/1273.gif',NULL,4,NULL),(1018,NULL,105,1,42,12,40,1,92,'pants/1274.gif',NULL,4,NULL),(1019,NULL,260,1,9,80,100,1,246,'pants/1282.gif',2,6,NULL),(1020,NULL,135,3,4,58,156,1,119,'pants/1285.gif',0,3,NULL),(1021,NULL,245,3,4,55,225,2,229,'pants/1289.gif',0,0,NULL),(1022,NULL,235,3,6,110,64,1,223,'pants/1292.gif',0,4,NULL),(1023,NULL,215,3,9,65,70,1,201,'pants/1295.gif',0,6,NULL),(1024,NULL,215,1,2,100,217,1,203,'pants/1297.gif',2,0,NULL),(1025,NULL,165,3,5,155,45,1,155,'pants/1309.gif',4,6,NULL),(1026,NULL,195,1,5,180,60,1,180,'pants/1321.png',2,4,NULL),(1027,NULL,230,3,6,70,150,1,216,'pants/1323.gif',0,2,NULL),(1028,NULL,120,3,6,105,36,1,105,'pants/1329.gif',2,5,NULL),(1029,NULL,185,1,8,84,84,1,171,'pants/1330.gif',2,3,NULL),(1030,NULL,130,1,6,55,64,1,113,'pants/1332.gif',2,4,NULL),(1031,NULL,150,1,6,20,300,1,135,'pants/1333.png',2,0,NULL),(1032,NULL,160,1,12,70,32,1,143,'pants/1334.gif',2,3,NULL),(1033,NULL,170,1,8,76,51,1,155,'pants/1335.gif',2,2,NULL),(1034,NULL,125,1,16,25,54,1,109,'pants/1336.gif',2,3,NULL),(1035,NULL,135,1,20,58,19,2,119,'pants/1337.gif',2,3,NULL),(1036,NULL,160,1,2,145,185,2,145,'pants/1338.gif',2,6,NULL),(1037,NULL,270,2,12,62,114,1,257,'pants/521.gif',NULL,2,NULL),(1038,NULL,205,2,8,95,95,2,193,'pants/522.gif',NULL,6,NULL),(1039,NULL,NULL,1,2,9,25,1,NULL,NULL,NULL,NULL,NULL),(1040,NULL,220,3,6,102,100,2,208,'pants/624.gif',NULL,6,NULL),(1041,NULL,NULL,1,4,30,125,1,NULL,NULL,NULL,NULL,NULL),(1042,NULL,200,3,4,92,188,1,188,'pants/626.gif',NULL,3,NULL),(1043,NULL,175,1,45,30,30,1,162,'pants/627.gif',NULL,4,NULL),(1044,NULL,175,3,2,162,181,2,162,'pants/628.gif',NULL,10,NULL),(1045,NULL,200,3,6,92,104,2,188,'pants/629.gif',NULL,2,NULL),(1046,NULL,175,3,2,162,181,2,162,'pants/630.gif',NULL,10,NULL),(1047,NULL,210,2,4,95,180,2,193,'pants/631.gif',NULL,11,NULL),(1048,NULL,170,2,36,37,29,1,157,'pants/632.gif',NULL,2,NULL),(1049,NULL,160,1,2,70,250,1,144,'pants/633.gif',2,4,NULL),(1050,NULL,185,3,6,55,170,2,173,'pants/634.gif',NULL,5,NULL),(1051,NULL,280,3,4,133,149,2,270,'pants/635.gif',NULL,3,NULL),(1052,NULL,190,3,10,86,53,2,175,'pants/640.gif',NULL,3,NULL),(1053,NULL,225,3,10,104,65,2,212,'pants/637.gif',NULL,5,NULL),(1054,NULL,185,3,6,85,124,2,174,'pants/638.gif',NULL,3,NULL),(1055,NULL,280,1,8,132,75,2,268,'pants/639.gif',2,4,NULL),(1056,NULL,175,1,5,160,50,2,160,'pants/641.gif',2,14,NULL),(1057,NULL,230,3,8,105,91,2,214,'pants/642.gif',NULL,4,NULL),(1058,NULL,NULL,3,2,67,102,1,NULL,NULL,NULL,NULL,NULL),(1059,NULL,160,2,8,72,72,2,148,'pants/644.gif',NULL,4,NULL),(1060,NULL,NULL,1,6,25,63,1,NULL,NULL,NULL,NULL,NULL),(1061,NULL,260,1,30,39,60,2,249,'pants/646.gif',2,4,NULL),(1062,NULL,280,3,4,133,149,2,270,'pants/647.gif',NULL,3,NULL),(1063,NULL,NULL,1,1,90,140,1,NULL,NULL,NULL,NULL,NULL),(1064,NULL,270,3,6,83,184,1,257,'pants/649.gif',NULL,7,NULL),(1065,NULL,225,1,8,103,73,2,210,'pants/650.gif',2,3,NULL),(1066,NULL,210,3,6,95,99,2,194,'pants/651.gif',NULL,3,NULL),(1067,NULL,145,1,3,130,130,2,130,'pants/652.gif',2,4,NULL),(1068,NULL,200,3,10,92,72,2,188,'pants/653.gif',NULL,5,NULL),(1069,NULL,260,3,6,80,198,2,246,'pants/654.gif',NULL,4,NULL),(1070,NULL,260,3,12,80,80,2,246,'pants/655.gif',NULL,7,NULL),(1071,NULL,220,3,8,100,71,2,204,'pants/656.gif',NULL,6,NULL),(1072,NULL,NULL,1,5,30,100,1,NULL,NULL,NULL,NULL,NULL),(1073,NULL,255,1,12,58,110,2,241,'pants/658.gif',2,6,NULL),(1074,NULL,125,2,12,54,54,2,111,'pants/659.gif',NULL,4,NULL),(1075,NULL,260,3,8,122,75,2,247,'pants/660.gif',NULL,4,NULL),(1076,NULL,220,3,4,100,172,2,204,'pants/661.gif',NULL,3,NULL),(1077,NULL,135,3,4,119,60,2,119,'pants/662.gif',NULL,4,NULL),(1078,NULL,140,3,1,128,238,2,128,'pants/663.gif',NULL,3,NULL),(1079,NULL,140,3,2,110,198,2,128,'pants/664.gif',NULL,NULL,NULL),(1080,NULL,135,3,2,94,185,2,119,'pants/665.gif',NULL,NULL,NULL),(1081,NULL,115,1,5,100,55,2,115,'pants/666.gif',2,4,NULL),(1082,NULL,105,1,3,90,110,2,90,'pants/667.gif',2,6,NULL),(1083,NULL,NULL,1,1,120,130,1,NULL,NULL,NULL,NULL,NULL),(1084,NULL,100,3,2,82,172,1,82,'pants/673.gif',NULL,3,NULL),(1085,NULL,130,3,1,110,261,1,110,'pants/674.gif',NULL,17,NULL),(1086,NULL,140,2,21,40,40,1,126,'pants/675.gif',NULL,4,NULL),(1087,NULL,120,3,5,108,58,1,108,'pants/676.gif',NULL,3,NULL),(1088,NULL,260,3,18,80,50,2,248,'pants/678.gif',NULL,3,NULL),(1089,NULL,165,1,2,150,221,2,150,'pants/679.gif',3,3,NULL),(1090,NULL,NULL,1,2,60,170,1,NULL,NULL,NULL,NULL,NULL),(1091,NULL,250,1,16,27,155,2,237,'pants/681.gif',2,4,NULL),(1092,NULL,240,3,6,73,173,2,227,'pants/677.gif',NULL,2,NULL),(1093,NULL,240,3,6,110,125,2,224,'pants/682.gif',NULL,2,NULL),(1094,NULL,245,2,9,75,140,2,231,'pants/683.gif',NULL,3,NULL),(1095,NULL,275,1,6,40,320,2,260,'pants/684.gif',1,29,NULL),(1096,NULL,100,1,3,85,114,2,85,'pants/685.gif',2,2,NULL),(1097,NULL,110,3,3,95,99,2,96,'pants/686.gif',NULL,3,NULL),(1098,NULL,240,1,12,54,140,2,225,'pants/687.gif',2,3,NULL),(1099,NULL,170,1,24,17,130,2,157,'pants/688.gif',2,4,NULL),(1100,NULL,170,3,2,77,225,2,157,'pants/689.gif',NULL,80,NULL),(1101,NULL,175,3,20,38,61,2,161,'pants/690.gif',NULL,3,NULL),(1102,NULL,255,1,2,240,134,2,240,'pants/691.gif',3,6,NULL),(1103,NULL,160,3,2,70,230,2,144,'pants/692.gif',NULL,75,NULL),(1104,NULL,75,3,2,59,165,2,59,'pants/693.gif',NULL,10,NULL),(1105,NULL,215,1,2,200,149,2,200,'pants/694.gif',2,3,NULL),(1106,NULL,105,3,5,90,65,2,90,'pants/695.gif',NULL,5,NULL),(1107,NULL,200,3,6,91,91,2,186,'pants/696.gif',NULL,2,NULL),(1108,NULL,245,3,9,75,98,2,233,'pants/697.gif',NULL,4,NULL),(1109,NULL,145,1,2,64,195,2,132,'pants/698.gif',NULL,110,NULL),(1110,NULL,170,1,2,77,225,2,158,'pants/699.gif',NULL,4,NULL),(1111,NULL,180,3,5,165,58,2,165,'pants/700.gif',NULL,3,NULL),(1112,NULL,135,1,4,59,160,2,122,'pants/701.gif',NULL,15,NULL),(1113,NULL,260,3,20,48,75,2,246,'pants/702.gif',NULL,4,NULL),(1114,NULL,215,1,12,65,73,2,203,'pants/703.gif',4,3,NULL),(1115,NULL,240,2,24,54,54,2,225,'pants/704.gif',NULL,NULL,NULL),(1116,NULL,255,3,12,75,85,2,233,'pants/705.gif',NULL,2,NULL),(1117,NULL,135,3,2,59,242,2,122,'pants/706.gif',NULL,12,NULL),(1118,NULL,135,1,5,120,60,2,120,'pants/707.gif',NULL,10,NULL),(1119,NULL,140,3,4,150,60,2,124,'pants/708.gif',NULL,NULL,NULL),(1120,NULL,265,1,16,60,85,2,249,'pants/709.gif',2,2,NULL),(1121,NULL,NULL,2,4,24,30,1,NULL,NULL,NULL,NULL,NULL),(1122,NULL,230,1,15,70,79,2,218,'pants/711.gif',3,2,NULL),(1123,NULL,NULL,1,8,35,78,1,NULL,NULL,NULL,NULL,NULL),(1124,NULL,110,1,5,95,55,2,95,'pants/713.gif',2,15,NULL),(1125,NULL,205,3,6,93,99,2,190,'pants/714.gif',NULL,3,NULL),(1126,NULL,180,1,2,80,340,2,164,'pants/715.gif',NULL,9,NULL),(1127,NULL,170,1,2,77,195,2,158,'pants/716.gif',2,110,NULL),(1128,NULL,240,2,12,54,90,2,225,'pants/717.gif',NULL,3,NULL),(1129,NULL,170,3,6,77,102,2,158,'pants/718.gif',NULL,4,NULL),(1130,NULL,210,1,1,192,398,2,192,'pants/719.gif',2,5,NULL),(1131,NULL,170,3,6,77,102,2,158,'pants/720.gif',NULL,4,NULL),(1132,NULL,260,1,8,58,149,2,244,'pants/721.gif',4,3,NULL),(1133,NULL,250,2,12,77,77,2,237,'pants/722.gif',NULL,2,NULL),(1134,NULL,240,3,8,110,66,2,224,'pants/723.gif',NULL,4,NULL),(1135,NULL,185,1,8,84,97,2,172,'pants/724.gif',2,4,NULL),(1136,NULL,230,3,10,105,80,2,214,'pants/725.gif',NULL,6,NULL),(1137,NULL,185,1,9,55,110,2,173,'pants/726.gif',4,6,NULL),(1138,NULL,110,1,27,29,29,2,94,'pants/727.gif',1,5,NULL),(1139,NULL,170,3,6,75,125,2,154,'pants/728.gif',NULL,3,NULL),(1140,NULL,140,3,6,40,150,2,127,'pants/729.gif',NULL,2,NULL),(1141,NULL,220,3,4,102,188,2,208,'pants/730.gif',NULL,3,NULL),(1142,NULL,135,3,4,60,150,2,123,'pants/731.gif',NULL,2,NULL),(1143,NULL,220,1,8,100,84,2,204,'pants/732.gif',2,3,NULL),(1144,NULL,160,1,2,148,210,2,148,'pants/733.gif',2,4,NULL),(1145,NULL,150,3,6,63,95,2,130,'pants/734.gif',NULL,7,NULL),(1146,NULL,265,2,20,60,78,2,249,'pants/735.gif',NULL,3,NULL),(1147,NULL,205,1,20,45,58,2,189,'pants/736.gif',2,3,NULL),(1148,NULL,135,3,4,58,165,2,119,'pants/737.gif',NULL,10,NULL),(1149,NULL,270,1,18,40,125,2,255,'pants/738.gif',5,2,NULL),(1150,NULL,125,3,2,54,210,2,112,'pants/739.gif',NULL,12,NULL),(1151,NULL,200,3,12,92,62,2,188,'pants/740.gif',NULL,2,NULL),(1152,NULL,140,3,4,60,142,2,124,'pants/741.gif',NULL,10,NULL),(1153,NULL,275,1,3,260,110,2,260,'pants/742.gif',2,6,NULL),(1154,NULL,255,1,12,58,90,2,241,'pants/744.gif',2,3,NULL),(1155,NULL,110,2,3,99,99,2,99,'pants/745.gif',0,3,NULL),(1156,NULL,105,1,4,44,141,2,92,'pants/746.gif',4,7,NULL),(1157,NULL,120,3,4,52,150,2,108,'pants/747.gif',NULL,2,NULL),(1158,NULL,155,3,3,140,114,2,140,'pants/748.gif',NULL,2,NULL),(1159,NULL,210,3,6,95,112,2,194,'pants/749.gif',NULL,4,NULL),(1160,NULL,210,3,8,95,97,2,194,'pants/750.gif',NULL,4,NULL),(1161,NULL,220,3,4,100,150,2,204,'pants/751.gif',NULL,2,NULL),(1162,NULL,225,3,24,50,50,2,212,'pants/752.gif',NULL,3,NULL),(1163,NULL,150,1,12,20,164,2,135,'pants/753.gif',2,11,NULL),(1164,NULL,175,1,40,38,25,2,161,'pants/754.gif',2,3,NULL),(1165,NULL,175,1,4,160,85,2,160,'pants/755.gif',2,2,NULL),(1166,NULL,170,3,2,77,195,2,157,'pants/756.gif',NULL,110,NULL),(1167,NULL,160,3,10,70,65,2,144,'pants/757.gif',NULL,5,NULL),(1168,NULL,160,3,10,70,65,2,144,'pants/758.gif',NULL,5,NULL),(1169,NULL,220,2,12,49,140,2,208,'pants/759.gif',NULL,3,NULL),(1170,NULL,240,3,12,73,95,2,226,'pants/760.gif',NULL,6,NULL),(1171,NULL,260,1,9,80,130,2,248,'pants/761.gif',NULL,4,NULL),(1172,NULL,190,1,54,57,13,2,177,'pants/762.gif',NULL,3,NULL),(1173,NULL,220,1,10,100,78,2,204,'pants/763.gif',2,3,NULL),(1174,NULL,230,1,9,70,90,2,218,'pants/764.gif',6,3,NULL),(1175,NULL,120,3,4,51,137,1,107,'pants/765.gif',NULL,3,NULL),(1176,NULL,240,1,4,110,150,2,224,'pants/766.gif',2,2,NULL),(1177,NULL,200,3,5,186,80,2,186,'pants/767.gif',NULL,6,NULL),(1178,NULL,110,3,6,45,124,2,94,'pants/768.gif',NULL,3,NULL),(1179,NULL,NULL,1,4,38,38,1,NULL,NULL,NULL,NULL,NULL),(1180,NULL,NULL,1,8,14,36,1,NULL,NULL,NULL,NULL,NULL),(1181,NULL,270,1,6,125,125,2,254,'pants/771.gif',NULL,3,NULL),(1182,NULL,NULL,1,2,64,105,1,NULL,NULL,NULL,NULL,NULL),(1183,NULL,NULL,1,8,24,36,1,NULL,NULL,NULL,NULL,NULL),(1184,NULL,NULL,1,3,45,90,1,90,NULL,NULL,NULL,NULL),(1185,NULL,220,3,9,67,113,2,207,'pants/775.gif',NULL,3,NULL),(1186,NULL,200,1,10,90,60,2,184,'pants/776.gif',NULL,4,NULL),(1187,NULL,NULL,1,2,30,45,1,100,NULL,NULL,NULL,NULL),(1188,NULL,NULL,1,3,50,117,1,NULL,NULL,NULL,NULL,NULL),(1189,NULL,160,3,10,70,65,2,144,'pants/779.gif',NULL,5,NULL),(1190,NULL,95,3,1,80,200,1,80,'pants/780.gif',NULL,41,NULL),(1191,NULL,200,1,6,90,90,2,184,'pants/781.gif',2,3,NULL),(1192,NULL,160,3,6,70,76,1,144,'pants/782.gif',NULL,4,NULL),(1193,NULL,170,3,4,76,185,2,156,'pants/783.gif',NULL,6,NULL),(1194,NULL,130,1,8,55,72,2,114,'pants/784.gif',2,4,NULL),(1195,NULL,130,1,2,59,305,2,0,'pants/785.gif',NULL,NULL,NULL),(1196,NULL,145,3,6,64,130,2,131,'pants/786.gif',NULL,4,NULL),(1197,NULL,250,3,4,117,188,2,238,'pants/787.gif',NULL,3,NULL),(1198,NULL,95,3,2,82,164,1,82,'pants/788.gif',NULL,11,NULL),(1199,NULL,155,3,4,139,83,2,139,'pants/789.gif',NULL,4,NULL),(1200,NULL,120,3,2,50,290,2,104,'pants/790.gif',NULL,5,NULL),(1201,NULL,120,3,2,50,250,2,104,'pants/791.gif',NULL,4,NULL),(1202,NULL,260,1,20,58,58,2,244,'pants/792.gif',2,3,NULL),(1203,NULL,225,1,18,68,55,2,212,'pants/793.gif',2,3,NULL),(1204,NULL,NULL,1,16,17,57,1,NULL,NULL,NULL,NULL,NULL),(1205,NULL,120,3,6,106,53,2,106,'pants/795.gif',NULL,5,NULL),(1206,NULL,115,1,2,100,150,2,100,'pants/796.gif',3,2,NULL),(1207,NULL,280,3,12,64,90,2,268,'pants/797.gif',NULL,3,NULL),(1208,NULL,180,2,9,54,99,2,168,'pants/798.gif',NULL,3,NULL),(1209,NULL,210,1,6,95,124,2,194,'pants/799.gif',13,3,NULL),(1210,NULL,275,3,12,62,91,2,260,'pants/800.gif',NULL,2,NULL),(1211,NULL,200,3,15,60,60,1,188,'pants/801.gif',NULL,4,NULL),(1212,NULL,260,3,9,80,113,2,248,'pants/802.gif',NULL,3,NULL),(1213,NULL,145,1,60,31,18,1,133,'pants/803.gif',1,2,NULL),(1214,NULL,185,1,4,40,300,2,172,'pants/804.gif',2,5,NULL),(1215,NULL,235,3,8,108,74,2,220,'pants/805.gif',NULL,2,NULL),(1216,NULL,150,3,6,67,79,2,138,'pants/806.gif',NULL,6,NULL),(1217,NULL,220,1,6,100,130,2,204,'pants/807.gif',3,4,NULL),(1218,NULL,235,1,20,53,60,2,222,'pants/808.gif',2,4,NULL),(1219,NULL,100,3,10,42,45,2,88,'pants/809.gif',NULL,3,NULL),(1220,NULL,130,1,2,117,148,1,117,'pants/810.gif',2,4,NULL),(1221,NULL,NULL,1,20,23,36,1,NULL,NULL,NULL,NULL,NULL),(1222,NULL,230,3,9,70,90,1,218,'pants/812.gif',NULL,3,NULL),(1223,NULL,165,2,4,73,136,2,150,'pants/813.gif',NULL,4,NULL),(1224,NULL,260,1,6,120,114,2,244,'pants/814.gif',2,2,NULL),(1225,NULL,260,1,8,120,75,2,244,'pants/815.gif',NULL,4,NULL),(1226,NULL,180,3,6,82,114,2,168,'pants/816.gif',NULL,2,NULL),(1227,NULL,245,3,12,75,105,2,233,'pants/817.gif',NULL,2,NULL),(1228,NULL,225,3,18,67,63,2,209,'pants/818.gif',NULL,4,NULL),(1229,NULL,210,1,6,95,140,2,194,'pants/819.gif',13,3,NULL),(1230,NULL,125,1,8,25,164,1,112,'pants/820.gif',2,11,NULL),(1231,NULL,150,2,4,135,85,1,135,'pants/821.gif',NULL,2,NULL),(1232,NULL,195,3,6,89,112,2,182,'pants/822.gif',NULL,4,NULL),(1233,NULL,145,3,4,64,184,2,131,'pants/823.gif',NULL,7,NULL),(1234,NULL,100,3,15,26,60,1,86,'pants/824.gif',NULL,4,NULL),(1235,NULL,70,1,30,25,16,1,54,'pants/825.gif',1,3,NULL),(1236,NULL,270,2,12,84,84,2,258,'pants/826.gif',NULL,3,NULL),(1237,NULL,225,3,12,50,124,2,209,'pants/827.gif',NULL,3,NULL),(1238,NULL,185,3,12,40,90,1,169,'pants/828.gif',NULL,3,NULL),(1239,NULL,215,1,8,47,148,2,200,'pants/829.gif',2,4,NULL),(1240,NULL,260,3,10,122,78,1,248,'pants/830.gif',NULL,3,NULL),(1241,NULL,265,1,8,60,171,1,249,'pants/831.jpg',2,4,NULL),(1242,NULL,160,1,1,140,300,1,140,'pants/832.jpg',3,5,NULL),(1243,NULL,100,3,4,43,135,1,89,'pants/833.jpg',2,5,NULL),(1244,NULL,225,1,8,50,187,1,209,'pants/834.jpg',2,4,NULL),(1245,NULL,125,3,3,110,110,1,110,'pants/835.gif',NULL,6,NULL),(1246,NULL,240,3,10,111,58,1,226,'pants/836.gif',NULL,3,NULL),(1247,NULL,100,3,3,88,78,1,88,'pants/837.gif',NULL,2,NULL),(1248,NULL,100,3,4,89,74,1,89,'pants/838.gif',NULL,2,NULL),(1249,NULL,185,3,15,55,56,1,171,'pants/839.gif',NULL,5,NULL),(1250,NULL,115,3,10,50,44,1,103,'pants/840.gif',NULL,4,NULL),(1251,NULL,NULL,3,4,76,64,1,NULL,NULL,NULL,NULL,NULL),(1252,NULL,120,3,4,107,71,2,107,'pants/842.gif',NULL,3,NULL),(1253,NULL,265,3,16,60,66,1,252,'pants/843.gif',NULL,4,NULL),(1254,NULL,215,3,6,65,170,1,203,'pants/844.gif',NULL,5,NULL),(1255,NULL,240,1,6,110,110,2,224,'pants/845.gif',3,6,NULL),(1256,NULL,145,3,6,63,97,2,130,'pants/846.gif',NULL,5,NULL),(1257,NULL,255,1,6,77,185,2,239,'pants/847.gif',2,6,NULL),(1258,NULL,180,3,8,80,82,2,164,'pants/848.gif',NULL,5,NULL),(1259,NULL,135,1,18,58,33,2,120,'pants/849.gif',NULL,2,NULL),(1260,NULL,190,3,2,175,142,1,175,'pants/850.gif',NULL,11,NULL),(1261,NULL,245,3,12,55,99,1,229,'pants/895.gif',NULL,3,NULL),(1262,NULL,280,3,6,132,100,1,267,'pants/906.gif',NULL,6,NULL),(1263,NULL,165,3,6,150,60,1,150,'pants/907.gif',NULL,4,NULL),(1264,NULL,155,1,2,68,201,1,140,'pants/908.gif',NULL,40,NULL),(1265,NULL,175,3,4,161,68,1,161,'pants/909.gif',NULL,2,NULL),(1266,NULL,150,3,4,133,71,1,133,'pants/910.gif',NULL,6,NULL),(1267,NULL,145,3,4,80,128,1,128,'pants/919.gif',NULL,7,NULL),(1268,NULL,NULL,1,4,26,18,1,110,'pants/920.gif',NULL,NULL,NULL),(1269,NULL,240,1,2,110,300,1,223,'pants/922.gif',NULL,5,NULL),(1270,NULL,245,3,4,230,85,1,230,'pants/923.gif',NULL,2,NULL),(1271,NULL,180,3,9,54,130,1,168,'pants/878.gif',NULL,4,NULL),(1272,NULL,155,3,18,68,30,1,140,'pants/879.gif',NULL,4,NULL),(1273,NULL,190,3,3,174,90,1,174,'pants/898.gif',NULL,3,NULL),(1274,NULL,215,3,6,65,150,1,201,'pants/911.gif',NULL,2,NULL),(1275,NULL,245,3,15,75,61,1,231,'pants/912.gif',NULL,3,NULL),(1276,NULL,260,3,6,120,120,1,243,'pants/913.gif',NULL,7,NULL),(1277,NULL,230,3,16,50,135,1,215,'pants/914.gif',NULL,NULL,NULL),(1278,NULL,120,3,8,50,70,1,103,'pants/917.gif',NULL,4,NULL),(1279,NULL,NULL,3,8,52,33,1,105,NULL,NULL,NULL,NULL),(1280,NULL,230,1,6,105,124,2,214,'pants/851.gif',8,3,NULL),(1281,NULL,170,1,4,158,72,2,158,'pants/852.gif',2,4,NULL),(1282,NULL,240,3,6,74,133,2,228,'pants/853.gif',NULL,7,NULL),(1283,NULL,255,3,15,78,57,2,240,'pants/854.gif',NULL,4,NULL),(1284,NULL,260,3,8,122,92,1,248,'pants/855.gif',NULL,3,NULL),(1285,NULL,155,1,6,44,185,2,140,'pants/856.gif',2,6,NULL),(1286,NULL,280,1,5,50,300,2,266,'pants/857.gif',2,5,NULL),(1287,NULL,125,2,44,25,25,1,109,'pants/858.gif',NULL,3,NULL),(1288,NULL,155,1,2,140,300,1,140,'pants/859.gif',2,NULL,NULL),(1289,NULL,150,3,4,65,114,1,134,'pants/860.gif',NULL,7,NULL),(1290,NULL,250,3,8,115,72,1,234,'pants/861.gif',NULL,4,NULL),(1291,NULL,245,3,6,75,180,1,233,'pants/862.gif',NULL,11,NULL),(1292,NULL,225,3,6,165,69,1,214,'pants/863.gif',NULL,10,NULL),(1293,NULL,235,3,6,72,169,1,223,'pants/864.gif',NULL,6,NULL),(1294,NULL,235,3,6,72,155,1,223,'pants/865.gif',NULL,4,NULL),(1295,NULL,230,3,6,69,145,1,214,'pants/866.gif',NULL,7,NULL),(1296,NULL,220,3,6,100,130,2,204,'pants/867.gif',NULL,4,NULL),(1297,NULL,230,3,6,150,69,2,214,'pants/868.gif',NULL,9,NULL),(1298,NULL,190,3,6,87,112,1,177,'pants/869.gif',NULL,5,NULL),(1299,NULL,235,3,6,72,180,1,223,'pants/870.gif',NULL,11,NULL),(1300,NULL,220,3,8,48,133,1,204,'pants/871.gif',NULL,7,NULL),(1301,NULL,220,3,8,49,185,1,205,'pants/872.gif',NULL,6,NULL),(1302,NULL,145,3,8,63,67,1,130,'pants/873.gif',NULL,3,NULL),(1303,NULL,100,1,4,40,199,1,84,'pants/874.gif',NULL,3,NULL),(1304,NULL,120,3,4,105,188,1,105,'pants/875.gif',NULL,3,NULL),(1305,NULL,120,3,6,63,105,1,105,'pants/876.gif',NULL,7,NULL),(1306,NULL,205,1,12,45,113,1,192,'pants/877.gif',2,3,NULL),(1307,NULL,255,1,20,58,70,1,241,'pants/921.gif',NULL,2,NULL),(1308,NULL,125,1,36,29,26,1,113,'pants/880.gif',NULL,5,NULL),(1309,NULL,240,3,4,225,70,1,225,'pants/881.gif',NULL,6,NULL),(1310,NULL,230,1,6,70,156,1,218,'pants/882.jpg',2,3,NULL),(1311,NULL,165,3,4,73,212,1,150,'pants/883.jpg',NULL,2,NULL),(1312,NULL,240,3,6,111,140,1,226,'pants/884.jpg',NULL,3,NULL),(1313,NULL,215,2,2,199,199,1,199,'pants/885.jpg',NULL,2,NULL),(1314,NULL,135,3,20,27,60,1,120,'pants/886.jpg',NULL,4,NULL),(1315,NULL,NULL,1,3,22,42,1,130,NULL,NULL,NULL,NULL),(1316,NULL,105,3,3,88,99,1,88,'pants/888.jpg',NULL,3,NULL),(1317,NULL,105,3,3,88,99,1,88,'pants/889.jpg',NULL,3,NULL),(1318,NULL,155,1,3,140,90,1,140,'pants/899.gif',6,3,NULL),(1319,NULL,235,1,4,220,82,1,220,'pants/901.gif',NULL,5,NULL),(1320,NULL,215,1,4,200,75,1,200,'pants/902.gif',NULL,4,NULL),(1321,NULL,260,3,8,120,73,1,243,'pants/903.gif',NULL,3,NULL),(1322,NULL,160,3,8,70,85,1,143,'pants/904.gif',NULL,2,NULL),(1323,NULL,280,3,4,130,155,1,264,'pants/890.gif',NULL,4,NULL),(1324,NULL,175,3,2,158,173,1,158,'pants/891.gif',NULL,2,NULL),(1325,NULL,175,3,2,158,173,1,158,'pants/892.gif',NULL,2,NULL),(1326,NULL,230,3,2,215,212,1,215,'pants/893.gif',NULL,2,NULL),(1327,NULL,230,3,2,215,212,1,215,'pants/894.gif',NULL,2,NULL),(1328,NULL,145,3,3,130,96,1,130,'pants/900.gif',NULL,2,NULL),(1329,NULL,80,3,3,66,90,1,66,'pants/916.gif',NULL,8,NULL),(1330,NULL,155,3,2,140,143,1,140,'pants/896.gif',NULL,9,NULL),(1331,NULL,155,3,2,140,143,1,140,'pants/897.gif',NULL,9,NULL),(1332,NULL,160,1,10,74,45,1,151,'pants/905.gif',NULL,3,NULL),(1333,NULL,230,1,2,105,325,1,214,'pants/915.gif',NULL,24,NULL),(1334,NULL,240,2,6,111,111,1,225,'pants/924.gif',NULL,5,NULL),(1335,NULL,179,3,30,25,80,1,165,'pants/926.gif',NULL,6,NULL),(1336,NULL,280,1,24,40,58,1,270,'pants/935.gif',NULL,6,NULL),(1337,NULL,235,1,12,70,53,1,218,'pants/936.gif',NULL,4,NULL),(1338,NULL,218,3,8,100,83,1,203,'pants/938.gif',NULL,4,NULL),(1339,NULL,205,3,4,140,120,1,188,'pants/944.gif',NULL,NULL,NULL),(1340,NULL,260,1,4,120,199,1,243,'pants/945.gif',NULL,3,NULL),(1341,NULL,NULL,1,4,20,40,1,82,NULL,NULL,NULL,NULL),(1342,NULL,240,1,16,55,95,1,224,'pants/947.gif',NULL,NULL,NULL),(1343,NULL,160,2,2,145,145,1,145,'pants/948.gif',NULL,4,NULL),(1344,NULL,115,3,12,17,127,1,102,'pants/950.gif',NULL,8,NULL),(1345,NULL,120,1,2,104,210,1,104,'pants/953.gif',NULL,4,NULL),(1346,NULL,NULL,1,2,62,93,1,126,NULL,NULL,NULL,NULL),(1347,NULL,245,3,12,73,73,1,226,'pants/955.gif',NULL,3,NULL),(1348,NULL,180,3,3,167,75,1,167,'pants/958.gif',NULL,4,NULL),(1349,NULL,190,3,12,85,55,1,173,'pants/967.gif',NULL,3,NULL),(1350,NULL,265,3,4,250,75,1,250,'pants/970.gif',NULL,4,NULL),(1351,NULL,240,3,6,110,95,1,223,'pants/974.gif',NULL,7,NULL),(1352,NULL,160,1,4,35,254,1,150,'pants/976.png',NULL,16,NULL),(1353,NULL,275,3,8,64,150,1,265,'pants/980.png',NULL,2,NULL),(1354,NULL,230,1,18,70,45,1,216,'pants/981.png',NULL,3,NULL),(1355,NULL,155,3,4,146,67,1,137,'pants/983.gif',NULL,6,NULL),(1356,NULL,155,3,5,140,80,1,140,'pants/991.gif',NULL,6,NULL),(1357,NULL,220,3,8,99,72,1,203,'pants/992.gif',NULL,4,NULL),(1358,NULL,120,1,14,50,30,1,103,'pants/999.gif',NULL,3,NULL),(1359,NULL,130,3,2,115,150,1,115,'pants/1003.gif',NULL,NULL,NULL),(1360,NULL,180,1,4,80,110,1,163,'pants/1004.gif',NULL,4,NULL),(1361,NULL,185,3,6,90,83,1,170,'pants/1005.gif',NULL,3,NULL),(1362,NULL,280,1,4,133,145,1,270,'pants/1007.png',NULL,7,NULL),(1363,NULL,195,3,12,87,64,1,177,'pants/1009.gif',NULL,3,NULL),(1364,NULL,150,3,4,116,65,1,133,'pants/1010.gif',NULL,3,NULL),(1365,NULL,110,2,10,45,45,1,93,'pants/1011.png',NULL,3,NULL),(1366,NULL,220,1,4,100,166,1,203,'pants/1017.gif',NULL,5,NULL),(1367,NULL,200,1,12,44,101,1,185,'pants/1018.gif',NULL,5,NULL),(1368,NULL,215,2,9,65,65,1,201,'pants/1358.gif',NULL,3,NULL),(1369,NULL,145,1,4,65,187,1,133,'pants/1376.gif',2,4,NULL),(1370,NULL,250,3,5,45,347,1,237,'pants/1377.gif',NULL,2,NULL),(1371,NULL,225,3,4,102,135,1,209,'pants/1384.gif',NULL,5,NULL),(1372,NULL,245,1,4,114,185,1,231,'pants/1390.png',2,6,NULL),(1373,NULL,155,3,2,139,99,1,139,'pants/1391.png',0,3,NULL),(1374,NULL,210,3,4,93,105,1,190,'pants/1395.png',0,6,NULL),(1375,NULL,150,3,12,44,50,1,138,'pants/1396.gif',NULL,3,NULL),(1376,NULL,145,3,3,133,70,1,133,'pants/1397.gif',NULL,6,NULL),(1377,NULL,230,3,4,105,165,1,214,'pants/1398.gif',NULL,6,NULL),(1378,NULL,210,1,6,95,97,1,194,'pants/1399.gif',2,5,NULL),(1379,NULL,220,1,8,103,73,1,210,'pants/1400.gif',2,3,NULL),(1380,NULL,115,1,5,100,40,1,100,'pants/1407.gif',2,3,NULL),(1381,NULL,235,3,4,109,170,1,221,'pants/1408.gif',NULL,5,NULL),(1382,NULL,270,1,6,40,345,2,255,'pants/1436.gif',2,4,NULL),(1383,NULL,270,3,8,62,150,2,257,'pants/1464.gif',NULL,2,NULL),(1384,NULL,210,3,4,46,190,1,193,'pants/1465.gif',NULL,13,NULL),(1385,NULL,230,3,9,70,120,2,216,'pants/1477.gif',NULL,7,NULL),(1386,NULL,225,3,20,50,82,2,209,'pants/1506.gif',NULL,4,NULL),(1387,NULL,165,1,4,75,210,2,153,'pants/1507.gif',2,4,NULL),(1388,NULL,100,1,5,100,100,1,100,NULL,2,2,NULL),(1389,NULL,195,1,3,180,125,2,180,'pants/1513.gif',2,9,NULL),(1390,NULL,210,3,3,195,70,1,195,'pants/1514.gif',NULL,4,NULL),(1391,NULL,245,3,12,55,62,2,229,'pants/1516.gif',NULL,6,NULL),(1392,NULL,165,1,8,75,104,2,153,'pants/1519.gif',2,3,NULL),(1393,NULL,280,1,4,133,135,2,269,'pants/1533.gif',NULL,5,NULL),(1394,NULL,200,1,6,90,89,2,184,'pants/1534.gif',2,4,NULL),(1395,NULL,280,1,8,132,75,2,268,'pants/1535.gif',2,4,NULL),(1396,NULL,125,1,14,55,45,2,113,'pants/1550.gif',1,5,NULL),(1397,NULL,165,3,1,150,397,1,150,'pants/1555.gif',NULL,6,NULL),(1398,NULL,245,1,12,55,70,2,229,'pants/1562.gif',3,4,NULL),(1399,NULL,160,3,9,46,125,2,146,'pants/1563.gif',NULL,9,NULL),(1400,NULL,205,3,2,95,200,1,193,'pants/1565.gif',NULL,3,NULL),(1401,NULL,120,1,34,50,10,2,103,'pants/1566.gif',2,3,NULL),(1402,NULL,225,3,6,105,140,2,213,'pants/1569.gif',NULL,3,NULL),(1403,NULL,205,1,8,45,97,2,189,'pants/1578.gif',2,5,NULL),(1404,NULL,140,3,33,40,15,1,128,'pants/1617.gif',1,3,NULL),(1405,NULL,230,3,12,52,62,1,217,'pants/1643.gif',0,6,NULL),(1406,NULL,245,1,9,75,103,2,231,'pants/1650.gif',2,3,NULL),(1407,NULL,205,3,3,61,300,1,189,'pants/1655.gif',0,5,NULL),(1408,NULL,175,3,1,150,230,1,150,'pants/1658.gif',0,8,NULL),(1409,NULL,135,3,10,60,38,1,123,'pants/1673.gif',0,3,NULL),(1410,NULL,200,3,2,92,300,1,188,'pants/1688.gif',0,0,NULL),(1411,NULL,225,3,2,209,166,1,209,'pants/1677.gif',0,5,NULL),(1412,NULL,205,3,4,93,95,2,189,'pants/1678.gif',0,7,NULL),(1413,NULL,175,3,10,80,40,1,163,'pants/1680.gif',0,3,NULL),(1414,NULL,150,3,5,134,59,1,271,'pants/1681.gif',0,5,NULL),(1415,NULL,180,3,2,168,129,1,168,'pants/1682.gif',0,11,NULL),(1416,NULL,150,1,30,20,40,1,135,'pants/1689.gif',2,3,NULL),(1417,NULL,165,3,8,73,73,1,149,'pants/1691.gif',0,3,NULL),(1418,NULL,175,3,2,161,137,1,161,'pants/1703.gif',0,3,NULL),(1419,NULL,225,3,4,105,135,2,213,'pants/1697.gif',0,5,NULL),(1420,NULL,175,3,2,161,137,1,161,'pants/1704.gif',0,3,NULL),(1421,NULL,175,3,2,159,137,1,159,'pants/1705.gif',0,3,NULL),(1422,NULL,260,1,15,80,60,1,247,'pants/1342.gif',2,4,NULL),(1423,NULL,135,1,10,58,60,1,120,'pants/1343.gif',2,5,NULL),(1424,NULL,260,1,20,58,58,1,244,'pants/1347.gif',2,3,NULL),(1425,NULL,215,3,6,99,82,1,200,'pants/1350.gif',NULL,3,NULL),(1426,NULL,115,3,6,50,72,1,103,'pants/1351.gif',NULL,4,NULL),(1427,NULL,220,1,4,102,150,1,208,'pants/1383.gif',9,2,NULL),(1428,NULL,220,1,6,100,130,1,204,'pants/1401.gif',3,4,NULL),(1429,NULL,140,3,16,30,55,1,129,'pants/1403.gif',NULL,2,NULL),(1430,NULL,175,3,16,38,83,1,161,'pants/1404.gif',NULL,4,NULL),(1431,NULL,215,1,1,200,300,1,200,'pants/1405.gif',4,5,NULL),(1432,NULL,280,3,2,130,270,1,262,'pants/1411.gif',NULL,9,NULL),(1433,NULL,205,3,4,96,188,1,193,'pants/1412.gif',NULL,3,NULL),(1434,NULL,150,3,4,134,82,1,134,'pants/1414.gif',NULL,5,NULL),(1435,NULL,255,1,12,58,90,2,238,'pants/1417.gif',2,3,NULL),(1436,NULL,235,3,6,72,110,2,223,'pants/1418.gif',NULL,4,NULL),(1437,NULL,280,2,12,65,95,2,269,'pants/1420.gif',NULL,7,NULL),(1438,NULL,130,1,52,55,6,1,115,'pants/1422.gif',1,3,NULL),(1439,NULL,255,3,6,78,105,1,240,'pants/1423.gif',NULL,6,NULL),(1440,NULL,270,3,6,82,134,2,254,'pants/1457.gif',NULL,6,NULL),(1441,NULL,130,1,4,27,272,2,117,'pants/1475.gif',2,7,NULL),(1442,NULL,270,3,2,255,155,1,255,'pants/1483.gif',NULL,4,NULL),(1443,NULL,175,3,10,80,82,1,163,'pants/1497.gif',NULL,4,NULL),(1444,NULL,155,3,4,70,112,2,143,'pants/1520.gif',NULL,3,NULL),(1445,NULL,130,3,2,57,250,2,117,'pants/1522.jpg',NULL,NULL,NULL),(1446,NULL,155,1,5,140,80,2,140,'pants/1524.jpg',2,6,NULL),(1447,NULL,245,2,1,230,230,2,230,'pants/1532.gif',NULL,8,NULL),(1448,NULL,235,3,10,110,80,1,223,'pants/1536.gif',NULL,6,NULL),(1449,NULL,160,3,3,142,92,1,142,'pants/1537.gif',NULL,3,NULL),(1450,NULL,135,1,16,60,25,2,123,'pants/1545.gif',2,3,NULL),(1451,NULL,180,3,10,80,80,1,163,'pants/1546.gif',NULL,6,NULL),(1452,NULL,140,3,4,62,140,1,127,'pants/1547.gif',NULL,3,NULL),(1453,NULL,180,1,4,165,85,2,165,'pants/1549.gif',2,3,NULL),(1454,NULL,235,1,8,110,75,1,223,'pants/1626.gif',1,4,NULL),(1455,NULL,235,3,2,110,265,1,223,'pants/1593.gif',3,14,NULL),(1456,NULL,185,1,8,40,185,1,169,'pants/1594.gif',3,6,NULL),(1457,NULL,110,1,6,30,111,1,96,'pants/1597.gif',2,3,NULL),(1458,NULL,165,1,2,150,180,2,150,'pants/1624.gif',2,11,NULL),(1459,NULL,185,1,1,170,230,1,170,'pants/1625.gif',4,0,NULL),(1460,NULL,215,3,8,100,72,2,203,'pants/1631.gif',0,4,NULL),(1461,NULL,220,1,4,100,140,2,204,'pants/1633.gif',2,3,NULL),(1462,NULL,175,1,2,160,148,2,160,'pants/1637.gif',3,4,NULL),(1463,NULL,200,2,12,60,60,1,187,'pants/1710.gif',0,4,NULL),(1464,NULL,175,3,9,52,112,2,162,'pants/1695.gif',0,4,NULL),(1465,NULL,235,1,3,222,94,2,222,'pants/1696.gif',2,8,NULL),(1466,NULL,230,1,60,41,24,2,217,'pants/1711.gif',2,3,NULL),(1467,NULL,260,1,9,80,80,2,246,'pants/1714.gif',2,5,NULL),(1468,NULL,175,1,12,80,50,2,163,'pants/1721.gif',14,3,NULL),(1469,NULL,195,1,40,43,25,1,181,'pants/1725.gif',2,3,NULL),(1470,NULL,180,1,1,165,226,2,165,'pants/1339.png',2,3,NULL),(1471,NULL,275,1,24,40,74,1,260,'pants/1340.gif',2,2,NULL),(1472,NULL,260,2,9,80,116,1,248,'pants/1341.gif',NULL,11,NULL),(1473,NULL,245,1,2,115,245,1,233,'pants/1344.gif',4,3,NULL),(1474,NULL,170,3,4,37,237,1,157,'pants/1345.gif',0,11,NULL),(1475,NULL,250,3,4,116,156,1,235,'pants/1349.gif',NULL,3,NULL),(1476,NULL,160,1,16,72,25,1,147,'pants/1352.gif',2,4,NULL),(1477,NULL,70,1,34,25,10,1,53,'pants/1353.gif',2,3,NULL),(1478,NULL,120,1,24,25,55,1,109,'pants/1356.gif',2,3,NULL),(1479,NULL,155,1,16,70,25,1,143,'pants/1357.gif',2,3,NULL),(1480,NULL,160,3,2,145,150,1,145,'pants/1378.gif',NULL,NULL,NULL),(1481,NULL,165,3,1,151,345,1,151,'pants/1393.png',0,0,NULL),(1482,NULL,145,3,1,130,270,1,130,'pants/1394.png',0,0,NULL),(1483,NULL,230,2,4,107,107,1,217,'pants/1413.gif',NULL,7,NULL),(1484,NULL,240,2,6,74,110,2,228,'pants/1439.gif',NULL,4,NULL),(1485,NULL,220,1,4,100,150,2,203,'pants/1443.gif',3,2,NULL),(1486,NULL,140,3,6,62,102,1,127,'pants/1444.gif',NULL,4,NULL),(1487,NULL,135,1,4,58,135,1,119,'pants/1478.gif',2,5,NULL),(1488,NULL,200,3,8,90,76,1,183,'pants/1479.gif',NULL,3,NULL),(1489,NULL,260,1,4,120,136,1,243,'pants/1480.gif',2,4,NULL),(1490,NULL,135,1,16,28,47,1,122,'pants/1481.gif',3,4,NULL),(1491,NULL,180,3,4,80,100,2,164,'pants/1492.gif',NULL,2,NULL),(1492,NULL,195,3,6,90,70,1,183,'pants/1499.gif',NULL,4,NULL),(1493,NULL,195,3,5,180,80,1,180,'pants/1548.gif',NULL,6,NULL),(1494,NULL,255,1,16,58,75,2,241,'pants/1567.gif',2,4,NULL),(1495,NULL,135,3,3,120,70,1,120,'pants/1568.gif',NULL,4,NULL),(1496,NULL,195,3,3,180,70,1,180,'pants/1570.gif',NULL,4,NULL),(1497,NULL,280,1,1,270,425,1,270,'pants/1610.gif',5,4,NULL),(1498,NULL,270,3,4,127,170,1,257,'pants/1601.gif',2,5,NULL),(1499,NULL,125,1,16,26,75,2,113,'pants/1604.gif',2,4,NULL),(1500,NULL,155,1,36,20,30,1,140,'pants/1621.gif',2,4,NULL),(1501,NULL,250,3,16,57,53,1,237,'pants/1628.gif',NULL,4,NULL),(1502,NULL,125,3,42,15,40,1,110,'pants/1629.gif',NULL,4,NULL),(1503,NULL,250,3,8,115,84,1,233,'pants/1630.gif',NULL,3,NULL),(1504,NULL,180,1,35,30,45,1,166,'pants/1635.gif',2,5,NULL),(1505,NULL,120,1,9,33,72,1,105,'pants/1644.gif',2,2,NULL),(1506,NULL,225,1,4,104,210,2,211,'pants/1645.gif',1,4,NULL),(1507,NULL,155,1,2,70,400,1,143,'pants/1646.gif',2,0,NULL),(1508,NULL,200,3,3,60,260,1,188,'pants/1647.gif',0,19,NULL),(1509,NULL,115,1,22,50,15,2,103,'pants/1666.gif',2,3,NULL),(1510,NULL,235,3,12,53,86,1,219,'pants/1670.gif',0,8,NULL),(1511,NULL,255,3,12,58,90,2,241,'pants/1729.gif',0,3,NULL),(1512,NULL,165,1,2,150,160,2,150,'pants/1730.gif',2,4,NULL),(1513,NULL,190,1,12,58,70,1,174,'pants/1731.gif',0,0,NULL),(1514,NULL,155,1,12,70,48,2,143,'pants/1732.gif',8,3,NULL),(1515,NULL,225,3,12,103,48,2,209,'pants/1733.gif',0,3,NULL),(1516,NULL,280,3,6,87,108,2,267,'pants/1734.gif',0,6,NULL),(1517,NULL,205,3,6,190,35,1,190,'pants/1735.gif',0,3,NULL),(1518,NULL,100,1,88,19,6,1,85,'pants/1736.gif',2,3,NULL),(1519,NULL,210,3,4,96,187,1,195,'pants/1737.gif',0,4,NULL),(1520,NULL,275,3,2,130,270,1,263,'pants/1738.gif',0,0,NULL),(1521,NULL,205,3,4,95,154,1,193,'pants/1739.gif',0,5,NULL),(1522,NULL,255,1,12,58,70,2,241,'pants/1740.gif',2,4,NULL),(1523,NULL,100,1,44,19,6,1,79,'pants/1741.gif',2,3,NULL),(1524,NULL,235,3,6,71,107,2,219,'pants/1742.gif',0,4,NULL),(1525,NULL,205,1,2,93,200,2,189,'pants/1743.gif',10,0,NULL),(1526,NULL,275,1,5,50,220,2,262,'pants/1744.gif',2,0,NULL),(1527,NULL,275,1,5,50,270,2,262,'pants/1745.gif',2,0,NULL),(1528,NULL,265,1,8,60,153,2,249,'pants/1746.gif',2,6,NULL),(1529,NULL,225,1,16,50,50,2,209,'pants/1747.gif',2,3,NULL),(1530,NULL,70,1,5,58,40,1,58,'pants/1748.gif',4,3,NULL),(1531,NULL,255,3,4,120,148,1,243,'pants/1749.gif',0,4,NULL),(1532,NULL,185,1,6,85,64,1,173,'pants/1750.gif',10,4,NULL),(1533,NULL,195,1,2,180,135,1,180,'pants/1751.gif',2,5,NULL),(1534,NULL,100,1,21,10,81,1,91,'pants/1752.gif',2,4,NULL),(1535,NULL,145,3,8,30,100,1,129,'pants/1753.gif',0,6,NULL),(1536,NULL,205,3,8,45,135,1,189,'pants/1754.gif',0,5,NULL),(1537,NULL,230,1,6,70,156,2,218,'pants/1755.gif',2,3,NULL),(1538,NULL,265,3,24,60,45,2,249,'pants/1756.gif',0,3,NULL),(1539,NULL,225,3,12,50,90,2,209,'pants/1757.gif',0,3,NULL),(1540,NULL,275,1,8,63,149,2,261,'pants/1758.gif',6,3,NULL),(1541,NULL,160,3,2,135,102,1,135,'pants/1759.gif',0,4,NULL),(1542,NULL,215,3,6,65,150,1,201,'pants/1762.gif',0,2,NULL),(1543,NULL,140,2,21,40,40,1,126,'pants/1761.gif',0,4,NULL),(1544,NULL,130,2,14,58,30,1,119,'pants/1374.gif',NULL,3,NULL),(1545,NULL,200,3,6,90,90,1,183,'pants/1381.gif',NULL,3,NULL),(1546,NULL,190,3,1,158,400,1,175,'pants/1388.gif',NULL,3,NULL),(1547,NULL,235,1,6,70,110,2,218,'pants/1392.png',2,4,NULL),(1548,NULL,160,1,2,150,148,1,150,'pants/1410.gif',12,4,NULL),(1549,NULL,265,3,12,60,99,2,252,'pants/1455.gif',NULL,3,NULL),(1550,NULL,280,1,4,130,150,2,264,'pants/1459.gif',5,3,NULL),(1551,NULL,205,3,1,191,175,2,191,'pants/1470.gif',NULL,28,NULL),(1552,NULL,280,1,12,130,55,2,264,'pants/1473.gif',5,3,NULL),(1553,NULL,165,1,3,150,65,2,150,'pants/1474.gif',6,3,NULL),(1554,NULL,135,1,4,58,100,2,120,'pants/1485.gif',3,2,NULL),(1555,NULL,170,1,4,75,100,2,154,'pants/1487.gif',2,2,NULL),(1556,NULL,160,3,4,72,110,1,148,'pants/1495.gif',NULL,4,NULL),(1557,NULL,185,3,12,40,70,1,169,'pants/1501.gif',NULL,4,NULL),(1558,NULL,220,3,8,48,133,1,204,'pants/1504.gif',NULL,7,NULL),(1559,NULL,230,3,6,70,172,2,216,'pants/1515.gif',NULL,3,NULL),(1560,NULL,175,3,12,80,60,1,163,'pants/1518.gif',NULL,4,NULL),(1561,NULL,175,3,7,160,40,1,160,'pants/1528.gif',NULL,4,NULL),(1562,NULL,230,1,2,215,110,2,215,'pants/1530.gif',2,4,NULL),(1563,NULL,210,3,6,95,65,2,193,'pants/1544.gif',NULL,3,NULL),(1564,NULL,175,3,4,160,75,1,160,'pants/1564.gif',NULL,4,NULL),(1565,NULL,195,3,2,90,250,2,183,'pants/1572.gif',NULL,4,NULL),(1566,NULL,220,3,2,101,200,1,204,'pants/1573.gif',NULL,4,NULL),(1567,NULL,155,3,3,140,92,1,140,'pants/1613.gif',NULL,3,NULL),(1568,NULL,245,1,8,115,75,2,233,'pants/1622.gif',1,4,NULL),(1569,NULL,235,1,4,110,145,2,223,'pants/1623.gif',1,7,NULL),(1570,NULL,125,1,22,54,18,2,111,'pants/1634.gif',1,5,NULL),(1571,NULL,160,3,2,135,102,2,135,'pants/1636.gif',0,4,NULL),(1572,NULL,110,1,15,30,45,1,96,'pants/1591.gif',2,3,NULL),(1573,NULL,235,3,2,110,230,1,223,'pants/1592.gif',3,18,NULL),(1574,NULL,200,1,3,60,262,1,186,'pants/1595.gif',3,17,NULL),(1575,NULL,100,1,45,26,12,2,84,'pants/1596.gif',1,3,NULL),(1576,NULL,230,3,8,106,75,1,215,'pants/1598.gif',NULL,4,NULL),(1577,NULL,275,1,9,85,70,2,261,'pants/1612.gif',2,6,NULL),(1578,NULL,215,3,4,100,155,1,205,'pants/1359.gif',NULL,4,NULL),(1579,NULL,185,3,18,83,20,1,170,'pants/1360.gif',NULL,3,NULL),(1580,NULL,155,1,3,140,64,1,140,'pants/1364.png',2,4,NULL),(1581,NULL,245,3,8,55,124,1,229,'pants/1365.png',0,3,NULL),(1582,NULL,245,3,12,55,124,1,229,'pants/1366.png',0,3,NULL),(1583,NULL,175,3,2,161,162,2,161,'pants/1368.png',0,3,NULL),(1584,NULL,185,3,6,85,90,1,173,'pants/1371.gif',NULL,3,NULL),(1585,NULL,145,1,30,19,40,1,129,'pants/1387.gif',2,3,NULL),(1586,NULL,185,1,76,40,12,1,169,'pants/1389.gif',2,3,NULL),(1587,NULL,135,1,20,60,18,1,123,'pants/1406.gif',2,3,NULL),(1588,NULL,110,3,5,95,58,1,95,'pants/1415.gif',NULL,3,NULL),(1589,NULL,280,1,12,130,55,1,263,'pants/1416.gif',7,3,NULL),(1590,NULL,265,1,16,60,85,2,249,'pants/1419.gif',2,2,NULL),(1591,NULL,160,3,3,143,65,1,143,'pants/1421.gif',NULL,3,NULL),(1592,NULL,270,3,6,84,185,1,258,'pants/1425.gif',NULL,6,NULL),(1593,NULL,100,1,18,40,29,1,83,'pants/1429.gif',2,3,NULL),(1594,NULL,170,1,4,75,105,2,153,'pants/1432.gif',2,9,NULL),(1595,NULL,140,3,10,60,60,1,123,'pants/1437.gif',NULL,4,NULL),(1596,NULL,220,3,4,100,155,2,203,'pants/1438.gif',NULL,4,NULL),(1597,NULL,215,1,4,100,135,2,203,'pants/1440.gif',3,5,NULL),(1598,NULL,200,1,6,90,70,2,183,'pants/1441.gif',3,6,NULL),(1599,NULL,260,3,8,58,162,2,244,'pants/1445.gif',NULL,13,NULL),(1600,NULL,265,1,4,60,275,2,249,'pants/1447.gif',2,4,NULL),(1601,NULL,220,1,6,100,90,2,204,'pants/1452.gif',2,3,NULL),(1602,NULL,265,3,8,60,148,2,252,'pants/1476.gif',NULL,4,NULL),(1603,NULL,270,3,4,125,135,2,254,'pants/1489.gif',NULL,5,NULL),(1604,NULL,135,3,4,120,50,2,120,'pants/1493.gif',NULL,3,NULL),(1605,NULL,240,2,24,54,54,1,225,'pants/1494.gif',NULL,4,NULL),(1606,NULL,250,3,8,115,85,1,233,'pants/1496.gif',NULL,3,NULL),(1607,NULL,225,3,4,102,130,2,208,'pants/1502.gif',NULL,10,NULL),(1608,NULL,200,3,6,90,100,1,184,'pants/1503.gif',NULL,6,NULL),(1609,NULL,135,1,12,58,30,1,119,'pants/1508.gif',1,4,NULL),(1610,NULL,135,1,12,18,176,2,123,'pants/1509.gif',2,5,NULL),(1611,NULL,105,1,4,45,110,2,93,'pants/1510.gif',2,4,NULL),(1612,NULL,235,3,12,110,55,2,223,'pants/1517.gif',NULL,3,NULL),(1613,NULL,175,3,5,160,60,1,160,'pants/1523.jpg',NULL,4,NULL),(1614,NULL,165,1,3,150,80,2,150,'pants/1529.gif',2,5,NULL),(1615,NULL,135,3,10,60,38,2,123,'pants/1531.gif',NULL,3,NULL),(1616,NULL,180,3,8,81,92,2,165,'pants/1539.jpg',NULL,3,NULL),(1617,NULL,225,1,9,68,112,2,210,'pants/1541.gif',9,4,NULL),(1618,NULL,220,1,20,49,78,2,205,'pants/1542.gif',7,3,NULL),(1619,NULL,160,1,54,22,39,2,147,'pants/1574.gif',1,3,NULL),(1620,NULL,215,1,18,65,31,2,201,'pants/1575.gif',2,3,NULL),(1621,NULL,255,3,4,119,211,1,240,'pants/1576.gif',NULL,3,NULL),(1622,NULL,190,3,30,33,35,1,177,'pants/1638.gif',0,3,NULL),(1623,NULL,215,3,12,99,99,1,203,'pants/1599.gif',NULL,3,NULL),(1624,NULL,240,3,6,74,185,1,228,'pants/1618.gif',NULL,6,NULL),(1625,NULL,205,3,8,45,107,2,205,'pants/1619.gif',NULL,4,NULL),(1626,NULL,260,1,4,120,180,1,243,'pants/1620.gif',2,11,NULL),(1627,NULL,150,3,8,66,75,1,135,'pants/1627.gif',NULL,4,NULL),(1628,NULL,175,3,3,162,62,2,162,'pants/1639.gif',0,6,NULL),(1629,NULL,145,3,18,65,28,1,133,'pants/1640.gif',0,3,NULL),(1630,NULL,245,3,3,70,230,1,230,'pants/1648.gif',0,4,NULL),(1631,NULL,280,1,4,132,160,1,267,'pants/1652.gif',3,4,NULL),(1632,NULL,150,3,4,68,161,1,138,'pants/1656.gif',0,14,NULL),(1633,NULL,225,1,6,68,108,1,210,'pants/1657.gif',13,6,NULL),(1634,NULL,205,1,4,45,307,1,189,'pants/1665.png',2,0,NULL),(1635,NULL,240,1,12,74,54,2,228,'pants/1667.gif',2,3,NULL),(1636,NULL,235,3,6,110,88,1,223,'pants/1668.gif',0,5,NULL),(1637,NULL,240,3,4,53,230,1,224,'pants/1669.gif',0,49,NULL),(1638,NULL,215,3,6,100,72,1,203,'pants/1671.gif',0,4,NULL),(1639,NULL,265,1,2,125,290,1,253,'pants/1672.gif',2,15,NULL),(1640,NULL,245,1,3,230,120,1,230,'pants/1690.gif',3,7,NULL),(1641,NULL,225,3,2,209,166,1,209,'pants/1676.gif',0,5,NULL),(1642,NULL,255,1,12,58,93,2,241,'pants/1679.gif',2,3,NULL),(1643,NULL,180,3,2,168,129,1,168,'pants/1683.gif',0,11,NULL),(1644,NULL,215,3,2,200,146,1,200,'pants/1684.gif',0,6,NULL),(1645,NULL,175,3,2,80,210,2,163,'pants/1708.gif',0,0,NULL),(1646,NULL,180,1,8,82,85,2,167,'pants/1698.gif',3,2,NULL),(1647,NULL,245,1,12,55,75,2,229,'pants/1699.gif',2,4,NULL),(1648,NULL,165,3,2,150,150,1,150,'pants/1700.gif',0,2,NULL),(1649,NULL,255,3,12,58,100,2,241,'pants/1716.gif',0,6,NULL),(1650,NULL,120,3,2,105,160,1,105,'pants/1717.gif',0,4,NULL),(1651,NULL,200,2,8,90,90,1,184,'pants/1346.gif',NULL,5,NULL),(1652,NULL,120,3,20,24,40,1,105,'pants/1348.gif',NULL,3,NULL),(1653,NULL,200,1,1,185,207,1,185,'pants/1354.gif',2,6,NULL),(1654,NULL,225,1,1,210,410,1,210,'pants/1355.gif',2,9,NULL),(1655,NULL,200,2,6,60,120,1,186,'pants/1361.gif',NULL,4,NULL),(1656,NULL,245,1,28,55,30,1,229,'pants/1362.png',3,3,NULL),(1657,NULL,265,3,4,60,200,1,249,'pants/1375.gif',NULL,3,NULL),(1658,NULL,280,3,4,205,150,1,270,'pants/1379.gif',NULL,2,NULL),(1659,NULL,155,3,4,140,140,1,140,'pants/1385.gif',NULL,3,NULL),(1660,NULL,220,2,16,50,57,1,209,'pants/1386.gif',NULL,3,NULL),(1661,NULL,115,3,3,100,100,1,100,'pants/1409.gif',NULL,6,NULL),(1662,NULL,260,3,10,123,57,1,249,'pants/1424.gif',NULL,4,NULL),(1663,NULL,255,1,4,120,107,1,243,'pants/1426.gif',3,4,NULL),(1664,NULL,175,1,2,160,148,1,160,'pants/1427.gif',3,4,NULL),(1665,NULL,265,3,6,124,123,2,251,'pants/1428.gif',NULL,4,NULL),(1666,NULL,280,3,4,130,100,2,263,'pants/1431.gif',NULL,6,NULL),(1667,NULL,220,1,2,100,198,2,203,'pants/1442.gif',3,5,NULL),(1668,NULL,225,2,28,50,50,2,212,'pants/1446.gif',NULL,4,NULL),(1669,NULL,205,1,1,192,398,2,192,'pants/1449.gif',5,5,NULL),(1670,NULL,240,3,6,112,65,1,228,'pants/1450.gif',NULL,3,NULL),(1671,NULL,200,1,6,90,100,2,184,'pants/1451.gif',2,6,NULL),(1672,NULL,245,1,12,114,55,2,232,'pants/1456.gif',2,3,NULL),(1673,NULL,245,3,2,113,200,2,230,'pants/1458.gif',NULL,3,NULL),(1674,NULL,280,1,4,130,150,2,264,'pants/1460.gif',5,3,NULL),(1675,NULL,240,1,6,110,120,2,224,'pants/1461.gif',5,7,NULL),(1676,NULL,230,1,6,70,110,2,218,'pants/1462.gif',2,4,NULL),(1677,NULL,220,1,16,48,55,2,204,'pants/1463.gif',2,2,NULL),(1678,NULL,240,1,6,110,89,2,224,'pants/1484.gif',2,4,NULL),(1679,NULL,140,3,8,126,83,1,126,'pants/1486.gif',2,4,NULL),(1680,NULL,195,3,4,90,170,2,183,'pants/1498.gif',NULL,5,NULL),(1681,NULL,255,3,8,58,96,2,241,'pants/1505.gif',NULL,6,NULL),(1682,NULL,165,3,8,74,75,2,151,'pants/1521.gif',NULL,4,NULL),(1683,NULL,265,1,3,253,90,2,253,'pants/1525.gif',1,3,NULL),(1684,NULL,180,3,3,164,130,1,164,'pants/1526.gif',NULL,4,NULL),(1685,NULL,220,3,6,66,135,2,204,'pants/1527.gif',NULL,5,NULL),(1686,NULL,265,1,16,60,97,2,249,'pants/1552.gif',2,4,NULL),(1687,NULL,230,1,28,105,20,2,213,'pants/1556.gif',2,5,NULL),(1688,NULL,105,3,2,45,295,1,93,'pants/1558.gif',NULL,3,NULL),(1689,NULL,160,3,8,70,104,2,143,'pants/1560.gif',NULL,3,NULL),(1690,NULL,185,3,6,83,70,2,170,'pants/1616.gif',NULL,4,NULL),(1691,NULL,195,3,6,90,70,1,183,'pants/1582.gif',NULL,4,NULL),(1692,NULL,275,1,6,130,64,2,263,'pants/1611.gif',2,4,NULL),(1693,NULL,230,3,9,70,118,2,216,'pants/1614.gif',NULL,3,NULL),(1694,NULL,245,1,20,55,57,2,229,'pants/1615.gif',2,4,NULL),(1695,NULL,155,1,16,33,45,1,139,'pants/1632.gif',1,6,NULL),(1696,NULL,145,3,18,65,28,1,133,'pants/1641.gif',0,3,NULL),(1697,NULL,230,3,12,52,62,1,217,'pants/1642.gif',0,6,NULL),(1698,NULL,165,1,14,27,75,1,153,'pants/1649.jpg',2,3,NULL),(1699,NULL,225,1,2,105,270,1,213,'pants/1651.gif',2,9,NULL),(1700,NULL,225,1,10,103,43,1,209,'pants/1653.gif',6,3,NULL),(1701,NULL,220,1,6,100,110,1,205,'pants/1654.gif',2,6,NULL),(1702,NULL,215,3,4,100,150,1,203,'pants/1659.gif',0,2,NULL),(1703,NULL,220,3,6,67,115,2,207,'pants/1660.gif',0,4,NULL),(1704,NULL,245,3,8,56,95,2,233,'pants/1661.gif',0,7,NULL),(1705,NULL,230,1,3,70,405,1,218,'pants/1662.gif',5,14,NULL),(1706,NULL,235,3,9,72,102,1,222,'pants/1663.gif',0,4,NULL),(1707,NULL,255,1,6,78,108,1,240,'pants/1664.gif',13,6,NULL),(1708,NULL,245,3,2,113,200,1,229,'pants/1686.gif',0,0,NULL),(1709,NULL,150,1,1,135,312,1,135,'pants/1687.gif',3,0,NULL),(1710,NULL,235,1,8,110,60,1,223,'pants/1709.gif',2,4,NULL),(1711,NULL,205,3,4,45,220,1,189,'pants/1712.gif',0,0,NULL),(1712,NULL,225,3,4,105,135,2,212,'pants/1718.gif',0,5,NULL),(1713,NULL,170,3,15,50,60,2,156,'pants/1719.gif',0,4,NULL),(1714,NULL,155,3,4,70,120,1,143,'pants/1720.gif',0,4,NULL),(1715,NULL,245,3,20,44,83,2,232,'pants/1722.gif',0,4,NULL),(1716,NULL,215,1,30,38,32,1,202,'pants/1723.gif',2,3,NULL),(1717,NULL,245,3,3,75,195,1,231,'pants/1724.gif',0,0,NULL),(1718,NULL,100,1,45,26,12,1,84,'pants/1726.gif',1,3,NULL),(1719,NULL,225,1,12,50,70,2,209,'pants/1727.gif',2,4,NULL),(1720,NULL,255,3,6,120,87,1,243,'pants/1728.gif',0,3,NULL),(1721,NULL,160,1,16,70,70,1,144,'pants/1363.png',0,3,NULL),(1722,NULL,175,1,2,161,162,2,161,'pants/1367.png',0,3,NULL),(1723,NULL,210,3,2,195,181,2,195,'pants/1369.png',0,10,NULL),(1724,NULL,210,3,2,195,181,2,195,'pants/1370.png',0,10,NULL),(1725,NULL,160,3,2,146,154,1,146,'pants/1372.gif',NULL,5,NULL),(1726,NULL,120,3,4,108,67,1,108,'pants/1373.gif',NULL,3,NULL),(1727,NULL,160,3,8,35,140,1,149,'pants/1380.gif',NULL,3,NULL),(1728,NULL,175,1,5,160,58,2,160,'pants/1382.gif',3,3,NULL),(1729,NULL,175,1,28,37,37,1,157,'pants/1402.gif',2,3,NULL),(1730,NULL,240,1,10,110,42,2,223,'pants/1430.gif',7,2,NULL),(1731,NULL,220,3,10,100,60,1,204,'pants/1433.gif',NULL,4,NULL),(1732,NULL,215,1,32,48,22,1,201,'pants/1434.gif',2,3,NULL),(1733,NULL,175,1,45,30,30,1,162,'pants/1435.gif',1,4,NULL),(1734,NULL,210,1,8,95,55,2,194,'pants/1448.gif',2,2,NULL),(1735,NULL,180,2,6,80,95,2,164,'pants/1453.gif',NULL,7,NULL),(1736,NULL,280,1,6,130,70,2,264,'pants/1454.gif',7,4,NULL),(1737,NULL,265,3,3,250,87,2,250,'pants/1466.gif',NULL,6,NULL),(1738,NULL,275,2,6,128,128,2,259,'pants/1467.gif',NULL,3,NULL),(1739,NULL,230,1,20,52,60,2,217,'pants/1468.gif',2,4,NULL),(1740,NULL,225,3,18,33,88,2,210,'pants/1469.gif',NULL,5,NULL),(1741,NULL,205,3,1,191,175,2,191,'pants/1471.gif',NULL,28,NULL),(1742,NULL,245,3,4,115,95,2,233,'pants/1472.gif',NULL,7,NULL),(1743,NULL,270,3,4,126,196,1,256,'pants/1482.gif',NULL,6,NULL),(1744,NULL,230,3,12,52,114,2,217,'pants/1488.gif',NULL,2,NULL),(1745,NULL,180,3,8,80,85,2,164,'pants/1490.gif',NULL,2,NULL),(1746,NULL,195,3,8,90,75,2,183,'pants/1491.gif',NULL,4,NULL),(1747,NULL,135,3,4,120,71,1,120,'pants/1500.gif',NULL,6,NULL),(1748,NULL,145,1,12,65,35,2,133,'pants/1511.gif',2,3,NULL),(1749,NULL,170,3,18,76,32,2,155,'pants/1538.gif',NULL,3,NULL),(1750,NULL,215,1,8,48,99,2,201,'pants/1540.gif',6,3,NULL),(1751,NULL,275,1,12,84,84,2,258,'pants/1543.gif',9,3,NULL),(1752,NULL,165,1,10,75,40,2,153,'pants/1551.gif',1,4,NULL),(1753,NULL,180,3,4,82,165,1,166,'pants/1553.gif',NULL,10,NULL),(1754,NULL,255,3,2,119,249,1,240,'pants/1554.gif',NULL,5,NULL),(1755,NULL,130,3,2,57,290,1,117,'pants/1557.gif',NULL,NULL,NULL),(1756,NULL,155,1,12,70,55,2,143,'pants/1559.gif',3,3,NULL),(1757,NULL,230,3,6,105,70,2,213,'pants/1561.gif',NULL,4,NULL),(1758,NULL,255,1,2,120,200,2,243,'pants/1571.gif',2,13,NULL),(1759,NULL,280,3,6,132,70,2,267,'pants/1577.gif',NULL,4,NULL),(1760,NULL,175,3,4,80,110,2,163,'pants/1605.jpg',NULL,4,NULL),(1761,NULL,215,3,3,200,103,1,200,'pants/1600.gif',2,3,NULL),(1762,NULL,215,3,6,100,70,2,204,'pants/1602.gif',NULL,4,NULL),(1763,NULL,190,1,20,42,62,1,177,'pants/1603.gif',2,3,NULL),(1764,NULL,270,3,6,84,98,1,258,'pants/1606.jpg',NULL,4,NULL),(1765,NULL,240,3,12,54,73,1,225,'pants/1607.jpg',NULL,3,NULL),(1766,NULL,225,3,2,103,200,1,209,'pants/1608.jpg',NULL,3,NULL),(1767,NULL,240,3,2,113,264,1,229,'pants/1609.jpg',NULL,15,NULL),(1768,NULL,215,3,2,200,146,1,200,'pants/1685.gif',0,6,NULL),(1769,NULL,165,3,6,75,95,1,153,'pants/1701.gif',0,7,NULL),(1770,NULL,215,3,3,65,200,1,201,'pants/1702.gif',0,0,NULL),(1771,NULL,175,3,2,159,137,1,159,'pants/1706.gif',0,3,NULL),(1772,NULL,255,3,8,58,110,2,241,'pants/1707.gif',0,4,NULL),(1773,NULL,210,3,6,97,72,1,197,'pants/1713.gif',0,4,NULL),(1774,NULL,200,3,6,60,170,2,186,'pants/1715.gif',0,5,NULL),(1775,NULL,195,3,10,90,72,2,183,'pants/1763.gif',0,4,NULL),(1776,NULL,185,3,6,85,73,1,173,'pants/1764.gif',0,3,NULL),(1777,NULL,170,3,2,77,225,1,157,'pants/1771.gif',0,0,NULL),(1778,NULL,220,3,9,66,123,2,204,'pants/1774.gif',0,4,NULL),(1779,NULL,205,1,2,190,149,2,190,'pants/1776.gif',2,3,NULL),(1780,NULL,195,3,6,90,74,1,183,'pants/1780.gif',0,2,NULL),(1781,NULL,205,1,4,95,136,2,193,'pants/1800.gif',2,4,NULL),(1782,NULL,185,1,24,40,35,2,169,'pants/1807.gif',2,3,NULL),(1783,NULL,280,3,4,131,133,2,265,'pants/1816.gif',0,7,NULL),(1784,NULL,170,3,4,75,148,1,154,'pants/1824.gif',0,4,NULL),(1785,NULL,160,1,2,147,105,2,147,'pants/1826.gif',2,6,NULL),(1786,NULL,220,3,4,102,135,2,208,'pants/1833.gif',0,5,NULL),(1787,NULL,140,3,3,127,116,1,127,'pants/1841.gif',0,11,NULL),(1788,NULL,115,1,4,50,170,1,103,'pants/1858.gif',2,5,NULL),(1789,NULL,190,1,1,178,205,1,178,'pants/1862.gif',3,0,NULL),(1790,NULL,275,1,4,63,225,1,261,'pants/1863.gif',2,0,NULL),(1791,NULL,200,1,16,44,74,1,185,'pants/1866.gif',2,2,NULL),(1792,NULL,210,1,176,15,11,2,195,'pants/1876.gif',2,3,NULL),(1793,NULL,245,1,4,55,222,1,229,'pants/1883.gif',2,0,NULL),(1794,NULL,195,3,6,90,90,1,183,'pants/1896.gif',0,3,NULL),(1795,NULL,245,1,4,115,150,2,233,'pants/1912.gif',4,2,NULL),(1796,NULL,115,3,2,100,184,1,100,'pants/1915.jpg',NULL,7,NULL),(1797,NULL,155,3,5,140,60,1,140,'pants/1916.jpg',NULL,4,NULL),(1798,NULL,225,1,6,120,70,1,213,'pants/1923.jpg',7,4,NULL),(1799,NULL,165,3,6,74,64,1,151,'pants/1938.jpg',NULL,4,NULL),(1800,NULL,205,1,2,95,244,1,193,'pants/1950.jpg',2,35,NULL),(1801,NULL,155,1,1,140,251,1,140,'pants/1955.jpg',2,3,NULL),(1802,NULL,190,1,2,175,100,2,175,'pants/1956.jpg',2,6,NULL),(1803,NULL,140,1,3,125,140,1,125,'pants/1958.jpg',2,3,NULL),(1804,NULL,175,3,8,80,50,1,164,'pants/1960.jpg',NULL,3,NULL),(1805,NULL,260,1,4,60,199,2,249,'pants/1961.jpg',4,4,NULL),(1806,NULL,235,3,6,110,88,2,223,'pants/1967.jpg',NULL,5,NULL),(1807,NULL,125,3,8,55,85,2,113,'pants/1968.jpg',NULL,2,NULL),(1808,NULL,135,3,4,58,150,1,119,'pants/1972.gif',0,2,NULL),(1809,NULL,225,3,8,108,85,1,219,'pants/1973.gif',0,2,NULL),(1810,NULL,160,2,10,73,57,2,149,'pants/1980.jpg',NULL,4,NULL),(1811,NULL,185,3,10,85,40,2,173,'pants/1986.jpg',NULL,3,NULL),(1812,NULL,220,1,6,100,70,2,203,'pants/2006.jpg',2,4,NULL),(1813,NULL,185,3,4,172,45,1,172,'pants/2008.jpg',NULL,6,NULL),(1814,NULL,150,1,8,67,50,2,137,'pants/2036.jpg',2,3,NULL),(1815,NULL,150,3,4,137,67,2,137,'pants/2057.jpg',NULL,3,NULL),(1816,NULL,250,1,3,78,289,1,234,NULL,NULL,NULL,NULL),(1817,NULL,260,3,8,59,137,2,245,'pants/2067.jpg',NULL,3,NULL),(1818,NULL,210,3,4,97,111,2,198,'pants/2084.jpg',NULL,3,NULL),(1819,NULL,225,3,5,210,78,2,210,'pants/2102.jpg',NULL,3,NULL),(1820,NULL,160,3,5,144,43,1,144,'pants/2106.jpg',NULL,3,NULL),(1821,NULL,245,3,3,75,235,3,231,'pants/2120.jpg',NULL,3,NULL),(1822,NULL,230,3,9,70,70,3,216,'pants/2121.jpg',NULL,4,NULL),(1823,NULL,185,1,6,85,73,3,173,'pants/2127.jpg',2,3,NULL),(1824,NULL,145,1,3,133,74,3,133,'pants/2130.jpg',2,2,NULL),(1825,NULL,400,1,1,400,400,3,400,NULL,NULL,3,NULL),(1826,NULL,230,3,9,70,70,3,216,'pants/2141.jpg',NULL,4,NULL),(1827,NULL,240,1,6,74,133,3,228,'pants/2157.jpg',2,7,NULL),(1828,NULL,400,1,8,400,400,1,400,NULL,NULL,3,NULL),(1829,NULL,400,2,12,400,400,1,400,NULL,NULL,7,NULL),(1830,NULL,215,1,3,65,237,3,201,'pants/2176.jpg',2,11,NULL),(1831,NULL,200,1,2,90,305,1,180,NULL,NULL,NULL,NULL),(1832,NULL,255,3,4,120,140,1,243,'pants/2187.jpg',NULL,3,NULL),(1833,NULL,4040,1,4,400,400,1,400,NULL,NULL,5,NULL),(1834,NULL,160,3,8,73,65,3,149,'pants/2191.jpg',0,2,NULL),(1835,NULL,260,1,4,60,238,1,240,NULL,0,0,NULL),(1836,NULL,255,1,4,119,120,3,241,'pants/2206.jpg',2,4,NULL),(1837,NULL,215,1,8,100,72,3,203,'pants/2212.jpg',2,4,NULL),(1838,NULL,260,1,20,60,60,3,249,'pants/2213.jpg',2,4,NULL),(1839,NULL,400,3,6,400,400,1,400,NULL,NULL,NULL,NULL),(1840,NULL,205,1,8,95,72,3,193,'pants/2219.jpg',2,4,NULL),(1841,NULL,185,1,4,85,97,3,173,'pants/2239.jpg',11,5,NULL),(1842,NULL,400,3,8,400,400,1,400,NULL,NULL,NULL,NULL),(1843,NULL,205,3,4,95,150,3,193,'pants/2244.jpg',NULL,3,NULL),(1844,NULL,400,1,8,400,400,1,400,NULL,NULL,NULL,NULL),(1845,NULL,230,3,4,106,155,1,215,'pants/2249.jpg',NULL,4,NULL),(1846,NULL,230,1,4,107,107,3,218,'pants/2254.jpg',2,7,NULL),(1847,NULL,215,1,4,100,120,3,204,'pants/2255.jpg',3,4,NULL),(1848,NULL,105,3,14,30,30,1,90,'pants/2262.jpg',NULL,3,NULL),(1849,NULL,125,3,2,1,229,3,111,'pants/2263.jpg',NULL,NULL,NULL),(1850,NULL,400,1,12,400,400,3,400,NULL,NULL,NULL,NULL),(1851,NULL,400,1,3,400,400,3,400,NULL,NULL,NULL,NULL),(1852,NULL,215,3,4,100,110,1,203,'pants/1770.gif',0,4,NULL),(1853,NULL,265,3,3,253,90,1,253,'pants/1772.gif',0,3,NULL),(1854,NULL,105,1,68,21,10,1,93,'pants/1785.gif',2,3,NULL),(1855,NULL,260,3,2,244,133,1,244,'pants/1788.gif',0,9,NULL),(1856,NULL,215,3,6,98,113,2,199,'pants/1796.gif',0,3,NULL),(1857,NULL,155,1,1,140,207,1,140,'pants/1797.gif',2,0,NULL),(1858,NULL,175,3,2,80,200,1,163,'pants/1802.gif',0,0,NULL),(1859,NULL,220,1,1,207,283,1,207,'pants/1817.gif',2,0,NULL),(1860,NULL,235,1,6,72,175,2,222,'pants/1818.gif',2,16,NULL),(1861,NULL,230,1,15,70,58,2,216,'pants/1819.gif',2,3,NULL),(1862,NULL,210,3,2,197,152,1,197,'pants/1835.gif',0,7,NULL),(1863,NULL,245,3,3,230,70,1,230,'pants/1836.gif',0,4,NULL),(1864,NULL,200,1,6,60,180,2,186,'pants/1845.gif',2,11,NULL),(1865,NULL,170,3,3,155,118,1,155,'pants/1854.gif',0,9,NULL),(1866,NULL,175,1,16,38,75,2,161,'pants/1856.gif',2,4,NULL),(1867,NULL,140,1,30,40,20,2,126,'pants/1861.gif',2,3,NULL),(1868,NULL,140,3,18,40,50,1,128,'pants/1867.gif',0,3,NULL),(1869,NULL,195,3,3,180,140,1,180,'pants/1870.gif',0,3,NULL),(1870,NULL,200,1,6,90,110,2,184,'pants/1885.gif',2,6,NULL),(1871,NULL,235,1,2,110,219,1,223,'pants/1889.gif',2,0,NULL),(1872,NULL,205,3,6,95,130,2,193,'pants/1897.gif',0,4,NULL),(1873,NULL,235,1,4,110,160,2,223,'pants/1902.jpg',2,4,NULL),(1874,NULL,255,3,12,120,55,2,243,'pants/1906.jpg',NULL,3,NULL),(1875,NULL,90,1,80,13,11,1,80,'pants/1911.gif',2,2,NULL),(1876,NULL,185,3,3,175,70,1,175,'pants/1920.jpg',NULL,4,NULL),(1877,NULL,200,1,3,60,210,1,186,'pants/1922.jpg',2,3,NULL),(1878,NULL,195,1,16,20,110,2,181,'pants/1924.jpg',2,4,NULL),(1879,NULL,210,3,3,195,70,1,195,'pants/1929.jpg',NULL,4,NULL),(1880,NULL,185,3,4,85,98,2,173,'pants/1933.gif',0,4,NULL),(1881,NULL,230,1,3,70,190,2,216,'pants/1935.gif',2,0,NULL),(1882,NULL,130,3,30,37,18,1,117,'pants/1936.jpg',NULL,2,NULL),(1883,NULL,210,1,2,95,209,1,193,'pants/1947.jpg',2,4,NULL),(1884,NULL,165,3,4,150,85,2,150,'pants/1959.jpg',NULL,2,NULL),(1885,NULL,270,1,6,83,144,2,255,'pants/1974.gif',5,6,NULL),(1886,NULL,255,3,4,119,103,1,241,'pants/1983.jpg',NULL,3,NULL),(1887,NULL,200,3,4,91,105,1,187,'pants/1985.jpg',NULL,6,NULL),(1888,NULL,175,3,3,160,140,1,160,'pants/1987.jpg',NULL,3,NULL),(1889,NULL,145,3,4,65,150,2,133,'pants/1989.jpg',NULL,2,NULL),(1890,NULL,155,3,3,140,120,2,140,'pants/1991.jpg',NULL,7,NULL),(1891,NULL,220,3,10,100,60,2,203,'pants/1995.jpg',NULL,4,NULL),(1892,NULL,225,3,6,68,170,2,210,'pants/2005.jpg',NULL,5,NULL),(1893,NULL,200,1,2,90,252,2,183,'pants/2007.jpg',2,2,NULL),(1894,NULL,235,3,8,110,55,2,223,'pants/2015.gif',NULL,2,NULL),(1895,NULL,240,3,12,74,92,1,228,'pants/2017.jpg',NULL,3,NULL),(1896,NULL,270,3,2,255,135,2,255,'pants/2049.jpg',NULL,5,NULL),(1897,NULL,205,3,4,95,187,2,193,'pants/2051.jpg',NULL,4,NULL),(1898,NULL,255,1,4,240,55,2,240,'pants/2054.jpg',3,2,NULL),(1899,NULL,215,3,6,98,73,1,199,'pants/2065.jpg',NULL,3,NULL),(1900,NULL,205,3,4,190,80,2,190,'pants/2066.jpg',NULL,7,NULL),(1901,NULL,230,1,9,70,70,2,216,'pants/2075.jpg',NULL,4,NULL),(1902,NULL,195,3,2,90,245,2,183,'pants/2078.jpg',NULL,3,NULL),(1903,NULL,235,3,4,110,148,2,224,'pants/2082.jpg',NULL,4,NULL),(1904,NULL,190,3,2,177,149,2,177,'pants/2091.jpg',NULL,3,NULL),(1905,NULL,235,3,6,70,170,3,216,'pants/2116.jpg',NULL,5,NULL),(1906,NULL,230,2,6,70,130,3,216,'pants/2131.jpg',NULL,5,NULL),(1907,NULL,160,3,6,70,70,2,143,'pants/2132.jpg',NULL,4,NULL),(1908,NULL,200,3,4,90,150,3,183,'pants/2136.jpg',NULL,2,NULL),(1909,NULL,200,1,2,182,163,3,182,'pants/2149.jpg',2,2,NULL),(1910,NULL,200,1,33,60,15,3,186,'pants/2153.jpg',2,3,NULL),(1911,NULL,400,1,1,400,400,1,NULL,NULL,NULL,3,NULL),(1912,NULL,275,3,4,130,130,3,263,'pants/2158.jpg',NULL,5,NULL),(1913,NULL,225,1,6,68,180,3,209,'pants/2159.jpg',2,11,NULL),(1914,NULL,150,2,6,68,68,3,139,'pants/2166.jpg',NULL,3,NULL),(1915,NULL,165,2,12,48,48,3,150,'pants/2167.jpg',NULL,3,NULL),(1916,NULL,255,3,8,120,55,3,243,'pants/2173.jpg',NULL,2,NULL),(1917,NULL,270,1,2,126,325,3,255,'pants/2175.jpg',2,5,NULL),(1918,NULL,175,3,3,164,70,3,164,'pants/2192.jpg',2,4,NULL),(1919,NULL,195,3,2,90,210,3,183,'pants/2193.jpg',0,3,NULL),(1920,NULL,185,1,3,56,235,3,174,'pants/2199.jpg',2,0,NULL),(1921,NULL,205,3,20,46,60,3,193,'pants/2204.jpg',NULL,4,NULL),(1922,NULL,150,1,4,66,120,3,135,'pants/2233.jpg',2,4,NULL),(1923,NULL,400,1,15,400,400,3,400,NULL,NULL,3,NULL),(1924,NULL,400,1,6,400,400,3,400,NULL,NULL,NULL,NULL),(1925,NULL,220,2,4,100,100,3,203,'pants/2266.jpg',NULL,6,NULL),(1926,NULL,400,2,8,400,400,3,400,NULL,NULL,NULL,NULL),(1927,NULL,255,3,8,115,84,3,234,'pants/2277.jpg',NULL,3,NULL),(1928,NULL,170,1,9,50,90,2,156,'pants/1765.gif',14,3,NULL),(1929,NULL,255,3,8,120,55,1,243,'pants/1782.gif',0,2,NULL),(1930,NULL,205,3,2,95,420,1,193,'pants/1786.gif',0,0,NULL),(1931,NULL,260,3,9,80,102,2,246,'pants/1793.gif',0,4,NULL),(1932,NULL,275,3,6,172,85,2,261,'pants/1798.gif',0,3,NULL),(1933,NULL,250,1,10,45,110,2,237,'pants/1801.gif',2,4,NULL),(1934,NULL,195,3,6,90,90,1,183,'pants/1822.gif',0,3,NULL),(1935,NULL,160,3,6,46,130,1,144,'pants/1830.gif',0,10,NULL),(1936,NULL,195,1,10,90,58,2,183,'pants/1839.gif',2,3,NULL),(1937,NULL,275,3,6,130,91,1,263,'pants/1853.gif',0,2,NULL),(1938,NULL,175,1,2,148,209,1,148,'pants/1872.gif',2,5,NULL),(1939,NULL,175,3,6,80,65,1,163,'pants/1880.gif',0,3,NULL),(1940,NULL,250,1,6,75,180,2,233,'pants/1890.gif',2,11,NULL),(1941,NULL,200,3,15,60,60,1,186,'pants/1895.gif',0,4,NULL),(1942,NULL,260,1,6,80,106,2,246,'pants/1898.gif',9,5,NULL),(1943,NULL,200,3,3,60,243,1,188,'pants/1908.jpg',NULL,0,NULL),(1944,NULL,275,1,4,130,110,2,263,'pants/1909.jpg',2,4,NULL),(1945,NULL,185,1,2,85,216,1,173,'pants/1919.jpg',3,6,NULL),(1946,NULL,100,3,20,20,60,2,89,'pants/1926.jpg',NULL,4,NULL),(1947,NULL,175,1,16,38,53,2,161,'pants/1927.jpg',4,3,NULL),(1948,NULL,175,3,6,80,70,2,163,'pants/1939.jpg',NULL,4,NULL),(1949,NULL,100,1,20,42,20,2,87,'pants/1942.jpg',2,2,NULL),(1950,NULL,245,1,3,75,243,1,231,'pants/1949.jpg',3,37,NULL),(1951,NULL,220,1,4,100,100,2,203,'pants/1952.jpg',2,6,NULL),(1952,NULL,260,1,1,245,190,2,245,'pants/1957.jpg',2,13,NULL),(1953,NULL,205,1,6,95,130,2,193,'pants/1964.jpg',2,4,NULL),(1954,NULL,105,1,2,90,150,1,90,'pants/1971.gif',2,2,NULL),(1955,NULL,220,3,1,208,220,1,208,'pants/1976.jpg',NULL,9,NULL),(1956,NULL,190,3,2,176,110,1,176,'pants/1979.jpg',NULL,4,NULL),(1957,NULL,195,3,2,90,225,2,183,'pants/1993.jpg',NULL,4,NULL),(1958,NULL,200,1,2,185,148,2,185,'pants/1999.jpg',3,4,NULL),(1959,NULL,155,1,6,70,90,2,143,'pants/2029.jpg',NULL,3,NULL),(1960,NULL,220,1,9,67,115,2,207,'pants/2045.jpg',NULL,12,NULL),(1961,NULL,135,3,4,59,140,1,121,'pants/2046.jpg',NULL,12,NULL),(1962,NULL,145,3,3,130,90,1,130,'pants/2048.jpg',NULL,3,NULL),(1963,NULL,280,3,8,132,82,1,NULL,'pants/2062.jpg',NULL,5,NULL),(1964,NULL,165,3,6,74,62,2,152,'pants/2070.jpg',NULL,6,NULL),(1965,NULL,175,3,10,80,57,2,164,'pants/2086.jpg',NULL,4,NULL),(1966,NULL,225,3,6,68,156,2,210,'pants/2089.jpg',NULL,3,NULL),(1967,NULL,190,3,2,177,149,1,177,'pants/2090.jpg',NULL,3,NULL),(1968,NULL,240,1,4,55,222,1,220,NULL,NULL,NULL,NULL),(1969,NULL,260,3,3,80,245,3,246,'pants/2114.jpg',NULL,3,NULL),(1970,NULL,230,1,28,51,28,3,213,'pants/2117.jpg',2,2,NULL),(1971,NULL,255,1,8,120,66,3,243,'pants/2124.jpg',4,4,NULL),(1972,NULL,220,1,8,200,40,1,200,NULL,3,3,NULL),(1973,NULL,255,3,4,120,104,3,243,'pants/2135.jpg',NULL,2,NULL),(1974,NULL,245,1,3,77,289,1,231,NULL,NULL,NULL,NULL),(1975,NULL,400,3,4,400,400,3,400,NULL,NULL,3,NULL),(1976,NULL,400,1,16,400,400,1,400,NULL,4,3,NULL),(1977,NULL,245,3,3,75,245,3,231,'pants/2181.jpg',NULL,3,NULL),(1978,NULL,400,1,4,400,400,3,400,NULL,0,0,NULL),(1979,NULL,140,3,3,116,127,3,127,'pants/2196.jpg',0,11,NULL),(1980,NULL,195,1,15,58,53,3,180,'pants/2207.jpg',2,3,NULL),(1981,NULL,150,1,30,20,60,3,135,'pants/2220.jpg',2,4,NULL),(1982,NULL,175,3,2,161,95,1,161,'pants/2237.jpg',NULL,7,NULL),(1983,NULL,400,2,8,400,400,1,400,NULL,NULL,NULL,NULL),(1984,NULL,195,3,2,88,198,1,180,'pants/2252.jpg',NULL,5,NULL),(1985,NULL,180,3,4,81,110,3,165,'pants/2253.jpg',NULL,4,NULL),(1986,NULL,260,3,6,117,120,3,238,'pants/2278.jpg',NULL,7,NULL),(1987,NULL,320,3,12,72,110,3,298,'pants/2281.jpg',NULL,6,NULL),(1988,NULL,400,2,6,400,400,3,400,NULL,NULL,NULL,NULL),(1989,NULL,215,3,8,100,55,1,203,'pants/2290.jpg',NULL,2,NULL),(1990,NULL,155,3,4,140,47,3,140,'pants/2305.jpg',NULL,4,NULL),(1991,NULL,200,3,14,89,26,3,181,'pants/2329.jpg',NULL,3,NULL),(1992,NULL,230,1,4,106,120,3,215,'pants/2334.jpg',4,4,NULL),(1993,NULL,180,1,3,165,110,3,165,'pants/2335.jpg',7,6,NULL),(1994,NULL,260,1,36,80,20,2,246,'pants/2338.jpg',2,3,NULL),(1995,NULL,165,1,6,75,110,2,153,'pants/2341.jpg',2,6,NULL),(1996,NULL,240,2,12,70,70,1,216,'pants/2342.jpg',NULL,6,NULL),(1997,NULL,270,1,9,80,100,2,246,'pants/2343.jpg',2,6,NULL),(1998,NULL,320,1,14,40,140,2,298,'pants/2345.jpg',2,12,NULL),(1999,NULL,340,1,12,50,150,2,315,'pants/2346.jpg',2,2,NULL),(2000,NULL,310,1,30,45,58,2,285,'pants/2347.jpg',2,3,NULL),(2001,NULL,400,3,3,400,400,1,400,NULL,NULL,400,NULL),(2002,NULL,165,1,4,75,120,2,153,'pants/2351.jpg',2,4,NULL),(2003,NULL,200,3,4,90,150,2,183,'pants/2352.jpg',NULL,2,NULL),(2004,NULL,160,3,4,146,47,2,146,'pants/2356.jpg',NULL,4,NULL),(2005,NULL,280,1,4,131,103,2,265,'pants/2359.jpg',2,3,NULL),(2006,NULL,165,3,3,150,65,1,150,'pants/1843.gif',0,3,NULL),(2007,NULL,115,1,39,32,13,2,102,'pants/1848.gif',2,3,NULL),(2008,NULL,225,2,4,105,105,2,213,'pants/1851.gif',0,9,NULL),(2009,NULL,170,3,9,50,70,1,156,'pants/1859.gif',0,4,NULL),(2010,NULL,195,3,2,90,225,1,183,'pants/1877.gif',0,0,NULL),(2011,NULL,255,1,12,58,90,2,238,'pants/1881.gif',2,3,NULL),(2012,NULL,245,1,15,75,82,2,231,'pants/1918.jpg',4,4,NULL),(2013,NULL,245,1,16,55,50,2,229,'pants/1931.gif',2,3,NULL),(2014,NULL,260,1,3,80,190,2,246,'pants/1934.gif',2,0,NULL),(2015,NULL,255,1,6,120,140,1,243,'pants/1944.jpg',2,3,NULL),(2016,NULL,260,1,9,80,114,2,246,'pants/1945.jpg',4,2,NULL),(2017,NULL,100,3,3,88,140,1,88,'pants/1946.jpg',NULL,3,NULL),(2018,NULL,190,3,2,180,165,1,180,'pants/1982.jpg',NULL,10,NULL),(2019,NULL,110,1,2,98,98,2,98,'pants/1988.jpg',2,4,NULL),(2020,NULL,175,3,10,80,60,2,163,'pants/1992.jpg',NULL,4,NULL),(2021,NULL,220,3,15,66,61,1,204,'pants/1998.jpg',NULL,3,NULL),(2022,NULL,185,3,2,172,132,2,172,'pants/2012.jpg',NULL,8,NULL),(2023,NULL,225,3,6,104,120,1,211,'pants/2019.jpg',NULL,7,NULL),(2024,NULL,155,1,2,70,225,2,143,'pants/2024.jpg',2,4,NULL),(2025,NULL,170,1,16,76,45,2,155,'pants/2033.jpg',2,3,NULL),(2026,NULL,155,1,6,70,70,2,143,'pants/2042.jpg',NULL,4,NULL),(2027,NULL,120,1,3,105,85,2,105,'pants/2050.jpg',2,8,NULL),(2028,NULL,125,1,3,114,72,2,114,'pants/2053.jpg',2,2,NULL),(2029,NULL,280,3,8,132,85,1,267,'pants/2061.jpg',NULL,2,NULL),(2030,NULL,200,1,32,45,45,3,189,'pants/2069.jpg',4,3,NULL),(2031,NULL,250,3,10,115,80,2,234,'pants/2085.jpg',NULL,6,NULL),(2032,NULL,205,3,15,62,57,2,193,'pants/2087.jpg',NULL,4,NULL),(2033,NULL,215,1,2,100,279,1,200,NULL,NULL,NULL,NULL),(2034,NULL,125,3,5,110,55,2,110,'pants/2094.jpg',NULL,6,NULL),(2035,NULL,200,3,12,60,52,2,186,'pants/2095.jpg',NULL,4,NULL),(2036,NULL,200,3,9,58,78,1,180,'pants/2107.jpg',NULL,5,NULL),(2037,NULL,200,3,6,58,120,1,180,'pants/2108.jpg',NULL,4,NULL),(2038,NULL,260,3,4,60,268,3,249,'pants/2111.jpg',NULL,2,NULL),(2039,NULL,130,1,1,116,312,3,116,'pants/2112.jpg',2,6,NULL),(2040,NULL,200,3,6,60,150,3,186,'pants/2119.jpg',NULL,2,NULL),(2041,NULL,115,3,6,50,80,2,103,'pants/2133.jpg',NULL,3,NULL),(2042,NULL,235,3,10,110,60,3,223,'pants/2144.jpg',NULL,4,NULL),(2043,NULL,165,1,2,74,325,3,151,'pants/2164.jpg',2,5,NULL),(2044,NULL,150,3,4,31,224,3,133,'pants/2165.jpg',NULL,5,NULL),(2045,NULL,400,3,6,400,400,3,400,NULL,NULL,7,NULL),(2046,NULL,170,1,2,77,325,3,157,'pants/2174.jpg',2,5,NULL),(2047,NULL,255,1,4,119,120,3,241,'pants/2189.jpg',2,4,NULL),(2048,NULL,155,1,16,70,24,3,143,'pants/2198.jpg',2,3,NULL),(2049,NULL,155,1,2,70,305,3,143,'pants/2200.jpg',2,0,NULL),(2050,NULL,280,1,9,85,123,3,261,'pants/2205.jpg',3,4,NULL),(2051,NULL,165,1,4,75,150,3,153,'pants/2215.jpg',2,2,NULL),(2052,NULL,400,1,15,400,400,1,400,NULL,NULL,NULL,NULL),(2053,NULL,210,1,1,190,410,3,190,'pants/2235.jpg',2,9,NULL),(2054,NULL,400,1,4,400,400,3,400,NULL,NULL,4,NULL),(2055,NULL,180,3,4,81,127,3,165,'pants/2267.jpg',NULL,8,NULL),(2056,NULL,400,3,2,400,400,3,400,NULL,NULL,NULL,NULL),(2057,NULL,300,1,12,90,89,3,278,'pants/2279.jpg',2,6,NULL),(2058,NULL,165,1,4,75,110,3,153,'pants/2289.jpg',2,4,NULL),(2059,NULL,195,1,6,90,125,3,183,'pants/2291.jpg',2,2,NULL),(2060,NULL,335,1,50,60,25,3,312,'pants/2314.jpg',2,3,NULL),(2061,NULL,175,1,8,78,57,3,159,'pants/2322.jpg',9,3,NULL),(2062,NULL,255,1,4,58,200,3,240,'pants/2323.jpg',2,3,NULL),(2063,NULL,260,1,8,58,180,3,240,'pants/2324.jpg',2,11,NULL),(2064,NULL,400,1,8,400,400,3,400,NULL,NULL,NULL,NULL),(2065,NULL,400,1,12,400,400,3,400,NULL,NULL,NULL,NULL),(2066,NULL,225,1,6,65,176,3,203,'pants/2332.jpg',2,15,NULL),(2067,NULL,290,1,12,65,120,2,269,'pants/2344.jpg',2,7,NULL),(2068,NULL,300,3,9,90,120,2,276,'pants/2354.jpg',NULL,7,NULL),(2069,NULL,290,1,24,20,187,2,271,'pants/2355.jpg',2,4,NULL),(2070,NULL,165,1,2,150,110,2,150,'pants/2358.jpg',NULL,4,NULL),(2071,NULL,400,3,9,400,400,1,400,NULL,NULL,4,NULL),(2072,NULL,400,1,8,400,400,1,400,NULL,NULL,5,NULL),(2073,NULL,400,1,28,400,400,1,400,NULL,NULL,3,NULL),(2074,NULL,200,3,4,81,82,2,81,'pants/2363.jpg',NULL,5,NULL),(2075,NULL,175,1,2,80,225,2,163,'pants/2364.jpg',2,4,NULL),(2076,NULL,205,3,10,94,60,2,191,'pants/2366.jpg',NULL,4,NULL),(2077,NULL,400,3,2,400,400,2,400,NULL,NULL,NULL,NULL),(2078,NULL,400,1,20,400,400,2,400,NULL,NULL,NULL,NULL),(2079,NULL,155,3,2,140,110,2,140,'pants/2370.jpg',NULL,4,NULL),(2080,NULL,255,1,4,60,254,1,240,NULL,NULL,NULL,NULL),(2081,NULL,200,3,16,40,35,2,83,'pants/2372.jpg',NULL,3,NULL),(2082,NULL,400,1,20,400,400,2,400,NULL,NULL,NULL,NULL),(2083,NULL,220,1,4,102,152,2,206,'pants/1766.gif',2,6,NULL),(2084,NULL,165,3,4,73,185,1,149,'pants/1779.gif',0,6,NULL),(2085,NULL,150,3,30,20,40,1,135,'pants/1781.gif',2,3,NULL),(2086,NULL,245,3,15,75,60,2,231,'pants/1791.gif',0,4,NULL),(2087,NULL,125,1,16,26,85,2,113,'pants/1805.gif',2,2,NULL),(2088,NULL,195,1,2,90,200,2,183,'pants/1810.gif',5,0,NULL),(2089,NULL,230,1,5,40,230,2,212,'pants/1812.gif',2,0,NULL),(2090,NULL,135,1,9,38,72,2,120,'pants/1827.gif',2,4,NULL),(2091,NULL,210,3,2,197,152,1,197,'pants/1834.gif',0,7,NULL),(2092,NULL,195,3,4,90,136,2,183,'pants/1838.gif',0,4,NULL),(2093,NULL,200,3,6,92,140,2,188,'pants/1860.gif',0,3,NULL),(2094,NULL,220,3,6,66,110,1,204,'pants/1894.gif',0,4,NULL),(2095,NULL,255,3,4,120,150,1,243,'pants/1907.jpg',NULL,2,NULL),(2096,NULL,275,3,4,129,112,1,261,'pants/1910.jpg',NULL,2,NULL),(2097,NULL,155,3,2,70,225,1,143,'pants/1913.gif',NULL,4,NULL),(2098,NULL,240,3,6,110,80,2,223,'pants/1914.jpg',NULL,3,NULL),(2099,NULL,205,3,16,45,55,1,189,'pants/1937.jpg',NULL,2,NULL),(2100,NULL,200,3,15,60,60,1,186,'pants/1941.jpg',NULL,4,NULL),(2101,NULL,255,1,3,240,70,2,240,'pants/1951.jpg',2,4,NULL),(2102,NULL,190,2,9,57,73,2,177,'pants/1953.jpg',NULL,3,NULL),(2103,NULL,150,1,4,135,55,2,135,'pants/1963.jpg',2,2,NULL),(2104,NULL,215,3,4,100,100,2,203,'pants/1966.jpg',NULL,6,NULL),(2105,NULL,215,1,6,100,120,1,203,'pants/1997.jpg',NULL,7,NULL),(2106,NULL,210,3,4,95,133,2,193,'pants/2002.jpg',NULL,7,NULL),(2107,NULL,185,3,2,172,132,2,172,'pants/2011.jpg',NULL,8,NULL),(2108,NULL,235,3,12,110,55,2,223,'pants/2016.jpg',NULL,3,NULL),(2109,NULL,235,3,10,110,60,2,223,'pants/2023.jpg',NULL,4,NULL),(2110,NULL,175,1,2,80,300,2,163,'pants/2027.jpg',NULL,5,NULL),(2111,NULL,105,1,2,45,190,1,93,'pants/2031.jpg',NULL,13,NULL),(2112,NULL,150,3,4,67,137,2,137,'pants/2035.jpg',NULL,3,NULL),(2113,NULL,135,3,2,120,110,1,120,'pants/2043.jpg',NULL,4,NULL),(2114,NULL,135,1,7,120,29,2,120,'pants/2052.jpg',2,3,NULL),(2115,NULL,185,3,9,56,114,2,174,'pants/2071.jpg',NULL,2,NULL),(2116,NULL,195,3,2,90,220,2,183,'pants/2076.jpg',NULL,2,NULL),(2117,NULL,230,3,6,71,159,2,219,'pants/2077.jpg',NULL,5,NULL),(2118,NULL,200,3,12,60,46,3,186,'pants/2080.jpg',NULL,5,NULL),(2119,NULL,150,3,5,137,59,3,137,'pants/2083.jpg',NULL,5,NULL),(2120,NULL,230,1,20,52,80,3,217,'pants/2099.jpg',2,6,NULL),(2121,NULL,180,1,12,40,65,3,169,'pants/2100.jpg',0,3,NULL),(2122,NULL,215,3,6,64,115,2,200,'pants/2109.jpg',NULL,4,NULL),(2123,NULL,270,3,3,255,100,3,255,'pants/2113.jpg',NULL,6,NULL),(2124,NULL,180,3,4,80,115,2,164,'pants/2125.jpg',NULL,4,NULL),(2125,NULL,105,3,4,90,55,2,90,'pants/2126.jpg',NULL,2,NULL),(2126,NULL,245,3,15,44,89,3,232,'pants/2139.jpg',NULL,4,NULL),(2127,NULL,260,3,2,122,196,3,247,'pants/2151.jpg',NULL,7,NULL),(2128,NULL,400,1,4,400,400,3,400,NULL,NULL,3,NULL),(2129,NULL,400,1,15,400,400,1,400,NULL,0,0,NULL),(2130,NULL,400,1,6,400,400,3,400,NULL,0,0,NULL),(2131,NULL,255,1,4,60,248,1,240,NULL,NULL,NULL,NULL),(2132,NULL,150,3,6,65,73,3,133,'pants/2214.jpg',NULL,3,NULL),(2133,NULL,130,3,12,37,54,3,117,'pants/2216.jpg',NULL,3,NULL),(2134,NULL,160,1,2,148,165,3,148,'pants/2218.jpg',2,10,NULL),(2135,NULL,400,1,6,400,400,1,400,NULL,NULL,NULL,NULL),(2136,NULL,265,1,2,125,420,3,253,'pants/2245.jpg',2,9,NULL),(2137,NULL,225,1,4,105,143,3,213,'pants/2246.jpg',2,9,NULL),(2138,NULL,250,1,36,58,40,1,238,'pants/2251.jpg',2,2,NULL),(2139,NULL,150,1,18,65,27,1,133,'pants/2258.jpg',2,3,NULL),(2140,NULL,400,1,16,400,400,3,400,NULL,NULL,NULL,NULL),(2141,NULL,400,1,8,400,400,3,NULL,NULL,NULL,NULL,NULL),(2142,NULL,235,2,12,71,74,1,219,'pants/2285.gif',NULL,2,NULL),(2143,NULL,340,3,8,77,137,3,317,'pants/2304.jpg',NULL,3,NULL),(2144,NULL,400,1,5,400,400,1,400,NULL,NULL,NULL,NULL),(2145,NULL,235,1,12,110,45,3,224,'pants/2321.jpg',2,3,NULL),(2146,NULL,325,1,20,58,82,3,302,'pants/2328.jpg',2,5,NULL),(2147,NULL,165,1,4,75,135,2,153,'pants/2340.jpg',2,5,NULL),(2148,NULL,290,1,8,65,176,2,272,'pants/2349.jpg',2,15,NULL),(2149,NULL,165,3,4,36,200,2,153,'pants/2350.jpg',NULL,4,NULL),(2150,NULL,100,3,11,89,26,2,89,'pants/2353.jpg',NULL,3,NULL),(2151,NULL,245,1,6,75,120,2,231,'pants/2357.jpg',2,4,NULL),(2152,NULL,235,3,2,110,220,1,223,'pants/2365.jpg',NULL,2,NULL),(2153,NULL,400,3,4,400,400,2,400,NULL,NULL,NULL,NULL),(2154,NULL,400,1,28,400,400,1,400,NULL,NULL,NULL,NULL),(2155,NULL,400,1,4,400,400,2,400,NULL,NULL,NULL,NULL),(2156,NULL,185,3,10,85,60,2,173,'pants/2376.jpg',NULL,4,NULL),(2157,NULL,240,3,2,225,149,1,225,'pants/2377.jpg',NULL,3,NULL),(2158,NULL,175,1,1,160,200,2,160,'pants/2378.jpg',2,3,NULL),(2159,NULL,160,1,4,70,150,2,143,'pants/2379.jpg',2,2,NULL),(2160,NULL,200,3,6,60,188,2,186,'pants/2380.jpg',NULL,3,NULL),(2161,NULL,100,1,42,12,26,2,87,'pants/1767.gif',2,3,NULL),(2162,NULL,160,3,3,130,102,2,130,'pants/1773.gif',0,4,NULL),(2163,NULL,245,3,12,55,125,2,229,'pants/1775.gif',0,2,NULL),(2164,NULL,165,3,4,75,99,1,153,'pants/1778.gif',0,3,NULL),(2165,NULL,220,3,6,67,165,2,207,'pants/1787.gif',0,10,NULL),(2166,NULL,240,1,6,74,98,2,228,'pants/1789.gif',2,4,NULL),(2167,NULL,245,3,9,75,125,2,231,'pants/1794.gif',0,2,NULL),(2168,NULL,165,3,6,49,140,2,152,'pants/1795.gif',0,3,NULL),(2169,NULL,265,3,4,250,50,2,250,'pants/1804.gif',0,3,NULL),(2170,NULL,260,3,12,80,82,2,248,'pants/1806.gif',0,5,NULL),(2171,NULL,235,3,6,108,65,1,219,'pants/1809.gif',0,3,NULL),(2172,NULL,175,1,20,30,93,2,162,'pants/1814.gif',2,3,NULL),(2173,NULL,110,1,2,94,110,1,94,'pants/1821.gif',2,4,NULL),(2174,NULL,165,3,6,75,70,1,153,'pants/1823.gif',0,4,NULL),(2175,NULL,265,3,12,60,90,1,249,'pants/1825.gif',0,3,NULL),(2176,NULL,185,1,1,170,270,1,170,'pants/1828.gif',2,0,NULL),(2177,NULL,175,3,8,80,80,1,163,'pants/1832.gif',0,7,NULL),(2178,NULL,225,1,4,105,140,2,213,'pants/1842.gif',2,3,NULL),(2179,NULL,170,3,3,155,118,1,155,'pants/1855.gif',0,9,NULL),(2180,NULL,155,3,8,70,52,1,143,'pants/1857.gif',0,4,NULL),(2181,NULL,235,1,4,110,135,1,223,'pants/1868.gif',2,5,NULL),(2182,NULL,275,3,10,50,183,1,262,'pants/1869.gif',0,8,NULL),(2183,NULL,225,1,20,50,53,1,209,'pants/1873.gif',2,3,NULL),(2184,NULL,165,3,12,75,55,1,153,'pants/1879.gif',0,3,NULL),(2185,NULL,165,3,2,75,210,1,153,'pants/1886.gif',0,0,NULL),(2186,NULL,215,3,2,100,250,1,203,'pants/1887.gif',0,0,NULL),(2187,NULL,210,1,4,47,210,2,197,'pants/1888.gif',2,0,NULL),(2188,NULL,200,1,6,90,110,2,184,'pants/1891.gif',2,6,NULL),(2189,NULL,200,3,3,60,210,2,188,'pants/1893.gif',0,0,NULL),(2190,NULL,220,1,14,125,30,1,208,'pants/1903.jpg',2,3,NULL),(2191,NULL,195,3,6,90,120,2,183,'pants/1905.jpg',NULL,7,NULL),(2192,NULL,200,3,2,92,220,1,187,'pants/1940.jpg',NULL,2,NULL),(2193,NULL,175,1,4,80,136,1,163,'pants/1943.jpg',2,4,NULL),(2194,NULL,175,3,6,80,65,2,163,'pants/1954.jpg',NULL,3,NULL),(2195,NULL,165,1,5,28,265,2,152,'pants/1962.jpg',NULL,14,NULL),(2196,NULL,240,3,9,73,73,2,225,'pants/1965.jpg',NULL,3,NULL),(2197,NULL,160,3,2,145,148,1,145,'pants/1981.jpg',NULL,4,NULL),(2198,NULL,245,3,9,75,68,2,231,'pants/1984.jpg',NULL,3,NULL),(2199,NULL,215,3,6,100,70,2,202,'pants/1990.jpg',NULL,4,NULL),(2200,NULL,130,3,6,37,138,1,117,'pants/1996.jpg',NULL,2,NULL),(2201,NULL,250,1,4,58,213,1,232,NULL,0,0,NULL),(2202,NULL,225,1,4,105,148,2,213,'pants/2003.jpg',2,4,NULL),(2203,NULL,230,1,2,108,279,1,219,NULL,0,0,NULL),(2204,NULL,205,3,4,95,150,2,193,'pants/2022.jpg',NULL,2,NULL),(2205,NULL,105,2,36,20,20,2,89,'pants/2025.jpg',NULL,3,NULL),(2206,NULL,155,1,6,70,140,2,143,'pants/2028.jpg',NULL,3,NULL),(2207,NULL,175,1,2,79,200,2,161,'pants/2037.jpg',2,3,NULL),(2208,NULL,135,1,3,120,120,2,120,'pants/2041.jpg',NULL,7,NULL),(2209,NULL,215,3,6,100,70,1,202,'pants/2047.jpg',NULL,4,NULL),(2210,NULL,255,1,8,120,76,2,243,'pants/2074.jpg',3,3,NULL),(2211,NULL,110,3,16,48,25,1,99,'pants/2096.jpg',NULL,3,NULL),(2212,NULL,210,1,24,30,47,3,195,'pants/2101.jpg',2,4,NULL),(2213,NULL,125,3,2,114,135,1,114,'pants/2110.jpg',NULL,5,NULL),(2214,NULL,210,1,6,95,80,3,193,'pants/2118.jpg',2,3,NULL),(2215,NULL,225,1,4,53,213,1,212,NULL,NULL,NULL,NULL),(2216,NULL,180,1,1,166,200,3,166,'pants/2142.jpg',2,3,NULL),(2217,NULL,200,3,6,60,160,3,186,'pants/2143.jpg',NULL,4,NULL),(2218,NULL,220,1,4,100,150,3,205,'pants/2146.jpg',3,2,NULL),(2219,NULL,155,1,1,139,326,3,139,'pants/2148.jpg',2,17,NULL),(2220,NULL,180,1,3,165,90,3,165,'pants/2150.jpg',90,3,NULL),(2221,NULL,100,3,3,86,125,3,86,'pants/2168.jpg',NULL,2,NULL),(2222,NULL,400,1,6,400,400,1,400,NULL,NULL,NULL,NULL),(2223,NULL,250,1,35,45,30,3,237,'pants/2208.jpg',2,3,NULL),(2224,NULL,155,1,2,140,140,3,140,'pants/2209.jpg',2,3,NULL),(2225,NULL,400,1,2,400,400,1,400,NULL,NULL,NULL,NULL),(2226,NULL,400,1,8,400,400,3,400,NULL,NULL,NULL,NULL),(2227,NULL,400,3,4,400,400,1,400,NULL,NULL,NULL,NULL),(2228,NULL,125,3,2,54,194,1,111,'pants/2268.jpg',NULL,9,NULL),(2229,NULL,400,1,20,400,400,3,400,NULL,NULL,NULL,NULL),(2230,NULL,400,3,10,400,400,1,400,NULL,NULL,NULL,NULL),(2231,NULL,265,3,10,125,42,1,253,'pants/2292.jpg',NULL,2,NULL),(2232,NULL,135,3,20,28,60,3,121,'pants/2296.jpg',NULL,4,NULL),(2233,NULL,190,3,2,178,180,1,178,'pants/2299.jpg',NULL,NULL,NULL),(2234,NULL,205,1,4,95,148,3,193,'pants/2300.jpg',3,4,NULL),(2235,NULL,310,1,16,70,71,3,289,'pants/2302.jpg',2,5,NULL),(2236,NULL,215,3,10,100,60,3,203,'pants/2307.jpg',NULL,4,NULL),(2237,NULL,145,3,4,65,150,3,133,'pants/2310.jpg',NULL,2,NULL),(2238,NULL,155,1,4,70,165,1,143,'pants/1777.gif',2,6,NULL),(2239,NULL,195,3,5,180,60,1,180,'pants/1783.gif',0,4,NULL),(2240,NULL,225,1,16,50,76,2,209,'pants/1790.gif',2,3,NULL),(2241,NULL,265,3,8,60,150,2,249,'pants/1792.gif',0,2,NULL),(2242,NULL,195,1,6,90,123,2,183,'pants/1799.gif',2,4,NULL),(2243,NULL,175,1,6,51,186,2,159,'pants/1808.gif',2,5,NULL),(2244,NULL,270,1,2,125,320,2,253,'pants/1811.gif',2,0,NULL),(2245,NULL,250,3,10,116,60,1,235,'pants/1815.gif',0,4,NULL),(2246,NULL,225,1,28,50,30,2,209,'pants/1829.gif',2,3,NULL),(2247,NULL,215,1,6,65,183,2,201,'pants/1846.gif',2,8,NULL),(2248,NULL,215,1,3,65,268,2,201,'pants/1847.gif',2,11,NULL),(2249,NULL,100,2,36,21,21,1,93,'pants/1864.gif',0,3,NULL),(2250,NULL,260,1,8,59,135,1,245,'pants/1865.gif',2,5,NULL),(2251,NULL,250,1,25,45,60,2,237,'pants/1882.gif',2,4,NULL),(2252,NULL,195,1,4,90,155,1,183,'pants/1884.gif',8,4,NULL),(2253,NULL,190,3,4,175,45,1,175,'pants/1899.gif',0,6,NULL),(2254,NULL,140,1,1,127,312,1,127,'pants/1901.gif',2,0,NULL),(2255,NULL,180,1,10,85,40,1,168,'pants/1904.jpg',2,3,NULL),(2256,NULL,210,1,4,99,136,2,200,'pants/1925.jpg',2,4,NULL),(2257,NULL,215,3,4,100,100,1,203,'pants/1928.jpg',NULL,6,NULL),(2258,NULL,185,3,12,55,55,1,173,'pants/1930.jpg',NULL,2,NULL),(2259,NULL,245,1,3,75,210,1,231,'pants/1948.jpg',3,3,NULL),(2260,NULL,155,1,3,140,120,1,140,'pants/1977.jpg',3,7,NULL),(2261,NULL,160,3,1,145,200,1,145,'pants/1978.jpg',NULL,3,NULL),(2262,NULL,205,3,6,190,35,1,190,'pants/2000.jpg',NULL,3,NULL),(2263,NULL,100,2,36,19,19,2,85,'pants/2004.jpg',NULL,4,NULL),(2264,NULL,155,1,2,140,185,2,140,'pants/2013.jpg',3,6,NULL),(2265,NULL,220,3,6,102,69,2,207,'pants/2014.jpg',NULL,5,NULL),(2266,NULL,195,1,2,180,180,2,180,'pants/2021.jpg',2,11,NULL),(2267,NULL,135,1,4,60,110,2,123,'pants/2030.jpg',NULL,4,NULL),(2268,NULL,260,1,8,60,214,1,249,NULL,0,0,NULL),(2269,NULL,130,1,12,58,35,2,119,'pants/2064.jpg',2,3,NULL),(2270,NULL,205,3,9,62,74,1,194,'pants/2068.jpg',NULL,2,NULL),(2271,NULL,245,3,10,115,80,2,233,'pants/2072.jpg',NULL,6,NULL),(2272,NULL,160,3,3,144,113,3,144,'pants/2081.jpg',NULL,3,NULL),(2273,NULL,180,3,3,166,140,2,166,'pants/2092.jpg',NULL,3,NULL),(2274,NULL,180,3,3,166,140,2,166,'pants/2093.jpg',NULL,3,NULL),(2275,NULL,195,3,6,90,89,2,183,'pants/2098.jpg',NULL,5,NULL),(2276,NULL,180,3,4,81,150,2,165,'pants/2104.jpg',NULL,2,NULL),(2277,NULL,200,3,6,92,74,3,187,'pants/2115.jpg',NULL,2,NULL),(2278,NULL,155,3,4,140,55,3,140,'pants/2122.jpg',NULL,2,NULL),(2279,NULL,215,3,4,100,150,3,203,'pants/2129.jpg',NULL,2,NULL),(2280,NULL,180,1,2,165,146,3,165,'pants/2134.jpg',2,7,NULL),(2281,NULL,160,3,6,72,90,2,148,'pants/2137.jpg',NULL,3,NULL),(2282,NULL,100,1,6,40,71,1,80,NULL,NULL,NULL,NULL),(2283,NULL,125,3,4,55,100,2,113,'pants/2172.jpg',NULL,6,NULL),(2284,NULL,175,1,5,162,40,3,162,'pants/2177.jpg',2,3,NULL),(2285,NULL,100,3,4,40,115,3,83,'pants/2180.jpg',NULL,4,NULL),(2286,NULL,215,3,3,65,235,3,201,'pants/2183.jpg',NULL,3,NULL),(2287,NULL,200,1,8,44,140,3,185,'pants/2184.jpg',2,3,NULL),(2288,NULL,400,1,6,400,400,3,400,NULL,NULL,NULL,NULL),(2289,NULL,400,1,6,400,400,3,NULL,NULL,0,0,NULL),(2290,NULL,400,3,15,400,400,3,400,NULL,NULL,NULL,NULL),(2291,NULL,200,1,2,90,219,3,183,'pants/2234.jpg',2,3,NULL),(2292,NULL,215,3,9,42,82,1,200,'pants/2241.jpg',NULL,8,NULL),(2293,NULL,315,1,25,58,70,1,302,NULL,NULL,NULL,NULL),(2294,NULL,400,1,4,400,400,1,400,NULL,NULL,NULL,NULL),(2295,NULL,195,3,2,113,230,1,179,'pants/2276.jpg',NULL,8,NULL),(2296,NULL,260,2,6,80,180,3,246,'pants/2286.gif',NULL,11,NULL),(2297,NULL,135,1,16,60,27,3,123,'pants/2288.jpg',2,3,NULL),(2298,NULL,235,3,8,110,48,1,223,'pants/2293.jpg',NULL,3,NULL),(2299,NULL,185,3,10,85,45,1,173,'pants/2294.jpg',NULL,3,NULL),(2300,NULL,245,1,5,46,213,1,230,NULL,NULL,NULL,NULL),(2301,NULL,205,3,4,95,165,1,193,'pants/2311.jpg',NULL,10,NULL),(2302,NULL,135,3,14,55,39,3,114,'pants/2312.jpg',NULL,4,NULL),(2303,NULL,215,3,12,100,35,3,203,'pants/2313.jpg',NULL,3,NULL),(2304,NULL,200,1,6,90,78,3,183,'pants/2315.jpg',2,5,NULL),(2305,NULL,230,3,6,70,115,3,216,'pants/2318.jpg',NULL,4,NULL),(2306,NULL,245,3,12,75,82,3,231,'pants/2319.jpg',NULL,5,NULL),(2307,NULL,250,3,6,77,150,3,237,'pants/2320.jpg',NULL,2,NULL),(2308,NULL,310,1,16,70,85,3,289,'pants/2326.jpg',2,2,NULL),(2309,NULL,285,1,12,130,64,3,264,'pants/2327.jpg',2,3,NULL),(2310,NULL,400,3,6,400,400,3,400,NULL,NULL,NULL,NULL),(2311,NULL,400,1,6,400,400,1,400,NULL,NULL,NULL,NULL),(2312,NULL,250,2,6,112,112,2,227,'pants/2336.jpg',NULL,4,NULL),(2313,NULL,150,3,2,130,130,1,130,'pants/2337.jpg',NULL,5,NULL),(2314,NULL,240,1,8,55,135,2,229,'pants/2339.jpg',2,5,NULL),(2315,NULL,205,3,2,94,222,1,191,'pants/1768.gif',0,0,NULL),(2316,NULL,145,3,4,65,150,1,133,'pants/1769.gif',0,2,NULL),(2317,NULL,175,3,4,160,55,1,160,'pants/1784.gif',0,2,NULL),(2318,NULL,120,3,2,50,295,2,103,'pants/1803.gif',0,0,NULL),(2319,NULL,200,1,4,90,190,2,183,'pants/1813.gif',5,12,NULL),(2320,NULL,190,3,4,84,132,1,171,'pants/1820.gif',0,8,NULL),(2321,NULL,245,3,5,230,60,1,230,'pants/1831.gif',0,4,NULL),(2322,NULL,145,1,7,130,40,2,130,'pants/1837.jpg',2,4,NULL),(2323,NULL,280,3,8,64,96,2,265,'pants/1840.gif',0,6,NULL),(2324,NULL,215,1,3,65,214,1,201,'pants/1844.gif',2,0,NULL),(2325,NULL,185,1,20,83,25,2,169,'pants/1849.gif',2,3,NULL),(2326,NULL,240,1,8,112,54,2,227,'pants/1850.gif',2,3,NULL),(2327,NULL,130,3,4,57,165,1,117,'pants/1852.gif',0,10,NULL),(2328,NULL,275,1,6,130,113,2,263,'pants/1871.gif',3,3,NULL),(2329,NULL,255,3,6,120,100,1,243,'pants/1874.gif',0,6,NULL),(2330,NULL,195,3,14,90,40,1,183,'pants/1875.gif',0,4,NULL),(2331,NULL,265,3,8,60,183,1,249,'pants/1878.gif',0,8,NULL),(2332,NULL,245,3,3,75,243,1,233,'pants/1892.gif',0,0,NULL),(2333,NULL,135,1,24,17,75,1,120,'pants/1900.gif',2,4,NULL),(2334,NULL,240,3,2,111,245,1,225,'pants/1917.jpg',NULL,0,NULL),(2335,NULL,155,1,2,70,200,1,143,'pants/1921.jpg',2,3,NULL),(2336,NULL,270,1,3,250,100,1,250,'pants/1932.gif',2,6,NULL),(2337,NULL,260,3,3,80,300,2,246,'pants/1969.jpg',NULL,NULL,NULL),(2338,NULL,155,1,1,142,208,2,142,'pants/1970.jpg',2,NULL,NULL),(2339,NULL,230,3,8,52,99,2,217,'pants/1975.jpg',NULL,3,NULL),(2340,NULL,180,3,10,82,60,2,167,'pants/1994.jpg',NULL,4,NULL),(2341,NULL,250,1,10,45,130,2,237,'pants/2009.jpg',2,10,NULL),(2342,NULL,205,1,2,95,300,2,193,'pants/2010.jpg',2,5,NULL),(2343,NULL,200,1,4,45,270,2,189,'pants/2026.jpg',NULL,9,NULL),(2344,NULL,150,3,4,67,137,2,137,'pants/2032.gif',NULL,3,NULL),(2345,NULL,170,3,1,155,305,1,155,'pants/2034.jpg',NULL,13,NULL),(2346,NULL,200,1,2,91,301,2,185,'pants/2038.jpg',2,4,NULL),(2347,NULL,175,1,2,80,244,2,163,'pants/2039.jpg',2,35,NULL),(2348,NULL,195,1,2,90,244,2,183,'pants/2040.jpg',2,35,NULL),(2349,NULL,155,1,2,139,180,2,139,'pants/2044.jpg',3,11,NULL),(2350,NULL,215,3,6,100,90,1,203,'pants/2056.jpg',NULL,3,NULL),(2351,NULL,275,3,6,130,130,2,263,'pants/2058.jpg',NULL,4,NULL),(2352,NULL,280,1,4,132,155,2,267,'pants/2059.jpg',2,4,NULL),(2353,NULL,215,3,6,100,100,2,203,'pants/2063.jpg',NULL,6,NULL),(2354,NULL,250,3,10,117,61,2,237,'pants/2073.jpg',NULL,3,NULL),(2355,NULL,260,3,3,80,205,2,246,'pants/2079.jpg',NULL,8,NULL),(2356,NULL,195,3,6,89,90,2,180,'pants/2097.jpg',NULL,3,NULL),(2357,NULL,180,1,4,165,50,2,165,'pants/2103.jpg',2,3,NULL),(2358,NULL,155,3,4,86,55,3,144,'pants/2123.jpg',NULL,2,NULL),(2359,NULL,195,1,6,88,73,3,179,'pants/2145.jpg',2,3,NULL),(2360,NULL,155,1,1,140,215,3,140,'pants/2147.jpg',2,7,NULL),(2361,NULL,255,1,4,60,213,1,240,NULL,NULL,NULL,NULL),(2362,NULL,250,1,3,77,279,1,231,NULL,NULL,NULL,NULL),(2363,NULL,400,1,6,400,400,3,400,NULL,NULL,3,NULL),(2364,NULL,260,3,3,80,220,3,246,'pants/2182.jpg',NULL,2,NULL),(2365,NULL,170,3,4,50,160,3,160,'pants/2190.jpg',0,3,NULL),(2366,NULL,195,3,4,90,165,3,183,'pants/2197.jpg',0,6,NULL),(2367,NULL,400,1,60,400,400,3,400,NULL,2,0,NULL),(2368,NULL,400,1,8,400,400,3,400,NULL,NULL,NULL,NULL),(2369,NULL,400,1,8,400,400,1,400,NULL,NULL,NULL,NULL),(2370,NULL,400,1,6,400,400,1,400,NULL,NULL,NULL,NULL),(2371,NULL,155,1,4,70,130,3,143,'pants/2227.jpg',NULL,5,NULL),(2372,NULL,120,3,4,50,156,1,104,'pants/2229.jpg',NULL,2,NULL),(2373,NULL,400,1,12,400,400,1,400,NULL,NULL,NULL,NULL),(2374,NULL,165,1,6,73,73,3,149,'pants/2231.jpg',4,3,NULL),(2375,NULL,225,1,4,104,156,3,211,'pants/2232.jpg',2,3,NULL),(2376,NULL,255,3,4,120,169,3,244,'pants/2243.jpg',NULL,6,NULL),(2377,NULL,115,3,4,50,120,1,103,'pants/2250.jpg',NULL,4,NULL),(2378,NULL,195,1,1,180,320,1,180,'pants/2257.jpg',2,29,NULL),(2379,NULL,260,1,42,37,37,2,237,'pants/2260.jpg',2,3,NULL),(2380,NULL,400,1,24,400,400,2,400,NULL,2,4,NULL),(2381,NULL,335,1,8,75,180,3,312,'pants/2280.jpg',2,11,NULL),(2382,NULL,210,2,12,63,65,3,195,'pants/2284.gif',NULL,4,NULL),(2383,NULL,105,3,5,90,45,1,90,'pants/2287.gif',NULL,3,NULL),(2384,NULL,400,1,6,400,400,3,400,NULL,NULL,NULL,NULL),(2385,NULL,200,3,4,45,210,3,189,'pants/2297.jpg',NULL,3,NULL),(2386,NULL,175,3,2,162,138,1,162,'pants/2298.jpg',NULL,NULL,NULL),(2387,NULL,325,1,20,58,70,3,302,'pants/2301.jpg',2,6,NULL),(2388,NULL,320,1,12,97,85,3,297,'pants/2303.jpg',2,2,NULL),(2389,NULL,220,1,4,101,127,3,205,'pants/2306.jpg',2,8,NULL),(2390,NULL,165,1,6,150,55,3,150,'pants/2309.jpg',2,3,NULL),(2391,NULL,215,1,12,100,45,3,203,'pants/2317.jpg',2,3,NULL),(2392,NULL,200,3,10,90,40,2,183,'pants/2383.jpg',NULL,3,NULL),(2393,NULL,250,1,16,57,57,2,237,'pants/2384.jpg',6,3,NULL),(2394,NULL,255,1,6,120,120,2,243,'pants/2386.jpg',5,7,NULL),(2395,NULL,140,3,4,62,145,2,127,'pants/2394.jpg',NULL,7,NULL),(2396,NULL,250,3,3,76,225,2,234,'pants/2400.jpg',NULL,4,NULL),(2397,NULL,210,1,20,47,47,2,197,'pants/2402.jpg',3,3,NULL),(2398,NULL,185,3,6,81,120,2,165,'pants/2411.jpg',NULL,7,NULL),(2399,NULL,145,3,8,64,49,2,131,'pants/2412.jpg',NULL,2,NULL),(2400,NULL,135,3,2,123,100,1,123,'pants/2420.jpg',NULL,6,NULL),(2401,NULL,260,3,9,80,124,2,246,'pants/2425.jpg',NULL,3,NULL),(2402,NULL,150,3,2,135,168,2,135,'pants/2426.jpg',NULL,7,NULL),(2403,NULL,200,3,4,90,144,2,183,'pants/2429.jpg',NULL,8,NULL),(2404,NULL,160,1,10,70,58,2,143,'pants/2452.jpg',2,6,NULL),(2405,NULL,120,3,10,106,20,2,106,'pants/2463.jpg',NULL,2,NULL),(2406,NULL,275,3,8,63,140,2,261,'pants/2472.jpg',NULL,3,NULL),(2407,NULL,135,3,30,17,51,2,117,'pants/2500.jpg',NULL,3,NULL),(2408,NULL,195,2,6,87,87,2,177,'pants/2501.jpg',NULL,3,NULL),(2409,NULL,285,3,8,130,75,2,263,'pants/2503.jpg',NULL,5,NULL),(2410,NULL,130,3,8,55,55,2,113,'pants/2504.jpg',NULL,2,NULL),(2411,NULL,245,1,10,20,290,2,227,'pants/2505.jpg',2,15,NULL),(2412,NULL,175,3,1,160,370,1,160,'pants/2523.jpg',NULL,11,NULL),(2413,NULL,160,3,1,145,290,1,145,'pants/2524.jpg',NULL,15,NULL),(2414,NULL,140,3,4,60,185,2,123,NULL,NULL,6,NULL),(2415,NULL,130,3,8,56,49,2,115,'pants/2535.jpg',NULL,4,NULL),(2416,NULL,255,3,4,115,133,2,233,'pants/2538.jpg',NULL,7,NULL),(2417,NULL,200,3,6,90,73,2,183,'pants/2548.jpg',NULL,3,NULL),(2418,NULL,210,2,6,95,80,2,193,'pants/2550.jpg',NULL,3,NULL),(2419,NULL,230,1,8,106,54,2,215,'pants/2553.jpg',2,3,NULL),(2420,NULL,205,1,8,45,112,2,189,'pants/2555.jpg',2,2,NULL),(2421,NULL,250,1,6,115,123,2,234,'pants/2564.jpg',4,4,NULL),(2422,NULL,220,1,4,52,270,1,208,NULL,0,0,NULL),(2423,NULL,225,1,4,52,203,1,208,NULL,NULL,NULL,NULL),(2424,NULL,190,3,1,175,425,2,175,'pants/2580.jpg',NULL,4,NULL),(2425,NULL,190,1,6,173,55,2,173,'pants/2581.jpg',2,3,NULL),(2426,NULL,205,3,6,93,93,2,189,'pants/2582.jpg',NULL,2,NULL),(2427,NULL,185,2,2,170,170,2,170,'pants/2584.jpg',NULL,5,NULL),(2428,NULL,210,3,6,95,108,2,193,'pants/2594.jpg',NULL,9,NULL),(2429,NULL,210,3,3,190,80,2,190,'pants/2602.jpg',NULL,5,NULL),(2430,NULL,320,2,20,57,73,2,297,'pants/2604.jpg',NULL,6,NULL),(2431,NULL,285,1,9,85,80,2,261,'pants/2605.jpg',3,5,NULL),(2432,NULL,180,3,8,80,58,2,163,'pants/2612.jpg',NULL,4,NULL),(2433,NULL,245,3,8,112,85,2,227,'pants/2623.jpg',NULL,2,NULL),(2434,NULL,215,3,8,95,70,2,193,'pants/2624.jpg',NULL,6,NULL),(2435,NULL,200,1,4,90,190,3,183,'pants/2628.jpg',2,NULL,NULL),(2436,NULL,185,3,2,82,219,1,167,'pants/2629.jpg',NULL,3,NULL),(2437,NULL,220,1,6,100,64,2,203,'pants/2642.jpg',17,4,NULL),(2438,NULL,120,3,12,50,50,2,103,'pants/2646.jpg',NULL,3,NULL),(2439,NULL,270,1,4,125,172,2,253,'pants/2649.jpg',5,3,NULL),(2440,NULL,200,3,2,184,119,2,184,'pants/2651.jpg',NULL,5,NULL),(2441,NULL,185,1,6,170,39,2,170,'pants/2673.jpg',2,8,NULL),(2442,NULL,155,3,3,140,114,2,140,'pants/2676.jpg',NULL,2,NULL),(2443,NULL,200,3,30,28,32,2,183,'pants/2678.jpg',NULL,NULL,NULL),(2444,NULL,200,3,36,28,31,2,183,'pants/2679.jpg',NULL,NULL,NULL),(2445,NULL,110,1,4,45,149,2,93,'pants/2682.jpg',NULL,3,NULL),(2446,NULL,270,1,3,85,286,1,255,NULL,NULL,NULL,NULL),(2447,NULL,200,1,2,90,320,2,183,'pants/2711.jpg',3,29,NULL),(2448,NULL,230,1,9,70,70,2,216,'pants/2716.jpg',5,4,NULL),(2449,NULL,265,3,10,124,58,2,251,'pants/2719.jpg',NULL,3,NULL),(2450,NULL,155,1,24,15,90,2,141,'pants/2723.jpg',2,3,NULL),(2451,NULL,140,3,6,60,123,2,123,'pants/2724.jpg',NULL,4,NULL),(2452,NULL,165,1,6,75,70,2,153,'pants/2388.jpg',7,4,NULL),(2453,NULL,250,1,14,33,191,1,231,NULL,NULL,NULL,NULL),(2454,NULL,225,3,4,104,120,2,211,'pants/2393.jpg',NULL,4,NULL),(2455,NULL,200,3,16,45,48,2,189,'pants/2403.jpg',NULL,3,NULL),(2456,NULL,200,3,3,60,225,2,186,'pants/2406.jpg',NULL,4,NULL),(2457,NULL,230,3,6,70,110,2,216,'pants/2407.jpg',NULL,4,NULL),(2458,NULL,255,3,8,120,55,2,243,'pants/2410.jpg',NULL,2,NULL),(2459,NULL,140,3,8,63,49,2,128,'pants/2413.jpg',NULL,2,NULL),(2460,NULL,200,3,4,90,135,2,183,'pants/2418.jpg',NULL,5,NULL),(2461,NULL,135,3,2,118,92,1,118,'pants/2427.jpg',NULL,10,NULL),(2462,NULL,245,3,3,75,200,2,231,'pants/2430.jpg',NULL,3,NULL),(2463,NULL,160,1,2,70,379,2,143,'pants/2440.jpg',2,NULL,NULL),(2464,NULL,125,3,2,110,115,2,110,'pants/2441.jpg',NULL,4,NULL),(2465,NULL,125,1,24,25,50,2,109,'pants/2447.jpg',2,3,NULL),(2466,NULL,180,3,6,80,80,2,163,'pants/2454.jpg',NULL,3,NULL),(2467,NULL,100,3,4,81,82,2,81,'pants/2457.jpg',NULL,5,NULL),(2468,NULL,150,3,6,65,85,2,133,'pants/2526.jpg',NULL,5,NULL),(2469,NULL,270,1,4,120,70,1,120,'pants/2541.jpg',5,6,NULL),(2470,NULL,270,1,4,58,135,1,119,NULL,2,5,NULL),(2471,NULL,145,3,3,130,70,2,130,'pants/2545.jpg',NULL,4,NULL),(2472,NULL,190,1,8,40,140,2,169,'pants/2546.jpg',2,12,NULL),(2473,NULL,225,3,4,104,135,2,211,'pants/2562.jpg',NULL,5,NULL),(2474,NULL,200,1,3,56,327,1,168,NULL,0,0,NULL),(2475,NULL,145,1,1,130,400,2,130,'pants/2575.jpg',4,3,NULL),(2476,NULL,200,3,4,92,111,2,187,'pants/2577.jpg',NULL,3,NULL),(2477,NULL,110,3,6,45,85,2,93,'pants/2589.jpg',NULL,5,NULL),(2478,NULL,225,1,6,100,80,2,203,'pants/2598.jpg',2,5,NULL),(2479,NULL,170,3,4,90,118,2,154,'pants/2601.jpg',NULL,6,NULL),(2480,NULL,325,1,2,150,270,2,304,'pants/2606.jpg',2,9,NULL),(2481,NULL,185,3,9,55,70,2,171,'pants/2614.jpg',NULL,4,NULL),(2482,NULL,220,1,1,206,238,1,206,NULL,NULL,NULL,NULL),(2483,NULL,120,3,2,49,210,2,103,'pants/2635.jpg',NULL,3,NULL),(2484,NULL,200,3,4,90,120,2,183,'pants/2639.jpg',NULL,4,NULL),(2485,NULL,195,3,4,87,146,2,177,'pants/2647.jpg',NULL,6,NULL),(2486,NULL,180,3,8,80,85,2,163,'pants/2668.jpg',NULL,2,NULL),(2487,NULL,235,3,6,108,65,2,219,'pants/2677.jpg',NULL,3,NULL),(2488,NULL,250,1,10,46,213,1,230,NULL,NULL,NULL,NULL),(2489,NULL,150,3,2,135,101,2,135,'pants/2686.jpg',NULL,5,NULL),(2490,NULL,220,3,6,100,100,2,202,'pants/2695.jpg',NULL,2,NULL),(2491,NULL,120,3,4,50,140,1,103,'pants/2697.jpg',NULL,3,NULL),(2492,NULL,265,2,20,60,60,2,249,'pants/2700.jpg',NULL,4,NULL),(2493,NULL,200,3,2,178,155,2,178,'pants/2703.jpg',NULL,4,NULL),(2494,NULL,200,3,8,87,68,2,176,'pants/2705.jpg',NULL,2,NULL),(2495,NULL,255,3,15,78,52,2,240,'pants/2709.jpg',NULL,4,NULL),(2496,NULL,290,1,24,65,50,2,269,'pants/2713.jpg',1,3,NULL),(2497,NULL,130,1,20,20,105,1,116,'pants/2714.jpg',2,2,NULL),(2498,NULL,180,1,12,25,180,2,165,'pants/2721.jpg',2,11,NULL),(2499,NULL,260,1,1,260,349,1,260,NULL,NULL,0,NULL),(2500,NULL,235,1,4,55,222,1,220,NULL,NULL,NULL,NULL),(2501,NULL,300,3,4,177,149,2,281,'pants/2746.jpg',NULL,3,NULL),(2502,NULL,160,1,10,70,59,3,144,'pants/2748.jpg',3,5,NULL),(2503,NULL,225,1,8,50,120,2,209,'pants/2749.jpg',2,4,NULL),(2504,NULL,220,3,8,100,60,2,203,'pants/2753.jpg',NULL,4,NULL),(2505,NULL,195,3,4,87,120,2,177,'pants/2763.jpg',NULL,4,NULL),(2506,NULL,135,3,4,59,166,2,121,'pants/2772.jpg',NULL,9,NULL),(2507,NULL,185,1,4,84,170,2,171,'pants/2776.jpg',7,5,NULL),(2508,NULL,155,3,4,140,55,2,140,'pants/2787.jpg',NULL,2,NULL),(2509,NULL,225,3,8,102,52,2,207,'pants/2788.jpg',NULL,4,NULL),(2510,NULL,200,1,4,92,140,2,187,'pants/2381.jpg',3,3,NULL),(2511,NULL,185,3,4,85,132,2,173,'pants/2398.jpg',NULL,3,NULL),(2512,NULL,230,1,4,106,155,2,215,'pants/2399.jpg',2,4,NULL),(2513,NULL,250,3,4,118,137,2,239,'pants/2401.jpg',NULL,3,NULL),(2514,NULL,210,1,4,95,120,2,193,'pants/2404.jpg',5,4,NULL),(2515,NULL,200,3,6,90,124,1,183,'pants/2422.jpg',NULL,3,NULL),(2516,NULL,125,3,4,108,67,1,108,'pants/2428.jpg',NULL,3,NULL),(2517,NULL,145,3,4,63,149,2,129,'pants/2438.jpg',NULL,3,NULL),(2518,NULL,120,1,6,17,403,1,102,NULL,0,0,NULL),(2519,NULL,265,3,12,60,125,2,249,'pants/2445.jpg',NULL,2,NULL),(2520,NULL,170,3,6,75,127,2,153,'pants/2448.jpg',NULL,8,NULL),(2521,NULL,280,3,4,131,168,2,265,'pants/2449.jpg',NULL,7,NULL),(2522,NULL,100,1,3,61,107,1,61,'pants/2453.jpg',2,20,NULL),(2523,NULL,160,3,2,70,210,2,143,'pants/2456.jpg',NULL,3,NULL),(2524,NULL,170,3,4,36,266,2,153,'pants/2458.jpg',NULL,4,NULL),(2525,NULL,245,3,8,55,150,2,229,'pants/2459.jpg',NULL,2,NULL),(2526,NULL,220,2,6,100,80,2,203,'pants/2460.jpg',NULL,3,NULL),(2527,NULL,160,3,3,145,65,1,145,'pants/2466.jpg',NULL,3,NULL),(2528,NULL,210,1,4,49,213,1,196,NULL,NULL,NULL,NULL),(2529,NULL,205,3,4,93,110,2,189,'pants/2473.jpg',NULL,4,NULL),(2530,NULL,245,3,9,74,73,2,228,'pants/2476.jpg',NULL,3,NULL),(2531,NULL,310,3,8,70,172,2,289,'pants/2488.jpg',NULL,3,NULL),(2532,NULL,235,3,8,108,85,2,219,'pants/2489.jpg',NULL,2,NULL),(2533,NULL,290,3,9,86,125,2,266,'pants/2518.jpg',NULL,2,NULL),(2534,NULL,280,1,6,85,123,2,261,'pants/2533.jpg',3,5,NULL),(2535,NULL,280,3,4,131,130,2,265,'pants/2539.jpg',NULL,5,NULL),(2536,NULL,210,3,4,95,120,2,193,'pants/2554.jpg',NULL,4,NULL),(2537,NULL,150,1,4,66,160,2,135,'pants/2556.jpg',2,4,NULL),(2538,NULL,215,1,8,50,214,1,200,NULL,0,0,NULL),(2539,NULL,220,3,4,100,150,2,203,'pants/2559.jpg',NULL,2,NULL),(2540,NULL,205,3,6,94,93,2,191,'pants/2561.jpg',NULL,2,NULL),(2541,NULL,160,1,12,70,30,1,143,'pants/2583.jpg',2,4,NULL),(2542,NULL,145,3,2,63,216,2,129,'pants/2588.jpg',NULL,6,NULL),(2543,NULL,185,3,8,81,82,2,165,'pants/2593.jpg',NULL,5,NULL),(2544,NULL,220,1,2,100,346,2,203,'pants/2595.jpg',4,3,NULL),(2545,NULL,270,3,4,60,280,2,252,'pants/2618.jpg',NULL,6,NULL),(2546,NULL,150,1,4,65,140,2,133,'pants/2626.jpg',2,12,NULL),(2547,NULL,255,1,8,58,213,1,232,NULL,0,0,NULL),(2548,NULL,220,3,4,100,112,2,203,'pants/2653.jpg',NULL,3,NULL),(2549,NULL,235,1,16,52,76,2,217,'pants/2670.jpg',2,3,NULL),(2550,NULL,145,3,2,130,185,2,130,'pants/2681.jpg',NULL,6,NULL),(2551,NULL,150,3,3,110,80,2,132,'pants/2687.jpg',NULL,5,NULL),(2552,NULL,245,1,4,110,180,2,223,'pants/2691.jpg',0,11,NULL),(2553,NULL,155,1,25,25,67,2,137,'pants/2707.jpg',2,3,NULL),(2554,NULL,255,3,6,118,131,1,239,'pants/2717.jpg',NULL,3,NULL),(2555,NULL,170,3,2,157,149,2,157,'pants/2718.jpg',NULL,3,NULL),(2556,NULL,305,1,2,282,207,2,282,'pants/2720.jpg',2,6,NULL),(2557,NULL,115,1,24,10,80,2,101,'pants/2722.jpg',2,3,NULL),(2558,NULL,180,1,4,78,199,3,159,'pants/2730.jpg',2,3,NULL),(2559,NULL,170,1,6,50,211,2,156,'pants/2732.jpg',2,3,NULL),(2560,NULL,285,1,6,130,130,2,263,'pants/2738.jpg',2,4,NULL),(2561,NULL,165,1,10,72,60,2,147,'pants/2745.jpg',2,4,NULL),(2562,NULL,160,1,4,70,120,2,143,'pants/2764.jpg',3,4,NULL),(2563,NULL,150,3,4,65,105,2,133,'pants/2767.jpg',NULL,6,NULL),(2564,NULL,260,1,3,80,279,1,240,NULL,0,0,NULL),(2565,NULL,180,3,8,80,48,2,163,'pants/2786.jpg',NULL,3,NULL),(2566,NULL,240,1,2,110,205,2,223,'pants/2790.jpg',5,8,NULL),(2567,NULL,130,3,14,55,25,2,113,'pants/2791.jpg',NULL,4,NULL),(2568,NULL,265,1,12,60,80,2,249,'pants/2793.jpg',2,3,NULL),(2569,NULL,280,1,8,64,130,2,265,'pants/2796.jpg',2,5,NULL),(2570,NULL,275,1,6,85,156,2,261,'pants/2797.jpg',2,3,NULL),(2571,NULL,175,3,16,37,50,2,157,'pants/2798.jpg',NULL,3,NULL),(2572,NULL,165,3,8,72,82,2,147,'pants/2799.jpg',NULL,5,NULL),(2573,NULL,105,1,8,40,70,2,84,'pants/2800.jpg',2,6,NULL),(2574,NULL,210,1,8,40,70,2,84,NULL,2,6,NULL),(2575,NULL,235,1,4,55,213,1,220,NULL,NULL,NULL,NULL),(2576,NULL,170,1,2,40,250,2,153,'pants/2803.jpg',2,NULL,NULL),(2577,NULL,200,1,4,90,230,2,183,'pants/2804.jpg',2,NULL,NULL),(2578,NULL,170,1,4,75,265,2,153,'pants/2805.jpg',2,NULL,NULL),(2579,NULL,255,3,6,115,78,3,233,'pants/2382.jpg',NULL,5,NULL),(2580,NULL,235,1,6,70,172,2,216,'pants/2385.png',2,3,NULL),(2581,NULL,220,3,3,95,108,2,95,'pants/2408.jpg',NULL,9,NULL),(2582,NULL,210,3,3,195,100,1,195,'pants/2432.jpg',NULL,6,NULL),(2583,NULL,195,3,2,89,219,1,181,'pants/2433.jpg',NULL,3,NULL),(2584,NULL,195,3,4,87,120,1,177,'pants/2436.jpg',NULL,4,NULL),(2585,NULL,245,1,27,74,45,3,228,'pants/2437.jpg',2,3,NULL),(2586,NULL,95,3,4,81,82,2,81,'pants/2451.jpg',NULL,5,NULL),(2587,NULL,190,3,4,85,150,2,173,'pants/2462.jpg',NULL,2,NULL),(2588,NULL,220,3,3,204,80,1,204,'pants/2464.jpg',NULL,3,NULL),(2589,NULL,180,3,2,162,138,2,162,'pants/2467.jpg',NULL,5,NULL),(2590,NULL,205,3,2,188,130,1,188,'pants/2471.jpg',NULL,5,NULL),(2591,NULL,230,1,2,108,279,1,216,NULL,NULL,NULL,NULL),(2592,NULL,240,1,4,110,205,2,224,'pants/2481.jpg',5,5,NULL),(2593,NULL,270,1,2,125,300,2,254,'pants/2482.jpg',2,5,NULL),(2594,NULL,195,2,3,180,80,2,180,'pants/2483.jpg',NULL,3,NULL),(2595,NULL,260,1,4,60,213,1,249,NULL,0,0,NULL),(2596,NULL,265,1,4,120,130,2,243,'pants/2492.jpg',2,10,NULL),(2597,NULL,115,3,4,49,131,2,101,'pants/2493.jpg',NULL,4,NULL),(2598,NULL,135,1,42,17,28,2,117,'pants/2495.jpg',2,4,NULL),(2599,NULL,125,1,4,25,260,2,109,'pants/2496.jpg',2,10,NULL),(2600,NULL,280,3,6,130,87,2,264,'pants/2498.jpg',NULL,3,NULL),(2601,NULL,130,1,15,20,100,2,112,'pants/2506.jpg',3,6,NULL),(2602,NULL,255,1,6,118,125,2,240,'pants/2508.jpg',20,2,NULL),(2603,NULL,100,1,16,16,54,2,73,'pants/2512.jpg',2,3,NULL),(2604,NULL,270,3,10,48,180,2,252,'pants/2513.jpg',NULL,11,NULL),(2605,NULL,120,3,4,50,130,2,103,'pants/2514.jpg',NULL,5,NULL),(2606,NULL,175,3,4,78,150,2,159,'pants/2516.jpg',NULL,2,NULL),(2607,NULL,140,3,6,61,90,2,126,'pants/2520.jpg',NULL,3,NULL),(2608,NULL,110,1,10,15,150,2,91,'pants/2521.jpg',2,2,NULL),(2609,NULL,210,3,6,96,73,2,195,'pants/2522.jpg',NULL,3,NULL),(2610,NULL,115,3,1,100,270,2,100,'pants/2529.jpg',NULL,9,NULL),(2611,NULL,240,3,6,110,79,2,223,'pants/2531.jpg',NULL,4,NULL),(2612,NULL,140,3,2,126,117,2,126,'pants/2537.jpg',NULL,2,NULL),(2613,NULL,225,1,8,50,100,2,209,'pants/2552.jpg',2,6,NULL),(2614,NULL,180,1,2,80,220,2,163,'pants/2560.jpg',2,2,NULL),(2615,NULL,220,1,3,68,286,1,204,NULL,NULL,NULL,NULL),(2616,NULL,180,3,2,166,104,2,166,'pants/2597.jpg',NULL,2,NULL),(2617,NULL,310,1,28,70,40,2,289,'pants/2600.jpg',2,4,NULL),(2618,NULL,260,3,8,120,103,2,243,'pants/2603.jpg',NULL,4,NULL),(2619,NULL,200,3,4,90,115,2,184,'pants/2607.jpg',NULL,4,NULL),(2620,NULL,185,3,6,83,80,2,169,'pants/2608.jpg',NULL,3,NULL),(2621,NULL,150,3,6,65,90,2,133,'pants/2613.jpg',NULL,3,NULL),(2622,NULL,220,1,1,204,230,2,206,NULL,2,8,NULL),(2623,NULL,120,1,10,50,40,2,103,'pants/2619.jpg',2,6,NULL),(2624,NULL,280,1,21,35,80,2,263,'pants/2620.jpg',2,3,NULL),(2625,NULL,160,1,14,70,50,2,145,'pants/2643.jpg',3,4,NULL),(2626,NULL,145,3,8,64,85,2,131,'pants/2654.jpg',NULL,2,NULL),(2627,NULL,180,1,2,60,290,3,163,'pants/2658.jpg',2,NULL,NULL),(2628,NULL,180,1,2,60,240,3,163,'pants/2659.jpg',2,NULL,NULL),(2629,NULL,140,1,6,61,100,2,124,'pants/2661.jpg',2,6,NULL),(2630,NULL,120,3,4,50,150,2,103,'pants/2665.jpg',NULL,2,NULL),(2631,NULL,160,1,2,145,165,2,145,'pants/2666.jpg',2,10,NULL),(2632,NULL,155,1,1,139,207,2,139,'pants/2667.jpg',2,6,NULL),(2633,NULL,175,3,10,160,303,2,160,'pants/2685.jpg',NULL,NULL,NULL),(2634,NULL,245,1,6,74,140,2,228,'pants/2698.jpg',2,3,NULL),(2635,NULL,280,1,2,130,400,2,263,'pants/2708.jpg',4,3,NULL),(2636,NULL,230,1,3,70,279,1,210,NULL,NULL,NULL,NULL),(2637,NULL,190,3,2,85,200,2,173,'pants/2712.jpg',NULL,3,NULL),(2638,NULL,200,1,1,200,254,1,200,NULL,NULL,0,NULL),(2639,NULL,260,3,18,80,60,2,246,'pants/2727.jpg',NULL,4,NULL),(2640,NULL,225,1,3,70,318,1,210,NULL,NULL,0,NULL),(2641,NULL,140,1,3,40,275,2,126,'pants/2390.jpg',2,4,NULL),(2642,NULL,110,1,44,21,16,2,93,'pants/2415.jpg',2,2,NULL),(2643,NULL,150,3,2,65,200,1,133,'pants/2421.jpg',NULL,3,NULL),(2644,NULL,245,2,12,75,75,2,231,'pants/2424.jpg',NULL,4,NULL),(2645,NULL,170,1,6,50,110,2,156,'pants/2431.jpg',2,4,NULL),(2646,NULL,200,3,2,90,200,1,183,'pants/2435.jpg',NULL,3,NULL),(2647,NULL,205,1,12,62,53,2,191,'pants/2442.jpg',2,3,NULL),(2648,NULL,180,3,4,81,138,1,165,'pants/2444.jpg',NULL,5,NULL),(2649,NULL,200,3,8,90,50,2,183,'pants/2450.jpg',NULL,3,NULL),(2650,NULL,110,3,3,95,108,1,95,'pants/2468.jpg',NULL,9,NULL),(2651,NULL,180,3,2,162,138,2,162,'pants/2470.jpg',NULL,5,NULL),(2652,NULL,170,1,9,50,90,2,156,'pants/2475.jpg',4,3,NULL),(2653,NULL,145,3,4,130,55,2,130,'pants/2478.jpg',NULL,2,NULL),(2654,NULL,130,2,20,26,37,2,113,'pants/2486.jpg',NULL,4,NULL),(2655,NULL,335,3,12,50,150,2,315,'pants/2487.jpg',NULL,2,NULL),(2656,NULL,260,1,6,120,73,2,244,'pants/2515.jpg',2,3,NULL),(2657,NULL,255,3,4,114,135,2,232,'pants/2517.jpg',NULL,5,NULL),(2658,NULL,130,1,4,55,140,2,113,'pants/2519.jpg',2,3,NULL),(2659,NULL,255,3,6,118,125,2,240,'pants/2528.jpg',NULL,2,NULL),(2660,NULL,200,3,6,90,72,2,183,'pants/2530.jpg',NULL,2,NULL),(2661,NULL,200,1,6,90,70,2,183,'pants/2532.jpg',2,4,NULL),(2662,NULL,155,3,4,69,155,2,140,'pants/2536.jpg',NULL,4,NULL),(2663,NULL,195,1,2,90,222,1,180,NULL,0,0,NULL),(2664,NULL,210,3,4,90,76,1,90,NULL,NULL,3,NULL),(2665,NULL,170,3,3,50,290,2,156,'pants/2549.jpg',NULL,15,NULL),(2666,NULL,225,1,3,70,286,1,210,NULL,0,0,NULL),(2667,NULL,155,1,2,138,138,2,138,'pants/2565.jpg',2,5,NULL),(2668,NULL,205,3,6,93,94,2,189,'pants/2566.jpg',NULL,2,NULL),(2669,NULL,205,1,4,92,138,3,187,'pants/2567.jpg',3,5,NULL),(2670,NULL,195,3,6,85,132,2,173,'pants/2570.jpg',NULL,2,NULL),(2671,NULL,190,1,4,43,229,1,172,NULL,NULL,NULL,NULL),(2672,NULL,175,3,6,52,198,2,161,'pants/2579.jpg',NULL,4,NULL),(2673,NULL,265,2,4,122,154,2,247,'pants/2587.jpg',NULL,5,NULL),(2674,NULL,170,3,2,77,225,2,157,'pants/2591.jpg',NULL,4,NULL),(2675,NULL,305,1,1,285,210,2,210,'pants/2596.jpg',0,3,NULL),(2676,NULL,270,3,4,60,280,2,252,'pants/2617.jpg',NULL,6,NULL),(2677,NULL,120,1,6,50,115,2,103,'pants/2625.jpg',2,12,NULL),(2678,NULL,170,1,2,60,225,2,156,'pants/2631.jpg',2,NULL,NULL),(2679,NULL,220,1,6,100,64,2,203,'pants/2636.jpg',10,4,NULL),(2680,NULL,140,1,10,60,38,2,123,'pants/2637.jpg',10,3,NULL),(2681,NULL,305,1,1,283,207,2,283,'pants/2638.jpg',2,47,NULL),(2682,NULL,200,1,4,90,230,2,183,'pants/2640.jpg',2,NULL,NULL),(2683,NULL,135,1,18,17,91,2,117,'pants/2644.jpg',2,2,NULL),(2684,NULL,155,3,4,33,200,2,141,'pants/2648.jpg',NULL,3,NULL),(2685,NULL,255,3,8,117,83,2,237,'pants/2650.jpg',NULL,4,NULL),(2686,NULL,200,3,2,184,119,2,184,'pants/2652.jpg',NULL,5,NULL),(2687,NULL,185,1,2,85,286,2,170,NULL,NULL,NULL,NULL),(2688,NULL,190,1,10,86,58,2,175,'pants/2669.jpg',2,3,NULL),(2689,NULL,125,3,4,53,115,2,109,'pants/2672.jpg',NULL,4,NULL),(2690,NULL,165,1,2,72,252,2,150,'pants/2680.jpg',2,NULL,NULL),(2691,NULL,155,1,4,75,132,2,132,'pants/2688.jpg',2,8,NULL),(2692,NULL,200,3,2,90,215,2,183,'pants/2692.jpg',NULL,7,NULL),(2693,NULL,135,3,6,58,90,2,119,'pants/2706.jpg',NULL,3,NULL),(2694,NULL,225,1,3,70,270,1,210,NULL,NULL,0,NULL),(2695,NULL,225,1,3,70,349,1,210,NULL,NULL,0,NULL),(2696,NULL,195,1,2,180,115,2,180,'pants/2736.jpg',NULL,4,NULL),(2697,NULL,135,1,4,120,70,3,120,'pants/2739.jpg',5,6,NULL),(2698,NULL,250,1,3,78,286,1,234,NULL,NULL,NULL,NULL),(2699,NULL,180,1,12,40,93,2,169,'pants/2387.jpg',7,2,NULL),(2700,NULL,215,3,4,100,100,2,203,'pants/2389.jpg',NULL,6,NULL),(2701,NULL,185,3,6,85,125,2,163,'pants/2391.jpg',NULL,2,NULL),(2702,NULL,190,3,2,175,140,1,175,'pants/2395.jpg',NULL,3,NULL),(2703,NULL,200,3,3,180,60,1,180,'pants/2396.jpg',NULL,8,NULL),(2704,NULL,135,3,6,60,68,2,123,'pants/2397.jpg',NULL,3,NULL),(2705,NULL,215,3,6,65,180,2,201,'pants/2409.jpg',NULL,11,NULL),(2706,NULL,210,3,8,46,187,2,193,'pants/2414.jpg',NULL,4,NULL),(2707,NULL,110,3,15,17,65,2,97,'pants/2416.jpg',NULL,6,NULL),(2708,NULL,175,3,4,80,148,2,163,'pants/2417.jpg',NULL,4,NULL),(2709,NULL,200,3,4,90,155,2,183,'pants/2419.jpg',NULL,4,NULL),(2710,NULL,270,3,9,80,114,2,246,'pants/2446.jpg',NULL,3,NULL),(2711,NULL,165,3,4,150,55,2,150,'pants/2477.jpg',NULL,2,NULL),(2712,NULL,230,1,4,105,169,2,214,NULL,2,6,NULL),(2713,NULL,235,1,4,55,222,2,220,NULL,NULL,NULL,NULL),(2714,NULL,150,3,24,20,55,2,135,'pants/2485.jpg',NULL,2,NULL),(2715,NULL,175,3,5,160,60,2,160,'pants/2490.jpg',NULL,4,NULL),(2716,NULL,130,3,6,55,101,2,113,'pants/2494.jpg',NULL,5,NULL),(2717,NULL,200,3,6,90,90,2,184,'pants/2497.jpg',NULL,3,NULL),(2718,NULL,165,1,2,150,120,2,150,'pants/2502.jpg',2,4,NULL),(2719,NULL,170,3,4,76,115,1,156,'pants/2510.jpg',NULL,4,NULL),(2720,NULL,325,3,12,100,72,2,311,'pants/2511.jpg',NULL,4,NULL),(2721,NULL,170,3,4,75,98,2,163,'pants/2525.jpg',NULL,4,NULL),(2722,NULL,160,1,2,145,165,2,145,'pants/2534.jpg',2,10,NULL),(2723,NULL,145,3,1,127,252,2,127,'pants/2544.jpg',NULL,3,NULL),(2724,NULL,180,3,4,80,110,2,163,'pants/2571.jpg',NULL,4,NULL),(2725,NULL,175,1,2,78,200,2,159,'pants/2572.jpg',2,3,NULL),(2726,NULL,195,1,2,88,235,2,179,'pants/2585.jpg',2,3,NULL),(2727,NULL,225,3,8,50,156,2,210,'pants/2586.jpg',NULL,2,NULL),(2728,NULL,150,1,16,65,25,1,133,'pants/2590.jpg',2,3,NULL),(2729,NULL,175,1,2,160,132,2,160,'pants/2592.jpg',3,3,NULL),(2730,NULL,300,3,6,137,111,2,278,'pants/2621.jpg',NULL,6,NULL),(2731,NULL,160,1,26,70,13,2,143,'pants/2622.jpg',2,3,NULL),(2732,NULL,140,3,4,60,140,2,123,'pants/2633.jpg',NULL,3,NULL),(2733,NULL,190,1,2,72,252,2,168,'pants/2641.jpg',2,NULL,NULL),(2734,NULL,240,1,18,35,123,2,225,'pants/2645.jpg',2,4,NULL),(2735,NULL,240,3,2,220,148,2,220,'pants/2655.jpg',NULL,4,NULL),(2736,NULL,180,1,2,60,215,3,163,'pants/2657.jpg',2,NULL,NULL),(2737,NULL,225,3,12,51,103,2,211,'pants/2662.jpg',NULL,3,NULL),(2738,NULL,155,1,2,60,225,2,138,'pants/2674.jpg',2,NULL,NULL),(2739,NULL,180,1,2,60,215,2,180,'pants/2675.jpg',2,NULL,NULL),(2740,NULL,235,1,8,53,213,1,212,NULL,NULL,NULL,NULL),(2741,NULL,145,3,2,128,150,2,128,'pants/2694.jpg',NULL,2,NULL),(2742,NULL,100,3,10,40,40,2,83,'pants/2699.jpg',NULL,3,NULL),(2743,NULL,200,3,2,178,155,2,178,'pants/2702.jpg',NULL,4,NULL),(2744,NULL,180,3,6,80,130,2,163,'pants/2726.jpg',NULL,4,NULL),(2745,NULL,180,3,6,80,100,2,164,'pants/2728.jpg',NULL,5,NULL),(2746,NULL,215,1,4,98,98,2,199,'pants/2729.jpg',2,4,NULL),(2747,NULL,170,1,4,75,265,3,153,'pants/2737.jpg',3,NULL,NULL),(2748,NULL,270,3,8,125,83,2,253,'pants/2741.jpg',NULL,5,NULL),(2749,NULL,140,3,12,60,60,2,123,'pants/2747.jpg',NULL,3,NULL),(2750,NULL,225,1,16,50,85,3,209,'pants/2750.jpg',2,2,NULL),(2751,NULL,115,3,8,48,75,1,98,'pants/2752.jpg',0,0,NULL),(2752,NULL,215,1,2,100,240,2,203,'pants/2754.jpg',2,8,NULL),(2753,NULL,165,1,9,47,72,2,147,'pants/2756.jpg',2,2,NULL),(2754,NULL,190,3,3,175,62,1,175,'pants/2757.jpg',NULL,6,NULL),(2755,NULL,235,1,8,53,213,1,212,NULL,0,0,NULL),(2756,NULL,205,1,16,45,48,2,189,'pants/2761.jpg',7,3,NULL),(2757,NULL,245,1,10,45,213,1,225,NULL,0,0,NULL),(2758,NULL,180,1,6,80,90,2,163,'pants/2765.jpg',3,3,NULL),(2759,NULL,140,1,4,60,186,2,123,'pants/2770.jpg',2,5,NULL),(2760,NULL,155,1,10,70,40,2,143,'pants/2405.jpg',1,3,NULL),(2761,NULL,140,1,8,62,48,2,126,'pants/2423.jpg',2,3,NULL),(2762,NULL,240,3,2,111,275,1,225,'pants/2434.jpg',NULL,4,NULL),(2763,NULL,170,3,2,75,236,2,153,'pants/2439.jpg',NULL,NULL,NULL),(2764,NULL,140,3,4,60,150,2,123,'pants/2455.jpg',NULL,2,NULL),(2765,NULL,235,3,4,108,130,2,219,'pants/2461.jpg',NULL,5,NULL),(2766,NULL,255,3,5,45,255,1,237,'pants/2465.jpg',NULL,15,NULL),(2767,NULL,135,3,9,38,100,2,120,'pants/2491.jpg',NULL,6,NULL),(2768,NULL,175,3,2,160,110,1,160,'pants/2499.jpg',NULL,4,NULL),(2769,NULL,200,3,20,44,60,1,185,'pants/2507.jpg',NULL,4,NULL),(2770,NULL,210,3,10,95,60,2,193,'pants/2509.jpg',NULL,4,NULL),(2771,NULL,150,1,6,40,140,2,126,'pants/2547.jpg',2,12,NULL),(2772,NULL,145,1,2,130,170,2,130,'pants/2563.jpg',2,5,NULL),(2773,NULL,150,3,4,65,172,1,132,'pants/2578.jpg',NULL,3,NULL),(2774,NULL,175,3,1,160,189,2,160,'pants/2599.jpg',NULL,4,NULL),(2775,NULL,180,3,4,80,150,2,163,'pants/2609.jpg',NULL,2,NULL),(2776,NULL,260,1,4,61,213,1,244,NULL,NULL,NULL,NULL),(2777,NULL,155,2,4,69,115,2,141,'pants/2611.jpg',NULL,4,NULL),(2778,NULL,260,1,8,60,213,1,240,NULL,NULL,NULL,NULL),(2779,NULL,225,3,2,102,275,1,207,'pants/2630.jpg',NULL,4,NULL),(2780,NULL,230,1,14,105,30,2,213,'pants/2634.jpg',2,3,NULL),(2781,NULL,220,3,2,200,148,2,200,'pants/2656.jpg',NULL,4,NULL),(2782,NULL,185,3,2,82,205,1,167,'pants/2660.jpg',NULL,8,NULL),(2783,NULL,265,1,10,47,177,2,251,'pants/2663.jpg',2,4,NULL),(2784,NULL,180,3,2,80,230,2,163,'pants/2671.jpg',NULL,8,NULL),(2785,NULL,175,3,3,161,79,2,161,'pants/2683.jpg',NULL,4,NULL),(2786,NULL,170,3,6,75,100,2,153,'pants/2689.jpg',NULL,6,NULL),(2787,NULL,245,1,8,55,149,1,229,'pants/2696.jpg',2,3,NULL),(2788,NULL,325,3,6,149,131,2,301,'pants/2704.jpg',NULL,3,NULL),(2789,NULL,260,3,3,80,238,2,246,'pants/2742.jpg',NULL,10,NULL),(2790,NULL,245,1,6,75,100,2,231,'pants/2743.jpg',2,2,NULL),(2791,NULL,150,1,6,65,72,2,133,'pants/2744.jpg',2,2,NULL),(2792,NULL,160,3,6,71,105,1,146,'pants/2751.jpg',NULL,0,NULL),(2793,NULL,150,1,6,65,70,2,133,'pants/2755.jpg',2,4,NULL),(2794,NULL,275,1,6,61,100,2,124,'pants/2758.jpg',2,6,NULL),(2795,NULL,320,1,10,70,59,3,144,'pants/2759.jpg',3,5,NULL),(2796,NULL,155,1,2,140,140,2,140,'pants/2766.jpg',15,3,NULL),(2797,NULL,260,1,10,48,213,1,240,NULL,0,0,NULL),(2798,NULL,230,1,3,70,208,2,216,'pants/2771.jpg',2,0,NULL),(2799,NULL,190,1,6,82,120,2,167,'pants/2773.jpg',2,7,NULL),(2800,NULL,165,3,12,35,122,2,149,'pants/2774.jpg',NULL,5,NULL),(2801,NULL,185,3,10,95,60,2,168,'pants/2775.jpg',0,4,NULL),(2802,NULL,155,1,2,70,286,1,140,NULL,0,0,NULL),(2803,NULL,185,3,10,84,53,2,171,'pants/2778.jpg',NULL,2,NULL),(2804,NULL,205,3,10,90,59,2,183,'pants/2779.jpg',NULL,4,NULL),(2805,NULL,270,3,6,125,69,2,253,'pants/2780.jpg',NULL,5,NULL),(2806,NULL,260,1,6,78,199,3,240,'pants/2781.jpg',2,3,NULL),(2807,NULL,160,1,4,34,300,2,145,'pants/2782.jpg',2,5,NULL),(2808,NULL,125,1,32,25,25,2,109,'pants/2783.jpg',2,3,NULL),(2809,NULL,170,1,2,155,144,2,155,'pants/2784.jpg',2,8,NULL),(2810,NULL,240,1,4,110,100,2,223,'pants/2785.jpg',2,6,NULL),(2811,NULL,200,1,24,90,21,2,183,'pants/2789.jpg',2,3,NULL),(2812,NULL,130,3,14,55,25,2,113,'pants/2792.jpg',NULL,4,NULL),(2813,NULL,180,1,88,18,18,2,165,'pants/2794.jpg',2,3,NULL),(2814,NULL,190,1,3,82,120,2,167,'pants/2795.jpg',2,7,NULL),(2815,NULL,240,1,3,72,318,1,216,NULL,0,0,NULL),(2816,NULL,260,1,12,59,70,2,245,'pants/2830.jpg',3,4,NULL),(2817,NULL,260,1,15,80,58,2,246,'pants/2831.jpg',2,3,NULL),(2818,NULL,255,1,12,58,90,2,241,'pants/2833.jpg',13,3,NULL),(2819,NULL,195,3,8,85,60,2,173,'pants/2837.jpg',NULL,4,NULL),(2820,NULL,170,3,12,75,60,2,153,'pants/2839.jpg',NULL,4,NULL),(2821,NULL,220,1,4,75,222,2,203,'pants/2807.jpg',2,NULL,NULL),(2822,NULL,180,1,2,40,220,2,163,'pants/2815.jpg',2,9,NULL),(2823,NULL,215,1,6,98,74,2,199,'pants/2823.jpg',2,2,NULL),(2824,NULL,280,3,2,130,259,2,263,'pants/2824.jpg',NULL,11,NULL),(2825,NULL,235,1,4,109,120,2,220,'pants/2825.jpg',2,4,NULL),(2826,NULL,230,1,4,53,213,1,212,NULL,0,0,NULL),(2827,NULL,220,3,6,100,100,2,204,'pants/2828.jpg',NULL,6,NULL),(2828,NULL,255,1,12,58,100,2,241,'pants/2841.jpg',3,2,NULL),(2829,NULL,180,3,2,80,405,2,163,'pants/2822.jpg',0,24,NULL),(2830,NULL,240,1,8,55,213,1,220,NULL,0,0,NULL),(2831,NULL,200,3,10,90,58,2,183,'pants/2834.jpg',NULL,3,NULL),(2832,NULL,145,1,2,62,231,2,127,'pants/2843.jpg',2,7,NULL),(2833,NULL,250,3,6,113,80,2,229,'pants/2836.jpg',NULL,5,NULL),(2834,NULL,195,3,4,87,180,2,177,'pants/2838.jpg',NULL,11,NULL),(2835,NULL,200,3,2,90,197,2,183,'pants/2844.jpg',NULL,6,NULL),(2836,NULL,130,1,7,110,50,2,110,'pants/2808.jpg',2,4,NULL),(2837,NULL,230,1,4,105,130,2,213,'pants/2814.jpg',2,5,NULL),(2838,NULL,100,2,3,80,80,1,80,NULL,NULL,62,NULL),(2839,NULL,245,1,7,110,50,2,110,NULL,2,4,NULL),(2840,NULL,125,3,3,34,234,2,108,'pants/2816.jpg',NULL,4,NULL),(2841,NULL,270,1,8,60,130,2,249,'pants/2826.jpg',2,10,NULL),(2842,NULL,120,3,4,50,105,1,104,'pants/2842.jpg',NULL,6,NULL),(2843,NULL,195,1,2,89,231,2,181,'pants/2845.jpg',3,7,NULL),(2844,NULL,230,3,6,142,70,2,214,'pants/2811.jpg',NULL,4,NULL),(2845,NULL,155,1,2,60,222,2,138,'pants/2812.jpg',2,NULL,NULL),(2846,NULL,160,1,4,70,105,2,143,'pants/2813.jpg',4,6,NULL),(2847,NULL,140,1,4,60,165,2,123,'pants/2818.jpg',3,10,NULL),(2848,NULL,220,1,14,100,30,2,203,'pants/2819.jpg',2,3,NULL),(2849,NULL,190,1,4,80,68,1,80,NULL,2,2,NULL),(2850,NULL,235,1,3,100,120,1,203,NULL,NULL,7,NULL),(2851,NULL,175,1,1,160,230,2,160,'pants/2847.jpg',2,8,NULL),(2852,NULL,200,1,4,90,198,2,183,'pants/2806.jpg',2,NULL,NULL),(2853,NULL,165,1,10,27,105,2,147,'pants/2809.jpg',2,6,NULL),(2854,NULL,200,1,4,90,120,2,183,'pants/2820.jpg',2,4,NULL),(2855,NULL,140,3,8,61,82,2,124,'pants/2832.jpg',0,5,NULL),(2856,NULL,185,3,10,82,60,2,167,'pants/2835.jpg',NULL,4,NULL),(2857,4,100,2,36,19,19,2,85,'',0,3.578,1);
/*!40000 ALTER TABLE `pants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pants_kind`
--

DROP TABLE IF EXISTS `pants_kind`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pants_kind` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pants_kind`
--

LOCK TABLES `pants_kind` WRITE;
/*!40000 ALTER TABLE `pants_kind` DISABLE KEYS */;
INSERT INTO `pants_kind` VALUES (1,'Прямоугольный'),(2,'Окружность'),(3,'Фигурный');
/*!40000 ALTER TABLE `pants_kind` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paper_warehouse`
--

DROP TABLE IF EXISTS `paper_warehouse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paper_warehouse` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_of_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `material_id` int NOT NULL,
  `length` int NOT NULL,
  `width` int NOT NULL,
  `shelf_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `material_id` (`material_id`),
  KEY `papw_shelf_id_fk` (`shelf_id`),
  CONSTRAINT `papw_material_id_fk` FOREIGN KEY (`material_id`) REFERENCES `material` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `papw_shelf_id_fk` FOREIGN KEY (`shelf_id`) REFERENCES `shelf` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paper_warehouse`
--

LOCK TABLES `paper_warehouse` WRITE;
/*!40000 ALTER TABLE `paper_warehouse` DISABLE KEYS */;
INSERT INTO `paper_warehouse` VALUES (1,'2022-07-15 13:20:55',1,250,200,5),(2,'2022-07-15 13:20:55',2,0,100,5),(3,'2022-07-15 13:20:55',3,500,300,5),(4,'2022-07-15 13:20:55',3,1000,300,5),(5,'2022-07-15 13:20:55',2,1000,100,5),(6,'2022-07-15 13:20:55',1,1000,300,5),(7,'2022-07-29 15:39:25',1,1920,160,5),(8,'2022-07-29 15:39:25',1,1930,245,5),(9,'2022-07-29 15:39:25',1,1930,245,5),(10,'2022-07-29 15:39:25',1,945,160,5),(11,'2022-07-29 15:39:25',1,200,160,5),(12,'2022-07-29 15:39:25',1,1950,160,5),(13,'2022-07-29 15:39:25',1,1950,245,5),(14,'2022-07-29 15:39:25',1,1950,245,5),(15,'2022-07-29 15:39:25',7,7000,245,5),(16,'2022-07-29 15:39:25',1,2000,245,5),(17,'2022-07-29 15:40:47',1,1920,200,5),(18,'2022-07-29 15:40:47',1,1920,200,5),(19,'2022-07-29 15:40:47',1,1945,200,5),(20,'2022-07-29 15:40:47',1,1945,200,5),(21,'2022-07-29 15:40:47',1,1950,200,5),(22,'2022-07-29 15:40:47',1,1950,200,5),(23,'2022-07-29 15:40:47',1,1950,200,5),(24,'2022-07-29 15:40:47',1,1950,200,5),(25,'2022-07-29 15:40:47',1,1950,200,5),(26,'2022-07-29 15:40:47',1,1950,200,5),(27,'2022-07-29 15:40:47',1,1980,200,5),(28,'2022-07-29 15:41:54',1,1920,255,5),(29,'2022-07-29 15:41:54',1,1920,255,5),(30,'2022-07-29 15:41:54',1,1945,255,5),(31,'2022-07-29 15:41:54',1,1945,255,5),(32,'2022-07-29 15:41:54',1,1950,255,5),(33,'2022-07-29 15:41:54',1,1950,255,5),(34,'2022-07-29 15:41:54',1,1950,255,5),(35,'2022-07-29 15:41:54',1,1950,255,5),(36,'2022-07-29 15:42:07',1,1930,180,5),(37,'2022-07-29 15:42:07',1,1930,180,5),(38,'2022-07-29 15:42:07',1,1950,180,5),(39,'2022-07-29 15:42:07',1,1950,180,5),(40,'2022-07-29 15:42:07',1,1950,180,5),(41,'2022-07-29 15:42:07',1,1950,180,5),(42,'2022-07-29 15:42:07',1,1950,180,5),(43,'2022-07-29 15:42:07',1,1980,180,5),(44,'2022-07-29 15:42:07',1,2000,180,5),(45,'2022-07-29 15:42:07',1,2000,180,5),(46,'2022-07-29 15:42:07',1,2000,180,5),(47,'2022-07-29 15:42:15',1,1930,220,5),(48,'2022-07-29 15:42:15',1,1950,220,5),(49,'2022-07-29 15:42:15',1,1950,220,5),(50,'2022-07-29 15:42:15',1,1950,220,5),(51,'2022-07-29 15:42:15',1,1950,220,5),(52,'2022-07-29 15:42:15',1,1950,230,5),(53,'2022-07-29 15:42:15',1,2000,220,5),(54,'2022-07-29 15:42:15',1,2000,220,5),(55,'2022-07-29 15:42:15',1,2000,220,5),(56,'2022-07-29 15:42:15',1,2000,220,5),(57,'2022-07-29 15:42:23',1,1950,230,5),(58,'2022-07-29 15:42:23',1,1950,230,5),(59,'2022-07-29 15:42:23',1,1950,230,5),(60,'2022-07-29 15:42:23',1,1950,230,5),(61,'2022-07-29 15:42:23',1,1950,230,5),(62,'2022-07-29 15:42:23',1,1950,230,5),(63,'2022-07-29 15:42:23',1,1980,230,5),(64,'2022-07-29 15:42:23',1,1980,230,5),(65,'2022-07-29 15:42:23',1,1980,230,5),(66,'2022-07-29 15:42:23',1,980,230,5),(67,'2022-07-29 15:43:25',2,1950,170,5),(68,'2022-07-29 15:59:11',5,1950,180,5),(69,'2022-08-01 10:38:17',5,1950,180,5),(70,'2022-08-01 10:38:17',5,1950,180,5),(71,'2022-08-01 10:38:17',5,1950,180,5),(72,'2022-08-01 10:38:17',5,1950,180,5),(73,'2022-08-01 10:38:17',5,1950,200,5),(74,'2022-08-01 10:38:17',5,1950,260,5),(75,'2022-08-01 10:38:17',5,1980,180,5),(76,'2022-08-01 10:38:17',5,2000,180,5),(77,'2022-08-01 10:38:27',5,1966,200,5),(78,'2022-08-01 10:38:27',5,1966,200,5),(79,'2022-08-01 10:38:27',5,1966,200,5),(80,'2022-08-01 10:38:27',5,1966,200,5),(81,'2022-08-01 10:38:27',5,1966,200,5),(82,'2022-08-01 10:38:27',5,1966,200,5),(83,'2022-08-01 10:38:27',5,1980,200,5),(84,'2022-08-01 10:38:27',5,1980,200,5),(85,'2022-08-01 10:38:27',5,1980,200,5),(86,'2022-08-01 10:38:27',5,2000,200,5),(87,'2022-08-01 10:38:37',5,1966,110,5),(88,'2022-08-01 10:38:37',5,1966,220,5),(89,'2022-08-01 10:38:37',5,1980,165,5),(90,'2022-08-01 10:38:37',5,1980,165,5),(91,'2022-08-01 10:38:37',5,1980,220,5),(92,'2022-08-01 10:38:37',5,2000,110,5),(93,'2022-08-01 10:38:37',5,2000,165,5),(94,'2022-08-01 10:38:37',5,2000,165,5),(95,'2022-08-01 10:38:37',5,2000,220,5),(96,'2022-08-01 10:38:37',5,2000,220,5),(97,'2022-08-01 10:38:45',5,1980,200,5),(98,'2022-08-01 10:38:46',5,2000,200,5),(99,'2022-08-01 10:38:46',5,2000,200,5),(100,'2022-08-01 10:38:46',5,2000,200,5),(101,'2022-08-01 10:38:46',5,2000,200,5),(102,'2022-08-01 10:38:46',5,2000,200,5),(103,'2022-08-01 10:38:46',5,2000,200,5),(104,'2022-08-01 10:38:46',5,500,200,5),(105,'2022-08-01 10:38:46',5,0,200,5),(106,'2022-08-01 10:38:46',5,0,200,5),(107,'2022-08-15 15:36:37',5,500,100,5),(108,'2022-08-15 15:36:37',5,0,100,5),(109,'2022-08-15 15:44:39',5,100,60,5),(110,'2022-08-15 15:44:39',5,500,60,5),(111,'2022-08-15 15:48:18',5,9900,100,5),(112,'2022-08-15 15:48:18',5,2000,100,5),(113,'2022-08-15 15:49:59',5,50,50,5),(114,'2022-08-15 15:49:59',5,10000,50,5),(115,'2022-08-15 15:52:04',5,20000,25,5),(116,'2022-08-15 15:52:04',5,20000,25,5);
/*!40000 ALTER TABLE `paper_warehouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photo_output`
--

DROP TABLE IF EXISTS `photo_output`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `photo_output` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photo_output`
--

LOCK TABLES `photo_output` WRITE;
/*!40000 ALTER TABLE `photo_output` DISABLE KEYS */;
INSERT INTO `photo_output` VALUES (1,'Kodak'),(2,'LaserGraver');
/*!40000 ALTER TABLE `photo_output` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `polymer`
--

DROP TABLE IF EXISTS `polymer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `polymer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `polymer`
--

LOCK TABLES `polymer` WRITE;
/*!40000 ALTER TABLE `polymer` DISABLE KEYS */;
INSERT INTO `polymer` VALUES (1,'ACE'),(2,'ACT'),(3,'FAH'),(4,'Nilpeter');
/*!40000 ALTER TABLE `polymer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `polymer_kind`
--

DROP TABLE IF EXISTS `polymer_kind`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `polymer_kind` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `polymer_kind`
--

LOCK TABLES `polymer_kind` WRITE;
/*!40000 ALTER TABLE `polymer_kind` DISABLE KEYS */;
INSERT INTO `polymer_kind` VALUES (1,'1,14'),(2,'1,7');
/*!40000 ALTER TABLE `polymer_kind` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rack`
--

DROP TABLE IF EXISTS `rack`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rack` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID стеллажа',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'Описание',
  `warehouse_id` int DEFAULT NULL COMMENT 'Склад',
  PRIMARY KEY (`id`),
  KEY `rack_warehouse_id_fk` (`warehouse_id`),
  CONSTRAINT `rack_warehouse_id_fk` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouse` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rack`
--

LOCK TABLES `rack` WRITE;
/*!40000 ALTER TABLE `rack` DISABLE KEYS */;
INSERT INTO `rack` VALUES (1,'Gallus',1),(2,'G340',2),(3,'Лаборатория 1',6),(4,'Стеллаж теплый склад 1',3),(5,'ЛКМ 340 1',4);
/*!40000 ALTER TABLE `rack` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `region`
--

DROP TABLE IF EXISTS `region`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `region` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subject_id` (`subject_id`),
  CONSTRAINT `region_subject_id_fk` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `region`
--

LOCK TABLES `region` WRITE;
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
INSERT INTO `region` VALUES (1,1,'Альметьевский район'),(2,1,'Сармановский район'),(3,1,'Заинский район');
/*!40000 ALTER TABLE `region` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `session` (
  `id` char(40) NOT NULL,
  `expire` int DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session`
--

LOCK TABLES `session` WRITE;
/*!40000 ALTER TABLE `session` DISABLE KEYS */;
INSERT INTO `session` VALUES ('78m2fp2h8hkgsk3ql5hd11qufit3o85n',1661866065,_binary '__flash|a:0:{}__returnUrl|s:42:\"http://pet/web/index.php?r=cms%2Fcms-panel\";__id|i:1;__authKey|s:35:\"LLaK_ws5ngfhJghkgjkgOTCbT_qEd5NRdiI\";'),('lr7dtfck6juf63kqdp70b80pteec93sa',1661851324,_binary '__flash|a:0:{}__returnUrl|s:47:\"http://pet/web/index.php?r=shipment%2Fview&id=2\";');
/*!40000 ALTER TABLE `session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shaft`
--

DROP TABLE IF EXISTS `shaft`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shaft` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` double NOT NULL COMMENT 'длина,мм',
  `polymer_kind_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shaft_polymer_kind_id_fk` (`polymer_kind_id`),
  CONSTRAINT `shaft_polymer_kind_id_fk` FOREIGN KEY (`polymer_kind_id`) REFERENCES `polymer_kind` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shaft`
--

LOCK TABLES `shaft` WRITE;
/*!40000 ALTER TABLE `shaft` DISABLE KEYS */;
INSERT INTO `shaft` VALUES (1,430,2),(2,425.45,2),(3,403.225,1),(4,203.2,2),(5,254,1),(6,279.4,2);
/*!40000 ALTER TABLE `shaft` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shelf`
--

DROP TABLE IF EXISTS `shelf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shelf` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `rack_id` int NOT NULL COMMENT 'Стеллаж',
  PRIMARY KEY (`id`),
  KEY `shelf_rack_id_fk` (`rack_id`),
  CONSTRAINT `shelf_rack_id_fk` FOREIGN KEY (`rack_id`) REFERENCES `rack` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shelf`
--

LOCK TABLES `shelf` WRITE;
/*!40000 ALTER TABLE `shelf` DISABLE KEYS */;
INSERT INTO `shelf` VALUES (2,1),(1,2),(3,3),(4,3),(5,4),(6,5);
/*!40000 ALTER TABLE `shelf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipment`
--

DROP TABLE IF EXISTS `shipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shipment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `manager_id` int NOT NULL,
  `date_of_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_of_close` datetime DEFAULT NULL,
  `date_of_send` datetime DEFAULT NULL,
  `status_id` int NOT NULL DEFAULT '0',
  `transport_id` int DEFAULT NULL,
  `gasoline_cost` double DEFAULT NULL,
  `cost` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shipment_manager_id_fk` (`manager_id`),
  KEY `shipment_transport_id_fk` (`transport_id`),
  CONSTRAINT `shipment_manager_id_fk` FOREIGN KEY (`manager_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `shipment_transport_id_fk` FOREIGN KEY (`transport_id`) REFERENCES `transport` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipment`
--

LOCK TABLES `shipment` WRITE;
/*!40000 ALTER TABLE `shipment` DISABLE KEYS */;
INSERT INTO `shipment` VALUES (9,3,'2022-09-07 21:42:16',NULL,'2022-09-20 00:00:00',0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `shipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipment_order`
--

DROP TABLE IF EXISTS `shipment_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shipment_order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `shipment_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`),
  KEY `shipment_order_shipment_id_fk` (`shipment_id`),
  CONSTRAINT `shipment_order_order_id_fk` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `shipment_order_shipment_id_fk` FOREIGN KEY (`shipment_id`) REFERENCES `shipment` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipment_order`
--

LOCK TABLES `shipment_order` WRITE;
/*!40000 ALTER TABLE `shipment_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `shipment_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sleeve`
--

DROP TABLE IF EXISTS `sleeve`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sleeve` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sleeve`
--

LOCK TABLES `sleeve` WRITE;
/*!40000 ALTER TABLE `sleeve` DISABLE KEYS */;
INSERT INTO `sleeve` VALUES (1,'40'),(2,'76'),(3,'45'),(4,'Любая'),(5,'85');
/*!40000 ALTER TABLE `sleeve` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `street`
--

DROP TABLE IF EXISTS `street`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `street` (
  `id` int NOT NULL AUTO_INCREMENT,
  `town_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `town_id` (`town_id`),
  CONSTRAINT `street_town_id_fk` FOREIGN KEY (`town_id`) REFERENCES `town` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `street`
--

LOCK TABLES `street` WRITE;
/*!40000 ALTER TABLE `street` DISABLE KEYS */;
INSERT INTO `street` VALUES (1,1,'Ленина'),(2,1,'Бигаш'),(4,2,'Ленина'),(5,1,'Белоглазова'),(6,4,'Ленина'),(7,1,'Шевченко');
/*!40000 ALTER TABLE `street` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subject` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject`
--

LOCK TABLES `subject` WRITE;
/*!40000 ALTER TABLE `subject` DISABLE KEYS */;
INSERT INTO `subject` VALUES (1,'Республика Татарстан'),(2,'Республика Башкортостан'),(25,'Белгородская область'),(26,'Брянская область'),(27,'Владимирская область'),(28,'Воронежская область'),(29,'Ивановская область'),(30,'Калужская область'),(31,'Костромская область'),(32,'Курская область'),(33,'Липецкая область'),(34,'Московская область'),(35,'Орловская область'),(36,'Рязанская область'),(37,'Смоленская область'),(38,'Тамбовская область'),(39,'Тверская область'),(40,'Тульская область'),(41,'Ярославская область'),(42,'Республика Карелия'),(43,'Республика Коми'),(44,'Архангельская область'),(45,'Вологодская область'),(46,'Калининградская область'),(47,'Ленинградская область'),(48,'Мурманская область'),(49,'Новгородская область'),(50,'Псковская область'),(51,'Республика Адыгея'),(52,'Республика Калмыкия'),(53,'Республика Крым'),(54,'Краснодарский край'),(55,'Астраханская область'),(56,'Волгоградская область'),(57,'Ростовская область'),(58,'Республика Дагестан'),(59,'Республика Ингушетия'),(60,'Кабардино-Балкарская Республика'),(61,'Карачаево-Черкесская Республика'),(62,'Республика Северная Осетия-Алания'),(63,'Чеченская Республика'),(64,'Ставропольский край'),(65,'Республика Марий Эл'),(66,'Республика Мордовия'),(67,'Удмуртская Республика'),(68,'Чувашская Республика'),(69,'Пермский край'),(70,'Кировская область'),(71,'Нижегородская область'),(72,'Оренбургская область'),(73,'Пензенская область'),(74,'Самарская область'),(75,'Саратовская область'),(76,'Ульяновская область'),(77,'Курганская область'),(78,'Свердловская область'),(79,'Тюменская область'),(80,'Челябинская область'),(81,'Республика Алтай'),(82,'Республика Бурятия'),(83,'Республика Тыва'),(84,'Республика Хакасия'),(85,'Алтайский край'),(86,'Забайкальский край'),(87,'Красноярский край'),(88,'Иркутская область'),(89,'Кемеровская область'),(90,'Новосибирская область'),(91,'Омская область'),(92,'Томская область'),(93,'Республика Саха (Якутия)'),(94,'Камчатский край'),(95,'Приморский край'),(96,'Хабаровский край'),(97,'Амурская область'),(98,'Магаданская область'),(99,'Сахалинская область'),(100,'Еврейская автономная область'),(101,'Чукотский автономный округ'),(102,'Республика Крым');
/*!40000 ALTER TABLE `subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `time_tracker`
--

DROP TABLE IF EXISTS `time_tracker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `time_tracker` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` int DEFAULT NULL,
  `date_of_action` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tt_employee_id` (`employee_id`),
  CONSTRAINT `tt_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `time_tracker`
--

LOCK TABLES `time_tracker` WRITE;
/*!40000 ALTER TABLE `time_tracker` DISABLE KEYS */;
INSERT INTO `time_tracker` VALUES (1,6,'2022-09-07 04:30:53'),(2,6,'2022-09-07 14:30:53');
/*!40000 ALTER TABLE `time_tracker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `town`
--

DROP TABLE IF EXISTS `town`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `town` (
  `id` int NOT NULL AUTO_INCREMENT,
  `region_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `region_id` (`region_id`),
  CONSTRAINT `town_region_id_fk` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `town`
--

LOCK TABLES `town` WRITE;
/*!40000 ALTER TABLE `town` DISABLE KEYS */;
INSERT INTO `town` VALUES (1,1,'г.Альметьевск'),(2,2,'пгт Джалиль'),(3,1,'Мактама'),(4,2,'пгт. Сарманово');
/*!40000 ALTER TABLE `town` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transport`
--

DROP TABLE IF EXISTS `transport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transport` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `car_number` varchar(50) NOT NULL,
  `load_capacity` double NOT NULL,
  `subscribe` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transport`
--

LOCK TABLES `transport` WRITE;
/*!40000 ALTER TABLE `transport` DISABLE KEYS */;
INSERT INTO `transport` VALUES (1,'Opel Vivaro','H200HE',1200,''),(2,'Ситроен Jumper','н300нт',2500,'Динмухаметов Марат - 8-917-927-66-01');
/*!40000 ALTER TABLE `transport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `upload_paper`
--

DROP TABLE IF EXISTS `upload_paper`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `upload_paper` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pallet_id` varchar(100) NOT NULL,
  `width` int NOT NULL,
  `length` int NOT NULL,
  `material_id_from_provider` int NOT NULL,
  `roll_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upload_paper`
--

LOCK TABLES `upload_paper` WRITE;
/*!40000 ALTER TABLE `upload_paper` DISABLE KEYS */;
/*!40000 ALTER TABLE `upload_paper` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `authKey` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `accessToken` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `F` varchar(100) NOT NULL,
  `I` varchar(100) NOT NULL,
  `O` varchar(100) NOT NULL,
  `status_id` int NOT NULL DEFAULT '0' COMMENT 'Статус уволен 1 /не уволен 0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','$2y$13$sYciWiCA.iW8ef0vkGBNHeTL/ec1BgkS/XGZ0xrGb1YryHeOp9RM2','LLaK_ws5ngfhJghkgjkgOTCbT_qEd5NRdiI',NULL,'Фатхуллин','Фаниль','Радикович',0),(2,'Alex','$2y$13$Lc3Qi9AWT9c0MVFHxhmAi.5ArsCV1CbFe5C.QgNTURvWFQxxhg6Zu','LLaK_ws5ngfhJYiGrOTCbT_qEd5NRdiI',NULL,'Агапов','Алексей','Николаевич',0),(3,'Jura','$2y$13$D410Hcm2rRm53hXnZKgv0Olb1hrwJIzmN1infxP7oPgt2SQuupMdm','oPaoqPTqE_oGp0fbR41CKRUb2Jvbymhz',NULL,'Фадеев','Юрий','Вячеславович',0),(4,'Hamida','$2y$13$TljIEVtauf/CVQ6Q55M.DOLBaQdDIcVqsjY0ISvjpnHw1Hg9mwff2','ivGAurB77mwNpoZXk18rNoZM2Ec8k-Bj',NULL,'Салахова','Хамида','Шавкатовна',0),(5,'Marat','$2y$13$OJARGdJRPKNEuLDW0Hk7oOd7FZdFURVJLRb/LzVJL8MRt2HsYo9.K','x7AVo2CQ4WVrF-vac4VWRKAl6KP2m4Ki',NULL,'Мухаметшин','Марат','Марат',0),(6,'Masha','$2y$13$mWyVhEWHyFmyD09hx4fht.XVL7vnXf49i.M1w1hI6Qg8tB88/1Iq2','OYZb8s4Y72E0Ic51_xJK0n7mOhtEgtOM',NULL,'Кожевникова','Мария','Николаевна',0),(7,'Sveta','$2y$13$sWhDmXYrlBmloT/5AKRoz.6SRDnBS1miBwxB.Q4sA2qW1Lbe7nUR2','UGi2IhUW0OsHBWrSVO2VXrfbXvKLSD3Z',NULL,'Герасимова','Светлана','Николаевна',0),(8,'Natasha','$2y$13$sOvJalKsrLOShjpPzuhOaOiil/2p6SvvgOm8/IGg9LgNuXzJKAnTK','nLeBz6aIZw1B-1d-GmGlt89KzkjgUPuZ',NULL,'Львова','Наталья','Петровна',0),(9,'Ivan','$2y$13$ujcvUPl6ZxYFFv0mXbirL.DGHtA1U2ARb0QiXvGkkqAwSYkbvw/G.','j0iqnxzLlMfuEhCVOsoNrkM5j4cV-8Rj',NULL,'Карпунин','Иван','Иванович',0),(10,'Maksim','$2y$13$9w0UTQ6DyimnUHtFYSJG7O9B5NaXRVadAjcxcWyRqlqe9.oiXTA82','-MXZGMDlci0b36BNNXJFzuYqJZPqPX7H',NULL,'Прокаев','Максим','Максимович',0),(11,'Ilnur','$2y$13$0WtVJcWvDORp5DuFSaj.huXInxyU8g9xdi5.qrhyaW5l6alqs9MHG','FT9XcyQYc9yRzBZ0ZTZXfnSmybr7Qvfg',NULL,'Мугинов','Ильнур','Ильнурович',0),(12,'Albert','$2y$13$FOuMRfkRg5ylZscpGvkwWOPqlhkATasJopWfSZ/DrWE7s4JlmNcSy','DmjuQW_isoqc7JBQWUXV6WkwJZ8qmyHm',NULL,'Миннегалиев','Альберт','Альбертович',0),(13,'Rustam','$2y$13$3mVn6e0V9GQTM0dGXTqc1erPrpx7JVavW62EXyB.d9JAWO6mNH8KO','8OrU4h1EJa6T-p8uuDmWpXq7zHNlrdkV',NULL,'Сабирзянов','Рустам','Рустамович',0),(14,'Mariam','$2y$13$Yx5sbmEZZPKHVbQof5CUbuG1stz9nJIP07sTAVXlPJWo33Yyawdye','Nk6DngDvZoAy9eb7EgK1C2sEV7lhnEsf',NULL,'Сафиуллина','Марьям','Максумовна',0),(15,'Linar','$2y$13$nmnBq.ra4iMzlhHCBOJ0b.m70v6I6nAiPUbyh13yebmIbeYBTYN.W','umz8zv_D89Dm8dmc4KmVxVsYD85UGQkN',NULL,'Гарифуллин','Линар','Линарович',0),(16,'Artuhin','$2y$13$jFWYdDxWh2cciJTQaRY8BeRj7RYPYxUSFiSSGvoMYzPczuqGTG1Hq','l_TkKrFa_SQeCt5_F_7e6pLcxZiymRP0',NULL,'Артюхин','Александр','Георгиевич',0),(17,'ArturKa','$2y$13$Dy8WqdsHXaivqI9QpkplnOvX0M1gWxIUar7890Ex0TWA7L/Wys.qS','YmP5jkHGFWSV4mlFCepT4zgYv6bz5MKm',NULL,'Камалтдинов','Артур','Артурович',0),(19,'Artur','$2y$13$Bg2UAO6it6iUqysZhH6ctOsyZSjL1jBH0Fe7FKQHUQXpfyWo/Db2u','py6BBYyKqZb2Rusm1woSbkms0wZNhePf',NULL,'Лаховой','Артур','Артурович',0),(20,'Albina','$2y$13$tXiuongZU.vcTzSzJvbU3OL6nEMtruWGKjhho9AYgLU8azY0nCco2','nyV-NgW0CMZ97TlSHOmtv__Qa9FhEyUe',NULL,'Саетгараева','Альбина','Альбина',0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `varnish_status`
--

DROP TABLE IF EXISTS `varnish_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `varnish_status` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `varnish_status`
--

LOCK TABLES `varnish_status` WRITE;
/*!40000 ALTER TABLE `varnish_status` DISABLE KEYS */;
INSERT INTO `varnish_status` VALUES (0,'Без лака'),(1,'Матовый лак'),(2,'Глянцевый лак'),(3,'Матовый/Глянцевый лак');
/*!40000 ALTER TABLE `varnish_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warehouse`
--

DROP TABLE IF EXISTS `warehouse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `warehouse` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Наименование',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warehouse`
--

LOCK TABLES `warehouse` WRITE;
/*!40000 ALTER TABLE `warehouse` DISABLE KEYS */;
INSERT INTO `warehouse` VALUES (1,'Склад бумаги Gallus'),(2,'Склад бумаги Gallus340'),(3,'Теплый склад'),(4,'Склад ЛКМ Gallus340'),(5,'Склад ЛКМ Gallus'),(6,'Склад готовых форм лаборатория');
/*!40000 ALTER TABLE `warehouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `winding`
--

DROP TABLE IF EXISTS `winding`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `winding` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `winding`
--

LOCK TABLES `winding` WRITE;
/*!40000 ALTER TABLE `winding` DISABLE KEYS */;
INSERT INTO `winding` VALUES (1,'Намотка 1','/web/winding_order/s1.jpg'),(2,'Намотка2','/web/winding_order/s2.jpg'),(3,'Намотка3','/web/winding_order/s3.jpg'),(4,'Намотка4','/web/winding_order/s4.jpg'),(5,'Намотка5','/web/winding_order/s5.jpg'),(6,'Намотка6','/web/winding_order/s6.jpg'),(7,'Намотка7','/web/winding_order/s7.jpg'),(8,'Намотка8','/web/winding_order/s8.jpg');
/*!40000 ALTER TABLE `winding` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-15 10:18:59

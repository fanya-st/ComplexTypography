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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paper_warehouse`
--

LOCK TABLES `paper_warehouse` WRITE;
/*!40000 ALTER TABLE `paper_warehouse` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `polymer`
--

LOCK TABLES `polymer` WRITE;
/*!40000 ALTER TABLE `polymer` DISABLE KEYS */;
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
INSERT INTO `user` VALUES (1,'admin','$2y$13$sYciWiCA.iW8ef0vkGBNHeTL/ec1BgkS/XGZ0xrGb1YryHeOp9RM2','LLaK_ws5ngfhJghkgjkgOTCbT_qEd5NRdiI',NULL,'admin','admin','admin',0);
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

-- Dump completed on 2022-09-16 16:25:19

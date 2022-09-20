-- SQLINES DEMO ***  Distrib 8.0.24, for Win64 (x86_64)
--
-- SQLINES DEMO ***   Database: pet_db
-- SQLINES DEMO *** -------------------------------------
-- SQLINES DEMO *** 0.24

/* SQLINES DEMO *** ARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/* SQLINES DEMO *** ARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/* SQLINES DEMO *** LLATION_CONNECTION=@@COLLATION_CONNECTION */;
/* SQLINES DEMO *** tf8mb4 */;
/* SQLINES DEMO *** ME_ZONE=@@TIME_ZONE */;
/* SQLINES DEMO *** NE='+00:00' */;
/* SQLINES DEMO *** IQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/* SQLINES DEMO *** REIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/* SQLINES DEMO *** L_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/* SQLINES DEMO *** L_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- SQLINES DEMO *** or table `auth_assignment`
--

DROP TABLE IF EXISTS auth_assignment;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE auth_assignment (
                                 item_name varchar(64) NOT NULL,
                                 user_id varchar(64) NOT NULL,
                                 created_at int DEFAULT NULL,
                                 PRIMARY KEY (item_name,user_id)
    ,
                                 CONSTRAINT auth_assignment_ibfk_1 FOREIGN KEY (item_name) REFERENCES auth_item (name) ON DELETE CASCADE ON UPDATE CASCADE
)  ;

CREATE INDEX idx-auth_assignment-user_id ON auth_assignment (user_id);
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `auth_assignment`
--

LOCK TABLES auth_assignment WRITE;
/* SQLINES DEMO ***  `auth_assignment` DISABLE KEYS */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO auth_assignment VALUES ('admin','1',1661928026);
/* SQLINES DEMO ***  `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `auth_item`
--

DROP TABLE IF EXISTS auth_item;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE auth_item (
                           name varchar(64) NOT NULL,
                           type smallint NOT NULL,
                           description text,
                           rule_name varchar(64) DEFAULT NULL,
                           data bytea,
                           created_at int DEFAULT NULL,
                           updated_at int DEFAULT NULL,
                           PRIMARY KEY (name)
    ,
                           CONSTRAINT auth_item_ibfk_1 FOREIGN KEY (rule_name) REFERENCES auth_rule (name) ON DELETE SET NULL ON UPDATE CASCADE
)  ;

CREATE INDEX rule_name ON auth_item (rule_name);
CREATE INDEX idx-auth_item-type ON auth_item (type);
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `auth_item`
--

LOCK TABLES auth_item WRITE;
/* SQLINES DEMO ***  `auth_item` DISABLE KEYS */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO auth_item VALUES ('accountant',1,'Бухгалтер',NULL,NULL,1661928026,1661928026),('admin',1,'Администратор',NULL,NULL,1661928026,1661928026),('designer',1,'Дизайнер',NULL,NULL,1661928026,1661928026),('designer_admin',1,'Начальник отдела дизайна',NULL,NULL,1661928026,1661928026),('designReadyLabel',2,'Отметка о дизайн готов',NULL,NULL,1661928026,1661928026),('designReadyOwnLabel',2,'Редактирование своего ресурса(дизайнер)','isDesigner',NULL,1661928026,1661928026),('driver',1,'Водитель',NULL,NULL,1661928026,1661928026),('laboratory',1,'Лаборант',NULL,NULL,1661928026,1661928026),('logistician',1,'Логист',NULL,NULL,1661928026,1661928026),('manager',1,'Менеджер',NULL,NULL,1661928026,1661928026),('manager_admin',1,'Начальник отдела продаж',NULL,NULL,1661928026,1661928026),('packer',1,'Упаковщик',NULL,NULL,1661928026,1661928026),('prepress',1,'Допечатник',NULL,NULL,1661928026,1661928026),('printer',1,'Печатник',NULL,NULL,1661928026,1661928026),('rewinder',1,'Перемотчик',NULL,NULL,1661928026,1661928026),('technolog',1,'Технолог',NULL,NULL,1661928026,1661928026),('updateByOwnerManager',2,'Редактирование своего ресурса(менеджер)','isManager',NULL,1661928026,1661928026),('updateCustomer',2,'Редактирование заказчика',NULL,NULL,1661928026,1661928026),('updateLabel',2,'Редактирование этикетки',NULL,NULL,1661928026,1661928026),('updateOrder',2,'Редактирование заказа',NULL,NULL,1661928026,1661928026),('updateShipment',2,'Редактирование отгрузки',NULL,NULL,1661928026,1661928026),('warehouse_manager',1,'Заведующий складом',NULL,NULL,1661928026,1661928026);
/* SQLINES DEMO ***  `auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `auth_item_child`
--

DROP TABLE IF EXISTS auth_item_child;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE auth_item_child (
                                 parent varchar(64) NOT NULL,
                                 child varchar(64) NOT NULL,
                                 PRIMARY KEY (parent,child)
    ,
                                 CONSTRAINT auth_item_child_ibfk_1 FOREIGN KEY (parent) REFERENCES auth_item (name) ON DELETE CASCADE ON UPDATE CASCADE,
                                 CONSTRAINT auth_item_child_ibfk_2 FOREIGN KEY (child) REFERENCES auth_item (name) ON DELETE CASCADE ON UPDATE CASCADE
)  ;

CREATE INDEX child ON auth_item_child (child);
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `auth_item_child`
--

LOCK TABLES auth_item_child WRITE;
/* SQLINES DEMO ***  `auth_item_child` DISABLE KEYS */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO auth_item_child VALUES ('admin','accountant'),('admin','designer'),('designer_admin','designer'),('admin','designer_admin'),('designer','designReadyLabel'),('designer_admin','designReadyLabel'),('designReadyOwnLabel','designReadyLabel'),('admin','driver'),('admin','laboratory'),('admin','logistician'),('admin','manager'),('manager_admin','manager'),('admin','manager_admin'),('admin','packer'),('designer_admin','prepress'),('admin','printer'),('admin','rewinder'),('admin','technolog'),('manager','updateByOwnerManager'),('manager_admin','updateCustomer'),('updateByOwnerManager','updateCustomer'),('manager_admin','updateLabel'),('updateByOwnerManager','updateLabel'),('manager_admin','updateOrder'),('updateByOwnerManager','updateOrder'),('manager_admin','updateShipment'),('updateByOwnerManager','updateShipment'),('admin','warehouse_manager');
/* SQLINES DEMO ***  `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `auth_rule`
--

DROP TABLE IF EXISTS auth_rule;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE auth_rule (
                           name varchar(64) NOT NULL,
                           data bytea,
                           created_at int DEFAULT NULL,
                           updated_at int DEFAULT NULL,
                           PRIMARY KEY (name)
)  ;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `auth_rule`
--

LOCK TABLES auth_rule WRITE;
/* SQLINES DEMO ***  `auth_rule` DISABLE KEYS */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO auth_rule VALUES ('isDesigner',_binary 'O:21:"apprbacDesignerRule":3:{s:4:"name";s:10:"isDesigner";s:9:"createdAt";i:1661928026;s:9:"updatedAt";i:1661928026;}',1661928026,1661928026),('isManager',_binary 'O:20:"apprbacManagerRule":3:{s:4:"name";s:9:"isManager";s:9:"createdAt";i:1661928026;s:9:"updatedAt";i:1661928026;}',1661928026,1661928026);
/* SQLINES DEMO ***  `auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `background_label`
--

DROP TABLE IF EXISTS background_label;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE background_label_seq;

CREATE TABLE background_label (
                                  id int NOT NULL DEFAULT NEXTVAL ('background_label_seq'),
                                  name varchar(50) NOT NULL,
                                  PRIMARY KEY (id)
)   ;

ALTER SEQUENCE background_label_seq RESTART WITH 5;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `background_label`
--

LOCK TABLES background_label WRITE;
/* SQLINES DEMO ***  `background_label` DISABLE KEYS */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO background_label VALUES (1,'белый'),(2,'металлизированный серебро'),(3,'металлизированный золото'),(4,'прозрачный');
/* SQLINES DEMO ***  `background_label` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `bank_transfer`
--

DROP TABLE IF EXISTS bank_transfer;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE bank_transfer_seq;

CREATE TABLE bank_transfer (
                               id int NOT NULL DEFAULT NEXTVAL ('bank_transfer_seq'),
                               date_of_create timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
                               customer_id int NOT NULL,
                               date date NOT NULL,
                               sum double precision NOT NULL,
                               PRIMARY KEY (id)
    ,
                               CONSTRAINT customer_if_dk FOREIGN KEY (customer_id) REFERENCES customer (id)
)   ;

ALTER SEQUENCE bank_transfer_seq RESTART WITH 5;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX customer_if_dk ON bank_transfer (customer_id);

--
-- SQLINES DEMO *** table `bank_transfer`
--

LOCK TABLES bank_transfer WRITE;
/* SQLINES DEMO ***  `bank_transfer` DISABLE KEYS */;
/* SQLINES DEMO ***  `bank_transfer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `business_trip_employee`
--

DROP TABLE IF EXISTS business_trip_employee;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE business_trip_employee_seq;

CREATE TABLE business_trip_employee (
                                        id int NOT NULL DEFAULT NEXTVAL ('business_trip_employee_seq') ,
                                        date_of_begin timestamp(0) NOT NULL ,
                                        date_of_end timestamp(0) DEFAULT NULL ,
                                        gasoline_cost double precision DEFAULT NULL ,
                                        cost double precision DEFAULT NULL ,
                                        transport_id int NOT NULL ,
                                        user_id int NOT NULL,
                                        customer_id int DEFAULT NULL,
                                        status_id int NOT NULL DEFAULT '1' ,
                                        comment text,
                                        PRIMARY KEY (id)
    ,
                                        CONSTRAINT transport_id_fk FOREIGN KEY (transport_id) REFERENCES transport (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                                        CONSTRAINT trip_customer_id FOREIGN KEY (customer_id) REFERENCES customer (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                                        CONSTRAINT user_id_fk FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE business_trip_employee_seq RESTART WITH 7;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX transport_id_fk ON business_trip_employee (transport_id);
CREATE INDEX user_id ON business_trip_employee (user_id);
CREATE INDEX customer_id ON business_trip_employee (customer_id);

--
-- SQLINES DEMO *** table `business_trip_employee`
--

LOCK TABLES business_trip_employee WRITE;
/* SQLINES DEMO ***  `business_trip_employee` DISABLE KEYS */;
/* SQLINES DEMO ***  `business_trip_employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `calc_common_param`
--

DROP TABLE IF EXISTS calc_common_param;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE calc_common_param_seq;

CREATE TABLE calc_common_param (
                                   id int NOT NULL DEFAULT NEXTVAL ('calc_common_param_seq'),
                                   name varchar(50) NOT NULL,
                                   subscribe text CHARACTER SET utf8mb4 NOT NULL,
                                   value double precision NOT NULL,
                                   date timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                   PRIMARY KEY (id)
)   ;

ALTER SEQUENCE calc_common_param_seq RESTART WITH 24;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `calc_common_param`
--

LOCK TABLES calc_common_param WRITE;
/* SQLINES DEMO ***  `calc_common_param` DISABLE KEYS */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO calc_common_param VALUES (8,'transport_cost','Затраты на транспорт',2,'2022-08-25 22:13:08'),(9,'layout_price','Стоимость вёрстки (руб)',500,'2022-08-25 22:13:34'),(11,'print_on_glue','Печать по клею (коэф.)',0.11,'2022-08-25 22:14:04'),(12,'print_label_book','Печать этикетки-книжки (коэф.)',2,'2022-08-25 22:14:32'),(13,'euro_exchange','курс евро в рублях (руб/евро)',66,'2022-08-25 22:14:53'),(16,'stamping_time','Время настройки конгрев секции (час)',0.1,'2022-08-25 22:16:00'),(17,'form_tolerance','Допуск формы (мм)',18,'2022-08-25 22:17:19'),(18,'tax','Процент НДС (%)',20,'2022-08-11 11:17:46'),(19,'form_change_time','Время на смену одной формы (мин)',30,'2022-08-11 14:17:21'),(21,'price_increase','Повышение цены (коэф)',1.04,'2022-08-15 10:22:49'),(22,'one_box_weight','Вес одной коробки, кг',0.1,'2022-08-23 16:35:28'),(23,'one_label_weight','Вес одной этикетки , кг',0.01,'2022-08-23 16:36:17');
/* SQLINES DEMO ***  `calc_common_param` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `calc_common_param_archive`
--

DROP TABLE IF EXISTS calc_common_param_archive;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE calc_common_param_archive_seq;

CREATE TABLE calc_common_param_archive (
                                           id int NOT NULL DEFAULT NEXTVAL ('calc_common_param_archive_seq'),
                                           calc_common_param_id int NOT NULL,
                                           value double precision NOT NULL,
                                           date timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                           PRIMARY KEY (id)
    ,
                                           CONSTRAINT delete_calc_common_param FOREIGN KEY (calc_common_param_id) REFERENCES calc_common_param (id) ON DELETE CASCADE ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE calc_common_param_archive_seq RESTART WITH 26;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX delete_calc_common_param ON calc_common_param_archive (calc_common_param_id);

--
-- SQLINES DEMO *** table `calc_common_param_archive`
--

LOCK TABLES calc_common_param_archive WRITE;
/* SQLINES DEMO ***  `calc_common_param_archive` DISABLE KEYS */;
/* SQLINES DEMO ***  `calc_common_param_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `calc_mashine_param`
--

DROP TABLE IF EXISTS calc_mashine_param;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE calc_mashine_param_seq;

CREATE TABLE calc_mashine_param (
                                    id int NOT NULL DEFAULT NEXTVAL ('calc_mashine_param_seq'),
                                    name varchar(50) NOT NULL,
                                    subscribe text NOT NULL,
                                    PRIMARY KEY (id)
)   ;

ALTER SEQUENCE calc_mashine_param_seq RESTART WITH 32;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `calc_mashine_param`
--

LOCK TABLES calc_mashine_param WRITE;
/* SQLINES DEMO ***  `calc_mashine_param` DISABLE KEYS */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO calc_mashine_param VALUES (1,'desired_profit','Желаемая прибыль (евро/час)'),(4,'design_layout_price','Стоимость дизайн макета (руб)'),(5,'form_price','Стоимость формы (евро/см2)'),(8,'scotch_price','Стоимость скотча (евро/см2)'),(9,'paper_cmyk_adjust','Бумага на настройку CMYK (м)'),(10,'paper_common_adjust','Бумага на настройку - общее (м)'),(11,'paper_varnish_adjust','Бумага на настройку ЛАК (м)'),(12,'paper_pantone_adjust','Бумага на настройку Pantone (м)'),(13,'roll_change_length','Длина смены ролика общее (м)'),(14,'lost_paint_compensation','Компенсация потери красок (кг)'),(15,'paper_roll_change','Бумага на смену ролика (м)'),(16,'varnish_usage','Кол-во лака на 1 кв.м (кг/м2)'),(17,'paint_usage','Кол-во краски на 1 кв.м (кг/м2)'),(18,'time_cmyk_adjust','Время CMYK настройка (ч)'),(19,'common_adjust','Общая настройка (ч)'),(20,'time_varnish_adjust','Время ЛАК настройка (ч)'),(21,'time_paint_selection','Время подбор краски (ч)'),(22,'time_pantone_adjust','Время Pantone настройка (ч)'),(23,'one_roll_change_time','Время на смену 1-го ролика (мин)'),(24,'print_speed','Скорость печати (м/мин)'),(25,'stencil_mesh_price','Стоимость трафаретной сетки 1 шт (руб)'),(26,'time_stencil_mesh_adjust','Время Трафарет настройка (ч)'),(27,'paper_paint_selection_adjust','Бумага на подбор краски под оригинал (м)'),(29,'stencil_paint_usage','Кол-во краски на трафарет (кг/м2)'),(31,'paint_selection_price','Стоимость подбора краски (руб)');
/* SQLINES DEMO ***  `calc_mashine_param` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `calc_mashine_param_value`
--

DROP TABLE IF EXISTS calc_mashine_param_value;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE calc_mashine_param_value_seq;

CREATE TABLE calc_mashine_param_value (
                                          id int NOT NULL DEFAULT NEXTVAL ('calc_mashine_param_value_seq'),
                                          mashine_id int NOT NULL,
                                          calc_mashine_param_id int NOT NULL,
                                          value double precision NOT NULL,
                                          date timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                          PRIMARY KEY (id)
    ,
                                          CONSTRAINT delete_calc_mashine_param FOREIGN KEY (calc_mashine_param_id) REFERENCES calc_mashine_param (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                                          CONSTRAINT delete_mashine FOREIGN KEY (mashine_id) REFERENCES mashine (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE calc_mashine_param_value_seq RESTART WITH 32;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX delete_calc_mashine_param ON calc_mashine_param_value (calc_mashine_param_id);
CREATE INDEX delete_mashine ON calc_mashine_param_value (mashine_id);

--
-- SQLINES DEMO *** table `calc_mashine_param_value`
--

LOCK TABLES calc_mashine_param_value WRITE;
/* SQLINES DEMO ***  `calc_mashine_param_value` DISABLE KEYS */;
/* SQLINES DEMO ***  `calc_mashine_param_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `calc_mashine_param_value_archive`
--

DROP TABLE IF EXISTS calc_mashine_param_value_archive;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE calc_mashine_param_value_archive_seq;

CREATE TABLE calc_mashine_param_value_archive (
                                                  id int NOT NULL DEFAULT NEXTVAL ('calc_mashine_param_value_archive_seq'),
                                                  calc_mashine_param_value_id int NOT NULL,
                                                  value double precision NOT NULL,
                                                  date timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                                  PRIMARY KEY (id)
    ,
                                                  CONSTRAINT delete_calc_mashine_param_value FOREIGN KEY (calc_mashine_param_value_id) REFERENCES calc_mashine_param_value (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE calc_mashine_param_value_archive_seq RESTART WITH 40;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX delete_calc_mashine_param_value ON calc_mashine_param_value_archive (calc_mashine_param_value_id);

--
-- SQLINES DEMO *** table `calc_mashine_param_value_archive`
--

LOCK TABLES calc_mashine_param_value_archive WRITE;
/* SQLINES DEMO ***  `calc_mashine_param_value_archive` DISABLE KEYS */;
/* SQLINES DEMO ***  `calc_mashine_param_value_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `combination`
--

DROP TABLE IF EXISTS combination;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE combination_seq;

CREATE TABLE combination (
                             id int NOT NULL DEFAULT NEXTVAL ('combination_seq'),
                             name varchar(50) DEFAULT NULL,
                             PRIMARY KEY (id)
)   ;

ALTER SEQUENCE combination_seq RESTART WITH 9;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `combination`
--

LOCK TABLES combination WRITE;
/* SQLINES DEMO ***  `combination` DISABLE KEYS */;
/* SQLINES DEMO ***  `combination` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `combination_form`
--

DROP TABLE IF EXISTS combination_form;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE combination_form_seq;

CREATE TABLE combination_form (
                                  id int NOT NULL DEFAULT NEXTVAL ('combination_form_seq'),
                                  combination_id int NOT NULL,
                                  label_id int NOT NULL,
                                  PRIMARY KEY (id),
                                  CONSTRAINT label_id UNIQUE  (label_id)
    ,
                                  CONSTRAINT combination_id FOREIGN KEY (combination_id) REFERENCES combination (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                                  CONSTRAINT label_id_fk FOREIGN KEY (label_id) REFERENCES label (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE combination_form_seq RESTART WITH 20;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX combination_id ON combination_form (combination_id);

--
-- SQLINES DEMO *** table `combination_form`
--

LOCK TABLES combination_form WRITE;
/* SQLINES DEMO ***  `combination_form` DISABLE KEYS */;
/* SQLINES DEMO ***  `combination_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `customer`
--

DROP TABLE IF EXISTS customer;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE customer_seq;

CREATE TABLE customer (
                          id int NOT NULL DEFAULT NEXTVAL ('customer_seq'),
                          date_of_create timestamp(0) DEFAULT CURRENT_TIMESTAMP,
                          date_of_agreement timestamp(0) DEFAULT NULL,
                          status_id int NOT NULL DEFAULT '1',
                          name varchar(100) NOT NULL,
                          user_id int NOT NULL,
                          subject_id int DEFAULT NULL,
                          region_id int DEFAULT NULL,
                          town_id int DEFAULT NULL,
                          street_id int DEFAULT NULL,
                          house varchar(100) DEFAULT NULL,
                          email varchar(50) DEFAULT NULL,
                          number varchar(50) DEFAULT NULL,
                          comment text,
                          time_to_delivery_from time(0) DEFAULT NULL,
                          time_to_delivery_to time(0) DEFAULT NULL,
                          contact varchar(100) DEFAULT NULL,
                          PRIMARY KEY (id)
    ,
                          CONSTRAINT customer_region_id FOREIGN KEY (region_id) REFERENCES region (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                          CONSTRAINT customer_street_id FOREIGN KEY (street_id) REFERENCES street (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                          CONSTRAINT customer_subject_id FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                          CONSTRAINT customer_town_id FOREIGN KEY (town_id) REFERENCES town (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                          CONSTRAINT customer_user_id_fk FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE customer_seq RESTART WITH 10;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX customer_user_id_fk ON customer (user_id);
CREATE INDEX customer_subject_id ON customer (subject_id);
CREATE INDEX customer_street_id ON customer (street_id);
CREATE INDEX customer_town_id ON customer (town_id);
CREATE INDEX customer_region_id ON customer (region_id);

--
-- SQLINES DEMO *** table `customer`
--

LOCK TABLES customer WRITE;
/* SQLINES DEMO ***  `customer` DISABLE KEYS */;
/* SQLINES DEMO ***  `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `enterprise_cost`
--

DROP TABLE IF EXISTS enterprise_cost;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE enterprise_cost_seq;

CREATE TABLE enterprise_cost (
                                 id int NOT NULL DEFAULT NEXTVAL ('enterprise_cost_seq'),
                                 date timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                 user_id int DEFAULT NULL,
                                 service_id int NOT NULL,
                                 order_id int DEFAULT NULL,
                                 cost double precision NOT NULL,
                                 PRIMARY KEY (id)
    ,
                                 CONSTRAINT enterprise_cost_order_id_fk FOREIGN KEY (order_id) REFERENCES order (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                                 CONSTRAINT enterprise_cost_service_id_fk FOREIGN KEY (service_id) REFERENCES enterprise_cost_service (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                                 CONSTRAINT enterprise_cost_user_id_fk FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE enterprise_cost_seq RESTART WITH 3;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX enterprise_cost_order_id_fk ON enterprise_cost (order_id);
CREATE INDEX enterprise_cost_user_id_fk ON enterprise_cost (user_id);
CREATE INDEX enterprise_cost_service_id_fk ON enterprise_cost (service_id);

--
-- SQLINES DEMO *** table `enterprise_cost`
--

LOCK TABLES enterprise_cost WRITE;
/* SQLINES DEMO ***  `enterprise_cost` DISABLE KEYS */;
/* SQLINES DEMO ***  `enterprise_cost` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `enterprise_cost_service`
--

DROP TABLE IF EXISTS enterprise_cost_service;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE enterprise_cost_service_seq;

CREATE TABLE enterprise_cost_service (
                                         id int NOT NULL DEFAULT NEXTVAL ('enterprise_cost_service_seq'),
                                         name varchar(100) NOT NULL,
                                         PRIMARY KEY (id)
)   ;

ALTER SEQUENCE enterprise_cost_service_seq RESTART WITH 11;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `enterprise_cost_service`
--

LOCK TABLES enterprise_cost_service WRITE;
/* SQLINES DEMO ***  `enterprise_cost_service` DISABLE KEYS */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO enterprise_cost_service VALUES (1,'Новый штанец'),(2,'Перезаказ штанца'),(3,'Изготовление форм'),(4,'Дизайн этикетки'),(5,'Премия'),(6,'З/п'),(7,'Аренда'),(8,'Налог'),(9,'Командировка'),(10,'Прочее');
/* SQLINES DEMO ***  `enterprise_cost_service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `envelope`
--

DROP TABLE IF EXISTS envelope;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE envelope_seq;

CREATE TABLE envelope (
                          id int NOT NULL DEFAULT NEXTVAL ('envelope_seq'),
                          color1 int NOT NULL,
                          color2 int NOT NULL,
                          shelf_id int NOT NULL,
                          PRIMARY KEY (id)
    ,
                          CONSTRAINT envelope_shelf_id_fk FOREIGN KEY (shelf_id) REFERENCES shelf (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE envelope_seq RESTART WITH 13;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX envelope_shelf_id_fk ON envelope (shelf_id);

--
-- SQLINES DEMO *** table `envelope`
--

LOCK TABLES envelope WRITE;
/* SQLINES DEMO ***  `envelope` DISABLE KEYS */;
/* SQLINES DEMO ***  `envelope` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `finished_products_warehouse`
--

DROP TABLE IF EXISTS finished_products_warehouse;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE finished_products_warehouse_seq;

CREATE TABLE finished_products_warehouse (
                                             id int NOT NULL DEFAULT NEXTVAL ('finished_products_warehouse_seq'),
                                             date_of_create timestamp(0) DEFAULT CURRENT_TIMESTAMP,
                                             order_id int DEFAULT NULL,
                                             previous_order_id int DEFAULT NULL,
                                             label_id int DEFAULT NULL,
                                             label_in_roll int NOT NULL,
                                             roll_count int NOT NULL,
                                             packed_roll_count int DEFAULT '0',
                                             packed_box_count int DEFAULT '0',
                                             packed_bale_count int DEFAULT '0',
                                             sended_roll_count int DEFAULT '0',
                                             sended_box_count int DEFAULT '0',
                                             sended_bale_count int DEFAULT '0',
                                             defect_roll_count int DEFAULT '0',
                                             defect_note text,
                                             PRIMARY KEY (id)
    ,
                                             CONSTRAINT fpw_label_id_fk FOREIGN KEY (label_id) REFERENCES label (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                                             CONSTRAINT fpw_order_id_fk FOREIGN KEY (order_id) REFERENCES order (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                                             CONSTRAINT fpw_pr_order_id_fk FOREIGN KEY (previous_order_id) REFERENCES order (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE finished_products_warehouse_seq RESTART WITH 33;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX fpw_order_id_fk ON finished_products_warehouse (order_id);
CREATE INDEX fpw_pr_order_id_fk ON finished_products_warehouse (previous_order_id);
CREATE INDEX fpw_label_id_fk ON finished_products_warehouse (label_id);

--
-- SQLINES DEMO *** table `finished_products_warehouse`
--

LOCK TABLES finished_products_warehouse WRITE;
/* SQLINES DEMO ***  `finished_products_warehouse` DISABLE KEYS */;
/* SQLINES DEMO ***  `finished_products_warehouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `foil`
--

DROP TABLE IF EXISTS foil;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE foil_seq;

CREATE TABLE foil (
                      id int NOT NULL DEFAULT NEXTVAL ('foil_seq'),
                      name varchar(50) NOT NULL,
                      PRIMARY KEY (id)
)   ;

ALTER SEQUENCE foil_seq RESTART WITH 5;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `foil`
--

LOCK TABLES foil WRITE;
/* SQLINES DEMO ***  `foil` DISABLE KEYS */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO foil VALUES (1,'Без фольги'),(2,'Gold фольга'),(3,'Silver фольга'),(4,'Holographic фольга');
/* SQLINES DEMO ***  `foil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `form`
--

DROP TABLE IF EXISTS form;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE form_seq;

CREATE TABLE form (
                      id int NOT NULL DEFAULT NEXTVAL ('form_seq'),
                      label_id int DEFAULT NULL,
                      width int DEFAULT NULL,
                      height int DEFAULT NULL,
                      lpi int DEFAULT NULL,
                      dpi int DEFAULT NULL,
                      pantone_id int DEFAULT NULL,
                      photo_output_id int DEFAULT NULL,
                      combination_id int DEFAULT NULL,
                      envelope_id int DEFAULT NULL,
                      polymer_id int DEFAULT NULL,
                      ready int DEFAULT NULL,
                      form_defect_id int DEFAULT NULL,
                      PRIMARY KEY (id)
    ,
                      CONSTRAINT form_combination_id_fk FOREIGN KEY (combination_id) REFERENCES combination (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                      CONSTRAINT form_envelope_id_fk FOREIGN KEY (envelope_id) REFERENCES envelope (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                      CONSTRAINT form_form_defect_id_fk FOREIGN KEY (form_defect_id) REFERENCES form_defect (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                      CONSTRAINT form_label_id_fk FOREIGN KEY (label_id) REFERENCES label (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                      CONSTRAINT form_pantone_id_fk FOREIGN KEY (pantone_id) REFERENCES pantone (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                      CONSTRAINT form_photo_output_id_fk FOREIGN KEY (photo_output_id) REFERENCES photo_output (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                      CONSTRAINT form_polymer_id_fk FOREIGN KEY (polymer_id) REFERENCES polymer (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE form_seq RESTART WITH 110;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX label_id ON form (label_id);
CREATE INDEX form_combination_id_fk ON form (combination_id);
CREATE INDEX form_envelope_id_fk ON form (envelope_id);
CREATE INDEX form_form_defect_id_fk ON form (form_defect_id);
CREATE INDEX form_pantone_id_fk ON form (pantone_id);
CREATE INDEX form_photo_output_id_fk ON form (photo_output_id);
CREATE INDEX form_polymer_id_fk ON form (polymer_id);

--
-- SQLINES DEMO *** table `form`
--

LOCK TABLES form WRITE;
/* SQLINES DEMO ***  `form` DISABLE KEYS */;
/* SQLINES DEMO ***  `form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `form_defect`
--

DROP TABLE IF EXISTS form_defect;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE form_defect_seq;

CREATE TABLE form_defect (
                             id int NOT NULL DEFAULT NEXTVAL ('form_defect_seq'),
                             name varchar(50) NOT NULL,
                             PRIMARY KEY (id)
)   ;

ALTER SEQUENCE form_defect_seq RESTART WITH 12;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `form_defect`
--

LOCK TABLES form_defect WRITE;
/* SQLINES DEMO ***  `form_defect` DISABLE KEYS */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO form_defect VALUES (1,'Износ формы'),(2,'Грамматическая ошибка'),(3,'Цвет'),(4,'Отсутсвует форма'),(5,'Не совмещение'),(6,'Не правильный выход'),(7,'Не попадает в штанец'),(8,'Нет части информации'),(9,'Дисторция'),(10,'Отсутствие или несоответствие элементов дизайна'),(11,'Сильный муар');
/* SQLINES DEMO ***  `form_defect` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `form_order_history`
--

DROP TABLE IF EXISTS form_order_history;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE form_order_history_seq;

CREATE TABLE form_order_history (
                                    id int NOT NULL DEFAULT NEXTVAL ('form_order_history_seq'),
                                    order_id int DEFAULT NULL,
                                    form_id int NOT NULL,
                                    PRIMARY KEY (id)
    ,
                                    CONSTRAINT foho_form_id_fk FOREIGN KEY (form_id) REFERENCES form (id),
                                    CONSTRAINT form_order_history_order_id_fk FOREIGN KEY (order_id) REFERENCES order (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)  ;

CREATE INDEX form_order_history_order_id_fk ON form_order_history (order_id);
CREATE INDEX foho_form_id_fk ON form_order_history (form_id);
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `form_order_history`
--

LOCK TABLES form_order_history WRITE;
/* SQLINES DEMO ***  `form_order_history` DISABLE KEYS */;
/* SQLINES DEMO ***  `form_order_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `knife_kind`
--

DROP TABLE IF EXISTS knife_kind;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE knife_kind_seq;

CREATE TABLE knife_kind (
                            id int NOT NULL DEFAULT NEXTVAL ('knife_kind_seq'),
                            name varchar(50) NOT NULL,
                            PRIMARY KEY (id)
)   ;

ALTER SEQUENCE knife_kind_seq RESTART WITH 4;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `knife_kind`
--

LOCK TABLES knife_kind WRITE;
/* SQLINES DEMO ***  `knife_kind` DISABLE KEYS */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO knife_kind VALUES (1,'Universal'),(2,'3L (Laser Long Life)'),(3,'Black Top 3 in 1');
/* SQLINES DEMO ***  `knife_kind` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `label`
--

DROP TABLE IF EXISTS label;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE label_seq;

CREATE TABLE label (
                       id int NOT NULL DEFAULT NEXTVAL ('label_seq'),
                       parent_label int DEFAULT NULL,
                       name varchar(100) CHARACTER SET utf8mb4 NOT NULL,
                       designer_note text CHARACTER SET utf8mb4,
                       manager_note text CHARACTER SET utf8mb4,
                       prepress_note text CHARACTER SET utf8mb4,
                       date_of_create timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
                       date_of_design timestamp(0) DEFAULT NULL,
                       date_of_prepress timestamp(0) DEFAULT NULL,
                       customer_id int DEFAULT NULL,
                       status_id int NOT NULL DEFAULT '1',
                       pants_id int DEFAULT NULL,
                       foil_id int NOT NULL DEFAULT '1',
                       designer_id int DEFAULT NULL,
                       prepress_id int DEFAULT NULL,
                       varnish_id int NOT NULL DEFAULT '0',
                       laminate int NOT NULL DEFAULT '0',
                       print_on_glue int NOT NULL DEFAULT '0',
                       variable int NOT NULL DEFAULT '0',
                       variable_paint_count double precision DEFAULT NULL,
                       stencil int NOT NULL DEFAULT '0',
                       image varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
                       image_crop varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
                       output_label_id int NOT NULL DEFAULT '1',
                       background_id int DEFAULT '1',
                       orientation int NOT NULL DEFAULT '0',
                       image_extended varchar(100) DEFAULT NULL,
                       design_file varchar(100) DEFAULT NULL,
                       prepress_design_file varchar(100) DEFAULT NULL,
                       color_count int DEFAULT '0',
                       laboratory_id int DEFAULT NULL,
                       date_of_flexformready timestamp(0) DEFAULT NULL,
                       laboratory_note text,
                       takeoff_flash int NOT NULL DEFAULT '0',
                       PRIMARY KEY (id)
    ,
                       CONSTRAINT label_background_id_fk FOREIGN KEY (background_id) REFERENCES background_label (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                       CONSTRAINT label_customer_id_fk FOREIGN KEY (customer_id) REFERENCES customer (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                       CONSTRAINT label_designer_id_fk FOREIGN KEY (designer_id) REFERENCES user (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                       CONSTRAINT label_foil_id_fk FOREIGN KEY (foil_id) REFERENCES foil (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                       CONSTRAINT label_laboratory_id_fk FOREIGN KEY (laboratory_id) REFERENCES user (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                       CONSTRAINT label_output_label_id_fk FOREIGN KEY (output_label_id) REFERENCES output_label (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                       CONSTRAINT label_pants_id_fk FOREIGN KEY (pants_id) REFERENCES pants (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                       CONSTRAINT label_prepress_id_fk FOREIGN KEY (prepress_id) REFERENCES user (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                       CONSTRAINT label_varnish_id_fk FOREIGN KEY (varnish_id) REFERENCES varnish_status (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE label_seq RESTART WITH 45;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX label_customer_id_fk ON label (customer_id);
CREATE INDEX label_background_id_fk ON label (background_id);
CREATE INDEX label_designer_id_fk ON label (designer_id);
CREATE INDEX label_prepress_id_fk ON label (prepress_id);
CREATE INDEX label_laboratory_id_fk ON label (laboratory_id);
CREATE INDEX label_foil_id_fk ON label (foil_id);
CREATE INDEX label_output_label_id_fk ON label (output_label_id);
CREATE INDEX label_varnish_id_fk ON label (varnish_id);
CREATE INDEX label_pants_id_fk ON label (pants_id);

--
-- SQLINES DEMO *** table `label`
--

LOCK TABLES label WRITE;
/* SQLINES DEMO ***  `label` DISABLE KEYS */;
/* SQLINES DEMO ***  `label` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `log`
--

DROP TABLE IF EXISTS log;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE log_seq;

CREATE TABLE log (
                     id bigint NOT NULL DEFAULT NEXTVAL ('log_seq'),
                     level int DEFAULT NULL,
                     category varchar(255) DEFAULT NULL,
                     log_time double precision DEFAULT NULL,
                     prefix text,
                     message text,
                     PRIMARY KEY (id)
)   ;

ALTER SEQUENCE log_seq RESTART WITH 23;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX idx_log_level ON log (level);
CREATE INDEX idx_log_category ON log (category);

--
-- SQLINES DEMO *** table `log`
--

LOCK TABLES log WRITE;
/* SQLINES DEMO ***  `log` DISABLE KEYS */;
/* SQLINES DEMO ***  `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `mashine`
--

DROP TABLE IF EXISTS mashine;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE mashine (
                         id int NOT NULL,
                         name varchar(50) NOT NULL,
                         mashine_type int NOT NULL DEFAULT '0' ,
                         PRIMARY KEY (id)
)  ;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `mashine`
--

LOCK TABLES mashine WRITE;
/* SQLINES DEMO ***  `mashine` DISABLE KEYS */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO mashine VALUES (1,'Arsoma',0),(2,'Gallus',0),(3,'Arsoma2',0),(4,'Arsoma3',0),(5,'Gallus_340',0),(6,'Jetsci',2),(7,'Rotoflex',1),(8,'Grafatronic',1);
/* SQLINES DEMO ***  `mashine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `mashine_pantone`
--

DROP TABLE IF EXISTS mashine_pantone;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE mashine_pantone_seq;

CREATE TABLE mashine_pantone (
                                 id int NOT NULL DEFAULT NEXTVAL ('mashine_pantone_seq'),
                                 pantone_id int NOT NULL,
                                 mashine_id int NOT NULL,
                                 PRIMARY KEY (id)
    ,
                                 CONSTRAINT mashine_pantone_mashine_id_fk FOREIGN KEY (mashine_id) REFERENCES mashine (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                                 CONSTRAINT mashine_pantone_pantone_id_fka FOREIGN KEY (pantone_id) REFERENCES pantone (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE mashine_pantone_seq RESTART WITH 41;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX mashine_pantone_mashine_id_fk ON mashine_pantone (mashine_id);
CREATE INDEX mashine_pantone_pantone_id_fka ON mashine_pantone (pantone_id);

--
-- SQLINES DEMO *** table `mashine_pantone`
--

LOCK TABLES mashine_pantone WRITE;
/* SQLINES DEMO ***  `mashine_pantone` DISABLE KEYS */;
/* SQLINES DEMO ***  `mashine_pantone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `mashine_pants`
--

DROP TABLE IF EXISTS mashine_pants;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE mashine_pants_seq;

CREATE TABLE mashine_pants (
                               id int NOT NULL DEFAULT NEXTVAL ('mashine_pants_seq'),
                               mashine_id int NOT NULL,
                               pants_id int NOT NULL,
                               PRIMARY KEY (id)
    ,
                               CONSTRAINT mashine_pants_mashine_id_fka FOREIGN KEY (mashine_id) REFERENCES mashine (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                               CONSTRAINT mashine_pants_pants_id_fka FOREIGN KEY (pants_id) REFERENCES pants (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE mashine_pants_seq RESTART WITH 8;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX mashine_pants_mashine_id_fka ON mashine_pants (mashine_id);
CREATE INDEX mashine_pants_pants_id_fka ON mashine_pants (pants_id);

--
-- SQLINES DEMO *** table `mashine_pants`
--

LOCK TABLES mashine_pants WRITE;
/* SQLINES DEMO ***  `mashine_pants` DISABLE KEYS */;
/* SQLINES DEMO ***  `mashine_pants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `material`
--

DROP TABLE IF EXISTS material;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE material_seq;

CREATE TABLE material (
                          id int NOT NULL DEFAULT NEXTVAL ('material_seq'),
                          date_of_create timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
                          material_group_id int NOT NULL,
                          name varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
                          material_provider_id int DEFAULT NULL,
                          short_name varchar(100) DEFAULT NULL,
                          status int DEFAULT '1' ,
                          price_euro double precision DEFAULT NULL ,
                          density int DEFAULT NULL ,
                          prompt varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL ,
                          material_id_from_provider int DEFAULT NULL ,
                          PRIMARY KEY (id)
    ,
                          CONSTRAINT material_material_group_id_fk FOREIGN KEY (material_group_id) REFERENCES material_group (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                          CONSTRAINT material_material_provider_id_fk FOREIGN KEY (material_provider_id) REFERENCES material_provider (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE material_seq RESTART WITH 8;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX material_material_group_id_fk ON material (material_group_id);
CREATE INDEX material_material_provider_id_fk ON material (material_provider_id);

--
-- SQLINES DEMO *** table `material`
--

LOCK TABLES material WRITE;
/* SQLINES DEMO ***  `material` DISABLE KEYS */;
/* SQLINES DEMO ***  `material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `material_group`
--

DROP TABLE IF EXISTS material_group;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE material_group_seq;

CREATE TABLE material_group (
                                id int NOT NULL DEFAULT NEXTVAL ('material_group_seq'),
                                name varchar(100) NOT NULL,
                                PRIMARY KEY (id)
)   ;

ALTER SEQUENCE material_group_seq RESTART WITH 10;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `material_group`
--

LOCK TABLES material_group WRITE;
/* SQLINES DEMO ***  `material_group` DISABLE KEYS */;
/* SQLINES DEMO ***  `material_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `material_price_archive`
--

DROP TABLE IF EXISTS material_price_archive;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE material_price_archive_seq;

CREATE TABLE material_price_archive (
                                        id int NOT NULL DEFAULT NEXTVAL ('material_price_archive_seq'),
                                        material_id int NOT NULL,
                                        date_of_change timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ,
                                        old_value double precision NOT NULL,
                                        PRIMARY KEY (id)
    ,
                                        CONSTRAINT mpa_material_id_fk FOREIGN KEY (material_id) REFERENCES material (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE material_price_archive_seq RESTART WITH 17;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX mpa_material_id_fk ON material_price_archive (material_id);

--
-- SQLINES DEMO *** table `material_price_archive`
--

LOCK TABLES material_price_archive WRITE;
/* SQLINES DEMO ***  `material_price_archive` DISABLE KEYS */;
/* SQLINES DEMO ***  `material_price_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `material_provider`
--

DROP TABLE IF EXISTS material_provider;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE material_provider_seq;

CREATE TABLE material_provider (
                                   id int NOT NULL DEFAULT NEXTVAL ('material_provider_seq'),
                                   name varchar(100) DEFAULT NULL,
                                   PRIMARY KEY (id)
)   ;

ALTER SEQUENCE material_provider_seq RESTART WITH 4;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `material_provider`
--

LOCK TABLES material_provider WRITE;
/* SQLINES DEMO ***  `material_provider` DISABLE KEYS */;
/* SQLINES DEMO ***  `material_provider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `migration`
--

DROP TABLE IF EXISTS migration;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE migration (
                           version varchar(180) NOT NULL,
                           apply_time int DEFAULT NULL,
                           PRIMARY KEY (version)
)  ;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `migration`
--

LOCK TABLES migration WRITE;
/* SQLINES DEMO ***  `migration` DISABLE KEYS */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO migration VALUES ('m000000_000000_base',1661694063),('m140506_102106_rbac_init',1661694065),('m141106_185632_log_init',1662014262),('m170907_052038_rbac_add_index_on_auth_assignment_user_id',1661694065),('m180523_151638_rbac_updates_indexes_without_prefix',1661694065),('m200409_110543_rbac_update_mssql_trigger',1661694065);
/* SQLINES DEMO ***  `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `mixed_pantone`
--

DROP TABLE IF EXISTS mixed_pantone;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE mixed_pantone_seq;

CREATE TABLE mixed_pantone (
                               id int NOT NULL DEFAULT NEXTVAL ('mixed_pantone_seq'),
                               pantone_id int NOT NULL,
                               component_pantone_id int DEFAULT NULL,
                               weight double precision DEFAULT NULL,
                               PRIMARY KEY (id)
    ,
                               CONSTRAINT mixed_pantone_comp_pantone_id_fk FOREIGN KEY (component_pantone_id) REFERENCES pantone (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                               CONSTRAINT mixed_pantone_pantone_id_fk FOREIGN KEY (pantone_id) REFERENCES pantone (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE mixed_pantone_seq RESTART WITH 25;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX mixed_pantone_pantone_id_fk ON mixed_pantone (pantone_id);
CREATE INDEX mixed_pantone_comp_pantone_id_fk ON mixed_pantone (component_pantone_id);

--
-- SQLINES DEMO *** table `mixed_pantone`
--

LOCK TABLES mixed_pantone WRITE;
/* SQLINES DEMO ***  `mixed_pantone` DISABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `order`
--

DROP TABLE IF EXISTS order;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE order_seq;

CREATE TABLE order (
                       id int NOT NULL DEFAULT NEXTVAL ('order_seq'),
                       date_of_create timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
                       status_id int DEFAULT '1',
                       label_id int DEFAULT NULL,
                       date_of_sale timestamp(0) DEFAULT NULL,
                       date_of_print_begin timestamp(0) DEFAULT NULL,
                       date_of_print_end timestamp(0) DEFAULT NULL,
                       date_of_variable_print_begin timestamp(0) DEFAULT NULL,
                       date_of_variable_print_end timestamp(0) DEFAULT NULL,
                       date_of_packing_begin timestamp(0) DEFAULT NULL,
                       date_of_packing_end timestamp(0) DEFAULT NULL,
                       date_of_rewind_begin timestamp(0) DEFAULT NULL,
                       date_of_rewind_end timestamp(0) DEFAULT NULL,
                       mashine_id int DEFAULT NULL,
                       plan_circulation int DEFAULT NULL,
                       printed_circulation int DEFAULT NULL ,
                       sending int DEFAULT NULL,
                       material_id int DEFAULT NULL,
                       printer_id int DEFAULT NULL,
                       label_price double precision DEFAULT NULL,
                       label_price_with_tax double precision DEFAULT NULL,
                       rewinder_id int DEFAULT NULL,
                       packer_id int DEFAULT NULL,
                       rewinder_note text,
                       printer_note text,
                       manager_note text,
                       tech_note text,
                       sleeve_id int DEFAULT NULL,
                       winding_id int DEFAULT NULL,
                       label_on_roll int DEFAULT NULL,
                       cut_edge int NOT NULL DEFAULT '0',
                       stretch int NOT NULL DEFAULT '0',
                       PRIMARY KEY (id)
    ,
                       CONSTRAINT order_label_id_fk FOREIGN KEY (label_id) REFERENCES label (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                       CONSTRAINT order_mashine_id_fk FOREIGN KEY (mashine_id) REFERENCES mashine (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                       CONSTRAINT order_material_id_fk FOREIGN KEY (material_id) REFERENCES material (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                       CONSTRAINT order_packer_id_fk FOREIGN KEY (packer_id) REFERENCES user (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                       CONSTRAINT order_printer_id_fk FOREIGN KEY (printer_id) REFERENCES user (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                       CONSTRAINT order_rewinder_id_fk FOREIGN KEY (rewinder_id) REFERENCES user (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                       CONSTRAINT order_sleeve_id_fk FOREIGN KEY (sleeve_id) REFERENCES sleeve (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                       CONSTRAINT order_winding_id_fk FOREIGN KEY (winding_id) REFERENCES winding (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE order_seq RESTART WITH 41;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX order_label_id_fk ON order (label_id);
CREATE INDEX order_mashine_id_fk ON order (mashine_id);
CREATE INDEX order_packer_id_fk ON order (packer_id);
CREATE INDEX order_printer_id_fk ON order (printer_id);
CREATE INDEX order_rewinder_id_fk ON order (rewinder_id);
CREATE INDEX order_material_id_fk ON order (material_id);
CREATE INDEX order_winding_id_fk ON order (winding_id);
CREATE INDEX order_sleeve_id_fk ON order (sleeve_id);

--
-- SQLINES DEMO *** table `order`
--

LOCK TABLES order WRITE;
/* SQLINES DEMO ***  `order` DISABLE KEYS */;
/* SQLINES DEMO ***  `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `order_material`
--

DROP TABLE IF EXISTS order_material;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE order_material_seq;

CREATE TABLE order_material (
                                id int NOT NULL DEFAULT NEXTVAL ('order_material_seq'),
                                order_id int NOT NULL,
                                paper_warehouse_id int NOT NULL,
                                length int NOT NULL,
                                date timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                PRIMARY KEY (id)
    ,
                                CONSTRAINT order_material_order_id_fk FOREIGN KEY (order_id) REFERENCES order (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                                CONSTRAINT order_material_paper_warehouse_id_fk FOREIGN KEY (paper_warehouse_id) REFERENCES paper_warehouse (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE order_material_seq RESTART WITH 34;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX order_material_order_id_fk ON order_material (order_id);
CREATE INDEX order_material_paper_warehouse_id_fk ON order_material (paper_warehouse_id);

--
-- SQLINES DEMO *** table `order_material`
--

LOCK TABLES order_material WRITE;
/* SQLINES DEMO ***  `order_material` DISABLE KEYS */;
/* SQLINES DEMO ***  `order_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `output_label`
--

DROP TABLE IF EXISTS output_label;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE output_label_seq;

CREATE TABLE output_label (
                              id int NOT NULL DEFAULT NEXTVAL ('output_label_seq'),
                              name varchar(50) NOT NULL,
                              image varchar(50) NOT NULL,
                              PRIMARY KEY (id)
)   ;

ALTER SEQUENCE output_label_seq RESTART WITH 9;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `output_label`
--

LOCK TABLES output_label WRITE;
/* SQLINES DEMO ***  `output_label` DISABLE KEYS */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO output_label VALUES (1,'Выход1','output_label/s1.jpg'),(2,'Выход2','output_label/s2.jpg'),(3,'Выход3','output_label/s3.jpg'),(4,'Выход4','output_label/s4.jpg');
/* SQLINES DEMO ***  `output_label` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `pantone`
--

DROP TABLE IF EXISTS pantone;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE pantone_seq;

CREATE TABLE pantone (
                         id int NOT NULL DEFAULT NEXTVAL ('pantone_seq'),
                         name varchar(50) NOT NULL,
                         pantone_kind_id int NOT NULL,
                         price_euro double precision DEFAULT NULL,
                         subscribe text,
                         PRIMARY KEY (id)
    ,
                         CONSTRAINT pantone_pantone_kind_id_fk FOREIGN KEY (pantone_kind_id) REFERENCES pantone_kind (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE pantone_seq RESTART WITH 17;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX pantone_pantone_kind_id_fk ON pantone (pantone_kind_id);

--
-- SQLINES DEMO *** table `pantone`
--

LOCK TABLES pantone WRITE;
/* SQLINES DEMO ***  `pantone` DISABLE KEYS */;
/* SQLINES DEMO ***  `pantone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `pantone_kind`
--

DROP TABLE IF EXISTS pantone_kind;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE pantone_kind_seq;

CREATE TABLE pantone_kind (
                              id int NOT NULL DEFAULT NEXTVAL ('pantone_kind_seq'),
                              name varchar(50) NOT NULL,
                              PRIMARY KEY (id)
)   ;

ALTER SEQUENCE pantone_kind_seq RESTART WITH 6;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `pantone_kind`
--

LOCK TABLES pantone_kind WRITE;
/* SQLINES DEMO ***  `pantone_kind` DISABLE KEYS */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO pantone_kind VALUES (1,'Чистый PANTONE'),(2,'Смешанный PANTONE'),(3,'Химия'),(4,'Матовый лак'),(5,'Глянцевый лак');
/* SQLINES DEMO ***  `pantone_kind` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `pantone_label`
--

DROP TABLE IF EXISTS pantone_label;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE pantone_label_seq;

CREATE TABLE pantone_label (
                               id int NOT NULL DEFAULT NEXTVAL ('pantone_label_seq'),
                               pantone_id int NOT NULL,
                               label_id int NOT NULL,
                               PRIMARY KEY (id)
    ,
                               CONSTRAINT pantone_label_label_id_fk FOREIGN KEY (label_id) REFERENCES label (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                               CONSTRAINT pantone_label_pantone_id_fk FOREIGN KEY (pantone_id) REFERENCES pantone (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE pantone_label_seq RESTART WITH 4;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX pantone_label_label_id_fk ON pantone_label (label_id);
CREATE INDEX pantone_label_pantone_id_fk ON pantone_label (pantone_id);

--
-- SQLINES DEMO *** table `pantone_label`
--

LOCK TABLES pantone_label WRITE;
/* SQLINES DEMO ***  `pantone_label` DISABLE KEYS */;
/* SQLINES DEMO ***  `pantone_label` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `pantone_price_archive`
--

DROP TABLE IF EXISTS pantone_price_archive;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE pantone_price_archive_seq;

CREATE TABLE pantone_price_archive (
                                       id int NOT NULL DEFAULT NEXTVAL ('pantone_price_archive_seq'),
                                       pantone_id int NOT NULL,
                                       date_of_change timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                       old_value double precision NOT NULL,
                                       PRIMARY KEY (id)
    ,
                                       CONSTRAINT ppa_pantone_id_fk FOREIGN KEY (pantone_id) REFERENCES pantone (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE pantone_price_archive_seq RESTART WITH 12;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX ppa_pantone_id_fk ON pantone_price_archive (pantone_id);

--
-- SQLINES DEMO *** table `pantone_price_archive`
--

LOCK TABLES pantone_price_archive WRITE;
/* SQLINES DEMO ***  `pantone_price_archive` DISABLE KEYS */;
/* SQLINES DEMO ***  `pantone_price_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `pantone_warehouse`
--

DROP TABLE IF EXISTS pantone_warehouse;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE pantone_warehouse_seq;

CREATE TABLE pantone_warehouse (
                                   id int NOT NULL DEFAULT NEXTVAL ('pantone_warehouse_seq'),
                                   pantone_id int NOT NULL,
                                   weight double precision NOT NULL DEFAULT '0',
                                   date timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                   shelf_id int DEFAULT NULL,
                                   PRIMARY KEY (id)
    ,
                                   CONSTRAINT pw_pantone_id_fk FOREIGN KEY (pantone_id) REFERENCES pantone (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                                   CONSTRAINT pw_shelf_id_fk FOREIGN KEY (shelf_id) REFERENCES shelf (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE pantone_warehouse_seq RESTART WITH 2;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX pw_pantone_id_fk ON pantone_warehouse (pantone_id);
CREATE INDEX pw_shelf_id_fk ON pantone_warehouse (shelf_id);

--
-- SQLINES DEMO *** table `pantone_warehouse`
--

LOCK TABLES pantone_warehouse WRITE;
/* SQLINES DEMO ***  `pantone_warehouse` DISABLE KEYS */;
/* SQLINES DEMO ***  `pantone_warehouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `pants`
--

DROP TABLE IF EXISTS pants;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE pants_seq;

CREATE TABLE pants (
                       id int NOT NULL DEFAULT NEXTVAL ('pants_seq'),
                       shaft_id int DEFAULT NULL,
                       paper_width int DEFAULT NULL ,
                       pants_kind_id int DEFAULT NULL ,
                       cuts int DEFAULT NULL ,
                       width_label double precision NOT NULL ,
                       height_label double precision NOT NULL ,
                       knife_kind_id int DEFAULT NULL ,
                       knife_width int DEFAULT NULL ,
                       picture varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
                       radius double precision DEFAULT NULL ,
                       gap double precision DEFAULT NULL ,
                       material_group_id int DEFAULT NULL,
                       PRIMARY KEY (id)
    ,
                       CONSTRAINT pants_knife_kind_id_fk FOREIGN KEY (knife_kind_id) REFERENCES knife_kind (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                       CONSTRAINT pants_material_group_id_fk FOREIGN KEY (material_group_id) REFERENCES material_group (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                       CONSTRAINT pants_pants_kind_id_fk FOREIGN KEY (pants_kind_id) REFERENCES pants_kind (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                       CONSTRAINT pants_shaft_id_fk FOREIGN KEY (shaft_id) REFERENCES shaft (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE pants_seq RESTART WITH 2858;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX pants_material_group_id_fk ON pants (material_group_id);
CREATE INDEX pants_shaft_id_fk ON pants (shaft_id);
CREATE INDEX pants_pants_kind_id_fk ON pants (pants_kind_id);
CREATE INDEX pants_knife_kind_id_fk ON pants (knife_kind_id);

--
-- SQLINES DEMO *** table `pants`
--

LOCK TABLES pants WRITE;
/* SQLINES DEMO ***  `pants` DISABLE KEYS */;
/* SQLINES DEMO ***  `pants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `pants_kind`
--

DROP TABLE IF EXISTS pants_kind;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE pants_kind_seq;

CREATE TABLE pants_kind (
                            id int NOT NULL DEFAULT NEXTVAL ('pants_kind_seq'),
                            name varchar(50) NOT NULL,
                            PRIMARY KEY (id)
)   ;

ALTER SEQUENCE pants_kind_seq RESTART WITH 4;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `pants_kind`
--

LOCK TABLES pants_kind WRITE;
/* SQLINES DEMO ***  `pants_kind` DISABLE KEYS */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO pants_kind VALUES (1,'Прямоугольный'),(2,'Окружность'),(3,'Фигурный');
/* SQLINES DEMO ***  `pants_kind` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `paper_warehouse`
--

DROP TABLE IF EXISTS paper_warehouse;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE paper_warehouse_seq;

CREATE TABLE paper_warehouse (
                                 id int NOT NULL DEFAULT NEXTVAL ('paper_warehouse_seq'),
                                 date_of_create timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                 material_id int NOT NULL,
                                 length int NOT NULL,
                                 width int NOT NULL,
                                 shelf_id int DEFAULT NULL,
                                 PRIMARY KEY (id)
    ,
                                 CONSTRAINT papw_material_id_fk FOREIGN KEY (material_id) REFERENCES material (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                                 CONSTRAINT papw_shelf_id_fk FOREIGN KEY (shelf_id) REFERENCES shelf (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE paper_warehouse_seq RESTART WITH 1;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX material_id ON paper_warehouse (material_id);
CREATE INDEX papw_shelf_id_fk ON paper_warehouse (shelf_id);

--
-- SQLINES DEMO *** table `paper_warehouse`
--

LOCK TABLES paper_warehouse WRITE;
/* SQLINES DEMO ***  `paper_warehouse` DISABLE KEYS */;
/* SQLINES DEMO ***  `paper_warehouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `photo_output`
--

DROP TABLE IF EXISTS photo_output;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE photo_output_seq;

CREATE TABLE photo_output (
                              id int NOT NULL DEFAULT NEXTVAL ('photo_output_seq'),
                              name varchar(50) NOT NULL,
                              PRIMARY KEY (id)
)   ;

ALTER SEQUENCE photo_output_seq RESTART WITH 3;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `photo_output`
--

LOCK TABLES photo_output WRITE;
/* SQLINES DEMO ***  `photo_output` DISABLE KEYS */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO photo_output VALUES (1,'Kodak'),(2,'LaserGraver');
/* SQLINES DEMO ***  `photo_output` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `polymer`
--

DROP TABLE IF EXISTS polymer;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE polymer_seq;

CREATE TABLE polymer (
                         id int NOT NULL DEFAULT NEXTVAL ('polymer_seq'),
                         name varchar(50) NOT NULL,
                         PRIMARY KEY (id)
)   ;

ALTER SEQUENCE polymer_seq RESTART WITH 1;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `polymer`
--

LOCK TABLES polymer WRITE;
/* SQLINES DEMO ***  `polymer` DISABLE KEYS */;
/* SQLINES DEMO ***  `polymer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `polymer_kind`
--

DROP TABLE IF EXISTS polymer_kind;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE polymer_kind_seq;

CREATE TABLE polymer_kind (
                              id int NOT NULL DEFAULT NEXTVAL ('polymer_kind_seq'),
                              name varchar(50) NOT NULL,
                              PRIMARY KEY (id)
)   ;

ALTER SEQUENCE polymer_kind_seq RESTART WITH 3;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `polymer_kind`
--

LOCK TABLES polymer_kind WRITE;
/* SQLINES DEMO ***  `polymer_kind` DISABLE KEYS */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO polymer_kind VALUES (1,'1,14'),(2,'1,7');
/* SQLINES DEMO ***  `polymer_kind` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `rack`
--

DROP TABLE IF EXISTS rack;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE rack_seq;

CREATE TABLE rack (
                      id int NOT NULL DEFAULT NEXTVAL ('rack_seq') ,
                      name varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL ,
                      warehouse_id int DEFAULT NULL ,
                      PRIMARY KEY (id)
    ,
                      CONSTRAINT rack_warehouse_id_fk FOREIGN KEY (warehouse_id) REFERENCES warehouse (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE rack_seq RESTART WITH 6;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX rack_warehouse_id_fk ON rack (warehouse_id);

--
-- SQLINES DEMO *** table `rack`
--

LOCK TABLES rack WRITE;
/* SQLINES DEMO ***  `rack` DISABLE KEYS */;
/* SQLINES DEMO ***  `rack` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `region`
--

DROP TABLE IF EXISTS region;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE region_seq;

CREATE TABLE region (
                        id int NOT NULL DEFAULT NEXTVAL ('region_seq'),
                        subject_id int NOT NULL,
                        name varchar(100) NOT NULL,
                        PRIMARY KEY (id)
    ,
                        CONSTRAINT region_subject_id_fk FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE region_seq RESTART WITH 4;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX subject_id ON region (subject_id);

--
-- SQLINES DEMO *** table `region`
--

LOCK TABLES region WRITE;
/* SQLINES DEMO ***  `region` DISABLE KEYS */;
/* SQLINES DEMO ***  `region` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `session`
--

DROP TABLE IF EXISTS session;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE session (
                         id char(40) NOT NULL,
                         expire int DEFAULT NULL,
                         data bytea,
                         PRIMARY KEY (id)
)  ;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `session`
--

LOCK TABLES session WRITE;
/* SQLINES DEMO ***  `session` DISABLE KEYS */;
/* SQLINES DEMO ***  `session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `shaft`
--

DROP TABLE IF EXISTS shaft;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE shaft_seq;

CREATE TABLE shaft (
                       id int NOT NULL DEFAULT NEXTVAL ('shaft_seq'),
                       name double precision NOT NULL ,
                       polymer_kind_id int NOT NULL,
                       PRIMARY KEY (id)
    ,
                       CONSTRAINT shaft_polymer_kind_id_fk FOREIGN KEY (polymer_kind_id) REFERENCES polymer_kind (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE shaft_seq RESTART WITH 7;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX shaft_polymer_kind_id_fk ON shaft (polymer_kind_id);

--
-- SQLINES DEMO *** table `shaft`
--

LOCK TABLES shaft WRITE;
/* SQLINES DEMO ***  `shaft` DISABLE KEYS */;
/* SQLINES DEMO ***  `shaft` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `shelf`
--

DROP TABLE IF EXISTS shelf;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE shelf_seq;

CREATE TABLE shelf (
                       id int NOT NULL DEFAULT NEXTVAL ('shelf_seq') ,
                       rack_id int NOT NULL ,
                       PRIMARY KEY (id)
    ,
                       CONSTRAINT shelf_rack_id_fk FOREIGN KEY (rack_id) REFERENCES rack (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE shelf_seq RESTART WITH 7;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX shelf_rack_id_fk ON shelf (rack_id);

--
-- SQLINES DEMO *** table `shelf`
--

LOCK TABLES shelf WRITE;
/* SQLINES DEMO ***  `shelf` DISABLE KEYS */;
/* SQLINES DEMO ***  `shelf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `shipment`
--

DROP TABLE IF EXISTS shipment;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE shipment_seq;

CREATE TABLE shipment (
                          id int NOT NULL DEFAULT NEXTVAL ('shipment_seq'),
                          manager_id int NOT NULL,
                          date_of_create timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
                          date_of_close timestamp(0) DEFAULT NULL,
                          date_of_send timestamp(0) DEFAULT NULL,
                          status_id int NOT NULL DEFAULT '0',
                          transport_id int DEFAULT NULL,
                          gasoline_cost double precision DEFAULT NULL,
                          cost double precision DEFAULT NULL,
                          PRIMARY KEY (id)
    ,
                          CONSTRAINT shipment_manager_id_fk FOREIGN KEY (manager_id) REFERENCES user (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                          CONSTRAINT shipment_transport_id_fk FOREIGN KEY (transport_id) REFERENCES transport (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE shipment_seq RESTART WITH 10;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX shipment_manager_id_fk ON shipment (manager_id);
CREATE INDEX shipment_transport_id_fk ON shipment (transport_id);

--
-- SQLINES DEMO *** table `shipment`
--

LOCK TABLES shipment WRITE;
/* SQLINES DEMO ***  `shipment` DISABLE KEYS */;
/* SQLINES DEMO ***  `shipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `shipment_order`
--

DROP TABLE IF EXISTS shipment_order;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE shipment_order_seq;

CREATE TABLE shipment_order (
                                id int NOT NULL DEFAULT NEXTVAL ('shipment_order_seq'),
                                order_id int NOT NULL,
                                shipment_id int NOT NULL,
                                PRIMARY KEY (id),
                                CONSTRAINT order_id UNIQUE  (order_id)
    ,
                                CONSTRAINT shipment_order_order_id_fk FOREIGN KEY (order_id) REFERENCES order (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
                                CONSTRAINT shipment_order_shipment_id_fk FOREIGN KEY (shipment_id) REFERENCES shipment (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE shipment_order_seq RESTART WITH 20;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX shipment_order_shipment_id_fk ON shipment_order (shipment_id);

--
-- SQLINES DEMO *** table `shipment_order`
--

LOCK TABLES shipment_order WRITE;
/* SQLINES DEMO ***  `shipment_order` DISABLE KEYS */;
/* SQLINES DEMO ***  `shipment_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `sleeve`
--

DROP TABLE IF EXISTS sleeve;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE sleeve_seq;

CREATE TABLE sleeve (
                        id int NOT NULL DEFAULT NEXTVAL ('sleeve_seq'),
                        name varchar(50) NOT NULL,
                        PRIMARY KEY (id)
)   ;

ALTER SEQUENCE sleeve_seq RESTART WITH 6;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `sleeve`
--

LOCK TABLES sleeve WRITE;
/* SQLINES DEMO ***  `sleeve` DISABLE KEYS */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO sleeve VALUES (1,'40'),(2,'76'),(3,'45'),(4,'Любая'),(5,'85');
/* SQLINES DEMO ***  `sleeve` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `street`
--

DROP TABLE IF EXISTS street;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE street_seq;

CREATE TABLE street (
                        id int NOT NULL DEFAULT NEXTVAL ('street_seq'),
                        town_id int NOT NULL,
                        name varchar(100) NOT NULL,
                        PRIMARY KEY (id)
    ,
                        CONSTRAINT street_town_id_fk FOREIGN KEY (town_id) REFERENCES town (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE street_seq RESTART WITH 8;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX town_id ON street (town_id);

--
-- SQLINES DEMO *** table `street`
--

LOCK TABLES street WRITE;
/* SQLINES DEMO ***  `street` DISABLE KEYS */;
/* SQLINES DEMO ***  `street` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `subject`
--

DROP TABLE IF EXISTS subject;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE subject_seq;

CREATE TABLE subject (
                         id int NOT NULL DEFAULT NEXTVAL ('subject_seq'),
                         name varchar(100) NOT NULL,
                         PRIMARY KEY (id)
)   ;

ALTER SEQUENCE subject_seq RESTART WITH 103;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `subject`
--

LOCK TABLES subject WRITE;
/* SQLINES DEMO ***  `subject` DISABLE KEYS */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO subject VALUES (1,'Республика Татарстан'),(2,'Республика Башкортостан'),(25,'Белгородская область'),(26,'Брянская область'),(27,'Владимирская область'),(28,'Воронежская область'),(29,'Ивановская область'),(30,'Калужская область'),(31,'Костромская область'),(32,'Курская область'),(33,'Липецкая область'),(34,'Московская область'),(35,'Орловская область'),(36,'Рязанская область'),(37,'Смоленская область'),(38,'Тамбовская область'),(39,'Тверская область'),(40,'Тульская область'),(41,'Ярославская область'),(42,'Республика Карелия'),(43,'Республика Коми'),(44,'Архангельская область'),(45,'Вологодская область'),(46,'Калининградская область'),(47,'Ленинградская область'),(48,'Мурманская область'),(49,'Новгородская область'),(50,'Псковская область'),(51,'Республика Адыгея'),(52,'Республика Калмыкия'),(53,'Республика Крым'),(54,'Краснодарский край'),(55,'Астраханская область'),(56,'Волгоградская область'),(57,'Ростовская область'),(58,'Республика Дагестан'),(59,'Республика Ингушетия'),(60,'Кабардино-Балкарская Республика'),(61,'Карачаево-Черкесская Республика'),(62,'Республика Северная Осетия-Алания'),(63,'Чеченская Республика'),(64,'Ставропольский край'),(65,'Республика Марий Эл'),(66,'Республика Мордовия'),(67,'Удмуртская Республика'),(68,'Чувашская Республика'),(69,'Пермский край'),(70,'Кировская область'),(71,'Нижегородская область'),(72,'Оренбургская область'),(73,'Пензенская область'),(74,'Самарская область'),(75,'Саратовская область'),(76,'Ульяновская область'),(77,'Курганская область'),(78,'Свердловская область'),(79,'Тюменская область'),(80,'Челябинская область'),(81,'Республика Алтай'),(82,'Республика Бурятия'),(83,'Республика Тыва'),(84,'Республика Хакасия'),(85,'Алтайский край'),(86,'Забайкальский край'),(87,'Красноярский край'),(88,'Иркутская область'),(89,'Кемеровская область'),(90,'Новосибирская область'),(91,'Омская область'),(92,'Томская область'),(93,'Республика Саха (Якутия)'),(94,'Камчатский край'),(95,'Приморский край'),(96,'Хабаровский край'),(97,'Амурская область'),(98,'Магаданская область'),(99,'Сахалинская область'),(100,'Еврейская автономная область'),(101,'Чукотский автономный округ'),(102,'Республика Крым');
/* SQLINES DEMO ***  `subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `time_tracker`
--

DROP TABLE IF EXISTS time_tracker;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE time_tracker_seq;

CREATE TABLE time_tracker (
                              id int NOT NULL DEFAULT NEXTVAL ('time_tracker_seq'),
                              employee_id int DEFAULT NULL,
                              date_of_action timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
                              PRIMARY KEY (id)
    ,
                              CONSTRAINT tt_employee_id FOREIGN KEY (employee_id) REFERENCES user (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE time_tracker_seq RESTART WITH 3;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX tt_employee_id ON time_tracker (employee_id);

--
-- SQLINES DEMO *** table `time_tracker`
--

LOCK TABLES time_tracker WRITE;
/* SQLINES DEMO ***  `time_tracker` DISABLE KEYS */;
/* SQLINES DEMO ***  `time_tracker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `town`
--

DROP TABLE IF EXISTS town;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE town_seq;

CREATE TABLE town (
                      id int NOT NULL DEFAULT NEXTVAL ('town_seq'),
                      region_id int NOT NULL,
                      name varchar(100) NOT NULL,
                      PRIMARY KEY (id)
    ,
                      CONSTRAINT town_region_id_fk FOREIGN KEY (region_id) REFERENCES region (id) ON DELETE RESTRICT ON UPDATE RESTRICT
)   ;

ALTER SEQUENCE town_seq RESTART WITH 5;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

CREATE INDEX region_id ON town (region_id);

--
-- SQLINES DEMO *** table `town`
--

LOCK TABLES town WRITE;
/* SQLINES DEMO ***  `town` DISABLE KEYS */;
/* SQLINES DEMO ***  `town` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `transport`
--

DROP TABLE IF EXISTS transport;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE transport_seq;

CREATE TABLE transport (
                           id int NOT NULL DEFAULT NEXTVAL ('transport_seq'),
                           name varchar(100) NOT NULL,
                           car_number varchar(50) NOT NULL,
                           load_capacity double precision NOT NULL,
                           subscribe text CHARACTER SET utf8mb4,
                           PRIMARY KEY (id)
)   ;

ALTER SEQUENCE transport_seq RESTART WITH 3;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `transport`
--

LOCK TABLES transport WRITE;
/* SQLINES DEMO ***  `transport` DISABLE KEYS */;
/* SQLINES DEMO ***  `transport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `upload_paper`
--

DROP TABLE IF EXISTS upload_paper;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE upload_paper_seq;

CREATE TABLE upload_paper (
                              id int NOT NULL DEFAULT NEXTVAL ('upload_paper_seq'),
                              pallet_id varchar(100) NOT NULL,
                              width int NOT NULL,
                              length int NOT NULL,
                              material_id_from_provider int NOT NULL,
                              roll_id varchar(100) NOT NULL,
                              PRIMARY KEY (id)
)   ;

ALTER SEQUENCE upload_paper_seq RESTART WITH 101;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `upload_paper`
--

LOCK TABLES upload_paper WRITE;
/* SQLINES DEMO ***  `upload_paper` DISABLE KEYS */;
/* SQLINES DEMO ***  `upload_paper` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `user`
--

DROP TABLE IF EXISTS user;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE user_seq;

CREATE TABLE user (
                      id int NOT NULL DEFAULT NEXTVAL ('user_seq'),
                      username varchar(50) NOT NULL,
                      password varchar(100) CHARACTER SET utf8mb4 NOT NULL,
                      authKey varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
                      accessToken varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
                      F varchar(100) NOT NULL,
                      I varchar(100) NOT NULL,
                      O varchar(100) NOT NULL,
                      status_id int NOT NULL DEFAULT '0' ,
                      PRIMARY KEY (id)
)   ;

ALTER SEQUENCE user_seq RESTART WITH 21;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `user`
--

LOCK TABLES user WRITE;
/* SQLINES DEMO ***  `user` DISABLE KEYS */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO user VALUES (1,'admin','$2y$13$sYciWiCA.iW8ef0vkGBNHeTL/ec1BgkS/XGZ0xrGb1YryHeOp9RM2','LLaK_ws5ngfhJghkgjkgOTCbT_qEd5NRdiI',NULL,'admin','admin','admin',0);
/* SQLINES DEMO ***  `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `varnish_status`
--

DROP TABLE IF EXISTS varnish_status;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE TABLE varnish_status (
                                id int NOT NULL,
                                name varchar(50) NOT NULL,
                                PRIMARY KEY (id)
)  ;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `varnish_status`
--

LOCK TABLES varnish_status WRITE;
/* SQLINES DEMO ***  `varnish_status` DISABLE KEYS */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO varnish_status VALUES (0,'Без лака'),(1,'Матовый лак'),(2,'Глянцевый лак'),(3,'Матовый/Глянцевый лак');
/* SQLINES DEMO ***  `varnish_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `warehouse`
--

DROP TABLE IF EXISTS warehouse;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE warehouse_seq;

CREATE TABLE warehouse (
                           id int NOT NULL DEFAULT NEXTVAL ('warehouse_seq'),
                           name varchar(100) CHARACTER SET utf8mb4 NOT NULL ,
                           PRIMARY KEY (id)
)   ;

ALTER SEQUENCE warehouse_seq RESTART WITH 7;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `warehouse`
--

LOCK TABLES warehouse WRITE;
/* SQLINES DEMO ***  `warehouse` DISABLE KEYS */;
/* SQLINES DEMO ***  `warehouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- SQLINES DEMO *** or table `winding`
--

DROP TABLE IF EXISTS winding;
/* SQLINES DEMO *** cs_client     = @@character_set_client */;
/* SQLINES DEMO *** er_set_client = utf8mb4 */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
CREATE SEQUENCE winding_seq;

CREATE TABLE winding (
                         id int NOT NULL DEFAULT NEXTVAL ('winding_seq'),
                         name varchar(50) NOT NULL,
                         image varchar(50) NOT NULL,
                         PRIMARY KEY (id)
)   ;

ALTER SEQUENCE winding_seq RESTART WITH 9;
/* SQLINES DEMO *** er_set_client = @saved_cs_client */;

--
-- SQLINES DEMO *** table `winding`
--

LOCK TABLES winding WRITE;
/* SQLINES DEMO ***  `winding` DISABLE KEYS */;
-- SQLINES LICENSE FOR EVALUATION USE ONLY
INSERT INTO winding VALUES (1,'Намотка 1','winding_order/s1.jpg'),(2,'Намотка2','winding_order/s2.jpg'),(3,'Намотка3','winding_order/s3.jpg'),(4,'Намотка4','winding_order/s4.jpg'),(5,'Намотка5','winding_order/s5.jpg'),(6,'Намотка6','winding_order/s6.jpg'),(7,'Намотка7','winding_order/s7.jpg'),(8,'Намотка8','winding_order/s8.jpg');
/* SQLINES DEMO ***  `winding` ENABLE KEYS */;
UNLOCK TABLES;
/* SQLINES DEMO *** NE=@OLD_TIME_ZONE */;

/* SQLINES DEMO *** E=@OLD_SQL_MODE */;
/* SQLINES DEMO *** _KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/* SQLINES DEMO *** CHECKS=@OLD_UNIQUE_CHECKS */;
/* SQLINES DEMO *** ER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/* SQLINES DEMO *** ER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/* SQLINES DEMO *** ON_CONNECTION=@OLD_COLLATION_CONNECTION */;
/* SQLINES DEMO *** ES=@OLD_SQL_NOTES */;

-- SQLINES DEMO ***  2022-09-16 16:25:19

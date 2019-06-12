-- MySQL dump 10.13  Distrib 8.0.16, for Linux (x86_64)
--
-- Host: localhost    Database: renovation_of_apartments
-- ------------------------------------------------------
-- Server version	8.0.16

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
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` VALUES ('brigadeWorker','3',1560281360),('brigadeWorker','4',1560281360),('brigadeWorker','5',1560281360),('brigadeWorker','6',1560281360),('brigadeWorker','7',1560281360),('brigadier','2',1560281360),('headOfAccounting','1',1560281360);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` VALUES ('brigadeWorker',1,NULL,NULL,NULL,1560281360,1560281360),('brigadier',1,NULL,NULL,NULL,1560281360,1560281360),('headOfAccounting',1,NULL,NULL,NULL,1560281360,1560281360);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_rule`
--

LOCK TABLES `auth_rule` WRITE;
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(64) NOT NULL,
  `phone_number` varchar(32) NOT NULL,
  `email_address` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone_number` (`phone_number`),
  UNIQUE KEY `email_address` (`email_address`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'Власов Велор Леонидович','+7 950 734-62-33','vlasov.velor@gmail.com'),(2,'Назарова Вида Макаровна','+7 950 235-23-45','nazarova.vida@gmail.com'),(3,'Федотова Алика Германовна','+7 950 345-62-32','fedotova.alika@gmail.com'),(4,'Миронова Элеонора Федотовна','+7 950 126-23-42','mironova.eleonora@gmail.com'),(5,'Казаков Григорий Денисович','+7 950 262-46-23','kazakov.grigory@gmail.com');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(64) NOT NULL,
  `position` varchar(64) NOT NULL,
  `phone_number` varchar(32) NOT NULL,
  `email_address` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone_number` (`phone_number`),
  UNIQUE KEY `email_address` (`email_address`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (1,'Кузнецов Владимир Сергеевич','Бригадир','+7 950 531-22-31','kuznetsov.vladimir@gmail.com'),(2,'Быков Тимофей Мэлорович','Рабочий','+7 950 354-23-37','bikov.tima@gmail.com'),(3,'Логинов Казимир Валерьянович','Рабочий','+7 950 174-34-46','loginov.kazya@gmail.com'),(4,'Сафонов Рудольф Онисимович','Рабочий','+7 950 567-83-46','safronov.rudolf@gmail.com'),(5,'Ширяев Артур Данилович','Рабочий','+7 950 345-67-78','shiryaev.artur@gmail.com'),(6,'Карпов Роман Мартынович','Рабочий','+7 950 894-56-34','karpov.roman@gmail.com'),(7,'Кудряшова Арина Андреевна','Начальник учета','+7 950 867-53-43','kudryaseva.arina@gmail.com'),(8,'Ковалев Альфред Матвеевич','Системный администратор','+7 950 567-84-53','kovalev.alfred@gmail.com'),(9,'Носов Авраам Давидович','Директор','+7 950 762-34-12','nosov.avraam@gmail.com');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `equipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `exit_to_object_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_id` (`item_id`,`exit_to_object_id`),
  KEY `exit_to_object_id` (`exit_to_object_id`),
  CONSTRAINT `equipment_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`),
  CONSTRAINT `equipment_ibfk_2` FOREIGN KEY (`exit_to_object_id`) REFERENCES `exit_to_object` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipment`
--

LOCK TABLES `equipment` WRITE;
/*!40000 ALTER TABLE `equipment` DISABLE KEYS */;
INSERT INTO `equipment` VALUES (1,8,1,3),(2,22,1,3),(3,8,1,8),(4,22,1,8),(5,8,1,9),(6,22,1,9),(7,22,1,14),(8,8,1,14),(9,8,1,15),(10,22,1,15),(11,26,10,4),(12,10,5,4),(13,27,4,4),(14,28,5,4),(15,10,5,5),(16,28,5,5),(17,27,3,5),(18,16,3,5),(19,29,5,5),(20,4,5,11),(21,16,3,11),(22,32,7,11),(23,30,2,11),(24,27,3,13),(25,28,4,13),(26,10,7,13),(27,29,6,13),(28,4,7,13),(29,15,2,16),(30,2,6,16),(31,28,3,16),(32,10,5,16),(33,21,1,16);
/*!40000 ALTER TABLE `equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exit_to_object`
--

DROP TABLE IF EXISTS `exit_to_object`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `exit_to_object` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `brigade_gathering_datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`,`brigade_gathering_datetime`),
  CONSTRAINT `exit_to_object_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exit_to_object`
--

LOCK TABLES `exit_to_object` WRITE;
/*!40000 ALTER TABLE `exit_to_object` DISABLE KEYS */;
INSERT INTO `exit_to_object` VALUES (3,1,'2019-06-03 09:00:00'),(4,1,'2019-06-05 09:25:00'),(5,1,'2019-06-07 09:00:00'),(8,2,'2019-05-20 09:30:00'),(9,3,'2019-04-22 09:15:00'),(11,3,'2019-04-24 09:00:00'),(13,3,'2019-04-26 10:15:00'),(14,4,'2019-06-10 08:00:00'),(16,4,'2019-06-12 08:30:00'),(15,5,'2019-06-11 08:30:00');
/*!40000 ALTER TABLE `exit_to_object` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `warehouse_id` int(11) NOT NULL,
  `name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `type` enum('Инструмент','Материал','Расходуемое','Другое') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchase_price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `warehouse_id` (`warehouse_id`,`name`),
  CONSTRAINT `item_ibfk_1` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouse` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (1,1,'Краска для кухонь и ванных комнат Олимп 9л','Расходуемое',20,1287.00),(2,2,'Краска для стен и потолков Эксперт 14кг','Расходуемое',19,651.00),(3,1,'Краска фасадная акриловая Олимп Сигма 10л белый','Расходуемое',23,1895.00),(4,1,'Звуко-виброизоляция ISOHOME П К 6мм 1,3х50м вспененный полипропилен серый','Материал',18,4470.00),(5,2,'Дрель-шуруповерт аккумуляторная Patriot BR 181Li The One','Инструмент',7,3521.00),(6,1,'Аппарат сварочный инверторный EDON TB-200','Инструмент',3,3078.00),(7,1,'Пила цепная электрическая EDON ECS405-KA40 1.8кВт 40см','Инструмент',3,2284.00),(8,1,'Стремянка 4 ступени широкие металл Ника СМ4','Другое',1,928.00),(9,1,'Шлифмашина угловая WERT EAG 2023T 2000Вт 230мм','Инструмент',5,3010.00),(10,2,'Штукатурка Vetonit TT40 25кг','Материал',8,286.00),(11,1,'Пила циркулярная 1550Вт СПЕЦ БЦП-1300','Инструмент',8,3990.00),(12,1,'Лобзик 770Вт СПЕЦ БПМ-670Л','Инструмент',4,2350.00),(13,1,'Заклепочник 0-360град. STAYER 3110','Инструмент',2,598.00),(14,1,'Ключ комбинированный трещеточный VIRA 13мм 72 зубца','Инструмент',5,210.00),(15,2,'Кувалда 5000г с фиберглассовой ручкой VIRA 900250','Инструмент',4,2145.00),(16,1,'Молоток слесарный 500гр Matrix с деревянной ручкой','Инструмент',9,265.00),(17,1,'Ключ разводной 250мм никелированный СИБРТЕХ 15527','Инструмент',7,365.00),(18,1,'Отвертка PH 2х100мм 2-х компонентная рукоятка Сибртех','Инструмент',10,79.00),(19,1,'Болторез 450мм 18 Matrix','Инструмент',6,633.00),(20,2,'Киянка резиновая 680гр SPARTA','Инструмент',6,190.00),(21,2,'Топор-колун Patriot PA 600 X-Treme Cleaver 1300г','Инструмент',4,1946.00),(22,1,'Уровень 1500мм 3глаз. с линейкой','Инструмент',1,390.00),(23,1,'Герметик звукоизоляционный Вибросил 290мл','Расходуемое',12,368.00),(24,2,'Жгут теплоизоляционный Вилатерм 20мм x 6м','Расходуемое',40,17.00),(25,1,'Лист гипсокартонный KNAUF влагостойкий 2500х1200х12,5 мм','Материал',45,389.00),(26,2,'Обои компакт-винил ERISMANN Vlies Line Exclusive OBI 3074-70','Материал',30,889.00),(27,1,'Кисть малярная LUX-TOOLS по дереву 100 мм','Инструмент',3,156.00),(28,1,'Шпаклевка финишная Ceresit СT225 белая 25 кг','Расходуемое',3,965.00),(29,2,'Потолок подвесной БАРД комплект 2.5 кв.м. белый матовый','Материал',39,2299.00),(30,2,'Комплект \"Теплый пол\" SPYHEAT КЛАССИК SHMD-8-2400, 16 кв.м','Материал',8,10590.00),(31,1,'Тепло-звукоизоляция PenoHome Евроблок 30х600х1000 мм','Материал',40,229.00),(32,1,'Линолеум полукоммерческий IVC Greenline Morzin 849 ширина 3,5 м','Материал',13,729.00);
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1560281357),('m140506_102106_rbac_init',1560281359),('m170907_052038_rbac_add_index_on_auth_assignment_user_id',1560281359),('m180523_151638_rbac_updates_indexes_without_prefix',1560281359);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contract_date` date NOT NULL,
  `period_of_execution` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `work_object_id` int(11) NOT NULL,
  `status` enum('В работе','Завершено','Отменено') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `work_object_id` (`work_object_id`),
  CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  CONSTRAINT `order_ibfk_2` FOREIGN KEY (`work_object_id`) REFERENCES `work_object` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (1,'2019-06-01','2019-06-08',1,1,'Завершено'),(2,'2019-05-18','2019-05-25',2,2,'Отменено'),(3,'2019-04-20','2019-04-27',3,3,'Завершено'),(4,'2019-06-08','2019-06-22',4,4,'В работе'),(5,'2019-06-09','2019-06-29',5,5,'В работе');
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `renovating_brigade`
--

DROP TABLE IF EXISTS `renovating_brigade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `renovating_brigade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `exit_to_object_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employee_id` (`employee_id`,`exit_to_object_id`),
  KEY `exit_to_object_id` (`exit_to_object_id`),
  CONSTRAINT `renovating_brigade_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`),
  CONSTRAINT `renovating_brigade_ibfk_2` FOREIGN KEY (`exit_to_object_id`) REFERENCES `exit_to_object` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `renovating_brigade`
--

LOCK TABLES `renovating_brigade` WRITE;
/*!40000 ALTER TABLE `renovating_brigade` DISABLE KEYS */;
INSERT INTO `renovating_brigade` VALUES (6,1,4),(10,1,5),(14,1,11),(18,1,13),(21,1,16),(1,2,3),(7,2,4),(22,2,16),(8,3,4),(2,3,8),(16,3,11),(19,3,13),(23,3,16),(9,4,4),(13,4,5),(3,4,9),(25,4,16),(12,5,5),(15,5,11),(20,5,13),(5,5,15),(24,5,16),(11,6,5),(17,6,11),(4,6,14);
/*!40000 ALTER TABLE `renovating_brigade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` enum('Потолок','Стены','Пол','Коммуникации','Демонтаж','Остальное') NOT NULL,
  `text` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `unit` enum('Квадратный метр','Штука','Погонный метр','Комплект','Не применимо') NOT NULL,
  `cost_per_unit` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category` (`category`,`text`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (1,'Потолок','Шумоизоляция','Квадратный метр',250.00),(2,'Потолок','Монтаж натяжных потолков','Квадратный метр',600.00),(3,'Потолок','Очистка','Квадратный метр',80.00),(4,'Потолок','Грунтование','Квадратный метр',30.00),(5,'Потолок','Оштукатуривание','Квадратный метр',320.00),(6,'Потолок','Шпатлевание','Квадратный метр',200.00),(7,'Потолок','Окраска ','Квадратный метр',200.00),(8,'Стены','Шумоизоляция','Квадратный метр',150.00),(9,'Стены','Оштукатуривание','Квадратный метр',280.00),(10,'Стены','Шпатлевание','Квадратный метр',160.00),(11,'Стены','Окраска','Квадратный метр',160.00),(12,'Стены','Оклейка виниловыми обоями','Квадратный метр',180.00),(13,'Стены','Оклейка фотообоями','Квадратный метр',450.00),(14,'Стены','Нанесение декоративной штукатурки','Квадратный метр',450.00),(15,'Стены','Облицовка керамической плиткой','Квадратный метр',800.00),(16,'Остальное','Замер помещений','Не применимо',0.00),(17,'Пол','Установка деревянных лаг','Квадратный метр',300.00),(18,'Пол','Настил фанеры','Квадратный метр',280.00),(19,'Пол','Шумоизоляция','Квадратный метр',150.00),(20,'Пол','Гидроизоляция','Квадратный метр',80.00),(21,'Пол','Заливка цементной стяжки','Квадратный метр',320.00),(22,'Пол','Нивелировка','Квадратный метр',240.00),(23,'Пол','Укладка линолеума','Квадратный метр',160.00),(24,'Пол','Укладка ковролина','Квадратный метр',180.00),(25,'Пол','Укладка ламината','Квадратный метр',220.00),(26,'Пол','Укладка паркетной доски','Квадратный метр',340.00),(27,'Пол','Монтаж напольного плинтуса','Погонный метр',90.00),(28,'Коммуникации','Прокладка электрического кабеля','Погонный метр',50.00),(29,'Коммуникации','Установка распределительных коробок','Штука',380.00),(30,'Коммуникации','Установка розеток и выключателей','Штука',150.00),(31,'Коммуникации','Монтаж теплого пола','Квадратный метр',350.00),(32,'Коммуникации','Установка точечного светильника','Штука',250.00),(33,'Коммуникации','Установка люстры','Штука',800.00),(34,'Коммуникации','Прокладка труб водоснабжения','Комплект',4000.00),(35,'Коммуникации','Установка унитаза, биде','Штука',1400.00),(36,'Коммуникации','Установка ванны','Штука',1500.00),(37,'Коммуникации','Установка раковины','Штука',800.00),(38,'Коммуникации','Установка водонагревателя','Штука',1600.00),(39,'Коммуникации','Установка душевой кабины','Штука',3500.00),(40,'Демонтаж','Дверное полотно','Квадратный метр',55.00),(41,'Демонтаж','Снятие старых потолочных обоев','Квадратный метр',95.00),(42,'Демонтаж','Ковролин, линолеум, ламинат','Квадратный метр',60.00),(43,'Демонтаж','Паркет, доски','Квадратный метр',110.00),(44,'Демонтаж','Напольный или потолочный плинтус','Погонный метр',25.00),(45,'Демонтаж','Плтика','Квадратный метр',80.00),(46,'Демонтаж','Кронштейны осветительных приборов','Погонный метр',50.00),(47,'Демонтаж','Подвесный потолок','Квадратный метр',75.00),(48,'Демонтаж','Потолок из гипсокартона','Квадратный метр',95.00),(49,'Демонтаж','Штукатурка','Квадратный метр',85.00),(50,'Демонтаж','Очистка стен от краски, шпатлевки или олифы','Квадратный метр',60.00),(51,'Демонтаж','Очистка стен от старых обоев','Квадратный метр',25.00),(52,'Демонтаж','Снос жб стен до 100мм','Квадратный метр',780.00),(53,'Демонтаж','Снос кирпичных стен в 1 кирпич','Квадратный метр',215.00),(54,'Демонтаж','Снос жб стен от 180мм до 220мм','Квадратный метр',2250.00),(55,'Демонтаж','Снос жб стен от 150мм до 180мм','Квадратный метр',1680.00),(56,'Демонтаж','Снос жб стен от 100мм до 150мм','Квадратный метр',1150.00),(57,'Демонтаж','Снос легких стен','Квадратный метр',105.00),(58,'Демонтаж','Снос стен из петобетона менее 300мм','Квадратный метр',160.00);
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password_hash` char(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'head-of-accounting','$2a$10$i3iJNTqYZ9G5rlpQTnAnQ.toMM8jtkm1SrBfYWxPDR4oEjo4GweUm'),(2,'brigadier','$2a$10$HCLkPZ4XaE0OYfFlwrt8hO0S.yRsHJ0H2JDlshl0FUv2FPr6CAbn.'),(3,'brigade-worker-1','$2a$10$NOmn9H6iw.68zcfl3tshUOANWZ7GUKhcFTXE9BcepJy6LYGLUwNPS'),(4,'brigade-worker-2','$2a$10$qizCGTrbRG5HIvVH9UE.Q.AqHZXfXn7OcviEBH2vhug/BYUAaYSpa'),(5,'brigade-worker-3','$2a$10$GLjskYDlUm9nK4.CpTp.6.9K.EP5nVpJjfKHKjVmfsdiL5AcHliKK'),(6,'brigade-worker-4','$2a$10$xWZ80e4920En348TvAS/NORO0xNuUdTTOstQ4yNfOzKNzgLfsP/ZG'),(7,'brigade-worker-5','$2a$10$1uYCPlg2Aul4Tdlu5R4naeeBpnZClqzBaMkt2OWyJLhexL0KGPDtK');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warehouse`
--

DROP TABLE IF EXISTS `warehouse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `warehouse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `address` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `address` (`address`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warehouse`
--

LOCK TABLES `warehouse` WRITE;
/*!40000 ALTER TABLE `warehouse` DISABLE KEYS */;
INSERT INTO `warehouse` VALUES (1,'Основной','ул. Первая, 23'),(2,'Дополнительный','ул. Вторая, 42');
/*!40000 ALTER TABLE `warehouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work_object`
--

DROP TABLE IF EXISTS `work_object`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `work_object` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `house_address` varchar(64) NOT NULL,
  `apartment_number` int(11) NOT NULL,
  `apartment_area` int(11) NOT NULL,
  `number_of_rooms` int(11) NOT NULL,
  `entrance_number` int(11) DEFAULT NULL,
  `floor_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `house_address` (`house_address`,`apartment_number`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work_object`
--

LOCK TABLES `work_object` WRITE;
/*!40000 ALTER TABLE `work_object` DISABLE KEYS */;
INSERT INTO `work_object` VALUES (1,'ул. Лубянка, 29А',35,46,2,3,NULL),(2,'ул. Вокзальная, 65',24,52,3,NULL,2),(3,'ул. Лазенки, 45',34,51,2,4,3),(4,'ул. Макаренко, 61',45,60,4,2,4),(5,'ул. Живарев Переулок, 58',56,75,4,NULL,NULL);
/*!40000 ALTER TABLE `work_object` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work_task`
--

DROP TABLE IF EXISTS `work_task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `work_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `exit_to_object_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `task_id` (`task_id`,`exit_to_object_id`),
  KEY `exit_to_object_id` (`exit_to_object_id`),
  CONSTRAINT `work_task_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`),
  CONSTRAINT `work_task_ibfk_2` FOREIGN KEY (`exit_to_object_id`) REFERENCES `exit_to_object` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work_task`
--

LOCK TABLES `work_task` WRITE;
/*!40000 ALTER TABLE `work_task` DISABLE KEYS */;
INSERT INTO `work_task` VALUES (18,1,13),(13,2,5),(19,2,13),(9,3,5),(17,3,13),(11,5,5),(20,5,13),(12,6,5),(21,6,13),(6,9,4),(22,9,16),(7,10,4),(23,10,16),(24,11,16),(8,12,4),(1,16,3),(2,16,8),(3,16,9),(4,16,14),(5,16,15),(14,19,11),(15,23,11),(16,31,11),(25,50,16),(26,54,16);
/*!40000 ALTER TABLE `work_task` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-12 11:27:35

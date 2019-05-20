-- MySQL dump 10.13  Distrib 5.7.26, for Linux (x86_64)
--
-- Host: localhost    Database: emanuel
-- ------------------------------------------------------
-- Server version	5.7.26-0ubuntu0.18.04.1

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
-- Table structure for table `actividad`
--

DROP TABLE IF EXISTS `actividad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actividad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `ini` int(11) DEFAULT NULL,
  `fin` int(11) DEFAULT NULL,
  `pu` float DEFAULT NULL,
  `activo` tinytext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actividad`
--

LOCK TABLES `actividad` WRITE;
/*!40000 ALTER TABLE `actividad` DISABLE KEYS */;
INSERT INTO `actividad` VALUES (1,'Arroz con leche','2019-04-27',NULL,NULL,2,'si'),(2,'Pollada','2019-05-18',100,200,12,'si');
/*!40000 ALTER TABLE `actividad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `concepto`
--

DROP TABLE IF EXISTS `concepto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `concepto` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activo` tinyint(4) DEFAULT '1',
  `actividad` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `concepto`
--

LOCK TABLES `concepto` WRITE;
/*!40000 ALTER TABLE `concepto` DISABLE KEYS */;
INSERT INTO `concepto` VALUES (1,'Ofrenda de Sabado',1,0),(2,'Libro del seminario',1,0),(3,'Venta de Queque',1,0),(4,'Venta de pan con pollo',1,0),(5,'Venta de mazamorra y arroz con leche',1,0),(6,'Ofrenda Fam. Pacheco',1,0),(7,'Ofrenda Fam. Salazar',1,0),(8,'Flores para la misa',1,0),(9,'Ofrenda Ponente',1,0),(10,'Pasajes Retiro',1,0),(11,'Snacks',1,0),(12,'Mobilidad',1,0),(13,'Compra de película',1,0),(14,'Entrada de concierto',1,0),(15,'Torta de cumpleaños',1,0),(16,'Porcentajes RCC',1,0),(17,'Compra de Pollo',1,1),(18,'Compra de Papas',1,1),(19,'Consumo actividad',1,1),(20,'Actividad Económica',1,0);
/*!40000 ALTER TABLE `concepto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_rows`
--

DROP TABLE IF EXISTS `data_rows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_rows` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data_type_id` int(10) unsigned NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `browse` tinyint(1) NOT NULL DEFAULT '1',
  `read` tinyint(1) NOT NULL DEFAULT '1',
  `edit` tinyint(1) NOT NULL DEFAULT '1',
  `add` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '1',
  `details` text COLLATE utf8mb4_unicode_ci,
  `order` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `data_rows_data_type_id_foreign` (`data_type_id`),
  CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_rows`
--

LOCK TABLES `data_rows` WRITE;
/*!40000 ALTER TABLE `data_rows` DISABLE KEYS */;
INSERT INTO `data_rows` VALUES (1,1,'id','number','ID',1,0,0,0,0,0,NULL,1),(2,1,'name','text','Name',1,1,1,1,1,1,NULL,2),(3,1,'email','text','Email',1,1,1,1,1,1,NULL,3),(4,1,'password','password','Password',1,0,0,1,1,0,NULL,4),(5,1,'remember_token','text','Remember Token',0,0,0,0,0,0,NULL,5),(6,1,'created_at','timestamp','Created At',0,1,1,0,0,0,NULL,6),(7,1,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,7),(8,1,'avatar','image','Avatar',0,1,1,1,1,1,NULL,8),(9,1,'user_belongsto_role_relationship','relationship','Role',0,1,1,1,1,0,'{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"roles\",\"pivot\":0}',10),(10,1,'user_belongstomany_role_relationship','relationship','Roles',0,1,1,1,1,0,'{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}',11),(11,1,'settings','hidden','Settings',0,0,0,0,0,0,NULL,12),(12,2,'id','number','ID',1,0,0,0,0,0,NULL,1),(13,2,'name','text','Name',1,1,1,1,1,1,NULL,2),(14,2,'created_at','timestamp','Created At',0,0,0,0,0,0,NULL,3),(15,2,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,4),(16,3,'id','number','ID',1,0,0,0,0,0,NULL,1),(17,3,'name','text','Name',1,1,1,1,1,1,NULL,2),(18,3,'created_at','timestamp','Created At',0,0,0,0,0,0,NULL,3),(19,3,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,4),(20,3,'display_name','text','Display Name',1,1,1,1,1,1,NULL,5),(21,1,'role_id','text','Role',1,1,1,1,1,1,NULL,9),(22,4,'id','text','Id',1,0,0,0,0,0,'{}',1),(23,4,'nombre','text','Nombre',0,1,1,1,1,1,'{}',2),(24,4,'activo','radio_btn','Activo',0,1,1,1,1,1,'{\"default\":\"1\",\"options\":{\"0\":\"No\",\"1\":\"Si\"}}',3),(25,5,'id','text','Id',1,1,0,0,0,0,'{}',1),(26,5,'nombre','text','Nombre',0,1,1,1,1,1,'{}',2),(27,5,'fecha','date','Fecha',0,1,1,1,1,1,'{}',3),(28,5,'ini','number','Ini',0,1,1,1,1,1,'{}',4),(29,5,'fin','number','Fin',0,1,1,1,1,1,'{}',5),(30,5,'pu','number','Pu',0,1,1,1,1,1,'{}',6),(31,6,'id','text','Id',1,0,0,0,0,0,'{}',1),(32,6,'monto','number','Monto',0,1,1,1,1,1,'{}',2),(33,6,'fecha','date','Fecha',0,1,1,1,1,1,'{}',3),(34,6,'tipo','radio_btn','Tipo',0,1,1,1,1,1,'{\"default\":\"Entrada\",\"options\":{\"Entrada\":\"Entrada\",\"Salida\":\"Salida\"}}',4),(35,6,'idconcepto','text','Idconcepto',0,1,1,1,1,1,'{}',5),(36,6,'idactividad','text','Idactividad',0,1,1,1,1,1,'{}',6),(37,6,'movimiento_belongsto_actividad_relationship','relationship','actividad',0,1,1,1,1,1,'{\"model\":\"App\\\\Actividad\",\"table\":\"actividad\",\"type\":\"belongsTo\",\"column\":\"idactividad\",\"key\":\"id\",\"label\":\"nombre\",\"pivot_table\":\"actividad\",\"pivot\":\"0\",\"taggable\":\"0\"}',7),(38,6,'movimiento_belongsto_concepto_relationship','relationship','concepto',0,1,1,1,1,1,'{\"model\":\"App\\\\Concepto\",\"table\":\"concepto\",\"type\":\"belongsTo\",\"column\":\"idconcepto\",\"key\":\"id\",\"label\":\"nombre\",\"pivot_table\":\"actividad\",\"pivot\":\"0\",\"taggable\":\"0\"}',8),(39,7,'id','text','Id',1,0,0,0,0,0,'{}',1),(40,7,'paterno','text','Paterno',0,1,1,1,1,1,'{}',2),(41,7,'materno','text','Materno',0,1,1,1,1,1,'{}',3),(42,7,'nombres','text','Nombres',0,1,1,1,1,1,'{}',4),(43,7,'telefono','text','Telefono',0,1,1,1,1,1,'{}',5),(44,7,'tipo','select_dropdown','Tipo',0,1,1,1,1,1,'{\"default\":\"Hermano\",\"options\":{\"Hermano\":\"Hermano\",\"Pareja\":\"Pareja\",\"Externo\":\"Externo\"}}',6),(55,6,'observacion','rich_text_box','Observacion',0,1,1,1,1,1,'{}',10),(56,6,'excluir','radio_btn','Excluir',0,1,1,1,1,1,'{\"default\":\"0\",\"options\":{\"0\":\"No\",\"1\":\"Si\"}}',9),(57,15,'id','text','Id',1,0,0,0,0,0,'{}',1),(58,15,'year','number','Year',0,1,1,1,1,1,'{}',2),(59,15,'month','number','Month',0,1,1,1,1,1,'{}',3),(64,15,'saldo_inicial','number','Saldo Inicial',0,1,1,1,1,1,'{}',4),(65,15,'ingresos','number','Ingresos',0,1,1,1,1,1,'{}',5),(66,15,'egresos','number','Egresos',0,1,1,1,1,1,'{}',6),(67,15,'saldo_final','number','Saldo Final',0,1,1,1,1,1,'{}',7),(68,4,'actividad','radio_btn','Actividad',0,1,1,1,1,1,'{\"default\":\"0\",\"options\":{\"0\":\"No\",\"1\":\"Si\"}}',4),(69,15,'cerrado','radio_btn','Cerrado',0,1,1,1,1,1,'{\"default\":\"1\",\"options\":{\"0\":\"No\",\"1\":\"Si\"}}',8),(70,16,'id','text','Id',1,0,0,0,0,0,'{}',1),(71,16,'monto','number','Monto',0,1,1,1,1,1,'{}',2),(72,16,'fecha_deuda','date','Fecha Deuda',0,1,1,1,1,1,'{}',3),(73,16,'idconcepto','number','Idconcepto',0,1,1,1,1,1,'{}',4),(74,16,'estado','select_dropdown','Estado',0,1,1,1,1,1,'{\"default\":\"por pagar\",\"options\":{\"por cobrar\":\"Por cobrar\",\"por pagar\":\"Por pagar\",\"pagado\":\"Pagado\",\"cobrado\":\"Cobrado\"}}',5),(75,16,'fecha','date','Fecha',0,1,1,1,1,1,'{}',6),(76,16,'descripcion','text_area','Descripcion',0,1,1,1,1,1,'{}',7),(77,16,'idactividad','number','Idactividad',0,1,1,1,1,1,'{}',9),(78,16,'contabilizar','radio_btn','Contabilizar',0,1,1,1,1,1,'{\"default\":\"no\",\"options\":{\"no\":\"No\",\"si\":\"Si\"}}',8),(79,16,'idmiembro','number','Idmiembro',0,1,1,1,1,1,'{}',10),(80,16,'deuda_belongsto_concepto_relationship','relationship','concepto',0,1,1,1,1,1,'{\"model\":\"App\\\\Concepto\",\"table\":\"concepto\",\"type\":\"belongsTo\",\"column\":\"idconcepto\",\"key\":\"id\",\"label\":\"nombre\",\"pivot_table\":\"actividad\",\"pivot\":\"0\",\"taggable\":\"0\"}',11),(81,16,'deuda_belongsto_actividad_relationship','relationship','actividad',0,1,1,1,1,1,'{\"model\":\"App\\\\Actividad\",\"table\":\"actividad\",\"type\":\"belongsTo\",\"column\":\"idactividad\",\"key\":\"id\",\"label\":\"nombre\",\"pivot_table\":\"actividad\",\"pivot\":\"0\",\"taggable\":\"0\"}',12),(82,16,'deuda_belongsto_miembro_relationship','relationship','miembro',0,1,1,1,1,1,'{\"model\":\"App\\\\Miembro\",\"table\":\"miembro\",\"type\":\"belongsTo\",\"column\":\"idmiembro\",\"key\":\"id\",\"label\":\"nombres\",\"pivot_table\":\"actividad\",\"pivot\":\"0\",\"taggable\":\"0\"}',13),(83,5,'activo','radio_btn','Activo',0,1,1,1,1,1,'{\"default\":\"si\",\"options\":{\"si\":\"Si\",\"no\":\"No\"}}',7),(84,6,'iddeuda','number','Iddeuda',0,1,1,1,1,1,'{}',9),(85,6,'movimiento_belongsto_deuda_relationship','relationship','deudas',0,1,1,1,1,1,'{\"model\":\"App\\\\Deuda\",\"table\":\"deudas\",\"type\":\"belongsTo\",\"column\":\"iddeuda\",\"key\":\"id\",\"label\":\"descripcion\",\"pivot_table\":\"actividad\",\"pivot\":\"0\",\"taggable\":\"0\"}',11);
/*!40000 ALTER TABLE `data_rows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_types`
--

DROP TABLE IF EXISTS `data_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT '0',
  `server_side` tinyint(4) NOT NULL DEFAULT '0',
  `details` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `data_types_name_unique` (`name`),
  UNIQUE KEY `data_types_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_types`
--

LOCK TABLES `data_types` WRITE;
/*!40000 ALTER TABLE `data_types` DISABLE KEYS */;
INSERT INTO `data_types` VALUES (1,'users','users','User','Users','voyager-person','TCG\\Voyager\\Models\\User','TCG\\Voyager\\Policies\\UserPolicy','TCG\\Voyager\\Http\\Controllers\\VoyagerUserController','',1,0,NULL,'2019-05-04 10:02:12','2019-05-04 10:02:12'),(2,'menus','menus','Menu','Menus','voyager-list','TCG\\Voyager\\Models\\Menu',NULL,'','',1,0,NULL,'2019-05-04 10:02:12','2019-05-04 10:02:12'),(3,'roles','roles','Role','Roles','voyager-lock','TCG\\Voyager\\Models\\Role',NULL,'','',1,0,NULL,'2019-05-04 10:02:12','2019-05-04 10:02:12'),(4,'concepto','concepto','Concepto','Conceptos','voyager-window-list','App\\Concepto',NULL,NULL,NULL,1,0,'{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}','2019-05-04 10:32:18','2019-05-09 04:09:20'),(5,'actividad','actividad','Actividad','Actividades','voyager-basket','App\\Actividad',NULL,NULL,NULL,1,0,'{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}','2019-05-04 10:43:32','2019-05-11 18:30:34'),(6,'movimiento','movimiento','Movimiento','Movimientos','voyager-handle','App\\Movimiento',NULL,NULL,NULL,1,0,'{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}','2019-05-04 10:47:54','2019-05-16 10:16:32'),(7,'miembro','miembro','Miembro','Miembros','voyager-people','App\\Miembro',NULL,NULL,NULL,1,0,'{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}','2019-05-04 10:56:08','2019-05-04 11:07:03'),(15,'resumen','resumen','Resuman','Resumen','voyager-list-add','App\\Resuman',NULL,NULL,NULL,1,0,'{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}','2019-05-07 09:31:41','2019-05-11 04:26:23'),(16,'deudas','deudas','Deuda','Deudas','voyager-handle','App\\Deuda',NULL,NULL,NULL,1,0,'{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}','2019-05-11 18:03:56','2019-05-11 19:01:58');
/*!40000 ALTER TABLE `data_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deudas`
--

DROP TABLE IF EXISTS `deudas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deudas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `monto` float DEFAULT NULL,
  `fecha_deuda` date DEFAULT NULL,
  `idconcepto` float DEFAULT NULL,
  `estado` tinytext COLLATE utf8mb4_unicode_ci,
  `fecha` date DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idactividad` int(11) DEFAULT NULL,
  `contabilizar` tinytext COLLATE utf8mb4_unicode_ci,
  `idmiembro` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deudas`
--

LOCK TABLES `deudas` WRITE;
/*!40000 ALTER TABLE `deudas` DISABLE KEYS */;
INSERT INTO `deudas` VALUES (2,123,'2019-05-11',13,'pagado','2019-05-16','Compre la pelicula winni de poo',NULL,'no',1),(3,12,'2019-05-15',14,'cobrado','2019-05-16','cobra a gaby concierto',NULL,'si',1),(4,100,'2019-05-18',19,'por cobrar',NULL,NULL,2,'si',1),(5,100,'2019-05-18',18,'por cobrar',NULL,NULL,2,'si',2);
/*!40000 ALTER TABLE `deudas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `menu_items_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (1,1,'Dashboard','','_self','voyager-boat',NULL,NULL,1,'2019-05-04 10:02:14','2019-05-04 10:02:14','voyager.dashboard',NULL),(2,1,'Media','','_self','voyager-images',NULL,NULL,11,'2019-05-04 10:02:14','2019-05-11 18:08:04','voyager.media.index',NULL),(3,1,'Users','','_self','voyager-person',NULL,NULL,10,'2019-05-04 10:02:14','2019-05-11 18:08:04','voyager.users.index',NULL),(4,1,'Roles','','_self','voyager-lock',NULL,NULL,9,'2019-05-04 10:02:14','2019-05-11 18:08:04','voyager.roles.index',NULL),(5,1,'Tools','','_self','voyager-tools',NULL,NULL,12,'2019-05-04 10:02:14','2019-05-07 09:32:56',NULL,NULL),(6,1,'Menu Builder','','_self','voyager-list',NULL,5,1,'2019-05-04 10:02:14','2019-05-04 10:45:30','voyager.menus.index',NULL),(7,1,'Database','','_self','voyager-data',NULL,5,2,'2019-05-04 10:02:14','2019-05-04 10:45:30','voyager.database.index',NULL),(8,1,'Compass','','_self','voyager-compass',NULL,5,3,'2019-05-04 10:02:14','2019-05-04 10:45:30','voyager.compass.index',NULL),(9,1,'BREAD','','_self','voyager-bread',NULL,5,4,'2019-05-04 10:02:14','2019-05-04 10:45:31','voyager.bread.index',NULL),(10,1,'Settings','','_self','voyager-settings',NULL,NULL,13,'2019-05-04 10:02:15','2019-05-07 09:32:56','voyager.settings.index',NULL),(11,1,'Hooks','','_self','voyager-hook',NULL,5,5,'2019-05-04 10:02:19','2019-05-04 10:45:31','voyager.hooks',NULL),(12,1,'Conceptos','','_self','voyager-window-list',NULL,NULL,5,'2019-05-04 10:32:18','2019-05-11 03:47:11','voyager.concepto.index',NULL),(13,1,'Actividades','','_self','voyager-basket','#000000',NULL,7,'2019-05-04 10:43:32','2019-05-11 18:08:08','voyager.actividad.index','null'),(14,1,'Movimientos','','_self','voyager-handle',NULL,NULL,4,'2019-05-04 10:47:54','2019-05-11 03:47:11','voyager.movimiento.index',NULL),(15,1,'Miembros','','_self','voyager-people',NULL,NULL,8,'2019-05-04 10:56:08','2019-05-11 18:08:08','voyager.miembro.index',NULL),(19,1,'Frontend','/','_blank','voyager-play','#000000',NULL,2,'2019-05-04 22:04:20','2019-05-04 22:04:31',NULL,''),(20,1,'Resumen','','_self','voyager-list-add',NULL,NULL,3,'2019-05-07 09:31:42','2019-05-11 03:47:11','voyager.resumen.index',NULL),(21,1,'Deudas','','_self','voyager-hammer','#000000',NULL,6,'2019-05-11 18:03:57','2019-05-11 18:09:01','voyager.deudas.index','null');
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'admin','2019-05-04 10:02:14','2019-05-04 10:02:14');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `miembro`
--

DROP TABLE IF EXISTS `miembro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `miembro` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `paterno` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `materno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombres` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` tinytext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `miembro`
--

LOCK TABLES `miembro` WRITE;
/*!40000 ALTER TABLE `miembro` DISABLE KEYS */;
INSERT INTO `miembro` VALUES (1,'Mayta','Campos','Luis Fernando','991801039','Hermano'),(2,'Sánchez','Torres','Lucy Marisol','991801039','Hermano');
/*!40000 ALTER TABLE `miembro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_01_01_000000_add_voyager_user_fields',1),(4,'2016_01_01_000000_create_data_types_table',1),(5,'2016_05_19_173453_create_menu_table',1),(6,'2016_10_21_190000_create_roles_table',1),(7,'2016_10_21_190000_create_settings_table',1),(8,'2016_11_30_135954_create_permission_table',1),(9,'2016_11_30_141208_create_permission_role_table',1),(10,'2016_12_26_201236_data_types__add__server_side',1),(11,'2017_01_13_000000_add_route_to_menu_items_table',1),(12,'2017_01_14_005015_create_translations_table',1),(13,'2017_01_15_000000_make_table_name_nullable_in_permissions_table',1),(14,'2017_03_06_000000_add_controller_to_data_types_table',1),(15,'2017_04_21_000000_add_order_to_data_rows_table',1),(16,'2017_07_05_210000_add_policyname_to_data_types_table',1),(17,'2017_08_05_000000_add_group_to_settings_table',1),(18,'2017_11_26_013050_add_user_role_relationship',1),(19,'2017_11_26_015000_create_user_roles_table',1),(20,'2018_03_11_000000_add_user_settings',1),(21,'2018_03_14_000000_add_details_to_data_types_table',1),(22,'2018_03_16_000000_make_settings_value_nullable',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimiento`
--

DROP TABLE IF EXISTS `movimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movimiento` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `monto` float DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idconcepto` int(11) DEFAULT NULL,
  `idactividad` int(11) DEFAULT NULL,
  `observacion` text COLLATE utf8mb4_unicode_ci,
  `excluir` tinyint(4) DEFAULT '0',
  `iddeuda` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimiento`
--

LOCK TABLES `movimiento` WRITE;
/*!40000 ALTER TABLE `movimiento` DISABLE KEYS */;
INSERT INTO `movimiento` VALUES (8,17.1,'2019-01-05','Entrada',1,NULL,'<p>Bajada de reyes</p>',0,NULL),(9,8.7,'2019-01-12','Entrada',1,NULL,NULL,0,NULL),(10,13.2,'2019-01-19','Entrada',1,NULL,'<p>No se pidi&oacute; ofrenda</p>',0,NULL),(11,0,'2019-01-26','Entrada',1,NULL,NULL,0,NULL),(12,17.8,'2019-01-26','Entrada',1,NULL,NULL,0,NULL),(13,28,'2019-01-05','Entrada',3,NULL,NULL,1,NULL),(14,100,'2019-01-02','Entrada',6,NULL,NULL,1,NULL),(15,30,'2019-01-01','Salida',8,NULL,NULL,0,NULL),(16,10,'2019-01-01','Salida',9,NULL,NULL,0,NULL),(17,20,'2019-01-07','Salida',12,NULL,'Pasaje para retiros',0,NULL),(18,10,'2019-01-08','Salida',11,NULL,NULL,0,NULL),(19,5,'2019-01-08','Salida',13,NULL,'<p>Para los ni&ntilde;os</p>',0,NULL),(20,12,'2019-01-16','Salida',14,NULL,'Para Gaby',0,NULL),(21,4,'2019-01-29','Salida',15,NULL,'Para Nataly',0,NULL),(22,5,'2019-01-08','Salida',12,NULL,'<p>Moto para trasladar laptop multimedia, radio</p>',0,NULL),(25,54.62,'2019-01-31','Salida',16,NULL,NULL,0,NULL),(28,123,'2019-02-16','Salida',13,NULL,'Compre la pelicula winni de poo',0,2),(30,12,'2019-02-17','Entrada',14,NULL,'cobra a gaby concierto',0,3),(31,500,'2019-05-17','Salida',17,2,NULL,0,NULL),(32,200,'2019-05-17','Salida',18,2,NULL,0,NULL),(33,1200,'2019-05-18','Entrada',19,2,NULL,0,NULL);
/*!40000 ALTER TABLE `movimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,1),(38,1),(39,1),(40,1),(41,1),(42,1),(43,1),(44,1),(45,1),(46,1),(62,1),(63,1),(64,1),(65,1),(66,1),(67,1),(68,1),(69,1),(70,1),(71,1);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_key_index` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'browse_admin',NULL,'2019-05-04 10:02:15','2019-05-04 10:02:15'),(2,'browse_bread',NULL,'2019-05-04 10:02:15','2019-05-04 10:02:15'),(3,'browse_database',NULL,'2019-05-04 10:02:15','2019-05-04 10:02:15'),(4,'browse_media',NULL,'2019-05-04 10:02:15','2019-05-04 10:02:15'),(5,'browse_compass',NULL,'2019-05-04 10:02:15','2019-05-04 10:02:15'),(6,'browse_menus','menus','2019-05-04 10:02:15','2019-05-04 10:02:15'),(7,'read_menus','menus','2019-05-04 10:02:15','2019-05-04 10:02:15'),(8,'edit_menus','menus','2019-05-04 10:02:15','2019-05-04 10:02:15'),(9,'add_menus','menus','2019-05-04 10:02:16','2019-05-04 10:02:16'),(10,'delete_menus','menus','2019-05-04 10:02:16','2019-05-04 10:02:16'),(11,'browse_roles','roles','2019-05-04 10:02:16','2019-05-04 10:02:16'),(12,'read_roles','roles','2019-05-04 10:02:16','2019-05-04 10:02:16'),(13,'edit_roles','roles','2019-05-04 10:02:16','2019-05-04 10:02:16'),(14,'add_roles','roles','2019-05-04 10:02:16','2019-05-04 10:02:16'),(15,'delete_roles','roles','2019-05-04 10:02:16','2019-05-04 10:02:16'),(16,'browse_users','users','2019-05-04 10:02:16','2019-05-04 10:02:16'),(17,'read_users','users','2019-05-04 10:02:16','2019-05-04 10:02:16'),(18,'edit_users','users','2019-05-04 10:02:16','2019-05-04 10:02:16'),(19,'add_users','users','2019-05-04 10:02:16','2019-05-04 10:02:16'),(20,'delete_users','users','2019-05-04 10:02:16','2019-05-04 10:02:16'),(21,'browse_settings','settings','2019-05-04 10:02:16','2019-05-04 10:02:16'),(22,'read_settings','settings','2019-05-04 10:02:16','2019-05-04 10:02:16'),(23,'edit_settings','settings','2019-05-04 10:02:16','2019-05-04 10:02:16'),(24,'add_settings','settings','2019-05-04 10:02:17','2019-05-04 10:02:17'),(25,'delete_settings','settings','2019-05-04 10:02:17','2019-05-04 10:02:17'),(26,'browse_hooks',NULL,'2019-05-04 10:02:19','2019-05-04 10:02:19'),(27,'browse_concepto','concepto','2019-05-04 10:32:18','2019-05-04 10:32:18'),(28,'read_concepto','concepto','2019-05-04 10:32:18','2019-05-04 10:32:18'),(29,'edit_concepto','concepto','2019-05-04 10:32:18','2019-05-04 10:32:18'),(30,'add_concepto','concepto','2019-05-04 10:32:18','2019-05-04 10:32:18'),(31,'delete_concepto','concepto','2019-05-04 10:32:18','2019-05-04 10:32:18'),(32,'browse_actividad','actividad','2019-05-04 10:43:32','2019-05-04 10:43:32'),(33,'read_actividad','actividad','2019-05-04 10:43:32','2019-05-04 10:43:32'),(34,'edit_actividad','actividad','2019-05-04 10:43:32','2019-05-04 10:43:32'),(35,'add_actividad','actividad','2019-05-04 10:43:32','2019-05-04 10:43:32'),(36,'delete_actividad','actividad','2019-05-04 10:43:32','2019-05-04 10:43:32'),(37,'browse_movimiento','movimiento','2019-05-04 10:47:54','2019-05-04 10:47:54'),(38,'read_movimiento','movimiento','2019-05-04 10:47:54','2019-05-04 10:47:54'),(39,'edit_movimiento','movimiento','2019-05-04 10:47:54','2019-05-04 10:47:54'),(40,'add_movimiento','movimiento','2019-05-04 10:47:54','2019-05-04 10:47:54'),(41,'delete_movimiento','movimiento','2019-05-04 10:47:54','2019-05-04 10:47:54'),(42,'browse_miembro','miembro','2019-05-04 10:56:08','2019-05-04 10:56:08'),(43,'read_miembro','miembro','2019-05-04 10:56:08','2019-05-04 10:56:08'),(44,'edit_miembro','miembro','2019-05-04 10:56:08','2019-05-04 10:56:08'),(45,'add_miembro','miembro','2019-05-04 10:56:08','2019-05-04 10:56:08'),(46,'delete_miembro','miembro','2019-05-04 10:56:08','2019-05-04 10:56:08'),(62,'browse_resumen','resumen','2019-05-07 09:31:42','2019-05-07 09:31:42'),(63,'read_resumen','resumen','2019-05-07 09:31:42','2019-05-07 09:31:42'),(64,'edit_resumen','resumen','2019-05-07 09:31:42','2019-05-07 09:31:42'),(65,'add_resumen','resumen','2019-05-07 09:31:42','2019-05-07 09:31:42'),(66,'delete_resumen','resumen','2019-05-07 09:31:42','2019-05-07 09:31:42'),(67,'browse_deudas','deudas','2019-05-11 18:03:56','2019-05-11 18:03:56'),(68,'read_deudas','deudas','2019-05-11 18:03:56','2019-05-11 18:03:56'),(69,'edit_deudas','deudas','2019-05-11 18:03:56','2019-05-11 18:03:56'),(70,'add_deudas','deudas','2019-05-11 18:03:56','2019-05-11 18:03:56'),(71,'delete_deudas','deudas','2019-05-11 18:03:56','2019-05-11 18:03:56');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `porcentaje`
--

DROP TABLE IF EXISTS `porcentaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `porcentaje` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` int(11) DEFAULT NULL,
  `valor` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `porcentaje`
--

LOCK TABLES `porcentaje` WRITE;
/*!40000 ALTER TABLE `porcentaje` DISABLE KEYS */;
/*!40000 ALTER TABLE `porcentaje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resumen`
--

DROP TABLE IF EXISTS `resumen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resumen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `year` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `saldo_inicial` float DEFAULT '0',
  `ingresos` float DEFAULT '0',
  `egresos` float DEFAULT '0',
  `saldo_final` float DEFAULT '0',
  `cerrado` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resumen`
--

LOCK TABLES `resumen` WRITE;
/*!40000 ALTER TABLE `resumen` DISABLE KEYS */;
INSERT INTO `resumen` VALUES (1,2019,1,276.29,184.8,150.62,310.47,1),(2,2019,2,310.47,0,0,0,0);
/*!40000 ALTER TABLE `resumen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Administrator','2019-05-04 10:02:15','2019-05-04 10:02:15'),(2,'user','Normal User','2019-05-04 10:02:15','2019-05-04 10:02:15');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `details` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'site.title','Site Title','Site Title','','text',1,'Site'),(2,'site.description','Site Description','Site Description','','text',2,'Site'),(3,'site.logo','Site Logo','','','image',3,'Site'),(4,'site.google_analytics_tracking_id','Google Analytics Tracking ID','','','text',4,'Site'),(5,'admin.bg_image','Admin Background Image','','','image',5,'Admin'),(6,'admin.title','Admin Title','Voyager','','text',1,'Admin'),(7,'admin.description','Admin Description','Welcome to Voyager. The Missing Admin for Laravel','','text',2,'Admin'),(8,'admin.loader','Admin Loader','','','image',3,'Admin'),(9,'admin.icon_image','Admin Icon Image','','','image',4,'Admin'),(10,'admin.google_analytics_client_id','Google Analytics Client ID (used for admin dashboard)','','','text',1,'Admin');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tarjeta`
--

DROP TABLE IF EXISTS `tarjeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tarjeta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idmiembro` int(11) DEFAULT NULL,
  `idactividad` int(11) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observacion` text COLLATE utf8mb4_unicode_ci,
  `despacho` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarjeta`
--

LOCK TABLES `tarjeta` WRITE;
/*!40000 ALTER TABLE `tarjeta` DISABLE KEYS */;
/*!40000 ALTER TABLE `tarjeta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) unsigned NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translations`
--

LOCK TABLES `translations` WRITE;
/*!40000 ALTER TABLE `translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_roles` (
  `user_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `user_roles_user_id_index` (`user_id`),
  KEY `user_roles_role_id_index` (`role_id`),
  CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Luis Mayta','luis.mayta@gmail.com','users/default.png',NULL,'$2y$10$1z6XUp7P3AslmA0tP3SjbeQYUVxxsHtN0cv3VQ4DULAfTmCrZFRI.',NULL,NULL,'2019-05-04 10:03:06','2019-05-04 10:03:07');
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

-- Dump completed on 2019-05-17  1:19:38

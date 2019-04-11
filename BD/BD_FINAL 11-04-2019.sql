CREATE DATABASE  IF NOT EXISTS `farmacia_te` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `farmacia_te`;
-- MySQL dump 10.13  Distrib 8.0.13, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: farmacia_te
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.30-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categoria_medicamento`
--

DROP TABLE IF EXISTS `categoria_medicamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `categoria_medicamento` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_nombre` varchar(60) NOT NULL,
  `cat_estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_nombre` (`cat_nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria_medicamento`
--

LOCK TABLES `categoria_medicamento` WRITE;
/*!40000 ALTER TABLE `categoria_medicamento` DISABLE KEYS */;
INSERT INTO `categoria_medicamento` VALUES (10,'Analgesicos',1),(11,'Antigripal',1),(12,'AntialÃ©rgicos',1),(13,'Antidiarreicos y laxantes',1),(14,'antiinfecciosos',1),(15,'antiinflamatorios',1);
/*!40000 ALTER TABLE `categoria_medicamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `cliente` (
  `cliente_id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_nombre` varchar(60) DEFAULT NULL,
  `cliente_apellido` varchar(60) DEFAULT NULL,
  `cliente_doc` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cliente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'Anonimo','Anonimo','000000000');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compra`
--

DROP TABLE IF EXISTS `compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `compra` (
  `compra_id` int(11) NOT NULL AUTO_INCREMENT,
  `compra_fecha` datetime NOT NULL,
  `compra_total` decimal(8,2) NOT NULL,
  PRIMARY KEY (`compra_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compra`
--

LOCK TABLES `compra` WRITE;
/*!40000 ALTER TABLE `compra` DISABLE KEYS */;
INSERT INTO `compra` VALUES (1,'2019-04-05 00:00:00',250.00),(2,'2019-04-06 00:00:00',25.00),(3,'2019-04-07 10:53:22',33.50),(4,'2019-04-11 11:09:58',11.00),(5,'2019-04-11 11:10:51',474.90),(6,'2019-04-11 11:11:14',7.50);
/*!40000 ALTER TABLE `compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_compra`
--

DROP TABLE IF EXISTS `detalle_compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `detalle_compra` (
  `det_compra_id` int(11) NOT NULL AUTO_INCREMENT,
  `med_id` int(11) DEFAULT NULL,
  `det_compra_cantidad` int(11) DEFAULT NULL,
  `det_compra_subtotal` decimal(8,2) DEFAULT NULL,
  `compra_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`det_compra_id`),
  KEY `fk_detalle_compra_compra_idx` (`compra_id`),
  KEY `fk_detalle_compra_medicamento_idx` (`med_id`),
  CONSTRAINT `fk_detalle_compra_compra` FOREIGN KEY (`compra_id`) REFERENCES `compra` (`compra_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_compra_medicamento` FOREIGN KEY (`med_id`) REFERENCES `medicamentos` (`med_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_compra`
--

LOCK TABLES `detalle_compra` WRITE;
/*!40000 ALTER TABLE `detalle_compra` DISABLE KEYS */;
INSERT INTO `detalle_compra` VALUES (1,1,400,200.00,1),(2,3,25,25.00,2),(3,3,67,33.50,3),(4,3,10,5.00,4),(5,1,15,6.00,4),(6,6,35,105.00,5),(7,7,5,15.00,5),(8,11,20,90.00,5),(9,12,10,249.90,5),(10,10,20,15.00,5),(11,8,15,3.75,6),(12,9,15,3.75,6);
/*!40000 ALTER TABLE `detalle_compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_venta`
--

DROP TABLE IF EXISTS `detalle_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `detalle_venta` (
  `det_venta_id` int(11) NOT NULL AUTO_INCREMENT,
  `med_id` int(11) DEFAULT NULL,
  `det_venta_cantidad` int(11) DEFAULT NULL,
  `det_venta_subtotal` decimal(8,2) DEFAULT NULL,
  `venta_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`det_venta_id`),
  KEY `fk_detalle_venta_venta_idx` (`venta_id`),
  KEY `fk_detalle_venta_medicamento_idx` (`med_id`),
  CONSTRAINT `fk_detalle_venta_medicamento` FOREIGN KEY (`med_id`) REFERENCES `medicamentos` (`med_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_venta_venta` FOREIGN KEY (`venta_id`) REFERENCES `venta` (`venta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_venta`
--

LOCK TABLES `detalle_venta` WRITE;
/*!40000 ALTER TABLE `detalle_venta` DISABLE KEYS */;
INSERT INTO `detalle_venta` VALUES (1,1,400,200.00,1),(2,3,25,25.00,1),(3,3,2,2.00,2),(9,1,2,1.00,7),(10,3,2,2.00,7),(11,NULL,NULL,NULL,7),(12,8,2,0.80,8),(13,9,5,2.00,8),(14,12,20,570.00,9),(15,12,20,570.00,10),(16,NULL,NULL,NULL,10),(17,4,50,175.00,11),(18,5,10,60.00,12);
/*!40000 ALTER TABLE `detalle_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `empleado` (
  `emp_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_nombre` varchar(60) NOT NULL,
  `emp_apellido` varchar(60) NOT NULL,
  `emp_fechaN` date DEFAULT NULL,
  `usr_id` int(11) DEFAULT NULL,
  `emp_estado` int(1) DEFAULT '1',
  PRIMARY KEY (`emp_id`),
  KEY `fk_empleado_usuario_idx` (`usr_id`),
  CONSTRAINT `fk_empleado_usuario` FOREIGN KEY (`usr_id`) REFERENCES `usuario` (`usr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES (1,'Osvaldo',' Pacheco','1997-10-23',5,1),(2,'Jose Ricardo','Sifontes','1997-10-10',7,1),(3,'Rodrigo','Viscarra','1996-12-12',6,1);
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicamentos`
--

DROP TABLE IF EXISTS `medicamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `medicamentos` (
  `med_id` int(11) NOT NULL AUTO_INCREMENT,
  `med_nombre` varchar(100) DEFAULT NULL,
  `med_stock` int(11) NOT NULL,
  `med_precioC` decimal(8,2) NOT NULL,
  `med_precioV` decimal(8,2) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `pre_id` int(11) DEFAULT NULL,
  `med_fechaV` date DEFAULT NULL,
  `med_estado` int(11) DEFAULT NULL,
  `med_img` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`med_id`),
  KEY `fk_mediacemnto_categoria_idx` (`cat_id`),
  KEY `fk_medicamento_presentacion_idx` (`pre_id`),
  CONSTRAINT `fk_mediacemento_categoria` FOREIGN KEY (`cat_id`) REFERENCES `categoria_medicamento` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_medicamento_presentacion` FOREIGN KEY (`pre_id`) REFERENCES `presentacion` (`pre_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicamentos`
--

LOCK TABLES `medicamentos` WRITE;
/*!40000 ALTER TABLE `medicamentos` DISABLE KEYS */;
INSERT INTO `medicamentos` VALUES (1,'Acetaminofen',166,0.40,0.50,10,1,'2020-02-02',1,'acetaminofen.jpg'),(3,'Panadol',93,0.50,1.00,10,1,'2020-10-10',1,'Panadol.jpg'),(4,'Bisolgrip',245,2.00,3.50,11,3,'2021-10-23',1,'bisolgrip.jpg'),(5,'Dexametasona',140,4.50,6.00,15,6,'2021-10-10',1,'dexametasona.jpg'),(6,'PeptoBismol',84,3.00,3.99,13,2,'2022-12-23',1,'81ZJtR4b9bL._SL1500_.jpg'),(7,'Alka Zeltzer',304,3.00,3.75,10,3,'2023-10-10',1,'alka.jpg'),(8,'Virogrip Dia',59,0.25,0.40,11,4,'2024-03-01',1,'252-43web-780x600.jpg'),(9,'Virogrip Noche',210,0.25,0.40,11,4,'2022-02-01',1,'Disp016-540x690.jpg'),(10,'Pomada La Campana',40,0.75,1.00,15,5,'2019-02-02',1,'900.jpg'),(11,'Anginovag',48,4.50,5.99,14,7,'2019-10-01',1,'anginovag-aerosol-20-ml.jpg'),(12,'Iprasynt',200,24.99,28.50,14,8,'2020-11-11',1,'17995_178x237.jpg');
/*!40000 ALTER TABLE `medicamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `presentacion`
--

DROP TABLE IF EXISTS `presentacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `presentacion` (
  `pre_id` int(11) NOT NULL AUTO_INCREMENT,
  `pre_nombre` varchar(60) NOT NULL,
  PRIMARY KEY (`pre_id`),
  UNIQUE KEY `pre_nombre` (`pre_nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `presentacion`
--

LOCK TABLES `presentacion` WRITE;
/*!40000 ALTER TABLE `presentacion` DISABLE KEYS */;
INSERT INTO `presentacion` VALUES (7,'Aerosoles'),(4,'CÃ¡psulas'),(8,'Inhalaciones'),(2,'Jarabe'),(3,'Polvos/comprimidos'),(5,'pomada/crema'),(6,'Soluciones'),(1,'Tableta');
/*!40000 ALTER TABLE `presentacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `usuario` (
  `usr_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_nombre` varchar(60) DEFAULT NULL,
  `usr_password` varchar(60) DEFAULT NULL,
  `usr_tipo` int(11) DEFAULT NULL,
  `usr_estado` int(1) DEFAULT '1',
  `usr_img` varchar(150) DEFAULT NULL,
  `usr_email` varchar(150) NOT NULL,
  PRIMARY KEY (`usr_id`),
  UNIQUE KEY `usr_nombre` (`usr_nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (4,'pedro','$2y$12$QBDR7EDPQM2frZuWYDXHdeVpaR0oKFmj7w0jiAa6iS.87Bjx9x7ju',2,0,'','pedropacheco1523503@gmail.com'),(5,'admin','$2y$12$IH8Z1viI1ufT11jCLeUjhuRPaEoxOpSoFIAhYlcYyl9v2EkpCVIPK',1,1,'camisa1.jpg','admin@gmail.com'),(6,'viscarra','$2y$12$MQDISVB3kkg7CRMGoojwSOAze97SP6m6Mo3z6oh6HjxU7A6G4mibu',2,1,'camisa2.jpg','viscarra@gmail.com'),(7,'empleado','$2y$12$jWuKMcx9eBuTJfv6Ary7Aewu3PJeA8I2QkAetL1Z2uY72ZyISLNfO',2,1,'empleado1.jpg','emp123@gmail.com');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta`
--

DROP TABLE IF EXISTS `venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `venta` (
  `venta_fecha` datetime DEFAULT NULL,
  `venta_total` decimal(8,2) DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `venta_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`venta_id`),
  KEY `fk_venta_empleado_idx` (`emp_id`),
  CONSTRAINT `fk_venta_empleado` FOREIGN KEY (`emp_id`) REFERENCES `empleado` (`emp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta`
--

LOCK TABLES `venta` WRITE;
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
INSERT INTO `venta` VALUES ('2019-04-05 00:00:00',225.00,1,1),('2019-04-05 00:00:00',2.00,1,2),('2019-04-11 15:03:18',3.00,1,7),('2019-04-11 15:04:35',2.80,1,8),('2019-04-11 15:06:27',570.00,1,9),('2019-04-11 15:06:35',570.00,1,10),('2019-04-11 15:08:40',175.00,1,11),('2019-04-11 15:09:25',60.00,2,12);
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'farmacia_te'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-11 15:17:59

CREATE DATABASE  IF NOT EXISTS `my_reader` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `my_reader`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: my_reader
-- ------------------------------------------------------
-- Server version	5.5.23

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
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_subscription` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `content` longblob,
  `is_read` char(1) DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_UNIQUE` (`site`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptions`
--

LOCK TABLES `subscriptions` WRITE;
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
INSERT INTO `subscriptions` VALUES (1,'http://arquiteturadeinformacao.com/feed/','Arquitetura de Informação'),(4,'http://feeds.feedburner.com/gizmodobr','Gizmodo'),(6,'http://blog.marlonpacheco.com.br/feed/','Marlon Blog'),(7,'http://www.cogumelolouco.com/feed/',':::Cogumelo Louco:::'),(8,'http://autozine.com.br/feed/','Autozine'),(9,'http://feeds2.feedburner.com/baconfrito','baconfrito'),(10,'http://feeds.feedburner.com/contraditorium','Blog do Cardoso'),(11,'http://feeds.feedburner.com/bobagento','Bobagento'),(13,'http://www.caixapretta.com.br/feed/','Caixa PreTTa - Humor, polêmica e um pouco de informação!'),(14,'http://feeds.feedburner.com/capinaremos','Capinaremos Blog'),(15,'http://feedproxy.google.com/Ceticismonet','Ceticismo.net'),(16,'http://feeds.feedburner.com/Copicola','Copi Cola'),(18,'http://feeds.feedburner.com/Danossecom','Danosse.COM - Baixando sua produtividade!'),(19,'http://feeds.feedburner.com/digitaldrops','Digital Drops'),(20,'http://feeds.feedburner.com/drpepper','DrPepper.com.br'),(21,'http://www.efetividade.net/feed/','Efetividade'),(22,'http://feeds.feedburner.com/elmicox','El Micox'),(23,'http://elatadexico.blogspot.com/feeds/posts/default','Ela tá de Xico'),(26,'http://feeds.feedburner.com/FechaTag','fechaTag'),(27,'http://feedproxy.google.com/googlediscovery','Google Discovery'),(28,'http://blog.guilhermegarnier.com/feed/','Guilherme Garnier'),(30,'http://feeds.feedburner.com/HojeUmBomDia','Hoje é um Bom Dia'),(31,'http://feeds.feedburner.com/IgorEscobar/Blog','Igor Escobar'),(32,'http://www.insoonia.com/feed','Blog Insôônia - Humor & Entretenimento'),(33,'http://feeds.feedburner.com/Lista10','Feed Lista 10'),(34,'http://www.meiobit.com/index.xml','Meio Bit » Meio Bit'),(37,'http://mentirinhas.com.br/feed/','Mentirinhas'),(38,'http://feeds.feedburner.com/MotosBlog','Motos Blog'),(41,'http://feeds.feedburner.com/ofimdavarzea','#FKDK'),(42,'http://feeds2.feedburner.com/OVersoDoInverso','O verso do Inverso'),(43,'http://feeds.feedburner.com/PapodehomemLifestyleMagazine','Papo de Homem - Lifestyle Magazine'),(44,'http://feeds.feedburner.com/pinceladasdaweb','Pinceladas da Web - XHTML, CSS, JavaScript e WebStandards'),(45,'http://feeds.feedburner.com/tableless','Tableless.com.br - Web Standards com Arroz e Feijão'),(46,'http://feeds.feedburner.com/techguru_brazil','TechGuru.com.br'),(47,'http://feeds.feedburner.com/tecnoblog','Tecnoblog'),(48,'http://feeds.feedburner.com/wordpress/bRnj','Testosterona'),(49,'http://feeds.feedburner.com/treta','((( TRETA )))'),(50,'http://www.umsabadoqualquer.com/feed/','Um Sábado Qualquer'),(51,'http://vidadeprogramador.com.br/feed/',''),(52,'http://vidadesuporte.com.br/feed/','Vida de Suporte'),(53,'http://www.naointendo.com.br/feed/','Não Intendo');
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-07-02 14:04:49

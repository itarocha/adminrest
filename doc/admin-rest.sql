CREATE DATABASE  IF NOT EXISTS `adminrest` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `adminrest`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: adminrest
-- ------------------------------------------------------
-- Server version	5.6.32-log

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
-- Table structure for table `acao`
--

DROP TABLE IF EXISTS `acao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acao` (
  `id_acao` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `descricao` varchar(32) NOT NULL COMMENT 'Nome',
  PRIMARY KEY (`id_acao`),
  UNIQUE KEY `acao_un01` (`descricao`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acao`
--

LOCK TABLES `acao` WRITE;
/*!40000 ALTER TABLE `acao` DISABLE KEYS */;
INSERT INTO `acao` VALUES (1,'Acessar'),(3,'Alterar'),(6,'EnviarEmail'),(4,'Excluir'),(2,'Incluir');
/*!40000 ALTER TABLE `acao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `nome` varchar(100) NOT NULL COMMENT 'Nome',
  PRIMARY KEY (`id_empresa`),
  KEY `empresa_idx01` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filial`
--

DROP TABLE IF EXISTS `filial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `filial` (
  `id_filial` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `id_empresa` int(11) NOT NULL COMMENT 'Id Empresa',
  `nome` varchar(100) NOT NULL COMMENT 'Nome',
  PRIMARY KEY (`id_filial`),
  UNIQUE KEY `filial_un001` (`nome`),
  KEY `filial_idx01` (`nome`),
  KEY `filial_fk001_idx` (`id_empresa`),
  CONSTRAINT `filial_fk001` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filial`
--

LOCK TABLES `filial` WRITE;
/*!40000 ALTER TABLE `filial` DISABLE KEYS */;
/*!40000 ALTER TABLE `filial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo_usuario`
--

DROP TABLE IF EXISTS `grupo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo_usuario` (
  `id_grupo_usuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `descricao` varchar(64) NOT NULL COMMENT 'Nome',
  PRIMARY KEY (`id_grupo_usuario`),
  KEY `grupo_usuario_idx01` (`descricao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo_usuario`
--

LOCK TABLES `grupo_usuario` WRITE;
/*!40000 ALTER TABLE `grupo_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `grupo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo_usuario_tarefa`
--

DROP TABLE IF EXISTS `grupo_usuario_tarefa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo_usuario_tarefa` (
  `id_grupo_usuario_tarefa` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `id_grupo_usuario` int(11) NOT NULL COMMENT 'Grupo do usuário',
  `id_tarefa_acao` int(11) NOT NULL COMMENT 'Ação da Tarefa',
  PRIMARY KEY (`id_grupo_usuario_tarefa`),
  UNIQUE KEY `grupo_usuario_tarefa_un01` (`id_grupo_usuario`,`id_tarefa_acao`),
  KEY `grupo_usuario_tarefa_idx01` (`id_grupo_usuario`),
  KEY `grupo_usuario_tarefa_idx02` (`id_tarefa_acao`),
  CONSTRAINT `grupo_usuario_tarefa_fk01` FOREIGN KEY (`id_grupo_usuario`) REFERENCES `grupo_usuario` (`id_grupo_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `grupo_usuario_tarefa_fk02` FOREIGN KEY (`id_tarefa_acao`) REFERENCES `tarefa_acao` (`id_tarefa_acao`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo_usuario_tarefa`
--

LOCK TABLES `grupo_usuario_tarefa` WRITE;
/*!40000 ALTER TABLE `grupo_usuario_tarefa` DISABLE KEYS */;
/*!40000 ALTER TABLE `grupo_usuario_tarefa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissao_usuario`
--

DROP TABLE IF EXISTS `permissao_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissao_usuario` (
  `id_permissao_usuario` int(11) NOT NULL COMMENT 'Id',
  `id_usuario` int(11) NOT NULL COMMENT 'Usuário',
  `id_filial` int(11) NOT NULL,
  `id_tarefa_acao` int(11) NOT NULL COMMENT 'Ação de Tarefa',
  PRIMARY KEY (`id_permissao_usuario`),
  UNIQUE KEY `permissao_usuario_un01` (`id_usuario`,`id_filial`,`id_tarefa_acao`),
  KEY `permissao_usuario_idx01` (`id_usuario`),
  KEY `permissao_usuario_idx03` (`id_tarefa_acao`),
  KEY `permissao_usuario_idx04` (`id_tarefa_acao`),
  KEY `permissao_usuario_fk02_idx` (`id_filial`),
  CONSTRAINT `permissao_usuario_fk01` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `permissao_usuario_fk02` FOREIGN KEY (`id_filial`) REFERENCES `filial` (`id_filial`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `permissao_usuario_fk03` FOREIGN KEY (`id_tarefa_acao`) REFERENCES `tarefa_acao` (`id_tarefa_acao`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissao_usuario`
--

LOCK TABLES `permissao_usuario` WRITE;
/*!40000 ALTER TABLE `permissao_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissao_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tarefa`
--

DROP TABLE IF EXISTS `tarefa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tarefa` (
  `id_tarefa` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `descricao` varchar(128) NOT NULL COMMENT 'Nome',
  `view` varchar(128) NOT NULL COMMENT 'View - Caminho/Form da tarefa',
  PRIMARY KEY (`id_tarefa`),
  KEY `tarefa_un01` (`descricao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarefa`
--

LOCK TABLES `tarefa` WRITE;
/*!40000 ALTER TABLE `tarefa` DISABLE KEYS */;
/*!40000 ALTER TABLE `tarefa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tarefa_acao`
--

DROP TABLE IF EXISTS `tarefa_acao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tarefa_acao` (
  `id_tarefa_acao` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `id_tarefa` int(11) NOT NULL COMMENT 'Id Tarefa',
  `id_acao` int(11) NOT NULL COMMENT 'Id Ação',
  PRIMARY KEY (`id_tarefa_acao`),
  KEY `tarefa_acao_idx01_idx` (`id_tarefa`),
  KEY `tarefa_acao_idx02_idx` (`id_acao`),
  CONSTRAINT `tarefa_acao_idx01` FOREIGN KEY (`id_tarefa`) REFERENCES `tarefa` (`id_tarefa`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `tarefa_acao_idx02` FOREIGN KEY (`id_acao`) REFERENCES `acao` (`id_acao`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarefa_acao`
--

LOCK TABLES `tarefa_acao` WRITE;
/*!40000 ALTER TABLE `tarefa_acao` DISABLE KEYS */;
/*!40000 ALTER TABLE `tarefa_acao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `nome` varchar(64) NOT NULL COMMENT 'Nome',
  `login` varchar(32) NOT NULL COMMENT 'Login',
  `senha` varchar(64) NOT NULL COMMENT 'Senha',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuario_un01` (`login`),
  KEY `usuario_idx01` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-25 13:25:42

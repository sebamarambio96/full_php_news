CREATE DATABASE  IF NOT EXISTS `proyecto_m3` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `proyecto_m3`;
-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: proyecto_m3
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `info_pagina`
--

DROP TABLE IF EXISTS `info_pagina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `info_pagina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_pagina`
--

LOCK TABLES `info_pagina` WRITE;
/*!40000 ALTER TABLE `info_pagina` DISABLE KEYS */;
INSERT INTO `info_pagina` VALUES (1,'Bienvenidos a Ipp News','Un portal de noticias confiable.'),(2,'Sobre Nosotros','Somos un equipo apasionado por el periodismo digital.'),(3,'Contacto','Para consultas, escríbenos a contacto@example.com.'),(4,'Términos y Condiciones','Revisa nuestras políticas de uso y privacidad.'),(5,'Noticias Recientes','Mantente al día con nuestras publicaciones diarias.'),(6,'Anuncios','Descubre nuestros próximos eventos y colaboraciones.');
/*!40000 ALTER TABLE `info_pagina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `noticias`
--

DROP TABLE IF EXISTS `noticias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `noticias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `contenido` text NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `fecha_publicacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `autor` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticias`
--

LOCK TABLES `noticias` WRITE;
/*!40000 ALTER TABLE `noticias` DISABLE KEYS */;
INSERT INTO `noticias` VALUES (1,'Lanzamiento de un nuevo satélite','La NASA ha anunciado el lanzamiento de su nuevo satélite para estudiar el cambio climático. Este satélite se lanzará desde Cabo Cañaveral la próxima semana.','/public/assets/img/satelite2.jpg','2024-11-29 00:09:22','Carlos Gómez'),(2,'Sorprendente descubrimiento en Marte','Un equipo de científicos encontró rastros de agua congelada en Marte, lo que aumenta las esperanzas de establecer una base humana en el planeta rojo.','/public/assets/img/marte.jpg','2024-11-29 00:09:22','Lucía Sánchez Sandoval'),(3,'Evento masivo en la ciudad','La Feria de Tecnología del Futuro atrajo a más de 50,000 personas este fin de semana. Los asistentes pudieron experimentar con dispositivos de realidad virtual y robots.','/public/assets/img/feria.jpg','2024-11-29 00:09:22','Roberto Fernández'),(4,'Innovación en energías renovables','Un nuevo panel solar ultraligero promete revolucionar la forma en que capturamos y almacenamos energía solar.','/public/assets/img/energia.jpg','2024-11-29 00:09:22','Laura Pérez'),(5,'Avance médico contra el cáncer','Investigadores han desarrollado un tratamiento que podría ser clave en la lucha contra el cáncer.','/public/assets/img/medicina.jpg','2024-11-29 00:09:22','Andrés Molina'),(6,'Economía en crecimiento','Los últimos reportes económicos indican un crecimiento estable en varios sectores industriales.','/public/assets/img/economia.jpg','2024-11-29 00:09:22','Sofía López');
/*!40000 ALTER TABLE `noticias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nombre_completo` varchar(100) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_nacimiento` date DEFAULT '2000-01-01',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'admin','$2y$10$HashParaAdmin','admin@example.com','Administrador General','2024-11-29 00:09:22','2000-01-01'),(2,'usuario1','$2y$10$HashParaUsuario1','usuario1@example.com','Juan Pérez','2024-11-29 00:09:22','2000-01-01'),(3,'usuario2','$2y$10$HashParaUsuario2','usuario2@example.com','Ana González','2024-11-29 00:09:22','2000-01-01'),(4,'usuario3','$2y$10$HashParaUsuario3','usuario3@example.com','Luis Ramírez','2024-11-29 00:09:22','2000-01-01'),(5,'usuario4','$2y$10$HashParaUsuario4','usuario4@example.com','María Fernández','2024-11-29 00:09:22','2000-01-01'),(6,'usuario5','$2y$10$HashParaUsuario5','usuario5@example.com','Pedro López','2024-11-29 00:09:22','2000-01-01'),(8,'root','$2y$10$SzHQ8M9ky8I3IQoG75jrAO.LhNwgqWvSrFgE/urHvb8sLu9OQoza6','admin@admin.cl',NULL,'2024-11-29 00:15:03','2000-01-01'),(10,'admin2','$2y$10$M5X5.C5QhIbX40e0jnzdve1sMFDrx3ttHi6pxTLFp3Q6Q5xkIxC0.','admin2@admin2.cl','Seba','2024-12-08 15:10:12','2000-01-01'),(11,'adminMenor','$2y$10$EduIdPRm9.qZ/7YxLKM9pOJuxnUWXPETYDvs1eiWjKprDb8FlYqMu','adminMenor@adminMenor.cl','adminMenor','2024-12-08 20:22:30','2024-10-09');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-08 18:05:52

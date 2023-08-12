-- MySQL dump 10.13  Distrib 8.0.33, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: project-management-system
-- ------------------------------------------------------
-- Server version	8.0.33-0ubuntu0.20.04.2

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
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2023_08_10_052047_add_role_to_users_table',2),(6,'2023_08_10_131907_create_projects_table',3),(9,'2023_08_10_131918_create_project_user_table',5),(11,'2023_08_10_131926_create_tasks_table',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (1,'App\\Models\\User',1,'authToken','77c40a07e2522885c3c96d3242bcda7ed4387afafd8d363830bd082a9645b5d8','[\"*\"]',NULL,NULL,'2023-08-10 03:09:45','2023-08-10 03:09:45'),(2,'App\\Models\\User',1,'authToken','a2f14817c6d9be0651e62af222d2b42d7d118eb33ebcd5aa2b689cfed140a6c6','[\"*\"]',NULL,NULL,'2023-08-10 03:11:07','2023-08-10 03:11:07'),(3,'App\\Models\\User',1,'authToken','03964a37d702aa99f4a4ac780fd641f1515bda4abb2ded84f4e7b25893e8066c','[\"*\"]',NULL,NULL,'2023-08-10 09:08:48','2023-08-10 09:08:48'),(4,'App\\Models\\User',2,'authToken','87f21b9c41a37ed12d3cd73078fa51c93171d5d277ad9cc6a1997ae3dfb71d94','[\"*\"]',NULL,NULL,'2023-08-10 09:09:02','2023-08-10 09:09:02'),(5,'App\\Models\\User',1,'authToken','69bceef215d7506db0124b4c16cad09e9749652c20afb7273bd1b7138a7c7962','[\"*\"]',NULL,NULL,'2023-08-10 21:53:56','2023-08-10 21:53:56'),(6,'App\\Models\\User',1,'authToken','ba9f04cbbb80aa269eadaa44de0a10ff12387103d5de28ca007776b977d30695','[\"*\"]',NULL,NULL,'2023-08-11 08:22:41','2023-08-11 08:22:41'),(7,'App\\Models\\User',1,'authToken','cf78cf6d6d0f25939e2290ed1c70c967ad3ea207229b493cd4bb730dd88cbcb9','[\"*\"]',NULL,NULL,'2023-08-11 20:33:41','2023-08-11 20:33:41'),(8,'App\\Models\\User',2,'authToken','2481c45a01dcb8e8d3b31194923316f574da13fd2bddc491678813007a484247','[\"*\"]',NULL,NULL,'2023-08-12 01:22:46','2023-08-12 01:22:46'),(9,'App\\Models\\User',2,'authToken','665e94da27cf6028c5abaaea147701424e5f37090688e154af7ad73d16be25b4','[\"*\"]',NULL,NULL,'2023-08-12 01:28:23','2023-08-12 01:28:23'),(10,'App\\Models\\User',2,'authToken','9f4c39ecf4c1463d611fdaba9957fe21e8d4d667bc84fe61076e6a0a50d7067c','[\"*\"]',NULL,NULL,'2023-08-12 01:31:08','2023-08-12 01:31:08'),(11,'App\\Models\\User',2,'authToken','c387dc88f3e615fc07ff1c369be16ff90a5ef83988fdd165fe603d3d7e47573c','[\"*\"]',NULL,NULL,'2023-08-12 01:33:19','2023-08-12 01:33:19'),(12,'App\\Models\\User',1,'authToken','2103ec1d25fc4aa05dd58b23e96f9bf24bcbf7a34e460c5b5d8a9e881d9a60b7','[\"*\"]',NULL,NULL,'2023-08-12 01:35:00','2023-08-12 01:35:00'),(13,'App\\Models\\User',2,'authToken','2a6b8de36f57860a86ac9e552646cd7f37ba90f35285f18160af1449741cab4b','[\"*\"]',NULL,NULL,'2023-08-12 01:35:09','2023-08-12 01:35:09'),(14,'App\\Models\\User',1,'authToken','f474c52a53cf98eca7a9a089d5b43e1c5480eb7314ec13815a83ec5bd9293015','[\"*\"]',NULL,NULL,'2023-08-12 01:40:24','2023-08-12 01:40:24'),(15,'App\\Models\\User',2,'authToken','8747843735cc9d2a3f1baeabacd9fd0ae9d885883bc486a416225263725ec0bc','[\"*\"]',NULL,NULL,'2023-08-12 01:40:33','2023-08-12 01:40:33'),(16,'App\\Models\\User',1,'authToken','df0d71e2766512e09f02b4cadefee22c868b41befa61bea1f739b77128f72a2e','[\"*\"]',NULL,NULL,'2023-08-12 01:45:10','2023-08-12 01:45:10'),(17,'App\\Models\\User',11,'authToken','b5cea38b7adfdacd81a154c48baa110a1cf62e6210155fc2b4457b5807d0fcfe','[\"*\"]',NULL,NULL,'2023-08-12 01:45:34','2023-08-12 01:45:34'),(18,'App\\Models\\User',1,'authToken','db89e3d230321495736a35680177fdde85cf380954af0f1f4d821d537acdc153','[\"*\"]',NULL,NULL,'2023-08-12 02:04:29','2023-08-12 02:04:29'),(19,'App\\Models\\User',2,'authToken','42fd77b0dc6c5f215c18b9534a3228bf073c08ff9dab18156dfb0c6b1b97029c','[\"*\"]',NULL,NULL,'2023-08-12 02:04:54','2023-08-12 02:04:54'),(20,'App\\Models\\User',11,'authToken','7f34aafafb688d7b8506d4482b4fc70d93de0c13e0084963fbaa7c19bbc9522e','[\"*\"]',NULL,NULL,'2023-08-12 02:05:06','2023-08-12 02:05:06'),(21,'App\\Models\\User',1,'authToken','22379c46418707e08aaf467d2db19b63f8b11bce793a283bd7f1aba915c8266f','[\"*\"]',NULL,NULL,'2023-08-12 02:05:15','2023-08-12 02:05:15'),(22,'App\\Models\\User',11,'authToken','93445b782cf2c5ebb17eddcd22c193100960c9a5c9814b1acc94ad4b81bb3fcd','[\"*\"]',NULL,NULL,'2023-08-12 02:05:47','2023-08-12 02:05:47'),(23,'App\\Models\\User',1,'authToken','b2ec2e97a5a1e5f8cbbfdbad404ab45469e8751b959079f61cecc1c3bf089811','[\"*\"]',NULL,NULL,'2023-08-12 02:51:48','2023-08-12 02:51:48'),(24,'App\\Models\\User',1,'authToken','990a9b86f774f5d06d0524b3693a0bc036154cbb1e6ab3871e88472f72b0cec7','[\"*\"]',NULL,NULL,'2023-08-12 02:56:10','2023-08-12 02:56:10'),(25,'App\\Models\\User',2,'authToken','0a98f8c73c455d6af3f590699ac0cc8df8d74d22d6c77e7e4cfd6bbe4e61adbd','[\"*\"]',NULL,NULL,'2023-08-12 02:56:18','2023-08-12 02:56:18'),(26,'App\\Models\\User',2,'authToken','aa4078651ac28b776c4b970ebf377dccc3727a747dd003c040689f966a66278f','[\"*\"]',NULL,NULL,'2023-08-12 02:58:28','2023-08-12 02:58:28'),(27,'App\\Models\\User',1,'authToken','a9e5d95f853d942003a72dfde209b0237449e1b048b6d7067454677283b75c79','[\"*\"]',NULL,NULL,'2023-08-12 02:58:44','2023-08-12 02:58:44'),(28,'App\\Models\\User',2,'authToken','c4fc6fb717de7bd68d009fcfb02d681e316ad25fb3c2357b0d25d95224c25a16','[\"*\"]',NULL,NULL,'2023-08-12 02:59:47','2023-08-12 02:59:47'),(29,'App\\Models\\User',1,'authToken','a8c7f62d624e28e13038b60d6770e59ea5a561a8c8109789d79badf647603832','[\"*\"]',NULL,NULL,'2023-08-12 03:09:08','2023-08-12 03:09:08'),(30,'App\\Models\\User',2,'authToken','79389d8bd9fd95dcb7b2172631165f90b9fdd6288fc570490015b6c832a2648a','[\"*\"]',NULL,NULL,'2023-08-12 03:09:42','2023-08-12 03:09:42'),(31,'App\\Models\\User',1,'authToken','27052fe3fc51185c2a454d98cb728bf6140d979696ff7f08cf51ca16e5ae61d2','[\"*\"]',NULL,NULL,'2023-08-12 03:11:33','2023-08-12 03:11:33'),(32,'App\\Models\\User',2,'authToken','8a467f6aedb77f5660a63d80add4c0fa877b943c8a7762895887ce377db0385f','[\"*\"]',NULL,NULL,'2023-08-12 03:12:05','2023-08-12 03:12:05'),(33,'App\\Models\\User',1,'authToken','95a568f5b85dfa2a50d1b05e1897609aa45e5e640164c591ceb05e2652c32ca2','[\"*\"]',NULL,NULL,'2023-08-12 03:29:24','2023-08-12 03:29:24'),(34,'App\\Models\\User',1,'authToken','97ae861dbd8eb60c6f61bdc57eed6798b1de592e09477da6110c5924c5a85205','[\"*\"]',NULL,NULL,'2023-08-12 03:29:55','2023-08-12 03:29:55'),(35,'App\\Models\\User',2,'authToken','52cb467714fddde9bd162d18a899db7dd1748bf1020ffed465c6b8ab4276b3f6','[\"*\"]',NULL,NULL,'2023-08-12 03:30:06','2023-08-12 03:30:06'),(36,'App\\Models\\User',11,'authToken','3a2adbc2f8ada57ee55bf4862c97dc0020a27d679566a8320b9ed21fed61a671','[\"*\"]',NULL,NULL,'2023-08-12 03:34:53','2023-08-12 03:34:53'),(37,'App\\Models\\User',10,'authToken','855f3bb0ae22436f9728ea0728a627a0261b2ac460119b17e8131720dc9107cc','[\"*\"]',NULL,NULL,'2023-08-12 03:35:44','2023-08-12 03:35:44'),(38,'App\\Models\\User',1,'authToken','279fc3c71e6d7ff3b6c732a31dc5bb9a08dee99a4dd98c67de340a6b82496154','[\"*\"]',NULL,NULL,'2023-08-12 04:10:27','2023-08-12 04:10:27'),(39,'App\\Models\\User',1,'authToken','17da97aedd358f56959613439baa5622e5d74e36f6f8a44e1e65b23560dda9d0','[\"*\"]',NULL,NULL,'2023-08-12 06:46:27','2023-08-12 06:46:27'),(40,'App\\Models\\User',1,'authToken','7e6c1c1de2aa6e54274a8c1af599aa3b8d069a500ffaaf49927bc3efc0cf29ad','[\"*\"]',NULL,NULL,'2023-08-12 06:46:43','2023-08-12 06:46:43'),(41,'App\\Models\\User',2,'authToken','aa8af44699144cb4cf3cff53977acff9420178fa8673716fa57eb9bfb63da930','[\"*\"]',NULL,NULL,'2023-08-12 06:46:54','2023-08-12 06:46:54'),(42,'App\\Models\\User',2,'authToken','e4a4fc5b49507135e9c32a0ecbdd5e6a9024bc0ba2a62435cc4afbe1c045f3d1','[\"*\"]',NULL,NULL,'2023-08-12 06:47:05','2023-08-12 06:47:05'),(43,'App\\Models\\User',2,'authToken','05d65dd18252964dcbb5aa5da3679274fef1fab1fe45e5f297eff6b2dab4456c','[\"*\"]',NULL,NULL,'2023-08-12 06:53:52','2023-08-12 06:53:52'),(44,'App\\Models\\User',2,'authToken','91a5f24bbeb7424a872a714bcc5d42f494c64ac5012c5eda9c8eda8e029affc5','[\"*\"]',NULL,NULL,'2023-08-12 06:53:54','2023-08-12 06:53:54'),(45,'App\\Models\\User',1,'authToken','7d85374ebb7b3d1a3795b5c99f03ad9f1ecce0b2c6eefaed15b8782433e111c0','[\"*\"]',NULL,NULL,'2023-08-12 07:01:15','2023-08-12 07:01:15'),(46,'App\\Models\\User',1,'authToken','d96c8ee0ddbb11c3df5936ff7052158fb831418eb08548b04bb673926afc9cfd','[\"*\"]',NULL,NULL,'2023-08-12 07:01:32','2023-08-12 07:01:32'),(47,'App\\Models\\User',2,'authToken','121c4db5b7bbb515db48106bcc66cd987a85e2f4950f3b377dcc846237e02773','[\"*\"]',NULL,NULL,'2023-08-12 07:02:08','2023-08-12 07:02:08'),(48,'App\\Models\\User',3,'authToken','76eec932c895b658f312d1d21e8fb3209c8b3361048d23d79abe52181eaa2037','[\"*\"]',NULL,NULL,'2023-08-12 07:03:20','2023-08-12 07:03:20'),(49,'App\\Models\\User',1,'authToken','fa92497f782e56419e52614482cb95ab1331fb7f176ca652ae48167f93090d29','[\"*\"]',NULL,NULL,'2023-08-12 07:03:40','2023-08-12 07:03:40'),(50,'App\\Models\\User',2,'authToken','dd7e27e91b5dd8ef88dda4ac9dc73485453ce957befbf4cb377dbb773a585415','[\"*\"]',NULL,NULL,'2023-08-12 07:04:55','2023-08-12 07:04:55'),(51,'App\\Models\\User',3,'authToken','c9dd004447b06cd68c355070955c61b67f883bfbe77f403f3e34f849caa5e997','[\"*\"]',NULL,NULL,'2023-08-12 07:08:36','2023-08-12 07:08:36');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_user`
--

DROP TABLE IF EXISTS `project_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint unsigned NOT NULL,
  `team_member_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_user`
--

LOCK TABLES `project_user` WRITE;
/*!40000 ALTER TABLE `project_user` DISABLE KEYS */;
INSERT INTO `project_user` VALUES (1,1,2,'2023-08-12 07:04:01','2023-08-12 07:04:01'),(2,2,2,'2023-08-12 07:04:10','2023-08-12 07:04:10'),(3,2,3,'2023-08-12 07:04:10','2023-08-12 07:04:10'),(4,3,3,'2023-08-12 07:04:17','2023-08-12 07:04:17');
/*!40000 ALTER TABLE `project_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'Test Project 1','Test Project 1','2023-08-12 07:04:01','2023-08-12 07:04:01',NULL),(2,'Test Project 2','Test Project 2','2023-08-12 07:04:10','2023-08-12 07:04:10',NULL),(3,'Test Project 3','Test Project 3','2023-08-12 07:04:17','2023-08-12 07:04:17',NULL);
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tasks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint unsigned NOT NULL,
  `assigned_by` bigint unsigned NOT NULL,
  `assigned_to` bigint unsigned NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` date NOT NULL,
  `progress` text COLLATE utf8mb4_unicode_ci,
  `is_completed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (1,1,1,2,'Test Description','1','2023-08-29','This feature has been pushed.',1,'2023-08-12 07:05:20','2023-08-12 07:07:06',NULL),(2,1,1,2,'Test Description 1234','2','2023-08-23',NULL,0,'2023-08-12 07:06:05','2023-08-12 07:06:18',NULL),(3,3,1,3,'Test Task','3','2023-08-22',NULL,0,'2023-08-12 07:09:04','2023-08-12 07:09:04',NULL);
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Test Manager 1','manager1@test.com',NULL,'$2y$10$8yvKlBx/VKlnpCWW72vBWuu.FKUoZR49NGlVs5EnPWS3rbE.Lyv8G',NULL,'2023-08-12 07:01:08','2023-08-12 07:01:08',1,NULL),(2,'Karthik','karthiknykb@gmail.com',NULL,'$2y$10$h14oTkf9SxcY0U3ETn8hTu25nYTdADan4cbJbJ8ZjUuIO0SQ8ZTXi',NULL,'2023-08-12 07:02:04','2023-08-12 07:02:04',2,NULL),(3,'Test Team Member','team.member1@test.com',NULL,'$2y$10$PIXYQX5CIaJA/tMMCrNbeO4QcCziYahijWJkP1xv9BBxfvMInvFYm',NULL,'2023-08-12 07:03:07','2023-08-12 07:03:07',2,NULL);
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

-- Dump completed on 2023-08-12 18:10:11

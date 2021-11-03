-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: main
-- ------------------------------------------------------
-- Server version	8.0.27

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
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `author`
(
    `id`                     int                                     NOT NULL AUTO_INCREMENT,
    `name`                   varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `creation_date`          datetime                                NOT NULL,
    `last_modification_date` datetime DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author`
--

LOCK
TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author`
VALUES (1, 'Louis Hui', '2021-10-30 00:00:00', NULL),
       (2, 'Louisa Reyes', '2021-10-30 00:00:00', NULL),
       (3, 'Sam Johnson', '2021-10-30 00:00:00', NULL),
       (4, 'Aitor Corrales', '2021-11-03 17:17:22', NULL),
       (5, 'Sandra Nogal', '2021-11-03 17:18:27', NULL),
       (6, 'Josh Green', '2021-11-03 17:22:29', NULL),
       (7, 'Jennifer Burg', '2021-11-03 17:26:04', NULL);
/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `book`
(
    `id`                     int      NOT NULL AUTO_INCREMENT,
    `creation_date`          datetime NOT NULL,
    `last_modification_date` datetime DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book`
--

LOCK
TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book`
VALUES (1, '2021-10-30 00:00:00', NULL),
       (2, '2021-10-30 00:00:00', NULL),
       (3, '2021-10-30 00:00:00', NULL),
       (4, '2021-10-30 00:00:00', NULL),
       (5, '2021-10-30 00:00:00', NULL),
       (9, '2021-11-01 20:25:21', NULL),
       (10, '2021-11-02 20:39:53', NULL),
       (11, '2021-11-02 20:45:50', NULL),
       (13, '2021-11-03 00:08:58', NULL),
       (14, '2021-11-03 09:39:22', NULL),
       (15, '2021-11-03 12:42:29', NULL),
       (16, '2021-11-03 15:48:11', NULL),
       (17, '2021-11-03 17:19:45', NULL);
/*!40000 ALTER TABLE `book` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `book_author`
--

DROP TABLE IF EXISTS `book_author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `book_author`
(
    `book_id`   int NOT NULL,
    `author_id` int NOT NULL,
    PRIMARY KEY (`book_id`, `author_id`),
    KEY         `IDX_9478D34516A2B381` (`book_id`),
    KEY         `IDX_9478D345F675F31B` (`author_id`),
    CONSTRAINT `FK_9478D34516A2B381` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE,
    CONSTRAINT `FK_9478D345F675F31B` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_author`
--

LOCK
TABLES `book_author` WRITE;
/*!40000 ALTER TABLE `book_author` DISABLE KEYS */;
INSERT INTO `book_author`
VALUES (1, 2),
       (2, 1),
       (3, 1),
       (4, 3),
       (5, 3),
       (15, 1),
       (15, 2),
       (16, 1),
       (16, 2),
       (17, 5);
/*!40000 ALTER TABLE `book_author` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `book_edition`
--

DROP TABLE IF EXISTS `book_edition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `book_edition`
(
    `id`                     int      NOT NULL AUTO_INCREMENT,
    `book_id`                int      NOT NULL,
    `editorial_id`           int      NOT NULL,
    `edition`                smallint NOT NULL,
    `creation_date`          datetime NOT NULL,
    `last_modification_date` datetime                                DEFAULT NULL,
    `editor_id`              int      NOT NULL,
    `image_path`             varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY                      `IDX_3BB1308916A2B381` (`book_id`),
    KEY                      `IDX_3BB13089BAF1A24D` (`editorial_id`),
    KEY                      `IDX_3BB130896995AC4C` (`editor_id`),
    CONSTRAINT `FK_3BB1308916A2B381` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`),
    CONSTRAINT `FK_3BB130896995AC4C` FOREIGN KEY (`editor_id`) REFERENCES `editor` (`id`),
    CONSTRAINT `FK_3BB13089BAF1A24D` FOREIGN KEY (`editorial_id`) REFERENCES `editorial` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_edition`
--

LOCK
TABLES `book_edition` WRITE;
/*!40000 ALTER TABLE `book_edition` DISABLE KEYS */;
INSERT INTO `book_edition`
VALUES (1, 1, 1, 1, '2021-10-30 00:00:00', NULL, 1, 'book1'),
       (2, 1, 1, 2, '2021-10-30 00:00:00', NULL, 1, 'book2'),
       (3, 2, 1, 1, '2021-10-30 00:00:00', NULL, 1, 'book3'),
       (4, 2, 1, 2, '2021-10-30 00:00:00', NULL, 2, 'book4'),
       (5, 3, 1, 1, '2021-10-30 00:00:00', NULL, 2, 'book5'),
       (6, 3, 1, 2, '2021-10-30 00:00:00', NULL, 1, 'book6'),
       (7, 4, 1, 1, '2021-10-30 00:00:00', NULL, 1, 'book7'),
       (8, 4, 1, 2, '2021-10-30 00:00:00', NULL, 2, 'book8'),
       (9, 5, 1, 1, '2021-10-30 00:00:00', NULL, 2, 'book9'),
       (10, 5, 1, 2, '2021-10-30 00:00:00', NULL, 2, 'book10'),
       (11, 5, 1, 3, '2021-10-30 00:00:00', NULL, 2, 'book11'),
       (14, 9, 1, 1, '2021-11-01 20:25:21', NULL, 2, NULL),
       (15, 10, 1, 1, '2021-11-02 20:39:53', NULL, 1, NULL),
       (16, 11, 1, 1, '2021-11-02 20:45:50', NULL, 1, NULL),
       (18, 13, 1, 3, '2021-11-03 00:08:58', NULL, 1, NULL),
       (19, 14, 1, 3, '2021-11-03 09:39:22', NULL, 2, NULL),
       (20, 1, 1, 3, '2021-11-03 12:02:20', NULL, 1, NULL),
       (22, 16, 2, 1, '2021-11-03 15:48:11', NULL, 3, NULL),
       (23, 17, 1, 1, '2021-11-03 17:19:45', NULL, 1, NULL);
/*!40000 ALTER TABLE `book_edition` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `book_edition_lang`
--

DROP TABLE IF EXISTS `book_edition_lang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `book_edition_lang`
(
    `id`                     int                                       NOT NULL AUTO_INCREMENT,
    `translator_id`          int                                       NOT NULL,
    `book_edition_id`        int                                       NOT NULL,
    `creation_date`          datetime                                  NOT NULL,
    `last_modification_date` datetime DEFAULT NULL,
    `language`               varchar(2) COLLATE utf8mb4_unicode_ci     NOT NULL,
    `title`                  varchar(100) COLLATE utf8mb4_unicode_ci   NOT NULL,
    `summary`                varchar(10000) COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (`id`),
    KEY                      `IDX_D8DFA5245370E40B` (`translator_id`),
    KEY                      `IDX_D8DFA524EB8550ED` (`book_edition_id`),
    CONSTRAINT `FK_D8DFA5245370E40B` FOREIGN KEY (`translator_id`) REFERENCES `translator` (`id`),
    CONSTRAINT `FK_D8DFA524EB8550ED` FOREIGN KEY (`book_edition_id`) REFERENCES `book_edition` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_edition_lang`
--

LOCK
TABLES `book_edition_lang` WRITE;
/*!40000 ALTER TABLE `book_edition_lang` DISABLE KEYS */;
INSERT INTO `book_edition_lang`
VALUES (1, 1, 1, '2021-10-30 00:00:00', NULL, 'ES', 'Tierras de niebla y miel',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis dictum quam, ullamcorper porttitor urna gravida et. Vivamus id diam eu magna bibendum euismod. Donec quis ultricies nisl, sed iaculis est. Donec et turpis sollicitudin elit pretium rutrum quis a magna. Maecenas id vulputate dolor. Vivamus lobortis id libero laoreet varius. Cras dictum purus vel eros ornare, id ultricies lectus mattis. Vestibulum nec tincidunt purus. Curabitur ac leo fermentum, pretium ante ut, gravida lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed in augue quis nulla lacinia maximus id ut sem. Curabitur urna ligula, accumsan imperdiet dui vitae, venenatis rhoncus quam. Maecenas ex dolor, sagittis non justo nec, dictum pellentesque justo.'),
       (3, 1, 2, '2021-10-30 00:00:00', NULL, 'ES', 'Algo más que magia',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis dictum quam, ullamcorper porttitor urna gravida et. Vivamus id diam eu magna bibendum euismod. Donec quis ultricies nisl, sed iaculis est. Donec et turpis sollicitudin elit pretium rutrum quis a magna. Maecenas id vulputate dolor. Vivamus lobortis id libero laoreet varius. Cras dictum purus vel eros ornare, id ultricies lectus mattis. Vestibulum nec tincidunt purus. Curabitur ac leo fermentum, pretium ante ut, gravida lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed in augue quis nulla lacinia maximus id ut sem. Curabitur urna ligula, accumsan imperdiet dui vitae, venenatis rhoncus quam. Maecenas ex dolor, sagittis non justo nec, dictum pellentesque justo.'),
       (4, 2, 3, '2021-10-30 00:00:00', NULL, 'ES', 'Los cuerpos',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis dictum quam, ullamcorper porttitor urna gravida et. Vivamus id diam eu magna bibendum euismod. Donec quis ultricies nisl, sed iaculis est. Donec et turpis sollicitudin elit pretium rutrum quis a magna. Maecenas id vulputate dolor. Vivamus lobortis id libero laoreet varius. Cras dictum purus vel eros ornare, id ultricies lectus mattis. Vestibulum nec tincidunt purus. Curabitur ac leo fermentum, pretium ante ut, gravida lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed in augue quis nulla lacinia maximus id ut sem. Curabitur urna ligula, accumsan imperdiet dui vitae, venenatis rhoncus quam. Maecenas ex dolor, sagittis non justo nec, dictum pellentesque justo.'),
       (5, 2, 4, '2021-10-30 00:00:00', NULL, 'ES', 'Ladrones',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis dictum quam, ullamcorper porttitor urna gravida et. Vivamus id diam eu magna bibendum euismod. Donec quis ultricies nisl, sed iaculis est. Donec et turpis sollicitudin elit pretium rutrum quis a magna. Maecenas id vulputate dolor. Vivamus lobortis id libero laoreet varius. Cras dictum purus vel eros ornare, id ultricies lectus mattis. Vestibulum nec tincidunt purus. Curabitur ac leo fermentum, pretium ante ut, gravida lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed in augue quis nulla lacinia maximus id ut sem. Curabitur urna ligula, accumsan imperdiet dui vitae, venenatis rhoncus quam. Maecenas ex dolor, sagittis non justo nec, dictum pellentesque justo.'),
       (6, 1, 4, '2021-10-30 00:00:00', NULL, 'EN', 'Robbers',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis dictum quam, ullamcorper porttitor urna gravida et. Vivamus id diam eu magna bibendum euismod. Donec quis ultricies nisl, sed iaculis est. Donec et turpis sollicitudin elit pretium rutrum quis a magna. Maecenas id vulputate dolor. Vivamus lobortis id libero laoreet varius. Cras dictum purus vel eros ornare, id ultricies lectus mattis. Vestibulum nec tincidunt purus. Curabitur ac leo fermentum, pretium ante ut, gravida lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed in augue quis nulla lacinia maximus id ut sem. Curabitur urna ligula, accumsan imperdiet dui vitae, venenatis rhoncus quam. Maecenas ex dolor, sagittis non justo nec, dictum pellentesque justo.'),
       (7, 2, 5, '2021-10-30 00:00:00', NULL, 'ES', 'Cielos de plomo',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis dictum quam, ullamcorper porttitor urna gravida et. Vivamus id diam eu magna bibendum euismod. Donec quis ultricies nisl, sed iaculis est. Donec et turpis sollicitudin elit pretium rutrum quis a magna. Maecenas id vulputate dolor. Vivamus lobortis id libero laoreet varius. Cras dictum purus vel eros ornare, id ultricies lectus mattis. Vestibulum nec tincidunt purus. Curabitur ac leo fermentum, pretium ante ut, gravida lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed in augue quis nulla lacinia maximus id ut sem. Curabitur urna ligula, accumsan imperdiet dui vitae, venenatis rhoncus quam. Maecenas ex dolor, sagittis non justo nec, dictum pellentesque justo.'),
       (8, 1, 6, '2021-10-30 00:00:00', NULL, 'ES', 'Dioses y mendigos',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis dictum quam, ullamcorper porttitor urna gravida et. Vivamus id diam eu magna bibendum euismod. Donec quis ultricies nisl, sed iaculis est. Donec et turpis sollicitudin elit pretium rutrum quis a magna. Maecenas id vulputate dolor. Vivamus lobortis id libero laoreet varius. Cras dictum purus vel eros ornare, id ultricies lectus mattis. Vestibulum nec tincidunt purus. Curabitur ac leo fermentum, pretium ante ut, gravida lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed in augue quis nulla lacinia maximus id ut sem. Curabitur urna ligula, accumsan imperdiet dui vitae, venenatis rhoncus quam. Maecenas ex dolor, sagittis non justo nec, dictum pellentesque justo.'),
       (9, 1, 7, '2021-10-30 00:00:00', NULL, 'ES', 'México contemporáneo',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis dictum quam, ullamcorper porttitor urna gravida et. Vivamus id diam eu magna bibendum euismod. Donec quis ultricies nisl, sed iaculis est. Donec et turpis sollicitudin elit pretium rutrum quis a magna. Maecenas id vulputate dolor. Vivamus lobortis id libero laoreet varius. Cras dictum purus vel eros ornare, id ultricies lectus mattis. Vestibulum nec tincidunt purus. Curabitur ac leo fermentum, pretium ante ut, gravida lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed in augue quis nulla lacinia maximus id ut sem. Curabitur urna ligula, accumsan imperdiet dui vitae, venenatis rhoncus quam. Maecenas ex dolor, sagittis non justo nec, dictum pellentesque justo.'),
       (10, 1, 8, '2021-10-30 00:00:00', NULL, 'ES', 'La música del silencio',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis dictum quam, ullamcorper porttitor urna gravida et. Vivamus id diam eu magna bibendum euismod. Donec quis ultricies nisl, sed iaculis est. Donec et turpis sollicitudin elit pretium rutrum quis a magna. Maecenas id vulputate dolor. Vivamus lobortis id libero laoreet varius. Cras dictum purus vel eros ornare, id ultricies lectus mattis. Vestibulum nec tincidunt purus. Curabitur ac leo fermentum, pretium ante ut, gravida lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed in augue quis nulla lacinia maximus id ut sem. Curabitur urna ligula, accumsan imperdiet dui vitae, venenatis rhoncus quam. Maecenas ex dolor, sagittis non justo nec, dictum pellentesque justo.'),
       (14, 2, 10, '2021-10-30 00:00:00', NULL, 'EN', 'Beloved',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis dictum quam, ullamcorper porttitor urna gravida et. Vivamus id diam eu magna bibendum euismod. Donec quis ultricies nisl, sed iaculis est. Donec et turpis sollicitudin elit pretium rutrum quis a magna. Maecenas id vulputate dolor. Vivamus lobortis id libero laoreet varius. Cras dictum purus vel eros ornare, id ultricies lectus mattis. Vestibulum nec tincidunt purus. Curabitur ac leo fermentum, pretium ante ut, gravida lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed in augue quis nulla lacinia maximus id ut sem. Curabitur urna ligula, accumsan imperdiet dui vitae, venenatis rhoncus quam. Maecenas ex dolor, sagittis non justo nec, dictum pellentesque justo.'),
       (15, 2, 10, '2021-10-30 00:00:00', NULL, 'FR', 'Bien-aimé',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis dictum quam, ullamcorper porttitor urna gravida et. Vivamus id diam eu magna bibendum euismod. Donec quis ultricies nisl, sed iaculis est. Donec et turpis sollicitudin elit pretium rutrum quis a magna. Maecenas id vulputate dolor. Vivamus lobortis id libero laoreet varius. Cras dictum purus vel eros ornare, id ultricies lectus mattis. Vestibulum nec tincidunt purus. Curabitur ac leo fermentum, pretium ante ut, gravida lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed in augue quis nulla lacinia maximus id ut sem. Curabitur urna ligula, accumsan imperdiet dui vitae, venenatis rhoncus quam. Maecenas ex dolor, sagittis non justo nec, dictum pellentesque justo.'),
       (16, 1, 14, '2021-11-01 20:25:21', NULL, 'IT', 'Selvaggio',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis dictum quam, ullamcorper porttitor urna gravida et. Vivamus id diam eu magna bibendum euismod. Donec quis ultricies nisl, sed iaculis est. Donec et turpis sollicitudin elit pretium rutrum quis a magna. Maecenas id vulputate dolor. Vivamus lobortis id libero laoreet varius. Cras dictum purus vel eros ornare, id ultricies lectus mattis. Vestibulum nec tincidunt purus. Curabitur ac leo fermentum, pretium ante ut, gravida lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed in augue quis nulla lacinia maximus id ut sem. Curabitur urna ligula, accumsan imperdiet dui vitae, venenatis rhoncus quam. Maecenas ex dolor, sagittis non justo nec, dictum pellentesque justo.'),
       (17, 1, 15, '2021-11-02 20:39:53', NULL, 'ES', 'Estrellas',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis dictum quam, ullamcorper porttitor urna gravida et. Vivamus id diam eu magna bibendum euismod. Donec quis ultricies nisl, sed iaculis est. Donec et turpis sollicitudin elit pretium rutrum quis a magna. Maecenas id vulputate dolor. Vivamus lobortis id libero laoreet varius. Cras dictum purus vel eros ornare, id ultricies lectus mattis. Vestibulum nec tincidunt purus. Curabitur ac leo fermentum, pretium ante ut, gravida lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed in augue quis nulla lacinia maximus id ut sem. Curabitur urna ligula, accumsan imperdiet dui vitae, venenatis rhoncus quam. Maecenas ex dolor, sagittis non justo nec, dictum pellentesque justo.'),
       (18, 1, 16, '2021-11-02 20:45:50', NULL, 'EN', 'Cosmos',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis dictum quam, ullamcorper porttitor urna gravida et. Vivamus id diam eu magna bibendum euismod. Donec quis ultricies nisl, sed iaculis est. Donec et turpis sollicitudin elit pretium rutrum quis a magna. Maecenas id vulputate dolor. Vivamus lobortis id libero laoreet varius. Cras dictum purus vel eros ornare, id ultricies lectus mattis. Vestibulum nec tincidunt purus. Curabitur ac leo fermentum, pretium ante ut, gravida lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed in augue quis nulla lacinia maximus id ut sem. Curabitur urna ligula, accumsan imperdiet dui vitae, venenatis rhoncus quam. Maecenas ex dolor, sagittis non justo nec, dictum pellentesque justo.'),
       (20, 1, 18, '2021-11-03 00:08:58', NULL, 'EN', 'Genesys',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis dictum quam, ullamcorper porttitor urna gravida et. Vivamus id diam eu magna bibendum euismod. Donec quis ultricies nisl, sed iaculis est. Donec et turpis sollicitudin elit pretium rutrum quis a magna. Maecenas id vulputate dolor. Vivamus lobortis id libero laoreet varius. Cras dictum purus vel eros ornare, id ultricies lectus mattis. Vestibulum nec tincidunt purus. Curabitur ac leo fermentum, pretium ante ut, gravida lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed in augue quis nulla lacinia maximus id ut sem. Curabitur urna ligula, accumsan imperdiet dui vitae, venenatis rhoncus quam. Maecenas ex dolor, sagittis non justo nec, dictum pellentesque justo.'),
       (21, 2, 19, '2021-11-03 09:39:22', NULL, 'EN', 'Dune',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis dictum quam, ullamcorper porttitor urna gravida et. Vivamus id diam eu magna bibendum euismod. Donec quis ultricies nisl, sed iaculis est. Donec et turpis sollicitudin elit pretium rutrum quis a magna. Maecenas id vulputate dolor. Vivamus lobortis id libero laoreet varius. Cras dictum purus vel eros ornare, id ultricies lectus mattis. Vestibulum nec tincidunt purus. Curabitur ac leo fermentum, pretium ante ut, gravida lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed in augue quis nulla lacinia maximus id ut sem. Curabitur urna ligula, accumsan imperdiet dui vitae, venenatis rhoncus quam. Maecenas ex dolor, sagittis non justo nec, dictum pellentesque justo.'),
       (23, 1, 1, '2021-11-03 11:49:43', NULL, 'IT', 'Aiuto',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis dictum quam, ullamcorper porttitor urna gravida et. Vivamus id diam eu magna bibendum euismod. Donec quis ultricies nisl, sed iaculis est. Donec et turpis sollicitudin elit pretium rutrum quis a magna. Maecenas id vulputate dolor. Vivamus lobortis id libero laoreet varius. Cras dictum purus vel eros ornare, id ultricies lectus mattis. Vestibulum nec tincidunt purus. Curabitur ac leo fermentum, pretium ante ut, gravida lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed in augue quis nulla lacinia maximus id ut sem. Curabitur urna ligula, accumsan imperdiet dui vitae, venenatis rhoncus quam. Maecenas ex dolor, sagittis non justo nec, dictum pellentesque justo.'),
       (24, 1, 1, '2021-11-03 12:00:07', NULL, 'EN', 'Random words',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis dictum quam, ullamcorper porttitor urna gravida et. Vivamus id diam eu magna bibendum euismod. Donec quis ultricies nisl, sed iaculis est. Donec et turpis sollicitudin elit pretium rutrum quis a magna. Maecenas id vulputate dolor. Vivamus lobortis id libero laoreet varius. Cras dictum purus vel eros ornare, id ultricies lectus mattis. Vestibulum nec tincidunt purus. Curabitur ac leo fermentum, pretium ante ut, gravida lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed in augue quis nulla lacinia maximus id ut sem. Curabitur urna ligula, accumsan imperdiet dui vitae, venenatis rhoncus quam. Maecenas ex dolor, sagittis non justo nec, dictum pellentesque justo.'),
       (25, 1, 20, '2021-11-03 12:02:20', NULL, 'EN', 'Seriously',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis dictum quam, ullamcorper porttitor urna gravida et. Vivamus id diam eu magna bibendum euismod. Donec quis ultricies nisl, sed iaculis est. Donec et turpis sollicitudin elit pretium rutrum quis a magna. Maecenas id vulputate dolor. Vivamus lobortis id libero laoreet varius. Cras dictum purus vel eros ornare, id ultricies lectus mattis. Vestibulum nec tincidunt purus. Curabitur ac leo fermentum, pretium ante ut, gravida lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed in augue quis nulla lacinia maximus id ut sem. Curabitur urna ligula, accumsan imperdiet dui vitae, venenatis rhoncus quam. Maecenas ex dolor, sagittis non justo nec, dictum pellentesque justo.'),
       (29, 2, 22, '2021-11-03 15:48:11', NULL, 'IT', 'Numeri',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis dictum quam, ullamcorper porttitor urna gravida et. Vivamus id diam eu magna bibendum euismod. Donec quis ultricies nisl, sed iaculis est. Donec et turpis sollicitudin elit pretium rutrum quis a magna. Maecenas id vulputate dolor. Vivamus lobortis id libero laoreet varius. Cras dictum purus vel eros ornare, id ultricies lectus mattis. Vestibulum nec tincidunt purus. Curabitur ac leo fermentum, pretium ante ut, gravida lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed in augue quis nulla lacinia maximus id ut sem. Curabitur urna ligula, accumsan imperdiet dui vitae, venenatis rhoncus quam. Maecenas ex dolor, sagittis non justo nec, dictum pellentesque justo.'),
       (30, 1, 23, '2021-11-03 17:19:46', NULL, 'EN', 'A book for everyone',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis dictum quam, ullamcorper porttitor urna gravida et. Vivamus id diam eu magna bibendum euismod. Donec quis ultricies nisl, sed iaculis est. Donec et turpis sollicitudin elit pretium rutrum quis a magna. Maecenas id vulputate dolor. Vivamus lobortis id libero laoreet varius. Cras dictum purus vel eros ornare, id ultricies lectus mattis. Vestibulum nec tincidunt purus. Curabitur ac leo fermentum, pretium ante ut, gravida lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed in augue quis nulla lacinia maximus id ut sem. Curabitur urna ligula, accumsan imperdiet dui vitae, venenatis rhoncus quam. Maecenas ex dolor, sagittis non justo nec, dictum pellentesque justo.');
/*!40000 ALTER TABLE `book_edition_lang` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `book_tag`
--

DROP TABLE IF EXISTS `book_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `book_tag`
(
    `book_id` int NOT NULL,
    `tag_id`  int NOT NULL,
    PRIMARY KEY (`book_id`, `tag_id`),
    KEY       `IDX_F2F4CE1516A2B381` (`book_id`),
    KEY       `IDX_F2F4CE15BAD26311` (`tag_id`),
    CONSTRAINT `FK_F2F4CE1516A2B381` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE,
    CONSTRAINT `FK_F2F4CE15BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_tag`
--

LOCK
TABLES `book_tag` WRITE;
/*!40000 ALTER TABLE `book_tag` DISABLE KEYS */;
INSERT INTO `book_tag`
VALUES (1, 1),
       (1, 3),
       (2, 3),
       (2, 5),
       (3, 3),
       (4, 1),
       (5, 5),
       (15, 1),
       (15, 3),
       (16, 3),
       (16, 4),
       (16, 5),
       (17, 4),
       (17, 5);
/*!40000 ALTER TABLE `book_tag` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions`
(
    `version`        varchar(191) COLLATE utf8_unicode_ci NOT NULL,
    `executed_at`    datetime DEFAULT NULL,
    `execution_time` int      DEFAULT NULL,
    PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK
TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions`
VALUES ('DoctrineMigrations\\Version20211029153738', '2021-10-30 12:43:00', 1237),
       ('DoctrineMigrations\\Version20211030120655', '2021-10-30 12:43:01', 93),
       ('DoctrineMigrations\\Version20211030123501', '2021-10-30 12:45:39', 539),
       ('DoctrineMigrations\\Version20211030130904', '2021-10-30 13:09:48', 512),
       ('DoctrineMigrations\\Version20211030131652', '2021-10-30 13:17:05', 514),
       ('DoctrineMigrations\\Version20211030160452', '2021-10-30 16:05:04', 505),
       ('DoctrineMigrations\\Version20211101202059', '2021-11-01 20:21:08', 565),
       ('DoctrineMigrations\\Version20211103132059', '2021-11-03 16:35:44', 516);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `editor`
--

DROP TABLE IF EXISTS `editor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `editor`
(
    `id`                     int                                     NOT NULL AUTO_INCREMENT,
    `editorial_id`           int                                     NOT NULL,
    `name`                   varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email`                  varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `creation_date`          datetime                                NOT NULL,
    `last_modification_date` datetime DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY                      `IDX_CCF1F1BABAF1A24D` (`editorial_id`),
    CONSTRAINT `FK_CCF1F1BABAF1A24D` FOREIGN KEY (`editorial_id`) REFERENCES `editorial` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `editor`
--

LOCK
TABLES `editor` WRITE;
/*!40000 ALTER TABLE `editor` DISABLE KEYS */;
INSERT INTO `editor`
VALUES (1, 1, 'Adam Armstrong', 'adam@testeditorlibrary.com', '2021-10-30 00:00:00', NULL),
       (2, 1, 'Paula Martinez', 'paula@testeditorlibrary.com', '2021-10-30 00:00:00', NULL),
       (3, 2, 'Leire Saez', 'leire@testeditorlibrary.com', '2021-10-30 00:00:00', NULL),
       (4, 2, 'Aitor Corrales', 'aitor@testeditor.com', '2021-11-03 16:28:46', NULL);
/*!40000 ALTER TABLE `editor` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `editorial`
--

DROP TABLE IF EXISTS `editorial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `editorial`
(
    `id`   int                                     NOT NULL AUTO_INCREMENT,
    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `editorial`
--

LOCK
TABLES `editorial` WRITE;
/*!40000 ALTER TABLE `editorial` DISABLE KEYS */;
INSERT INTO `editorial`
VALUES (1, 'Elhuyar'),
       (2, 'Planeta');
/*!40000 ALTER TABLE `editorial` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tag`
(
    `id`                     int                                     NOT NULL AUTO_INCREMENT,
    `name`                   varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `creation_date`          datetime                                NOT NULL,
    `last_modification_date` datetime DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK
TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag`
VALUES (1, 'Fear', '2021-10-30 00:00:00', NULL),
       (3, 'Action', '2021-10-30 00:00:00', NULL),
       (4, 'History', '2021-10-30 00:00:00', NULL),
       (5, 'Fiction', '2021-10-30 00:00:00', NULL);
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `translator`
--

DROP TABLE IF EXISTS `translator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `translator`
(
    `id`                     int                                     NOT NULL AUTO_INCREMENT,
    `name`                   varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email`                  varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `creation_date`          datetime                                NOT NULL,
    `last_modification_date` datetime DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translator`
--

LOCK
TABLES `translator` WRITE;
/*!40000 ALTER TABLE `translator` DISABLE KEYS */;
INSERT INTO `translator`
VALUES (1, 'Jamal Louis', 'jlouis@testemaillibrary.com', '2021-10-30 00:00:00', NULL),
       (2, 'Randy Lass', 'rlass@testemaillibrary.com', '2021-10-30 00:00:00', NULL);
/*!40000 ALTER TABLE `translator` ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user`
(
    `id`       int                                     NOT NULL AUTO_INCREMENT,
    `email`    varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
    `roles`    json                                    NOT NULL,
    `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `language` varchar(2) COLLATE utf8mb4_unicode_ci   NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK
TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK
TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-03 22:27:52

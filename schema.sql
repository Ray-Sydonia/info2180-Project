-- MySQL dump 10.11
--
-- to install this database, from a terminal, type:
-- mysql -u USERNAME -p -h SERVERNAME dolphin_crm < schema.sql
--
-- Host: localhost    Database: dolphin_crm
-- ------------------------------------------------------
-- Server version   5.0.45-log

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

DROP
DATABASE IF EXISTS `dolphin_crm`;
CREATE
DATABASE `dolphin_crm` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE
`dolphin_crm`;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`
(
    `id`         INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    `firstname`  VARCHAR(255) NOT NULL,
    `lastname`   VARCHAR(255) NOT NULL,
    `password`   VARCHAR(255) NOT NULL,
    `email`      VARCHAR(255) NOT NULL,
    `role`       VARCHAR(255) NOT NULL DEFAULT 'Member',
    `created_at` DATETIME     NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM AUTO_INCREMENT = 4080 DEFAULT CHARSET = utf8mb4;

-- Admin user
INSERT INTO `users` (firstname, lastname, password, email, role, created_at) VALUES ('Admin', 'User', 'password123', 'admin@project2.com', 'admin', NOW());

--
-- Table structure for table `Contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts`
(
    `id`          INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    `title`       VARCHAR(255) NOT NULL,
    `firstname`   VARCHAR(255) NOT NULL,
    `lastname`    VARCHAR(255) NOT NULL,
    `email`       VARCHAR(255) NOT NULL,
    `telephone`   VARCHAR(255) NOT NULL,
    `company`     VARCHAR(255) NOT NULL,
    `type`        VARCHAR(255) NOT NULL,
    `assigned_to` INTEGER UNSIGNED NOT NULL,
    `created_by`  INTEGER UNSIGNED NOT NULL,
    `created_at`  DATETIME     NOT NULL,
    `updated_at`  DATETIME     NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM AUTO_INCREMENT = 4080 DEFAULT CHARSET = utf8mb4;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes`
(
    `id`         INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    `contact_id` INTEGER UNSIGNED NOT NULL,
    `comment`    TEXT         NOT NULL,
    `created_by` INTEGER UNSIGNED NOT NULL,
    `created_at` DATETIME     NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = MyISAM AUTO_INCREMENT = 4080 DEFAULT CHARSET = utf8mb4;

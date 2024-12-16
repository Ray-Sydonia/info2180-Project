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



-- Insert test users
INSERT INTO `users` (firstname, lastname, password, email, role, created_at)
VALUES 
('Alice', 'Smith', MD5('password1'), 'alice.smith@example.com', 'Member', NOW()),
('Bob', 'Johnson', MD5('password2'), 'bob.johnson@example.com', 'Member', NOW()),
('Charlie', 'Brown', MD5('password3'), 'charlie.brown@example.com', 'Manager', NOW()),
('Diana', 'Prince', MD5('password4'), 'diana.prince@example.com', 'Admin', NOW()),
('Eve', 'Taylor', MD5('password5'), 'eve.taylor@example.com', 'Member', NOW());

-- Insert test contacts
INSERT INTO `contacts` (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at)
VALUES
('Mr.', 'John', 'Doe', 'john.doe@example.com', '123-456-7890', 'Tech Corp', 'Client', 1, 2, NOW(), NOW()),
('Ms.', 'Jane', 'Roe', 'jane.roe@example.com', '234-567-8901', 'Business Inc.', 'Prospect', 2, 3, NOW(), NOW()),
('Dr.', 'Emily', 'White', 'emily.white@example.com', '345-678-9012', 'Medical Group', 'Client', 3, 1, NOW(), NOW()),
('Mr.', 'James', 'Bond', 'james.bond@example.com', '456-789-0123', 'Spy Agency', 'Partner', 4, 1, NOW(), NOW()),
('Mrs.', 'Anna', 'Smith', 'anna.smith@example.com', '567-890-1234', 'Fashion Co.', 'Lead', 5, 2, NOW(), NOW());



-- Insert test notes
INSERT INTO `notes` (contact_id, comment, created_by, created_at)
VALUES
(1, 'Follow-up call scheduled for next week.', 2, NOW()),
(2, 'Provided a quote for the project.', 3, NOW()),
(3, 'Discussed partnership opportunities.', 1, NOW()),
(4, 'Meeting scheduled to discuss terms.', 4, NOW()),
(5, 'Sent introductory email and brochure.', 2, NOW());
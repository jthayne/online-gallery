/*
SQLyog Enterprise - MySQL GUI v8.1 
MySQL - 5.1.39-log : Database - ariel_photography
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `galleries` */

CREATE TABLE `galleries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) NOT NULL,
  `enabled` tinyint(4) NOT NULL,
  `description` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Table structure for table `images` */

CREATE TABLE `images` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `filename` varchar(75) NOT NULL,
  `title` varchar(124) NOT NULL,
  `description` varchar(255) NOT NULL,
  `gallery` int(11) NOT NULL,
  `enabled` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `filename` (`filename`),
  KEY `gallery` (`gallery`)
) ENGINE=MyISAM AUTO_INCREMENT=146 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

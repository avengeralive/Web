/*
SQLyog Ultimate v11.5 (32 bit)
MySQL - 10.0.17-MariaDB-1~trusty-log : Database - cards2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cards2` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `cards2`;

/*Table structure for table `cards` */

DROP TABLE IF EXISTS `cards`;

CREATE TABLE `cards` (
  `number` bigint(255) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Карты';

/*Data for the table `cards` */

insert  into `cards`(`number`,`active`) values (4249820001233521,1),(4268037317507037,1),(4405051728060700,1),(4405051728060712,0),(5084500002859228,1);

/*Table structure for table `limits` */

DROP TABLE IF EXISTS `limits`;

CREATE TABLE `limits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `card_number` bigint(255) unsigned NOT NULL,
  `limit_id` int(11) NOT NULL,
  `quantity` float DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_limits_cards` (`card_number`),
  KEY `FK_limits_ltypes` (`limit_id`),
  CONSTRAINT `FK_limits_cards` FOREIGN KEY (`card_number`) REFERENCES `cards` (`number`),
  CONSTRAINT `FK_limits_ltypes` FOREIGN KEY (`limit_id`) REFERENCES `ltypes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Лимиты';

/*Data for the table `limits` */

insert  into `limits`(`id`,`card_number`,`limit_id`,`quantity`,`active`) values (3,5084500002859228,1,150,1),(5,4249820001233521,12,5,1);

/*Table structure for table `ltypes` */

DROP TABLE IF EXISTS `ltypes`;

CREATE TABLE `ltypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `measure` varchar(50) DEFAULT NULL,
  `quantity` float DEFAULT '0',
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_ltypes_measures` (`measure`),
  CONSTRAINT `FK_ltypes_measures` FOREIGN KEY (`measure`) REFERENCES `measures` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='Типы лимитов';

/*Data for the table `ltypes` */

insert  into `ltypes`(`id`,`name`,`measure`,`quantity`,`active`) values (1,'ÐÐ°Ð·Ð²Ð°Ð½Ð¸Ðµ','ÐšÐ³.',100,1),(11,'Ð•Ñ‰Ðµ Ð¾Ð´Ð¸Ð½ Ð»Ð¸Ð¼Ð¸Ñ‚','Ð¨Ñ‚.',50,1),(12,'ÐšÐ°Ñ€Ñ‚Ð¾ÑˆÐºÐ°','ÐšÐ³.',1,1);

/*Table structure for table `measures` */

DROP TABLE IF EXISTS `measures`;

CREATE TABLE `measures` (
  `name` varchar(10) NOT NULL,
  `precision` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Единицы измерения';

/*Data for the table `measures` */

insert  into `measures`(`name`,`precision`) values ('ÐšÐ³.',3),('Ð¨Ñ‚.',0),('Кг.',3),('Шт.',0);

/*Table structure for table `sales` */

DROP TABLE IF EXISTS `sales`;

CREATE TABLE `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `card_number` bigint(255) unsigned NOT NULL,
  `quantity` float unsigned NOT NULL,
  `limit_id` int(11) NOT NULL,
  `result` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_sales_ltypes` (`limit_id`),
  KEY `FK_sales_cards` (`card_number`),
  CONSTRAINT `FK_sales_cards` FOREIGN KEY (`card_number`) REFERENCES `cards` (`number`),
  CONSTRAINT `FK_sales_ltypes` FOREIGN KEY (`limit_id`) REFERENCES `ltypes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Продажи';

/*Data for the table `sales` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

/*
SQLyog Enterprise - MySQL GUI v8.05 
MySQL - 5.5.5-10.1.35-MariaDB : Database - dbtest
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`dbtest` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `dbtest`;

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2020_03_08_171144_create_wager_table',1),(2,'2020_03_08_171949_create_purchase_table',1);

/*Table structure for table `purchase` */

DROP TABLE IF EXISTS `purchase`;

CREATE TABLE `purchase` (
  `purchase_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `buying_price` decimal(18,2) NOT NULL,
  `wager_id` int(11) NOT NULL,
  `bought_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `purchase` */

insert  into `purchase`(`purchase_id`,`buying_price`,`wager_id`,`bought_at`) values (1,'150000.00',1,'2020-03-09 06:00:34'),(3,'50000.00',1,'2020-03-09 06:02:12'),(4,'50000.00',1,'2020-03-09 06:02:23'),(6,'70000.00',2,'2020-03-09 06:04:48'),(7,'150000.00',2,'2020-03-09 06:25:54'),(8,'60000.00',2,'2020-03-09 06:27:12');

/*Table structure for table `wager` */

DROP TABLE IF EXISTS `wager`;

CREATE TABLE `wager` (
  `wager_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `total_wager_value` int(11) NOT NULL,
  `odds` int(11) NOT NULL,
  `selling_percentage` int(11) NOT NULL,
  `current_selling_price` decimal(18,2) DEFAULT NULL,
  `selling_price` decimal(18,2) NOT NULL,
  `percentage_sold` int(11) DEFAULT NULL,
  `amount_sold` decimal(8,2) DEFAULT NULL,
  `placed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`wager_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `wager` */

insert  into `wager`(`wager_id`,`total_wager_value`,`odds`,`selling_percentage`,`current_selling_price`,`selling_price`,`percentage_sold`,`amount_sold`,`placed_at`) values (1,1500,9,78,'0.00','250000.00',100,'250000.00','2020-03-09 13:02:23'),(2,2000,9,100,'20000.00','300000.00',93,'280000.00','2020-03-09 13:27:12');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;

# MySQL-Front 5.0  (Build 1.6)

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;


# Host: 10.67.254.101    Database: wjdb
# ------------------------------------------------------
# Server version 5.0.67-0ubuntu6

DROP DATABASE IF EXISTS `wjdb`;
CREATE DATABASE `wjdb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `wjdb`;

#
# Table structure for table access
#

CREATE TABLE `access` (
  `id` int(11) NOT NULL auto_increment,
  `account` varchar(50) NOT NULL default '0',
  `page` varchar(50) default NULL,
  `module` varchar(50) default NULL,
  `func` varchar(50) default NULL,
  `permit` tinyint(3) default NULL,
  `date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

#
# Dumping data for table access
#

INSERT INTO `access` VALUES (1,'admin','all','all','all',1,'2011-11-16 07:20:15');
INSERT INTO `access` VALUES (2,'xxx','login','login',NULL,1,'2011-11-16 07:20:15');
INSERT INTO `access` VALUES (3,'xxxx','sale','sale',NULL,1,'2011-11-16 07:20:15');
INSERT INTO `access` VALUES (4,'xxx','buy','buy','all',1,'2012-02-21 10:05:57');
INSERT INTO `access` VALUES (5,'admin','system','system','all',1,'2012-02-21 09:38:28');
INSERT INTO `access` VALUES (6,'admin','login','all','all',1,'2012-02-21 08:57:10');

#
# Table structure for table account
#

CREATE TABLE `account` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  `fullname` varchar(50) default NULL,
  `role` varchar(50) default NULL,
  `passwd` varchar(20) NOT NULL,
  `token` varchar(20) default '',
  `phone` varchar(15) default NULL,
  `address` varchar(45) default NULL,
  `province` varchar(10) default NULL,
  `city` varchar(15) default NULL,
  `code` varchar(10) default NULL,
  `email` varchar(100) default NULL,
  `qq` varchar(10) default NULL,
  `msn` varchar(100) default NULL,
  `other` varchar(20) default NULL,
  `type` tinyint(4) default NULL,
  `level` tinyint(4) default NULL,
  `date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

#
# Dumping data for table account
#

INSERT INTO `account` VALUES (39,'admin','系统账号','管理员','admin','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2011-11-16 07:20:15');
INSERT INTO `account` VALUES (40,'xxx','伟文','管理员','112313','','334246','村','','','','xxx@gmail.com','282609226','','',0,0,'2012-02-22');
INSERT INTO `account` VALUES (41,'ylj','塘娇','管理员','ylj','','23252','彩','广东','广州',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2011-11-16 07:20:15');
INSERT INTO `account` VALUES (42,'sale','销售庄户','销售','sale','','4564564','杭州市上城区鸿润','','','','we@CRSYS.COM','238522828','','',0,0,'2012-02-22');
INSERT INTO `account` VALUES (43,'test','test','test','test','','3636436','广东广州天河区','','','','eln@CSSB.COM','238522828','','',0,0,'2012-02-22');

#
# Table structure for table article
#

CREATE TABLE `article` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `cid` int(11) default NULL,
  `author` varchar(255) default NULL,
  `brand` varchar(11) default NULL,
  `series` varchar(11) default NULL,
  `module` varchar(11) default NULL,
  `catalog` varchar(255) default NULL,
  `title` varchar(500) default NULL,
  `content` varchar(1000) default NULL,
  `image` varchar(100) default NULL,
  `level` tinyint(3) default NULL,
  `url` varchar(255) default NULL,
  `link` varchar(255) default NULL,
  `date` datetime default NULL,
  `refer` int(11) default NULL,
  `comment` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8;

#
# Dumping data for table article
#


#
# Table structure for table bills
#

CREATE TABLE `bills` (
  `id` int(11) NOT NULL auto_increment,
  `company` int(11) default NULL,
  `operator` int(11) default NULL,
  `total` float(10,2) default NULL,
  `date` datetime default NULL,
  `num` varchar(50) default NULL,
  `book` varchar(50) default NULL,
  `sheet` varchar(50) default NULL,
  `memo` varchar(100) default NULL,
  `type` smallint(3) unsigned default NULL,
  `history` smallint(3) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

#
# Dumping data for table bills
#

INSERT INTO `bills` VALUES (59,13,0,365,'2012-02-24 14:04:00','C224634905747303','','','',0,0);
INSERT INTO `bills` VALUES (61,2,0,3136,'2012-02-24 15:43:00','C224694053779200','','','',0,0);
INSERT INTO `bills` VALUES (62,2,0,586,'2012-02-24 16:26:00','C224719923546338','','','',3,0);
INSERT INTO `bills` VALUES (63,3,0,1746,'2012-02-24 16:59:00','C224739944677666','','','',3,0);

#
# Table structure for table books
#

CREATE TABLE `books` (
  `Id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Dumping data for table books
#


#
# Table structure for table brand
#

CREATE TABLE `brand` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(45) default NULL,
  `shortname` varchar(45) default NULL,
  `englishname` varchar(45) default NULL,
  `alias` varchar(45) default NULL,
  `type` int(11) default NULL,
  `demo` varchar(45) default NULL,
  `www` varchar(45) default NULL,
  `desc` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='公司信息表,Type类型用来区分公司类型, 一种是挖机的知名品牌类型, 一种是普通配件公司类型,一种供应给客户的类型等';

#
# Dumping data for table brand
#

INSERT INTO `brand` VALUES (1,'小松','PC','Komatsu',NULL,1,NULL,'http://www.komatsu.com.cn/',NULL);
INSERT INTO `brand` VALUES (2,'日立','EX','HITACHI',NULL,1,NULL,NULL,NULL);
INSERT INTO `brand` VALUES (3,'现代','HY','HYUNDAI',NULL,1,NULL,NULL,NULL);
INSERT INTO `brand` VALUES (4,'大宇','DH','DAEWOO',NULL,1,NULL,NULL,NULL);
INSERT INTO `brand` VALUES (5,'卡特','CAT','CATERPILLAR','卡特彼勒 ',1,'KOBELCO',NULL,NULL);
INSERT INTO `brand` VALUES (6,'神钢','SK','KOBELCO',NULL,1,NULL,NULL,NULL);
INSERT INTO `brand` VALUES (7,'沃尔沃','EC','VOLVO',NULL,1,NULL,NULL,NULL);
INSERT INTO `brand` VALUES (8,'住友','SH','SUMITOMO',NULL,1,NULL,NULL,NULL);
INSERT INTO `brand` VALUES (9,'斗山','DH','DOOSAN',NULL,1,NULL,NULL,NULL);
INSERT INTO `brand` VALUES (10,'加藤','HD','KATO',NULL,1,NULL,NULL,NULL);
INSERT INTO `brand` VALUES (11,'凯斯','CX\r\n',NULL,NULL,1,NULL,NULL,NULL);
INSERT INTO `brand` VALUES (12,'利勃海尔','LIEBHERR','LIEBHERR','利勃 ',1,'德国品牌',NULL,NULL);
INSERT INTO `brand` VALUES (13,'竹内','TB','Sany',NULL,1,NULL,NULL,NULL);
INSERT INTO `brand` VALUES (14,'日立合肥','ZAX ',NULL,NULL,1,NULL,NULL,NULL);
INSERT INTO `brand` VALUES (15,'三菱 ','MIT','MITSUBISHI',NULL,1,NULL,NULL,NULL);
INSERT INTO `brand` VALUES (16,'IHI石川岛','IHI','IHI',NULL,1,'2008年7月1日更名为IHI建机株式会社 ',NULL,NULL);
INSERT INTO `brand` VALUES (17,'AIRMAN北越工业株式会社','AIRMAN',NULL,NULL,1,NULL,NULL,NULL);
INSERT INTO `brand` VALUES (18,'TAKEUCHI竹内制造所','TAKEUCHI','TAKEUCHI',NULL,1,NULL,NULL,NULL);
INSERT INTO `brand` VALUES (19,'Kubota久保田 ','KU','kubota',NULL,1,NULL,NULL,NULL);
INSERT INTO `brand` VALUES (20,'YANMAR洋马','YM','YANMAR',NULL,1,NULL,NULL,NULL);
INSERT INTO `brand` VALUES (21,'JOHN DEERE翰迪尔','DE','JOHN DEERE',NULL,1,'美国品牌',NULL,NULL);
INSERT INTO `brand` VALUES (22,'BOBCAT山猫','BO','BOBCAT','台湾BOBCAT山猫',2,'台湾不常见品牌通称山猫牌其最大特征车辆上会有一山猫脸涂装',NULL,NULL);
INSERT INTO `brand` VALUES (23,'柳工','LG','LIUGONG ','LIUGONG柳工机械',3,NULL,NULL,NULL);
INSERT INTO `brand` VALUES (24,'test',NULL,NULL,NULL,1,NULL,NULL,NULL);
INSERT INTO `brand` VALUES (25,'test',NULL,NULL,NULL,24,NULL,NULL,NULL);
INSERT INTO `brand` VALUES (26,'test',NULL,NULL,NULL,25,NULL,NULL,NULL);

#
# Table structure for table clients
#

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL auto_increment,
  `name` char(120) default NULL,
  PRIMARY KEY  (`client_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

#
# Dumping data for table clients
#

INSERT INTO `clients` VALUES (1,'Client 1');
INSERT INTO `clients` VALUES (2,'Client 2');
INSERT INTO `clients` VALUES (3,'Client 3');

#
# Table structure for table comments
#

CREATE TABLE `comments` (
  `Id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Dumping data for table comments
#


#
# Table structure for table company
#

CREATE TABLE `company` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `shortname` varchar(255) default NULL,
  `pinyin` varchar(255) default NULL,
  `abbr` varchar(255) default NULL,
  `address` varchar(255) default NULL,
  `telephone` varchar(255) default NULL,
  `mobile` varchar(255) default NULL,
  `fax` varchar(255) default NULL,
  `man` varchar(255) default NULL,
  `memo` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

#
# Dumping data for table company
#

INSERT INTO `company` VALUES (1,'爱爱爱','aaa','aa','aaa','aa','aa','aa','aa','aa','aa');
INSERT INTO `company` VALUES (2,'武汉广福工程机械23','武汉广福22','guangfu','gf','武汉天河东','','','','','');
INSERT INTO `company` VALUES (3,'郑州广福工程机械','郑州广福','meng','men','郑州1','','','','','');
INSERT INTO `company` VALUES (4,'岳阳广福工程机械','岳阳广福','dafu','fu','岳阳广福',NULL,NULL,NULL,NULL,NULL);
INSERT INTO `company` VALUES (6,'司法所','www','ww','sss','ww','w','262','26','ww','26');
INSERT INTO `company` VALUES (7,'736373','er','wet','wert','wert','34662346','','','etr','');
INSERT INTO `company` VALUES (8,'twt363','er','wet','wert','wert','34662346','','','etr','');
INSERT INTO `company` VALUES (9,'test','er','wet','wert','wert','34662346','','','etr','');
INSERT INTO `company` VALUES (10,'林伟','李偲菘','sdi','lski','天河死死死','10401501','2350902','2350','林伟','23450');
INSERT INTO `company` VALUES (11,'test1','test','test','test','test','s','','','tes','');
INSERT INTO `company` VALUES (12,'爱爱爱','aaa','aaa','aa','aa','aa','aa','aa','aa','aa');
INSERT INTO `company` VALUES (13,'武汉广福工程机械11','武汉广福11','gf','guangfu','武汉天河东圃珠村','','','','','');

#
# Table structure for table engines
#

CREATE TABLE `engines` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(20) default NULL,
  `abbr` varchar(20) default NULL,
  `manufacture` varchar(50) default NULL,
  `suitable` varchar(50) default NULL,
  `picture` varchar(255) default NULL,
  `memo` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Dumping data for table engines
#


#
# Table structure for table goods
#

CREATE TABLE `goods` (
  `id` int(11) NOT NULL,
  `part_id` int(11) default NULL,
  `company_id` int(11) default NULL,
  `quantity` int(11) default NULL,
  `price` float default NULL,
  `date` datetime default NULL,
  `demo` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Dumping data for table goods
#


#
# Table structure for table invheader
#

CREATE TABLE `invheader` (
  `id` int(11) NOT NULL auto_increment,
  `invdate` date NOT NULL,
  `client_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL default '0.00',
  `tax` decimal(10,2) NOT NULL default '0.00',
  `total` decimal(10,2) NOT NULL default '0.00',
  `note` char(100) default NULL,
  `closed` char(3) default 'No',
  `ship_via` char(3) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

#
# Dumping data for table invheader
#

INSERT INTO `invheader` VALUES (1,'2007-10-01',1,100,20,120,'note 1','No',NULL);
INSERT INTO `invheader` VALUES (2,'2007-10-03',1,200,40,240,'note 2','No',NULL);
INSERT INTO `invheader` VALUES (3,'2007-10-02',2,300,60,360,'note for invoice 3','No',NULL);
INSERT INTO `invheader` VALUES (4,'2007-10-04',3,150,0,150,'no tax','No',NULL);
INSERT INTO `invheader` VALUES (5,'2007-10-05',3,100,0,100,'no tax','No',NULL);
INSERT INTO `invheader` VALUES (6,'2007-10-05',1,50,10,60,NULL,'No',NULL);
INSERT INTO `invheader` VALUES (7,'2007-10-05',2,120,12,134,NULL,'No',NULL);
INSERT INTO `invheader` VALUES (8,'2007-10-06',3,200,0,200,NULL,'No',NULL);
INSERT INTO `invheader` VALUES (9,'2007-10-06',1,200,40,240,NULL,'No',NULL);
INSERT INTO `invheader` VALUES (10,'2007-10-06',2,100,20,120,NULL,'No',NULL);
INSERT INTO `invheader` VALUES (11,'2007-10-06',1,600,120,720,NULL,'No',NULL);
INSERT INTO `invheader` VALUES (12,'2007-10-06',2,700,140,840,NULL,'No',NULL);
INSERT INTO `invheader` VALUES (13,'2007-10-06',3,1000,0,1000,NULL,'No',NULL);

#
# Table structure for table invlines
#

CREATE TABLE `invlines` (
  `id` int(11) NOT NULL,
  `num` int(11) NOT NULL auto_increment,
  `item` char(20) default NULL,
  `qty` decimal(8,2) NOT NULL default '0.00',
  `unit` decimal(10,2) NOT NULL,
  PRIMARY KEY  (`id`,`num`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Dumping data for table invlines
#

INSERT INTO `invlines` VALUES (1,1,'item 1',1,20);
INSERT INTO `invlines` VALUES (1,2,'item 2',2,40);
INSERT INTO `invlines` VALUES (2,1,'item 1',2,20);
INSERT INTO `invlines` VALUES (2,2,'item 2',4,40);
INSERT INTO `invlines` VALUES (3,1,'item 3',1,100);
INSERT INTO `invlines` VALUES (3,2,'item 4',1,200);
INSERT INTO `invlines` VALUES (4,1,'item 1',1,100);
INSERT INTO `invlines` VALUES (4,2,'item 2',1,50);
INSERT INTO `invlines` VALUES (5,1,'item 3',1,100);
INSERT INTO `invlines` VALUES (6,1,'item 4',1,50);
INSERT INTO `invlines` VALUES (7,1,'item 5',2,10);
INSERT INTO `invlines` VALUES (7,2,'item 1',1,100);
INSERT INTO `invlines` VALUES (8,1,'item 3',1,50);
INSERT INTO `invlines` VALUES (8,2,'item 2',1,120);
INSERT INTO `invlines` VALUES (8,3,'item 3',1,30);
INSERT INTO `invlines` VALUES (9,1,'item 6',1,140);
INSERT INTO `invlines` VALUES (9,2,'item 3',1,60);
INSERT INTO `invlines` VALUES (10,1,'item 5',3,10);
INSERT INTO `invlines` VALUES (10,2,'item 4',1,70);
INSERT INTO `invlines` VALUES (11,1,'item 1',2,100);
INSERT INTO `invlines` VALUES (11,2,'item 2',3,50);
INSERT INTO `invlines` VALUES (11,3,'item 3',1,50);
INSERT INTO `invlines` VALUES (11,4,'item 4',1,200);
INSERT INTO `invlines` VALUES (12,1,'item 4',1,300);
INSERT INTO `invlines` VALUES (12,2,'item 2',1,400);
INSERT INTO `invlines` VALUES (13,1,'item 13',1,1000);

#
# Table structure for table items
#

CREATE TABLE `items` (
  `item_id` int(10) unsigned NOT NULL auto_increment,
  `item` varchar(200) default NULL,
  `item_cd` varchar(15) default NULL,
  PRIMARY KEY  (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Dumping data for table items
#


#
# Table structure for table models
#

CREATE TABLE `models` (
  `id` int(11) NOT NULL auto_increment,
  `brand` int(11) default NULL,
  `model` varchar(60) default NULL,
  `engine` varchar(60) default NULL,
  `suitable` varchar(100) default NULL,
  `abbr` varchar(20) default NULL,
  `picture` varchar(255) default NULL,
  `memo` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Dumping data for table models
#


#
# Table structure for table news
#

CREATE TABLE `news` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) default NULL,
  `content` text,
  `author` varchar(100) default NULL,
  `origin` varchar(100) default NULL,
  `date` datetime default NULL,
  `comment` varchar(255) default NULL,
  `link` varchar(255) default NULL,
  `type` tinyint(3) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Dumping data for table news
#


#
# Table structure for table parts
#

CREATE TABLE `parts` (
  `id` int(11) NOT NULL auto_increment,
  `catalog` int(11) default NULL,
  `series` int(11) default NULL,
  `model` varchar(20) default NULL,
  `partno` varchar(50) default NULL,
  `code` varchar(50) default NULL,
  `name` varchar(45) NOT NULL default '',
  `ename` varchar(30) default NULL,
  `alias` varchar(20) default NULL,
  `pinyin` varchar(45) default NULL,
  `abbr` varchar(10) default NULL,
  `unit` varchar(10) default NULL,
  `spec` varchar(45) default NULL,
  `quantity` int(11) unsigned default NULL,
  `price` float(10,2) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=232 DEFAULT CHARSET=utf8;

#
# Dumping data for table parts
#

INSERT INTO `parts` VALUES (1,0,0,'0','TAIHO','','4BD1-大瓦标准','4BD1-M00','大标准','4BD1-M00','','套','4BD1',0,128);
INSERT INTO `parts` VALUES (2,0,0,'0','TAIHO','','4BD1-大瓦25','4BD1-M25','大瓦25','4BD1-M25','','套','',4294967295,88);
INSERT INTO `parts` VALUES (3,0,0,'0','TAIHO','','4BD1-大瓦50','4BD1-M25','大瓦50','4BD1-M25','','套','',4294967295,73);
INSERT INTO `parts` VALUES (4,0,0,'0','TAIHO','','4BD1-大瓦75','4BD1-M25','大瓦75','4BD1-M25','','套','',0,0.1);
INSERT INTO `parts` VALUES (5,0,0,'0','TAIHO','','4BD1-小瓦标准','4BD1-R00','小标准','4BD1-R00','','套','',0,135);
INSERT INTO `parts` VALUES (6,0,0,'0','TAIHO','','4BD1-小瓦25','4BD1-R25','小瓦25','4BD1-R25','','套','',0,0);
INSERT INTO `parts` VALUES (7,0,0,'0','TAIHO','','4BD1-小瓦50','4BD1-R50','小瓦50','4BD1-R50','','套','',0,1);
INSERT INTO `parts` VALUES (8,0,0,'0','TAIHO','','4BD1-小瓦75','4BD1-R75','小瓦75','4BD1-R75','','套','',0,25);
INSERT INTO `parts` VALUES (9,0,0,'0','TAIHO','','4BD1-止推片','4BD1-T','止推片','4BD1-T','','套','',0,45);
INSERT INTO `parts` VALUES (10,0,0,'0','TAIHO','','4BD1-连杆铜套','4BD1-C','连杆铜套','4BD1-C','','套','',0,70);
INSERT INTO `parts` VALUES (11,0,0,'0','TAIHO','','4BD1-偏心瓦','4BD1-P','偏心瓦','4BD1-P','','套','',0,70);
INSERT INTO `parts` VALUES (12,0,0,'0','TAIHO','','4D130-大瓦标准','4D130-M00','大标准','4D130-M00','','套','',0,128);
INSERT INTO `parts` VALUES (13,0,0,'0','TAIHO','','4D130-大瓦25','4D130-M25','大瓦25','4D130-M25','','套','',0,88);
INSERT INTO `parts` VALUES (14,0,0,'0','TAIHO','','4D130-大瓦50','4D130-M25','大瓦50','4D130-M25','','套','',0,73);
INSERT INTO `parts` VALUES (15,0,0,'0','TAIHO','','4D130-大瓦75','4D130-M25','大瓦75','4D130-M25','','套','',0,0.1);
INSERT INTO `parts` VALUES (16,0,0,'0','TAIHO','','4D130-小瓦标准','4D130-R00','小标准','4D130-R00','','套','',0,0);
INSERT INTO `parts` VALUES (17,0,0,'0','TAIHO','','4D130-小瓦25','4D130-R25','小瓦25','4D130-R25','','套','',0,0);
INSERT INTO `parts` VALUES (18,0,0,'0','TAIHO','','4D130-小瓦50','4D130-R50','小瓦50','4D130-R50','','套','',0,1);
INSERT INTO `parts` VALUES (19,0,0,'0','TAIHO','','4D130-小瓦75','4D130-R75','小瓦75','4D130-R75','','套','',0,0);
INSERT INTO `parts` VALUES (20,0,0,'0','TAIHO','','4D130-止推片','4D130-T','止推片','4D130-T','','套','',0,0);
INSERT INTO `parts` VALUES (21,0,0,'0','TAIHO','','4D130-连杆铜套','4D130-C','连杆铜套','4D130-C','','套','',0,0);
INSERT INTO `parts` VALUES (22,0,0,'0','TAIHO','','4D130-偏心瓦','4D130-P','偏心瓦','4D130-P','','套','',0,70);
INSERT INTO `parts` VALUES (23,0,0,'0','TAIHO','','4D31-大瓦标准','4D31-M00','大标准','4D31-M00','','套','',0,128);
INSERT INTO `parts` VALUES (24,0,0,'0','TAIHO','','4D31-大瓦25','4D31-M25','大瓦25','4D31-M25','','套','',2,88);
INSERT INTO `parts` VALUES (25,0,0,'0','TAIHO','','4D31-大瓦50','4D31-M25','大瓦50','4D31-M25','','套','',4294967295,73);
INSERT INTO `parts` VALUES (26,0,0,'0','TAIHO','','4D31-大瓦75','4D31-M25','大瓦75','4D31-M25','','套','',0,0.1);
INSERT INTO `parts` VALUES (27,0,0,'0','TAIHO','','4D31-小瓦标准','4D31-R00','小标准','4D31-R00','','套','',0,0);
INSERT INTO `parts` VALUES (28,0,0,'0','TAIHO','','4D31-小瓦25','4D31-R25','小瓦25','4D31-R25','','套','',0,0);
INSERT INTO `parts` VALUES (29,0,0,'0','TAIHO','','4D31-小瓦50','4D31-R50','小瓦50','4D31-R50','','套','',0,1);
INSERT INTO `parts` VALUES (30,0,0,'0','TAIHO','','4D31-小瓦75','4D31-R75','小瓦75','4D31-R75','','套','',0,0);
INSERT INTO `parts` VALUES (31,0,0,'0','TAIHO','','4D31-止推片','4D31-T','止推片','4D31-T','','套','',0,0);
INSERT INTO `parts` VALUES (32,0,0,'0','TAIHO','','4D31-连杆铜套','4D31-C','连杆铜套','4D31-C','','套','',0,0);
INSERT INTO `parts` VALUES (33,0,0,'0','TAIHO','','4D31-偏心瓦','4D31-P','偏心瓦','4D31-P','','套','',0,70);
INSERT INTO `parts` VALUES (34,0,0,'0','TAIHO','','4D34-大瓦标准','4D34-M00','大标准','4D34-M00','','套','',0,128);
INSERT INTO `parts` VALUES (35,0,0,'0','TAIHO','','4D34-大瓦25','4D34-M25','大瓦25','4D34-M25','','套','',0,88);
INSERT INTO `parts` VALUES (36,0,0,'0','TAIHO','','4D34-大瓦50','4D34-M25','大瓦50','4D34-M25','','套','',0,73);
INSERT INTO `parts` VALUES (37,0,0,'0','TAIHO','','4D34-大瓦75','4D34-M25','大瓦75','4D34-M25','','套','',0,0.1);
INSERT INTO `parts` VALUES (38,0,0,'0','TAIHO','','4D34-小瓦标准','4D34-R00','小标准','4D34-R00','','套','',0,0);
INSERT INTO `parts` VALUES (39,0,0,'0','TAIHO','','4D34-小瓦25','4D34-R25','小瓦25','4D34-R25','','套','',0,0);
INSERT INTO `parts` VALUES (40,0,0,'0','TAIHO','','4D34-小瓦50','4D34-R50','小瓦50','4D34-R50','4D34','套','',0,89);
INSERT INTO `parts` VALUES (41,0,0,'0','TAIHO','','4D34-小瓦75','4D34-R75','小瓦75','4D34-R75','','套','',0,0);
INSERT INTO `parts` VALUES (42,0,0,'0','TAIHO','','4D34-止推片','4D34-T','止推片','4D34-T','','套','',0,0);
INSERT INTO `parts` VALUES (43,0,0,'0','TAIHO','','4D34-连杆铜套','4D34-C','连杆铜套','4D34-C','','套','',0,0);
INSERT INTO `parts` VALUES (44,0,0,'0','TAIHO','','4D34-偏心瓦','4D34-P','偏心瓦','4D34-P','','套','',0,70);
INSERT INTO `parts` VALUES (45,0,0,'0','TAIHO','','4D94E-大瓦标准','4D94E-M00','大标准','4D94E-M00','','套','',0,128);
INSERT INTO `parts` VALUES (46,0,0,'0','TAIHO','','4D94E-大瓦25','4D94E-M25','大瓦25','4D94E-M25','','套','',0,88);
INSERT INTO `parts` VALUES (47,0,0,'0','TAIHO','','4D94E-大瓦50','4D94E-M25','大瓦25','4D94E-M25','','套','',0,73);
INSERT INTO `parts` VALUES (48,0,0,'0','TAIHO','','4D94E-大瓦75','4D94E-M25','大瓦25','4D94E-M25','','套','',0,0.1);
INSERT INTO `parts` VALUES (49,0,0,'0','TAIHO','','4D94E-小瓦标准','4D94E-R00','小标准','4D94E-R00','','套','',0,0);
INSERT INTO `parts` VALUES (50,0,0,'0','TAIHO','','4D94E-小瓦25','4D94E-R25','小瓦25','4D94E-R25','','套','',0,0);
INSERT INTO `parts` VALUES (51,0,0,'0','TAIHO','','4D94E-小瓦50','4D94E-R50','小瓦50','4D94E-R50','','套','',0,1);
INSERT INTO `parts` VALUES (52,0,0,'0','TAIHO','','4D94E-小瓦75','4D94E-R75','小瓦75','4D94E-R75','','套','',0,0);
INSERT INTO `parts` VALUES (53,0,0,'0','TAIHO','','4D94E-止推片','4D94E-T','止推片','4D94E-T','','套','',0,0);
INSERT INTO `parts` VALUES (54,0,0,'0','TAIHO','','4D94E-连杆铜套','4D94E-C','连杆铜套','4D94E-C','','套','',0,0);
INSERT INTO `parts` VALUES (55,0,0,'0','TAIHO','','4D94E-偏心瓦','4D94E-P','偏心瓦','4D94E-P','','套','',0,70);
INSERT INTO `parts` VALUES (56,0,0,'0','TAIHO','','4D95-大瓦标准','4D95-M00','大标准','4D95-M00','','套','',0,128);
INSERT INTO `parts` VALUES (57,0,0,'0','TAIHO','','4D95-大瓦25','4D95-M25','大瓦25','4D95-M25','','套','',0,88);
INSERT INTO `parts` VALUES (58,0,0,'0','TAIHO','','4D95-大瓦50','4D95-M25','大瓦25','4D95-M25','','套','',0,73);
INSERT INTO `parts` VALUES (59,0,0,'0','TAIHO','','4D95-大瓦75','4D95-M25','大瓦25','4D95-M25','','套','',0,0.1);
INSERT INTO `parts` VALUES (60,0,0,'0','TAIHO','','4D95-小瓦标准','4D95-R00','小标准','4D95-R00','','套','',0,0);
INSERT INTO `parts` VALUES (61,0,0,'0','TAIHO','','4D95-小瓦25','4D95-R25','小瓦25','4D95-R25','','套','',0,0);
INSERT INTO `parts` VALUES (62,0,0,'0','TAIHO','','4D95-小瓦50','4D95-R50','小瓦50','4D95-R50','','套','',0,1);
INSERT INTO `parts` VALUES (63,0,0,'0','TAIHO','','4D95-小瓦75','4D95-R75','小瓦75','4D95-R75','','套','',0,0);
INSERT INTO `parts` VALUES (64,0,0,'0','TAIHO','','4D95-止推片','4D95-T','止推片','4D95-T','','套','',0,0);
INSERT INTO `parts` VALUES (65,0,0,'0','TAIHO','','4D95-连杆铜套','4D95-C','连杆铜套','4D95-C','','套','',0,0);
INSERT INTO `parts` VALUES (66,0,0,'0','TAIHO','','4D95-偏心瓦','4D95-P','偏心瓦','4D95-P','','套','',0,70);
INSERT INTO `parts` VALUES (67,0,0,'0','TAIHO','','4JB1-大瓦标准','4JB1-M00','大标准','4JB1-M00','','套','',4294967295,128);
INSERT INTO `parts` VALUES (68,0,0,'0','TAIHO','','4JB1-大瓦25','4JB1-M25','大瓦25','4JB1-M25','','套','',0,88);
INSERT INTO `parts` VALUES (69,0,0,'0','TAIHO','','4JB1-大瓦50','4JB1-M25','大瓦25','4JB1-M25','','套','',0,73);
INSERT INTO `parts` VALUES (70,0,0,'0','TAIHO','','4JB1-大瓦75','4JB1-M25','大瓦25','4JB1-M25','','套','',0,0.1);
INSERT INTO `parts` VALUES (71,0,0,'0','TAIHO','','4JB1-小瓦标准','4JB1-R00','小标准','4JB1-R00','','套','',0,0);
INSERT INTO `parts` VALUES (72,0,0,'0','TAIHO','','4JB1-小瓦25','4JB1-R25','小瓦25','4JB1-R25','','套','',0,0);
INSERT INTO `parts` VALUES (73,0,0,'0','TAIHO','','4JB1-小瓦50','4JB1-R50','小瓦50','4JB1-R50','','套','',0,1);
INSERT INTO `parts` VALUES (74,0,0,'0','TAIHO','','4JB1-小瓦75','4JB1-R75','小瓦75','4JB1-R75','','套','',0,0);
INSERT INTO `parts` VALUES (75,0,0,'0','TAIHO','','4JB1-止推片','4JB1-T','止推片','4JB1-T','','套','',0,0);
INSERT INTO `parts` VALUES (76,0,0,'0','TAIHO','','4JB1-连杆铜套','4JB1-C','连杆铜套','4JB1-C','','套','',0,0);
INSERT INTO `parts` VALUES (77,0,0,'0','TAIHO','','4JB1-偏心瓦','4JB1-P','偏心瓦','4JB1-P','','套','',0,70);
INSERT INTO `parts` VALUES (78,0,0,'0','TAIHO','','4M40-大瓦标准','4M40-M00','大标准','4M40-M00','','套','',0,128);
INSERT INTO `parts` VALUES (79,0,0,'0','TAIHO','','4M40-大瓦25','4M40-M25','大瓦25','4M40-M25','','套','',0,88);
INSERT INTO `parts` VALUES (80,0,0,'0','TAIHO','','4M40-大瓦50','4M40-M25','大瓦50','4M40-M25','','套','',0,73);
INSERT INTO `parts` VALUES (81,0,0,'0','TAIHO','','4M40-大瓦75','4M40-M25','大瓦75','4M40-M25','','套','',0,0.1);
INSERT INTO `parts` VALUES (82,0,0,'0','TAIHO','','4M40-小瓦标准','4M40-R00','小标准','4M40-R00','','套','',0,0);
INSERT INTO `parts` VALUES (83,0,0,'0','TAIHO','','4M40-小瓦25','4M40-R25','小瓦25','4M40-R25','','套','',0,0);
INSERT INTO `parts` VALUES (84,0,0,'0','TAIHO','','4M40-小瓦50','4M40-R50','小瓦50','4M40-R50','','套','',0,1);
INSERT INTO `parts` VALUES (85,0,0,'0','TAIHO','','4M40-小瓦75','4M40-R75','小瓦75','4M40-R75','','套','',0,0);
INSERT INTO `parts` VALUES (86,0,0,'0','TAIHO','','4M40-止推片','4M40-T','止推片','4M40-T','','套','',0,0);
INSERT INTO `parts` VALUES (87,0,0,'0','TAIHO','','4M40-连杆铜套','4M40-C','连杆铜套','4M40-C','','套','',0,0);
INSERT INTO `parts` VALUES (88,0,0,'0','TAIHO','','4M40-偏心瓦','4M40-P','偏心瓦','4M40-P','','套','',0,70);
INSERT INTO `parts` VALUES (89,0,0,'0','TAIHO','','6BD1-大瓦标准','6BD1-M00','大标准','6BD1-M00','','套','',4294967295,128);
INSERT INTO `parts` VALUES (90,0,0,'0','TAIHO','','6BD1-大瓦25','6BD1-M25','大瓦25','6BD1-M25','','套','',4294967295,88);
INSERT INTO `parts` VALUES (91,0,0,'0','TAIHO','','6BD1-大瓦50','6BD1-M25','大瓦25','6BD1-M25','','套','',0,73);
INSERT INTO `parts` VALUES (92,0,0,'0','TAIHO','','6BD1-大瓦75','6BD1-M25','大瓦25','6BD1-M25','','套','',0,0.1);
INSERT INTO `parts` VALUES (93,0,0,'0','TAIHO','','6BD1-小瓦标准','6BD1-R00','小标准','6BD1-R00','','套','',0,0);
INSERT INTO `parts` VALUES (94,0,0,'0','TAIHO','','6BD1-小瓦25','6BD1-R25','小瓦25','6BD1-R25','','套','',0,0);
INSERT INTO `parts` VALUES (95,0,0,'0','TAIHO','','6BD1-小瓦50','6BD1-R50','小瓦50','6BD1-R50','','套','',0,1);
INSERT INTO `parts` VALUES (96,0,0,'0','TAIHO','','6BD1-小瓦75','6BD1-R75','小瓦75','6BD1-R75','','套','',0,0);
INSERT INTO `parts` VALUES (97,0,0,'0','TAIHO','','6BD1-止推片','6BD1-T','止推片','6BD1-T','','套','',32,0);
INSERT INTO `parts` VALUES (98,0,0,'0','TAIHO','','6BD1-连杆铜套','6BD1-C','连杆铜套','6BD1-C','','套','',0,0);
INSERT INTO `parts` VALUES (99,0,0,'0','TAIHO','','6BD1-偏心瓦','6BD1-P','偏心瓦','6BD1-P','','套','',0,70);
INSERT INTO `parts` VALUES (100,0,0,'0','TAIHO','','6D105-大瓦标准','6D105-M00','大标准','6D105-M00','','套','',0,128);
INSERT INTO `parts` VALUES (101,0,0,'0','TAIHO','','6D105-大瓦25','6D105-M25','大瓦25','6D105-M25','','套','',0,88);
INSERT INTO `parts` VALUES (102,0,0,'0','TAIHO','','6D105-大瓦50','6D105-M25','大瓦25','6D105-M25','','套','',0,73);
INSERT INTO `parts` VALUES (103,0,0,'0','TAIHO','','6D105-大瓦75','6D105-M25','大瓦25','6D105-M25','','套','',0,0.1);
INSERT INTO `parts` VALUES (104,0,0,'0','TAIHO','','6D105-小瓦标准','6D105-R00','小标准','6D105-R00','','套','',0,0);
INSERT INTO `parts` VALUES (105,0,0,'0','TAIHO','','6D105-小瓦25','6D105-R25','小瓦25','6D105-R25','','套','',0,0);
INSERT INTO `parts` VALUES (106,0,0,'0','TAIHO','','6D105-小瓦50','6D105-R50','小瓦50','6D105-R50','','套','',0,1);
INSERT INTO `parts` VALUES (107,0,0,'0','TAIHO','','6D105-小瓦75','6D105-R75','小瓦75','6D105-R75','','套','',0,0);
INSERT INTO `parts` VALUES (108,0,0,'0','TAIHO','','6D105-止推片','6D105-T','止推片','6D105-T','','套','',0,0);
INSERT INTO `parts` VALUES (109,0,0,'0','TAIHO','','6D105-连杆铜套','6D105-C','连杆铜套','6D105-C','','套','',0,0);
INSERT INTO `parts` VALUES (110,0,0,'0','TAIHO','','6D105-偏心瓦','6D105-P','偏心瓦','6D105-P','','套','',0,70);
INSERT INTO `parts` VALUES (111,0,0,'0','TAIHO','','6D125-大瓦标准','6D125-M00','大标准','6D125-M00','','套','',0,128);
INSERT INTO `parts` VALUES (112,0,0,'0','TAIHO','','6D125-大瓦25','6D125-M25','大瓦25','6D125-M25','','套','',0,88);
INSERT INTO `parts` VALUES (113,0,0,'0','TAIHO','','6D125-大瓦50','6D125-M25','大瓦50','6D125-M25','','套','',0,73);
INSERT INTO `parts` VALUES (114,0,0,'0','TAIHO','','6D125-大瓦75','6D125-M25','大瓦75','6D125-M25','','套','',0,0.1);
INSERT INTO `parts` VALUES (115,0,0,'0','TAIHO','','6D125-小瓦标准','6D125-R00','小标准','6D125-R00','','套','',0,0);
INSERT INTO `parts` VALUES (116,0,0,'0','TAIHO','','6D125-小瓦25','6D125-R25','小瓦25','6D125-R25','','套','',0,0);
INSERT INTO `parts` VALUES (117,0,0,'0','TAIHO','','6D125-小瓦50','6D125-R50','小瓦50','6D125-R50','','套','',0,1);
INSERT INTO `parts` VALUES (118,0,0,'0','TAIHO','','6D125-小瓦75','6D125-R75','小瓦75','6D125-R75','','套','',0,0);
INSERT INTO `parts` VALUES (119,0,0,'0','TAIHO','','6D125-止推片','6D125-T','止推片','6D125-T','','套','',0,0);
INSERT INTO `parts` VALUES (120,0,0,'0','TAIHO','','6D125-连杆铜套','6D125-C','连杆铜套','6D125-C','','套','',0,0);
INSERT INTO `parts` VALUES (121,0,0,'0','TAIHO','','6D125-偏心瓦','6D125-P','偏心瓦','6D125-P','','套','',0,70);
INSERT INTO `parts` VALUES (122,0,0,'0','TAIHO','','6D130-大瓦标准','6D130-M00','大标准','6D130-M00','','套','',0,128);
INSERT INTO `parts` VALUES (123,0,0,'0','TAIHO','','6D130-大瓦25','6D130-M25','大瓦25','6D130-M25','','套','',0,88);
INSERT INTO `parts` VALUES (124,0,0,'0','TAIHO','','6D130-大瓦50','6D130-M25','大瓦50','6D130-M25','','套','',0,73);
INSERT INTO `parts` VALUES (125,0,0,'0','TAIHO','','6D130-大瓦75','6D130-M25','大瓦75','6D130-M25','','套','',0,0.1);
INSERT INTO `parts` VALUES (126,0,0,'0','TAIHO','','6D130-小瓦标准','6D130-R00','小标准','6D130-R00','','套','',0,0);
INSERT INTO `parts` VALUES (127,0,0,'0','TAIHO','','6D130-小瓦25','6D130-R25','小瓦25','6D130-R25','','套','',0,0);
INSERT INTO `parts` VALUES (128,0,0,'0','TAIHO','','6D130-小瓦50','6D130-R50','小瓦50','6D130-R50','','套','',0,1);
INSERT INTO `parts` VALUES (129,0,0,'0','TAIHO','','6D130-小瓦75','6D130-R75','小瓦75','6D130-R75','','套','',0,0);
INSERT INTO `parts` VALUES (130,0,0,'0','TAIHO','','6D130-止推片','6D130-T','止推片','6D130-T','','套','',0,0);
INSERT INTO `parts` VALUES (131,0,0,'0','TAIHO','','6D130-连杆铜套','6D130-C','连杆铜套','6D130-C','','套','',0,0);
INSERT INTO `parts` VALUES (132,0,0,'0','TAIHO','','6D130-偏心瓦','6D130-P','偏心瓦','6D130-P','','套','',0,70);
INSERT INTO `parts` VALUES (133,0,0,'0','TAIHO','','6D15-大瓦标准','6D15-M00','大标准','6D15-M00','','套','',0,128);
INSERT INTO `parts` VALUES (134,0,0,'0','TAIHO','','6D15-大瓦25','6D15-M25','大瓦25','6D15-M25','','套','',0,88);
INSERT INTO `parts` VALUES (135,0,0,'0','TAIHO','','6D15-大瓦50','6D15-M25','大瓦50','6D15-M25','','套','',0,73);
INSERT INTO `parts` VALUES (136,0,0,'0','TAIHO','','6D15-大瓦75','6D15-M25','大瓦75','6D15-M25','','套','',0,0.1);
INSERT INTO `parts` VALUES (137,0,0,'0','TAIHO','','6D15-小瓦标准','6D15-R00','小标准','6D15-R00','','套','',0,0);
INSERT INTO `parts` VALUES (138,0,0,'0','TAIHO','','6D15-小瓦25','6D15-R25','小瓦25','6D15-R25','','套','',0,0);
INSERT INTO `parts` VALUES (139,0,0,'0','TAIHO','','6D15-小瓦50','6D15-R50','小瓦50','6D15-R50','','套','',0,1);
INSERT INTO `parts` VALUES (140,0,0,'0','TAIHO','','6D15-小瓦75','6D15-R75','小瓦75','6D15-R75','','套','',0,0);
INSERT INTO `parts` VALUES (141,0,0,'0','TAIHO','','6D15-止推片','6D15-T','止推片','6D15-T','','套','',0,0);
INSERT INTO `parts` VALUES (142,0,0,'0','TAIHO','','6D15-连杆铜套','6D15-C','连杆铜套','6D15-C','','套','',0,0);
INSERT INTO `parts` VALUES (143,0,0,'0','TAIHO','','6D15-偏心瓦','6D15-P','偏心瓦','6D15-P','','套','',0,70);
INSERT INTO `parts` VALUES (144,0,0,'0','TAIHO','','6D22-大瓦标准','6D22-M00','大标准','6D22-M00','','套','',0,128);
INSERT INTO `parts` VALUES (145,0,0,'0','TAIHO','','6D22-大瓦25','6D22-M25','大瓦25','6D22-M25','','套','',0,88);
INSERT INTO `parts` VALUES (146,0,0,'0','TAIHO','','6D22-大瓦50','6D22-M25','大瓦25','6D22-M25','','套','',0,73);
INSERT INTO `parts` VALUES (147,0,0,'0','TAIHO','','6D22-大瓦75','6D22-M25','大瓦25','6D22-M25','','套','',0,0.1);
INSERT INTO `parts` VALUES (148,0,0,'0','TAIHO','','6D22-小瓦标准','6D22-R00','小标准','6D22-R00','','套','',0,0);
INSERT INTO `parts` VALUES (149,0,0,'0','TAIHO','','6D22-小瓦25','6D22-R25','小瓦25','6D22-R25','','套','',0,0);
INSERT INTO `parts` VALUES (150,0,0,'0','TAIHO','','6D22-小瓦50','6D22-R50','小瓦50','6D22-R50','','套','',0,1);
INSERT INTO `parts` VALUES (151,0,0,'0','TAIHO','','6D22-小瓦75','6D22-R75','小瓦75','6D22-R75','','套','',0,0);
INSERT INTO `parts` VALUES (152,0,0,'0','TAIHO','','6D22-止推片','6D22-T','止推片','6D22-T','','套','',0,0);
INSERT INTO `parts` VALUES (153,0,0,'0','TAIHO','','6D22-连杆铜套','6D22-C','连杆铜套','6D22-C','','套','',0,0);
INSERT INTO `parts` VALUES (154,0,0,'0','TAIHO','','6D22-偏心瓦','6D22-P','偏心瓦','6D22-P','','套','',0,70);
INSERT INTO `parts` VALUES (155,0,0,'0','TAIHO','','6D31-大瓦标准','6D31-M00','大标准','6D31-M00','','套','',0,128);
INSERT INTO `parts` VALUES (156,0,0,'0','TAIHO','','6D31-大瓦25','6D31-M25','大瓦25','6D31-M25','','套','',0,88);
INSERT INTO `parts` VALUES (157,0,0,'0','TAIHO','','6D31-大瓦50','6D31-M25','大瓦25','6D31-M25','','套','',0,73);
INSERT INTO `parts` VALUES (158,0,0,'0','TAIHO','','6D31-大瓦75','6D31-M25','大瓦25','6D31-M25','','套','',0,0.1);
INSERT INTO `parts` VALUES (159,0,0,'0','TAIHO','','6D31-小瓦标准','6D31-R00','小标准','6D31-R00','','套','',0,0);
INSERT INTO `parts` VALUES (160,0,0,'0','TAIHO','','6D31-小瓦25','6D31-R25','小瓦25','6D31-R25','','套','',0,0);
INSERT INTO `parts` VALUES (161,0,0,'0','TAIHO','','6D31-小瓦50','6D31-R50','小瓦50','6D31-R50','','套','',0,1);
INSERT INTO `parts` VALUES (162,0,0,'0','TAIHO','','6D31-小瓦75','6D31-R75','小瓦75','6D31-R75','','套','',0,0);
INSERT INTO `parts` VALUES (163,0,0,'0','TAIHO','','6D31-止推片','6D31-T','止推片','6D31-T','','套','',0,0);
INSERT INTO `parts` VALUES (164,0,0,'0','TAIHO','','6D31-连杆铜套','6D31-C','连杆铜套','6D31-C','','套','',0,0);
INSERT INTO `parts` VALUES (165,0,0,'0','TAIHO','','6D31-偏心瓦','6D31-P','偏心瓦','6D31-P','','套','',0,70);
INSERT INTO `parts` VALUES (166,0,0,'0','TAIHO','','6D34-大瓦标准','6D34-M00','大标准','6D34-M00','','套','',0,128);
INSERT INTO `parts` VALUES (167,0,0,'0','TAIHO','','6D34-大瓦25','6D34-M25','大瓦25','6D34-M25','','套','',0,88);
INSERT INTO `parts` VALUES (168,0,0,'0','TAIHO','','6D34-大瓦50','6D34-M25','大瓦50','6D34-M25','','套','',0,73);
INSERT INTO `parts` VALUES (169,0,0,'0','TAIHO','','6D34-大瓦75','6D34-M25','大瓦75','6D34-M25','','套','',0,0.1);
INSERT INTO `parts` VALUES (170,0,0,'0','TAIHO','','6D34-小瓦标准','6D34-R00','小标准','6D34-R00','','套','',0,0);
INSERT INTO `parts` VALUES (171,0,0,'0','TAIHO','','6D34-小瓦25','6D34-R25','小瓦25','6D34-R25','','套','',0,0);
INSERT INTO `parts` VALUES (172,0,0,'0','TAIHO','','6D34-小瓦50','6D34-R50','小瓦50','6D34-R50','','套','',0,1);
INSERT INTO `parts` VALUES (173,0,0,'0','TAIHO','','6D34-小瓦75','6D34-R75','小瓦75','6D34-R75','','套','',0,0);
INSERT INTO `parts` VALUES (174,0,0,'0','TAIHO','','6D34-止推片','6D34-T','止推片','6D34-T','','套','',0,0);
INSERT INTO `parts` VALUES (175,0,0,'0','TAIHO','','6D34-连杆铜套','6D34-C','连杆铜套','6D34-C','','套','',0,0);
INSERT INTO `parts` VALUES (176,0,0,'0','TAIHO','','6D34-偏心瓦','6D34-P','偏心瓦','6D34-P','','套','',0,70);
INSERT INTO `parts` VALUES (177,0,0,'0','TAIHO','','6D95-大瓦标准','6D95-M00','大标准','6D95-M00','','套','',0,128);
INSERT INTO `parts` VALUES (178,0,0,'0','TAIHO','','6D95-大瓦25','6D95-M25','大瓦25','6D95-M25','','套','',0,88);
INSERT INTO `parts` VALUES (179,0,0,'0','TAIHO','','6D95-大瓦50','6D95-M25','大瓦50','6D95-M25','','套','',0,73);
INSERT INTO `parts` VALUES (180,0,0,'0','TAIHO','','6D95-大瓦75','6D95-M25','大瓦75','6D95-M25','','套','',0,0.1);
INSERT INTO `parts` VALUES (181,0,0,'0','TAIHO','','6D95-小瓦标准','6D95-R00','小标准','6D95-R00','','套','',0,0);
INSERT INTO `parts` VALUES (182,0,0,'0','TAIHO','','6D95-小瓦25','6D95-R25','小瓦25','6D95-R25','','套','',0,0);
INSERT INTO `parts` VALUES (183,0,0,'0','TAIHO','','6D95-小瓦50','6D95-R50','小瓦50','6D95-R50','','套','',0,1);
INSERT INTO `parts` VALUES (184,0,0,'0','TAIHO','','6D95-小瓦75','6D95-R75','小瓦75','6D95-R75','','套','',0,0);
INSERT INTO `parts` VALUES (185,0,0,'0','TAIHO','','6D95-止推片','6D95-T','止推片','6D95-T','','套','',0,0);
INSERT INTO `parts` VALUES (186,0,0,'0','TAIHO','','6D95-连杆铜套','6D95-C','连杆铜套','6D95-C','','套','',0,0);
INSERT INTO `parts` VALUES (187,0,0,'0','TAIHO','','6D95-偏心瓦','6D95-P','偏心瓦','6D95-P','','套','',0,70);
INSERT INTO `parts` VALUES (188,0,0,'0','TAIHO','','6SD1-大瓦标准','6SD1-M00','大标准','6SD1-M00','','套','',0,128);
INSERT INTO `parts` VALUES (189,0,0,'0','TAIHO','','6SD1-大瓦25','6SD1-M25','大瓦25','6SD1-M25','','套','',6,88);
INSERT INTO `parts` VALUES (190,0,0,'0','TAIHO','','6SD1-大瓦50','6SD1-M25','大瓦25','6SD1-M25','','套','',0,73);
INSERT INTO `parts` VALUES (191,0,0,'0','TAIHO','','6SD1-大瓦75','6SD1-M25','大瓦25','6SD1-M25','','套','',0,0.1);
INSERT INTO `parts` VALUES (192,0,0,'0','TAIHO','','6SD1-小瓦标准','6SD1-R00','小标准','6SD1-R00','','套','',0,0);
INSERT INTO `parts` VALUES (193,0,0,'0','TAIHO','','6SD1-小瓦25','6SD1-R25','小瓦25','6SD1-R25','','套','',0,0);
INSERT INTO `parts` VALUES (194,0,0,'0','TAIHO','','6SD1-小瓦50','6SD1-R50','小瓦50','6SD1-R50','','套','',0,1);
INSERT INTO `parts` VALUES (195,0,0,'0','TAIHO','','6SD1-小瓦75','6SD1-R75','小瓦75','6SD1-R75','','套','',0,0);
INSERT INTO `parts` VALUES (196,0,0,'0','TAIHO','','6SD1-止推片','6SD1-T','止推片','6SD1-T','','套','',0,0);
INSERT INTO `parts` VALUES (197,0,0,'0','TAIHO','','6SD1-连杆铜套','6SD1-C','连杆铜套','6SD1-C','','套','',0,0);
INSERT INTO `parts` VALUES (198,0,0,'0','TAIHO','','6SD1-偏心瓦','6SD1-P','偏心瓦','6SD1-P','','套','',0,70);
INSERT INTO `parts` VALUES (199,0,0,'0','TAIHO','','S4K-大瓦标准','S4K-M00','大标准','S4K-M00','','套','',0,128);
INSERT INTO `parts` VALUES (200,0,0,'0','TAIHO','','S4K-大瓦25','S4K-M25','大瓦25','S4K-M25','','套','',0,88);
INSERT INTO `parts` VALUES (201,0,0,'0','TAIHO','','S4K-大瓦50','S4K-M25','大瓦25','S4K-M25','','套','',0,73);
INSERT INTO `parts` VALUES (202,0,0,'0','TAIHO','','S4K-大瓦75','S4K-M25','大瓦25','S4K-M25','','套','',0,0.1);
INSERT INTO `parts` VALUES (203,0,0,'0','TAIHO','','S4K-小瓦标准','S4K-R00','小标准','S4K-R00','','套','',0,0);
INSERT INTO `parts` VALUES (204,0,0,'0','TAIHO','','S4K-小瓦25','S4K-R25','小瓦25','S4K-R25','','套','',0,0);
INSERT INTO `parts` VALUES (205,0,0,'0','TAIHO','','S4K-小瓦50','S4K-R50','小瓦50','S4K-R50','','套','',0,1);
INSERT INTO `parts` VALUES (206,0,0,'0','TAIHO','','S4K-小瓦75','S4K-R75','小瓦75','S4K-R75','','套','',0,0);
INSERT INTO `parts` VALUES (207,0,0,'0','TAIHO','','S4K-止推片','S4K-T','止推片','S4K-T','','套','',0,0);
INSERT INTO `parts` VALUES (208,0,0,'0','TAIHO','','S4K-连杆铜套','S4K-C','连杆铜套','S4K-C','','套','',0,0);
INSERT INTO `parts` VALUES (209,0,0,'0','TAIHO','','S4K-偏心瓦','S4K-P','偏心瓦','S4K-P','','套','',0,70);
INSERT INTO `parts` VALUES (210,0,0,'0','TAIHO','','S6K-大瓦标准','S6K-M00','大标准','S6K-M00','','套','',0,128);
INSERT INTO `parts` VALUES (211,0,0,'0','TAIHO','','S6K-大瓦25','S6K-M25','大瓦25','S6K-M25','','套','',0,88);
INSERT INTO `parts` VALUES (212,0,0,'0','TAIHO','','S6K-大瓦50','S6K-M25','大瓦25','S6K-M25','','套','',0,73);
INSERT INTO `parts` VALUES (213,0,0,'0','TAIHO','','S6K-大瓦75','S6K-M25','大瓦25','S6K-M25','','套','',0,0.1);
INSERT INTO `parts` VALUES (214,0,0,'0','TAIHO','','S6K-小瓦标准','S6K-R00','小标准','S6K-R00','','套','',0,0);
INSERT INTO `parts` VALUES (215,0,0,'0','TAIHO','','S6K-小瓦25','S6K-R25','小瓦25','S6K-R25','','套','',0,0);
INSERT INTO `parts` VALUES (216,0,0,'0','TAIHO','','S6K-小瓦50','S6K-R50','小瓦50','S6K-R50','','套','',0,1);
INSERT INTO `parts` VALUES (217,0,0,'0','TAIHO','','S6K-小瓦75','S6K-R75','小瓦75','S6K-R75','','套','',0,0);
INSERT INTO `parts` VALUES (218,0,0,'0','TAIHO','','S6K-止推片','S6K-T','止推片','S6K-T','','套','',0,0);
INSERT INTO `parts` VALUES (219,0,0,'0','TAIHO','','S6K-连杆铜套','S6K-C','连杆铜套','S6K-C','','套','',0,0);
INSERT INTO `parts` VALUES (220,0,0,'0','TAIHO','','S6K-偏心瓦','S6K-P','偏心瓦','S6K-P','','套','',0,70);
INSERT INTO `parts` VALUES (221,0,0,'0','TAIHO','','HO6CT-大瓦标准','HO6CT-M00','大标准','HO6CT-M00','','套','',0,128);
INSERT INTO `parts` VALUES (222,0,0,'0','TAIHO','','HO6CT-大瓦25','HO6CT-M25','大瓦25','HO6CT-M25','','套','',0,88);
INSERT INTO `parts` VALUES (223,0,0,'0','TAIHO','','HO6CT-大瓦50','HO6CT-M25','大瓦50','HO6CT-M25','','套','',0,73);
INSERT INTO `parts` VALUES (224,0,0,'0','TAIHO','','HO6CT-大瓦75','HO6CT-M25','大瓦75','HO6CT-M25','','套','',0,0.1);
INSERT INTO `parts` VALUES (225,0,0,'0','TAIHO','','HO6CT-小瓦标准','HO6CT-R00','小标准','HO6CT-R00','','套','',0,0);
INSERT INTO `parts` VALUES (226,0,0,'0','TAIHO','','HO6CT-小瓦25','HO6CT-R25','小瓦25','HO6CT-R25','','套','',0,0);
INSERT INTO `parts` VALUES (227,0,0,'0','TAIHO','','HO6CT-小瓦50','HO6CT-R50','小瓦50','HO6CT-R50','','套','',0,1);
INSERT INTO `parts` VALUES (228,0,0,'0','TAIHO','','HO6CT-小瓦75','HO6CT-R75','小瓦75','HO6CT-R75','','套','',0,0);
INSERT INTO `parts` VALUES (229,0,0,'0','TAIHO','','HO6CT-止推片','HO6CT-T','止推片','HO6CT-T','','套','',0,0);
INSERT INTO `parts` VALUES (230,0,0,'0','TAIHO','','HO6CT-连杆铜套','HO6CT-C','连杆铜套','HO6CT-C','','套','',0,0);
INSERT INTO `parts` VALUES (231,0,0,'0','TAIHO','','HO6CT-偏心瓦','HO6CT-P','偏心瓦','HO6CT-P','','套','',0,70);

#
# Table structure for table prices
#

CREATE TABLE `prices` (
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Dumping data for table prices
#


#
# Table structure for table provider
#

CREATE TABLE `provider` (
  `id` int(11) NOT NULL,
  `goods_id` int(11) default NULL,
  `spec_id` int(11) default NULL,
  `picture` varchar(45) default NULL,
  `demo` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Dumping data for table provider
#


#
# Table structure for table publish
#

CREATE TABLE `publish` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `fid` int(11) default NULL,
  `brand` varchar(11) default NULL,
  `series` varchar(11) default NULL,
  `module` varchar(11) default NULL,
  `title` varchar(500) default NULL,
  `description` varchar(1000) default NULL,
  `company` varchar(255) default NULL,
  `address` varchar(255) default NULL,
  `telephone` varchar(20) default NULL,
  `mobile` varchar(20) default NULL,
  `fax` varchar(20) default NULL,
  `price` varchar(30) default NULL,
  `picture` varchar(100) default NULL,
  `level` tinyint(3) default NULL,
  `star` tinyint(3) default NULL,
  `url` varchar(255) default NULL,
  `link` varchar(255) default NULL,
  `date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8;

#
# Dumping data for table publish
#


#
# Table structure for table purchase
#

CREATE TABLE `purchase` (
  `Id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Dumping data for table purchase
#


#
# Table structure for table sales
#

CREATE TABLE `sales` (
  `id` int(11) NOT NULL auto_increment,
  `bill` int(11) default NULL,
  `company` int(11) default NULL,
  `part` int(11) default NULL,
  `price` float(10,2) default NULL,
  `quantity` int(11) unsigned default NULL,
  `total` float(10,2) default NULL,
  `date` datetime default NULL,
  `memo` varchar(100) default NULL,
  `history` smallint(3) NOT NULL default '0',
  `type` smallint(3) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

#
# Dumping data for table sales
#

INSERT INTO `sales` VALUES (76,59,13,25,73,5,365,'2012-02-24 07:22:37','',0,0);
INSERT INTO `sales` VALUES (78,61,2,89,128,10,1280,'2012-02-24 07:43:51','',0,0);
INSERT INTO `sales` VALUES (79,61,2,2,88,8,704,'2012-02-24 07:43:51','',0,0);
INSERT INTO `sales` VALUES (80,61,2,67,128,9,1152,'2012-02-24 07:43:51','',0,0);
INSERT INTO `sales` VALUES (81,62,2,3,73,2,146,'2012-02-24 08:26:49','',0,3);
INSERT INTO `sales` VALUES (82,62,2,90,88,5,440,'2012-02-24 08:26:49','',0,3);
INSERT INTO `sales` VALUES (83,63,3,3,73,2,146,'2012-02-24 09:00:17','',0,3);
INSERT INTO `sales` VALUES (84,63,3,97,50,32,1600,'2012-02-24 09:00:17','',0,3);

#
# Table structure for table series
#

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `name` varchar(45) character set latin1 default NULL,
  `shortname` varchar(45) character set latin1 default NULL,
  `brand_id` int(11) default NULL,
  `type` int(11) default NULL,
  `hw` varchar(10) default NULL,
  `hp` varchar(10) default NULL,
  `kg` varchar(10) default NULL,
  `lb` varchar(10) default NULL,
  `m3` varchar(10) default NULL,
  `yd3` varchar(10) default NULL,
  `demo` varchar(45) character set latin1 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Type: 小型挖掘机/履带式挖掘机/轮式挖掘机';

#
# Dumping data for table series
#

INSERT INTO `series` VALUES (1,'PC01-1',NULL,1,1,'2.6',NULL,'3.5','380','840','0.008',NULL);
INSERT INTO `series` VALUES (2,'PC02-1',NULL,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `series` VALUES (3,'PC09-1',NULL,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `series` VALUES (4,'PC15MRX-1',NULL,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `series` VALUES (5,'PC20MRX-1',NULL,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `series` VALUES (6,'PC27MRX-1',NULL,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `series` VALUES (7,'PC30MR-2',NULL,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `series` VALUES (8,'PC35MR-2',NULL,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `series` VALUES (9,'PC40MR-2',NULL,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `series` VALUES (10,'PC50MR-2',NULL,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `series` VALUES (11,'PC60-7',NULL,1,2,'40','55','6300','0.28',NULL,NULL,NULL);
INSERT INTO `series` VALUES (12,'PC130-7',NULL,1,2,'66','90','12600','0.53',NULL,NULL,NULL);
INSERT INTO `series` VALUES (13,'PC200-8',NULL,1,2,'110','150','19900','0.8',NULL,NULL,NULL);
INSERT INTO `series` VALUES (14,'PC210-8',NULL,1,2,'110','150','20000','0.9',NULL,NULL,NULL);
INSERT INTO `series` VALUES (15,'PC220-8',NULL,1,2,'125','170','23100','1',NULL,NULL,NULL);
INSERT INTO `series` VALUES (16,'PC240LC-8',NULL,1,2,'125','170','25130','1.2',NULL,NULL,NULL);
INSERT INTO `series` VALUES (17,'PC270-7',NULL,1,2,'134','182','27350','1.3',NULL,NULL,NULL);
INSERT INTO `series` VALUES (18,'PC300-7',NULL,1,2,'180','245','31200','1.4',NULL,NULL,NULL);
INSERT INTO `series` VALUES (19,'PC360-7',NULL,1,2,'180','245','33000','1.6',NULL,NULL,NULL);
INSERT INTO `series` VALUES (20,'PC400-7',NULL,1,2,'246','335','42400','1.9',NULL,NULL,NULL);
INSERT INTO `series` VALUES (21,'PC450-7',NULL,1,2,'246','335','45500','2.1',NULL,NULL,NULL);
INSERT INTO `series` VALUES (22,'PC600-7',NULL,1,2,'287','385','56600','2.0-3.5',NULL,NULL,NULL);
INSERT INTO `series` VALUES (23,'PC600LC-7',NULL,1,2,'287','385','57600','2.0-3.5',NULL,NULL,NULL);
INSERT INTO `series` VALUES (24,'PC750-7',NULL,1,2,'338','454','72370','2.8-3.4',NULL,NULL,NULL);
INSERT INTO `series` VALUES (25,'PC750SE-7',NULL,1,2,'338','454','73170','4.0-4.5',NULL,NULL,NULL);
INSERT INTO `series` VALUES (26,'PC800',NULL,1,2,'338','454','76070','3.4',NULL,NULL,NULL);
INSERT INTO `series` VALUES (27,'PC800SE-7',NULL,1,2,'338','454','75570','4.0-4.5',NULL,NULL,NULL);
INSERT INTO `series` VALUES (28,'PC1250-7',NULL,1,2,'485','651','106700','3.5-5.2',NULL,NULL,NULL);
INSERT INTO `series` VALUES (29,'PC1250LC-7',NULL,1,2,'485','651','113200','3.5-5.3',NULL,NULL,NULL);
INSERT INTO `series` VALUES (30,'PC1250SP-7',NULL,1,2,'485','651','109500','6.7',NULL,NULL,NULL);
INSERT INTO `series` VALUES (31,'PC1400-1',NULL,1,2,'565','758','137000','8.5-9.5',NULL,NULL,NULL);
INSERT INTO `series` VALUES (32,'PC1800-6',NULL,1,2,'676','908','180000','5.6-12.0',NULL,NULL,NULL);
INSERT INTO `series` VALUES (33,'PC3000-1',NULL,1,2,'940','1260','253000','12.0-20.0',NULL,NULL,NULL);
INSERT INTO `series` VALUES (34,'PC4000-6',NULL,1,2,'1400','1875','380000','16.0-28.0',NULL,NULL,NULL);
INSERT INTO `series` VALUES (35,'PC5500-6',NULL,1,2,'1880','2520','500000','21.0-36.0',NULL,NULL,NULL);
INSERT INTO `series` VALUES (36,'PC8000-6',NULL,1,2,'3000','4020','710000','28.0-48.0',NULL,NULL,NULL);
INSERT INTO `series` VALUES (37,'PC400-6',NULL,1,3,'228','306','43100','95020','2.6','3.4',NULL);
INSERT INTO `series` VALUES (38,'PC400LC-6',NULL,1,3,'228','306','44300','97660','2.6','3.4',NULL);
INSERT INTO `series` VALUES (39,'PC750-6',NULL,1,3,'338','454','75700','166890','3.8-4.5','5.0-5.9',NULL);
INSERT INTO `series` VALUES (40,'PC1250-7',NULL,1,3,'485','651','110000','242510','6.5','8.5',NULL);
INSERT INTO `series` VALUES (41,'PC1400-1',NULL,1,3,'565','758','140000','308650','8.5-10.4','11.1-13.6',NULL);
INSERT INTO `series` VALUES (42,'PC1800-6',NULL,1,3,'676','908','180000','396830','11','14.4',NULL);
INSERT INTO `series` VALUES (43,'PC3000-1',NULL,1,3,'940','1260','250000','551150','10.0-20.0','13.1-26.2',NULL);
INSERT INTO `series` VALUES (44,'PC4000-6',NULL,1,3,'1400','1875','370000','815700','16.0-28.0','20.9-36.6',NULL);
INSERT INTO `series` VALUES (45,'PC5500-6',NULL,1,NULL,'1880','2520','500000','1102300','20.0-34.0','26.2-44.5',NULL);
INSERT INTO `series` VALUES (46,'PC8000-1',NULL,1,NULL,'3000','4020','700000','1543220','28.0-48.0','36.6-62.8',NULL);

#
# Table structure for table session
#

CREATE TABLE `session` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL,
  `ip` varchar(50) default NULL,
  `last` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Dumping data for table session
#


#
# Table structure for table specs
#

CREATE TABLE `specs` (
  `id` int(11) NOT NULL,
  `part_id` int(11) default NULL,
  `desc` varchar(45) default NULL,
  `picture` varchar(45) default NULL,
  `class` varchar(45) default NULL,
  `demo` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Dumping data for table specs
#


/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

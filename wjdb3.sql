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
INSERT INTO `access` VALUES (2,'lwx','login','login',NULL,1,'2011-11-16 07:20:15');
INSERT INTO `access` VALUES (3,'lwx','sale','sale',NULL,1,'2011-11-16 07:20:15');
INSERT INTO `access` VALUES (4,'lwx','buy','buy','all',1,'2012-02-21 10:05:57');
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
INSERT INTO `account` VALUES (42,'sale','销售庄户','销售','sale','','4564564','杭州市上城区鸿润挖机齿轮行位于杭州市上城区','','','','welin@CROSSBEAMSYS.COM','238522828','','',0,0,'2012-02-22');
INSERT INTO `account` VALUES (43,'test','test','test','test','','3636436','广东广州天河区东圃工程机型市场','','','','welin@CROSSBEAMSYS.COM','238522828','','',0,0,'2012-02-22');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `warehouse` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

#
# Dumping data for table bills
#

INSERT INTO `bills` VALUES (76,2,0,1460,'2012-02-26 22:33:00','C226668296161304','','','采购单',1,0,NULL);
INSERT INTO `bills` VALUES (77,3,0,1314,'2012-02-26 22:34:00','C226668537733434','','','入库单',3,0,NULL);
INSERT INTO `bills` VALUES (78,13,0,73,'2012-02-26 22:35:00','C226669121190914','','','销售单',0,0,NULL);
INSERT INTO `bills` VALUES (79,3,0,154,'2012-02-26 22:35:00','C226669291551482','','','销售单',0,0,NULL);
INSERT INTO `bills` VALUES (80,3,0,77,'2012-02-26 22:46:00','C226675862150410','','','销售单',0,0,NULL);
INSERT INTO `bills` VALUES (81,3,0,77,'2012-02-26 22:46:00','C226675862150410','','','销售单',0,0,0);
INSERT INTO `bills` VALUES (82,3,0,77,'2012-02-26 22:46:00','C226675862150410','','','销售单',0,0,0);
INSERT INTO `bills` VALUES (83,2,0,840,'2012-02-27 16:57:00','C227330378056729','','','',1,5,2);

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
# Table structure for table cataloy
#

CREATE TABLE `cataloy` (
  `id` int(11) NOT NULL,
  `fid` int(11) default NULL,
  `name` varchar(45) default NULL,
  `shortname` varchar(45) default NULL,
  `group` int(11) default NULL,
  `desc` varchar(45) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Dumping data for table cataloy
#

INSERT INTO `cataloy` VALUES (1,NULL,'发动机',NULL,NULL,NULL);
INSERT INTO `cataloy` VALUES (2,NULL,'液压系统',NULL,NULL,NULL);
INSERT INTO `cataloy` VALUES (3,NULL,'电器',NULL,NULL,NULL);
INSERT INTO `cataloy` VALUES (4,NULL,'齿轮 ',NULL,NULL,NULL);
INSERT INTO `cataloy` VALUES (5,NULL,'轴承',NULL,NULL,NULL);
INSERT INTO `cataloy` VALUES (6,NULL,'滤清器',NULL,NULL,NULL);
INSERT INTO `cataloy` VALUES (7,NULL,'橡胶',NULL,NULL,NULL);
INSERT INTO `cataloy` VALUES (8,NULL,'大小臂',NULL,NULL,NULL);
INSERT INTO `cataloy` VALUES (9,NULL,'工作油缸',NULL,NULL,NULL);
INSERT INTO `cataloy` VALUES (10,NULL,'底盘件',NULL,NULL,NULL);
INSERT INTO `cataloy` VALUES (11,NULL,'\t密封件',NULL,NULL,NULL);
INSERT INTO `cataloy` VALUES (12,NULL,'修理包',NULL,NULL,NULL);
INSERT INTO `cataloy` VALUES (13,NULL,'维修工具',NULL,NULL,NULL);
INSERT INTO `cataloy` VALUES (14,NULL,'驾驶室',NULL,NULL,NULL);
INSERT INTO `cataloy` VALUES (15,NULL,'电磁阀',NULL,NULL,NULL);
INSERT INTO `cataloy` VALUES (16,NULL,'\t接头管路',NULL,NULL,NULL);
INSERT INTO `cataloy` VALUES (17,NULL,'挖斗',NULL,NULL,NULL);
INSERT INTO `cataloy` VALUES (18,NULL,'润滑油',NULL,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

#
# Dumping data for table company
#

INSERT INTO `company` VALUES (1,'爱爱爱','aaa','aa','aaa','aa','aa','aa','aa','aa','aa');
INSERT INTO `company` VALUES (2,'武汉广福工程机械23','武汉广福22','guangfu','gf','武汉天河东圃珠村','','','','','');
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
INSERT INTO `company` VALUES (14,'亦晓','亦晓','yx','yixiao','黄埔国际机械城','','','','','');

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
  `quantity` int(11) unsigned default '0',
  `price` float(10,2) default '0.00',
  `totals` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=485 DEFAULT CHARSET=utf8;

#
# Dumping data for table parts
#

INSERT INTO `parts` VALUES (232,0,0,'0','TAIHO','','4BD1-大瓦标准','4BD1-M00','大标准','4BD1-M00','','套','4BD1',5,128,NULL);
INSERT INTO `parts` VALUES (233,0,0,'0','TAIHO','','4BD1-大瓦25','4BD1-M25','大瓦25','4BD1-M25','','套','',1,88,NULL);
INSERT INTO `parts` VALUES (234,0,0,'0','TAIHO','','4BD1-大瓦50','4BD1-M25','大瓦50','4BD1-M25','','套','',12,73,NULL);
INSERT INTO `parts` VALUES (235,0,0,'0','TAIHO','','4BD1-大瓦75','4BD1-M25','大瓦75','4BD1-M25','','套','',12,0.1,NULL);
INSERT INTO `parts` VALUES (236,0,0,'0','TAIHO','','4BD1-小瓦标准','4BD1-R00','小标准','4BD1-R00','','套','',0,135,NULL);
INSERT INTO `parts` VALUES (237,0,0,'0','TAIHO','','4BD1-小瓦25','4BD1-R25','小瓦25','4BD1-R25','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (238,0,0,'0','TAIHO','','4BD1-小瓦50','4BD1-R50','小瓦50','4BD1-R50','','套','',0,1,NULL);
INSERT INTO `parts` VALUES (239,0,0,'0','TAIHO','','4BD1-小瓦75','4BD1-R75','小瓦75','4BD1-R75','','套','',0,25,NULL);
INSERT INTO `parts` VALUES (240,0,0,'0','TAIHO','','4BD1-止推片','4BD1-T','止推片','4BD1-T','','套','',0,45,NULL);
INSERT INTO `parts` VALUES (241,0,0,'0','TAIHO','','4BD1-连杆铜套','4BD1-C','连杆铜套','4BD1-C','','套','',0,70,NULL);
INSERT INTO `parts` VALUES (242,0,0,'0','TAIHO','','4BD1-偏心瓦','4BD1-P','偏心瓦','4BD1-P','','套','',0,70,NULL);
INSERT INTO `parts` VALUES (243,0,0,'0','TAIHO','','4D31-大瓦标准','4D31-M00','大标准','4D31-M00','','套','',0,128,NULL);
INSERT INTO `parts` VALUES (244,0,0,'0','TAIHO','','4D31-大瓦25','4D31-M25','大瓦25','4D31-M25','','套','',2,88,NULL);
INSERT INTO `parts` VALUES (245,0,0,'0','TAIHO','','4D31-大瓦50','4D31-M25','大瓦50','4D31-M25','','套','',0,73,NULL);
INSERT INTO `parts` VALUES (246,0,0,'0','TAIHO','','4D31-大瓦75','4D31-M25','大瓦75','4D31-M25','','套','',0,0.1,NULL);
INSERT INTO `parts` VALUES (247,0,0,'0','TAIHO','','4D31-小瓦标准','4D31-R00','小标准','4D31-R00','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (248,0,0,'0','TAIHO','','4D31-小瓦25','4D31-R25','小瓦25','4D31-R25','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (249,0,0,'0','TAIHO','','4D31-小瓦50','4D31-R50','小瓦50','4D31-R50','','套','',0,1,NULL);
INSERT INTO `parts` VALUES (250,0,0,'0','TAIHO','','4D31-小瓦75','4D31-R75','小瓦75','4D31-R75','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (251,0,0,'0','TAIHO','','4D31-止推片','4D31-T','止推片','4D31-T','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (252,0,0,'0','TAIHO','','4D31-连杆铜套','4D31-C','连杆铜套','4D31-C','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (253,0,0,'0','TAIHO','','4D31-偏心瓦','4D31-P','偏心瓦','4D31-P','','套','',0,70,NULL);
INSERT INTO `parts` VALUES (254,0,0,'0','TAIHO','','4D34-大瓦标准','4D34-M00','大标准','4D34-M00','','套','',0,128,NULL);
INSERT INTO `parts` VALUES (255,0,0,'0','TAIHO','','4D34-大瓦25','4D34-M25','大瓦25','4D34-M25','','套','',0,88,NULL);
INSERT INTO `parts` VALUES (256,0,0,'0','TAIHO','','4D34-大瓦50','4D34-M25','大瓦50','4D34-M25','','套','',0,73,NULL);
INSERT INTO `parts` VALUES (257,0,0,'0','TAIHO','','4D34-大瓦75','4D34-M25','大瓦75','4D34-M25','','套','',0,0.1,NULL);
INSERT INTO `parts` VALUES (258,0,0,'0','TAIHO','','4D34-小瓦标准','4D34-R00','小标准','4D34-R00','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (259,0,0,'0','TAIHO','','4D34-小瓦25','4D34-R25','小瓦25','4D34-R25','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (260,0,0,'0','TAIHO','','4D34-小瓦50','4D34-R50','小瓦50','4D34-R50','4D34','套','',0,89,NULL);
INSERT INTO `parts` VALUES (261,0,0,'0','TAIHO','','4D34-小瓦75','4D34-R75','小瓦75','4D34-R75','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (262,0,0,'0','TAIHO','','4D34-止推片','4D34-T','止推片','4D34-T','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (263,0,0,'0','TAIHO','','4D34-连杆铜套','4D34-C','连杆铜套','4D34-C','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (264,0,0,'0','TAIHO','','4D34-偏心瓦','4D34-P','偏心瓦','4D34-P','','套','',0,70,NULL);
INSERT INTO `parts` VALUES (265,0,0,'0','TAIHO','','4D94E-大瓦标准','4D94E-M00','大标准','4D94E-M00','','套','',0,128,NULL);
INSERT INTO `parts` VALUES (266,0,0,'0','TAIHO','','4D94E-大瓦25','4D94E-M25','大瓦25','4D94E-M25','','套','',0,88,NULL);
INSERT INTO `parts` VALUES (267,0,0,'0','TAIHO','','4D94E-大瓦50','4D94E-M25','大瓦25','4D94E-M25','','套','',0,73,NULL);
INSERT INTO `parts` VALUES (268,0,0,'0','TAIHO','','4D94E-大瓦75','4D94E-M25','大瓦25','4D94E-M25','','套','',0,0.1,NULL);
INSERT INTO `parts` VALUES (269,0,0,'0','TAIHO','','4D94E-小瓦标准','4D94E-R00','小标准','4D94E-R00','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (270,0,0,'0','TAIHO','','4D94E-小瓦25','4D94E-R25','小瓦25','4D94E-R25','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (271,0,0,'0','TAIHO','','4D94E-小瓦50','4D94E-R50','小瓦50','4D94E-R50','','套','',0,1,NULL);
INSERT INTO `parts` VALUES (272,0,0,'0','TAIHO','','4D94E-小瓦75','4D94E-R75','小瓦75','4D94E-R75','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (273,0,0,'0','TAIHO','','4D94E-止推片','4D94E-T','止推片','4D94E-T','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (274,0,0,'0','TAIHO','','4D94E-连杆铜套','4D94E-C','连杆铜套','4D94E-C','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (275,0,0,'0','TAIHO','','4D94E-偏心瓦','4D94E-P','偏心瓦','4D94E-P','','套','',0,70,NULL);
INSERT INTO `parts` VALUES (276,0,0,'0','TAIHO','','4D95-大瓦标准','4D95-M00','大标准','4D95-M00','','套','',0,128,NULL);
INSERT INTO `parts` VALUES (277,0,0,'0','TAIHO','','4D95-大瓦25','4D95-M25','大瓦25','4D95-M25','','套','',0,88,NULL);
INSERT INTO `parts` VALUES (278,0,0,'0','TAIHO','','4D95-大瓦50','4D95-M25','大瓦25','4D95-M25','','套','',0,73,NULL);
INSERT INTO `parts` VALUES (279,0,0,'0','TAIHO','','4D95-大瓦75','4D95-M25','大瓦25','4D95-M25','','套','',0,0.1,NULL);
INSERT INTO `parts` VALUES (280,0,0,'0','TAIHO','','4D95-小瓦标准','4D95-R00','小标准','4D95-R00','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (281,0,0,'0','TAIHO','','4D95-小瓦25','4D95-R25','小瓦25','4D95-R25','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (282,0,0,'0','TAIHO','','4D95-小瓦50','4D95-R50','小瓦50','4D95-R50','','套','',0,1,NULL);
INSERT INTO `parts` VALUES (283,0,0,'0','TAIHO','','4D95-小瓦75','4D95-R75','小瓦75','4D95-R75','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (284,0,0,'0','TAIHO','','4D95-止推片','4D95-T','止推片','4D95-T','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (285,0,0,'0','TAIHO','','4D95-连杆铜套','4D95-C','连杆铜套','4D95-C','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (286,0,0,'0','TAIHO','','4D95-偏心瓦','4D95-P','偏心瓦','4D95-P','','套','',0,70,NULL);
INSERT INTO `parts` VALUES (287,0,0,'0','TAIHO','','4D88-大瓦标准','4D88-M00','大标准','4D88-M00','','套','',0,128,NULL);
INSERT INTO `parts` VALUES (288,0,0,'0','TAIHO','','4D88-大瓦25','4D88-M25','大瓦25','4D88-M25','','套','',0,88,NULL);
INSERT INTO `parts` VALUES (289,0,0,'0','TAIHO','','4D88-大瓦50','4D88-M25','大瓦25','4D88-M25','','套','',0,73,NULL);
INSERT INTO `parts` VALUES (290,0,0,'0','TAIHO','','4D88-大瓦75','4D88-M25','大瓦25','4D88-M25','','套','',0,0.1,NULL);
INSERT INTO `parts` VALUES (291,0,0,'0','TAIHO','','4D88-小瓦标准','4D88-R00','小标准','4D88-R00','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (292,0,0,'0','TAIHO','','4D88-小瓦25','4D88-R25','小瓦25','4D88-R25','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (293,0,0,'0','TAIHO','','4D88-小瓦50','4D88-R50','小瓦50','4D88-R50','','套','',0,1,NULL);
INSERT INTO `parts` VALUES (294,0,0,'0','TAIHO','','4D88-小瓦75','4D88-R75','小瓦75','4D88-R75','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (295,0,0,'0','TAIHO','','4D88-止推片','4D88-T','止推片','4D88-T','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (296,0,0,'0','TAIHO','','4D88-连杆铜套','4D88-C','连杆铜套','4D88-C','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (297,0,0,'0','TAIHO','','4D88-偏心瓦','4D88-P','偏心瓦','4D88-P','','套','',0,70,NULL);
INSERT INTO `parts` VALUES (298,0,0,'0','TAIHO','','4D130-大瓦标准','4D130-M00','大标准','4D130-M00','','套','',0,128,NULL);
INSERT INTO `parts` VALUES (299,0,0,'0','TAIHO','','4D130-大瓦25','4D130-M25','大瓦25','4D130-M25','','套','',0,88,NULL);
INSERT INTO `parts` VALUES (300,0,0,'0','TAIHO','','4D130-大瓦50','4D130-M25','大瓦50','4D130-M25','','套','',0,73,NULL);
INSERT INTO `parts` VALUES (301,0,0,'0','TAIHO','','4D130-大瓦75','4D130-M25','大瓦75','4D130-M25','','套','',0,0.1,NULL);
INSERT INTO `parts` VALUES (302,0,0,'0','TAIHO','','4D130-小瓦标准','4D130-R00','小标准','4D130-R00','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (303,0,0,'0','TAIHO','','4D130-小瓦25','4D130-R25','小瓦25','4D130-R25','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (304,0,0,'0','TAIHO','','4D130-小瓦50','4D130-R50','小瓦50','4D130-R50','','套','',0,1,NULL);
INSERT INTO `parts` VALUES (305,0,0,'0','TAIHO','','4D130-小瓦75','4D130-R75','小瓦75','4D130-R75','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (306,0,0,'0','TAIHO','','4D130-止推片','4D130-T','止推片','4D130-T','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (307,0,0,'0','TAIHO','','4D130-连杆铜套','4D130-C','连杆铜套','4D130-C','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (308,0,0,'0','TAIHO','','4D130-偏心瓦','4D130-P','偏心瓦','4D130-P','','套','',0,70,NULL);
INSERT INTO `parts` VALUES (309,0,0,'0','TAIHO','','4JB1-大瓦标准','4JB1-M00','大标准','4JB1-M00','','套','',23,128,NULL);
INSERT INTO `parts` VALUES (310,0,0,'0','TAIHO','','4JB1-大瓦25','4JB1-M25','大瓦25','4JB1-M25','','套','',0,88,NULL);
INSERT INTO `parts` VALUES (311,0,0,'0','TAIHO','','4JB1-大瓦50','4JB1-M25','大瓦25','4JB1-M25','','套','',0,73,NULL);
INSERT INTO `parts` VALUES (312,0,0,'0','TAIHO','','4JB1-大瓦75','4JB1-M25','大瓦25','4JB1-M25','','套','',0,0.1,NULL);
INSERT INTO `parts` VALUES (313,0,0,'0','TAIHO','','4JB1-小瓦标准','4JB1-R00','小标准','4JB1-R00','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (314,0,0,'0','TAIHO','','4JB1-小瓦25','4JB1-R25','小瓦25','4JB1-R25','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (315,0,0,'0','TAIHO','','4JB1-小瓦50','4JB1-R50','小瓦50','4JB1-R50','','套','',0,1,NULL);
INSERT INTO `parts` VALUES (316,0,0,'0','TAIHO','','4JB1-小瓦75','4JB1-R75','小瓦75','4JB1-R75','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (317,0,0,'0','TAIHO','','4JB1-止推片','4JB1-T','止推片','4JB1-T','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (318,0,0,'0','TAIHO','','4JB1-连杆铜套','4JB1-C','连杆铜套','4JB1-C','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (319,0,0,'0','TAIHO','','4JB1-偏心瓦','4JB1-P','偏心瓦','4JB1-P','','套','',0,70,NULL);
INSERT INTO `parts` VALUES (320,0,0,'0','TAIHO','','4M40-大瓦标准','4M40-M00','大标准','4M40-M00','','套','',0,128,NULL);
INSERT INTO `parts` VALUES (321,0,0,'0','TAIHO','','4M40-大瓦25','4M40-M25','大瓦25','4M40-M25','','套','',0,88,NULL);
INSERT INTO `parts` VALUES (322,0,0,'0','TAIHO','','4M40-大瓦50','4M40-M25','大瓦50','4M40-M25','','套','',0,73,NULL);
INSERT INTO `parts` VALUES (323,0,0,'0','TAIHO','','4M40-大瓦75','4M40-M25','大瓦75','4M40-M25','','套','',0,0.1,NULL);
INSERT INTO `parts` VALUES (324,0,0,'0','TAIHO','','4M40-小瓦标准','4M40-R00','小标准','4M40-R00','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (325,0,0,'0','TAIHO','','4M40-小瓦25','4M40-R25','小瓦25','4M40-R25','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (326,0,0,'0','TAIHO','','4M40-小瓦50','4M40-R50','小瓦50','4M40-R50','','套','',0,1,NULL);
INSERT INTO `parts` VALUES (327,0,0,'0','TAIHO','','4M40-小瓦75','4M40-R75','小瓦75','4M40-R75','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (328,0,0,'0','TAIHO','','4M40-止推片','4M40-T','止推片','4M40-T','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (329,0,0,'0','TAIHO','','4M40-连杆铜套','4M40-C','连杆铜套','4M40-C','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (330,0,0,'0','TAIHO','','4M40-偏心瓦','4M40-P','偏心瓦','4M40-P','','套','',0,70,NULL);
INSERT INTO `parts` VALUES (331,0,0,'0','TAIHO','','6BD1-大瓦标准','6BD1-M00','大标准','6BD1-M00','','套','',10,128,NULL);
INSERT INTO `parts` VALUES (332,0,0,'0','TAIHO','','6BD1-大瓦25','6BD1-M25','大瓦25','6BD1-M25','','套','',0,88,NULL);
INSERT INTO `parts` VALUES (333,0,0,'0','TAIHO','','6BD1-大瓦50','6BD1-M25','大瓦25','6BD1-M25','','套','',0,73,NULL);
INSERT INTO `parts` VALUES (334,0,0,'0','TAIHO','','6BD1-大瓦75','6BD1-M25','大瓦25','6BD1-M25','','套','',0,0.1,NULL);
INSERT INTO `parts` VALUES (335,0,0,'0','TAIHO','','6BD1-小瓦标准','6BD1-R00','小标准','6BD1-R00','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (336,0,0,'0','TAIHO','','6BD1-小瓦25','6BD1-R25','小瓦25','6BD1-R25','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (337,0,0,'0','TAIHO','','6BD1-小瓦50','6BD1-R50','小瓦50','6BD1-R50','','套','',0,1,NULL);
INSERT INTO `parts` VALUES (338,0,0,'0','TAIHO','','6BD1-小瓦75','6BD1-R75','小瓦75','6BD1-R75','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (339,0,0,'0','TAIHO','','6BD1-止推片','6BD1-T','止推片','6BD1-T','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (340,0,0,'0','TAIHO','','6BD1-连杆铜套','6BD1-C','连杆铜套','6BD1-C','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (341,0,0,'0','TAIHO','','6BD1-偏心瓦','6BD1-P','偏心瓦','6BD1-P','','套','',0,70,NULL);
INSERT INTO `parts` VALUES (342,0,0,'0','TAIHO','','6D15-大瓦标准','6D15-M00','大标准','6D15-M00','','套','',0,128,NULL);
INSERT INTO `parts` VALUES (343,0,0,'0','TAIHO','','6D15-大瓦25','6D15-M25','大瓦25','6D15-M25','','套','',0,88,NULL);
INSERT INTO `parts` VALUES (344,0,0,'0','TAIHO','','6D15-大瓦50','6D15-M25','大瓦50','6D15-M25','','套','',0,73,NULL);
INSERT INTO `parts` VALUES (345,0,0,'0','TAIHO','','6D15-大瓦75','6D15-M25','大瓦75','6D15-M25','','套','',0,0.1,NULL);
INSERT INTO `parts` VALUES (346,0,0,'0','TAIHO','','6D15-小瓦标准','6D15-R00','小标准','6D15-R00','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (347,0,0,'0','TAIHO','','6D15-小瓦25','6D15-R25','小瓦25','6D15-R25','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (348,0,0,'0','TAIHO','','6D15-小瓦50','6D15-R50','小瓦50','6D15-R50','','套','',0,1,NULL);
INSERT INTO `parts` VALUES (349,0,0,'0','TAIHO','','6D15-小瓦75','6D15-R75','小瓦75','6D15-R75','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (350,0,0,'0','TAIHO','','6D15-止推片','6D15-T','止推片','6D15-T','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (351,0,0,'0','TAIHO','','6D15-连杆铜套','6D15-C','连杆铜套','6D15-C','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (352,0,0,'0','TAIHO','','6D15-偏心瓦','6D15-P','偏心瓦','6D15-P','','套','',0,70,NULL);
INSERT INTO `parts` VALUES (353,0,0,'0','TAIHO','','6D22-大瓦标准','6D22-M00','大标准','6D22-M00','','套','',0,128,NULL);
INSERT INTO `parts` VALUES (354,0,0,'0','TAIHO','','6D22-大瓦25','6D22-M25','大瓦25','6D22-M25','','套','',0,88,NULL);
INSERT INTO `parts` VALUES (355,0,0,'0','TAIHO','','6D22-大瓦50','6D22-M25','大瓦25','6D22-M25','','套','',0,73,NULL);
INSERT INTO `parts` VALUES (356,0,0,'0','TAIHO','','6D22-大瓦75','6D22-M25','大瓦25','6D22-M25','','套','',0,0.1,NULL);
INSERT INTO `parts` VALUES (357,0,0,'0','TAIHO','','6D22-小瓦标准','6D22-R00','小标准','6D22-R00','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (358,0,0,'0','TAIHO','','6D22-小瓦25','6D22-R25','小瓦25','6D22-R25','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (359,0,0,'0','TAIHO','','6D22-小瓦50','6D22-R50','小瓦50','6D22-R50','','套','',0,1,NULL);
INSERT INTO `parts` VALUES (360,0,0,'0','TAIHO','','6D22-小瓦75','6D22-R75','小瓦75','6D22-R75','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (361,0,0,'0','TAIHO','','6D22-止推片','6D22-T','止推片','6D22-T','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (362,0,0,'0','TAIHO','','6D22-连杆铜套','6D22-C','连杆铜套','6D22-C','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (363,0,0,'0','TAIHO','','6D22-偏心瓦','6D22-P','偏心瓦','6D22-P','','套','',0,70,NULL);
INSERT INTO `parts` VALUES (364,0,0,'0','TAIHO','','6D31-大瓦标准','6D31-M00','大标准','6D31-M00','','套','',0,128,NULL);
INSERT INTO `parts` VALUES (365,0,0,'0','TAIHO','','6D31-大瓦25','6D31-M25','大瓦25','6D31-M25','','套','',0,88,NULL);
INSERT INTO `parts` VALUES (366,0,0,'0','TAIHO','','6D31-大瓦50','6D31-M25','大瓦25','6D31-M25','','套','',0,73,NULL);
INSERT INTO `parts` VALUES (367,0,0,'0','TAIHO','','6D31-大瓦75','6D31-M25','大瓦25','6D31-M25','','套','',0,0.1,NULL);
INSERT INTO `parts` VALUES (368,0,0,'0','TAIHO','','6D31-小瓦标准','6D31-R00','小标准','6D31-R00','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (369,0,0,'0','TAIHO','','6D31-小瓦25','6D31-R25','小瓦25','6D31-R25','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (370,0,0,'0','TAIHO','','6D31-小瓦50','6D31-R50','小瓦50','6D31-R50','','套','',0,1,NULL);
INSERT INTO `parts` VALUES (371,0,0,'0','TAIHO','','6D31-小瓦75','6D31-R75','小瓦75','6D31-R75','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (372,0,0,'0','TAIHO','','6D31-止推片','6D31-T','止推片','6D31-T','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (373,0,0,'0','TAIHO','','6D31-连杆铜套','6D31-C','连杆铜套','6D31-C','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (374,0,0,'0','TAIHO','','6D31-偏心瓦','6D31-P','偏心瓦','6D31-P','','套','',0,70,NULL);
INSERT INTO `parts` VALUES (375,0,0,'0','TAIHO','','6D34-大瓦标准','6D34-M00','大标准','6D34-M00','','套','',0,128,NULL);
INSERT INTO `parts` VALUES (376,0,0,'0','TAIHO','','6D34-大瓦25','6D34-M25','大瓦25','6D34-M25','','套','',0,88,NULL);
INSERT INTO `parts` VALUES (377,0,0,'0','TAIHO','','6D34-大瓦50','6D34-M25','大瓦50','6D34-M25','','套','',0,73,NULL);
INSERT INTO `parts` VALUES (378,0,0,'0','TAIHO','','6D34-大瓦75','6D34-M25','大瓦75','6D34-M25','','套','',0,0.1,NULL);
INSERT INTO `parts` VALUES (379,0,0,'0','TAIHO','','6D34-小瓦标准','6D34-R00','小标准','6D34-R00','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (380,0,0,'0','TAIHO','','6D34-小瓦25','6D34-R25','小瓦25','6D34-R25','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (381,0,0,'0','TAIHO','','6D34-小瓦50','6D34-R50','小瓦50','6D34-R50','','套','',0,1,NULL);
INSERT INTO `parts` VALUES (382,0,0,'0','TAIHO','','6D34-小瓦75','6D34-R75','小瓦75','6D34-R75','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (383,0,0,'0','TAIHO','','6D34-止推片','6D34-T','止推片','6D34-T','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (384,0,0,'0','TAIHO','','6D34-连杆铜套','6D34-C','连杆铜套','6D34-C','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (385,0,0,'0','TAIHO','','6D34-偏心瓦','6D34-P','偏心瓦','6D34-P','','套','',0,70,NULL);
INSERT INTO `parts` VALUES (386,0,0,'0','TAIHO','','6D95-大瓦标准','6D95-M00','大标准','6D95-M00','','套','',0,128,NULL);
INSERT INTO `parts` VALUES (387,0,0,'0','TAIHO','','6D95-大瓦25','6D95-M25','大瓦25','6D95-M25','','套','',0,88,NULL);
INSERT INTO `parts` VALUES (388,0,0,'0','TAIHO','','6D95-大瓦50','6D95-M25','大瓦50','6D95-M25','','套','',0,73,NULL);
INSERT INTO `parts` VALUES (389,0,0,'0','TAIHO','','6D95-大瓦75','6D95-M25','大瓦75','6D95-M25','','套','',0,0.1,NULL);
INSERT INTO `parts` VALUES (390,0,0,'0','TAIHO','','6D95-小瓦标准','6D95-R00','小标准','6D95-R00','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (391,0,0,'0','TAIHO','','6D95-小瓦25','6D95-R25','小瓦25','6D95-R25','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (392,0,0,'0','TAIHO','','6D95-小瓦50','6D95-R50','小瓦50','6D95-R50','','套','',0,1,NULL);
INSERT INTO `parts` VALUES (393,0,0,'0','TAIHO','','6D95-小瓦75','6D95-R75','小瓦75','6D95-R75','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (394,0,0,'0','TAIHO','','6D95-止推片','6D95-T','止推片','6D95-T','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (395,0,0,'0','TAIHO','','6D95-连杆铜套','6D95-C','连杆铜套','6D95-C','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (396,0,0,'0','TAIHO','','6D95-偏心瓦','6D95-P','偏心瓦','6D95-P','','套','',0,70,NULL);
INSERT INTO `parts` VALUES (397,0,0,'0','TAIHO','','6SD1-大瓦标准','6SD1-M00','大标准','6SD1-M00','','套','',0,128,NULL);
INSERT INTO `parts` VALUES (398,0,0,'0','TAIHO','','6SD1-大瓦25','6SD1-M25','大瓦25','6SD1-M25','','套','',6,88,NULL);
INSERT INTO `parts` VALUES (399,0,0,'0','TAIHO','','6SD1-大瓦50','6SD1-M25','大瓦25','6SD1-M25','','套','',0,73,NULL);
INSERT INTO `parts` VALUES (400,0,0,'0','TAIHO','','6SD1-大瓦75','6SD1-M25','大瓦25','6SD1-M25','','套','',0,0.1,NULL);
INSERT INTO `parts` VALUES (401,0,0,'0','TAIHO','','6SD1-小瓦标准','6SD1-R00','小标准','6SD1-R00','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (402,0,0,'0','TAIHO','','6SD1-小瓦25','6SD1-R25','小瓦25','6SD1-R25','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (403,0,0,'0','TAIHO','','6SD1-小瓦50','6SD1-R50','小瓦50','6SD1-R50','','套','',0,1,NULL);
INSERT INTO `parts` VALUES (404,0,0,'0','TAIHO','','6SD1-小瓦75','6SD1-R75','小瓦75','6SD1-R75','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (405,0,0,'0','TAIHO','','6SD1-止推片','6SD1-T','止推片','6SD1-T','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (406,0,0,'0','TAIHO','','6SD1-连杆铜套','6SD1-C','连杆铜套','6SD1-C','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (407,0,0,'0','TAIHO','','6SD1-偏心瓦','6SD1-P','偏心瓦','6SD1-P','','套','',0,70,NULL);
INSERT INTO `parts` VALUES (408,0,0,'0','TAIHO','','6D105-大瓦标准','6D105-M00','大标准','6D105-M00','','套','',0,128,NULL);
INSERT INTO `parts` VALUES (409,0,0,'0','TAIHO','','6D105-大瓦25','6D105-M25','大瓦25','6D105-M25','','套','',0,88,NULL);
INSERT INTO `parts` VALUES (410,0,0,'0','TAIHO','','6D105-大瓦50','6D105-M25','大瓦25','6D105-M25','','套','',0,73,NULL);
INSERT INTO `parts` VALUES (411,0,0,'0','TAIHO','','6D105-大瓦75','6D105-M25','大瓦25','6D105-M25','','套','',0,0.1,NULL);
INSERT INTO `parts` VALUES (412,0,0,'0','TAIHO','','6D105-小瓦标准','6D105-R00','小标准','6D105-R00','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (413,0,0,'0','TAIHO','','6D105-小瓦25','6D105-R25','小瓦25','6D105-R25','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (414,0,0,'0','TAIHO','','6D105-小瓦50','6D105-R50','小瓦50','6D105-R50','','套','',0,1,NULL);
INSERT INTO `parts` VALUES (415,0,0,'0','TAIHO','','6D105-小瓦75','6D105-R75','小瓦75','6D105-R75','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (416,0,0,'0','TAIHO','','6D105-止推片','6D105-T','止推片','6D105-T','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (417,0,0,'0','TAIHO','','6D105-连杆铜套','6D105-C','连杆铜套','6D105-C','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (418,0,0,'0','TAIHO','','6D105-偏心瓦','6D105-P','偏心瓦','6D105-P','','套','',0,70,NULL);
INSERT INTO `parts` VALUES (419,0,0,'0','TAIHO','','6D125-大瓦标准','6D125-M00','大标准','6D125-M00','','套','',0,128,NULL);
INSERT INTO `parts` VALUES (420,0,0,'0','TAIHO','','6D125-大瓦25','6D125-M25','大瓦25','6D125-M25','','套','',0,88,NULL);
INSERT INTO `parts` VALUES (421,0,0,'0','TAIHO','','6D125-大瓦50','6D125-M25','大瓦50','6D125-M25','','套','',0,73,NULL);
INSERT INTO `parts` VALUES (422,0,0,'0','TAIHO','','6D125-大瓦75','6D125-M25','大瓦75','6D125-M25','','套','',0,0.1,NULL);
INSERT INTO `parts` VALUES (423,0,0,'0','TAIHO','','6D125-小瓦标准','6D125-R00','小标准','6D125-R00','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (424,0,0,'0','TAIHO','','6D125-小瓦25','6D125-R25','小瓦25','6D125-R25','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (425,0,0,'0','TAIHO','','6D125-小瓦50','6D125-R50','小瓦50','6D125-R50','','套','',0,1,NULL);
INSERT INTO `parts` VALUES (426,0,0,'0','TAIHO','','6D125-小瓦75','6D125-R75','小瓦75','6D125-R75','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (427,0,0,'0','TAIHO','','6D125-止推片','6D125-T','止推片','6D125-T','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (428,0,0,'0','TAIHO','','6D125-连杆铜套','6D125-C','连杆铜套','6D125-C','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (429,0,0,'0','TAIHO','','6D125-偏心瓦','6D125-P','偏心瓦','6D125-P','','套','',0,70,NULL);
INSERT INTO `parts` VALUES (430,0,0,'0','TAIHO','','6D130-大瓦标准','6D130-M00','大标准','6D130-M00','','套','',0,128,NULL);
INSERT INTO `parts` VALUES (431,0,0,'0','TAIHO','','6D130-大瓦25','6D130-M25','大瓦25','6D130-M25','','套','',0,88,NULL);
INSERT INTO `parts` VALUES (432,0,0,'0','TAIHO','','6D130-大瓦50','6D130-M25','大瓦50','6D130-M25','','套','',0,73,NULL);
INSERT INTO `parts` VALUES (433,0,0,'0','TAIHO','','6D130-大瓦75','6D130-M25','大瓦75','6D130-M25','','套','',0,0.1,NULL);
INSERT INTO `parts` VALUES (434,0,0,'0','TAIHO','','6D130-小瓦标准','6D130-R00','小标准','6D130-R00','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (435,0,0,'0','TAIHO','','6D130-小瓦25','6D130-R25','小瓦25','6D130-R25','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (436,0,0,'0','TAIHO','','6D130-小瓦50','6D130-R50','小瓦50','6D130-R50','','套','',0,1,NULL);
INSERT INTO `parts` VALUES (437,0,0,'0','TAIHO','','6D130-小瓦75','6D130-R75','小瓦75','6D130-R75','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (438,0,0,'0','TAIHO','','6D130-止推片','6D130-T','止推片','6D130-T','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (439,0,0,'0','TAIHO','','6D130-连杆铜套','6D130-C','连杆铜套','6D130-C','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (440,0,0,'0','TAIHO','','6D130-偏心瓦','6D130-P','偏心瓦','6D130-P','','套','',0,70,NULL);
INSERT INTO `parts` VALUES (441,0,0,'0','TAIHO','','S4K-大瓦标准','S4K-M00','大标准','S4K-M00','','套','',0,128,NULL);
INSERT INTO `parts` VALUES (442,0,0,'0','TAIHO','','S4K-大瓦25','S4K-M25','大瓦25','S4K-M25','','套','',0,88,NULL);
INSERT INTO `parts` VALUES (443,0,0,'0','TAIHO','','S4K-大瓦50','S4K-M25','大瓦25','S4K-M25','','套','',0,73,NULL);
INSERT INTO `parts` VALUES (444,0,0,'0','TAIHO','','S4K-大瓦75','S4K-M25','大瓦25','S4K-M25','','套','',0,0.1,NULL);
INSERT INTO `parts` VALUES (445,0,0,'0','TAIHO','','S4K-小瓦标准','S4K-R00','小标准','S4K-R00','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (446,0,0,'0','TAIHO','','S4K-小瓦25','S4K-R25','小瓦25','S4K-R25','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (447,0,0,'0','TAIHO','','S4K-小瓦50','S4K-R50','小瓦50','S4K-R50','','套','',0,1,NULL);
INSERT INTO `parts` VALUES (448,0,0,'0','TAIHO','','S4K-小瓦75','S4K-R75','小瓦75','S4K-R75','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (449,0,0,'0','TAIHO','','S4K-止推片','S4K-T','止推片','S4K-T','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (450,0,0,'0','TAIHO','','S4K-连杆铜套','S4K-C','连杆铜套','S4K-C','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (451,0,0,'0','TAIHO','','S4K-偏心瓦','S4K-P','偏心瓦','S4K-P','','套','',0,70,NULL);
INSERT INTO `parts` VALUES (452,0,0,'0','TAIHO','','S6K-大瓦标准','S6K-M00','大标准','S6K-M00','','套','',0,128,NULL);
INSERT INTO `parts` VALUES (453,0,0,'0','TAIHO','','S6K-大瓦25','S6K-M25','大瓦25','S6K-M25','','套','',0,88,NULL);
INSERT INTO `parts` VALUES (454,0,0,'0','TAIHO','','S6K-大瓦50','S6K-M25','大瓦25','S6K-M25','','套','',0,73,NULL);
INSERT INTO `parts` VALUES (455,0,0,'0','TAIHO','','S6K-大瓦75','S6K-M25','大瓦25','S6K-M25','','套','',0,0.1,NULL);
INSERT INTO `parts` VALUES (456,0,0,'0','TAIHO','','S6K-小瓦标准','S6K-R00','小标准','S6K-R00','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (457,0,0,'0','TAIHO','','S6K-小瓦25','S6K-R25','小瓦25','S6K-R25','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (458,0,0,'0','TAIHO','','S6K-小瓦50','S6K-R50','小瓦50','S6K-R50','','套','',0,1,NULL);
INSERT INTO `parts` VALUES (459,0,0,'0','TAIHO','','S6K-小瓦75','S6K-R75','小瓦75','S6K-R75','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (460,0,0,'0','TAIHO','','S6K-止推片','S6K-T','止推片','S6K-T','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (461,0,0,'0','TAIHO','','S6K-连杆铜套','S6K-C','连杆铜套','S6K-C','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (462,0,0,'0','TAIHO','','S6K-偏心瓦','S6K-P','偏心瓦','S6K-P','','套','',0,70,NULL);
INSERT INTO `parts` VALUES (463,0,0,'0','TAIHO','','J05E-大瓦标准','J05E-M00','大标准','J05E-M00','','套','',0,128,NULL);
INSERT INTO `parts` VALUES (464,0,0,'0','TAIHO','','J05E-大瓦25','J05E-M25','大瓦25','J05E-M25','','套','',0,88,NULL);
INSERT INTO `parts` VALUES (465,0,0,'0','TAIHO','','J05E-大瓦50','J05E-M25','大瓦25','J05E-M25','','套','',0,73,NULL);
INSERT INTO `parts` VALUES (466,0,0,'0','TAIHO','','J05E-大瓦75','J05E-M25','大瓦25','J05E-M25','','套','',0,0.1,NULL);
INSERT INTO `parts` VALUES (467,0,0,'0','TAIHO','','J05E-小瓦标准','J05E-R00','小标准','J05E-R00','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (468,0,0,'0','TAIHO','','J05E-小瓦25','J05E-R25','小瓦25','J05E-R25','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (469,0,0,'0','TAIHO','','J05E-小瓦50','J05E-R50','小瓦50','J05E-R50','','套','',0,1,NULL);
INSERT INTO `parts` VALUES (470,0,0,'0','TAIHO','','J05E-小瓦75','J05E-R75','小瓦75','J05E-R75','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (471,0,0,'0','TAIHO','','J05E-止推片','J05E-T','止推片','J05E-T','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (472,0,0,'0','TAIHO','','J05E-连杆铜套','J05E-C','连杆铜套','J05E-C','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (473,0,0,'0','TAIHO','','J05E-偏心瓦','J05E-P','偏心瓦','J05E-P','','套','',0,70,NULL);
INSERT INTO `parts` VALUES (474,0,0,'0','TAIHO','','HO6CT-大瓦标准','HO6CT-M00','大标准','HO6CT-M00','','套','',5,128,NULL);
INSERT INTO `parts` VALUES (475,0,0,'0','TAIHO','','HO6CT-大瓦25','HO6CT-M25','大瓦25','HO6CT-M25','','套','',0,88,NULL);
INSERT INTO `parts` VALUES (476,0,0,'0','TAIHO','','HO6CT-大瓦50','HO6CT-M25','大瓦50','HO6CT-M25','','套','',0,73,NULL);
INSERT INTO `parts` VALUES (477,0,0,'0','TAIHO','','HO6CT-大瓦75','HO6CT-M25','大瓦75','HO6CT-M25','','套','',0,0.1,NULL);
INSERT INTO `parts` VALUES (478,0,0,'0','TAIHO','','HO6CT-小瓦标准','HO6CT-R00','小标准','HO6CT-R00','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (479,0,0,'0','TAIHO','','HO6CT-小瓦25','HO6CT-R25','小瓦25','HO6CT-R25','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (480,0,0,'0','TAIHO','','HO6CT-小瓦50','HO6CT-R50','小瓦50','HO6CT-R50','','套','',0,1,NULL);
INSERT INTO `parts` VALUES (481,0,0,'0','TAIHO','','HO6CT-小瓦75','HO6CT-R75','小瓦75','HO6CT-R75','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (482,0,0,'0','TAIHO','','HO6CT-止推片','HO6CT-T','止推片','HO6CT-T','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (483,0,0,'0','TAIHO','','HO6CT-连杆铜套','HO6CT-C','连杆铜套','HO6CT-C','','套','',0,0,NULL);
INSERT INTO `parts` VALUES (484,0,0,'0','TAIHO','','HO6CT-偏心瓦','HO6CT-P','偏心瓦','HO6CT-P','','套','',0,70,NULL);

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

INSERT INTO `publish` VALUES (53,NULL,NULL,'小松','a','液压件','川崎K3V112 test','<p><img src=\"http://www.wanet.cn/attached/20110309124150_26748.jpeg\" alt=\"\" border=\"0\" /></p>\r\n<p>啊啊啊啊啊啊啊啊啊</p>','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','300','http://www.wanet.cn/attached/20110309124150_26748.jpeg',0,0,'',NULL,'2003-09-11');
INSERT INTO `publish` VALUES (54,NULL,NULL,'# 沃尔沃','PC200','发动机','小松PC200-6D95活塞','<p><img src=\"http://www.wanet.cn/attached/20110309124724_83751.png\" alt=\"\" border=\"0\" /></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<h3 class=\"t\"><a href=\"http://www.chinawj.com.cn/htm/info/918/1317918.shtml\" target=\"_blank\"><em>K3V112</em>柱塞泵- <em>K3V112</em>回转泵- <em>K3V112</em>油压主泵- <em>K3V112</em>行走泵供应...</a></h3>\r\n<p><span> 上海信杰瑞液压件有限公司是主营:液压泵,液压马达<em>K3V112</em>柱塞泵- <em>K3V112</em>回转泵- <em>K3V112</em>油压主泵- <em>K3V112</em>行走泵、<em>K3V112</em>,供应<em>K3V112</em>,销售<em>K3V112</em>的企业；地址:曹</span></p>\r\n<p>&nbsp;</p>\r\n<p><span><br />\r\n</span></p>','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','888','http://www.wanet.cn/attached/20110309124724_83751.png',0,0,'',NULL,'2003-09-11');
INSERT INTO `publish` VALUES (55,NULL,NULL,'# 沃尔沃','ETST','液压件','小松PC200-6D95活塞','<p><img src=\"http://www.wanet.cn/attached/20110310030244_94237.jpeg\" alt=\"\" border=\"0\" /></p>\r\n<p>Analysed the RCC_HELP_RetrieveHelp function, found it called by RCC_EXEC_Help when the CLI help command <br />\r\nran as \"help l &lt;cr&gt;\", the parameters of RCC_HELP_RetrieveHelp are fixed, which indicate in \"!immediate\" model.</p>','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','66','http://www.wanet.cn/attached/20110310030244_94237.jpeg',0,0,'',NULL,'2003-09-11');
INSERT INTO `publish` VALUES (59,NULL,NULL,'小松','S6D110','轴承&齿轮','西湖\"水漫金山\"','<a href=\"http://news.baidu.com/z/nfby/new/index.html\" target=\"_blank\" class=\"a3\">6月15日起，一则《南京机场“天价高速”每公里均价超标逾50%》的帖子在网上热传，帖子称南京机场高速收费超法定收费标准逾50%</a>','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','8','/images/default.jpg',0,0,'0-1-20110619-210654',NULL,'2011-06-19');
INSERT INTO `publish` VALUES (60,NULL,NULL,'沃尔沃','PC200','轴承&齿轮','','PHP str_replace() 函数 \r\n PHP String 函数 定义和用法 str_replace() 函数使用一个字符串替换字符串中的另一些字符。 语法 str_replace(find,replace,string,count) 参数 描述  find ...\r\nwww.w3school...','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','99','/images/default.jpg',0,0,'publish/0-1-20110620-000627.php',NULL,'2011-06-20');
INSERT INTO `publish` VALUES (61,NULL,NULL,'卡特','S6D110','发动机','首先需要打开一个文件.这里用到了PHP 函数','.首先需要打开一个文件.这里用到了PHP -&gt;fopen();函数 \r\n定义和用法 \r\nfopen() 函数打开文件或者 URL。 \r\n如果打开失败，本函数返回 FALSE。 \r\n函数原型: \r\nfopen(filename,mode,include_pa...','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','77','/images/default.jpg',0,0,'publish/0-1-20110620-000627.php',NULL,'2011-06-20');
INSERT INTO `publish` VALUES (62,NULL,NULL,'日立','EX200','液压件','什么是数组？','什么是数组？\r\n在使用 PHP 进行开发的过程中，或早或晚，您会需要创建许多相似的变量。\r\n无需很多相似的变量，你可以把数据作为元素存储在数组中。\r\n数组中的元素都有自己的 ID，因此可以方便地访问它们。...','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','780','/images/default.jpg',0,0,'publish/0-1-20110620-000654.php',NULL,'2011-06-20');
INSERT INTO `publish` VALUES (63,NULL,NULL,'日立','EX450','发动机','ITACHI日立集团是全球最大的综合跨国集团之','ITACHI日立集团是全球最大的综合跨国集团之一，于20世纪60年代来到中国，成为早期进入中国市场的少量外资企业之一。主要产品是空调、冰箱等电器。 目录\r\n 日立挖掘机日立简介企业理念品牌战略主要产品/服务日...','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','785','http://imgsrc.baidu.com/baike/abpic/item/4bac30735323974b8601b0f4.jpg',0,0,'publish/0-1-20110620-000632.php',NULL,'2011-06-20');
INSERT INTO `publish` VALUES (64,NULL,NULL,'TT','TT','TT','TT','\r\n\r\n\r\nHITACHI日立集团是全球最大的综合跨国集团之一，于20世纪60年代来到中国，成为早期进入中国市场的少量外资企业之一。主要产品是空调、冰箱等电器。\r\n\r\n...','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','TT','/images/default.jpg',0,0,'publish/0-1-20110620-000609.php',NULL,'2011-06-20');
INSERT INTO `publish` VALUES (65,NULL,NULL,'日立','S6D110','发动机','EFGDG',') 函数使用一个字符串替换字符串中的另一些字符。 \r\n函数原型: \r\nstr_replace(find,replace,string,count) \r\nhttp://www.jb51.net/w3school/php/func_string_str_replace.asp.htm \r\n提示和注释 \r\n注释：该...','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','77','/images/default.jpg',0,0,'publish/0-1-20110620-000632.php',NULL,'2011-06-20');
INSERT INTO `publish` VALUES (66,NULL,NULL,'卡特','S6D102','工作油缸','RR','概要 　　截至2009年3月31日 　　公司名称 　　日立建机株式会社\r\n　　注册资金 　　815亿7,659万日元\r\n　　(总发行股票数：215,115,038)...','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','55','/images/default.jpg',0,0,'publish/0-1-20110620-000624.php',NULL,'2011-06-20');
INSERT INTO `publish` VALUES (68,NULL,NULL,'# 沃尔沃','PC210-7','修理包','日立挖机_百度视频','日立挖机_百度视频\r\n约有13,524个日立挖机相关的视频 日立挖掘机工作视频  xb.dzxw.net 我的日立挖机 分类:200 www.tudou.com 陕西长臂挖机出租 分类:日立ZX450LC www.tu......','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','44','/images/default.jpg',0,0,'publish/0-1-20110620-010613.php',NULL,'2011-06-20');
INSERT INTO `publish` VALUES (69,NULL,NULL,'aa','PC210-7','修理包','小松PC233-7 轴承&齿轮','日立挖机型号供应,日立挖机型号商机--环球厨卫网 \r\n 环球厨卫网-日立挖机型号供应商机-最大的日立挖机型号商务网，大量的日立挖机型号供应商机、日立挖机型号求购信息与日立挖机型号企业黄页大全...','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','77','/images/default.jpg',0,0,'publish/0-1-20110620-010618.php',NULL,'2011-06-20');
INSERT INTO `publish` VALUES (70,NULL,NULL,'# 沃尔沃','S6D110','工作油缸','小松PC210-7 轴承&齿轮','get_magic_quotes_gpc_百度百科 \r\nget_magic_quotes_gpc取得 PHP 环境变量 magic_quotes_gpc 的值。语法: long get_magic_quotes_gpc(void);    返回值: 长整数函数种类: PHP 系统功能内容说明...','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','77','/images/default.jpg',0,0,'publish/0-1-20110620-010638.php',NULL,'2011-06-20');
INSERT INTO `publish` VALUES (71,NULL,NULL,'小松','S6D110','工作油缸','川崎K3V112','get_magic_quotes_gpc_百度百科 \r\nget_magic_quotes_gpc取得 PHP 环境变量 magic_quotes_gpc 的值。语法: long get_magic_quotes_gpc(void); \r\n\r\n返回值: 长整数函数种类: PHP 系统功能内容说明本函数取得 PH...','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','300','/images/default.jpg',0,0,'publish/0-1-20110620-010642.php',NULL,'2011-06-20');
INSERT INTO `publish` VALUES (72,NULL,NULL,'卡特','ETST','液压件','ITACHI日立集团是全球最大的综合跨国集团之','PHP中get_magic_quotes_gpc()问题_百度知道 \r\n我用DW加载KTM Lite，运行之后插入记录时，总是提示??不是很明白你的问题,是不是你用DW调试程序的时候老提示get_magic_quotes_gpc不可用呀,如果是这样的话,那...','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','55','/images/default.jpg',0,0,'publish/0-1-20110620-010647.php',NULL,'2011-06-20');
INSERT INTO `publish` VALUES (73,NULL,NULL,'# 沃尔沃','PC210-7','橡胶类','沃尔沃集团是世界领先的','沃尔沃集团中国(Volvo Group China)官方网站    \r\n   \r\n            \r\n\r\n\r\n\r\n     沃尔沃集团是世界领先的卡车、客车、建筑设备、船舶和工业应用的驱动系统、以及航空元件的制造商和服务提供商之一。集团还提供金...','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','55','http://drmcmm.baidu.com/media/id=nWnsnHT3nWb&amp;gp=402&amp;time=nHnsP1RknH61P6.jpg',0,0,'publish/0-1-20110620-220651.php','../company/0-admin.php','2011-06-20');
INSERT INTO `publish` VALUES (74,31,NULL,'日立','S6D110','滤清器','买板式过滤器到高洁鑫原','\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n买板式过滤器到高洁鑫原\r\n我厂专业生产板式过滤器,初效过滤器从过滤级别分G2,G3,G4,中..\r\nwww.bjgaojie.cn\r\n切沃过滤,最专业的过滤袋..\r\n为您提供最专业的过滤袋方...','','广东广州天河区东圃工程机型市场','020-23438923','124452234353','020-23562232','','http://t2.baidu.com/it/u=3633023058,3737911331&amp;fm=0&amp;gp=0.jpg',0,0,'publish/0-31-20110630-000627.php','','2011-06-30');
INSERT INTO `publish` VALUES (75,35,NULL,'日立','PC210-7','工作油缸','挖机上海交易市场','上海二手挖掘机|二手挖掘机-挖机上海交易市场\r\nwww.wajueji158.com/ - 网页快照\r\n上海二手挖掘机交易市场提供各类二手日韩挖掘机，二手挖机。上海二手挖掘机交易市场是您挑选二手挖机二手挖掘机的第一选择！...','武汉光谷工程机型设备有限公司','杭州市上城区鸿润挖机齿轮行位于杭州市上城区','020-23438923','124452234353','020-23562232','','/images/default.jpg',0,0,'publish/0-35-20110630-010639.php','../company/0-wer.php','2011-06-30');
INSERT INTO `publish` VALUES (79,1,NULL,'小松','PC300-7','修理包','川崎K3V112 test','一个数据库（例如PEAR或ADODB）的搜索脚本示例，\r\n\r\n\r\n借助{foreachelse}标记在没有结果时模板输出\"None found\"字样。\r\n{foreach key=cid item=con from=$results}\r\n{$con.name} - {$con.nick}\r\n{foreache...','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','','/images/default.jpg',0,0,'fail create file','','2011-07-12');
INSERT INTO `publish` VALUES (80,1,NULL,'test','PC210-7','工作油缸','物约1500桶 中方索赔或超2亿','英窃听丑闻引发辞职潮 首相面临辞职压力 \r\n[窃听丑闻揭发人暴毙家中 疑遭灭口]　[英国将开听证会调查窃听案]\r\n[伦敦警察局长辞职]　[新闻集团市值蒸发逾140亿美元]　\r\n...','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','','/images/default.jpg',0,0,'publish/0-1-20110719-050717.php','','2011-07-19');
INSERT INTO `publish` VALUES (81,1,NULL,'日立','PC300-7','修理包','物约1500桶 中方索赔或超2亿','UYUIYUILLHLIHLIU','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','','/images/default.jpg',0,0,'publish/0-1-20110727-040710.php','','2011-07-27');
INSERT INTO `publish` VALUES (95,1,NULL,'日立','ZX60USB-3','气缸相关','物约1500桶 中方索赔或超2亿','有人要','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','','/images/default.jpg',0,0,'publish/0-1-20110727-050738.php','','2011-07-27');
INSERT INTO `publish` VALUES (96,1,NULL,'日立','PC300-7','修理包','在资本主义社会里，新生的财富却全归出资者','\r\n\t\t \t\t在资本主义社会里，新生的财富却全归出资者所有，出力者大部分只能收取定额的工资，而不能分享新生的财富；这种分...\r\n\t\r\n\t龚海燕：为何令女人心动都是“坏男人”\r\n黄鸣：不公平的荣誉错位\r\n袁岳：扮演天使的...','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','','http://upload.iceo.com.cn/2011/0309/thumb_76_76_1299635293637.png',0,0,'publish/0-1-20110727-060732.php','','2011-07-27');
INSERT INTO `publish` VALUES (97,1,NULL,'日立','PC300-7','修理包','最佳答案','&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $fp = fopen(\"log.txt\", \"w\");\r\n&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; fwrite($fp, $sql);\r\n&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; fwrite($fp, mysql_error()); \r\n&...','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','','/images/default.jpg',0,0,'publish/0-1-20110805-020828.php','','2011-08-05');
INSERT INTO `publish` VALUES (98,37,NULL,'日立','PC300-7','工作油缸','最佳答案','2条回复&nbsp;-&nbsp;发帖时间:&nbsp;2011年5月25日\r\n获取使用函式 date() 实现显示的格式: 年-月-日 小时:分钟:妙相关时间参数:a - \"am\" 或是 \"pm\"A - \"AM\" 或是 \"PM\"d - 几日，二位数字，若不足二......','GZ力士德工程机械股份有限公司','广东广州天河区东圃工程机型市场','020-23438923','124452234353','020-23562232','','/images/default.jpg',0,0,'publish/0-37-20110805-020813.php','../company/0-wws.php','2011-08-05');
INSERT INTO `publish` VALUES (99,37,NULL,'tet','test','tes','teset',' 2条回复&nbsp;-&nbsp;发帖时间:&nbsp;2011年5月25日\r\n获取使用函式 date() 实现显示的格式: 年-月-日 小时:分钟:妙相关时间参数:a - \"am\" 或是 \"pm\"A - \"AM\" 或是 \"PM\"d - 几日，二位数字，若不足二......','GZ力士德工程机械股份有限公司','广东广州天河区东圃工程机型市场','020-23438923','124452234353','020-23562232','','/images/default.jpg',0,0,'publish/0-37-20110805-020818.php','../company/0-wws.php','2011-08-05');
INSERT INTO `publish` VALUES (100,37,NULL,'日立','PC300-7','工作油缸','当前的日期','test','GZ力士德工程机械股份有限公司','广东广州天河区东圃工程机型市场','020-23438923','124452234353','020-23562232','','/images/default.jpg',0,0,'publish/0-37-20110805-020811.php','../company/0-wws.php','2011-08-05');
INSERT INTO `publish` VALUES (101,37,NULL,'小松','PC300-7','修理包','当前的日期','2条回复&nbsp;-&nbsp;发帖时间:&nbsp;2011年5月25日\r\n获取使用函式 date() 实现显示的格式: 年-月-日 小时:分钟:妙相关时间参数:a - \"am\" 或是 \"pm\"A - \"AM\" 或是 \"PM\"d - 几日，二位数字，若不足二......','GZ力士德工程机械股份有限公司','广东广州天河区东圃工程机型市场','020-23438923','124452234353','020-23562232','','/images/default.jpg',0,0,'publish/0-37-20110805-020824.php','../company/0-wws.php','2011-08-05');
INSERT INTO `publish` VALUES (102,1,NULL,'日立','PC300-7','工作油缸','当前的日期','PHP缓存作怪还是Apache没配置好 - PHP / 基础编程 \r\n 之前我将程序放在 二级目录下 访问时候 由于程序本身有个错误 出现了警告信息 然后我将程序放到根目录 并且修正了错误 但是访问页面仍然出错 并且 错误消...','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','','/images/default.jpg',0,0,'publish/0-1-20110805-020829.php','','2011-08-05');
INSERT INTO `publish` VALUES (103,1,NULL,'aa','aa','aa','aa','PHP缓存作怪还是Apache没配置好 - PHP / 基础编程 \r\n 之前我将程序放在 二级目录下 访问时候 由于程序本身有个错误 出现了警告信息 然后我将程序放到根目录 并且修正了错误 但是访问页面仍然出错 并且 错误消...','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','','/images/default.jpg',0,0,'publish/0-1-20110805-020842.php','','2011-08-05');
INSERT INTO `publish` VALUES (104,1,NULL,'日立','PC300-7','修理包','当前的日期','PHP缓存作怪还是Apache没配置好 - PHP / 基础编程 \r\n 之前我将程序放在 二级目录下 访问时候 由于程序本身有个错误 出现了警告信息 然后我将程序放到根目录 并且修正了错误 但是访问页面仍然出错 并且 错误消...','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','','/images/default.jpg',0,0,'','','2011-08-05');
INSERT INTO `publish` VALUES (105,1,NULL,'日立','PC300-7','修理包','当前的日期','OW()...','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','','/images/default.jpg',0,0,'publish/0-1-20110805-040806.php','','2011-08-05');
INSERT INTO `publish` VALUES (106,1,NULL,'日立','PC200-1','盖/壳','吞吞吐吐','http://127.0.0.110081','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','','/images/default.jpg',0,0,'publish/0-1-20110805-050822.php','','2011-08-05');
INSERT INTO `publish` VALUES (107,1,NULL,'日立','test','修理包','当前的日期','','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','','/images/default.jpg',0,0,'publish/0-1-20110805-050822.php','','2011-08-05');
INSERT INTO `publish` VALUES (108,1,NULL,'日立','ZX60USB-3','工作油缸','最佳答案','','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','','/images/default.jpg',0,0,'publish/0-1-20110805-050807.php','','2011-08-05 05:47:07');
INSERT INTO `publish` VALUES (109,1,NULL,'日立','ZX60USB-3','工作油缸','最佳答案','','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','','http://t3.gstatic.com/images?q=tbn:ANd9GcQidl6KX2jRWNeCA6jT_TjWG7NlI3aRiB_AcDsA9Y5owS2cr9G6',0,0,'publish/0-1-20110805-050816.php','','2011-08-05 05:57:16');
INSERT INTO `publish` VALUES (110,1,NULL,'日立','ZX60USB-3','修理包','Cutting Edge','','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','','/images/default.jpg',0,0,'publish/0-1-20110808-010823.php','','2011-08-08 01:38:23');
INSERT INTO `publish` VALUES (111,1,NULL,'日立','ZX60USB-3','修理包','Multi-Process','Multi-Process\r\n                                Firefox takes advantage of new\r\n                                  multi-core CPUs by running the browser in multiple processes. This\r\n            ...','广福工程机械有限公司','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','02032237036','13922194126','02032236484','','/images/default.jpg',0,0,'publish/0-1-20110808-010859.php','','2011-08-08 01:42:59');
INSERT INTO `publish` VALUES (128,38,NULL,'小松','PC210-7','回转减速箱总成','30元 可爱、时尚，并','\r\n 幻响i-jerry共振音响 ￥360省30元 可爱、时尚，并且内置配备了mp3功能 [编辑点评] [参数] \r\n...','武汉广福工程机械设备有限公司','广东省广州市天河区中山大道南力子园D8号','020-23438923','124452234353','020-23562232','','http://img0.pconline.com.cn/pconline/m/diy/model/small/1107/20110726_ijerry.jpg',0,0,'/company/test/product128.html','../company/test/index.html','2011-09-01 11:13:43');
INSERT INTO `publish` VALUES (129,38,NULL,'小松','PC300-7','回转减速箱总成','99省501元 搭载了德仪','\r\n 便携奥图码PK301 ￥3299省501元 搭载了德仪0.3” WVGA DMD芯片，分辨率为85 [编辑点评] [参数] \r\n...','武汉广福工程机械设备有限公司','广东省广州市天河区中山大道南力子园D8号','020-23438923','124452234353','020-23562232','','http://img0.pconline.com.cn/pconline/m/network/model/small/1107/100x100OptomaPK301.jpg',0,0,'/company/test/product129.html','../company/test/index.html','2011-09-01 11:20:56');
INSERT INTO `publish` VALUES (130,38,NULL,'小松','工作油缸','大臂油缸','乐游S503到货仅1250','\r\n 乐游S503到货仅1250 ￥1250省100元 Mio自主研发的的导航引擎MioMap2010 3D实景 [编辑点评] [参数] \r\n...','武汉广福工程机械设备有限公司','广东省广州市天河区中山大道南力子园D8号','020-23438923','124452234353','020-23562232','','http://img2.pconline.com.cn/pconline/m/network/model/small/1007/S503.jpg',0,0,'/company/test/product130.html','../company/test/index.html','2011-09-01 11:41:24');
INSERT INTO `publish` VALUES (131,38,NULL,'小松','PC300-7','修理包','超大iphone4 超长待机平板电脑 mid andriod 2.3系统','超大iphone4 超长待机平板电脑 mid andriod 2.3系统\t\t\t\r\n\r\n\t\t\t\t\t\t\t\t\t\t\t\r\n\t\t\t\r\n\t\t\t    \t\t消费者保障 \t\t\t\t\r\n最近成交25笔\t39条评价\r\n广东 深圳\r\n400.00 运费：20.00信用卡\r\n...','武汉广福工程机械设备有限公司','广东省广州市天河区中山大道南力子园D8号','020-23438923','124452234353','020-23562232','','http://img02.taobaocdn.com/bao/uploaded/i2/T1U1eaXeFoXXcYEA34_053640.jpg_sum.jpg',0,0,'/company/test/product131.html','../company/test/index.html','2011-09-02 02:34:56');
INSERT INTO `publish` VALUES (132,38,NULL,'小松','PC300-7','回转减速箱总成','英寸4:3全画幅，比以往多约50%','英寸4:3全画幅，比以往多约50%显示面积\r\n&nbsp;&nbsp;&nbsp;&nbsp; \r\n原道N8采用8英寸4：3比例800*600分辨率全画幅显示，相比常规的7英寸16：9显示屏，多约50%的显示面积。此外，4：3规格比例也能更好的\r\n适应用户的...','武汉广福工程机械设备有限公司','广东省广州市天河区中山大道南力子园D8号','020-23438923','124452234353','020-23562232','','http://img0.pconline.com.cn/pconline/1104/20/2393739_yong3_500.jpg',0,0,'/company/test/product132.html','../company/test/index.html','2011-09-02 03:02:30');

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
  `warehouse` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;

#
# Dumping data for table sales
#

INSERT INTO `sales` VALUES (98,76,2,234,73,20,1460,'2012-02-26 22:33:00','',0,1,NULL);
INSERT INTO `sales` VALUES (99,77,3,234,73,18,1314,'2012-02-26 22:34:00','',0,3,NULL);
INSERT INTO `sales` VALUES (100,78,13,234,73,1,73,'2012-02-26 22:35:00','',0,0,NULL);
INSERT INTO `sales` VALUES (101,79,3,234,77,2,154,'2012-02-26 22:35:00','',0,0,NULL);
INSERT INTO `sales` VALUES (102,80,3,234,77,1,77,'2012-02-26 22:46:00','',0,0,NULL);
INSERT INTO `sales` VALUES (103,81,3,234,77,1,77,'2012-02-26 22:46:00','',0,0,NULL);
INSERT INTO `sales` VALUES (104,82,3,234,77,1,77,'2012-02-26 22:46:00','',0,0,NULL);
INSERT INTO `sales` VALUES (105,83,2,235,70,12,840,'2012-02-27 16:57:00','',5,1,NULL);

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


#
# Table structure for table user
#

CREATE TABLE `user` (
  `id` int(11) NOT NULL auto_increment,
  `account` varchar(20) NOT NULL,
  `passwd` varchar(20) NOT NULL,
  `token` varchar(20) NOT NULL,
  `name` varchar(20) default NULL,
  `company` varchar(20) default NULL,
  `phone` varchar(45) default NULL,
  `mobile` varchar(15) default NULL,
  `fax` varchar(15) default NULL,
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
  `link` varchar(255) default NULL,
  `web` varchar(255) default NULL,
  `bussiness` varchar(500) default NULL,
  `hot` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

#
# Dumping data for table user
#

INSERT INTO `user` VALUES (1,'lwx','123456','','年啊是','广福工程机械有限公司','02032237036','13922194126','02032236484','天河区东圃珠村力子园路丽都花园工程机械商业街B2.108铺','广东','广州','510600','linwe@wsss.com','2269793','linweixuangz@hotmail','',0,0,'2001-11-11',NULL,NULL,NULL,NULL);
INSERT INTO `user` VALUES (29,'admin','123456','4018','杨戬的','','020-23438923','124452234353','020-23562232','广东广州天河区东圃工程机型市场','广东','','5104600','welin@CROSSBEAMSYS.COM','238522828','linwewerwer@hiotmail.com','',0,0,'2011-06-23','../company/0-admin.php',NULL,NULL,NULL);
INSERT INTO `user` VALUES (30,'abc','123456','2358','洋酒','','020-23438923','124452234353','020-23562232','广东广州天河区东圃工程机型市场','重庆','','5104600','sfasfasd@1234.com','23523525','sfasfasd@1234.com','',0,0,'2011-06-29','../company/0-abc.php',NULL,NULL,NULL);
INSERT INTO `user` VALUES (35,'wer','123456','8901','光谷工','武汉光谷工程机型设备有限公司','020-23438923','124452234353','020-23562232','杭州市上城区鸿润挖机齿轮行位于杭州市上城区','重庆','','5104600','welin@CROSSBEAMSYS.COM','238522828','linwewerwer@hiotmail.com','',0,0,'2011-06-30','../company/0-wer.php','','杭州市上城区鸿润挖机齿轮行位于杭州市上城区',NULL);
INSERT INTO `user` VALUES (36,'whh','123456','9856','力士德','山东力士德工程机械股份有限公司','020-23438923','124452234353','020-23562232','山东省临沭县常林西大街112号','北京','','5104600','welin@CROSSBEAMSYS.COM','238522828','linwewerwer@hiotmail.com','',0,0,'2011-06-30','../company/0-whh.php','','山东力士德工程机械股份有限公司是专业化液压挖掘机生产企业，公司成立于2004年3月',NULL);
INSERT INTO `user` VALUES (37,'wws','123456','2688','yyy','GZ力士德工程机械股份有限公司','020-23438923','124452234353','020-23562232','广东广州天河区东圃工程机型市场','福建','','5104600','linweixuan@gmail.com','238522828','linwewerwer@hiotmail.com','',0,0,'2011-06-30','../company/0-wws.php','','杭州市上城区鸿润挖机齿轮行位于杭州市上城区',NULL);
INSERT INTO `user` VALUES (38,'test','test','2072','林伟','武汉广福工程机械设备有限公司','020-23438923','124452234353','020-23562232','广东省广州市天河区中山大道南力子园D8号','','','510460','welin@CROSSBEAMSYS.COM','238522828','linwewerwer@hiotmail.com','',0,0,'2011-09-01','../company/test/index.html','','专业生产、销售高频调剂、喷砂等高强度产品，斗轴、轴套、链通、链肖、活动肖、斗齿肖各种螺丝及斗轴垫片。·专业代理经销底盘易损件产品：链轨总成、链板、引导轮、支重轮、托链轮、驱动齿、斗齿、齿座、刀角板、挖斗、斗连杆、千秋架、涨紧油缸及涨紧弹簧等。·NOK、YCT系列油缸修理包、NOK骨架油封及各种浮动油封，台湾、国产各种盒装油封等密封件产品。·上海奥因特、益盖特增压器专卖。·水泵、马达、发电机、风扇叶、机油散热器及相关辅助产品。·日本三星、阪东及意大利皮带专卖。·三滤产品、发动机易损件、液压件、齿轮产品、橡胶产品、照明及五金工具产品，护理产品等；液压油管及管接头等。',NULL);

#
# Table structure for table warehouse
#

CREATE TABLE `warehouse` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `type` tinyint(3) default '0',
  `totals` int(11) default NULL,
  `memo` varchar(255) default NULL,
  `date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#
# Dumping data for table warehouse
#

INSERT INTO `warehouse` VALUES (1,'广州广福总仓库',1,NULL,'供大宗采购总库存,等待分拨到其他分库的总库',NULL);
INSERT INTO `warehouse` VALUES (2,'广州广福店仓库',0,NULL,'广州广福销售店库存仓库',NULL);
INSERT INTO `warehouse` VALUES (3,'武汉广福店仓库',0,NULL,'武汉曾维胜库存',NULL);
INSERT INTO `warehouse` VALUES (4,'岳阳广福点仓库',0,NULL,'岳阳广福点仓库',NULL);

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

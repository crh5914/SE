/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.18-log : Database - visit_assistant
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`visit_assistant` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `visit_assistant`;

/*Table structure for table `account` */

DROP TABLE IF EXISTS `account`;

CREATE TABLE `account` (
  `ID` int(4) NOT NULL,
  `Name` varchar(15) NOT NULL,
  `Pwd` varchar(15) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `account` */

/*Table structure for table `buildingstructure` */

DROP TABLE IF EXISTS `buildingstructure`;

CREATE TABLE `buildingstructure` (
  `Residentialarea_Name` varchar(20) NOT NULL,
  `BlockName` varchar(10) NOT NULL COMMENT 'louhao',
  `TotalRooms` int(11) NOT NULL,
  `TotalFloors` int(11) NOT NULL,
  `InitFloor` int(11) NOT NULL,
  PRIMARY KEY (`BlockName`),
  KEY `Residentialarea_Name` (`Residentialarea_Name`),
  CONSTRAINT `buildingstructure_ibfk_1` FOREIGN KEY (`Residentialarea_Name`) REFERENCES `residentialarea` (`RaName`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `buildingstructure` */

insert  into `buildingstructure`(`Residentialarea_Name`,`BlockName`,`TotalRooms`,`TotalFloors`,`InitFloor`) values ('海富花园','1号楼',6,24,2),('海富花园','2号楼',5,17,2),('海富花园','3号楼',6,24,2),('海富花园','4号楼',6,23,2),('海富花园','5号楼',4,17,2),('海富花园','6号楼',5,14,2),('海富花园','A1栋',6,10,2),('海富花园','A2栋',6,10,2),('海富花园','A3栋',6,10,2),('海富花园','A4栋',6,10,2),('海富花园','A5栋',6,10,2),('海富花园','A6栋',6,10,2),('海富花园','B10栋',6,10,2),('海富花园','B11栋',6,10,2),('海富花园','B12栋',6,10,2),('海富花园','B1栋',6,10,2),('海富花园','B2栋',6,10,2),('海富花园','B3栋',6,10,2),('海富花园','B4栋',6,10,2),('海富花园','B5栋',6,10,2),('海富花园','B6栋',6,10,2),('海富花园','B7栋',6,10,2),('海富花园','B8栋',6,10,2),('海富花园','B9栋',6,10,2),('海富花园','汇仁阁',9,18,2),('海富花园','汇兴阁',9,18,2),('海富花园','汇嘉阁',8,18,2),('海富花园','汇祥阁',8,18,2),('海富花园','海怡阁',6,10,2),('海富花园','海恒阁',6,10,2),('海富花园','海憬阁',6,10,2),('海富花园','海涛阁',6,10,2),('海富花园','海清阁',6,10,2),('海富花园','海潮阁',6,10,2),('海富花园','海澜阁',6,10,2),('海富花园','海逸阁',6,10,2),('海富花园','海韵阁',6,10,2),('海富花园','海鸣阁',6,10,2);

/*Table structure for table `livein` */

DROP TABLE IF EXISTS `livein`;

CREATE TABLE `livein` (
  `PersonName` varchar(20) NOT NULL,
  `RoomNumber` varchar(20) NOT NULL,
  `RaName` varchar(20) NOT NULL,
  `BlockName` varchar(10) NOT NULL,
  KEY `PersonName` (`PersonName`),
  KEY `RoomNumber` (`RoomNumber`),
  KEY `RaName` (`RaName`),
  KEY `livein_ibfk_4` (`BlockName`),
  CONSTRAINT `livein_ibfk_1` FOREIGN KEY (`PersonName`) REFERENCES `person` (`PersonName`),
  CONSTRAINT `livein_ibfk_2` FOREIGN KEY (`RoomNumber`) REFERENCES `room` (`RoomNumber`),
  CONSTRAINT `livein_ibfk_3` FOREIGN KEY (`RaName`) REFERENCES `residentialarea` (`RaName`),
  CONSTRAINT `livein_ibfk_4` FOREIGN KEY (`BlockName`) REFERENCES `buildingstructure` (`BlockName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `livein` */

insert  into `livein`(`PersonName`,`RoomNumber`,`RaName`,`BlockName`) values ('于红叶','海富花园1号楼201','海富花园','1号楼'),('杨正祥','海富花园1号楼202','海富花园','1号楼'),('温鉴苏','海富花园1号楼203','海富花园','1号楼'),('褚熙华','海富花园1号楼204','海富花园','1号楼'),('陈婉清','海富花园1号楼205','海富花园','1号楼'),('皮慧艳','海富花园1号楼206','海富花园','1号楼'),('傅清逸','海富花园1号楼301','海富花园','1号楼'),('施达成','海富花园1号楼302','海富花园','1号楼'),('喻桓','海富花园1号楼303','海富花园','1号楼'),('弘子昂','海富花园1号楼304','海富花园','1号楼'),('曾加隆','海富花园1号楼305','海富花园','1号楼'),('乐宏一','海富花园1号楼306','海富花园','1号楼'),('毛秋柳','海富花园1号楼401','海富花园','1号楼'),('魏嘉盛','海富花园1号楼402','海富花园','1号楼'),('秦詹','海富花园1号楼403','海富花园','1号楼'),('闵妍伊','海富花园1号楼404','海富花园','1号楼'),('芮月','海富花园1号楼405','海富花园','1号楼'),('武彦辉','海富花园1号楼406','海富花园','1号楼'),('凤玉梁','海富花园1号楼501','海富花园','1号楼'),('虞淋','海富花园1号楼502','海富花园','1号楼'),('羊香卉','海富花园1号楼503','海富花园','1号楼'),('房晓蕾','海富花园1号楼504','海富花园','1号楼'),('庞静枫','海富花园1号楼505','海富花园','1号楼'),('时冬卉','海富花园1号楼506','海富花园','1号楼'),('郑雪容','海富花园1号楼601','海富花园','1号楼'),('云宏','海富花园1号楼602','海富花园','1号楼'),('强雨竹','海富花园1号楼603','海富花园','1号楼'),('柳安寒','海富花园1号楼604','海富花园','1号楼'),('姚向槐','海富花园1号楼605','海富花园','1号楼'),('韦天磊','海富花园1号楼606','海富花园','1号楼');

/*Table structure for table `person` */

DROP TABLE IF EXISTS `person`;

CREATE TABLE `person` (
  `PersonID` char(18) NOT NULL,
  `PersonName` varchar(10) NOT NULL,
  `IsHouseHolder` enum('户主','非户主') NOT NULL,
  `PhoneNumber` varchar(11) NOT NULL,
  `PhoneCarrier` varchar(5) NOT NULL,
  PRIMARY KEY (`PersonName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `person` */

insert  into `person`(`PersonID`,`PersonName`,`IsHouseHolder`,`PhoneNumber`,`PhoneCarrier`) values ('220702198701298339','乐宏一','户主','15917010688','移动'),('410482198402164040','于红叶','户主','13128961182','联通'),('370202197509144365','云宏','户主','15999992888','移动'),('230702198407279067','傅清逸','户主','13622256120','移动'),('421000197706149976','凤玉梁','户主','18898836271','移动'),('620421199208081752','喻桓','户主','18902221995','电信'),('320829197808070742','姚向槐','户主','18319775277','移动'),('341322199102068669','庞静枫','户主','13715009988','移动'),('130603197811271510','弘子昂','户主','13322005178','电信'),('44520019900205516X','强雨竹','户主','15718188688','移动'),('620602199410166903','房晓蕾','户主','13717119933','移动'),('141124197907132619','施达成','户主','13632222225','移动'),('441827198411069786','时冬卉','户主','13711332222','移动'),('110108199209188378','曾加隆','户主','18319775176','移动'),('533527198909210238','杨正祥','户主','15802023370','移动'),('451200197706102226','柳安寒','户主','18022734222','电信'),('420602199102016631','武彦辉','户主','18898798562','移动'),('330212197504034197','毛秋柳','户主','13118880717','联通'),('370882197811107818','温鉴苏','户主','15802025653','移动'),('350602198201193702','皮慧艳','户主','13265101088','联通'),('640502198912100190','秦詹','户主','17727107773','电信'),('621226199111149986','羊香卉','户主','13670022288','移动'),('210114197903116616','芮月','户主','15889200001','移动'),('321322197706041106','虞淋','户主','15813722288','移动'),('532932197809203652','褚熙华','户主','18665029989','联通'),('220283198608211463','郑雪容','户主','13928888188','移动'),('511902198904127979','闵妍伊','户主','13006709995','联通'),('532924197604238122','陈婉清','户主','13250788858','联通'),('450601198609245198','韦天磊','户主','13265083388','联通'),('341503197503139133','魏嘉盛','户主','15398905655','电信');

/*Table structure for table `residentialarea` */

DROP TABLE IF EXISTS `residentialarea`;

CREATE TABLE `residentialarea` (
  `RaName` varchar(20) NOT NULL,
  `Province` varchar(5) NOT NULL,
  `City` varchar(5) NOT NULL,
  `District` varchar(5) NOT NULL COMMENT 'qu',
  `Region` varchar(10) NOT NULL COMMENT 'jiedao',
  `RaAddress` varchar(50) NOT NULL,
  PRIMARY KEY (`RaName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `residentialarea` */

insert  into `residentialarea`(`RaName`,`Province`,`City`,`District`,`Region`,`RaAddress`) values ('海富花园','广东省','广州市','海珠区','江南西','广东省广州市海珠区江南西');

/*Table structure for table `room` */

DROP TABLE IF EXISTS `room`;

CREATE TABLE `room` (
  `RoomNumber` varchar(20) NOT NULL COMMENT '房间全名',
  `FloorNumber` int(11) NOT NULL,
  `NumOfRoomMember` int(11) NOT NULL,
  `IsIPTV` enum('是','否') NOT NULL,
  `IsDxKuandai` enum('是','否') NOT NULL,
  `Dxkuandai` enum('无','光纤接入','铜线接入') DEFAULT NULL,
  `BandWidth` varchar(6) DEFAULT NULL,
  `DataTrafficPerMonth` varchar(6) DEFAULT NULL,
  `ExpirationTimeOfBandWidth` date DEFAULT NULL,
  `MonthlyConsumption` varchar(6) DEFAULT NULL,
  `Appdaodayonghu` int(11) NOT NULL,
  `HouseHolder` varchar(20) NOT NULL,
  `HouseHolder_PhoneNumber` varchar(11) NOT NULL,
  `VisitIn3mon` enum('未拜访','已拜访') DEFAULT NULL,
  `VisitTimes` int(11) NOT NULL,
  PRIMARY KEY (`RoomNumber`),
  KEY `HouseHolder` (`HouseHolder`),
  CONSTRAINT `room_ibfk_1` FOREIGN KEY (`HouseHolder`) REFERENCES `person` (`PersonName`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `room` */

insert  into `room`(`RoomNumber`,`FloorNumber`,`NumOfRoomMember`,`IsIPTV`,`IsDxKuandai`,`Dxkuandai`,`BandWidth`,`DataTrafficPerMonth`,`ExpirationTimeOfBandWidth`,`MonthlyConsumption`,`Appdaodayonghu`,`HouseHolder`,`HouseHolder_PhoneNumber`,`VisitIn3mon`,`VisitTimes`) values ('海富花园1号楼201',2,5,'否','是','光纤接入','20.0M','0.0MB','2017-07-01','0.0元',5,'于红叶','13128961182','未拜访',0),('海富花园1号楼202',2,4,'否','是','光纤接入','20.0M','0.0MB','2017-08-01','0.0元',4,'杨正祥','15802023370','未拜访',0),('海富花园1号楼203',2,1,'否','否','无','无','无',NULL,'0.0元',1,'温鉴苏','15802025653','未拜访',0),('海富花园1号楼204',2,2,'否','否','无','无','无',NULL,'0.0元',2,'褚熙华','18665029989','未拜访',0),('海富花园1号楼205',2,3,'否','否','无','无','无',NULL,'0.0元',3,'陈婉清','13250788858','未拜访',0),('海富花园1号楼206',2,1,'否','否','无','无','无',NULL,'0.0元',1,'皮慧艳','13265101088','未拜访',0),('海富花园1号楼301',3,2,'否','否','无','无','无',NULL,'0.0元',2,'傅清逸','13622256120','未拜访',0),('海富花园1号楼302',3,4,'否','否','无','无','无',NULL,'0.0元',4,'施达成','13632222225','未拜访',0),('海富花园1号楼303',3,3,'否','是','光纤接入','20.0M','0.0MB','2017-05-01','0.0元',3,'喻桓','18902221995','未拜访',0),('海富花园1号楼304',3,2,'否','是','光纤接入','100.0M','0.0MB','2017-05-02','0.0元',2,'弘子昂','13322005178','未拜访',0),('海富花园1号楼305',3,3,'否','是','光纤接入','20.0M','0.0MB','2017-05-03','0.0元',3,'曾加隆','18319775176','未拜访',0),('海富花园1号楼306',3,3,'否','是','光纤接入','20.0M','0.0MB','2017-05-04','0.0元',3,'乐宏一','15917010688','未拜访',0),('海富花园1号楼401',4,3,'否','是','铜线接入','2.0M','0.0MB','2017-05-05','0.0元',3,'毛秋柳','13118880717','未拜访',0),('海富花园1号楼402',4,3,'否','是','铜线接入','2.0M','0.0MB','2017-05-06','0.0元',3,'魏嘉盛','15398905655','未拜访',0),('海富花园1号楼403',4,2,'否','是','光纤接入','20.0M','0.0MB','2017-05-07','0.0元',2,'秦詹','17727107773','未拜访',0),('海富花园1号楼404',4,2,'否','是','光纤接入','100.0M','0.0MB','2017-05-08','0.0元',2,'闵妍伊','13006709995','未拜访',0),('海富花园1号楼405',4,1,'是','是','光纤接入','20.0M','0.0MB','2017-05-09','0.0元',1,'芮月','15889200001','未拜访',0),('海富花园1号楼406',4,2,'否','是','光纤接入','20.0M','0.0MB','2017-05-10','0.0元',2,'武彦辉','18898798562','未拜访',0),('海富花园1号楼501',5,2,'否','是','光纤接入','20.0M','0.0MB','2017-05-11','0.0元',2,'凤玉梁','18898836271','未拜访',0),('海富花园1号楼502',5,1,'否','是','光纤接入','100.0M','0.0MB','2017-05-12','0.0元',0,'虞淋','15813722288','未拜访',0),('海富花园1号楼503',5,3,'否','是','光纤接入','20.0M','0.0MB','2017-05-13','0.0元',3,'羊香卉','13670022288','未拜访',0),('海富花园1号楼504',5,4,'否','是','光纤接入','20.0M','0.0MB','2017-05-14','0.0元',4,'房晓蕾','13717119933','未拜访',0),('海富花园1号楼505',5,3,'是','否','无','无','无',NULL,'0.0元',3,'庞静枫','13715009988','未拜访',0),('海富花园1号楼506',5,1,'否','否','无','无','无',NULL,'0.0元',0,'时冬卉','13711332222','未拜访',0),('海富花园1号楼601',6,2,'否','否','无','无','无',NULL,'0.0元',2,'郑雪容','13928888188','未拜访',0),('海富花园1号楼602',6,3,'是','是','铜线接入','2.0M','0.0MB','2017-07-01','0.0元',3,'云宏','15999992888','未拜访',0),('海富花园1号楼603',6,5,'否','是','光纤接入','20.0M','0.0MB','2017-07-02','0.0元',5,'强雨竹','15718188688','未拜访',0),('海富花园1号楼604',6,3,'否','是','光纤接入','100.0M','0.0MB','2017-07-03','0.0元',3,'柳安寒','18022734222','未拜访',0),('海富花园1号楼605',6,2,'否','是','光纤接入','20.0M','0.0MB','2017-07-04','0.0元',2,'姚向槐','18319775277','未拜访',0),('海富花园1号楼606',6,1,'否','否','无','无','无',NULL,'0.0元',0,'韦天磊','13265083388','未拜访',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

/*
SQLyog Community Edition- MySQL GUI v8.05 
MySQL - 5.1.30-community : Database - smk2_siskeu
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`smk2_siskeu` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `smk2_siskeu`;

/*Table structure for table `pub_group` */

DROP TABLE IF EXISTS `pub_group`;

CREATE TABLE `pub_group` (
  `idGroup` int(11) NOT NULL AUTO_INCREMENT,
  `namaGroup` varchar(60) NOT NULL,
  PRIMARY KEY (`idGroup`,`namaGroup`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `pub_group` */

insert  into `pub_group`(`idGroup`,`namaGroup`) values (1,'Admin'),(2,'Guru'),(99,'Siswa');

/*Table structure for table `pub_menu` */

DROP TABLE IF EXISTS `pub_menu`;

CREATE TABLE `pub_menu` (
  `idMenu` int(11) NOT NULL AUTO_INCREMENT,
  `namaMenu` varchar(64) NOT NULL,
  `groupMenu` int(11) NOT NULL,
  PRIMARY KEY (`idMenu`,`namaMenu`),
  UNIQUE KEY `idMenu` (`idMenu`),
  KEY `FK_pub_menu` (`groupMenu`),
  CONSTRAINT `FK_pub_menu` FOREIGN KEY (`groupMenu`) REFERENCES `pub_group` (`idGroup`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `pub_menu` */

insert  into `pub_menu`(`idMenu`,`namaMenu`,`groupMenu`) values (4,'Manajemen Referensi',1),(5,'Manajemen Pemasukan',1),(6,'Manajemen Dana',1),(8,'Perijinan Ujian',2),(7,'Rekapitulasi Data',99),(9,'Authentikasi',99);

/*Table structure for table `pub_module` */

DROP TABLE IF EXISTS `pub_module`;

CREATE TABLE `pub_module` (
  `idModule` int(11) NOT NULL AUTO_INCREMENT,
  `namaModule` varchar(64) NOT NULL,
  PRIMARY KEY (`idModule`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `pub_module` */

insert  into `pub_module`(`idModule`,`namaModule`) values (1,'ref_jenis_iuran'),(2,'ref_data_siswa'),(3,'pemasukan_iuran'),(4,'pemasukan_iuran_tahunan'),(5,'pengeluaran_bon'),(6,'pengeluaran_setoran'),(7,'rekap_siswa'),(8,'pemasukan_dps'),(9,'rekap_umum'),(10,'ujian_black_list'),(11,'ujian_cetak_kartu'),(12,'ganti_password'),(13,'setting_semester');

/*Table structure for table `pub_submenu` */

DROP TABLE IF EXISTS `pub_submenu`;

CREATE TABLE `pub_submenu` (
  `idSubMenu` int(11) NOT NULL AUTO_INCREMENT,
  `namaSubMenu` varchar(60) NOT NULL,
  `idMenuParent` int(11) NOT NULL,
  `idSubMenuModul` int(11) DEFAULT NULL,
  `subMenuGroup` int(11) DEFAULT NULL,
  PRIMARY KEY (`idSubMenu`,`namaSubMenu`),
  UNIQUE KEY `idSubMenu` (`idSubMenu`),
  KEY `FK_pub_submenu` (`subMenuGroup`),
  KEY `FK_module_submenu` (`idSubMenuModul`),
  CONSTRAINT `FK_module_submenu` FOREIGN KEY (`idSubMenuModul`) REFERENCES `pub_module` (`idModule`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_pub_submenu` FOREIGN KEY (`subMenuGroup`) REFERENCES `pub_group` (`idGroup`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `pub_submenu` */

insert  into `pub_submenu`(`idSubMenu`,`namaSubMenu`,`idMenuParent`,`idSubMenuModul`,`subMenuGroup`) values (1,'Referensi Jenis Iuran',4,1,1),(2,'Referensi Data Siswa',4,2,1),(3,'Iuran Bulanan Siswa',5,3,1),(4,'Iuran Tahunan Siswa',5,4,1),(5,'Manajemen Setoran',6,6,1),(6,'Peminjaman Dana',6,5,1),(7,'Rekapitulasi @siswa',7,7,2),(8,'Rekapitulasi Umum',7,9,99),(9,'Lihat Black List',8,10,2),(10,'Cek Ijin Ujian',8,11,1),(11,'Dana Pengembangan',5,8,1),(12,'Ganti Password',9,12,99),(14,'Setting Semester',4,13,1);

/*Table structure for table `pub_user` */

DROP TABLE IF EXISTS `pub_user`;

CREATE TABLE `pub_user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `namaUser` varchar(60) NOT NULL,
  `passwordUser` varchar(60) NOT NULL,
  `groupUser` int(11) NOT NULL,
  PRIMARY KEY (`idUser`,`namaUser`),
  KEY `FK_pub_user` (`groupUser`),
  CONSTRAINT `FK_pub_user` FOREIGN KEY (`groupUser`) REFERENCES `pub_group` (`idGroup`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `pub_user` */

insert  into `pub_user`(`idUser`,`namaUser`,`passwordUser`,`groupUser`) values (1,'admin','rifqi',1),(2,'kepsek','kepsek',2),(3,'guru','guru',2);

/*Table structure for table `sis_kelas` */

DROP TABLE IF EXISTS `sis_kelas`;

CREATE TABLE `sis_kelas` (
  `idKelas` int(11) NOT NULL AUTO_INCREMENT,
  `namaKelas` varchar(32) NOT NULL,
  PRIMARY KEY (`idKelas`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `sis_kelas` */

insert  into `sis_kelas`(`idKelas`,`namaKelas`) values (1,'Akuntansi'),(2,'Teknik Komputer dan Jaringan'),(3,'Perkantoran'),(4,'Tata Busana'),(5,'Tata Boga'),(6,'Penjualan');

/*Table structure for table `sis_nama_iuran` */

DROP TABLE IF EXISTS `sis_nama_iuran`;

CREATE TABLE `sis_nama_iuran` (
  `idJenisIuran` int(11) NOT NULL AUTO_INCREMENT,
  `namaJenisIuran` varchar(64) NOT NULL,
  `syaratUTS` int(11) NOT NULL DEFAULT '0',
  `syaratUAS` int(11) NOT NULL DEFAULT '0',
  `JenisIuran` varchar(11) NOT NULL,
  `IsGeneral` tinyint(1) DEFAULT '0',
  `namaSingkat` varchar(16) NOT NULL,
  PRIMARY KEY (`idJenisIuran`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `sis_nama_iuran` */

insert  into `sis_nama_iuran`(`idJenisIuran`,`namaJenisIuran`,`syaratUTS`,`syaratUAS`,`JenisIuran`,`IsGeneral`,`namaSingkat`) values (1,'Dana Komite',50,100,'Bulanan',0,'KOMITE'),(2,'Dana Tabungan Akhir',0,0,'Bulanan',1,'TA'),(3,'Dana Prakerin',0,100,'Tahunan',1,'PRAKERIN'),(4,'Dana Kesiswaan',0,100,'Tahunan',1,'KESISWAAN'),(5,'Dana Pengembangan Sekolah',0,100,'Sumbangan',1,'DPS');

/*Table structure for table `sis_nominal_dps` */

DROP TABLE IF EXISTS `sis_nominal_dps`;

CREATE TABLE `sis_nominal_dps` (
  `nisSiswaDps` varchar(8) NOT NULL,
  `nominalDps` int(11) DEFAULT '0',
  PRIMARY KEY (`nisSiswaDps`),
  KEY `FK_sis_nominal_dps` (`nominalDps`),
  CONSTRAINT `FK_sis_nominal_dps` FOREIGN KEY (`nisSiswaDps`) REFERENCES `sis_siswa` (`nisSiswa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `sis_nominal_dps` */

insert  into `sis_nominal_dps`(`nisSiswaDps`,`nominalDps`) values ('06650025',200000),('06650001',1000000),('06650030',1000000),('06650031',1000000),('06650066',1000000),('06650002',1500000),('06650017',2000000),('06650003',3000000);

/*Table structure for table `sis_nominal_iuran` */

DROP TABLE IF EXISTS `sis_nominal_iuran`;

CREATE TABLE `sis_nominal_iuran` (
  `idNominalJenisIuran` int(11) NOT NULL,
  `NominalJenjangKelas` int(11) DEFAULT '0',
  `nominalIuran` int(11) DEFAULT NULL,
  UNIQUE KEY `FK_sis_nominal_iuran` (`idNominalJenisIuran`,`NominalJenjangKelas`),
  CONSTRAINT `FK_sis_nominal_iuran` FOREIGN KEY (`idNominalJenisIuran`) REFERENCES `sis_nama_iuran` (`idJenisIuran`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `sis_nominal_iuran` */

insert  into `sis_nominal_iuran`(`idNominalJenisIuran`,`NominalJenjangKelas`,`nominalIuran`) values (1,1,125000),(1,2,100000),(1,3,75000),(2,0,25000),(3,0,75000),(4,0,75000),(5,0,NULL);

/*Table structure for table `sis_peminjaman` */

DROP TABLE IF EXISTS `sis_peminjaman`;

CREATE TABLE `sis_peminjaman` (
  `idPeminjaman` int(11) NOT NULL AUTO_INCREMENT,
  `namaPeminjam` varchar(32) NOT NULL,
  `nominalPeminjaman` int(11) NOT NULL,
  `tanggalPeminjaman` date NOT NULL,
  PRIMARY KEY (`idPeminjaman`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `sis_peminjaman` */

insert  into `sis_peminjaman`(`idPeminjaman`,`namaPeminjam`,`nominalPeminjaman`,`tanggalPeminjaman`) values (1,'Pak Suripto',150000,'2009-11-10'),(2,'Pak Nyoto',550000,'2009-11-09'),(3,'Pak Larto',300000,'2009-12-06'),(4,'Pak Bejo',200000,'2009-12-06'),(5,'Rifqi',200000,'2009-12-08');

/*Table structure for table `sis_pengembalian` */

DROP TABLE IF EXISTS `sis_pengembalian`;

CREATE TABLE `sis_pengembalian` (
  `idPengembalian` int(11) NOT NULL AUTO_INCREMENT,
  `idPeminjamanKembali` int(11) NOT NULL,
  `nominalKembali` int(11) NOT NULL,
  `tanggalKembali` date NOT NULL,
  PRIMARY KEY (`idPengembalian`),
  KEY `FK_sis_pengembalian` (`idPeminjamanKembali`),
  CONSTRAINT `FK_sis_pengembalian` FOREIGN KEY (`idPeminjamanKembali`) REFERENCES `sis_peminjaman` (`idPeminjaman`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `sis_pengembalian` */

insert  into `sis_pengembalian`(`idPengembalian`,`idPeminjamanKembali`,`nominalKembali`,`tanggalKembali`) values (1,1,20000,'2009-08-08'),(2,1,10000,'2009-08-08'),(3,2,100000,'2009-08-08'),(4,2,50000,'2009-08-09'),(5,1,10000,'2009-08-08'),(7,2,50000,'2009-11-22'),(8,2,200000,'2009-12-05'),(9,2,100000,'2009-12-05'),(10,1,0,'2009-12-06'),(11,1,10000,'2009-12-06'),(12,3,0,'2009-12-06'),(13,3,50000,'2009-12-06'),(14,5,50000,'2009-12-08'),(15,4,250000,'2009-12-08');

/*Table structure for table `sis_rekap_iuran` */

DROP TABLE IF EXISTS `sis_rekap_iuran`;

CREATE TABLE `sis_rekap_iuran` (
  `nisSiswaRekap` varchar(8) NOT NULL,
  `idIuranRekap` int(11) NOT NULL,
  `nominalRekap` int(11) NOT NULL DEFAULT '0',
  `tanggal` date DEFAULT NULL,
  `idRekapSiswa` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idRekapSiswa`),
  KEY `NewIndex1` (`nisSiswaRekap`,`idIuranRekap`),
  KEY `FK_sis_nama_iuran` (`idIuranRekap`),
  CONSTRAINT `FK_sis_nama_iuran` FOREIGN KEY (`idIuranRekap`) REFERENCES `sis_nama_iuran` (`idJenisIuran`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_sis_rekap_iuran` FOREIGN KEY (`nisSiswaRekap`) REFERENCES `sis_siswa` (`nisSiswa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `sis_rekap_iuran` */

insert  into `sis_rekap_iuran`(`nisSiswaRekap`,`idIuranRekap`,`nominalRekap`,`tanggal`,`idRekapSiswa`) values ('06650001',5,25000,'2009-11-05',1),('06650001',2,50000,'2009-11-05',2),('06650001',3,50000,'2009-11-06',3),('06650001',4,20000,'2009-11-06',4),('06650001',5,250000,'2009-11-09',5),('06650002',1,250000,'2009-11-09',6),('06650002',5,50000,'2009-11-09',7),('06650002',3,75000,'2009-11-09',8),('06650002',4,75000,'2009-11-09',9),('06650002',5,200000,'2009-11-09',10),('06650004',1,125000,'2009-11-21',11),('06650004',3,25000,'2009-11-21',12),('06650001',1,750000,'2009-12-06',13),('06650005',5,300000,'2009-12-06',14),('06650001',2,125000,'2009-12-08',15),('06650001',1,125000,'2009-12-08',16),('06650001',2,25000,'2009-12-08',17),('06650003',1,125000,'2009-12-08',18),('06650003',2,25000,'2009-12-08',19);

/*Table structure for table `sis_rekap_setoran` */

DROP TABLE IF EXISTS `sis_rekap_setoran`;

CREATE TABLE `sis_rekap_setoran` (
  `idRekapSetoran` int(11) NOT NULL AUTO_INCREMENT,
  `idNamaRekapSetoran` int(11) NOT NULL,
  `nominalRekapSetoran` int(11) NOT NULL,
  `tanggalPenyetoran` date NOT NULL,
  `keterangan` text,
  PRIMARY KEY (`idRekapSetoran`),
  KEY `FK_sis_rekap_setoran` (`idNamaRekapSetoran`),
  CONSTRAINT `FK_sis_rekap_setoran` FOREIGN KEY (`idNamaRekapSetoran`) REFERENCES `sis_nama_iuran` (`idJenisIuran`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `sis_rekap_setoran` */

insert  into `sis_rekap_setoran`(`idRekapSetoran`,`idNamaRekapSetoran`,`nominalRekapSetoran`,`tanggalPenyetoran`,`keterangan`) values (1,1,100000,'2009-11-05',''),(3,3,25000,'2009-11-06',''),(4,1,25000,'2009-11-07',''),(5,3,25000,'2009-11-07','Tes'),(6,1,100000,'2009-11-21',''),(7,4,75000,'2009-11-21',''),(8,5,300000,'2009-12-06',''),(9,2,150000,'2009-12-08',''),(10,2,15000,'2009-12-08','');

/*Table structure for table `sis_siswa` */

DROP TABLE IF EXISTS `sis_siswa`;

CREATE TABLE `sis_siswa` (
  `nisSiswa` varchar(8) NOT NULL,
  `namaSiswa` varchar(128) NOT NULL,
  `passwordSiswa` varchar(64) NOT NULL,
  `groupID` int(2) NOT NULL DEFAULT '99',
  `jenjangKelasSiswa` int(11) NOT NULL DEFAULT '1',
  `idKelasSiswa` int(11) NOT NULL,
  PRIMARY KEY (`nisSiswa`),
  KEY `FK_sis_siswa` (`groupID`),
  KEY `FK_kelas_siswa` (`idKelasSiswa`),
  CONSTRAINT `FK_sis_siswa` FOREIGN KEY (`idKelasSiswa`) REFERENCES `sis_kelas` (`idKelas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `sis_siswa` */

insert  into `sis_siswa`(`nisSiswa`,`namaSiswa`,`passwordSiswa`,`groupID`,`jenjangKelasSiswa`,`idKelasSiswa`) values ('06650001','Abdullah','06650004',99,1,1),('06650002','Ali','06650002',99,1,1),('06650003','Abu Bakar','06650003',99,1,1),('06650004','Usman','06650003',99,1,1),('06650005','Umar','06650003',99,1,1),('06650007','Saad','06650003',99,1,1),('06650008','Abu Ubaidillah','06650003',99,1,1),('06650009','Bukhari','06650003',99,1,1),('06650010','Abdurrahman','06650003',99,1,1),('06650011','Fatimah','06650003',99,1,1),('06650012','Khatidjah','06650003',99,1,1),('06650013','Marhamah','06650003',99,1,1),('06650014','Maemunah','06650003',99,1,1),('06650015','Mahmudah','06650003',99,1,1),('06650016','Jafar','066500014',99,1,2),('06650017','Siswa','06650051',99,1,1),('06650025','Jafar','06650025',99,1,1),('06650030','John','06650030',99,1,5),('06650031','Johny','06650031',99,1,5),('06650066','Roni','06650066',99,2,3);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;

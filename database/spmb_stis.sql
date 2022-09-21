-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: spmb_stis
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `username` varchar(9) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id`) REFERENCES `peserta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'Novanni Indi Pradana','Admin','222011436','admin','novan.jpeg');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laporan`
--

DROP TABLE IF EXISTS `laporan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laporan` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `nip` varchar(18) NOT NULL,
  `tanggal_tes` date NOT NULL,
  `tahap_tes` varchar(50) NOT NULL,
  `lokasi_tes` varchar(50) NOT NULL,
  `sesi_tes` varchar(50) NOT NULL,
  `file` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laporan`
--

LOCK TABLES `laporan` WRITE;
/*!40000 ALTER TABLE `laporan` DISABLE KEYS */;
INSERT INTO `laporan` VALUES (1,'Gojo Satoru','198912072013120701','2022-07-18','Tahap 1','Zoom 001','Sesi 1','62a346d0c612d.zip'),(2,'Makima','199010102013101002','2022-07-18','Tahap 1','Zoom 001','Sesi 2','62a346d0c734d.zip'),(3,'Yukari Yukino','198905152012051501','2022-07-19','Tahap 1','Zoom 002','Sesi 1','62a347461cbca.zip'),(4,'Sakata Gintoki','198810102011101001','2022-07-19','Tahap 1','Zoom 003','Sesi 2','62a3477a910f7.zip'),(5,'Koro Sensei','198803132012031301','2022-07-18','Tahap 1','Zoom 001','Sesi 3','62a347c616424.zip'),(6,'Haise Sasaki','199512202019122001','2022-07-19','Tahap 1','Zoom 002','Sesi 3','62a348235c6ea.zip'),(7,'Aizawa Shouta','199910102011101001','2022-07-20','Tahap 1','Zoom 001','Sesi 2','62a3485c5b858.zip'),(8,'Raiden Ei','198806262011101001','2022-07-20','Tahap 1','Zoom 002','Sesi 1','62a348d636c5c.zip'),(9,'Elma','199912202019122002','2022-07-18','Tahap 1','Zoom 001','Sesi 1','62adf7836fc00.zip'),(15,'Gojo Satoru','198912072013120701','2022-07-20','Tahap 2','Zoom 001','Sesi 3','62b50611e4937.zip');
/*!40000 ALTER TABLE `laporan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengawas`
--

DROP TABLE IF EXISTS `pengawas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengawas` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `username` varchar(18) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `tahap_1` date DEFAULT NULL,
  `lokasi_1` varchar(25) DEFAULT NULL,
  `tahap_2` date DEFAULT NULL,
  `lokasi_2` varchar(25) DEFAULT NULL,
  `tahap_3` date DEFAULT NULL,
  `lokasi_3` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengawas`
--

LOCK TABLES `pengawas` WRITE;
/*!40000 ALTER TABLE `pengawas` DISABLE KEYS */;
INSERT INTO `pengawas` VALUES (1,'Gojo Satoru','Pengawas SPMB','BPS DKI Jakarta','198912072013120701','$2y$10$ijRHqFA/e.e9jDsm/6DFpOcDxR5DXWuYPfeLkrZ.oeIxJF8cpWVW2','62a983718f7fa.jpg','2022-07-18','Zoom 001 - Sesi 1',NULL,NULL,NULL,NULL),(2,'Makima','Pengawas SPMB','Politeknik Statistika STIS','199010102013101002','$2y$10$sM0OnuQ01VrrubLgDkGAz.3q42bkHUJOH1w.PVBsFccVObQsQInQC','62a983ac1dca8.jpg','2022-07-18','Zoom 001 - Sesi 2',NULL,NULL,NULL,NULL),(3,'Yukari Yukino','Pengawas SPMB','BPS Nusa Tenggara Barat','198905152012051501','$2y$10$DAdOsQ2v732btWmdtQRieu853jY5qEwe6VHED8BdEqZ4p6j4kgYYK','62a983fc5608e.jpg','2022-07-19','Zoom 001 - Sesi 3',NULL,NULL,NULL,NULL),(4,'Sakata Gintoki','Pengawas SPMB','BPS Jawa Tengah','198810102011101001','$2y$10$4CMQsgieoZk.k/zhRKAyFeCQiGRbgVfacbBdlCGN6TMG7.nIQfhj6','62a9843352a6c.jpg','2022-07-19','Zoom 002 - Sesi 1',NULL,NULL,NULL,NULL),(5,'Koro Sensei','Pengawas SPMB','Politeknik Statistika STIS','198803132012031301','$2y$10$X2YYG0foTce7a0.H2J75j.RmPHieYBXVDQvsjWx6Vc59ttOEqM/AC','62a984598313c.jpg','2022-07-18','Zoom 002 - Sesi 2',NULL,NULL,NULL,NULL),(6,'Haise Sasaki','Pengawas SPMB','BPS Lampung','199512202019122001','$2y$10$rHK8MAgnb.9K1cp2s2rRiOuM/RcfPoZ196jbHBpIUvXRB7l896GDi','62a9847834418.jpg','2022-07-19','Zoom 002 - Sesi 2',NULL,NULL,NULL,NULL),(7,'Aizawa Shouta','Pengawas SPMB','Politeknik Statistika STIS','199910102011101001','$2y$10$Y61QbhljkQgamGG5XGtquOXDGx/r0k5oZ0/N39TRgZAGsa.peBngO','62a98499a3710.jpg','2022-07-20','Zoom 002 - Sesi 3',NULL,NULL,NULL,NULL),(8,'Raiden Ei','Pengawas SPMB','BPS Jambi','198806262011101001','$2y$10$MDQnx94FdJ4G1wLwPVNpN.GmApwbST.ydM9HPrvaMUDa9bsrwV4gu','62a1f38fba1e8.jpg','2022-07-20','Zoom 002 - Sesi 1',NULL,NULL,NULL,NULL),(9,'Yuuri Oriki','Pengawas SPMB','BPS Jawa Timur','199903132012031301','$2y$10$Tuf/JJ5ldCtlPfW9EuKlMO044YN6w5WQDvHGga8wmgiDO9VNZ/Be.','62a1f49091407.jpg','2022-07-20','Zoom 003 - Sesi 3',NULL,NULL,NULL,NULL),(10,'Elma','Pengawas SPMB','Politeknik Statistika STIS','199912202019122002','$2y$10$m9F5ZITI59F6YimBFijaxeNVlOGA72eXn23gnyvBNZ918lKDZ94C.','62a1f9aa20a0d.jpg','2022-07-20','Zoom 003 - Sesi 1',NULL,NULL,NULL,NULL),(11,'Levi Ackerman','Pengawas SPMB','BPS Pusat','198510102011101001','$2y$10$PmAs4ZSqaEeFRFUUCBohSepG.cySmQlHkY7IpvWR2/2YkroRFwmvi','62a2006eb7498.jpg','2022-07-19','Zoom 003 - Sesi 1',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `pengawas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peserta`
--

DROP TABLE IF EXISTS `peserta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peserta` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `nik` varchar(16) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `prodi` varchar(25) NOT NULL,
  `formasi` varchar(25) NOT NULL,
  `tahap_1` date NOT NULL,
  `tahap_2` date DEFAULT NULL,
  `tahap_3` date DEFAULT NULL,
  `gambar` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peserta`
--

LOCK TABLES `peserta` WRITE;
/*!40000 ALTER TABLE `peserta` DISABLE KEYS */;
INSERT INTO `peserta` VALUES (1,'Kaori Miyazono','Perempuan','2001-07-04','3325070407010002','Tokyo','D4 Statistika','Jawa Tengah','2022-06-30',NULL,NULL,'kaori.jpg'),(2,'Anya Forger','Perempuan','2003-05-01','3325070105030001','Westalis','D4 Komputasi Statistik','BPS Pusat','2022-06-30',NULL,NULL,'anya.jpg'),(3,'kamado Tanjiro','Laki-Laki','2022-07-14','3325051314010002','Taisho Era','D3 Statistika','Papua','2022-07-14',NULL,NULL,'tanjiro.jpg'),(4,'Violet Evergarden','Perempuan','2000-08-08','331100808000002','Leidenschaftlich','D4 Statistika','DI Yogyakarta','2022-07-18',NULL,NULL,'violet.jpg'),(5,'Kiyotaka Ayanokoji','Laki-Laki','2001-10-20','332456201001001','Shibuya','D4 Komputasi Statistik','DKI Jakarta','2022-07-17',NULL,NULL,'kiyotaka.jpg'),(6,'Edward Elric','Laki-Laki','2000-10-11','332345111000003','Amestris','D4 Komputasi Statistik','Sumatera Selatan','2022-07-18',NULL,NULL,'elric.jpg'),(7,'Kartika Maya Putri','Perempuan','2001-07-03','332456030701001','Bandung','D4 Statistika','Jawa Barat','2022-07-18',NULL,NULL,'62a1f16b4956d.jpg'),(8,'Akiyama Mio','Perempuan','2001-01-15','3323451501010002','Kyoto','D3 Statistika','Sulawesi Tenggara','2022-07-18',NULL,NULL,'akiyama.jpg'),(9,'Itadori Yuuji','Laki-Laki','2001-03-20','3323452003010003','Tokyo','D4 Statistika','Kalimantan Selatan','2022-07-17',NULL,NULL,'itadori.jpg'),(10,'Yuuki Asuna','Perempuan','2022-09-30','3323453009010001','Aincrad ','D4 Statistika','Bali','2022-07-20','0000-00-00','0000-00-00','629de20a1cd0f.jpg'),(11,'Uzumaki Naruto','Laki-Laki','2000-10-10','3325051010000002','Konoha','D4 Statistika','DKI Jakarta','2022-07-20','0000-00-00','0000-00-00','62a1eb8a4b6b9.jpg'),(12,'Kyouko Hori','Perempuan','2001-03-25','332456250301001','Osaka','D4 Statistika','Sumatera Selatan','2022-07-19','0000-00-00','0000-00-00','62a1ecbf58ca2.jpg'),(13,'Tadakuni','Laki-Laki','2003-07-19','3323451907030001','Kyoto','D3 Statistika','Maluku Utara','2022-02-19','0000-00-00','0000-00-00','62a1edb4ab98e.jpg'),(14,'Nico Yazawa','Perempuan','2002-07-22','3323452207020002','Tokyo','D4 Statistika','Kalimantan Tengah','2022-07-18','0000-00-00','0000-00-00','62a1eef246a06.jpg'),(19,'Hatake Kakashi','Laki-Laki','2002-09-30','3323453009010005','Konoha','D4 Komputasi Statistik','DKI Jakarta','2022-07-18','0000-00-00','0000-00-00','62b01ed6136c3.jpg');
/*!40000 ALTER TABLE `peserta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-24  7:41:31

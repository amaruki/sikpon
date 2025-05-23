-- MySQL dump 10.13  Distrib 8.0.40, for Linux (x86_64)
--
-- Host: localhost    Database: laravel
-- ------------------------------------------------------
-- Server version	5.5.5-10.11.8-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `haris`
--

DROP TABLE IF EXISTS `haris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `haris` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `haris`
--

LOCK TABLES `haris` WRITE;
/*!40000 ALTER TABLE `haris` DISABLE KEYS */;
`INSERT INTO ``haris` VALUES (1,'Senin','2023-10-29 10:10:44','2023-10-29 10:10:44'),(2,'Selasa','2023-10-29 10:10:51','2023-10-29 10:10:51'),(3,'Rabu','2023-10-29 10:11:03','2023-10-29 10:11:03'),(4,'Kamis','2023-10-29 10:11:13','2023-10-29 10:11:13'),(6,'Jumat','2023-10-29 10:11:29','2023-10-29 10:11:29'),(7,'Sabtu','2023-10-29 10:11:36','2023-10-29 10:11:36');
/*!40000 ALTER TABLE `haris` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `informases`
--

DROP TABLE IF EXISTS `informases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `informases` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) NOT NULL,
  `isi` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `informases`
--

LOCK TABLES `informases` WRITE;
/*!40000 ALTER TABLE `informases` DISABLE KEYS */;
INSERT INTO `informases` VALUES (1,'1698652549_Screenshot_1.png','ini nah isi','2023-10-30 07:55:49','2023-10-30 07:55:49'),(2,'1698655160_WhatsApp Image 2023-10-26 at 10.53.41 (1).jpeg','nah he lorem','2023-10-30 08:39:20','2023-10-30 08:39:20');
/*!40000 ALTER TABLE `informases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jadwal_siswas`
--

DROP TABLE IF EXISTS `jadwal_siswas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jadwal_siswas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pegawai_id` int(11) NOT NULL,
  `jadwal_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `tahun_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jadwal_siswas`
--

LOCK TABLES `jadwal_siswas` WRITE;
/*!40000 ALTER TABLE `jadwal_siswas` DISABLE KEYS */;
INSERT INTO `jadwal_siswas` VALUES (18,9,13,10,1,31,148,'2023-12-14 04:06:35','2023-12-14 04:06:35'),(19,9,14,10,1,31,149,'2023-12-14 04:07:34','2023-12-14 04:07:34'),(20,9,13,11,1,31,148,'2023-12-14 05:11:27','2023-12-14 05:11:27'),(21,9,16,10,1,31,154,'2023-12-25 07:36:14','2023-12-25 07:36:14'),(22,9,16,13,1,31,154,'2023-12-25 07:36:18','2023-12-25 07:36:18'),(23,9,14,11,1,31,149,'2023-12-27 08:11:02','2023-12-27 08:11:02'),(24,9,13,13,1,31,148,'2023-12-27 08:32:58','2023-12-27 08:32:58');
/*!40000 ALTER TABLE `jadwal_siswas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jadwals`
--

DROP TABLE IF EXISTS `jadwals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jadwals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `hari_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `jam` varchar(255) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `tahun_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jadwals`
--

LOCK TABLES `jadwals` WRITE;
/*!40000 ALTER TABLE `jadwals` DISABLE KEYS */;
INSERT INTO `jadwals` VALUES (13,7,31,148,'10:00',9,1,'2023-12-14 04:06:29','2023-12-25 06:48:20'),(14,1,31,149,'10:00',9,1,'2023-12-14 04:07:26','2023-12-14 04:07:26'),(16,1,31,154,'14:37',9,1,'2023-12-25 07:36:02','2023-12-25 07:36:02');
/*!40000 ALTER TABLE `jadwals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jurnal`
--

DROP TABLE IF EXISTS `jurnal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jurnal` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_jurnal` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `guru_id` bigint(20) unsigned NOT NULL,
  `mapel_id` bigint(20) unsigned NOT NULL,
  `kelas_id` bigint(20) unsigned NOT NULL,
  `materi_pokok` varchar(255) NOT NULL,
  `kegiatan_pembelajaran` text NOT NULL,
  `evaluasi_pembelajaran` text NOT NULL,
  `siswa_hadir` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`siswa_hadir`)),
  `siswa_tidak_hadir` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`siswa_tidak_hadir`)),
  `jumlah_hadir` int(11) NOT NULL DEFAULT 0,
  `jumlah_tidak_hadir` int(11) NOT NULL DEFAULT 0,
  `catatan_khusus` text DEFAULT NULL,
  `kendala_pembelajaran` text DEFAULT NULL,
  `solusi_kendala` text DEFAULT NULL,
  `status_jurnal` enum('draft','final') NOT NULL DEFAULT 'draft',
  `pencapaian_target` enum('tercapai','sebagian','tidak_tercapai') NOT NULL DEFAULT 'tercapai',
  `keterangan_pencapaian` text DEFAULT NULL,
  `jam_mulai` varchar(255) NOT NULL,
  `jam_selesai` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jurnal_kode_jurnal_unique` (`kode_jurnal`),
  KEY `jurnal_guru_id_foreign` (`guru_id`),
  KEY `jurnal_kelas_id_foreign` (`kelas_id`),
  KEY `jurnal_tanggal_guru_id_index` (`tanggal`,`guru_id`),
  KEY `jurnal_mapel_id_kelas_id_index` (`mapel_id`,`kelas_id`),
  KEY `jurnal_status_jurnal_index` (`status_jurnal`),
  CONSTRAINT `jurnal_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `pegawais` (`id`),
  CONSTRAINT `jurnal_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelases` (`id`) ON DELETE CASCADE,
  CONSTRAINT `jurnal_mapel_id_foreign` FOREIGN KEY (`mapel_id`) REFERENCES `mapels` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jurnal`
--

LOCK TABLES `jurnal` WRITE;
/*!40000 ALTER TABLE `jurnal` DISABLE KEYS */;
INSERT INTO `jurnal` VALUES (1,'JRN-20250523-001','2025-05-23',9,148,31,'123213','asdsadsad','qdasdsadsakjd','[\"10\"]',NULL,1,0,NULL,NULL,NULL,'draft','tidak_tercapai',NULL,'19:00','20:00','2025-05-23 18:16:33','2025-05-23 18:16:33');
/*!40000 ALTER TABLE `jurnal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kelases`
--

DROP TABLE IF EXISTS `kelases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kelases` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kelas` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `pegawai_id` varchar(255) NOT NULL,
  `tahun_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kelases`
--

LOCK TABLES `kelases` WRITE;
/*!40000 ALTER TABLE `kelases` DISABLE KEYS */;
INSERT INTO `kelases` VALUES (31,'1','A','11','1','2023-12-13 08:29:54','2023-12-13 08:29:54');
/*!40000 ALTER TABLE `kelases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kurikulums`
--

DROP TABLE IF EXISTS `kurikulums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kurikulums` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `kelas_id` bigint(20) unsigned DEFAULT NULL,
  `mapel_id` bigint(20) unsigned DEFAULT NULL,
  `standar_kompetensi` longtext DEFAULT NULL,
  `kompetensi_dasar` longtext DEFAULT NULL,
  `jam_pelajaran` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kurikulums_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kurikulums`
--

LOCK TABLES `kurikulums` WRITE;
/*!40000 ALTER TABLE `kurikulums` DISABLE KEYS */;
/*!40000 ALTER TABLE `kurikulums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mapels`
--

DROP TABLE IF EXISTS `mapels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mapels` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mapels`
--

LOCK TABLES `mapels` WRITE;
/*!40000 ALTER TABLE `mapels` DISABLE KEYS */;
INSERT INTO `mapels` VALUES (148,'6d1ccc81-77f0-42c3-a587-5ed7f57d67b4','Bahasa Indonesia','2023-12-13 01:30:06','2023-12-24 23:11:46'),(149,'94487960-b927-4908-8cd9-45a0282c5e87','Matematika','2023-12-13 20:58:15','2023-12-24 23:11:57'),(150,'8648e448-4ed0-495d-abf8-e886b501baed','Seni','2023-12-24 23:12:06','2023-12-24 23:12:06'),(151,'811ad07a-41ef-4270-9ff2-eddc19b0c770','Pendidikan Agama','2023-12-24 23:12:16','2023-12-24 23:12:16'),(152,'f2dd0d2b-9c67-468b-a8fa-1a1c5e7ba33a','Pendidikan Jasmani','2023-12-24 23:12:26','2023-12-24 23:12:26'),(153,'351b30c1-937b-4854-ab20-7c5b36bf6276','Bahasa Inggris','2023-12-24 23:12:34','2023-12-24 23:12:34'),(154,'7934ea49-dc54-4df7-b15d-55932caf68be','Baca Tulis Al-Qur\'an','2023-12-24 23:13:03','2023-12-24 23:13:03'),(155,'6ab39d67-56d5-4684-97de-6adfd2d6c611','IPAS','2023-12-24 23:13:08','2023-12-24 23:13:08');
/*!40000 ALTER TABLE `mapels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2019_12_14_000001_create_personal_access_tokens_table',1),(3,'2023_04_10_140025_create_siswas_table',1),(4,'2023_04_10_143050_create_mapels_table',1),(5,'2023_04_10_143122_create_pegawais_table',1),(6,'2025_03_16_164055_create_kurikulums_table',1),(7,'2025_04_29_141604_create_sessions_table',1),(8,'2025_04_29_144047_add_personal_info_to_pegawai_table',1),(9,'2025_04_29_145446_add_nik_in_siswa_table',1),(10,'2025_05_23_123048_create_informases_table',1),(11,'2025_05_23_130721_create_haris_table',1),(12,'2025_05_23_131018_create_tahuns_table',1),(13,'2025_05_23_132225_create_kelases_table',1),(14,'2025_05_23_132558_create_jadwals_table',1),(15,'2025_05_23_132939_create_jadwal_siswas_table',1),(16,'2025_05_23_142437_create_jurnals_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pegawais`
--

DROP TABLE IF EXISTS `pegawais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pegawais` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `agama` varchar(255) DEFAULT NULL,
  `golongan_darah` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pegawais`
--

LOCK TABLES `pegawais` WRITE;
/*!40000 ALTER TABLE `pegawais` DISABLE KEYS */;
INSERT INTO `pegawais` VALUES (8,'1d79c7c8-e479-44b6-89bb-1a8a8705b051','DELNEDI ZISWAN, M.Pd','19701223 200701 1 007','Kepsek','2023-05-10 18:52:50','2023-05-21 00:24:01',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,'27613d0d-0c9a-4db8-a199-3690408f2710','EKO PURWADI, S.Si','19810208 200803 1 001','Guru','2023-05-21 00:24:46','2023-05-21 00:24:46',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,'9023262e-d638-4422-9872-fef1b3e42c6c','EKO SAPUTRO, S.Pd','19760107 201001 1 004','Guru','2023-05-21 00:26:00','2023-05-21 00:26:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,'061698d0-6243-477d-a38e-8b574b953618','SUMINI, S.Ag','197101052007012006','Guru','2023-05-21 00:26:30','2023-05-21 00:26:30',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,'18584f91-faff-4f51-b50b-8126c3dd51c8','SU\'IB, S.Ag','197310042008011001','Guru','2023-05-21 00:27:03','2023-09-28 01:31:38',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(58,'fe8885c0-ad02-45f9-8faa-6716427ef69a','MARYATI, S.IP','-','Staff','2023-05-21 00:59:56','2023-05-21 00:59:56',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(59,'48adfcbc-3595-4df8-87e5-ac3e978020a2','HARIADI','-','Staff','2023-05-21 01:00:27','2023-05-21 01:00:27',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(60,'84b8eef6-5134-4e9b-b093-47987f62136b','NUR CAHYANTO','-','Staff','2023-05-21 01:00:54','2023-05-21 01:00:54',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(61,'b747ad81-dc36-45e7-b3a4-e8d70bc5b507','M. DEFRI GUSTIAN','-','Staff','2023-05-21 01:01:14','2023-05-21 01:01:14',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `pegawais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('mjbAPEu5uiBiavgg9PUzCiexCEjwtFyA3kHzf1SO',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoicVdTQVpobU1Hd3pwNjFaQjUxYXE3eTlOb0pjbElkMkx5ZzAxRTlKVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9qdXJuYWwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc0ODAyMzYyMDt9fQ==',1748024706);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `siswas`
--

DROP TABLE IF EXISTS `siswas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `siswas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nik` varchar(255) DEFAULT NULL,
  `uuid` varchar(36) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `nisn` varchar(255) DEFAULT NULL,
  `jk` varchar(255) DEFAULT NULL,
  `tempat` varchar(255) DEFAULT NULL,
  `ttl` varchar(255) DEFAULT NULL,
  `ayah` varchar(255) DEFAULT NULL,
  `ibu` varchar(255) DEFAULT NULL,
  `kerja_ayah` varchar(255) DEFAULT NULL,
  `kerja_ibu` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kec` varchar(255) DEFAULT NULL,
  `kel` varchar(255) DEFAULT NULL,
  `kelas_id` varchar(255) DEFAULT NULL,
  `hp` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siswas`
--

LOCK TABLES `siswas` WRITE;
/*!40000 ALTER TABLE `siswas` DISABLE KEYS */;
INSERT INTO `siswas` VALUES (10,'11123235499','4d14f0f5-fdea-4b80-91ea-852bbf2023c0','Bedul',NULL,'Laki-Laki','Jakarta','2023-10-27',NULL,NULL,NULL,NULL,'lambur 5',NULL,NULL,'31','085215156165456','2023-10-27 00:09:40','2025-05-23 18:07:25'),(11,'9789078967','e4e3cc8c-cbca-4f49-af1a-a18d0ef69364','Samsul',NULL,'Laki-Laki','Jambi','1999-01-08',NULL,NULL,NULL,NULL,'Pondok',NULL,NULL,NULL,'0811565464','2023-10-29 06:00:07','2023-10-29 06:00:07'),(12,'9789078967','e4e3cc8c-cbca-4f49-af1a-a18d0ef69364','Sugiharto',NULL,'Laki-Laki','Jambi','1999-01-08',NULL,NULL,NULL,NULL,'Pondok',NULL,NULL,NULL,'0811565464','2023-10-29 06:00:07','2023-10-29 06:00:07'),(13,'9789078967','e4e3cc8c-cbca-4f49-af1a-a18d0ef69364','Tukiyem',NULL,'Laki-Laki','Jambi','1999-01-08',NULL,NULL,NULL,NULL,'Pondok',NULL,NULL,NULL,'0811565464','2023-10-29 06:00:07','2023-10-29 06:00:07'),(14,'9789078967','e4e3cc8c-cbca-4f49-af1a-a18d0ef69364','Brandon',NULL,'Laki-Laki','Jambi','1999-01-08',NULL,NULL,NULL,NULL,'Pondok',NULL,NULL,NULL,'0811565464','2023-10-29 06:00:07','2023-10-29 06:00:07');
/*!40000 ALTER TABLE `siswas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tahuns`
--

DROP TABLE IF EXISTS `tahuns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tahuns` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `status` enum('aktif','tidak_aktif') NOT NULL DEFAULT 'tidak_aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tahuns`
--

LOCK TABLES `tahuns` WRITE;
/*!40000 ALTER TABLE `tahuns` DISABLE KEYS */;
INSERT INTO `tahuns` VALUES (1,'2023','tidak_aktif','2023-10-27 07:43:30','2023-10-27 07:50:23'),(2,'2024','tidak_aktif','2023-10-30 07:40:37','2023-10-30 07:40:37');
/*!40000 ALTER TABLE `tahuns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) NOT NULL,
  `role` enum('Dev','Guru','Siswa') NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `siswa_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'756e6a13-4e27-4525-a327-c5b4b60d1249','Dev','Admin','admin',NULL,NULL,'$2a$12$MVHN3yYzABjtiGIHNRMDf.SRW5r9glE9mTdX/GgM5M94U2QdbCRgW',NULL,NULL,NULL,'2023-04-10 17:57:04','2023-04-10 17:57:04'),(17,'d48b1964-afde-4a19-8192-8db7d555657b','Guru',NULL,'ekopur',NULL,NULL,'$2a$12$MVHN3yYzABjtiGIHNRMDf.SRW5r9glE9mTdX/GgM5M94U2QdbCRgW',9,NULL,NULL,'2023-10-29 05:58:51','2023-10-30 00:25:18'),(18,'81da124a-3554-4115-b1f2-b6dd61146e8f','Siswa',NULL,'bedul',NULL,NULL,'$2a$12$MVHN3yYzABjtiGIHNRMDf.SRW5r9glE9mTdX/GgM5M94U2QdbCRgW',NULL,10,NULL,'2023-10-29 20:06:33','2023-10-30 00:25:52'),(19,'d24039b8-341d-48ef-ae30-9c421b1c1ef1','Guru',NULL,'mini',NULL,NULL,'$2a$12$MVHN3yYzABjtiGIHNRMDf.SRW5r9glE9mTdX/GgM5M94U2QdbCRgW',11,NULL,NULL,'2023-11-16 18:34:46','2023-11-16 18:34:46');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-23 18:26:39

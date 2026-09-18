-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 13, 2026 at 10:15 AM
-- Server version: 11.4.12-MariaDB
-- PHP Version: 8.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anerstco_db_bansos_kmeans`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('superadmin','stakeholder') NOT NULL DEFAULT 'stakeholder',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `nama`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', '$2y$10$oY1nKmmPyRifqpGpEoACUODjUKR2fyt8ikAdgXpLvjkDMHIS08egu', 'superadmin', '2026-07-06 21:44:58', '2026-07-06 21:44:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_calon_penerima`
--

CREATE TABLE `tbl_calon_penerima` (
  `id_calon` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL,
  `pendapatan` decimal(12,2) NOT NULL,
  `jumlah_tanggungan` int(11) NOT NULL,
  `daya_listrik` enum('450 VA','900 VA') NOT NULL,
  `status_rumah` enum('Bebas Sewa','Kontrak','Milik Sendiri') NOT NULL,
  `kondisi_rumah` enum('Tidak Permanen','Semi Permanen','Permanen') NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_calon_penerima`
--

INSERT INTO `tbl_calon_penerima` (`id_calon`, `nik`, `nama`, `alamat`, `pendapatan`, `jumlah_tanggungan`, `daya_listrik`, `status_rumah`, `kondisi_rumah`, `created_at`, `updated_at`) VALUES
(1, '1376040507120001', 'Mulyadi', 'ASRAMA KODIM BUKITTINGGI RT 02 RW 01 RT:2 RW:1', 800000.00, 6, '450 VA', 'Kontrak', 'Tidak Permanen', '2026-07-06 23:44:37', '2026-07-06 23:50:53'),
(2, '1375036304930001', 'Rivani Solihati', 'JL. PERWIRA UJUNG RT:2 RW:2', 1200000.00, 3, '450 VA', 'Bebas Sewa', 'Semi Permanen', '2026-07-06 23:52:37', '2026-07-06 23:52:37'),
(3, '1375036307720001', 'Yultin', 'KUBU TANJUNG RT:2 RW:4', 900000.00, 4, '450 VA', 'Milik Sendiri', 'Tidak Permanen', '2026-07-07 02:09:35', '2026-07-07 02:09:35'),
(4, '1375034412810001', 'Dasmawati', 'JL TANGAH JUA I RT:1 RW:2', 2000000.00, 3, '900 VA', 'Kontrak', 'Permanen', '2026-07-10 02:49:23', '2026-07-10 02:49:23'),
(5, '1375035503780001', 'Ermaita', 'LADANG CAKIAH RT 02 RW 02  RT:2 RW:2', 2500000.00, 5, '900 VA', 'Kontrak', 'Permanen', '2026-07-10 02:50:02', '2026-07-10 02:50:02'),
(6, '1375015310510001', 'Nurlena', 'JL BANTO LAWEH RT:3 RW:1', 1000000.00, 1, '450 VA', 'Bebas Sewa', 'Semi Permanen', '2026-07-10 02:51:03', '2026-07-10 02:51:03'),
(7, '1311064511960002', 'Kartika Mulia', 'JL. BARUMBUNG III PETAK 20 RT:3 RW:5', 2200000.00, 2, '900 VA', 'Kontrak', 'Permanen', '2026-07-10 02:51:41', '2026-07-10 02:51:41'),
(8, '1375010707790007', 'Ahmad Fauzi', 'JL MESJID RT:1 RW:4', 1100000.00, 3, '450 VA', 'Milik Sendiri', 'Semi Permanen', '2026-07-10 02:52:32', '2026-07-10 02:52:32'),
(9, '1303036510900001', 'Helmi Susanti', 'JL. ST. SYAHRIR GG SWADAYA RT:2 RW:4', 850000.00, 4, '450 VA', 'Kontrak', 'Tidak Permanen', '2026-07-10 02:53:13', '2026-07-10 02:53:13'),
(10, '1375012807810003', 'Leonardo', 'JL.HAMKA NO.22 B RT:3 RW:6', 950000.00, 5, '450 VA', 'Kontrak', 'Semi Permanen', '2026-07-10 02:54:14', '2026-07-10 02:54:14'),
(11, '1375027007920002', 'Mutia Rani', 'JL. KUSUMA BAKTI RT:3 RW:2', 2400000.00, 2, '900 VA', 'Bebas Sewa', 'Permanen', '2026-07-10 02:54:52', '2026-07-10 02:54:52'),
(12, '1375025806900003', 'Risna Wahyuni', 'JANGKAK RT:1 RW:4', 1300000.00, 5, '450 VA', 'Kontrak', 'Semi Permanen', '2026-07-10 02:55:28', '2026-07-10 02:55:28'),
(13, '1375026803940003', 'Dewi Maharani', 'KOTO DALAM RT:2 RW:5', 2100000.00, 1, '900 VA', 'Bebas Sewa', 'Permanen', '2026-07-10 02:56:07', '2026-07-10 02:56:07'),
(14, '1375024202960002', 'Santi Rahmadhani', 'JL.H ABDUL MANAN RT:3 RW:1', 1400000.00, 3, '450 VA', 'Milik Sendiri', 'Semi Permanen', '2026-07-10 02:56:51', '2026-07-10 02:56:51'),
(15, '1375021904840001', 'Deki Yulfianto', 'JL. N. DJ. DT. MANGKUTO AMEH RT:1 RW:3', 2300000.00, 4, '900 VA', 'Milik Sendiri', 'Permanen', '2026-07-10 02:57:30', '2026-07-10 02:57:30'),
(16, '0110', 'putri', 'gulaibancah', 1000000.00, 5, '450 VA', 'Milik Sendiri', 'Permanen', '2026-07-13 01:30:57', '2026-07-13 01:30:57'),
(17, '111', 'alya', 'gadut', 2000000.00, 6, '900 VA', 'Bebas Sewa', 'Semi Permanen', '2026-07-13 02:26:29', '2026-07-13 02:26:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_centroid`
--

CREATE TABLE `tbl_centroid` (
  `id_centroid` int(11) NOT NULL,
  `iterasi` int(11) NOT NULL,
  `cluster` enum('C1','C2') NOT NULL,
  `id_calon` int(11) DEFAULT NULL,
  `x1` decimal(10,4) DEFAULT NULL,
  `x2` decimal(10,4) DEFAULT NULL,
  `x3` decimal(10,4) DEFAULT NULL,
  `x4` decimal(10,4) DEFAULT NULL,
  `x5` decimal(10,4) DEFAULT NULL,
  `jarak_c1` decimal(12,6) DEFAULT NULL,
  `jarak_c2` decimal(12,6) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_centroid`
--

INSERT INTO `tbl_centroid` (`id_centroid`, `iterasi`, `cluster`, `id_calon`, `x1`, `x2`, `x3`, `x4`, `x5`, `jarak_c1`, `jarak_c2`, `created_at`) VALUES
(57, 1, 'C1', NULL, 0.0000, 1.0000, 0.0000, 0.5000, 0.0000, NULL, NULL, '2026-07-13 02:33:17'),
(58, 1, 'C2', NULL, 1.0000, 0.4000, 1.0000, 0.5000, 1.0000, NULL, NULL, '2026-07-13 02:33:17'),
(59, 2, 'C1', NULL, 0.1470, 0.5800, 0.0000, 0.6000, 0.4000, NULL, NULL, '2026-07-13 02:33:42'),
(60, 2, 'C2', NULL, 0.8319, 0.4571, 1.0000, 0.3571, 0.9286, NULL, NULL, '2026-07-13 02:33:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hasil_konversi`
--

CREATE TABLE `tbl_hasil_konversi` (
  `id_konversi_hasil` int(11) NOT NULL,
  `id_calon` int(11) DEFAULT NULL,
  `x1` decimal(12,2) DEFAULT NULL,
  `x2` int(11) DEFAULT NULL,
  `x3` int(11) DEFAULT NULL,
  `x4` int(11) DEFAULT NULL,
  `x5` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_hasil_konversi`
--

INSERT INTO `tbl_hasil_konversi` (`id_konversi_hasil`, `id_calon`, `x1`, `x2`, `x3`, `x4`, `x5`, `created_at`) VALUES
(58, 1, 800000.00, 6, 1, 2, 1, '2026-07-13 02:26:40'),
(59, 2, 1200000.00, 3, 1, 1, 2, '2026-07-13 02:26:40'),
(60, 3, 900000.00, 4, 1, 3, 1, '2026-07-13 02:26:40'),
(61, 4, 2000000.00, 3, 2, 2, 3, '2026-07-13 02:26:40'),
(62, 5, 2500000.00, 5, 2, 2, 3, '2026-07-13 02:26:40'),
(63, 6, 1000000.00, 1, 1, 1, 2, '2026-07-13 02:26:40'),
(64, 7, 2200000.00, 2, 2, 2, 3, '2026-07-13 02:26:40'),
(65, 8, 1100000.00, 3, 1, 3, 2, '2026-07-13 02:26:40'),
(66, 9, 850000.00, 4, 1, 2, 1, '2026-07-13 02:26:40'),
(67, 10, 950000.00, 5, 1, 2, 2, '2026-07-13 02:26:40'),
(68, 11, 2400000.00, 2, 2, 1, 3, '2026-07-13 02:26:40'),
(69, 12, 1300000.00, 5, 1, 2, 2, '2026-07-13 02:26:40'),
(70, 13, 2100000.00, 1, 2, 1, 3, '2026-07-13 02:26:40'),
(71, 14, 1400000.00, 3, 1, 3, 2, '2026-07-13 02:26:40'),
(72, 15, 2300000.00, 4, 2, 3, 3, '2026-07-13 02:26:40'),
(73, 16, 1000000.00, 5, 1, 3, 3, '2026-07-13 02:26:40'),
(74, 17, 2000000.00, 6, 2, 1, 2, '2026-07-13 02:26:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_konversi`
--

CREATE TABLE `tbl_konversi` (
  `id_konversi` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `nilai_asli` varchar(100) NOT NULL,
  `nilai_konversi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_konversi`
--

INSERT INTO `tbl_konversi` (`id_konversi`, `kategori`, `nilai_asli`, `nilai_konversi`) VALUES
(1, 'Daya Listrik', '450 VA', 1),
(2, 'Daya Listrik', '900 VA', 2),
(3, 'Status Rumah', 'Bebas Sewa', 1),
(4, 'Status Rumah', 'Kontrak', 2),
(5, 'Status Rumah', 'Milik Sendiri', 3),
(6, 'Kondisi Rumah', 'Tidak Permanen', 1),
(7, 'Kondisi Rumah', 'Semi Permanen', 2),
(8, 'Kondisi Rumah', 'Permanen', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_laporan_hasil`
--

CREATE TABLE `tbl_laporan_hasil` (
  `id_laporan` int(11) NOT NULL,
  `id_calon` int(11) NOT NULL,
  `id_perhitungan` int(11) NOT NULL,
  `cluster` enum('C1','C2') DEFAULT NULL,
  `jarak_c1` decimal(10,4) DEFAULT NULL,
  `jarak_c2` decimal(10,4) DEFAULT NULL,
  `status_kelayakan` enum('Layak','Tidak Layak') DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_laporan_hasil`
--

INSERT INTO `tbl_laporan_hasil` (`id_laporan`, `id_calon`, `id_perhitungan`, `cluster`, `jarak_c1`, `jarak_c2`, `status_kelayakan`, `tanggal`) VALUES
(88, 1, 172, 'C1', 0.0000, 1.8330, 'Layak', '2026-07-13 09:33:52'),
(89, 2, 173, 'C1', 0.9567, 1.4439, 'Layak', '2026-07-13 09:33:52'),
(90, 3, 174, 'C1', 0.6430, 1.7821, 'Layak', '2026-07-13 09:33:52'),
(91, 4, 175, 'C2', 1.6906, 0.2941, 'Tidak Layak', '2026-07-13 09:33:52'),
(92, 5, 176, 'C2', 1.7436, 0.4000, 'Tidak Layak', '2026-07-13 09:33:52'),
(93, 6, 177, 'C1', 1.2304, 1.5616, 'Layak', '2026-07-13 09:33:52'),
(94, 7, 178, 'C2', 1.8216, 0.2667, 'Tidak Layak', '2026-07-13 09:33:52'),
(95, 8, 179, 'C1', 0.9440, 1.4759, 'Layak', '2026-07-13 09:33:53'),
(96, 9, 180, 'C1', 0.4011, 1.7269, 'Layak', '2026-07-13 09:33:53'),
(97, 10, 181, 'C1', 0.5457, 1.4971, 'Layak', '2026-07-13 09:33:53'),
(98, 11, 182, 'C2', 1.9432, 0.5417, 'Tidak Layak', '2026-07-13 09:33:53'),
(99, 12, 183, 'C1', 0.6136, 1.3814, 'Layak', '2026-07-13 09:33:53'),
(100, 13, 184, 'C2', 1.9583, 0.6822, 'Tidak Layak', '2026-07-13 09:33:53'),
(101, 14, 185, 'C1', 0.9922, 1.3852, 'Layak', '2026-07-13 09:33:53'),
(102, 15, 186, 'C2', 1.7857, 0.5512, 'Tidak Layak', '2026-07-13 09:33:53'),
(103, 16, 187, 'C1', 1.1419, 1.4794, 'Layak', '2026-07-13 09:33:53'),
(104, 17, 188, 'C2', 1.4136, 0.9729, 'Tidak Layak', '2026-07-13 09:33:53'),
(105, 1, 189, 'C1', 0.6066, 1.6940, 'Layak', '2026-07-13 09:33:53'),
(106, 2, 190, 'C1', 0.6405, 1.2925, 'Layak', '2026-07-13 09:33:53'),
(107, 3, 191, 'C1', 0.5729, 1.7011, 'Layak', '2026-07-13 09:33:53'),
(108, 4, 192, 'C2', 1.3095, 0.2113, 'Tidak Layak', '2026-07-13 09:33:53'),
(109, 5, 193, 'C2', 1.4649, 0.4139, 'Tidak Layak', '2026-07-13 09:33:53'),
(110, 6, 194, 'C1', 0.8410, 1.4250, 'Layak', '2026-07-13 09:33:53'),
(111, 7, 195, 'C2', 1.4043, 0.3028, 'Tidak Layak', '2026-07-13 09:33:53'),
(112, 8, 196, 'C1', 0.4509, 1.4247, 'Layak', '2026-07-13 09:33:53'),
(113, 9, 197, 'C1', 0.4292, 1.5960, 'Layak', '2026-07-13 09:33:53'),
(114, 10, 198, 'C1', 0.2681, 1.3692, 'Layak', '2026-07-13 09:33:53'),
(115, 11, 199, 'C2', 1.5796, 0.4590, 'Tidak Layak', '2026-07-13 09:33:53'),
(116, 12, 200, 'C1', 0.3000, 1.2692, 'Layak', '2026-07-13 09:33:53'),
(117, 13, 201, 'C2', 1.5614, 0.5883, 'Tidak Layak', '2026-07-13 09:33:53'),
(118, 14, 202, 'C1', 0.4948, 1.3527, 'Layak', '2026-07-13 09:33:53'),
(119, 15, 203, 'C2', 1.4357, 0.6643, 'Tidak Layak', '2026-07-13 09:33:53'),
(120, 16, 204, 'C1', 0.7545, 1.4305, 'Layak', '2026-07-13 09:33:53'),
(121, 17, 205, 'C2', 1.3634, 0.7885, 'Tidak Layak', '2026-07-13 09:33:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_normalisasi`
--

CREATE TABLE `tbl_normalisasi` (
  `id_normalisasi` int(11) NOT NULL,
  `id_calon` int(11) NOT NULL,
  `n1` decimal(10,4) DEFAULT NULL,
  `n2` decimal(10,4) DEFAULT NULL,
  `n3` decimal(10,4) DEFAULT NULL,
  `n4` decimal(10,4) DEFAULT NULL,
  `n5` decimal(10,4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_normalisasi`
--

INSERT INTO `tbl_normalisasi` (`id_normalisasi`, `id_calon`, `n1`, `n2`, `n3`, `n4`, `n5`, `created_at`) VALUES
(58, 1, 0.0000, 1.0000, 0.0000, 0.5000, 0.0000, '2026-07-13 02:26:48'),
(59, 2, 0.2353, 0.4000, 0.0000, 0.0000, 0.5000, '2026-07-13 02:26:48'),
(60, 3, 0.0588, 0.6000, 0.0000, 1.0000, 0.0000, '2026-07-13 02:26:48'),
(61, 4, 0.7059, 0.4000, 1.0000, 0.5000, 1.0000, '2026-07-13 02:26:48'),
(62, 5, 1.0000, 0.8000, 1.0000, 0.5000, 1.0000, '2026-07-13 02:26:48'),
(63, 6, 0.1176, 0.0000, 0.0000, 0.0000, 0.5000, '2026-07-13 02:26:48'),
(64, 7, 0.8235, 0.2000, 1.0000, 0.5000, 1.0000, '2026-07-13 02:26:48'),
(65, 8, 0.1765, 0.4000, 0.0000, 1.0000, 0.5000, '2026-07-13 02:26:48'),
(66, 9, 0.0294, 0.6000, 0.0000, 0.5000, 0.0000, '2026-07-13 02:26:48'),
(67, 10, 0.0882, 0.8000, 0.0000, 0.5000, 0.5000, '2026-07-13 02:26:48'),
(68, 11, 0.9412, 0.2000, 1.0000, 0.0000, 1.0000, '2026-07-13 02:26:48'),
(69, 12, 0.2941, 0.8000, 0.0000, 0.5000, 0.5000, '2026-07-13 02:26:48'),
(70, 13, 0.7647, 0.0000, 1.0000, 0.0000, 1.0000, '2026-07-13 02:26:48'),
(71, 14, 0.3529, 0.4000, 0.0000, 1.0000, 0.5000, '2026-07-13 02:26:48'),
(72, 15, 0.8824, 0.6000, 1.0000, 1.0000, 1.0000, '2026-07-13 02:26:48'),
(73, 16, 0.1176, 0.8000, 0.0000, 1.0000, 1.0000, '2026-07-13 02:26:48'),
(74, 17, 0.7059, 1.0000, 1.0000, 0.0000, 0.5000, '2026-07-13 02:26:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_perhitungan_kmeans`
--

CREATE TABLE `tbl_perhitungan_kmeans` (
  `id_perhitungan` int(11) NOT NULL,
  `id_calon` int(11) NOT NULL,
  `iterasi` int(11) NOT NULL,
  `jarak_c1` decimal(10,4) DEFAULT NULL,
  `jarak_c2` decimal(10,4) DEFAULT NULL,
  `cluster` enum('C1','C2') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_perhitungan_kmeans`
--

INSERT INTO `tbl_perhitungan_kmeans` (`id_perhitungan`, `id_calon`, `iterasi`, `jarak_c1`, `jarak_c2`, `cluster`, `created_at`) VALUES
(172, 1, 1, 0.0000, 1.8330, 'C1', '2026-07-13 02:33:17'),
(173, 2, 1, 0.9567, 1.4439, 'C1', '2026-07-13 02:33:18'),
(174, 3, 1, 0.6430, 1.7821, 'C1', '2026-07-13 02:33:19'),
(175, 4, 1, 1.6906, 0.2941, 'C2', '2026-07-13 02:33:19'),
(176, 5, 1, 1.7436, 0.4000, 'C2', '2026-07-13 02:33:19'),
(177, 6, 1, 1.2304, 1.5616, 'C1', '2026-07-13 02:33:19'),
(178, 7, 1, 1.8216, 0.2667, 'C2', '2026-07-13 02:33:19'),
(179, 8, 1, 0.9440, 1.4759, 'C1', '2026-07-13 02:33:20'),
(180, 9, 1, 0.4011, 1.7269, 'C1', '2026-07-13 02:33:20'),
(181, 10, 1, 0.5457, 1.4971, 'C1', '2026-07-13 02:33:20'),
(182, 11, 1, 1.9432, 0.5417, 'C2', '2026-07-13 02:33:20'),
(183, 12, 1, 0.6136, 1.3814, 'C1', '2026-07-13 02:33:20'),
(184, 13, 1, 1.9583, 0.6822, 'C2', '2026-07-13 02:33:21'),
(185, 14, 1, 0.9922, 1.3852, 'C1', '2026-07-13 02:33:21'),
(186, 15, 1, 1.7857, 0.5512, 'C2', '2026-07-13 02:33:21'),
(187, 16, 1, 1.1419, 1.4794, 'C1', '2026-07-13 02:33:22'),
(188, 17, 1, 1.4136, 0.9729, 'C2', '2026-07-13 02:33:22'),
(189, 1, 2, 0.6066, 1.6940, 'C1', '2026-07-13 02:33:42'),
(190, 2, 2, 0.6405, 1.2925, 'C1', '2026-07-13 02:33:42'),
(191, 3, 2, 0.5729, 1.7011, 'C1', '2026-07-13 02:33:42'),
(192, 4, 2, 1.3095, 0.2113, 'C2', '2026-07-13 02:33:42'),
(193, 5, 2, 1.4649, 0.4139, 'C2', '2026-07-13 02:33:42'),
(194, 6, 2, 0.8410, 1.4250, 'C1', '2026-07-13 02:33:43'),
(195, 7, 2, 1.4043, 0.3028, 'C2', '2026-07-13 02:33:43'),
(196, 8, 2, 0.4509, 1.4247, 'C1', '2026-07-13 02:33:43'),
(197, 9, 2, 0.4292, 1.5960, 'C1', '2026-07-13 02:33:43'),
(198, 10, 2, 0.2681, 1.3692, 'C1', '2026-07-13 02:33:43'),
(199, 11, 2, 1.5796, 0.4590, 'C2', '2026-07-13 02:33:43'),
(200, 12, 2, 0.3000, 1.2692, 'C1', '2026-07-13 02:33:43'),
(201, 13, 2, 1.5614, 0.5883, 'C2', '2026-07-13 02:33:43'),
(202, 14, 2, 0.4948, 1.3527, 'C1', '2026-07-13 02:33:43'),
(203, 15, 2, 1.4357, 0.6643, 'C2', '2026-07-13 02:33:43'),
(204, 16, 2, 0.7545, 1.4305, 'C1', '2026-07-13 02:33:43'),
(205, 17, 2, 1.3634, 0.7885, 'C2', '2026-07-13 02:33:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tbl_calon_penerima`
--
ALTER TABLE `tbl_calon_penerima`
  ADD PRIMARY KEY (`id_calon`);

--
-- Indexes for table `tbl_centroid`
--
ALTER TABLE `tbl_centroid`
  ADD PRIMARY KEY (`id_centroid`);

--
-- Indexes for table `tbl_hasil_konversi`
--
ALTER TABLE `tbl_hasil_konversi`
  ADD PRIMARY KEY (`id_konversi_hasil`),
  ADD KEY `id_calon` (`id_calon`);

--
-- Indexes for table `tbl_konversi`
--
ALTER TABLE `tbl_konversi`
  ADD PRIMARY KEY (`id_konversi`);

--
-- Indexes for table `tbl_laporan_hasil`
--
ALTER TABLE `tbl_laporan_hasil`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `id_calon` (`id_calon`),
  ADD KEY `tbl_laporan_hasil_ibfk_2` (`id_perhitungan`);

--
-- Indexes for table `tbl_normalisasi`
--
ALTER TABLE `tbl_normalisasi`
  ADD PRIMARY KEY (`id_normalisasi`),
  ADD KEY `id_calon` (`id_calon`);

--
-- Indexes for table `tbl_perhitungan_kmeans`
--
ALTER TABLE `tbl_perhitungan_kmeans`
  ADD PRIMARY KEY (`id_perhitungan`),
  ADD KEY `fk_perhitungan` (`id_calon`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_calon_penerima`
--
ALTER TABLE `tbl_calon_penerima`
  MODIFY `id_calon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_centroid`
--
ALTER TABLE `tbl_centroid`
  MODIFY `id_centroid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `tbl_hasil_konversi`
--
ALTER TABLE `tbl_hasil_konversi`
  MODIFY `id_konversi_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `tbl_konversi`
--
ALTER TABLE `tbl_konversi`
  MODIFY `id_konversi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_laporan_hasil`
--
ALTER TABLE `tbl_laporan_hasil`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `tbl_normalisasi`
--
ALTER TABLE `tbl_normalisasi`
  MODIFY `id_normalisasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `tbl_perhitungan_kmeans`
--
ALTER TABLE `tbl_perhitungan_kmeans`
  MODIFY `id_perhitungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_hasil_konversi`
--
ALTER TABLE `tbl_hasil_konversi`
  ADD CONSTRAINT `tbl_hasil_konversi_ibfk_1` FOREIGN KEY (`id_calon`) REFERENCES `tbl_calon_penerima` (`id_calon`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_laporan_hasil`
--
ALTER TABLE `tbl_laporan_hasil`
  ADD CONSTRAINT `tbl_laporan_hasil_ibfk_1` FOREIGN KEY (`id_calon`) REFERENCES `tbl_calon_penerima` (`id_calon`),
  ADD CONSTRAINT `tbl_laporan_hasil_ibfk_2` FOREIGN KEY (`id_perhitungan`) REFERENCES `tbl_perhitungan_kmeans` (`id_perhitungan`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_normalisasi`
--
ALTER TABLE `tbl_normalisasi`
  ADD CONSTRAINT `tbl_normalisasi_ibfk_1` FOREIGN KEY (`id_calon`) REFERENCES `tbl_calon_penerima` (`id_calon`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_perhitungan_kmeans`
--
ALTER TABLE `tbl_perhitungan_kmeans`
  ADD CONSTRAINT `fk_perhitungan` FOREIGN KEY (`id_calon`) REFERENCES `tbl_calon_penerima` (`id_calon`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

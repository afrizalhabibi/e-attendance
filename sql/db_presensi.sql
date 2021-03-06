-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2022 at 07:32 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_presensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `abs_id` char(12) NOT NULL,
  `pgw_id` int(50) NOT NULL,
  `act_id` char(12) DEFAULT NULL,
  `abs_datang` time DEFAULT '00:00:00',
  `abs_pulang` time DEFAULT '00:00:00',
  `abs_tgl` date NOT NULL DEFAULT current_timestamp(),
  `abs_hari` varchar(10) DEFAULT NULL,
  `abs_status` enum('Bekerja','WFH','Sakit','Tanpa Keterangan','Hari Libur','Dinas Luar','Cuti') DEFAULT NULL,
  `abs_terlambat` varchar(255) NOT NULL DEFAULT 'Tidak mengisi presensi datang',
  `abs_jamkerja` time GENERATED ALWAYS AS (case when `abs_hari` = 'Jum\'at' then timediff(`abs_pulang`,`abs_datang`) - 13000 when `abs_hari` <> 'Jum\'at' then timediff(`abs_pulang`,`abs_datang`) - 10000 end) STORED,
  `abs_long` varchar(50) DEFAULT NULL,
  `abs_lat` varchar(50) DEFAULT NULL,
  `abs_ket` varchar(255) DEFAULT NULL,
  `abs_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`abs_id`, `pgw_id`, `act_id`, `abs_datang`, `abs_pulang`, `abs_tgl`, `abs_hari`, `abs_status`, `abs_terlambat`, `abs_long`, `abs_lat`, `abs_ket`, `abs_img`) VALUES
('107', 211201238, NULL, '00:00:00', '00:00:00', '2022-04-14', 'Selasa', 'Sakit', 'Tidak Absen', '', '', '', ''),
('108', 211201248, NULL, '00:00:00', '14:47:50', '2022-04-14', 'Selasa', 'Bekerja', 'Terlambat', '', '', '', ''),
('109', 211201238, NULL, '11:00:22', '14:47:50', '2022-04-18', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('110', 211201248, NULL, '00:00:00', '14:47:50', '2022-04-18', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('14vyhphdkdte', 211201248, NULL, '00:00:00', '16:30:55', '2022-07-07', 'Kamis', 'Bekerja', 'Terlambat 3 Jam 26 menit', '114.7666395', '-3.7533148', '', ''),
('16iwcnx39sfn', 211201238, '2noi9bry9bmx', '10:50:05', '00:00:00', '2022-06-30', 'Kamis', 'Bekerja', 'Terlambat 2 Jam 50 menit', '114.7666395', '-3.7533148', '', ''),
('176', 211201238, NULL, '00:00:00', '00:00:00', '2022-04-19', 'Selasa', 'Tanpa Keterangan', 'Tidak Absen', '', '', '', ''),
('177', 211201246, NULL, '00:00:00', '14:47:50', '2022-04-19', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('178', 211201248, NULL, '00:00:00', '14:47:50', '2022-04-19', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('179', 211201238, NULL, '00:00:00', '14:47:50', '2022-04-20', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('180', 211201246, NULL, '00:00:00', '14:47:50', '2022-04-20', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('181', 211201248, NULL, '00:00:00', '14:47:50', '2022-04-20', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('184smymmh9rj', 211201246, NULL, '00:00:00', '00:00:00', '2022-07-06', 'Rabu', 'Tanpa Keterangan', 'Tidak mengisi presensi datang', NULL, NULL, '', ''),
('194', 211201238, NULL, '00:00:00', '14:47:50', '2022-04-21', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('195', 211201246, NULL, '00:00:00', '14:47:50', '2022-04-21', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('196', 211201248, NULL, '00:00:00', '14:47:50', '2022-04-21', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('197', 211201238, NULL, '08:01:43', '14:47:50', '2022-04-25', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('198', 211201246, NULL, '00:00:00', '14:47:50', '2022-04-25', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('199', 211201248, NULL, '09:28:21', '14:47:50', '2022-04-25', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('1b7tai4elu3z', 211201248, NULL, '00:00:00', '00:00:00', '2022-07-06', 'Rabu', 'Tanpa Keterangan', 'Tidak mengisi presensi datang', NULL, NULL, '', ''),
('1c5ucalr0shf', 211201246, NULL, '00:00:00', '00:00:00', '2022-06-30', 'Kamis', 'Tanpa Keterangan', 'Tidak mengisi presensi datang', NULL, NULL, '', ''),
('1on6lk6q8l6b', 211201248, '64cjainzq9ca', '10:53:39', '15:28:40', '2022-06-30', 'Kamis', 'Bekerja', 'Terlambat 2 Jam 53 menit', '114.7666395', '-3.7533148', '', ''),
('1txjzceqe0', 211201248, NULL, '00:00:00', '00:00:00', '2022-07-10', 'Minggu', 'Hari Libur', 'Hari Libur', NULL, NULL, NULL, NULL),
('221', 211201238, NULL, '00:00:00', '14:47:50', '2022-04-26', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('222', 211201246, NULL, '00:00:00', '14:47:50', '2022-04-26', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('223', 211201248, NULL, '00:00:00', '14:47:50', '2022-04-26', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('248', 211201238, NULL, '08:12:00', '14:47:50', '2022-04-27', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('249', 211201246, NULL, '00:00:00', '14:47:50', '2022-04-27', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('250', 211201248, NULL, '00:00:00', '14:47:50', '2022-04-27', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('254', 211201238, NULL, '11:21:48', '14:47:50', '2022-04-28', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('255', 211201246, NULL, '00:00:00', '14:47:50', '2022-04-28', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('256', 211201248, NULL, '00:00:00', '14:47:50', '2022-04-28', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('257', 211201238, NULL, '11:32:17', '00:00:00', '2022-05-13', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('258', 211201246, NULL, '00:00:00', '14:47:50', '2022-05-13', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('259', 211201248, NULL, '00:00:00', '14:47:50', '2022-05-13', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('260', 211201238, NULL, '09:33:33', '14:59:54', '2022-05-17', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('261', 211201246, NULL, '00:00:00', '14:47:50', '2022-05-17', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('262', 211201248, NULL, '00:00:00', '14:57:15', '2022-05-17', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('263', 211201238, NULL, '08:27:41', '16:25:05', '2022-05-18', 'Rabu', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('264', 211201246, NULL, '00:00:00', '00:00:00', '2022-05-18', 'Rabu', 'Tanpa Keterangan', 'Tidak Absen', '', '', '', ''),
('265', 211201248, NULL, '00:00:00', '16:24:38', '2022-05-18', 'Rabu', 'WFH', 'Tidak Absen', '', '', '', ''),
('266', 211201238, NULL, '11:29:40', '16:26:17', '2022-05-19', 'Kamis', 'WFH', 'Tidak Absen', '', '', '', ''),
('267', 211201246, NULL, '00:00:00', '00:00:00', '2022-05-19', 'Kamis', 'Tanpa Keterangan', 'Tidak Absen', '', '', '', ''),
('268', 211201248, NULL, '00:00:00', '00:00:00', '2022-05-19', 'Kamis', 'Tanpa Keterangan', 'Tidak Absen', '', '', '', ''),
('269', 211201238, NULL, '09:47:21', '17:01:23', '2022-05-20', 'Jumat', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('270', 211201246, NULL, '00:00:00', '00:00:00', '2022-05-20', 'Jumat', 'Tanpa Keterangan', 'Tidak Absen', '', '', '', ''),
('271', 211201248, NULL, '09:57:21', '00:00:00', '2022-05-20', 'Jumat', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('272', 211201238, NULL, '00:00:00', '00:00:00', '2022-05-21', 'Sabtu', 'Hari Libur', 'Tidak Absen', '', '', '', ''),
('273', 211201246, NULL, '00:00:00', '00:00:00', '2022-05-21', 'Sabtu', 'Hari Libur', 'Tidak Absen', '', '', '', ''),
('274', 211201248, NULL, '00:00:00', '00:00:00', '2022-05-21', 'Sabtu', 'Hari Libur', 'Tidak Absen', '', '', '', ''),
('275', 211201238, NULL, '00:00:00', '00:00:00', '2022-05-23', 'Senin', 'Tanpa Keterangan', 'Tidak Absen', '', '', '', ''),
('276', 211201246, NULL, '00:00:00', '00:00:00', '2022-05-23', 'Senin', 'Tanpa Keterangan', 'Tidak Absen', '', '', '', ''),
('277', 211201248, NULL, '00:00:00', '00:00:00', '2022-05-23', 'Senin', 'Tanpa Keterangan', 'Tidak Absen', '', '', '', ''),
('278', 211201238, NULL, '11:46:44', '00:00:00', '2022-05-25', 'Rabu', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('279', 211201246, NULL, '00:00:00', '00:00:00', '2022-05-25', 'Rabu', 'Tanpa Keterangan', 'Tidak Absen', '', '', '', ''),
('280', 211201248, NULL, '00:00:00', '00:00:00', '2022-05-25', 'Rabu', 'Tanpa Keterangan', 'Tidak Absen', '', '', '', ''),
('281', 211201238, NULL, '10:51:57', '00:00:00', '2022-05-31', 'Selasa', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('282', 211201246, NULL, '00:00:00', '00:00:00', '2022-05-31', 'Selasa', 'Tanpa Keterangan', 'Tidak Absen', '', '', '', ''),
('283', 211201248, NULL, '00:00:00', '00:00:00', '2022-05-31', 'Selasa', 'Tanpa Keterangan', 'Tidak Absen', '', '', '', ''),
('284', 211201238, NULL, '08:00:00', '16:00:00', '2022-06-01', 'Rabu', 'Tanpa Keterangan', 'Tidak Absen', '', '', '', ''),
('285', 211201246, NULL, '00:00:00', '00:00:00', '2022-06-01', 'Rabu', 'Tanpa Keterangan', 'Tidak Absen', '', '', '', ''),
('286', 211201248, NULL, '00:00:00', '00:00:00', '2022-06-01', 'Rabu', 'Tanpa Keterangan', 'Tidak Absen', '', '', '', ''),
('287', 211201238, NULL, '08:32:06', '16:25:13', '2022-06-02', 'Kamis', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('288', 211201246, NULL, '00:00:00', '00:00:00', '2022-06-02', 'Kamis', 'Tanpa Keterangan', 'Tidak Absen', '', '', '', ''),
('289', 211201248, NULL, '00:00:00', '00:00:00', '2022-06-02', 'Kamis', 'Tanpa Keterangan', 'Tidak Absen', '', '', '', ''),
('290', 211201238, NULL, '09:42:32', '00:00:00', '2022-06-03', 'Jumat', 'Bekerja', 'Tidak Absen', '', '', '', ''),
('291', 211201246, NULL, '00:00:00', '00:00:00', '2022-06-03', 'Jumat', 'Tanpa Keterangan', 'Tidak Absen', '', '', '', ''),
('292', 211201248, NULL, '00:00:00', '00:00:00', '2022-06-03', 'Jumat', 'Tanpa Keterangan', 'Tidak Absen', '', '', '', ''),
('293', 211201238, NULL, '00:00:00', '00:00:00', '2022-06-04', 'Sabtu', 'Hari Libur', 'Tidak Absen', '', '', '', ''),
('294', 211201246, NULL, '00:00:00', '00:00:00', '2022-06-04', 'Sabtu', 'Hari Libur', 'Tidak Absen', '', '', '', ''),
('295', 211201248, NULL, '00:00:00', '00:00:00', '2022-06-04', 'Sabtu', 'Hari Libur', 'Tidak Absen', '', '', '', ''),
('299', 211201238, NULL, '10:38:19', '16:41:19', '2022-06-06', 'Senin', 'Bekerja', 'Tidak Absen', '114.7666395', '-3.7533148', '', ''),
('2hbco369pkwk', 211201248, NULL, '00:00:00', '16:57:00', '2022-07-08', 'Jumat', 'Bekerja', 'Tidak mengisi presensi datang', NULL, NULL, '', NULL),
('2kq1qu6l14p', 211201238, '6tbdtziva90w', '09:03:40', '16:47:00', '2022-07-01', 'Jumat', 'Bekerja', 'Terlambat 1 Jam 3 menit', '114.7666395', '-3.7533148', '', ''),
('2ky5gciz77pv', 211201238, '4486emkb5igc', '08:19:06', '00:00:00', '2022-07-12', 'Selasa', 'Bekerja', 'Terlambat 0 Jam 19 menit', '114.7666395', '-3.7533148', NULL, '/assets/presensi/images/211201238h5qrk2rq4u3.jpg'),
('2zuowgcf9tqr', 211201246, NULL, '00:00:00', '00:00:00', '2022-07-12', 'Selasa', 'Tanpa Keterangan', 'Tidak mengisi presensi datang', NULL, NULL, NULL, NULL),
('300', 211201246, NULL, '00:00:00', '00:00:00', '2022-06-06', 'Senin', 'Tanpa Keterangan', 'Tidak Absen', '', '', '', ''),
('301', 211201248, NULL, '00:00:00', '00:00:00', '2022-06-06', 'Senin', 'Tanpa Keterangan', 'Tidak Absen', '', '', '', ''),
('311', 211201238, NULL, '09:00:16', '00:00:00', '2022-06-07', 'Selasa', 'Bekerja', 'Tidak Absen', '114.7666395', '-3.7533148', '', ''),
('312', 211201246, NULL, '00:00:00', '00:00:00', '2022-06-07', 'Selasa', 'Tanpa Keterangan', 'Tidak Absen', NULL, NULL, '', ''),
('313', 211201248, NULL, '00:00:00', '00:00:00', '2022-06-07', 'Selasa', 'Tanpa Keterangan', 'Tidak Absen', NULL, NULL, '', ''),
('314', 211201238, NULL, '08:37:24', '17:08:36', '2022-06-08', 'Rabu', 'Bekerja', 'Tidak Absen', '114.7666395', '-3.7533148', '', ''),
('315', 211201246, NULL, '00:00:00', '00:00:00', '2022-06-08', 'Rabu', 'Tanpa Keterangan', 'Tidak Absen', NULL, NULL, '', ''),
('316', 211201248, NULL, '00:00:00', '00:00:00', '2022-06-08', 'Rabu', 'Tanpa Keterangan', 'Tidak Absen', NULL, NULL, '', ''),
('320', 211201238, NULL, '08:50:40', '00:00:00', '2022-06-09', 'Kamis', 'Bekerja', 'Tidak Absen', '114.7666395', '-3.7533148', '', ''),
('321', 211201246, NULL, '00:00:00', '00:00:00', '2022-06-09', 'Kamis', 'Tanpa Keterangan', 'Tidak Absen', NULL, NULL, '', ''),
('322', 211201248, NULL, '00:00:00', '00:00:00', '2022-06-09', 'Kamis', 'Tanpa Keterangan', 'Tidak Absen', NULL, NULL, '', ''),
('326', 211201238, NULL, '10:41:31', '00:00:00', '2022-06-13', 'Senin', 'Bekerja', 'Tidak Absen', '114.7666395', '-3.7533148', '', ''),
('327', 211201246, NULL, '00:00:00', '00:00:00', '2022-06-13', 'Senin', 'Tanpa Keterangan', 'Tidak Absen', NULL, NULL, '', ''),
('328', 211201248, NULL, '00:00:00', '00:00:00', '2022-06-13', 'Senin', 'Tanpa Keterangan', 'Tidak Absen', NULL, NULL, '', ''),
('32xwzz3t71sj', 211201248, '75d001fodwaq', '14:45:09', '00:00:00', '2022-07-12', 'Selasa', 'Bekerja', 'Tepat Waktu', '114.7666395', '-3.7533148', NULL, '/assets/presensi/images/21120124874t14v3hslfa.jpg'),
('335', 211201238, NULL, '09:00:09', '00:00:00', '2022-06-15', 'Rabu', 'Bekerja', 'Tidak Absen', '114.7666395', '-3.7533148', 'Menghadiri acara peresmian', ''),
('336', 211201246, NULL, '00:00:00', '00:00:00', '2022-06-15', 'Rabu', 'Tanpa Keterangan', 'Tidak Absen', NULL, NULL, '', ''),
('337', 211201248, NULL, '00:00:00', '00:00:00', '2022-06-15', 'Rabu', 'Tanpa Keterangan', 'Tidak Absen', NULL, NULL, '', ''),
('338', 211201238, NULL, '00:00:00', '14:14:20', '2022-06-16', 'Kamis', 'Bekerja', 'Tidak Absen', NULL, NULL, '', ''),
('339', 211201246, NULL, '00:00:00', '00:00:00', '2022-06-16', 'Kamis', 'Tanpa Keterangan', 'Tidak Absen', NULL, NULL, '', ''),
('33f3wkfkyv34', 211201238, NULL, '09:25:10', '00:00:00', '2022-07-15', 'Jumat', 'Bekerja', 'Terlambat 1 Jam 25 menit', '114.7666395', '-3.7533148', NULL, '/assets/presensi/images/21120123873068l2l8jjr.jpg'),
('340', 211201248, NULL, '00:00:00', '00:00:00', '2022-06-16', 'Kamis', 'Tanpa Keterangan', 'Tidak Absen', NULL, NULL, '', ''),
('344', 211201238, NULL, '00:00:00', '16:55:51', '2022-06-20', 'Senin', 'Bekerja', 'Tidak Absen', NULL, NULL, '', ''),
('345', 211201246, NULL, '00:00:00', '00:00:00', '2022-06-20', 'Senin', 'Tanpa Keterangan', 'Tidak Absen', NULL, NULL, '', ''),
('346', 211201248, NULL, '00:00:00', '00:00:00', '2022-06-20', 'Senin', 'Tanpa Keterangan', 'Tidak Absen', NULL, NULL, '', ''),
('350', 211201238, NULL, '10:48:26', '00:00:00', '2022-06-21', 'Selasa', 'Bekerja', 'Tidak Absen', '114.7666395', '-3.7533148', '', ''),
('351', 211201246, NULL, '00:00:00', '00:00:00', '2022-06-21', 'Selasa', 'Tanpa Keterangan', 'Tidak Absen', NULL, NULL, '', ''),
('352', 211201248, NULL, '00:00:00', '00:00:00', '2022-06-21', 'Selasa', 'Tanpa Keterangan', 'Tidak Absen', NULL, NULL, '', ''),
('353', 211201238, NULL, '08:35:47', '16:10:04', '2022-06-22', 'Rabu', 'Bekerja', 'Terlambat 0 Jam 35 menit', '114.7666395', '-3.7533148', '', ''),
('363', 211201246, NULL, '00:00:00', '00:00:00', '2022-06-22', 'Rabu', 'Tanpa Keterangan', 'Tidak mengisi presensi datang', NULL, NULL, '', ''),
('364', 211201248, NULL, '09:23:40', '00:00:00', '2022-06-22', 'Rabu', 'Bekerja', 'Terlambat 1 Jam 23 menit', '114.7666395', '-3.7533148', '', ''),
('368', 211201238, NULL, '11:39:34', '16:39:43', '2022-06-23', 'Kamis', 'Bekerja', 'Terlambat 3 Jam 39 menit', '114.7666395', '-3.7533148', '', ''),
('369', 211201246, NULL, '00:00:00', '00:00:00', '2022-06-23', 'Kamis', 'Tanpa Keterangan', 'Tidak mengisi presensi datang', NULL, NULL, '', ''),
('370', 211201248, NULL, '00:00:00', '00:00:00', '2022-06-23', 'Kamis', 'Tanpa Keterangan', 'Tidak mengisi presensi datang', NULL, NULL, '', ''),
('374', 211201238, NULL, '08:33:36', '00:00:00', '2022-06-24', 'Jumat', 'Bekerja', 'Terlambat 0 Jam 33 menit', '114.7666395', '-3.7533148', '', ''),
('375', 211201246, NULL, '00:00:00', '00:00:00', '2022-06-24', 'Jumat', 'Tanpa Keterangan', 'Tidak mengisi presensi datang', NULL, NULL, '', ''),
('376', 211201248, NULL, '00:00:00', '00:00:00', '2022-06-24', 'Jumat', 'Tanpa Keterangan', 'Tidak mengisi presensi datang', NULL, NULL, '', ''),
('386', 211201238, NULL, '00:00:00', '00:00:00', '2022-06-26', 'Minggu', 'Hari Libur', 'Hari Libur', NULL, NULL, '', ''),
('387', 211201246, NULL, '00:00:00', '00:00:00', '2022-06-26', 'Minggu', 'Hari Libur', 'Hari Libur', NULL, NULL, '', ''),
('388', 211201248, NULL, '00:00:00', '00:00:00', '2022-06-26', 'Minggu', 'Hari Libur', 'Hari Libur', NULL, NULL, '', ''),
('392', 211201238, NULL, '07:45:01', '14:56:58', '2022-06-27', 'Senin', 'Bekerja', 'Tepat Waktu', '114.7666395', '-3.7533148', '', ''),
('393', 211201246, NULL, '00:00:00', '00:00:00', '2022-06-27', 'Senin', 'Tanpa Keterangan', 'Tidak mengisi presensi datang', NULL, NULL, '', ''),
('394', 211201248, NULL, '00:00:00', '00:00:00', '2022-06-27', 'Senin', 'Tanpa Keterangan', 'Tidak mengisi presensi datang', NULL, NULL, '', ''),
('398', 211201238, NULL, '08:29:35', '16:30:00', '2022-06-28', 'Selasa', 'Bekerja', 'Terlambat 0 Jam 29 menit', '114.7666395', '-3.7533148', '', ''),
('399', 211201246, NULL, '00:00:00', '00:00:00', '2022-06-28', 'Selasa', 'Tanpa Keterangan', 'Tidak mengisi presensi datang', NULL, NULL, '', ''),
('3ebzze69uwo0', 211201246, NULL, '00:00:00', '00:00:00', '2022-07-15', 'Jumat', 'Tanpa Keterangan', 'Tidak mengisi presensi datang', NULL, NULL, NULL, NULL),
('3hd7ex8gq31c', 211201248, NULL, '11:37:22', '00:00:00', '2022-07-15', 'Jumat', 'Bekerja', 'Terlambat 3 Jam 37 menit', '114.7666395', '-3.7533148', NULL, '/assets/presensi/images/21120124821zhnytoqgab.jpg'),
('400', 211201248, NULL, '00:00:00', '00:00:00', '2022-06-28', 'Selasa', 'Tanpa Keterangan', 'Tidak mengisi presensi datang', NULL, NULL, '', ''),
('401', 211201238, NULL, '08:28:35', '00:00:00', '2022-06-29', 'Rabu', 'Sakit', 'Terlambat 0 Jam 28 menit', '114.7666395', '-3.7533148', '', ''),
('402', 211201246, NULL, '00:00:00', '00:00:00', '2022-06-29', 'Rabu', 'Tanpa Keterangan', 'Tidak mengisi presensi datang', NULL, NULL, '', ''),
('403', 211201248, NULL, '00:00:00', '00:00:00', '2022-06-29', 'Rabu', 'Tanpa Keterangan', 'Tidak mengisi presensi datang', NULL, NULL, '', ''),
('4416qd2e936v', 211201238, NULL, '00:00:00', '00:00:00', '2022-07-02', 'Sabtu', 'Hari Libur', 'Tidak mengisi presensi datang', NULL, NULL, '', ''),
('49uhpk1yryp3', 211201246, NULL, '00:00:00', '00:00:00', '2022-07-02', 'Sabtu', 'Hari Libur', 'Tidak mengisi presensi datang', NULL, NULL, '', ''),
('4g0invncul47', 211201248, NULL, '00:00:00', '00:00:00', '2022-07-02', 'Sabtu', 'Hari Libur', 'Tidak mengisi presensi datang', NULL, NULL, '', ''),
('4krpi8fln2r', 211201238, '4w67pms6aa79', '07:59:43', '16:57:52', '2022-07-08', 'Jumat', 'Bekerja', 'Tepat Waktu', '114.7666395', '-3.7533148', '', '/assets/presensi/images/211201238668y5hsw3enr.jpg'),
('4pwfcmt78ht0', 211201238, '27g8c7i6hth3', '07:57:21', '00:00:00', '2022-07-11', 'Senin', 'Bekerja', 'Tepat Waktu', '114.7666395', '-3.7533148', NULL, '/assets/presensi/images/2112012384b8amd6djbs2.jpg'),
('4q43u5v3xb7v', 211201238, '3vf2opt397gx', '08:30:55', '00:00:00', '2022-07-05', 'Selasa', 'Bekerja', 'Terlambat 0 Jam 30 menit', '114.7666395', '-3.7533148', '', ''),
('4uxlylifhtlw', 211201246, NULL, '00:00:00', '00:00:00', '2022-07-11', 'Senin', 'Tanpa Keterangan', 'Tidak mengisi presensi datang', NULL, NULL, NULL, NULL),
('4y0sabayiias', 211201248, NULL, '00:00:00', '00:00:00', '2022-07-11', 'Senin', 'Tanpa Keterangan', 'Tidak mengisi presensi datang', NULL, NULL, NULL, NULL),
('4yl3k4f54i6j', 211201246, NULL, '00:00:00', '00:00:00', '2022-07-05', 'Selasa', 'Tanpa Keterangan', 'Tidak mengisi presensi datang', NULL, NULL, '', ''),
('51pldsyod79n', 211201248, NULL, '08:32:42', '00:00:00', '2022-07-05', 'Selasa', 'Bekerja', 'Terlambat 0 Jam 32 menit', '114.7666395', '-3.7533148', '', ''),
('5caydkqbj3gq', 211201238, 'wtdczuiqgxl', '08:59:26', '17:00:40', '2022-07-04', 'Senin', 'Bekerja', 'Terlambat 0 Jam 59 menit', '114.7666395', '-3.7533148', '', ''),
('5kwvoridjvza', 211201238, NULL, '00:00:00', '00:00:00', '2022-07-09', 'Sabtu', 'Hari Libur', 'Hari Libur', NULL, NULL, NULL, NULL),
('5li0qhoze9my', 211201246, NULL, '00:00:00', '00:00:00', '2022-07-04', 'Senin', 'Tanpa Keterangan', 'Tidak mengisi presensi datang', NULL, NULL, '', ''),
('5rogkrtl27gq', 211201248, NULL, '00:00:00', '00:00:00', '2022-07-04', 'Senin', 'Tanpa Keterangan', 'Tidak mengisi presensi datang', NULL, NULL, '', ''),
('5se5qt9p47ty', 211201246, NULL, '00:00:00', '00:00:00', '2022-07-09', 'Sabtu', 'Hari Libur', 'Hari Libur', NULL, NULL, NULL, NULL),
('5vhln2ov0luu', 211201248, NULL, '00:00:00', '00:00:00', '2022-07-09', 'Sabtu', 'Hari Libur', 'Hari Libur', NULL, NULL, NULL, NULL),
('6vznuepner79', 211201238, '5xh7clddqv6o', '08:06:20', '00:00:00', '2022-07-13', 'Rabu', 'Bekerja', 'Terlambat 0 Jam 6 menit', '114.7666395', '-3.7533148', NULL, '/assets/presensi/images/211201238sm9nort422m.jpg'),
('71mcm95ub95j', 211201238, NULL, '00:00:00', '00:00:00', '2022-07-10', 'Minggu', 'Hari Libur', 'Hari Libur', NULL, NULL, NULL, NULL),
('7cer23e8ruvr', 211201246, NULL, '00:00:00', '00:00:00', '2022-07-10', 'Minggu', 'Hari Libur', 'Hari Libur', NULL, NULL, NULL, NULL),
('7f11tkgi3x2t', 211201246, NULL, '00:00:00', '00:00:00', '2022-07-13', 'Rabu', 'Tanpa Keterangan', 'Tidak mengisi presensi datang', NULL, NULL, NULL, NULL),
('7i0ux1mbb0vp', 211201248, NULL, '00:00:00', '00:00:00', '2022-07-13', 'Rabu', 'Tanpa Keterangan', 'Tidak mengisi presensi datang', NULL, NULL, NULL, NULL),
('91gb7c75cs9', 211201246, NULL, '00:00:00', '00:00:00', '2022-07-01', 'Jumat', 'Tanpa Keterangan', 'Tidak mengisi presensi datang', NULL, NULL, '', ''),
('c66n5buq8e1', 211201248, '1zcrnru1263o', '00:00:00', '14:30:06', '2022-07-01', 'Jumat', 'Bekerja', 'Tidak mengisi presensi datang', NULL, NULL, '', ''),
('jut4ur9g8he', 211201238, '6dgp2yi0tjp8', '08:08:38', '16:31:14', '2022-07-07', 'Kamis', 'Bekerja', 'Terlambat 0 Jam 8 menit', '114.7666395', '-3.7533148', '', ''),
('ozxvybc5ga7', 211201238, NULL, '10:56:02', '00:00:00', '2022-07-06', 'Rabu', 'Bekerja', 'Terlambat 2 Jam 56 menit', '114.7666395', '-3.7533148', '', ''),
('wzi723hhser', 211201246, NULL, '00:00:00', '00:00:00', '2022-07-08', 'Jumat', 'Tanpa Keterangan', 'Tidak mengisi presensi datang', NULL, NULL, '', ''),
('yqvx72n0zqq', 211201246, NULL, '00:00:00', '00:00:00', '2022-07-07', 'Kamis', 'Tanpa Keterangan', 'Tidak mengisi presensi datang', NULL, NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `act_id` char(12) NOT NULL,
  `pgw_id` int(50) NOT NULL,
  `act_tgl` date NOT NULL,
  `act_qty` int(11) NOT NULL,
  `act_ket` text NOT NULL,
  `act_output` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`act_id`, `pgw_id`, `act_tgl`, `act_qty`, `act_ket`, `act_output`) VALUES
('4486emkb5igc', 211201238, '2022-07-12', 1, '<ol>\n<li>Status laporan kegiatan di tabel kehadiran</li>\n</ol>', 'status tabel kehadiran'),
('4w67pms6aa79', 211201238, '2022-07-08', 1, '<ol>\n<li>Membuat fitur tinyMCE</li>\n<li>Membuat fitur tags input2</li>\n</ol>', 'tinyMCE,tags input,tagslagi,tags aja'),
('5xh7clddqv6o', 211201238, '2022-07-13', 1, '<ol>\n<li>Trigger to avoid duplicate</li>\n</ol>', 'trigger duplicate before insert'),
('64iyenby3fb5', 211201238, '2022-07-07', 2, '<ol>\n<li>Membuat fitur tinyMCE</li>\n<li>Membuat fitur tags input2</li>\n</ol>', 'display detail dengan badge,spilt array dengan js'),
('6dgp2yi0tjp8', 211201238, '2022-07-07', 1, '<ol>\n<li>Membuat fitur tinyMCE</li>\n<li>Membuat fitur tags input</li>\n</ol>', '1. produk1,2. produk2,3. produk3'),
('7b8pgwh51zor', 211201238, '2022-07-11', 1, '<p>asas</p>', 'asad');

--
-- Triggers `activity`
--
DELIMITER $$
CREATE TRIGGER `Before_Insert_Activity` BEFORE INSERT ON `activity` FOR EACH ROW BEGIN
  IF (EXISTS(SELECT 1 FROM activity WHERE act_tgl = NEW.act_tgl AND pgw_id = NEW.pgw_id)) THEN
    SIGNAL SQLSTATE VALUE '45000' SET MESSAGE_TEXT = 'INSERT failed due to duplicate date';
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'app_admin', 'App Administrator'),
(2, 'pegawai', 'Regular User'),
(3, 'pimpinan', 'Pimpinan Bidang');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 5),
(2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'habibi@politala.ac.id', 5, '2022-04-18 12:14:29', 1),
(2, '::1', 'syahrul@politala.ac.id', 7, '2022-04-18 12:16:11', 1),
(3, '::1', 'habibi@politala.ac.id', 5, '2022-04-18 13:39:06', 1),
(4, '::1', 'syahrul@politala.ac.id', 7, '2022-04-18 13:39:17', 1),
(5, '::1', 'habibi@politala.ac.id', 5, '2022-04-18 13:39:26', 1),
(6, '::1', 'habibi@politala.ac.id', 5, '2022-04-19 08:41:03', 1),
(7, '::1', 'habibi@politala.ac.id', 5, '2022-04-19 14:05:01', 1),
(8, '::1', 'syahrul@politala.ac.id', 7, '2022-04-19 14:18:56', 1),
(9, '::1', 'habibi@politala.ac.id', 5, '2022-04-19 14:19:08', 1),
(10, '::1', 'habibi@politala.ac.id', 5, '2022-04-20 08:16:30', 1),
(11, '::1', 'habibi@politala.ac.id', 5, '2022-04-21 08:35:41', 1),
(12, '::1', 'habibi@politala.ac.id', 5, '2022-04-22 14:33:19', 1),
(13, '::1', 'habibi@politala.ac.id', 5, '2022-04-25 08:40:50', 1),
(14, '::1', 'habibi@politala.ac.id', 5, '2022-04-25 09:18:56', 1),
(15, '::1', 'habibi@politala.ac.id', 5, '2022-04-25 09:27:57', 1),
(16, '::1', 'syahrul@politala.ac.id', 7, '2022-04-25 09:28:05', 1),
(17, '::1', 'habibi@politala.ac.id', 5, '2022-04-25 09:54:50', 1),
(18, '::1', 'habibi@politala.ac.id', 5, '2022-04-25 10:16:14', 1),
(19, '::1', 'habibi@politala.ac.id', 5, '2022-04-26 08:23:08', 1),
(20, '::1', 'syahrul@politala.ac.id', 7, '2022-04-26 09:21:36', 1),
(21, '::1', 'afrizal', NULL, '2022-04-26 09:33:09', 0),
(22, '::1', 'habibi@politala.ac.id', 5, '2022-04-26 09:33:15', 1),
(23, '::1', 'habibi@politala.ac.id', 5, '2022-04-27 08:54:11', 1),
(24, '::1', 'syahrul@politala.ac.id', 7, '2022-04-27 13:15:03', 1),
(25, '::1', 'habibi@politala.ac.id', 5, '2022-04-27 13:16:44', 1),
(26, '::1', 'syahrul@politala.ac.id', 7, '2022-04-27 14:12:37', 1),
(27, '::1', 'habibi@politala.ac.id', 5, '2022-04-27 14:16:49', 1),
(28, '::1', 'habibi@politala.ac.id', 5, '2022-04-28 08:18:14', 1),
(29, '::1', 'habibi@politala.ac.id', 5, '2022-04-28 08:31:57', 1),
(30, '::1', 'syahrul@politala.ac.id', 7, '2022-04-28 10:51:23', 1),
(31, '::1', 'habibi@politala.ac.id', 5, '2022-04-28 11:15:03', 1),
(32, '::1', 'syahrul@politala.ac.id', 7, '2022-04-28 11:16:01', 1),
(33, '::1', 'habibi@politala.ac.id', 5, '2022-04-28 11:17:29', 1),
(34, '::1', 'habibi@politala.ac.id', 5, '2022-05-13 11:13:49', 1),
(35, '::1', 'habibi@politala.ac.id', 5, '2022-05-13 13:58:10', 1),
(36, '::1', 'habibi@politala.ac.id', 5, '2022-05-17 09:32:53', 1),
(37, '::1', 'syahrul@politala.ac.id', 7, '2022-05-17 11:31:05', 1),
(38, '::1', 'habibi@politala.ac.id', 5, '2022-05-17 11:35:52', 1),
(39, '::1', 'syahrul@politala.ac.id', 7, '2022-05-17 14:46:47', 1),
(40, '::1', 'habibi@politala.ac.id', 5, '2022-05-17 14:59:20', 1),
(41, '::1', 'habibi@politala.ac.id', 5, '2022-05-17 15:46:58', 1),
(42, '::1', 'habibi@politala.ac.id', 5, '2022-05-18 08:26:00', 1),
(43, '::1', 'habibi@politala.ac.id', 5, '2022-05-18 08:32:39', 1),
(44, '::1', 'habibi@politala.ac.id', 5, '2022-05-18 08:53:26', 1),
(45, '::1', 'habibi@politala.ac.id', 5, '2022-05-18 09:12:14', 1),
(46, '::1', 'habibi@politala.ac.id', 5, '2022-05-18 09:12:52', 1),
(47, '::1', 'habibi@politala.ac.id', 5, '2022-05-18 09:15:41', 1),
(48, '::1', 'habibi@politala.ac.id', 5, '2022-05-18 10:21:51', 1),
(49, '::1', 'habibi@politala.ac.id', 5, '2022-05-18 16:21:50', 1),
(50, '::1', 'syahrul@politala.ac.id', 7, '2022-05-18 16:23:08', 1),
(51, '::1', 'habibi@politala.ac.id', 5, '2022-05-18 16:25:00', 1),
(52, '::1', 'habibi@politala.ac.id', 5, '2022-05-19 11:27:33', 1),
(53, '::1', 'habibi@politala.ac.id', 5, '2022-05-20 08:12:53', 1),
(54, '::1', 'syahrul@politala.ac.id', 7, '2022-05-20 09:39:03', 1),
(55, '::1', 'habibi@politala.ac.id', 5, '2022-05-20 09:39:21', 1),
(56, '::1', 'syahrul@politala.ac.id', 7, '2022-05-20 09:57:17', 1),
(57, '::1', 'habibi@politala.ac.id', 5, '2022-05-20 10:03:15', 1),
(58, '::1', 'syahrul@politala.ac.id', 7, '2022-05-20 10:07:22', 1),
(59, '::1', 'habibi@politala.ac.id', 5, '2022-05-20 10:14:31', 1),
(60, '::1', 'syahrul@politala.ac.id', 7, '2022-05-20 10:15:02', 1),
(61, '::1', 'habibi@politala.ac.id', 5, '2022-05-20 10:18:20', 1),
(62, '::1', 'habibi@politala.ac.id', 5, '2022-05-20 14:13:14', 1),
(63, '::1', 'habibi@politala.ac.id', 5, '2022-05-20 17:01:10', 1),
(64, '::1', 'habibi@politala.ac.id', 5, '2022-05-21 11:57:18', 1),
(65, '::1', 'syahrul@politala.ac.id', 7, '2022-05-21 14:44:04', 1),
(66, '::1', 'habibi@politala.ac.id', 5, '2022-05-21 14:46:12', 1),
(67, '::1', 'habibi@politala.ac.id', 5, '2022-05-23 15:13:08', 1),
(68, '::1', 'habibi@politala.ac.id', 5, '2022-05-25 11:39:06', 1),
(69, '::1', 'habibi@politala.ac.id', 5, '2022-05-25 14:24:13', 1),
(70, '::1', 'habibi@politala.ac.id', 5, '2022-05-30 10:02:47', 1),
(71, '::1', 'habibi@politala.ac.id', 5, '2022-05-31 10:51:26', 1),
(72, '::1', 'habibi@politala.ac.id', 5, '2022-06-01 10:52:44', 1),
(73, '::1', 'habibi@politala.ac.id', 5, '2022-06-01 12:38:04', 1),
(74, '::1', 'habibi@politala.ac.id', 5, '2022-06-02 08:31:08', 1),
(75, '::1', 'habibi@politala.ac.id', 5, '2022-06-02 13:40:19', 1),
(76, '::1', 'habibi@politala.ac.id', 5, '2022-06-03 08:33:12', 1),
(77, '::1', 'habibi@politala.ac.id', 5, '2022-06-03 14:09:13', 1),
(78, '::1', 'habibi@politala.ac.id', 5, '2022-06-04 14:36:34', 1),
(79, '::1', 'habibi@politala.ac.id', 5, '2022-06-06 08:13:46', 1),
(80, '::1', 'habibi@politala.ac.id', 5, '2022-06-06 14:23:55', 1),
(81, '::1', 'habibi@politala.ac.id', 5, '2022-06-07 08:52:25', 1),
(82, '::1', 'habibi@politala.ac.id', 5, '2022-06-07 11:46:57', 1),
(83, '::1', 'syahrul@politala.ac.id', 7, '2022-06-07 16:43:29', 1),
(84, '::1', 'habibi@politala.ac.id', 5, '2022-06-07 16:43:56', 1),
(85, '::1', 'habibi@politala.ac.id', 5, '2022-06-08 08:32:16', 1),
(86, '::1', 'habibi@politala.ac.id', 5, '2022-06-08 11:16:57', 1),
(87, '::1', 'habibi@politala.ac.id', 5, '2022-06-08 15:28:09', 1),
(88, '::1', 'syahrul@politala.ac.id', 7, '2022-06-08 16:59:53', 1),
(89, '::1', 'habibi@politala.ac.id', 5, '2022-06-08 17:02:18', 1),
(90, '::1', 'habibi@politala.ac.id', 5, '2022-06-09 08:21:59', 1),
(91, '::1', 'habibi@politala.ac.id', 5, '2022-06-09 08:36:26', 1),
(92, '::1', 'habibi@politala.ac.id', 5, '2022-06-09 08:49:37', 1),
(93, '::1', 'habibi@politala.ac.id', 5, '2022-06-13 10:39:43', 1),
(94, '::1', 'habibi@politala.ac.id', 5, '2022-06-15 08:57:07', 1),
(95, '::1', 'habibi@politala.ac.id', 5, '2022-06-15 08:58:38', 1),
(96, '::1', 'habibi@politala.ac.id', 5, '2022-06-16 14:13:16', 1),
(97, '::1', 'habibi@politala.ac.id', 5, '2022-06-20 16:54:47', 1),
(98, '::1', 'habibi@politala.ac.id', 5, '2022-06-21 10:40:54', 1),
(99, '::1', 'habibi@politala.ac.id', 5, '2022-06-21 14:50:44', 1),
(100, '::1', 'habibi@politala.ac.id', 5, '2022-06-22 08:15:51', 1),
(101, '::1', 'habibi@politala.ac.id', 5, '2022-06-22 08:16:18', 1),
(102, '::1', 'syahrul@politala.ac.id', 7, '2022-06-22 09:18:13', 1),
(103, '::1', 'habibi@politala.ac.id', 5, '2022-06-22 09:26:40', 1),
(104, '::1', 'habibi@politala.ac.id', 5, '2022-06-22 13:46:36', 1),
(105, '::1', 'habibi@politala.ac.id', 5, '2022-06-23 08:26:54', 1),
(106, '::1', 'habibi@politala.ac.id', 5, '2022-06-23 08:33:09', 1),
(107, '::1', 'habibi@politala.ac.id', 5, '2022-06-24 08:32:08', 1),
(108, '::1', 'habibi@politala.ac.id', 5, '2022-06-24 08:32:54', 1),
(109, '::1', 'habibi@politala.ac.id', 5, '2022-06-24 14:20:01', 1),
(110, '::1', 'habibi@politala.ac.id', 5, '2022-06-24 15:00:55', 1),
(111, '::1', 'habibi@politala.ac.id', 5, '2022-06-24 15:44:45', 1),
(112, '::1', 'habibi@politala.ac.id', 5, '2022-06-24 15:47:29', 1),
(113, '::1', 'habibi@politala.ac.id', 5, '2022-06-24 15:50:10', 1),
(114, '::1', 'habibi@politala.ac.id', 5, '2022-06-24 16:37:22', 1),
(115, '::1', 'habibi@politala.ac.id', 5, '2022-06-24 16:57:25', 1),
(116, '::1', 'habibi@politala.ac.id', 5, '2022-06-26 11:15:18', 1),
(117, '::1', 'habibi@politala.ac.id', 5, '2022-06-26 11:40:33', 1),
(118, '::1', 'habibi@politala.ac.id', 5, '2022-06-27 08:43:02', 1),
(119, '::1', 'habibi@politala.ac.id', 5, '2022-06-27 08:43:29', 1),
(120, '::1', 'habibi@politala.ac.id', 5, '2022-06-27 14:51:40', 1),
(121, '::1', 'habibi@politala.ac.id', 5, '2022-06-28 08:17:40', 1),
(122, '::1', 'habibi@politala.ac.id', 5, '2022-06-29 08:25:02', 1),
(123, '::1', 'habibi@politala.ac.id', 5, '2022-06-30 08:29:46', 1),
(124, '::1', 'syahrul@politala.ac.id', 7, '2022-06-30 10:53:33', 1),
(125, '::1', 'habibi@politala.ac.id', 5, '2022-06-30 10:55:32', 1),
(126, '::1', 'syahrul@politala.ac.id', 7, '2022-06-30 15:28:29', 1),
(127, '::1', 'habibi@politala.ac.id', 5, '2022-06-30 15:30:40', 1),
(128, '::1', 'habibi@politala.ac.id', 5, '2022-07-01 08:59:27', 1),
(129, '::1', 'habibi@politala.ac.id', 5, '2022-07-01 14:24:01', 1),
(130, '::1', 'syahrul@politala.ac.id', 7, '2022-07-01 14:29:30', 1),
(131, '::1', 'habibi@politala.ac.id', 5, '2022-07-01 14:31:13', 1),
(132, '::1', 'habibi@politala.ac.id', 5, '2022-07-01 16:33:15', 1),
(133, '::1', 'habibi@politala.ac.id', 5, '2022-07-02 13:54:59', 1),
(134, '::1', 'habibi@politala.ac.id', 5, '2022-07-04 08:58:43', 1),
(135, '::1', 'habibi@politala.ac.id', 5, '2022-07-04 17:08:37', 1),
(136, '::1', 'habibi@politala.ac.id', 5, '2022-07-05 08:29:54', 1),
(137, '::1', 'syahrul@politala.ac.id', 7, '2022-07-05 08:32:38', 1),
(138, '::1', 'habibi@politala.ac.id', 5, '2022-07-05 08:33:19', 1),
(139, '::1', 'habibi@politala.ac.id', 5, '2022-07-06 10:55:32', 1),
(140, '::1', 'habibi@politala.ac.id', 5, '2022-07-06 15:09:00', 1),
(141, '::1', 'habibi@politala.ac.id', 5, '2022-07-07 08:08:09', 1),
(142, '::1', 'syahrul@politala.ac.id', 7, '2022-07-07 11:05:41', 1),
(143, '::1', 'habibi@politala.ac.id', 5, '2022-07-07 11:06:59', 1),
(144, '::1', 'habibi@politala.ac.id', 5, '2022-07-07 11:09:10', 1),
(145, '::1', 'ega@politala.ac.id', NULL, '2022-07-07 11:13:42', 0),
(146, '::1', 'syahrul@politala.ac.id', NULL, '2022-07-07 11:14:46', 0),
(147, '::1', 'syahrul@politala.ac.id', NULL, '2022-07-07 11:14:58', 0),
(148, '::1', 'syahrul@politala.ac.id', 7, '2022-07-07 11:15:13', 1),
(149, '::1', 'habibi@politala.ac.id', 5, '2022-07-07 11:27:20', 1),
(150, '::1', 'habibi@politala.ac.id', 5, '2022-07-07 11:45:33', 1),
(151, '::1', 'habibi@politala.ac.id', 5, '2022-07-07 11:45:50', 1),
(152, '::1', 'syahrul@politala.ac.id', 7, '2022-07-07 11:51:20', 1),
(153, '::1', 'habibi@politala.ac.id', 5, '2022-07-07 16:31:09', 1),
(154, '::1', 'habibi@politala.ac.id', 5, '2022-07-08 08:15:03', 1),
(155, '::1', 'habibi@politala.ac.id', 5, '2022-07-08 09:39:34', 1),
(156, '::1', 'habibi@politala.ac.id', 5, '2022-07-08 13:59:36', 1),
(157, '::1', 'syahrul@politala.ac.id', 7, '2022-07-08 14:40:40', 1),
(158, '::1', 'habibi@politala.ac.id', 5, '2022-07-08 16:48:20', 1),
(159, '::1', 'syahrul@politala.ac.id', 7, '2022-07-08 16:50:11', 1),
(160, '::1', 'habibi@politala.ac.id', 5, '2022-07-08 16:54:34', 1),
(161, '::1', 'syahrul@politala.ac.id', 7, '2022-07-08 16:54:46', 1),
(162, '::1', 'habibi@politala.ac.id', 5, '2022-07-08 16:57:35', 1),
(163, '::1', 'habibi@politala.ac.id', 5, '2022-07-09 09:45:01', 1),
(164, '::1', 'habibi@politala.ac.id', 5, '2022-07-09 19:34:39', 1),
(165, '::1', 'habibi@politala.ac.id', 5, '2022-07-10 11:18:36', 1),
(166, '::1', 'habibi@politala.ac.id', 5, '2022-07-11 07:56:10', 1),
(167, '::1', 'habibi@politala.ac.id', 5, '2022-07-12 08:18:19', 1),
(168, '::1', 'syahrul@politala.ac.id', 7, '2022-07-12 11:12:27', 1),
(169, '::1', 'syahrul@politala.ac.id', 7, '2022-07-12 14:05:26', 1),
(170, '::1', 'habibi@politala.ac.id', 5, '2022-07-12 14:47:20', 1),
(171, '::1', 'habibi@politala.ac.id', 5, '2022-07-13 08:05:03', 1),
(172, '::1', 'habibi@politala.ac.id', 5, '2022-07-14 17:27:21', 1),
(173, '::1', 'habibi@politala.ac.id', 5, '2022-07-15 09:24:41', 1),
(174, '::1', 'syahrul@politala.ac.id', 7, '2022-07-15 11:34:36', 1),
(175, '::1', 'habibi@politala.ac.id', 5, '2022-07-15 11:37:43', 1),
(176, '::1', 'habibi@politala.ac.id', 5, '2022-07-15 15:04:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_tokens`
--

INSERT INTO `auth_tokens` (`id`, `selector`, `hashedValidator`, `user_id`, `expires`) VALUES
(3, 'a6ed199e2b8585bc49f012c5', '5c86e6cf6b5c4203b3de47a82cd79dd75eb2911a1110bad04e10826528f0d579', 5, '2022-08-14 15:04:24');

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `homebase`
--

CREATE TABLE `homebase` (
  `hmb_id` char(12) NOT NULL,
  `hmb_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `homebase`
--

INSERT INTO `homebase` (`hmb_id`, `hmb_name`) VALUES
('4486emkc5ig2', 'Sub Bagian Umum');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1650252874, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `pgw_id` int(50) NOT NULL,
  `hmb_id` char(12) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `status_peg` enum('PNS','Non PNS','P3K') NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`pgw_id`, `hmb_id`, `nama`, `jabatan`, `status_peg`, `jenis_kelamin`) VALUES
(211201238, '4486emkc5ig2', 'Afrizal Habibi B.Sc', 'Tenaga Kependidikan', 'Non PNS', 'Laki-laki'),
(211201246, '4486emkc5ig2', 'Muhamad Ega Nabhan, B.Sc', 'Tenaga Kependidikan', 'Non PNS', 'Laki-laki'),
(211201248, '4486emkc5ig2', 'M. Syahrul Rizal B.Sc', 'Tenaga Kependidikan', 'Non PNS', 'Laki-laki');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `pgw_id` int(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `pgw_id`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'habibi@politala.ac.id', 211201238, 'habibi', '$2y$10$H6CpqxhpwBJQX9rzg3wpX.9q5rg5OZVMr5qaDIVy.0kie8Qna8xYa', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-04-18 12:12:22', '2022-04-18 12:12:22', NULL),
(7, 'syahrul@politala.ac.id', 211201248, 'syahrul', '$2y$10$6dFM1SdCaQRGKT45c7NfkOKCfTSVKqS8YvSJJ7CnpwZe052wmww.S', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-04-18 12:14:04', '2022-04-18 12:14:04', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`abs_id`),
  ADD KEY `pgw_id` (`pgw_id`),
  ADD KEY `act_abs_FK` (`act_id`);

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`act_id`),
  ADD KEY `act_pgw_id` (`pgw_id`);

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `homebase`
--
ALTER TABLE `homebase`
  ADD PRIMARY KEY (`hmb_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`pgw_id`),
  ADD KEY `pgw_hmb_id` (`hmb_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `usr_FK` (`pgw_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `pgw_FK` FOREIGN KEY (`pgw_id`) REFERENCES `pegawai` (`pgw_id`);

--
-- Constraints for table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `act_pgw_id` FOREIGN KEY (`pgw_id`) REFERENCES `pegawai` (`pgw_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pgw_hmb_id` FOREIGN KEY (`hmb_id`) REFERENCES `homebase` (`hmb_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `usr_FK` FOREIGN KEY (`pgw_id`) REFERENCES `pegawai` (`pgw_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

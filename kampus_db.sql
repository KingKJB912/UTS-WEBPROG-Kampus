-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2025 at 09:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kampus_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `gelar` varchar(50) DEFAULT NULL,
  `lulusan` varchar(100) DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `user_input` varchar(50) DEFAULT NULL,
  `tgl_input` date DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `nik`, `nama`, `gelar`, `lulusan`, `telp`, `user_input`, `tgl_input`, `username`) VALUES
(1, 'D001', 'Dr. Ahmad Zain', 'S.Kom., M.Kom.', 'ITS', '081234567891', 'admin1', '2025-04-06', 'dosen1'),
(2, 'D002', 'Ir. Budi Raharjo', 'M.T.', 'UI', '081234567892', 'admin1', '2025-04-06', 'dosen2'),
(3, 'D003', 'Dr. Rina Sari', 'M.Kom.', 'UB', '081234567893', 'admin1', '2025-04-06', 'dosen3');

-- --------------------------------------------------------

--
-- Table structure for table `krs`
--

CREATE TABLE `krs` (
  `id` int(11) NOT NULL,
  `kode_matkul` varchar(20) DEFAULT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `nim_mahasiswa` varchar(20) DEFAULT NULL,
  `hari` varchar(20) DEFAULT NULL,
  `ruangan` varchar(50) DEFAULT NULL,
  `user_input` varchar(50) DEFAULT NULL,
  `tgl_input` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `krs`
--

INSERT INTO `krs` (`id`, `kode_matkul`, `id_dosen`, `nim_mahasiswa`, `hari`, `ruangan`, `user_input`, `tgl_input`) VALUES
(11, 'MK001', 1, '210001001', 'Senin', 'A101', 'admin1', '2025-04-06'),
(12, 'MK001', 1, '210001002', 'Senin', 'A101', 'admin1', '2025-04-06'),
(13, 'MK002', 2, '210001003', 'Selasa', 'B201', 'admin1', '2025-04-06'),
(14, 'MK002', 2, '210001004', 'Selasa', 'B201', 'admin1', '2025-04-06'),
(15, 'MK003', 3, '210001005', 'Rabu', 'C301', 'admin1', '2025-04-06');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tahun_masuk` year(4) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `user_input` varchar(50) DEFAULT NULL,
  `tgl_input` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `tahun_masuk`, `alamat`, `telp`, `user_input`, `tgl_input`) VALUES
('210001001', 'Aulia Permata', '2022', 'Jl. Melati No. 1', '081234567001', 'mahasiswa01', '2025-04-06'),
('210001002', 'Bayu Saputra', '2022', 'Jl. Kenanga No. 2', '081234567002', 'mahasiswa02', '2025-04-06'),
('210001003', 'Citra Ayuningtyas', '2022', 'Jl. Mawar No. 3', '081234567003', 'mahasiswa03', '2025-04-06'),
('210001004', 'Dimas Haryanto', '2022', 'Jl. Flamboyan No. 4', '081234567004', 'mahasiswa04', '2025-04-06'),
('210001005', 'Eka Sari Dewi', '2022', 'Jl. Anggrek No. 5', '081234567005', 'mahasiswa05', '2025-04-06'),
('210001006', 'Fajar Prasetyo', '2022', 'Jl. Cendana No. 6', '081234567006', 'mahasiswa06', '2025-04-06'),
('210001007', 'Gita Maharani', '2022', 'Jl. Cemara No. 7', '081234567007', 'mahasiswa07', '2025-04-06'),
('210001008', 'Hendri Kurniawan', '2022', 'Jl. Merpati No. 8', '081234567008', 'mahasiswa08', '2025-04-06'),
('210001009', 'Indah Larasati', '2022', 'Jl. Angsa No. 9', '081234567009', 'mahasiswa09', '2025-04-06'),
('210001010', 'Joko Priyono', '2022', 'Jl. Nuri No. 10', '081234567010', 'mahasiswa10', '2025-04-06'),
('210001011', 'Kiki Amalia', '2022', 'Jl. Rajawali No. 11', '081234567011', 'mahasiswa11', '2025-04-06'),
('210001012', 'Lutfi Rahman', '2022', 'Jl. Elang No. 12', '081234567012', 'mahasiswa12', '2025-04-06'),
('210001013', 'Mega Putri', '2022', 'Jl. Garuda No. 13', '081234567013', 'mahasiswa13', '2025-04-06'),
('210001014', 'Naufal Rizki', '2022', 'Jl. Kenari No. 14', '081234567014', 'mahasiswa14', '2025-04-06'),
('210001015', 'Olivia Rahma', '2022', 'Jl. Jalak No. 15', '081234567015', 'mahasiswa15', '2025-04-06'),
('210001016', 'Putra Andika', '2022', 'Jl. Perkutut No. 16', '081234567016', 'mahasiswa16', '2025-04-06'),
('210001017', 'Qonita Nabila', '2022', 'Jl. Kutilang No. 17', '081234567017', 'mahasiswa17', '2025-04-06'),
('210001018', 'Rendi Maulana', '2022', 'Jl. Kacer No. 18', '081234567018', 'mahasiswa18', '2025-04-06'),
('210001019', 'Salsa Bilqis', '2022', 'Jl. Beo No. 19', '081234567019', 'mahasiswa19', '2025-04-06'),
('210001020', 'Tegar Wibowo', '2022', 'Jl. Bangau No. 20', '081234567020', 'mahasiswa20', '2025-04-06'),
('210001021', 'Umi Latifah', '2022', 'Jl. Merak No. 21', '081234567021', 'mahasiswa21', '2025-04-06'),
('210001022', 'Vino Saputra', '2022', 'Jl. Cenderawasih No. 22', '081234567022', 'mahasiswa22', '2025-04-06'),
('210001023', 'Wulan Sari', '2022', 'Jl. Pipit No. 23', '081234567023', 'mahasiswa23', '2025-04-06'),
('210001024', 'Xavier Firmansyah', '2022', 'Jl. Ciblek No. 24', '081234567024', 'mahasiswa24', '2025-04-06'),
('210001025', 'Yuli Andini', '2022', 'Jl. Serindit No. 25', '081234567025', 'mahasiswa25', '2025-04-06'),
('210001026', 'Zaki Ramadhan', '2022', 'Jl. Gelatik No. 26', '081234567026', 'mahasiswa26', '2025-04-06'),
('210001027', 'Anisa Oktaviani', '2022', 'Jl. Cangak No. 27', '081234567027', 'mahasiswa27', '2025-04-06'),
('210001028', 'Bagus Hernando', '2022', 'Jl. Elok No. 28', '081234567028', 'mahasiswa28', '2025-04-06'),
('210001029', 'Cahya Lestari', '2022', 'Jl. Damai No. 29', '081234567029', 'mahasiswa29', '2025-04-06'),
('210001030', 'Dedi Hidayat', '2022', 'Jl. Sentosa No. 30', '081234567030', 'mahasiswa30', '2025-04-06');

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE `matkul` (
  `kode_matkul` varchar(20) NOT NULL,
  `nama_matkul` varchar(100) DEFAULT NULL,
  `sks` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `user_input` varchar(50) DEFAULT NULL,
  `tgl_input` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`kode_matkul`, `nama_matkul`, `sks`, `semester`, `user_input`, `tgl_input`) VALUES
('MK001', 'Pemrograman Web', 3, 4, 'admin1', '2025-04-06'),
('MK002', 'Basis Data', 3, 4, 'admin1', '2025-04-06'),
('MK003', 'Algoritma & Struktur Data', 3, 3, 'admin1', '2025-04-06');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `user_input` varchar(100) DEFAULT NULL,
  `tgl_input` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `judul`, `isi`, `user_input`, `tgl_input`) VALUES
(1, 'Libur Awal Ramadhan', 'Diberitahukan kepada seluruh civitas akademika bahwa kuliah diliburkan mulai 10 April 2025 dalam rangka menyambut bulan suci Ramadhan.', 'admin1', '2025-04-06'),
(2, 'Perpanjangan KRS', 'Periode pengisian KRS diperpanjang hingga tanggal 12 April 2025. Mahasiswa diharapkan segera menyelesaikan pengisian.', 'admin1', '2025-04-05'),
(3, 'Ujian Tengah Semester', 'UTS akan dilaksanakan mulai tanggal 20 April 2025. Jadwal lengkap menyusul.', 'admin1', '2025-04-04'),
(4, 'Maintenance Sistem', 'Website akan mengalami maintenance pada tanggal 7 April 2025 pukul 00:00 - 03:00 WIB.', 'admin1', '2025-04-03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin','dosen','mahasiswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(7, 'admin1', 'admin123', 'admin'),
(8, 'dosen1', 'dosen123', 'dosen'),
(10, 'dosen2', 'dosen234', 'dosen'),
(11, 'dosen3', 'dosen345', 'dosen'),
(12, 'mahasiswa01', 'aulia001', 'mahasiswa'),
(13, 'mahasiswa02', 'bayu002', 'mahasiswa'),
(14, 'mahasiswa03', 'citra003', 'mahasiswa'),
(15, 'mahasiswa04', 'dimas004', 'mahasiswa'),
(16, 'mahasiswa05', 'eka005', 'mahasiswa'),
(17, 'mahasiswa06', 'fajar006', 'mahasiswa'),
(18, 'mahasiswa07', 'gita007', 'mahasiswa'),
(19, 'mahasiswa08', 'hendri008', 'mahasiswa'),
(20, 'mahasiswa09', 'indah009', 'mahasiswa'),
(21, 'mahasiswa10', 'joko010', 'mahasiswa'),
(22, 'mahasiswa11', 'kiki011', 'mahasiswa'),
(23, 'mahasiswa12', 'lutfi012', 'mahasiswa'),
(24, 'mahasiswa13', 'mega013', 'mahasiswa'),
(25, 'mahasiswa14', 'naufal014', 'mahasiswa'),
(26, 'mahasiswa15', 'olivia015', 'mahasiswa'),
(27, 'mahasiswa16', 'putra016', 'mahasiswa'),
(28, 'mahasiswa17', 'qonita017', 'mahasiswa'),
(29, 'mahasiswa18', 'rizky018', 'mahasiswa'),
(30, 'mahasiswa19', 'salsa019', 'mahasiswa'),
(31, 'mahasiswa20', 'tari020', 'mahasiswa'),
(32, 'mahasiswa21', 'umar021', 'mahasiswa'),
(33, 'mahasiswa22', 'vina022', 'mahasiswa'),
(34, 'mahasiswa23', 'wulan023', 'mahasiswa'),
(35, 'mahasiswa24', 'xena024', 'mahasiswa'),
(36, 'mahasiswa25', 'yana025', 'mahasiswa'),
(37, 'mahasiswa26', 'zaki026', 'mahasiswa'),
(38, 'mahasiswa27', 'alya027', 'mahasiswa'),
(39, 'mahasiswa28', 'bima028', 'mahasiswa'),
(40, 'mahasiswa29', 'chelsea029', 'mahasiswa'),
(41, 'mahasiswa30', 'daniel030', 'mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_matkul` (`kode_matkul`),
  ADD KEY `nim_mahasiswa` (`nim_mahasiswa`),
  ADD KEY `fk_dosen_id` (`id_dosen`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`kode_matkul`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `krs`
--
ALTER TABLE `krs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `krs`
--
ALTER TABLE `krs`
  ADD CONSTRAINT `fk_dosen_id` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `krs_ibfk_1` FOREIGN KEY (`kode_matkul`) REFERENCES `matkul` (`kode_matkul`),
  ADD CONSTRAINT `krs_ibfk_3` FOREIGN KEY (`nim_mahasiswa`) REFERENCES `mahasiswa` (`nim`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

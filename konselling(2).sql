-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 06:20 AM
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
-- Database: `konselling`
--

-- --------------------------------------------------------

--
-- Table structure for table `keanggotaan`
--

CREATE TABLE `keanggotaan` (
  `id_keanggotaan` int(11) NOT NULL,
  `nim` varchar(15) DEFAULT NULL,
  `id_komunitas` int(11) DEFAULT NULL,
  `tanggal_bergabung` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keanggotaan`
--

INSERT INTO `keanggotaan` (`id_keanggotaan`, `nim`, `id_komunitas`, `tanggal_bergabung`) VALUES
(1, '22030001', 1, '2024-03-01'),
(2, '22030002', 2, '2024-03-05'),
(3, '22030003', 3, '2024-03-10'),
(4, '22030004', 4, '2024-03-15'),
(5, '22030005', 5, '2024-03-20');

-- --------------------------------------------------------

--
-- Table structure for table `komunitas`
--

CREATE TABLE `komunitas` (
  `id_komunitas` int(11) NOT NULL,
  `nama_komunitas` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal_dibuat` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komunitas`
--

INSERT INTO `komunitas` (`id_komunitas`, `nama_komunitas`, `deskripsi`, `tanggal_dibuat`) VALUES
(1, 'Komunitas Anti Stres', 'Forum untuk berbagi cerita dan tips menangani stres.', '2024-01-01'),
(2, 'Komunitas Depresi Awareness', 'Diskusi tentang penanganan depresi.', '2024-02-01'),
(3, 'Komunitas Meditasi', 'Kegiatan rutin meditasi bersama.', '2024-03-01'),
(4, 'Komunitas Relaksasi', 'Belajar cara relaksasi efektif.', '2024-04-01'),
(5, 'Komunitas Support Group', 'Dukungan untuk saling menguatkan.', '2024-05-01'),
(6, 'Komunitas Marah Marah', 'Forum sambat', '2024-12-08'),
(7, 'Komunitas MAPRES', 'Sharing mapres UNNES', '2024-12-09');

-- --------------------------------------------------------

--
-- Table structure for table `konselor`
--

CREATE TABLE `konselor` (
  `id_konselor` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `spesialis` varchar(100) DEFAULT NULL,
  `sertifikasi` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konselor`
--

INSERT INTO `konselor` (`id_konselor`, `nama`, `spesialis`, `sertifikasi`, `email`) VALUES
(1, 'Dr. Siti', 'Psikolog Klinis', 'Sertifikasi A', 'siti@gmail.com'),
(2, 'Dr. Rian', 'Psikolog Pendidikan', 'Sertifikasi B', 'rian@gmail.com'),
(3, 'Dr. Fitri', 'Psikolog Anak', 'Sertifikasi C', 'fitri@gmail.com'),
(4, 'Dr. Wahyu', 'Psikolog Sosial', 'Sertifikasi D', 'wahyu@gmail.com'),
(5, 'Dr. Lina', 'Psikolog Klinis', 'Sertifikasi E', 'lina@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id_konsultasi` int(11) NOT NULL,
  `nim` varchar(15) DEFAULT NULL,
  `id_konselor` int(11) DEFAULT NULL,
  `tanggal_konsultasi` date DEFAULT NULL,
  `status_konsultasi` enum('tertunda','berjalan','selesai') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konsultasi`
--

INSERT INTO `konsultasi` (`id_konsultasi`, `nim`, `id_konselor`, `tanggal_konsultasi`, `status_konsultasi`) VALUES
(1, '22030001', 1, '2024-11-27', 'tertunda'),
(2, '22030002', 2, '2024-11-28', 'tertunda'),
(3, '22030003', 3, '2024-11-29', 'selesai'),
(4, '22030004', 4, '2024-11-30', 'tertunda'),
(5, '22030005', 5, '2024-12-01', 'tertunda'),
(13, '2269037', 1, '2024-12-11', 'berjalan'),
(21, '43215467', 2, '2024-12-19', 'tertunda'),
(22, '2344682', 1, '2024-12-26', 'berjalan');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `nim` varchar(15) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`nim`, `nama`, `email`, `tanggal_lahir`) VALUES
('22030001', 'Ali', 'ali@gmail.com', '2002-03-15'),
('22030002', 'Budi', 'budi@gmail.com', '2001-05-20'),
('22030003', 'Citra', 'citra@gmail.com', '2003-07-10'),
('22030004', 'Dian', 'dian@gmail.com', '2000-09-25'),
('22030005', 'Eka', 'eka@gmail.com', '1999-11-30'),
('22030006', 'Farah', 'farah@gmail.com', '2002-01-15'),
('22030007', 'Gilang', 'gilang@gmail.com', '2001-06-20'),
('22030008', 'Hani', 'hani@gmail.com', '2003-08-10'),
('22030009', 'Indra', 'indra@gmail.com', '2000-10-25'),
('22030010', 'Joko', 'joko@gmail.com', '1999-12-30'),
('22030011', 'Kiki', 'kiki@gmail.com', '2002-03-05'),
('22030012', 'Lina', 'lina@gmail.com', '2001-07-15'),
('22030013', 'Mira', 'mira@gmail.com', '2003-09-10'),
('22030014', 'Nanda', 'nanda@gmail.com', '2000-11-25'),
('22030015', 'Ocha', 'ocha@gmail.com', '1999-02-28'),
('2269037', 'indra', NULL, NULL),
('23041400', 'Ahmad', 'ahmadkeren@gmail.com', '2005-12-14'),
('2344682', 'Bimo', 'bimokeren@gmail.com', '1999-11-17'),
('23467821', 'Zidan', 'zidankeren@gmail.com', '1995-12-19'),
('23467822', 'zoar panjaitan', 'soar@gmail.com', '2024-12-03'),
('24567809', 'Umar', 'umarkeren@gmail.com', '2008-12-11'),
('25678902', 'indah', 'indahkeren@gmail.com', '2001-12-12'),
('43215467', 'Hamka', 'hamka@gmail.com', '2005-04-28');

-- --------------------------------------------------------

--
-- Table structure for table `postingan_komunitas`
--

CREATE TABLE `postingan_komunitas` (
  `id_postingan` int(11) NOT NULL,
  `id_komunitas` int(11) DEFAULT NULL,
  `nim` varchar(15) DEFAULT NULL,
  `tanggal_postingan` date DEFAULT NULL,
  `isi_postingan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `postingan_komunitas`
--

INSERT INTO `postingan_komunitas` (`id_postingan`, `id_komunitas`, `nim`, `tanggal_postingan`, `isi_postingan`) VALUES
(1, 1, '22030001', '2024-03-10', 'Saya merasa lebih lega setelah berbagi cerita di sini.'),
(2, 2, '22030002', '2024-03-15', 'Tips mengatasi depresi: Coba terapi seni!'),
(3, 3, '22030003', '2024-03-20', 'Meditasi membuat saya lebih fokus.'),
(4, 4, '22030004', '2024-03-25', 'Relaksasi membantu tidur saya lebih nyenyak.'),
(5, 5, '22030005', '2024-03-30', 'Dukungan dari teman komunitas sangat berarti.'),
(26, 1, '22030006', '2024-04-01', 'Berbagi cerita di komunitas ini membuat saya merasa lebih tenang.'),
(27, 2, '22030007', '2024-04-05', 'Berbicara dengan teman komunitas membantu saya memahami kondisi saya.'),
(28, 3, '22030008', '2024-04-10', 'Meditasi bersama membuat saya lebih damai dan rileks.'),
(29, 4, '22030009', '2024-04-15', 'Relaksasi membuat hari saya lebih produktif.'),
(30, 5, '22030010', '2024-04-20', 'Saling mendukung di komunitas ini benar-benar membantu.'),
(31, 1, '22030011', '2024-04-25', 'Komunitas ini adalah tempat yang aman untuk berbagi perasaan saya.'),
(32, 2, '22030012', '2024-04-30', 'Banyak pelajaran penting yang saya dapatkan di komunitas ini.'),
(33, 3, '22030013', '2024-05-05', 'Meditasi adalah solusi untuk mengurangi stres saya sehari-hari.'),
(34, 4, '22030014', '2024-05-10', 'Diskusi di komunitas relaksasi membuat saya lebih mengenal diri sendiri.'),
(35, 5, '22030015', '2024-05-15', 'Terima kasih atas dukungannya, komunitas ini sangat berarti bagi saya.'),
(36, 6, '22030006', '2024-12-01', 'Kenapa harus macet tiap pagi! Ini bikin stres banget.'),
(37, 6, '22030007', '2024-12-02', 'Hari ini laptop tiba-tiba mati, kerjaan semua hilang.'),
(38, 6, '22030008', '2024-12-03', 'Belanja online, sudah bayar, barang malah salah kirim.'),
(39, 6, '22030009', '2024-12-04', 'Kenapa aplikasi sering error pas butuh banget?!'),
(40, 6, '22030010', '2024-12-05', 'Kena double charge di restoran, proses refund ribet.'),
(41, 6, '22030011', '2024-12-06', 'Tetangga nyetel musik keras tengah malam, susah tidur.'),
(42, 6, '22030012', '2024-12-07', 'Ketemu pengendara yang tidak pakai lampu sein, hampir kecelakaan.'),
(43, 6, '22030013', '2024-12-08', 'Dapat email phishing lagi, kenapa ini terus terjadi?'),
(44, 6, '22030014', '2024-12-08', 'Koneksi internet mati pas lagi meeting penting!'),
(45, 6, '22030015', '2024-12-08', 'Barang pesanan datang rusak, dan CS sulit dihubungi.');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_konsultasi`
--

CREATE TABLE `riwayat_konsultasi` (
  `id_riwayat` int(11) NOT NULL,
  `id_konsultasi` int(11) DEFAULT NULL,
  `catatan_konselor` text DEFAULT NULL,
  `rekomendasi_terapi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riwayat_konsultasi`
--

INSERT INTO `riwayat_konsultasi` (`id_riwayat`, `id_konsultasi`, `catatan_konselor`, `rekomendasi_terapi`) VALUES
(1, 1, 'Mahasiswa merasa sedikit cemas. solat cuy', 'Latihan pernapasan dan meditasi. sama solat cuy oke !'),
(2, 2, 'Mahasiswa membutuhkan waktu istirahat. dari banyak kegiatan', 'Terapi relaksasi ringan.'),
(3, 3, 'Mahasiswa menghadapi tekanan sosial.', 'Konseling sosial intensif.aman cuy'),
(4, 4, 'Mahasiswa butuh waktu untuk diri sendiri.', 'Lakukan hobi yang menyenangkan.'),
(5, 5, 'mahasiswa sudah sepenuhnya sembuh', 'Aktivitas kelompok positif.aman aja ok sip'),
(6, 21, 'pasien mengalami depresi berat', 'dengarkan musik klasik jika sedang bersantai'),
(7, 22, 'nanti ya', 'nanti ya'),
(8, 13, 'oke', 'oke');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keanggotaan`
--
ALTER TABLE `keanggotaan`
  ADD PRIMARY KEY (`id_keanggotaan`),
  ADD KEY `nim` (`nim`),
  ADD KEY `id_komunitas` (`id_komunitas`);

--
-- Indexes for table `komunitas`
--
ALTER TABLE `komunitas`
  ADD PRIMARY KEY (`id_komunitas`);

--
-- Indexes for table `konselor`
--
ALTER TABLE `konselor`
  ADD PRIMARY KEY (`id_konselor`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id_konsultasi`),
  ADD KEY `nim` (`nim`),
  ADD KEY `id_konselor` (`id_konselor`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`nim`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `postingan_komunitas`
--
ALTER TABLE `postingan_komunitas`
  ADD PRIMARY KEY (`id_postingan`),
  ADD KEY `id_komunitas` (`id_komunitas`),
  ADD KEY `nim` (`nim`);

--
-- Indexes for table `riwayat_konsultasi`
--
ALTER TABLE `riwayat_konsultasi`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `id_konsultasi` (`id_konsultasi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keanggotaan`
--
ALTER TABLE `keanggotaan`
  MODIFY `id_keanggotaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `komunitas`
--
ALTER TABLE `komunitas`
  MODIFY `id_komunitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `konselor`
--
ALTER TABLE `konselor`
  MODIFY `id_konselor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id_konsultasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `postingan_komunitas`
--
ALTER TABLE `postingan_komunitas`
  MODIFY `id_postingan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `riwayat_konsultasi`
--
ALTER TABLE `riwayat_konsultasi`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keanggotaan`
--
ALTER TABLE `keanggotaan`
  ADD CONSTRAINT `keanggotaan_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `pengguna` (`nim`),
  ADD CONSTRAINT `keanggotaan_ibfk_2` FOREIGN KEY (`id_komunitas`) REFERENCES `komunitas` (`id_komunitas`);

--
-- Constraints for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD CONSTRAINT `konsultasi_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `pengguna` (`nim`),
  ADD CONSTRAINT `konsultasi_ibfk_2` FOREIGN KEY (`id_konselor`) REFERENCES `konselor` (`id_konselor`);

--
-- Constraints for table `postingan_komunitas`
--
ALTER TABLE `postingan_komunitas`
  ADD CONSTRAINT `postingan_komunitas_ibfk_1` FOREIGN KEY (`id_komunitas`) REFERENCES `komunitas` (`id_komunitas`),
  ADD CONSTRAINT `postingan_komunitas_ibfk_2` FOREIGN KEY (`nim`) REFERENCES `pengguna` (`nim`);

--
-- Constraints for table `riwayat_konsultasi`
--
ALTER TABLE `riwayat_konsultasi`
  ADD CONSTRAINT `riwayat_konsultasi_ibfk_1` FOREIGN KEY (`id_konsultasi`) REFERENCES `konsultasi` (`id_konsultasi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

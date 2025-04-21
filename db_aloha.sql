-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 21, 2025 at 10:13 AM
-- Server version: 5.7.17-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_aloha`
--

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_kamar`
--

CREATE TABLE `fasilitas_kamar` (
  `id` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `fasilitas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fasilitas_kamar`
--

INSERT INTO `fasilitas_kamar` (`id`, `id_kamar`, `fasilitas`) VALUES
(7, 1, 'AC atau kipas angin'),
(8, 4, 'Smart TV dan akses premium'),
(9, 4, 'AC dengan kontrol suhu'),
(10, 1, 'Meja dan kursi sederhana'),
(11, 1, 'Tersedia alat mandi'),
(12, 1, 'Lemari kecil'),
(13, 1, 'Welcome Snack'),
(14, 3, 'Smart TV dan akses premium'),
(15, 3, 'Kulkas Mini'),
(16, 3, 'Meja dan Kursi nyaman'),
(17, 3, 'Sofa dengan balcon kamar'),
(18, 3, 'Welcome drink & fruit platter'),
(19, 4, 'Mini Bar'),
(20, 4, 'Sofa Luas'),
(21, 4, 'Lemari Penyimpanan'),
(22, 4, 'Perlengkapan Mandi'),
(23, 1, 'Lampu Mini'),
(30, 1, 'meja dan kursi sederhana'),
(31, 4, 'kolam renang'),
(32, 3, 'AC dengan kontrol suhu'),
(33, 4, 'Alat Mandi'),
(34, 3, 'kolam renang');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_umum`
--

CREATE TABLE `fasilitas_umum` (
  `id` int(11) NOT NULL,
  `nama_fasilitas` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fasilitas_umum`
--

INSERT INTO `fasilitas_umum` (`id`, `nama_fasilitas`, `keterangan`, `gambar`) VALUES
(3, 'Gym & Pusat Kebugaran', 'Jaga kebugaran di gym kami yang lengkap dengan peralatan modern dan ruangan nyaman untuk latihan optimal', 'gym.png'),
(4, 'Spa & Wellness Center', 'Nikmati layanan spa eksklusif di Hotel Aloha, menawarkan pijat, perawatan tubuh, sauna, dan aromaterapi oleh terapis profesional', 'spa.png'),
(5, ' Restoran & Area Makan', 'Nikmati hidangan lezat dari lokal hingga internasional di restoran kami. Tersedia juga in-room dining untuk kenyamanan Anda', 'resto.png'),
(6, 'Coffee Lounge & Bar', 'Bersantai di coffee lounge kami dengan kopi & teh pilihan, atau nikmati cocktail & minuman premium di bar kami yang sempurna', 'coffebar.png'),
(7, 'Kolam Renang', 'Nikmati kolam renang jernih dengan area dewasa & anak, kursi santai, dan layanan minuman. Nyaman untuk seluruh keluarga!', 'poolwo.jpg'),
(8, 'Ruang Meeting', 'Hotel Aloha punya ruang meeting & ballroom modern untuk acara bisnis, lengkap dengan AV canggih, Wi-Fi cepat, dan katering profesional', 'meeting.png'),
(11, 'olahraga 2', 'Nikmati kolam renang jernih dengan area dewasa & anak, kursi santai, dan layanan minuman. Nyaman untuk seluruh keluarga!', 'meeting.png');

-- --------------------------------------------------------

--
-- Table structure for table `reservasi_pelanggan`
--

CREATE TABLE `reservasi_pelanggan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_pemesan` varchar(200) NOT NULL,
  `email` varchar(150) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `nama_tamu` varchar(200) NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `jml_kamar` int(3) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `status` enum('menunggu','selesai check in','selesai check out','dibatalkan') NOT NULL DEFAULT 'menunggu',
  `id_kamar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservasi_pelanggan`
--

INSERT INTO `reservasi_pelanggan` (`id`, `user_id`, `nama_pemesan`, `email`, `no_hp`, `nama_tamu`, `tgl_pesan`, `checkin`, `checkout`, `jml_kamar`, `total_harga`, `status`, `id_kamar`) VALUES
(1, 3, 'user', 'jay@gmail.com', '0878739393', 'windah', '2025-04-02 00:17:59', '2025-04-02', '2025-04-04', 2, 0, 'dibatalkan', 3),
(7, 11, 'maulana', 'maulana@gmail.com', '0878739888', 'maulana', '2025-04-14 15:10:20', '2025-04-14', '2025-04-16', 3, 1500000, 'selesai check in', 1),
(8, 10, 'arini', 'arini@gmail.com', '0878739393', 'arin', '2025-04-14 16:26:57', '2025-04-10', '2025-04-11', 1, 600000, 'selesai check out', 3),
(10, 3, 'user', 'jay@gmail.com', '0878739000', 'luffy', '2025-04-14 19:11:40', '2025-04-14', '2025-04-16', 10, 5000000, 'dibatalkan', 1),
(11, 12, 'rangga', 'rangga@gmail.com', '0878739888', 'rangga', '2025-04-14 20:01:41', '2025-04-19', '2025-04-21', 2, 1000000, 'selesai check out', 1),
(12, 13, 'suci', 'suci@gmail.com', '0878739393', 'sucii', '2025-04-14 20:54:12', '2025-04-28', '2025-04-29', 4, 1400000, 'selesai check in', 4),
(25, 3, 'user', 'jay@gmail.com', '0878739888', 'jaeno', '2025-04-15 23:23:52', '2025-04-15', '2025-04-16', 1, 500000, 'dibatalkan', 1),
(26, 14, 'laura', 'laura@gmail.com', '0878739888', 'laura', '2025-04-15 23:30:09', '2025-04-15', '2025-04-18', 2, 4200000, 'selesai check out', 4),
(27, 15, 'Laura', 'lalaura@gmail.com', '0878737878', 'laura dua', '2025-04-15 23:34:34', '2025-04-20', '2025-04-22', 2, 2400000, 'dibatalkan', 3),
(28, 3, 'user', 'jay@gmail.com', '0878739888', 'maulana', '2025-04-17 05:58:32', '2025-04-16', '2025-04-17', 1, 500000, 'menunggu', 1),
(29, 15, 'Laura', 'lalaura@gmail.com', '0878739393', 'alala', '2025-04-17 13:20:18', '2025-04-17', '2025-04-20', 1, 1500000, 'selesai check out', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kamar`
--

CREATE TABLE `tb_kamar` (
  `id_kamar` int(11) NOT NULL,
  `nama_kamar` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `total_kamar` int(11) NOT NULL,
  `detail_kamar` text NOT NULL,
  `kapasitas` varchar(250) NOT NULL,
  `gambar` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_kamar`
--

INSERT INTO `tb_kamar` (`id_kamar`, `nama_kamar`, `harga`, `deskripsi`, `total_kamar`, `detail_kamar`, `kapasitas`, `gambar`) VALUES
(1, 'Standard Room', 500000, 'Nikmati kenyamanan menginap di Standard Room, pilihan sempurna bagi wisatawan yang mencari keseimbangan antara harga terjangkau dan fasilitas yang memadai.', 23, 'Ukuran Kasur: Queen / Twin Bed Luas Kamar: ± 18-22 m² Lokasi: Tersedia di lantai 1 dan 2', '2 orang', 'standarroom.jpg'),
(3, 'Deluxe Room', 600000, 'Rasakan pengalaman menginap yang lebih mewah di Deluxe Room, pilihan ideal bagi Anda yang menginginkan kenyamanan ekstra dengan fasilitas yang lebih lengkap.', 15, 'Ukuran Kasur: King / Queen Bed Luas Kamar: ± 26-32 m² Lokasi: Tersedia di lantai 3 dan 4', '2 dan 3 orang', 'deluxeroom.jpg'),
(4, 'Family Room ', 700000, 'Ciptakan momen berharga bersama keluarga di Family Room, ruang luas dengan fasilitas nyaman yang dirancang untuk kebersamaan dan kenyamanan seluruh anggota keluarga.', 15, 'Ukuran Kasur: 2 Queen Bed / 1 King + 1 Twin Luas Kamar: ± 32-40 m² Lokasi: Tersedia di lantai 4 dan 5', '4 orang', 'familyroom.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tipe_fasilitas`
--

CREATE TABLE `tipe_fasilitas` (
  `id` int(11) NOT NULL,
  `tipe_fasilitas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipe_fasilitas`
--

INSERT INTO `tipe_fasilitas` (`id`, `tipe_fasilitas`) VALUES
(1, 'kolam renang'),
(2, 'Smart TV '),
(3, 'Smart TV Akses Premium'),
(4, 'Welcome Snack & Welcome Drink'),
(5, 'Lemari Kecil'),
(6, 'AC dengan kontrol suhu'),
(7, 'Alat Mandi');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('admin','resepsionis','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 'alana@gmail.com', 'admin'),
(2, 'resepsionis', '827ccb0eea8a706c4c34a16891f84e7b', 'janice@gmail.com', 'resepsionis'),
(3, 'user', '827ccb0eea8a706c4c34a16891f84e7b', 'jay@gmail.com', 'user'),
(4, 'naomi', '827ccb0eea8a706c4c34a16891f84e7b', 'naomi@gmail.com', 'user'),
(5, 'nia', '93bbf2e9b77c62fa6a69dc53c7297ee0', 'nia@gmail.com', 'user'),
(6, 'lalauser', '827ccb0eea8a706c4c34a16891f84e7b', 'lala02@gmail.com', 'user'),
(7, 'aip', '3354045a397621cd92406f1f98cde292', 'ips@gmail.com', 'user'),
(8, 'nia', '5c25da85bbf7dc1b323e8244244457e7', 'ninia@gmail.com', 'user'),
(9, 'Alice', '827ccb0eea8a706c4c34a16891f84e7b', 'alice@gmail.com', 'user'),
(10, 'arini', '827ccb0eea8a706c4c34a16891f84e7b', 'arini@gmail.com', 'user'),
(11, 'maulana', '25f9e794323b453885f5181f1b624d0b', 'maulana@gmail.com', 'user'),
(12, 'rangga', '827ccb0eea8a706c4c34a16891f84e7b', 'rangga@gmail.com', 'user'),
(13, 'suci', '827ccb0eea8a706c4c34a16891f84e7b', 'suci@gmail.com', 'user'),
(14, 'laura', '827ccb0eea8a706c4c34a16891f84e7b', 'laura@gmail.com', 'user'),
(15, 'Laura', '827ccb0eea8a706c4c34a16891f84e7b', 'lalaura@gmail.com', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fasilitas_kamar`
--
ALTER TABLE `fasilitas_kamar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kamar` (`id_kamar`);

--
-- Indexes for table `fasilitas_umum`
--
ALTER TABLE `fasilitas_umum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservasi_pelanggan`
--
ALTER TABLE `reservasi_pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kamar` (`id_kamar`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tb_kamar`
--
ALTER TABLE `tb_kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `tipe_fasilitas`
--
ALTER TABLE `tipe_fasilitas`
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
-- AUTO_INCREMENT for table `fasilitas_kamar`
--
ALTER TABLE `fasilitas_kamar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `fasilitas_umum`
--
ALTER TABLE `fasilitas_umum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `reservasi_pelanggan`
--
ALTER TABLE `reservasi_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `tb_kamar`
--
ALTER TABLE `tb_kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tipe_fasilitas`
--
ALTER TABLE `tipe_fasilitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `fasilitas_kamar`
--
ALTER TABLE `fasilitas_kamar`
  ADD CONSTRAINT `fasilitas_kamar_ibfk_1` FOREIGN KEY (`id_kamar`) REFERENCES `tb_kamar` (`id_kamar`) ON DELETE CASCADE;

--
-- Constraints for table `reservasi_pelanggan`
--
ALTER TABLE `reservasi_pelanggan`
  ADD CONSTRAINT `reservasi_pelanggan_ibfk_1` FOREIGN KEY (`id_kamar`) REFERENCES `tb_kamar` (`id_kamar`),
  ADD CONSTRAINT `reservasi_pelanggan_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

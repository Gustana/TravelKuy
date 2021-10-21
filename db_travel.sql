-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2021 at 08:00 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_travel`
--

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `id_tiket` int(5) NOT NULL,
  `id_user` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_tiket` int(2) NOT NULL,
  `id_wisata` int(5) NOT NULL,
  `total_harga` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`id_tiket`, `id_user`, `tanggal`, `jumlah_tiket`, `id_wisata`, `total_harga`) VALUES
(16, 6, '2021-10-22', 3, 2, 30000),
(17, 6, '2021-10-30', 8, 2, 80000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(5) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(225) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `usia` int(2) NOT NULL,
  `jenis_kelamin` tinyint(1) NOT NULL COMMENT '1:L, 2:P',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=not activated yet, 1=activated'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `pass`, `nama`, `usia`, `jenis_kelamin`, `status`) VALUES
(6, 'gustana@gmail.com', '$2y$10$XphY/MGtUusmc8ketWIuauyt2usYQmKeZjbMHZM.CsqrYBjgIyrX6', 'gustanaa', 20, 1, 1),
(38, 'lalalelee99@gmail.com', '$2y$10$XphY/MGtUusmc8ketWIuauyt2usYQmKeZjbMHZM.CsqrYBjgIyrX6', 'satiawan', 22, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wisata`
--

CREATE TABLE `wisata` (
  `id_wisata` int(5) NOT NULL,
  `nama_wisata` varchar(50) NOT NULL,
  `lokasi_wisata` varchar(100) NOT NULL,
  `harga_wisata` float NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wisata`
--

INSERT INTO `wisata` (`id_wisata`, `nama_wisata`, `lokasi_wisata`, `harga_wisata`, `lat`, `lng`, `picture`) VALUES
(2, 'Pantai Sanure', 'Denpasar, Bali', 10000, -8.8104175, 115.1654099, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id_tiket`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_wisata` (`id_wisata`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `wisata`
--
ALTER TABLE `wisata`
  ADD PRIMARY KEY (`id_wisata`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id_tiket` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `wisata`
--
ALTER TABLE `wisata`
  MODIFY `id_wisata` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tiket`
--
ALTER TABLE `tiket`
  ADD CONSTRAINT `tiket_ibfk_1` FOREIGN KEY (`id_wisata`) REFERENCES `wisata` (`id_wisata`),
  ADD CONSTRAINT `tiket_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

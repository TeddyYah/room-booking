-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Nov 2022 pada 21.34
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `room-booking`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `fullname` varchar(35) NOT NULL,
  `email_pj` varchar(50) NOT NULL,
  `image` varchar(128) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `password` text DEFAULT NULL,
  `id_role` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `id_ps` int(11) NOT NULL,
  `jumlah_booking` int(11) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `fullname`, `email_pj`, `image`, `username`, `password`, `id_role`, `is_active`, `id_ps`, `jumlah_booking`, `created_at`) VALUES
(1, 'Super Admin', 'superadmin@gmail.com', '2022-07-16.png', 'super-admin', '$2y$10$Wvy6RTS/pexgw69IiCeVXO7eNtBgf6CpclayLIk067prV88PtDu1q', 1, 1, 0, 0, '2022-05-03'),
(2, 'Admin', 'admin@gmail.com', NULL, 'admin', '$2y$10$kZkNU3QM9mK.mBd5aFj8I.X2tHnxV4sPibWyXSnUhz8VQwKWJQwOa', 2, 1, 0, 0, '2022-11-10'),
(3, 'User', 'user@gmail.com', NULL, 'user', '$2y$10$9XMap3/kH.Q1iPQbWpnn5.vTLGdB.hw.FQrBKHtYKlXCvilpFdcAS', 3, 1, 0, 0, '2022-11-10'),
(4, 'Client', 'client@gmail.com', NULL, 'client', '$2y$10$Pn2ntsJ/2EtCXydwhg/tDO5bpeME7GIyAAsxT5apJ9ANoiSbpILda', 4, 1, 0, 0, '2022-11-10');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Mar 2021 pada 22.00
-- Versi server: 10.4.16-MariaDB
-- Versi PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `diskusi`
--

CREATE TABLE `diskusi` (
  `kode_dis` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `kode_topik` int(11) DEFAULT NULL,
  `pertanyaan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `diskusi`
--

INSERT INTO `diskusi` (`kode_dis`, `id_user`, `kode_topik`, `pertanyaan`) VALUES
(1, 5, 5, 'Test Query'),
(2, 6, 6, 'Test'),
(3, 6, 7, 'Test 2'),
(4, 6, 5, 'Test'),
(5, 6, 4, 'Test'),
(6, 6, 7, 'Cek 1'),
(7, 7, 1, 'uban'),
(8, 6, 11, 'Kutil'),
(9, 7, 7, 'Tanya dong'),
(10, 9, 4, 'Apakah kurang tidur, tidak baik untuk kesehatan paru-paru ?'),
(11, 9, 12, 'Telinga saya, sering berdengung ketika renang ?'),
(12, 12, 8, 'Dok, anak saya mimisan, setelah minum es, mohon solusi ?'),
(13, 6, 8, 'asd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `kode_dr` int(11) NOT NULL,
  `spesialist` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`kode_dr`, `spesialist`) VALUES
(10101, 'mata'),
(10102, 'penyakit_dalam'),
(10103, 'jantung'),
(10104, 'paru'),
(10105, 'endokrinolog'),
(10106, 'kandungan'),
(10107, 'bedag'),
(10108, 'anak'),
(10109, 'syaraf'),
(10110, 'tulang'),
(10111, 'kulit_dan_kelamin'),
(10112, 'tht'),
(10113, 'gigi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban`
--

CREATE TABLE `jawaban` (
  `id_jawaban` int(11) NOT NULL,
  `kode_dis` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `jawaban` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jawaban`
--

INSERT INTO `jawaban` (`id_jawaban`, `kode_dis`, `id_user`, `jawaban`) VALUES
(1, 2, 2, 'Test Jawaban'),
(2, 2, 2, 'Test Jawaban 2'),
(3, 4, 3, 'Test 3'),
(4, 4, 3, 'Test 4'),
(5, 3, 4, 'Test Jawab'),
(6, 2, 4, 'Tes Jawab 3'),
(7, 1, 4, 'DW'),
(8, 1, 4, 'Coba ubah 9'),
(9, 4, 4, 'Coba'),
(10, 5, 4, 'Cek'),
(11, 5, 4, 'Oy, Oy'),
(12, 6, 4, 'Test'),
(13, 11, 10, 'Seringlah mengonsumsi makanan bergizi'),
(14, 11, 10, 'Hindari Merokok'),
(15, 12, 10, 'q'),
(16, 12, 10, '345'),
(17, 13, 10, 'vd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `level_user`
--

CREATE TABLE `level_user` (
  `kode_level` int(11) NOT NULL,
  `jenis` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `level_user`
--

INSERT INTO `level_user` (`kode_level`, `jenis`) VALUES
(101, 'expert'),
(102, 'client');

-- --------------------------------------------------------

--
-- Struktur dari tabel `topik`
--

CREATE TABLE `topik` (
  `kode_topik` int(11) NOT NULL,
  `bidang` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `topik`
--

INSERT INTO `topik` (`kode_topik`, `bidang`) VALUES
(1, 'Kesehatan Mata'),
(2, 'Penyakit Dalam'),
(3, 'Kesehatan Jantung'),
(4, 'Kesehatan Paru-paru'),
(5, 'Endokrinolog'),
(6, 'Kesehatan Kandungan'),
(7, 'bedah'),
(8, 'Kesehatan Anak'),
(9, 'Syaraf'),
(10, 'Tulang'),
(11, 'Kesehatan Kulit dan Kelamin'),
(12, 'Kesehatan Telingan Hidung dan Tenggorokan'),
(13, 'Gigi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `kode_level` int(11) NOT NULL,
  `kode_dr` int(11) DEFAULT NULL,
  `nama` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `email` varchar(25) NOT NULL,
  `tempat_praktik` varchar(125) DEFAULT NULL,
  `deskripsi` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `kode_level`, `kode_dr`, `nama`, `username`, `password`, `no_hp`, `email`, `tempat_praktik`, `deskripsi`) VALUES
(1, 101, 10109, 'Asfani Rahmatullah1', 'Buronan Pasien ^_^', '9fc82759b24a291243bb4223b96560dc812c15955c796259737a86f0f5573b98', '12345678901', 'asfanirahmat456@gmail.com', 'Klinik Setia 2', 'Seorang Dokter yang apa adanya'),
(2, 101, 10104, 'Asfani', 'Nagiichi', '42af38850243a942950ee35fec9333962fc380edc21fe1112d177e1132db6b97', '12345678901', '1@gmail.com', 'Klinik Setia 2', 'asd'),
(3, 101, 10101, 'Asfani Rahmatullah', 'Dokter Gadungan', '095b56fb5e6cf1a63e010e9fdac01ee413d80401c14dd17a3fcfe81aa760b11f', '12345678901', '12@gmail.com', 'Klinik Setia 2', 'Dokter Gadungan'),
(4, 101, 10101, 'Asfani Rahmatullah', 'Nagiichi.Jr', '42af38850243a942950ee35fec9333962fc380edc21fe1112d177e1132db6b97', '12345678901', '123@gmail.com', 'Klinik Setia 2', 'Cek'),
(5, 102, NULL, 'Asfani Rahmatullah5', 'Client test', '42af38850243a942950ee35fec9333962fc380edc21fe1112d177e1132db6b97', '12345678901', '4@gmail.com', NULL, 'Client_test'),
(6, 102, NULL, 'Asfani Rahmatullah 8', 'Test_Client', '42af38850243a942950ee35fec9333962fc380edc21fe1112d177e1132db6b97', '12345678901', '5@gmail.com', NULL, 'Client Test'),
(7, 102, NULL, 'Client TestX', 'Client TestX', '42af38850243a942950ee35fec9333962fc380edc21fe1112d177e1132db6b97', '12345678901', '17@gmail.com', NULL, 'Test Edit'),
(8, 102, NULL, 'Client finish', 'Client finish', '42af38850243a942950ee35fec9333962fc380edc21fe1112d177e1132db6b97', '12345678901', '97@gmail.com', NULL, 'Finishing'),
(9, 102, NULL, 'Finish', 'Finish', '42af38850243a942950ee35fec9333962fc380edc21fe1112d177e1132db6b97', '12345678901', 'as@gmail.com', NULL, 'Lancar'),
(10, 101, 10101, 'Final', 'Final', '42af38850243a942950ee35fec9333962fc380edc21fe1112d177e1132db6b97', '12345678901', '9@gmail.com', 'Klinik Kartika', '-'),
(11, 101, 10101, 'Mahfud Rian setiawan', 'dr. Arif', '77361456f47982f210558fce3e9b2a3baae535f989f347cab6e80483ba5f9cb0', '08522222222', 'dokarif@gmail.com', 'RSUD Socah', 'Bertempat tinggal di Telang'),
(12, 102, NULL, 'Arif Rian Setiawan', 'Arif ^_^', '77361456f47982f210558fce3e9b2a3baae535f989f347cab6e80483ba5f9cb0', '08522222222', 'arif@gmail.com', NULL, '-'),
(13, 101, 10103, 'XXX', 'XXX', '123fddthft', '0004574853434', 'a@g.com', '-', '-');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `diskusi`
--
ALTER TABLE `diskusi`
  ADD PRIMARY KEY (`kode_dis`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `kode_topik` (`kode_topik`);

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`kode_dr`);

--
-- Indeks untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `kode_dis` (`kode_dis`);

--
-- Indeks untuk tabel `level_user`
--
ALTER TABLE `level_user`
  ADD PRIMARY KEY (`kode_level`);

--
-- Indeks untuk tabel `topik`
--
ALTER TABLE `topik`
  ADD PRIMARY KEY (`kode_topik`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `kode_dr` (`kode_dr`),
  ADD KEY `kode_level` (`kode_level`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `diskusi`
--
ALTER TABLE `diskusi`
  MODIFY `kode_dis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `kode_dr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10114;

--
-- AUTO_INCREMENT untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `level_user`
--
ALTER TABLE `level_user`
  MODIFY `kode_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT untuk tabel `topik`
--
ALTER TABLE `topik`
  MODIFY `kode_topik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `diskusi`
--
ALTER TABLE `diskusi`
  ADD CONSTRAINT `diskusi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `diskusi_ibfk_2` FOREIGN KEY (`kode_topik`) REFERENCES `topik` (`kode_topik`);

--
-- Ketidakleluasaan untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `jawaban_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `jawaban_ibfk_2` FOREIGN KEY (`kode_dis`) REFERENCES `diskusi` (`kode_dis`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`kode_dr`) REFERENCES `dokter` (`kode_dr`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`kode_level`) REFERENCES `level_user` (`kode_level`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

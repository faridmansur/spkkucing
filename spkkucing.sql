-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 22 Jul 2024 pada 20.33
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spkkucing`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`username`, `password`, `nama_lengkap`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator'),
('mahmud', '21232f297a57a5a743894a0e4a801fc3', 'Mahmud Zakaria Alfarozi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `basis_pengetahuan`
--

CREATE TABLE `basis_pengetahuan` (
  `kode_pengetahuan` int(11) NOT NULL,
  `kode_penyakit` int(11) NOT NULL,
  `kode_gejala` int(11) NOT NULL,
  `mb` double(11,1) NOT NULL,
  `md` double(11,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `basis_pengetahuan`
--

INSERT INTO `basis_pengetahuan` (`kode_pengetahuan`, `kode_penyakit`, `kode_gejala`, `mb`, `md`) VALUES
(2, 1, 12, 0.8, 0.0),
(3, 1, 23, 0.6, 0.2),
(4, 1, 24, 1.0, 0.0),
(5, 2, 1, 0.4, 0.2),
(6, 2, 3, 1.0, 0.2),
(7, 2, 15, 1.0, 0.0),
(8, 2, 21, 1.0, 0.0),
(9, 3, 13, 0.6, 0.2),
(10, 3, 14, 1.0, 0.0),
(11, 3, 19, 0.6, 0.2),
(12, 3, 25, 1.0, 0.0),
(13, 4, 1, 0.4, 0.2),
(14, 4, 2, 0.4, 0.2),
(15, 4, 4, 0.8, 0.2),
(16, 4, 10, 0.4, 0.2),
(17, 4, 11, 0.8, 0.0),
(18, 4, 20, 0.8, 0.2),
(19, 5, 1, 0.6, 0.2),
(20, 5, 16, 1.0, 0.2),
(21, 5, 23, 0.8, 0.2),
(22, 5, 28, 1.0, 0.0),
(23, 6, 6, 1.0, 0.2),
(24, 6, 9, 0.8, 0.2),
(25, 6, 10, 0.8, 0.2),
(26, 6, 30, 1.0, 0.0),
(27, 6, 31, 0.8, 0.2),
(28, 7, 1, 0.4, 0.2),
(29, 7, 32, 1.0, 0.0),
(30, 7, 38, 1.0, 0.0),
(31, 7, 39, 1.0, 0.2),
(32, 8, 2, 0.8, 0.2),
(33, 8, 18, 0.8, 0.0),
(34, 8, 29, 1.0, 0.0),
(35, 9, 1, 0.4, 0.2),
(36, 9, 5, 1.0, 0.0),
(37, 9, 9, 0.8, 0.2),
(38, 9, 40, 1.0, 0.0),
(39, 10, 1, 0.4, 0.2),
(40, 10, 2, 0.8, 0.2),
(41, 10, 22, 1.0, 0.0),
(42, 10, 41, 1.0, 0.0),
(43, 11, 2, 0.8, 0.2),
(44, 11, 36, 1.0, 0.2),
(45, 11, 37, 1.0, 0.0),
(46, 11, 42, 1.0, 0.0),
(47, 12, 1, 0.4, 0.2),
(48, 12, 17, 0.8, 0.2),
(49, 12, 35, 0.8, 0.0),
(50, 12, 43, 1.0, 0.0),
(51, 13, 7, 0.8, 0.2),
(52, 13, 8, 1.0, 0.0),
(53, 13, 26, 0.8, 0.2),
(54, 13, 27, 0.8, 0.2),
(55, 13, 33, 0.4, 0.2),
(56, 13, 34, 0.6, 0.2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gejala`
--

CREATE TABLE `gejala` (
  `kode_gejala` int(11) NOT NULL,
  `nama_gejala` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gejala`
--

INSERT INTO `gejala` (`kode_gejala`, `nama_gejala`) VALUES
(1, 'Nafsu makan berkurang '),
(2, 'Nafas sesak / megap-megap'),
(3, 'Nafas ngorok basah'),
(4, 'Bersin-bersin'),
(5, 'Batuk'),
(6, 'Bulu kusam dan berkerut'),
(7, 'Diare'),
(8, 'Produksi telur menurun'),
(9, 'Kedinginan'),
(10, 'Tampak lesu'),
(11, 'Mencret kehijau-hijauan'),
(12, 'Mencret keputih-putihan'),
(13, 'Muka pucat'),
(14, 'Nampak membiru'),
(15, 'Pembengkakan pial'),
(16, 'Jengger pucat'),
(17, 'Kaki dan sayap lumpuh'),
(18, 'Keluar cairan dari mata dan hidung'),
(19, 'Kepala bengkak'),
(20, 'Kepala terputar'),
(21, 'Pembengkakan dari sinus dan mata'),
(22, 'Perut membesar'),
(23, 'Sayap menggantung'),
(24, 'Terdapat kotoran putih menempel disekitar anus'),
(25, 'Mati secara mendadak'),
(26, 'Kerabang telur kasar'),
(27, 'Putih Telur Encer'),
(28, 'Kotoran kuning kehijauan'),
(29, 'Pembengkakan daerah fasial dan sekitar mata'),
(30, 'Kotoran atau feses berdarah'),
(31, 'Bergerombol di sudut kandang'),
(32, 'Mematuk daerah kloaka'),
(33, 'Kerabang telur pucat'),
(34, 'Telur lebih kecil'),
(35, 'Kelumpuhan pada tembolok'),
(36, 'Bernafas dengan mulut sambil menjulurkan leher'),
(37, 'Batuk berdarah'),
(38, 'Tidur paruhnya diletakkan dilantai'),
(39, 'Duduk dengan sikap membungkuk'),
(40, 'Kelihatan mengantuk dengan bulu berdiri'),
(41, 'Badan kurus'),
(42, 'Terdapat lendir bercampur darah pada rongga mulut'),
(43, 'Kaki pincang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `tanggal` varchar(50) NOT NULL DEFAULT '0',
  `penyakit` text NOT NULL,
  `gejala` text NOT NULL,
  `hasil_id` int(11) NOT NULL,
  `hasil_nilai` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kondisi`
--

CREATE TABLE `kondisi` (
  `id` int(11) NOT NULL,
  `kondisi` varchar(64) NOT NULL,
  `ket` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kondisi`
--

INSERT INTO `kondisi` (`id`, `kondisi`, `ket`) VALUES
(1, 'Pasti ya', ''),
(2, 'Hampir pasti ya', ''),
(3, 'Kemungkinan besar ya', ''),
(4, 'Mungkin ya', ''),
(5, 'Tidak tahu', ''),
(6, 'Mungkin tidak', ''),
(7, 'Kemungkinan besar tidak', ''),
(8, 'Hampir pasti tidak', ''),
(9, 'Pasti tidak', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyakit`
--

CREATE TABLE `penyakit` (
  `kode_penyakit` int(11) NOT NULL,
  `nama_penyakit` varchar(50) NOT NULL,
  `det_penyakit` varchar(500) NOT NULL,
  `srn_penyakit` varchar(500) NOT NULL,
  `gambar` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `post`
--

CREATE TABLE `post` (
  `kode_post` int(11) NOT NULL,
  `nama_post` varchar(50) NOT NULL,
  `det_post` text NOT NULL,
  `srn_post` text NOT NULL,
  `gambar` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `basis_pengetahuan`
--
ALTER TABLE `basis_pengetahuan`
  ADD PRIMARY KEY (`kode_pengetahuan`);

--
-- Indeks untuk tabel `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`kode_gejala`);

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indeks untuk tabel `kondisi`
--
ALTER TABLE `kondisi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`kode_penyakit`);

--
-- Indeks untuk tabel `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`kode_post`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `basis_pengetahuan`
--
ALTER TABLE `basis_pengetahuan`
  MODIFY `kode_pengetahuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT untuk tabel `gejala`
--
ALTER TABLE `gejala`
  MODIFY `kode_gejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;

--
-- AUTO_INCREMENT untuk tabel `kondisi`
--
ALTER TABLE `kondisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `kode_penyakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `post`
--
ALTER TABLE `post`
  MODIFY `kode_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Apr 2026 pada 09.06
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus_fahri`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `pengarang` varchar(100) DEFAULT NULL,
  `penerbit` varchar(100) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id`, `judul`, `pengarang`, `penerbit`, `tahun`, `stok`) VALUES
(2, 'si kancil', 'hady situmorang', 'asep', 2017, 0),
(3, 'Dan Bandung', 'efway', 'ujang', 2026, 0),
(8, 'kjdwh', 'hndiuehf', NULL, NULL, 0),
(9, 'jawsj', 'mjcjc', NULL, NULL, 0),
(11, 'Dan Bandung GG', 'DWI', NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `buku_id` int(11) DEFAULT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('pinjam','kembali') DEFAULT NULL,
  `denda` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `user_id`, `buku_id`, `tanggal_pinjam`, `tanggal_kembali`, `status`, `denda`) VALUES
(3, 2, 1, '2026-04-09', '2026-04-09', 'kembali', 0),
(4, 2, 2, '2026-04-09', '2026-04-10', 'kembali', 0),
(5, 2, 1, '2026-04-09', '2026-04-09', 'kembali', 0),
(6, 2, 1, '2026-04-10', '2026-04-10', 'kembali', 0),
(7, 15, 3, '2026-04-10', '2026-04-10', 'kembali', 0),
(9, 15, 2, '2026-04-10', NULL, 'pinjam', 0),
(10, 15, 2, '2026-04-10', '2026-04-11', 'kembali', 0),
(11, 15, 3, '2026-04-10', NULL, 'pinjam', 0),
(12, 15, 8, '2026-04-10', '2026-04-11', 'kembali', 0),
(14, 15, 1, '2026-04-10', '2026-04-11', 'kembali', 0),
(15, 15, 10, '2026-04-10', '2026-04-11', 'kembali', 0),
(16, 18, 11, '2026-04-11', '2026-04-11', 'kembali', 0),
(17, 18, 2, '2026-04-12', '2026-04-12', 'kembali', 0),
(18, 18, 11, '2026-04-12', '2026-04-12', 'kembali', 0),
(19, 18, 8, '2026-04-12', '2026-04-12', 'kembali', 0),
(20, 18, 8, '2026-04-12', '2026-04-12', 'kembali', 0),
(21, 18, 11, '2026-04-12', '2026-04-12', 'kembali', 0),
(22, 18, 9, '2026-04-12', '2026-04-12', 'kembali', 0),
(23, 18, 2, '2026-04-12', NULL, 'pinjam', 0),
(24, 18, 8, '2026-04-12', NULL, 'pinjam', 0),
(25, 18, 8, '2026-04-12', NULL, 'pinjam', 0),
(26, 18, 9, '2026-04-13', NULL, 'pinjam', 0),
(27, 19, 11, '2026-04-13', NULL, 'pinjam', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `jurusan` varchar(100) DEFAULT NULL,
  `kontak` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`, `kelas`, `jurusan`, `kontak`, `alamat`, `avatar`) VALUES
(1, 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'admin', NULL, NULL, NULL, NULL, NULL),
(14, 'HJDHBCKHBD', 'PPPPPPP', '$2y$10$lrI90hWIkn/QpQVZXG9lQezgLtG7hNLxyWK/0v4N4WOL2NOrB9rJe', 'user', 'XII', 'pplg', '08400834080348', 'JL.kebangsaan No 81 Rt 02 Rw 04', NULL),
(16, 'arief rama dani', 'dani', '$2y$10$vhdEI0DwmaMOH3fB8WecZ.644nC3kZtCfZDUVpv2H4BJyEgWN3t5.', 'user', 'XII', 'TKJ', '0897653998', 'jl.kp CIPAYUNG', NULL),
(17, 'NOUFAL', 'ARFANWER', '$2y$10$tstWQ.q51SqWnYJmH/zhAeHyoWiAzqP9HZXjvgbKxbFovB/iYkN7i', 'user', 'XII', 'RPL', '0890900098', 'JL.KPKPKPP', NULL),
(18, 'fajar dwi ananta', 'FAJAR', '202cb962ac59075b964b07152d234b70', 'user', 'XII', 'AKL', '08976543776', 'JL.Haji Salim', 'https://api.dicebear.com/7.x/big-smile/svg?seed=18'),
(19, 'tara akbar', 'ata', '202cb962ac59075b964b07152d234b70', 'user', 'XII', 'TKJ', '087656435664', 'JL.H.Salim No.21 rt02/04', 'https://api.dicebear.com/7.x/avataaars/svg?seed=19');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Apr 2026 pada 11.59
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
(12, 'Ambisi', 'efway', NULL, NULL, -2),
(13, 'Sangkuriang', 'abdul', NULL, NULL, 0),
(14, 'Bawang Merah', 'lala', NULL, NULL, 5),
(15, 'Pemrograman Web', 'fahri', NULL, NULL, 3),
(16, 'asal', 'dwi', NULL, NULL, 2),
(17, 'si kancil', 'galang', NULL, NULL, 3),
(18, 'buku baru', 'effway', NULL, NULL, 4),
(19, 'Roro Kidul', 'suep', NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `buku_id` int(11) DEFAULT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_konfirmasi` datetime DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `denda` int(11) DEFAULT 0,
  `expired_at` datetime DEFAULT NULL,
  `status` enum('menunggu','disetujui','ditolak','dikembalikan') DEFAULT 'menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `user_id`, `buku_id`, `tanggal_pinjam`, `tanggal_konfirmasi`, `tanggal_kembali`, `admin_id`, `denda`, `expired_at`, `status`) VALUES
(6, 2, 1, '2026-04-10', NULL, '2026-04-10', NULL, 0, NULL, 'menunggu'),
(7, 15, 3, '2026-04-10', NULL, '2026-04-10', NULL, 0, NULL, 'menunggu'),
(9, 15, 2, '2026-04-10', NULL, NULL, NULL, 0, NULL, 'menunggu'),
(11, 15, 3, '2026-04-10', NULL, NULL, NULL, 0, NULL, 'menunggu'),
(12, 15, 8, '2026-04-10', NULL, '2026-04-11', NULL, 0, NULL, 'menunggu'),
(14, 15, 1, '2026-04-10', NULL, '2026-04-11', NULL, 0, NULL, 'menunggu'),
(15, 15, 10, '2026-04-10', NULL, '2026-04-11', NULL, 0, NULL, 'menunggu'),
(16, 18, 11, '2026-04-11', NULL, '2026-04-11', NULL, 0, NULL, 'menunggu'),
(17, 18, 2, '2026-04-12', NULL, '2026-04-12', NULL, 0, NULL, 'menunggu'),
(18, 18, 11, '2026-04-12', NULL, '2026-04-12', NULL, 0, NULL, 'menunggu'),
(19, 18, 8, '2026-04-12', NULL, '2026-04-12', NULL, 0, NULL, 'menunggu'),
(20, 18, 8, '2026-04-12', NULL, '2026-04-12', NULL, 0, NULL, 'menunggu'),
(21, 18, 11, '2026-04-12', NULL, '2026-04-12', NULL, 0, NULL, 'menunggu'),
(22, 18, 9, '2026-04-12', NULL, '2026-04-12', NULL, 0, NULL, 'menunggu'),
(23, 18, 2, '2026-04-12', NULL, NULL, NULL, 0, NULL, 'menunggu'),
(24, 18, 8, '2026-04-12', NULL, NULL, NULL, 0, NULL, 'menunggu'),
(25, 18, 8, '2026-04-12', NULL, NULL, NULL, 0, NULL, 'menunggu'),
(26, 18, 9, '2026-04-13', NULL, NULL, NULL, 0, NULL, 'menunggu'),
(27, 19, 11, '2026-04-13', NULL, NULL, NULL, 0, NULL, 'menunggu'),
(28, 21, 11, '2026-04-15', NULL, '2026-04-15', NULL, 0, NULL, 'menunggu'),
(29, 21, 12, '2026-04-15', NULL, NULL, NULL, 0, NULL, 'menunggu'),
(30, 18, 3, '2026-04-15', NULL, NULL, NULL, 0, NULL, 'menunggu'),
(31, 18, 3, '2026-04-16', NULL, NULL, NULL, 0, NULL, 'menunggu'),
(32, 22, 15, '2026-04-16', NULL, '2026-04-16', NULL, 0, NULL, 'menunggu'),
(33, 22, 12, '2026-04-16', NULL, '2026-04-16', NULL, 0, NULL, 'menunggu'),
(34, 19, 3, '2026-04-16', NULL, NULL, NULL, 0, NULL, 'menunggu'),
(36, 22, 11, '2026-04-16', NULL, NULL, NULL, 0, NULL, 'menunggu'),
(37, 22, 11, '2026-04-17', '2026-04-17 04:43:11', NULL, 1, 0, NULL, 'menunggu'),
(38, 22, 12, '2026-04-17', '2026-04-17 05:00:29', NULL, 1, 0, NULL, 'menunggu'),
(39, 27, 13, '2026-04-17', '2026-04-17 04:52:48', NULL, 1, 0, NULL, 'menunggu'),
(40, 27, 12, '2026-04-17', '2026-04-17 05:02:31', NULL, 1, 0, NULL, 'menunggu'),
(41, 27, 12, '2026-04-17', '2026-04-17 05:10:07', NULL, 1, 0, NULL, 'menunggu'),
(42, 27, 14, '2026-04-17', '2026-04-17 05:12:59', NULL, 1, 0, NULL, 'menunggu'),
(43, 22, 16, '2026-04-17', '2026-04-17 06:30:03', NULL, 1, 0, NULL, 'menunggu'),
(44, 28, 11, '2026-04-17', NULL, NULL, NULL, 0, NULL, 'menunggu'),
(45, 28, 12, '2026-04-17', '2026-04-17 09:05:01', NULL, 1, 0, NULL, 'menunggu'),
(46, 28, 13, '2026-04-17', '2026-04-17 09:24:44', NULL, 1, 0, NULL, 'menunggu'),
(47, 31, 13, '2026-04-17', '2026-04-17 09:34:47', NULL, 1, 0, NULL, 'menunggu'),
(48, 31, 14, '2026-04-17', NULL, NULL, NULL, 0, NULL, 'menunggu'),
(49, 31, 14, '2026-04-17', NULL, NULL, NULL, 0, NULL, '');

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
(1, 'Admin', 'admin', '$2y$10$qIPz1pSdMHHWVPrugKMvzeNxjKQEYhqqNf6Xh56t8HkqCMDH2HAD.', 'admin', NULL, NULL, NULL, NULL, NULL),
(14, 'Michael', 'PPPPPPP', '$2y$10$lrI90hWIkn/QpQVZXG9lQezgLtG7hNLxyWK/0v4N4WOL2NOrB9rJe', 'user', 'XII', 'akl', '08400834080348', 'JL.kebangsaan No 81 Rt 02 Rw 04', NULL),
(18, 'fajar dwi ananta', 'FAJAR', '$2y$10$Iff3h.RfXSo00u1baCgpOeoy8SDNow6fzyVqyq65.94NfFS0zriOq', 'user', 'XII', 'AKL', '08976543776', 'JL.Haji Salim', 'https://api.dicebear.com/7.x/big-smile/svg?seed=18'),
(19, 'tara akbar', 'ata', '202cb962ac59075b964b07152d234b70', 'user', 'XII', 'TKJ', '087656435664', 'JL.H.Salim No.21 rt02/04', 'https://api.dicebear.com/7.x/avataaars/svg?seed=19'),
(21, 'FAJAR', 'FAJAR123', '$2y$10$5kSdoMuTr6bRBXlCisFJ.erPXAZipX6aPJI43hZugulBmLmugqL9e', 'user', 'XII', 'PPLG', '08976542', 'jl.hjdqkj', NULL),
(22, 'Hadyyy', 'Hady Doang', '202cb962ac59075b964b07152d234b70', 'user', 'XII', 'Mesin', '089765453662', 'Serab onlyy', NULL),
(23, 'fazlan', 'elan123', '$2y$10$8y6A/Kx.k.Q7gyNR5wo76eyqRGJU7JrKB5UgG7IxTiVOozBoi3QZ.', 'user', 'XII', 'tkj', '0890900098', 'JL/KP CIPayujng', NULL),
(24, 'fahriwiradana', 'fahri123', '$2y$10$ah4bMUlyz0CTXuAzuePw1ehrmSxSWYxEWRCE4Wa7shUbvszAYSeVq', 'user', 'XII', 'AKL', '08976543776', 'jlnlisdjlic', NULL),
(25, 'hadyyyyyyy', 'hady doanggg ', '827ccb0eea8a706c4c34a16891f84e7b', 'user', 'XII', 'AKL', '0897653998', 'jlklfjlkf', NULL),
(26, 'dwii', 'dwi12345', '$2y$10$uTMLMouV8/w.Hob4ZgRSm.9NVKa01UNp71q9oFfz6guM7B1MjO4n2', 'user', 'XII', 'tkj', '8093048808', 'jhldls;m', NULL),
(27, 'Michael', 'michael123', '827ccb0eea8a706c4c34a16891f84e7b', 'user', 'XII', 'Mesin', '9039209049', 'mjwdlmqwldm', NULL),
(28, 'HAHDH', 'AHAHAH', '$2y$10$hL4xzGTMKtf.pJHWrC7tpONk3vxj7.4Mfi9WHovPqkrB.mVMIdJvG', 'user', 'XII', 'pplg', '8093048808', 'YUGAYJAGBDJ', NULL),
(30, 'SYADAT HAIKAL', 'Ketel123', '$2y$10$wcatiuCYYSo4kY7peFdFMeOGFCNVELcXMJJSK9CK8tQ03kOotokZC', 'user', 'XII', 'pplg', '08976543776', 'ljwedlkjd', NULL),
(31, 'suepppp', 'asepp123', '$2y$10$fb7RlU7S8ILiBLqUQzbTCe1cxs6HI.CLd39cYgsPz0hY3.vx44K4K', 'user', 'XII', 'pplg', '8093048808', 'oijwefijfeow', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Feb 2021 pada 15.38
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pr`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akses`
--

CREATE TABLE `akses` (
  `akses_id` int(11) NOT NULL,
  `akses` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akses`
--

INSERT INTO `akses` (`akses_id`, `akses`) VALUES
(1, 'Administration'),
(2, 'Admin Gudang (Workshop)'),
(3, 'Supervisior (Workshop)'),
(4, 'Staf Puchasing (Kantor)'),
(5, 'Kepala Produksi (Workshop)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(11) NOT NULL,
  `id_supplier` varchar(11) NOT NULL,
  `nama` varchar(55) NOT NULL,
  `ukuran` varchar(55) NOT NULL,
  `type` varchar(55) NOT NULL,
  `stok` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `id_supplier`, `nama`, `ukuran`, `type`, `stok`, `updated_at`, `created_at`) VALUES
('BRG0000001', 'SP0000001', 'Stater Philip', '', 'C10', 120, '2020-12-14 05:50:10', '2020-10-25 00:11:35'),
('BRG0000002', 'SP0000001', 'Lamp Philips', '36w/cdl', 'TL', 110, '2020-12-14 17:07:04', '2020-10-25 00:17:42'),
('BRG0000003', 'SP0000001', 'Capasitor aid', '', '8uf', 21, '2020-12-13 22:27:08', '2020-10-25 00:18:30'),
('BRG0000004', 'SP0000001', 'Spring DownLight', '', '', 100, '2020-12-14 17:20:16', '2020-10-25 00:25:17'),
('BRG0000005', 'SP0000002', 'Fiting Per', '', '', 0, '2020-12-13 22:29:47', '2020-11-20 19:25:42'),
('BRG0000006', 'SP0000002', 'Fitting Biasa', '', '', 0, '2020-12-13 22:30:26', '2020-11-26 07:04:36'),
('BRG0000007', 'SP0000002', 'Fitting Stater', '', '', 0, '2020-12-13 22:31:13', '2020-12-13 22:31:13'),
('BRG0000008', 'SP0000002', 'Slongsong', '8mm', '', 0, '2020-12-13 22:31:34', '2020-12-13 22:31:34'),
('BRG0000009', 'SP0000002', 'Kabel Ties', '', '', 0, '2020-12-13 22:31:53', '2020-12-13 22:31:53'),
('BRG0000010', 'SP0000002', 'Kain Lap Majun', '', '', 0, '2020-12-13 22:32:35', '2020-12-13 22:32:35'),
('BRG0000011', 'SP0000002', 'Sarung Tangan', '', '', 0, '2020-12-13 22:33:02', '2020-12-13 22:33:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_user`
--

CREATE TABLE `log_user` (
  `id_user` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `username` varchar(22) NOT NULL,
  `password` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_user`
--

INSERT INTO `log_user` (`id_user`, `nik`, `username`, `password`) VALUES
(1, '320136080299001', 'admin', 'admin'),
(2, '22222222222222', 'tika', '123456'),
(3, '32123123123123', 'angel', '123456'),
(4, '33333333333333', 'lee', '123456'),
(5, '444444444444444', 'supriatna', '123456');

-- --------------------------------------------------------

--
-- Struktur dari tabel `request_item`
--

CREATE TABLE `request_item` (
  `id` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `user` varchar(55) NOT NULL,
  `status` varchar(1) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `disetujui` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `request_item`
--

INSERT INTO `request_item` (`id`, `keterangan`, `user`, `status`, `updated_at`, `created_at`, `disetujui`) VALUES
(18, 'Kebutuhan PT. X', 'Tika', '5', '2020-12-14 05:50:09', '2020-12-13 22:38:40', 'Supriatna'),
(19, 'kebutuhan pt. x', 'Tika', '5', '2020-12-14 17:07:04', '2020-12-14 10:02:17', 'Supriatna'),
(20, 'Untuk kebutuhan PT. Y', 'Tika', '5', '2020-12-14 17:20:16', '2020-12-14 10:14:13', 'Supriatna'),
(21, 'ksakd', 'yusup Fey', '1', '2020-12-19 11:11:24', '2020-12-19 04:11:10', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `request_item_d`
--

CREATE TABLE `request_item_d` (
  `id` int(11) NOT NULL,
  `id_rq` int(11) NOT NULL,
  `code_item` varchar(16) NOT NULL,
  `qty` int(11) NOT NULL,
  `satuan` varchar(22) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `request_item_d`
--

INSERT INTO `request_item_d` (`id`, `id_rq`, `code_item`, `qty`, `satuan`, `keterangan`) VALUES
(29, 18, 'BRG0000001', 120, 'PCS', 'Stater Lampu'),
(30, 19, 'BRG0000002', 120, 'PCS', 'untuk penerangan'),
(31, 20, 'BRG0000004', 120, 'PCS', 'Untuk Ligting'),
(32, 21, 'BRG0000002', 120, 'PCS', 'klasdfladsj');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` varchar(11) NOT NULL,
  `supplier` varchar(55) NOT NULL,
  `alamat` text NOT NULL,
  `notel` varchar(16) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `supplier`, `alamat`, `notel`, `updated_at`, `created_at`) VALUES
('SP0000001', 'PT. Sehat Abadi', 'Jakarta', '0893848837', '2020-12-05 12:39:29', '2020-10-23 09:07:57'),
('SP0000002', 'PT. Sehat Sejahtera', 'Bogor', '089349234', '2020-10-23 09:37:00', '2020-10-23 09:37:00'),
('SP0000003', 'PT. gocirID', 'Bogor', '0892892489', '2020-10-23 22:47:34', '2020-10-23 22:47:34'),
('SP0000004', 'PT.BukaLapak.com', 'jakarta', '08984838483984', '2020-10-24 20:30:03', '2020-10-24 20:30:03'),
('SP0000005', 'PT. Sehat sejahtera cahaya', 'jonggol', '08938928839', '2020-10-24 20:32:35', '2020-10-24 20:32:35'),
('SP0000007', 'PT. medika', 'jakarta', '089393497384', '2020-10-24 21:01:01', '2020-10-24 21:01:01'),
('SP0000008', 'PT.Makmur Sentosa', 'Bogor', '089893488', '2020-10-24 21:02:26', '2020-10-24 21:02:26'),
('SP0000009', 'PT. Indofood', 'Cikuda', '08983847834', '2020-10-24 21:08:57', '2020-10-24 21:08:57'),
('SP0000010', 'PT. Samsung', 'CIkarang', '0893849838', '2020-10-24 21:12:08', '2020-10-24 21:12:08'),
('SP0000011', 'PT. Mercedes', 'Ciherang', '089382973827', '2020-10-24 21:14:12', '2020-10-24 21:14:12'),
('SP0000012', 'PT. SuryaKencana', 'Jakarata', '0892833893', '2020-10-24 21:16:45', '2020-10-24 21:16:45'),
('SP0000013', 'PT.Melia Sehat', 'jogjakarta', '089389483984', '2020-10-24 21:35:29', '2020-10-24 21:35:29'),
('SP0000014', 'PT.Melia Sehat sejahtera', 'Cirebnon', '0804893849', '2020-10-24 21:36:35', '2020-10-24 21:36:35'),
('SP0000015', 'PT. Hyunday', 'cikarang', '089834938492', '2020-10-24 21:47:00', '2020-10-24 21:47:00'),
('SP0000016', 'CV. barraqah', 'bekasi', '089283828938', '2020-10-24 21:59:02', '2020-10-24 21:59:02'),
('SP0000017', 'CV. Razzaq Berdikari', 'bekasi', '03893849383', '2020-10-24 22:00:54', '2020-10-24 22:00:54'),
('SP0000018', 'CV. KBMST', 'Tanjungsari', '0892839831', '2020-10-24 22:07:31', '2020-10-24 22:07:31'),
('SP0000019', 'PT. JS Jakarta', 'cileungsi', '08949384938', '2020-10-24 22:08:15', '2020-10-24 22:08:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `terima_barang`
--

CREATE TABLE `terima_barang` (
  `id` int(11) NOT NULL,
  `id_rq` int(11) NOT NULL,
  `no_faktur` varchar(100) NOT NULL,
  `kodePR` varchar(100) NOT NULL,
  `diminta` varchar(99) NOT NULL,
  `diterima` varchar(99) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `terima_barang`
--

INSERT INTO `terima_barang` (`id`, `id_rq`, `no_faktur`, `kodePR`, `diminta`, `diterima`, `tanggal`) VALUES
(12, 18, 'FK-213948', '18/PR/Factory/12/20', 'Tika', 'Angel', '2020-12-13 17:00:00'),
(13, 19, 'FK-213948', '19/PR/Factory/12/20', 'Tika', 'Angel', '2020-12-14 17:00:00'),
(14, 20, 'FK-00024', '20/PR/Factory/12/20', 'Tika', 'Angel', '2020-12-14 17:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_terima_barang_d`
--

CREATE TABLE `t_terima_barang_d` (
  `id` int(11) NOT NULL,
  `id_terimabarang` int(11) NOT NULL,
  `code_item` varchar(16) NOT NULL,
  `satuan` varchar(21) NOT NULL,
  `qty_diterima` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_terima_barang_d`
--

INSERT INTO `t_terima_barang_d` (`id`, `id_terimabarang`, `code_item`, `satuan`, `qty_diterima`, `keterangan`) VALUES
(12, 12, 'BRG0000001', 'PCS', 120, 'Stater Lampu'),
(13, 13, 'BRG0000002', 'PCS', 110, 'untuk penerangan'),
(14, 14, 'BRG0000004', 'PCS', 100, 'Untuk Ligting');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `nik` varchar(16) NOT NULL,
  `nama` varchar(99) NOT NULL,
  `temp_lahir` varchar(55) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `Alamat` text NOT NULL,
  `id_akses` varchar(2) NOT NULL,
  `pic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`nik`, `nama`, `temp_lahir`, `tgl_lahir`, `Alamat`, `id_akses`, `pic`) VALUES
('22222222222222', 'Tika', 'jakarta', '1990-12-03', 'perum permata indah, cileungsi', '2', 'default.png'),
('320136080299001', 'yusup Fey', 'bogor', '2020-08-28', 'kp.nyencle Rt.01/01, Desa Selawangi Keacamata Tanjungsari kab. Bogor', '1', 'default.png'),
('32123123123123', 'Angel', 'jakarta', '2020-10-20', 'jakrta', '3', 'default.png'),
('33333333333333', 'MR. Lee', 'Seoul, Korea Selatan', '2020-11-04', 'jl. diponegoro, jakarta', '4', 'default.png'),
('444444444444444', 'Supriatna', 'London', '1989-05-05', 'Jakarta Timur', '5', 'default.png'),
('55555555555555', 'Michael Alonso', 'Swiss', '2020-12-10', 'Jakarta', '2', 'default.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`akses_id`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indeks untuk tabel `log_user`
--
ALTER TABLE `log_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `nik` (`nik`);

--
-- Indeks untuk tabel `request_item`
--
ALTER TABLE `request_item`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `request_item_d`
--
ALTER TABLE `request_item_d`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rq` (`id_rq`),
  ADD KEY `code_item` (`code_item`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `terima_barang`
--
ALTER TABLE `terima_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rq` (`id_rq`);

--
-- Indeks untuk tabel `t_terima_barang_d`
--
ALTER TABLE `t_terima_barang_d`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_terimabarang` (`id_terimabarang`),
  ADD KEY `code_item` (`code_item`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`nik`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `akses`
--
ALTER TABLE `akses`
  MODIFY `akses_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `log_user`
--
ALTER TABLE `log_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `request_item`
--
ALTER TABLE `request_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `request_item_d`
--
ALTER TABLE `request_item_d`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `terima_barang`
--
ALTER TABLE `terima_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `t_terima_barang_d`
--
ALTER TABLE `t_terima_barang_d`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `log_user`
--
ALTER TABLE `log_user`
  ADD CONSTRAINT `log_user_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `users` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `request_item_d`
--
ALTER TABLE `request_item_d`
  ADD CONSTRAINT `request_item_d_ibfk_1` FOREIGN KEY (`id_rq`) REFERENCES `request_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_item_d_ibfk_2` FOREIGN KEY (`code_item`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `terima_barang`
--
ALTER TABLE `terima_barang`
  ADD CONSTRAINT `terima_barang_ibfk_1` FOREIGN KEY (`id_rq`) REFERENCES `request_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_terima_barang_d`
--
ALTER TABLE `t_terima_barang_d`
  ADD CONSTRAINT `t_terima_barang_d_ibfk_1` FOREIGN KEY (`id_terimabarang`) REFERENCES `terima_barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_terima_barang_d_ibfk_2` FOREIGN KEY (`code_item`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Nov 2020 pada 18.48
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
(2, 'Staf (Gudang)'),
(3, 'Supervisior (Gudang)'),
(4, 'Head staf (Gudang Pusat)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(11) NOT NULL,
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

INSERT INTO `barang` (`id_barang`, `nama`, `ukuran`, `type`, `stok`, `updated_at`, `created_at`) VALUES
('BRG0000001', 'Philip smart lamp', '14wt', 'twilight dark', 120, '2020-11-20 19:31:15', '2020-10-25 00:11:35'),
('BRG0000002', 'Cosmost', '180ml', 'M210A', 0, '2020-11-19 19:53:57', '2020-10-25 00:17:42'),
('BRG0000003', 'Kompor gas', '90cm', 'Mark201', 0, '2020-11-19 19:53:18', '2020-10-25 00:18:30'),
('BRG0000004', 'Baja', '2,5m', 'B12AJA', 0, '2020-10-25 00:25:17', '2020-10-25 00:25:17'),
('BRG0000005', 'Besi', '2m', 'gepeng', 120, '2020-11-20 19:25:42', '2020-11-20 19:25:42');

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
(4, '33333333333333', 'lee', '123456');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `menu` varchar(55) NOT NULL,
  `url` varchar(99) NOT NULL,
  `icon` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`menu_id`, `menu`, `url`, `icon`) VALUES
(1, 'Dashboard', '/Dashboard', 'fa-tachometer-alt'),
(2, 'Master', '/master', 'fa-globe'),
(3, 'Transaksi', '/transaksi', 'fa fa-donate');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `request_item`
--

INSERT INTO `request_item` (`id`, `keterangan`, `user`, `status`, `updated_at`, `created_at`) VALUES
(1, 'Request Item', 'yusup Fey', '4', '2020-11-20 17:40:04', '2020-10-29 10:42:52'),
(2, 'Request Item dong', 'yusup Fey', '2', '2020-11-18 15:49:13', '2020-10-29 11:35:21'),
(3, 'Request Item penting', 'yusup Fey', '2', '2020-11-20 17:15:11', '2020-10-30 06:25:08'),
(4, 'Request Item penting banget segera kirim ya', 'yusup Fey', '1', '2020-10-30 17:06:03', '2020-10-30 06:34:02'),
(5, 'Secepatnya di order', 'yusup Fey', '1', '2020-11-06 12:19:48', '2020-11-06 05:19:21'),
(6, 'Request Item', 'yusup Fey', '2', '2020-11-18 15:48:08', '2020-11-18 06:03:26'),
(7, 'Kebutuhan di perusahaan Dapoer Ku', 'yusup Fey', '1', '2020-11-20 04:50:26', '2020-11-19 20:50:24'),
(8, 'Kebutuhan PT.SAMBALADO', 'yusup Fey', NULL, '2020-11-19 20:52:42', '2020-11-19 20:52:42'),
(9, 'Untuk produksi ke PT. Citra Mutiara', 'yusup Fey', NULL, '2020-11-19 21:00:54', '2020-11-19 21:00:54');

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
(1, 1, 'BRG0000001', 12, 'PCS', NULL),
(2, 1, 'BRG0000002', 12, 'PCS', NULL),
(3, 1, 'BRG0000003', 12, 'PCS', NULL),
(4, 2, 'BRG0000001', 14, 'PCS', NULL),
(5, 2, 'BRG0000003', 16, 'PCS', NULL),
(6, 2, 'BRG0000004', 12, 'PCS', NULL),
(7, 3, 'BRG0000002', 23, 'Lusin', 'm'),
(8, 3, 'BRG0000003', 2, 'Box', 'a'),
(9, 4, 'BRG0000002', 12, 'PCS', 'untuk masak'),
(10, 4, 'BRG0000004', 12, 'Lusin', 'untuk di masak'),
(11, 5, 'BRG0000003', 2, 'PCS', 'untuk masak nasi'),
(12, 5, 'BRG0000004', 12, 'Lusin', 'untuk keperluan produksi'),
(13, 6, 'BRG0000001', 12, 'PCS', 'Untuk Apa Ya'),
(14, 7, 'BRG0000001', 12, 'PCS', NULL),
(15, 8, 'BRG0000001', 12, 'Lusin', 'untuk masak'),
(16, 9, 'BRG0000004', 12, 'PCS', 'Bahan Baku');

-- --------------------------------------------------------

--
-- Struktur dari tabel `submenu`
--

CREATE TABLE `submenu` (
  `submenu_id` int(11) NOT NULL,
  `menu_induk` int(11) NOT NULL,
  `menu` varchar(55) NOT NULL,
  `link` varchar(55) NOT NULL,
  `icon` varchar(33) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `submenu`
--

INSERT INTO `submenu` (`submenu_id`, `menu_induk`, `menu`, `link`, `icon`) VALUES
(1, 2, 'Pegawai', '/master/pegawai', 'fa fa-user'),
(2, 2, 'Anggota', '/master/anggota', 'fa fa-id-card');

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
('SP0000001', 'PT. Sehat Abadi', 'Jakarta', '0893848837', '2020-10-23 09:07:57', '2020-10-23 09:07:57'),
('SP0000002', 'PT. Sehat Sejahtera', 'Bogor', '089349234', '2020-10-23 09:37:00', '2020-10-23 09:37:00'),
('SP0000003', 'PT. gocirID', 'Bogor', '0892892489', '2020-10-23 22:47:34', '2020-10-23 22:47:34'),
('SP0000004', 'PT.BukaLapak.com', 'jakarta', '08984838483984', '2020-10-24 20:30:03', '2020-10-24 20:30:03'),
('SP0000005', 'PT. Sehat sejahtera cahaya', 'jonggol', '08938928839', '2020-10-24 20:32:35', '2020-10-24 20:32:35'),
('SP0000006', 'PT. Mekar', 'Cariu', '0893489843', '2020-10-24 20:40:59', '2020-10-24 20:40:59'),
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
('SP0000019', 'PT. JS Jakarta', 'cileungsi', '08949384938', '2020-10-24 22:08:15', '2020-10-24 22:08:15'),
('SP0000020', 'PT. Cermai', 'Cilengsi', '08938493478', '2020-10-27 06:28:45', '2020-10-27 06:28:45');

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
  `notes` text NOT NULL,
  `pic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`nik`, `nama`, `temp_lahir`, `tgl_lahir`, `Alamat`, `id_akses`, `notes`, `pic`) VALUES
('22222222222222', 'Tika', 'jakarta', '1990-12-03', 'perum permata indah, cileungsi', '3', 'Hidup Wanita', 'default.png'),
('320136080299001', 'yusup Fey', 'bogor', '2020-08-28', 'kp.nyencle Rt.01/01, Desa Selawangi Keacamata Tanjungsari kab. Bogor', '1', 'Kerja Keras, Kerja Cerdas, Kerja Ikhlas', 'default.png'),
('32123123123123', 'Angel', 'jakarta', '2020-10-20', 'jakrta', '2', 'hardolin', 'default.png'),
('33333333333333', 'MR. Lee', 'Seoul, Korea Selatan', '2020-11-04', 'jl. diponegoro, jakarta', '4', 'kerja', 'default.png');

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
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `log_user`
--
ALTER TABLE `log_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `nik` (`nik`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indeks untuk tabel `request_item`
--
ALTER TABLE `request_item`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `request_item_d`
--
ALTER TABLE `request_item_d`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`submenu_id`),
  ADD KEY `menu_induk` (`menu_induk`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

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
  MODIFY `akses_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `log_user`
--
ALTER TABLE `log_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `request_item`
--
ALTER TABLE `request_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `request_item_d`
--
ALTER TABLE `request_item_d`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `submenu`
--
ALTER TABLE `submenu`
  MODIFY `submenu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `log_user`
--
ALTER TABLE `log_user`
  ADD CONSTRAINT `log_user_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `users` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `submenu`
--
ALTER TABLE `submenu`
  ADD CONSTRAINT `submenu_ibfk_1` FOREIGN KEY (`menu_induk`) REFERENCES `menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

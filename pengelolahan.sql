-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 22, 2020 at 11:02 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengelolahan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_bayar_bebas`
--

CREATE TABLE `tb_bayar_bebas` (
  `id_bayar_bebas` int(11) NOT NULL,
  `id_tagihan_bebas` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `jml_bayar` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `validasi` varchar(100) DEFAULT NULL,
  `cara_bayar` varchar(50) NOT NULL,
  `ket` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_bayar_bebas`
--

INSERT INTO `tb_bayar_bebas` (`id_bayar_bebas`, `id_tagihan_bebas`, `tgl_bayar`, `jml_bayar`, `foto`, `validasi`, `cara_bayar`, `ket`) VALUES
(2, 13, '2020-08-21', 500000, 'Screenshot from 2020-06-01 10-28-03.png', 'Pembayaran_Tervalidasi', 'Transfer', 'Angsuran 1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bulan`
--

CREATE TABLE `tb_bulan` (
  `id_bulan` varchar(15) NOT NULL DEFAULT '0',
  `nama_bulan` varchar(25) DEFAULT NULL,
  `urutan` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_bulan`
--

INSERT INTO `tb_bulan` (`id_bulan`, `nama_bulan`, `urutan`) VALUES
('1', 'Januari', 7),
('10', 'Oktober', 4),
('11', 'November', 5),
('12', 'Desember', 6),
('2', 'Februari', 8),
('3', 'Maret', 9),
('4', 'April', 10),
('5', 'Mei', 11),
('6', 'Juni', 12),
('7', 'Juli', 1),
('8', 'Agustus', 2),
('9', 'September', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_gaji`
--

CREATE TABLE `tb_gaji` (
  `id_gaji` int(11) NOT NULL,
  `bulan_tahun` varchar(30) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `masuk` int(11) NOT NULL,
  `sakit` int(11) NOT NULL,
  `izin` int(11) NOT NULL,
  `lembur` int(11) NOT NULL,
  `alpha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_bayar`
--

CREATE TABLE `tb_jenis_bayar` (
  `id_bayar` int(11) NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL,
  `nama_bayar` varchar(100) NOT NULL,
  `tipe_bayar` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kas`
--

CREATE TABLE `tb_kas` (
  `id_kas` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `tgl_kas` date NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `penerimaan` int(11) NOT NULL,
  `pengeluaran` int(11) NOT NULL,
  `jenis_kas` varchar(15) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_tahun_ajaran` int(11) DEFAULT NULL,
  `id_bayar` int(11) DEFAULT NULL,
  `batas_atas` int(11) DEFAULT NULL,
  `batas_bawah` int(11) DEFAULT NULL,
  `jml_bayar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
  `sub_kelas` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`, `sub_kelas`) VALUES
(11, 'I', ''),
(12, 'II', ''),
(13, 'III', ''),
(14, 'IV', ''),
(15, 'V', ''),
(16, 'VI', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_profile`
--

CREATE TABLE `tb_profile` (
  `nama_sekolah` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `telpon` varchar(20) NOT NULL,
  `website` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `bendahara` varchar(100) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `ktu` varchar(255) NOT NULL,
  `nip_ktu` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_profile`
--

INSERT INTO `tb_profile` (`nama_sekolah`, `alamat`, `telpon`, `website`, `kota`, `bendahara`, `nip`, `foto`, `ktu`, `nip_ktu`) VALUES
('', 'Jalan Pahlawan 1 RT 02 RW 02', '021.090939', 'www.sekolah.com', 'Jakarta', 'Bejo Santoso', '1968890993933434', 'LOGO-SDIT.png', 'ROZIKI FIRMANSYIAH', '343434343434'),
('', 'Jalan Pahlawan 1 RT 02 RW 02', '021.090939', 'www.sekolah.com', 'Jakarta', 'Bejo Santoso', '1968890993933434', 'LOGO-SDIT.png', 'ROZIKI FIRMANSYIAH', '343434343434');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(30) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `jk` varchar(20) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `kelas` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `nama_ortu` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp_ortu` varchar(15) NOT NULL,
  `gaji_ortu` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_tagihan_bebas`
--

CREATE TABLE `tb_tagihan_bebas` (
  `id_tagihan_bebas` int(11) NOT NULL,
  `id_bayar` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `total_tagihan` int(11) DEFAULT NULL,
  `terbayar` int(11) DEFAULT NULL,
  `status_bayar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_tagihan_bulanan`
--

CREATE TABLE `tb_tagihan_bulanan` (
  `id_tagihan_bulanan` int(11) NOT NULL,
  `id_bayar` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_bulan` int(11) NOT NULL,
  `jml_bayar` int(11) NOT NULL,
  `terbayar` int(11) DEFAULT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `status_bayar` int(11) DEFAULT NULL,
  `cara_bayar` varchar(30) DEFAULT NULL,
  `validasi` enum('Menunggu_Validasi','Pembayaran_Tervalidasi') DEFAULT 'Menunggu_Validasi',
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_tahun_ajaran`
--

CREATE TABLE `tb_tahun_ajaran` (
  `id_tahun_ajaran` int(11) NOT NULL,
  `tahun_ajaran` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tahun_ajaran`
--

INSERT INTO `tb_tahun_ajaran` (`id_tahun_ajaran`, `tahun_ajaran`, `status`) VALUES
(5, '2020/2021', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(30) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `nama_user`, `password`, `level`, `foto`) VALUES
(1, 'admin', 'Firman', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin.png'),
(2, 'roziki', 'roziki', 'baaeaa66e061e8739a9e704e3ea184fc', 'user', 'gambar-boy.jpg'),
(3, 'bendahara', 'Novi', '827ccb0eea8a706c4c34a16891f84e7b', 'bendahara', 'avatar2.png'),
(4, 'Kepala_Sekolah', 'Yanti Afri', 'ad9e9366bd65e665fa808da635512230', 'kepalasekolah', 'avatar.png'),
(5, 'sitirosyida', 'sitirosyida', '30830dbd7055ad3f17356248c71e8015', 'user', 'gambar-boy.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bayar_bebas`
--
ALTER TABLE `tb_bayar_bebas`
  ADD PRIMARY KEY (`id_bayar_bebas`);

--
-- Indexes for table `tb_bulan`
--
ALTER TABLE `tb_bulan`
  ADD PRIMARY KEY (`id_bulan`);

--
-- Indexes for table `tb_gaji`
--
ALTER TABLE `tb_gaji`
  ADD PRIMARY KEY (`id_gaji`);

--
-- Indexes for table `tb_jenis_bayar`
--
ALTER TABLE `tb_jenis_bayar`
  ADD PRIMARY KEY (`id_bayar`);

--
-- Indexes for table `tb_kas`
--
ALTER TABLE `tb_kas`
  ADD PRIMARY KEY (`id_kas`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `tb_tagihan_bebas`
--
ALTER TABLE `tb_tagihan_bebas`
  ADD PRIMARY KEY (`id_tagihan_bebas`);

--
-- Indexes for table `tb_tagihan_bulanan`
--
ALTER TABLE `tb_tagihan_bulanan`
  ADD PRIMARY KEY (`id_tagihan_bulanan`);

--
-- Indexes for table `tb_tahun_ajaran`
--
ALTER TABLE `tb_tahun_ajaran`
  ADD PRIMARY KEY (`id_tahun_ajaran`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_bayar_bebas`
--
ALTER TABLE `tb_bayar_bebas`
  MODIFY `id_bayar_bebas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_gaji`
--
ALTER TABLE `tb_gaji`
  MODIFY `id_gaji` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_jenis_bayar`
--
ALTER TABLE `tb_jenis_bayar`
  MODIFY `id_bayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_kas`
--
ALTER TABLE `tb_kas`
  MODIFY `id_kas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tb_tagihan_bebas`
--
ALTER TABLE `tb_tagihan_bebas`
  MODIFY `id_tagihan_bebas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_tagihan_bulanan`
--
ALTER TABLE `tb_tagihan_bulanan`
  MODIFY `id_tagihan_bulanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `tb_tahun_ajaran`
--
ALTER TABLE `tb_tahun_ajaran`
  MODIFY `id_tahun_ajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

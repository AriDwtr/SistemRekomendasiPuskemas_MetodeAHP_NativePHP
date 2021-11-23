-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2020 at 06:53 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `puskes`
--

-- --------------------------------------------------------

--
-- Table structure for table `grafik`
--

CREATE TABLE `grafik` (
  `no` int(2) NOT NULL,
  `tipe` varchar(20) DEFAULT NULL,
  `jumlah` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grafik`
--

INSERT INTO `grafik` (`no`, `tipe`, `jumlah`) VALUES
(1, 'inap', 1),
(2, 'jalan', 0),
(3, 'rujuk', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `no_pasien` int(30) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jk` varchar(2) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `jenis_layanan` varchar(20) NOT NULL,
  `no_layanan` varchar(50) DEFAULT NULL,
  `tanggal_regis` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`no_pasien`, `nik`, `nama`, `jk`, `tgl_lahir`, `alamat`, `jenis_layanan`, `no_layanan`, `tanggal_regis`) VALUES
(1, '1601050703000797', 'Ari Dwiantoro', 'l', '1997-07-07', 'Jl. Suka bangun 2 Palembang', 'umum', '', '2020-11-01'),
(2, '1801050600220119', 'Rizki Ratih Purwasihi', 'l', '1999-01-23', 'jl.Babat Supat Musi Banyuasini', 'bpjs', '0216162729801', '2020-11-01');

-- --------------------------------------------------------

--
-- Table structure for table `rekmed`
--

CREATE TABLE `rekmed` (
  `no_rekmed` int(11) NOT NULL,
  `no_pasien` int(100) NOT NULL,
  `anamnesa` varchar(100) DEFAULT NULL,
  `td` varchar(100) DEFAULT NULL,
  `hr` varchar(100) DEFAULT NULL,
  `rr` varchar(100) DEFAULT NULL,
  `suhu` varchar(100) DEFAULT NULL,
  `komplikasi` varchar(100) DEFAULT NULL,
  `hb` varchar(100) DEFAULT NULL,
  `malaria` varchar(100) DEFAULT NULL,
  `total_rekam` float DEFAULT NULL,
  `tgl_rekam` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rekmed`
--

INSERT INTO `rekmed` (`no_rekmed`, `no_pasien`, `anamnesa`, `td`, `hr`, `rr`, `suhu`, `komplikasi`, `hb`, `malaria`, `total_rekam`, `tgl_rekam`) VALUES
(1, 1, 'panas,pusing,mual muntah,keringat dingin,kejang,sesak,pucat', '170/90mmhg', '100x/Menit', '80 x/Menit', '40.0 *C', 'Malaria Otak', '12.0 gr/dl', 'Pm', 0.4082, '2020-11-01'),
(2, 1, 'panas,pusing,mual muntah', '80/90mmhg', '30x/Menit', '20 x/Menit', '42.0 *C', 'Anemia Parah', '9.0 gr/dl', 'Pf', 0.281, '2020-11-25');

-- --------------------------------------------------------

--
-- Table structure for table `spk`
--

CREATE TABLE `spk` (
  `no_rekmed` int(100) NOT NULL,
  `a_text` varchar(1000) DEFAULT NULL,
  `a_number` varchar(1000) DEFAULT NULL,
  `a_total` varchar(1000) DEFAULT NULL,
  `td` varchar(1000) DEFAULT NULL,
  `hr` varchar(1000) DEFAULT NULL,
  `rr` varchar(1000) DEFAULT NULL,
  `tanggal_rr` date NOT NULL,
  `suhu` varchar(1000) DEFAULT NULL,
  `kom` varchar(100) DEFAULT NULL,
  `hb` varchar(100) DEFAULT NULL,
  `bobot_hb` varchar(100) DEFAULT NULL,
  `evn_hb` varchar(100) DEFAULT NULL,
  `t_hb` varchar(100) DEFAULT NULL,
  `malaria` varchar(50) DEFAULT NULL,
  `total` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spk`
--

INSERT INTO `spk` (`no_rekmed`, `a_text`, `a_number`, `a_total`, `td`, `hr`, `rr`, `tanggal_rr`, `suhu`, `kom`, `hb`, `bobot_hb`, `evn_hb`, `t_hb`, `malaria`, `total`) VALUES
(1, 'panas,pusing,mual muntah,keringat dingin,kejang,sesak,pucat', '0.13,0.13,0.17 ,0.19 ,0.17,0.14,0.09', '0.0918', '170/90', '100', '80', '1997-07-07', '40.0', 'Malaria Otak', '12.0', '2', '0,19 x 0,19', '0.0361', 'Pm', '0.4082'),
(2, 'panas,pusing,mual muntah', '0.13,0.13,0.17 ', '0.0387', '80/90', '30', '20', '1997-07-07', '42.0', 'Anemia Parah', '9.0', '2', '0,19 x 0,19', '0.0361', 'Pf', '0.281');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(2) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `tipe` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `tipe`) VALUES
(1, 'Ari Dwiantoro', 'admin', 'admin', 'admin'),
(2, 'kirana sari', 'kirana', '12345', 'pegawai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grafik`
--
ALTER TABLE `grafik`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`no_pasien`);

--
-- Indexes for table `rekmed`
--
ALTER TABLE `rekmed`
  ADD PRIMARY KEY (`no_rekmed`);

--
-- Indexes for table `spk`
--
ALTER TABLE `spk`
  ADD PRIMARY KEY (`no_rekmed`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `no_pasien` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rekmed`
--
ALTER TABLE `rekmed`
  MODIFY `no_rekmed` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `spk`
--
ALTER TABLE `spk`
  MODIFY `no_rekmed` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

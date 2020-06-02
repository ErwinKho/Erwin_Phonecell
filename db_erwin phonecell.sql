-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 02, 2020 at 09:43 PM
-- Server version: 10.2.31-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u7684154_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `history_purchase`
--

CREATE TABLE `history_purchase` (
  `id_purchase` int(20) NOT NULL,
  `id_nama` int(20) NOT NULL,
  `barcode` int(20) NOT NULL,
  `jumlah_purchase` int(20) NOT NULL,
  `waktu_purchase` datetime NOT NULL DEFAULT current_timestamp(),
  `total_harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history_purchase`
--

INSERT INTO `history_purchase` (`id_purchase`, `id_nama`, `barcode`, `jumlah_purchase`, `waktu_purchase`, `total_harga`) VALUES
(1, 1, 1001, 1, '2020-06-01 19:37:07', 1495000),
(4, 4, 1002, 1, '2020-06-01 22:25:40', 1770000),
(5, 4, 1008, 1, '2020-06-01 22:27:42', 1750000),
(7, 7, 1006, 1, '2020-06-02 21:24:49', 1980000);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(20) NOT NULL,
  `barcode` int(20) NOT NULL,
  `nama_item` varchar(255) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `barcode`, `nama_item`, `jumlah`, `harga`) VALUES
(1, 1001, 'OPPO A1K', 8, 1495000),
(2, 1002, 'OPPO A5S 3G', 7, 1770000),
(3, 1003, 'OPPO A5 3G', 5, 2220000),
(4, 1004, 'OPPO A5 4G ', 6, 2595000),
(5, 1005, 'REDMINOTE 8 PRO', 15, 2090000),
(6, 1006, 'REDMINOTE 8', 6, 1980000),
(7, 1007, 'REDMI 8', 11, 1620000),
(8, 1008, 'REDMI 8 X', 9, 1750000),
(9, 1009, 'IPHONE X', 5, 12000000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level_id` varchar(255) NOT NULL,
  `wallet` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `level_id`, `wallet`) VALUES
(1, 'erwin', '785f0b13d4daf8eee0d11195f58302a4', 'pembeli', 6500000),
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 0),
(4, 'mariana', 'e60408e9a55027070e3caf0550d2b4df', 'pembeli', 1980000),
(6, 'dedi', 'c5897fbcc14ddcf30dca31b2735c3d7e', 'pembeli', 0),
(7, 'deddy', '0c09376372e339d44d3b5dadb56df2d5', 'pembeli', 20000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history_purchase`
--
ALTER TABLE `history_purchase`
  ADD PRIMARY KEY (`id_purchase`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history_purchase`
--
ALTER TABLE `history_purchase`
  MODIFY `id_purchase` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2023 at 05:42 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `globalxtreme`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `Id` int(11) NOT NULL,
  `Nama_jenis` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `new_lead`
--

CREATE TABLE `new_lead` (
  `Id` varchar(250) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `Fullname` text DEFAULT NULL,
  `Address` text DEFAULT NULL,
  `Phonenumber` text DEFAULT NULL,
  `Email` text DEFAULT NULL,
  `Companyname` text DEFAULT NULL,
  `Companyaddress` text DEFAULT NULL,
  `Companyphonenumber` text DEFAULT NULL,
  `Companyemail` text DEFAULT NULL,
  `Status` text DEFAULT NULL,
  `Probability` text DEFAULT NULL,
  `source` varchar(250) NOT NULL,
  `media` varchar(250) NOT NULL,
  `asigned_to` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `last_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `Id` int(11) NOT NULL,
  `Id_jenis` int(11) DEFAULT NULL,
  `Nama_Packages` varchar(250) DEFAULT NULL,
  `Deskripsi` varchar(250) DEFAULT NULL,
  `Harga_jual` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `Id` int(11) NOT NULL,
  `Nama` varchar(250) DEFAULT NULL,
  `Username` varchar(250) DEFAULT NULL,
  `Password` varchar(250) DEFAULT NULL,
  `Level` varchar(250) DEFAULT NULL,
  `Foto` varchar(250) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `sales_from` varchar(255) DEFAULT NULL,
  `is_login` int(11) DEFAULT NULL,
  `Last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`Id`, `Nama`, `Username`, `Password`, `Level`, `Foto`, `Status`, `Email`, `sales_from`, `is_login`, `Last_login`) VALUES
(8, 'Admin', 'admin', '$2y$10$MARJV/kBSTaXy0vsKnT9Yu3Z7GSX0bUdLOLByfCp4CE9JtNQPlwRC', '1', 'image_6547b40774a91.jpg', 1, 'admin@gmail.com', NULL, 0, '2023-11-06 00:25:35'),
(12, 'Sales', 'sales', '$2y$10$DCSPAk9BIT0EBPd2OOUhGupEPXbRRNiKiK1gKecc.cXmLntGTXifS', '3', 'image_6547b4bc4964a.jpg', 1, 'sales@gmail.com', NULL, 0, '2023-11-06 00:15:43'),
(13, 'Super Admin', 'superadmin', '$2y$10$KTNf/dcMbm14DSramXVzheLG8fC1erRTMewGPg438pzObJrjUAdgK', '2', 'image_6547b519d5d43.jpg', 1, 'superadmin@gmail.com', NULL, 0, '2023-11-05 23:32:16');

-- --------------------------------------------------------

--
-- Table structure for table `prospect`
--

CREATE TABLE `prospect` (
  `Id` varchar(250) NOT NULL,
  `Id_newlead` varchar(250) NOT NULL,
  `Prospect_type_cust` text DEFAULT NULL,
  `Note_type_cust` text DEFAULT NULL,
  `Givenname` text DEFAULT NULL,
  `Gender` text DEFAULT NULL,
  `Birthday` date DEFAULT NULL,
  `Surname` text DEFAULT NULL,
  `Religion` text DEFAULT NULL,
  `Hometown` text DEFAULT NULL,
  `Curcity` text DEFAULT NULL,
  `Nationality` text DEFAULT NULL,
  `Curaddress` text DEFAULT NULL,
  `Area` text DEFAULT NULL,
  `Type` text DEFAULT NULL,
  `Mobile` text DEFAULT NULL,
  `home_number` varchar(255) NOT NULL,
  `Id_card_no` int(11) DEFAULT NULL,
  `Passport_no` int(11) DEFAULT NULL,
  `Id_card_foto` text DEFAULT NULL,
  `Passport_foto` text DEFAULT NULL,
  `Streetname` text DEFAULT NULL,
  `Building_type` text DEFAULT NULL,
  `Building_name` text DEFAULT NULL,
  `No` int(11) DEFAULT NULL,
  `Property_ownership_type` text DEFAULT NULL,
  `Location` text DEFAULT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `Id_packages` int(11) DEFAULT NULL,
  `Id_pengguna` int(11) DEFAULT NULL,
  `sales_representativ` int(11) NOT NULL,
  `Lead_telemarketing` int(11) DEFAULT NULL,
  `General_note` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `last_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_notes_newlead`
--

CREATE TABLE `tb_notes_newlead` (
  `Id` int(11) NOT NULL,
  `id_newlead` varchar(250) NOT NULL,
  `note` text NOT NULL,
  `note_type` text NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `new_lead`
--
ALTER TABLE `new_lead`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_new_lead_pengguna` (`id_pengguna`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_jenis` (`Id_jenis`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `prospect`
--
ALTER TABLE `prospect`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_pengguna` (`Id_pengguna`),
  ADD KEY `fk_prospect_newLead` (`Id_newlead`);

--
-- Indexes for table `tb_notes_newlead`
--
ALTER TABLE `tb_notes_newlead`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_notes_newlead` (`id_newlead`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_notes_newlead`
--
ALTER TABLE `tb_notes_newlead`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `new_lead`
--
ALTER TABLE `new_lead`
  ADD CONSTRAINT `fk_new_lead_pengguna` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`Id`);

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`Id_jenis`) REFERENCES `jenis` (`Id`);

--
-- Constraints for table `prospect`
--
ALTER TABLE `prospect`
  ADD CONSTRAINT `fk_prospect_newLead` FOREIGN KEY (`Id_newlead`) REFERENCES `new_lead` (`Id`),
  ADD CONSTRAINT `prospect_ibfk_3` FOREIGN KEY (`Id_pengguna`) REFERENCES `pengguna` (`Id`);

--
-- Constraints for table `tb_notes_newlead`
--
ALTER TABLE `tb_notes_newlead`
  ADD CONSTRAINT `fk_notes_newlead` FOREIGN KEY (`id_newlead`) REFERENCES `new_lead` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

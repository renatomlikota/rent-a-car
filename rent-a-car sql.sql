-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2019 at 08:19 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rent-a-car`
--
CREATE DATABASE IF NOT EXISTS `rent-a-car` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `rent-a-car`;

-- --------------------------------------------------------

--
-- Table structure for table `automobil`
--

CREATE TABLE `automobil` (
  `id` int(11) NOT NULL,
  `naziv` varchar(30) COLLATE utf8_bin NOT NULL,
  `godiste` varchar(4) COLLATE utf8_bin NOT NULL,
  `cijena_po_satu` float NOT NULL,
  `ocjena` float DEFAULT NULL,
  `kolicina` int(11) DEFAULT NULL,
  `dostupan` tinyint(1) NOT NULL DEFAULT '0',
  `marka_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `automobil`
--

INSERT INTO `automobil` (`id`, `naziv`, `godiste`, `cijena_po_satu`, `ocjena`, `kolicina`, `dostupan`, `marka_id`) VALUES
(1, 'A4', '2010', 50, NULL, NULL, 0, 1),
(2, 'C220', '2011', 60, NULL, NULL, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `dodatna_oprema`
--

CREATE TABLE `dodatna_oprema` (
  `id` int(11) NOT NULL,
  `naziv` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `dodatna_oprema`
--

INSERT INTO `dodatna_oprema` (`id`, `naziv`) VALUES
(1, 'ABS'),
(2, 'Električni podizači');

-- --------------------------------------------------------

--
-- Table structure for table `dodatna_oprema_automobil`
--

CREATE TABLE `dodatna_oprema_automobil` (
  `id` int(11) NOT NULL,
  `automobil_id` int(11) NOT NULL,
  `dodatna_oprema_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `dodatna_oprema_automobil`
--

INSERT INTO `dodatna_oprema_automobil` (`id`, `automobil_id`, `dodatna_oprema_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(30) COLLATE utf8_bin NOT NULL,
  `prezime` varchar(30) COLLATE utf8_bin NOT NULL,
  `grad` varchar(30) COLLATE utf8_bin NOT NULL,
  `adresa` varchar(50) COLLATE utf8_bin NOT NULL,
  `datum_rodjenja` date NOT NULL,
  `putanja_slike` varchar(100) COLLATE utf8_bin NOT NULL,
  `datum_kreiranja` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `aktivan` tinyint(1) DEFAULT '0',
  `korisnicko_ime` varchar(30) COLLATE utf8_bin NOT NULL,
  `lozinka` varchar(30) COLLATE utf8_bin NOT NULL,
  `tip_placanja_id` int(11) NOT NULL,
  `tip_korisnika_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `grad`, `adresa`, `datum_rodjenja`, `putanja_slike`, `datum_kreiranja`, `aktivan`, `korisnicko_ime`, `lozinka`, `tip_placanja_id`, `tip_korisnika_id`) VALUES
(1, 'Mario', 'Perić', 'Mostar', 'Kralja Zvonimira 23', '1993-11-05', 'C:\\xampp\\htdocs\\slika1.png', '2019-11-05 19:52:23', 0, 'mario', 'perke123', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `marka_automobila`
--

CREATE TABLE `marka_automobila` (
  `id` int(11) NOT NULL,
  `naziv` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `marka_automobila`
--

INSERT INTO `marka_automobila` (`id`, `naziv`) VALUES
(1, 'Audi'),
(2, 'Mercedes');

-- --------------------------------------------------------

--
-- Table structure for table `najam`
--

CREATE TABLE `najam` (
  `id` int(11) NOT NULL,
  `datum_pocetka` datetime NOT NULL,
  `datum_zavrsetka` datetime NOT NULL,
  `otkazan` tinyint(1) DEFAULT NULL,
  `prihvacen` tinyint(1) DEFAULT NULL,
  `zavrsen` tinyint(1) DEFAULT NULL,
  `placeno` tinyint(1) DEFAULT NULL,
  `ukupna_cijena` float DEFAULT NULL,
  `ocjena` int(11) DEFAULT NULL,
  `automobil_id` int(11) NOT NULL,
  `korisnik_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `najam`
--

INSERT INTO `najam` (`id`, `datum_pocetka`, `datum_zavrsetka`, `otkazan`, `prihvacen`, `zavrsen`, `placeno`, `ukupna_cijena`, `ocjena`, `automobil_id`, `korisnik_id`) VALUES
(1, '2019-11-05 00:00:00', '2019-11-07 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `slike_automobila`
--

CREATE TABLE `slike_automobila` (
  `id` int(11) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_bin NOT NULL,
  `format` varchar(5) COLLATE utf8_bin NOT NULL,
  `putanja` varchar(100) COLLATE utf8_bin NOT NULL,
  `automobil_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `slike_automobila`
--

INSERT INTO `slike_automobila` (`id`, `naziv`, `format`, `putanja`, `automobil_id`) VALUES
(1, 'A4_front', 'jpg', 'C:\\xampp\\image_a4.jpg\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tip_korisnika`
--

CREATE TABLE `tip_korisnika` (
  `id` int(11) NOT NULL,
  `naziv` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tip_korisnika`
--

INSERT INTO `tip_korisnika` (`id`, `naziv`) VALUES
(1, 'administrator'),
(2, 'moderator'),
(3, 'kupac');

-- --------------------------------------------------------

--
-- Table structure for table `tip_placanja`
--

CREATE TABLE `tip_placanja` (
  `id` int(11) NOT NULL,
  `naziv` varchar(30) COLLATE utf8_bin NOT NULL,
  `broj_kartice` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tip_placanja`
--

INSERT INTO `tip_placanja` (`id`, `naziv`, `broj_kartice`, `email`) VALUES
(1, 'Visa', '1456-3574-2357-4567', NULL),
(2, 'PayPal', NULL, 'mario_peric@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `automobil`
--
ALTER TABLE `automobil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `AutomobilMarka` (`marka_id`);

--
-- Indexes for table `dodatna_oprema`
--
ALTER TABLE `dodatna_oprema`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dodatna_oprema_automobil`
--
ALTER TABLE `dodatna_oprema_automobil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `DodatnaOpremaAutomobil` (`automobil_id`),
  ADD KEY `AutomobilDodatnaOprema` (`dodatna_oprema_id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `KorisnikTipPlacanja` (`tip_placanja_id`),
  ADD KEY `KorisnikTipKorisnika` (`tip_korisnika_id`);

--
-- Indexes for table `marka_automobila`
--
ALTER TABLE `marka_automobila`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `najam`
--
ALTER TABLE `najam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `NajamAutomobil` (`automobil_id`),
  ADD KEY `NajamKorisnik` (`korisnik_id`);

--
-- Indexes for table `slike_automobila`
--
ALTER TABLE `slike_automobila`
  ADD PRIMARY KEY (`id`),
  ADD KEY `SlikeAutomobil` (`automobil_id`);

--
-- Indexes for table `tip_korisnika`
--
ALTER TABLE `tip_korisnika`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tip_placanja`
--
ALTER TABLE `tip_placanja`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `automobil`
--
ALTER TABLE `automobil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dodatna_oprema`
--
ALTER TABLE `dodatna_oprema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dodatna_oprema_automobil`
--
ALTER TABLE `dodatna_oprema_automobil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `marka_automobila`
--
ALTER TABLE `marka_automobila`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `najam`
--
ALTER TABLE `najam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slike_automobila`
--
ALTER TABLE `slike_automobila`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tip_korisnika`
--
ALTER TABLE `tip_korisnika`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tip_placanja`
--
ALTER TABLE `tip_placanja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `automobil`
--
ALTER TABLE `automobil`
  ADD CONSTRAINT `AutomobilMarka` FOREIGN KEY (`marka_id`) REFERENCES `marka_automobila` (`id`);

--
-- Constraints for table `dodatna_oprema_automobil`
--
ALTER TABLE `dodatna_oprema_automobil`
  ADD CONSTRAINT `AutomobilDodatnaOprema` FOREIGN KEY (`dodatna_oprema_id`) REFERENCES `dodatna_oprema` (`id`),
  ADD CONSTRAINT `DodatnaOpremaAutomobil` FOREIGN KEY (`automobil_id`) REFERENCES `automobil` (`id`);

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `KorisnikTipKorisnika` FOREIGN KEY (`tip_korisnika_id`) REFERENCES `tip_korisnika` (`id`),
  ADD CONSTRAINT `KorisnikTipPlacanja` FOREIGN KEY (`tip_placanja_id`) REFERENCES `tip_placanja` (`id`);

--
-- Constraints for table `najam`
--
ALTER TABLE `najam`
  ADD CONSTRAINT `NajamAutomobil` FOREIGN KEY (`automobil_id`) REFERENCES `automobil` (`id`),
  ADD CONSTRAINT `NajamKorisnik` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`id`);

--
-- Constraints for table `slike_automobila`
--
ALTER TABLE `slike_automobila`
  ADD CONSTRAINT `SlikeAutomobil` FOREIGN KEY (`automobil_id`) REFERENCES `automobil` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

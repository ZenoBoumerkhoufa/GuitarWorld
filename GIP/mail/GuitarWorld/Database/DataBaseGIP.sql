-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 06 jan 2020 om 14:26
-- Serverversie: 5.7.17
-- PHP-versie: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guitarworld`
--
CREATE DATABASE IF NOT EXISTS `guitarworld` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `guitarworld`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblklanten`
--

CREATE TABLE `tblklanten` (
  `KlantNr` int(11) NOT NULL,
  `KlantNaam` varchar(30) NOT NULL,
  `KlantFamilienaam` varchar(30) NOT NULL,
  `KlantEmail` varchar(30) NOT NULL,
  `Klantgsm` varchar(30) DEFAULT 'Geen gsm',
  `KlantPaswoord` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tblklanten`
--

INSERT INTO `tblklanten` (`KlantNr`, `KlantNaam`, `KlantFamilienaam`, `KlantEmail`, `Klantgsm`, `KlantPaswoord`) VALUES
(4, 'Klant1', 'Nummer1', 'klant1@mail.com', '0', 'klant1'),
(5, 'klant21', 'nummer2', 'klant2@mail.com', '', 'klant2'),
(6, 'klant3', 'nummer3', 'klant3@mail.com', '0', 'klant3'),
(7, 'klant4', 'nummer4', 'klant4@mail.com', '0', 'klant4'),
(8, 'klant5', 'nummer5', 'klant5@mail.com', '0', 'klant5'),
(9, 'klant6', 'nummer6', 'klant6@mail.com', '0', 'klant6'),
(10, 'klant7', 'nummer7', 'klant7@mail.com', '0', 'klant7'),
(11, 'klant8', 'nummer8', 'klant8@mail.com', '0', 'klant8'),
(12, 'klant9', 'nummer9', 'klant9@mail.com', '0', 'klant9'),
(13, 'klant10', 'nummer10', 'klant10@mail.com', '0', 'klant10'),
(14, 'klant12', 'nummer12', 'klant12@mail.com', '049 1203 2222', 'klant12'),
(15, 'klant13', 'nummer13', 'klant13@mail.com', '', 'klant13');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblpostcodeid`
--

CREATE TABLE `tblpostcodeid` (
  `PostcodeID` int(11) NOT NULL,
  `Postcode` int(11) NOT NULL,
  `Gemeente` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `tblklanten`
--
ALTER TABLE `tblklanten`
  ADD PRIMARY KEY (`KlantNr`);

--
-- Indexen voor tabel `tblpostcodeid`
--
ALTER TABLE `tblpostcodeid`
  ADD PRIMARY KEY (`PostcodeID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `tblklanten`
--
ALTER TABLE `tblklanten`
  MODIFY `KlantNr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT voor een tabel `tblpostcodeid`
--
ALTER TABLE `tblpostcodeid`
  MODIFY `PostcodeID` int(11) NOT NULL AUTO_INCREMENT;--
-- Database: `leerphp`
--
CREATE DATABASE IF NOT EXISTS `leerphp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `leerphp`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblproducten`
--

CREATE TABLE `tblproducten` (
  `productid` int(11) NOT NULL,
  `productnaam` varchar(40) NOT NULL,
  `omschrijving` longtext,
  `prijs` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `tblproducten`
--

INSERT INTO `tblproducten` (`productid`, `productnaam`, `omschrijving`, `prijs`) VALUES
(1, 'Memoryfoammatras', 'Een laag memoryfoam vormt zich naar het lichaam', 199),
(2, 'Foammatras', 'JE HELE LICHAAM KRIJGT STEUN EN COMFORT', 100),
(3, 'Polyether matras', 'Doordat je beide kanten van de matras kan gebruiken...', 30),
(4, 'Natuurlatex matras', 'Natuurlatex helpt je te ontspannen', 599);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `tblproducten`
--
ALTER TABLE `tblproducten`
  ADD PRIMARY KEY (`productid`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `tblproducten`
--
ALTER TABLE `tblproducten`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

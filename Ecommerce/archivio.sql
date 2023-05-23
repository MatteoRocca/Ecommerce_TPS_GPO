-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 23, 2023 alle 22:13
-- Versione del server: 10.4.17-MariaDB
-- Versione PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `archivio`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `account`
--

CREATE TABLE `account` (
  `Id` int(11) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Localita` varchar(25) NOT NULL,
  `Provincia` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `localita`
--

CREATE TABLE `localita` (
  `Nome` varchar(25) NOT NULL,
  `Provincia` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `localita`
--

INSERT INTO `localita` (`Nome`, `Provincia`) VALUES
('Agrigento', 'AG'),
('Alessandria', 'AL'),
('Ancona', 'AN'),
('Aosta', 'AO'),
('Ascoli Piceno', 'AP'),
('L\'Aquila', 'AQ'),
('Arezzo', 'AR'),
('Asti', 'AT'),
('Avellino', 'AV'),
('Bari', 'BA'),
('Bergamo', 'BG'),
('Biella', 'BI'),
('Belluno', 'BL'),
('Benevento', 'BN'),
('Bologna', 'BO'),
('Brindisi', 'BR'),
('Brescia', 'BS'),
('Barletta-Andria-Trani', 'BT'),
('Bolzano', 'BZ'),
('Cagliari', 'CA'),
('Campobasso', 'CB'),
('Caserta', 'CE'),
('Chieti', 'CH'),
('Carbonia-Iglesias', 'CI'),
('Caltanissetta', 'CL'),
('Cuneo', 'CN'),
('Como', 'CO'),
('Cremona', 'CR'),
('Cosenza', 'CS'),
('Catania', 'CT'),
('Catanzaro', 'CZ'),
('Enna', 'EN'),
('Forlì-Cesena', 'FC'),
('Ferrara', 'FE'),
('Foggia', 'FG'),
('Firenze', 'FI'),
('Fermo', 'FM'),
('Frosinone', 'FR'),
('Genova', 'GE'),
('Gorizia', 'GO'),
('Grosseto', 'GR'),
('Imperia', 'IM'),
('Isernia', 'IS'),
('Crotone', 'KR'),
('Lecco', 'LC'),
('Lecce', 'LE'),
('Livorno', 'LI'),
('Lodi', 'LO'),
('Latina', 'LT'),
('Lucca', 'LU'),
('Monza e della Brianza', 'MB'),
('Macerata', 'MC'),
('Messina', 'ME'),
('Milano', 'MI'),
('Mantova', 'MN'),
('Modena', 'MO'),
('Massa-Carrara', 'MS'),
('Matera', 'MT'),
('Napoli', 'NA'),
('Novara', 'NO'),
('Nuoro', 'NU'),
('Ogliastra', 'OG'),
('Oristano', 'OR'),
('Olbia-Tempio', 'OT'),
('Palermo', 'PA'),
('Piacenza', 'PC'),
('Padova', 'PD'),
('Pescara', 'PE'),
('Perugia', 'PG'),
('Pisa', 'PI'),
('Pordenone', 'PN'),
('Prato', 'PO'),
('Parma', 'PR'),
('Pistoia', 'PT'),
('Pesaro e Urbino', 'PU'),
('Pavia', 'PV'),
('Potenza', 'PZ'),
('Ravenna', 'RA'),
('Reggio Calabria', 'RC'),
('Reggio Emilia', 'RE'),
('Ragusa', 'RG'),
('Rieti', 'RI'),
('Roma', 'RM'),
('Rimini', 'RN'),
('Rovigo', 'RO'),
('Salerno', 'SA'),
('Siena', 'SI'),
('Sondrio', 'SO'),
('La Spezia', 'SP'),
('Siracusa', 'SR'),
('Sassari', 'SS'),
('Savona', 'SV'),
('Taranto', 'TA'),
('Teramo', 'TE'),
('Trento', 'TN'),
('Torino', 'TO'),
('Trapani', 'TP'),
('Terni', 'TR'),
('Trieste', 'TS'),
('Treviso', 'TV'),
('Udine', 'UD'),
('Varese', 'VA'),
('Verbano-Cusio-Ossola', 'VB'),
('Vercelli', 'VC'),
('Venezia', 'VE'),
('Vicenza', 'VI'),
('Verona', 'VR'),
('Medio Campidano', 'VS'),
('Viterbo', 'VT'),
('Vibo Valentia', 'VV');

-- --------------------------------------------------------

--
-- Struttura della tabella `magazzino`
--

CREATE TABLE `magazzino` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(25) NOT NULL,
  `Localita` varchar(25) NOT NULL,
  `Provincia` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `magazzino`
--

INSERT INTO `magazzino` (`Id`, `Nome`, `Localita`, `Provincia`) VALUES
(1, 'MagazzBG', 'Bergamo', 'BG'),
(2, 'MagazzMI', 'Milano', 'MI'),
(3, 'MagazzLC', 'Lecco', 'LC'),
(4, 'MagazzRM', 'Roma', 'RM'),
(5, 'MagazzNA', 'Napoli', 'NA'),
(6, 'MagazzVA', 'Varese', 'VA'),
(7, 'MagazzAO', 'Aosta', 'AO');

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

CREATE TABLE `ordine` (
  `Id` int(11) NOT NULL,
  `IdVenditore` int(11) NOT NULL,
  `IdDestinatario` int(11) NOT NULL,
  `IdProdotto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto`
--

CREATE TABLE `prodotto` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(25) NOT NULL,
  `Prezzo` decimal(5,2) NOT NULL,
  `IdVenditore` int(11) NOT NULL,
  `IdMagazzino` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `prodotto`
--

INSERT INTO `prodotto` (`Id`, `Nome`, `Prezzo`, `IdVenditore`, `IdMagazzino`) VALUES
(1, 'Orologio', '25.00', 1, 2),
(2, 'Sedia', '15.00', 2, 1),
(3, 'Cellulare', '300.00', 3, 3),
(4, 'Televisore', '500.00', 1, 6),
(5, 'Mobile', '425.00', 1, 5),
(6, 'Lampada', '25.00', 3, 2),
(7, 'Lampada', '25.00', 3, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `venditore`
--

CREATE TABLE `venditore` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(25) NOT NULL,
  `Cognome` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `venditore`
--

INSERT INTO `venditore` (`Id`, `Nome`, `Cognome`) VALUES
(1, 'Stefano', 'Ghisleni'),
(2, 'Davide', 'Locatelli'),
(3, 'Luca', 'Bonacina'),
(4, 'Mario', 'Rossi'),
(5, 'Luigi', 'Bianchi'),
(6, 'Giovanni', 'Verdi'),
(7, 'Matteo', 'Rocca');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indici per le tabelle `localita`
--
ALTER TABLE `localita`
  ADD PRIMARY KEY (`Provincia`);

--
-- Indici per le tabelle `magazzino`
--
ALTER TABLE `magazzino`
  ADD PRIMARY KEY (`Id`);

--
-- Indici per le tabelle `ordine`
--
ALTER TABLE `ordine`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdDestinatario` (`IdDestinatario`),
  ADD KEY `IdVenditore` (`IdVenditore`),
  ADD KEY `IdProdotto` (`IdProdotto`);

--
-- Indici per le tabelle `prodotto`
--
ALTER TABLE `prodotto`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdMagazzino` (`IdMagazzino`);

--
-- Indici per le tabelle `venditore`
--
ALTER TABLE `venditore`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `account`
--
ALTER TABLE `account`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT per la tabella `magazzino`
--
ALTER TABLE `magazzino`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `ordine`
--
ALTER TABLE `ordine`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `venditore`
--
ALTER TABLE `venditore`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `ordine`
--
ALTER TABLE `ordine`
  ADD CONSTRAINT `IdDestinatario` FOREIGN KEY (`IdDestinatario`) REFERENCES `account` (`Id`),
  ADD CONSTRAINT `IdProdotto` FOREIGN KEY (`IdProdotto`) REFERENCES `prodotto` (`Id`),
  ADD CONSTRAINT `IdVenditore` FOREIGN KEY (`IdVenditore`) REFERENCES `venditore` (`Id`);

--
-- Limiti per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  ADD CONSTRAINT `IdMagazzino` FOREIGN KEY (`IdMagazzino`) REFERENCES `magazzino` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

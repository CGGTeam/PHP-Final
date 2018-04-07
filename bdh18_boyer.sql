-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2018 at 01:41 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdh18_boyer`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `ID` int(11) NOT NULL,
  `Description` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cours`
--

CREATE TABLE `cours` (
  `Sigle` varchar(7) NOT NULL,
  `Titre` varchar(50) NOT NULL,
  `NomProf` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `courssession`
--

CREATE TABLE `courssession` (
  `Session` varchar(6) NOT NULL,
  `Sigle` varchar(7) NOT NULL,
  `Utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `ID` int(11) NOT NULL,
  `session` varchar(6) NOT NULL,
  `sigle` varchar(7) NOT NULL,
  `dateCours` date NOT NULL,
  `noSequence` int(11) NOT NULL,
  `dateAccessDebut` date NOT NULL,
  `dateAccessFin` date NOT NULL,
  `titre` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `nbPages` int(11) NOT NULL,
  `categorie` int(11) NOT NULL,
  `noVersion` int(11) NOT NULL,
  `dateVersion` date NOT NULL,
  `hyperLien` varchar(255) NOT NULL,
  `ajoutePar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `Description` varchar(6) NOT NULL,
  `DateDebut` date NOT NULL,
  `DateFin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `ID` int(11) NOT NULL,
  `nomUtilisateur` varchar(25) NOT NULL,
  `motDePasse` varchar(15) NOT NULL,
  `statutAdmin` tinyint(1) NOT NULL,
  `nomComplet` varchar(30) NOT NULL,
  `courriel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`Sigle`);

--
-- Indexes for table `courssession`
--
ALTER TABLE `courssession`
  ADD PRIMARY KEY (`Session`,`Sigle`,`Utilisateur`),
  ADD KEY `FK_courssession_cours` (`Sigle`),
  ADD KEY `FK_courssession_utilisateur` (`Utilisateur`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `session` (`session`),
  ADD KEY `sigle` (`sigle`),
  ADD KEY `categorie` (`categorie`),
  ADD KEY `ajoutePar` (`ajoutePar`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`Description`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `courssession`
--
ALTER TABLE `courssession`
  ADD CONSTRAINT `FK_courssession_cours` FOREIGN KEY (`Sigle`) REFERENCES `cours` (`Sigle`),
  ADD CONSTRAINT `FK_courssession_session` FOREIGN KEY (`Session`) REFERENCES `session` (`Description`),
  ADD CONSTRAINT `FK_courssession_utilisateur` FOREIGN KEY (`Utilisateur`) REFERENCES `utilisateur` (`ID`);

--
-- Constraints for table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `FK_document_categorie` FOREIGN KEY (`categorie`) REFERENCES `categorie` (`ID`),
  ADD CONSTRAINT `FK_document_cours` FOREIGN KEY (`sigle`) REFERENCES `cours` (`Sigle`),
  ADD CONSTRAINT `FK_document_session` FOREIGN KEY (`session`) REFERENCES `session` (`Description`),
  ADD CONSTRAINT `FK_document_utilisateur` FOREIGN KEY (`ajoutePar`) REFERENCES `utilisateur` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 12 déc. 2023 à 12:09
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ece`
--

-- --------------------------------------------------------

--
-- Structure de la table `emplois`
--

DROP TABLE IF EXISTS `emplois`;
CREATE TABLE IF NOT EXISTS `emplois` (
  `ID_emplois` int NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `commentaire` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_emplois`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `emplois`
--

INSERT INTO `emplois` (`ID_emplois`, `type`, `lieu`, `commentaire`) VALUES
(1, 'Apprentissage', 'ECE Paris', 'Ingénieur mécanique'),
(2, 'Stage', 'Barcelone', 'Enseignant chercheur'),
(12, 'CDD', 'Abidjan', 'Ingénieur aéronautique'),
(16, 'CDI', 'Entreprises Françaises', 'IBM'),
(17, 'Stage', 'Entreprises de l\'Union européenne', 'Daimler'),
(18, 'CDD', 'Genève', 'Chef de projet '),
(42, 'Stage', 'Monaco', 'Chercheur en neurosciences'),
(43, 'CDD', 'Omnes Education', 'Chargé digital learning'),
(44, 'CDI', 'Omnes Education', 'Developpeur web'),
(45, 'Stage', 'Omnes Education', 'Technicien supérieur de recherche '),
(46, 'Stage', 'Entreprises Françaises', 'Accenture'),
(47, 'Apprentissage', 'Entreprises Françaises', 'Atos'),
(48, 'CDI', 'Entreprises Françaises', 'ESN '),
(50, 'CDD', 'Londre', 'Enseignant de français'),
(51, 'CDI', 'Londre', 'Assistant TP '),
(53, 'Stage', 'Monaco', 'Chef de projet '),
(54, 'Apprentissage', 'Monaco', 'Ingénieur en informatique '),
(55, 'CDD', 'San Francisco', 'Ingénieur aérospatial '),
(56, 'Apprentissage', 'San Francisco', 'Enseignant de HTML'),
(57, 'CDI', 'San Francisco', 'Chef de projet '),
(58, 'Stage', 'Abidjan', 'Assistant TP'),
(59, 'Apprentissage', 'Barcelone', 'Ingénieur mécanique'),
(60, 'CDD', 'Barcelone', 'Chef de projet '),
(61, 'CDI', 'Entreprises de l\'Union européenne', 'Chef de projet ');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

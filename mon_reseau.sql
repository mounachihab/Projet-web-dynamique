-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 07 déc. 2023 à 08:10
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mon_reseau`
--

-- --------------------------------------------------------

--
-- Structure de la table `mes_amis`
--

DROP TABLE IF EXISTS `mes_amis`;
CREATE TABLE IF NOT EXISTS `mes_amis` (
  `ID` int NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Prénom` varchar(255) NOT NULL,
  `Photo` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `mes_amis`
--

INSERT INTO `mes_amis` (`ID`, `Nom`, `Prénom`, `Photo`) VALUES
(0, 'Hirtzmann', 'Julie', 'ppjulie.jpg'),
(1, 'Bourillon', 'Clothilde', 'ppclothilde.jpeg'),
(2, 'Bruneton', 'Elise', 'ppelise.jpeg'),
(3, 'Chihab', 'Mouna', 'ppmouna.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `reseau_ami`
--

DROP TABLE IF EXISTS `reseau_ami`;
CREATE TABLE IF NOT EXISTS `reseau_ami` (
  `ID` int NOT NULL,
  `IDami` int NOT NULL,
  `Lien` varchar(255) NOT NULL,
  `id_lien` int NOT NULL,
  PRIMARY KEY (`id_lien`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `reseau_ami`
--

INSERT INTO `reseau_ami` (`ID`, `IDami`, `Lien`, `id_lien`) VALUES
(0, 1, 'Collègues', 0),
(0, 2, 'Collègues', 1),
(0, 3, 'Collègues', 2),
(1, 0, 'Collègues', 3),
(1, 2, 'Collègues', 4),
(1, 3, 'Collègues', 5);

-- --------------------------------------------------------

--
-- Structure de la table `reseau_amis`
--

DROP TABLE IF EXISTS `reseau_amis`;
CREATE TABLE IF NOT EXISTS `reseau_amis` (
  `ID` int NOT NULL,
  `IDami` int NOT NULL,
  `Lien` varchar(255) NOT NULL,
  `id_lien` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `reseau_amis`
--

INSERT INTO `reseau_amis` (`ID`, `IDami`, `Lien`, `id_lien`) VALUES
(0, 1, '', 0),
(0, 2, '', 0),
(1, 0, 'Collègues ', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

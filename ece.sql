-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : sam. 09 déc. 2023 à 14:48
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

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

CREATE TABLE `emplois` (
  `ID_emplois` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `commentaire` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `emplois`
--

INSERT INTO `emplois` (`ID_emplois`, `type`, `lieu`, `commentaire`) VALUES
(1, 'CDI', 'ECE Paris', 'Enseignant électronique'),
(2, 'Apprentissage', 'San Fransisco', 'Assistant TP'),
(3, 'CDD', 'Monaco', 'Ingénieur mécanique');

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE `evenements` (
  `ID_event` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `commentaire` varchar(255) DEFAULT NULL,
  `photo` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `ID_createur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`ID_event`, `type`, `lieu`, `commentaire`, `photo`, `date`, `ID_createur`) VALUES
(2, 'Porte Ouverte', 'Paris', 'JPO de l\'ECE', 'even/eve_2.jpeg', '2023-11-04', 2);

-- --------------------------------------------------------

--
-- Structure de la table `informations`
--

CREATE TABLE `informations` (
  `ID` int(11) NOT NULL,
  `date` varchar(255) DEFAULT NULL,
  `civilite` varchar(255) DEFAULT NULL,
  `admin` varchar(255) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `informations`
--

INSERT INTO `informations` (`ID`, `date`, `civilite`, `admin`) VALUES
(1, NULL, 'Mme', 'YES'),
(2, '2003', 'Mme', 'YES'),
(3, NULL, 'Mme', 'YES'),
(4, NULL, 'Mme', 'YES'),
(11, '1976', 'Mme', 'NO'),
(12, NULL, NULL, 'NO');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `ID_likeur` int(11) NOT NULL,
  `ID_publication` int(11) NOT NULL,
  `commentaire` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`ID_likeur`, `ID_publication`, `commentaire`) VALUES
(1, 1, 'Super !'),
(4, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `publications`
--

CREATE TABLE `publications` (
  `ID_publication` int(11) NOT NULL,
  `lieu` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `heure` varchar(255) NOT NULL,
  `commentaire` varchar(255) DEFAULT NULL,
  `photo` varchar(255) NOT NULL,
  `ID_createur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `publications`
--

INSERT INTO `publications` (`ID_publication`, `lieu`, `date`, `heure`, `commentaire`, `photo`, `ID_createur`) VALUES
(1, 'Paris', '2023-11-25', '11:00', 'Porte ouverte à l\'ECE Paris', 'publication/eve_4', 2);

-- --------------------------------------------------------

--
-- Structure de la table `reseau_ami`
--

CREATE TABLE `reseau_ami` (
  `ID` int(11) NOT NULL,
  `ID_ami` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reseau_ami`
--

INSERT INTO `reseau_ami` (`ID`, `ID_ami`) VALUES
(1, 2),
(2, 1),
(3, 2),
(4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `ID` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`ID`, `nom`, `prenom`, `email`, `mdp`, `photo`) VALUES
(1, 'Bourillon', 'Clothilde', 'clothilde.bourillon@gmail.com', 'Cloclo la plus forte', 'pp_ece/ppclothilde.jpeg'),
(2, 'Bruneton', 'Elise', 'elise.bruneton@gmail.com', 'toto', 'pp_ece/ppelise.jpeg'),
(3, 'Chihab', 'Mouna', 'mouna.chihab@gmail.com', 'Moumou', 'pp_ece/ppmouna.jpeg'),
(4, 'Hirtzmann', 'Julie', 'julie.hirtzmann@gmail.com', 'Julie la plus belle', 'pp_ece/ppjulie.jpg'),
(11, 'Bruneton', 'Clémence', 'clemgd2@yahoo.fr', 'Maman', 'pp_ece/inconnu.jpeg'),
(12, 'Bruneton', 'Valentine', 'valentine.bruneton@gmail.com', 'toto2003', 'pp_ece/inconnu.jpeg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `emplois`
--
ALTER TABLE `emplois`
  ADD PRIMARY KEY (`ID_emplois`);

--
-- Index pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD PRIMARY KEY (`ID_event`);

--
-- Index pour la table `informations`
--
ALTER TABLE `informations`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`ID_publication`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `emplois`
--
ALTER TABLE `emplois`
  MODIFY `ID_emplois` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `evenements`
--
ALTER TABLE `evenements`
  MODIFY `ID_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `informations`
--
ALTER TABLE `informations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `publications`
--
ALTER TABLE `publications`
  MODIFY `ID_publication` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : dim. 17 déc. 2023 à 16:29
-- Version du serveur : 5.7.24
-- Version de PHP : 8.0.1

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
-- Structure de la table `cv`
--

CREATE TABLE `cv` (
  `ID_CV` int(11) NOT NULL,
  `ID` int(15) DEFAULT NULL,
  `lienCV` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cv`
--

INSERT INTO `cv` (`ID_CV`, `ID`, `lienCV`) VALUES
(6, 3, 'cvmouna.pdf'),
(7, 2, 'cvelise.pdf'),
(8, 4, 'cvjulie.pdf'),
(10, 3, 'TD-TP6 - MySQL et PHP ING3 2023-2024 (1).pdf');

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
  `type_event` varchar(255) NOT NULL,
  `lieu_event` varchar(255) NOT NULL,
  `commentaire_event` varchar(255) DEFAULT NULL,
  `photo_event` varchar(255) NOT NULL,
  `date_event` date NOT NULL,
  `heure_irl_event` varchar(255) DEFAULT NULL,
  `date_irl_event` date DEFAULT NULL,
  `etat_event` varchar(255) DEFAULT NULL,
  `ID_createur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`ID_event`, `type_event`, `lieu_event`, `commentaire_event`, `photo_event`, `date_event`, `heure_irl_event`, `date_irl_event`, `etat_event`, `ID_createur`) VALUES
(2, 'Porte Ouverte', 'Paris', 'JPO de l\'ECE', 'eve_2.jpeg', '2023-11-04', '13:46', '2023-12-12', 'public', 2),
(23, 'Portes ouvertes', 'ECE PARIS', 'Super évènement à l\'ECE PARIS lors d\'une journée portes ouvertes !', 'eve_1.jpeg', '2023-12-27', '14:34', '2023-12-13', 'public', 1),
(24, 'Forum', 'ECE PARIS', 'Nous avons pu voir l\'ECE sous un nouveau jour, grace à notre forum .', 'eve_3.jpeg', '2023-11-13', '23:06', '2023-12-19', 'public', 4),
(56, 'Portes Ouvertes', 'PARIS', 'Super intéressant !', 'eve_4.jpeg', '2023-12-14', '12:23', '2023-12-12', 'public', 3),
(57, 'PO', 'PARIS', 'Journée portes Ouvertes à l\'ECE Paris', 'ece.jpeg', '2023-12-21', '12:01', '2023-12-11', 'public', 3),
(58, 'kkk', 'kkk', 'kk', '', '2023-12-06', '13:51:49', '2023-12-17', 'public', 3);

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

CREATE TABLE `formations` (
  `Numformation` int(11) NOT NULL,
  `ID` int(15) DEFAULT NULL,
  `ecole` varchar(255) DEFAULT NULL,
  `competence` varchar(255) DEFAULT NULL,
  `domaine` varchar(255) DEFAULT NULL,
  `dateDebut` date DEFAULT NULL,
  `dateFin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `formations`
--

INSERT INTO `formations` (`Numformation`, `ID`, `ecole`, `competence`, `domaine`, `dateDebut`, `dateFin`) VALUES
(1, NULL, 'ok', 'k', 'k', '2023-12-20', '2024-01-03'),
(2, 3, 'ok', 'pk', 'pk', '2023-12-28', '2023-12-21'),
(3, NULL, 'ok', 'k', 'k', '2024-01-04', '2023-12-29'),
(4, 3, 'testmoun', 'kkk', 'k', '2023-12-28', '2024-01-06'),
(5, 3, 'lol', 'l', 'l', '2023-12-29', '2023-12-30'),
(6, 3, 'oo', 'o', 'o', '2024-01-04', '2023-12-30');

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
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `ID` int(15) DEFAULT NULL,
  `ID_event` int(15) DEFAULT NULL,
  `ID_emplois` int(15) DEFAULT NULL,
  `ID_post` int(15) DEFAULT NULL,
  `etat` varchar(255) DEFAULT NULL,
  `ID_notifications` int(15) NOT NULL,
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE `projets` (
  `NumProjet` int(11) NOT NULL,
  `ID` int(15) DEFAULT NULL,
  `Lieu` varchar(255) DEFAULT NULL,
  `competence` varchar(255) DEFAULT NULL,
  `domaine` varchar(255) DEFAULT NULL,
  `dateDebut` date DEFAULT NULL,
  `dateFin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `projets`
--

INSERT INTO `projets` (`NumProjet`, `ID`, `Lieu`, `competence`, `domaine`, `dateDebut`, `dateFin`) VALUES
(1, 3, 'Ecoleece', 'k', 'k', '2023-12-06', '2023-12-21'),
(2, 3, 'ecoleEce', 'ok', 'k', '2024-01-03', '2024-01-05'),
(3, 3, 'etranger', 'ok', 'k', '2023-12-27', '2023-12-22');

-- --------------------------------------------------------

--
-- Structure de la table `publications`
--

CREATE TABLE `publications` (
  `ID_publication` int(11) NOT NULL,
  `lieu_publications` varchar(255) DEFAULT NULL,
  `date_publications` date NOT NULL,
  `heure_publications` varchar(255) NOT NULL,
  `commentaire_publications` varchar(255) DEFAULT NULL,
  `photo_publications` varchar(255) NOT NULL,
  `etat_publications` varchar(255) NOT NULL,
  `ID_createur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `publications`
--

INSERT INTO `publications` (`ID_publication`, `lieu_publications`, `date_publications`, `heure_publications`, `commentaire_publications`, `photo_publications`, `etat_publications`, `ID_createur`) VALUES
(1, 'Paris', '2023-11-25', '11:00', 'L\'association UPA de l\'ECE PARIS ouvre enfin ses portes !', 'upa.jpeg', '', 2),
(4, NULL, '2023-12-13', '13:30', 'Direction la bulgarie avec l\'ECE PARIS !', '', '', 4),
(5, NULL, '2023-12-16', '15:46', 'Cher réseau, je suis à la recherche d\'une alternance ', 'attention.jpeg', '', 1),
(10, 'Paris', '2023-12-17', '12:31:25', 'J\'ai obtenu un poste chez Thalès !', 'thales.jpeg', 'public', 3);

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
-- Structure de la table `statut`
--

CREATE TABLE `statut` (
  `ID` int(11) NOT NULL,
  `tonstatut` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `statut`
--

INSERT INTO `statut` (`ID`, `tonstatut`) VALUES
(1, 'Bonjour, je m\'appelle Clothilde Bourillon et je suis actuellement à l\'ECE Paris. Je recherche un stage de 5 semaines à partir de janvier.'),
(2, 'Hello ! C\'est Elise et je suis à l\'ECE Paris. '),
(3, 'Bonjour, actuellement scolarisée à l\'ECE Paris, je recherche un stage dans le domaine de l\'aeronautique dès maintenant. Merci de m\'envoyer un message si vous avez une piste !'),
(4, 'Coucou c\'est Julie ! Je suis en ING3'),
(11, ''),
(12, '');

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
  `photo` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`ID`, `nom`, `prenom`, `email`, `mdp`, `photo`, `description`) VALUES
(1, 'Bourillon', 'Clothilde', 'clothilde.bourillon@gmail.com', 'cloclo', 'pp_ece/ppclothilde.jpeg', 'Elève à l\'ECE PARIS, j\'ai hate de devenir une future ingénieur accomplie !'),
(2, 'Bruneton', 'Elise', 'elise.bruneton@gmail.com', 'toto', 'pp_ece/ppelise.jpeg', 'Etudiante dynamique et sérieuse à l\'ECE Paris, je suis passionnée par la data.'),
(3, 'Chihab', 'Mouna', 'mounachihab@gmail.com', 'Moumou', 'nouvelle_photo_utilisateur_3.jpeg', 'Coucou ! J\'étudie à l\'ECE PARIS'),
(4, 'Hirtzmann', 'Julie', 'julie.hirtzmann@gmail.com', 'juju', 'pp_ece/ppjulie.jpeg', 'Hello ! c\'est julie et je suis à l\'ECE PARIS'),
(11, 'Bruneton', 'Clémence', 'clemgd2@yahoo.fr', 'Maman', 'pp_ece/inconnu.jpeg', ''),
(12, 'Bruneton', 'Valentine', 'valentine.bruneton@gmail.com', 'toto2003', 'pp_ece/inconnu.jpeg', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`ID_CV`),
  ADD KEY `ID` (`ID`);

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
-- Index pour la table `formations`
--
ALTER TABLE `formations`
  ADD PRIMARY KEY (`Numformation`),
  ADD KEY `ID` (`ID`);

--
-- Index pour la table `informations`
--
ALTER TABLE `informations`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`ID_notifications`);

--
-- Index pour la table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`NumProjet`),
  ADD KEY `ID` (`ID`);

--
-- Index pour la table `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`ID_publication`);

--
-- Index pour la table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cv`
--
ALTER TABLE `cv`
  MODIFY `ID_CV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `emplois`
--
ALTER TABLE `emplois`
  MODIFY `ID_emplois` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `evenements`
--
ALTER TABLE `evenements`
  MODIFY `ID_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pour la table `formations`
--
ALTER TABLE `formations`
  MODIFY `Numformation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `informations`
--
ALTER TABLE `informations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `ID_notifications` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `projets`
--
ALTER TABLE `projets`
  MODIFY `NumProjet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `publications`
--
ALTER TABLE `publications`
  MODIFY `ID_publication` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cv`
--
ALTER TABLE `cv`
  ADD CONSTRAINT `cv_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `utilisateurs` (`ID`);

--
-- Contraintes pour la table `formations`
--
ALTER TABLE `formations`
  ADD CONSTRAINT `formations_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `utilisateurs` (`ID`);

--
-- Contraintes pour la table `projets`
--
ALTER TABLE `projets`
  ADD CONSTRAINT `projets_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `utilisateurs` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

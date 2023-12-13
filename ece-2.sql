-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 13 déc. 2023 à 11:09
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
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `ID_comm` int(11) NOT NULL,
  `ID_publication` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `comm` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE `evenements` (
  `ID_event` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `ID_createur` int(11) NOT NULL,
  `descriptions` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`ID_event`, `type`, `lieu`, `photo`, `date`, `ID_createur`, `descriptions`) VALUES
(5, 'Conférence', 'Paris', 'even/conf_1.jpeg', '2023-12-30', 15, 'Conférence de thermodynamique, à Paris qui à eu lieu en septembre et qui se réitère une nouvelle fois en fin décembre.'),
(6, 'Portes Ouvertes', 'ECE', 'even/eve_4.png', '2023-12-23', 16, 'Nouvelles portes ouvertes de notre campus, venez découvrir notre école, ainsi que nos élèves, qui vous ferons visiter nos locaux'),
(7, 'Portes ouvertes', 'ECE\r\n', 'even/eve_1.jpeg', '2024-01-19', 16, 'Nouvelles portes ouvertes de notre campus, venez découvrir notre école, ainsi que nos élèves, qui vous ferons visiter nos locaux'),
(8, 'Kick-off formula Student', 'ECE', 'even/eve_5.jpg', '2023-12-21', 16, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `informations`
--

CREATE TABLE `informations` (
  `ID` int(11) NOT NULL,
  `date` varchar(255) DEFAULT NULL,
  `civilite` varchar(255) DEFAULT NULL,
  `admin` varchar(255) NOT NULL DEFAULT 'NO',
  `Q1` varchar(255) DEFAULT NULL,
  `Q2` varchar(255) DEFAULT NULL,
  `Q3` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `informations`
--

INSERT INTO `informations` (`ID`, `date`, `civilite`, `admin`, `Q1`, `Q2`, `Q3`) VALUES
(1, '2003', 'Mme', 'YES', NULL, NULL, NULL),
(2, '2003', 'Mme', 'YES', 'Genot', NULL, NULL),
(3, NULL, 'Mme', 'YES', NULL, NULL, NULL),
(4, '2003', 'Mme', 'YES', 'Caillol', 'doudou canard', 'Gribouille'),
(11, '1976', 'Mme', 'NO', NULL, NULL, NULL),
(12, '2006', 'Mme', 'NO', 'Genot', 'nono', 'zouzou'),
(14, '1976', 'Mr', 'NO', 'Leroy', NULL, NULL),
(15, NULL, NULL, 'NO', NULL, NULL, NULL),
(16, NULL, NULL, 'YES', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `ID_likeur` int(11) NOT NULL,
  `ID_publication` int(11) NOT NULL,
  `ID_likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`ID_likeur`, `ID_publication`, `ID_likes`) VALUES
(13, 6, 14),
(13, 11, 15),
(13, 12, 16),
(13, 14, 17),
(11, 16, 22),
(11, 11, 23),
(11, 12, 24),
(11, 14, 27),
(11, 6, 28),
(2, 14, 29),
(2, 12, 30),
(2, 11, 31),
(2, 16, 32),
(2, 10, 33),
(2, 8, 34),
(2, 7, 35),
(2, 5, 36);

-- --------------------------------------------------------

--
-- Structure de la table `publications`
--

CREATE TABLE `publications` (
  `ID_publication` int(11) NOT NULL,
  `lieu` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `photo` varchar(255) NOT NULL,
  `etat` varchar(255) DEFAULT 'AMIS',
  `ID_createur` int(11) NOT NULL,
  `descriptions` varchar(255) DEFAULT NULL,
  `heure` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `publications`
--

INSERT INTO `publications` (`ID_publication`, `lieu`, `date`, `photo`, `etat`, `ID_createur`, `descriptions`, `heure`) VALUES
(5, 'Paris', '2023-12-03', 'pp_ece/ppclothilde.jpeg', 'PUBLIC', 1, 'Nouvelle photo de profil.', '10:00'),
(7, 'Paris', '2023-12-03', 'pp_ece/ppjulie.jpeg', 'AMIS', 4, 'Nouvelle photo de profil.', '15:00'),
(8, 'Paris', '2023-12-04', 'pp_ece/ppmouna.jpeg', 'PUBLIC', 3, 'Nouvelle photo de profil.', '10:00'),
(10, 'Paris', '2023-12-08', 'pp_ece/pp_clem.jpeg', 'AMIS', 11, 'Nouvelle photo de profil.', '08:00'),
(11, 'Paris', '2023-12-08', 'publication/eleve_ece.jpg', 'PUBLIC', 16, 'Merci à nos élèves pour ces portes ouvertes !', '10:00'),
(12, 'Paris', '2023-12-03', 'publication/ece_lieu.jpg', 'PUBLIC', 16, '', '11:00'),
(14, 'Paris', '2023-10-25', 'publication/eve_2.jpeg', 'AMIS', 16, 'Petit retour de nos portes ouvertes !', '10:00'),
(15, 'Le Mans', '2023-12-24', 'publication/event_retrouvaille.jpeg', 'AMIS', 15, 'Petit réunion entre anciens élèves.', '11:00'),
(16, 'Chicago', '2023-12-15', 'publication/us_post.jpeg', 'AMIS', 14, 'Nouveau travail aux US.', '17:00');

-- --------------------------------------------------------

--
-- Structure de la table `reseau_ami`
--

CREATE TABLE `reseau_ami` (
  `ID` int(11) NOT NULL,
  `ID_ami` int(11) NOT NULL,
  `ID_relation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reseau_ami`
--

INSERT INTO `reseau_ami` (`ID`, `ID_ami`, `ID_relation`) VALUES
(4, 3, 4),
(14, 11, 19),
(11, 14, 20),
(1, 3, 21),
(1, 4, 22),
(3, 1, 23),
(3, 4, 24),
(4, 1, 25),
(2, 1, 26),
(2, 3, 27),
(2, 4, 28),
(2, 14, 29),
(2, 11, 30),
(1, 2, 31),
(3, 2, 32),
(4, 2, 33),
(14, 2, 34),
(11, 2, 35);

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
(1, 'Bourillon', 'Clothilde', 'clothilde.bourillon@gmail.com', 'cloclo', 'pp_ece/ppclothilde.jpeg'),
(2, 'Bruneton', 'Elise', 'elise.bruneton@gmail.com', 'toto', 'pp_ece/ppelise.jpeg'),
(3, 'Chihab', 'Mouna', 'mouna.chihab@gmail.com', 'moumou', 'pp_ece/ppmouna.jpeg'),
(4, 'Hirtzmann', 'Julie', 'julie.hirtzmann@gmail.com', 'juju', 'pp_ece/ppjulie.jpeg'),
(11, 'Bruneton', 'Clémence', 'clemgd2@yahoo.fr', 'Maman', 'pp_ece/pp_clem.jpeg'),
(14, 'Bruneton', 'Jean-Marc', 'jm.bruneton@gmail.com', 'toto', 'pp_ece/pp_jm.jpeg'),
(15, 'Leroy', 'Jean-Philipe', 'jp.lr@gmail.com', 'physique', 'pp_ece/pp_jp.jpeg'),
(16, 'Paris', 'ECE', 'ece@ece.fr', 'ece/inge', 'pp_ece/ppece.jpeg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`ID_comm`);

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
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`ID_likes`);

--
-- Index pour la table `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`ID_publication`);

--
-- Index pour la table `reseau_ami`
--
ALTER TABLE `reseau_ami`
  ADD PRIMARY KEY (`ID_relation`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `ID_comm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `emplois`
--
ALTER TABLE `emplois`
  MODIFY `ID_emplois` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT pour la table `evenements`
--
ALTER TABLE `evenements`
  MODIFY `ID_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `informations`
--
ALTER TABLE `informations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `ID_likes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `publications`
--
ALTER TABLE `publications`
  MODIFY `ID_publication` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `reseau_ami`
--
ALTER TABLE `reseau_ami`
  MODIFY `ID_relation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

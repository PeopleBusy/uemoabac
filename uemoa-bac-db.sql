-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mar. 22 mai 2018 à 23:19
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `uemoa-bac-db`
--

-- --------------------------------------------------------

--
-- Structure de la table `configuration`
--

CREATE TABLE `configuration` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valeur` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE `eleve` (
  `id` int(11) NOT NULL,
  `matricule` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datenaiss` date NOT NULL,
  `lieunaiss` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sexe` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `autorise_inscription` smallint(6) NOT NULL,
  `nb_reinscription` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `eleve`
--

INSERT INTO `eleve` (`id`, `matricule`, `nom`, `prenom`, `datenaiss`, `lieunaiss`, `sexe`, `autorise_inscription`, `nb_reinscription`) VALUES
(3, '12345', 'TOTO', 'Martin', '1990-09-17', 'LOME', 'M', 0, 1),
(4, '00001', 'LECORRE', 'Pauline', '1995-03-02', 'KPALIME', 'F', 0, 0),
(6, '12346', 'JOHN', 'Marc', '1993-02-09', 'ATAKPAME', 'M', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE `inscription` (
  `id` int(11) NOT NULL,
  `date_inscription` date NOT NULL,
  `pays` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `annee` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `etablissement` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ajourne` tinyint(1) NOT NULL,
  `motif_ajournement` longtext COLLATE utf8_unicode_ci NOT NULL,
  `inscription_apres_nbannees` smallint(6) NOT NULL,
  `eleve_id` int(11) DEFAULT NULL,
  `annee_fin_restriction` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `inscription`
--

INSERT INTO `inscription` (`id`, `date_inscription`, `pays`, `annee`, `etablissement`, `ajourne`, `motif_ajournement`, `inscription_apres_nbannees`, `eleve_id`, `annee_fin_restriction`) VALUES
(1, '2018-04-27', 'Togo', '2018', 'LYCEE DE TOKOIN', 1, 'Tricherie', 0, 3, NULL),
(2, '2018-05-01', 'Togo', '2018', 'LYCEE DU PORT', 0, '', 0, 4, NULL),
(5, '2018-05-03', 'Benin', '2018', 'LYCEE D\'ABOMEY CALAVI', 0, '', 0, 3, NULL),
(6, '2018-05-03', 'Togo', '2018', 'LYCEE ATAKPAME', 1, 'Tricherie', 0, 6, NULL),
(7, '2018-05-03', 'Benin', '2018', 'LYCEE ATAKPAME', 0, '', 0, 6, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `operation`
--

CREATE TABLE `operation` (
  `id` int(11) NOT NULL,
  `libelle` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `date_heure` datetime NOT NULL,
  `auteur` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `type_operation` smallint(6) NOT NULL,
  `inscription_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `operation`
--

INSERT INTO `operation` (`id`, `libelle`, `date_heure`, `auteur`, `type_operation`, `inscription_id`) VALUES
(1, 'save', '2018-04-27 20:44:46', 'PARKER Peter', 1, 1),
(2, 'save', '2018-05-01 19:13:44', 'PARKER Peter', 1, 2),
(5, 'Ajournement', '2018-05-03 17:46:00', 'PARKER Peter', 3, 1),
(6, 'Ajournement', '2018-05-03 17:52:39', 'PARKER Peter', 3, 1),
(7, 'Autoriser', '2018-05-03 18:04:47', 'PARKER Peter', 4, 1),
(8, 'save', '2018-05-03 18:05:56', 'DUPONT Paul', 1, 5),
(9, 'save', '2018-05-03 18:51:51', 'PARKER Peter', 1, 6),
(10, 'Ajournement', '2018-05-03 18:54:33', 'PARKER Peter', 3, 6),
(11, 'Autoriser', '2018-05-03 18:56:13', 'PARKER Peter', 4, 6),
(12, 'save', '2018-05-03 19:00:02', 'DUPONT Paul', 1, 7);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auteur` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_heure` datetime NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `is_active` tinyint(1) NOT NULL,
  `pays` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `username`, `password`, `auteur`, `date_heure`, `roles`, `is_active`, `pays`) VALUES
(1, 'ADMINISTRATEUR', 'Admin', 'administrateur', '$2y$13$cNdC2ikU65gYoQ8YSoSSe.lA2ugjvjEpOikCAGEIFTY3aJn6PZJ6m', 'ADMIN', '2018-04-25 17:33:37', 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', 1, 'Togo'),
(4, 'DUPONT', 'Paul', 'dupaul', '$2y$13$2hdCgKggmVpySAAwa5umaeGGISK9X.tr6BlbuT1YwWQsZkSeCE/EK', 'Admin', '2018-04-27 18:21:30', 'a:1:{i:0;s:9:\"ROLE_USER\";}', 1, 'Benin'),
(5, 'MICHAEL', 'Edouard', 'michael', '$2y$13$YyqtLYKTGBuNWEwx3fVlguMB6aqNX.WCf/VXzjYtWVYqr/clj2L7W', 'Admin', '2018-04-27 18:21:32', 'a:1:{i:0;s:9:\"ROLE_USER\";}', 1, 'Mali'),
(6, 'PARKER', 'Peter', 'peter', '$2y$13$2WVqxGjSD20WdGaBsEoaUuFVSRv6kqkM/3Lk435HBHdiK8Sxl7osy', 'Admin', '2018-04-27 18:23:01', 'a:1:{i:0;s:9:\"ROLE_USER\";}', 1, 'Togo');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5E90F6D6A6CC7B2` (`eleve_id`);

--
-- Index pour la table `operation`
--
ALTER TABLE `operation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1981A66D5DAC5993` (`inscription_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `configuration`
--
ALTER TABLE `configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `eleve`
--
ALTER TABLE `eleve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `inscription`
--
ALTER TABLE `inscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `operation`
--
ALTER TABLE `operation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `FK_5E90F6D6A6CC7B2` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`id`);

--
-- Contraintes pour la table `operation`
--
ALTER TABLE `operation`
  ADD CONSTRAINT `FK_1981A66D5DAC5993` FOREIGN KEY (`inscription_id`) REFERENCES `inscription` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

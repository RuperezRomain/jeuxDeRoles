-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 09 Février 2017 à 13:45
-- Version du serveur :  5.7.17-0ubuntu0.16.04.1
-- Version de PHP :  7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `jeu_de_role`
--

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fk_stats` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `classe`
--

INSERT INTO `classe` (`id`, `nom`, `fk_stats`) VALUES
(1, 'Guerrier', 6),
(2, 'Magicien', 7),
(3, 'Archer', 8),
(4, 'Palade', 9),
(5, 'Crétin', 10);

-- --------------------------------------------------------

--
-- Structure de la table `personnage`
--

CREATE TABLE `personnage` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pa` int(11) NOT NULL,
  `fk_stats` int(11) DEFAULT NULL,
  `fk_race` int(11) DEFAULT NULL,
  `fk_classe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `race`
--

CREATE TABLE `race` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fk_stats` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `race`
--

INSERT INTO `race` (`id`, `nom`, `fk_stats`) VALUES
(1, 'Humain', 1),
(2, 'Elfe', 2),
(3, 'Orc', 3),
(4, 'Nain', 4),
(5, 'Lapin', 5);

-- --------------------------------------------------------

--
-- Structure de la table `stats`
--

CREATE TABLE `stats` (
  `id` int(11) NOT NULL,
  `pv` int(11) NOT NULL,
  `mov` int(11) NOT NULL,
  `att` int(11) NOT NULL,
  `def` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `stats`
--

INSERT INTO `stats` (`id`, `pv`, `mov`, `att`, `def`) VALUES
(1, 1000, 4, 100, 0.15),
(2, 750, 6, 120, 0.1),
(3, 1350, 3, 150, 0.25),
(4, 1150, 2, 135, 0.38),
(5, 550, 8, 50, -0.5),
(6, 200, -1, 25, 0.1),
(7, -300, 1, 50, -0.08),
(8, -248, 2, 20, -0.04),
(9, 2000, 5, -200, 0.3),
(10, 10000, 10, 300, -0.5);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8F87BF9696AA44DF` (`fk_stats`);

--
-- Index pour la table `personnage`
--
ALTER TABLE `personnage`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_6AEA486D96AA44DF` (`fk_stats`),
  ADD UNIQUE KEY `UNIQ_6AEA486D56516591` (`fk_race`),
  ADD UNIQUE KEY `UNIQ_6AEA486DAF29D706` (`fk_classe`);

--
-- Index pour la table `race`
--
ALTER TABLE `race`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_DA6FBBAF96AA44DF` (`fk_stats`);

--
-- Index pour la table `stats`
--
ALTER TABLE `stats`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `personnage`
--
ALTER TABLE `personnage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `race`
--
ALTER TABLE `race`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `stats`
--
ALTER TABLE `stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `FK_8F87BF9696AA44DF` FOREIGN KEY (`fk_stats`) REFERENCES `stats` (`id`);

--
-- Contraintes pour la table `personnage`
--
ALTER TABLE `personnage`
  ADD CONSTRAINT `FK_6AEA486D56516591` FOREIGN KEY (`fk_race`) REFERENCES `race` (`id`),
  ADD CONSTRAINT `FK_6AEA486D96AA44DF` FOREIGN KEY (`fk_stats`) REFERENCES `stats` (`id`),
  ADD CONSTRAINT `FK_6AEA486DAF29D706` FOREIGN KEY (`fk_classe`) REFERENCES `classe` (`id`);

--
-- Contraintes pour la table `race`
--
ALTER TABLE `race`
  ADD CONSTRAINT `FK_DA6FBBAF96AA44DF` FOREIGN KEY (`fk_stats`) REFERENCES `stats` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

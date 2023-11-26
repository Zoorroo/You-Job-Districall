-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le : dim. 26 nov. 2023 à 15:57
-- Version du serveur : 5.7.36
-- Version de PHP : 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `youjob`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

DROP TABLE IF EXISTS `annonce`;
CREATE TABLE IF NOT EXISTS `annonce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`id`, `iduser`, `titre`, `description`, `date`) VALUES
(1, 1, 'Test Annonce blog', 'Districall', '2023-11-26 15:22:59'),
(6, 53, 'Districall', 'Districall', '2023-11-26 16:05:56'),
(12, 53, 'Districall blog!', 'Test', '2023-11-26 16:23:08');

-- --------------------------------------------------------

--
-- Structure de la table `connexion`
--

DROP TABLE IF EXISTS `connexion`;
CREATE TABLE IF NOT EXISTS `connexion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_entreprise` int(11) DEFAULT NULL,
  `login` varchar(150) NOT NULL,
  `mdp` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `propriete_annonce`
--

DROP TABLE IF EXISTS `propriete_annonce`;
CREATE TABLE IF NOT EXISTS `propriete_annonce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_annonce` int(11) NOT NULL,
  `contenu` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `propriete_message`
--

DROP TABLE IF EXISTS `propriete_message`;
CREATE TABLE IF NOT EXISTS `propriete_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_message` int(11) NOT NULL,
  `contenu` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `age` int(3) DEFAULT NULL,
  `sex` int(1) DEFAULT NULL COMMENT '1 = women, 0 = man\r\n',
  `roles` json NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `email`, `password`, `age`, `sex`, `roles`) VALUES
(49, 'z@ga.com', '$2y$13$7YGGycIqmgTlOSd1o0gMPen7kErnfso2M8ltg8CW1n172nCejeoTC', 0, 0, 'null'),
(50, 'a@f.c', '$2y$13$c0a.YljWgpqB4tyXEok5XebDzJjKpiyVh7hfYCpxWIvLrbWag8c2m', 34, NULL, 'null'),
(51, 'anouaer@gmlail.coom', '$2y$13$DwF0IYQYQmwShDz6SN.on.CSw0xnbP3I5LvQz33AfVG/7cO/QI5Ei', 18, NULL, 'null'),
(52, 'anouar@gmail.com', '$2y$13$3kBv1ZF.WVDcQNHelHeVQOhfsoHda7irgIzO1/eIIK6A.y72iTkSK', 18, NULL, '[]'),
(53, 'elammari00@gmail.com', '$2y$13$99bM77sgCz1PNafz5Sq2mO9GDVnmu2atE35S77bYvyovLU64EThrC', 18, NULL, '[]');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

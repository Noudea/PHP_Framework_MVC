-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 13 août 2020 à 16:23
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `e3wa`
--

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noteTitle` varchar(30) NOT NULL,
  `noteContent` text NOT NULL,
  `noteColor` varchar(30) NOT NULL,
  `noteAuthorID` int(11) NOT NULL,
  `noteDate` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `noteAuthorID` (`noteAuthorID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`id`, `noteTitle`, `noteContent`, `noteColor`, `noteAuthorID`, `noteDate`) VALUES
(16, 'zaeazeaze', 'ezaezaeaze', 'zaeae', 56, '2020-08-05'),
(22, 'aeazeazeaz', '     zaeazeaeazeaz       ', 'red', 59, '2008-09-20'),
(23, 'azeazeaz', '           azeazeazeaze aazeazeazezeaze', 'red', 59, '2008-09-20'),
(24, 'azeazeaze', '         aze   ', 'red', 59, '2008-09-20');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(30) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(30) CHARACTER SET utf8 NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`, `role`, `created_at`) VALUES
(56, 'qsdqsdqdqd@gmail.com', 'dsqqdqsdq', '$2y$10$UtalnILSETr.cCo65SRu8eCVuCy3JtF0Pxd2uel0ZALNwXSQlUbx.', 'user', '2020-07-20'),
(58, 'aaqsdqdsqda@aaa.com', 'aeazeaea', '$2y$10$GQuECYFeLENi2IKd9.VUH..gq2fo0sq0W/EWZu54s3QurbST1cwgi', 'user', '2020-07-20'),
(59, 'adminadmin@gmail.com', 'adminadmin', '$2y$10$Fbb3wRkx.5Q1xBtxUFKjcerCsv23/ce455cVuz1lcLWluYzY3KHtq', 'user', '2020-08-03'),
(60, 'zaeaeazeazeezaea@gmail.com', 'azezaeazezaeza', '$2y$10$0wpyNbHwkqB0jpL/UjDbJeIrTO8SsBbaS4ufe1GnsAhnjcSp2Rk1a', 'user', '2020-08-03'),
(61, 'zaefdfddfd@qsfQ.com', 'zaezaezeaeze', '$2y$10$zvPNdlbTF/O8PuoJOezjo.9fSiqvjFU2vcSimT002u3JXIOsqhDFe', 'user', '2020-08-03');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_ibfk_1` FOREIGN KEY (`noteAuthorID`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

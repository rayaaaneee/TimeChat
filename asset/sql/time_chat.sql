-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 03 mars 2023 à 16:17
-- Version du serveur : 8.0.31
-- Version de PHP : 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `time_chat`
--

-- --------------------------------------------------------

--
-- Structure de la table `friends`
--

DROP TABLE IF EXISTS `friends`;
CREATE TABLE IF NOT EXISTS `friends` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user_1` int NOT NULL,
  `id_user_2` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user_1` (`id_user_1`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `friend_request`
--

DROP TABLE IF EXISTS `friend_request`;
CREATE TABLE IF NOT EXISTS `friend_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user_sender` int NOT NULL,
  `id_user_receiver` int NOT NULL,
  `accepted` tinyint(1) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user_receiver` (`id_user_receiver`),
  KEY `id_user_sender` (`id_user_sender`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `content` int NOT NULL,
  `viewed` tinyint(1) NOT NULL,
  `liked` tinyint(1) NOT NULL,
  `datetime` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `password` text NOT NULL,
  `description` varchar(300) NOT NULL,
  `profile_picture` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'default.png',
  `banner` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'default.png',
  `signup_at` date NOT NULL,
  `is_public` tinyint(1) NOT NULL,
  `is_connected` tinyint(1) NOT NULL DEFAULT '0',
  `nb_friends` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `description`, `profile_picture`, `banner`, `signup_at`, `is_public`, `is_connected`, `nb_friends`) VALUES
(17, 'root', '$2y$10$3p8PcLCB6hjULj5hHhzTF.gD7QIRN7EZKBTdO3sKFskdy0VE8Xj12', 'Admin et grand crack', 'root-23-03-03.jpg', 'default.png', '2023-03-03', 0, 0, 0),
(18, 'hippo', '$2y$10$F4yzvDXleGaEVI3Cv4sL1O3SHq8cRX.vPP8OKa1v4Y7bVbDX/GhH6', 'Emoji feu !!!', 'hippo-23-03-03.png', 'template.png', '2023-03-03', 1, 0, 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`id_user_1`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `friend_request`
--
ALTER TABLE `friend_request`
  ADD CONSTRAINT `friend_request_ibfk_1` FOREIGN KEY (`id_user_receiver`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `friend_request_ibfk_2` FOREIGN KEY (`id_user_sender`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

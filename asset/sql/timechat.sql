-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 14 mars 2023 à 13:31
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `timechat`
--

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

-- ---------------------------------------------------------

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `password` text NOT NULL,
  `description` varchar(300) NOT NULL,
  `profile_picture` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'default.png',
  `signup_at` date NOT NULL,
  `is_public` tinyint(1) NOT NULL,
  `is_connected` tinyint(1) NOT NULL DEFAULT '0',
  `nb_friends` int NOT NULL DEFAULT '0',
  `qrcode` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`username`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `friend`
--

DROP TABLE IF EXISTS friend;
CREATE TABLE friend (
id INT NOT NULL AUTO_INCREMENT UNIQUE,
id_user_1 INT NOT NULL,
id_user_2 INT NOT NULL,
CONSTRAINT check_users CHECK (id_user_1 < id_user_2),
CONSTRAINT pk_friend PRIMARY KEY (id_user_1, id_user_2)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `groups`
--

DROP TABLE IF EXISTS `group`;
CREATE TABLE IF NOT EXISTS `group` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_admin` int NOT NULL,
  `name` int NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `group_member`
--

DROP TABLE IF EXISTS `group_member`;
CREATE TABLE IF NOT EXISTS `group_member` (
  `id_group` int NOT NULL,
  `id_user` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Structure de la table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user_sender` int NOT NULL,
  `id_user_receiver` int NOT NULL,
  `type` int NOT NULL,
  `date` datetime NOT NULL,
  `is_viewed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user_sender`,`id_user_receiver`,`type`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `profile_theme`
--

DROP TABLE IF EXISTS `profile_theme`;
CREATE TABLE IF NOT EXISTS `profile_theme` (
  `id_user` int NOT NULL,
  `theme` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'red',
  `banner` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `id_user` (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


--
-- Contraintes de referencement pour toutes les tables
--
ALTER TABLE `message` ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

ALTER TABLE `friend` ADD CONSTRAINT `fk_friend_user1` FOREIGN KEY (id_user_1) REFERENCES user(id);
ALTER TABLE `friend` ADD CONSTRAINT `fk_friend_user2` FOREIGN KEY (id_user_2) REFERENCES user(id);

ALTER TABLE `group` ADD CONSTRAINT `fk_group_id_admin` FOREIGN KEY (id_admin) REFERENCES user(id);

ALTER TABLE `group_member` ADD CONSTRAINT `fk_group_member_id_user` FOREIGN KEY (id_user) REFERENCES user(id);

ALTER TABLE `message` ADD CONSTRAINT `fk_message_id_user` FOREIGN KEY (id_user) REFERENCES user(id);

ALTER TABLE `notification` ADD CONSTRAINT `fk_notification_user_sender` FOREIGN KEY (id_user_sender) REFERENCES user(id); 
ALTER TABLE `notification` ADD CONSTRAINT `fk_notification_user_receiver` FOREIGN KEY (id_user_receiver) REFERENCES user(id);

ALTER TABLE `profile_theme` ADD CONSTRAINT `fk_profile_theme_id_user` FOREIGN KEY (id_user) REFERENCES user(id);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

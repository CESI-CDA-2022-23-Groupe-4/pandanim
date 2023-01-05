-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 05 jan. 2023 à 07:08
-- Version du serveur : 5.7.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pandanim`
--
CREATE DATABASE IF NOT EXISTS `pandanim` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `pandanim`;

-- --------------------------------------------------------

--
-- Structure de la table `anime`
--

DROP TABLE IF EXISTS `anime`;
CREATE TABLE IF NOT EXISTS `anime` (
  `id` smallint(5) UNSIGNED NOT NULL COMMENT 'not auto increment -> getted from API',
  `image_url` varchar(50) DEFAULT NULL,
  `small_image_url` varchar(52) DEFAULT NULL,
  `large_image_url` varchar(52) DEFAULT NULL,
  `trailer` varchar(12) DEFAULT NULL COMMENT 'Youtube id',
  `title` varchar(150) DEFAULT NULL,
  `title_english` varchar(150) DEFAULT NULL,
  `title_japanese` varchar(200) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `episodes` smallint(5) UNSIGNED DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `aired_from` date DEFAULT NULL,
  `aired_to` date DEFAULT NULL,
  `duration` varchar(25) DEFAULT NULL,
  `mal_score` decimal(4,2) DEFAULT NULL COMMENT 'Reviewer score from MyAnimeList (max to 10.00)',
  `scored_by` int(11) UNSIGNED DEFAULT NULL COMMENT '	Number of reviewer from MyAnimeList',
  `rating` varchar(50) DEFAULT NULL,
  `synopsis` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `anime_genre`
--

DROP TABLE IF EXISTS `anime_genre`;
CREATE TABLE IF NOT EXISTS `anime_genre` (
  `anime_id` smallint(5) UNSIGNED NOT NULL,
  `genre_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `anime_studio`
--

DROP TABLE IF EXISTS `anime_studio`;
CREATE TABLE IF NOT EXISTS `anime_studio` (
  `anime_id` smallint(5) UNSIGNED NOT NULL,
  `studio_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id` smallint(5) UNSIGNED NOT NULL COMMENT 'not auto increment -> getted from API',
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `anime_id` smallint(5) UNSIGNED NOT NULL,
  `user_id` smallint(5) UNSIGNED NOT NULL,
  `score` tinyint(1) UNSIGNED NOT NULL,
  `comment` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `review`
--

INSERT INTO `review` (`anime_id`, `user_id`, `score`, `comment`) VALUES
(1, 1, 10, 'sqd'),
(1, 1, 99, 'sqd'),
(1, 1, 100, 'sqd'),
(1, 1, 250, 'sqd'),
(1, 1, 255, 'sqd'),
(1, 1, 255, 'sqd');

-- --------------------------------------------------------

--
-- Structure de la table `studio`
--

DROP TABLE IF EXISTS `studio`;
CREATE TABLE IF NOT EXISTS `studio` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL COMMENT 'hashed (SHA-512)',
  `roles` json NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

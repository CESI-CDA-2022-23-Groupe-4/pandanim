-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.36 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.2.0.6576
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
CREATE DATABASE IF NOT EXISTS `pandanim` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `pandanim`;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour pandanim
CREATE DATABASE IF NOT EXISTS `pandanim` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `pandanim`;

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
  `active` boolean,
  `updatedAt` datetime,
  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id` smallint(5) UNSIGNED NOT NULL COMMENT 'not auto increment -> getted from API',
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Structure de la table `anime_genre`
--

DROP TABLE IF EXISTS `anime_genre`;
CREATE TABLE IF NOT EXISTS `anime_genre` (
  `anime_id` smallint(5) UNSIGNED NOT NULL,
  `genre_id` smallint(5) UNSIGNED NOT NULL,
  KEY `anime_id` (`anime_id`),
  KEY `genre_id` (`genre_id`),
  UNIQUE KEY `combined_id` (`anime_id`,`genre_id`),
  CONSTRAINT `anime_genre_ibfk_1` FOREIGN KEY (`anime_id`) REFERENCES `anime` (`id`),
  CONSTRAINT `anime_genre_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Structure de la table `studio`
--

DROP TABLE IF EXISTS `studio`;
CREATE TABLE IF NOT EXISTS `studio` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Structure de la table `anime_studio`
--

DROP TABLE IF EXISTS `anime_studio`;
CREATE TABLE IF NOT EXISTS `anime_studio` (
  `anime_id` smallint(5) UNSIGNED NOT NULL,
  `studio_id` smallint(5) UNSIGNED NOT NULL,
  KEY `FK_anime_studio_anime` (`anime_id`),
  KEY `FK_anime_studio_studio` (`studio_id`),
  UNIQUE KEY `combined_id` (`anime_id`,`studio_id`),
  CONSTRAINT `FK_anime_studio_anime` FOREIGN KEY (`anime_id`) REFERENCES `anime` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_anime_studio_studio` FOREIGN KEY (`studio_id`) REFERENCES `studio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

--
-- Structure de la table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `anime_id` smallint(5) UNSIGNED NOT NULL,
  `user_id` smallint(5) UNSIGNED NOT NULL,
  `score` tinyint(1) UNSIGNED NOT NULL,
  `comment` text,
  KEY `anime_id` (`anime_id`),
  KEY `FK_review_user` (`user_id`),
  UNIQUE KEY `combined_id` (`anime_id`,`user_id`),
  CONSTRAINT `FK_review_anime` FOREIGN KEY (`anime_id`) REFERENCES `anime` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_review_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

COMMIT;

-- Les données exportées n'étaient pas sélectionnées.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

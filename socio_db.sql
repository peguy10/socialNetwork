-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour social_db
DROP DATABASE IF EXISTS `social_db`;
CREATE DATABASE IF NOT EXISTS `social_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `social_db`;

-- Listage de la structure de table social_db. commentaires
DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int NOT NULL AUTO_INCREMENT,
  `contenu_id` int NOT NULL,
  `utilisateur_id` int NOT NULL,
  `commentaire` text NOT NULL,
  `date_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `contenu_id` (`contenu_id`),
  KEY `utilisateur_id` (`utilisateur_id`),
  CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`contenu_id`) REFERENCES `contenus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`utilisateur_id`) REFERENCES `createurs` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table social_db.commentaires : ~9 rows (environ)
DELETE FROM `commentaires`;
INSERT INTO `commentaires` (`id`, `contenu_id`, `utilisateur_id`, `commentaire`, `date_creation`) VALUES
	(1, 9, 1, 'bon', '2024-09-30 11:29:06'),
	(2, 10, 3, 'good\r\n', '2024-09-30 11:29:26'),
	(3, 9, 3, 'jaime', '2024-09-30 11:44:12'),
	(4, 10, 3, 'j\'aime', '2024-09-30 11:58:59'),
	(5, 10, 3, 'meilleur commentaire', '2024-09-30 11:59:25'),
	(6, 9, 3, 'bon commentaire', '2024-09-30 11:59:39'),
	(7, 8, 3, 'j\'aime ce commentaire', '2024-09-30 11:59:58'),
	(8, 11, 3, 'good', '2024-10-02 15:27:36'),
	(9, 11, 1, 'merci', '2024-10-02 15:28:06');

-- Listage de la structure de table social_db. contenus
DROP TABLE IF EXISTS `contenus`;
CREATE TABLE IF NOT EXISTS `contenus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` enum('texte','image','video') NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `utilisateur_id` int NOT NULL,
  `date_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `utilisateur_id` (`utilisateur_id`),
  CONSTRAINT `contenus_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `createurs` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table social_db.contenus : ~4 rows (environ)
DELETE FROM `contenus`;
INSERT INTO `contenus` (`id`, `type`, `description`, `image`, `video`, `utilisateur_id`, `date_creation`) VALUES
	(8, 'image', 'exemple de publication sur la mode', '../uploads/FB_IMG_1639988791326.jpg', NULL, 1, '2024-09-30 09:15:36'),
	(9, 'image', 'bonjou ma deuxieme publication du jours', '../uploads/bg.png', NULL, 1, '2024-09-30 09:51:34'),
	(10, 'image', 'exemple de publication du deuxieme utilisateur toujours sur la mode', '../uploads/CANVA NGA.jpg', NULL, 3, '2024-09-30 11:08:31'),
	(11, 'image', 'essai', '../uploads/Azur Image.png', NULL, 1, '2024-10-02 15:26:51');

-- Listage de la structure de table social_db. contenu_tags
DROP TABLE IF EXISTS `contenu_tags`;
CREATE TABLE IF NOT EXISTS `contenu_tags` (
  `contenu_id` int NOT NULL,
  `tag_id` int NOT NULL,
  PRIMARY KEY (`contenu_id`,`tag_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `contenu_tags_ibfk_1` FOREIGN KEY (`contenu_id`) REFERENCES `contenus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `contenu_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table social_db.contenu_tags : ~5 rows (environ)
DELETE FROM `contenu_tags`;
INSERT INTO `contenu_tags` (`contenu_id`, `tag_id`) VALUES
	(8, 4),
	(10, 4),
	(8, 5),
	(9, 6),
	(9, 7),
	(11, 9);

-- Listage de la structure de table social_db. createurs
DROP TABLE IF EXISTS `createurs`;
CREATE TABLE IF NOT EXISTS `createurs` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `motdepasse` varchar(255) NOT NULL,
  `bio` text,
  `date_inscription` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `photo` text,
  `tel` int DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table social_db.createurs : ~2 rows (environ)
DELETE FROM `createurs`;
INSERT INTO `createurs` (`id_user`, `nom`, `email`, `motdepasse`, `bio`, `date_inscription`, `photo`, `tel`) VALUES
	(1, 'PEGUY NK', 'peguynkouebo100@gmail.com', '$2y$10$EClM/QC7j9DpJU/0vLTE1u.G9uoUlJ41u1JcNMSxfsk.eJPp3sDpy', 'Je crois en la puissance des histoires et des expériences partagées. Chaque contenu que je crée vise à inspirer, éduquer et divertir, tout en restant fidèle à moi-même et à mes valeurs.', '2024-09-28 15:47:51', '../uploads/66f83f21387d1.png', 678563771),
	(3, 'Loïc Nk', 'loicnk25@gmail.com', '$2y$10$e7O4fuGsCBNYGJExeW6tQO3p1u8a.vggev0DparxD9V0IF3Ni/KXC', '', '2024-09-30 11:05:12', '../uploads/66fa85e87ca5e.jpeg', NULL);

-- Listage de la structure de table social_db. demandes_amitie
DROP TABLE IF EXISTS `demandes_amitie`;
CREATE TABLE IF NOT EXISTS `demandes_amitie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_demandeur` int NOT NULL,
  `id_destinataire` int NOT NULL,
  `statut` enum('en_attente','accepte','refuse') DEFAULT 'en_attente',
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_demandeur` (`id_demandeur`),
  KEY `id_destinataire` (`id_destinataire`),
  CONSTRAINT `demandes_amitie_ibfk_1` FOREIGN KEY (`id_demandeur`) REFERENCES `createurs` (`id_user`),
  CONSTRAINT `demandes_amitie_ibfk_2` FOREIGN KEY (`id_destinataire`) REFERENCES `createurs` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table social_db.demandes_amitie : ~0 rows (environ)
DELETE FROM `demandes_amitie`;
INSERT INTO `demandes_amitie` (`id`, `id_demandeur`, `id_destinataire`, `statut`, `date_creation`) VALUES
	(3, 1, 3, 'refuse', '2024-10-02 12:56:48'),
	(4, 3, 1, 'accepte', '2024-10-02 14:10:23');

-- Listage de la structure de table social_db. likes
DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `contenu_id` int NOT NULL,
  `utilisateur_id` int NOT NULL,
  `date_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `contenu_id` (`contenu_id`,`utilisateur_id`),
  KEY `utilisateur_id` (`utilisateur_id`),
  CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`contenu_id`) REFERENCES `contenus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`utilisateur_id`) REFERENCES `createurs` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table social_db.likes : ~2 rows (environ)
DELETE FROM `likes`;
INSERT INTO `likes` (`id`, `contenu_id`, `utilisateur_id`, `date_creation`) VALUES
	(2, 8, 3, '2024-09-30 12:19:43'),
	(7, 10, 3, '2024-09-30 12:29:48'),
	(8, 9, 1, '2024-10-02 08:11:53'),
	(10, 11, 3, '2024-10-02 15:27:30'),
	(12, 11, 1, '2024-10-02 15:28:10');

-- Listage de la structure de table social_db. messages
DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_expediteur` int NOT NULL,
  `id_destinataire` int NOT NULL,
  `message` text NOT NULL,
  `date_envoi` datetime DEFAULT CURRENT_TIMESTAMP,
  `lu` tinyint DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_expediteur` (`id_expediteur`),
  KEY `id_destinataire` (`id_destinataire`),
  CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`id_expediteur`) REFERENCES `createurs` (`id_user`),
  CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`id_destinataire`) REFERENCES `createurs` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table social_db.messages : ~0 rows (environ)
DELETE FROM `messages`;
INSERT INTO `messages` (`id`, `id_expediteur`, `id_destinataire`, `message`, `date_envoi`, `lu`) VALUES
	(12, 1, 3, 'bjr', '2024-10-02 16:22:06', 0),
	(13, 3, 1, 'bjr', '2024-10-02 16:22:16', 0),
	(14, 1, 3, 'comment ?', '2024-10-02 16:22:29', 0),
	(15, 1, 3, 'je vais bien et toi ?', '2024-10-02 16:45:17', 0),
	(16, 3, 1, 'ca va merci', '2024-10-02 16:45:36', 0);

-- Listage de la structure de table social_db. tags
DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table social_db.tags : ~4 rows (environ)
DELETE FROM `tags`;
INSERT INTO `tags` (`id`, `nom`) VALUES
	(7, 'dev'),
	(5, 'ecole'),
	(4, 'education'),
	(9, 'musique'),
	(6, 'tech');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

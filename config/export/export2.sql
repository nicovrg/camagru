-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le :  jeu. 05 déc. 2019 à 15:56
-- Version du serveur :  5.7.28
-- Version de PHP :  7.2.23

DROP TABLE sessions, users, pictures, likes, comments;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `camagru`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `picture_id` int(10) UNSIGNED NOT NULL,
  `comment_id` int(10) UNSIGNED NOT NULL,
  `comment_content` varchar(255) CHARACTER SET utf8 NOT NULL,
  `comment_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `owner_account_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`picture_id`, `comment_id`, `comment_content`, `comment_time`, `owner_account_id`) VALUES
(2, 1, 'first comment', '2019-12-01 18:15:34', 9),
(2, 2, 'second comment', '2019-12-01 18:15:34', 9),
(2, 3, 'third comment', '2019-12-01 18:15:34', 9),
(2, 4, 'fourth comment', '2019-12-01 18:15:34', 9),
(2, 5, 'fifth comment', '2019-12-01 18:15:34', 9),
(2, 6, 'sixth comment', '2019-12-01 18:15:34', 9),
(2, 7, 'seventh comment', '2019-12-01 18:15:34', 9),
(2, 8, 'coucou', '2019-12-04 15:51:44', 9);

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `picture_id` int(10) UNSIGNED NOT NULL,
  `like_id` int(10) NOT NULL,
  `like_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `owner_account_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`picture_id`, `like_id`, `like_time`, `owner_account_id`) VALUES
(1, 22, '2019-11-28 01:19:21', 9),
(2, 25, '2019-12-04 15:51:52', 9);

-- --------------------------------------------------------

--
-- Structure de la table `pictures`
--

CREATE TABLE `pictures` (
  `picture_id` int(10) UNSIGNED NOT NULL,
  `picture_owner_id` int(10) UNSIGNED NOT NULL,
  `picture_path` varchar(255) CHARACTER SET utf8 NOT NULL,
  `upload_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pictures`
--

INSERT INTO `pictures` (`picture_id`, `picture_owner_id`, `picture_path`, `upload_time`) VALUES
(1, 1, 'img/btc.png', '2019-11-17 18:50:24'),
(2, 2, 'img/eth.png', '2019-11-17 18:51:43'),
(3, 3, 'img/link.png', '2019-11-17 18:51:43'),
(4, 3, 'img/grin.png', '2019-11-17 18:51:43'),
(5, 3, 'img/rlc.png', '2019-11-17 18:51:43'),
(6, 3, 'img/steem.png', '2019-11-17 18:51:43'),
(7, 2, 'img/nico.png', '2019-11-27 14:51:38'),
(8, 2, 'img/satoshi.png', '2019-11-27 14:51:38'),
(9, 2, 'img/atom.png', '2019-11-27 14:51:38'),
(10, 11, 'img/in_the_beninging.png', '2019-12-11 20:57:26'),
(11, 11, 'img/test.png', '2019-12-11 20:58:04'),
(12, 11, 'img/workshop.png', '2019-12-12 00:23:14'),
(13, 11, 'img/hollandaise.png', '2019-12-12 00:33:00'),
(14, 11, 'img/kevin_le_soleil.png', '2019-12-12 17:20:30'),
(15, 11, 'img/timothee.png', '2019-12-12 17:20:30'),
(16, 11, 'img/_.png', '2019-12-12 17:20:30'),
(17, 11, 'img/__.png', '2019-12-12 17:20:30'),
(18, 11, 'img/___.png', '2019-12-12 17:20:30'),
(19, 11, 'img/____.png', '2019-12-12 17:20:30'),
(21, 11, 'img/______.png', '2019-12-12 17:20:30');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` varchar(255) NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sessions`
--


-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `account_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`);

--
-- Index pour la table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`picture_id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`account_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `picture_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `account_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

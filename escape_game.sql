-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 20 mai 2020 à 13:01
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
-- Base de données :  `escape_game`
--

-- --------------------------------------------------------

--
-- Structure de la table `enigma`
--

DROP TABLE IF EXISTS `enigma`;
CREATE TABLE IF NOT EXISTS `enigma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `duration` int(11) NOT NULL,
  `content` text NOT NULL,
  `solution` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `videos` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `enigma`
--

INSERT INTO `enigma` (`id`, `duration`, `content`, `solution`, `image`, `videos`) VALUES
(1, 10, 'Le passage de Lorem Ipsum standard, utilisé depuis 1500\r\n\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', '123', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

DROP TABLE IF EXISTS `game`;
CREATE TABLE IF NOT EXISTS `game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `number_players` int(11) NOT NULL,
  `history` text NOT NULL,
  `level` varchar(255) NOT NULL,
  `link_1` varchar(255) NOT NULL,
  `link_2` varchar(255) NOT NULL,
  `link_3` varchar(255) NOT NULL,
  `link_4` varchar(255) NOT NULL,
  `password` int(11) NOT NULL,
  `solution` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `help` text NOT NULL,
  `id_enigma` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `game`
--

INSERT INTO `game` (`id`, `name`, `duration`, `number_players`, `history`, `level`, `link_1`, `link_2`, `link_3`, `link_4`, `password`, `solution`, `image`, `help`, `id_enigma`, `id_user`) VALUES
(1, 'alien', 30, 4, 'Qu\'est-ce que le Lorem Ipsum?\r\nLe Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.', 'facile', 'aaaaaaa', 'bbbbbbbbbb', 'cccccccc', 'ddddddddd', 1234, 1234, '', 'Pourquoi l\'utiliser?\r\nOn sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. L\'avantage du Lorem Ipsum sur un texte générique comme \'Du texte. Du texte. Du texte.\' est qu\'il possède une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du français standard. De nombreuses suites logicielles de mise en page ou éditeurs de sites Web ont fait du Lorem Ipsum leur faux texte par défaut, et une recherche pour \'Lorem Ipsum\' vous conduira vers de nombreux sites qui n\'en sont encore qu\'à leur phase de construction. Plusieurs versions sont apparues avec le temps, parfois par accident, souvent intentionnellement (histoire d\'y rajouter de petits clins d\'oeil, voire des phrases embarassantes).', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `table_cles`
--

DROP TABLE IF EXISTS `table_cles`;
CREATE TABLE IF NOT EXISTS `table_cles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_enigma` int(11) NOT NULL,
  `id_game` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `e_mail` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `e_mail`, `name`, `username`, `image`, `role`) VALUES
(1, 'zlatan', '1234', 'vfdgdg@hotmail.fr', 'simao', 'francois', '', 'admin'),
(2, 'soso', '1234', 'vfvdv@hotmail.fr', 'perchet', 'solene', '', 'admin'),
(3, 'warpark', '1234', 'fvd@hotmail.fr', 'lafarge', 'arthur', '', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 20 mai 2019 à 14:50
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `moza`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(25) NOT NULL,
  `nom` varchar(25) DEFAULT NULL,
  `prenom` varchar(25) DEFAULT NULL,
  `adresse` varchar(25) DEFAULT NULL,
  `num_telephone` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `client_commande`
--

CREATE TABLE `client_commande` (
  `id_client_commande` int(25) NOT NULL,
  `id_journee` int(25) DEFAULT NULL,
  `id_client` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commande_detail`
--

CREATE TABLE `commande_detail` (
  `id_commande_detail` int(25) NOT NULL,
  `id_journee` int(25) DEFAULT NULL,
  `qte_initiale` int(11) DEFAULT NULL,
  `qte_sortie` int(11) DEFAULT NULL,
  `id_produit_prix_dd` int(25) DEFAULT NULL,
  `qte_vendue_dd` int(11) DEFAULT NULL,
  `id_produit_prix_dg` int(25) DEFAULT NULL,
  `qte_vendue_dg` int(11) DEFAULT NULL,
  `id_produit_prix_sg` int(25) DEFAULT NULL,
  `qte_vendue_sg` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commande_detail`
--

INSERT INTO `commande_detail` (`id_commande_detail`, `id_journee`, `qte_initiale`, `qte_sortie`, `id_produit_prix_dd`, `qte_vendue_dd`, `id_produit_prix_dg`, `qte_vendue_dg`, `id_produit_prix_sg`, `qte_vendue_sg`) VALUES
(41, 3, 60, 10, 1, 22, 2, 0, 3, 0),
(42, 3, 47, 10, 4, 22, 5, 0, 6, 0),
(43, 3, 21, 15, 7, 1, 8, 0, 9, 0),
(44, 3, 0, 0, 10, 0, 11, 0, 12, 0),
(45, 3, 2, 0, 13, 2, 14, 0, 15, 0),
(46, 3, 2, 0, 16, 0, 17, 0, 18, 0),
(47, 3, 2, 0, 19, 0, 20, 0, 21, 0),
(48, 3, 3, 0, 22, 0, 23, 0, 24, 0),
(49, 3, 2, 0, 25, 0, 26, 0, 27, 0),
(50, 3, 3, 0, 28, 0, 29, 0, 30, 0),
(51, 3, 2, 0, 31, 0, 32, 0, 33, 0),
(52, 3, 1, 0, 34, 0, 35, 0, 36, 0),
(53, 3, 5, 5, 37, 3, 38, 0, 39, 0),
(54, 3, 8, 3, 40, 1, 41, 0, 42, 0),
(55, 3, 3, 3, 43, 0, 44, 0, 45, 0),
(56, 3, 5, 3, 46, 0, 47, 0, 48, 0),
(57, 3, 3, 3, 49, 0, 50, 0, 51, 0),
(58, 3, 6, 3, 52, 0, 53, 0, 54, 0),
(59, 3, 3, 3, 55, 0, 56, 0, 57, 0),
(60, 3, 3, 3, 58, 0, 59, 0, 60, 0),
(61, 4, 84, 0, 1, 16, 2, 0, 3, 0),
(62, 4, 84, 0, 4, 11, 5, 0, 6, 0),
(63, 4, 30, 0, 7, 6, 8, 0, 9, 0),
(64, 4, 0, 0, 10, 0, 11, 0, 12, 0),
(65, 4, 2, 0, 13, 0, 14, 0, 15, 0),
(66, 4, 2, 0, 16, 0, 17, 0, 18, 0),
(67, 4, 2, 0, 19, 0, 20, 0, 21, 0),
(68, 4, 2, 0, 22, 0, 23, 0, 24, 0),
(69, 4, 2, 0, 25, 0, 26, 0, 27, 0),
(70, 4, 2, 0, 28, 0, 29, 0, 30, 0),
(71, 4, 2, 0, 31, 0, 32, 0, 33, 0),
(72, 4, 2, 0, 34, 0, 35, 0, 36, 0),
(73, 4, 2, 0, 37, 0, 38, 0, 39, 0),
(74, 4, 2, 0, 40, 1, 41, 0, 42, 0),
(75, 4, 2, 0, 43, 1, 44, 0, 45, 0),
(76, 4, 2, 0, 46, 1, 47, 0, 48, 0),
(77, 4, 2, 0, 49, 1, 50, 0, 51, 0),
(78, 4, 2, 0, 52, 1, 53, 0, 54, 0),
(79, 4, 2, 0, 55, 0, 56, 0, 57, 0),
(80, 4, 2, 0, 58, 1, 59, 0, 60, 0),
(81, 5, 440, 0, 1, 123, 2, 0, 3, 0),
(82, 5, 257, 0, 4, 57, 5, 0, 6, 0),
(83, 5, 165, 0, 7, 10, 8, 0, 9, 0),
(84, 5, 0, 0, 10, 0, 11, 0, 12, 0),
(85, 5, 4, 0, 13, 1, 14, 0, 15, 0),
(86, 5, 2, 0, 16, 0, 17, 0, 18, 0),
(87, 5, 3, 0, 19, 0, 20, 0, 21, 0),
(88, 5, 3, 0, 22, 0, 23, 0, 24, 0),
(89, 5, 10, 0, 25, 2, 26, 0, 27, 0),
(90, 5, 8, 0, 28, 2, 29, 0, 30, 0),
(91, 5, 13, 0, 31, 0, 32, 0, 33, 0),
(92, 5, 9, 0, 34, 0, 35, 0, 36, 0),
(93, 5, 10, 0, 37, 2, 38, 0, 39, 0),
(94, 5, 1, 0, 40, 0, 41, 0, 42, 0),
(95, 5, 15, 0, 43, 5, 44, 0, 45, 0),
(96, 5, 13, 0, 46, 0, 47, 0, 48, 0),
(97, 5, 20, 0, 49, 4, 50, 0, 51, 0),
(98, 5, 33, 0, 52, 0, 53, 0, 54, 0),
(99, 5, 43, 0, 55, 0, 56, 0, 57, 0),
(100, 5, 27, 0, 58, 0, 59, 0, 60, 0),
(101, 6, 72, 0, 1, 28, 2, 0, 3, 0),
(102, 6, 158, 0, 4, 33, 5, 0, 6, 0),
(103, 6, 19, 0, 7, 9, 8, 0, 9, 0),
(104, 6, 0, 0, 10, 0, 11, 0, 12, 0),
(105, 6, 15, 0, 13, 2, 14, 0, 15, 0),
(106, 6, 3, 0, 16, 1, 17, 0, 18, 0),
(107, 6, 3, 0, 19, 1, 20, 0, 21, 0),
(108, 6, 1, 0, 22, 1, 23, 0, 24, 0),
(109, 6, 6, 0, 25, 0, 26, 0, 27, 0),
(110, 6, 4, 0, 28, 0, 29, 0, 30, 0),
(111, 6, 3, 0, 31, 0, 32, 0, 33, 0),
(112, 6, 31, 0, 34, 2, 35, 0, 36, 0),
(113, 6, 21, 0, 37, 1, 38, 0, 39, 0),
(114, 6, 3, 0, 40, 3, 41, 0, 42, 0),
(115, 6, 2, 0, 43, 1, 44, 0, 45, 0),
(116, 6, 1, 0, 46, 1, 47, 0, 48, 0),
(117, 6, 4, 0, 49, 1, 50, 0, 51, 0),
(118, 6, 3, 0, 52, 1, 53, 0, 54, 0),
(119, 6, 4, 0, 55, 1, 56, 0, 57, 0),
(120, 6, 3, 0, 58, 3, 59, 0, 60, 0),
(121, 7, 247, 56, 1, 17, 2, 0, 3, 0),
(122, 7, 101, 30, 4, 19, 5, 0, 6, 0),
(123, 7, 40, 20, 7, 3, 8, 0, 9, 0),
(124, 7, 0, 0, 10, 0, 11, 0, 12, 0),
(125, 7, 7, 0, 13, 1, 14, 0, 15, 0),
(126, 7, 10, 0, 16, 0, 17, 0, 18, 0),
(127, 7, 10, 0, 19, 0, 20, 0, 21, 0),
(128, 7, 10, 0, 22, 1, 23, 0, 24, 0),
(129, 7, 9, 0, 25, 1, 26, 0, 27, 0),
(130, 7, 10, 0, 28, 1, 29, 0, 30, 0),
(131, 7, 11, 0, 31, 1, 32, 0, 33, 0),
(132, 7, 10, 0, 34, 0, 35, 0, 36, 0),
(133, 7, 0, 0, 37, 0, 38, 0, 39, 0),
(134, 7, 2, 0, 40, 0, 41, 0, 42, 0),
(135, 7, 2, 0, 43, 0, 44, 0, 45, 0),
(136, 7, 2, 0, 46, 0, 47, 0, 48, 0),
(137, 7, 1, 0, 49, 0, 50, 0, 51, 0),
(138, 7, 0, 0, 52, 0, 53, 0, 54, 0),
(139, 7, 2, 0, 55, 0, 56, 0, 57, 0),
(140, 7, 1, 0, 58, 0, 59, 0, 60, 0);

-- --------------------------------------------------------

--
-- Structure de la table `journee`
--

CREATE TABLE `journee` (
  `id_journee` int(25) NOT NULL,
  `id_vendeur` int(25) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `recette` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `journee`
--

INSERT INTO `journee` (`id_journee`, `id_vendeur`, `date`, `recette`) VALUES
(3, 7, '2019-05-16', 8275),
(4, 5, '2019-05-16', 6300),
(5, 6, '2019-05-19', 0),
(6, 8, '2019-05-19', 18965),
(7, 10, '2019-05-19', 900);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(25) NOT NULL,
  `id_produit_marge` int(25) DEFAULT NULL,
  `nom` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `id_produit_marge`, `nom`) VALUES
(1, 1, 'EAU 1.5'),
(2, 1, 'EAU 0,5'),
(3, 2, 'VICHY NATURE 1,25'),
(4, 2, 'Vichy Aromatisee 1.25'),
(5, 3, 'BGA VICHY NATURE 0.25'),
(6, 3, 'BGA MONTHE 0.25'),
(7, 3, 'BAG CITRON 0.25'),
(8, 3, 'BGA GRENADINE 0.25'),
(9, 3, 'BGA CIT MONTHE 0.25'),
(10, 3, 'BAG ORANGE 0.25'),
(11, 3, 'BAG ZESTE 0.25'),
(12, 3, 'BAG BITTER 0.25'),
(13, 3, 'FARD NATURE 0.25'),
(14, 3, 'FARD MONTHE 0.25'),
(15, 3, 'FARD CITRON 0.25'),
(16, 3, 'FARD GRENADINE 0.25'),
(17, 3, 'FARD CIT MONTHE 0.25'),
(18, 3, 'FARD ORANGE 0.25'),
(19, 3, 'FARD ZESTE 0.25'),
(20, 3, 'FARD BITTER 0.25');

-- --------------------------------------------------------

--
-- Structure de la table `produit_marge`
--

CREATE TABLE `produit_marge` (
  `id_produit_marge` int(25) NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `benefice` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit_marge`
--

INSERT INTO `produit_marge` (`id_produit_marge`, `nom`, `benefice`) VALUES
(1, 'Eau', 1),
(2, 'Vichy 1.25', 5),
(3, 'BGA / FARD', 10);

-- --------------------------------------------------------

--
-- Structure de la table `produit_prix`
--

CREATE TABLE `produit_prix` (
  `id_produit_prix` int(25) NOT NULL,
  `id_produit` int(25) DEFAULT NULL,
  `id_produit_prix_type` int(25) DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit_prix`
--

INSERT INTO `produit_prix` (`id_produit_prix`, `id_produit`, `id_produit_prix_type`, `prix`, `date`) VALUES
(1, 1, 1, 130, '2019-05-15'),
(2, 1, 2, 124, '2019-05-15'),
(3, 1, 3, 119, '2019-05-15'),
(4, 2, 1, 150, '2019-05-15'),
(5, 2, 2, 145, '2019-05-15'),
(6, 2, 3, 140, '2019-05-15'),
(7, 3, 1, 160, '2019-05-15'),
(8, 3, 2, 155, '2019-05-15'),
(9, 3, 3, 150, '2019-05-15'),
(10, 4, 1, 320, '2019-05-15'),
(11, 4, 2, 310, '2019-05-15'),
(12, 4, 3, 300, '2019-05-15'),
(13, 5, 1, 370, '2019-05-15'),
(14, 5, 2, 350, '2019-05-15'),
(15, 5, 3, 328, '2019-05-15'),
(16, 6, 1, 630, '2019-05-15'),
(17, 6, 2, 610, '2019-05-15'),
(18, 6, 3, 590, '2019-05-15'),
(19, 7, 1, 630, '2019-05-15'),
(20, 7, 2, 610, '2019-05-15'),
(21, 7, 3, 590, '2019-05-15'),
(22, 8, 1, 630, '2019-05-15'),
(23, 8, 2, 610, '2019-05-15'),
(24, 8, 3, 590, '2019-05-15'),
(25, 9, 1, 630, '2019-05-15'),
(26, 9, 2, 610, '2019-05-15'),
(27, 9, 3, 590, '2019-05-15'),
(28, 10, 1, 630, '2019-05-15'),
(29, 10, 2, 610, '2019-05-15'),
(30, 10, 3, 590, '2019-05-15'),
(31, 11, 1, 630, '2019-05-15'),
(32, 11, 2, 610, '2019-05-15'),
(33, 11, 3, 590, '2019-05-15'),
(34, 12, 1, 630, '2019-05-15'),
(35, 12, 2, 610, '2019-05-15'),
(36, 12, 3, 590, '2019-05-15'),
(37, 13, 1, 260, '2019-05-15'),
(38, 13, 2, 230, '2019-05-15'),
(39, 13, 3, 205, '2019-05-15'),
(40, 14, 1, 435, '2019-05-15'),
(41, 14, 2, 410, '2019-05-15'),
(42, 14, 3, 395, '2019-05-15'),
(43, 15, 1, 435, '2019-05-15'),
(44, 15, 2, 410, '2019-05-15'),
(45, 15, 3, 395, '2019-05-15'),
(46, 16, 1, 435, '2019-05-15'),
(47, 16, 2, 410, '2019-05-15'),
(48, 16, 3, 395, '2019-05-15'),
(49, 17, 1, 435, '2019-05-15'),
(50, 17, 2, 410, '2019-05-15'),
(51, 17, 3, 395, '2019-05-15'),
(52, 18, 1, 435, '2019-05-15'),
(53, 18, 2, 410, '2019-05-15'),
(54, 18, 3, 395, '2019-05-15'),
(55, 19, 1, 435, '2019-05-15'),
(56, 19, 2, 410, '2019-05-15'),
(57, 19, 3, 395, '2019-05-15'),
(58, 20, 1, 435, '2019-05-15'),
(59, 20, 2, 410, '2019-05-15'),
(60, 20, 3, 395, '2019-05-15');

-- --------------------------------------------------------

--
-- Structure de la table `produit_prix_type`
--

CREATE TABLE `produit_prix_type` (
  `id_produit_prix_type` int(25) NOT NULL,
  `nom` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit_prix_type`
--

INSERT INTO `produit_prix_type` (`id_produit_prix_type`, `nom`) VALUES
(1, 'D.D'),
(2, 'Demi - Gros'),
(3, 'Super-gros');

-- --------------------------------------------------------

--
-- Structure de la table `stock_vehicule`
--

CREATE TABLE `stock_vehicule` (
  `id_vehicule` int(25) NOT NULL,
  `id_produit` int(25) NOT NULL,
  `quantite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stock_vehicule`
--

INSERT INTO `stock_vehicule` (`id_vehicule`, `id_produit`, `quantite`) VALUES
(1, 1, 68),
(1, 2, 73),
(1, 3, 24),
(1, 4, 0),
(1, 5, 2),
(1, 6, 2),
(1, 7, 2),
(1, 8, 2),
(1, 9, 2),
(1, 10, 2),
(1, 11, 2),
(1, 12, 2),
(1, 13, 2),
(1, 14, 1),
(1, 15, 1),
(1, 16, 1),
(1, 17, 1),
(1, 18, 1),
(1, 19, 2),
(1, 20, 1),
(2, 1, 317),
(2, 2, 200),
(2, 3, 155),
(2, 4, 0),
(2, 5, 3),
(2, 6, 2),
(2, 7, 3),
(2, 8, 3),
(2, 9, 8),
(2, 10, 6),
(2, 11, 13),
(2, 12, 9),
(2, 13, 8),
(2, 14, 1),
(2, 15, 10),
(2, 16, 13),
(2, 17, 16),
(2, 18, 33),
(2, 19, 43),
(2, 20, 27),
(3, 1, 48),
(3, 2, 35),
(3, 3, 35),
(3, 4, 0),
(3, 5, 0),
(3, 6, 2),
(3, 7, 2),
(3, 8, 3),
(3, 9, 2),
(3, 10, 3),
(3, 11, 2),
(3, 12, 1),
(3, 13, 7),
(3, 14, 10),
(3, 15, 6),
(3, 16, 8),
(3, 17, 6),
(3, 18, 9),
(3, 19, 6),
(3, 20, 6),
(4, 1, 44),
(4, 2, 125),
(4, 3, 10),
(4, 4, 0),
(4, 5, 13),
(4, 6, 2),
(4, 7, 2),
(4, 8, 0),
(4, 9, 6),
(4, 10, 4),
(4, 11, 3),
(4, 12, 29),
(4, 13, 20),
(4, 14, 0),
(4, 15, 1),
(4, 16, 0),
(4, 17, 3),
(4, 18, 2),
(4, 19, 3),
(4, 20, 0),
(5, 1, 286),
(5, 2, 112),
(5, 3, 57),
(5, 4, 0),
(5, 5, 6),
(5, 6, 10),
(5, 7, 10),
(5, 8, 9),
(5, 9, 8),
(5, 10, 9),
(5, 11, 10),
(5, 12, 10),
(5, 13, 0),
(5, 14, 2),
(5, 15, 2),
(5, 16, 2),
(5, 17, 1),
(5, 18, 0),
(5, 19, 2),
(5, 20, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(25) NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `profession` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(35) DEFAULT NULL,
  `droit_acces` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `nom`, `prenom`, `profession`, `email`, `username`, `password`, `droit_acces`) VALUES
(1, 'Foura', 'Oussama', 'Directeur commercial', 'D.Commercialmoza@hotmail.com ', 'oussamafoura', '6379253a1da3109f9c7a740f10fad39f', 1);

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `id_vehicule` int(25) NOT NULL,
  `nom` varchar(35) DEFAULT NULL,
  `matricule` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`id_vehicule`, `nom`, `matricule`) VALUES
(1, 'Master 1', '0001'),
(2, 'Master 2', '0002'),
(3, 'Master 3', '0003'),
(4, 'Master 4', '0004'),
(5, 'R.P', '0005');

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

CREATE TABLE `vendeur` (
  `id_vendeur` int(25) NOT NULL,
  `id_vehicule` int(25) DEFAULT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `telephone` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vendeur`
--

INSERT INTO `vendeur` (`id_vendeur`, `id_vehicule`, `nom`, `prenom`, `telephone`) VALUES
(5, 1, 'Mebarki ', 'Hamza ', ' 0771.70.68.94'),
(6, 2, 'Abed', 'Billel ', '06.72.99.37.54'),
(7, 3, 'Ouahrani', ' Billel ', ' 07.78.09.99.11'),
(8, 4, 'Mazouzi', 'Hassen ', '0556.91.55.79'),
(10, 5, 'Elhadef ', 'Abdelkader ', '06.66.61.59.90');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `client_commande`
--
ALTER TABLE `client_commande`
  ADD PRIMARY KEY (`id_client_commande`),
  ADD KEY `FK_Reference_16` (`id_journee`),
  ADD KEY `FK_Reference_17` (`id_client`);

--
-- Index pour la table `commande_detail`
--
ALTER TABLE `commande_detail`
  ADD PRIMARY KEY (`id_commande_detail`),
  ADD KEY `FK_Reference_13` (`id_produit_prix_dd`),
  ADD KEY `FK_Reference_14` (`id_produit_prix_dg`),
  ADD KEY `FK_Reference_15` (`id_journee`),
  ADD KEY `FK_Reference_18` (`id_produit_prix_sg`);

--
-- Index pour la table `journee`
--
ALTER TABLE `journee`
  ADD PRIMARY KEY (`id_journee`),
  ADD KEY `FK_Reference_11` (`id_vendeur`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `FK_Reference_19` (`id_produit_marge`);

--
-- Index pour la table `produit_marge`
--
ALTER TABLE `produit_marge`
  ADD PRIMARY KEY (`id_produit_marge`);

--
-- Index pour la table `produit_prix`
--
ALTER TABLE `produit_prix`
  ADD PRIMARY KEY (`id_produit_prix`),
  ADD KEY `FK_Reference_1` (`id_produit`),
  ADD KEY `FK_Reference_10` (`id_produit_prix_type`);

--
-- Index pour la table `produit_prix_type`
--
ALTER TABLE `produit_prix_type`
  ADD PRIMARY KEY (`id_produit_prix_type`);

--
-- Index pour la table `stock_vehicule`
--
ALTER TABLE `stock_vehicule`
  ADD PRIMARY KEY (`id_vehicule`,`id_produit`),
  ADD KEY `FK_Reference_7` (`id_produit`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`id_vehicule`);

--
-- Index pour la table `vendeur`
--
ALTER TABLE `vendeur`
  ADD PRIMARY KEY (`id_vendeur`),
  ADD KEY `FK_Reference_8` (`id_vehicule`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `client_commande`
--
ALTER TABLE `client_commande`
  MODIFY `id_client_commande` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commande_detail`
--
ALTER TABLE `commande_detail`
  MODIFY `id_commande_detail` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT pour la table `journee`
--
ALTER TABLE `journee`
  MODIFY `id_journee` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `produit_marge`
--
ALTER TABLE `produit_marge`
  MODIFY `id_produit_marge` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `produit_prix`
--
ALTER TABLE `produit_prix`
  MODIFY `id_produit_prix` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT pour la table `produit_prix_type`
--
ALTER TABLE `produit_prix_type`
  MODIFY `id_produit_prix_type` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `id_vehicule` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `vendeur`
--
ALTER TABLE `vendeur`
  MODIFY `id_vendeur` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `client_commande`
--
ALTER TABLE `client_commande`
  ADD CONSTRAINT `FK_Reference_16` FOREIGN KEY (`id_journee`) REFERENCES `journee` (`id_journee`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Reference_17` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commande_detail`
--
ALTER TABLE `commande_detail`
  ADD CONSTRAINT `FK_Reference_13` FOREIGN KEY (`id_produit_prix_dd`) REFERENCES `produit_prix` (`id_produit_prix`),
  ADD CONSTRAINT `FK_Reference_14` FOREIGN KEY (`id_produit_prix_dg`) REFERENCES `produit_prix` (`id_produit_prix`),
  ADD CONSTRAINT `FK_Reference_15` FOREIGN KEY (`id_journee`) REFERENCES `journee` (`id_journee`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Reference_18` FOREIGN KEY (`id_produit_prix_sg`) REFERENCES `produit_prix` (`id_produit_prix`);

--
-- Contraintes pour la table `journee`
--
ALTER TABLE `journee`
  ADD CONSTRAINT `FK_Reference_11` FOREIGN KEY (`id_vendeur`) REFERENCES `vendeur` (`id_vendeur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_Reference_19` FOREIGN KEY (`id_produit_marge`) REFERENCES `produit_marge` (`id_produit_marge`);

--
-- Contraintes pour la table `produit_prix`
--
ALTER TABLE `produit_prix`
  ADD CONSTRAINT `FK_Reference_1` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Reference_10` FOREIGN KEY (`id_produit_prix_type`) REFERENCES `produit_prix_type` (`id_produit_prix_type`);

--
-- Contraintes pour la table `stock_vehicule`
--
ALTER TABLE `stock_vehicule`
  ADD CONSTRAINT `FK_Reference_6` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicule` (`id_vehicule`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Reference_7` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `vendeur`
--
ALTER TABLE `vendeur`
  ADD CONSTRAINT `FK_Reference_8` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicule` (`id_vehicule`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

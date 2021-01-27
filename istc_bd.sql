-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 09 Décembre 2019 à 09:19
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `istc_bd`
--
CREATE DATABASE IF NOT EXISTS `istc_bd` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `istc_bd`;

-- --------------------------------------------------------

--
-- Structure de la table `affecter`
--

CREATE TABLE IF NOT EXISTS `affecter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_affectation` datetime DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `id_mat` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`,`id_mat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Contenu de la table `affecter`
--

INSERT INTO `affecter` (`id`, `date_affectation`, `id_user`, `id_mat`) VALUES
(3, NULL, 20, 15),
(4, NULL, 20, 0),
(5, NULL, 20, 0),
(7, NULL, 21, 6),
(8, '2019-07-06 09:47:01', 22, 6),
(19, NULL, 19, 6),
(21, NULL, 19, 8),
(22, NULL, 19, 0),
(23, '2019-07-06 12:27:01', 19, 10),
(24, NULL, 19, 0),
(27, '2019-07-13 10:14:10', 23, 12),
(29, '2019-07-13 10:18:05', 23, 16),
(30, '2019-07-21 13:57:50', 27, 14),
(32, '2019-07-21 13:58:30', 27, 17),
(33, '2019-07-28 12:55:29', 0, 3),
(34, '2019-07-28 12:55:39', 0, 3),
(35, '2019-07-28 12:55:49', 0, 3),
(37, '2019-07-30 12:30:05', 28, 18),
(38, '2019-07-30 12:30:27', 28, 7),
(39, '2019-07-31 13:58:38', 0, 3),
(40, '2019-07-31 14:13:35', 0, 10),
(41, '2019-07-31 21:11:43', 26, 19),
(42, '2019-08-01 12:00:09', 30, 15),
(43, '2019-08-01 12:01:22', 31, 11),
(46, '2019-08-01 12:04:55', 32, 9),
(47, '2019-08-02 16:06:05', 33, 13),
(48, '2019-08-09 10:00:10', 32, 10),
(49, '2019-08-09 10:00:24', 32, 12),
(50, '2019-08-09 10:00:48', 32, 15),
(51, '2019-09-17 17:54:15', 34, 7);

-- --------------------------------------------------------

--
-- Structure de la table `bureau`
--

CREATE TABLE IF NOT EXISTS `bureau` (
  `id_bureau` int(11) NOT NULL AUTO_INCREMENT,
  `nom_bureau` varchar(255) NOT NULL,
  `Localisation` varchar(255) NOT NULL,
  PRIMARY KEY (`id_bureau`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Contenu de la table `bureau`
--

INSERT INTO `bureau` (`id_bureau`, `nom_bureau`, `Localisation`) VALUES
(5, 'SALLE LUMIERE', 'BAT. DANIELLE BONI CLAVERIE'),
(6, 'S.D DES APPUIS TECHNOLOGIQUES', 'BAT. DANIELLE BONI CLAVERIE'),
(7, 'CHEF SCE MULTI/PROD,COORDONNATEUR DU POOL', 'BAT. DANIELLE BONI CLAVERIE'),
(8, 'WEBMASTER ET CHEF SCE INFORMATIQUE', 'BAT. DANIELLE BONI CLAVERIE'),
(9, 'CHEF SCE COM/JURIDIQUE/COOPERATION', 'BAT. DANIELLE BONI CLAVERIE'),
(10, 'DIRECTEUR STAGE ET R.H', 'BAT. LAURENT DONA FOLOGO (RDC)'),
(11, 'SECRETARIAT DDE/STAGES ET RE', 'BAT. LAURENT DONA FOLOGO (RDC)'),
(12, 'DIRECTEUR DES ECOLES', 'BAT. LAURENT DONA FOLOGO (RDC)'),
(13, 'SCE CONCOURS ET EXAMENS 1', 'BAT. LAURENT DONA FOLOGO (RDC)'),
(14, 'SCE SCOLARITE ET STATISTIQUES', 'BAT. LAURENT DONA FOLOGO(RDC)'),
(15, 'CHEF SCE PROG ET ENSEIGN', 'BAT. LAURENT DONA FOLOGO(RDC)'),
(16, 'SCE PROG ET ENSEIGN', 'BAT. LAURENT DONA FOLOGO(RDC)'),
(17, 'SCE CONCOURS ET EXAMENS', 'BAT. LAURENT DONA FOLOGO(RDC)'),
(18, 'SCE ORIENTATION/CONCOURS ET CS', 'BAT. LAURENT DONA FOLOGO(RDC)'),
(19, 'CHEF SCE C.E/SCE PROG ET ENSEIGN', 'BAT. LAURENT DONA FOLOGO(RDC)'),
(20, 'S.D FINANCES', 'BAT. LAURENT DONA FOLOGO (étage)'),
(21, 'AGENT COMPTABLE', 'BAT. LAURENT DONA FOLOGO (étage)'),
(22, ' BUREAU AGENCE COMPTABLE', 'BAT. LAURENT DONA FOLOGO (étage)'),
(23, 'SCE ENG ET BUDGET', 'BAT. LAURENT DONA FOLOGO (étage)'),
(24, 'D.M.G.A.T', 'BAT. LAURENT DONA FOLOGO (étage)'),
(25, 'CONTROLEUR BUDGETAIRE', 'BAT. LAURENT DONA FOLOGO (étage)'),
(26, 'SECRETARIAT C.BUDGETAIRE', 'BAT. LAURENT DONA FOLOGO (étage)'),
(27, 'SECRETARIAT D.F ET R.H/S.D MGAT', 'BAT. LAURENT DONA FOLOGO (étage)'),
(28, 'DIRECTEUR DES FINANCES ET R.H', 'BAT. LAURENT DONA FOLOGO (étage)'),
(29, 'DIRECTION GÉNÉRALE', 'BAT. LAURENT DONA FOLOGO (étage)'),
(30, 'SECRETARIAT D.G', 'BAT. LAURENT DONA FOLOGO (étage)'),
(31, 'CHEF SCE PATRIMOINE', 'BAT. MARTIN STUDDER'),
(32, 'COORD POOL SECRETAIRES DE DIRECTION/AGENTS DU COURIER', 'BAT. MARTIN STUDDER'),
(33, 'S.D RELATIONS EXTERIEURES', 'BAT. MARTIN STUDDER'),
(34, 'S.D RESSOURCES HUMAINES', 'BAT. MARTIN STUDDER'),
(35, 'S.D DES STAGES', 'BAT. MARTIN STUDDER'),
(36, 'SCE PERSONNEL', 'BAT. MARTIN STUDDER'),
(37, 'SCE GESTION ADMINISTRATIVE', 'BAT. MARTIN STUDDER'),
(38, 'DIRECTEUR ECOLE P.A', 'BAT. MARTIN STUDDER'),
(39, 'DIRECTEUR ECOLE AIN', 'BAT. MARTIN STUDDER'),
(40, 'CHEF SCE INSERTION PROFESSIONNEL', 'BAT. MARTIN STUDDER'),
(41, 'CHEF SCE PRATIQUE PROFESSIONNEL', 'BAT. MARTIN STUDDER'),
(42, 'SCE ECONOMIQUE', 'BAT. MARTIN STUDDER'),
(43, 'SCE SOUTENANCE ET FORMATION A LA CARTE', 'BAT. MARTIN STUDDER'),
(44, 'SCE EXPL ET MAINTENANCE', 'BAT. AUGUSTE SÉVERIN MIREMONT(RDC)'),
(45, 'SALLE MONTAGE RADIO NUMÉRIQUE', 'BAT. AUGUSTE SÉVERIN MIREMONT(RDC)'),
(46, 'S.D DES MOYENS GENERAUX', 'BAT. AUGUSTE SÉVERIN MIREMONT(étage)'),
(47, 'CENTRE DE RECHERCHES LEVY NIAMKEY', 'BAT. AFFOUSSATA BAMBA LAMINE(RDC)'),
(48, 'DIRECTEUR ECOLE P.M', 'BAT. AFFOUSSATA BAMBA LAMINE(étage)'),
(49, 'DIRECTEUR ECOLE T.T.A', 'BAT. AFFOUSSATE BAMBA LAMINE(étage)'),
(50, 'SCE PARC AUTOMOBILE', 'BAT. IBRAHIM SY SAVANE'),
(51, 'SCE ENVIRONNEMMMENT', 'BAT. IBRAHIM SY SAVANE');

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

CREATE TABLE IF NOT EXISTS `employe` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `identifiant` varchar(30) NOT NULL,
  `nom_employe` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `mot_de_passe` text NOT NULL,
  `id_grade` int(11) NOT NULL,
  `id_fonc` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_grade` (`id_grade`),
  KEY `id_fonc` (`id_fonc`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Contenu de la table `employe`
--

INSERT INTO `employe` (`id_user`, `identifiant`, `nom_employe`, `prenom`, `role`, `mot_de_passe`, `id_grade`, `id_fonc`, `email`) VALUES
(21, '4465IS', 'SORO', 'TEPI ALASSANE', 'admin', 'ec168e3c4e0c78edaf8a326f4947e4a9', 10, 7, 'tepialassane@gmail.com'),
(23, '3311IS', 'TRAORE', 'MOHAMED', 'user', 'f462a1fd2fa7cee857e61f6bbdddaa0c', 7, 8, 'momo2london85@gmail.com'),
(26, '0246IS', 'Kouyate', 'karim', 'admin', '37f5108ee2c96a717b545c2322e30de9', 9, 7, 'kouyatekarim02@gmail.com'),
(27, '0232IS', 'DIOP', 'ASSANE', 'user', '111e2ecc3f7aaa5622bd90f86e73d3ed', 8, 7, 'diop@gmail.com'),
(28, '0710IS', 'DIBI', 'VALERIE', 'user', '8ce4f91db28721646c4e6eb04287091c', 9, 8, 'dibivalerie@yahoo.fr'),
(29, '4673IS', 'N''DJOMON', 'JOEL', 'user', '1bd8a87c63c5e6feac0cb6728379d55b', 8, 8, 'joel@gmail.com'),
(30, '9166IS', 'KONAN', 'KOFFI WILLIAM', 'user', 'da2f12d2299f3a7e06708c83522cba08', 9, 11, 'kwh@yahoo.fr'),
(31, '4070IS', 'GBA', 'NOUNE ELISEE', 'user', '71a1b25bca30f6b58bf01fbfbb4a0ef0', 9, 12, 'gbanoune@yahoo.fr'),
(32, '3233IS', 'COULIBALY', 'ZIE', 'user', '639cd3334f1a86a9663aca7f18c9df4b', 9, 8, 'zie@gmail.com'),
(33, '01272099', 'YEO', 'MILEGAME', 'user', '716cfad98af817f7c283572d158e9077', 11, 11, 'yeoserigo@gmail.com'),
(34, '0284IS', 'TRAORE', 'SAFI', 'user', '6911a9d7659129a8533026786d0a279e', 8, 8, 'safi@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE IF NOT EXISTS `etat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `etat`
--

INSERT INTO `etat` (`id`, `libelle`) VALUES
(3, 'Réglé'),
(4, 'En cours');

-- --------------------------------------------------------

--
-- Structure de la table `fonction`
--

CREATE TABLE IF NOT EXISTS `fonction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_fonction` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `fonction`
--

INSERT INTO `fonction` (`id`, `nom_fonction`) VALUES
(7, 'STAGIAIRE'),
(8, 'MAINTENANCIER'),
(9, 'PHOTOGRAPHE'),
(10, 'ASSISTANTE PRODUCTION'),
(11, 'CHARGER DE PRODUCTION'),
(12, 'WEBMASTER');

-- --------------------------------------------------------

--
-- Structure de la table `grade`
--

CREATE TABLE IF NOT EXISTS `grade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_grade` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `grade`
--

INSERT INTO `grade` (`id`, `nom_grade`) VALUES
(7, 'A1'),
(8, 'A2'),
(9, 'A3'),
(10, 'A4'),
(11, 'A5'),
(12, 'A6'),
(13, 'A7'),
(14, 'B1'),
(15, 'B2'),
(16, 'B3'),
(17, 'C1'),
(18, 'C2'),
(19, 'C3'),
(20, 'D1'),
(21, 'D2');

-- --------------------------------------------------------

--
-- Structure de la table `incident`
--

CREATE TABLE IF NOT EXISTS `incident` (
  `id_incident` int(11) NOT NULL AUTO_INCREMENT,
  `description_incident` varchar(255) NOT NULL,
  `date_enregistrement` datetime NOT NULL,
  PRIMARY KEY (`id_incident`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Contenu de la table `incident`
--

INSERT INTO `incident` (`id_incident`, `description_incident`, `date_enregistrement`) VALUES
(26, 'L''écran est brisé', '2019-07-30 16:25:22'),
(27, 'Le wifi ne passe pas sur l''ordi\r\n', '2019-07-30 16:26:29'),
(28, 'Le wifi ne passe pas sur l''ordi\r\n', '2019-07-30 16:26:30'),
(29, 'materiel defectueux\r\n', '2019-08-02 16:08:10'),
(30, 'materiel defectueux\r\n', '2019-08-02 16:08:11'),
(31, 'Feuille terminer', '2019-08-03 10:51:59'),
(32, 'Feuille terminer', '2019-08-03 10:51:59'),
(33, 'sqrqer', '2019-08-03 10:53:06'),
(34, 'sqrqer', '2019-08-03 10:53:06'),
(35, 'Câble coupé', '2019-08-09 10:01:21'),
(36, 'Câble coupé', '2019-08-09 10:01:21'),
(37, 'Feuille terminé', '2019-08-09 10:01:40'),
(38, 'Feuille terminé', '2019-08-09 10:01:41'),
(39, 'sdfs;jkdfc', '2019-09-17 17:54:57'),
(40, 'sdfs;jkdfc', '2019-09-17 17:54:57'),
(41, 'bvvb', '2019-10-22 16:08:58'),
(42, 'bvvb', '2019-10-22 16:08:58');

-- --------------------------------------------------------

--
-- Structure de la table `intervention`
--

CREATE TABLE IF NOT EXISTS `intervention` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_reception` datetime NOT NULL,
  `date_retour` datetime NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_etat` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_etat` (`id_etat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Contenu de la table `intervention`
--

INSERT INTO `intervention` (`id`, `date_reception`, `date_retour`, `id_user`, `id_etat`) VALUES
(10, '2019-07-30 16:25:21', '2019-07-30 16:26:49', 28, 4),
(11, '2019-08-02 16:08:10', '2019-08-02 16:10:34', 33, 4),
(12, '2019-08-03 10:51:59', '2019-08-03 10:52:43', 23, 4),
(13, '2019-08-03 10:53:06', '2019-08-03 10:53:21', 23, 3),
(14, '2019-08-09 10:01:21', '2019-08-09 10:02:35', 32, 4),
(15, '2019-07-30 16:26:29', '2019-09-13 14:51:05', 28, 3),
(16, '2019-07-30 16:25:21', '2019-09-13 15:23:27', 28, 3),
(17, '2019-07-30 16:25:21', '2019-09-13 15:23:28', 28, 3),
(18, '2019-07-30 16:26:29', '2019-09-13 15:23:28', 28, 4),
(19, '2019-07-30 16:25:21', '2019-09-13 15:23:28', 28, 3),
(20, '2019-07-30 16:25:21', '2019-09-13 15:32:15', 28, 3),
(21, '2019-07-30 16:26:29', '2019-09-13 15:45:11', 28, 4),
(22, '2019-07-30 16:26:29', '2019-09-13 15:55:19', 28, 4);

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

CREATE TABLE IF NOT EXISTS `materiel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `n_serie` varchar(255) NOT NULL,
  `date_mise_service` datetime NOT NULL,
  `type_mat` varchar(255) NOT NULL,
  `id_inter` int(11) DEFAULT NULL,
  `id_service` int(11) NOT NULL,
  `id_incident` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_inter` (`id_inter`),
  KEY `id_service` (`id_service`),
  KEY `id_incident` (`id_incident`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `materiel`
--

INSERT INTO `materiel` (`id`, `n_serie`, `date_mise_service`, `type_mat`, `id_inter`, `id_service`, `id_incident`) VALUES
(6, 'XXXX0232', '2019-05-02 08:33:00', 'ORDINATEUR PORTABLE', 0, 0, 39),
(7, 'XXXX3311', '2017-05-29 10:18:22', 'ORDINATEUR BUREAU', 22, 0, 27),
(8, 'XXXX3332', '2017-05-28 10:31:34', 'ORDINATEUR BUREAU', 0, 0, 0),
(9, 'XXXX0211', '2017-05-29 06:18:22', 'ORDINATEUR BUREAU', 14, 0, 35),
(10, 'XXXX3346', '2017-05-16 00:00:00', 'ONDULEUR(Tech-com)', 0, 0, 0),
(11, 'XXXX2614', '2019-06-04 00:00:00', 'ORDINATEUR BUREAU', 0, 0, 0),
(12, 'XXXX4587', '2017-05-28 10:31:34', 'HP SCARJET G-3110', 0, 0, 37),
(13, 'XXXX2314', '2017-05-12 13:21:00', 'ORDINATEUR BUREAU', 11, 0, 29),
(14, 'XXXX3698', '2017-05-28 10:31:34', 'ONDULEUR', 0, 0, 41),
(15, 'XXXX7532', '2018-04-11 00:00:00', 'ORDINATEUR BUREAU MAC', 0, 0, 15),
(16, 'XXXX2514', '2017-05-29 06:18:22', 'HP LASER PRO P 2015(PRINTER)', 12, 0, 31),
(17, 'XXXX7896', '2018-05-04 00:00:00', 'LASER JET PRO 402 DN(Printer)', 0, 0, 0),
(18, 'XXXX7564', '2017-05-12 13:21:00', 'ONDULEUR(Mercury)', 0, 0, 0),
(19, 'XXXX7894', '2017-05-28 10:31:34', 'ORDINATEUR BUREAU', 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sujet` varchar(255) NOT NULL,
  `statut` int(1) NOT NULL DEFAULT '0',
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `notifications`
--

INSERT INTO `notifications` (`id`, `sujet`, `statut`, `id_user`) VALUES
(10, 'L''écran est brisé', 1, 28),
(11, 'Le wifi ne passe pas sur l''ordi\r\n', 1, 28),
(12, 'materiel defectueux\r\n', 1, 33),
(13, 'Feuille terminer', 1, 23),
(14, 'sqrqer', 1, 23),
(15, 'Câble coupé', 1, 32),
(16, 'Feuille terminé', 1, 32),
(17, 'sdfs;jkdfc', 0, 21),
(18, 'bvvb', 0, 27);

-- --------------------------------------------------------

--
-- Structure de la table `occupe`
--

CREATE TABLE IF NOT EXISTS `occupe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_employe` (`id_user`,`id_service`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Contenu de la table `occupe`
--

INSERT INTO `occupe` (`id`, `id_user`, `id_service`) VALUES
(25, 19, 0),
(24, 19, 22),
(23, 20, 3),
(40, 21, 3),
(36, 23, 0),
(37, 23, 0),
(41, 23, 3),
(42, 26, 6),
(43, 27, 17),
(39, 28, 4),
(44, 29, 3),
(45, 30, 5),
(48, 31, 25),
(49, 32, 6),
(50, 33, 5),
(51, 34, 21);

-- --------------------------------------------------------

--
-- Structure de la table `recuperation`
--

CREATE TABLE IF NOT EXISTS `recuperation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail_recup` varchar(255) NOT NULL,
  `code_recup` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `recuperation`
--

INSERT INTO `recuperation` (`id`, `mail_recup`, `code_recup`) VALUES
(1, 'tepialassane@gmail.com', 40315);

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `id_service` int(11) NOT NULL AUTO_INCREMENT,
  `nom_service` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `id_bureau` int(11) NOT NULL,
  PRIMARY KEY (`id_service`),
  KEY `id_bureau` (`id_bureau`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Contenu de la table `service`
--

INSERT INTO `service` (`id_service`, `nom_service`, `description`, `id_bureau`) VALUES
(3, 'INFORMATIQUE', 'Chargé de la gestion du matériels informatique et de la connexion au sein de l''établissement', 5),
(4, 'COMMUNICATION', 'Charger de la communication interne et externe de l''ISTC', 5),
(5, 'MULTIMEDIA', 'Charger de la communication visuel', 5),
(6, 'MAINTENANCE INFORMATIQUE', 'Regroupe les chefs du service informatique', 8),
(7, 'SCOLARITE', 'S''occupe de la scolarité', 14),
(8, 'DIPLOME', 'Charger de la livraison des diplôme', 0),
(9, 'FORMATION', 'Se charger de la formation', 0),
(10, 'PROGRAMME', 'Charger des programme de toutes les activitées de l''école', 19),
(11, 'CENTRE DE RECHERCHE', 'Charger de la recherche ', 47),
(12, 'STATISTIQUES ', 'Charger des statistiques', 14),
(13, 'EXPLOITATION', 'Charger des exploitations', 44),
(14, 'SECURITE', 'Charger de la sécurité', 0),
(15, 'ENTRETIEN', 'Charger de l''entretien de toute la structure', 51),
(16, 'RESSOURCES HUMAINES', 'S''occupe des employés', 34),
(17, 'ENGAGEMENT ET BUDGET', 'Charger de la gestion du budget et des engagement de l''école', 23),
(18, 'MEDICAL', 'Charger de la santé de tout le personnelle', 0),
(19, 'ECONOMIQUE', 'Charger de l''économie de l''établissement', 42),
(20, 'RELATIONS EXTERIEURES ET COOPERATION', 'Charger des relations avec l''extérieure', 0),
(21, 'STAGES ET INSERTION ', 'Charger des stages et de l''insertion du personnel', 35),
(22, 'ISTCFm', 'Charger de l''animation de la radio de l''istc', 0),
(23, 'PRATIQUE PROFESSIONNELLE', 'Charger de suivre les étudiants dans toutes pratiques au sein de l''ISTC', 0),
(24, 'ORIENTATION', 'Chargé des orientations', 18),
(25, 'DÉVELOPPEUR WEB', 'Chargé de l''entretien du site web', 8);

-- --------------------------------------------------------

--
-- Structure de la table `signale`
--

CREATE TABLE IF NOT EXISTS `signale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_incident` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_employe` (`id_user`,`id_incident`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `signale`
--

INSERT INTO `signale` (`id`, `id_user`, `id_incident`) VALUES
(3, 19, 5),
(1, 20, 1),
(2, 20, 3),
(20, 21, 39),
(4, 23, 7),
(5, 23, 9),
(6, 23, 11),
(7, 23, 13),
(8, 23, 15),
(10, 23, 19),
(11, 23, 21),
(16, 23, 31),
(17, 23, 33),
(9, 27, 17),
(21, 27, 41),
(12, 28, 23),
(13, 28, 25),
(14, 28, 27),
(18, 32, 35),
(19, 32, 37),
(15, 33, 29);

-- --------------------------------------------------------

--
-- Structure de la table `travail`
--

CREATE TABLE IF NOT EXISTS `travail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_bureau` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_employe` (`id_user`,`id_bureau`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Contenu de la table `travail`
--

INSERT INTO `travail` (`id`, `id_user`, `id_bureau`) VALUES
(15, 19, 0),
(12, 19, 5),
(13, 19, 6),
(14, 20, 5),
(28, 21, 5),
(25, 23, 0),
(26, 23, 0),
(30, 23, 5),
(31, 26, 8),
(32, 27, 23),
(29, 28, 5),
(33, 29, 5),
(34, 30, 5),
(35, 31, 8),
(36, 32, 8),
(38, 33, 5),
(39, 34, 21);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

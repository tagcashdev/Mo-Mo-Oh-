-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 07 fév. 2022 à 10:34
-- Version du serveur :  5.7.17
-- Version de PHP : 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `momooh`
--
CREATE DATABASE IF NOT EXISTS `momooh` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `momooh`;

-- --------------------------------------------------------

--
-- Structure de la table `cards`
--

CREATE TABLE IF NOT EXISTS `cards` (
  `id_cards` int(11) NOT NULL AUTO_INCREMENT,
  `cards_title` varchar(255) NOT NULL,
  `cards_level` int(11) DEFAULT NULL,
  `cards_atk` int(11) DEFAULT NULL,
  `cards_def` int(11) DEFAULT NULL,
  `cards_tcg_release` date DEFAULT NULL,
  `cards_ocg_release` date DEFAULT NULL,
  `cards_rush_ocg_release` date NOT NULL,
  `cards_speed_release` date DEFAULT NULL,
  `idx_cards_types` int(11) NOT NULL,
  `idx_card_subtypes` int(11) DEFAULT NULL,
  `idx_card_subtypes2` int(11) DEFAULT NULL,
  `idx_card_attributes` int(11) DEFAULT NULL,
  `idx_monsters_types` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cards`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cards`
--

INSERT INTO `cards` (`id_cards`, `cards_title`, `cards_level`, `cards_atk`, `cards_def`, `cards_tcg_release`, `cards_ocg_release`, `cards_rush_ocg_release`, `cards_speed_release`, `idx_cards_types`, `idx_card_subtypes`, `idx_card_subtypes2`, `idx_card_attributes`, `idx_monsters_types`) VALUES
(1, 'Odd-Eyes Revolution Dragon', 12, -1, -1, '2020-08-06', '2017-10-04', '0000-00-00', NULL, 2, 8, NULL, 4, 5),
(2, 'Odd-Eyes Revolution Dragon', 12, -1, -1, '2017-10-04', '2020-08-06', '0000-00-00', NULL, 2, 8, NULL, 4, 5);

-- --------------------------------------------------------

--
-- Structure de la table `cards_rarity`
--

CREATE TABLE IF NOT EXISTS `cards_rarity` (
  `id_cards_rarity` int(11) NOT NULL AUTO_INCREMENT,
  `cards_rarity_title` varchar(255) NOT NULL,
  `cards_rarity_abbr` varchar(15) NOT NULL,
  `cards_rarity_order` int(11) NOT NULL,
  PRIMARY KEY (`id_cards_rarity`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cards_rarity`
--

INSERT INTO `cards_rarity` (`id_cards_rarity`, `cards_rarity_title`, `cards_rarity_abbr`, `cards_rarity_order`) VALUES
(1, 'Common', 'C', 1),
(2, 'Rare', 'R', 2),
(3, 'Super Rare', 'SR', 3),
(4, 'Ultra Rare', 'UR', 4),
(5, 'Pharaoh\'s Rare', 'UR(PR)', 5),
(6, 'Ultimate Rare', 'UtR', 6),
(7, 'Ghost Rare', 'GR', 7),
(8, 'Platinium Rare', 'PlR', 8),
(9, 'Starlight Rare', 'StR', 9),
(10, 'Secret Rare', 'ScR', 10),
(11, 'Prismatic Secret Rare', 'PScR', 11),
(12, 'Platinium Secret Rare', 'PlScR', 12),
(13, '10000 Secret Rare', '10000ScR', 13),
(14, 'Gold Rare', 'GUR', 14),
(15, 'Gold Secret Rare', 'GScR', 15),
(16, 'Ghost/Gold Rare', 'GGR', 16),
(17, 'Premium Gold Rare', 'PGR', 17),
(18, 'Parallel Rare', 'PR', 18),
(19, 'Super Parallel Rare', 'SPR', 19),
(20, 'Ultra Parallel Rare', 'UPR', 20),
(21, 'Secret Parallel Rare', 'ScPR', 21),
(22, 'Starfoil Rare', 'SFR', 22),
(23, 'Mosaic Rare', 'MSR', 23),
(24, 'Shatterfoil Rare', 'SHR', 24),
(25, 'Collector\'s Rare', 'CR', 25);

-- --------------------------------------------------------

--
-- Structure de la table `cards_types`
--

CREATE TABLE IF NOT EXISTS `cards_types` (
  `id_cards_types` int(11) NOT NULL AUTO_INCREMENT,
  `cards_types_title` varchar(255) NOT NULL,
  `cards_types_background` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_cards_types`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cards_types`
--

INSERT INTO `cards_types` (`id_cards_types`, `cards_types_title`, `cards_types_background`) VALUES
(1, 'Monster-Normal', NULL),
(2, 'Monster-Effect', NULL),
(3, 'Monster-Ritual', NULL),
(4, 'Monster-Fusion', NULL),
(5, 'Monster-Synchro', NULL),
(6, 'Monster-XYZ', NULL),
(7, 'Monster-Link', NULL),
(8, 'Spell-Normal', NULL),
(9, 'Spell-Continuous', NULL),
(10, 'Spell-Equip', NULL),
(11, 'Spell-Quick-Play', NULL),
(12, 'Spell-Ritual', NULL),
(13, 'Spell-Field', NULL),
(14, 'Trap-Normal', NULL),
(15, 'Trap-Continuous', NULL),
(16, 'Trap-Counter', NULL),
(17, '-Non-game-card-', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `card_attributes`
--

CREATE TABLE IF NOT EXISTS `card_attributes` (
  `id_card_attributes` int(11) NOT NULL AUTO_INCREMENT,
  `card_attributes_title` varchar(255) NOT NULL,
  `card_attributes_icon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_card_attributes`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `card_attributes`
--

INSERT INTO `card_attributes` (`id_card_attributes`, `card_attributes_title`, `card_attributes_icon`) VALUES
(1, 'Dark', NULL),
(2, 'Earth', NULL),
(3, 'Fire', NULL),
(4, 'Light', NULL),
(5, 'Water', NULL),
(6, 'Wind', NULL),
(7, 'Divine', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `card_subtypes`
--

CREATE TABLE IF NOT EXISTS `card_subtypes` (
  `id_card_subtypes` int(11) NOT NULL AUTO_INCREMENT,
  `card_subtypes_title` varchar(255) NOT NULL,
  PRIMARY KEY (`id_card_subtypes`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `card_subtypes`
--

INSERT INTO `card_subtypes` (`id_card_subtypes`, `card_subtypes_title`) VALUES
(1, 'Effect'),
(2, 'Flip'),
(3, 'Toon'),
(4, 'Union'),
(5, 'Spirit'),
(6, 'Gemini'),
(7, 'Tuner'),
(8, 'Pendulum'),
(9, 'Skill'),
(10, 'Collectible'),
(11, 'Token');

-- --------------------------------------------------------

--
-- Structure de la table `monsters_types`
--

CREATE TABLE IF NOT EXISTS `monsters_types` (
  `id_monsters_types` int(11) NOT NULL AUTO_INCREMENT,
  `monsters_types_title` varchar(255) NOT NULL,
  PRIMARY KEY (`id_monsters_types`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `monsters_types`
--

INSERT INTO `monsters_types` (`id_monsters_types`, `monsters_types_title`) VALUES
(1, 'Aqua'),
(2, 'Beast'),
(3, 'Beast-Warrior'),
(4, 'Dinosaur'),
(5, 'Dragon'),
(6, 'Fairy'),
(7, 'Fiend'),
(8, 'Fish'),
(9, 'Insect'),
(10, 'Machine'),
(11, 'Plant'),
(12, 'Pyro'),
(13, 'Reptile'),
(14, 'Rock'),
(15, 'Sea Serpent'),
(16, 'Spellcaster'),
(17, 'Thunder'),
(18, 'Warrior'),
(19, 'Winged Beast'),
(20, 'Zombie'),
(21, 'Divine-Beast'),
(22, 'Creator God'),
(23, 'Psychic'),
(24, 'Wyrm'),
(25, 'Cyberse'),
(26, 'Cyborg');

-- --------------------------------------------------------

--
-- Structure de la table `owned_cards`
--

CREATE TABLE IF NOT EXISTS `owned_cards` (
  `id_owned_cards` int(11) NOT NULL AUTO_INCREMENT,
  `owned_cards_quantity` int(11) NOT NULL,
  `owned_cards_extension` varchar(255) NOT NULL,
  `idx_cards` int(11) NOT NULL,
  `idx_cards_rarity` int(11) NOT NULL,
  PRIMARY KEY (`id_owned_cards`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

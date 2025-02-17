-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para dungeonmaster
CREATE DATABASE IF NOT EXISTS `dungeonmaster` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `dungeonmaster`;

-- Copiando estrutura para tabela dungeonmaster.abilities
CREATE TABLE IF NOT EXISTS `abilities` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ability_name` varchar(50) NOT NULL DEFAULT '0',
  `ability_key` varchar(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela dungeonmaster.abilities: ~6 rows (aproximadamente)
INSERT INTO `abilities` (`id`, `ability_name`, `ability_key`) VALUES
	(1, 'Força', 'for'),
	(2, 'Destreza', 'des'),
	(3, 'Constituição', 'con'),
	(4, 'Inteligência', 'int'),
	(5, 'Sabedoria', 'sab'),
	(6, 'Carisma', 'car');

-- Copiando estrutura para tabela dungeonmaster.abilities_map_class
CREATE TABLE IF NOT EXISTS `abilities_map_class` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_id` int NOT NULL DEFAULT '0',
  `index_1` int NOT NULL DEFAULT '0',
  `index_2` int NOT NULL DEFAULT '0',
  `index_3` int NOT NULL DEFAULT '0',
  `index_4` int NOT NULL DEFAULT '0',
  `index_5` int NOT NULL DEFAULT '0',
  `index_6` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_CLASS_MAP` (`class_id`),
  KEY `FK_ABILITY_MAP_IDX1` (`index_1`),
  KEY `FK_ABILITY_MAP_IDX2` (`index_2`),
  KEY `FK_ABILITY_MAP_IDX3` (`index_3`),
  KEY `FK_ABILITY_MAP_IDX4` (`index_4`),
  KEY `FK_ABILITY_MAP_IDX5` (`index_5`),
  KEY `FK_ABILITY_MAP_IDX6` (`index_6`),
  CONSTRAINT `FK_ABILITY_MAP_IDX1` FOREIGN KEY (`index_1`) REFERENCES `abilities` (`id`),
  CONSTRAINT `FK_ABILITY_MAP_IDX2` FOREIGN KEY (`index_2`) REFERENCES `abilities` (`id`),
  CONSTRAINT `FK_ABILITY_MAP_IDX3` FOREIGN KEY (`index_3`) REFERENCES `abilities` (`id`),
  CONSTRAINT `FK_ABILITY_MAP_IDX4` FOREIGN KEY (`index_4`) REFERENCES `abilities` (`id`),
  CONSTRAINT `FK_ABILITY_MAP_IDX5` FOREIGN KEY (`index_5`) REFERENCES `abilities` (`id`),
  CONSTRAINT `FK_ABILITY_MAP_IDX6` FOREIGN KEY (`index_6`) REFERENCES `abilities` (`id`),
  CONSTRAINT `FK_CLASS_MAP` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela dungeonmaster.abilities_map_class: ~12 rows (aproximadamente)
INSERT INTO `abilities_map_class` (`id`, `class_id`, `index_1`, `index_2`, `index_3`, `index_4`, `index_5`, `index_6`) VALUES
	(2, 9, 2, 3, 6, 5, 4, 1),
	(4, 1, 1, 3, 2, 5, 6, 4),
	(8, 3, 5, 1, 3, 2, 4, 6),
	(11, 4, 5, 3, 2, 4, 6, 1),
	(12, 5, 1, 3, 2, 5, 6, 4),
	(14, 6, 2, 5, 3, 1, 4, 6),
	(16, 7, 1, 6, 3, 5, 4, 2),
	(17, 2, 6, 2, 3, 5, 4, 1),
	(18, 8, 2, 5, 3, 1, 4, 6),
	(19, 10, 6, 3, 2, 5, 4, 1),
	(20, 11, 6, 3, 2, 5, 4, 1),
	(21, 12, 4, 3, 2, 5, 6, 1);

-- Copiando estrutura para tabela dungeonmaster.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(50) NOT NULL DEFAULT '0',
  `perc_ini` float NOT NULL DEFAULT '0',
  `perc_final` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela dungeonmaster.category: ~3 rows (aproximadamente)
INSERT INTO `category` (`id`, `category`, `perc_ini`, `perc_final`) VALUES
	(1, 'Incomum', 6.1, 10),
	(2, 'Raro', 2.6, 6),
	(3, 'Lendário', 0, 2.5);

-- Copiando estrutura para tabela dungeonmaster.classes
CREATE TABLE IF NOT EXISTS `classes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class` varchar(50) NOT NULL DEFAULT '0',
  `key_ability` int NOT NULL DEFAULT '1',
  `key_ability_2` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_CLASS_ABILITY_K1` (`key_ability`),
  KEY `FK_CLASS_ABILITY_K2` (`key_ability_2`),
  CONSTRAINT `FK_CLASS_ABILITY_K1` FOREIGN KEY (`key_ability`) REFERENCES `abilities` (`id`),
  CONSTRAINT `FK_CLASS_ABILITY_K2` FOREIGN KEY (`key_ability_2`) REFERENCES `abilities` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela dungeonmaster.classes: ~12 rows (aproximadamente)
INSERT INTO `classes` (`id`, `class`, `key_ability`, `key_ability_2`) VALUES
	(1, 'Bárbaro', 1, NULL),
	(2, 'Bardo', 6, NULL),
	(3, 'Clérigo', 5, NULL),
	(4, 'Druida', 5, NULL),
	(5, 'Guerreiro', 1, 3),
	(6, 'Monge', 2, 5),
	(7, 'Paladino', 1, 6),
	(8, 'Ranger', 2, 5),
	(9, 'Ladino', 2, NULL),
	(10, 'Feiticeiro', 6, NULL),
	(11, 'Bruxo', 6, NULL),
	(12, 'Mago', 4, NULL);

-- Copiando estrutura para tabela dungeonmaster.gender
CREATE TABLE IF NOT EXISTS `gender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gender` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela dungeonmaster.gender: ~2 rows (aproximadamente)
INSERT INTO `gender` (`id`, `gender`) VALUES
	(1, 'Masculino'),
	(2, 'Feminino');

-- Copiando estrutura para tabela dungeonmaster.lastnames
CREATE TABLE IF NOT EXISTS `lastnames` (
  `id` int NOT NULL AUTO_INCREMENT,
  `race_id` int NOT NULL DEFAULT '0',
  `last_name` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_RACE_LNAME` (`race_id`),
  CONSTRAINT `FK_RACE_LNAME` FOREIGN KEY (`race_id`) REFERENCES `races` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela dungeonmaster.lastnames: ~135 rows (aproximadamente)
INSERT INTO `lastnames` (`id`, `race_id`, `last_name`) VALUES
	(1, 2, 'Amakiir'),
	(2, 2, 'Amastacia'),
	(3, 2, 'Galanodel'),
	(4, 2, 'Holimion'),
	(5, 2, 'Ilphelkiir'),
	(6, 2, 'Liadon'),
	(7, 2, 'Meliamne'),
	(8, 2, 'Nailo'),
	(9, 2, 'Siannodel'),
	(10, 2, 'Xiloscient'),
	(11, 2, 'Eilistraee'),
	(12, 2, 'Galathil'),
	(13, 2, 'Vanima'),
	(14, 2, 'Arafinwe'),
	(15, 2, 'Tennobil'),
	(16, 2, 'Celebrian'),
	(17, 2, 'Calafalas'),
	(18, 2, 'Oranor'),
	(19, 2, 'Anorion'),
	(20, 2, 'Nailo'),
	(21, 1, 'Boulderfist'),
	(22, 1, 'Broadaxe'),
	(23, 1, 'Bronzebeard'),
	(24, 1, 'Deepdelver'),
	(25, 1, 'Everforge'),
	(26, 1, 'Fireforge'),
	(27, 1, 'Flintbeard'),
	(28, 1, 'Foehammer'),
	(29, 1, 'Goldfinder'),
	(30, 1, 'Grimhammer'),
	(31, 1, 'Longbeard'),
	(32, 1, 'Magmaborn'),
	(33, 1, 'Mountainhold'),
	(34, 1, 'Oathill'),
	(35, 1, 'Rumbleforge'),
	(36, 1, 'Silverpick'),
	(37, 1, 'Stonehammer'),
	(38, 1, 'Strongbrew'),
	(39, 1, 'Trueaxe'),
	(40, 1, 'Windwalker'),
	(41, 12, 'Ashborn'),
	(42, 12, 'Cinderstep'),
	(43, 12, 'Deathsmark'),
	(44, 12, 'Dreadhorn'),
	(45, 12, 'Emberscale'),
	(46, 12, 'Hellforge'),
	(47, 12, 'Ironblood'),
	(48, 12, 'Nightshade'),
	(49, 12, 'Nightsinger'),
	(50, 12, 'Shadowborn'),
	(51, 12, 'Shadowhand'),
	(52, 12, 'Stonesinger'),
	(53, 12, 'Stormcaller'),
	(54, 12, 'Sulfurheart'),
	(55, 12, 'Trickfeather'),
	(56, 12, 'Twilightborn'),
	(57, 12, 'Whisperscale'),
	(58, 12, 'Wraithkin'),
	(59, 12, 'Wyrmtongue'),
	(60, 12, 'Crimsonclaw'),
	(61, 6, 'Appleblossom'),
	(62, 6, 'Buttercup'),
	(63, 6, 'Fairfield'),
	(64, 6, 'Featherfoot'),
	(65, 6, 'Greenleaf'),
	(66, 6, 'Honeycomb'),
	(67, 6, 'Leafshade'),
	(68, 6, 'Marshsong'),
	(69, 6, 'Meadowbrook'),
	(70, 6, 'Moonwhisper'),
	(71, 6, 'Oakenshield'),
	(72, 6, 'Raincatcher'),
	(73, 6, 'Riverdeep'),
	(74, 6, 'Stonehome'),
	(75, 6, 'Sunseeker'),
	(76, 6, 'Swiftwind'),
	(77, 6, 'Thistlebrook'),
	(78, 6, 'Whisperingwood'),
	(79, 6, 'Wildflower'),
	(80, 6, 'Willowbrook'),
	(81, 3, 'Stormwind'),
	(82, 3, 'Brightwood'),
	(83, 3, 'Ironfist'),
	(84, 3, 'Silverblade'),
	(85, 3, 'Shadowbrook'),
	(86, 3, 'Oakenshield'),
	(87, 3, 'Hawke'),
	(88, 3, 'Ravenwood'),
	(89, 3, 'Windrider'),
	(90, 3, 'Stonehammer'),
	(91, 3, 'Fireheart'),
	(92, 3, 'Sunwalker'),
	(93, 3, 'Stormbringer'),
	(94, 3, 'Frostfang'),
	(95, 3, 'Nightshade'),
	(96, 3, 'Moonwhisper'),
	(97, 3, 'Swiftblade'),
	(98, 3, 'Lightbringer'),
	(99, 3, 'Stormcloak'),
	(100, 3, 'Dragonbane'),
	(101, 14, 'Clethtinthiallor'),
	(102, 14, 'Daardendrian'),
	(103, 14, 'Delmirev'),
	(104, 14, 'Drachedandion'),
	(105, 14, 'Fenkenkabradon'),
	(106, 14, 'Kepeshkmolik'),
	(107, 14, 'Kerrhylon'),
	(108, 14, 'Kimbatuul'),
	(109, 14, 'Linxakasendalor'),
	(110, 14, 'Myastan'),
	(111, 14, 'Nemmonis'),
	(112, 14, 'Norixius'),
	(113, 14, 'Ophinshtalajiir'),
	(114, 14, 'Prexijandilin'),
	(115, 14, 'Shestendeliath'),
	(116, 14, 'Turnuroth'),
	(117, 14, 'Verthisathurgiesh'),
	(118, 14, 'Yarjerit'),
	(119, 14, 'Zzzxaaxth'),
	(120, 14, 'Skaarzborroesh'),
	(121, 15, 'Nackle'),
	(122, 15, 'Ningel'),
	(123, 15, 'Beren'),
	(124, 15, 'Daergel'),
	(125, 15, 'Folkor'),
	(126, 15, 'Garrick'),
	(127, 15, 'Gobble'),
	(128, 15, 'Fabblestabble'),
	(129, 15, 'Dimble'),
	(130, 15, 'Gimlen'),
	(131, 15, 'Timbers'),
	(132, 15, 'Scheppen'),
	(133, 15, 'Nackle'),
	(134, 15, 'Murnig'),
	(135, 15, 'Baublestone'),
	(136, 15, 'Murnig'),
	(137, 15, 'Arbuckle'),
	(138, 15, 'Tinkertop'),
	(139, 15, 'Rofferton'),
	(140, 15, 'Cobbletree'),
	(141, 3, 'The Rivia');

-- Copiando estrutura para tabela dungeonmaster.names
CREATE TABLE IF NOT EXISTS `names` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gender_id` int NOT NULL DEFAULT '0',
  `race_id` int NOT NULL DEFAULT '0',
  `first_name` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_NAME_GENDER` (`gender_id`),
  KEY `FK_RACE_NAME` (`race_id`),
  CONSTRAINT `FK_NAME_GENDER` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`),
  CONSTRAINT `FK_RACE_NAME` FOREIGN KEY (`race_id`) REFERENCES `races` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=383 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela dungeonmaster.names: ~336 rows (aproximadamente)
INSERT INTO `names` (`id`, `gender_id`, `race_id`, `first_name`) VALUES
	(1, 1, 2, 'Aelar'),
	(2, 1, 2, 'Arannis'),
	(3, 1, 2, 'Beiro'),
	(4, 1, 2, 'Carric'),
	(5, 1, 2, 'Eldrin'),
	(6, 1, 2, 'Faelar'),
	(7, 1, 2, 'Galinndan'),
	(8, 1, 2, 'Haldir'),
	(9, 1, 2, 'Ilarion'),
	(10, 1, 2, 'Jassin'),
	(11, 1, 2, 'Kael'),
	(12, 1, 2, 'Laucian'),
	(13, 1, 2, 'Mythanthar'),
	(14, 1, 2, 'Nindrol'),
	(15, 1, 2, 'Paelias'),
	(16, 1, 2, 'Quarion'),
	(17, 1, 2, 'Rolen'),
	(18, 1, 2, 'Soveliss'),
	(19, 1, 2, 'Thamior'),
	(20, 1, 2, 'Varis'),
	(41, 1, 12, 'Aamon'),
	(42, 1, 12, 'Adram'),
	(43, 1, 12, 'Azrael'),
	(44, 1, 12, 'Barakiel'),
	(45, 1, 12, 'Beleth'),
	(46, 1, 12, 'Belial'),
	(47, 1, 12, 'Belethor'),
	(48, 1, 12, 'Cernos'),
	(49, 1, 12, 'Daemon'),
	(50, 1, 12, 'Devlin'),
	(51, 1, 12, 'Draven'),
	(52, 1, 12, 'Dusgar'),
	(53, 1, 12, 'Zigrael'),
	(54, 1, 12, 'Zebulon'),
	(55, 1, 12, 'Zepar'),
	(56, 1, 12, 'Zevrahm'),
	(57, 1, 12, 'Malphas'),
	(58, 1, 12, 'Malthus'),
	(59, 1, 12, 'Moloch'),
	(60, 1, 12, 'Mordek'),
	(61, 2, 2, 'Aelryn'),
	(62, 2, 2, 'Alenya'),
	(63, 2, 2, 'Anya'),
	(64, 2, 2, 'Arya'),
	(65, 2, 2, 'Driana'),
	(66, 2, 2, 'Elowen'),
	(67, 2, 2, 'Elwing'),
	(68, 2, 2, 'Elyana'),
	(69, 2, 2, 'Faela'),
	(70, 2, 2, 'Irial'),
	(71, 2, 2, 'Laeral'),
	(72, 2, 2, 'Laurelin'),
	(73, 2, 2, 'Leiana'),
	(74, 2, 2, 'Liriel'),
	(75, 2, 2, 'Lysanna'),
	(76, 2, 2, 'Salanna'),
	(77, 2, 2, 'Sariel'),
	(78, 2, 2, 'Sylvana'),
	(79, 2, 2, 'Telara'),
	(80, 2, 2, 'Tylanna'),
	(81, 2, 12, 'Astarte'),
	(82, 2, 12, 'Azura'),
	(83, 2, 12, 'Beleth'),
	(84, 2, 12, 'Jezebel'),
	(85, 2, 12, 'Lilith'),
	(86, 2, 12, 'Malphasmera'),
	(87, 2, 12, 'Malthusa'),
	(88, 2, 12, 'Molochta'),
	(89, 2, 12, 'Mordra'),
	(90, 2, 12, 'Naamah'),
	(91, 2, 12, 'Nymeia'),
	(92, 2, 12, 'Prescila'),
	(93, 2, 12, 'Racheal'),
	(94, 2, 12, 'Succubus'),
	(95, 2, 12, 'Vashti'),
	(96, 2, 12, 'Xalbatha'),
	(97, 2, 12, 'Yagrush'),
	(98, 2, 12, 'Falma'),
	(99, 2, 12, 'Zyphra'),
	(100, 2, 12, 'Zariel'),
	(101, 1, 1, 'Balin'),
	(102, 1, 1, 'Bifur'),
	(103, 1, 1, 'Bombur'),
	(104, 1, 1, 'Brokk'),
	(105, 1, 1, 'Dain'),
	(106, 1, 1, 'Durin'),
	(107, 1, 1, 'Dwalin'),
	(108, 1, 1, 'Fili'),
	(109, 1, 1, 'Fimvelir'),
	(110, 1, 1, 'Gloin'),
	(111, 1, 1, 'Gimli'),
	(112, 1, 1, 'Óin'),
	(113, 1, 1, 'Nidavelyr'),
	(114, 1, 1, 'Ori'),
	(115, 1, 1, 'Thorin'),
	(116, 1, 1, 'Thrór'),
	(117, 1, 1, 'Thráin'),
	(118, 1, 1, 'Náin'),
	(119, 1, 1, 'Dáin'),
	(120, 1, 1, 'Borin'),
	(121, 2, 1, 'Aella'),
	(122, 2, 1, 'Alfrida'),
	(123, 2, 1, 'Angharad'),
	(124, 2, 1, 'Brynhild'),
	(125, 2, 1, 'Dagna'),
	(126, 2, 1, 'Disa'),
	(127, 2, 1, 'Durga'),
	(128, 2, 1, 'Eira'),
	(129, 2, 1, 'Eitri'),
	(130, 2, 1, 'Fimbulvetr'),
	(131, 2, 1, 'Frida'),
	(132, 2, 1, 'Gunda'),
	(133, 2, 1, 'Gunnhild'),
	(134, 2, 1, 'Helga'),
	(135, 2, 1, 'Hilda'),
	(136, 2, 1, 'Jordis'),
	(137, 2, 1, 'Kara'),
	(138, 2, 1, 'Linde'),
	(139, 2, 1, 'Morwen'),
	(140, 2, 1, 'Ysolda'),
	(141, 1, 6, 'Barnaby'),
	(142, 1, 6, 'Bilbo'),
	(143, 1, 6, 'Eldor'),
	(144, 1, 6, 'Fastred'),
	(145, 1, 6, 'Folco'),
	(146, 1, 6, 'Hamfast'),
	(147, 1, 6, 'Milo'),
	(148, 1, 6, 'Odo'),
	(149, 1, 6, 'Pippin'),
	(150, 1, 6, 'Rowan'),
	(151, 1, 6, 'Sandor'),
	(152, 1, 6, 'Tebbit'),
	(153, 1, 6, 'Theo'),
	(154, 1, 6, 'Tobin'),
	(155, 1, 6, 'Ulfgar'),
	(156, 1, 6, 'Waldorf'),
	(157, 1, 6, 'Wilfred'),
	(158, 1, 6, 'Yorick'),
	(159, 1, 6, 'Zebediah'),
	(160, 2, 6, 'Belladonna'),
	(161, 2, 6, 'Blossom'),
	(162, 2, 6, 'Esmeralda'),
	(163, 2, 6, 'Freya'),
	(164, 2, 6, 'Hazel'),
	(165, 2, 6, 'Holly'),
	(166, 2, 6, 'Jessamine'),
	(167, 2, 6, 'Lavender'),
	(168, 2, 6, 'Lily'),
	(169, 2, 6, 'Marigold'),
	(170, 2, 6, 'Poppy'),
	(171, 2, 6, 'Primrose'),
	(172, 2, 6, 'Rosamund'),
	(173, 2, 6, 'Rowena'),
	(174, 2, 6, 'Sage'),
	(175, 2, 6, 'Willow'),
	(176, 2, 6, 'Wisteria'),
	(177, 2, 6, 'Yarrow'),
	(178, 2, 6, 'Zephyra'),
	(180, 1, 6, 'Finnick'),
	(181, 2, 6, 'Daisy'),
	(182, 1, 3, 'Aric'),
	(183, 1, 3, 'Barnaby'),
	(184, 1, 3, 'Corvus'),
	(185, 1, 3, 'Eldred'),
	(186, 1, 3, 'Gareth'),
	(187, 1, 3, 'Hadrian'),
	(188, 1, 3, 'Jasper'),
	(189, 1, 3, 'Kael'),
	(190, 1, 3, 'Leodan'),
	(191, 1, 3, 'Marius'),
	(192, 1, 3, 'Osric'),
	(193, 1, 3, 'Rowan'),
	(194, 1, 3, 'Sigurd'),
	(195, 1, 3, 'Talon'),
	(196, 1, 3, 'Uriel'),
	(197, 1, 3, 'Valiant'),
	(198, 1, 3, 'Wulfric'),
	(199, 1, 3, 'Xavier'),
	(200, 1, 3, 'Yorick'),
	(201, 1, 3, 'Zane'),
	(202, 2, 3, 'Amara'),
	(203, 2, 3, 'Elara'),
	(204, 2, 3, 'Elara'),
	(205, 2, 3, 'Fiona'),
	(206, 2, 3, 'Isolde'),
	(207, 2, 3, 'Jaina'),
	(208, 2, 3, 'Kiara'),
	(209, 2, 3, 'Leona'),
	(210, 2, 3, 'Lyra'),
	(211, 2, 3, 'Maeve'),
	(212, 2, 3, 'Nova'),
	(213, 2, 3, 'Ophelia'),
	(214, 2, 3, 'Reina'),
	(215, 2, 3, 'Seraphina'),
	(216, 2, 3, 'Talia'),
	(217, 2, 3, 'Valentina'),
	(218, 2, 3, 'Willow'),
	(219, 2, 3, 'Xena'),
	(220, 2, 3, 'Yvaine'),
	(221, 2, 3, 'Zara'),
	(222, 1, 4, 'Aelarion'),
	(223, 1, 4, 'Aerin'),
	(224, 1, 4, 'Celeborn'),
	(225, 1, 4, 'Eldarion'),
	(226, 1, 4, 'Evalon'),
	(227, 1, 4, 'Faolan'),
	(228, 1, 4, 'Gareth'),
	(229, 1, 4, 'Lorien'),
	(230, 1, 4, 'Maelwyn'),
	(231, 1, 4, 'Naerion'),
	(232, 1, 4, 'Rian'),
	(233, 1, 4, 'Rowan'),
	(234, 1, 4, 'Soren'),
	(235, 1, 4, 'Sylvan'),
	(236, 1, 4, 'Talion'),
	(237, 1, 4, 'Vaelin'),
	(238, 1, 4, 'Wyn'),
	(239, 1, 4, 'Xander'),
	(240, 1, 4, 'Zael'),
	(241, 1, 4, 'Zephryn'),
	(242, 2, 4, 'Aelwyn'),
	(243, 2, 4, 'Elara'),
	(244, 2, 4, 'Elarae'),
	(245, 2, 4, 'Illien'),
	(246, 2, 4, 'Isolde'),
	(247, 2, 4, 'Leiana'),
	(248, 2, 4, 'Liriel'),
	(249, 2, 4, 'Lyrana'),
	(250, 2, 4, 'Maeve'),
	(251, 2, 4, 'Naia'),
	(252, 2, 4, 'Nimue'),
	(253, 2, 4, 'Rhiannon'),
	(254, 2, 4, 'Rosalyn'),
	(255, 2, 4, 'Seraphina'),
	(256, 2, 4, 'Sylvana'),
	(257, 2, 4, 'Talia'),
	(258, 2, 4, 'Valandria'),
	(259, 2, 4, 'Willow'),
	(260, 2, 4, 'Ysera'),
	(261, 2, 4, 'Zafira'),
	(262, 1, 5, 'Bruenor Strongarm'),
	(263, 1, 5, 'Drakul Fangbreaker'),
	(264, 1, 5, 'Fenris Blackaxe'),
	(265, 1, 5, 'Garek Skullcleaver'),
	(266, 1, 5, 'Grothgar Ironhide'),
	(267, 1, 5, 'Haggar the Bold'),
	(268, 1, 5, 'Korvus Bloodfist'),
	(269, 1, 5, 'Malachai Scourgebringer'),
	(270, 1, 5, 'Murdock Skullsplitter'),
	(271, 1, 5, 'Ragnar Stonebreaker'),
	(272, 1, 5, 'Rekton Goretooth'),
	(273, 1, 5, 'Roderick the Savage'),
	(274, 1, 5, 'Skarn Bloodclaw'),
	(275, 1, 5, 'Thorgrim Warborn'),
	(276, 1, 5, 'Ulfric the Mauler'),
	(277, 1, 5, 'Varick the Butcher'),
	(278, 1, 5, 'Volkan Ironjaw'),
	(279, 1, 5, 'Xarlon the Ruthless'),
	(280, 1, 5, 'Zarduk Warsong'),
	(281, 1, 5, 'Zokar the Brute'),
	(282, 2, 5, 'Anya Stonehand'),
	(283, 2, 5, 'Brynhild Bonebreaker'),
	(284, 2, 5, 'Elara Razorclaw'),
	(285, 2, 5, 'Freya Warheart'),
	(286, 2, 5, 'Griska Ironjaw'),
	(287, 2, 5, 'Helga the Fierce'),
	(288, 2, 5, 'Ilsa Bloodsong'),
	(289, 2, 5, 'Jessa Cleaver'),
	(290, 2, 5, 'Katrine the Unbroken'),
	(291, 2, 5, 'Leona the Mauler'),
	(292, 2, 5, 'Marla Skullsplitter'),
	(293, 2, 5, 'Nara Grimtooth'),
	(294, 2, 5, 'Olwen Stoneshield'),
	(295, 2, 5, 'Petra the Savage'),
	(296, 2, 5, 'Rhona Ironfist'),
	(297, 2, 5, 'Serra the Untamed'),
	(298, 2, 5, 'Talia Bloodfury'),
	(299, 2, 5, 'Ulfrida Warcry'),
	(300, 2, 5, 'Velda Ironhide'),
	(301, 2, 5, 'Zaria the Ruthless'),
	(302, 1, 14, 'Arjhan'),
	(303, 1, 14, 'Balasar'),
	(304, 1, 14, 'Bharash'),
	(305, 1, 14, 'Donaar'),
	(306, 1, 14, 'Ghesh'),
	(307, 1, 14, 'Heskan'),
	(308, 1, 14, 'Kriv'),
	(309, 1, 14, 'Medrash'),
	(310, 1, 14, 'Nadarr'),
	(311, 1, 14, 'Pandjed'),
	(312, 1, 14, 'Patrin'),
	(313, 1, 14, 'Rhogar'),
	(314, 1, 14, 'Shamash'),
	(315, 1, 14, 'Shedinn'),
	(316, 1, 14, 'Tarhun'),
	(317, 1, 14, 'Torinn'),
	(318, 1, 14, 'Akros'),
	(319, 1, 14, 'Ammak'),
	(320, 1, 14, 'Argon'),
	(321, 1, 14, 'Axaran'),
	(322, 2, 14, 'Akra'),
	(323, 2, 14, 'Biri'),
	(324, 2, 14, 'Daar'),
	(325, 2, 14, 'Farideh'),
	(326, 2, 14, 'Harann'),
	(327, 2, 14, 'Havilar'),
	(328, 2, 14, 'Jheri'),
	(329, 2, 14, 'Kava'),
	(330, 2, 14, 'Korinn'),
	(331, 2, 14, 'Mishann'),
	(332, 2, 14, 'Nala'),
	(333, 2, 14, 'Perra'),
	(334, 2, 14, 'Raiann'),
	(335, 2, 14, 'Sora'),
	(336, 2, 14, 'Surina'),
	(337, 2, 14, 'Thava'),
	(338, 2, 14, 'Uadjit'),
	(339, 2, 14, 'Vezera'),
	(340, 2, 14, 'Vistra'),
	(341, 2, 14, 'Zara'),
	(342, 1, 15, 'Alston'),
	(343, 1, 15, 'Alvyn'),
	(344, 1, 15, 'Boddynock'),
	(345, 1, 15, 'Brocc'),
	(346, 1, 15, 'Burgell'),
	(347, 1, 15, 'Dimble'),
	(348, 1, 15, 'Eldon'),
	(349, 1, 15, 'Erky'),
	(350, 1, 15, 'Frug'),
	(351, 1, 15, 'Gimble'),
	(352, 1, 15, 'Glim'),
	(353, 1, 15, 'Jebeddo'),
	(354, 1, 15, 'Kellen", "Namfoodle'),
	(355, 1, 15, 'Roondar'),
	(356, 1, 15, 'Seebo'),
	(357, 1, 15, 'Sindri'),
	(358, 1, 15, 'Warryn'),
	(359, 1, 15, 'Wrenn'),
	(360, 1, 15, 'Zook'),
	(361, 1, 15, 'Eldon'),
	(362, 2, 15, 'Bimpnottin'),
	(363, 2, 15, 'Breena'),
	(364, 2, 15, 'Caramip'),
	(365, 2, 15, 'Carlin'),
	(366, 2, 15, 'Donella'),
	(367, 2, 15, 'Duvamil'),
	(368, 2, 15, 'Ella'),
	(369, 2, 15, 'Ellyjobell'),
	(370, 2, 15, 'Ellywick'),
	(371, 2, 15, 'Lilli'),
	(372, 2, 15, 'Lorilla'),
	(373, 2, 15, 'Nissa'),
	(374, 2, 15, 'Nyx'),
	(375, 2, 15, 'Oda'),
	(376, 2, 15, 'Orla'),
	(377, 2, 15, 'Roywyn'),
	(378, 2, 15, 'Shamil'),
	(379, 2, 15, 'Tana'),
	(380, 2, 15, 'Waywocket'),
	(381, 2, 15, 'Zanna'),
	(382, 1, 3, 'Geralt');

-- Copiando estrutura para tabela dungeonmaster.races
CREATE TABLE IF NOT EXISTS `races` (
  `id` int NOT NULL AUTO_INCREMENT,
  `race` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela dungeonmaster.races: ~8 rows (aproximadamente)
INSERT INTO `races` (`id`, `race`) VALUES
	(1, 'Anão'),
	(2, 'Elfo'),
	(3, 'Humano'),
	(4, 'Meio-Elfo'),
	(5, 'Meio-Orc'),
	(6, 'Halfling'),
	(12, 'Tiefling'),
	(14, 'Draconato'),
	(15, 'Gnomo');

-- Copiando estrutura para tabela dungeonmaster.specials
CREATE TABLE IF NOT EXISTS `specials` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL DEFAULT '0',
  `last_name` varchar(50) NOT NULL DEFAULT '0',
  `race_id` int NOT NULL DEFAULT '0',
  `gender_id` int NOT NULL DEFAULT '0',
  `class_id` int NOT NULL DEFAULT '0',
  `str` int NOT NULL DEFAULT '0',
  `dex` int NOT NULL DEFAULT '0',
  `con` int NOT NULL DEFAULT '0',
  `int` int NOT NULL DEFAULT '0',
  `wis` int NOT NULL DEFAULT '0',
  `cha` int NOT NULL DEFAULT '0',
  `category_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_SPECIAL_CLASS` (`class_id`),
  KEY `FK_SPECIAL_GENDER` (`gender_id`),
  KEY `FK_SPECIAL_RACE` (`race_id`),
  KEY `FK_SPECIAL_CATEGORY` (`category_id`),
  CONSTRAINT `FK_SPECIAL_CATEGORY` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_SPECIAL_CLASS` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  CONSTRAINT `FK_SPECIAL_GENDER` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`),
  CONSTRAINT `FK_SPECIAL_RACE` FOREIGN KEY (`race_id`) REFERENCES `races` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela dungeonmaster.specials: ~0 rows (aproximadamente)
INSERT INTO `specials` (`id`, `first_name`, `last_name`, `race_id`, `gender_id`, `class_id`, `str`, `dex`, `con`, `int`, `wis`, `cha`, `category_id`) VALUES
	(2, 'Frodo', 'Bolseiro', 6, 1, 9, 10, 16, 14, 14, 12, 12, 1),
	(4, 'Geralt de Rivia', '', 3, 1, 11, 18, 16, 18, 16, 15, 18, 3),
	(6, 'Harry', 'Potter', 3, 1, 12, 12, 14, 14, 18, 16, 18, 2);

-- Copiando estrutura para tabela dungeonmaster.temp_char
CREATE TABLE IF NOT EXISTS `temp_char` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `race_id` int NOT NULL,
  `gender_id` int NOT NULL,
  `class_id` int NOT NULL,
  `str` int NOT NULL,
  `dex` int NOT NULL,
  `con` int NOT NULL,
  `int` int NOT NULL,
  `wis` int NOT NULL,
  `cha` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_RACE_CHAR` (`race_id`),
  KEY `FX_GENDER_CHAR` (`gender_id`),
  KEY `FK_CLASS_CHAR` (`class_id`),
  CONSTRAINT `FK_CLASS_CHAR` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  CONSTRAINT `FK_RACE_CHAR` FOREIGN KEY (`race_id`) REFERENCES `races` (`id`),
  CONSTRAINT `FX_GENDER_CHAR` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela dungeonmaster.temp_char: ~2 rows (aproximadamente)
INSERT INTO `temp_char` (`id`, `name`, `race_id`, `gender_id`, `class_id`, `str`, `dex`, `con`, `int`, `wis`, `cha`) VALUES
	(1, 'Abbadon Servirish', 5, 1, 9, 0, 0, 0, 0, 0, 0),
	(2, 'Martiris Frosin', 3, 1, 1, 0, 0, 0, 0, 0, 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

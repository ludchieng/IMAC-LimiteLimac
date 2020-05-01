/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE TABLE IF NOT EXISTS `card` (
  `id_card` char(5) NOT NULL,
  `content` varchar(255) NOT NULL,
  `pname` varchar(50) DEFAULT NULL,
  `id_pack` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_card`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `card` DISABLE KEYS */;
INSERT INTO `card` (`id_card`, `content`, `pname`, `id_pack`) VALUES
	('B1001', 'Pourquoi le dernier jeudimac m\'a traumatisé', '', 1),
	('B1002', 'Le plaisir coupable de Gérald Robin.', '', 5),
	('B1003', '50% des jeudimacs finissent par __________.', '', 4),
	('B1004', 'La médecine alternative loue, désormais, les bienfaits de __________.', '', 2),
	('B1005', '80% des IMACs+ sont traumatisés par __________.', '', 1),
	('B1006', 'Comment j\'ai perdu ma virginité ?', '', 2),
	('B1007', 'Crime contre l\'humanité.', '', 2),
	('B1008', 'On l\'attend depuis plus de 5 mois.', '', 2),
	('B1009', 'Ma raison de vivre ?', '', 4),
	('B1010', 'Le superpouvoir de Cherrier ?', '', 1),
	('B1011', 'Ce qui nous redonne TOUS foi en l\'humanité.', '', 4),
	('B1012', 'Pourquoi je pécho pas ? Parce que __________', '', 3),
	('B1013', 'Mais avant de vous tuer, M. Bond, laissez-moi vous montrer __________.', '', 2),
	('B1014', 'L\'histoire de ma vie ?', '', 1),
	('B1015', 'Je m\'en lasserai jamais.', '', 1),
	('B1016', '__________ ? Impossible.', '', 1),
	('B1017', 'J\'échangerai ma mère contre __________', '', 4),
	('B1018', '__________ : testé par les IMACs, approuvé par Cherrier', '', 1),
	('B1019', 'Ce dont je rêve depuis bien trop longtemps ?', '', 3),
	('B1020', '__________. Ca c\'est IMAC', '', 1),
	('B1021', 'Qu\'est-ce qui me donne toujours des gaz ?', '', 4),
	('B1022', '__________ peut détruire la réputation de l\'IMAC à jamais', '', 3),
	('B1023', 'Boire pour oublier __________', '', 1),
	('B1024', 'La science démontre que __________ a soigné les IMACs d\'une profonde dépression', '', 1),
	('B1025', 'Ce que j\'ai en tête pendant le coït', '', 4),
	('B1026', '__________ en slip, sah quel plaisir !', '', 4),
	('B1027', 'Cette idée révolutionnaire va boulverser le monde.', '', 2),
	('B1028', 'Rien ne vaut __________ mais à poil', '', 4),
	('B1029', '__________, c\'était bref mais intense.', '', 4),
	('B1030', 'Pourquoi j\'ai la main qui colle ?', '', 4),
	('B1031', 'Le fantasme de Robillard', '', 5),
	('B1032', 'La moitié du budget à l\'IMAC passe dans __________', '', 3),
	('B1033', 'Pimentez votre vie sexuelle en amenant __________ dans le lit', '', 2),
	('B1034', 'Qu\'est-ce qui est drôle avant de devenir bizarre ?', '', 2),
	('B1035', 'Pourquoi l\'orgie s\'est-elle brusquement arrêtée ?', '', 4),
	('B1036', 'Les futurs IMACs ne sont pas prêts pour __________', '', 1),
	('B1037', 'C\'est quoi ton mot de passe ? __________ tout attaché', '', 2),
	('B1038', '__________, le film', '', 2),
	('B1039', 'J\'ai toujours donné des noms à mes sextoys, celui-ci s\'appelle __________', '', 4),
	('B1040', 'La gauche va pousser le thème du dialogue social, il faut absolument recentrer le débat sur __________', '', 2),
	('B1041', 'Oui mon fils, Dieu pardonne tout, même __________', '', 5),
	('B1042', 'Quoi de mieux que __________ pour se mettre en haleine', '', 3),
	('B1043', 'Au programme pour l\'IMAC show : __________', '', 1),
	('B1044', 'L\'ensemble du traffic sur la ligne A est interrompu à cause de __________.', '', 3),
	('B1045', 'Qu\'est-ce que je ramenerai dans le passé aux anciens IMACs, pour leur prouver notre supériorité ?', '', 1),
	('B1046', 'Qu\'est-ce que j\'ai ramené d\'Amsterdam ?', '', 1),
	('B1047', 'Qu\'est-ce qui est toujours top pour animer une soirée ?', '', 4),
	('B1048', 'Qu\'est-ce que je vais abandonner pour le Carême ?', '', 2),
	('B1049', 'Les pistes d\'amélioration que je propose pour rendre l\'IMAC meilleure.', '', 3),
	('B1050', 'La première fois c\'est bizarre, mais après on s\'y habitue.', '', 1),
	('B2001', 'Étape 1 : __________ Étape 2 : __________ Étape 3 : Succès et célébrité.', '', 1),
	('B2002', '__________ c\'est comme __________ mais en plus intense.', '', 1),
	('B2003', '__________ + __________ = problème', '', 5),
	('B2004', '__________ ou __________, je choisis bien évidemment la 2e option.', '', 1),
	('W0001', 'Lucas, prof de oueb', '', 1),
	('W0002', 'Robillard qui parle anglais', '', 5),
	('W0003', 'Une chaise musicale dans le ZKM', '', 4),
	('W0004', 'Aller au Mils à 19h pour avoir une place assise', '', 3),
	('W0005', 'Les IMACs qui ont pas fait leur gage', '', 5),
	('W0006', 'Les IMACannes', '', 1),
	('W0007', 'Les cheveux de Jules', '', 4),
	('W0008', 'La chemise de Gérald Robin', '', 5),
	('W0009', 'Orgimac', '', 4),
	('W0010', 'Réviser le signal', '', 3),
	('W0011', 'Les chips des ateliers 803Z', '', 1),
	('W0012', 'Le 48h du court métrage', '', 1),
	('W0013', 'Les 23h de la BD mais pompettes', '', 1),
	('W0014', 'L\'aftermovie du WEI', '', 1),
	('W0015', 'Adhérer au BDE Eiffel', '', 3),
	('W0016', 'Les crêpes de Jules en post-partiel de maths', '', 1),
	('W0017', 'Trois boules, trois trous', '', 2),
	('W0018', 'Keven qui fait une référence à Star Wars', '', 2),
	('W0019', 'Boire un Adios Motha Fucka', '', 1),
	('W0020', 'Mes incroyables skills en dessin sur OpenGL', '', 5),
	('W0021', 'Épeler le nom de famille d\'Eva pour 200€', '', 4),
	('W0022', 'Connaître la signification du sigle UQAT', '', 4),
	('W0023', 'Revenir du Québec avec l\'accent', '', 4),
	('W0024', 'Les pâtes au beurre du WEI', '', 4),
	('W0025', 'Un jeudimac arrosé', '', 1),
	('W0026', 'Arriver en retard au départ groupé', '', 1),
	('W0027', 'Arriver à l\'heure au départ groupé', '', 3),
	('W0028', 'Faire barman à la soirée Mission Hawaii pour son UE d\'ouverture', '', 5),
	('W0029', 'Fabian sur Just Dance', '', 4),
	('W0030', 'Rembourser ses dettes en nature', '', 2),
	('W0031', 'Retransmettre sa frustration sur saltposting', '', 2),
	('W0032', 'La ponctualité de Novelli', '', 5),
	('W0033', 'Se faire verbaliser par la Polizei de Karlsruhe pour tapage nocturne', '', 1),
	('W0034', 'Le photocall du gala', '', 2),
	('W0035', 'La soutenance du projet tuteuré', '', 2),
	('W0036', 'La danse du WEI', '', 1),
	('W0037', 'Le crâne luisant de Venceslas', '', 5),
	('W0038', 'Les meilleurs blagues de Zoé', '', 5),
	('W0039', 'Chanter l\'IMAC du sale en allemand', '', 2),
	('W0040', 'Envoyer des crêpes par Post-IMAC', '', 1),
	('W0041', 'Une valse avec Laporte', '', 5),
	('W0042', 'Mes talents incontestés en développements limités', '', 2),
	('W0043', 'Mes aptitudes de tri par insertion', '', 4),
	('W0044', 'Un snap de Mattéo', '', 5),
	('W0045', 'Templier qui nous respecte', '', 5),
	('W0046', 'Le micro d\'Émilie Verger', '', 5),
	('W0047', 'Réviser le CIP', '', 3),
	('W0048', 'L\'ingénierie créative', '', 1),
	('W0049', 'Le coronavirus', '', 3),
	('W0050', 'Citatimac', '', 1),
	('W0051', 'Les cabats du CROUS', '', 2),
	('W0052', 'La caisse centrale du RU, paiement uniquement par IZLY', '', 4),
	('W0053', 'Une soirée karaoké raclette', '', 1),
	('W0054', 'Une séance recette pompette avec Luc', '', 1),
	('W0055', 'Le plan boule', '', 4),
	('W0056', 'Gaëtan', '', 5),
	('W0057', 'Une sortie obligatoire le dimanche aprem', '', 3),
	('W0058', 'L\'alcoolisme', '', 2),
	('W0059', 'Ma sobriété', '', 3),
	('W0060', 'La collection de memes en ma défaveur', '', 3),
	('W0061', 'Ma réappropriation à base de pâte à sel', '', 1),
	('W0062', 'La communication à l\'IMAC', '', 3),
	('W0063', 'Le magicien du CROUS qui fait disparaître mon nez', '', 4),
	('W0064', 'Mes entraînements Voltaire orthotypographiques', '', 5),
	('W0065', 'Mes facultés en intégration par parties', '', 5),
	('W0066', 'Mes burnouts récursifs', '', 1),
	('W0067', 'L\'apéro-race du vendredi post-4h-de-Novelli', '', 1),
	('W0068', 'Jérémi Delaire :\'(', '', 5),
	('W0069', 'La crucifixion par le Signal', '', 4),
	('W0070', 'Un octogone entre Robillard et une girafe', '', 5),
	('W0071', 'Mon abstinence en IMAC2', '', 4),
	('W0072', 'L\'assistant Voltaire', '', 2),
	('W0073', 'Les larmes des IMACs 2', '', 2),
	('W0074', '03bèz', '', 4);
/*!40000 ALTER TABLE `card` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `had` (
  `id_room` int(11) NOT NULL,
  `id_card` char(5) NOT NULL,
  PRIMARY KEY (`id_room`,`id_card`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `had` DISABLE KEYS */;
/*!40000 ALTER TABLE `had` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `handcard` (
  `id_room` int(11) NOT NULL,
  `pname` varchar(50) NOT NULL,
  `id_card` char(5) NOT NULL,
  `isSelected` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_room`,`id_card`,`pname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `handcard` DISABLE KEYS */;
/*!40000 ALTER TABLE `handcard` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `pack` (
  `id_pack` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `pname` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pack`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `pack` DISABLE KEYS */;
INSERT INTO `pack` (`id_pack`, `name`, `pname`) VALUES
	(1, 'IMAC Vie', NULL),
	(2, 'Pouloulou', NULL),
	(3, 'Le Sel Pack', NULL),
	(4, 'Damn boi', NULL),
	(5, 'Trashtalk', NULL);
/*!40000 ALTER TABLE `pack` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `pin` (
  `pname` varchar(50) NOT NULL,
  `id_pack` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pname`,`id_pack`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `pin` DISABLE KEYS */;
/*!40000 ALTER TABLE `pin` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `player` (
  `pname` varchar(50) NOT NULL,
  `pass` varchar(60) NOT NULL,
  `color` char(6) DEFAULT NULL,
  `token` char(7) DEFAULT NULL,
  `winCount` int(11) NOT NULL DEFAULT '0',
  `roomPoints` int(11) NOT NULL DEFAULT '0',
  `isReady` tinyint(1) NOT NULL DEFAULT '0',
  `isGameMaster` tinyint(1) NOT NULL DEFAULT '0',
  `hasPlayed` tinyint(1) NOT NULL DEFAULT '0',
  `hasWon` tinyint(1) NOT NULL DEFAULT '0',
  `lastPing` datetime DEFAULT NULL,
  `id_room` int(11) DEFAULT NULL,
  PRIMARY KEY (`pname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `player` DISABLE KEYS */;
INSERT INTO `player` (`pname`, `pass`, `color`, `token`, `winCount`, `roomPoints`, `isReady`, `isGameMaster`, `hasPlayed`, `hasWon`, `lastPing`, `id_room`) VALUES
	('GotchiT', '$2y$10$yIhOMvbtDQ4BEf0hiv.aj.HVJ7fcip/TnhznwzFx3llIIJNzZ2V6S', 'aa55dd', 's0PRe@G', 0, 0, 0, 0, 0, 0, NULL, NULL),
	('Kysios', '$2y$10$FOFjUzZ6V5Xy4Mnps0IkMOdewnulBp9d8v3/JPpGKiX5H9WVCJJdG', '25e483', 'QDJMJV$', 0, 0, 0, 0, 0, 0, NULL, NULL),
	('PandaDesSteppes', '$2y$10$Sgj0UZI2oEhe575hbwdD9uKcsk/jfaav28hwGTpuvaw4HJhVR9mVO', 'e6b021', 'v8VW2NY', 0, 0, 0, 0, 0, 0, '2020-05-01 18:11:08', 1),
	('pepe', '$2y$10$nlU9arR24fc9dUvnUoKymeecSykXDKAr6i3VqcswkO4x8/58VvqRW', '21a8ee', 'IYfqWyM', 0, 0, 0, 0, 0, 0, NULL, NULL);
/*!40000 ALTER TABLE `player` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `room` (
  `id_room` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` enum('STANDBY','PLAYING_ROUND','END_ROUND','CELEBRATION') NOT NULL DEFAULT 'STANDBY',
  `roundCount` int(11) NOT NULL DEFAULT '1',
  `roundCountMax` int(11) NOT NULL DEFAULT '15',
  `pingTimeOut` int(11) NOT NULL DEFAULT '6',
  `roundDuration` int(11) NOT NULL DEFAULT '45',
  `endRoundDuration` int(11) NOT NULL DEFAULT '8',
  `lastRoundStart` timestamp NULL DEFAULT NULL,
  `lastRoundEnd` timestamp NULL DEFAULT NULL,
  `id_card` char(5) DEFAULT NULL,
  PRIMARY KEY (`id_room`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` (`id_room`, `name`, `status`, `roundCount`, `roundCountMax`, `pingTimeOut`, `roundDuration`, `endRoundDuration`, `lastRoundStart`, `lastRoundEnd`, `id_card`) VALUES
	(1, 'Protool', 'STANDBY', 1, 15, 6, 45, 8, NULL, NULL, NULL);
/*!40000 ALTER TABLE `room` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `use` (
  `id_room` int(11) NOT NULL,
  `id_pack` int(11) NOT NULL,
  PRIMARY KEY (`id_room`,`id_pack`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `use` DISABLE KEYS */;
/*!40000 ALTER TABLE `use` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE TABLE IF NOT EXISTS `card` (
  `id_card` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pack` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_card`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `card` DISABLE KEYS */;
INSERT INTO `card` (`id_card`, `content`, `id_pack`) VALUES
	('B100001', 'Pourquoi le dernier jeudimac m\'a traumatisé AH', 1),
	('B100002', 'Le plaisir coupable de Gérald Robin.', 1),
	('B100003', '50% des jeudimacs finissent par __________.', 1),
	('B100004', 'La médecine alternative loue, désormais, les bienfaits de __________.', 1),
	('B100005', '80% des IMACs+ sont traumatisés par __________.', 1),
	('B100006', 'Comment j\'ai perdu ma virginité ?', 1),
	('B100007', 'Crime contre l\'humanité.', 1),
	('B100008', 'On l\'attend depuis plus de 5 mois.', 1),
	('B100009', 'Ma raison de vivre ?', 1),
	('B100010', 'Le superpouvoir de Cherrier ?', 1),
	('B100011', 'Ce qui nous redonne TOUS foi en l\'humanité.', 1),
	('B100012', 'Pourquoi je pécho pas ? Parce que __________', 1),
	('B100013', 'Mais avant de vous tuer, M. Bond, laissez-moi vous montrer __________.', 1),
	('B100014', 'L\'histoire de ma vie ?', 1),
	('B100015', 'Je m\'en lasserai jamais.', 1),
	('B100016', '__________ ? Impossible.', 1),
	('B100017', 'J\'échangerai ma mère contre __________', 1),
	('B100018', '__________ : testé par les IMACs, approuvé par Cherrier', 1),
	('B100019', 'Ce dont je rêve depuis bien trop longtemps ?', 1),
	('B100020', '__________. Ca c\'est IMAC', 1),
	('B100021', 'Qu\'est-ce qui me donne toujours des gaz ?', 1),
	('B100022', '__________ peut détruire la réputation de l\'IMAC à jamais', 1),
	('B100023', 'Boire pour oublier __________', 1),
	('B100024', 'La science démontre que __________ a soigné les IMACs d\'une profonde dépression', 1),
	('B100025', 'Ce que j\'ai en tête pendant le coït', 1),
	('B100026', '__________ en slip, sah quel plaisir !', 1),
	('B100027', 'Cette idée révolutionnaire va boulverser le monde.', 1),
	('B100028', 'Rien ne vaut __________ mais à poil', 1),
	('B100029', '__________, c\'était bref mais intense.', 1),
	('B100030', 'Pourquoi j\'ai la main qui colle ?', 1),
	('B100031', 'Le fantasme de Robillard', 1),
	('B100032', 'La moitié du budget à l\'IMAC passe dans __________', 1),
	('B100033', 'Pimentez votre vie sexuelle en amenant __________ dans le lit', 1),
	('B100034', 'Qu\'est-ce qui est drôle avant de devenir bizarre ?', 1),
	('B100035', 'Pourquoi l\'orgie s\'est-elle brusquement arrêtée ?', 1),
	('B100036', 'Les futurs IMACs ne sont pas prêts pour __________', 1),
	('B100037', 'C\'est quoi ton mot de passe ? __________ tout attaché', 1),
	('B100038', '__________, le film', 1),
	('B100039', 'J\'ai toujours donné des noms à mes sextoys, celui-ci s\'appelle __________', 1),
	('B100040', 'La gauche va pousser le thème du dialogue social, il faut absolument recentrer le débat sur __________', 1),
	('B100041', 'Oui mon fils, Dieu pardonne tout, même __________', 1),
	('B100042', 'Quoi de mieux que __________ pour se mettre en haleine', 1),
	('B100043', 'Au programme pour l\'IMAC show : __________', 1),
	('B100044', 'L\'ensemble du traffic sur la ligne A est interrompu à cause de __________.', 1),
	('B100045', 'Qu\'est-ce que je ramenerai dans le passé aux anciens IMACs, pour leur prouver notre supériorité ?', 1),
	('B100046', 'Qu\'est-ce que j\'ai ramené d\'Amsterdam ?', 1),
	('B100047', 'Qu\'est-ce qui est toujours top pour animer une soirée ?', 1),
	('B100048', 'Qu\'est-ce que je vais abandonner pour le Carême ?', 1),
	('B100049', 'Les pistes d\'amélioration que je propose pour rendre l\'IMAC meilleure.', 1),
	('B100050', 'La première fois c\'est bizarre, mais après on s\'y habitue.', 1),
	('B200001', 'Étape 1 : __________ Étape 2 : __________ Étape 3 : Succès et célébrité.', 1),
	('B200002', '__________ c\'est comme __________ mais en plus intense.', 1),
	('B200003', '__________ + __________ = problème', 1),
	('B200004', '__________ ou __________, je choisis bien évidemment la 2e option.', 1),
	('W000001', 'Lucas, prof de oueb', 1),
	('W000002', 'Robillard qui parle anglais', 1),
	('W000003', 'Une chaise musicale dans le ZKM', 1),
	('W000004', 'Aller au Mils à 19h pour avoir une place assise', 1),
	('W000005', 'Les IMACs qui ont pas fait leur gage', 1),
	('W000006', 'Les IMACannes', 1),
	('W000007', 'Les cheveux de Jules', 1),
	('W000008', 'La chemise de Gérald Robin', 1),
	('W000009', 'Orgimac', 1),
	('W000010', 'Réviser le signal', 1),
	('W000011', 'Les chips des ateliers 803Z', 1),
	('W000012', 'Le 48h du court métrage', 1),
	('W000013', 'Les 23h de la BD mais pompettes', 1),
	('W000014', 'L\'aftermovie du WEI', 1),
	('W000015', 'Adhérer au BDE Eiffel', 1),
	('W000016', 'Les crêpes de Jules en post-partiel de maths', 1),
	('W000017', 'Trois boules, trois trous', 1),
	('W000018', 'Keven qui fait une référence à Star Wars', 1),
	('W000019', 'Boire un Adios Motha Fucka', 1),
	('W000020', 'Mes incroyables skills en dessin sur OpenGL', 1),
	('W000021', 'Épeler le nom de famille d\'Eva pour 200€', 1),
	('W000022', 'Connaître la signification du sigle UQAT', 1),
	('W000023', 'Revenir du Québec avec l\'accent', 1),
	('W000024', 'Les pâtes au beurre du WEI', 1),
	('W000025', 'Un jeudimac arrosé', 1),
	('W000026', 'Arriver en retard au départ groupé', 1),
	('W000027', 'Arriver à l\'heure au départ groupé', 1),
	('W000028', 'Faire barman à la soirée Mission Hawaii pour son UE d\'ouverture', 1),
	('W000029', 'Fabian sur Just Dance', 1),
	('W000030', 'Rembourser ses dettes en nature', 1),
	('W000031', 'Retransmettre sa frustration sur saltposting', 1),
	('W000032', 'La ponctualité de Novelli', 1),
	('W000033', 'Se faire verbaliser par la Polizei de Karlsruhe pour tapage nocturne', 1),
	('W000034', 'Le photocall du gala', 1),
	('W000035', 'La soutenance du projet tuteuré', 1),
	('W000036', 'La danse du WEI', 1),
	('W000037', 'Le crâne luisant de Venceslas', 1),
	('W000038', 'Les meilleurs blagues de Zoé', 1),
	('W000039', 'Chanter l\'IMAC du sale en allemand', 1),
	('W000040', 'Envoyer des crêpes par Post-IMAC', 1),
	('W000041', 'Une valse avec Laporte', 1),
	('W000042', 'Mes talents incontestés en développements limités', 1),
	('W000043', 'Mes aptitudes de tri par insertion', 1),
	('W000044', 'Un snap de Mattéo', 1),
	('W000045', 'Templier qui nous respecte', 1),
	('W000046', 'Le micro d\'Émilie Verger', 1),
	('W000047', 'Réviser le CIP', 1),
	('W000048', 'L\'ingénierie créative', 1),
	('W000049', 'Le coronavirus', 1),
	('W000050', 'Citatimac', 1),
	('W000051', 'Les cabats du CROUS', 1),
	('W000052', 'La caisse centrale du RU, paiement uniquement par IZLY', 1),
	('W000053', 'Une soirée karaoké raclette', 1),
	('W000054', 'Une séance recette pompette avec Luc', 1),
	('W000055', 'Le plan boule', 1),
	('W000056', 'Gaëtan', 1),
	('W000057', 'Une sortie obligatoire le dimanche aprem', 1),
	('W000058', 'L\'alcoolisme', 1),
	('W000059', 'Ma sobriété', 1),
	('W000060', 'La collection de memes en ma défaveur', 1),
	('W000061', 'Ma réappropriation à base de pâte à sel', 1),
	('W000062', 'La communication à l\'IMAC', 1),
	('W000063', 'Le magicien du CROUS qui fait disparaître mon nez', 1),
	('W000064', 'Mes entraînements Voltaire orthotypographiques', 1),
	('W000065', 'Mes facultés en intégration par parties', 1),
	('W000066', 'Mes burnouts récursifs', 1),
	('W000067', 'L\'apéro-race du vendredi post-4h-de-Novelli', 1),
	('W000068', 'Jérémi Delaire 😥', 1),
	('W000069', 'La crucifixion par le Signal', 1),
	('W000070', 'Un octogone entre Robillard et une girafe', 1),
	('W000071', 'Mon abstinence en IMAC2', 1),
	('W000072', 'L\'assistant Voltaire', 1),
	('W000073', 'Les larmes des IMACs 2', 1),
	('W000074', '03bèz', 1);
/*!40000 ALTER TABLE `card` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `had` (
  `id_room` int(11) NOT NULL,
  `id_card` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_room`,`id_card`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `had` DISABLE KEYS */;
/*!40000 ALTER TABLE `had` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `handcard` (
  `id_room` int(11) NOT NULL,
  `pname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_card` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isSelected` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_room`,`id_card`,`pname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `handcard` DISABLE KEYS */;
/*!40000 ALTER TABLE `handcard` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `pack` (
  `id_pack` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_pack`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `pack` DISABLE KEYS */;
INSERT INTO `pack` (`id_pack`, `name`) VALUES
	(1, 'IMAC Vie');
/*!40000 ALTER TABLE `pack` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `player` (
  `pname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` char(6) COLLATE utf8mb4_unicode_ci DEFAULT 'eae5eb',
  `token` char(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_pack` int(11) DEFAULT NULL,
  `winCount` int(11) NOT NULL DEFAULT '0',
  `roomPoints` int(11) NOT NULL DEFAULT '0',
  `isReady` tinyint(1) NOT NULL DEFAULT '0',
  `isGameMaster` tinyint(1) NOT NULL DEFAULT '0',
  `hasPlayed` tinyint(1) NOT NULL DEFAULT '0',
  `hasWon` tinyint(1) NOT NULL DEFAULT '0',
  `lastPing` datetime DEFAULT NULL,
  `lastActivity` datetime DEFAULT NULL,
  `id_room` int(11) DEFAULT NULL,
  PRIMARY KEY (`pname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `player` DISABLE KEYS */;
INSERT INTO `player` (`pname`, `pass`, `color`, `token`, `id_pack`, `winCount`, `roomPoints`, `isReady`, `isGameMaster`, `hasPlayed`, `hasWon`, `lastPing`, `lastActivity`, `id_room`) VALUES
	('GotchiT', '$2y$10$yIhOMvbtDQ4BEf0hiv.aj.HVJ7fcip/TnhznwzFx3llIIJNzZ2V6S', '0df872', 'LrjvVWI', NULL, 0, 0, 0, 0, 0, 0, NULL, '2020-05-08 21:11:38', NULL),
	('Kysios', '$2y$10$FOFjUzZ6V5Xy4Mnps0IkMOdewnulBp9d8v3/JPpGKiX5H9WVCJJdG', 'f91f1f', 'J8T@nBm', NULL, 0, 0, 0, 0, 0, 0, NULL, '2020-05-08 21:11:40', NULL),
	('PandaDesSteppes', '$2y$10$Sgj0UZI2oEhe575hbwdD9uKcsk/jfaav28hwGTpuvaw4HJhVR9mVO', '4eefde', '8YopV@W', NULL, 0, 0, 0, 0, 0, 0, NULL, '2020-05-08 21:11:39', NULL),
	('pepe', '$2y$10$nlU9arR24fc9dUvnUoKymeecSykXDKAr6i3VqcswkO4x8/58VvqRW', '21a8ee', 'wAN7OW7', NULL, 0, 0, 0, 0, 0, 0, NULL, '2020-05-08 21:11:41', NULL);
/*!40000 ALTER TABLE `player` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `room` (
  `id_room` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('STANDBY','PLAYING_ROUND','END_ROUND','CELEBRATION') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'STANDBY',
  `isStatusLocked` tinyint(1) NOT NULL DEFAULT '0',
  `roundCount` int(11) NOT NULL DEFAULT '0',
  `roundCountMax` int(11) NOT NULL DEFAULT '10',
  `pingTimeOut` int(11) NOT NULL DEFAULT '6',
  `roundDuration` int(11) NOT NULL DEFAULT '45',
  `celebrationDuration` int(11) NOT NULL DEFAULT '6',
  `lastRoundStart` timestamp NULL DEFAULT NULL,
  `lastRoundEnd` timestamp NULL DEFAULT NULL,
  `id_card` char(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_room`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `room` DISABLE KEYS */;
/*!40000 ALTER TABLE `room` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `use` (
  `id_room` int(11) NOT NULL,
  `id_pack` int(11) NOT NULL,
  PRIMARY KEY (`id_room`,`id_pack`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `use` DISABLE KEYS */;
/*!40000 ALTER TABLE `use` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

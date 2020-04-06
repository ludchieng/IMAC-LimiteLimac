/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE TABLE IF NOT EXISTS `card` (
  `id_card` char(5) NOT NULL,
  `content` varchar(255) NOT NULL,
  PRIMARY KEY (`id_card`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `card` DISABLE KEYS */;
INSERT INTO `card` (`id_card`, `content`) VALUES
	('B1001', 'Pourquoi le dernier jeudimac m\'a traumatisé'),
	('B1002', 'Le plaisir coupable de Gérald Robin.'),
	('B1003', '50% des jeudimacs finissent par __________.'),
	('B1004', 'La médecine alternative loue, désormais, les bienfaits de __________.'),
	('B1005', '80% des IMACs+ sont traumatisés par __________.'),
	('B1006', 'Comment j\'ai perdu ma virginité ?'),
	('B1007', 'Crime contre l\'humanité.'),
	('B1008', 'On l\'attend depuis plus de 5 mois.'),
	('B1009', 'Ma raison de vivre ?'),
	('B1010', 'Le superpouvoir de Cherrier ?'),
	('B1011', 'Ce qui nous redonne TOUS foi en l\'humanité.'),
	('B1012', 'Pourquoi je pécho pas ? Parce que __________'),
	('B1013', 'Mais avant de vous tuer, M. Bond, laissez-moi vous montrer __________.'),
	('B1014', 'L\'histoire de ma vie ?'),
	('B1015', 'Je m\'en lasserai jamais.'),
	('B1016', '__________ ? Impossible.'),
	('B1017', 'J\'échangerai ma mère contre __________'),
	('B1018', '__________ : testé par les IMACs, approuvé par Cherrier'),
	('B1019', 'Ce dont je rêve depuis bien trop longtemps ?'),
	('B1020', '__________. Ca c\'est IMAC'),
	('B1021', 'Qu\'est-ce qui me donne toujours des gaz ?'),
	('B1022', '__________ peut détruire la réputation de l\'IMAC à jamais'),
	('B1023', 'Boire pour oublier __________'),
	('B1024', 'La science démontre que __________ a soigné les IMACs d\'une profonde dépression'),
	('B1025', 'Ce que j\'ai en tête pendant le coït'),
	('B1026', '__________ en slip, sah quel plaisir !'),
	('B1027', 'Cette idée révolutionnaire va boulverser le monde.'),
	('B1028', 'Rien ne vaut __________ mais à poil'),
	('B1029', '__________, c\'était bref mais intense.'),
	('B1030', 'Pourquoi j\'ai la main qui colle ?'),
	('B1031', 'Le fantasme de Robillard'),
	('B1032', 'La moitié du budget à l\'IMAC passe dans __________'),
	('B1033', 'Pimentez votre vie sexuelle en amenant __________ dans le lit'),
	('B1034', 'Qu\'est-ce qui est drôle avant de devenir bizarre ?'),
	('B1035', 'Pourquoi l\'orgie s\'est-elle brusquement arrêtée ?'),
	('B1036', 'Les futurs IMACs ne sont pas prêts pour __________'),
	('B1037', 'C\'est quoi ton mot de passe ? __________ tout attaché'),
	('B1038', '__________, le film'),
	('B1039', 'J\'ai toujours donné des noms à mes sextoys, celui-ci s\'appelle __________'),
	('B1040', 'La gauche va pousser le thème du dialogue social, il faut absolument recentrer le débat sur __________'),
	('B1041', 'Oui mon fils, Dieu pardonne tout, même __________'),
	('B1042', 'Quoi de mieux que __________ pour se mettre en haleine'),
	('B1043', 'Au programme pour l\'IMAC show : __________'),
	('B1044', 'L\'ensemble du traffic sur la ligne A est interrompu à cause de __________.'),
	('B1045', 'Qu\'est-ce que je ramenerai dans le passé aux anciens IMACs, pour leur prouver notre supériorité ?'),
	('B1046', 'Qu\'est-ce que j\'ai ramené d\'Amsterdam ?'),
	('B1047', 'Qu\'est-ce qui est toujours top pour animer une soirée ?'),
	('B1048', 'Qu\'est-ce que je vais abandonner pour le Carême ?'),
	('B1049', 'Les pistes d\'amélioration que je propose pour rendre l\'IMAC meilleure.'),
	('B1050', 'La première fois c\'est bizarre, mais après on s\'y habitue.'),
	('B2001', 'Étape 1 : __________ Étape 2 : __________ Étape 3 : Succès et célébrité.'),
	('B2002', '__________ c\'est comme __________ mais en plus intense.'),
	('B2003', '__________ + __________ = problème'),
	('B2004', '__________ ou __________, je choisis bien évidemment la 2e option.'),
	('W0001', 'Lucas, prof de oueb'),
	('W0002', 'Robillard qui parle anglais'),
	('W0003', 'une chaise musicale dans le ZKM'),
	('W0004', 'aller au Mils à 19h pour avoir une place assise'),
	('W0005', 'les IMACs qui ont pas fait leur gage'),
	('W0006', 'les IMACannes'),
	('W0007', 'les cheveux de Jules'),
	('W0008', 'la chemise de Gérald Robin'),
	('W0009', 'Orgimac'),
	('W0010', 'réviser le signal'),
	('W0011', 'les chips des ateliers 803Z'),
	('W0012', 'le 48h du court métrage'),
	('W0013', 'les 23h de la BD mais pompettes'),
	('W0014', 'l\'aftermovie du WEI'),
	('W0015', 'adhérer au BDE Eiffel'),
	('W0016', 'les crêpes de Jules en post-partiel de maths'),
	('W0017', 'Trois boules, trois trous'),
	('W0018', 'Keven qui fait une référence à Star Wars'),
	('W0019', 'Boire un Adios Motha Fucka'),
	('W0020', 'Mes incroyables skills en dessin sur OpenGL'),
	('W0021', 'Épeler le nom de famille d\'Eva pour 200â‚¬'),
	('W0022', 'Connaître la signification du sigle UQAT'),
	('W0023', 'Revenir du Québec avec l\'accent'),
	('W0024', 'les pâtes au beurre du WEI'),
	('W0025', 'un jeudimac arrosé'),
	('W0026', 'arriver en retard au départ groupé'),
	('W0027', 'arriver à l\'heure au départ groupé'),
	('W0028', 'faire barman à la soirée Mission Hawaii pour son UE d\'ouverture'),
	('W0029', 'Fabian sur Just Dance'),
	('W0030', 'rembourser ses dettes en nature'),
	('W0031', 'retransmettre sa frustration sur saltposting'),
	('W0032', 'la ponctualité de Novelli'),
	('W0033', 'se faire verbaliser par la Polizei de Karlsruhe pour tapage nocturne'),
	('W0034', 'le photocall du gala'),
	('W0035', 'la soutenance du projet tuteuré'),
	('W0036', 'la danse du WEI'),
	('W0037', 'le crâne luisant de Venceslas'),
	('W0038', 'les meilleurs blagues de Zoé'),
	('W0039', 'Chanter l\'IMAC du sale en allemand'),
	('W0040', 'Envoyer des crêpes par Post-IMAC'),
	('W0041', 'Une valse avec Laporte'),
	('W0042', 'Mes talents incontestés en développements limités'),
	('W0043', 'Mes aptitudes de tri par insertion'),
	('W0044', 'Un snap de Mattéo'),
	('W0045', 'Templier qui nous respecte'),
	('W0046', 'Le micro d\'Émilie Verger'),
	('W0047', 'réviser le CIP'),
	('W0048', 'l\'ingénierie créative'),
	('W0049', 'le coronavirus'),
	('W0050', 'Maxime sur Citatimac'),
	('W0051', 'les cabats du CROUS'),
	('W0052', 'la caisse centrale du RU, paiement uniquement par IZLY'),
	('W0053', 'Une soirée karaoké raclette'),
	('W0054', 'Une séance recette pompette avec Luc'),
	('W0055', 'le plan boule'),
	('W0056', 'la crédibilité de Gaëtan'),
	('W0057', 'Une sortie obligatoire le dimanche aprem'),
	('W0058', 'L\'alcoolisme'),
	('W0059', 'Ma sobriété'),
	('W0060', 'la collection de memes en ma défaveur'),
	('W0061', 'ma réappropriation à base de pâte à sel'),
	('W0062', 'la communication à l\'IMAC'),
	('W0063', 'le magicien du CROUS qui fait disparaître mon nez'),
	('W0064', 'Mes entraînements Voltaire orthotypographiques'),
	('W0065', 'Mes facultés en intégration par parties'),
	('W0066', 'Mes burnouts récursifs'),
	('W0067', 'L\'apéro-race du vendredi post-4h-de-Novelli'),
	('W0068', 'Jérémi Delaire :\'('),
	('W0069', 'La crucifixion par le Signal'),
	('W0070', 'un octogone entre Robillard et une girafe'),
	('W0071', 'mon abstinence en IMAC2'),
	('W0072', 'l\'assistant Voltaire'),
	('W0073', 'les larmes des IMACs 2'),
	('W0074', '03bèz');
/*!40000 ALTER TABLE `card` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `party` (
  `id_party` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `id_card` char(5) DEFAULT NULL,
  PRIMARY KEY (`id_party`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `party` DISABLE KEYS */;
INSERT INTO `party` (`id_party`, `name`, `id_card`) VALUES
	(1, 'Salon du sale', 'B1005'),
	(2, 'Carré VIP', 'B1007'),
	(3, 'Milsolodéon', 'B2002');
/*!40000 ALTER TABLE `party` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `player` (
  `id_player` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `pass` varchar(60) NOT NULL,
  `token` char(24) DEFAULT NULL,
  `isReady` tinyint(1) DEFAULT '0',
  `lastPing` datetime DEFAULT NULL,
  `id_party` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_player`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `player` DISABLE KEYS */;
INSERT INTO `player` (`id_player`, `name`, `pass`, `token`, `isReady`, `lastPing`, `id_party`) VALUES
	(1, 'GotchiT', '$2y$10$r7dpZ6MqFZjE3J9xL4Djiu.oQggrI9wurJAJd9VIDhODHMc2Iuf9.', 'vf5j5pn14PkCy8WFRGayuDhq', 0, NULL, 1),
	(2, 'PandaDesSteppes', '$2y$10$Sgj0UZI2oEhe575hbwdD9uKcsk/jfaav28hwGTpuvaw4HJhVR9mVO', 'OR2$a34iVAA0lzEb2kYPcsTk', 0, NULL, 2),
	(3, 'Kysios', '$2y$10$FOFjUzZ6V5Xy4Mnps0IkMOdewnulBp9d8v3/JPpGKiX5H9WVCJJdG', 'puxLtJe1GcYM6YFJK#JstraC', 0, NULL, 1);
/*!40000 ALTER TABLE `player` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `posseder` (
  `id_player` int(11) NOT NULL,
  `id_card` char(5) NOT NULL,
  `isSelected` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_player`,`id_card`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `posseder` DISABLE KEYS */;
INSERT INTO `posseder` (`id_player`, `id_card`, `isSelected`) VALUES
	(1, 'W0005', 0),
	(1, 'W0006', 0),
	(1, 'W0007', 0),
	(1, 'W0008', 0),
	(1, 'W0009', 0),
	(1, 'W0010', 0),
	(2, 'W0011', 0),
	(2, 'W0012', 0),
	(2, 'W0013', 0),
	(2, 'W0014', 0),
	(2, 'W0015', 0),
	(2, 'W0016', 0),
	(3, 'W0017', 0),
	(3, 'W0018', 0),
	(3, 'W0019', 0),
	(3, 'W0020', 0),
	(3, 'W0021', 0),
	(3, 'W0022', 0);
/*!40000 ALTER TABLE `posseder` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

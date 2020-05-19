-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: ventealaferme
-- ------------------------------------------------------
-- Server version	5.7.24-0ubuntu0.18.10.1-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `farmer_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `rating` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526C13481D2B` (`farmer_id`),
  KEY `IDX_9474526CF675F31B` (`author_id`),
  CONSTRAINT `FK_9474526C13481D2B` FOREIGN KEY (`farmer_id`) REFERENCES `farmer` (`id`),
  CONSTRAINT `FK_9474526CF675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (54,28,51,'2019-01-18 11:47:54',5,'formidable'),(55,25,51,'2019-01-18 11:49:07',5,'parfait'),(56,25,51,'2019-01-18 11:52:56',5,'parfait'),(57,25,51,'2019-01-18 11:53:38',5,'parfait'),(58,25,51,'2019-01-18 11:54:08',5,'parfait'),(59,26,51,'2019-01-18 14:00:08',5,'Super');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consumer`
--

DROP TABLE IF EXISTS `consumer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consumer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `profil_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_705B3727A76ED395` (`user_id`),
  CONSTRAINT `FK_705B3727A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consumer`
--

LOCK TABLES `consumer` WRITE;
/*!40000 ALTER TABLE `consumer` DISABLE KEYS */;
INSERT INTO `consumer` VALUES (1,21,'joubert.christophe','24, boulevard de Perret\n23893 Alves','26520','Guillet-sur-Charrier',NULL,NULL),(2,22,'qdenis','chemin Alice Poirier\n88 109 Gilbert','55687','Aubertboeuf',NULL,NULL),(3,23,'colin.jules','384, chemin de Gomez\n62429 Fleury','22830','Normand-les-Bains',NULL,NULL),(4,24,'martin23','95, rue Victoire Bouvet\n01 614 Marty','43464','Pereira',NULL,NULL),(5,25,'thibaut.fouquet','32, place Bertrand Valentin\n00845 Evrard-les-Bains','12825','Leroynec',NULL,NULL),(6,26,'luce11','13, rue de Pires\n29502 Gosselin','74439','Hebert-la-Forêt',NULL,NULL),(7,27,'luce62','boulevard Foucher\n29 895 Pereira-sur-Berger','38811','Garniernec',NULL,NULL),(8,28,'besson.luc','15, impasse Adélaïde Sanchez\n76 055 Paul','51016','Texier-sur-Pinto',NULL,NULL),(9,29,'bgimenez','impasse Dominique Tessier\n42 008 Etienne-sur-Imbert','23852','LeroyBourg',NULL,NULL),(10,30,'ogay','29, chemin Jacqueline Maury\n07424 Meyer-la-Forêt','43026','Lambertboeuf',NULL,NULL),(11,31,'athomas','921, boulevard Bigot\n61945 Colas','59696','Munoz-la-Forêt',NULL,NULL),(12,32,'benoit.toussaint','rue de Hardy\n62380 Martel','23738','Chartier',NULL,NULL),(13,33,'tristan.millet','18, rue Hebert\n66383 Chevallier','46063','Maceboeuf',NULL,NULL),(14,34,'olivier42','222, impasse Rousset\n54 283 ImbertVille','18776','Michaud',NULL,NULL),(15,35,'jcharrier','46, boulevard Agathe Duval\n12216 Leleuboeuf','68699','Marechal',NULL,NULL),(16,36,'ibenoit','boulevard Anastasie Gimenez\n24528 Bertin','68479','GilletBourg',NULL,NULL),(17,37,'emile.bailly','19, impasse de Guillou\n38 056 Techer-sur-Coste','80351','MartineauVille',NULL,NULL),(18,38,'georges.tessier','66, impasse de Maillet\n40 780 Bourdon-sur-Rousseau','59431','Le Gallnec',NULL,NULL),(19,39,'eugene27','1, rue Margaret Fouquet\n42 188 Riou','43305','Lefort',NULL,NULL),(20,40,'jacqueline88','93, place Lucas Moreau\n01 165 Daniel','76756','Boutin-la-Forêt',NULL,NULL),(22,51,'patrick','fwjekfb','26200','kdfjlrg',NULL,NULL);
/*!40000 ALTER TABLE `consumer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farmer`
--

DROP TABLE IF EXISTS `farmer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `farmer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `farm_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `farm_description` longtext COLLATE utf8mb4_unicode_ci,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_profil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_farm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedule` longtext COLLATE utf8mb4_unicode_ci,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_EC85AC8FA76ED395` (`user_id`),
  CONSTRAINT `FK_EC85AC8FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farmer`
--

LOCK TABLES `farmer` WRITE;
/*!40000 ALTER TABLE `farmer` DISABLE KEYS */;
INSERT INTO `farmer` VALUES (21,43,'84 Route du Bouleau, Brindas, Auvergne-Rhône-Alpes, France','69126','Brindas','earl Ferme de Montplaisir','Bienvenue sur le site de la \"Ferme de Montplaisir\"\r\n\r\nSituée sur la commune de Brindas dans un écrin de verdure, la Ferme de Montplaisir fait partie des exploitations agricoles périurbaines de l\'ouest lyonnais.\r\nAdresse : 84 route du bouleau 69126 BRINDAS.\r\n\r\nL\'origine de cette propriété surmontée d\'une magnifique bâtisse remonte à 1526, mais la construction de la ferme et une profonde réhabilitation de l\'existant ont été réalisées entre 1850 et 1870 avec une nette influence italienne.\r\n\r\n- 1953 Paul et Josette GRILLON viennent s\'installer en polyculture élevage.\r\n\r\n- Dès 1959 ils seront les pionniers de la vente directe, pour permettre une plus value aux produits et satisfaire une clientèle de proximité.\r\n\r\n- 1976 leur fils Bruno et son épouse Alice les rejoignent en GAEC (Groupement Agricole d\'Exploitation Commun) pour développer la production, la transformation, la distribution, en y ajoutant une activité d\'agrotourisme.\r\n\r\n- 2003 cessation de l\'activité laitière, mise en place d\'un atelier viande avec les productions de : bovins, ovins, porcs et volailles. Toute la production est transformée et distribuée sur place avec un espace de vente où l\'on trouve aussi d\'autres produits de notre terroir (produits laitiers, vins, fruits glaces...)\r\n\r\n- 2011 construction d\'une EARL (société agricole) avec l\'installation d\'Alexis JACQUIER dans l\'optique de continuer et de développer une agriculture biologique.\r\nDès cette année les terrains ont été homologués en Agriculture Biologique, l\'objectif étant d\'envisager une conversion pour nos différentes productions. \r\n\r\n- 2014 la vente de nos produits est transferée dans notre nouveau point de vente collectif créé avec 6 autres exploitations engagées en agriculture biologique également.\r\n\r\nRetrouvez nous Au P\'tit Bonheur Des Champs, 70 route Neuve à Brindas, à droite du rond point après la ferme en direction du village.','0478451180','31832ece2f7930b9d0270f2633c3b853.jpeg','7cb9538d095fd6a783cce1e7ea47dc02.jpeg','lundi au jeudi de 6h à 14h et du vendredi au samedi de 8h à 14h',45.7159,4.70443),(22,44,'Chemin de Milon, Chaponost, Auvergne-Rhône-Alpes, France','69630','Chaponost','La Ferme du Milon','L’élevage biologique :\r\n\r\nÉleveur depuis 19! », Felix Bourbier effectue sa reconversion biologique sur une superficie de 157\r\nha en 1997. \r\nA la tête d’un cheptel de 200 bovins viande et après «3 années de reconversion, il obtient le 1er mars 2000\r\nLa certification biologique de l’exploitation.','0478454550','607dc59bfdaf04983d4181c2da1228e0.jpeg','5242b0d083ab4ac768df6d120892fe97.jpeg','Lundi au samedi de  8h à 18h et le samedi de 8h à 12h',45.7038,4.72022),(23,45,'963 Chemin de Beluze, Limonest, Auvergne-Rhône-Alpes, France','69760','Limonest','Ferme de l\'hermitage','Un élevage de chèvre en ville !\r\nLa ferme de l’Hermitage est située à 15 min au nord de Lyon en zone périurbaine, à Limonest.\r\nNous élevons nos 80 chèvres en agriculture biologique, certifié depuis 2010, sur les pâturages du vallon de Rochecardon et nous transformons l’intégralité du lait que nous produisons en fromages de chèvre de toutes sortes et yaourts.','0472576076','c7d85fb3ba2ac86ba11409e0ac124b7a.jpeg','1fd385727f22e14d9d4a11818b1948b3.jpeg','lundi au vendredi de 6h à 14H30 et le samedi de 8h à 12h',45.8258,4.7772),(24,46,'1645 Route de Chatanay, Vaugneray, Auvergne-Rhône-Alpes, France','69670','Vaugneray','brun de ferme','Brun de Ferme est une ferme convertie à l\'agriculture biologique qui propose des services de pension de chevaux en paddock individuel ou au pré. \r\n\r\nNous sommes situés sur la commune de Vaugneray au hameau de Chatanay dans un cadre  idéal pour le travail ou la ballade de votre cheval.\r\n\r\nN’hésitez pas à nous contacter pour toute demande de renseignement sur nos services et prestations.\r\n\r\nSuivez nous également sur notre page facebook','0684856025','7723d589e23d435e3034543537489669.jpeg','a22a63283f44c4af84d838d7b9f17a0f.jpeg','lundi au samedi de 7h à 15h',45.7164,4.6571),(25,47,'2025 Route de France, Fleurieux-sur-l\'Arbresle, Auvergne-Rhône-Alpes, France','69210','Fleurieux-sur-l\'Arbresle','Ferme des Gones','Une Ferme typique lyonnaise ! chèvres et compagnie .','0472546004','1aa3266eff8a04e028d637bc919c5e31.jpeg','9e793d9e196ffb2c7a23f779cb5658c8.jpeg','lundi au vendredi  de 6h à 13h',45.8341,4.66958),(26,48,'La Côte, Mornant, Auvergne-Rhône-Alpes, France','69440','Mornant','LA Ferme du Mornantais','Notre exploitation est située à Mornant au pied des monts Lyonnais. Depuis plus de 40 ans, nous transformons notre lait en yaourts et fromages frais. Agriculteurs depuis trois générations mon frère et moi avons repris la ferme familiale.\r\n\r\nnous pratiquons une agriculture paysanne, c’est-à-dire une agriculture créatrice d’emplois, respectueuse de son environnement, visant l’autonomie alimentaire du troupeau.','0478487038','04c971c0797cd5a7ce3ac8c791dffd75.jpeg','a760363b9dc367b77c247da2fd0af06a.jpeg','lundi au vendredi de 9h a 19h',45.6076,4.69918),(27,49,'11 Chemin de Champemin, Vourles, Auvergne-Rhône-Alpes, France','69390','Vourles','Ranch de la Ferme de Vourles','Découvrez  le magnifique ranch de de Vourles ! Elevage de chevaux et fermier de père en fils !','0615604858','1642e7628099ab5c9cfbbfbce8ee3104.jpeg','23438ece5d5ae0d4c03545eca941129e.jpeg','lundi au samedi de 7h à 17h',45.6598,4.78169),(28,50,'19 c Rue Ernest Fabregue','69009','Lyon 9e Arrondissement','La ferme de Bernard','Venez découvrir des légumes issus de l\'agriculture raisonnée. Nous vous accueillons du lundi au samedi.','0921324365','20e1b6a3bf19e2f118b9fe426d949b99.jpeg','66cee6a8064a575e6d737afae60d52f5.jpeg','Lundi : 16h - 18h\r\nMardi : 16h - 18h\r\nVendredi : 16h - 18h\r\nSamedi : 10h - 18h',45.7983,4.8225),(29,52,'5 Rue des Tilleuls, Vaulx-en-Velin, Auvergne-Rhône-Alpes, France','69120','Vaulx-en-Velin','La ferme de Jean','venez c\'est bon','0909090909',NULL,NULL,NULL,45.7866,4.9083),(30,53,'Rue de la Justice, Paris 20e Arrondissement, Île-de-France, France','75020','Paris 20e Arrondissement','La ferme de Robert','miam','0909090909',NULL,NULL,NULL,48.8692,2.40775);
/*!40000 ALTER TABLE `farmer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `farmer_consumer`
--

DROP TABLE IF EXISTS `farmer_consumer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `farmer_consumer` (
  `farmer_id` int(11) NOT NULL,
  `consumer_id` int(11) NOT NULL,
  PRIMARY KEY (`farmer_id`,`consumer_id`),
  KEY `IDX_A13D51B613481D2B` (`farmer_id`),
  KEY `IDX_A13D51B637FDBD6D` (`consumer_id`),
  CONSTRAINT `FK_A13D51B613481D2B` FOREIGN KEY (`farmer_id`) REFERENCES `farmer` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_A13D51B637FDBD6D` FOREIGN KEY (`consumer_id`) REFERENCES `consumer` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `farmer_consumer`
--

LOCK TABLES `farmer_consumer` WRITE;
/*!40000 ALTER TABLE `farmer_consumer` DISABLE KEYS */;
INSERT INTO `farmer_consumer` VALUES (26,22),(28,22);
/*!40000 ALTER TABLE `farmer_consumer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `homepage`
--

DROP TABLE IF EXISTS `homepage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `homepage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `background_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consummer_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consummer_text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `consummer_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `farmer_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `farmer_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `farmer_text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `homepage`
--

LOCK TABLES `homepage` WRITE;
/*!40000 ALTER TABLE `homepage` DISABLE KEYS */;
INSERT INTO `homepage` VALUES (1,'/assets/images/4238.jpg','Bienvenue à la ferme','Vous êtes Locavore?','Vous souhaitez manger des produits locaux cultivés par les agriculteurs de votre région ? Cliquez simplement sur le lien ci-dessous. Vous pourrez découvrir tous les produteurs autour de vous. Ils vous indiquent leurs produits disponibles ainsi que leurs horaires d\'ouverture. Rendez-vous à la ferme !','http://www.elixir.tn/wp-content/uploads/2015/01/fruit1.jpg','VOUS ÊTES PRODUCTEUR?','https://p3.storage.canalblog.com/32/60/368878/44205573_m.jpg','Vous souhaitez faire de la vente directe depuis votre ferme mais vous manquez de visibilité? Bienvenue à la ferme est le site qu\'il vous faut.\n                        Inscrivez-vous, renseignez votre adresse, vos horaires d\'ouverture et ajoutez les produits que vous proposez. En quelques minutes, des consommateurs peuvent vous trouver facilement.');
/*!40000 ALTER TABLE `homepage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
INSERT INTO `migration_versions` VALUES ('20181231083232'),('20190101131042'),('20190104075316'),('20190104111124'),('20190104113315'),('20190109075457'),('20190109102210'),('20190110163551'),('20190111165824');
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D34A04AD12469DE2` (`category_id`),
  CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `product_category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,5,'consectetur','Voluptate temporibus facere id autem dicta incidunt.'),(2,1,'officiis','Unde et sunt beatae quasi sit quia.'),(3,2,'odit','Debitis eius amet commodi temporibus velit ut.'),(4,3,'eveniet','Vel dolore harum molestias veniam.'),(5,2,'laudantium','Dolore quis ipsa dolore autem exercitationem sed.'),(6,1,'quia','Natus quibusdam fugit voluptate fugiat.'),(7,2,'omnis','Laudantium sit ut atque id ratione reprehenderit.'),(8,1,'suscipit','Asperiores maiores voluptate et.'),(9,5,'iusto','Et at sequi dolores vel eveniet.'),(10,3,'qui','Illo assumenda occaecati repellendus est consequatur ducimus fugiat.'),(11,2,'earum','Officia voluptas excepturi dolor animi voluptas neque.'),(12,4,'corrupti','Maiores incidunt repudiandae perspiciatis enim est consequatur.'),(13,2,'est','Odio nam quae repellat quia optio dolores.'),(14,2,'error','Facilis maiores quia eaque earum.'),(15,4,'consequuntur','Vel sunt sint saepe nobis ipsum.'),(16,2,'vel','Corrupti id explicabo ipsa est laborum quam enim.'),(17,4,'aut','Qui nobis nulla et inventore.'),(18,1,'nam','Corrupti quod voluptatem voluptate provident nihil suscipit consequatur.'),(19,1,'debitis','Vitae qui veniam vel est suscipit odio.'),(20,3,'qui','Assumenda sed quaerat architecto aut saepe expedita.'),(21,2,'carottes','carottes oranges'),(22,2,'Tomates','rondes');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_category`
--

DROP TABLE IF EXISTS `product_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_category`
--

LOCK TABLES `product_category` WRITE;
/*!40000 ALTER TABLE `product_category` DISABLE KEYS */;
INSERT INTO `product_category` VALUES (1,'fruits'),(2,'légumes'),(3,'viandes'),(4,'divers'),(5,'alcool');
/*!40000 ALTER TABLE `product_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_farmer`
--

DROP TABLE IF EXISTS `product_farmer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_farmer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `farmer_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `weight` double NOT NULL,
  `kilo_price` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8EF9ED2B4584665A` (`product_id`),
  KEY `IDX_8EF9ED2B13481D2B` (`farmer_id`),
  CONSTRAINT `FK_8EF9ED2B13481D2B` FOREIGN KEY (`farmer_id`) REFERENCES `farmer` (`id`),
  CONSTRAINT `FK_8EF9ED2B4584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_farmer`
--

LOCK TABLES `product_farmer` WRITE;
/*!40000 ALTER TABLE `product_farmer` DISABLE KEYS */;
INSERT INTO `product_farmer` VALUES (1,21,28,'ea810caf20131a8ac919ebf024c0fa3a.jpeg',1,1,1),(2,22,28,'f10e86c0cbc1cbf8562148f32f815d72.jpeg',1,1,1);
/*!40000 ALTER TABLE `product_farmer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'ROLE_ADMIN'),(2,'ROLE_FARMER'),(3,'ROLE_CONSUMER');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `IDX_332CA4DDD60322AC` (`role_id`),
  KEY `IDX_332CA4DDA76ED395` (`user_id`),
  CONSTRAINT `FK_332CA4DDA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_332CA4DDD60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,41),(2,43),(2,44),(2,45),(2,46),(2,47),(2,48),(2,49),(2,50),(2,52),(2,53),(3,21),(3,22),(3,23),(3,24),(3,25),(3,26),(3,27),(3,28),(3,29),(3,30),(3,31),(3,32),(3,33),(3,34),(3,35),(3,36),(3,37),(3,38),(3,39),(3,40),(3,51);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_at` datetime NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (21,'Aimée','Adam','bernadette18@noos.fr','$2y$13$Zp3U3.WK4weHvK6ylNefPe9dskFL8Ex1Wn9a2wEyUape4XumB.JIW','2018-07-17 00:16:55','aimee-adam'),(22,'Éric','Chartier','leblanc.susan@tiscali.fr','$2y$13$u9s98FKPAWANcA0tUbnuuO8siHm26UU9nzKGZbaoeMMYegpk/xv.q','2018-07-28 15:51:12','eric-chartier'),(23,'William','Neveu','charrier.leon@lambert.com','$2y$13$aKQitmOnMmiAEyVWb2QHneM25oUNMBxDEcKT7p6U9XrhiApcn1fy.','2018-11-20 16:46:37','william-neveu'),(24,'Luc','Bertin','hmarchal@ifrance.com','$2y$13$lWl83tVrSCY5brr01aqqPeGNHuLOBkP96WTfKrW3huyYJdxcSzCRu','2018-12-25 03:40:50','luc-bertin'),(25,'Emmanuel','Giraud','delannoy.thomas@maillard.fr','$2y$13$7ABC0of2icVzfTUBKn6Qv.XqVjjCRRe7dQKxigChHoTPTSFIUYXIG','2018-06-23 02:38:07','emmanuel-giraud'),(26,'Nicolas','Klein','humbert.luce@dbmail.com','$2y$13$OmMo4vHRjeXjoRVY9u1rp.e76/HB0f00EtF8dZ3M625zNoMkoYGbG','2018-11-23 15:42:14','nicolas-klein'),(27,'Zoé','Ferreira','yves.pruvost@noos.fr','$2y$13$4UyQujmL6E2galSos2CcJe7x6WaHUFfaOgB/wRni2CEGjAnT8pzyC','2018-05-19 16:58:20','zoe-ferreira'),(28,'Claire','Vallet','raymond.dorothee@hotmail.fr','$2y$13$MbG6mJWBk2ACHgUBy0LJAuh1oXcYzDuQZTNxrH57U4tYJr72Dzotu','2018-09-22 14:46:17','claire-vallet'),(29,'Marcel','Mathieu','adele72@fischer.fr','$2y$13$aY8gJjmuJKA.ewXPcjq7IeE5vTpM89AnAI0OzKHtFSoo3Rxz2X7Ki','2018-08-14 20:09:48','marcel-mathieu'),(30,'Geneviève','Guyot','delattre.georges@dbmail.com','$2y$13$QLHW7zfhXfLf8k10bjNLgu7FnTIUar/61GObIH1QBntGS0BYLybYy','2018-10-06 00:46:07','genevieve-guyot'),(31,'Anastasie','Camus','olivie66@wanadoo.fr','$2y$13$c0epCFoxE39YeJ/TVCbS.OrCeAl4IH1VHdXxUxHCqmLGmAHLCvwx2','2018-08-08 08:53:02','anastasie-camus'),(32,'André','Lecoq','charlotte.poulain@ifrance.com','$2y$13$e5Af2Q0pOrsmd4NjePx9.eF3jzF.sUGGlys5GJSTI/ddpsaAX/.lW','2018-11-04 20:50:09','andre-lecoq'),(33,'Élodie','Launay','albert.jean@bertrand.fr','$2y$13$RAM7VF4nYnDYiD1O8H7uSOtuHNwIX8t4ky5b/tQwoQp8W8.tTGBjC','2018-05-30 18:23:50','elodie-launay'),(34,'Richard','Schmitt','paulette.goncalves@dbmail.com','$2y$13$b.kdlgErLEtc3JSVa6H5XOS3VyrwSA2W1RN.pz49kEoCxfBWeue8i','2018-09-11 04:58:49','richard-schmitt'),(35,'Thibaut','Vallet','gilbert84@toussaint.fr','$2y$13$8I5KJvf/cH4jV1JFqKZPde9rAtvotvwSXQFkqaNmeHNXGPoom6iHG','2018-12-03 02:15:36','thibaut-vallet'),(36,'Éric','Mace','laurence.lecomte@mace.org','$2y$13$gNA0m.B62yD3sE6rOLl.yeRj3vTzWu5rQL1MzniwjaarRwTjd2uiS','2018-06-25 02:16:44','eric-mace'),(37,'Diane','Marion','antoine03@hotmail.fr','$2y$13$kX8Kzbv.Z7ug0TX.pLpPkebKxS87nKfGcukvCRBzkzzIrPk5.sZZa','2018-08-12 12:21:20','diane-marion'),(38,'Jules','Hebert','aurelie.charpentier@camus.org','$2y$13$ne36.FFcVmENdSMmVZSIJeycZdmNu4CIxHOKzoKAJea3mfq6B5p.q','2018-09-07 19:16:00','jules-hebert'),(39,'Édith','Renault','adelaide.peron@rey.net','$2y$13$ZMvwiV5pvm2nsDKitOMG0uSz6GsF6bxhS3s4yTgEcskcvqvcreg6u','2018-08-08 00:35:40','edith-renault'),(40,'Honoré','Richard','mleleu@bouygtel.fr','$2y$13$ie7e4BMOw/IWf14LuusS.OzG5H53.1wcDzSYb/row0F5L5PTXfVXm','2018-06-07 14:35:31','honore-richard'),(41,'admin','admin','admin@gmail.com','$2y$13$ne36.FFcVmENdSMmVZSIJeycZdmNu4CIxHOKzoKAJea3mfq6B5p.q','2018-08-12 07:30:35','admin-admin'),(43,'Michel','Rateaux','m.rateaux@hotmail.fr','$2y$13$tZJrnVUcZIy0KXkvjt2Zt..VzqQk8l9sh4tbWrNrTLHgbOqypdO6S','2019-01-17 08:53:05','earl-de-montplaisir'),(44,'felix','bourbier','f.bourbier@hotmail.fr','$2y$13$MqWAdUDNXE0p5zv5kXvLC.u6dNr/z8J3OTUDQcR06qK999Xue/Yxm','2019-01-17 09:00:43','la-ferme-milon'),(45,'olivier et pierre','griot','op.griot@hotmail.fr','$2y$13$IPvVzyU/9JZBxBQl7wUIUeFvwxXlgan30G3WtIpoUCPyXuxaFOe5y','2019-01-17 09:12:06','olivier-et-pierre-griot'),(46,'Jean et Olivia','bergot','jo.bergot@hotmail.fr','$2y$13$xyJrcfC5xd2ViGeBdCHsG.9gP5N2EqTmK9kFlZhOpsgC2XZ1OTLLO','2019-01-17 09:16:21','jean-et-olivia-bergot'),(47,'Armelle et Stéphane','grozier','as.grozier@hotmail.fr','$2y$13$5nR2KaERuqR.wWuEGn06FO5nWW6heblDqh6HWVyvLUOJn9htNkasq','2019-01-17 09:19:26','armelle-et-stephane-grozier'),(48,'Martin','Legrand','m.legrand@hotmail.fr','$2y$13$o32vRzRvwJqpzU.ULD7.fOUFxGbDrUuKNc4d8LplELnnTpwkK0Pv.','2019-01-17 09:27:08','martin-legrand'),(49,'patrick','Mariton','p.mariton@hotmail.fr','$2y$13$NGs8FyKbNJEHchSr0YCFm.sHIjev6PM9Xk9NR3MxT/dQiRRmtIsv.','2019-01-17 10:00:07','patrick-mariton'),(50,'Bernard','Michou','celine.minaudier@gmail.com','$2y$13$C2zxGjhlL/T2xcLqezj/Ce8twL4OZBJtgO7UJJnJkVqng.hsv0rLa','2019-01-18 11:36:05','celine-minaudier'),(51,'Patrick','min','patrick@gmail.com','$2y$13$EXGDzOF5VLhtqaLxMSNVyezKRUZNtYQ9I0v4x4YlmMM9d5flb4gO6','2019-01-18 11:46:20','patrick-min'),(52,'Jean','Valgeant','jeanV@gmail.com','$2y$13$08.2Ipvry/E1z6Zm5B57wORvVkkq4NUtOJbIlGolT883dPPNPwtje','2019-01-18 14:18:01','jean-valgeant'),(53,'Robert','Dupuis','robert@gmail.fr','$2y$13$/JoZlFNoehwb27KXYcNtsuLxVzmJYZIIuPfBJ79wELVgdLkIpuZF.','2019-01-18 14:20:15','robert-dupuis');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `valf_1`
--

DROP TABLE IF EXISTS `valf_1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `valf_1` (
  `C1` text,
  `C2` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `valf_1`
--

LOCK TABLES `valf_1` WRITE;
/*!40000 ALTER TABLE `valf_1` DISABLE KEYS */;
INSERT INTO `valf_1` VALUES ('-- MySQL dump 10.13  Distrib 8.0.12',' for macos10.13 (x86_64)'),('/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS',' UNIQUE_CHECKS=0 */;'),('/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS',' FOREIGN_KEY_CHECKS=0 */;'),('/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE',' SQL_MODE=\'NO_AUTO_VALUE_ON_ZERO\' */;'),('/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES',' SQL_NOTES=0 */;'),('  `id` int(11) NOT NULL AUTO_INCREMENT',NULL),('  `farmer_id` int(11) NOT NULL',NULL),('  `author_id` int(11) NOT NULL',NULL),('  `created_at` datetime NOT NULL',NULL),('  `rating` int(11) NOT NULL',NULL),('  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL',NULL),('  PRIMARY KEY (`id`)',NULL),('  KEY `IDX_9474526C13481D2B` (`farmer_id`)',NULL),('  KEY `IDX_9474526CF675F31B` (`author_id`)',NULL),('  CONSTRAINT `FK_9474526C13481D2B` FOREIGN KEY (`farmer_id`) REFERENCES `farmer` (`id`)',NULL),('  `id` int(11) NOT NULL AUTO_INCREMENT',NULL),('  `user_id` int(11) NOT NULL',NULL),('  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL',NULL),('  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL',NULL),('  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL',NULL),('  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL',NULL),('  `description` longtext COLLATE utf8mb4_unicode_ci',NULL),('  `profil_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL',NULL),('  PRIMARY KEY (`id`)',NULL),('  UNIQUE KEY `UNIQ_705B3727A76ED395` (`user_id`)',NULL),('  `C1` text',NULL),('  `id` int(11) NOT NULL AUTO_INCREMENT',NULL),('  `user_id` int(11) NOT NULL',NULL),('  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL',NULL),('  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL',NULL),('  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL',NULL),('  `farm_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL',NULL),('  `farm_description` longtext COLLATE utf8mb4_unicode_ci',NULL),('  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL',NULL),('  `photo_profil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL',NULL),('  `photo_farm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL',NULL),('  `schedule` longtext COLLATE utf8mb4_unicode_ci',NULL),('  `lat` double NOT NULL',NULL),('  `lng` double NOT NULL',NULL),('  PRIMARY KEY (`id`)',NULL),('  UNIQUE KEY `UNIQ_EC85AC8FA76ED395` (`user_id`)',NULL),('  `farmer_id` int(11) NOT NULL',NULL),('  `consumer_id` int(11) NOT NULL',NULL),('  KEY `IDX_A13D51B613481D2B` (`farmer_id`)',NULL),('  KEY `IDX_A13D51B637FDBD6D` (`consumer_id`)',NULL),('  CONSTRAINT `FK_A13D51B613481D2B` FOREIGN KEY (`farmer_id`) REFERENCES `farmer` (`id`) ON DELETE CASCADE',NULL),('  `id` int(11) NOT NULL AUTO_INCREMENT',NULL),('  `background_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL',NULL),('  `main_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL',NULL),('  `consummer_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL',NULL),('  `consummer_text` longtext COLLATE utf8mb4_unicode_ci NOT NULL',NULL),('  `consummer_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL',NULL),('  `farmer_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL',NULL),('  `farmer_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL',NULL),('  `farmer_text` longtext COLLATE utf8mb4_unicode_ci NOT NULL',NULL),('  `id` int(11) NOT NULL AUTO_INCREMENT',NULL),('  `category_id` int(11) NOT NULL',NULL),('  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL',NULL),('  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL',NULL),('  PRIMARY KEY (`id`)',NULL),('  KEY `IDX_D34A04AD12469DE2` (`category_id`)',NULL),('  `id` int(11) NOT NULL AUTO_INCREMENT',NULL),('  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL',NULL),('  `id` int(11) NOT NULL AUTO_INCREMENT',NULL),('  `product_id` int(11) NOT NULL',NULL),('  `farmer_id` int(11) NOT NULL',NULL),('  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL',NULL),('  `price` double NOT NULL',NULL),('  `weight` double NOT NULL',NULL),('  `kilo_price` double NOT NULL',NULL),('  PRIMARY KEY (`id`)',NULL),('  KEY `IDX_8EF9ED2B4584665A` (`product_id`)',NULL),('  KEY `IDX_8EF9ED2B13481D2B` (`farmer_id`)',NULL),('  CONSTRAINT `FK_8EF9ED2B13481D2B` FOREIGN KEY (`farmer_id`) REFERENCES `farmer` (`id`)',NULL),('  `id` int(11) NOT NULL AUTO_INCREMENT',NULL),('  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL',NULL),('  `role_id` int(11) NOT NULL',NULL),('  `user_id` int(11) NOT NULL',NULL),('  KEY `IDX_332CA4DDD60322AC` (`role_id`)',NULL),('  KEY `IDX_332CA4DDA76ED395` (`user_id`)',NULL),('  CONSTRAINT `FK_332CA4DDA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE',NULL),('  `id` int(11) NOT NULL AUTO_INCREMENT',NULL),('  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL',NULL),('  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL',NULL),('  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL',NULL),('  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL',NULL),('  `create_at` datetime NOT NULL',NULL),('  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL',NULL);
/*!40000 ALTER TABLE `valf_1` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-18 14:24:26

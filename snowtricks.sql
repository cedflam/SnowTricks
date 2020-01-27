-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 27 jan. 2020 à 18:56
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `snowtricks`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name_category`) VALUES
(6, 'Grab'),
(7, 'Slide'),
(8, 'Rotation'),
(9, 'Flip'),
(10, 'Old-School');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_comment` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_comment` datetime NOT NULL,
  `id_author_id` int(11) DEFAULT NULL,
  `id_tricks_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526C76404F3C` (`id_author_id`),
  KEY `IDX_9474526CBB208D73` (`id_tricks_id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `content_comment`, `date_comment`, `id_author_id`, `id_tricks_id`) VALUES
(1, 'Commentaire n° 0', '2020-01-16 00:00:00', 5, 9),
(2, 'Commentaire n° 1', '2020-01-16 00:00:00', 6, 6),
(3, 'Commentaire n° 2', '2020-01-16 00:00:00', 4, 4),
(4, 'Commentaire n° 3', '2020-01-12 00:00:00', 5, 7),
(5, 'Commentaire n° 4', '2020-01-16 00:00:00', 6, 5),
(6, 'Commentaire n° 5', '2020-01-16 00:00:00', 4, 8),
(10, 'Commentaire n° 9', '2020-01-16 00:00:00', 4, 10),
(11, 'Commentaire n° 10', '2020-01-16 00:00:00', 6, 3),
(12, 'Commentaire n° 11', '2020-01-16 00:00:00', 5, 6),
(13, 'Commentaire n° 12', '2020-01-12 00:00:00', 6, 4),
(15, 'Commentaire n° 14', '2020-01-16 00:00:00', 6, 5),
(17, 'Commentaire n° 16', '2020-01-16 00:00:00', 5, 10),
(18, 'Commentaire n° 17', '2020-01-16 00:00:00', 6, 6),
(19, 'Commentaire n° 18', '2020-01-16 00:00:00', 4, 4),
(20, 'Commentaire n° 19', '2020-01-15 00:00:00', 5, 6),
(22, 'Commentaire n° 21', '2020-01-16 00:00:00', 6, 10),
(23, 'Commentaire n° 22', '2020-01-16 00:00:00', 4, 3),
(24, 'Commentaire n° 23', '2020-01-19 00:00:00', 5, 5),
(26, 'Commentaire n° 25', '2020-01-16 00:00:00', 4, 10),
(27, 'Commentaire n° 26', '2020-01-16 00:00:00', 5, 5),
(28, 'Commentaire n° 27', '2020-01-16 00:00:00', 6, 5),
(29, 'Commentaire n° 28', '2020-01-16 00:00:00', 4, 5),
(30, 'Commentaire n° 29', '2020-01-16 00:00:00', 4, 6),
(31, 'Commentaire n° 30', '2020-01-16 00:00:00', 4, 6),
(32, 'Commentaire n° 31', '2020-01-16 00:00:00', 5, 6),
(33, 'Commentaire n° 32', '2020-01-16 00:00:00', 5, 7),
(34, 'Commentaire n° 33', '2020-01-16 00:00:00', 6, 7),
(35, 'Commentaire n° 34', '2020-01-16 00:00:00', 4, 7),
(37, 'Commentaire n° 36', '2020-01-16 00:00:00', 6, 9),
(38, 'Commentaire n° 37', '2020-01-16 00:00:00', 4, 8),
(40, 'Commentaire n° 39', '2020-01-16 00:00:00', 4, 9),
(41, 'Commentaire n° 40', '2020-01-16 00:00:00', 6, 5),
(42, 'Commentaire n° 41', '2020-01-16 00:00:00', 4, 3),
(43, 'Commentaire n° 42', '2020-01-16 00:00:00', 5, 3),
(44, 'Commentaire n° 43', '2020-01-16 00:00:00', 6, 3),
(45, 'Commentaire n° 44', '2020-01-16 00:00:00', 5, 4),
(47, 'Commentaire n° 46', '2020-01-16 00:00:00', 4, 4),
(48, 'Commentaire n° 47', '2020-01-16 00:00:00', 4, 6),
(49, 'Commentaire n° 48', '2020-01-16 00:00:00', 4, 7),
(50, 'Commentaire n° 49', '2020-01-16 00:00:00', 5, 5),
(84, 'test', '2020-01-23 17:46:34', 4, 3),
(86, 'test', '2020-01-27 11:46:05', 4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tricks_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C53D045FBB208D73` (`id_tricks_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `address_img`, `id_tricks_id`) VALUES
(1, 'https://live.staticflickr.com/2501/4026228546_50cc7218ec_z.jpg', 9),
(2, 'https://static1.mennenfrance.fr/articles/3/47/3/@/924-en-snow-comme-en-skate-une-figure-ou-article_normal_image-1.jpg', 9),
(3, 'https://i.pinimg.com/originals/8e/1c/93/8e1c935659f7fed325ac53220f4b6699.jpg', 6),
(4, 'https://media.winnipegfreepress.com/images/1000*653/5503492.jpg', 6),
(5, 'https://i.pinimg.com/originals/d3/c1/6b/d3c16beb7c4e8308120c03e2f1fb4812.jpg', 4),
(6, 'https://footage.framepool.com/shotimg/qf/219361543-railslide-slide-sports-rail-sport-laax.jpg', 4),
(7, 'http://shinzitay.free.fr/snow/fotoz/snow-fr/topic_flips/corkscrew_00.jpg', 7),
(8, 'http://maps.canadiangeographic.ca/infographic-judging-snowboarding-event/images/mark-mcmorris-signature-jump-infographic.jpg', 7),
(9, 'https://static1.mennenfrance.fr/articles/7/36/7/@/979-travis-rice-la-releve-du-snowboard-article_content_image-1.jpg', 5),
(10, 'https://static1.mennenfrance.fr/articles/7/36/7/@/721-travis-rice-la-releve-du-snowboard-article_normal_image-1.jpg', 5),
(11, 'https://i.skyrock.net/8038/84168038/pics/3178986837_1_2_xyZ6etcq.jpg', 8),
(12, 'http://www.tierraunica.com/.a/6a00e551962103883301310f1f0e79970c-pi', 8),
(17, 'https://coresites-cdn.factorymedia.com/onboard/wp-content/uploads/2013/10/LetItRide_CraigKelly_WorldChampionshipColorado_1990cJonFoster_Red_Bull_Content_Pool-620x418.jpg', 10),
(18, 'http://www.eyecatchme.de/wp-content/uploads/2012/03/sportfotograf-koeln-blog-700-0670.jpg', 10),
(19, 'http://media.sit.savoie-mont-blanc.com/original/124286/0-1753343.jpg', 3),
(20, 'http://snowtrix.ffouillet.fr/uploads/tricks/photos/85/a4bab9286d33bab4a0791eee183ece1f.jpeg', 3),
(29, 'https://i.ytimg.com/vi/jH76540wSqU/hqdefault.jpg', 29),
(30, 'http://snowtrix.ffouillet.fr/uploads/tricks/photos/94/e25d96ca2a9026df970e56ab3b8b332f.jpeg', 29),
(31, 'https://twistedsifter.files.wordpress.com/2011/01/nose-grab-snowboarding.jpg?w=799&h=532', 28),
(32, 'https://cdn.shopify.com/s/files/1/0230/2239/files/Screen_Shot_2016-03-19_at_4.45.09_PM_large.png?4142639917732669333', 28);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200116082009', '2020-01-17 10:27:26'),
('20200116082741', '2020-01-17 10:27:26'),
('20200116083147', '2020-01-17 10:27:26'),
('20200116083558', '2020-01-17 10:27:26'),
('20200116083924', '2020-01-17 10:27:26'),
('20200116084203', '2020-01-17 10:27:27'),
('20200116095738', '2020-01-17 10:27:27'),
('20200117135727', '2020-01-17 14:20:40'),
('20200117142147', '2020-01-17 14:22:11'),
('20200117200845', '2020-01-17 20:09:24'),
('20200120130530', '2020-01-20 13:10:00'),
('20200121153459', '2020-01-21 15:36:35'),
('20200124130722', '2020-01-24 13:07:38');

-- --------------------------------------------------------

--
-- Structure de la table `tricks`
--

DROP TABLE IF EXISTS `tricks`;
CREATE TABLE IF NOT EXISTS `tricks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_tricks` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_category_id` int(11) NOT NULL,
  `id_author_id` int(11) NOT NULL,
  `sentence` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_date` date NOT NULL,
  `edit_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E1D902C1A545015` (`id_category_id`),
  KEY `IDX_E1D902C176404F3C` (`id_author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tricks`
--

INSERT INTO `tricks` (`id`, `name`, `content_tricks`, `id_category_id`, `id_author_id`, `sentence`, `picture`, `add_date`, `edit_date`) VALUES
(3, 'Nose Slide', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.\r\n                    Maxime consequatur excepturi fugit ab doloribus illo, \r\n                    itaque architecto aspernatur id molestiae voluptatem repellendus \r\n                    sit iste ipsa ipsum! Quisquam delectus fugit quos harum, voluptatum, \r\n                    tempore suscipit itaque accusantium eveniet hic modi facere. \r\n                    Non mollitia iste quo ab incidunt beatae, exercitationem nemo? Accusamus!', 7, 4, 'Lorem ipsum dolor sit amet consectetur', 'https://zpks.com/p/5/4/54123/9715-4.jpg', '2020-01-20', '2020-01-24'),
(4, 'Board Slide', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.\n                    Maxime consequatur excepturi fugit ab doloribus illo, \n                    itaque architecto aspernatur id molestiae voluptatem repellendus \n                    sit iste ipsa ipsum! Quisquam delectus fugit quos harum, voluptatum, \n                    tempore suscipit itaque accusantium eveniet hic modi facere. \n                    Non mollitia iste quo ab incidunt beatae, exercitationem nemo? Accusamus!\n                   ', 7, 5, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit, incidunt!', 'https://i.pinimg.com/originals/83/c2/5e/83c25e962c4350964353026206dc797a.jpg', '2020-01-08', '2020-01-20'),
(5, 'Double Backside Rodeo 1080', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.\n                    Maxime consequatur excepturi fugit ab doloribus illo, \n                    itaque architecto aspernatur id molestiae voluptatem repellendus \n                    sit iste ipsa ipsum! Quisquam delectus fugit quos harum, voluptatum, \n                    tempore suscipit itaque accusantium eveniet hic modi facere. \n                    Non mollitia iste quo ab incidunt beatae, exercitationem nemo? Accusamus!\n                   ', 8, 6, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit, incidunt!', 'https://static1.mennenfrance.fr/articles/7/36/7/@/979-travis-rice-la-releve-du-snowboard-article_content_image-1.jpg', '2020-01-02', '2020-01-19'),
(6, 'Backside Triple Cork 1440', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.\n                    Maxime consequatur excepturi fugit ab doloribus illo, \n                    itaque architecto aspernatur id molestiae voluptatem repellendus \n                    sit iste ipsa ipsum! Quisquam delectus fugit quos harum, voluptatum, \n                    tempore suscipit itaque accusantium eveniet hic modi facere. \n                    Non mollitia iste quo ab incidunt beatae, exercitationem nemo? Accusamus!\n                   ', 8, 4, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit, incidunt!', 'https://media.winnipegfreepress.com/images/5503492.jpg', '2020-01-20', NULL),
(7, 'Corkscrew', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.\n                    Maxime consequatur excepturi fugit ab doloribus illo, \n                    itaque architecto aspernatur id molestiae voluptatem repellendus \n                    sit iste ipsa ipsum! Quisquam delectus fugit quos harum, voluptatum, \n                    tempore suscipit itaque accusantium eveniet hic modi facere. \n                    Non mollitia iste quo ab incidunt beatae, exercitationem nemo? Accusamus!\n                   ', 9, 5, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit, incidunt!', 'https://i.ytimg.com/vi/j4NfAsszIOk/maxresdefault.jpg', '2020-01-20', NULL),
(8, 'Double MC Twist 1260', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.\n                    Maxime consequatur excepturi fugit ab doloribus illo, \n                    itaque architecto aspernatur id molestiae voluptatem repellendus \n                    sit iste ipsa ipsum! Quisquam delectus fugit quos harum, voluptatum, \n                    tempore suscipit itaque accusantium eveniet hic modi facere. \n                    Non mollitia iste quo ab incidunt beatae, exercitationem nemo? Accusamus!\n                   ', 9, 6, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit, incidunt!', 'https://static1.mennenfrance.fr/articles/3/47/3/@/924-en-snow-comme-en-skate-une-figure-ou-article_normal_image-1.jpg', '2020-01-20', NULL),
(9, 'Backside Air', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.\n                    Maxime consequatur excepturi fugit ab doloribus illo, \n                    itaque architecto aspernatur id molestiae voluptatem repellendus \n                    sit iste ipsa ipsum! Quisquam delectus fugit quos harum, voluptatum, \n                    tempore suscipit itaque accusantium eveniet hic modi facere. \n                    Non mollitia iste quo ab incidunt beatae, exercitationem nemo? Accusamus!\n                   ', 10, 6, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit, incidunt!', 'https://coresites-cdn.factorymedia.com/onboard/wp-content/uploads/2013/10/LetItRide_CraigKelly_WorldChampionshipColorado_1990cJonFoster_Red_Bull_Content_Pool-620x418.jpg', '2020-01-14', '2020-01-19'),
(10, 'Method Air', 'Lorem ipsum dolor sit amet consectetur adipisicing elit.\n                    Maxime consequatur excepturi fugit ab doloribus illo, \n                    itaque architecto aspernatur id molestiae voluptatem repellendus \n                    sit iste ipsa ipsum! Quisquam delectus fugit quos harum, voluptatum, \n                    tempore suscipit itaque accusantium eveniet hic modi facere. \n                    Non mollitia iste quo ab incidunt beatae, exercitationem nemo? Accusamus!\n                   ', 10, 4, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit, incidunt!', 'https://i.pinimg.com/736x/40/b5/31/40b5317f04696ef4414461e8bce3e009.jpg', '2020-01-20', NULL),
(28, 'Nose Grab ', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est eius nesciunt saepe qui cum ab quasi officiis tempora mollitia maxime et rerum blanditiis odio deleniti voluptate temporibus in a, minus non ullam cumque tempore ex nobis nam. Mollitia quisquam perferendis totam quaerat ea autem voluptas, quia libero recusandae beatae quibusdam id minima ipsa repudiandae labore velit vero reiciendis obcaecati exercitationem omnis natus enim est. Nemo ipsum voluptatem nulla asperiores rerum? Repellat exercitationem natus quas nisi, atque earum iusto quam quod ut expedita, ', 6, 6, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 'https://i.ytimg.com/vi/y2MHu0mbzQw/hqdefault.jpg', '2020-01-20', NULL),
(29, 'Japan', 'qui cum ab quasi officiis tempora mollitia maxime et rerum blanditiis odio deleniti voluptate temporibus in a, minus non ullam cumque tempore ex nobis nam. Mollitia quisquam perferendis totam quaerat ea autem voluptas, quia libero recusandae beatae quibusdam id minima ipsa repudiandae labore velit vero reiciendis obcaecati exercitationem omnis natus enim est. Nemo ipsum voluptatem nulla asperiores rerum? Repellat exercitationem natus quas nisi, atque earum iusto quam quod ut expedita,', 6, 4, 'Mollitia quisquam perferendis', 'https://www.arts-majeurs.com/uploads/images/tricks/21.jpg', '2020-01-09', '2020-01-27');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_profile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `hash`, `first_name`, `last_name`, `img_profile`, `token`) VALUES
(4, 'Max', 'max@gmail.com', '$2y$13$YhHwBNX.SyU5skkCXy.7FO3xgEzX5KjKajrcVC2fleYqVTTmEd86.', 'max', 'duchemin', '$2y$13$O34hIpNFp9xwgmgBjl5bNOa1sM7K5lq9pNCmAqcyn0KA3hrJw5mf..png', NULL),
(5, 'Delphine', 'delphine@hotmail.fr', '$2y$13$NgGCwDhXYBlGFb5FVH.cuOdQNKbwhrF8r7.X0tW8sYS0T.6dH8iu2', 'delphine', 'payen', '$2y$13$O34hIpNFp9xwgmgBjl5bNOa1sM7K5lq9pNCmAqcyn0KA3hrJw5mf..png', NULL),
(6, 'Leon', 'leon@gmail.com', '$2y$13$WE0fPPFqKaMAFaRna.bCQ.TDLbijsygjzEtoc6F9e551obD1JGCee', 'leon', 'durand', '$2y$13$O34hIpNFp9xwgmgBjl5bNOa1sM7K5lq9pNCmAqcyn0KA3hrJw5mf..png', NULL),
(97, 'cedflam', 'cedflam@gmail.com', '$2y$13$YdAkp1.g63yitQYFaPVqaOXI1X0NUXCWiCRQKgmop8TyKsb8KxMzi', 'Cedric', 'Flamain', '$2y$13$xqpAvV8g2NJ2T.asU6YndeoWot1tq/n1FBozeiBCuvlyxXijqgO/6.png', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address_vid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tricks_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7CC7DA2CBB208D73` (`id_tricks_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `video`
--

INSERT INTO `video` (`id`, `address_vid`, `id_tricks_id`) VALUES
(1, 'https://www.youtube.com/embed/_CN_yyEn78M', 9),
(2, 'https://www.youtube.com/embed/URFnYGzu9lU', 6),
(3, 'https://www.youtube.com/embed/R3OG9rNDIcs', 4),
(4, 'https://www.youtube.com/embed/IXC_BNYIUOo', 7),
(5, 'https://www.youtube.com/embed/le5kB7Jry6U', 5),
(6, 'https://www.youtube.com/embed/YQIvm_2ay-U', 8),
(7, 'https://www.youtube.com/embed/ZWZGE9yp5hA', 10),
(10, 'https://www.youtube.com/embed/KqSi94FT7EE', 3),
(18, 'https://www.youtube.com/embed/gZFWW4Vus-Q', 28),
(19, 'https://www.youtube.com/embed/CzDjM7h_Fwo', 29);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C76404F3C` FOREIGN KEY (`id_author_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_9474526CBB208D73` FOREIGN KEY (`id_tricks_id`) REFERENCES `tricks` (`id`);

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_C53D045FBB208D73` FOREIGN KEY (`id_tricks_id`) REFERENCES `tricks` (`id`);

--
-- Contraintes pour la table `tricks`
--
ALTER TABLE `tricks`
  ADD CONSTRAINT `FK_E1D902C176404F3C` FOREIGN KEY (`id_author_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_E1D902C1A545015` FOREIGN KEY (`id_category_id`) REFERENCES `category` (`id`);

--
-- Contraintes pour la table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `FK_7CC7DA2CBB208D73` FOREIGN KEY (`id_tricks_id`) REFERENCES `tricks` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : sam. 06 juil. 2024 à 07:49
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `arkadia_zoo`
--

-- --------------------------------------------------------

--
-- Structure de la table `alimentation`
--

CREATE TABLE `alimentation` (
  `id` int(11) NOT NULL,
  `id_animal` int(11) NOT NULL,
  `nourritureProposee` varchar(255) NOT NULL,
  `grammage` int(11) NOT NULL,
  `dateAlimentation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `alimentation`
--

INSERT INTO `alimentation` (`id`, `id_animal`, `nourritureProposee`, `grammage`, `dateAlimentation`) VALUES
(9, 5, 'viande de boeuf', 3000, '2024-06-18'),
(11, 12, 'feuilles, legumes', 2500, '2024-06-20'),
(17, 2, 'viande de canard, viande de boeuf', 500, '2024-06-30'),
(25, 4, 'feuilles, carottes, bananes', 1000, '2024-07-05');

-- --------------------------------------------------------

--
-- Structure de la table `animaux`
--

CREATE TABLE `animaux` (
  `id` int(11) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `race` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `etat` text DEFAULT NULL,
  `nourritureProposee` varchar(255) DEFAULT NULL,
  `grammage` int(11) DEFAULT NULL,
  `datePassage` date DEFAULT NULL,
  `habitat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `animaux`
--

INSERT INTO `animaux` (`id`, `prenom`, `race`, `image`, `etat`, `nourritureProposee`, `grammage`, `datePassage`, `habitat_id`) VALUES
(2, 'cerf élaphe', 'Cervus elaphus', '../assets/images/animaux_savane/cerf.png', '', '', 0, '0000-00-00', 2),
(3, 'babouin', 'hamadryas', '../assets/images/animaux_jungle/babouin.png', 'très bien', 'Fruits,Légumes,Feuilles ,Graines \r\n', 800, '2024-06-05', 1),
(4, 'Chimpanzé', 'troglodytes', '../assets/images/animaux_jungle/chapmze.png', 'assez bien', 'Fruits,Légumes,Feuilles ,Graines ', 900, '2024-06-05', 1),
(5, 'jaguar', 'onca', '../assets/images/animaux_jungle/jaguar.png', NULL, NULL, NULL, NULL, 1),
(6, 'kangourou', 'macropus', '../assets/images/animaux_jungle/kangourou.png', NULL, NULL, NULL, NULL, 1),
(7, 'koala', 'cinereus', '../assets/images/animaux_jungle/koala.png', NULL, NULL, NULL, NULL, 1),
(8, 'panthère noir', 'panthera pardus', '../assets/images/animaux_jungle/panthere.png', NULL, NULL, NULL, NULL, 1),
(9, 'panda', 'melanoleuca', '../assets/images/animaux_jungle/panda.png', NULL, NULL, NULL, NULL, 1),
(10, 'puma', 'concolor', '../assets/images/animaux_jungle/puma.png', NULL, NULL, NULL, NULL, 1),
(11, 'tigre', 'tigris', '../assets/images/animaux_jungle/tigre.png', NULL, NULL, NULL, NULL, 1),
(12, 'gorille de l\'ouest', 'gorilla', '../assets/images/animaux_jungle/gorille.png', NULL, NULL, NULL, NULL, 1),
(13, 'autruche', 'camelus', '../assets/images/animaux_savane/autruche.png', NULL, NULL, NULL, NULL, 2),
(14, 'caracal', 'lynx', '../assets/images/animaux_savane/caracal.png', NULL, NULL, NULL, NULL, 2),
(15, 'zèbre grévy', 'grevyi', '../assets/images/animaux_savane/zebre.png', NULL, NULL, NULL, NULL, 2),
(16, 'chacal', 'mesomelas', '../assets/images/animaux_savane/chacal.png', NULL, NULL, NULL, NULL, 2),
(17, 'fennec', 'zerda', '../assets/images/animaux_savane/fennec.png', NULL, NULL, NULL, NULL, 2),
(18, 'gazelle', 'thomsonii', '../assets/images/animaux_savane/gazelle.png', NULL, NULL, NULL, NULL, 2),
(19, 'girafe', 'cameloparadalis', '../assets/images/animaux_savane/girafe.png', NULL, NULL, NULL, NULL, 2),
(20, 'léopard', 'pardus', '../assets/images/animaux_savane/leopard.png', NULL, '', NULL, NULL, 2),
(21, 'lion', 'leo', '../assets/images/animaux_savane/lion.png', NULL, NULL, NULL, NULL, 2),
(22, 'alligator', 'mississippiensis', '../assets/images/animaux_marais/alligatore.png', NULL, NULL, NULL, NULL, 3),
(23, 'blaireau', 'meles', '../assets/images/animaux_marais/blaireau.png', NULL, NULL, NULL, NULL, 3),
(24, 'buffle ', 'caffer', '../assets/images/animaux_marais/buffle.png', NULL, NULL, NULL, NULL, 3),
(25, 'couleuvre', 'natrix', '../assets/images/animaux_marais/couleuvre.png', NULL, NULL, NULL, NULL, 3),
(26, 'flamant rose', 'roseus', '../assets/images/animaux_marais/flamantRose.png', NULL, NULL, NULL, NULL, 3),
(27, 'grue royale', 'regolorum', '../assets/images/animaux_marais/grueRoyale.png', NULL, NULL, NULL, NULL, 3),
(28, 'loutre d\'europe', 'lutris', '../assets/images/animaux_marais/loutre.png', NULL, NULL, NULL, NULL, 3),
(29, 'raton laveur', 'lotor', '../assets/images/animaux_marais/ratonLaveur.png', NULL, NULL, NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  `commentaire` text DEFAULT NULL,
  `Valide` tinyint(1) DEFAULT NULL,
  `utilisateur_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `pseudo`, `commentaire`, `Valide`, `utilisateur_id`) VALUES
(2, 'lila', 'on a passé avec les enfants un moment merveilleux.', 1, NULL),
(77, 'DAVID', 'Immersion totale, diversité incroyable d\'animaux, à ne pas manquer.', 1, 1),
(78, 'julien', 'Spectacles fascinants, environnement bien conçu, parfait pour une journée en famille.', 1, 1),
(79, 'sarah', 'Équipe passionnée, animations pédagogiques captivantes pour les enfants.', 1, 1),
(80, 'lila', 'Efforts de conservation remarquables, naissances fréquentes d\'espèces menacées', 1, 1),
(81, 'toto', 'test', 0, 1),
(82, 'toto2', 'test2', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire_habitat`
--

CREATE TABLE `commentaire_habitat` (
  `id` int(11) NOT NULL,
  `commentaire` text DEFAULT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `habitat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commentaire_habitat`
--

INSERT INTO `commentaire_habitat` (`id`, `commentaire`, `utilisateur_id`, `habitat_id`) VALUES
(23, ' Espaces vastes et enrichis favorisent le développement des espèces ', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(4, 'bouzelmat', 'omarbouzelmat5@gmail.com', 'test2', 'mon deuxieme test', '2024-06-12 20:40:30'),
(5, 'bouzelmat', 'omarbouzelmat5@gmail.com', 'test3', 'toujours bon ?', '2024-06-12 21:03:51'),
(7, 'bouzelmat', 'omarbouzelmat5@gmail.com', 'test2', 'je test la section contact', '2024-06-16 07:16:10'),
(8, 'bouzelmat', 'omarbouzelmat5@gmail.com', 'test', 'je test', '2024-06-18 21:19:08'),
(11, 'salut', 'omarbouzelmat99@gmail.com', 'salut', 'salut', '2024-07-01 08:42:46');

-- --------------------------------------------------------

--
-- Structure de la table `habitats`
--

CREATE TABLE `habitats` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `habitats`
--

INSERT INTO `habitats` (`id`, `nom`, `description`, `image`) VALUES
(1, 'La jungle', 'La jungle est une forêt dense et luxuriante, riche en biodiversité.', '../assets/images/animaux_jungle/habitat_jungle.png'),
(2, 'La savane', 'La savane est une vaste prairie tropicale avec des arbres épars, abritant une faune diversifiée.', ' ../assets/images/animaux_savane/habitat_savane.png'),
(3, 'Les marais', 'Les marais sont des zones humides, souvent inondées, riches en plantes aquatiques et en animaux.', '../assets/images/animaux_marais/habitat_marais.png');

-- --------------------------------------------------------

--
-- Structure de la table `rapport_veterinaire`
--

CREATE TABLE `rapport_veterinaire` (
  `id` int(11) NOT NULL,
  `etat` text DEFAULT NULL,
  `nourritureProposee` varchar(255) DEFAULT NULL,
  `grammage` int(11) DEFAULT NULL,
  `datePassage` date DEFAULT NULL,
  `detailEtat` text DEFAULT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `animal_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `rapport_veterinaire`
--

INSERT INTO `rapport_veterinaire` (`id`, `etat`, `nourritureProposee`, `grammage`, `datePassage`, `detailEtat`, `utilisateur_id`, `animal_id`) VALUES
(10, 'bien', 'viande rouge', 899, '2024-06-19', 'bien', NULL, 20),
(12, 'très bien', 'viande ', 1500, '2024-06-23', 'l\'animal doit se reposer 1 semaine', NULL, 19),
(15, 'malade', 'fibre', 400, '2024-06-28', 'malade', NULL, 6),
(19, 'Blessure mineure', ' Mélange de foin, légumes verts frais (comme la laitue, le céleri), et fruits.', 1500, '2024-06-26', 'L\'animal présente une petite coupure ou égratignure qui nécessite des soins de base.', 2, 7),
(20, 'Bon état de santé général', ' pommes, carottes, bananes, épinards', 1000, '2024-06-25', 'L\'animal est actif, alerte et montre des comportements typiques de son espèce.', 2, 3),
(21, 'En bonne santé', ' pommes, carottes, bananes, épinards', 1400, '2024-06-25', 'L\'animal est en bonne santé, actif et montre un comportement normal.\"', 2, 4),
(22, 'En bonne santé', 'Mélange de foin, légumes verts frais (comme la laitue, le céleri), et fruits.', 1200, '2024-06-25', 'L\'animal est en bonne santé, actif et montre un comportement normal.\"', 2, 2),
(23, 'L\'animal a subi une blessure physique', 'Viande crue variée comme du bœuf, du poulet, ou du poisson frais.', 3000, '2024-06-25', ' L\'animal a une coupure à la patte avant gauche nécessitant des soins.', 2, 5),
(24, 'Bon état de santé général', 'Mélange de foin, légumes verts frais (comme la laitue, le céleri), et fruits.', 2000, '2024-06-25', 'L\'animal est actif, alerte et montre des comportements typiques de son espèce.', 2, 6),
(25, 'Bon état de santé général', 'Mélange de foin, légumes verts frais (comme la laitue, le céleri), et fruits.', 800, '2024-06-27', 'L\'animal est actif, alerte et montre des comportements typiques de son espèce.', 2, 13),
(26, 'Bon état de santé général', 'Viande crue variée comme du bœuf, du poulet, ou du poisson frais.', 700, '2024-06-28', 'L\'animal est actif, alerte et montre des comportements typiques de son espèce.', 2, 14),
(27, 'Bon état de santé général', 'Viande crue variée comme du bœuf, du poulet, ou du poisson frais.', 4000, '2024-06-27', 'L\'animal est actif, alerte et montre des comportements typiques de son espèce.', 2, 22),
(28, 'Bon état de santé général', 'Combinaison de viande crue et de légumes/fruits', 450, '2024-06-29', 'L\'animal est actif, alerte et montre des comportements typiques de son espèce', 2, 23),
(36, 'correct', 'viande et poisson', 2300, '2024-07-04', 'correct', NULL, 10),
(37, ' Bon état de santé général', 'Viande crue variée comme du bœuf, du poulet, ou du poisson frais.', 2000, '2024-07-05', 'L\'animal est actif, alerte et montre des comportements typiques de son espèce.', NULL, 8),
(38, ' En bonne santé', 'Mélange de foin, légumes verts frais (comme la laitue, le céleri), et fruits.', 3000, '2024-07-05', ' L\'animal est en bonne santé, actif et montre un comportement normal.', NULL, 15),
(39, 'Bon état de santé général', 'Viande crue variée comme du bœuf, du poulet, ou du poisson frais.', 800, '2024-07-05', 'L\'animal est actif, alerte et montre des comportements typiques de son espèce.', NULL, 16),
(40, 'Bon état de santé général', 'herbes', 4000, '2024-07-05', 'L\'animal est actif, alerte et montre des comportements typiques de son espèce', NULL, 24);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nom_role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `nom_role`) VALUES
(1, 'admin'),
(2, 'veterinaire'),
(3, 'employe');

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `id_service` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id_service`, `nom`, `description`, `image`) VALUES
(1, 'Restauration', 'Bienvenue dans notre restaurant, un lieu chaleureux et convivial où nous vous invitons à découvrir une cuisine exquise et authentique.                             Nos chefs talentueux utilisent des ingrédients frais et de qualité                            pour créer des plats savoureux qui raviront vos papilles.Engagés depuis toujours dans la démarche du “fait maison”,                             et l’utilisation de produits issue de l’agrriculture biologique, dnt le mode                            de production et de transformation sont respectueux de l’environnement, du bien-etre animal et de la biodiversité.                            l’Arkadia restaurant vous propose une cuisine rafinée et authentique. de l’entrée au desert,                             chaque plat est une invitation à un voyage gustatif.', '../assets/images/services/restaurant.png'),
(2, 'Visite guidée', 'Partez en compagnie d’un guide pédagogique à la découverte des habitats du zoo.l’occasion exceptionnel de s’aprocher au plus prés de créatures extrordinaires.                          une experience inoubliable s’offre à vous.Voici le programme de la Visite Guidée : À 13h30, rendez-vous à l’entrée principale pour commencer votre expérience. À 13h45, le départ de la visite guidée se fera en compagnie d’un animateur-soigneur qui                           partagera son savoir et de nombreuses anecdotes sur le parc et ses animaux.                            Vous parcourrez l’ensemble des habitats et rencontrerez leurs habitants. La visite se terminera à 15h45.', '../assets/images/services/visite_guidee.png'),
(3, 'Visite du zoo en petit train', 'L’arkadia train n’est pas seulement une douce promenade; tout en admirant les merveilles de la nature, des commentaires enrichissant seront la pour vous accompagnés tout au long de votre voyage .vous cheminerai dans de vastes espaces, vous apprecherez au plus prés des cerfs, lions, tigres, bisons... qui évoluent en semi liberté.                            Un voyage enchanteur à travers la nature vous attend, idéal pour toute la famille.                           où chaque virage révèle de près des animaux fascinants et des paysages exotiques !', '../assets/images/services/petit_train.png');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `username`, `email`, `password`, `prenom`, `nom`, `role_id`) VALUES
(1, 'userPhilipe', 'philipe_Arkadia2024@admin', '$2y$10$GipCxU.e6mzeO99b9Y0vr.ejfgG71KVcYbjdG3FaYfb2TUfYSkEga', 'philipe', 'delroy', 1),
(2, 'userMathieu', 'mathieu_Arkadia@veterinaire', '$2y$10$WadoKB8Ohl7sksfNqe.2ke/cJrbYCPnfagnSsGthAiQ9SttqgQGZ.', 'mathieu', 'phati', 2),
(3, 'userLisa', 'joseArkadiaZoo@gmail.com', '$2y$10$IXuClrwvsJNPbkC/bQeqGuTXL.ezmEFBK9iwUzB/FR1lzmH.tSvVq', 'lisa', 'rochet', 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `alimentation`
--
ALTER TABLE `alimentation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_animal` (`id_animal`);

--
-- Index pour la table `animaux`
--
ALTER TABLE `animaux`
  ADD PRIMARY KEY (`id`),
  ADD KEY `habitat_id` (`habitat_id`);

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- Index pour la table `commentaire_habitat`
--
ALTER TABLE `commentaire_habitat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`),
  ADD KEY `habitat_id` (`habitat_id`);

--
-- Index pour la table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `habitats`
--
ALTER TABLE `habitats`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rapport_veterinaire`
--
ALTER TABLE `rapport_veterinaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilisateur_id` (`utilisateur_id`),
  ADD KEY `animal_id` (`animal_id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id_service`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_utilisateur_role` (`role_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `alimentation`
--
ALTER TABLE `alimentation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `animaux`
--
ALTER TABLE `animaux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT pour la table `commentaire_habitat`
--
ALTER TABLE `commentaire_habitat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `habitats`
--
ALTER TABLE `habitats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `rapport_veterinaire`
--
ALTER TABLE `rapport_veterinaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `alimentation`
--
ALTER TABLE `alimentation`
  ADD CONSTRAINT `alimentation_ibfk_1` FOREIGN KEY (`id_animal`) REFERENCES `animaux` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `animaux`
--
ALTER TABLE `animaux`
  ADD CONSTRAINT `animaux_ibfk_1` FOREIGN KEY (`habitat_id`) REFERENCES `habitats` (`id`);

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `commentaire_habitat`
--
ALTER TABLE `commentaire_habitat`
  ADD CONSTRAINT `commentaire_habitat_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `commentaire_habitat_ibfk_2` FOREIGN KEY (`habitat_id`) REFERENCES `habitats` (`id`);

--
-- Contraintes pour la table `rapport_veterinaire`
--
ALTER TABLE `rapport_veterinaire`
  ADD CONSTRAINT `rapport_veterinaire_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `rapport_veterinaire_ibfk_2` FOREIGN KEY (`animal_id`) REFERENCES `animaux` (`id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `fk_utilisateur_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 05 nov. 2021 à 12:28
-- Version du serveur :  5.7.24
-- Version de PHP : 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tchat`
--

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE `conversation` (
  `conversation_id` int(11) NOT NULL,
  `last_message_id` int(11) DEFAULT NULL,
  `conv_img` longblob,
  `conv_name` varchar(25) NOT NULL,
  `conv_desc` varchar(100) DEFAULT NULL,
  `conv_private` tinyint(1) NOT NULL,
  `conv_pswd` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `conversation`
--

INSERT INTO `conversation` (`conversation_id`, `last_message_id`, `conv_img`, `conv_name`, `conv_desc`, `conv_private`, `conv_pswd`) VALUES
(1, NULL, NULL, 'SCORD', 'Groupe Scord', 0, NULL),
(2, NULL, NULL, 'Spam', 'oooooooooooo', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `conversation_id` int(11) DEFAULT NULL,
  `content` longtext NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`message_id`, `user_id`, `conversation_id`, `content`, `created_at`) VALUES
(15, 2, 1, 'Salut l\'ami', '2021-11-04 15:21:25'),
(16, 1, 1, 'Salut à toi', '2021-11-04 15:22:06'),
(46, 1, 1, 'Comment tu vas ?', '2021-11-04 16:06:58'),
(47, 2, 1, 'Très bien et toi ?', '2021-11-05 10:34:32'),
(48, 3, 2, 'Eh', '2021-11-05 11:03:53'),
(49, 3, 1, 'Eh !!', '2021-11-05 11:11:06');

-- --------------------------------------------------------

--
-- Structure de la table `participant`
--

CREATE TABLE `participant` (
  `participant_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `conversation_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `participant`
--

INSERT INTO `participant` (`participant_id`, `user_id`, `conversation_id`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `profile`
--

CREATE TABLE `profile` (
  `id_profile` int(11) NOT NULL,
  `pseudo` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` longblob,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `profile`
--

INSERT INTO `profile` (`id_profile`, `pseudo`, `age`, `gender`, `location`, `avatar`, `description`, `user_id`) VALUES
(1, 'ALEXIS', 21, 'Homme', 'Marseille', 0x4261636b20477265792e6a7067, 'Bonjour à tous, ceci est ma description.', 1),
(2, 'Elon Musk', 35, 'Non précisé', 'Larochelle', 0x656c6f6e2d6d75736b2d636f6e74696e75652d64652d732d61666669636865722d656e2d706172746973616e2d64752d626974636f696e2e6a7067, 'Je suis le créateur', 2),
(3, NULL, NULL, NULL, NULL, NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `pswd` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token_conf` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token_reset` int(60) DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL,
  `date_reset` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `pswd`, `roles`, `token_conf`, `token_reset`, `date_creation`, `date_reset`) VALUES
(1, 'Alexis', 'alexis.paneri@hotmail.fr', '$2y$10$GEzEeCerOzLc1xK4d4chGun9IWWbW7Hdkg0fuyCLFs8BHSd49uV2O', 'membre', NULL, NULL, '2021-10-27 09:38:08', NULL),
(2, 'Elon', 'elon@gmail.com', '$2y$10$JwsQRZEy9jJO4eO3bx56c.mErvfl7YGOTxtedPzG.gc9qsm4qp4Mm', 'membre', NULL, NULL, '2021-11-02 14:29:08', NULL),
(3, 'Marie', 'marie@gmail.com', '$2y$10$pWnSJqc9fxgute66dRDWx.Gr2CcblAdxYXMbKxf09MVVSJY.j9vva', 'membre', NULL, NULL, '2021-11-05 11:03:41', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`conversation_id`),
  ADD UNIQUE KEY `UNIQ_8A8E26E9BA0E79C3` (`last_message_id`) USING BTREE,
  ADD UNIQUE KEY `last_message_id_index` (`last_message_id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `created_at_index` (`created_at`) USING BTREE,
  ADD KEY `IDX_B6BD307F9AC0396` (`conversation_id`) USING BTREE,
  ADD KEY `IDX_B6BD307FA76ED395` (`user_id`) USING BTREE;

--
-- Index pour la table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`participant_id`),
  ADD KEY `IDX_D79F6B11A76ED395` (`user_id`) USING BTREE,
  ADD KEY `IDX_D79F6B119AC0396` (`conversation_id`) USING BTREE;

--
-- Index pour la table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id_profile`),
  ADD KEY `id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `conversation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `participant`
--
ALTER TABLE `participant`
  MODIFY `participant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `profile`
--
ALTER TABLE `profile`
  MODIFY `id_profile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD CONSTRAINT `conversation_ibfk_1` FOREIGN KEY (`last_message_id`) REFERENCES `message` (`message_id`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`conversation_id`) REFERENCES `conversation` (`conversation_id`);

--
-- Contraintes pour la table `participant`
--
ALTER TABLE `participant`
  ADD CONSTRAINT `participant_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `participant_ibfk_2` FOREIGN KEY (`conversation_id`) REFERENCES `conversation` (`conversation_id`);

--
-- Contraintes pour la table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

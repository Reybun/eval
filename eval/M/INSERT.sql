-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 06 jan. 2019 à 20:00
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `evalbdd`
--

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `picture`) VALUES
(1, 'yann', 'mail@user.fr', '$2y$10$hDbPgS53MmdRVSSkdvohM.RpZ49K90jygNCrB36dVb1YxqtLhN9rC', 'https://media1.tenor.com/images/c9fd3f5ad87f9c9ae12a8e70aa0d14a5/tenor.gif?itemid=9639526');
--
-- Déchargement des données de la table `fiche_consult`
--

INSERT INTO `fiche_consult` (`id`, `resume`, `type`, `place`, `protocole`, `pathologie`, `resultat`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '', '  ', '  ', '  ', '', '  '),
(4, NULL, NULL, NULL, NULL, NULL, NULL),
(5, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Rien de special', 'rdv hebdo', ' ', 'Chatouille', 'Aucune', 'Aucun');

--
-- Déchargement des données de la table `responsable`
--

INSERT INTO `responsable` (`id`, `nom`, `prenom`, `numero`, `mail`, `adresse`, `modevie`, `alimentation`, `code_postal`) VALUES
(1, 'Nomdupatient', 'Michelle', '0932766555', 'patient1@mail.fr', '13 avenue du client', 'sédentaire', 'de tout', 86000),
(2, 'Labeille', 'Mireille', '0632766568', 'michelle@mail.fr', 'Avenue du chien', 'Chien de maison', 'Croquette BIO sans gluten', 93000);

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id`, `name`, `prenom`, `adresse`, `code_postal`, `mail`, `datebirth`, `tel`, `statut`, `responsable_id`) VALUES
(1, 'Nomdejean', 'Jean', '13 avenue du client', 86000, 'patient1@mail.fr', '1973-01-06', '0932766555', 'humain', 1),
(2, 'andre', 'Alex', '90 rue de la tour', 90500, 'email@a.fr', '1995-01-20', '0680324691', 'humain', 1),
(3, 'Woof', 'Douki', 'Avenue du chien', 93000, 'michelle@mail.fr', '2011-01-06', '0632766568', 'animal', 2);

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`id`, `photo`, `fiche_consult_id`) VALUES
(1, 'images (1).jpg', 6),
(2, '2leggedCat.jpg', 6),
(3, 'tumblr_static_tumblr_static__640.jpg', 3);

--
-- Déchargement des données de la table `rdv`
--

INSERT INTO `rdv` (`id`, `time`, `date`, `description`, `patient_id`, `fiche_consult_id`) VALUES
(1, '09:30:00', '2019-01-07', 'Mal de dents\r\n', 3, 1),
(2, '12:00:00', '2019-01-07', 'Deprime', 2, 2),
(3, '09:00:00', '2019-01-09', 'Mal de ventre post raclette', 1, 3),
(4, '06:30:00', '2019-01-18', 'vaccin', 3, 4),
(5, '11:30:00', '2019-01-20', 'Plus dinspiration', 2, 5),
(6, '18:00:00', '2019-01-06', 'mal de tete a cause de l\'eval\r\n', 1, 6);


--
-- Déchargement des données de la table `specialite`
--

INSERT INTO `specialite` (`id`, `nom`, `tarif seance`) VALUES
(1, 'sophrologie', 30),
(2, 'shiatsuki', 40),
(3, 'hypnose', 30),
(4, 'acuponcture', 40);

--
-- Déchargement des données de la table `specialite_has_user`
--

INSERT INTO `specialite_has_user` (`id`, `specialite_id`, `user_id`) VALUES
(1, 1, 1);



--
-- Déchargement des données de la table `user_has_rdv`
--

INSERT INTO `user_has_rdv` (`id`, `user_id`, `rdv_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 19 juin 2020 à 20:15
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `hospitalisations`
--

CREATE TABLE `hospitalisations` (
  `id` int(11) NOT NULL,
  `dateentree` date NOT NULL,
  `datesortie` date NOT NULL,
  `raisonmedicale` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idpatient` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `hospitalisations`
--

INSERT INTO `hospitalisations` (`id`, `dateentree`, `datesortie`, `raisonmedicale`, `idpatient`) VALUES
(1, '2020-03-17', '2020-04-08', 'Opération de l\'intestin', 1),
(2, '2019-11-19', '2020-03-10', 'Opération du genou', 1),
(3, '2020-01-28', '2020-06-09', 'Grippe', 2),
(4, '2020-04-22', '2020-02-10', 'Opération du coeur', 2),
(5, '2020-06-23', '2020-06-27', 'Opération de la rate', 3),
(6, '2020-04-06', '2020-06-03', 'Grippe', 3),
(7, '2019-07-22', '2019-09-18', 'Opération du genou', 4),
(8, '2020-06-17', '2020-06-26', 'Autre opération', 4),
(9, '2019-12-20', '2019-12-17', 'Opération du foie', 5),
(10, '2019-10-14', '2020-03-17', 'Angine', 5),
(11, '2019-10-07', '2019-11-05', 'Opération de l\'intestin', 7),
(12, '2020-03-09', '2020-05-13', 'Grippe', 7),
(13, '2020-01-28', '2020-06-03', 'Angine', 8),
(14, '2020-02-26', '2020-05-28', 'Opération grain de beauté', 8),
(15, '2020-01-06', '2020-04-15', 'Opération de l\'oreille', 9),
(16, '2019-11-12', '2020-04-29', 'Opération colonne vertébrale', 9),
(17, '2020-01-06', '2020-05-12', 'Opération de l\'auriculaire', 10),
(18, '2019-11-19', '2020-05-12', 'Grippe', 10);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `hospitalisations`
--
ALTER TABLE `hospitalisations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `hospitalisations`
--
ALTER TABLE `hospitalisations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 19 juin 2020 à 20:16
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
-- Structure de la table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `idmedecin` int(10) NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datenaissance` date NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codepostal` int(5) NOT NULL,
  `taille` float NOT NULL,
  `poids` float NOT NULL,
  `groupesanguin` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `frequencecardiaque` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `patients`
--

INSERT INTO `patients` (`id`, `idmedecin`, `nom`, `prenom`, `sexe`, `datenaissance`, `email`, `telephone`, `mobile`, `adresse`, `ville`, `codepostal`, `taille`, `poids`, `groupesanguin`, `frequencecardiaque`) VALUES
(1, 1, 'Boyer', 'Jamie', 'Femme', '1935-02-10', 'JamieRBoyer@rhyta.com', '0320463678', '0118463678', '92, rue Grande Fusterie', 'BRÉTIGNY-SUR-ORGE', 91220, 1.5, 77.1, 'B-', 95),
(2, 1, 'Banks', 'James', 'Homme', '1963-03-17', 'JamesRBanks@jourrapide.com', '0320456739', '0645789423', '8, rue Beauvau', 'MARSEILLE', 13001, 1.87, 89.2, 'A+', 96),
(3, 1, 'Castro', 'Thomas J. ', 'Homme', '1949-11-09', 'ThomasJCastro@dayrep.com', '0320164769', '0654321699', '59, Place de la Madeleine', 'PARIS', 75009, 1.63, 91.6, 'O+', 97),
(4, 1, 'Farrell', 'Amanda M. ', 'Femme', '1969-10-08', 'AmandaMFarrell@teleworm.us', '0320164557', '0613524778', '22, rue du Château', 'SAINT-ÉTIENNE', 42100, 1.57, 75, 'O-', 99),
(5, 1, 'Wilton', 'Brenda A. ', 'Femme', '1961-12-22', 'BrendaAWilton@teleworm.us', '0320164758', '0613245773', '54, rue Banaudon', 'LYON', 69009, 1.56, 65.3, 'A-', 86),
(6, 1, 'McColl', 'Thurman C. ', 'Homme', '1942-03-27', 'ThurmanCMcColl@armyspy.com', '0320164576', '0613245777', '90, rue Cazade', 'DUNKERQUE', 59140, 1.95, 90.4, 'B+', 93),
(7, 2, 'Folger', 'Jean-Michel', 'Homme', '1982-12-24', 'BruceBFolger@teleworm.us', '0320164753', '0651342289', '29, avenue de l\'Amandier ', 'BOBIGNY', 93000, 1.53, 103.9, 'B+', 93),
(8, 2, 'McKellar   ', 'Alison M. ', 'Femme', '1953-12-05', 'AlisonMMcKellar@armyspy.com', '0320431647', '0654319875', '23, avenue de Bouvines', 'SCHOELCHER', 97233, 1.72, 61.3, 'AB', 93),
(9, 2, 'Guzman', 'Tanguy', 'Homme', '1975-06-12', 'RichardMGuzman@teleworm.us', '0320457877', '0643124478', '63, Chemin Du Lavarin Sud  ', 'CALAIS', 62100, 2.02, 53.2, 'O-', 42),
(10, 2, 'Husk ', 'Jean-Luc', 'Homme', '1976-05-01', 'JamesDHusk@dayrep.com', '0320164755', '0643124577', '21, rue Ernest Renan  ', 'CHELLES', 77500, 1.86, 93.4, 'A+', 90);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

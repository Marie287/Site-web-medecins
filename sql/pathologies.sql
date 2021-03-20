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
-- Structure de la table `pathologies`
--

CREATE TABLE `pathologies` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idpatient` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pathologies`
--

INSERT INTO `pathologies` (`id`, `nom`, `idpatient`) VALUES
(1, 'Hypertension artérielle', 1),
(2, 'Athme chronique', 1),
(3, 'Hypoglycémie', 2),
(4, 'Cancer du côlon', 2),
(5, 'Acné', 3),
(6, 'Eczéma', 3),
(7, 'Psoriasis', 4),
(8, 'Cholestérol', 4),
(9, 'Hypertension artérielle', 5),
(10, 'Acné', 5),
(11, 'Hypertension artérielle', 6),
(12, 'Athme chronique', 6),
(13, 'Eczéma', 7),
(14, 'Toux', 7),
(15, 'Insomnie', 8),
(16, 'Cancer du foie', 8),
(17, 'Hémorroïdes', 9),
(18, 'Constipation', 9),
(19, 'Acné', 10),
(20, 'Allergies', 10);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pathologies`
--
ALTER TABLE `pathologies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pathologies`
--
ALTER TABLE `pathologies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

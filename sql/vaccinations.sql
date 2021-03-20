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
-- Structure de la table `vaccinations`
--

CREATE TABLE `vaccinations` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `vaccin` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dose` float NOT NULL,
  `idpatient` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `vaccinations`
--

INSERT INTO `vaccinations` (`id`, `date`, `vaccin`, `dose`, `idpatient`) VALUES
(1, '2019-09-10', 'BCG', 0.1, 1),
(2, '2020-04-06', 'Méningite', 0.1, 1),
(3, '2019-12-10', 'Hépatite B', 0.5, 2),
(4, '2019-12-10', 'Hépatite C', 0.5, 2),
(5, '2019-11-19', 'Coqueluche', 0.2, 3),
(6, '2019-10-15', 'Méningocoque', 0.2, 3),
(7, '2019-11-12', 'BCG', 0.2, 4),
(8, '2020-01-15', 'Hépatite B', 0.1, 4),
(9, '2019-12-16', 'Hépatite B', 0.3, 5),
(10, '2020-01-07', 'BCG', 0.3, 5),
(11, '2019-09-09', 'BCG', 0.2, 7),
(12, '2020-06-08', 'Méningite', 0.1, 7),
(13, '2020-02-10', 'Hépatite B', 0.3, 8),
(14, '2020-02-13', 'Coqueluche', 0.2, 8),
(15, '2020-03-17', 'Rougeole', 0.5, 9),
(16, '2020-02-18', 'Rubéole', 0.1, 9),
(17, '2020-03-18', 'BCG', 0.2, 10),
(18, '2020-02-04', 'Hépatite B', 0.5, 10);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `vaccinations`
--
ALTER TABLE `vaccinations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `vaccinations`
--
ALTER TABLE `vaccinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

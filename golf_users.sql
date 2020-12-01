-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 01 dec 2020 om 11:25
-- Serverversie: 8.0.21
-- PHP-versie: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `golf`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `golf_users`
--

DROP TABLE IF EXISTS `golf_users`;
CREATE TABLE IF NOT EXISTS `golf_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `handicap` float(3,1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `golf_users`
--

INSERT INTO `golf_users` (`id`, `name`, `gender`, `handicap`) VALUES
(26, 'Leon', 'm', 18.4),
(25, 'Ruud', 'm', 44.0),
(24, 'Bram', 'm', 23.2),
(23, 'Jan', 'm', 26.5),
(22, 'Sylvia', 'f', 29.2),
(21, 'Peter', 'm', 23.8),
(20, 'Michiel', 'm', 24.6),
(19, 'George', 'm', 25.5),
(18, 'Arno', 'm', 22.8),
(27, 'Bart', 'm', 24.9),
(28, 'Ornella', 'f', 39.0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

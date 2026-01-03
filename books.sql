-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Čtv 18. pro 2025, 09:33
-- Verze serveru: 10.1.28-MariaDB
-- Verze PHP: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `books`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `databaze`
--

CREATE TABLE `databaze` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `year_of_publication` year(4) NOT NULL,
  `info` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vypisuji data pro tabulku `databaze`
--

INSERT INTO `databaze` (`id`, `name`, `author`, `genre`, `year_of_publication`, `info`) VALUES
(1, 'The Hobbit', 'J. R. R. Tolkien', 'Fantasy', 1937, 1),
(2, '1984', 'George Orwell', 'Dystopian / Science fiction', 1949, 1),
(4, 'kdo vi', 'ja ne', 'Fantasy', 0000, 0),
(5, 'asdasda', 'dasdasd', 'Fantasy', 0000, 0),
(6, 'ahojda', 'Jirka Kral', 'Horor', 2001, 0);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `databaze`
--
ALTER TABLE `databaze`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `databaze`
--
ALTER TABLE `databaze`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

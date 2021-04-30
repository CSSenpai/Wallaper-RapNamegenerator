-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 29. Apr 2021 um 20:47
-- Server-Version: 10.1.35-MariaDB
-- PHP-Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `dbwall`
--
CREATE DATABASE IF NOT EXISTS `dbwall` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `dbwall`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES
(1, 'videogames'),
(2, 'NGE'),
(3, 'marvel'),
(4, 'landscape'),
(5, 'cute'),
(6, 'car'),
(7, 'animal'),
(8, 'abstact');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `name`
--

CREATE TABLE `name` (
  `nam_id` int(11) NOT NULL,
  `nam_letter` varchar(1) NOT NULL,
  `nam_name` varchar(255) NOT NULL,
  `nam_type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `name`
--

INSERT INTO `name` (`nam_id`, `nam_letter`, `nam_name`, `nam_type`) VALUES
(1, 'A', 'white', 0),
(2, 'B', 'black', 0),
(3, 'C', 'amazing', 0),
(4, 'D', 'useless', 0),
(5, 'E', 'holy', 0),
(6, 'F', 'kawaii', 0),
(7, 'G', 'big', 0),
(8, 'H', 'timid', 0),
(9, 'I', 'lovely', 0),
(10, 'J', 'psycic', 0),
(11, 'K', 'dead', 0),
(12, 'L', 'hot', 0),
(13, 'M', 'swedish', 0),
(14, 'N', 'british', 0),
(15, 'O', 'racist', 0),
(16, 'P', 'blue eyed white', 0),
(17, 'Q', 'my', 0),
(18, 'R', 'favorit', 0),
(19, 'S', 'lil', 0),
(20, 'T', 'small', 0),
(21, 'U', 'mad', 0),
(22, 'V', 'fatal', 0),
(23, 'W', 'dollar', 0),
(24, 'X', 'justice', 0),
(25, 'Y', 'young', 0),
(26, 'Z', 'Icy', 0),
(27, 'A', 'asian', 1),
(28, 'B', 'dd', 1),
(29, 'C', 'obama', 1),
(30, 'D', 'employee', 1),
(31, 'E', 'boss', 1),
(32, 'F', 'daddy', 1),
(33, 'G', 'mommy', 1),
(34, 'H', 'oppai', 1),
(35, 'I', 'otaku', 1),
(36, 'J', 'rider', 1),
(37, 'K', 'jesus', 1),
(38, 'L', 'god', 1),
(39, 'M', 'alien', 1),
(40, 'N', 'joe', 1),
(41, 'O', 'mp3 player', 1),
(42, 'P', 'phone case', 1),
(43, 'Q', 'psycic', 1),
(44, 'R', 'goku', 1),
(45, 'S', 'girl', 1),
(46, 'T', 'granny', 1),
(47, 'U', 'rider', 1),
(48, 'V', 'punch', 1),
(49, 'W', 'gravy', 1),
(50, 'X', 'grip', 1),
(51, 'Y', 'butter', 1),
(52, 'Z', 'curves', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `usr_id` int(11) NOT NULL,
  `usr_name` varchar(255) NOT NULL,
  `usr_email` varchar(255) NOT NULL,
  `usr_password` varchar(255) NOT NULL,
  `usr_auth` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`usr_id`, `usr_name`, `usr_email`, `usr_password`, `usr_auth`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$KyOT.HrjgQxbmoZnlQUT0ua.OtNRXl0UKiIdJ44ncyqxWpgGcny9i', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wallpapers`
--

CREATE TABLE `wallpapers` (
  `wal_id` int(11) NOT NULL,
  `wal_name` varchar(255) NOT NULL,
  `wal_like` int(11) NOT NULL DEFAULT '0',
  `wal_dislike` int(11) NOT NULL DEFAULT '0',
  `wal_status` int(1) NOT NULL DEFAULT '0',
  `wal_creator_id` int(11) NOT NULL,
  `wal_img_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `wallpapers`
--

INSERT INTO `wallpapers` (`wal_id`, `wal_name`, `wal_like`, `wal_dislike`, `wal_status`, `wal_creator_id`, `wal_img_id`) VALUES
(1, 'Dont fall', 14, 1, 1, 1, 1),
(2, 'Emoji', 0, 1, 1, 1, 2),
(3, 'Pls send help', 0, 1, 1, 1, 3),
(4, 'Starshopping', 0, 0, 1, 1, 4),
(5, 'Pikachu', 0, 0, 1, 1, 5),
(6, 'Help', 0, 0, 1, 1, 6),
(7, 'Neko', 0, 0, 1, 1, 7),
(8, 'Musical Bunny', 0, 0, 1, 1, 8),
(9, 'Surely over 18', 0, 0, 1, 1, 9),
(10, 'Stairs', 0, 0, 1, 1, 10),
(11, 'Id die for you', 0, 0, 1, 1, 11),
(12, 'Good night', 0, 0, 1, 1, 12),
(13, 'I cant swim', 0, 0, 1, 1, 13),
(14, 'Im lost', 0, 0, 1, 1, 14),
(15, 'Spoiler: shes a clone', 0, 0, 1, 1, 15),
(16, 'Black panter', 0, 0, 1, 1, 16),
(17, 'Yukihama Yukinoshita', 0, 0, 1, 1, 17),
(18, 'Komi wa desu cute', 0, 0, 1, 1, 18),
(19, 'Triangle', 4, 2, 1, 1, 19),
(20, 'Wavey', 3, 1, 1, 1, 20),
(21, 'Pulse', 1, 0, 1, 1, 21),
(22, 'Square', 0, 1, 1, 1, 22),
(23, 'Jesus Whip', 0, 0, 1, 1, 23),
(24, 'McLaren Senna', 0, 0, 1, 1, 24),
(25, 'Car', 0, 0, 1, 1, 25),
(26, 'Better than Mustang', 0, 0, 1, 1, 26),
(27, 'Steel Man', 0, 0, 1, 1, 27),
(28, 'DC', 0, 0, 1, 1, 28),
(29, 'Shrek and gang', 0, 0, 1, 1, 29),
(30, 'BLM', 0, 0, 1, 1, 30),
(31, 'Among us', 0, 0, 1, 1, 31),
(32, 'Ass Ceed', 0, 0, 1, 1, 32),
(33, '1000$ WHY', 0, 0, 1, 1, 33),
(34, 'NSFW', 0, 0, 1, 1, 34);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wallpaper_has_category`
--

CREATE TABLE `wallpaper_has_category` (
  `has_wal_id` int(11) NOT NULL,
  `has_kat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `wallpaper_has_category`
--

INSERT INTO `wallpaper_has_category` (`has_wal_id`, `has_kat_id`) VALUES
(19, 8),
(20, 8),
(21, 8),
(22, 8),
(5, 7),
(7, 7),
(8, 7),
(16, 7),
(23, 6),
(24, 6),
(25, 6),
(26, 6),
(2, 5),
(4, 5),
(6, 5),
(9, 5),
(17, 5),
(18, 5),
(1, 4),
(10, 4),
(13, 4),
(14, 4),
(27, 3),
(28, 3),
(29, 3),
(30, 3),
(3, 2),
(11, 2),
(12, 2),
(15, 2),
(31, 1),
(32, 1),
(33, 1),
(34, 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indizes für die Tabelle `name`
--
ALTER TABLE `name`
  ADD PRIMARY KEY (`nam_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usr_id`);

--
-- Indizes für die Tabelle `wallpapers`
--
ALTER TABLE `wallpapers`
  ADD PRIMARY KEY (`wal_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `name`
--
ALTER TABLE `name`
  MODIFY `nam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `wallpapers`
--
ALTER TABLE `wallpapers`
  MODIFY `wal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

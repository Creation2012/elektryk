-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 27 Lis 2019, 20:16
-- Wersja serwera: 10.4.6-MariaDB
-- Wersja PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `id11549344_quartack`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

CREATE TABLE `category` (
  `category_id` int(11) UNSIGNED NOT NULL,
  `category_name` varchar(60) NOT NULL DEFAULT '',
  `category_description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_description`) VALUES
(1, 'Grafika', '3d, rastrowa, wektorowa'),
(2, 'Strony internetowe', 'php, js, jquery i inne'),
(3, 'Aplikacje', 'wszystko');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `chat`
--

CREATE TABLE `chat` (
  `id_nadawca` int(11) DEFAULT NULL,
  `id_odbiorca` int(11) DEFAULT NULL,
  `send_time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `etat`
--

CREATE TABLE `etat` (
  `etat_id` int(11) UNSIGNED NOT NULL,
  `etat_name` varchar(60) NOT NULL DEFAULT '',
  `etat_podst` decimal(7,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `etat`
--

INSERT INTO `etat` (`etat_id`, `etat_name`, `etat_podst`) VALUES
(1, 'Grafik', '1000.00'),
(2, 'Programista', '2000.00'),
(3, 'Administrator baz danych', '1500.00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `project`
--

CREATE TABLE `project` (
  `project_id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `project_income` decimal(7,2) NOT NULL DEFAULT 0.00,
  `project_name` varchar(80) NOT NULL DEFAULT '',
  `project_description` mediumtext DEFAULT '',
  `project_start` datetime NOT NULL,
  `project_end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `project`
--

INSERT INTO `project` (`project_id`, `category_id`, `project_income`, `project_name`, `project_description`, `project_start`, `project_end`) VALUES
(1, 1, '10000.00', '3D Model mojej waifu', 'prosze o staranne wykonanie', '2019-11-27 00:00:00', '0000-00-00 00:00:00'),
(2, 1, '100.00', 'Rysunek smoka', 'poszukiwany jakub s', '2019-11-27 14:45:19', '0000-00-00 00:00:00'),
(3, 2, '99999.99', 'Panel Projektow', 'potrzebny na tokaja, bo nie mamy czasu robic', '2019-11-27 14:45:19', '0000-00-00 00:00:00'),
(4, 2, '10000.00', 'andrzej-nowak.cba.pl', 'remaster legenradnej strony', '2019-11-27 14:45:19', '0000-00-00 00:00:00'),
(5, 3, '99999.00', 'Gierka PACMAN', 'w VR', '2019-11-27 14:45:19', '0000-00-00 00:00:00'),
(6, 3, '50000.00', 'Trash-world', 'najbliższy śmietnik w twojej okolicy', '2019-11-27 14:45:19', '0000-00-00 00:00:00'),
(7, 1, '2500.00', 'Teeworlds', 'skiny do teeworlds, na gotowej templatce', '2019-11-27 18:09:26', '0000-00-00 00:00:00'),
(8, 2, '15000.00', 'strona dla dorosłych', 'więcej informacji na email mateusz.jasinski@o2.pl', '2019-11-27 18:09:26', '0000-00-00 00:00:00'),
(9, 3, '10000.00', 'Kuni (Original Series)', 'novelka', '2019-11-27 18:09:26', '0000-00-00 00:00:00'),
(10, 3, '5300.00', 'Aplikacja dla Komputronika', 'aplikacja napisana a javie do zliczania towaru', '2019-11-27 18:09:26', '0000-00-00 00:00:00'),
(11, 1, '1000.00', 'Obraz kunieczki (pixelart)', 'obraz wykonany metodą pixelart', '2019-11-27 18:09:26', '0000-00-00 00:00:00'),
(12, 2, '6000.00', 'Broń drzewcowa', 'broń drzewna', '2019-11-27 18:09:26', '0000-00-00 00:00:00'),
(13, 1, '7000.00', 'Asset Poleaxe 3D', 'replika 1:1', '2019-11-27 18:09:26', '0000-00-00 00:00:00'),
(14, 2, '9995.00', 'Strona fanowska Realu Madryt', 'que?', '2019-11-27 18:09:26', '0000-00-00 00:00:00'),
(15, 3, '5000.00', 'AOTR: updater', 'bo nikt nie umie', '2019-11-27 18:09:26', '0000-00-00 00:00:00');

--
-- Wyzwalacze `project`
--
DELIMITER $$
CREATE TRIGGER `project_start` BEFORE INSERT ON `project` FOR EACH ROW BEGIN
	SET NEW.project_start = NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `project_handler`
--

CREATE TABLE `project_handler` (
  `project_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `task_id` int(11) UNSIGNED DEFAULT NULL,
  `start_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `task`
--

CREATE TABLE `task` (
  `task_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `complete` tinyint(1) NOT NULL DEFAULT 0,
  `task_name` varchar(85) NOT NULL DEFAULT '',
  `task_description` mediumtext DEFAULT NULL,
  `task_start` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `task_end` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Wyzwalacze `task`
--
DELIMITER $$
CREATE TRIGGER `task_start` BEFORE INSERT ON `task` FOR EACH ROW BEGIN
	SET NEW.task_start = NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `user_verifyEmail` tinyint(1) NOT NULL DEFAULT 0,
  `user_type` tinyint(1) NOT NULL DEFAULT 0,
  `user_active` tinyint(1) NOT NULL DEFAULT 1,
  `user_firstname` varchar(45) NOT NULL DEFAULT '',
  `user_lastname` varchar(45) NOT NULL DEFAULT '',
  `user_email` varchar(80) NOT NULL DEFAULT '',
  `user_password` varchar(40) NOT NULL DEFAULT '',
  `user_hash` varchar(80) DEFAULT '',
  `user_phone` varchar(25) DEFAULT NULL,
  `user_path` varchar(255) DEFAULT NULL,
  `user_created` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `user_modified` datetime DEFAULT NULL,
  `etat_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`user_id`, `user_verifyEmail`, `user_type`, `user_active`, `user_firstname`, `user_lastname`, `user_email`, `user_password`, `user_hash`, `user_phone`, `user_path`, `user_created`, `user_modified`, `etat_id`) VALUES
(1, 1, 0, 1, 'Bartosz', 'Szkuta', 'bartosz@szkuta.pl', 'e0ff6fbc09d8295c5989fbf1118e3aee6797ab7e', '2a21bec96f1e2fdc2a3f8d37864892593c23b2ae', NULL, NULL, '2019-11-27 19:17:44', '2019-11-27 19:50:00', NULL),
(2, 0, 0, 1, 'Arkadiusz', 'Bojtek', 'arek@bojtek.pl', '3a3d752aeed7d701ce658f8fe2095ba444097a24', '87b5e6ad19eeb54c2013223b2176a24a5c6b2c12', NULL, NULL, '2019-11-27 19:19:14', NULL, NULL);

--
-- Wyzwalacze `user`
--
DELIMITER $$
CREATE TRIGGER `user_created` BEFORE INSERT ON `user` FOR EACH ROW SET NEW.user_created = NOW()
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `user_id_autoincrement` BEFORE INSERT ON `user` FOR EACH ROW BEGIN
DECLARE x INT;
SET x = (SELECT user_id FROM user ORDER BY user_id DESC LIMIT 1);
	IF x IS NULL THEN
	SET NEW.user_id = 1;
    ELSE
    SET NEW.user_id = x+1;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `user_modified` BEFORE UPDATE ON `user` FOR EACH ROW SET NEW.user_modified = NOW()
$$
DELIMITER ;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeksy dla tabeli `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`etat_id`);

--
-- Indeksy dla tabeli `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeksy dla tabeli `project_handler`
--
ALTER TABLE `project_handler`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `task_id` (`task_id`);

--
-- Indeksy dla tabeli `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `etat_id` (`etat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `etat`
--
ALTER TABLE `etat`
  MODIFY `etat_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `project_handler`
--
ALTER TABLE `project_handler`
  ADD CONSTRAINT `project_handler_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_handler_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_handler_ibfk_3` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`etat_id`) REFERENCES `etat` (`etat_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

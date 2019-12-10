-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Gru 2019, 01:04
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
  `category_description` mediumtext NOT NULL,
  `color_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `id_nadawca` int(11) DEFAULT NULL,
  `id_odbiorca` int(11) DEFAULT NULL,
  `message` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `send_time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Wyzwalacze `chat`
--
DELIMITER $$
CREATE TRIGGER `set_send_time` BEFORE INSERT ON `chat` FOR EACH ROW SET NEW.send_time = NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `color`
--

CREATE TABLE `color` (
  `color_name` varchar(30) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `project`
--

CREATE TABLE `project` (
  `project_id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `max_user` int(3) NOT NULL,
  `project_income` decimal(7,2) NOT NULL DEFAULT 0.00,
  `project_name` varchar(80) NOT NULL DEFAULT '',
  `project_description` mediumtext DEFAULT '',
  `project_start` datetime NOT NULL,
  `project_end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Wyzwalacze `project`
--
DELIMITER $$
CREATE TRIGGER `insert_into_handler` AFTER INSERT ON `project` FOR EACH ROW INSERT INTO project_handler (project_id) VALUES (NEW.project_id)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `project_id_autoincrement` BEFORE INSERT ON `project` FOR EACH ROW BEGIN
DECLARE x INT;
SET x = (SELECT project_id FROM project ORDER BY project_id DESC LIMIT 1);
	IF x IS NULL THEN
	SET NEW.project_id = 1;
    ELSE
    SET NEW.project_id = x+1;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `project_handler`
--

CREATE TABLE `project_handler` (
  `id` int(11) NOT NULL,
  `project_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `task_id` int(11) UNSIGNED DEFAULT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `start_time` datetime NOT NULL,
  `end_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Wyzwalacze `project_handler`
--
DELIMITER $$
CREATE TRIGGER `start_time_now` BEFORE INSERT ON `project_handler` FOR EACH ROW SET NEW.start_time = NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `task`
--

CREATE TABLE `task` (
  `task_id` int(11) UNSIGNED NOT NULL,
  `task_category` int(11) NOT NULL,
  `task_name` varchar(85) NOT NULL DEFAULT '',
  `task_description` mediumtext DEFAULT NULL,
  `task_start` datetime NOT NULL,
  `task_end` datetime DEFAULT NULL
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
-- Struktura tabeli dla tabeli `task_category`
--

CREATE TABLE `task_category` (
  `task_category` int(11) NOT NULL,
  `category_name` varchar(50) COLLATE utf8_polish_ci DEFAULT NULL,
  `category_color` varchar(25) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `user_verifyEmail` tinyint(1) NOT NULL DEFAULT 0,
  `user_type` tinyint(1) NOT NULL DEFAULT 0,
  `user_firstname` varchar(45) NOT NULL DEFAULT '',
  `user_lastname` varchar(45) NOT NULL DEFAULT '',
  `user_email` varchar(80) NOT NULL DEFAULT '',
  `user_password` varchar(40) NOT NULL DEFAULT '',
  `user_hash` varchar(80) DEFAULT '',
  `user_phone` varchar(25) DEFAULT NULL,
  `user_created` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `user_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_type`
--

CREATE TABLE `user_type` (
  `id` tinyint(1) DEFAULT NULL,
  `color` varchar(30) COLLATE utf8_polish_ci DEFAULT NULL,
  `type_name` varchar(30) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indeksy dla tabeli `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `task_category` (`task_category`);

--
-- Indeksy dla tabeli `task_category`
--
ALTER TABLE `task_category`
  ADD PRIMARY KEY (`task_category`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_verifyEmail` (`user_verifyEmail`);

--
-- Indeksy dla tabeli `user_type`
--
ALTER TABLE `user_type`
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `project_handler`
--
ALTER TABLE `project_handler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `task_category`
--
ALTER TABLE `task_category`
  MODIFY `task_category` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `project_handler_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `project_handler_ibfk_5` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `project_handler_ibfk_6` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`task_category`) REFERENCES `task_category` (`task_category`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `type` FOREIGN KEY (`user_verifyEmail`) REFERENCES `user_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

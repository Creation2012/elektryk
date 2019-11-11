-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 11 Lis 2019, 18:45
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
-- Baza danych: `projek2`
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
(1, 'testowa', 'tutaj testujemy xd');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `etat`
--

CREATE TABLE `etat` (
  `etat_id` int(11) UNSIGNED NOT NULL,
  `etat_name` varchar(60) NOT NULL DEFAULT '',
  `etat_podst` decimal(7,2) NOT NULL DEFAULT 0.00,
  `etat_dodat` decimal(7,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `etat`
--

INSERT INTO `etat` (`etat_id`, `etat_name`, `etat_podst`, `etat_dodat`) VALUES
(1, 'tester', '1000.00', '200.00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `project`
--

CREATE TABLE `project` (
  `project_id` int(11) UNSIGNED NOT NULL,
  `task_id` int(11) UNSIGNED NOT NULL,
  `project_name` varchar(100) NOT NULL DEFAULT '',
  `project_description` mediumtext NOT NULL DEFAULT '',
  `category_id` int(11) UNSIGNED NOT NULL,
  `project_start` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `project_end` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `project_income` decimal(7,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `project`
--

INSERT INTO `project` (`project_id`, `task_id`, `project_name`, `project_description`, `category_id`, `project_start`, `project_end`, `project_income`) VALUES
(1, 2, 'test', 'projekt testowy', 1, '2019-11-11 00:00:00', '0000-00-00 00:00:00', '0.00');

--
-- Wyzwalacze `project`
--
DELIMITER $$
CREATE TRIGGER `project_start` BEFORE INSERT ON `project` FOR EACH ROW BEGIN
	SET NEW.project_start = CURRENT_DATE();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `task`
--

CREATE TABLE `task` (
  `task_id` int(11) UNSIGNED NOT NULL,
  `task_name` varchar(85) NOT NULL DEFAULT '',
  `task_description` mediumtext NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `complete` tinyint(1) NOT NULL DEFAULT 0,
  `task_start` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `task_end` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `task`
--

INSERT INTO `task` (`task_id`, `task_name`, `task_description`, `user_id`, `complete`, `task_start`, `task_end`) VALUES
(2, 'testowe zadanie', 'zadanie ktore przetestuje cos', 2, 0, '2019-11-11 18:41:16', '0000-00-00 00:00:00');

--
-- Wyzwalacze `task`
--
DELIMITER $$
CREATE TRIGGER `task_start` BEFORE INSERT ON `task` FOR EACH ROW BEGIN
	SET NEW.task_start = CURRENT_TIME();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `task_time`
--

CREATE TABLE `task_time` (
  `task_id` int(10) UNSIGNED NOT NULL,
  `start` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `task_time`
--

INSERT INTO `task_time` (`task_id`, `start`, `end`) VALUES
(2, '2019-11-11 17:41:52', '0000-00-00 00:00:00');

--
-- Wyzwalacze `task_time`
--
DELIMITER $$
CREATE TRIGGER `task_time_start` BEFORE INSERT ON `task_time` FOR EACH ROW BEGIN
	SET NEW.start = CURRENT_TIMESTAMP();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `user_firstname` varchar(45) NOT NULL DEFAULT '',
  `user_lastname` varchar(45) NOT NULL DEFAULT '',
  `user_email` varchar(255) NOT NULL DEFAULT '',
  `user_password` varchar(255) NOT NULL DEFAULT '',
  `user_phone` varchar(25) NOT NULL DEFAULT '',
  `user_type` tinyint(1) NOT NULL DEFAULT 0,
  `user_active` tinyint(1) NOT NULL DEFAULT 0,
  `user_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_verifyEmail` tinyint(1) NOT NULL DEFAULT 0,
  `user_hash` varchar(32) NOT NULL,
  `etat_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`user_id`, `user_firstname`, `user_lastname`, `user_email`, `user_password`, `user_phone`, `user_type`, `user_active`, `user_created`, `user_modified`, `user_verifyEmail`, `user_hash`, `etat_id`) VALUES
(2, 'bartek', 'testowy', 'bartek@testowy.pl', 'haslo', '123456789', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '123abc', 1);

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
  ADD KEY `task_id` (`task_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indeksy dla tabeli `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `task_time`
--
ALTER TABLE `task_time`
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
  MODIFY `category_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `etat`
--
ALTER TABLE `etat`
  MODIFY `etat_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `project_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `task_time`
--
ALTER TABLE `task_time`
  ADD CONSTRAINT `task_time_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`etat_id`) REFERENCES `etat` (`etat_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

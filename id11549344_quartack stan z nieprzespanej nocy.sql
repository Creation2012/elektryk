-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 05 Gru 2019, 01:42
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

--
-- Zrzut danych tabeli `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `color_name`) VALUES
(1, 'Grafika', '3d, rastrowa, wektorowa', ''),
(2, 'Strony internetowe', 'php, js, jquery i inne', ''),
(3, 'Aplikacje', 'wszystko', '');

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

--
-- Zrzut danych tabeli `color`
--

INSERT INTO `color` (`color_name`) VALUES
('primary'),
('secondary'),
('success'),
('danger'),
('warning'),
('info'),
('light'),
('dark');

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
-- Zrzut danych tabeli `project`
--

INSERT INTO `project` (`project_id`, `category_id`, `max_user`, `project_income`, `project_name`, `project_description`, `project_start`, `project_end`) VALUES
(1, 1, 0, '1000.00', 'Testowy Projekt', '', '2019-12-04 00:00:00', '2019-12-05 00:00:00'),
(2, 3, 0, '2000.00', 'Testowy Projekt 2', '', '2019-12-05 00:00:00', '2019-12-06 00:00:00');

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
  `project_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `task_id` int(11) UNSIGNED DEFAULT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `project_handler`
--

INSERT INTO `project_handler` (`project_id`, `user_id`, `task_id`, `start_time`, `end_time`) VALUES
(1, NULL, NULL, '2019-12-03 23:05:07', '0000-00-00 00:00:00'),
(1, 2, 1, '2019-12-03 23:06:51', '0000-00-00 00:00:00'),
(1, 2, 2, '2019-12-03 23:08:02', '0000-00-00 00:00:00'),
(1, 3, 2, '2019-12-03 23:18:53', '0000-00-00 00:00:00'),
(2, NULL, NULL, '2019-12-03 23:20:56', '0000-00-00 00:00:00'),
(2, 2, NULL, '2019-12-03 23:21:55', '0000-00-00 00:00:00'),
(1, NULL, 2, '2019-12-03 23:22:59', '0000-00-00 00:00:00'),
(2, NULL, 1, '2019-12-03 23:23:11', '0000-00-00 00:00:00'),
(2, NULL, 2, '2019-12-03 23:23:24', '0000-00-00 00:00:00'),
(2, 4, NULL, '2019-12-03 23:23:44', '0000-00-00 00:00:00'),
(2, 5, NULL, '2019-12-03 23:24:01', '0000-00-00 00:00:00'),
(2, 7, NULL, '2019-12-03 23:24:11', '0000-00-00 00:00:00'),
(2, 9, NULL, '2019-12-03 23:24:20', '0000-00-00 00:00:00');

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
  `complete` tinyint(1) NOT NULL DEFAULT 0,
  `task_category` int(11) NOT NULL,
  `task_name` varchar(85) NOT NULL DEFAULT '',
  `task_description` mediumtext DEFAULT NULL,
  `task_start` datetime NOT NULL,
  `task_end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `task`
--

INSERT INTO `task` (`task_id`, `complete`, `task_category`, `task_name`, `task_description`, `task_start`, `task_end`) VALUES
(1, 0, 1, 'Test', NULL, '2019-12-01 17:35:24', '0000-00-00 00:00:00'),
(2, 0, 1, 'Test2', NULL, '2019-12-01 17:36:22', NULL);

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

--
-- Zrzut danych tabeli `task_category`
--

INSERT INTO `task_category` (`task_category`, `category_name`, `category_color`) VALUES
(1, 'test', 'primary');

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
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`user_id`, `user_verifyEmail`, `user_type`, `user_firstname`, `user_lastname`, `user_email`, `user_password`, `user_hash`, `user_phone`, `user_created`, `user_modified`) VALUES
(2, 0, 0, 'Arkadiusz', 'Bojtek', 'arek@bojtek.pl', '3a3d752aeed7d701ce658f8fe2095ba444097a24', '87b5e6ad19eeb54c2013223b2176a24a5c6b2c12', NULL, '2019-11-27 19:19:14', NULL),
(3, 0, 0, 'Bartosz', 'Szkuta', 'test@test.com', '3468041ADCABF30D7D29C3632456D8498F9F8A54', '1', NULL, '2019-12-01 17:09:17', '2019-12-01 21:54:28'),
(4, 1, 0, '', '', 'test@test1.com', '3468041ADCABF30D7D29C3632456D8498F9F8A54', '1', NULL, '2019-12-01 17:09:17', NULL),
(5, 2, 0, '', '', 'test@test2.com', '3468041ADCABF30D7D29C3632456D8498F9F8A54', '1', NULL, '2019-12-01 17:09:17', NULL),
(6, 3, 0, '', '', 'test@test3.com', '3468041ADCABF30D7D29C3632456D8498F9F8A54', '1', NULL, '2019-12-01 17:09:17', NULL),
(7, 4, 0, '', '', 'test@test4.com', '3468041ADCABF30D7D29C3632456D8498F9F8A54', '1', NULL, '2019-12-01 17:09:17', NULL),
(8, 5, 0, '', '', 'test@test5.com', '3468041ADCABF30D7D29C3632456D8498F9F8A54', '1', NULL, '2019-12-01 17:09:17', NULL),
(9, 6, 0, '', '', 'test@test6.com', '3468041ADCABF30D7D29C3632456D8498F9F8A54', '1', NULL, '2019-12-01 17:09:17', NULL),
(10, 7, 0, '', '', 'test@test7.com', '3468041ADCABF30D7D29C3632456D8498F9F8A54', '1', NULL, '2019-12-01 17:09:17', NULL);

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
-- Zrzut danych tabeli `user_type`
--

INSERT INTO `user_type` (`id`, `color`, `type_name`) VALUES
(0, 'light', 'Nie aktywowany'),
(1, 'dark', 'Nie przydzielon'),
(2, 'primary', 'Design'),
(3, 'secondary', 'Programista'),
(4, 'success', 'Tester'),
(5, 'danger', 'Admin'),
(6, 'info', 'Projektant'),
(7, 'warning', 'Lider');

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
  MODIFY `category_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT dla tabeli `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `task_category`
--
ALTER TABLE `task_category`
  MODIFY `task_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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

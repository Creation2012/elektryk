-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 01 Gru 2019, 17:14
-- Wersja serwera: 10.4.8-MariaDB
-- Wersja PHP: 7.3.11

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
(1, 1, '10000.00', '3D Model mojej waifu', 'prosze o staranne wykonanie', '2019-11-26 09:00:00', '2019-11-28 09:00:00'),
(2, 1, '100.00', 'Rysunek smoka', 'poszukiwany jakub s', '2019-11-27 14:45:19', '2019-12-02 00:00:00'),
(3, 2, '99999.99', 'Panel Projektow', 'potrzebny na tokaja, bo nie mamy czasu robic', '2019-11-27 14:45:19', '2019-12-06 00:00:00'),
(4, 2, '10000.00', 'andrzej-nowak.cba.pl', 'remaster legenradnej strony', '2019-11-27 14:45:19', '2019-11-28 09:00:00'),
(5, 3, '99999.00', 'Gierka PACMAN', 'w VR', '2019-11-27 14:45:19', '2019-11-28 09:00:00'),
(6, 3, '50000.00', 'Trash-world', 'najbliższy śmietnik w twojej okolicy', '2019-11-27 14:45:19', '2019-11-28 09:00:00'),
(8, 2, '15000.00', 'strona dla dorosłych', 'więcej informacji na email mateusz.jasinski@o2.pl', '2019-11-27 18:09:26', '2019-11-28 09:00:00'),
(9, 3, '10000.00', 'Kuni (Original Series)', 'novelka', '2019-11-27 18:09:26', '2019-11-28 09:00:00'),
(10, 3, '5300.00', 'Aplikacja dla Komputronika', 'aplikacja napisana a javie do zliczania towaru', '2019-11-27 18:09:26', '2019-11-28 09:00:00'),
(11, 1, '1000.00', 'Obraz kunieczki (pixelart)', 'obraz wykonany metodą pixelart', '2019-11-27 18:09:26', '2019-11-28 09:00:00'),
(12, 2, '6000.00', 'Broń drzewcowa', 'broń drzewna', '2019-11-27 18:09:26', '2019-11-28 09:00:00'),
(13, 1, '7000.00', 'Asset Poleaxe 3D', 'replika 1:1', '2019-11-27 18:09:26', '2019-11-28 09:00:00'),
(14, 2, '9995.00', 'Strona fanowska Realu Madryt', 'que?', '2019-11-27 18:09:26', '2019-11-28 09:00:00'),
(15, 3, '5000.00', 'AOTR: updater', 'bo nikt nie umie', '2019-11-27 18:09:26', '2019-11-28 09:00:00');

--
-- Wyzwalacze `project`
--
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

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

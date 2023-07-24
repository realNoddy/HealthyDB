-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 26. Jan 2022 um 02:39
-- Server-Version: 10.4.20-MariaDB
-- PHP-Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `vitamine`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `obst`
--

CREATE TABLE `obst` (
  `o_id` int(11) NOT NULL,
  `o_name` varchar(50) NOT NULL,
  `o_kalorien` int(11) NOT NULL,
  `o_fett` float NOT NULL,
  `o_zucker` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `obst`
--

INSERT INTO `obst` (`o_id`, `o_name`, `o_kalorien`, `o_fett`, `o_zucker`) VALUES
(1, 'Avocado', 160, 15, 0.7),
(2, 'Apfel', 52, 0.21, 10),
(3, 'Datteln', 282, 0.4, 63),
(4, 'Erdbeeren', 32, 0.3, 4.9),
(5, 'Mango', 65, 0.4, 12.8),
(6, 'Rosinen', 299, 0.5, 59),
(7, 'Limette', 30, 0.2, 1.7),
(8, 'Nektarine', 44, 0.3, 8),
(9, 'Pflaume', 46, 0.4, 38),
(10, 'Rhabarber', 20, 0.2, 1.1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `relation_obst_vitamine`
--

CREATE TABLE `relation_obst_vitamine` (
  `r_id` int(11) NOT NULL,
  `r_o_id` int(11) NOT NULL,
  `r_v_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `relation_obst_vitamine`
--

INSERT INTO `relation_obst_vitamine` (`r_id`, `r_o_id`, `r_v_id`) VALUES
(3, 2, 1),
(2, 2, 6),
(1, 2, 7),
(18, 3, 2),
(15, 3, 3),
(17, 3, 5),
(4, 3, 6),
(22, 4, 2),
(12, 4, 4),
(20, 4, 6),
(21, 4, 7),
(23, 5, 2),
(34, 6, 5),
(24, 6, 6),
(25, 6, 7),
(28, 7, 10),
(29, 9, 2),
(31, 9, 6),
(30, 9, 10),
(32, 10, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vitamine`
--

CREATE TABLE `vitamine` (
  `v_id` int(11) NOT NULL,
  `v_name` varchar(50) NOT NULL,
  `v_info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `vitamine`
--

INSERT INTO `vitamine` (`v_id`, `v_name`, `v_info`) VALUES
(1, 'Biotin', 'Biotin, vormals Vitamin B7 genannt, ist Bestandteil von Enzymen. Es ist an vielen Stoffwechselprozessen wie dem Kohlenhydrat-, Eiweiß- und Fettstoffwechsel beteiligt und wirkt am Zellwachstum sowie bei der DNA- und Proteinsynthese mit. Zudem aktiviert Biotin den Stoffwechsel und fördert die Neubildung von Haarwurzeln und des Nagelbettes. Das Vitamin ist wasserlöslich und wird vom Körper abgebaut und größtenteils über den Urin oder Stuhl ausgeschieden.'),
(2, 'C', 'Vitamin C trägt zu einer normalen Funktion des Immunsystems bei. Vitamin C trägt dazu bei, die Zellen vor oxidativen Stress zu schützen. Vitamin C trägt zur Verringerung von Müdigkeit und Ermüdung bei. Vitamin C erhöht die Eisenaufnahme.'),
(3, 'A', 'Vitamin A (Retinol) zählt zur Gruppe der sogenannten Retinoide, also zu den fettlöslichen Substanzen. Im Körper ist Vitamin A wesentlich am Wachstum, an der Zellbildung, an der Fortpflanzung und am Sehvermögen beteiligt. Als Antioxidans wirkt es außerdem als \\\"Radikalenfänger\\\"'),
(4, 'Provitamine', 'Die beiden Provitamine werden im Körper zu Vitamin A umgewandelt. Ein Vitamin-A-Mangel ist häufig eine Ursache von Nachtblindheit. Das Vitamin hat eine antiinfektiöse Wirkung. Es stärkt unter anderem die Nasenschleimhaut, sodass diese eine Barriere gegen Viren und Bakterien bilden kann.'),
(5, 'Niacin', 'Das Vitamin ist am Erhalt der normalen Funktion des Nervensystems und einer normalen psychologischen Funktion beteiligt und unterstützt den Erhalt normaler Haut und Schleimhäute. Darüber hinaus trägt Niacin zur Verringerung der Müdigkeit bei und unterstützt den Energiestoffwechsel.'),
(6, 'B6', 'Vitamin B6 regelt zentrale Abläufe im Stoffwechsel. Der Körper benötigt es vor allem, um Eiweißstoffe umwandeln und einbauen zu können. Auch beim Fettstoffwechsel hilft Vitamin B6. Es trägt zur Bildung von Botenstoffen in den Nerven bei und hat Auswirkungen auf das Immunsystem.'),
(7, 'Folsäure', 'Folsäure ist vor allem für die Bildung der Blutkörperchen und die Zellteilung wichtig.'),
(8, 'K', 'Vitamin K ist ein fettlösliches Vitamin und vorrangig für die Bildung von Blutgerinnungsfaktoren wichtig. Somit beeinflusst es die Blutgerinnung und spielt auch eine Rolle beim Knochenstoffwechsel.'),
(9, 'Pantothensäure', 'Pantothensäure trägt zu einer normalen Synthese und zu einem normalen Stoffwechsel von Steroidhormonen, Vitamin D und einigen Neurotransmittern bei. Pantothensäure trägt zur Verringerung von Müdigkeit und Ermüdung bei.'),
(10, 'E', 'Vitamin E besitzt antioxidative Wirkung. Es entschärft \"freie Radikale\". Des Weiteren schützt Vitamin E das Gedächtnis und beeinflusst – in richtiger Kombination seiner Formen – das Erinnerungsvermögen. Ein Vitamin-E-Derivat soll zudem Krebszellen beseitigen können, ohne gesunde Zellen in Mitleidenschaft zu ziehen.');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `obst`
--
ALTER TABLE `obst`
  ADD PRIMARY KEY (`o_id`),
  ADD UNIQUE KEY `o_name` (`o_name`);

--
-- Indizes für die Tabelle `relation_obst_vitamine`
--
ALTER TABLE `relation_obst_vitamine`
  ADD PRIMARY KEY (`r_id`),
  ADD UNIQUE KEY `r_o_id` (`r_o_id`,`r_v_id`),
  ADD KEY `relation_vitamine` (`r_v_id`);

--
-- Indizes für die Tabelle `vitamine`
--
ALTER TABLE `vitamine`
  ADD PRIMARY KEY (`v_id`),
  ADD UNIQUE KEY `v_name` (`v_name`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `obst`
--
ALTER TABLE `obst`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT für Tabelle `relation_obst_vitamine`
--
ALTER TABLE `relation_obst_vitamine`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT für Tabelle `vitamine`
--
ALTER TABLE `vitamine`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `relation_obst_vitamine`
--
ALTER TABLE `relation_obst_vitamine`
  ADD CONSTRAINT `relation_obst` FOREIGN KEY (`r_o_id`) REFERENCES `obst` (`o_id`),
  ADD CONSTRAINT `relation_vitamine` FOREIGN KEY (`r_v_id`) REFERENCES `vitamine` (`v_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

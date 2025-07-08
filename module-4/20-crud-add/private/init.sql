-- NOTE: This is the same table that we created in Lesson 14. If you do not already have it in phpMyAdmin, you may create the table and insert all of its values by selecting the course database and importing this file. 

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 09, 2025 at 04:22 PM
-- Server version: 10.5.27-MariaDB
-- PHP Version: 8.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vwatson_dmit2025_workbook_key`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `cid` int(11) NOT NULL,
  `city_name` varchar(36) NOT NULL,
  `province` enum('AB','BC','MB','NB','NL','NS','ON','PE','QC','SK','NT','NU','YT') NOT NULL,
  `population` int(10) NOT NULL,
  `is_capital` tinyint(1) DEFAULT NULL,
  `trivia` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`cid`, `city_name`, `province`, `population`, `is_capital`, `trivia`) VALUES
(1, 'Toronto', 'ON', 2731571, 1, 'Home to the iconic CN Tower'),
(2, 'Ottawa', 'ON', 1013242, 0, 'Features the scenic Rideau Canal, a UNESCO World Heritage Site'),
(3, 'Mississauga', 'ON', 717961, 0, NULL),
(4, 'Hamilton', 'ON', 569353, 0, NULL),
(5, 'London', 'ON', 422324, 0, NULL),
(6, 'Sudbury', 'ON', 166004, 0, 'Known for its unique mining history'),
(7, 'Montreal', 'QC', 1780000, 0, 'Renowned for its vibrant arts and festival scene'),
(8, 'Quebec City', 'QC', 549459, 1, 'One of the oldest cities in North America with rich French heritage'),
(9, 'Laval', 'QC', 437413, 0, NULL),
(10, 'Gatineau', 'QC', 291041, 0, NULL),
(11, 'Sherbrooke', 'QC', 172950, 0, NULL),
(12, 'Vancouver', 'BC', 662248, 0, 'Surrounded by mountains and water, a hub for film and outdoor activities'),
(13, 'Victoria', 'BC', 92441, 1, 'Charming city known for its historic architecture and gardens'),
(14, 'Surrey', 'BC', 568322, 0, NULL),
(15, 'Kelowna', 'BC', 144576, 0, NULL),
(16, 'Calgary', 'AB', 1306784, 0, 'Famous for its annual Calgary Stampede'),
(17, 'Edmonton', 'AB', 1057790, 1, 'Home to one of North America\'s largest mall complexes'),
(18, 'Red Deer', 'AB', 106736, 0, NULL),
(19, 'Saskatoon', 'SK', 273010, 0, 'Nicknamed the \"Paris of the Prairies\" for its vibrant culture'),
(20, 'Regina', 'SK', 226404, 1, 'Known as the \"Queen City\" with beautiful parks'),
(21, 'Winnipeg', 'MB', 749607, 1, 'Home to The Forks, a historic meeting place'),
(22, 'Brandon', 'MB', 51424, 0, NULL),
(23, 'Halifax', 'NS', 439819, 1, 'Famous for its maritime history and seafood cuisine'),
(24, 'Fredericton', 'NB', 63116, 1, 'A picturesque city along the St. John River'),
(25, 'Moncton', 'NB', 79470, 0, NULL),
(26, 'Saint John', 'NB', 69375, 0, NULL),
(27, 'Charlottetown', 'PE', 39285, 1, 'Birthplace of Canadian Confederation'),
(28, 'St. John\'s', 'NL', 110525, 1, 'Known for its jellybean-colored row houses'),
(29, 'Whitehorse', 'YT', 28376, 1, 'Gateway to Canada\'s vast wilderness'),
(30, 'Yellowknife', 'NT', 20116, 1, 'Famous for aurora viewing and located on the edge of the Canadian Shield'),
(31, 'Iqaluit', 'NU', 7740, 1, 'Home to unique Arctic culture and scenic landscapes'),
(32, 'Saint-Louis-du-Ha! Ha!', 'QC', 1311, 0, 'A ha-ha is an archaic French word for an impasse, also known as a sunk fence, blind fence, or deer wall.'),
(33, 'Happy Adventure', 'NL', 118, 0, NULL),
(34, 'Flin Flon', 'MB', 5099, 0, NULL),
(35, 'Vulcan', 'AB', 1769, 0, 'Although originally named after the Roman God of Fire (Vulcan), this town features several Star Trek themed attractions.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2023 at 01:10 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mordhubdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pfp` text NOT NULL DEFAULT 'hilt_icon.png',
  `join_date` datetime NOT NULL DEFAULT current_timestamp(),
  `bio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `email`, `password`, `pfp`, `join_date`, `bio`) VALUES
(1, 'test', 'test@test.com', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'blades.png', '2023-06-07 22:55:20', 'Hello, this is the test account. I am merely used for testing account-related stuff.'),
(5, 'brigandine2', 'brigandinebandit@zweimail.com', '$2y$10$N5GCvxobkQBZBAlaGi1bGuUr0wRzq0vgzJE2w9kR6ZRMI/dRLfXl6', 'blades.png', '2023-06-09 17:30:42', 'no longer a brigand. zweis are still cool though'),
(6, 'duelbrotherchad', 'duelbrotherchad@nukansduelmail.com', '$2y$10$fac9hYr8jQJWH.0/zmUTp.SSqNyh9.TXROhZV6oo9YdmxeSodxz9y', 'gigachad knight.png', '2023-06-10 16:45:32', 'Duel me brother');

-- --------------------------------------------------------

--
-- Table structure for table `mordhaucomments`
--

CREATE TABLE `mordhaucomments` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pfp` text NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `owner_id` int(11) NOT NULL,
  `tag` text NOT NULL,
  `img` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mordhaucomments`
--

INSERT INTO `mordhaucomments` (`id`, `name`, `email`, `pfp`, `content`, `date`, `owner_id`, `tag`, `img`) VALUES
(1, 'brigandzwei', 'brigandinefan224@banditmail.com', 'roddy headshot.jpg', 'Has anyone seen my zwei?', '2023-06-10 15:21:06', 5, 'CONCERN', ''),
(3, 'brigandzwei', 'brigandinefan224@banditmail.com', 'roddy headshot.jpg', 'Cool cowboy pic i found. Also GS users please leave this site', '2023-06-10 18:42:32', 5, 'MEME', 'brendan.jpg'),
(4, 'brigandzwei', 'brigandinefan224@banditmail.com', 'roddy headshot.jpg', 'I hate huntsmen players', '2023-06-10 18:49:59', 5, 'TRUE', NULL),
(5, 'duelbrotherchad', 'duelbrotherchad@nukansduelmail.com', 'gigachad knight.png', 'Brigandzwei, you are a coward and a knave. Come duel me at Nukans EU duelyard tonight or you are a coward forever and for all time.', '2023-06-10 19:22:46', 6, 'THREAT', NULL),
(6, 'brigandzwei', 'brigandinefan224@banditmail.com', 'roddy headshot.jpg', 'duelbrother, you cant even break even on your K/D in pubs, sit down', '2023-06-10 20:14:40', 5, 'THREAT', NULL),
(7, 'duelbrotherchad', 'duelbrotherchad@nukansduelmail.com', 'gigachad knight.png', 'Forgot my picture', '2023-06-11 00:54:11', 6, 'MEME', NULL),
(8, 'brigandzwei', 'brigandinefan224@banditmail.com', 'roddy headshot.jpg', 'Darkest Dungeon 2 Bounty Hunter out now!', '2023-06-11 01:46:38', 5, 'NEWS', 'snorts.jfif'),
(9, 'brigandine2', 'brigandinebandit@zweimail.com', 'blades.png', 'Has anyone seen my sword? I already asked earlier.', '2023-06-11 02:25:09', 5, 'QUERY', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mordhaureplies`
--

CREATE TABLE `mordhaureplies` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pfp` text NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `reply_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mordhaureplies`
--

INSERT INTO `mordhaureplies` (`id`, `parent_id`, `username`, `email`, `pfp`, `date`, `reply_content`) VALUES
(1, 6, 'brigandzwei', 'brigandinefan224@banditmail.com', 'roddy headshot.jpg', '2023-06-10', 'test'),
(2, 6, 'duelbrotherchad', 'duelbrotherchad@nukansduelmail.com', 'gigachad knight.png', '2023-06-11', 'haha little coward does not want to fight'),
(9, 6, 'brigandzwei', 'brigandinefan224@banditmail.com', 'roddy headshot.jpg', '2023-06-11', 'You\'re the one who keeps leaving me to fend for myself you foul naive. You bring no maidens and they find you quite putrid. Leave at once, and do not show yourself in this thread no longer, otherwise I will have to raise my sword and challenge you to a duel. You know for yourself you are incapable of beating me in one on one combat. The only reason my K/D is low is you stealing my kills and letting me die.'),
(10, 4, 'brigandzwei', 'brigandinefan224@banditmail.com', 'roddy headshot.jpg', '2023-06-11', 'so true bestie'),
(11, 6, 'duelbrotherchad', 'duelbrotherchad@nukansduelmail.com', 'gigachad knight.png', '2023-06-11', 'i ain\'t reading allat'),
(12, 7, 'brigandzwei', 'brigandinefan224@banditmail.com', 'roddy headshot.jpg', '2023-06-11', 'idiot'),
(13, 7, 'brigandzwei', 'brigandinefan224@banditmail.com', 'roddy headshot.jpg', '2023-06-11', 'do it again'),
(14, 8, 'brigandzwei', 'brigandinefan224@banditmail.com', 'roddy headshot.jpg', '2023-06-11', 'cool'),
(15, 5, 'brigandine2', 'brigandinebandit@zweimail.com', 'blades.png', '2023-06-11', 'No thanks.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mordhaucomments`
--
ALTER TABLE `mordhaucomments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `mordhaureplies`
--
ALTER TABLE `mordhaureplies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mordhaucomments`
--
ALTER TABLE `mordhaucomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mordhaureplies`
--
ALTER TABLE `mordhaureplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mordhaucomments`
--
ALTER TABLE `mordhaucomments`
  ADD CONSTRAINT `mordhaucomments_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mordhaureplies`
--
ALTER TABLE `mordhaureplies`
  ADD CONSTRAINT `mordhaureplies_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `mordhaucomments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

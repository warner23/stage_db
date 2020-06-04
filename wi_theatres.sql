-- phpMyAdmin SQL Dump
-- version 
-- http://www.phpmyadmin.net
--
-- Host: mysql3001.mochahost.com
-- Generation Time: Jun 20, 2018 at 04:43 PM
-- Server version: 5.6.33
-- PHP Version: 5.6.20

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `warner_stage_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `wi_theatres`
--

CREATE TABLE IF NOT EXISTS `wi_theatres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `first_line` varchar(255) DEFAULT NULL,
  `second_line` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `description` text,
  `photo` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `wi_theatres`
--

INSERT INTO `wi_theatres` (`id`, `name`, `first_line`, `second_line`, `city`, `region`, `postcode`, `country`, `description`, `photo`) VALUES
(1, 'Trafalgar Studios', '14 Whitehall', NULL, 'Greater London', '', 'SW1A 2DY', 'GB', 'Trafalgar Studios, formerly the Whitehall Theatre until 2004, is a West End theatre in Whitehall, near Trafalgar Square, in the City of Westminster, London', 'Trafalgar_Studios.jpg'),
(2, 'Dominion Theatre', 'Tottenham Court Road', NULL, 'Greater London', '', 'W1T 7AQ', 'GB', 'The Dominion Theatre is a West End theatre and former cinema located on Tottenham Court Road, close to St Giles Circus and Centre Point, in the London Borough of Camden', 'dominion.jpg'),
(3, 'Nuffield Southampton Theatres', 'University Rd', NULL, 'Southampton', '', 'SO17 1TR', 'GB', 'Nuffield Southampton Theatres (NST) is one of the UK''s leading professional theatre companies. Open all year round, this friendly theatre offers bold, innovative and exciting drama, children''s theatre and comedy.', 'the-nuffield-theatre.jpg'),
(5, 'Palace', '97 Oxford St ', NULL, 'Manchester', '', 'M1 6FT', 'GB', 'The Palace Theatre Manchester is one of the most prominent theatres in Manchester, England. Built in 1891, this theatre has gone through several changes since it first opened its doors. Despite this, the theatre still continues to attract some of the best in entertainment and remains as one of the main theatres in Manchester.', NULL),
(13, 'Her Majesty''s Theatre', 'Haymarket, St. James''s', NULL, ' London ', '', NULL, 'GB', 'Her Majesty''s Theatre is a West End theatre situated on Haymarket in the City of Westminster, Londo', 'hermajestys_exterior_1-480x320_c.jpg'),
(6, 'Garrick Theatre', '2 Charing Cross Rd,', '', 'London', NULL, 'WC2H 0HH', NULL, 'The Garrick Theatre is a West End theatre, located on Charing Cross Road, in the City of Westminster, named for the stage actor David Garrick.', '440px-HE1217927_Garrick_Theatre.jpg'),
(7, 'Empire Theatre', 'Lime St', NULL, 'Liverpool ', '', NULL, 'AF', 'Liverpool Empire Theatre is a theatre located on the corner of Lime Street and London Road in Liverpool, Merseyside, England. The theatre is the second to be built on the site, and was opened in 1925.', 'empire-710i.jpg'),
(14, 'To Be Confirmed', '', NULL, '', '', NULL, 'AF', '', NULL),
(15, 'Victoria Palace Theatre', 'Victoria St', NULL, 'London', 'Greater London', 'SW1E 5EA', 'GB', 'The theatre began life as a small concert room above the stables of the Royal Standard Hotel, a small hotel and tavern built in 1832. It was then later demolished in 1910 and rebuilt into what is now known as the Victoria Palace Theatre. Interior renovations occurred in 2017 for the opening of Hamilton. ', 'Screen Shot 2018-05-11 at 22.56.53.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

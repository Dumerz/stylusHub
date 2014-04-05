-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 15, 2014 at 07:31 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stylushub`
--
CREATE DATABASE IF NOT EXISTS `stylushub` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `stylushub`;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_title` varchar(25) NOT NULL,
  `book_content` varchar(255) NOT NULL,
  `book_cover` text NOT NULL,
  `date` date NOT NULL,
  `author_id` int(11) NOT NULL,
  `editor_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1000 ;

-- --------------------------------------------------------

--
-- Table structure for table `field`
--

CREATE TABLE IF NOT EXISTS `field` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `field` varchar(25) NOT NULL,
  PRIMARY KEY (`field_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `field`
--

INSERT INTO `field` (`field_id`, `field`) VALUES
(1, 'Editor'),
(2, 'Aerodynamics'),
(3, 'Botany'),
(4, 'Chemistry'),
(5, 'Earth Science'),
(6, 'Genetics'),
(7, 'Mathematics'),
(8, 'Meteorology'),
(9, 'Oceanography'),
(10, 'Paleontology'),
(11, 'Physics'),
(12, 'Zoology');

-- --------------------------------------------------------

--
-- Table structure for table `timeline`
--

CREATE TABLE IF NOT EXISTS `timeline` (
  `line_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `line` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `attach` varchar(255) NOT NULL,
  PRIMARY KEY (`line_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1000 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `user_name` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `sur_name` varchar(15) NOT NULL,
  `given_name` varchar(15) NOT NULL,
  `user_image` varchar(20) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1001 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `field_id`, `user_name`, `password`, `sur_name`, `given_name`, `user_image`) VALUES
(1000, 1, 'dumerz', 'klampong', 'Dumdum', 'Paul Orlan', 'Account Picture.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

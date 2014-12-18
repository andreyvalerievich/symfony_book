-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Час створення: Гру 18 2014 р., 05:33
-- Версія сервера: 5.5.41-log
-- Версія PHP: 5.4.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База даних: `symfony2`
--

-- --------------------------------------------------------

--
-- Структура таблиці `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` varchar(15) NOT NULL,
  `idauthor` int(11) NOT NULL,
  `room` varchar(5) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Дамп даних таблиці `booking`
--

INSERT INTO `booking` (`id`, `time`, `idauthor`, `room`, `date`) VALUES
(12, '13', 2, 'room1', '2014-12-23'),
(13, '13', 1, 'room2', '2014-12-23'),
(15, '15', 1, 'room1', '2014-12-16'),
(16, '14', 1, 'room1', '2014-12-16'),
(17, '11', 2, 'room2', '2014-12-16'),
(18, '14', 2, 'room2', '2014-12-26'),
(19, '13', 1, 'room3', '2014-12-16'),
(20, '12', 2, 'room1', '2014-12-16'),
(21, '10', 1, 'room3', '2014-12-16'),
(25, '9', 1, 'room2', '2014-12-19');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 17 Şub 2016, 03:37:36
-- Sunucu sürümü: 5.6.17
-- PHP Sürümü: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `policevsmafia`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `sender` varchar(25) NOT NULL,
  `receiver` varchar(25) NOT NULL,
  `topic` varchar(25) NOT NULL,
  `message` text NOT NULL,
  `time` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Tablo döküm verisi `messages`
--

INSERT INTO `messages` (`id`, `sender`, `receiver`, `topic`, `message`, `time`) VALUES
(7, 'Darksorrow', 'trt', 'e2', 'cnbe', ''),
(8, 'Darksorrow', 'asd', 'dcfd', 'zxc', ''),
(9, 'Darksorrow', 'zxc', 'asd', 'wqe', ''),
(10, 'Darksorrow', 'asdsad', '', 'asd', ''),
(14, 'Darksorrow', 'zxczc', 'sdasd', 'asdasd', ''),
(16, 'Darksorrow', 'ramazan', 'topic', 'fethat', ''),
(17, 'Darksorrow', 'ferhat', 'asdsad', 'zxcxzzxc', ''),
(18, 'Angel', 'Darksorrow', 'xcxc', 'sdsdsd', '11/01/16 & 04:32:32'),
(19, 'Angel', 'angel', 'sdsdd', 'xcxcxc', '11/01/16 & 04:32:56'),
(21, 'Police', 'police', 'h', 'hh', '16/02/16 & 23:11:27'),
(22, 'Mafia', 'police', 'awds', 'asdasds', '17/02/16 & 03:15:08'),
(23, 'Mafia', 'mafia', 'asdasd', 'asdasd', '17/02/16 & 03:15:18');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mquests`
--

CREATE TABLE IF NOT EXISTS `mquests` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `subject` text NOT NULL,
  `qtime` int(2) NOT NULL DEFAULT '60',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Tablo döküm verisi `mquests`
--

INSERT INTO `mquests` (`id`, `name`, `subject`, `qtime`) VALUES
(1, 'asdsa', 'qweqweqwe', 60),
(2, 'asdsadxzc', 'qqwscadsad', 60),
(3, 'bb', 'qeqweqwesad', 60);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pquests`
--

CREATE TABLE IF NOT EXISTS `pquests` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `subject` text NOT NULL,
  `qtime` int(2) DEFAULT '60',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `pquests`
--

INSERT INTO `pquests` (`id`, `name`, `subject`, `qtime`) VALUES
(1, 'voice', 'Some people listen music loud-voiced and you must go there and warn them !', 60);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(75) NOT NULL,
  `side` char(1) NOT NULL,
  `classs` varchar(30) NOT NULL DEFAULT 'Beginner',
  `energy` int(3) NOT NULL DEFAULT '100',
  `str` int(5) NOT NULL DEFAULT '5',
  `agi` int(5) NOT NULL DEFAULT '5',
  `intg` int(5) NOT NULL DEFAULT '5',
  `lvl` int(5) NOT NULL DEFAULT '1',
  `expr` int(11) NOT NULL DEFAULT '0',
  `hp` int(3) NOT NULL DEFAULT '100',
  `money` int(11) NOT NULL DEFAULT '500',
  `questtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `side`, `classs`, `energy`, `str`, `agi`, `intg`, `lvl`, `expr`, `hp`, `money`, `questtime`) VALUES
(1, 'Police', '74b8bbd9c743f0ae332940a5d0c3b1e9', 'angel@gmail.com', 'P', 'Beginner', -120, 5, 5, 5, 1, 25, 100, 3922, 1455676352),
(2, 'Mafia', '74b8bbd9c743f0ae332940a5d0c3b1e9', 'demon@gmail.com', 'M', 'Beginner', -970, 5, 5, 5, 1, 29, 100, 24204, 1455670379),
(3, 'Darksorrow', '74b8bbd9c743f0ae332940a5d0c3b1e9', 'guray@gmail.com', 'P', 'Beginner', 100, 5, 5, 5, 1, 0, 100, 500, 0),
(4, 'Ahmet', 'fdc529a40ce24c1dcbf62bfd3fd70524', 'gg@gb.com', 'M', 'Beginner', 100, 5, 5, 5, 1, 0, 100, 500, 0),
(5, 'adasd', '250c8b2d156e66082066af38c74a9e81', 'adasd', 'P', 'Beginner', 100, 5, 5, 5, 1, 0, 100, 500, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

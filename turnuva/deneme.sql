-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 14, 2018 at 03:40 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `deneme`
--

-- --------------------------------------------------------

--
-- Table structure for table `oyuncular`
--

DROP TABLE IF EXISTS `oyuncular`;
CREATE TABLE IF NOT EXISTS `oyuncular` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kul_id` int(50) NOT NULL,
  `takim_id` int(50) NOT NULL,
  `isim` varchar(50) DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `steam` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oyuncular`
--

INSERT INTO `oyuncular` (`id`, `kul_id`, `takim_id`, `isim`, `mail`, `steam`) VALUES
(1, 2, 4, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `takimlar`
--

DROP TABLE IF EXISTS `takimlar`;
CREATE TABLE IF NOT EXISTS `takimlar` (
  `takim_id` int(100) NOT NULL AUTO_INCREMENT,
  `kul_id` int(50) NOT NULL,
  `takim_adi` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `isim` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mail` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `steam` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`takim_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `takimlar`
--

INSERT INTO `takimlar` (`takim_id`, `kul_id`, `takim_adi`, `isim`, `mail`, `steam`) VALUES
(4, 1, 'takim1', 'mehmet', 'sahmet@gamyia.com', 'salakro');

-- --------------------------------------------------------

--
-- Table structure for table `turnuvakatilimci`
--

DROP TABLE IF EXISTS `turnuvakatilimci`;
CREATE TABLE IF NOT EXISTS `turnuvakatilimci` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kul_id` int(11) NOT NULL,
  `tur_id` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `turnuvakatilimci`
--

INSERT INTO `turnuvakatilimci` (`id`, `kul_id`, `tur_id`) VALUES
(1, 1, 1),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `turnuvalar`
--

DROP TABLE IF EXISTS `turnuvalar`;
CREATE TABLE IF NOT EXISTS `turnuvalar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `turnuva_isim` varchar(100) NOT NULL,
  `turnuva_detay` varchar(2000) NOT NULL,
  `turnuva_foto` text NOT NULL,
  `turnuva_tarih` date NOT NULL,
  `turnuva_durum` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `turnuvalar`
--

INSERT INTO `turnuvalar` (`id`, `turnuva_isim`, `turnuva_detay`, `turnuva_foto`, `turnuva_tarih`, `turnuva_durum`) VALUES
(1, 'HIRRIK CUP', 'AAAAAAAAAAAAAAAAAAAAAAAA', 'https://i.stack.imgur.com/WZK5E.png?s=32&g=1', '2018-05-17', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Ad',
  `nick` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'nick',
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'E-Posta Adresi',
  `password` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Şifre',
  `avatar` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `steam_profil` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'steamnick',
  `takim_varmi` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='User Tablosu';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `nick`, `email`, `password`, `avatar`, `steam_profil`, `takim_varmi`) VALUES
(1, 'ismail', 'dhequel', 'ismail555512@gmail.com', '51edd49a4988e7535542449677cd551d', 'https://www.gravatar.com/avatar/348d335cd13298e475eeaefa1841dee6?s=128&d=identicon&r=PG', 'http://localhost/yenicalismasite/profil.php', 1),
(2, 'yavsusartik', 'ismail55', 'isofather@hotmail.com', '51edd49a4988e7535542449677cd551d', NULL, NULL, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

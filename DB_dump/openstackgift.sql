-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Creato il: Dic 28, 2016 alle 10:59
-- Versione del server: 10.1.19-MariaDB
-- Versione PHP: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `openstackgift`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `assigned_gift`
--

CREATE TABLE `assigned_gift` (
  `image_id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `assigned_gift`
--

INSERT INTO `assigned_gift` (`image_id`, `user_id`) VALUES
(1, '0003'),
(2, '0004');

-- --------------------------------------------------------

--
-- Struttura della tabella `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `path_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `images`
--

INSERT INTO `images` (`id`, `path_image`) VALUES
(1, 'https://www.androidcentral.com/sites/androidcentral.com/files/styles/xlarge/public/article_images/2016/11/oneplus-3t-press-render-03.jpg?itok=fvatsfBV'),
(2, 'http://cdn.bgr.com/2016/10/macbook-pro-2016.jpg?quality=98&strip=all');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

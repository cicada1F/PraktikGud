-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Дек 25 2022 г., 21:16
-- Версия сервера: 5.1.30
-- Версия PHP: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `uchet`
--

-- --------------------------------------------------------

--
-- Структура таблицы `active`
--

CREATE TABLE IF NOT EXISTS `active` (
  `id_act` int(11) NOT NULL AUTO_INCREMENT,
  `name_act` varchar(100) NOT NULL,
  `id_cat` int(11) unsigned NOT NULL,
  `ed_izm` varchar(10) NOT NULL,
  `quantity` int(50) unsigned NOT NULL COMMENT 'не может быть меньше нуля',
  `price` decimal(30,0) NOT NULL,
  `comments` varchar(255) NOT NULL,
  PRIMARY KEY (`id_act`),
  KEY `id_cat` (`id_cat`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `active`
--

INSERT INTO `active` (`id_act`, `name_act`, `id_cat`, `ed_izm`, `quantity`, `price`, `comments`) VALUES
(1, 'Монтаж собранного сервера', 1, '1 мес', 10, '150000', 'Временное описание товара'),
(2, 'Профилактические работы и настройка ПО', 2, '12 мес', 31, '49999', 'Описание товара'),
(3, 'Установка систем контроля и безопасности', 3, '13 лет', 1, '19999', 'Описание товара');

-- --------------------------------------------------------

--
-- Структура таблицы `buy`
--

CREATE TABLE IF NOT EXISTS `buy` (
  `id_user` int(20) NOT NULL,
  `id_sub` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `buy`
--


-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id_cat` int(11) NOT NULL AUTO_INCREMENT,
  `name_cat` varchar(100) NOT NULL,
  PRIMARY KEY (`id_cat`),
  KEY `id_cat` (`id_cat`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id_cat`, `name_cat`) VALUES
(1, 'Установка сервера'),
(2, 'Обслуживание и настройка'),
(3, 'Защита данных');

-- --------------------------------------------------------

--
-- Структура таблицы `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) NOT NULL,
  `id_sub` int(10) NOT NULL,
  `dates` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Дамп данных таблицы `history`
--

INSERT INTO `history` (`id`, `id_user`, `id_sub`, `dates`) VALUES
(22, 3, 1, 'December 22, 2022, 7:07 am'),
(23, 11, 1, 'December 22, 2022, 8:06 am'),
(24, 11, 2, 'December 22, 2022, 8:06 am'),
(25, 3, 1, 'December 22, 2022, 8:26 am'),
(26, 3, 2, 'December 22, 2022, 8:26 am'),
(27, 3, 1, 'December 22, 2022, 8:30 am'),
(28, 3, 1, 'December 23, 2022, 12:47 am'),
(29, 3, 1, 'December 23, 2022, 12:51 am'),
(30, 3, 2, 'December 23, 2022, 12:55 am'),
(31, 5, 1, 'December 24, 2022, 12:15 am'),
(32, 3, 1, 'December 24, 2022, 12:17 am'),
(33, 3, 2, 'December 24, 2022, 12:18 am'),
(34, 3, 1, 'December 24, 2022, 12:28 am'),
(35, 3, 1, 'December 25, 2022, 8:34 pm');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `login_2` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `status`) VALUES
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(4, 'mandroid276@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 10),
(5, '1@mail.ru', '827ccb0eea8a706c4c34a16891f84e7b', 10),
(6, '2@mail.ru', '827ccb0eea8a706c4c34a16891f84e7b', 10),
(7, '3@mail.ru', '827ccb0eea8a706c4c34a16891f84e7b', 10),
(8, '4@mail.ru', '827ccb0eea8a706c4c34a16891f84e7b', 10),
(9, '5@mail.ru', 'e10adc3949ba59abbe56e057f20f883e', 10),
(10, '6@mail.ru', '827ccb0eea8a706c4c34a16891f84e7b', 10),
(11, '7@mail.ru', '827ccb0eea8a706c4c34a16891f84e7b', 10);

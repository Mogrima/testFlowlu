-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 07 2021 г., 11:32
-- Версия сервера: 10.3.13-MariaDB
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `brackets`
--

-- --------------------------------------------------------

--
-- Структура таблицы `brack`
--

CREATE TABLE `brack` (
  `id` int(11) NOT NULL,
  `input` varchar(200) NOT NULL,
  `result` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `brack`
--

INSERT INTO `brack` (`id`, `input`, `result`) VALUES
(1, '( 2 * 45 [ 11 ) - 7]', 'false'),
(2, '> < > <', 'false'),
(3, '( 2 * 44 [ 11 ] )', 'true'),
(4, '( 2 * 44 [ 11 ] )', 'true'),
(8, '< ( { [ 42 ] } ) >', 'true'),
(9, '< ( { [ 42 ] } ) >', 'true'),
(15, '< ( { [ 42 ] } ) >', 'true'),
(16, '< a * ( 4 / 7 - [ 2 - 2] / { 11 } ) >', 'true');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `brack`
--
ALTER TABLE `brack`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `brack`
--
ALTER TABLE `brack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

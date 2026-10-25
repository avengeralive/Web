-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: sql490.your-server.de
-- Время создания: Май 24 2019 г., 15:53
-- Версия сервера: 5.7.26-1
-- Версия PHP: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `solvedtop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `gt_games`
--

CREATE TABLE `gt_games` (
  `id` int(11) NOT NULL,
  `steps` int(11) NOT NULL DEFAULT '0',
  `teams` int(11) NOT NULL,
  `ts` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `timer` int(11) NOT NULL,
  `lvd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `gt_games`
--

INSERT INTO `gt_games` (`id`, `steps`, `teams`, `ts`, `active`, `timer`, `lvd`) VALUES
(1, 0, 5, '0', 0, 0, 0),
(2, 0, 5, '0', 0, 0, 0),
(4, 1, 5, '1558634475', 1, 0, 0),
(5, 0, 3, '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `gt_stats`
--

CREATE TABLE `gt_stats` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `question` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `gt_stats`
--

INSERT INTO `gt_stats` (`id`, `user_id`, `game_id`, `question`, `time`) VALUES
(37, 1, 4, 1, 12),
(38, 2, 4, 1, 17),
(39, 3, 4, 1, 18),
(40, 5, 4, 1, 19),
(41, 4, 4, 1, 23);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `gt_games`
--
ALTER TABLE `gt_games`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gt_stats`
--
ALTER TABLE `gt_stats`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `gt_games`
--
ALTER TABLE `gt_games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `gt_stats`
--
ALTER TABLE `gt_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

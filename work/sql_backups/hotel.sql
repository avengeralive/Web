-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июл 11 2019 г., 16:54
-- Версия сервера: 10.1.38-MariaDB-0+deb9u1
-- Версия PHP: 7.1.30-1+0~20190531112602.19+stretch~1.gbpab9d28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `romi_stocc`
--

-- --------------------------------------------------------

--
-- Структура таблицы `hotel`
--

CREATE TABLE `hotel` (
  `hotel_id` int(11) NOT NULL,
  `title` varchar(256) DEFAULT NULL,
  `manager` varchar(256) DEFAULT NULL,
  `manager_photo_url` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `hotel`
--

INSERT INTO `hotel` (`hotel_id`, `title`, `manager`, `manager_photo_url`) VALUES
(67, 'Внуково', 'Внуков В.В.', 'http://stahanov-occupancy.ru/avatars/vn.png'),
(68, 'Селятино', NULL, 'http://stahanov-occupancy.ru/avatars/sel.png'),
(69, 'Наро-Фоминск', NULL, 'http://stahanov-occupancy.ru/avatars/nar.png'),
(70, 'Подольск', NULL, 'http://stahanov-occupancy.ru/avatars/pod.png'),
(71, 'Одинцово', NULL, 'http://stahanov-occupancy.ru/avatars/od.png'),
(76, 'Тестовый отель', 'Иван', 'https://pp.userapi.com/c857616/v857616714/5a37/UkBz3Mni6go.jpg'),
(77, 'Дмитров', 'Асланов', 'https://pp.userapi.com/c841439/v841439540/8bbe/fFM874ndrdc.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`hotel_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `hotel`
--
ALTER TABLE `hotel`
  MODIFY `hotel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

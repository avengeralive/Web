-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Хост: 10.0.2.7
-- Время создания: Дек 06 2018 г., 09:33
-- Версия сервера: 5.7.22-22-log
-- Версия PHP: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `a142598_bazakomp`
--

-- --------------------------------------------------------

--
-- Структура таблицы `AllSKU`
--

CREATE TABLE `AllSKU` (
  `ApotekID` int(5) NOT NULL,
  `KompensaSKU` int(6) NOT NULL,
  `ShtrichKod` char(13) NOT NULL,
  `NameSKU` varchar(255) NOT NULL,
  `ShopPrice` decimal(13,2) NOT NULL,
  `MinTrudTableID` int(6) NOT NULL,
  `FSSPrice` decimal(13,2) NOT NULL,
  `FSSAproval` int(1) DEFAULT NULL,
  `FSSAprovalTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `AllSKU`
--

INSERT INTO `AllSKU` (`ApotekID`, `KompensaSKU`, `ShtrichKod`, `NameSKU`, `ShopPrice`, `MinTrudTableID`, `FSSPrice`, `FSSAproval`, `FSSAprovalTime`) VALUES
(1012, 67, '2722449000028', 'Старая коляска', '15230.00', 0, '14368.00', 1, '2018-11-30 06:53:41'),
(1012, 66, '', '1Совсем2 новая3 коляска', '0.00', 0, '0.00', 1, '2018-11-30 07:56:31'),
(18, 87, '', 'Кресло-коляска инвалидная, арт. BCH-1500', '0.00', 0, '15500.00', 1, '2018-12-03 20:54:18'),
(9, 68, '', 'МАТРАЦ противопролежневый ортопедический гелевый с наматрасником МПГВ-200*850*80', '0.00', 0, '0.00', 1, '2018-12-03 22:19:33'),
(15, 64, '', 'Телескопическая трость для полных людей (нагрузка до 225 кг) BRONIGEN BIC-400', '0.00', 0, '0.00', 1, '2018-12-03 22:19:34'),
(15, 65, '8717627110211', 'Телескопическая трость с деревянной ручкой (регулируемая высота) BRONIGEN BOC-200', '0.00', 0, '0.00', 1, '2018-12-03 22:19:35'),
(15, 63, '', 'Телескопическая трость с пластиковой ручкой (регулируемая высота) BRONIGEN BOC-100', '0.00', 0, '0.00', 1, '2018-12-03 22:19:36'),
(17, 86, '', 'Товар 10', '0.00', 0, '0.00', 1, '2018-12-03 22:19:37'),
(17, 85, '', 'Товар9', '0.00', 0, '0.00', 1, '2018-12-03 22:19:39'),
(17, 84, '', 'Товар8', '0.00', 0, '0.00', 1, '2018-12-03 22:19:40');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `AllSKU`
--
ALTER TABLE `AllSKU`
  ADD PRIMARY KEY (`KompensaSKU`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

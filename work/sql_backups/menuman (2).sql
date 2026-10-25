-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: sql501.your-server.de
-- Время создания: Сен 27 2018 г., 13:06
-- Версия сервера: 5.7.23-1
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
-- База данных: `menuman`
--

-- --------------------------------------------------------

--
-- Структура таблицы `chat`
--

CREATE TABLE `chat` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `side` int(11) NOT NULL,
  `message` text NOT NULL,
  `send_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `readed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `chat`
--

INSERT INTO `chat` (`ID`, `user_id`, `place_id`, `side`, `message`, `send_time`, `readed`) VALUES
(1, 11, 1, 0, 'Hi', '2017-06-02 20:42:50', 1),
(2, 11, 1, 1, 'fuck you', '2017-06-02 20:43:13', 1),
(3, 11, 1, 1, 'test', '2017-06-02 21:59:13', 0),
(4, 11, 1, 1, 'ещё тест', '2017-06-02 22:02:21', 0),
(5, 11, 1, 1, 'много теста', '2017-06-02 22:02:52', 0),
(6, 11, 1, 0, 'yes', '2017-06-03 19:39:12', 0),
(7, 11, 1, 1, 'Xovanskiy pivo pyet', '2017-06-04 14:03:08', 0),
(8, 11, 1, 1, 'Xovanskiy pivo pyet', '2017-06-04 14:03:08', 0),
(9, 11, 1, 1, 'Xovanskiy pivo pyet', '2017-06-04 14:03:08', 0),
(10, 11, 1, 1, 'Xovanskiy pivo pyet', '2017-06-04 14:03:09', 0),
(11, 11, 1, 1, 'Xovanskiy pivo pyet', '2017-06-04 14:03:09', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `coupon`
--

CREATE TABLE `coupon` (
  `ID` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `coupon`
--

INSERT INTO `coupon` (`ID`, `place_id`, `title`, `description`, `from_date`, `to_date`, `type`) VALUES
(1, 1, 'тест', 'тестовый', '2017-06-08', '2017-06-25', 0),
(2, 1, 'тест2', 'тест', '2017-06-01', '2017-06-30', 0),
(3, 1, 'test act', 'testtttt', '2017-06-02', '2017-06-30', 1),
(4, 1, 'retertert', 'etetert', '2017-06-04', '2017-06-15', 1),
(5, 1, 'rterter', 'terterter', '2017-06-03', '2017-06-14', 1),
(6, 1, 'ertert', 'erter', '5345-03-04', '3453-05-31', 1),
(7, 1, 'rterter', 'erterte', '2017-06-02', '2017-06-22', 0),
(8, 1, 'erwe', 'werwer', '2017-06-01', '2017-06-10', 0),
(9, 1, '234324', '234234', '2017-06-10', '2017-06-08', 0),
(10, 1, 'werwr', 'rwerwer', '2017-06-02', '2017-06-08', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `discount`
--

CREATE TABLE `discount` (
  `ID` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `percent` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `discount`
--

INSERT INTO `discount` (`ID`, `place_id`, `percent`, `from_date`, `to_date`) VALUES
(1, 1, 18, '2017-06-14', '2017-06-17');

-- --------------------------------------------------------

--
-- Структура таблицы `food_type`
--

CREATE TABLE `food_type` (
  `ID` int(11) NOT NULL,
  `menus_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `food_type`
--

INSERT INTO `food_type` (`ID`, `menus_id`, `group_id`, `name`) VALUES
(66, 0, 44, 'dsfsdf'),
(85, 23, 0, ''),
(90, 19, 0, ''),
(95, 24, 0, 'Супы'),
(96, 24, 95, 'Восточные супы'),
(97, 24, 95, 'Азербайджанские супы'),
(98, 25, 0, 'Грузинские вина'),
(99, 25, 0, 'Шампанское'),
(100, 26, 0, ''),
(103, 10, 55, ''),
(104, 10, 55, ''),
(105, 10, 0, ''),
(106, 10, 105, ''),
(107, 19, 90, ''),
(108, 19, 0, ''),
(109, 24, 0, ''),
(110, 23, 85, ''),
(111, 23, 0, ''),
(112, 23, 0, ''),
(113, 23, 112, ''),
(114, 10, 105, '');

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `ID` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `portion` varchar(255) NOT NULL,
  `composition` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`ID`, `type_id`, `name`, `price`, `portion`, `composition`) VALUES
(177, 85, '', '', '', ''),
(178, 96, 'Том Ям', '200', '{\"measure\":\"гр\",\"value\":\"200\"}', 'креветки, перец'),
(179, 96, 'Том ЫН', '250', '{\"measure\":\"гр\",\"value\":\"200\"}', 'перец, молюски'),
(180, 97, 'Кюфта бозбаш', '200', '{\"measure\":\"гр\",\"value\":\"200\"}', 'кюфта'),
(181, 97, 'Парча бозбаш', '200', '{\"measure\":\"гр\",\"value\":\"200\"}', 'парча'),
(182, 95, 'Харчо', '230', '{\"measure\":\"гр\",\"value\":\"200\"}', 'мясо'),
(183, 95, 'Борщ', '220', '{\"measure\":\"гр\",\"value\":\"200\"}', 'мясо'),
(184, 95, 'Лапша', '210', '{\"measure\":\"гр\",\"value\":\"200\"}', 'лапша'),
(185, 98, 'Киндзмараули', '600', '{\"measure\":\"мл\",\"value\":\"500\"}', ''),
(186, 98, 'Саперави', '700', '{\"measure\":\"мл\",\"value\":\"500\"}', ''),
(187, 99, 'Шампань', '1000', '{\"measure\":\"мл\",\"value\":\"200\"}', ''),
(188, 100, '', '', '', ''),
(189, 100, '', '', '', ''),
(190, 103, '', '', '', ''),
(191, 104, '', '', '', ''),
(192, 105, '', '', '', ''),
(193, 106, '', '', '', ''),
(194, 107, '', '', '', ''),
(195, 108, '', '', '', ''),
(196, 110, '', '', '', ''),
(197, 113, '', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `menus`
--

CREATE TABLE `menus` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `place_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menus`
--

INSERT INTO `menus` (`ID`, `name`, `place_id`) VALUES
(10, 'sdfsdfsdfs', 7),
(19, '', 6),
(23, '', 2),
(24, 'Основное меню', 1),
(25, 'Винная карта', 1),
(26, '', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `places`
--

CREATE TABLE `places` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `web` varchar(255) NOT NULL,
  `about` varchar(255) NOT NULL,
  `metro` text NOT NULL,
  `kitchen` text NOT NULL,
  `place_type` text NOT NULL,
  `additional` varchar(255) NOT NULL,
  `open` varchar(255) NOT NULL,
  `close` varchar(255) NOT NULL,
  `middle` varchar(255) NOT NULL,
  `verified` int(1) NOT NULL DEFAULT '0',
  `profile_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `places`
--

INSERT INTO `places` (`ID`, `user_id`, `name`, `slug`, `city`, `address`, `phone`, `web`, `about`, `metro`, `kitchen`, `place_type`, `additional`, `open`, `close`, `middle`, `verified`, `profile_picture`) VALUES
(1, 11, 'Столовка МГУ', 'stolovka-mgu', 'Москва', 'Ленинские горы, д1', '+71234567890', 'test', 'Что-то интересное о ресторане', '[\"576\",\"17\"]', '[\"4\",\"5\"]', '[\"13\"]', '[]', '08:00', '23:00', '150', 1, '10661129_1469817183294662_12598057_n.jpg'),
(2, 11, 'Столовка на этаже', 'stolovka-na-etazhe', 'Москва', '325235235', '235235235', '', '', '[]', '[]', '[]', '[]', '00:00', '00:00', '', 0, ''),
(5, 11, 'Столовка МГУ', 'Столовка МГУ', 'Москва', 'Ленинские горы, д1', '+71234567890', '', 'Что-то интересное о ресторане', '[\"576\",\"17\"]', '[\"4\"]', '[\"13\"]', '[\"wi-fi\"]', '08:00', '23:00', '', 0, ''),
(6, 11, 'test', 'test', 'Москва', 'test', 'test', '', 'test', '[]', '[]', '[]', '[]', '00:00', '00:00', '', 0, ''),
(7, 11, 'adasd', '11', 'Москва', 'asdasd', 'sadasd', 'asdasd', 'asdasd', '[\"37\",\"11\",\"140\"]', '[\"5\",\"14\",\"18\",\"71\"]', '[\"14\",\"25\",\"30\"]', '[\"Кальян\",\"Ххх\"]', '04:22', '04:03', '', 0, ''),
(8, 15, 'BAKI ', '15', 'Москва', 'Ленинские горы', '+7111111', '111111', '', '[\"17\"]', '[]', '[\"22\"]', '[]', '00:00', '00:00', '', 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `promos`
--

CREATE TABLE `promos` (
  `ID` int(11) NOT NULL,
  `discount_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `promo` varchar(255) NOT NULL,
  `used` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `promos`
--

INSERT INTO `promos` (`ID`, `discount_id`, `user_id`, `promo`, `used`, `date`) VALUES
(10, 1, 11, '5JISAD', 1, '2017-06-02 08:39:45');

-- --------------------------------------------------------

--
-- Структура таблицы `ratings`
--

CREATE TABLE `ratings` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ratings`
--

INSERT INTO `ratings` (`ID`, `user_id`, `place_id`, `rating`) VALUES
(1, 1, 1, 5),
(2, 2, 2, 5),
(3, 3, 1, 4),
(4, 11, 1, 5),
(5, 12, 2, 5),
(6, 11, 2, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `ID` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `review` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`ID`, `place_id`, `review`, `user_id`, `date`) VALUES
(1, 1, 'тест', 11, '2017-05-23 17:46:59'),
(2, 1, 'еуые', 11, '2017-05-23 17:46:59');

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`ID`, `user_id`, `token`, `reg_date`) VALUES
(1, 11, 'hXb2o5eqIWOMNjIK66doWhImKCCcM0rT', '2017-06-10 13:21:09'),
(2, 11, 'mJoFUDtLik2UmI1N4OAW8XFtb2U6Veq8', '2017-06-10 13:25:17'),
(3, 11, '53euGc3nMG4bXEZg8jdn5ooyBaJlOd5K', '2017-06-12 09:17:08'),
(4, 11, 'EYXYWL796KPfVuX6t4vokEYLdqI1srwX', '2017-06-13 21:51:18'),
(5, 11, 'vk0men0slpCADaPnRphrDARU2HYxmM1H', '2017-06-14 20:22:56'),
(6, 11, '77iXlzSaneHBncD1YkU5jxLd0ZCmrsFo', '2017-06-24 09:14:08'),
(7, 11, 'cSYgu3JbBY6fdODjS6H4oPwHQ6jcThdW', '2017-06-25 11:34:49'),
(8, 11, 'Ooc0cceolhsGLM9KIgiOWSXGp4hL693K', '2017-06-25 20:16:08'),
(9, 11, 'fVTDv5tJTF9od8RMUTNvvuP3RVkhjPlo', '2017-06-28 14:05:22'),
(10, 11, 'SuuwCaLaPNPDQcza65oTt7PRqCLrjO71', '2017-07-02 13:21:54'),
(11, 11, 'PNv0RjORdjRUsezw8EQOBdLRDVDABV0g', '2017-07-02 19:15:14'),
(12, 11, 'x8wyvP2SOe4KTonUxameB0xJWj5je0jB', '2017-07-10 14:11:28'),
(13, 11, 'utC4zBp580fsmTw159c2i0rE9bdAQj7b', '2017-07-20 12:15:45'),
(14, 11, 'Hogo7QAyzvcJKvTc07GcJeE1ZF5L8cKF', '2017-07-26 11:55:56'),
(15, 11, '2R1v0WsBC2Wzf5SlYGFfjlg1EN9wSWtK', '2017-07-27 12:54:24'),
(16, 11, 'hjuJO4RtOxmEbLt4HYyXOOQrgNBG2dTa', '2017-08-07 08:23:30'),
(17, 11, 'oIc9FXA078xgqjVQHegpTQuIRC9sA4cO', '2017-08-07 10:42:53'),
(18, 11, 'g4rhGM4E9c9kaeA9i1asu7aqEnIomOMt', '2017-08-07 10:44:10'),
(19, 11, 'keOeESQ6F9jdsdMVelNPpdzlQWy9n7Ny', '2017-08-21 09:23:13'),
(20, 11, 'FZKZsJTRsMU2BpxEDc4FZzlo6L3OYupu', '2017-08-28 18:53:19');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `token` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `mailer` int(11) NOT NULL,
  `reg_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `profile_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`ID`, `email`, `password`, `type`, `token`, `name`, `phone`, `mailer`, `reg_date`, `profile_picture`) VALUES
(1, 'ali', '', 0, '', '', '', 0, '2017-05-31 19:29:42', ''),
(11, 'aliveliyev93@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 'FZKZsJTRsMU2BpxEDc4FZzlo6L3OYupu', 'Али', 'Велиев', 1, '2017-05-31 19:29:42', '12357263_455331714660427_892393256_n.jpg'),
(12, 'office@aliveliyev.com', 'd8146195a002edb0c8e599f12772f395', 0, 'sA7yqOFRTg7Rrv9n1snbZCikSSG4NcP6', '', '', 0, '2017-05-31 19:29:42', ''),
(13, 'office1@aliveliyev.com', 'a1b9da35c694d51c56964e57ab6f13fe', 0, '', '', '', 0, '2017-05-31 19:29:42', ''),
(14, '', '483664fd863bb688aef237cdc38dea65', 1, '', '', '', 0, '2017-05-31 19:29:42', ''),
(15, 'mamed-9494@mail.ru', 'e10adc3949ba59abbe56e057f20f883e', 1, '08zmvmA3Ffyg2JG1WkKUKtv7zuWwPVVF', '', '', 0, '2017-06-05 21:08:20', '');

-- --------------------------------------------------------

--
-- Структура таблицы `visitors`
--

CREATE TABLE `visitors` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `visitors`
--

INSERT INTO `visitors` (`ID`, `user_id`, `place_id`, `date`) VALUES
(1, 1, 1, '2017-06-02 09:02:12'),
(2, 1, 2, '2017-06-02 09:02:12'),
(3, 2, 1, '2017-06-02 09:02:12'),
(4, 3, 1, '2017-06-02 09:02:12'),
(5, 1, 6, '2017-06-02 09:02:12'),
(6, 2, 6, '2017-06-02 09:02:12'),
(7, 4, 6, '2017-06-02 09:02:12'),
(8, 5, 6, '2017-06-02 09:02:12'),
(11, 11, 1, '2017-06-02 09:02:12');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `food_type`
--
ALTER TABLE `food_type`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `chat`
--
ALTER TABLE `chat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `coupon`
--
ALTER TABLE `coupon`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `discount`
--
ALTER TABLE `discount`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `food_type`
--
ALTER TABLE `food_type`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT для таблицы `menus`
--
ALTER TABLE `menus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `places`
--
ALTER TABLE `places`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `promos`
--
ALTER TABLE `promos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `ratings`
--
ALTER TABLE `ratings`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `sessions`
--
ALTER TABLE `sessions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `visitors`
--
ALTER TABLE `visitors`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

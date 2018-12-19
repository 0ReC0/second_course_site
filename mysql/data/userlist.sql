-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 19 2018 г., 16:31
-- Версия сервера: 10.1.37-MariaDB
-- Версия PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `userlist`
--

-- --------------------------------------------------------

--
-- Структура таблицы `servicelist`
--

CREATE TABLE `servicelist` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `rate` int(1) NOT NULL DEFAULT '0',
  `important` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `servicelist`
--

INSERT INTO `servicelist` (`id`, `name`, `rate`, `important`) VALUES
(15, 'Электроэнергия', 2, 1),
(16, 'Отопление', 3, 1),
(17, 'Вывоз ТБО', 4, 1),
(18, 'Газоснабжение', 5, 1),
(19, 'Вода', 2, 1),
(20, 'Канализация', 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(32) NOT NULL DEFAULT '',
  `email` varchar(32) NOT NULL DEFAULT '',
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `rights` varchar(32) NOT NULL DEFAULT 'user',
  `confirmation` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `username`, `password`, `rights`, `confirmation`) VALUES
(11, 's', 'sergei@user.ru', 'sergei', 'user', 'user', 1),
(12, 'asdf', 'sergei@operator.ru', 'sergei', 'operator', 'operator', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `utilities`
--

CREATE TABLE `utilities` (
  `serviceid` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `servicename` varchar(32) NOT NULL,
  `important` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `utilities`
--

INSERT INTO `utilities` (`serviceid`, `value`, `userid`, `servicename`, `important`) VALUES
(48, 2, 0, 'Вода', 1),
(49, 4, 0, 'Вывоз ТБО', 1),
(50, 5, 0, 'Газоснабжение', 1),
(51, 3, 0, 'Канализация', 1),
(52, 3, 0, 'Отопление', 1),
(53, 2, 0, 'Электроэнергия', 1),
(54, 2, 0, 'Вода', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `servicelist`
--
ALTER TABLE `servicelist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `name_2` (`name`),
  ADD KEY `important` (`important`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE,
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `utilities`
--
ALTER TABLE `utilities`
  ADD PRIMARY KEY (`serviceid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `servicename` (`servicename`),
  ADD KEY `value` (`value`),
  ADD KEY `utilities_ibfk_2` (`important`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `servicelist`
--
ALTER TABLE `servicelist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `utilities`
--
ALTER TABLE `utilities`
  MODIFY `serviceid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `utilities`
--
ALTER TABLE `utilities`
  ADD CONSTRAINT `utilities_ibfk_1` FOREIGN KEY (`servicename`) REFERENCES `servicelist` (`name`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

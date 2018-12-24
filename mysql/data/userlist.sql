-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 24 2018 г., 15:51
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
-- Структура таблицы `delusers`
--

CREATE TABLE `delusers` (
  `id` int(11) NOT NULL,
  `fullname` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `delusers`
--

INSERT INTO `delusers` (`id`, `fullname`, `email`, `username`, `password`) VALUES
(2, 'asdf', 'sergei@operator.ru', 'sergei', 'operator'),
(4, 'anton pushkin', 'anton@user.ru', 'antonio', 'anton'),
(8, 'sad', 'ivan@ivan.ru', 'sdf', 'ivan'),
(10, 's', 'sergei@user.ru', 'sergei', 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `servicelist`
--

CREATE TABLE `servicelist` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `rate` int(11) NOT NULL DEFAULT '0',
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
(12, 'asdf', 'sergei@operator.ru', 'sergei', 'operator', 'operator', 0),
(13, 'sad', 'sergei@admin.ru', 'dsf', 'admin', 'admin', 0),
(16, 'sdf', 'user@user.ru', 'sad', 'user', 'user', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `utilities`
--

CREATE TABLE `utilities` (
  `serviceid` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `servicename` varchar(32) NOT NULL,
  `important` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `utilities`
--

INSERT INTO `utilities` (`serviceid`, `rate`, `value`, `userid`, `servicename`, `important`) VALUES
(81, 4, 9, 11, 'Вывоз ТБО', 1),
(82, 5, 3, 11, 'Газоснабжение', 1),
(83, 2, 23, 14, 'Вода', 1),
(84, 5, 213, 14, 'Газоснабжение', 1),
(85, 3, 123, 14, 'Канализация', 1),
(86, 2, 23, 11, 'Вода', 1),
(88, 2, 10, 15, 'Вода', 1),
(90, 4, 1, 15, 'Вывоз ТБО', 1),
(91, 5, 9, 15, 'Газоснабжение', 1),
(96, 3, 987, 15, 'Канализация', 1),
(97, 3, 56, 15, 'Отопление', 1),
(99, 2, 12, 15, 'Электроэнергия', 1),
(100, 2, 78, 16, 'Вода', 1),
(101, 4, 312, 16, 'Вывоз ТБО', 1),
(102, 5, 3123, 16, 'Газоснабжение', 1),
(103, 3, 123, 16, 'Канализация', 1),
(104, 3, 23, 16, 'Отопление', 1),
(105, 2, 213, 16, 'Электроэнергия', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `delusers`
--
ALTER TABLE `delusers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `servicelist`
--
ALTER TABLE `servicelist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `name_2` (`name`),
  ADD KEY `important` (`important`),
  ADD KEY `rate` (`rate`);

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
  ADD KEY `utilities_ibfk_2` (`important`),
  ADD KEY `rate` (`rate`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `delusers`
--
ALTER TABLE `delusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `servicelist`
--
ALTER TABLE `servicelist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `utilities`
--
ALTER TABLE `utilities`
  MODIFY `serviceid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `utilities`
--
ALTER TABLE `utilities`
  ADD CONSTRAINT `utilities_ibfk_1` FOREIGN KEY (`servicename`) REFERENCES `servicelist` (`name`) ON DELETE CASCADE,
  ADD CONSTRAINT `utilities_ibfk_2` FOREIGN KEY (`rate`) REFERENCES `servicelist` (`rate`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

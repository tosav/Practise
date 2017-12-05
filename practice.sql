-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 29 2017 г., 15:27
-- Версия сервера: 5.5.53
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `practice`
--

-- --------------------------------------------------------

--
-- Структура таблицы `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `inn` varchar(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `contract` tinyint(1) NOT NULL,
  `vacancies` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL,
  `number` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `leader`
--

CREATE TABLE `leader` (
  `id` int(11) NOT NULL,
  `fio` varchar(1000) NOT NULL,
  `gropus` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `fio` varchar(1000) NOT NULL,
  `num` varchar(9) NOT NULL,
  `group` int(11) NOT NULL,
  `skills` varchar(2000) DEFAULT NULL,
  `vacancy` int(11) DEFAULT NULL,
  `leader` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `contacts` varchar(255) DEFAULT NULL,
  `role` enum('0','1','2','3') NOT NULL,
  `activate` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `vacancies`
--

CREATE TABLE `vacancies` (
  `id` int(11) NOT NULL,
  `company` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `contract` tinyint(1) NOT NULL,
  `conditions` varchar(500) NOT NULL,
  `num` int(11) NOT NULL,
  `students` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inn` (`inn`);

--
-- Индексы таблицы `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `leader`
--
ALTER TABLE `leader`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `num` (`num`),
  ADD UNIQUE KEY `group` (`group`),
  ADD KEY `leader` (`leader`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Индексы таблицы `vacancies`
--
ALTER TABLE `vacancies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company` (`company`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `vacancies`
--
ALTER TABLE `vacancies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `company_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `leader`
--
ALTER TABLE `leader`
  ADD CONSTRAINT `leader_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_3` FOREIGN KEY (`group`) REFERENCES `group` (`id`),
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`leader`) REFERENCES `leader` (`id`);

--
-- Ограничения внешнего ключа таблицы `vacancies`
--
ALTER TABLE `vacancies`
  ADD CONSTRAINT `vacancies_ibfk_1` FOREIGN KEY (`company`) REFERENCES `company` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

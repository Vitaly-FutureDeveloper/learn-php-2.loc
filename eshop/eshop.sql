-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 02 2019 г., 17:13
-- Версия сервера: 5.6.41
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `eshop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `catalog`
--

CREATE TABLE `catalog` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT 'Без названия',
  `author` varchar(255) DEFAULT NULL,
  `pubyear` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `catalog`
--

INSERT INTO `catalog` (`id`, `title`, `author`, `pubyear`, `price`) VALUES
(1, 'sdg1546', 'zzzz', 1991, 2200),
(2, 'sdg1546', 'яя', 1991, 2200),
(3, 'Верищагин Д.С. - все книги ДЭИР', 'Маг', 1991, 2500),
(4, 'sdgewf32r', 'Создатель', 2333, 2200),
(5, 'Ламер-сайтик', 'Создатель', 1991, 2500),
(6, 'Ламер-сайтик', 'Создатель', 1991, 2342),
(7, 'Ствол', 'Киллер', 2019, 1000),
(8, 'Просветление', 'Бог', 2019, 1000),
(9, 'Карты', 'Шулер', 2019, 500),
(13, 'Марочки', 'Велш', 2019, 700),
(14, 'Это самое правильное', 'Хакер', 1995, 6000),
(15, 'Самое правильное', 'VintPlanov', 1991, 6000);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `author` varchar(255) NOT NULL DEFAULT '',
  `pubyear` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `orderid` varchar(50) NOT NULL DEFAULT '',
  `datetime` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `title`, `author`, `pubyear`, `price`, `quantity`, `orderid`, `datetime`) VALUES
(10, 'sdg1546', 'zzzz', 1991, 2200, 1, '5dd17c64ee57a', 1574010420),
(11, 'sdg1546', 'яя', 1991, 2200, 1, '5dd17c64ee57a', 1574010420),
(12, 'Ламер-сайтик', 'Создатель', 1991, 2342, 1, '5dd17c64ee57a', 1574010420),
(13, 'Ствол', 'Киллер', 2019, 1000, 1, '5dd17c64ee57a', 1574010420);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `catalog`
--
ALTER TABLE `catalog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

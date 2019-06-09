-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 29 2019 г., 02:54
-- Версия сервера: 8.0.15
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `geekbrains`
--

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `id` int(10) NOT NULL,
  `src` varchar(255) NOT NULL COMMENT 'расположение ',
  `alt` varchar(255) NOT NULL COMMENT 'описание',
  `views` int(10) NOT NULL DEFAULT '0' COMMENT 'просмотры'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `src`, `alt`, `views`) VALUES
(1, 'public_html/img/1.jpg', 'внимательный кот', 20),
(2, 'public_html/img/2.jpg', 'просящий котёнок', 2),
(3, 'public_html/img/3.jpg', 'бесполезный комок шерсти', 12),
(4, 'public_html/img/4.jpg', 'шокированный кот', 7),
(5, 'public_html/img/5.jpg', 'скрытный кот', 4),
(6, 'public_html/img/6.jpg', 'кот в шапке зубастика', 8),
(7, 'public_html/img/7.jpg', 'кот, который зарабатывает больше тебя', 18),
(8, 'public_html/img/8.jpg', 'модный кот', 2),
(9, 'public_html/img/9.jpg', 'озлобленный котенок', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `productreviews`
--

CREATE TABLE `productreviews` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'имя',
  `review` varchar(255) NOT NULL COMMENT 'отзыв ',
  `productId` int(10) NOT NULL COMMENT 'id товара для отзыва'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `productreviews`
--

INSERT INTO `productreviews` (`id`, `name`, `review`, `productId`) VALUES
(4, 'иван', 'телефон не выдержал левого хука', 1),
(5, 'Василий', 'Ненадежный телефон. После первого погружения в воду перестал работать.', 1),
(6, 'Алексей', 'надёжный аппарат', 2),
(7, 'Stanislav', 'Blind moles. You need to read the instructions before using the phone.', 1),
(8, 'Пётр', 'нормальный телефон', 1),
(9, 'Аркадий', 'выглядит как китайская подделка', 9),
(10, 'Арсений', 'дешево и сердито', 9),
(11, 'Василий', 'мне вполне достаточно Nokia 3310. Зачем нужны все эти навороты.', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `imgSrc` varchar(100) NOT NULL COMMENT 'путь к изображению',
  `title` varchar(100) NOT NULL COMMENT 'название ',
  `price` int(10) NOT NULL COMMENT 'цена '
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `imgSrc`, `title`, `price`) VALUES
(1, 'public_html/img/1.jpg', 'OnePlus 2 64Gb ', 20160),
(2, 'public_html/img/2.jpg', 'Nokia 8 (2017)', 21690),
(3, 'public_html/img/3.jpg', 'CAT S31 Dual Sim', 16990),
(4, 'public_html/img/4.jpg', 'TURBO X Mercury', 4900),
(5, 'public_html/img/5.jpg', 'Ulefone Mix 2', 8765),
(6, 'public_html/img/6.jpg', 'Ulefone S8 PRO', 7304),
(7, 'public_html/img/7.jpg', 'Blackview P6000', 20451),
(8, 'public_html/img/8.jpg', 'Blackview P2', 12417),
(9, 'public_html/img/9.jpg', 'Homtom S99', 7674),
(15, 'public_html/img/1026711359.jpg', 'тестовый товар', 500);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `productreviews`
--
ALTER TABLE `productreviews`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `productreviews`
--
ALTER TABLE `productreviews`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

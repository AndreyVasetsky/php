-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 09 2019 г., 11:30
-- Версия сервера: 5.7.25
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
-- База данных: `geekbrains`
--

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'дата заказа',
  `details` json NOT NULL COMMENT 'информация о заказе',
  `comment` varchar(255) NOT NULL,
  `deliveryAddress` varchar(255) NOT NULL COMMENT 'адрес доставки',
  `status` varchar(16) NOT NULL DEFAULT 'accepted' COMMENT 'состояние заказа'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `userId`, `data`, `details`, `comment`, `deliveryAddress`, `status`) VALUES
(5, 6, '2019-06-07 14:12:55', '{\"3\": {\"count\": 2, \"price\": \"60\", \"title\": \"банан\"}, \"4\": {\"count\": 1, \"price\": \"100\", \"title\": \"ежевика\"}}', 'забиваю бананом до потери пульса', 'ЮАР, Мухосранск, село Кукуево, палатка под пальмой №1', 'accepted'),
(6, 6, '2019-06-08 03:22:13', '{\"2\": {\"count\": 1, \"price\": \"60\", \"title\": \"авокадо\"}, \"3\": {\"count\": 1, \"price\": \"60\", \"title\": \"банан\"}, \"4\": {\"count\": 3, \"price\": \"100\", \"title\": \"ежевика\"}}', 'не шути с бобром', 'Бобруйск, хата бобра №7', 'accepted'),
(9, 5, '2019-06-08 08:34:18', '{\"1\": {\"count\": 2, \"price\": \"70\", \"title\": \"яблоко\"}, \"3\": {\"count\": 1, \"price\": \"60\", \"title\": \"банан\"}, \"4\": {\"count\": 3, \"price\": \"100\", \"title\": \"ежевика\"}}', 'помните, бобер вам не друг и не товарищ', 'Бобруйск, хата бобра №7', 'accepted'),
(10, 5, '2019-06-08 08:35:05', '{\"3\": {\"count\": 1, \"price\": \"60\", \"title\": \"банан\"}, \"5\": {\"count\": 1, \"price\": \"160\", \"title\": \"черника\"}, \"10\": {\"count\": 1, \"price\": \"110\", \"title\": \"земляника\"}}', 'бобер за вами следит', 'Бобруйск, хата бобра №7', 'accepted'),
(11, 6, '2019-06-08 14:39:12', '{\"1\": {\"count\": 4, \"price\": \"70\", \"title\": \"яблоко\"}, \"3\": {\"count\": 1, \"price\": \"60\", \"title\": \"банан\"}}', 'петушиный остров №5', 'мухосранск, кукуево, д. 1', 'accepted'),
(12, 6, '2019-06-08 19:04:41', '{\"1\": {\"count\": 4, \"price\": \"70\", \"title\": \"яблоко\"}, \"2\": {\"count\": 1, \"price\": \"60\", \"title\": \"авокадо\"}, \"4\": {\"count\": 2, \"price\": \"100\", \"title\": \"ежевика\"}}', 'покрошу кокосом', 'ЮАР, Мухосранск, село Кукуево, палатка под пальмой №1', 'accepted');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `imgSrc` varchar(120) NOT NULL,
  `title` varchar(60) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `availability` varchar(12) NOT NULL DEFAULT 'yes' COMMENT 'продавать его или нет'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `imgSrc`, `title`, `price`, `description`, `availability`) VALUES
(1, 'img/apple.jpg', 'яблоко', 70, 'зеленое яблоко', 'yes'),
(2, 'img/avocado.jpg', 'авокадо', 60, 'зеленое авокадо', 'yes'),
(3, 'img/banana.jpg', 'банан', 60, 'спелые жёлтые бананы', 'yes'),
(4, 'img/blackberry.png', 'ежевика', 100, 'красивая чёрная ежевика', 'yes'),
(5, 'img/blueberries.png', 'черника', 160, 'очень полезная, экологически чистая черника', 'yes'),
(6, 'img/grapes.jpg', 'виноград', 130, 'крупный спелый виноград', 'yes'),
(7, 'img/lemon.jpg', 'лимон', 50, 'свежий лимон', 'yes'),
(8, 'img/pineapple.jpg', 'ананас', 100, 'свежайший ананас, только сорванный с дерева', 'yes'),
(9, 'img/strawberry.jpeg', 'клубника', 110, 'свежайшая, спелая, только с грядки', 'yes'),
(10, 'img/wild_strawberry.jpeg', 'малина', 110, 'полезнейшая земляника, которую отдал медведь после убедительных аргументов', 'yes'),
(15, 'img/2.jpg', 'товар 2', 500, 'мусор во плоти', 'yes');

-- --------------------------------------------------------

--
-- Структура таблицы `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `review` varchar(255) NOT NULL,
  `reviewData` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `productId` int(11) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'new' COMMENT 'новый или одобрен'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `username`, `review`, `reviewData`, `productId`, `status`) VALUES
(9, 'Алексей', 'мои любимые сочные яблоки с кислинкой', '2019-05-31 00:34:25', 1, 'new'),
(13, 'Андрей', 'отличные яблоки', '2019-05-31 00:36:58', 1, 'new'),
(14, 'иван', 'мои пчелы перестали делать воск после того как я купил эти яблоки. Они добывают его прямо с них и уверяют что им хватит этих запасов на несколько лет.\r\n\r\n', '2019-05-31 00:38:26', 1, 'new'),
(15, 'Зелибоба', 'гмо бананы', '2019-06-07 06:29:35', 3, 'new'),
(16, 'Скрудж', 'выглядит аппетитно', '2019-06-08 08:33:22', 4, 'new'),
(17, '', 'подозрительные лимоны', '2019-06-08 19:03:08', 7, 'new');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nickname` varchar(16) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `registered` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `nickname`, `email`, `password`, `role`, `registered`) VALUES
(5, 'user', 'user@mail.ru', '95688af5032f372c3b3588c9230990b0', 'user', '2019-05-30 04:28:36'),
(6, 'admin', 'admin@mail.ru', '8e2a150e35cef331fe23611270b0fb6a', 'admin', '2019-05-30 04:29:04'),
(7, 'guest', 'guest@gmail.com', 'a7b15a6f531697fba9ec2fd8c63c0236', 'user', '2019-05-30 04:29:32'),
(9, 'Андрей', 'andrey@gmail.com', 'c4f0f8e4511a6c1d43bef2c45f0ffbe2', 'user', '2019-06-07 08:04:01');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

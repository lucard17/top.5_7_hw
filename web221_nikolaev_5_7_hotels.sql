-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 03 2023 г., 14:31
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `web221.nikolaev.5_7_hotels`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cities`
--

CREATE TABLE `cities` (
  `id` int NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country_id` int DEFAULT NULL,
  `u_city` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `cities`
--

INSERT INTO `cities` (`id`, `city`, `country_id`, `u_city`) VALUES
(1, 'Москва', 1, NULL),
(2, 'Санкт-Петербург', 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `commentaries`
--

CREATE TABLE `commentaries` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `hotel_id` int NOT NULL,
  `date` date NOT NULL,
  `text` varchar(512) NOT NULL,
  `rate` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `commentaries`
--

INSERT INTO `commentaries` (`id`, `user_id`, `hotel_id`, `date`, `text`, `rate`) VALUES
(1, 3, 2, '2023-04-01', 'Very good', 5),
(2, 2, 2, '2023-03-31', 'Первый нах', 4),
(39, 3, 2, '2023-04-03', 'Новый комент', 4),
(40, 1, 2, '2023-04-03', 'Я здесь главный!!!', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE `countries` (
  `id` int NOT NULL,
  `country` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `countries`
--

INSERT INTO `countries` (`id`, `country`) VALUES
(3, 'Казахстан'),
(1, 'Россия');

-- --------------------------------------------------------

--
-- Структура таблицы `hotels`
--

CREATE TABLE `hotels` (
  `id` int NOT NULL,
  `hotel` varchar(100) DEFAULT NULL,
  `city_id` int DEFAULT NULL,
  `country_id` int DEFAULT NULL,
  `stars` int DEFAULT NULL,
  `cost` int DEFAULT NULL,
  `info` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `hotels`
--

INSERT INTO `hotels` (`id`, `hotel`, `city_id`, `country_id`, `stars`, `cost`, `info`) VALUES
(2, 'Mariott Гранд Отель', 1, 1, 5, 16000, 'Гостиница Марриотт Гранд Отель расположена в городе Москва в 1,8 км от центра.\r\n\r\nКоличество звёзд: 5.\r\n\r\nЗдесь созданы все условия для комфортного проживания — есть кондиционер, телевизор, фен, утюг, чай/кофе в номерах, чайник, сейф, отопление, терраса, мини-бар. В гостинице около 387 номеров — можно выбрать любой понравившийся и узнать подробнее, что в нём. По запросу предоставляются номера для некурящих. Уборка — каждый день.\r\n\r\nБерите своих питомцев — им будут рады!\r\n\r\nВ гостинице есть ресторан, бар, тренажёрный зал, сауна, конференц-зал. И вы наверняка захотите отдохнуть у бассейна — он тут тоже есть.\r\n\r\nУ каждого гостя будет доступ в интернет, вы сможете выложить фотографии, отправить файл или позвонить родным по видео.\r\n\r\nУчитывайте время заселения в гостиницу. Заезд здесь начинается с 14:00, выехать нужно до 12:00. Даже если вы прибудете поздно ночью, вас встретят на круглосуточной стойке регистрации и помогут с размещением. Лифт внутри есть. В гостинице есть и удобства для людей с ограниченными возможностями.\r\n\r\nЕсли вы на машине, можете оставить её на парковке. Если вы добираетесь своим ходом, воспользуйтесь услугой трансфера.\r\n\r\nЗа любой помощью обращайтесь на ресепшн. К вашим услугам: химчистка, прачечная, обслуживание номеров, консьерж-сервис, камера хранения, ускоренная регистрация заезда/отъезда.'),
(3, 'Cosmos Moscow Vdnh Hotel', 1, 1, 3, 5000, 'Гостиница Cosmos Moscow Vdnh Hotel расположена в городе Москва в 7,9 км от центра.\r\n\r\nКоличество звёзд: 3.\r\n\r\nЗдесь созданы все условия для комфортного проживания — есть кондиционер, холодильник, телевизор, фен, утюг, сейф, отопление. В гостинице около 1777 номеров — можно выбрать любой понравившийся и узнать подробнее, что в нём. По запросу предоставляются номера для некурящих. Уборка — каждый день.\r\n\r\nБерите своих питомцев — им будут рады!\r\n\r\nВ гостинице есть ресторан, бар, тренажёрный зал, сауна, конференц-зал. И вы наверняка захотите отдохнуть у бассейна — он тут тоже есть. Причём крытый, с подогревом. Есть возможность взять напрокат машину.\r\n\r\nУ каждого гостя будет доступ в интернет, вы сможете выложить фотографии, отправить файл или позвонить родным по видео.\r\n\r\nУчитывайте время заселения в гостиницу. Заезд здесь начинается с 15:00, выехать нужно до 12:00. Даже если вы прибудете поздно ночью, вас встретят на круглосуточной стойке регистрации и помогут с размещением. Лифт внутри есть. В гостинице есть и удобства для людей с ограниченными возможностями.\r\n\r\nЕсли вы на машине, можете оставить её на парковке. Если вы добираетесь своим ходом, воспользуйтесь услугой трансфера.\r\n\r\nЗа любой помощью обращайтесь на ресепшн. К вашим услугам: химчистка, прачечная, обслуживание номеров, консьерж-сервис, камера хранения.');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int NOT NULL,
  `image_path` varchar(250) DEFAULT NULL,
  `hotel_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `image_path`, `hotel_id`) VALUES
(2, 'images/Марриотт Гранд Отель.webp', 2),
(3, 'images/Cosmos Moscow Vdnh Hotel.webp', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `role` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'admin'),
(4, 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `discount` int DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  `avatar` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `discount`, `role_id`, `avatar`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.mail', NULL, 1, NULL),
(2, 'traveler', '8be0c6f8cd15416a8306f77b02369949', 'traveler@traveler.mail', NULL, 2, NULL),
(3, 'traveler2', '2bbe60d1cbca05d522b8171a9684d437', 'traveler2@mail.ru', NULL, 2, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_city` (`city`,`country_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Индексы таблицы `commentaries`
--
ALTER TABLE `commentaries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`hotel_id`,`date`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- Индексы таблицы `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `country` (`country`);

--
-- Индексы таблицы `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `commentaries`
--
ALTER TABLE `commentaries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT для таблицы `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `commentaries`
--
ALTER TABLE `commentaries`
  ADD CONSTRAINT `commentaries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `commentaries_ibfk_2` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`);

--
-- Ограничения внешнего ключа таблицы `hotels`
--
ALTER TABLE `hotels`
  ADD CONSTRAINT `hotels_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hotels_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

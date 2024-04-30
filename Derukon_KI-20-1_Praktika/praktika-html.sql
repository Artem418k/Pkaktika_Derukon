-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 27 2024 г., 03:44
-- Версия сервера: 8.0.19
-- Версия PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `praktika-html`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int UNSIGNED NOT NULL,
  `comment` varchar(250) NOT NULL,
  `date_c` datetime NOT NULL,
  `user_id` int NOT NULL,
  `date_edit` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `comment`, `date_c`, `user_id`, `date_edit`) VALUES
(3, 'Де Дмитро?', '2024-04-27 01:51:50', 1, NULL),
(2, 'Де знайти методичку по IOT?', '2024-04-27 01:14:45', 1, '2024-04-27 01:15:28');

-- --------------------------------------------------------

--
-- Структура таблицы `reply_comment`
--

CREATE TABLE `reply_comment` (
  `id_reply` int UNSIGNED NOT NULL,
  `reply_comment` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_comment` int DEFAULT NULL,
  `id_sub_comment` int DEFAULT NULL,
  `id_reply_user` int NOT NULL,
  `date_reply` datetime NOT NULL,
  `edit_date_reply` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reply_comment`
--

INSERT INTO `reply_comment` (`id_reply`, `reply_comment`, `id_comment`, `id_sub_comment`, `id_reply_user`, `date_reply`, `edit_date_reply`) VALUES
(1, 'Зайди в групу іот в телеграм', 2, NULL, 2, '2024-04-27 01:17:30', '2024-04-27 02:26:27'),
(2, 'Дякую, Дмитро! :)', NULL, 1, 1, '2024-04-27 01:18:22', '2024-04-27 01:52:00'),
(4, 'Все добре, я тут)))', 3, NULL, 2, '2024-04-27 02:54:31', NULL),
(5, 'Це добре!', NULL, 4, 1, '2024-04-27 03:19:58', NULL),
(6, 'Зрозумів! )))', NULL, 1, 1, '2024-04-27 03:20:27', '2024-04-27 03:41:09');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(75) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `surname` varchar(75) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone_number` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(105) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pass` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hash` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email_confirmed` tinyint(1) NOT NULL,
  `avatar` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `phone_number`, `email`, `pass`, `hash`, `email_confirmed`, `avatar`) VALUES
(1, 'Артем', 'Артемович', '0675555553', 'kirichek705@gmail.com', '94d550448b90ce1afb7ccd31652729d0', 'b07287dc75be88e264b9a45f7f8a2031', 0, NULL),
(2, 'Дмитро', 'Дмитрович', '0675555577', 'kirichek707@gmail.com', '94d550448b90ce1afb7ccd31652729d0', '7aa5d5e51c0dd01efadcde06121a98ad', 0, '/photo/cat.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reply_comment`
--
ALTER TABLE `reply_comment`
  ADD PRIMARY KEY (`id_reply`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `reply_comment`
--
ALTER TABLE `reply_comment`
  MODIFY `id_reply` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

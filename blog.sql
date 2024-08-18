-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: MariaDB-10.3
-- Время создания: Авг 18 2024 г., 20:19
-- Версия сервера: 10.3.39-MariaDB
-- Версия PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `album`
--

INSERT INTO `album` (`id`, `title`, `alias`, `keywords`, `description`, `text`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Альбом 1', 'albom-1', '1', 'Описание 1', '1', 1, '1723745848', '1723815155'),
(2, 'Альбом 2', '2', '22 22222', 'Описание альбома 2', 'Lorem ipsum odor amet, consectetuer adipiscing elit. Laoreet fames condimentum venenatis; felis malesuada convallis gravida. Lacus eget donec nisi porttitor convallis conubia eros dignissim potenti. Tristique laoreet fermentum id, congue nulla tellus. Nullam hendrerit ex varius pharetra elementum porttitor fusce mi. Facilisis convallis quisque dolor scelerisque hendrerit platea. Eu lectus dapibus placerat bibendum per fames varius.\n\nLectus sem enim egestas ligula at in nisl ex nec. Auctor malesuada euismod platea vivamus sapien class tristique. Hac sapien rhoncus aliquet; duis id malesuada. Duis fames cras justo dolor condimentum finibus nullam, primis nullam. Aenean commodo cubilia quisque sapien ex. Consectetur eget rutrum nibh rhoncus ultricies, interdum himenaeos. Rhoncus maximus nascetur mauris commodo magna diam aenean purus.\n\nTellus semper aliquet lorem dignissim dignissim aliquet. Consequat malesuada praesent ut curabitur primis; feugiat eget fames. Iaculis netus ipsum ultrices viverra id. Velit sociosqu aenean suscipit ut nam donec eleifend. Sagittis metus est per pretium tristique nam elit imperdiet. Et faucibus accumsan mauris ante platea ridiculus. Quisque penatibus quisque enim ridiculus praesent maecenas adipiscing penatibus? Aptent euismod volutpat montes convallis; odio enim nostra lectus curae.', 1, '1723814752', '1723817588'),
(3, '<script>alert(\'t\')</script>', 'script-alert-1-script', '<script>alert(\'k\')</script>', '<script>alert(\'d\')</script>', '<script>alert(\'t\')</script>', 1, '1723796990', '1723796990'),
(4, 'Альбом 4', 'al-bom-5', '4', '4', '4444444 gagGEg', 1, '1723815293', '1723815834');

-- --------------------------------------------------------

--
-- Структура таблицы `albumcomment`
--

CREATE TABLE `albumcomment` (
  `id` int(11) NOT NULL,
  `albumimg_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `albumcomment`
--

INSERT INTO `albumcomment` (`id`, `albumimg_id`, `user_id`, `text`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 'Lorem ipsum odor amet, consectetuer adipiscing elit. Iaculis nostra vulputate, tempor habitasse amet nascetur felis tellus. Himenaeos eros ipsum pretium et suspendisse amet. Quis nulla eros per pretium maecenas ante.', 1, '1723746023', '1723746023'),
(2, 4, 1, 'Комментарий 2', 1, '1723746023', '1723746023'),
(3, 2, 1, 'Комментарий 3', 1, '1723746023', '1723746023'),
(4, 4, 1, 'Комментарий 4', 1, '1723837831', '1723837831'),
(5, 4, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1, '1723838107', '1723838107'),
(6, 4, 1, 'Комментарий 5', 1, '1723838122', '1723838122'),
(7, 4, 1, 'Комментарий 6', 1, '1723838134', '1723838134'),
(8, 4, 1, 'Комментарий 7', 1, '1723838201', '1723838201'),
(9, 3, 1, 'Комментарий 1', 1, '1723838233', '1723838233'),
(10, 2, 1, '<script>alert(\'t\')</script>', 1, '1723839105', '1723839105'),
(11, 2, 1, 'h5h5h5h5h5hh5', 1, '1723985719', '1723985719');

-- --------------------------------------------------------

--
-- Структура таблицы `albumimg`
--

CREATE TABLE `albumimg` (
  `id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `like_` int(11) NOT NULL DEFAULT 0,
  `dislike` int(11) NOT NULL DEFAULT 0,
  `sort` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `albumimg`
--

INSERT INTO `albumimg` (`id`, `album_id`, `img`, `name`, `text`, `user_id`, `like_`, `dislike`, `sort`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '66be4652e1e13.jpg', 'ffffff', 'р65р', 1, 0, 0, 1, 1, '1723745874', '1723828520'),
(2, 2, '66be466e29fef.jpg', 'Альбом 2 Фото 1', 'Описание Альбом 2 Фото 1 g', 1, 1, 0, 1, 1, '1723745902', '1723985741'),
(3, 2, '66be46d231246.jpg', 'Альбом 2 Фото 2', 'Описание фото 2', 1, 1, 0, 2, 1, '1723746002', '1723971376'),
(4, 2, '66be46db02d7f.jpg', '65р', 'Lorem ipsum odor amet, consectetuer adipiscing elit. Sociosqu fringilla sem eget in nisi porttitor consectetur. Senectus habitant facilisis aenean mollis fusce faucibus velit?', 1, 1, 1, 3, 1, '1723746011', '1723746011'),
(5, 2, '66be46e773401.jpg', 'п5п', 'п54п', 1, 1, 0, 4, 1, '1723746023', '1723746023'),
(7, 2, '66c0739cb8373.jpg', 'fvre', 'vrv4r', 1, 0, 0, 5, 1, '1723888540', '1723888540'),
(8, 2, '66c073b345bd1.jpg', 'egtg', 'tt3', 1, 0, 0, 6, 1, '1723888564', '1723974610');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `email`, `name`, `role`) VALUES
(1, 'admin', '$2y$10$17LrPghaMVqZqOHcd5r4IO8LQBuylXjqEE5xxbraaP3MNIG/qHeiO', 'vitalbu@tut.by', 'admin', 'admin'),
(2, 'user', '$2y$10$W53odEikkewe14vbGTc1Eei/11VbCq.LLC91boBxwV/KnRcmi55s6', 'guest@tut.by', 'user', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alias` (`alias`);

--
-- Индексы таблицы `albumcomment`
--
ALTER TABLE `albumcomment`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `albumimg`
--
ALTER TABLE `albumimg`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `albumcomment`
--
ALTER TABLE `albumcomment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `albumimg`
--
ALTER TABLE `albumimg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

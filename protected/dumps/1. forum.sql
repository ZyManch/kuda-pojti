-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Фев 02 2014 г., 11:43
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `kudapojti_forum`
--

-- --------------------------------------------------------

--
-- Структура таблицы `forums`
--

CREATE TABLE IF NOT EXISTS `forums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8_bin NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `topic_count` int(11) NOT NULL DEFAULT '0',
  `last_user_id` int(11) DEFAULT NULL,
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `forums`
--

INSERT INTO `forums` (`id`, `title`, `parent_id`, `user_id`, `topic_count`, `last_user_id`, `changed`) VALUES
(1, 'Долина Грез', 2, 5, 2, 5, '2012-04-22 19:21:21'),
(2, 'Кура', 2, 5, 0, 5, '2012-04-26 06:28:25'),
(3, 'Дока пицца', 2, 5, 0, 5, '2012-04-28 10:17:22');

-- --------------------------------------------------------

--
-- Структура таблицы `forums_cats`
--

CREATE TABLE IF NOT EXISTS `forums_cats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8_bin NOT NULL,
  `avatar` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `visible` enum('Yes','No') COLLATE utf8_bin NOT NULL DEFAULT 'Yes',
  `forum_count` int(11) NOT NULL DEFAULT '0',
  `topic_count` int(11) NOT NULL DEFAULT '0',
  `last_user_id` int(11) DEFAULT NULL,
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `forums_cats`
--

INSERT INTO `forums_cats` (`id`, `title`, `avatar`, `parent_id`, `position`, `visible`, `forum_count`, `topic_count`, `last_user_id`, `changed`) VALUES
(1, 'Комментарии', NULL, NULL, 1, 'No', 0, 0, NULL, '2012-04-10 21:00:00'),
(2, 'Москва', 'city', 1, 2, 'Yes', 3, 2, 5, '2012-04-24 05:25:13'),
(3, 'Предложения', NULL, NULL, 2, 'Yes', 0, 0, NULL, '2012-04-06 05:32:15'),
(4, 'По функционалу сайта', 'site', 3, 1, 'Yes', 0, 0, NULL, '2012-04-06 05:32:57'),
(5, 'По функционалу форума', 'forum', 3, 2, 'Yes', 0, 0, NULL, '2012-04-06 05:32:57'),
(6, 'Поправки в описаниях', 'content', 3, 3, 'Yes', 0, 0, NULL, '2012-04-06 05:33:50'),
(7, 'События', NULL, NULL, 4, 'Yes', 0, 0, NULL, '2012-04-06 05:35:50'),
(8, 'Покатушки', 'roller', 7, 1, 'Yes', 0, 0, NULL, '2012-04-22 18:25:06'),
(9, 'Походы', 'tree', 7, 2, 'Yes', 0, 0, NULL, '2012-04-06 05:36:47'),
(10, 'Путешествия', 'aier', 7, 3, 'Yes', 0, 0, NULL, '2012-04-22 18:25:06');

-- --------------------------------------------------------

--
-- Структура таблицы `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_id` int(11) NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `content_html` text COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `topics`
--

INSERT INTO `topics` (`id`, `forum_id`, `content`, `content_html`, `user_id`, `changed`) VALUES
(1, 1, 'фывфывфыв', '', 5, '2012-04-24 05:45:22'),
(2, 1, '111111111111111', '', 5, '2012-04-24 05:46:52');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_bin NOT NULL,
  `email` varchar(32) COLLATE utf8_bin NOT NULL,
  `pass` varchar(32) COLLATE utf8_bin NOT NULL,
  `type` enum('user','moderator','root') COLLATE utf8_bin NOT NULL DEFAULT 'user',
  `avatar` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT 'default.png',
  `changed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `pass`, `type`, `avatar`, `changed`) VALUES
(1, 'asdasdasdasd', '', '', 'user', 'default.png', '2012-04-04 06:11:52'),
(5, 'Юсупов Ренат', 'zymanch@gmail.com', '5a1ac8570899aa7977134c29e7fa4a8e', 'root', 'default.png', '2012-04-08 18:42:20'),
(6, 'Ренат', 'zymanch+1@gmail.com', 'c7ba97dc5572d85d0e22ae69c6b82760', 'user', 'default.png', '2012-04-09 05:25:12');

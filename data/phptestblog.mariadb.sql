-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор',
  `postId` bigint(20) unsigned NOT NULL COMMENT 'Пост',
  `author` varchar(80) NOT NULL COMMENT 'Автор',
  `text` text NOT NULL COMMENT 'Текст',
  `createdAt` timestamp NULL DEFAULT NULL COMMENT 'Таймштамп',
  `updatedAt` timestamp NULL DEFAULT NULL COMMENT 'Таймштамп обновления',
  PRIMARY KEY (`id`),
  KEY `postId` (`postId`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`postId`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Комментарии';

INSERT INTO `comments` (`id`, `postId`, `author`, `text`, `createdAt`, `updatedAt`) VALUES
(1,	1,	'Саша',	'Тест',	'2018-03-15 18:47:38',	NULL),
(2,	1,	'Саша',	'Тест',	'2018-03-15 18:47:55',	NULL),
(3,	1,	'Саша',	'Тест',	'2018-03-15 18:47:57',	NULL),
(4,	2,	'Саша',	'Тест',	'2018-03-15 18:48:02',	NULL),
(5,	2,	'Саша',	'Тест',	'2018-03-15 18:48:03',	NULL),
(8,	3,	'Саша',	'Тестовый комментарий',	'2018-03-15 18:58:43',	NULL),
(9,	4,	'Саша',	'Тестовый комментарий',	'2018-03-15 18:59:58',	NULL),
(10,	5,	'Саша',	'Тестовый комментарий',	'2018-03-15 18:59:58',	NULL),
(11,	5,	'Саша',	'Тестовый комментарий',	'2018-03-15 19:01:13',	NULL),
(19,	5,	'Сергей',	'Новый комментарий\r\nС переносами\r\nСтрок',	'2018-03-16 07:36:28',	NULL),
(20,	4,	'Виталий',	'Какой-то\r\nтекст\r\nс\r\nпереносами\r\nстрок.',	'2018-03-16 08:08:57',	NULL),
(21,	6,	'Сергей',	'Ну ваще офигенный текст.',	'2018-03-16 08:13:01',	NULL),
(22,	6,	'Николай',	'Нет, текст плохой.',	'2018-03-16 08:13:11',	NULL),
(23,	5,	'Виталий',	'Очень популярный пост.\r\n\r\nДобавлю-ка\r\n\r\nЕщё\r\n\r\nОдин\r\n\r\nКомментарий',	'2018-03-16 08:20:58',	NULL);

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор',
  `title` varchar(80) NOT NULL COMMENT 'Заголовок',
  `author` varchar(80) NOT NULL COMMENT 'Автор',
  `category` enum('technology','design','culture','business','politics','science','health','style','travel','other') NOT NULL DEFAULT 'other' COMMENT 'Категория',
  `text` text NOT NULL COMMENT 'Текст',
  `createdAt` timestamp NULL DEFAULT NULL COMMENT 'Таймштамп',
  `updatedAt` timestamp NULL DEFAULT NULL COMMENT 'Таймштамп обновления',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Посты';

INSERT INTO `posts` (`id`, `title`, `author`, `category`, `text`, `createdAt`, `updatedAt`) VALUES
(1,	'Первый пост',	'Саша Максимал',	'other',	'This blog post shows a few different types of content that\'s supported and styled with Bootstrap. Basic typography, images, and code are all supported.\r\n\r\nCum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.\r\n\r\nCurabitur blandit tempus porttitor. Nullam quis risus eget urna mollis ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.\r\n\r\nEtiam porta sem malesuada magna mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.',	'2018-01-16 08:05:07',	NULL),
(2,	'Второй пост пост',	'Саша Максимал',	'technology',	'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.\r\n\r\nThis blog post shows a few different types of content that\'s supported and styled with Bootstrap. Basic typography, images, and code are all supported.\r\n\r\nCurabitur blandit tempus porttitor. Nullam quis risus eget urna mollis ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.\r\n\r\nEtiam porta sem malesuada magna mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.',	'2018-02-15 16:00:31',	NULL),
(3,	'asdfasdf',	'ffffffffffffff',	'politics',	'Curabitur blandit tempus porttitor. Nullam quis risus eget urna mollis ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.\r\n\r\nEtiam porta sem malesuada magna mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.\r\n\r\nVivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.',	'2018-03-15 19:00:42',	NULL),
(4,	'asdfasdf',	'asdfasdf',	'style',	'Etiam porta sem malesuada magna mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.\r\n\r\nVivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.',	'2018-03-15 18:59:27',	NULL),
(5,	'Самый популярный пост',	'Коммент Комментов',	'science',	'Это самый популярный пост, у него много комментариев.\r\n\r\nVivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.\r\n\r\nEtiam porta sem malesuada magna mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.',	'2018-03-15 19:01:30',	NULL),
(6,	'Новый пост про дизайн',	'Автор Авторович Авторов',	'design',	'Пишу\r\n\r\nмного пишу\r\nпро дизайн\r\n\r\nИ ещё немного про другой дизайн.\r\n\r\nПишу\r\n\r\nмного пишу\r\nпро дизайн\r\n\r\nИ ещё немного про другой дизайн.\r\n\r\nПишу\r\n\r\nмного пишу\r\nпро дизайн\r\n\r\nИ ещё немного про другой дизайн.\r\n\r\nПишу\r\n\r\nмного пишу\r\nпро дизайн\r\n\r\nИ ещё немного про другой дизайн.',	'2018-03-16 08:10:07',	NULL),
(7,	'Ещё пост',	'Виталий',	'other',	'Тест',	'2018-03-16 08:22:01',	NULL),
(8,	'Заголовок',	'Виталий',	'other',	'asdfasdf',	'2018-03-16 08:53:06',	NULL);

-- 2018-03-16 09:32:55

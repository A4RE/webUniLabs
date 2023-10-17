-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Мар 15 2023 г., 18:05
-- Версия сервера: 5.7.39
-- Версия PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `nba`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Игроки`
--

CREATE TABLE `Игроки` (
  `ID_Игрока` int(7) NOT NULL,
  `Фамилия` varchar(20) NOT NULL,
  `Имя` varchar(20) NOT NULL,
  `Дата_рождения` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Рост` int(3) NOT NULL,
  `Гражданство` varchar(30) NOT NULL,
  `ID_Позиции` int(7) NOT NULL,
  `Кол_очков` int(4) NOT NULL,
  `Кол_подборов` int(4) NOT NULL,
  `Кол_передач` int(4) NOT NULL,
  `Кол_блоков` int(4) NOT NULL,
  `Кол_трех` int(4) NOT NULL,
  `Кол_штрафных` int(4) NOT NULL,
  `Кол_наруш` int(4) NOT NULL,
  `Кол_потерь` int(4) NOT NULL,
  `ID_Команды` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Игроки`
--

INSERT INTO `Игроки` (`ID_Игрока`, `Фамилия`, `Имя`, `Дата_рождения`, `Рост`, `Гражданство`, `ID_Позиции`, `Кол_очков`, `Кол_подборов`, `Кол_передач`, `Кол_блоков`, `Кол_трех`, `Кол_штрафных`, `Кол_наруш`, `Кол_потерь`, `ID_Команды`) VALUES
(1, 'Джеймс', 'Леброн', '1984-12-30 16:17:34', 203, 'США', 4, 1353, 372, 284, 45, 128, 207, 99, 156, 9),
(2, 'Дюран', 'Кевин', '1988-09-29 16:20:37', 206, 'США', 4, 1121, 277, 219, 37, 73, 246, 74, 117, 1),
(3, 'Яннис', 'Адектокунбо', '1994-12-06 16:25:07', 206, 'Греция', 3, 1579, 627, 324, 77, 60, 441, 175, 180, 2),
(4, 'Эмбит', 'Джоэл', '1994-03-16 00:00:00', 213, 'Камерун', 5, 1503, 568, 224, 73, 67, 488, 136, 151, 4),
(5, 'Дончич', 'Лука', '1999-02-28 00:00:00', 201, 'Словения', 2, 1335, 396, 422, 25, 132, 263, 115, 219, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `Интервью`
--

CREATE TABLE `Интервью` (
  `ID_Интервью` int(7) NOT NULL,
  `Тип_Интервью` int(7) NOT NULL,
  `Дата_Интервью` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ID_Игрока` int(7) NOT NULL,
  `ID_Медиа` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Интервью`
--

INSERT INTO `Интервью` (`ID_Интервью`, `Тип_Интервью`, `Дата_Интервью`, `ID_Игрока`, `ID_Медиа`) VALUES
(1, 1, '2021-03-01 16:50:59', 1, 2),
(2, 2, '2023-03-03 16:51:26', 5, 8),
(3, 3, '2023-03-06 16:51:26', 2, 2),
(4, 3, '2023-03-10 16:51:26', 1, 8),
(5, 2, '2023-03-02 16:51:26', 4, 4),
(6, 1, '2023-03-02 16:51:26', 3, 1),
(7, 2, '2023-03-10 16:51:26', 5, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `Инфополе_матча`
--

CREATE TABLE `Инфополе_матча` (
  `ID_Бренда` int(7) NOT NULL,
  `ID_Интервью` int(7) NOT NULL,
  `ID_Профессии` int(7) NOT NULL,
  `ID_матча` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Инфополе_матча`
--

INSERT INTO `Инфополе_матча` (`ID_Бренда`, `ID_Интервью`, `ID_Профессии`, `ID_матча`) VALUES
(1, 2, 4, 2),
(2, 6, 2, 2),
(4, 3, 3, 5),
(5, 5, 5, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `Команды`
--

CREATE TABLE `Команды` (
  `ID_Команды` int(7) NOT NULL,
  `Название` varchar(30) NOT NULL,
  `Кол_побед` int(3) NOT NULL,
  `Кол_поражений` int(3) NOT NULL,
  `ID_Конференции` int(7) NOT NULL,
  `Позиция_в_конф` int(3) NOT NULL,
  `Позиция_в_лиге` int(3) NOT NULL,
  `Штат` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Команды`
--

INSERT INTO `Команды` (`ID_Команды`, `Название`, `Кол_побед`, `Кол_поражений`, `ID_Конференции`, `Позиция_в_конф`, `Позиция_в_лиге`, `Штат`) VALUES
(1, 'Милуоки Бакс', 34, 25, 1, 3, 7, 'Милуоки, Висконсин'),
(2, 'Финикс Санз', 34, 13, 2, 1, 1, 'Финикс, Аризона'),
(3, 'Мемфис Гриззлиз', 44, 22, 2, 3, 3, 'Мемфис, Теннесси'),
(4, 'Голден Стэйт Уорриорз', 43, 21, 2, 2, 2, 'Сан-Франциско, Калифорния'),
(5, 'Майами Хит', 43, 22, 1, 1, 4, 'Майами, Флорида'),
(6, 'Юта Джаз', 40, 23, 2, 4, 5, 'Солт-Лэйк_Сити, Юта'),
(7, 'Филадельфия', 39, 24, 1, 2, 6, 'Филадельфия, Пенсильвания'),
(8, 'Чикаго Буллз', 33, 25, 1, 4, 8, 'Чикаго, Иллинойс'),
(9, 'Лос-Анджелес Лейкерс', 28, 35, 2, 9, 20, 'Калифорния');

-- --------------------------------------------------------

--
-- Структура таблицы `Конференция`
--

CREATE TABLE `Конференция` (
  `ID_конф` int(7) NOT NULL,
  `Название_конф` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Конференция`
--

INSERT INTO `Конференция` (`ID_конф`, `Название_конф`) VALUES
(1, 'Восточная'),
(2, 'Западная'),
(3, 'Центральная'),
(4, 'Южная');

-- --------------------------------------------------------

--
-- Структура таблицы `Матчи`
--

CREATE TABLE `Матчи` (
  `ID_Матча` int(7) NOT NULL,
  `Место_провед` varchar(50) NOT NULL,
  `Дата_матча` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ID_Победителя` int(7) NOT NULL,
  `Счет` int(3) NOT NULL,
  `ID_Медиа` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Матчи`
--

INSERT INTO `Матчи` (`ID_Матча`, `Место_провед`, `Дата_матча`, `ID_Победителя`, `Счет`, `ID_Медиа`) VALUES
(1, 'Футпринт Центр', '2023-03-01 16:53:40', 4, 104, 5),
(2, 'Скотиабанк-Арена', '2023-03-04 16:53:40', 9, 83, 5),
(3, 'Крипто.ком-Арена', '2023-03-06 16:54:45', 7, 114, 4),
(4, 'Файсерв-форум', '2023-03-10 16:54:45', 3, 127, 2),
(5, 'Банкерс Лайф Филдхаус', '2023-03-09 16:54:45', 6, 115, 6),
(6, 'Рокет Мортгедж Филдхаус', '2023-03-07 16:54:45', 4, 78, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `Медиа`
--

CREATE TABLE `Медиа` (
  `ID_Медиа` int(7) NOT NULL,
  `Фамилия` varchar(20) NOT NULL,
  `Имя` varchar(20) NOT NULL,
  `Общая_инф` varchar(200) NOT NULL,
  `ID_профессии` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Медиа`
--

INSERT INTO `Медиа` (`ID_Медиа`, `Фамилия`, `Имя`, `Общая_инф`, `ID_профессии`) VALUES
(1, 'Элдридж', 'Дэвид', 'Освещает NBA матчи', 1),
(2, 'О\'Нил', 'Шакил', 'Бывший профессиональный баскетболист, баскетбольный телеэксперт', 3),
(3, 'Баркли', 'Чарльз', 'Бывший профессиональный баскетболист, баскетбольный телеэксперт', 3),
(4, 'Смит', 'Кенни', 'Бывший профессиональный баскетболист', 3),
(5, 'Джонсон-мл', 'Эрни', 'Спортивный комментатор Turner Sports', 2),
(6, 'Даймьеля', 'Антони', 'Испанский обозреватель баскетбола', 4),
(7, 'Хикс', 'Дэн', 'Диктор телеканала NBC', 5),
(8, 'Марк', 'Джонс', 'Канадский спортивный диктор ABC, ESPN', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `Медиа_профессия`
--

CREATE TABLE `Медиа_профессия` (
  `ID_профессии` int(7) NOT NULL,
  `Название` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Медиа_профессия`
--

INSERT INTO `Медиа_профессия` (`ID_профессии`, `Название`) VALUES
(1, 'Ведущий'),
(2, 'Комментатор'),
(3, 'Аналитик'),
(4, 'Журналист'),
(5, 'Спортивный обозреватель'),
(6, 'Оператор');

-- --------------------------------------------------------

--
-- Структура таблицы `Позиция`
--

CREATE TABLE `Позиция` (
  `ID_Позиции` int(7) NOT NULL,
  `Название_поз` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Позиция`
--

INSERT INTO `Позиция` (`ID_Позиции`, `Название_поз`) VALUES
(1, 'PG'),
(2, 'SG'),
(3, 'PF'),
(4, 'SF'),
(5, 'C');

-- --------------------------------------------------------

--
-- Структура таблицы `Рекламные_бренды`
--

CREATE TABLE `Рекламные_бренды` (
  `ID_Бренда` int(7) NOT NULL,
  `Название` varchar(100) NOT NULL,
  `Основная_продукция` varchar(200) NOT NULL,
  `ID_Игрока` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Рекламные_бренды`
--

INSERT INTO `Рекламные_бренды` (`ID_Бренда`, `Название`, `Основная_продукция`, `ID_Игрока`) VALUES
(1, 'Jordan', 'Обувь; Одежда', 5),
(2, 'Reebok', 'Обувь; Одежда', 2),
(3, 'Under Armor', 'Обувь; Одежда', 4),
(4, 'Adidas', 'Обувь; Одежда', 3),
(5, 'Nike', 'Обувь; Одежда', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `Тип_интервью`
--

CREATE TABLE `Тип_интервью` (
  `ID_Типа` int(7) NOT NULL,
  `Название` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Тип_интервью`
--

INSERT INTO `Тип_интервью` (`ID_Типа`, `Название`) VALUES
(1, 'Пре-гейм'),
(2, 'Пост-гейм'),
(3, 'Спонсорское');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Игроки`
--
ALTER TABLE `Игроки`
  ADD PRIMARY KEY (`ID_Игрока`),
  ADD KEY `ID_Команды` (`ID_Команды`),
  ADD KEY `игроки_ibfk_2` (`ID_Позиции`);

--
-- Индексы таблицы `Интервью`
--
ALTER TABLE `Интервью`
  ADD PRIMARY KEY (`ID_Интервью`),
  ADD KEY `ID_Игрока` (`ID_Игрока`),
  ADD KEY `интервью_ibfk_2` (`ID_Медиа`),
  ADD KEY `интервью_ibfk_3` (`Тип_Интервью`);

--
-- Индексы таблицы `Инфополе_матча`
--
ALTER TABLE `Инфополе_матча`
  ADD PRIMARY KEY (`ID_Бренда`),
  ADD KEY `инфополе_матча_ibfk_2` (`ID_Интервью`),
  ADD KEY `инфополе_матча_ibfk_3` (`ID_Профессии`),
  ADD KEY `инфополе_матча_ibfk_4` (`ID_матча`);

--
-- Индексы таблицы `Команды`
--
ALTER TABLE `Команды`
  ADD PRIMARY KEY (`ID_Команды`),
  ADD KEY `ID_Конференции` (`ID_Конференции`);

--
-- Индексы таблицы `Конференция`
--
ALTER TABLE `Конференция`
  ADD PRIMARY KEY (`ID_конф`);

--
-- Индексы таблицы `Матчи`
--
ALTER TABLE `Матчи`
  ADD PRIMARY KEY (`ID_Матча`),
  ADD KEY `ID_Победителя` (`ID_Победителя`),
  ADD KEY `матчи_ibfk_2` (`ID_Медиа`);

--
-- Индексы таблицы `Медиа`
--
ALTER TABLE `Медиа`
  ADD PRIMARY KEY (`ID_Медиа`),
  ADD KEY `ID_профессии` (`ID_профессии`);

--
-- Индексы таблицы `Медиа_профессия`
--
ALTER TABLE `Медиа_профессия`
  ADD PRIMARY KEY (`ID_профессии`);

--
-- Индексы таблицы `Позиция`
--
ALTER TABLE `Позиция`
  ADD PRIMARY KEY (`ID_Позиции`);

--
-- Индексы таблицы `Рекламные_бренды`
--
ALTER TABLE `Рекламные_бренды`
  ADD PRIMARY KEY (`ID_Бренда`),
  ADD KEY `ID_Игрока` (`ID_Игрока`);

--
-- Индексы таблицы `Тип_интервью`
--
ALTER TABLE `Тип_интервью`
  ADD PRIMARY KEY (`ID_Типа`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Игроки`
--
ALTER TABLE `Игроки`
  MODIFY `ID_Игрока` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `Интервью`
--
ALTER TABLE `Интервью`
  MODIFY `ID_Интервью` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `Инфополе_матча`
--
ALTER TABLE `Инфополе_матча`
  MODIFY `ID_Бренда` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Команды`
--
ALTER TABLE `Команды`
  MODIFY `ID_Команды` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `Конференция`
--
ALTER TABLE `Конференция`
  MODIFY `ID_конф` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Матчи`
--
ALTER TABLE `Матчи`
  MODIFY `ID_Матча` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `Медиа`
--
ALTER TABLE `Медиа`
  MODIFY `ID_Медиа` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `Медиа_профессия`
--
ALTER TABLE `Медиа_профессия`
  MODIFY `ID_профессии` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `Позиция`
--
ALTER TABLE `Позиция`
  MODIFY `ID_Позиции` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Рекламные_бренды`
--
ALTER TABLE `Рекламные_бренды`
  MODIFY `ID_Бренда` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Тип_интервью`
--
ALTER TABLE `Тип_интервью`
  MODIFY `ID_Типа` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Игроки`
--
ALTER TABLE `Игроки`
  ADD CONSTRAINT `игроки_ibfk_1` FOREIGN KEY (`ID_Команды`) REFERENCES `Команды` (`ID_Команды`),
  ADD CONSTRAINT `игроки_ibfk_2` FOREIGN KEY (`ID_Позиции`) REFERENCES `Позиция` (`ID_Позиции`);

--
-- Ограничения внешнего ключа таблицы `Интервью`
--
ALTER TABLE `Интервью`
  ADD CONSTRAINT `интервью_ibfk_1` FOREIGN KEY (`ID_Игрока`) REFERENCES `Игроки` (`ID_Игрока`),
  ADD CONSTRAINT `интервью_ibfk_2` FOREIGN KEY (`ID_Медиа`) REFERENCES `Медиа` (`ID_Медиа`),
  ADD CONSTRAINT `интервью_ibfk_3` FOREIGN KEY (`Тип_Интервью`) REFERENCES `Тип_интервью` (`ID_Типа`);

--
-- Ограничения внешнего ключа таблицы `Инфополе_матча`
--
ALTER TABLE `Инфополе_матча`
  ADD CONSTRAINT `инфополе_матча_ibfk_1` FOREIGN KEY (`ID_Бренда`) REFERENCES `Рекламные_бренды` (`ID_Бренда`),
  ADD CONSTRAINT `инфополе_матча_ibfk_2` FOREIGN KEY (`ID_Интервью`) REFERENCES `Интервью` (`ID_Интервью`),
  ADD CONSTRAINT `инфополе_матча_ibfk_3` FOREIGN KEY (`ID_Профессии`) REFERENCES `Медиа_профессия` (`ID_профессии`),
  ADD CONSTRAINT `инфополе_матча_ibfk_4` FOREIGN KEY (`ID_матча`) REFERENCES `Матчи` (`ID_Матча`);

--
-- Ограничения внешнего ключа таблицы `Команды`
--
ALTER TABLE `Команды`
  ADD CONSTRAINT `команды_ibfk_1` FOREIGN KEY (`ID_Конференции`) REFERENCES `Конференция` (`ID_конф`);

--
-- Ограничения внешнего ключа таблицы `Матчи`
--
ALTER TABLE `Матчи`
  ADD CONSTRAINT `матчи_ibfk_1` FOREIGN KEY (`ID_Победителя`) REFERENCES `Команды` (`ID_Команды`),
  ADD CONSTRAINT `матчи_ibfk_2` FOREIGN KEY (`ID_Медиа`) REFERENCES `Медиа` (`ID_Медиа`);

--
-- Ограничения внешнего ключа таблицы `Медиа`
--
ALTER TABLE `Медиа`
  ADD CONSTRAINT `медиа_ibfk_1` FOREIGN KEY (`ID_профессии`) REFERENCES `Медиа_профессия` (`ID_профессии`);

--
-- Ограничения внешнего ключа таблицы `Рекламные_бренды`
--
ALTER TABLE `Рекламные_бренды`
  ADD CONSTRAINT `рекламные_бренды_ibfk_1` FOREIGN KEY (`ID_Игрока`) REFERENCES `Игроки` (`ID_Игрока`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

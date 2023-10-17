-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Мар 21 2023 г., 18:22
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
-- База данных: `cafe`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Ассортимент`
--

CREATE TABLE `Ассортимент` (
  `ID_продукта` int(7) NOT NULL,
  `Наименование_вып` varchar(50) NOT NULL,
  `Описание_вып` varchar(100) NOT NULL,
  `Цена` float NOT NULL,
  `ID_Типа` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Ассортимент`
--

INSERT INTO `Ассортимент` (`ID_продукта`, `Наименование_вып`, `Описание_вып`, `Цена`, `ID_Типа`) VALUES
(1, 'Круассан классический', 'Круассан классический без начинки', 150, 4),
(2, 'Пончик', 'Пончик с глазурью', 34, 1),
(3, 'Пирожное картошка', 'Пирожное картошка', 80, 2),
(4, 'Слойка с сыром', 'Слойка с сыром', 110, 4),
(5, 'Салат Греческий', 'Салат Греческий', 180, 5),
(6, 'Кофе', 'Кофе', 120, 3),
(7, 'Вода', 'Вода с газом/без', 60, 3),
(8, 'Печенье', 'Печенье', 100, 1),
(9, 'Лимонад', 'Лимонад', 135, 3),
(10, 'Салат Цезарь', 'Салат Цезарь с курицей', 245, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `Должность`
--

CREATE TABLE `Должность` (
  `ID_Должности` int(7) NOT NULL,
  `Название` varchar(50) NOT NULL,
  `Описание` varchar(100) NOT NULL,
  `Оклад` float NOT NULL,
  `Процент_с_продаж` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Должность`
--

INSERT INTO `Должность` (`ID_Должности`, `Название`, `Описание`, `Оклад`, `Процент_с_продаж`) VALUES
(7, 'Директор', 'Управляющий кафе', 100000, 5),
(8, 'Официант', 'Официант в кафе', 35000, 2),
(9, 'Управляющий', 'Управляющий в зале', 60000, 3),
(10, 'Бармен', 'Бармен', 25000, 2),
(11, 'Повар', 'Повар в кафе', 45000, 0),
(12, 'Главный повар', 'Главный повар кафе', 65000, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `Заказ`
--

CREATE TABLE `Заказ` (
  `ID_Заказа` int(7) NOT NULL,
  `Цена` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Заказ`
--

INSERT INTO `Заказ` (`ID_Заказа`, `Цена`) VALUES
(9, 100),
(10, 460),
(11, 500),
(12, 250);

-- --------------------------------------------------------

--
-- Структура таблицы `Категории`
--

CREATE TABLE `Категории` (
  `ID_категории` int(7) NOT NULL,
  `ID_ассортимента` int(7) NOT NULL,
  `Количество` int(3) NOT NULL,
  `ID_Заказа` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Категории`
--

INSERT INTO `Категории` (`ID_категории`, `ID_ассортимента`, `Количество`, `ID_Заказа`) VALUES
(1, 1, 1, 9),
(2, 10, 1, 10),
(3, 1, 1, 10),
(4, 6, 1, 10),
(5, 6, 1, 12),
(6, 4, 1, 12),
(7, 2, 1, 12),
(8, 1, 2, 11),
(9, 5, 1, 11),
(10, 6, 1, 11);

-- --------------------------------------------------------

--
-- Структура таблицы `Кафе`
--

CREATE TABLE `Кафе` (
  `ID_кафе` int(7) NOT NULL,
  `Адрес` varchar(100) NOT NULL,
  `Вместимость` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Кафе`
--

INSERT INTO `Кафе` (`ID_кафе`, `Адрес`, `Вместимость`) VALUES
(1, 'Г.Санкт-Петербург, Приморский р-он, ул. Оптиков, д.34, к2', 50),
(2, 'Г.Санкт-Петербург, Московский р-он, ул. Гастелло, д.32, к1', 100),
(3, 'Г.Санкт-Петербург, Проспект Большевиков, Российский пр., д.8, к3', 25),
(4, 'Г.Санкт-Петербург, Крестовский остров, ул. Зенит, д.25', 30);

-- --------------------------------------------------------

--
-- Структура таблицы `Клиент`
--

CREATE TABLE `Клиент` (
  `ID_Клиента` int(7) NOT NULL,
  `Фамилия` varchar(20) NOT NULL,
  `Имя` varchar(20) NOT NULL,
  `Отчество` varchar(20) NOT NULL,
  `Телефон` varchar(12) NOT NULL,
  `Номер_карты` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Клиент`
--

INSERT INTO `Клиент` (`ID_Клиента`, `Фамилия`, `Имя`, `Отчество`, `Телефон`, `Номер_карты`) VALUES
(1, 'Гриневская', 'Елизавета', 'Андреевна', '+79053483443', 42462034),
(2, 'Ковалева', 'Евангелина', 'Сергеевна', '+79064634834', 25432150),
(3, 'Перегородиев', 'Данил', 'Александрович', '+79624115760', 34852341),
(4, 'Коваленко', 'Евангелина', 'Сергеевна', '+79034452344', 25678920);

-- --------------------------------------------------------

--
-- Структура таблицы `Реализация`
--

CREATE TABLE `Реализация` (
  `ID_Реализации` int(7) NOT NULL,
  `ID_Клиента` int(7) NOT NULL,
  `ID_Сотрудника` int(7) NOT NULL,
  `ID_Заказа` int(7) NOT NULL,
  `Дата` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Замечания` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Реализация`
--

INSERT INTO `Реализация` (`ID_Реализации`, `ID_Клиента`, `ID_Сотрудника`, `ID_Заказа`, `Дата`, `Замечания`) VALUES
(1, 1, 4, 10, '2023-03-01 17:34:23', 'нет'),
(2, 4, 4, 9, '2023-03-03 17:34:23', 'нет'),
(4, 2, 5, 11, '2023-03-04 17:38:52', 'нет'),
(5, 3, 5, 12, '2023-03-06 17:38:52', 'нет');

-- --------------------------------------------------------

--
-- Структура таблицы `Сотрудник`
--

CREATE TABLE `Сотрудник` (
  `ID_Сотрудника` int(7) NOT NULL,
  `Фамилия` varchar(20) NOT NULL,
  `Имя` varchar(20) NOT NULL,
  `Отчество` varchar(20) NOT NULL,
  `Телефон` varchar(12) NOT NULL,
  `Паспорт` varchar(11) NOT NULL,
  `ID_кафе` int(7) NOT NULL,
  `ID_Должности` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Сотрудник`
--

INSERT INTO `Сотрудник` (`ID_Сотрудника`, `Фамилия`, `Имя`, `Отчество`, `Телефон`, `Паспорт`, `ID_кафе`, `ID_Должности`) VALUES
(1, 'Свердлюченко', 'Алексей', 'Владимирович', '+79045423421', '4134 678023', 4, 7),
(2, 'Бондарева', 'Юлия', 'Андреевна', '+79634423485', '4234 567890', 2, 9),
(3, 'Андреев', 'Сергей', 'Михайлович', '+79043456780', '4450 678021', 4, 10),
(4, 'Романов', 'Игорь', 'Владимирович', '+79042234534', '4562 802156', 4, 8),
(5, 'Кузнецова', 'Дарья', 'Владимировна', '+79024456729', '4320 578030', 2, 8),
(6, 'Харченко', 'Сергей', 'Владимирович', '+79632434561', '4670 892031', 2, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `Тип`
--

CREATE TABLE `Тип` (
  `ID_Типа` int(7) NOT NULL,
  `Наименование` varchar(20) NOT NULL,
  `Описание` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Тип`
--

INSERT INTO `Тип` (`ID_Типа`, `Наименование`, `Описание`) VALUES
(1, 'Сладкая выпечка', 'Сладкая выпечка'),
(2, 'Пирожные', 'Пирожные'),
(3, 'Напитки', 'Напитки'),
(4, 'Выпечка', 'Обыкновенная выпечка'),
(5, 'Салаты', 'Салаты');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Ассортимент`
--
ALTER TABLE `Ассортимент`
  ADD PRIMARY KEY (`ID_продукта`),
  ADD KEY `ID_Типа` (`ID_Типа`);

--
-- Индексы таблицы `Должность`
--
ALTER TABLE `Должность`
  ADD PRIMARY KEY (`ID_Должности`);

--
-- Индексы таблицы `Заказ`
--
ALTER TABLE `Заказ`
  ADD PRIMARY KEY (`ID_Заказа`);

--
-- Индексы таблицы `Категории`
--
ALTER TABLE `Категории`
  ADD PRIMARY KEY (`ID_категории`),
  ADD KEY `ID_ассортимента` (`ID_ассортимента`),
  ADD KEY `категории_ibfk_2` (`ID_Заказа`);

--
-- Индексы таблицы `Кафе`
--
ALTER TABLE `Кафе`
  ADD PRIMARY KEY (`ID_кафе`);

--
-- Индексы таблицы `Клиент`
--
ALTER TABLE `Клиент`
  ADD PRIMARY KEY (`ID_Клиента`);

--
-- Индексы таблицы `Реализация`
--
ALTER TABLE `Реализация`
  ADD PRIMARY KEY (`ID_Реализации`),
  ADD KEY `реализация_ibfk_1` (`ID_Клиента`),
  ADD KEY `реализация_ibfk_2` (`ID_Заказа`),
  ADD KEY `реализация_ibfk_3` (`ID_Сотрудника`);

--
-- Индексы таблицы `Сотрудник`
--
ALTER TABLE `Сотрудник`
  ADD PRIMARY KEY (`ID_Сотрудника`),
  ADD KEY `ID_кафе` (`ID_кафе`),
  ADD KEY `сотрудник_ibfk_2` (`ID_Должности`);

--
-- Индексы таблицы `Тип`
--
ALTER TABLE `Тип`
  ADD PRIMARY KEY (`ID_Типа`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Ассортимент`
--
ALTER TABLE `Ассортимент`
  MODIFY `ID_продукта` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `Должность`
--
ALTER TABLE `Должность`
  MODIFY `ID_Должности` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `Заказ`
--
ALTER TABLE `Заказ`
  MODIFY `ID_Заказа` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `Категории`
--
ALTER TABLE `Категории`
  MODIFY `ID_категории` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `Кафе`
--
ALTER TABLE `Кафе`
  MODIFY `ID_кафе` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Клиент`
--
ALTER TABLE `Клиент`
  MODIFY `ID_Клиента` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT для таблицы `Реализация`
--
ALTER TABLE `Реализация`
  MODIFY `ID_Реализации` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Сотрудник`
--
ALTER TABLE `Сотрудник`
  MODIFY `ID_Сотрудника` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `Тип`
--
ALTER TABLE `Тип`
  MODIFY `ID_Типа` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Ассортимент`
--
ALTER TABLE `Ассортимент`
  ADD CONSTRAINT `ассортимент_ibfk_1` FOREIGN KEY (`ID_Типа`) REFERENCES `Тип` (`ID_Типа`);

--
-- Ограничения внешнего ключа таблицы `Категории`
--
ALTER TABLE `Категории`
  ADD CONSTRAINT `категории_ibfk_1` FOREIGN KEY (`ID_ассортимента`) REFERENCES `Ассортимент` (`ID_продукта`),
  ADD CONSTRAINT `категории_ibfk_2` FOREIGN KEY (`ID_Заказа`) REFERENCES `Заказ` (`ID_Заказа`);

--
-- Ограничения внешнего ключа таблицы `Реализация`
--
ALTER TABLE `Реализация`
  ADD CONSTRAINT `реализация_ibfk_1` FOREIGN KEY (`ID_Клиента`) REFERENCES `Клиент` (`ID_Клиента`),
  ADD CONSTRAINT `реализация_ibfk_2` FOREIGN KEY (`ID_Заказа`) REFERENCES `Заказ` (`ID_Заказа`),
  ADD CONSTRAINT `реализация_ibfk_3` FOREIGN KEY (`ID_Сотрудника`) REFERENCES `Сотрудник` (`ID_Сотрудника`);

--
-- Ограничения внешнего ключа таблицы `Сотрудник`
--
ALTER TABLE `Сотрудник`
  ADD CONSTRAINT `сотрудник_ibfk_1` FOREIGN KEY (`ID_кафе`) REFERENCES `Кафе` (`ID_кафе`),
  ADD CONSTRAINT `сотрудник_ibfk_2` FOREIGN KEY (`ID_Должности`) REFERENCES `Должность` (`ID_Должности`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

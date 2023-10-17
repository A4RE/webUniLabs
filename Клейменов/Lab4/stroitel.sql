-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Апр 17 2023 г., 13:48
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
-- База данных: `stroitel`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Акция`
--

CREATE TABLE `Акция` (
  `id_акции` int(7) NOT NULL,
  `Описание_акции` varchar(500) NOT NULL,
  `Начало_акции` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Конец_акции` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Акция`
--

INSERT INTO `Акция` (`id_акции`, `Описание_акции`, `Начало_акции`, `Конец_акции`) VALUES
(1, 'Описание акции 1', '2023-04-01 13:39:12', '2023-04-30 13:39:12'),
(2, 'Описание акции 2', '2023-04-21 13:39:12', '2023-04-29 13:39:12');

-- --------------------------------------------------------

--
-- Структура таблицы `Дом`
--

CREATE TABLE `Дом` (
  `id_дома` int(7) NOT NULL,
  `Название_проекта` varchar(100) NOT NULL,
  `Кол_этажей` int(5) NOT NULL,
  `Цена` decimal(10,2) NOT NULL,
  `id_макета` int(7) NOT NULL,
  `Фото_дома` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Дом`
--

INSERT INTO `Дом` (`id_дома`, `Название_проекта`, `Кол_этажей`, `Цена`, `id_макета`, `Фото_дома`) VALUES
(1, 'Проект 1', 2, '4000000.00', 1, 'assets/img/gaz.jpg'),
(2, 'Проект 2', 1, '2300000.00', 2, 'assets/img/kirp.jpg'),
(3, 'Проект 3', 1, '1500000.00', 4, 'assets/img/gaz.jpg'),
(4, 'Проект 4', 3, '5500000.00', 3, 'assets/img/tree.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `Клиент`
--

CREATE TABLE `Клиент` (
  `id_клиента` int(7) NOT NULL,
  `ФИО` varchar(255) NOT NULL,
  `Телефон` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `пароль` varchar(255) NOT NULL,
  `Дата_регистрации` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Логин` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Клиент`
--

INSERT INTO `Клиент` (`id_клиента`, `ФИО`, `Телефон`, `email`, `пароль`, `Дата_регистрации`, `Логин`) VALUES
(1, 'Каюмов Алексей Владимирович', '89064634834', 'kaum@mail.ru', '1234', '2023-04-17 12:48:38', ''),
(2, 'Мутко Артем Владимирович', '89064634850', 'mutko@mail.ru', '1234', '2023-04-17 12:48:38', ''),
(3, 'Киреев Алексей Владимирович', '89064634840', 'kiriev@mail.ru', '1234', '2023-04-17 12:48:38', ''),
(4, 'Суриков Михаил Петрович', '89064634822', 'surikov@mail.ru', '1234', '2023-04-17 12:48:38', ''),
(7, 'Коваленко Андрей Алексеевич', '89064634834', 'mablokochanelgame@gmail.com', '123456', '2023-04-17 13:02:04', ''),
(8, 'Коваленко Андрей Алексеевич', '89064634834', 'mablokochanelgame@gmail.com', '123456', '2023-04-17 13:08:23', 'aakoval');

-- --------------------------------------------------------

--
-- Структура таблицы `Корзина`
--

CREATE TABLE `Корзина` (
  `id_заказа` int(7) NOT NULL,
  `id_клиента` int(7) NOT NULL,
  `id_услуги` int(7) NOT NULL,
  `Дата_заказа` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Корзина`
--

INSERT INTO `Корзина` (`id_заказа`, `id_клиента`, `id_услуги`, `Дата_заказа`) VALUES
(1, 8, 1, '2023-04-17 13:16:48');

-- --------------------------------------------------------

--
-- Структура таблицы `Макет`
--

CREATE TABLE `Макет` (
  `id_макета` int(7) NOT NULL,
  `Название_макета` varchar(255) NOT NULL,
  `Фото` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Макет`
--

INSERT INTO `Макет` (`id_макета`, `Название_макета`, `Фото`) VALUES
(1, 'Светлый', 'assets/img/makets/1.jpeg'),
(2, 'Темный', 'assets/img/makets/2.jpeg'),
(3, 'StarWars', 'assets/img/makets/3.jpeg'),
(4, 'Batman', '');

-- --------------------------------------------------------

--
-- Структура таблицы `Сделка`
--

CREATE TABLE `Сделка` (
  `id_сделки` int(7) NOT NULL,
  `id_листа` int(7) NOT NULL,
  `id_клиента` int(7) NOT NULL,
  `Дата_сделки` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_статуса` int(7) NOT NULL,
  `Адрес` varchar(255) NOT NULL,
  `id_сотрудника` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Сделка`
--

INSERT INTO `Сделка` (`id_сделки`, `id_листа`, `id_клиента`, `Дата_сделки`, `id_статуса`, `Адрес`, `id_сотрудника`) VALUES
(1, 1, 1, '2023-04-04 17:18:44', 1, 'Санкт-Петербург, Камышовая, д.5', 1),
(2, 2, 3, '2023-04-04 17:18:44', 3, 'Санкт-Петербург, Камышовая, д.2', 2),
(3, 3, 2, '2023-04-04 17:18:44', 1, 'Санкт-Петербург, Камышовая, д.15', 3),
(4, 4, 4, '2023-04-04 17:18:44', 2, 'Санкт-Петербург, Камышовая, д.3', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `Сотрудник`
--

CREATE TABLE `Сотрудник` (
  `id_сотрудника` int(7) NOT NULL,
  `ФИО_сотрудника` varchar(255) NOT NULL,
  `Телефон_сотрудника` varchar(20) NOT NULL,
  `email_сотр` varchar(255) NOT NULL,
  `Пароль_сотр` varchar(255) NOT NULL,
  `Должность` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Сотрудник`
--

INSERT INTO `Сотрудник` (`id_сотрудника`, `ФИО_сотрудника`, `Телефон_сотрудника`, `email_сотр`, `Пароль_сотр`, `Должность`) VALUES
(1, 'Воробьев Илья Петрович', '89054453321', 'vorobey@mail.ru', '1234', 'Директор'),
(2, 'Ласьков Николай Владимирович', '890544534822', 'laskov@mail.ru', '1234', 'Прораб'),
(3, 'Милков Эрнест Олегович', '89044443482', 'minkov@mail.ru', '1234', 'Прораб'),
(4, 'Потапов Федор Михайлович', '890323345678', 'potapov@mail.ru', '1234', 'Строитель');

-- --------------------------------------------------------

--
-- Структура таблицы `Статус`
--

CREATE TABLE `Статус` (
  `id_статуса` int(7) NOT NULL,
  `название_статуса` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Статус`
--

INSERT INTO `Статус` (`id_статуса`, `название_статуса`) VALUES
(1, 'Готов'),
(2, 'Строится'),
(3, 'Котлован');

-- --------------------------------------------------------

--
-- Структура таблицы `Услуга`
--

CREATE TABLE `Услуга` (
  `id_услуги` int(7) NOT NULL,
  `id_материала` int(7) NOT NULL,
  `id_фундамента` int(7) NOT NULL,
  `id_макета` int(7) NOT NULL,
  `Стоимость_услуги` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Услуга`
--

INSERT INTO `Услуга` (`id_услуги`, `id_материала`, `id_фундамента`, `id_макета`, `Стоимость_услуги`) VALUES
(1, 1, 2, 1, '2000000.00'),
(2, 4, 4, 1, '1500000.00'),
(3, 2, 4, 2, '3000000.00');

-- --------------------------------------------------------

--
-- Структура таблицы `Фундамент`
--

CREATE TABLE `Фундамент` (
  `id_фундамента` int(7) NOT NULL,
  `Тип` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Фундамент`
--

INSERT INTO `Фундамент` (`id_фундамента`, `Тип`) VALUES
(1, 'Ленточный'),
(2, 'Столбчатый'),
(3, 'Свайный'),
(4, 'Плитный');

-- --------------------------------------------------------

--
-- Структура таблицы `Ценновой_лист`
--

CREATE TABLE `Ценновой_лист` (
  `id_листа` int(7) NOT NULL,
  `id_шаблона` int(7) NOT NULL,
  `id_дома` int(7) NOT NULL,
  `id_материала` int(7) NOT NULL,
  `id_фундамента` int(7) NOT NULL,
  `Стоимость` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Ценновой_лист`
--

INSERT INTO `Ценновой_лист` (`id_листа`, `id_шаблона`, `id_дома`, `id_материала`, `id_фундамента`, `Стоимость`) VALUES
(1, 4, 1, 2, 1, '5000000.00'),
(2, 3, 2, 1, 4, '6000000.00'),
(3, 1, 3, 3, 3, '3000000.00'),
(4, 2, 4, 1, 2, '4000000.00');

-- --------------------------------------------------------

--
-- Структура таблицы `материал`
--

CREATE TABLE `материал` (
  `id_материала` int(7) NOT NULL,
  `название_материала` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `материал`
--

INSERT INTO `материал` (`id_материала`, `название_материала`) VALUES
(1, 'Кирпич'),
(2, 'Камень'),
(3, 'Мрамор'),
(4, 'Дерево');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Акция`
--
ALTER TABLE `Акция`
  ADD PRIMARY KEY (`id_акции`);

--
-- Индексы таблицы `Дом`
--
ALTER TABLE `Дом`
  ADD PRIMARY KEY (`id_дома`),
  ADD KEY `id_макета` (`id_макета`);

--
-- Индексы таблицы `Клиент`
--
ALTER TABLE `Клиент`
  ADD PRIMARY KEY (`id_клиента`);

--
-- Индексы таблицы `Корзина`
--
ALTER TABLE `Корзина`
  ADD PRIMARY KEY (`id_заказа`),
  ADD KEY `id_клиента` (`id_клиента`),
  ADD KEY `корзина_ibfk_2` (`id_услуги`);

--
-- Индексы таблицы `Макет`
--
ALTER TABLE `Макет`
  ADD PRIMARY KEY (`id_макета`);

--
-- Индексы таблицы `Сделка`
--
ALTER TABLE `Сделка`
  ADD PRIMARY KEY (`id_сделки`),
  ADD KEY `id_клиента` (`id_клиента`),
  ADD KEY `сделка_ibfk_2` (`id_листа`),
  ADD KEY `сделка_ibfk_3` (`id_статуса`),
  ADD KEY `сделка_ibfk_4` (`id_сотрудника`);

--
-- Индексы таблицы `Сотрудник`
--
ALTER TABLE `Сотрудник`
  ADD PRIMARY KEY (`id_сотрудника`);

--
-- Индексы таблицы `Статус`
--
ALTER TABLE `Статус`
  ADD PRIMARY KEY (`id_статуса`);

--
-- Индексы таблицы `Услуга`
--
ALTER TABLE `Услуга`
  ADD PRIMARY KEY (`id_услуги`),
  ADD KEY `услуга_ibfk_1` (`id_материала`),
  ADD KEY `услуга_ibfk_2` (`id_макета`),
  ADD KEY `услуга_ibfk_3` (`id_фундамента`);

--
-- Индексы таблицы `Фундамент`
--
ALTER TABLE `Фундамент`
  ADD PRIMARY KEY (`id_фундамента`);

--
-- Индексы таблицы `Ценновой_лист`
--
ALTER TABLE `Ценновой_лист`
  ADD PRIMARY KEY (`id_листа`),
  ADD KEY `ценновой_лист_ibfk_1` (`id_дома`),
  ADD KEY `ценновой_лист_ibfk_2` (`id_материала`),
  ADD KEY `ценновой_лист_ibfk_3` (`id_фундамента`),
  ADD KEY `ценновой_лист_ibfk_4` (`id_шаблона`);

--
-- Индексы таблицы `материал`
--
ALTER TABLE `материал`
  ADD PRIMARY KEY (`id_материала`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Акция`
--
ALTER TABLE `Акция`
  MODIFY `id_акции` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `Дом`
--
ALTER TABLE `Дом`
  MODIFY `id_дома` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Клиент`
--
ALTER TABLE `Клиент`
  MODIFY `id_клиента` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `Корзина`
--
ALTER TABLE `Корзина`
  MODIFY `id_заказа` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `Макет`
--
ALTER TABLE `Макет`
  MODIFY `id_макета` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Сделка`
--
ALTER TABLE `Сделка`
  MODIFY `id_сделки` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Сотрудник`
--
ALTER TABLE `Сотрудник`
  MODIFY `id_сотрудника` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Статус`
--
ALTER TABLE `Статус`
  MODIFY `id_статуса` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `Услуга`
--
ALTER TABLE `Услуга`
  MODIFY `id_услуги` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `Фундамент`
--
ALTER TABLE `Фундамент`
  MODIFY `id_фундамента` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Ценновой_лист`
--
ALTER TABLE `Ценновой_лист`
  MODIFY `id_листа` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `материал`
--
ALTER TABLE `материал`
  MODIFY `id_материала` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Дом`
--
ALTER TABLE `Дом`
  ADD CONSTRAINT `дом_ibfk_1` FOREIGN KEY (`id_макета`) REFERENCES `Макет` (`id_макета`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Корзина`
--
ALTER TABLE `Корзина`
  ADD CONSTRAINT `корзина_ibfk_1` FOREIGN KEY (`id_клиента`) REFERENCES `Клиент` (`id_клиента`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `корзина_ibfk_2` FOREIGN KEY (`id_услуги`) REFERENCES `Услуга` (`id_услуги`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Сделка`
--
ALTER TABLE `Сделка`
  ADD CONSTRAINT `сделка_ibfk_1` FOREIGN KEY (`id_клиента`) REFERENCES `Клиент` (`id_клиента`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `сделка_ibfk_2` FOREIGN KEY (`id_листа`) REFERENCES `Ценновой_лист` (`id_листа`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `сделка_ibfk_3` FOREIGN KEY (`id_статуса`) REFERENCES `Статус` (`id_статуса`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `сделка_ibfk_4` FOREIGN KEY (`id_сотрудника`) REFERENCES `Сотрудник` (`id_сотрудника`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Услуга`
--
ALTER TABLE `Услуга`
  ADD CONSTRAINT `услуга_ibfk_1` FOREIGN KEY (`id_материала`) REFERENCES `материал` (`id_материала`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `услуга_ibfk_2` FOREIGN KEY (`id_макета`) REFERENCES `Макет` (`id_макета`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `услуга_ibfk_3` FOREIGN KEY (`id_фундамента`) REFERENCES `Фундамент` (`id_фундамента`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Ценновой_лист`
--
ALTER TABLE `Ценновой_лист`
  ADD CONSTRAINT `ценновой_лист_ibfk_1` FOREIGN KEY (`id_дома`) REFERENCES `Дом` (`id_дома`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ценновой_лист_ibfk_2` FOREIGN KEY (`id_материала`) REFERENCES `материал` (`id_материала`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ценновой_лист_ibfk_3` FOREIGN KEY (`id_фундамента`) REFERENCES `Фундамент` (`id_фундамента`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ценновой_лист_ibfk_4` FOREIGN KEY (`id_шаблона`) REFERENCES `Макет` (`id_макета`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

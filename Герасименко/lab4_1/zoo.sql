-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Апр 26 2023 г., 11:52
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
-- База данных: `zoo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(7) NOT NULL,
  `Логин` varchar(255) NOT NULL,
  `Пароль` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id_admin`, `Логин`, `Пароль`) VALUES
(1, 'admin', 'aaa123');

-- --------------------------------------------------------

--
-- Структура таблицы `Билет`
--

CREATE TABLE `Билет` (
  `id_билета` int(7) NOT NULL,
  `id_зоопарка` int(7) NOT NULL,
  `Цена` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Билет`
--

INSERT INTO `Билет` (`id_билета`, `id_зоопарка`, `Цена`) VALUES
(1, 1, '300.00'),
(2, 3, '350.00'),
(3, 2, '500.00'),
(4, 5, '250.00'),
(5, 4, '400.00');

-- --------------------------------------------------------

--
-- Структура таблицы `Виды_жив`
--

CREATE TABLE `Виды_жив` (
  `ID_вида` int(7) NOT NULL,
  `Назв_вида` varchar(50) NOT NULL,
  `ID_Класса` int(7) NOT NULL,
  `Описание` varchar(1000) NOT NULL,
  `Фото_вида_жив` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Виды_жив`
--

INSERT INTO `Виды_жив` (`ID_вида`, `Назв_вида`, `ID_Класса`, `Описание`, `Фото_вида_жив`) VALUES
(1, 'минога', 1, '', 'assets/img/ziv/1.jpeg'),
(2, 'миксин', 1, '', 'assets/img/ziv/2.jpeg'),
(3, 'рыбы-иглы', 2, '', 'assets/img/ziv/3.jpeg'),
(4, 'тигровая акула', 2, '', 'assets/img/ziv/4.jpeg'),
(5, 'тритон гребенчатый', 3, '', 'assets/img/ziv/5.jpeg'),
(6, 'зеленая жаба', 3, '', 'assets/img/ziv/6.jpeg'),
(7, 'черепаха', 4, '', 'assets/img/ziv/7.jpeg'),
(8, 'крокодил', 4, '', 'assets/img/ziv/8.jpeg'),
(9, 'попугай', 5, '', 'assets/img/ziv/9.jpeg'),
(10, 'сова', 5, '', 'assets/img/ziv/10.jpeg'),
(11, 'слон', 6, '', 'assets/img/ziv/11.jpeg'),
(12, 'медведь', 6, '', 'assets/img/ziv/12.jpeg');

-- --------------------------------------------------------

--
-- Структура таблицы `Виды_пом`
--

CREATE TABLE `Виды_пом` (
  `ID_вид_п` int(7) NOT NULL,
  `Назв_пом` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Виды_пом`
--

INSERT INTO `Виды_пом` (`ID_вид_п`, `Назв_пом`) VALUES
(1, 'прививка'),
(2, 'осмотр'),
(3, 'операция');

-- --------------------------------------------------------

--
-- Структура таблицы `Должности`
--

CREATE TABLE `Должности` (
  `ID_Должности` int(7) NOT NULL,
  `Назв_должн` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Должности`
--

INSERT INTO `Должности` (`ID_Должности`, `Назв_должн`) VALUES
(1, 'аквариумист'),
(2, 'ветеринар-врач'),
(3, 'ветеринар-фельдшер'),
(4, 'зоотехник'),
(5, 'зоолог'),
(6, 'зоопсихолог'),
(7, 'орнитологов'),
(8, 'администрация'),
(9, 'охрана');

-- --------------------------------------------------------

--
-- Структура таблицы `Животные`
--

CREATE TABLE `Животные` (
  `ID_жив` int(7) NOT NULL,
  `Кличка` varchar(50) NOT NULL,
  `ID_вида` int(7) NOT NULL,
  `Родина` varchar(100) NOT NULL,
  `ID_зоопарка` int(7) NOT NULL,
  `Возраст` int(3) NOT NULL,
  `Дата_поступл` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ID_сотрудника` int(7) NOT NULL,
  `Рацион` varchar(250) NOT NULL,
  `Фото_животного` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Животные`
--

INSERT INTO `Животные` (`ID_жив`, `Кличка`, `ID_вида`, `Родина`, `ID_зоопарка`, `Возраст`, `Дата_поступл`, `ID_сотрудника`, `Рацион`, `Фото_животного`) VALUES
(1, 'Борис', 12, 'Россия', 1, 7, '2018-11-01 11:06:39', 2, 'Мясо, молоко, зелень, овощи', 'assets/img/ziv/12.jpeg'),
(2, 'Кеша', 9, 'Азия', 2, 3, '2023-03-01 11:08:14', 5, 'Корм, вода, зелень', 'assets/img/ziv/9.jpeg'),
(3, 'гена', 8, 'Южная Америка', 3, 10, '2018-03-14 11:08:14', 3, 'Мясо', 'assets/img/ziv/8.jpeg'),
(4, 'Иван', 11, 'Африка', 4, 12, '2019-03-14 11:08:14', 10, 'зелень, фрукты, овощи', 'assets/img/ziv/11.jpeg'),
(5, 'Кирил', 4, 'Индия', 5, 8, '2021-03-03 11:08:14', 7, 'Мясо', 'assets/img/ziv/4.jpeg'),
(6, 'Шарик', 12, 'Северная Америка', 1, 15, '2023-03-08 14:24:36', 10, 'Мясо', 'assets/img/ziv/12.jpeg');

-- --------------------------------------------------------

--
-- Структура таблицы `Зоопарк`
--

CREATE TABLE `Зоопарк` (
  `ID_зоопарка` int(7) NOT NULL,
  `Назв_зпарка` varchar(100) NOT NULL,
  `Город` varchar(100) NOT NULL,
  `Год_открытия` int(11) NOT NULL,
  `Телефон` varchar(15) NOT NULL,
  `Фотография` varchar(255) NOT NULL,
  `Адрес` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Зоопарк`
--

INSERT INTO `Зоопарк` (`ID_зоопарка`, `Назв_зпарка`, `Город`, `Год_открытия`, `Телефон`, `Фотография`, `Адрес`) VALUES
(1, 'Берлинский зоопарк', 'Берлин, Германия', 1844, '+4930254010', 'assets/img/zoo/1.jpeg', ''),
(2, 'Лондонский зоопарк', 'Лондон, Великобритания', 1828, '+443442251826', 'assets/img/zoo/2.jpeg', ''),
(3, 'Зоопарк Сингапура', 'Сингапур, ', 1973, '+6562693411', 'assets/img/zoo/3.jpeg', ''),
(4, 'Пражский зоопарк', 'Прага, Чехия', 1931, '+420296112230', 'assets/img/zoo/4.jpeg', ''),
(5, 'Московский зоопарк', 'Москва, Россия', 1864, '+74992522951', 'assets/img/zoo/5.jpeg', '');

-- --------------------------------------------------------

--
-- Структура таблицы `Классы_жив`
--

CREATE TABLE `Классы_жив` (
  `ID_класса` int(7) NOT NULL,
  `Назв_кл` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Классы_жив`
--

INSERT INTO `Классы_жив` (`ID_класса`, `Назв_кл`) VALUES
(1, 'круглоротые'),
(2, 'рыбы'),
(3, 'земноводные'),
(4, 'пресмыкающиеся'),
(5, 'птицы'),
(6, 'млекопитающие');

-- --------------------------------------------------------

--
-- Структура таблицы `Корзина`
--

CREATE TABLE `Корзина` (
  `id_заказа` int(7) NOT NULL,
  `id_посетителя` int(7) NOT NULL,
  `id_билета` int(7) NOT NULL,
  `Дата_заказа` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Корзина`
--

INSERT INTO `Корзина` (`id_заказа`, `id_посетителя`, `id_билета`, `Дата_заказа`) VALUES
(1, 1, 1, '2023-04-07 08:47:26'),
(2, 1, 2, '2023-04-07 08:47:26'),
(3, 1, 3, '2023-04-07 08:47:26'),
(4, 1, 1, '2023-04-07 08:49:40'),
(5, 2, 1, '2023-04-07 10:33:17');

-- --------------------------------------------------------

--
-- Структура таблицы `Мед_помощь`
--

CREATE TABLE `Мед_помощь` (
  `ID_помощи` int(7) NOT NULL,
  `ID_животного` int(7) NOT NULL,
  `ID_вида_п` int(7) NOT NULL,
  `Стоимость` float NOT NULL,
  `Дата_оказания` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Мед_помощь`
--

INSERT INTO `Мед_помощь` (`ID_помощи`, `ID_животного`, `ID_вида_п`, `Стоимость`, `Дата_оказания`) VALUES
(1, 1, 2, 10000, '2023-01-04 11:15:22'),
(2, 4, 1, 18000, '2022-09-01 11:15:22');

-- --------------------------------------------------------

--
-- Структура таблицы `Посетитель`
--

CREATE TABLE `Посетитель` (
  `id_посетителя` int(11) NOT NULL,
  `ФИО_посетителя` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `телефон` varchar(20) NOT NULL,
  `Логин` varchar(255) NOT NULL,
  `Пароль` varchar(255) NOT NULL,
  `дата_регистрации` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Посетитель`
--

INSERT INTO `Посетитель` (`id_посетителя`, `ФИО_посетителя`, `email`, `телефон`, `Логин`, `Пароль`, `дата_регистрации`) VALUES
(1, 'Коваленко Андрей Алексеевич', 'mablokochanelgame@gmail.com', '231221321', 'aakoval', '1234', '2023-04-07 07:58:45'),
(2, 'Герасименко Георгий', 'gerasimenko@gmail.com', '343243324', 'gerasimenko', '1234', '2023-04-07 10:27:02');

-- --------------------------------------------------------

--
-- Структура таблицы `Сотрудник`
--

CREATE TABLE `Сотрудник` (
  `ID_сотр` int(7) NOT NULL,
  `ФИО` varchar(250) NOT NULL,
  `Дата_рожд` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ID_должн` int(7) NOT NULL,
  `Оклад` int(11) NOT NULL,
  `ID_зоопарка` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Сотрудник`
--

INSERT INTO `Сотрудник` (`ID_сотр`, `ФИО`, `Дата_рожд`, `ID_должн`, `Оклад`, `ID_зоопарка`) VALUES
(1, 'Мамедов Илья Владимирович', '1985-03-02 10:48:22', 8, 105000, 1),
(2, 'Душкина Владислава Андреевна', '2001-03-02 10:48:22', 1, 45000, 1),
(3, 'Яковлев Егор Петрович', '1987-03-02 10:48:22', 2, 35000, 3),
(4, 'Яковлев Николай Андреевич', '1985-03-02 10:48:22', 3, 50000, 3),
(5, 'Измайлова Елизавета Николаевна', '1990-03-02 10:48:22', 5, 32000, 2),
(6, 'Карамазова Евангелина Александровна', '1998-03-02 10:48:22', 6, 78000, 2),
(7, 'Юнусов Николай Алексеевич', '1985-03-02 10:48:22', 4, 20000, 5),
(8, 'Патрушева Вероника Петровна', '1993-03-02 10:48:22', 7, 55000, 5),
(9, 'Мальцев Илья Петрович', '1978-03-02 10:48:22', 9, 18000, 4),
(10, 'Смирнова Кристина Анатольевна', '1985-03-02 10:48:22', 6, 61000, 4);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Индексы таблицы `Билет`
--
ALTER TABLE `Билет`
  ADD PRIMARY KEY (`id_билета`),
  ADD KEY `id_зоопарка` (`id_зоопарка`);

--
-- Индексы таблицы `Виды_жив`
--
ALTER TABLE `Виды_жив`
  ADD PRIMARY KEY (`ID_вида`),
  ADD KEY `ID_Класса` (`ID_Класса`);

--
-- Индексы таблицы `Виды_пом`
--
ALTER TABLE `Виды_пом`
  ADD PRIMARY KEY (`ID_вид_п`);

--
-- Индексы таблицы `Должности`
--
ALTER TABLE `Должности`
  ADD PRIMARY KEY (`ID_Должности`);

--
-- Индексы таблицы `Животные`
--
ALTER TABLE `Животные`
  ADD PRIMARY KEY (`ID_жив`),
  ADD KEY `ID_зоопарка` (`ID_зоопарка`),
  ADD KEY `животные_ibfk_2` (`ID_сотрудника`),
  ADD KEY `животные_ibfk_3` (`ID_вида`);

--
-- Индексы таблицы `Зоопарк`
--
ALTER TABLE `Зоопарк`
  ADD PRIMARY KEY (`ID_зоопарка`);

--
-- Индексы таблицы `Классы_жив`
--
ALTER TABLE `Классы_жив`
  ADD PRIMARY KEY (`ID_класса`);

--
-- Индексы таблицы `Корзина`
--
ALTER TABLE `Корзина`
  ADD PRIMARY KEY (`id_заказа`),
  ADD KEY `id_билета` (`id_билета`),
  ADD KEY `корзина_ibfk_2` (`id_посетителя`);

--
-- Индексы таблицы `Мед_помощь`
--
ALTER TABLE `Мед_помощь`
  ADD PRIMARY KEY (`ID_помощи`),
  ADD KEY `ID_животного` (`ID_животного`),
  ADD KEY `мед_помощь_ibfk_2` (`ID_вида_п`);

--
-- Индексы таблицы `Посетитель`
--
ALTER TABLE `Посетитель`
  ADD PRIMARY KEY (`id_посетителя`);

--
-- Индексы таблицы `Сотрудник`
--
ALTER TABLE `Сотрудник`
  ADD PRIMARY KEY (`ID_сотр`),
  ADD KEY `ID_зоопарка` (`ID_зоопарка`),
  ADD KEY `сотрудник_ibfk_2` (`ID_должн`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `Билет`
--
ALTER TABLE `Билет`
  MODIFY `id_билета` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Виды_жив`
--
ALTER TABLE `Виды_жив`
  MODIFY `ID_вида` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `Виды_пом`
--
ALTER TABLE `Виды_пом`
  MODIFY `ID_вид_п` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `Должности`
--
ALTER TABLE `Должности`
  MODIFY `ID_Должности` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `Животные`
--
ALTER TABLE `Животные`
  MODIFY `ID_жив` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `Зоопарк`
--
ALTER TABLE `Зоопарк`
  MODIFY `ID_зоопарка` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Классы_жив`
--
ALTER TABLE `Классы_жив`
  MODIFY `ID_класса` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `Корзина`
--
ALTER TABLE `Корзина`
  MODIFY `id_заказа` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Мед_помощь`
--
ALTER TABLE `Мед_помощь`
  MODIFY `ID_помощи` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `Посетитель`
--
ALTER TABLE `Посетитель`
  MODIFY `id_посетителя` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `Сотрудник`
--
ALTER TABLE `Сотрудник`
  MODIFY `ID_сотр` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Билет`
--
ALTER TABLE `Билет`
  ADD CONSTRAINT `билет_ibfk_1` FOREIGN KEY (`id_зоопарка`) REFERENCES `Зоопарк` (`ID_зоопарка`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Виды_жив`
--
ALTER TABLE `Виды_жив`
  ADD CONSTRAINT `виды_жив_ibfk_1` FOREIGN KEY (`ID_Класса`) REFERENCES `Классы_жив` (`ID_класса`);

--
-- Ограничения внешнего ключа таблицы `Животные`
--
ALTER TABLE `Животные`
  ADD CONSTRAINT `животные_ibfk_1` FOREIGN KEY (`ID_зоопарка`) REFERENCES `Зоопарк` (`ID_зоопарка`),
  ADD CONSTRAINT `животные_ibfk_2` FOREIGN KEY (`ID_сотрудника`) REFERENCES `Сотрудник` (`ID_сотр`),
  ADD CONSTRAINT `животные_ibfk_3` FOREIGN KEY (`ID_вида`) REFERENCES `Виды_жив` (`ID_вида`);

--
-- Ограничения внешнего ключа таблицы `Корзина`
--
ALTER TABLE `Корзина`
  ADD CONSTRAINT `корзина_ibfk_1` FOREIGN KEY (`id_билета`) REFERENCES `Билет` (`id_билета`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `корзина_ibfk_2` FOREIGN KEY (`id_посетителя`) REFERENCES `Посетитель` (`id_посетителя`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Мед_помощь`
--
ALTER TABLE `Мед_помощь`
  ADD CONSTRAINT `мед_помощь_ibfk_1` FOREIGN KEY (`ID_животного`) REFERENCES `Животные` (`ID_жив`),
  ADD CONSTRAINT `мед_помощь_ibfk_2` FOREIGN KEY (`ID_вида_п`) REFERENCES `Виды_пом` (`ID_вид_п`);

--
-- Ограничения внешнего ключа таблицы `Сотрудник`
--
ALTER TABLE `Сотрудник`
  ADD CONSTRAINT `сотрудник_ibfk_1` FOREIGN KEY (`ID_зоопарка`) REFERENCES `Зоопарк` (`ID_зоопарка`),
  ADD CONSTRAINT `сотрудник_ibfk_2` FOREIGN KEY (`ID_должн`) REFERENCES `Должности` (`ID_Должности`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

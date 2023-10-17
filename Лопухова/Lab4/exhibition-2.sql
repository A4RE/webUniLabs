-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Апр 06 2023 г., 10:16
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
-- База данных: `exhibition`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Автор`
--

CREATE TABLE `Автор` (
  `id_автора` int(7) NOT NULL,
  `ФИО_автора` varchar(255) NOT NULL,
  `Дата_рождения_автор` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Автор`
--

INSERT INTO `Автор` (`id_автора`, `ФИО_автора`, `Дата_рождения_автор`) VALUES
(1, 'Карл Павлович Брюллов', '1799-12-12 00:00:00'),
(2, 'Илья Ефимович Репин', '1817-07-29 00:00:00'),
(3, 'Архип Иванович Куинджи', '1842-01-27 00:00:00'),
(4, 'Исаак Ильич Левитан', '1860-08-30 00:00:00'),
(5, 'Клод Моне', '1840-11-14 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `Владелец`
--

CREATE TABLE `Владелец` (
  `id_владельца` int(7) NOT NULL,
  `ФИО_владельца` varchar(255) NOT NULL,
  `Дата_рождения_вл` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Владелец`
--

INSERT INTO `Владелец` (`id_владельца`, `ФИО_владельца`, `Дата_рождения_вл`) VALUES
(1, 'Лошак Марина Девовна', '1947-02-10 00:00:00'),
(2, 'Минц Борис Иосифович', '1958-07-24 00:00:00'),
(3, 'Харджиев Николай Иванович', '1936-06-26 00:00:00'),
(4, 'Григорьев Виктор Петрович', '2002-12-12 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `Выставка`
--

CREATE TABLE `Выставка` (
  `id_выставки` int(7) NOT NULL,
  `Название` varchar(255) NOT NULL,
  `Дата_начала` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Дата_окончания` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Адрес` varchar(255) NOT NULL,
  `id_организатора` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Выставка`
--

INSERT INTO `Выставка` (`id_выставки`, `Название`, `Дата_начала`, `Дата_окончания`, `Адрес`, `id_организатора`) VALUES
(1, 'Архип Куинджи', '2023-03-31 21:00:00', '2023-04-07 21:00:00', 'https://yandex.ru/maps/-/CCUBJIBSWB', 1),
(2, 'Морская история', '2023-01-20 21:00:00', '2023-02-19 21:00:00', 'https://yandex.ru/maps/-/CCUBJIbL0D', 1),
(3, 'Поэзия русского пейзажа', '2023-08-26 21:00:00', '2023-04-01 21:00:00', 'https://yandex.ru/profile/1265513625', 1),
(4, 'Многообразие / Единство', '2022-11-22 21:00:00', '2023-08-08 21:00:00', 'https://yandex.ru/profile/21117108341', 3),
(5, 'Родная речь', '2023-02-01 21:00:00', '2023-03-26 21:00:00', 'https://yandex.ru/profile/1022490077', 3),
(6, 'Под небом голубым', '2023-03-31 21:00:00', '2023-04-05 21:00:00', 'https://yandex.ru/maps/-/CCUBnYt-oD', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `Выставляется_на`
--

CREATE TABLE `Выставляется_на` (
  `id_выставки` int(7) NOT NULL,
  `id_живописи` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Выставляется_на`
--

INSERT INTO `Выставляется_на` (`id_выставки`, `id_живописи`) VALUES
(1, 3),
(1, 4),
(2, 1),
(3, 1),
(3, 3),
(3, 5),
(4, 2),
(4, 6),
(5, 1),
(5, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `Живопись`
--

CREATE TABLE `Живопись` (
  `id_живописи` int(7) NOT NULL,
  `Название_живописи` varchar(255) NOT NULL,
  `id_автора` int(7) DEFAULT NULL,
  `Год_создания` int(4) DEFAULT NULL,
  `id_стиля` int(7) DEFAULT NULL,
  `Стоимость` decimal(20,2) DEFAULT NULL,
  `id_владельца` int(7) DEFAULT NULL,
  `Картина` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Живопись`
--

INSERT INTO `Живопись` (`id_живописи`, `Название_живописи`, `id_автора`, `Год_создания`, `id_стиля`, `Стоимость`, `id_владельца`, `Картина`) VALUES
(1, 'Варяги на Днепре\r\nАйвазовский', 2, 1876, 1, '284110.00', 1, 'assets/img/pictures/1.jpeg'),
(2, 'Кувшинки', 5, 1926, 3, '2324538000.00', 4, 'assets/img/pictures/2.jpeg'),
(3, 'Ай-Петри. Крым', 3, 1890, 2, '10800000.00', 1, 'assets/img/pictures/3.jpeg'),
(4, 'Закат с деревьями', 3, 1876, 3, '33748848.00', 1, 'assets/img/pictures/4.jpeg'),
(5, 'Тихая обитель', 4, 1890, 2, '140738760.00', 1, 'assets/img/pictures/5.jpeg'),
(6, 'Вечер', 4, 1877, 2, '102149100.00', 3, 'assets/img/pictures/6.jpeg'),
(7, 'Всадница', 1, 1832, 3, '100230110.00', 2, 'assets/img/pictures/7.jpeg');

-- --------------------------------------------------------

--
-- Структура таблицы `Корзина`
--

CREATE TABLE `Корзина` (
  `id_заказа` int(7) NOT NULL,
  `id_услуги` int(7) NOT NULL,
  `id_посетителя` int(7) NOT NULL,
  `Дата_покупки` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Корзина`
--

INSERT INTO `Корзина` (`id_заказа`, `id_услуги`, `id_посетителя`, `Дата_покупки`) VALUES
(4, 6, 2, '2023-04-06 09:41:59');

-- --------------------------------------------------------

--
-- Структура таблицы `Организатор`
--

CREATE TABLE `Организатор` (
  `id_организатора` int(7) NOT NULL,
  `ФИО_Организатора` varchar(255) NOT NULL,
  `день_рождения_организатора` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Организатор`
--

INSERT INTO `Организатор` (`id_организатора`, `ФИО_Организатора`, `день_рождения_организатора`) VALUES
(1, 'Смузиков Александр Юрьевич', '1980-04-14 00:00:00'),
(2, 'Троценко Софья Сергеевна', '1912-12-05 00:00:00'),
(3, 'Лошак Марина Девовна', '1947-02-10 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `Посетитель`
--

CREATE TABLE `Посетитель` (
  `id_посетителя` int(7) NOT NULL,
  `ФИО_посетителя` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `Логин` varchar(255) NOT NULL,
  `Пароль` varchar(255) NOT NULL,
  `Телефон` varchar(20) NOT NULL,
  `Дата_регистрации` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Посетитель`
--

INSERT INTO `Посетитель` (`id_посетителя`, `ФИО_посетителя`, `email`, `Логин`, `Пароль`, `Телефон`, `Дата_регистрации`) VALUES
(2, 'Лопухова Виктория', 'lopuhova@gmail.com', 'lopuhova', '1234', '+79054450733', '2023-04-06 09:41:24');

-- --------------------------------------------------------

--
-- Структура таблицы `События`
--

CREATE TABLE `События` (
  `id_события` int(7) NOT NULL,
  `Название_события` varchar(255) NOT NULL,
  `Описание_события` varchar(1000) NOT NULL,
  `id_организатора` int(7) NOT NULL,
  `Дата_начала_выставки` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Дата_конца_выставки` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Изображение` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `События`
--

INSERT INTO `События` (`id_события`, `Название_события`, `Описание_события`, `id_организатора`, `Дата_начала_выставки`, `Дата_конца_выставки`, `Изображение`) VALUES
(1, 'Лошак Марина организует новую выставку, под названием -  \"Небесные покровители России. Иконы конца XVI – начала XX века 16 века\"', 'Состав выставки: свыше 40 икон и меднолитой пластики с образами Христа, Богоматери, почитаемых святых конца XVI – начала XX века из собрания Музея имени М. А. Врубеля.\r\nВыставка на примере церковного искусства конца XVI – начала XX века рассказывает об особо почитаемых иконах.', 3, '2023-05-01 09:30:31', '2023-08-31 09:30:31', 'assets/img/sobitia/1.jpeg'),
(2, 'Лошак Марина организует новую выставку, под названием -  \"Небесные покровители России. Иконы конца XVI – начала XX века 16 века\"', 'Состав выставки: свыше 40 икон и меднолитой пластики с образами Христа, Богоматери, почитаемых святых конца XVI – начала XX века из собрания Музея имени М. А. Врубеля.\r\nВыставка на примере церковного искусства конца XVI – начала XX века рассказывает об особо почитаемых иконах.', 3, '2023-05-01 09:30:31', '2023-08-31 09:30:31', 'assets/img/sobitia/1.jpeg'),
(3, 'Лошак Марина организует новую выставку, под названием -  \"Небесные покровители России. Иконы конца XVI – начала XX века 16 века\"', 'Состав выставки: свыше 40 икон и меднолитой пластики с образами Христа, Богоматери, почитаемых святых конца XVI – начала XX века из собрания Музея имени М. А. Врубеля.\r\nВыставка на примере церковного искусства конца XVI – начала XX века рассказывает об особо почитаемых иконах.', 3, '2023-05-01 09:30:31', '2023-08-31 09:30:31', 'assets/img/sobitia/1.jpeg');

-- --------------------------------------------------------

--
-- Структура таблицы `Стиль`
--

CREATE TABLE `Стиль` (
  `id_стиля` int(7) NOT NULL,
  `Название_стиля` varchar(255) NOT NULL,
  `Век` int(2) NOT NULL,
  `Описание` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Стиль`
--

INSERT INTO `Стиль` (`id_стиля`, `Название_стиля`, `Век`, `Описание`) VALUES
(1, 'Марина', 17, 'Морской пейзаж, или марина — это особый жанр изобразительного искусства, где основным элементом картины выступает море. Термин произошел от слова marinus (лат. «морской») и введен в употребление итальянцами. Морской пейзаж как самостоятельный вид живописи сформировался в Нидерландах в семнадцатом веке с появлением картин, где все внимание художника уделялось стихии, а корабли и люди выступали второстепенными персонажами. Слово «марина» (итал. marina) произошло от латинского marinus — морской.'),
(2, 'Пейзаж', 19, 'Пейзаж — это живописный жанр, предметом которого являются природные, сельские и городские ландшафты, а также атмосферные явления. Люди и животные тоже могут появляться в пейзажах, но их роль второстепенна: они «захвачены» кистью творца, поскольку оказались частью изображаемой реальности. Иногда это вообще не более чем стаффаж — фигуры, которые оживляют местность.'),
(3, 'импрессионизм', 20, 'Импрессионизм — это влиятельное, масштабное, переломное течение в искусстве заключительной трети XIX и начала XX столетия. Нередко историю живописи делят на периоды до и после импрессионизма. Это течение заложило основы изобразительного искусства XX века со всеми его многочисленными авангардными стилями. И хотя сейчас импрессионистское творчество кажется более близким к классической традиции, чем к современному искусству, для современников идеи импрессионистов были подобны свежему ветру, ворвавшемуся в мир увядающего академизма и салонной живописи.'),
(4, 'портрет', 18, 'Портрет — это самый антропоцентричный живописный жанр. Внимание художника полностью сосредотачивается на человеке. Смыслом работы живописца становится как\r\nминимум отображение на холсте внешности модели, а как максимум — раскрытие души, характера. Следует заметить, что в современном искусстве на первый план выходит не портретное сходство, а погружение во внутренний мир человека. А вот классический портрет подразумевает ещё и высокую точность в изображении человека.');

-- --------------------------------------------------------

--
-- Структура таблицы `Услуга`
--

CREATE TABLE `Услуга` (
  `id_услуги` int(7) NOT NULL,
  `Название_услуги` varchar(255) NOT NULL,
  `Стоимость_услуги` decimal(10,2) NOT NULL,
  `Тип_услуги` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Услуга`
--

INSERT INTO `Услуга` (`id_услуги`, `Название_услуги`, `Стоимость_услуги`, `Тип_услуги`) VALUES
(1, 'Выставить картину на выставку', '50000.00', 'Индивидуальный'),
(2, 'Помощь в покупке картины', '100000.00', 'Индивидуальный'),
(3, 'Организовать выставку', '1000000.00', 'Индивидуальный'),
(4, 'Экскурсия для группы', '8000.00', 'Групповая'),
(5, 'Индивидуальная экскурсия', '3500.00', 'Индивидуальный'),
(6, 'Аренда Гида', '25000.00', 'Индивидуальный');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Автор`
--
ALTER TABLE `Автор`
  ADD PRIMARY KEY (`id_автора`);

--
-- Индексы таблицы `Владелец`
--
ALTER TABLE `Владелец`
  ADD PRIMARY KEY (`id_владельца`);

--
-- Индексы таблицы `Выставка`
--
ALTER TABLE `Выставка`
  ADD PRIMARY KEY (`id_выставки`),
  ADD KEY `id_организатора` (`id_организатора`);

--
-- Индексы таблицы `Выставляется_на`
--
ALTER TABLE `Выставляется_на`
  ADD KEY `id_выставки` (`id_выставки`),
  ADD KEY `выставляется на_ibfk_2` (`id_живописи`);

--
-- Индексы таблицы `Живопись`
--
ALTER TABLE `Живопись`
  ADD PRIMARY KEY (`id_живописи`),
  ADD KEY `id_автора` (`id_автора`),
  ADD KEY `живопись_ibfk_2` (`id_владельца`),
  ADD KEY `живопись_ibfk_3` (`id_стиля`);

--
-- Индексы таблицы `Корзина`
--
ALTER TABLE `Корзина`
  ADD PRIMARY KEY (`id_заказа`),
  ADD KEY `корзина_ibfk_2` (`id_посетителя`),
  ADD KEY `корзина_ibfk_1` (`id_услуги`);

--
-- Индексы таблицы `Организатор`
--
ALTER TABLE `Организатор`
  ADD PRIMARY KEY (`id_организатора`);

--
-- Индексы таблицы `Посетитель`
--
ALTER TABLE `Посетитель`
  ADD PRIMARY KEY (`id_посетителя`);

--
-- Индексы таблицы `События`
--
ALTER TABLE `События`
  ADD PRIMARY KEY (`id_события`),
  ADD KEY `id_организатора` (`id_организатора`);

--
-- Индексы таблицы `Стиль`
--
ALTER TABLE `Стиль`
  ADD PRIMARY KEY (`id_стиля`);

--
-- Индексы таблицы `Услуга`
--
ALTER TABLE `Услуга`
  ADD PRIMARY KEY (`id_услуги`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Автор`
--
ALTER TABLE `Автор`
  MODIFY `id_автора` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Владелец`
--
ALTER TABLE `Владелец`
  MODIFY `id_владельца` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Выставка`
--
ALTER TABLE `Выставка`
  MODIFY `id_выставки` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `Живопись`
--
ALTER TABLE `Живопись`
  MODIFY `id_живописи` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `Корзина`
--
ALTER TABLE `Корзина`
  MODIFY `id_заказа` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Организатор`
--
ALTER TABLE `Организатор`
  MODIFY `id_организатора` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `Посетитель`
--
ALTER TABLE `Посетитель`
  MODIFY `id_посетителя` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `События`
--
ALTER TABLE `События`
  MODIFY `id_события` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `Стиль`
--
ALTER TABLE `Стиль`
  MODIFY `id_стиля` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Услуга`
--
ALTER TABLE `Услуга`
  MODIFY `id_услуги` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Выставка`
--
ALTER TABLE `Выставка`
  ADD CONSTRAINT `выставка_ibfk_1` FOREIGN KEY (`id_организатора`) REFERENCES `Организатор` (`id_организатора`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Выставляется_на`
--
ALTER TABLE `Выставляется_на`
  ADD CONSTRAINT `выставляется_на_ibfk_1` FOREIGN KEY (`id_выставки`) REFERENCES `Выставка` (`id_выставки`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `выставляется_на_ibfk_2` FOREIGN KEY (`id_живописи`) REFERENCES `Живопись` (`id_живописи`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Живопись`
--
ALTER TABLE `Живопись`
  ADD CONSTRAINT `живопись_ibfk_1` FOREIGN KEY (`id_автора`) REFERENCES `Автор` (`id_автора`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `живопись_ibfk_2` FOREIGN KEY (`id_владельца`) REFERENCES `Владелец` (`id_владельца`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `живопись_ibfk_3` FOREIGN KEY (`id_стиля`) REFERENCES `Стиль` (`id_стиля`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Корзина`
--
ALTER TABLE `Корзина`
  ADD CONSTRAINT `корзина_ibfk_1` FOREIGN KEY (`id_услуги`) REFERENCES `Услуга` (`id_услуги`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `корзина_ibfk_2` FOREIGN KEY (`id_посетителя`) REFERENCES `Посетитель` (`id_посетителя`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `События`
--
ALTER TABLE `События`
  ADD CONSTRAINT `события_ibfk_1` FOREIGN KEY (`id_организатора`) REFERENCES `Организатор` (`id_организатора`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

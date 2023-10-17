-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Апр 04 2023 г., 16:00
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
-- База данных: `autoproizvodstvo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Класс`
--

CREATE TABLE `Класс` (
  `id_класса` int(7) NOT NULL,
  `Навзание_класса` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Класс`
--

INSERT INTO `Класс` (`id_класса`, `Навзание_класса`) VALUES
(1, 'Эконом'),
(2, 'Комфорт'),
(3, 'Бизнес'),
(4, 'Премиум');

-- --------------------------------------------------------

--
-- Структура таблицы `Клиент`
--

CREATE TABLE `Клиент` (
  `id_клиента` int(7) NOT NULL,
  `ФИО` varchar(100) NOT NULL,
  `Логин` varchar(50) NOT NULL,
  `Пароль` varchar(50) NOT NULL,
  `Телефон` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `дата_регистрации` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Клиент`
--

INSERT INTO `Клиент` (`id_клиента`, `ФИО`, `Логин`, `Пароль`, `Телефон`, `email`, `дата_регистрации`) VALUES
(3, 'Корниенко Андрей', 'kornienko', '1234', '33232', 'korni@gmail.com', '2023-04-04 15:57:59');

-- --------------------------------------------------------

--
-- Структура таблицы `Корзина`
--

CREATE TABLE `Корзина` (
  `id_заказа` int(7) NOT NULL,
  `id_клиента` int(7) NOT NULL,
  `id_услуги` int(7) NOT NULL,
  `дата_услуги` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Корзина`
--

INSERT INTO `Корзина` (`id_заказа`, `id_клиента`, `id_услуги`, `дата_услуги`) VALUES
(4, 3, 2, '2023-04-04 17:55:57'),
(5, 3, 3, '2023-04-04 18:44:27');

-- --------------------------------------------------------

--
-- Структура таблицы `Новости`
--

CREATE TABLE `Новости` (
  `id_новости` int(7) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Текст_новости` varchar(1000) NOT NULL,
  `id_производства` int(7) NOT NULL,
  `Дата_новости` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Картинка` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Новости`
--

INSERT INTO `Новости` (`id_новости`, `Title`, `Текст_новости`, `id_производства`, `Дата_новости`, `Картинка`) VALUES
(1, 'BMW представила новый автомобиль', 'Текст Новости автатыьыва ывьа выьавыавыь авыта выьа выьа ь выавьы Текст Новости автатыьыва ывьа выьавыавыь авыта выьа выьа ь выавьы Текст Новости автатыьыва ывьа выьавыавыь авыта выьа выьа ь выавьы Текст Новости автатыьыва ывьа выьавыавыь авыта выьа выьа ь выавьы Текст Новости автатыьыва ывьа выьавыавыь авыта выьа выьа ь выавьы Текст Новости автатыьыва ывьа выьавыавыь авыта выьа выьа ь выавьы Текст Новости автатыьыва ывьа выьавыавыь авыта выьа выьа ь выавьы ', 2, '2023-04-04 16:35:46', 'assets/img/cars/m4.png'),
(2, 'BMW представила новый автомобиль', 'Текст Новости автатыьыва ывьа выьавыавыь авыта выьа выьа ь выавьы Текст Новости автатыьыва ывьа выьавыавыь авыта выьа выьа ь выавьы Текст Новости автатыьыва ывьа выьавыавыь авыта выьа выьа ь выавьы Текст Новости автатыьыва ывьа выьавыавыь авыта выьа выьа ь выавьы Текст Новости автатыьыва ывьа выьавыавыь авыта выьа выьа ь выавьы Текст Новости автатыьыва ывьа выьавыавыь авыта выьа выьа ь выавьы Текст Новости автатыьыва ывьа выьавыавыь авыта выьа выьа ь выавьы Текст Новости автатыьыва ывьа выьавыавыь авыта выьа выьа ь выавьы Текст Новости автатыьыва ывьа выьавыавыь авыта выьа выьа ь выавьы Текст Новости автатыьыва ывьа выьавыавыь авыта выьа выьа ь выавьы Текст Новости автатыьыва ывьа выьавыавыь авыта выьа выьа ь выавьы ', 2, '2023-04-04 16:35:46', 'assets/img/cars/m4.png'),
(3, 'BMW представила новый автомобиль', 'Текст Новости автатыьыва ывьа выьавыавыь авыта выьа выьа ь выавьы Текст Новости автатыьыва ывьа выьавыавыь авыта выьа выьа ь выавьы Текст Новости автатыьыва ывьа выьавыавыь авыта выьа выьа ь выавьы Текст Новости автатыьыва ывьа выьавыавыь авыта выьа выьа ь выавьы Текст Новости автатыьыва ывьа выьавыавыь авыта выьа выьа ь выавьы Текст Новости автатыьыва ывьа выьавыавыь авыта выьа выьа ь выавьы Текст Новости автатыьыва ывьа выьавыавыь авыта выьа выьа ь выавьы ', 2, '2023-04-04 16:35:46', 'assets/img/cars/m4.png');

-- --------------------------------------------------------

--
-- Структура таблицы `Производство`
--

CREATE TABLE `Производство` (
  `id_производства` int(7) NOT NULL,
  `Название_производства` varchar(100) NOT NULL,
  `Страна_производства` varchar(50) NOT NULL,
  `id_класса` int(7) NOT NULL,
  `Логотип` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Производство`
--

INSERT INTO `Производство` (`id_производства`, `Название_производства`, `Страна_производства`, `id_класса`, `Логотип`) VALUES
(1, 'Audi', 'Германия', 4, 'assets/img/car_logo/audi.jpg'),
(2, 'BMW', 'Германия', 4, 'assets/img/car_logo/bmw.png'),
(3, 'Hyundai', 'Южная Корея', 1, 'assets/img/car_logo/hundai.png'),
(4, 'GMC', 'США', 3, 'assets/img/car_logo/gmc.jpeg'),
(5, 'Mercedes-Benz', 'Германия', 4, 'assets/img/car_logo/benz.png'),
(6, 'Toyota', 'Япония', 2, 'assets/img/car_logo/toyota.png'),
(7, 'Ford', 'США', 1, 'assets/img/car_logo/ford.png');

-- --------------------------------------------------------

--
-- Структура таблицы `Услуга`
--

CREATE TABLE `Услуга` (
  `id_услуги` int(7) NOT NULL,
  `Наименование_услуги` varchar(100) NOT NULL,
  `Стоимость_услуги` int(10) NOT NULL,
  `Тип_услуги` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Услуга`
--

INSERT INTO `Услуга` (`id_услуги`, `Наименование_услуги`, `Стоимость_услуги`, `Тип_услуги`) VALUES
(1, 'Покраска автомобиля', 50000, 'Внешние услуги'),
(2, 'ТО', 7800, 'Технические услуги'),
(3, 'Замена двигателя', 500000, 'Технические услуги'),
(4, 'Замена коробки передач', 250000, 'Технические услуги'),
(5, 'Химчистка салона', 25000, 'Услуги в салоне'),
(6, 'Замена подушек безопасности', 20000, 'Технические услуги');

-- --------------------------------------------------------

--
-- Структура таблицы `автомобиль`
--

CREATE TABLE `автомобиль` (
  `id_автомобиля` int(7) NOT NULL,
  `id_производства` int(7) NOT NULL,
  `Название_модели` varchar(100) NOT NULL,
  `Мощность` int(10) NOT NULL,
  `Изображение` varchar(100) NOT NULL,
  `Описание` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `автомобиль`
--

INSERT INTO `автомобиль` (`id_автомобиля`, `id_производства`, `Название_модели`, `Мощность`, `Изображение`, `Описание`) VALUES
(1, 1, 'RS5', 420, 'assets/img/cars/rs5.png', 'Audi RS5 - спортивный автомобиль класса гран туризмо, выпускаемый подразделением Audi Sport GmbH (ранее quattro GmbH) на платформе Audi A5. Существует менее мощная спортивная версия Audi S5. 2‑дв. купе (4‑мест.)'),
(2, 2, 'M4', 450, 'assets/img/cars/m4.png', 'BMW M4 — спорткар немецкой компании BMW, замена купе M3 E92. Спортивная версия 4-й серии купе. Концепт был представлен 16 августа 2013 года. Впервые, для 3/4 M серии, был установлен турбокомпрессор и для M серии электрический усилитель руля.'),
(3, 3, 'Sonata', 195, 'assets/img/cars/sonata.jpeg', ''),
(4, 4, 'Lincoln', 400, 'assets/img/cars/linkoln.jpeg', ''),
(5, 5, 'AMG-GT 4-door', 639, 'assets/img/cars/gt-4.jpeg', 'Больше, чем восхитительный Gran Turismo\r\nС 4-дверным купе Mercedes-AMG GT у вас на выбор имеется не только два варианта моделей – AMG GT 43MATIC+ и AMG GT 53 4MATIC+, но и многочисленные возможности индивидуализации: три варианта исполнения задней части салона, эксклюзивные пакеты для экстерьера и интерьера, а также широкий выбор лакокрасочных покрытий, колесных дисков и тормозов.'),
(6, 6, 'Camry', 249, 'assets/img/cars/camry.jpeg', ''),
(7, 7, 'Focus', 125, 'assets/img/cars/focus.jpeg', ''),
(8, 1, 'RS 4', 450, 'assets/img/cars/rs4.jpeg', 'Audi RS4 — спортивно-ориентированный компактный престижный автомобиль от Audi Sport GmbH, произведённый в ограниченном количестве для немецкого автопроизводителя Audi AG (дочернее предприятие Volkswagen Group).'),
(9, 2, 'X5', 249, 'assets/img/cars/x5.jpeg', 'BMW G05/G18 — четвёртое поколение знаменитого среднеразмерного кроссовера BMW X5 немецкой компании BMW. Выпуск модели был начат в ноябре 2018 года в Европе. Одновременно с запуском новой модели с производства была снята предыдущая — F15.');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Класс`
--
ALTER TABLE `Класс`
  ADD PRIMARY KEY (`id_класса`);

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
-- Индексы таблицы `Новости`
--
ALTER TABLE `Новости`
  ADD PRIMARY KEY (`id_новости`),
  ADD KEY `id_производства` (`id_производства`);

--
-- Индексы таблицы `Производство`
--
ALTER TABLE `Производство`
  ADD PRIMARY KEY (`id_производства`),
  ADD KEY `id_класса` (`id_класса`);

--
-- Индексы таблицы `Услуга`
--
ALTER TABLE `Услуга`
  ADD PRIMARY KEY (`id_услуги`),
  ADD KEY `id_типа` (`Тип_услуги`);

--
-- Индексы таблицы `автомобиль`
--
ALTER TABLE `автомобиль`
  ADD PRIMARY KEY (`id_автомобиля`),
  ADD KEY `id_производства` (`id_производства`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Класс`
--
ALTER TABLE `Класс`
  MODIFY `id_класса` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Клиент`
--
ALTER TABLE `Клиент`
  MODIFY `id_клиента` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `Корзина`
--
ALTER TABLE `Корзина`
  MODIFY `id_заказа` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Новости`
--
ALTER TABLE `Новости`
  MODIFY `id_новости` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `Производство`
--
ALTER TABLE `Производство`
  MODIFY `id_производства` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `Услуга`
--
ALTER TABLE `Услуга`
  MODIFY `id_услуги` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `автомобиль`
--
ALTER TABLE `автомобиль`
  MODIFY `id_автомобиля` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Корзина`
--
ALTER TABLE `Корзина`
  ADD CONSTRAINT `корзина_ibfk_1` FOREIGN KEY (`id_клиента`) REFERENCES `Клиент` (`id_клиента`),
  ADD CONSTRAINT `корзина_ibfk_2` FOREIGN KEY (`id_услуги`) REFERENCES `Услуга` (`id_услуги`);

--
-- Ограничения внешнего ключа таблицы `Новости`
--
ALTER TABLE `Новости`
  ADD CONSTRAINT `новости_ibfk_1` FOREIGN KEY (`id_производства`) REFERENCES `Производство` (`id_производства`);

--
-- Ограничения внешнего ключа таблицы `Производство`
--
ALTER TABLE `Производство`
  ADD CONSTRAINT `производство_ibfk_1` FOREIGN KEY (`id_класса`) REFERENCES `Класс` (`id_класса`);

--
-- Ограничения внешнего ключа таблицы `автомобиль`
--
ALTER TABLE `автомобиль`
  ADD CONSTRAINT `автомобиль_ibfk_1` FOREIGN KEY (`id_производства`) REFERENCES `Производство` (`id_производства`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

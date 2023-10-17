-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Мар 26 2023 г., 12:44
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
-- База данных: `datacomp`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Видеокарты`
--

CREATE TABLE `Видеокарты` (
  `ID_видеокарты` int(7) NOT NULL,
  `Фирма_видеокарты` varchar(50) DEFAULT NULL,
  `Серия_видеокарты` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Видеокарты`
--

INSERT INTO `Видеокарты` (`ID_видеокарты`, `Фирма_видеокарты`, `Серия_видеокарты`) VALUES
(1, 'AMD', 'RX580'),
(2, 'AMD', 'R6600XT'),
(3, 'NVIDIA', 'RTX1660'),
(4, 'NVIDIA', 'RTX3060'),
(5, 'NVIDIA', 'RTX4080'),
(6, 'AMD', 'R7700XT');

-- --------------------------------------------------------

--
-- Структура таблицы `Клиент`
--

CREATE TABLE `Клиент` (
  `ID_клиента` int(7) NOT NULL,
  `ФИО` varchar(100) DEFAULT NULL,
  `Дата_рождения` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Клиент`
--

INSERT INTO `Клиент` (`ID_клиента`, `ФИО`, `Дата_рождения`) VALUES
(1, 'Калинин Артем Андреевич', '2004-09-02'),
(2, 'Гузман Сергей Петрович', '2002-07-23'),
(3, 'Петров Иван Иванович', '2000-04-13'),
(4, 'Геров Гер Герович', '1952-02-13');

-- --------------------------------------------------------

--
-- Структура таблицы `Материнская_плата`
--

CREATE TABLE `Материнская_плата` (
  `ID_матплаты` int(7) NOT NULL,
  `Тип_матплаты` varchar(50) DEFAULT NULL,
  `Фирма_матплаты` varchar(50) DEFAULT NULL,
  `Сокет_матплаты` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Материнская_плата`
--

INSERT INTO `Материнская_плата` (`ID_матплаты`, `Тип_матплаты`, `Фирма_матплаты`, `Сокет_матплаты`) VALUES
(1, 'ATX', 'Gigabyte', 'AM4'),
(2, 'ATX', 'MSI', 'AM4'),
(3, 'MiniATX', 'MSI', 'Intel'),
(4, 'MiniATX', 'Asus', 'Intel');

-- --------------------------------------------------------

--
-- Структура таблицы `Память_ОЗУ`
--

CREATE TABLE `Память_ОЗУ` (
  `ID_ОЗУ` int(7) NOT NULL,
  `Тип_ОЗУ` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Память_ОЗУ`
--

INSERT INTO `Память_ОЗУ` (`ID_ОЗУ`, `Тип_ОЗУ`) VALUES
(1, 'DDR3'),
(2, 'DDR4'),
(3, 'DDR5'),
(4, 'DDR5X');

-- --------------------------------------------------------

--
-- Структура таблицы `Память_ПЗУ`
--

CREATE TABLE `Память_ПЗУ` (
  `ID_ПЗУ` int(7) NOT NULL,
  `Тип_ПЗУ` varchar(50) DEFAULT NULL,
  `Фирма_ПЗУ` varchar(50) DEFAULT NULL,
  `Размер_ПЗУ` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Память_ПЗУ`
--

INSERT INTO `Память_ПЗУ` (`ID_ПЗУ`, `Тип_ПЗУ`, `Фирма_ПЗУ`, `Размер_ПЗУ`) VALUES
(1, 'Hard', 'Intel', '256Gb'),
(2, 'Hard', 'AMD', '512Gb'),
(3, 'SSD', 'GIGABYTE', '512Gb'),
(4, 'SSD', 'Kingston', '1TB'),
(5, 'Hard', 'WD', '3TB');

-- --------------------------------------------------------

--
-- Структура таблицы `Покупатель`
--

CREATE TABLE `Покупатель` (
  `ID_покупателя` int(7) NOT NULL,
  `ID_по` int(7) DEFAULT NULL,
  `ID_клиента` int(7) DEFAULT NULL,
  `Дата` datetime DEFAULT NULL,
  `Количество` int(7) DEFAULT NULL,
  `Цена` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Покупатель`
--

INSERT INTO `Покупатель` (`ID_покупателя`, `ID_по`, `ID_клиента`, `Дата`, `Количество`, `Цена`) VALUES
(1, 1, 1, '2023-03-01 13:35:07', 1, 60000),
(2, 2, 1, '2023-03-03 13:35:07', 1, 120000),
(3, 4, 3, '2023-03-06 13:36:21', 2, 100000),
(4, 3, 4, '2020-03-05 13:36:21', 1, 45000);

-- --------------------------------------------------------

--
-- Структура таблицы `Программное_обеспечение`
--

CREATE TABLE `Программное_обеспечение` (
  `ID_ПО` int(7) NOT NULL,
  `Тип_ПО` varchar(50) DEFAULT NULL,
  `ПО` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Программное_обеспечение`
--

INSERT INTO `Программное_обеспечение` (`ID_ПО`, `Тип_ПО`, `ПО`) VALUES
(1, 'Офисное', 'MS_Office'),
(2, 'Игровое', 'Игра'),
(3, 'Игровое', 'Ускорение игр'),
(4, 'Офисное', 'AnyDesk');

-- --------------------------------------------------------

--
-- Структура таблицы `Процессоры`
--

CREATE TABLE `Процессоры` (
  `ID_процессора` int(7) NOT NULL,
  `Фирма_процессора` varchar(50) DEFAULT NULL,
  `Серия_процессора` varchar(50) DEFAULT NULL,
  `Процессор` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Процессоры`
--

INSERT INTO `Процессоры` (`ID_процессора`, `Фирма_процессора`, `Серия_процессора`, `Процессор`) VALUES
(1, 'AMD', 'AM4', 'R5-5600'),
(2, 'AMD', 'AM4', 'R7-5600'),
(3, 'Intel', 'CoffeLake', 'i7-7800'),
(4, 'Intel', 'IBMLake', 'i7-12000'),
(7, 'Intel', 'AM4', 'I9');

-- --------------------------------------------------------

--
-- Структура таблицы `системный_блок`
--

CREATE TABLE `системный_блок` (
  `ID_сис_блока` int(7) NOT NULL,
  `ID_видеокарты` int(7) DEFAULT NULL,
  `ID_матплаты` int(7) DEFAULT NULL,
  `ID_пам_ОЗУ` int(7) DEFAULT NULL,
  `ID_пам_ПЗУ` int(7) DEFAULT NULL,
  `ID_процессора` int(7) DEFAULT NULL,
  `ID_покупателя` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `системный_блок`
--

INSERT INTO `системный_блок` (`ID_сис_блока`, `ID_видеокарты`, `ID_матплаты`, `ID_пам_ОЗУ`, `ID_пам_ПЗУ`, `ID_процессора`, `ID_покупателя`) VALUES
(1, 1, 1, 1, 2, 1, 1),
(2, 5, 2, 4, 4, 2, 1),
(3, 2, 3, 2, 2, 1, 3),
(4, 1, 2, 3, 4, 3, 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Видеокарты`
--
ALTER TABLE `Видеокарты`
  ADD PRIMARY KEY (`ID_видеокарты`);

--
-- Индексы таблицы `Клиент`
--
ALTER TABLE `Клиент`
  ADD PRIMARY KEY (`ID_клиента`);

--
-- Индексы таблицы `Материнская_плата`
--
ALTER TABLE `Материнская_плата`
  ADD PRIMARY KEY (`ID_матплаты`);

--
-- Индексы таблицы `Память_ОЗУ`
--
ALTER TABLE `Память_ОЗУ`
  ADD PRIMARY KEY (`ID_ОЗУ`);

--
-- Индексы таблицы `Память_ПЗУ`
--
ALTER TABLE `Память_ПЗУ`
  ADD PRIMARY KEY (`ID_ПЗУ`);

--
-- Индексы таблицы `Покупатель`
--
ALTER TABLE `Покупатель`
  ADD PRIMARY KEY (`ID_покупателя`),
  ADD KEY `ID_по` (`ID_по`),
  ADD KEY `покупатель_ibfk_2` (`ID_клиента`);

--
-- Индексы таблицы `Программное_обеспечение`
--
ALTER TABLE `Программное_обеспечение`
  ADD PRIMARY KEY (`ID_ПО`);

--
-- Индексы таблицы `Процессоры`
--
ALTER TABLE `Процессоры`
  ADD PRIMARY KEY (`ID_процессора`);

--
-- Индексы таблицы `системный_блок`
--
ALTER TABLE `системный_блок`
  ADD PRIMARY KEY (`ID_сис_блока`),
  ADD KEY `ID_видеокарты` (`ID_видеокарты`),
  ADD KEY `системный_блок_ibfk_2` (`ID_матплаты`),
  ADD KEY `системный_блок_ibfk_3` (`ID_пам_ОЗУ`),
  ADD KEY `системный_блок_ibfk_4` (`ID_пам_ПЗУ`),
  ADD KEY `системный_блок_ibfk_5` (`ID_процессора`),
  ADD KEY `системный_блок_ibfk_6` (`ID_покупателя`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Видеокарты`
--
ALTER TABLE `Видеокарты`
  MODIFY `ID_видеокарты` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `Клиент`
--
ALTER TABLE `Клиент`
  MODIFY `ID_клиента` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Материнская_плата`
--
ALTER TABLE `Материнская_плата`
  MODIFY `ID_матплаты` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Память_ОЗУ`
--
ALTER TABLE `Память_ОЗУ`
  MODIFY `ID_ОЗУ` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Память_ПЗУ`
--
ALTER TABLE `Память_ПЗУ`
  MODIFY `ID_ПЗУ` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Покупатель`
--
ALTER TABLE `Покупатель`
  MODIFY `ID_покупателя` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Программное_обеспечение`
--
ALTER TABLE `Программное_обеспечение`
  MODIFY `ID_ПО` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Процессоры`
--
ALTER TABLE `Процессоры`
  MODIFY `ID_процессора` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `системный_блок`
--
ALTER TABLE `системный_блок`
  MODIFY `ID_сис_блока` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Покупатель`
--
ALTER TABLE `Покупатель`
  ADD CONSTRAINT `покупатель_ibfk_1` FOREIGN KEY (`ID_по`) REFERENCES `Программное_обеспечение` (`ID_ПО`),
  ADD CONSTRAINT `покупатель_ibfk_2` FOREIGN KEY (`ID_клиента`) REFERENCES `Клиент` (`ID_клиента`);

--
-- Ограничения внешнего ключа таблицы `системный_блок`
--
ALTER TABLE `системный_блок`
  ADD CONSTRAINT `системный_блок_ibfk_1` FOREIGN KEY (`ID_видеокарты`) REFERENCES `Видеокарты` (`ID_видеокарты`),
  ADD CONSTRAINT `системный_блок_ibfk_2` FOREIGN KEY (`ID_матплаты`) REFERENCES `Материнская_плата` (`ID_матплаты`),
  ADD CONSTRAINT `системный_блок_ibfk_3` FOREIGN KEY (`ID_пам_ОЗУ`) REFERENCES `Память_ОЗУ` (`ID_ОЗУ`),
  ADD CONSTRAINT `системный_блок_ibfk_4` FOREIGN KEY (`ID_пам_ПЗУ`) REFERENCES `Память_ПЗУ` (`ID_ПЗУ`),
  ADD CONSTRAINT `системный_блок_ibfk_5` FOREIGN KEY (`ID_процессора`) REFERENCES `Процессоры` (`ID_процессора`),
  ADD CONSTRAINT `системный_блок_ibfk_6` FOREIGN KEY (`ID_покупателя`) REFERENCES `Покупатель` (`ID_покупателя`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

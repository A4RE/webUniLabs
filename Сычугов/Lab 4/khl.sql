-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Апр 06 2023 г., 17:40
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
-- База данных: `khl`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Арена`
--

CREATE TABLE `Арена` (
  `ID_Арены` int(7) NOT NULL,
  `Название` varchar(50) NOT NULL,
  `Вместимость` int(5) NOT NULL,
  `Город` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Арена`
--

INSERT INTO `Арена` (`ID_Арены`, `Название`, `Вместимость`, `Город`) VALUES
(1, 'Арена 1', 600, 'Санкт-Петербург'),
(2, 'Арена 2', 500, 'Москва'),
(3, 'Арена 3', 700, 'Москва'),
(4, 'Арена 4', 1000, 'Волгоград'),
(5, 'Арена 5', 300, 'Якутск'),
(6, 'Арена 6', 750, 'Магнитогорск');

-- --------------------------------------------------------

--
-- Структура таблицы `Игра`
--

CREATE TABLE `Игра` (
  `ID_Игры` int(7) NOT NULL,
  `ID_Команды` int(7) NOT NULL,
  `ID_Арены` int(7) NOT NULL,
  `ID_Судьи` int(7) NOT NULL,
  `Броски_по_Воротам` int(4) NOT NULL,
  `Кол_Голов` int(4) NOT NULL,
  `Дата_Игры` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Игра`
--

INSERT INTO `Игра` (`ID_Игры`, `ID_Команды`, `ID_Арены`, `ID_Судьи`, `Броски_по_Воротам`, `Кол_Голов`, `Дата_Игры`) VALUES
(1, 2, 1, 1, 40, 6, '2023-03-01 14:33:15'),
(2, 3, 2, 2, 10, 2, '2023-03-02 14:33:15'),
(3, 4, 2, 2, 15, 6, '2023-03-03 14:34:06'),
(4, 3, 5, 3, 30, 3, '2023-03-04 14:34:06'),
(5, 3, 4, 4, 35, 5, '2023-03-05 14:34:06'),
(6, 5, 1, 1, 23, 8, '2023-03-09 14:34:06'),
(7, 4, 4, 4, 18, 7, '2023-03-09 14:34:06');

-- --------------------------------------------------------

--
-- Структура таблицы `Игрок`
--

CREATE TABLE `Игрок` (
  `ID_Игрока` int(7) NOT NULL,
  `ID_Команды` int(7) NOT NULL,
  `Фамилия` varchar(20) NOT NULL,
  `Имя` varchar(20) NOT NULL,
  `Кол_Голов` int(3) NOT NULL,
  `Пол` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Игрок`
--

INSERT INTO `Игрок` (`ID_Игрока`, `ID_Команды`, `Фамилия`, `Имя`, `Кол_Голов`, `Пол`) VALUES
(1, 1, 'Федоров', 'Сергей', 25, 'муж'),
(2, 3, 'Малкин', 'Евгений', 14, 'муж'),
(3, 3, 'Дацюк', 'Павел', 23, 'муж'),
(4, 4, 'Овечкин', 'Александр', 24, 'муж'),
(5, 5, 'Ковалев', 'Алексей', 34, 'муж'),
(6, 1, 'Могильный', 'Александр', 51, 'муж'),
(7, 5, 'Буре', 'Павел', 25, 'муж');

-- --------------------------------------------------------

--
-- Структура таблицы `Игры_с_суммой`
--

CREATE TABLE `Игры_с_суммой` (
  `ID_Игры` int(7) NOT NULL,
  `ID_Команды_1` int(7) NOT NULL,
  `ID_Команды_2` int(7) NOT NULL,
  `ID_Арены` int(7) NOT NULL,
  `ID_Судьи` int(7) NOT NULL,
  `Броски_по_Воротам` int(4) NOT NULL,
  `Кол_Голов` int(4) NOT NULL,
  `Дата_игры` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Игры_с_суммой`
--

INSERT INTO `Игры_с_суммой` (`ID_Игры`, `ID_Команды_1`, `ID_Команды_2`, `ID_Арены`, `ID_Судьи`, `Броски_по_Воротам`, `Кол_Голов`, `Дата_игры`) VALUES
(1, 2, 1, 1, 1, 40, 6, '2023-03-12 14:45:51'),
(4, 3, 5, 5, 2, 30, 3, '2023-03-02 14:46:53'),
(5, 3, 4, 4, 4, 35, 5, '2023-03-09 14:45:51');

-- --------------------------------------------------------

--
-- Структура таблицы `Команда`
--

CREATE TABLE `Команда` (
  `ID_Команды` int(7) NOT NULL,
  `Название_команды` varchar(50) NOT NULL,
  `Кол_побед` int(4) NOT NULL,
  `Кол_поражений` int(4) NOT NULL,
  `Город` varchar(50) NOT NULL,
  `Логотип_команды` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Команда`
--

INSERT INTO `Команда` (`ID_Команды`, `Название_команды`, `Кол_побед`, `Кол_поражений`, `Город`, `Логотип_команды`) VALUES
(1, 'Команда 1', 4, 23, 'Санкт-Петербург', 'assets/images/team/1.jpeg'),
(2, 'Команда 2', 30, 21, 'Москва', 'assets/images/team/2.jpeg'),
(3, 'Команда 3', 10, 12, 'Екатеренбург', 'assets/images/team/3.jpeg'),
(4, 'Команда 4', 4, 32, 'Сочи', 'assets/images/team/4.jpeg'),
(5, 'Команда 5', 13, 42, 'Владивосток', 'assets/images/team/5.jpeg'),
(6, 'Команда 6', 102, 21, 'Магнитогорск', 'assets/images/team/6.jpeg');

-- --------------------------------------------------------

--
-- Структура таблицы `Корзина`
--

CREATE TABLE `Корзина` (
  `id_заказа` int(7) NOT NULL,
  `id_польз` int(7) NOT NULL,
  `id_мерч` int(7) NOT NULL,
  `дата_заказа` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Корзина`
--

INSERT INTO `Корзина` (`id_заказа`, `id_польз`, `id_мерч`, `дата_заказа`) VALUES
(1, 4, 1, '2023-04-06 17:20:10');

-- --------------------------------------------------------

--
-- Структура таблицы `Новость`
--

CREATE TABLE `Новость` (
  `id_новости` int(7) NOT NULL,
  `id_команды` int(7) NOT NULL,
  `Название_новости` varchar(100) NOT NULL,
  `Текст` varchar(1000) NOT NULL,
  `Время_новости` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Автор` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Новость`
--

INSERT INTO `Новость` (`id_новости`, `id_команды`, `Название_новости`, `Текст`, `Время_новости`, `Автор`) VALUES
(1, 4, 'Переход Игрока в другую команду', 'паоптаоптваоптавоптваоптвапотвапоптавпаов', '2023-04-06 16:26:46', 'Павлов Павел Павлович'),
(5, 4, 'Переход Игрока в другую команду', 'паоптаоптваоптавоптваоптвапотвапоптавпаов', '2023-04-06 16:35:46', 'Павлов Павел Павлович'),
(6, 2, 'вавыавыав', 'ывавваыавы', '2023-04-06 16:36:11', 'ваывыва');

-- --------------------------------------------------------

--
-- Структура таблицы `Пользователь`
--

CREATE TABLE `Пользователь` (
  `id_пользователя` int(7) NOT NULL,
  `ФИО_польз` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `телефон` varchar(20) NOT NULL,
  `Логин` varchar(255) NOT NULL,
  `Пароль` varchar(255) NOT NULL,
  `Дата_регистрации` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Пользователь`
--

INSERT INTO `Пользователь` (`id_пользователя`, `ФИО_польз`, `email`, `телефон`, `Логин`, `Пароль`, `Дата_регистрации`) VALUES
(4, 'аапавпав', 'mablokochanelgame@gmail.com', '3242342', 'aakoval', '1234', '2023-04-06 16:52:34');

-- --------------------------------------------------------

--
-- Структура таблицы `Судья`
--

CREATE TABLE `Судья` (
  `ID_Судьи` int(7) NOT NULL,
  `ФИО` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Судья`
--

INSERT INTO `Судья` (`ID_Судьи`, `ФИО`) VALUES
(1, 'Суслов Владимир Викторович'),
(2, 'Акузовский Николай Альбертович'),
(3, 'Беляев Дмитрий Олегович'),
(4, 'Антонов Евгений Викторович'),
(18, 'Комаров Владимир Петрович');

-- --------------------------------------------------------

--
-- Структура таблицы `Турнир`
--

CREATE TABLE `Турнир` (
  `ID_Турнира` int(7) NOT NULL,
  `Дивизион` int(2) NOT NULL,
  `Кол_игр` int(4) NOT NULL,
  `Дата_начала` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Дата_окончания` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Турнир`
--

INSERT INTO `Турнир` (`ID_Турнира`, `Дивизион`, `Кол_игр`, `Дата_начала`, `Дата_окончания`) VALUES
(1, 1, 15, '2023-02-01 14:47:59', '2023-03-31 14:47:59'),
(2, 2, 20, '2023-03-14 14:48:26', '2023-03-14 14:49:54'),
(3, 4, 32, '2022-12-31 14:48:26', '2023-01-31 14:48:26'),
(4, 1, 16, '2022-09-01 14:48:26', '2022-10-28 14:48:26'),
(5, 3, 4, '2023-01-01 14:48:26', '2023-03-01 14:48:26');

-- --------------------------------------------------------

--
-- Структура таблицы `Турнир_Команда`
--

CREATE TABLE `Турнир_Команда` (
  `ID_Тур_Ком` int(7) NOT NULL,
  `ID_Турнира` int(7) NOT NULL,
  `ID_Команды` int(7) NOT NULL,
  `Сумма_пораж` int(4) NOT NULL,
  `Сумма_побед` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Турнир_Команда`
--

INSERT INTO `Турнир_Команда` (`ID_Тур_Ком`, `ID_Турнира`, `ID_Команды`, `Сумма_пораж`, `Сумма_побед`) VALUES
(1, 1, 1, 6, 8),
(2, 2, 2, 4, 1),
(3, 1, 3, 4, 5),
(4, 2, 1, 4, 10),
(5, 3, 1, 6, 7),
(6, 4, 5, 10, 6),
(7, 5, 3, 15, 23);

-- --------------------------------------------------------

--
-- Структура таблицы `мерч`
--

CREATE TABLE `мерч` (
  `id_мерча` int(7) NOT NULL,
  `Название_мерч` varchar(255) NOT NULL,
  `Тип_мерча` varchar(100) NOT NULL,
  `id_команды` int(7) NOT NULL,
  `Цена` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `мерч`
--

INSERT INTO `мерч` (`id_мерча`, `Название_мерч`, `Тип_мерча`, `id_команды`, `Цена`) VALUES
(1, 'Джерси игровое', 'Игровая форма', 1, '17000.00'),
(2, 'Футболка с логотипом', 'Футболка', 2, '2500.00'),
(3, 'Худи с Логотипом', 'Худи', 3, '5500.00');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Арена`
--
ALTER TABLE `Арена`
  ADD PRIMARY KEY (`ID_Арены`);

--
-- Индексы таблицы `Игра`
--
ALTER TABLE `Игра`
  ADD PRIMARY KEY (`ID_Игры`),
  ADD KEY `ID_Арены` (`ID_Арены`),
  ADD KEY `игра_ibfk_2` (`ID_Команды`),
  ADD KEY `игра_ibfk_3` (`ID_Судьи`);

--
-- Индексы таблицы `Игрок`
--
ALTER TABLE `Игрок`
  ADD PRIMARY KEY (`ID_Игрока`),
  ADD KEY `ID_Команды` (`ID_Команды`);

--
-- Индексы таблицы `Игры_с_суммой`
--
ALTER TABLE `Игры_с_суммой`
  ADD PRIMARY KEY (`ID_Игры`),
  ADD KEY `игры_с_суммой_ibfk_2` (`ID_Арены`),
  ADD KEY `игры_с_суммой_ibfk_3` (`ID_Команды_1`),
  ADD KEY `игры_с_суммой_ibfk_4` (`ID_Команды_2`),
  ADD KEY `игры_с_суммой_ibfk_5` (`ID_Судьи`);

--
-- Индексы таблицы `Команда`
--
ALTER TABLE `Команда`
  ADD PRIMARY KEY (`ID_Команды`);

--
-- Индексы таблицы `Корзина`
--
ALTER TABLE `Корзина`
  ADD PRIMARY KEY (`id_заказа`),
  ADD KEY `id_мерч` (`id_мерч`),
  ADD KEY `корзина_ibfk_2` (`id_польз`);

--
-- Индексы таблицы `Новость`
--
ALTER TABLE `Новость`
  ADD PRIMARY KEY (`id_новости`),
  ADD KEY `id_команды` (`id_команды`);

--
-- Индексы таблицы `Пользователь`
--
ALTER TABLE `Пользователь`
  ADD PRIMARY KEY (`id_пользователя`);

--
-- Индексы таблицы `Судья`
--
ALTER TABLE `Судья`
  ADD PRIMARY KEY (`ID_Судьи`);

--
-- Индексы таблицы `Турнир`
--
ALTER TABLE `Турнир`
  ADD PRIMARY KEY (`ID_Турнира`);

--
-- Индексы таблицы `Турнир_Команда`
--
ALTER TABLE `Турнир_Команда`
  ADD PRIMARY KEY (`ID_Тур_Ком`),
  ADD KEY `ID_Турнира` (`ID_Турнира`),
  ADD KEY `турнир_команда_ibfk_2` (`ID_Команды`);

--
-- Индексы таблицы `мерч`
--
ALTER TABLE `мерч`
  ADD PRIMARY KEY (`id_мерча`),
  ADD KEY `id_команды` (`id_команды`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Арена`
--
ALTER TABLE `Арена`
  MODIFY `ID_Арены` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `Игра`
--
ALTER TABLE `Игра`
  MODIFY `ID_Игры` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `Игрок`
--
ALTER TABLE `Игрок`
  MODIFY `ID_Игрока` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `Игры_с_суммой`
--
ALTER TABLE `Игры_с_суммой`
  MODIFY `ID_Игры` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Команда`
--
ALTER TABLE `Команда`
  MODIFY `ID_Команды` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `Корзина`
--
ALTER TABLE `Корзина`
  MODIFY `id_заказа` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `Новость`
--
ALTER TABLE `Новость`
  MODIFY `id_новости` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `Пользователь`
--
ALTER TABLE `Пользователь`
  MODIFY `id_пользователя` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Судья`
--
ALTER TABLE `Судья`
  MODIFY `ID_Судьи` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `Турнир`
--
ALTER TABLE `Турнир`
  MODIFY `ID_Турнира` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Турнир_Команда`
--
ALTER TABLE `Турнир_Команда`
  MODIFY `ID_Тур_Ком` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `мерч`
--
ALTER TABLE `мерч`
  MODIFY `id_мерча` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Игра`
--
ALTER TABLE `Игра`
  ADD CONSTRAINT `игра_ibfk_1` FOREIGN KEY (`ID_Арены`) REFERENCES `Арена` (`ID_Арены`),
  ADD CONSTRAINT `игра_ibfk_2` FOREIGN KEY (`ID_Команды`) REFERENCES `Команда` (`ID_Команды`),
  ADD CONSTRAINT `игра_ibfk_3` FOREIGN KEY (`ID_Судьи`) REFERENCES `Судья` (`ID_Судьи`);

--
-- Ограничения внешнего ключа таблицы `Игрок`
--
ALTER TABLE `Игрок`
  ADD CONSTRAINT `игрок_ibfk_1` FOREIGN KEY (`ID_Команды`) REFERENCES `Команда` (`ID_Команды`);

--
-- Ограничения внешнего ключа таблицы `Игры_с_суммой`
--
ALTER TABLE `Игры_с_суммой`
  ADD CONSTRAINT `игры_с_суммой_ibfk_1` FOREIGN KEY (`ID_Игры`) REFERENCES `Игра` (`ID_Игры`),
  ADD CONSTRAINT `игры_с_суммой_ibfk_2` FOREIGN KEY (`ID_Арены`) REFERENCES `Арена` (`ID_Арены`),
  ADD CONSTRAINT `игры_с_суммой_ibfk_3` FOREIGN KEY (`ID_Команды_1`) REFERENCES `Команда` (`ID_Команды`),
  ADD CONSTRAINT `игры_с_суммой_ibfk_4` FOREIGN KEY (`ID_Команды_2`) REFERENCES `Команда` (`ID_Команды`),
  ADD CONSTRAINT `игры_с_суммой_ibfk_5` FOREIGN KEY (`ID_Судьи`) REFERENCES `Судья` (`ID_Судьи`);

--
-- Ограничения внешнего ключа таблицы `Корзина`
--
ALTER TABLE `Корзина`
  ADD CONSTRAINT `корзина_ibfk_1` FOREIGN KEY (`id_мерч`) REFERENCES `мерч` (`id_мерча`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `корзина_ibfk_2` FOREIGN KEY (`id_польз`) REFERENCES `Пользователь` (`id_пользователя`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Новость`
--
ALTER TABLE `Новость`
  ADD CONSTRAINT `новость_ibfk_1` FOREIGN KEY (`id_команды`) REFERENCES `Команда` (`ID_Команды`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Турнир_Команда`
--
ALTER TABLE `Турнир_Команда`
  ADD CONSTRAINT `турнир_команда_ibfk_1` FOREIGN KEY (`ID_Турнира`) REFERENCES `Турнир` (`ID_Турнира`),
  ADD CONSTRAINT `турнир_команда_ibfk_2` FOREIGN KEY (`ID_Команды`) REFERENCES `Команда` (`ID_Команды`);

--
-- Ограничения внешнего ключа таблицы `мерч`
--
ALTER TABLE `мерч`
  ADD CONSTRAINT `мерч_ibfk_1` FOREIGN KEY (`id_команды`) REFERENCES `Команда` (`ID_Команды`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

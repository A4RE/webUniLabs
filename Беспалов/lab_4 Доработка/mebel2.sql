-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Апр 25 2023 г., 15:41
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
-- База данных: `mebel2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Акции`
--

CREATE TABLE `Акции` (
  `id_акции` int(7) NOT NULL,
  `id_магазина` int(7) NOT NULL,
  `Название_акции` varchar(255) NOT NULL,
  `Описание_акции` varchar(1000) NOT NULL,
  `Начало_акции` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Конец_акции` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Акции`
--

INSERT INTO `Акции` (`id_акции`, `id_магазина`, `Название_акции`, `Описание_акции`, `Начало_акции`, `Конец_акции`) VALUES
(1, 1, 'Название акции 1', 'Описание для акции 1', '2023-04-01 17:38:17', '2023-04-29 17:38:17'),
(2, 1, 'Название акции 2', 'Описание для акции 2', '2023-04-01 17:38:17', '2023-04-29 17:38:17'),
(3, 1, 'Название акции 3', 'Описание для акции 3', '2023-04-01 17:38:17', '2023-04-29 17:38:17'),
(4, 1, 'Название акции 4', 'Описание для акции 4', '2023-04-01 17:38:17', '2023-04-29 17:38:17');

-- --------------------------------------------------------

--
-- Структура таблицы `Категории`
--

CREATE TABLE `Категории` (
  `ID_категории` int(7) NOT NULL,
  `Название_категории` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Категории`
--

INSERT INTO `Категории` (`ID_категории`, `Название_категории`) VALUES
(1, 'Угловые диваны'),
(2, 'Прямые диваны'),
(3, 'Модульные диваны'),
(4, 'Кушетки'),
(5, 'Кресла');

-- --------------------------------------------------------

--
-- Структура таблицы `Клиент`
--

CREATE TABLE `Клиент` (
  `ID_клиента` int(7) NOT NULL,
  `ФИО` varchar(100) DEFAULT NULL,
  `Логин` varchar(255) NOT NULL,
  `Пароль` varchar(50) DEFAULT NULL,
  `Адрес_получателя` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `Телефон` varchar(15) DEFAULT NULL,
  `Дата_регистрации` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Клиент`
--

INSERT INTO `Клиент` (`ID_клиента`, `ФИО`, `Логин`, `Пароль`, `Адрес_получателя`, `email`, `Телефон`, `Дата_регистрации`) VALUES
(1, 'Иванов Иван Иванович', '', '123456seven', 'СПБ, Московский пр., д.163', 'newemail1@test.ru', '89031234585', '2023-04-11 18:04:01'),
(2, 'Черных Антон Владимирович', '', '782093QQ', 'СПБ, пр. Большевиков, д.8', 'blackAV@gmail.com', '89613254136', '2023-04-11 18:04:01'),
(3, 'Павлов Владимир Геннадьевич', '', 'gena32oq1', 'Москва, пр. Ленина, д.25', 'vovka4532@mail.ru', '89324129465', '2023-04-11 18:04:01'),
(4, 'Ильина Марина Антоновна', '', 'marinka312598', 'Орск, Новотроицкое шоссе, д.9', 'ilianamarina@mail.ru', '89059543612', '2023-04-11 18:04:01'),
(5, 'Сидорова Анна Михайловна', '', 'mihann91sid', 'СРБ, Жукова, д.41А', 'sidorovaanna19@gmail.com', '89631243684', '2023-04-11 18:04:01'),
(6, 'Коваленко Андрей Алексеевич', 'aakoval', '1234', 'Яхтенная, д.24, к2', 'aakoval01@gmail.com', '+79064634834', '2023-04-11 18:04:01'),
(7, 'Беспалов Максим', 'bespalov', '1234', 'г. Санкт-Петербург, Московский пр, д.8', 'bespalovMaksim@gmail.com', '89354450733', '2023-04-11 19:13:04');

-- --------------------------------------------------------

--
-- Структура таблицы `Корзина`
--

CREATE TABLE `Корзина` (
  `id_заказа` int(7) NOT NULL,
  `id_клиента` int(7) NOT NULL,
  `id_мебели` int(7) NOT NULL,
  `дата_заказа` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Корзина`
--

INSERT INTO `Корзина` (`id_заказа`, `id_клиента`, `id_мебели`, `дата_заказа`) VALUES
(4, 6, 1, '2023-04-25 15:39:59'),
(5, 6, 2, '2023-04-25 15:39:59');

-- --------------------------------------------------------

--
-- Структура таблицы `Магазин`
--

CREATE TABLE `Магазин` (
  `id_магазина` int(7) NOT NULL,
  `Адрес_магазина` varchar(255) NOT NULL,
  `Телефон_магазина` varchar(20) NOT NULL,
  `Блок_карты` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Магазин`
--

INSERT INTO `Магазин` (`id_магазина`, `Адрес_магазина`, `Телефон_магазина`, `Блок_карты`) VALUES
(1, 'Адрес магазина 1', '89054450733', '<div style=\"position:relative;overflow:hidden;\"><a href=\"https://yandex.ru/maps/2/saint-petersburg/?utm_medium=mapframe&utm_source=maps\" style=\"color:#eee;font-size:12px;position:absolute;top:0px;\">Санкт‑Петербург</a><a href=\"https://yandex.ru/maps/2/saint-petersburg/?ll=30.224780%2C59.983528&mode=whatshere&utm_medium=mapframe&utm_source=maps&whatshere%5Bpoint%5D=30.207221%2C59.991348&whatshere%5Bzoom%5D=14.66&z=14.66\" style=\"color:#eee;font-size:12px;position:absolute;top:14px;\">Беговая улица — Яндекс Карты</a><iframe src=\"https://yandex.ru/map-widget/v1/?ll=30.224780%2C59.983528&mode=whatshere&whatshere%5Bpoint%5D=30.207221%2C59.991348&whatshere%5Bzoom%5D=14.66&z=14.66\" width=\"560\" height=\"400\" frameborder=\"1\" allowfullscreen=\"true\" style=\"position:relative;\"></iframe></div>'),
(2, 'Адрес магазина 2', '89054450733', '<div style=\"position:relative;overflow:hidden;\"><a href=\"https://yandex.ru/maps/2/saint-petersburg/?utm_medium=mapframe&utm_source=maps\" style=\"color:#eee;font-size:12px;position:absolute;top:0px;\">Санкт‑Петербург</a><a href=\"https://yandex.ru/maps/2/saint-petersburg/?ll=30.255536%2C59.963927&mode=whatshere&utm_medium=mapframe&utm_source=maps&whatshere%5Bpoint%5D=30.269707%2C59.971708&whatshere%5Bzoom%5D=13.61&z=13.61\" style=\"color:#eee;font-size:12px;position:absolute;top:14px;\">Константиновский переулок — Яндекс Карты</a><iframe src=\"https://yandex.ru/map-widget/v1/?ll=30.255536%2C59.963927&mode=whatshere&whatshere%5Bpoint%5D=30.269707%2C59.971708&whatshere%5Bzoom%5D=13.61&z=13.61\" width=\"560\" height=\"400\" frameborder=\"1\" allowfullscreen=\"true\" style=\"position:relative;\"></iframe></div>'),
(3, 'Адрес магазина 3', '89054450733', '<div style=\"position:relative;overflow:hidden;\"><a href=\"https://yandex.ru/maps/2/saint-petersburg/?utm_medium=mapframe&utm_source=maps\" style=\"color:#eee;font-size:12px;position:absolute;top:0px;\">Санкт‑Петербург</a><a href=\"https://yandex.ru/maps/2/saint-petersburg/?ll=30.264907%2C59.951394&mode=whatshere&utm_medium=mapframe&utm_source=maps&whatshere%5Bpoint%5D=30.241532%2C59.936483&whatshere%5Bzoom%5D=13.04&z=13.04\" style=\"color:#eee;font-size:12px;position:absolute;top:14px;\">Территория Гавань — Яндекс Карты</a><iframe src=\"https://yandex.ru/map-widget/v1/?ll=30.264907%2C59.951394&mode=whatshere&whatshere%5Bpoint%5D=30.241532%2C59.936483&whatshere%5Bzoom%5D=13.04&z=13.04\" width=\"560\" height=\"400\" frameborder=\"1\" allowfullscreen=\"true\" style=\"position:relative;\"></iframe></div>'),
(4, 'Адрес магазина 4', '89054450733', '<div style=\"position:relative;overflow:hidden;\"><a href=\"https://yandex.ru/maps/2/saint-petersburg/?utm_medium=mapframe&utm_source=maps\" style=\"color:#eee;font-size:12px;position:absolute;top:0px;\">Санкт‑Петербург</a><a href=\"https://yandex.ru/maps/2/saint-petersburg/?ll=30.295096%2C59.938082&mode=whatshere&utm_medium=mapframe&utm_source=maps&whatshere%5Bpoint%5D=30.324462%2C59.933984&whatshere%5Bzoom%5D=12.82&z=12.82\" style=\"color:#eee;font-size:12px;position:absolute;top:14px;\">Муниципальный округ № 78 — Яндекс Карты</a><iframe src=\"https://yandex.ru/map-widget/v1/?ll=30.295096%2C59.938082&mode=whatshere&whatshere%5Bpoint%5D=30.324462%2C59.933984&whatshere%5Bzoom%5D=12.82&z=12.82\" width=\"560\" height=\"400\" frameborder=\"1\" allowfullscreen=\"true\" style=\"position:relative;\"></iframe></div>');

-- --------------------------------------------------------

--
-- Структура таблицы `Модель`
--

CREATE TABLE `Модель` (
  `ID_модели` int(7) NOT NULL,
  `Название_модели` varchar(100) DEFAULT NULL,
  `ID_категории` int(7) DEFAULT NULL,
  `Цена` int(10) DEFAULT NULL,
  `Описание` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Модель`
--

INSERT INTO `Модель` (`ID_модели`, `Название_модели`, `ID_категории`, `Цена`, `Описание`) VALUES
(1, 'Диван Динс Sherts Blue', 2, 105000, 'Лаконичные линии и простые формы, безупречный стиль и индивидуальность – все это диван «Динс». Сдержанный скандинавский дизайн украсит любую современную обстановку.'),
(2, 'Диван Нумо Velvet Latte', 2, 34990, 'Диван Нумо – классический представитель скандинавского стиля. Его лаконичный дизайн с деревянными ножками и узкими подлокотниками удачно дополнит интерьер гостиной или кабинета.'),
(3, 'Диван угловой Ситено Barhat Salmon', 1, 69990, 'Угловой диван «Ситено» стильный и элегантный, удобно разместит домочадцев и гостей в гостиной или студии. '),
(4, 'Диван угловой Беллер Textile Light', 1, 39990, 'Угловой диван «Беллер» стильный и элегантный, удобно разместит домочадцев и гостей на кухне или в студии.'),
(5, 'Модульный диван Этен Vertical Mint', 3, 73460, 'Модульный диван хорошо подходит для \"посиделок\" с друзьями или родственниками. Удобной, мягкий и элегантный, подойдет для всех.'),
(6, 'Модульный диван Монреаль-2 Barhat Grey', 3, 116270, 'Данный модульный диван отлично подходит для мест, где можно развлечься. Например, его можно разместить в Вашем клубе, ресторане или ТЦ.'),
(7, 'Кушетка Роби Textile Coral', 4, 15990, 'Кушетка Роби – лаконичность и правильность форм. Конструкция изделия представляет собой прямоугольное основание и овальный валик.'),
(8, 'Кушетка Берил Velvet Beige', 4, 34990, 'Кушетка Берил очень компактная модель для отдыха. Хорошо подойдет для расположения в офисе на этаже или в кабинетах.'),
(9, 'Кресло Витио Happy Mint', 5, 26990, 'Неотъемлемый атрибут скандинавского интерьера – уютная мебель. Оригинальное скандинавское кресло «Витио» станет отличным дополнением для дома или офиса. '),
(10, 'Кресло Сите Barhat Grey', 5, 24990, 'Лаконичный силуэт и минимум декора – кресло «Сите» соответствует всем канонам сдержанной скандинавской эстетики. Большое и невероятно уютное кресло станет любимым местом в каждом доме!');

-- --------------------------------------------------------

--
-- Структура таблицы `Отзыв`
--

CREATE TABLE `Отзыв` (
  `ID_отзыва` int(7) NOT NULL,
  `ID_модели` int(7) DEFAULT NULL,
  `Содержание` varchar(200) DEFAULT NULL,
  `Дата_время` datetime DEFAULT CURRENT_TIMESTAMP,
  `ID_клиента` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Отзыв`
--

INSERT INTO `Отзыв` (`ID_отзыва`, `ID_модели`, `Содержание`, `Дата_время`, `ID_клиента`) VALUES
(6, 2, 'Покупал диван Нумо, советовали друзья, очень хорошо подошел к интерьеру квартиры, отличное качество, спасибо!!!', '2022-02-16 20:07:23', 2),
(7, 4, 'Заказала на дом угловой диван, все пришло в хорошем состоянии, без порезов и тд, курьер очень вежливый, в будущем куплю в подарок родителям еще.', '2022-03-01 20:08:16', 4),
(8, 7, 'Долго искал похожие варианты в интернете, здесь самый лучший вариант, цвет, обивка, топ! Поставил у себя в кабинете, в перерывах отдыхаю на нем))', '2022-01-24 20:08:16', 1),
(9, 5, 'Обустраивали загородный дом, были в поисках хорошего и качественного дивана. Выбор пал на модульный. Качество отпад, однако доставка задержалась из-за поиска курьеров(', '2021-10-31 20:08:16', 3),
(10, 10, 'Работаю в офисе, решила заказать себе удобное кресло, потому что работать весь день на твердом стуле очень тяжело. Все очень понравилось, от заказа до доставки, спасибо вам!!!', '2021-12-08 20:08:16', 5);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Акции`
--
ALTER TABLE `Акции`
  ADD PRIMARY KEY (`id_акции`),
  ADD KEY `id_магазина` (`id_магазина`);

--
-- Индексы таблицы `Категории`
--
ALTER TABLE `Категории`
  ADD PRIMARY KEY (`ID_категории`);

--
-- Индексы таблицы `Клиент`
--
ALTER TABLE `Клиент`
  ADD PRIMARY KEY (`ID_клиента`);

--
-- Индексы таблицы `Корзина`
--
ALTER TABLE `Корзина`
  ADD PRIMARY KEY (`id_заказа`),
  ADD KEY `id_клиента` (`id_клиента`),
  ADD KEY `корзина_ibfk_2` (`id_мебели`);

--
-- Индексы таблицы `Магазин`
--
ALTER TABLE `Магазин`
  ADD PRIMARY KEY (`id_магазина`);

--
-- Индексы таблицы `Модель`
--
ALTER TABLE `Модель`
  ADD PRIMARY KEY (`ID_модели`),
  ADD KEY `ID_категории` (`ID_категории`);

--
-- Индексы таблицы `Отзыв`
--
ALTER TABLE `Отзыв`
  ADD PRIMARY KEY (`ID_отзыва`),
  ADD KEY `ID_клиента` (`ID_клиента`),
  ADD KEY `отзыв_ibfk_2` (`ID_модели`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Акции`
--
ALTER TABLE `Акции`
  MODIFY `id_акции` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Категории`
--
ALTER TABLE `Категории`
  MODIFY `ID_категории` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Клиент`
--
ALTER TABLE `Клиент`
  MODIFY `ID_клиента` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `Корзина`
--
ALTER TABLE `Корзина`
  MODIFY `id_заказа` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Магазин`
--
ALTER TABLE `Магазин`
  MODIFY `id_магазина` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Модель`
--
ALTER TABLE `Модель`
  MODIFY `ID_модели` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT для таблицы `Отзыв`
--
ALTER TABLE `Отзыв`
  MODIFY `ID_отзыва` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Акции`
--
ALTER TABLE `Акции`
  ADD CONSTRAINT `акции_ibfk_1` FOREIGN KEY (`id_магазина`) REFERENCES `Магазин` (`id_магазина`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Корзина`
--
ALTER TABLE `Корзина`
  ADD CONSTRAINT `корзина_ibfk_1` FOREIGN KEY (`id_клиента`) REFERENCES `Клиент` (`ID_клиента`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `корзина_ibfk_2` FOREIGN KEY (`id_мебели`) REFERENCES `Модель` (`ID_модели`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Модель`
--
ALTER TABLE `Модель`
  ADD CONSTRAINT `модель_ibfk_1` FOREIGN KEY (`ID_категории`) REFERENCES `Категории` (`ID_категории`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Отзыв`
--
ALTER TABLE `Отзыв`
  ADD CONSTRAINT `отзыв_ibfk_1` FOREIGN KEY (`ID_клиента`) REFERENCES `Клиент` (`ID_клиента`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `отзыв_ibfk_2` FOREIGN KEY (`ID_модели`) REFERENCES `Модель` (`ID_модели`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

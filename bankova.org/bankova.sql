-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 02 2023 г., 19:03
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bankova`
--

-- --------------------------------------------------------

--
-- Структура таблицы `kategory`
--

CREATE TABLE `kategory` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `kategory`
--

INSERT INTO `kategory` (`id`, `name`) VALUES
(1, 'Помада'),
(2, 'Кушоны'),
(3, 'Подводка'),
(4, 'Румяна'),
(5, 'Палетки');

-- --------------------------------------------------------

--
-- Структура таблицы `korzina`
--

CREATE TABLE `korzina` (
  `id` int NOT NULL,
  `id_tov` int NOT NULL,
  `img` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `about1` varchar(100) NOT NULL,
  `kolvo` int NOT NULL,
  `price` int NOT NULL,
  `login` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `tovar`
--

CREATE TABLE `tovar` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `about` varchar(100) NOT NULL,
  `Kolichestvo` int NOT NULL,
  `Cvet` varchar(200) NOT NULL,
  `Country` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kategory` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `tovar`
--

INSERT INTO `tovar` (`id`, `name`, `img`, `price`, `about`, `Kolichestvo`, `Cvet`, `Country`, `kategory`) VALUES
(462, 'ТИНТ ДЛЯ ГУБ\r\nCLIO dewy blur', '8809786599485_1_i7zf9rfxqxho6oo2.jpg', 1546, 'Легкий тинт с увлажняющими ингредиентами комфортно и гладко наносится на губы.', 14, 'MAUVE PLUM', 'Корея', 'Помада'),
(463, 'БАЛЬЗАМ ДЛЯ ГУБ\r\nDEAR DAHLIA ', '8809546841717_1_cqfclizvnirofbp4.jpg', 1450, 'Бальзам Dear Dahlia тает на губах и придает им уникальный лёгкий оттенок.', 46, 'FANTASY', 'Корея', 'Помада'),
(464, 'Чернфй бальзам для губ', '4650218180634_1_qgoiefx5b5pgoaiz.jpg', 1345, 'Бестселлер от бренда RBG совместно с Золотым Яблоком в новом варианте!', 42, 'BLACK', 'Корея', 'Помада'),
(465, 'Автоматический карандаш для губ', '8435446410540_1_m1mkqt6hmydt6mfv.jpg', 890, 'Не выходите за контур – выходите за рамки', 67, 'розовый', 'Корея', 'Помада'),
(466, 'Жидкая губная помда', '744119196062_1_xtdfdx3foyowpgud.jpg', 1230, 'Жидкая губная помада BODYOGRAPHY быстро высыхает на губах.', 35, 'AU NATUREL', 'Корея', 'Помада'),
(467, 'Подводка для глаз водостойкая  VIVIENNE SABO CHARBON', '3700971312429_1_y5i0tx8wmor16tu3.jpg', 785, 'Жидкая подводка CHARBON в водостойкой текстуре', 53, 'Черный', 'Корея', 'Подводка'),
(469, 'Подводка для глаз жидкая VIVIENNE SABO CHARBON', '3700971302048_1_rsyssej9exbdcx2i.jpg', 1350, 'Удобный аппликатор, стойкая формула, интенсивный черный цвет.', 54, 'Черный', 'Корея', 'Подводка'),
(470, 'Подводка для глаз жидкая VIVIENNE SABO CHARBON', '3700971312863_1_k4nkpkfcctlf6bdu.jpg', 1230, 'Подводка быстро фиксируется на веке, не растекается и не растрескивается в течение дня.', 65, 'Черный', 'Корея', 'Подводка'),
(471, 'Подводка для глаз жидкая  VIVIENNE SABO CHOCOLAT', '3700971302062_1_fjhbehzfzxzuqilm.jpg', 1487, 'ФРАНЦУЗСКИЕ СТРЕЛКИ В ДНЕВНОМ МАКИЯЖЕ Жидкая подводка Chocolat интенсивного коричневого цвета', 23, 'Коричневый', 'Корея', 'Подводка'),
(472, 'РУМЯНА ДЛЯ ЛИЦА MAC POWDER BLUSH', '773602025763_1_qn4j3pu6sslxpc0f.jpg', 1340, 'Румяна для лица M.A.C. Powder blush – это универсальное средство от мастеров M.A.C.', 56, 'Розовый', 'Корея', 'Румяна'),
(473, 'Румяна Bourjois Blusher\r\nРУМЯНА', '3614225613234_1.jpeg_x60uq9yamt5cbyfy.jpg', 560, 'Запеченные румяна Blusher в маленьких круглых баночках с ароматом розы', 132, 'Нежно-розовый', 'Корея', 'Румяна'),
(474, 'Румяна PUPA luminys baked all over', 'd49fb0b937bb140e5214d20a1fa4a6d9_1.jpg', 1095, 'Румяна-пудра универсальная для лица и тела Pupa Luminys Baked All Over', 43, 'Пыльно-розовый', 'Корея', 'Румяна'),
(475, 'Румяна Bobbi Brown Blush\r\nРУМЯНА', '716170059587_1_wnelpxejdmhbblqi.jpg', 1900, 'Шелковистая формула легко наносится и создает стойкий матовый эффект.', 12, 'Розовый', 'Корея', 'Румяна'),
(476, 'Румяна для лица в шариках  Divage Perlamour\r\nРУМЯНА ДЛЯ ЛИЦА В ШАРИКАХ', '4640005212167_1_rakqegp6gx9gmfp7.jpg', 1350, 'Румяна для лица в шариках Divage Perlamour обладают уникальным эффектом', 19, 'Телесный', 'Корея', 'Румяна'),
(477, 'Кушон Cremorlab Eau Thermale', '8809343762390_1_whgqatquxcttwe7w.jpg', 5500, 'Легкий тональный флюид, которым пропитана губка подушечка обеспечивает стойкое невесомое покрытие.', 23, 'Первый оттенок', 'Корея', 'Кушоны'),
(478, 'Сменный блок для тональной основы-кушона Chupa Chups', '8809507310429_1_dt5wfnqxstfjqpzl.jpg', 894, 'Сменный блок позволяет обновлять сресдство без смены основной упаковки. ', 89, 'Белый', 'Корея', 'Кушоны'),
(479, 'Тональный кушон с эффектом сияния CLÉ DE PEAU BEAUTÉ RADIAN', '729238166332_1_rortn7dr7afhe7pa.jpg', 8160, 'Тональный кушон с эффектом сияния CLÉ DE PEAU BEAUTÉ обладает легкой, нежной, неплотной текстурой.', 45, 'Первый и второй оттенок', 'Корея', 'Кушоны'),
(480, 'Компактный кушон для свежего совершенного тона Shiseido', '729238157514_1_8kbzfbljgrfwena1.jpg', 3660, 'Этот невесомый, стойкий кушон в компактном футляре позволяет варьировать плотность покрытия', 42, 'Первый оттенок', 'Корея', 'Кушоны'),
(481, 'Тональный лифтинг-кушон с эффектом сияния  La Mer The Cushion Compact SPF 30', '22176d45fd85e980799496f202b94636_1.jpg', 11070, 'Тональный лифтинг-кушон с эффектом сияния La Mer The Cushion Compact SPF 30 имеет необычную текстуру', 20, 'Первый оттенок', 'Корея', 'Кушоны'),
(482, 'ПАЛЕТКА ТЕНЕЙ ДЛЯ ВЕК NYX PROFESSIONAL MAKEUP ULTIMATE SHADOW PALETTE', '800897017644_1_1_thcnnjenvni1mrno.jpg', 1456, 'Палетка теней для век NYX Professional Makeup Ultimate shadow palette', 56, 'Яркие', 'Корея', 'Палетки'),
(483, 'Палетка теней для век NYX PROFESSIONAL MAKEUP LID LINGERIE SHADOW PALETTE', '800897093242_1_4okvu4j4hiaohbyo.jpg', 980, 'Десять оттенков палетки Lid Lingerie shadow palette делают ее универсальной для использования', 34, 'Нюдовый', 'Корея', 'Палетки'),
(484, 'Палетка теней для век MakeUp Revolution Re Loaded Palette Iconic Fever', '5057566014496_1_secxqovt949hild9.jpg', 1340, 'Палетка, выполненная в теплой цветовой гамме, непременно станет вашим must-have на каждый день', 23, 'Нюдовый', 'Корея', 'Палетки'),
(485, 'Палетка теней для век MakeUp Revolution Re Loaded Palette NEWTRALS 2', '5057566014533_1_fvylzhwdavtmifqd.jpg', 1280, 'Revolution Makeup Re-Loaded Palette Newtrals 2 – палетка для самых огненных мейков', 54, 'Нюд-розовый', 'Корея', 'Палетки'),
(486, 'Палетка теней для век MakeUp Revolution Re Loaded Palette Iconic Division', '5057566016452_1_krbfi1u4a9hz2dtj.jpg', 1780, 'Палетка теней от британского бренда позволит вам воплотить в жизнь самые смелые образы', 12, 'Нюд-зеленый', 'Корея', 'Палетки');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `data_rozh` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `City` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mail` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `img` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `adres` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tel` text,
  `surname` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `status`, `data_rozh`, `City`, `Name`, `mail`, `img`, `adres`, `tel`, `surname`) VALUES
(1, '1', '1', '1', '2003-07-11', 'Якутск', 'СВЕИРАААА', '1', 't15.jpg', '', '6666633', 'ккк'),
(17, 'света', 'света', '0', NULL, NULL, 'ее', 'ее', NULL, NULL, NULL, 'ее');

-- --------------------------------------------------------

--
-- Структура таблицы `zakaz`
--

CREATE TABLE `zakaz` (
  `id` int NOT NULL,
  `id_tov` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `kol-vo` int NOT NULL,
  `about1` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `login` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `kategory`
--
ALTER TABLE `kategory`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `korzina`
--
ALTER TABLE `korzina`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tovar`
--
ALTER TABLE `tovar`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `zakaz`
--
ALTER TABLE `zakaz`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `kategory`
--
ALTER TABLE `kategory`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `korzina`
--
ALTER TABLE `korzina`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `tovar`
--
ALTER TABLE `tovar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=487;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `zakaz`
--
ALTER TABLE `zakaz`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

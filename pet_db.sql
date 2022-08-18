-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 18 2022 г., 15:27
-- Версия сервера: 8.0.24
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `pet_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `background_label`
--

CREATE TABLE `background_label` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `background_label`
--

INSERT INTO `background_label` (`id`, `name`) VALUES
(1, 'белый'),
(2, 'металлизированный серебро'),
(3, 'металлизированный золото'),
(4, 'прозрачный');

-- --------------------------------------------------------

--
-- Структура таблицы `bank_transfer`
--

CREATE TABLE `bank_transfer` (
  `id` int NOT NULL,
  `date_of_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `customer_id` int NOT NULL,
  `date` date NOT NULL,
  `sum` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `bank_transfer`
--

INSERT INTO `bank_transfer` (`id`, `date_of_create`, `customer_id`, `date`, `sum`) VALUES
(1, '2022-08-17 15:26:53', 1, '2022-08-01', 10000),
(2, '2022-08-17 15:28:53', 2, '2022-08-01', 10000),
(3, '2022-08-17 18:48:10', 4, '2022-08-17', 10000);

-- --------------------------------------------------------

--
-- Структура таблицы `calc_common_param`
--

CREATE TABLE `calc_common_param` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `subscribe` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `value` float NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `calc_common_param`
--

INSERT INTO `calc_common_param` (`id`, `name`, `subscribe`, `value`, `date`) VALUES
(3, 'desired_profit', 'Желаемая прибыль (евро/час)', 40, '2022-08-17 09:37:24'),
(8, 'transport_cost', 'Затраты на транспорт', 2, '2022-08-11 11:09:29'),
(9, 'layout_price', 'Стоимость вёрстки (руб)', 500, '2022-08-11 11:10:15'),
(11, 'print_on_glue', 'Печать по клею (коэф.)', 0.11, '2022-08-11 11:11:26'),
(12, 'print_label_book', 'Печать этикетки-книжки (коэф.)', 2, '2022-08-11 11:11:55'),
(13, 'euro_exchange', 'курс евро в рублях (руб/евро)', 110, '2022-08-11 11:13:11'),
(14, 'euro_exchange_to_close', 'курс евро в рублях для закрытия (руб/евро)', 95, '2022-08-11 11:14:02'),
(16, 'stamping_time', 'Время настройки конгрев секции (час)', 0.1, '2022-08-11 11:16:37'),
(17, 'form_tolerance', 'Допуск формы (мм)', 18, '2022-08-11 11:17:11'),
(18, 'tax', 'Процент НДС (%)', 20, '2022-08-11 11:17:46'),
(19, 'form_change_time', 'Время на смену одной формы (мин)', 30, '2022-08-11 14:17:21'),
(20, 'desired_profit_min', 'Мин. желаемая прибыль (евро/час)', 33, '2022-08-11 14:20:03'),
(21, 'price_increase', 'Повышение цены (коэф)', 1.04, '2022-08-15 10:22:49');

-- --------------------------------------------------------

--
-- Структура таблицы `calc_common_param_archive`
--

CREATE TABLE `calc_common_param_archive` (
  `id` int NOT NULL,
  `calc_common_param_id` int NOT NULL,
  `value` float NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `calc_common_param_archive`
--

INSERT INTO `calc_common_param_archive` (`id`, `calc_common_param_id`, `value`, `date`) VALUES
(3, 3, 41, '2022-08-11 11:06:28');

-- --------------------------------------------------------

--
-- Структура таблицы `calc_mashine_param`
--

CREATE TABLE `calc_mashine_param` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `subscribe` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `calc_mashine_param`
--

INSERT INTO `calc_mashine_param` (`id`, `name`, `subscribe`) VALUES
(1, 'desired_profit', 'Желаемая прибыль (евро/час)'),
(4, 'design_layout_price', 'Стоимость дизайн макета (руб)'),
(5, 'form_price', 'Стоимость формы (евро/см2)'),
(8, 'scotch_price', 'Стоимость скотча (евро/см2)'),
(9, 'paper_cmyk_adjust', 'Бумага на настройку CMYK (м)'),
(10, 'paper_common_adjust', 'Бумага на настройку - общее (м)'),
(11, 'paper_varnish_adjust', 'Бумага на настройку ЛАК (м)'),
(12, 'paper_pantone_adjust', 'Бумага на настройку Pantone (м)'),
(13, 'roll_change_length', 'Длина смены ролика общее (м)'),
(14, 'lost_paint_compensation', 'Компенсация потери красок (кг)'),
(15, 'paper_roll_change', 'Бумага на смену ролика (м)'),
(16, 'varnish_usage', 'Кол-во лака на 1 кв.м (кг/м2)'),
(17, 'paint_usage', 'Кол-во краски на 1 кв.м (кг/м2)'),
(18, 'time_cmyk_adjust', 'Время CMYK настройка (ч)'),
(19, 'common_adjust', 'Общая настройка (ч)'),
(20, 'time_varnish_adjust', 'Время ЛАК настройка (ч)'),
(21, 'time_paint_selection', 'Время подбор краски (ч)'),
(22, 'time_pantone_adjust', 'Время Pantone настройка (ч)'),
(23, 'one_roll_change_time', 'Время на смену 1-го ролика (мин)'),
(24, 'print_speed', 'Скорость печати (м/мин)'),
(25, 'stencil_mesh_price', 'Стоимость трафаретной сетки 1 шт (руб)'),
(26, 'time_stencil_mesh_adjust', 'Время Трафарет настройка (ч)'),
(27, 'paper_paint_selection_adjust', 'Бумага на подбор краски под оригинал (м)'),
(29, 'stencil_paint_usage', 'Кол-во краски на трафарет (кг/м2)'),
(31, 'paint_selection_price', 'Стоимость подбора краски (руб)');

-- --------------------------------------------------------

--
-- Структура таблицы `calc_mashine_param_value`
--

CREATE TABLE `calc_mashine_param_value` (
  `id` int NOT NULL,
  `mashine_id` int NOT NULL,
  `calc_mashine_param_id` int NOT NULL,
  `value` float NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `calc_mashine_param_value`
--

INSERT INTO `calc_mashine_param_value` (`id`, `mashine_id`, `calc_mashine_param_id`, `value`, `date`) VALUES
(1, 1, 1, 41, '2022-08-11 15:16:56'),
(4, 1, 4, 2000, '2022-08-11 15:29:35'),
(6, 1, 8, 0.32, '2022-08-11 15:30:35'),
(7, 1, 9, 35, '2022-08-11 15:30:55'),
(8, 1, 10, 50, '2022-08-11 15:31:11'),
(10, 1, 12, 50, '2022-08-15 08:47:43'),
(11, 1, 13, 40, '2022-08-15 12:31:46'),
(12, 1, 5, 0.015, '2022-08-15 12:50:24'),
(14, 1, 11, 10, '2022-08-15 13:22:20'),
(15, 1, 14, 0.05, '2022-08-15 13:23:10'),
(16, 1, 16, 0.003, '2022-08-15 13:23:32'),
(17, 1, 17, 0.0007, '2022-08-15 13:23:49'),
(18, 1, 24, 35, '2022-08-15 13:24:13'),
(20, 1, 19, 0.3, '2022-08-16 08:24:51'),
(21, 1, 18, 0.1, '2022-08-16 08:25:28'),
(22, 1, 22, 0.5, '2022-08-16 08:25:59'),
(23, 1, 23, 10, '2022-08-16 08:26:51');

-- --------------------------------------------------------

--
-- Структура таблицы `calc_mashine_param_value_archive`
--

CREATE TABLE `calc_mashine_param_value_archive` (
  `id` int NOT NULL,
  `calc_mashine_param_value_id` int NOT NULL,
  `value` float NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `calc_mashine_param_value_archive`
--

INSERT INTO `calc_mashine_param_value_archive` (`id`, `calc_mashine_param_value_id`, `value`, `date`) VALUES
(1, 1, 30, '2022-08-11 15:16:56'),
(3, 1, 20, '2022-08-11 15:16:56'),
(5, 4, 500, '2022-08-11 15:29:35'),
(6, 11, 2000, '2022-08-15 12:31:46'),
(7, 12, 0.5, '2022-08-15 12:50:24');

-- --------------------------------------------------------

--
-- Структура таблицы `combination`
--

CREATE TABLE `combination` (
  `id` int NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `combination`
--

INSERT INTO `combination` (`id`, `name`) VALUES
(1, NULL),
(2, NULL),
(3, NULL),
(4, NULL),
(5, NULL),
(6, NULL),
(7, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `combination_form`
--

CREATE TABLE `combination_form` (
  `id` int NOT NULL,
  `combination_id` int NOT NULL,
  `label_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `combination_form`
--

INSERT INTO `combination_form` (`id`, `combination_id`, `label_id`) VALUES
(6, 4, 7),
(7, 4, 9),
(14, 7, 11),
(15, 7, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `combination_order`
--

CREATE TABLE `combination_order` (
  `id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `combination_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `combination_order`
--

INSERT INTO `combination_order` (`id`, `order_id`, `combination_id`) VALUES
(17, 4, 11),
(18, 3, 11);

-- --------------------------------------------------------

--
-- Структура таблицы `combination_print_order`
--

CREATE TABLE `combination_print_order` (
  `id` int NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `combination_print_order`
--

INSERT INTO `combination_print_order` (`id`, `name`) VALUES
(1, NULL),
(2, NULL),
(3, NULL),
(4, NULL),
(5, NULL),
(6, NULL),
(7, NULL),
(8, NULL),
(9, NULL),
(10, NULL),
(11, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `customer`
--

CREATE TABLE `customer` (
  `id` int NOT NULL,
  `date_of_create` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_of_agreement` datetime DEFAULT NULL,
  `status_id` int NOT NULL DEFAULT '1',
  `name` varchar(100) NOT NULL,
  `manager_login` varchar(50) NOT NULL,
  `subject_id` int DEFAULT NULL,
  `region_id` int DEFAULT NULL,
  `town_id` int DEFAULT NULL,
  `street_id` int DEFAULT NULL,
  `house` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `number` varchar(50) DEFAULT NULL,
  `comment` text,
  `time_to_delivery_from` time DEFAULT NULL,
  `time_to_delivery_to` time DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `customer`
--

INSERT INTO `customer` (`id`, `date_of_create`, `date_of_agreement`, `status_id`, `name`, `manager_login`, `subject_id`, `region_id`, `town_id`, `street_id`, `house`, `email`, `number`, `comment`, `time_to_delivery_from`, `time_to_delivery_to`, `contact`) VALUES
(1, '2022-06-01 08:30:34', NULL, 1, 'Изыскатель', 'Jura', 1, 1, 1, 1, 'д. 1', NULL, NULL, NULL, NULL, NULL, NULL),
(2, '2022-06-01 08:31:02', '2022-06-01 00:00:00', 1, 'Изыскатель ТПФ', 'Jura', 1, 1, 1, 1, 'д 101', 'cheese@mail.ru', '89196948604', '', '08:30:00', '08:30:00', 'Рамиль Мишарин'),
(3, '2022-06-01 08:31:17', NULL, 1, 'Мясокомбинат', 'Jura', 1, 2, 2, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '2022-06-01 08:31:25', NULL, 1, 'Пластмасскомбинат', 'Hamida', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '2022-06-01 08:31:31', NULL, 1, 'Азбука сыра', 'Jura', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '2022-06-01 08:31:35', NULL, 1, 'Онест ООО', 'Hamida', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '2022-06-01 08:31:38', NULL, 1, 'Мясокомбинат', 'Jura', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '2022-06-20 19:46:11', '2022-06-29 00:00:00', 1, 'Сырокомбинат', 'Jura', 1, 1, 1, 1, '101', 'cheese@mail.ru', '89196948604', 'teset', '09:30:00', '09:30:00', NULL),
(9, '2022-08-09 19:07:07', '2022-08-01 00:00:00', 1, 'ООО \"Технолайн\"', 'Jura', 1, 1, 1, 5, 'д 139', 'cheese@mail.ru', '89196948604', 'ноу коммент', '16:00:00', '19:00:00', 'Иванов Иван Иванович');

-- --------------------------------------------------------

--
-- Структура таблицы `customer_status`
--

CREATE TABLE `customer_status` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `customer_status`
--

INSERT INTO `customer_status` (`id`, `name`) VALUES
(1, 'Активный'),
(2, 'Потенциальный'),
(3, 'Архивный'),
(4, 'Хлам');

-- --------------------------------------------------------

--
-- Структура таблицы `enterprise_cost`
--

CREATE TABLE `enterprise_cost` (
  `id` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `login` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `service_id` int NOT NULL,
  `cost` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `enterprise_cost`
--

INSERT INTO `enterprise_cost` (`id`, `date`, `login`, `service_id`, `cost`) VALUES
(1, '2022-08-17 13:49:48', '', 7, 1000),
(2, '2022-08-17 13:51:29', 'Alex', 2, 1500);

-- --------------------------------------------------------

--
-- Структура таблицы `enterprise_cost_service`
--

CREATE TABLE `enterprise_cost_service` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `enterprise_cost_service`
--

INSERT INTO `enterprise_cost_service` (`id`, `name`) VALUES
(1, 'Новый штанец'),
(2, 'Перезаказ штанца'),
(3, 'Изготовление форм'),
(4, 'Дизайн этикетки'),
(5, 'Премия'),
(6, 'З/п'),
(7, 'Аренда'),
(8, 'Налог'),
(9, 'Командировка'),
(10, 'Прочее');

-- --------------------------------------------------------

--
-- Структура таблицы `envelope`
--

CREATE TABLE `envelope` (
  `id` int NOT NULL,
  `rack` int DEFAULT NULL,
  `shelf` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `envelope`
--

INSERT INTO `envelope` (`id`, `rack`, `shelf`) VALUES
(3, 1, 1),
(4, 3, 3),
(5, 2, 5),
(6, 2, 5),
(7, 2, 5),
(8, 1, 1),
(9, 1, 3),
(10, 1, 1),
(11, 3, 3),
(12, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `finished_products_warehouse`
--

CREATE TABLE `finished_products_warehouse` (
  `id` int NOT NULL,
  `date_of_create` datetime DEFAULT CURRENT_TIMESTAMP,
  `order_id` int DEFAULT NULL,
  `previous_order_id` int DEFAULT NULL,
  `label_id` int DEFAULT NULL,
  `label_in_roll` int NOT NULL,
  `roll_count` int NOT NULL,
  `packed_roll_count` int DEFAULT '0',
  `packed_box_count` int DEFAULT '0',
  `packed_bale_count` int DEFAULT '0',
  `sended_roll_count` int DEFAULT '0',
  `sended_box_count` int DEFAULT '0',
  `sended_bale_count` int DEFAULT '0',
  `defect_roll_count` int DEFAULT '0',
  `defect_note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `finished_products_warehouse`
--

INSERT INTO `finished_products_warehouse` (`id`, `date_of_create`, `order_id`, `previous_order_id`, `label_id`, `label_in_roll`, `roll_count`, `packed_roll_count`, `packed_box_count`, `packed_bale_count`, `sended_roll_count`, `sended_box_count`, `sended_bale_count`, `defect_roll_count`, `defect_note`) VALUES
(6, '2022-06-28 10:49:56', 31, NULL, 5, 1000, 70, 70, 5, 1, 70, 5, 1, NULL, NULL),
(7, '2022-06-28 10:49:56', 31, NULL, 5, 500, 0, 0, 1, 0, 0, 1, 0, NULL, NULL),
(8, '2022-06-28 10:49:56', 1, NULL, 1, 1000, 10, 10, 1, 0, 10, 1, 0, 0, ''),
(9, '2022-06-28 10:49:56', 3, NULL, 7, 10000, 9, 9, 1, 0, 9, 1, 0, 0, ''),
(10, '2022-06-28 10:49:56', 3, NULL, 7, 5000, 0, 0, 1, 0, 0, 1, 0, NULL, NULL),
(11, '2022-06-28 10:49:56', 4, NULL, 9, 10000, 10, 10, 2, 0, 10, 2, 0, 0, ''),
(16, '2022-06-28 10:49:56', NULL, 31, 5, 1000, 15, 0, 0, 0, 0, 0, 0, 0, NULL),
(17, '2022-06-28 10:49:56', NULL, 31, 5, 500, 3, 0, 0, 0, 0, 0, 0, 0, NULL),
(18, '2022-06-28 10:49:56', NULL, 3, 7, 1000, 10, 0, 0, 0, 0, 0, 0, 0, NULL),
(19, '2022-06-28 12:24:14', NULL, 2, 1, 1000, 2, 0, 0, 0, 0, 0, 0, 0, NULL),
(20, '2022-07-08 10:27:18', 17, NULL, 4, 5000, 110, 0, 0, 0, 0, 0, 0, 0, NULL),
(21, '2022-08-10 10:30:42', 35, NULL, 39, 5000, 35, 35, 3, 0, 35, 3, 0, NULL, NULL),
(22, '2022-08-10 10:31:09', 35, NULL, 39, 2500, 5, 5, 1, 0, 5, 1, 0, NULL, NULL),
(23, '2022-08-10 10:51:22', NULL, 35, 39, 5000, 5, 0, 0, 0, 0, 0, 0, 5, 'Не попадание в цвет'),
(24, '2022-08-10 10:51:22', NULL, 35, 39, 2500, 5, 0, 0, 0, 0, 0, 0, 5, 'Не попадание в цвет'),
(25, '2022-08-10 11:09:06', NULL, 31, 5, 1000, 10, 0, 0, 0, 0, 0, 0, 10, 'Не попадание в цвет'),
(26, '2022-08-10 11:09:06', NULL, 31, 5, 500, 2, 0, 0, 0, 0, 0, 0, 2, 'ошщолл'),
(27, '2022-08-10 11:09:06', NULL, 3, 7, 5000, 2, 0, 0, 0, 0, 0, 0, 2, 'Ролики повреждены');

-- --------------------------------------------------------

--
-- Структура таблицы `foil`
--

CREATE TABLE `foil` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `foil`
--

INSERT INTO `foil` (`id`, `name`) VALUES
(1, 'Без фольги'),
(2, 'Gold фольга'),
(3, 'Silver фольга'),
(4, 'Holographic фольга');

-- --------------------------------------------------------

--
-- Структура таблицы `form`
--

CREATE TABLE `form` (
  `id` int NOT NULL,
  `label_id` int DEFAULT NULL,
  `width` int DEFAULT NULL,
  `height` int DEFAULT NULL,
  `lpi` int DEFAULT NULL,
  `dpi` int DEFAULT NULL,
  `pantone_id` int DEFAULT NULL,
  `photo_output_id` int DEFAULT NULL,
  `foil_form` int NOT NULL DEFAULT '0',
  `varnish_form` int NOT NULL DEFAULT '0',
  `stencil_form` int NOT NULL DEFAULT '0',
  `combination_id` int DEFAULT NULL,
  `envelope_id` int DEFAULT NULL,
  `polymer_id` int DEFAULT NULL,
  `ready` int DEFAULT NULL,
  `form_defect_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `form`
--

INSERT INTO `form` (`id`, `label_id`, `width`, `height`, `lpi`, `dpi`, `pantone_id`, `photo_output_id`, `foil_form`, `varnish_form`, `stencil_form`, `combination_id`, `envelope_id`, `polymer_id`, `ready`, `form_defect_id`) VALUES
(53, NULL, 150, 150, 154, 5080, 1, 2, 0, 0, 0, 4, 10, 1, 1, NULL),
(54, NULL, 150, 150, 154, 5080, 2, 2, 0, 0, 0, 4, 10, 1, 1, NULL),
(55, NULL, 150, 150, 154, 5080, 3, 2, 0, 0, 0, 4, 10, 1, 1, NULL),
(56, NULL, 150, 150, 154, 5080, 4, 2, 0, 0, 0, 4, 10, 1, 1, NULL),
(57, NULL, 150, 150, 154, 5080, NULL, 2, 0, 0, 1, 4, 10, 1, 1, NULL),
(58, NULL, 150, 150, 154, 5080, NULL, 2, 1, 0, 0, 4, 10, 1, 1, NULL),
(59, NULL, 150, 150, 154, 5080, NULL, 2, 0, 1, 0, 4, 10, 1, 1, NULL),
(60, 1, 150, 150, 154, 2540, 1, 2, 0, 0, 0, NULL, 11, 1, 1, NULL),
(61, 1, 150, 150, 154, 2540, 3, 2, 0, 0, 0, NULL, 11, 1, 1, NULL),
(62, 1, 150, 150, 154, 2540, NULL, 2, 0, 1, 0, NULL, 11, 1, 1, NULL),
(71, NULL, 143, 145, 154, 5080, 1, 2, 0, 0, 0, 7, 3, 1, 1, NULL),
(72, NULL, 143, 145, 154, 5080, 4, 2, 0, 0, 0, 7, 3, 1, 1, NULL),
(73, NULL, 143, 145, 154, 5080, NULL, 2, 0, 0, 1, 7, 3, 1, 1, NULL),
(74, NULL, 143, 145, 154, 5080, NULL, 2, 1, 0, 0, 7, 3, 1, 1, NULL),
(75, NULL, 143, 145, 154, 5080, NULL, 2, 0, 1, 0, 7, 3, 1, 1, NULL),
(78, 5, 150, 150, 154, 2400, 1, 1, 0, 0, 0, NULL, 3, 1, 1, NULL),
(79, 5, 150, 150, 154, 2400, NULL, 1, 2, 0, 0, NULL, 3, 1, 1, NULL),
(80, 5, 150, 150, 154, 2400, NULL, 1, 0, 2, 0, NULL, 3, 1, 1, NULL),
(86, 15, 150, 150, 154, 2400, NULL, 1, 1, 0, 0, NULL, NULL, NULL, NULL, NULL),
(99, 15, 150, 150, 154, 2540, 1, 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL),
(100, 6, 300, 300, 154, 2400, 2, 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL),
(101, 6, 300, 300, 154, 2400, 2, 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL),
(102, 6, 300, 300, 154, 2540, NULL, 2, 0, 1, 0, NULL, NULL, NULL, NULL, NULL),
(103, 39, 300, 250, 154, 2400, 1, 1, 0, 0, 0, NULL, 12, 2, 1, NULL),
(104, 39, 150, 300, 154, 2400, 2, 1, 0, 0, 0, NULL, 12, 2, 1, NULL),
(105, 39, 150, 250, 154, 2400, 3, 1, 0, 0, 0, NULL, 12, 2, 1, NULL),
(106, 39, 300, 300, 154, 2400, 4, 1, 0, 0, 0, NULL, 12, 2, 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `form_defect`
--

CREATE TABLE `form_defect` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `form_defect`
--

INSERT INTO `form_defect` (`id`, `name`) VALUES
(1, 'Износ формы'),
(2, 'Грамматическая ошибка'),
(3, 'Цвет'),
(4, 'Отсутсвует форма'),
(5, 'Не совмещение'),
(6, 'Не правильный выход'),
(7, 'Не попадает в штанец'),
(8, 'Нет части информации'),
(9, 'Дисторция'),
(10, 'Отсутствие или несоответствие элементов дизайна'),
(11, 'Сильный муар');

-- --------------------------------------------------------

--
-- Структура таблицы `form_order_history`
--

CREATE TABLE `form_order_history` (
  `id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `combination_print_order_id` int DEFAULT NULL,
  `form_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `form_order_history`
--

INSERT INTO `form_order_history` (`id`, `order_id`, `combination_print_order_id`, `form_id`) VALUES
(1, NULL, 11, 53),
(2, NULL, 11, 54),
(3, NULL, 11, 55),
(4, NULL, 11, 56),
(5, NULL, 11, 57),
(6, NULL, 11, 58),
(7, NULL, 11, 59),
(8, 1, NULL, 60),
(9, 1, NULL, 61),
(10, 1, NULL, 62),
(11, 31, NULL, 78),
(12, 31, NULL, 79),
(13, 31, NULL, 80),
(14, 35, NULL, 103),
(15, 35, NULL, 104),
(16, 35, NULL, 105),
(17, 35, NULL, 106);

-- --------------------------------------------------------

--
-- Структура таблицы `knife_kind`
--

CREATE TABLE `knife_kind` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `knife_kind`
--

INSERT INTO `knife_kind` (`id`, `name`) VALUES
(1, 'Universal'),
(2, '3L (Laser Long Life)'),
(3, 'Black Top 3 in 1');

-- --------------------------------------------------------

--
-- Структура таблицы `label`
--

CREATE TABLE `label` (
  `id` int NOT NULL,
  `parent_label` int DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `designer_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `manager_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `prepress_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `date_of_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_of_design` datetime DEFAULT NULL,
  `date_of_prepress` datetime DEFAULT NULL,
  `customer_id` int DEFAULT NULL,
  `status_id` int NOT NULL DEFAULT '1',
  `pants_id` int DEFAULT NULL,
  `foil_id` int NOT NULL DEFAULT '1',
  `designer_login` varchar(50) DEFAULT NULL,
  `prepress_login` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `varnish_id` int NOT NULL DEFAULT '0',
  `laminate` int NOT NULL DEFAULT '0',
  `print_on_glue` int NOT NULL DEFAULT '0',
  `variable` int NOT NULL DEFAULT '0',
  `variable_paint_count` float DEFAULT NULL,
  `stencil` int NOT NULL DEFAULT '0',
  `image` varchar(50) DEFAULT NULL,
  `image_crop` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `output_label_id` int NOT NULL DEFAULT '1',
  `background_id` int DEFAULT '1',
  `orientation` int NOT NULL DEFAULT '0',
  `image_extended` varchar(100) DEFAULT NULL,
  `design_file` varchar(100) DEFAULT NULL,
  `prepress_design_file` varchar(100) DEFAULT NULL,
  `color_count` int DEFAULT '0',
  `laboratory_login` varchar(50) DEFAULT NULL,
  `date_of_flexformready` datetime DEFAULT NULL,
  `laboratory_note` text,
  `takeoff_flash` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `label`
--

INSERT INTO `label` (`id`, `parent_label`, `name`, `designer_note`, `manager_note`, `prepress_note`, `date_of_create`, `date_of_design`, `date_of_prepress`, `customer_id`, `status_id`, `pants_id`, `foil_id`, `designer_login`, `prepress_login`, `varnish_id`, `laminate`, `print_on_glue`, `variable`, `variable_paint_count`, `stencil`, `image`, `image_crop`, `output_label_id`, `background_id`, `orientation`, `image_extended`, `design_file`, `prepress_design_file`, `color_count`, `laboratory_login`, `date_of_flexformready`, `laboratory_note`, `takeoff_flash`) VALUES
(1, NULL, 'Этикетка заказа номер 1', 'примечание вот такое на', 'badge badge-successbadge badge-success', 'примечание вот такое напримечание вот такое напримечание вот такое напримечание вот такое на', '2022-05-18 14:55:03', '2022-06-06 16:12:15', '2022-06-06 16:13:56', 1, 10, 1, 1, 'Natasha', 'Alex', 1, 1, 0, 1, NULL, 0, 'label/1.jpg', 'label/1_crop.jpg', 2, 1, 0, 'label/1_extended.jpg', 'label/1_design.cdr', 'label/1.cdr', 0, NULL, '2022-06-17 10:28:03', '', 0),
(2, NULL, 'Этикетка заказа', 'по ручьям', '', 'text', '2022-05-18 14:55:03', NULL, NULL, 2, 7, 1, 1, 'Masha', 'Alex', 2, 1, 0, 1, NULL, 1, 'label/2.jpg', 'label/2_crop.jpg', 2, 1, 0, 'label/2_extended.jpg', 'label/2_design.cdr', 'label/2.csv', 0, NULL, NULL, NULL, 0),
(3, NULL, 'Ведро 12л', 'примечание вот такое на', '', '', '2022-05-18 14:55:03', NULL, NULL, 3, 1, 3, 1, 'Natasha', '', 0, 1, 0, 0, NULL, 0, '/web/label/3.jpg', NULL, 1, 1, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0),
(4, NULL, 'Сосиски говяжие', 'примечание вот такое', '', 'text', '2022-05-18 14:55:03', '2022-06-02 14:50:54', '2022-06-06 11:43:36', 4, 7, 4, 1, 'Masha', 'Alex', 0, 1, 0, 0, NULL, 0, 'label/4.jpg', 'label/4_crop.jpg', 3, 1, 0, NULL, 'label/4_design.cdr', 'label/4.csv', 0, NULL, NULL, NULL, 0),
(5, NULL, 'Стикеры', 'намана делай намана будет', '', '', '2022-05-23 14:42:01', '2022-06-09 15:50:47', '2022-06-10 09:46:47', 1, 10, 2, 2, 'Masha', 'Alex', 2, 1, 0, 1, 0.0005, 0, 'label/5.jpg', 'label/5_crop.jpg', 1, 1, 0, 'label/5_extended.jpg', 'label/5_design.cdr', 'label/5_prepress.zip', 0, 'Ivan', '2022-06-10 10:14:55', 'перевывод сделан', 0),
(6, NULL, 'Стикеры ДМ мин 1.5', 'намана', '', '', '2022-05-23 14:42:32', '2022-06-09 15:51:17', NULL, 1, 6, 2, 1, 'Masha', 'Alex', 0, 1, 0, 1, NULL, 0, 'label/6.jpg', 'label/6_crop.jpg', 2, 1, 0, 'label/6_extended.jpg', 'label/6_design.cdr', NULL, 0, NULL, NULL, '', 0),
(7, NULL, 'Стикеры Азбука Сыра мин 1.5', '', '', 'text', '2022-05-23 14:42:32', '2022-06-06 13:13:11', '2022-06-06 15:21:12', 1, 10, 2, 2, 'Masha', 'Alex', 1, 1, 0, 1, NULL, 1, NULL, NULL, 1, 1, 0, NULL, NULL, 'label/7.csv', 0, NULL, '2022-06-17 10:25:48', 'новые формы', 0),
(9, NULL, 'Казахстан Таз 15 л.  ПИЩЕВОЙ', 'text', 'Jura created fuck mate', '', '2022-05-26 14:28:11', '2022-06-06 12:35:52', NULL, 1, 10, 2, 1, 'Masha', 'Alex', 0, 0, 0, 0, NULL, 0, 'label/9.jpg', 'label/9_crop.jpg', 1, 1, 0, 'label/9_extended.jpg', 'label/9_design.jpg', NULL, 0, NULL, '2022-06-17 10:25:48', 'новые формы', 0),
(10, NULL, 'Мясо пресованное', '', 'Это я хеллоу', '', '2022-05-26 14:34:29', '2022-06-07 08:47:53', '2022-06-07 11:06:45', 3, 10, 4, 2, 'Masha', 'Alex', 2, 0, 1, 0, NULL, 0, 'label/10.jpg', 'label/10_crop.jpg', 1, 1, 1, 'label/10_extended.jpg', 'label/10_design.cdr', 'label/10_prepress.zip', 0, 'Ivan', '2022-06-09 09:09:51', 'переделаны формы', 0),
(11, NULL, 'Мясо пресованное 0.1кг', '', 'еуыуеыуеыуавыы', 'совмещение', '2022-05-27 08:33:55', '2022-06-07 08:48:29', '2022-06-07 11:06:45', 4, 10, 1, 1, 'Masha', 'Alex', 2, 0, 1, 1, NULL, 1, 'label/11.jpg', 'label/11_crop.jpg', 1, 2, 0, 'label/11_extended.jpg', 'label/11_design.cdr', 'label/10_prepress.zip', 0, 'Ivan', '2022-06-09 09:09:51', 'переделаны формы', 0),
(12, NULL, 'Мясо пресованное 0.1кг', '', '', '', '2022-05-27 08:35:51', '2022-06-07 09:25:42', '2022-06-07 11:00:29', 2, 6, 2, 1, 'Masha', 'Alex', 1, 0, 1, 0, NULL, 0, 'label/12.jpg', 'label/12_crop.jpg', 2, 4, 1, 'label/12_extended.jpg', 'label/12_design.jpg', 'label/11_prepress.csv', 0, NULL, NULL, NULL, 0),
(13, NULL, 'Казахстан Таз 15 л.  ПИЩЕВОЙ', '', '', '', '2022-05-27 11:07:34', NULL, NULL, 4, 2, 2, 1, 'Masha', NULL, 1, 0, 0, 0, NULL, 0, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0),
(14, NULL, 'Мясо пресованное 0.1кг', '', '', '', '2022-05-27 11:10:01', NULL, NULL, 6, 2, 2, 1, 'Masha', NULL, 0, 0, 0, 0, NULL, 0, NULL, NULL, 3, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0),
(15, NULL, 'Пустышка 30*25', '', '', 'note', '2022-05-27 15:53:07', NULL, '2022-06-19 22:25:41', 4, 6, 2, 1, NULL, 'Alex', 0, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, 1, NULL, NULL, 'label/15_prepress.zip', 0, NULL, NULL, '', 0),
(16, 15, 'Пустышка 30*50', NULL, '', NULL, '2022-05-27 15:55:00', NULL, NULL, 2, 11, 3, 1, NULL, NULL, 0, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0),
(17, 13, 'Казахстан Таз 15 л.  ПИЩЕВОЙ', NULL, '', NULL, '2022-05-30 19:42:00', NULL, NULL, 4, 1, 2, 1, NULL, NULL, 1, 0, 0, 0, NULL, 0, NULL, NULL, 2, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0),
(18, NULL, 'Мясо пресованное 0.1кг', NULL, '', NULL, '2022-05-30 19:45:27', NULL, NULL, 2, 1, 2, 1, NULL, NULL, 1, 0, 1, 0, NULL, 0, NULL, NULL, 2, 4, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0),
(19, 18, 'Мясо пресованное 0.1кг', NULL, '', NULL, '2022-05-30 19:51:36', NULL, NULL, 2, 1, 2, 1, NULL, NULL, 1, 0, 1, 0, NULL, 0, NULL, NULL, 2, 4, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0),
(20, NULL, 'Казахстан Таз 15 л.  ПИЩЕВОЙ', NULL, '', NULL, '2022-05-30 20:48:16', NULL, NULL, 2, 1, 2, 1, NULL, NULL, 1, 1, 0, 0, NULL, 0, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0),
(21, NULL, 'Пустышка 30*25', NULL, '', NULL, '2022-05-30 20:49:31', NULL, NULL, 2, 11, 4, 1, NULL, NULL, 0, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0),
(22, NULL, 'Пустышка 30*25', NULL, '', NULL, '2022-05-31 10:11:30', NULL, NULL, 6, 11, 2, 1, NULL, NULL, 0, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0),
(23, NULL, 'Казахстан Таз 15 л.  ПИЩЕВОЙ', '', 'gbhjghj', '', '2022-06-01 08:46:31', NULL, NULL, 2, 2, 2, 1, 'Masha', NULL, 1, 0, 1, 1, NULL, 0, NULL, NULL, 1, 1, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0),
(24, NULL, 'Мясо пресованное 0.1кг', NULL, '', NULL, '2022-06-01 08:49:25', NULL, NULL, 4, 1, 1, 1, NULL, NULL, 0, 0, 0, 0, NULL, 0, NULL, NULL, 4, 3, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0),
(25, NULL, 'Мясо пресованное 0.1кг', NULL, '', NULL, '2022-06-01 08:52:29', NULL, NULL, 1, 1, 2, 1, NULL, NULL, 1, 0, 0, 0, NULL, 1, NULL, NULL, 2, 2, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0),
(26, NULL, 'test', NULL, 'testsetr', NULL, '2022-06-01 14:05:10', NULL, NULL, 2, 1, 2, 1, NULL, NULL, 0, 1, 0, 0, NULL, 0, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0),
(27, NULL, 'test', '', '', NULL, '2022-06-03 16:57:11', NULL, NULL, 2, 1, 1, 1, NULL, NULL, 2, 0, 0, 0, NULL, 1, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0),
(28, NULL, 'Колбаса', '', 'Дизайн отправлен на почту', NULL, '2022-06-09 21:00:07', NULL, NULL, 7, 1, 2, 1, NULL, NULL, 2, 0, 1, 0, NULL, 1, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, 4, NULL, NULL, NULL, 0),
(29, NULL, 'Колбаса примая', '', '', NULL, '2022-06-09 21:04:40', NULL, NULL, 7, 1, 3, 1, NULL, NULL, 0, 0, 0, 0, NULL, 1, NULL, NULL, 2, 2, 0, NULL, NULL, NULL, 5, NULL, NULL, NULL, 0),
(30, NULL, 'Водка Ханская', '', '', NULL, '2022-06-09 21:07:37', NULL, NULL, 6, 1, 4, 1, NULL, NULL, 3, 1, 1, 0, NULL, 0, NULL, NULL, 1, 3, 1, NULL, NULL, NULL, 2, NULL, NULL, NULL, 0),
(31, NULL, 'Мясо пресованное 0.1кг', '', '', NULL, '2022-06-10 08:05:03', NULL, NULL, 7, 1, 2, 1, NULL, NULL, 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, 5, NULL, NULL, NULL, 0),
(32, 1, 'Этикетка заказа номер 1 подобная', 'примечание вот такое на', 'badge badge-successbadge badge-success', 'примечание вот такое напримечание вот такое напримечание вот такое напримечание вот такое на', '2022-05-18 14:55:03', '2022-06-06 16:12:15', '2022-06-06 16:13:56', 1, 1, 1, 1, 'Natasha', 'Alex', 1, 1, 0, 1, NULL, 1, 'label/1.jpg', 'label/1_crop.jpg', 1, 1, 1, 'label/1_extended.jpg', 'label/1_design.cdr', 'label/1.cdr', 5, NULL, NULL, NULL, 0),
(34, 25, 'Мясо пресованное 0.1кг', '', '', NULL, '2022-06-10 15:39:03', NULL, NULL, 1, 1, 2, 1, NULL, NULL, 1, 0, 0, 0, NULL, 1, NULL, NULL, 2, 2, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0),
(35, 9, 'Казахстан Таз 15 л.  ПИЩЕВОЙ', 'text', 'Jura created fuck mate', '', '2022-06-14 21:23:36', '2022-06-06 12:35:52', NULL, 1, 1, 2, 1, 'Masha', 'Alex', 0, 0, 0, 0, NULL, 0, 'label/9.jpg', 'label/9_crop.jpg', 1, 1, 0, 'label/9_extended.jpg', 'label/9_design.jpg', NULL, 0, NULL, NULL, NULL, 0),
(36, 35, 'Казахстан Таз 15 л.  ПИЩЕВОЙ', 'text', 'Jura created fuck mate', '', '2022-06-17 09:01:38', '2022-06-06 12:35:52', NULL, 1, 1, 2, 1, 'Masha', 'Alex', 0, 0, 0, 0, NULL, 0, 'label/9.jpg', 'label/9_crop.jpg', 1, 1, 0, 'label/9_extended.jpg', 'label/9_design.jpg', NULL, 0, NULL, NULL, NULL, 0),
(37, NULL, 'пустышка 80*120', '', '', NULL, '2022-06-17 09:03:44', NULL, NULL, 1, 11, 1, 1, NULL, NULL, 0, 0, 0, 0, NULL, 0, NULL, NULL, 1, 1, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0),
(38, NULL, 'Колбаса', '', '', NULL, '2022-06-17 09:09:00', NULL, NULL, 1, 1, 2, 1, NULL, NULL, 1, 0, 0, 1, NULL, 0, NULL, NULL, 1, 2, 1, NULL, NULL, NULL, 4, NULL, NULL, NULL, 0),
(39, NULL, 'Smart ENGINE 1800 Вт (ромбическая)', '', 'Создать дизайн-макет на основе исходника в CMYK. Без тиснения. Имитация золота и серебра. Материал - белый полипропилен. Лак сплошной глянцевый.', '', '2022-08-09 19:11:10', '2022-08-09 19:23:30', '2022-08-09 19:58:16', 9, 10, 3, 1, 'Masha', 'Alex', 2, 0, 0, 0, NULL, 0, 'label/39.jpg', 'label/39_crop.jpg', 4, 1, 2, NULL, 'label/39_design.cdr', 'label/39_prepress.zip', 4, 'Ivan', '2022-08-09 20:00:08', '', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `label_status`
--

CREATE TABLE `label_status` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `label_status`
--

INSERT INTO `label_status` (`id`, `name`) VALUES
(1, 'Новая этикетка'),
(2, 'В дизайне'),
(3, 'Дизайн готов'),
(4, 'Дизайн утвержден'),
(5, 'Ожидает перевывода'),
(6, 'Prepress'),
(7, 'Prepress готов'),
(8, 'Перевывод готов'),
(9, 'Изготовление форм'),
(10, 'Готов к печати'),
(11, 'Prepress+Перевывод готов'),
(12, 'В архиве');

-- --------------------------------------------------------

--
-- Структура таблицы `mashine`
--

CREATE TABLE `mashine` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `mashine_type` int NOT NULL DEFAULT '0' COMMENT '0-печатный станок\r\n1-перемоточная машина\r\n2-станок переменной печати'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `mashine`
--

INSERT INTO `mashine` (`id`, `name`, `mashine_type`) VALUES
(1, 'Arsoma', 0),
(2, 'Gallus', 0),
(3, 'Arsoma2', 0),
(4, 'Arsoma3', 0),
(5, 'Gallus_340', 0),
(6, 'Jetsci', 2),
(7, 'Rotoflex', 1),
(8, 'Grafatronic', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `mashine_pantone`
--

CREATE TABLE `mashine_pantone` (
  `id` int NOT NULL,
  `pantone_id` int NOT NULL,
  `mashine_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `mashine_pantone`
--

INSERT INTO `mashine_pantone` (`id`, `pantone_id`, `mashine_id`) VALUES
(17, 8, 1),
(18, 8, 2),
(19, 9, 1),
(20, 11, 6),
(21, 12, 5),
(22, 15, 3),
(23, 16, 4),
(24, 16, 5),
(25, 16, 6),
(26, 1, 1),
(27, 1, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `mashine_pants`
--

CREATE TABLE `mashine_pants` (
  `id` int NOT NULL,
  `mashine_id` int NOT NULL,
  `pants_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `mashine_pants`
--

INSERT INTO `mashine_pants` (`id`, `mashine_id`, `pants_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 1),
(5, 5, 1),
(6, 4, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `material`
--

CREATE TABLE `material` (
  `id` int NOT NULL,
  `date_of_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `material_group_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `material_provider_id` int DEFAULT NULL,
  `short_name` varchar(100) DEFAULT NULL,
  `status` int DEFAULT '1' COMMENT 'status 0 means not used, status 1 - active',
  `price_rub` float DEFAULT NULL COMMENT 'Цена в рублях за м2',
  `price_rub_discount` float DEFAULT NULL COMMENT 'Цена в рублях за м2 со скидкой',
  `price_euro` float DEFAULT NULL COMMENT 'Цена в евро за м2',
  `price_euro_discount` float DEFAULT NULL COMMENT 'Цена в евро за м2 со скидкой',
  `density` int DEFAULT NULL COMMENT 'Плотность г/м2',
  `prompt` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'Подсказка',
  `material_id_from_provider` int DEFAULT NULL COMMENT 'ID от поставщика бумаги'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `material`
--

INSERT INTO `material` (`id`, `date_of_create`, `material_group_id`, `name`, `material_provider_id`, `short_name`, `status`, `price_rub`, `price_rub_discount`, `price_euro`, `price_euro_discount`, `density`, `prompt`, `material_id_from_provider`) VALUES
(1, '2022-07-06 06:34:39', 1, 'MC FSC S2045M-BG40BR (MC PRIMECOAT S2045N)', 1, 'полуглянец/акриловый клей', 0, 47.6, 40.2, 0.69, 0.45, 120, '', 103),
(2, '2022-07-06 06:34:39', 1, 'MC PRIMECOAT S2000N-BG40BR ', 2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '2022-06-01 06:34:39', 6, 'Фольга серебро', 3, NULL, 1, NULL, NULL, 0.5, NULL, NULL, NULL, NULL),
(4, '2022-07-06 06:34:39', 2, 'Термобумага', 2, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '2022-07-08 05:36:31', 1, '(1) MC PRIMECOAT S2045N-BG40BR', 1, 'пг 2045', 1, 42.3, 41.8, 0.4, 0.35, 141, 'ПОЛУГЛЯНЕЦ , КАУЧУКОВЫЙ КЛЕЙ , 2045 .', 584),
(6, '2022-08-15 09:47:36', 8, 'Ламинация', 2, 'Ламинация', 1, NULL, NULL, 0.7, 0.5, NULL, '', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `material_group`
--

CREATE TABLE `material_group` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `material_group`
--

INSERT INTO `material_group` (`id`, `name`) VALUES
(1, 'Полуглянец'),
(2, 'Термобумага'),
(3, 'Метализированная'),
(4, 'Полипропилен белый'),
(5, 'Полиэтилен'),
(6, 'Фольга для тиснения'),
(7, 'Мономатериал'),
(8, 'Ламинат'),
(9, 'Полипропилен прозрачный');

-- --------------------------------------------------------

--
-- Структура таблицы `material_price_archive`
--

CREATE TABLE `material_price_archive` (
  `id` int NOT NULL,
  `material_id` int NOT NULL,
  `date_of_change` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'дата смены цены',
  `price_attribute` varchar(50) NOT NULL COMMENT 'аттрибут цены (евро в рублях и т.д)',
  `old_value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `material_price_archive`
--

INSERT INTO `material_price_archive` (`id`, `material_id`, `date_of_change`, `price_attribute`, `old_value`) VALUES
(5, 1, '2022-07-07 11:23:28', 'price_rub', 40.6),
(6, 1, '2022-07-07 11:24:45', 'price_rub', 45.6),
(7, 1, '2022-07-07 11:26:39', 'price_rub_discount', 40.6),
(8, 1, '2022-07-07 11:26:39', 'price_euro_discount', 0.43),
(9, 5, '2022-07-14 10:06:24', 'price_euro', 0.38),
(10, 6, '2022-08-15 13:21:26', 'price_euro', 0.6),
(11, 1, '2022-08-15 13:47:05', 'price_euro', 0.7);

-- --------------------------------------------------------

--
-- Структура таблицы `material_provider`
--

CREATE TABLE `material_provider` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `material_provider`
--

INSERT INTO `material_provider` (`id`, `name`) VALUES
(1, 'Fasson'),
(2, 'Frimpeks'),
(3, 'Raflatac');

-- --------------------------------------------------------

--
-- Структура таблицы `mixed_pantone`
--

CREATE TABLE `mixed_pantone` (
  `id` int NOT NULL,
  `pantone_id` int NOT NULL,
  `component_pantone_id` int DEFAULT NULL,
  `weight` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `mixed_pantone`
--

INSERT INTO `mixed_pantone` (`id`, `pantone_id`, `component_pantone_id`, `weight`) VALUES
(1, 8, 4, 100),
(2, 8, 1, 25),
(3, 8, 2, 30),
(4, 8, 5, 225),
(5, 8, 3, 30),
(6, 8, NULL, NULL),
(7, 8, NULL, NULL),
(8, 8, NULL, NULL),
(9, 10, 1, 10),
(10, 10, NULL, NULL),
(11, 10, NULL, NULL),
(12, 10, NULL, NULL),
(13, 10, NULL, NULL),
(14, 10, NULL, NULL),
(15, 10, NULL, NULL),
(16, 10, NULL, NULL),
(17, 13, NULL, NULL),
(18, 13, NULL, NULL),
(19, 13, NULL, NULL),
(20, 13, NULL, NULL),
(21, 13, NULL, NULL),
(22, 13, NULL, NULL),
(23, 13, NULL, NULL),
(24, 13, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` int NOT NULL,
  `date_of_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_id` int DEFAULT NULL,
  `label_id` int DEFAULT NULL,
  `date_of_sale` timestamp NULL DEFAULT NULL,
  `date_of_print_begin` timestamp NULL DEFAULT NULL,
  `date_of_print_end` timestamp NULL DEFAULT NULL,
  `date_of_variable_print_begin` datetime DEFAULT NULL,
  `date_of_variable_print_end` datetime DEFAULT NULL,
  `date_of_packing_begin` timestamp NULL DEFAULT NULL,
  `date_of_packing_end` timestamp NULL DEFAULT NULL,
  `date_of_rewind_begin` timestamp NULL DEFAULT NULL,
  `date_of_rewind_end` timestamp NULL DEFAULT NULL,
  `mashine_id` int DEFAULT NULL,
  `plan_circulation` int DEFAULT NULL,
  `actual_circulation` int DEFAULT NULL,
  `trial_circulation` int NOT NULL DEFAULT '0',
  `sending` int DEFAULT NULL,
  `material_id` int DEFAULT NULL,
  `printer_login` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `order_price` float DEFAULT NULL,
  `order_price_with_tax` float DEFAULT NULL,
  `delivery_price` float DEFAULT NULL,
  `pants_price` int DEFAULT NULL,
  `label_price` float DEFAULT NULL,
  `label_price_with_tax` float DEFAULT NULL,
  `rewinder_login` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `packer_login` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `rewinder_note` text,
  `printer_note` text,
  `manager_note` text,
  `tech_note` text,
  `sleeve_id` int DEFAULT NULL,
  `winding_id` int DEFAULT NULL,
  `diameter_roll` int DEFAULT NULL,
  `label_on_roll` int DEFAULT NULL,
  `cut_edge` int NOT NULL DEFAULT '0',
  `stretch` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `date_of_create`, `status_id`, `label_id`, `date_of_sale`, `date_of_print_begin`, `date_of_print_end`, `date_of_variable_print_begin`, `date_of_variable_print_end`, `date_of_packing_begin`, `date_of_packing_end`, `date_of_rewind_begin`, `date_of_rewind_end`, `mashine_id`, `plan_circulation`, `actual_circulation`, `trial_circulation`, `sending`, `material_id`, `printer_login`, `order_price`, `order_price_with_tax`, `delivery_price`, `pants_price`, `label_price`, `label_price_with_tax`, `rewinder_login`, `packer_login`, `rewinder_note`, `printer_note`, `manager_note`, `tech_note`, `sleeve_id`, `winding_id`, `diameter_roll`, `label_on_roll`, `cut_edge`, `stretch`) VALUES
(1, '2022-05-16 21:00:00', 8, 1, '2022-08-08 12:00:00', '2022-06-24 05:59:17', '2022-06-24 06:03:24', NULL, NULL, '2022-06-24 06:13:31', '2022-06-24 06:14:12', '2022-06-24 06:04:02', '2022-06-24 06:12:58', 1, 10000, 10000, 100, NULL, 2, 'Maksim', NULL, NULL, NULL, NULL, 0.78, 0.82, 'Ilnur', 'Albert', 'test', '', NULL, '', 1, 1, NULL, NULL, 0, 1),
(2, '2022-05-17 21:00:00', 1, 4, '2022-06-13 17:10:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 0),
(3, '2022-05-17 21:00:00', 8, 7, NULL, '2022-06-24 06:27:00', '2022-06-24 06:43:40', NULL, NULL, '2022-06-24 06:47:33', '2022-06-24 06:49:30', '2022-06-24 06:44:30', '2022-06-24 06:47:09', 3, 100000, 100000, 0, NULL, NULL, 'Maksim', NULL, NULL, NULL, NULL, 0.12, 0.15, 'Ilnur', 'Albert', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 0),
(4, '2022-05-17 21:00:00', 8, 9, NULL, '2022-06-24 06:27:00', '2022-06-24 06:43:40', NULL, NULL, '2022-06-24 06:47:53', '2022-06-24 06:48:33', '2022-06-24 06:44:30', '2022-06-24 06:46:35', 3, 100000, 100000, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1.1, 1.3, 'Ilnur', 'Albert', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 0),
(5, '2022-05-17 21:00:00', 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 0),
(6, '2022-05-18 09:36:24', NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 0),
(8, '2022-05-18 09:52:17', NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 0),
(10, '2022-05-18 09:53:02', NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 0),
(11, '2022-05-18 09:54:39', NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 0),
(12, '2022-05-18 09:56:22', NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 0),
(13, '2022-05-18 09:59:11', NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 0),
(14, '2022-05-18 10:00:08', 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 0),
(16, '2022-05-18 10:09:19', 1, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 0),
(17, '2022-05-18 10:10:08', 7, 4, '2022-05-31 10:35:45', '2022-07-01 07:23:17', '2022-07-02 07:23:17', NULL, NULL, '2022-07-08 07:27:34', NULL, '2022-07-03 07:23:17', '2022-07-04 07:23:17', 2, 560000, 560000, 0, 50000, 2, 'Maksim', NULL, NULL, NULL, NULL, 0.25, 0.28, 'Ilnur', 'Albert', NULL, NULL, NULL, NULL, 0, 0, 250, 5000, 1, 1),
(18, '2022-05-18 10:44:17', 1, 3, '2022-05-31 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 0),
(19, '2022-05-18 11:26:38', 1, 3, '2022-05-26 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100000, NULL, 0, NULL, 101, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 0),
(20, '2022-05-18 11:27:33', 1, 4, '2022-05-28 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100000, NULL, 0, NULL, 101, NULL, NULL, NULL, NULL, NULL, 0.12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0, 0),
(21, '2022-05-30 09:44:52', 1, 16, '2022-06-29 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 100000, NULL, 0, 100000, 1, NULL, 12000, 14400, NULL, NULL, 0.12, 0.144, NULL, NULL, '', NULL, NULL, NULL, 1, 3, 50, 1000, 0, 0),
(22, '2022-05-30 12:49:02', 1, 15, '2022-06-23 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 100000, NULL, 0, 100000, 1, NULL, 12000, 14400, NULL, NULL, 0.12, 0.144, NULL, NULL, '', NULL, NULL, NULL, 1, 1, 50, 1000, 0, 0),
(23, '2022-05-30 16:42:00', 1, 13, '2022-06-28 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, 100000, NULL, 0, 100000, 1, NULL, 12000, 14400, NULL, NULL, 0.12, 0.144, NULL, NULL, '', NULL, NULL, NULL, 1, 2, 50, 1000, 0, 0),
(24, '2022-05-30 16:45:27', 1, 18, '2022-06-28 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, 100000, NULL, 0, 100000, 1, NULL, 12000, 14400, NULL, NULL, 0.12, 0.144, NULL, NULL, '', NULL, NULL, NULL, 2, 1, 50, 1000, 0, 0),
(25, '2022-05-30 16:47:47', 1, 17, '2022-06-28 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, 100000, NULL, 0, 100000, 1, NULL, 12000, 14400, NULL, NULL, 0.12, 0.144, NULL, NULL, '', NULL, NULL, NULL, 3, 1, 50, 1000, 0, 0),
(26, '2022-05-30 16:49:55', 1, 18, '2022-06-28 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 100000, NULL, 1, 100000, 2, NULL, 12000, 14400, NULL, NULL, 0.12, 0.144, NULL, NULL, '', NULL, NULL, NULL, 2, 2, 50, 1000, 0, 0),
(27, '2022-05-30 16:51:36', 1, 19, '2022-06-07 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 100000, NULL, 0, 100000, 2, NULL, 12000, 14400, NULL, NULL, 0.12, 0.144, NULL, NULL, '', NULL, NULL, NULL, 2, 2, 50, 1000, 0, 1),
(28, '2022-05-31 07:11:30', 1, 22, '2022-06-29 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 100000, NULL, 0, 100000, 1, NULL, 12000, 14400, NULL, NULL, 0.12, 0.144, NULL, NULL, '', '', NULL, NULL, 1, 1, 50, 1000, 0, 0),
(29, '2022-06-10 12:39:03', 1, 34, '2022-06-21 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 100000, NULL, 0, 100000, 1, NULL, 12000, 14400, NULL, NULL, 0.12, 0.144, NULL, NULL, '', '', NULL, NULL, 1, 1, 50, 1000, 0, 1),
(30, '2022-06-14 18:23:36', 1, 35, '2022-06-21 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 100000, NULL, 1, 100000, 2, NULL, 12000, 14400, NULL, NULL, 0.12, 0.144, NULL, NULL, '', '', NULL, NULL, 3, 1, 50, 1000, 1, 0),
(31, '2022-06-15 08:27:11', 8, 5, '2022-06-29 21:00:00', '2022-06-15 17:56:44', '2022-06-20 07:08:06', NULL, NULL, '2022-06-20 10:53:39', '2022-06-22 17:04:39', '2022-06-20 07:47:53', '2022-06-20 10:35:41', 3, 100000, 100000, 0, 100000, 1, 'Maksim', 12000, 14400, NULL, NULL, 0.12, 0.144, 'Ilnur', 'Albert', '', '', NULL, NULL, 1, 1, 50, 1000, 0, 0),
(32, '2022-06-17 06:01:38', 1, 36, '2022-06-29 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1000, NULL, 0, 1000, 1, NULL, 120, 144, NULL, NULL, 0.12, 0.144, NULL, NULL, 'Перематывать осторожно', 'Печатать внимательно', NULL, NULL, 1, 1, 100, 1000, 0, 0),
(33, '2022-06-17 06:03:44', 1, 37, '2022-06-28 21:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1000, NULL, 0, 1000, 2, NULL, 120, 144, NULL, NULL, 0.12, 0.144, NULL, NULL, '', '', NULL, NULL, 2, 1, 100, 1000, 0, 0),
(34, '2022-06-28 08:27:11', 4, 5, '2022-06-29 21:00:00', NULL, NULL, '2022-08-11 11:39:23', '2022-08-11 12:41:31', NULL, NULL, NULL, NULL, 3, 100000, 100000, 0, 100000, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', NULL, '', 1, 1, 50, 1000, 0, 0),
(35, '2022-08-09 16:35:57', 8, 39, '2022-08-18 21:00:00', '2022-08-09 17:01:38', '2022-08-10 07:29:21', NULL, NULL, '2022-08-10 07:32:17', '2022-08-10 07:33:38', '2022-08-10 07:30:08', '2022-08-10 07:31:42', 3, 225000, 225000, 0, 225000, 2, 'Maksim', 270000, 324000, NULL, NULL, 1.2, 1.44, 'Ilnur', 'Albert', '', '', '', '', 2, 4, NULL, 5000, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `order_material`
--

CREATE TABLE `order_material` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `paper_warehouse_id` int NOT NULL,
  `length` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `order_material`
--

INSERT INTO `order_material` (`id`, `order_id`, `paper_warehouse_id`, `length`, `date`) VALUES
(5, 31, 1, 1500, '2022-08-18 09:53:22'),
(16, 31, 2, 50, '2022-08-18 09:53:22'),
(17, 31, 1, 50, '2022-08-18 09:53:22'),
(18, 31, 3, 1500, '2022-07-18 09:53:22'),
(19, 3, 2, 50, '2022-08-18 09:53:22'),
(20, 3, 1, 100, '2022-08-18 09:53:22'),
(21, 1, 2, 400, '2022-08-18 09:53:22'),
(22, 1, 1, 100, '2022-08-18 09:53:22'),
(23, 3, 2, 1000, '2022-08-18 09:53:22'),
(24, 35, 106, 2000, '2022-08-18 09:53:22'),
(28, 35, 105, 900, '2022-08-18 09:53:22');

-- --------------------------------------------------------

--
-- Структура таблицы `order_status`
--

CREATE TABLE `order_status` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'Новый'),
(2, 'В печати'),
(3, 'Печать приостановлена'),
(4, 'Напечатан'),
(5, 'Нарезка/Перемотка'),
(6, 'Нарезка завершена'),
(7, 'Упаковка'),
(8, 'На складе ГП'),
(9, 'Закрыт'),
(10, 'Брак');

-- --------------------------------------------------------

--
-- Структура таблицы `output_label`
--

CREATE TABLE `output_label` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `output_label`
--

INSERT INTO `output_label` (`id`, `name`, `image`) VALUES
(1, 'Выход1', '/web/output_label/s1.jpg'),
(2, 'Выход2', '/web/output_label/s2.jpg'),
(3, 'Выход3', '/web/output_label/s3.jpg'),
(4, 'Выход4', '/web/output_label/s4.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `pantone`
--

CREATE TABLE `pantone` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `pantone_kind_id` int NOT NULL,
  `price_rub` double DEFAULT NULL,
  `price_rub_discount` double DEFAULT NULL,
  `price_euro` double DEFAULT NULL,
  `price_euro_discount` double DEFAULT NULL,
  `subscribe` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `pantone`
--

INSERT INTO `pantone` (`id`, `name`, `pantone_kind_id`, `price_rub`, `price_rub_discount`, `price_euro`, `price_euro_discount`, `subscribe`) VALUES
(1, 'cyan', 1, 70, NULL, 2.5, NULL, ''),
(2, 'magenta', 1, NULL, NULL, NULL, NULL, NULL),
(3, 'yellow', 1, NULL, NULL, NULL, NULL, NULL),
(4, 'black', 1, NULL, NULL, NULL, NULL, NULL),
(5, '128 ARSOMA', 2, NULL, NULL, NULL, NULL, NULL),
(8, '116 Gallus', 2, NULL, NULL, 5, NULL, ''),
(9, 'new ENERGY (5012) матовый лак 25кг', 4, NULL, NULL, 5, NULL, NULL),
(10, '120 Gallus', 2, 70, 60, 0.5, 0.4, ''),
(11, 'Jetsci Black', 1, 10182, 10214, 165, 160, 'Краска для переменной печати'),
(12, 'Gallus 340 456', 1, 3830, 3700, 60, 50, ''),
(13, '130 ARSOMA', 2, 70, 50, 0.6, 0.4, ''),
(14, '118 Gallus', 1, 70, 50, 0.5, 0.4, ''),
(15, '118 ARSOMA2', 1, 70, 50, 0.5, 0.4, ''),
(16, '116 Gallus', 1, 70, 50, 0.5, 0.4, 'dsfhdfg');

-- --------------------------------------------------------

--
-- Структура таблицы `pantone_kind`
--

CREATE TABLE `pantone_kind` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `pantone_kind`
--

INSERT INTO `pantone_kind` (`id`, `name`) VALUES
(1, 'Чистый PANTONE'),
(2, 'Смешанный PANTONE'),
(3, 'Химия'),
(4, 'Матовый лак'),
(5, 'Глянцевый лак');

-- --------------------------------------------------------

--
-- Структура таблицы `pantone_label`
--

CREATE TABLE `pantone_label` (
  `id` int NOT NULL,
  `pantone_id` int NOT NULL,
  `label_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `pantone_label`
--

INSERT INTO `pantone_label` (`id`, `pantone_id`, `label_id`) VALUES
(1, 1, 1),
(3, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `pantone_price_archive`
--

CREATE TABLE `pantone_price_archive` (
  `id` int NOT NULL,
  `pantone_id` int NOT NULL,
  `date_of_change` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price_attribute` varchar(50) NOT NULL,
  `old_value` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `pantone_price_archive`
--

INSERT INTO `pantone_price_archive` (`id`, `pantone_id`, `date_of_change`, `price_attribute`, `old_value`) VALUES
(1, 1, '2022-08-16 12:42:14', 'price_rub', 50),
(2, 1, '2022-08-16 12:48:25', 'price_rub', 60),
(3, 10, '2022-08-16 12:58:15', 'price_rub', 60),
(4, 10, '2022-08-16 13:01:41', 'price_rub_discount', 50);

-- --------------------------------------------------------

--
-- Структура таблицы `pantone_warehouse`
--

CREATE TABLE `pantone_warehouse` (
  `id` int NOT NULL,
  `pantone_id` int NOT NULL,
  `weight` double NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `shelf_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `pantone_warehouse`
--

INSERT INTO `pantone_warehouse` (`id`, `pantone_id`, `weight`, `date`, `shelf_id`) VALUES
(1, 1, 10, '2022-08-16 15:37:32', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `pants`
--

CREATE TABLE `pants` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `shaft_id` int DEFAULT NULL,
  `paper_width` int DEFAULT NULL COMMENT 'ширина бумаги',
  `pants_kind_id` int DEFAULT NULL COMMENT 'вид штанца',
  `cuts` int NOT NULL COMMENT 'высечки',
  `width_label` float NOT NULL COMMENT 'ширина этикетки',
  `height_label` float NOT NULL COMMENT 'высота этикетки',
  `knife_kind_id` int NOT NULL COMMENT 'тип ножа',
  `knife_width` int NOT NULL COMMENT 'ширина ножа',
  `picture` varchar(100) NOT NULL,
  `radius` float NOT NULL COMMENT 'радиус',
  `gap` float NOT NULL COMMENT 'зазор',
  `material_group_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `pants`
--

INSERT INTO `pants` (`id`, `name`, `shaft_id`, `paper_width`, `pants_kind_id`, `cuts`, `width_label`, `height_label`, `knife_kind_id`, `knife_width`, `picture`, `radius`, `gap`, `material_group_id`) VALUES
(1, '1754', 1, 80, 1, 8, 20, 35, 1, 170, 'pants/1754.jpg', 0, 0, 1),
(2, '1948', 2, 150, 2, 5, 160, 160, 3, 250, 'pants/1948.jpg', 0, 0, 2),
(3, '1755', 3, 245, 3, 2, 85, 250, 3, 95, '0', 0, 0, 3),
(5, '2775', 3, 225, 2, 8, 28, 50, 2, 125, 'pants/2775.jpg', 15, 2.5, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `pants_kind`
--

CREATE TABLE `pants_kind` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `pants_kind`
--

INSERT INTO `pants_kind` (`id`, `name`) VALUES
(1, 'Прямоугольный'),
(2, 'Окружность'),
(3, 'Фигурный');

-- --------------------------------------------------------

--
-- Структура таблицы `paper_warehouse`
--

CREATE TABLE `paper_warehouse` (
  `id` int NOT NULL,
  `date_of_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `material_id` int NOT NULL,
  `length` int NOT NULL,
  `width` int NOT NULL,
  `shelf_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `paper_warehouse`
--

INSERT INTO `paper_warehouse` (`id`, `date_of_create`, `material_id`, `length`, `width`, `shelf_id`) VALUES
(1, '2022-07-15 13:20:55', 1, 250, 200, NULL),
(2, '2022-07-15 13:20:55', 2, 0, 100, NULL),
(3, '2022-07-15 13:20:55', 3, 500, 300, NULL),
(4, '2022-07-15 13:20:55', 3, 1000, 300, NULL),
(5, '2022-07-15 13:20:55', 2, 1000, 100, NULL),
(6, '2022-07-15 13:20:55', 1, 1000, 300, NULL),
(7, '2022-07-29 15:39:25', 1, 1920, 160, NULL),
(8, '2022-07-29 15:39:25', 1, 1930, 245, NULL),
(9, '2022-07-29 15:39:25', 1, 1930, 245, NULL),
(10, '2022-07-29 15:39:25', 1, 945, 160, NULL),
(11, '2022-07-29 15:39:25', 1, 1950, 160, NULL),
(12, '2022-07-29 15:39:25', 1, 1950, 160, NULL),
(13, '2022-07-29 15:39:25', 1, 1950, 245, NULL),
(14, '2022-07-29 15:39:25', 1, 1950, 245, NULL),
(15, '2022-07-29 15:39:25', 1, 2000, 245, NULL),
(16, '2022-07-29 15:39:25', 1, 2000, 245, NULL),
(17, '2022-07-29 15:40:47', 1, 1920, 200, NULL),
(18, '2022-07-29 15:40:47', 1, 1920, 200, NULL),
(19, '2022-07-29 15:40:47', 1, 1945, 200, NULL),
(20, '2022-07-29 15:40:47', 1, 1945, 200, NULL),
(21, '2022-07-29 15:40:47', 1, 1950, 200, NULL),
(22, '2022-07-29 15:40:47', 1, 1950, 200, NULL),
(23, '2022-07-29 15:40:47', 1, 1950, 200, NULL),
(24, '2022-07-29 15:40:47', 1, 1950, 200, NULL),
(25, '2022-07-29 15:40:47', 1, 1950, 200, NULL),
(26, '2022-07-29 15:40:47', 1, 1950, 200, NULL),
(27, '2022-07-29 15:40:47', 1, 1980, 200, NULL),
(28, '2022-07-29 15:41:54', 1, 1920, 255, NULL),
(29, '2022-07-29 15:41:54', 1, 1920, 255, NULL),
(30, '2022-07-29 15:41:54', 1, 1945, 255, NULL),
(31, '2022-07-29 15:41:54', 1, 1945, 255, NULL),
(32, '2022-07-29 15:41:54', 1, 1950, 255, NULL),
(33, '2022-07-29 15:41:54', 1, 1950, 255, NULL),
(34, '2022-07-29 15:41:54', 1, 1950, 255, NULL),
(35, '2022-07-29 15:41:54', 1, 1950, 255, NULL),
(36, '2022-07-29 15:42:07', 1, 1930, 180, NULL),
(37, '2022-07-29 15:42:07', 1, 1930, 180, NULL),
(38, '2022-07-29 15:42:07', 1, 1950, 180, NULL),
(39, '2022-07-29 15:42:07', 1, 1950, 180, NULL),
(40, '2022-07-29 15:42:07', 1, 1950, 180, NULL),
(41, '2022-07-29 15:42:07', 1, 1950, 180, NULL),
(42, '2022-07-29 15:42:07', 1, 1950, 180, NULL),
(43, '2022-07-29 15:42:07', 1, 1980, 180, NULL),
(44, '2022-07-29 15:42:07', 1, 2000, 180, NULL),
(45, '2022-07-29 15:42:07', 1, 2000, 180, NULL),
(46, '2022-07-29 15:42:07', 1, 2000, 180, NULL),
(47, '2022-07-29 15:42:15', 1, 1930, 220, NULL),
(48, '2022-07-29 15:42:15', 1, 1950, 220, NULL),
(49, '2022-07-29 15:42:15', 1, 1950, 220, NULL),
(50, '2022-07-29 15:42:15', 1, 1950, 220, NULL),
(51, '2022-07-29 15:42:15', 1, 1950, 220, NULL),
(52, '2022-07-29 15:42:15', 1, 1950, 230, NULL),
(53, '2022-07-29 15:42:15', 1, 2000, 220, NULL),
(54, '2022-07-29 15:42:15', 1, 2000, 220, NULL),
(55, '2022-07-29 15:42:15', 1, 2000, 220, NULL),
(56, '2022-07-29 15:42:15', 1, 2000, 220, NULL),
(57, '2022-07-29 15:42:23', 1, 1950, 230, NULL),
(58, '2022-07-29 15:42:23', 1, 1950, 230, NULL),
(59, '2022-07-29 15:42:23', 1, 1950, 230, NULL),
(60, '2022-07-29 15:42:23', 1, 1950, 230, NULL),
(61, '2022-07-29 15:42:23', 1, 1950, 230, NULL),
(62, '2022-07-29 15:42:23', 1, 1950, 230, NULL),
(63, '2022-07-29 15:42:23', 1, 1980, 230, NULL),
(64, '2022-07-29 15:42:23', 1, 1980, 230, NULL),
(65, '2022-07-29 15:42:23', 1, 1980, 230, NULL),
(66, '2022-07-29 15:42:23', 1, 2000, 230, NULL),
(67, '2022-07-29 15:43:25', 2, 1950, 170, NULL),
(68, '2022-07-29 15:59:11', 5, 1950, 180, NULL),
(69, '2022-08-01 10:38:17', 5, 1950, 180, NULL),
(70, '2022-08-01 10:38:17', 5, 1950, 180, NULL),
(71, '2022-08-01 10:38:17', 5, 1950, 180, NULL),
(72, '2022-08-01 10:38:17', 5, 1950, 180, NULL),
(73, '2022-08-01 10:38:17', 5, 1950, 200, NULL),
(74, '2022-08-01 10:38:17', 5, 1950, 260, NULL),
(75, '2022-08-01 10:38:17', 5, 1980, 180, NULL),
(76, '2022-08-01 10:38:17', 5, 2000, 180, NULL),
(77, '2022-08-01 10:38:27', 5, 1966, 200, NULL),
(78, '2022-08-01 10:38:27', 5, 1966, 200, NULL),
(79, '2022-08-01 10:38:27', 5, 1966, 200, NULL),
(80, '2022-08-01 10:38:27', 5, 1966, 200, NULL),
(81, '2022-08-01 10:38:27', 5, 1966, 200, NULL),
(82, '2022-08-01 10:38:27', 5, 1966, 200, NULL),
(83, '2022-08-01 10:38:27', 5, 1980, 200, NULL),
(84, '2022-08-01 10:38:27', 5, 1980, 200, NULL),
(85, '2022-08-01 10:38:27', 5, 1980, 200, NULL),
(86, '2022-08-01 10:38:27', 5, 2000, 200, NULL),
(87, '2022-08-01 10:38:37', 5, 1966, 110, NULL),
(88, '2022-08-01 10:38:37', 5, 1966, 220, NULL),
(89, '2022-08-01 10:38:37', 5, 1980, 165, NULL),
(90, '2022-08-01 10:38:37', 5, 1980, 165, NULL),
(91, '2022-08-01 10:38:37', 5, 1980, 220, NULL),
(92, '2022-08-01 10:38:37', 5, 2000, 110, NULL),
(93, '2022-08-01 10:38:37', 5, 2000, 165, NULL),
(94, '2022-08-01 10:38:37', 5, 2000, 165, NULL),
(95, '2022-08-01 10:38:37', 5, 2000, 220, NULL),
(96, '2022-08-01 10:38:37', 5, 2000, 220, NULL),
(97, '2022-08-01 10:38:45', 5, 1980, 200, NULL),
(98, '2022-08-01 10:38:46', 5, 2000, 200, NULL),
(99, '2022-08-01 10:38:46', 5, 2000, 200, NULL),
(100, '2022-08-01 10:38:46', 5, 2000, 200, NULL),
(101, '2022-08-01 10:38:46', 5, 2000, 200, NULL),
(102, '2022-08-01 10:38:46', 5, 2000, 200, NULL),
(103, '2022-08-01 10:38:46', 5, 2000, 200, NULL),
(104, '2022-08-01 10:38:46', 5, -500, 200, NULL),
(105, '2022-08-01 10:38:46', 5, 0, 200, NULL),
(106, '2022-08-01 10:38:46', 5, 0, 200, 2),
(107, '2022-08-15 15:36:37', 5, 500, 100, 1),
(108, '2022-08-15 15:36:37', 5, 0, 100, NULL),
(109, '2022-08-15 15:44:39', 5, 100, 60, NULL),
(110, '2022-08-15 15:44:39', 5, 500, 60, NULL),
(111, '2022-08-15 15:48:18', 5, -9900, 100, NULL),
(112, '2022-08-15 15:48:18', 5, 2000, 100, NULL),
(113, '2022-08-15 15:49:59', 5, 50, 50, NULL),
(114, '2022-08-15 15:49:59', 5, -10000, 50, NULL),
(115, '2022-08-15 15:52:04', 5, 20000, 25, NULL),
(116, '2022-08-15 15:52:04', 5, 20000, 25, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `photo_output`
--

CREATE TABLE `photo_output` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `photo_output`
--

INSERT INTO `photo_output` (`id`, `name`) VALUES
(1, 'Kodak'),
(2, 'LaserGraver');

-- --------------------------------------------------------

--
-- Структура таблицы `polymer`
--

CREATE TABLE `polymer` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `polymer`
--

INSERT INTO `polymer` (`id`, `name`) VALUES
(1, 'ACE'),
(2, 'ACT'),
(3, 'FAH'),
(4, 'Nilpeter');

-- --------------------------------------------------------

--
-- Структура таблицы `polymer_kind`
--

CREATE TABLE `polymer_kind` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `polymer_kind`
--

INSERT INTO `polymer_kind` (`id`, `name`) VALUES
(1, '1,14'),
(2, '1,7');

-- --------------------------------------------------------

--
-- Структура таблицы `rack`
--

CREATE TABLE `rack` (
  `id` int NOT NULL COMMENT 'ID стеллажа',
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'Описание',
  `warehouse_id` int DEFAULT NULL COMMENT 'Склад'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `rack`
--

INSERT INTO `rack` (`id`, `name`, `warehouse_id`) VALUES
(1, 'Gallus', 1),
(2, 'G340', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `region`
--

CREATE TABLE `region` (
  `id` int NOT NULL,
  `subject_id` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `region`
--

INSERT INTO `region` (`id`, `subject_id`, `name`) VALUES
(1, 1, 'Альметьевский район'),
(2, 1, 'Сармановский район'),
(3, 1, 'Заинский район');

-- --------------------------------------------------------

--
-- Структура таблицы `shaft`
--

CREATE TABLE `shaft` (
  `id` int NOT NULL,
  `name` double NOT NULL COMMENT 'длина,мм',
  `polymer_kind_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `shaft`
--

INSERT INTO `shaft` (`id`, `name`, `polymer_kind_id`) VALUES
(1, 430, 2),
(2, 425.45, 2),
(3, 403.225, 1),
(4, 203.2, 2),
(5, 254, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `shelf`
--

CREATE TABLE `shelf` (
  `id` int NOT NULL COMMENT 'ID',
  `rack_id` int NOT NULL COMMENT 'Стеллаж'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `shelf`
--

INSERT INTO `shelf` (`id`, `rack_id`) VALUES
(1, 2),
(2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `shipment`
--

CREATE TABLE `shipment` (
  `id` int NOT NULL,
  `manager_login` varchar(50) NOT NULL,
  `date_of_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_of_send` datetime DEFAULT NULL,
  `status_id` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `shipment`
--

INSERT INTO `shipment` (`id`, `manager_login`, `date_of_create`, `date_of_send`, `status_id`) VALUES
(1, 'Jura', '2022-06-20 20:56:31', '2022-06-30 09:42:22', 0),
(2, 'Jura', '2022-06-22 12:59:26', '2022-06-01 00:00:00', 0),
(3, 'Jura', '2022-06-22 14:34:51', '2022-06-02 00:00:00', 2),
(4, 'Jura', '2022-08-10 10:36:49', '2022-08-19 00:00:00', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `shipment_order`
--

CREATE TABLE `shipment_order` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `shipment_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `shipment_order`
--

INSERT INTO `shipment_order` (`id`, `order_id`, `shipment_id`) VALUES
(7, 5, 1),
(8, 6, 1),
(10, 19, 1),
(11, 31, 3),
(12, 1, 3),
(13, 3, 3),
(14, 4, 3),
(15, 35, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `sleeve`
--

CREATE TABLE `sleeve` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `sleeve`
--

INSERT INTO `sleeve` (`id`, `name`) VALUES
(1, '40'),
(2, '76'),
(3, '45'),
(4, 'Любая'),
(5, '85');

-- --------------------------------------------------------

--
-- Структура таблицы `street`
--

CREATE TABLE `street` (
  `id` int NOT NULL,
  `town_id` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `street`
--

INSERT INTO `street` (`id`, `town_id`, `name`) VALUES
(1, 1, 'Ленина'),
(2, 1, 'Бигаш'),
(4, 2, 'Ленина'),
(5, 1, 'Белоглазова'),
(6, 4, 'Ленина'),
(7, 1, 'Шевченко');

-- --------------------------------------------------------

--
-- Структура таблицы `subject`
--

CREATE TABLE `subject` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `subject`
--

INSERT INTO `subject` (`id`, `name`) VALUES
(1, 'Республика Татарстан'),
(2, 'Республика Башкортостан'),
(25, 'Белгородская область'),
(26, 'Брянская область'),
(27, 'Владимирская область'),
(28, 'Воронежская область'),
(29, 'Ивановская область'),
(30, 'Калужская область'),
(31, 'Костромская область'),
(32, 'Курская область'),
(33, 'Липецкая область'),
(34, 'Московская область'),
(35, 'Орловская область'),
(36, 'Рязанская область'),
(37, 'Смоленская область'),
(38, 'Тамбовская область'),
(39, 'Тверская область'),
(40, 'Тульская область'),
(41, 'Ярославская область'),
(42, 'Республика Карелия'),
(43, 'Республика Коми'),
(44, 'Архангельская область'),
(45, 'Вологодская область'),
(46, 'Калининградская область'),
(47, 'Ленинградская область'),
(48, 'Мурманская область'),
(49, 'Новгородская область'),
(50, 'Псковская область'),
(51, 'Республика Адыгея'),
(52, 'Республика Калмыкия'),
(53, 'Республика Крым'),
(54, 'Краснодарский край'),
(55, 'Астраханская область'),
(56, 'Волгоградская область'),
(57, 'Ростовская область'),
(58, 'Республика Дагестан'),
(59, 'Республика Ингушетия'),
(60, 'Кабардино-Балкарская Республика'),
(61, 'Карачаево-Черкесская Республика'),
(62, 'Республика Северная Осетия-Алания'),
(63, 'Чеченская Республика'),
(64, 'Ставропольский край'),
(65, 'Республика Марий Эл'),
(66, 'Республика Мордовия'),
(67, 'Удмуртская Республика'),
(68, 'Чувашская Республика'),
(69, 'Пермский край'),
(70, 'Кировская область'),
(71, 'Нижегородская область'),
(72, 'Оренбургская область'),
(73, 'Пензенская область'),
(74, 'Самарская область'),
(75, 'Саратовская область'),
(76, 'Ульяновская область'),
(77, 'Курганская область'),
(78, 'Свердловская область'),
(79, 'Тюменская область'),
(80, 'Челябинская область'),
(81, 'Республика Алтай'),
(82, 'Республика Бурятия'),
(83, 'Республика Тыва'),
(84, 'Республика Хакасия'),
(85, 'Алтайский край'),
(86, 'Забайкальский край'),
(87, 'Красноярский край'),
(88, 'Иркутская область'),
(89, 'Кемеровская область'),
(90, 'Новосибирская область'),
(91, 'Омская область'),
(92, 'Томская область'),
(93, 'Республика Саха (Якутия)'),
(94, 'Камчатский край'),
(95, 'Приморский край'),
(96, 'Хабаровский край'),
(97, 'Амурская область'),
(98, 'Магаданская область'),
(99, 'Сахалинская область'),
(100, 'Еврейская автономная область'),
(101, 'Чукотский автономный округ'),
(102, 'Республика Крым');

-- --------------------------------------------------------

--
-- Структура таблицы `time_tracker`
--

CREATE TABLE `time_tracker` (
  `id` int NOT NULL,
  `employer_login` varchar(100) NOT NULL,
  `action` int NOT NULL DEFAULT '0',
  `date_of_action` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `time_tracker`
--

INSERT INTO `time_tracker` (`id`, `employer_login`, `action`, `date_of_action`) VALUES
(6, 'Alex', 0, '2022-08-04 05:00:49'),
(7, 'Alex', 1, '2022-08-04 14:15:12'),
(14, 'Alex', 0, '2022-08-05 05:02:33'),
(15, 'Masha', 0, '2022-08-05 05:04:40'),
(16, 'Alex', 1, '2022-08-08 10:40:49'),
(17, 'Alex', 0, '2022-08-09 05:40:08'),
(18, 'Alex', 1, '2022-08-09 16:00:03'),
(19, 'Alex', 0, '2022-08-10 05:08:17'),
(20, 'Alex', 1, '2022-08-10 14:01:38'),
(21, 'Alex', 0, '2022-08-11 05:07:16'),
(22, 'Alex', 0, '2022-08-12 04:58:55');

-- --------------------------------------------------------

--
-- Структура таблицы `town`
--

CREATE TABLE `town` (
  `id` int NOT NULL,
  `region_id` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `town`
--

INSERT INTO `town` (`id`, `region_id`, `name`) VALUES
(1, 1, 'г.Альметьевск'),
(2, 2, 'пгт Джалиль'),
(3, 1, 'Мактама'),
(4, 2, 'пгт. Сарманово');

-- --------------------------------------------------------

--
-- Структура таблицы `transport`
--

CREATE TABLE `transport` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `car_number` varchar(50) NOT NULL,
  `load_capacity` double NOT NULL,
  `subscribe` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `transport`
--

INSERT INTO `transport` (`id`, `name`, `car_number`, `load_capacity`, `subscribe`) VALUES
(1, 'Opel Vivaro', 'H200HE', 1200, ''),
(2, 'Ситроен Jumper', 'н300нт', 2500, 'Динмухаметов Марат - 8-917-927-66-01');

-- --------------------------------------------------------

--
-- Структура таблицы `upload_paper`
--

CREATE TABLE `upload_paper` (
  `id` int NOT NULL,
  `pallet_id` varchar(100) NOT NULL,
  `width` int NOT NULL,
  `length` int NOT NULL,
  `material_id_from_provider` int NOT NULL,
  `roll_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `varnish_status`
--

CREATE TABLE `varnish_status` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `varnish_status`
--

INSERT INTO `varnish_status` (`id`, `name`) VALUES
(0, 'Без лака'),
(1, 'Матовый лак'),
(2, 'Глянцевый лак'),
(3, 'Матовый/Глянцевый лак');

-- --------------------------------------------------------

--
-- Структура таблицы `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Наименование'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `warehouse`
--

INSERT INTO `warehouse` (`id`, `name`) VALUES
(1, 'Склад бумаги Gallus'),
(2, 'Склад бумаги Gallus340'),
(3, 'Теплый склад'),
(4, 'Склад ЛКМ Gallus340'),
(5, 'Склад ЛКМ Gallus');

-- --------------------------------------------------------

--
-- Структура таблицы `winding`
--

CREATE TABLE `winding` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `winding`
--

INSERT INTO `winding` (`id`, `name`, `image`) VALUES
(1, 'Намотка 1', '/web/winding_order/s1.jpg'),
(2, 'Намотка2', '/web/winding_order/s2.jpg'),
(3, 'Намотка3', '/web/winding_order/s3.jpg'),
(4, 'Намотка4', '/web/winding_order/s4.jpg'),
(5, 'Намотка5', '/web/winding_order/s5.jpg'),
(6, 'Намотка6', '/web/winding_order/s6.jpg'),
(7, 'Намотка7', '/web/winding_order/s7.jpg'),
(8, 'Намотка8', '/web/winding_order/s8.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `background_label`
--
ALTER TABLE `background_label`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `bank_transfer`
--
ALTER TABLE `bank_transfer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `calc_common_param`
--
ALTER TABLE `calc_common_param`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `calc_common_param_archive`
--
ALTER TABLE `calc_common_param_archive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delete_calc_common_param` (`calc_common_param_id`);

--
-- Индексы таблицы `calc_mashine_param`
--
ALTER TABLE `calc_mashine_param`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `calc_mashine_param_value`
--
ALTER TABLE `calc_mashine_param_value`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delete_calc_mashine_param` (`calc_mashine_param_id`),
  ADD KEY `delete_mashine` (`mashine_id`);

--
-- Индексы таблицы `calc_mashine_param_value_archive`
--
ALTER TABLE `calc_mashine_param_value_archive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delete_calc_mashine_param_value` (`calc_mashine_param_value_id`);

--
-- Индексы таблицы `combination`
--
ALTER TABLE `combination`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `combination_form`
--
ALTER TABLE `combination_form`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `label_id` (`label_id`);

--
-- Индексы таблицы `combination_order`
--
ALTER TABLE `combination_order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `combination_print_order`
--
ALTER TABLE `combination_print_order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `customer_status`
--
ALTER TABLE `customer_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `enterprise_cost`
--
ALTER TABLE `enterprise_cost`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `enterprise_cost_service`
--
ALTER TABLE `enterprise_cost_service`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `envelope`
--
ALTER TABLE `envelope`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `finished_products_warehouse`
--
ALTER TABLE `finished_products_warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `foil`
--
ALTER TABLE `foil`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`),
  ADD KEY `label_id` (`label_id`);

--
-- Индексы таблицы `form_defect`
--
ALTER TABLE `form_defect`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `form_order_history`
--
ALTER TABLE `form_order_history`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `knife_kind`
--
ALTER TABLE `knife_kind`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `label`
--
ALTER TABLE `label`
  ADD PRIMARY KEY (`id`),
  ADD KEY `date_of_create` (`date_of_create`,`customer_id`,`status_id`),
  ADD KEY `name` (`name`),
  ADD KEY `pants` (`pants_id`);

--
-- Индексы таблицы `label_status`
--
ALTER TABLE `label_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mashine`
--
ALTER TABLE `mashine`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mashine_pantone`
--
ALTER TABLE `mashine_pantone`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mashine_pants`
--
ALTER TABLE `mashine_pants`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `material_group`
--
ALTER TABLE `material_group`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `material_price_archive`
--
ALTER TABLE `material_price_archive`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `material_provider`
--
ALTER TABLE `material_provider`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mixed_pantone`
--
ALTER TABLE `mixed_pantone`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`status_id`,`label_id`) USING BTREE;

--
-- Индексы таблицы `order_material`
--
ALTER TABLE `order_material`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `output_label`
--
ALTER TABLE `output_label`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pantone`
--
ALTER TABLE `pantone`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pantone_kind`
--
ALTER TABLE `pantone_kind`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pantone_label`
--
ALTER TABLE `pantone_label`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pantone_price_archive`
--
ALTER TABLE `pantone_price_archive`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pantone_warehouse`
--
ALTER TABLE `pantone_warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pants`
--
ALTER TABLE `pants`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pants_kind`
--
ALTER TABLE `pants_kind`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `paper_warehouse`
--
ALTER TABLE `paper_warehouse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `material_id` (`material_id`);

--
-- Индексы таблицы `photo_output`
--
ALTER TABLE `photo_output`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `polymer`
--
ALTER TABLE `polymer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `polymer_kind`
--
ALTER TABLE `polymer_kind`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `rack`
--
ALTER TABLE `rack`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Индексы таблицы `shaft`
--
ALTER TABLE `shaft`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `shelf`
--
ALTER TABLE `shelf`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `shipment`
--
ALTER TABLE `shipment`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `shipment_order`
--
ALTER TABLE `shipment_order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- Индексы таблицы `sleeve`
--
ALTER TABLE `sleeve`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `street`
--
ALTER TABLE `street`
  ADD PRIMARY KEY (`id`),
  ADD KEY `town_id` (`town_id`);

--
-- Индексы таблицы `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `time_tracker`
--
ALTER TABLE `time_tracker`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `town`
--
ALTER TABLE `town`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region_id` (`region_id`);

--
-- Индексы таблицы `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `upload_paper`
--
ALTER TABLE `upload_paper`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `varnish_status`
--
ALTER TABLE `varnish_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `winding`
--
ALTER TABLE `winding`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `background_label`
--
ALTER TABLE `background_label`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `bank_transfer`
--
ALTER TABLE `bank_transfer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `calc_common_param`
--
ALTER TABLE `calc_common_param`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `calc_common_param_archive`
--
ALTER TABLE `calc_common_param_archive`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `calc_mashine_param`
--
ALTER TABLE `calc_mashine_param`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT для таблицы `calc_mashine_param_value`
--
ALTER TABLE `calc_mashine_param_value`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `calc_mashine_param_value_archive`
--
ALTER TABLE `calc_mashine_param_value_archive`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `combination`
--
ALTER TABLE `combination`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `combination_form`
--
ALTER TABLE `combination_form`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `combination_order`
--
ALTER TABLE `combination_order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `combination_print_order`
--
ALTER TABLE `combination_print_order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `customer_status`
--
ALTER TABLE `customer_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `enterprise_cost`
--
ALTER TABLE `enterprise_cost`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `enterprise_cost_service`
--
ALTER TABLE `enterprise_cost_service`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `envelope`
--
ALTER TABLE `envelope`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `finished_products_warehouse`
--
ALTER TABLE `finished_products_warehouse`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `foil`
--
ALTER TABLE `foil`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `form`
--
ALTER TABLE `form`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT для таблицы `form_defect`
--
ALTER TABLE `form_defect`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `form_order_history`
--
ALTER TABLE `form_order_history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `knife_kind`
--
ALTER TABLE `knife_kind`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `label`
--
ALTER TABLE `label`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT для таблицы `mashine_pantone`
--
ALTER TABLE `mashine_pantone`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `mashine_pants`
--
ALTER TABLE `mashine_pants`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `material`
--
ALTER TABLE `material`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `material_group`
--
ALTER TABLE `material_group`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `material_price_archive`
--
ALTER TABLE `material_price_archive`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `material_provider`
--
ALTER TABLE `material_provider`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `mixed_pantone`
--
ALTER TABLE `mixed_pantone`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `order_material`
--
ALTER TABLE `order_material`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `output_label`
--
ALTER TABLE `output_label`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `pantone`
--
ALTER TABLE `pantone`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `pantone_kind`
--
ALTER TABLE `pantone_kind`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `pantone_label`
--
ALTER TABLE `pantone_label`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `pantone_price_archive`
--
ALTER TABLE `pantone_price_archive`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `pantone_warehouse`
--
ALTER TABLE `pantone_warehouse`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `pants`
--
ALTER TABLE `pants`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `pants_kind`
--
ALTER TABLE `pants_kind`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `paper_warehouse`
--
ALTER TABLE `paper_warehouse`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT для таблицы `photo_output`
--
ALTER TABLE `photo_output`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `polymer`
--
ALTER TABLE `polymer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `polymer_kind`
--
ALTER TABLE `polymer_kind`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `rack`
--
ALTER TABLE `rack`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID стеллажа', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `region`
--
ALTER TABLE `region`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `shaft`
--
ALTER TABLE `shaft`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `shelf`
--
ALTER TABLE `shelf`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `shipment`
--
ALTER TABLE `shipment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `shipment_order`
--
ALTER TABLE `shipment_order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `sleeve`
--
ALTER TABLE `sleeve`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `street`
--
ALTER TABLE `street`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT для таблицы `time_tracker`
--
ALTER TABLE `time_tracker`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `town`
--
ALTER TABLE `town`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `transport`
--
ALTER TABLE `transport`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `upload_paper`
--
ALTER TABLE `upload_paper`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT для таблицы `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `winding`
--
ALTER TABLE `winding`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `calc_common_param_archive`
--
ALTER TABLE `calc_common_param_archive`
  ADD CONSTRAINT `delete_calc_common_param` FOREIGN KEY (`calc_common_param_id`) REFERENCES `calc_common_param` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `calc_mashine_param_value`
--
ALTER TABLE `calc_mashine_param_value`
  ADD CONSTRAINT `delete_calc_mashine_param` FOREIGN KEY (`calc_mashine_param_id`) REFERENCES `calc_mashine_param` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `delete_mashine` FOREIGN KEY (`mashine_id`) REFERENCES `mashine` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `calc_mashine_param_value_archive`
--
ALTER TABLE `calc_mashine_param_value_archive`
  ADD CONSTRAINT `delete_calc_mashine_param_value` FOREIGN KEY (`calc_mashine_param_value_id`) REFERENCES `calc_mashine_param_value` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

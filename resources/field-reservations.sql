-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 17-09-2024 a las 17:03:17
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `field-reservations`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `customer_tel` bigint(20) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_tel`) VALUES
(1, 'Santiago Angel Oviedo', 376450971),
(2, 'Nicolás Oviedo', 3764509714),
(4, 'Rodrigo Fernandez', 1234567891);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `field`
--

DROP TABLE IF EXISTS `field`;
CREATE TABLE IF NOT EXISTS `field` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `FieldType_id` int(11) NOT NULL,
  PRIMARY KEY (`field_id`),
  KEY `FieldType_id` (`FieldType_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `field`
--

INSERT INTO `field` (`field_id`, `FieldType_id`) VALUES
(5, 1),
(7, 3),
(6, 4),
(4, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fieldtype`
--

DROP TABLE IF EXISTS `fieldtype`;
CREATE TABLE IF NOT EXISTS `fieldtype` (
  `FieldType_id` int(11) NOT NULL AUTO_INCREMENT,
  `FieldType_name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`FieldType_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `fieldtype`
--

INSERT INTO `fieldtype` (`FieldType_id`, `FieldType_name`) VALUES
(1, 'Fútbol 5'),
(3, 'Fútbol 8'),
(4, 'Fútbol 11'),
(5, 'Fútbol 6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `reservation_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_for_date` date NOT NULL,
  `reservation_time` time NOT NULL,
  `field_id` int(11) NOT NULL,
  `reservation_duration` int(11) NOT NULL,
  `reservation_paid` tinyint(1) NOT NULL,
  PRIMARY KEY (`reservation_id`),
  KEY `customer_id` (`customer_id`),
  KEY `field_id` (`field_id`),
  KEY `field_id_2` (`field_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `customer_id`, `reservation_date`, `reservation_for_date`, `reservation_time`, `field_id`, `reservation_duration`, `reservation_paid`) VALUES
(4, 2, '2024-09-13', '2024-09-21', '16:00:00', 4, 1, 0),
(5, 1, '2024-09-13', '2024-09-15', '13:00:00', 4, 1, 1),
(6, 2, '2024-09-13', '2024-09-19', '15:00:00', 4, 3, 0),
(7, 2, '2024-09-13', '2024-09-19', '16:00:00', 5, 3, 0),
(8, 1, '2024-09-13', '2024-09-19', '14:00:00', 5, 2, 0),
(10, 2, '2024-09-14', '2024-09-20', '17:00:00', 5, 2, 1),
(11, 2, '2024-09-14', '2024-09-20', '23:00:00', 5, 2, 0),
(12, 2, '2024-09-14', '2024-09-15', '23:00:00', 5, 2, 0),
(14, 1, '2024-09-16', '2024-09-21', '17:00:00', 4, 2, 0),
(15, 2, '2024-09-16', '2024-09-20', '16:00:00', 5, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `user_pass` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`) VALUES
(1, 'admin', '44621312');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `field`
--
ALTER TABLE `field`
  ADD CONSTRAINT `field_ibfk_1` FOREIGN KEY (`FieldType_id`) REFERENCES `fieldtype` (`FieldType_id`);

--
-- Filtros para la tabla `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `field` (`field_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

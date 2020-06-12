-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-07-2018 a las 19:38:02
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.2
 
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0; 
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0; 
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES'; 
 
-- ----------------------------------------------------- 
-- Schema colegio_db 
-- ----------------------------------------------------- 
 
-- ----------------------------------------------------- 
-- Schema colegio_db 
-- ----------------------------------------------------- 
CREATE SCHEMA IF NOT EXISTS `colegio_db` DEFAULT CHARACTER SET utf8 ; 
USE `colegio_db` ; 


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `colegio_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrativo_obrero`
--

CREATE TABLE `administrativo_obrero` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleado_id` bigint(20) UNSIGNED NOT NULL,
  `nivel_instruccion` tinyint(3) DEFAULT NULL,
  `clasificacion_grado` varchar(2) DEFAULT NULL,
  `clasificacion_nivel` varchar(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aumento`
--

CREATE TABLE `aumento` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha` date DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `porcentaje_aumento_sb` int(11) DEFAULT NULL,
  `ut_ct` int(11) DEFAULT NULL,
  `retroactivo` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id` int(10) UNSIGNED NOT NULL,
  `abreviatura` varchar(5) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `tipo_empleado` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id`, `abreviatura`, `descripcion`, `tipo_empleado`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'S', 'Secretaria', 1, '2018-04-12 18:55:00', NULL, NULL),
(3, 'AA', 'Auxiliar Administrativo', 1, '2018-04-12 18:55:00', NULL, NULL),
(4, 'R', 'Recepcionista', 1, '2018-04-12 18:55:00', NULL, NULL),
(5, 'I', 'Instructor', 1, '2018-04-12 18:55:00', NULL, NULL),
(6, 'SA', 'Secretaria Auxiliar', 1, '2018-04-12 18:55:00', NULL, NULL),
(7, 'SAC', 'Sacerdote', 1, '2018-04-12 18:55:00', NULL, NULL),
(8, 'O', 'Obrero', 2, '2018-04-12 18:55:00', NULL, NULL),
(9, 'JM', 'Jefe de Mantenimiento', 2, '2018-04-12 18:55:00', NULL, NULL),
(10, 'VN', 'Vigilante Nocturno', 2, '2018-04-12 18:55:00', NULL, NULL),
(11, 'VD', 'Vigilante Diurno', 2, '2018-04-12 18:55:00', NULL, NULL),
(12, 'M', 'Maestra', 3, '2018-04-12 18:55:00', NULL, NULL),
(13, 'PPH', 'Profesor por Hora', 3, '2018-04-12 18:55:00', NULL, NULL),
(14, 'C', 'Coordinador', 3, '2018-04-12 18:55:00', NULL, NULL),
(15, 'PTC', 'Profesor Tiempo Completo', 3, '2018-04-12 18:55:00', NULL, NULL),
(16, 'JD', 'Jefe de Departamento', 3, '2018-04-12 18:55:00', NULL, NULL),
(17, 'D', 'Director', 3, '2018-04-12 18:55:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_docente`
--

CREATE TABLE `categoria_docente` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `abreviatura` varchar(3) NOT NULL,
  `categoria` varchar(45) NOT NULL,
  `anios` int(10) UNSIGNED NOT NULL,
  `esp_post` tinyint(1) NOT NULL,
  `valor_hora` double UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria_docente`
--

INSERT INTO `categoria_docente` (`id`, `abreviatura`, `categoria`, `anios`, `esp_post`, `valor_hora`, `created_at`, `updated_at`) VALUES
(1, 'D-1', 'Docente 1', 3, 0, 3501.73, '2018-04-12 18:55:00', '2018-04-22 03:44:41'),
(2, 'D-2', 'Docente 2', 7, 0, 3605.92, '2018-04-12 18:55:00', NULL),
(3, 'D-3', 'Docente 3', 11, 0, 3754.67, '2018-04-12 18:55:00', NULL),
(4, 'D-4', 'Docente 4', 16, 0, 3902.61, '2018-04-12 18:55:01', NULL),
(5, 'D-5', 'Docente 5', 21, 1, 4494.91, '2018-04-12 18:55:01', NULL),
(6, 'D-6', 'Docente 6', 99, 1, 5189.99, '2018-04-12 18:55:01', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cestaticket`
--

CREATE TABLE `cestaticket` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleado_id` bigint(20) UNSIGNED NOT NULL,
  `recibo_cestaticket_id` bigint(20) UNSIGNED NOT NULL,
  `cestaticket_valor` double NOT NULL,
  `asistencias` int(11) NOT NULL,
  `asignacion` double NOT NULL,
  `faltas` int(11) NOT NULL,
  `descontado` double NOT NULL,
  `tickets_mes` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cestaticket`
--

INSERT INTO `cestaticket` (`id`, `empleado_id`, `recibo_cestaticket_id`, `cestaticket_valor`, `asistencias`, `asignacion`, `faltas`, `descontado`, `tickets_mes`, `created_at`, `updated_at`, `deleted_at`) VALUES
(24, 6, 1, 7773.613193403298, 240, 1865667.1664167915, 0, 0, 1865667.1664167915, '2018-06-26 02:32:26', '2018-06-26 02:32:26', NULL),
(25, 7, 1, 7773.613193403298, 120, 932833.5832083958, 0, 0, 932833.5832083958, '2018-06-26 02:32:27', '2018-06-26 02:32:27', NULL),
(26, 6, 12, 7773.61, 240, 1865666.4, 0, 0, 1865666.4, '2018-06-26 02:36:48', '2018-06-26 02:36:48', NULL),
(27, 7, 12, 7773.61, 120, 932833.2, 0, 0, 932833.2, '2018-06-26 02:36:48', '2018-06-26 02:36:48', NULL),
(28, 6, 13, 7773.61, 240, 1865666.4, 0, 0, 1865666.4, '2018-06-26 02:40:07', '2018-06-26 02:40:07', NULL),
(29, 7, 13, 7773.61, 120, 932833.2, 0, 0, 932833.2, '2018-06-26 02:40:07', '2018-06-26 02:40:07', NULL),
(30, 6, 15, 7773.61, 240, 1865666.4, 0, 0, 1865666.4, '2018-06-26 02:46:35', '2018-06-26 02:46:35', NULL),
(31, 7, 15, 7773.61, 120, 932833.2, 0, 0, 932833.2, '2018-06-26 02:46:35', '2018-06-26 02:46:35', NULL),
(32, 6, 16, 7773.61, 232, 1803477.52, 8, 62188.88, 1865666.4, '2018-06-26 15:56:18', '2018-06-26 16:42:04', NULL),
(33, 7, 16, 7773.61, 120, 932833.2, 0, 0, 932833.2, '2018-06-26 15:56:18', '2018-06-26 15:56:18', NULL),
(34, 6, 17, 10974.51, -2, 2611933.38, 2, 21949.02, 2633882.4, '2018-06-26 16:50:38', '2018-06-26 16:51:05', NULL),
(35, 7, 17, 10974.51, -20, 1097451, 20, 219490.2, 1316941.2, '2018-06-26 16:50:38', '2018-06-26 16:50:49', NULL),
(36, 6, 18, 10974.51, 0, 2633882.4, 0, 0, 2633882.4, '2018-06-26 16:52:41', '2018-06-26 16:52:41', NULL),
(37, 7, 18, 10974.51, 0, 1316941.2, 0, 0, 1316941.2, '2018-06-26 16:52:41', '2018-06-26 16:52:41', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cestaticket_valor`
--
-- Error leyendo la estructura de la tabla colegio_db.cestaticket_valor: #1932 - Table 'colegio_db.cestaticket_valor' doesn't exist in engine
-- Error leyendo datos de la tabla colegio_db.cestaticket_valor: #1064 - Algo está equivocado en su sintax cerca 'FROM `colegio_db`.`cestaticket_valor`' en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigo_nomina`
--

CREATE TABLE `codigo_nomina` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(8) DEFAULT NULL,
  `tipo_nomina` tinyint(3) UNSIGNED NOT NULL,
  `configuracion_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `codigo_nomina`
--

INSERT INTO `codigo_nomina` (`id`, `codigo`, `tipo_nomina`, `configuracion_id`, `created_at`, `updated_at`) VALUES
(12, '1234', 4, 31, '2018-06-18 16:02:52', '2018-06-26 01:04:06'),
(14, NULL, 5, 33, '2018-06-18 16:34:46', '2018-06-18 16:34:46'),
(15, NULL, 5, 28, '2018-06-27 16:34:30', NULL),
(16, NULL, 5, 29, '2018-06-27 16:34:30', NULL),
(17, NULL, 5, 46, '2018-06-27 16:08:44', '2018-06-27 16:08:44'),
(18, NULL, 5, 47, '2018-06-27 16:09:19', '2018-06-27 16:09:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigo_nomina_recibo_empleado`
--

CREATE TABLE `codigo_nomina_recibo_empleado` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `codigo_nomina_id` int(10) UNSIGNED NOT NULL,
  `recibo_empleado_id` bigint(20) UNSIGNED NOT NULL,
  `monto` double NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `asignable` tinyint(1) DEFAULT NULL,
  `habilitada` tinyint(1) DEFAULT NULL,
  `eliminable` tinyint(1) DEFAULT NULL,
  `cantidad` double DEFAULT NULL,
  `tipo` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `descripcion`, `asignable`, `habilitada`, `eliminable`, `cantidad`, `tipo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Prima de Transporte', 1, NULL, NULL, 1500001, 2, '2018-04-12 17:55:05', '2018-06-18 14:52:56', '2018-06-18 14:52:56'),
(2, 'Valor Unidad Tributaria', 0, NULL, NULL, 500, 2, '2018-04-12 17:55:24', '2018-04-12 20:18:23', '2018-04-12 20:18:23'),
(3, 'dsv', 1, NULL, NULL, 444, 2, '2018-04-12 17:56:47', '2018-04-12 20:18:30', '2018-04-12 20:18:30'),
(4, 'yy', 0, NULL, NULL, 50, 1, '2018-04-12 17:57:01', '2018-04-12 20:18:17', '2018-04-12 20:18:17'),
(5, 'Otro 11', 0, NULL, NULL, 10.5, 1, '2018-04-12 17:59:09', '2018-06-18 14:53:09', '2018-06-18 14:53:09'),
(6, 'Nomina 1', 1, NULL, NULL, 11, 1, '2018-04-12 17:59:26', '2018-04-12 20:12:40', '2018-04-12 20:12:40'),
(7, 'Nomina 2', 1, NULL, NULL, 11, 2, '2018-04-12 17:59:55', '2018-04-12 20:18:09', '2018-04-12 20:18:09'),
(8, 'Otro 2', 0, NULL, NULL, 1, 2, '2018-04-12 18:00:09', '2018-04-12 20:08:52', '2018-04-12 20:08:52'),
(9, 'Otro', 0, NULL, NULL, 500, 2, '2018-04-12 20:20:43', '2018-06-18 14:53:14', '2018-06-18 14:53:14'),
(10, 'rrr', 1, NULL, NULL, 555, 2, '2018-04-12 20:49:39', '2018-04-12 22:19:03', '2018-04-12 22:19:03'),
(11, 'ttt', 2, NULL, NULL, 55, 3, '2018-04-12 20:50:02', '2018-06-18 14:53:24', '2018-06-18 14:53:24'),
(12, 'oooo', 0, NULL, NULL, 656565, 4, '2018-04-12 20:52:58', '2018-04-12 20:53:59', '2018-04-12 20:53:59'),
(13, 'jjjj', 1, NULL, NULL, 524854, 2, '2018-04-12 20:53:17', '2018-04-12 22:28:12', '2018-04-12 22:28:12'),
(14, '1', 0, NULL, NULL, 1, 1, '2018-04-12 22:26:48', '2018-06-18 14:53:28', '2018-06-18 14:53:28'),
(15, '2', 1, NULL, NULL, 2, 2, '2018-04-12 22:27:06', '2018-06-18 14:53:31', '2018-06-18 14:53:31'),
(16, 'Prueba', 1, NULL, NULL, 0, 2, '2018-04-21 17:09:55', '2018-06-18 14:53:34', '2018-06-18 14:53:34'),
(17, 'Prestaciones Sociales', 1, NULL, NULL, 0, 4, '2018-05-04 19:42:42', '2018-06-18 14:53:38', '2018-06-18 14:53:38'),
(18, 'Cestaticke', 1, NULL, NULL, 0, 4, '2018-05-04 19:48:49', '2018-06-18 14:53:19', '2018-06-18 14:53:19'),
(19, 'Horas Docente', 0, NULL, NULL, 6.67, 4, '2018-06-18 15:09:08', '2018-06-18 15:10:50', '2018-06-18 15:10:50'),
(20, 'Horas Administrativo/Obrero', 0, NULL, NULL, 8, 4, '2018-06-18 15:09:48', '2018-06-18 15:10:54', '2018-06-18 15:10:54'),
(21, 'Horas por Día', 0, NULL, NULL, 6.67, 4, '2018-06-18 15:13:59', '2018-06-18 15:26:43', '2018-06-18 15:26:43'),
(22, 'Horas por Día Docente', 0, NULL, NULL, 6.67, 4, '2018-06-18 15:27:07', '2018-06-18 15:49:21', '2018-06-18 15:49:21'),
(23, 'Horas por Día', 0, NULL, NULL, 8, 4, '2018-06-18 15:28:49', '2018-06-18 15:49:25', '2018-06-18 15:49:25'),
(24, 'Prueba', 0, NULL, NULL, 3, 1, '2018-06-18 15:44:59', '2018-06-18 15:49:29', '2018-06-18 15:49:29'),
(25, 'dc', 0, NULL, NULL, 8, 1, '2018-06-18 15:46:02', '2018-06-18 15:49:32', '2018-06-18 15:49:32'),
(26, 'Horas por Día', 0, NULL, NULL, 6.67, 4, '2018-06-18 15:49:48', '2018-06-18 15:56:47', '2018-06-18 15:56:47'),
(27, 'Horas por Día', 0, NULL, NULL, 8, 4, '2018-06-18 15:50:13', '2018-06-18 15:56:52', '2018-06-18 15:56:52'),
(28, 'Horas por Día', 1, NULL, 3, 6.67, 4, '2018-06-18 15:57:18', '2018-06-26 01:07:25', NULL),
(29, 'Horas por Día', 1, NULL, 3, 8, 4, '2018-06-18 15:57:37', '2018-06-18 15:57:37', NULL),
(30, 'Valor de UT', 0, NULL, 3, 1200, 2, '2018-06-18 15:58:47', '2018-06-26 16:50:34', NULL),
(31, 'Valor por hora', 1, NULL, 3, 0, 5, '2018-06-18 16:02:52', '2018-06-18 16:02:52', NULL),
(32, 'Prueba', 1, NULL, NULL, 15000, 2, '2018-06-18 16:10:35', '2018-06-18 16:28:23', '2018-06-18 16:28:23'),
(33, 'UT vigentes', 1, NULL, 3, 1830, 3, '2018-06-18 16:34:46', '2018-06-18 16:34:46', NULL),
(34, 'Prueba', 1, NULL, NULL, 4, 2, '2018-06-19 13:41:19', '2018-06-19 13:56:56', '2018-06-19 13:56:56'),
(35, 'Prueba', 1, NULL, NULL, 0, 1, '2018-06-19 14:08:25', '2018-06-19 14:08:31', '2018-06-19 14:08:31'),
(36, 'Prueba', 1, NULL, NULL, 0, 1, '2018-06-19 14:20:33', '2018-06-19 14:34:51', '2018-06-19 14:34:51'),
(37, 'Prueba', 1, NULL, NULL, 7, 1, '2018-06-19 14:34:38', '2018-06-19 14:34:45', '2018-06-19 14:34:45'),
(38, 'Prueba', 1, NULL, NULL, 0, 1, '2018-06-19 14:41:57', '2018-06-19 14:51:42', '2018-06-19 14:51:42'),
(39, 'Prueba', 1, NULL, NULL, 10, 2, '2018-06-19 14:48:44', '2018-06-19 14:51:34', '2018-06-19 14:51:34'),
(40, 'Prueba', 1, NULL, NULL, 0, 2, '2018-06-19 14:51:19', '2018-06-19 14:51:28', '2018-06-19 14:51:28'),
(41, 'Prueba', 1, NULL, NULL, 0, 1, '2018-06-19 14:53:01', '2018-06-19 14:53:17', '2018-06-19 14:53:17'),
(42, 'Prueba', 1, NULL, NULL, 800, 1, '2018-06-19 15:20:08', '2018-06-19 15:27:16', '2018-06-19 15:27:16'),
(43, 'Alicuota', 1, NULL, 2, 0.2797, 5, '2018-06-27 15:52:37', '2018-06-27 16:08:05', '2018-06-27 16:08:05'),
(44, 'Alicuota', 1, NULL, 2, 0.2606, 5, '2018-06-27 15:53:02', '2018-06-27 16:09:49', '2018-06-27 16:09:49'),
(45, 'dds', 1, NULL, 3, 5416, 5, '2018-06-27 16:04:02', '2018-06-27 16:04:45', '2018-06-27 16:04:45'),
(46, 'Alicuota', 1, NULL, 2, 0.2797, 5, '2018-06-27 16:08:44', '2018-06-27 16:08:44', NULL),
(47, 'Alicuota', 1, NULL, 2, 0.2606, 5, '2018-06-27 16:09:19', '2018-06-27 16:09:19', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion_empleado`
--

CREATE TABLE `configuracion_empleado` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleado_id` bigint(20) UNSIGNED NOT NULL,
  `sso` tinyint(1) DEFAULT NULL,
  `lph` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `configuracion_empleado`
--

INSERT INTO `configuracion_empleado` (`id`, `empleado_id`, `sso`, `lph`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 3, 1, 1, '2018-04-20 16:21:50', '2018-04-21 16:44:10', '2018-04-21 16:44:10'),
(4, 4, 0, 0, '2018-04-22 03:50:14', '2018-04-22 03:50:19', '2018-04-22 03:50:19'),
(5, 5, 1, 1, '2018-06-20 15:37:20', '2018-06-20 15:38:46', '2018-06-20 15:38:46'),
(6, 6, 1, 1, '2018-06-20 19:09:38', '2018-06-20 19:09:38', NULL),
(7, 7, 1, 1, '2018-06-20 19:10:22', '2018-06-20 19:10:22', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion_tipo_empleado`
--

CREATE TABLE `configuracion_tipo_empleado` (
  `id` int(10) UNSIGNED NOT NULL,
  `configuracion_id` int(10) UNSIGNED NOT NULL,
  `tipo_empleado` tinyint(4) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `configuracion_tipo_empleado`
--

INSERT INTO `configuracion_tipo_empleado` (`id`, `configuracion_id`, `tipo_empleado`, `created_at`, `updated_at`) VALUES
(25, 22, 3, '2018-06-18 15:27:07', '2018-06-18 15:27:07'),
(26, 22, 1, '2018-06-18 15:28:49', '2018-06-18 15:28:49'),
(27, 22, 2, '2018-06-18 15:28:49', '2018-06-18 15:28:49'),
(28, 26, 3, '2018-06-18 15:49:48', '2018-06-18 15:49:48'),
(29, 27, 1, '2018-06-18 15:50:13', '2018-06-18 15:50:13'),
(30, 27, 2, '2018-06-18 15:50:13', '2018-06-18 15:50:13'),
(31, 28, 3, '2018-06-18 15:57:18', '2018-06-18 15:57:18'),
(32, 29, 1, '2018-06-18 15:57:37', '2018-06-18 15:57:37'),
(33, 29, 2, '2018-06-18 15:57:37', '2018-06-18 15:57:37'),
(34, 31, 1, '2018-06-18 16:02:52', '2018-06-18 16:02:52'),
(35, 31, 2, '2018-06-18 16:02:52', '2018-06-18 16:02:52'),
(36, 31, 3, '2018-06-18 16:02:52', '2018-06-18 16:02:52'),
(38, 33, 1, '2018-06-18 16:34:46', '2018-06-18 16:34:46'),
(39, 33, 2, '2018-06-18 16:34:46', '2018-06-18 16:34:46'),
(40, 33, 3, '2018-06-18 16:34:46', '2018-06-18 16:34:46'),
(41, 43, 3, '2018-06-27 15:52:37', '2018-06-27 15:52:37'),
(42, 44, 1, '2018-06-27 15:53:02', '2018-06-27 15:53:02'),
(43, 44, 2, '2018-06-27 15:53:02', '2018-06-27 15:53:02'),
(44, 45, 3, '2018-06-27 16:04:02', '2018-06-27 16:04:02'),
(45, 46, 3, '2018-06-27 16:08:44', '2018-06-27 16:08:44'),
(46, 47, 1, '2018-06-27 16:09:19', '2018-06-27 16:09:19'),
(47, 47, 2, '2018-06-27 16:09:19', '2018-06-27 16:09:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_personales`
--

CREATE TABLE `datos_personales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleado_id` bigint(20) UNSIGNED NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `cedula` varchar(8) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Pruebaaa';

--
-- Volcado de datos para la tabla `datos_personales`
--

INSERT INTO `datos_personales` (`id`, `empleado_id`, `nombres`, `apellidos`, `cedula`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 3, 'Coordinador Prueba', 'www', '222', '2018-04-20 16:21:50', '2018-04-21 16:44:10', '2018-04-21 16:44:10'),
(4, 4, 'qq', 'qq', 'qq', '2018-04-22 03:50:14', '2018-04-22 03:50:20', '2018-04-22 03:50:20'),
(5, 5, 'nhvsf', 'caszbkj', '4252', '2018-06-20 15:37:20', '2018-06-20 15:38:46', '2018-06-20 15:38:46'),
(6, 6, 't', '1', '1111', '2018-06-20 19:09:38', '2018-06-20 19:09:38', NULL),
(7, 7, 't', '2', '2222', '2018-06-20 19:10:22', '2018-06-20 19:10:22', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleado_id` bigint(20) UNSIGNED NOT NULL,
  `categoria_docente_id` tinyint(3) UNSIGNED NOT NULL,
  `titulo_docente` tinyint(3) UNSIGNED NOT NULL,
  `especializacion` tinyint(4) DEFAULT NULL,
  `postgrado` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`id`, `empleado_id`, `categoria_docente_id`, `titulo_docente`, `especializacion`, `postgrado`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 1, 3, 0, 0, '2018-04-20 16:21:50', '2018-04-21 16:44:10', '2018-04-21 16:44:10'),
(2, 4, 1, 1, 0, 0, '2018-04-22 03:50:14', '2018-04-22 03:50:20', '2018-04-22 03:50:20'),
(3, 5, 1, 1, 0, 0, '2018-06-20 15:37:20', '2018-06-20 15:38:46', '2018-06-20 15:38:46'),
(4, 6, 1, 2, 1, 1, '2018-06-20 19:09:39', '2018-06-20 19:09:39', NULL),
(5, 7, 1, 3, 0, 0, '2018-06-20 19:10:22', '2018-06-20 19:10:22', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `cargo_id` int(10) UNSIGNED NOT NULL,
  `horas_semanales` double UNSIGNED NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `tipo_personal` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `user_id`, `cargo_id`, `horas_semanales`, `fecha_ingreso`, `tipo_personal`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 3, 14, 22, '2018-04-02', 2, '2018-04-20 16:21:50', '2018-04-21 16:44:10', '2018-04-21 16:44:10'),
(4, 4, 13, 22, '2018-04-03', 2, '2018-04-22 03:50:14', '2018-04-22 03:50:20', '2018-04-22 03:50:20'),
(5, 5, 17, 16, '2018-06-07', 1, '2018-06-20 15:37:20', '2018-06-20 15:38:46', '2018-06-20 15:38:46'),
(6, 6, 17, 40, '2018-04-01', 1, '2018-06-20 19:09:38', '2018-06-20 19:09:38', NULL),
(7, 7, 12, 20, '2018-04-01', 2, '2018-06-20 19:10:22', '2018-06-20 19:10:22', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nomina`
--

CREATE TABLE `nomina` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleado_id` bigint(20) UNSIGNED NOT NULL,
  `codigo_nomina_id` int(10) UNSIGNED NOT NULL,
  `aumento_id` int(10) UNSIGNED NOT NULL,
  `monto` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestaciones_sociales`
--

CREATE TABLE `prestaciones_sociales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `recibo_prestaciones_sociales_id` bigint(20) UNSIGNED NOT NULL,
  `empleado_id` bigint(20) UNSIGNED NOT NULL,
  `monto` double DEFAULT NULL,
  `acumulado` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibo`
--

CREATE TABLE `recibo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quincena` varchar(1) DEFAULT NULL,
  `mes` varchar(2) DEFAULT NULL,
  `anio` varchar(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `recibo`
--

INSERT INTO `recibo` (`id`, `quincena`, `mes`, `anio`, `created_at`, `deleted_at`) VALUES
(1, '1', '3', '2018', '2018-06-27 18:53:36', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibo_cestaticket`
--

CREATE TABLE `recibo_cestaticket` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mes` varchar(2) NOT NULL,
  `anio` varchar(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `recibo_cestaticket`
--

INSERT INTO `recibo_cestaticket` (`id`, `mes`, `anio`, `created_at`, `updated_at`) VALUES
(1, '1', '2018', '2018-06-25 18:28:06', '2018-06-25 18:28:06'),
(12, '2', '2018', '2018-06-26 00:16:06', '2018-06-26 00:16:06'),
(13, '3', '2018', '2018-06-26 00:16:28', '2018-06-26 00:16:28'),
(15, '4', '2018', '2018-06-26 00:18:40', '2018-06-26 00:18:40'),
(16, '6', '2018', '2018-06-26 15:56:07', '2018-06-26 15:56:07'),
(17, '5', '2018', '2018-06-26 16:50:22', '2018-06-26 16:50:22'),
(18, '7', '2018', '2018-06-26 16:52:32', '2018-06-26 16:52:32'),
(19, '8', '2018', '2018-06-27 12:47:34', '2018-06-27 12:47:34'),
(20, '9', '2018', '2018-06-27 15:43:31', '2018-06-27 15:43:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibo_empleado`
--

CREATE TABLE `recibo_empleado` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `recibo_id` bigint(20) UNSIGNED NOT NULL,
  `empleado_id` bigint(20) UNSIGNED NOT NULL,
  `monto_total` double DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibo_prestaciones_sociales`
--

CREATE TABLE `recibo_prestaciones_sociales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trimestre` varchar(1) NOT NULL,
  `anio` varchar(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `recibo_prestaciones_sociales`
--

INSERT INTO `recibo_prestaciones_sociales` (`id`, `trimestre`, `anio`, `created_at`, `updated_at`) VALUES
(1, '1', '2018', '2018-04-20 19:18:48', NULL),
(2, '2', '2018', '2018-04-20 19:44:36', NULL),
(3, '3', '2018', '2018-04-20 19:44:36', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recordatorios`
--

CREATE TABLE `recordatorios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleado_id` bigint(20) UNSIGNED NOT NULL,
  `nota` varchar(500) NOT NULL,
  `fecha` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retroactivo`
--

CREATE TABLE `retroactivo` (
  `id` int(10) UNSIGNED NOT NULL,
  `aumento_id` int(10) UNSIGNED NOT NULL,
  `desde_mes` varchar(2) DEFAULT NULL,
  `desce_anio` varchar(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Administrador del Sistema', '2018-04-12 18:55:00', NULL),
(2, 'Directivo', '2018-04-12 18:55:00', NULL),
(3, 'Estructura de Costos', '2018-04-12 18:55:00', NULL),
(4, 'Nómina', '2018-04-12 18:55:00', NULL),
(5, 'Empleado', '2018-04-12 18:55:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cedula` varchar(8) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rol_id` tinyint(3) UNSIGNED NOT NULL,
  `remember_token` varchar(100) DEFAULT 'null',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `cedula`, `password`, `rol_id`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '22574804', '$2y$10$R9wuAUEDGerYQV2WEgrr1O6UOANluApiy782VS9qm07K/izB4O8Ri', 1, '2XfZAswxsoQmZ2MJXwgt29GCERAYaxJy1g6VPWNE9WPckU5uSU8LGvYp9ElZ', '2018-04-12 18:55:00', NULL, NULL),
(2, '23708575', '$2y$10$2qAHgLyaYbWJp/.19Vg/GeTUY8RA4pTA/7OCGc0eBRQ1RwBxgSTTa', 1, NULL, '2018-04-12 18:55:00', NULL, NULL),
(3, '222', '$2y$10$ACTEetaZfFYBZOZhK5r/KOMZ2NYDl9pqomzols5KEJG1QZrPqyjjO', 5, 'null', '2018-04-20 16:21:50', '2018-04-21 16:44:10', '2018-04-21 16:44:10'),
(4, 'qq', '$2y$10$dXTad0eJIEZMs9sX75vCdOQ.PyZWCsB0T5Rfg8tmFbADl9PPrO/su', 5, 'null', '2018-04-22 03:50:14', '2018-04-22 03:50:20', '2018-04-22 03:50:20'),
(5, '4252', '$2y$10$wYAzv5kwOizoHEauKRDxsuO0VXaH/h59p/ME87dDasAS2RsS7p34W', 2, 'null', '2018-06-20 15:37:20', '2018-06-20 15:38:46', '2018-06-20 15:38:46'),
(6, '1111', '$2y$10$V1Z77QGCAvNkcuM0xeqQI.X5KmGImmCTGECFNse9XDrnRgx7iXkX.', 2, 'null', '2018-06-20 19:09:38', '2018-06-20 19:09:38', NULL),
(7, '2222', '$2y$10$vqcit0HRtoWULfJ9Lb/g2OP45vO9OPbYrEofRP92zIBAPM9wbH9bm', 5, 'null', '2018-06-20 19:10:22', '2018-06-20 19:10:22', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrativo_obrero`
--
ALTER TABLE `administrativo_obrero`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_administrativo_obrero_empleado_idx` (`empleado_id`);

--
-- Indices de la tabla `aumento`
--
ALTER TABLE `aumento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria_docente`
--
ALTER TABLE `categoria_docente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cestaticket`
--
ALTER TABLE `cestaticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cestaticket_empleado_idx` (`empleado_id`),
  ADD KEY `fk_cestaticket_recibo_cestaticket_idx` (`recibo_cestaticket_id`);

--
-- Indices de la tabla `codigo_nomina`
--
ALTER TABLE `codigo_nomina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_codigo_nomina_configuracion_idx` (`configuracion_id`);

--
-- Indices de la tabla `codigo_nomina_recibo_empleado`
--
ALTER TABLE `codigo_nomina_recibo_empleado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_codigo_nomina_empleado_codigo_nomina_idx` (`codigo_nomina_id`),
  ADD KEY `fk_codigo_nomina_recibo_recibo_empleado_idx` (`recibo_empleado_id`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuracion_empleado`
--
ALTER TABLE `configuracion_empleado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_configuracion_empleado_empleado_idx` (`empleado_id`);

--
-- Indices de la tabla `configuracion_tipo_empleado`
--
ALTER TABLE `configuracion_tipo_empleado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_configuracion_tipo_empleado_configuracion_idx` (`configuracion_id`);

--
-- Indices de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_datos_personales_empleado_idx` (`empleado_id`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_docente_categoria_docente_idx` (`categoria_docente_id`),
  ADD KEY `fk_docente_empleado_id_idx` (`empleado_id`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_empleado_user_idx` (`user_id`),
  ADD KEY `fk_empleado_cargo_idx` (`cargo_id`);

--
-- Indices de la tabla `nomina`
--
ALTER TABLE `nomina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nomina_empleado_idx` (`empleado_id`),
  ADD KEY `fk_nomina_codigo_nomina_idx` (`codigo_nomina_id`),
  ADD KEY `fk_nomina_aumento_idx` (`aumento_id`);

--
-- Indices de la tabla `prestaciones_sociales`
--
ALTER TABLE `prestaciones_sociales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_prestaciones_sociales_empleado_idx` (`empleado_id`),
  ADD KEY `fk_prestaciones_sociales_recibo_prestaciones_sociales` (`recibo_prestaciones_sociales_id`);

--
-- Indices de la tabla `recibo`
--
ALTER TABLE `recibo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recibo_cestaticket`
--
ALTER TABLE `recibo_cestaticket`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recibo_empleado`
--
ALTER TABLE `recibo_empleado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_recibo_empleado_recibo_idx` (`recibo_id`),
  ADD KEY `fk_recibo_empleado_empleado_idx` (`empleado_id`);

--
-- Indices de la tabla `recibo_prestaciones_sociales`
--
ALTER TABLE `recibo_prestaciones_sociales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recordatorios`
--
ALTER TABLE `recordatorios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_prestaciones_sociales_empleado_idx` (`empleado_id`);

--
-- Indices de la tabla `retroactivo`
--
ALTER TABLE `retroactivo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_retroactivo_aumento_idx` (`aumento_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_id_idx_idx` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrativo_obrero`
--
ALTER TABLE `administrativo_obrero`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `aumento`
--
ALTER TABLE `aumento`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `categoria_docente`
--
ALTER TABLE `categoria_docente`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cestaticket`
--
ALTER TABLE `cestaticket`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `codigo_nomina`
--
ALTER TABLE `codigo_nomina`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `codigo_nomina_recibo_empleado`
--
ALTER TABLE `codigo_nomina_recibo_empleado`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `configuracion_empleado`
--
ALTER TABLE `configuracion_empleado`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `configuracion_tipo_empleado`
--
ALTER TABLE `configuracion_tipo_empleado`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `nomina`
--
ALTER TABLE `nomina`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `prestaciones_sociales`
--
ALTER TABLE `prestaciones_sociales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recibo`
--
ALTER TABLE `recibo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `recibo_cestaticket`
--
ALTER TABLE `recibo_cestaticket`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `recibo_empleado`
--
ALTER TABLE `recibo_empleado`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recibo_prestaciones_sociales`
--
ALTER TABLE `recibo_prestaciones_sociales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `recordatorios`
--
ALTER TABLE `recordatorios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `retroactivo`
--
ALTER TABLE `retroactivo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrativo_obrero`
--
ALTER TABLE `administrativo_obrero`
  ADD CONSTRAINT `fk_administrativo_obrero_empleado` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cestaticket`
--
ALTER TABLE `cestaticket`
  ADD CONSTRAINT `fk_cestaticket_empleado` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cestaticket_recibo_cestaticket` FOREIGN KEY (`recibo_cestaticket_id`) REFERENCES `recibo_cestaticket` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `codigo_nomina`
--
ALTER TABLE `codigo_nomina`
  ADD CONSTRAINT `fk_codigo_nomina_configuracion` FOREIGN KEY (`configuracion_id`) REFERENCES `configuracion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `codigo_nomina_recibo_empleado`
--
ALTER TABLE `codigo_nomina_recibo_empleado`
  ADD CONSTRAINT `fk_codigo_nomina_recibo_empleado_codigo_nomina` FOREIGN KEY (`codigo_nomina_id`) REFERENCES `codigo_nomina` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_codigo_nomina_recibo_empleado_recibo_empleado` FOREIGN KEY (`recibo_empleado_id`) REFERENCES `recibo_empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `configuracion_empleado`
--
ALTER TABLE `configuracion_empleado`
  ADD CONSTRAINT `fk_configuracion_empleado_empleado` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `configuracion_tipo_empleado`
--
ALTER TABLE `configuracion_tipo_empleado`
  ADD CONSTRAINT `fk_configuracion_tipo_empleado_configuracion` FOREIGN KEY (`configuracion_id`) REFERENCES `configuracion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  ADD CONSTRAINT `fk_datos_personales_empleado` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `fk_docente_categoria_docente` FOREIGN KEY (`categoria_docente_id`) REFERENCES `categoria_docente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_docente_empleado_id` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `fk_empleado_cargo` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_empleado_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `nomina`
--
ALTER TABLE `nomina`
  ADD CONSTRAINT `fk_nomina_aumento` FOREIGN KEY (`aumento_id`) REFERENCES `aumento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nomina_codigo_nomina` FOREIGN KEY (`codigo_nomina_id`) REFERENCES `codigo_nomina` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nomina_empleado` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `prestaciones_sociales`
--
ALTER TABLE `prestaciones_sociales`
  ADD CONSTRAINT `fk_prestaciones_sociales_empleado` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_prestaciones_sociales_recibo_prestaciones_sociales` FOREIGN KEY (`recibo_prestaciones_sociales_id`) REFERENCES `recibo_prestaciones_sociales` (`id`);

--
-- Filtros para la tabla `recibo_empleado`
--
ALTER TABLE `recibo_empleado`
  ADD CONSTRAINT `fk_recibo_empleado_empleado` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_recibo_empleado_recibo` FOREIGN KEY (`recibo_id`) REFERENCES `recibo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `recordatorios`
--
ALTER TABLE `recordatorios`
  ADD CONSTRAINT `fk_recordatorios_empleado` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `retroactivo`
--
ALTER TABLE `retroactivo`
  ADD CONSTRAINT `fk_retroactivo_aumento` FOREIGN KEY (`aumento_id`) REFERENCES `aumento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_rol` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-02-2018 a las 17:08:48
-- Versión del servidor: 10.1.22-MariaDB
-- Versión de PHP: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


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
  `nivel_instruccion` varchar(20) DEFAULT NULL,
  `clasificacion_grado` varchar(15) DEFAULT NULL,
  `clasificacion_nivel` varchar(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `administrativo_obrero`
--

INSERT INTO `administrativo_obrero` (`id`, `empleado_id`, `nivel_instruccion`, `clasificacion_grado`, `clasificacion_nivel`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 19, '2', '1', '5', '2018-02-20 18:17:37', '2018-02-22 03:03:25', '2018-02-22 03:03:25');

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
  `descripcion` varchar(100) DEFAULT NULL,
  `abreviatura` varchar(5) DEFAULT NULL,
  `tipo_empleado_id` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id`, `descripcion`, `abreviatura`, `tipo_empleado_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrador del Sistema', 'ADS', 1, '2018-02-07 21:07:29', NULL, NULL),
(2, 'Secretaria', 'S', 2, '2018-02-07 21:07:30', NULL, NULL),
(3, 'Auxiliar Administrativo', 'AA', 2, '2018-02-07 21:07:30', NULL, NULL),
(4, 'Recepcionista', 'R', 2, '2018-02-07 21:07:30', NULL, NULL),
(5, 'Instructor', 'I', 2, '2018-02-07 21:07:31', NULL, NULL),
(6, 'Secretaria Auxiliar', 'SA', 2, '2018-02-07 21:07:31', NULL, NULL),
(7, 'Sacerdote', 'SAC', 2, '2018-02-07 21:07:31', NULL, NULL),
(8, 'Obrero', 'O', 3, '2018-02-07 21:07:31', NULL, NULL),
(9, 'Jefe de Mantenimiento', 'JM', 3, '2018-02-07 21:07:31', NULL, NULL),
(10, 'Vigilante Nocturno', 'VN', 3, '2018-02-07 21:07:31', NULL, NULL),
(11, 'Vigilante Diurno', 'VD', 3, '2018-02-07 21:07:31', NULL, NULL),
(12, 'Maestra', 'M', 4, '2018-02-07 21:07:31', NULL, NULL),
(13, 'Profesor por Hora', 'PPH', 4, '2018-02-07 21:07:31', NULL, NULL),
(14, 'Coordinador', 'C', 4, '2018-02-07 21:07:31', NULL, NULL),
(15, 'Profesor Tiempo Completo', 'PTC', 4, '2018-02-07 21:07:31', NULL, NULL),
(16, 'Jefe de Departamento', 'JD', 4, '2018-02-07 21:07:32', NULL, NULL),
(17, 'Director', 'D', 4, '2018-02-07 21:07:32', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_docente`
--

CREATE TABLE `categoria_docente` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `abreviatura` varchar(3) NOT NULL,
  `categoria` varchar(45) NOT NULL,
  `anios` int(10) UNSIGNED NOT NULL,
  `esp_post` tinyint(4) NOT NULL,
  `valor_hora` double UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria_docente`
--

INSERT INTO `categoria_docente` (`id`, `abreviatura`, `categoria`, `anios`, `esp_post`, `valor_hora`, `created_at`, `updated_at`) VALUES
(1, 'D-1', 'Docente 1', 3, 0, 3501.73, '2018-02-07 21:09:35', NULL),
(2, 'D-1', 'Docente 1', 3, 0, 3501.73, '2018-02-07 21:09:55', NULL),
(3, 'D-2', 'Docente 2', 7, 0, 3605.92, '2018-02-07 21:09:55', NULL),
(4, 'D-3', 'Docente 3', 11, 0, 3754.67, '2018-02-07 21:09:55', NULL),
(5, 'D-4', 'Docente 4', 16, 0, 3902.61, '2018-02-07 21:09:56', NULL),
(6, 'D-5', 'Docente 5', 21, 1, 4494.91, '2018-02-07 21:09:56', NULL),
(7, 'D-6', 'Docente 6', 0, 1, 5189.99, '2018-02-07 21:09:56', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cestaticket`
--

CREATE TABLE `cestaticket` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleado_id` bigint(20) UNSIGNED NOT NULL,
  `cestaticket_valor_id` tinyint(3) UNSIGNED NOT NULL,
  `cestaticket_valor` double DEFAULT NULL,
  `asistencias` int(11) DEFAULT NULL,
  `asignacion` double DEFAULT NULL,
  `faltas` int(11) DEFAULT NULL,
  `descontado` double DEFAULT NULL,
  `fecha` date NOT NULL,
  `total` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cestaticket_valor`
--

CREATE TABLE `cestaticket_valor` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `tipo_empleado_id` tinyint(3) UNSIGNED NOT NULL,
  `dia` tinyint(4) DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigo_nomina`
--

CREATE TABLE `codigo_nomina` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(8) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `tipo_nomina_id` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `configuracion` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `configuracion`, `created_at`, `updated_at`) VALUES
(1, 'Prima por Ejercicio Docente', '2018-02-07 20:56:00', NULL),
(2, 'Prima por Transporte', '2018-02-07 20:56:00', NULL),
(3, 'Prima por Antiguedad', '2018-02-07 20:56:00', NULL),
(4, 'Prima de Jerarquía', '2018-02-07 20:56:00', NULL),
(5, 'Prima por Especialización o Postgrado', '2018-02-07 20:56:00', NULL),
(6, 'Bono Vacacional', '2018-02-07 20:56:00', NULL),
(7, 'Aguinaldos', '2018-02-07 20:56:01', NULL),
(8, 'Retroactivos', '2018-02-07 20:56:01', NULL),
(9, 'Prima por Profesionalización', '2018-02-07 20:56:01', NULL),
(10, 'Seguro Social Obligatorio', '2018-02-07 20:56:01', NULL),
(11, 'Paro Forzoso', '2018-02-07 20:56:01', NULL),
(12, 'Fondo de Ahorro Obligatorio de Vivienda', '2018-02-07 20:56:01', NULL),
(13, 'Cestaickes', '2018-02-07 20:56:01', NULL),
(14, 'Unidad Tributaria', '2018-02-07 20:56:01', NULL);

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
(1, 16, 0, 1, '2018-02-20 17:25:21', NULL, NULL),
(2, 17, 1, 1, '2018-02-20 17:25:21', NULL, NULL),
(3, 18, 1, 1, '2018-02-20 17:30:16', NULL, NULL),
(4, 1, 0, 0, '2018-02-21 03:16:25', '2018-02-22 02:17:47', NULL),
(5, 10, 0, 0, '2018-02-21 03:16:25', NULL, NULL),
(6, 19, 1, 0, '2018-02-21 04:06:03', '2018-02-22 03:03:25', '2018-02-22 03:03:25'),
(7, 20, 1, 1, '2018-02-22 02:05:37', '2018-02-22 02:05:37', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion_global`
--

CREATE TABLE `configuracion_global` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `configuracion_id` tinyint(3) UNSIGNED NOT NULL,
  `cantidad` double DEFAULT NULL,
  `tipo` varchar(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `configuracion_global`
--

INSERT INTO `configuracion_global` (`id`, `configuracion_id`, `cantidad`, `tipo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 13, 61, 'UT', NULL, NULL, NULL),
(2, 14, 300, 'BS', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_personales`
--

CREATE TABLE `datos_personales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleado_id` bigint(20) UNSIGNED NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `cedula` varchar(12) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `datos_personales`
--

INSERT INTO `datos_personales` (`id`, `empleado_id`, `nombres`, `apellidos`, `cedula`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Paola del Carmen', 'Brito Sánchez', '22574804', '2018-02-07 21:11:04', '2018-02-22 02:17:28', NULL),
(3, 10, 'Virgilio Enrique', 'La Rosa Romero', '23708575', '2018-02-19 22:53:54', '2018-02-19 22:53:54', NULL),
(9, 16, 'Elizabet', 'Martínez Jimenez', '5723202', '2018-02-19 23:56:43', '2018-02-19 23:56:43', NULL),
(10, 17, 'Yaccely', 'Aguilera', '11424077', '2018-02-20 00:07:54', '2018-02-20 00:07:54', NULL),
(11, 18, 'Karla', 'Alcalá C.', '19673684', '2018-02-20 01:00:38', '2018-02-20 01:00:38', NULL),
(12, 19, 'qqq', 'qqq', '1111', '2018-02-20 18:17:37', '2018-02-22 03:03:26', '2018-02-22 03:03:26'),
(13, 20, 'María Cecilia', 'Alves', '84602479', '2018-02-22 02:05:36', '2018-02-22 02:05:36', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleado_id` bigint(20) UNSIGNED NOT NULL,
  `categoria_docente_id` tinyint(3) UNSIGNED NOT NULL,
  `titulo_docente_id` tinyint(3) UNSIGNED NOT NULL,
  `especializacion` tinyint(4) DEFAULT NULL,
  `postgrado` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`id`, `empleado_id`, `categoria_docente_id`, `titulo_docente_id`, `especializacion`, `postgrado`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 16, 1, 2, NULL, 1, '2018-02-19 23:56:43', '2018-02-19 23:56:43', NULL),
(2, 17, 1, 1, NULL, NULL, '2018-02-20 00:07:54', '2018-02-20 00:07:54', NULL),
(3, 18, 1, 1, NULL, NULL, '2018-02-20 01:00:38', '2018-02-20 01:00:38', NULL),
(4, 20, 1, 1, NULL, NULL, '2018-02-22 02:05:37', '2018-02-22 02:05:37', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `cargo_id` int(10) UNSIGNED NOT NULL,
  `horas_semanales` float UNSIGNED NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `antiguedad` float NOT NULL,
  `tipo_personal_id` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `user_id`, `cargo_id`, `horas_semanales`, `fecha_ingreso`, `antiguedad`, `tipo_personal_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 0, '2018-02-07', 0, 1, '2018-02-07 21:08:16', '2018-02-22 02:17:46', NULL),
(10, 19, 1, 0, '2017-02-17', 1, 1, '2018-02-19 22:53:54', '2018-02-19 22:53:54', NULL),
(16, 28, 17, 36, '1986-10-01', 31, 2, '2018-02-19 23:56:42', '2018-02-19 23:56:42', NULL),
(17, 29, 12, 33.33, '2011-10-23', 6, 3, '2018-02-20 00:07:54', '2018-02-20 00:07:54', NULL),
(18, 31, 12, 33.33, '2016-01-01', 2, 3, '2018-02-20 01:00:38', '2018-02-20 01:00:38', NULL),
(19, 32, 8, 15, '2018-02-08', 0, 8, '2018-02-20 18:17:37', '2018-02-22 03:03:26', '2018-02-22 03:03:26'),
(20, 33, 12, 33.33, '2016-03-01', 1, 3, '2018-02-22 02:05:35', '2018-02-22 02:05:35', NULL);

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
-- Estructura de tabla para la tabla `recibo`
--

CREATE TABLE `recibo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `empleado_id` bigint(20) UNSIGNED NOT NULL,
  `quincena` varchar(1) DEFAULT NULL,
  `mes` varchar(2) DEFAULT NULL,
  `anio` varchar(4) DEFAULT NULL,
  `codigo_nomina_id` int(10) UNSIGNED NOT NULL,
  `monto` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retroactivo`
--

CREATE TABLE `retroactivo` (
  `id` int(10) UNSIGNED NOT NULL,
  `aumento_id` int(10) UNSIGNED NOT NULL,
  `mes` varchar(45) DEFAULT NULL,
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
(1, 'Administrador del Sistema', '2018-02-07 20:39:28', NULL),
(2, 'Directivo', '2018-02-07 20:45:24', NULL),
(3, 'Estructura de Costos', '2018-02-07 20:45:24', NULL),
(4, 'Nómina', '2018-02-07 20:45:24', NULL),
(5, 'Empleado', '2018-02-07 20:45:24', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_empleado`
--

CREATE TABLE `tipo_empleado` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_empleado`
--

INSERT INTO `tipo_empleado` (`id`, `tipo`, `created_at`, `updated_at`) VALUES
(1, 'Administrador del Sistema', '2018-02-07 20:50:05', NULL),
(2, 'Administrativo', '2018-02-07 20:50:54', NULL),
(3, 'Obrero', '2018-02-07 20:50:54', NULL),
(4, 'Docente', '2018-02-07 20:50:54', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_nomina`
--

CREATE TABLE `tipo_nomina` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_nomina`
--

INSERT INTO `tipo_nomina` (`id`, `tipo`, `created_at`, `updated_at`) VALUES
(1, 'Asignación', '2018-02-07 21:11:54', NULL),
(2, 'Deducción', '2018-02-07 21:11:54', NULL),
(3, 'Retención', '2018-02-07 21:11:54', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_personal`
--

CREATE TABLE `tipo_personal` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_personal`
--

INSERT INTO `tipo_personal` (`id`, `tipo`, `created_at`, `updated_at`) VALUES
(1, 'Administrador del Sistema', '2018-02-07 21:01:22', NULL),
(2, 'Directivo', '2018-02-07 21:01:22', NULL),
(3, 'Docente de Preescolar', '2018-02-07 21:01:22', NULL),
(4, 'Docente de Básica 1º-6º', '2018-02-07 21:01:22', NULL),
(5, 'Docente de Básica 7º-9º y Diversificado', '2018-02-07 21:01:22', NULL),
(6, 'Bienestar Estudiantil', '2018-02-07 21:01:22', NULL),
(7, 'Administrativo', '2018-02-07 21:01:23', NULL),
(8, 'Obreros', '2018-02-07 21:01:23', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulo_docente`
--

CREATE TABLE `titulo_docente` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `abreviatura` varchar(5) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `titulo_docente`
--

INSERT INTO `titulo_docente` (`id`, `abreviatura`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'LE', 'Licenciado en Educación', '2018-02-07 21:10:12', NULL),
(2, 'LE/P', 'Licenciado en Educación/Postgrado', '2018-02-07 21:10:12', NULL),
(3, 'PND', 'Profesional No Docente', '2018-02-07 21:10:12', NULL),
(4, 'PG', 'Profesor Graduado', '2018-02-07 21:10:12', NULL),
(5, 'TSU', 'Técnico Superior Universitario', '2018-02-07 21:10:12', NULL),
(6, 'PG/E', 'Licenciado en Educación/Especialización', '2018-02-07 21:10:12', NULL),
(7, 'NG', 'No Graduado', '2018-02-07 21:10:13', NULL);

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
(1, '22574804', '$2y$10$R9wuAUEDGerYQV2WEgrr1O6UOANluApiy782VS9qm07K/izB4O8Ri', 1, 'D6kDA5QoyH0Nu2hF9cPnOQ6Pb2MsMEjIpUlytQrm0narrQlKipuynUtTeaIz', '2018-02-07 20:45:58', NULL, NULL),
(19, '23708575', '$2y$10$2qAHgLyaYbWJp/.19Vg/GeTUY8RA4pTA/7OCGc0eBRQ1RwBxgSTTa', 1, 'null', '2018-02-19 22:53:50', '2018-02-19 22:53:50', NULL),
(28, '5723202', '$2y$10$NPkQBTydZGGoFXQmrquukuaysfSzb3MpCeHGI0TgMlgK4xiaUJCIq', 2, 'null', '2018-02-19 23:56:37', '2018-02-19 23:56:37', NULL),
(29, '11424077', '$2y$10$m1eFv2c3s2HTR0Ne004la.2.kJ2L0BZIF8LyLozfpJGNcN0BE7/Fm', 5, 'null', '2018-02-20 00:07:51', '2018-02-20 00:07:51', NULL),
(31, '19673684', '$2y$10$/Zfb8w.SfEl5YtWesRgMQ.30h.oExRtqkjW0t7r/VT9T9OruZyTz6', 5, 'null', '2018-02-20 01:00:38', '2018-02-20 01:00:38', NULL),
(32, '1111', '$2y$10$DWctS4EVFPhNpoh1BCKH9unMAQr6lb5xjREH9n19yALucWMKtzzXm', 5, 'null', '2018-02-20 18:17:32', '2018-02-22 03:03:26', '2018-02-22 03:03:26'),
(33, '84602479', '$2y$10$k/xk/nP7ybiz/yOixzcy9OLOpyWa6Gnr7a/OyusINh.Lwwe5Aw8BO', 5, 'null', '2018-02-22 02:05:35', '2018-02-22 02:05:35', NULL);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cargo_tipo_empleado_idx` (`tipo_empleado_id`);

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
  ADD KEY `fk_cestaticket_cestaticket_valor_idx` (`cestaticket_valor_id`);

--
-- Indices de la tabla `cestaticket_valor`
--
ALTER TABLE `cestaticket_valor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cestaticket_valor_tipo_empleado_idx` (`tipo_empleado_id`);

--
-- Indices de la tabla `codigo_nomina`
--
ALTER TABLE `codigo_nomina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_codigo_nomina_tipo_nomina_idx` (`tipo_nomina_id`);

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
-- Indices de la tabla `configuracion_global`
--
ALTER TABLE `configuracion_global`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_configuracion_global_prima_idx` (`configuracion_id`);

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
  ADD KEY `fk_docente_titulo_docente_idx` (`titulo_docente_id`),
  ADD KEY `fk_docente_empleado_id_idx` (`empleado_id`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_empleado_user_idx` (`user_id`),
  ADD KEY `fk_empleado_cargo_idx` (`cargo_id`),
  ADD KEY `fk_empleado_tipo_emp_ec_idx` (`tipo_personal_id`);

--
-- Indices de la tabla `nomina`
--
ALTER TABLE `nomina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nomina_empleado_idx` (`empleado_id`),
  ADD KEY `fk_nomina_codigo_nomina_idx` (`codigo_nomina_id`),
  ADD KEY `fk_nomina_aumento_idx` (`aumento_id`);

--
-- Indices de la tabla `recibo`
--
ALTER TABLE `recibo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_recibo_empleado_idx` (`empleado_id`),
  ADD KEY `fk_recibo_codigo_nomina_idx` (`codigo_nomina_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `tipo_empleado`
--
ALTER TABLE `tipo_empleado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_nomina`
--
ALTER TABLE `tipo_nomina`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_personal`
--
ALTER TABLE `tipo_personal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `titulo_docente`
--
ALTER TABLE `titulo_docente`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `cestaticket`
--
ALTER TABLE `cestaticket`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cestaticket_valor`
--
ALTER TABLE `cestaticket_valor`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `codigo_nomina`
--
ALTER TABLE `codigo_nomina`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `configuracion_empleado`
--
ALTER TABLE `configuracion_empleado`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `configuracion_global`
--
ALTER TABLE `configuracion_global`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `nomina`
--
ALTER TABLE `nomina`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `recibo`
--
ALTER TABLE `recibo`
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
-- AUTO_INCREMENT de la tabla `tipo_empleado`
--
ALTER TABLE `tipo_empleado`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tipo_nomina`
--
ALTER TABLE `tipo_nomina`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `titulo_docente`
--
ALTER TABLE `titulo_docente`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrativo_obrero`
--
ALTER TABLE `administrativo_obrero`
  ADD CONSTRAINT `fk_administrativo_obrero_empleado` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD CONSTRAINT `fk_cargo_tipo_empleado` FOREIGN KEY (`tipo_empleado_id`) REFERENCES `tipo_empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cestaticket`
--
ALTER TABLE `cestaticket`
  ADD CONSTRAINT `fk_cestaticket_cestaticket_valor` FOREIGN KEY (`cestaticket_valor_id`) REFERENCES `cestaticket_valor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cestaticket_empleado` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cestaticket_valor`
--
ALTER TABLE `cestaticket_valor`
  ADD CONSTRAINT `fk_cestaticket_valor_tipo_empleado` FOREIGN KEY (`tipo_empleado_id`) REFERENCES `tipo_empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `codigo_nomina`
--
ALTER TABLE `codigo_nomina`
  ADD CONSTRAINT `fk_codigo_nomina_tipo_nomina` FOREIGN KEY (`tipo_nomina_id`) REFERENCES `tipo_nomina` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `configuracion_empleado`
--
ALTER TABLE `configuracion_empleado`
  ADD CONSTRAINT `fk_configuracion_empleado_empleado` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `configuracion_global`
--
ALTER TABLE `configuracion_global`
  ADD CONSTRAINT `fk_configuracion_global_prima` FOREIGN KEY (`configuracion_id`) REFERENCES `configuracion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_docente_empleado_id` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_docente_titulo_docente` FOREIGN KEY (`titulo_docente_id`) REFERENCES `titulo_docente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `fk_empleado_cargo` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_empleado_tipo_personal` FOREIGN KEY (`tipo_personal_id`) REFERENCES `tipo_personal` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_empleado_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `nomina`
--
ALTER TABLE `nomina`
  ADD CONSTRAINT `fk_nomina_aumento` FOREIGN KEY (`aumento_id`) REFERENCES `aumento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nomina_codigo_nomina` FOREIGN KEY (`codigo_nomina_id`) REFERENCES `codigo_nomina` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nomina_empleado` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `recibo`
--
ALTER TABLE `recibo`
  ADD CONSTRAINT `fk_recibo_codigo_nomina` FOREIGN KEY (`codigo_nomina_id`) REFERENCES `codigo_nomina` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_recibo_empleado` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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

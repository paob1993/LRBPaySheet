-- Volcado de datos para la tabla `empleado`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_test`;
INSERT INTO `db_test`.`empleado` (`id`, `cargo_id`, `horas_semanales`, `fecha_ingreso`, `tipo_personal`, `nombres`, `apellidos`, `cedula`, `sso`, `lph`, `created_at`, `updated_at`, `deleted_at`) VALUES (1, 12, 12, '1995-09-01', 4, 'Jesús', 'González D.', '3669946', 1, 0, '2018-12-13 13:33:38', '2018-12-13 13:33:38', NULL);
INSERT INTO `db_test`.`empleado` (`id`, `cargo_id`, `horas_semanales`, `fecha_ingreso`, `tipo_personal`, `nombres`, `apellidos`, `cedula`, `sso`, `lph`, `created_at`, `updated_at`, `deleted_at`) VALUES (2, 15, 36, '2006-09-01', 4, 'Beatriz', 'López', '3711561', 1, 0, '2018-12-13 13:36:13', '2018-12-13 13:36:52', NULL);
INSERT INTO `db_test`.`empleado` (`id`, `cargo_id`, `horas_semanales`, `fecha_ingreso`, `tipo_personal`, `nombres`, `apellidos`, `cedula`, `sso`, `lph`, `created_at`, `updated_at`, `deleted_at`) VALUES (3, 11, 33.33, '2015-09-01', 3, 'Johana', 'Medina', '20635976', 1, 1, '2018-12-13 13:39:16', '2018-12-13 13:39:16', NULL);
INSERT INTO `db_test`.`empleado` (`id`, `cargo_id`, `horas_semanales`, `fecha_ingreso`, `tipo_personal`, `nombres`, `apellidos`, `cedula`, `sso`, `lph`, `created_at`, `updated_at`, `deleted_at`) VALUES (4, 2, 30, '2013-09-01', 6, 'Laura', 'Dávila', '17697720', 1, 1, '2018-12-13 13:43:35', '2018-12-13 13:43:35', NULL);
INSERT INTO `db_test`.`empleado` (`id`, `cargo_id`, `horas_semanales`, `fecha_ingreso`, `tipo_personal`, `nombres`, `apellidos`, `cedula`, `sso`, `lph`, `created_at`, `updated_at`, `deleted_at`) VALUES (5, 1, 30, '2006-09-01', 6, 'Maricarmen', 'Figueroa', '8268517', 1, 1, '2018-12-13 13:46:45', '2018-12-13 13:46:45', NULL);
INSERT INTO `db_test`.`empleado` (`id`, `cargo_id`, `horas_semanales`, `fecha_ingreso`, `tipo_personal`, `nombres`, `apellidos`, `cedula`, `sso`, `lph`, `created_at`, `updated_at`, `deleted_at`) VALUES (6, 2, 30, '2001-09-01', 6, 'Maristela', 'Franco', '5489672', 1, 1, '2018-12-13 13:47:36', '2018-12-13 13:47:36', NULL);
INSERT INTO `db_test`.`empleado` (`id`, `cargo_id`, `horas_semanales`, `fecha_ingreso`, `tipo_personal`, `nombres`, `apellidos`, `cedula`, `sso`, `lph`, `created_at`, `updated_at`, `deleted_at`) VALUES (7, 7, 40, '2015-09-01', 7, 'Maximo', 'Acosta', '8300057', 1, 1, '2018-12-13 13:48:15', '2018-12-13 13:48:15', NULL);
INSERT INTO `db_test`.`empleado` (`id`, `cargo_id`, `horas_semanales`, `fecha_ingreso`, `tipo_personal`, `nombres`, `apellidos`, `cedula`, `sso`, `lph`, `created_at`, `updated_at`, `deleted_at`) VALUES (8, 7, 25, '2006-09-01', 7, 'María', 'Lunar', '3826180', 1, 1, '2018-12-13 13:49:36', '2018-12-13 13:49:36', NULL);
INSERT INTO `db_test`.`empleado` (`id`, `cargo_id`, `horas_semanales`, `fecha_ingreso`, `tipo_personal`, `nombres`, `apellidos`, `cedula`, `sso`, `lph`, `created_at`, `updated_at`, `deleted_at`) VALUES (9, 9, 40, '1995-09-01', 7, 'Antonio', 'Rojas', '11419046', 1, 1, '2018-12-13 13:50:23', '2018-12-13 13:50:23', NULL);

COMMIT;

-- Volcado de datos para la tabla `administrativo`

INSERT INTO `db_test`.`administrativo` (`id`, `empleado_id`, `nivel_instruccion`, `clasificacion_administrativo_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 2, 1, '2018-12-13 13:43:35', '2018-12-13 13:43:35', NULL),
(2, 5, 3, 57, '2018-12-13 13:46:45', '2018-12-13 13:46:45', NULL),
(3, 6, 2, 9, '2018-12-13 13:47:36', '2018-12-13 13:47:36', NULL);

COMMIT;

-- Volcado de datos para la tabla `docente`

INSERT INTO `db_test`.`docente` (`id`, `empleado_id`, `categoria_docente_id`, `titulo_docente`, `especializacion`, `postgrado`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 4, 7, 0, 0, '2018-12-13 13:33:38', '2018-12-13 13:33:39', NULL),
(2, 2, 4, 6, 1, 0, '2018-12-13 13:36:13', '2018-12-13 13:36:53', NULL),
(3, 3, 2, 1, 0, 0, '2018-12-13 13:39:16', '2018-12-13 13:39:16', NULL);

COMMIT;

-- Volcado de datos para la tabla `obrero`

INSERT INTO `db_test`.`obrero` (`id`, `empleado_id`, `nivel_instruccion`, `clasificacion_obrero_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 7, 1, 1, '2018-12-13 13:48:15', '2018-12-13 13:48:15', NULL),
(2, 8, 1, 6, '2018-12-13 13:49:36', '2018-12-13 13:49:36', NULL),
(3, 9, 3, 65, '2018-12-13 13:50:23', '2018-12-13 13:50:23', NULL);

COMMIT;
-- MySQL Script generated by MySQL Workbench
-- 12/13/18 11:02:55
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema db_test
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `db_test` ;

-- -----------------------------------------------------
-- Schema db_test
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_test` DEFAULT CHARACTER SET utf8 ;
USE `db_test` ;

-- -----------------------------------------------------
-- Table `db_test`.`rol`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_test`.`rol` ;

CREATE TABLE IF NOT EXISTS `db_test`.`rol` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(25) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `updated_at` TIMESTAMP NULL DEFAULT null,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `db_test`.`cargo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_test`.`cargo` ;

CREATE TABLE IF NOT EXISTS `db_test`.`cargo` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `abreviatura` VARCHAR(5) NULL,
  `descripcion` VARCHAR(100) NULL,
  `tipo_empleado` INT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `updated_at` TIMESTAMP NULL DEFAULT null,
  `deleted_at` TIMESTAMP NULL DEFAULT null,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `db_test`.`empleado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_test`.`empleado` ;

CREATE TABLE IF NOT EXISTS `db_test`.`empleado` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `cargo_id` INT UNSIGNED NOT NULL,
  `horas_semanales` DOUBLE UNSIGNED NOT NULL,
  `fecha_ingreso` DATE NOT NULL,
  `tipo_personal` INT UNSIGNED NOT NULL,
  `nombres` VARCHAR(100) NOT NULL,
  `apellidos` VARCHAR(100) NOT NULL,
  `cedula` VARCHAR(12) NOT NULL,
  `sso` TINYINT(1) NOT NULL DEFAULT 0,
  `lph` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `updated_at` TIMESTAMP NULL DEFAULT null,
  `deleted_at` TIMESTAMP NULL DEFAULT null,
  INDEX `fk_empleado_cargo_idx` (`cargo_id` ASC),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_empleado_cargo`
    FOREIGN KEY (`cargo_id`)
    REFERENCES `db_test`.`cargo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `db_test`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_test`.`user` ;

CREATE TABLE IF NOT EXISTS `db_test`.`user` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `cedula` VARCHAR(12) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `rol_id` INT UNSIGNED NOT NULL,
  `empleado_id` INT UNSIGNED NULL,
  `remember_token` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `updated_at` TIMESTAMP NULL DEFAULT null,
  PRIMARY KEY (`id`),
  INDEX `fk_user_rol_idx` (`rol_id` ASC),
  INDEX `fk_user_empleado_idx` (`empleado_id` ASC),
  CONSTRAINT `fk_user_rol`
    FOREIGN KEY (`rol_id`)
    REFERENCES `db_test`.`rol` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_empleado`
    FOREIGN KEY (`empleado_id`)
    REFERENCES `db_test`.`empleado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `db_test`.`categoria_docente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_test`.`categoria_docente` ;

CREATE TABLE IF NOT EXISTS `db_test`.`categoria_docente` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `abreviatura` VARCHAR(3) NOT NULL,
  `categoria` VARCHAR(45) NOT NULL,
  `anos` INT UNSIGNED NOT NULL,
  `esp_post` TINYINT(1) NOT NULL,
  `valor_hora` DOUBLE UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `db_test`.`docente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_test`.`docente` ;

CREATE TABLE IF NOT EXISTS `db_test`.`docente` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `empleado_id` INT UNSIGNED NOT NULL,
  `categoria_docente_id` INT UNSIGNED NOT NULL,
  `titulo_docente` INT UNSIGNED NOT NULL,
  `especializacion` TINYINT(1) NOT NULL DEFAULT 0,
  `postgrado` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `updated_at` TIMESTAMP NULL DEFAULT null,
  `deleted_at` TIMESTAMP NULL DEFAULT null,
  PRIMARY KEY (`id`),
  INDEX `fk_docente_empleado_idx` (`empleado_id` ASC),
  INDEX `fk_docente_categoriaDocente_idx` (`categoria_docente_id` ASC),
  CONSTRAINT `fk_docente_empleado`
    FOREIGN KEY (`empleado_id`)
    REFERENCES `db_test`.`empleado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_docente_categoriaDocente`
    FOREIGN KEY (`categoria_docente_id`)
    REFERENCES `db_test`.`categoria_docente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `db_test`.`clasificacion_administrativo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_test`.`clasificacion_administrativo` ;

CREATE TABLE IF NOT EXISTS `db_test`.`clasificacion_administrativo` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nivel` VARCHAR(4) NOT NULL,
  `grado` VARCHAR(3) NOT NULL,
  `monto` DOUBLE UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `updated_at` TIMESTAMP NULL DEFAULT null,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `db_test`.`clasificacion_obrero`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_test`.`clasificacion_obrero` ;

CREATE TABLE IF NOT EXISTS `db_test`.`clasificacion_obrero` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `paso` INT UNSIGNED NOT NULL,
  `grado` INT UNSIGNED NOT NULL,
  `monto` DOUBLE UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `updated_at` TIMESTAMP NULL DEFAULT null,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `db_test`.`administrativo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_test`.`administrativo` ;

CREATE TABLE IF NOT EXISTS `db_test`.`administrativo` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `empleado_id` INT UNSIGNED NOT NULL,
  `nivel_instruccion` INT UNSIGNED NOT NULL,
  `clasificacion_administrativo_id` INT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `updated_at` TIMESTAMP NULL DEFAULT null,
  `deleted_at` TIMESTAMP NULL DEFAULT null,
  PRIMARY KEY (`id`),
  INDEX `fk_administrativo_empleado_idx` (`empleado_id` ASC),
  INDEX `fk_administrativo_clasificacionAdministrativo_idx` (`clasificacion_administrativo_id` ASC),
  CONSTRAINT `fk_administrativo_empleado`
    FOREIGN KEY (`empleado_id`)
    REFERENCES `db_test`.`empleado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_administrativo_clasificacionAdministrativo`
    FOREIGN KEY (`clasificacion_administrativo_id`)
    REFERENCES `db_test`.`clasificacion_administrativo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `db_test`.`obrero`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_test`.`obrero` ;

CREATE TABLE IF NOT EXISTS `db_test`.`obrero` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `empleado_id` INT UNSIGNED NOT NULL,
  `nivel_instruccion` INT UNSIGNED NOT NULL,
  `clasificacion_obrero_id` INT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `updated_at` TIMESTAMP NULL DEFAULT null,
  `deleted_at` TIMESTAMP NULL DEFAULT null,
  PRIMARY KEY (`id`),
  INDEX `fk_obrero_empleado_idx` (`empleado_id` ASC),
  INDEX `fk_obrero_clasificacionObrero_idx` (`clasificacion_obrero_id` ASC),
  CONSTRAINT `fk_obrero_empleado`
    FOREIGN KEY (`empleado_id`)
    REFERENCES `db_test`.`empleado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_obrero_clasificacionObrero`
    FOREIGN KEY (`clasificacion_obrero_id`)
    REFERENCES `db_test`.`clasificacion_obrero` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `db_test`.`variables_globales`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_test`.`variables_globales` ;

CREATE TABLE IF NOT EXISTS `db_test`.`variables_globales` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NULL,
  `tipo_valor` INT UNSIGNED NOT NULL,
  `formula` INT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `updated_at` TIMESTAMP NULL DEFAULT null,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `db_test`.`recibo_prestacionesSociales`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_test`.`recibo_prestacionesSociales` ;

CREATE TABLE IF NOT EXISTS `db_test`.`recibo_prestacionesSociales` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `trimestre` VARCHAR(1) NOT NULL,
  `ano` VARCHAR(4) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `updated_at` TIMESTAMP NULL DEFAULT null,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `db_test`.`prestaciones_sociales`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_test`.`prestaciones_sociales` ;

CREATE TABLE IF NOT EXISTS `db_test`.`prestaciones_sociales` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `recibo_prestacionesSociales_id` INT UNSIGNED NOT NULL,
  `empleado_id` INT UNSIGNED NOT NULL,
  `monto` DOUBLE UNSIGNED NOT NULL,
  `acumulado` DOUBLE UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `updated_at` TIMESTAMP NULL DEFAULT null,
  `deleted_at` TIMESTAMP NULL DEFAULT null,
  PRIMARY KEY (`id`),
  INDEX `fk_prestacionesSociales_reciboPrestacionesSociales_idx` (`recibo_prestacionesSociales_id` ASC),
  INDEX `fk_prestacionesSociales_empleado_idx` (`empleado_id` ASC),
  CONSTRAINT `fk_prestacionesSociales_reciboPrestacionesSociales`
    FOREIGN KEY (`recibo_prestacionesSociales_id`)
    REFERENCES `db_test`.`recibo_prestacionesSociales` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_prestacionesSociales_empleado`
    FOREIGN KEY (`empleado_id`)
    REFERENCES `db_test`.`empleado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `db_test`.`recibo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_test`.`recibo` ;

CREATE TABLE IF NOT EXISTS `db_test`.`recibo` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `mes` VARCHAR(2) NOT NULL,
  `ano` VARCHAR(4) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `updated_at` TIMESTAMP NULL DEFAULT null,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `db_test`.`cestaticket`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_test`.`cestaticket` ;

CREATE TABLE IF NOT EXISTS `db_test`.`cestaticket` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `empleado_id` INT UNSIGNED NOT NULL,
  `recibo_id` INT UNSIGNED NOT NULL,
  `cestaticket_valor` DOUBLE UNSIGNED NOT NULL,
  `faltas` INT UNSIGNED NOT NULL,
  `tickets_mes` DOUBLE UNSIGNED NOT NULL,
  `asignacion` DOUBLE UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `updated_at` TIMESTAMP NULL DEFAULT null,
  `deleted_at` TIMESTAMP NULL DEFAULT null,
  PRIMARY KEY (`id`, `asignacion`),
  INDEX `fk_cestaticket_empleado_idx` (`empleado_id` ASC),
  INDEX `fk_cestaticket_recibo_idx` (`recibo_id` ASC),
  CONSTRAINT `fk_cestaticket_empleado`
    FOREIGN KEY (`empleado_id`)
    REFERENCES `db_test`.`empleado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cestaticket_recibo`
    FOREIGN KEY (`recibo_id`)
    REFERENCES `db_test`.`recibo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `db_test`.`registro_nomina`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_test`.`registro_nomina` ;

CREATE TABLE IF NOT EXISTS `db_test`.`registro_nomina` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `tipo_valor` INT UNSIGNED NOT NULL,
  `codigo_nomina` VARCHAR(8) NOT NULL,
  `tipo_nomina` INT UNSIGNED NOT NULL,
  `basado_en` INT UNSIGNED NOT NULL,
  `requerido` INT UNSIGNED NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `updated_at` TIMESTAMP NULL DEFAULT null,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `db_test`.`registroNomina_tipoEmpleado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_test`.`registroNomina_tipoEmpleado` ;

CREATE TABLE IF NOT EXISTS `db_test`.`registroNomina_tipoEmpleado` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `registroNomina_id` INT UNSIGNED NOT NULL,
  `cantidad` DOUBLE UNSIGNED NOT NULL,
  `tipo_empleado` INT UNSIGNED NOT NULL,
  `depende_de` INT UNSIGNED NOT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`),
  INDEX `fk_registroNominaTipoEmpleado_registroNomina_idx` (`registroNomina_id` ASC),
  CONSTRAINT `fk_registroNominaTipoEmpleado_registroNomina`
    FOREIGN KEY (`registroNomina_id`)
    REFERENCES `db_test`.`registro_nomina` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `db_test`.`recibo_empleado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_test`.`recibo_empleado` ;

CREATE TABLE IF NOT EXISTS `db_test`.`recibo_empleado` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `recibo_id` INT UNSIGNED NOT NULL,
  `empleado_id` INT UNSIGNED NOT NULL,
  `valor_por_hora` DOUBLE UNSIGNED NOT NULL,
  `horas_semanales` DOUBLE UNSIGNED NOT NULL,
  `numero_de_semanas` INT UNSIGNED NOT NULL,
  `monto_total` DOUBLE UNSIGNED NOT NULL,
  `primer_quincena` DOUBLE UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `updated_at` TIMESTAMP NULL DEFAULT null,
  `deleted_at` TIMESTAMP NULL DEFAULT null,
  PRIMARY KEY (`id`),
  INDEX `fk_reciboEmpleado_recibo_idx` (`recibo_id` ASC),
  INDEX `fk_reciboEmpleado_expleado_idx` (`empleado_id` ASC),
  CONSTRAINT `fk_reciboEmpleado_recibo`
    FOREIGN KEY (`recibo_id`)
    REFERENCES `db_test`.`recibo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reciboEmpleado_empleado`
    FOREIGN KEY (`empleado_id`)
    REFERENCES `db_test`.`empleado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `db_test`.`recordatorio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_test`.`recordatorio` ;

CREATE TABLE IF NOT EXISTS `db_test`.`recordatorio` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `empleado_id` INT UNSIGNED NOT NULL,
  `nota` VARCHAR(500) NOT NULL,
  `fecha` DATE NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `updated_at` TIMESTAMP NULL DEFAULT null,
  `deleted_at` TIMESTAMP NULL DEFAULT null,
  PRIMARY KEY (`id`),
  INDEX `fk_recordatorio_empleado_idx` (`empleado_id` ASC),
  CONSTRAINT `fk_recordatorio_empleado`
    FOREIGN KEY (`empleado_id`)
    REFERENCES `db_test`.`empleado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `db_test`.`registroNomina_reciboEmpleado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_test`.`registroNomina_reciboEmpleado` ;

CREATE TABLE IF NOT EXISTS `db_test`.`registroNomina_reciboEmpleado` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `registroNomina_id` INT UNSIGNED NOT NULL,
  `reciboEmpleado_id` INT UNSIGNED NOT NULL,
  `monto_base` DOUBLE UNSIGNED NOT NULL,
  `cantidad` DOUBLE UNSIGNED NOT NULL,
  `monto_total` DOUBLE UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp,
  `updated_at` TIMESTAMP NULL DEFAULT null,
  PRIMARY KEY (`id`),
  INDEX `fk_registroNominaReciboEmpleado_ReciboEmpleado_idx` (`reciboEmpleado_id` ASC),
  INDEX `fk_registroNominaReciboEmpleado_registroNomina_idx` (`registroNomina_id` ASC),
  CONSTRAINT `fk_reciboNominaReciboEmpleado_ReciboEmpleado`
    FOREIGN KEY (`reciboEmpleado_id`)
    REFERENCES `db_test`.`recibo_empleado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_registroNominaReciboEmpleado_registroNomina`
    FOREIGN KEY (`registroNomina_id`)
    REFERENCES `db_test`.`registro_nomina` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `db_test`.`variablesGlobales_tipoEmpleado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `db_test`.`variablesGlobales_tipoEmpleado` ;

CREATE TABLE IF NOT EXISTS `db_test`.`variablesGlobales_tipoEmpleado` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `variablesGlobales_id` INT UNSIGNED NOT NULL,
  `tipo_empleado` INT UNSIGNED NOT NULL,
  `cantidad` DOUBLE UNSIGNED NOT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_variablesGlobalesTipoEmpleado_variablesGlobales_idx` (`variablesGlobales_id` ASC),
  CONSTRAINT `fk_variablesGlobalesTipoEmpleado_variablesGlobales`
    FOREIGN KEY (`variablesGlobales_id`)
    REFERENCES `db_test`.`variables_globales` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

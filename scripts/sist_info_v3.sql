-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-05-2023 a las 13:16:56
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sist_info`
--
CREATE DATABASE IF NOT EXISTS `sist_info` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sist_info`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `codigo` int(5) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `NIF` varchar(9) NOT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `codigoPostal` int(5) DEFAULT NULL,
  `localizacion` varchar(60) DEFAULT NULL,
  `provincia` varchar(60) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `telefono1` varchar(15) DEFAULT NULL,
  `datosBanco` varchar(25) DEFAULT NULL,
  `telefono2` int(15) DEFAULT NULL,
  `nota` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partetrabajo`
--

CREATE TABLE `partetrabajo` (
  `idParteTrabajo` int(9) NOT NULL,
  `anio` int(4) NOT NULL,
  `numeroParte` int(8) NOT NULL,
  `cliente` varchar(150) NOT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `fechaEntrada` datetime NOT NULL DEFAULT current_timestamp(),
  `fechaSalida` datetime DEFAULT NULL,
  `tecnico` varchar(50) DEFAULT NULL,
  `intervencion` varchar(100) DEFAULT NULL,
  `marca` varchar(20) DEFAULT NULL,
  `modelo` varchar(20) DEFAULT NULL,
  `numeroSerie` varchar(20) DEFAULT NULL,
  `descAveria` text DEFAULT NULL,
  `descReparacion` text DEFAULT NULL,
  `notas` text DEFAULT NULL,
  `estado` varchar(3) DEFAULT NULL,
  `horas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `codigoPostal` int(5) NOT NULL,
  `provincia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `partetrabajo`
--
ALTER TABLE `partetrabajo`
  ADD PRIMARY KEY (`idParteTrabajo`),
  ADD UNIQUE KEY `uc_anio_numeroParte` (`anio`,`numeroParte`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`codigoPostal`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `codigo` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `partetrabajo`
--
ALTER TABLE `partetrabajo`
  MODIFY `idParteTrabajo` int(9) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

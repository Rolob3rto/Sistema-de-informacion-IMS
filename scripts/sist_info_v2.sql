-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-03-2023 a las 10:06:58
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

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`codigo`, `nombre`, `NIF`, `direccion`, `codigoPostal`, `localizacion`, `provincia`, `email`, `telefono1`, `datosBanco`, `telefono2`, `nota`) VALUES
(1, 'Ramon alvarez', '26134215L', 'calle sdahgsdf hygvdshgaf sdhagfdsag sdjgfsdasdf', 23700, 'linares', 'jaen', 'sdhugsdaf@gmail.com', '619457615', '45647981654654', 953124512, 'fgdjtdrtjdjrtdtujdcrtd'),
(2, 'Pepe benito', '25143415T', 'calle nasduigsduygsdfsdafsdfsdasd', 21011, 'linares', 'jaen', 'lhigsauidg@gmail.com', '619456123', '45647981654654', 953124512, 'asdgyfsduhgf hgsdahifasd bhdsajlfsd dghsafjds hsdjaklf dsdsafjkdlsha dsjfakgf'),
(3, 'Sara Martin', '25141915P', 'calle nasduigsduygsdfsdafsdfsdasd', 21011, 'linares', 'jaen', 'lhigsauidg@gmail.com', '619456123', '45647981654654', 953124512, 'asdgyfsduhgf hgsdahifasd bhdsajlfsd dghsafjds hsdjaklf dsdsafjkdlsha dsjfakgf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partetrabajo`
--

CREATE TABLE `partetrabajo` (
  `idParteTrabajo` int(8) NOT NULL,
  `cliente` int(5) NOT NULL,
  `anio` int(4) NOT NULL,
  `numeroParte` int(8) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `fechaEntrada` datetime NOT NULL,
  `fechaSalida` datetime DEFAULT NULL,
  `tecnico` varchar(50) DEFAULT NULL,
  `intervencion` varchar(100) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `modelo` varchar(20) NOT NULL,
  `numeroSerie` bigint(20) DEFAULT NULL,
  `horas` int(4) NOT NULL DEFAULT 0,
  `descAveria` text DEFAULT NULL,
  `descReparacion` text DEFAULT NULL,
  `notas` text DEFAULT NULL,
  `estado` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partetrabajo`
--

INSERT INTO `partetrabajo` (`idParteTrabajo`, `cliente`, `anio`, `numeroParte`, `tipo`, `fechaEntrada`, `fechaSalida`, `tecnico`, `intervencion`, `marca`, `modelo`, `numeroSerie`, `horas`, `descAveria`, `descReparacion`, `notas`, `estado`) VALUES
(1, 1, 2005, 52463445, 'informatica', '2023-03-21 12:28:06', NULL, NULL, 'revision nose nose cual', 'hp', '47', 654654651, 4, 'sjdghyasdf\r\nsdafsdajgfysd\r\nsdfagfydsgauyfgvdsuyagfds,\r\nasdfsda', 'sadfsdbajfigsda\r\nsdhafuiasdgfi\r\nsdafihsdauif\r\nsdafudiasgfsduiagfuisdf', NULL, 'ENT');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguridad`
--

CREATE TABLE `seguridad` (
  `id` int(11) NOT NULL,
  `nombreUsuario` varchar(60) NOT NULL,
  `contrasena` varchar(60) NOT NULL
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
  ADD UNIQUE KEY `anio` (`anio`),
  ADD KEY `cliente` (`cliente`);

--
-- Indices de la tabla `seguridad`
--
ALTER TABLE `seguridad`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `codigo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `partetrabajo`
--
ALTER TABLE `partetrabajo`
  MODIFY `idParteTrabajo` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `seguridad`
--
ALTER TABLE `seguridad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `partetrabajo`
--
ALTER TABLE `partetrabajo`
  ADD CONSTRAINT `cliente` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

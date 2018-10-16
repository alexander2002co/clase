-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-09-2018 a las 03:38:05
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tcis3`
--
CREATE DATABASE IF NOT EXISTS `tcis3` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tcis3`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arin`
--

CREATE TABLE `arin` (
  `id_arin` int(10) NOT NULL,
  `placa` varchar(20) NOT NULL,
  `fecha_start` date NOT NULL,
  `fecha_end` date NOT NULL,
  `hora_start` time NOT NULL,
  `hora_end` time NOT NULL,
  `peso_start` int(20) NOT NULL,
  `peso_end` int(20) NOT NULL,
  `inspector` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `arin`
--

INSERT INTO `arin` (`id_arin`, `placa`, `fecha_start`, `fecha_end`, `hora_start`, `hora_end`, `peso_start`, `peso_end`, `inspector`) VALUES
(3, '123HFJ', '2018-09-18', '2018-09-19', '09:02:13', '09:53:04', 213, 12312, 0),
(31, '123HFJ', '2018-09-18', '2018-09-20', '08:59:00', '05:52:04', 123, 12312, 0),
(1231, '123HFJ', '2018-09-19', '0000-00-00', '10:09:28', '00:00:00', 12312, 0, 1),
(2131, '123HFJ', '2018-09-20', '2018-09-20', '06:30:02', '06:30:02', 12312, 12312, 1),
(12124, '123HFJ', '2018-09-20', '2018-09-20', '06:14:33', '06:14:33', 12312, 12312, 1),
(12311, '123HFJ', '2018-09-20', '0000-00-00', '06:12:26', '00:00:00', 12312, 0, 1),
(1231123, '123HFJ', '2018-09-20', '0000-00-00', '06:13:29', '00:00:00', 12312, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descargue`
--

CREATE TABLE `descargue` (
  `id_ingre` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `inspector` int(10) NOT NULL,
  `producto` int(10) NOT NULL,
  `proceso` int(10) NOT NULL,
  `arin` int(30) NOT NULL,
  `silo` int(10) NOT NULL,
  `comentarios` varchar(200) NOT NULL,
  `escotilla` int(10) NOT NULL,
  `maquinaria` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `descargue`
--

INSERT INTO `descargue` (`id_ingre`, `fecha`, `hora`, `inspector`, `producto`, `proceso`, `arin`, `silo`, `comentarios`, `escotilla`, `maquinaria`) VALUES
(9, '2018-09-18', '09:05:10', 1, 1, 1, 31, 1, 'Pesos no coinciden, falta cargamento', 32, 7),
(18, '2018-09-19', '09:53:04', 1, 1, 1, 3, 2, 'Pesos no coinciden, falta cargamento', 31, NULL),
(20, '2018-09-20', '06:30:02', 1, 1, 1, 2131, 5, 'Sin comentarios', 32, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ecotilla`
--

CREATE TABLE `ecotilla` (
  `id_escotilla` int(10) NOT NULL,
  `tipo_escotilla` int(10) NOT NULL,
  `id_inspector` int(10) DEFAULT NULL,
  `maquinaria` int(10) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `producto` int(10) NOT NULL,
  `arin` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ecotilla`
--

INSERT INTO `ecotilla` (`id_escotilla`, `tipo_escotilla`, `id_inspector`, `maquinaria`, `fecha`, `hora`, `producto`, `arin`) VALUES
(31, 2, 1, 7, '2018-09-18', '08:58:44', 1, 1231),
(32, 2, 1, 7, '2018-09-18', '08:59:00', 1, 2131),
(33, 1, 1, 4, '2018-09-20', '02:23:00', 1, 12124);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinaria`
--

CREATE TABLE `maquinaria` (
  `id_maquinaria` int(10) NOT NULL,
  `tipo` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `tiempo` time NOT NULL,
  `tiempo_start` time NOT NULL,
  `tiempo_end` time NOT NULL,
  `inspector` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `maquinaria`
--

INSERT INTO `maquinaria` (`id_maquinaria`, `tipo`, `fecha`, `tiempo`, `tiempo_start`, `tiempo_end`, `inspector`) VALUES
(1, 1, '2018-09-20', '02:23:00', '02:01:00', '15:02:00', 1),
(2, 1, '2018-09-20', '02:23:00', '02:01:00', '15:02:00', 1),
(3, 1, '2018-09-20', '02:23:00', '02:01:00', '15:02:00', 1),
(4, 1, '2018-09-20', '02:23:00', '02:01:00', '15:02:00', 1),
(5, 1, '2018-09-20', '05:48:35', '02:03:00', '14:03:00', 1),
(6, 1, '2018-09-20', '05:52:24', '00:03:00', '14:03:00', 1),
(7, 1, '2018-09-19', '06:45:42', '02:34:00', '15:04:00', 1),
(8, 1, '2018-09-19', '09:35:32', '00:03:00', '02:03:00', 1),
(9, 1, '2018-09-19', '09:35:32', '00:03:00', '02:03:00', 1),
(10, 3, '2018-09-20', '05:54:30', '02:03:00', '04:02:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nom_escotilla`
--

CREATE TABLE `nom_escotilla` (
  `id_escotilla` int(10) NOT NULL,
  `nombre` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nom_escotilla`
--

INSERT INTO `nom_escotilla` (`id_escotilla`, `nombre`) VALUES
(1, 'Escotilla 1'),
(2, 'Escotilla 2'),
(3, 'Escotilla 3'),
(4, 'Escotilla 4'),
(5, 'Escotilla 5'),
(6, 'Escotilla 6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `porceso`
--

CREATE TABLE `porceso` (
  `id_porceso` int(10) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `porceso`
--

INSERT INTO `porceso` (`id_porceso`, `nombre`) VALUES
(1, 'Stranvager'),
(2, 'Cielo de Palermo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(10) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`) VALUES
(1, 'Maiz Amarillo'),
(2, 'Maiz Blanco'),
(3, 'Torta de Soya');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `silo`
--

CREATE TABLE `silo` (
  `id_silo` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `silo`
--

INSERT INTO `silo` (`id_silo`, `nombre`) VALUES
(1, 'Silo 1'),
(2, 'Silo 8'),
(3, 'Silo 3'),
(4, 'Silo 4'),
(5, 'Manglar 4'),
(6, 'Zona Franca 8'),
(7, 'Almaviva via 40'),
(8, 'Descargue Directo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_maquinaria`
--

CREATE TABLE `tipo_maquinaria` (
  `id_maquina` int(10) NOT NULL,
  `nombre` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_maquinaria`
--

INSERT INTO `tipo_maquinaria` (`id_maquina`, `nombre`) VALUES
(1, 'Cargador Inversara #1'),
(2, 'Cargador Komatsu WA250'),
(3, 'Cargador New Holand #1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usua`
--

CREATE TABLE `tipo_usua` (
  `id_tipo` int(10) NOT NULL,
  `tipo` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_usua`
--

INSERT INTO `tipo_usua` (`id_tipo`, `tipo`) VALUES
(1, 'Administrador'),
(2, 'Supervisor'),
(3, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(10) NOT NULL,
  `tipo` int(3) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `direccion` varchar(70) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `clave` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `tipo`, `nombre`, `direccion`, `usuario`, `clave`) VALUES
(1, 1, 'Julian Ardila', 'Calle 151 bis # 116-09', 'Julian', '827ccb0eea8a706c4c34a16891f84e7b'),
(2, 2, 'Daniel', 'Calle 134 #31-14', 'Daniel', '6531401f9a6807306651b87e44c05751'),
(3, 2, 'Daniel', 'Calle 134 #31-14', 'Daniel', '6531401f9a6807306651b87e44c05751');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `arin`
--
ALTER TABLE `arin`
  ADD PRIMARY KEY (`id_arin`),
  ADD KEY `inspector` (`inspector`);

--
-- Indices de la tabla `descargue`
--
ALTER TABLE `descargue`
  ADD PRIMARY KEY (`id_ingre`),
  ADD KEY `uno` (`silo`),
  ADD KEY `tres` (`producto`),
  ADD KEY `cuatro` (`inspector`),
  ADD KEY `cinco` (`proceso`),
  ADD KEY `seis` (`escotilla`),
  ADD KEY `siete` (`maquinaria`);

--
-- Indices de la tabla `ecotilla`
--
ALTER TABLE `ecotilla`
  ADD PRIMARY KEY (`id_escotilla`),
  ADD KEY `relacion_dos` (`id_inspector`),
  ADD KEY `relacion_tres` (`maquinaria`),
  ADD KEY `tipo_escotilla_2` (`tipo_escotilla`),
  ADD KEY `producto` (`producto`),
  ADD KEY `relacion_cinco` (`arin`);

--
-- Indices de la tabla `maquinaria`
--
ALTER TABLE `maquinaria`
  ADD PRIMARY KEY (`id_maquinaria`),
  ADD KEY `relacion_maquinaria` (`tipo`),
  ADD KEY `relacion_dos_usa` (`inspector`);

--
-- Indices de la tabla `nom_escotilla`
--
ALTER TABLE `nom_escotilla`
  ADD PRIMARY KEY (`id_escotilla`);

--
-- Indices de la tabla `porceso`
--
ALTER TABLE `porceso`
  ADD PRIMARY KEY (`id_porceso`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `silo`
--
ALTER TABLE `silo`
  ADD PRIMARY KEY (`id_silo`);

--
-- Indices de la tabla `tipo_maquinaria`
--
ALTER TABLE `tipo_maquinaria`
  ADD PRIMARY KEY (`id_maquina`);

--
-- Indices de la tabla `tipo_usua`
--
ALTER TABLE `tipo_usua`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `tipo` (`tipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `arin`
--
ALTER TABLE `arin`
  MODIFY `id_arin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1231124;

--
-- AUTO_INCREMENT de la tabla `descargue`
--
ALTER TABLE `descargue`
  MODIFY `id_ingre` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `ecotilla`
--
ALTER TABLE `ecotilla`
  MODIFY `id_escotilla` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `maquinaria`
--
ALTER TABLE `maquinaria`
  MODIFY `id_maquinaria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `nom_escotilla`
--
ALTER TABLE `nom_escotilla`
  MODIFY `id_escotilla` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `porceso`
--
ALTER TABLE `porceso`
  MODIFY `id_porceso` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `silo`
--
ALTER TABLE `silo`
  MODIFY `id_silo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tipo_maquinaria`
--
ALTER TABLE `tipo_maquinaria`
  MODIFY `id_maquina` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_usua`
--
ALTER TABLE `tipo_usua`
  MODIFY `id_tipo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `arin`
--
ALTER TABLE `arin`
  ADD CONSTRAINT `relacion_usua` FOREIGN KEY (`inspector`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `descargue`
--
ALTER TABLE `descargue`
  ADD CONSTRAINT `cinco` FOREIGN KEY (`proceso`) REFERENCES `porceso` (`id_porceso`),
  ADD CONSTRAINT `cuatro` FOREIGN KEY (`inspector`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `seis` FOREIGN KEY (`escotilla`) REFERENCES `ecotilla` (`id_escotilla`),
  ADD CONSTRAINT `siete` FOREIGN KEY (`maquinaria`) REFERENCES `maquinaria` (`id_maquinaria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tres` FOREIGN KEY (`producto`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `uno` FOREIGN KEY (`silo`) REFERENCES `silo` (`id_silo`);

--
-- Filtros para la tabla `ecotilla`
--
ALTER TABLE `ecotilla`
  ADD CONSTRAINT `escotilla_cuatro` FOREIGN KEY (`producto`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `relacion_cinco` FOREIGN KEY (`arin`) REFERENCES `arin` (`id_arin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `relacion_dos` FOREIGN KEY (`id_inspector`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `relacion_tres` FOREIGN KEY (`maquinaria`) REFERENCES `maquinaria` (`id_maquinaria`),
  ADD CONSTRAINT `relacion_uno` FOREIGN KEY (`tipo_escotilla`) REFERENCES `nom_escotilla` (`id_escotilla`);

--
-- Filtros para la tabla `maquinaria`
--
ALTER TABLE `maquinaria`
  ADD CONSTRAINT `relacion_dos_usa` FOREIGN KEY (`inspector`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `relacion_maquinaria` FOREIGN KEY (`tipo`) REFERENCES `tipo_maquinaria` (`id_maquina`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `tipo_usua` (`id_tipo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

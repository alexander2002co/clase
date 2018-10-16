-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-05-2018 a las 20:01:30
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
-- Base de datos: `tcis`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientela`
--

CREATE TABLE `clientela` (
  `id_cli` int(10) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `clientela`
--

INSERT INTO `clientela` (`id_cli`, `nombre`, `direccion`, `telefono`) VALUES
(1, 'Juan', 'Calle 151 bis #116-09', 2147483647);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulario`
--

CREATE TABLE `formulario` (
  `remision` int(10) NOT NULL,
  `fecha` varchar(18) COLLATE utf8_spanish2_ci NOT NULL,
  `hora` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `placa` varchar(6) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_empresa` varchar(90) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_conductor` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `cedula` int(15) NOT NULL,
  `celular` int(10) NOT NULL,
  `ubicacion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `patio_origen` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `patio_llegada` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `estado_actual` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `peso_neto` int(15) NOT NULL,
  `precinto1` int(20) NOT NULL,
  `precinto2` int(20) NOT NULL,
  `precinto3` int(20) NOT NULL,
  `precinto4` int(20) NOT NULL,
  `precinto5` int(20) NOT NULL,
  `precinto6` int(20) NOT NULL,
  `id_inpec` int(10) NOT NULL,
  `id_cli` int(10) NOT NULL,
  `peso_llegada` int(30) NOT NULL,
  `obsevaciones` varchar(400) COLLATE utf8_spanish2_ci NOT NULL,
  `precinto_llegada1` int(20) NOT NULL,
  `precinto_llegada2` int(20) NOT NULL,
  `precinto_llegada3` int(20) NOT NULL,
  `precinto_llegada4` int(20) NOT NULL,
  `precinto_llegada5` int(20) NOT NULL,
  `precinto_llegada6` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `formulario`
--

INSERT INTO `formulario` (`remision`, `fecha`, `hora`, `placa`, `nombre_empresa`, `nombre_conductor`, `cedula`, `celular`, `ubicacion`, `patio_origen`, `patio_llegada`, `estado_actual`, `peso_neto`, `precinto1`, `precinto2`, `precinto3`, `precinto4`, `precinto5`, `precinto6`, `id_inpec`, `id_cli`, `peso_llegada`, `obsevaciones`, `precinto_llegada1`, `precinto_llegada2`, `precinto_llegada3`, `precinto_llegada4`, `precinto_llegada5`, `precinto_llegada6`) VALUES
(1, '2018-05-26', '12:54:37', 'DAS124', 'PanPaYa', 'Julian', 13241234, 123414123, 'Bogotá', 'BOGOTA', 'Barranquilla', 'En curso', 11, 312341, 12341234, 12341234, 12341234, 12341234, 12341234, 1, 1, 0, '', 0, 0, 0, 0, 0, 0),
(2, '2018-05-24', '18:05:14', '123GFD', 'PanPaYa', 'Julian', 1123134, 7658779, 'Bogotá', 'Bogotá', 'Barranquilla', 'Sin Salir', 31, 1234123, 656858, 568680, 699878070, 69880709, 98909, 1, 1, 0, '', 0, 0, 0, 0, 0, 0),
(3, '2018-05-24', '18:16:13', 'DAD212', 'Metro Pan', 'Julian', 123123141, 21341234, 'Bogotá', 'Bogotá', 'Cali', 'En curso', 4123, 31234124, 98767867, 5456493, 759870, 7806786, 9545657, 1, 1, 0, '', 0, 0, 0, 0, 0, 0),
(12341234, '2018-05-26', '11:31:31', 'FAF123', 'Exito', 'Edwin', 41233123, 33124123, 'Bogota', 'Bogota', 'Pereira', 'En curso', 134, 34132, 87676987, 2147483647, 89870870, 90809809, 870809890, 2, 1, 0, '', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usua`
--

CREATE TABLE `tipo_usua` (
  `tipo_usua` int(10) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_usua`
--

INSERT INTO `tipo_usua` (`tipo_usua`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Supervisor Salida'),
(3, 'Cliente'),
(4, 'Supervisor Llegada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usua` int(10) NOT NULL,
  `nom` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` int(10) NOT NULL,
  `tipo_usua` int(10) NOT NULL,
  `usuarios` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(200) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usua`, `nom`, `direccion`, `telefono`, `tipo_usua`, `usuarios`, `clave`) VALUES
(1, 'Julian Ardila', 'Calle 151bis #116-09', 4700539, 1, 'Julian', '827ccb0eea8a706c4c34a16891f84e7b'),
(2, 'Daniela Orjuela', 'Calle 132 #311-4', 41455124, 4, 'Ingrid', '6531401f9a6807306651b87e44c05751'),
(3, 'Juan Pablo', 'Calle 80 #134-31', 135142351, 3, 'Liliana', '099ebea48ea9666a7da2177267983138'),
(4, 'Daniela Orjuela', 'Calle 132 #311-4', 41455124, 2, 'Francia', '6531401f9a6807306651b87e44c05751'),
(5, 'Juan Pablo', 'Calle 80 #134-31', 135142351, 3, 'Pola', '099ebea48ea9666a7da2177267983138'),
(6, 'Luz Amanda', 'Calle 154 # 110-41', 143342, 2, 'Amanda', '774965860a0dceecf2a81250fb2eb221'),
(7, 'Libardo', 'Calle 45 #123-31', 123414123, 3, 'Libardo', '0043ecb8a2d4110114c699ccfe85b36d'),
(8, 'Luz Amanda', 'Calle 154 # 110-41', 143342, 2, 'Amanda', '774965860a0dceecf2a81250fb2eb221'),
(9, 'Libardo', 'Calle 45 #123-31', 123414123, 3, 'Libardo', '0043ecb8a2d4110114c699ccfe85b36d');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientela`
--
ALTER TABLE `clientela`
  ADD PRIMARY KEY (`id_cli`);

--
-- Indices de la tabla `formulario`
--
ALTER TABLE `formulario`
  ADD PRIMARY KEY (`remision`),
  ADD KEY `id_inpec` (`id_inpec`),
  ADD KEY `id_cli` (`id_cli`);

--
-- Indices de la tabla `tipo_usua`
--
ALTER TABLE `tipo_usua`
  ADD PRIMARY KEY (`tipo_usua`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usua`),
  ADD KEY `tipo_usua` (`tipo_usua`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientela`
--
ALTER TABLE `clientela`
  MODIFY `id_cli` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `formulario`
--
ALTER TABLE `formulario`
  MODIFY `remision` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12341235;

--
-- AUTO_INCREMENT de la tabla `tipo_usua`
--
ALTER TABLE `tipo_usua`
  MODIFY `tipo_usua` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usua` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `formulario`
--
ALTER TABLE `formulario`
  ADD CONSTRAINT `formulario_ibfk_1` FOREIGN KEY (`id_inpec`) REFERENCES `usuarios` (`id_usua`),
  ADD CONSTRAINT `formulario_ibfk_2` FOREIGN KEY (`id_cli`) REFERENCES `clientela` (`id_cli`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`tipo_usua`) REFERENCES `tipo_usua` (`tipo_usua`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

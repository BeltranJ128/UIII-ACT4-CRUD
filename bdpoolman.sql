-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2023 a las 03:46:56
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdpoolman`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cant_producto`
--

CREATE TABLE `cant_producto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_producto` bigint(20) UNSIGNED NOT NULL,
  `cantidad` bigint(20) UNSIGNED NOT NULL,
  `id_mantenimiento` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `cant_producto`
--

INSERT INTO `cant_producto` (`id`, `id_producto`, `cantidad`, `id_mantenimiento`) VALUES
(1, 1, 2, 1),
(2, 2, 2, 2),
(3, 1, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento`
--

CREATE TABLE `mantenimiento` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_cliente` int(100) NOT NULL,
  `id_empleado` int(100) NOT NULL,
  `id_producto` int(100) NOT NULL,
  `nom_producto` varchar(255) NOT NULL,
  `iva` decimal(5,2) NOT NULL,
  `fecha` datetime NOT NULL,
  `total` decimal(7,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `mantenimiento`
--

INSERT INTO `mantenimiento` (`id`, `id_cliente`, `id_empleado`, `id_producto`, `nom_producto`, `iva`, `fecha`, `total`) VALUES
(1, 2, 6, 1, 'Shock correctivo', 63.18, '2023-11-16 03:15:23', 789.80),
(2, 1, 12, 1, 'Shock correctivo', 100.06, '2023-11-16 03:33:04', 1250.70);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio` decimal(5,2) NOT NULL,
  `existencias` decimal(5,2) NOT NULL,
  `tipo_producto` varchar(255) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `iva` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `existencias`, `tipo_producto`, `marca`, `iva`) VALUES
(1, 'Shock correctivo', 'Producto desinfectante altamente soluble con un 60% de Cloro disponible', 359.00, 12.00, 'Cloro', 'Spin', 35.90),
(2, 'Trizide', 'Cloro', 389.00, 10.00, 'Cloro', 'Spin', 38.90),
(3, '3', 'Aceite', 20.00, 18.00, '100.00', '', 0.00),
(4, '4', 'Palomitas de maíz', 15.00, 12.00, '100.00', '', 0.00),
(5, '5', 'Doritos', 8.00, 5.00, '100.00', '', 0.00),
(6, 'Cristalin Platinum', 'Abrillantador de agua', 265.00, 21.00, 'Abrillantador', 'Spin', 26.50);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cant_producto`
--
ALTER TABLE `cant_producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_venta` (`id_mantenimiento`);

--
-- Indices de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cant_producto`
--
ALTER TABLE `cant_producto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cant_producto`
--
ALTER TABLE `cant_producto`
  ADD CONSTRAINT `cant_producto_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cant_producto_ibfk_2` FOREIGN KEY (`id_mantenimiento`) REFERENCES `mantenimiento` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

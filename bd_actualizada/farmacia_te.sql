-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-03-2019 a las 01:29:48
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `farmacia_te`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_medicamento`
--

CREATE TABLE `categoria_medicamento` (
  `cat_id` int(11) NOT NULL,
  `cat_nombre` varchar(60) NOT NULL,
  `cat_estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria_medicamento`
--

INSERT INTO `categoria_medicamento` (`cat_id`, `cat_nombre`, `cat_estado`) VALUES
(2, 'hola', 1),
(3, 'catr2', 1),
(4, 'ihiuh', 1),
(5, 'buguyfyu', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cliente_id` int(11) NOT NULL,
  `cliente_nombre` varchar(60) DEFAULT NULL,
  `cliente_apellido` varchar(60) DEFAULT NULL,
  `cliente_doc` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `compra_id` int(11) NOT NULL,
  `compra_fecha` datetime NOT NULL,
  `compra_total` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `det_compra_id` int(11) NOT NULL,
  `med_id` int(11) DEFAULT NULL,
  `det_compra_cantidad` int(11) DEFAULT NULL,
  `det_compra_subtotal` decimal(8,2) DEFAULT NULL,
  `detalle_compracol` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `det_venta_id` int(11) NOT NULL,
  `med_id` int(11) DEFAULT NULL,
  `det_venta_cantidad` int(11) DEFAULT NULL,
  `det_venta_subtotal` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `emp_id` int(11) NOT NULL,
  `emp_nombre` varchar(60) NOT NULL,
  `emp_apellido` varchar(60) NOT NULL,
  `emp_fechaN` date DEFAULT NULL,
  `usr_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE `medicamentos` (
  `med_id` int(11) NOT NULL,
  `med_nombre` varchar(100) DEFAULT NULL,
  `med_stock` int(11) NOT NULL,
  `med_precioC` decimal(8,2) NOT NULL,
  `med_precioV` decimal(8,2) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `pre_id` int(11) DEFAULT NULL,
  `med_fechaV` date DEFAULT NULL,
  `med_estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentacion`
--

CREATE TABLE `presentacion` (
  `pre_id` int(11) NOT NULL,
  `pre_nombre` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `presentacion`
--

INSERT INTO `presentacion` (`pre_id`, `pre_nombre`) VALUES
(1, 'jarabe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usr_id` int(11) NOT NULL,
  `usr_nombre` varchar(60) NOT NULL,
  `usr_password` varchar(60) DEFAULT NULL,
  `usr_email` varchar(100) NOT NULL,
  `usr_tipo` int(11) DEFAULT NULL,
  `usr_estado` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usr_id`, `usr_nombre`, `usr_password`, `usr_email`, `usr_tipo`, `usr_estado`) VALUES
(4, 'pedro', '$2y$12$QBDR7EDPQM2frZuWYDXHdeVpaR0oKFmj7w0jiAa6iS.87Bjx9x7ju', 'pedropacheco1523503@gmail.com', 2, 1),
(5, 'admin', '$2y$12$IH8Z1viI1ufT11jCLeUjhuRPaEoxOpSoFIAhYlcYyl9v2EkpCVIPK', 'admin@gmail.com', 1, 1),
(6, 'jeffry', '$2y$12$qja.SKSdMBOG1K0USHh6q.k6EbTcpe2xLRgfqWY.HKjoulOT518Dm', 'jrsv@gmail.com', 1, 1),
(59, 'miguel', '$2y$12$PpWCviLmco50w7oucABhZ.x2kL/v7gAsGs/EVQyJeizFOJyzSdQ.W', 'migue@gmail.com', 2, 1),
(63, 'pacheco', '$2y$12$Ula/QG3HYJ8tY0aLaxO4U.mj1uvh6nftZpVkK4qEIwXCmiz0/i/Fq', 'gdlwebcam27@gmail.com', 1, 1),
(64, 'Pedro Pacheco', '$2y$12$nmnffgcR1z6sIQiDLq9Y3.NXu3x4bgVuReC/YuIMhcp6ZuXVFgP/e', 'pedropacheco1523503@gmail.com', 2, 1),
(66, 'gdl webcamp', '$2y$12$2t.cRxv0vTFg5exd7TRCPuE4jMm0yJap7CHUhZimMHb9A2d/K34WW', 'gdlwebcam27@gmail.com', 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `venta_id` int(11) NOT NULL,
  `venta_fecha` datetime DEFAULT NULL,
  `venta_subtotal` decimal(8,2) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria_medicamento`
--
ALTER TABLE `categoria_medicamento`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `cat_nombre` (`cat_nombre`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cliente_id`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`compra_id`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`det_compra_id`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`det_venta_id`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`med_id`);

--
-- Indices de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  ADD PRIMARY KEY (`pre_id`),
  ADD UNIQUE KEY `pre_nombre` (`pre_nombre`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usr_id`),
  ADD UNIQUE KEY `usr_nombre` (`usr_nombre`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`venta_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria_medicamento`
--
ALTER TABLE `categoria_medicamento`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cliente_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `compra_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `det_compra_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `det_venta_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `med_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  MODIFY `pre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `venta_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

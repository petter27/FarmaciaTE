-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-04-2019 a las 02:41:19
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
(10, 'nueva', 1);

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

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cliente_id`, `cliente_nombre`, `cliente_apellido`, `cliente_doc`) VALUES
(1, 'Primer', 'Cliente', '09808636-1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `compra_id` int(11) NOT NULL,
  `compra_fecha` datetime NOT NULL,
  `compra_total` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`compra_id`, `compra_fecha`, `compra_total`) VALUES
(1, '2019-04-05 00:00:00', '200.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `det_compra_id` int(11) NOT NULL,
  `med_id` int(11) DEFAULT NULL,
  `det_compra_cantidad` int(11) DEFAULT NULL,
  `det_compra_subtotal` decimal(8,2) DEFAULT NULL,
  `compra_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`det_compra_id`, `med_id`, `det_compra_cantidad`, `det_compra_subtotal`, `compra_id`) VALUES
(1, 1, 400, '200.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `det_venta_id` int(11) NOT NULL,
  `med_id` int(11) DEFAULT NULL,
  `det_venta_cantidad` int(11) DEFAULT NULL,
  `det_venta_subtotal` decimal(8,2) DEFAULT NULL,
  `venta_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`det_venta_id`, `med_id`, `det_venta_cantidad`, `det_venta_subtotal`, `venta_id`) VALUES
(1, 1, 400, '200.00', 1);

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

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`emp_id`, `emp_nombre`, `emp_apellido`, `emp_fechaN`, `usr_id`) VALUES
(1, 'administrador', 'Pacheco', '1997-10-23', 5);

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
  `med_estado` int(11) DEFAULT NULL,
  `med_img` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `medicamentos`
--

INSERT INTO `medicamentos` (`med_id`, `med_nombre`, `med_stock`, `med_precioC`, `med_precioV`, `cat_id`, `pre_id`, `med_fechaV`, `med_estado`, `med_img`) VALUES
(1, 'Acetaminofen', 200, '0.50', '0.00', 10, 1, '2020-02-02', 1, 'camisa1.jpg');

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
(1, 'Tableta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usr_id` int(11) NOT NULL,
  `usr_nombre` varchar(60) DEFAULT NULL,
  `usr_password` varchar(60) DEFAULT NULL,
  `usr_tipo` int(11) DEFAULT NULL,
  `usr_estado` int(1) DEFAULT NULL,
  `usr_img` varchar(150) DEFAULT NULL,
  `usr_email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usr_id`, `usr_nombre`, `usr_password`, `usr_tipo`, `usr_estado`, `usr_img`, `usr_email`) VALUES
(4, 'pedro', '$2y$12$QBDR7EDPQM2frZuWYDXHdeVpaR0oKFmj7w0jiAa6iS.87Bjx9x7ju', 2, 0, '', 'pedropacheco1523503@gmail.com'),
(5, 'admin', '$2y$12$IH8Z1viI1ufT11jCLeUjhuRPaEoxOpSoFIAhYlcYyl9v2EkpCVIPK', 1, 1, '', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `venta_fecha` datetime DEFAULT NULL,
  `venta_total` decimal(8,2) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `venta_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`venta_fecha`, `venta_total`, `cliente_id`, `emp_id`, `venta_id`) VALUES
('2019-04-05 00:00:00', '200.00', 1, 1, 1);

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
  ADD PRIMARY KEY (`det_compra_id`),
  ADD KEY `fk_detalle_compra_compra_idx` (`compra_id`),
  ADD KEY `fk_detalle_compra_medicamento_idx` (`med_id`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`det_venta_id`),
  ADD KEY `fk_detalle_venta_venta_idx` (`venta_id`),
  ADD KEY `fk_detalle_venta_medicamento_idx` (`med_id`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `fk_empleado_usuario_idx` (`usr_id`);

--
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`med_id`),
  ADD KEY `fk_mediacemnto_categoria_idx` (`cat_id`),
  ADD KEY `fk_medicamento_presentacion_idx` (`pre_id`);

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
  ADD PRIMARY KEY (`venta_id`),
  ADD KEY `fk_venta_empleado_idx` (`emp_id`),
  ADD KEY `fk_venta_cliente_idx` (`cliente_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria_medicamento`
--
ALTER TABLE `categoria_medicamento`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cliente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `compra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `det_compra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `det_venta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `med_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  MODIFY `pre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `venta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `fk_detalle_compra_compra` FOREIGN KEY (`compra_id`) REFERENCES `compra` (`compra_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_compra_medicamento` FOREIGN KEY (`med_id`) REFERENCES `medicamentos` (`med_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `fk_detalle_venta_medicamento` FOREIGN KEY (`med_id`) REFERENCES `medicamentos` (`med_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_venta_venta` FOREIGN KEY (`venta_id`) REFERENCES `venta` (`venta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `fk_empleado_usuario` FOREIGN KEY (`usr_id`) REFERENCES `usuario` (`usr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD CONSTRAINT `fk_mediacemento_categoria` FOREIGN KEY (`cat_id`) REFERENCES `categoria_medicamento` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_medicamento_presentacion` FOREIGN KEY (`pre_id`) REFERENCES `presentacion` (`pre_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_empleado` FOREIGN KEY (`emp_id`) REFERENCES `empleado` (`emp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

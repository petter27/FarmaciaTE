-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-04-2019 a las 22:29:54
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

--
-- Volcado de datos para la tabla `categoria_medicamento`
--

INSERT INTO `categoria_medicamento` (`cat_id`, `cat_nombre`, `cat_estado`) VALUES
(10, 'Analgesicos', 1),
(11, 'Antigripal', 1),
(12, 'AntialÃ©rgicos', 1),
(13, 'Antidiarreicos y laxantes', 1),
(14, 'antiinfecciosos', 1),
(15, 'antiinflamatorios', 1);

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`compra_id`, `compra_fecha`, `compra_total`) VALUES
(1, '2019-04-05 00:00:00', '250.00'),
(2, '2019-04-06 00:00:00', '25.00'),
(3, '2019-04-07 10:53:22', '33.50'),
(4, '2019-04-11 11:09:58', '11.00'),
(5, '2019-04-11 11:10:51', '474.90'),
(6, '2019-04-11 11:11:14', '7.50');

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`det_compra_id`, `med_id`, `det_compra_cantidad`, `det_compra_subtotal`, `compra_id`) VALUES
(1, 1, 400, '200.00', 1),
(2, 3, 25, '25.00', 2),
(3, 3, 67, '33.50', 3),
(4, 3, 10, '5.00', 4),
(5, 1, 15, '6.00', 4),
(6, 6, 35, '105.00', 5),
(7, 7, 5, '15.00', 5),
(8, 11, 20, '90.00', 5),
(9, 12, 10, '249.90', 5),
(10, 10, 20, '15.00', 5),
(11, 8, 15, '3.75', 6),
(12, 9, 15, '3.75', 6);

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`det_venta_id`, `med_id`, `det_venta_cantidad`, `det_venta_subtotal`, `venta_id`) VALUES
(1, 1, 400, '200.00', 1),
(2, 3, 25, '25.00', 1),
(3, 3, 2, '2.00', 2);

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`emp_id`, `emp_nombre`, `emp_apellido`, `emp_fechaN`, `usr_id`, `emp_estado`) VALUES
(1, 'Osvaldo', ' Pacheco', '1997-10-23', 5, 1),
(2, 'Jose Ricardo', 'Sifontes', '1997-10-10', 7, 1),
(3, 'Rodrigo', 'Viscarra', '1996-12-12', 6, 1);

--
-- Volcado de datos para la tabla `medicamentos`
--

INSERT INTO `medicamentos` (`med_id`, `med_nombre`, `med_stock`, `med_precioC`, `med_precioV`, `cat_id`, `pre_id`, `med_fechaV`, `med_estado`, `med_img`) VALUES
(1, 'Acetaminofen', 170, '0.40', '0.50', 10, 1, '2020-02-02', 1, 'acetaminofen.jpg'),
(3, 'Panadol', 97, '0.50', '1.00', 10, 1, '2020-10-10', 1, 'Panadol.jpg'),
(4, 'Bisolgrip', 300, '2.00', '3.50', 11, 3, '2021-10-23', 1, 'bisolgrip.jpg'),
(5, 'Dexametasona', 150, '4.50', '6.00', 15, 6, '2021-10-10', 1, 'dexametasona.jpg'),
(6, 'PeptoBismol', 84, '3.00', '3.99', 13, 2, '2022-12-23', 1, '81ZJtR4b9bL._SL1500_.jpg'),
(7, 'Alka Zeltzer', 304, '3.00', '3.75', 10, 3, '2023-10-10', 1, 'alka.jpg'),
(8, 'Virogrip Dia', 61, '0.25', '0.40', 11, 4, '2024-03-01', 1, '252-43web-780x600.jpg'),
(9, 'Virogrip Noche', 215, '0.25', '0.40', 11, 4, '2022-02-01', 1, 'Disp016-540x690.jpg'),
(10, 'Pomada La Campana', 40, '0.75', '1.00', 15, 5, '2019-02-02', 1, '900.jpg'),
(11, 'Anginovag', 50, '4.50', '5.99', 14, 7, '2019-10-01', 1, 'anginovag-aerosol-20-ml.jpg'),
(12, 'Iprasynt', 35, '24.99', '28.50', 14, 8, '2020-11-11', 1, '17995_178x237.jpg');

--
-- Volcado de datos para la tabla `presentacion`
--

INSERT INTO `presentacion` (`pre_id`, `pre_nombre`) VALUES
(7, 'Aerosoles'),
(4, 'CÃ¡psulas'),
(8, 'Inhalaciones'),
(2, 'Jarabe'),
(3, 'Polvos/comprimidos'),
(5, 'pomada/crema'),
(6, 'Soluciones'),
(1, 'Tableta');

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usr_id`, `usr_nombre`, `usr_password`, `usr_tipo`, `usr_estado`, `usr_img`, `usr_email`) VALUES
(4, 'pedro', '$2y$12$QBDR7EDPQM2frZuWYDXHdeVpaR0oKFmj7w0jiAa6iS.87Bjx9x7ju', 2, 0, '', 'pedropacheco1523503@gmail.com'),
(5, 'admin', '$2y$12$IH8Z1viI1ufT11jCLeUjhuRPaEoxOpSoFIAhYlcYyl9v2EkpCVIPK', 1, 1, 'camisa1.jpg', 'admin@gmail.com'),
(6, 'viscarra', '$2y$12$MQDISVB3kkg7CRMGoojwSOAze97SP6m6Mo3z6oh6HjxU7A6G4mibu', 2, 1, 'camisa2.jpg', 'viscarra@gmail.com'),
(7, 'empleado', '$2y$12$jWuKMcx9eBuTJfv6Ary7Aewu3PJeA8I2QkAetL1Z2uY72ZyISLNfO', 2, 1, 'empleado1.jpg', 'emp123@gmail.com');

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`venta_fecha`, `venta_total`, `emp_id`, `venta_id`) VALUES
('2019-04-05 00:00:00', '225.00', 1, 1),
('2019-04-05 00:00:00', '2.00', 1, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

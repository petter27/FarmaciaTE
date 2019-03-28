-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-03-2019 a las 01:33:54
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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usr_id`),
  ADD UNIQUE KEY `usr_nombre` (`usr_nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-06-2021 a las 23:18:26
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pasteleria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupoauditor`
--

CREATE TABLE `grupoauditor` (
  `idgrupo` int(11) NOT NULL,
  `nombregrupo` varchar(50) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idnorma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grupoauditor`
--

INSERT INTO `grupoauditor` (`idgrupo`, `nombregrupo`, `idusuario`, `idnorma`) VALUES
(1, 'grupoISO9001', 2, 1),
(2, 'grupoBasc', 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `norma`
--

CREATE TABLE `norma` (
  `idnorma` int(11) NOT NULL,
  `nombrenorma` varchar(50) NOT NULL,
  `clausulanorma` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `norma`
--

INSERT INTO `norma` (`idnorma`, `nombrenorma`, `clausulanorma`) VALUES
(1, 'ISO9001', '1.1  Establecer los objetivos de la ISO '),
(2, 'ISO9001', '1.2  Establecer los códigos de ética'),
(3, 'Basc', '1.1  Requisitos de asociados de negocios'),
(4, 'Basc', '1.2  Seguridad de las unidades de carga ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pastel`
--

CREATE TABLE `pastel` (
  `id_pastel` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `precio` decimal(4,2) NOT NULL,
  `tamano` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pastel`
--

INSERT INTO `pastel` (`id_pastel`, `nombre`, `descripcion`, `precio`, `tamano`) VALUES
(1, 'chocolate', 'pastel de chocolate', '12.00', 'grande'),
(2, 'vainilla', 'pastel de vainilla', '14.00', 'Grande'),
(3, 'pastel de caramelo', 'Un delicioso pastel de caramelo con chocolate ', '10.00', 'Mediano'),
(5, 'pastel de almendras', 'pastel de chocolate con almedras', '25.00', 'PequeÃ±o'),
(6, 'naranja', 'pastel de naranja', '10.00', 'Grande'),
(7, 'limon', 'pastel de limon', '25.00', 'Mediano'),
(8, 'nueces', 'pastel de chocolate con almedras', '5.00', 'Grande'),
(9, 'melon', 'pastel de chocolate con almedras', '5.00', 'Grande'),
(10, 'uva', 'pastel de chocolate con almedras', '10.00', 'Grande'),
(11, 'manzana', 'pastel de chocolate con almedras', '99.99', 'Grande'),
(12, 'mani', 'pastel de chocolate con almedras', '99.99', 'Mediano'),
(13, 'durazno', 'pastel de chocolate con almedras', '5.00', 'Grande'),
(14, 'banana', 'pastel de chocolate con almedras', '99.99', 'Grande'),
(15, 'coco', 'pastel de chocolate con almedras', '10.00', 'Grande');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pastel` int(11) NOT NULL,
  `cedula` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `cantidad` int(5) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_user`, `id_pastel`, `cedula`, `nombre`, `cantidad`, `fecha`) VALUES
(1, 1, 1, 1718771825, 'raul', 5, '2020-09-26'),
(2, 2, 2, 1718771825, 'Ivan', 3, '2020-09-29'),
(3, 1, 3, 1004411656, 'Daniel', 2, '2021-04-24'),
(4, 2, 2, 1718771825, 'Don Aux', 25, '2021-06-07'),
(5, 2, 5, 1718771825, 'Daniel', 10, '2021-09-15'),
(6, 1, 2, 1718771825, 'Aux', 1718771825, '2021-06-18'),
(7, 1, 2, 1718771825, 'Auxx', 2147483647, '2021-06-18'),
(8, 1, 2, 1718771825, 'Andressssssssss', 7, '2021-06-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesos`
--

CREATE TABLE `procesos` (
  `idproceso` int(11) NOT NULL,
  `nombreproceso` varchar(150) NOT NULL,
  `liderproceso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `procesos`
--

INSERT INTO `procesos` (`idproceso`, `nombreproceso`, `liderproceso`) VALUES
(2, 'Compras', 3),
(4, 'Compras', 3),
(5, 'Ventas', 2),
(6, 'Recepcion', 3),
(7, 'Compras', 3),
(8, 'Recepcion', 3),
(9, 'Recepcion', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Auditor'),
(3, 'Auditado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_user` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `rol` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_user`, `user`, `password`, `correo`, `rol`, `estatus`) VALUES
(1, 'ivan', '102ddaf691e1615d5dacd4c86299bfa4', 'ivanes285@gmail.com', 1, 1),
(2, 'francis', '102ddaf691e1615d5dacd4c86299bfa4', 'francis@gmail.com', 2, 1),
(3, 'malcom', '102ddaf691e1615d5dacd4c86299bfa4', 'malcom@gmail.com', 2, 1),
(4, 'Don Aux', '102ddaf691e1615d5dacd4c86299bfa4', '', 3, 1),
(5, 'brandon', '102ddaf691e1615d5dacd4c86299bfa4', '', 3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `grupoauditor`
--
ALTER TABLE `grupoauditor`
  ADD PRIMARY KEY (`idgrupo`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idnorma` (`idnorma`);

--
-- Indices de la tabla `norma`
--
ALTER TABLE `norma`
  ADD PRIMARY KEY (`idnorma`);

--
-- Indices de la tabla `pastel`
--
ALTER TABLE `pastel`
  ADD PRIMARY KEY (`id_pastel`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pastel` (`id_pastel`);

--
-- Indices de la tabla `procesos`
--
ALTER TABLE `procesos`
  ADD PRIMARY KEY (`idproceso`),
  ADD KEY `liderproceso` (`liderproceso`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `grupoauditor`
--
ALTER TABLE `grupoauditor`
  MODIFY `idgrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `norma`
--
ALTER TABLE `norma`
  MODIFY `idnorma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pastel`
--
ALTER TABLE `pastel`
  MODIFY `id_pastel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `procesos`
--
ALTER TABLE `procesos`
  MODIFY `idproceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `grupoauditor`
--
ALTER TABLE `grupoauditor`
  ADD CONSTRAINT `grupoauditor_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grupoauditor_ibfk_2` FOREIGN KEY (`idnorma`) REFERENCES `norma` (`idnorma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_pastel`) REFERENCES `pastel` (`id_pastel`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_user`);

--
-- Filtros para la tabla `procesos`
--
ALTER TABLE `procesos`
  ADD CONSTRAINT `procesos_ibfk_1` FOREIGN KEY (`liderproceso`) REFERENCES `usuario` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`idrol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-07-2021 a las 03:43:16
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
-- Base de datos: `terrafertil`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleauditoria`
--

CREATE TABLE `detalleauditoria` (
  `iddetalleauditoria` int(11) NOT NULL,
  `codigoauditoria` varchar(80) NOT NULL,
  `idperiodo` int(11) NOT NULL,
  `fechacreacion` date NOT NULL DEFAULT current_timestamp(),
  `fechaejecucion` date NOT NULL,
  `idgrupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalleauditoria`
--

INSERT INTO `detalleauditoria` (`iddetalleauditoria`, `codigoauditoria`, `idperiodo`, `fechacreacion`, `fechaejecucion`, `idgrupo`) VALUES
(1, 'Cod-9001', 1, '2021-07-11', '2021-07-21', 1),
(2, 'Cod-9002', 2, '2021-07-11', '2021-07-24', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallegrupo`
--

CREATE TABLE `detallegrupo` (
  `id_user` int(11) NOT NULL,
  `idgrupo` int(11) NOT NULL,
  `idrolauditor` int(11) NOT NULL,
  `actividadrealizada` varchar(200) NOT NULL,
  `iddetallegrupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detallegrupo`
--

INSERT INTO `detallegrupo` (`id_user`, `idgrupo`, `idrolauditor`, `actividadrealizada`, `iddetallegrupo`) VALUES
(2, 1, 1, 'Es un auditor lider', 1),
(8, 1, 2, 'Es una auditora secundaria que brinda ayuda al lider auditor', 4),
(12, 5, 1, 'Auditora lider ', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupoauditor`
--

CREATE TABLE `grupoauditor` (
  `idgrupo` int(11) NOT NULL,
  `nombregrupo` varchar(50) NOT NULL,
  `idnorma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grupoauditor`
--

INSERT INTO `grupoauditor` (`idgrupo`, `nombregrupo`, `idnorma`) VALUES
(1, 'GrupoIso9001', 1),
(3, 'GrupoBRC', 3),
(4, 'GrupoBpm', 4),
(5, 'GrupoBasc', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `norma`
--

CREATE TABLE `norma` (
  `idnorma` int(11) NOT NULL,
  `nombrenorma` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `norma`
--

INSERT INTO `norma` (`idnorma`, `nombrenorma`) VALUES
(1, 'ISO9001'),
(2, 'Basc'),
(3, 'Bcr'),
(4, 'Bpm ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--

CREATE TABLE `periodo` (
  `idperiodo` int(11) NOT NULL,
  `tiempoperiodo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `periodo`
--

INSERT INTO `periodo` (`idperiodo`, `tiempoperiodo`) VALUES
(1, '4 meses '),
(2, '6 meses'),
(3, '12 meses');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesos`
--

CREATE TABLE `procesos` (
  `idproceso` int(11) NOT NULL,
  `nombreproceso` varchar(50) NOT NULL,
  `liderproceso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `procesos`
--

INSERT INTO `procesos` (`idproceso`, `nombreproceso`, `liderproceso`) VALUES
(1, 'Compras', 2),
(2, 'Ventas y Mercadeo', 2),
(3, 'Direccion Estratégica', 3),
(4, 'Investigacion y Desarrollo ', 4),
(5, 'Sistema Integrado de gestion, evalacion y mejorami', 11),
(6, 'Produccion', 12),
(7, 'Almacenamiento y Logistica', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Auditor'),
(3, 'Auditado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rolauditor`
--

CREATE TABLE `rolauditor` (
  `idrolauditor` int(11) NOT NULL,
  `rolauditor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rolauditor`
--

INSERT INTO `rolauditor` (`idrolauditor`, `rolauditor`) VALUES
(1, 'Auditor Lider '),
(2, 'Auditor Secundario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_user` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `rol` int(11) NOT NULL,
  `estatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_user`, `user`, `password`, `correo`, `rol`, `estatus`) VALUES
(1, 'ivan', '102ddaf691e1615d5dacd4c86299bfa4', 'ialescanov@utn.edu.ec', 1, 1),
(2, 'malcom', '102ddaf691e1615d5dacd4c86299bfa4', '', 2, 1),
(3, 'francis', '102ddaf691e1615d5dacd4c86299bfa4', '', 2, 1),
(4, 'hall', '102ddaf691e1615d5dacd4c86299bfa4', '', 2, 1),
(5, 'ressee', '102ddaf691e1615d5dacd4c86299bfa4', 'resee', 3, 1),
(6, 'andy', '102ddaf691e1615d5dacd4c86299bfa4', 'andy@gmail.com', 3, 1),
(7, 'dewey', '102ddaf691e1615d5dacd4c86299bfa4', 'dewey@gmail.com', 3, 1),
(8, 'lois', '102ddaf691e1615d5dacd4c86299bfa4', 'lois@gmail.com', 2, 1),
(9, 'stevie', '102ddaf691e1615d5dacd4c86299bfa4', 'stevie@gmail.com', 3, 1),
(10, 'craig', '102ddaf691e1615d5dacd4c86299bfa4', 'craig@gmail.com', 3, 1),
(11, 'lavernia', '102ddaf691e1615d5dacd4c86299bfa4', 'lavernia@gmail.com', 2, 1),
(12, 'piama', '102ddaf691e1615d5dacd4c86299bfa4', 'piama@gmail.com', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalleauditoria`
--
ALTER TABLE `detalleauditoria`
  ADD PRIMARY KEY (`iddetalleauditoria`),
  ADD KEY `idperiodo` (`idperiodo`),
  ADD KEY `idgrupo` (`idgrupo`);

--
-- Indices de la tabla `detallegrupo`
--
ALTER TABLE `detallegrupo`
  ADD PRIMARY KEY (`iddetallegrupo`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `idgrupo` (`idgrupo`),
  ADD KEY `idrolauditor` (`idrolauditor`);

--
-- Indices de la tabla `grupoauditor`
--
ALTER TABLE `grupoauditor`
  ADD PRIMARY KEY (`idgrupo`),
  ADD KEY `idnorma` (`idnorma`);

--
-- Indices de la tabla `norma`
--
ALTER TABLE `norma`
  ADD PRIMARY KEY (`idnorma`);

--
-- Indices de la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`idperiodo`);

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
-- Indices de la tabla `rolauditor`
--
ALTER TABLE `rolauditor`
  ADD PRIMARY KEY (`idrolauditor`);

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
-- AUTO_INCREMENT de la tabla `detalleauditoria`
--
ALTER TABLE `detalleauditoria`
  MODIFY `iddetalleauditoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detallegrupo`
--
ALTER TABLE `detallegrupo`
  MODIFY `iddetallegrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `grupoauditor`
--
ALTER TABLE `grupoauditor`
  MODIFY `idgrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `norma`
--
ALTER TABLE `norma`
  MODIFY `idnorma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `periodo`
--
ALTER TABLE `periodo`
  MODIFY `idperiodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `procesos`
--
ALTER TABLE `procesos`
  MODIFY `idproceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rolauditor`
--
ALTER TABLE `rolauditor`
  MODIFY `idrolauditor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalleauditoria`
--
ALTER TABLE `detalleauditoria`
  ADD CONSTRAINT `detalleauditoria_ibfk_1` FOREIGN KEY (`idgrupo`) REFERENCES `detallegrupo` (`idgrupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalleauditoria_ibfk_2` FOREIGN KEY (`idperiodo`) REFERENCES `periodo` (`idperiodo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detallegrupo`
--
ALTER TABLE `detallegrupo`
  ADD CONSTRAINT `detallegrupo_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detallegrupo_ibfk_2` FOREIGN KEY (`idrolauditor`) REFERENCES `rolauditor` (`idrolauditor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detallegrupo_ibfk_3` FOREIGN KEY (`idgrupo`) REFERENCES `grupoauditor` (`idgrupo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `grupoauditor`
--
ALTER TABLE `grupoauditor`
  ADD CONSTRAINT `grupoauditor_ibfk_1` FOREIGN KEY (`idnorma`) REFERENCES `norma` (`idnorma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `procesos`
--
ALTER TABLE `procesos`
  ADD CONSTRAINT `procesos_ibfk_1` FOREIGN KEY (`liderproceso`) REFERENCES `usuario` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

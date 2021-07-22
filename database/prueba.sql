-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-07-2021 a las 05:59:46
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexoclausula`
--

CREATE TABLE `anexoclausula` (
  `idanexo` int(11) NOT NULL,
  `idclausula` int(11) NOT NULL,
  `nombreanexo` varchar(100) NOT NULL,
  `anexoclausula` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clausula`
--

CREATE TABLE `clausula` (
  `idclausula` int(11) NOT NULL,
  `clausula` varchar(50) NOT NULL,
  `detalleclausula` varchar(2000) NOT NULL,
  `idnorma` int(11) NOT NULL,
  `idproceso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clausula`
--

INSERT INTO `clausula` (`idclausula`, `clausula`, `detalleclausula`, `idnorma`, `idproceso`) VALUES
(1, '4. CONTEXTO DE LA ORGANIZACIÓN', '4.1  COMPRENSIÓN DE LA ORGANIZACIÓN Y SU CONTEXTO\nLa organización debe determinar las cuestiones externas e internas que son pertinentes para su propósito y su dirección estratégica, y que afectan a su capacidad para lograr los resultados previstos de su sistema de gestión de la calidad.', 1, 1),
(2, '4. CONTEXTO DE LA ORGANIZACIÓN', '4.1  COMPRENSIÓN DE LA ORGANIZACIÓN Y SU CONTEXTO\r\nLa organización debe realizar el seguimiento y la revisión de la información sobre cuestiones externas e internas.\r\n\r\nNota 1. Las cuestiones pueden incluir factores positivos y negativos o condiciones para su consideración\r\nNota 2. La comprensión del contexto externo puede verse facilitada al considerar cuestiones que surgen de los entornos legal, tecnológico, competitivo, de mercado, cultural, social y económico, ya sea internacional, nacional, regional o local.\r\nNota 3. El conocimiento del contexto interno puede verse facilitado al considerar cuestiones relativas a los valores, la cultura, los conocimientos y el desempeño de la organización.', 1, 2),
(3, '3.2  dfadfldjfad', 'dfadfadfadf gfdgsfgsfd\r\n', 3, 1),
(4, '5. CONTEXTO DE LA ORGANIZACIÓN', 'dfadfaddfadfdafadfadfad', 1, 1),
(5, '5. CONTEXTO DE LA ORGANIZACIÓN', 'dfadfdfgd6f15d1f51d21fa5d15f1ad', 1, 2),
(6, '3.2  BASC', 'FDFAJjld fadf 55258dfadf ', 3, 1),
(7, '3.2.2  BASC ', 'dfadfadghghf', 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleauditoria`
--

CREATE TABLE `detalleauditoria` (
  `iddetalleauditoria` int(11) NOT NULL,
  `codigoauditoria` varchar(80) NOT NULL,
  `idperiodo` int(11) NOT NULL,
  `fechaejecucion` date NOT NULL,
  `idgrupo` int(11) NOT NULL,
  `fechacreacion` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalleauditoria`
--

INSERT INTO `detalleauditoria` (`iddetalleauditoria`, `codigoauditoria`, `idperiodo`, `fechaejecucion`, `idgrupo`, `fechacreacion`) VALUES
(74, 'Cod-9001', 1, '2021-07-22', 1, '2021-07-21'),
(75, 'Cod-9002', 2, '2021-07-30', 3, '2021-07-21'),
(77, 'Cod-9004', 1, '2021-07-22', 1, '2021-07-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleclausula`
--

CREATE TABLE `detalleclausula` (
  `iddetalleclausula` int(11) NOT NULL,
  `idclausula` int(11) NOT NULL,
  `parametroscalificacion` varchar(100) DEFAULT NULL,
  `desincumplimiento` varchar(150) DEFAULT NULL,
  `documentacionsoporte` varchar(150) DEFAULT NULL,
  `iddetalleauditoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalleclausula`
--

INSERT INTO `detalleclausula` (`iddetalleclausula`, `idclausula`, `parametroscalificacion`, `desincumplimiento`, `documentacionsoporte`, `iddetalleauditoria`) VALUES
(44, 5, NULL, NULL, NULL, 74),
(45, 5, NULL, NULL, NULL, 74),
(46, 5, NULL, NULL, NULL, 74),
(47, 5, NULL, NULL, NULL, 74),
(48, 7, NULL, NULL, NULL, 75),
(49, 7, NULL, NULL, NULL, 75),
(50, 7, NULL, NULL, NULL, 75),
(59, 5, NULL, NULL, NULL, 77),
(60, 5, NULL, NULL, NULL, 77),
(61, 5, NULL, NULL, NULL, 77),
(62, 5, NULL, NULL, NULL, 77),
(63, 5, NULL, NULL, NULL, 77),
(64, 5, NULL, NULL, NULL, 77),
(65, 5, NULL, NULL, NULL, 77),
(66, 5, NULL, NULL, NULL, 77);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallegrupo`
--

CREATE TABLE `detallegrupo` (
  `id_user` int(11) NOT NULL,
  `idgrupo` int(11) NOT NULL,
  `idrolauditor` int(11) NOT NULL,
  `actividadrealizada` varchar(150) NOT NULL,
  `iddetallegrupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detallegrupo`
--

INSERT INTO `detallegrupo` (`id_user`, `idgrupo`, `idrolauditor`, `actividadrealizada`, `iddetallegrupo`) VALUES
(2, 1, 1, 'lllll', 1),
(3, 2, 1, 'gggggggggg', 2),
(5, 3, 1, 'gfgsfgsf', 3),
(2, 3, 2, 'dfdfad', 4),
(5, 1, 2, 'dfds', 9),
(3, 7, 1, 'gfg', 10),
(3, 4, 1, 'dfdf', 11),
(5, 4, 2, 'dfdsfdddd', 14),
(3, 9, 1, 'dfdfa dfadkjfajd ', 15);

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
(1, 'team9001', 1),
(2, 'teambcr', 4),
(3, 'GrupoBasc', 3),
(4, 'teambpm', 2),
(7, 'grupoprueba', 3),
(9, 'GrupoIso9001-02', 1);

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
(1, 'iso9001'),
(2, 'bpm'),
(3, 'basc'),
(4, 'brc');

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
(1, 'Direccion Estratégica', 5),
(2, 'Evaluacion y Mejoramiento', 4);

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
(2, 'malcom', '102ddaf691e1615d5dacd4c86299bfa4', 'malcom@gmail.com', 2, 1),
(3, 'francis', '102ddaf691e1615d5dacd4c86299bfa4', 'francis@gmail.com', 2, 1),
(4, 'lois', '102ddaf691e1615d5dacd4c86299bfa4', 'lois@gmail.com', 3, 1),
(5, 'hall', '102ddaf691e1615d5dacd4c86299bfa4', 'hall@gmail.com', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anexoclausula`
--
ALTER TABLE `anexoclausula`
  ADD PRIMARY KEY (`idanexo`),
  ADD KEY `idclausula` (`idclausula`);

--
-- Indices de la tabla `clausula`
--
ALTER TABLE `clausula`
  ADD PRIMARY KEY (`idclausula`),
  ADD KEY `idnorma` (`idnorma`),
  ADD KEY `idproceso` (`idproceso`);

--
-- Indices de la tabla `detalleauditoria`
--
ALTER TABLE `detalleauditoria`
  ADD PRIMARY KEY (`iddetalleauditoria`),
  ADD KEY `idperiodo` (`idperiodo`),
  ADD KEY `idgrupo` (`idgrupo`);

--
-- Indices de la tabla `detalleclausula`
--
ALTER TABLE `detalleclausula`
  ADD PRIMARY KEY (`iddetalleclausula`),
  ADD KEY `idclausula` (`idclausula`),
  ADD KEY `iddetalleauditoria` (`iddetalleauditoria`);

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
-- AUTO_INCREMENT de la tabla `anexoclausula`
--
ALTER TABLE `anexoclausula`
  MODIFY `idanexo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clausula`
--
ALTER TABLE `clausula`
  MODIFY `idclausula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `detalleauditoria`
--
ALTER TABLE `detalleauditoria`
  MODIFY `iddetalleauditoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `detalleclausula`
--
ALTER TABLE `detalleclausula`
  MODIFY `iddetalleclausula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `detallegrupo`
--
ALTER TABLE `detallegrupo`
  MODIFY `iddetallegrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `grupoauditor`
--
ALTER TABLE `grupoauditor`
  MODIFY `idgrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `idproceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anexoclausula`
--
ALTER TABLE `anexoclausula`
  ADD CONSTRAINT `anexoclausula_ibfk_1` FOREIGN KEY (`idclausula`) REFERENCES `clausula` (`idclausula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `clausula`
--
ALTER TABLE `clausula`
  ADD CONSTRAINT `clausula_ibfk_1` FOREIGN KEY (`idnorma`) REFERENCES `norma` (`idnorma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clausula_ibfk_2` FOREIGN KEY (`idproceso`) REFERENCES `procesos` (`idproceso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalleauditoria`
--
ALTER TABLE `detalleauditoria`
  ADD CONSTRAINT `detalleauditoria_ibfk_1` FOREIGN KEY (`idgrupo`) REFERENCES `detallegrupo` (`idgrupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalleauditoria_ibfk_2` FOREIGN KEY (`idperiodo`) REFERENCES `periodo` (`idperiodo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalleclausula`
--
ALTER TABLE `detalleclausula`
  ADD CONSTRAINT `detalleclausula_ibfk_1` FOREIGN KEY (`iddetalleauditoria`) REFERENCES `detalleauditoria` (`iddetalleauditoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalleclausula_ibfk_2` FOREIGN KEY (`idclausula`) REFERENCES `clausula` (`idclausula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detallegrupo`
--
ALTER TABLE `detallegrupo`
  ADD CONSTRAINT `detallegrupo_ibfk_1` FOREIGN KEY (`idgrupo`) REFERENCES `grupoauditor` (`idgrupo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detallegrupo_ibfk_2` FOREIGN KEY (`idrolauditor`) REFERENCES `rolauditor` (`idrolauditor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detallegrupo_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

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

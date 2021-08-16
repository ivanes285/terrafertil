-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-08-2021 a las 23:57:43
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
-- Base de datos: `terra`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accionespropuestas`
--

CREATE TABLE `accionespropuestas` (
  `idaccionpropuesta` int(11) NOT NULL,
  `idplanaccion` int(11) NOT NULL,
  `accionpropuesta` varchar(100) NOT NULL,
  `responsable` varchar(100) NOT NULL,
  `fechapropuesta` date NOT NULL,
  `evidencia` varchar(150) NOT NULL,
  `fechacumplimiento` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `motivonoaceptacion` varchar(150) DEFAULT NULL,
  `eficacia` varchar(100) DEFAULT NULL,
  `estadover` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `accionespropuestas`
--

INSERT INTO `accionespropuestas` (`idaccionpropuesta`, `idplanaccion`, `accionpropuesta`, `responsable`, `fechapropuesta`, `evidencia`, `fechacumplimiento`, `status`, `motivonoaceptacion`, `eficacia`, `estadover`) VALUES
(13, 20, 'Ivan', 'Ivan', '2021-08-19', 'Ivan', '2021-08-18', 'aceptado', '', 'excelente', 2),
(14, 20, 'don Aux', 'don Aux', '2021-08-18', 'don Aux', NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexo`
--

CREATE TABLE `anexo` (
  `idanexo` int(11) NOT NULL,
  `iddetalleclausula` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `anexo` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexopropuestas`
--

CREATE TABLE `anexopropuestas` (
  `idanexopropuesta` int(11) NOT NULL,
  `idaccionpropuesta` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `anexo` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clausula`
--

CREATE TABLE `clausula` (
  `idclausula` int(11) NOT NULL,
  `clausula` varchar(200) NOT NULL,
  `detalleclausula` varchar(2000) NOT NULL,
  `idnorma` int(11) NOT NULL,
  `idproceso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clausula`
--

INSERT INTO `clausula` (`idclausula`, `clausula`, `detalleclausula`, `idnorma`, `idproceso`) VALUES
(12, '4.1  COMPRENSIÓN DE LA ORGANIZACIÓN Y SU CONTEXTO', 'La organización debe determinar las cuestiones externas e internas que son pertinentes para su propósito y su dirección estratégica, y que afectan a su capacidad para lograr los resultados previstos de su sistema de gestión de la calidad.', 1, 6),
(13, '4.1  COMPRENSIÓN DE LA ORGANIZACIÓN Y SU CONTEXTO', 'La organización debe determinar las cuestiones externas e internas que son pertinentes para su propósito y su dirección estratégica, y que afectan a su capacidad para lograr los resultados previstos de su sistema de gestión de la calidad.', 1, 7),
(16, '4.2 COMPRENSIÓN DE LAS NECESIDADES Y EXPECTATIVAS DE LAS PARTES INTERESADAS', 'Debido a su efecto o efecto potencial en la capacidad de la organización de proporcionar regularmente productos y servicios que satisfagan los requisitos del cliente y los legales y reglamentarios aplicables, la organización debe determinar: a) las partes interesadas que son pertinentes al sistema de gestión de la calidad;\r\nb) los requisitos pertinentes de estas partes interesadas para el sistema de gestión de la calidad.', 1, 6),
(17, '4.2 COMPRENSIÓN DE LAS NECESIDADES Y EXPECTATIVAS DE LAS PARTES INTERESADAS', 'Debido a su efecto o efecto potencial en la capacidad de la organización de proporcionar regularmente productos y servicios que satisfagan los requisitos del cliente y los legales y reglamentarios aplicables, la organización debe determinar: a) las partes interesadas que son pertinentes al sistema de gestión de la calidad;\r\nb) los requisitos pertinentes de estas partes interesadas para el sistema de gestión de la calidad.', 1, 7),
(18, '4.3 DETERMINACIÓN DEL ALCANCE DEL SISTEMA DE GESTIÓN DE LA CALIDAD', 'Cuando se determina este alcance, la organización debe considerar:\r\na) las cuestiones externas e internas indicadas en el apartado 4.1;\r\nb) los requisitos de las partes interesadas pertinentes indicados en el apartado 4.2;\r\nc) los productos y servicios de la organización.', 1, 6),
(19, '4.3 DETERMINACIÓN DEL ALCANCE DEL SISTEMA DE GESTIÓN DE LA CALIDAD', 'Cuando se determina este alcance, la organización debe considerar\r\n\r\na) las cuestiones externas e internas indicadas en el apartado 4.1;\r\n\r\nb) los requisitos de las partes interesadas pertinentes indicados en el apartado 4.2;\r\n\r\nc) los productos y servicios de la organización.', 1, 7),
(20, '4.4 SISTEMA DE GESTIÓN DE LA CALIDAD Y SUS PROCESOS', 'La organización debe determinar los procesos necesarios para el sistema de gestión de la calidad y su aplicación a través de la organización, y debe:\r\na) determinar las entradas requeridas y las salidas esperados de estos procesos;\r\nb) determinar la secuencia e interacción de estos procesos;\r\nc) determinar y aplicar los criterios y los métodos (incluyendo el seguimiento, la medición y los indicadores del desempeño relacionados) necesarios para asegurarse la operación eficaz y el control de estos procesos;\r\nd) determinar los recursos necesarios para estos procesos y asegurarse de su disponibilidad;\r\ne) asignar las responsabilidades y autoridades para estos procesos;\r\nf) abordar los riesgos y oportunidades determinados de acuerdo con los requisitos del apartado 6.1;\r\ng) evaluar estos procesos e implementar cualquier cambio necesario para asegurarse de que estos procesos logran los resultados previstos;\r\nh) mejorar los procesos y el sistema de gestión de la calidad.', 1, 6),
(21, '4.4 SISTEMA DE GESTIÓN DE LA CALIDAD Y SUS PROCESOS', '4.4.2 \r\nEn la medida en que sea necesario, la organización debe:\r\na) mantener información documentada para apoyar la operación de sus procesos;\r\nb) conservar la información documentada para tener la confianza de que los procesos se realizan según lo planificado.', 1, 6),
(22, '5.1 LIDERAZGO Y COMPROMISO', '\r\nLa alta dirección debe demostrar liderazgo y compromiso con respecto al sistema de gestión de la calidad:\r\na) asumiendo la rendición de cuentas de la eficacia del sistema de gestión de la calidad;', 3, 7),
(23, '5.1 LIDERAZGO Y COMPROMISO', '\r\nLa alta dirección debe demostrar liderazgo y compromiso con respecto al sistema de gestión de la calidad:\r\na) asumiendo la rendición de cuentas de la eficacia del sistema de gestión de la calidad;', 3, 6),
(24, '5.1 LIDERAZGO Y COMPROMISO\r\n', 'La alta dirección debe demostrar liderazgo y compromiso con respecto al sistema de gestión de la calidad:\r\na) asumiendo la rendición de cuentas de la eficacia del sistema de gestión de la calidad;', 3, 4),
(25, '5.1 LIDERAZGO Y COMPROMISO', 'La alta dirección debe demostrar liderazgo y compromiso con respecto al sistema de gestión de la calidad:\r\na) asumiendo la rendición de cuentas de la eficacia del sistema de gestión de la calidad;', 3, 7),
(30, '8.3.5 Salidas del diseño y desarrollo', 'La organización debe asegurarse de que las salidas del diseño y desarrollo:\r\na) cumplen los requisitos de las entradas; \r\nb) son adecuadas para los procesos posteriores para la provisión de productos y servicios;\r\nc) incluyen o hacen referencia a los requisitos de seguimiento y medición, cuando sea apropiado, y a los criterios de aceptación;\r\nd) especifican las características de los productos y servicios que son esenciales para su propósito previsto y su provisión segura y correcta.\r\n\r\nLa organización debe conservar información documentada sobre las salidas del diseño y desarrollo.', 4, 6),
(31, '8.3.5 Salidas del diseño y desarrollo\r\n', 'La organización debe asegurarse de que las salidas del diseño y desarrollo:\r\na) cumplen los requisitos de las entradas; \r\nb) son adecuadas para los procesos posteriores para la provisión de productos y servicios;\r\nc) incluyen o hacen referencia a los requisitos de seguimiento y medición, cuando sea apropiado, y a los criterios de aceptación;\r\nd) especifican las características de los productos y servicios que son esenciales para su propósito previsto y su provisión segura y correcta.\r\n\r\nLa organización debe conservar información documentada sobre las salidas del diseño y desarrollo.', 4, 4),
(32, '8.3.5 Salidas del diseño y desarrollo', 'La organización debe asegurarse de que las salidas del diseño y desarrollo:\r\na) cumplen los requisitos de las entradas; \r\nb) son adecuadas para los procesos posteriores para la provisión de productos y servicios;\r\nc) incluyen o hacen referencia a los requisitos de seguimiento y medición, cuando sea apropiado, y a los criterios de aceptación;\r\nd) especifican las características de los productos y servicios que son esenciales para su propósito previsto y su provisión segura y correcta.\r\n\r\nLa organización debe conservar información documentada sobre las salidas del diseño y desarrollo.', 4, 5);

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
  `fechacreacion` date NOT NULL DEFAULT current_timestamp(),
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalleauditoria`
--

INSERT INTO `detalleauditoria` (`iddetalleauditoria`, `codigoauditoria`, `idperiodo`, `fechaejecucion`, `idgrupo`, `fechacreacion`, `estado`) VALUES
(112, 'Cod-9001', 3, '2021-08-18', 1, '2021-08-16', 1),
(113, 'Cod-9002', 2, '2021-08-25', 3, '2021-08-16', 1);

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
  `iddetalleauditoria` int(11) NOT NULL,
  `planaccion` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalleclausula`
--

INSERT INTO `detalleclausula` (`iddetalleclausula`, `idclausula`, `parametroscalificacion`, `desincumplimiento`, `documentacionsoporte`, `iddetalleauditoria`, `planaccion`) VALUES
(246, 12, NULL, NULL, NULL, 112, 1),
(247, 13, NULL, NULL, NULL, 112, 1),
(248, 16, NULL, NULL, NULL, 112, 1),
(249, 17, NULL, NULL, NULL, 112, 1),
(250, 18, NULL, NULL, NULL, 112, 1),
(251, 19, NULL, NULL, NULL, 112, 1),
(252, 20, NULL, NULL, NULL, 112, 1),
(253, 21, NULL, NULL, NULL, 112, 1),
(254, 22, 'noconformidadmayor', 'No conformidad mayor', 'No conformidad mayor', 113, 2),
(255, 23, NULL, NULL, NULL, 113, 1),
(256, 24, NULL, NULL, NULL, 113, 1),
(257, 25, NULL, NULL, NULL, 113, 1);

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
(2, 1, 1, 'Auditor lider ', 17),
(3, 1, 2, 'Auditor secundario', 18),
(5, 3, 1, 'lider', 19),
(11, 3, 2, 'secundario', 20);

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
(1, 'GrupoISO9001', 1),
(2, 'teambcr', 4),
(3, 'GrupoBasc', 3),
(4, 'teambpm', 2);

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
-- Estructura de tabla para la tabla `plandeaccion`
--

CREATE TABLE `plandeaccion` (
  `idplandeaccion` int(11) NOT NULL,
  `iddetalleclausula` int(11) NOT NULL,
  `consecuencia` varchar(150) NOT NULL,
  `analisiscausa` varchar(150) NOT NULL,
  `desarrollometodo` varchar(300) NOT NULL,
  `causaraiz` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `plandeaccion`
--

INSERT INTO `plandeaccion` (`idplandeaccion`, `iddetalleclausula`, `consecuencia`, `analisiscausa`, `desarrollometodo`, `causaraiz`) VALUES
(20, 254, 'ggg', 'Lluvia de ideas', 'dgadg', 'gega');

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
(3, 'Investigacion y Desarrollo', 10),
(4, 'Compras', 9),
(5, 'Produccion', 7),
(6, 'Evaluacion y Mejoramiento', 4),
(7, 'Direccion Estrategica', 8);

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
(3, 'francis', '102ddaf691e1615d5dacd4c86299bfa4', 'francis@gmail.com', 2, 0),
(4, 'lois', '102ddaf691e1615d5dacd4c86299bfa4', 'lois@gmail.com', 3, 1),
(5, 'hall', '102ddaf691e1615d5dacd4c86299bfa4', 'hall@gmail.com', 2, 1),
(6, 'daya', '102ddaf691e1615d5dacd4c86299bfa4', 'dayamineral@gmail.com', 2, 1),
(7, 'anavera', '102ddaf691e1615d5dacd4c86299bfa4', 'anavera@gmail.com', 3, 1),
(8, 'andy', '102ddaf691e1615d5dacd4c86299bfa4', 'andy@gmail.com', 3, 1),
(9, 'alex', '102ddaf691e1615d5dacd4c86299bfa4', 'alex@gmail.com', 3, 1),
(10, 'marianita', '102ddaf691e1615d5dacd4c86299bfa4', 'marianita@gmail.com', 3, 1),
(11, 'yoda', '102ddaf691e1615d5dacd4c86299bfa4', 'alvarez@gmail.com', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accionespropuestas`
--
ALTER TABLE `accionespropuestas`
  ADD PRIMARY KEY (`idaccionpropuesta`),
  ADD KEY `idplanaccion` (`idplanaccion`);

--
-- Indices de la tabla `anexo`
--
ALTER TABLE `anexo`
  ADD PRIMARY KEY (`idanexo`),
  ADD KEY `iddetalleclausula` (`iddetalleclausula`);

--
-- Indices de la tabla `anexopropuestas`
--
ALTER TABLE `anexopropuestas`
  ADD PRIMARY KEY (`idanexopropuesta`),
  ADD KEY `idaccionpropuesta` (`idaccionpropuesta`);

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
-- Indices de la tabla `plandeaccion`
--
ALTER TABLE `plandeaccion`
  ADD PRIMARY KEY (`idplandeaccion`),
  ADD KEY `iddetalleclausula` (`iddetalleclausula`);

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
-- AUTO_INCREMENT de la tabla `accionespropuestas`
--
ALTER TABLE `accionespropuestas`
  MODIFY `idaccionpropuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `anexo`
--
ALTER TABLE `anexo`
  MODIFY `idanexo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `anexopropuestas`
--
ALTER TABLE `anexopropuestas`
  MODIFY `idanexopropuesta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clausula`
--
ALTER TABLE `clausula`
  MODIFY `idclausula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `detalleauditoria`
--
ALTER TABLE `detalleauditoria`
  MODIFY `iddetalleauditoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT de la tabla `detalleclausula`
--
ALTER TABLE `detalleclausula`
  MODIFY `iddetalleclausula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

--
-- AUTO_INCREMENT de la tabla `detallegrupo`
--
ALTER TABLE `detallegrupo`
  MODIFY `iddetallegrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
-- AUTO_INCREMENT de la tabla `plandeaccion`
--
ALTER TABLE `plandeaccion`
  MODIFY `idplandeaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accionespropuestas`
--
ALTER TABLE `accionespropuestas`
  ADD CONSTRAINT `accionespropuestas_ibfk_1` FOREIGN KEY (`idplanaccion`) REFERENCES `plandeaccion` (`idplandeaccion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `anexo`
--
ALTER TABLE `anexo`
  ADD CONSTRAINT `anexo_ibfk_1` FOREIGN KEY (`iddetalleclausula`) REFERENCES `detalleclausula` (`iddetalleclausula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `anexopropuestas`
--
ALTER TABLE `anexopropuestas`
  ADD CONSTRAINT `anexopropuestas_ibfk_1` FOREIGN KEY (`idaccionpropuesta`) REFERENCES `accionespropuestas` (`idaccionpropuesta`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Filtros para la tabla `plandeaccion`
--
ALTER TABLE `plandeaccion`
  ADD CONSTRAINT `plandeaccion_ibfk_1` FOREIGN KEY (`iddetalleclausula`) REFERENCES `detalleclausula` (`iddetalleclausula`) ON DELETE CASCADE ON UPDATE CASCADE;

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

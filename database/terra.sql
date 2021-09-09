-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-09-2021 a las 03:26:43
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
(41, 44, 'plan01 accion01', 'RAUL', '2021-09-23', 'fOTO01', '2021-09-15', 'aceptado', '', 'bueno', 2),
(42, 44, 'plan01 accion02', 'Pedro', '2021-09-24', 'pdf', '2021-09-29', 'aceptado', '', 'excelente', 2),
(43, 44, 'plan01 accion03', 'Maria', '2021-09-10', 'WORD', '2021-09-23', 'aceptado', '', 'bueno', 2),
(44, 45, 'plan02 accion01', 'ALEX', '2021-09-10', 'PDF', '2021-09-16', 'aceptado', '', 'excelente', 2),
(45, 45, 'plan02 accion02', 'ANDY', '2021-09-23', 'DFADF', '2021-09-22', 'aceptado', '', 'bueno', 2),
(46, 46, 'plan03 accion01', 'Luis', '2021-09-23', 'WORD', '2021-09-10', 'aceptado', '', 'regular', 2),
(47, 46, 'plan03 accion02', 'HARRY', '2021-09-17', 'pdf', '2021-09-22', 'aceptado', '', 'bueno', 2),
(48, 46, 'plan03 accion03', 'HERMAYONI', '2021-09-24', 'DOCUMENTO', '2021-09-22', 'aceptado', '', 'bueno', 2),
(49, 47, 'Plan01 Accion01', 'GRIFINDOR', '2021-09-16', 'FFF', '2021-09-16', 'aceptado', '', 'bueno', 2),
(50, 47, 'Plan01 Accion02', 'SLIDERIN', '2021-09-23', 'GG', '2021-09-23', 'aceptado', '', 'regular', 2),
(51, 48, 'Plan02 Accion01', 'HAFHULPOF', '2021-09-16', 'TT', '2021-09-09', 'aceptado', '', 'excelente', 2),
(52, 48, 'pedro picapiedra', 'OCTOPUS x2', '2021-09-18', 'RRddd', '2021-09-16', 'aceptado', '', 'bueno', 2),
(53, 49, 'Plan02 Accion01', 'SNAPE', '2021-09-11', 'UU', '2021-09-18', 'no aceptado', 'Porque no cumple', '', 1),
(54, 49, 'Plan02 Accion02', 'DONBULDORT', '2021-09-16', 'EE', '2021-09-22', 'aceptado', '', 'bueno', 2),
(55, 50, 'Plan02 Accion01', 'OCTAVIO', '2021-09-22', 'TT', '2021-09-10', 'aceptado', '', 'excelente', 2),
(56, 50, 'Plan02 Accion02', 'OTTO', '2021-09-23', 'hh', '2021-09-16', 'aceptado', '', 'bueno', 2),
(57, 51, 'plan01 accion01', 'MERY JAIN', '2021-09-09', 'HH', '2021-09-22', 'aceptado', '', 'regular', 2),
(58, 51, 'plan01 accion02', 'HULK', '2021-09-24', 'KK', '2021-09-09', 'aceptado', '', 'bueno', 2),
(59, 52, 'plan02 accion01', 'JACK SPARROW', '2021-09-16', 'JJ', '2021-09-22', 'aceptado', '', 'excelente', 2),
(60, 52, 'plan02 accion02', 'LORO', '2021-09-25', 'YY', '2021-09-15', 'aceptado', '', 'bueno', 2);

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

--
-- Volcado de datos para la tabla `anexopropuestas`
--

INSERT INTO `anexopropuestas` (`idanexopropuesta`, `idaccionpropuesta`, `nombre`, `anexo`) VALUES
(10, 41, 'Documento pdf', 'https://utneduec.sharepoint.com/sites/CISICCSOFT-T.GRADO1-ABR21.AGO21/Documentos%20compartidos/Forms/AllItems.aspx?e=5%3Ac1c9d051d0544a59b0bfec6df30d84a2&at=9&CT=1625263135101&OR=OWA%2DNT&CID=77e80a37%2D9825%2D0da2%2D74ce%2D4046be93934e&RootFolder=%2Fsites%2FCISICCSOFT%2DT%2EGRADO1%2DABR21%2EAGO21%2FDocumentos%20compartidos%2FGeneral%2FPERFILES%2DTESIS%2DCISIC%2ECSOF%2DABR21%2EAGO21%2FLESCANO%20VASQUEZ%20IVAN%20ALEXANDER&FolderCTID=0x0120002EA6CFDBA8E1E643BFD34A861A356647'),
(11, 42, 'pastel de almendras', 'https://utneduec.sharepoint.com/sites/CISICCSOFT-T.GRADO1-ABR21.AGO21/Documentos%20compartidos/Forms/AllItems.aspx?e=5%3Ac1c9d051d0544a59b0bfec6df30d84a2&at=9&CT=1625263135101&OR=OWA%2DNT&CID=77e80a37%2D9825%2D0da2%2D74ce%2D4046be93934e&RootFolder=%2Fsites%2FCISICCSOFT%2DT%2EGRADO1%2DABR21%2EAGO21%2FDocumentos%20compartidos%2FGeneral%2FPERFILES%2DTESIS%2DCISIC%2ECSOF%2DABR21%2EAGO21%2FLESCANO%20VASQUEZ%20IVAN%20ALEXANDER&FolderCTID=0x0120002EA6CFDBA8E1E643BFD34A861A356647');

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
(33, '4.1  COMPRENSIÓN DE LA ORGANIZACIÓN Y SU CONTEXTO', 'La organización debe determinar las cuestiones externas e internas que son pertinentes para su propósito y su dirección estratégica, y que afectan a su capacidad para lograr los resultados previstos de su sistema de gestión de la calidad.', 1, 8),
(34, '4.1  COMPRENSIÓN DE LA ORGANIZACIÓN Y SU CONTEXTO', 'La organización debe realizar el seguimiento y la revisión de la información sobre cuestiones externas e internas.\r\n\r\nNota 1. Las cuestiones pueden incluir factores positivos y negativos o condiciones para su consideración\r\nNota 2. La comprensión del contexto externo puede verse facilitada al considerar cuestiones que surgen de los entornos legal, tecnológico, competitivo, de mercado, cultural, social y económico, ya sea internacional, nacional, regional o local.\r\nNota 3. El conocimiento del contexto interno puede verse facilitado al considerar cuestiones relativas a los valores, la cultura, los conocimientos y el desempeño de la organización.', 1, 8),
(35, '4.2 COMPRENSIÓN DE LAS NECESIDADES Y EXPECTATIVAS DE LAS PARTES INTERESADAS', 'Debido a su efecto o efecto potencial en la capacidad de la organización de proporcionar regularmente productos y servicios que satisfagan los requisitos del cliente y los legales y reglamentarios aplicables, la organización debe determinar: a) las partes interesadas que son pertinentes al sistema de gestión de la calidad;\r\nb) los requisitos pertinentes de estas partes interesadas para el sistema de gestión de la calidad.', 1, 8),
(36, '4.2 COMPRENSIÓN DE LAS NECESIDADES Y EXPECTATIVAS DE LAS PARTES INTERESADAS', 'La organización debe realizar el seguimiento y la revisión de la información sobre estas partes interesadas y sus requisitos pertinentes.', 1, 9),
(37, '4.3 DETERMINACIÓN DEL ALCANCE DEL SISTEMA DE GESTIÓN DE LA CALIDAD', 'La organización debe determinar los límites y la aplicabilidad del sistema de gestión de la calidad para establecer su alcance.', 1, 9),
(38, '4.3 DETERMINACIÓN DEL ALCANCE DEL SISTEMA DE GESTIÓN DE LA CALIDAD', 'Cuando se determina este alcance, la organización debe considerar:\r\na) las cuestiones externas e internas indicadas en el apartado 4.1;\r\nb) los requisitos de las partes interesadas pertinentes indicados en el apartado 4.2;\r\nc) los productos y servicios de la organización.', 1, 11),
(39, '4.3 DETERMINACIÓN DEL ALCANCE DEL SISTEMA DE GESTIÓN DE LA CALIDAD', 'La organización debe aplicar todos los requisitos de esta Norma Internacional si son aplicables en el alcance determinado de su sistema de gestión de la calidad.\r\n', 1, 11),
(40, '4.3 DETERMINACIÓN DEL ALCANCE DEL SISTEMA DE GESTIÓN DE LA CALIDAD', 'El alcance del sistema de gestión de la calidad de la organización debe estar disponible y mantenerse como información documentada. El alcance debe establecer los tipos de productos y servicios cubiertos, y proporcionar la justificación para cualquier requisito de esta Norma Internacional que la organización determine que no es aplicable para el alcance de su sistema de gestión de la calidad.\r\n', 1, 13),
(41, '4.3 DETERMINACIÓN DEL ALCANCE DEL SISTEMA DE GESTIÓN DE LA CALIDAD', 'La conformidad con esta Norma Internacional sólo se puede declarar si los requisitos determinados como no aplicables no afectan a la capacidad o a la responsabilidad de la organización de asegurarse de la conformidad de sus productos y servicios y del aumento de la satisfacción del cliente.\r\n', 1, 13),
(42, '5.1 LIDERAZGO Y COMPROMISO', '\"5.1.1 Generalidades\r\nLa alta dirección debe demostrar liderazgo y compromiso con respecto al sistema de gestión de la calidad:\r\na) asumiendo la rendición de cuentas de la eficacia del sistema de gestión de la calidad;\"\r\n', 2, 8),
(43, '5.1 LIDERAZGO Y COMPROMISO', 'b) asegurándose de que se establezcan la política de la calidad y los objetivos de la calidad para el sistema de gestión de la calidad, y que éstos sean compatibles con el contexto y la dirección estratégica de la organización;\r\n', 2, 8),
(44, '5.1 LIDERAZGO Y COMPROMISO', 'c) asegurándose de la integración de los requisitos del sistema de gestión de la calidad en los procesos de negocio de la organización;\r\n', 2, 12),
(45, '5.1 LIDERAZGO Y COMPROMISO', 'd) promoviendo el uso del enfoque a procesos y el pensamiento basado en riesgos;\r\n', 2, 10),
(46, '5.1 LIDERAZGO Y COMPROMISO', 'e) asegurándose de que los recursos necesarios para el sistema de gestión de la calidad estén disponibles;\r\n', 2, 9),
(47, '5.1 LIDERAZGO Y COMPROMISO', 'f) comunicando la importancia de una gestión de la calidad eficaz y conforme con los requisitos del sistema de gestión de la calidad;\r\n', 2, 10),
(48, '6.2 OBJETIVOS DE LA CALIDAD Y PLANIFICACIÓN PARA LOGRARLOS', '\"6.2.1 \r\nLa organización debe establecer objetivos de la calidad para las funciones y niveles pertinentes y los procesos necesarios para el sistema de gestión de la calidad.\"\r\n', 3, 8),
(49, '6.2 OBJETIVOS DE LA CALIDAD Y PLANIFICACIÓN PARA LOGRARLOS', '\"Los objetivos de la calidad deben:\r\na) ser coherentes con la política de la calidad;\r\nb) ser medibles;\r\nc) tener en cuenta los requisitos aplicables;\r\nd) ser pertinentes para la conformidad de los productos y servicios y para el aumento de la satisfacción del cliente;\r\ne) ser objeto de seguimiento;\r\nf) comunicarse;\r\ng) actualizarse, según corresponda.\"\r\n', 3, 8),
(50, '6.2 OBJETIVOS DE LA CALIDAD Y PLANIFICACIÓN PARA LOGRARLOS', 'La organización debe mantener información documentada sobre los objetivos de la calidad.\r\n', 3, 11),
(51, '6.2 OBJETIVOS DE LA CALIDAD Y PLANIFICACIÓN PARA LOGRARLOS', '\"6.2.2 \r\nAl planificar cómo lograr sus objetivos de la calidad, la organización debe determinar:\r\na) qué se va a hacer;\r\nb) qué recursos se requerirán;\r\nc) quién será responsable;\r\nd) cuándo se finalizará;\r\ne) cómo se evaluarán los resultados.\"\r\n', 3, 11),
(52, '8.2 REQUISITOS PARA LOS PRODUCTOS Y SERVICIOS', '\"8.2.1 Comunicación con el cliente\r\nLa comunicación con los clientes debe incluir: \r\na) proporcionar la información relativa a los productos y servicios;\r\nb) tratar las consultas, los contratos o los pedidos, incluyendo los cambios;\r\nc) obtener la retroalimentación de los clientes relativa a los productos y servicios, incluyendo las quejas de los clientes;\r\nd) manipular o controlar la propiedad del cliente;\r\ne) establecer los requisitos específicos para las acciones de contingencia, cuando sea pertinente.\"\r\n', 4, 13),
(53, '8.2 REQUISITOS PARA LOS PRODUCTOS Y SERVICIOS', '\"8.2.2 Determinación de los requisitos relacionados con los productos y servicios\r\nCuando se determinan los requisitos para los productos y servicios que se van a ofrecer a los clientes, la organización debe asegurarse de que:\r\na) los requisitos para los productos y servicios se definen, incluyendo:\r\n    1) cualquier requisito legal y reglamentario aplicable;\r\n    2) aquellos considerados necesarios por la organización;\r\nb) la organización puede cumplir con las declaraciones acerca de los productos y servicios que ofrece.\"\r\n', 4, 12),
(54, '8.2 REQUISITOS PARA LOS PRODUCTOS Y SERVICIOS', '\"8.2.3 Revisión de los requisitos para los productos y servicios\r\n\r\n8.2.3.1 \r\nLa organización debe asegurarse de que tiene la capacidad de cumplir los requisitos para los productos y servicios que se van a ofrecer a los clientes. La organización debe llevar a cabo una revisión antes de comprometerse a suministrar productos y servicios a un cliente, para incluir:\r\na) los requisitos especificados por el cliente, incluyendo los requisitos para las actividades de entrega y las posteriores a la misma;\r\nb) los requisitos no establecidos por el cliente, pero necesarios para el uso especificado o previsto, cuando sea conocido;\r\nc) los requisitos especificados por la organización;\r\nd) los requisitos legales y reglamentarios aplicables a los productos y servicios;\r\ne) las diferencias existentes entre los requisitos de contrato o pedido y los expresados previamente.\"\r\n', 4, 11),
(55, '8.2 REQUISITOS PARA LOS PRODUCTOS Y SERVICIOS', 'La organización debe asegurarse de que se resuelven las diferencias existentes entre los requisitos del contrato o pedido y los expresados previamente.\r\n', 4, 11),
(56, '8.2 REQUISITOS PARA LOS PRODUCTOS Y SERVICIOS', 'La organización debe confirmar los requisitos del cliente antes de la aceptación, cuando el cliente no proporcione una declaración documentada de sus requisitos.\r\n', 4, 10),
(57, '8.2 REQUISITOS PARA LOS PRODUCTOS Y SERVICIOS', '\"8.2.3.2 \r\nLa organización debe conservar la información documentada, cuando sea aplicable:\r\na) sobre los resultados de la revisión;\r\nb) sobre cualquier requisito nuevo para los productos y servicios.\"\r\n', 4, 11);

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
(130, 'Cod-9001', 1, '2021-09-23', 11, '2021-09-01', 3),
(131, 'Cod-9002', 2, '2021-09-09', 12, '2021-09-01', 1),
(132, 'Cod-9003', 2, '2021-09-16', 14, '2021-09-01', 1),
(133, 'Cod-9004', 2, '2021-09-17', 11, '2021-09-01', 1);

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
  `planaccion` int(11) NOT NULL DEFAULT 1,
  `estadoplan` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalleclausula`
--

INSERT INTO `detalleclausula` (`iddetalleclausula`, `idclausula`, `parametroscalificacion`, `desincumplimiento`, `documentacionsoporte`, `iddetalleauditoria`, `planaccion`, `estadoplan`) VALUES
(345, 33, 'No Conformidad Mayor', 'dfadf', 'dfad', 130, 2, 2),
(346, 34, 'No Conformidad Mayor', 'dfadf', 'gfgdgd', 130, 2, 2),
(347, 35, 'Observación', 'dfadf', 'dfadfadfa', 130, 2, 2),
(348, 36, 'No Conformidad Menor', 'dfadfa', 'dffga3', 130, 2, 2),
(349, 37, 'No Conformidad Menor', 'fjkdsghire', 'egegegegge', 130, 2, 2),
(350, 38, 'Oportunidad de Mejora', 'efefr3434', '3434gdg', 130, 2, 2),
(351, 39, 'Oportunidad de Mejora', 'grtrg', 'rgdgrdg', 130, 2, 2),
(352, 40, 'Observación', 'rgrgdsg', 'rsgsrgdsg', 130, 2, 2),
(353, 41, 'No Conformidad Mayor', 'rgdg', 'rdgrsd', 130, 2, 2),
(354, 48, NULL, NULL, NULL, 131, 1, 1),
(355, 49, NULL, NULL, NULL, 131, 1, 1),
(356, 50, NULL, NULL, NULL, 131, 1, 1),
(357, 51, NULL, NULL, NULL, 131, 1, 1),
(358, 52, NULL, NULL, NULL, 132, 1, 1),
(359, 53, NULL, NULL, NULL, 132, 1, 1),
(360, 54, NULL, NULL, NULL, 132, 1, 1),
(361, 55, NULL, NULL, NULL, 132, 1, 1),
(362, 56, NULL, NULL, NULL, 132, 1, 1),
(363, 57, NULL, NULL, NULL, 132, 1, 1),
(364, 33, NULL, NULL, NULL, 133, 1, 1),
(365, 34, NULL, NULL, NULL, 133, 1, 1),
(366, 35, NULL, NULL, NULL, 133, 1, 1),
(367, 36, NULL, NULL, NULL, 133, 1, 1),
(368, 37, NULL, NULL, NULL, 133, 1, 1),
(369, 38, NULL, NULL, NULL, 133, 1, 1),
(370, 39, NULL, NULL, NULL, 133, 1, 1),
(371, 40, NULL, NULL, NULL, 133, 1, 1),
(372, 41, NULL, NULL, NULL, 133, 1, 1);

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
(18, 11, 1, 'Auditor Lider ', 37),
(19, 11, 2, 'auditor secundario', 38),
(22, 11, 2, 'dfadfa', 39),
(25, 12, 1, 'djfad', 40),
(29, 12, 2, 'dfadfa', 41),
(30, 12, 2, 'dfadfa', 46),
(22, 12, 2, 'dfadfa', 47),
(26, 11, 2, 'dfadfad', 48),
(22, 14, 1, 'dfadfa', 49),
(18, 14, 2, 'dfadfa', 50),
(26, 14, 2, 'dfadfad', 51),
(18, 12, 2, 'dfadfad', 52);

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
(11, 'GrupoIso9001', 1),
(12, 'GrupoBasc', 3),
(13, 'GrupoIso9001Team2', 1),
(14, 'GrupoBrc', 4),
(15, 'GrupoBpm', 2),
(16, 'GrupoBascTeam2', 3),
(17, 'GrupoBrcTeam2', 4),
(18, 'GrupoBpmTeam2', 2);

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
(44, 347, 'Plan01', '5 por que', 'Plan01', 'Plan01'),
(45, 346, 'plan02', 'Lluvia de ideas', 'plan02', 'plan02'),
(46, 345, 'plan03', 'Diagrama de Ishkawa', 'plan03', 'plan03'),
(47, 351, 'Plan01', '5 por que', 'Plan01', 'Plan01'),
(48, 350, 'Plan02', 'Diagrama de Ishkawa', 'Plan01', 'Plan01'),
(49, 349, 'Plan01', 'Pareto', 'Plan01', 'Plan01'),
(50, 348, 'Plan02', 'Diagrama de Ishkawa', 'Plan02', 'Plan02'),
(51, 353, 'plan01', 'Pareto', 'plan01', 'plan01'),
(52, 352, 'plan02', 'Pareto', 'plan02', 'plan02');

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
(8, 'Evaluacion y Mejoramiento', 20),
(9, 'Direccion Estratégica', 21),
(10, 'Produccion', 23),
(11, 'Compras', 24),
(12, 'Sistema Integrado de gestion, evalacion y mejorami', 28),
(13, 'Ventas', 27);

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
(18, 'malcom', '102ddaf691e1615d5dacd4c86299bfa4', 'malcom@gmail.com', 2, 1),
(19, 'hall', '102ddaf691e1615d5dacd4c86299bfa4', 'hall@gmail.com', 2, 1),
(20, 'lois', '102ddaf691e1615d5dacd4c86299bfa4', 'lois@gmail.com', 3, 1),
(21, 'andy', '102ddaf691e1615d5dacd4c86299bfa4', 'andy@gmail.com', 3, 1),
(22, 'francis', '102ddaf691e1615d5dacd4c86299bfa4', 'francis@gmail.com', 2, 1),
(23, 'anavera', '102ddaf691e1615d5dacd4c86299bfa4', 'anavera@gmail.com', 3, 1),
(24, 'reese', '102ddaf691e1615d5dacd4c86299bfa4', 'reese@gmail.com', 3, 1),
(25, 'daya', '102ddaf691e1615d5dacd4c86299bfa4', 'daya@gmail.com', 2, 1),
(26, 'jesy', '102ddaf691e1615d5dacd4c86299bfa4', 'jesy@gmail.com', 2, 1),
(27, 'marianita', '102ddaf691e1615d5dacd4c86299bfa4', 'marianita@gmail.com', 3, 1),
(28, 'brandon', '102ddaf691e1615d5dacd4c86299bfa4', 'brandon@gmail.com', 3, 1),
(29, 'terra', '102ddaf691e1615d5dacd4c86299bfa4', 'terra@gmail.com', 2, 1),
(30, 'harold', '102ddaf691e1615d5dacd4c86299bfa4', 'harold@gmail.com', 2, 1);

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
  MODIFY `idaccionpropuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `anexo`
--
ALTER TABLE `anexo`
  MODIFY `idanexo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `anexopropuestas`
--
ALTER TABLE `anexopropuestas`
  MODIFY `idanexopropuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `clausula`
--
ALTER TABLE `clausula`
  MODIFY `idclausula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `detalleauditoria`
--
ALTER TABLE `detalleauditoria`
  MODIFY `iddetalleauditoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT de la tabla `detalleclausula`
--
ALTER TABLE `detalleclausula`
  MODIFY `iddetalleclausula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=373;

--
-- AUTO_INCREMENT de la tabla `detallegrupo`
--
ALTER TABLE `detallegrupo`
  MODIFY `iddetallegrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `grupoauditor`
--
ALTER TABLE `grupoauditor`
  MODIFY `idgrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
  MODIFY `idplandeaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `procesos`
--
ALTER TABLE `procesos`
  MODIFY `idproceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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

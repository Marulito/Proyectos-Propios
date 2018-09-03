-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-09-2018 a las 04:03:18
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
-- Base de datos: `sigd`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `PA_CambiarEstadoCategoria` (IN `id` INT)  NO SQL
BEGIN

IF EXISTS(SELECT * FROM categoria c WHERE c.idCategoria=id AND c.estado=1) THEN
#Desactivar
  UPDATE categoria c SET c.estado=0 WHERE c.idCategoria=id;
  SELECT 1 AS respuesta;
ELSE
#Activar
  UPDATE categoria c SET c.estado=1 WHERE c.idCategoria=id;
  SELECT 2 AS respuesta;
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PA_CambiarEstadoUsuario` (IN `doc` VARCHAR(13))  NO SQL
BEGIN

IF EXISTS(SELECT * FROM usuario u WHERE u.documento=doc AND u.estado=1) THEN
#Desactivar
  UPDATE usuario u SET u.estado=0 WHERE u.documento=doc;
  SELECT 1 AS respuesta;
ELSE
#Activar
  UPDATE usuario u SET u.estado=1 WHERE u.documento=doc;
  SELECT 2 AS respuesta;
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PA_ConsultarCategorias` (IN `id` INT)  NO SQL
BEGIN

IF id=0 THEN
#consulta todas las categorias
SELECT * FROM categoria;

ELSE
#consulta solo una categoria por el id
SELECT * FROM categoria a WHERE a.idCategoria=id;

END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PA_ConsultarUsuarios` (IN `doc` VARCHAR(13))  NO SQL
BEGIN

IF doc='' THEN
#Consulta todos lo usuarios
SELECT u.documento,u.nombres,u.apellidos,u.rol,u.estado FROM usuario u;
#...
ELSE
#Consulta por un usuario
SELECT * FROM usuario u WHERE u.documento=doc;
#...
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PA_InicioSessionUsuario` (IN `user` VARCHAR(13), IN `pass` VARCHAR(100))  NO SQL
BEGIN
#ESTADO 0= DESACTIVADO 1=ACTIVADO 2=ADMINISTRADOR 
IF EXISTS(SELECT * FROM usuario u WHERE u.documento=user AND u.contraseña COLLATE utf8_bin=pass AND (u.estado=1 OR u.estado=2)) THEN
#Si existe
SELECT u.documento,u.rol,1 AS respuesta FROM usuario u WHERE u.documento=user AND u.contraseña COLLATE utf8_bin=pass;
#...
ELSE
#no existe
SELECT 0 AS respuesta;
#...
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PA_RegistrarModificarCategoria` (IN `id` INT, IN `nombre` VARCHAR(45))  NO SQL
BEGIN

IF id=0 THEN
#Registrar
INSERT INTO `categoria`(`Categoria`) VALUES (nombre);
#Retorno
SELECT 1 AS respuesta;
ELSE
#modificar
UPDATE `categoria` SET `Categoria`=nombre WHERE `idCategoria`=id;
#Retorno
SELECT 2 AS respuesta;
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PA_RegistrarModificarUsuario` (IN `doc` VARCHAR(13), IN `nombres` VARCHAR(45), IN `apellidos` VARCHAR(45), IN `contra` VARCHAR(100), IN `correo` VARCHAR(60), IN `rol` INT, IN `accion` TINYINT(1))  NO SQL
BEGIN

IF accion=0 THEN
#Registrar
INSERT INTO `usuario`(`documento`, `nombres`, `apellidos`, `contraseña`, `rol`,`correo`) VALUES (doc,nombres,apellidos,contra,rol,correo);
ELSE
#modificar
UPDATE `usuario` SET `nombres`=nombres,`apellidos`=apellidos,`contraseña`=contra,`rol`=rol,`correo`=correo WHERE `documento`=doc;
END IF;
#Retorno
SELECT 1 AS respuesta;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `Categoria` varchar(45) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `Categoria`, `estado`) VALUES
(2, 'Formato', 1),
(4, 'Procedimientos', 1),
(5, 'Documentos Especificos', 1),
(6, 'Caracterizaciones', 1),
(7, 'Documentos externos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `idDocumento` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `varsion` varchar(3) NOT NULL,
  `vigencia` date NOT NULL,
  `poseedor` varchar(45) NOT NULL,
  `proteccion` varchar(45) NOT NULL,
  `tiempo_retencion` varchar(45) NOT NULL,
  `direccion_url` varchar(100) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idProceso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `idHistorial` int(11) NOT NULL,
  `fechaHora_descarga` datetime NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  `documento` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso`
--

CREATE TABLE `proceso` (
  `idProceso` int(11) NOT NULL,
  `nombre_proceso` varchar(45) NOT NULL,
  `estado_visibilidad` tinyint(1) NOT NULL DEFAULT '0',
  `idtipo_proceso` tinyint(4) NOT NULL,
  `idProceso_sub` int(11) NOT NULL,
  `documento` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_proceso`
--

CREATE TABLE `tipo_proceso` (
  `idtipo_proceso` tinyint(4) NOT NULL,
  `tipo_proceso` varchar(45) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `documento` varchar(13) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `rol` tinyint(1) NOT NULL DEFAULT '2',
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `correo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`documento`, `nombres`, `apellidos`, `contraseña`, `rol`, `estado`, `correo`) VALUES
('121231245645', '45787512', 'Marulanda', '123456789', 1, 1, 'juan@hotmail.com'),
('1216727816', 'juan david ', 'marulanda paniagua', '123456L', 2, 2, 'juan@hotmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`idDocumento`),
  ADD KEY `fk_Documento_Proceso1_idx` (`idProceso`),
  ADD KEY `fk_Documento_Categoria1_idx` (`idCategoria`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`idHistorial`),
  ADD KEY `fk_Historial_Usuario1_idx` (`documento`);

--
-- Indices de la tabla `proceso`
--
ALTER TABLE `proceso`
  ADD PRIMARY KEY (`idProceso`),
  ADD KEY `fk_Proceso_tipo_proceso_idx` (`idtipo_proceso`),
  ADD KEY `fk_Proceso_Proceso1_idx` (`idProceso_sub`),
  ADD KEY `fk_Proceso_Usuario1_idx` (`documento`);

--
-- Indices de la tabla `tipo_proceso`
--
ALTER TABLE `tipo_proceso`
  ADD PRIMARY KEY (`idtipo_proceso`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`documento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `idDocumento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `idHistorial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proceso`
--
ALTER TABLE `proceso`
  MODIFY `idProceso` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `fk_Documento_Categoria1` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Documento_Proceso1` FOREIGN KEY (`idProceso`) REFERENCES `proceso` (`idProceso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `fk_Historial_Usuario1` FOREIGN KEY (`documento`) REFERENCES `usuario` (`documento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proceso`
--
ALTER TABLE `proceso`
  ADD CONSTRAINT `fk_Proceso_Proceso1` FOREIGN KEY (`idProceso_sub`) REFERENCES `proceso` (`idProceso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Proceso_Usuario1` FOREIGN KEY (`documento`) REFERENCES `usuario` (`documento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Proceso_tipo_proceso` FOREIGN KEY (`idtipo_proceso`) REFERENCES `tipo_proceso` (`idtipo_proceso`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

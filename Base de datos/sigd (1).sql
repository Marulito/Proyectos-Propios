-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-09-2018 a las 23:24:09
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.2.0

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `PA_CambiarEstadoContenido` (IN `idProceso` INT)  NO SQL
BEGIN
DECLARE estado tinyint(1);
#...
IF EXISTS(SELECT * FROM proceso p WHERE p.idProceso=idProceso AND p.estado_visibilidad=1) THEN
#Cambiar el estado a no visible=0
  set estado=(0);
ELSE
#Cambir el estado a visible=1
  set estado=(1);
END IF;
#...
#Actualziar estado AND `idProceso_sub`= idSubPrceso
UPDATE proceso p SET p.estado_visibilidad=estado WHERE p.idProceso= idProceso;

SELECT 1 AS respuesta;
#, {$info['idSubProceso']}
#AND p.idProceso_sub=idSubPrceso
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
 IF id=-1 THEN
   #Consulta solo las categorias que estan activas
   SELECT * FROM categoria a WHERE a.estado=1;
 ELSE
   #consulta solo una categoria por el id
   SELECT * FROM categoria a WHERE a.idCategoria=id;
 END IF;
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PA_ConsultarProcedimientosS` (IN `idTipo` INT, IN `TipoUser` INT, IN `idProc` INT)  NO SQL
BEGIN
#Consulta los procesos por el tipo de proceso
# Consutar por el tipo de ususario

IF idProc=0 THEN
#Consulta de gestiones
IF TipoUser=1 THEN #Administrador
SELECT p.idProceso,p.nombre_proceso,p.estado_visibilidad,p.idtipo_proceso,p.idProceso_sub,p.documento,(SELECT (COUNT(*)-1) FROM proceso pc WHERE pc.idProceso_sub=p.idProceso) AS cantidad FROM proceso p WHERE p.idtipo_proceso=idTipo;
ELSE #Contribuyente
SELECT p.idProceso,p.nombre_proceso,p.estado_visibilidad,p.idtipo_proceso,p.idProceso_sub,p.documento,(SELECT (COUNT(*)-1) FROM proceso pc WHERE pc.idProceso_sub=p.idProceso) AS cantidad FROM proceso p WHERE p.idtipo_proceso=idTipo AND p.estado_visibilidad=1;
END IF;
ELSE
#consulta de procesos o sub procesos, falta la validacion del tipo de ususario.
IF  TipoUser=1 THEN#Administrador
SELECT p.idProceso,p.nombre_proceso,p.estado_visibilidad,p.idtipo_proceso,p.idProceso_sub,p.documento,(SELECT COUNT(*) FROM proceso pc WHERE pc.idProceso_sub=p.idProceso) AS cantidad FROM proceso p WHERE p.idtipo_proceso=idTipo AND p.idProceso_sub=idProc;
else#Contribuyente
SELECT p.idProceso,p.nombre_proceso,p.estado_visibilidad,p.idtipo_proceso,p.idProceso_sub,p.documento,(SELECT COUNT(*) FROM proceso pc WHERE pc.idProceso_sub=p.idProceso AND p.estado_visibilidad=1) AS cantidad FROM proceso p WHERE p.idtipo_proceso=idTipo AND p.idProceso_sub=idProc AND p.estado_visibilidad=1;

END IF;

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `PA_RegistrarModificarContenidoVista` (IN `idProce` INT, IN `doc` VARCHAR(13), IN `nombre` VARCHAR(45), IN `idTipoP` INT, IN `idSubProce` INT)  NO SQL
BEGIN

IF idProce=0 THEN
#Registrar gestiones
  IF idTipoP=1 THEN
  INSERT INTO `proceso`(`nombre_proceso`,`idtipo_proceso`, `idProceso_sub`, `documento`) VALUES (nombre,idTipoP,(SELECT (COUNT(*)+1) FROM proceso p),doc);
  ELSE
   #Registrar Procesos o sub-procesos
   INSERT INTO `proceso`(`nombre_proceso`,`idtipo_proceso`, `idProceso_sub`, `documento`) VALUES (nombre,idTipoP,idSubProce,doc);
  END IF;
SELECT 1 AS respuesta;
ELSE
#modificar
UPDATE `proceso` SET `nombre_proceso`=nombre WHERE `idProceso`=idProce  AND `idProceso_sub`=idSubProce;
#...
SELECT 2 AS respuesta;
#...
END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `PA_RegistrarModificarDocumento` (IN `nombre` VARCHAR(60), IN `version` VARCHAR(3), IN `vigencia` VARCHAR(13), IN `poseedor` VARCHAR(45), IN `proteccion` VARCHAR(45), IN `name_file` VARCHAR(100), IN `idcategoria` INT, IN `idProceso` INT, IN `idDocumento` INT)  NO SQL
BEGIN

#validar la existencia del sub-proceso
IF EXISTS(SELECT * FROM proceso p WHERE p.idProceso=idProceso AND p.idtipo_proceso=3) THEN#El id es de un proceso de tipo sub-proceso
    #Registrar documentos
    IF idDocumento=0 THEN
    	INSERT INTO `documento`(`nombre`, `varsion`, `vigencia`, `poseedor`, `proteccion`, `tiempo_retencion`, `nombre_file`, `idCategoria`, `idProceso`) VALUES (nombre,version,vigencia,poseedor,proteccion,'-',name_file,idcategoria,idProceso);
	SELECT 1 AS respuesta;#Registrado
    ELSE
    #Modificar Documentos
      UPDATE `documento` SET `nombre`=nombre,`varsion`=version,`vigencia`=vigencia,`poseedor`=poseedor,`proteccion`=proteccion,`tiempo_retencion`='',`nombre_file`=name_file,`idCategoria`=idcategoria WHERE `idDocumento`=idDocumento;
	SELECT 2 AS respuesta;#Modificado
    END IF;
ELSE
#Error retornar un valor negativo
SELECT -1 AS respuesta;
#
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
  `nombre_file` varchar(100) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idProceso` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`idDocumento`, `nombre`, `varsion`, `vigencia`, `poseedor`, `proteccion`, `tiempo_retencion`, `nombre_file`, `idCategoria`, `idProceso`, `estado`) VALUES
(5, 'segundo documento', '2', '2018-01-13', 'digo', 'magda', '', 'Piano1.pdf', 2, 10, 1);

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
  `estado_visibilidad` tinyint(1) NOT NULL DEFAULT '1',
  `idtipo_proceso` tinyint(4) NOT NULL,
  `idProceso_sub` int(11) NOT NULL,
  `documento` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proceso`
--

INSERT INTO `proceso` (`idProceso`, `nombre_proceso`, `estado_visibilidad`, `idtipo_proceso`, `idProceso_sub`, `documento`) VALUES
(1, 'Primera gestion1', 1, 1, 1, '1216727816'),
(2, 'gestion 1', 1, 1, 2, '1216727816'),
(3, 'Nueva gestion', 1, 1, 3, '1216727816'),
(4, 'Ernesto', 1, 2, 1, '1216727816'),
(5, 'Alejandro', 1, 2, 1, '1216727816'),
(6, 'Anderson 2', 1, 3, 4, '1216727816'),
(7, 'nueva gestion', 1, 1, 7, '1216727816'),
(8, 'nueva gestion 2', 1, 1, 8, '1216727816'),
(9, 'nueva gestion 3', 1, 1, 9, '1216727816'),
(10, 'nuevo sub proceso', 1, 3, 4, '1216727816'),
(11, 'otro sub proceso', 1, 3, 5, '1216727816'),
(12, 'ajsjdasdasda', 1, 1, 12, '1216727816');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_proceso`
--

CREATE TABLE `tipo_proceso` (
  `idtipo_proceso` tinyint(4) NOT NULL,
  `tipo_proceso` varchar(45) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_proceso`
--

INSERT INTO `tipo_proceso` (`idtipo_proceso`, `tipo_proceso`, `estado`) VALUES
(1, 'Gestiones', 1),
(2, 'Procesos', 1),
(3, 'Sub-Procesos', 1);

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
('1216727816', 'juan david ', 'marulanda paniagua', '123456L', 1, 2, 'juan@hotmail.com'),
('98113053240', '45787512', 'Marulanda', '123456', 2, 1, 'juan@hotmail.com');

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
  MODIFY `idDocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `idHistorial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proceso`
--
ALTER TABLE `proceso`
  MODIFY `idProceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tipo_proceso`
--
ALTER TABLE `tipo_proceso`
  MODIFY `idtipo_proceso` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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

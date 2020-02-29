-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-12-2014 a las 14:53:09
-- Versión del servidor: 5.5.36
-- Versión de PHP: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `evaluate`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competencias_perfil`
--

CREATE TABLE IF NOT EXISTS `competencias_perfil` (
  `id_comp_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `id_competencia` int(11) NOT NULL COMMENT 'id_competencia=id_objetivo',
  `id_perfil` int(11) NOT NULL,
  PRIMARY KEY (`id_comp_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE IF NOT EXISTS `empleados` (
  `id_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `dni` int(8) NOT NULL,
  `puesto` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id_empleado`),
  UNIQUE KEY `dni` (`dni`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados_periodo`
--

CREATE TABLE IF NOT EXISTS `empleados_periodo` (
  `id_empleados_periodo` int(11) NOT NULL AUTO_INCREMENT,
  `id_empleado` int(11) NOT NULL,
  `id_periodo` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  PRIMARY KEY (`id_empleados_periodo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion`
--

CREATE TABLE IF NOT EXISTS `evaluacion` (
  `id_evaluacion` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_evaluacion` date NOT NULL,
  `id_periodo` int(11) NOT NULL,
  `tipo_evaluacion` char(1) NOT NULL DEFAULT 'o',
  PRIMARY KEY (`id_evaluacion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE IF NOT EXISTS `notas` (
  `id_nota` int(11) NOT NULL AUTO_INCREMENT,
  `id_objetivo` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_evaluacion` int(11) NOT NULL,
  `nota` int(11) DEFAULT NULL,
  `id_votante` int(11) NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_nota`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetivos`
--

CREATE TABLE IF NOT EXISTS `objetivos` (
  `id_objetivo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_objetivo` varchar(50) NOT NULL,
  `descripcion_objetivo` varchar(200) DEFAULT NULL,
  `tipo_objetivo` char(1) DEFAULT 'o' COMMENT 'o=objetivo c=competencia',
  `id_perfil` int(11) NOT NULL,
  PRIMARY KEY (`id_objetivo`),
  UNIQUE KEY `nombre_objetivo` (`nombre_objetivo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_perfil` varchar(50) NOT NULL,
  `descripcion_perfil` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_perfil`),
  UNIQUE KEY `nombre_perfil` (`nombre_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--

CREATE TABLE IF NOT EXISTS `periodo` (
  `id_periodo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_periodo` varchar(50) NOT NULL,
  `inicio_periodo` date NOT NULL,
  `fin_periodo` date NOT NULL,
  `id_creador` int(11) NOT NULL,
  PRIMARY KEY (`id_periodo`),
  UNIQUE KEY `nombre_periodo` (`nombre_periodo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `rol` tinyint(4) NOT NULL DEFAULT '0',
  `id_empleado` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO usuarios (id_usuario, usuario, pass, rol, id_empleado) 
VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 3, 1);

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO empleados (id_empleado, nombre, apellido, dni, puesto, email) 
VALUES (1, 'Super', 'Administrador', 100, 'super Administrador', 'super@admin.com');


--
-- Volcado de datos para la tabla `objetivos`
--

INSERT INTO objetivos (id_objetivo, nombre_objetivo, descripcion_objetivo, tipo_objetivo, id_perfil) 
VALUES
(1, 'Trabajo en equipo', '', 'c', 0),
(2, 'Compromiso con las tareas asignadas', '', 'c', 0),
(3, 'Capacidad de análisis y solución de problemas', '', 'c', 0),
(4, 'Capacidad de aprendizaje', '', 'c', 0),
(5, 'Proactividad', '', 'c', 0),
(6, 'Comunicación', '', 'c', 0);



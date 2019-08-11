-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-08-2019 a las 00:28:45
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pizzanova`
--
CREATE DATABASE IF NOT EXISTS `pizzanova` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pizzanova`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacoras`
--

DROP TABLE IF EXISTS `bitacoras`;
CREATE TABLE IF NOT EXISTS `bitacoras` (
  `id_bitacora` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `accion` varchar(50) NOT NULL,
  `id_usuario` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id_bitacora`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

DROP TABLE IF EXISTS `cargo`;
CREATE TABLE IF NOT EXISTS `cargo` (
  `id_Cargo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre_Cargo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_Cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id_Cargo`, `nombre_Cargo`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(50) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `foto_categoria` varchar(50) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 es activo 0 es inactivo',
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `descripcion`, `foto_categoria`, `estado`) VALUES
(1, 'Bebidas', 'test', '5d2ce843cb3a3.jpg', 1),
(2, 'Pizzas', 'test', '5d2ce9aa94cad.jpeg', 1),
(3, 'Pupusas', 'test', '5d2ce9b5ec98f.jpeg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desperdicios`
--

DROP TABLE IF EXISTS `desperdicios`;
CREATE TABLE IF NOT EXISTS `desperdicios` (
  `id_desperdicios` int(11) NOT NULL AUTO_INCREMENT,
  `id_receta` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `id_empleado` int(10) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_desperdicio` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_desperdicios`),
  KEY `id_empleado` (`id_empleado`),
  KEY `id_receta` (`id_receta`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `desperdicios`
--

INSERT INTO `desperdicios` (`id_desperdicios`, `id_receta`, `id_usuario`, `id_empleado`, `cantidad`, `fecha_desperdicio`) VALUES
(2, 1, 1, 1, 30, '2019-08-09 16:26:43'),
(3, 1, 1, 1, 25, '2019-08-09 16:26:43'),
(4, 2, 1, 1, 2, '2019-08-09 16:40:58'),
(5, 3, 1, 1, 23, '2019-08-09 16:56:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

DROP TABLE IF EXISTS `detalle_pedido`;
CREATE TABLE IF NOT EXISTS `detalle_pedido` (
  `id_detalle` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) UNSIGNED NOT NULL,
  `id_platillo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `id_pedido` (`id_pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`id_detalle`, `id_pedido`, `id_platillo`, `cantidad`) VALUES
(38, 127, 6, 2),
(39, 128, 9, 2),
(40, 128, 8, 2),
(41, 128, 3, 2),
(42, 128, 4, 3),
(43, 128, 7, 2),
(44, 128, 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elaboraciones`
--

DROP TABLE IF EXISTS `elaboraciones`;
CREATE TABLE IF NOT EXISTS `elaboraciones` (
  `id_elaboracion` int(11) NOT NULL,
  `id_receta` int(10) UNSIGNED DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `idMateria` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id_elaboracion`),
  KEY `idMateria` (`idMateria`),
  KEY `id_receta` (`id_receta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `elaboraciones`
--

INSERT INTO `elaboraciones` (`id_elaboracion`, `id_receta`, `cantidad`, `idMateria`) VALUES
(0, 3, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

DROP TABLE IF EXISTS `empleados`;
CREATE TABLE IF NOT EXISTS `empleados` (
  `id_empleado` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre_empleado` varchar(20) NOT NULL,
  `apellido_empleado` varchar(20) NOT NULL,
  `dui` varchar(10) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `genero` enum('M','F') DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `nacionalidad` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `id_Cargo` int(10) UNSIGNED DEFAULT NULL,
  `id_usuario` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id_empleado`),
  UNIQUE KEY `dui` (`dui`),
  UNIQUE KEY `telefono` (`telefono`),
  UNIQUE KEY `correo` (`correo`),
  KEY `id_Cargo` (`id_Cargo`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `nombre_empleado`, `apellido_empleado`, `dui`, `direccion`, `telefono`, `genero`, `fecha_nacimiento`, `nacionalidad`, `correo`, `id_Cargo`, `id_usuario`) VALUES
(1, 'Frankie', 'Vasconcelos', '78986565-5', 'La casa del vecino que esta en la esquina', '7793-2797', 'M', '2000-12-08', 'El Salvador', 'stanleyvasconcelos0@gmail.com', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encabezadofactura`
--

DROP TABLE IF EXISTS `encabezadofactura`;
CREATE TABLE IF NOT EXISTS `encabezadofactura` (
  `id_EncabezadoFac` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre_cliente` varchar(50) DEFAULT NULL,
  `id_empleado` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id_EncabezadoFac`),
  KEY `id_empleado` (`id_empleado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiasprimas`
--

DROP TABLE IF EXISTS `materiasprimas`;
CREATE TABLE IF NOT EXISTS `materiasprimas` (
  `idMateria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre_materia` varchar(50) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `id_categoria` int(10) UNSIGNED DEFAULT NULL,
  `id_Medida` int(10) UNSIGNED DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 es activo 0 es inactivo',
  PRIMARY KEY (`idMateria`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_Medida` (`id_Medida`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `materiasprimas`
--

INSERT INTO `materiasprimas` (`idMateria`, `nombre_materia`, `descripcion`, `cantidad`, `foto`, `id_categoria`, `id_Medida`, `estado`) VALUES
(1, 'test', 'test', 2, '5d2cefcc97528.jpg', 1, 1, 1),
(2, 'Espinaca', 'kdopjdspojdspojdsp', 8, '5d4e006c7c510.jpg', 2, 1, 1),
(3, 'fdsdddfdsfds', 'fsdfsdfs', 2, '5d4e00b592a2e.jpeg', 2, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

DROP TABLE IF EXISTS `mesas`;
CREATE TABLE IF NOT EXISTS `mesas` (
  `id_mesa` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `numero_mesa` int(10) UNSIGNED NOT NULL,
  `estado_mesa` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_mesa`),
  UNIQUE KEY `numero_mesa` (`numero_mesa`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id_mesa`, `numero_mesa`, `estado_mesa`) VALUES
(1, 89, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(13, 11, 1),
(14, 10, 1),
(15, 20, 1),
(16, 50, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id_pedido` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fecha_pedido` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_mesa` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_mesa` (`id_mesa`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `fecha_pedido`, `id_mesa`, `id_usuario`) VALUES
(127, '2019-08-09 16:56:58', 1, 1),
(128, '2019-08-09 16:57:26', 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platillos`
--

DROP TABLE IF EXISTS `platillos`;
CREATE TABLE IF NOT EXISTS `platillos` (
  `id_platillo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre_platillo` varchar(50) NOT NULL,
  `precio` double(6,2) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 es activo 0 es inactivo',
  `id_receta` int(10) UNSIGNED DEFAULT NULL,
  `id_categoria` int(10) UNSIGNED DEFAULT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_platillo`),
  KEY `id_receta` (`id_receta`),
  KEY `id_categoria` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `platillos`
--

INSERT INTO `platillos` (`id_platillo`, `nombre_platillo`, `precio`, `estado`, `id_receta`, `id_categoria`, `imagen`) VALUES
(3, 'pupusa de frijol', 0.75, 1, 1, 3, '5d2cf44fd3d49.jpg'),
(4, 'coca', 1.00, 1, 1, 1, '5d2cf475811ab.jpg'),
(6, 'Pizza de jamÃ³n', 10.99, 1, 1, 2, '5d2e4c773faa1.jpeg'),
(7, 'Fanta', 0.99, 1, 1, 1, '5d2e4ce5e7a8f.jpg'),
(8, 'Pupusa de queso', 0.65, 1, 1, 3, '5d2e4cfce5170.jpg'),
(9, 'Pupusa revuelta', 1.00, 1, 1, 3, '5d2e4d15a9819.jpg'),
(10, 'Refresco de naranja', 1.25, 1, 1, 1, '5d2e4d3961646.jpeg'),
(11, 'Bebida 2', 2.50, 1, 1, 1, '5d386214ad3c4.jpg'),
(12, 'Bebida 3', 0.95, 1, 1, 1, '5d38622667df8.jpg'),
(13, 'Bebida 4', 1.00, 1, 1, 1, '5d38623a941a9.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_pedido`
--

DROP TABLE IF EXISTS `pre_pedido`;
CREATE TABLE IF NOT EXISTS `pre_pedido` (
  `id_prepedido` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_mesa` int(10) UNSIGNED NOT NULL,
  `id_platillo` int(10) UNSIGNED NOT NULL,
  `cantidad` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_prepedido`),
  KEY `id_mesa` (`id_mesa`),
  KEY `id_platillo` (`id_platillo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pre_pedido`
--

INSERT INTO `pre_pedido` (`id_prepedido`, `id_mesa`, `id_platillo`, `cantidad`) VALUES
(3, 1, 6, 2),
(4, 6, 9, 2),
(5, 6, 8, 2),
(6, 6, 3, 2),
(7, 6, 4, 3),
(8, 6, 7, 2),
(9, 6, 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta`
--

DROP TABLE IF EXISTS `receta`;
CREATE TABLE IF NOT EXISTS `receta` (
  `id_receta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre_receta` varchar(1000) NOT NULL,
  `tiempo` varchar(11) NOT NULL,
  PRIMARY KEY (`id_receta`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `receta`
--

INSERT INTO `receta` (`id_receta`, `nombre_receta`, `tiempo`) VALUES
(1, 'test', 'test'),
(2, 'holaaa', '30 min'),
(3, 'fdsfs', '15 min');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

DROP TABLE IF EXISTS `tipousuario`;
CREATE TABLE IF NOT EXISTS `tipousuario` (
  `id_Tipousuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) DEFAULT NULL,
  `descripcion` varchar(1000) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 es activo 0 es inactivo',
  PRIMARY KEY (`id_Tipousuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`id_Tipousuario`, `tipo`, `descripcion`, `estado`) VALUES
(1, 'admin', 'test', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidadmedida`
--

DROP TABLE IF EXISTS `unidadmedida`;
CREATE TABLE IF NOT EXISTS `unidadmedida` (
  `id_Medida` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre_medida` varchar(40) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_Medida`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `unidadmedida`
--

INSERT INTO `unidadmedida` (`id_Medida`, `nombre_medida`, `descripcion`) VALUES
(1, 'Kilogramo', 'Kg'),
(2, 'Gramo', 'ggggg'),
(3, 'Libra', 'lb');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `alias` varchar(50) NOT NULL,
  `clave_usuario` varchar(60) NOT NULL,
  `foto_usuario` varchar(50) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado_usuario` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 es activo 0 es inactivo',
  `id_Tipousuario` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `alias` (`alias`),
  KEY `id_Tipousuario` (`id_Tipousuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `alias`, `clave_usuario`, `foto_usuario`, `fecha_creacion`, `estado_usuario`, `id_Tipousuario`) VALUES
(1, 'Gerardo', '$2y$10$rtwGWAepKVUdC/HKCg0y5eAER0/8KjRCidjl.L.u7rRpSHAuQ3JdC', '5d2c9630ac4f2.jpeg', '2019-07-15 15:05:20', 1, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bitacoras`
--
ALTER TABLE `bitacoras`
  ADD CONSTRAINT `bitacoras_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `desperdicios`
--
ALTER TABLE `desperdicios`
  ADD CONSTRAINT `desperdicios_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`),
  ADD CONSTRAINT `desperdicios_ibfk_2` FOREIGN KEY (`id_receta`) REFERENCES `receta` (`id_receta`),
  ADD CONSTRAINT `desperdicios_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`);

--
-- Filtros para la tabla `elaboraciones`
--
ALTER TABLE `elaboraciones`
  ADD CONSTRAINT `elaboraciones_ibfk_1` FOREIGN KEY (`idMateria`) REFERENCES `materiasprimas` (`idMateria`),
  ADD CONSTRAINT `elaboraciones_ibfk_2` FOREIGN KEY (`id_receta`) REFERENCES `receta` (`id_receta`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`id_Cargo`) REFERENCES `cargo` (`id_Cargo`),
  ADD CONSTRAINT `empleados_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `encabezadofactura`
--
ALTER TABLE `encabezadofactura`
  ADD CONSTRAINT `encabezadofactura_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id_empleado`);

--
-- Filtros para la tabla `materiasprimas`
--
ALTER TABLE `materiasprimas`
  ADD CONSTRAINT `materiasprimas_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `materiasprimas_ibfk_2` FOREIGN KEY (`id_Medida`) REFERENCES `unidadmedida` (`id_Medida`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_mesa`) REFERENCES `mesas` (`id_mesa`);

--
-- Filtros para la tabla `platillos`
--
ALTER TABLE `platillos`
  ADD CONSTRAINT `platillos_ibfk_1` FOREIGN KEY (`id_receta`) REFERENCES `receta` (`id_receta`),
  ADD CONSTRAINT `platillos_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `pre_pedido`
--
ALTER TABLE `pre_pedido`
  ADD CONSTRAINT `pre_pedido_ibfk_1` FOREIGN KEY (`id_mesa`) REFERENCES `mesas` (`id_mesa`),
  ADD CONSTRAINT `pre_pedido_ibfk_2` FOREIGN KEY (`id_platillo`) REFERENCES `platillos` (`id_platillo`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_Tipousuario`) REFERENCES `tipousuario` (`id_Tipousuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

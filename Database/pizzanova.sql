-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-09-2019 a las 23:44:13
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

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

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `existenciasPorAgotar` ()  NO SQL
    DETERMINISTIC
SELECT nombre_categoria, (COALESCE(SUM(cantidad),0)-(SELECT COALESCE(SUM(elab.`cantidad`),0) 
FROM pedidos AS ped 
JOIN detalle_pedido detped USING(`id_pedido`) 
JOIN platillos plat USING (`id_platillo`) 
JOIN receta rec USING(`id_receta`)
JOIN elaboraciones elab USING(`id_receta`)
WHERE elab.`idMateria`=inv.`idMateria` ORDER BY elab.`idMateria`)-(SELECT (COALESCE(SUM(des.cantidad),0)*COALESCE(SUM(elab.cantidad),0)) AS Cantidad FROM desperdicios des JOIN receta re USING(`id_receta`) JOIN elaboraciones elab USING(`id_receta`)
WHERE elab.idMateria= inv.`idMateria`
GROUP BY elab.idMateria )) AS CantidadTotal, CONCAT(nombre_materia, " (", uni.descripcion, ")") AS Materia 
FROM inventarios AS inv JOIN facturas AS fact ON inv.`id_factura`=fact.`id_factura` 
JOIN materiasprimas mate USING(`idMateria`) JOIN unidadmedida uni USING(id_Medida)
JOIN categorias cat USING(`id_categoria`)
WHERE fact.`estado`=1 GROUP BY cat.nombre_categoria ORDER BY CantidadTotal ASC LIMIT 5$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `materiasPorCategoria` ()  NO SQL
    DETERMINISTIC
SELECT nombre_categoria,(COALESCE(SUM(cantidad),0)-(SELECT COALESCE(SUM(elab.`cantidad`),0) 
FROM pedidos AS ped 
JOIN detalle_pedido detped USING(`id_pedido`) 
JOIN platillos plat USING (`id_platillo`) 
JOIN receta rec USING(`id_receta`)
JOIN elaboraciones elab USING(`id_receta`)
WHERE elab.`idMateria`=inv.`idMateria` ORDER BY elab.`idMateria`)-(SELECT (COALESCE(SUM(des.cantidad),0)*COALESCE(SUM(elab.cantidad),0)) AS Cantidad FROM desperdicios des JOIN receta re USING(`id_receta`) JOIN elaboraciones elab USING(`id_receta`)
WHERE elab.idMateria= inv.`idMateria`
GROUP BY elab.idMateria )) AS CantidadTotal, CONCAT(nombre_materia, " (", uni.descripcion, ")") AS Materia 
FROM inventarios AS inv JOIN facturas AS fact ON inv.`id_factura`=fact.`id_factura` 
JOIN materiasprimas mate USING(`idMateria`) JOIN unidadmedida uni USING(id_Medida)
JOIN categorias cat USING(`id_categoria`)
WHERE fact.`estado`=1 GROUP BY cat.nombre_categoria$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `readBodega` ()  NO SQL
    DETERMINISTIC
SELECT (COALESCE(SUM(cantidad),0)-(SELECT COALESCE(SUM(elab.`cantidad`),0) 
FROM pedidos AS ped 
JOIN detalle_pedido detped USING(`id_pedido`) 
JOIN platillos plat USING (`id_platillo`) 
JOIN receta rec USING(`id_receta`)
JOIN elaboraciones elab USING(`id_receta`)
WHERE elab.`idMateria`=inv.`idMateria` ORDER BY elab.`idMateria`)-(SELECT (COALESCE(SUM(des.cantidad),0)*COALESCE(SUM(elab.cantidad),0)) AS Cantidad FROM desperdicios des JOIN receta re USING(`id_receta`) JOIN elaboraciones elab USING(`id_receta`)
WHERE elab.idMateria= inv.`idMateria`
GROUP BY elab.idMateria)) AS Cantidad, CONCAT(nombre_materia, " (", uni.descripcion, ")") AS Materia 
FROM inventarios AS inv JOIN facturas AS fact ON inv.`id_factura`=fact.`id_factura` 
JOIN materiasprimas mate USING(`idMateria`) JOIN unidadmedida uni USING(id_Medida)
WHERE fact.`estado`=1 GROUP BY inv.`idMateria`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sobreExistencias` ()  NO SQL
    DETERMINISTIC
SELECT nombre_categoria, (COALESCE(SUM(cantidad),0)-(SELECT COALESCE(SUM(elab.`cantidad`),0) 
FROM pedidos AS ped 
JOIN detalle_pedido detped USING(`id_pedido`) 
JOIN platillos plat USING (`id_platillo`) 
JOIN receta rec USING(`id_receta`)
JOIN elaboraciones elab USING(`id_receta`)
WHERE elab.`idMateria`=inv.`idMateria` ORDER BY elab.`idMateria`)-(SELECT (COALESCE(SUM(des.cantidad),0)*COALESCE(SUM(elab.cantidad),0)) AS Cantidad FROM desperdicios des JOIN receta re USING(`id_receta`) JOIN elaboraciones elab USING(`id_receta`)
WHERE elab.idMateria= inv.`idMateria`
GROUP BY elab.idMateria )) AS CantidadTotal, CONCAT(nombre_materia, " (", uni.descripcion, ")") AS Materia 
FROM inventarios AS inv JOIN facturas AS fact ON inv.`id_factura`=fact.`id_factura` 
JOIN materiasprimas mate USING(`idMateria`) JOIN unidadmedida uni USING(id_Medida)
JOIN categorias cat USING(`id_categoria`)
WHERE fact.`estado`=1 GROUP BY cat.nombre_categoria ORDER BY CantidadTotal DESC LIMIT 5$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acciones`
--

CREATE TABLE `acciones` (
  `id_accion` int(10) UNSIGNED NOT NULL,
  `id_vista` int(10) UNSIGNED NOT NULL,
  `id_Tipousuario` int(10) UNSIGNED NOT NULL,
  `estado` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `acciones`
--

INSERT INTO `acciones` (`id_accion`, `id_vista`, `id_Tipousuario`, `estado`) VALUES
(25, 1, 1, 1),
(26, 2, 1, 1),
(27, 3, 1, 1),
(28, 4, 1, 1),
(29, 5, 1, 1),
(30, 6, 1, 1),
(31, 7, 1, 1),
(32, 8, 1, 1),
(33, 9, 1, 1),
(34, 10, 1, 1),
(35, 11, 1, 1),
(36, 12, 1, 1),
(37, 13, 1, 1),
(38, 14, 1, 1),
(39, 15, 1, 1),
(40, 16, 1, 1),
(41, 17, 1, 1),
(42, 18, 1, 1),
(79, 1, 4, 1),
(80, 2, 4, 1),
(81, 3, 4, 1),
(82, 4, 4, 0),
(83, 5, 4, 0),
(84, 6, 4, 0),
(85, 7, 4, 0),
(86, 8, 4, 0),
(87, 9, 4, 0),
(88, 10, 4, 0),
(89, 11, 4, 0),
(90, 12, 4, 0),
(91, 13, 4, 0),
(92, 14, 4, 0),
(93, 15, 4, 0),
(94, 16, 4, 0),
(95, 17, 4, 0),
(96, 18, 4, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacoras`
--

CREATE TABLE `bitacoras` (
  `id_bitacora` int(10) UNSIGNED NOT NULL,
  `usuario` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `accion` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `id_usuario` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id_Cargo` int(10) UNSIGNED NOT NULL,
  `nombre_Cargo` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id_Cargo`, `nombre_Cargo`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(10) UNSIGNED NOT NULL,
  `nombre_categoria` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` varchar(1000) COLLATE latin1_spanish_ci NOT NULL,
  `foto_categoria` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 es activo 0 es inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `descripcion`, `foto_categoria`, `estado`) VALUES
(10, 'Pizzas', 'La pizza es un pan plano horneado, habitualmente de forma redonda, elaborado con harina de trigo, sal, agua y levadura, cubierto con salsa de tomate y queso.', '5d8b9b90accd4.jpg', 1),
(11, 'Entradas', 'Una entrada consiste en un plato de comida que puede consumirse en primer lugar, antes del segundo plato o plato principal durante la comida o la cena.', '5d8b9c7d1a1f9.jpg', 1),
(12, 'Calzone', 'El calzone es una especialidad de la cocina italiana elaborado de forma similar a la pizza pero completamente cerrado por una masa, puede estar relleno de queso, carne, vegetales u otros condimentos, y se cocina al horno o frito', '5d8b9ce385f0a.jpg', 1),
(13, 'Pastas', 'La pasta es un conjunto de alimentos preparados con una masa cuyo ingrediente bÃ¡sico es la harina, mezclado con agua.', '5d8b9da15e317.jpg', 1),
(14, 'Postres', 'El postre es el plato de sabor dulce o agridulce que se toma al final de la comida, o de merienda.', '5d8b9e258284e.jpg', 1),
(15, 'Bebidas', 'Bebida es cualquier lÃ­quido que se ingiere y aunque la bebida por excelencia es el agua, el tÃ©rmino se refiere por antonomasia a las bebidas alcohÃ³licas y las bebidas gaseosas.', '5d8b9e98b69c0.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desperdicios`
--

CREATE TABLE `desperdicios` (
  `id_desperdicios` int(11) NOT NULL,
  `id_receta` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `id_empleado` int(10) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_desperdicio` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `desperdicios`
--

INSERT INTO `desperdicios` (`id_desperdicios`, `id_receta`, `id_usuario`, `id_empleado`, `cantidad`, `fecha_desperdicio`) VALUES
(4, 12, 2, 4, 5, '2019-09-25 14:40:01'),
(9, 19, 2, 1, 2, '2019-09-26 14:49:26'),
(12, 7, 1, 1, 1, '2019-09-26 15:50:02'),
(13, 4, 1, 1, 2, '2019-09-27 15:04:40'),
(14, 9, 1, 4, 1, '2019-09-27 15:17:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id_detalle` int(10) UNSIGNED NOT NULL,
  `id_pedido` int(11) UNSIGNED NOT NULL,
  `id_platillo` int(11) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`id_detalle`, `id_pedido`, `id_platillo`, `cantidad`) VALUES
(1, 1, 29, 1),
(2, 2, 30, 2),
(3, 3, 29, 1),
(4, 4, 29, 1),
(5, 5, 43, 3),
(6, 5, 56, 1),
(7, 6, 54, 1),
(8, 6, 55, 1),
(9, 6, 47, 2),
(10, 7, 43, 3),
(11, 8, 43, 1),
(12, 8, 45, 1),
(13, 8, 53, 1),
(14, 8, 49, 1),
(15, 9, 30, 1),
(16, 9, 59, 1),
(17, 9, 58, 1),
(18, 10, 54, 1),
(19, 10, 55, 1),
(20, 11, 43, 1),
(21, 11, 45, 1),
(22, 11, 53, 1),
(23, 12, 46, 1),
(24, 12, 47, 1),
(25, 13, 43, 1),
(26, 13, 45, 1),
(27, 14, 46, 1),
(28, 15, 56, 1),
(29, 15, 59, 1),
(30, 15, 48, 1),
(31, 16, 43, 1),
(32, 16, 56, 1),
(33, 17, 43, 1),
(34, 17, 56, 1),
(35, 18, 46, 1),
(36, 18, 47, 1),
(37, 18, 30, 1),
(38, 19, 46, 1),
(39, 19, 47, 1),
(40, 20, 53, 1),
(41, 20, 56, 1),
(42, 20, 49, 1),
(43, 21, 46, 1),
(44, 22, 29, 1),
(45, 22, 43, 1),
(46, 22, 47, 1),
(47, 23, 48, 4),
(48, 23, 49, 4),
(49, 23, 50, 52),
(50, 24, 48, 4),
(51, 24, 49, 4),
(52, 25, 29, 1),
(53, 25, 43, 1),
(54, 26, 48, 4),
(55, 27, 29, 1),
(56, 27, 53, 4),
(57, 28, 29, 1),
(58, 28, 57, 4),
(59, 29, 57, 6),
(60, 30, 29, 3),
(61, 30, 47, 2),
(62, 31, 29, 3),
(63, 32, 29, 3),
(64, 32, 30, 2),
(65, 32, 47, 1),
(66, 33, 29, 3),
(67, 34, 53, 2),
(68, 34, 47, 2),
(69, 34, 49, 3),
(70, 35, 29, 1),
(71, 36, 29, 1),
(72, 36, 47, 2),
(73, 37, 30, 1),
(74, 37, 48, 1),
(75, 38, 30, 1),
(76, 38, 34, 1),
(77, 38, 47, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elaboraciones`
--

CREATE TABLE `elaboraciones` (
  `id_elaboracion` int(11) NOT NULL,
  `id_receta` int(10) UNSIGNED DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `idMateria` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `elaboraciones`
--

INSERT INTO `elaboraciones` (`id_elaboracion`, `id_receta`, `cantidad`, `idMateria`) VALUES
(13, 4, 200, 19),
(14, 4, 80, 21),
(15, 4, 2, 20),
(16, 4, 10, 22),
(17, 4, 7, 27),
(18, 4, 50, 23),
(19, 4, 50, 24),
(20, 4, 50, 25),
(22, 5, 100, 21),
(23, 5, 300, 19),
(24, 5, 4, 20),
(25, 5, 12, 22),
(26, 5, 14, 27),
(27, 5, 100, 23),
(28, 5, 100, 24),
(29, 5, 100, 25),
(30, 6, 400, 19),
(31, 6, 6, 20),
(32, 6, 120, 21),
(33, 6, 14, 22),
(34, 6, 21, 27),
(35, 6, 150, 23),
(36, 6, 150, 24),
(37, 6, 150, 25),
(38, 7, 2, 28),
(39, 7, 5, 22),
(40, 7, 1, 30),
(41, 7, 1, 31),
(42, 7, 2, 24),
(43, 8, 3, 28),
(44, 8, 6, 22),
(46, 8, 2, 31),
(47, 8, 3, 24),
(48, 9, 100, 21),
(49, 9, 3, 22),
(50, 9, 50, 19),
(51, 9, 2, 27),
(52, 9, 2, 32),
(53, 9, 10, 20),
(54, 10, 150, 21),
(55, 10, 6, 22),
(56, 10, 120, 19),
(57, 10, 4, 27),
(58, 10, 4, 32),
(59, 10, 15, 20),
(60, 11, 1, 34),
(61, 12, 1, 35),
(62, 14, 6, 37),
(63, 14, 219, 21),
(64, 15, 200, 19),
(65, 15, 80, 21),
(66, 15, 2, 20),
(67, 15, 10, 22),
(68, 15, 7, 27),
(69, 15, 50, 23),
(70, 15, 50, 24),
(71, 15, 50, 25),
(72, 15, 50, 38),
(81, 18, 400, 19),
(82, 18, 6, 20),
(83, 18, 120, 21),
(84, 18, 14, 22),
(85, 18, 21, 27),
(86, 18, 150, 23),
(87, 18, 150, 24),
(88, 18, 150, 38),
(89, 19, 70, 19),
(90, 19, 12, 40),
(91, 19, 100, 24),
(92, 19, 70, 29),
(93, 19, 5, 27),
(94, 20, 70, 19),
(95, 20, 12, 40),
(96, 20, 100, 24),
(97, 20, 70, 29),
(98, 20, 5, 27),
(99, 20, 700, 41),
(100, 21, 200, 19),
(101, 21, 100, 25),
(102, 21, 25, 42),
(103, 21, 8, 43),
(104, 21, 90, 24),
(105, 22, 200, 19),
(106, 22, 90, 38),
(107, 22, 25, 42),
(108, 22, 90, 24),
(109, 23, 1, 44),
(110, 24, 1, 45),
(111, 22, 4, 32),
(112, 21, 1, 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(10) UNSIGNED NOT NULL,
  `nombre_empleado` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `apellido_empleado` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `dui` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `direccion` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `telefono` varchar(9) COLLATE latin1_spanish_ci NOT NULL,
  `genero` enum('M','F') COLLATE latin1_spanish_ci DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `nacionalidad` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `correo` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `id_Cargo` int(10) UNSIGNED DEFAULT NULL,
  `id_usuario` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `nombre_empleado`, `apellido_empleado`, `dui`, `direccion`, `telefono`, `genero`, `fecha_nacimiento`, `nacionalidad`, `correo`, `id_Cargo`, `id_usuario`) VALUES
(1, 'Ezequiel', 'Avalos', '12345678-9', 'Col. San Sebastian, pje 6, casa 16', '7458-9698', 'M', '2000-02-01', 'El Salvador', 'aezequiel56@gmail.com', 1, 1),
(3, 'Gerardo', 'Ramirez', '12345688-9', 'Mejicanos, pje 2, casa 10', '7799-9685', 'M', '2001-09-12', 'El Salvador', 'gerardogo145@gmail.com', 1, 1),
(4, 'Carlos', 'Quijano', '98745632-1', 'Calle al volcÃ¡n, col bloodymerry, casa 17', '7895-6865', 'M', '2001-06-29', 'El Salvador', 'quijanoo12345@gmail.com', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id_factura` int(11) UNSIGNED NOT NULL,
  `correlativo` varchar(8) NOT NULL,
  `id_proveedor` int(11) UNSIGNED NOT NULL,
  `fecha_ingreso` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(11) UNSIGNED NOT NULL,
  `estado` int(11) NOT NULL COMMENT '2 es en proceso 1 es ingresada 0 es nulo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id_factura`, `correlativo`, `id_proveedor`, `fecha_ingreso`, `id_usuario`, `estado`) VALUES
(1, '00000001', 1, '2019-09-25 22:29:51', 1, 1),
(2, '00000002', 1, '2019-09-25 22:36:59', 1, 0),
(3, '00000003', 2, '2019-09-26 07:22:20', 1, 1),
(4, '00000004', 3, '2019-04-23 11:21:29', 1, 1),
(5, '00000005', 4, '2019-07-24 11:26:21', 1, 0),
(6, '00000006', 5, '2019-07-25 14:30:39', 1, 1),
(8, '00000007', 2, '2019-09-25 14:45:23', 1, 0),
(9, '00000008', 2, '2019-09-26 13:41:57', 1, 0),
(10, '00001234', 3, '2019-09-26 13:55:49', 1, 0),
(11, '01234567', 4, '2019-09-26 14:04:28', 1, 1),
(12, '00123456', 2, '2019-09-26 14:39:55', 1, 0),
(13, '09878907', 2, '2019-09-26 14:46:49', 1, 0),
(14, '07554545', 4, '2019-09-26 14:52:14', 1, 1),
(15, '05745123', 3, '2019-09-26 14:56:20', 1, 0),
(16, '65320231', 2, '2019-09-26 14:57:53', 1, 0),
(17, '00012345', 1, '2019-09-26 15:04:38', 1, 0),
(18, '03211564', 1, '2019-09-26 15:10:12', 1, 0),
(19, '00321549', 2, '2019-09-26 15:18:40', 1, 0),
(20, '08904152', 2, '2019-09-26 15:28:26', 1, 0),
(21, '15467520', 5, '2019-09-27 08:39:08', 1, 0),
(22, '45664532', 1, '2019-09-27 08:40:30', 1, 0),
(23, '45421358', 3, '2019-09-27 08:41:28', 1, 0),
(24, '21365767', 2, '2019-09-27 08:48:38', 1, 0),
(25, '00001236', 2, '2019-09-27 09:26:41', 1, 0),
(26, '12345678', 1, '2019-09-27 09:39:11', 1, 0),
(27, '15615613', 5, '2019-09-27 10:03:21', 1, 0),
(28, '01234568', 1, '2019-09-27 11:41:42', 1, 1),
(29, '00000015', 3, '2019-09-27 15:02:52', 1, 1),
(30, '00000017', 4, '2019-09-27 15:15:40', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventarios`
--

CREATE TABLE `inventarios` (
  `id_inventario` int(11) UNSIGNED NOT NULL,
  `idMateria` int(11) UNSIGNED NOT NULL,
  `cantidad` varchar(10) NOT NULL,
  `precio` double(6,2) NOT NULL,
  `id_factura` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inventarios`
--

INSERT INTO `inventarios` (`id_inventario`, `idMateria`, `cantidad`, `precio`, `id_factura`) VALUES
(1, 19, '10', 10.00, 1),
(2, 19, '1', 12.00, 2),
(3, 19, '200', 1.50, 3),
(4, 22, '2000', 0.05, 3),
(5, 20, '10', 4.25, 3),
(6, 25, '20', 1.25, 4),
(7, 26, '100', 0.30, 4),
(8, 34, '8', 0.50, 4),
(9, 39, '100', 0.30, 5),
(10, 43, '100000', 0.10, 5),
(11, 32, '2158', 0.03, 6),
(12, 28, '500', 0.10, 6),
(13, 38, '7000', 0.11, 6),
(14, 26, '7230', 0.25, 6),
(15, 38, '500', 0.20, 8),
(16, 19, '28936', 2.50, 9),
(17, 34, '46328', 0.40, 10),
(18, 36, '963', 1.25, 10),
(19, 35, '500', 1.25, 10),
(20, 32, '436', 1.50, 11),
(21, 29, '5', 1.25, 12),
(22, 43, '234', 0.60, 13),
(23, 19, '12543', 1.25, 14),
(24, 25, '15780', 5.25, 14),
(25, 20, '284', 2.12, 14),
(26, 29, '27854', 1.25, 14),
(27, 19, '121042670', 2.50, 15),
(28, 25, '1000000', 1.25, 16),
(29, 20, '1125', 1.25, 16),
(30, 21, '35', 1.25, 17),
(31, 22, '250000', 1.25, 18),
(32, 19, '500000', 1.25, 18),
(33, 25, '2500000', 1.25, 18),
(34, 25, '45', 1.25, 19),
(35, 22, '11750123', 2.25, 20),
(36, 19, '221653456', 1.00, 20),
(37, 25, '841070052', 2.22, 20),
(38, 20, '24991234', 2.21, 20),
(39, 19, '100', 1.20, 21),
(40, 25, '25', 2.20, 22),
(41, 25, '14000', 1.25, 23),
(42, 35, '1', 0.55, 24),
(43, 43, '10', 1.25, 25),
(44, 26, '100', 1.30, 26),
(45, 37, '15', 1.20, 27),
(46, 22, '4', 1.00, 28),
(47, 32, '200', 0.04, 29),
(48, 43, '145', 0.02, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiasprimas`
--

CREATE TABLE `materiasprimas` (
  `idMateria` int(10) UNSIGNED NOT NULL,
  `nombre_materia` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` varchar(1000) COLLATE latin1_spanish_ci NOT NULL,
  `foto` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `id_categoria` int(10) UNSIGNED DEFAULT NULL,
  `id_Medida` int(10) UNSIGNED DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 es activo 0 es inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `materiasprimas`
--

INSERT INTO `materiasprimas` (`idMateria`, `nombre_materia`, `descripcion`, `foto`, `id_categoria`, `id_Medida`, `estado`) VALUES
(19, 'Harina para pizza', 'La harina es el polvo fino que se obtiene del cereal molido. Se puede obtener harina de distintos cereales.', '5d8ba189b5119.png', 10, 14, 1),
(20, 'Levadura', 'Sustancia fermentada que provoca a su vez la fermentaciÃ³n de otra con la que se mezcla; se emplea en reposterÃ­a y en la elaboraciÃ³n de cerveza.', '5d8ba2fbeac4f.png', 10, 14, 1),
(21, 'Agua', 'El agua es una sustancia cuya molecula esta compuesta por dos atomos de hidrogeno y uno de oxigeno', '5d8ba4c48d679.jpg', 10, 14, 1),
(22, 'Aceite de oliva', 'El aceite de oliva es un aceite vegetal de uso principalmente culinario. Se obtiene del fruto del olivo, denominado oliva o aceituna.', '5d8ba5736b15a.jpg', 10, 14, 1),
(23, 'Salsa de tomate', 'La salsa de tomate o salsa roja es una salsa o pasta elaborada principalmente a partir de pulpa de tomates, a la que se le aÃ±ade, dependiendo del tipo particular de salsa y del paÃ­s en que sea elaborada', '5d8ba6081ece9.jpg', 10, 14, 1),
(24, 'Queso Mozzarella', 'La mozzarella del italiano mozzare cortar o de su variante regional muzzare, es un tipo de queso originario de la cocina italiana', '5d8ba6b97fc64.jpg', 10, 14, 1),
(25, 'JamÃ³n', 'El jamÃ³n es el nombre genÃ©rico del producto alimenticio obtenido de las patas traseras del cerdo.', '5d8ba724b184f.jpg', 10, 14, 1),
(26, 'Carne', 'La carne es el tejido animal, principalmente muscular, que se consume como alimento.', '5d8ba774221b6.jpg', 10, 14, 1),
(27, 'Sal', 'Sustancia blanca, cristalina, muy soluble en el agua, que abunda en la naturaleza en forma de grandes masas sÃ³lidas o disuelta en el agua del mar y en la de algunas lagunas y manantiales; se emplea como condimento, para conservar y preparar alimentos, para la obtenciÃ³n del sodio y sus compuestos, etc', '5d8ba86e67e12.jpg', 10, 14, 1),
(28, 'Pan Baguette', 'Es una variedad de pan que se caracteriza por emplear harina de trigo, por ser mucho mÃ¡s largo que ancho y por su corteza crujiente.', '5d8ccb14c19ba.jpg', 11, 15, 1),
(29, 'Mantequilla', 'Grasa comestible que se obtiene agitando o batiendo la crema de la leche de vaca y es de consistencia blanda, color amarillento y sabor suave; se consume cruda untada en pan y tambiÃ©n se emplea en la elaboraciÃ³n de platos o cocciÃ³n de alimentos.', '5d8ccb8c15a9d.jpg', 11, 14, 1),
(30, 'Diente de ajo', 'La cabeza entera recibe el nombre de bulbo de ajo, mientras que a cada segmento se le llama diente.', '5d8ccc03dd513.jpg', 11, 14, 1),
(31, 'Pimienta Molida', 'Fruto del pimentero, pequeÃ±o, redondo y rojo, que toma color negro cuando se seca, se arruga un poco y contiene una semilla esfÃ©rica, blanca y aromÃ¡tica y de un sabor muy picante.', '5d8ccc635f6a2.jpg', 11, 14, 1),
(32, 'Oregano', 'Planta aromÃ¡tica de tallos vellosos, hojas pequeÃ±as y ovaladas, flores rosadas o malvas, agrupadas en espiga y fruto seco y globoso.', '5d8cce3231887.jpg', 11, 14, 1),
(33, 'Cebolla', 'Planta hortÃ­cola de tallo hueco, fusiforme e hinchado hacia la base, hojas largas y estrechas, flores blancas o rosadas, agrupadas en umbelas, fruto en cÃ¡psulas muy pequeÃ±as, lleno de semillas diminutas, y bulbo comestible', '5d8cce7ee451b.jpg', 11, 14, 1),
(34, 'Coca Cola 1.5 lt', 'Bebida refrescante y efervescente elaborada con agua, Ã¡cido carbÃ³nico y azÃºcar.', '5d8cd1ea46500.jpg', 15, 15, 1),
(35, 'Fanta 1.5 lt', 'Bebida refrescante y efervescente elaborada con agua, Ã¡cido carbÃ³nico y azÃºcar.', '5d8cd464d09ab.jpg', 15, 15, 1),
(36, 'Sprite', 'Bebida refrescante y efervescente elaborada con agua, Ã¡cido carbÃ³nico y azÃºcar.', '5d8cd52a8a2a9.png', 15, 15, 1),
(37, 'CafÃ©', 'Se sirve habitualmente caliente, pero tambiÃ©n se toma frÃ­o o con hielo como en EspaÃ±a o Grecia. En EspaÃ±a, Portugal, Paraguay y Colombia es frecuente el consumo de cafÃ© torrado o torrefacto, es decir, tostado en presencia de azÃºcar.', '5d8cd65782c92.jpg', 15, 14, 1),
(38, 'Pepperoni', 'El pepperoni o peperoni es una variedad estadounidense de salami. El pepperoni es caracterÃ­sticamente suave, ligeramente ahumado y de color rojo brillante.', '5d8cd7546a77f.png', 10, 14, 1),
(39, 'Salsa boloÃ±esa', 'La boloÃ±esa o bolognesa es una salsa muy comÃºnmente usada para acompaÃ±ar pastas o a la tÃ­pica polenta. Es una salsa espesa, de color marrÃ³n rojo, muy empleada en las comarcas cercanas a Bolonia.', '5d8cdca65ca3a.jpg', 13, 14, 1),
(40, 'Laminas de pasta', 'Es un tipo de pasta que se sirve en lÃ¡minas,', '5d8cdd60a0fb3.jpeg', 13, 14, 1),
(41, 'Pechuga de pollo', 'La carne de pollo es como se denomina a los tejidos musculares y Ã³rganos procedentes del pollo.', '5d8cded368ad2.jpg', 11, 14, 1),
(42, 'Tomate', 'Es una especie de planta herbÃ¡cea del gÃ©nero Solanum de la familia Solanaceae; es nativa de Centro, del norte y noroeste de SudamÃ©rica y su uso como comida se habrÃ­a originado en MÃ©xico hace unos 2500 aÃ±os', '5d8ce0fad9bde.jpg', 10, 14, 1),
(43, 'AjÃ­ molido', 'El chile en polvo es la fruta seca y pulverizada de una o mÃ¡s variedades de ajÃ­, a veces con la adiciÃ³n de otras especias.', '5d8ce15181013.jpg', 12, 14, 1),
(44, 'Taza de helado de vainilla', 'La vainilla se usa con frecuencia para dar sabor al helado, especialmente en AmÃ©rica del Norte y Europa. El helado de vainilla, al igual que otros sabores de helado, se creÃ³ originalmente enfriando una mezcla hecha de crema, azÃºcar y vainilla sobre un recipiente con hielo y sal.', '5d8ce3c466f13.jpg', 14, 14, 1),
(45, 'Pastel del dÃ­a', 'Masa de harina y manteca, cocida al horno, en que ordinariamente se envuelve crema o dulce, y fruta.', '5d8ce5e3dd49f.jpg', 14, 16, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id_mesa` int(10) UNSIGNED NOT NULL,
  `numero_mesa` int(10) UNSIGNED NOT NULL,
  `estado_mesa` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id_mesa`, `numero_mesa`, `estado_mesa`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1),
(11, 11, 1),
(12, 12, 1),
(13, 13, 1),
(14, 14, 1),
(15, 15, 1),
(16, 16, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) UNSIGNED NOT NULL,
  `fecha_pedido` date NOT NULL,
  `hora_pedido` time NOT NULL,
  `id_mesa` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `fecha_pedido`, `hora_pedido`, `id_mesa`, `id_usuario`) VALUES
(1, '2019-09-25', '19:54:21', 1, 1),
(2, '2019-09-25', '20:04:29', 1, 1),
(3, '2019-09-26', '07:26:45', 1, 1),
(4, '2019-09-26', '08:45:42', 1, 1),
(5, '2019-09-26', '10:27:18', 1, 1),
(6, '2019-09-26', '10:28:15', 16, 1),
(7, '2019-09-27', '09:25:18', 1, 1),
(8, '2019-09-27', '09:27:16', 1, 1),
(9, '2019-09-27', '09:28:02', 4, 1),
(10, '2019-08-27', '09:14:34', 16, 1),
(11, '2019-08-27', '09:14:48', 1, 1),
(12, '2019-08-27', '09:15:20', 16, 1),
(13, '2019-07-27', '09:16:32', 1, 1),
(14, '2019-07-27', '09:16:39', 16, 1),
(15, '2019-07-27', '09:17:17', 11, 1),
(16, '2019-06-25', '10:17:58', 1, 1),
(17, '2019-06-25', '10:18:25', 1, 1),
(18, '2019-06-25', '10:19:00', 10, 1),
(19, '2019-05-24', '11:19:41', 10, 1),
(20, '2019-05-24', '11:20:10', 16, 1),
(21, '2019-05-24', '11:20:24', 10, 1),
(22, '2019-09-25', '14:43:57', 1, 1),
(23, '2019-09-26', '13:59:34', 2, 1),
(24, '2019-09-26', '13:59:43', 2, 1),
(25, '2019-09-26', '14:00:13', 1, 1),
(26, '2019-09-26', '14:00:28', 2, 1),
(27, '2019-09-26', '14:05:40', 1, 1),
(28, '2019-09-26', '14:08:27', 3, 1),
(29, '2019-09-26', '14:10:46', 1, 1),
(30, '2019-09-26', '14:15:49', 1, 1),
(31, '2019-09-26', '14:39:14', 2, 1),
(32, '2019-09-26', '15:15:31', 2, 1),
(33, '2019-09-27', '09:25:35', 3, 1),
(34, '2019-09-27', '09:38:15', 13, 1),
(35, '2019-09-27', '10:02:21', 4, 1),
(36, '2019-09-27', '10:29:02', 11, 1),
(37, '2019-09-27', '15:01:18', 5, 1),
(38, '2019-09-27', '15:14:30', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platillos`
--

CREATE TABLE `platillos` (
  `id_platillo` int(11) UNSIGNED NOT NULL,
  `nombre_platillo` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `precio` double(6,2) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 es activo 0 es inactivo',
  `id_receta` int(10) UNSIGNED DEFAULT NULL,
  `id_categoria` int(10) UNSIGNED DEFAULT NULL,
  `imagen` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `platillos`
--

INSERT INTO `platillos` (`id_platillo`, `nombre_platillo`, `precio`, `estado`, `id_receta`, `id_categoria`, `imagen`) VALUES
(29, 'Pizza de jamÃ³n personal', 3.70, 1, 4, 10, '5d8baa78110f7.jpg'),
(30, 'Pizza de jamÃ³n grande', 10.20, 1, 5, 10, '5d8bda4f470ff.jpg'),
(34, 'Pizza de jamÃ³n familiar', 14.99, 1, 6, 10, '5d8c399ca03eb.jpg'),
(43, 'Pan con ajo orden de 4', 2.35, 1, 7, 11, '5d8ccd9be9c19.jpg'),
(44, 'Pan con ajo orden de 6', 3.00, 1, 8, 11, '5d8ccdc37fe5a.jpg'),
(45, 'Palicruch orden de 5', 3.45, 1, 9, 11, '5d8cd06b6137a.jpg'),
(46, 'Palicruch orden de 10', 5.25, 1, 10, 11, '5d8cd125b7d83.jpg'),
(47, 'Pichel de Coca Cola', 5.75, 1, 11, 15, '5d8cd3d69bbd6.jpg'),
(48, 'Pichel de Fanta', 5.75, 1, 12, 15, '5d8cd4dd73f84.jpg'),
(49, 'Pichel de Sprite', 5.75, 1, 13, 15, '5d8cd5c82cabf.png'),
(50, 'Taza de cafÃ©', 0.75, 1, 14, 15, '5d8cd6f07bae9.jpg'),
(51, 'Pizza de pepperoni personal', 3.70, 1, 15, 10, '5d8cd8b9e829a.jpg'),
(52, 'Pizza de pepperoni grande', 10.20, 1, 17, 10, '5d8cdb2e0292b.jpg'),
(53, 'Pizza de pepperoni familiar', 13.70, 1, 18, 10, '5d8cdb55b60b0.jpg'),
(54, 'Lasagna a la bolognesa', 5.25, 1, 19, 13, '5d8cde8894f1d.jpg'),
(55, 'Lasagna de pollo', 5.25, 1, 20, 13, '5d8cdff45681a.jpg'),
(56, 'Calzone de jamÃ³n y queso', 4.45, 1, 21, 12, '5d8ce248373a6.jpg'),
(57, 'Calzone de pepperoni', 4.25, 1, 22, 12, '5d8ce3032d3c9.jpg'),
(58, 'Helado de vainilla', 2.20, 1, 23, 14, '5d8ce5241cabc.jpg'),
(59, 'PorciÃ³n de pastel del dÃ­a', 1.50, 1, 24, 14, '5d8ce6ab19040.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_pedido`
--

CREATE TABLE `pre_pedido` (
  `id_prepedido` int(10) UNSIGNED NOT NULL,
  `id_mesa` int(10) UNSIGNED NOT NULL,
  `id_platillo` int(10) UNSIGNED NOT NULL,
  `cantidad` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `pre_pedido`
--

INSERT INTO `pre_pedido` (`id_prepedido`, `id_mesa`, `id_platillo`, `cantidad`) VALUES
(43, 13, 53, 2),
(44, 13, 47, 2),
(47, 11, 29, 1),
(48, 5, 30, 1),
(51, 5, 34, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(10) UNSIGNED NOT NULL,
  `nom_proveedor` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `contacto` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `telefono` varchar(9) COLLATE latin1_spanish_ci DEFAULT NULL,
  `estado` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nom_proveedor`, `contacto`, `telefono`, `estado`) VALUES
(1, 'MamÃ¡ Chuz', 'Mariana de Gomez', '7743-0409', 1),
(2, 'Grupo Import', 'Manuel Luna', '2236-3299', 1),
(3, 'Distribuidora del Caribe', 'Gabriel Figueroa', '2298-6900', 1),
(4, 'DISULA', 'Paolo Perla', '2347-0000', 1),
(5, 'Conessa', 'Maria JosÃ©', '2243-1725', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta`
--

CREATE TABLE `receta` (
  `id_receta` int(10) UNSIGNED NOT NULL,
  `nombre_receta` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `tiempo` varchar(11) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `receta`
--

INSERT INTO `receta` (`id_receta`, `nombre_receta`, `tiempo`) VALUES
(4, 'Pizza de jamÃ³n personal', '10 minutos'),
(5, 'Pizza de jamÃ³n grande', '15 minutos'),
(6, 'Pizza de jamÃ³n familiar', '20 minutos'),
(7, 'Pan con ajo orden de 4', '5 minutos'),
(8, 'Pan con ajo orden de 6', '5 minutos'),
(9, 'Palicruch orden de 5', '5 minutos'),
(10, 'Palicruch orden de 10', '7 minutos'),
(11, 'Coca Cola 1.5 lt', '0 minutos'),
(12, 'Fanta 1.5 lt', '0 minutos'),
(13, 'Sprite 1.5 lt', '0 minutos'),
(14, 'Taza de cafÃ©', '5 minutos'),
(15, 'Pizza de pepperoni personal', '10 minutos'),
(17, 'Pizza de pepperoni grande', '10 minutos'),
(18, 'Pizza de pepperoni familiar', '20 minutos'),
(19, 'LasaÃ±a a la boloÃ±esa', '20 minutos'),
(20, 'Lasagna de pollo', '20 minutos'),
(21, 'Calzone relleno con jamÃ³n y queso', '15 minutos'),
(22, 'Calzone relleno de pepperoni', '15 minutos'),
(23, 'Taza de helado de vainilla', '0 minutos'),
(24, 'PorciÃ³n de pastel', '0 minutos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id_tarea` int(10) UNSIGNED NOT NULL,
  `mensaje` varchar(80) COLLATE latin1_spanish_ci NOT NULL,
  `importancia` varchar(50) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id_tarea`, `mensaje`, `importancia`) VALUES
(19, 'asdasd', 'asdasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE `tipousuario` (
  `id_Tipousuario` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(20) COLLATE latin1_spanish_ci DEFAULT NULL,
  `descripcion` varchar(1000) COLLATE latin1_spanish_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 es activo 0 es inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`id_Tipousuario`, `tipo`, `descripcion`, `estado`) VALUES
(1, 'admin', 'Tiene acceso a todas las funciones', 1),
(4, 'Cajero', 'Solo puede hacer ordenes', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidadmedida`
--

CREATE TABLE `unidadmedida` (
  `id_Medida` int(10) UNSIGNED NOT NULL,
  `nombre_medida` varchar(40) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `unidadmedida`
--

INSERT INTO `unidadmedida` (`id_Medida`, `nombre_medida`, `descripcion`) VALUES
(9, 'Kilogramo', 'Kg'),
(10, 'Libra', 'lb'),
(11, 'Mililitro', 'ml'),
(12, 'Litro', 'lt'),
(13, 'Onza', 'oz'),
(14, 'Gramo', 'gr'),
(15, 'Unidad', 'unidad'),
(16, 'PorciÃ³n', 'PorciÃ³n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `alias` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `correo_usuario` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `clave_usuario` varchar(60) COLLATE latin1_spanish_ci NOT NULL,
  `foto_usuario` varchar(50) COLLATE latin1_spanish_ci DEFAULT NULL,
  `token_usuario` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `intentos` int(11) NOT NULL DEFAULT '0',
  `logueado` tinyint(4) UNSIGNED NOT NULL DEFAULT '0',
  `estado_usuario` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 es activo 0 es inactivo',
  `id_Tipousuario` int(10) UNSIGNED NOT NULL,
  `fecha_contrasena` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `alias`, `correo_usuario`, `clave_usuario`, `foto_usuario`, `token_usuario`, `fecha_creacion`, `intentos`, `logueado`, `estado_usuario`, `id_Tipousuario`, `fecha_contrasena`) VALUES
(1, 'Gerardo', 'gerardogo145@gmail.com', '$2y$10$8HM98qGLdf4Misa221eWOOdpCftUvf4JHj5vP8.yKohh58JajiGvC', '5d8b92fb67a7d.jpg', NULL, '2019-09-25 16:16:59', 0, 0, 1, 1, '2019-09-25 10:16:59'),
(2, 'Ezequiel', 'aezequiel56@gmail.com', '$2y$10$V9xSCKcILSuJT6YHQvxNROPhpdjaN6W5a9SDcbCYFZLzSVCtmlnLa', '5d8bdf60ed81c.png', NULL, '2019-09-25 21:42:57', 0, 0, 1, 4, '2019-09-25 15:42:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vistas`
--

CREATE TABLE `vistas` (
  `id_vista` int(10) UNSIGNED NOT NULL,
  `nombre_vista` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `ruta` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `icono` varchar(100) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `vistas`
--

INSERT INTO `vistas` (`id_vista`, `nombre_vista`, `ruta`, `icono`) VALUES
(1, 'Inicio', 'inicio.php', 'tachometer-alt'),
(2, 'Ordenes', 'ordenes.php', 'list'),
(3, 'Bodegas', 'bodegas.php', 'truck-loading'),
(4, 'Inventario', 'inventarios.php', 'cart-plus'),
(5, 'Platillos', 'platillos.php', 'utensils'),
(6, 'Recetas', 'recetas.php', 'book'),
(7, 'Materia Prima', 'materia_prima.php', 'cart-plus'),
(8, 'Pedidos', 'pedidos.php', 'pizza-slice'),
(9, 'Proveedores', 'proveedores.php', 'people-carry'),
(10, 'Categorias', 'categorias.php', 'list'),
(11, 'Usuarios', 'usuarios.php', 'user-plus'),
(12, 'Empleados', 'empleados.php', 'users'),
(13, 'Desperdicios', 'desperdicios.php', 'trash'),
(14, 'Mesas', 'mesas.php', 'utensils'),
(15, 'Reportes', 'reportes.php', 'chart-bar'),
(16, 'Unidades de medida', 'unidadmedida.php', 'balance-scale'),
(17, 'Cargo', 'cargo.php', 'address-book'),
(18, 'Tipo de usuario', 'tipo_usuarios.php', 'users');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acciones`
--
ALTER TABLE `acciones`
  ADD PRIMARY KEY (`id_accion`),
  ADD KEY `id_Tipousuario` (`id_Tipousuario`),
  ADD KEY `id_vista` (`id_vista`);

--
-- Indices de la tabla `bitacoras`
--
ALTER TABLE `bitacoras`
  ADD PRIMARY KEY (`id_bitacora`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id_Cargo`),
  ADD UNIQUE KEY `nombre_Cargo` (`nombre_Cargo`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `desperdicios`
--
ALTER TABLE `desperdicios`
  ADD PRIMARY KEY (`id_desperdicios`),
  ADD KEY `id_empleado` (`id_empleado`),
  ADD KEY `id_receta` (`id_receta`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_platillo` (`id_platillo`);

--
-- Indices de la tabla `elaboraciones`
--
ALTER TABLE `elaboraciones`
  ADD PRIMARY KEY (`id_elaboracion`),
  ADD KEY `idMateria` (`idMateria`),
  ADD KEY `id_receta` (`id_receta`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`),
  ADD UNIQUE KEY `dui` (`dui`),
  ADD UNIQUE KEY `telefono` (`telefono`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `id_Cargo` (`id_Cargo`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id_factura`),
  ADD UNIQUE KEY `correlativo` (`correlativo`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `facturas_ibfk_1` (`id_proveedor`);

--
-- Indices de la tabla `inventarios`
--
ALTER TABLE `inventarios`
  ADD PRIMARY KEY (`id_inventario`),
  ADD KEY `idMateria` (`idMateria`),
  ADD KEY `id_factura` (`id_factura`);

--
-- Indices de la tabla `materiasprimas`
--
ALTER TABLE `materiasprimas`
  ADD PRIMARY KEY (`idMateria`),
  ADD UNIQUE KEY `nombre_materia` (`nombre_materia`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_Medida` (`id_Medida`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id_mesa`),
  ADD UNIQUE KEY `numero_mesa` (`numero_mesa`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_mesa` (`id_mesa`);

--
-- Indices de la tabla `platillos`
--
ALTER TABLE `platillos`
  ADD PRIMARY KEY (`id_platillo`),
  ADD UNIQUE KEY `nombre_platillo` (`nombre_platillo`),
  ADD UNIQUE KEY `nombre_platillo_2` (`nombre_platillo`),
  ADD KEY `id_receta` (`id_receta`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `pre_pedido`
--
ALTER TABLE `pre_pedido`
  ADD PRIMARY KEY (`id_prepedido`),
  ADD KEY `id_mesa` (`id_mesa`),
  ADD KEY `id_platillo` (`id_platillo`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `receta`
--
ALTER TABLE `receta`
  ADD PRIMARY KEY (`id_receta`),
  ADD UNIQUE KEY `nombre_receta` (`nombre_receta`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id_tarea`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`id_Tipousuario`);

--
-- Indices de la tabla `unidadmedida`
--
ALTER TABLE `unidadmedida`
  ADD PRIMARY KEY (`id_Medida`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `alias` (`alias`),
  ADD UNIQUE KEY `correo_usuario` (`correo_usuario`),
  ADD KEY `id_Tipousuario` (`id_Tipousuario`);

--
-- Indices de la tabla `vistas`
--
ALTER TABLE `vistas`
  ADD PRIMARY KEY (`id_vista`),
  ADD UNIQUE KEY `nombre_vista` (`nombre_vista`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acciones`
--
ALTER TABLE `acciones`
  MODIFY `id_accion` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de la tabla `bitacoras`
--
ALTER TABLE `bitacoras`
  MODIFY `id_bitacora` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id_Cargo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `desperdicios`
--
ALTER TABLE `desperdicios`
  MODIFY `id_desperdicios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_detalle` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `elaboraciones`
--
ALTER TABLE `elaboraciones`
  MODIFY `id_elaboracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id_factura` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `inventarios`
--
ALTER TABLE `inventarios`
  MODIFY `id_inventario` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `materiasprimas`
--
ALTER TABLE `materiasprimas`
  MODIFY `idMateria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id_mesa` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `platillos`
--
ALTER TABLE `platillos`
  MODIFY `id_platillo` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `pre_pedido`
--
ALTER TABLE `pre_pedido`
  MODIFY `id_prepedido` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `receta`
--
ALTER TABLE `receta`
  MODIFY `id_receta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id_tarea` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `id_Tipousuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `unidadmedida`
--
ALTER TABLE `unidadmedida`
  MODIFY `id_Medida` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `vistas`
--
ALTER TABLE `vistas`
  MODIFY `id_vista` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acciones`
--
ALTER TABLE `acciones`
  ADD CONSTRAINT `acciones_ibfk_2` FOREIGN KEY (`id_Tipousuario`) REFERENCES `tipousuario` (`id_Tipousuario`),
  ADD CONSTRAINT `acciones_ibfk_3` FOREIGN KEY (`id_vista`) REFERENCES `vistas` (`id_vista`);

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
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`id_platillo`) REFERENCES `platillos` (`id_platillo`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`id_Cargo`) REFERENCES `cargo` (`id_Cargo`),
  ADD CONSTRAINT `empleados_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`),
  ADD CONSTRAINT `facturas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `inventarios`
--
ALTER TABLE `inventarios`
  ADD CONSTRAINT `inventarios_ibfk_1` FOREIGN KEY (`idMateria`) REFERENCES `materiasprimas` (`idMateria`),
  ADD CONSTRAINT `inventarios_ibfk_2` FOREIGN KEY (`id_factura`) REFERENCES `facturas` (`id_factura`);

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
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_mesa`) REFERENCES `mesas` (`id_mesa`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `platillos`
--
ALTER TABLE `platillos`
  ADD CONSTRAINT `platillos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `platillos_ibfk_2` FOREIGN KEY (`id_receta`) REFERENCES `receta` (`id_receta`);

--
-- Filtros para la tabla `pre_pedido`
--
ALTER TABLE `pre_pedido`
  ADD CONSTRAINT `pre_pedido_ibfk_2` FOREIGN KEY (`id_platillo`) REFERENCES `platillos` (`id_platillo`),
  ADD CONSTRAINT `pre_pedido_ibfk_3` FOREIGN KEY (`id_mesa`) REFERENCES `mesas` (`id_mesa`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_Tipousuario`) REFERENCES `tipousuario` (`id_Tipousuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

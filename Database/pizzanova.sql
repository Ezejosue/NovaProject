-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-07-2019 a las 02:19:48
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacoras`
--

CREATE TABLE `bitacoras` (
  `id_bitacora` int(10) UNSIGNED NOT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `accion` varchar(50) NOT NULL,
  `id_usuario` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id_Cargo` int(10) UNSIGNED NOT NULL,
  `nombre_Cargo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `nombre_categoria` varchar(50) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `foto_categoria` varchar(50) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 es activo 0 es inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `descripcion`, `foto_categoria`, `estado`) VALUES
(1, 'Bebidas', 'test', '5d2ce843cb3a3.jpg', 1),
(2, 'Pizzas', 'test', '5d2ce9aa94cad.jpeg', 1),
(3, 'Pupusas', 'test', '5d2ce9b5ec98f.jpeg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallefactura`
--

CREATE TABLE `detallefactura` (
  `id_detallefac` int(10) UNSIGNED NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `id_platillo` int(10) UNSIGNED DEFAULT NULL,
  `subtotal` double(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(10) UNSIGNED NOT NULL,
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
  `id_usuario` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encabezadofactura`
--

CREATE TABLE `encabezadofactura` (
  `id_EncabezadoFac` int(10) UNSIGNED NOT NULL,
  `nombre_cliente` varchar(50) DEFAULT NULL,
  `id_empleado` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiasprimas`
--

CREATE TABLE `materiasprimas` (
  `idMateria` int(10) UNSIGNED NOT NULL,
  `nombre_materia` varchar(50) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `id_categoria` int(10) UNSIGNED DEFAULT NULL,
  `id_Medida` int(10) UNSIGNED DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 es activo 0 es inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `materiasprimas`
--

INSERT INTO `materiasprimas` (`idMateria`, `nombre_materia`, `descripcion`, `cantidad`, `foto`, `id_categoria`, `id_Medida`, `estado`) VALUES
(1, 'test', 'test', 2, '5d2cefcc97528.jpg', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id_mesa` int(10) UNSIGNED NOT NULL,
  `numero_mesa` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id_mesa`, `numero_mesa`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platillos`
--

CREATE TABLE `platillos` (
  `id_platillo` int(10) UNSIGNED NOT NULL,
  `nombre_platillo` varchar(50) NOT NULL,
  `precio` double(6,2) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 es activo 0 es inactivo',
  `id_receta` int(10) UNSIGNED DEFAULT NULL,
  `id_categoria` int(10) UNSIGNED DEFAULT NULL,
  `imagen` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(10, 'Refresco de naranja', 1.25, 1, 1, 1, '5d2e4d3961646.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_pedido`
--

CREATE TABLE `pre_pedido` (
  `id_prepedido` int(10) UNSIGNED NOT NULL,
  `id_mesa` int(10) UNSIGNED NOT NULL,
  `id_platillo` int(10) UNSIGNED NOT NULL,
  `cantidad` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta`
--

CREATE TABLE `receta` (
  `id_receta` int(10) UNSIGNED NOT NULL,
  `nombre_receta` varchar(1000) NOT NULL,
  `tiempo` varchar(11) NOT NULL,
  `elaboracion` varchar(350) NOT NULL,
  `id_categoria` int(10) UNSIGNED DEFAULT NULL,
  `idMateria` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `receta`
--

INSERT INTO `receta` (`id_receta`, `nombre_receta`, `tiempo`, `elaboracion`, `id_categoria`, `idMateria`) VALUES
(1, 'test', 'test', 'test', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE `tipousuario` (
  `id_Tipousuario` int(10) UNSIGNED NOT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `descripcion` varchar(1000) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 es activo 0 es inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`id_Tipousuario`, `tipo`, `descripcion`, `estado`) VALUES
(1, 'admin', 'test', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidadmedida`
--

CREATE TABLE `unidadmedida` (
  `id_Medida` int(10) UNSIGNED NOT NULL,
  `nombre_medida` varchar(40) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `usuarios` (
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `alias` varchar(50) NOT NULL,
  `clave_usuario` varchar(60) NOT NULL,
  `foto_usuario` varchar(50) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado_usuario` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 es activo 0 es inactivo',
  `id_Tipousuario` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `alias`, `clave_usuario`, `foto_usuario`, `fecha_creacion`, `estado_usuario`, `id_Tipousuario`) VALUES
(1, 'Gerardo', '$2y$10$rtwGWAepKVUdC/HKCg0y5eAER0/8KjRCidjl.L.u7rRpSHAuQ3JdC', '5d2c9630ac4f2.jpeg', '2019-07-15 15:05:20', 1, 1);

--
-- Índices para tablas volcadas
--

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
  ADD PRIMARY KEY (`id_Cargo`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD PRIMARY KEY (`id_detallefac`),
  ADD KEY `id_platillo` (`id_platillo`);

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
-- Indices de la tabla `encabezadofactura`
--
ALTER TABLE `encabezadofactura`
  ADD PRIMARY KEY (`id_EncabezadoFac`),
  ADD KEY `id_empleado` (`id_empleado`);

--
-- Indices de la tabla `materiasprimas`
--
ALTER TABLE `materiasprimas`
  ADD PRIMARY KEY (`idMateria`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_Medida` (`id_Medida`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id_mesa`),
  ADD UNIQUE KEY `numero_mesa` (`numero_mesa`);

--
-- Indices de la tabla `platillos`
--
ALTER TABLE `platillos`
  ADD PRIMARY KEY (`id_platillo`),
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
-- Indices de la tabla `receta`
--
ALTER TABLE `receta`
  ADD PRIMARY KEY (`id_receta`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `idMateria` (`idMateria`);

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
  ADD KEY `id_Tipousuario` (`id_Tipousuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

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
  MODIFY `id_categoria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  MODIFY `id_detallefac` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `encabezadofactura`
--
ALTER TABLE `encabezadofactura`
  MODIFY `id_EncabezadoFac` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materiasprimas`
--
ALTER TABLE `materiasprimas`
  MODIFY `idMateria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id_mesa` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `platillos`
--
ALTER TABLE `platillos`
  MODIFY `id_platillo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `pre_pedido`
--
ALTER TABLE `pre_pedido`
  MODIFY `id_prepedido` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `receta`
--
ALTER TABLE `receta`
  MODIFY `id_receta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `id_Tipousuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `unidadmedida`
--
ALTER TABLE `unidadmedida`
  MODIFY `id_Medida` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bitacoras`
--
ALTER TABLE `bitacoras`
  ADD CONSTRAINT `bitacoras_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD CONSTRAINT `detallefactura_ibfk_1` FOREIGN KEY (`id_platillo`) REFERENCES `platillos` (`id_platillo`);

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
-- Filtros para la tabla `receta`
--
ALTER TABLE `receta`
  ADD CONSTRAINT `receta_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `receta_ibfk_2` FOREIGN KEY (`idMateria`) REFERENCES `materiasprimas` (`idMateria`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_Tipousuario`) REFERENCES `tipousuario` (`id_Tipousuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

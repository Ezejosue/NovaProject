-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-09-2019 a las 04:56:31
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
-- Estructura de tabla para la tabla `acciones`
--

CREATE TABLE `acciones` (
  `id_accion` int(10) UNSIGNED NOT NULL,
  `id_vista` int(10) UNSIGNED NOT NULL,
  `id_Tipousuario` int(10) UNSIGNED NOT NULL,
  `estado` tinyint(2) NOT NULL
) ENGINE=InnoDB;

--
-- Volcado de datos para la tabla `acciones`
--

INSERT INTO `acciones` (`id_accion`, `id_vista`, `id_Tipousuario`, `estado`) VALUES
(6, 1, 1, 1),
(7, 2, 1, 1),
(8, 3, 1, 1),
(9, 4, 1, 1),
(11, 5, 1, 1),
(12, 6, 1, 1),
(13, 7, 1, 1),
(14, 8, 1, 1),
(15, 9, 1, 1),
(16, 10, 1, 1),
(17, 11, 1, 1),
(18, 12, 1, 1),
(19, 13, 1, 1),
(20, 14, 1, 1),
(21, 15, 1, 1);

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
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id_Cargo` int(10) UNSIGNED NOT NULL,
  `nombre_Cargo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB;

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
) ENGINE=InnoDB;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `descripcion`, `foto_categoria`, `estado`) VALUES
(4, 'Pizzas', 'Son muy sabrosas', '5d50d81857bf0.jpg', 1),
(5, 'Bebidas', 'Son muy sabrosas', '5d50d850be375.jpg', 1),
(6, 'Postres', 'Son muy sobrosos', '5d50d88c03796.jpg', 1),
(7, 'Ensaladas', 'Son muy sabrosas', '5d50d8ced9bd1.jpeg', 1),
(8, 'Pastas', 'Son muy ricas', '5d50d8fedfbbb.jpg', 1),
(9, 'Entradas', 'De todo tipo', '5d523942b1c72.jpg', 1);

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
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id_detalle` int(10) UNSIGNED NOT NULL,
  `id_pedido` int(11) UNSIGNED NOT NULL,
  `id_platillo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`id_detalle`, `id_pedido`, `id_platillo`, `cantidad`) VALUES
(45, 129, 17, 1),
(46, 129, 18, 2),
(47, 130, 20, 1),
(48, 130, 15, 1),
(49, 131, 14, 2),
(50, 131, 18, 8),
(51, 131, 19, 2),
(52, 132, 16, 1),
(53, 132, 21, 1),
(54, 132, 15, 1),
(55, 133, 21, 1),
(56, 133, 19, 1),
(57, 134, 18, 1),
(58, 135, 17, 1),
(59, 136, 15, 1),
(60, 137, 14, 1),
(61, 138, 16, 2),
(62, 139, 18, 1),
(63, 140, 22, 1),
(64, 140, 14, 1),
(65, 140, 18, 1),
(66, 141, 22, 1),
(67, 142, 19, 1),
(68, 143, 24, 1),
(69, 143, 15, 2),
(70, 144, 26, 2),
(71, 144, 25, 3),
(72, 145, 14, 1),
(73, 145, 16, 1),
(74, 145, 18, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elaboraciones`
--

CREATE TABLE `elaboraciones` (
  `id_elaboracion` int(11) NOT NULL,
  `id_receta` int(10) UNSIGNED DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `idMateria` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB;

--
-- Volcado de datos para la tabla `elaboraciones`
--

INSERT INTO `elaboraciones` (`id_elaboracion`, `id_receta`, `cantidad`, `idMateria`) VALUES
(1, 1, 1, 13),
(2, 1, 2, 18);

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
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encabezadofactura`
--

CREATE TABLE `encabezadofactura` (
  `id_EncabezadoFac` int(10) UNSIGNED NOT NULL,
  `nombre_cliente` varchar(50) DEFAULT NULL,
  `id_empleado` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB;

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
) ENGINE=InnoDB;

--
-- Volcado de datos para la tabla `materiasprimas`
--

INSERT INTO `materiasprimas` (`idMateria`, `nombre_materia`, `descripcion`, `cantidad`, `foto`, `id_categoria`, `id_Medida`, `estado`) VALUES
(17, 'Harinaaa', 'Bolsas Maseca', 6, NULL, NULL, NULL, 1),
(18, 'Harina', 'test', 2, '5d7679b0e55b8.png', 4, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id_mesa` int(10) UNSIGNED NOT NULL,
  `numero_mesa` int(10) UNSIGNED NOT NULL,
  `estado_mesa` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB;

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
(13, 11, 1),
(14, 10, 1),
(15, 20, 1),
(16, 50, 0),
(17, 12, 1),
(18, 13, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) UNSIGNED NOT NULL,
  `fecha_pedido` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_mesa` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `fecha_pedido`, `id_mesa`, `id_usuario`) VALUES
(129, '2019-08-11 21:36:40', 1, 1),
(130, '2019-08-11 21:37:24', 1, 1),
(131, '2019-08-11 21:37:50', 4, 1),
(132, '2019-08-11 21:38:21', 14, 1),
(133, '2019-08-11 21:39:00', 15, 1),
(134, '2019-08-12 09:14:33', 1, 1),
(135, '2019-08-12 09:16:00', 1, 1),
(136, '2019-08-12 09:18:20', 1, 1),
(137, '2019-08-12 09:20:17', 1, 1),
(138, '2019-08-12 09:21:02', 1, 1),
(139, '2019-08-12 14:39:57', 1, 1),
(140, '2019-08-12 22:18:47', 1, 1),
(141, '2019-08-12 22:24:22', 1, 1),
(142, '2019-08-13 08:23:37', 1, 1),
(143, '2019-08-13 08:31:32', 1, 1),
(144, '2019-05-01 08:46:14', 4, 1),
(145, '2019-05-01 09:02:18', 9, 1);

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
) ENGINE=InnoDB;

--
-- Volcado de datos para la tabla `platillos`
--

INSERT INTO `platillos` (`id_platillo`, `nombre_platillo`, `precio`, `estado`, `id_receta`, `id_categoria`, `imagen`) VALUES
(14, 'Pizza de jamÃ³n grande', 15.01, 1, 4, 4, '5d50dcb597223.jpg'),
(15, 'Jugo de naranja', 2.50, 1, 5, 5, '5d50dcfea056b.jpg'),
(16, 'PorciÃ³n de pastel de chocolate', 3.25, 1, 6, 6, '5d50dd34c6f73.jpg'),
(17, 'Pizza Hawaiana personal', 5.01, 1, 7, 4, '5d50dd64a82ca.jpg'),
(18, 'Coca Cola', 0.99, 1, 8, 5, '5d50dd8d5cbb9.jpg'),
(19, 'Fanta', 0.99, 1, 8, 5, '5d50ddd2d3d98.jpg'),
(20, 'Ensalada Parmesana', 11.99, 1, 9, 7, '5d50de18b390c.jpg'),
(21, 'Pizza de jamÃ³n pequeÃ±a', 4.99, 1, 4, 4, '5d50de666babf.jpg'),
(22, 'Pan con ajo orden de 2', 5.01, 1, 10, 9, '5d5239eba095b.jpg'),
(23, 'Pan con ajo orden de 4', 7.01, 1, 10, 9, '5d523a0aac1ed.jpg'),
(24, 'Pizza Hawaiana grande', 15.01, 1, 7, 4, '5d52c99cc7771.jpg'),
(25, 'Pizza hawaiana mediana', 7.01, 1, 7, 4, '5d52cd00c06e5.jpg'),
(26, 'Pizza de jamÃ³n mediana', 7.01, 1, 4, 4, '5d52cd1a99de0.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_pedido`
--

CREATE TABLE `pre_pedido` (
  `id_prepedido` int(10) UNSIGNED NOT NULL,
  `id_mesa` int(10) UNSIGNED NOT NULL,
  `id_platillo` int(10) UNSIGNED NOT NULL,
  `cantidad` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta`
--

CREATE TABLE `receta` (
  `id_receta` int(10) UNSIGNED NOT NULL,
  `nombre_receta` varchar(1000) NOT NULL,
  `tiempo` varchar(11) NOT NULL
) ENGINE=InnoDB;

--
-- Volcado de datos para la tabla `receta`
--

INSERT INTO `receta` (`id_receta`, `nombre_receta`, `tiempo`) VALUES
(1, 'Receta 1', '15 min');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id_tarea` int(10) UNSIGNED NOT NULL,
  `mensaje` varchar(80) NOT NULL,
  `importancia` varchar(50) NOT NULL
) ENGINE=InnoDB;

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
  `tipo` varchar(20) DEFAULT NULL,
  `descripcion` varchar(1000) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 es activo 0 es inactivo'
) ENGINE=InnoDB;

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
) ENGINE=InnoDB;

--
-- Volcado de datos para la tabla `unidadmedida`
--

INSERT INTO `unidadmedida` (`id_Medida`, `nombre_medida`, `descripcion`) VALUES
(4, 'Kilogramo', 'Kg'),
(5, 'Gramo', 'g'),
(6, 'Litros', 'lt'),
(7, 'Onzas', 'oz'),
(8, 'Mililitro', 'ml');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `alias` varchar(50) NOT NULL,
  `correo_usuario` varchar(100) NOT NULL,
  `clave_usuario` varchar(60) NOT NULL,
  `foto_usuario` varchar(50) DEFAULT NULL,
  `token_usuario` varchar(100) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `intentos` int(11) DEFAULT NULL,
  `logueado` tinyint(4) NOT NULL DEFAULT '0',
  `estado_usuario` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 es activo 0 es inactivo',
  `id_Tipousuario` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `alias`, `correo_usuario`, `clave_usuario`, `foto_usuario`, `token_usuario`, `fecha_creacion`, `intentos`, `logueado`, `estado_usuario`, `id_Tipousuario`) VALUES
(1, 'Gerardo', 'gerardogo145@gmail.com', '$2y$10$CWVD8KEMCrdGzBHbmltkt.MYlxgDylIXU9k/gxBTLQlr6MlzspP5G', '5d77cf476b7b9.jpg', NULL, '2019-09-10 16:28:55', 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vistas`
--

CREATE TABLE `vistas` (
  `id_vista` int(10) UNSIGNED NOT NULL,
  `nombre_vista` varchar(100) NOT NULL,
  `ruta` varchar(100) NOT NULL,
  `icono` varchar(100) NOT NULL
) ENGINE=InnoDB;

--
-- Volcado de datos para la tabla `vistas`
--

INSERT INTO `vistas` (`id_vista`, `nombre_vista`, `ruta`, `icono`) VALUES
(1, 'Cargo', 'cargo.php', 'address-book'),
(2, 'Categorias', 'categorias.php', 'list'),
(3, 'Desperdicios', 'desperdicios.php', 'trash'),
(4, 'Empleados', 'empleados.php', 'id-card'),
(5, 'Inicio', 'inicio.php', 'tachometer-alt'),
(6, 'Materia Prima', 'materia_prima.php', 'cart-plus'),
(7, 'Mesas', 'mesas.php', 'utensils'),
(8, 'Ordenes', 'ordenes.php', 'list'),
(9, 'Pedidos', 'pedidos.php', 'pizza-slice'),
(10, 'Platillos', 'platillos.php', 'utensils'),
(11, 'Recetas', 'recetas.php', 'book'),
(12, 'Reportes', 'reportes.php', 'chart-bar'),
(13, 'Tipo de Usuario', 'tipo_usuarios.php', 'users'),
(14, 'Unidades de medida', 'unidadmedida.php', 'balance-scale'),
(15, 'Usuarios', 'usuarios.php', 'user-plus');

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
  ADD PRIMARY KEY (`id_Cargo`);

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
  ADD KEY `id_pedido` (`id_pedido`);

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
  ADD PRIMARY KEY (`id_receta`);

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
  MODIFY `id_accion` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
  MODIFY `id_categoria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `desperdicios`
--
ALTER TABLE `desperdicios`
  MODIFY `id_desperdicios` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_detalle` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de la tabla `elaboraciones`
--
ALTER TABLE `elaboraciones`
  MODIFY `id_elaboracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `idMateria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id_mesa` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT de la tabla `platillos`
--
ALTER TABLE `platillos`
  MODIFY `id_platillo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `pre_pedido`
--
ALTER TABLE `pre_pedido`
  MODIFY `id_prepedido` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `receta`
--
ALTER TABLE `receta`
  MODIFY `id_receta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id_tarea` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `id_Tipousuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `unidadmedida`
--
ALTER TABLE `unidadmedida`
  MODIFY `id_Medida` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vistas`
--
ALTER TABLE `vistas`
  MODIFY `id_vista` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`);

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
-- Filtros para la tabla `pre_pedido`
--
ALTER TABLE `pre_pedido`
  ADD CONSTRAINT `pre_pedido_ibfk_1` FOREIGN KEY (`id_mesa`) REFERENCES `mesas` (`id_mesa`),
  ADD CONSTRAINT `pre_pedido_ibfk_2` FOREIGN KEY (`id_platillo`) REFERENCES `platillos` (`id_platillo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

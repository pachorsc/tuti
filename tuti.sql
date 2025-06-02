-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-06-2025 a las 09:48:29
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tuti`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `imagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `imagen`) VALUES
(1, 'Comida', 'images/categorias/comida.jpg'),
(2, 'Estética', 'images/categorias/estética.jpg'),
(3, 'Electrónica', 'images/categorias/electrónica.jpg'),
(4, 'Zapatería', 'images/categorias/zapatería.jpg'),
(5, 'Cerrajería', 'images/categorias/cerrajería.jpg'),
(6, 'Farmacia', 'images/categorias/farmacia.jpg'),
(7, 'Ropa', 'images/categorias/ropa.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprador`
--

CREATE TABLE `comprador` (
  `id` int(11) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comprador`
--

INSERT INTO `comprador` (`id`, `telefono`, `tipo`) VALUES
(1, '1234', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dueno`
--

CREATE TABLE `dueno` (
  `id` int(11) NOT NULL,
  `tienda` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dueno`
--

INSERT INTO `dueno` (`id`, `tienda`) VALUES
(4, NULL),
(5, NULL),
(3, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elemento`
--

CREATE TABLE `elemento` (
  `id` int(11) NOT NULL,
  `tienda` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `precio_descuento` decimal(10,2) DEFAULT NULL,
  `imagen` text NOT NULL,
  `calificacion` decimal(3,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `elemento`
--

INSERT INTO `elemento` (`id`, `tienda`, `nombre`, `descripcion`, `precio`, `precio_descuento`, `imagen`, `calificacion`) VALUES
(13, 5, 'producto_1', 'es pateria en estado puro', 40.55, NULL, 'images/tiendas/Frutería_Rosi_3/productos/producto_producto_1.jpg', NULL),
(14, 5, 'Servicio_2', 'Descripcion 2', 10.22, NULL, 'images/tiendas/Frutería_Rosi_3/servicios/servicio_Servicio_2.jpeg', NULL),
(15, 5, 'Servicio_3', 'Descripcion 2', 10.22, NULL, 'images/tiendas/Frutería_Rosi_3/servicios/servicio_Servicio_3.gif', NULL),
(16, 5, 'producto_1', 'es pateria en estado puro', 40.55, NULL, 'images/tiendas/Frutería_Rosi_3/productos/producto_producto_1.jpg', NULL),
(17, 5, 'producto_2', 'es pateria en estado puro', 40.55, NULL, 'images/tiendas/Frutería_Rosi_3/productos/producto_producto_2.jpg', NULL),
(18, 5, 'producto_3', 'es pateria en estado puro', 40.55, NULL, 'images/tiendas/Frutería_Rosi_3/productos/producto_producto_3.jpg', NULL),
(19, 5, 'producto_4', 'es pateria en estado puro', 40.55, NULL, 'images/tiendas/Frutería_Rosi_3/productos/producto_producto_4.jpg', NULL),
(20, 5, 'producto_5', 'es pateria en estado puro', 40.55, NULL, 'images/tiendas/Frutería_Rosi_3/productos/producto_producto_5.jpg', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id` int(11) NOT NULL,
  `elementos` varchar(200) NOT NULL,
  `usuario` int(11) NOT NULL,
  `fecha_pedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `precio_total` decimal(10,2) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `tienda` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `contenido` text NOT NULL,
  `imagen` text DEFAULT NULL,
  `fecha_creacion` date NOT NULL DEFAULT current_timestamp(),
  `tipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`id`, `tienda`, `titulo`, `contenido`, `imagen`, `fecha_creacion`, `tipo`) VALUES
(7, 5, 'Titulo;;;Subtitulo', 'Parrafo', 'images/tiendas/Frutería_Rosi_3/post_0/f0.jpg', '2025-05-27', NULL),
(8, 5, 'Titulo 1;;;Subtitulo 1;;;titulo 2', 'parrafo 1;;;PArrafooooo 2', 'images/tiendas/Frutería_Rosi_3/post_1/f0.jpeg***images/tiendas/Frutería_Rosi_3/post_1/f_2.jpeg;;;images/tiendas/Frutería_Rosi_3/post_1/f1.jpeg', '2025-05-27', NULL),
(9, 5, 'Titulo 1;;;Subtitulo 1;;;titulo 2', 'parrafo1;;;Parrafo 2', 'images/tiendas/Frutería_Rosi_3/post_2/f0.jpeg', '2025-05-27', NULL),
(10, 5, 'Titulo 1;;;Subtitulo 1;;;titulo 2;;;t3', 'PArrafo 1;;;Parrafo 2;;;PArrafo 3', 'images/tiendas/Frutería_Rosi_3/post_3/f0.jpeg;;;images/tiendas/Frutería_Rosi_3/post_3/f1.jpeg', '2025-05-27', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `cantidad`, `color`) VALUES
(13, 10, NULL),
(16, 10, NULL),
(17, 10, NULL),
(18, 10, NULL),
(19, 10, NULL),
(20, 10, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resena`
--

CREATE TABLE `resena` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `elemento` int(11) NOT NULL,
  `titulo` varchar(20) DEFAULT NULL,
  `resena` text DEFAULT NULL,
  `puntuacion` decimal(2,1) NOT NULL CHECK (`puntuacion` between 0 and 5),
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `servicio` int(11) NOT NULL,
  `fecha_reserva` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_hora_servicio` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id` int(11) NOT NULL,
  `horario_disp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id`, `horario_disp`) VALUES
(14, '10:00 - 20:00 L, M, M, J, V, S'),
(15, '10:00 - 20:00 L, M, M, J, V, S');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienda`
--

CREATE TABLE `tienda` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `coordenada` text NOT NULL,
  `horario` varchar(100) NOT NULL,
  `tipo` int(11) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `calificacion` decimal(3,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tienda`
--

INSERT INTO `tienda` (`id`, `nombre`, `direccion`, `coordenada`, `horario`, `tipo`, `imagen`, `calificacion`) VALUES
(5, 'Frutería Rosi', 'Camino de Ronda, 120, 18003 Granada', '-3.6126021;37.1812067', '10:00 - 20:00 L, M, M, J, V, S', 1, 'images/tiendas/Fruteria_Rosi_3/principal.jpg', 0.0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `contrasena` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `fecha_creacion`, `nombre`, `correo`, `apellido`, `contrasena`) VALUES
(1, '2025-05-20 06:07:50', 'Juan', 'prueba1@gmail.com', 'Rodríguez', '$2y$12$4Oo9PLFOj99jQCf9rRw9Y.gilQ6/86.bleGw4MphmFaMw.DNphEaa'),
(2, '2025-05-20 08:26:15', 'admin', 'admin@admin.com', 'admin', '$2y$12$4Oo9PLFOj99jQCf9rRw9Y.gilQ6/86.bleGw4MphmFaMw.DNphEaa'),
(3, '2025-05-20 06:27:23', 'Vendedor cambio', 'vendedor1@gmail.com', 'dos', '$2y$12$/yoNqcIia8dDvqel/bidhu1ZJWq/BlmW6SvQyVmqw9uul/LRPzSha'),
(4, '2025-05-20 06:34:23', 'Vendedor 2', 'vendedor2@gmail.com', 'dos', '$2y$12$4HuFtIrg8MFEhQgi6JGZgu7KuEeYluANr30wFcX4jGgv9b2AfHGMK'),
(5, '2025-05-20 06:44:41', 'Vendedor 3', 'vendedor3@gmail.com', 'tres', '$2y$12$NrEONAFmaGut0MLd3O5GLesCUECiVpbv5p9Nt9tOehjG7aLnxKXMS');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comprador`
--
ALTER TABLE `comprador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dueno`
--
ALTER TABLE `dueno`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tienda` (`tienda`);

--
-- Indices de la tabla `elemento`
--
ALTER TABLE `elemento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `elemento_servicio_FK` (`tienda`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tienda` (`tienda`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `resena`
--
ALTER TABLE `resena`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `elemento` (`elemento`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `servicio` (`servicio`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tienda`
--
ALTER TABLE `tienda`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `elemento`
--
ALTER TABLE `elemento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `resena`
--
ALTER TABLE `resena`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tienda`
--
ALTER TABLE `tienda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comprador`
--
ALTER TABLE `comprador`
  ADD CONSTRAINT `comprador_ibfk_1` FOREIGN KEY (`id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `dueno`
--
ALTER TABLE `dueno`
  ADD CONSTRAINT `dueno_ibfk_1` FOREIGN KEY (`id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dueno_ibfk_2` FOREIGN KEY (`tienda`) REFERENCES `tienda` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `elemento`
--
ALTER TABLE `elemento`
  ADD CONSTRAINT `elemento_servicio_FK` FOREIGN KEY (`tienda`) REFERENCES `tienda` (`id`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `comprador` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`tienda`) REFERENCES `tienda` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id`) REFERENCES `elemento` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `resena`
--
ALTER TABLE `resena`
  ADD CONSTRAINT `resena_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `comprador` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resena_ibfk_2` FOREIGN KEY (`elemento`) REFERENCES `elemento` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `comprador` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`servicio`) REFERENCES `servicio` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `servicio_ibfk_1` FOREIGN KEY (`id`) REFERENCES `elemento` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

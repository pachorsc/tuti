-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 09-06-2025 a las 10:00:54
-- Versión del servidor: 10.11.10-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u851763782_tuti`
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
  `telefono` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comprador`
--

INSERT INTO `comprador` (`id`, `telefono`) VALUES
(1, '1234'),
(10, '123578827');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuento`
--

CREATE TABLE `descuento` (
  `codigo` varchar(12) NOT NULL,
  `descuento` int(2) NOT NULL,
  `fecha_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `descuento`
--

INSERT INTO `descuento` (`codigo`, `descuento`, `fecha_fin`) VALUES
('NAVIDAD20', 20, '2025-12-31'),
('TUTI10', 10, '2025-06-30');

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
(3, 5),
(4, 6),
(5, 7),
(6, 8),
(7, 9);

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
  `imagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `elemento`
--

INSERT INTO `elemento` (`id`, `tienda`, `nombre`, `descripcion`, `precio`, `precio_descuento`, `imagen`) VALUES
(13, 5, 'Manzana Kg', 'Manzana del Cairo', 2.00, NULL, 'images/tiendas/Frutería_Rosi_3/productos/elemento_Manzana_Kg.jpg'),
(14, 5, 'Creación de cestas de regalo', 'Creamos cestas de regalo para cualquier evento', 15.00, 10.00, 'images/tiendas/Frutería_Rosi_3/servicios/elemento_Creación_de_cestas_de_regalo.png'),
(15, 5, 'Asesoramiento nutricional', 'Un servicio donde los clientes reciben recomendaciones sobre frutas según sus necesidades de salud y alimentación.', 15.00, NULL, 'images/tiendas/Frutería_Rosi_3/servicios/elemento_Asesoramiento_nutricional.jpg'),
(21, 6, 'Abrir_cerraduras', 'se abren cerraduras siempre que se vea que es tu casa', 60.00, NULL, 'images/tiendas/CerrajeríaToni_4/servicios/servicio_Abrir_cerraduras.jpg'),
(22, 6, 'llave_maestra', 'llave que abre casi todas las cerraduras de nivel 1', 25.00, 23.00, 'images/tiendas/CerrajeríaToni_4/productos/producto_llave_maestra.jpg'),
(23, 6, 'Duplicado_de_llaves', 'duplicamos llaves de hasta nivel 2', 12.00, NULL, 'images/tiendas/CerrajeríaToni_4/servicios/servicio_Duplicado_de_llaves.jpg'),
(24, 6, 'llavero_con_GPS', 'llavero con GPS rastreable desde móvil', 25.00, 20.00, 'images/tiendas/CerrajeríaToni_4/productos/producto_llavero_con_GPS.jpg'),
(25, 6, 'Candados_de_clave', 'candados con clave de 4 digitos', 12.00, NULL, 'images/tiendas/CerrajeríaToni_4/productos/producto_Candados_de_clave.jpg'),
(26, 6, 'Romper_cadenas_por_perdida_de_llave', 'Se rompen cadenas por perdida de llave', 40.00, NULL, 'images/tiendas/CerrajeríaToni_4/servicios/servicio_Romper_cadenas_por_perdida_de_llave.jpg'),
(27, 7, 'Corte_de_pelo_Hombre', 'Corte de pelo Hombre con lavado y peinado', 13.00, 9.00, 'images/tiendas/Peluquería_y_estética_Paqui_5/servicios/servicio_Corte_de_pelo_Hombre.jpg'),
(28, 7, 'Shampoo_anti-caida', 'Mejor shampoo anti-caida del mercado con miel', 11.56, 10.00, 'images/tiendas/Peluquería_y_estética_Paqui_5/productos/producto_Shampoo_anti-caida.jpg'),
(29, 7, 'Corte_pelo_mujer', 'Corte de pelo para mujer con masaje capilar y peinado', 15.00, NULL, 'images/tiendas/Peluquería_y_estética_Paqui_5/servicios/servicio_Corte_pelo_mujer.jpg'),
(30, 7, 'Aceite_para_pelo', 'Aceite para reforzar el pelo y hacerlo mas brillante', 8.00, 7.00, 'images/tiendas/Peluquería_y_estética_Paqui_5/productos/producto_Aceite_para_pelo.jpg'),
(31, 8, 'Generados_Gasolina', 'Generador de energía que funciona con gasolina', 60.00, 55.00, 'images/tiendas/Casa_de_la_electrónica_6/productos/producto_Generados_Gasolina.jpg'),
(32, 8, 'Reparación_de_teléfonos', 'Reparamos todo tipo de teléfonos', 50.00, 45.00, 'images/tiendas/Casa_de_la_electrónica_6/servicios/servicio_Reparación_de_teléfonos.jpg'),
(33, 8, 'Torre_PC', 'Dell OptiPlex 7040 MT Core i5 3.2 GHz - SSD 128 GB RAM 16 GB', 199.00, 170.00, 'images/tiendas/Casa_de_la_electrónica_6/productos/producto_Torre_PC.jpg'),
(34, 8, 'Reparación_de_lavadoras', 'Reparamos todo tipo de lavadoras', 50.00, NULL, 'images/tiendas/Casa_de_la_electrónica_6/servicios/servicio_Reparación_de_lavadoras.jpg'),
(35, 9, 'productos_para_dormir', 'Asesoria para productos para dormir', 8.00, NULL, 'images/tiendas/Farmacia_del_carmen_7/servicios/servicio_productos_para_dormir.jpg'),
(36, 9, 'Adelgazante', 'Adelgazin es un producto que absorbe la grasa abdominal', 15.00, NULL, 'images/tiendas/Farmacia_del_carmen_7/productos/producto_Adelgazante.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id` int(11) NOT NULL,
  `tienda` int(11) NOT NULL,
  `elementos` varchar(200) NOT NULL,
  `usuario` int(11) NOT NULL,
  `fecha_pedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `precio_total` decimal(10,2) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id`, `tienda`, `elementos`, `usuario`, `fecha_pedido`, `precio_total`, `estado`) VALUES
(12, 6, '24:1;22:1;25:1;', 1, '2025-06-06 10:56:04', 55.00, 1),
(13, 7, '30:1;', 1, '2025-06-06 10:56:04', 7.00, 1),
(14, 5, '13:1;', 1, '2025-06-09 01:40:56', 2.00, 0),
(15, 6, '22:2;24:10;', 1, '2025-06-09 01:40:56', 246.00, 0),
(16, 9, '36:5;', 1, '2025-06-09 08:48:45', 75.00, 0);

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
  `fecha_creacion` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`id`, `tienda`, `titulo`, `contenido`, `imagen`, `fecha_creacion`) VALUES
(11, 6, 'Protege tu bici;;;La importancia de un buen candado en Granada', 'Granada es una ciudad vibrante y llena de vida, ideal para moverse en bicicleta. Sin embargo, los constantes robos han convertido la seguridad en una prioridad para quienes dependen de sus bicis para desplazarse.\r\n\r\nPara evitar sorpresas desagradables, elegir un buen candado es esencial. No todos los candados ofrecen la misma protección: los modelos más frágiles pueden ser fácilmente cortados con herramientas comunes, dejando tu bicicleta vulnerable.\r\n\r\n¿Cómo elegir el mejor candado?\r\nMaterial resistente: Opta por acero reforzado o cerraduras con certificación de seguridad.\r\n\r\nTipo de cierre: Los candados en forma de “U” suelen ser más seguros que los de cable.\r\n\r\nUbicación: Asegura tu bici a estructuras fijas y evita lugares aislados.\r\n\r\nInvertir en un candado de calidad no es un gasto innecesario, sino una inversión para evitar la pérdida de tu bicicleta y la frustración de tener que reemplazarla. Cuida tu bici, protege tu movilidad y evita ser víctima de los robos en Granada.', 'images/tiendas/CerrajeríaToni_4/post_0/f0.jpg', '2025-06-02'),
(12, 6, 'Guía para comprar la mejor puerta para tu hogar;;;Una puerta no es solo una entrada, es la primera línea de defensa de tu hogar y un elemento clave en la estética de tu espacio. Elegir la puerta adecuada requiere considerar seguridad, materiales y diseño.', '¿Qué debes tener en cuenta al comprar una puerta?\r\n🔹 Material:\r\n\r\nMadera maciza: Elegante y resistente, ideal para interiores.\r\n\r\nAcero: Máxima seguridad para puertas exteriores.\r\n\r\nPVC o aluminio: Duraderos y fáciles de mantener.\r\n\r\n🔹 Seguridad:\r\n\r\nBusca puertas con cerraduras multipunto para mayor protección.\r\n\r\nSi es exterior, asegúrate de que tenga resistencia contra impactos.\r\n\r\n🔹 Aislamiento:\r\n\r\nUna buena puerta ayuda a mantener la temperatura de tu hogar y reducir el ruido exterior.\r\n\r\n🔹 Diseño:\r\n\r\nQue combine con el estilo de tu casa y refleje tu personalidad.\r\n\r\nInvertir en una puerta de calidad es mejorar la seguridad y comodidad de tu hogar. Antes de comprar, compara opciones y elige la que mejor se adapte a tus necesidades.', 'images/tiendas/CerrajeríaToni_4/post_1/f0.jpg', '2025-06-02'),
(13, 5, '🌿 Frescura natural en cada bocado 🍎 Tu frutería de confianza, directo a tu hogar;;;Disfruta de frutas frescas sin salir de casa con nuestro servicio de entrega a domicilio. Elige entre una amplia variedad de opciones y recibe la mejor calidad sin complicaciones.', 'Disfruta del sabor auténtico de las frutas más frescas con nuestro servicio de entrega a domicilio. Olvídate de las prisas y las largas filas, nosotros llevamos hasta tu puerta la mejor selección de frutas de temporada, garantizando calidad y frescura en cada pedido.\r\n\r\n🎁 ¿Quieres sorprender a alguien especial? Nuestras cestas personalizadas son el regalo perfecto. Puedes elegir entre una gran variedad de frutas y nosotros nos encargamos de crear una presentación única y deliciosa. Perfecto para cumpleaños, aniversarios o simplemente para compartir salud.\r\n\r\n🥑 Además, cuidamos tu bienestar con nuestro servicio de asesoramiento nutricional. Si tienes dudas sobre qué frutas son mejores para tu dieta, nuestro equipo te guiará para que tomes la mejor decisión según tus necesidades. Comer bien nunca ha sido tan fácil.\r\n\r\n📍 Ven a visitarnos en nuestra tienda o haz tu pedido en línea. ¡Déjate llevar por el auténtico sabor de la naturaleza y disfruta de la frescura que mereces! 🍊🍏', 'images/tiendas/Frutería_Rosi_3/post_4/f0.jpg***images/tiendas/Frutería_Rosi_3/post_4/f_2.jpg', '2025-06-03'),
(15, 5, 'Alimentos para un sueño reparador: qué comer para dormir mejor;;;Dormir bien es esencial para nuestra salud y bienestar, pero muchas veces no le damos la importancia que merece. ¿Sabías que lo que comes puede influir directamente en la calidad de tu sueño? En este artículo, exploraremos los mejores alimentos para mejorar el descanso y algunos hábitos que pueden ayudarte a dormir mejor.;;;1. Alimentos ricos en triptófano;;;2. Infusiones relajantes;;;3. Evita estimulantes antes de dormir', ';;;El triptófano es un aminoácido esencial que ayuda a la producción de serotonina y melatonina, dos neurotransmisores clave para regular el sueño. Algunos alimentos ricos en triptófano incluyen:\r\n\r\nPlátanos: además de triptófano, contienen magnesio y potasio, que relajan los músculos.\r\n\r\nAvena: una excelente fuente de carbohidratos saludables que favorecen la producción de serotonina.\r\n\r\nFrutos secos: almendras y nueces contienen triptófano y magnesio, ideales para relajarse antes de dormir.;;;Las bebidas calientes pueden ayudar a calmar el sistema nervioso y preparar el cuerpo para el descanso. Algunas opciones recomendadas son:\r\n\r\nTé de manzanilla: conocido por sus propiedades relajantes y su capacidad para reducir el estrés.\r\n\r\nTé de valeriana: ayuda a combatir el insomnio y mejora la calidad del sueño.\r\n\r\nLeche tibia: contiene triptófano y puede ser una opción reconfortante antes de acostarse.;;;Así como hay alimentos que favorecen el sueño, hay otros que pueden dificultarlo. Evita consumir:\r\n\r\nCafeína: presente en el café, té negro y bebidas energéticas.\r\n\r\nAzúcar refinada: puede provocar picos de energía y dificultar el descanso.\r\n\r\nComidas pesadas: los alimentos grasos o muy condimentados pueden causar digestiones lentas y malestar nocturno.', 'images/tiendas/Frutería_Rosi_3/post_1/f0.jpg;;;images/tiendas/Frutería_Rosi_3/post_1/f1.jpg', '2025-06-08');

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
(13, 20, 'rojo'),
(22, 20, NULL),
(24, 10, NULL),
(25, 10, NULL),
(28, 10, NULL),
(30, 5, NULL),
(31, 2, NULL),
(33, 1, NULL),
(36, 5, NULL);

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
(15, '10:00 - 20:00 L, M, M, J, V, S'),
(21, '24 horas'),
(23, '10:00 - 20:00 L, M, M, J, V,'),
(26, '10:00 - 20:00 L, M, M, J, V,'),
(27, '10:00 - 14:00 / 16:00 - 20:00 L, M, M, J, V,'),
(29, '10:00 - 14:00 / 16:00 - 20:00 L, M, M, J, V,'),
(32, '10:00 - 20:00 L, M, M, J, V,'),
(34, '10:00 - 20:00 L, M, M, J, V,'),
(35, '10:00 - 14:00 / 16:00 - 20:00 L, M, M, J, V,');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienda`
--

CREATE TABLE `tienda` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `coordenada` text NOT NULL,
  `horario` varchar(100) NOT NULL,
  `tipo` int(11) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tienda`
--

INSERT INTO `tienda` (`id`, `nombre`, `direccion`, `telefono`, `coordenada`, `horario`, `tipo`, `imagen`) VALUES
(5, 'Frutería Rosi', 'Camino de Ronda, 120, 18003 Granada', '12345679', '-3.6126021;37.1812067', '10:00 - 20:00 L, M, M, J, V, S', 1, 'images/tiendas/Frutería_Rosi_3/principal.jpg'),
(6, 'CerrajeríaToni', 'C. los Juncos, s/n, Granada', '87654321', '-3.6524309;37.2446527', '10:00 - 20:00 L, M, M, J, V, S', 5, 'images/tiendas/CerrajeríaToni_4/principal.jpg'),
(7, 'Peluquería y estética Paqui', 'C. Emilia Pardo Bazán, 8, Beiro, Granada', '+34 12345678', '-3.6060954;37.2003356', '10:00 - 14:00 / 16:00 - 20:00 L, M, M, J, V,', 2, 'images/tiendas/Peluquería_y_estética_Paqui_5/principal.jpg'),
(8, 'Casa de la electrónica', 'Calle Alhamar, 6, 18005, Granada', '+55 81726354', '-3.6001781;37.1691122', '10:00 - 20:00 L, M, M, J, V, S', 3, 'images/tiendas/Casa_de_la_electrónica_6/principal.jpg'),
(9, 'Farmacia del carmen', 'C/ Gran Vía de Colón, 15, 18001, Granada', '+66 777 777 43', '-3.599554;37.1794571', '10:00 - 20:00 L, M, M, J, V, S', 6, 'images/tiendas/Farmacia_del_carmen_7/principal.jpg');

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
(1, '2025-05-20 06:07:50', 'Juan francisco', 'prueba1@gmail.com', 'Rodríguez', '$2y$12$4Oo9PLFOj99jQCf9rRw9Y.gilQ6/86.bleGw4MphmFaMw.DNphEaa'),
(2, '2025-05-20 08:26:15', 'admin', 'admin@admin.com', 'admin', '$2y$12$4Oo9PLFOj99jQCf9rRw9Y.gilQ6/86.bleGw4MphmFaMw.DNphEaa'),
(3, '2025-05-20 06:27:23', 'vendedor', 'vendedor@gmail.com', 'dos', '$2y$12$qlKA.sYC6asZzzSZvGEv6.8SSpgMy.F6PjNmskWps8Q5.mEk.XehS'),
(4, '2025-05-20 06:34:23', 'Toni Cerrajero', 'vendedor2@gmail.com', 'Carril', '$2y$12$4HuFtIrg8MFEhQgi6JGZgu7KuEeYluANr30wFcX4jGgv9b2AfHGMK'),
(5, '2025-05-20 06:44:41', 'Vendedor 3', 'vendedor3@gmail.com', 'tres', '$2y$12$NrEONAFmaGut0MLd3O5GLesCUECiVpbv5p9Nt9tOehjG7aLnxKXMS'),
(6, '2025-06-03 05:21:24', 'Vendedor 4', 'vendedor4@gmail.com', 'cuatro', '$2y$12$7z87BhVtoMqNWEPJQ6.fy.qOtzfrFqips9uuEDcmsc7GPh/83k3X.'),
(7, '2025-06-03 05:21:43', 'Vendedor 5', 'vendedor5@gmail.com', 'cinco', '$2y$12$v./5bSrb5sIbB2glkqbITecV/noPeOKCX/94aj1L4Zu/HKbIXHUta'),
(8, '2025-06-08 18:26:53', 'Roma', 'roxanarianocendales@gmail.com', 'Riaño', '$2y$12$LAwcO8BhxTtXfPwsBM0GnuXmqCmwCiGfvvFKbcLo.flzZe2hJZFmS'),
(9, '2025-06-08 18:28:18', 'Juan', 'jfrodriano@gmail.com', 'Francisco Rodríguez', '$2y$12$01/rWSpgiZzaSEO7Nyp3geAHi.7tjar/ePM6/pCVHPP0ObQ4vDv3q'),
(10, '2025-06-08 18:31:16', 'Jorge', 'fernando@gmail.com', 'Fernández', '$2y$12$9PkTaFWjFGtPWWvtMe3J5.QfH2vQvjk5y1a6PvF/Gb6IW2/uJcWWW');

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
-- Indices de la tabla `descuento`
--
ALTER TABLE `descuento`
  ADD PRIMARY KEY (`codigo`);

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
  ADD KEY `usuario` (`usuario`),
  ADD KEY `tienda_pedido_tienda` (`tienda`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `elemento`
--
ALTER TABLE `elemento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tienda`
--
ALTER TABLE `tienda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `comprador` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tienda_pedido_tienda` FOREIGN KEY (`tienda`) REFERENCES `tienda` (`id`);

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
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `servicio_ibfk_1` FOREIGN KEY (`id`) REFERENCES `elemento` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

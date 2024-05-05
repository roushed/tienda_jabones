-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-05-2024 a las 13:21:03
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jabones_scarlatti`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `ad_email` varchar(40) NOT NULL,
  `ad_password` int(8) NOT NULL,
  `ad_nombre` varchar(40) NOT NULL,
  `ad_direccion` varchar(40) NOT NULL,
  `ad_cp` varchar(8) NOT NULL,
  `ad_telefono` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`ad_email`, `ad_password`, `ad_nombre`, `ad_direccion`, `ad_cp`, `ad_telefono`) VALUES
('admin@domeni.com', 1234, 'Admin', 'Rue del Percebe 13', '5443', '76555444');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cesta`
--

CREATE TABLE `cesta` (
  `ce_id` int(11) NOT NULL,
  `ce_email` varchar(30) NOT NULL,
  `ce_fechacre` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cesta`
--

INSERT INTO `cesta` (`ce_id`, `ce_email`, `ce_fechacre`) VALUES
(57, 'jerel@gmail.com', '2023-02-09'),
(105, 'olga@gmail.com', '2023-02-11'),
(113, 'juanete@gmail.com', '2024-01-20'),
(128, 'amanda@domeni.com', '2024-05-05'),
(129, 'ana@domeni.com', '2024-05-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `cli_email` varchar(30) NOT NULL,
  `cli_password` varchar(8) NOT NULL,
  `cli_nombre` varchar(20) NOT NULL,
  `cli_direccion` varchar(50) NOT NULL,
  `cli_cp` varchar(8) NOT NULL,
  `cli_telefono` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`cli_email`, `cli_password`, `cli_nombre`, `cli_direccion`, `cli_cp`, `cli_telefono`) VALUES
('amanda@domeni.com', '1234', 'Amanda', 'Calle los palotes 7', '45444', '654443233'),
('ana@domeni.com', '1234', 'ana', 'calle las campanadas', '777', '6666'),
('andres@gmail.com', '1234', 'Andres', 'fsfsdf', '34323', '4324234'),
('guille@domeni.com', '1234', 'guille', 'calle los palotes', '54321', '654443434'),
('honorio@domeni.com', '1234', 'Honorio', 'fsdfsd', '3234', '975434344'),
('jerel@gmail.com', '1234', 'fsdf', 'fsdf', '4234', '534534'),
('juanete@gmail.com', '1234', 'juan', 'fds', '342', '324324'),
('juanma@gmail.com', '1234', 'Juanma', 'fsdf', '43432', '423423'),
('olga@gmail.com', '1234', 'olga', 'fsd', '323', '33242'),
('penol@gmail.com', '1234', 'penol', 'sdfsdfsd', '5455', '5345345'),
('perico@domeni.com', '1234', 'Perico', 'Gomez', '543', 'w34234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_cesta`
--

CREATE TABLE `item_cesta` (
  `ic_id` int(11) NOT NULL,
  `ic_idcesta` int(11) NOT NULL,
  `ic_idproducto` int(11) NOT NULL,
  `ic_cantidad` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `item_cesta`
--

INSERT INTO `item_cesta` (`ic_id`, `ic_idcesta`, `ic_idproducto`, `ic_cantidad`) VALUES
(329, 128, 43, '1'),
(330, 128, 34, '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_pedido`
--

CREATE TABLE `item_pedido` (
  `ip_id` int(11) NOT NULL,
  `ip_id_ped` int(11) NOT NULL,
  `ip_id_prod` int(11) NOT NULL,
  `ip_unidades` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `item_pedido`
--

INSERT INTO `item_pedido` (`ip_id`, `ip_id_ped`, `ip_id_prod`, `ip_unidades`) VALUES
(244, 134, 34, 1),
(245, 134, 43, 1),
(246, 135, 45, 3),
(247, 135, 43, 3),
(248, 136, 36, 1),
(249, 136, 40, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `pe_id` int(11) NOT NULL,
  `pe_email` varchar(30) NOT NULL,
  `pe_fechped` date NOT NULL,
  `pe_fechent` date NOT NULL,
  `pe_totalped` int(14) NOT NULL,
  `pe_entrega` enum('pendiente','proceso','entregado','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`pe_id`, `pe_email`, `pe_fechped`, `pe_fechent`, `pe_totalped`, `pe_entrega`) VALUES
(17, 'perico@domeni.com', '2023-02-06', '2023-02-13', 54, 'entregado'),
(32, 'guille@domeni.com', '2023-02-07', '2023-02-14', 1281, 'proceso'),
(33, 'guille@domeni.com', '2023-02-07', '2023-02-14', 1485, 'entregado'),
(34, 'guille@domeni.com', '2023-02-07', '2023-02-14', 1164, 'entregado'),
(35, 'guille@domeni.com', '2023-02-07', '2023-02-14', 1392, 'pendiente'),
(36, 'guille@domeni.com', '2023-02-07', '2023-02-14', 2022, 'proceso'),
(88, 'guille@domeni.com', '2023-02-11', '2023-02-18', 475, 'pendiente'),
(89, 'guille@domeni.com', '2023-02-11', '2023-02-18', 73, 'pendiente'),
(90, 'guille@domeni.com', '2023-02-11', '2023-02-18', 475, 'pendiente'),
(92, 'guille@domeni.com', '2023-02-11', '2023-02-18', 475, 'pendiente'),
(93, 'guille@domeni.com', '2023-02-11', '2023-02-18', 475, 'pendiente'),
(94, 'guille@domeni.com', '2023-02-11', '2023-02-18', 666, 'pendiente'),
(95, 'guille@domeni.com', '2023-02-11', '2023-02-18', 475, 'pendiente'),
(96, 'guille@domeni.com', '2023-02-11', '2023-02-18', 43, 'pendiente'),
(97, 'guille@domeni.com', '2023-02-11', '2023-02-18', 432, 'pendiente'),
(98, 'guille@domeni.com', '2023-02-11', '2023-02-18', 43, 'pendiente'),
(99, 'guille@domeni.com', '2023-02-11', '2023-02-18', 73, 'pendiente'),
(100, 'guille@domeni.com', '2023-02-11', '2023-02-18', 475, 'entregado'),
(101, 'guille@domeni.com', '2023-02-11', '2023-02-18', 475, 'entregado'),
(102, 'guille@domeni.com', '2023-02-11', '2023-02-18', 475, 'pendiente'),
(103, 'guille@domeni.com', '2023-02-11', '2023-02-18', 475, 'pendiente'),
(104, 'guille@domeni.com', '2023-02-11', '2023-02-18', 43, 'pendiente'),
(105, 'guille@domeni.com', '2023-02-11', '2023-02-18', 30, 'proceso'),
(106, 'guille@domeni.com', '2023-02-11', '2023-02-18', 475, 'pendiente'),
(107, 'guille@domeni.com', '2023-02-11', '2023-02-18', 43, 'proceso'),
(108, 'guille@domeni.com', '2023-02-11', '2023-02-18', 432, 'proceso'),
(111, 'olga@gmail.com', '2023-02-11', '2023-02-18', 666, 'proceso'),
(112, 'olga@gmail.com', '2023-02-11', '2023-02-18', 43, 'proceso'),
(113, 'olga@gmail.com', '2023-02-11', '2023-02-18', 30, 'proceso'),
(114, 'olga@gmail.com', '2023-02-11', '2023-02-18', 234, 'proceso'),
(115, 'olga@gmail.com', '2023-02-11', '2023-02-18', 475, 'proceso'),
(116, 'perico@domeni.com', '2023-02-11', '2023-02-18', 234, 'entregado'),
(117, 'guille@domeni.com', '2023-02-11', '2023-02-18', 277, 'entregado'),
(118, 'guille@domeni.com', '2023-02-11', '2023-02-18', 475, 'entregado'),
(120, 'guille@domeni.com', '2023-02-11', '2023-02-18', 277, 'proceso'),
(134, 'amanda@domeni.com', '2024-02-01', '2024-02-08', 140, 'pendiente'),
(135, 'amanda@domeni.com', '2024-04-26', '2024-05-03', 285, 'proceso'),
(136, 'amanda@domeni.com', '2024-04-26', '2024-05-03', 215, 'entregado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `pr_id` int(11) NOT NULL,
  `pr_nombre` varchar(20) NOT NULL,
  `pr_descripcion` varchar(60) NOT NULL,
  `pr_peso` varchar(8) NOT NULL,
  `pr_precio` varchar(14) NOT NULL,
  `pr_imagen` varchar(40) NOT NULL,
  `unidades` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`pr_id`, `pr_nombre`, `pr_descripcion`, `pr_peso`, `pr_precio`, `pr_imagen`, `unidades`) VALUES
(34, 'Jabon Exquisito', 'Es un jabon del bueno', '43', '95', 'img/jabon.jpg', 4),
(35, 'Jaboncete', 'fsdf', '34', '34', 'img/jabon2.jpg', 5),
(36, 'Jabon Oscuro', 'fsdfsd', '12', '45', 'img/jabonscuro.jpg', 4),
(40, 'Jabon violeta', 'Un jabon de los buenos', '35', '85', 'img/jabon_violeta.jpg', 1),
(42, 'Jabon Naruto', 'Jabon bueno', '45', '20', 'img/jabonaruto.jpg', 5),
(43, 'Jabon Gato', 'Jabon de gato', '34', '45', 'img/jabongato.jpg', 1),
(44, 'Jabon de Pueblo', 'Jabon de uso rural.', '31', '50', 'img/abonrojo.jpg', 8),
(45, 'Pack 3 Jabones', 'Pack de 3 jabones caseros.', '80', '50', 'img/pack3jamones.jpg', 7),
(46, 'Jabon Lavanda', 'Jabon de lavanda suave para la piel.', '50', '30', 'img/jabonlavanda.jpg', 15),
(47, 'Jabon blanco', 'Jabon blanco ambientador.', '20', '50', 'img/jabonblanco.jpg', 30),
(48, 'Jabon amarillo', 'Jabon amarillo de buena calidad.', '20', '10', 'img/jabonamarillo.jpg', 30),
(49, 'Jabon Cafe', 'Jabon aroma a cafe', '30', '40', 'img/jaboncafe.jpg', 5),
(50, 'Jabon de baño', 'Jabon de ducha.', '50', '30', 'img/jaboness.jpg', 5),
(51, 'Jabon Rosa', 'Jabon muy bueno', '30', '30', 'img/yepes.jpg', 5),
(52, 'Jabon Azul', 'Jabon azul para manos', '30', '10', 'img/jabon_azul.jpg', 5),
(53, 'Jabon Chocolate', 'Jabon olor a chocolate.', '40', '30', 'img/jabon_marron.jpg', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`ad_email`);

--
-- Indices de la tabla `cesta`
--
ALTER TABLE `cesta`
  ADD PRIMARY KEY (`ce_id`),
  ADD KEY `ce_email` (`ce_email`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cli_email`);

--
-- Indices de la tabla `item_cesta`
--
ALTER TABLE `item_cesta`
  ADD PRIMARY KEY (`ic_id`),
  ADD KEY `ic_idcesta` (`ic_idcesta`),
  ADD KEY `ic_idproducto` (`ic_idproducto`);

--
-- Indices de la tabla `item_pedido`
--
ALTER TABLE `item_pedido`
  ADD PRIMARY KEY (`ip_id`),
  ADD KEY `ip_id_ped` (`ip_id_ped`),
  ADD KEY `ip_id_prod` (`ip_id_prod`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`pe_id`),
  ADD KEY `pe_email` (`pe_email`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`pr_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cesta`
--
ALTER TABLE `cesta`
  MODIFY `ce_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT de la tabla `item_cesta`
--
ALTER TABLE `item_cesta`
  MODIFY `ic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=332;

--
-- AUTO_INCREMENT de la tabla `item_pedido`
--
ALTER TABLE `item_pedido`
  MODIFY `ip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `pe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `pr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cesta`
--
ALTER TABLE `cesta`
  ADD CONSTRAINT `ce_email` FOREIGN KEY (`ce_email`) REFERENCES `clientes` (`cli_email`);

--
-- Filtros para la tabla `item_cesta`
--
ALTER TABLE `item_cesta`
  ADD CONSTRAINT `ic_d_producto` FOREIGN KEY (`ic_idproducto`) REFERENCES `productos` (`pr_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ic_id_cesta` FOREIGN KEY (`ic_idcesta`) REFERENCES `cesta` (`ce_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `item_pedido`
--
ALTER TABLE `item_pedido`
  ADD CONSTRAINT `ip_id_pedido` FOREIGN KEY (`ip_id_ped`) REFERENCES `pedidos` (`pe_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ip_id_producto` FOREIGN KEY (`ip_id_prod`) REFERENCES `productos` (`pr_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `cli_email` FOREIGN KEY (`pe_email`) REFERENCES `clientes` (`cli_email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

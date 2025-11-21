-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 21-11-2025 a las 15:33:23
-- Versión del servidor: 5.6.51-cll-lve
-- Versión de PHP: 8.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prodinwe_insumos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id_area` int(11) NOT NULL,
  `nombre_area` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id_area`, `nombre_area`) VALUES
(1, 'ADMINISTRACION'),
(2, 'PRODUCCION'),
(3, 'FINANZAS'),
(4, 'MANTENCION'),
(5, 'CALIDAD'),
(6, 'INFORMATICA'),
(7, 'OPERACIONES'),
(8, 'ASEO'),
(9, 'PLANTA 1'),
(10, 'PLANTA 2'),
(11, 'MATADEROS'),
(12, 'COMEX');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nom_categoria` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nom_categoria`) VALUES
(1, 'Administracion'),
(2, 'Producción'),
(3, 'Finanzas'),
(4, 'Mantención'),
(5, 'Calidad'),
(6, 'Informatica'),
(7, 'Operaciones'),
(8, 'Aseo'),
(9, 'Planta 1'),
(10, 'Planta 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id_detalle` int(11) NOT NULL,
  `numero_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `costo` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ins_insumos`
--

CREATE TABLE `ins_insumos` (
  `id_insumo` int(11) NOT NULL,
  `id_articulo` varchar(21) CHARACTER SET utf8 NOT NULL,
  `in_nombre` varchar(100) CHARACTER SET latin1 NOT NULL,
  `in_unidad` varchar(30) CHARACTER SET utf8 NOT NULL,
  `in_costo` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ins_insumos`
--

INSERT INTO `ins_insumos` (`id_insumo`, `id_articulo`, `in_nombre`, `in_unidad`, `in_costo`) VALUES
(1, '950000071991001', 'Argolla Plástica Azul', '1000/Unidad', 20),
(2, '950000071991002', 'Argolla Plástica Blanca', '1000/Unidad', 20),
(3, '950000071991003', 'Argolla Plástica Café', '1000/Unidad', 20),
(4, '950000071991005', 'Argolla Plástica Naranja', '1000/Unidad', 20),
(5, '950000071991006', 'Argolla Plástica Negra', '1000/Unidad', 20),
(6, '950000071991007', 'Argolla Plastica Rosada', '1000/Unidad', 20),
(7, '950000071991008', 'Argolla Plástica Roja', '1000/Unidad', 20),
(8, '950000071991009', 'Argolla Plástica Verde', '1000/Unidad', 20),
(9, '950000071991020', 'Balde Nuevo 20 L EO', 'Unidad', 417.917),
(10, '950000071991030', 'Cañamo Plastico Amarillo', 'Unidad', 2320),
(11, '950000071991031', 'Cañamo Plastico Azul', 'Unidad', 2320),
(12, '950000071991033', 'Cañamo Plastico Blanco', 'Unidad', 2306),
(13, '950000071991034', 'Cañamo Plastico Café', 'Unidad', 2320),
(14, '950000071991035', 'Cañamo Plastico Lila', 'Unidad', 2306),
(15, '950000071991036', 'Cañamo Plastico Naranjo', 'Unidad', 2306),
(16, '950000071991037', 'Cañamo Plastico Negro', 'Unidad', 2306),
(17, '950000071991038', 'Cañamo Plastico Rojo', 'Unidad', 2320),
(18, '950000071991040', 'Hilo Amarillo', 'Unidad', 5623.99),
(19, '950000071991041', 'Hilo Azul/Blanco', 'Unidad', 2306),
(20, '950000071991042', 'Hilo Azul/Rojo', 'Unidad', 2306),
(21, '950000071991043', 'Hilo Azul', 'Unidad', 5432.94),
(22, '950000071991044', 'Hilo Blanco', 'Unidad', 2306),
(23, '950000071991045', 'Hilo Rojo/Blanco', 'Unidad', 5432.94),
(24, '950000071991046', 'Hilo Rojo', 'Unidad', 2306),
(25, '950000071991047', 'Hilo Verde/Blanco', 'Unidad', 2306),
(26, '950000071991048', 'Hilo Verde', 'Unidad', 2306),
(27, '950000071991049', 'Hilo de Atar', 'Unidad', 9100),
(28, '950000071991050', 'Malla Pavo Azul', 'Unidad', 56.607),
(29, '950000071991051', 'Sello SEM / 333 azul Camion', '50/Paquete', 57),
(30, '950000071991052', 'Sello Sand/50 azul Bidon', '50/Paquete', 47),
(31, '950000071991053', 'Separador Azul', '1500/Paquete', 3),
(32, '950000071991054', 'Separador Blanco', '1500/Paquete', 3),
(33, '950000071991055', 'Separador cafe claro', '1500/Paquete', 3),
(34, '950000071991056', 'Separador celeste', '1500/Paquete', 3),
(35, '950000071991057', 'Separador Lila', '1500/Paquete', 3),
(36, '950000071991058', 'Separador Rojo', '1500/Paquete', 3),
(37, '950000071991059', 'Separador Verde', '1500/Paquete', 3),
(38, '950000071991070', 'Etiqueta Plastica Amarilla', '1000/Paquete', 7),
(39, '950000071991071', 'Etiqueta Plástica Azul', '1000/Paquete', 7),
(40, '950000071991072', 'Etiqueta Plástica Blanca', '1000/Paquete', 7),
(41, '950000071991073', 'Etiqueta Plástica Café', '1000/Paquete', 7),
(42, '950000071991074', 'Etiqueta Plástica Lila', '1000/Paquete', 7),
(43, '950000071991075', 'Etiqueta Plástica Roja', '1000/Paquete', 7),
(44, '950000071991076', 'Etiqueta Plástica Verde', '1000/Paquete', 7),
(45, '950000071991078', 'Argolla Plástica Amarilla', '1000/Paquete', 20),
(46, '950000071991080', 'Film Azul plastico tubbing', '6 Rollo/Caja', 36.2026),
(47, '950000071991081', 'Cañamo Plastico Verde', 'Unidad', 2306),
(48, '950000071991082', 'Malla Pavo Blanca', '2 rollos/Paquete', 56.607),
(49, '950000071992001', 'Bidones', 'Unidad', 20931),
(50, '950000071993001', 'Bolsa Blanca 600x900mm', 'Unidad', 72),
(51, '950000071993002', 'Bolsa Bidon trans1050x2400(120', 'Unidad', 207),
(52, '950000071993003', 'Bolsa Vacío 300x400', 'Unidad', 41),
(53, '950000071993004', 'Bolsa Vacío 370x400', 'Unidad', 41),
(54, '950000071993005', 'Bolsa Vacío 400x700', 'Unidad', 235),
(55, '950000071993006', 'Bolsa Vacío 200x700', 'Unidad', 149),
(56, '950000071993007', 'Bolsa Vacío 300x385', 'Unidad', 153),
(57, '950000071993008', 'Bolsa basura Azul 60x90 (500)', 'Unidad', 72),
(58, '950000071993009', 'Bolsa Basura azul 50x60', 'Unidad', 30),
(59, '950000071993010', 'Lamina Troz Poliet. A/Den,Tran', 'Unidad', 47),
(60, '950000071993011', 'Bolsa uso personal 900x1340', 'Unidad', 77),
(61, '950000071993012', 'Bolsa transp1050x1800 (200)', 'Unidad', 207),
(62, '950000071993013', 'Bolsa Poliet.combo 250x230', 'Unidad', 72),
(63, '950000071993020', 'Cajas de Carton', 'Unidad', 410),
(64, '950000071993030', 'Amarra cable', '100/Paquete', 29),
(65, '950000071993031', 'Film Manual', '6/Caja', 2980),
(66, '950000071993040', 'Cinta Térmica 110x300', 'Unidad', 5620),
(67, '950000071993041', 'Cinta Termica 110x75', 'Unidad', 5460),
(68, '950000071993043', 'Cintas De Embalaje Transparent', 'Unidad', 440),
(69, '950000071993044', 'Etiqueta impresora 100x100', 'Unidad', 11.0481),
(70, '950000071993045', 'Etiqueta impresora 100x150', 'Unidad', 16490),
(71, '950000071993046', 'Cinta Termica 110X450 (450)', 'Unidad', 6230),
(72, '950000071993047', 'Sello amarra madejas rojo', '1000/Paquete', 26.0545),
(73, '950000071993060', 'Pallet', 'Unidad', 4900),
(74, '950000071993061', 'Pallet Frimesa', 'Unidad', 5900),
(75, '950000071993062', 'Pallet 0,80*1,20 Nuevo- Pancre', 'Unidad', 6500),
(76, '950000071993063', 'Etiqueta 100x200', 'Unidad', 20.425),
(77, '950000071993065', 'Pallet 1*1.2Mts Nuevo -Brasil', 'Unidad', 8935),
(78, '950000071993066', 'Pallet 1,20*1*0,15 Nuevo- Ref.', 'Unidad', 10455),
(79, '950000071994002', 'SAL 080 X TONE', 'SACA', 78),
(80, '950000071994003', 'SAL 25K 088', '25/Paquete', 93),
(81, '950000071994004', 'Sal 088 X TONE', 'SACA', 80),
(82, '950000071994101', 'Hielo Escama', '25/Paquete', 51.48),
(83, '950000071995001', 'Acido Acetico', 'Litro', 1440),
(84, '950000071995002', 'Acido Peracetico', 'Litro', 1280),
(85, '950000071995003', 'Clorito de sodio 50 Kls', 'Litro', 2094.08),
(86, '950000071995004', 'Dioxido de Cloro al 5% 20 Lit', 'Litro', 1969),
(87, '950000071995005', 'Metabisulfito De Sodio', 'Saca', 388.926),
(88, '950000071995008', 'Alcohol Gel', 'Litro', 3190),
(89, '950000071995010', 'Espuma Clorada (eclor)  220L', 'Litro', 1428),
(90, '950000071995013', 'Desinfectante (NewQuats) 20L', 'Litro', 2549),
(91, '950000071995014', 'Limpia Vidrios  x 20 Lts', 'Litro', 750),
(92, '950000071995018', 'Multiclean-10', 'Litro', 944),
(93, '950000071995021', 'Candado 25mm-pequeno', 'Unidad', 2146.35),
(94, '950000071995023', 'Desoxidante fuerte- clinic 23L', 'Litro', 1490),
(95, '950000071995031', 'Candado 50mm-Grande', 'Unidad', 5100),
(96, '950000071995033', 'Alcohol al 76%', 'Litro', 4050),
(97, '950000071995034', 'Alcohol al 95% (Uso Bidon)', 'Litro', 1915),
(98, '950000071996001', 'Tenida Verde 42', 'Unidad', 11500),
(99, '950000071996002', 'Tenida Verde 44', 'Unidad', 11000),
(100, '950000071996003', 'Tenida Verde 46', 'Unidad', 11500),
(101, '950000071996004', 'Tenida Verde 48', 'Unidad', 10500),
(102, '950000071996005', 'Tenida Verde 50', 'Unidad', 10500),
(103, '950000071996006', 'Tenida Verde 52', 'Unidad', 10500),
(104, '950000071996007', 'Tenida Verde 54', 'Unidad', 10500),
(105, '950000071996008', 'Tenida Beige 2 Piezas T 40', 'Unidad', 11500),
(106, '950000071996009', 'Tenida Beige 2 Piezas T 42', 'Unidad', 11500),
(107, '950000071996010', 'Tenida Beige 2 Piezas T 44', 'Unidad', 11500),
(108, '950000071996011', 'Tenida Beige 2 Piezas T 46', 'Unidad', 11500),
(109, '950000071996012', 'Tenida Beige 2 Piezas T 48', 'Unidad', 11500),
(110, '950000071996013', 'Tenida Beige 2 Piezas T 52', 'Unidad', 11500),
(111, '950000071996014', 'Tenida Beige 2 Piezas T 54', 'Unidad', 11500),
(112, '950000071996015', 'Tenida Beige 2 Piezas T 56', 'Unidad', 11500),
(113, '950000071996018', 'Overall Desechable Talla L', 'Unidad', 993),
(114, '950000071996019', 'Overall Desechable Talla XL', 'Unidad', 993),
(115, '950000071996020', 'Overall Desechable Talla XXL', 'Unidad', 993),
(116, '950000071996021', 'Overol Piloto Blanco L', 'Unidad', 4800),
(117, '950000071996022', 'Overol Piloto Blanco M', 'Unidad', 4800),
(118, '950000071996023', 'Overol Piloto Blanco XL', 'Unidad', 4800),
(119, '950000071996024', 'Overol Piloto Blanco XXL', 'Unidad', 4496),
(120, '950000071996025', 'Pantalon Blanco S', 'Unidad', 4500),
(121, '950000071996026', 'Polar Verde Talla L', 'Unidad', 7900),
(122, '950000071996027', 'Polar Verde Talla M', 'Unidad', 7900),
(123, '950000071996028', 'Polar Verde Talla S', 'Unidad', 7900),
(125, '950000071996033', 'Pijama Polar Talla L', 'Unidad', 11000),
(126, '950000071996034', 'Pijama Polar Talla XL', 'Unidad', 11000),
(127, '950000071996035', 'Pijama Polar Talla XXL', 'Unidad', 11000),
(128, '950000071996036', 'Bota Bata De Goma Blca. 36', 'Unidad', 8184),
(129, '950000071996037', 'Bota Bata De Goma Blca. 37', 'Unidad', 8184),
(130, '950000071996038', 'Bota Bata De Goma Blca. 38', 'Unidad', 8184),
(131, '950000071996039', 'Bota Bata De Goma Blca. 39', 'Unidad', 8184),
(132, '950000071996040', 'Bota Bata De Goma Blca. 40', 'Unidad', 8184),
(133, '950000071996041', 'Bota Bata De Goma Blca. 41', 'Unidad', 8184),
(134, '950000071996042', 'Bota Bata De Goma Blca. 42', 'Unidad', 8184),
(135, '950000071996043', 'Bota Bata De Goma Blca. 43', 'Unidad', 9300),
(136, '950000071996044', 'Bota Bata De Goma Blca. 44', 'Unidad', 8184),
(137, '950000071996045', 'Bota Bata De Goma Blca. 45', 'Unidad', 9300),
(138, '950000071996046', 'Bota Bata de Goma Negra 38', 'Unidad', 9080),
(139, '950000071996047', 'S- Polera Gris Manga Larga', 'Unidad', 6100),
(140, '950000071996048', 'Polera Blanca con Logo L', 'Unidad', 4500),
(141, '950000071996049', 'Polera Blanca con Logo M', 'Unidad', 4500),
(142, '950000071996050', 'Primera Capa Talla L', 'Unidad', 4361),
(143, '950000071996051', 'Primera Capa Talla M', 'Unidad', 4361),
(144, '950000071996052', 'Primera Capa Talla S', 'Unidad', 4361),
(145, '950000071996053', 'Primera Capa Talla XL', 'Unidad', 4361),
(146, '950000071996054', 'Primera Capa Talla XXL', 'Unidad', 4361),
(147, '950000071996055', 'Polera manga corta logo L', 'Unidad', 4500),
(148, '950000071996056', 'Polera manga corta Logo M', 'Unidad', 4500),
(149, '950000071996057', 'Polera manga corta logo S', 'Unidad', 4500),
(150, '950000071996058', 'Polera manga corta logo XL', 'Unidad', 4500),
(151, '950000071996060', 'Manguillas Plasticas Blancas', '100/Paquete', 13),
(152, '950000071996061', 'Jardinera blanca talla L', 'Unidad', 13620),
(153, '950000071996062', 'Jardinera blanca talla XL', 'Unidad', 17022),
(154, '950000071996063', 'Bota Bata De Goma Negra 39', 'Unidad', 7172),
(155, '950000071996064', 'Bota Bata De Goma Negra 40', 'Unidad', 7249),
(156, '950000071996065', 'Bota Bata De Goma Negra 41', 'Unidad', 7172),
(157, '950000071996066', 'Bota Bata De Goma Negra 42', 'Unidad', 9080),
(158, '950000071996067', 'Bota Bata De Goma Negra 43', 'Unidad', 9080),
(159, '950000071996068', 'Bota Bata De Goma Negra 44', 'Unidad', 9080),
(160, '950000071996069', 'Bota Bata De Goma Negra 45', 'Unidad', 7249),
(161, '950000071996070', 'Tenida Blanca de 2 Piezas T.40', 'Unidad', 10500),
(162, '950000071996071', 'Tenida Blanca de 2 Piezas T.42', 'Unidad', 11500),
(163, '950000071996072', 'Tenida Blanca de 2 Piezas T.44', 'Unidad', 11500),
(164, '950000071996073', 'Tenida Blanca de 2 Piezas T.46', 'Unidad', 11500),
(165, '950000071996074', 'Tenida Blanca de 2 Piezas T.48', 'Unidad', 11500),
(166, '950000071996075', 'Tenida Blanca de 2 Piezas T.50', 'Unidad', 11500),
(167, '950000071996076', 'Tenida Blanca de 2 Piezas T.52', 'Unidad', 11500),
(168, '950000071996077', 'Tenida Blanca de 2 Piezas T.54', 'Unidad', 11000),
(169, '950000071996078', 'Tenida Blanca de 2 Piezas T.56', 'Unidad', 11000),
(170, '950000071996079', 'Tenida Blanca de 2 Piezas T.58', 'Unidad', 10500),
(171, '950000071996080', 'Polar Blanco Manga Larga L', 'Unidad', 7500),
(172, '950000071996081', 'Polar Blanco Manga Larga M', 'Unidad', 7500),
(173, '950000071996082', 'Polar Blanco Manga Larga S', 'Unidad', 7500),
(174, '950000071996083', 'Polar Blanco Manga Larga XL', 'Unidad', 7500),
(175, '950000071996085', 'Polar Blanco Sin Manga Talla L', 'Unidad', 11000),
(176, '950000071996086', 'Polar Blanco Sin Manga Talla M', 'Unidad', 11000),
(177, '950000071996087', 'Polar Blanco Sin Manga Talla S', 'Unidad', 11000),
(178, '950000071996088', 'Polar Blanco Sin Manga Talla X', 'Unidad', 11000),
(179, '950000071996089', 'Parka Sin Manga', 'Unidad', 14820),
(180, '950000071996090', 'Mascarilla 3 Pliegues', '50/Paquete', 13),
(181, '950000071996093', 'Palas sanitarias blancas', 'Unidad', 259),
(182, '950000071996094', 'Botin de Seguridad N° 42', 'Unidad', 39100),
(183, '950000071996095', 'Polar Gris XL', 'Unidad', 6800),
(184, '950000071996096', 'Bota Worklite Talla 42 Blanca', 'Unidad', 25017),
(185, '950000071996097', 'Bota Worklite Talla 43 Blanca', 'Unidad', 25017),
(186, '950000071996098', 'Gorros Legionarios', 'Unidad', 1300),
(187, '950000071996101', 'Pechera Vestiflex', 'Unidad', 7300),
(188, '950000071996103', 'Delantal Blanco Mujer', 'Unidad', 15882),
(189, '950000071996104', 'Delantal Blanco Hombre', 'Unidad', 15882),
(190, '950000071996105', 'Bolso Ropa PVC T-400 C', 'Unidad', 2764.6),
(191, '950000071996106', 'Traje Chaqueta Agua Blanco L', 'Unidad', 13620),
(192, '950000071996107', 'Traje Chaqueta Agua Blanco XL', 'Unidad', 13620),
(193, '950000071996108', 'Gorro/Tocas Clip 100 x caja', 'Unidad', 12),
(194, '950000071996109', 'Cubre Calzado plastico', '100/Paquete', 9.9),
(195, '950000071996111', 'Bolso GuardaRopa', 'Unidad', 7500),
(196, '950000071996112', 'Pantalon Blanco Gabardin Cargo', 'Unidad', 7200),
(197, '950000071996114', 'Papel interfoliado Kleenex', 'Unidad', 832.25),
(198, '950000071996115', 'Toalla de Papel 2 x 250 mts.', '2/Paquete', 2950),
(199, '950000071996117', 'Detergente sanitizante', 'Unidad', 1975),
(200, '950000071996119', 'Papel Higiénico 6x600 mts.', '6/Paquete', 1550),
(201, '950000071996120', 'Toallas', 'Unidad', 5900),
(202, '950000071996121', 'Botas de Seguridad N°40', 'Unidad', 35000),
(203, '950000071996122', 'Botas de Seguridad N°41', 'Unidad', 35000),
(205, '950000071996132', 'Zapatos de Seguridad 39', 'Unidad', 52621),
(206, '950000071996133', 'Delantal Blanco M', 'Unidad', 16723),
(207, '950000071996134', 'Polar Gris L', 'Unidad', 6900),
(208, '950000071996135', 'Polar Gris M', 'Unidad', 6900),
(209, '950000071996136', 'Polar Gris S', 'Unidad', 6500),
(210, '950000071996137', 'Polera Blanca con Logo XL', 'Unidad', 4500),
(211, '950000071996138', 'Polera Blanca con Logo S', 'Unidad', 5500),
(212, '950000071996139', 'Traje Beige 2 Piezas T50', 'Unidad', 11500),
(213, '950000071996140', 'Polar Pijama M', 'Unidad', 11000),
(214, '950000071996141', 'Bota Bata de Goma Negra 48', 'Unidad', 18835),
(215, '950000071996142', 'tenida Beige 2 Piezas T 50', 'Unidad', 11500),
(216, '950000071996144', 'Bota Worklite Talla 45 Blanca', 'Unidad', 26369),
(217, '950000071996146', 'Botas Negras  46', 'Unidad', 7700),
(218, '950000071996147', 'Traje Verde 2 Piezas 56', 'Unidad', 11500),
(219, '950000071996148', 'Traje Verde 2 Piezas 58', 'Unidad', 11500),
(220, '950000071996155', 'Coleto cuero 60*90', 'Unidad', 5850),
(221, '950000071996160', 'Pantalon Azul Gab. Cargo 46', 'Unidad', 6900),
(222, '950000071996161', 'Pantalon Gris Gab. Cargo 44', 'Unidad', 7900),
(223, '950000071996162', 'S- Polera Azul Manga Larga', 'Unidad', 6100),
(224, '950000071996163', 'M- Polera Azul Manga Larga', 'Unidad', 6100),
(225, '950000071996164', 'L- Polera Azul Manga Larga', 'Unidad', 6100),
(226, '950000071996165', 'XL- Polera Azul Manga Larga', 'Unidad', 6100),
(227, '950000071996166', 'XXL- Polera Azul Manga Larga', 'Unidad', 6100),
(228, '950000071996167', 'M- Polera Gris Manga Larga', 'Unidad', 6100),
(229, '950000071996168', 'L- Polera Gris Manga Larga', 'Unidad', 6100),
(230, '950000071996169', 'XL- Polera Gris Manga Larga', 'Unidad', 6100),
(231, '950000071996170', 'XXL- Polera Gris Manga Larga', 'Unidad', 6100),
(232, '950000071996171', 'Pantalon Blanco Gab. Cargo M', 'Unidad', 7200),
(233, '950000071996172', 'Pantalon Blanco Gab. Cargo L', 'Unidad', 7200),
(234, '950000071996173', 'Pantalon Blanco Gab. Cargo XL', 'Unidad', 7200),
(235, '950000071996174', 'Pantalon Gris Gab. Cargo 46', 'Unidad', 7900),
(236, '950000071996175', 'Pantalon Gris Gab. Cargo 48', 'Unidad', 7900),
(237, '950000071996176', 'Pantalon Gris Gab. Cargo 50', 'Unidad', 7900),
(238, '950000071996177', 'Pantalon Gris Gab. Cargo 52', 'Unidad', 7900),
(239, '950000071996178', 'Pantalon Gris Gab. Cargo 56', 'Unidad', 7900),
(240, '950000071996179', 'Pantalon Gris Gab. Cargo 58', 'Unidad', 7900),
(241, '950000071996181', 'Pantalon Azul Gab. Cargo 48', 'Unidad', 6900),
(242, '950000071996182', 'Pantalon Azul Gab. Cargo 56', 'Unidad', 6900),
(243, '950000071996183', 'Pantalon Azul Gab. Cargo 58', 'Unidad', 6900),
(244, '950000071996184', 'Polar Blanco Manga Larga XXL', 'Unidad', 9500),
(245, '950000071996189', 'Polar Blanco Sin MangaTallaXXL', 'Unidad', 9500),
(246, '950000071996190', 'Polar Gris XXL', 'Unidad', 9500),
(247, '950000071996191', 'Polera Roja polo M/Corta M', 'Unidad', 4500),
(248, '950000071996192', 'Polera Roja polo M/Corta L', 'Unidad', 4500),
(249, '950000071996193', 'Polera Roja polo M/Corta XL', 'Unidad', 4500),
(250, '950000071997001', 'Cuchillo carnicero 18 ancho', 'Unidad', 11172),
(251, '950000071997002', 'Cuchillo carnicero 21 angosto', 'Unidad', 12967.5),
(252, '950000071997003', 'Cuchillo carnicero 21 ancha', 'Unidad', 13495.7),
(253, '950000071997004', 'Cuchillo hoja curva 16cm', 'Unidad', 8740),
(254, '950000071997005', 'Cuchillo aves 10cm', 'Unidad', 8593),
(255, '950000071997006', 'Cuchillo Esvicerador 16CM', 'Unidad', 16720),
(256, '950000071997007', 'Navaja Polyknives', 'Unidad', 1659.42),
(258, '950000071997009', 'Cuchilla desorillado', 'Unidad', 403.614),
(259, '950000071997010', 'Protectores Auditivos Cintillo', 'Unidad', 8182),
(260, '950000071997011', 'Hoja para desorillar (v)', 'Unidad', 359.6),
(261, '950000071997012', 'Guantes De Acero Azul (L)', 'Unidad', 52000),
(262, '950000071997017', 'Guantes de Goma verde talla L', 'Unidad', 24),
(263, '950000071997018', 'Guantes largo Amarillo Showa M', 'Unidad', 8500),
(264, '950000071997019', 'Guante Nitrilo Azul TL', '100/Unidad', 84.9),
(265, '950000071997020', 'Guante Nitrilo Azul TM', '100/Unidad', 84.9),
(266, '950000071997021', 'Guante Nitrilo Azul TS', '100/Unidad', 84.9),
(267, '950000071997024', 'Combos de Carton', 'Unidad', 8790),
(268, '950000071997025', 'Hoja de cortador (caja azul)', 'Unidad', 369),
(269, '950000071997026', 'Lentes Protectores Grises', 'Unidad', 3623),
(270, '950000071997027', 'Protector auditivo para Casco', 'Unidad', 8182),
(271, '950000071997028', 'Protectores audit. desechables', 'Unidad', 159),
(272, '950000071997029', 'Jockey con tela para', 'Unidad', 1820),
(273, '950000071997030', 'Colador mediano', 'Unidad', 450),
(274, '950000071997031', 'Mangas de Palpación', '100/Paquete', 155),
(275, '950000071997032', 'Triclosan x 20 lts', 'Litro', 2149),
(276, '950000071997034', 'Plástico cuchilla desorillado (amarillo)', 'Unidad', 1159),
(277, '950000071997035', 'Tunica PEBD blanca  50 Unds', 'Unidad', 250),
(278, '950000071997036', 'Termometro pinchar', 'Unidad', 20169),
(279, '950000071997037', 'Casco de Seguridad Rojo', 'Unidad', 1278),
(280, '950000071997038', 'Filtro Respirador', 'Unidad', 7500),
(281, '950000071997039', 'Tijeras 9.5', 'Unidad', 3440),
(282, '950000071997041', 'Casco de Seguridad Naranjo', 'Unidad', 1361),
(283, '950000071997042', 'Piedra Asentar Norton JB8', 'Unidad', 9975),
(284, '950000071997043', 'Sello Metalico 5/8\"', 'Unidad', 1880),
(285, '950000071997045', 'Boquilla de Agua', 'Unidad', 67817),
(286, '950000071997047', 'Guante de Acero S', 'Unidad', 52000),
(287, '950000071997048', 'Red steel glove M', 'Unidad', 52000),
(288, '950000071997051', 'astil', 'Unidad', 12825),
(289, '950000071997052', 'Cepillo con Mango Blanco', 'Unidad', 4990),
(290, '950000071997053', 'Cepillo de Limpieza Amarillo', 'Unidad', 595),
(291, '950000071997054', 'Cuchillo 16 cm recto', 'Unidad', 8740),
(292, '950000071997055', 'Cuchillo 30cm Ancho', 'Unidad', 15200),
(293, '950000071997056', 'Cuchillo carnicero 18 Angosto', 'Unidad', 10212.5),
(294, '950000071997057', 'Guante de Acero Blanco S', 'Unidad', 35000),
(295, '950000071997058', 'Termometro Digital', 'Unidad', 12555.3),
(296, '950000071997059', 'Lentes Protectores Claros', 'Unidad', 1481),
(297, '950000071997060', 'Zuncho Plastico 5/8\"', 'Unidad', 36371),
(298, '950000071997061', 'Zuncho Negro Plast. Bidon.', 'Unidad', 3002.24),
(299, '950000071997064', 'Casquete protector facial', 'Unidad', 1820),
(300, '950000071997065', 'Visor claro 8x16 para casquete', 'Unidad', 887),
(301, '950000071997066', 'Guante PVC azul temperatura T9', 'Unidad', 5726),
(302, '950000071997067', 'Guante PVC azul temp T10', 'Unidad', 5726),
(303, '950000071997068', 'Fibra Verde Plancha 1mtsx2mts', 'Pack', 8950),
(304, '950000071997069', 'Guantes de Cabritilla L', 'Unidad', 1113),
(305, '950000071997070', 'Guante Anticorte Algodón L', 'Unidad', 1290),
(306, '950000071997071', 'Canasto Blanco', 'Unidad', 445.4),
(307, '950000071997072', 'Respirador Reutilizables', 'Unidad', 9500),
(308, '950000071997073', 'Zuncho Poliester 32mm ancho', 'Unidad', 54600),
(311, '950000071997076', 'Guantes largo Amarillo Showa L', 'Unidad', 7900),
(312, '950000071997077', 'Guantes largo Amarillo ShowaXL', 'Unidad', 7900),
(313, '950000071997081', 'LENTES OX CLARO SOBRELENTE', 'Unidad', 1990),
(315, '950000071998001', 'Valvula de Fusil', 'Unidad', 39100),
(316, '950000071998008', 'Duchetas', 'Unidad', 54717.8),
(317, '950000071998010', 'Protector solar de 1LT', 'Unidad', 9947),
(318, '950000071998011', 'Zapatos de Seguridad 43 (operaciones)', 'Unidad', 27000),
(320, '950000071998013', 'Zapatos de Seguridad 45 (operaciones)', 'Unidad', 0),
(321, '950000071998014', 'Botas Silverado Blanco- T38 (prod)', 'Unidad', 19500),
(322, '950000071998015', 'Botas Silverado T39 (prod)', 'Unidad', 19500),
(323, '950000071998016', 'Botas Silverado T40 (prod)', 'Unidad', 20500),
(324, '950000071998017', 'Botas Silverado T41 (prod)', 'Unidad', 20500),
(325, '950000071998018', 'Botas Silverado T42 (prod)', 'Unidad', 20500),
(326, '950000071998019', 'Botas Silverado T43 (prod)', 'Unidad', 20500),
(327, '950000071998020', 'Botas Silverado T44 (prod)', 'Unidad', 20500),
(328, '950000071998030', 'Removedor Mancha 20L', 'Litro', 2981),
(329, '950000071998031', 'Detergente Desengrasante 20L', 'Litro', 2936),
(330, '950000071998032', 'Blanqueador Alta Temper. 20L', 'Litro', 2200),
(331, '950000071998033', 'Blanqueador Cloro 20L', 'Litro', 1863),
(332, '950000071998034', 'Suavizante de Ropa 20L', 'Litro', 2668),
(333, '950000071998035', 'Delimer', 'Litro', 3167),
(334, '950000071998045', 'Botin Bata Café (operaciones)', 'Unidad', 33700),
(335, '950000071998050', 'Sujetador- Retractor- Arnes', 'Unidad', 260),
(336, '950000071998139', 'Bota Blanca Pta Acero Bata 39 (prod)', 'Unidad', 8374),
(337, '950000071998140', 'Bota Blanca Pta Acero Bata 40 (prod)', 'Unidad', 8374),
(338, '950000071998141', 'Bota Blanca Pta Acero Bata 41 (prod)', 'Unidad', 8374),
(339, '950000071998142', 'Bota Blanca Pta Acero Bata 42 (prod)', 'Unidad', 8374),
(340, '950000071998143', 'Bota Blanca Pta Acero Bata 43 (prod)', 'Unidad', 8374),
(341, '950000071998144', 'Bota Blanca Pta Acero Bata 44 (prod)', 'Unidad', 8374),
(342, '950000071998145', 'Bota Blanca Pta Acero Bata 45 (prod)', 'Unidad', 8374),
(343, '950000071998146', 'Mascarillas Genero (exclusivo producción)', 'Unidad', 250);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ins_usuarios`
--

CREATE TABLE `ins_usuarios` (
  `id_usuario` int(3) NOT NULL,
  `us_nombre` varchar(150) NOT NULL,
  `us_email` varchar(100) NOT NULL,
  `us_clave` varchar(8) NOT NULL,
  `us_perfil` int(15) NOT NULL,
  `us_area` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ins_usuarios`
--

INSERT INTO `ins_usuarios` (`id_usuario`, `us_nombre`, `us_email`, `us_clave`, `us_perfil`, `us_area`) VALUES
(16, 'admin', 'dtrigo@insuban.cl', 'admin20', 5, '6'),
(77, 'sergio1', 'digitacion@insuban.cl', '1234', 1, '9'),
(46, 'aduran', 'aseo@insuban.cl', '1234', 1, '8'),
(43, 'ssotelo', 'sstotelo@insuban.cl', '1234', 1, '5'),
(42, 'agallardo', 'agallardo@insuban.cl', '1234', 1, '5'),
(39, 'cruiz', 'cruiz@insuban.cl', '1234', 3, '7'),
(76, 'psandovalc', 'psandoval@insuban.cl', '1234', 1, '5'),
(63, 'prevcali', 'jmanquel@insuban.cl', '0000', 1, '5'),
(47, 'rmorales', 'logistica@insuban.cl', '0000', 4, '7'),
(75, 'psandovala', 'psandoval@insuban.cl', '1234', 1, '8'),
(52, 'prevprod', 'jmanquel@insuban.cl', '0000', 1, '2'),
(53, 'prevmant', 'jmanquel@insuban.cl', '0000', 1, '4'),
(54, 'prevaseo', 'jmanquel@insuban.cl', '0000', 1, '8'),
(55, 'prevoper', 'jmanquel@insuban.cl', '0000', 1, '7'),
(56, 'ncerdan', 'ncerdan@insuban.cl', '0000', 2, '7'),
(57, 'cvalderrama1', 'cvalderrama@insuban.cl', '0000', 2, '9'),
(58, 'cvalderrama2', 'cvalderrama@insuban.cl', '0000', 2, '10'),
(59, 'cvalderrama', 'cvalderrama@insuban.cl', '0000', 2, '2'),
(89, 'FROILANAPR', 'furdaneta@insuban.cl', '0000', 2, '4'),
(61, 'PaulinaAseo', 'psandoval@insuban.cl', '0000', 2, '8'),
(62, 'PaulinaCalidad', 'psandoval@insuban.cl', '0000', 2, '5'),
(69, 'jmanquelprod', 'jmanquel@insuban.cl', '0000', 2, '2'),
(68, 'VARIOS', 'cruiz@insuban.cl', '0000', 1, '0'),
(70, 'jmanquelmant', 'jmanquel@insuban.cl', '0000', 2, '4'),
(71, 'jmanquelcali', 'jmanquel@insuban.cl', '0000', 2, '5'),
(72, 'jmanquelaseo', 'jmanquel@insuban.cl', '0000', 2, '8'),
(73, 'jmanqueloper', 'jmanquel@insuban.cl', '0000', 2, '7'),
(74, 'PRODUCCION', '', '0000', 2, '2'),
(78, 'sergio2', 'digitacion@insuban.cl', '1234', 1, '10'),
(79, 'rgaray1', 'rgaray@insuban.cl', '0000', 2, '9'),
(80, 'rgaray2', 'rgaray@insuban.cl', '1234', 2, '10'),
(81, 'cnegrete1', 'cnegrete@insuban.cl', '8888', 2, '9'),
(82, 'cnegrete2', 'cnegrete@insuban.cl', '8888', 2, '10'),
(83, 'ariel', 'ariel.chiappa@gmail.com', '1234', 1, '9'),
(84, 'danny', 'vacio@insuban.cl', '1234', 1, '10'),
(85, 'OPERACIONES', 'cruiz@insuban.cl', '0000', 3, '7'),
(86, 'FROILAN', 'furdaneta@insuban.cl', '1234', 1, '4'),
(88, 'furdaneta', 'furdaneta@insuban.cl', '0000', 2, '4'),
(90, 'CARLOS', 'cruiz@insuban.cl', '1234', 1, '7'),
(91, 'CARLOSAPR', 'cruiz@insuban.cl', '0000', 2, '7'),
(92, 'cristian', 'csilva@insuban.cl', '1234', 1, '2'),
(93, 'csilva', 'csilva@insuban.cl', '0000', 2, '2'),
(94, 'bodega', 'logistica@insuban.cl', '2580', 4, '7'),
(95, 'COMEX', 'cvalderrama@insuban.cl', '1234', 1, '2'),
(96, 'CRISTINA', 'comex@insuban.cl', '1234', 2, '2'),
(97, 'RUBEN', 'rguerrero@insuban.cl', '1234', 1, '2'),
(98, 'RUBEN2', 'rguerrero@insuban.cl', '0000', 2, '2'),
(101, 'JOSECOMAFRI30', 'jlorenzi@insuban.cl', '1234', 1, '11'),
(102, 'JOSEMAXAGRO31', 'jlorenzi@insuban.cl', '1234', 1, '11'),
(103, 'JOSECOEXCA32', 'jlorenzi@insuban.cl', '1234', 1, '11'),
(104, 'JOSECAMER35', 'jlorenzi@insuban.cl', '1234', 1, '11'),
(105, 'JOSEROSARIO', 'jlorenzi@insuban.cl', '1234', 1, '11'),
(106, 'JOSEMIRANDA', 'jlorenzi@insuban.cl', '1234', 1, '11'),
(107, 'jlorenzi', 'jlorenzi@insuban.cl', '0000', 2, '11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `transporte` varchar(255) NOT NULL,
  `condiciones` varchar(255) NOT NULL,
  `comentarios` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id_perfil` int(11) NOT NULL,
  `nom_perfil` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `nom_perfil`) VALUES
(1, 'Solicitante'),
(2, 'Aprobador'),
(3, 'Operaciones'),
(4, 'Administador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `codigo_producto` char(20) NOT NULL,
  `nombre_producto` char(100) NOT NULL,
  `modelo_producto` varchar(30) NOT NULL,
  `id_departamento_producto` int(11) NOT NULL,
  `id_marca_producto` int(11) NOT NULL,
  `status_producto` tinyint(4) NOT NULL,
  `unidad_medida_producto` char(20) NOT NULL,
  `peso_producto` char(20) NOT NULL,
  `date_added` datetime NOT NULL,
  `precio_producto` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `codigo_producto`, `nombre_producto`, `modelo_producto`, `id_departamento_producto`, `id_marca_producto`, `status_producto`, `unidad_medida_producto`, `peso_producto`, `date_added`, `precio_producto`) VALUES
(1, '950000071991001', 'Argolla Plástica Azul', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 20),
(2, '950000071991002', 'Argolla Plástica Blanca', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 20),
(3, '950000071991003', 'Argolla Plástica Café', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 20),
(4, '950000071991004', 'Argolla Plástica Lila', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 20),
(5, '950000071991005', 'Argolla Plástica Naranja', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 20),
(6, '950000071991006', 'Argolla Plástica Negra', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 20),
(7, '950000071991007', 'Argolla Plastica Rosada', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 20),
(8, '950000071991008', 'Argolla Plástica Roja', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 20),
(9, '950000071991009', 'Argolla Plástica Verde', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 20),
(10, '950000071991010', 'Argolla Plastica Blanca', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 20),
(11, '950000071991020', 'Balde Nuevo 20 L EO', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 417.9167),
(12, '950000071991030', 'Cañamo Plastico Amarillo', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 2320),
(13, '950000071991031', 'Cañamo Plastico Azul', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 2320),
(14, '950000071991033', 'Cañamo Plastico Blanco', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 2306),
(15, '950000071991034', 'Cañamo Plastico Café', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 2320),
(16, '950000071991035', 'Cañamo Plastico Lila', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 2306),
(17, '950000071991036', 'Cañamo Plastico Naranjo', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 2306),
(18, '950000071991037', 'Cañamo Plastico Negro', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 2306),
(19, '950000071991038', 'Cañamo Plastico Rojo', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 2320),
(20, '950000071991039', 'Cañamo Plastico Rosado', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 2306),
(21, '950000071991040', 'Hilo Amarillo', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 5623.9871),
(22, '950000071991041', 'Hilo Azul/Blanco', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 2306),
(23, '950000071991042', 'Hilo Azul/Rojo', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 2306),
(24, '950000071991043', 'Hilo Azul', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 5432.9431),
(25, '950000071991044', 'Hilo Blanco', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 2306),
(26, '950000071991045', 'Hilo Rojo/Blanco', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 5432.9431),
(27, '950000071991046', 'Hilo Rojo', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 2306),
(28, '950000071991047', 'Hilo Verde/Blanco', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 2306),
(29, '950000071991048', 'Hilo Verde', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 2306),
(30, '950000071991049', 'Lino Cafe  100% Hilado (Hilo Atar)', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 9100),
(31, '950000071991050', 'Malla Pavo Azul', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 56),
(32, '950000071991051', 'Sello SEM / 333 azul Camion', '', 0, 0, 0, '50/Paquete', '', '2020-08-01 08:00:00', 57),
(33, '950000071991052', 'Sello Sand/50 azul Bidon', '', 0, 0, 0, '50/Paquete', '', '2020-08-01 08:00:00', 47),
(34, '950000071991053', 'Separador Azul', '', 0, 0, 0, '1500/Paquete', '', '2020-08-01 08:00:00', 3),
(35, '950000071991054', 'Separador Blanco', '', 0, 0, 0, '1500/Paquete', '', '2020-08-01 08:00:00', 3),
(36, '950000071991055', 'Separador cafe claro', '', 0, 0, 0, '1500/Paquete', '', '2020-08-01 08:00:00', 3),
(37, '950000071991056', 'Separador celeste', '', 0, 0, 0, '1500/Paquete', '', '2020-08-01 08:00:00', 3),
(38, '950000071991057', 'Separador Lila', '', 0, 0, 0, '1500/Paquete', '', '2020-08-01 08:00:00', 3),
(39, '950000071991058', 'Separador Rojo', '', 0, 0, 0, '1500/Paquete', '', '2020-08-01 08:00:00', 3),
(40, '950000071991059', 'Separador Verde', '', 0, 0, 0, '1500/Paquete', '', '2020-08-01 08:00:00', 3),
(41, '950000071991070', 'Etiqueta Plastica Amarilla', '', 0, 0, 0, '1000/Paquete', '', '2020-08-01 08:00:00', 7),
(42, '950000071991071', 'Etiqueta Plástica Azul', '', 0, 0, 0, '1000/Paquete', '', '2020-08-01 08:00:00', 7),
(43, '950000071991072', 'Etiqueta Plástica Blanca', '', 0, 0, 0, '1000/Paquete', '', '2020-08-01 08:00:00', 7),
(44, '950000071991073', 'Etiqueta Plástica Café', '', 0, 0, 0, '1000/Paquete', '', '2020-08-01 08:00:00', 7),
(45, '950000071991074', 'Etiqueta Plástica Lila', '', 0, 0, 0, '1000/Paquete', '', '2020-08-01 08:00:00', 7),
(46, '950000071991075', 'Etiqueta Plástica Roja', '', 0, 0, 0, '1000/Paquete', '', '2020-08-01 08:00:00', 7),
(47, '950000071991076', 'Etiqueta Plástica Verde', '', 0, 0, 0, '1000/Paquete', '', '2020-08-01 08:00:00', 7),
(48, '950000071991077', 'Etiqueta plastica Celeste', '', 0, 0, 0, '1000/Paquete', '', '2020-08-01 08:00:00', 7),
(49, '950000071991078', 'Argolla Plástica Amarilla', '', 0, 0, 0, '1000/Paquete', '', '2020-08-01 08:00:00', 20),
(50, '950000071991080', 'Film Azul plastico tubbing', '', 0, 0, 0, '6 Rollo/Caja', '', '2020-08-01 08:00:00', 36.2026),
(51, '950000071991081', 'Cañamo Plastico Verde', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 2306),
(52, '950000071991082', 'Malla Pavo Blanca', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 56.607),
(53, '950000071992001', 'Bidones Nuevos', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 20931),
(54, '950000071992002', 'Bidones Usados', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 0),
(55, '950000071993001', 'Bolsa Blanca 600x900mm', '', 0, 0, 0, '600/Paquete', '', '2020-08-01 08:00:00', 72),
(56, '950000071993002', 'Bolsa Bidon trans.1050x2400', '', 0, 0, 0, '120/ Paquete', '', '2020-08-01 08:00:00', 207),
(57, '950000071993005', 'Bolsa Vacío 400x700', '', 0, 0, 0, '400/Paquete', '', '2020-08-01 08:00:00', 235),
(58, '950000071993006', 'Bolsa Vacío 200x700', '', 0, 0, 0, '600/Paquete', '', '2020-08-01 08:00:00', 149),
(59, '950000071993008', 'Bolsa basura Azul 60x90', '', 0, 0, 0, '500/Paquete', '', '2020-08-01 08:00:00', 72),
(60, '950000071993009', 'Bolsa Basura azul 50x60', '', 0, 0, 0, '1600/Paquete', '', '2020-08-01 08:00:00', 30),
(61, '950000071993010', 'Lamina Troz Poliet. A/Den,Tran', '', 0, 0, 0, '200/Paquete', '', '2020-08-01 08:00:00', 47),
(62, '950000071993011', 'Bolsa uso personal 900x1340', '', 0, 0, 0, '300/Paquete', '', '2020-08-01 08:00:00', 77),
(63, '950000071993012', 'Bolsa transparente 1050x1800', '', 0, 0, 0, '200/Paquete', '', '2020-08-01 08:00:00', 207),
(64, '950000071993013', 'Bolsa Poliet.combo 250x230', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 72),
(65, '950000071993015', 'Bolsa 600*900 Rollo Transparen', '', 0, 0, 0, 'Rollo', '', '2020-08-01 08:00:00', 1800),
(66, '950000071993020', 'Cajas de Carton', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 410),
(67, '950000071993030', 'Amarra cable', '', 0, 0, 0, '100/Paquete', '', '2020-08-01 08:00:00', 29),
(68, '950000071993031', 'Film Manual', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 2980),
(69, '950000071993040', 'Cinta Térmica 110x300', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 5620),
(70, '950000071993041', 'Cinta Termica 110x75', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 5460),
(71, '950000071993042', 'Etiqueta Impresora 100x110', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 6280),
(72, '950000071993043', 'Cintas De Embalaje Transparent', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 440),
(73, '950000071993044', 'Etiqueta impresora 100x100', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11.0481),
(74, '950000071993045', 'Etiqueta impresora 100x150', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 16490),
(75, '950000071993046', 'Cinta Termica 110X450 (450)', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 6230),
(76, '950000071993047', 'Sello amarra madejas rojo', '', 0, 0, 0, '1000/Paquete', '', '2020-08-01 08:00:00', 26.0545),
(77, '950000071993048', 'Rollos Sumadora 44 x 41 BLANCO', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 355.2),
(78, '950000071993050', 'Letrero Camion Insuban Blanco', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 360),
(79, '950000071993051', 'Letrero Camion Insuban Verde', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 667),
(80, '950000071993060', 'Pallet', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 4900),
(81, '950000071993061', 'Pallet Frimesa', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 5900),
(82, '950000071993062', 'Pallet Pancreas', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 6500),
(83, '950000071993063', 'Etiqueta 100x200', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 20.425),
(84, '950000071993065', 'Pallet Brasil 1X1.2Mts', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 8935),
(85, '950000071994002', 'SAL 080 X Sal Gruesa', '', 0, 0, 0, '1000/Saco', '', '2020-08-01 08:00:00', 72.5),
(86, '950000071994003', 'SAL 25K 088', '', 0, 0, 0, '25/Saco', '', '2020-08-01 08:00:00', 90),
(87, '950000071994004', 'Sal 088 X Sal Fina', '', 0, 0, 0, '1000/Saco', '', '2020-08-01 08:00:00', 80),
(88, '950000071994101', 'Hielo Escama', '', 0, 0, 0, '25/Saco', '', '2020-08-01 08:00:00', 51.48),
(89, '950000071995001', 'Acido Acetico', '', 0, 0, 0, 'Litro', '', '2020-08-01 08:00:00', 1440),
(90, '950000071995002', 'Bactolim C-15 Peracetico x 20L', '', 0, 0, 0, 'Litro', '', '2020-08-01 08:00:00', 1190),
(91, '950000071995003', 'Clorito de sodio 50 Kls', '', 0, 0, 0, 'Litro', '', '2020-08-01 08:00:00', 2499),
(92, '950000071995004', 'Dioxido de Cloro al 5% 20 Lit', '', 0, 0, 0, 'Litro', '', '2020-08-01 08:00:00', 1969),
(93, '950000071995005', 'Metabisulfito De Sodio', '', 0, 0, 0, '1200/Saco', '', '2020-08-01 08:00:00', 388.926),
(94, '950000071995008', 'Alcohol Gel x 10 Lts', '', 0, 0, 0, 'Litro', '', '2020-08-01 08:00:00', 1850),
(95, '950000071995010', 'Espuma Clorada (eclor)  220L', '', 0, 0, 0, 'Litro', '', '2020-08-01 08:00:00', 1428),
(96, '950000071995013', 'Desinfectante (NewQuats) 20L', '', 0, 0, 0, 'Litro', '', '2020-08-01 08:00:00', 2549),
(97, '950000071995014', 'Limpia Vidrios  x 20 Lts', '', 0, 0, 0, 'Litro', '', '2020-08-01 08:00:00', 750),
(98, '950000071995018', 'Multiclean-10', '', 0, 0, 0, 'Litro', '', '2020-08-01 08:00:00', 944),
(99, '950000071995021', 'Candado 25mm-pequeno', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 2146.35),
(100, '950000071995023', 'Desoxidante fuerte- clinic 23L', '', 0, 0, 0, 'Litro', '', '2020-08-01 08:00:00', 1490),
(101, '950000071995026', 'Bandeja Simple Bca R.', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 0),
(102, '950000071995027', 'Bandeja Roja Piso Reutilizable', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 0),
(103, '950000071995029', 'ECLOR 20ltrs.', '', 0, 0, 0, 'Litro', '', '2020-08-01 08:00:00', 1350),
(104, '950000071995031', 'Candado 50mm-Grande', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 5100),
(105, '950000071995033', 'Alcohol al 76%', '', 0, 0, 0, 'Litro', '', '2020-08-01 08:00:00', 4050),
(106, '950000071995034', 'Alcohol al 95% (Uso Bidon)', '', 0, 0, 0, 'Litro', '', '2020-08-01 08:00:00', 1915),
(107, '950000071996001', 'Tenida Verde 42', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 10500),
(108, '950000071996002', 'Tenida Verde 44', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11000),
(109, '950000071996003', 'Tenida Verde 46', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11500),
(110, '950000071996004', 'Tenida Verde 48', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 10500),
(111, '950000071996005', 'Tenida Verde 50', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 10500),
(112, '950000071996006', 'Tenida Verde 52', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 10500),
(113, '950000071996007', 'Tenida Verde 54', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 10500),
(114, '950000071996008', 'Tenida Beige 2 Piezas T 40', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11500),
(115, '950000071996009', 'Tenida Beige 2 Piezas T 42', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11500),
(116, '950000071996010', 'Tenida Beige 2 Piezas T 44', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11500),
(117, '950000071996011', 'Tenida Beige 2 Piezas T 46', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11500),
(118, '950000071996012', 'Tenida Beige 2 Piezas T 48', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11500),
(119, '950000071996013', 'Tenida Beige 2 Piezas T 52', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11500),
(120, '950000071996014', 'Tenida Beige 2 Piezas T 54', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11500),
(121, '950000071996015', 'Tenida Beige 2 Piezas T 56', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11500),
(122, '950000071996016', 'Overol Piloto rojo', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 4800),
(123, '950000071996017', 'Overol Piloto Azul L', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 4800),
(321, '950000071997072', 'Respirador Reutilizable', '', 0, 0, 0, 'Unidad', '', '0000-00-00 00:00:00', 7000),
(125, '950000071996019', 'Overall Desechable Talla XL', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 993),
(126, '950000071996020', 'Overall Desechable Talla XXL', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 993),
(127, '950000071996021', 'Overol Piloto Blanco L', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 4800),
(128, '950000071996022', 'Overol Piloto Blanco M', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 4800),
(129, '950000071996023', 'Overol Piloto Blanco XL', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 4800),
(130, '950000071996024', 'Overol Piloto Blanco XXL', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 4496),
(131, '950000071996025', 'Pantalon Blanco', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 4500),
(132, '950000071996026', 'Polar Verde Talla L', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 7900),
(133, '950000071996027', 'Polar Verde Talla M', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 7900),
(134, '950000071996028', 'Polar Verde Talla S', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 7900),
(135, '950000071996029', 'Polar Verde Talla XL', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 7900),
(136, '950000071996033', 'Pijama Polar Talla L', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11000),
(137, '950000071996034', 'Pijama Polar Talla XL', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11000),
(138, '950000071996035', 'Pijama Polar Talla XXL', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11000),
(139, '950000071996036', 'Bota Bata De Goma Blca. 36', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 9300),
(140, '950000071996037', 'Bota Bata De Goma Blca. 37', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 8184),
(141, '950000071996038', 'Bota Bata De Goma Blca. 38', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 9300),
(142, '950000071996039', 'Bota Bata De Goma Blca. 39', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 8184),
(143, '950000071996040', 'Bota Bata De Goma Blca. 40', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 8184),
(144, '950000071996041', 'Bota Bata De Goma Blca. 41', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 9300),
(145, '950000071996042', 'Bota Bata De Goma Blca. 42', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 9300),
(146, '950000071996043', 'Bota Bata De Goma Blca. 43', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 9300),
(147, '950000071996044', 'Bota Bata De Goma Blca. 44', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 8184),
(148, '950000071996045', 'Bota Bata De Goma Blca. 45', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 9300),
(149, '950000071996047', 'Polera Pique Manga Larga', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 6100),
(150, '950000071996048', 'Polera Blanca con Logo L', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 4500),
(151, '950000071996049', 'Polera Blanca con Logo M', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 4500),
(152, '950000071996050', 'Primera Capa Talla L', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 4361),
(153, '950000071996051', 'Primera Capa Talla M', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 4361),
(154, '950000071996052', 'Primera Capa Talla S', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 4361),
(155, '950000071996053', 'Primera Capa Talla XL', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 4361),
(156, '950000071996054', 'Primera Capa Talla XXL', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 4361),
(157, '950000071996055', 'Polera manga corta logo L', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 4500),
(158, '950000071996056', 'Polera manga corta Logo M', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 4500),
(159, '950000071996057', 'Polera manga corta logo S', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 4500),
(160, '950000071996058', 'Polera manga corta logo XL', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 4500),
(161, '950000071996060', 'Manguillas Plasticas Blancas', '', 0, 0, 0, '100/Paquete', '', '2020-08-01 08:00:00', 13),
(162, '950000071996061', 'Jardinera blanca talla L', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 13620),
(163, '950000071996062', 'Jardinera blanca talla XL', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 13620),
(164, '950000071996063', 'Bota Bata De Goma Negra 39', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 7172),
(165, '950000071996064', 'Bota Bata De Goma Negra 40', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 7249),
(166, '950000071996065', 'Bota Bata De Goma Negra 41', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 7172),
(167, '950000071996066', 'Bota Bata De Goma Negra 42', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 9080),
(168, '950000071996067', 'Bota Bata De Goma Negra 43', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 9080),
(169, '950000071996068', 'Bota Bata De Goma Negra 44', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 9080),
(170, '950000071996069', 'Bota Bata De Goma Negra 45', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 7249),
(171, '950000071996070', 'Tenida Blanca de 2 Piezas T.40', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 10500),
(172, '950000071996071', 'Tenida Blanca de 2 Piezas T.42', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11500),
(173, '950000071996072', 'Tenida Blanca de 2 Piezas T.44', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11500),
(174, '950000071996073', 'Tenida Blanca de 2 Piezas T.46', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11500),
(175, '950000071996074', 'Tenida Blanca de 2 Piezas T.48', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11500),
(176, '950000071996075', 'Tenida Blanca de 2 Piezas T.50', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11500),
(177, '950000071996076', 'Tenida Blanca de 2 Piezas T.52', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11500),
(178, '950000071996077', 'Tenida Blanca de 2 Piezas T.54', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11000),
(179, '950000071996078', 'Tenida Blanca de 2 Piezas T.56', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11000),
(180, '950000071996079', 'Tenida Blanca de 2 Piezas T.58', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 10500),
(181, '950000071996080', 'Polar Blanco Talla L', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 7500),
(182, '950000071996081', 'Polar Blanco Talla M', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 7500),
(183, '950000071996082', 'Polar Blanco Talla S', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 7500),
(184, '950000071996083', 'Polar Blanco Talla XL', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 7500),
(185, '950000071996085', 'Polar Blanco Sin Manga Talla L', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11000),
(186, '950000071996086', 'Polar Blanco Sin Manga Talla M', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11000),
(187, '950000071996087', 'Polar Blanco Sin Manga Talla S', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11000),
(188, '950000071996088', 'Polar Blanco Sin Manga Talla XL', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11000),
(189, '950000071996089', 'Parka Sin Manga', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 14820),
(190, '950000071996090', 'Mascarilla 3 Pliegues (50un)', '', 0, 0, 0, '50 Un/Paquete', '', '2020-08-01 08:00:00', 13),
(191, '950000071996093', 'Palas sanitarias blancas', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 259),
(192, '950000071996094', 'Botin de Seguridad N° 42', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 39100),
(193, '950000071996095', 'Polar Gris XL', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 6800),
(194, '950000071996096', 'Bota Worklite Talla 42 Blanca', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 25017),
(195, '950000071996097', 'Bota Worklite Talla 43 Blanca', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 25017),
(196, '950000071996098', 'Gorros Legionarios', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 1300),
(197, '950000071996101', 'Pechera Vestiflex', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 7300),
(198, '950000071996102', 'Pechera Antisangre', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 6240),
(199, '950000071996103', 'Delantal Blanco Mujer', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 15882),
(200, '950000071996104', 'Delantal Blanco Hombre', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 15882),
(201, '950000071996105', 'Bolso Ropa PVC T-400 C', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 2764.6),
(202, '950000071996106', 'Traje Chaqueta Agua Blanco L', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 13620),
(203, '950000071996107', 'Traje Chaqueta Agua Blanco XL', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 13620),
(323, '950000071996108', 'gorro cofia clip', '', 0, 0, 0, '100/Paquete', '', '0000-00-00 00:00:00', 12),
(205, '950000071996109', 'Cubre Calzado plastico', '', 0, 0, 0, '100/Paquete', '', '2020-08-01 08:00:00', 9.9),
(206, '950000071996110', 'Calzas de polar', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 14900),
(207, '950000071996111', 'Bolso GuardaRopa', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 7500),
(208, '950000071996112', 'Pantalon Gabardina Cargo', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 7200),
(209, '950000071996114', 'Papel interfoliado Kleenex', '', 0, 0, 0, '36 Paquete/Caja', '', '2020-08-01 08:00:00', 832.25),
(210, '950000071996115', 'Toalla de Papel 2 x 250 mts.', '', 0, 0, 0, '2 Unidad/Paquete', '', '2020-08-01 08:00:00', 2950),
(211, '950000071996117', 'Detergente sanitizante', '', 0, 0, 0, 'Litro', '', '2020-08-01 08:00:00', 1975),
(212, '950000071996119', 'Papel Higiénico 6x600 mts.', '', 0, 0, 0, '6 Unidad/Paquete', '', '2020-08-01 08:00:00', 1550),
(213, '950000071996120', 'Toallas', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 5900),
(214, '950000071996121', 'Botas de Seguridad N°40', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 35000),
(215, '950000071996122', 'Botas de Seguridad N°41', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 35000),
(216, '950000071996131', 'Zapatillas Seguridad Mujer', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 35800),
(217, '950000071996132', 'Zapatos de Seguridad 39', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 52621),
(218, '950000071996133', 'Delantal Blanco M', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 16723),
(219, '950000071996134', 'Polar Gris L', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 6900),
(220, '950000071996135', 'Polar Gris M', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 6900),
(221, '950000071996136', 'Polar Gris S', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 6500),
(222, '950000071996137', 'Polera Blanca con Logo XL', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 4500),
(223, '950000071996138', 'Polera Blanca con Logo S', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 5500),
(224, '950000071996140', 'Polar Pijama M', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11000),
(225, '950000071996142', 'tenida Beige 2 Piezas T 50', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11500),
(226, '950000071996155', 'Coleto Blanco 60*90', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 5850),
(227, '950000071997001', 'Cuchillo carnicero 18 hoja anc', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 10640),
(228, '950000071997002', 'Cuchillo carnicero 21 hoja ang', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 11571),
(229, '950000071997003', 'Cuchillo carnicero 21 hoja anc', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 9025),
(230, '950000071997004', 'Cuchillo hoja curva 16cm', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 8740),
(231, '950000071997005', 'Cuchillo aves 10cm', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 8593),
(232, '950000071997006', 'Cuchillo Esvicerador 16CM', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 16720),
(233, '950000071997007', 'Navaja Polyknives', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 1659.42),
(234, '950000071997008', 'Vaina Porta Cuchillo', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 23154.35),
(235, '950000071997009', 'Cuchilla desorillado', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 403.614),
(236, '950000071997010', 'Protectores Auditivos Cintillo', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 8182),
(237, '950000071997011', 'Hoja para desorillar', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 359.6),
(238, '950000071997017', 'Guantes de Goma verde talla L', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 24),
(239, '950000071997018', 'Guantes largo Amarillo Showa', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 8500),
(240, '950000071997019', 'Guante Nitrilo Azul TL', '', 0, 0, 0, '100 Unidad/Paquete', '', '2020-08-01 08:00:00', 26.1),
(241, '950000071997020', 'Guante Nitrilo Azul TM', '', 0, 0, 0, '100 Unidad/Paquete', '', '2020-08-01 08:00:00', 23.6),
(242, '950000071997021', 'Guante Nitrilo Azul TS', '', 0, 0, 0, '100 Unidad/Paquete', '', '2020-08-01 08:00:00', 23.6),
(243, '950000071997025', 'Hoja de cortador', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 369),
(244, '950000071997026', 'Lentes Protectores Grises', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 3623),
(245, '950000071997027', 'Protector auditivo para Casco', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 8182),
(246, '950000071997028', 'Protectores audit. desechables', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 159),
(247, '950000071997029', 'Jockey con tela para', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 1820),
(248, '950000071997030', 'Colador mediano', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 450),
(249, '950000071997031', 'Mangas de Palpación', '', 0, 0, 0, '100 Unidad/Paquete', '', '2020-08-01 08:00:00', 155),
(250, '950000071997032', 'Triclosan x 20 lts', '', 0, 0, 0, 'Litro', '', '2020-08-01 08:00:00', 2149),
(251, '950000071997035', 'Tunica PEBD blanca  50 Unds', '', 0, 0, 0, '50 Unidad/Paquete', '', '2020-08-01 08:00:00', 250),
(252, '950000071997036', 'Termometro pinchar', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 20169),
(253, '950000071997038', 'Filtro Respirador', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 7500),
(254, '950000071997039', 'Tijeras 9.5', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 3440),
(255, '950000071997041', 'Casco de Seguridad', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 1203),
(256, '950000071997042', 'Piedra Asentar Norton JB8', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 6175),
(257, '950000071997044', 'Rodillos tubing', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 0),
(258, '950000071997045', 'Boquilla de Agua', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 67816.98),
(259, '950000071997047', 'Guante de Acero S', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 52000),
(260, '950000071997051', 'astil', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 12825),
(261, '950000071997052', 'Cepillo con Mango Blanco', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 4990),
(262, '950000071997053', 'Cepillo de Limpieza Amarillo', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 595),
(263, '950000071997054', 'Cuchillo 16 cm recto', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 8740),
(264, '950000071997055', 'Cuchillo 30cm Ancho', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 15200),
(265, '950000071997056', 'Cuchillo 18cm Delgado', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 10212.5),
(266, '950000071997058', 'Termometro Digital', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 12555.35),
(267, '950000071997059', 'Lentes Protectores Claros', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 1481),
(268, '950000071997060', 'Zuncho Plastico 5/8\"', '', 0, 0, 0, 'Rollo', '', '2020-08-01 08:00:00', 36371),
(269, '950000071997064', 'Casquete protector facial', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 1820),
(270, '950000071997065', 'Visor claro 8x16 para casquete', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 887),
(271, '950000071997066', 'Guante PVC azul temperatura T9', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 5726),
(272, '950000071997067', 'Guante PVC azul temp T10', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 5726),
(273, '950000071997068', 'Fibra Verde Plancha 1mtsx2mts', '', 0, 0, 0, 'Pack', '', '2020-08-01 08:00:00', 8950),
(274, '950000071997069', 'Guantes de Cabritilla L', '', 0, 0, 0, 'Par', '', '2020-08-01 08:00:00', 1113),
(275, '950000071997070', 'Guante Anticorte Algodón L', '', 0, 0, 0, 'Par', '', '2020-08-01 08:00:00', 1290),
(276, '950000071997071', 'Canasto Blanco', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 445.4),
(277, '950000071997073', 'Zuncho Poliester 32mm ancho', '', 0, 0, 0, 'Rollo', '', '2020-08-01 08:00:00', 54600),
(278, '950000071997081', 'LENTES OX CLARO SOBRELENTE', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 1990),
(279, '950000071997082', 'Casco con Barboquejo Plastico', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 1361),
(280, '950000071998001', 'Valvula de Fusil', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 46.1),
(281, '950000071998003', 'Boquilla de Aire', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 67816.98),
(282, '950000071998008', 'Duchetas', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 51963.66),
(283, '950000071998010', 'Protector solar de 1LT', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 9947),
(284, '950000071998011', 'Zapatos de Seguridad 43', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 27000),
(285, '950000071998012', 'Zapatos de Seguridad 44', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 37789),
(286, '950000071998013', 'Zapatos de Seguridad 45', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 0),
(287, '950000071998014', 'Botas Silverado Blanco- T38', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 19500),
(288, '950000071998015', 'Botas Silverado T39', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 19500),
(289, '950000071998016', 'Botas Silverado T40', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 19500),
(290, '950000071998017', 'Botas Silverado T41', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 19500),
(291, '950000071998018', 'Botas Silverado T42', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 19500),
(292, '950000071998019', 'Botas Silverado T43', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 19500),
(293, '950000071998020', 'Botas Silverado T44', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 19500),
(294, '950000071998030', 'Removedor Mancha 20L', '', 0, 0, 0, 'Litro', '', '2020-08-01 08:00:00', 2981),
(295, '950000071998031', 'Detergente Desengrasante 20L', '', 0, 0, 0, 'Litro', '', '2020-08-01 08:00:00', 2936),
(296, '950000071998032', 'Blanqueador Alta Temper. 20L', '', 0, 0, 0, 'Litro', '', '2020-08-01 08:00:00', 2200),
(297, '950000071998033', 'Blanqueador Cloro 20L', '', 0, 0, 0, 'Litro', '', '2020-08-01 08:00:00', 1863),
(298, '950000071998034', 'Suavizante de Ropa 20L', '', 0, 0, 0, 'Litro', '', '2020-08-01 08:00:00', 2668),
(299, '950000071998035', 'Delimer', '', 0, 0, 0, 'Litro', '', '2020-08-01 08:00:00', 3167),
(300, '950000071998045', 'Botin Bata Cafe', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 33700),
(301, '950000071998050', 'Sujetador- Retractor- Arnes', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 260),
(302, '950000071998139', 'Bota Blanca Pta Acero Bata 39', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 8374),
(303, '950000071998140', 'Bota Blanca Pta Acero Bata 40', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 8374),
(304, '950000071998141', 'Bota Blanca Pta Acero Bata 41', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 8374),
(305, '950000071998142', 'Bota Blanca Pta Acero Bata 42', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 8374),
(306, '950000071998143', 'Bota Blanca Pta Acero Bata 43', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 8374),
(307, '950000071998144', 'Bota Blanca Pta Acero Bata 44', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 8374),
(308, '950000071998145', 'Bota Blanca Pta Acero Bata 45', '', 0, 0, 0, 'Unidad', '', '2020-08-01 08:00:00', 8374),
(309, '9500000719900000', 'Cuchillos Retractiles Wurth', '', 0, 0, 0, 'Unidad', '', '0000-00-00 00:00:00', 0),
(311, 'BM601412', 'DILUYENTE', '', 0, 0, 0, 'LITRO', '', '0000-00-00 00:00:00', 0),
(312, '950000071990000', 'Hilos de Atar', '', 0, 0, 0, 'Unidad', '', '0000-00-00 00:00:00', 0),
(313, '950000071980000', 'Fichas Amarillas', '', 0, 0, 0, 'Unidad', '', '0000-00-00 00:00:00', 0),
(314, '950000071997079', 'Cuchillo 25cm LINEA BOUTS', '', 0, 0, 0, 'Unidad', '', '0000-00-00 00:00:00', 0),
(315, '950000071990001', 'DISPENSADOR DE TOALLA NOVA', '', 0, 0, 0, 'Unidad', '', '0000-00-00 00:00:00', 0),
(316, '950000071990002', 'DISPENSADOR DE JABON', '', 0, 0, 0, 'Unidad', '', '0000-00-00 00:00:00', 0),
(317, '950000071990003', 'DISPENSADOR DE ALCOHOL GEL', '', 0, 0, 0, 'Unidad', '', '0000-00-00 00:00:00', 0),
(318, '950000071990004', 'DISPENSADOR DE PAPEL HIGIENICO', '', 0, 0, 0, 'Unidad', '', '0000-00-00 00:00:00', 0),
(322, '950000071990010', 'Cuchillo 30cm LINEA BOUTS', '', 0, 0, 0, 'Unidad', '', '0000-00-00 00:00:00', 25000),
(320, '950000071990099', 'Cuchillos Retractiles Wurth', '', 0, 0, 0, 'Unidad', '', '0000-00-00 00:00:00', 5000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_proveedor` varchar(255) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `email` varchar(64) NOT NULL,
  `direccion` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nombre_proveedor`, `telefono`, `email`, `direccion`) VALUES
(1, 'INFORMATICA', '528', 'dtrigo@insuban.cl', ''),
(2, 'CALIDAD', '', '', ''),
(3, 'ADMINISTRACION', '', '', ''),
(4, 'ASEO', '', '', ''),
(5, 'COMAFRI', '', '', ''),
(6, 'MAXAGRO', '', '', ''),
(7, 'COEXCA', '', '', ''),
(8, 'PRODUCCION', '', '', ''),
(9, 'PLANTA 1', '', '', ''),
(10, 'PLANTA 2', '', '', ''),
(11, 'OPERACIONES', '', '', ''),
(12, 'PREVENCION', '', '', ''),
(13, 'CONTABILIDAD', '', '', ''),
(14, 'RRHH', '', '', ''),
(15, 'MANTENCION', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp`
--

CREATE TABLE `tmp` (
  `id_tmp` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_tmp` int(11) NOT NULL,
  `precio_tmp` double(8,2) NOT NULL,
  `session_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fecha_solicitud` date NOT NULL,
  `area` varchar(35) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `solicitante` varchar(35) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `estado_solicitud` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tmp`
--

INSERT INTO `tmp` (`id_tmp`, `id_producto`, `cantidad_tmp`, `precio_tmp`, `session_id`, `fecha_solicitud`, `area`, `solicitante`, `estado_solicitud`) VALUES
(599, 102, 100, 0.00, 'JOSECAMER35', '2020-11-12', '', '', ''),
(598, 101, 200, 0.00, 'JOSECAMER35', '2020-11-12', '', '', ''),
(597, 54, 10, 0.00, 'JOSECAMER35', '2020-11-12', '', '', ''),
(612, 85, 2000, 72.00, 'ariel', '2020-11-12', '9', '', 'Aprobado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id_area`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `numero_cotizacion` (`numero_pedido`,`id_producto`);

--
-- Indices de la tabla `ins_insumos`
--
ALTER TABLE `ins_insumos`
  ADD PRIMARY KEY (`id_insumo`);

--
-- Indices de la tabla `ins_usuarios`
--
ALTER TABLE `ins_usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD UNIQUE KEY `numero_cotizacion` (`numero`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD UNIQUE KEY `codigo_producto` (`codigo_producto`),
  ADD KEY `id_departamento_producto` (`id_departamento_producto`),
  ADD KEY `id_marca_producto` (`id_marca_producto`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `tmp`
--
ALTER TABLE `tmp`
  ADD PRIMARY KEY (`id_tmp`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `ins_insumos`
--
ALTER TABLE `ins_insumos`
  MODIFY `id_insumo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=348;

--
-- AUTO_INCREMENT de la tabla `ins_usuarios`
--
ALTER TABLE `ins_usuarios`
  MODIFY `id_usuario` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=324;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tmp`
--
ALTER TABLE `tmp`
  MODIFY `id_tmp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=613;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

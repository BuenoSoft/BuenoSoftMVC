-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-01-2016 a las 00:40:39
-- Versión del servidor: 5.5.46-0ubuntu0.14.04.2
-- Versión de PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `amnesia_1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE IF NOT EXISTS `compras` (
  `comId` int(11) NOT NULL AUTO_INCREMENT,
  `tcId` int(11) NOT NULL,
  `usuId` int(11) NOT NULL,
  `vehId` int(11) NOT NULL,
  `comFecha` date NOT NULL,
  `comCuotas` int(11) NOT NULL,
  `comCantidad` int(11) NOT NULL,
  PRIMARY KEY (`comId`),
  KEY `tcId` (`tcId`,`usuId`,`vehId`),
  KEY `tcId_2` (`tcId`,`usuId`,`vehId`),
  KEY `tcId_3` (`tcId`),
  KEY `usuId` (`usuId`),
  KEY `vehId` (`vehId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`comId`, `tcId`, `usuId`, `vehId`, `comFecha`, `comCuotas`, `comCantidad`) VALUES
(3, 3, 23, 1, '2015-12-09', 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE IF NOT EXISTS `marcas` (
  `marId` int(11) NOT NULL AUTO_INCREMENT,
  `marNombre` varchar(20) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`marId`),
  UNIQUE KEY `marNombre` (`marNombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`marId`, `marNombre`) VALUES
(1, 'chevrolet'),
(6, 'ferrari'),
(2, 'honda'),
(4, 'hyundai'),
(5, 'renault'),
(3, 'yamaha');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
--

CREATE TABLE IF NOT EXISTS `modelos` (
  `modId` int(11) NOT NULL AUTO_INCREMENT,
  `modNombre` varchar(20) CHARACTER SET latin1 NOT NULL,
  `marId` int(11) NOT NULL,
  PRIMARY KEY (`modId`),
  UNIQUE KEY `modNombre` (`modNombre`),
  KEY `marId` (`marId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `modelos`
--

INSERT INTO `modelos` (`modId`, `modNombre`, `marId`) VALUES
(1, 'Aspiradorita', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE IF NOT EXISTS `pagos` (
  `comId` int(11) NOT NULL,
  `pagId` int(11) NOT NULL,
  `pagFecPago` date NOT NULL,
  `pagFecVenc` date NOT NULL,
  `pagMonto` int(11) NOT NULL,
  PRIMARY KEY (`comId`,`pagId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`comId`, `pagId`, `pagFecPago`, `pagFecVenc`, `pagMonto`) VALUES
(3, 1, '2015-12-01', '2015-12-08', 45);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `rolId` int(11) NOT NULL AUTO_INCREMENT,
  `rolNombre` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`rolId`),
  UNIQUE KEY `rolNombre` (`rolNombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`rolId`, `rolNombre`) VALUES
(1, 'admin'),
(2, 'normal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_compras`
--

CREATE TABLE IF NOT EXISTS `tipo_compras` (
  `tcId` int(11) NOT NULL AUTO_INCREMENT,
  `tcNombre` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`tcId`),
  UNIQUE KEY `tpNombre` (`tcNombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tipo_compras`
--

INSERT INTO `tipo_compras` (`tcId`, `tcNombre`) VALUES
(1, 'contado'),
(3, 'credito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_vehiculos`
--

CREATE TABLE IF NOT EXISTS `tipo_vehiculos` (
  `tvId` int(11) NOT NULL AUTO_INCREMENT,
  `tvNombre` varchar(20) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`tvId`),
  UNIQUE KEY `tvNombre` (`tvNombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `tipo_vehiculos`
--

INSERT INTO `tipo_vehiculos` (`tvId`, `tvNombre`) VALUES
(8, 'Auto'),
(10, 'CamiÃ³n'),
(14, 'Moto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuId` int(11) NOT NULL AUTO_INCREMENT,
  `usuNick` varchar(30) CHARACTER SET latin1 NOT NULL,
  `usuPass` varchar(32) CHARACTER SET latin1 NOT NULL,
  `usuMail` varchar(30) CHARACTER SET latin1 NOT NULL,
  `usuNombre` varchar(30) CHARACTER SET latin1 NOT NULL,
  `usuApellido` varchar(30) CHARACTER SET latin1 NOT NULL,
  `usuStatus` tinyint(1) NOT NULL DEFAULT '1',
  `rolId` int(11) NOT NULL,
  PRIMARY KEY (`usuId`),
  UNIQUE KEY `usuNick` (`usuNick`),
  KEY `rolId` (`rolId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=36 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuId`, `usuNick`, `usuPass`, `usuMail`, `usuNombre`, `usuApellido`, `usuStatus`, `rolId`) VALUES
(1, 'detective', '7687e6ca945475694552f3eab356f5d6', 'corajejd@gmail.com', 'Juandy', 'Ocampo', 1, 1),
(5, 'debby_ros', '9136e5e4ca7f10b7de3171a92b97eecc', 'dededede@gmail.com', 'Debby', 'Rossi', 1, 2),
(6, 'juanal', '500997a452cf7d40deebe072463b2444', 'juanalocampo@gmail.com', 'Juan Alberto', 'Ocampo', 1, 2),
(8, 'luisito', '5c0bea43dcee002ba2e770ac0b657ccb', 'luisito@gmail.com', '', '', 0, 2),
(9, 'julialiliam', 'bdaa69e07dcdb9c4629924abe4c93183', 'julialiliamferreira@gmail.com', '', '', 1, 2),
(10, 'penelope', '81211afed935812a28311019c0c10db4', 'penep@gmail.com', '', '', 1, 2),
(11, 'tommyli', '65f185ec6bd47af8f082f8196d0b4d24', 'tomyalves@gmail.com', 'Tommy', 'Alves', 1, 2),
(12, 'marianao', '8ecebae285499528c58c26054ac2f93c', 'marianao@gmail.com', 'Mariam', 'Otegui', 1, 2),
(14, 'john_flo', 'fd0ed068dba650a5bb261fe2230b4fa4', 'johnflores@gmail.com', 'John', 'Flores', 1, 2),
(15, 'cathcha32', '1ead85e33e425d6136e458bf3f613af2', 'cathcha32@gmail.com', 'Fabio', 'Borges', 1, 2),
(16, 'nicoz', '7209ccc5412c34e293b771719500a6b6', 'nicozunini@gmail.com', 'Nicolas', 'Zunini', 1, 2),
(17, 'jonan', '448999d9cd4d0729e11fe33a5e467d11', 'jonamorales@gmail.com', 'Jonathan', 'Morales', 1, 2),
(18, 'tatan', 'ee26a843418007e717fff651377da82c', 'rodrigomartins@gmail.com', 'Rodrigo', 'Martins', 1, 2),
(19, 'milam', 'a3e3c8d6ad4da2ffdfea07c0a626cd0f', 'gabrielaramburo.12@gmail.com', 'MiltÃ³n', 'Aramburo', 1, 2),
(20, 'leomar', '59025dc54530f60163e21e5a3e411ea5', 'leomartinez@gmail.com', 'Leonardo', 'Martinez', 0, 2),
(21, 'gianin', '559ed96ac947867c520afa2524030208', 'gianigiovanonni@gmail.com', 'Gianinna', 'Giovanonni', 1, 2),
(22, 'javi_moli', 'c39bf613f83bd28e51c0a40fb1c70931', 'luisjaviermolina@gmail.com', 'Javier', 'Molina', 1, 2),
(23, 'hmaciera', 'b2d6cd03170b7bd763d20a71a7c4430f', 'hmaciera@gmail.com', 'Haldo', 'Maciera', 1, 2),
(24, 'rbarreda', 'bf26c14dcb9af3f7037ad6e23fc95eef', 'rbarreda@gmail.com', 'Rodrigo', 'Barreda', 1, 2),
(25, 'mbertinat', 'c0e767086f98e9d52083d5b8257142d1', 'mbertinat@gmail.com', 'Martin', 'Bertinat', 1, 2),
(26, 'fanton', '27e7f5eb1459b746988305d4dd8db808', 'fedeanton@gmail.com', 'Federico', 'AntÃ³n', 1, 2),
(27, 'pwilliams', '4715ab03bf5c27bd02e1aba2617c9f19', 'pwilliams@gmail.com', 'Pablo', 'Williams', 1, 2),
(28, 'yusuke', '6b9561c6c391e3b0746ab5e5daef8f21', 'yusuke@gmail.com', 'Yusuke', 'Urameshi', 1, 1),
(29, 'el_tigre', '1ddff545424249df81f3c4ab552dbb3d', 'eltigre@gmail.com', 'Manny', 'Rivera', 1, 2),
(30, 'piÃ±on', '8d25a0a6a1e3605cd61b90815dd6551d', 'pinon_fijo@gmail.com', 'PiÃ±on', 'Fijo', 1, 2),
(32, 'carrito', '815600639d7c8475801b79929bb78380', 'carrito@gmail.com', 'Caroso', 'Narizota', 1, 2),
(33, 'digi_tri', '2cfaee5e47c63d11fc70cc31383ebc87', 'digi_tri@gmail.com', 'digi', 'adven_3', 1, 2),
(34, 'jojo', '7510d498f23f5815d3376ea7bad64e29', 'jojo@gmail.com', 'jojojo', 'pepepe', 1, 2),
(35, 'jute', 'b752a9e27ce44768438c9b8b606b0626', 'jute@hotmail.com', 'jujuju', 'jljljl', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE IF NOT EXISTS `vehiculos` (
  `vehId` int(11) NOT NULL AUTO_INCREMENT,
  `vehMatricula` varchar(10) CHARACTER SET latin1 NOT NULL,
  `vehPrecio` int(11) NOT NULL,
  `vehCantidad` int(11) NOT NULL,
  `vehDescrip` mediumtext CHARACTER SET latin1 NOT NULL,
  `vehFoto` char(100) CHARACTER SET latin1 NOT NULL,
  `vehStatus` tinyint(4) NOT NULL DEFAULT '1',
  `modId` int(11) NOT NULL,
  `tvId` int(11) NOT NULL,
  PRIMARY KEY (`vehId`),
  UNIQUE KEY `vehMatricula` (`vehMatricula`),
  KEY `modId` (`modId`,`tvId`),
  KEY `tvId` (`tvId`),
  KEY `modId_2` (`modId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`vehId`, `vehMatricula`, `vehPrecio`, `vehCantidad`, `vehDescrip`, `vehFoto`, `vehStatus`, `modId`, `tvId`) VALUES
(1, '34345', 45, 5, 'fggfgffgfgfgfgfg', 'Public/upload/vehiculos/18ede2-descarga-jpg.jpg', 1, 1, 8);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`tcId`) REFERENCES `tipo_compras` (`tcId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`usuId`) REFERENCES `usuarios` (`usuId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compras_ibfk_3` FOREIGN KEY (`vehId`) REFERENCES `vehiculos` (`vehId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD CONSTRAINT `modelos_ibfk_1` FOREIGN KEY (`marId`) REFERENCES `marcas` (`marId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`comId`) REFERENCES `compras` (`comId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rolId`) REFERENCES `roles` (`rolId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `vehiculos_ibfk_1` FOREIGN KEY (`modId`) REFERENCES `modelos` (`modId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehiculos_ibfk_2` FOREIGN KEY (`tvId`) REFERENCES `tipo_vehiculos` (`tvId`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

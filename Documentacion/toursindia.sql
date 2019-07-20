-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-07-2019 a las 19:58:02
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `toursindia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
  `idAdministrador` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idAdministrador`),
  KEY `FK_Usuario_Administrador` (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`idAdministrador`, `idUsuario`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
  `idComentarios` int(11) NOT NULL AUTO_INCREMENT,
  `Comentario` varchar(255) DEFAULT NULL,
  `fechaComentario` date DEFAULT NULL,
  `horaComentario` timestamp(2) NOT NULL DEFAULT CURRENT_TIMESTAMP(2) ON UPDATE CURRENT_TIMESTAMP(2),
  `idUsuario` int(11) NOT NULL,
  `idTours` int(11) NOT NULL,
  PRIMARY KEY (`idComentarios`),
  KEY `FK_COMENTARIOS_USUARIO` (`idUsuario`),
  KEY `FK_COMENTARIOS_TOURS` (`idTours`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`idComentarios`, `Comentario`, `fechaComentario`, `horaComentario`, `idUsuario`, `idTours`) VALUES
(1, 'Excelente lugar, lo envuelve una gran historia', '2019-07-18', '2019-07-19 03:10:24.00', 6, 1),
(2, 'Clima extremo, grandioso contemplar el everest', '2019-07-18', '2019-07-19 03:10:24.00', 7, 2),
(3, 'Playas exoticas, paraiso soleado', '2019-07-18', '2019-07-19 03:10:24.00', 8, 3),
(4, 'Bahia Bengala, grandioso sitio', '2019-07-18', '2019-07-19 03:10:24.00', 9, 4),
(5, 'Excelente exhibicion de arte y arquitectura', '2019-07-18', '2019-07-19 03:10:24.00', 10, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `idEstados` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idEstados`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`idEstados`, `nombre`) VALUES
(1, 'Uttar Pradesh'),
(2, 'Kashmir'),
(3, 'Goa'),
(4, 'Tamil Nadu'),
(5, 'Rajastan'),
(6, 'Kerala'),
(7, 'Delhi'),
(8, 'Bengala Occidental'),
(9, 'Karnataka'),
(10, 'Maharashtra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guia`
--

CREATE TABLE IF NOT EXISTS `guia` (
  `idGuia` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idGuia`),
  KEY `FK_Usuario_Guia` (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `guia`
--

INSERT INTO `guia` (`idGuia`, `idUsuario`) VALUES
(1, 11),
(2, 12),
(3, 13),
(4, 14),
(5, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hotel`
--

CREATE TABLE IF NOT EXISTS `hotel` (
  `idHotel` int(11) NOT NULL AUTO_INCREMENT,
  `nombreHotel` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `idEstados` int(11) NOT NULL,
  `idTours` int(11) NOT NULL,
  PRIMARY KEY (`idHotel`),
  KEY `FK_TOURS_HOTEL` (`idTours`),
  KEY `FK_HOTEL_ESTADOS` (`idEstados`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `hotel`
--

INSERT INTO `hotel` (`idHotel`, `nombreHotel`, `descripcion`, `precio`, `idEstados`, `idTours`) VALUES
(1, 'Hotel Taj Resorts', 'Free parking, Free Internet, Cleaning Service', 750, 1, 1),
(2, 'Hotel Caravan Center', 'Free Parking, Free Breakfast, Free Internet, ', 728, 2, 2),
(3, 'Hotel Goa Woodlands', 'Free Internet, Pool, Free Parking, SPA, Free ', 486, 3, 3),
(4, 'Sparsa Resorts Kanyakumari', 'Free Internet, Pool, Free Parking, Free Break', 560, 4, 4),
(5, 'The Oberoi Rajvilas Jaipur', 'Rajasthan called the land of the Kings is one', 372, 5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE IF NOT EXISTS `imagenes` (
  `idImagenes` int(11) NOT NULL AUTO_INCREMENT,
  `ruta` varchar(45) DEFAULT NULL,
  `idTours` int(11) NOT NULL,
  PRIMARY KEY (`idImagenes`),
  KEY `FK_IMAGENES_TOURS` (`idTours`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE IF NOT EXISTS `pagos` (
  `idPagos` int(11) NOT NULL AUTO_INCREMENT,
  `impuestoSV` int(11) NOT NULL,
  `idTours` int(11) NOT NULL,
  `idHotel` int(11) NOT NULL,
  PRIMARY KEY (`idPagos`),
  KEY `FK_PAGOS_HOTEL` (`idHotel`),
  KEY `FK_PAGOS_TOURS` (`idTours`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`idPagos`, `impuestoSV`, `idTours`, `idHotel`) VALUES
(1, 20, 1, 1),
(2, 20, 2, 2),
(3, 20, 3, 3),
(4, 20, 4, 4),
(5, 20, 5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `idPersona` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCompleto` varchar(55) NOT NULL,
  `Apellidos` varchar(55) NOT NULL,
  `numeroIdentidad` varchar(55) NOT NULL,
  `telefono` varchar(55) NOT NULL,
  `genero` varchar(45) NOT NULL,
  `direccion` varchar(55) NOT NULL,
  PRIMARY KEY (`idPersona`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idPersona`, `nombreCompleto`, `Apellidos`, `numeroIdentidad`, `telefono`, `genero`, `direccion`) VALUES
(1, 'Bryan Leonardo', 'Calix Velasquez', '0611-1996-00999', '+504 9685-0749', 'M', 'Honduras, Tegucigalpa Col. San Miguel'),
(2, 'Catherine Giselle', 'Valdez', '0801-1996-00666', '+504 9679-4499', 'F', 'Honduras, Tegucigalpa Col. San Miguel'),
(3, 'Cesar Jacobo', 'Puerto', '0801-1996-00777', '+504 9863-6831', 'M', 'Honduras, Tegucigalpa Padros Universitarios'),
(4, 'Elvin Moises', 'Sanchez Medina', '0611-1995-00555', '+504 9943-9493', 'M', 'Honduras, Comayaguela Col. Cerro Grande'),
(5, 'Orlin Williams', 'Gomez', '0801-1996-00888', '+504 9437-8122', 'M', 'Honduras, Tegucigalapa'),
(6, 'Alexandra Patricia', 'Morgan Carrasco', '0801-1989-00111', '+504 9568-1520', 'F', 'Honduras, Tegucigalpa Col. Las Uvas'),
(7, 'Antonio Jose', 'Lopez Martinez', '0101-1988-00444', '+504 9541-2300', 'M', 'Honduras, La Ceiba Col. Las Lomas'),
(8, 'Ana Maria', 'Rodriguez Hernandez', '0102-1970-00333', '+504 8860-2145', 'F', 'Honduras, El Provenir Col. El porvenir'),
(9, 'Maria Pilar', 'Flores Mejia', '0103-1971-00222', '+504 3320-1518', 'F', 'Honduras, Esparta Col. Esparta'),
(10, 'Laura Isabel', 'Garcia Rivera', '0201-19972-00111', '+504 9876-1232', 'F', 'Honduras, Trujillo Col. El Limon'),
(11, 'Manuel Francisco', 'Reyes Pineda', '0401-1973-00122', '+504 9514-2015', 'M', 'Honduras, Copan Col. Santa Rosa'),
(12, 'Yamir Sarayu', 'Anjali Kapoor', '001-1974-00123', '+0091 3312-1878', 'M', 'India, Nueva Delhi'),
(13, 'Denali Indira', 'Khan Rao', '001-1975-00124', '+0091 9412-3456', 'F', 'India, Nueva Delhi'),
(14, 'Yalitza Uma', 'Nehru Nayak', '001-1976-00125', '+0091 9311-2566', 'F', 'India, Nueva Delhi'),
(15, 'Priya Rania', 'Grover Sharma', '001-1977-00126', '+0091 9212-2667', 'F', 'India, Nueva Delhi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `populares`
--

CREATE TABLE IF NOT EXISTS `populares` (
  `idPopulares` int(11) NOT NULL AUTO_INCREMENT,
  `idTours` int(11) NOT NULL,
  PRIMARY KEY (`idPopulares`),
  KEY `FK_POPULARES_TOURS` (`idTours`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `populares`
--

INSERT INTO `populares` (`idPopulares`, `idTours`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tours`
--

CREATE TABLE IF NOT EXISTS `tours` (
  `idTours` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fechaInicio` datetime DEFAULT NULL,
  `fechaFin` datetime DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `cupos` int(11) DEFAULT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `idEstados` int(11) NOT NULL,
  `idGuia` int(11) NOT NULL,
  PRIMARY KEY (`idTours`),
  KEY `FK_TOURS_ESTADOS` (`idEstados`),
  KEY `FK_TOURS_GUIA` (`idGuia`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tours`
--

INSERT INTO `tours` (`idTours`, `nombre`, `descripcion`, `fechaInicio`, `fechaFin`, `precio`, `cupos`, `calificacion`, `idEstados`, `idGuia`) VALUES
(1, 'Taj Mahal', 'Funerary monument built by the emperor Shah Jahan in honor of one of his wives\n\n', '2019-07-17 00:00:00', '2019-07-22 00:00:00', 860, 20, 4, 1, 1),
(2, 'Flying over the Himalayas', 'Being close to the largest mountain in the world and contemplating it, in the region of Leh Kashmir', '2019-07-17 00:00:00', '2019-07-19 00:00:00', 791, 5, 4, 2, 2),
(3, 'Goa Beach', 'Exotic Beaches Small excursion from Arambol beach, passing through Kalacha Beach\n', '2019-07-18 00:00:00', '2019-07-23 00:00:00', 779, 20, 5, 3, 3),
(4, 'Kanyakumari Tours', 'This place is also known as Cabo Comorin; a place where the Indian Ocean, the Arabian Sea and the Bay of Bengal meet\n', '2019-07-18 00:00:00', '2019-07-21 00:00:00', 550, 20, 4, 4, 4),
(5, 'Rajastan Tours', 'Rajasthan called the land of the Kings is one of the most beautiful states of India in its best colorful and exotic. The state hosts an incredible exhibition of art and architecture', '2019-07-18 00:00:00', '2019-07-24 00:00:00', 763, 20, 5, 5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `toursturista`
--

CREATE TABLE IF NOT EXISTS `toursturista` (
  `idToursTurista` int(11) NOT NULL AUTO_INCREMENT,
  `idTours` int(11) NOT NULL,
  `idTurista` int(11) NOT NULL,
  PRIMARY KEY (`idToursTurista`),
  KEY `FK_TOURSTURISTA_TURISTA01` (`idTours`),
  KEY `FK_TOURSTURISTA_TURISTA02` (`idTurista`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `toursturista`
--

INSERT INTO `toursturista` (`idToursTurista`, `idTours`, `idTurista`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turista`
--

CREATE TABLE IF NOT EXISTS `turista` (
  `idTurista` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idTurista`),
  KEY `FK_Usuario_Turista` (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `turista`
--

INSERT INTO `turista` (`idTurista`, `idUsuario`) VALUES
(1, 6),
(2, 7),
(3, 8),
(4, 9),
(5, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombreUsuario` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `idPersona` int(11) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `FK_Persona_Usuario` (`idPersona`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombreUsuario`, `email`, `contrasena`, `idPersona`) VALUES
(1, 'Leonard Calix', 'bcalixvelasquez@gmail.com', 'admin.451', 1),
(2, 'Catherine Valdez', 'kathyvaldez0@gmail.com', 'admin.452', 2),
(3, 'Cesar', 'jacob007thebest@gmail.com', 'admin.453', 3),
(4, 'Elvin', 'elvinmoises.sanchez@gmail.com', 'admin.454', 4),
(5, 'Orlin', 'orlinwilliams0077@gmail.com', 'admin.455', 5),
(6, 'Alex', 'alexmorgan@gmail.com', 'turist.123', 6),
(7, 'Antonio', 'lopezantonio@gmail.com', 'turist.234', 7),
(8, 'Ana', 'AnaRodriguez@gmail.com', 'turist.567', 8),
(9, 'Pilar', 'pilarFlores@gmail.com', 'turist.890', 9),
(10, 'Laura', 'lauraRivera@gmail.com', 'turist.101', 10),
(11, 'Manuel', 'manuelReyes@gmail.com', 'guia.123', 11),
(12, 'Yamir', 'yamirKapoor@gmail.com', 'guia.234', 12),
(13, 'Denali', 'IndiraKhan@gmail.com', 'guia.456', 13),
(14, 'Yalitza', 'UmaNayak@gmail.com', 'guia.789', 14),
(15, 'Priya', 'raniaSharma@gmail.com', 'guia.101', 15);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_populares`
--
CREATE TABLE IF NOT EXISTS `view_populares` (
`idTours` int(11)
,`nombre` varchar(45)
,`descripcion` varchar(255)
,`calificacion` int(11)
);
-- --------------------------------------------------------

--
-- Estructura para la vista `view_populares`
--
DROP TABLE IF EXISTS `view_populares`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_populares` AS select `t`.`idTours` AS `idTours`,`t`.`nombre` AS `nombre`,`t`.`descripcion` AS `descripcion`,`t`.`calificacion` AS `calificacion` from (`tours` `t` join `populares` `p` on((`p`.`idPopulares` = `t`.`idTours`)));

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `FK_Usuario_Administrador` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `FK_COMENTARIOS_TOURS` FOREIGN KEY (`idTours`) REFERENCES `tours` (`idTours`),
  ADD CONSTRAINT `FK_COMENTARIOS_USUARIO` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `guia`
--
ALTER TABLE `guia`
  ADD CONSTRAINT `FK_Usuario_Guia` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `FK_HOTEL_ESTADOS` FOREIGN KEY (`idEstados`) REFERENCES `estados` (`idEstados`),
  ADD CONSTRAINT `FK_TOURS_HOTEL` FOREIGN KEY (`idTours`) REFERENCES `tours` (`idTours`);

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `FK_IMAGENES_TOURS` FOREIGN KEY (`idTours`) REFERENCES `tours` (`idTours`);

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `FK_PAGOS_HOTEL` FOREIGN KEY (`idHotel`) REFERENCES `hotel` (`idHotel`),
  ADD CONSTRAINT `FK_PAGOS_TOURS` FOREIGN KEY (`idTours`) REFERENCES `tours` (`idTours`);

--
-- Filtros para la tabla `populares`
--
ALTER TABLE `populares`
  ADD CONSTRAINT `FK_POPULARES_TOURS` FOREIGN KEY (`idTours`) REFERENCES `tours` (`idTours`);

--
-- Filtros para la tabla `tours`
--
ALTER TABLE `tours`
  ADD CONSTRAINT `FK_TOURS_ESTADOS` FOREIGN KEY (`idEstados`) REFERENCES `estados` (`idEstados`),
  ADD CONSTRAINT `FK_TOURS_GUIA` FOREIGN KEY (`idGuia`) REFERENCES `guia` (`idGuia`);

--
-- Filtros para la tabla `toursturista`
--
ALTER TABLE `toursturista`
  ADD CONSTRAINT `FK_TOURSTURISTA_TURISTA01` FOREIGN KEY (`idTours`) REFERENCES `tours` (`idTours`),
  ADD CONSTRAINT `FK_TOURSTURISTA_TURISTA02` FOREIGN KEY (`idTurista`) REFERENCES `turista` (`idTurista`);

--
-- Filtros para la tabla `turista`
--
ALTER TABLE `turista`
  ADD CONSTRAINT `FK_Usuario_Turista` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_Persona_Usuario` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`idPersona`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
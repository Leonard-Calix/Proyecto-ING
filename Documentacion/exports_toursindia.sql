-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 25, 2019 at 02:15 PM
-- Server version: 5.7.26
-- PHP Version: 7.0.33-0+deb9u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toursindia`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ADD_PERSON` (IN `pnombreC` VARCHAR(55), IN `papellidos` VARCHAR(55), IN `pnumeroId` VARCHAR(55), IN `ptelefono` VARCHAR(55), IN `pgenero` VARCHAR(55), IN `pDireccion` VARCHAR(55), OUT `pidInsertado` INT, OUT `pMensaje` VARCHAR(45))  BEGIN
	DECLARE pError VARCHAR(45);
	DECLARE existePersona INT;
	SET pError = '';
	SET existePersona = 0;

	IF pnombreC = '' THEN
		SET pError = CONCAT(pError, ' ','Nombre completo vacio');
	END IF;
	IF papellidos = '' THEN
		SET pError = CONCAT(pError, ' ', 'Apellidos vacio');
	END IF; 
	
	SELECT COUNT(*) INTO existePersona FROM persona WHERE nombreCompleto = pnombreC AND Apellidos = papellidos;

	IF pError = '' AND existePersona = 0 THEN
		
		INSERT INTO persona(nombreCompleto, Apellidos, numeroIdentidad, telefono, genero,direccion)
				     VALUES(pnombreC,papellidos,pnumeroId,ptelefono,pgenero,pDireccion);
	
		
		SELECT idPersona INTO pidInsertado FROM persona ORDER BY idPersona DESC LIMIT 1;
		
		SET pMensaje = 'Agregado exitosamente.'; 
		
	ELSE
		SET pMensaje = 'Fallo. Verifique sus datos a almacenar';
		
	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ADD_USER` (IN `pnombreU` VARCHAR(45), IN `pemail` VARCHAR(45), IN `pcontrasena` VARCHAR(45), IN `ptipoUser` INT, OUT `pidInsertado` INT, OUT `pMensaje` VARCHAR(45))  BEGIN

	DECLARE pError VARCHAR(45);
	DECLARE existeUsuario, ultimoIDpersona INT;
	SET pError = '';

	IF pnombreU = '' THEN
		SET pError = CONCAT(pError, ' ', 'Nombre de usuario vacio');
	END IF;
	IF pemail = '' THEN 
		SET pError = CONCAT(pError, ' ', 'email vacio');
	END IF;
	IF pcontrasena = '' THEN
		SET pError = CONCAT(pError, ' ','contraseña vacia');
	END IF;

	SELECT COUNT(*) INTO existeUsuario FROM usuario WHERE nombreUsuario = pnombreU AND email = pemail;

	IF pError = '' AND existeUsuario = 0 THEN

		SELECT idPersona INTO ultimoIDpersona FROM persona ORDER BY idPersona DESC LIMIT 1;

		
		INSERT INTO usuario(nombreUsuario,email,contrasena,idPersona) VALUES(pnombreU,pemail, pcontrasena,ultimoIDpersona);
		
		SELECT idUsuario INTO pidInsertado FROM usuario ORDER BY idUsuario DESC LIMIT 1;

		IF ptipoUser = 1 THEN
			INSERT INTO administrador(idUsuario) VALUES(pidInsertado);
			SET pMensaje = 'Registrado exitosamente administrador';
		END IF;
		
		IF ptipoUser = 2 THEN 
			INSERT INTO turista(idUsuario) VALUES(pidInsertado);
			SET pMensaje = 'Registrado exitosamente turista';
		END IF;
		
		IF ptipoUser = 3 THEN 
			INSERT INTO guia(idUsuario) VALUES(pidInsertado);
			SET pMensaje = 'Registrado exitosamente guia';	
		END IF;

	ELSE
		SET pMensaje = 'Fallo. No se ha registrado';
	END IF;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LOGIN` (IN `pemail` VARCHAR(45), IN `pcontrasena` VARCHAR(255), OUT `tipoUsuario` INT, OUT `usuarioID` INT)  BEGIN
	DECLARE existeUsuario,  esAdmin, esTurista, esGuia INT;
	SET existeUsuario = 0;
	SET esAdmin = 0;
	SET esTurista = 0;
	SET esGuia = 0;
	
	SELECT COUNT(*) INTO existeUsuario FROM usuario WHERE email = pemail AND contrasena = pcontrasena;
	IF existeUsuario > 0 THEN
		
		SELECT idUsuario INTO usuarioID FROM usuario WHERE email = pemail AND contrasena = pcontrasena;
		
		SELECT COUNT(*) INTO esAdmin FROM administrador WHERE idUsuario = usuarioID;
		SELECT COUNT(*) INTO esTurista FROM turista WHERE idUsuario = usuarioID;
		SELECT COUNT(*) INTO esGuia FROM guia WHERE idUsuario = usuarioID;

		IF esAdmin > 0 THEN
			SET tipoUsuario = 1;
		END IF;

		IF esTurista > 0 THEN
			SET tipoUsuario = 2;
		END IF;

		IF esGuia > 0 THEN
			SET tipoUsuario = 3;
		END IF;

	END IF;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `administrador`
--

CREATE TABLE `administrador` (
  `idAdministrador` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `administrador`
--

INSERT INTO `administrador` (`idAdministrador`, `idUsuario`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE `comentarios` (
  `idComentarios` int(11) NOT NULL,
  `Comentario` varchar(255) DEFAULT NULL,
  `fechaComentario` date DEFAULT NULL,
  `horaComentario` timestamp(2) NOT NULL DEFAULT CURRENT_TIMESTAMP(2) ON UPDATE CURRENT_TIMESTAMP(2),
  `idUsuario` int(11) NOT NULL,
  `idTours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comentarios`
--

INSERT INTO `comentarios` (`idComentarios`, `Comentario`, `fechaComentario`, `horaComentario`, `idUsuario`, `idTours`) VALUES
(1, 'Excelente lugar, lo envuelve una gran historia', '2019-07-23', '2019-07-23 15:49:47.00', 6, 1),
(2, 'Clima extremo, grandioso contemplar el everest', '2019-07-23', '2019-07-23 15:49:47.00', 7, 2),
(3, 'Playas exoticas, paraiso soleado', '2019-07-23', '2019-07-23 15:49:47.00', 8, 3),
(4, 'Bahia Bengala, grandioso sitio', '2019-07-23', '2019-07-23 15:49:47.00', 9, 4),
(5, 'Excelente exhibicion de arte y arquitectura', '2019-07-23', '2019-07-23 15:49:47.00', 10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `estados`
--

CREATE TABLE `estados` (
  `idEstados` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `estados`
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
-- Table structure for table `guia`
--

CREATE TABLE `guia` (
  `idGuia` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `guia`
--

INSERT INTO `guia` (`idGuia`, `idUsuario`) VALUES
(1, 11),
(2, 12),
(3, 13),
(4, 14),
(5, 15);

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `idHotel` int(11) NOT NULL,
  `nombreHotel` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `idEstados` int(11) NOT NULL,
  `idTours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`idHotel`, `nombreHotel`, `descripcion`, `precio`, `idEstados`, `idTours`) VALUES
(1, 'Hotel Taj Resorts', 'Free parking, Free Internet, Cleaning Service', 750, 1, 1),
(2, 'Hotel Caravan Center', 'Free Parking, Free Breakfast, Free Internet', 728, 2, 2),
(3, 'Hotel Goa Woodlands', 'Free Internet, Pool, Free Parking, SPA', 486, 3, 3),
(4, 'Sparsa Resorts Kanyakumari', 'Free Internet, Pool, Free Parking, Free Break', 560, 4, 4),
(5, 'The Oberoi Rajvilas Jaipur', 'Extremely Clean, Excellent Service, SPA', 372, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `imagenes`
--

CREATE TABLE `imagenes` (
  `idImagenes` int(11) NOT NULL,
  `ruta` varchar(45) DEFAULT NULL,
  `idTours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imagenes`
--

INSERT INTO `imagenes` (`idImagenes`, `ruta`, `idTours`) VALUES
(1, '../Public/img/tours/t1_01.jpg', 1),
(2, '../Public/img/tours/t1_02.jpg', 1),
(3, '../Public/img/tours/t1_03.png', 1),
(4, '../Public/img/tours/t1_04.jpg', 1),
(5, '../Public/img/tours/t1_05.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pagos`
--

CREATE TABLE `pagos` (
  `idPagos` int(11) NOT NULL,
  `impuestoSV` int(11) NOT NULL,
  `idTours` int(11) NOT NULL,
  `idHotel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pagos`
--

INSERT INTO `pagos` (`idPagos`, `impuestoSV`, `idTours`, `idHotel`) VALUES
(1, 20, 1, 1),
(2, 20, 2, 2),
(3, 20, 3, 3),
(4, 20, 4, 4),
(5, 20, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `persona`
--

CREATE TABLE `persona` (
  `idPersona` int(11) NOT NULL,
  `nombreCompleto` varchar(55) NOT NULL,
  `Apellidos` varchar(55) NOT NULL,
  `numeroIdentidad` varchar(55) NOT NULL,
  `telefono` varchar(55) NOT NULL,
  `genero` varchar(45) NOT NULL,
  `direccion` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `persona`
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
(15, 'Priya Rania', 'Grover Sharma', '001-1977-00126', '+0091 9212-2667', 'F', 'India, Nueva Delhi'),
(16, 'karen melisa', 'valladares casco', '0801-1995-00201', '+504 9852 4747', 'F', 'Honduras, Tegucigalpa Col. El Carrizail');

-- --------------------------------------------------------

--
-- Table structure for table `populares`
--

CREATE TABLE `populares` (
  `idPopulares` int(11) NOT NULL,
  `idTours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `populares`
--

INSERT INTO `populares` (`idPopulares`, `idTours`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tours`
--

CREATE TABLE `tours` (
  `idTours` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fechaInicio` datetime DEFAULT NULL,
  `fechaFin` datetime DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `cupos` int(11) DEFAULT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `idEstados` int(11) NOT NULL,
  `idGuia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tours`
--

INSERT INTO `tours` (`idTours`, `nombre`, `descripcion`, `fechaInicio`, `fechaFin`, `precio`, `cupos`, `calificacion`, `idEstados`, `idGuia`) VALUES
(1, 'Taj Mahal', 'Funerary monument built by the emperor Shah Jahan in honor of one of his wives', '2019-07-17 00:00:00', '2019-07-22 00:00:00', 860, 20, 4, 1, 1),
(2, 'Flying over the Himalayas', 'Being close to the largest mountain in the world and contemplating it, in the region of Leh Kashmir', '2019-07-17 00:00:00', '2019-07-19 00:00:00', 791, 5, 4, 2, 2),
(3, 'Goa Beach', 'Exotic Beaches Small excursion from Arambol beach, passing through Kalacha Beach', '2019-07-18 00:00:00', '2019-07-23 00:00:00', 779, 20, 5, 3, 3),
(4, 'Kanyakumari Tours', 'This place is also known as Cabo Comorin; a place where the Indian Ocean, the Arabian Sea and the Bay of Bengal meet', '2019-07-18 00:00:00', '2019-07-21 00:00:00', 550, 20, 4, 4, 4),
(5, 'Rajastan Tours', 'Rajasthan called the land of the Kings is one of the most beautiful states of India in its best colorful and exotic. The state hosts an incredible exhibition of art and architecture', '2019-07-18 00:00:00', '2019-07-24 00:00:00', 763, 20, 5, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `toursturista`
--

CREATE TABLE `toursturista` (
  `idToursTurista` int(11) NOT NULL,
  `idTours` int(11) NOT NULL,
  `idTurista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `toursturista`
--

INSERT INTO `toursturista` (`idToursTurista`, `idTours`, `idTurista`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `turista`
--

CREATE TABLE `turista` (
  `idTurista` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `turista`
--

INSERT INTO `turista` (`idTurista`, `idUsuario`) VALUES
(1, 6),
(2, 7),
(3, 8),
(4, 9),
(5, 10),
(6, 16);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombreUsuario` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `idPersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombreUsuario`, `email`, `contrasena`, `idPersona`) VALUES
(1, 'Leo', 'bcalixvelasquez@gmail.com', 'admin.451', 1),
(2, 'Cathy', 'kathyvaldez0@gmail.com', 'admin.452', 2),
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
(15, 'Priya', 'raniaSharma@gmail.com', 'guia.101', 15),
(16, 'meli', 'melivalladares@gmail.com', 'turist.000', 16);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_populares`
-- (See below for the actual view)
--
CREATE TABLE `view_populares` (
`idTours` int(11)
,`nombre` varchar(45)
,`descripcion` varchar(255)
,`calificacion` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `view_populares`
--
DROP TABLE IF EXISTS `view_populares`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_populares`  AS  select `t`.`idTours` AS `idTours`,`t`.`nombre` AS `nombre`,`t`.`descripcion` AS `descripcion`,`t`.`calificacion` AS `calificacion` from (`tours` `t` join `populares` `p` on((`p`.`idPopulares` = `t`.`idTours`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`idAdministrador`),
  ADD KEY `FK_Usuario_Administrador` (`idUsuario`);

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idComentarios`),
  ADD KEY `FK_COMENTARIOS_USUARIO` (`idUsuario`),
  ADD KEY `FK_COMENTARIOS_TOURS` (`idTours`);

--
-- Indexes for table `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`idEstados`);

--
-- Indexes for table `guia`
--
ALTER TABLE `guia`
  ADD PRIMARY KEY (`idGuia`),
  ADD KEY `FK_Usuario_Guia` (`idUsuario`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`idHotel`),
  ADD KEY `FK_TOURS_HOTEL` (`idTours`),
  ADD KEY `FK_HOTEL_ESTADOS` (`idEstados`);

--
-- Indexes for table `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`idImagenes`),
  ADD KEY `FK_IMAGENES_TOURS` (`idTours`);

--
-- Indexes for table `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`idPagos`),
  ADD KEY `FK_PAGOS_HOTEL` (`idHotel`),
  ADD KEY `FK_PAGOS_TOURS` (`idTours`);

--
-- Indexes for table `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idPersona`);

--
-- Indexes for table `populares`
--
ALTER TABLE `populares`
  ADD PRIMARY KEY (`idPopulares`),
  ADD KEY `FK_POPULARES_TOURS` (`idTours`);

--
-- Indexes for table `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`idTours`),
  ADD KEY `FK_TOURS_ESTADOS` (`idEstados`),
  ADD KEY `FK_TOURS_GUIA` (`idGuia`);

--
-- Indexes for table `toursturista`
--
ALTER TABLE `toursturista`
  ADD PRIMARY KEY (`idToursTurista`),
  ADD KEY `FK_TOURSTURISTA_TURISTA01` (`idTours`),
  ADD KEY `FK_TOURSTURISTA_TURISTA02` (`idTurista`);

--
-- Indexes for table `turista`
--
ALTER TABLE `turista`
  ADD PRIMARY KEY (`idTurista`),
  ADD KEY `FK_Usuario_Turista` (`idUsuario`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `FK_Persona_Usuario` (`idPersona`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrador`
--
ALTER TABLE `administrador`
  MODIFY `idAdministrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idComentarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `estados`
--
ALTER TABLE `estados`
  MODIFY `idEstados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `guia`
--
ALTER TABLE `guia`
  MODIFY `idGuia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `idHotel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `idImagenes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pagos`
--
ALTER TABLE `pagos`
  MODIFY `idPagos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `persona`
--
ALTER TABLE `persona`
  MODIFY `idPersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `populares`
--
ALTER TABLE `populares`
  MODIFY `idPopulares` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tours`
--
ALTER TABLE `tours`
  MODIFY `idTours` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `toursturista`
--
ALTER TABLE `toursturista`
  MODIFY `idToursTurista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `turista`
--
ALTER TABLE `turista`
  MODIFY `idTurista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `FK_Usuario_Administrador` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Constraints for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `FK_COMENTARIOS_TOURS` FOREIGN KEY (`idTours`) REFERENCES `tours` (`idTours`),
  ADD CONSTRAINT `FK_COMENTARIOS_USUARIO` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Constraints for table `guia`
--
ALTER TABLE `guia`
  ADD CONSTRAINT `FK_Usuario_Guia` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Constraints for table `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `FK_HOTEL_ESTADOS` FOREIGN KEY (`idEstados`) REFERENCES `estados` (`idEstados`),
  ADD CONSTRAINT `FK_TOURS_HOTEL` FOREIGN KEY (`idTours`) REFERENCES `tours` (`idTours`);

--
-- Constraints for table `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `FK_IMAGENES_TOURS` FOREIGN KEY (`idTours`) REFERENCES `tours` (`idTours`);

--
-- Constraints for table `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `FK_PAGOS_HOTEL` FOREIGN KEY (`idHotel`) REFERENCES `hotel` (`idHotel`),
  ADD CONSTRAINT `FK_PAGOS_TOURS` FOREIGN KEY (`idTours`) REFERENCES `tours` (`idTours`);

--
-- Constraints for table `populares`
--
ALTER TABLE `populares`
  ADD CONSTRAINT `FK_POPULARES_TOURS` FOREIGN KEY (`idTours`) REFERENCES `tours` (`idTours`);

--
-- Constraints for table `tours`
--
ALTER TABLE `tours`
  ADD CONSTRAINT `FK_TOURS_ESTADOS` FOREIGN KEY (`idEstados`) REFERENCES `estados` (`idEstados`),
  ADD CONSTRAINT `FK_TOURS_GUIA` FOREIGN KEY (`idGuia`) REFERENCES `guia` (`idGuia`);

--
-- Constraints for table `toursturista`
--
ALTER TABLE `toursturista`
  ADD CONSTRAINT `FK_TOURSTURISTA_TURISTA01` FOREIGN KEY (`idTours`) REFERENCES `tours` (`idTours`),
  ADD CONSTRAINT `FK_TOURSTURISTA_TURISTA02` FOREIGN KEY (`idTurista`) REFERENCES `turista` (`idTurista`);

--
-- Constraints for table `turista`
--
ALTER TABLE `turista`
  ADD CONSTRAINT `FK_Usuario_Turista` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_Persona_Usuario` FOREIGN KEY (`idPersona`) REFERENCES `persona` (`idPersona`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

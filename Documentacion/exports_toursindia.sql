-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-08-2019 a las 14:49:18
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `toursindia`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ADD_TOURS` (IN `pnombre` VARCHAR(45), IN `pdescripcion` VARCHAR(255), IN `pfechaInicio` DATE, IN `pfechaFin` DATE, IN `pprecio` DOUBLE, IN `pcupos` INT(11), IN `pcalificacion` INT(11), IN `pidEstados` INT(11), IN `pidGuia` INT(11), OUT `pidInsertado` INT, OUT `pMensaje` VARCHAR(45))  BEGIN
	DECLARE pError VARCHAR(45);
	DECLARE existetours INT;
	SET pError = '';
	SET existetours = 0;

	IF pnombre = '' THEN
		SET pError = CONCAT(pError, ' ','Nombre completo vacio');
	END IF;
	IF pdescripcion = '' THEN
		SET pError = CONCAT(pError, ' ', 'Descripcion del Tour vacia');
	END IF;
    IF pfechaInicio = '' THEN
		SET pError = CONCAT(pError, ' ','Fecha inicio del Tour no definida');
	END IF;
    IF pfechaFin = '' THEN
		SET pError = CONCAT(pError, ' ','Fecha de finalizacion del Tour no definida');
	END IF;
    IF pprecio = '' THEN
		SET pError = CONCAT(pError, ' ','Precio no definido');
	END IF;
    IF pcupos = '' THEN
		SET pError = CONCAT(pError, ' ','Los cupos no estan definidos para el Tour');
	END IF;
    IF pcalificacion = '' THEN
		SET pError = CONCAT(pError, ' ','Calificacion esta vacia');
	END IF;
    IF pidEstados = '' THEN
		SET pError = CONCAT(pError, ' ','Estado Vacio');
	END IF;
    IF pidGuia = '' THEN
		SET pError = CONCAT(pError, ' ','IdGuia esta vacio');
	END IF;

	SELECT COUNT(*) INTO existetours FROM tours WHERE nombre = pnombre;

	IF pError = '' AND existetours = 0 THEN
		/*Insertamos en la tabla tours*/
		INSERT INTO tours(nombre, descripcion, fechaInicio, fechaFin, precio, cupos, calificacion, idEstados, idGuia)
		VALUES(pnombre, pdescripcion, pfechaInicio, pfechaFin, pprecio, pcupos, pcalificacion, pidEstados, pidGuia);

		/*Obtenemos el ultimo id insertado en la tabla tours*/
		SELECT idTours INTO pidInsertado FROM tours ORDER BY idTours DESC LIMIT 1;

		SET pMensaje = 'Agregado exitosamente.';

	ELSE
		SET pMensaje = 'Fallo. Verifique sus datos a almacenar';

	END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DELETE_TOURS` (IN `pidBorrar` INT, OUT `pMensaje` VARCHAR(55))  BEGIN
	DECLARE existeID INT;
	DECLARE idUser INT;
	DECLARE esGuia INT;
	SET existeID = 0;
	SET idUser = 0;
	SET esGuia = 0;

	SELECT COUNT(*) INTO existeID FROM tours WHERE idTours = pidBorrar;

	IF existeID > 0 THEN
		/*Buscamos el id del tours*/
		SELECT idTours INTO idUser  FROM tours WHERE idTours = pidBorrar;
	
		/*Borramos el tours*/
		DELETE FROM tours WHERE idTours = pidBorrar;

		SET pMensaje = 'Datos borrados satisfactoriamente';
	ELSE
		SET pMensaje = 'No se puede borrar. Verifique sus datos';
	END IF; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EDITAR_TOURS` (IN `pidActualizar` INT, IN `pnombre` VARCHAR(45), IN `pdescripcion` VARCHAR(255), IN `pfechaInicio` DATETIME, IN `pfechaFin` DATETIME, IN `pprecio` DOUBLE, IN `pcupos` INT(11), IN `pcalificacion` INT(11), IN `pidEstados` INT(11), IN `pidGuia` INT(11), OUT `pres` INT, OUT `pMensaje` VARCHAR(45))  BEGIN
	DECLARE pError VARCHAR(45);
	DECLARE existetours INT;
	SET pError = '';

	IF pnombre = '' THEN
		SET pError = CONCAT(pError, ' ','Nombre completo vacio');
	END IF;
	IF pdescripcion = '' THEN
		SET pError = CONCAT(pError, ' ', 'Descripcion del Tour vacia');
	END IF; 
    IF pfechaInicio = '' THEN
		SET pError = CONCAT(pError, ' ','Fecha inicio del Tour no definida');
	END IF;
    IF pfechaFin = '' THEN
		SET pError = CONCAT(pError, ' ','Fecha de finalizacion del Tour no definida');
	END IF;
    IF pprecio = '' THEN
		SET pError = CONCAT(pError, ' ','Precio no definido');
	END IF;
    IF pcupos = '' THEN
		SET pError = CONCAT(pError, ' ','Los cupos no estan definidos para el Tour');
	END IF;
    IF pcalificacion = '' THEN
		SET pError = CONCAT(pError, ' ','Calificacion esta vacia');
	END IF;
    IF pidEstados = '' THEN
		SET pError = CONCAT(pError, ' ','Estado Vacio');
	END IF;
    IF pidGuia = '' THEN
		SET pError = CONCAT(pError, ' ','IdGuia esta vacio');
	END IF;
	

	IF pError = '' THEN
		/*Editamos en la tabla tours*/
		UPDATE tours SET nombre=pnombre, descripcion=pdescripcion, fechaInicio=pfechaInicio, fechaFin=pfechaFin, precio=pprecio, cupos=pcupos, calificacion=pcalificacion, idEstados=pidEstados, idGuia=pidGuia WHERE idTours=pidActualizar;
	
		/*Obtenemos el ultimo id insertado en la tabla tours*/
		SET pres = 1;
		
		SET pMensaje = 'Agregado exitosamente.'; 
		
	ELSE
		SET pMensaje = 'Fallo. Verifique sus datos a almacenar';
		
	END IF;
END$$

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
		/*Insertamos en la tabla persona*/
		INSERT INTO persona(nombreCompleto, Apellidos, numeroIdentidad, telefono, genero,direccion)
				     VALUES(pnombreC,papellidos,pnumeroId,ptelefono,pgenero,pDireccion);
	
		/*Obtenemos el ultimo id insertado en la tabla persona*/
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

		/*Insertamos en la tabla usuario*/
		INSERT INTO usuario(nombreUsuario,email,contrasena,idPersona) VALUES(pnombreU,pemail, pcontrasena,ultimoIDpersona);
		/*Obtenemos el ultimo id insertado en la tabla usuario*/
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ASIGNA_HOTEL` (IN `pidTours` INT, IN `pidEstados` INT, OUT `pMensaje` VARCHAR(45), OUT `res` INT)  BEGIN

	DECLARE v_nombreHotel VARCHAR(45);
   	DECLARE v_descripcion VARCHAR(45);
    DECLARE pError VARCHAR(255);
	DECLARE v_precio INT;

	SET v_nombreHotel  = '';
	SET v_descripcion  = '';
    SET v_precio = 0 ;


	IF pidTours = '' THEN
		SET pError = CONCAT(pError, ' ', 'IdTours vacio');
	END IF;
	IF pidEstados = '' THEN 
		SET pError = CONCAT(pError, ' ', 'IdEstado vacio');
	END IF;
	
	SELECT nombreHotel INTO v_nombreHotel FROM hotel WHERE idEstados = pidEstados;
   	SELECT descripcion INTO v_descripcion FROM hotel WHERE idEstados = pidEstados;
	SELECT precio INTO v_precio FROM hotel WHERE idEstados = pidEstados;


	IF pError = '' THEN
	
    	INSERT INTO hotel(idHotel, nombreHotel, descripcion, precio, idEstados, idTours)
        VALUES (null, v_nombreHotel, v_descripcion, v_precio, pidEstados,pidTours );
        SET pMensaje = 'Agregado con exito' ;
        SET res = 1;
		
	ELSE
		SET pMensaje = CONCAT( 'Error en: ' , ' ', pError); 
        SET res = 0;

	END IF;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DELETE_USER` (IN `pidBorrar` INT, OUT `pMensaje` VARCHAR(55))  BEGIN
	DECLARE existeID INT;
	DECLARE idUser INT;
	DECLARE esAdmin INT;
	DECLARE esTurista INT;
	DECLARE esGuia INT;
	SET existeID = 0;
	SET idUser = 0;
	SET esAdmin = 0;
	SET esTurista = 0;
	SET esGuia = 0;

	SELECT COUNT(*) INTO existeID FROM persona WHERE idPersona = pidBorrar;

	IF existeID > 0 THEN
		/*Buscamos el id del usuario*/
		SELECT idUsuario INTO idUser FROM usuario WHERE idPersona = pidBorrar;
		/*Comprobamos que tipo de usuario es */
		SELECT COUNT(*) INTO esAdmin FROM administrador WHERE idUsuario = idUser;
		SELECT COUNT(*) INTO esTurista FROM turista WHERE idUsuario = idUser;
		SELECT COUNT(*) INTO esGuia FROM Guia WHERE idUsuario = idUser;

		/*Borramos el tipo de Usuario*/
		IF esAdmin > 0 THEN 
			DELETE FROM administrador WHERE idUsuario = idUser;
		END IF;
		
		IF esTurista > 0 THEN
			DELETE FROM turista WHERE idUsuario = idUser;
		END IF;

		IF esGuia > 0 THEN
			DELETE FROM guia WHERE idUsuario = idUser;
		END IF;

		/*Borramos persona y usuario*/
		DELETE FROM usuario WHERE idUsuario = idUser;
		DELETE FROM persona WHERE idPersona = pidBorrar;

		SET pMensaje = 'Datos borrados satisfactoriamente';
	ELSE
		SET pMensaje = 'No se puede borrar. Verifique sus datos';
	END IF; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_LOGIN` (IN `pemail` VARCHAR(45), IN `pcontrasena` VARCHAR(255), OUT `tipoUsuario` INT, OUT `usuarioID` INT)  BEGIN
	DECLARE existeUsuario,  esAdmin, esTurista, esGuia INT;
	SET existeUsuario = 0;
	SET esAdmin = 0;
	SET esTurista = 0;
	SET esGuia = 0;
	/*Comprobar que el correo y la contrasena pertenecen a un usuario*/
	SELECT COUNT(*) INTO existeUsuario FROM usuario WHERE email = pemail AND contrasena = pcontrasena;
	IF existeUsuario > 0 THEN
		/*Obtenemos el id del usuario*/
		SELECT idUsuario INTO usuarioID FROM usuario WHERE email = pemail AND contrasena = pcontrasena;
		/*Comprobamos que tipo de usuario es*/
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UPDATE_PERSON_USER` (IN `pnombreC` VARCHAR(55), IN `papellidos` VARCHAR(55), IN `pnumeroId` VARCHAR(55), IN `ptelefono` VARCHAR(55), IN `pgenero` VARCHAR(55), IN `pDireccion` VARCHAR(55), IN `pnombreUsuario` VARCHAR(55), IN `pemail` VARCHAR(55), IN `ptipoUserCambiar` INT, IN `pidActualizar` INT, OUT `pMensaje` VARCHAR(45))  BEGIN
	DECLARE existeID INT;
	DECLARE idUser INT;
	DECLARE esAdmin INT;
	DECLARE esTurista INT;
	DECLARE esGuia INT;
	SET existeID = 0;
	SET idUser = 0;

	SELECT COUNT(*) INTO existeID FROM persona WHERE idPersona = pidActualizar;

	IF existeID > 0 THEN
		SELECT idUsuario INTO idUser FROM usuario WHERE idPersona = pidActualizar;

		IF pnombreC = '' THEN
			SELECT nombreCompleto INTO pnombreC FROM persona WHERE idPersona = pidActualizar;
		END IF;
		
		IF papellidos = '' THEN
			SELECT Apellidos INTO papellidos FROM persona WHERE idPersona = pidActualizar;
		END IF;

		IF pnumeroId = '' THEN 
			SELECT numeroIdentidad INTO pnumeroId FROM persona WHERE idPersona = pidActualizar;
		END IF;

		IF ptelefono = '' THEN 
			SELECT telefono INTO ptelefono FROM persona WHERE idPersona = pidActualizar;
		END IF;

		IF pgenero = '' THEN 
			SELECT genero INTO pgenero FROM persona WHERE idPersona = pidActualizar;
		END IF;

		IF pDireccion = '' THEN
			SELECT direccion INTO pdireccion FROM persona WHERE idPersona = pidActualizar;
		END IF;

		IF pnombreUsuario = '' THEN
			SELECT nombreUsuario INTO pnombreUsuario FROM usuario WHERE idUsuario = idUser;
		END IF;

		IF pemail = '' THEN 
			SELECT email INTO pemail FROM usuario WHERE idUsuario = idUser;
		END IF; 
		/*Editamos los datos de persona*/
		UPDATE persona SET nombreCompleto = pnombreC, Apellidos = papellidos, numeroIdentidad = pnumeroId,
						   telefono = ptelefono, genero = pgenero, direccion = pDireccion
					WHERE idPersona = pidActualizar;
		/*Editamos los datos de usuario*/
		UPDATE usuario SET nombreUsuario = pnombreUsuario, email = pemail WHERE idUsuario = idUser;
		
		/*Verificamos que usuario es */
		SELECT COUNT(*) INTO esAdmin FROM administrador WHERE idUsuario = idUser;
		SELECT COUNT(*) INTO esTurista FROM turista WHERE idUsuario = idUser;
		SELECT COUNT(*) INTO esGuia FROM Guia WHERE idUsuario = idUser;

		/*Editamos el tipo de Usuario*/
		IF ptipoUserCambiar = 1 THEN
			IF esTurista > 0 THEN
				DELETE FROM turista WHERE idUsuario = idUser;
			END IF;
			IF esGuia > 0 THEN
				DELETE FROM guia WHERE idUsuario = idUser;
			END IF;

			INSERT INTO administrador(idUsuario) VALUES(idUser);

		END IF;

		IF ptipoUserCambiar = 2 THEN
			IF esAdmin > 0 THEN
				DELETE FROM administrador WHERE idUsuario = idUser;
			END IF;

			IF esGuia > 0 THEN
				DELETE FROM guia WHERE idUsuario = idUser;
			END IF;

			INSERT INTO turista(idUsuario) VALUES(idUser);

		END IF;

		IF ptipoUserCambiar = 3 THEN
			IF esAdmin > 0 THEN
				DELETE FROM administrador WHERE idUsuario = idUser;
			END IF;
			IF esTurista > 0 THEN
				DELETE FROM turista WHERE idUsuario = idUser;
			END IF;	
			INSERT INTO guia(idUsuario) VALUES(idUser);
		END IF;

		SET pMensaje = 'Actualizados sus datos con exito.';			
	ELSE 
		SET pMensaje = 'No se puede Actualizar. ID no existe';
	END IF;	  
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `idAdministrador` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `comentarios` (
  `idComentarios` int(11) NOT NULL,
  `Comentario` varchar(255) DEFAULT NULL,
  `fechaComentario` date DEFAULT NULL,
  `horaComentario` timestamp(2) NOT NULL DEFAULT current_timestamp(2) ON UPDATE current_timestamp(2),
  `idUsuario` int(11) NOT NULL,
  `idTours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`idComentarios`, `Comentario`, `fechaComentario`, `horaComentario`, `idUsuario`, `idTours`) VALUES
(1, 'Excelente lugar, lo envuelve una gran historia', '2019-08-07', '2019-08-07 14:05:41.00', 6, 1),
(2, 'Clima extremo, grandioso contemplar el everest', '2019-08-07', '2019-08-07 14:05:41.00', 7, 2),
(3, 'Playas exoticas, paraiso soleado', '2019-08-07', '2019-08-07 14:05:41.00', 8, 3),
(4, 'Bahia Bengala, grandioso sitio', '2019-08-07', '2019-08-07 14:05:41.00', 9, 4),
(5, 'Excelente exhibicion de arte y arquitectura', '2019-08-07', '2019-08-07 14:05:41.00', 10, 5);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `detalles_tours`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `detalles_tours` (
`id` int(11)
,`descripcion` varchar(255)
,`Nombre_Tour` varchar(45)
,`Nombre_Estado` varchar(45)
,`calificacion` int(11)
,`Precio_Tours` double
,`cupos` int(11)
,`Usuario` varchar(45)
,`fechaInicio` datetime
,`fechaFin` datetime
,`idGuia` int(11)
,`idEstados` int(11)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `idEstados` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `guia` (
  `idGuia` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `guia`
--

INSERT INTO `guia` (`idGuia`, `idUsuario`) VALUES
(1, 11),
(2, 12),
(3, 13),
(4, 14),
(5, 15),
(6, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hotel`
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
-- Volcado de datos para la tabla `hotel`
--

INSERT INTO `hotel` (`idHotel`, `nombreHotel`, `descripcion`, `precio`, `idEstados`, `idTours`) VALUES
(1, 'Hotel Taj Resorts', 'Free parking, Free Internet, Cleaning Service', 750, 1, 1),
(2, 'Hotel Caravan Center', 'Free Parking, Free Breakfast, Free Internet', 728, 2, 2),
(3, 'Hotel Goa Woodlands', 'Free Internet, Pool, Free Parking, SPA', 486, 3, 3),
(4, 'Sparsa Resorts Kanyakumari', 'Free Internet, Pool, Free Parking, Free Break', 560, 4, 4),
(5, 'The Oberoi Rajvilas Jaipur', 'Extremely Clean, Excellent Service, SPA', 372, 5, 5),
(6, 'Eros Hotel, Nueva Delhi', 'Colonial style hotel with easy access', 45, 7, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `idImagenes` int(11) NOT NULL,
  `ruta` varchar(45) DEFAULT NULL,
  `idTours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`idImagenes`, `ruta`, `idTours`) VALUES
(1, '../Public/img/tours/t1_01.jpg', 1),
(2, '../Public/img/tours/t1_02.jpg', 1),
(3, '../Public/img/tours/t1_03.png', 1),
(4, '../Public/img/tours/t1_04.jpg', 1),
(5, '../Public/img/tours/t1_05.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `idPagos` int(11) NOT NULL,
  `impuestoSV` int(11) NOT NULL,
  `idTours` int(11) NOT NULL,
  `idHotel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(15, 'Priya Rania', 'Grover Sharma', '001-1977-00126', '+0091 9212-2667', 'F', 'India, Nueva Delhi'),
(16, 'Emanuel Jesus', 'Inaki Angulo', '0801-1994-00666', '+504 9515 4010', 'M', 'Tegugalpa, Honduras');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `populares`
--

CREATE TABLE `populares` (
  `idPopulares` int(11) NOT NULL,
  `idTours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Volcado de datos para la tabla `tours`
--

INSERT INTO `tours` (`idTours`, `nombre`, `descripcion`, `fechaInicio`, `fechaFin`, `precio`, `cupos`, `calificacion`, `idEstados`, `idGuia`) VALUES
(1, 'Taj Mahal', 'Funerary monument built by the emperor Shah Jahan in honor of one of his wives', '2019-07-17 00:00:00', '2019-07-22 00:00:00', 860, 20, 4, 1, 1),
(2, 'Flying over the Himalayas', 'Being close to the largest mountain in the world and contemplating it, in the region of Leh Kashmir', '2019-07-17 00:00:00', '2019-07-19 00:00:00', 791, 5, 4, 2, 2),
(3, 'Goa Beach', 'Exotic Beaches Small excursion from Arambol beach, passing through Kalacha Beach', '2019-07-18 00:00:00', '2019-07-23 00:00:00', 779, 20, 5, 3, 3),
(4, 'Kanyakumari Tours', 'This place is also known as Cabo Comorin; a place where the Indian Ocean, the Arabian Sea and the Bay of Bengal meet', '2019-07-18 00:00:00', '2019-07-21 00:00:00', 550, 20, 4, 4, 4),
(5, 'Rajastan Tours', 'Rajasthan called the land of the Kings is one of the most beautiful states of India in its best colorful and exotic. The state hosts an incredible exhibition of art and architecture', '2019-07-18 00:00:00', '2019-07-24 00:00:00', 763, 20, 5, 5, 5),
(7, 'The Digambar Jain Lal temple', 'The Digambar Jain Lal temple, the oldest Jain sanctuary in the capital of India', '2019-08-09 00:00:00', '2019-08-15 00:00:00', 265, 25, 4, 7, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `toursturista`
--

CREATE TABLE `toursturista` (
  `idToursTurista` int(11) NOT NULL,
  `idTours` int(11) NOT NULL,
  `idTurista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Estructura Stand-in para la vista `tours_dashboard`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `tours_dashboard` (
`id` int(11)
,`Nombre_Tour` varchar(45)
,`Precio_Tours` double
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turista`
--

CREATE TABLE `turista` (
  `idTurista` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombreUsuario` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `idPersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
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
(16, 'Emanuel', 'emsanchez891@gmail.com', 'guia.009', 16);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_perfil_usuarios`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_perfil_usuarios` (
`idUsuario` int(11)
,`nombreCompleto` varchar(55)
,`Apellidos` varchar(55)
,`numeroIdentidad` varchar(55)
,`telefono` varchar(55)
,`genero` varchar(45)
,`direccion` varchar(55)
,`nombreUsuario` varchar(45)
,`email` varchar(45)
,`contrasena` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_perfil_usuario_admin`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_perfil_usuario_admin` (
`idPersona` int(11)
,`idUsuario` int(11)
,`nombreCompleto` varchar(55)
,`Apellidos` varchar(55)
,`numeroIdentidad` varchar(55)
,`telefono` varchar(55)
,`genero` varchar(45)
,`direccion` varchar(55)
,`nombreUsuario` varchar(45)
,`email` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_perfil_usuario_guia`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_perfil_usuario_guia` (
`idPersona` int(11)
,`idUsuario` int(11)
,`idGuia` int(11)
,`nombreCompleto` varchar(55)
,`Apellidos` varchar(55)
,`numeroIdentidad` varchar(55)
,`telefono` varchar(55)
,`genero` varchar(45)
,`direccion` varchar(55)
,`nombreUsuario` varchar(45)
,`email` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_perfil_usuario_turista`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_perfil_usuario_turista` (
`idPersona` int(11)
,`idUsuario` int(11)
,`nombreCompleto` varchar(55)
,`Apellidos` varchar(55)
,`numeroIdentidad` varchar(55)
,`telefono` varchar(55)
,`genero` varchar(45)
,`direccion` varchar(55)
,`nombreUsuario` varchar(45)
,`email` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_populares`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_populares` (
`idTours` int(11)
,`nombre` varchar(45)
,`descripcion` varchar(255)
,`calificacion` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vw_tours_guia`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vw_tours_guia` (
`idTours` int(11)
,`nombre` varchar(45)
,`nombreHotel` varchar(45)
,`nombreGuia` varchar(111)
,`email` varchar(45)
,`idPersona` int(11)
,`idUsuario` int(11)
,`idGuia` int(11)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `detalles_tours`
--
DROP TABLE IF EXISTS `detalles_tours`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detalles_tours`  AS  select `t`.`idTours` AS `id`,`t`.`descripcion` AS `descripcion`,`t`.`nombre` AS `Nombre_Tour`,`e`.`nombre` AS `Nombre_Estado`,`t`.`calificacion` AS `calificacion`,`t`.`precio` AS `Precio_Tours`,`t`.`cupos` AS `cupos`,`u`.`nombreUsuario` AS `Usuario`,`t`.`fechaInicio` AS `fechaInicio`,`t`.`fechaFin` AS `fechaFin`,`g`.`idGuia` AS `idGuia`,`e`.`idEstados` AS `idEstados` from (((`tours` `t` join `estados` `e` on(`e`.`idEstados` = `t`.`idEstados`)) join `guia` `g` on(`g`.`idGuia` = `t`.`idGuia`)) join `usuario` `u` on(`u`.`idUsuario` = `g`.`idUsuario`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `tours_dashboard`
--
DROP TABLE IF EXISTS `tours_dashboard`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tours_dashboard`  AS  select `t`.`idTours` AS `id`,`t`.`nombre` AS `Nombre_Tour`,`t`.`precio` AS `Precio_Tours` from (`tours` `t` join `hotel` `h` on(`h`.`idTours` = `t`.`idTours`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_perfil_usuarios`
--
DROP TABLE IF EXISTS `view_perfil_usuarios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_perfil_usuarios`  AS  select `u`.`idUsuario` AS `idUsuario`,`p`.`nombreCompleto` AS `nombreCompleto`,`p`.`Apellidos` AS `Apellidos`,`p`.`numeroIdentidad` AS `numeroIdentidad`,`p`.`telefono` AS `telefono`,`p`.`genero` AS `genero`,`p`.`direccion` AS `direccion`,`u`.`nombreUsuario` AS `nombreUsuario`,`u`.`email` AS `email`,`u`.`contrasena` AS `contrasena` from (`persona` `p` join `usuario` `u` on(`p`.`idPersona` = `u`.`idUsuario`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_perfil_usuario_admin`
--
DROP TABLE IF EXISTS `view_perfil_usuario_admin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_perfil_usuario_admin`  AS  select `p`.`idPersona` AS `idPersona`,`u`.`idUsuario` AS `idUsuario`,`p`.`nombreCompleto` AS `nombreCompleto`,`p`.`Apellidos` AS `Apellidos`,`p`.`numeroIdentidad` AS `numeroIdentidad`,`p`.`telefono` AS `telefono`,`p`.`genero` AS `genero`,`p`.`direccion` AS `direccion`,`u`.`nombreUsuario` AS `nombreUsuario`,`u`.`email` AS `email` from ((`persona` `p` join `usuario` `u` on(`p`.`idPersona` = `u`.`idUsuario`)) join `administrador` `a` on(`a`.`idUsuario` = `u`.`idUsuario`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_perfil_usuario_guia`
--
DROP TABLE IF EXISTS `view_perfil_usuario_guia`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_perfil_usuario_guia`  AS  select `p`.`idPersona` AS `idPersona`,`u`.`idUsuario` AS `idUsuario`,`g`.`idGuia` AS `idGuia`,`p`.`nombreCompleto` AS `nombreCompleto`,`p`.`Apellidos` AS `Apellidos`,`p`.`numeroIdentidad` AS `numeroIdentidad`,`p`.`telefono` AS `telefono`,`p`.`genero` AS `genero`,`p`.`direccion` AS `direccion`,`u`.`nombreUsuario` AS `nombreUsuario`,`u`.`email` AS `email` from ((`persona` `p` join `usuario` `u` on(`p`.`idPersona` = `u`.`idUsuario`)) join `guia` `g` on(`g`.`idUsuario` = `u`.`idUsuario`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_perfil_usuario_turista`
--
DROP TABLE IF EXISTS `view_perfil_usuario_turista`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_perfil_usuario_turista`  AS  select `p`.`idPersona` AS `idPersona`,`u`.`idUsuario` AS `idUsuario`,`p`.`nombreCompleto` AS `nombreCompleto`,`p`.`Apellidos` AS `Apellidos`,`p`.`numeroIdentidad` AS `numeroIdentidad`,`p`.`telefono` AS `telefono`,`p`.`genero` AS `genero`,`p`.`direccion` AS `direccion`,`u`.`nombreUsuario` AS `nombreUsuario`,`u`.`email` AS `email` from ((`persona` `p` join `usuario` `u` on(`p`.`idPersona` = `u`.`idUsuario`)) join `turista` `t` on(`t`.`idUsuario` = `u`.`idUsuario`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_populares`
--
DROP TABLE IF EXISTS `view_populares`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_populares`  AS  select `t`.`idTours` AS `idTours`,`t`.`nombre` AS `nombre`,`t`.`descripcion` AS `descripcion`,`t`.`calificacion` AS `calificacion` from (`tours` `t` join `populares` `p` on(`p`.`idPopulares` = `t`.`idTours`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vw_tours_guia`
--
DROP TABLE IF EXISTS `vw_tours_guia`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_tours_guia`  AS  select `t`.`idTours` AS `idTours`,`t`.`nombre` AS `nombre`,`h`.`nombreHotel` AS `nombreHotel`,concat(`p`.`nombreCompleto`,' ',`p`.`Apellidos`) AS `nombreGuia`,`u`.`email` AS `email`,`p`.`idPersona` AS `idPersona`,`u`.`idUsuario` AS `idUsuario`,`g`.`idGuia` AS `idGuia` from ((((`persona` `p` join `usuario` `u` on(`p`.`idPersona` = `u`.`idPersona`)) join `guia` `g` on(`g`.`idUsuario` = `u`.`idUsuario`)) join `tours` `t` on(`g`.`idGuia` = `t`.`idGuia`)) join `hotel` `h` on(`h`.`idTours` = `t`.`idTours`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`idAdministrador`),
  ADD KEY `FK_Usuario_Administrador` (`idUsuario`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idComentarios`),
  ADD KEY `FK_COMENTARIOS_USUARIO` (`idUsuario`),
  ADD KEY `FK_COMENTARIOS_TOURS` (`idTours`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`idEstados`);

--
-- Indices de la tabla `guia`
--
ALTER TABLE `guia`
  ADD PRIMARY KEY (`idGuia`),
  ADD KEY `FK_Usuario_Guia` (`idUsuario`);

--
-- Indices de la tabla `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`idHotel`),
  ADD KEY `FK_TOURS_HOTEL` (`idTours`),
  ADD KEY `FK_HOTEL_ESTADOS` (`idEstados`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`idImagenes`),
  ADD KEY `FK_IMAGENES_TOURS` (`idTours`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`idPagos`),
  ADD KEY `FK_PAGOS_HOTEL` (`idHotel`),
  ADD KEY `FK_PAGOS_TOURS` (`idTours`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idPersona`);

--
-- Indices de la tabla `populares`
--
ALTER TABLE `populares`
  ADD PRIMARY KEY (`idPopulares`),
  ADD KEY `FK_POPULARES_TOURS` (`idTours`);

--
-- Indices de la tabla `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`idTours`),
  ADD KEY `FK_TOURS_ESTADOS` (`idEstados`),
  ADD KEY `FK_TOURS_GUIA` (`idGuia`);

--
-- Indices de la tabla `toursturista`
--
ALTER TABLE `toursturista`
  ADD PRIMARY KEY (`idToursTurista`),
  ADD KEY `FK_TOURSTURISTA_TURISTA01` (`idTours`),
  ADD KEY `FK_TOURSTURISTA_TURISTA02` (`idTurista`);

--
-- Indices de la tabla `turista`
--
ALTER TABLE `turista`
  ADD PRIMARY KEY (`idTurista`),
  ADD KEY `FK_Usuario_Turista` (`idUsuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `FK_Persona_Usuario` (`idPersona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `idAdministrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idComentarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `idEstados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `guia`
--
ALTER TABLE `guia`
  MODIFY `idGuia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `hotel`
--
ALTER TABLE `hotel`
  MODIFY `idHotel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `idImagenes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `idPagos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idPersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `populares`
--
ALTER TABLE `populares`
  MODIFY `idPopulares` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tours`
--
ALTER TABLE `tours`
  MODIFY `idTours` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `toursturista`
--
ALTER TABLE `toursturista`
  MODIFY `idToursTurista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `turista`
--
ALTER TABLE `turista`
  MODIFY `idTurista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

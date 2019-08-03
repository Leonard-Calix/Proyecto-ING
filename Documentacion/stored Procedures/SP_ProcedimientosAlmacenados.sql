/*PROCEDIMIENTO ALMACENADO PARA AGREGAR PERSONAS*/
DELIMITER $$

CREATE PROCEDURE SP_ADD_PERSON(IN pnombreC VARCHAR(55), IN papellidos VARCHAR(55), IN pnumeroId VARCHAR(55),
								IN ptelefono VARCHAR(55),IN pgenero VARCHAR(55), IN pDireccion VARCHAR(55),
								OUT pidInsertado INT, OUT pMensaje VARCHAR(45))

BEGIN
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

DELIMITER ;

/*PROCEDIMIENTO ALMACENADO PARA AGREGAR USUARIOS
TIPOS DE USUARIO:
	(1) ADMINISTRADOR
	(2) TURISTA
	(3) GUIA
*/
DELIMITER $$

CREATE PROCEDURE SP_ADD_USER(IN pnombreU VARCHAR(45), IN pemail VARCHAR(45), IN pcontrasena VARCHAR(45),
										IN ptipoUser INT, OUT pidInsertado INT, OUT pMensaje VARCHAR(45))
BEGIN

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

DELIMITER ;



/*=========================================================================*/
/*PROCEDIMIENTO ALMACENADO PARA INICIAR SESION*/

DELIMITER //

CREATE PROCEDURE SP_LOGIN(IN pemail VARCHAR(45), IN pcontrasena VARCHAR(255), OUT tipoUsuario INT, OUT usuarioID INT )
BEGIN
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

END

//

DELIMITER ;


/*=========================================================================*/
/*PROCEDIMIENTO ALMACENADO PARA CALCULAR EL TOTAL A PAGAR POR UN TOUR*/
DELIMITER $$

CREATE OR REPLACE PROCEDURE SP_MONTO_A_PAGAR(IN P_idPagos INT)
BEGIN
	DECLARE existePago, id_Hotel, idTour, impuesto INT;
	DECLARE precioTours, precioHotel, totalPagar DOUBLE;
	SET existePago = 0;
	SET idTour = 0;
	SET id_Hotel = 0;
	SET impuesto = 0;
	SET precioTours = 0.0;
	SET precioHotel = 0.0;
	SET totalPagar = 0.0;
	
	SELECT COUNT(*) INTO existePago FROM Pagos WHERE idPagos = P_idPagos;
	
	IF existePago > 0 THEN
		SELECT idTours INTO idTour FROM Pagos WHERE idPagos = P_idPagos;
		SELECT idHotel INTO id_Hotel FROM Pagos WHERE idPagos = P_idPagos;
		SELECT impuestoSV INTO impuesto FROM Pagos WHERE idPagos = P_idPagos;
		
		SELECT precio INTO precioTours FROM Tours WHERE idTours = idTour;
		SELECT precio INTO precioHotel FROM Hotel WHERE idHotel = id_Hotel;
		
		SET totalPagar = (precioTours + precioHotel) * (1+(impuesto/100));

	END IF;
END$$

DELIMITER ;

/*=========================================================================*/
/*PROCEDIMIENTO ALMACENADO PARA AGREGAR UN NUEVO TOUR*/

DELIMITER //
CREATE PROCEDURE SP_NUEVO_TOURS(IN p_nombre VARCHAR(45), IN p_descripcion VARCHAR(45), IN p_fechai DATE, IN p_fechaf DATE, IN p_precio INT, IN p_cupos INT, IN p_calificacion INT, IN p_estado INT, IN p_guia INT, OUT respuesta INT  )

BEGIN

    DECLARE cantidad INT;
    DECLARE cantidad2 INT;

    SELECT COUNT(*) INTO cantidad FROM tours;

    INSERT INTO TOURS (nombre, descripcion, fechainicio, fechafin, precio, cupos, calificacion, idEstados, idGuia )
    VALUES ( p_nombre,  p_descripcion,  p_fechai,  p_fechaf,  p_precio,  p_cupos,  p_calificacion,  p_estado,  p_guia);

    SELECT COUNT(*) INTO cantidad2 FROM tours;


    IF (cantidad+1) = cantidad2 THEN
        SET respuesta = 1;
    ELSE
        SET respuesta = 0;
    END IF;

END

//
DELIMITER ;
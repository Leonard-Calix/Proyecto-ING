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

/*PROCEDIMIENTO ALMACENADO PARA EDITAR PERSONA*/
DELIMITER $$

CREATE PROCEDURE SP_UPDATE_PERSON_USER(IN pnombreC VARCHAR(55), IN papellidos VARCHAR(55), IN pnumeroId VARCHAR(55),
								IN ptelefono VARCHAR(55),IN pgenero VARCHAR(55), IN pDireccion VARCHAR(55),
								IN pnombreUsuario VARCHAR(55), IN pemail VARCHAR(55), IN ptipoUserCambiar INT,
								IN pidActualizar INT, OUT pMensaje VARCHAR(45))
							
BEGIN
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

/*PROCEDIMIENTO ALMACENADO PARA BORRAR USUARIOS*/

DELIMITER $$

CREATE PROCEDURE SP_DELETE_USER(IN pidBorrar INT, OUT pMensaje VARCHAR(55))
BEGIN
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


DELIMITER $$

CREATE PROCEDURE ADD_TOURS(IN pnombre VARCHAR(45),IN pdescripcion VARCHAR(255),IN pfechaInicio DATETIME, IN pfechaFin DATETIME, IN pprecio DOUBLE,IN pcupos INT(11), IN pcalificacion INT(11),IN pidEstados INT(11), IN pidGuia INT(11),OUT pidInsertado INT, OUT pMensaje VARCHAR(45))

BEGIN
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

DELIMITER ;


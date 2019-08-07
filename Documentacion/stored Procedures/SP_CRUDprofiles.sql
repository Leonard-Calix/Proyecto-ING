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

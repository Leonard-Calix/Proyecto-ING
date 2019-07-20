/*PROCEDIMIENTO ALMACENADO PARA AGREGAR USUARIOS
TIPOS DE USUARIO:
	(1) ADMINISTRADOR
	(2) TURISTA
	(3) GUIA
*/
DELIMITER $$

CREATE OR REPLACE PROCEDURE SP_ADD_USER(IN pnombreC VARCHAR(55), IN papellidos VARCHAR(55), IN pnumeroId VARCHAR(55),
										IN ptelefono VARCHAR(55),IN pgenero VARCHAR(55), IN pDireccion VARCHAR(55), 
										IN pnombreU VARCHAR(45), IN pemail VARCHAR(45), IN pcontrasena VARCHAR(255),
										IN ptipoUser INT, OUT pMensaje VARCHAR(45))
BEGIN

	DECLARE ultimoIDpersona, ultimoIDusuario INT;
	DECLARE pError VARCHAR(45);
	SET pError = '';

	IF pnombreC = '' THEN
		SET pError = CONCAT(pError, ' ','Nombre completo vacio');
	END IF;
	IF papellidos = '' THEN
		SET pError = CONCAT(pError, ' ', 'Apellidos vacio');
	END IF; 
	IF pnombreU = '' THEN
		SET pError = CONCAT(pError, ' ', 'Nombre de usuario vacio');
	END IF;
	IF pemail = '' THEN 
		SET pError = CONCAT(pError, ' ', 'email vacio');
	END IF;
	IF pcontrasena = '' THEN
		SET pError = CONCAT(pError, ' ','contraseña vacia');
	END IF;

	IF pError = '' THEN

		/*Insertamos en la tabla persona*/
		INSERT INTO Persona(nombreCompleto, Apellidos, numeroIdentidad, telefono, genero,direccion)
				     VALUES(pnombreC,papellidos,pnumeroId,ptelefono,pgenero,pDireccion);
	
		/*Obtenemos el ultimo id insertado en la tabla persona*/
		SELECT idPersona INTO ultimoIDpersona FROM Persona ORDER BY idPersona DESC LIMIT 1;
		/*Insertamos en la tabla usuario*/
		INSERT INTO Usuario(nombreUsuario,email,contrasena,idPersona) VALUES(pnombreU,pemail, pcontrasena,ultimoIDpersona);
		/*Obtenemos el ultimo id inserado en la tabla usuario*/
		SELECT idUsuario INTO ultimoIDusuario FROM Usuario ORDER BY idUsuario DESC LIMIT 1;

		CASE ptipouser 

			WHEN 1 THEN 
				INSERT INTO Administrador(idUsuario) VALUES(ultimoIDusuario);
				SET pMensaje = 'Registrado exitosamente';
	
			WHEN 2 THEN 
				INSERT INTO Turista(idUsuario) VALUES(ultimoIDusuario);
				SET pMensaje = 'Registrado exitosamente';

			WHEN 3 THEN 
				INSERT INTO Guia(idUsuario) VALUES(ultimoIDusuario);
				SET pMensaje = 'Registrado exitosamente';	
		END CASE;

		SET pMensaje = 'Registrado exitosamente';
	ELSE
		SET pMensaje = 'Fallo. No se ha registrado';
	END IF;	
END$$

DELIMITER ;


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

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



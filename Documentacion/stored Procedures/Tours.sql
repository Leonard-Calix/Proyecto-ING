/*=========================================================================*/
/*PROCEDIMIENTO ALMACENADO PARA AGREGAR UN NUEVO TOUR*/


DELIMITER $$

CREATE PROCEDURE ADD_TOURS(IN pnombre VARCHAR(45),IN pdescripcion VARCHAR(255),IN pfechaInicio DATE, IN pfechaFin DATE, IN pprecio DOUBLE,IN pcupos INT(11), IN pcalificacion INT(11),IN pidEstados INT(11), IN pidGuia INT(11),OUT pidInsertado INT, OUT pMensaje VARCHAR(45))

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

/*=====================================================================================================*/

DELIMITER $$

CREATE PROCEDURE SP_ASIGNA_HOTEL(IN pidTours INT, IN pidEstados INT, OUT pMensaje VARCHAR(45), OUT res INT)
BEGIN

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

DELIMITER ;

/*EDITAR TOURS===========================================================*/

DELIMITER $$

CREATE PROCEDURE EDITAR_TOURS(IN pidActualizar INT, IN pnombre VARCHAR(45),IN pdescripcion VARCHAR(255),IN pfechaInicio DATETIME, IN pfechaFin DATETIME, IN pprecio DOUBLE,IN pcupos INT(11), IN pcalificacion INT(11),IN pidEstados INT(11), IN pidGuia INT(11),OUT pres INT, OUT pMensaje VARCHAR(45), OUT estado VARCHAR(45))

BEGIN
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
	
		SELECT nombre INTO estado FROM estados;

		/*Obtenemos el ultimo id insertado en la tabla tours*/
		SET pres = 1;
		
		SET pMensaje = 'Agregado exitosamente.'; 
		
	ELSE
		SET pMensaje = 'Fallo. Verifique sus datos a almacenar';
		
	END IF;
END$$

DELIMITER ;

/*=========================================================================*/
/*PROCEDIMIENTO ALMACENADO PARA ELIMINAR UN TOUR*/

DELIMITER $$

CREATE PROCEDURE DELETE_TOURS(IN pidBorrar INT, OUT pMensaje VARCHAR(55))
BEGIN
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
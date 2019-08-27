/* PROCEDIMIENTO DE ELIMINAR COMENTATARIO*/

DELIMITER $$

CREATE PROCEDURE DELETE_COMENTARIOS( IN pIdComentarios int , OUT pMensaje INT)
BEGIN
	DECLARE existeID INT;
	SET existeID = 0;

SELECT COUNT(*) INTO existeID FROM comentarios WHERE idcomentarios = pIdComentarios;

IF existeID >0 THEN
	DELETE FROM comentarios WHERE idComentarios = pIdComentarios;
	SET pMensaje = 1;
ELSE
	SET pMensaje = 0;

END IF;	
		
END$$

DELIMITER ;

DELIMITER $$


CREATE PROCEDURE ADD_COMENTARIOS(IN pcomentario VARCHAR(600), IN pidUsuario INT, IN pidTours INT, OUT pMensaje INT)
BEGIN
	DECLARE pError VARCHAR(600);
	DECLARE existeTour INT;
	DECLARE existeUsuario INT;

	SET pError = '';
	SET existeTour = 0;
	SET existeUsuario = 0;

	IF pcomentario = '' THEN
		SET pError = CONCAT(pError, ' ','Comentario vacio');
	END IF;
	
	SELECT COUNT(*) INTO existeTour FROM tours WHERE idTours = pidTours;
	SELECT COUNT(*) INTO existeUsuario FROM turista WHERE idUsuario = pidUsuario;

	IF existeTour = 0 THEN
		SET pError = CONCAT(pError, ' ', 'ID de tour no existe');
	END IF;

	IF existeUsuario = 0 THEN
		SET pError = CONCAT(pError, ' ', 'ID de usuario no existe');
	END IF;

	IF pError = '' AND existeTour = 1 AND existeUsuario = 1 THEN

		INSERT INTO comentarios(idComentarios,comentario, fechaComentario, horaComentario, idUsuario, idTours )
						 VALUES(null,pcomentario, CURDATE(), curTime(),  pidUsuario, pidTours);

		SET pMensaje = 1;
	ELSE

		SET pMensaje = 0;

	END IF;
END$$

END $$


DELIMITER ;
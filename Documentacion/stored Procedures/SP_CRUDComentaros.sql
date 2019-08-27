/* PROCEDIMIENTO DE ELIMINAR COMENTATARIO*/

DELIMITER $$

CREATE PROCEDURE DELETE_COMENTARIOS( IN pIdComentarios int , OUT pMensaje INT)
BEGIN
	DECLARE existeID INT;
	SET existeID = 0;

SELECT COUNT(*) INTO existeID FROM comentarios WHERE idcomentarios = pIdComentarios;

IF existeID >0 THEN
	DELETE FROM comentarios WHERE idComentarios = pIdComentarios;
	SET pMensaje =1;
ELSE
	SET pMensaje =0;

END IF;	
		
END$$

DELIMITER ;



/*PROCEDIMMIENTO AGREGAR COMENTARIO*/
DELIMITER $$

CREATE PROCEDURE ADD_COMENTARIOS(IN pcomentario VARCHAR(600), IN pidUsuario INT, IN pidTours INT, OUT pMensaje INT)

BEGIN
	DECLARE pError VARCHAR(600);
	SET pError = '';
	
	IF pcomentario = '' THEN
		SET pError = CONCAT(pError, ' ','Comentario vacio');
	END IF;
	IF pidUsuario = null THEN
		SET pError = CONCAT(pError, ' ','idUsuario vacio');
	END IF;
	IF pidTours = null THEN
		SET pError = CONCAT(pError, ' ','idTours vacio');
	END IF;

		IF pError = '' THEN

		INSERT INTO comentarios(idComentarios,comentario, fechaComentario, horaComentario, idUsuario, idTours )
					VALUES(null,pcomentario, CURDATE(), curTime(),  pidUsuario, pidTours);

			SET pMensaje = 1;
		ELSE

		SET pMensaje = 0;

	END IF;
END$$

DELIMITER ;
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

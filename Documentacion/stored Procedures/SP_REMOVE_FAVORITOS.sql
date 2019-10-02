DELIMITER //

CREATE PROCEDURE SP_REMOVE_FAVORITOS(IN pidTour INT, OUT resultado INT, OUT mensaje varchar(2500) )
BEGIN
	DECLARE conteo INT;
	SET conteo = 0;
   
	SELECT COUNT(*) INTO conteo FROM populares WHERE idtours = pidTours;
    
	IF conteo > 0 THEN

        SET mensaje = 'not added';
        SET resultado = 0;
	
	ELSE 
    	DELETE FROM populares WHERE idTours=pidTour; 
        SET mensaje = 'successfully removed';
        SET resultado = 1;
    
	END IF;

END

//

DELIMITER ;
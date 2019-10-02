DELIMITER //

CREATE PROCEDURE SP_ADD_FAVORITOS(IN pidTour INT, OUT resultado INT, OUT mensaje varchar(2500) )
BEGIN
	DECLARE conteo INT;
	SET conteo = 0;
   
	SELECT COUNT(*) INTO conteo FROM populares WHERE idtours = pidTours;
    
	IF conteo > 0 THEN
		
        INSERT INTO populares (idPopulares, idTours ) VALUES (null, pidtours);
        SET mensaje = 'successfully added';
        SET resultado = 1;
	
	ELSE 
    	
        SET mensaje = 'already added';
        SET resultado = 1;
    
	END IF;

END

//

DELIMITER ;
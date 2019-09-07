DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_COMPRAR_TOURS`(IN `nidTours` INT(11), IN `nidUsuario` INT(11), IN `nidHotel` INT(11), IN `nTuristas` INT(11), OUT `nmontoPagar` INT, OUT `resultado` INT, OUT `pMensaje` VARCHAR(45))
BEGIN
	DECLARE existeTour, esTurista, precioTour, existeHotel, existeCupo, turista INT;
    DECLARE error VARCHAR(45);
	SET existeTour = 0;
	SET esTurista = 0;
	SET existeHotel = 0;
	SET turista= 0;
    SET existeCupo=0;
    SET error='';
    
		SELECT COUNT(*) INTO existeTour FROM tours WHERE idTours = nidTours;
		SELECT COUNT(*) INTO esTurista FROM turista WHERE idUsuario = nidUsuario;
		SELECT COUNT(*) INTO existeHotel FROM hotel WHERE idHotel = nidHotel;
        SELECT idTurista INTO turista FROM turista WHERE idUsuario = nidUsuario;
        	IF existeTour = 0 THEN
				SET error = CONCAT(error, ' ', 'El Tours no existe');
			END IF;
            IF esTurista = 0 THEN
				SET error = CONCAT(error, ' ', 'Ese id no es de turista');
			END IF;
            IF existeHotel = 0 THEN
				SET error = CONCAT(error, ' ', 'El Hotel no existe');
			END IF;
            
/*Comproba si nTuristas es menor a cero, si lo es actualizar error*/
		If nTuristas = 0 THEN
        	SET error = CONCAT(error, ' ', 'El numero de turistas ingresado no es valido');
        END IF;
		
/*Comproba en la tabla tours si hay cupos suficientes 
(Si los cupos son menos que la cantidad de turistas no pueden comprar el tour)
Select cupos from tours;*/
		SELECT cupos INTO existeCupo FROM tours WHERE idTours = nidTours;
        If nTuristas > existeCupo THEN
        	SET error = CONCAT(error, ' ', 'El tours no cuenta con esa cantidad de cupos');
        END IF;
  
 /*Si existeTour = 1 AND existeHotel = 1 AND esTurista = 1 AND cupos < nTuristas entonces*/
  /*Hace un update de tours para disminuir los cupos (cupos - nTuristas) con el idTours
	
	Saca el id del turista de la tabla turista con el idUsuario y se lo asignas a Turista
	Haces un insert a la tabla toursturista*/
 		IF error = ' ' THEN
        INSERT INTO toursturista(idTours, idTurista) VALUES(nidTours, turista);
        UPDATE tours t SET t.cupos = (t.cupos-nTuristas) WHERE T.idTours = nidTours;
        SET pMensaje = 'Todo esta bien';
        SET resultado = 1;
        ELSE
        SET pMensaje =CONCAT('tiene los siguientes errores',' ',error);
        SET resultado = 0;
        END IF;
 
 	/*Haces un insert a la tabla pagos*/
	        INSERT INTO pagos(impuestoSV, idTours, idHotel) VALUES(20,nidTours, nidHotel);
    
	/*Si nTurista es 1 el montoPagar es igual al precio del tour
	Si nTurista es 2 el montoPagar es igual al precio del tour + (un valor que te parezca)
	Si nTurista es mayor a 4 el montoPagar es igual al precio del tour + (otro valor que te parezca xd)
	
	Lo ideal seria hacer el calculo pero si lo ves muy cumplicado mejor no
	
	retornas el mensaje (1) si todo ha ido bien, y el montoPagar
	
De lo contrario
	retornas el mensaje (0) o los errores*/

	SELECT precio INTO precioTour FROM tours WHERE idTours = nidTours;
    IF nTuristas = 1 THEN
    SET nmontoPagar = precioTour;
    END IF;
    
    IF nTuristas = 2 THEN
    SET nmontoPagar = (precioTour*1.5);
    END IF;
    
    IF nTuristas > 2 THEN
    SET nmontoPagar = (precioTour * (2 +(nTuristas*0.2)));
    END IF;
    

    END$$
DELIMITER ;
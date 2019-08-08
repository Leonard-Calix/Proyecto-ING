-- PROCEDIMIENTO GUARDAR GUIA
/*PROCEDIMIENTO ALMACENADO PARA ASIGNAR GUIAS A TOURS
DELIMITER $$

CREATE PROCEDURE SP_ASIGNAR_GUIA_TOUR(IN IN pidGuia INT, IN pIdTour INT, OUT pMensaje VARCHAR(55))
BEGIN
    DECLARE existeTours INT;
    DECLARE existeGuia INT;
    DECLARE guiasinTours INT;
    SET existeTours = 0;
    SET existeGuia = 0;

    SELECT COUNT(*) INTO existeTours FROM tours WHERE idTours = pIdTour;
    SELECT COUNT(*) INTO existeGuia FROM guia WHERE idGuia = pidGuia;
    SELECT COUNT(*) INTO guiasinTours FROM tours WHERE idGuia = pidGuia;

    IF existeTours > 0 AND existeGuia > 0 AND guiasinTours = 0 THEN

        INSERT INTO tours(nombre, descripcion, fechaInicio, fechaFin, precio, cupos, calificacion, idEstados, idGuia)
		VALUES(pnombre, pdescripcion, pfechaInicio, pfechaFin, pprecio, pcupos, pcalificacion, pidEstados, pidGuia);
    ELSE

    END IF;


    
END$$
DELIMITER ;*/

DELIMITER $$
CREATE PROCEDURE SP_UPDATE_GUIA_TOURS(IN pidGuia INT, IN pIdTour INT, OUT pMensaje VARCHAR(55))
BEGIN
    DECLARE existeTours INT;
    DECLARE existeGuia INT;
    SET existeTours = 0;
    SET existeGuia = 0;

    SELECT COUNT(*) INTO existeTours FROM tours WHERE idTours = pIdTour;
    SELECT COUNT(*) INTO existeGuia FROM guia WHERE idGuia = pidGuia;

    IF existeTours > 0 AND existeGuia > 0  THEN
    
        UPDATE tours SET idGuia = pidGuia WHERE idTours = pIdTour;
    ELSE
        pMensaje = 'No se puede actualizar. Verifique sus datos';
    END IF;

END$$

DELIMITER ;

/*VISTAS DE LOS TOUR POPULARES*/
create view view_populares as 
SELECT t.idTours, t.nombre, t.descripcion, t.calificacion 
FROM `tours` t inner join populares p oN p.idpopulares=t.idtours
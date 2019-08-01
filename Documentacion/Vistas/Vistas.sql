/*VISTAS DE LOS TOUR POPULARES*/
CREATE view view_populares as 
SELECT t.idTours, t.nombre, t.descripcion, t.calificacion 
FROM `tours` t inner join populares p oN p.idpopulares=t.idtours

/*VISTA DE LOS PERFILES DE USUARIO*/

/*ADMINISTRADOR*/
CREATE VIEW VIEW_Perfil_Usuario_Admin AS
SELECT p.idPersona, u.idUsuario, p.nombreCompleto, p.Apellidos, p.numeroIdentidad, p.telefono, p.genero, p.direccion,
	   u.nombreUsuario, u.email
FROM persona p 
INNER JOIN usuario u ON p.idPersona = u.idUsuario
INNER JOIN administrador a ON a.idUsuario = u.idUsuario;

/*TURISTA*/
CREATE VIEW VIEW_Perfil_Usuario_Turista AS
SELECT p.idPersona, u.idUsuario, p.nombreCompleto, p.Apellidos, p.numeroIdentidad, p.telefono, p.genero, p.direccion,
	   u.nombreUsuario, u.email
FROM persona p 
INNER JOIN usuario u ON p.idPersona = u.idUsuario
INNER JOIN turista t ON t.idUsuario = u.idUsuario;

/*GUIA*/
CREATE VIEW VIEW_Perfil_Usuario_Admin AS
SELECT p.idPersona, u.idUsuario, p.nombreCompleto, p.Apellidos, p.numeroIdentidad, p.telefono, p.genero, p.direccion,
	   u.nombreUsuario, u.email
FROM persona p 
INNER JOIN usuario u ON p.idPersona = u.idUsuario
INNER JOIN guia g ON g.idUsuario = u.idUsuario;

/*VISTAS DE LOS TOUR POPULARES*/
CREATE view view_populares as 
SELECT  t.idEstados estado, t.idTours, t.nombre, t.descripcion, t.calificacion  
FROM tours t inner join populares p oN p.idpopulares=t.idtours;

/*VISTA DE LOS PERFILES DE USUARIO*/

/*TODOS LOS USUARIOS*/
CREATE VIEW VIEW_Perfil_Usuarios AS
SELECT u.idUsuario, p.nombreCompleto, p.Apellidos, p.numeroIdentidad, p.telefono, p.genero, p.direccion,
	   u.nombreUsuario, u.email, u.contrasena
FROM persona p 
INNER JOIN usuario u ON p.idPersona = u.idUsuario;

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
CREATE VIEW VIEW_Perfil_Usuario_Guia AS
SELECT p.idPersona, u.idUsuario, g.idGuia, p.nombreCompleto, p.Apellidos, p.numeroIdentidad, p.telefono, p.genero, p.direccion,
	   u.nombreUsuario, u.email
FROM persona p 
INNER JOIN usuario u ON p.idPersona = u.idUsuario
INNER JOIN guia g ON g.idUsuario = u.idUsuario;


/*VISTAS DEL DASHBOARD*/
CREATE VIEW tours_dashboard  AS 
SELECT t.idtours id, t.nombre Nombre_Tour, t.precio Precio_Tours FROM 
tours t INNER JOIN estados e ON e.idEstados=t.idestados;


/*SELECT t.idtours id, t.nombre Nombre_Tour, t.precio Precio_Tours FROM 
tours t INNER JOIN estados e ON e.idEstados=t.idestados;*/


/*VISTAS DEL DASHBOARD-DETALLES*/
CREATE VIEW detalles_tours AS
SELECT t.idtours id, t.descripcion, t.nombre Nombre_Tour, e.nombre Nombre_Estado, t.calificacion, t.precio Precio_Tours, t.cupos, u.nombreUsuario Usuario, t.fechaInicio, t.fechaFin, g.idGuia, e.idEstados FROM tours t
INNER JOIN estados e ON e.idEstados=t.idestados
INNER JOIN guia g ON g.idguia=t.idguia
INNER JOIN usuario u ON u.idusuario=g.idusuario;

/*GUIAS PARA EL FORMULARIO*/
SELECT g.idGuia, p.nombreCompleto FROM guia g
INNER JOIN usuario u ON u.idUsuario=g.idUsuario 
INNER JOIN persona p ON p.idPersona=u.idUsuario;

/*===================================================================================================================*/
/*TOURS ASIGNADOS A GUIAS*/
CREATE VIEW VW_TOURS_GUIA AS
SELECT  t.idTours, t.nombre, h.nombreHotel, CONCAT(p.nombreCompleto," ", p.Apellidos) as nombreGuia, u.email, p.idPersona, u.idUsuario, g.idGuia FROM persona p 
INNER JOIN usuario u ON p.idPersona = u.idPersona
INNER JOIN guia g ON g.idUsuario = u.idUsuario
INNER JOIN tours t ON g.idGuia = t.idGuia
INNER JOIN hotel h ON h.idTours = t.idTours;

/*VISTA DE COMENTARIOS*/
CREATE VIEW view_comentarios
AS
	SELECT C.idComentarios, C.idUsuario, C.idTours, C.Comentario, T.nombre, U.nombreUsuario FROM comentarios C 
	INNER JOIN tours T on C.idTours = T.idTours
	INNER JOIN usuario U on U.idUsuario = C.idUsuario;
/*VISTAS DE LOS TOUR POPULARES*/
CREATE view view_populares as 
SELECT t.idTours, t.nombre, t.descripcion, t.calificacion 
FROM `tours` t inner join populares p oN p.idpopulares=t.idtours

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
CREATE VIEW VIEW_Perfil_Usuario_Admin AS
SELECT p.idPersona, u.idUsuario, p.nombreCompleto, p.Apellidos, p.numeroIdentidad, p.telefono, p.genero, p.direccion,
	   u.nombreUsuario, u.email
FROM persona p 
INNER JOIN usuario u ON p.idPersona = u.idUsuario
INNER JOIN guia g ON g.idUsuario = u.idUsuario;


#vista turistas
create or replace view view_turista as select P.nombreCompleto, T.idTurista as idTurista from persona as P
	inner join usuario as U on P.idPersona=U.idPersona
	inner join turista as T on U.idUsuario=T.idUsuario;
#vista de guia    
create or replace view view_guia as select P.nombreCompleto, G.idguia as idguia from persona as P
	inner join usuario as U on P.idPersona=U.idPersona
	inner join guia as G on U.idUsuario=G.idUsuario;  
#vista de guia y el tour    
create or replace view view_guiaTours as select T.nombre as nombreTour, Gu.nombreCompleto as Guia, idTours as idTours from tours as T
	inner join view_guia as Gu
	on T.idGuia= Gu.idguia;
    
#vista de Turistas con guias
create or replace view view_turistaTourGuia  as select 
	Tu.nombreCompleto as nombreTurista, Tour.nombreTour,Tour.Guia from toursturista as tourt
	inner join view_turistaTours  as Tu

	on tourt.idTurista=Tu.idTurista

	inner join  view_guiaTours as Tour
	on tourt.idTours=Tour.idTours
	where tourt.idTurista  is not null;
    

/*========================================================================*/
/*VISTAS DEL DASHBOARD*/
CREATE VIEW tours_dashboard  AS 
SELECT t.idtours id, t.nombre Nombre_Tour, t.precio Precio_Tours FROM tours t 
INNER JOIN hotel h ON h.idtours=t.idtours
SELECT t.idtours id, t.nombre Nombre_Tour, t.precio Precio_Tours FROM 
tours t INNER JOIN estados e ON e.idEstados=t.idestados 


/*VISTAS DEL DASHBOARD-DETALLES*/
drop view detalles_tours;
CREATE VIEW detalles_tours AS
SELECT t.idtours id, t.descripcion, t.nombre Nombre_Tour, e.nombre Nombre_Estado, t.calificacion, t.precio Precio_Tours, t.cupos, u.nombreUsuario Usuario, t.fechaInicio, t.fechaFin, g.idGuia, e.idEstados FROM tours t
INNER JOIN estados e ON e.idEstados=t.idestados
INNER JOIN guia g ON g.idguia=t.idguia
INNER JOIN usuario u ON u.idusuario=g.idusuario
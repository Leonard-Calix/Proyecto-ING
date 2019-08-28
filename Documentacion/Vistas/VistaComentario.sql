select * from comentarios;

create or replace view vista_comentarios as
select p.nombreCompleto nombre_usuario, c.Comentario, t.nombre nombre_del_tour from comentarios c
inner join usuario u
on c.idUsuario = u.idUsuario
inner join tours t 
on c.idTours = t.idTours
inner join persona p
on u.idPersona = p.idPersona;

select * from vista_comentarios;
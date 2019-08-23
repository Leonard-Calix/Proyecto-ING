select * from comentarios;

create or replace view vista_comentario as
select p.nombreCompleto nombre_usuario, c.Comentario, t.nombre nombre_del_tour from comentarios c
inner join usuario u
on c.idUsuario = u.idUsuario
inner join tours t 
on c.idTours = t.idTours
inner join persona pview_populares
on u.idPersona = p.idPersona;

select * from vista_comentario;
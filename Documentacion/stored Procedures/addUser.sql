delimiter //

create procedure sp_addUser(
  in nombre varchar(45),in lastName varchar(45),
  in email varchar(45), in userName varchar(45),
  in contrasena varchar(100), out mensaje varchar(45))
  
  
begin
  insert into Persona(nombreCompleto,apellidos) values(nombre, lastName);
  set @lastPerson=(Select idPersona from Persona order by idPersona DESC limit 1);
  
  insert into Usuario(nombreUsuario,email,contrasena,idPersona)
    values(userName,email,contrasena,@lastPerson);
  set @lastUser=(Select idUsuario from Usuario order by idUsuario DESC limit 1);
  insert into Turista(idUsuario)
  	values(@lastUser);

  set @mensaje="registro exitoso";

end//
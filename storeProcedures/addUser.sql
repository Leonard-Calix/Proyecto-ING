delimiter //

create procedure sp_addUser(
  nombre varchar(45),lastName varchar(45),
  email varchar(45), userName varchar(45),
  contrasena varchar(100))
  
  
begin
  set @lastPerson=(Select idPersona from Persona order by idPersona DESC limit 1);
  
  insert into Persona(nombreCompleto,apellidos) values(nombre, lastName);
  insert into Usuario(nombreUsuario,email,contrasena,idPersona)
    values(userName,email,contrasena,@lastPerson);


end//
-- Asignacion de Hotel

drop procedure if exists asignacion_hoteles;

delimiter $$
create procedure ASIGNAR_HOTEL (in _idHotel int,
                                    in _idTours int, 
                                    out _mensaje varchar(150))

begin
	declare _nombreHotel varchar(150);
    declare _descripcion varchar(150);
	declare _precio double(10,2);
    declare _idestados int;	
    
	if exists (select * from Hotel where idHotel = _idHotel) then
		select nombreHotel, descripcion, precio, idEstados into _nombreHotel, _descripcion, _precio, _idestados 
        from Hotel where idHotel = _idHotel;
    
		if exists (select * from tours where idtours = _idtours) then 
			set _mensaje = 1;
            
            insert into hotel(nombreHotel, descripcion, precio, idEstados, idTours)
            values(_nombreHotel, _descripcion, _precio, _idestados, _idTours);
		else 
			set _mensaje = 0; 
		end if;
	else
		set _mensaje = "No se encontro idHotel";
	end if; 
end $$
-- set @salida = 0;
-- call asignacion_hoteles(3, 7, @salida);
-- select @salida;
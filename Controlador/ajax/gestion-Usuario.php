<?php 

	include_once('../../Modelo/clase-Usuario.php');
	include_once('../../Modelo/clase-Persona.php');

	switch ($_GET["accion"]) {
		
		case 'agregar':
			$mensaje = Usuario::agregarUsuario();
			if ($mensaje!=null) {
				echo '{"resultado": "Agregado", "codigo": 1 }';
			}else{
				echo '{"resultado": "Error", "codigo": 0 }';
			}
	   
			break;
		
		case 'login':
			echo '{"Opcion": "Login" }';
		break;

		default:
			
			break;
	}

	
	













 ?>
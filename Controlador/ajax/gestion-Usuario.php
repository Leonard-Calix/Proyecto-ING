<?php 

	include_once('../../Modelo/clase-Usuario.php');
	include_once('../../Modelo/clase-Persona.php');

	switch ($_GET["accion"]) {
		
		case 'agregar':
			echo '{"Opcion": "Agregar" }';
		break;
		
		case 'login':
			echo '{"Opcion": "Login" }';
		break;

		default:
			
			break;
	}

	
	













 ?>